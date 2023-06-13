@extends('lawyer.main')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 style="margin-top: 10px;">Review Status</h3> 
        </div>
        @if($message = Session::get('success'))
        <div class="alert bg-success">
          {{$message}}
        </div>
        @endif
       <form method="POST" action="{{ url('update_review_status/')}}" enctype="multipart/form-data">
       @csrf
       @method('PATCH')
        <table class="table table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th>S.No</th>
              <th>Date</th>
              <th>Name</th>
              <th>Comments</th>
              <th>Status</th>
              <th>Review Rate</th>
            </tr>
          </thead>
          <tbody>
            @php $i=1; @endphp  
            @foreach ($reviews as $row)
            <tr>
              <td>{{$i++}}</td>
              <td>{{ $row->review_date}}</td>
              <td>{{ $row->customers->name}}</td>
              <td>{{ $row->review_text}}</td>
              <td class="text-danger"><input type="text" name="review_status" id="review_status" class="form-control input-sm" value="{{ $row->review_status}}"/></td>
              <td>{{ $row->review_rate}}</td>
              @endforeach
            </tr>
          </tbody>  
        </table>
        <div class="row">
          <div class="form-group col-md-12">
             <button type="submit" name="submit" class="btn btn-primary error-w3l-btn px-4" value="submit">Submit</button>
          </div>
        </div>
       </form>
  </div>
      </div>
  </div>
</section>
@endsection