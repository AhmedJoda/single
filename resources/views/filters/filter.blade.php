<a class="flex items-center p-4 bg-white rounded-lg shadow-xs" href="{{url()->current()}}?filter_{{$filter->getName()}}=1" @if($filter->called())
    style="border: solid #399339 1px;"
    @endif
    >
    <div class="p-3 mr-4 ml-4 w-11 h-11 min-h-11 min-w-11 flex items-center justify-center  rounded-full " style="background-color: {{$filter->getIconBgColor()}}">
        <i style="color: white" class="{{$filter->getIconClass()}}"></i>
    </div>
    <div>
        <p class="mb-2 text-sm font-medium text-gray-600">
            {{__($filter->getTitle())}}
        </p>
        @if($filter->isCounter())
        <p class="text-lg font-semibold text-gray-700 ">
            {{$filter->count()}}
        </p>
        @endif
    </div>
</a>