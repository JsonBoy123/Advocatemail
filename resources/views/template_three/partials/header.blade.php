<!DOCTYPE html>
<html lang="en">

<head>
<title>@yield('title','Advocate '.session('site_name'))</title>
<meta charset="utf-8">
{{-- <meta name="title" content="{{session('sef_title')}}">
<meta name="description" content="{{session('sef_description')}}">
<meta name="keywords" content="{{session('sef_keyword')}}">
 --}}
<meta name="title" content="@yield('meta_title',session('sef_title'))">
<meta name="keywords" content="@yield('meta_keywords',session('sef_keyword'))">
<meta name="description" content="@yield('meta_description',session('sef_description'))">


<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



<!-- Bootstrap CSS-->
<link rel="stylesheet" href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}">
<!-- Font Awesome CSS-->
<link rel="stylesheet" href="{{asset('template/vendor/font-awesome/css/font-awesome.min.css')}}">
<!-- Custom icon font-->
<link rel="stylesheet" href="{{asset('template/css/fontastic.css')}}">
<!-- Google fonts - Open Sans-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
<!-- Fancybox-->
<link rel="stylesheet" href="{{asset('template/vendor/@fancyapps/fancybox/jquery.fancybox.min.css')}}">
<!-- theme stylesheet-->
<link rel="stylesheet" href="{{asset('template/css/style.default.css')}}" id="theme-stylesheet">
</head>
<body>
		<header class="header">
		<nav class="navbar navbar-expand-lg">
			<div class="search-area">
				<div class="search-area-inner d-flex align-items-center justify-content-center">
					<div class="close-btn"><i class="icon-close"></i></div>
					<div class="row d-flex justify-content-center">
						<div class="col-md-8">
							<form action="#">
								<div class="form-group">
									<input type="search" name="search" id="search" placeholder="What are you looking for?">
                                    <button type="submit" class="submit"><i class="icon-search-1"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
          <!-- Navbar Brand -->
          <div class="navbar-header d-flex align-items-center justify-content-between">
            <!-- Navbar Brand --><a href="index.html" class="navbar-brand">{{session('site_name')}}</a>
            <!-- Toggle Button-->
            <button type="button" data-toggle="collapse" data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span></span><span></span><span></span></button>
          </div>
          <!-- Navbar Menu -->
          <div id="navbarcollapse" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
            	@foreach(session('catgs') as $catg)
			        <li class="nav-item">
			            <a class="nav-link" href="{{$catg->catg_url !=null ? url($catg->catg_url) : '#'}}">{{$catg->catg_name}}</a>
			        </li>
			    @endforeach
            </ul>
            
            
          </div>
        </div>
		</nav>
	</header>

