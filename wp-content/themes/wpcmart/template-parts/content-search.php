<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php wpcmart\post_thumbnail(); ?>
	<?php the_title( sprintf( '<h3 class="my-1"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

	<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta flex flex-wrap items-center text-gray-500">
			<?php
			wpcmart\posted_on();
			wpcmart\entry_footer();
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="entry-summary text-gray-400">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->
