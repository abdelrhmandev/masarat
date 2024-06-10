@php
$label = '';
$required_html = '';
if(!empty($required) AND $required == 1) {
$required_html = 'required="required"';
}
$multiple = '';
if($attribute == 'multiple'){
$multiple = '[]'; // as an associative array
}
@endphp
<div class="col-span-6 sm:col-span-3 py-2">
    <label for="{{ $question_id ?? '' }}" class="block text-sm font-medium text-gray-700">{{ $text ?? '' }}</label>
    <input onchange="return validatefilesize({{ $question_id ?? '' }})" id="{{ $question_id ?? '' }}" oninvalid="this.setCustomValidity('{{ $description ?? '' }}')" oninput="this.setCustomValidity('')" accept="image/jpg, image/jpeg, image/png" name="answers[{{  $question_id ?? '' }}]{{ $multiple }}" {{ $multiple }} type="file" {{ $attribute }} {{ $required_html }} class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 demoInputBox" aria-describedby="user_avatar_help">
    <span class="text-xs text-rose-500" id="file_error{{ $question_id ?? '' }}"></span>
    <p class="text-xs text-gray-500">
        PNG, JPG, JPEG صيغ الملفات المسموح بها
    </p>
</div>