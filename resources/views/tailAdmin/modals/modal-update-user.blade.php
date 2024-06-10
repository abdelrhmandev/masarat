<div class="show-user-registration">
    <div class="fixed inset-0 z-10 hidden overflow-y-auto text-center edit-user-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <form method="POST" action="{{ route('admin.updateUser') }}" enctype="multipart/form-data">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="">
                            <div class="flex items-center justify-center h-12 mx-auto text-white bg-indigo-600 rounded-sm grow">
                                <h3 class="text-lg font-medium leading-6" id="modal-title">
                                    {{ trans('users.sub_user.update') }}
                                </h3>
                            </div>
                            <div class="mt-3">

                                {{ csrf_field() }}
                                <input id="id" name="id" type="hidden">
                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="email" class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.email') }}</label>
                                    <input id="email" name="email" type="email" oninvalid="this.setCustomValidity('يجب كتابة البريد الإلكتروني')" oninput="this.setCustomValidity('')" autocomplete="email" class="block w-full mt-1 bg-gray-300 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" disabled>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="name" class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.name') }}</label>
                                    <input id="name" name="name" type="text" oninvalid="this.setCustomValidity('يجب تدوين إسم المستخدم')" oninput="this.setCustomValidity('')" pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" autocomplete="given-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="phone" class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.phone') }}</label>
                                    <input id="phone" name="phone" type="text" pattern="[0][5][0-9]{8}" oninvalid="this.setCustomValidity('يجب كتابة رقم جوال المفوض')" oninput="this.setCustomValidity('')" maxlength="10" autocomplete="given-name" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>

                                <?php if (sizeof($users) !== 0) { ?>
                                    <div class="col-span-6 py-2 sm:col-span-3">
                                        <label for="department" class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.department') }}</label>
                                        <select id="department" name="department" class="form-select appearance-none
                                w-full
                                py-1.5
                                font-normal
                                text-gray-700
                                bg-white bg-clip-padding bg-no-repeat
                                border border-solid border-gray-300
                                rounded
                                transition
                                ease-in-out" aria-label="Default select example">
                                            <option value="">-</option>
                                            <option @if ($user->department == 'development') {{ 'selected="selected"' }} @endif
                                                value="development">الإدارة التنموية</option>
                                            <option @if ($user->department == 'partners') {{ 'selected="selected"' }} @endif
                                                value="partners">الشراكات</option>
                                            <option @if ($user->department == 'operation') {{ 'selected="selected"' }} @endif
                                                value="operation">التنفيذ</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 py-2 sm:col-span-3">
                                        <label for="department" class="text-sm font-medium text-gray-700">{{ trans('users.sub_user.ints_visiability') }}</label>
                                        <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                            <input id="ints_housing" name="ints_housing" type="checkbox" class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                            <label for="ints_housing" class="block px-10 mr-2 text-sm text-gray-900">
                                                {{ trans('users.sub_user.int_housing') }}
                                            </label>
                                        </div>

                                        <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                            <input id="ints_direct" name="ints_direct" type="checkbox" class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                            <label for="ints_direct" class="block px-10 mr-2 text-sm text-gray-900">
                                                {{ trans('users.sub_user.int_direct') }}
                                            </label>
                                        </div>

                                        <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                            <input id="ints_health" name="ints_health" type="checkbox" role="switch" class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                            <label for="ints_health" class="block px-10 mr-2 text-sm text-gray-900">
                                                {{ trans('users.sub_user.int_health') }}
                                            </label>
                                        </div>

                                        <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                            <input id="ints_job" name="ints_job" type="checkbox" role="switch" class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                            <label for="ints_job" class="block px-10 mr-2 text-sm text-gray-900">
                                                {{ trans('users.sub_user.int_job') }}
                                            </label>
                                        </div>

                                        <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                            <input id="ints_logistic" name="ints_logistic" type="checkbox" role="switch" class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                            <label for="ints_logistic" class="block px-10 mr-2 text-sm text-gray-900">
                                                {{ trans('users.sub_user.int_logistic') }}
                                            </label>
                                        </div>
                                        <label for="department" class="text-sm font-medium text-gray-700">{{ trans('users.sub_user.statusactive') }}</label>
                                        <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                            <select id="active" name="active" class="form-select appearance-none
                                    w-full
                                    py-1.5
                                    font-normal
                                    text-gray-700
                                    bg-white bg-clip-padding bg-no-repeat
                                    border border-solid border-gray-300
                                    rounded
                                    transition
                                    ease-in-out
                                    " aria-label="Default select example">
                                                <option value="">-</option>
                                                <option @if ($user->active == '1') {{ 'selected="selected"' }} @endif
                                                    value="1">{{ trans('users.sub_user.activeted') }}</option>
                                                <option @if ($user->active == '0') {{ 'selected="selected"' }} @endif
                                                    value="0">{{ trans('users.sub_user.deactiveted') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="inline-flex justify-center w-full px-6 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_update_text') }}</button>
                        <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm close-edit-user-modal hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="fixed inset-0 z-10 hidden overflow-y-auto text-center change-password-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <form method="POST" action="{{ route('admin.updateUserPassword') }}" enctype="multipart/form-data">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="">
                            <div class="flex items-center justify-center h-12 mx-auto text-white bg-indigo-600 rounded-sm grow">
                                <h3 class="text-lg font-medium leading-6" id="modal-title">
                                    {{ trans('users.sub_user.changepasswordtitle') }}
                                </h3>
                            </div>
                            <div class="mt-3">

                                {{ csrf_field() }}
                                <input id="ids" name="id" value="" type="hidden">

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="password" class="text-sm font-medium text-gray-700 ">
                                        {{ trans('users.sub_user.newpassword') }}</label>
                                    <input id="password" name="password" type="password" oninvalid="this.setCustomValidity('يجب تدوين كلمه المرور')" oninput="this.setCustomValidity('')" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="confirm_password" class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.confirmnewpassword') }}</label>
                                    <input id="confirm_password" name="confirm_password" type="password" oninvalid="validatePassword()" oninput="validatePassword('')" autocomplete="email" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
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
        </div>
    </div>

</div>
<script>
    var password = document.getElementById("password"),
        confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (confirm_password.value && password.value != confirm_password.value) {
            confirm_password.setCustomValidity("كلمه المرور غير متطابقه");
        } else if (!confirm_password.value) {
            confirm_password.setCustomValidity('يجب اعاده تدوين كلمه المرور');
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>