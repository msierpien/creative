{{-- 
    Content wrappers

    This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-end.blade.php.

    HOWEVER, on occasion WooCommerce will need to update template files and you
    (the theme developer) will need to copy the new files to your theme to
    maintain compatibility. We try to do this as little as possible, but it does
    happen. When this occurs the version of the template file will be bumped and
    the readme will list any important changes.

    @see https://woocommerce.com/document/template-structure/
--}}

@php
    if (! defined('ABSPATH')) {
        exit; // Exit if accessed directly
    }

    $template = wc_get_theme_slug_for_templates();
@endphp

@switch($template)
    @case('twentyten')
        </div></div>
        @break

    @case('twentyeleven')
        </div>
        @php get_sidebar('shop') @endphp
        </div>
        @break

    @case('twentytwelve')
        </div></div>
        @break

    @case('twentythirteen')
        </div></div>
        @break

    @case('twentyfourteen')
        </div></div></div>
        @php get_sidebar('content') @endphp
        @break

    @case('twentyfifteen')
        </div></div>
        @break

    @case('twentysixteen')
        </main></div>
        @break

    @default
        </div>
        @break
@endswitch
