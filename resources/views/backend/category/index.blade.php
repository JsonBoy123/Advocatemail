@extends('backend.layouts.main')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/nestable.css')}}">
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Categories 
          
        </h4>
        
    </div>
    <div class="card-body">
        <div class="cf nestable-lists">

            <div class="dd" id="nestable" style="width: 100%">
                <ol class="dd-list">
                    @foreach($catgs as $category)
                        <li class="dd-item" data-id="{{$category->catg_id}}" >
                            <div class="dd-handle">
                                <span id="category-item" class=""> {{$category->catg_name}}</span>
                                <a class="close close-assoc-file"><i class="fa fa-edit text-success"></i></a>
                            </div>
                        </li>
                        
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/nestable.js')}}"></script>
<script>

$(document).ready(function()
{

 $('.dd').nestable().on('change', function() {
     var data = $('.dd').nestable('serialise');
     // console.log(data);
    var ids = new Array();
    $('.dd li').each(function() {
        ids.push($(this).attr("data-id"));
    });

    $.ajax({
        type:'post',
        url: '{{url('/categoriesPosition')}}',
        data:{data:data,ids:ids},
        success:function(res){
            console.log(res);
            // location.reload();
        }
    });
});

   

});
</script>
@endsection