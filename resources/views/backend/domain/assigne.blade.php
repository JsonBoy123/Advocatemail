@extends('backend.layouts.main')
@section('content')
<div class="card mb-5">
    <div class="card-header">
        <h5 class="card-title">Add Domain</h5>
    </div>
    <div class="card-body">
        <form action="{{route('domain.assigne_store')}}" method="post"  autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group field">
                    <lable>Select User</lable>
                    <select class="form-control" name="user_id" id="user_id">
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{old('user_id') == $user->id ? 'selected=selected' : ''}}>{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <lable>Domain Name</lable>
                    <input type="text" name="domain_name" value="{{old('domain_name')}}" class="form-control" oninput="this.value = this.value.replace(/[^a-z|-]/g,'')">
                </div>
                <div class="col-md-2 form-group pt-4">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info" id="checkBtn">Check Availablity</a>
                </div>
                <div class="col-md-6 form-group">
                    <lable>Site Name</lable>
                    <input type="text" name="site_name" value="{{old('site_name')}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <lable>Site Logo</lable>
                    <input type="file" name="site_logo"  class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <lable>Template Assign</lable>
                    <select class="form-control" name="template_id">
                        <option value="">Select Template</option>
                        @foreach($templates as $template)
                            <option value="{{$template->template_id}}">{{$template->template_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 form-group">
                    <hr>
                    <h4>SEO Information</h4>
                </div>
                <div class="col-md-6 form-group">
                    <lable>Sef Title</lable>
                    <input type="text" name="sef_title" value="{{old('set_title')}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <lable>Sef Description</lable>
                    <input type="text" name="sef_description" value="{{old('sef_description')}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <lable>Sef Keywords</lable>
                    <input type="text" name="sef_keyword" value="{{old('sef_keyword')}}" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                    <lable>Sef Image Alt</lable>
                    <input type="text" name="sef_imagealt" value="{{old('sef_imagealt')}}" class="form-control">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-sm btn-success">Submit</button>
                </div>
            </div>
            
        </form>
    </div>
</div>
<script>
	$(document).ready(function(){
		$('#checkBtn').on('click',function(e){
			e.preventDefault();
			var domain_name = $('input[name="domain_name"]').val();
			var user_id = $('#user_id').val();
			if(user_id !=''){
    			if(domain_name !=''){
    				$.ajax({
    					type:'POST',
    					url:"{{url('domain-check')}}",
    					data:{domain_name:domain_name,user_id:user_id},
    					success:function(res){
    						if(res == 'true'){
    							alert('domain is available.');
    						}else{
    							alert('domain is not available.');
    						}
    					}
    				});
    			}else{
    				alert('Enter domain name');
    			}
			}else{
			    alert('Select User Name');
			}

		});
	})
</script>
@endsection