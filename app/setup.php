<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'user_navigation' => __('User Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});



//// 
// add_action('after_setup_theme', function () {
//     add_filter('sage.view.components', function ($components) {
//         $components['featured-products'] = view('components.featured-products');
//         return $components;
//     });
// });



/**
 * Add this code to your theme's app/setup.php file
 */

add_action('wp_enqueue_scripts', function () {
   $upload_dir = wp_upload_dir();
   $css_file = $upload_dir['baseurl'] . '/maxmegamenu/style.css';
   
   if (file_exists($upload_dir['basedir'] . '/maxmegamenu/style.css')) {
       wp_enqueue_style('max-mega-menu-css', $css_file, [], null);
   }
}, 20);



/**
 * Handle AJAX add to cart request
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
        wp_send_json([
            'success' => true
        ]);
    } else {
        wp_send_json([
            'success' => false
        ]);
    }

    wp_die();
}

add_action('after_setup_theme', 'App\\custom_woocommerce_image_dimensions', 1);

function custom_woocommerce_image_dimensions() {
    // Definiowanie proporcji 2:3 dla miniatur
    update_option('woocommerce_thumbnail_cropping', 'custom'); // Ustaw na niestandardowe
    update_option('woocommerce_thumbnail_cropping_custom_width', 2);
    update_option('woocommerce_thumbnail_cropping_custom_height', 3);
}

// Dodaj obsługę loga
function sage_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100, // wysokość loga
        'width'       => 400, // szerokość loga
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'App\\sage_setup');


// Dodaj obsługę galerii produktów WooCommerce
add_theme_support('wc-product-gallery-zoom');
add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');

function custom_shop_sidebar() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'your-theme-textdomain' ),
        'id'            => 'woocommerce_sidebar',
        'description'   => __( 'Widgets in this area will be shown on shop pages.', 'your-theme-textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'App\\custom_shop_sidebar' );

function footer_service_sidebar() {
    register_sidebar( array(
        'name'          => __( 'Footer Sidebar Service', 'your-theme-textdomain' ),
        'id'            => 'footer_service_sidebar',
        'description'   => __( 'Widgets in this area will be shown in the footer.', '' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Sidebar Menu', 'your-theme-textdomain' ),
        'id'            => 'footer_menu_sidebar',
        'description'   => __( 'Widgets in this area will be shown in the footer.', '' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
    
}


add_action( 'widgets_init', 'App\\footer_service_sidebar' );


// Wyłącz style WooCommerce na stronie sklepu
add_action('wp_enqueue_scripts', function () {
    if (is_shop() || is_product_category() || is_product()) {
        wp_dequeue_style('woocommerce-layout');
        wp_dequeue_style('woocommerce-general');
        wp_dequeue_style('woocommerce-smallscreen');
    }
}, 100);



