@php
  global $product, $post;
@endphp

@php do_action('woocommerce_before_add_to_cart_form'); @endphp

<form class="cart grouped_form" action="{{ esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) }}" method="post" enctype='multipart/form-data'>
  <table cellspacing="0" class="woocommerce-grouped-product-list group_table">
    <tbody>
      @php
        $quantities_required = false;
        $previous_post = $post;
        $grouped_product_columns = apply_filters('woocommerce_grouped_product_columns', ['quantity', 'label', 'price'], $product);
        $show_add_to_cart_button = false;

        do_action('woocommerce_grouped_product_list_before', $grouped_product_columns, $quantities_required, $product);
      @endphp

      @foreach($grouped_products as $grouped_product_child)
        @php
          $post_object = get_post($grouped_product_child->get_id());
          $quantities_required = $quantities_required || ($grouped_product_child->is_purchasable() && !$grouped_product_child->has_options());
          $post = $post_object;
          setup_postdata($post);

          if ($grouped_product_child->is_in_stock()) {
            $show_add_to_cart_button = true;
          }
        @endphp

        <tr id="product-{{ esc_attr($grouped_product_child->get_id()) }}" class="woocommerce-grouped-product-list-item {{ esc_attr(implode(' ', wc_get_product_class('', $grouped_product_child))) }}">
          @foreach($grouped_product_columns as $column_id)
            @php do_action('woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child); @endphp

            @switch($column_id)
              @case('quantity')
                @php ob_start(); @endphp

                @if(!$grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || !$grouped_product_child->is_in_stock())
                  @php woocommerce_template_loop_add_to_cart(); @endphp
                @elseif($grouped_product_child->is_sold_individually())
                  <input type="checkbox" name="quantity[{{ esc_attr($grouped_product_child->get_id()) }}]" value="1" class="wc-grouped-product-add-to-cart-checkbox" id="quantity-{{ esc_attr($grouped_product_child->get_id()) }}" />
                  <label for="quantity-{{ esc_attr($grouped_product_child->get_id()) }}" class="screen-reader-text">{{ esc_html__('Buy one of this item', 'woocommerce') }}</label>
                @else
                  @php do_action('woocommerce_before_add_to_cart_quantity'); @endphp

                  @php
                    woocommerce_quantity_input([
                      'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
                      'input_value' => request()->has('quantity') && request()->get('quantity')[$grouped_product_child->get_id()] ? wc_stock_amount(request()->get('quantity')[$grouped_product_child->get_id()]) : '',
                      'min_value'   => apply_filters('woocommerce_quantity_input_min', 0, $grouped_product_child),
                      'max_value'   => apply_filters('woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child),
                      'placeholder' => '0',
                    ]);
                  @endphp

                  @php do_action('woocommerce_after_add_to_cart_quantity'); @endphp
                @endif

                @php $value = ob_get_clean(); @endphp
                @break

              @case('label')
                @php
                  $value = '<label for="product-' . esc_attr($grouped_product_child->get_id()) . '">';
                  $value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url(apply_filters('woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id())) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
                  $value .= '</label>';
                @endphp
                @break

              @case('price')
                @php $value = $grouped_product_child->get_price_html() . wc_get_stock_html($grouped_product_child); @endphp
                @break

              @default
                @php $value = ''; @endphp
                @break
            @endswitch

            <td class="woocommerce-grouped-product-list-item__{{ esc_attr($column_id) }}">{!! apply_filters('woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child) !!}</td>

            @php do_action('woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child); @endphp
          @endforeach
        </tr>
      @endforeach

      @php
        $post = $previous_post;
        setup_postdata($post);
        do_action('woocommerce_grouped_product_list_after', $grouped_product_columns, $quantities_required, $product);
      @endphp
    </tbody>
  </table>

  <input type="hidden" name="add-to-cart" value="{{ esc_attr($product->get_id()) }}" />

  @if($quantities_required && $show_add_to_cart_button)
    @php do_action('woocommerce_before_add_to_cart_button'); @endphp

    <button type="submit" class="single_add_to_cart_button button alt {{ wc_wp_theme_get_element_class_name('button') ? wc_wp_theme_get_element_class_name('button') : '' }}">
      {{ esc_html($product->single_add_to_cart_text()) }}
    </button>

    @php do_action('woocommerce_after_add_to_cart_button'); @endphp
  @endif
</form>

@php do_action('woocommerce_after_add_to_cart_form'); @endphp