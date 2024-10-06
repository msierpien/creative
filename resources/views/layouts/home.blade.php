@php

    /**
     * Template Name: Home page
     *

*/

    if (!function_exists('WC')) {
        return;
    }

    $subcategories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => false,
        'parent' => 16,
    ]);
@endphp

@extends('layouts.app')

@section('content')


    @if (!have_posts())
        <x-alert type="warning">
            {!! __('Sorry, no results were found.', 'sage') !!}
        </x-alert>
    @endif
    @if (!empty($subcategories) && !is_wp_error($subcategories))
        <div class="bg-grey-5 ">
            <div class="container mx-auto">
                <ul class="flex justify-around flex-wrap">
                    @foreach ($subcategories as $subcategory)
                        @php
                            $subcategory_link = get_term_link($subcategory, 'product_cat');
                            $thumbnail_id = get_term_meta($subcategory->term_id, 'thumbnail_id', true);
                        @endphp

                        <li class="p-5">

                            @if ($thumbnail_id)
                                <a href="{{ esc_url($subcategory_link) }}" class="">
                                    <div class="flex flex-col justify-center items-center">
                                        <div class="subcategory-image mt-2">
                                            {!! wp_get_attachment_image($thumbnail_id, 'thumbnail', false, [
                                                'class' => 'rounded-full w-20 h-20 object-cover ',
                                            ]) !!}
                                        </div>

                                        {{ esc_html($subcategory->name) }}
                                    </div>

                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>

            </div>

        </div>


     
        @include('components.module.main', ['main' => 'main'])


    @else
        <p>Brak podkategorii.</p>
    @endif




@endsection

{{-- 
  @section('sidebar')
    @include('sections.sidebar')
  @endsection 
   --}}
