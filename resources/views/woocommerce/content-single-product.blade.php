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

<div id="product-{{ get_the_ID() }}" @php wc_product_class('', $product); @endphp>
    <div class="relative">
        {{-- Sale Flash --}}
        @php
            if ($product->is_on_sale()) {
                echo '<span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold uppercase px-2 py-1 rounded">Sale!</span>';
            }
        @endphp
        <div class="flex">
            @include('components.product.product-gallery')
            <div class="summary entry-summary">
                @php
                    /**
                     * Hook: woocommerce_single_product_summary.
                     *
                     * @hooked woocommerce_template_single_title - 5  ok
                     *
                     * @hooked woocommerce_template_single_rating - 10 ok
                     * @hooked woocommerce_template_single_price - 10 ok
                     *
                     * @hooked woocommerce_template_single_excerpt - 20 short description ok
                     *
                     * @hooked woocommerce_template_single_add_to_cart - 30 ok
                     *
                     * @hooked woocommerce_template_single_meta - 40   ok
                     * @hooked woocommerce_template_single_sharing - 50
                     * @hooked WC_Structured_Data::generate_product_data() - 60
                     */
                @endphp
                @include('woocommerce.single-product.title')
                @include('woocommerce.single-product.rating')
                @include('woocommerce.single-product.price')
                @include('woocommerce.single-product.short-description')

                @php do_action('product_summary_add_to_card');  @endphp
                @include('woocommerce.single-product.meta')
                @include('woocommerce.single-product.share')
								{{-- @php do_action( WC_Structured_Data::generate_product_data() ); @endphp --}}

            </div>
        </div>



        @php
            /**
             * Hook: woocommerce_after_single_product_summary.
             *
             * @hooked woocommerce_output_product_data_tabs - 10
             * @hooked woocommerce_upsell_display - 15
             * @hooked woocommerce_output_related_products - 20
             */
            do_action('woocommerce_after_single_product_summary');
        @endphp
    </div>

    @php do_action('woocommerce_after_single_product'); @endphp
