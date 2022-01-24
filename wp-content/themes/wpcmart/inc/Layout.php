<?php

namespace wpcmart;

class Layout {
	public function __construct() {
		$this->boot();
	}

	public function boot() {
		$this->header();
		$this->footer();
		$this->general();
	}

	public function header() {
		add_action( 'wpcmart/header/after', [ $this, 'after_header' ] );
		add_action( 'wpcmart/menu', [ $this, 'main_menu' ] );
		add_action( 'wp_footer', [ $this, 'mobile_menu' ] );
	}

	public function footer() {
		add_action( 'wpcmart/footer/before', [ $this, 'before_footer' ] );
	}

	public function general() {
		add_action( 'wpcmart/loop/after', [ $this, 'navigation' ] );
		add_filter( 'wp_page_menu_args', [ $this, 'page_menu_args' ] );
	}

	public function after_header() {
		if ( is_page_template( 'page-templates/fullwidth.php' ) || is_page_template( 'page-templates/home.php' ) || is_404() ) {
			echo '<div class="container">';
		} else {
			echo '<div class="grid grid-cols-1 lg:grid-cols-[3fr,1fr] gap-8 container my-8">';
		}
	}

	public function main_menu() {
		printf(
			'<button class="menu-toggle screen-reader-text" aria-controls="primary-menu" aria-expanded="false">%s</button>',
			esc_html__( 'Primary Menu', 'wpcmart' )
		);
		wp_nav_menu(
			[
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			]
		);
	}

	public function mobile_menu() {
		echo '<nav id="mobile-menu">';
		$this->main_menu();
		echo '</nav>';
	}

	public function before_footer() {
		echo '</div>';
	}

	public function navigation() {
		the_posts_pagination(
			[
				'prev_text'          => '&larr;',
				'next_text'          => '&rarr;',
				'before_page_number' => sprintf( '<span class="meta-nav screen-reader-text">%s</span>', __( 'Page', 'wpcmart' ) ),
			]
		);
	}

	public function page_menu_args( $args ) {
		$args['show_home'] = true;

		return $args;
	}
}
