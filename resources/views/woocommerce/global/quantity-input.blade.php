@php
  /* translators: %s: Quantity. */
  $label = !empty($args['product_name']) ? sprintf(__('Quantity of %s', 'woocommerce'), wp_strip_all_tags($args['product_name'])) : __('Quantity', 'woocommerce');
@endphp

<div class="quantity">
  @php do_action('woocommerce_before_quantity_input_field'); @endphp

  <label class="screen-reader-text" for="{{ $input_id }}">{{ $label }}</label>
  <input
    type="{{ $type }}"
    @if($readonly) readonly="readonly" @endif
    id="{{ $input_id }}"
    class="{{ implode(' ', (array) $classes) }}"
    name="{{ $input_name }}"
    value="{{ $input_value }}"
    aria-label="{{ __('Product quantity', 'woocommerce') }}"
    size="4"
    min="{{ $min_value }}"
    max="{{ $max_value > 0 ? $max_value : '' }}"
    @unless($readonly)
      step="{{ $step }}"
      placeholder="{{ $placeholder }}"
      inputmode="{{ $inputmode }}"
      autocomplete="{{ isset($autocomplete) ? $autocomplete : 'on' }}"
    @endunless
  />

  @php do_action('woocommerce_after_quantity_input_field'); @endphp
</div>