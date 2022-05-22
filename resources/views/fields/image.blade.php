<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{$field->getTitle()}}</span>
    <input type="file" name="{{$field->getName()}}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="{{$field->getTitle()}}">
    @isset($edit)
    <img width="200"  src="{{Storage::disk(config('single.app.filesystem-disk'))->url($edit->getOriginal($field->getName()))}}">
    @endisset
</label>
