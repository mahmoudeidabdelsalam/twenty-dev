<?php
/* Template Name: Blog */ 
/*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#hom-page
 *
*/

get_header(); 
if ( have_posts() ) :
	while ( have_posts() ) :
  the_post();

  $placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
  $banner = get_the_post_thumbnail_url( get_the_ID(), 'full');

  $paged    = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

  $args = array(
    'post_type'       => array( 'post' ),
    'post_status'      => 'publish',
    'posts_per_page'  => 12,
    'paged'           => $paged,
  );
  $posts = get_posts( $args );

  $query = new WP_Query( $args );
?>

<section class="container-fluid">
  <div class="row">
    <?php if($banner): ?>
      <img class="img-fluid p-0" src="<?= $banner; ?>" alt="<?= the_title(); ?>">
    <?php endif; ?>
  </div>
</section>

<div class="container  mt-5 mb-5">
  <div class="row">
    <?php
    if ( $posts ) :
	   foreach($posts as $post):
      setup_postdata( $post );
        $img_url = get_the_post_thumbnail_url(get_the_ID(),'medium');
        ?>
          <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="car-box car-offer">
              <div class="car-box-img position-relative">
                <a class="link-img" href="<?= get_permalink(); ?>"><img class="img-fluid" src="<?= ($img_url)? $img_url:$placeholder; ?>" alt="<?= get_the_title(); ?>"></a>
              </div>
              <div class="car-box-content position-relative p-4">
                <h4 class="text-uppercase"><?= get_the_title(); ?></h4>
              </div>
            </div>
          </div>
        <?php 
        endforeach;
        wp_reset_postdata();
      endif;
    ?>
    <div class="col-md-12 mt-5"><?php echo custom_base_pagination(array(), $query); ?></div>
  </div>
</div>

<?php
  endwhile;
endif;
get_footer();
?>