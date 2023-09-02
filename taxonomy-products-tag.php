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
  'posts_per_page'  => 9,
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
      <?php get_template_part( 'filter', 'car' ); ?>
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
                    <div class="car-box-head-favorite icon-box bg-white rounded-100 text-primary"><i class="far fa-heart"></i></div>
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




<?php
get_footer();