@extends('backend.layouts.main')
@section('content')
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header with-border"> 
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <h4 class="card-title">User List </h4>
                    </div>
                    <div class="col-md-6 col-sm-6 text-right">
                        <a href="{{route('user.create')}}" class="btn btn-sm btn-primary pull-right">Add User</a>
                    </div>
                </div>
          </div>
          <div class="card-body">
              @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{$message}}
                </div>
              @endif
              <table class="table table-bordered table-striped" id="table">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Mobile</th>
                          <th>City</th>
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
                          {{-- <td>{{$user->city_code !=null ? getFullAddress($user) : ''}}</td> --}}
                          <td>{{$user->city->city_name}}</td>
                          <td width="130">
                              <a href="javascript:void(0)"  class="{{$user->status == 'P' ? 'bg-secondary' : 'bg-success'}} text-white p-2 ml-2 rounded-circle approval" data-id="{{$user->id}}"><i class="fa fa-key" title="{{$user->status == 'P' ? 'Unapprove' : 'Approve'}}" ></i></a> 
                              <a href="{{route('user.edit',$user->id)}}" class="bg-info text-white p-2 ml-2 rounded-circle" title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="{{route('user.delete',$user->id)}}" class="bg-danger text-white p-2 ml-2 rounded-circle" title="Delete"><i class="fa fa-trash"></i></a>
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
<script>
    $(document).ready(function(){
        $('#table').DataTable();
        $(document).on('click','.approval',function(e){
            e.preventDefault();
            var user_id = $(this).data('id');
            fn_user_approval(user_id);


        });
    });
</script>
@endsection