<?php
/**
 * The Template for displaying TaxonomyTag pages.
 */

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$tag_term = $wp_query->get_queried_object();
$banner = get_field('icon_term', $tag_term);

$args = array(
  'post_type'       => array( 'cars' ),
  'posts_per_page'  => 12,
  'paged'           => $paged,
);

$args['tax_query'] = array(
  'relation' => 'AND',
  array(
    'taxonomy' => 'products-tag',
    'field'    => 'term_id',
    'terms'    => $tag_term->term_id,
  ),
);
$query = new WP_Query( $args );

$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorites', true) ;
if( !$favorites ){
    $favorites = [];
}
?>

<section class="container-fluid position-relative">
  <div class="row h-banner">
      <?php if($banner): ?>
        <img class="img-fluid p-0" src="<?= $banner; ?>" alt="<?= $tag_term->name; ?>">
      <?php endif; ?>
      <div class="banner-data position-absolute end-0 start-0 top-0 bottom-0 px-lg-5">
        <h3 class="font-bold mb-4 px-lg-5 h1"><?= $tag_term->name; ?></h3>
        <div class="px-lg-5"><?= term_description(); ?></div>
      </div>
  </div>
</section>

<section class="container-fluid mt-5 mb-5">
  <div class="row">
    <div class="col-md-3 col-12">
      <div class="d-lg-none d-md-none d-block mb-5">
        <a class="btn btn-outline-dark m-auto d-block rounded-0" data-bs-toggle="offcanvas" href="#offcanvasSide" role="button" aria-controls="offcanvasSide">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 5C8.73478 5 8.48043 5.10536 8.29289 5.29289C8.10536 5.48043 8 5.73478 8 6C8 6.26522 8.10536 6.51957 8.29289 6.70711C8.48043 6.89464 8.73478 7 9 7C9.26522 7 9.51957 6.89464 9.70711 6.70711C9.89464 6.51957 10 6.26522 10 6C10 5.73478 9.89464 5.48043 9.70711 5.29289C9.51957 5.10536 9.26522 5 9 5ZM6.17 5C6.3766 4.41447 6.75974 3.90744 7.2666 3.54879C7.77346 3.19015 8.37909 2.99755 9 2.99755C9.62091 2.99755 10.2265 3.19015 10.7334 3.54879C11.2403 3.90744 11.6234 4.41447 11.83 5H19C19.2652 5 19.5196 5.10536 19.7071 5.29289C19.8946 5.48043 20 5.73478 20 6C20 6.26522 19.8946 6.51957 19.7071 6.70711C19.5196 6.89464 19.2652 7 19 7H11.83C11.6234 7.58553 11.2403 8.09257 10.7334 8.45121C10.2265 8.80986 9.62091 9.00245 9 9.00245C8.37909 9.00245 7.77346 8.80986 7.2666 8.45121C6.75974 8.09257 6.3766 7.58553 6.17 7H5C4.73478 7 4.48043 6.89464 4.29289 6.70711C4.10536 6.51957 4 6.26522 4 6C4 5.73478 4.10536 5.48043 4.29289 5.29289C4.48043 5.10536 4.73478 5 5 5H6.17ZM15 11C14.7348 11 14.4804 11.1054 14.2929 11.2929C14.1054 11.4804 14 11.7348 14 12C14 12.2652 14.1054 12.5196 14.2929 12.7071C14.4804 12.8946 14.7348 13 15 13C15.2652 13 15.5196 12.8946 15.7071 12.7071C15.8946 12.5196 16 12.2652 16 12C16 11.7348 15.8946 11.4804 15.7071 11.2929C15.5196 11.1054 15.2652 11 15 11ZM12.17 11C12.3766 10.4145 12.7597 9.90743 13.2666 9.54879C13.7735 9.19015 14.3791 8.99755 15 8.99755C15.6209 8.99755 16.2265 9.19015 16.7334 9.54879C17.2403 9.90743 17.6234 10.4145 17.83 11H19C19.2652 11 19.5196 11.1054 19.7071 11.2929C19.8946 11.4804 20 11.7348 20 12C20 12.2652 19.8946 12.5196 19.7071 12.7071C19.5196 12.8946 19.2652 13 19 13H17.83C17.6234 13.5855 17.2403 14.0926 16.7334 14.4512C16.2265 14.8099 15.6209 15.0025 15 15.0025C14.3791 15.0025 13.7735 14.8099 13.2666 14.4512C12.7597 14.0926 12.3766 13.5855 12.17 13H5C4.73478 13 4.48043 12.8946 4.29289 12.7071C4.10536 12.5196 4 12.2652 4 12C4 11.7348 4.10536 11.4804 4.29289 11.2929C4.48043 11.1054 4.73478 11 5 11H12.17ZM9 17C8.73478 17 8.48043 17.1054 8.29289 17.2929C8.10536 17.4804 8 17.7348 8 18C8 18.2652 8.10536 18.5196 8.29289 18.7071C8.48043 18.8946 8.73478 19 9 19C9.26522 19 9.51957 18.8946 9.70711 18.7071C9.89464 18.5196 10 18.2652 10 18C10 17.7348 9.89464 17.4804 9.70711 17.2929C9.51957 17.1054 9.26522 17 9 17ZM6.17 17C6.3766 16.4145 6.75974 15.9074 7.2666 15.5488C7.77346 15.1901 8.37909 14.9976 9 14.9976C9.62091 14.9976 10.2265 15.1901 10.7334 15.5488C11.2403 15.9074 11.6234 16.4145 11.83 17H19C19.2652 17 19.5196 17.1054 19.7071 17.2929C19.8946 17.4804 20 17.7348 20 18C20 18.2652 19.8946 18.5196 19.7071 18.7071C19.5196 18.8946 19.2652 19 19 19H11.83C11.6234 19.5855 11.2403 20.0926 10.7334 20.4512C10.2265 20.8099 9.62091 21.0025 9 21.0025C8.37909 21.0025 7.77346 20.8099 7.2666 20.4512C6.75974 20.0926 6.3766 19.5855 6.17 19H5C4.73478 19 4.48043 18.8946 4.29289 18.7071C4.10536 18.5196 4 18.2652 4 18C4 17.7348 4.10536 17.4804 4.29289 17.2929C4.48043 17.1054 4.73478 17 5 17H6.17Z" fill="#D97E00"/>
          </svg>
          <span>فلترة النتائج</span>
        </a>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSide" aria-labelledby="offcanvasSideLabel">
            <div class="offcanvas-header bg-dark py-5 px-3 d-flex flex-column position-relative">
              <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
                <img class="img-fluid" src="<?=get_theme_file_uri().'/assets/img/logo-footer.svg' ?>" alt="<?=get_bloginfo('name', 'display') ?>" title="<?=get_bloginfo('name') ?>" />
              </a>
              <h3 class="mt-3 text-white">موقع عشرين للسيارات</h3>
              <button type="button" class="btn-close text-reset position-absolute end-0 m-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
          <?php get_template_part( 'filter', 'car' ); ?>
        </div>
      </div>
      <div class="d-lg-block d-md-block d-none">
        <?php get_template_part( 'filter', 'car' ); ?>
      </div>
    </div>    
    <div class="col-md-9 col-12 position-relative">
      <div class="row" id="cars">
        <!-- Start of the loop -->
        <?php
        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
            $author_id = get_the_author_meta('ID');
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $finance_price = get_field('finance_price');
        ?>
          <div class="col-lg-4 col-md-6 col-6 mb-4">
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
                    <span>شامل الضريبة واللوحات</span>
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
              <?php if($finance_price): ?>
              <div class="car-box-footer bg-primary">
                <span>قسط يبدأ من</span>
                <span>|</span>
                <span><?= $finance_price; ?></span>
                <span>ريال/ شهريا</span>
              </div>
              <?php endif; ?>
            </div>
          </div>
        <?php 
          endwhile;
        endif;
        ?>
        <div class="col-md-12 mt-5"><?php echo custom_base_pagination(array(), $query); ?></div>
        <?php wp_reset_postdata(); ?>
      </div>
      <div class="container-load loader-cars">
        <div class="loading"></div>
      </div>      
    </div>
  </div>
</section>

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

    $(window).resize(function(){
      var width = $(window).width();
      if(width <= 766){
        $('.d-lg-block').remove();
      } else {
        $('.d-lg-none').remove();
      }
    })
    .resize();//trigger the resize event on page load.
  });
</script>


<?php
get_footer();