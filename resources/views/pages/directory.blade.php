@extends('layouts.main')
@section('content')
@if(\View::exists(session('template_name').'.pages.directory'))
	@include(session('template_name').'.pages.directory')
@else
 @php 
 abort(404); 
 @endphp
@endif 

@endsection