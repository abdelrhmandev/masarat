<div class="gap-5 px-5 mx-auto max-w-7xl md:px-6 lg:flex lg:items-center md:justify-center">
    <!-- Housing Program -->
    @if ($parent_id == 1)
    @foreach ($intervention as $x => $one_details)
 

    <div id="<?php if($loop->first) echo "step_housing"; ?>" class="w-[21rem] md:w-[21rem] max-w-sm rounded-md bg-white overflow-hidden shadow border border-gray-200 my-4 md:my-2 transform hover:translate-y-2 transition-transform ease-in duration-200">
        @if ($one_details->status > 1)

   
        <!-- start data already submitted -->
        <svg class="absolute mx-2 mt-3 mr-20 md:mr-24" fill="#0097a0" width="150" height="150" viewBox="0 0 24 24">
            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z">
            </path>
        </svg>
        <img class="bg-cover border-b hover:bg-gray border-gray-light" width="98%" src="{{ url($one_details->image) ?? '-' }}" alt="{{ $one_details->image ?? '-' }}">
        <div class="flex mx-4 my-2">
            <div class="text-base font-medium text-gray-darker">{{ $one_details->name ?? '-' }}
            </div>
            <svg class="absolute mx-2 left-2" fill="#0097a0" width="28" height="28" viewBox="0 0 24 24">
                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z">
                </path>
            </svg>
        </div>
        <!-- end data already submitted -->
        @elseif ($one_details->status == 1)
        <a href="#" class="show-the-modal" data-id="{{ $one_details->form_id }}">
            <img class="bg-cover border-b hover:bg-gray border-gray-light" width="98%" src="{{ url($one_details->image) ?? '-' }}" alt="{{ $one_details->image ?? '-' }}">
        </a>
        <div class="flex mx-6 my-2">
            <div class="text-base font-medium text-gray-darker">{{ $one_details->name ?? '-' }}
            </div>
            <svg class="absolute mx-2 left-2" fill="gray-dark" width="28" height="28" viewBox="0 0 24 24">
                <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z">
                </path>
            </svg>
        </div>
        @endif
    </div>
 
    @endforeach

     

 

    <!-- Debt Program -->
    @elseif($parent_id == 2)
    <div class="flex p-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block align-middle sm:px-6 lg:px-16">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-[43rem] text-center">
                        <thead class="text-sm font-bold text-white bg-gray-500">
                            <th scope="col" class="px-6 py-3 tracking-wider">
                                {{ trans('home.number') }}
                            </th>
                            <th scope="col" class="px-6 py-3 tracking-wider">
                                {{ trans('home.name') }}
                            </th>
                            <th scope="col" class="py-3 tracking-wider">
                                {{ trans('home.intervention-details') }}
                            </th>
                            <th scope="col" class="px-2 py-3 tracking-wider">
                                {{ trans('home.details') }}
                            </th>
                            <th scope="col" class="px-16 py-3 tracking-wider">
                                {{ trans('home.status') }}
                            </th>
                        </thead>

                        <tbody class="items-center py-8 text-center bg-white divide-y divide-gray-200">
                     
                            @foreach ($intervention as $x => $one_details)
                            <tr id="<?php if($loop->first) echo "step_dept"; ?>" class="items-center text-center hover:bg-gray-100">
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm font-semibold leading-5 rounded-full">
                                        {{ ++$loop->index }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm font-semibold leading-5 rounded-full ">
                                        {{ $form_answers[$one_details->form_id]['name'] ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ $one_details->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ $form_answers[$one_details->form_id]['reason'] ?? '-' }}
                                    </span>
                                </td>
                                @if ($one_details->status == 1)
                                <td class="px-8 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="px-3 py-1 leading-tight text-white rounded-lg bg-slate-800 dark:text-white dark:bg-orange-600">
                                        <a href="#" class="show-the-modal" data-id="{{ $one_details->form_id ?? '-' }}">
                                            {{ trans('home.waiting-upload') }}<i class="mr-2 fas fa-pencil-alt"></i>
                                        </a>
                                    </span>
                                </td>
                                @elseif ($one_details->status > 1)
                             
                                <td class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="px-6 py-1 leading-tight text-white bg-[#0097a0] rounded-lg dark:text-white dark:bg-orange-600">
                                        {{ trans('home.uploaded') }} <i class="mr-2 fas fa-check"></i>
                                    </span>
                                </td>
                                @endif
                            </tr>
                            
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Health Program -->
    @elseif($parent_id == 3)
    <div class="flex p-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block w-full align-middle sm:px-6 lg:px-16">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-[43rem] text-center">
                        <thead class="text-sm font-bold text-white bg-gray-500">
                            <th scope="col" class="px-6 py-3 tracking-wider">
                                {{ trans('home.number') }}
                            </th>
                            <th scope="col" class="px-6 py-3 tracking-wider">
                                {{ trans('home.name') }}
                            </th>
                            <th scope="col" class="py-3 tracking-wider">
                                {{ trans('home.intervention-details') }}
                            </th>
                            <th scope="col" class="px-2 py-3 tracking-wider">
                                {{ trans('home.skicness-type') }}
                            </th>
                            <th scope="col" class="px-16 py-3 tracking-wider">
                                {{ trans('home.status') }}
                            </th>
                        </thead>

                        <tbody class="items-center py-8 text-center bg-white divide-y divide-gray-200">
                         
                            @foreach ($intervention as $x => $one_details)

                            
                            <tr id="<?php if($loop->first) echo "step_health"; ?>" class="items-center text-center hover:bg-gray-100">
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ ++$loop->index }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm font-semibold leading-5 rounded-full ">
                                        {{ $form_answers[$one_details->form_id]['name'] ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ $one_details->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ $form_answers[$one_details->form_id]['type_of_disease'] ?? $form_answers[$one_details->form_id]['type_of_disability'] ?? '-' }}
                                    </span>
                                </td>
                                @if ($one_details->status == 1)
                                <td class="px-8 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="px-3 py-1 leading-tight text-white rounded-lg bg-slate-800 dark:text-white dark:bg-orange-600">
                                        <a href="#" class="show-the-modal" data-id="{{ $one_details->form_id ?? '-' }}">
                                            {{ trans('home.waiting-upload') }}<i class="mr-2 fas fa-pencil-alt"></i>
                                        </a>
                                    </span>
                                </td>
                                @elseif ($one_details->status > 1)
                               
                                <td class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="px-6 py-1 leading-tight text-white bg-[#0097a0] rounded-lg dark:text-white dark:bg-orange-600">
                                        {{ trans('home.uploaded') }}<i class="mr-2 fas fa-check"></i>
                                    </span>
                                </td>
                                @endif
                            </tr>
                        
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Program -->
    @elseif($parent_id == 4)
    <div class="flex p-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block align-middle sm:px-6 lg:px-16">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="w-[43rem] text-center">
                        <thead class="text-sm font-bold text-white bg-gray-500">
                            <th scope="col" class="px-6 py-3 tracking-wider">
                                {{ trans('home.number') }}
                            </th>
                            <th scope="col" class="px-6 py-3 tracking-wider">
                                {{ trans('home.name') }}
                            </th>
                            <th scope="col" class="py-3 tracking-wider">
                                {{ trans('home.intervention-details') }}
                            </th>
                            <th scope="col" class="px-2 py-3 tracking-wider">
                                {{ trans('home.type') }}
                            </th>
                            <th scope="col" class="px-16 py-3 tracking-wider">
                                {{ trans('home.status') }}
                            </th>
                        </thead>

                        <tbody class="items-center py-8 text-center bg-white divide-y divide-gray-200">
                           
                            @foreach ($intervention as $x => $one_details)


                            

                            <tr id="<?php if($loop->first) echo "step_job"; ?>" class="items-center text-center hover:bg-gray-100">
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ ++$loop->index }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm font-semibold leading-5 rounded-full ">
                                        {{ $form_answers[$one_details->form_id]['name'] ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ $one_details->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 text-sm leading-5 rounded-full ">
                                        {{ $form_answers[$one_details->form_id]['section'] ?? '-' }}
                                    </span>
                                </td>
                                @if ($one_details->status == 1)
                                <td class="px-8 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="px-3 py-1 font-semibold leading-tight text-white rounded-lg bg-slate-800 dark:text-white dark:bg-orange-600">
                                        <a href="#" class="show-the-modal" data-id="{{ $one_details->form_id ?? '-' }}">
                                            {{ trans('home.waiting-upload') }}<i class="mr-2 fas fa-pencil-alt"></i>
                                        </a>
                                    </span>
                                </td>
                                @elseif ($one_details->status > 1)
                              
                                <td class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    <span class="px-6 py-1 leading-tight text-white bg-[#0097a0] rounded-lg dark:text-white dark:bg-orange-600">
                                        {{ trans('home.uploaded') }}<i class="mr-2 fas fa-check"></i>
                                    </span>
                                </td>
                                @endif
                            </tr>
                                                 
                            @endforeach

                       
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>