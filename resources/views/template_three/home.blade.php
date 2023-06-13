  @php 
    $sliderPosts = \App\Models\Posts::where(['status' => '1','user_id'=>session('user_id'),'is_slider' => '1'])->orderBy('order_num')->get()->take('3');
    $servicePosts = \App\Models\Posts::where(['status' => '1' , 'user_id' => session('user_id'), 'catg_id' => '14'  ])->get()->take('4');
    $blogPosts = \App\Models\Posts::where(['status' => '1' , 'user_id' => session('user_id'), 'catg_id' => '17'  ])->get()->take('4');
    
    $aboutPosts = \App\Models\Posts::where(['status' => '1' , 'user_id' => session('user_id'), 'catg_id' => '10'  ])->get()->take('2');
  @endphp

  <style>
      .box-simple .icon-outlined{
        color:#4fbfa8;
        border:1px solid #4fbfa8;
        transition:all 0.3s;
      }

      .icon-outlined{
        width:80px;
        height:80px;
        line-height:80px;
        text-align:center;
        display:inline-block;
        border-radius:50%;
        margin-bottom: 20px;
      }

      .col-lg-6{
        flex: 0 0 50%;
        max-width: 50%;
      }
  </style>

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
                <h2 class="title1">{{$sliderPost->title}}</h2>
               
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

<!---about us---->
 <section class="bar">
        <div class="container text-center">
          <div class="col-md-12">
            <div class="heading text-center">
              <h2>About Us</h2>
            </div>
            <div class="row">
               @foreach($aboutPosts as $aboutPost)
              <div class="col-lg-6 col-md-6">
                <div class="box-simple">
                  <div class="icon-outlined"><i class="fa fa-print"></i></div>
                  <h3 class="h4">{{$aboutPost->title}}</h3>
                  <p>{!! Str::limit($aboutPost->body,300,$end='...') !!}</p>
                  <a href="{{url('/'.(strtolower($aboutPost->category->catg_name)).'/'.$aboutPost->sefriendly)}}" class="btn btn-sm btn-primary"> Read More</a>
                </div>
              </div>
              @endforeach
             
              
            </div>
           
          </div>
        </div>
      </section>

      <!---services --->
      <section class="bar bg-gray">
        <div class="container">
          <div class="heading text-center">
            <h2>Services</h2>
          </div>
          
          <div class="row">
             @foreach($servicePosts as $servicePost)
            <div class="col-lg-3">
              <div class="home-blog-post">
                <div class="image">
                  <img src="{{asset($servicePost->image_path !=null ? 'storage/'.$servicePost->image_path : 'no_image.jpg')}}" alt="..." class="img-fluid">
                </div>
                <div class="text">
                  <h4><a href="{{url('/'.(strtolower($servicePost->category->catg_name)).'/'.$servicePost->sefriendly)}}">{{$servicePost->title}}</a></h4>
                  <div>
                  <p class="intro">{!! Str::limit($servicePost->body,150,$end='...') !!}</p>
                   </div>
                   <hr>
                   <div>
                  <a href="{{url('/'.(strtolower($servicePost->category->catg_name)).'/'.$servicePost->sefriendly)}}" class="btn btn-sm btn-primary">Read More</a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
                      </div>
        </div>
      </section>


      <!---blog---->

      <div id="content">
        <div class="container">
          <section class="bar mb-0">
            <div class="row">
              <div class="col-md-12">
                <div class="heading text-center">
                  <h2>Blog</h2>
                </div>
                
                
                <div class="row text-center">
                    @foreach($blogPosts as $blogPost)
                  <div class="col-md-3">
                    <div data-animate="fadeInUp" class="team-member">
                      <div class="image">
                        <a href="team-member.html">
                          <img src="{{asset($blogPost->image_path !=null ? 'storage/'.$blogPost->image_path : 'no_image.jpg')}}" alt="{{$blogPost->title}}" class="img-fluid rounded-circle">
                        </a>
                      </div>
                      <h4><a href="{{url('/'.(strtolower($blogPost->category->catg_name)).'/'.$blogPost->sefriendly)}}">{{$blogPost->title}}</a></h4>
                      <p class="role"></p>
                      {{-- <ul class="social list-inline">
                        <li class="list-inline-item"><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="email"><i class="fa fa-envelope"></i></a></li>
                      </ul> --}}
                      <div class="text">
                        <p>{!! Str::limit($blogPost->body,100,$end='...') !!}</p>
                      </div>
                    </div>
                  </div>
                    @endforeach

                </div>
              </div>
            </div>
          </section>
        </div>
      </div>

   


