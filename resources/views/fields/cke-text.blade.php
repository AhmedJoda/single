@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2 col-span-2 order-last">
    <span class="text-gray-700">{{__($field->getTitle())}}</span>
    <textarea id="field-{{$field->getName()}}" name="{{$field->getName()}}" class="block w-full mt-1 text-sm  focus:border-purple-400 focus:outline-none focus:shadow-outline-purpleform-input" placeholder="{{__($field->getTitle())}}">

        @isset($edit)
        {!!old($field->getName(),$edit->getOriginal($field->getName()))!!}
        @else
            {!! old($field->getName(),$field->getDefaultValue()) !!}
        @endisset
    </textarea>
    @error($field->getName())
    <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
@push('page-scripts')
    <script defer>
        CKEDITOR.replace( 'field-{{$field->getName()}}' );
    </script>
@endpush
@endif
