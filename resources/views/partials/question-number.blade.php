@if ($disabled == 0)
    @php
        $required_html = '';
        $disabled_html = 'text';
        $name = $question_id;
        if (!empty($required) and $required == 1) {
            $required_html = 'required="required"';
        }
        if (!empty($disabled) and $disabled == 1) {
            $disabled_html = 'hidden';
        }
    @endphp

    <div class="col-span-6 sm:col-span-3 py-2">
        <label for="{{ $details_id ?? '' }}-{{ $form_id + $question_id ?? '' }}"
            class=" text-sm font-medium text-gray-700">{{ $text ?? '' }}</label>
        <input type="text" pattern="[0-9]{1,6}" oninvalid="this.setCustomValidity('{{ $description ?? '' }}')"
            oninput="this.setCustomValidity('')" maxlength="6" name="answers[{{ $name ?? '' }}]"
            autocomplete="given-name" {{ $required_html }}
            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
    </div>
@endif
