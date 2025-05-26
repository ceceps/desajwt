@extends('admin.layouts.layout_login_admin')
@section('content')
    <main class="login-page">
      <div class="main-login verify">
        <div class="auth-page verify">
            <div class="auth-screen">
                <div class="top-auth no-logo">

                <h1>Maaf Kode Verifikasi Anda Salah</h1>
                </div>
                    <p style="padding:20px; text-align:center">Jika Anda belum terdaftar silahkan <a href="{{ url('/register') }}">Daftar terlebih dahulu</a></p>

            </div>
        </div>
       </div>

        <footer class="main-footer">
          <div class="container-fluid">
            <p class="text-center">
            Dinas Pariwisata Provinsi Jawa barat 2018 | <a href="{{ url('/support') }}">Bantuan Penggunaan</a>
            </p>
          </div>
        </footer>
    </main>
@endsection
@section('script')
     <script>
           function showPassword(element) {
        console.log(element);
        if(element!==''){
            var x = document.getElementById(element);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
                }
            }
        }
        $(document).ready(function () {
            //Halaman Login dan Register
            $('#btnPassword').on('click',function(){
                showPassword('password');
            });

            $('#btnConfirm').on('click',function(){
                showPassword('confirm-password');
            });

            $('form#formregister').submit(function(e){
                var action = $(this).attr('action');
                $.post(action,$(this).serialize(),function(respon){
                   console.log(respon);
                });
            });
        });
     </script>


@endsection
