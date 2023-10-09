<?php
/* Template Name: Cars Favorite */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$banner = get_the_post_thumbnail_url( get_the_ID(), 'full');

$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorites', true) ;
if( !$favorites ){
    $favorites = [];
}

$args = array(
  'post_type' => array( 'cars' ),
  'posts_per_page' => 9,
  'paged' => $paged,
  'post__in' => $favorites
);

$query = new WP_Query( $args );

?>

<section class="container-fluid">
  <div class="row">
    <?php if($banner): ?>
      <img class="img-fluid p-0" src="<?= $banner; ?>" alt="<?= the_title(); ?>">
    <?php endif; ?>
  </div>
</section>
<section class="container mt-5 mb-5">
  <div class="row">   
    <?php 
    if ( $query->have_posts() && $favorites):
      while ( $query->have_posts() ):
        $query->the_post();
        $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
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
                <div class="car-box-head-share icon-box bg-white rounded-100 text-primary"><i class="fas fa-share-square"></i></div>
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
          <?php if($finance_price): ?>
          <div class="car-box-footer bg-dark">
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
    else:
      echo '<p>لا يوجد سيارات مفضلة</p>';
    endif;
    ?>

    <?php if ( $query->have_posts() && $favorites): ?>
      <div class="col-md-12 mt-5"><?php echo custom_base_pagination(array(), $query); ?></div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

  </div>
</section>

<?php
get_footer();
?>