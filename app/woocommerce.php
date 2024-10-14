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


// Używamy haka WooCommerce, aby zmiana dotyczyła tylko produktów WooCommerce
add_action('init', 'App\\custom_woocommerce_image_dimensions', 1);

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


// Add Nonce to the script
function my_enqueue_react_script() {
    wp_enqueue_script('app-js', get_template_directory_uri() . '/public/js/app.js', [], null, true);
    
    // Dodaj nonce do skryptu
    wp_localize_script('app-js', 'myAppData', [
        'nonce' => wp_create_nonce('wc_store_api')  // Zmiana na 'wp_rest' zamiast 'wc_store_api'
    ]);
}
add_action('wp_enqueue_scripts', 'App\\my_enqueue_react_script');

function my_product_data_to_react() {
    global $product;

    // Sprawdź, czy $product jest prawidłowym obiektem WC_Product
    if ( ! is_a( $product, 'WC_Product' ) ) {
        return;  // Przerwij, jeśli $product nie jest obiektem WooCommerce
    }

    // Sprawdź, czy produkt istnieje i jest typu variable
    if ($product && $product->get_type() === 'variable') {
        $product_variations = $product->get_available_variations();
        $attribute_data = [];

        // Pobierz listę atrybutów
        foreach ($product->get_attributes() as $taxonomy => $attribute) {
            $attribute_label = wc_attribute_label($taxonomy);  // Pobierz przyjazną nazwę atrybutu
            $attribute_data[$taxonomy] = [
                'name' => $attribute_label,  // Nazwa atrybutu np. "Kolor"
                'terms' => wc_get_product_terms($product->get_id(), $taxonomy, ['fields' => 'all'])  // Pobierz wszystkie wartości atrybutów
            ];
        }
    } else {
        $product_variations = [];
        $attribute_data = [];
    }
    $currency_symbol = get_woocommerce_currency_symbol(); // Pobierz symbol waluty



    $product_data = [
        'productId' => $product->get_id(),
        'productType' => $product->get_type(),
        'productVariations' => $product_variations,
        'productAttributes' => $attribute_data,  // Dodajemy dane atrybutów
        'productPrice' => $product->get_price(),
        'productTitle' => $product->get_title(),
        'currencySymbol' => $currency_symbol // Dodaj symbol waluty
    ];

    wp_localize_script('app-js', 'productData', $product_data);
}
add_action('wp_enqueue_scripts', 'App\\my_product_data_to_react');
