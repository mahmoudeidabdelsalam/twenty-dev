<?php
/**
 * The template for displaying content in the single.php template.
 *
 */

$placeholder = get_theme_file_uri().'/assets/img/placeholder.png';
$tag_list = get_the_tag_list( '', __( ', ', 'twenty' ) );
$related = get_posts( array( 'category__in' => wp_get_post_categories(get_the_ID()), 'numberposts' => 1, 'post__not_in' => array(get_the_ID()) ) );
$relateds = get_posts( array( 'category__in' => wp_get_post_categories(get_the_ID()), 'numberposts' => 6, 'offset' => 1, 'post__not_in' => array(get_the_ID()) ) );
?>
<div class="col-md-6 col-12 mt-5">
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
      <h1 class="entry-title mb-3"><?php the_title(); ?></h1>
      <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
          <i class="far fa-clock"></i> نشر في <?php twenty_article_posted_on(); ?>
        </div><!-- /.entry-meta -->
      <?php endif; ?>
    </header><!-- /.entry-header -->

    <div class="entry-content">
      <?php
        if ( has_post_thumbnail() ) :
          echo '<div class="post-thumbnail img-fluid">' . get_the_post_thumbnail( get_the_ID(), 'large' ) . '</div>';
        endif;
        the_content();
      ?>
    </div><!-- /.entry-content -->
  </article><!-- /#post-<?php the_ID(); ?> -->

  <div class="post-relateds mb-5">
    <?php if($relateds): ?>
      <div class="row">
          <h2 class="h2 font-bold headline col-12">مواضيع ذات صلة</h2>
          <?php 
          foreach( $relateds as $post ):
            setup_postdata($post); 
          ?>      
          <div class="col-md-4 col-12">
            <div class="box-item">
              <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
                <?php 
                  if ( has_post_thumbnail() ) :
                    echo '<div class="post-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'large' ) . '</div>';
                  else:
                    echo '<div class="post-thumbnail"><img src="'.$placeholder.'" alt="'.get_the_title().'" /></div>';
                  endif;
                ?>
              </a>
              <div class="box-content">
                <span><?php the_title(); ?></span>
                <?php if ( 'post' === get_post_type() ) : ?>
                  <div class="entry-meta">
                    <?php twenty_article_posted_on(); ?>
                  </div><!-- /.entry-meta -->
                <?php endif; ?>
              </div>
            </div>        
          </div>
          <?php 
        endforeach;
          wp_reset_postdata(); 
        ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="col-md-6 col-12 mt-5 sidebar">
  <?php 
  if( $related ):
  ?>
    <ul class="list-related list-unstyled pb-3 p-0">
      <li><h3 class="mb-3">شاهد ايضا</h3></li>
      <?php 
      foreach( $related as $post ):
        setup_postdata($post); 
      ?>      
      <li class="item">
        <div class="box-item">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
            <?php 
              if ( has_post_thumbnail() ) :
                echo '<div class="post-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'large' ) . '</div>';
              else:
                echo '<div class="post-thumbnail"><img src="'.$placeholder.'" alt="'.get_the_title().'" /></div>';
              endif;
            ?>
          </a>
          <div class="box-content">
            <span><?php the_title(); ?></span>
            <?php if ( 'post' === get_post_type() ) : ?>
              <div class="entry-meta">
                <?php twenty_article_posted_on(); ?>
              </div><!-- /.entry-meta -->
            <?php endif; ?>
          </div>
        </div>        
      </li>
      <?php 
    endforeach;
      wp_reset_postdata(); 
    ?>
    </ul>   
  <?php 
  endif;
  ?>

  <ul class="list-categories list-unstyled bg-light border border-2 border-primary border-start-0 border-bottom-0 border-end-0 py-4 px-3 mt-2">
    <?php wp_list_categories( array( 'orderby' => 'name' ) ); ?> 
  </ul>

  <?php if($tag_list): ?>
    <ul class="list-tgs list-unstyled py-4 px-3 mt-5">
      <li><h4 class="h3 font-bold border border-primary border-3 border-start-0 border-end-0 border-top-0">الوسوم</h4></li>
      <?= $tag_list; ?>
    </ul>
  <?php endif; ?>

</div>

