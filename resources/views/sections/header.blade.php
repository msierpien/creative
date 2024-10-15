<header class="banner" >
    <div class="bg-white ">
        <div class="container mx-auto flex justify-between p-2">

            <a class="brand" href="{{ home_url('/') }}">
                {!! $siteName !!}
            </a>
    
      
            <div class=" ">
              @if (function_exists('the_custom_logo'))
              {!! the_custom_logo() !!}
          @endif
            </div>
            <div>
              {{-- faq --}}
            </div>
        </div>

    </div>
    <div id="main-menu"  class="bg-grey-5">
        @if (has_nav_menu('primary_navigation'))
            <div id="main-menu"   class="flex justify-between container mx-auto">

                <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
                    {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
                </nav>
                <div>
                    {!! wp_nav_menu(['theme_location' => 'user_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}

                </div>
            </div>
        @endif
    </div>

</header>
<script>
    window.addEventListener('scroll', function() {
        var menu = document.getElementById('main-menu');
        var scrollPosition = window.pageYOffset;

        if (scrollPosition > 66) { // Gdy przewinięcie przekroczy 66px
            menu.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'z-50');
        } else {
            menu.classList.remove('fixed', 'top-0', 'left-0', 'right-0', 'z-50');
        }
    });
</script>