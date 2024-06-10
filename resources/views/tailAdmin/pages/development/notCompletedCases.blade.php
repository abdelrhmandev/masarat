@extends('tailAdmin.layout')

@section('title')
{{ trans('الحالات الغير مكتملة') }}
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="mt-4 grid grid-cols-2 gap-4 mb-4">
    <div>
        <h1 class="ml-8 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">الحالات الغير مكتملة</h1>
    </div>
    <div class="text-left text-sm">
        <h1 class="inline-block ml-2">{{ trans('development_transferCase.second.row-count') }}</h1>
        <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="py-2 px-2 mr-0 ml-0 text-sm text-blue-700 font-bold bg-white rounded-lg border border-2 border-blue-700 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
        <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="py-2 px-2 mr-0 ml-0 text-sm text-gray-900 bg-white rounded-lg border border-2 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
        <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="py-2 px-2 mr-0 ml-0 text-sm text-gray-900 bg-white rounded-lg border border-2 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
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
                                {{ trans('development_transferCase.second.individual') }}<span class="fas fa-sort ml-1"></span>
                            </th>
                            <th class="py-3 text-gray-500 tracking-wider">
                                {{ trans('development_transferCase.second.id') }}
                            </th>
                            <th scope="col" onclick="sortTable(3)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                رقم الجوال<span class="fas fa-sort"></span>
                            </th>
                            <th scope="col" onclick="sortTable(5)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('development_transferCase.second.expiry-date') }}
                            </th>
                            <th scope="col" onclick="sortTable(4)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('development_transferCase.second.family-count') }}<span class="fas fa-sort"></span>
                            </th>
                            <th scope="col" onclick="sortTable(6)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('development_transferCase.second.need-degree') }}<span class="fas fa-sort"></span>
                            </th>
                            <th scope="col" onclick="sortTable(7)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                {{ trans('development_transferCase.second.able-development') }}<span class="fas fa-sort"></span>
                            </th>
                            <th class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 items-center text-center">
                        <?php if (sizeof($cases) === 0) { ?>
                            <tr class="hover:bg-gray-100 items-center text-center">
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap items-center text-center">
                                    <div class="flex-shrink-0 w-full text-right">
                                        <div class="text-sm font-bold underline text-[#F50057]">
                                            {{ trans('messages.no-data') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        @foreach ($cases as $case)
                        <tr class="hover:bg-gray-100 items-center text-center">
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <a href="javascript:showhide({{ $case->form_id }})" form-data-id="{{ $case->forms_parent_id }}">{{ $case->name }}</a>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    {{ $case->personal_id }}
                                </span>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    {{ $case->mobile }}
                                </span>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full ">
                                    {{ date('Y/m/d', strtotime($case->updated_at)) }}
                                </span>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-md leading-5 rounded-full ">
                                    {{ $case->family_count }}
                                </span>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-md leading-5 rounded-full ">
                                    {{ round($case->need, 2) }}%
                                </span>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <span class="px-2 inline-flex text-md leading-5 rounded-full ">
                                    {{ round($case->development, 2) }}%
                                </span>
                            </td>
                            <td class="px-2 py-4 whitespace-nowrap text-sm font-semibold text-gray-500">
                                <button type="button" personal-id-data="{{ $case->personal_id }}" class="show-reactive-modal text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-indigo-600 hover:bg-indigo-700">تمديد الرابط</button>
                            </td>
                        </tr>
                        <tr class="min-w-full divide-y divide-gray-200 items-center bg-gray-50 hidden" id="notcompletedints{{ $case->form_id }}">
                            <td class="px-6 py-4 text-sm text-red-600 font-bold">{{ trans('navigation.not-completed_interventions')}}</td>
                        </tr>
                        <tr class="hidden" id="Xnotcompletedints{{ $case->form_id }}">
                            <td colspan="8" class="text-right">
                                <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 mb-6 md:px-2">
                                    @forelse($notcompleted_ints as $notcompleted_int)
                                    @if($notcompleted_int->forms_parent_id == $case->forms_parent_id)
                                    <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                        <div class="absolute left-4 top-[1rem]">
                                            <img class="bg-cover" src="{{ url($notcompleted_int->image ?? '') }}" alt="{{ url($notcompleted_int->image ?? '') }}" width="85rem" height="50rem">
                                        </div>
                                        <p class="my-4 text-xl font-semibold">{{ $notcompleted_int->name_short}}</p>
                                        <div class="border-t-2"></div>
                                        <div class="flex justify-between py-0">
                                            <div class="my-2">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @empty
                                    NO Ints Founds
                                    @endforelse
                                </div>
                            </td>
                        </tr>
                        @endforeach
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

@if (Admin::user()->inRoles(['development']))
@include('modals.reactive-url-modal')
@include('modals.development-notcompleted-cases-modal')
@endif
@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@include('tailAdmin.scripts.development-actions')
@endsection