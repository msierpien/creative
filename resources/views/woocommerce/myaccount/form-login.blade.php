@php

    do_action('woocommerce_before_customer_login_form');

@endphp

@if ('yes' === get_option('woocommerce_enable_myaccount_registration'))
    <div class="flex flex-col md:flex-row " id="customer_login">if

        <div class="md:w-1/2 p-4">
@endif
<div class=""">
    {{-- <h1 class="text-2xl font-bold mb-4">{{ __('Login', 'woocommerce') }}</h1> --}}

    <x-form-container :title="__('Login', 'woocommerce')">
        <form class="space-y-6" method="post">
            @php do_action('woocommerce_login_form_start') @endphp

            <div class="">
                <x-label for="username" text="{{ __('Username or email address', 'woocommerce') }}" style="red" />
                <x-input name="username" id="username" {{-- placeholder="Enter your username"  --}}
                    value="{{ !empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : '' }}"
                    autocomplete="username" required="true" ariaRequired="true" style="black" />
            </div>

            <div class="">
            
                <x-label for="password" text="{{ __('Password', 'woocommerce') }}" style="red" />
                        <x-input type="password" name="password" id="password" {{-- placeholder="Enter your password"  --}}
                            autocomplete="current-password" required="true" ariaRequired="true" style="black" />

            </div>

            @php do_action('woocommerce_login_form') @endphp

            <div class=" flex items-center">
               
                    <x-label for="rememberme"  style="red" >
                        <x-input type="checkbox" name="rememberme" id="rememberme" value="forever" style="checkbox" />
                        <span>{{ __('Remember me', 'woocommerce') }}</span>
                    </x-label>
               

            </div>

            @php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ) @endphp

            {{-- <button type="submit" class="bg-black text-white p-2 hover:bg-gray-50 transition" name="login" value="{{ __('Log in', 'woocommerce') }}">{{ __('Log in', 'woocommerce') }}</button> --}}
            <p class="mt-4">
                <x-button style="black" type="submit" name="login" value="{{ __('Log in', 'woocommerce') }}"
                    title="{{ __('Log in', 'woocommerce') }}" />
                <a href="{{ esc_url(wp_lostpassword_url()) }}"
                    class="">{{ __('Lost your password?', 'woocommerce') }}</a>
            </p>

            @php do_action('woocommerce_login_form_end') @endphp
        </form>
    </x-form-container>

</div>


@if ('yes' === get_option('woocommerce_enable_myaccount_registration'))
    </div>

    <div class="md:w-1/2 p-4">
        <h2 class="text-2xl font-bold mb-4">{{ __('Register', 'woocommerce') }}</h2>

        <form method="post" class="woocommerce-form woocommerce-form-register register">
            @php do_action('woocommerce_register_form_start') @endphp

            <div class="mb-4">
                <label for="reg_username" class="block mb-2">{{ __('Username', 'woocommerce') }}&nbsp;<span
                        class="required" aria-hidden="true">*</span></label>
                <input type="text" class="block w-full border border-black bg-white text-black p-2" name="username"
                    id="reg_username" autocomplete="username"
                    value="{{ !empty($_POST['username']) ? esc_attr(wp_unslash($_POST['username'])) : '' }}"
                    required aria-required="true" />
            </div>

            <div class="mb-4">
                <label for="reg_email" class="block mb-2">{{ __('Email address', 'woocommerce') }}&nbsp;<span
                        class="required" aria-hidden="true">*</span></label>
                <input type="email" class="block w-full border border-black bg-white text-black p-2" name="email"
                    id="reg_email" autocomplete="email"
                    value="{{ !empty($_POST['email']) ? esc_attr(wp_unslash($_POST['email'])) : '' }}" required
                    aria-required="true" />
            </div>

            <div class="mb-4">
                <label for="reg_password" class="block mb-2">{{ __('Password', 'woocommerce') }}&nbsp;<span
                        class="required" aria-hidden="true">*</span></label>
                <input type="password" class="block w-full border border-black bg-white text-black p-2" name="password"
                    id="reg_password" autocomplete="new-password" required aria-required="true" />
            </div>

            @php do_action('woocommerce_register_form') @endphp

            <button type="submit" class="bg-black text-white p-2 rounded hover:bg-gray-800 transition" name="register"
                value="{{ __('Register', 'woocommerce') }}">{{ __('Register', 'woocommerce') }}</button>

            @php do_action('woocommerce_register_form_end') @endphp
        </form>
    </div>
    </div>
@endif

@php do_action('woocommerce_after_customer_login_form') @endphp
