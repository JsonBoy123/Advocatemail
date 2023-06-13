@if($post->meta_title!=null || $post->meta_keywords!=null || $post->meta_description!=null)
@section('meta_title', $post->meta_title)
@section('meta_keywords', $post->meta_keywords)
@section('meta_description', $post->meta_description)
@endif

<div class="p-5">
	<div class="container">
		<div class="row">
		    <div class="col-md-9">
                <h3 class="font-weight-bold">{{$post->title}}</h3>
                <hr>
            </div>
    		<div class="col-lg-9">
    			<div class="pr-4 pb-3" style="float:left">
    			<img  src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="{{$post->title}}" class="img-fluid" style="min-height: 300px; max-height:  300px">
    			</div>
    			<div style="text-align: justify; font-family:Arial">
                   {!! $post->body !!}
                   
               </div>
    		</div>
    		 <div class="col-lg-3">
    		@include('template_one.pages.sidepanel')
    	     </div>
		
		
		
		
		</div>
	</div>
</div>