{{-- 
  Template Name: HomePage
  Template Post Type: page
--}}@php

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
        <x-subcategories category-id="16" />
        @include('components.module.main', ['main' => 'main'])
    @else
        <p>Brak podkategorii.</p>
    @endif
@endsection
