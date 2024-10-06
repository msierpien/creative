<div class="bg-green py-10 px-4 md:px-0 ">
    <div class="container mx-auto m-5 ">
        @include('components.section-header', [
            'title' => $sectionTitle,
            'description' => $sectionDescription,
        ])

        @component('components.scrollable-list')
            <ul class="flex overflow-x-auto whitespace-nowrap scroller ">
                @foreach ($items as $item)
                    <li class="flex flex-col gap-5 min-w-[250px] m-3 ">
                        @if (isset($item['svg_code']))
                            {!! $item['svg_code'] !!}
                        @endif
                        <h3 class="font-bold">{{ $item['title'] }}</h3>
                        <p class="font-thin text-wrap">{{ $item['description'] }}</p>

                        @if ($item['icon'])
                            <img src="{{ $item['icon'] }}" alt="{{ $item['title'] }}">
                        @endif
                    </li>
                @endforeach
            </ul>
        @endcomponent


    </div>
</div>
