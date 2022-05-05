<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{$title}}</span>
    <input type="number" name="{{$name}}" value="{{old($name,$edit->$name ?? '')}}" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="{{$title}}">
</label>
