<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('basehead')
<script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
    }
</script>
<body>
<main class="main" id="top">
      <div class="container-fluid">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        <div class="row min-vh-100 bg-100">
          <div class="col-6 d-none d-lg-block position-relative">
            <div class="bg-holder" style="background-image:url(../../../assets/img/14.jpg);">
            </div>
            <!--/.bg-holder-->

          </div>
          <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
            <div class="row justify-content-center g-0">
              <div class="col-lg-9 col-xl-8 col-xxl-6">
                <div class="card">
                  <div class="card-header bg-circle-shape bg-shape text-center p-2"><a class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light" href="">RISDA KEUSAHAWANAN</a></div>
                  <div class="card-body p-4">
                    <div class="row flex-between-center">
                      <div class="col-auto">
                        <h3>Register</h3>
                      </div>
                      <div class="col-auto fs--1 text-600"><span class="mb-0 fw-semi-bold">Already User?</span> <span><a href="/login">Login</a></span></div>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                    @csrf
                      <div class="mb-3">
                        <label class="form-label" for="split-name" :value="__('Name')">Name</label>
                        <input class="form-control" type="text" autocomplete="on" id="split-name" name="name" :value="old('name')" required autofocus/>
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="split-email" :value="__('Email')">Email address</label>
                        <input class="form-control" type="email" autocomplete="on" id="split-email" name="email" :value="old('email')" required/>
                      </div>
                      <div class="row gx-2">
                        <div class="mb-3 col-sm-6">
                          <label class="form-label" for="split-password" :value="__('Password')">Password</label>
                          <input class="form-control" type="password" autocomplete="on" id="split-password" name="password" required autocomplete="new-password"/>
                        </div>
                        <div class="mb-3 col-sm-6">
                          <label class="form-label" for="split-confirm-password" :value="__('Confirm Password')" >Confirm Password</label>
                          <input class="form-control" type="password" autocomplete="on" id="split-confirm-password" name="password_confirmation" required/>
                        </div>
                      </div>
                      <!-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cover-register-checkbox" />
                        <label class="form-label" for="cover-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                      </div> -->
                      <div class="mb-3">
                        <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">{{ __('Register') }}</button>
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