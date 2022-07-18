@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2">
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getUncheckValue()}}">
    <input id="field-{{$field->getName()}}" type="checkbox" value="{{$field->getCheckedValue()}}" name="{{$field->getName()}}"
           @isset($edit)
           {{old($field->getName(),$edit->getOriginal($field->getName())?? '') == $field->getCheckedValue() ? "checked" : ""}}
           @else
           {{old($field->getName()) == $field->getCheckedValue() ? "checked" : ""}}
           @endisset
           class="form-checkbox" placeholder="{{__($field->getTitle())}}">
    <label for="field-{{$field->getName()}}" class="text-gray-700 dark:text-gray-400">{{__($field->getTitle())}}</label>
    @error($field->getName())
    <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
@endif
