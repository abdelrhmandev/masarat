@extends('layouts.front')
@section('head')
<link href="{{ asset('tailwindcss/one-tracking-style.css') }}" rel="stylesheet">  
@endsection

@section('template_title')
{{ trans('title.dashboard') }}
@endsection

@section('content')
<div class="flex flex-col justify-center my-4">
    <div class="w-full mx-auto lg:max-w-4xl">
        <div class="relative">
            <div class="flex justify-center">
                <button type="submit" class="font-bold items-center cursor-default justify-center px-14 py-2 border border-transparent text-base rounded-md text-white bg-[#0097a0]">
                    نوع التدخل : {{ $trackdata[0]->name_ar }}
                </button>
            </div>
            <div class="flex justify-center py-2">
                <button type="submit" class="font-bold items-center cursor-default justify-center px-24 py-2 border border-transparent text-base rounded-md text-white bg-[#0097a0]">
                    اسم المستفيد : {{ $pen_name[0]->pen_name }}
                </button>
            </div>
            <!-- Vertical middle line-->
            <div class="space-y-12 lg:space-y-8">
                <div class="absolute hidden w-px h-[18rem] transform -translate-x-1/2 bg-indigo-300 lg:block left-1/2">
                </div>
                <div class="flex justify-center py-0">
                    <img width="50rem" height="50rem" src="{{ url('icons/start.svg') }}" alt="{{ url('icons/start.svg') }}" />
                </div>
                @foreach ($trackdata as $onetrack)
                @if ($loop->index % 2 == 0)
                <!-- Left section -->
                <div class="absolute hidden w-px h-[15rem] transform -translate-x-1/2 bg-indigo-300 lg:block left-1/2">
                </div>
                <div>
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-start w-full mx-auto">
                            <div class="w-full lg:w-1/2 lg:pr-8">
                                <div class="p-4 bg-white rounded shadow-lg shadow-cyan-300">
                                    <p class="font-bold text-center p-2">{{ $onetrack->comment }}</p>
                                    <p class="font-bold text-center p-2">في التاريخ :
                                        {{ \Carbon\Carbon::parse($onetrack->updated_at)->format('Y/m/d') }}
                                    </p>
                                    <p class="font-bold text-center p-2">وفي الساعه :
                                        {{ \Carbon\Carbon::parse($onetrack->updated_at)->format('h:i:s A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute flex items-center justify-center w-14 h-14 transform -translate-x-1/2 -translate-y-6 rounded-full left-1/2 sm:translate-y-16">
                            @if ($onetrack->status_id == 2)
                            <img width="150rem" height="150rem" src="{{ url('icons/fill_data.svg') }}" alt="{{ url('icons/fill_data.svg') }}" />  
                            @elseif ($onetrack->status_id == 3)
                            <img width="150rem" height="150rem" src="{{ url('icons/filter_ints.svg') }}" alt="{{ url('icons/filter_ints.svg') }}" />
                            @elseif ($onetrack->status_id == 14 || $onetrack->status_id == 15)
                            <img width="150rem" height="150rem" src="{{ url('icons/approval.svg') }}" alt="{{ url('icons/approval.svg') }}" />
                            @elseif ($onetrack->status_id == 9)
                            <img width="150rem" height="150rem" src="{{ url('icons/gear_negative.svg') }}" alt="{{ url('icons/gear_negative.svg') }}" />
                            @elseif ($onetrack->status_id == 6)
                            <img width="150rem" height="150rem" src="{{ url('icons/cyber-security.svg') }}" alt="{{ url('icons/cyber-security.svg') }}" />
                            @elseif ($onetrack->status_id == 7)
                            <img width="150rem" height="150rem" src="{{ url('icons/director_approval.svg') }}" alt="{{ url('icons/director_approval.svg') }}" />
                            @elseif ($onetrack->status_id == 8)
                            <img width="150rem" height="150rem" src="{{ url('icons/gear_positive.svg') }}" alt="{{ url('icons/gear_positive.svg') }}" />
                            @elseif ($onetrack->status_id == 4)
                            <img width="150rem" height="150rem" src="{{ url('icons/partners.svg') }}" alt="{{ url('icons/partners.svg') }}" />
                            @elseif ($onetrack->status_id == 6 || $onetrack->status_id == 3)
                            <img width="150rem" height="150rem" src="{{ url('icons/rejected.svg') }}" alt="{{ url('icons/rejected.svg') }}" />
                            @elseif ($onetrack->status_id == 10)
                            <img width="150rem" height="150rem" src="{{ url('icons/temporary.svg') }}" alt="{{ url('icons/temporary.svg') }}" />
                            @elseif ($onetrack->status_id == 5)
                            <img width="150rem" height="150rem" src="{{ url('icons/work-in-progress.svg') }}" alt="{{ url('icons/work-in-progress.svg') }}" />
                            @elseif ($onetrack->status_id == 11)
                            <img width="150rem" height="150rem" src="{{ url('icons/coin_refuse.svg') }}" alt="{{ url('icons/coin_refuse.svg') }}" />
                            @elseif ($onetrack->status_id == 13)
                            <img width="150rem" height="150rem" src="{{ url('icons/coin_accepted.svg') }}" alt="{{ url('icons/coin_accepted.svg') }}" />
                            @elseif ($onetrack->status_id == 16 || $onetrack->status_id == 17)
                            <img width="150rem" height="150rem" src="{{ url('icons/rejected.svg') }}" alt="{{ url('icons/rejected.svg') }}" />
                            @else
                            <img width="150rem" height="150rem" src="{{ url('icons/empty.svg') }}" alt="{{ url('icons/refuse.svg') }}" />
                            @endif
                        </div>
                    </div>
                </div>
                @else
                <!-- Right section -->
                <div class="absolute hidden w-px h-[15rem] transform -translate-x-1/2 bg-indigo-300 lg:block left-1/2">
                </div>
                <div>
                    <div class="flex flex-col items-center">
                        <div class="flex items-center justify-end w-full mx-auto">
                            <div class="w-full lg:w-1/2 lg:pl-8">
                                <div class="p-4 bg-white rounded shadow-lg shadow-red-300">
                                    <p class="font-bold text-center p-2">{{ $onetrack->comment }}</p>
                                    <p class="font-bold text-center p-2">في التاريخ :
                                        {{ \Carbon\Carbon::parse($onetrack->updated_at)->format('Y/m/d') }}
                                    </p>
                                    <p class="font-bold text-center p-2">وفي الساعه :
                                        {{ \Carbon\Carbon::parse($onetrack->updated_at)->format('h:i:s A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="absolute flex items-center justify-center w-14 h-14 transform -translate-x-1/2 -translate-y-6 rounded-full left-1/2 sm:translate-y-16">
                            @if ($onetrack->status_id == 2)
                            <img width="150rem" height="150rem" src="{{ url('icons/fill_data.svg') }}" alt="{{ url('icons/fill_data.svg') }}" />
                            @elseif ($onetrack->status_id == 3)
                            <img width="150rem" height="150rem" src="{{ url('icons/filter_ints.svg') }}" alt="{{ url('icons/filter_ints.svg') }}" />     
                            @elseif ($onetrack->status_id == 14 || $onetrack->status_id == 15)
                            <img width="150rem" height="150rem" src="{{ url('icons/approval.svg') }}" alt="{{ url('icons/approval.svg') }}" />
                            @elseif ($onetrack->status_id == 9)
                            <img width="150rem" height="150rem" src="{{ url('icons/gear_negative.svg') }}" alt="{{ url('icons/gear_negative.svg') }}" />
                            @elseif ($onetrack->status_id == 6)
                            <img width="150rem" height="150rem" src="{{ url('icons/cyber-security.svg') }}" alt="{{ url('icons/cyber-security.svg') }}" />
                            @elseif ($onetrack->status_id == 7)
                            <img width="150rem" height="150rem" src="{{ url('icons/director_approval.svg') }}" alt="{{ url('icons/director_approval.svg') }}" />
                            @elseif ($onetrack->status_id == 8)
                            <img width="150rem" height="150rem" src="{{ url('icons/gear_positive.svg') }}" alt="{{ url('icons/gear_positive.svg') }}" />
                            @elseif ($onetrack->status_id == 4)
                            <img width="150rem" height="150rem" src="{{ url('icons/partners.svg') }}" alt="{{ url('icons/partners.svg') }}" />
                            @elseif ($onetrack->status_id == 6 || $onetrack->status_id == 3)
                            <img width="150rem" height="150rem" src="{{ url('icons/rejected.svg') }}" alt="{{ url('icons/rejected.svg') }}" />
                            @elseif ($onetrack->status_id == 10)
                            <img width="150rem" height="150rem" src="{{ url('icons/temporary.svg') }}" alt="{{ url('icons/temporary.svg') }}" />
                            @elseif ($onetrack->status_id == 5)
                            <img width="150rem" height="150rem" src="{{ url('icons/work-in-progress.svg') }}" alt="{{ url('icons/work-in-progress.svg') }}" />
                            @elseif ($onetrack->status_id == 13)
                            <img width="150rem" height="150rem" src="{{ url('icons/coin_accepted.svg') }}" alt="{{ url('icons/coin_accepted.svg') }}" />
                            @elseif ($onetrack->status_id == 11)
                            <img width="150rem" height="150rem" src="{{ url('icons/coin_refuse.svg') }}" alt="{{ url('icons/coin_refuse.svg') }}" />
                            @elseif ($onetrack->status_id == 16 || $onetrack->status_id == 17)
                            <img width="150rem" height="150rem" src="{{ url('icons/exe_reject.svg') }}" alt="{{ url('icons/exe_reject.svg') }}" />
                            @else
                            <img width="150rem" height="150rem" src="{{ url('icons/empty.svg') }}" alt="{{ url('icons/refuse.svg') }}" />
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                <div class="flex justify-center py-10">
                    <img width="50rem" height="50rem" src="{{ url('icons/finish.svg') }}" alt="{{ url('icons/finish.svg') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
