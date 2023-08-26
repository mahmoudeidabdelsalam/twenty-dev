<?php
get_header();

$get_basic_specifications = get_field('id_basic_specifications');

$img_tag    = get_theme_file_uri().'/assets/img/tag.svg';
$img_eye    = get_theme_file_uri().'/assets/img/eye.svg';
$img_offer  = get_theme_file_uri().'/assets/img/offer.svg';

$car_id = get_the_ID();
$author_id = get_post_field( 'post_author', $car_id );

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
    $percentage = (15 / 100) * $car_price;
  ?> 

  <!-- Page Header Start -->
  <div class="page-header mb-3 bg-primary">
    <div class="container">
      <h1 class="text-dark mb-3 font-bold"><?= the_title(); ?></h1>
      <p class="text-lg"><img src="<?= $img_tag; ?>" alt="<?= $tag; ?>"> <?= $tag; ?></p>
      <p class="text-lg"><img src="<?= $img_eye; ?>" alt="المشاهدات"> <span>عدد المشاهدات :</span> <?= $post_views; ?></p>
      <?php if($price_offer): ?>
        <p class="text-lg"><img src="<?= $img_offer; ?>" alt="أرخص من سعر السوق"> <span>أرخص من سعر السوق ب</span> <?= $car_price - $price_offer; ?> الف <?= the_field('currency_pricing', 'option'); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <!-- Page breadcrumb -->
  <div class="breadcrumb">
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
        <div class="col-md-4 col-12">
          <div class="alert alert-warning" role="alert">
            <?= get_post_field('post_content', $car_id); ?>
          </div>
          <div class="d-flex flex-lg-row flex-column">
            <div class="cash-money box-price mb-2">
              <h3><img src="<?= get_theme_file_uri().'/assets/img/price.svg'; ?>" alt="السعر كاش"> السعر كاش</h3>
              <div class="priceing">
                <p>قبل الضريبة</p>
                <strong class="d-block"><?= ($car_price - $percentage); ?> <?= the_field('currency_pricing', 'option'); ?></strong>
                <p>بعد الضريبة</p>
                <strong class="text-green d-block"><?= ($price_offer)? $price_offer:$car_price; ?> <?= the_field('currency_pricing', 'option'); ?></strong>
                <?php if($price_offer):?><span class="old-price"><?= $car_price; ?> <?= the_field('currency_pricing', 'option'); ?></span><?php endif; ?>              
                <a class="btn btn-success text-white w-100" href="/buying/">شراء هذة السيارة <i class="fas fa-arrow-left"></i></a>
              </div>
            </div>
            <div class="cash-money box-price mb-2">
              <h3><img src="<?= get_theme_file_uri().'/assets/img/calendar.svg'; ?>" alt="قسط يبدأ من"> قسط يبدأ من</h3>
              <div class="priceing">
                <p>القسط شهريا</p>
                <strong class="text-green d-block"><?= $finance_price; ?></strong>
                <p>مدة القسط</p>
                <b>60</b> <small>شهر</small>
                <a class="btn btn-dark text-white w-100" href="/financing/">طلب تمويل للسيارة <i class="fas fa-arrow-left"></i></a>
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
            <a class="text-dark w-100 p-3" href="#">
              <i class="far fa-heart fa-lg text-primary ms-2"></i>
              <span>إضافة للمفضلة</span>
            </a>
            <a class="text-dark w-100 p-3" href="#">
              <i class="fas fa-share-square fa-lg text-primary ms-2"></i>
              <span>مشاركة الأعلان</span>
            </a>
          </div>
          <!-- number ads cars -->
          <div class="alert alert-light border-top-0 border-start-0 border-end-0 border-dark">
            <p class="text-lg"><img src="<?= get_theme_file_uri().'/assets/img/number-ads.svg'; ?>" alt="رقم الأعلان"> <span class="mx-2">رقم الأعلان:</span> <?= $car_id; ?></p>
          </div>
        </div>      
      </div>
    </div>

    <div class="bg-light p-5 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-12">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOneFAQ">
                  <button class="accordion-button p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneFAQ" aria-expanded="true" aria-controls="collapseOneFAQ">
                    <span class="h4">كيف أشتري سيارة ؟</span>
                  </button>
                </h2>
                <div id="collapseOneFAQ" class="accordion-collapse collapse show" aria-labelledby="headingOneFAQ" data-bs-parent="#accordionExample">
                  <div class="accordion-body p-5 h5">
                    يتم شراء سيارة من خلال دفع عربون وهذا العربون مخصوم من ثمن السيارة الاجمالي ومسترد لك في حالة عدم اتمام عملية الشراء شرط عدم تثبيت حجز السيارة.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwoFAQ">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwoFAQ" aria-expanded="false" aria-controls="collapseTwoFAQ">
                    <span class="h4">كيف ادفع قيمة السيارة ؟</span>
                  </button>
                </h2>
                <div id="collapseTwoFAQ" class="accordion-collapse collapse" aria-labelledby="headingTwoFAQ" data-bs-parent="#accordionExample">
                  <div class="accordion-body p-5 h5">
                    يتم شراء سيارة من خلال دفع عربون وهذا العربون مخصوم من ثمن السيارة الاجمالي ومسترد لك في حالة عدم اتمام عملية الشراء شرط عدم تثبيت حجز السيارة.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThreeFAQ">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThreeFAQ" aria-expanded="false" aria-controls="collapseThreeFAQ">
                    <span class="h4">هل موقعكم معتمد من وزارة التجارة</span>
                  </button>
                </h2>
                <div id="collapseThreeFAQ" class="accordion-collapse collapse" aria-labelledby="headingThreeFAQ" data-bs-parent="#accordionExample">
                  <div class="accordion-body p-5 h5">
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

<?php
  endwhile;
  wp_reset_postdata();
endif;
get_footer();