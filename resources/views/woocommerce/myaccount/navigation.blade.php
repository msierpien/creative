@php

do_action( 'woocommerce_before_account_navigation' );
@endphp

<nav class="w-full md:w-1/4" aria-label="{{ __('Account pages', 'woocommerce') }}">
	<ul class="bg-grey-5 p-4">
			@foreach (wc_get_account_menu_items() as $endpoint => $label)
					<li class="{{ wc_get_account_menu_item_classes($endpoint) }}">
							<a href="{{ esc_url(wc_get_account_endpoint_url($endpoint)) }}" 
								 @if (wc_is_current_account_menu_item($endpoint)) aria-current="page" @endif>
									{{ esc_html($label) }}
							</a>
					</li>
			@endforeach
	</ul>
</nav>

@php
	do_action('woocommerce_after_account_navigation');
@endphp
