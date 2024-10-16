<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php(do_action('get_header'))
    @php(wp_head())
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-M6XXBVT8');
    </script>
    <!-- End Google Tag Manager -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
</head>

<body @php(body_class())>
    @php(wp_body_open())
    <div id="app" class="flex flex-col min-h-screen">
        <a class="sr-only focus:not-sr-only" href="#main">
            {{ __('Skip to content', 'sage') }}
        </a>
        @include('sections.header')
        <div class="custom-filter-container">




            @hasSection('sidebar')
                <aside class="sidebar container mx-auto">
                    @yield('sidebar')

                </aside>
            @endif

            <div class="flex-grow">
                <div class="mx-auto">
                    <div class="flex flex-col md:flex-row">
                        <main id="main" class="main w-full "">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
            @include('sections.footer')
        </div>
        @php(do_action('get_footer'))
        @php(wp_footer())
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M6XXBVT8" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
</body>

</html>
