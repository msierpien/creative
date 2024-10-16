@php
  global $product;
@endphp

<div class="woocommerce-variation-add-to-cart variations_button">
  @php do_action('woocommerce_before_add_to_cart_button'); @endphp

  @php do_action('woocommerce_before_add_to_cart_quantity'); @endphp

  @php
    woocommerce_quantity_input([
      'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
      'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
      'input_value' => request()->has('quantity') ? wc_stock_amount(request('quantity')) : $product->get_min_purchase_quantity(),
    ]);
  @endphp

  @php do_action('woocommerce_after_add_to_cart_quantity'); @endphp

  <button type="submit" class="btn single_add_to_cart_button button alt {{ wc_wp_theme_get_element_class_name('button') ? wc_wp_theme_get_element_class_name('button') : '' }}">
    {{ esc_html($product->single_add_to_cart_text()) }}
  </button>

  @php do_action('woocommerce_after_add_to_cart_button'); @endphp

  <input type="hidden" name="add-to-cart" value="{{ absint($product->get_id()) }}" />
  <input type="hidden" name="product_id" value="{{ absint($product->get_id()) }}" />
  <input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>