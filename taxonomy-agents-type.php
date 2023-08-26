<?php
/**
 * The Template for displaying TaxonomyTag pages.
 */

get_header();


$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$tag_term = $wp_query->get_queried_object();
$banner = get_field('icon_term', $tag_term);


$args = array(
  'post_type'         => array( 'agents' ),
  'posts_per_page'    => 9,
  'paged'             => $paged,
);

$args['tax_query'] = array(
  'relation' => 'AND',
  array(
    'taxonomy' => 'agents-type',
    'field'    => 'term_id',
    'terms'    => $tag_term->term_id,
  ),
);

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
        <?php
        if ( $query->have_posts() ):
          while ( $query->have_posts() ):
            $query->the_post();
            $author_id = get_the_author_meta('ID');
            $avatar = get_field('user_logo', 'user_'. $author_id);
            $background = get_field('user_logo', 'user_'. $author_id);  
            $brands = get_field('brands', 'user_'.$author_id);
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="showroom car-box">
            <a class="logo-author" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($background)? $background:$placeholder; ?>" alt="<?= the_author_meta( 'display_name', $author_id ); ?>"></a>
            <div class="meta-user car-box-content">
              <h4 class="mt-3 p-3"><?= the_title(); ?></h4>
              <div class="information">
                <ul class="d-inline-flex brands">
                  <?php 
                  if($brands):
                    foreach ($brands as $brand):
                      $icon = get_field('icon_term', $brand);
                    ?>
                      <li><span class="icon-brand"><img src="<?= $icon; ?>" alt="<?= $brand->name; ?>"></span> <span class="name-brand"><?= $brand->name; ?></span></li>
                    <?php
                    endforeach;
                  endif;
                  ?>
                </ul>           
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