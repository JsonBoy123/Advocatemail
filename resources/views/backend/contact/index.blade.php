@extends('backend.layouts.main')
@section('content')
<div class="card mb-5">
  <div class="card-header">
      <h5 class="card-title">Contact List</h5>
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
  							<th>Subject</th>
  							<th>Messsage</th>
  						</tr>
  					</thead>
  					<tbody>
  					    @foreach($contacts as $key => $contact)
      						<tr>
      							<td>{{$key + 1}}</td>
      							<td>{{$contact->name}}</td>
      							<td>{{$contact->email}}</td>
      							<td>{{$contact->mobile}}</td>
      							<td>{{Arr::get(SUBJECT_LIST,$contact->subject)}}</td>
      							<td>{{$contact->message}}</td>
      						</tr>
  						@endforeach
	  				</tbody>
	  			</table>
	  		</div>
	  	</div>
	 </div>
</div>
@endsection