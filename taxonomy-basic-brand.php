<?php
/**
 * The Template for displaying TaxonomyTag pages.
 */

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$tag_term = $wp_query->get_queried_object();
$banner = get_field('icon_term', $tag_term);

$basic = array(
  'post_type'       => array( 'basic_specifications' ),
  'posts_per_page'  => -1,
  'paged'           => $paged,
);

$basic['tax_query'] = array(
  'relation' => 'AND',
  array(
    'taxonomy' => 'basic-brand',
    'field'    => 'term_id',
    'terms'    => $tag_term->term_id,
  ),
);

$posts = get_posts( $basic );

$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorites', true) ;
if( !$favorites ){
    $favorites = [];
}

// Get ids cars from basic specifications
$ids = [];
foreach ( $posts as $post ):
  $cars = array(
    'post_type' => 'cars',
    'posts_per_page' => -1,
    'post_status'      => 'publish',
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'id_basic_specifications',
        'value' => '"' . $post->ID . '"',
        'compare' => 'LIKE'
      ),
      array(
        'key' => 'id_basic_specifications',
        'value' => $post->ID,
        'compare' => '='
      )
    )
  );
  $posts = get_posts( $cars );
  foreach ( $posts as $post ){
    $ids[] = $post->ID;
  }
endforeach;

// Get query cars
$args = array (
  'post__in' => $ids,
  'orderby' => 'post__in',
  'post_status' => 'publish',
  'post_type' => 'cars',
  'posts_per_page' => 9,
);

$query = new WP_Query( $args );
?>

<section class="container-fluid p-lg-5 bg-gray">
  <div class="row m-0 justify-content-center">
    <?php if($banner): ?>
      <img class="img-fluid" style="max-width: 180px" src="<?= $banner; ?>" alt="<?= $tag_term->name; ?>">
    <?php endif; ?>
    <h1 class="text-center"><?= $tag_term->name; ?></h1>
  </div>
</section>

<section class="container-fluid mt-5 mb-5">
  <div class="row">
    <div class="col-md-3 col-12">
      <?php get_template_part( 'filter', 'car' ); ?>
    </div>    
    <div class="col-md-9 col-12 position-relative">
      <div class="row" id="cars">
        <!-- Start of the loop -->
        <?php
        if ( $query->have_posts() && $ids):
          while ( $query->have_posts() ):
            $query->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
            $author_id = get_the_author_meta('ID');
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $finance_price = get_field('finance_price');
        ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
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

  });
</script>


<?php
get_footer();