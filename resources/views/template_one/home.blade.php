
  @php 
    $sliderPosts = \App\Models\Posts::where(['status' => '1','user_id'=>session('user_id'),'is_slider' => '1'])->orderBy('order_num')->get()->take('3');
    $servicePosts = \App\Models\Posts::where(['status' => '1' , 'user_id' => session('user_id'), 'catg_id' => '14'  ])->get()->take('3');
    $blogPosts = \App\Models\Posts::where(['status' => '1' , 'user_id' => session('user_id'), 'catg_id' => '17'  ])->get()->take('3');
    
    $aboutPosts = \App\Models\Posts::where(['status' => '1' , 'user_id' => session('user_id'), 'catg_id' => '10'  ])->get()->take('2');
  @endphp



<section class="hero">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        
        @foreach($sliderPosts as $key => $sliderPost)
        <div class="carousel-item {{$key == 0 ? 'active' :''}}">
            <img class="d-block w-100" src="{{asset($sliderPost->slider_image !=null ? 'storage/'.$sliderPost->slider_image : 'no_image.jpg')}}" alt="First slide" style="height:500px">
            <div class="carousel-caption d-none d-md-block">
                <h1>{{$sliderPost->title}}</h1>
               
            </div>
        </div>
         @endforeach
   
    </div>
  

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</section>

  <!---- About Us ----->
    <section>
     <div class="container">
        <header> 
          <h2>About Us</h2>
          <p class="text-big"></p>
        </header>
        <div class="row mt-5">
           @foreach($aboutPosts as $aboutPost)
                <div class="col-md-6">
                    <h3 class="h4">{{$aboutPost->title}}</h3>
                    <div> 
                        <p>{!! Str::limit($aboutPost->body,500,$end='...') !!}</p>
                    </div>
                    <a href="{{url('/'.(strtolower($aboutPost->category->catg_name)).'/'.$aboutPost->sefriendly)}}" class="btn btn-sm btn-primary"> Read More</a>
                </div>
               
           @endforeach
        </div>
    </div>    
    </section>

    <!---- Services ----->
    <section class="latest-posts"> 
      <div class="container">
        <header> 
          <h2>Services</h2>
          <p class="text-big"></p>
        </header>
        <div class="row">
            @foreach($servicePosts as $servicePost)
          <div class="post col-md-4">
            <div class="post-thumbnail"><a href=""><img src="{{asset($servicePost->image_path !=null ? 'storage/'.$servicePost->image_path : 'no_image.jpg')}}"  alt="..." class="img-fluid cstm"></a></div>
            <div class="post-details">
              <a href="{{url('/'.(strtolower($servicePost->category->catg_name)).'/'.$servicePost->sefriendly)}}">
                <h3 class="h4">{{$servicePost->title}}</h3></a>
              <p class="text-muted">{!! Str::limit($servicePost->body,150,$end='...') !!}</p>
            </div>
          </div>
          
          @endforeach
        </div>
      </div>
    </section>


     <!-----Blog ----->

<div class="container">
      <header> 
          <h2>Blogs</h2>
          <p class="text-big"></p>
        </header>
      <div class="row">
        <!-- Latest Posts -->
        <main class="posts-listing col-lg-12"> 
          <div class="container">
            <div class="row">
              <!-- post -->
              @foreach($blogPosts as $blogPost)
              <div class="post col-xl-4">
                <div class="post-thumbnail"><a href=""><img src="{{asset($blogPost->image_path !=null ? 'storage/'.$blogPost->image_path : 'no_image.jpg')}}" alt="..." class="img-fluid cstm"></a></div>
                <div class="post-details">
                  {{-- <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last">20 May | 2016</div>
                    <div class="category"><a href="#">Business</a></div>
                  </div> --}}
                  <a href="{{url('/'.(strtolower($blogPost->category->catg_name)).'/'.$blogPost->sefriendly)}}">
                    <h3 class="h4">{{$blogPost->title}}</h3></a>
                  <p class="text-muted">{!! Str::limit($blogPost->body,250,$end='...') !!}</p>
                  {{-- <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div>
                      <div class="title"><span>John Doe</span></div></a>
                    <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                    <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                  </footer> --}}
                </div>
              </div>
              @endforeach 
              <!-- post -->


            </div>
            
           
          </div>
        </main>
        
      </div>
    </div>
