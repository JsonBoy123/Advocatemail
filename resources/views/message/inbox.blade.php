@extends('message.sidebar')
@section('content')
<!-- /.Content Header Start-->
<style>
	.box .nav-stacked>li {
    padding: 20px 0px !important;
}

.nav{
	    flex-direction: column !important;
}
</style>
@section('inbox-body')
	<div class="col-md-9">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Inbox</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body table-responsive">
					<div class="row">
						<div class="col-md-12">
							<div class="mailbox-controls">
								<!-- Check all button -->
								<!-- <button class="btn btn-default btn-sm">
									<input type="checkbox" id="checkAll" >
								</button> -->

								<div class="btn-group">
				                	<!-- <a href="{{route('message.trash')}}" id="trashBtn" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></a>	 -->
				                	<button class="btn btn-default btn-sm delete-all" data-url=""><i class="fa fa-trash"></i></button>                  
				                </div>
				                <!-- /.btn-group -->

				                <div class="btn-group">
				                	<button onClick="location.reload(true);" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>	                  
				                </div>

								<!-- /.pull-right -->
							</div>
						</div>
					</div>

					<table class="table table-hover table-striped table-bordered"  id="messageTable">
						<thead>
							<tr class="text-muted">
								<th><input type="checkbox" id="check_all"></th>
								<th>SNo.</th>
								<th>From</th>
								<th>Subject</th>
								<th>Message</th>
								<th>Date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@php $count= 1;@endphp
							@if(count($messages)!=0)
							@foreach($messages as $message)

							<tr class="{{$message->status==0 ? 'unread_message' : ''}} ">
								<td><input type="checkbox" class="checkbox" data-id="{{$message->id}}"></td>
								<td>{{$count++}}</td>
								<td>{{$message->name}}</td>
								<td>{{$message->subject}}</td>
								<td>{{mb_substr($message->message,0,40).'...'}}</td>
								<td>{{ isset($message->created_at) ? $message->created_at->format('d M, Y') : '' }}</td>
								<td>
									<a class="" href="{{route('message.show',$message->id)}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
								</td>

								</tr>

								@endforeach
								@else
								<tr>
									<td class="text-center" colspan="6">No Messages</td>
								</tr>
								@endif
							</tbody>
						</table>  
					</div>
				</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function () {

  $('#check_all').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
    $(".checkbox").prop('checked', true);  
    } else {  
    $(".checkbox").prop('checked',false);  
    }  
  });
  $('.checkbox').on('click',function(){
    if($('.checkbox:checked').length == $('.checkbox').length){
    $('#check_all').prop('checked',true);
    }else{
    $('#check_all').prop('checked',false);
    }
  });
  $('.delete-all').on('click', function(e) {
    var idsArr = [];  
    $(".checkbox:checked").each(function() {  
      idsArr.push($(this).attr('data-id'));
    });  
    if(idsArr.length <=0)  
    {  
      alert("Please select atleast one record to delete.");  
    }else{  
      if(confirm("Are you sure, you want to Dismiss the selected Notification ?")){  
        var strIds = idsArr.join(","); 
        
        $.ajax({
          url: "/delete-multiple-category",
          type: 'POST',
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data: 'id='+strIds,
          success: function (data) {
            // alert(data);
          if (data['status']==true) {
            $(".checkbox:checked").each(function() {  
            $(this).parents("tr").remove();
            });
            alert(data['message']);
          } else {
            alert('Whoops Something went wrong!!');
          }
          },
          error: function (data) {
          alert(data.responseText);
          }
        });
      }  
    }  
  });
  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
    element.closest('form').submit();
    }
  });   
});
</script>

		@endsection