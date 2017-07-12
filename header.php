<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title>
	<?php
		if ( is_single() ) {
			single_post_title(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' ); 
			if( get_bloginfo( 'description' ) ) 
				echo ' | ' ; bloginfo( 'description' ); 
			twentyten_the_page_number();
		} elseif ( is_page() ) {
			single_post_title( '' ); echo ' | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			printf( __( 'Search results for %s', 'twentyten' ), '"'.get_search_query().'"' ); twentyten_the_page_number(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_404() ) {
			_e( 'Not Found', 'twentyten' ); echo ' | '; bloginfo( 'name' );
		} else {
			wp_title( '' ); echo ' | '; bloginfo( 'name' ); twentyten_the_page_number();
		}
	?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script type="text/javascript" src="http://static.wowhead.com/widgets/power.js"></script>
	<script type="text/javascript" src="http://db.mmo-champion.com/static/js/tooltip_external.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="header">
	<div class="menu">
	<div id="access1" role="navigation">
		<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
	</div><!-- #access -->	
	</div><div class="clear"></div>
	<div id="branding" role="banner">
		<a href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.jpg" alt="The Hunter's Mark" align="left" /></a> <a href="http://www.doghousesystems.com/"><img src="<?php bloginfo('template_directory'); ?>/images/dhsbanner.jpg" alt="DogHouse Systems: Time to Level Up!" align="right" /></a>
	</div><!-- #branding -->
	<div class="menu">
	<div id="access" role="navigation">
		<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header', 'theme_location' => 'secondary' ) ); ?>
	</div><!-- #access --></div>
</div><!-- #header -->
<div class="clear"></div><div id="wrapper" class="hfeed">
	<div id="main">
