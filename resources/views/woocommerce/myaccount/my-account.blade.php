{{-- 
    My Account page

    This template can be overridden by copying it to your theme.
    HOWEVER, on occasion WooCommerce will need to update template files and you
    (the theme developer) will need to copy the new files to your theme to
    maintain compatibility. We try to do this as little as possible, but it does
    happen. When this occurs the version of the template file will be bumped and
    the readme will list any important changes.

    @see https://woocommerce.com/document/template-structure/
--}}

{{-- My Account navigation --}}

<div class="container mx-auto flex flex-col-reverse md:flex-row my-10 ">
    @php
        do_action('woocommerce_account_navigation');
    @endphp
    
    <div class="w-full md:w-3/4 p-4 bg-grey-5/50">
        {{-- My Account content --}}
        @php
            do_action('woocommerce_account_content');
        @endphp
    </div>

</div>
