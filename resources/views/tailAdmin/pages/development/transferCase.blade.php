@extends('tailAdmin.layout')

@section('title')
{{ trans('title.transferCase') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">
    {{ trans('development_transferCase.first.title') }}
</h1>
@endsection

@section('content')
@include('includes.filter', ['filters' => $filters])
<!-- ROWS COUNT SHOW SECTION -->
<div class="mt-8 grid grid-cols-2 gap-4 mb-4">
    <div>
        <h1 class="ml-8 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">
            {{ trans('development_transferCase.second.title') }}
        </h1>
    </div>
    <div class="text-left text-sm">
        <h1 class="inline-block ml-2">{{ trans('development_transferCase.second.row-count') }}</h1>
        <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="py-2 px-2 mr-0 ml-0 text-sm text-blue-700 font-bold bg-white rounded-lg border border-2 border-blue-700 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
        <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="py-2 px-2 mr-0 ml-0 text-sm text-gray-900 bg-white rounded-lg border border-2 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
        <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="py-2 px-2 mr-0 ml-0 text-sm text-gray-900 bg-white rounded-lg border border-2 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<form action="{{ url('admin/development/doTransfer') }}" method="POST">
    @csrf
    <div class="flex flex-col mt-0">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table id="casesList" class="min-w-full divide-y divide-gray-200 text-center bg-gray-50">
                        <thead class="font-bold text-sm">
                            <tr>
                                <th scope="col" class="px-3 py-3 text-gray-500 tracking-wider text-left">
                                    {{ trans('development_transferCase.second.selection') }}
                                </th>
                                <th scope="col" onclick="sortTable(1)" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('development_transferCase.second.beneficiary-number') }}<span class="fas fa-sort ml-1"></span>
                                </th>
                                <th scope="col" onclick="sortTable(2)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('development_transferCase.second.family-count') }}<span class="fas fa-sort"></span>
                                </th>
                                <th scope="col" onclick="sortTable(3)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('development_transferCase.second.workable') }}<span class="fas fa-sort"></span>
                                </th>
                                <th scope="col" onclick="sortTable(4)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('development_transferCase.second.need-degree') }}<span class="fas fa-sort"></span>
                                </th>
                                <th scope="col" onclick="sortTable(5)" class="px-2 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('development_transferCase.second.able-development') }}<span class="fas fa-sort"></span>
                                </th>
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
                            <tr class="hover:bg-gray-100 text-center">
                                <td class="px-3 py-4 whitespace-nowrap text-center">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        <input class="border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" id="filter-mobile-color-0" name="ids[]" value="{{ $case->pen_id }}" type="checkbox">
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $case->pen_id }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $case->family_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $case->able_to_work }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ round($case->need, 0) }}%
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ round($case->development, 0) }}%
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
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
                                        <a href="{{ $cases->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $cases->currentPage() - 1 }}" class="{{ $cases->perPage() * $cases->currentPage() - $cases->perPage() + 1 === 1 ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-3 py-1 ml-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_transferCase.second.previous') }}
                                        </a>
                                        <a href="{{ $cases->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $cases->currentPage() + 1 }}" class="{{ $cases->perPage() * $cases->currentPage() >= $cases->total() ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-4 py-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_transferCase.second.next') }}
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4">
            <h1 class="ml-8 mt-4 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">
                {{ trans('development_transferCase.third.title') }}
            </h1>
            <div class="align-bottom bg-white rounded-lg overflow-hidden shadow transform transition-all py-8 px-8 border-b border-gray-200">
                <div class="flex">
                    <fieldset>
                        <div>
                            <legend class="text-base font-bold text-gray-900">
                                {{ trans('development_transferCase.third.method') }}
                            </legend>
                        </div>
                        <div class="mt-4 space-y-4 mb-4">
                            <div class="flex items-center">
                                <input id="push-above" name="push-notifications" type="radio" class="ml-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300" checked>
                                <label for="push-everything" class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ trans('development_transferCase.third.above') }}
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input id="push-page" name="push-notifications" type="radio" class="ml-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="push-email" class="ml-3 block text-sm font-medium text-gray-700">
                                    {{ trans('development_transferCase.third.page') }}
                                </label>
                                <input id="custom" type="text" name="custom" class="hidden absolute right-72 top-[128px] focus:ring-indigo-500 focus:border-indigo-500 block w-16 shadow-sm sm:text-sm border-gray-300 rounded-md" pattern="[0-9]{4}" maxlength="4">
                            </div>
                        </div>

                        <div class="inline">
                            <button type="submit" class="items-center justify-center px-16 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">{{ trans('development_transferCase.third.approve') }}</button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
</form>
@endsection

@section('footer_scripts')
<script src="{{ url('js/transferCase/app.js') }}"></script>
<script src="{{ url('js/modal/app.js') }}"></script>
<script src="{{ url('js/sortTable/app.js') }}"></script>
@endsection