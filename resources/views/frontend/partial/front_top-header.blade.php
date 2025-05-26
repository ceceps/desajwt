<header class="top-header">
    <div class="container-fluid">
        <div class="home-header">
            <button type="button" class="mob-menu mob-only">
                <i class="icon icon-menu-1"></i>
            </button>
            <div class="home-logo">
                <a href="/">
                    <img src="{{ asset('images/main-logo.png')}}" alt="pesona wisata jawa barat" class="img-fluid">
                </a>
                <h1> {{ config('app.name', 'Laravel') }}</h1>
            </div>
            <button type="button" class="mob-submit mob-only">
                <i class="icon icon-paper-plane"></i>
            </button>
            <div class="right-header">
                <nav class="site-navigation">
                    <div class="navbar navbar-expand-lg">
                        <a href="/" class="site-link">Beranda</a>
                        <a href="{{ route('desawisata') }}" class="site-link">Desa Wisata</a>
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
                                        <a href="{{ route('galeri') }}" class="dropdown-item" href="#">View all media</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="#0" class="site-link">Tentang Kami</a>
                    </div>
                </nav>
                <div class="home-user">
                    <div class="button-group">
                        <button class="btn btn-default">
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
                        @else
                        <button class="btn btn-default">
                            <i class="mdi mdi-login"></i>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </button>
                        @endguest
                        <!-- <button type="button" class="btn btn-default"> <i class="mdi mdi-map-marker-circle"></i> Submit Location </button> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
