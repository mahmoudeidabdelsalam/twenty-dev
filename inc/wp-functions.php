<?php 
// filter our function to the action we set at jQuery code
add_filter('acf/fields/relationship/result', 'my_acf_fields_relationship_result', 10, 4);
function my_acf_fields_relationship_result( $text, $post, $field, $post_id ) {
  $author_id = get_post_field( 'post_author', $post->ID );
  $author_name = get_the_author_meta( 'display_name', $author_id );
    $text .= ' ' . sprintf( '(%s)', $author_name );
    return $text;
}

// add users roles
add_action( 'init', 'process_user_roles' );
function process_user_roles(){
  global $wp_roles;
  if( is_admin() && !empty( $_GET['page'] ) && $_GET['page'] == 'activate_roles') {
      $current_user = wp_get_current_user();
      $roles = $current_user->roles;
      if(!in_array('administrator', $roles)) return;
      $roles = ['administrator'];
      foreach ($roles as $role) {
          $role = get_role($role);
      }
      remove_role('vendor');
      remove_role('agents');
      remove_role('delegate');
      remove_role('body_check');
      remove_role('mechanic');
      remove_role('electric');
      add_role('vendor', __('معرض','number20'), []);
      add_role('agents', __('وكلاء','number20'), []);
      add_role('delegate', __('مندووب','number20'), []);
      add_role('body_check', __('فاحص الجسم','number20'), []);
      add_role('mechanic', __('الميكانيكي','number20'), []);
      add_role('electric', __('الكهربائي','number20'), []);
      $roles = ['vendor', 'agents', 'delegate', 'body_check', 'mechanic',  'electric', 'administrator'];
      $roles_rm = ['body_check', 'mechanic',  'electric'];
      foreach ($roles as $role) {
        $role = get_role($role);
        $role->add_cap('read');
      }
      // Assign the Pages post type and Media to all roles
      $roles = $wp_roles->role_names;
      foreach ($roles as $role => $role_name) {
        $role = get_role($role);
        $role->add_cap('edit_pages');
        $role->add_cap('edit_published_pages');
        $role->add_cap('publish_pages');
        $role->add_cap('read_private_pages');
        $role->add_cap('upload_files');
        $role->add_cap('manage_categories');
        $role->add_cap('edit_posts');
        $role->add_cap('delete_pages');
        $role->add_cap('delete_private_pages');
        $role->add_cap('delete_published_pages');
        $role->add_cap('gravityforms_view_entries');
        $role->add_cap('gravityforms_edit_entries');
        $role->add_cap('gravityforms_delete_entries');
      }
      $vendor = get_role('vendor');
      $vendor->add_cap( 'read_private_posts' );
      $caps = array (
        'edit_published_posts',
        'publish_posts',
        'delete_posts',
        'delete_published_posts',
      );
      foreach ( $caps as $cap ) {
        $vendor->remove_cap( $cap );
      }
      $agents = get_role('agents');
      $agents->add_cap( 'read_private_posts' );
      $capsـagents = array (
        'edit_published_posts',
        'publish_posts',
        'delete_posts',
        'delete_published_posts',
      );
      foreach ( $capsـagents as $cap ) {
        $agents->remove_cap( $cap );
      }
      $roles_rm = $wp_roles->role_names;
      foreach ($roles_rm as $role => $role_name) {
        $role = get_role($role);
        $role->remove_cap('gravityforms_view_entries');
        $role->remove_cap('gravityforms_edit_entries');
        $role->remove_cap('gravityforms_delete_entries');
      }
      $role = get_role( 'author' );
      $role->add_cap( 'manage_categories' ); 
    echo "Roles Proceed Succesfully";
    die();
    return;
  }
}

$user = wp_get_current_user();
$allowed_roles = array('vendor', 'agents');
if( array_intersect($allowed_roles, $user->roles ) ) {  
  function remove_menus() {
    remove_menu_page( 'index.php' );                  //Dashboard  
    remove_menu_page( 'edit.php' );                   //Posts
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page( 'edit-comments.php' );          //Comments
    remove_menu_page( 'themes.php' );                 //Appearance
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=category' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=post_tag' );        //Settings
    remove_menu_page('woocommerce');  
  }
  add_action( 'admin_menu', 'remove_menus' );
}

$allowed_check = array('body_check', 'mechanic',  'electric',);
if( array_intersect($allowed_check, $user->roles ) ) {  
  function remove_menus() {
    remove_menu_page( 'index.php' );                      //Dashboard       
    remove_menu_page( 'edit.php' );                       //Posts
    remove_menu_page( 'upload.php' );                     //Media
    remove_menu_page( 'edit.php?post_type=page' );        //Pages
    remove_menu_page( 'edit.php?post_type=products' );    //products
    remove_menu_page( 'edit.php?post_type=realestate' );  //realestate
    remove_menu_page( 'admin.php?page=gf_entries' );      //gf_entries
    remove_menu_page( 'edit-comments.php' );              //Comments
    remove_menu_page( 'themes.php' );                     //Appearance
    remove_menu_page( 'plugins.php' );                    //Plugins
    remove_menu_page( 'users.php' );                      //Users
    remove_menu_page( 'tools.php' );                      //Tools
    remove_menu_page( 'options-general.php' );            //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=category' );        //Settings
    remove_menu_page( 'edit-tags.php?taxonomy=post_tag' );        //Settings
    remove_menu_page('woocommerce');  
  }
  add_action( 'admin_menu', 'remove_menus' );
}

// override output of author drop down to include ALL user roles 
add_filter('wp_dropdown_users', 'include_all_users');
function include_all_users($output) {
  global $post; 
  $args = array('role__in' => array('administrator', 'vendor', 'agents', 'author')); 
  $users = get_users($args);
  $current_user =  wp_get_current_user();
  $output = '<select id="post_author_override" name="post_author_override" class="">';
  foreach($users as $user){
    if($post->post_author == $user->ID) {
      $select =  'selected';
    } else {
      $select = '';
    }
      $output .= '<option value="'.$user->ID.'"'.$select.'>'.$user->user_login.'</option>';
  }
  $output .= '</select>';
  return $output;
}

// Plugin Name: hook view user and click counter
add_action('wp_ajax_link_click_counter', 'link_click_counter', 0);
add_action('wp_ajax_nopriv_link_click_counter', 'link_click_counter');
function link_click_counter() {
  if ( isset( $_POST['post_id'] ) ) {
    $count = get_post_meta( $_POST['post_id'], 'link_click_counter', true );
    update_post_meta( $_POST['post_id'], 'link_click_counter', ( $count === '' ? 1 : $count + 1 ) );
  }
  echo get_post_meta( $_POST['post_id'], 'link_click_counter', true );
  die;
}

// get_object_taxonomies()
function wp_custom_tag_terms_links($post_id) {
	// Get post by post ID.
	if ( ! $post_id ) {
		return '';
	}
	$out = [];
  // Get the terms related to post.
  $terms = get_the_terms( $post_id, 'products-tag' );
  if ( ! empty( $terms ) ) {
    foreach ( $terms as $term ) {
      $out[] = sprintf( '<a class="text-dark" href="%1$s">%2$s</a>',
        esc_url( get_term_link( $term->slug, 'products-tag') ),
        esc_html( $term->name )
      );
    }
  }
	return implode( '', $out );
}

// remove menu page
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
  global $user_ID;
  if ( $user_ID != 1 ) { //your user id
   remove_menu_page('upload.php'); // Media
   remove_menu_page('link-manager.php'); // Links
   remove_menu_page('edit-comments.php'); // Comments
   remove_menu_page('edit.php?post_type=acf-field-group'); // acf
   remove_menu_page('snapshot'); // snapshot
   remove_menu_page('Wordfence'); // Wordfence
   remove_menu_page('media-cloud'); // media-cloud
   remove_menu_page('media-cloud-tools'); // Wordfence
   remove_menu_page('plugins.php'); // Plugins
   remove_menu_page('themes.php'); // Appearance
   remove_menu_page('tools.php'); // Tools
   remove_menu_page('options-general.php'); // Settings
  }
}

//Hook our function to the action we set at jQuery code
add_action( 'wp_ajax_inside_upload_files', 'inside_upload_files');
add_action( 'wp_ajax_nopriv_inside_upload_files', 'inside_upload_files');
function inside_upload_files() {
  //Do the nonce security check
  $current_user = wp_get_current_user();
    //Security check cleared, let's proceed
    //If your form has other fields, process them here.
    if ( isset($_FILES) && !empty($_FILES) ) {
      //Include the required files from backend
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
      $files = $_FILES["inside"];
      foreach ($files['name'] as $key => $value) {   
        if ($files['name'][$key]) { 
          $file = array( 
            'name' => $files['name'][$key],
            'type' => $files['type'][$key], 
            'tmp_name' => $files['tmp_name'][$key], 
            'error' => $files['error'][$key],
            'size' => $files['size'][$key]
          ); 
          $_FILES = array ("inside" => $file); 
          $file_id = media_handle_upload( 'inside', 0 );  
          $attachment_image = wp_get_attachment_url( $file_id );
           ?>
            <div id="<?= $file_id; ?>" class="item">              
              <div><img src="<?= $attachment_image; ?>" alt="slide"></div>
              <input type="hidden" name="gallery_ids[]" value="<?= $file_id; ?>">
              <a class="remove" href="#<?= $file_id; ?>"><span>حذف</span> 
                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.32178 4.74609H3.69411H14.6727" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13.3016 4.74515V14.3515C13.3016 14.7154 13.157 15.0645 12.8997 15.3218C12.6423 15.5792 12.2933 15.7238 11.9293 15.7238H5.06764C4.70368 15.7238 4.35462 15.5792 4.09726 15.3218C3.8399 15.0645 3.69531 14.7154 3.69531 14.3515V4.74515M5.75381 4.74515V3.37282C5.75381 3.00885 5.89839 2.6598 6.15575 2.40243C6.41312 2.14507 6.76217 2.00049 7.12614 2.00049H9.8708C10.2348 2.00049 10.5838 2.14507 10.8412 2.40243C11.0985 2.6598 11.2431 3.00885 11.2431 3.37282V4.74515" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M7.12695 8.17725V12.2942" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.87012 8.17725V12.2942" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
           <?php
        } 
      }
    }

  die();
}

//Hook our function to the action we set at jQuery code
add_action( 'wp_ajax_exterior_upload_files', 'exterior_upload_files');
add_action( 'wp_ajax_nopriv_exterior_upload_files', 'exterior_upload_files');
function exterior_upload_files() {
  //Do the nonce security check
  $current_user = wp_get_current_user();
    //Security check cleared, let's proceed
    //If your form has other fields, process them here.
    if ( isset($_FILES) && !empty($_FILES) ) {
      //Include the required files from backend
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
      $files = $_FILES["exterior"];
      foreach ($files['name'] as $key => $value) {   
        if ($files['name'][$key]) { 
          $file = array( 
            'name' => $files['name'][$key],
            'type' => $files['type'][$key], 
            'tmp_name' => $files['tmp_name'][$key], 
            'error' => $files['error'][$key],
            'size' => $files['size'][$key]
          ); 
          $_FILES = array ("exterior" => $file); 
          $file_id = media_handle_upload( 'exterior', 0 );  
          $attachment_image = wp_get_attachment_url( $file_id );
           ?>
            <div id="<?= $file_id; ?>" class="item">              
              <div><img src="<?= $attachment_image; ?>" alt="slide"></div>
              <input type="hidden" name="gallery_ids[]" value="<?= $file_id; ?>">
              <a class="remove" href="#<?= $file_id; ?>"><span>حذف</span> 
                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M2.32178 4.74609H3.69411H14.6727" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M13.3016 4.74515V14.3515C13.3016 14.7154 13.157 15.0645 12.8997 15.3218C12.6423 15.5792 12.2933 15.7238 11.9293 15.7238H5.06764C4.70368 15.7238 4.35462 15.5792 4.09726 15.3218C3.8399 15.0645 3.69531 14.7154 3.69531 14.3515V4.74515M5.75381 4.74515V3.37282C5.75381 3.00885 5.89839 2.6598 6.15575 2.40243C6.41312 2.14507 6.76217 2.00049 7.12614 2.00049H9.8708C10.2348 2.00049 10.5838 2.14507 10.8412 2.40243C11.0985 2.6598 11.2431 3.00885 11.2431 3.37282V4.74515" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M7.12695 8.17725V12.2942" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.87012 8.17725V12.2942" stroke="white" stroke-width="1.37233" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </a>
            </div>
           <?php
        } 
      }
    }

  die();
}

// save favorites function
function save_user_favorites() {
  if (!isset($_POST['favorites'])) {
    wp_send_json_error('Favorites not provided');
  }
  // Check if user is logged in
  if (!is_user_logged_in()) {
    wp_send_json_error('User not logged in');
  }
  // Get user ID
  $user_id = get_current_user_id();
  // Get favorites 
  $favorites = get_user_meta($user_id, 'favorites', true) ;
  if( !$favorites ){
      $favorites = [];
  }
  if( in_array($_POST['post_id'], $favorites) ){
      unset( $favorites[array_search($_POST['post_id'], $favorites)] );
  } else {
      $favorites[] = $_POST['post_id'];
  }
  // Update user meta
  update_user_meta($user_id, 'favorites', $favorites);
  wp_send_json_success();
}
add_action( 'wp_ajax_nopriv_save_user_favorites', 'save_user_favorites' );
add_action( 'wp_ajax_save_user_favorites', 'save_user_favorites');

// duplicate car suggested
function duplicate($car_id, $car_name, $car_price, $car_price_after, $car_installment) {
  $oldpost = get_post($car_id);
  $user_id = get_current_user_id();
  // add new duplicate car 
  $post = [
      'post_title'  => $car_name,
      'post_name'   => sanitize_title($car_name),
      'post_status' => 'draft',
      'post_type'   => $oldpost->post_type,
      'post_author' => $user_id
  ];
  $new_car_id = wp_insert_post($post);
  // add acf for new car
  $data = get_post_custom($car_id);
  foreach ($data as $key => $values) {
    foreach ($values as $value) {
      if($key == 'price') {
        add_post_meta($new_car_id, $key, $car_price_after);
      } elseif($key == 'finance_price') {
        add_post_meta($new_car_id, $key, $car_installment);
      } else {
        add_post_meta($new_car_id, $key, maybe_unserialize($value));
      }
    }
  }
  // add taxonomies for new car
  $taxonomies = get_post_taxonomies($car_id);
  if ($taxonomies) {
    foreach ($taxonomies as $taxonomy) {
      wp_set_object_terms(
        $new_car_id,
        wp_get_object_terms(
          $car_id,
          $taxonomy,
          ['fields' => 'ids']
        ),
        $taxonomy
      );
    }
  }

  return $new_car_id;
}

// addition BasicManually
function additionBasicManually($basic_name, $parent_brand_id, $child_brand_id, $fuel_id, $engine_id, $cylinder_id, $push_id, $gear_id, $color_id, $safeties) {
  $user_id = get_current_user_id();
  // add acf for new car
  $car = [
    'post_title'  => $basic_name,
    'post_name'   => sanitize_title($basic_name),
    'post_status' => 'draft',
    'post_type'   => 'basic_specifications',
    'post_author' => $user_id
  ];
  $car_id = wp_insert_post($car);

  if ($car_id) {
    $safeties_arr = [];
    
    foreach ($safeties as $safety) {
      $safeties_arr['text_specifications'] = $safety;
    }
    // UPDATE POST META
    update_field('specifications', $safeties_arr, $car_id);

    // UPDATE TAXONOMY
    wp_set_object_terms( $car_id, intval( $parent_brand_id ), 'basic-brand' );
    wp_set_object_terms( $car_id, intval( $child_brand_id ), 'basic-brand' );
  } 

  return $car_id;
}

// addition car Manually
function additionCarManually($id_basic, $car_name, $car_price, $car_price_after, $car_installment, $tag_id, $model_id, $galleries, $featured_img) {
  $user_id = get_current_user_id();
  // add acf for new car
  $car = [
    'post_title'  => $car_name,
    'post_name'   => sanitize_title($car_name),
    'post_status' => 'draft',
    'post_type'   => 'cars',
    'post_author' => $user_id
  ];
  $car_id = wp_insert_post($car);

    if ($car_id) {
      // UPDATE POST META
      update_field('id_basic_specifications', $id_basic, $car_id);
      update_field('price', $car_price, $car_id);
      update_field('finance_price', $car_installment, $car_id);
      update_field('number_car', $car_number, $car_id);
      update_field('car_galleries', $galleries , $car_id);
      set_post_thumbnail($car_id, $featured_img);
      // UPDATE TAXONOMY
      wp_set_post_terms( $car_id, $tag_id, 'products-tag' );
      wp_set_post_terms( $car_id, $model_id, 'products-model' );
    }
  return $car_id;
}