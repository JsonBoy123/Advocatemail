@include(session('template_name').'.partials.header')
<link rel="stylesheet" href="{{asset('css/font-size.css')}}">

	@yield('content')

@include(session('template_name').'.partials.footer')
