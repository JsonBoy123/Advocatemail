@php 
 $blogPosts = \App\Models\Posts::where(['catg_id' => 17,'status' => '1','user_id'=>session('user_id')])->get()->take(5);
 $servicePosts = \App\Models\Posts::where(['catg_id' => 14,'status' => '1','user_id'=>session('user_id')])->get()->take(5);

@endphp



          <!-- Widget [Search Bar Widget]-->
          <div class="widget search">
              <img class="w-100" height="200"  src="{{asset('AdvertisingBlog.jpg')}}" />
          </div>
          <!-- Widget [Latest Posts Widget]        -->
          <div class="widget latest-posts">
            <header>
              <h3 class="h6">Services</h3>
            </header>
            @foreach($servicePosts as $key =>  $servicePost)
            <div class="blog-posts"><a href="{{url('/'.(strtolower($servicePost->category->catg_name)).'/'.$servicePost->sefriendly)}}">
                <div class="item">
                  
                  <div class="title"><strong><li>{{$servicePost->title}}</li></strong>
                    
                  </div>
                </div></a>
            </div>
            @endforeach
          </div>
          <!-- Widget [Categories Widget]-->
          <div class="widget categories">
            <header>
              <h3 class="h6">Blogs</h3>
            </header>
            @foreach($blogPosts as $blogPost)
            <div class="item"><a href="{{url('/'.(strtolower($blogPost->category->catg_name)).'/'.$blogPost->sefriendly)}}">{{$blogPost->title}}</a></div>
            @endforeach
          </div>
          
   
