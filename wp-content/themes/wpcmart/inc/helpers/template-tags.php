<?php

namespace wpcmart;

function logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo           = $custom_logo_id ? get_custom_logo() : sprintf( '<a href="%s" rel="home">%s</a>', home_url( '/' ), get_bloginfo( 'name' ) );

	if ( is_front_page() && is_home() ) {
		$html = sprintf( '<h1 class="site-title text-3xl">%s</h1>', $logo );
	} else {
		$html = sprintf( '<p class="site-title text-3xl">%s</p>', $logo );
	}

	if ( get_bloginfo( 'description', 'display' ) && is_customize_preview() ) :
		$html .= sprintf( '<p class="site-description">%s</p>', get_bloginfo( 'description', 'display' ) );
	endif;

	echo wp_kses_post( $html );
}

function edit_post() {
	edit_post_link(
		sprintf(
		/* translators: %s: Name of current post. Only visible to screen readers */
			wp_kses_post( __( 'Edit <span class="screen-reader-text">%s</span>', 'wpcmart' ) ),
			wp_kses_post( get_the_title() )
		),
		'<span class="edit-link">',
		'</span>'
	);
}

function posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf( "<i class='icon-clock mr-1'></i><a href='%s' rel='bookmark'>%s</a>", esc_url( get_permalink() ), $time_string );

	echo '<span class="posted-on inline-flex items-center mr-2">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

}

function entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		$categories_list = get_the_category_list( esc_html__( ', ', 'wpcmart' ) );
		if ( $categories_list ) {
			printf(
				'<span class="cat-links"><i class="icon-folder mr-1"></i>' . esc_html__( '%1$s', 'wpcmart' ) . '</span>',
				$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}

		$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'wpcmart' ) );
		if ( $tags_list ) {
			printf(
				'<span class="tags-links ml-2"><i class="icon-tag mr-1"></i>' . esc_html__( '%1$s', 'wpcmart' ) . '</span>',
				$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
	}
}

function post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
	?>
	<?php if ( is_singular() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumbnail -->
	<?php else : ?>
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'post-thumbnail', [ 'alt' => the_title_attribute( [ 'echo' => false ] ) ] ); ?>
		</a>
	<?php
	endif; // End is_singular().
}

function wp_body_open() {
	do_action( 'wp_body_open' );
}
