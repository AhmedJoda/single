<li class="relative px-6 py-3">
    @isset($item['single'])
        @php
            $single = "\App\\Singles\\".$item['single'];
            $single = new $single();
            $item['route'] = $single->getIndexRoute();
            $item['title'] = $single->getIndexTitle();
            $item['icon-class'] = 'fa fa-list';
        @endphp
    @endisset
    <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{url()->current() == route($item['route']) ? "dark:text-gray-100":""}}"
        href="{{route($item['route'])}}"
    >
        @isset($item['icon-class'])
            <i class="{{$item['icon-class']}}"></i>
        @endisset
        <span class="ml-4">{{__($item['title'])}}</span>
    </a>

</li>
