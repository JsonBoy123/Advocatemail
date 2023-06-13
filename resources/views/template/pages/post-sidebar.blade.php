<div class="col-lg-3 py-100">
	<div class="bg-white px-4 ">
		<div class="mb-50">
			<h4 class="mb-3">Categories</h4>
			<ul class="pl-0 mb-0">
				@foreach(collect(session('catgs'))->where('is_post','1') as $catg)
					<li class="border-bottom">
					    <a href="{{$catg->catg_url !=null ? url($catg->catg_url) : '#'}}" class="d-block text-color py-10">{{$catg->catg_name}}</a>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>