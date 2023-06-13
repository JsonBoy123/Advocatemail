@extends('backend.layouts.main')
@section('content')
<div class="card">
  <div class="card-header">
      <h4 class="card-title">Edit profile</h4>
  </div>
  <div class="card-body">
      <form action="{{route('profile.update',$user->id)}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-md-12">
                  <h5>Basic Details:</h5>
                 <hr/>
             </div>
             <div class="col-md-4 form-group col-sm-4 field">
                <label>Your Full Name <span>*</span> </label>
                <input value="{{old('name') ?? $user->name}}" type="text" name="name" class="form-control">
                 @error('name')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div>
             <div class="col-md-4 form-group col-sm-4 field">
             <label>Email Address <span>*</span> </label>
                 <input value="{{$user->email}}" readonly="readonly" type="email" name="email" class="form-control">
                 @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div>
             <div class="col-md-4 form-group col-sm-4 field">
             <label>Mobile Number <span>*</span> </label>
                 <input  type="text" name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile') ?? $user->mobile}}" class="form-control">
                 @error('mobile')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div>
             <div class="col-md-4 form-group col-sm-4 field">
             <label>Licence Number <span>*</span> </label>
                 <input value="{{old('licence_no') ?? $user->licence_no}}" type="text" name="licence_no" class="form-control">
                 @error('licence_no')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div>
             <div class="col-md-4 form-group col-sm-4 field">
                 <label>Gender <span>*</span> </label>
                 <select  class="form-control" name="gender">
                     <option value="">Select Gender</option>
                    @foreach(GENDER as $key => $gender)
                     <option value="{{$key}}" {{(old('gender') ?? $user->gender) == $key ? 'selected' : ''}}>{{$gender}}</option>
                     
                     @endforeach
                </select>
                @error('gender')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 

             </div>
             <div class="col-md-4 form-group col-sm-4 field">
                <label>Date Of Birth <span>*</span></label>
                <input value="{{old('dob') ?? date('Y-m-d',strtotime($user->dob)) }}" placeholder="YYYY-MM-DD" data-date-format="yyyy-mm-dd" type="text" class="datepicker form-control" name="dob">
                @error('dob')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div> 
             <div class="col-md-4 form-group col-sm-4 field">
                <label>Aadhar Card</label>
                <input value="{{old('aadhar_card') ?? $user->aadhar_card}}" type="text" name="aadhar_card" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('aadhar_card')}}" class="form-control"> 
                @error('aadhar_card')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div>
             <div class="col-md-4 form-group col-sm-4 field">
                <label>Pan Card</label>
                <input value="{{old('pan_card') ?? $user->pan_card}}" type="text" name="pan_card" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('pan_card')}}" class="form-control">
                @error('pan_card')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror 
             </div>
        </div>
        <div class="row">
             <div class="col-md-12">
                  <h5>Address Details:</h5>
                 <hr/>
             </div>
        </div>
        <div class="row">
           <div class="col-md-4 form-group col-sm-4 field">
              <label>Address Line 1  <span>*</span></label>
              <input value="{{old('addr1') ?? $user->addr1}}" placeholder="Enter Address Line 1" name="addr1" type="text" class="form-control"> 
              @error('addr1')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror 
           </div>
           <div class="col-md-4 form-group col-sm-4 field">
              <label>Address Line 2 </label>
              <input value="{{old('addr2') ?? $user->addr2}}" placeholder="Enter Address Line 2" name="addr2"  type="text" class="form-control"> 
              @error('aadr2')
                  <span class="text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror 
           </div>
           <div class="col-md-4 form-group col-sm-4 field">
           <label>Country <span>*</span> </label>
            <select class="form-control" name="country_code">
              <option value="102">India</option>
            </select>
            @error('country_code')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror 
         </div>
        </div>
        <div class="row">
           <div class="col-md-4 form-group col-sm-4 field">
           <label>State <span>*</span> </label>
            <select class="form-control" id="state" name="state_code">
                @foreach($states as $state)
                 <option value="{{$state->state_code}}" {{(old('state_code') ?? $user->state_code) == $state->state_code ? 'selected=selected' : '' }} >{{$state->state_name}}</option>
                 
                 @endforeach
                 @error('state_code')
                   <span class="text-danger" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
               @enderror
            </select>
         </div>
           <div class="col-md-4 form-group col-sm-4 field">
           <label>City <span>*</span> </label>
            <select class="form-control" id="city" name="city_code">
              
            </select>
            @error('city_code')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>
         <div class="col-md-4 form-group col-sm-4 field">
            <label>Zip Code <span>*</span></label>
            <input name="zip_code" placeholder="Enter Zip Code" type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('zip_code') ?? $user->zip_code}}" >
            @error('zip_code')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
         </div>
        </div>
        <div class="row">
         <div class="col-md-12">
             <h5>About Details:</h5>
             <hr/>
         </div>
        </div>
        <div class="row">
          <div class="col-md-12 form-group">
             <textarea name="detl_profile" class="form-control" rows="6" cols="6">{{old('detl_profile') ?? $user->detl_profile}}</textarea>
             @error('detl_profile')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
             <button class="btn btn-sm btn-success mt-0">Submit</button>
          </div>
        </div>
      </form>
  </div>
</div>

<script>

   $(document).ready(function(){
     $('.datepicker').datepicker();
        $('#state').on('change',function(e){
            e.preventDefault();
            var state_code = $(this).val();
            fn_state_code(state_code);
        });
        
        var stateCode = "{{old('state_code') ?? $user->state_code}}";
        var cityCode = "{{old('city_code') ?? $user->city_code}}";
        if(stateCode !=''){
            fn_state_code(stateCode,cityCode)
        }

   })
</script>
@endsection