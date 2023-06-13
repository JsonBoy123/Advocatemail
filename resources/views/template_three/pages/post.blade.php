


    <!-----services----->

    <section class="bar">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <!-- MENUS AND WIDGETS -->
              @include('template_three.pages.sidepanel')
           
            </div>
            <div class="col-lg-9">
            @foreach($posts as $post)
              <div id="accordion" role="tablist" class="mb-5">
                <div class="card">
                  <div id="headingOne" role="tab" class="card-header">
                    <h5 class="mb-0"><a href="{{url('/'.(strtolower($post->category->catg_name)).'/'.$post->sefriendly)}}" aria-expanded="true">{{$post->title}}</a></h5>
                  </div>
                  <div id="collapseOne" role="tabpanel"  data-parent="#accordion" class="collapse show">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4"><img src="{{asset($post->image_path !=null ? 'storage/'.$post->image_path : 'no_image.jpg')}}" alt="" class="img-fluid"></div>
                        <div class="col-md-8">
                          <p>{!! Str::limit($post->body,300,$end='...') !!}</p>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              
            @endforeach 
            </div>
          </div>
        </div>
      </section>