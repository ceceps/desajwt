<nav class="dashboard-nav">
    <button javascript="{{ url('backend/dashboard') }}" class="btn nav-item">
                <i class="icon-home-1"></i>
                <span>Dashboard</span>
        </button>
    <button  javascript="window.location='{{ route('profildesa.index') }}'" class="btn nav-item">
                <i class="icon-gps"></i>
                <span>Profil Desa</span>
        </button>

    <div class="accordion" id="sideMenu">
        <div class="menu-item">
            <button class="btn nav-item" javascript="window.location='{{ route('desawisata.index') }}'">
                <i class="icon-gps"></i>
                <span>Desa Wisata</span>
              </button>
        <!--
            <div id="menuFirst" class="collapse child-menu-content" data-parent="#sideMenu">
                <div class="side-child-menu">
                    <a href="desa-embrio.html">Desa Embrio</a>
                    <i class="icon-next"></i>
                </div>
                <div class="side-child-menu">
                    <a href="desa-berkembang.html">Desa Berkembang</a>
                    <i class="icon-next"></i>
                </div>
                <div class="side-child-menu">
                    <a href="desa-maju.html">Desa Maju</a>
                    <i class="icon-next"></i>
                </div>

            </div>
        -->
        </div>
        </div>
        <div class="menu-item">
            <button class="btn nav-item" type="button" data-toggle="collapse" data-target="#menuTwo" aria-expanded="true" aria-controls="menuTwo">
                <i class="icon-play-button"></i>
                <span>Galeri</span>
              </button>

            <div id="menuTwo" class="collapse child-menu-content" data-parent="#sideMenu">
                <div class="side-child-menu">
                    <a href="#0">
                    <i class="icon-gallery"></i>
                    Foto</a>
                </div>
                <div class="side-child-menu">
                    <a href="#0"><i class="icon-play-button-1"></i>Video</a>
                </div>
                <div class="side-child-menu">
                    <a href="#0"><i class="icon-attach"></i>Semua Media</a>
                </div>
            </div>
        </div>

        <button  class="btn nav-item" javascript="window.location='{{ route('artikel.index') }}'">
                <i class="mdi mdi-newspaper"></i>
                <span>Artikel</span>
        </button>


    <button class="btn nav-item" type="button">
                <i class="icon-map"></i>
                <span>Peta Wisata</span>
              </button>

    <button class="btn nav-item" type="button">
                <i class="icon-chat"></i>
                <span>Chat</span>
              </button>
    <button class="btn nav-item" type="button">
                <i class="icon-viral-marketing"></i>
                <span> Pengguna</span>
              </button>

</nav>
