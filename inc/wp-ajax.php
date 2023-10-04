<?php 
// Plugin Name: النوع
add_action('wp_ajax_ajax_function_ids_brands', 'ajax_function_ids_brands', 0);
add_action('wp_ajax_nopriv_ajax_function_ids_brands', 'ajax_function_ids_brands');
function ajax_function_ids_brands() {
  if ( isset( $_POST['parent_id'] ) ) {
    foreach ($_POST['parent_id'] as $parent_id) {
      $brands =  get_categories('parent='.$parent_id.'&hide_empty=1&taxonomy=basic-brand');
      if($brands):
        foreach ($brands as $brand): 
      ?>
        <div class="form-check form-switch <?= $brand->name; ?>">
          <input class="form-check-input" value="<?= $brand->term_id; ?>" type="checkbox" id="brand<?= $brand->term_id; ?>">
          <label class="form-check-label" for="brand<?= $brand->term_id; ?>">
            <span><?= $brand->name; ?></span>
          </label>
        </div>  
      <?php 
        endforeach;
      else:
        echo 'لا يوجد انواع لهذة العلامة التجارية';
      endif;
    }
  }
  die;
}

// Plugin Name: الفئة
add_action('wp_ajax_ajax_function_ids_types', 'ajax_function_ids_types', 0);
add_action('wp_ajax_nopriv_ajax_function_ids_types', 'ajax_function_ids_types');
function ajax_function_ids_types() {
  if ( isset( $_POST['parent_id'] ) ) {
    foreach ($_POST['parent_id'] as $parent_id) {
      $brands =  get_categories('parent='.$parent_id.'&hide_empty=1&taxonomy=basic-brand');
      if($brands):
        foreach ($brands as $brand): 
      ?>
        <div class="form-check form-switch <?= $brand->name; ?>">
          <input class="form-check-input" value="<?= $brand->term_id; ?>" type="checkbox" id="brand<?= $brand->term_id; ?>">
          <label class="form-check-label" for="brand<?= $brand->term_id; ?>">
            <span><?= $brand->name; ?></span>
          </label>
        </div>  
      <?php 
        endforeach;
      else:
        echo 'لا يوجد انواع لهذة العلامة التجارية';
      endif;
    }
  }
  die;
}

// Plugin Name: السيارات
add_action('wp_ajax_ajax_function_get_cars', 'ajax_function_get_cars', 0);
add_action('wp_ajax_nopriv_ajax_function_get_cars', 'ajax_function_get_cars');
function ajax_function_get_cars() {
        
  $user_id = get_current_user_id();
  $favorites = get_user_meta($user_id, 'favorites', true) ;
  if( !$favorites ){
      $favorites = [];
  }

  $placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
  $paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

  $tags    = $_POST['tags'];

  $brands  = $_POST['brands'];
  $categories = $_POST['categories'];
  $types = $_POST['types'];

  $from_year = $_POST['from_year'];
  $to_year = $_POST['to_year'];
   
  $from_price = $_POST['from_price'];
  $to_price = $_POST['to_price'];

  $structures = $_POST['structures'];

  // Get Basic specifications
  $args = array(
    'post_type' => 'basic_specifications',
    'posts_per_page' => -1,
  );

  if($brands && empty($categories) && empty($types)) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brands,
      ),
    );
  }

  if($brands && $categories && empty($types)) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $categories,
      ),
    );
  }

  if($brands && $categories && $types) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $types,
      ),
    );
  }

  $posts = get_posts( $args );
  
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

  if(empty($ids)){
    ?>
      <div class="alert-not-found">
        لا يوجد نتائج لهذا البحث يرجاء اعادة البحث
      </div>
    <?php
    die;
  }
  // Get query cars
  $args = array (
    'post__in' => $ids,
    'orderby' => 'post__in',
    'post_status' => 'publish',
    'post_type' => 'cars',
    'posts_per_page' => 30,
  );

  if($tags) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'products-tag',
        'field'    => 'term_id',
        'terms'    => $tags,
      ),
    );
  }

  if($structures) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'structure-type',
        'field'    => 'term_id',
        'terms'    => $structures,
      ),
    );
  }

  $query = new WP_Query( $args );
  if ( $query->have_posts() ):
    while ( $query->have_posts() ):
      $query->the_post();
        $img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
        $author_id = get_the_author_meta('ID');
        $avatar = get_field('user_logo', 'user_'. $author_id);
        $finance_price = get_field('finance_price');



        $term_model_list = get_the_terms( $car_id, 'products-model' );
        $model = join(', ', wp_list_pluck($term_model_list, 'id')); 

        $price = get_field('price');


  if($from_price && $to_price  && $price >= $from_price && $price <= $to_price):
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

  <?php elseif(empty($from_price) || empty($to_price)): ?>

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
    <?php endif; ?>  
    <?php endwhile; ?>
  <?php else: ?>
    <div class="alert-not-found">
      لا يوجد نتائج لهذا البحث يرجاء اعادة البحث
    </div>
  <?php endif; ?>
<?php
  die;
}

// Plugin Name: صور مقترحة
add_action('wp_ajax_ajax_function_photo_suggested', 'ajax_function_photo_suggested', 0);
add_action('wp_ajax_nopriv_ajax_function_photo_suggested', 'ajax_function_photo_suggested');
function ajax_function_photo_suggested() {
  if ( isset( $_POST['car_id'] ) ) {
    $query = new WP_Query (array('post_type' => 'cars', 'post__in' => array($_POST['car_id'])));
    if ($query->have_posts()):
      while ($query->have_posts()):
        $query->the_post();
        $galleries = (get_field('car_galleries', $_POST['car_id']))? get_field('car_galleries', $_POST['car_id']): get_field('car_galleries');
          if($galleries):
            foreach( $galleries as $img): 
          ?>
            <img src="<?= $img['url']; ?>" alt="slide">
          <?php
            endforeach;
          endif;
      endwhile;
    endif;
  }
  die;
}

// Plugin Name: اضافة سيارة مقترحة
add_action('wp_ajax_set_function_add_new_suggested', 'set_function_add_new_suggested', 0);
add_action('wp_ajax_nopriv_set_function_add_new_suggested', 'set_function_add_new_suggested');
function set_function_add_new_suggested() {
  if ( isset($_POST['car_id']) && isset($_POST['car_name']) && $_POST['car_price'] &&  $_POST['car_price_after'] && $_POST['car_installment'] ) {
    $car_id = duplicate($_POST['car_id'], $_POST['car_name'], $_POST['car_price'], $_POST['car_price_after'], $_POST['car_installment']);
    $result = [
      "success" => true,
      "message" => 'تم اضافة السيارة بنجاح <a href="'.get_permalink($car_id).'">عرض السيارة</a>',
    ];
    echo json_encode($result);
  } else {
    $result = [
      "success" => false,
      "message" => 'املي جميع الحقول المطلوبة',
    ];
    echo json_encode($result);
  }
  die;
}

// plugin اضافة مواصفات سيارة جديدة
/*
  Plugin Name: ajax basic brand
*/
add_action('wp_ajax_lvl_one_basic_brand', 'lvl_one_basic_brand', 0);
add_action('wp_ajax_nopriv_lvl_one_basic_brand', 'lvl_one_basic_brand');
function lvl_one_basic_brand() {
  if ( isset( $_POST['parent_id'] ) ) {
    $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=basic-brand');
    if($categories) {
      foreach ($categories as $cat) {
        $option .= '<option value="'.$cat->term_id.'">';
        $option .= $cat->cat_name;
        $option .= '</option>';
      }
      echo '<option value="0" selected="selected">اختار الفئة</option>'.$option;
        die();
    } else {
      echo '<option value="0" selected="selected">لا يوجد الفئة</option>';
    }
  }
  die;
}


// Plugin Name: اضافة موضفات السيارة الاسياسية
add_action('wp_ajax_set_function_add_new_Basic', 'set_function_add_new_Basic', 0);
add_action('wp_ajax_nopriv_set_function_add_new_Basic', 'set_function_add_new_Basic');
function set_function_add_new_Basic() {
  if ( isset($_POST['parent_brand_id']) && isset($_POST['child_brand_id']) && $_POST['fuel_id'] &&  $_POST['engine_id'] && $_POST['cylinder_id'] && $_POST['push_id'] && $_POST['gear_id'] && $_POST['color_id'] && $_POST['safeties'] && $_POST['comforts'] && $_POST['techniques'] && $_POST['external'] ) {
    $id_basic = additionBasicManually($_POST['basic_name'], $_POST['parent_brand_id'], $_POST['child_brand_id'], $_POST['fuel_id'], $_POST['engine_id'], $_POST['cylinder_id'], $_POST['push_id'], $_POST['gear_id'], $_POST['color_id'], $_POST['safeties'], $_POST['comforts'], $_POST['techniques'], $_POST['external']);
    $result = [
      "success" => true,
      "message" => 'تم اضافة مواصفات اساسية',
      "id_basic" => $id_basic
    ];
    echo json_encode($result);
  } else {
    $result = [
      "success" => false,
    ];
    echo json_encode($result);
  }
  die;
}

// Plugin Name: اضافة سيارة جديدة يدوي
add_action('wp_ajax_set_function_add_new_Manually', 'set_function_add_new_Manually', 0);
add_action('wp_ajax_nopriv_set_function_add_new_Manually', 'set_function_add_new_Manually');
function set_function_add_new_Manually() {
  if ( isset($_POST['id_basic']) && isset($_POST['car_name']) && $_POST['car_price'] &&  $_POST['car_price_after'] && $_POST['car_installment'] && $_POST['tag_id'] && $_POST['model_id'] && $_POST['galleries'] && $_POST['featured_img'] ) {
    $car_id = additionCarManually($_POST['id_basic'], $_POST['car_name'], $_POST['car_price'], $_POST['car_price_after'], $_POST['car_installment'], $_POST['tag_id'], $_POST['model_id'], $_POST['galleries'], $_POST['featured_img']);
    $result = [
      "success" => true,
      "message" => 'تم اضافة السيارة بنجاح <a href="'.get_permalink($car_id).'">عرض السيارة</a>',
    ];
    echo json_encode($result);
  } else {
    $result = [
      "success" => false,
      "message" => 'املي جميع الحقول المطلوبة',
    ];
    echo json_encode($result);
  }
  die;
}