<header class="top-header">
    <div class="container-fluid">
        <div class="home-header">
            <button type="button" class="mob-menu mob-only">
                <i class="icon icon-menu-1"></i>
            </button>
            <div class="home-logo">
                <a href="index.html">
                   <img src="{{ asset('images/logo.png') }}" alt="pesona wisata jawa barat" class="img-fluid">
                </a>
                <h1>Desa Wisata Jawa Barat</h1>
            </div>
            <button type="button" class="mob-submit mob-only">
                <i class="icon icon-paper-plane"></i>
            </button>
            <div class="right-header">
                    <nav class="site-navigation">
                        <div class="navbar navbar-expand-lg">
                            <a href="/" class="site-link">Beranda</a>
                            <a href="{{ route('desawisata') }}" class="site-link">Desa Wisata</a>
                            <a href="{{ url('/peta_destinasi') }}" class="site-link">Peta  Wisata</a>
                            <a href="{{ url('/profildesa') }}" class="site-link">Profil Desa</a>
                            <a href="{{ url('/artikel') }}" class="site-link">Artikel</a>
                            <div class="collapse navbar-collapse" id="media">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" id="newsHome">
                                            Galeri
                                        </a>
                                        <div class="dropdown-menu mt-0" aria-labelledby="newsHome">
                                            <a href="{{ route('galeri.foto') }}" class="dropdown-item" href="#">Foto</a>
                                            <a href="{{ route('galeri.video') }}" class="dropdown-item" href="#">Video</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="{{ route('galeri') }}" class="dropdown-item" href="#">Semua</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                         <a href="{{ url('halaman/tentang-kami') }}" class="site-link">Tentang Kami</a>
                            @guest
                               &nbsp;
                            @else
                            {{-- @hasanyrole('superadmin|admin_disparbud|admin_kabkota|jabarjuara|member') --}}
                                <div class="collapse navbar-collapse" id="media">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item dropdown">
                                        <a class="nav-link" href="#" id="newsHome">
                                                Profil
                                            </a>
                                            <div class="dropdown-menu mt-0" aria-labelledby="newsHome">
                                                <a href="{{ url('user/profil/'.auth()->user()->id) }}" class="dropdown-item" href="#">Lihat Profil</a>
                                                @hasanyrole('superadmin|admin_disparbud|admin_kabkota|jabarjuara')
                                                <div class="dropdown-divider"></div>
                                                    <a  href="{{ route('dashboard') }}" id="newsHome" class="dropdown-item"> Backend
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                 @endhasanyrole
                                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="dropdown-item" >
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endguest
                            {{-- @else
                               &nbsp;
                            @endhasanyrole --}}
                        </div>
                    </nav>
                    <div class="home-user">
                        <div class="button-group">
                            <button class="btn btn-default btn-search">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            @guest
                            <button class="btn btn-default">
                                <i class="mdi mdi-account"></i>
                                <a href="{{ route('register') }}"> Daftar</a>
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-default">
                                <i class="mdi mdi-login"></i>
                                Login
                            </a>
                            @endguest
                            <!-- <button type="button" class="btn btn-default"> <i class="mdi mdi-map-marker-circle"></i> Submit Location </button> -->
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="top-search">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                    <form action="{{ url('/') }}" method="GET"  autocomplete="off">
                    <div class="form-group is-search">
                            <input type="text" name="search_text" class="form-control" placeholder="Cari Informasi dan Destinasi Tujuan Anda">
                            <div class="button-group">
                                <button type="submit" class="btn btn-default" onclick="location.href='search-page.html'">Cari</button>
                                <button type="button" class="btn btn-clean btn-search">Batal</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>


</header>
