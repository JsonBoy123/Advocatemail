

<section class="bg-gray">
    <div class="container mt-5 pt-4">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h2 class="test-dark text-capitalize">{{$page_name}}</h2>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $post)

            <div class="col-lg-4">
                <!-- Blog Post -->
                <article class="bg-white rounded mb-40">
                    <!-- Post Thumbnail -->
                        <a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}">
                            <img class="img-fluid w-100 rounded-top" src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="{{$post->title}}" style="min-height: 250px !important;max-height: 250px !important;">
                        </a>
                    <!-- Post Content -->
                    <div>
                        <div class="d-flex align-items-center border-bottom">
                            <!-- Published Date -->
                            <!--<div class="text-center border-right p-4">-->
                            <!--    <h3 class="text-primary mb-0">-->
                            <!--        {{date('d',strtotime($post->start_date))}}-->
                            <!--        <span class="d-block paragraph">{{date('M',strtotime($post->start_date))}}</span>-->
                            <!--        <span class="d-block paragraph">{{date('Y',strtotime($post->start_date))}}</span>-->
                            <!--    </h3>-->
                            <!--</div>-->
                            <div class="px-4 p-4" style="text-align:justify;min-height: 120px;width:100%;">
                                <!-- Post Title -->
                                <a class="h4 d-block mb-10" href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}">{{$post->title}}</a>
                                <!-- Post Meta -->
                                <!--<ul class="list-inline">-->
                                <!--    <li class="list-inline-item paragraph mr-5">By-->
                                <!--        <a href="#" class="paragraph">{{$post->user->name}}</a>-->
                                <!--    </li>-->
                                <!--    <li class="list-inline-item paragraph">{{$post->category->catg_name}}</li>-->
                                <!--</ul>-->
                            </div>
                        </div>
                        <!-- Post Excerpts -->
                        <!--<div class="p-4" style="text-align:justify;min-height: 120px;">-->
                        <!--    {!! Str::limit($post->body,90,$end='...') !!} -->
                        <!--</div>-->
                        <div class="p-4">
                            <a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}" class="btn btn-sm btn-primary">Read More</a>
                        </div>
                    </div>
                </article>

           
            </div>
             @endforeach
           
        </div>
    </div>
</section>