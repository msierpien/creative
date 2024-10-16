@php
    $product_count = $category->count;
    $category_link = get_term_link($category, 'product_cat');
    $category_name = $category->name;
@endphp

@if ($featured_products->have_posts())
    <section class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        @include('components.section-header', [
            'title' => $sectionTitle,
            'description' => $sectionDescription,
        ])
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 ">
            @while ($featured_products->have_posts())
                @php
                    $featured_products->the_post();
                    $product = wc_get_product(get_the_ID());
                @endphp
                @include('components.product.single-product-loop', ['product' => $product])
            @endwhile
            @php wp_reset_postdata(); @endphp
        </div>

        @if ($product_count > 4)
            <footer class="my-2 p-4 md:my-5 md:p-8 flex justify-center">
                <x-link name="Zobacz wszystkie {{ esc_html($category_name) }}"
                    link="{{ esc_url($category_link) }}" target="" />
            </footer>
        @endif
    </section>
@else
    <p>Brak wyróżnionych produktów do wyświetlenia.</p>
@endif


