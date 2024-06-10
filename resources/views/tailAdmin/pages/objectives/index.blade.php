@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="grid grid-cols-2 gap-4 mt-8 mb-4">
    <div>
        <h1 class="ml-8 text-2xl font-semibold text-amber-400 offset-8 decoration-indigo-600">
            {{ $path_title }}
        </h1>
        <h1 class="ml-8 text-2xl font-semibold text-indigo-400 decoration-indigo-600">
            {{ $header_title }}
            <div class="inline-flex relative -top-2 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-emerald-600 rounded-full border-2 border-white dark:border-gray-900">{{ $objectives->count();}}</div>
        </h1>
    </div>

    <div class="text-sm text-left">
        <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="px-2 py-2 ml-0 mr-0 text-sm text-blue-700 bg-white border border-2 border-blue-700 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
        <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
        <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<div class="flex justify-between items mb-4">
    <button type="button" class="orphan-add-objective-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-indigo-600 hover:bg-indigo-700">{{ trans('orphan.add_objective')}}</button>
</div>

<div class="flex flex-col mt-0">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table id="casesList" class="min-w-full divide-y divide-gray-200 text-right bg-gray-50">
                    <thead class="font-bold text-sm">
                        <tr>
                            <th scope="col" onclick="sortTable(1)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.objectives') }}<span class="fas fa-sort ml-1"></span>
                            </th>

                            <th scope="col" onclick="sortTable(5)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('admin.status') }}<span class="fas fa-sort ml-1"></span>
                            </th>

                            <th scope="col" onclick="sortTable(2)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('development_interventions.created_at') }}<span class="fas fa-sort ml-1"></span>
                            </th>

                            <th scope="col" onclick="sortTable(3)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.last_update') }}<span class="fas fa-sort ml-1"></span>
                            </th>

                            <th scope="col" onclick="sortTable(4)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('admin.action') }}<span class="fas fa-sort ml-1"></span>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 items-right text-right">

                        @forelse($objectives as $objective)

                        <tr class="hover:bg-gray-100 items-right text-right @if($objective->active == 1) bg-emerald-100 @else bg-red-100 @endif">
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">

                                    {{ $objective->title }}

                                    @if($objective->form_id && $objective->getOrphanRelatedObjectvies)
                                    @if($objective->getOrphanExtra->key == 'name')
                                    <span class="px-2 inline-flex text-sm leading-5 text-blue-900">[{{ trans('orphan.specific_objective') }} {{ $objective->getOrphanExtra->value }}]</span>
                                    @endif

                                    @endif
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    @if($objective->active == 1)
                                    {{ trans('admin.activeted') }}
                                    @elseif($objective->active == 0)
                                    {{ trans('admin.deactiveted') }}
                                    @endif
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    {{ \Carbon\Carbon::parse($objective->created_at)->format('Y/m/d').' | '.$objective->created_at->diffForHumans(); }}
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">

                                    @if($objective->updated_at)
                                    {{ \Carbon\Carbon::parse($objective->updated_at)->format('Y/m/d').' | '.$objective->updated_at->diffForHumans(); }}
                                    @else
                                    --
                                    @endif
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">

                                <button type="button" data-objective-id="{{ $objective->id }}" class="edit-objective-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-lime-500 hover:bg-lime-500">{{ trans('admin.edit')}}</button>

                                <button type="button" data-objective-title="{{ $objective->title }}" data-objective-id="{{ $objective->id }}" class="delete-objective-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-red-500 hover:bg-red-500">{{ trans('admin.delete')}}</button>
                            </td>
                        </tr>
                        @empty

                        <tr class="hover:bg-gray-100 items-center text-center">
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap items-center text-center">
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

                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    @if (!empty($cases))
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                {{ trans('development_transferCase.second.show') }}
                                <span class="font-medium">{{ $cases->perPage() * $cases->currentPage() - $cases->perPage() + 1 }}</span>
                                {{ trans('development_transferCase.second.to') }}
                                <span class="font-medium">{{ $cases->perPage() * $cases->currentPage() }}</span>
                                {{ trans('development_transferCase.second.of') }}
                                <span class="font-medium">{{ $cases->total() }}</span>
                                {{ trans('development_transferCase.second.result') }}
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm" aria-label="Pagination">
                                <div class="flex justify-between">
                                    <a href="{{ $cases->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $cases->currentPage() - 1 }}" class="{{ $cases->perPage() * $cases->currentPage() - $cases->perPage() + 1 === 1? 'pointer-events-none bg-gray-300': '' }} relative inline-flex items-center px-3 py-1 ml-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                        {{ trans('development_transferCase.second.previous') }}
                                    </a>
                                    <a href="{{ $cases->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $cases->currentPage() + 1 }}" class="{{ $cases->perPage() * $cases->currentPage() >= $cases->total() ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-4 py-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                        {{ trans('development_transferCase.second.next') }}
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('modals.orphan-objective-add-modal')
@include('modals.orphan-objective-edit-modal')
@include('modals.orphan-objective-delete-modal')

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@include('tailAdmin.scripts.orphan-actions')
@endsection