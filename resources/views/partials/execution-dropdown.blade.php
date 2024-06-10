<span class="inline-flex text-xs leading-5 rounded-full gap-2">
    <select class="data-role-id-{{ $id }} text-xs border border-gray-300 rounded-md text-gray-600 h-9 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none">
        <option value="">- - - - -</option>
        <option value="7">{{ trans('interventions.to.execution') }}</option>
        <option value="4">{{ trans('interventions.request.support') }}</option>
    </select>
    <a href="#x" data-form-id="{{ $id }}" class="py-2 px-5 text-white bg-indigo-600 rounded-lg shadow-md hover:shadow-lg transition duration-300 tansfer-single-case">
        {{ trans('development_interventions.intervention-maintenance.second.transfer-it') }}
    </a>
</span>