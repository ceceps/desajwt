<aside class="mobile-menu">

    <div class="mobile-side">
      <div class="top-login">
        <button type="button" class="mob-close">
          <i class="icon icon-add"></i>
        </button>
        <div class="top-auth">
          <div class="button-sign">
            <h3>Selamat Datang di Desa Wisata Jawa Barat </h3>
            <div class="button-group">
              <button class="btn btn-outline-light" onclick="window.location='{{ route('login') }}'">
               Login
              </button>
              <button class="btn btn-outline-light" onclick="window.location='{{ route('register') }}'">
                Daftar
              </button>
            </div>
          </div>
         <!-- <div class="mobile-profile-side">
            <div class="mobile-user">
              <h3>hi, Username</h3>
              <button type="button" class="btn btn-default">
                <img src="images/profile.jpg" alt="" class="img-fluid">
              </button>
            </div>
          </div>-->
        </div>

      </div>
      <div class="mobile-nav">
         <!-- <h3>Menu</h3>-->
        <nav class="mobmenu">
          <ul class="list-unstyled">
            <li>
              <a href="index.html">
               <span>
                  <i class="icon icon-home-1"></i>
                  Beranda
               </span>
              </a>
            </li>
            <li>
            <a href="{{ url('/desawisata') }}">
               <span>
                  <i class="icon icon-place"></i>
                    Desa Wisata
               </span>
              </a>
            </li>
            <li>
              <a href="{{ url('/peta_destinasi') }}">
               <span>
                  <i class="icon icon-list"></i>
                    Peta Wisata
               </span>
              </a>
            </li>
            <li>
              <a href="{{ url('/profildesa') }}">
               <span>
                  <i class="icon icon-list"></i>
                    Profil Desa
               </span>
              </a>
            </li>
            <li>
                <a href="{{ url('/artikel') }}">
                 <span>
                    <i class="icon icon-list"></i>
                      Artikel
                 </span>
                </a>
              </li>
            <li>
              <a href="javascript:void(0);" class="media-sub">
              <span>
                  <i class="mdi mdi-camcorder-box"></i>
                Galeri
              </span>
                <i class="icon icon-next"></i>
              </a>
            </li>
            <li>
              <a href="#">
              <span>
                  <i class="icon icon-viral-marketing"></i>
                Tentang Kami
                </span>
              </a>
            </li>

            <li>
            <a href="/">
              <span>
                  <i class="icon icon-search"></i>
                Cari
              </span>
              </a>
            </li>
            <li>
              <a href="submit.html">
              <span>
                  <i class="icon icon-contract"></i>
                Submit location
              </span>

              </a>
            </li>
            <li>
              <a href="about.html">
              <span>
                  <i class="icon icon-ribbon"></i>
                About
              </span>
              </a>
            </li>
          </ul>
        </nav>

        <div class="mob-submenu">
          <nav class="nav-submenu">
            <ul class="list-unstyled">
              <li>
                <button type="button" class="btn btn-clean media-sub">
                  <i class="icon icon-back-1"></i>
                </button>
                Media
              </li>
              <li>
              <a href="{{ url('galeri/foto') }}">
                   <span>
                  <i class="icon icon-camera"></i>
               Foto
              </span>
                </a>
              </li>
              <li>
                <a href="{{ url('galeri/video') }}">
                   <span>
                  <i class="mdi mdi-play-circle"></i>
               Video
              </span>
                </a>
              </li>
              <li>
                <a href="{{ url('galeri') }}">
                   <span>
                  <i class="mdi mdi-file-document-box-outline"></i>
              Semua Media
              </span>
                </a>
              </li>
            </ul>
          </nav>

        </div>

      </div>
      <div class="mobside-bottom text-center">
        Destinasi Pariwisata &copy; 2018
      </div>
    </div>

  </aside>
