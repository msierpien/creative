<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

global $post, $product;

?>
{{-- if $product lub $post --}}
@if ($product->is_on_sale() || $post->is_on_sale())
    <!-- Etykieta "On Sale" -->
    <span class="onsale absolute top-4 left-4 bg-red text-white px-2 py-1 rounded text-sm ">
        {{ __('Sale!', 'woocommerce') }}
    </span>
@endif
