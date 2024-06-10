<div class="py-4 px-1 lg:flex lg:justify-start">
    <h2 class="tracking-tight text-gray-900">
        <span class="block mb-2 text-xs">{{ $filter['label'] }}</span>
        <div class="relative inline-flex">
            <input type="text" value="{{ $request[$column] ?? '' }}" pattern="[1-2][0-9]{9}"
                oninvalid="this.setCustomValidity('{{ $description ?? '' }}')" oninput="this.setCustomValidity('')"
                maxlength="10" name="{{ $column }}"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full  shadow-sm sm:text-sm border-gray-300 rounded-md" />
        </div>
    </h2>
</div>

