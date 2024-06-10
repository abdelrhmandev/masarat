@extends('layouts.front')

@section('template_title')
    {{ trans('title.dashboard') }}
@endsection

@section('content')
@include('forms.intro')
@include('forms.fillForm')
@endsection