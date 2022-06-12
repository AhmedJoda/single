<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{$field->getTitle()}}</span>
    <input type="checkbox" value="{{$field->getCheckedValue()}}" name="{{$field->getName()}}"
           {{old($field->getName(),$edit->getOriginal($field->getName())?? '') == $field->getCheckedValue() ? "checked" : ""}}
           class="block" placeholder="{{$field->getTitle()}}">
    @error($field->getName())
    <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
