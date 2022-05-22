<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{$field->getTitle()}}</span>
    <input name="{{$field->getName()}}" @isset($edit)  value="{{old($field->getName(),$edit->getOriginal($field->getName()))}}" @else value="{{old($field->getName())}}" @endisset
           class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="{{$field->getTitle()}}">
</label>
