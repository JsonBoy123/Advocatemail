@extends('layouts.main')
@section('content')
@if(\View::exists(session('template_name').'.pages.post_detail'))
@else
 @php 
 abort(404); 
 @endphp
@endif 


@endsection