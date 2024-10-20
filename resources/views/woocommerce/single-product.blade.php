@php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
@endphp

@extends('layouts.app')

@section('content')
    {{-- @php
        do_action('woocommerce_before_main_content');
    @endphp --}}

    @while(have_posts())
        @php
            the_post();
            wc_get_template_part('content', 'single-product');
        @endphp
    @endwhile

    @php
        do_action('woocommerce_after_main_content');
    @endphp

    {{-- @php
        do_action('woocommerce_sidebar');
    @endphp --}}
@endsection