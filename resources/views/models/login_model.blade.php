<style>
.log-img{
  display: flex;
  justify-content: center;
}
</style>
<div class="modal fade login_modal"  tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
   
      <div class="modal-body">
        <a class="navbar-brand log-img" href="https://advocatemail.com">
          <img src="https://advocatemail.com/template/img/template_logo.png" alt="logo" class="mt-1 mb-5">          
        </a>
         <form action="{{ url('login') }}" method="get" id="formLogin">
              @csrf
          <div class="form-group">
            <label for="email" class="col-form-label">Email address or Mobile Number</label>
            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email address or Mobile number" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            
          </div>
          <div class="form-group mb-0">
            <label for="password" class="col-form-label">Password</label>
             <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>
          <div class="">            
              @if (Route::has('password.request'))
                  <a class="btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                  </a>
               @endif
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn-sm btn-primary" style="border:0px; padding:10px !important;">Login</button>
        </form>
        <a href="{{url('/contact')}}"  class="btn-sm btn-info" style="border:0px; padding:10px !important;" >Contact</a>
        <button type="button" class="btn-sm btn-secondary" style="border:0px; padding:10px !important;" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>