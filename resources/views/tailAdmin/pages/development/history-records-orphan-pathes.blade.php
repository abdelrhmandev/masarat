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
        <div>
            <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 md:px-2">
                @forelse ($pathes as $path)
                <div class="relative max-w-md px-10 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                    <div class="absolute left-4 top-[1rem]">
                        <img class="bg-cover" width="85rem" height="20rem" src="{{ url($path->image ?? '')}}" alt="{{ url($path->title ?? '')}}" />
                    </div>
                    <p class="my-4 text-md font-semibold">{{ $path->title }}</p>

                    <div class="border-t-2"></div>
                    <div class="flex justify-between py-0">
                        <div class="my-2">
                            <div class="flex mt-2 space-x-2">
                                <a href="{{ route('admin.orphan_history_orphan_details',[$stage_id,$form_id,$path->id])}}" class="px-2 py-1 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                    {{ trans('orphan.objectives') }}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @empty
                No patthes

                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection