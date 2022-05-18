<li class="relative">
    <button
        class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
        @click="toggleProfileMenu"
        @keydown.escape="closeProfileMenu"
        aria-label="Account"
        aria-haspopup="true"
    >
        <img
            class="object-cover w-8 h-8 rounded-full"
            src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
            alt=""
            aria-hidden="true"
        />
    </button>
    <template x-if="isProfileMenuOpen">
        <ul
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click.away="closeProfileMenu"
            @keydown.escape="closeProfileMenu"
            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
            aria-label="submenu"
        >
            </li>
            @foreach($items as $item)
            <li class="flex">

                <a
                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                    href="{{route($item['route'])}}"
                >

                    <span>
                        {{__($item['title'])}}
                    </span>
                    <span class="px-3">
                        <i class="{{$item['icon-class']}}"></i>
                    </span>
                </a>
            </li>
            @endforeach
        </ul>
    </template>
</li>
