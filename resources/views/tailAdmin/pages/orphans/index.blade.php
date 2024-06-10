@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="grid grid-cols-2 gap-4 mt-8 mb-4">
    <div>
        <h1 class="ml-8 text-2xl font-semibold text-amber-400 offset-8 decoration-indigo-600">
            {{ $current_path_title }}
        </h1>
        <h1 class="ml-8 text-2xl font-semibold text-indigo-400 decoration-indigo-600">
            {{ $header_title }}
            <div class="inline-flex relative -top-2 -right-2 justify-center items-center w-6 h-6 text-xs font-bold text-white bg-emerald-600 rounded-full border-2 border-white dark:border-gray-900">{{ $counter }}</div>
        </h1>
    </div>
    <div class="text-sm text-left">
        <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="px-2 py-2 ml-0 mr-0 text-sm text-blue-700 bg-white border border-2 border-blue-700 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
        <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
        <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<div class="flex flex-col mt-0">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table id="casesList" class="min-w-full divide-y divide-gray-200 text-center bg-gray-50">
                    <thead class="font-bold text-sm">
                        <tr>
                            <th scope="col" onclick="sortTable(1)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.orphan') }}<span class="fas fa-sort ml-1"></span>
                            </th>
                            <th scope="col" onclick="sortTable(2)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('development_transferCase.second.id') }}
                            </th>
                            <th scope="col" onclick="sortTable(3)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('admin.mobile') }}<span class="fas fa-sort"></span>
                            </th>
                            <th scope="col" onclick="sortTable(4)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('admin.age') }}
                            </th>
                            <th scope="col" onclick="sortTable(5)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.age_equivalent_degree') }}
                            </th>
                            <th scope="col" onclick="sortTable(6)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.parent') }}<span class="fas fa-sort ml-1"></span>
                            </th>
                            <th scope="col" onclick="sortTable(7)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.path_category')}}
                            </th>
                            <th scope="col" onclick="sortTable(8)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('orphan.objectives')}}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 items-center text-center">

                        @forelse($orphans as $orphan)
                        <tr class="hover:bg-gray-100 items-center text-center">
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    {{ $orphan->getOrphanExtra[0]->key == 'name' ? $orphan->getOrphanExtra[0]->value : ''; }}
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    {{ $orphan->getOrphanExtra[1]->key == 'id_number' ? $orphan->getOrphanExtra[1]->value : ''; }}
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-md leading-5 rounded-full ">
                                    {{ $orphan->getOrphanExtra[2]->key == 'mobile' ? $orphan->getOrphanExtra[2]->value : ''; }}
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-md leading-5 rounded-full ">
                                    {{ $orphan->getOrphanExtra[3]->key == 'dob' ? $orphan->getOrphanExtra[3]->value : ''; }}
                                </span>
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500 ">
                                @if(isset($orphan->getOrphanAgeEquivalentDegree->stage_id) && $orphan->getOrphanAgeEquivalentDegree->stage_id == $current_stage_id)

                                {{ $orphan->getOrphanAgeEquivalentDegree->value }}
                                {{-- <span class="text-emerald-600">{{ trans('orphan.added_in_current_stage')}}</span> --}}

                                {{-- <button type="button" data-form-id="{{ $orphan->form_id }}" class="get-orphan-age-equivalent-degree-history-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-amber-400 hover:bg-amber-400">{{ trans('orphan.age_equivalent_degree')}}</button> --}}

                                @else
                                {{-- <button type="button" data-form-id="{{ $orphan->form_id }}" class="add-orphan-age-equivalent-degree-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-sky-500 hover:bg-sky-500">{{ trans('orphan.add_age_equivalent_degree')}}</button> --}}
                                <span class="text-red-500">{{ trans('orphan.not_added')}}</span>
                                @endif

                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500 ">
                                {{ $orphan->getOrphanPen->name ?? '-'}}
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">

                                @if(isset($orphan->getOrphanPathCategory->stage_id) && $orphan->getOrphanPathCategory->stage_id == $current_stage_id)

                                @if($orphan->getOrphanPathCategory->path_category == 'general')
                                <p class="text-blue-700">{{ trans('orphan.path_general') }}</p>
                                @elseif($orphan->getOrphanPathCategory->path_category == 'advanced')
                                <p class="text-pink-700">{{ trans('orphan.path_advanced') }}</p>
                                @endif

                                @else
                                <button type="button" data-form-id="{{ $orphan->form_id }}" class="add-orphan-path-category-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-purple-600 hover:bg-purple-700">{{ trans('orphan.path_category')}}</button>
                                @endif
                            </td>

                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                @if(isset($orphan->getOrphanPathCategory->stage_id) && $orphan->getOrphanPathCategory->stage_id == $current_stage_id)
                                <a class="text-xs px-1 py-1 border border-transparent text-base rounded-md text-white bg-indigo-600 hover:bg-indigo-700" href="{{  route('admin.orphan_details',$orphan->form_id) }}">{{ trans('orphan.details') }}</a>
                                @else
                                <span class="font-bold text-[#F50057]">
                                    {{ trans('orphan.select_path_category') }}
                                </span>
                                @endif
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

@include('modals.orphan-path-category-modal')

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@include('tailAdmin.scripts.orphan-actions')
@endsection