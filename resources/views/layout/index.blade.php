<!DOCTYPE html>
<html  x-data="data()" lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{config('single.app.name','SingleLte')}}</title>
    <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('vendor/single/fontawesome6/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/single')}}/css/tailwind.output.css"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
    <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>

    <script
            src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
            defer
    ></script>
    <script src="{{asset('vendor/single')}}/js/init-alpine.js"></script>
    <script src="{{asset('vendor/single')}}/ckeditor/ckeditor.js"></script>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/single')}}/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
            @stack('page_head')
</head>
<body class="light" dir="{{config('single.app.dir','ltr')}}">
<div
        class="flex h-screen bg-gray-50"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
>
    <!-- Desktop sidebar -->
    {!! \Syscape\Single\Scaffold\Menu::get() !!}
    <div class="flex flex-col flex-1 w-full">
        <nav class="z-10 py-4 bg-white shadow-md ">
            <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600"
            >
                <!-- Mobile hamburger -->
                <button
                        class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                        @click="toggleSideMenu"
                        aria-label="Menu"
                >
                    <svg
                            class="w-6 h-6"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                    >
                        <path
                                fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
                <x-single::locale-switcher />
                <!-- Search input -->
                @if(\Illuminate\Support\Facades\Route::has(\Illuminate\Support\Facades\Route::current()->getPrefix().'.search'))
                <form action="{{route(\Illuminate\Support\Facades\Route::current()->getPrefix().'.search')}}">
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <div
                            class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
                        >
                            <div class="absolute inset-y-0 flex items-center pr-2">
                                <svg
                                    class="w-4 h-4"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </div>
                            <input
                                class="w-full pl-8 pr-8 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md  focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                                type="text"
                                name="query"

                                placeholder="{{__('Search')}}"
                                aria-label="Search"
                            />
                        </div>
                    </div>
                </form>
                @endif
                <ul class="flex items-center flex-shrink-0 space-x-6">
                    <!-- Theme toggler -->
                    <!-- <li class="flex mr-4 ml-4">
                        <button
                                class="rounded-md focus:outline-none focus:shadow-outline-purple"
                                @click="toggleTheme"
                                aria-label="Toggle color mode"
                        >
                            <template x-if="!dark">
                                <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                >
                                    <path
                                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                                    ></path>
                                </svg>
                            </template>
                            <template x-if="dark">
                                <svg
                                        class="w-5 h-5"
                                        aria-hidden="true"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                >
                                    <path
                                            fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </template>
                        </button>
                    </li> -->
                    {!! \Syscape\Single\Scaffold\TopBar::getUserLinks() !!}
                </ul>
            </div>
        </nav>
        <main class="h-full overflow-y-auto">
            @yield('content')
            <div  class="bottom-footer text-center py-3 bg-gray-900 text-white  ">
            <x-single::copyright />
    </div>
        </main>
    </div>
</div>

<script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
></script>
<script src="{{asset('js/main.js')}}"></script>

@stack('page-scripts')
</body>
</html>

