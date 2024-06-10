@extends('tailAdmin.layout')

@section('title')
{{ trans('title.transferCase') }}
@endsection

@section('header_title')
<h1 class="ml-8 mb-4 text-2xl font-semibold underline underline-offset-8 decoration-indigo-600 text-indigo-400">
    {{ trans('navigation.change-password') }}
</h1>
@endsection

@section('content')
<div class="border rounded-lg">
    <form action="{{ url('admin/auth/changePassword') }}" method="POST">
        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4 border rounded-lg">
            <div class="">
                <div class="flex items-center justify-center h-12 mx-auto text-white bg-indigo-600 rounded-md grow">
                    <h3 class="text-lg font-medium leading-6" id="modal-title">
                        {{ trans('users.sub_user.changepasswordtitle') }}
                    </h3>
                </div>
                <div class="mt-3">
                    {{ csrf_field() }}

                    <div class="col-span-6 py-2 sm:col-span-3">
                        <label for="currentpassword" class="text-sm font-medium text-gray-700 ">
                            {{ trans('users.sub_user.currentpassword') }}</label>
                        <input id="current_password" name="current_password" type="password" oninvalid="this.setCustomValidity('يجب تدوين كلمه المرور')" oninput="this.setCustomValidity('')" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @if ($errors->has('current_password'))
                        <span class="invalid-feedback">
                            <strong class="text-red-600">{{ $errors->first('current_password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-span-6 py-2 sm:col-span-3">
                        <label for="password" class="text-sm font-medium text-gray-700 ">
                            {{ trans('users.sub_user.newpassword') }}</label>
                        <input id="password" name="password" type="password" oninvalid="this.setCustomValidity('يجب تدوين كلمه المرور')" oninput="this.setCustomValidity('')" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong class="text-red-600">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-span-6 py-2 sm:col-span-3">
                        <label for="confirm_password" class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.confirmnewpassword') }}</label>
                        <input id="confirm_password" name="confirm_password" type="password" oninvalid="validatePassword()" oninput="validatePassword('')" autocomplete="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        @if ($errors->has('confirm_password'))
                        <span class="invalid-feedback">
                            <strong class="text-red-600">{{ $errors->first('confirm_password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="submit" class="inline-flex justify-center w-full px-6 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_update_text') }}</button>
            <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm close-change-password-modal hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
        </div>
    </form>
</div>
@endsection

@section('footer_scripts')
<script src="{{ url('js/password/app.js') }}"></script>
@endsection