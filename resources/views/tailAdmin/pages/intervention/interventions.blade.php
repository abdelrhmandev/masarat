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
            @if (Admin::user()->int_housing == 0)
                <div>
                    <div class="flex justify-center">
                        <button type="submit" class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('interventions.housing-program') }}</button>
                    </div>

                    <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 md:px-2">
                        @php 
                            $viewed_details = [];
                        @endphp
                        @if (!empty($cases))
                            @foreach ($cases as $case)
                                @php
                                    $viewed_details[] = $case->int_id;
                                @endphp
                                @if ($case->int_id <= 3)
                                    <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                        <div class="absolute left-4 top-[1rem]">
                                            <img class="bg-cover" width="85rem" height="20rem" src="{{ url($case->image ?? '') }}" alt="{{ url($case->image ?? '') }}" />
                                        </div>
                                        <span class="absolute bg-[#ec5850] h-6 w-6 rounded-md -top-1 -right-1"></span>
                                        <p class="my-4 text-xl font-semibold">{{ $case->name }}</p>
                                        <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                            <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                            <p>{{ trans('development_interventions.cost') }}</p>
                                            <p>{{ $case->int_id == 3 ? '0' : $case->sum }}</p>
                                            <p>{{ trans('interventions.riyal') }}</p>
                                        </div>
                                        <div class="border-t-2"></div>
                                        <div class="flex justify-between py-0">
                                            <div class="my-2">
                                                <div class="flex mt-2 space-x-2">
                                                    <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $case->int_id) }}" class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                        {{ trans('development_interventions.details') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <p class="mb-2 text-base font-semibold">
                                                    {{ trans('development_interventions.total') }}</p>
                                                <div class="text-base font-semibold text-center text-gray-400">
                                                    <p>{{ $case->count ?? '0' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @foreach ($all_intervention_details as $one_intervention_details)
                            @if (!in_array($one_intervention_details->id, $viewed_details) && $one_intervention_details->id <= 3)
                                <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                    <div class="absolute left-4 top-[1rem]">
                                        <img class="bg-cover" width="85rem" height="50rem"
                                            src="{{ url($one_intervention_details->image ?? '') }}"
                                            alt="{{ url($one_intervention_details->image ?? '') }}" />
                                    </div>
                                    <p class="my-4 text-xl font-semibold">{{ $one_intervention_details->name_ar ?? '' }}</p>
                                    <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                        <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                        <p>{{ trans('development_interventions.cost') }}</p>
                                        <p>0</p>
                                        <p>{{ trans('interventions.riyal') }}</p>
                                    </div>
                                    <div class="border-t-2"></div>
                                    <div class="flex justify-between py-0">
                                        <div class="my-2">
                                            <div class="flex mt-2 space-x-2">
                                                <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $one_intervention_details->id) }}"
                                                    class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                    {{ trans('development_interventions.details') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <p class="mb-2 text-base font-semibold">
                                                {{ trans('development_interventions.total') }}</p>
                                            <div class="text-base font-semibold text-center text-gray-400">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- END Housing Program-->

            <!-- START Direct Support Program-->
            @if (Admin::user()->int_direct == 0)
                <div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('interventions.direct-support-program') }}</button>
                    </div>

                    <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 mb-6 md:px-2">
                        @php
                            $viewed_details = [];
                        @endphp
                        @if (!empty($cases))
                            @foreach ($cases as $case)
                                @php
                                    $viewed_details[] = $case->int_id;
                                @endphp
                                @if ($case->int_id >= 4 && $case->int_id <= 10 || $case->int_id == 23)
                                    <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                        <div class="absolute left-4 top-[1rem]">
                                            <img class="bg-cover" width="85rem" height="20rem"
                                                src="{{ url($case->image ?? '') }}"
                                                alt="{{ url($case->image ?? '') }}" />
                                        </div>
                                        <p class="my-4 text-xl font-semibold">{{ $case->name }}</p>
                                        <span class="absolute bg-[#ec5850] h-6 w-6 rounded-md -top-1 -right-1"></span>
                                        <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                            <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                            <p>{{ trans('development_interventions.cost') }}</p>
                                            <p>{{ $case->int_id == 6 ? '0' : $case->sum }}</p>
                                            <p>{{ trans('interventions.riyal') }}</p>
                                        </div>
                                        <div class="border-t-2"></div>
                                        <div class="flex justify-between py-0">
                                            <div class="my-2">
                                                <div class="flex mt-2 space-x-2">
                                                    <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $case->int_id) }}"
                                                        class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                        {{ trans('development_interventions.details') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <p class="mb-2 text-base font-semibold">
                                                    {{ trans('development_interventions.total') }}</p>
                                                <div class="text-base font-semibold text-center text-gray-400">
                                                    <p>{{ $case->count ?? '0' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @foreach ($all_intervention_details as $one_intervention_details)
                            @if (!in_array($one_intervention_details->id, $viewed_details) && ($one_intervention_details->id >= 4 && $one_intervention_details->id <= 10 || $one_intervention_details->id == 23))
                                <div
                                    class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                    <div class="absolute left-4 top-[1rem]">
                                        <img class="bg-cover" width="85rem" height="50rem"
                                            src="{{ url($one_intervention_details->image ?? '') }}"
                                            alt="{{ url($one_intervention_details->image ?? '') }}" />
                                    </div>
                                    <p class="my-4 text-xl font-semibold">
                                        {{ $one_intervention_details->name_ar ?? '' }}
                                    </p>
                                    <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                        <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                        <p>{{ trans('development_interventions.cost') }}</p>
                                        <p>0</p>
                                        <p>{{ trans('interventions.riyal') }}</p>
                                    </div>
                                    <div class="border-t-2"></div>
                                    <div class="flex justify-between py-0">
                                        <div class="my-2">
                                            <div class="flex mt-2 space-x-2">
                                                <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $one_intervention_details->id) }}"
                                                    class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                    {{ trans('development_interventions.details') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <p class="mb-2 text-base font-semibold">
                                                {{ trans('development_interventions.total') }}</p>
                                            <div class="text-base font-semibold text-center text-gray-400">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- END Direct Support Program-->

            <!-- START Health Program-->
            @if (Admin::user()->int_health == 0)
                <div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('interventions.health-program') }}</button>
                    </div>

                    <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 mb-6 md:px-2">
                        @php
                            $viewed_details = [];
                        @endphp
                        @if (!empty($cases))
                            @foreach ($cases as $case)
                                @php
                                    $viewed_details[] = $case->int_id;
                                @endphp
                                @if ($case->int_id >= 11 && $case->int_id <= 15)
                                    <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                        <div class="absolute left-4 top-[1rem]">
                                            <img class="bg-cover" width="85rem" height="20rem"
                                                src="{{ url($case->image ?? '') }}"
                                                alt="{{ url($case->image ?? '') }}" />
                                        </div>
                                        <p class="my-4 text-xl font-semibold">{{ $case->name }}</p>
                                        <span class="absolute bg-[#ec5850] h-6 w-6 rounded-md -top-1 -right-1"></span>
                                        <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                            <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                            <p>{{ trans('development_interventions.cost') }}</p>
                                            <p>{{ $case->sum ?? '0' }}</p>
                                            <p>{{ trans('interventions.riyal') }}</p>
                                        </div>
                                        <div class="border-t-2"></div>
                                        <div class="flex justify-between py-0">
                                            <div class="my-2">
                                                <div class="flex mt-2 space-x-2">
                                                    <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $case->int_id) }}"
                                                        class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                        {{ trans('development_interventions.details') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <p class="mb-2 text-base font-semibold">
                                                    {{ trans('development_interventions.total') }}</p>
                                                <div class="text-base font-semibold text-center text-gray-400">
                                                    <p>{{ $case->count ?? '0' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        @foreach ($all_intervention_details as $one_intervention_details)
                            @if (!in_array($one_intervention_details->id, $viewed_details) && $one_intervention_details->id >= 11 && $one_intervention_details->id <= 15)
                                <div
                                    class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                    <div class="absolute left-4 top-[1rem]">
                                        <img class="bg-cover" width="85rem" height="50rem"
                                            src="{{ url($one_intervention_details->image ?? '') }}"
                                            alt="{{ url($one_intervention_details->image ?? '') }}" />
                                    </div>
                                    <p class="my-4 text-xl font-semibold">{{ $one_intervention_details->name_ar ?? '' }}
                                    </p>
                                    <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                        <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                        <p>{{ trans('development_interventions.cost') }}</p>
                                        <p>0</p>
                                        <p>{{ trans('interventions.riyal') }}</p>
                                    </div>
                                    <div class="border-t-2"></div>
                                    <div class="flex justify-between py-0">
                                        <div class="my-2">
                                            <div class="flex mt-2 space-x-2">
                                                <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $one_intervention_details->id) }}"
                                                    class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                    {{ trans('development_interventions.details') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <p class="mb-2 text-base font-semibold">
                                                {{ trans('development_interventions.total') }}</p>
                                            <div class="text-base font-semibold text-center text-gray-400">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- END Health Program-->

            <!-- START Job Program-->
            @if (Admin::user()->int_job == 0)
                <div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('interventions.job-program') }}</button>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 mb-6 md:px-2">
                        @php
                            $viewed_details = [];
                        @endphp
                        @if (!empty($cases))
                            @foreach ($cases as $case)
                                @php
                                    $viewed_details[] = $case->int_id;
                                @endphp
                                @if ($case->int_id >= 16 && $case->int_id <= 18)
                                    <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                        <div class="absolute left-4 top-[1rem]">
                                            <img class="bg-cover" width="85rem" height="20rem" src="{{ url($case->image ?? '') }}" alt="{{ url($case->image ?? '') }}" />
                                        </div>
                                        <p class="my-4 text-xl font-semibold">{{ $case->name }}</p>
                                        <span class="absolute bg-[#ec5850] h-6 w-6 rounded-md -top-1 -right-1"></span>
                                        <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                            <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                            <p>{{ trans('development_interventions.cost') }}</p>
                                            <p>{{ $case->int_id == 16 ? '0' : $case->sum }}</p>
                                            <p>{{ trans('interventions.riyal') }}</p>
                                        </div>
                                        <div class="border-t-2"></div>
                                        <div class="flex justify-between py-0">
                                            <div class="my-2">
                                                <div class="flex mt-2 space-x-2">
                                                    <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $case->int_id) }}" class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">{{ trans('development_interventions.details') }}</a>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <p class="mb-2 text-base font-semibold">{{ trans('development_interventions.total') }}</p>
                                                <div class="text-base font-semibold text-center text-gray-400">
                                                    <p>{{ $case->count ?? '0' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @foreach ($all_intervention_details as $one_intervention_details)
                            @if (!in_array($one_intervention_details->id, $viewed_details) && $one_intervention_details->id >= 16 && $one_intervention_details->id <= 18)
                                <div
                                    class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                    <div class="absolute left-4 top-[1rem]">
                                        <img class="bg-cover" width="85rem" height="50rem" src="{{ url($one_intervention_details->image ?? '') }}" alt="{{ url($one_intervention_details->image ?? '') }}" />
                                    </div>
                                    <p class="my-4 text-xl font-semibold">{{ $one_intervention_details->name_ar ?? '' }}</p>
                                    <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                        <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                        <p>{{ trans('development_interventions.cost') }}</p>
                                        <p>0</p>
                                        <p>{{ trans('interventions.riyal') }}</p>
                                    </div>
                                    <div class="border-t-2"></div>
                                    <div class="flex justify-between py-0">
                                        <div class="my-2">
                                            <div class="flex mt-2 space-x-2">
                                                <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $one_intervention_details->id) }}"
                                                    class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                    {{ trans('development_interventions.details') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <p class="mb-2 text-base font-semibold">
                                                {{ trans('development_interventions.total') }}</p>
                                            <div class="text-base font-semibold text-center text-gray-400">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <!-- END Job Program-->

            <!-- START Logistic Program-->
            {{-- @if (Admin::user()->int_logistic == 0)
                <div>
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="items-center justify-center px-64 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md cursor-default">{{ trans('interventions.logistics-program') }}</button>
                    </div>
                    <div class="flex flex-wrap justify-center gap-2 px-4 mt-4 mb-6 md:px-2">
                        @php
                            $viewed_details = [];
                        @endphp
                        @if (!empty($cases))
                            @foreach ($cases as $case)
                                @php
                                    $viewed_details[] = $case->int_id;
                                @endphp
                                @if ($case->int_id >= 19)
                                    <div class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                        <div class="absolute left-4 top-[1rem]">
                                            <img class="bg-cover" width="85rem" height="20rem"
                                                src="{{ url($case->image ?? '') }}"
                                                alt="{{ url($case->image ?? '') }}" />
                                        </div>
                                        <p class="my-4 text-xl font-semibold">{{ $case->name }}</p>
                                        <span class="absolute bg-[#ec5850] h-6 w-6 rounded-md -top-1 -right-1"></span>
                                        <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                            <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                            <p>{{ trans('development_interventions.cost') }}</p>
                                            <p>{{ $case->sum ?? '0' }}</p>
                                            <p>{{ trans('interventions.riyal') }}</p>
                                        </div>
                                        <div class="border-t-2"></div>
                                        <div class="flex justify-between py-0">
                                            <div class="my-2">
                                                <div class="flex mt-2 space-x-2">
                                                    <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $case->int_id) }}"
                                                        class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                        {{ trans('development_interventions.details') }}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="my-2">
                                                <p class="mb-2 text-base font-semibold">
                                                    {{ trans('development_interventions.total') }}</p>
                                                <div class="text-base font-semibold text-center text-gray-400">
                                                    <p>{{ $case->count ?? '0' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @foreach ($all_intervention_details as $one_intervention_details)
                            @if (!in_array($one_intervention_details->id, $viewed_details) && $one_intervention_details->id >= 19 && $one_intervention_details->id <= 22)
                                <div
                                    class="relative max-w-sm px-6 mb-3 transition duration-500 transform bg-white border border-gray-200 rounded-md shadow-md w-80 hover:shadow-xl hover:scale-105">
                                    <div class="absolute left-4 top-[1rem]">
                                        <img class="bg-cover" width="85rem" height="50rem"
                                            src="{{ url($one_intervention_details->image ?? '') }}"
                                            alt="{{ url($one_intervention_details->image ?? '') }}" />
                                    </div>
                                    <p class="my-4 text-xl font-semibold">{{ $one_intervention_details->name_ar ?? '' }}
                                    </p>
                                    <div class="flex mb-2 space-x-2 text-sm text-gray-400">
                                        <span class="mx-1 mt-1 fas fa-money-bill-alt"></span>
                                        <p>{{ trans('development_interventions.cost') }}</p>
                                        <p>0</p>
                                        <p>{{ trans('interventions.riyal') }}</p>
                                    </div>
                                    <div class="border-t-2"></div>
                                    <div class="flex justify-between py-0">
                                        <div class="my-2">
                                            <div class="flex mt-2 space-x-2">
                                                <a href="{{ url('admin/' . Admin::user()->roles[0]->slug . '/' . $ints_status_url . '/' . $one_intervention_details->id) }}"
                                                    class="px-4 py-2 font-bold text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                                    {{ trans('development_interventions.details') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="my-2">
                                            <p class="mb-2 text-base font-semibold">
                                                {{ trans('development_interventions.total') }}</p>
                                            <div class="text-base font-semibold text-center text-gray-400">
                                                <p>0</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif --}}
            <!-- END Logistic Program-->
        </div>
    </div>
</div>
@endsection
