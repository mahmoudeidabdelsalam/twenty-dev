<?php
/**
 * Template Name: Not found
 * Description: Page template 404 Not found.
 *
 */

get_header();


$bg_error = get_theme_file_uri().'/assets/img/404.gif';
?>

<div>
  <img class="m-auto d-block img-fluid" src="<?= $bg_error; ?>" alt="error 404">
</div>

<?php
get_footer();
