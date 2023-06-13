@extends('layouts.main')
@section('content')

@if(!empty($page))
	@if($page->is_post == '1')
		@include(session('template_name').'.pages.index')

	@else
		@if(\View::exists(session('template_name').'.pages.'.$page_name))
			@include(session('template_name').'.pages.'.$page_name)
		@else
			@php 
				abort(404); 
			@endphp
		@endif 
	@endif
@else
	@if(\View::exists(session('template_name').'.pages.'.$page_name))
		@include(session('template_name').'.pages.'.$page_name)
	@else
		@php 
			abort(404); 
		@endphp
	@endif 

@endif 
@endsection