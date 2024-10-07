{{-- 
    Content wrappers

    This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.blade.php.
    
    HOWEVER, on occasion WooCommerce will need to update template files and you
    (the theme developer) will need to copy the new files to your theme to
    maintain compatibility. We try to do this as little as possible, but it does
    happen. When this occurs the version of the template file will be bumped and
    the readme will list any important changes.

    @see https://woocommerce.com/document/template-structure/
--}}

@php
    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    $template = wc_get_theme_slug_for_templates();
@endphp

@switch($template)
    @case('twentyten')
        <div id="container"><div id="content" role="main">
        @break

    @case('twentyeleven')
        <div id="primary"><div id="content" role="main" class="twentyeleven">
        @break

    @case('twentytwelve')
        <div id="primary" class="site-content"><div id="content" role="main" class="twentytwelve">
        @break

    @case('twentythirteen')
        <div id="primary" class="site-content"><div id="content" role="main" class="entry-content twentythirteen">
        @break

    @case('twentyfourteen')
        <div id="primary" class="content-area"><div id="content" role="main" class="site-content twentyfourteen"><div class="tfwc">
        @break

    @case('twentyfifteen')
        <div id="primary" role="main" class="content-area twentyfifteen"><div id="main" class="site-main t15wc">
        @break

    @case('twentysixteen')
        <div id="primary" class="content-area twentysixteen"><main id="main" class="site-main" role="main">
        @break

    @default
        <div id="primary" class="content-area">
@endswitch
