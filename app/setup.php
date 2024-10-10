<?php

/**
 * Theme setup.
 */

namespace App;
// Importowanie innych plików
require_once __DIR__ . '/assets.php';
require_once __DIR__ . '/widgets.php';
require_once __DIR__ . '/woocommerce.php';

add_action('after_setup_theme', function () {
    // Register navigation menus
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'user_navigation'    => __('User Navigation', 'sage'),
    ]);

    // Disable full-site editing support
    remove_theme_support('block-templates');

    // Disable default block patterns
    remove_theme_support('core-block-patterns');

    // Enable theme support for title, thumbnails, responsive embeds, HTML5, etc.
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'script', 'style']);
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for WooCommerce product gallery
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Add support for custom logo
    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
}, 20);