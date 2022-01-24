<?php

namespace wpcmart;

function is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

function is_post_type( $post_type ) {
	return get_post_type() === $post_type;
}

function is_ajax() {
	return defined( 'DOING_AJAX' );
}

function is_use_permalink() {
	global $wp_rewrite;

	return ! ( ! isset( $wp_rewrite ) || ! is_object( $wp_rewrite ) || ! $wp_rewrite->using_permalinks() );
}

function is_url( $url ) {
	return filter_var( $url, FILTER_VALIDATE_URL ) !== false;
}

function is_script_debug() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
}

function is_live_preview( $theme_name ) {
	$cached_options = wp_load_alloptions();
	$preview_theme  = get_option( 'template' );
	$active_theme   = $cached_options['template'];
	$is_wp_org      = strpos( home_url(), 'wp-themes.com' );

	return ( $active_theme !== $preview_theme || ( $preview_theme === $theme_name && $is_wp_org ) ) && ! is_child_theme();
}
