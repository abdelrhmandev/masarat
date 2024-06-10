<div class="py-4 sm:px-2 lg:flex lg:justify-start">
    <h2 class="tracking-tight text-gray-900">
        <span class="block mb-2 text-xs">{{ $filter['label']; }}</span>
        <div class="relative inline-flex">
            <input type="text" value="{{ $request[$column] ?? '' }}" name="{{ $column }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full md:w-{{ $filter['width'] ?? '25' }} shadow-sm sm:text-sm border-gray-300 rounded-md" />
        </div>
    </h2>
</div>
