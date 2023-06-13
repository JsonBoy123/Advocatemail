{{-- @extends(session('template_name').'.partials.header') --}}
@if($post->meta_title!=null || $post->meta_keywords!=null || $post->meta_description!=null)
@section('meta_title', $post->meta_title)
@section('meta_keywords', $post->meta_keywords)
@section('meta_description', $post->meta_description)
@endif




<div id="content">
        <div class="container">
          <div class="row bar">
            
            <div id="blog-post" class="col-md-12">
              <p class="text-muted text-uppercase mb-small text-right text-sm"></p>
                <h2>{{$post->title}}</h2>
              
              <div id="post-content">
                
                <p><img src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="{{$post->title}}" class="img-fluid"></p>
                
                <blockquote class="blockquote">
                  <p class="text-sm" style="text-align: justify;">{!! $post->body !!}</p>
                </blockquote>
                
                
              </div>
              
              
            </div>
            
          </div>
        </div>
      </div>