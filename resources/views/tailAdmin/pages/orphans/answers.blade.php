@extends('tailAdmin.layout')

@section('title')
{{ $page_title = 'تفاصيل اليتيم' }}
@endsection

@section('head')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer integrity="sha384-qIUj+yp0nYG+FiRSyz0hFI7OAjgQfjCIxMKboilWruQkwLsv9YqKZ+oQlBjjN1wy" crossorigin="anonymous"></script>
@endsection

@section('header_title')
<h1 class="mb-4 ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
    {{ $header_title = 'تفاصيل اليتيم' }}
</h1>
@endsection

@section('content')
<div class="p-4 w-full bg-white rounded-lg border shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700">
    <section class="bg-white">
        <div class="container">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full px-4">
                    <div class="max-w-full overflow-x-auto">

                        <div class="flex justify-between items mb-4">
                            <h5 class="underline decoration text-xl font-bold leading-none text-fuchsia-700 dark:text-fuchsia">{{ trans('orphan.objectives_answered') }} {{ $answers->count()}}</h5>
                        </div>

                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-right text-blue-100 dark:text-blue-100">
                                <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                                    <tr>
                                        <th scope="col" class="py-3 px-6">
                                            {{ trans('orphan.objective') }}
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            {{ trans('orphan.objective_status') }}
                                        </th>

                                        <th scope="col" class="py-3 px-6">
                                            {{ trans('orphan.details') }}
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            {{ trans('admin.created_at') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($answers as $answer)
                                    <tr class="hover:bg-blue-900 bg-blue-400 border-blue-40">
                                        <th scope="row" class="py-4 px-6 font-medium text-blue-50 whitespace-nowrap dark:text-blue-100">
                                            {{ $answer->getObjective->title }}
                                        </th>
                                        <td class="py-4 px-6">

                                            @if($answer->completed_case == 'completed')
                                            {{ trans('orphan.completed') }}
                                            @elseif($answer->completed_case == 'notcompleted')
                                            {{ trans('orphan.not_completed') }}
                                            @endif

                                        </td>
                                        <td class="py-4 px-6 max-w-md mx-auto">
                                            {{ $answer->notes }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ \Carbon\Carbon::parse($answer->created_at)->format('Y/m/d').' | '.$answer->created_at->diffForHumans(); }}

                                        </td>
                                    </tr>
                                    @empty

                                    <tr class="hover:bg-gray-100 items-center text-center">
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap items-center text-center">
                                            <div class="flex-shrink-0 w-full text-right">
                                                <div class="text-sm font-bold underline text-[#F50057]">
                                                    {{ trans('messages.no-data') }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="p-4 mt-5 w-full bg-white rounded-lg border shadow-md sm:p-4 dark:bg-gray-800 dark:border-gray-700">
    <div class="flow-root">
        <form method="POST" action="{{ route('admin.submit_orphan_answers',$form_id) }}" enctype="multipart/form-data">
            @csrf
            <div class="flex justify-between items mb-4">
                <h5 class="underline decoration text-xl font-bold leading-none text-fuchsia-700 dark:text-fuchsia">{{ trans('orphan.objectives_not_answered') }} {{ $objectives->count()}}</h5>
            </div>
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($objectives as $objective)
                <li class="py-3 sm:py-4">
                    <input type="checkbox" name="objectives[]" value="{{ $objective->id }}" id="agree{{ $objective->id }}" class="peer text-indigo-500 w-6 h-6 focus:ring-indigo-400 focus:ring-opacity-25 border border-gray-300 rounded" />
                    <label for="agree{{ $objective->id }}" class="mr-2 font-extrabold tracking-tight text-indigo-500 dark:text-white">{{ $objective->title }} </label>
                    </label>
                    @if($objective->getOrphanOwnObjectvies)
                    [{{ trans('orphan.specific_objective') }}]
                    @else
                    [{{ trans('orphan.general_objective') }}]
                    @endif
                    <div class="hidden mr-2 peer-checked:block">
                        <div class="inline-block align-bottom bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full">
                            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">

                                <div class="mt-3">
                                    <div class="col-span-6 py-2 sm:col-span-3">
                                        <div class="mr-4">
                                            <h4 class="underline decoration-orange-600 mb-4 font-semibold text-orange-600 dark:text-600">{{ trans('orphan.objective_status') }}</h4>
                                            <div class="flex">
                                                <div class="flex items-center h-5 ml-2">
                                                    <input id="helper-radio" aria-describedby="helper-radio-text" name="completed_case[{{ $objective->id }}]" type="radio" value="completed" class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 focus:ring-emerald-500 dark:focus:ring-emerald-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                                                <div class="ml-2 text-sm">
                                                    <label for="helper-radio" class="font-medium text-gray-900 dark:text-gray-300">{{ trans('orphan.completed') }}</label>
                                                </div>
                                                <div class="flex items-center h-5 ml-2">
                                                    <input id="helper-radio" aria-describedby="helper-radio-text" name="completed_case[{{ $objective->id }}]" type="radio" value="notcompleted" class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </div>
                                                <div class="ml-2 text-sm">
                                                    <label for="helper-radio" class="font-medium text-gray-900 dark:text-gray-300">{{ trans('orphan.not_completed') }}</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mr-4">
                                            <div class="col-span-6 sm:col-span-3 py-2">
                                                <h4 class="underline decoration-sky-600 mb-4 font-semibold text-sky-600 dark:text-600">{{ trans('admin.notices') }}</h4>
                                                <textarea id="notes" name="notes[{{ $objective->id }}]" rows="2" class="block p-1.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ trans('admin.notices') }}..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-sm font-bold underline text-[#F50057]">
                        {{ trans('messages.no-data') }}
                    </div>
                    @endforelse
            </ul>

            @if($objectives->count()>0)
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-6 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('admin.save') }}</button>
                <button type="reset" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">{{ trans('modals.confirm_modal_button_cancel_text') }}</button>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection

@section('footer_scripts')
<script src="{{ url('js/modal/app.js') }}"></script>
@include('tailAdmin.scripts.orphan-actions')
@endsection