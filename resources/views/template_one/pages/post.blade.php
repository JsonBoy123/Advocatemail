

<section class="py-5">
      <div class="container py-4">
        <div class="row">
          <!-- Blog listing-->
          <div class="col-lg-9 mb-5 mb-lg-0">
          @foreach($posts as $post)
            <div class="row">
              <div class="col-lg-6"><a class="d-block post-trending mb-4" href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}"><img class="img-fluid" src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="{{$post->title}}"/></a>
              </div>
              <div class="col-lg-6">
                <h2 class="h3"> <a class="d-block reset-anchor" href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}">{{$post->title}}</a></h2>
                <p class="text-muted">{!! Str::limit($post->body,300,$end='...') !!}</p><a class="btn btn-link p-0 read-more-btn" href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}"><span>Read more</span><i class="fas fa-long-arrow-alt-right"></i></a>
              </div>
            </div>
            @endforeach
           
            <!-- Pagination-->
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </nav>
          </div>
          <!-- Blog sidebar-->
          <div class="col-lg-3">
           @include('template_one.pages.sidepanel')
          </div>
        </div>
      </div>
    </section>