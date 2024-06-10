<!-- FILTER SECTION -->
<form action="{{ URL::current(); }}" method="GET">
    <div class="align-bottom bg-white rounded-lg overflow-hidden shadow transform transition-all border-b border-gray-200 bg-white">
        <input type="hidden" value="filter" name="filter" />
        <input type="hidden" value="{{ Request::get('count') ?? '' }}" name="count" />
        <div class="flex mr-6">
            @if (!empty($filters))
            @foreach ($filters as $column => $filter)
            @includeIf('includes.filter_types.'.$filter['type'])
            @endforeach
            @endif
            <div class="inline pt-10 mr-1 mt-1">
                <button type="submit" class="items-center justify-center px-12 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">{{ trans('development_transferCase.first.filter') }}</button>
            </div>
        </div>
    </div>
</form>