<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 offset-lg-1 col-md-5">
                <h2 class="section-title">Contact Us</h2>
                <ul class="pl-0">
                    <!-- contact items -->
                    <li class="d-flex mb-30">
                        <i class="round-icon mr-3 fa fa-whatsapp" style="font-size: 35px; padding: 17px"></i>
                        <div class="align-self-center font-primary">
                            <p>+918815218334</p>
                        </div>
                    </li>
                    <li class="d-flex mb-30">
                        <i class="round-icon mr-3 ti-email"></i>
                        <div class="align-self-center font-primary">
                            <p>contact[At]advocatemail[DOTcom]</p>
                        </div>
                    </li>
                    {{-- <li class="d-flex mb-30">
                        <i class="round-icon mr-3 ti-map-alt"></i>
                        <div class="align-self-center font-primary">
                            <p>Plot # 2, County Park,</p>
                            <p>Mahalaxmi Nagar, MR-5 Indore-452010</p>
                            <p>Madhya Pradesh India</p>
                        </div>
                    </li> --}}
                </ul>
            </div>
            <!-- form -->
            <div class="col-lg-6 col-md-7">
                <div class="p-5 rounded box-shadow">
                     @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                     @endif  
                    <form action="{{asset('contactStore')}}" class="row" method="post" autocomplete="off" >
                        @csrf 
                       <div class="col-lg-12">
                            <h3>Contact Form</h3>
                        </div>
                        <div class="col-lg-12">
                            <label>Full Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{old('name')}}" required>
                            @error('name')
                                <span class="text-danger f-12" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                             <label>Mobile Number</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  value="{{old('mobile')}}" required>
                            @error('mobile')
                                <span class="text-danger f-12" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="col-lg-6">
                             <label>Email Address</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{old('email')}}"required>
                            @error('email')
                                <span class="text-danger f-12" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         
                        <div class="col-lg-12">
                            <label>Subject</label>
                            <select class="form-control" name="subject_id" required="required">
                                <option value=""> Select Subject</option>
                                @foreach(SUBJECT_LIST as $key => $subject )
                                    <option value="{{$key}}" {{$key == old('subject_id') ? 'selected=selected' : ''}}>{{$subject}}</option>
                                @endforeach
                            </select>
                            
                            
                            @error('subject')
                                <span class="text-danger f-12" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label>Message</label>
                            <textarea class="form-control p-2" name="message" id="message" placeholder="Your Message Here..." required style="height: 150px;">{{old('message')}}</textarea>
                            @error('message')
                                <span class="text-danger f-12" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div  class="col-lg-12 form-group">
                            <label for="captcha">Verification Code</label>
                            <input type="text" name="captcha" placeholder="Enter Verification code given below here" class="form-control" id="captcha">
                            @error('captcha')
                                <span class="text-danger f-12" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span><br>
                            @enderror
                            <span id="spancaptcha">{!!captcha_img('flat')!!}</span>
                             <a href="javascript:void(0)" class="btn btn-sm btn-theme ml-3" id="btn-refresh"><i class="fa fa-refresh"></i></a>

                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-primary" type="submit" value="send">Submit Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script >
    $(document).ready(function(){
        $("#btn-refresh").click(function(){
            $('#captcha').val('');
            $.ajax({
             type:'GET',
             url:'/refresh_captcha',
             success:function(data){
                $("#spancaptcha").empty().html(data)
               
             }
            });

        });
    })
</script>