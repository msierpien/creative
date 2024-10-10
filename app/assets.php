<?php

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 */
 
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();

    // Mega Menu Stylesheet
    $upload_dir = wp_upload_dir();
    $css_file = $upload_dir['baseurl'] . '/maxmegamenu/style.css';
    if (file_exists($upload_dir['basedir'] . '/maxmegamenu/style.css')) {
        wp_enqueue_style('max-mega-menu-css', $css_file, [], null);
    }
}, 100);

/**
 * Register block editor assets.
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);
