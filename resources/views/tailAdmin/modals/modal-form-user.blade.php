<div class="show-user-registration">
    <div class="fixed inset-0 z-10 hidden overflow-y-auto text-center user-modal" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <form method="POST" action="{{ route('admin.addUser') }}" enctype="multipart/form-data">
                    <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                        <div class="">
                            <div
                                class="flex items-center justify-center h-12 mx-auto text-white bg-indigo-600 rounded-sm grow">
                                <h3 class="text-lg font-medium leading-6" id="modal-title">
                                    {{ trans('users.sub_user.create') }}</h3>
                            </div>
                            <div class="mt-3">

                                {{ csrf_field() }}
                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="owner-name"
                                        class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.name') }}</label>
                                    <input name="name" type="text"
                                        oninvalid="this.setCustomValidity('يجب تدوين إسم المستخدم')"
                                        oninput="this.setCustomValidity('')"
                                        pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="contact-number"
                                        class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.email') }}</label>
                                    <input name="email" type="email"
                                        oninvalid="this.setCustomValidity('يجب كتابة البريد الإلكتروني')"
                                        oninput="this.setCustomValidity('')" autocomplete="email"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="contact-number"
                                        class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.phone') }}</label>
                                    <input name="phone" type="text" pattern="[0][5][0-9]{8}"
                                        oninvalid="this.setCustomValidity('يجب كتابة رقم جوال')"
                                        oninput="this.setCustomValidity('')" maxlength="10" autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="department"
                                        class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.department') }}</label>
                                    <select name="department"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm providers-dropdown">
                                        <option value="">-</option>
                                        <option value="development">الإدارة التنموية</option>
                                        <option value="partners">الشراكات</option>
                                        <option value="operation">التنفيذ</option>
                                    </select>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="department"
                                        class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.ints_visiability') }}</label>
                                    <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                        <input id="int_housing" name="int_housing" type="checkbox" role="switch"
                                            class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                        <label for="int_housing" class="block px-10 mr-2 text-sm text-gray-900">
                                            {{ trans('users.sub_user.int_housing') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                        <input id="int_direct" name="int_direct" type="checkbox" role="switch"
                                            class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                        <label for="int_direct" class="block px-10 mr-2 text-sm text-gray-900">
                                            {{ trans('users.sub_user.int_direct') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                        <input id="int_health" name="int_health" type="checkbox" role="switch"
                                            class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                        <label for="int_health" class="block px-10 mr-2 text-sm text-gray-900">
                                            {{ trans('users.sub_user.int_health') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                        <input id="int_job" name="int_job" type="checkbox" role="switch"
                                            class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                        <label for="int_job" class="block px-10 mr-2 text-sm text-gray-900">
                                            {{ trans('users.sub_user.int_job') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center col-span-6 py-2 sm:col-span-3">
                                        <input id="int_logistic" name="int_logistic" type="checkbox" role="switch"
                                            class="float-right h-5 -ml-10 align-top bg-white bg-gray-300 bg-no-repeat bg-contain rounded-full shadow-sm appearance-none cursor-pointer form-check-input w-9 focus:outline-none">
                                        <label for="int_logistic" class="block px-10 mr-2 text-sm text-gray-900">
                                            {{ trans('users.sub_user.int_logistic') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-span-6 py-2 sm:col-span-3">
                                    <label for="password"
                                        class="text-sm font-medium text-gray-700 ">{{ trans('users.sub_user.password') }}</label>
                                    <input name="password" type="password"
                                        oninvalid="this.setCustomValidity('يجب تدوين كلمة المرور')"
                                        oninput="this.setCustomValidity('')"
                                        pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z0-9 ]{3,30}" autocomplete="given-name"
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-6 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_add_text') }}</button>
                        <button type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm close-user-modal hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
