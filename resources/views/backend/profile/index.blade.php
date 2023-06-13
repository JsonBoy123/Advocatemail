@extends('backend.layouts.main')
@section('content')
<div class="card mb-5">
  <div class="card-header">
      <h5 class="card-title">Profile</h5>
  </div>
  <div class="card-body">
    @if($message = Session::get('success'))
      <div style="" class="alert bg-success text-white">
        {{$message}}
      </div>
    @endif
      <div class="row">
        <div class="col-md-3">
          <img src="{{Auth::user()->photo  == null ? asset('demo.png') : asset('/storage/app/public/'.Auth::user()->photo)}}" width="230" height="150" class="shadow-sm">
        </div>
        <div class="col-md-9">
           <h5 class="font-weight-bold">Basic Details:</h5>

           <div class="row">
              <div class="col-md-6">
                  <p class="m-1">Name: {{$user->name}}</p>
                  <p class="m-1">Email Address: {{$user->email}}</p>
                  <p class="m-1">Mobile Number: {{$user->mobile}}</p> 
                  <p class="m-1">Aadhar Card: {{$user->aadhar_card}}</p> 
              </div>
              <div class="col-md-6">
                  <p class="m-1">Gender: {{$user->gender !=null ? Arr::get(GENDER,$user->gender) : ''}}</p>
                  <p class="m-1">Licence Number: {{$user->licence_no}}</p>
                  <p class="m-1">Date of Birth: {{date('d-m-Y',strtotime($user->dob))}}</p>
                  <p class="m-1">PAN Card: {{$user->pan_card}}</p> 
              </div>
           </div>
           <hr>
           <h5 class="font-weight-bold">Address Details:</h5>

           <div class="row">
              <div class="col-md-6">
                  <p class="m-1">Address Line 1: {{$user->addr1}}</p>
                  <p class="m-1">Address Line 2: {{$user->addr2}}</p>
                  <p class="m-1">Country: {{$user->country !=null ? $user->country->country_name : ''}}</p> 
                  <p class="m-1">State: {{$user->state !=null ? $user->state->state_name : ''}}</p> 
              </div>
              <div class="col-md-6">
                  <p class="m-1">City: {{$user->city !=null ? $user->city->city_name : ''}}</p>
                  <p class="m-1">Zip Code: {{$user->zip_code}}</p>
              </div>
           </div>
           <hr>
            <h5 class="font-weight-bold">About Details:</h5>

           <div class="row">
              <div class="col-md-12">
                  {!! $user->detl_profile !!}
              </div>
           </div>

        </div>
      </div>
  </div>
</div>
@endsection