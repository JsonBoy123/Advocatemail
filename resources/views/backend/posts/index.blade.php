@extends('backend.layouts.main')
@section('content')
<div class="card mb-5">
  <div class="card-header">
      <h5 class="card-title">Posts</h5>
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

      @role('admin|super_admin')
          <div class="row"> 
            <div class="col-md-4 form-group">
                <select class="form-control" name="catg_type" id="catg_type">
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
            </div>
            <div class="col-md-4 form-group d-none" id="userDiv">
                <select class="form-control" name="user_id" id="user_id">
                      <option value="">Select User</option>
                    @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 form-group">
                <button class="btn btn-sm btn-success" id="btnFilter">Filter</button>
            </div>
          </div>
          @endrole
          <div class="row">
            <div class="col-md-12" id="table">
  						  @include('backend.posts.table')
              
            </div>
          </div>
  				
  			</div>
  		</div>
  </div>
</div>
<script >
    $(document).ready(function(){
        $('#catg_type').on('change',function(e){
            e.preventDefault();
            var catg_type = $(this).val();
            if(catg_type == '1'){
              $('#userDiv').addClass('d-none');
            }else{
              $('#userDiv').removeClass('d-none');

            }
        });
        $('#btnFilter').on('click',function(){
          var catg_type = $('#catg_type').val();
          var user_id = $('#user_id').val();
            $.ajax({
              type:'post',
              url:"{{route('post_filter')}}",
              data:{catg_type:catg_type,user_id:user_id},
              success:function(res){
                console.log(res);
                $('#table').empty().html(res);
              }
            })

          console.log(catg_type);
        })
      });
    </script> 
@endsection