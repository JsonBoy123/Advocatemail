@section('meta_title', $post->meta_title)
@section('meta_keywords', $post->meta_keywords)
@section('meta_description', $post->meta_description)

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 py-100">
                <!--<div class="border rounded bg-white">-->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="font-weight-bold">{{$post->title}}</h3>
                            <hr>
                        </div>
                        <div class="col-md-12">
                           <div class="pr-3 pb-3" style="width:45%; float:left">
                               <img class="img-fluid w-100 rounded-top" src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="{{$post->title}}" style="min-height: 268px; max-height: 268px">
                           </div>
                           <div style="text-align: justify;">
                               {!! $post->body !!}
                               
                           </div>
                            
                        </div>
                        
                    </div>
                    <!--</div>-->
               
            </div>
            @include('template.pages.post-sidebar')
        </div>
    </div>
</section>