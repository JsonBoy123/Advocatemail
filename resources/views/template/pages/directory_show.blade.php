<section class="mt-5 mb-5">
  <div class="container">
    <div class="row">
        <div class="col-md-11 m-auto">
            <div class="card shadow-sm card-border-top" >
                <div class="card-header text-center p-2" style="border-radius: 0px ">
                  <h5 class="card-title" style="color:blue">Number of Lawyers in {{$s_name}}</h5>
                </div>
                <div class="card-body p-5 bg-gray">
                    <div class="row" id="cityRow">
                    	  @foreach($cities as $city)
	                        <div class="col-md-4">
	                            <a href="javascript:void(0)" class="text-dark cityView" id="{{$city->city_code}}" data-id="{{$city->city_name}}"> <i class="fa fa-map-marker "></i> {{$city->city_name}} ({{$city->users !=null ? count($city->users) : '0'}})</a><br/><br/>
	                        </div>
	                      @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<script>
  $(document).ready(function(){
      $('.cityView').on('click',function(){
        var city_name = $(this).data('id');
        var city_code = $(this).attr('id');
      
            var str = city_name.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
            str = str.replace(/^\s+|\s+$/gm,'');
            str = str.replace(/\s+/g, '-');  
            window.location.href =  '/directory/{{$state_name}}/'+str+'/'+city_code;
      })
    })
</script>
</section>