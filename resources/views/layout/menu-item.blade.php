@isset($item['single'])
    @php
        $single = "\App\\Singles\\".$item['single'];
        $single = new $single();
        $single->bottle();// Scaffold init ;)
        $item['route'] = $single->getIndexRoute();
        $item['title'] = $single->getIndexTitle();
        if (! isset($item['icon-class']))
            $item['icon-class'] = 'fa fa-list';
        if ($single->hide_from_menu)
            $hide = true;
    @endphp
@endisset
@if(!isset($hide))
<li class="relative px-6 py-3">

    <a
        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{url()->current() == route($item['route']) ? "dark:text-gray-100":""}}"
        href="{{route($item['route'])}}"
    >
        @isset($item['icon-class'])
            <i class="{{$item['icon-class']}}"></i>
        @endisset
        <span class="ml-4 mr-4">{{__($item['title'])}}</span>
    </a>

</li>
@endif
