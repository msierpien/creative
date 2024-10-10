@php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    do_action('woocommerce_before_single_product_summary');

    global $product;

    $attachment_ids = $product->get_gallery_image_ids();
    $featured_image_id = $product->get_image_id();
    array_unshift($attachment_ids, $featured_image_id);
@endphp

<div class="product-gallery flex flex-col md:flex-row gap-4">
    <div class="thumbnails w-full md:w-1/4 flex flex-row md:flex-col gap-2 overflow-x-auto md:overflow-y-auto">
        @foreach ($attachment_ids as $attachment_id)
            <div class="thumbnail-wrapper w-20 h-30 flex-shrink-0">
                <img src="{{ wp_get_attachment_image_url($attachment_id, 'thumbnail') }}"
                    alt="{{ get_post_meta($attachment_id, '_wp_attachment_image_alt', true) }}"
                    class="w-full h-full bg-grey-5 object-cover rounded cursor-pointer hover:opacity-75 transition-opacity duration-300"
                    data-full-img="{{ wp_get_attachment_image_url($attachment_id, 'full') }}">
            </div>
        @endforeach
    </div>
    <div class="main-image w-full md:w-3/4">
        @if (!empty($attachment_ids))
            <img src="{{ wp_get_attachment_image_url($attachment_ids[0], 'full') }}" alt="{{ $product->get_name() }}"
                class="w-full bg-grey-5 h-auto object-cover rounded-lg shadow-lg" id="main-product-image">
        @endif
    </div>

</div>

@if ($product->is_on_sale())
    <span class="onsale absolute top-4 left-4 bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">
        {{ __('Sale!', 'woocommerce') }}
    </span>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail-wrapper img');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainImage.src = this.getAttribute('data-full-img');
            });
        });
    });
</script>
