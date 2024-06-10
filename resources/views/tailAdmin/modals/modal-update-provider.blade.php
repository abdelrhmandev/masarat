<div class="show-provider-registration">
    <div class="edit-provider-modal hidden fixed z-10 inset-0 overflow-y-auto text-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20  sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left'}}">
                <form method="POST" action="{{ route('admin.updateProvider') }}" enctype="multipart/form-data">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class=" ">
                            <div class="flex grow mx-auto items-center justify-center h-12 rounded-sm bg-indigo-600 text-white">
                                <h3 class="text-lg leading-6 font-medium" id="modal-title">{{ trans('providers.sub_provider.update') }}</h3>
                            </div>
                            <div class="mt-3">

                                {{ csrf_field() }}
                                <input id="id" name="id" type="hidden">

                                <div class="col-span-6 sm:col-span-3 py-2">
                                    <label for="name" class=" text-sm font-medium text-gray-700">{{ trans('providers.sub_provider.partner_name') }}</label>
                                    <input id="name" name="name" type="text" oninvalid="this.setCustomValidity('يجب تدوين إسم الشريك')" oninput="this.setCustomValidity('')" pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 bg-gray-300 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" disabled>
                                </div>

                                <div class="col-span-6 sm:col-span-3 py-2">
                                    <label for="person_name" class=" text-sm font-medium text-gray-700">{{ trans('providers.sub_provider.on_behave_name') }}</label>
                                    <input id="person_name" name="person_name" type="text" oninvalid="this.setCustomValidity('يجب تدوين إسم المفوض')" oninput="this.setCustomValidity('')" pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="col-span-6 sm:col-span-3 py-2">
                                    <label for="phone" class=" text-sm font-medium text-gray-700">{{ trans('providers.sub_provider.phone') }}</label>
                                    <input id="phone" name="phone" type="text" pattern="[0][5][0-9]{8}" oninvalid="this.setCustomValidity('يجب كتابة رقم جوال المفوض')" oninput="this.setCustomValidity('')" maxlength="10" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="col-span-6 sm:col-span-3 py-2">
                                    <label for="email" class=" text-sm font-medium text-gray-700">{{ trans('providers.sub_provider.email') }}</label>
                                    <input id="email" name="email" type="email" oninvalid="this.setCustomValidity('يجب كتابة البريد الإلكتروني')" oninput="this.setCustomValidity('')" autocomplete="email" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="col-span-6 sm:col-span-3 py-2">
                                    <label for="full_address" class=" text-sm font-medium text-gray-700">{{ trans('providers.sub_provider.address') }}</label>
                                    <textarea id="full_address" name="full_address" oninvalid="this.setCustomValidity('يجب تدوين عنوان الشريك بشكل كامل')" oninput="this.setCustomValidity('')" pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" rows="4" cols="50" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_update_text') }}</button>
                        <button type="button" class="close-edit-Provider-modal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>