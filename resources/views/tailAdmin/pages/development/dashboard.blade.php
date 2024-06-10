@extends('tailAdmin.layout')
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/introjs.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('css/introjs-rtl.css') }}">
@endsection

@section('title')
{{ trans('title.dashboard') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">
    {{ trans('title.dashboard') }}
</h1>
@endsection

@section('content')
<div class="">
    <div class="flex flex-wrap gap-12 place-content-center">
        <div class="w-3/12">
            <a href="{{ url('admin/development/transferCase?count=10') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-blue-400 to-blue-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-blue-400 ring-2 ring-blue-300 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-white" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5.5 5h13a1 1 0 0 1 .5 1.5l-5 5.5l0 7l-4 -3l0 -4l-5 -5.5a1 1 0 0 1 .5 -1.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('dashboard.development.new-cases') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $submittedCaseCount }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="w-3/12">
            <a href="{{ url('admin/development/notCompleted?count=10') }}">
                <div class="pt-3 px-2 bg-gray-600 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center py-2 bg-gray-400 ring-2 ring-gray-300 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle h-8 w-6 text-white" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.146.146 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.163.163 0 0 1-.054.06.116.116 0 0 1-.066.017H1.146a.115.115 0 0 1-.066-.017.163.163 0 0 1-.054-.06.176.176 0 0 1 .002-.183L7.884 2.073a.147.147 0 0 1 .054-.057zm1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566z" />
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995z" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('dashboard.development.not-completed-cases') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $notCompletedCaseCount }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="flex flex-wrap gap-12 place-content-center mt-5">
        <div class="w-3/12">
            <a href="{{ url('admin/development/interventions') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-yellow-300 to-yellow-400 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-yellow-300 ring-2 ring-yellow-100 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-white" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <rect x="9" y="3" width="6" height="4" rx="2" />
                                <line x1="9" y1="12" x2="9.01" y2="12" />
                                <line x1="13" y1="12" x2="15" y2="12" />
                                <line x1="9" y1="16" x2="9.01" y2="16" />
                                <line x1="13" y1="16" x2="15" y2="16" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('dashboard.development.transfered-cases') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $transferedCaseCount }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="w-3/12">
            <a href="{{ url('admin/development/supported') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-pink-400 to-pink-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-pink-300 ring-2 ring-pink-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="15" y1="5" x2="15" y2="7" />
                                <line x1="15" y1="11" x2="15" y2="13" />
                                <line x1="15" y1="17" x2="15" y2="19" />
                                <path d="M5 5h14a2 2 0 0 1 2 2v3a2 2 0 0 0 0 4v3a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-3a2 2 0 0 0 0 -4v-3a2 2 0 0 1 2 -2" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('dashboard.development.supported-cases') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $supportedCaseCount }}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="w-3/12">
            <a href="{{ url('admin/development/returned') }}">
                <div class="bg-blue-600 pt-3 px-2 bg-gradient-to-b from-indigo-400 to-indigo-500 rounded-xl shadow-lg">
                    <div class="flex justify-center">
                        <div class="flex justify-center p-2 bg-indigo-300 ring-2 ring-indigo-200 rounded-lg shadow-xl w-32">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M9 13l-4 -4l4 -4m-4 4h11a4 4 0 0 1 0 8h-1" />
                            </svg>
                        </div>
                    </div>
                    <div class="p-4">
                        <p class="text-white font-semibold">{{ trans('dashboard.development.returned-cases') }}</p>
                        <div class="flex justify-between mt-2">
                            <p class="text-gray-200">{{ $returnedCaseCount }}</p>
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
                    <div class="text-gray-500">نسبة الحالات المكتمله</div>
                </div>
                <div class="relative m-auto py-2 px-2">
                    <canvas width="100rem" height="250rem" id="chartPie2"></canvas>
                </div>
            </div>
        </div>

        <div class="w-96 lg:w-1/3 xl:w-1/4 xl:mt-0 items-center text-center text-sm">
            <div class="min-w-full shadow sm:rounded-lg border-b border-gray-200 bg-white ">
                <div class="py-2 border-b border-gray-300">
                    <div class="text-gray-500">نسبة التدخلات المحولة</div>
                </div>
                <div class="relative m-auto py-2 px-2">
                    <canvas width="100rem" height="250rem" id="chartPie1"></canvas>
                </div>
            </div>
        </div>

        <div class="w-96 lg:w-1/3 xl:w-1/4 xl:mt-0 items-center text-center text-sm">
            <div class="min-w-full shadow sm:rounded-lg border-b border-gray-200 bg-white ">
                <div class="py-2 border-b border-gray-300">
                    <div class="text-gray-500">نسبة التدخلات المنفذة</div>
                </div>
                <div class="relative m-auto py-2 px-2">
                    <canvas width="100rem" height="250rem" id="chartPie3"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js" integrity="e6nUZLBkQ86NJ6TVVKAeSaK8jWa3NhkYWZFomE39AvDbQWeie9PlQqM3pmYW5d1g" crossorigin="anonymous"></script>
<script>
    const dataPie2 = {
        labels: ["المكتمله", "غير مكتملة"],
        datasets: [{
            label: "عدد الحالات المكتمله مع عدد الحالات غير المكتمله",
            data: [{!!$submittedCaseCount_ratio!!}, {!!$notCompletedCaseCount_ratio!!}],
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
                            size: 11,
                        }
                    }
                }
            },
        }
    };

    new Chart(document.getElementById("chartPie2").getContext("2d"), configPie2);

    const dataPie1 = {
        labels: ["المحولة", "المفروزة"],
        datasets: [{
            label: "عدد الحالات المفروزه مع عدد الحالات المحوله",
            data: [{!! $transferedCaseCount_ratio !!}, {!! $filteredCaseCount_ratio !!}],
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

    const dataPie3 = {
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

    const configPie3 = {
        type: "doughnut",
        data: dataPie3,
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

    new Chart(document.getElementById("chartPie3").getContext("2d"), configPie3);
</script>
<script src="{{ url('js/intro.js') }}"></script>
<script type="text/javascript">
    startTour();
    function startTour() {
        $("#sidebar").css('width','190');
        $("#sidebar").css('box-shadow','0 25px 50px -12px rgba(0, 0, 0, 0.25)'); 
        $("#sidebar").css('z-index','999');
        $("#sidebar #textIcon").css('opacity','1');
        $("#sidebar #textIcon").css('position', 'absolute');
        $("#sidebar #textIcon").css('transition','ease-in-out all 0.1s');

        // transferCase
        // interventions
        // supported
        // notCompleted
        // executed
        // returned
        // trackIntsExecution
        // stages
        // orphans
        // HistoryStages
        // approvedSupport
        // rejectedSupport
        // providers
        // hangged
        // HistoryRecords
        // objectives
        // orphans
        // dashboard
    
        introJs().setOptions({
            prevLabel: "السابق",
            nextLabel: "التالي",
            doneLabel: 'إتمام',
            dontShowAgain: true,
            skipLabel: "تخطي",
            showProgress: true,
            hidePrev: true,
            positionPrecedence: ["bottom", "top", "right", "left"],
            dontShowAgainLabel: "لا أود مشاهده الإرشادات ثانية", 
            steps: [
                {
                    element: '#transferCase',
                    intro: "من هنا سيعرض لك كل الأسر اللتي تدخلاتها أتت من كاشف وقد تم رفع بياناتها الإضافية من المستفيدين",
                    position: 'right',
                    highlightClass: 'transferCase',
                    tooltipClass:'test',           
                },
            ]
        }).start();    
    }
</script>
@endsection