@extends('backend.layouts.main')
@section('content')
<style>
	.field-icon {
		float: right;
		margin-left: -25px;
		margin-top: -25px;
		margin-right: 7px;
		position: relative;
		z-index: 2;
	}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
<!-- 				<div class="box-header">
					<h3 class=""><a href="{{route('referral.create')}}" class="btn btn-sm btn-primary pull-right">Add Referral User</a></h3>
				</div> -->
				<div class="box-body table-responsive" style="margin-top:40px;">
					@if($message = Session::get('success'))
					<div class="alert bg-success text-white">
						{{$message}}
					</div>
					@endif

					@if($message = Session::get('warning'))
					<div class="alert bg-danger text-white">
						{{$message}}
					</div>
					@endif
					<p><strong>Referral User</strong> - {{$referrals_count}}</p>
					<table class="table table-striped table-bordered" id="myTable">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email Address</th>
								<th>Mobile Number</th>
								<th>State</th>
								<th>City</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($referrals as $referral)
							<tr>
								<td>{{$referral->id}}</td>
								<td>{{$referral->name}}</td>
								<td>{{$referral->email}}</td>
								<td>{{$referral->mobile}}</td>
								<td>{{$referral->state->state_name}}</td>
								<td>{{$referral->city->city_name}}</td>
								<td>
									@if($referral->status == 0)
										<p class="text-danger">Pending</p>
									@else
										<p class="text-success">Active</p>
									@endif


								</td>
								<td>
									<a href="{{route('referral.edit',$referral->id)}}"><i class="fa fa-edit text-success btn-sm"></i></a>
									<a href="{{route('referral.delete',$referral->id)}}"><i class="fa fa-trash text-danger btn-sm" onclick="return confirm('Are you sure?')"></i></a>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</section>
<script >
	$(document).ready(function(){		
		$('#myTable').DataTable();
	});
</script>
@endsection