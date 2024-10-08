{{-- 
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */ --}}
@php
		defined( 'ABSPATH' ) || exit;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

@endphp
<form class="woocommerce-ordering p-0 m-0" method="get">
	<select name="orderby" class="orderby  btn e" aria-label="{{ __('Shop order', 'woocommerce') }}">
			@foreach ($catalog_orderby_options as $id => $name)
					<option value="{{ $id }}" {{ $orderby == $id ? 'selected' : '' }}>
							{{ $name }}
					</option>
			@endforeach
	</select>
	
	<input type="hidden" name="paged" value="1" />
	
	{{-- Generowanie pól formularza z query stringiem --}}
	{!! wc_query_string_form_fields(null, ['orderby', 'submit', 'paged', 'product-page']) !!}
</form>