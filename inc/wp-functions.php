<?php 
// Plugin Name: الماركة
add_action('wp_ajax_ajax_basic_brand', 'ajax_basic_brand', 0);
add_action('wp_ajax_nopriv_ajax_basic_brand', 'ajax_basic_brand');
function ajax_basic_brand() {
  if ( isset( $_POST['parent_id'] ) ) {
    $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=basic-brand');
    if($categories) {
      foreach ($categories as $cat) {
        $option .= '<option value="'.$cat->term_id.'">';
        $option .= $cat->cat_name;
        $option .= '</option>';
      }
      echo '<option value="0" selected="selected">اختار الماركة</option>'.$option;
      die();
    } else {
      echo '<option value="0" selected="selected">لا يوجد ماركة</option>';
    }
  }
  die;
}

// Plugin Name: الموديل
add_action('wp_ajax_ajax_child_basic_brand', 'ajax_child_basic_brand', 0);
add_action('wp_ajax_nopriv_ajax_child_basic_brand', 'ajax_child_basic_brand');
function ajax_child_basic_brand() {
  if ( isset( $_POST['parent_id'] ) ) {
    $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=basic-brand');
    if($categories) {
        foreach ($categories as $cat) {
          $option .= '<option value="'.$cat->term_id.'">';
          $option .= $cat->cat_name;
          $option .= '</option>';
        }
        echo '<option value="0" selected="selected">اختار الموديل</option>'.$option;
        die();
    } else {
      echo '<option value="0" selected="selected">لا يوجد الموديل</option>';
    }
  }
  die;
}

// Plugin Name: الماركة
add_action('wp_ajax_ajax_products_brand', 'ajax_products_brand', 0);
add_action('wp_ajax_nopriv_ajax_products_brand', 'ajax_products_brand');
function ajax_products_brand() {
  if ( isset( $_POST['parent_id'] ) ) {
    $categories=  get_categories('parent='.$_POST['parent_id'].'&hide_empty=1&taxonomy=products-brand');
    if($categories) {
      foreach ($categories as $cat) {
          $option .= '<option value="'.$cat->term_id.'">';
          $option .= $cat->cat_name;
          $option .= '</option>';
      }
      echo '<option value="0" selected="selected">اختار الماركة</option>'.$option;
      die();
    } else {
      echo '<option value="0" selected="selected">لا يوجد ماركة</option>';
    }
  }
  die;
}

// Plugin Name: الفئه
add_action('wp_ajax_ajax_child_products_brand', 'ajax_child_products_brand', 0);
add_action('wp_ajax_nopriv_ajax_child_products_brand', 'ajax_child_products_brand');
function ajax_child_products_brand() {
  if ( isset( $_POST['parent_id'] ) ) {
    $args = array(
      'post_type' => 'products',
      'posts_per_page' => -1,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'products-brand',
          'field' => 'term_id',
          'terms' => $_POST['parent_id'],
        ),
        array(
          'taxonomy' => 'products-tag',
          'field' => 'term_id',
          'terms' => $_POST['tag_type'],
        ),
      ),
    );
    $the_query = new WP_Query( $args );  
    $categories = [];
    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $term_obj = get_the_terms( get_the_ID(), 'products-group' );
        if ( ! is_wp_error( $term_obj ) ) {
          $categories[$term_obj[0]->term_id] = $term_obj[0];
        }
      }
      if($categories) {
          foreach ($categories as $cat) {
              $option .= '<option value="'.$cat->term_id.'">';
              $option .= $cat->name;
              $option .= '</option>';
          }
          echo '<option value="0" selected="selected">اختار الفئه</option>'.$option;
          die();
      } else {
          echo '<option value="0" selected="selected">لا يوجد الفئه</option>';
          die();
      }        
    } else {
      echo '<option value="0" selected="selected">لا يوجد الفئه</option>';
      die();
    }
  }
}

// Plugin Name: اللون
add_action('wp_ajax_ajax_color_selected', 'ajax_color_selected', 0);
add_action('wp_ajax_nopriv_ajax_color_selected', 'ajax_color_selected');
function ajax_color_selected() {
  if ( isset( $_POST['tag_id'] ) ) {
    $args = array(
      'post_type' => 'products',
      'posts_per_page' => -1,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'products-tag',
          'field' => 'term_id',
          'terms' => $_POST['tag_id'],
        ),
      ),
    );
    $the_query = new WP_Query( $args );
    $colors = [];
    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $colors[] = get_field('color_car');
      }
    }
    $arr_colors = array_unique($colors);
    if($arr_colors) {
      foreach ($arr_colors as $color) {
        if(empty($color)) {
          $option .= '<option value="0">';
          $option .= 'جميع الالوان';
          $option .= '</option>';
        } else {
          $option .= '<option value="'.$color.'">';
          $option .= $color;
          $option .= '</option>';
        }
      }
      echo '<option value="0" selected="selected">اختار اللون</option>'.$option;
      die();
    } else {
      echo '<option value="0" selected="selected">اي لون</option>';
    }
  }
  die;
}

// Plugin Name: السيارة
add_action('wp_ajax_ajax_child_car', 'ajax_child_car', 0);
add_action('wp_ajax_nopriv_ajax_child_car', 'ajax_child_car');
function ajax_child_car() {
  if ( isset( $_POST['model_id'] ) ) {
    $args = array(
      'post_type' => 'basic_specifications',
      'posts_per_page' => -1,
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'basic-brand',
          'field' => 'term_id',
          'terms' => $_POST['model_id'],
        ),
      ),
    );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
      while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $option .= '<option value="'.get_the_ID().'">';
        $option .= get_the_title();
        $option .= '</option>';
      }
      echo '<option value="0" selected="selected">اختار السيارة</option>'.$option;
      die();
    } else {
      echo '<option value="0" selected="selected">لا يوجد سيارة</option>';
    }
  }
  die;
}

// Plugin Name: السيارات
add_action('wp_ajax_ajax_get_basic_specifications', 'ajax_get_basic_specifications', 0);
add_action('wp_ajax_nopriv_ajax_get_basic_specifications', 'ajax_get_basic_specifications');
function ajax_get_basic_specifications() {
  if ( isset( $_POST['car_id'] )  ) {
    $car = get_post($_POST['car_id']);
    $featured_img_url = get_the_post_thumbnail_url($car->ID,'full');
    $featured_img_id = get_post_thumbnail_id( $car->ID );
    $images = get_field('car_galleries', $car->ID);
    $specifications = get_field('specifications', $car->ID);
    $specifications_comforts = get_field('specifications_comforts', $car->ID);
    $specifications_technologies = get_field('specifications_technologies', $car->ID);
    $specifications_external_equipment = get_field('specifications_external_equipment', $car->ID);
    $term_obj_list = get_the_terms( $car->ID, 'basic-brand' );
    $brands = join(', ', wp_list_pluck($term_obj_list, 'name'));
    $term_fuel_list = get_the_terms( $car->ID, 'fuel-type' );
    $fuels = join(', ', wp_list_pluck($term_fuel_list, 'name'));
    $term_gear_list = get_the_terms( $car->ID, 'gear-type' );
    $gears = join(', ', wp_list_pluck($term_gear_list, 'name'));
    $term_push_list = get_the_terms( $car->ID, 'push-type' );
    $pushs = join(', ', wp_list_pluck($term_push_list, 'name'));
    $term_cylinders_list = get_the_terms( $car->ID, 'cylinders-type' );
    $cylinders = join(', ', wp_list_pluck($term_cylinders_list, 'name'));
    $term_engine_list = get_the_terms( $car->ID, 'engine-type' );
    $engines = join(', ', wp_list_pluck($term_engine_list, 'name'));    
  ?>
    <section id="set_specifications">
      <div class="col-lg-12 col-md-12 px-2">
        <label for="#name" class="is-require">اسم السيارة</label>
        <input type="text" id="car_name" placeholder="اكتب اسم السيارة هنا" class="form-control custom-select px-4 mb-3" style="height: 50px; width: 100%;">
      </div>
      <?php if($brands): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>العلامة التجارة</h3>
            <p><?= $brands; ?></p>
        </div>
      <?php endif; ?>
      <?php if($fuels): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع الوقود</h3>
            <p><?= $fuels; ?></p>
        </div>
      <?php endif; ?>
      <?php if($gears): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع القير</h3>
            <p><?= $gears; ?></p>
        </div>
      <?php endif; ?>
      <?php if($pushs): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع الدفع</h3>
            <p><?= $pushs; ?></p>
        </div>
      <?php endif; ?>
      <?php if($cylinders): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>عدد الاسطوانات</h3>
            <p><?= $cylinders; ?></p>
        </div>
      <?php endif; ?>
      <?php if($engines): ?>
        <div class="col-lg-4 col-md-12 px-2">
          <h3>نوع المحرك</h3>
            <p><?= $engines; ?></p>
        </div>
      <?php endif; ?>
      <div class="col-lg-12 px-2">
        <h6>الصور <span>(اول صورة هي الصورة الرئيسية)</span></h6>
        <div class="images">
          <div class="featured-img"><img class="img-fluid" src="<?= $featured_img_url; ?>" alt="<?= the_title(); ?>"></div>
          <input type="hidden" name="featured_img" value="<?= $featured_img_id; ?>">          
          <div class="galleries">            
            <?php foreach( $images as $image ): ?>
              <input type="hidden" name="galleries[]" value="<?= $image['id']; ?>">
              <div><img src="<?= $image['url']; ?>" alt="slide"></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php if($specifications): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>الأمان</h3>
        <?php 
          foreach( $specifications as $specification ): 
            $icon = $specification['icon_specifications'];
            $text = $specification['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php if($specifications_comforts): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>الراحة</h3>
        <?php 
          foreach( $specifications_comforts as $comforts ): 
            $icon = $comforts['icon_specifications'];
            $text = $comforts['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php if($specifications_technologies): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>التقنيات</h3>
        <?php 
          foreach( $specifications_technologies as $technologies ): 
            $icon = $technologies['icon_specifications'];
            $text = $technologies['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
      <?php if($specifications_external_equipment): ?>
      <div class="col-lg-3 col-md-6 px-2 pull-right">
        <h3>تجهيزات خارجية</h3>
        <?php 
          foreach( $specifications_external_equipment as $external_equipment ): 
            $icon = $external_equipment['icon_specifications'];
            $text = $external_equipment['text_specifications'];
          ?>
          <div>
            <i class="fa <?= $icon; ?>"></i>
            <span><?= $text; ?></span>
          </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </section>
  <?php
  }
  die();
}

// Plugin Name: اضافة سيارة
add_action('wp_ajax_get_add_new_car', 'get_add_new_car', 0);
add_action('wp_ajax_nopriv_get_add_new_car', 'get_add_new_car');
function get_add_new_car() {
  $car_name = $_POST['car_name'];
  $car_id = $_POST['car_id'];
  $car_price = $_POST['car_price'];
  $car_tag = $_POST['car_tag'];
  $car_model = $_POST['car_model'];
  $car_color = $_POST['car_color'];
  $car_km = $_POST['car_km'];
  $car_number = $_POST['car_number'];
  $galleries = $_POST['galleries'];
  $featured_img = $_POST['featured_img'];
  $current_user = wp_get_current_user();
  $author_id = $current_user->ID;
  if ($car_id && $car_tag && $car_model && $car_price && $car_color && $car_name) {
    // Create post object
    $post = array(
      'post_title'    => wp_strip_all_tags( $_POST['car_name'] ),
      'post_status'   => 'pending',
      'post_author'   => $author_id,
      'post_type' => 'cars',
    );

    // Insert the post into the database
    $post_id =  wp_insert_post( $post );
    if ($post_id) {
      // UPDATE POST META
      update_field('id_basic_specifications', $car_id, $post_id);
      update_field('price', $car_price, $post_id);
      update_field('color_car', $car_color, $post_id);
      update_field('km_car', $car_km, $post_id);
      update_field('number_car', $car_number, $post_id);
      update_field('car_galleries', $galleries , $post_id);
      set_post_thumbnail($post_id, $featured_img);
      wp_set_post_terms( $post_id, $car_tag, 'products-tag' );
      wp_set_post_terms( $post_id, $car_model, 'products-model' );
      echo 'success';
    } else {
      echo 'error';
    }
  } else {
    echo 'error';
  }
    
  die();
}
  
// Plugin Name: ajax update users
add_action('wp_ajax_get_update_user', 'get_update_user', 0);
add_action('wp_ajax_nopriv_get_update_user', 'get_update_user');
function get_update_user() {
  $user_name    = $_POST['user_name'];
  $current_user = wp_get_current_user();
  $user_data = wp_update_user( array ('ID' => $current_user->ID, 'display_name' => $user_name));
  if ( is_wp_error( $user_data ) ) {
    // There was an error; possibly this user doesn't exist.
    echo 'Error.';
  } else {
    // Success!
    update_field( 'user_address', $_POST['user_address'], 'user_'.$current_user->ID );
    update_field( 'user_phone', $_POST['user_phone'], 'user_'.$current_user->ID );
    update_field( 'user_whatsapp', $_POST['user_whats'], 'user_'.$current_user->ID );
    update_field( 'map_user', $_POST['user_map'], 'user_'.$current_user->ID );
    update_field( 'user_content', $_POST['user_content'], 'user_'.$current_user->ID );  
    if ($_POST['user_logo']) {
      update_field( 'user_logo', $_POST['user_logo'], 'user_'.$current_user->ID );
    }
    if ($_POST['user_background']) {
      update_field( 'user_background', $_POST['user_background'], 'user_'.$current_user->ID );
    }
    echo 'User profile updated.';
  }
  die();
}

//Hook our function to the action we set at jQuery code
add_action( 'wp_ajax_pn_wp_frontend_ajax_upload', 'pn_upload_files');
add_action( 'wp_ajax_nopriv_pn_wp_frontend_ajax_upload', 'pn_upload_files');
function pn_upload_files() {
  $current_user = wp_get_current_user();
  if ( !isset($_POST['mynonce']) || !wp_verify_nonce( $_POST['mynonce'], 'myuploadnonce' ) ) {
      _e( 'Security Check Failed', 'pixelnet' ); 
  } else {
      if ( isset($_FILES) && !empty($_FILES) ) {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        if ( isset($_FILES['myfilefield']['error']) && $_FILES['myfilefield']['error'] == 0 ) {
            $file_id = media_handle_upload( 'myfilefield', 0 );              
            if ( !is_wp_error( $file_id ) ) {
                $attachment_image = wp_get_attachment_url( $file_id );
                if ($_POST['type'] == "logo") {
                  update_field( 'user_logo',  $file_id, 'user_'.$current_user->ID );
                }
                echo $attachment_image;
            }
        }
        if ( isset($_FILES['myfilefieldBg']['error']) && $_FILES['myfilefieldBg']['error'] == 0 ) {
          $file_id = media_handle_upload( 'myfilefieldBg', 0 );              
          if ( !is_wp_error( $file_id ) ) {
            $attachment_image = wp_get_attachment_url( $file_id );
              if ($_POST['type'] == 'background') {
                update_field( 'user_background',  $file_id, 'user_'.$current_user->ID );
              }
            echo $attachment_image;
          }
        }
      }
  }
  die();
}

//Hook our function to the action we set at jQuery code
add_action( 'wp_ajax_pn_wp_frontend_galleries_ajax_upload', 'pn_galleries_upload_files');
add_action( 'wp_ajax_nopriv_pn_wp_frontend_galleries_ajax_upload', 'pn_galleries_upload_files');
function pn_galleries_upload_files() {
  //Do the nonce security check
  $current_user = wp_get_current_user();
  if ( !isset($_POST['mynonce']) || !wp_verify_nonce( $_POST['mynonce'], 'myuploadnonce' ) ) {
    //Send the security check failed message
    _e( 'Security Check Failed', 'pixelnet' ); 
  } else {
    //Security check cleared, let's proceed
    //If your form has other fields, process them here.
    if ( isset($_FILES) && !empty($_FILES) ) {
      //Include the required files from backend
      require_once( ABSPATH . 'wp-admin/includes/image.php' );
      require_once( ABSPATH . 'wp-admin/includes/file.php' );
      require_once( ABSPATH . 'wp-admin/includes/media.php' );
      $files = $_FILES["galleriesfield"];  
      foreach ($files['name'] as $key => $value) {   
        if ($files['name'][$key]) { 
          $file = array( 
            'name' => $files['name'][$key],
            'type' => $files['type'][$key], 
            'tmp_name' => $files['tmp_name'][$key], 
            'error' => $files['error'][$key],
            'size' => $files['size'][$key]
          ); 
          $_FILES = array ("galleriesfield" => $file); 
          $file_id = media_handle_upload( 'galleriesfield', 0 );  
          $attachment_image = wp_get_attachment_url( $file_id );
           ?>
            <input type="hidden" name="galleries[]" value="<?= $file_id; ?>">
            <div><img src="<?= $attachment_image; ?>" alt="slide"></div>
           <?php
        } 
      }
    }
  }
  die();
}

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

// get all cars sold and delete him
add_action('wp_ajax_delete_cars_slod', 'delete_cars_slod', 0);
add_action('wp_ajax_nopriv_delete_cars_slod', 'delete_cars_slod');
function delete_cars_slod() {
  if ( isset( $_POST['post_ids'] ) ) {
    foreach ($_POST['post_ids'] as $key => $value) {
      wp_delete_post( (int)$value, true); 
    }
  }
  die;
}

// Plugin Name: ajax child brand الماركة
add_action('wp_ajax_ajax_child_brand', 'ajax_child_brand', 0);
add_action('wp_ajax_nopriv_ajax_child_brand', 'ajax_child_brand');
function ajax_child_brand() {
  if ( isset( $_POST['parent_id'] ) ) {
    $categories=  get_categories('child_of='.$_POST['parent_id'].'&hide_empty=1&taxonomy=products-brand');
    if($categories) {
      foreach ($categories as $cat) {
        $option .= '<option value="'.$cat->term_id.'">';
        $option .= $cat->cat_name;
        $option .= '</option>';
      }
      echo '<option value="0" selected="selected">اختار الماركة</option>'.$option;
      die();
    } else {
      echo '<option value="0" selected="selected">لا يوجد ماركة</option>';
    }
  }
  die;
}

// entry assign user
add_action('wp_ajax_entry_assign_user', 'entry_assign_user', 0);
add_action('wp_ajax_nopriv_entry_assign_user', 'entry_assign_user');
function entry_assign_user() {
  $user_id  = $_POST['user_id'];
  $entry_id = $_POST['entry_id'];
  $updated_entry = GFAPI::get_entry( $entry_id );
  $updated_entry['created_by'] = $user_id;
  $updated = GFAPI::update_entry( $updated_entry );
  die;
}
add_action( 'gform_after_update_entry', 'entry_assign_user', 10, 3 );

// entry actions
add_action('wp_ajax_entry_actions', 'entry_actions', 0);
add_action('wp_ajax_nopriv_entry_actions', 'entry_actions');
function entry_actions() {
  $status  = $_POST['status'];
  $entry_id = $_POST['entry_id'];
  $updated_entry = GFAPI::get_entry( $entry_id );
  $updated_entry['approval_status'] = $status;
  $updated_entry['approval_status_1'] = $status;
  $updated = GFAPI::update_entry( $updated_entry );
  die;
}
add_action( 'gform_after_update_entry', 'entry_entry_actions', 10, 3 );

