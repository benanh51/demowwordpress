<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package thin
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<h1 class="page-title text-3xl">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search Results for: %s', 'wpcmart' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
		</header><!-- .page-header -->
		<div class="grid grid-cols-3 gap-x-4 gap-y-8">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'search' );
			endwhile;
			do_action( 'wpcmart/loop/after' );
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</main><!-- #main -->
<?php
get_sidebar();
get_footer();
