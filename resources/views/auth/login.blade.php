<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo __('title.title') . ' | ' . __('credentials.login.sign-in'); ?>
    </title>
    <link href="{{ asset('tailwindcss/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ url('img/masarat_logo_text_1.svg') }}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700&display=swap" rel="stylesheet">
</head>

<body class="flex flex-col h-screen justify-between bg-gray-50 font-cairo">
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <img class="mx-auto h-64 w-auto" src="{{ url('img/masarat_logo_text_1.svg') }}" alt="Workflow">
                <h2 class="mt-6 text-center text-3xl">
                    {{-- @if ($errors)
                    <small class="help-block">{{ $errors }}</small>
                    @endif --}}
                </h2>
            </div>

            <form class="mt-8 space-y-6" action="{{ url('/admin/auth/login') }}" method="POST">
                @csrf
                <input type="hidden" name="remember" value="true">
                <div class="rounded-md shadow-sm -space-y-px mt-4">
                    <div>
                        <label for="email-address" class="sr-only">
                            <?php echo __('credentials.login.email'); ?>
                        </label>
                        <input id="email-address" name="email" value="{{ old('email') }}" type="email"
                            oninvalid="this.setCustomValidity('يجب إدخال إيميلك بشكل صحيح')" oninput="this.setCustomValidity('')"
                            autocomplete="email" required autofocus
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="<?php echo __('credentials.login.email'); ?>">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong class="text-red-600">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div>
                        <label for="password" class="sr-only">
                            <?php echo __('credentials.main.password'); ?>
                        </label>
                        <input id="password" name="password" type="password"
                            oninvalid="this.setCustomValidity('يجب إدخال كلمة السر')"
                            oninput="this.setCustomValidity('')" autocomplete="current-password" required
                            class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="<?php echo __('credentials.login.password'); ?>">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong class="text-red-600">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        @if ($errors->has('active'))
                            <span class="invalid-feedback">
                                <strong class="text-red-600">{{ $errors->first('active') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                            <?php echo __('credentials.login.remember-me'); ?>
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            <?php echo __('credentials.login.forget-password'); ?>
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <?php echo __('credentials.login.sign-in'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
