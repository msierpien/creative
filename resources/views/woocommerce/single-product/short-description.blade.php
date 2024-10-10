
@php
    // Pobranie krótkiego opisu produktu
    $short_description = apply_filters('woocommerce_short_description', $product->get_short_description());
@endphp

@if ($short_description)
    <div class="woocommerce-product-details__short-description py-5">
        {!! $short_description !!}
    </div>
@endif
