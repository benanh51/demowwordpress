<?php

namespace wpcmart;

class Mini_Cart {
	public function __construct() {
		$this->boot();
	}

	public function boot() {
		add_action( 'wpcmart/mini_cart', [ $this, 'display' ] );
		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'cart_link_fragment' ] );
	}

	public function display() {
		echo '<div class="mini-cart">';
		echo wp_kses_post( $this->render() );
		//$this->cart_drawer();
		echo '</div>';
	}

	public function cart_link_fragment( $fragments ) {
		$fragments['a.cart-contents'] = $this->render();

		return $fragments;
	}

	public function render() {
		$html = '<a class="cart-contents flex items-center space-x-1" href="' . wc_get_cart_url() . '">';
		$html .= sprintf( '<div class="relative mr-2"><i class="icon-shopping-cart !font-semibold"></i><span class="count absolute bg-primary-500 text-center rounded-full leading-none text-xs">%s</span></div>', WC()->cart->get_cart_contents_count() );
		$html .= sprintf( '<span class="amount !font-semibold">%s</span>', wp_kses_data( WC()->cart->get_cart_subtotal() ) );
		$html .= '</a>';

		return $html;
	}

	public function cart_drawer() {
		$html = '<div class="mini-cart-widget">';
		ob_start();
		the_widget( 'WC_Widget_Cart', 'title=' );
		$html .= ob_get_clean();
		$html .= '</div>';

		echo $html; //phpcs:disable
	}
}
