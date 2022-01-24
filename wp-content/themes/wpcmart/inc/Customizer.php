<?php

namespace wpcmart;

use Kirki;

class Customizer {
	public $fields;

	public function __construct() {
		$this->fields = [
			[
				'type'      => 'typography',
				'settings'  => 'base_font',
				'label'     => esc_html__( 'Base Font', 'wpcmart' ),
				'section'   => 'theme',
				'default'   => [
					'font-family'    => 'Source Sans Pro',
					'variant'        => 'regular',
					'font-size'      => '18px',
					'line-height'    => '1.5',
					'letter-spacing' => '0',
					'color'          => '#333333',
					'text-transform' => 'none',
					'text-align'     => 'left',
				],
				'priority'  => 10,
				'transport' => 'auto',
				'choices'   => [
					'variant' => [ 'regular', 'italic', '600', '700', '700italic' ],
				],
				'output'    => [
					[
						'element' => 'body',
					],
				],
			],
			[
				'type'      => 'color',
				'settings'  => 'header_bg',
				'label'     => esc_html__( 'Header Background', 'wpcmart' ),
				'section'   => 'colors',
				'default'   => '#222',
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.site-header',
						'property' => 'background-color',
					],
				],
			],
			[
				'type'      => 'color',
				'settings'  => 'footer_bg',
				'label'     => esc_html__( 'Footer Background', 'wpcmart' ),
				'section'   => 'colors',
				'default'   => '#222',
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.site-footer',
						'property' => 'background-color',
					],
				],
			],
			[
				'type'      => 'color',
				'settings'  => 'footer_color',
				'label'     => esc_html__( 'Footer Color', 'wpcmart' ),
				'section'   => 'colors',
				'default'   => '#fff',
				'transport' => 'auto',
				'output'    => [
					[
						'element'  => '.site-footer',
						'property' => 'color',
					],
				],
			],
		];

		$this->boot();
	}

	public function boot() {
		add_action( 'customize_register', [ $this, 'live_title_desc' ] );
		add_filter( 'kirki_config', [ $this, 'url_path' ] );
		add_action( 'widgets_init', [ $this, 'add_config' ], 99 );
		add_action( 'widgets_init', [ $this, 'sections_register' ], 99 );
		add_action( 'widgets_init', [ $this, 'fields_register' ], 99 );
	}

	public function live_title_desc( \WP_Customize_Manager $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				[
					'selector'        => '.site-title a',
					'render_callback' => function () {
						bloginfo( 'name' );
					},
				]
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				[
					'selector'        => '.site-description',
					'render_callback' => function () {
						bloginfo( 'description' );
					},
				]
			);
		}
	}

	public function url_path( $config ) {
		$config['url_path'] = get_theme_file_uri( 'vendor/aristath/kirki/' );

		return $config;
	}

	public function add_config() {
		Kirki::add_config(
			THEME_SLUG,
			[
				'option_type' => 'theme_mod',
				'capability'  => 'edit_theme_options',
			]
		);
	}

	public function sections_register() {
		Kirki::add_section(
			'theme',
			[
				'title'       => esc_html__( 'Theme Settings', 'wpcmart' ),
				'description' => esc_html__( 'My section description.', 'wpcmart' ),
				'priority'    => 10,
			]
		);
	}

	public function fields_register() {
		foreach ( $this->fields as $field => $value ) {
			Kirki::add_field( THEME_SLUG, $value );
		}
	}
}
