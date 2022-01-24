<?php

namespace wpcmart;

class Theme {
	public function __construct() {
		$this->boot();
		$this->load();
	}

	public function boot() {
		add_action( 'after_setup_theme', [ $this, 'setup' ] );
		add_action( 'after_setup_theme', [ $this, 'content_width' ], 0 );
		add_action( 'widgets_init', [ $this, 'widgets_init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'styles_scripts' ] );
		add_filter( 'body_class', [ $this, 'body_classes' ] );
		add_action( 'wp_head', [ $this, 'pingback_header' ] );
		add_action( 'tgmpa_register', [ $this, 'required_plugins' ] );
	}

	public function load() {
		new KSES();
		new Customizer();
		new Comments();
		new Layout();
		if ( is_woocommerce_active() ) {
			new Woo();
			new Mini_Cart();
		}
	}

	public function setup() {
		load_theme_textdomain( 'wpcmart', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( [ 'menu-1' => esc_html__( 'Primary', 'wpcmart' ) ] );
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script'
		] );
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'wp-block-styles' ); // Add support for Block Styles.
		add_theme_support( 'align-wide' ); // Add support for full and wide align images.

		add_theme_support( 'editor-styles' ); // Add support for editor styles.
		add_editor_style( 'style-editor.css' ); // Enqueue editor styles.

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support(
			'custom-logo',
			[
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			]
		);
	}

	public function content_width() {
		$GLOBALS['content_width'] = apply_filters( 'wpcmart/content_width', 640 );
	}

	public function widgets_init() {
		register_sidebar(
			[
				'name'          => esc_html__( 'Sidebar', 'wpcmart' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here.', 'wpcmart' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
		register_sidebar(
			[
				'name'          => esc_html__( 'Footer 1', 'wpcmart' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here.', 'wpcmart' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
		register_sidebar(
			[
				'name'          => esc_html__( 'Footer 2', 'wpcmart' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here.', 'wpcmart' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
		register_sidebar(
			[
				'name'          => esc_html__( 'Footer 3', 'wpcmart' ),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Add widgets here.', 'wpcmart' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			]
		);
	}

	public function styles_scripts() {
		wp_enqueue_style( 'wpcmart-style', get_stylesheet_uri(), [], THEME_VERSION );

		wp_enqueue_script( 'wpcmart-main', get_template_directory_uri() . '/js/main.js', [ 'jquery' ], THEME_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	public function body_classes( $classes ) {
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			$classes[] = 'no-sidebar';
		}

		return $classes;
	}

	public function pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function required_plugins() {
		$plugins = [
			[
				'name' => 'WPC Smart Compare for WooCommerce',
				'slug' => 'woo-smart-compare',
			],
			[
				'name' => 'WPC Smart Quick View for WooCommerce',
				'slug' => 'woo-smart-quick-view',
			],
			[
				'name' => 'WPC Smart Wishlist for WooCommerce',
				'slug' => 'woo-smart-wishlist',
			],
		];

		$config = [
			'id'           => 'wpcmart',
			'default_path' => '',
			'menu'         => 'wpcmart-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		];

		tgmpa( $plugins, $config );
	}
}
