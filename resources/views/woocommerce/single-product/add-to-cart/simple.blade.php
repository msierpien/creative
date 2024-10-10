@php
  global $product;
@endphp

@if($product->is_purchasable())
  {!! wc_get_stock_html($product) !!}

  @if($product->is_in_stock())
    @php do_action('woocommerce_before_add_to_cart_form'); @endphp

    <form class="cart" action="{{ esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) }}" method="post" enctype='multipart/form-data'>
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

      <button type="submit" name="add-to-cart" value="{{ esc_attr($product->get_id()) }}" class="single_add_to_cart_button button alt {{ wc_wp_theme_get_element_class_name('button') ? wc_wp_theme_get_element_class_name('button') : '' }}">
        {{ esc_html($product->single_add_to_cart_text()) }}
      </button>

      @php do_action('woocommerce_after_add_to_cart_button'); @endphp
    </form>

    @php do_action('woocommerce_after_add_to_cart_form'); @endphp
  @endif
@endif