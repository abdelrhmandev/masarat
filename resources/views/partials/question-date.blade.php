@php
$required_html = '';
if(!empty($required) AND $required == 1){
$required_html = 'required="required"';
}
@endphp
<div class="col-span-6 sm:col-span-3 py-2">
    <div inline-datepicker data-date="02/25/2022"></div>
    <label for="{{ $form_id+$question_id ?? '' }}" class=" text-sm font-medium text-gray-700">{{ $text ?? '' }}</label>
    <input type="date" oninvalid="this.setCustomValidity('{{ $description ?? '' }}')" oninput="this.setCustomValidity('')" name="answers[{{ $question_id ?? '' }}]" autocomplete="given-name" {{ $required_html }} class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
</div>