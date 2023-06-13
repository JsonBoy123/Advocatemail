<!DOCTYPE html>
<html lang="en">

<head>
<title>@yield('title','Advocate '.session('site_name'))</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<link rel="stylesheet" href="{{asset('template/fonts/icomoon/style.css')}}">
<!--<link rel="stylesheet" href="{{asset('template/css/bootstrap.min.css')}}">-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<!--<link rel="stylesheet" href="{{asset('template/css/jquery-ui.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/css/owl.carousel.min.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/css/owl.theme.default.min.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/css/owl.theme.default.min.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/css/jquery.fancybox.min.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/css/bootstrap-datepicker.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/fonts/flaticon/font/flaticon.css')}}">-->
<!--<link rel="stylesheet" href="{{asset('template/css/aos.css')}}">-->
<!--<link href="{{asset('template/css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="{{asset('template/css/template_one.css')}}">
</head>
<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	<div class="site-wrap">
		<div class="site-mobile-menu site-navbar-target">
			<div class="site-mobile-menu-header">
				<div class="site-mobile-menu-close mt-3">
					<span class="icon-close2 js-menu-toggle"></span>
				</div>
			</div>
			<div class="site-mobile-menu-body"></div>
		</div>
		<div class="header-top">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-lg-6 d-flex">
						<a href="index-2.html" class="site-logo">
						{{session('site_name')}}
						</a>
						<a href="#" class="ml-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a>
					</div>
					<div class="col-12 col-lg-6 ml-auto d-flex">
						<div class="ml-md-auto top-social d-none d-lg-inline-block">
							<a href="#" class="d-inline-block p-3"><span class="icon-facebook"></span></a>
							<a href="#" class="d-inline-block p-3"><span class="icon-twitter"></span></a>
							<a href="#" class="d-inline-block p-3"><span class="icon-instagram"></span></a>
							<a href="#" class="d-inline-block p-3"><span class="icon-linkedin"></span></a>
						</div>
						
					</div>
					<div class="col-6 d-block d-lg-none text-right">
					</div>
				</div>
			</div>
			<div class="site-navbar py-2 js-sticky-header site-navbar-target d-none pl-0 d-lg-block" role="banner">
				<div class="container">
					<div class="d-flex align-items-center">
						<div class="mr-auto">
							<nav class="site-navigation position-relative text-right" role="navigation">
								<ul class="site-menu main-menu js-clone-nav mr-auto d-none pl-0 d-lg-block">
									@foreach(session('catgs') as $catg)
			                            <li>
			                                <a class="nav-link text-left" href="{{$catg->catg_url !=null ? url($catg->catg_url) : '#'}}">{{$catg->catg_name}}</a>
			                            </li>
			                        @endforeach
									</ul>
								</nav>
							</div>
						</div>
				</div>
			</div>
		</div>
