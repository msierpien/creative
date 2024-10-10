<?php

namespace App;

/**
 * Handle AJAX add to cart request.
 */
add_action('wp_ajax_add_to_cart', __NAMESPACE__ . '\\ajax_add_to_cart');
// add_action('wp_ajax_nopriv_add_to_cart', __NAMESPACE__ . '\\ajax_add_to_cart');

function ajax_add_to_cart() {
    check_ajax_referer('add-to-cart-nonce', 'nonce');

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity) && 'publish' === $product_status) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        wp_send_json(['success' => true]);
    } else {
        wp_send_json(['success' => false]);
    }

    wp_die();
}

/**
 * Set WooCommerce image dimensions.
 */
add_action('after_setup_theme', 'App\\custom_woocommerce_image_dimensions', 1);

function custom_woocommerce_image_dimensions() {
    // Set image dimensions for WooCommerce thumbnails
    update_option('woocommerce_thumbnail_cropping', 'custom');
    update_option('woocommerce_thumbnail_cropping_custom_width', 2);
    update_option('woocommerce_thumbnail_cropping_custom_height', 3);
}

/**
 * Disable WooCommerce styles on specific pages.
 */
add_action('wp_enqueue_scripts', function () {
    if (is_shop() || is_product_category() || is_product()) {
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
    }
}, 100);

/**
 * Add action for product summary.
 */
add_action('product_summary_add_to_card', 'woocommerce_template_single_add_to_cart', 30);
