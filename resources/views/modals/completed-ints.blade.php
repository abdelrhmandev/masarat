<div class="show-CompletedInts">
    <div class="CompletedInts-modal hidden fixed z-10 inset-0 overflow-y-auto text-center" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="">
                        <div
                            class="flex items-center justify-center h-12 mx-auto text-white bg-indigo-600 rounded-full grow">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30"
                                height="30" viewBox="0 0 40 40">
                                <path fill="#bae0bd"
                                    d="M20,38.5C9.799,38.5,1.5,30.201,1.5,20S9.799,1.5,20,1.5S38.5,9.799,38.5,20S30.201,38.5,20,38.5z">
                                </path>
                                <path fill="#5e9c76"
                                    d="M20,2c9.925,0,18,8.075,18,18s-8.075,18-18,18S2,29.925,2,20S10.075,2,20,2 M20,1 C9.507,1,1,9.507,1,20s8.507,19,19,19s19-8.507,19-19S30.493,1,20,1L20,1z">
                                </path>
                                <path fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="2"
                                    d="M11 20L17 26 30 13"></path>
                            </svg>
                            <h3 class="text-lg leading-6 font-medium" id="modal-title">تم بنجاح</h3>
                        </div>
                        <div class="flex mt-5 items-center justify-center h-12 mx-auto rounded-full grow">
                            <svg xmlns="http://www.w3.org/2000/svg" height="50" width="50" viewBox="0 0 48 48"
                                aria-hidden="true">
                                <circle class="circle" fill="#5bb543" cx="24" cy="24" r="22" />
                                <path class="tick" fill="none" stroke="#FFF" stroke-width="6"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                                    d="M14 27l5.917 4.917L34 17" />
                            </svg>
                            <div style="padding: 20px;">تم أستكمال بيانات التدخلات </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm close-CompletedInts-modal hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
