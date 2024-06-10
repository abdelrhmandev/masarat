<div class="py-4 sm:px-2 lg:flex lg:justify-start">
    <h2 class="tracking-tight text-gray-900">
        <span class="block mb-2 text-xs">{{ $filter['label'] }}</span>
        <div class="relative inline-flex">
            <select name="{{ $column }}" class="text-xs border border-gray-300 rounded-md mt-1 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
                <option value="">{{ trans('development_interventions.intervention-maintenance.second.selection') }}</option>
                @foreach ($filter['options'] as $key => $value)
                @if (@isset($request[$column]) && $request[$column] == $value)
                <option value="{{ $value }}" selected>{{ $value }}</option>
                @else
                <option value="{{ $value }}">{{ $value }}</option>
                @endif
                @endforeach
            </select>
        </div>
    </h2>
</div>
