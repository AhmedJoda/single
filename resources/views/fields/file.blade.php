@if($field->getHiddenValue())
    <input type="hidden" name="{{$field->getName()}}" value="{{$field->getHiddenValue()}}">
@else
<label class="block text-sm p-2 ">
    <span class="text-gray-700">{{__($field->getTitle())}}</span>
    <input 
    type="file" 
    name="{{$field->getName()}}{{$field->isMultiple() ? '[]' : ''}}"
    class="block p-1.5 w-full mt-1 text-sm  focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
    placeholder="{{__($field->getTitle())}}"
    {{$field->isMultiple() ? 'multiple' : ''}}>
    @isset($edit)
    
    @if($edit->getOriginal($field->getName()))
    @foreach($edit->getOriginal($field->getName()) as $file)
    <div class="flex items-center justify-between mt-4">
        <a href="{{ $file->getUrl() }}" target="_blank" class="flex items-center hover:text-purple-600">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v4.586l-2.293-2.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 9.586V5a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                <path fill-rule="evenodd" d="M10 17a1 1 0 001-1V9.414l2.293 2.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 8.586V16a1 1 0 001 1z" clip-rule="evenodd"></path>
            </svg>
            <span>{{$file->name}}</span>
        </a>
    </div>
    @endforeach
    @endif
    @endisset
    @error($field->getName())
        <p class="text-red-600 m-1">{{$message}}</p>
    @enderror
</label>
@endif
