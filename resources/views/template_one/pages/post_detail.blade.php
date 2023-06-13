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
		<!--<div class="col-lg-3 ml-auto">-->
		<!--<div class="section-title">-->
		<!--<h2>Popular Posts</h2>-->
		<!--</div>-->
		<!--<div class="trend-entry d-flex">-->
		<!--<div class="number align-self-start">01</div>-->
		<!--<div class="trend-contents">-->
		<!--<h2><a href="blog-single.html">News Needs to Meet Its Audiences Where They Are</a></h2>-->
		<!--<div class="post-meta">-->
		<!--<span class="d-block"><a href="#">Dave Rogers</a> in <a href="#">News</a></span>-->
		<!--<span class="date-read">Jun 14 <span class="mx-1">&bullet;</span> 3 min read <span class="icon-star2"></span></span>-->
		<!--</div>-->
		<!--</div>-->
		<!--</div>-->
		<!--<div class="trend-entry d-flex">-->
		<!--<div class="number align-self-start">02</div>-->
		<!--<div class="trend-contents">-->
		<!--<h2><a href="blog-single.html">News Needs to Meet Its Audiences Where They Are</a></h2>-->
		<!--<div class="post-meta">-->
		<!--<span class="d-block"><a href="#">Dave Rogers</a> in <a href="#">News</a></span>-->
		<!--<span class="date-read">Jun 14 <span class="mx-1">&bullet;</span> 3 min read <span class="icon-star2"></span></span>-->
		<!--</div>-->
		<!--</div>-->
		<!--</div>-->
		<!--<div class="trend-entry d-flex">-->
		<!--<div class="number align-self-start">03</div>-->
		<!--<div class="trend-contents">-->
		<!--<h2><a href="blog-single.html">News Needs to Meet Its Audiences Where They Are</a></h2>-->
		<!--<div class="post-meta">-->
		<!--<span class="d-block"><a href="#">Dave Rogers</a> in <a href="#">News</a></span>-->
		<!--<span class="date-read">Jun 14 <span class="mx-1">&bullet;</span> 3 min read <span class="icon-star2"></span></span>-->
		<!--</div>-->
		<!--</div>-->
		<!--</div>-->
		<!--<div class="trend-entry d-flex pl-0">-->
		<!--<div class="number align-self-start">04</div>-->
		<!--<div class="trend-contents">-->
		<!--<h2><a href="blog-single.html">News Needs to Meet Its Audiences Where They Are</a></h2>-->
		<!--<div class="post-meta">-->
		<!--<span class="d-block"><a href="#">Dave Rogers</a> in <a href="#">News</a></span>-->
		<!--<span class="date-read">Jun 14 <span class="mx-1">&bullet;</span> 3 min read <span class="icon-star2"></span></span>-->
		<!--</div>-->
		<!--</div>-->
		<!--</div>-->
		<!--<p>-->
		<!--<a href="#" class="more">See All Popular <span class="icon-keyboard_arrow_right"></span></a>-->
		<!--</p>-->
		<!--</div>-->
		</div>
	</div>
</div>