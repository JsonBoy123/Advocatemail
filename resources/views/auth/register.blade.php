@extends('layouts.main')
@section('content')

<section class="d-flex align-items-center py-50" >
    <div class="container mb-4">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                 <!-- <button onclick="demo1()" id="demo">click</button> -->

                 <div class="card-body">

                   <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <h4 class="mb-4">{{ __('New SignUp') }}</h4>

                    </div>

                    <div class="col-lg-12">
                     <select name="user_category" class="form-control input-box" id="user_category"  > 
                        <option value="0">Select User Type</option>
                        <option value="3">Advocate</option>
                        <option value="4">Guest User</option>
                    </select>
                </div>

                <div class="col-lg-12">
                    <input onload="demo1()" id="demo" type="text" class="form-control" name="referal_code" value="">
                </div>

                <div class="col-lg-12">
                    <input  type="radio" name="gender" value="M" required> Male
                    <input  type="radio" name="gender" value="F" required> Female

                    @error('gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-lg-12">
                    <select class="form-control" name="profession">
                      <option value="">Select Profession</option>
                      <option value="Student">Student</option>
                      <option value="Licensed Advocate">Licensed Advocate</option>
                      <option value="Law Teacher">Law Teacher</option>
                  </select>

                  @error('profession')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="col-lg-12">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="First Name" autocomplete="name" autofocus>
                @error('name')
             <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="col-lg-12">
         <input id="mid_name" type="text" class="form-control @error('mid_name') is-invalid @enderror" name="mid_name" value="{{ old('mid_name') }}" placeholder="Mid Name" autocomplete="mid_name" autofocus>
         @error('mid_name')
         <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-lg-12">
     <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" autocomplete="last_name" autofocus>
     @error('last_name')
     <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-lg-12">
    <input value="{{old('dob')}}" placeholder="Date of Birth (YYYY-MM-DD)" data-date-format="yyyy-mm-dd" type="text" class="datepicker form-control" name="dob" required="required" autofocus="off">

    @error('dob')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-lg-12">
    <input  type="text" name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile')}}" required  class="form-control" placeholder="Mobile Number">

    @error('mobile')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-lg-12">
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address (Login Id)">

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-lg-12">
    <select class="form-control" name="country_code" required>
       <option value="102">India</option>
   </select>

   @error('country_code')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-lg-12">
    @php 
    $states = App\Models\State::all();
    @endphp
    <select class="form-control" name="state_code" id="state" required>
       <option value="0">Select State</option>
       @foreach($states as $state)
       <option value="{{$state->state_code}}" {{old('state_code') == $state->state_code ? 'selected=selected' : '' }} >{{$state->state_name}}</option>
       @endforeach 
   </select>

   @error('state_code')
   <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-lg-12">
    <select class="form-control" name="city_code" id="city" required>   
    </select>
    @error('city_code')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="col-lg-12">
    <input name="zip_code" placeholder="Zip Code" type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('zip_code')}}" >

    @error('zip_code')
    <span class="text-danger" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>


<div class="col-lg-12">
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="col-lg-12">
    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
</div>





<div class="col-lg-12">
 <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha"  placeholder="Enter Following Verification Code" required autocomplete="captcha" autofocus>
 @error('captcha')
 <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
@enderror

</div>
<div class="col-md-12 form-group">
    <span id="spancaptcha">{!! captcha_img('flat') !!}</span>
    <a href="javascript:void(0)" class="btn btn-sm btn-primary ml-3 text-white" id="btn-refresh"><i class="fa fa-refresh"></i></a>
</div>
<div class="col-sm-4">
    <button class="btn btn-primary btn-sm">{{ __('Register') }}</button>
</div>
</form>

</div>

</div>

</div>
</div>
</div>
</section>
<script>


    var urls = document.getElementById("demo").innerHTML = window.location.href;
    var arr = urls.split("?");
            // alert(arr[arr.length-1]);
    var datas = arr[arr.length-1];
            // alert(arr[arr.length-1]);

    var x = document.getElementById("demo");

    x.value = datas;

            // var newurls = urls.lastIndexOf(urls);
            // var newurls = urls.length-urls.indexOf('?');
            // var newurls1 = newurls-1;

        // alert(newurls);




    @if($message = Session('success'))
    alert("{{$message}}");
    @endif

    $(document).ready(function(){







        $("#btn-refresh").click(function(){

            $('#captcha').val('');
            $.ajax({
             type:'GET',
             url:'/refresh_captcha',
             success:function(data){
                $("#spancaptcha").empty().html(data)

            }
        });

        });

        $('.datepicker').datepicker();

        $('#state').on('change',function(e){
            e.preventDefault();
            var state_code = $(this).val();
            fn_state_code(state_code);
        });

        var stateCode = "{{old('state_code')}}";
        var cityCode = "{{old('city_code')}}";
        if(stateCode !=''){
            fn_state_code(stateCode,cityCode)
        }

        
    })
</script>
@endsection
