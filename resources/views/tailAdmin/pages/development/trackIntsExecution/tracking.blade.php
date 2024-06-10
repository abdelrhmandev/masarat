@extends('tailAdmin.layout')

@section('title')
{{ trans('title.interventions') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">{{ trans('trackIntsExecution.ints.title') }}</h1>
@endsection

@section('content')
<div class="px-16 py-32 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all border border-gray-200 pb-32">
    <form method="GET" action="{{ url('admin/development/tracking') }}">
        <div class="max-w-7xl mx-auto px-8 lg:px-8 sm:px-6">
            <label for="id-value" class="text-sm md:text-xl font-medium text-gray-700 hidden md:block">{{ trans('home.id') }}</label>
            <input type="text" oninvalid="this.setCustomValidity('رقم الهوية غير صحيح')" oninput="this.setCustomValidity('')" pattern="[12][0-9]{9}" maxlength="10" value="{{ Request::get('id') ?? '' }}" name="id" placeholder="مثال : 1*********" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-80 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 lg:flex mb-14 gap-4">
            <div class="rounded-md shadow my-2 md:my-0">
                <button type="submit" class="grid items-center justify-center px-16 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 sm:mt-4 lg:mt-0 w-full">{{ trans('home.traking') }}</button>
            </div>
        </div>
    </form>
</div>
@endsection
