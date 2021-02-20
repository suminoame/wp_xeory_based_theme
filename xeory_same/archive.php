<?php get_header(); ?>

<div id="content">

<div class="wrap">
    <?php bzb_breadcrumb(); ?>

  <div id="main" <?php bzb_layout_main(); ?>>

    <div class="main-inner">

    <section class="cat-content">
      <header class="cat-header">
        <h1 class="post-title"><?php bzb_title(); ?></h1>
      </header>
      <?php if( is_category() ) { ?>
        <?php bzb_category_description(); ?>
      <?php } ?>


    </section>

    <div class="post-loop-wrap">
    
      <?php if ( have_posts() ) :

        if (get_bzb_title() == "mono") { ?>
          <div id="container">
        <?php }
        
        while ( have_posts() ) : the_post();

    ?>

      <?php if (get_bzb_title() == "mono") { ?>
        <section class="grid-wrap">
          <div id="mono">
            <div class="posts" id="posts">
              <div class="post-container">
                <div id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> >

                  <?php if ( has_post_thumbnail() ) : ?>

                    <figure class="featured-media">

                        <?php the_post_thumbnail( 'post-thumb' ); ?>

                        <a class="post-overlay" href="<?php the_permalink(); ?>" rel="bookmark">
                          <p class="view"><?php the_title(); ?> &rarr;</p>
                        </a>

                    </figure>

                  <?php else: ?>

                    <p>No image</p>
                    
                  <?php endif; ?>
                
                </div><!-- #post-id -->
              </div><!-- .post-container -->
            </div><!-- .posts -->
          </div><!-- #mono -->
        </section>

      <?php }else { ?>
        <article id="post-<?php echo the_ID(); ?>" <?php post_class(); ?> >
          <header class="post-header">
            <ul class="post-meta list-inline">
              <li class="date updated"><i class="fa fa-clock-o"></i> <?php the_time('Y/m/d');?></li>
            </ul>
            <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          </header>

          <section class="post-content">
            <div class="post-cats">
              <?php if( get_the_post_thumbnail() ) { ?>
                <div class="post-thumbnail">
                  <a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_post_thumbnail(); ?></a>
                </div>
              <?php } ?>
              <i class="fa fa-folder"></i> <?php the_category(', ');?>
              
              <?php 
              $posttags = get_the_tags();
              if($posttags){ ?>
                <i class="fa fa-tag"></i> <?php the_tags('');?>
              <?php } ?>
            </div><!-- post-cats -->
            
            <?php 
              if( get_the_category()[0]->cat_name !== "mono" ) {
                the_content('続きを読む');
              } ?>

          </section>
        </article>

        <?php } ?>

    <?php

        endwhile;

      else :
    ?>
    <article id="post-404"class="cotent-none post">
      <section class="post-content">
        <?php echo get_template_part('content', 'none'); ?>
      </section>
    </article>

    <?php
      endif;
    ?>

    <?php if (get_bzb_title() == "mono") { ?>
      </div><!-- #container -->
    <?php } ?>
    
    <?php if (function_exists("pagination")) {
      pagination($wp_query->max_num_pages);
    } ?>
    </div><!-- /post-loop-wrap -->
    </div><!-- /main-inner -->
  </div><!-- /main -->

<?php get_sidebar(); ?>

</div><!-- /wrap -->

</div><!-- /content -->

<?php get_footer(); ?>