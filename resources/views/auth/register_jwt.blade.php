@extends('frontend.layouts.layouts_front_new')

@section('content')
<div class="user-auth">
        <div class="container">
          <div class="inner-login">
            <div class="inner-login-media">
              <figure>
                <img src="images/login-media.png" alt="login" class="img-fluid">
              </figure>
            </div>
            <div class="inner-login-input">
              <div class="auth-screen">
                <div class="top-auth no-logo">
                  <h1>Daftar Baru</h1>
                </div>
                <div class="mid-auth">
                <form class="login-form reset-field" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label class="control-label">
                        Nama Lengkap
                      </label>
                      <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" name="name" placeholder="Nama Anda" autocomplete="false">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label class="control-label">
                        Email
                      </label>
                      <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="example: name@gmail.com">
                      @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <label class="control-label">
                        Telp
                      </label>
                      <input type="text" name="telp" class="form-control" placeholder="6282121234567">
                    </div>
                    <div class="form-group has-icon">
                      <label class="control-label">
                        Password
                      </label>
                      <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                      <button type="button" class="pass-control"><i class="mdi mdi-eye-outline"></i></button>
                      @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group has-icon for-password">
                      <label class="control-label">
                        Konfirmasi Password
                      </label>
                      <input type="password"  name="password_confirmation" class="form-control password">
                      <button type="button" class="pass-control"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-default btn-full">
                     Daftar
                    </button>
                  </form>
                </div>
                <div class="bottom-auth">
                <p class="text-center">Sudah Punya Akun ? Kembali ke <a href={{ route('login') }}P">Halaman Login</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
