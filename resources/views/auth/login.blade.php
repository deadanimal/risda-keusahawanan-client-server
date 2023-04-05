<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('basehead')
    <body>
    <main class="main" id="top">
      <div class="container-fluid">
        
        <div class="row min-vh-100 " >
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder" style="background-image:url(../../../assets/img/main.jpg);background-position: 50% 20%;">
            </div>
            <!--/.bg-holder-->

          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card" style="background-color: #1C4020">
                  <div class="card-header bg-circle-shape bg-shape text-center p-2" style="background-color:rgb(2, 95, 47);" ><span class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light">RISDA KEUSAHAWANAN</span></div>
                  <div class="card-body p-4">
                    <div class="row flex-between-center">
                      {{-- <div class="col-auto">
                        <h3 style="color: white;">Log Masuk</h3>
                      </div> --}}
                      {{-- <div class="col-auto fs--1 text-600"><span class="mb-0 fw-semi-bold">New User?</span> <span><a href="/register">Create account</a></span></div> --}}
                    </div>
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="/login"> 
                    @csrf
                      <div class="mb-3">
                        <label class="form-label" for="split-login-email" :value="old('email')">Alamat E-mel</label>
                        <input class="form-control" id="split-login-email" type="text" name="email" required/>
                      </div>
                      <div class="mb-3">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="split-login-password" :value="__('Password')">Kata Laluan</label>
                          <a class="fs--1" href="/LupaPass">Lupa Kata Laluan?</a>
                        </div>
                        <input class="form-control" style="display: inline-block;" id="split-login-password" type="password" name="password" autocomplete="current-password" required/>
                        <span class="p-viewer" style="position: absolute;right: 45px;padding-top:5px;">
                          <i class="fa fa-eye" id="mata" onclick="viewpass()"></i>
                        </span>
                      </div>
                      <div class="form-check mb-0">
                        {{-- <input class="form-check-input" type="checkbox" id="split-checkbox" />
                        <label class="form-check-label" for="split-checkbox">Remember me</label> --}}
                      </div>
                      <div class="mb-3">
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                      </div>
                      <div class="mb-3">
                      <button class="btn btn-success d-block w-100 mt-3" type="submit" name="submit">{{ __('Log Masuk') }}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    </body>
</html>
<script>
  function viewpass(){
    var get = $('#split-login-password').attr('type');
    // console.log(get);
    if(get == 'password'){
      $("#split-login-password").prop("type", "text");
      // document.getElementById("mata").className = "MyClass";
      $('#mata').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
      // $("#mata").attr('class', 'fa fa-eye');
    }else if(get == 'text'){
      $("#split-login-password").prop("type", "password");
      $('#mata').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
      // $("#mata").attr('class', 'fa fa-eye-slash');

    }
   
  }
</script>