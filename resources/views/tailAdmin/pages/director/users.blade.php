@extends('tailAdmin.layout')

@section('title')
    {{ trans('title.users') }}
@endsection

@section('header_title')
    <h1 class="mb-4 ml-8 text-2xl font-semibold text-indigo-400 underline underline-offset-8 decoration-indigo-600">
        {{ trans('users.sub_user.title') }}
    </h1>
@endsection

@section('content')
<div>
    <!-- ROWS COUNT SHOW SECTION -->
    <div class="grid grid-cols-2 gap-4">
        <div>
        </div>
        <div class="absolute top-[9rem] right-18">
            <a href="#" type="button" class="px-10 py-2 ml-0 mr-0 text-sm font-bold text-white bg-indigo-600 border border-2 border-gray-100 rounded-lg show-user-modal hover:bg-indigo-500 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">{{ trans('users.sub_user.create') }}</a>
        </div>

        <div class="text-sm text-left">
            <h1 class="inline-block ml-2">{{ trans('development_transferCase.second.row-count') }}</h1>
            <a href="{{ $current_url . '?count=10' }}" type="button" id="ten" class="px-2 py-2 ml-0 mr-0 text-sm font-bold text-blue-700 bg-white border border-2 border-blue-700 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">10</a>
            <a href="{{ $current_url . '?count=30' }}" type="button" id="thirty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">30</a>
            <a href="{{ $current_url . '?count=50' }}" type="button" id="fifty" class="px-2 py-2 ml-0 mr-0 text-sm text-gray-900 bg-white border border-2 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">50</a>
        </div>
    </div>

    <!-- TABLE & SELECTION METHOD SECTION -->
    <div class="flex flex-col my-8">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table id="casesList" class="min-w-full text-center divide-y divide-gray-200 bg-gray-50">
                        <thead class="text-sm font-bold">
                            <tr>
                                <th scope="col" onclick="sortTable(1)" class="tracking-wider text-gray-500 cursor-pointer">
                                    {{ trans('users.sub_user.name') }}<span class="ml-1 fas fa-sort"></span>
                                </th>
                                <th scope="col" class="px-6 py-3 tracking-wider text-gray-500 cursor-pointer">
                                    {{ trans('users.sub_user.email') }}
                                </th>
                                <th scope="col" class="py-3 tracking-wider text-gray-500">
                                    {{ trans('users.sub_user.phone') }}
                                </th>
                                <th scope="col" onclick="sortTable(1)"
                                    class="px-6 py-3 tracking-wider text-gray-500 cursor-pointer">
                                    {{ trans('users.sub_user.department') }}<span class="ml-1 fas fa-sort"></span>
                                </th>
                                <th scope="col" class="px-6 py-3 tracking-wider text-gray-500 cursor-pointer">
                                    {{ trans('users.sub_user.edit') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="items-center text-center bg-white divide-y divide-gray-200">
                            <?php if (sizeof($users) === 0) { ?>
                            <tr class="items-center text-center hover:bg-gray-100">
                                <td colspan="7" class="items-center px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex-shrink-0 w-full text-right">
                                        <div class="text-sm font-bold underline text-[#F50057]">
                                            {{ trans('messages.no-data') }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>

                            @foreach ($users as $user)
                                <tr class="items-center text-center hover:bg-gray-100">
                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 mt-5">
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full">
                                            {{ $user->name }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 mt-5">
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full">
                                            {{ $user->email }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 mt-5">
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full">
                                            {{ $user->phone }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-500 mt-5">
                                        <span class="px-2 inline-flex text-md leading-5 font-semibold rounded-full">
                                            {{ $user->department }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#" data-id="{{ $user->id }}" type="submit" class="px-2 py-1 text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md change-password hover:shadow-lg">
                                            <i class="fas fa-lock">
                                                <span class="px-1 text-sm font-cairo">{{ trans('users.sub_user.changepasswordtitle') }}</span>
                                            </i>
                                        </a>
                                        <a href="#" data-id="{{ $user->id }}" type="submit" class="px-2 py-1 text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md edit-user hover:shadow-lg">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{ url('admin/director/deleteUser/' . $user->id) }}" type="submit" class="px-3 py-1 mr-1 text-white transition duration-300 bg-indigo-600 rounded-lg shadow-md hover:shadow-lg">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    {{ trans('development_transferCase.second.show') }}
                                    <span class="font-medium">{{ $users->perPage() * $users->currentPage() - $users->perPage() + 1 }}</span>
                                    {{ trans('development_transferCase.second.to') }}
                                    <span class="font-medium">{{ $users->perPage() * $users->currentPage() }}</span>
                                    {{ trans('development_transferCase.second.of') }}
                                    <span class="font-medium">{{ $users->total() }}</span>
                                    {{ trans('development_transferCase.second.result') }}
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm" aria-label="Pagination">
                                    <div class="flex justify-between">
                                        <a href="{{ $users->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $users->currentPage() - 1 }}" class="{{ $users->perPage() * $users->currentPage() - $users->perPage() + 1 === 1 ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-3 py-1 ml-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_transferCase.second.previous') }}
                                        </a>
                                        <a href="{{ $users->path() }}?count={{ Request::input('count') ?? 10 }}&page={{ $users->currentPage() + 1 }}" class="{{ $users->perPage() * $users->currentPage() >= $users->total() ? 'pointer-events-none bg-gray-300' : '' }} relative inline-flex items-center px-4 py-1 border border-gray-300 text-xs rounded-md text-gray-700 bg-white hover:bg-gray-100 hover:text-blue-700">
                                            {{ trans('development_transferCase.second.next') }}
                                        </a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('tailAdmin.modals.modal-form-user')
@include('tailAdmin.modals.modal-update-user')
@endsection

@section('footer_scripts')
    <script src="{{ url('js/modal/app.js') }}"></script>
    @include('tailAdmin.scripts.director-actions')
@endsection
