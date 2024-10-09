@php
$attribute_taxonomies = wc_get_attribute_taxonomies();
$all_attributes = [];

// Pobierz wszystkie produkty na stronie archiwum
$products = wc_get_products([
    'status' => 'publish',
    'limit' => -1, // Wszystkie produkty
]);

foreach ($products as $product) {
    $attributes = $product->get_attributes();
    foreach ($attributes as $attribute) {
        $taxonomy = $attribute->get_name();
        if (!isset($all_attributes[$taxonomy])) {
            $all_attributes[$taxonomy] = [
                'terms' => [],
                'label' => '',
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

// Pobierz etykiety dla atrybutów
foreach ($attribute_taxonomies as $tax) {
    $taxonomy = 'pa_' . $tax->attribute_name;
    if (isset($all_attributes[$taxonomy])) {
        $all_attributes[$taxonomy]['label'] = $tax->attribute_label;
    }
}

ob_start(); // Rozpocznij buforowanie wyjścia
woocommerce_catalog_ordering(); // Wywołaj sortowanie
$sorting = ob_get_clean(); // Zapisz wynik do zmiennej


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