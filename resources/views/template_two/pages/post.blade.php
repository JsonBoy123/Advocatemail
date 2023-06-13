

     <section class="featured-posts no-padding-top">
      <div class="container">
        <header> 
          <h2></h2>
          <p class="text-big"></p>
        </header>
       @foreach($posts as $key => $post)
        <div class="row d-flex align-items-stretch">
          @if($key % 2 == 0)
         <div class="text col-lg-7">
            <div class="text-inner d-flex align-items-center">
              <div class="content">
                <header class="post-header">
                  <a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}">
                    <h2 class="h4">{{$post->title}}</h2></a>
                </header>
                <p>{!! Str::limit($post->body,250,$end='...') !!}
                </p>
                 {{-- <footer class="post-footer d-flex align-items-center"> --}}
                  <a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}" class="btn btn-primary">
                    Read More
                    </a>
                  
                 {{--  <div class="comments"><i class="icon-comment"></i></div> --}}
                {{-- </footer> --}} 
              </div>
            </div>
          </div>
          <div class="image col-lg-5" style="min-height: 300px;">
            <img src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="...">
          </div>
          @else
          <div class="image col-lg-5" style="min-height: 300px;">
            <img src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="...">
          </div>
          <div class="text col-lg-7">
            <div class="text-inner d-flex align-items-center">
              <div class="content">
                <header class="post-header">
                  <a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}">
                    <h2 class="h4">{{$post->title}}</h2></a>
                </header>
                <p>{!! Str::limit($post->body,250,$end='...') !!}
                </p>
                <a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}" class="btn btn-primary">
                    Read More
                    </a>
                  
                
              </div>
            </div>
          </div>
          @endif


        </div>
        @endforeach  
      </div>
    </section>