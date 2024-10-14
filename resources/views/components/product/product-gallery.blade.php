@php
    global $product;

    // Pobierz identyfikatory galerii obrazków
    $attachment_ids = $product->get_gallery_image_ids();
    $featured_image_id = $product->get_image_id();
    
    // Upewnij się, że obraz wyróżniony jest dodany na początek galerii
    if (!empty($featured_image_id)) {
        array_unshift($attachment_ids, $featured_image_id);
    }

    // Pobierz dane obrazków
    $image_urls = array_map(function($id) {
        return [
            'thumb' => wp_get_attachment_image_url($id, 'custom-thumbnail-2x3'),
            'full' => wp_get_attachment_image_url($id, 'full'),
            'alt' => get_post_meta($id, '_wp_attachment_image_alt', true)
        ];
    }, $attachment_ids);

    // Sprawdź, czy widok jest mobilny
    $is_mobile = wp_is_mobile();
@endphp

@if ($is_mobile)
    <!-- Widok mobilny: jedno zdjęcie na pełną szerokość ekranu, przewijane palcem -->
    <div class="mobile-gallery bg-grey-10 flex overflow-x-auto snap-x snap-mandatory scroll-smooth">
        @foreach ($image_urls as $image)
        <div class="w-screen md:w-full flex-shrink-0 snap-center">
            <img src="{{ $image['full'] }}" alt="{{ $image['alt'] }}" class="w-full h-auto object-cover">
        </div>
        @endforeach
    </div>
@else
    <!-- Widok desktopowy: miniatury i główne zdjęcie -->
    <div class="product-gallery flex flex-col md:flex-row gap-4">
        <!-- Miniatury -->
        <div class="thumbnails w-full md:w-1/5 flex md:flex-col gap-2 overflow-x-auto md:overflow-y-auto scroll-smooth snap-x snap-mandatory">
            @foreach ($image_urls as $image)
            <div class="thumbnail-wrapper bg-white flex-shrink-0 border-transparent hover:border cursor-pointer overflow-hidden transition-all duration-300 snap-center" 
                style="min-width: 80px; min-height: 120px; max-width: 80px; max-height: 120px;">
                <img src="{{ $image['thumb'] }}" 
                    alt="{{ $image['alt'] }}"
                    class="w-full h-full object-cover"
                    data-full-img="{{ $image['full'] }}">
            </div>
            @endforeach
        </div>

        <!-- Główne zdjęcie -->
        <div class="main-image w-full md:w-4/5 flex justify-center relative">
            @if (!empty($attachment_ids))
                <div class="w-full aspect-w-2 aspect-h-3 bg-grey-5 relative">
                    <img src="{{ $image_urls[0]['full'] }}" alt="{{ $product->get_name() }}"
                        class="w-full h-full object-cover" id="main-product-image">
                    @if ($product->is_on_sale())
                        @include('woocommerce.single-product.sale-flash')
                    @endif
                </div>
            @endif
        </div>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail-wrapper img');
        let currentThumbnail = null;

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainImage.src = this.getAttribute('data-full-img');
                mainImage.alt = this.getAttribute('alt');

                if (currentThumbnail) {
                    currentThumbnail.classList.remove('border-black');
                }
                this.parentElement.classList.add('border-black');
                currentThumbnail = this.parentElement;
            });
        });
    });
</script>
