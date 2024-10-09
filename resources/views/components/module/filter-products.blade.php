@php
// Pobierz bieżące zapytanie WooCommerce
$query = $GLOBALS['wp_query']->query_vars;

// Pobierz produkty na podstawie bieżącego zapytania
$products = wc_get_products([
    'status' => 'publish',
    'limit' => -1,
    'category' => isset($query['product_cat']) ? $query['product_cat'] : '',
    'tag' => isset($query['product_tag']) ? $query['product_tag'] : '',
]);

$all_attributes = [];

foreach ($products as $product) {
    $attributes = $product->get_attributes();
    foreach ($attributes as $attribute) {
        $taxonomy = $attribute->get_name();
        if (!isset($all_attributes[$taxonomy])) {
            $all_attributes[$taxonomy] = [
                'terms' => [],
                'label' => wc_attribute_label($taxonomy),
            ];
        }
        
        $terms = $attribute->get_terms();
        if ($terms) {
            foreach ($terms as $term) {
                if (!in_array($term->term_id, array_column($all_attributes[$taxonomy]['terms'], 'term_id'))) {
                    $all_attributes[$taxonomy]['terms'][] = $term;
                }
            }
        }
    }
}

ob_start();
woocommerce_catalog_ordering();
$sorting = ob_get_clean();
@endphp
<div class="flex flex-wrap gap-5 my-5 mx-4 md:mx-0">
  @foreach ($all_attributes as $taxonomy => $attribute_data)
      <div class="product-attribute relative ">
          
        <button class="p-2  btn btn-secondary btn-background-slide show-attributes-button" data-target="attribute-group-{{ $taxonomy }}">
            <span class="flex gap-2">
                {{ $attribute_data['label'] ?: wc_attribute_label($taxonomy) }}
                <svg focusable="false" width="20" height="20" class="icon--chevron   " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                    <path d="M5 7.5L10 12.5L15 7.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
            </span>
        </button>
         
          <ul id="{{$taxonomy}}" class="attribute-options border absolute p-2 min-w-40 hidden bg-white z-30">
              @foreach ($attribute_data['terms'] as $term)
                  <li>
                      <label>
                          <input type="checkbox" name="{{ $taxonomy }}[]" value="{{ $term->slug }}">
                          {{ $term->name }}
                      </label>
                  </li>
              @endforeach
          </ul>
      </div>
  @endforeach 
  {!! $sorting !!}


</div>