<?php

namespace wpcmart;

class Woo {
	public function __construct() {
		$this->boot();
	}

	public function boot() {
		add_action( 'after_setup_theme', [ $this, 'setup_woo' ] );
		add_action( 'wpcmart/mini_cart', [ $this, 'header_wishlist' ], 9 );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		add_action( 'wpcmart/footer/before', [ $this, 'related_products' ] );
		add_filter( 'woocommerce_sale_flash', [ $this, 'woocommerce_sale_flash' ] );
		add_filter( 'woocommerce_breadcrumb_defaults', [ $this, 'change_breadcrumb_delimiter' ] );
		add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'product_label_stock' ], 9 );
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		add_action( 'wpcmart/header/after', [ $this, 'woocommerce_breadcrumb' ], 9 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 1 );
		add_action( 'woocommerce_before_shop_loop', [ $this, 'grid_list_layout' ], 10 );

		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', - 1 );

		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
		add_action( 'woocommerce_shop_loop_item_title', [ $this, 'template_loop_product_title' ] );

		add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'woocommerce_get_product_description' ], 15 );
	}

	public function setup_woo() {
		add_theme_support(
			'woocommerce',
			[
				'product_grid' => [
					'default_columns' => 3,
					'default_rows'    => 4,
					'min_columns'     => 1,
					'max_columns'     => 6,
					'min_rows'        => 1,
				],
			]
		);

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	public function woocommerce_get_product_description() {
		global $post;

		if ( ! $post->post_excerpt ) {
			return;
		}

		echo '<div class="short-description my-2 text-gray-500">';
		echo wp_kses_post( $post->post_excerpt );
		echo '</div>';
	}

	public function template_loop_product_title() {
		echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '"><a href="' . esc_url_raw( get_the_permalink() ) . '">' . get_the_title() . '</a></h2>';
	}

	public function grid_list_layout() {
		$layout = 'grid';

		if ( isset( $_COOKIE['shop_layout'] ) ) {
			$layout = sanitize_text_field( wp_unslash( $_COOKIE['shop_layout'] ) );
		}

		$class_grid = 'grid';

		if ( $layout === 'grid' ) {
			$class_grid = 'grid active';
		}

		$class_list = 'list';

		if ( $layout === 'list' ) {
			$class_list = 'list active';
		}
		?>
		<div class="grid-list-toggle flex items-center float-right">
			<a href="#" class="<?php echo esc_attr( $class_grid ); ?>" data-class="grid">
				<span class="screen-reader-text"><?php echo esc_html__( 'Grid View', 'wpcmart' ); ?></span>
				<i class="icon-grid"></i>
			</a>
			<a href="#" class="<?php echo esc_attr( $class_list ); ?>" data-class="list">
				<span class="screen-reader-text"><?php echo esc_html__( 'List View', 'wpcmart' ); ?></span>
				<i class="icon-list"></i>
			</a>
		</div>
		<?php
	}

	public function product_label_stock() {
		global $product;
		if ( ! $product->is_in_stock() ) {
			echo '<span class="out-of-stock">' . esc_html__( 'Out of stock', 'wpcmart' ) . '</span>';
		}
	}

	public function woocommerce_breadcrumb() {
		if ( is_page_template( 'page-templates/home.php' ) ) {
			return;
		}
		woocommerce_breadcrumb();
	}

	public function header_wishlist() {
		if ( ! function_exists( 'woosw_init' ) ) {
			return;
		}
		$html = sprintf(
			'<div class="mini-wishlist mr-7"><a class="hover:no-underline relative" href="%s"><i class="icon-heart !font-semibold"></i><span class="count absolute bg-primary-500 text-center rounded-full leading-none text-xs">%d</span></a></div>',
			\WPCleverWoosw::get_url( \WPCleverWoosw::get_key(), true ),
			\WPCleverWoosw::get_count( \WPCleverWoosw::get_key() )
		);

		echo wp_kses( $html, 'default' );
	}

	public function related_products() {
		if ( ! is_single() ) {
			return;
		}
		woocommerce_output_related_products();
	}

	public function woocommerce_sale_flash() {
		global $product;
		if ( ! $product->is_on_sale() ) {
			return;
		}

		$percentage = '';
		if ( $product->get_type() === 'variable' ) {
			$available_variations = $product->get_variation_prices();
			$max_percentage       = 0;

			foreach ( $available_variations['regular_price'] as $key => $regular_price ) {
				$sale_price = $available_variations['sale_price'][ $key ];
				if ( $sale_price < $regular_price ) {
					$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
					if ( $percentage > $max_percentage ) {
						$max_percentage = $percentage;
					}
				}
			}
			$percentage = $max_percentage;
		} elseif ( ( $product->get_type() === 'simple' || $product->get_type() === 'external' ) ) {
			$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
		}

		if ( $percentage ) {
			$output = sprintf( "<span class='onsale'>-%d%%</span>", $percentage );
		} else {
			$output = sprintf( "<span class='onsale'>%s</span>", esc_html__( 'Sale', 'wpcmart' ) );
		}

		echo wp_kses( $output, 'default' );
	}

	public function change_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter']   = '<span class="breadcrumb-separator"> <i class="icon-chevron-right text-xs"></i> </span>';
		$defaults['wrap_before'] = '<div class="container my-4"><nav class="woocommerce-breadcrumb" aria-label="' . esc_attr__( 'breadcrumbs', 'wpcmart' ) . '">';
		$defaults['wrap_after']  = '</nav></div>';

		return $defaults;
	}
}
