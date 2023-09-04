<?php
/* Template Name: Home Page */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#hom-page
 *
*/

get_header(); 

$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$brands = get_terms('basic-brand', array('parent' => 0, 'number' => 12));
$term_page_link = get_field('term_page_link', 'option');
$installment_page_link = get_field('page_installment', 'option');

$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorites', true) ;
if( !$favorites ){
    $favorites = [];
}
?>

<section id="section-slider" class="section-slider">
  <div id="carouselExampleIndicators" class="carousel slide">
    <div class="carousel-indicators">
        <?php
        $counter = -1;
        if( have_rows('slider_home') ):
          while( have_rows('slider_home') ) : the_row();
          $counter++;
        ?>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $counter; ?>" class="<?= ($counter == '0')? 'active':'';?>" aria-current="true" aria-label="Slide 1"></button>
        <?php
          endwhile;
        endif;
        ?>      
    </div>
    <div class="carousel-inner">
        <?php
        $counter = 0;
        if( have_rows('slider_home') ):
          while( have_rows('slider_home') ) : the_row();
          $counter++;
        ?>
          <div class="carousel-item <?= ($counter == '1')? 'active':'';?>">
            <img src="<?= get_sub_field('image_slider'); ?>" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <?= get_sub_field('content_slider'); ?>

                <?php 
                $link = get_sub_field('page_slider');
                if( $link ): 
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self'; 
                ?>
                  <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                <?php endif; ?>
            </div>
          </div>
        <?php
          endwhile;
        endif;
        ?>
    </div>
  </div>
</section>

<!-- Hero About us -->
<section id="section-about" class="section-about mt-5">
  <div class="container">
    <div class="row" style="background-image: url('<?= the_field('ads_left'); ?>');background-size: cover;background-position: center;">
      <div class="col-sm-4 col-12 text-right py-5">
        <h2><?= the_field('headline_ads'); ?></h2>
        <p><?= the_field('content_ads'); ?></p>
      </div>
    </div>
  </div>
</section>

<!-- cars Offers -->
<?php 
  $args = array(
    'post_type'      => array('cars'),
    'posts_per_page' => 6,
    'meta_query' => array(
      array(
        'key'     => 'offers',
        'value' => '1',
      ),
    )
  );
  $query = new WP_Query( $args );
  if ( $query->have_posts() ):
?>
<section id="section-offers" class="section-cars mt-5">
  <div class="cars-listing">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">عروضنا مستمرة</h2>
      </div>
      <div class="row">
        <div class="owl-carousel owl-theme owl-offers">
        <?php
          while ( $query->have_posts() ):
            $query->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
            $author_id = get_the_author_meta('ID');
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $image_offer = get_field('image_offer');
            $finance_price = get_field('finance_price');
            ?>

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
                    <div class="car-box-head-left d-flex">
                      <div class="car-box-head-offer bg-green rounded-4">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M19.1327 10.686L20.2367 8.77797C20.3694 8.54841 20.4055 8.27556 20.337 8.0194C20.2686 7.76324 20.1012 7.54475 19.8717 7.41197L17.9617 6.30797V4.10797C17.9617 3.84275 17.8563 3.5884 17.6688 3.40086C17.4812 3.21333 17.2269 3.10797 16.9617 3.10797H14.7627L13.6597 1.19897C13.5265 0.969887 13.3084 0.802476 13.0527 0.732971C12.9258 0.698586 12.7934 0.68972 12.6632 0.706886C12.5329 0.724052 12.4073 0.766908 12.2937 0.832971L10.3837 1.93697L8.47368 0.831971C8.244 0.699368 7.97105 0.663434 7.71488 0.732071C7.45871 0.800709 7.24029 0.968298 7.10768 1.19797L6.00368 3.10797H3.80468C3.53946 3.10797 3.28511 3.21333 3.09757 3.40086C2.91003 3.5884 2.80468 3.84275 2.80468 4.10797V6.30697L0.894678 7.41097C0.78071 7.47653 0.680818 7.56395 0.600742 7.66823C0.520666 7.77251 0.461984 7.89158 0.428067 8.01861C0.39415 8.14564 0.385666 8.27811 0.403104 8.40843C0.420541 8.53874 0.463556 8.66433 0.529678 8.77797L1.63368 10.686L0.529678 12.594C0.397666 12.8237 0.36185 13.0964 0.430036 13.3525C0.498222 13.6085 0.664882 13.8273 0.893678 13.961L2.80368 15.065V17.264C2.80368 17.5292 2.90903 17.7835 3.09657 17.9711C3.28411 18.1586 3.53846 18.264 3.80368 18.264H6.00368L7.10768 20.174C7.19621 20.3253 7.32261 20.451 7.47446 20.5387C7.6263 20.6263 7.79835 20.673 7.97368 20.674C8.14768 20.674 8.32068 20.628 8.47468 20.539L10.3827 19.435L12.2927 20.539C12.5223 20.6714 12.7951 20.7073 13.0511 20.6389C13.3072 20.5705 13.5257 20.4033 13.6587 20.174L14.7617 18.264H16.9607C17.2259 18.264 17.4802 18.1586 17.6678 17.9711C17.8553 17.7835 17.9607 17.5292 17.9607 17.264V15.065L19.8707 13.961C19.9844 13.8952 20.0841 13.8077 20.1641 13.7034C20.244 13.5991 20.3026 13.4801 20.3365 13.3531C20.3704 13.2262 20.3789 13.0938 20.3616 12.9635C20.3443 12.8333 20.3015 12.7077 20.2357 12.594L19.1327 10.686ZM7.88268 5.67597C8.28063 5.6761 8.66224 5.83432 8.94354 6.11581C9.22485 6.3973 9.38281 6.77901 9.38268 7.17697C9.38254 7.57493 9.22433 7.95653 8.94284 8.23784C8.66135 8.51914 8.27963 8.6771 7.88168 8.67697C7.48372 8.67684 7.10211 8.51862 6.82081 8.23713C6.53951 7.95564 6.38155 7.57393 6.38168 7.17597C6.38181 6.77801 6.54002 6.39641 6.82152 6.1151C7.10301 5.8338 7.48472 5.67584 7.88268 5.67597ZM8.18268 15.276L6.58268 14.077L12.5827 6.07697L14.1827 7.27597L8.18268 15.276ZM12.8827 15.676C12.6856 15.6759 12.4905 15.637 12.3085 15.5616C12.1265 15.4861 11.9611 15.3755 11.8218 15.2361C11.6825 15.0967 11.5721 14.9313 11.4967 14.7492C11.4214 14.5672 11.3826 14.372 11.3827 14.175C11.3827 13.9779 11.4216 13.7828 11.4971 13.6008C11.5726 13.4188 11.6831 13.2534 11.8225 13.1141C11.9619 12.9748 12.1273 12.8643 12.3094 12.789C12.4915 12.7137 12.6866 12.6749 12.8837 12.675C13.2816 12.6751 13.6632 12.8333 13.9445 13.1148C14.2258 13.3963 14.3838 13.778 14.3837 14.176C14.3835 14.5739 14.2253 14.9555 13.9438 15.2368C13.6623 15.5181 13.2806 15.6761 12.8827 15.676Z" fill="white"/>
                        </svg>
                        <span>عرض خاص</span>
                      </div>
                      <div class="car-box-head-360 icon-box bg-primary rounded-100">
                        <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M9.93934 1.96381C9.93934 1.75753 9.8574 1.5597 9.71154 1.41384C9.56568 1.26798 9.36785 1.18604 9.16157 1.18604H7.60601C7.39973 1.18604 7.2019 1.26798 7.05604 1.41384C6.91018 1.5597 6.82823 1.75753 6.82823 1.96381V6.63048C6.82823 6.83676 6.91018 7.03459 7.05604 7.18045C7.2019 7.32631 7.39973 7.40826 7.60601 7.40826H9.16157C9.36785 7.40826 9.56568 7.32631 9.71154 7.18045C9.8574 7.03459 9.93934 6.83676 9.93934 6.63048V5.07492C9.93934 4.86864 9.8574 4.67081 9.71154 4.52495C9.56568 4.37909 9.36785 4.29715 9.16157 4.29715H6.82823M1.38379 1.18604H3.32823C3.63765 1.18604 3.9344 1.30895 4.15319 1.52774C4.37198 1.74654 4.4949 2.04328 4.4949 2.3527V3.13048C4.4949 3.4399 4.37198 3.73665 4.15319 3.95544C3.9344 4.17423 3.63765 4.29715 3.32823 4.29715M3.32823 4.29715H2.16157M3.32823 4.29715C3.63765 4.29715 3.9344 4.42006 4.15319 4.63885C4.37198 4.85765 4.4949 5.15439 4.4949 5.46381V6.24159C4.4949 6.55101 4.37198 6.84776 4.15319 7.06655C3.9344 7.28534 3.63765 7.40826 3.32823 7.40826H1.38379M1.38379 9.74159C1.38379 11.0304 4.51823 12.0749 8.38379 12.0749C12.2493 12.0749 15.3838 11.0304 15.3838 9.74159M12.2727 2.74159V5.8527C12.2727 6.26526 12.4366 6.66092 12.7283 6.95265C13.02 7.24437 13.4157 7.40826 13.8282 7.40826C14.2408 7.40826 14.6365 7.24437 14.9282 6.95265C15.2199 6.66092 15.3838 6.26526 15.3838 5.8527V2.74159C15.3838 2.32903 15.2199 1.93337 14.9282 1.64165C14.6365 1.34992 14.2408 1.18604 13.8282 1.18604C13.4157 1.18604 13.02 1.34992 12.7283 1.64165C12.4366 1.93337 12.2727 2.32903 12.2727 2.74159Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </div>
                    </div>                      
                  </div>
                  <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($image_offer)? $image_offer:$img_url; ?>" alt="<?= get_the_title(); ?>"></a>
                </div>
                <div class="car-box-content position-relative p-lg-4 p-1">
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
                        <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </span>
                    </p>
                  </div>
                </div>
                <div class="car-box-footer bg-blue">
                  <span>قسط يبدأ من</span>
                  <span>|</span>
                  <span><?= $finance_price; ?></span>
                  <span>ريال/ شهريا</span>
                </div>
              </div>

          <?php
            endwhile; 
          ?>      
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- cars News -->
<?php 
  $headline = get_field('headline_cars_by_category');
  $cars     = get_field('category_cars');
  $category_cars = get_field('category_cars_taxonomy');
  $link = get_field('link_cars_by_category');
  $args = array(
    'post_type'      => array( 'cars'),
    'posts_per_page' => 6,
    'tax_query' => array(
      'relation' => 'AND',
      array(
          'taxonomy' => 'products-tag',
          'field'    => 'term_id',
          'terms'    => array($category_cars),
          'operator' => 'IN',
      ),
    ),
  );
  $query = new WP_Query( $args );
?>
<section id="section-cars-news" class="section-cars mt-3">
  <div class="cars-listing">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title"><?= $headline; ?></h2>
      </div>
      <div class="row">
        <?php
          if ( $cars ):
            foreach( $cars as $car ): 
              $img_url = get_the_post_thumbnail_url($car->ID,'medium');
              $author_id =  get_post_field( 'post_author', $car->ID );
              $avatar = get_field('user_logo', 'user_'. $author_id);
              $finance_price = get_field('finance_price', $car->ID);
          ?>
          <div class="col-lg-4 col-md-6 col-sm-6 col-6 mb-4">

            <div class="car-box car-offer">
              <?php if(get_field('sold_done', $car->ID)): ?>
                <div class="sold-done" style="position: absolute;z-index: 9;left: 15px;padding: 30px;bottom: 0;right: 15px;top: 0;pointer-events: none;">
                  <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
                </div>
              <?php endif; ?>
              <div class="car-box-img position-relative">
                <div class="car-box-head d-flex justify-content-between position-absolute">
                  <div class="car-box-head-right d-flex">
                    <div class="car-box-head-favorite">
                      <?php echo '<button class="favorite-button icon-box bg-white rounded-100 text-primary border-0 ' . (in_array($car->ID, $favorites) ? 'is_favorite' : '') . '" data-post-id="' . $car->ID . '" data-favorites="' . esc_attr(json_encode($favorites)) . '" data-is-favorite="' . (in_array($car->ID, $favorites) ? 'true' : 'false') . '">' . (in_array($car->ID, $favorites) ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>') . '</button>'; ?>
                    </div>
                    <div class="car-box-head-share icon-box bg-white rounded-100 text-primary">
                      <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.27816 12.073V3.20029L5.04516 4.47066L3.96629 3.33924L7.04879 0.16333L10.1313 3.33924L9.05241 4.47066L7.81941 3.20029V12.073H6.27816ZM0.883789 17.6308V5.72117H4.73691V7.30912H2.42504V16.0429H11.6725V7.30912H9.36066V5.72117H13.2138V17.6308H0.883789Z" fill="#D97E00"/>
                      </svg>
                    </div>
                  </div>                    
                </div>
                <a class="link-img" href="<?= get_permalink($car->ID); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title($car->ID); ?>"></a>
              </div>
              <div class="car-box-content position-relative p-lg-4 p-1">
                <h4 class="text-uppercase"><?= get_the_title($car->ID); ?></h4>
                <div class="information">
                  <p class="pricing">
                    <span class="new-price d-block"><?= the_field('price', $car->ID); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                    <span>شامل الضريبة واللوحات</span>
                  </p>
                  <p>
                    <span class="author">
                      <a class="logo-author" href="#">
                        <img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>">
                      </a>
                      <span><?= the_author_meta( 'display_name', $author_id ); ?></span>
                      <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </span>
                  </p>
                </div>
              </div>
              <div class="car-box-footer bg-primary">
                <span>قسط يبدأ من</span>
                <span>|</span>
                <span><?= $finance_price; ?></span>
                <span>ريال/ شهريا</span>
              </div>
            </div>
          </div>
          <?php 
            endforeach; 
          else:
            if ( $query->have_posts() ):
            while ( $query->have_posts() ):
              $query->the_post();
              $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
              $author_id = get_the_author_meta('ID');
              $avatar = get_field('user_logo', 'user_'. $author_id);
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
                <div class="car-box-content position-relative p-lg-4 p-1">
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
                        <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </span>
                    </p>
                  </div>
                </div>
                <div class="car-box-footer bg-dark">
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
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Partners -->
<?php 
  $partners = get_field('partners');
  if($partners):
?>
<section id="section-partners" class="section-partners bg-gray py-4 mt-3">
  <div class="cars-listing">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title"><?= the_field('partners_headline'); ?></h2>
      </div>
      <div class="row">
        <?php 
          foreach( $partners as $partner ):
            $author_id =  get_post_field( 'post_author', $partner->ID );
            $background = get_field('user_background', 'user_'. $author_id);
            $package_id = get_field('package', 'user_'. $author_id);
            $cities_id = get_field('cities', 'user_'. $author_id);
            $package_term = get_term_by('id', $package_id, 'realestate-package');
            $cities_term = get_term_by('id', $cities_id, 'realestate-cities');
            $query = new WP_Query( array( 'author' => $author_id, 'post_type' => 'cars' ) );
            $placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
        ?>
          <div class="col-md-4 col-12 mb-3">
            <div class="showroom car-box bg-white p-2 position-relative">
              <a class="logo-author" href="#">
                <img class="img-fluid" src="<?= ($background)? $background:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>">
                <span class="package position-absolute text-dark font-bold">
                  <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.3334 6.249L20.5793 7.61484L19.9834 5.039L22.0001 3.31567L19.3509 3.0865L18.3334 0.666504L17.2976 3.0865L14.6667 3.31567L16.6651 5.039L16.0417 7.61484L18.3334 6.249ZM21.0834 18.0832H15.5834V8.9165H21.0834V18.0832ZM0.916748 12.5832V18.0832H6.41675V12.5832H0.916748ZM4.58342 16.2498H2.75008V14.4165H4.58342V16.2498ZM8.25008 6.1665V18.0832H13.7501V6.1665H8.25008ZM11.9167 16.2498H10.0834V7.99984H11.9167V16.2498Z" fill="#141414"/>
                  </svg>
                  شريك 
                  <?= ($package_term)? $package_term->name:''; ?>
                </span>
              </a>
              <div class="meta-user car-box-content">
                <h4 class="text-uppercase"><?= the_author_meta( 'display_name', $author_id ); ?></h4>
                <div class="information">
                  <span class="d-block"><i class="fas fa-map-marker-alt"></i> <?= ($cities_term)? $cities_term->name:'السعودية'; ?></span>
                  <span><i class="fas fa-car"></i> <?php printf( __( 'عدد السيارات: %s', 'textdomain' ), $query->found_posts ); ?></span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="text-center col-12">
        <a href="<?= $installment_page_link; ?>" class="btn btn-outline-dark rounded-0 py-2 px-4">كل المعارض</a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Brands -->
<section id="brands" class="section-brands py-5 bg-white">
  <div class="section-header">
    <h2 class="section-headline text-center font-bold">اختار ما بين مجموعة رائعة من العلامات التجارية</h2>
  </div>
  <div class="container mt-3">
    <div class="row">
      <?php 
        foreach ($brands  as $term): 
        $image = get_field('icon_term', $term);
          $term_link = get_term_link( $term );
          if ( is_wp_error( $term_link ) ) {
              continue;
          }
        ?>
        <div class="col-md-2 col-sm-3 col-3">
          <div class="card-brand">
            <div class="card-img-top p-lg-3">
              <div class="card">
                <a href="<?= $term_link; ?>">
                  <img src="<?= ($image)? $image:$placeholder; ?>" class="img-fluid" alt="<?= $term->name; ?>">
                </a>
              </div>
            </div>
            <span class="font-bold"><?= $term->name; ?></span>
            <span class="d-block">سيارة <?= $term->count; ?></span>
          </div>
        </div>
      <?php 
        endforeach; 
        ?>
    </div>
    <div class="text-center mt-5 mb-3">
      <a class="btn btn-outline-dark rounded-0 py-2 px-4" href="<?= $term_page_link; ?>">كل العلامات</a>
    </div> 
  </div>
</section>

<!-- cars USED -->
<?php 
  $headline = get_field('headline_cars_by_category_used');
  $cars     = get_field('category_cars_used');
  $category_cars = get_field('category_cars_taxonomy_used');
  $link = get_field('link_cars_by_category_used');
  $args = array(
    'post_type'      => array( 'cars'),
    'posts_per_page' => 6,
    'tax_query' => array(
      'relation' => 'AND',
      array(
          'taxonomy' => 'products-tag',
          'field'    => 'term_id',
          'terms'    => array($category_cars),
          'operator' => 'IN',
      ),
    ),
  );
  $query = new WP_Query( $args );
?>
<section id="section-cars-used" class="section-cars mt-3">
    <div class="cars-listing">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title"><?= $headline; ?></h2>
        </div>
        <div class="row">
          <?php
            if ( $cars ):
              foreach( $cars as $car ): 
                $img_url = get_the_post_thumbnail_url($car->ID,'medium');
                $author_id =  get_post_field( 'post_author', $car->ID );
                $avatar = get_field('user_logo', 'user_'. $author_id);
                $finance_price = get_field('finance_price', $car->ID);
            ?>
              <div class="col-lg-4 col-md-6 col-sm-6 col-6 mb-4">
                <div class="car-box car-offer">
                  <?php if(get_field('sold_done', $car->ID)): ?>
                    <div class="sold-done" style="position: absolute;z-index: 9;left: 15px;padding: 30px;bottom: 0;right: 15px;top: 0;pointer-events: none;">
                      <p><img class="img-fluid" src="<?= get_theme_file_uri().'/assets/img/pay_done.png' ?>" alt="تم البياع" /></p>
                    </div>
                  <?php endif; ?>
                  <div class="car-box-img position-relative">
                    <div class="car-box-head d-flex justify-content-between position-absolute">
                      <div class="car-box-head-right d-flex">
                        <div class="car-box-head-favorite">
                          <?php echo '<button class="favorite-button icon-box bg-white rounded-100 text-primary border-0 ' . (in_array($car->ID, $favorites) ? 'is_favorite' : '') . '" data-post-id="' . $car->ID . '" data-favorites="' . esc_attr(json_encode($favorites)) . '" data-is-favorite="' . (in_array($car->ID, $favorites) ? 'true' : 'false') . '">' . (in_array($car->ID, $favorites) ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>') . '</button>'; ?>
                        </div>
                        <div class="car-box-head-share icon-box bg-white rounded-100 text-primary">
                          <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.27816 12.073V3.20029L5.04516 4.47066L3.96629 3.33924L7.04879 0.16333L10.1313 3.33924L9.05241 4.47066L7.81941 3.20029V12.073H6.27816ZM0.883789 17.6308V5.72117H4.73691V7.30912H2.42504V16.0429H11.6725V7.30912H9.36066V5.72117H13.2138V17.6308H0.883789Z" fill="#D97E00"/>
                          </svg>                          
                        </div>
                      </div>                    
                    </div>
                    <a class="link-img" href="<?= get_permalink($car->ID); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title($car->ID); ?>"></a>
                  </div>
                  <div class="car-box-content position-relative p-lg-4 p-1">
                    <h4 class="text-uppercase"><?= get_the_title($car->ID); ?></h4>
                    <div class="information">
                      <p class="pricing">
                        <span class="new-price d-block"><?= the_field('price', $car->ID); ?> <?= the_field('currency_pricing', 'option'); ?></span>
                        <span>شامل الضريبة واللوحات</span>
                      </p>
                      <p>
                        <span class="author">
                          <a class="logo-author" href="#">
                            <img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>">
                          </a>
                          <span><?= the_author_meta( 'display_name', $author_id ); ?></span>
                          <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        </span>
                      </p>
                    </div>
                  </div>

                  <div class="car-box-footer bg-primary">
                    <span>قسط يبدأ من</span>
                    <span>|</span>
                    <span><?= $finance_price; ?></span>
                    <span>ريال/ شهريا</span>
                  </div>

                </div>
              </div>
            <?php 
              endforeach; 
          else:
            if ( $query->have_posts() ):
              while ( $query->have_posts() ):
                $query->the_post();
                $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
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
                  <div class="car-box-content position-relative p-lg-4 p-1">
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
                          <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                        </span>
                      </p>
                    </div>
                  </div>
                  <div class="car-box-footer bg-dark">
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
          <?php endif; ?>
        </div>
      </div>
    </div>
</section>

<!-- Services -->
<?php
  $headlineServices = get_field('headline_services');
  $contentServices = get_field('content_services');
  $bgServices = get_field('bg_services');
?>
<section id="section-services" class="section-services mt-3">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8 col-12">
        <img class="img-fluid" src="<?= $bgServices; ?>" alt="<?= $headlineServices; ?>">
      </div>
      <div class="col-md-4 col-12">
        <h3 class="section-headline headline-border font-bold"><?= $headlineServices; ?></h3>
        <div class="section-content">
          <?= $contentServices; ?>
        </div>
      </div>
    </div>
    <div class="section-header">
      <h2 class="section-title">ليش تشتري منا</h2>
    </div>
    <div class="row">
      <?php 
      if( have_rows('steps_about_us') ):
        while( have_rows('steps_about_us') ) : the_row();
        $img = get_sub_field('icon_step');
        $headline = get_sub_field('headline_step');
        $content_step = get_sub_field('content_step');
        ?>
        <div class="col-md-3 col-sm-6 col-12 box-card">
          <div class="box-services">
            <img class="box-services-img" src="<?= $img; ?>" alt="<?= $headline; ?>">
            <div class="box-services-content">
              <h5 class="font-bold"><?= $headline; ?></h5>
              <span><?= $content_step; ?></span>
            </div>
          </div>
        </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</section>

<!-- App -->
<?php
  $headline_app = get_field('headline_app');
  $sub_sheadline_app = get_field('sub_sheadline_app');
  $link_app_ios = get_field('link_app_ios');
  $link_app_android = get_field('link_app_android');
  $image_app = get_field('image_app');
?>
<section id="section-app" class="section-app mt-5">
  <div class="container">
    <div class="row m-lg-0 align-items-center justify-content-center section-app-container" style="background-image:url(<?= $image_app; ?>);">
      <div class="col-md-5 col-12 text-center">
        <h3 class="section-headline"><?= $headline_app; ?></h3>
        <div class="section-content">
          <?= $sub_sheadline_app; ?>
        </div>
        <div class="section-action mt-3">
          <a class="btn btn-outline-dark px-4 py-3 mx-2" href="<?= $link_app_android; ?>">
            <span class="my-2">حمل من متجر بلاي</span>
            <svg width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.80702 11.9131L0.0872752 22.0213C0.196399 22.4052 0.392527 22.7594 0.660667 23.0566C0.928807 23.3538 1.26186 23.5862 1.63436 23.7361C2.00687 23.886 2.40896 23.9493 2.80991 23.9213C3.21086 23.8932 3.60004 23.7746 3.94771 23.5744L14.8845 17.3915L9.80702 11.9131Z" fill="#EA4335"/>
              <path d="M19.6358 10.1947L14.9061 7.506L9.58247 12.1433L14.9277 17.3769L19.6214 14.7169C20.0372 14.5008 20.3855 14.1759 20.6285 13.7773C20.8715 13.3787 21 12.9217 21 12.4558C21 11.9899 20.8715 11.5329 20.6285 11.1344C20.3855 10.7358 20.0372 10.4108 19.6214 10.1947H19.6358Z" fill="#C79400"/>
              <path d="M0.087044 2.84003C0.0282527 3.05568 -0.00101599 3.27821 2.6916e-05 3.50161V21.3599C0.000715706 21.5832 0.0301057 21.8054 0.0872752 22.0213L10.1402 12.1722L0.087044 2.84003Z" fill="#4285F4"/>
              <path d="M9.87957 12.4306L14.9061 7.506L3.98353 1.29465C3.57259 1.05567 3.10518 0.929062 2.62891 0.927738C2.05391 0.926753 1.49435 1.11238 1.0355 1.45634C0.576643 1.8003 0.243656 2.28373 0.0872752 2.83296L9.87957 12.4306Z" fill="#34A853"/>
            </svg>
          </a>
          <a class="btn btn-outline-dark px-4 py-3 mx-2" href="<?= $link_app_ios; ?>">
            <span class="my-2">حمل من متجر أبل</span>
            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.6638 21.0049C15.3716 22.2187 13.9606 22.027 12.6024 21.4521C11.1651 20.8644 9.84643 20.8389 8.32999 21.4521C6.43114 22.2442 5.42897 22.0143 4.29493 21.0049C-2.14006 14.5785 -1.19063 4.79199 6.11466 4.43426C7.89483 4.52369 9.13436 5.3797 10.1761 5.45635C11.7321 5.14973 13.2222 4.26817 14.8837 4.38316C16.8748 4.53647 18.3781 5.30304 19.3671 6.68287C15.2529 9.07201 16.2287 14.323 20 15.7923C19.2484 17.7087 18.2726 19.6123 16.6506 21.0177L16.6638 21.0049ZM10.0442 4.3576C9.84643 1.50852 12.2332 -0.842295 14.976 -1.07227C15.3584 2.22398 11.8903 4.67701 10.0442 4.3576Z" fill="black"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  
  </div>
</section>

<!-- Testimonial -->
<section id="section-testimonial" class="section-testimonial mt-5">
  <div class="container-fluid">
    <div class="row">
      <h3 class="section-headline text-white font-bold mb-4">عملاء سعداء</h3>
      <div class="owl-carousel owl-theme owl-testimonials">
        <?php 
        if( have_rows('testimonials') ):
          $counter = 0;
          while( have_rows('testimonials') ) : the_row();
          $counter++;
          $name_of_testimonials = get_sub_field('name_of_testimonials');
          $video_of_testimonials = get_sub_field('video_of_testimonials');
          $date_of_testimonials = get_sub_field('date_of_testimonials');
          $image_of_testimonials = get_sub_field('image_of_testimonials');
          ?>
          <div class="box-testimonials">
            <!-- Button trigger modal -->
            <div class="embed-responsive embed-responsive-16by9">
              <iframe src="<?= $video_of_testimonials; ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <h4><?= $name_of_testimonials; ?></h4>
            <p><?= $date_of_testimonials; ?></p>
          </div>
        <?php
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </div>
</section>

<!-- banks -->
<?php 
  $headline_banks = get_field('headline_banks');
  $image_banks = get_field('image_banks');
  ?>
<section id="section-banks" class="section-banks mt-5">
  <div class="container">
    <h3 class="section-title text-center font-bold"><?= $headline_banks; ?></h3>
    <div class="row">      
      <img class="img-fluid" src="<?= $image_banks; ?>" alt="<?= $headline_banks; ?>">
    </div>
  </div>
</section>

<!-- contact us -->
<section id="section-contact" class="section-contact mt-5 mb-5">
  <div class="container">
    <h3 class="section-title text-center font-bold">تواصل معنا</h3>
    <div class="row">      
      <?php 
      if( have_rows('contact_us_boxs') ):
        while( have_rows('contact_us_boxs') ) : the_row();
        $title_boxs = get_sub_field('title_boxs');
        $text_boxs = get_sub_field('text_boxs');
        $url_boxs = get_sub_field('url_boxs');
        $text_url_boxs = get_sub_field('text_url_boxs');
        ?>
        <div class="col-md-4 col-12 box-card">
          <div class="box-services d-flex align-items-center bg-gray">
            <div class="box-services-content d-flex align-items-center flex-column">
              <h5 class="col-12 text-right font-bold h1 mb-4"><?= $title_boxs; ?></h5>
              <span class="col-12 mb-auto text-right mb-4"><?= $text_boxs; ?></span>
              <a class="btn btn-outline-dark py-2 px-4 mt-5" href="<?= $url_boxs; ?>"><?= $text_url_boxs; ?></a>
            </div>
          </div>
        </div>
      <?php
        endwhile;
      endif;
      ?>
    </div>
  </div>
</section>

<script type="text/javascript">
  jQuery(function ($) {
      $('.owl-offers').owlCarousel({
        loop:true,
        rtl:true,
        margin:10,
        nav:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:2
          },
          1000:{
            items:3
          }
        }
    });

    $('.owl-testimonials').owlCarousel({
        loop:true,
        rtl:true,
        margin:10,
        nav:true,
        responsive:{
          0:{
            items:1
          },
          600:{
            items:2
          },
          1000:{
            items:4
          }
        }
    });


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
?>