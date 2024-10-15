@extends('layouts.app')

@section('content')
    @php
        do_action('get_header', 'shop');
        // do_action('woocommerce_before_main_content');

        ob_start(); // Rozpocznij buforowanie wyjścia
        do_action('woocommerce_archive_description'); // Wykonaj akcję
        $description = ob_get_clean(); // Zapisz wyjście do zmiennej i wyczyść bufor

        $current_category_id = null;
        if (is_product_category()) {
            $current_category = get_queried_object();
            $current_category_id = $current_category->term_id;
        }

    @endphp
 <x-subcategories category-id={{$current_category_id}} />

    <div class="container mx-auto">
        <header class="woocommerce-products-header">

            @include('components.section-header', [
                'title' => woocommerce_page_title(false),
                'description' => $description, // Przekazanie opisu do komponentu
            ])
            @component('components.module.filter-products')
            @endcomponent
        </header>


        @if (woocommerce_product_loop())

            @php

                woocommerce_product_loop_start();
            @endphp

            @if (wc_get_loop_prop('total'))
                @while (have_posts())
                    @php
                        the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    @endphp
                @endwhile
            @endif

            @php
                woocommerce_product_loop_end();
                do_action('woocommerce_after_shop_loop');
            @endphp
        @else
            @php
                do_action('woocommerce_no_products_found');
            @endphp
        @endif



        @php
            do_action('woocommerce_after_main_content');
            do_action('get_sidebar', 'shop');
            do_action('get_footer', 'shop');
        @endphp
    </div>
@endsection

{{--     
    @section('sidebar')

    
    @endsection 
     --}}
