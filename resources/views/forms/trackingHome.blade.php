@extends('layouts.front')
@section('head')
<link rel="stylesheet" type="text/css" href="{{ url('tailwindcss/track-interventions-style.css') }}">
@endsection

@section('template_title')
{{ trans('title.dashboard') }}
@endsection

@section('content')
<div class="grid grid-flow-row px-4 md:px-2 mt-4 mb-6 gap-2">
    @if (!empty($cases))
        <div class="grid grid-flow-row">
            <div class="flex flex-wrap justify-center">
                <button class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('development_interventions.family-level') }}</button>
            </div>
            <div class="flex flex-wrap justify-center px-4 md:px-2 mt-4 mb-6 gap-2">
                @foreach ($cases as $case)
                    @if($case->int_id <= 6 || $case->int_id == 10)
                        <form method="GET" action="{{ url('oneTrack') }}">
                            <input type="hidden" name="customer" value="{{ $_COOKIE['XSRF-TOKEN'] ?? '' }}" />
                            <input type="hidden" name="personal_id" value="{{ $personal_id }}" />
                            <input type="hidden" name="confirmation_code" value="{{ $confirmation_code }}" />
                            <input type="hidden" name="form_id" value="{{ $case->id }}" />

                            <div class="relative max-w-sm bg-white px-6 mb-3 rounded-md w-80 hover:shadow-xl transition transform hover:scale-105 shadow-md duration-500 border border-gray-200">
                                <div class="absolute left-4 top-[1rem]">
                                    <img class="bg-cover" width="85rem" height="20rem" src="{{ url($case->image ?? '') }}" alt="{{ url($case->image ?? '') }}" />
                                </div>
                                <p class="text-xl font-semibold mt-5">{{ $case->name_ar }}</p>
                                <div class="flex mb-2 text-sm text-gray-400">
                                    <span class="mt-2"></span>
                                    <p></p>
                                    <p></p>
                                    <p></p>
                                </div>
                                <div class="border-t-2"></div>
                                <div class="flex justify-center py-0">
                                    <div class="my-3">
                                        <div class="flex space-x-2 mt-1">
                                            <button type="submit" class="py-2 px-4 text-white bg-indigo-600 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                                {{ trans('development_interventions.details') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="grid grid-flow-row">
            <div class="flex flex-wrap justify-center">
                <button class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('development_interventions.individual-level') }}</button>
            </div>
            <div class="flex flex-wrap justify-center px-4 md:px-2 mt-4 mb-6 gap-2">
                @foreach ($cases as $case)
                    @if($case->int_id >= 7 && $case->int_id != 10)
                        <form method="GET" action="{{ url('oneTrack') }}">
                            <input type="hidden" name="customer" value="{{ $_COOKIE['XSRF-TOKEN'] ?? '' }}" />
                            <input type="hidden" name="personal_id" value="{{ $personal_id }}" />
                            <input type="hidden" name="confirmation_code" value="{{ $confirmation_code }}" />
                            <input type="hidden" name="form_id" value="{{ $case->id }}" />

                            <div class="relative max-w-sm bg-white px-6 mb-3 rounded-md w-80 hover:shadow-xl transition transform hover:scale-105 shadow-md duration-500 border border-gray-200">
                                <div class="absolute left-4 top-[3.5rem]">
                                    <img class="bg-cover" width="85rem" height="20rem" src="{{ url($case->image ?? '') }}" alt="{{ url($case->image ?? '') }}" />
                                </div>
                                <p class="text-xl font-semibold my-4">{{ $case->name_ar }}</p>
                                <div class="flex mb-2 text-sm text-gray-400">
                                    <span class="mt-8"></span>
                                    <p></p>
                                    <p></p>
                                    @if($case->int_id >= 7 && $case->int_id != 10)
                                    <p>{{ '-' }}</p>
                                    @endif
                                </div>
                                <div class="border-t-2"></div>
                                <div class="flex justify-center py-0">
                                    <div class="my-3">
                                        <div class="flex space-x-2 mt-1">
                                        <button type="submit" class="py-2 px-4 text-white bg-indigo-600 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300">{{ trans('development_interventions.details') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
