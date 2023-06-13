    
    @include('template.partials.slider')

    @php 
        //$posts = Posts::where(['catg_id' => session('catg_id'),'status' => '1','user_id'=>session('user_id')])->get();
		 
	@endphp
    @php 
        $featurePosts = \App\Models\Posts::where(['catg_id' => '7','status' => '1','user_id'=>session('user_id')])->orderBy('order_num')->get()->take(6);
        $serivcePosts = \App\Models\Posts::where(['catg_id' => '19','status' => '1','user_id'=>session('user_id')])->orderBy('order_num')->get()->take(3);
        $aboutPosts = \App\Models\Posts::where(['catg_id' => '2','status' => '1','user_id'=>session('user_id')])->orderBy('order_num')->get()->take(2);
        $blogPosts = \App\Models\Posts::where(['catg_id' => '16','status' => '1','user_id'=>session('user_id')])->orderBy('order_num')->get()->take(20);
        //$newsPosts = \App\Models\Posts::where(['catg_id' => '20','status' => '1','user_id'=>session('user_id')])->orderBy('order_num')->get()->take(3);
        $testimonialPosts = \App\Models\Posts::where(['catg_id' => '8','status' => '1','user_id'=>session('user_id')])->orderBy('order_num')->get()->take(3);

       
    @endphp

<section class="mission section p-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
           <div class="card shadow-sm card-border-top">
                <div class="card-header text-center p-2 "  style="border-radius: 0px !important">
                  <h2 class="card-title section-title-border-gray">Browse Lawyers in States</h2>
                </div>
                <div class="card-body p-5 bg-gray">
                    <div class="row" id="stateRow">
                        @foreach($states as $state)
                          <div class="col-md-4">
                              <a href="javascript:void(0)" class="text-dark stateView" id="{{$state->state_code}}" data-id="{{$state->state_name}}"> <i class="fa fa-map-marker "></i> {{$state->state_name}} ({{$state->state_count}})</a><br>
                          </div>
                        @endforeach
                    </div>
                    <div class="row d-none" id="cityRow">
                        
                        
                    </div>
                    <div class="row d-none" id="cityRow1">
                        <div class="col-md-12 mt-5 text-center">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary p-2" id="backStateBtn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
</section>

<section class="section"  style="padding: 0px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        {{-- <h5 class="section-title-sm"></h5> --}}
        <h2 class="section-title section-title-border">Services</h2>
      </div>
      <!-- service item -->
        @foreach($serivcePosts as $key => $serivcePost)
          <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
            <div class="card text-center">
              <h4 class="card-title pt-3" style="height:60px !important">{{$serivcePost->title}}</h4>
              <div class="card-img-wrapper">
                <img class="card-img-top rounded-0" src="{{asset($serivcePost->image_path !=null ? 'storage/'.$serivcePost->image_path : 'no_image.jpg')}}" alt="service-image" style="height: 242px  !important;">
              </div>
              <div class="card-body p-0">
                <i class="square-icon translateY-33 rounded ti-bar-chart"></i>
                <div class="card-text mx-2 mb-0 text-align-justify">{!! Str::limit($serivcePost->body,70,$end="...") !!}</div>
                <a href="{{url('/'.(strtolower($serivcePost->category->catg_name)).'/'.$serivcePost->sefriendly)}}" class="btn btn-secondary translateY-25">Read
                  More</a>
              </div>
            </div>
          </div>
      @endforeach
      
    </div>
  </div>
</section>


<section class="about section-sm overlay" style="background-image: url({{asset('123.jpg')}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 ml-auto">
                <div class="rounded p-sm-5 py-3  bg-secondary">
                    <h3 class="section-title section-title-border-half text-white">Feature in Advocate Mail?</h3>
                    <!--<p class="text-white mb-40">Unique features of advocate mail.</p>-->
                    <div class="row">
                  
                      @foreach($featurePosts as $featurePost)
                      <ul class="d-inline-block pl-0 col-md-6">
                          <li class="font-secondary mb-10 text-white float-sm-left mr-sm-5">
                              <a class="text-white" href="{{url('/'.(strtolower($featurePost->category->catg_name)).'/'.$featurePost->sefriendly)}}"><i class="text-primary mr-2 ti-arrow-circle-right"></i>{{Str::limit($featurePost->title,33,$end='...')}}</a>
                          </li>
                      </ul>
                      @endforeach
                           
                    </div>
                    <a href="{{url('/features')}}" class="btn btn-primary mt-4">Explore More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section p-4">
  <div class="container">
    <div class="row">
      @foreach($aboutPosts as $aboutPost)
   
      <div class="col-lg-6">
        <h3 class="">{{$aboutPost->title}}</h3>
         <div style="text-align:justify;min-height: 220px !important">
             {!! Str::limit($aboutPost->body,500,$end='...') !!}
         </div>
         <br>
         <a href="{{url('/'.(strtolower($aboutPost->category->catg_name)).'/'.$aboutPost->sefriendly)}}" class="btn btn-sm btn-primary"> Read More</a>
      </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<section class="section bg-gray p-4 pb-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-title section-title-border-gray">Recent Blogs</h2>
      </div>
    </div>
    <div class="row work-slider">
      {{-- <div class="col-lg-3 card px-0">
        <div class="card-body p-0">
          <img class=" w-100 h-100" src="{{asset($serivcePost->image_path !=null ? 'storage/'.$serivcePost->image_path : 'no_image.jpg')}}" alt="work-image">
          <div class="image-overlay p-4 w-100" style="position: absolute; top:118px">
            
            <a class="h4 text-white" href="{{url('/'.(strtolower($blogPost->category->catg_name)).'/'.$blogPost->sefriendly)}}">{{Str::limit($blogPost->title,35,$end="...")}}</a>
            <p class="text-white">by Admin</p>
          </div>
        </div>
      </div> --}}
      @foreach($blogPosts as $blogPost)

      <div class="col-lg-6 px-2">
        <div class="work-slider-image" >
          <img class="img-fluid w-100" src="{{asset($blogPost->image_path !=null ? 'storage/'.$blogPost->image_path : 'no_image.jpg')}}" alt="work-image">
          <div class="image-overlay">
            {{-- <a class="popup-image" data-effect="mfp-zoom-in" href="{{asset($blogPost->image_path !=null ? 'storage/'.$blogPost->image_path : 'no_image.jpg')}}"> --}}
              {{-- <i class="ti-search"></i> --}}
            {{-- </a> --}}
            <a class="h4" href="{{url('/'.(strtolower($blogPost->category->catg_name)).'/'.$blogPost->sefriendly)}}">{{Str::limit($blogPost->title,35,$end="...")}}</a>
            <p>by Admin</p>
          </div>
        </div>
      </div>
      @endforeach
     
    </div>
  </div>
</section>



<section class="promo-video overlay section" style="background-image: url({{asset('1234.webp')}});">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="text-white mb-20 font-weight-normal">Professional Identity <br>assocaited with Email </h1>
        <div class="d-flex">
          {{-- <a href="blog/professional-identity-assocaited-with-email.html"> --}}
            {{-- <i class="ti-control-play"></i> --}}
          {{-- </a> --}}
          <p class="text-white align-self-center h4">The only service in the world that provides professional identity with email address. 
            <br>
            <a href="blog/professional-identity-assocaited-with-email.html" class="btn btn-sm btn-primary mt-4">Read More</a>
          </p>

          
        </div>
      </div>
    </div>
  </div>
</section>

{{-- <section class="section p-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                
                <h2 class="section-title section-title-border">Testimonial</h2>
                
            </div>
            
            <div class="col-lg-7 col-md-7 align-self-center pl-0 m-auto">
                <div class="testimonial-slider p-5">
                    
                    @foreach($testimonialPosts as $key => $testimonialPost)
                       
                        <div class="outline-0">
                            <div style="width:100px; height:100px;">
                                
                                 <img class="w-100" src="{{asset($testimonialPost->image_path !=null ? 'storage/'.$testimonialPost->image_path : 'no_image.jpg')}}" alt="work-image">
                           
                               
                            </div>
                             <h5>{{$testimonialPost->title}}</h5>
                            <p class="text-dark"> {!! Str::limit($testimonialPost->body,250,$end='...') !!}</p>
                            <a href="{{url('/'.(strtolower($testimonialPost->category->catg_name)).'/'.$testimonialPost->sefriendly)}}" class="btn btn-sm btn-primary"> Read More</a>
                        </div>
                    @endforeach
                   
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- testimonial with slider -->
<div class="container-fluid">
  <div class="col-lg-12 text-center">
      <h2 class="section-title section-title-border">Testimonial</h2>
  </div>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner row w-100 mx-auto">
      @foreach($testimonialPosts as $key => $testimonialPost)
      <div class="carousel-item col-md-4 {{$key == 0 ? 'active' :''}}">
        <div class="card">
          <img class="card-img-top img-fluid" src="{{asset($testimonialPost->image_path !=null ? 'storage/'.$testimonialPost->image_path : 'no_image.jpg')}}" alt="work-image" style="min-height: 250px !important;max-height: 250px !important;">
          <div class="card-body">
            <h4 class="card-title">{{$testimonialPost->title}}</h4>
            <p class="card-text">{!! Str::limit($testimonialPost->body,250,$end='...') !!}</p>
            <p class="card-text"><small class="text-muted"><a href="{{url('/'.(strtolower($testimonialPost->category->catg_name)).'/'.$testimonialPost->sefriendly)}}" class="btn btn-sm btn-primary"> Read More</a></small></p>
          </div>
        </div>
      </div>
      @endforeach
      
      
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<!-- testimonial with slider -->
<section class="cta overlay-primary py-50 text-center text-lg-left" style="background-image: url({{asset('1.jpg')}});">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <h3 class="text-white text-justify">AdvocateMail.com is the only email service that provides professional Identity with a professional blogging website and also promotes your service on web </h3>
                </div>
                <div class="col-lg-5 text-lg-right align-self-center " >
                    <a href="{{route('register')}}" class="btn btn-light f-26">REGISTER NOW</a>
                </div>
            </div>
        </div>
</section>

{{-- <section class="section bg-gray">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        <h5 class="section-title-sm">Latest News</h5>
        <h2 class="section-title section-title-border-gray"> News</h2>
      </div>
      <!-- blog-item -->
      @foreach($newsPosts as $newsPost)
      <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
        <div class="card">
          <div class="card-img-wrapper overlay-rounded-top">
            <img class="card-img-top" src="{{asset($serivcePost->image_path !=null ? 'storage/'.$serivcePost->image_path : 'no_image.jpg')}}" alt="blog-thumbnail">
          </div>
          <div class="card-body p-0">
            <div class="d-flex">
              <div class="py-3 px-4 border-right text-center">
                <h3 class="text-primary mb-0">{{date('d',strtotime($newsPost->start_date))}}</h3>
                <p class="mb-0">Nov</p>
              </div>
              <div class="p-3">
                <a href="blog-single.html" class="h4 font-primary text-dark">{{$newsPost->title}}</a>
                <p>by Admin</p>
              </div>
            </div>
          </div>
        </div>
      </div>
     @endforeach
     
    </div>
  </div>

</section> --}}
