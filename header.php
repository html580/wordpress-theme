<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<title>
<?php 
	global $page, $paged;
	if (is_single()||is_page()) { 
		 wp_title('');
  } else {
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	}
?>
</title>
<meta name="keywords" content="<?php 
	
	if (is_single()||is_page()) { 
		 wp_title('');
  } else {
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
	}
?>" />
<meta name="description" content="<?php 
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php $options = get_option('dzf_options'); if ($options['feed_url']) {echo($options['feed_url']);} else  bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/images/base.js"></script>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/suerpfish.css" type="text/css"/>
<script src="<?php bloginfo('stylesheet_directory'); ?>/scripts/jquery.js"></script>
<script type="text/ecmascript" src="<?php bloginfo('stylesheet_directory'); ?>/scripts/superfish.js"></script>
<script type='text/javascript'>

		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
			jQuery.scrolltotop(<?php if (is_single()) {?>{comments:true}<?}?>);
		});

</script>
</head>
<body <?php body_class(); ?>>
<div id="wrap">
	<div id="header">
		<div class="headbg">
		<div class="header-inner">
    	<div class="header-inner-box">
        	<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
        	<p><?php bloginfo('description'); ?></p>
            <div class="banner"><?php
					// Check if this is a post or page, if it has a thumbnail, and if it's a big one
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
						// Houston, we have a new header image!
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					else : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
					<?php endif; ?>
            </div>
        </div>
        <div id="nav">
         <?php wp_nav_menu('container=\'\'&menu_id=sf-menu&menu_class=sf-menu&title_li=&depth=2'); ?>
        </div>
      </div>   
    </div>
  	</div>
