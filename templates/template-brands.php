<?php
/* Template Name: brands */ 
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

$brands = get_terms('basic-brand', array('parent' => 0));
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
      foreach ($brands  as $term): 
      $image = get_field('icon_term', $term);
        $term_link = get_term_link( $term );
        if ( is_wp_error( $term_link ) ) {
            continue;
        }
      ?>
      <div class="col-md-2 col-sm-4 col-12">
        <div class="card-brand">
          <div class="card-img-top p-3">
            <div class="card">
              <a href="<?= $term_link; ?>">
                <img src="<?= ($image)? $image:$placeholder; ?>" class="img-fluid" alt="<?= $term->name; ?>">
              </a>
            </div>
          </div>
          <span class="font-bold"><?= $term->name; ?></span>
          <span class="d-block">سيارة <?= $term->count; ?></span>
        </div>
      </div>
    <?php 
      endforeach; 
      ?>
  </div>
</div>

<?php
  endwhile;
endif;
get_footer();
?>