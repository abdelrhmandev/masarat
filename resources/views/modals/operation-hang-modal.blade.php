<div class="show-hang-operation-modal">
    <div class="hang-operation-modal hidden fixed z-10 inset-0 overflow-y-auto text-center" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20  sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <form method="POST" action="{{ route('admin.operationDoHang') }}" enctype="multipart/form-data">
                    <input type="hidden" value="" name="form_id" id="hang-modal-action-form-id" />
                    <input type="hidden" value="" name="to_role" id="hang-modal-action-to-role" />
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div
                            class="flex grow mx-auto items-center justify-center h-12 rounded-full bg-indigo-600 text-white">
                            <svg class="h-6 w-6 gap-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-lg leading-6 font-medium" id="modal-title">
                                {{ trans('interventions.hang-case') }}</h3>
                        </div>
                        <div class="mt-3">
                            {{ csrf_field() }}
                            <div class="col-span-6 sm:col-span-3 py-2">
                                <label for="hang_reason"
                                    class=" text-sm font-medium text-gray-700">{{ trans('interventions.hang-reason') }}</label>
                                <select name="reason"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md providers-dropdown">
                                    <option value="">اختر</option>
                                    <option value="Approval">{{ trans('interventions.hang-approval') }}</option>
                                    <option value="Execution">{{ trans('interventions.hang-execution') }}</option>
                                    <option value="Customer">{{ trans('interventions.hang-beneficiary') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="col-span-6 sm:col-span-3 py-2">
                                <label for="hang_notes"
                                    class=" text-sm font-medium text-gray-700">{{ trans('interventions.hang-notes') }}</label>
                                <textarea id="hang_notes" oninvalid="this.setCustomValidity('يجب تدوين تفاصيل سبب رفض المستفيد للتدخل')"
                                    oninput="this.setCustomValidity('')"
                                    pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" name="hang_notes" rows="4"
                                    cols="50"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_add_text') }}</button>
                        <button type="button"
                            class="close-hang-operation-modal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
