<?php
get_header();

$get_basic_specifications = get_field('id_basic_specifications');
$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';

$user_id = get_current_user_id();
$favorites = get_user_meta($user_id, 'favorites', true) ;
if( !$favorites ){
    $favorites = [];
}

$img_tag    = get_theme_file_uri().'/assets/img/tag.svg';
$img_eye    = get_theme_file_uri().'/assets/img/eye.svg';
$img_offer  = get_theme_file_uri().'/assets/img/offer.svg';

$car_id = get_the_ID();
$author_id = get_post_field( 'post_author', $car_id );

$show = new WP_Query( array( 'author' => $author_id, 'post_type' => 'car-show' ) );

$query = new WP_Query ( array( 'post_type' => 'basic_specifications', 'post__in' => array($get_basic_specifications) ) );

if ($query->have_posts()):
  while ($query->have_posts()):
    $query->the_post();
    
    // by car id
    $featured_img_url = (get_the_post_thumbnail_url($car_id,'full'))? get_the_post_thumbnail_url($car_id,'full'):get_the_post_thumbnail_url(get_the_ID(),'full');
    $car_price = get_field('price', $car_id );
    $price_offer = get_field('price_offer', $car_id);
    $finance_price = get_field('finance_price', $car_id);
    $galleries = get_field('car_galleries', $car_id);
    
    // by basic id
    $images = get_field('car_galleries');
    
    $user_phone = get_field('user_phone', 'user_'. $author_id);
    $user_whatsapp = get_field('user_whatsapp', 'user_'. $author_id);
    $installment = get_field('vendor_cars_installment', 'user_'. $author_id);
    $user_logo = get_field('user_logo', 'user_'. $author_id);
    // Terms by basic id
    $term_obj_list = get_the_terms( get_the_ID(), 'basic-brand' );
    $brands = join(', ', wp_list_pluck($term_obj_list, 'name'));
    $term_fuel_list = get_the_terms( get_the_ID(), 'fuel-type' );
    $fuels = join(', ', wp_list_pluck($term_fuel_list, 'name'));
    $term_gear_list = get_the_terms( get_the_ID(), 'gear-type' );
    $gears = join(', ', wp_list_pluck($term_gear_list, 'name'));
    $term_push_list = get_the_terms( get_the_ID(), 'push-type' );
    $pushs = join(', ', wp_list_pluck($term_push_list, 'name'));
    $term_cylinders_list = get_the_terms( get_the_ID(), 'cylinders-type' );
    $cylinders = join(', ', wp_list_pluck($term_cylinders_list, 'name'));
    $term_engine_list = get_the_terms( get_the_ID(), 'engine-type' );
    $engines = join(', ', wp_list_pluck($term_engine_list, 'name')); 
    $term_color_list = get_the_terms( get_the_ID(), 'color-type' );
    $color = join(', ', wp_list_pluck($term_color_list, 'name')); 
    // Term by car id
    $term_tag_list = get_the_terms( $car_id, 'products-tag' );
    $tag = join(', ', wp_list_pluck($term_tag_list, 'name')); 
    $term_model_list = get_the_terms( $car_id, 'products-model' );
    $model = join(', ', wp_list_pluck($term_model_list, 'name')); 
    $term_structure_list = get_the_terms( $car_id, 'structure-type' );
    $structure = join(', ', wp_list_pluck($term_structure_list, 'name'));
    $term_link = wp_custom_tag_terms_links($car_id);
    $post_views = c95_get_post_views($car_id);

    // conditions Car Details
    $items = ($galleries)? $galleries:$images;

    $clear_price = str_replace(".", "", $car_price);
    $percentage = (15 / 100) * $clear_price;

    $avatar = get_field('user_logo', 'user_'. $author_id);
  ?> 

  <!-- Page Header Start -->
  <div class="page-header mb-3 bg-orange">
    <div class="container">
      <h1 class="text-dark mb-3 font-bold"><?= the_title(); ?></h1>
      <p class="text-lg"><img src="<?= $img_tag; ?>" alt="<?= $tag; ?>"> <?= $tag; ?></p>
      <p class="text-lg"><img src="<?= $img_eye; ?>" alt="المشاهدات"> <span>عدد المشاهدات :</span> <?= $post_views; ?></p>
    </div>
  </div>

  <!-- Page breadcrumb -->
  <div class="breadcrumb d-none d-lg-block d-md-block">
    <div class="container">
      <div class="d-inline-flex">
        <h6 class="text-dark m-0"><a class="text-dark" href="<?php echo esc_url(home_url('/')); ?>">الرئيسية</a></h6>
        <h6 class="text-dark m-0 px-1">/</h6>
        <h6 class="text-dark m-0 px-1"><?= $term_link; ?></h6>
        <h6 class="text-dark m-0 px-1">/</h6>
        <h6 class="text-dark m-0"><?= the_title(); ?></h6>
      </div>
    </div>
  </div>


  <div class="main-single">
    <div class="container">
      <div class="row">
        <!-- Single Car Details Content Start-->
        <div class="col-md-8 col-12 content-page">
          <!-- Carousel wrapper -->
          <div id="carouselBasicCar" class="carousel slide carousel-fade carousel-single">
            <div class="carousel-indicators">
              <?php 
              if($items):
                $slide = -1;
                foreach( $items as $item ): 
                  $slide++;
              ?>
                <button type="button" data-bs-target="#carouselBasicCar" data-bs-slide-to="<?= $slide; ?>" class="<?= ($slide == '0')? 'active':'';?>" aria-current="true" aria-label="slide <?= $slide; ?>"></button>
              <?php
                endforeach;
              endif;
              ?>
            </div>
            <div class="carousel-inner">
              <?php 
              if($items):
                $slide = -1;
                foreach( $items as $item ): 
                  $slide++;
                ?>
                <div class="carousel-item <?= ($slide == 0)? 'active':''; ?>">
                  <img src="<?= $item['url']; ?>" class="d-block w-100" alt="<?= the_title(); ?>" />
                </div>
                <?php
                endforeach;
              endif;
              ?>              
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselBasicCar" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselBasicCar" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        
          <!-- SideBar Car mobile -->
          <div class="col-12 d-lg-none d-md-none d-block mt-3">
            <div class="alert alert-warning" role="alert">
              <?php if(get_post_field('post_content', $car_id)): ?>
                <?= get_post_field('post_content', $car_id); ?>
              <?php else: ?>
                <h3 style="text-align: right;">لماذا هذه السيارة مناسبة لك ؟</h3>
                <p style="text-align: right;"><strong>لانها تحتوي علي : </strong></p>
                <p style="text-align: right;">مثبت سرعة - تبريد وتدفئة للمقاعد - بلوتوث - كاميرا خلفية</p>
              <?php endif; ?>
            </div>
            <div class="d-flex flex-row">
              <div class="cash-money box-price mb-2">
                <h3><img src="<?= get_theme_file_uri().'/assets/img/price.svg'; ?>" alt="السعر كاش"> السعر كاش</h3>
                <div class="priceing">
                  <p>قبل الضريبة</p>
                  <strong class="d-block"><?= ($car_price - $percentage); ?> <?= the_field('currency_pricing', 'option'); ?></strong>
                  <p>بعد الضريبة</p>
                  <strong class="text-green d-block"><?= ($price_offer)? $price_offer:$car_price; ?> <?= the_field('currency_pricing', 'option'); ?></strong>
                  <?php if($price_offer):?><span class="old-price"><?= $car_price; ?> <?= the_field('currency_pricing', 'option'); ?></span><?php endif; ?>              
                  <a class="btn btn-success text-white w-100" href="/buying/?car=<?= $car_id; ?>">شراء هذة السيارة <i class="fas fa-arrow-left"></i></a>
                </div>
              </div>
              <div class="cash-money box-price mb-2">
                <h3><img src="<?= get_theme_file_uri().'/assets/img/calendar.svg'; ?>" alt="قسط يبدأ من"> قسط يبدأ من</h3>
                <div class="priceing">
                  <p>القسط شهريا</p>
                  <strong class="text-green d-block"><?= $finance_price; ?></strong>
                  <p>مدة القسط</p>
                  <b>60</b> <small>شهر</small>
                  <a class="btn btn-dark text-white w-100" href="/financing/?car=<?= $car_id; ?>">طلب تمويل للسيارة <i class="fas fa-arrow-left"></i></a>
                </div>
              </div>
            </div>
            <!-- information author  -->
            <div class="accordion accordion-author bg-light" id="informationAuthor">
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed text-center font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    تواصل معنا عن طريق
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#informationAuthor">
                  <div class="accordion-body">
                    <div class="d-flex-inline bg-darken rounded-2 text-white p-4">
                      <i class="fas fa-phone fa-lg ms-2"></i> <span class="font-bold">اتصل</span> <a class="text-white float-left" href="tel:<?= $user_phone; ?>"><?= $user_phone; ?></a>
                    </div>
                    <div class="d-flex-inline bg-green text-white p-4 mt-2 rounded-2">
                      <i class="fab fa-whatsapp fa-lg ms-2"></i> <span class="font-bold">واتساب</span> <a class="text-white float-left" target="_blank" href="https://wa.me/+<?= $user_whatsapp; ?>"><?= $user_whatsapp; ?></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Share & actions -->
            <div class="d-flex flex-row">
              <a class="btn btn-outline-light border-0 shadow-0 text-dark w-100 p-3" href="#">
                <?php echo '<button class="favorite-button icon-box bg-white rounded-100 text-primary border-0 ' . (in_array(get_the_ID(), $favorites) ? 'is_favorite' : '') . '" data-post-id="' . get_the_ID() . '" data-favorites="' . esc_attr(json_encode($favorites)) . '" data-is-favorite="' . (in_array(get_the_ID(), $favorites) ? 'true' : 'false') . '">' . (in_array(get_the_ID(), $favorites) ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>') . '</button>'; ?>
                <span>إضافة للمفضلة</span>
              </a>
              <button type="button" class="btn btn-outline-light border-0 shadow-0 text-dark w-100 p-3" data-bs-toggle="modal" data-bs-target="#ShareMeta">
                <svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7 16.3636V4.17273L5.4 5.91818L4 4.36364L8 0L12 4.36364L10.6 5.91818L9 4.17273V16.3636H7ZM0 24V7.63636H5V9.81818H2V21.8182H14V9.81818H11V7.63636H16V24H0Z" fill="#D97E00"/>
                </svg>
                <span>مشاركة الأعلان</span>
              </button>
            </div>
            <!-- number ads cars -->
            <div class="alert alert-light border-top-0 border-start-0 border-end-0 border-dark">
              <p class="text-lg"><img src="<?= get_theme_file_uri().'/assets/img/number-ads.svg'; ?>" alt="رقم الأعلان"> <span class="mx-2">رقم الأعلان:</span> <?= $car_id; ?></p>
            </div>
          </div>      

          <!-- Colos Car -->
          <div class="box-colors mt-3 border-dark border border-bottom-1 border-top-0 border-start-0 border-end-0">
            <h5 class="font-bold">الألوان الخارجية المتاحة</h5>
            <p><?= $color; ?></p>
          </div>
          <!-- Specifications Car -->
          <div class="specifications mt-5 mb-5">
            <h4 class="font-bold text-primary mb-3">معلومات عن السيارة</h4>
            <ul class="nav nav-pills nav-fill bg-dark p-0" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="car-basic-tab" data-bs-toggle="pill" data-bs-target="#car-basic" type="button" role="tab" aria-controls="car-basic" aria-selected="true">التفاصيل الأساسية</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="car-safety-tab" data-bs-toggle="pill" data-bs-target="#car-safety" type="button" role="tab" aria-controls="car-safety" aria-selected="false">الأمان</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="car-comforts-tab" data-bs-toggle="pill" data-bs-target="#car-comforts" type="button" role="tab" aria-controls="car-contact" aria-selected="false">الراحة</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="car-techniques-tab" data-bs-toggle="pill" data-bs-target="#car-techniques" type="button" role="tab" aria-controls="car-techniques" aria-selected="false">التقنيات</button>
              </li> 
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="car-external-tab" data-bs-toggle="pill" data-bs-target="#car-external" type="button" role="tab" aria-controls="car-external" aria-selected="false">تجهيزات خارجية</button>
              </li>                            
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="car-basic" role="tabpanel" aria-labelledby="car-basic-tab">
                <div class="row">
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-brand.svg'; ?>" alt="العلامة التجارية:"> <b>العلامة التجارية:</b> <strong><?= $brands; ?></strong></p>
                  </div>
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-model.svg'; ?>" alt="الموديل"> <b>الموديل:</b> <strong><?= $model; ?></strong></p>
                  </div>
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-color.svg'; ?>" alt=""> <b>اللون:</b> <strong><?= $color; ?></strong></p>
                  </div>
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-fuels.svg'; ?>" alt=""> <b>نوع الوقود:</b> <strong><?= $fuels; ?></strong></p>
                  </div>
                  
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-gear.svg'; ?>" alt=""> <b>نوع القير:</b> <strong><?= $gears; ?></strong></p>
                  </div>
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-pushs.svg'; ?>" alt=""> <b>نوع الدفع:</b> <strong><?= $pushs; ?></strong></p>
                  </div>
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-cylinders.svg'; ?>" alt=""> <b>عدد السلنرات:</b> <strong><?= $cylinders; ?></strong></p>
                  </div>
                  <div class="col-md-6 col-12">
                    <p><img src="<?= get_theme_file_uri().'/assets/img/icon-engines.svg'; ?>" alt=""> <b>حجم المحرك:</b> <strong><?= $engines; ?></strong></p>
                  </div>                                                                        
                </div>
              </div>
              <div class="tab-pane fade" id="car-safety" role="tabpanel" aria-labelledby="car-safety-tab">
                <div class="row">
                  <?php
                  if( have_rows('specifications') ):
                    while( have_rows('specifications') ) : the_row();
                  ?>
                    <div class="col-md-6 col-12">
                      <span><?= the_sub_field('text_specifications'); ?></span>
                    </div>
                  <?php 
                    endwhile; 
                  endif; ?>
                </div>
              </div>
              <div class="tab-pane fade" id="car-comforts" role="tabpanel" aria-labelledby="car-comforts-tab">
                <div class="row">
                <?php
                if( have_rows('specifications_comforts') ):
                  while( have_rows('specifications_comforts') ) : the_row();
                ?>
                  <div class="col-md-6 col-12">
                    <span><?= the_sub_field('text_specifications'); ?></span>
                  </div>
                <?php 
                  endwhile; 
                endif; ?> 
                </div>               
              </div>
              <div class="tab-pane fade" id="car-techniques" role="tabpanel" aria-labelledby="car-techniques-tab">
                <div class="row">
                <?php
                if( have_rows('specifications_technologies') ):
                  while( have_rows('specifications_technologies') ) : the_row();
                ?>
                  <div class="col-md-6 col-12">
                    <span><?= the_sub_field('text_specifications'); ?></span>
                  </div>
                <?php 
                  endwhile; 
                endif; ?>   
                </div>             
              </div>
              <div class="tab-pane fade" id="car-external" role="tabpanel" aria-labelledby="car-external-tab">
                <div class="row">
                <?php
                if( have_rows('specifications_external_equipment') ):
                  while( have_rows('specifications_external_equipment') ) : the_row();
                ?>
                  <div class="col-md-6 col-12">
                    <span><?= the_sub_field('text_specifications'); ?></span>
                  </div>
                <?php 
                  endwhile; 
                endif; ?> 
                </div>               
              </div>
            </div>            
          </div>
        </div>

        <!-- SideBar Car -->
        <div class="col-md-4 col-12 d-none d-lg-block d-md-block">
          <div class="alert alert-warning" role="alert">
            <?php if(get_post_field('post_content', $car_id)): ?>
              <?= get_post_field('post_content', $car_id); ?>
            <?php else: ?>
              <h3 style="text-align: right;">لماذا هذه السيارة مناسبة لك ؟</h3>
              <p style="text-align: right;"><strong>لانها تحتوي علي : </strong></p>
              <p style="text-align: right;">مثبت سرعة - تبريد وتدفئة للمقاعد - بلوتوث - كاميرا خلفية</p>
            <?php endif; ?>
          </div>
          <div class="d-flex flex-lg-row flex-column">
            <div class="cash-money box-price mb-2">
              <h3><img src="<?= get_theme_file_uri().'/assets/img/price.svg'; ?>" alt="السعر كاش"> السعر كاش</h3>
              <div class="priceing">
                <p>قبل الضريبة</p>
                <strong class="d-block"><?=  number_format(($clear_price - $percentage) , 0, ',', '.'); ?> <?= the_field('currency_pricing', 'option'); ?></strong>
                <p>بعد الضريبة</p>
                <strong class="text-green d-block"><?= ($price_offer)? $price_offer:$car_price; ?> <?= the_field('currency_pricing', 'option'); ?></strong>
                <a class="btn btn-success text-white w-100" href="/buying/?car=<?= $car_id; ?>">شراء هذة السيارة <i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <div class="cash-money box-price mb-2">
              <h3><img src="<?= get_theme_file_uri().'/assets/img/calendar.svg'; ?>" alt="قسط يبدأ من"> قسط يبدأ من</h3>
              <div class="priceing">
                <p>القسط شهريا</p>
                <strong class="text-green d-block"><?= $finance_price; ?></strong>
                <p>مدة القسط</p>
                <b>60</b> <small>شهر</small>
                <a class="btn btn-dark text-white w-100" href="/financing/?car=<?= $car_id; ?>">طلب تمويل للسيارة <i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
          </div>
          <!-- information author  -->
          <div class="accordion accordion-author bg-light" id="informationAuthor">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed text-center font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  تواصل معنا عن طريق
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#informationAuthor">
                <div class="accordion-body">
                  <div class="d-flex-inline bg-darken rounded-2 text-white p-4">
                    <i class="fas fa-phone fa-lg ms-2"></i> <span class="font-bold">اتصل</span> <a class="text-white float-left" href="tel:<?= $user_phone; ?>"><?= $user_phone; ?></a>
                  </div>
                  <div class="d-flex-inline bg-green text-white p-4 mt-2 rounded-2">
                    <i class="fab fa-whatsapp fa-lg ms-2"></i> <span class="font-bold">واتساب</span> <a class="text-white float-left" target="_blank" href="https://wa.me/+<?= $user_whatsapp; ?>"><?= $user_whatsapp; ?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Share & actions -->
          <div class="d-flex flex-lg-row flex-column mb-4 mt-2">
            <a class="btn btn-outline-light border-0 shadow-0 text-dark w-100 p-3" href="#">
              <?php echo '<button class="favorite-button icon-box bg-white rounded-100 text-primary border-0 ' . (in_array(get_the_ID(), $favorites) ? 'is_favorite' : '') . '" data-post-id="' . get_the_ID() . '" data-favorites="' . esc_attr(json_encode($favorites)) . '" data-is-favorite="' . (in_array(get_the_ID(), $favorites) ? 'true' : 'false') . '">' . (in_array(get_the_ID(), $favorites) ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>') . '</button>'; ?>
              <span>إضافة للمفضلة</span>
            </a>
            <button type="button" class="btn btn-outline-light border-0 shadow-0 text-dark w-100 p-3" data-bs-toggle="modal" data-bs-target="#ShareMeta">
              <svg width="16" height="24" viewBox="0 0 16 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 16.3636V4.17273L5.4 5.91818L4 4.36364L8 0L12 4.36364L10.6 5.91818L9 4.17273V16.3636H7ZM0 24V7.63636H5V9.81818H2V21.8182H14V9.81818H11V7.63636H16V24H0Z" fill="#D97E00"/>
              </svg>
              <span>مشاركة الأعلان</span>
            </button>           
          </div>
          <!-- number ads cars -->
          <div class="alert alert-light border-top-0 border-start-0 border-end-0 border-dark">
            <p class="text-lg"><img src="<?= get_theme_file_uri().'/assets/img/number-ads.svg'; ?>" alt="رقم الأعلان"> <span class="mx-2">رقم الأعلان:</span> <?= $car_id; ?></p>
          </div>
          
          <?php 
          if ($show->have_posts()):
            while ($show->have_posts()):
            $show->the_post(); 
            ?>
          <!-- تفاصيل البائع -->
          <div class="author-single-car">
            <h4>تفاصيل البائع</h4>
            <div>
              <span class="author">
                <a class="logo-author" href="<?= get_permalink(); ?>">
                  <img class="img-fluid" src="<?= ($avatar)? $avatar:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>">
                </a>
                <a class="link-author" href="<?= get_permalink(); ?>">
                  <span><?= the_author_meta( 'display_name', $author_id ); ?></span>
                  <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.2588 8.03857H1.25879M1.25879 8.03857L8.25879 15.0386M1.25879 8.03857L8.25879 1.03857" stroke="#141414" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>
              </span>
            </div>
          </div>
          <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
        </div>      
      </div>
    </div>

    <div class="bg-gray p-lg-5 py-3 mt-lg-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-12">
            <h2 class="mb-3 font-bold">أسئلة تهمك</h2>
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOneFAQ">
                  <button class="accordion-button py-4 px-3 font-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneFAQ" aria-expanded="true" aria-controls="collapseOneFAQ">
                    <span class="h4 font-bold">كيف أشتري سيارة ؟</span>
                  </button>
                </h2>
                <div id="collapseOneFAQ" class="accordion-collapse collapse show" aria-labelledby="headingOneFAQ" data-bs-parent="#accordionExample">
                  <div class="accordion-body py-4 px-3 h5">
                    يتم شراء سيارة من خلال دفع عربون وهذا العربون مخصوم من ثمن السيارة الاجمالي ومسترد لك في حالة عدم اتمام عملية الشراء شرط عدم تثبيت حجز السيارة.
                  </div>
                </div>
              </div>
              <div class="accordion-item mt-3">
                <h2 class="accordion-header" id="headingTwoFAQ">
                  <button class="accordion-button py-4 px-3 font-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoFAQ" aria-expanded="false" aria-controls="collapseTwoFAQ">
                    <span class="h4 font-bold">كيف ادفع قيمة السيارة ؟</span>
                  </button>
                </h2>
                <div id="collapseTwoFAQ" class="accordion-collapse collapse" aria-labelledby="headingTwoFAQ" data-bs-parent="#accordionExample">
                  <div class="accordion-body py-4 px-3 h5">
                    يتم شراء سيارة من خلال دفع عربون وهذا العربون مخصوم من ثمن السيارة الاجمالي ومسترد لك في حالة عدم اتمام عملية الشراء شرط عدم تثبيت حجز السيارة.
                  </div>
                </div>
              </div>
              <div class="accordion-item mt-3">
                <h2 class="accordion-header" id="headingThreeFAQ">
                  <button class="accordion-button py-4 px-3 font-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeFAQ" aria-expanded="false" aria-controls="collapseThreeFAQ">
                    <span class="h4 font-bold">هل موقعكم معتمد من وزارة التجارة</span>
                  </button>
                </h2>
                <div id="collapseThreeFAQ" class="accordion-collapse collapse" aria-labelledby="headingThreeFAQ" data-bs-parent="#accordionExample">
                  <div class="accordion-body py-4 px-3 h5">
                    يتم شراء سيارة من خلال دفع عربون وهذا العربون مخصوم من ثمن السيارة الاجمالي ومسترد لك في حالة عدم اتمام عملية الشراء شرط عدم تثبيت حجز السيارة.
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-12"></div>
        </div>
      </div> 
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="ShareMeta" tabindex="-1" aria-labelledby="ShareMetaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <h1 class="modal-title fs-5 text-center w-100" id="ShareMetaLabel">شارك هذا الإعلان</h1>
        </div>
        <?= get_template_part( 'templates/include/share', 'meta' ); ?>
      </div>
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
  wp_reset_postdata();
endif;
get_footer();