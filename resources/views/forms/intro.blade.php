@section('head')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.7.0/introjs.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('css/introjs-rtl.css') }}">
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
            intro: "الرجاء ادخال رقم الهويه و كود التحقق المرسل إلى جوالك سابقاً.",
            tooltipClass: 'customTooltip'
         },
         {
            element: '#step2',
            intro: "بعد إدخال البيانات المطلوبة الرجاء الضغط على زر تأكيد",
            tooltipClass: 'customTooltip2'
         },
      ]
 }).start();    
}
</script>
@endsection