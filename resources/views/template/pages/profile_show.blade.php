<section class="mt-5 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-auto">
                <div class="card shadow-sm card-border-top">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img style="width:100%;" height="200" src="{{$user->photo !=null ? asset('storage/'.$user->photo) : ($user->gender == 'F' ? asset('advocate-female.png') : asset('advocate-male.png')) }}">
                            </div>
                           <div class="col-md-9">
                               <div class="row">
                                    <p style="color:blue" class="font-weight-bold mb-1 col-md-3">Advocate Name </p>
                                    <p class="font-weight-bold mb-1 col-md-9">{{$user->name}}</p>
    				            </div>
                                <div class="row">
                                    <p style="color:blue" class="font-weight-bold mb-1 col-md-3">Date of Birth </p>
                                    <p class="font-weight-bold mb-1 col-md-9">{{$user->dob !=null ? date('d-m-Y',strtotime($user->dob)) : 'N/A' }}</p>
                                </div>

    				            <div class="row">
                                    <p style="color:blue" class="font-weight-bold mb-1 col-md-3">Registeration Year</p>
                                    <p class="font-weight-bold mb-1 col-md-9">{{$user->registration_year ? $user->registration_year : 'N/A'}}</p>
                                </div>
    				            <div class="row">
                                    <p style="color:blue" class="font-weight-bold mb-1 col-md-3">Specialization </p>  
                                     <p class="font-weight-bold mb-1 col-md-9">
                                        @php $spec_string = '' ; @endphp
                                        @foreach($user->specs as $spec)
                        
                                                @if($spec->specialization !=null)
                                                  @php  $spec_string .= $spec->specialization->spec_name.', ' ; @endphp
                                                @endif
                                        @endforeach
                                        {{substr($spec_string,0,strlen($spec_string)-2)}}
                                    </p>          
                                </div>
                                <div class="row">
                                    <p style="color:blue" class="font-weight-bold mb-1 col-md-3">Practicing Court </p>  
                                     <p class="font-weight-bold mb-1 col-md-9">
                                        @php $crt_string = '' ; @endphp
                                        @foreach($user->court as $crt)
                        
                                                @if($crt->court_catg !=null)
                                                  @php  $crt_string .= $crt->court_catg->court_name.', ' ;                  @endphp
                                                @endif
                                        @endforeach
                                        {{substr($crt_string,0,strlen($crt_string)-2)}}
                                    </p>          
                                </div>
    				           
    				        </div>
    				      
    				        
    				        <div class="col-md-12 mt-4">
    				             {{$user->detl_profile}}
    				        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>