{{-- @php
echo '<pre>';
print_r($subcategories);
echo '</pre>';
@endphp --}}
@if (!empty($subcategories) && !is_wp_error($subcategories))
    <div class="bg-grey-10  px-4 md:px-0 ">
        <div class="container mx-auto p-5">
            @component('components.scrollable-list')
            <ul class="grid grid-flow-col overflow-x-auto whitespace-nowrap scroller">
                @foreach ($subcategories as $subcategory)
                    @php
                        $subcategory_link = get_term_link($subcategory, 'product_cat');
                        $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                    @endphp

                    <li class="p-5 max-w-[200px] ">
                        @if ($thumbnail_id)
                            <a href="{{ esc_url($subcategory_link) }}" class="">
                                <div class="flex flex-col justify-center items-center ">
                                    <div class="subcategory-image my-4 w-20 h-20">
                                        {!! wp_get_attachment_image($thumbnail_id, 'thumbnail', false, [
                                            'class' => 'rounded-full  object-cover ',
                                        ]) !!}
                                    </div>
                                    <span class="text-wrap text-center hover:underline">
                                        {{ esc_html($subcategory->name) }}

                                    </span>
                                </div>
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
            @endcomponent
        </div>
    </div>
@else
    
@endif