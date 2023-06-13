@extends('backend.layouts.main')
@section('content')
<div class="card mb-5">
  <div class="card-header">
      <h5 class="card-title">Domain</h5>
  </div>
  <div class="card-body">
  		<div class="row">
  			<div class="col-md-12">
  				
  			</div>
  		</div>
  		<div class="row">
	  		<div class="col-md-12 table-responsive">
				@if($message = Session::get('success'))
				<div class="alert alert-success">
				{{$message}}
				</div>
				@endif 
  				<table class="table table-bordered table-striped">
  					<thead>
  						<tr>
  							<th>#</th>
  							<th>User Name</th>
  							<th>Email</th>
  							<th>Mobile</th>
  							<th>Domain Name</th>
  							<th>Action</th>
  						</tr>
  					</thead>
  					<tbody>
  					    @foreach($users as $key => $user)
      						<tr>
      							<td>{{$key + 1}}</td>
      							<td>{{$user->name}}</td>
      							<td>{{$user->email}}</td>
      							<td>{{$user->mobile}}</td>
      							<td>{{$user->domain_url}}</td>
      							<td></td>
      						</tr>
  						@endforeach
	  				</tbody>
	  			</table>
	  		</div>
	  	</div>
	 </div>
</div>
@endsection