
  @php 
    $sliderPosts = \App\Models\Posts::where(['status' => '1','user_id'=>session('user_id'),'is_slider' => '1'])->orderBy('order_num')->get();
  @endphp

<section class="">
  <div class="hero-slider position-relative">

  @foreach($sliderPosts as $key => $sliderPost)
    <div class="hero-slider-item py-160" style="height:500px; background-image: url('{{asset($sliderPost->slider_image !=null ? 'storage/'.$sliderPost->slider_image : 'no_image.jpg')}}');"
      data-icon="ti-comments" data-text="{{$key + 1}}">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
          </div>
          <div class="col-lg-7">
            <div class="hero-content text-right">
              
              <h1 class="font-weight-bold mb-3 text-white" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".5">{{$sliderPost->title}}</h1>
             {{--  <p class="text-dark mb-50" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".9">Dress & Address <br>Makes The Difference
              </p> --}}
              {{-- <a data-duration-in=".5" data-animation-in="fadeInDown" data-delay-in="1.3" href="about.html"
                class="btn btn-outline text-uppercase">more details</a> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
   
  </div>
</section>
    
{{-- 
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" height="400" src="{{asset('slider.jpg')}}" alt="First slide">
       <div class="carousel-caption d-none d-md-block">
        <h5 class="font-weight-bold text-white">PROFESSION DEDICATED EMAIL SERVICE</h5>
        <p  class="font-weight-bold text-white">Dress & Address
Makes The Difference</p>
      </div>
    </div>

    {{-- <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div> --}}
{{--   </div>
 
</div> --}} 