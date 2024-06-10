<div class="flex flex-grow justify-between items-center py-[9rem]">

</div>

<div class="flex items-center gap-4">
  <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="rounded-lg text-sm text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    <span class="fas fa-user fa-lg fa-fw mx-2 text-gray-700"></span>
  </button>
  <!-- Dropdown menu -->
  <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700">
    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
      {{-- <li>{{ auth()->user()->email }}</li> --}}
      <li>
        <a title="{{ trans('navigation.change-password') }}" href="{{ url('admin/auth/changePassword') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          <span class="fas fa-solid fa-key fa-fw mx-2"></span>
          {{ trans('navigation.change-password') }}</a>
      </li>
      <li>
        <a title="{{ trans('navigation.logout') }}" href="{{ url('admin/auth/logout') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
          <span class="fas fa-sign-out-alt fa-fw mx-2"></span>
          {{ trans('navigation.logout') }}</a>
      </li>

    </ul>
  </div>
</div>