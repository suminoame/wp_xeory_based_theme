<?php get_header(); ?>

<div id="content">

<?php do_action( 'xeory_prepend_content' ); ?>

<div class="wrap">

  <?php do_action( 'xeory_prepend_wrap' ); ?>

    <?php bzb_breadcrumb(); ?>

  <div id="main" <?php bzb_layout_main(); ?> role="main">

  <?php do_action( 'xeory_prepend_main' ); ?>

    <div class="main-inner">

    <?php do_action( 'xeory_prepend_main-inner' ); ?>

    <?php
      if ( have_posts() ) :

        while ( have_posts() ) : the_post();

        ?>

    <?php 
    global $post;
    $cf = get_post_meta($post->ID);
    ?>
    <article id="post-<?php the_id(); ?>" <?php post_class(); ?>>

      <header class="post-header">
        <ul class="post-meta list-inline">
          <li class="date updated"><i class="fa fa-clock-o"> </i> <?php the_time('Y/m/d');?>
          <?php if (get_the_time('Y/m/d') != get_the_modified_date('Y/m/d')) : ?></li>
          <?php else: ?>
            </li>
          <?php endif; ?>          
        </ul>
        <?php // edited same@1.0.0 ?>
        <?php // add categories ?>
        <div class="post-grid">
          <sector>
            <h1 class="post-title post_title_left"><?php the_title(); ?></h1>
            <div class="post-header-meta">
              <?php bzb_social_buttons();?>
            </div>
          </sector>
          <sector>
            <i class="fa fa-folder"></i> <?php the_category(', ');?>
          </sector>
        </div><!-- post-grid -->
      </header>

      <section class="post-content">

        <?php
          the_content(); 

          $args = array(
           'before' => '<div class="pagination">',
           'after' => '</div>',
           'link_before' => '<span>',
           'link_after' => '</span>'
          );

          wp_link_pages($args);
        ?>

      </section>

      <footer class="post-footer">

      <?php bzb_social_buttons();?>

        <ul class="post-footer-list">
          <li class="cat"><i class="fa fa-folder"></i> <?php the_category(', ');?></li>
          <?php 
          $posttags = get_the_tags();
          if($posttags){ ?>
          <li class="tag"><i class="fa fa-tag"></i> <?php the_tags('');?></li>
          <?php } ?>
        </ul>
      </footer>

      <?php // edited same@1.0.0 ?>
      <?php // delete sns share block ?>

      <?php echo bzb_get_cta($post->ID); ?>

    <?php comments_template( '', true ); ?>

    </article>


    <?php

        endwhile;

      else :
    ?>

    <p>投稿が見つかりません。</p>

    <?php
      endif;
    ?>

    <?php do_action( 'xeory_append_main-inner' ); ?>

    </div><!-- /main-inner -->

    <?php do_action( 'xeory_append_main' ); ?>

  </div><!-- /main -->

<?php get_sidebar(); ?>

    <?php do_action( 'xeory_append_wrap' ); ?>

</div><!-- /wrap -->

<?php do_action( 'xeory_append_content' ); ?>

</div><!-- /content -->

<?php //記事ページのみに構造化データを出力
if ( is_single()): ?>
  <?php
    //サムネイルを取得
    $thumbnail_id = get_post_thumbnail_id($post);
    $imageobject = wp_get_attachment_image_src( $thumbnail_id, 'full' );
    if( !$imageobject ){
      $imageobject[0] = get_template_directory_uri() .'/lib/images/noimage.jpg';
    }
    $logo_image = get_option('logo_image');
    if( !$logo_image ){
      $logo_image = get_template_directory_uri() .'/lib/images/masman.png';
    }
  ?>
  <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "BlogPosting",
    "mainEntityOfPage":{
      "@type":"WebPage",
      "@id":"<?php the_permalink(); ?>"
    },
    "headline":"<?php the_title(); ?>",
    "image": [
      "<?php echo $imageobject[0]; ?>"
    ],
    "datePublished": "<?php echo get_date_from_gmt(get_post_time('c', true), 'c');?>",
    "dateModified": "<?php echo get_date_from_gmt(get_post_modified_time('c', true), 'c');?>",
    "author": {
      "@type": "Person",
      "name": "<?php the_author(); ?>"
    },
    "publisher": {
      "@type": "Organization",
      "name": "<?php bloginfo('name'); ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo $logo_image; ?>"
      }
    },
    "description": "<?php echo get_the_excerpt(); ?>"
  }
  </script>
<?php endif; ?>


<?php get_footer(); ?>


