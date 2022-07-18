
<div class="group inline-block relative">
  <button class="bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded inline-flex items-center">
    @if(app()->getLocale() == 'ar')
    <p class="text-gray-700">العربية</p>
    @elseif(app()->getLocale() == 'en')
    <p class="text-gray-700">English</p>
    @endif
  </button>
  <ul class="absolute hidden text-gray-700 pt-1 group-hover:block">
    @if(app()->getLocale() == 'en')
    <li class="inline-block">
      <a href="{{url('locale/ar')}}"
      class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">
        العربية
      </a>
    </li>
    @elseif(app()->getLocale() == 'ar')
    <li class="inline-block">
      <a href="{{url('locale/en')}}"
      class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap">

        English
      </a>
    </li>
    @endif

  </ul>
</div>