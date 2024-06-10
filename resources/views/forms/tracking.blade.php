@extends('layouts.front')
@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/introjs.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('css/introjs-rtl.css') }}">
@endsection

@section('template_title')
{{ trans('title.dashboard') }}
@endsection

@section('content')
<div class="mx-1 mt-4 md:mt-4 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all border border-gray-200">
    <form method="GET" action="{{ url('tracking') }}">
        <div class="lg:text-center mt-[5%] md:mt-[2%]">
            <p class="text-xl md:text-3xl leading-8 font-semibold tracking-tight text-gray-900 flex justify-center items-center">
                {{ trans('home.masarat') }}
            </p>
        </div>

        <input type="hidden" name="customer" value="{{ $_COOKIE['XSRF-TOKEN'] ?? '' }}" />
        <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-md font-extrabold tracking-tight text-gray-900 md:text-2xl py-2 text-center md:text-right">
                <span class="font-semibold hidden md:block">{{ trans('home.welcome') }}</span>
                <span class="block text-indigo-600 font-semibold">{{ trans('home.chacktraking') }}</span>
            </h2>
        </div>

        <div id="step1">
            <div class="max-w-7xl mx-auto px-4 lg:px-8 sm:px-6">
                <label for="id-value" class="text-sm md:text-xl font-medium text-gray-700 md:block">{{ trans('home.id') }}</label>
                <input type="text" oninvalid="this.setCustomValidity('رقم الهوية غير صحيح')" oninput="this.setCustomValidity('')" pattern="[12][0-9]{9}" maxlength="10" value="{{ Request::get('id') ?? '' }}" name="id" placeholder="مثال : 1*********" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-80 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>
            <div class="max-w-7xl mx-auto px-4 lg:px-8 sm:px-6 py-2">
                <label for="confirmation-code" class="text-sm md:text-xl font-medium text-gray-700 md:block">{{ trans('home.confirmation-code') }}</label>
                <input type="text" oninvalid="this.setCustomValidity('كود التحقق')" oninput="this.setCustomValidity('')" pattern="[0-9]{4}" maxlength="4" value="{{ Request::get('confirmation_code') ?? '' }}" name="confirmation_code" placeholder="مثال : 1***" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-80 shadow-sm sm:text-sm border-gray-300 rounded-md" required>
            </div>
        </div>


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4 lg:flex mb-14 gap-4">
            <div id="step2">
                <div class="rounded-md shadow my-2 md:my-0">
                    <button type="submit" class="grid items-center justify-center px-16 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 sm:mt-4 lg:mt-0 w-full">{{ trans('home.traking') }}</button>
                </div>
            </div>
        </div>


        
    </form>
</div>
@endsection

@section('footer_scripts')
<script src="{{ url('js/intro.js') }}"></script>
<script type="text/javascript">
 startTour();
 function startTour() {
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
            element: '#step1',
            intro: "لتتبع تنفيذ التدخلات الخاصة بكم الرجاء إدخال رقم الهوية وكود التحقق.",
            tooltipClass: 'customTooltip'
         },
         {
            element: '#step2',
            intro: "إضغط علي زر تأكيد",
            tooltipClass: 'customTooltip2'
         },
      ]
 }).start();    
}
</script>
@endsection