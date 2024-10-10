<?php

namespace App;

/**
 * Register the theme sidebars.
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ];

    // Main Sidebars
    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id'   => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id'   => 'sidebar-footer',
    ] + $config);

    // WooCommerce Sidebar
    register_sidebar([
        'name'          => __('Shop Sidebar', 'your-theme-textdomain'),
        'id'            => 'woocommerce_sidebar',
        'description'   => __('Widgets in this area will be shown on shop pages.', 'your-theme-textdomain'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    // Footer Sidebars
    register_sidebar([
        'name'          => __('Footer Sidebar Service', 'your-theme-textdomain'),
        'id'            => 'footer_service_sidebar',
        'description'   => __('Widgets in this area will be shown in the footer.', ''),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);

    register_sidebar([
        'name'          => __('Footer Sidebar Menu', 'your-theme-textdomain'),
        'id'            => 'footer_menu_sidebar',
        'description'   => __('Widgets in this area will be shown in the footer.', ''),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
});
