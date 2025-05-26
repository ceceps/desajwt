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
             Profil User
          </li>
        </ul>
      </div>
    </div>
  <!-- begin single page dashboard -->
  <article class="detail-post">
    <div class="container">
    @if(isset($profil))
    @php
       $url = isset($profil->userProfil->avatar)?Storage::url('avatar/'.$profil->userProfil->avatar):'';
       $foto = @getimagesize($url)!=false?$url:Storage::url('avatar/user.png');

    @endphp
    <div class="profile-page">
      <div class="profile-left">
        <div class="profile-left-inner">
          <div class="top-profile">
            <div class="profile-image">
              <img src="{{ asset($foto) }}" alt="" class="img-fluid">
            </div>
            <div class="user-name">
              <h3>{{ $profil->name }}</h3>
              {{-- <h5>Role User biasa</h5> --}}
            </div>

          </div>
          <div class="mid-profile">
            <div class="profile-activity">
              {{-- <h4>Activity</h4>
              <div class="activity-list">
                <div class="activity-entry">
                  <i class="icon icon-ribbon"></i>
                  <div class="activity-text">
                    <h5>Terakhir login</h5>
                    {{ $lastlogin }}
                  </div>
                </div>
              </div> --}}

            </div>
          </div>
        </div>
      </div>

      <div class="profile-right">
        <div class="account-detail">
          <h3>Data Profil</h3>
          @include('admin.partial.message')
        <form class="profile-form form-default" action="{{ route('front.user.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              @method('put')
                <div class="form-group">
                    <label class="control-label">
                    Nama Lengkap
                    </label>
                    <input type="hidden" name="id" value="{{ $profil->id }}">
                    <input type="text" class="form-control" contenteditable="true" name="name" value="{{ $profil->name }}">
                </div>
                <div class="form-group">
                    <div class="fieldset has-two">
                        <div class="fieldset-item">
                                <input type="password" class="form-control" placeholder="Password" contenteditable="true" name="password">
                        </div>
                        <div class="fieldset-item">
                                <input type="password" class="form-control" placeholder="Konfirmasi Password" contenteditable="true" name="password_confirmation">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">
                    Email
                    </label>
                    <input type="email" class="form-control" contenteditable="true" name="email" value="{{ $profil->email }}" readonly>
                </div>

                <div class="form-group">
                    <label class="control-label">
                    Biografi Singkat
                    </label>
                    <textarea class="form-control col-5 col-xs-12" rows="5" contenteditable="true" name="bio" placeholder="catatan singkat pribadi Anda">{{ $profil->userProfil['bio'] }}</textarea>
                </div>
                <div class="form-group">
                        <label class="control-label">
                        Alamat
                        </label>
                        <textarea class="form-control" contenteditable="true" name="alamat">{{ $profil->userProfil['alamat'] }}</textarea>
                    </div>
                    <div class="form-group">
                            <label class="control-label">
                            Telp
                            </label>
                            <input type="text" class="form-control" contenteditable="true" name="telp" value="{{ $profil->telp }}">
                        </div>

                <div class="form-group">
                    <label for="changephoto" class="control-label">Ubah Foto</label>
                    <input type="file" class="form-control" id="changephoto" name="avatar">
                </div>

            <button type="submit" class="btn btn-default end">Update Profil</button>
          </form>
        </div>
      </div>

    </div>
    @endif

  </div>
  </article>
</div>
  <!-- end single page dashboard -->

@endsection
