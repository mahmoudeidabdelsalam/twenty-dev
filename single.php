<?php
/**
 * The Template for displaying all single posts.
 */

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
    ?>

<div class="container">
  <div class="row">
    <?php echo get_template_part( 'content', 'single' ); ?>
  </div>
</div>
		




<?php
	endwhile;
endif;

get_footer();
