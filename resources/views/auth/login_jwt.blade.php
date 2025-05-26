@extends('frontend.layouts.layouts_front_new')

@section('content')
<div class="user-auth">
    <div class="container">
      <div class="inner-login">
        <div class="inner-login-media">
          <figure>
            <img src="{{ asset('images/login-media.png') }}" alt="login" class="img-fluid">
          </figure>
        </div>
        <div class="inner-login-input">
          <div class="auth-screen">
            <div class="top-auth">
              <figure>
                <img src="{{ asset('images/main-logo.png') }}" alt="dinas pariwisata provinsi jawa barat" class="img-fluid login-logo">
              </figure>
              <h1>Welcome back, <span>User</span></h1>

            </div>
            <div class="mid-auth">
                <div id="pesan"></div>
              <form class="login-form reset-field" action="{{ route('login') }}" method="POST" id="formlogin">
                @csrf
                <div class="form-group">
                  <label class="control-label">
                    {{ __('E-Mail Address') }}
                  </label>
                  <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="example: name@gmail.com" required autofocus>
                         @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                </div>
                <div class="form-group has-icon for-password">
                  <label class="control-label">
                    Password
                  </label>
                  <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                  <button type="button" class="pass-control"><i class="mdi mdi-eye-outline"></i></button>
                  @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
                <button type="submt" class="btn btn-default btn-full">
                    {{ __('Login') }}
                </button>
              </form>
            </div>
            <div class="bottom-auth">
            <p class="text-center">Tidak Punya Akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
      $(function(){
        var store = store || {};
        store.setJWT = function(data){
            this.JWT = data;
        }

          $('#formlogin').submit(function(e){
            e.preventDefault();
            var url = '{{ config('desawisata.LOGIN_URL') }}';
           $.post(url,$('#formlogin').serialize(),function(resp){
                if(resp.error == null){
                        Cookies.set('desawisata-user', resp.token, { expires: 1 });
                        store.setJWT(resp.token);
                        window.location = '/?token='+store.JWT;
                        addTokenURL(resp.token);

                }else{
                    let pesan = '<div class="alert alert-danger" role="alert"><strong>Error</strong> '+resp.error+'</div>';
                    $('#pesan').html(pesan);
                }

            });
          });

      });
  </script>

@endsection
