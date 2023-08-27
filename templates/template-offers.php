<?php
/* Template Name: Car Offers */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#about-page
 *
*/

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$banner = get_the_post_thumbnail_url( get_the_ID(), 'full');

$args = array(
  'post_type'        => array( 'cars' ),
  'posts_per_page' => 9,
  'paged' => $paged,
  'meta_query' => array(
    array(
      'key'     => 'offers',
      'value' => '1',
    ),
  )  
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
                  <div class="car-box-head-left d-flex">
                    <div class="car-box-head-offer bg-green rounded-4">
                      <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.1327 10.686L20.2367 8.77797C20.3694 8.54841 20.4055 8.27556 20.337 8.0194C20.2686 7.76324 20.1012 7.54475 19.8717 7.41197L17.9617 6.30797V4.10797C17.9617 3.84275 17.8563 3.5884 17.6688 3.40086C17.4812 3.21333 17.2269 3.10797 16.9617 3.10797H14.7627L13.6597 1.19897C13.5265 0.969887 13.3084 0.802476 13.0527 0.732971C12.9258 0.698586 12.7934 0.68972 12.6632 0.706886C12.5329 0.724052 12.4073 0.766908 12.2937 0.832971L10.3837 1.93697L8.47368 0.831971C8.244 0.699368 7.97105 0.663434 7.71488 0.732071C7.45871 0.800709 7.24029 0.968298 7.10768 1.19797L6.00368 3.10797H3.80468C3.53946 3.10797 3.28511 3.21333 3.09757 3.40086C2.91003 3.5884 2.80468 3.84275 2.80468 4.10797V6.30697L0.894678 7.41097C0.78071 7.47653 0.680818 7.56395 0.600742 7.66823C0.520666 7.77251 0.461984 7.89158 0.428067 8.01861C0.39415 8.14564 0.385666 8.27811 0.403104 8.40843C0.420541 8.53874 0.463556 8.66433 0.529678 8.77797L1.63368 10.686L0.529678 12.594C0.397666 12.8237 0.36185 13.0964 0.430036 13.3525C0.498222 13.6085 0.664882 13.8273 0.893678 13.961L2.80368 15.065V17.264C2.80368 17.5292 2.90903 17.7835 3.09657 17.9711C3.28411 18.1586 3.53846 18.264 3.80368 18.264H6.00368L7.10768 20.174C7.19621 20.3253 7.32261 20.451 7.47446 20.5387C7.6263 20.6263 7.79835 20.673 7.97368 20.674C8.14768 20.674 8.32068 20.628 8.47468 20.539L10.3827 19.435L12.2927 20.539C12.5223 20.6714 12.7951 20.7073 13.0511 20.6389C13.3072 20.5705 13.5257 20.4033 13.6587 20.174L14.7617 18.264H16.9607C17.2259 18.264 17.4802 18.1586 17.6678 17.9711C17.8553 17.7835 17.9607 17.5292 17.9607 17.264V15.065L19.8707 13.961C19.9844 13.8952 20.0841 13.8077 20.1641 13.7034C20.244 13.5991 20.3026 13.4801 20.3365 13.3531C20.3704 13.2262 20.3789 13.0938 20.3616 12.9635C20.3443 12.8333 20.3015 12.7077 20.2357 12.594L19.1327 10.686ZM7.88268 5.67597C8.28063 5.6761 8.66224 5.83432 8.94354 6.11581C9.22485 6.3973 9.38281 6.77901 9.38268 7.17697C9.38254 7.57493 9.22433 7.95653 8.94284 8.23784C8.66135 8.51914 8.27963 8.6771 7.88168 8.67697C7.48372 8.67684 7.10211 8.51862 6.82081 8.23713C6.53951 7.95564 6.38155 7.57393 6.38168 7.17597C6.38181 6.77801 6.54002 6.39641 6.82152 6.1151C7.10301 5.8338 7.48472 5.67584 7.88268 5.67597ZM8.18268 15.276L6.58268 14.077L12.5827 6.07697L14.1827 7.27597L8.18268 15.276ZM12.8827 15.676C12.6856 15.6759 12.4905 15.637 12.3085 15.5616C12.1265 15.4861 11.9611 15.3755 11.8218 15.2361C11.6825 15.0967 11.5721 14.9313 11.4967 14.7492C11.4214 14.5672 11.3826 14.372 11.3827 14.175C11.3827 13.9779 11.4216 13.7828 11.4971 13.6008C11.5726 13.4188 11.6831 13.2534 11.8225 13.1141C11.9619 12.9748 12.1273 12.8643 12.3094 12.789C12.4915 12.7137 12.6866 12.6749 12.8837 12.675C13.2816 12.6751 13.6632 12.8333 13.9445 13.1148C14.2258 13.3963 14.3838 13.778 14.3837 14.176C14.3835 14.5739 14.2253 14.9555 13.9438 15.2368C13.6623 15.5181 13.2806 15.6761 12.8827 15.676Z" fill="white"/>
                      </svg>
                      <span>عرض خاص</span>
                    </div>
                  </div>                                       
                </div>
                <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title(); ?>"></a>
              </div>
              <div class="car-box-content position-relative p-4">
                <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
                <div class="information">
                  <p class="pricing">
                    <span class="price d-block"><?= the_field('price'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                    <span class="new-price d-block"><?= the_field('price_offer'); ?> <?= the_field('currency_pricing', 'option'); ?></span>
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