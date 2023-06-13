@extends('backend.layouts.main')
@section('content')
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header with-border"> 
          <h3 class="card-title">
            Select Working Courts
          </h3>
          </div>
          <div class="card-body">
            <div class="row form-group" style="margin-top: 10px;">
              <div class="col-md-6">
                <label>State Name</label>
                <select class="form-control" name="state_code" id="state">
                    <option value="0">Select State</option>
                    @foreach($states as $state)
                      <option value="{{$state->state_code}}" {{$state->state_code == 10 ? 'selected' : ''}}>{{$state->state_name}}</option>
                    @endforeach
                  
                </select>
              </div>
            <div class="col-md-6" style="margin-top: 10px;">
                <label>Court Type Name</label>
                <select class="form-control" name="court_type" id="courtType">
                    
                </select>
              </div>
            </div>


              <div class="parts-selector" id="parts-selector-1">
                  <div class="parts list h-40vh">
                    <h3 class="list-heading top-fixed">All Practicing Courts</h3>
                    <ul id="practice_court">
                    
                      <li>
                          <!--<input type="hidden" name="valuCourt[]" value="" id="valuCourt">Select working Courts-->
                      </li>
                    
                    </ul>
                  </div>

                  <div class="controls">
                      <a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
                      <a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
                  </div>

                      <div class="selected list">
                        <h3 class="list-heading">Your Practicing Court</h3>
                      
                        <ul id="lcourt">
                            @foreach($courts as $court)
                                <li ><input type="hidden" name="valuCourt[]" value="{{$court->court_catg->court_code}}" id="valuCourt">{{$court->court_catg->court_name}} at {{$court->court_catg->city_name}}
                                </li>
                          @endforeach
                        </ul>
                      </div>
              </div>
              <button class="btn btn-sm btn-primary" id="submit">Submit</button>

            </div>  
        </div>
    </div>

</div>
</section>


<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      $(function() {
        $( "#parts-selector-1" ).partsSelector();

      });
      
      
      var court_id = '#courtType';
      var state_code = $('#state').val();
      
      state_city_court(state_code,court_id);
    //   court_fetch(court_type);

      $('#state').on('change',function(){
          var state_code = $(this).val();
          state_city_court(state_code,court_id);
      });

      $('#courtType').on('change',function(){
          var court_type = $(this).val();
          court_fetch(court_type);
      });
       
       function state_city_court(state_code,court_id,court_type = ''){
        	$.ajax({
        		type: 'GET',
        		url:'/state_court/'+state_code,
        		success:function(res){
        			if(res.length !=0){
        				$(court_id).empty();
        				$(court_id).append('<option value="0">Select Practicing Courts</option>');
        				$.each(res,function(key,value){
        					$(court_id).append('<option value="'+value.court_type+'" >'+value.court_type_desc+'</option>');
        				});
        			}
        			else{
        				$(court_id).empty();	
        				$("#city").append('<option value="0">Select City</option>');
        				$(court_id).append('<option value="0">Select Practicing Courts</option>');	              
        			}
        		}
        	})
        }


      function court_fetch(court_type){
            var state_code = $('#state').val();
            $.ajax({
              type:'GET',
              url:"/user_court_list/"+court_type+'/'+state_code,
              success:function(res){
                if(res){
                  $('#practice_court').empty();
                  $.each(res, function(i,v){
                    // console.log(v)
                    $('#practice_court').append('<li><input type="hidden" name="valuCourt[]" value="'+v.court_code+'" id="valuCourt">'+v.court_name+' at '+v.city_name+'</li>');
                  });

                }else{
                  $('#practice_court').empty();
                }
              }
            });
      }

       $('#submit').on('click',function(e){
          e.preventDefault();
          var courts = $("#lcourt input[name='valuCourt[]']")
                .map(function(){return $(this).val();}).get();
          
          if(courts != ''){
            $.ajax({
              type:'POST',
              url:"{{route('practicing_court.store')}}",
              data: {court:courts},
              success:function(data){
                alert('Practicing court added successfully.');
                window.location.reload();
              }
            });
          }
          else{
            alert('Select Practicing court.');
            
          }
        });


    });
</script>
@endsection