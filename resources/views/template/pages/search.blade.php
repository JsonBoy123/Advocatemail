@extends("layouts.main")
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css"/>
<style>
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
   margin-right: 3px;
   background-color: #eaeaeafa;
   border: 1px solid #adadad;
   }
   .right {
   float: right;
   width: 5%;
   height: 60px;
   background-color: #eaeaeafa;
   border: 1px solid #adadad;
   }
   .center{
   float: left;
   width: 470px;
   height: 60px;
   background-color: #eaeaeafa;
   border: 1px solid #adadad;
   margin: 1px;
   color: #000;
   font-weight: 700;
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
   .hideContent {
   overflow-y: scroll;
   height: 18em;
   }
   .center1 {
   float: left;
   width: 479px;
   border: 1px solid #adadad;
   height: 35px;
   margin: 2px 2px 2px 4px;
   overflow: hidden;
   white-space: nowrap;
   }
   .btn-msg{
      border: 1px solid #17a2b8!important;
      border-radius: 0px!important;
      padding: 3px 5px !important;
   }
   .btn-dp{
      border: 1px solid #e84444!important;
      border-radius: 0px!important;
      padding: 3px 5px !important;
}
</style>
@section('content')
<div class="container">
   <div class="block" style="margin-bottom: 40px;
    margin-top: 80px;">
      <table class="table" id="example">
         <tbody>
            @if(count($lawyers) !=0 )  
            @foreach($lawyers as $lawyer)
            <tr class="row ml-0 mr-0 mt-4 table-bordered">
               <td class="col-md-6 col-sm-12 " style="padding: 18px;">
                  <div class="row mt-4 profile-div">
                     <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 pb-2" id="user_img">
                        @if($lawyer->photo !='')
                        <img src="{{ url('/storage/app/public/'.$lawyer->photo) }}" class="w-100" style="width:200px !important; height:200px;"/>
                        @else
                           <img src="{{ url('/storage/app/public/default.png')}}" class="w-100" style="width: 200px !important; height:200px;"/>
                        @endif
                     </div>
                     <div class="col-md-7 col-lg-7 col-xs-12 col-sm-12">
                        <div class="details" style="display:inline">
                           <h5 class="name" style="font-weight:800; font-size:14px;float:left;">Name -</h5>
                           <h3 class="font-weight-bold text-capitalize" style="font-size:16px;">{{$lawyer->name}} {{$lawyer->mid_name}} {{$lawyer->last_name}}  
                              <br>
                           </h3>
                        </div>
                        <div class="details" style="display:inline;">
                           <h5 class="licence_no" style="font-weight:800; font-size:14px;float:left;">Licence no -</h5>
                           <h5 class="" style="font-size:16px;">{{$lawyer->licence_no}} 
                              <br>
                           </h5>
                        </div>
                        <div class="details" style="display:inline;">
                           <h5 class="address" style="font-weight:800; font-size:14px;float:left;">Address -</h5>
                           <h5 class="" style="font-size:16px;">{{$lawyer->addr1}} {{$lawyer->addr2}} 
                              <br>
                           </h5>
                        </div>
                        <div class="details" style="display:inline;">
                           <h5 class="city" style="font-weight:800; font-size:14px;float:left;">City -</h5>
                           <h5 class="" style="font-size:16px;">
                          
                           <i class="text-success" style="font-size:18px;"></i> &nbsp;
                           {{$lawyer->city_name}} - {{$lawyer->zip_code}}
                           </h5>
                        </div>
                        <h6 class="">
                           <h5 class="state" style="font-weight:800; font-size:14px;float:left;">State -</h5>
                           <i class="text-success" style="font-size:16px;"></i> &nbsp;{{$lawyer->state_name}}
                        </h6>
                        <h6 class="">
                           <i class="fa fa-map-marker text-success" style="font-size:16px;"></i> &nbsp;{{$lawyer->country_name}} 
                        </h6>
                        <!--  -->
                        <h1>
                           @if(Auth::user())
                           <a href="javascript:void(0)" onclick="loginChecked('{{ $lawyer->id }}')" style="text-decoration: none"  class="btn text-info"><i class="fa fa-envelope"></i> Message</a>
                           
                           @else
                           
                           <a href="javascript:void(0)" onclick="loginChecked('{{ $lawyer->id }}')" style="text-decoration: none"  class="btn text-info btn-msg"><i class="fa fa-envelope"></i> Message</a>
                           @endif
                           </h1>
                     </div>
                     <div class="col-md-12">
                     </div>
                  </div>
               </td>
               <td class="col-md-6 col-sm-6" id="book_desktop" style="padding: 18px;">

                  <h6 class="">
                     @if(count($lawyer->specialities) !=0)
                     <i class="fa fa-balance-scale text-info"></i>
                     @foreach($lawyer->specialities as $spec )
                     {{$spec->specialization_catgs !=null  ? $spec->specialization_catgs->catg_desc : ''}}, 
                     @endforeach
                     @endif
                  </h6>
                  <h6 class="">  
                     @if(count($lawyer->user_courts) !=0)   
                     <i class="fa fa-university text-info"></i>
                     @foreach($lawyer->user_courts as $courts )
                     {{ $courts->court_catg->court_name }} at {{ $courts->court_catg->city_name }},
                     @endforeach
                     @endif
                  </h6>
                  <h6 class="">  
                     <i class="fa fa-graduation-cap text-info"></i>{!! \APP\Helpers\Helpers::userqual($lawyer->id); !!}
                  </h6>

                  <h6 class="">  
                     <i class="text-info fa fa-user"><span style="color:#000;">&nbsp;Profile Description:</span></i>
                     <p style="margin:auto;">{!! html_entity_decode(Str::words($lawyer->detl_profile, 100) ) !!}</p>
                  </h6>


                  <div class="row" style="">
                     <div class="col-md-4 col-xm-12 col-sm-12">
                        <a href="{{ url('lawyerprofile',$lawyer->id)}}" class="btn btn-md text-primary btn-dp">Detail Profile</a> 
                     </div>
                     <div class="col-md-4 col-xm-12 col-sm-12">
                        <div class="row">
                           <div class="col-md-6 col-xm-12 col-sm-12 viewP text-uppercase">
                              @if($lawyer->verified_account !=0)
                              <span class="badge badge-success mt-3">Verified</span>
                              @endif
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-xm-12 col-sm-12">
                        <p class="m-0">
                           <?php $a=array(); ?>
                           @foreach($lawyer->reviews as $review)
                           <?php $a[] = $review->review_rate ; ?>
                           @endforeach
                        </p>
                        <div><i class="ng-binding"><?php echo count($a) ?> Review</i></div>
                        <span class="star-rating">
                        <?php 
                           if(count($a)==0){
                              $no_of_reviews =0;
                           }
                           else{
                              $no_of_reviews = array_sum($a)/count($a);
                           }
                           
                           $ratings = $no_of_reviews; ?>
                        @for($i=1;$i<= floor($ratings);$i++)
                        <i class="fa fa-star" style="color:chocolate"></i>
                        @endfor
                        @if(substr($ratings, strpos($ratings, ".") + 1)==5)
                        <i class="fa fa-star-half-o" style="color:chocolate"></i>
                        @elseif($ratings != 5.0 || $ratings==null)
                        <i class="fa fa-star-o" style="color:chocolate"></i>
                        @endif
                        @for($i=1;$i<=(4-floor($ratings));$i++)
                        <i class="fa fa-star-o" style="color:chocolate"></i>
                        @endfor                    
                        </span>
                        <!-- <?php  //echo substr($ratings, 1+1);?> -->
                     </div>
                  </div>
               </td>
            </tr>
            @endforeach
            @else
            <tr>
               <td class="text-center">
                  <h3 class="text-danger">No Matching Records Found</h3>
               </td>
            </tr>
            @endif
         </tbody>
      </table>
      {!! $lawyers->links() !!}
   </div>
</div>
@include('models.login_model')
@include('models.booking_model')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script type="text/javascript">
   @php
   if(Session::has('errors')){
      @endphp
      $(document).ready(function(){
         $('.login_modal').modal({show: true});
      });
      @php 
   }
   @endphp
   
   @php
   if($message = Session::get('success')) {
      @endphp
      alert("{{$message}}");
      @php 
   }
   if($message = Session::get('warning')) {
      @endphp
      alert("{{$message}}");
      @php 
   }
   @endphp
</script>
<script type="text/javascript">
  $( document ).ready(function() {
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

  $('#user_name').on('blur',function(e){
    var user_name_s = $(this).val(); 
    $('#model_user_name').val(user_name_s);
  })

$(".filteBtn").on('click',function(e){
  
  e.preventDefault();
  var specialist =  $('#specialist_lawyer option:selected').attr('data-id');
  var state_code = $('#state').val();
  var city = $('#city option:selected').attr('data-id');
  var gender = $("input[name='gender']:checked").val();
  var searchfield = $("input[name='searchfield']:checked").val();
  var court_id = $('#court_id').val();
  var user_name = $("input[name='user_name']").val();
  var url1 = '';
  if(specialist !='0'){
    if(city !='0'){
      url1 = "{{url('search')}}/"+slug_name(specialist)+'/'+slug_name(city); 
    }else{
      url1 = "{{url('search')}}/"+slug_name(specialist); 
    }
  }else if(city !='0'){
    url1 = "{{url('search')}}/"+slug_name(city); 

  }else{
    url1 = "{{url('search')}}";
  }
  window.location.href = url1 + '?' + 'gender='+gender+'&searchfield='+searchfield+'&court_id='+court_id+'&user_name='+user_name;
  
});

$(document).on('click', '.pagination a',function(event)
{
    event.preventDefault();
    $('li').removeClass('active');
    $(this).parent('li').addClass('active');

    var myurl = $(this).attr('href');
    var page=$(this).attr('href').split('page=')[1];

  var specialist =  $('#specialist_lawyer option:selected').attr('data-id');
  var state_code = $('#state').val();
  var city = $('#city option:selected').attr('data-id');
  var gender = $("input[name='gender']:checked").val();
  var searchfield = $("input[name='searchfield']:checked").val();
  var court_id = $('#court_id').val();
  var user_name = $("input[name='user_name']").val();
  var url = window.location.href;

  window.location.href = url + '?' + 'gender='+gender+'&searchfield='+searchfield+'&court_id='+court_id+'&user_name='+user_name+'&page='+page;  
});

$(document).on('change','#specialist_lawyer',function(e){
  e.preventDefault();
  var city = $('#city option:selected').attr('data-id');
  var catg = $('#specialist_lawyer option:selected').attr('data-id'); 
  if(catg !='0' ){
    if(city !='0'){
        window.location.href = "{{url('search')}}/"+slug_name(catg)+'/'+slug_name(city); 
    }else{
        window.location.href = "{{url('search')}}/"+slug_name(catg); 
    }
  }

});

$(document).on('change','#city',function(e){
  e.preventDefault();

  var city = $('#city option:selected').attr('data-id');
  var catg = $('#specialist_lawyer option:selected').attr('data-id');

    var searchfield = $('input[name="searchfield"]:checked').val();
    
  if(searchfield != 'lawcompany'){    
    if(city !='0' ){
      if(catg !='0'){

          window.location.href = "{{url('search')}}/"+slug_name(catg)+'/'+slug_name(city); 
      }else{
          window.location.href = "{{url('search')}}/"+slug_name(city); 
      }
    }
  }else{
    var city_code = $(this).val();
    var state_code = '';
    var court_id = '#court_id';
    state_city_court(city_code,state_code,court_id);
  }
  

});
  
});
</script>
<script >
function loginChecked($user_id){
  var AuthUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
  if(AuthUser){
    var checkUser = "{{(Auth::user()) ? Auth::user()->id : null}}";
    if(checkUser != $user_id){
      let url = "{{ route('message.create', 'id=:id') }}";
        url = url.replace(':id', $user_id);
        document.location.href=url;
    }
    else{
      alert("You can't send message on your own profile")
    }
  }
  else{
     $('.login_modal').modal({show: true});
    }
} 

</script>
@endsection