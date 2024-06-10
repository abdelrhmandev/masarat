@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="grid grid-cols-2 gap-4 mt-8 mb-4">
    <div>
        <h1 class="ml-8 text-2xl font-semibold text-amber-400 offset-8 decoration-indigo-600">
            {{ $header_title  }}
        </h1>
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<div class="flex flex-col mt-0">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @if($stages->count()>0)
            <ol class="items-center sm:flex">
                @foreach ($stages as $stage)
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="flex z-10 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-blue-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pr-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $stage->title}} </h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><b>{{ trans('orphan.start_date')}}</b> {{ $stage->start_date}} - <b>{{ trans('orphan.end_date')}}</b> {{ $stage->end_date}}</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                            <a href="{{ route('admin.orphan.history.records.orphans',$stage->id)}}" class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-200 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700">{{ trans('orphan.orphans')}}</a>
                        </p>
                    </div>
                </li>
                @endforeach
            </ol>
            @else
            <div role="alert">
                <div class="bg-red-600 text-white font-bold rounded-t px-4 py-2">
                    {{ trans('admin.notice')}}
                </div>
                <div class="border border-t-0 border-red-600 rounded-b bg-red-100 px-4 py-3 text-red-600">
                    <p>{{ trans('orphan.no_available_stage')}}</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@endsection