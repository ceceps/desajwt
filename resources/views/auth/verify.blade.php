@extends('frontend.layouts.layouts_front')


@section('content')
<div class="detail-page">
        <div class="page-breadcrumb">
          <div class="container">
            <ul class="list-unstyled">
              <li>
              <a href="{{ url('/')}}">
                  <i class="mdi mdi-home"></i>
                  Beranda / &nbsp;
                </a>
              </li>
              <li>
                 Verify Email
              </li>
            </ul>
          </div>
        </div>

  <article class="detail-post">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Verifikasi Alamat Email') }}</div>

                            <div class="card-body">
                                @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Link Verifikasi telah dikirim ke email Anda.') }}
                                </div>
                                @endif {{ __('Sebelum login, silahkan cek email Anda untuk klik link verifikasi.') }} {{ __('Jika tidak menerima email silahkan buat baru') }}, <a href="{{ route('verification.resend') }}">{{ __('klik disini untuk buat baru') }}</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </article>
</div>
@endsection
