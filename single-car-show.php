<?php
get_header();

$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';

$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorites', true) ;
if( !$favorites ){
    $favorites = [];
}

  if (have_posts() ):
    while (have_posts() ):
      the_post();
      $author_id = get_the_author_meta('ID');
      $avatar = get_field('user_logo', 'user_'. $author_id);
      $background = get_field('user_background', 'user_'. $author_id);
      $term_package_list = get_the_terms( get_the_ID(), 'realestate-package' );
      $terms_package = join(', ', wp_list_pluck($term_package_list, 'name')); 
      $user_address = get_field('user_address', 'user_'. $author_id);      
      $user_phone = get_field('user_phone', 'user_'. $author_id);
      $user_whatsapp = get_field('user_whatsapp', 'user_'. $author_id);
      $content = get_the_content();
      $map = get_field('map_user', 'user_'. $author_id);
      $cars = new WP_Query( array( 'author' => $author_id, 'post_type' => 'cars', 'posts_per_page' => -1 ) );
      $count = $cars->found_posts;
      ?>

        <!-- Page Header Start -->
        <div class="page-header page-showroom mb-3 bg-light">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-12 pt-4 pb-4 d-none d-lg-block d-md-block">
                <h1 class="text-dark mb-3 font-bold"><?= the_title(); ?></h1>
                <div class="d-flex flex-column">
                  <span>
                    <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7 9.025C6.33696 9.025 5.70107 8.77478 5.23223 8.32938C4.76339 7.88398 4.5 7.27989 4.5 6.65C4.5 6.02011 4.76339 5.41602 5.23223 4.97062C5.70107 4.52522 6.33696 4.275 7 4.275C7.66304 4.275 8.29893 4.52522 8.76777 4.97062C9.23661 5.41602 9.5 6.02011 9.5 6.65C9.5 6.96189 9.43534 7.27073 9.3097 7.55887C9.18406 7.84702 8.99991 8.10884 8.76777 8.32938C8.53562 8.54992 8.26002 8.72486 7.95671 8.84421C7.65339 8.96357 7.3283 9.025 7 9.025ZM7 0C5.14348 0 3.36301 0.700623 2.05025 1.94774C0.737498 3.19486 0 4.88631 0 6.65C0 11.6375 7 19 7 19C7 19 14 11.6375 14 6.65C14 4.88631 13.2625 3.19486 11.9497 1.94774C10.637 0.700623 8.85652 0 7 0Z" fill="#3E3E3E"/>
                    </svg>
                    <?= $user_address; ?>
                  </span>
                  <span>
                    <i class="fas fa-phone"></i>
                    <a href="tel:<?= $user_phone; ?> "><?= $user_phone; ?></a>
                    <?php
                      if( have_rows('user_phones', 'user_'. $author_id) ):
                        while ( have_rows('user_phones', 'user_'. $author_id) ) : the_row(); 
                      ?>
                        <a href="tel:<?= the_sub_field('number_phone'); ?> "><?= the_sub_field('number_phone'); ?></a>
                      <?php 
                        endwhile;
                      endif;
                    ?>
                  </span>                
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    <a href="https://wa.me/<?= $user_whatsapp; ?> "><?= $user_whatsapp; ?></a>
                    <?php
                      if( have_rows('user_whatsapps', 'user_'. $author_id) ):
                        while ( have_rows('user_whatsapps', 'user_'. $author_id) ) : the_row(); 
                      ?>
                        <a href="https://wa.me/<?= the_sub_field('number_whatsapp'); ?> "><?= the_sub_field('number_whatsapp'); ?></a>
                      <?php 
                        endwhile;
                      endif;
                    ?>
                  </span> 
                  <div class="showroom-content">
                    <?= $content; ?>
                  </div>
                  <div class="showroom-map">
                    <?= $map; ?>
                  </div>  
                </div>            
              </div>
              <div class="col-md-6 col-12 p-0">
                <div class="bg-showroom">
                  <img class="img-fluid" src="<?= ($background)? $background:$placeholder; ?>" alt="<?= the_title(); ?>">
                </div>
              </div>                
            </div>
          </div>
        </div>

        <div class="container mb-5">
          <div class="row">
            <h2 class="mt-5 mb-2 font-bold">سيارات المعرض</h2>
            <span class="mb-5 d-inline-block h6 text-primary">(<?= $count; ?>) سيارة</span>
            <?php
            if ( $cars->have_posts() ):
              while ( $cars->have_posts() ):
                $cars->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                $author_id = get_the_author_meta('ID');
                $avatar = get_field('user_logo', 'user_'. $author_id);
                $finance_price = get_field('finance_price');
            ?>
              <div class="col-lg-4 col-md-6 col-sm-6 col-6 mb-4">
                <div class="car-box car-offer">
                  <?php if(get_field('sold_done')): ?>
                    <div class="sold-done" style="position: absolute;z-index: 9;left: 15px;padding: 30px;bottom: 0;right: 15px;top: 0;pointer-events: none;">
                      <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
                    </div>
                  <?php endif; ?>
                  <div class="car-box-img position-relative">
                    <div class="car-box-head d-flex justify-content-between position-absolute">
                      <div class="car-box-head-right d-flex">
                        <div class="car-box-head-favorite">
                          <?php echo '<button class="favorite-button icon-box bg-white rounded-100 text-primary border-0 ' . (in_array(get_the_ID(), $favorites) ? 'is_favorite' : '') . '" data-post-id="' . get_the_ID() . '" data-favorites="' . esc_attr(json_encode($favorites)) . '" data-is-favorite="' . (in_array(get_the_ID(), $favorites) ? 'true' : 'false') . '">' . (in_array(get_the_ID(), $favorites) ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>') . '</button>'; ?>
                        </div>
                        <div class="car-box-head-share icon-box bg-white rounded-100 text-primary">
                          <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.27816 12.073V3.20029L5.04516 4.47066L3.96629 3.33924L7.04879 0.16333L10.1313 3.33924L9.05241 4.47066L7.81941 3.20029V12.073H6.27816ZM0.883789 17.6308V5.72117H4.73691V7.30912H2.42504V16.0429H11.6725V7.30912H9.36066V5.72117H13.2138V17.6308H0.883789Z" fill="#D97E00"/>
                          </svg>
                        </div>
                      </div>                  
                    </div>
                    <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title(); ?>"></a>
                  </div>
                  <div class="car-box-content position-relative p-4">
                    <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
                    <div class="information">
                      <p class="pricing">
                        <span class="new-price d-block"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                        <span>شامل الضريبة</span>
                      </p>
                      <p>
                        <span class="author">
                          <a class="logo-author" href="#">
                            <img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>">
                          </a>
                          <span><?= the_author_meta( 'display_name', $author_id ); ?></span>
                          <i class="fas fa-arrow-left"></i>
                        </span>
                      </p>
                    </div>
                  </div>
                  <div class="car-box-footer bg-cyan">
                    <span>قسط يبدأ من</span>
                    <span>|</span>
                    <span><?= $finance_price; ?></span>
                    <span>ريال/ شهريا</span>
                  </div>
                </div>
              </div>
            <?php
              endwhile;
            endif;
            ?>      
            <?php wp_reset_postdata(); ?>
          </div>
        </div>

        <script type="text/javascript">
          jQuery(function ($) {
            $('.favorite-button').click(function(e) {
              e.preventDefault();
              var button = $(this);
              var action = 'add';
              var ajax = 0;
              var postId = button.data('postId');
              if (button.hasClass('is_favorite')) { 
                  var action = 'remove';
              }
              if (postId !== "" && !ajax) { 
                  ajax = 1 ;
                  // Save favorites to the user metadata via AJAX 
                  $.post("<?= admin_url( 'admin-ajax.php' ); ?>", {
                      'action': 'save_user_favorites',
                      'favorites': 'favorites',
                      'post_id': postId // add user ID to request parameters,
                  })  
                  .done(function(response) {
                    ajax = 0;
                    console.log('Favorites saved:', response);
                    if (action == 'add') { 
                      button.addClass('is_favorite');
                      button.html( '<i class="fas fa-heart"></i>' );
                    } else {
                      console.log(`User ${postId} removed from favorites.`);
                      button.html( '<i class="far fa-heart"></i>');
                    }
                  })
                  .fail(function(xhr, status, error) {
                      console.log('Failed to save favorites:', error);
                      console.log('Server response:', xhr.responseText);
                  });
              } else {
                  console.log(`Cannot add/remove user with empty ID`);
              } 
            });
          });
        </script>        
      <?php
    endwhile;
  endif;
get_footer();