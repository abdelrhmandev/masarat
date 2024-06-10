@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="grid grid-cols-2 gap-4 mt-8 mb-4">
    <div>
        <h1 class="mb-4 text-2xl font-extrabold tracking-tight leading-none text-gray-900 md:text-1xl lg:text-1xl dark:text-white">{{ $path_title }} <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">{{ $stage->title }}</mark></h1>
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<div class="flex flex-col mt-0">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">{{ trans('orphan.data')}}</h1>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-indigo-100 dark:bg-indigo-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                                {{ trans('orphan.orphan') }}
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg">
                                {{ trans('development_transferCase.second.id') }}
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg">
                                {{ trans('admin.mobile') }}
                            </th>
                            <th scope="col" class="py-3 px-6">
                                {{ trans('admin.age') }}
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg">
                                {{ trans('orphan.parent') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($orphan_info as $v)
                        <tr class="bg-white dark:bg-indigo-800">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $v->getOrphanExtra[0]->key == 'name' ? $v->getOrphanExtra[0]->value : ''}}
                            </th>
                            <td class="py-4 px-6">
                                {{ $v->getOrphanExtra[1]->key == 'id_number' ? $v->getOrphanExtra[1]->value : ''}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $v->getOrphanExtra[2]->key == 'mobile' ? $v->getOrphanExtra[2]->value : ''}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $v->getOrphanExtra[3]->key == 'dob' ? $v->getOrphanExtra[3]->value : ''}}
                            </td>
                            <td class="py-4 px-6">
                                {{ $v->getOrphanPen->name }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">{{ trans('orphan.path_category') }}</h1>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-indigo-100 dark:bg-indigo-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                                {{ trans('orphan.path_category') }}
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg">
                                {{ trans('admin.created_at') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($orphan->getOrphanPathCategory->path_category))
                        <tr class="bg-white dark:bg-indigo-800">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                @if($orphan->getOrphanPathCategory->path_category == 'general')
                                {{ trans('orphan.path_general') }}
                                @elseif($orphan->getOrphanPathCategory->path_category == 'advanced')
                                {{ trans('orphan.path_advanced') }}
                                @endif

                            </th>
                            <td class="py-4 px-6">

                                {{ \Carbon\Carbon::parse($orphan->getOrphanPathCategory->created_at)->format('Y/m/d').' | '.$orphan->getOrphanPathCategory->created_at->diffForHumans(); }}

                            </td>
                        </tr>
                        @else
                        <tr class="bg-white dark:bg-indigo-800 items-center text-center">
                            <td colspan="2" class="px-6 py-4 whitespace-nowrap items-center text-center">
                                <div class="flex-shrink-0 w-full text-right">
                                    <div class="text-sm font-bold underline text-[#F50057]">
                                        {{ trans('messages.no-data') }}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                </table>
            </div>
        </div>

        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">{{ trans('orphan.age_equivalent_degree') }}</h1>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-indigo-100 dark:bg-indigo-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 rounded-l-lg">
                                {{ trans('orphan.age_equivalent_degree') }}
                            </th>
                            <th scope="col" class="py-3 px-6 rounded-r-lg">
                                {{ trans('admin.created_at') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($orphan->getOrphanAgeEquivalentDegree->value))
                        <tr class="bg-white dark:bg-indigo-800">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $orphan->getOrphanAgeEquivalentDegree->value }}
                            </th>
                            <td class="py-4 px-6">

                                {{ \Carbon\Carbon::parse($orphan->getOrphanAgeEquivalentDegree->created_at)->format('Y/m/d').' | '.$orphan->getOrphanAgeEquivalentDegree->created_at->diffForHumans(); }}

                            </td>
                        </tr>
                        @else
                        <tr class="bg-white dark:bg-indigo-800 items-center text-center">
                            <td colspan="2" class="px-6 py-4 whitespace-nowrap items-center text-center">
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

        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-2xl dark:text-white">{{ trans('orphan.answered_objectives') }}</h1>
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
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
                        @forelse ($orphan_answers as $answer)
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
@endsection

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@endsection