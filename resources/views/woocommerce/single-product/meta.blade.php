@php
  global $product;
@endphp

<div class="product_meta">

  @php do_action('woocommerce_product_meta_start'); @endphp

  @if(wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable')))
    <span class="sku_wrapper">{{ __('SKU:', 'woocommerce') }} <span class="sku">{{ $product->get_sku() ? $product->get_sku() : __('N/A', 'woocommerce') }}</span></span>
  @endif

  {!! wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . _n('Category:', 'Categories:', count($product->get_category_ids()), 'woocommerce') . ' ', '</span>') !!}

  {!! wc_get_product_tag_list($product->get_id(), ', ', '<span class="tagged_as">' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'woocommerce') . ' ', '</span>') !!}

  @php do_action('woocommerce_product_meta_end'); @endphp

</div>