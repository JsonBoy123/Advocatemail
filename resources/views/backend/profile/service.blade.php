@extends('backend.layouts.main')
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <!-- <h3 class=""><a href="{{route('referral.create')}}" class="btn btn-sm btn-primary pull-right">Add Referral User</a></h3> -->
        </div>
        <div class="box-body table-responsive" style="margin-top:40px;">
          <table class="table table-striped table-bordered" id="myTable">
            <thead>
              <tr>
                <th>Service</th>
                <th>Charges</th>
                <th>Billing</th>
                <th>status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($prod as $prods)
              <tr>
                <td>{{$prods->prod_desc}}</td>
                <td>{{$prods->prod_rate}}</td>
                <td>{{$prods->unit_desc}}</td>
                <td>{{$prods->status}}</td>
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