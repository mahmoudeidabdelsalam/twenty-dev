<?php
/**
 * The Template for displaying TaxonomyTag pages.
 */

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$search   = isset($_GET['search']) ? $_GET['search'] : '0';
$package  = isset($_GET['package']) ? $_GET['package'] : '0';
$city     = isset($_GET['city']) ? $_GET['city'] : '0';


$tag_term = $wp_query->get_queried_object();
$banner = get_field('icon_term', $tag_term);


$taxonomies_package = get_terms( array(
  'taxonomy' => 'realestate-package',
  'hide_empty' => false,
  'parent'   => 0
) );

$taxonomies_cities = get_terms( array(
  'taxonomy' => 'realestate-cities',
  'hide_empty' => false,
  'parent'   => 0
) );


$args = array(
  'post_type'         => array( 'car-show' ),
  'posts_per_page'    => 9,
  'paged'             => $paged,
);

$args['tax_query'] = array(
  'relation' => 'AND',
  array(
    'taxonomy' => 'show-type',
    'field'    => 'term_id',
    'terms'    => $tag_term->term_id,
  ),
);

if($search != '0' && $package == '0' && $city == '0') {
  $args['s'] = $search;
}

if($search != '0' && $package != '0' && $city == '0') {
  $args['s'] = $search;
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'realestate-package',
      'field'    => 'term_id',
      'terms'    => $package,
    ),
  );  
}

if($search != '0' && $package == '0' && $city != '0') {
  $args['s'] = $search;
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'realestate-cities',
      'field'    => 'term_id',
      'terms'    => $city,
    ),
  );  
}

if($search != '0' && $package != '0' && $city != '0') {
  var_dump('test');
  $args['s'] = $search;
  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'realestate-cities',
      'field'    => 'term_id',
      'terms'    => $city,
    ),
    array(
      'taxonomy' => 'realestate-package',
      'field'    => 'term_id',
      'terms'    => $package,
    ),
  );  
}

$query = new WP_Query( $args );
?>

<section class="container-fluid p-0">
  <div class="row m-0">
    <?php if($banner): ?>
      <img class="img-fluid" src="<?= $banner; ?>" alt="<?= $tag_term->name; ?>">
    <?php endif; ?>
  </div>
</section>

<section class="container mt-5 mb-5">
  <div class="row">   
    <div class="col-md-12 col-12 position-relative">
      <div class="row" id="cars">

        <!-- Start of the loop -->
        <div class="filter col-12 mb-5">
          <form class="row g-3">
            <div class="col-12 col-md-3">
              <span class="form-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M20.9999 21L16.6499 16.65" stroke="#323232" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <input type="search" name="search" class="form-control" placeholder="بحث عن معرض" id="Search" <?= ($search)? 'value="'.$search.'"':'';?>>
            </div>
            <div class="col-12 col-md-3">
              <span class="form-icon">
                <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.6667 15.1667H16.3333V12.8333H18.6667M18.6667 19.8333H16.3333V17.5H18.6667M11.6667 5.83333H9.33333V3.5H11.6667M11.6667 10.5H9.33333V8.16667H11.6667M11.6667 15.1667H9.33333V12.8333H11.6667M11.6667 19.8333H9.33333V17.5H11.6667M4.66667 10.5H2.33333V8.16667H4.66667M4.66667 15.1667H2.33333V12.8333H4.66667M4.66667 19.8333H2.33333V17.5H4.66667M14 10.5V3.5L10.5 0L7 3.5V5.83333H0V22.1667H21V10.5H14Z" fill="#3E3E3E"/>
                </svg>
              </span>
              <select class="form-select" name="city">
                <option value="0">فلترة حسب المدينة</option>
                <?php foreach ($taxonomies_cities as $term_cities): ?>
                  <option value="<?= $term_cities->term_id; ?>" <?= ($term_cities->term_id == $city)? 'selected':'';?>><?= $term_cities->name; ?></option>
                <?php endforeach; ?>                
              </select>
            </div>
            <div class="col-12 col-md-3">
              <span class="form-icon">
                <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M18.3332 6.24913L20.579 7.61496L19.9832 5.03913L21.9998 3.31579L19.3507 3.08663L18.3332 0.666626L17.2973 3.08663L14.6665 3.31579L16.6648 5.03913L16.0415 7.61496L18.3332 6.24913ZM21.0832 18.0833H15.5832V8.91663H21.0832V18.0833ZM0.916504 12.5833V18.0833H6.4165V12.5833H0.916504ZM4.58317 16.25H2.74984V14.4166H4.58317V16.25ZM8.24984 6.16663V18.0833H13.7498V6.16663H8.24984ZM11.9165 16.25H10.0832V7.99996H11.9165V16.25Z" fill="#3E3E3E"/>
                </svg>
              </span>
              <select class="form-select" name="package">
                <option value="0">فلترة حسب التصنيف</option>
                <?php foreach ($taxonomies_package as $term_package): ?>
                  <option value="<?= $term_package->term_id; ?>" <?= ($term_package->term_id == $package)? 'selected':'';?>><?= $term_package->name; ?></option>
                <?php endforeach; ?>                
              </select>
            </div>              
            <div class="col-12 col-md-3">
              <button type="submit" class="btn btn-primary mb-3">بحث</button>
            </div>
          </form>
        </div>

        <?php
        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            $author_id = get_the_author_meta('ID');
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $background = get_field('user_background', 'user_'. $author_id);
            $term_package_list = get_the_terms( get_the_ID(), 'realestate-package' );
            $terms_package = join(', ', wp_list_pluck($term_package_list, 'name')); 
            $user_address = get_field('user_address', 'user_'. $author_id);
            $cars = new WP_Query( array( 'author' => $author_id, 'post_type' => 'cars' ) );    
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="showroom car-box">
            <a class="logo-author" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($background)? $background:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
            <div class="meta-user car-box-content">
              <h4 class="mt-3"><?= the_author_meta( 'display_name', $author_id ); ?></h4>
              <div class="information d-flex flex-column">
                <span>
                  <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18.6784 8.89243C18.5378 6.89852 18.3061 6.5102 18.2186 6.36414C18.0174 6.02664 17.6956 5.80609 17.3549 5.57467C17.3357 5.56181 17.319 5.54346 17.3064 5.52109C17.2937 5.49871 17.2853 5.47292 17.2818 5.44574C17.2784 5.41856 17.28 5.39075 17.2865 5.36448C17.293 5.33822 17.3043 5.31423 17.3194 5.29441C17.3825 5.2136 17.431 5.1165 17.4615 5.00977C17.492 4.90305 17.5039 4.78923 17.4963 4.67615C17.4817 4.47563 17.4078 4.28941 17.2895 4.15441C17.1712 4.01942 17.0171 3.94552 16.8577 3.94737H16.2483C16.2222 3.94756 16.1961 3.94971 16.1702 3.95378C16.1524 3.94404 16.134 3.93628 16.1151 3.93059C15.7542 2.96694 15.26 1.64753 14.2358 1.00362C12.7167 0.049342 9.91822 0 9.37135 0C8.82447 0 6.02604 0.049342 4.50885 1.00214C3.48463 1.64605 2.99049 2.96546 2.62955 3.92911L2.62643 3.93701C2.60843 3.94021 2.59075 3.94583 2.57369 3.95378C2.54777 3.94971 2.52169 3.94756 2.49557 3.94737H1.88502C1.7256 3.94552 1.57146 4.01942 1.45316 4.15441C1.33486 4.28941 1.26104 4.47563 1.24635 4.67615C1.23941 4.78897 1.25184 4.90235 1.28278 5.00854C1.31373 5.11473 1.36246 5.21123 1.42565 5.29145C1.44076 5.31127 1.45203 5.33526 1.45855 5.36152C1.46507 5.38778 1.46667 5.4156 1.46322 5.44278C1.45977 5.46996 1.45137 5.49575 1.43868 5.51813C1.42599 5.5405 1.40936 5.55885 1.3901 5.57171C1.04947 5.80461 0.726037 6.02516 0.526428 6.36118C0.438928 6.50921 0.207678 6.89556 0.066662 8.88947C-0.011463 10.0115 -0.0231818 11.173 0.0381463 11.9211C0.166662 13.4753 0.407678 14.4148 0.417834 14.4538C0.454818 14.5956 0.522896 14.7213 0.614166 14.8163C0.705435 14.9112 0.816151 14.9715 0.933459 14.9901V15C0.933459 15.2094 0.999307 15.4102 1.11652 15.5582C1.23373 15.7063 1.3927 15.7895 1.55846 15.7895H3.74596C3.91172 15.7895 4.07069 15.7063 4.1879 15.5582C4.30511 15.4102 4.37096 15.2094 4.37096 15C4.70729 15 4.94127 14.924 5.18932 14.8431C5.54744 14.7212 5.91349 14.6401 6.28307 14.6008C7.47487 14.4572 8.66002 14.4079 9.37135 14.4079C10.0682 14.4079 11.3057 14.4572 12.4995 14.6008C12.8705 14.6402 13.238 14.7216 13.5975 14.8441C13.835 14.9211 14.0604 14.9921 14.3725 14.9995C14.3725 15.2089 14.4384 15.4097 14.5556 15.5577C14.6728 15.7058 14.8318 15.789 14.9975 15.789H17.185C17.3508 15.789 17.5098 15.7058 17.627 15.5577C17.7442 15.4097 17.81 15.2089 17.81 14.9995V14.9936C17.9276 14.9753 18.0387 14.9152 18.1302 14.8202C18.2218 14.7252 18.2901 14.5994 18.3272 14.4572C18.3374 14.4183 18.5784 13.4788 18.7069 11.9245C18.7682 11.176 18.7573 10.0164 18.6784 8.89243ZM3.75924 4.60411C4.07174 3.7653 4.42916 2.81595 5.06549 2.41579C5.98502 1.8375 7.89088 1.57697 9.37135 1.57697C10.8518 1.57697 12.7577 1.83553 13.6772 2.41579C14.3135 2.81595 14.6694 3.76579 14.9835 4.60411L15.0225 4.71118C15.0454 4.77214 15.0555 4.83947 15.0519 4.90676C15.0482 4.97404 15.031 5.03904 15.0019 5.09554C14.9728 5.15205 14.9326 5.19818 14.8854 5.22954C14.8381 5.2609 14.7853 5.27643 14.7319 5.27467C13.4339 5.23026 10.6995 5.08816 9.37135 5.08816C8.04322 5.08816 5.30885 5.23372 4.00885 5.27812C3.95548 5.27989 3.90264 5.26435 3.85537 5.23299C3.80811 5.20163 3.76799 5.1555 3.73884 5.099C3.7097 5.04249 3.6925 4.9775 3.68889 4.91021C3.68528 4.84293 3.69538 4.77559 3.71822 4.71464C3.7319 4.67813 3.74635 4.64112 3.75924 4.60411ZM4.22526 8.53322C3.5533 8.63538 2.87706 8.6858 2.20026 8.68421C1.78619 8.68421 1.35924 8.53618 1.27994 8.0704C1.22565 7.75707 1.23151 7.58092 1.2608 7.40378C1.28541 7.25329 1.32447 7.14375 1.51979 7.10526C2.0276 7.00658 2.31158 7.13043 3.14283 7.4398C3.69401 7.64457 4.09166 7.91743 4.31822 8.13355C4.4319 8.24013 4.37135 8.51842 4.22526 8.53322ZM12.8729 12.5793C12.3588 12.6533 11.3307 12.6262 9.38307 12.6262C7.43541 12.6262 6.40768 12.6533 5.89362 12.5793C5.36315 12.5048 4.68697 11.8712 5.14869 11.3067C5.45611 10.9347 6.1733 10.6564 7.12838 10.5C8.08346 10.3436 8.48776 10.2632 9.37916 10.2632C10.2706 10.2632 10.6339 10.3125 11.6299 10.5005C12.626 10.6885 13.3788 10.9702 13.6096 11.3072C14.0307 11.9112 13.403 12.5008 12.8729 12.5822V12.5793ZM17.4628 8.0699C17.3846 8.53766 16.9549 8.68372 16.5424 8.68372C15.8527 8.68392 15.1635 8.63351 14.4784 8.53273C14.3588 8.51842 14.3034 8.25345 14.4245 8.13306C14.6475 7.91151 15.0495 7.64408 15.5999 7.43931C16.4311 7.12993 16.9104 7.00609 17.3221 7.10921C17.4225 7.13438 17.4756 7.27056 17.4819 7.35592C17.5094 7.59361 17.503 7.83561 17.4628 8.0704V8.0699Z" fill="#3E3E3E"/>
                  </svg>
                  <?= $terms_package; ?> 
                </span>
                <span>
                  <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 9.025C6.33696 9.025 5.70107 8.77478 5.23223 8.32938C4.76339 7.88398 4.5 7.27989 4.5 6.65C4.5 6.02011 4.76339 5.41602 5.23223 4.97062C5.70107 4.52522 6.33696 4.275 7 4.275C7.66304 4.275 8.29893 4.52522 8.76777 4.97062C9.23661 5.41602 9.5 6.02011 9.5 6.65C9.5 6.96189 9.43534 7.27073 9.3097 7.55887C9.18406 7.84702 8.99991 8.10884 8.76777 8.32938C8.53562 8.54992 8.26002 8.72486 7.95671 8.84421C7.65339 8.96357 7.3283 9.025 7 9.025ZM7 0C5.14348 0 3.36301 0.700623 2.05025 1.94774C0.737498 3.19486 0 4.88631 0 6.65C0 11.6375 7 19 7 19C7 19 14 11.6375 14 6.65C14 4.88631 13.2625 3.19486 11.9497 1.94774C10.637 0.700623 8.85652 0 7 0Z" fill="#3E3E3E"/>
                  </svg>
                  <?= $user_address; ?>
                </span>
                <span>
                  <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1196_10237)">
                      <path d="M17.5 8.82875L19.6438 10.1325L19.075 7.67375L21 6.02875L18.4713 5.81L17.5 3.5L16.5113 5.81L14 6.02875L15.9075 7.67375L15.3125 10.1325L17.5 8.82875ZM20.125 20.125H14.875V11.375H20.125V20.125ZM0.875 14.875V20.125H6.125V14.875H0.875ZM4.375 18.375H2.625V16.625H4.375V18.375ZM7.875 8.75V20.125H13.125V8.75H7.875ZM11.375 18.375H9.625V10.5H11.375V18.375Z" fill="#3E3E3E" />
                    </g>
                    <defs>
                      <clipPath id="clip0_1196_10237">
                        <rect width="21" height="21" fill="white" />
                      </clipPath>
                    </defs>
                  </svg>                  
                  <?php printf( __( 'عدد السيارات: %s', 'textdomain' ), $cars->found_posts ); ?>
                </span>
              </div>
            </div>
          </div>
        </div>
        <?php 
          endwhile;
        endif;
        ?>
        <div class="col-md-12 mt-5"><?php echo custom_base_pagination(array(), $query); ?></div>
        <?php wp_reset_postdata(); ?>
      </div>
        
    </div>  
  </div>
</section>




<?php
get_footer();