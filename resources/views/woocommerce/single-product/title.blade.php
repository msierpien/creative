@if($product)
<div class="flex flex-col-reverse md:flex-col">
    <h1 class="md:mt-2 product_title entry-title font-cormorant text-3xl md:text-5xl">{{ $product->get_name() }}</h1>

    @php
        // Pobieramy kategorie produktu
        $categories = wp_get_post_terms($product->get_id(), 'product_cat');

        // Sprawdzamy, czy są jakieś przypisane kategorie
        $main_category = !empty($categories) ? $categories[0]->name : 'Brak kategorii';
    @endphp

    <h5 class=" text-grey-30 font-thin ">{{ $main_category }}</h5>

</div>
@endif
