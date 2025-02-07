@extends('single::layout.index')
@section('content')
    <div class="container grid px-6 py-6 mx-auto " style="padding-top: 1.5rem">
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            {{$title}}
        </h4>
        @if($instance->creating)
            <div class="p-2">
                <a style="width: 100px" href="{{route("$route.create")}}" class="w-1/2 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>{{__('single::main.create')}}</span>
                    <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20">
                        <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        @endif
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            @foreach($instance->filters() as $filter)
                @include($filter->filter_view_name,compact('filter'))
            @endforeach
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            @include('single::tables.table',compact('table','instance'))
        </div>
    </div>
@endsection
