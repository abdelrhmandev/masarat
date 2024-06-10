@extends('layouts.front')

@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/introjs.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('css/introjs-rtl.css') }}">

<style>
@supports (animation: grow .5s cubic-bezier(.25, .25, .25, 1) forwards) {
     .tick {
        stroke-opacity: 0;
        stroke-dasharray: 29px;
        stroke-dashoffset: 29px;
        animation: draw .5s cubic-bezier(.25, .25, .25, 1) forwards;
        animation-delay: .6s
    }
.circle {
        fill-opacity: 0;
        stroke: #219a00;
        stroke-width: 16px;
        transform-origin: center;
        transform: scale(0);
        animation: grow 1s cubic-bezier(.25, .25, .25, 1.25) forwards;   
    }   
}
@keyframes grow {
    60% {
        transform: scale(.8);
        stroke-width: 4px;
        fill-opacity: 0;
    }
    100% {
        transform: scale(.9);
        stroke-width: 8px;
        fill-opacity: 1;
        fill: #219a00;
    }
}
@keyframes draw {
    0%, 100% { stroke-opacity: 1; }
    100% { stroke-dashoffset: 0; }
}
</style>
@endsection
@section('template_title')
{{ trans('title.dashboard') }}
@endsection
@section('content')
@if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4)))
<div class="flex p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
    </svg>
    <span class="sr-only">Info</span>
    <div>
        عذراً لا يمكنك رفع البيانات إلا من خلال جهاز الكمبيوتر
    </div>
</div>
@else
<div class="show-when-confirmed selectors">
    <h2 class="font-extrabold tracking-tight text-gray-900 text-lg md:text-2xl mt-2 text-center mx-3 md:mx-0">
        <span class="block font-sm font-semibold">{{ trans('interventions.all-intervention') }}</span>
    </h2>
    <div class="max-w-7xl mx-auto px-5 md:px-6 lg:flex lg:items-center md:justify-center gap-5">
        <div class="flex flex-wrap" id="tabs-id">
            <div class="w-full">
                <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row" id="step1">
                    @php
                    $p1 = 0;
                    $p2 = 0;
                    $p3 = 0;
                    $p4 = 0;
                    $px1 = 'not_assigned';
                    $px2 = 'not_assigned';
                    $px3 = 'not_assigned';
                    $px4 = 'not_assigned';
                    $completed_ints = 0;
                    @endphp
                    @foreach ($forms as $parent_id => $intervention)
                    @foreach ($intervention as $x2 => $one_detailsX)
                    @if ($parent_id == 1)
                        @if ($one_detailsX->status > 1)
                        <?php $p1++; ?>
                        @endif
                    @elseif($parent_id == 2)
                        @if ($one_detailsX->status > 1)
                        <?php $p2++; ?>
                        @endif
                    @elseif($parent_id == 3)
                        @if ($one_detailsX->status > 1)
                        <?php $p3++; ?>
                        @endif
                    @elseif($parent_id == 4)
                        @if ($one_detailsX->status > 1)
                        <?php $p4++; ?>
                        @endif
                    @endif
                    @endforeach
                    <li class="-mb-px mr-2 last:mr-5 flex-auto text-center">
                        @if(isset($int_id))

                        <a href="{{ url('showInterventions/'.encrypt($id).'/'.encrypt($confirmation_code).'/'.encrypt($parent_id)) }}" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block 
                                leading-normal text-{{ $parent_id == $int_id ? 'white' : 'indigo' }} 
                                bg-{{ $parent_id == $int_id ? 'indigo-600' : 'white' }}">
                            @else
                            <a href="{{ url('showInterventions/'.encrypt($id).'/'.encrypt($confirmation_code).'/'.encrypt($parent_id)) }}" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-{{ $loop->first ? 'white' : 'indigo' }} bg-{{ $loop->first == 1 ? 'indigo-600' : 'white' }}">
                                @endif
                                @if ($parent_id == 1)
                                <i class="fa fa-home" aria-hidden="true"></i>
                                @elseif($parent_id == 2)
                                <i class="fa fa-arrow-up" aria-hidden="true"></i>
                                @elseif($parent_id == 3)
                                <i class="fa fa-user-md" aria-hidden="true"></i>
                                @elseif($parent_id == 4)
                                <i class="fa fa-user" aria-hidden="true"></i>
                                @endif
                                {{ $parent_ints[$parent_id] }}
                                @if ($parent_id == 1 && $p1 == count($intervention)) 
                                &nbsp;<i class="fas fa-check-circle" style="font-size:15px;color:@if (request()->get('int_id') == 1) white @else #0097a0 @endif"></i>
                                @php 
                                $px1 = 'completed';
                                @endphp 
                                @elseif($parent_id == 1 && $p1 <> count($intervention))
                                @php 
                                $px1 = 'not_completed';
                                @endphp                                 
                                @elseif($parent_id == 2 && $p2 == count($intervention))                                
                                &nbsp;<i class="fas fa-check-circle" style="font-size:15px;color:@if (request()->get('int_id') == 2) white @else #0097a0 @endif"></i>
                                @php 
                                $px2 = 'completed';
                                @endphp 
                                @elseif($parent_id == 2 && $p2 <> count($intervention))
                                @php 
                                $px2 = 'not_completed';
                                @endphp                                                                 
                                @elseif($parent_id == 3 && $p3 == count($intervention))
                                &nbsp;<i class="fas fa-check-circle" style="font-size:15px;color:@if (request()->get('int_id') == 3) white @else #0097a0 @endif"></i>
                                @php 
                                    $px3 = 'completed';
                                @endphp 
                                @elseif($parent_id == 3 && $p3 <> count($intervention))
                                @php 
                                    $px3 = 'not_completed';
                                @endphp 
                                
                                @elseif($parent_id == 4 && $p4 == count($intervention))
                                &nbsp;<i class="fas fa-check-circle" style="font-size:15px;color:@if (request()->get('int_id') == 4) white @else #0097a0 @endif"></i>
                                @php 
                                $px4 = 'completed';
                                @endphp 
                                @elseif($parent_id == 4 && $p4 <> count($intervention))
                                @php 
                                $px4 = 'not_completed';
                                @endphp                                                                 
                                @endif
                            </a>
                    </li>
                    @endforeach
                </ul>
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                    <div class="px-4 py-5 flex-auto">
                        <div class="tab-content tab-space">
                            @php $counter = 0; @endphp
                            @foreach ($forms as $parent_id => $intervention)
                            @if ($int_id)
                            <div class="{{ $parent_id == $int_id ? 'block' : 'hidden' }}" id="tab-{{ $parent_id }}">
                                @else
                                    <div class="{{ $loop->first  ? 'block' : 'hidden' }}" id="tab-{{ $parent_id }}">
                                    @endif
                                    @php $counter++; @endphp
                                    @include('forms.childIntervention')
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if($px1 == 'completed')
                    @if($px2 == 'completed' || $px2 == 'not_assigned')                        
                        @if($px3 == 'completed' || $px3 == 'not_assigned')
                            @if($px4 == 'completed' && $px4 == 'not_assigned')
                                @include('modals.completed-ints')
                             @endif                        
                        @endif
                    @endif
                @endif                 
                @if($px2 == 'completed')
                    @if($px1 == 'completed' || $px1 == 'not_assigned')                        
                        @if($px3 == 'completed' || $px3 == 'not_assigned')
                            @if($px4 == 'completed' && $px4 == 'not_assigned')
                              @include('modals.completed-ints')
                            @endif                        
                        @endif
                    @endif
                @endif                    
                @if($px3 == 'completed')
                    @if($px1 == 'completed' || $px1 == 'not_assigned')                        
                        @if($px2 == 'completed' || $px2 == 'not_assigned')
                            @if($px4 == 'completed' && $px4 == 'not_assigned')
                                 @include('modals.completed-ints')
                                @endif                        
                            @endif
                        @endif
                @endif
                @if($px4 == 'completed')
                            @if($px1 == 'completed' || $px1 == 'not_assigned')                        
                                    @if($px2 == 'completed' || $px2 == 'not_assigned')
                                        @if($px3 == 'completed' || $px3 == 'not_assigned')
                                            @include('modals.completed-ints')
                                        @endif                        
                                    @endif
                            @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endif

@include('modals.general-modal')
@include('modals.validation-filesize-modal')
@endsection
@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
<script src="{{ url('js/intro.js') }}"></script>
<script type="text/javascript">
    @if(isset($int_id) && !preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $_SERVER['HTTP_USER_AGENT']) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($_SERVER['HTTP_USER_AGENT'], 0, 4)))
    @if($int_id == 1) startTours('housing', 'من هنا يمكنك رفع بياناتك من خلال الضغط على المربع والبدء بملئ المعلومات المطلوبة');
    @endif
    @if($int_id == 2) startTours('dept');
    @endif
    @if($int_id == 3) startTours('health');
    @endif
    @if($int_id == 4) startTours('job');
    @endif
    @endif
    function startTours(step, msg = null) {
        var message = 'من هنا يمكنك رفع بيانات للفرد الأول من عائلتك والضغط على زر رفع البيانات';
        if (msg) {
            var message = msg;
        }
        introJs().setOptions({
                prevLabel: "السابق",
                nextLabel: "التالي",
                doneLabel: 'إنهاء',
                dontShowAgain: true,
                skipLabel: "تخطي",
                showProgress: true,
                hidePrev: true,
                positionPrecedence: ["bottom", "top", "right", "left"],
                dontShowAgainLabel: "لا أود مشاهدة الإرشادات ثانيةً",
                steps: [{
                    element: '#step1',
                    intro: "يمكنك التنقل ما بين التدخلات الرئيسية عن طريق الضغط عليها والبدء في رفع البيانات المطلوبة منكم",
                    tooltipClass: 'customTooltipints'
                }, {
                    element: '#step_' + step,
                    intro: message,
                    tooltipClass: 'customTooltipintsfamily'
                }, ],
            })
            .start();
    }
// POP MODAL COMPLETED INTS
let path = document.querySelector(".tick");
let length = path.getTotalLength();
</script>
@endsection