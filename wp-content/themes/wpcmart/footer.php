<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package thin
 */

?>

<?php do_action( 'wpcmart/footer/before' ); ?>
<footer id="colophon" class="site-footer py-8 text-white">
	<div class="site-info container">
		<div class="grid  lg:grid-cols-3 gap-8">
			<div>
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
			<div>
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
			<div>
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
		</div>
		<div class="text-center">
			Made with <i class="icon-heart"></i> by WPCmart & Woocommerce
		</div>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
