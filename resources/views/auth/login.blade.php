@extends('layouts.main')

@section('content')
<section class="d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="signup">
                    <div class="row">
                        <div class="col-md-5 signup-greeting overlay" style="background-image: url({{asset('signup.jpg')}});">
                            <img src="{{asset('template/img/'.session('site_logo'))}}" alt="logo">
                            <h4>Welcome!</h4>
                            <p>It is just important to evaluate the best email services available and make a choice that suits your needs. Many people are just complacent with the email service provider they currently use, Check out advocatemail.com for its features.</p>
                        </div>
                        <div class="col-md-7">
                            <div class="signup-form">
                                <div class="col-lg-12 mb-3">
                                 @if($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        {{$message}}
                                    </div>
                                 @endif  
                                </div>
                                <form action="{{ url('login_up') }}" method="POST">
                                @csrf
                                    <div class="col-lg-12">
                                        <h4>Login</h4>
                                    </div>
                                    <div class="col-lg-12">
                                       
                                         <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary btn-sm"> {{ __('Login') }}</button>
                                    </div>
                                    <div class="col-sm-8 text-sm-right">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
