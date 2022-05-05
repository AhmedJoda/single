<label class="block text-sm p-2">
    <span class="text-gray-700 dark:text-gray-400">{{$title}}</span>
    <select name="{{$name}}" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
        <option value="">Choose {{$title}}</option>
        @foreach($options as $value => $option)
        <option  {{old($name,$edit->$name ?? '') == $value ? "selected":""}} value="{{$value}}">{{$option}}</option>
        @endforeach
    </select>
</label>
