<?php 
// // Register Basic custom Post Type
function basic_specifications_post_type() {
  $labels = array(
      'name' => __('المواصفات الاساسية', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('المواصفات الاساسية', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('المواصفات الاساسية', 'post-type'),
      'parent_item_colon' => __('Parent المواصفات:', 'post-type'),
      'all_items' => __('الكل', 'post-type'),
      'view_item' => __('عرض المواصفات', 'post-type'),
      'add_new_item' => __('اضاف المواصفات', 'post-type'),
      'add_new' => __('اضاف المواصفات', 'post-type'),
      'edit_item' => __('تعديل', 'post-type'),
      'update_item' => __('تحديث', 'post-type'),
      'search_items' => __('بحث', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-car',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,


  );
  register_post_type('basic_specifications', $args);
}
// Hook into the 'init' action
add_action('init', 'basic_specifications_post_type', 0);

// // Register Cars custom Post Type
function cars_post_type() {
  $labels = array(
      'name' => __('سيارة جديدة', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('سيارة جديدة', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('سيارة جديدة', 'post-type'),
      'parent_item_colon' => __('Parent سيارة:', 'post-type'),
      'all_items' => __('الكل', 'post-type'),
      'view_item' => __('عرض السيارة', 'post-type'),
      'add_new_item' => __('اضاف سيارة', 'post-type'),
      'add_new' => __('اضاف سيارة', 'post-type'),
      'edit_item' => __('تعديل', 'post-type'),
      'update_item' => __('تحديث', 'post-type'),
      'search_items' => __('بحث', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-car',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,
  );
  register_post_type('cars', $args);
}
// Hook into the 'init' action
add_action('init', 'cars_post_type', 0);

// Register models custom Post Type
function models_post_type() {
  $labels = array(
      'name' => __('الموديلات', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('الموديلات', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('الموديلات', 'post-type'),
      'parent_item_colon' => __('Parent الموديلات:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View الموديلات', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,


  );
  register_post_type('models', $args);
}
// Hook into the 'init' action
add_action('init', 'models_post_type', 0);

// Register maintenance custom Post Type
function maintenance_post_type() {
  $labels = array(
      'name' => __('مراكز الصيانة', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('مراكز الصيانة', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('مراكز الصيانة', 'post-type'),
      'parent_item_colon' => __('Parent مراكز الصيانة:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View مراكز الصيانة', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('title','revisions','editor','thumbnail', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,


  );
  register_post_type('maintenance', $args);
}
// Hook into the 'init' action
add_action('init', 'maintenance_post_type', 0);


register_taxonomy( 
  'basic-brand', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'الماركة','taxonomy general name'), 
    'singular_name' => __( 'الماركة', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'fuel-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'نوع الوقود','taxonomy general name'), 
    'singular_name' => __( 'نوع الوقود', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'gear-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'نوع القير','taxonomy general name'), 
    'singular_name' => __( 'نوع القير', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'structure-type', //taxonomy 
  'cars', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'هيكل السيارة','taxonomy general name'), 
    'singular_name' => __( 'هيكل السيارة', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'push-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'نوع الدفع','taxonomy general name'), 
    'singular_name' => __( 'نوع الدفع', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'cylinders-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'عدد السلندرات','taxonomy general name'), 
    'singular_name' => __( 'عدد السلندرات', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'engine-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'حجم المحرك','taxonomy general name'), 
    'singular_name' => __( 'حجم المحرك', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'color-type', //taxonomy 
  'basic_specifications', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'الالوان','taxonomy general name'), 
    'singular_name' => __( 'الالوان', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'products-tag', //taxonomy 
  array('products', 'cars'), //post type
  array( 
    'hierarchical'  => true, 
    'label'         => __( 'قسم السيارات','taxonomy general name'), 
    'singular_name' => __( 'القسم', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true ,
    'show_admin_column' => true
  )
);
  
register_taxonomy( 
  'products-model', //taxonomy 
  array('products', 'cars'), //post type
  array( 
    'hierarchical'  => true, 
    'label'         => __( 'السنة','taxonomy general name'), 
    'singular_name' => __( 'السنة', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true ,
    'show_admin_column' => true
  )
);

/**
* Function Name: DD - dd();
* This dd function dumps the given variables and ends execution of the script with simple style
* @param ($args)
* @return (Wow)
*/
function dump(...$objects) {
  echo "<pre class='pre-dd'>";
  foreach ($objects as $object) {
    ?>
    <style media="screen">
    .pre-dd{
      direction: ltr;
      display: block;
      padding: 9.5px;
      margin: 0 0 10px;
      font-size: 13px;
      line-height: 1.42857143;
      color: #333;
      word-break: break-all;
      word-wrap: break-word;
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    </style>
    <?php
    var_dump($object);
    echo "\n";
  }
  echo "</pre>";
  die();
}

// custom author pagination
function custom_bootstrap_pagination($args = array(), $query_object = 'wp_query') {
  if ($query_object == 'wp_query') {
      global $wp_query;
      $main_query = $wp_query;
  } else {
      $main_query = $query_object;
  }
  //var_dump($wp_query);
  $big = 99999; // This needs to be an unlikely integer
  // For more options and info view the docs for paginate_links()
  // http://codex.wordpress.org/Function_Reference/paginate_links
  $current_page = max(1, get_query_var('page'));
  $pages_count = $main_query->max_num_pages;
  $default_args = array(
      // 'base' => str_replace($big, '%#%', get_pagenum_link($big)),
      'format'     => '?page=%#%',
      'current' => $current_page,
      'total' => $pages_count,
      'mid_size' => 2,
      'prev_text' => '<i class="fa fa-caret-left" aria-hidden="true"></i>',
      'next_text' => '<i class="fa fa-caret-right" aria-hidden="true"></i>',
      'type' => 'array'
  );
  $args = wp_parse_args($args, $default_args);
  $paginate_links = paginate_links($args);
  if ($paginate_links) {
      ?>

    <nav class="d-flex" aria-label="Page navigation example">
      <ul class="pagination p-0 m-auto" dir="ltr">
        <?php foreach ($paginate_links as $link): ?>
          <li class="page-item"><span class="page-link"><?php echo $link; ?></span></li>
        <?php endforeach; ?>
      </ul>
    </nav>

      <?php
  }
}

// custom base pagination
function custom_base_pagination($args = array(), $query_object = 'wp_query') {
  if ($query_object == 'wp_query') {
      global $wp_query;
      $main_query = $wp_query;
  } else {
      $main_query = $query_object;
  }
  $big = 99999; // This needs to be an unlikely integer
  $current_page = max(1, get_query_var('paged'));
  $pages_count = $main_query->max_num_pages;
  $default_args = array(
      'current' => $current_page,
      'total' => $pages_count,
      'mid_size' => 2,
      'prev_text' => '<i class="fa fa-caret-left" aria-hidden="true"></i>',
      'next_text' => '<i class="fa fa-caret-right" aria-hidden="true"></i>',
      'type' => 'array'
  );
  $args = wp_parse_args($args, $default_args);
  $paginate_links = paginate_links($args);
  if ($paginate_links) {
    ?>
    <nav class="d-flex" aria-label="Page navigation example">
      <ul class="pagination p-0 m-auto" dir="ltr">
        <?php foreach ($paginate_links as $link): ?>
          <li class="page-item"><span class="page-link"><?php echo $link; ?></span></li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <?php
  }
}

// Register Careers custom Post Type
// function products_post_type() {
//   $labels = array(
//       'name' => __('سيارات', 'Post Type General Name', 'post-type'),
//       'singular_name' => _x('سيارات', 'Post Type Singular Name', 'post-type'),
//       'menu_name' => __('سيارات', 'post-type'),
//       'parent_item_colon' => __('Parent سيارات:', 'post-type'),
//       'all_items' => __('All', 'post-type'),
//       'view_item' => __('View سيارات', 'post-type'),
//       'add_new_item' => __('Add New', 'post-type'),
//       'add_new' => __('Add New', 'post-type'),
//       'edit_item' => __('Edit', 'post-type'),
//       'update_item' => __('Update', 'post-type'),
//       'search_items' => __('Search', 'post-type'),
//       'not_found' => __('Not found', 'post-type'),
//       'not_found_in_trash' => __('Not found in Trash', 'post-type'),
//   );
//   $args = array(
//       'labels' => $labels,
//       'supports' => array('title','revisions','editor','thumbnail',),
//       'hierarchical' => false,
//       'public' => true,
//       'show_ui' => true,
//       'show_in_menu' => true,
//       'show_in_nav_menus' => true,
//       'show_in_admin_bar' => true,
//       'menu_position' => 5,
//       'menu_icon' => 'dashicons-welcome-widgets-menus',
//       'can_export' => true,
//       'has_archive' => true,
//       'exclude_from_search' => false,
//       'publicly_queryable' => true,
//       'capability_type' => 'post',
//       'show_in_rest' => true,
//   );
//   register_post_type('products', $args);
// }
// // Hook into the 'init' action
// add_action('init', 'products_post_type', 0);

// Register Careers custom Post Type
// function checking_post_type() {
//   $labels = array(
//       'name' => __('فحص السيارة', 'Post Type General Name', 'post-type'),
//       'singular_name' => _x('فحص السيارة', 'Post Type Singular Name', 'post-type'),
//       'menu_name' => __('فحص السيارة', 'post-type'),
//       'parent_item_colon' => __('Parent فحص:', 'post-type'),
//       'all_items' => __('All', 'post-type'),
//       'view_item' => __('View فحص', 'post-type'),
//       'add_new_item' => __('Add New', 'post-type'),
//       'add_new' => __('Add New', 'post-type'),
//       'edit_item' => __('Edit', 'post-type'),
//       'update_item' => __('Update', 'post-type'),
//       'search_items' => __('Search', 'post-type'),
//       'not_found' => __('Not found', 'post-type'),
//       'not_found_in_trash' => __('Not found in Trash', 'post-type'),
//   );
//   $args = array(
//       'labels' => $labels,
//       'supports' => array('title','revisions','editor','thumbnail', 'author'),
//       'hierarchical' => false,
//       'public' => true,
//       'show_ui' => true,
//       'show_in_menu' => true,
//       'show_in_nav_menus' => true,
//       'show_in_admin_bar' => true,
//       'menu_position' => 5,
//       'menu_icon' => 'dashicons-welcome-widgets-menus',
//       'can_export' => true,
//       'has_archive' => true,
//       'exclude_from_search' => false,
//       'publicly_queryable' => true,
//       'capability_type' => 'page',
//       'show_in_rest' => true,
//   );
//   register_post_type('checking', $args);
// }
// // Hook into the 'init' action
// add_action('init', 'checking_post_type', 0);

// register_taxonomy( 
//   'products-brand', //taxonomy 
//   'products', //post-type
//   array( 
//     'hierarchical'  => true, 
//     'label'         => __( 'الماركة ','taxonomy general name'), 
//     'singular_name' => __( 'الماركة ', 'taxonomy general name' ), 
//     'rewrite'       => true, 
//     'query_var'     => true ,
//     'show_admin_column' => true
//   )
// );
    
// register_taxonomy( 
//   'products-group', //taxonomy 
//   'products', //post-type
//   array( 
//     'hierarchical'  => true, 
//     'label'         => __( 'الفئه','taxonomy general name'), 
//     'singular_name' => __( 'الفئه', 'taxonomy general name' ), 
//     'rewrite'       => true, 
//     'query_var'     => true ,
//     'show_admin_column' => true
//   )
// );
      
// Register Careers custom Post Type
// function realـestate_post_type() {
//   $labels = array(
//       'name' => __('عقارات', 'Post Type General Name', 'post-type'),
//       'singular_name' => _x('عقارات', 'Post Type Singular Name', 'post-type'),
//       'menu_name' => __('عقارات', 'post-type'),
//       'parent_item_colon' => __('Parent عقارات:', 'post-type'),
//       'all_items' => __('All', 'post-type'),
//       'view_item' => __('View عقارات', 'post-type'),
//       'add_new_item' => __('Add New', 'post-type'),
//       'add_new' => __('Add New', 'post-type'),
//       'edit_item' => __('Edit', 'post-type'),
//       'update_item' => __('Update', 'post-type'),
//       'search_items' => __('Search', 'post-type'),
//       'not_found' => __('Not found', 'post-type'),
//       'not_found_in_trash' => __('Not found in Trash', 'post-type'),
//   );
//   $args = array(
//       'labels' => $labels,
//       'supports' => array('title','revisions','editor','thumbnail',),
//       'hierarchical' => false,
//       'public' => true,
//       'show_ui' => true,
//       'show_in_menu' => true,
//       'show_in_nav_menus' => true,
//       'show_in_admin_bar' => true,
//       'menu_position' => 5,
//       'menu_icon' => 'dashicons-welcome-widgets-menus',
//       'can_export' => true,
//       'has_archive' => true,
//       'exclude_from_search' => false,
//       'publicly_queryable' => true,
//       'capability_type' => 'page',
//       'show_in_rest' => true,


//   );
//   register_post_type('realestate', $args);
// }
// // Hook into the 'init' action
// add_action('init', 'realـestate_post_type', 0);

// register_taxonomy( 
//   'realestate-category', //taxonomy 
//   'realestate', //post-type
//   array( 
//     'hierarchical'  => true, 
//     'label'         => __( 'category','taxonomy general name'), 
//     'singular_name' => __( 'category', 'taxonomy general name' ), 
//     'rewrite'       => true, 
//     'query_var'     => true,
//     'show_admin_column' => true
//   )
// );

register_taxonomy( 
  'realestate-cities', //taxonomy 
  'car-show', //post-type
  array( 
    'hierarchical'  => true, 
    'label'         => __( 'المدينة','taxonomy general name'), 
    'singular_name' => __( 'المدينة', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'realestate-package', //taxonomy 
  'car-show', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'تصنيف','taxonomy general name'), 
    'singular_name' => __( 'تصنيف', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'show-type', //taxonomy 
  'car-show', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'قسم المعارض','taxonomy general name'), 
    'singular_name' => __( 'القسم', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

register_taxonomy( 
  'agents-type', //taxonomy 
  'agents', //post-type
  array(
    'hierarchical'  => true, 
    'label'         => __( 'قسم الوكلاء','taxonomy general name'), 
    'singular_name' => __( 'القسم', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true,
    'show_admin_column' => true 
  )
);

// Register models custom Post Type
function car_show_post_type() {
  $labels = array(
      'name' => __('المعارض', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('المعارض', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('المعارض', 'post-type'),
      'parent_item_colon' => __('Parent المعارض:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View المعارض', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('editor', 'title','revisions', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,
  );
  register_post_type('car-show', $args);
}
// Hook into the 'init' action
add_action('init', 'car_show_post_type', 0);

// Register models custom Post Type
function agents_post_type() {
  $labels = array(
      'name' => __('الوكلاء', 'Post Type General Name', 'post-type'),
      'singular_name' => _x('الوكلاء', 'Post Type Singular Name', 'post-type'),
      'menu_name' => __('الوكلاء', 'post-type'),
      'parent_item_colon' => __('Parent الوكلاء:', 'post-type'),
      'all_items' => __('All', 'post-type'),
      'view_item' => __('View الوكلاء', 'post-type'),
      'add_new_item' => __('Add New', 'post-type'),
      'add_new' => __('Add New', 'post-type'),
      'edit_item' => __('Edit', 'post-type'),
      'update_item' => __('Update', 'post-type'),
      'search_items' => __('Search', 'post-type'),
      'not_found' => __('Not found', 'post-type'),
      'not_found_in_trash' => __('Not found in Trash', 'post-type'),
  );
  $args = array(
      'labels' => $labels,
      'supports' => array('editor', 'title','revisions', 'author'),
      'hierarchical' => false,
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'can_export' => true,
      'has_archive' => true,
      'exclude_from_search' => false,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'show_in_rest' => true,
  );
  register_post_type('agents', $args);
}
// Hook into the 'init' action
add_action('init', 'agents_post_type', 0);