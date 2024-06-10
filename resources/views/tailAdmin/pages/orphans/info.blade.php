<div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700">
   <section class="bg-white">
      <div class="container">
         <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
               <div class="max-w-full overflow-x-auto">
                  <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                     <table class="w-full text-sm text-right text-blue-100 dark:text-blue-100">
                        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                           <tr>
                              <th scope="col" class="py-3 px-6">
                                 {{ trans('orphan.orphan') }}
                              </th>
                              <th scope="col" class="py-3 px-6">
                                 {{ trans('orphan.parent') }}
                              </th>
                              <th scope="col" class="py-3 px-6">
                                 {{ trans('orphan.path_type') }}
                              </th>
                              <th scope="col" class="py-3 px-6">
                                 {{ trans('orphan.path_category') }}
                              </th>
                              <th scope="col" class="py-3 px-6">
                                 {{ trans('orphan.age_equivalent_degree_history') }}
                              </th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr class="hover:bg-blue-900 bg-blue-400 border-blue-40">
                              <th scope="row" class="py-4 px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                 {{ $orphan_name ?? '--'}}
                              </th>
                              <td class="py-4 px-6">
                                 {{ $orphan_pen ?? '--'  }}
                              </td>
                              <td class="py-4 px-6">
                                 {{ $path_title ?? '--' }}
                              </td>
                              <td class="py-4 px-6">
                                 @if($orphan_path_category)
                                 @if($orphan_path_category->path_category == 'general')
                                 <p class="text">{{ trans('orphan.path_general') }}</p>
                                 @elseif($orphan_path_category->path_category == 'advanced')
                                 <p class="">{{ trans('orphan.path_advanced') }}</p>
                                 @endif
                                 @else
                                 <span class="text-red-200">{{ trans('orphan.not_added') }}</span>
                                 @endif
                              </td>
                              <td class="py-4 px-6">
                                 @if($orphan_degree->isEmpty())
                                 <span class="text-red-200">{{ trans('orphan.not_added') }}</span>
                                 @else
                                 <button type="button" data-form-id="{{ $form_id }}" class="get-orphan-age-equivalent-degree-history-button text-xs px-2 py-2 border border-transparent text-base rounded-md text-white bg-lime-500 hover:bg-lime-500">{{ trans('orphan.age_equivalent_degree_details')}}</button>
                                 @endif
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>