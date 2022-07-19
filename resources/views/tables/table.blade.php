<div>
    <div class="w-full overflow-x-auto text-gray-800  rounded-lg  p-4 py-6 shadow-lg bg-white">
        <table 
        id="single-table-{{is_string($table->getFields()[0]->getTitle()) ? $table->getFields()[0]->getTitle() : '' }}"
        data-page-length='{{$table->getPaginationLength()}}' class="w-full whitespace-no-wrap">
            <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50 ">
                @foreach($table->getFields() as $field)
                    <th class="px-4 py-3 text-center" style="text-align: center">{{__($field->getTitle())}}</th>
                @endforeach
                <th class="px-4 py-3 text-center" style="text-align: center">
                    @if(isset($instance))
                        {{__('Actions')}}
                    @endif
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y ">
            @foreach($table->getData() as $item)
                <tr class="text-gray-700 ">
                    @foreach($table->getFields() as $field)
                        <td class="px-4 py-3 text-center">
                        @if(isset($instance))
                            @if(is_array($field->getTableValue($item) ))
                                @foreach($field->getTableValue($item) as $value)
                                    <span class="text-sm">{{$value}},</span>
                                @endforeach
                            @else
                                @if(is_string($field->getTableValue($item)))
                                    {!! __($field->getTableValue($item)) !!}
                                @else
                                    {!! $field->getTableValue($item) !!}
                                @endif
                            @endif
                        @else
                            {!!  __($item[$field->getName()]) !!}
                        @endif
                        </td>
                    @endforeach
                    <td width="10%" class="px-4 py-3 justify-content-center">
                        @if(isset($instance) && $instance->deleting)
                            <form id="deleteForm{{$item->id}}" method="POST" action="{{route("$route.destroy",$item->id)}}" >
                                @csrf
                                @method('DELETE')
                            </form>
                        @endif
                        <div class="flex items-center space-x-4 text-sm">
                            @if(isset($instance) && $instance->editing)
                                <a href="{{route("$route.edit",$item->id)}}" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg  focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                            @endif
                            @if(isset($instance) && $instance->deleting)
                                <button form="deleteForm{{$item->id}}" type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('page-scripts')
    <script defer>
        $(document).ready( function () {
            
            $('#single-table').DataTable({
                columns: [
                    @foreach($table->getFields() as $field)
                        {
                            orderable: @if( $field->isSortable() ) true @else false @endif,
                            searchable: @if($field->isSearchable()) true @else false @endif
                        },
                    @endforeach
                    { orderable: false ,saerchable:false},
                ],
                language:{
                    url: "{{asset('vendor/single/js/datatables/'.App::getLocale().'.json')}}"
                } ,
                pagingType: "full_numbers"
            });
        } );
    </script>
@endpush
