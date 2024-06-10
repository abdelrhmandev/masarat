<table id="casesList" class="min-w-full divide-y divide-gray-200 text-center bg-gray-50 caption-top"
    style="direction: rtl">
    <thead class="font-bold text-sm">
        <?php $counter = 0; ?>
        @if (Admin::user()->inRoles(['development']) && $ints_status_url != 'supported_ints')
            <?php $counter += 1; ?>
        @endif
        <?php $counter += 1; ?>
        @if (!empty($columns))
            @foreach ($columns as $column_answer_id => $text)
                @if ($colum_type_by_id[$column_answer_id] != 'file')
                    <?php $counter += 1; ?>
                @endif
            @endforeach
        @endif
        @if ($ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports' && ($ints_status_url == 'supported_ints' || Admin::user()->inRoles(['operation'])))
            <?php $counter += 1; ?>
        @endif
        @if ($ints_status_url == 'approvedSupports')
            <?php $counter += 1; ?>
        @endif
        @if ($ints_status_url == 'rejectedSupports')
            <?php $counter += 1; ?>
        @endif
        @if (Admin::user()->inRoles(['partners']) && $ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports')
            <?php $counter += 1; ?>
        @endif
        <tr>
            <th colspan="{{ $counter }}">{{ $header_title }} </th>
        </tr>
        <tr>
            @if (Admin::user()->inRoles(['development']) && $ints_status_url != 'supported_ints')
                <th scope="col" class="px-2 py-3 text-gray-500 tracking-wider text-center">
                    {{ trans('development_interventions.intervention-maintenance.second.selection') }}
                </th>
            @endif
            <th scope="col" onclick="sortTable(1)" class="py-3 text-gray-500 tracking-wider cursor-pointer">
                {{ trans('development_transferCase.first.beneficiary-number') }}<span class="fas fa-sort ml-1"></span>
            </th>
            {{-- Generic columns logic --}}
            @if (!empty($columns))
                @foreach ($columns as $column_answer_id => $text)
                    @if ($colum_type_by_id[$column_answer_id] != 'file')
                        <th scope="col" class="py-3 text-gray-500 tracking-wider cursor-pointer">
                            {{ $text ?? '' }} <span class="fas fa-sort"></span>
                        </th>
                    @endif
                @endforeach
            @endif
            @if ($ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports' && ($ints_status_url == 'supported_ints' || Admin::user()->inRoles(['operation'])))
                <th scope="col" class="py-3 text-gray-500 tracking-wider">
                    {{ trans('development_interventions.details') }}</th>
            @endif
            @if ($ints_status_url == 'approvedSupports')
                <th scope="col" class="py-3 text-gray-500 tracking-wider">
                    {{ trans('development_interventions.approve') }}</th>
            @endif
            @if ($ints_status_url == 'rejectedSupports')
                <th scope="col" class="py-3 text-gray-500 tracking-wider">
                    {{ trans('development_interventions.reason') }}</th>
            @endif
            @if (Admin::user()->inRoles(['partners']) && $ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports')
                <th scope="col" onclick="sortTable(4)" class="py-3 text-gray-500 tracking-wider cursor-pointer">
                    {{ trans('development_interventions.intervention-maintenance.second.status') }}
                    <span class="fas fa-sort"></span>
                </th>
            @endif
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200 items-center text-center">
        @if (!empty($cases))
            <?php if (sizeof($cases) == 0) { ?>
            <tr class="hover:bg-gray-100 items-center text-center">
                <td colspan="7" class="px-6 py-4 whitespace-nowrap items-center text-center">
                    <div class="flex-shrink-0 w-full text-right">
                        <div class="text-sm font-bold underline text-[#F50057]">
                            {{ trans('messages.no-data') }}</div>
                    </div>
                </td>
            </tr>
            <?php } ?>
        @endif
        @if (!empty($cases))
            @foreach ($cases as $case)
                <tr class="hover:bg-gray-100 items-center text-center">
                    @if (Admin::user()->inRoles(['development']) && $ints_status_url != 'supported_ints')
                        <td class="py-4 whitespace-nowrap text-center">
                            <div class="flex-shrink-0">
                                <input id="filter-mobile-color-0" data-form-id="{{ $case->form_id ?? '' }}"
                                    name="ids[{{ $case->form_id ?? '' }}]" value="ids[{{ $case->form_id ?? '' }}]"
                                    type="checkbox"
                                    class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500 one-form-id">
                            </div>
                        </td>
                        <td class="py-4 whitespace-nowrap items-center text-center">
                            <div class="w-full h-full flex items-center justify-center z-0">
                                <button image-data-id="{{ $case->form_id }}"
                                    class="image-show-modal block font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    type="button">
                                    {{ $case->pen_id ?? '' }}
                                </button>
                            </div>
                        </td>
                    @else
                        <td class="py-4 whitespace-nowrap items-center text-center">
                            <div class="w-full h-full flex items-center justify-center z-0">
                                {{ $case->pen_id ?? '' }}
                            </div>
                        </td>
                    @endif

                    {{-- Generic Answers generation --}}
                    @foreach ($columns as $column_answer_id => $text)
                        @if ($colum_type_by_id[$column_answer_id] != 'file')
                            <td class="whitespace-nowrap text-sm text-gray-500">
                                <span class="inline-flex text-md leading-5 rounded-full">   
                                    {{ $answers[$case->form_id][$column_answer_id] ?? '' }}
                                </span>
                            </td>
                        @endif
                    @endforeach
                    @if ($ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports' && ($ints_status_url == 'supported_ints' || Admin::user()->inRoles(['operation'])) && ($case->status_id == 13 || $case->status_id == 6))
                        <td><button type="button" data-id="{{ $case->form_id }}"
                                class="text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-indigo-600 hover:bg-indigo-700 show-supporter-modal">{{ trans('development_interventions.show-details') }}</button>
                        </td>
                    @elseif ($ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports' && ($ints_status_url == 'supported_ints' || Admin::user()->inRoles(['operation'])) && $case->status_id == 7)
                        <td>دعم داخلي مباشر</td>
                    @endif
                    @if ($ints_status_url == 'approvedSupports')
                        <td><button type="button" approve-data-id="{{ $case->form_id }}"
                                class="text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-indigo-600 hover:bg-indigo-700 show-approve-modal">{{ trans('development_interventions.approve') }}</button>
                        </td>
                    @endif
                    @if ($ints_status_url == 'rejectedSupports')
                        <td><button type="button" reason-data-id="{{ $case->form_id }}"
                                class="text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-indigo-600 hover:bg-indigo-700 show-reason-modal">{{ trans('development_interventions.reason') }}</button>
                        </td>
                    @endif
                    @if (Admin::user()->inRoles(['partners']) && $ints_status_url != 'rejectedSupports' && $ints_status_url != 'approvedSupports')
                        <td class="py-3 text-xs">
                            <?php if ($case->status_id == 4) { ?>
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                {{ trans('status.waiting-support') }}
                            </span>
                            <?php } else if ($case->status_id == 5) { ?>
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                {{ trans('status.under-procedure') }}
                            </span>
                            <?php } else if ($case->status_id == 7) { ?>
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                {{ trans('status.waiting-support') }}
                            </span>
                            <?php } ?>
                        </td>
                    @endif
                    @if (Admin::user()->inRoles(['development']) || Admin::user()->inRoles(['operation']))
                        @if ($ints_status_url == 'returned_ints' || $ints_status_url == 'hanggedInts')
                            <td>
                                <span>{{ $case->reason }}</span>
                            </td>
                        @endif
                    @endif
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
