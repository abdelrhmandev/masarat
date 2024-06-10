<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ url('img/masarat_logo_text_1.svg') }}">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?php echo __('title.title') . ' | '; ?>@yield('title')</title>
    <link href="{{ asset('tailwindcss/app.css') }}" rel="stylesheet" />
    <link href="{{ url('tailwindcss/custom-style.css') }}" type="text/css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700&display=swap" rel="stylesheet" />
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

<body id="scrollbar" class="min-h-screen bg-gray-50 font-cairo">
    <nav id="sidebar" class="h-screen w-16 menu bg-gray-50 text-white px-3 flex items-center static fixed shadow">
        @include('tailAdmin.includes.navigation')
    </nav>
    <header id="header" class="flex justify-between items-center px-10 shadow mb-1 gap-10 bg-gray-50">
        @include('tailAdmin.includes.header')
    </header>

    <div class="w-full pr-16 bg-gray-100 pt-6">
        <div class="mx-auto w-full bg-gray-100 ">
            <div class="flex flex-col flex-grow mr-8 ml-8 min-h-screen">
                @include('partials.form-status')
                @yield('header_title')
                @yield('content')
            </div>
        </div>

        <form id="transferIdsFormToExport" method="POST" action="{{ url('admin/partners/ints/Export') }}">
            @csrf
        </form>

        <form id="transferIdsForm" method="POST" action="{{ url('admin/development/intsTransfer') }}">
            @csrf
        </form>
    </div>

    <footer class="bg-gray-50 shadow shadow-inner">
        @include('tailAdmin.includes.footer')
    </footer>

    {{-- Scripts --}}
    <script src="{{ url('js/nav&url/app.js') }}"></script>
    <script src="{{ url('/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js" integrity="sha384-7vle1l9QBp6uqpUFnKtUs8o9N+496JLs69wvSCIYi8eDNea1SyU8Sc79THFabI9C" crossorigin="anonymous"></script>
    @yield('footer_scripts')
</body>

</html>