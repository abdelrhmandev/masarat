<h1>Current Stage Id {{ $current_stage_id}}  --------- Form Id {{ $form_id}} </h1> 




@forelse ($answers as $answer)


 
@foreach($answer->getObjective()->get() as $v)
{{ $v->title }}
@endforeach 
    

{{-- {{ $answer->path->title }} --}}

Note : {{ $answer->notes }} |  Completed Case {{ $answer->completed_case }} | Created at {{ $answer->created_at }}







   <hr style="height: 15px; background: red">

@empty
no data founds
@endforelse


 