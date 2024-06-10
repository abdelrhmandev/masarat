@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('header_title')
<h1 class="mb-4 ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">{{ $header_title }}</h1>
@endsection

@section('content')
<div class="mb-20">
    <div class="min-h-screen px-8 py-8 overflow-hidden align-bottom transition-all transform border border-gray-200 rounded-md shadow-xl bg-gray-50">
        <!-- START Housing Program-->
        @foreach ($all_intervention_details as $one_intervention_details)
        <div>
            <div class="flex justify-center">
                <button type="submit" class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ $one_intervention_details->name_ar ?? '' }}</button>
            </div>
            <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 md:px-2">
                <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                    <div class="absolute left-4 top-[1rem]">
                        {{-- <img class="bg-cover" width="85rem" height="50rem"
                            src="{{ url($one_intervention_details->image ?? '') }}"
                        alt="{{ url($one_intervention_details->image ?? '') }}" /> --}}
                    </div>
                    {{-- <p class="my-4 text-xl font-semibold">xx</p> --}}

                    <div class="border-t-2"></div>
                    <div class="flex justify-between py-0">
                        <div class="my-2">
                            <div class="flex mt-2 space-x-2">
                                <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $one_intervention_details->id) }}" class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                    {{ trans('development_interventions.details') }}
                                </a>
                            </div>
                        </div>
                        <div class="my-2">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection