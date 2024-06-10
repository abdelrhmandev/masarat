@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="grid grid-cols-2 gap-4 mt-8 mb-4">
    <div>
        {{-- <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-1xl lg:text-1xl dark:text-white">ss <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">sads</mark></h1> --}}
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<div class="flex flex-col mt-0">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">{{ trans('orphan.answered_objectives') }}</h1>
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                        <caption></caption>
                        <thead class="text-xs text-gray-700 uppercase bg-indigo-100 dark:bg-indigo-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6 rounded-l-lg">
                                    {{ trans('orphan.objective') }}
                                </th>
                                <th scope="col" class="py-3 px-6 rounded-r-lg">
                                    {{ trans('orphan.objective_status') }}
                                </th>
                                <th scope="col" class="py-3 px-6 rounded-r-lg">
                                    {{ trans('admin.notices') }}
                                </th>
                                <th scope="col" class="py-3 px-6 rounded-r-lg">
                                    {{ trans('admin.created_at') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($answers as $answer)
                            <tr class="bg-white dark:bg-indigo-800">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $answer->getObjective->title; }}
                                </th>
                                <td class="py-4 px-6">
                                    @if($answer->completed_case == 'completed')
                                    {{ trans('orphan.completed') }}
                                    @elseif($answer->completed_case == 'notcompleted')
                                    {{ trans('orphan.not_completed') }}
                                    @else
                                    {{ trans('orphan.not_added') }}
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{ $answer->notes ?? '-'}}
                                </td>
                                <td class="py-4 px-6">{{ \Carbon\Carbon::parse($answer->created_at)->format('Y/m/d').' | '.$answer->created_at->diffForHumans(); }}</td>
                            </tr>
                            @empty
                            <tr class="bg-white dark:bg-indigo-800 items-center text-center">
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap items-center text-center">
                                    <div class="flex-shrink-0 w-full text-right">
                                        <div class="text-sm font-bold underline text-[#F50057]">
                                            {{ trans('messages.no-data') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@endsection