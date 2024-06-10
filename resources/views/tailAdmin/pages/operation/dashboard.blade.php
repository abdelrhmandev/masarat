@extends('tailAdmin.layout')

@section('title')
{{ trans('title.dashboard') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">{{ trans('title.dashboard') }}</h1>
@endsection

@section('content')
<div class="mt-4">
    <div class="flex flex-wrap gap-12 place-content-center mt-5">
        <div class="w-3/12">
            <a href="{{ url('admin/operation/interventions') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-indigo-400 to-indigo-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-indigo-300 ring-2 ring-indigo-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data h-8 w-6 text-white" viewBox="0 0 16 16">
                                <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z" />
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('development_interventions.title') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $partTransferApprovedCount }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="w-3/12">
            <a href="{{ url('admin/operation/hangged?count=10') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-fuchsia-400 to-fuchsia-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-fuchsia-300 ring-2 ring-fuchsia-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pause-btn h-8 w-6 text-white" viewBox="0 0 16 16">
                                <path d="M6.25 5C5.56 5 5 5.56 5 6.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C7.5 5.56 6.94 5 6.25 5zm3.5 0c-.69 0-1.25.56-1.25 1.25v3.5a1.25 1.25 0 1 0 2.5 0v-3.5C11 5.56 10.44 5 9.75 5z" />
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('navigation.hangged-list') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200"> {{ $hanggedIntsCaseCount }} </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="mb-8">
    <div class="flex flex-wrap -mx-3 gap-12 place-content-center mt-8">
        <div class="w-96 lg:w-1/3 xl:w-1/4 xl:mt-0 items-center text-center text-sm">
            <div class="min-w-full shadow sm:rounded-lg border-b border-gray-200 bg-white ">
                <div class="py-2 border-b border-gray-300">
                    <div class="text-gray-500">نسبة التدخلات المنفذة</div>
                </div>
                <div class="relative m-auto py-2 px-2">
                    <canvas width="100rem" height="250rem" id="chartPie1"></canvas>
                </div>
            </div>
        </div>

        <div class="w-96 lg:w-1/3 xl:w-1/4 xl:mt-0 items-center text-center text-sm">
            <div class="min-w-full shadow sm:rounded-lg border-b border-gray-200 bg-white ">
                <div class="py-2 border-b border-gray-300">
                    <div class="text-gray-500">نسبة التدخلات المنجزة</div>
                </div>
                <div class="relative m-auto py-2 px-2">
                    <canvas width="100rem" height="250rem" id="chartPie2"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js" integrity="e6nUZLBkQ86NJ6TVVKAeSaK8jWa3NhkYWZFomE39AvDbQWeie9PlQqM3pmYW5d1g" crossorigin="anonymous"></script>
<script>
    const dataPie1 = {
        labels: ["المنفذة", "بإنتظار التنفيذ"],
        datasets: [{
            label: "عدد الحالات بإنتظار التنفيذ مع عدد المنفذة",
            data: [{!! $executedCases_ratio !!}, {!! $waitExecuteCaseCount_ratio !!}],
            backgroundColor: [
                "#22c55e",
                "#f43f5e",
            ],
            hoverOffset: 4,
        }, ],
    };

    const configPie1 = {
        type: "doughnut",
        data: dataPie1,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'cairo',
                            color: 'black',
                            size: 11
                        }
                    }
                }
            },
        }
    };

    new Chart(document.getElementById("chartPie1").getContext("2d"), configPie1);

    const dataPie2 = {
        labels: ["العمول إجراء عليها", "بإنتظار التنفيذ"],
        datasets: [{
            label: "عدد الحالات بإنتظار التنفيذ مع عدد المنفذة",
            data: [{!! $wordkedCases_ratio !!}, {!! $waitExecuteCaseCount_ratio !!}],
            backgroundColor: [
                "#22c55e",
                "#f43f5e",
            ],
            hoverOffset: 4,
        }, ],
    };

    const configPie2 = {
        type: "doughnut",
        data: dataPie2,
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'cairo',
                            color: 'black',
                            size: 11
                        }
                    }
                }
            },
        }
    };

    new Chart(document.getElementById("chartPie2").getContext("2d"), configPie2);
</script>
@endsection