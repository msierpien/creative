@php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
    // do_action('woocommerce_before_single_product_summary'); 

    global $product;

    $attachment_ids = $product->get_gallery_image_ids();
    $featured_image_id = $product->get_image_id();
    array_unshift($attachment_ids, $featured_image_id);
@endphp

<div class="product-gallery flex flex-col md:flex-row gap-4">
  <div class="thumbnails w-full md:w-1/5 flex flex-row md:flex-col gap-2 overflow-x-auto md:overflow-y-auto">
      @foreach ($attachment_ids as $attachment_id)
      <div class="thumbnail-wrapper bg-white aspect-w-2 aspect-h-3 flex-shrink-0 border-transparent hover:border cursor-pointer overflow-hidden transition-all duration-300">
          <img src="{{ wp_get_attachment_image_url($attachment_id, 'custom-thumbnail-2x3') }}"
              alt="{{ get_post_meta($attachment_id, '_wp_attachment_image_alt', true) }}"
              class="w-full h-full object-cover"
              data-full-img="{{ wp_get_attachment_image_url($attachment_id, 'full') }}">
      </div>
      @endforeach
  </div>
  <div class="main-image w-full md:w-4/5 flex justify-center relative">
      @if (!empty($attachment_ids))
          <div class="w-full aspect-w-2 aspect-h-3 bg-grey-5 relative">
              <img src="{{ wp_get_attachment_image_url($attachment_ids[0], 'full') }}" alt="{{ $product->get_name() }}"
                  class="w-full h-full object-cover" id="main-product-image">
              @if ($product->is_on_sale())
                  @include('woocommerce.single-product.sale-flash')
              @endif
          
          </div>
      @endif
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('main-product-image');
        const thumbnails = document.querySelectorAll('.thumbnail-wrapper img');

        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                mainImage.src = this.getAttribute('data-full-img');
                document.querySelectorAll('.thumbnail-wrapper').forEach(el => el.classList.remove('border'));
                this.parentElement.classList.add('border');
            });
        });
    });
</script>
