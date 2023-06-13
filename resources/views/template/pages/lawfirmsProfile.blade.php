@extends("layouts.main")
@section('content')
<style type="text/css">
  .popover {
    left: 40% !important;
  }

  .btn {
    margin: 1%;
  }

  .left {
    float: left;
    width: 5%;
    height: 60px;
    margin-right: 2px;
    background-color: #eaeaeafa;
    border: 1px solid #adadad;
  }

  .right {
    float: right;
    width: 5%;
    height: 60px;
    margin-left: 2px;
    background-color: #eaeaeafa;
    border: 1px solid #adadad;
  }

  .center {
    float: left;
    width: 100%;
    height: 60px;
    background-color: #eaeaeafa;
    border: 1px solid #adadad;
    margin: 1px;
    color: #000;
    overflow: hidden;
    white-space: nowrap;
  }

  .internal {
    width: 17.75%;
    height: 100%;
    padding: 3px 1px 0px 1px;
    font-size: 13px;
    display: inline-block;
  }

  .internal p {
    font-weight: 700 !important;
  }

  .hideContent {
    overflow-y: scroll;
    height: 18em;
  }

  .list-group-item {
    padding: 0px !important;
  }

  .center1 {
    float: left;
    width: 100%;
    border: 1px solid #adadad;
    height: 35px;
    margin: 0px;
    padding: 0px !important;
    overflow: hidden;
    white-space: nowrap;
  }

  .bookingBtn {
    padding: .25rem .5rem !important;
    border-radius: 0.2rem;
    background-color: transparent;
    color: #212529;
  }

  .list-group-horizontal {
    flex-direction: row;
  }

  .left-button,
  .right-button {
    padding: .25rem .5rem !important;
    border-radius: 0rem;
  }

  #sidebar {
    height: 97%;
    margin-top: 26px;
    min-width: 250px;
    max-width: 250px;
    background: #fff;
    border-right: 1px solid #d2d6de;
    color: #fff;
  }

  .wrapper {
    display: flex;
    align-items: stretch;
  }

  .profile-img {
    width: 80%;
    height: 70%;
    border: 2px solid;
    padding: 7px;
    border-radius: 6%;
  }

  #sidebar ul li a {
    color: #fff;
    font-size: 12px !important;

  }

  .animated {
    -webkit-transition: height 0.2s;
    -moz-transition: height 0.2s;
    transition: height 0.2s;
  }

  p.stars i {
    color: chocolate;
  }

  ul.components li a span {
    padding: 10px;
    font-size: 14px !important;
    color: black;
    display: block;
  }

  .value {
    font-size: 14px !important;
  }

  /*  social-icons-css-starts*/
  .social-icons {
    text-align: center;
    margin-left: 10px;
  }

  .social-icons a {
    color: #000;
    line-height: 30px;
    font-size: 30px;
    margin: 0 5px;
    text-decoration: none;

  }

  .social-icons a i {
    line-height: 30px;
    font-size: 30px;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1);
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1);
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1);
    transition: all 200ms ease-in;
    transform: scale(1);
  }

  .social-icons a:hover i {
    box-shadow: 0px 0px 150px #000000;
    z-index: 2;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1.5);
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1.5);
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1.5);
    transition: all 200ms ease-in;
    transform: scale(1.5);
  }

  /*social-icons-css-end*/
</style>

<div class="container-fluid container-div">
  <div class="row">
    <div class="col-sm-12 col-md-12 col-xl-12 text-center h2-text">
      <h2 class=" font-weight-bold text-center text-white">
        @if($userData->user_catg_id == '1')
        LAWYER
        @else
        LAW FIRM
        @endif PROFILE
      </h2>
    </div>

    <div class="wrapper">
      <!-- Sidebar -->
      <nav id="sidebar" style="background-color:#f4f4f4;">
        <div class="sidebar-header text-center  border-bottom pb-3">
          <span class="navbar-brand font-weight-bold mt-4 text-dark">OTHER DETAILS</span>
        </div>
        <ul class="list-unstyled components">
          <div class="sidebar-search ml-4 mt-4 d-flex">
            <span>
              <a href="javascript:void(0)" class="btn btn-md text-success border-success bookBtn text-uppercase" id="{{$userData->id}}">Book an Appointment</a>
            </span>
          </div>
          <hr>
          @if($userData->user_catg_id == '1')
          <li class="active" id="educa">
            <a href="" data-toggle="collapse" aria-expanded="false" id="edu" style="text-decoration: none;">
              <span>
                <i class="fa fa-book" aria-hidden="true"></i>&nbsp;Education<i class="fa fa-plus float-right" aria-hidden="true" id="eplus"></i></span>
            </a>
            <ul class="collapse list-unstyled ml-4" id="Education">

              @foreach($userData->qualifications as $quali)
              <li>
                <i class="fa fa-circle-o text-dark" style="font-size: 15px;"></i><a href="#" class="text-dark" style="text-decoration:none; font-size: 16px;"> {{$quali->qual_desc}}</a>
              </li>
              @endforeach
            </ul>
          </li>

          <li class="">
            <a href="" data-toggle="collapse" aria-expanded="false" style="text-decoration: none;" id="space">
              <span style="margin: -3px;"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;Specialization<i class="fa fa-plus float-right" aria-hidden="true" id="splus"></i></span>
            </a>
            <ul class="collapse list-unstyled ml-4" id="Specialization">
              @foreach($userData->specialities as $spec)
              <li>
                <i class="fa fa-circle-o text-dark" style="font-size: 15px;"></i><a href="#" class="text-dark" style="text-decoration:none;font-size: 16px;"> {{$spec->specialization_catgs !=null  ? $spec->specialization_catgs->catg_desc : ''}}</a>
              </li>
              @endforeach
            </ul>
          </li>

          <li class="">
            <a href="" data-toggle="collapse" aria-expanded="false" style="text-decoration: none;" id="pract">
              <span style="margin: -3px; font-weight: 700px;"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Practicing Courts<i class="fa fa-plus float-right" aria-hidden="true" id="pplus"></i></span>
            </a>
            <ul class="collapse list-unstyled ml-4" id="Practicing">
              @foreach($userData->user_courts as $courts )

              <li class="mb-2">
                <i class="fa fa-circle-o text-dark" style="font-size: 15px;"></i><a href="#" class="text-dark" style="text-decoration:none;font-size: 16px;">{{$courts->court_catg->court_name.' at '. $courts->court_catg->city_name.','}}</a>
              </li>
              @endforeach
            </ul>
          </li>
          @endif
        </ul>
      </nav>

      <div id="content">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
            <!-- <button type="button" id="sidebarCollapse" class="btn text-info border-info">
            <i class="fa fa-align-left"></i> More Info 
          </button> -->
          </nav>

          <div class="">
            <div class="block">

              <table class="table" id="example">
                <tbody>

                  <tr class="row ml-0 mr-0 mt-4 table-bordered">
                    <td class="col-md-6 col-sm-6">
                      <div class="row">
                        <div class="col-sm-12 col-xs-12 col-md-4 col-xl-4 col-lg-4">
                          @if($userData->photo !='')
                          <img src="{{ url('/storage/app/public/'.$userData->photo) }}" class="w-100" style="height:150px;" />
                          @else
                          <img src="{{ url('/storage/app/public/default.png')}}" class="w-100" style="height:150px;" />
                          @endif
                        </div>

                        <div class="col-sm-12 col-md-8 col-xs-12">
                          <h4 class="font-weight-bold" style="margin-top: 12px !important">{{$userData->name}}</h4>

                          <div>
                            <h6 class="">
                              <i class="fa fa-graduation-cap text-info" style="color:#000 !important; padding-right: 2px;"></i>{!! \APP\Helpers\Helpers::userqual($userData->id) !!}
                            </h6>
                          </div>

                          <div class="col-md-12 text-justify mt-2" style="line-height: 30px; padding-left: 0px !important;">
                            <hr class="m-0">
                            <h6 style="padding-top:14px;"> <i class="fa fa-university text-info" style="color:#000 !important; padding-right: 2px;"></i>Practicing Courts: @foreach($userData->user_courts as $courts)
                              <span class="value" style="font-size: 15px;">{{$courts->court_catg->court_name.' at '. $courts->court_catg->city_name.','}}</span>
                              @endforeach
                            </h6>


                          </div>

                          <!-- Start Rating-->
                          <div class="rating">
                            <span class="star-rating">
                              <?php
                              if ($userData->reviews->count() == 0) {
                                $no_of_reviews = 0;
                              } else {
                                $no_of_reviews = $userData->reviews->sum('review_rate') / $userData->reviews->count();
                              }

                              $ratings = $no_of_reviews;

                              ?>

                              @for($i=1;$i<= floor($ratings);$i++) <i class="fa fa-star" style="color:chocolate"></i>

                                @endfor

                                @if(substr($ratings, strpos($ratings, ".") + 1)==5)
                                <i class="fa fa-star-half" style="color:chocolate"></i>
                                @elseif($ratings != 5.0 || $ratings==null)
                                <i class="fa fa-star" style="color:chocolate"></i>
                                @endif
                                @for($i=1;$i<=(4-floor($ratings));$i++) <i class="fa fa-star-o" style="color:chocolate"></i>
                                  @endfor
                            </span>

                            <span class="score"><i>
                                <?php $a = array();
                                foreach ($userData->reviews as $review) {
                                  $a[] = $review->review_rate;
                                }

                                echo count($a);

                                ?> Review</i></span> <!-- |

                        <span class="score">100</span>+ user ratings  -->

                          </div>

                        </div>
                      </div>

                      <!--End rating-->
                      <hr>
                      <div class="row">
                        <div class="col-sm-5">
                          <div class="item-info mb-3">
                            <span class="icon-holder"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                            <span class="item-label" style="font-weight: 550;">Address: </span>
                            <span class="value">
                              @if($userData->state == '')
                              {{ '' }}
                              @else
                              {{($userData->address !='' ? $userData->address.', ' : '').$userData->city->city_name.', '. $userData->state->state_name.', '.$userData->zip_code}}
                              @endif
                            </span>
                          </div>
                          <div class="item-info">
                            <span class="icon-holder"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                            <span class="item-label" style="font-weight: 550;">Experience: </span>
                            <span class="value">{{$userData->estd_year. ' years'}}</span>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          @if($userData->user_catg_id == 1) <div class="item-info mb-3">
                            <span class="icon-holder"><i class="fa fa-balance-scale" aria-hidden="true" style="font-weight: 700;"></i></span>
                            <span class="item-label" style="font-weight: 550;">Practice areas:</span>

                            @php $spec_string = '' ; @endphp
                            @foreach($userData->specialities as $spec)

                            @if($spec->specialization_catgs !=null)
                            @php $spec_string .= $spec->specialization_catgs->catg_desc.', ' ; @endphp
                            @endif
                            @endforeach

                            <span class="value">{{substr($spec_string,0,strlen($spec_string)-2)}}
                            </span>


                          </div>
                          @endif

                          <div class="item-info mb-3">
                            <span class="icon-holder"><i class="fa fa-language" aria-hidden="true"></i></span>
                            <span class="item-label" style="font-weight: 550;">Languages: </span>
                            <span class="value">English, Hindi</span>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="social-icons">
                          <a href="https://www.facebook.com/sharer/sharer.php?u=YourPageLink.com&display=popup" title="facebook">
                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                          </a>
                          <a href="https://twitter.com/i/flow/login" title="twitter">
                            <i class="fa fa-twitter-square" aria-hidden="true"></i>
                          </a>
                          <a href="" title="whatsapp">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                    </td>
                    <td class="col-md-6 col-sm-6" id="book_desktop">
                      <h5 style="font-weight:700;">Book An Appointment</h5>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="d-flex align-items-center">
                            <div class="left">
                              <button class="btn btn-sm left-button">
                                <i class="fa fa-caret-left" style="font-size:27px"></i>
                              </button>
                            </div>
                            <div class="center" id="content">
                              @foreach($days as $key => $value)
                              <div class="internal text-center">
                                <p class="m-0">{{$key}}</p>
                                <p class="m-0">{{$value}}</p>
                              </div>
                              @endforeach
                            </div>
                            <div class="right">
                              <button class="btn btn-sm right-button">
                                <i class="fa fa-caret-right" style="font-size:27px"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-11 m-auto content_slots hideContent">
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                @foreach($slots as $slot)

                                <tr class="list-group list-group-horizontal center1">
                                  @foreach($days as $key => $value)
                                  @php
                                  $day = $key =='Mon' ? '1' : ($key =='Tue' ? '2' : ($key =='Wed' ? '3' :($key =='Thu' ? '4' : ($key =='Fri' ? '5' : ($key =='Sat' ? '6' : ($key =='Sun' ? '7' : '1' ))))))
                                  @endphp
                                  <td class="list-group-item" style="font-size:12px; background-color:#FF7F50;">
                                    @if(count($userData->slots) !='0')

                                    <a href="javascript:void(0)" class="btn btn-sm m-0 bookingBtn" @foreach($userData->slots as $slo)
                                      @if($day == $slo->day && $slo->slot == $slot->slot)
                                      style="background-color: #28a745;color:white"
                                      data-id='true'
                                      @endif
                                      @endforeach

                                      id="{{$slot->id}}" >{{ date('h:i A', strtotime($slot->slot)) }}


                                      @else
                                      <a href="javascript:void(0)" class="btn btn-sm m-0 bookingBtn" id="{{$slot->id}}" data-id="true">{{ date('h:i A', strtotime($slot->slot)) }}


                                        @endif
                                        <input type="hidden" name="user_id" value="{{($userData->id)}}">
                                        <input type="hidden" name="slot_t" value="{{$slot->slot}}">
                                        <input type="hidden" name="b_date" value="{{$value}}">
                                      </a>
                                  </td>
                                  @endforeach
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <br>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-justify mt-2" style=" line-height: 30px;">
              <hr>


              <?php echo $userData->detl_profile ?>

            </div>
          </div>

          @include('template.pages.user-reviews')
          <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 pull-right">

          </div>

        </div> <!-- row -->

      </div> <!-- container-fluid -->

    </div> <!-- content -->

  </div> <!-- wrapper -->

</div>

<!-- for-login-popup -->
@include('models.login_model')
@include('models.booking_model')


<script type="text/javascript">
  @php
  if (Session::has('errors')) {
    @endphp
    $(document).ready(function() {
      $('.login_modal').modal({
        show: true
      });
    });
    @php
  }
  @endphp

  @php
  if ($message = Session::get('success')) {
    @endphp
    alert("{{$message}}");
    @php
  }
  if ($message = Session::get('warning')) {
    @endphp
    alert("{{$message}}");
    @php
  }
  @endphp
</script>

<script>
  $('.readmore, .readless').on('click', function(e) {
    e.preventDefault();

    $('.full-text').toggle();
    $('.readmore').toggle();
    $('.readless').toggle();
  });


  $(document).on('click', '.right-button', function() {
    event.preventDefault();
    $('.center,.center1').animate({
      scrollLeft: "+=100px"
    }, "slow");
  });

  $(document).on('click', '.left-button', function() {
    // $('.left-button').click(function() {
    event.preventDefault();
    $('.center,.center1').animate({
      scrollLeft: "-=100px"
    }, "slow");
  });


  $('body').on('click', '.right-button1', function() {
    event.preventDefault();
    $('.center,.center1').animate({
      scrollLeft: "+=100px"
    }, "slow");
  });

  $('body').on('click', '.left-button1', function() {
    event.preventDefault();
    $('.center,.center1').animate({
      scrollLeft: "-=100px"
    }, "slow");
  });

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#user_name').on('blur', function(e) {
    var user_name_s = $(this).val();
    $('#model_user_name').val(user_name_s);
  })

  $(".filteBtn").on('click', function(e) {

    e.preventDefault();
    var specialist = $('#specialist_lawyer option:selected').attr('data-id');
    var state_code = $('#state').val();
    var city = $('#city option:selected').attr('data-id');
    // var city_code = $('#city option:selected').attr('data-id');
    var gender = $("input[name='gender']:checked").val();
    var searchfield = $("input[name='searchfield']:checked").val();
    var court_id = $('#court_id').val();
    var user_name = $("input[name='user_name']").val();
    // console.log(specialist);
    // console.log(city);
    // alert(searchfield);
    var url1 = '';
    if (specialist != '0') {
      if (city != '0') {
        url1 = "{{url('search')}}/" + slug_name(specialist) + '/' + slug_name(city);
      } else {
        url1 = "{{url('search')}}/" + slug_name(specialist);
      }
    } else if (city != '0') {
      url1 = "{{url('search')}}/" + slug_name(city);

    } else {
      url1 = "{{url('search')}}";
    }
    window.location.href = url1 + '?' + 'gender=' + gender + '&searchfield=' + searchfield + '&court_id=' + court_id + '&user_name=' + user_name;

  });

  $(document).on('click', '.pagination a', function(event) {
    event.preventDefault();
    $('li').removeClass('active');
    $(this).parent('li').addClass('active');

    var myurl = $(this).attr('href');
    var page = $(this).attr('href').split('page=')[1];

    var specialist = $('#specialist_lawyer option:selected').attr('data-id');
    var state_code = $('#state').val();
    var city = $('#city option:selected').attr('data-id');
    // var city_code = $('#city option:selected').attr('data-id');
    var gender = $("input[name='gender']:checked").val();
    var searchfield = $("input[name='searchfield']:checked").val();
    var court_id = $('#court_id').val();
    var user_name = $("input[name='user_name']").val();
    var url = window.location.href;

    window.location.href = url + '?' + 'gender=' + gender + '&searchfield=' + searchfield + '&court_id=' + court_id + '&user_name=' + user_name + '&page=' + page;
  });

  $(document).on('change', '#specialist_lawyer', function(e) {
    e.preventDefault();
    var city = $('#city option:selected').attr('data-id');
    var catg = $('#specialist_lawyer option:selected').attr('data-id');
    if (catg != '0') {
      if (city != '0') {
        window.location.href = "{{url('search')}}/" + slug_name(catg) + '/' + slug_name(city);
      } else {
        window.location.href = "{{url('search')}}/" + slug_name(catg);
      }
    }

  });

  $(document).on('change', '#city', function(e) {
    e.preventDefault();

    var city = $('#city option:selected').attr('data-id');
    var catg = $('#specialist_lawyer option:selected').attr('data-id');

    var searchfield = $('input[name="searchfield"]:checked').val();

    if (searchfield != 'lawcompany') {
      if (city != '0') {
        if (catg != '0') {

          window.location.href = "{{url('search')}}/" + slug_name(catg) + '/' + slug_name(city);
        } else {
          window.location.href = "{{url('search')}}/" + slug_name(city);
        }
      }
    } else {
      var city_code = $(this).val();
      var state_code = '';
      var court_id = '#court_id';
      state_city_court(city_code, state_code, court_id);
    }
  });
</script>
<script>
  $(document).ready(function() {
    $('body').on('click', '.bookingBtn', function() {

      var today = new Date();
      var b_date = $(this).find("input[name='b_date']").val();
      var slot_time = $(this).find("input[name='slot_t']").val();
      var slot_id = $(this).attr('id');
      var user_id = $(this).find("input[name='user_id']").val();

      var appoint_status = $(this).data('id');
      console.log(appoint_status);

      b_date = new Date(b_date);
      var current_time = today.getHours() + ":" + (today.getMinutes() < 10 ? '0' : '') + today.getMinutes() + ":" + (today.getSeconds() < 10 ? '0' : '') + today.getSeconds();
      if (appoint_status) {
        if (today.getDate() == b_date.getDate()) {
          var b_date = $(this).find("input[name='b_date']").val();
          if (current_time < slot_time) {
            booking(b_date, slot_id, user_id)
          } else {
            swal({
              text: "You have not selected previous time booking.",
              type: 'warning',

            });
          }

        } else {
          var b_date = $(this).find("input[name='b_date']").val();
          booking(b_date, slot_id, user_id)
        }
      } else {
        swal({
          text: "Slots not available.",
          type: 'warning',

        });
      }

    });

    function booking(b_date, slot_id, user_id) {
      var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
      if (AuthUser) {
        $('#bookingDate').val(b_date);
        $('#booking_plan_id').val(slot_id);
        $('#booking_user_id').val(user_id);
        $('#BtnViewModal').modal('show');
      } else {
        $('.login_modal').modal({
          "backdrop": "static"
        });
      }
    }

    $('body').on('click', '.bookBtn', function() {
      $user_id = $(this).attr('id');
      var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
      if (AuthUser) {
        $('#BtnViewModal .modal-body ').find("input[name='user_id']").val($user_id);
        $('#BtnViewModal').modal('show');
      } else {
        $('.login_modal').modal({
          "backdrop": "static"
        });
      }
    });
  });
</script>

<script>
$(document).ready(function(){
    $('#sidebarCollapse').click(function(){
            $('#sidebar').toggleClass('active')
      });

  $('#edu').click(function(){
    $("#eplus").toggleClass("fa-plus fa-minus "); 
    $('#Education').toggle(200);
    $('#Specialization').hide();
    $('#Landmark').hide();
    $("#splus").removeClass("fa-minus"); 
    $("#splus").addClass("fa-plus"); 
    $("#lplus").removeClass("fa-minus"); 
    $("#lplus").addClass("fa-plus");
    $("#pplus").removeClass("fa-minus"); 
    $("#pplus").addClass("fa-plus");   
  });
  $('#space').click(function(){
    $("#splus").toggleClass("fa-plus fa-minus "); 
    $('#Specialization').toggle(200);
    $('#Education').hide();
    $('#Landmark').hide();
    $("#eplus").removeClass("fa-minus"); 
    $("#eplus").addClass("fa-plus");
    $("#lplus").removeClass("fa-minus"); 
    $("#lplus").addClass("fa-plus");
    $("#pplus").removeClass("fa-minus"); 
    $("#pplus").addClass("fa-plus");   
  });
  $('#land').click(function(){
    $("#lplus").toggleClass("fa-plus fa-minus "); 
    $('#Landmark').toggle(200);
    $('#Specialization').hide();
    $('#Education').hide();
    $("#splus").removeClass("fa-minus"); 
    $("#splus").addClass("fa-plus"); 
    $("#eplus").removeClass("fa-minus"); 
    $("#eplus").addClass("fa-plus");
    $("#pplus").removeClass("fa-minus"); 
    $("#pplus").addClass("fa-plus");  
  });

  $('#pract').click(function(){
    $("#pplus").toggleClass("fa-plus fa-minus "); 
    $('#Practicing').toggle(200);
    $('#Landmark').hide();
    $('#Education').hide();
    $('#Specialization').hide();
    $("#splus").removeClass("fa-minus"); 
    $("#splus").addClass("fa-plus"); 
    $("#pplus").removeClass("fa-minus"); 
    $("#pplus").addClass("fa-plus"); 

  });


 var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";

 $('#writeReview, #submitBtn').click(function(e){
 e.preventDefault();
  if(AuthUser){


  }
  else{
    $('.login_modal').modal({"backdrop": "static"});
  }
 
});


$('#cancelWR').on('click',function(){

  $('#review_text').val('').empty();
  $('.live-rating').text('').empty();

});

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$('#review_submit').on('click',function(e){
    e.preventDefault();
     var review_text = $.trim($('#review_text').val()) ? $.trim($('#review_text').val()) : null;

     var user_id = $('#user_id').val();
     // alert(user_id);
     var guest_id = $('input[name="guest_id"]').val();
     // alert(guest_id);
     var review_rate =$('.live-rating').text() ? $('.live-rating').text() : null;

       var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";

       if(AuthUser){
        var checkUser = "{{(Auth::user()) ? Auth::user()->id : null}}";

       if(checkUser != user_id){
         if(review_text != null || review_rate != null){
         
            $.ajax({
                type:'POST',
                url: "{{route('lawfirms.writeReview')}}",
                data:{user_id:user_id, guest_id:guest_id, review_text:review_text,review_rate:review_rate},
                success:function(data){
                  alert(data);
                  // swal({
                  //   title: "Review",
                  //   text : data,
                  //   icon : 'success',
                  // });
                  // setTimeout(function(){// wait for 5 secs(2)
                  //    location.reload(); // then reload the page.(3)
                  // }, 3000); 
                }
                
            });
      
           }
           else{
               swal({
                text: 'Review field required',
                icon: 'warning'
             });
           }
         }
         
       }
});


});
     </script>
@endsection