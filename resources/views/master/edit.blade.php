@extends('single::layout.index')
@section('content')
    <div class="container grid px-6 py-6 mx-auto " style="padding-top: 1.5rem">
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Edit {{__(config('single.app.route-prefix').'.'.$p_name)}}
        </h4>
        <div class="p-2">
            <a style="width: 100px" href="{{route("$route.index")}}" class="w-1/2 flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>List</span>
                <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" aria-hidden="true" viewBox="0 0 20 20">
                    <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
            <form method="POST" action="{{route("$route.update",$edit->id)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    @foreach($fields as $field)
                        @include($field->getViewName(),compact('field'))
                    @endforeach
                    <div class="p-2">
                        <button
                            type="submit"
                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        >
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
