<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('img/masarat_logo_text_1.svg') }}">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?php echo __('title.title') . ' | ' . __('title.dashboard'); ?></title>
    <link href="{{ asset('tailwindcss/app.css') }}" rel="stylesheet">    
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700&display=swap" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" rel="stylesheet" />
    
    {{-- Scripts --}}
    <script>
        /*window.Laravel = {
                !!json_encode([
                    'csrfToken' => csrf_token(),
                ]) !!
            };*/
    </script>

    @yield('head')
</head>

<body class="flex flex-col justify-between font-cairo bg-gray-100 min-h-full">
    <div id="app">
        <header class="flex justify-between items-center px-10 shadow mb-1 gap-10 bg-gray-50">
            @include('includes.header')
        </header>

        <div class="flex flex-grow inline-block bg-gray-100">
            <div class="flex flex-col flex-grow justify-center items-center">
                <div class="container">
                    <div class="row">
                        @include('partials.form-status') 
                        @yield('content') 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="gap-10 bg-gray-50 shadow shadow-inner mt-6">
        @include('includes.footer')
    </footer>

    {{-- Scripts --}}
    <script src="{{ url('js/bootstrapapp.js') }}"></script>
    <script src="{{ url('js/customerNotification/app.js') }}"></script>
    <script src="{{ url('/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js" integrity="sha384-7vle1l9QBp6uqpUFnKtUs8o9N+496JLs69wvSCIYi8eDNea1SyU8Sc79THFabI9C" crossorigin="anonymous"></script>
    @yield('footer_scripts')
</body>

</html>