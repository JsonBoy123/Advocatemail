@extends('backend.layouts.main')
@section('content')
<div class="card">
   <div class="card-header">
      <h5 class="card-title">Specialization</h5>
   </div>
    <div class="card-body">
      <div class="row">
         <div class="col-md-12">
           <div class="box box-primary">
               <div class="box-header with-border">
                 <h3 class="box-title">Select which field you have work</h3>
               </div>
               <div class="box-body ">
                 <div class="parts-selector" id="parts-selector-1">

                     <div class="parts list h-40vh">
                         <h3 class="list-heading top-fixed">Select Specialization</h3>
                       <ul>
                       @foreach($specs as $speciality)
                         <li id="{{$speciality->spec_code}}">
                         <input type="hidden" name="valuSpeci[]" value="{{$speciality->spec_code}}" id="valuSpeci" />{{$speciality->spec_name }}
                         </li>
                       @endforeach
                       </ul>
                     </div>

                     <div class="controls">
                       <a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
                       <a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
                     </div>
                    
                     <div class="selected list">
                       <h3 class="list-heading">Add Specialization</h3>
                       <ul id="lspec">
                        
                        @foreach($user_specializations as $user_specialization)
                           <li id="{{$user_specialization->spec_code}}">
                            <input type="hidden" name="valuSpeci[]" value="{{$user_specialization->catg_code}}" id="valuSpeci" />{{$user_specialization->speci->spec_name}}</li>
                         @endforeach
                       </ul>
                     </div>

                 </div> 
                 <button class="btn btn-md btn-primary" id="submit">Submit</button>
               </div>
           </div><br>
         
         </div>
       </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(function() {
          $( "#parts-selector-1" ).partsSelector();

        });


         $('#submit').on('click',function(e){
              e.preventDefault();
              var specc = $("#lspec input[name='valuSpeci[]']")
                    .map(function(){
                      return $(this).val();
                    }).get();

            
           
              if(specc != ''){
                $.ajax({
                    type:'POST',
                    url:"{{route('specialization.store')}}",
                    data: {specc_code:specc},
                    success:function(data){
                        alert('Specialization added successfully.');
                        window.location.reload();
                    }
                });
              }
              else{
                 alert('Select specialization.');                 
              }

            });
    });
</script>
@endsection