<h1>Current Stage Id {{ $current_stage_id}}  --------- Form Id {{ $form_id}} </h1> 

@foreach ($pathes as $path)
<img class="bg-cover" width="85rem" height="20rem" src="{{ url($path->image ?? '') }}" alt="{{ url($path->image ?? '') }}" />                
<h2>{{ $path->id }} ------- <u>{{ $path->title }}</u></h2>