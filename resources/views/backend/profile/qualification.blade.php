@extends('backend.layouts.main')
@section('content')
<style>
.flexi-content{
	display: flex;
    flex-direction: row;
    font-size: 16px;
}
.flex-item-left, .flex-item-right {
    padding: 10px;
    flex: 50%;
}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="card card-primary">
			<div class="card-body">
				<form action="{{route('qualification.store')}}" method="post" autocomplete="off">
				{{csrf_field()}}
				<div class="flexi-content" >

					<div class="flex-item-left"  style="margin-top:10px;" >
						<label>Course Type <span class="text-danger">*</span></label>
						<select class="form-control" name="qual_catg_code" id="qual_catg_code" required="required"> 
							<option value="0">Select course type</option>
							@foreach($qual_catgs as $qual_catg)
								<option value="{{$qual_catg->qual_catg_code}}" {{old('qual_catg_code') == $qual_catg->qual_catg_code  ? 'selected' :  ''}} > {{$qual_catg->qual_catg_desc}}</option>
							@endforeach
						</select>

						@error('qual_catg_code')
							<span class=" text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="flex-item-right" style="margin-top:10px;"> 
						<label for="qual_code">Course Name <span class="text-danger">*</span></label>
						<select class="form-control" name="qual_code" id="qual_sub" required="required">
						</select>
						@error('qual_code')
							<span class=" text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="flex-item-right" style="margin-top:10px;"> 
						<label>Passing Year <span class="text-danger">*</span></label>
						<input type="text" name="pass_year" placeholder="Enter passing year" class="form-control" value="{{old('pass_year')}}" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" required="required">
						@error('pass_year')
							<span class=" text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="flex-item-right" style="margin-top:10px;"> 
						<label for="pass_perc">Passing Percentage <span class="text-danger">*</span></label>
						<input type="text" name="pass_perc" placeholder="Enter passing Percentage" class="form-control" value="{{old('pass_perc')}}" oninput="this.value = this.value.replace(/[^0-9|.]/g, '').replace(/(\..*)\./g, '$1');" required="required">
						@error('pass_perc')
							<span class=" text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="flex-item-right" style="margin-top:10px;">
						<label for="pass_division">Passing Division <span class="text-danger">*</span></label>
						<select name="pass_division" class="form-control" required="required">
							<option value="0">Select Division</option>
							<option value="1" {{old('pass_division')=='1' ? 'selected' : '' }}>1st</option>
							<option value="2" {{old('pass_division')=='2' ? 'selected' : '' }}>2nd</option>
							<option value="3" {{old('pass_division')=='3' ? 'selected' : '' }}>3rd</option>
						</select>
						@error('pass_division')
							<span class=" text-danger" role="alert">
							<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

				</div>
				<div class="row">
					<div class="col-md-12" style="margin-top:10px;">
						<button class="btn btn-md btn-primary" class="form-control" id="submit1">Submit</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
			
	<div class="col-md-12 ">
		<div class="card card-primary">
			<div class="card-header with-border" >
				<h5 style="margin-top: 10px;">Your Qualification</h5>
			</div>
		<div class="card-body table-responsive ">
			<table id="qualification" class="table table-hover table-striped">
					<thead>
						<tr class="text-center">
							<th>S.No.</th>
							<th>Course Type</th>
							<th>Course Name</th>
							<th>Passing Year</th>
							<th>Passing Percentage</th>
							<th>Passing Division</th>
							<th>Action</th>
						</tr>							
					</thead>
					<tbody>
						@php $count = 0; @endphp
						@foreach($qualifications as $quali)
						<tr class="text-center">
							<td>{{ ++$count }}</td>
							<td>{{ $quali->qual_catg_desc }}</td>
							<td>{{ $quali->qual_desc }}</td>
							<td>{{ $quali->pass_year }}</td>
							<td>{{ $quali->pass_perc }}</td>
							<td>{{ $quali->pass_division}}</td>	
							<td>
									<a href="{{route('qualification.edit',$quali->id)}}"><i class="fa fa-edit text-success btn-sm"></i></a>
									<a href=""><i class="fa fa-trash text-danger btn-sm"  onclick="return confirm('Are you sure?')"></i></a>

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

@if($message = Session::get('warning'))
	<script type="text/javascript">
		var messsge = "{{$message}}";
		alert(messsge);
	</script>
@endif
@if($message = Session::get('success'))
	<script type="text/javascript">
		var messsge = "{{$message}}";
		alert(messsge);
	</script>
@endif

<script type="text/javascript">

	$(document).ready(function(){
		// $('#qualification').DataTable();
	});

$(document).ready(function(){
	$('#qual_catg_code').on('change',function(){
		var qual_catg_code = $(this).val();

		fn_get_qual(qual_catg_code);
	});
});
</script>

@endsection