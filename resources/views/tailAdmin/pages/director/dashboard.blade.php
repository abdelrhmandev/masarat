@extends('tailAdmin.layout')

@section('title')
{{ trans('title.dashboard') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">{{ trans('title.dashboard') }}</h1>
@endsection

@section('content')
<div class="mt-4">
    <!-- Start Card -->
    <div class="flex flex-wrap gap-12 place-content-center mt-5">
        <div class="w-3/12">
            <a href="{{ url('admin/director/interventions') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-indigo-400 to-indigo-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-indigo-300 ring-2 ring-indigo-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data h-8 w-6 text-white" viewBox="0 0 16 16">
                                <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z" />
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('navigation.intervention-list') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $directorTransferCount }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="w-3/12">
            <a href="{{ url('admin/director/users?count=10') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-purple-400 to-purple-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-purple-300 ring-2 ring-purple-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people h-8 w-8 text-white" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('navigation.users-list') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200"> {{ $usersCount }} </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="flex flex-wrap gap-12 place-content-center mt-5">
        <div class="w-3/12">
            <a href="{{ url('admin/director/users?count=10') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-lime-400 to-lime-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-lime-300 ring-2 ring-lime-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check h-8 w-8 text-white" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">المستخدمين المفعلين</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200"> {{ $ActiveUsersCount }} </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="w-3/12">
            <a href="{{ url('admin/director/users?count=10') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-pink-400 to-pink-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-pink-300 ring-2 ring-pink-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x h-8 w-8 text-white" viewBox="0 0 16 16">
                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">المستخدمين المحجوبين</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200"> {{ $NotActiveUsersCount }} </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection