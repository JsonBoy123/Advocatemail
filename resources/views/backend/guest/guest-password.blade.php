@extends('backend.guest.head-foot')
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
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header with-border">
						<div class="card-title">
							<h4>Change Password</h4>
						</div>
						<br>
						<div class="card-body">
							@if($message = Session::get('success'))
							<div class="alert bg-success">
								{{$message}}
							</div>
							@endif
							@if($message = Session::get('warning'))
							<div class="alert bg-warning">
								{{$message}}
							</div>
							@endif
							<form action="{{url('change-password')}}" method="get">
								@csrf
								<div class="row">
									<div class="col-md-12 form-group">
										<label>Old Password</label>
										<input type="password" name="old_password" class="form-control" id="password-field1" required="required" value="{{old('old_password')}}">
										<span toggle="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										@error('old_password')
										<span style="color:#e3342f; font-size: 80%;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label>New Password</label>
										<input type="password" name="new_password" class="form-control" id="password-field2" >
										<span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
										@error('new_password')
										<span style="color:#e3342f; font-size: 80%;">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label>Confirm Password</label>
										<input type="password" name="confirm_password" class="form-control" id="password-field3" >      
										<span toggle="#password-field3" class="fa fa-fw fa-eye field-icon toggle-password"></span>
									</div>
								</div>
								<div class="row">	
									<div class="col-md-12 form-group">
										<button class="btn btn-primary btn-block">Save</button>
									</div>
								</div>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection