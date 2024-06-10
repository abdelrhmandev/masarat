<div class="show-orphan-path-category-modal">
    <div class="orphan-path-category-modal hidden fixed z-10 inset-0 overflow-y-auto text-center" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20  sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <form method="POST" action="{{ route('admin.submit_orphan_path_category') }}">

                    @csrf
                    <input type="hidden" name="form_id" id="action-form-id-path" />

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex grow mx-auto items-center justify-center h-12 rounded-full bg-indigo-600 text-white">
                            <svg class="h-6 w-6 gap-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h3 class="text-lg leading-6 font-medium" id="modal-title"> {{ $current_path_title }}</h3>
                        </div>
                        <div class="mt-3">
                            <div class="z-0 mt-4">
                                <h2 class="mt-4 mb-4 ml-8 text-lg font-bold underline text-[#F50057]">
                                    {{ trans('orphan.select_path_category') }}
                                </h2>
                                <div class="px-3 py-3 overflow-hidden align-bottom transition-all transform bg-white border-b border-gray-200 rounded-lg shadow">
                                    <div class="flex">
                                        <fieldset class="mb-4">

                                            <div class="mt-4 space-y-4">
                                                <div class="flex items-center">
                                                    <input id="general_path" name="path_category" value="general" type="radio" class="w-4 h-4 ml-2 text-indigo-600 border-gray-300 focus:ring-indigo-500" checked>
                                                    <label for="general_path" class="block ml-3 text-sm font-medium text-gray-700">
                                                        {{ trans('orphan.path_general') }}
                                                    </label>
                                                </div>

                                                <div class="flex items-center">
                                                    <input id="advanced_path" name="path_category" value="advanced" type="radio" class="w-4 h-4 ml-2 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                                    <label for="advanced_path" class="block ml-3 text-sm font-medium text-gray-700">
                                                        {{ trans('orphan.path_advanced') }}
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_add_text') }}</button>
                        <button type="button" class="close-the-modal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>