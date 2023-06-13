@extends('backend.guest.head-foot')
@section('content')
<style>
  .shadow_main{
    height: 200px;
    width: 200px;
}
</style>
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-md-8">
        <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Name</b></label>
          </div>
          <div class="col-md-4">    
              <span class="text-right">{{$users->name}}</span>
          </div>  
      </div>
      <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Registration Date</b></label>
          </div>
          <div class="col-md-4">    
              <span class="text-right">{{$users->created_at->format('d-m-Y') }}</span>
          </div> 
      </div>
      <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Account Status</b></label>
          </div>
          <div class="col-md-4">    
              <span class="text-right">{{$users->status == 'A' ? 'Active' : 'Pending'}}</span>
          </div> 
      </div>
      <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Profile</b></label>
          </div>
          <div class="col-md-4">    
              <span class="text-right"></span>
          </div> 
      </div>
      <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Qualification</b></label>
          </div>
          <div class="col-md-4">    
              <span class="text-right">{{$quality}}</span>&nbsp;<a href="{{route('qualification')}}"><i class="fa fa-edit"></i></a>
          </div> 
      </div>
      <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Practising Courts</b></label>
          </div>
          <div class="col-md-4">
              <span class="text-right">{{$practice}}</span>&nbsp;<a href="{{route('practicing_court')}}"><i class="fa fa-edit"></i></a>
          </div> 
      </div>
      <div class="row">
          <div class="col-md-4">
              <label class="text-left"><b>Specialization</b></label>
          </div>
          <div class="col-md-4">    
              <span class="text-right">{{$speciality}}</span>&nbsp;<a href="{{route('specialization')}}"><i class="fa fa-edit"></i></a>
          </div> 
      </div>
  </div>

  <div class="col-md-4">
     Image Size (Height=200px Width=200px) 
     <img src="{{Auth::user()->photo == null ? asset('demo.png') : asset('/storage/app/public/'.Auth::user()->photo)}}"  class="shadow_main"><br>


     <form action="/upload" method="POST" enctype="multipart/form-data"> 
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                   <input type="file" name="photo" id="image">
               </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12">
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
          </div>
      </div>

  </form>


</div>
</div>
<br>

<div>
    <strong>Referal Url -</strong> <span id="p1">{{$users->ref_url}}</span><br>
    <button class="btn btn-primary" onclick="copyToClipboard('#p1')">Copy Url</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
  function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}
</script>
@endsection