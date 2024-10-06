<div>
    @if (have_rows('moduly'))
        @while (have_rows('moduly'))
            @php the_row() @endphp
            @if (get_row_layout() == 'category_module')
                <x-featured-products categoryId="{{ get_sub_field('category') }}"
                    productPerPage="{{ get_sub_field('quantity_product') }}" sectionTitle="{{ get_sub_field('title') }}"
                    sectionDescription="{{ get_sub_field('description') }}" />
            @elseif (get_row_layout() == 'text')
                <section>
                    @php
                        // Zbieramy dane z 'items' w tablicy
                        $items = [];
                        if (have_rows('items')) {
                            while (have_rows('items')) {
                                the_row();
                                $icon = get_sub_field('icon'); // Pobierz dane obrazu

                                // Sprawdzamy, czy istnieje obraz i pobieramy miniaturę
                                $icon_url = $icon ? wp_get_attachment_image_url($icon['ID'], 'thumbnail') : null;

                                $items[] = [
                                    'title' => get_sub_field('title'),
                                    'description' => get_sub_field('description'),
                                    'icon' => $icon_url, // Przypisz URL miniatury
                                    'svg_code' => get_sub_field('svg_code'),
                                ];
                            }
                        }
                    @endphp

                    <x-featured-text sectionTitle="{{ get_sub_field('title') }}"
                        sectionDescription="{{ get_sub_field('description') }}" :items="$items" />
                </section>
            @endif
        @endwhile
    @endif
</div>
