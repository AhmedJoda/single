@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2">
    <b class="text-gray-700 dark:text-gray-400">{{$field->getTitle()}}</b>
    <div class="grid md:grid-cols-2">
        @foreach($field->getItems() as $key => $title)
            <div class="">
                <input type="hidden" name="{{$field->getName()}}[{{$key}}]" value="{{$field->getUncheckValue()}}">
                <input id="field-{{$field->getName()}}-{{$key}}" name="{{$field->getName()}}[{{$key}}]" type="checkbox"
                       value="{{$field->getCheckedValue()}}"
                       @isset($edit)
                           @php($attr = $edit->getOriginal($field->getName()))
                           @isset($attr->$key)
                           @if(old($field->getName().'['.$key.']',$attr->$key ?? '') == $field->getCheckedValue())
                            checked
                           @endif
                           @endisset
                       @else
                           @if(old($field->getName().'['.$key.']') == $field->getCheckedValue())
                            checked
                           @endif
                       @endisset
                       class="form-checkbox" placeholder="{{$field->getTitle()}}">
                <label for="field-{{$field->getName()}}-{{$key}}"
                       class="text-gray-700 dark:text-gray-400">{{$title}}</label>
            </div>
        @endforeach
    </div>
    @error($field->getName())
    <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
@endif
