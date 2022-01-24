<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package thin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<div class="entry-meta flex flex-wrap items-center text-gray-500">
			<?php
			wpcmart\posted_on();
			wpcmart\entry_footer();
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php wpcmart\post_thumbnail(); ?>

	<div class="entry-content prose max-w-none">
		<?php
		the_content(
			sprintf(
				/* translators: %s: Name of current post. Only visible to screen readers */
				wp_kses_post( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wpcmart' ) ),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			[
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wpcmart' ),
				'after'  => '</div>',
			]
		);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
