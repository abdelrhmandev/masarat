@extends('tailAdmin.layout')

@section('title')
{{ $page_title }}
@endsection

@section('head')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer integrity="sha384-qIUj+yp0nYG+FiRSyz0hFI7OAjgQfjCIxMKboilWruQkwLsv9YqKZ+oQlBjjN1wy" crossorigin="anonymous"></script>
@endsection

@section('header_title')
<h1 class="mb-4 ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
    {{ $header_title }}
</h1>
@endsection

@section('content')
<form action="{{ url('admin/development/intsTransfer') }}" method="POST">
    <!-- START FILTER SECTION -->
    <div class="overflow-hidden align-bottom transition-all transform bg-white border-b border-gray-200 rounded-lg shadow">
        <div class="flex">
            <div class="py-4 mr-6 sm:px-2 lg:flex lg:justify-start">
                <h2 class="tracking-tight text-gray-900">
                    <span class="block mb-2 text-xs">{{ trans('development_interventions.intervention-maintenance.first.city') }}</span>
                    <div class="relative inline-flex">
                        <svg class="absolute top-0 right-0 w-2 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                            <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                        </svg>
                        <select class="h-10 pl-5 pr-10 text-xs text-gray-600 bg-white border border-gray-300 rounded-md appearance-none hover:border-gray-400 focus:outline-none">
                            <option>-</option>
                        </select>
                    </div>
                </h2>
            </div>

            <div class="py-4 lg:flex lg:justify-start">
                <h2 class="tracking-tight text-gray-900">
                    <span class="block mb-2 text-xs">{{ trans('development_interventions.intervention-maintenance.first.neighborhood') }}</span>
                    <div class="relative inline-flex">
                        <svg class="absolute top-0 right-0 w-2 h-2 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                            <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                        </svg>
                        <select class="h-10 pl-5 pr-10 text-xs text-gray-600 bg-white border border-gray-300 rounded-md appearance-none hover:border-gray-400 focus:outline-none">
                            <option>-</option>
                        </select>
                    </div>
                </h2>
            </div>
            <div class="inline pt-10 mr-2">
                <button type="submit" class="items-center justify-center px-12 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">{{ trans('development_interventions.intervention-maintenance.first.filter') }}</button>
            </div>
        </div>
    </div>
    <!-- END FILTER SECTION -->

    <!-- START ROWS COUNT SHOW SECTION -->
    <div class="grid grid-cols-2 gap-4 mt-8 mb-4">
        <div>
            <h1 class="ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
                {{ trans('development_interventions.intervention-maintenance.second.title') }}
            </h1>
        </div>
        <div class="text-sm text-left">
            <h1 class="inline-block ml-2">
                {{ trans('development_interventions.intervention-maintenance.second.row-count') }}
            </h1>
            <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="px-2 py-2 ml-0 mr-0 text-sm text-blue-700 bg-white border border-2 border-blue-700 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
            <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
            <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
        </div>
    </div>
    <!-- END ROWS COUNT SHOW SECTION -->

    <!-- START TABLE SECTION -->
    <div class="flex flex-col mt-0">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table id="casesList" class="min-w-full text-center divide-y divide-gray-200 bg-gray-50">
                        <!-- START HEAD SECTION -->
                        <thead class="text-sm font-bold">
                            <tr>
                                @if ((Admin::user()->inRoles(['development']) || Admin::user()->inRoles(['partners'])) && $ints_status_url != 'supported_ints' && $ints_status_url != 'executed_ints')
                                <th scope="col" class="px-2 py-3 tracking-wider text-center text-gray-500">
                                    {{ trans('development_interventions.intervention-maintenance.second.selection') }}
                                </th>
                                @endif
                                <th scope="col" onclick="sortTable(1)" class="py-3 tracking-wider text-gray-500 cursor-pointer">
                                    {{ trans('development_transferCase.first.beneficiary-number') }}<span class="ml-1 fas fa-sort"></span>
                                </th>

                                {{-- Show the first four columns logic --}}
                                @if (!empty($columns))
                                <?php
                                    $showColumns =  4;
                                    $iteration = 1;
                                ?>
                                @foreach ($columns as $column_answer_id => $text)
                                @if ($colum_type_by_id[$column_answer_id] != 'file')
                                    @if($iteration < $showColumns) 
                                    <th class="py-3 tracking-wider text-gray-500 cursor-pointer">
                                        {{ $text ?? '---' }} <span class="fas fa-sort"></span>
                                    </th>
                                    @endif
                                    <?php
                                        $iteration++;
                                    ?>
                                @endif
                                @endforeach
                                @endif
                                {{-- Show the first four columns logic --}}

                                <th scope="col" class="py-3 text-gray-500 tracking-wider">
                                    {{ trans('admin.more') }}
                                </th>

                                @if (Admin::user()->inRoles(['director']))
                                <th scope="col" class="py-3 text-gray-500 tracking-wider">
                                    {{ trans('interventions.source') }}
                                </th>
                                @endif
                                @if (Admin::user()->inRoles(['operation']) || (Admin::user()->inRoles(['development']) && $ints_status_url == 'supported_ints'))
                                <th scope="col" class="py-3 tracking-wider text-gray-500">
                                    {{ trans('development_interventions.details') }}
                                </th>
                                @endif
                                @if ($ints_status_url == 'rejectedSupports')
                                <th scope="col" class="py-3 tracking-wider text-gray-500">
                                    {{ trans('development_interventions.reason') }}
                                </th>
                                @endif
                                @if (Admin::user()->inRoles(['partners']) && $ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports')
                                <th scope="col" onclick="sortTable(4)" class="py-3 tracking-wider text-gray-500 cursor-pointer">
                                    {{ trans('development_interventions.intervention-maintenance.second.status') }}<span class="fas fa-sort"></span>
                                </th>
                                @endif
                                @if ($ints_status_url == 'hanggedInts' || $ints_status_url == 'returned_ints')
                                <th scope="col" class="py-3 tracking-wider text-gray-500">
                                    {{ trans('interventions.hang-reasons') }}
                                </th>
                                @endif
                                @if ($ints_status_url != 'approvedSupports' && $ints_status_url != 'executed_ints')
                                <th scope="col" class="py-3 tracking-wider text-gray-500">
                                    {{ trans('development_interventions.intervention-maintenance.second.transfer') }}
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <!-- END HEAD SECTION -->

                        <!-- START BODY SECTION -->
                        <tbody class="items-center text-center bg-white divide-y divide-gray-200">
                            @if (!empty($cases))
                            <?php if (sizeof($cases) == 0) { ?>
                                <tr class="items-center text-center hover:bg-gray-100">
                                    <td colspan="7" class="items-center px-6 py-4 text-center whitespace-nowrap">
                                        <div class="flex-shrink-0 w-full text-right">
                                            <div class="text-sm font-bold underline text-[#F50057]">
                                                {{ trans('messages.no-data') }}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            @endif

                            @if (!empty($cases))
                            @foreach ($cases as $case)
                            <tr class="items-center text-center hover:bg-gray-100">
                                @if ((Admin::user()->inRoles(['development']) || Admin::user()->inRoles(['partners'])) && $ints_status_url !== 'supported_ints' && $ints_status_url != 'executed_ints')
                                <td class="py-4 text-center whitespace-nowrap">
                                    <div class="flex-shrink-0">
                                        <input id="filter-mobile-color-0" data-form-id="{{ $case->form_id ?? '' }}" name="ids[{{ $case->form_id ?? '' }}]" value="ids[{{ $case->form_id ?? '' }}]" type="checkbox" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 one-form-id">
                                    </div>
                                </td>

                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $case->pen_id ?? '---' }}
                                    </span>
                                </td>
                                @else
                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                        {{ $case->pen_id ?? '---' }}
                                    </span>
                                </td>
                                @endif

                                {{-- Generic Answers generation --}}
                                <?php $iterate = 1; ?>
                                @foreach ($columns as $column_answer_id => $text)
                                @if($iterate < $showColumns) 
                                    @if ($colum_type_by_id[$column_answer_id] != 'pdf' && $colum_type_by_id[$column_answer_id] != 'file') 
                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 mt-5">
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                            {{ $answers[$case->form_id][$column_answer_id] ?? '---' }}
                                        </span>
                                    </td>
                                    <?php $iterate++; ?>
                                    @elseif($colum_type_by_id[$column_answer_id] == 'pdf' && $colum_type_by_id[$column_answer_id] != 'file')
                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                            <a target="_blank" href="{{ $answers[$case->form_id][$column_answer_id] ?? '---' }}" rel="noopener">
                                                <i class="fas fa-file-pdf fa-3x"></i>
                                            </a>
                                        </span>
                                    </td>
                                    <?php $iterate++; ?>  
                                    @endif
                                @endif 
                                @endforeach

                                <td class="flex justify-center">
                                    <div class="flex flex-row px-0 gap-2 mr-[10%] mt-3">
                                        <div class="flex items-center justify-center duration-500 transform border border-gray-200 rounded-md hover:shadow-xl hover:scale-105">
                                            <a id="{{ $case->form_id }}" href="javascript:void(0)" onclick="showHideIntDetails({{ $case->form_id }})"><img data-role-id="7" src="{{ url('img/plus.svg') }}" id="icon_{{ $case->form_id }}" alt="plus" class="w-full h-6" /></a>
                                        </div>
                                        @if($details_id != 3 && $details_id != 5 && $details_id != 6 && $details_id != 10 && $details_id != 15 && $details_id != 16 && $details_id != 17)
                                        <div class="flex items-center justify-center duration-500 transform border border-gray-200 rounded-md hover:shadow-xl hover:scale-105">
                                            <a href="#" image-data-id="{{ $case->form_id }}" class="image-show-modal"><img data-role-id="7" src="{{ url('img/attachment.svg') }}" alt="attachment" class="w-full h-6" /></a>
                                        </div>
                                        @endif
                                    </div>
                                </td>

                                @if (Admin::user()->inRoles(['operation']) || (Admin::user()->inRoles(['development']) && $ints_status_url == 'supported_ints'))
                                <td>
                                  
                                     @if($case->provider_id)
                                    <button type="button" data-id="{{ $case->form_id }}" class="px-2 py-2 text-xs text-base text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 show-supporter-modal">{{ trans('development_interventions.show-details') }}</button>
                                    @else
                                    -
                                    @endif
                                </td>
                                @endif
                                @if ($ints_status_url == 'rejectedSupports')
                                <td>
                                    <button type="button" reason-data-id="{{ $case->form_id }}" class="px-4 py-2 text-xs text-base text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 show-reason-modal">{{ trans('development_interventions.reason') }}</button>
                                </td>
                                @endif

                                @if (Admin::user()->inRoles(['development']) || Admin::user()->inRoles(['operation']))
                                    @if ($ints_status_url == 'returned_ints' || $ints_status_url == 'hanggedInts')
                                    <td>
                                        <button type="button" reason-data-id="{{ $case->form_id }}" class="px-4 py-2 text-xs text-base text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 show-reason-modal">{{ trans('development_interventions.reason') }}</button>
                                    </td>
                                    @endif
                                @endif

                                @if (Admin::user()->inRoles(['partners']) && $ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports')
                                <td class="py-3 text-xs">
                                    <?php if ($case->status_id == 4) { ?>
                                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                            {{ trans('status.waiting-support') }}
                                        </span>
                                    <?php } else if ($case->status_id == 5) { ?>
                                        <span class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                            {{ trans('status.under-procedure') }}
                                        </span>
                                    <?php } else if ($case->status_id == 7) { ?>
                                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                            {{ trans('status.waiting-support') }}
                                        </span>
                                    <?php } ?>
                                </td>
                                @endif
                                
                                @if (Admin::user()->inRoles(['director']))
                                <td class="text-sm text-gray-500 whitespace-nowrap">  
                                    @if ($case->provider_id)
                                        <button type="button" class="px-2 py-2 text-xs text-base text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 show-reason-modal">
                                            <a href="#" data-id="{{ $case->form_id }}" class="show-supporter-modal">إدارة الشركات</a>
                                        </button>
                                    @else
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full ">
                                            الإداره التنمويه
                                        </span>
                                    @endif
                                </td>
                                @endif

                                @if ($ints_status_url != 'approvedSupports' && $ints_status_url != 'executed_ints')
                                <td class="py-2 text-xs text-gray-500 whitespace-nowrap">
                                    @if (Admin::user()->inRoles(['partners']))
                                        @include('partials.actions-dropdown', [
                                        'form_id' => $case->form_id,
                                        'status_id' => $case->status_id,
                                        'id' => $column_answer_id,
                                        'details_id' => $details_id,
                                        ])
                                    @elseif (Admin::user()->inRoles(['development']) && $ints_status_url == 'supported_ints')
                                    @include('partials.supported-dropdown', ['id' => $case->form_id])
                                    @elseif (Admin::user()->inRoles(['development']))
                                    @include('partials.transfers-dropdown', ['id' => $case->form_id])
                                    @elseif (Admin::user()->inRoles(['operation']))
                                    @include('partials.operation-dropdown', ['id' => $case->form_id])
                                    @elseif (Admin::user()->inRoles(['director']))
                                        @include('partials.director-dropdown', [
                                        'id' => $case->form_id,
                                        'status_id' => $case->status_id,
                                        'provider_id' => 0,
                                        ])
                                    @endif
                                </td>
                                @endif
                            </tr>

                            <tr class="hidden filters-holder" id="tr_int_details{{ $case->form_id }}">
                                <td colspan="{{ count($columns)+4 }}" class="text-right">
                                    <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 mb-6 md:px-2">
                                    @foreach ($columns as $column_answer_id => $text)
                                        @if ($colum_type_by_id[$column_answer_id] != 'pdf' && $colum_type_by_id[$column_answer_id] != 'file')
                                        <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80">
                                            <p class="my-4 text-sm text-gray-500 font-semibold">{{ $text ?? ''}} </p>
                                            <div class="border-t-2"></div>
                                            <div class="flex justify-between py-0">
                                                <div class="my-2">
                                                    {{ $answers[$case->form_id][$column_answer_id] ?? '---' }}
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($colum_type_by_id[$column_answer_id] == 'pdf' && $colum_type_by_id[$column_answer_id] != 'file')
                                        <div class="relative px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-64">
                                            <p class="my-4 text-sm text-gray-500 font-semibold">{{ $text ?? ''}} </p>
                                            <div class="border-t-2"></div>
                                            <div class="flex justify-center py-2"> 
                                                <a target="_blank" href="{{ $answers[$case->form_id][$column_answer_id] ?? '---' }}" rel="noopener">
                                                    <i class="fas fa-file-pdf fa-3x"></i>
                                                </a> 
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <!-- END BODY SECTION -->
                    </table>

                    <!-- START PAGINATION SECTION -->
                    <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    {{ trans('development_interventions.intervention-maintenance.second.show') }}
                                    <span class="font-medium">{{ $cases->perPage() * $cases->currentPage() - $cases->perPage() + 1 }}</span>
                                    {{ trans('development_interventions.intervention-maintenance.second.to') }}
                                    <span class="font-medium">{{ $cases->perPage() * $cases->currentPage() }}</span>
                                    {{ trans('development_interventions.intervention-maintenance.second.of') }}
                                    <span class="font-medium">{{ $cases->total() }}</span>
                                    {{ trans('development_interventions.intervention-maintenance.second.result') }}
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm" aria-label="Pagination">
                                    <div class="flex justify-between">
                                        <a href="#" class="{{ $cases->perPage() * $cases->currentPage() - $cases->perPage() + 1 === 1 ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-3 py-1 ml-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_interventions.intervention-maintenance.second.previous') }}
                                        </a>
                                        <a href="#" class="{{ $cases->perPage() * $cases->currentPage() >= $cases->total() ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-4 py-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_interventions.intervention-maintenance.second.next') }}
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGINATION SECTION -->
                </div>
            </div>
        </div>
    </div>
    <!-- END TABLE SECTION -->

    <!-- START SELECTION METHOD SECTION -->
    @if (Admin::user()->inRoles(['development']) && $ints_status_url != 'supported_ints' && $ints_status_url != 'executed_ints')
    <div class="z-0 mt-4 mb-20">
        <h1 class="mt-4 mb-4 ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
            {{ trans('development_interventions.selection-method.title') }}
        </h1>
        <div class="px-8 py-8 overflow-hidden align-bottom transition-all transform bg-white border-b border-gray-200 rounded-lg shadow">
            <div class="flex">
                <fieldset class="mb-4">
                    <div>
                        <legend class="text-base font-bold text-gray-900">
                            {{ trans('development_interventions.selection-method.method') }}
                        </legend>
                    </div>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input id="push-above" name="push-notifications" type="radio" class="w-4 h-4 ml-2 text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                            <label for="push-everything" class="block ml-3 text-sm font-medium text-gray-700">
                                {{ trans('development_interventions.selection-method.above') }}
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input id="push-page" name="push-notifications" type="radio" class="w-4 h-4 ml-2 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="push-email" class="block ml-3 text-sm font-medium text-gray-700">
                                {{ trans('development_interventions.selection-method.page') }}
                            </label>
                            <input id="custom" type="text" name="custom" class="hidden absolute right-72 top-[128px] focus:ring-indigo-500 focus:border-indigo-500 block w-16 shadow-sm sm:text-sm border-gray-300 rounded-md" pattern="[0-9]{4}" maxlength="4">
                        </div>
                    </div>
                </fieldset>
                <div class="flex flex-row px-5 item-center text-center gap-10 mr-[15%]">
                    <div class="flex items-center justify-center duration-500 transform border border-gray-200 rounded-md hover:shadow-xl hover:scale-105">
                        <a href="#x">
                            <div class="w-56 overflow-hidden rounded-md shadow-lg cursor-pointer">
                                <img data-role-id="7" src="{{ url('img/personal_finance.svg') }}" alt="personal_finance" class="w-full h-28 transfer-selected" />
                                <div class="p-4 bg-white">
                                    <h1 class="text-xl font-bold">
                                        {{ trans('development_interventions.selection-method.execute') }}
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="flex items-center justify-center duration-500 transform border border-gray-200 rounded-md hover:shadow-xl hover:scale-105">
                        <a href="#x">
                            <div class="w-56 overflow-hidden rounded-md shadow-lg cursor-pointer">
                                <img data-role-id="4" src="{{ url('img/business_deal.svg') }}" alt="" class="w-full h-28 transfer-selected" />
                                <div class="p-4 bg-white">
                                    <h1 class="text-xl font-bold">
                                        {{ trans('development_interventions.selection-method.support-request') }}
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- END SELECTION METHOD SECTION -->
    
    <!-- START EXPORTING EXCEL FILE -->
    @if (Admin::user()->inRoles(['partners']) && $ints_status_url != 'supported_ints')
    <div class="z-0 mt-4 mb-20">
        <h1 class="mt-4 mb-4 ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
            {{ trans('development_interventions.selection-method.export_excel') }}
        </h1>
        <div class="px-8 py-8 overflow-hidden align-bottom transition-all transform bg-white border-b border-gray-200 rounded-lg shadow">
            <div class="flex">
                <fieldset class="mb-4">
                    <div>
                        <legend class="text-base font-bold text-gray-900">
                            {{ trans('development_interventions.selection-method.method') }}
                        </legend>
                    </div>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center">
                            <input id="push-above" name="push-notifications" type="radio" class="w-4 h-4 ml-2 text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                            <label for="push-everything" class="block ml-3 text-sm font-medium text-gray-700">
                                {{ trans('development_interventions.selection-method.above_export') }}
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="push-page" name="push-notifications" type="radio" class="w-4 h-4 ml-2 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <label for="push-nothing" class="block ml-3 text-sm font-medium text-gray-700">
                                {{ trans('development_interventions.selection-method.custom_excel') }}
                            </label>
                        </div>
                    </div>
                </fieldset>

                <div class="flex flex-row px-5 item-center text-center gap-10 mr-[15%]">
                    <div class="flex items-center justify-center duration-500 transform border border-gray-200 rounded-md hover:shadow-xl hover:scale-105">
                        <a href="#x">
                            <div class="w-56 overflow-hidden rounded-md shadow-lg cursor-pointer">
                                <img data-role-id="7" src="{{ url('img/excel.svg') }}" alt="personal_finance" class="w-full h-28 transfer-selected" />
                                <div class="p-4 bg-white">
                                    <h1 class="text-xl font-bold">
                                        {{ trans('development_interventions.selection-method.download') }}
                                    </h1>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- START EXPORTING EXCEL FILE -->
</form>
@endsection

<!-- START MANAGE MODALS SECTION-->
@include('modals.supporter-modal')
@include('modals.image-modal')

@if (Admin::user()->inRoles(['partners']))
<!-- if PARTNERS -->
@include('modals.partners-approval-modal')
@include('modals.approve-modal')
@include('modals.reason-modal')
@elseif (Admin::user()->inRoles(['operation']))
<!-- if OPERATION -->
@include('modals.hangged-modal')
@include('modals.operation-close-modal')
@include('modals.operation-hang-modal')
@include('modals.operation-reason-modal')
@elseif (Admin::user()->inRoles(['director']))
<!-- if DIRECTOR-->
@include('modals.operation-close-modal')
@include('modals.operation-hang-modal')
@elseif (Admin::user()->inRoles(['development']))
<!-- if DEVELOPMENT-->
@include('modals.development-reject-modal')
@include('modals.operation-hang-modal')
@include('modals.operation-reason-modal')
@endif
<!-- END MANAGE MODALS SECTION -->

@section('footer_scripts')
@include('tailAdmin.scripts.shared-actions')
<script src="{{ url('js/transferCase/app.js') }}"></script>
<script src="{{ url('js/modal/app.js') }}"></script>
<script src="{{ url('js/sortTable/app.js') }}"></script>
<!-- if PARTNERS -->
@if (Admin::user()->inRoles(['partners']))
@include('tailAdmin.scripts.partners-actions')
<!-- if DEVELOPMENT -->
@elseif (Admin::user()->inRoles(['development']))
@include('tailAdmin.scripts.development-actions')
<!-- if OPERATION -->
@elseif (Admin::user()->inRoles(['operation']))
@include('tailAdmin.scripts.operation-actions')
<!-- if DIRECTOR -->
@elseif (Admin::user()->inRoles(['director']))
@include('tailAdmin.scripts.director-actions')
@endif
@endsection