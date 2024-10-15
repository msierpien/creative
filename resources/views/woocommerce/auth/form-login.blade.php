{{-- 
    Auth form login

    This template can be overridden by copying it to your theme.
    HOWEVER, on occasion WooCommerce will need to update template files and you
    (the theme developer) will need to copy the new files to your theme to
    maintain compatibility. We try to do this as little as possible, but it does
    happen. When this occurs the version of the template file will be bumped and
    the readme will list any important changes.

    @see https://woocommerce.com/document/template-structure/
--}}

@php
    do_action('woocommerce_auth_page_header');
@endphp

<h1 class="text-xl font-bold mb-4">
    {{ sprintf(__(' %s would like to connect to your store', 'woocommerce'), esc_html($app_name)) }}
</h1>

@php
    wc_print_notices();
@endphp
<div>
    <p class="mb-4">
        {!! sprintf(__('To connect to %1$s you need to be logged in. Log in to your store below, or <a href="%2$s" class="text-blue-600 hover:underline">cancel and return to %1$s</a>', 'woocommerce'), esc_html(wc_clean($app_name)), esc_url($return_url)) !!}
    </p>
    
    <form method="post" class="wc-auth-login space-y-4">
        <p class="form-row form-row-wide">
            <label for="username" class="block mb-2 text-sm font-medium text-gray-700">{{ __('Username or email address', 'woocommerce') }}&nbsp;<span class="required" aria-hidden="true">*</span></label>
            <input type="text" class="input-text w-full p-2 border border-black rounded" name="username" id="username" value="{{ !empty($_POST['username']) ? esc_attr($_POST['username']) : '' }}" required aria-required="true" />
        </p>
        <p class="form-row form-row-wide">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-700">{{ __('Password', 'woocommerce') }}&nbsp;<span class="required" aria-hidden="true">*</span></label>
            <input class="input-text w-full p-2 border border-black rounded" type="password" name="password" id="password" required aria-required="true" />
        </p>
        <p class="wc-auth-actions">
            @php
                wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce');
            @endphp
            <button type="submit" class="button button-large wc-auth-login-button bg-black text-white py-2 px-4 rounded" name="login" value="{{ esc_attr(__('Login', 'woocommerce')) }}">
                {{ __('Login', 'woocommerce') }}
            </button>
            <input type="hidden" name="redirect" value="{{ esc_url($redirect_url) }}" />
        </p>
    </form>
    

    @php
        do_action('woocommerce_auth_page_footer');
    @endphp
</div>
