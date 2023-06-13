@php 
 $blogPosts = \App\Models\Posts::where(['catg_id' => 17,'status' => '1','user_id'=>session('user_id')])->get()->take(5);
 $servicePosts = \App\Models\Posts::where(['catg_id' => 14,'status' => '1','user_id'=>session('user_id')])->get()->take(5);

@endphp



 <div class="panel panel-default sidebar-menu with-icons">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Blogs</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm">
                    
                    @foreach($blogPosts as $blogPost)
                    <li class="nav-item"><a href="{{url('/'.(strtolower($blogPost->category->catg_name)).'/'.$blogPost->sefriendly)}}" class="nav-link">{{$blogPost->title}}</a></li>
                    @endforeach
                    
                  </ul>
                </div>
              </div>
              
              <hr>

              <div class="panel panel-default sidebar-menu with-icons">
                <div class="panel-heading">
                  <h3 class="h4 panel-title">Services</h3>
                </div>
                <div class="panel-body">
                  <ul class="nav nav-pills flex-column text-sm">
                    
                    @foreach($servicePosts as $servicePost)
                    <li class="nav-item"><a href="{{url('/'.(strtolower($servicePost->category->catg_name)).'/'.$servicePost->sefriendly)}}" class="nav-link">{{$servicePost->title}}</a></li>
                    @endforeach
                    
                  </ul>
                </div>
              </div>