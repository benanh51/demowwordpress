<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package thin
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="error-404 not-found">
				<div class="page-content text-center py-36">
					<header class="page-header">
						<p class="error-heading text-6xl text-primary-600 font-bold mb-4"><?php echo esc_html__( '404', 'wpcmart' ); ?></p>
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'wpcmart' ); ?></h1>
					</header><!-- .page-header -->
					<p><?php esc_html_e( 'Nothing was found at this location. Try searching.', 'wpcmart' ); ?></p>
				</div><!-- .page-content -->
			</div><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
