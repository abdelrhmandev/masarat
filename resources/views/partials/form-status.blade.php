@if (session('success'))
<div id="notification" class="absolute top-10 left-8 z-40">
  <div class="flex max-w-md bg-white rounded-lg shadow overflow-hidden border border-gray-300">
    <div class="flex items-center px-2 py-3">
      <img class="w-20 h-18 object-cover rounded-full" src="{{ url('img/aircraft.svg') }}" alt="success-notification" />
      <div class="w-96 mr-2">
        <h2 class="text-xl font-semibold text-indigo-600">{{ trans('messages.success.title') }}</h2>
        <p class="text-gray-600">{{ session('success') }}</p>
      </div>
    </div>
    <div class="w-2 bg-indigo-600"></div>
  </div>
</div>
@endif

@if (session('error'))
<div id="notification" class="absolute top-8 left-8 z-40">
  <div class="flex max-w-md bg-white rounded-lg shadow overflow-hidden border border-gray-300">
    <div class="flex items-center px-2 py-3">
      <img class="w-20 h-18 object-cover " src="{{ url('img/access_denied.svg') }}" alt="error-notification" />
      <div class="w-72 mr-2">
        <h2 class="text-xl font-semibold text-[#F50057]">{{ trans('messages.error.title') }}</h2>
        <p class="text-gray-600 mt-2">{{ session('error') }}</p>
      </div>
    </div>
    <div class="w-2 bg-[#F50057]"></div>
  </div>
</div>
@endif

@if (session('info'))
<div id="notification" class="absolute top-8 left-8 z-40">
  <div class="flex max-w-md bg-white rounded-lg shadow overflow-hidden border border-gray-300">
    <div class="flex items-center px-2 py-3">
      <img class="w-20 h-18 object-cover " src="{{ url('img/completed.svg') }}" alt="error-notification" />
      <div class="w-72 mr-2">
        <h2 class="text-xl font-semibold text-indigo-600">{{ trans('messages.error.info') }}</h2>
        <p class="text-gray-600 mt-2">{{ session('info') }}</p>
      </div>
    </div>
    <div class="w-2 bg-indigo-600"></div>
  </div>
</div>
@endif
