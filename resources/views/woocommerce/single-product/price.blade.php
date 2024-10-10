<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
@if ($product->is_on_sale())
		<p class="{{ apply_filters('woocommerce_product_price_class', 'price') }} text-red-500 line-through">{!! $product->get_regular_price() !!}</p>
		@else
		
		<p class="{{ apply_filters('woocommerce_product_price_class', 'price') }}">{!! $product->get_price_html() !!}</p>
		
@endif

