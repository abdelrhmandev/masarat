<span class="inline-flex text-xs leading-5 rounded-full gap-2">
    <select class="text-xs border border-gray-300 rounded-md text-gray-600 h-9 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none partner-case-action">
        <option value="">- - - - -</option>
        <option @if ($status_id == 4) {{ 'selected="selected"' }} @endif value="4">{{ trans('admin.waiting-support') }}</option>
        <option @if ($status_id == 5) {{ 'selected="selected"' }} @endif value="5">{{ trans('admin.under-procedure') }}</option>
        <option @if ($status_id == 6) {{ 'selected="selected"' }} @endif value="6">{{ trans('admin.supported') }}</option>
    </select>
    <a href="#x" data-id="{{ $form_id }}" data-intervention-details-id="{{ $details_id }}" type="submit" class="py-2 px-5 text-white bg-indigo-600 rounded-lg shadow-md hover:shadow-lg transition duration-300 submit-single-action">
        {{ trans('admin.do-action') }}
    </a>
</span>
