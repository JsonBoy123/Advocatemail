@extends('backend.layouts.main')
@section('content')
		<div class="row" style="margin-left:0; margin-right:0;">
			<div class="col-md-12" >
				<div class="box box-primary">
					<div class="box-body">
						<form action="{{route('message.store')}}" method="post">
							@csrf
							<div class=" row form-group ">
								<label class="col-md-2 mt-2" >To : </label>
								<div class="col-md-10">
									<input type="text" name="" class="form-control" value="{{$lawyer_details->name}}" readonly>
									<input type="hidden" name="recv_id" value="{{$lawyer_details->id}}">
								</div>
							</div>

							<div class="row form-group">
								<label class="col-md-2 mt-2" >Subject : </label>
								<div class="col-md-10 mt-2">
									<input type="text" name="subject" class="form-control" value="{{old('subject')}}">
									@error('subject')
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row form-group">
								<label class="col-sm-12 col-md-12 mt-2">Message</label>
								<div class="col-md-12 col-xl-12 col-sm-12 mt-2">
									<textarea class="form-control" name="message" rows="10" cols="5" id="summernote">{{old('message')}}</textarea>
									@error('message')
									<span class="invalid-feedback d-block" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row form-group">
								<div class="col-md-12 col-sm-12 col-xl-12 mt-4">
									<input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
									<input type="hidden" name="status" value='0'>
									<button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-mail-bulk icon-lg icon-fw"></i> Send Message</button>
								</div>	
							</div>				

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection