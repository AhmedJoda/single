@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{__($field->getTitle())}}</span>
    <input type="number" name="{{$field->getName()}}" value="{{old($field->getName(),(isset($edit) ? $edit->getOriginal($field->getName()) : ''))}}"
           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="{{__($field->getTitle())}}">
    @error($field->getName())
    <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
@endif
