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
    <?php endwhile; ?>
  <?php else: ?>
    <div class="alert-not-found">
      لا يوجد نتائج لهذا البحث يرجاء اعادة البحث
    </div>
  <?php endif; ?>
<?php
  die;
}
