<table class="table table-bordered table-striped" id="tablePost">
	<thead>
		<tr>
			<th>#</th>
			<th>Title</th>
			<th>Body</th>
			<th>Category</th>
			<th>Image</th>
			<th>status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="tbody">

		@php $count = 1; @endphp
	@foreach($posts as $post)
		<tr>
			<td>{{$count++}}</td>
			<td>{{$post->title}}</td>
			<td>{!! Str::limit($post->body,150,$end='...') !!}</td>
			<td>{{$post->category !=null ?$post->category->catg_name : ''}}</td>
			<td>
	           <img class="img-fluid rounded-top" src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="{{$post->title}}" width="200" height="200"></td>
			<td>{{$post->status == '1' ? 'Active' : 'Not Active' }}</td>
			<td>
				<a href="{{route('post.show',$post->article_id)}}"><i class="fa fa-eye text-primary"></i></a>

				<a href="{{route('post.edit',$post->article_id)}}"><i class="fa fa-edit text-success"></i></a>

				<a href="{{route('post.delete',$post->article_id)}}" onclick="return confirm('Are you sure you want to delete this post')"><i class="fa fa-trash text-danger"></i></a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<script>
    $(document).ready(function(){
        $('#tablePost').DataTable();
    });
</script>
