@extends('tailAdmin.layout')

@section('title')
{{ trans('title.partners') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">{{ trans('providers.sub_provider.title') }}</h1>
@endsection

@section('content')
<!-- ROWS COUNT SHOW SECTION -->
<div class="grid grid-cols-2 gap-4">
    <div>
    </div>
    <div class="absolute top-[9rem] right-18">
        <a href="#" type="button" class="show-provider-modal py-2 px-10 mr-0 ml-0 text-sm text-white font-bold bg-indigo-600 rounded-lg border border-2 border-gray-100 hover:bg-indigo-500 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">{{ trans('providers.sub_provider.create') }}</a>
    </div>

    <div class="text-left text-sm">
        <h1 class="inline-block ml-2">{{ trans('development_transferCase.second.row-count') }}</h1>
        <a href="{{ $current_url.'?count=10' }}" type="button" id="ten" class="py-2 px-2 mr-0 ml-0 text-sm text-blue-700 font-bold bg-white rounded-lg border border-2 border-blue-700 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
        <a href="{{ $current_url.'?count=30' }}" type="button" id="thirty" class="py-2 px-2 mr-0 ml-0 text-sm text-gray-900 bg-white rounded-lg border border-2 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
        <a href="{{ $current_url.'?count=50' }}" type="button" id="fifty" class="py-2 px-2 mr-0 ml-0 text-sm text-gray-900 bg-white rounded-lg border border-2 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
    </div>
</div>

<!-- TABLE & SELECTION METHOD SECTION -->
<form action="{{ url('admin/development/doTransfer') }}" method="POST">
    @csrf
    <div class="flex flex-col my-8">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table id="casesList" class="min-w-full divide-y divide-gray-200 text-center bg-gray-50">
                        <thead class="font-bold text-sm">
                            <tr>
                                <th scope="col" onclick="sortTable(1)" class="text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('providers.sub_provider.partner_name') }}<span class="fas fa-sort ml-1"></span>
                                </th>
                                <th scope="col" onclick="sortTable(1)" class="text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('providers.sub_provider.on_behave_name') }}<span class="fas fa-sort ml-1"></span>
                                </th>
                                <th scope="col" class="py-3 text-gray-500 tracking-wider">
                                    {{ trans('providers.sub_provider.phone') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('providers.sub_provider.email') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('providers.sub_provider.address') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-gray-500 tracking-wider cursor-pointer">
                                    {{ trans('providers.sub_provider.edit') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 items-center text-center">
                            <?php if (sizeof($providers) === 0) { ?>
                                <tr class="hover:bg-gray-100 items-center text-center">
                                    <td colspan="7" class="px-6 py-4 whitespace-nowrap items-center text-center">
                                        <div class="flex-shrink-0 w-full text-right">
                                            <div class="text-sm font-bold underline text-[#F50057]">{{ trans('messages.no-data') }}</div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>

                            @foreach ($providers as $developer)
                            <tr class="hover:bg-gray-100 items-center text-center">
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $developer->name }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $developer->person_name }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $developer->phone }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $developer->email }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $developer->full_address }}
                                    </span>
                                </td>
                                <td>
                                    <a href="#" data-id="{{ $developer->id  }}" type="submit" class="edit-provider py-1 px-2 text-white bg-indigo-600 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{ url('admin/partners/deleteProvider/'.$developer->id) }}" type="submit" class="py-1 px-3 mr-1 text-white bg-indigo-600 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
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
                                    <span class="font-medium">{{ (($providers->perPage()*$providers->currentPage())-$providers->perPage())+1 }}</span>
                                    {{ trans('development_transferCase.second.to') }}
                                    <span class="font-medium">{{ $providers->perPage()*$providers->currentPage() }}</span>
                                    {{ trans('development_transferCase.second.of') }}
                                    <span class="font-medium">{{ $providers->total() }}</span>
                                    {{ trans('development_transferCase.second.result') }}
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm" aria-label="Pagination">
                                    <div class="flex justify-between">
                                        <a href="{{ $providers->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $providers->currentPage() - 1 }}" class="{{ (($providers->perPage()*$providers->currentPage())-$providers->perPage())+1 === 1? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-3 py-1 ml-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_transferCase.second.previous') }}
                                        </a>
                                        <a href="{{ $providers->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $providers->currentPage() + 1 }}" class="{{ $providers->perPage()*$providers->currentPage() >= $providers->total()? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-4 py-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
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

</form>
@include('tailAdmin.modals.modal-form-provider')
@include('tailAdmin.modals.modal-update-provider')

@endsection

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@include('tailAdmin.scripts.partners-actions')
@endsection