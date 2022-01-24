<?php
/**
 * Theme Functions.
 */

if ( ! function_exists( 'shopping_solution_setup' ) ) :

/* Theme Setup */
function shopping_solution_setup() {

	$GLOBALS['content_width'] = apply_filters( 'shopping_solution_content_width', 640 );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', ecommerce_solution_font_url() ) );

}
endif; 
add_action( 'after_setup_theme', 'shopping_solution_setup' );

add_action( 'wp_enqueue_scripts', 'shopping_solution_enqueue_styles' );
function shopping_solution_enqueue_styles() {
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()) . '/css/bootstrap.css');
	$parent_style = 'ecommerce-solution-basic-style'; // Style handle of parent theme.
	wp_enqueue_style( $parent_style, esc_url(get_template_directory_uri()) . '/style.css' );
	wp_enqueue_style( 'shopping-solution-style', get_stylesheet_uri(), array( $parent_style ) );
	require get_parent_theme_file_path( '/theme-color-option.php' );
	wp_add_inline_style( 'ecommerce-solution-basic-style',$ecommerce_solution_custom_css );
	require get_theme_file_path( '/theme-color-option.php' );
	wp_add_inline_style( 'shopping-solution-style',$shopping_solution_custom_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

function shopping_solution_customize_register() { 
	global $wp_customize;
	$wp_customize->remove_section( 'ecommerce_solution_example_1' );
	$wp_customize->remove_setting( 'ecommerce_solution_phone_icon' );
	$wp_customize->remove_control( 'ecommerce_solution_phone_icon' );
	$wp_customize->remove_setting( 'ecommerce_solution_login_user_icon' );
	$wp_customize->remove_control( 'ecommerce_solution_login_user_icon' );
	$wp_customize->remove_setting( 'ecommerce_solution_display_woocart' );
	$wp_customize->remove_control( 'ecommerce_solution_display_woocart' );
} 
add_action( 'customize_register', 'shopping_solution_customize_register', 11 );

add_action( 'init', 'shopping_solution_remove_parent_function');
function shopping_solution_remove_parent_function() {
	remove_action('admin_notices', 'ecommerce_solution_notice');
	remove_action( 'admin_menu', 'ecommerce_solution_gettingstarted' );
}

//Top menus
function shopping_solution_remove_parent_theme_locations(){
	unregister_nav_menu( 'topmenus' );
}
add_action( 'after_setup_theme', 'shopping_solution_remove_parent_theme_locations', 20 );

function shopping_solution_font_url() {
	$font_url      = '';
	$font_family   = array();
	$font_family[] = 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	
	$query_args = array(
		'family' => rawurlencode(implode('|', $font_family)),
	);
	$font_url = add_query_arg($query_args, '//fonts.googleapis.com/css');
	return $font_url;
}

// Customizer Section
function shopping_solution_customizer ( $wp_customize ) {

	$wp_customize->add_setting('shopping_solution_dicount_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('shopping_solution_dicount_text', array(
		'label'   => __('Top Discount Text', 'shopping-solution'),
		'section' => 'ecommerce_solution_topbar',
		'setting' => 'shopping_solution_dicount_text',
		'type'    => 'text',
	));

	$wp_customize->add_setting('shopping_solution_sale_text', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('shopping_solution_sale_text', array(
		'label'   => __('Sale Text', 'shopping-solution'),
		'section' => 'ecommerce_solution_topbar',
		'setting' => 'shopping_solution_sale_text',
		'type'    => 'text',
	));

	$wp_customize->add_section('shopping_solution_media', array(
		'title'    => __('Social Media', 'shopping-solution'),
		'panel'    => 'ecommerce_solution_panel_id',
	));

	$wp_customize->add_setting('shopping_solution_facebook_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('shopping_solution_facebook_link', array(
		'label'   => __('Facebook URL', 'shopping-solution'),
		'section' => 'shopping_solution_media',
		'setting' => 'shopping_solution_facebook_link',
		'type'    => 'url',
	));

	$wp_customize->add_setting('shopping_solution_twitter_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('shopping_solution_twitter_link', array(
		'label'   => __('Twitter URL', 'shopping-solution'),
		'section' => 'shopping_solution_media',
		'setting' => 'shopping_solution_twitter_link',
		'type'    => 'url',
	));

	$wp_customize->add_setting('shopping_solution_linkedin_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('shopping_solution_linkedin_link', array(
		'label'   => __('Linkedin URL', 'shopping-solution'),
		'section' => 'shopping_solution_media',
		'setting' => 'shopping_solution_linkedin_link',
		'type'    => 'url',
	));

	$wp_customize->add_setting('shopping_solution_instagram_link', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	));
	$wp_customize->add_control('shopping_solution_instagram_link', array(
		'label'   => __('Instagram URL', 'shopping-solution'),
		'section' => 'shopping_solution_media',
		'setting' => 'shopping_solution_instagram_link',
		'type'    => 'url',
	));
}
add_action( 'customize_register', 'shopping_solution_customizer' );

/*------------------------------section-pro.php part----------------------------------------*/
require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );

class Shopping_Solution_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'shopping-solution';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}

				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}

/*---------------customizer.php part--------------------------*/
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Shopping_Solution_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Register custom section types.
		$manager->register_section_type( 'Shopping_Solution_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Shopping_Solution_Customize_Section_Pro(
				$manager,
				'shopping_solution',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Shopping Solution Pro', 'shopping-solution' ),
					'pro_text' => esc_html__( 'Go Pro', 'shopping-solution' ),
					'pro_url'  => esc_url('https://www.buywptemplates.com/shopping-wordpress-theme'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */

	public function enqueue_control_scripts() {

		wp_enqueue_script( 'shopping-solution-customize-controls', get_stylesheet_directory_uri() . '/js/customize-controls-child.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'shopping-solution-customize-controls', get_stylesheet_directory_uri() . '/css/customize-controls-child.css' );
	}
}

// Doing this customizer thang!
Shopping_Solution_Customize::get_instance();

/* Theme Widgets Setup */
function shopping_solution_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Home Sidebar', 'shopping-solution' ),
		'description'   => __( 'Appears on Home Page', 'shopping-solution' ),
		'id'            => 'home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'shopping_solution_widgets_init' );