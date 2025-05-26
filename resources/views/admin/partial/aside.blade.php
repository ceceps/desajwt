@php
  $request = new Input();
  $urlDashboard = route('dashboard');
  $urlProfilLogin = route('backend.user.profile');
  $urlDesaWisata = route('desawisata.index');
  $urlProfilDesa = route('profildesa.index');
  $urlMap = route('map.index');
  $urlGaleri = route('backend.galeri');
  $urlHalaman = route('halaman.index');
  $urlGaleriFoto = route('backend.galeri.foto');
  $urlGaleriVideo = route('backend.galeri.video');
  $profil = App\UserProfil::where('user_id',Auth::user()->id)->first();
  $avatar = (!empty($profil->avatar))?Storage::url('avatar/'.$profil->avatar):'storage/avatar/user.png';
@endphp
<aside class="dashboard-side">
    <div class="side-profile">
      <div class="side-brand">
        <a href="#0" class="brand-logo">
          <img src="{{ asset('images/logo.png') }}" alt="" class="img-profile">
        </a>
        <h2 class="side-top-title">Desa Wisata Jawa Barat</h2>
      </div>
      <div class="profile-thumbnail">
        <img src="{{ asset($avatar) }}" alt="profile" class="img-profile">
      <button type="button" class="btn btn-circle" onclick="location.href='{!! url('backend/users/edit/'.auth()->user()->id) !!}'"><i class="mdi mdi-account-edit"></i></button>
      </div>
      <div class="profile-name">
      <h4>{{ __(\Auth::user()['name']) }}</h4>
        <div class="button-group">
        <button type="button" class="btn btn-default" onclick="window.location='{!! url('backend/users/edit/'.auth()->user()->id) !!}' ">Edit Profil</button>
          {{-- <button type="button" class="btn btn-default">Logout</button> --}}
          <a href="{{ url('/logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"   class="btn btn-default" >
              Logout
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>
    </div>
    <nav class="dashboard-nav">
    <button class="btn nav-item" type="button" onclick="window.location='{!!  $urlDashboard !!}'">
        <i class="icon-home-1"></i>
        <span>Dashboard</span>
    </button>
    <div class="accordion" id="sideMenu">
        <div class="menu-item">
          <button class="btn nav-item" data-toggle="collapse" data-target="#menuOne" aria-expanded="true" aria-controls="menuOne">
                <i class="icon-play-button"></i>
                <span>Desa Wisata</span>
              </button>
          <div id="menuOne" class="collapse child-menu-content" data-parent="#sideMenu">
            <div class="side-child-menu">
                        <a href="{!! $urlDesaWisata !!}">Semua</a>
                        <i class="icon-next"></i>
            </div>
            <div class="side-child-menu">
            <a href="{{ route('desawisata.view.status','tampil') }}">Tampil</a>
                        <i class="icon-next"></i>
            </div>
            <div class="side-child-menu">
              <a href="{{ route('desawisata.view.status','draft') }}">Draft</a>
              <i class="icon-next"></i>
            </div>
            <div class="side-child-menu">
              <a href="{{ route('desawisata.view.status','trash') }}">Trash</a>
              <i class="icon-next"></i>
            </div>
          </div>
        </div>
       <a class="btn nav-item"  onclick="window.location='{!! $urlProfilDesa !!}'">
        <i class="icon-map"></i>
        <span>Profil Desa</span>
      </a>
      <a class="btn nav-item" onclick="window.location='{!! $urlMap !!}'">
        <i class="icon-map"></i>
        <span>Peta Desa Wisata</span>
      </a>
      <div class="menu-item">
          <button class="btn nav-item" data-toggle="collapse" data-target="#menuTwo" aria-expanded="true" aria-controls="menuTwo">
            <i class="icon-play-button"></i>
            <span>Galeri</span>
          </button>
          <div id="menuTwo" class="collapse child-menu-content" data-parent="#sideMenu">
            <div class="side-child-menu">
              <a href="{!! $urlGaleriFoto !!}">
                <i class="icon-gallery"></i>
                Foto
                </a>
            </div>
            <div class="side-child-menu">
              <a href='{!! $urlGaleriVideo !!}'><i class="icon-play-button-1"></i>Video</a>
            </div>
            <div class="side-child-menu">
              <a href='{!! $urlGaleri !!}'>
                <i class="icon-attach"></i>Semua
              </a>
            </div>
          </div>
        </div>
      <div class="menu-item">
            <button class="btn nav-item" data-toggle="collapse" data-target="#menuThree" aria-expanded="true" aria-controls="menuThree">
              <i class="icon-folder"></i>
              <span>Artikel</span>
            </button>
            <div id="menuThree" class="collapse child-menu-content" data-parent="#sideMenu">
              <div class="side-child-menu">
                <a  href="{{ route('artikel.index') }}">
                  <i class="icon-gallery"></i>
                  Posting
                  </a>
              </div>
              <div class="side-child-menu">
                <a href="{!! $urlHalaman !!}">
                  <i class="icon-gallery"></i>
                  Halaman
                  </a>
              </div>
              <div class="side-child-menu">
                <a  href="{{ route('kategoriartikel.index') }}">
                  <i class="icon-attach"></i>Kategori
                </a>
              </div>
            </div>
    </div>

      <a class="btn nav-item">
        <i class="icon-chat"></i>
        <span>Chat</span>
      </a>
      <a class="btn nav-item" href="{{route('backend.user.index') }}">
        <i class="icon-viral-marketing"></i>
        <span>Manajemen Pengguna</span>
      </a>
    </div>
      <br><br>
      <br><br>
    </nav>
    <nav class="dashboard-bottom">
      <button type="button" class="btn btn-default btn-sm">
        <i class="icon-settings"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm">
        <i class="mdi mdi-help-circle"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm side-compact">
        <i class="mdi mdi-chevron-left"></i>
        <i class="mdi mdi-chevron-right"></i>
      </button>
    </nav>
</aside>
