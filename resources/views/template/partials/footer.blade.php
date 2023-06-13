
<!-- footer -->
<footer class="bg-secondary">
    <!--<div class="py-100 border-bottom" style="border-color: #454547 !important">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-lg-4 col-md-4">-->
    <!--                <div class="mb-5 mb-md-0 text-center text-md-left">-->
    <!--                     logo -->
    <!--                    <img src="{{asset('template/img/'.session('site_logo'))}}" alt="logo" class="mb-3">-->
    <!--                    <p class="text-white mb-30 mt-3">-->
    <!--                    Progressive Web App (PWA)<br>-->
    <!--                    December 3, 2019-->
    <!--                    Log Of Last Login History To Keep Check On Security Of Account-->
    <!--                    November 27, 2019-->
    <!--                    .</p>-->
    <!--                     social icon -->
    <!--                    <ul class="list-inline">-->
    <!--                        <li class="list-inline-item">-->
    <!--                            <a class="social-icon-outline" href="#">-->
    <!--                                <i class="ti-facebook"></i>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li class="list-inline-item">-->
    <!--                            <a class="social-icon-outline" href="#">-->
    <!--                                <i class="ti-twitter-alt"></i>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li class="list-inline-item">-->
    <!--                            <a class="social-icon-outline" href="#">-->
    <!--                                <i class="fa fa-instagram"></i>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                        <li class="list-inline-item">-->
    <!--                            <a class="social-icon-outline" href="#">-->
    <!--                                <i class="ti-linkedin"></i>-->
    <!--                            </a>-->
    <!--                        </li>-->
    <!--                    </ul>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-lg-2 col-md-4 col-6">-->
    <!--                <h4 class="text-white mb-4">Head Office</h4>-->
    <!--                <p class="text-white">Plot # 2, County Park-->
    <!--                Mahalaxmi Nagar, MR-5-->
    <!--                Indore-452010 (M.P)-->
    <!--                India<p>-->
    <!--            </div>-->
    <!--             footer links -->
    <!--            <div class="col-lg-2 col-md-4 col-6">-->
    <!--            <h4 class="text-white mb-4">Services</h4>-->
    <!--            <ul class="footer-links">-->
    <!--                 @foreach(session('catgs') as $catg)-->
    <!--                    <li>-->
    <!--                        <a href="{{$catg->catg_url !=null ? url($catg->catg_url) : '#'}}">{{$catg->catg_name}}</a>-->
    <!--                    </li>-->
                        
    <!--                @endforeach-->
                 
    <!--            </ul>-->
    <!--            </div>  -->
                
    <!--            <div class="col-lg-3 col-md-12 offset-lg-1">-->
    <!--                <div class="mt-5 mt-lg-0 text-center text-md-left">-->
    <!--                    <h4 class="mb-4 text-white">News Letter</h4>-->
    <!--                    <p>Get our newsletter twice a week for more tips, tricks, and trends.</p>-->
    <!--                    <form action="#" class="position-relative">-->
    <!--                        <input type="text" class="form-control subscribe" name="subscribe" id="Subscribe" placeholder="Enter Your Email">-->
    <!--                        <button class="btn-subscribe" type="submit" value="send">-->
    <!--                            <i class="ti-arrow-right"></i>-->
    <!--                        </button>-->
    <!--                    </form>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- copyright -->
    <div class="pt-4 pb-3 position-relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <p class="text-white text-center text-md-left">
                        <span class="text-primary"><img src="{{asset('template/img/'.session('site_logo'))}}" alt="logo" width="100" class=""></span> &copy; 2019 All Right Reserved</p>
                </div>
                <div class="col-lg-6 col-md-7">
                    <ul class="list-inline text-center text-md-right">
                        <li class="list-inline-item mx-lg-3 my-lg-0 mx-2 my-2">
                            <a class="font-secondary text-white" href="{{url('legal/disclaimer.html')}}">Disclaimer</a>
                        </li>
                        <li class="list-inline-item mx-lg-3 my-lg-0 mx-2 my-2">
                            <a class="font-secondary text-white" href="{{url('legal/e-u-l-a.html')}}">EULA</a>
                        </li>
                        <li class="list-inline-item mx-lg-3 my-lg-0 mx-2 my-2">
                            <a class="font-secondary text-white" href="{{url('legal/privacy-policy.html')}}">Privacy Policy</a>
                        </li>
                        <li class="list-inline-item ml-lg-3 my-lg-0 ml-2 my-2 ml-0">
                            <a class="font-secondary text-white" href="{{url('legal/t-o-s.html')}}">TOS</a>
                        </li>
                        <li class="list-inline-item ml-lg-3 my-lg-0 ml-2 my-2 ml-0">
                            <a class="font-secondary text-white" href="{{url('legal/usage-policy.html')}}">T&C</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- back to top -->
        <button class="back-to-top">
            <i class="ti-angle-up"></i>
        </button>
    </div>
</footer>
<!-- /footer -->

<!-- jQuery -->
<script src="{{asset('template/plugins/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('template/plugins/bootstrap/bootstrap.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('template/plugins/magnific-popup/jquery.magnific.popup.min.js')}}"></script>
<!-- slick slider -->
<script src="{{asset('template/plugins/slick/slick.min.js')}}"></script>
<!-- filter -->
<script src="{{asset('template/plugins/filterizr/jquery.filterizr.min.js')}}"></script>


<script src="{{asset('template/plugins/syotimer/jquery.syotimer.js')}}"></script>
<!-- aos -->
<script src="{{asset('template/plugins/aos/aos.js')}}"></script>
<!-- swiper -->
<script src="{{asset('template/plugins/swiper/swiper.min.js')}}"></script>
<!-- Main Script -->
<script src="{{asset('template/js/template.js')}}"></script>
<script src="{{asset('js/helper.js')}}"></script>
<script src="{{asset('js/datepicker.js')}}"></script>
 <script>
    
    $(document).ready(function(){
       AOS.init();
      $(window).on("scroll", function() {
      scroll_nav();

      });
      scroll_nav();

       // Back to top button
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
          $('.back-to-top').fadeIn('slow');
        } else {
          $('.back-to-top').fadeOut('slow');
        }
      });

      $('.back-to-top').click(function() {
        $('html, body').animate({
          scrollTop: 0
        }, 1500, 'easeInOutExpo');
        return false;
      });


      $('.searchHeader').on('click',function(){
          $('#searchModal').modal('show');
      });



    @if(url('/') != Request::url())
      $(".menunav li>a").css({ 'color': 'black', 'font-weight': 'bold' }); 
       $(".menunav").css({'box-shadow' : '0 .335rem .25rem rgba(0,0,0,.075) '});
       $('#topbar').addClass("other-page");
        $('.navbar-toggler').removeClass('text-white');
        $('.navbar-toggler-icon').removeClass('text-white');
    @else
        $('#topbar').addClass('before-topbar');
    @endif

    })
   
  function scroll_nav(){
    if($(window).scrollTop() > 50) {
        $(".menunav").addClass("bg-white");
        $('.menunav').addClass('header-scrolled');
        $('#topbar').addClass('topbar-scrolled');
        $('.navbar-toggler').removeClass('text-white');
        $('.navbar-toggler-icon').removeClass('text-white');
   
        $(".menunav").css({'box-shadow' : '0 .335rem .25rem rgba(0,0,0,.075) '});
        $(".menunav li>a").css({ 'color': 'black', 'font-weight': 'bold' });
    } else {


        //remove the background property so it comes transparent again (defined in your css)
       $(".menunav").removeClass("bg-white");
      @if(url('/') == Request::url())
       $(".menunav li>a").css({ 'color': 'white', 'font-weight': 'bold' });
       $(".menunav").css({'box-shadow' : ''});
       $('.navbar-toggler').addClass('text-white');
       $('.navbar-toggler-icon').addClass('text-white');
      @endif
      $('.menunav').removeClass('header-scrolled');
      $('#topbar').removeClass('topbar-scrolled');

    }  
  }
  </script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-48209472-2',{ cookie_flags: 'SameSite=lax;Secure' });
</script>

<script>
  $(document).ready(function(){
      $('.stateView').on('click',function(e){
        e.preventDefault();
          var state_code = $(this).attr('id');
          var state_name = $(this).data('id');
          $.ajax({
            type:'GET',
            url:"{{url('/get_city_count')}}/"+state_code,
            success:function(res){
              $('#cityRow').removeClass('d-none');
              $('#cityRow1').removeClass('d-none');
              $('#stateRow').addClass('d-none');
              $('#stateRow1').addClass('d-none');
              $('#cityRow').empty();
              $.each(res,function(i,v){

                $('#cityRow').append('<div class="col-md-4"><a href="{{url('/search')}}/'+v.city_name.toLowerCase()+'" class="text-primary stateView"><i class="fa fa-map-marker "></i> '+v.city_name+' ('+v.city_count+')</a><br/><br/></div>')
              })
            
            }
          })
      });

      $(document).on('click','#backStateBtn',function(e){
        e.preventDefault();
        $('#cityRow').addClass('d-none');
        $('#cityRow1').addClass('d-none');
        $('#stateRow').removeClass('d-none');
        $('#stateRow1').removeClass('d-none');
        $('#cityRow').empty();
      })
  })
</script>

</body>

<!-- Mirrored from demo.themefisher.com/biztrox/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Mar 2021 09:05:21 GMT -->
</html>