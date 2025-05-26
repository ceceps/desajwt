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
                    <h1>Recovery Password, <span>Desa Wisata Jabar</span></h1>
                </div>
                <div class="mid-auth">
                    <form action="" class="login-form reset-field">
                            <div class="form-group">
                                    <label class="control-label">
                                        Email
                                    </label>
                                    <input type="email" name="email" class="form-control" placeholder="example: name@gmail.com" value="">
                                </div>
                                <input type="submit" name="lupapassword" class="btn btn-default btn-full" value="Kirim Permintaan">
                    </form>
                </div>
                <div class="bottom-auth">
                    <p class="text-center">Sudah punya Akun? <a href="{{ url('/backend/login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
    <footer class="main-footer">
        <div class="container-fluid">
            <p class="text-center">
                Dinas Pariwisata dan Kebudayaan Provinsi Jawa barat {{ date('Y') }} | <a href="{{ url('/backend/support') }}">Bantuan Penggunaan</a>
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

      $(function(){
           //Halaman Login dan Register
            $('#btnPassword').on('click', function () {
                showPassword('password');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

          $('#formbackendlogin').submit(function(e){
            e.preventDefault();
            var url = '{{ config('desawisata.LOGIN_URL')}}';
           $.post(url,$('#formbackendlogin').serialize(),function(resp){
                Cookies.set('desawisataapps', resp.token, { expires: 1 });
                window.location = '{{ route('dashboard') }}?token='+resp.token;
            });
          });

      });

</script>
@endsection
