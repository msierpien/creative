@php

/**
 * Button Add To Cart Component
 *  
 * @param WC_Product $product The product object
 */
 $quantity_in_cart = WC()->cart->get_cart_item_quantities()[$product->get_id()] ?? 0;
 $is_in_cart = $quantity_in_cart > 0;
 $svg_color = $is_in_cart ? '#336666' : '#4b5563';
 @endphp

<button
class="add-to-cart-button absolute bottom-2 right-2 border bg-white border-gray-50/50 rounded-full p-2 hover:bg-gray-20 transition-colors duration-300"
data-product-id="{{ $product->get_id() }}">
<svg class="w-[20px] h-[22px]" fill="none" stroke="{{ $svg_color }}" viewBox="0 0 20 22" xmlns="http://www.w3.org/2000/svg">
  <path d="M5 10V6C5 4.67392 5.52678 3.40215 6.46447 2.46447C7.40215 1.52678 8.67392 1 10 1C11.3261 1 12.5979 1.52678 13.5355 2.46447C14.4732 3.40215 15 4.67392 15 6V10M1 8V19C1 20.1046 1.89543 21 3 21H17C18.1046 21 19 20.1046 19 19V8C19 7.44772 18.5523 7 18 7H2C1.44772 7 1 7.44772 1 8Z" stroke="black" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>

@if ($is_in_cart)
    <span class="absolute -top-2 -right-2 bg-green text-black rounded-full w-5 h-5 flex items-center justify-center text-xs">
        {{ $quantity_in_cart }}
    </span>
@endif
</button>