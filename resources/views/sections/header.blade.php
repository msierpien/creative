<header class="banner">
    <div class="bg-white ">
        <div class="container mx-auto flex justify-between p-2">

            <a class="brand" href="{{ home_url('/') }}">
                {{-- {!! $siteName !!} --}}asd
            </a>
    
      
            <div class=" ">
              @if (function_exists('the_custom_logo'))
              {!! the_custom_logo() !!}
          @endif
            </div>
            <div>
              faq
            </div>
        </div>

    </div>
    <div class="bg-grey-5">
        @if (has_nav_menu('primary_navigation'))
            <div class="flex justify-between container mx-auto">

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
