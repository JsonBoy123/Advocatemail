@extends('layouts.main')
@section('content')
@if(\View::exists(session('template_name').'.pages.about'))
	@include(session('template_name').'.pages.about')
@else
 @php 
 abort(404); 
 @endphp
@endif 


@endsection