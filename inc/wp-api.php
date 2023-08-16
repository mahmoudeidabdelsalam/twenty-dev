<?php

// Format Post Type
function formatPost(&$post){
  unset($post->post_title, $post->post_author, $post->post_date, $post->post_modified, $post->post_date_gmt, $post->post_content, $post->comment_status, $post->ping_status, $post->post_password, $post->to_ping, $post->pinged, $post->post_modified_gmt, $post->post_content_filtered, $post->post_parent, $post->guid, $post->post_mime_type);
  unset($post->comment_count, $post->comment_count, $post->filter, $post->menu_order, $post->post_status);

}

// Get All Cars with filters
function all_cars($data){

  $data=$data->get_params('GET');
  extract($data);

  $per_page     = !empty($per_page) ? $per_page : 10;
  $page         = !empty($page) ? $page : true;
  $searchText   = !empty($searchText) ? $searchText : false;
  $type_id      = !empty($type_id) ? $type_id : false;
  $brand_id     = !empty($brand_id) ? $brand_id : false;
  $model_id     = !empty($model_id) ? $model_id : false;
  $price        = !empty($price) ? $price : false;
  $agent_id     = !empty($agent_id) ? $agent_id : false;
  $fuel_type    = !empty($fuel_type) ? $fuel_type : false;

  $args = array(
    'post_type'        => array( 'cars', 'products', 'basic_specifications' ),
    'posts_per_page'   => $per_page,
    'paged'            => $page ,
    'post_status'      => 'publish',
  );

  if($price != false) {
    $args['meta_key'] = 'price';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = $price;
  }
  

  if($searchText != false) {
    $args['s'] = $searchText;
  }

  if( $type_id != false && $brand_id == false && $model_id == false && $agent_id == false) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'products-tag',
        'field'    => 'term_id',
        'terms'    => $type_id,
      ),
    );
  }

  if( $model_id != false && $brand_id == false && $agent_id == false) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'products-model',
        'field'    => 'term_id',
        'terms'    => $model_id,
      ),   
      array(
        'taxonomy' => 'products-tag',
        'field'    => 'term_id',
        'terms'    => $type_id,
      ),
    );
  }


  if( $brand_id != false  && $model_id == false && $agent_id == false) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'products-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ),
      array(
        'taxonomy' => 'products-tag',
        'field'    => 'term_id',
        'terms'    => $type_id,
      ),
    );
  }

  if( $fuel_type != false && $model_id == false && $agent_id == false && $brand_id == false) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'fuel-type',
        'field'    => 'term_id',
        'terms'    => $fuel_type,
      ),
    );
  }

  if( $brand_id != false && $model_id != false && $agent_id == false) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'products-model',
        'field'    => 'term_id',
        'terms'    => $model_id,
      ), 
      array(
        'taxonomy' => 'products-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ),
      array(
        'taxonomy' => 'products-tag',
        'field'    => 'term_id',
        'terms'    => $type_id,
      ), 
    );
  }

  if($agent_id != false) {
    $args['author'] = $agent_id;
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'products-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ),
    );
  }

  $posts = new WP_Query( $args );
  
  if ( $posts->have_posts() ) {
    foreach( $posts->posts as &$post ):

      if($post->post_type == 'basic_specifications') {
        $rows = get_field('specifications', $post->ID );
        $cars = array(
          'post_type' => 'cars',
          'posts_per_page'   => $per_page,
          'paged'            => $page ,
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
        $posts = new WP_Query( $args );
        if ( $posts->have_posts() ) {
          foreach( $posts->posts as &$post ):
            $specifications = array();
  
            if( $rows ) {
              if($rows) {
                foreach( $rows as $key => $row ) {
                  if($key >= 3) {
                    break;
                  }
                  $specifications[$key]['name'] = $row['text_specifications'];
                }
              }
            }
      
            $post->id    = $post->ID;
            $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
            $post->price = get_post_meta( $post->ID, 'price', true );
            $post->image = get_the_post_thumbnail_url($post->ID, 'full' );
            $post->specifications = $specifications;
          endforeach;
        }
      } else {
        if($post->post_type == 'cars') {
          $id_basic_specifications = get_post_meta( $post->ID, 'id_basic_specifications', true );
          $rows = get_field('specifications', $id_basic_specifications );
        } else {
          $rows = get_field('specifications', $post->ID );
        }
        
        $specifications = array();
  
        if( $rows ) {
          if($rows) {
            foreach( $rows as $key => $row ) {
              if($key >= 3) {
                break;
              }
              $specifications[$key]['name'] = $row['text_specifications'];
            }
          }
        }
  
        $post->id    = $post->ID;
        $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
        $post->price = get_post_meta( $post->ID, 'price', true );
        $post->image = get_the_post_thumbnail_url($post->ID, 'full' );
        $post->specifications = $specifications;
  
      }


      unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
      formatPost($post);
    endforeach;
      

    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $posts->posts,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'cars Not Found',
    ];
  }
  
  return $result;

}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'cars',array(
    'methods' => 'GET',
    'callback' => 'all_cars',
    'args' => array(
      'per_page' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'page' => array(
        'validate_callback' => function($param,$request,$key){
          return is_numeric($param);
        }
      ),
      'searchText'  => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});

//single car ($data) {
function single_car($data){

  $data=$data->get_params('GET');
  extract($data);

  $car_id = !empty($car_id) ? $car_id : false;

  $post   = get_post( $car_id );

  $term_model_list = get_the_terms( $car_id, 'products-model' );
  $model = join(', ', wp_list_pluck($term_model_list, 'name')); 
  
  $term_tag_list = get_the_terms( $car_id, 'products-tag' );
  $tag = join(', ', wp_list_pluck($term_tag_list, 'name')); 

  $offer = get_post_meta( $post->ID, 'offers', true );

  $array = array(
    'id' => $post->ID,
    'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
    'price' => get_post_meta( $post->ID, 'price', true ),
    'color' => get_post_meta( $post->ID, 'color_car', true ),
    'image' => get_the_post_thumbnail_url($post->ID, 'full' ),
    'model' => $model,
    'category' => $tag,
    'number_car' => get_post_meta( $post->ID, 'number_car', true ),
    'km' => get_post_meta( $post->ID, 'km_car', true ),
    'offer' => $offer,
    'featured_car' => get_post_meta( $post->ID, 'featured_car', true ),
  );

  if($post->post_type == 'products') {
    $specifications = get_field('specifications', $post->ID );
    $brands = get_the_terms( $post->ID, 'products-brand' );
    $group = get_the_terms( $post->ID, 'products-group' );
    $array['brand_lvl_one'] = $brands[1]->name;
    $array['brand_lvl_two'] = $brands[0]->name;
    $array['brand_lvl_three '] = join(', ', wp_list_pluck($group, 'name'));
    $array['gallery'] =  get_field('car_galleries', $post->ID );

    $safety_list = array();
    foreach ($specifications as $key => $value) {
      $safety_list[] = $value['text_specifications'];
    }

    $array['specifications'] = array(
      'safety' => $safety_list,
    );
  }

  if($post->post_type == 'cars') {
    $id_basic_specifications = get_post_meta( $post->ID, 'id_basic_specifications', true );

    $brands = get_the_terms( $id_basic_specifications, 'basic-brand' );
    $array['brand_lvl_one'] = $brands[2]->name;
    $array['brand_lvl_two'] = $brands[1]->name;
    $array['brand_lvl_three '] = $brands[0]->name;
    $term_fuel_list = get_the_terms( $id_basic_specifications, 'fuel-type' );
    $array['fuels'] = join(', ', wp_list_pluck($term_fuel_list, 'name'));
    $term_gear_list = get_the_terms( $id_basic_specifications, 'gear-type' );
    $array['gears'] = join(', ', wp_list_pluck($term_gear_list, 'name'));
    $term_push_list = get_the_terms( $id_basic_specifications, 'push-type' );
    $array['pushs'] = join(', ', wp_list_pluck($term_push_list, 'name'));
    $term_cylinders_list = get_the_terms( $id_basic_specifications, 'cylinders-type' );
    $array['cylinders'] = join(', ', wp_list_pluck($term_cylinders_list, 'name'));
    $term_engine_list = get_the_terms( $id_basic_specifications, 'engine-type' );
    $array['engines'] = join(', ', wp_list_pluck($term_engine_list, 'name')); 

    $car_galleries = get_field('car_galleries', $post->ID );
    foreach($car_galleries as $key => $car_gallery) {
      $array['gallery'][] = $car_gallery['url'];
    }

    $specifications_list = [];
    $specifications = get_field('specifications', $id_basic_specifications );
    foreach ($specifications as $key => $value) {
      $specifications_list[] = $value['text_specifications'];
    }

    $comforts_list = [];
    $comforts = get_field('specifications_comforts', $id_basic_specifications );
    foreach ($comforts as $key => $value) {
      $comforts_list[] = $value['text_specifications'];
    }

    $technologies_list = [];
    $technologies = get_field('specifications_technologies', $id_basic_specifications );
    foreach ($technologies as $key => $value) {
      $technologies_list[] = $value['text_specifications'];
    }

    $external_equipment_list = [];
    $external_equipment = get_field('specifications_external_equipment', $id_basic_specifications );
    foreach ($external_equipment as $key => $value) {
      $external_equipment_list[] = $value['text_specifications'];
    }


    $array['specifications'] = array(
      'safety' => $specifications_list,
      'comforts' => $comforts_list,
      'technologies' => $technologies_list,
      'external_equipment' => $external_equipment_list,
    );


    // $array['safety'] = get_field('specifications', $id_basic_specifications );
    // $array['comforts'] = get_field('specifications_comforts', $id_basic_specifications );
    // $array['technologies'] = get_field('specifications_technologies', $id_basic_specifications );
    // $array['external_equipment'] = get_field('specifications_external_equipment', $id_basic_specifications );
  }

  if ($offer) {
    $array['image_offer'] = get_field('image_offer', $post->ID);
    $array['price_offer'] = get_post_meta( $post->ID, 'price_offer', true );
  }
  
  if ( $post ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $array,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'car Not Found',
    ];
  }
  
  return $result;

}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'cars/single',array(
    'methods' => 'GET',
    'callback' => 'single_car',
    'args' => array(
      'car_id' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});

// list tag ($data) 
function list_type($data){
  $list_type = [];
  $categories =  get_categories('hide_empty=1&taxonomy=products-tag');
  foreach ($categories as $term): 
    $list_type[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
    );
  endforeach; 
  if ( $list_type ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $list_type,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'tag Not Found',
    ];
  }
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'list_type',array(
    'methods' => 'GET',
    'callback' => 'list_type',
  ));
});

// list model ($data) 
function list_model($data){
  $list_model = [];
  $categories =  get_categories('parent=0&hide_empty=1&taxonomy=products-model');
  foreach ($categories as $term): 
    $list_model[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
    );
  endforeach; 
  if ( $list_model ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $list_model,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'model Not Found',
    ];
  }
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'list_model',array(
    'methods' => 'GET',
    'callback' => 'list_model',
  ));
});

// list brands ($data) 
function list_brands($data){
  $list_brands = [];
  $categories =  get_categories('parent=0&hide_empty=1&taxonomy=products-brand');
  foreach ($categories as $term): 
    $list_brands[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
    );
  endforeach; 
  if ( $list_brands ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $list_brands,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'brands Not Found',
    ];
  }
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'list_brands',array(
    'methods' => 'GET',
    'callback' => 'list_brands',
  ));
});


// list brands ($data) 
function list_fuel_type($data){
  $list_fuel_type = [];
  $categories =  get_categories('parent=0&hide_empty=1&taxonomy=fuel-type');
  foreach ($categories as $term): 
    $list_fuel_type[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
    );
  endforeach; 
  if ( $list_fuel_type ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $list_fuel_type,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'brands Not Found',
    ];
  }
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'list_fuel_type',array(
    'methods' => 'GET',
    'callback' => 'list_fuel_type',
  ));
});

// list cities ($data) 
function list_cities($data){
  $list_cities = [];
  $taxonomies_cities = get_terms( array(
    'taxonomy' => 'realestate-cities',
    'hide_empty' => false
  ) );
  foreach ($taxonomies_cities as $term): 
    $list_cities[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
    );
  endforeach; 
  if ( $list_cities ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $list_cities,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'brands Not Found',
    ];
  }
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'list_cities',array(
    'methods' => 'GET',
    'callback' => 'list_cities',
  ));
});



// list vendor list ($data) 
function vendor_list($data){
  $data=$data->get_params('GET');
  extract($data);

  $status = !empty($status) ? $status : false;
  $search = !empty($search) ? $search : false;
  $city = !empty($city) ? $city : false;

  $args = array (
    'role' => 'vendor',
    'orderby' => 'post_count',
  );

  if( $status != false ) {
    $args['meta_query'] = array(
      'relation' => 'OR',
      array(
          'key'     => 'vendor_cars_status',
          'value'   => $status,
          'compare' => 'LIKE'
      ),
      array(
        'key' => 'vendor_cars_status',
        'compare' => 'NOT EXISTS',
      ),
    );
  }


  if ($search != false) {
    $args = array (
      'search'         => '*'.esc_attr( $search ).'*',
      'search_columns' => array( 'display_name', 'user_email' ),
      'role' => 'vendor',
      'order' => 'ASC',
      'orderby' => 'display_name',
      'meta_query' => array(
        array(
            'key'     => 'vendor_cars_status',
            'value'   => $status,
            'compare' => 'LIKE'
        ),
      )
    );
  }
  
  
  if( $city != false ) {
    $args['meta_query'] = array(
      'relation' => 'AND',
      array(
        'key' => 'cities',
        'value'    => $city,
        'compare'    => 'LIKE',
      ),
      array(
        'key' => 'vendor_cars_status',
        'value'    => $status,
        'compare'    => 'LIKE',
      ),
    );
  }

  $vendors = get_users( $args );

  

  $vendor_list = [];

  foreach ($vendors as $vender): 
    $query = new WP_Query( array( 'author' => $vender->ID, 'post_type' => array('products', 'post', 'cars') ) );
    $vendor_list[] = array(
      'id' => $vender->ID,
      'name' => $vender->display_name,
      'background' => (get_field('user_background', 'user_'.$vender->ID))? get_field('user_background', 'user_'.$vender->ID) : "",
      'cities' => (get_field('cities', 'user_'.$vender->ID))? get_field('cities', 'user_'.$vender->ID) : "",
      'address' => (get_field('user_address', 'user_'.$vender->ID))? get_field('user_address', 'user_'.$vender->ID) : "",
      'email' => $vender->user_email,
      'phone' => (get_field('user_phone', 'user_'.$vender->ID))? get_field('user_phone', 'user_'.$vender->ID) : "",
      'whatsapp' => (get_field('user_whatsapp', 'user_'.$vender->ID))? get_field('user_whatsapp', 'user_'.$vender->ID) : "",
      'logo' => (get_field('user_logo', 'user_'.$vender->ID)) ? get_field('user_logo', 'user_'.$vender->ID) : "",
      'map' => (get_field('map_user', 'user_'.$vender->ID))? get_field('map_user', 'user_'.$vender->ID) : "",
      'cars' => $query->found_posts,
    );
  endforeach; 


  if ( $vendor_list ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $vendor_list,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'vendor Not Found',
    ];
  }
 
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'vendor/list',array(
    'methods' => 'GET',
    'callback' => 'vendor_list',
    'args' => array(
      'status' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'city' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'search' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});

// list agents list ($data) 
function agents_list($data){
  $data=$data->get_params('GET');
  extract($data);

  $status = !empty($status) ? $status : false;
  $search = !empty($search) ? $search : false;
  $city = !empty($city) ? $city : false;


  $args = array (
    'role' => 'agents',
  );

  if( $status != false ) {
    $args['meta_query'] = array(
      'relation' => 'OR',
      array(
          'key'     => 'vendor_cars_status',
          'value'   => $status,
          'compare' => 'LIKE'
      ),
      array(
        'key' => 'vendor_cars_status',
        'compare' => 'NOT EXISTS',
      ),
    );
  }


  if ($search != false) {
    $args = array (
      'search'         => '*'.esc_attr( $search ).'*',
      'search_columns' => array( 'display_name', 'user_email' ),
      'role' => 'agents',
      'order' => 'ASC',
      'orderby' => 'display_name',
      'meta_query' => array(
        array(
            'key'     => 'vendor_cars_status',
            'value'   => $status,
            'compare' => 'LIKE'
        ),
      )
    );
  }
  
  
  if( $city != false ) {
    $args['meta_query'] = array(
      'relation' => 'AND',
      array(
        'key' => 'cities',
        'value'    => $city,
        'compare'    => 'LIKE',
      ),
      array(
        'key' => 'vendor_cars_status',
        'value'    => $status,
        'compare'    => 'LIKE',
      ),
    );
  }

  $agents = get_users( $args );

  $agents_list = [];

  foreach ($agents as $agent): 
    $query = new WP_Query( array( 'author' => $agent->ID, 'post_type' => 'cars' ) );
    $term = get_field('cities', 'user_'.$agent->ID);
    $city  = get_term_by('id', $term, 'realestate-cities');
    $brands = get_field('brands', 'user_'.$agent->ID);

    $list_brands = [];

    if($brands):
      foreach ($brands as $brand) {
        $list_brands[] = array (
          'id' => $brand->term_id,
          'name' => $brand->name,
          'icon' => get_field('icon_term', $brand),
        );
      }
    endif;

    $agents_list[] = array(
      'id' => $agent->ID,
      'name' => $agent->display_name,
      'background' => (get_field('user_background', 'user_'.$agent->ID))? get_field('user_background', 'user_'.$agent->ID) : "",
      'cities' => $city->name,
      'address' => (get_field('user_address', 'user_'.$agent->ID))? get_field('user_address', 'user_'.$agent->ID) : "",
      'email' => $agent->user_email,
      'phone' => (get_field('user_phone', 'user_'.$agent->ID))? get_field('user_phone', 'user_'.$agent->ID) : "",
      'whatsapp' => (get_field('user_whatsapp', 'user_'.$agent->ID))? get_field('user_whatsapp', 'user_'.$agent->ID) : "",
      'logo' => (get_field('user_logo', 'user_'.$agent->ID))? get_field('user_logo', 'user_'.$agent->ID) : "",
      'map' => (get_field('user_map', 'user_'.$agent->ID))? get_field('user_map', 'user_'.$agent->ID) : "",
      'cars' => $query->found_posts,
      'brands' => $list_brands,
      'brands_count' => count($list_brands),
    );
  endforeach; 


  if ( $agents_list ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $agents_list,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'agent Not Found',
    ];
  }
 
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'agents/list',array(
    'methods' => 'GET',
    'callback' => 'agents_list',
    'args' => array(
      'status' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'city' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'search' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});


// single agents data ($data) 
function agents_single($data){
  $data=$data->get_params('GET');
  extract($data);

  $agent_id = !empty($agent_id) ? $agent_id : false;
  $agent = get_user_by('id', $agent_id);


  $agents_list = [];

  $query = new WP_Query( array( 'author' => $agent->ID, 'post_type' => 'cars' ) );

  $term = get_field('cities', 'user_'.$agent->ID);
  $city  = get_term_by('id', $term, 'realestate-cities');

  $brands = get_field('brands', 'user_'.$agent->ID);

  $list_brands = [];

  if($brands):
    foreach ($brands as $brand) {
      $list_brands[] = array (
        'id' => $brand->term_id,
        'name' => $brand->name,
        'icon' => get_field('icon_term', $brand),
      );
    }
  endif;

  $agents_list[] = array(
    'id' => $agent->ID,
    'name' => $agent->display_name,
    'background' => get_field('user_background', 'user_'.$agent->ID),
    'cities' => $city->name,
    'address' => get_field('user_address', 'user_'.$agent->ID),
    'email' => $agent->user_email,
    'phone' => get_field('user_phone', 'user_'.$agent->ID),
    'whatsapp' => get_field('user_whatsapp', 'user_'.$agent->ID),
    'logo' => get_field('user_logo', 'user_'.$agent->ID),
    'map' => get_field('map_user', 'user_'.$agent->ID),
    'cars' => $query->found_posts,
    'brands' => $list_brands,
    'brands_count' => count($list_brands),
  );


  if ( $agents_list ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $agents_list,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'agent Not Found',
    ];
  }
 
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'agents/single',array(
    'methods' => 'GET',
    'callback' => 'agents_single',
    'args' => array(
      'agent_id' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});


// brands agents data ($data) 
function agents_brands($data){
  $data=$data->get_params('GET');
  extract($data);

  $agent_id = !empty($agent_id) ? $agent_id : false;

  $brands_list = [];
  $brands = get_field('brands', 'user_'.$agent_id);

  if($brands):
    foreach( $brands as $brand ):
      $brands_list[] = array(
        'id' => $brand->term_id,
        'name' => $brand->name,
        'icon' => get_field('icon_term', $brand),
      );
    endforeach;
  endif;

  if ( $brands_list ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $brands_list,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'agent Not Found',
    ];
  }
 
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'agents/brands',array(
    'methods' => 'GET',
    'callback' => 'agents_brands',
    'args' => array(
      'agent_id' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});

// list Page list ($data) 
function page_list($data){
  $data=$data->get_params('GET');
  extract($data);

  $page_id = !empty($page_id) ? $page_id : false;
  $search = !empty($search) ? $search : false;
  
  $args = array (
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => -1,
  );

  if( $page_id != false ) {
    $args['p'] = $page_id;
  }

  if ($search != false && $page_id == false) {
    $args = array (
      'post_type' => 'page',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      's' => $search,
    );
  }

  $pages = get_posts( $args );

  $pages_list = [];

  if($page_id == 77) {
    $post_content = array(
      'headline'        => 'مرحبا بك في ' . get_field('headline', $page_id),
      'content'    =>  get_field('sub_headline', $page_id),
      'image_about_us'  =>  get_field('image_about_us', $page_id),
    );
  }

  foreach ($pages as $page): 
    $pages_list[] = array(
      'id' => $page->ID,
      'title' => $page->post_title,
      'content' => $post_content ? $post_content : $page->post_content,
      'image' => get_the_post_thumbnail_url($page->ID),
    );
  endforeach;


  if ( $pages_list ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $pages_list,
    ];  
  } else {
    $result = [
      'success' => 'false',
      'code' => 404,
      'message' => 'page Not Found',
    ];
  }
 
  return $result;
}

add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'pages',array(
    'methods' => 'GET',
    'callback' => 'page_list',
    'args' => array(
      'page_id' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'search' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),      
    )
  ));
});