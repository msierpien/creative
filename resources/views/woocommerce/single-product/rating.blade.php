@php
    // Sprawdzenie, czy oceny są włączone w WooCommerce
    if (!wc_review_ratings_enabled()) {
        return;
    }

    // Pobranie danych o produkcie
    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();
@endphp

@if ($rating_count > 0)
    <div class="woocommerce-product-rating">
        {{-- Wyświetlenie oceny produktu --}}
        {!! wc_get_rating_html($average, $rating_count) !!}

        {{-- Link do recenzji, jeśli są włączone --}}
        @if (comments_open())
            <a href="#reviews" class="woocommerce-review-link" rel="nofollow">
                ({{ _n('%s customer review', '%s customer reviews', $review_count, 'woocommerce') }})
            </a>
        @endif
    </div>
@endif
