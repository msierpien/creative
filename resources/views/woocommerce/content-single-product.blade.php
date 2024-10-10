@php
    defined('ABSPATH') || exit();

    global $product;

    /**
     * Hook: woocommerce_before_single_product.
     *
     * @hooked woocommerce_output_all_notices - 10
     */
    do_action('woocommerce_before_single_product');

    if (post_password_required()) {
        echo get_the_password_form(); // WPCS: XSS ok.
        return;
    }
@endphp

<div id="product-{{ get_the_ID() }}" @php wc_product_class('p-4 bg-white shadow-md rounded-lg', $product); @endphp>
    <div class="relative"> 


        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Product Gallery --}}
            <div class="flex-1">
                @include('components.product.product-gallery')
            </div>
    








						
            {{-- Product Summary --}}
            <div class="flex-1 summary entry-summary gb-red">
                <div class="space-y-4">
                    {{-- Title --}}
                    @include('woocommerce.single-product.title')
                    
                    {{-- Rating --}}
                    <div class="flex items-center space-x-2">
                        @include('woocommerce.single-product.rating')
                    </div>
                    
                    {{-- Price --}}
                    <div class="text-2xl font-semibold text-gray-800">
                        @include('woocommerce.single-product.price')
                    </div>
                    
                    {{-- Short Description --}}
                    <div class="text-gray-600">
                        @include('woocommerce.single-product.short-description')
                    </div>
                    
                    {{-- Add to Cart Button --}}
                    <div>
                        @php do_action('product_summary_add_to_card'); @endphp
												
                    </div>
                    
                    
                    testowe dane atrybutów </br>

         
										
                    
                    {{-- Product Meta --}}
                    <div class="text-sm text-gray-500">
                        @include('woocommerce.single-product.meta')
                    </div>
                    
                    {{-- Sharing Options --}}
                    <div class="flex space-x-4 mt-4">
                        @include('woocommerce.single-product.share')
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs, Upsell, Related Products --}}
        <div class="mt-12">
            @php
                do_action('woocommerce_after_single_product_summary');
            @endphp
        </div>
    </div>

    @php do_action('woocommerce_after_single_product'); @endphp
</div>