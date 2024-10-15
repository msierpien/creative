<!doctype html>
<html @php(language_attributes())>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @php(do_action('get_header'))
    @php(wp_head())
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
