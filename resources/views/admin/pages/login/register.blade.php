@extends('admin.layouts.layout_login_admin')
@section('content')
    <main class="login-page">
      <div class="main-login">
        <div class="auth-page">
            <div class="auth-screen">
                <div class="top-auth no-logo">
                <h1>Daftar Akun Baru</h1>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="mid-auth">
                <form class="login-form reset-field" method="POST" action="{{ route('backend.register') }}" id="formregister">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Nama Lengkap</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap Anda">
                    </div>
                    <div class="form-group">
                    <label class="control-label">
                        Email
                    </label>
                    <input type="email" name="email" class="form-control" placeholder="example: name@gmail.com">
                    </div>
                    <div class="form-group">
                    <label class="control-label">
                        Telp
                    </label>
                    <input type="text" name="telp" class="form-control" placeholder="62-82121234567">
                    </div>
                    <div class="form-group has-icon">
                    <label class="control-label">
                        Password
                    </label>
                    <input type="password" name="password" class="form-control" id="password">
                    <button type="button"  class="pass-control" id="btnPassword"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                    <div class="form-group has-icon for-password">
                        <label class="control-label">
                            Ulangi Password
                        </label>
                        <input type="hidden" name="target" value="backend/register">
                        <input type="hidden" name="source" value="admin_register">
                        <input type="password" name="password_confirmation" class="form-control" id="confirm-password">
                        <button type="button" class="pass-control" id="btnConfirm"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                    <button type="submit" class="btn btn-default btn-full" id="daftar">
                        Daftar
                    </button>
                </form>
                </div>
                <div class="bottom-auth">
                <p class="text-center">Kembali ke <a href="{{ route('backend.login') }}">Halaman Login</a></p>
                </div>
            </div>
        </div>
       </div>

        <footer class="main-footer">
          <div class="container-fluid">
            <p class="text-center">
            Dinas Pariwisata Provinsi Jawa barat 2018 | <a href="{{ route('backend.support') }}">Bantuan Penggunaan</a>
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
