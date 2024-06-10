<div class="image-modal">
    <div class="image-modal hidden fixed z-10 inset-0 overflow-y-auto text-center">
        <div class="flex items-end justify-center">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 {{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'text-right' : 'text-left' }}">
                <!-- Modal content -->
                <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="justify-start p-3 rounded-t border-b dark:border-gray-600 px-96">
                        <h3 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">{{ trans('interventions.img-modal') }}</h3>
                    </div>
                    <!-- Modal body -->
                    <div class="h-96 w-96 space-y-6 px-2">
                        <span class="px-1 inline-flex text-md leading-5 rounded-full">
                            <div x-data="{ imgModal: false, imgModalSrc: '', imgModalDesc: '' }">
                                <template @img-modal.window="imgModal = true; imgModalSrc = $event.detail.imgModalSrc;" x-if="imgModal">
                                    <div x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 transform scale-90"
                                        x-transition:enter-end="opacity-100 transform scale-100"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 transform scale-100"
                                        x-transition:leave-end="opacity-0 transform scale-90"
                                        x-on:click.away="imgModalSrc = ''"
                                        class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                                        <div @click.away="imgModal = ''" class="flex flex-col max-w-3xl max-h-full overflow-auto">
                                            <div class="z-50">
                                                <button @click="imgModal = ''" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                                                    <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                            <div class="p-2">
                                                <img :alt="imgModalSrc" class="object-contain h-1/4 " :src="imgModalSrc">
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <div x-data="{}" class="flex justify-start mt-8" id="inner-image-content"></div>
                        </span>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center py-3 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" class="image-close-modal mr-8 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
