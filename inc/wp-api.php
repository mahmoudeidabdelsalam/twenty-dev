<?php
// List Cars with filters
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
  
  $count_car = $posts->found_posts;
  $counter = [];

  if ( $posts->have_posts() ) {
    foreach( $posts->posts as &$post ):

      $counter[] = get_post_meta( $post->ID, 'link_click_counter', true );

      if($post->post_type == 'basic_specifications') {
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
        $posts = new WP_Query( $cars );
        if ( $posts->have_posts() ) {
          foreach( $posts->posts as &$post ):
            $specifications = array();

            $author_id = $post->post_author;
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $user_whatsapp = get_field('user_whatsapp', 'user_'. $author_id);
            $user_phone = get_field('user_phone', 'user_'. $author_id);
            $author = [
              'id'    => $author_id,
              'image' => $avatar,
              'name' => get_the_author_meta( 'display_name', $author_id ),
              'phone' => $user_phone,
              'whatsapp' => $user_whatsapp,
            ];
      
            $post->id    = $post->ID;
            $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
            $post->price = get_post_meta( $post->ID, 'price', true );
            $post->image = get_the_post_thumbnail_url($post->ID, 'full' );

            $post->offer = ($offer)? $offer: '';
            $post->offer_price = get_post_meta( $post->ID, 'price_offer', true );

            $post->installment_price = get_post_meta( $post->ID, 'finance_price', true );
            $post->author = $author;

            unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
            formatPost($post);
          endforeach;
        }
      } else {
        $offer = get_post_meta( $post->ID, 'offers', true );
        $author_id = $post->post_author;
        $avatar = get_field('user_logo', 'user_'. $author_id);
        $author = [
          'id'    => $author_id,
          'image' => $avatar,
          'name' => get_the_author_meta( 'display_name', $author_id ),
        ];
        $post->id    = $post->ID;
        $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
        $post->price = get_post_meta( $post->ID, 'price', true );
        $post->image = get_the_post_thumbnail_url($post->ID, 'full' );
        // Get offer price and installments from offers meta data.
        $post->offer = ($offer)? $offer: '';
        $post->offer_price = get_post_meta( $post->ID, 'price_offer', true );
        $post->installment_price = get_post_meta( $post->ID, 'finance_price', true );
        $post->author = $author;
      }


      unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
      formatPost($post);
    endforeach;
      
    $agents = [];

    if($agent_id != false) {
      $agents['count_cars'] = $count_car;
      $agents['count_visitors'] = array_sum($counter);

      $result = [
        "success" => true,
        "code" => 200,
        "message" => 'Successfully retrieved',
        "agent" => $agents,
        "data" => $posts->posts,
      ]; 
    } else {
      $result = [
        "success" => true,
        "code" => 200,
        "message" => 'Successfully retrieved',
        "data" => $posts->posts,
      ];  
    }
     
  } else {
    $result = [
      'success' => 'false',
      'code' => 200,
      'message' => 'cars Not Found',
      "data" => []
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

// single car ($data) {
function single_car($data){

  $data=$data->get_params('GET');
  extract($data);

  $car_id = !empty($car_id) ? $car_id : false;

  $post   = get_post( $car_id );

  if($post) {

    $author_id = $post->post_author;
    $avatar = get_field('user_logo', 'user_'. $author_id);
    $term_model_list = get_the_terms( $car_id, 'products-model' );
    $model = join(', ', wp_list_pluck($term_model_list, 'name')); 
    $term_tag_list = get_the_terms( $car_id, 'products-tag' );
    $tag = join(', ', wp_list_pluck($term_tag_list, 'name')); 
    $offer = get_post_meta( $post->ID, 'offers', true );
    if (is_numeric(get_post_meta( $post->ID, 'price', true ))) {
      $price_tax += get_post_meta( $post->ID, 'price', true ) * 100 / 115;
    } else {
      $price_tax = "";
    }
    
    $counter_view = get_post_meta($post->ID, "link_click_counter", true);

    $array = array(
      'id' => $post->ID,
      'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
      'price' => get_post_meta( $post->ID, 'price', true ),
      'before_tax' => ($price_tax)? number_format($price_tax, 3, '.', ','): '',
      'installment_price' => get_post_meta( $post->ID, 'finance_price', true ),
      'color' => get_post_meta( $post->ID, 'color_car', true ),
      'image' => (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ):'',
      'model' => $model,
      'category' => $tag,
      'number_car' => get_post_meta( $post->ID, 'number_car', true ),
      'km' => get_post_meta( $post->ID, 'km_car', true ),
      'featured_car' => get_post_meta( $post->ID, 'featured_car', true ),
      'author' => [
        'id'    => $author_id,
        'image' => ($avatar)? $avatar:'',
        'name' => get_the_author_meta( 'display_name', $author_id ),
        'phone' => (get_field('user_phone', 'user_'.$author_id))? get_field('user_phone', 'user_'.$author_id) : "",
        'whatsapp' => (get_field('user_whatsapp', 'user_'.$author_id))? get_field('user_whatsapp', 'user_'.$author_id) : "",
      ],
      'counter_view' => $counter_view,
      'link_financing' => "https://twenty.sa/financing/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
      'link_buying' => "https://twenty.sa/buying/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
      'link_report_agent' => "https://twenty.sa/report-agent/?author=". get_the_author_meta( 'display_name', $author_id ).""
    );

    $offer = get_post_meta( $post->ID, 'offers', true );
    $array['offer'] = ($offer)? $offer: '';
    $array['image_offer'] = (get_post_meta($post->ID, 'image_offer', true))? get_post_meta($post->ID, 'image_offer', true):'';
    $array['price_offer'] = get_post_meta( $post->ID, 'price_offer', true );
    

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
      
      $array['gallery_type'] = 'images';
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
    }


    $list_related = [];
    $related = get_posts( array( 'author' => $author_id, 'post_type' => array('products', 'cars'), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
    if( $related )  {
      foreach( $related as $post ) {
        setup_postdata($post);
        $author_id = $post->post_author;
        $avatar = get_field('user_logo', 'user_'. $author_id);
        $counter_view = get_post_meta($post->ID, "link_click_counter", true);
        $list_related[] = array( 
          'id' => $post->ID,
          'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
          'image' => (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ):'',
          'price' => get_post_meta( $post->ID, 'price', true ),
          'offer' => (get_post_meta( $post->ID, 'offers', true ))? get_post_meta( $post->ID, 'offers', true ):'',
          'price_offer' => get_post_meta( $post->ID, 'price_offer', true ),
          'author' => [
            'id'    => $author_id,
            'image' => ($avatar)? $avatar:'',
            'name' => get_the_author_meta( 'display_name', $author_id ),
            'phone' => (get_field('user_phone', 'user_'.$author_id))? get_field('user_phone', 'user_'.$author_id) : "",
            'whatsapp' => (get_field('user_whatsapp', 'user_'.$author_id))? get_field('user_whatsapp', 'user_'.$author_id) : "",
          ],
          'counter_view' => $counter_view,
          'link_financing' => "https://twenty.sa/financing/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
          'link_buying' => "https://twenty.sa/buying/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
          'link_report_agent' => "https://twenty.sa/report-agent/?author=". get_the_author_meta( 'display_name', $author_id ).""
        );
      }
    }

    $array['list_related_car'] = $list_related;

    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $array,
    ];
  } else {
    $result = [
      'success' => 'false',
      'code' => 200,
      'message' => 'car Not Found',
      'data' => []
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
      'code' => 200,
      'message' => 'tag Not Found',
      'data' => []
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

// list shape ($data) 
function list_shape($data){
  $list_type = [];
  $categories =  get_categories('hide_empty=1&taxonomy=shape-type');
  foreach ($categories as $term): 
    $list_type[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
      'image' => (get_field('icon_term', $term))? get_field('icon_term', $term): null,
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
      'code' => 200,
      'message' => 'tag Not Found',
      "data" => []
    ];
  }
  return $result;
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'list_shape',array(
    'methods' => 'GET',
    'callback' => 'list_shape',
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
      'code' => 200,
      'message' => 'model Not Found',
      "data" => []
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
      'image' => (get_field('icon_term', $term))? get_field('icon_term', $term): null,
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
      'code' => 200,
      'message' => 'brands Not Found',
      "data" => []
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

// list fuel ($data) 
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
      'code' => 200,
      'message' => 'brands Not Found',
      "data" => []
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
      'code' => 200,
      'message' => 'brands Not Found',
      "data" => []
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

  $status     = !empty($status) ? $status : false;
  $search     = !empty($search) ? $search : false;
  $city       = !empty($city) ? $city : false;
  $paged      = !empty($page) ? $page : 1;
  $per_page   = !empty($per_page) ? $per_page : 9;



  $args = array(
    'post_type'         => array( 'car-show' ),
    'posts_per_page'    => $per_page,
    'paged'             => $paged,
  );


  if( $status != false ) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'show-type',
        'field'    => 'term_id',
        'terms'    => $status,
      ),
    );
  }

  if ($search != false) {
    $args['s'] = $search;
  }
  
   if( $city != false ) {
    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'realestate-cities',
        'field'    => 'term_id',
        'terms'    => $city,
      ),
    );
  }


  // $vendors = get_users( $args );
  $query = new WP_Query( $args );
  $vendor_list = [];

  foreach( $query->posts as &$post ):
    $author_id = $post->post_author;
    $query = new WP_Query( array( 'author' => $author_id, 'post_type' => array('products', 'post', 'cars') ) );
    $views = array();
    foreach( $query->posts as &$post ):
      $views[] = get_post_meta( $post->ID, 'link_click_counter', true );
      unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
      formatPost($post);
    endforeach;

    preg_match('/src="([^"]+)"/', get_field('map_user', 'user_'.$author_id), $match);
    $map_link = $match[1];

    $list_whatsapps = [];
    if( have_rows('user_whatsapps', 'user_'. $author_id) ):
      while ( have_rows('user_whatsapps', 'user_'. $author_id) ) : the_row(); 
          $list_whatsapps[] = get_sub_field('number_whatsapp');
      endwhile;
    endif;
    $list_phones = [];
    if( have_rows('user_phones', 'user_'. $author_id) ):
      while ( have_rows('user_phones', 'user_'. $author_id) ) : the_row(); 
          $list_phones[] = get_sub_field('number_phone');
      endwhile;
    endif;

    $status = get_field('vendor_cars_status', 'user_'.$author_id);
    
    $vendor_list[] = array(
      'id' => $author_id,
      'name' => get_the_author_meta( 'display_name', $author_id ),
      'background' => (get_field('user_background', 'user_'.$author_id))? get_field('user_background', 'user_'.$author_id) : "",
      'cities' => (get_field('cities', 'user_'.$author_id))? get_field('cities', 'user_'.$author_id) : "",
      'address' => (get_field('user_address', 'user_'.$author_id))? get_field('user_address', 'user_'.$author_id) : "",
      'email' => get_the_author_meta( 'user_email', $author_id ),
      'phone' => (get_field('user_phone', 'user_'.$author_id))? get_field('user_phone', 'user_'.$author_id) : "",
      'list_phones' => $list_phones,
      'whatsapp' => (get_field('user_whatsapp', 'user_'.$author_id))? get_field('user_whatsapp', 'user_'.$author_id) : "",
      'list_whatsapps' => $list_whatsapps,
      'logo' => (get_field('user_logo', 'user_'.$author_id)) ? get_field('user_logo', 'user_'.$author_id) : "",
      'map' => (get_field('map_user', 'user_'.$author_id))? get_field('map_user', 'user_'.$author_id) : "",
      'map_link' => $map_link,
      'cars' => $query->found_posts,
      'status' => ($status)? $status:"",
      'views' => array_sum($views)
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
      'code' => 200,
      'message' => 'vendor Not Found',
      "data" => []
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


// single vendor data ($data) 
function vendor_single($data){
  $data=$data->get_params('GET');
  extract($data);

  $vendor_id = !empty($vendor_id) ? $vendor_id : false;
  $vendor = get_user_by('id', $vendor_id);


  $vendors_list = [];

  $query = new WP_Query( array( 'author' => $vendor_id, 'post_type' => array('cars', 'products') ) );

  $term = get_field('cities', 'user_'.$vendor_id);
  $city  = get_term_by('id', $term, 'realestate-cities');

  
  $status = get_field('vendor_cars_status', 'user_'.$vendor_id);

  $views = array();
  foreach( $query->posts as &$post ):
    $offer = get_post_meta( $post->ID, 'offers', true );
    $specifications = array();
    $views[] = get_post_meta( $post->ID, 'link_click_counter', true );
    $author_id = $post->post_author;
    $avatar = get_field('user_logo', 'user_'. $author_id);
    $author = [
      'id'    => $author_id,
      'image' => $avatar,
      'name' => get_the_author_meta( 'display_name', $author_id ),
    ];
    $post->id    = $post->ID;
    $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
    $post->price = get_post_meta( $post->ID, 'price', true );
    $post->image = (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ): '';

    // Get offer price and installments from offers meta data.
    $post->offer = ($offer)? $offer: '';
    $post->offer_price = get_post_meta( $post->ID, 'price_offer', true );

    $post->installment_price = get_post_meta( $post->ID, 'finance_price', true );
    $post->view = get_post_meta( $post->ID, 'link_click_counter', true );
    $post->author = $author;
    $post->link = get_permalink($post->ID);
    unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
    formatPost($post);
  endforeach;


  preg_match('/src="([^"]+)"/', get_field('map_user', 'user_'.$vendor_id), $match);
  $map_link = $match[1];

  $list_whatsapps = [];
  if( have_rows('user_whatsapps', 'user_'. $vendor_id) ):
    while ( have_rows('user_whatsapps', 'user_'. $vendor_id) ) : the_row(); 
        $list_whatsapps[] = get_sub_field('number_whatsapp');
    endwhile;
  endif;
  $list_phones = [];
  if( have_rows('user_phones', 'user_'. $vendor_id) ):
    while ( have_rows('user_phones', 'user_'. $vendor_id) ) : the_row(); 
        $list_phones[] = get_sub_field('number_phone');
    endwhile;
  endif;

  $vendors_list[] = array(
    'id' => $vendor->ID,
    'name' => $vendor->display_name,
    'background' => get_field('user_background', 'user_'.$vendor->ID),
    'cities' => ($city)?$city->name:"",
    'address' => get_field('user_address', 'user_'.$vendor->ID),
    'email' => $vendor->user_email,
    'phone' => get_field('user_phone', 'user_'.$vendor->ID),
    'list_phones' => $list_phones,
    'whatsapp' => get_field('user_whatsapp', 'user_'.$vendor->ID),
    'list_whatsapps' => $list_whatsapps,
    'logo' => get_field('user_logo', 'user_'.$vendor->ID),
    'map' => get_field('map_user', 'user_'.$vendor->ID),
    'map_link' => $map_link,
    'cars' => $query->found_posts,
    'list_cars' => $query->posts,
    'status' => ($status)? $status:"",
    'views' => array_sum($views)
  );


  if ( $vendors_list ) {
    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $vendors_list,
    ];  
  } else {
    $result = [
      "success" => false,
      "code" => 401,
      "message" => 'vendor Not Found',
      "data" => [],
    ];
  }
 
  return $result;
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'vendor/single',array(
    'methods' => 'GET',
    'callback' => 'vendor_single',
    'args' => array(
      'vendor_id' => array(
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
    $query      = new WP_Query( array( 'author' => $agent->ID, 'post_type' => 'cars' ) );
    $term       = get_field('cities', 'user_'.$agent->ID);
    $city       = get_term_by('id', $term, 'realestate-cities');
    $brands     = get_field('brands', 'user_'.$agent->ID);

    $list_brands = [];

    if($brands):
      foreach ($brands as $brand) {
        $list_brands[] = array (
          'id' => $brand->term_id,
          'name' => $brand->name,
          'image' => (get_field('icon_term', $brand))? get_field('icon_term', $brand): null,
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
      "success" => false,
      "code" => 401,
      "message" => 'agent Not Found',
      "data" => [],
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

  $query = new WP_Query( array( 'author' => $agent->ID, 'post_type' => array('cars', 'products') ) );

  $term = get_field('cities', 'user_'.$agent->ID);
  $city  = get_term_by('id', $term, 'realestate-cities');

  $brands = get_field('brands', 'user_'.$agent->ID);

  $list_brands = [];

  if($brands):
    foreach ($brands as $brand) {
      $list_brands[] = array (
        'id' => $brand->term_id,
        'name' => $brand->name,
        'image' => (get_field('icon_term', $brand))? get_field('icon_term', $brand): null,
      );
    }
  endif;

  $views = array();
  foreach( $query->posts as &$post ):
    $specifications = array();
    $views[] = get_post_meta( $post->ID, 'link_click_counter', true );
    $author_id = $post->post_author;
    $avatar = get_field('user_logo', 'user_'. $author_id);
    $author = [
      'id'    => $author_id,
      'image' => $avatar,
      'name' => get_the_author_meta( 'display_name', $author_id ),
    ];
    $post->id    = $post->ID;
    $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
    $post->price = get_post_meta( $post->ID, 'price', true );
    $post->image = (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ): '';

    // Get offer price and installments from offers meta data.
    $post->offer = ($offer)? $offer: '';
    $post->offer_price = get_post_meta( $post->ID, 'price_offer', true );

    $post->installment_price = get_post_meta( $post->ID, 'finance_price', true );
    $post->view = get_post_meta( $post->ID, 'link_click_counter', true );
    $post->author = $author;
    $post->link = get_permalink($post->ID);
    unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
    formatPost($post);
  endforeach;


  preg_match('/src="([^"]+)"/', get_field('map_user', 'user_'.$agent->ID), $match);
  $map_link = $match[1];

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
    'map_link' => $map_link,
    'cars' => $query->found_posts,
    'brands' => $list_brands,
    'brands_count' => count($list_brands),
    'list_cars' => $query->posts,
    'views' => array_sum($views)
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
      "success" => false,
      "code" => 401,
      "message" => 'agent Not Found',
      "data" => [],
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
        'image' => (get_field('icon_term', $brand))? get_field('icon_term', $brand): null,
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
      "success" => false,
      "code" => 401,
      "message" => 'agent Not Found',
      "data" => [],
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
      'image' => (get_the_post_thumbnail_url($page->ID))? get_the_post_thumbnail_url($page->ID): '',
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
      'code' => 200,
      'message' => 'page Not Found',
      "data" => []
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

// list Page list ($data) 
function banner_home($data){
  $data=$data->get_params('GET');
  extract($data);

  $page_id = !empty($page_id) ? $page_id : false;
  
  $args = array (
    'post_type' => 'page',
    'post_status' => 'publish',
    'posts_per_page' => -1,
  );

  if( $page_id != false ) {
    $args['p'] = $page_id;
  }

  $pages = get_posts( $args );

  $pages_list = [];

  foreach ($pages as $page): 
    $rows = get_field('slider_home', $page->ID);
    foreach( $rows as $key => $row ):
      $pages_list[$key]['image'] = $row['image_slider'];
      $pages_list[$key]['link'] = ($row['page_slider'])? $row['page_slider']['url']:'';
      $pages_list[$key]['label'] = $row['content_slider'];
    endforeach;
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
      'code' => 200,
      'message' => 'page Not Found',
      "data" => []
    ];
  }
 
  return $result;
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'banner',array(
    'methods' => 'GET',
    'callback' => 'banner_home',
    'args' => array(
      'page_id' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),     
    )
  ));
});

// Get All Cars with filters
function offers_cars($data){

  $data=$data->get_params('GET');
  extract($data);

  $per_page     = !empty($per_page) ? $per_page : 10;
  $page         = !empty($page) ? $page : true;


  $args = array(
    'post_type'      => array( 'cars', 'products' ),
    'posts_per_page'   => $per_page,
    'paged'            => $page ,
    'meta_query' => array(
      array(
        'key'     => 'offers',
        'value' => '1',
      ),
    )
  );

  $posts = new WP_Query( $args );
  
  if ( $posts->have_posts() ) {
    foreach( $posts->posts as &$post ):

        $post->id    = $post->ID;
        $post->title = htmlspecialchars_decode( get_the_title($post->ID) );        
        $post->image = (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ): '';
        $post->price = get_post_meta( $post->ID, 'price', true );
        $post->installment_price = get_post_meta( $post->ID, 'price_offer', true );
        $post->link = get_permalink($post->ID);

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
      'code' => 200,
      'message' => 'cars Not Found',
      "data" => []
    ];
  }
  
  return $result;

}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'offers',array(
    'methods' => 'GET',
    'callback' => 'offers_cars',
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
    )
  ));
});

function login_user($data){

  $data=$data->get_params('POST');
  extract($data);

  $email = !empty($email) ? $email : false;
  $password = !empty($password) ? $password : false;

  $args = array(
    'count_total'  => false,
    'fields'       => 'all',
  ); 
  
  $users = get_users( $args );

  if($email && $password){

    $emails = [];
    $passwords = [];

    foreach ($users as $user) {
      $passwords[] = $user->user_pass;
      $emails[] =  $user->user_email;
    }


    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $user = get_user_by( 'email', $email );
    } else {
      $user = get_userdatabylogin($email);
      $email = $user->user_email;
    }
    
    $userId = $user->ID;
    $user_meta = get_userdata($userId);
    $user_roles = $user_meta->roles;

    if(in_array("administrator", $user_roles)){
      $admin = true;
    } else {
      $admin = false;
    }

    if (in_array($email, $emails) && wp_check_password( $password, $user->data->user_pass, $user->ID)) { 
      $login = true;
      $message = 'successfully Login';
    } else { 
      $login = false;
      $message = 'email or password wrong, try to login again';
    } 

    $array =  [
      'IsSuccess' => $login,
      'IsAdmin' => $admin
    ];

    $result = [
      'success' => true,
      'code' => 200,
      'message' => $message,
      'data' => $array,
    ];
    return $result;
  } else {
    $result = [
      'success' => false,
      'code' => 200,
      'message' => 'login or password not fund',
      "data" => []
    ];
    return $result;
  }
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'login',array(
    'methods' => 'POST',
    'callback' => 'login_user',
    'args' => array(
      'email' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
      'password' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),      
    )
  ));
});

// list vendor list ($data) 
function partners_list($data){
  $data=$data->get_params('GET');
  extract($data);

  $pre_page = !empty($pre_page) ? $pre_page : false;

  $args = array (
    'role' => 'vendor',
    'orderby' => 'post_count',
    'number' => $pre_page
  );

  $vendors = get_users( $args );

  $vendor_list = [];

  foreach ($vendors as $vender): 
    $query = new WP_Query( array( 'author' => $vender->ID, 'post_type' => array('products', 'post', 'cars') ) );
    $vendor_list[] = array(
      'id' => $vender->ID,
      'name' => $vender->display_name,
      'background' => (get_field('user_background', 'user_'.$vender->ID))? get_field('user_background', 'user_'.$vender->ID) : null,
      'image' => (get_field('user_logo', 'user_'.$vender->ID)) ? get_field('user_logo', 'user_'.$vender->ID) : null,
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
      'code' => 200,
      'message' => 'vendor Not Found',
      "data" => []
    ];
  }
 
  return $result;
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'partners',array(
    'methods' => 'GET',
    'callback' => 'partners_list',
    'args' => array(
      'per_page' => array(
        'validate_callback' => function($param,$request,$key){
          return true;
        }
      ),
    )
  ));
});

// list brands laval ($data) 
function lvl_brands($data){

  $data=$data->get_params('GET');
  extract($data);

  $brand_id      = !empty($brand_id) ? $brand_id : false;
  $brand_child_id      = !empty($brand_child_id) ? $brand_child_id : false;

  $list_brands = [];
  if($brand_child_id) {
    $categories=  get_categories('parent='.$brand_child_id.'&hide_empty=1&taxonomy=basic-brand');
  } elseif($brand_id) {
    $categories=  get_categories('parent='.$brand_id.'&hide_empty=1&taxonomy=basic-brand');
  } else {
    $categories =  get_categories('parent=0&hide_empty=1&taxonomy=basic-brand');
  }  
  
  foreach ($categories as $term): 
    $list_brands[] = array(
      'id' => $term->term_id,
      'name' => $term->name,
      'image' => (get_field('icon_term', $term))? get_field('icon_term', $term): null,
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
      'code' => 200,
      'message' => 'brands Not Found',
      "data" => []
    ];
  }
  return $result;
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'lvl_brands',array(
    'methods' => 'GET',
    'callback' => 'lvl_brands',
    'args' => array(

    )
  ));
});

// Get Filter Cars
function filters_cars($data){

  $data=$data->get_params('GET');
  extract($data);

  
  $brand_id         = !empty($brand_id) ? $brand_id : false; // العلامة التجارية
  $brand_lo_id      = !empty($brand_lo_id) ? $brand_lo_id : false;
  $brand_lt_id      = !empty($brand_lt_id) ? $brand_lt_id : false;
  $shape_type       = !empty($shape_type) ? $shape_type : false;
  

  $type_id          = !empty($type_id) ? $type_id : false; // النوع
  $price_from       = !empty($price_from) ? $price_from : false; // السعر
  $price_to         = !empty($price_to) ? $price_to : false; 
  $model_from_id    = !empty($model_from_id) ? $model_from_id : false; // السنة
  $model_to_id      = !empty($model_to_id) ? $model_to_id : false;

  $args = array(
    'post_type'        => array( 'cars', 'products', 'basic_specifications' ),
    'posts_per_page'   => $per_page,
    'paged'            => $page ,
    'post_status'      => 'publish',
  );

  if( $brand_lt_id &&  $shape_type) {
    $args['tax_query'] = array(
      'relation' => 'AND', 
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_lt_id,
      ), 
      array(
        'taxonomy' => 'shape-type',
        'field'    => 'term_id',
        'terms'    => $shape_type,
      ), 
    );
  } elseif($brand_lt_id) {
    $args['tax_query'] = array(
      'relation' => 'AND', 
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_lt_id,
      ),      
    );
  } elseif($brand_lo_id &&  $shape_type) {
    $args['tax_query'] = array(
      'relation' => 'AND', 
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_lo_id,
      ),
      array(
        'taxonomy' => 'shape-type',
        'field'    => 'term_id',
        'terms'    => $shape_type,
      ),       
    );
  } elseif($brand_lo_id) {
    $args['tax_query'] = array(
      'relation' => 'AND', 
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_lo_id,
      ),       
    );
  } elseif($brand_id && $shape_type) {
    $args['tax_query'] = array(
      'relation' => 'AND', 
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ), 
      array(
        'taxonomy' => 'shape-type',
        'field'    => 'term_id',
        'terms'    => $shape_type,
      ), 
    );
  } elseif($brand_id) {
    $args['tax_query'] = array(
      'relation' => 'AND', 
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ), 
    );
  }


  $posts = new WP_Query( $args );
  
  $count_car = $posts->found_posts;
  $counter = [];

  if ( $posts->have_posts() ) {
    foreach( $posts->posts as &$post ):

      $counter[] = get_post_meta( $post->ID, 'link_click_counter', true );


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

        if($price_from && $price_to) {
          $cars['meta_query'] = array(
            array(
              'key' => 'price',
              'value' => array( $price_from, $price_to ),
              'type' => 'numeric',
              'compare' => 'between',
            )
          );
        }

        if($model_from_id && $model_to_id) {
          $cars['tax_query'] = array(
            array(
              'taxonomy' => 'products-model',
              'field'    => 'slug',
              'terms'    => range($model_from_id, $model_to_id),
              'operator' => 'IN'
            ), 
          );
        }

        $posts = new WP_Query( $cars );
        if ( $posts->have_posts() ) {
          foreach( $posts->posts as &$post ):
            $offer = get_post_meta( $post->ID, 'offers', true );
            $author_id = $post->post_author;
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $author = [
              'id'    => $author_id,
              'image' => $avatar,
              'name' => get_the_author_meta( 'display_name', $author_id ),
            ];
            $post->id    = $post->ID;
            $post->image = (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ): '';
            $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
            $post->price = get_post_meta( $post->ID, 'price', true );
            $post->offer = ($offer)? $offer: '';
            $post->offer_price = get_post_meta( $post->ID, 'price_offer', true );
            $post->agents = $author;
            $post->installment_price = get_post_meta( $post->ID, 'finance_price', true );
            $post->link = get_permalink($post->ID);
            
            unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
            formatPost($post);
          endforeach;
        }


      unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
      formatPost($post);
    endforeach;
      
    $agents = [];

    if($agent_id != false) {
      $agents['count_cars'] = $count_car;
      $agents['count_visitors'] = array_sum($counter);

      $result = [
        "success" => true,
        "code" => 200,
        "message" => 'Successfully retrieved',
        "agent" => $agents,
        "data" => $posts->posts,
      ]; 
    } else {
      $result = [
        "success" => true,
        "code" => 200,
        "message" => 'Successfully retrieved',
        "data" => $posts->posts,
      ];  
    }
     
  } else {
    $result = [
      'success' => 'false',
      'code' => 200,
      'message' => 'cars Not Found',
      "data" => []
    ];
  }
  
  return $result;

}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'cars/filter/',array(
    'methods' => 'GET',
    'callback' => 'filters_cars',
  ));
});

// Get All Cars with filters
function all_agents_cars($data){

  $data=$data->get_params('GET');
  extract($data);

  $per_page     = !empty($per_page) ? $per_page : 10;
  $page         = !empty($page) ? $page : true;
  $brand_id     = !empty($brand_id) ? $brand_id : false;
  $agent_id     = !empty($agent_id) ? $agent_id : false;

  $agents_cars = [];
  
  if($agent_id  &&  $brand_id) {
      $args = array(
        'post_type'        => array( 'basic_specifications' ),
        'posts_per_page' => -1,
        'post_status'      => 'publish',
      );

    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ),
    );
  
    $query = get_posts( $args );

      foreach( $query as $car ):
        $cars = array(
          'post_type' => 'cars',
          'post_status' => 'publish',
          'author' => $agent_id,
          'posts_per_page' => -1,
          'meta_query' => array(
            'relation' => 'OR',
            array(
              'key' => 'id_basic_specifications',
              'value' => '"' . $car->ID . '"',
              'compare' => 'LIKE'
            ),
            array(
              'key' => 'id_basic_specifications',
              'value' => $car->ID,
              'compare' => '='
            )
          )
        );

        $posts = get_posts( $cars );

        if ( $posts ) {
          foreach( $posts as $post ):
        
            $author_id = $post->post_author;
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $author = [
              'id'    => $author_id,
              'image' => ($avatar)? $avatar:null,
              'name' => get_the_author_meta( 'display_name', $author_id ),
            ];
            
            $price_tax = get_post_meta( $post->ID, 'price', true ) * 100 / 115;

            $agents_cars[] = [
              'id' => $post->ID,
              'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
              'price' => get_post_meta( $post->ID, 'price', true ),
              'before_tax' => number_format($price_tax, 3, '.', ','),
              'image' => (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ):'',
              'installment_price' => get_post_meta( $post->ID, 'finance_price', true ),
              'author' => $author,
              'link_financing' => "https://twenty.sa/financing/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
              'link_buying' => "https://twenty.sa/buying/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
            ];
          
            unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
            formatPost($post);
          endforeach;
        }

      endforeach;

  } else {
      $cars = array(
        'post_type' => 'cars',
        'post_status' => 'publish',
        'author' => $agent_id,
        'posts_per_page' => -1,
      );
      $posts = get_posts( $cars );

      if ( $posts ) {
        foreach( $posts as $post ):
      
          $author_id = $post->post_author;
          $avatar = get_field('user_logo', 'user_'. $author_id);
          $author = [
            'id'    => $author_id,
            'image' => ($avatar)? $avatar:null,
            'name' => get_the_author_meta( 'display_name', $author_id ),
          ];
          
        $price_tax = get_post_meta( $post->ID, 'price', true ) * 100 / 115;

        $agents_cars[] = [
              'id' => $post->ID,
              'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
              'price' => get_post_meta( $post->ID, 'price', true ),
              'before_tax' => number_format($price_tax, 3, '.', ','),
              'image' => (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ): '',
              'installment_price' => get_post_meta( $post->ID, 'finance_price', true ),
              'author' => $author,
              'link_financing' => "https://twenty.sa/financing/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
              'link_buying' => "https://twenty.sa/buying/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
          ];

        endforeach;
      }
  }
 
  $result = [
    "success" => true,
    "code" => 200,
    "message" => 'Successfully retrieved',
    "data" => $agents_cars,
  ]; 

  
  return $result;

}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'cars/agents/',array(
    'methods' => 'GET',
    'callback' => 'all_agents_cars',
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
    )
  ));
});

// Get All Cars with filters
function models_agents_cars($data){

  $data=$data->get_params('GET');
  extract($data);

  $per_page     = !empty($per_page) ? $per_page : 10;
  $page         = !empty($page) ? $page : true;
  $brand_id     = !empty($brand_id) ? $brand_id : false;
  $agent_id     = !empty($agent_id) ? $agent_id : false;
  $model_id     = !empty($model_id) ? $model_id : false;


  if($model_id) {
    $post   = get_post( $model_id );
    $cars_models = get_field('cars_model', $post->ID);

    $cars = [];
    
    foreach( $cars_models as $post ):
        $price_tax = get_post_meta( $post->ID, 'price', true ) * 100 / 115;

        $cars[] = [
          'id' => $post->ID,
          'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
          'price' => get_post_meta( $post->ID, 'price', true ),
          'before_tax' => number_format($price_tax, 3, '.', ','),
          'image' => get_the_post_thumbnail_url($post->ID, 'full' ),
          'installment_price' => get_post_meta( $post->ID, 'finance_price', true ),
          'link_financing' => "https://twenty.sa/financing/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
          'link_buying' => "https://twenty.sa/buying/?car=".htmlspecialchars_decode( get_the_title($post->ID) )."",
        ];
    endforeach;

      $result = [
        "success" => true,
        "code" => 200,
        "message" => 'Successfully retrieved',
        "data" => $cars,
      ]; 

  } else {
    $args = array(
      'post_type'         => array( 'models' ),
      'posts_per_page'    => $per_page,
      'paged'             => $page ,
      'author'            => $agent_id,
      'post_status'       => 'publish',
    );

    $args['tax_query'] = array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'basic-brand',
        'field'    => 'term_id',
        'terms'    => $brand_id,
      ),
    );

    $posts = new WP_Query( $args );

    if ( $posts->have_posts() ) {
      foreach( $posts->posts as &$post ):
        
        $post->id = $post->ID;
        $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
        $post->price = get_post_meta( $post->ID, 'price_models_maintenance', true );
        $post->image = get_the_post_thumbnail_url($post->ID, 'full' );

        unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
        formatPost($post);
      endforeach;
    }

    $result = [
      "success" => true,
      "code" => 200,
      "message" => 'Successfully retrieved',
      "data" => $posts->posts,
    ]; 
  }

  return $result;

}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'cars/models/',array(
    'methods' => 'GET',
    'callback' => 'models_agents_cars',
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
    )
  ));
});

// Get All Cars with filters
function maintenance_agents_cars($data){

  $data=$data->get_params('GET');
  extract($data);

  $brand_id     = !empty($brand_id) ? $brand_id : false;
  $agent_id     = !empty($agent_id) ? $agent_id : false;


  $args = array(
    'post_type'         => array( 'maintenance' ),
    'author'            => $agent_id,
    'post_status'       => 'publish',
  );

  $args['tax_query'] = array(
    'relation' => 'AND',
    array(
      'taxonomy' => 'basic-brand',
      'field'    => 'term_id',
      'terms'    => $brand_id,
    ),
  );

  $posts = new WP_Query( $args );

  if ( $posts->have_posts() ) {
    foreach( $posts->posts as &$post ):
      
      $post->id = $post->ID;
      $post->title = htmlspecialchars_decode( get_the_title($post->ID) );

      $rows = get_field('maintenance_centers', $post->ID);
      $maintenance = [];

      if( $rows ) {
        foreach( $rows as $row ) {
          $maintenance[] = [
            'address' => $row['address_maintenance_centers'],
            'phone' => $row['phone_maintenance_centers'],
          ];
        }
      }

      unset($post->ID, $post->post_name, $post->post_type, $post->post_excerpt);
      formatPost($post);
    endforeach;
  }

  $result = [
    "success" => true,
    "code" => 200,
    "message" => 'Successfully retrieved',
    "maintenance" => $post,
    "data" => $maintenance,
  ]; 
  

  return $result;

}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'cars/maintenance/',array(
    'methods' => 'GET',
    'callback' => 'maintenance_agents_cars',
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
    )
  ));
});


// Get All Cars with filters
function list_blog($data){

  $data=$data->get_params('GET');
  extract($data);

  $post_id     = !empty($post_id) ? $post_id : false;
  $per_page     = !empty($per_page) ? $per_page : '10';
  $page         = !empty($page) ? $page : '1';

  $args = array(
    'post_type'         => 'post',
    'post_status'       => 'publish',
    'posts_per_page' => $per_page,
    'paged' => $page,
  );

  if($post_id) {
    $args['post__in'] = array($post_id);
  }

  $posts = new WP_Query( $args );

  if ( $posts->have_posts() ) {
    foreach( $posts->posts as &$post ):
      if($post_id) {
        $list_related = [];
        $related = get_posts( array('post_type' => array('post'), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
        if( $related )  {
          foreach( $related as $post ) {
            $list_related[] = array( 
              'id' => $post->ID,
              'title' => htmlspecialchars_decode( get_the_title($post->ID) ),
              'image' => (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ):'',
            );
          }
        }
        $post->list_related = $list_related;
        $post->id = $post_id;
        $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
        $post->image = (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ):'';
        $post->time =  get_the_date('c', $post->ID);        

        $list_terms = [];
        // Get the term IDs assigned to post.
        $taxonomies = get_terms( array(
          'taxonomy' => 'category',
          'hide_empty' => false,
        ) );
        foreach ($taxonomies as $term) {
          $list_terms [] = $term->name;
        }
        $post->list_categories = $list_terms;


        $list_tags = [];
        // Get the term IDs assigned to post.
        $tags = get_terms( array(
          'taxonomy' => 'post_tag',
          'hide_empty' => false,
        ) );
        foreach ($tags as $term) {
          $list_tags [] = $term->name;
        }
        $post->list_tags = $list_tags;

      } else {
          $post->id = $post->ID;
          $post->title = htmlspecialchars_decode( get_the_title($post->ID) );
          $post->image = (get_the_post_thumbnail_url($post->ID, 'full' ))? get_the_post_thumbnail_url($post->ID, 'full' ):'';
          $post->time =  get_the_date('c', $post->ID);
        }


      unset($post->ID, $post->post_name, $post->post_type);
      formatPost($post);
    endforeach;
  }

  $result = [
    "success" => true,
    "code" => 200,
    "message" => 'Successfully retrieved',
    "data" => $posts->posts,
  ]; 
  
  return $result;
}
add_action('rest_api_init' , function(){
  register_rest_route('wp/api/' ,'blog/',array(
    'methods' => 'GET',
    'callback' => 'list_blog',
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
    )
  ));
});




