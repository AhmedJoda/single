<a
        class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
        href="{{url()->current()}}?filter_{{$filter->getName()}}=1"
        @if($filter->called())
            style="border: solid #399339 1px;"
        @endif
>
    <div
            class="p-3 mr-4 ml-4  rounded-full "
            style="background-color: {{$filter->getIconBgColor()}}"
    >
        <i style="color: white" class="{{$filter->getIconClass()}}"></i>
    </div>
    <div>
        <p
                class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
        >
            {{$filter->getTitle()}}
        </p>
        @if($filter->isCounter())
            <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
            >
                {{$filter->count()}}
            </p>
        @endif
    </div>
</a>
