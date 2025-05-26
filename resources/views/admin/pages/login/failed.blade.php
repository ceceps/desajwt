@extends('admin.layouts.layout_login_admin')
@section('content')
    <main class="login-page">
      <div class="main-login verify">
        <div class="auth-page verify">
            <div class="auth-screen">
                <div class="top-auth no-logo">
                    <h1>Maaf Anda tidak dapat mengakses Halaman ini</h1>
                </div>
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
