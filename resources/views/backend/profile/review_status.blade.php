@extends('backend.layouts.main')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
      </div>
        @if($message = Session::get('success'))
        <div class="alert bg-success">
          {{$message}}
        </div>
        @endif
        <table class="table table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Name</th>
              <th>Comments</th>
              <th>Review Rate</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              @php $i=1; @endphp
              @foreach ($reviews as $row)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$row->review_date}}</td>
              <td>{{$row->customers->firstname}}</td>
              <td>{{$row->review_text}}</td>
              <td>{{$row->review_rate}}</td>
              @if($row->review_status == 'P')
              <td>{{$row->review_status}}&nbsp;&nbsp;<input data-review_id="{{$row->review_id}}" value ="{{$row->review_status}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $row->review_status ? '' : 'checked' }}></td>
              @else
              <td>{{$row->review_status}}&nbsp;&nbsp;<input data-review_id="{{$row->review_id}}" value ="{{$row->review_status}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $row->review_status ? 'checked' : '' }}></td>
              @endif
              <td>
                 <!-- <a class="btn btn-primary btn-xs" href=" {{ url('edit_review_status',$row->review_id) }}"><i class="fa fa-eye" aria-hidden="true"></i></a> -->
                 <a href="{{ route('delete_review_status',$row->review_id)}}" onclick="return confirm('Are you sure want to remove ?')"><button class="btn btn-danger btn-xs" style="font-size:10px;"><i class="fa fa-lg fa-trash"></i></button></a></td>
            </tr>
            @endforeach
          </tbody>  
        </table>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(function() {
    $('.toggle-class').change(function() {
        
       let status = $(this).prop('checked') == true ? 'A' : 'P'; 
       let user_id = $(this).data('review_id');
       
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "{{url('/changeStatus')}}",
          data: {'review_status': status, 'review_id': user_id},
          success: function(data){
           
            console.log(data)
            location.reload();
          }
        });
    })
  });
</script>
@endsection