<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package thin
 */

get_header();
?>
	<main id="primary" class="site-main space-y-8">
		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				printf( '<header> <h1 class="page-title screen-reader-text">%s</h1> </header>', single_post_title( '', false ) );
			endif;
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', get_post_type() );
			endwhile;
			do_action( 'wpcmart/loop/after' );
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</main><!-- #main -->
<?php
get_sidebar();
get_footer();
