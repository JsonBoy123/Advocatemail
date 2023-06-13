@extends('backend.guest.head-foot')
@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Appointment</h3>
				</div>
				<div class="box-body table-responsive">
					<table class="table table-stripped table-bordered" id="myTable">
						<thead>
							<tr>
								<th>SNo.</th>
								<th>Lawyer Name</th>
								<th>Booking Time</th>
								<th>Booking Date</th>
								<th>Booking Status</th>
							</tr>
						</thead>
						<tbody>
							@php $count= 0; @endphp
							@foreach($bookings as $booking)
							<tr>
								<td>{{++$count}}</td>
								<td>{{$booking->name}}</td>
								<td>{{date('h:i A',strtotime($booking->slot))}}</td>
								<td>{{date('d-m-Y',strtotime($booking->b_date))}}</td>
								<td>
								@if($booking->client_status==1 && $booking->user_status==0)
									<p class="text-primary">{{'Pending'}}</p>
								@elseif($booking->client_status==1 && $booking->user_status==1)
									<p class="text-success">{{'Booked'}}</p>
								@else
									<p class="text-danger">{{'Cancelled'}}</p>
								@endif
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
@endsection