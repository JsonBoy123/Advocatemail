@extends('backend.layouts.main')

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
@role('super_admin|admin')
<div class="row">
   <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Active Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                    Total Pending Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endrole
<!----user Dashboard---->


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

<!-- <div class="row">
 <div class="col-md-8" id="table">
<h4>Status Services Availed on Advocatemail.com</h4><br>
<table class="table table-bordered" id="tablePost">
    <thead>
    <tr>
        <th>Services Name</th>
        <th>Annual Charges</th>
        <th>Status</th>
        <th>Activation Date</th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach($userprod as $uprod)
    <tr>
        <td>{{$uprod->prod_desc}}</td>
        <td>{{$uprod->prod_rate}}</td>
        <td>{{$uprod->status == 'A' ? 'Active' : 'Apply'}}</td>
        <td>{{$uprod->cr_date}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>

<div class="col-md-4" id="table1">
    <h4>Website Page Summary</h4><br>
    <table class="table table-bordered" id="tablePost1">
    <thead>
    <tr>
        <th>Category</th>
        <th>Total Pages</th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach($websummary as $summary)
    <tr>
        <td>{{$summary->catg_name}}</td>
        <td>{{$summary->pages}}</td>
    </tr>
    @endforeach
    </tbody>
    </table>
</div>
</div> -->
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