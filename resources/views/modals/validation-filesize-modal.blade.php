<div class="validation-file-size-modal">
    <div class="fixed inset-0 z-10 hidden overflow-y-auto text-center validation-file-size-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left'}}">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="flex items-center justify-center h-12 mx-auto text-white bg-red-600 rounded-full grow">
                            <svg class="w-6 h-6 gap-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-lg font-medium leading-6" id="modal-title">{{ trans('messages.error.title') }}</h3>
                        </div>
                        <div class="mt-3 text-center">
                            {{ trans('messages.error.maximum_upload_size_5_mega') }}
                        </div>
                    </div>
                    <div id="inner-supported-content">
                        <div class="flex grid flex-col grid-cols-12 gap-3 mx-2 mt-4 overflow-hidden bg-white rounded-lg shadow-xl md:flex-row w-50">
                            {{-- start --}}
                            {{-- end --}}
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="close-validation-size-modal" type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm close-the-modal hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>