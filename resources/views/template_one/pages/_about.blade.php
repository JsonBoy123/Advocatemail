<div class="container">
	<div class="row">
		<div class="col-lg-9">
			<div class="section-title">
				<span class="caption d-block small">Categories</span>
				<h2>About</h2>
			</div>
			@foreach($posts as $post)
				<div class="post-entry-2 d-flex">
					<div class="thumbnail order-md-2" style="background-image: url('{{asset('storage/'.$post->image_path)}}')"></div>
					<div class="contents order-md-1 pl-0">
						<h2><a href="blog-single.html">{{$post->title}}</a></h2>
						<p class="mb-3">{!! Str::limit($post->body,120,$end='...') !!}</p>
						<div class="post-meta">
							<span class="d-block"><a href="#">By {{$post->user->name}}</a> in <a href="#">{{$post->category->catg_name}}</a></span>
							<span class="date-read">{{date('M d Y ', strtotime($post->start_date))}} </span>
						</div>
					</div>
				</div>
			@endforeach

		</div>
		@include('template_one.pages.sidepanel')
	</div>
</div>