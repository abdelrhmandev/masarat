@if($disabled == 0)
@php
$required_html = '';
$disabled_html = 'text';
if(!empty($required) AND $required == 1) {
$required_html = 'required="required"';
}
if(!empty($disabled) AND $disabled == 1) {
$disabled_html = 'hidden';
}
@endphp

<div class="col-span-6 sm:col-span-3 py-2">
    <label for="{{ $question_id ?? '' }}" class=" text-sm font-medium text-gray-700">{{ $text ?? '' }}</label>
    <input type="text" oninvalid="this.setCustomValidity('{{ $description ?? '' }}')" oninput="this.setCustomValidity('')" pattern="[\u0621-\u064A\u0660-\u0669a-zA-Z ]{3,30}" name="answers[{{ $question_id ?? '' }}]" autocomplete="given-name" {{ $required_html }} class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
</div>
@endif