@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{$field->getTitle()}}</span>
    <textarea id="field-{{$field->getName()}}" name="{{$field->getName()}}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="{{$field->getTitle()}}">@isset($edit){!!old($field->getName(),$edit->getOriginal($field->getName()))!!}@else{!! old($field->getName()) !!}@endisset</textarea>
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
