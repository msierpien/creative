@php
/**
 * Single Product Loop Item Component
 * 
 * @param WC_Product $product The product object
 */

$main_category = $product->get_category_ids()[0] ?? null;
$main_category_name = $main_category ? get_term($main_category, 'product_cat')->name : '';
$main_category_link = $main_category ? get_term_link($main_category, 'product_cat') : '';

$attachment_ids = $product->get_gallery_image_ids();
$second_image_url = '';
if (!empty($attachment_ids)) {
    $second_image_url = wp_get_attachment_image_url($attachment_ids[0], 'woocommerce_thumbnail');
}
@endphp

<div class="bg-white  overflow-hidden product-item " data-second-image="{{ $second_image_url }}">
  <a href="{{ $product->get_permalink() }}" class="block ">
    <div class="relative ">
        <img src="{{ $product->get_image_id() ? wp_get_attachment_image_url($product->get_image_id(), 'woocommerce_thumbnail') : wc_placeholder_img_src() }}" 
             alt="{{ $product->get_name() }}" 
             class="w-full object-cover bg-grey-5 product-image transition-opacity duration-300 ease-in-out">
        @if($product->is_featured())
           @include('components.product.badge', ['text' => 'Wyróżniony'])
        @endif
   
       @include('components.product.button-like', ['product' => $product])
        @include('components.product.button-add-tocart', ['product' => $product])
    </div>
    <div class="p-4 items-stretch ">
        <a href={{ $main_category_link }} class="text-sm text-gray-600">{{ $main_category_name }}</a>
        <h3 class="font-normal text-base mt-1">{{ $product->get_name() }}</h3>
        <div class="mt-4 flex justify-between items-center ">
            <span class="font-bold">{!! $product->get_price_html() !!}</span>
        </div>
    </div>
  </a>
 
</div>