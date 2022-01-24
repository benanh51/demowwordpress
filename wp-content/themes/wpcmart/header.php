<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package thin
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wpcmart\wp_body_open(); ?>
<div id="page" class="site bg-white">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'wpcmart' ); ?></a>
	<header id="masthead" class="site-header pt-4 text-white">
		<div class="container dlg:flex dlg:item-center justify-between">
			<div class='flex justify-between items-center mb-1'>
				<div class="site-branding flex items-center">
					<a class="lg:hidden mr-2" href="#mobile-menu">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
						</svg>
					</a>
					<?php wpcmart\logo(); ?>
				</div><!-- .site-branding -->
				<div class='dlg:hidden w-72'>
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class='flex justify-between items-center'>
				<nav id="site-navigation" class="main-navigation dlg:hidden">
					<?php do_action( 'wpcmart/menu' ); ?>
				</nav><!-- #site-navigation -->
				<div class="flex items-center">
					<?php do_action( 'wpcmart/mini_cart' ); ?>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
	<?php do_action( 'wpcmart/header/after' ); ?>
