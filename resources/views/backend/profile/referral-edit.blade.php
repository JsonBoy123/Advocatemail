@extends('backend.layouts.main')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-5">
  <!-- Main Section -->
  <section class="content">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header with-border">
              <div class="card-title">
                <h4>Edit Referral User</h4>
              </div>
              <br>
              <form action="{{url('referral.update',$user->id)}}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                  <div class="col-md-6 form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control timepicker" name="name" value="{{old('name') ?? $user->name}}">  
                    @error('name')
                    <span class="text-danger">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror      
                  </div>  
                  <div class="col-md-6 form-group">
                    <label for="email">Email Address <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{old('email') ?? $user->email}}">
                    @error('email')
                    <span class="text-danger">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="mobile">Mobile Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control timepicker" name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" value="{{old('mobile') ?? $user->mobile}}"> 
                    @error('mobile')
                    <span class="text-danger">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror     
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="state_code">State <span class="text-danger">*</span> </label>
                    <select name="state_code" class="form-control" id="state">
                      <option value="0">Select state</option>
                      @foreach($states as $state)
                      <option value="{{ $state->state_code }}" {{old('state_code') == $state->state_code ? 'selected' : ''}} {{$user->state_code ==$state->state_code ? 'selected' : ''}}>{{ $state->state_name}}</option>
                      @endforeach
                    </select>
                    @error('state_code')
                    <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="city_code">City <span class="text-danger">*</span> </label>
                    <select name="city_code" class="form-control " id="city">
                    </select>
                    @error('city_code')
                    <span class="invalid-feedback text-danger" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="row ">
                  <div class="col-md-12 ">
                    <input type="hidden" name="country_code" value="102">
                    <input type="submit" value="Submit" class="btn btn-sm btn-primary">
                  </div>                
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
  <!-- Content Footer Start -->
  <footer class="main-footer">

    <strong>Copyright &copy; 2022 <a href="https://member.advocatemail.com">ADVOCATEMAIL</a>.</strong> All rights
    reserved.
  </footer>


  <aside class="control-sidebar control-sidebar-dark">

    <div class="tab-content">

      <div class="tab-pane" id="control-sidebar-home-tab">

      </div>
    </aside>

    <div class="control-sidebar-bg"></div>
    <!-- Content Footer End -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- /.content-wrapper -->
@endsection
  <script type="text/javascript">

  // Specialization Area Script

    $(document).ready(function() {
      $(function() {
        $( "#parts-selector-1" ).partsSelector();
      });
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#submit').on('click',function(e){
        e.preventDefault();
        var specc = $("#lspec input[name='valuSpeci[]']")

        .map(function(){
          return $(this).val();
        }).get();


        var specc_name = [];
        $("#lspec li").each(function(){ 
          specc_name.push($(this).text()) 
        });

        if(specc != ''){
         $.ajax({
          type:'POST',
          url:"{{url('store')}}",
          data:{
            "_token": "{{ csrf_token() }}",
            "specc_code": specc,
            "specc_name": specc_name
          },
          success:function(data){

            swal({
              text: data,
              icon : 'success',
            });

            setTimeout(function(){ 
              location.reload(); 
            }, 3000); 

          }
        });
       }
       else{
        swal({
          text: 'Add Specialization',
          icon: 'warning',
        });

      }

    });

// Parctice Court Script
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(function() {
        $( "#parts-selector-1" ).partsSelector();

      });

      var city_code = '';
      var court_id = '#courtType';
      var state_code = $('#state').val();
      var court_type = '1';

      state_city_court(city_code,state_code,court_id,court_type);
      court_fetch(court_type);

      $('#state').on('change',function(){
        var state_code = $(this).val();

        state_city_court(city_code,state_code,court_id,court_type);
      });

      $('#courtType').on('change',function(){
        var court_type = $(this).val();
        court_fetch(court_type);

      })

      function court_fetch(court_type){
        var state_code = $('#state').val();

        $.ajax({

          type:'POST',
          url:"{{url('user_court_list')}}",
          data:{
            "_token": "{{ csrf_token() }}",
            "state_code": state_code,
            "court_type": court_type,
          },
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

      function state_city_court(city_code,state_code,court_id,court_type){    
        $.ajax({
          type:'GET',
          url:"{{url('/state_city_court')}}",
          data: {state_code:state_code},
          success:function(res){

            if(res.length !=0){
              $(court_id).empty();

              $(court_id).append('<option value="0">Select Practicing Courts</option>');
              $.each(res,function(key,value){
                $(court_id).append('<option value="'+value.court_type+'" '+(court_type == value.court_type ? 'selected' : '')+' >'+value.court_type_desc+'</option>');
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

      $('#submitpc').on('click',function(e){
        e.preventDefault();
        var courts = $("#lcourt input[name='valuCourt[]']")
        .map(function(){return $(this).val();}).get();
        if(courts != ''){
          $.ajax({
            type:'POST',
            url:"{{url('/pc_court_store')}}",
            data:{
              "_token": "{{ csrf_token() }}",
              "court": courts
            },
            success:function(data){
              swal({
                text: data,
                icon : 'success',
              });
                  setTimeout(function(){// wait for 5 secs(2)
                     location.reload(); // then reload the page.(3)
                   }, 3000); 
                }
              });
        }
        else{
          swal({
            text: 'Add Practicing Court',
            icon : 'warning',
          });
              setTimeout(function(){// wait for 5 secs(2)
                 location.reload(); // then reload the page.(3)
               }, 3000); 
              
            }
          });

    });
  </script>

  <!-- Change Password Script -->
  <script>
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  </script>

  <!-- Qualifaction Scritp -->
  <script>
    $(document).ready(function(){
      $('#qualification').DataTable();
    });

    $(document).ready(function(){
      $('#qual_catg_code').on('change',function(){
        var qual_catg_code = $(this).val();

        if(qual_catg_code!=0){
          $.ajax({
            type:'GET',
            url:'{{url("qual.category")}}?qual_catg_code='+qual_catg_code,
            success:function(data){

              if(data){
                $("#course_catg").empty();
                $('#course_catg').append('<option value="0">Select Course Name</option>');
                $.each(data, function(key,value){
                  $("#course_catg").append('<option value="'+value.qual_code+'">'+value.qual_desc+'</option>');
                });
              }
              else{
                $('#course_catg').empty();
              }
            }
          });
        }
        else{
          $('#course_catg').empty();
        }

      });

      var qual_catg_code  = $('select[name="qual_catg_code"] option:selected').val();

      var old_qual = "{{old('qual_code')}}";

// console.log(qual_catg_code);
// console.log(old_qual);

      if(qual_catg_code!=0){
        $.ajax({
          type:'GET',
          url:'{{url("qual.category")}}?qual_catg_code='+qual_catg_code,
          success:function(data){

            if(data){
              $("#course_catg").empty();
              $('#course_catg').append('<option value="0">Select Course Name</option>');
              $.each(data, function(key,value){
                $("#course_catg").append('<option value="'+value.qual_code+'" '+ (value.qual_code == old_qual ? 'selected' : '') +' >'+value.qual_desc+'</option>');
              });
            }
            else{
              $('#course_catg').empty();
            }
          }
        });
      }
      else{
        $('#course_catg').empty();
      }

    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){

      $('#state').on('change',function(e){
        e.preventDefault();
        var state_code = $(this).val();
        var city_code = "";
        state(state_code, city_code);
      });
    });
  </script>
  <script type="text/javascript">

$(document).ready(function(){

  $('#state').on('change',function(e){
    e.preventDefault();
    var state_code = $(this).val();
    var city_code = "";
    state(state_code, city_code);
  });

  var state_code =("{{old('state_code')}}" == '' ? "{{$user->state_code}}" : "{{old('state_code')}}" );  
  var city_code = ("{{old('city_code')}}" == '' ? "{{$user->city_code}}" : "{{old('city_code')}}" );

  if(state_code !=''){
    state(state_code, city_code);
  }

});
</script>
</body>
</html>