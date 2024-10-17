<!doctype html>
<html @php(language_attributes())>

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RGBW3LCH25"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-RGBW3LCH25');
    </script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php(do_action('get_header'))
    @php(wp_head())
    <!-- verify domain Pinterest -->
    <meta name="p:domain_verify" content="b851ccbfc9bcef468d524284a5e3a651" />
    
    <!-- Pinterest meta tag -->
    <script>
        ! function(e) {
            if (!window.pintrk) {
                window.pintrk = function() {
                    window.pintrk.queue.push(Array.prototype.slice.call(arguments))
                };
                var
                    n = window.pintrk;
                n.queue = [], n.version = "3.0";
                var
                    t = document.createElement("script");
                t.async = !0, t.src = e;
                var
                    r = document.getElementsByTagName("script")[0];
                r.parentNode.insertBefore(t, r)
            }
        }("https://s.pinimg.com/ct/core.js");
        pintrk('load', '2612369080635', {
            em: '<user_email_address>'
        });
        pintrk('page');
    </script>
    <!-- Pinterest Tag -->
    <noscript>
        <img height="1" width="1" style="display:none;" alt=""
            src="https://ct.pinterest.com/v3/?event=init&tid=2612369080635&pd[em]=<hashed_email_address>&noscript=1" />
    </noscript>
    <!-- end Pinterest Tag -->
    <!-- End Pinterest meta tag -->
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

</body>

</html>
