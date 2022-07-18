@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{__($field->getTitle())}}</span>
    <select name="{{$field->getName()}}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
        <option value="">{{__('Choose')}} {{__($field->getTitle())}}</option>
        @foreach($field->getOptions() as $value => $option)
        <option  {{old($field->getName(),isset($edit) ?  $edit->getOriginal($field->getName()) : '') == $value ? "selected":""}} value="{{$value}}">{{$option}}</option>
        @endforeach
    </select>
    @error($field->getName())
    <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
@endif
