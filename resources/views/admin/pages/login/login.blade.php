@extends('admin.layouts.layout_login_admin')
@section('content')
<main class="login-page">
    <div class="main-login">
        <div class="auth-page">
            <div class="auth-screen">
                <div class="top-auth">
                    <figure>
                        <img src="{{ asset('images/logo-big.png') }}" alt="dinas pariwisata provinsi jawa barat" class="img-fluid login-logo">
                    </figure>
                    <h1>Selamat Datang, <span>Admin</span></h1>
                    <h5>Login ke CMS Desa Wisata Jawa Barat</h5>
                </div>
                <div class="mid-auth">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div id="pesan"></div>
                    @include('admin.partial.message')
                    <form class="login-form reset-field" id="formbackendlogin" method="post" action={{ route('backend.login') }}>
                        @csrf
                        <div class="form-group">
                            <label class="control-label">
                                Email
                            </label>
                            <input type="email" name="email" class="form-control" placeholder="example: name@gmail.com" value="">
                            @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group has-icon">
                            <label class="control-label">
                                Password
                            </label>
                            <input type="password" name="password" class="form-control" id="password">
                            <button type="button" class="pass-control" id="btnPassword"><i class="mdi mdi-eye-outline"></i></button>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <a href="{{ url('/backend/forget-password') }}">Lupa password?</a>
                        <input type="hidden" name="source" value="admin_login">
                        <input type="hidden" name="target" value="backend/login">
                        {{-- <input type="submit" class="btn btn-default btn-full" value="Login"> --}}
                        <button type="submit" class="btn btn-default btn-full" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order">Login</button>
                    </form>
                </div>
                {{-- <div class="bottom-auth">
                    <p class="text-center">Tidak punya Akun? <a href="{{ url('/backend/register') }}">Daftar Sekarang</a></p>
                </div> --}}
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container-fluid">
            <p class="text-center">
                Dinas Pariwisata dan Kebudayaan Provinsi Jawa barat {{ date('Y') }} | <a href="{{ route('backend.support') }}">Bantuan Penggunaan</a>
            </p>
        </div>
    </footer>
</main>
@endsection

@section('script')
<script>
    function showPassword(element) {

        if (element !== '') {
            var x = document.getElementById(element);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    }

</script>
@endsection
