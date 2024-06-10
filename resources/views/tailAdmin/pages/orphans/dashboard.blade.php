@extends('tailAdmin.layout')

@section('title')
{{-- {{ $page_title }} --}}
@endsection

@section('content')
<div class="grid grid-cols-2 gap-4 mt-8 mb-4">
    <div>
        <h1 class="ml-8 text-2xl font-semibold text-amber-400 offset-8 decoration-indigo-600">
            {{-- {{ $path_title }} --}}
        </h1>
        <h1 class="ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
            {{-- {{  $header_title }} {{ $orphans->count();}} --}}
        </h1>
    </div>
    <div class="text-sm text-left">
        {{-- <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="px-2 py-2 ml-0 mr-0 text-sm text-blue-700 bg-white border border-2 border-blue-700 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
        <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
        <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a> --}}
    </div>
</div>

Dashboard comming soon
@endsection