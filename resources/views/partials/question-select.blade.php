@php
$required_html = '';
$name = $question_id;
if(!empty($required) AND $required == 1){
$required_html = 'required="required"';
}
@endphp
<div class="col-span-6 sm:col-span-3 py-2">
    <label for="{{ $form_id+$question_id ?? '' }}" class=" text-sm font-medium text-gray-700">{{ $text ?? '' }}</label>
    <select name="answers[{{ $name }}]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" {{ $required_html }}>
        {{-- التدخلات في المجال الطبي --}}
        {{-- تأمين وسيله سفر --}}
        <option value="">- - - - -</option>
        @if($int_id == 15)
        @foreach (Config::get('admin.means_of_travel') as $key=>$value )
        <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
        @endif

        {{-- التدخلات في مجال التوظيف وريادة الأعمال --}}
        {{-- الوظائف --}}
        @if($int_id == 16)
        @foreach (Config::get('admin.job_sector') as $key=>$value )
        <option value="{{ $value }}">{{ $value }}</option>
        @endforeach
        @endif
    </select>
</div>