<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package clarity
 * @since clarity 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'clarity' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- Custom CSS added in Theme Options -->
	<style type="text/css">
	<?php echo css_options(); ?>
	
	<?php echo of_get_option('clarity_css',''); ?>
	
	</style>
	

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="row header">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<?php if ( of_get_option('clarity_logo') == '') {
			
			    echo '<h1 class="site-title"><a href="';
			    echo home_url('/');
			    echo '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';
			    echo bloginfo('name');
			    echo '</a></h1>';
			   			
			    } else {
			    
			    echo '<a href="';
			    echo home_url('/');
			    echo '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home"><div class="sitelogoimg"></div></a>';
			    
			    }
			    
			?>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			
			<!-- Social Media Icons -->
			<div class="sm">
			
			<?php
				$facebook = of_get_option('sm_facebook');
				$twitter = of_get_option('sm_twitter');
				$tumblr = of_get_option('sm_tumblr');
				$pinterest = of_get_option('sm_pinterest');
				$youtube = of_get_option('sm_youtube');
				$vimeo = of_get_option('sm_vimeo');
				$flickr = of_get_option('sm_flickr');
			?>
			
			<?php if ( ( $facebook or $twitter or $tumblr or $pinterest or $youtube or $vimeo or $flickr ) != '' ) { ?>
			
				<ul class="social">
					<?php if ( $facebook !='' ) { ?>
					<li class="facebook">
					    <a href="<?php echo $facebook; ?>"></a>
					</li>
					<?php } ?>
					<?php if ( $twitter !='' ) { ?>
					<li class="twitter">
					    <a href="<?php echo $twitter; ?>"></a>
					</li>
					<?php } ?>
					<?php if ( $tumblr !='' ) { ?>
					<li class="tumblr">
					    <a href="<?php echo $tumblr; ?>"></a>
					</li>
					<?php } ?>
					<?php if ( $pinterest !='' ) { ?>
					<li class="pinterest">
					    <a href="<?php echo $pinterest; ?>"></a>
					</li>
					<?php } ?>
					<?php if ( $youtube !='' ) { ?>
					<li class="youtube">
					    <a href="<?php echo $youtube; ?>"></a>
					</li>
					<?php } ?>
					<?php if ( $vimeo !='' ) { ?>
					 <li class="vimeo">
					    <a href="<?php echo $vimeo; ?>"></a>
					</li>
					<?php } ?>
					<?php if ( $flickr !='' ) { ?>
					<li class="flickr">
					    <a href="<?php echo $flickr; ?>"></a>
					</li>
					<?php } ?>
				</ul><!-- .social -->
			
			<?php } ?>	
				
			</div><!-- .sm -->
		</hgroup>
			
	</header><!-- #masthead .site-header -->
</div>
<div class="row container">
	<div id="main" class="site-main">