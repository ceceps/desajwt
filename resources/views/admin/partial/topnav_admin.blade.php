<div class="header-content">
        <button type="button" class="btn btn-dash side-compact">
        <i class="icon-menu"></i>
        </button>
        <div class="logo">
            <a href="#0" class="header-logo">
            <img src="{{ asset('images/logo.png') }}" alt="jabar logo" class="img-fluid">
            </a>
            <h1>{{ env('APP_NAME','Desa Wisata Jabar') }}</h1>
            @csrf
            <div class="form-group">
                    <form action="{{ route('dashboard') }}" method="GET">
                <input type="text" name="search_text" class="form-control" placeholder="search jawa barat">
                <button type="submit" class="btn btn-default">
                    <i class="mdi mdi-search-web"></i>
                </button>
            </form>
            </div>
        </div>
        <button type="button" class="btn btn-right-dash">
        <i class="icon-speech-bubble"></i>
        </button>


    <nav class="main-navigation">
            <div class="dropdown">
                <button class="btn btn-default" type="button" id="topProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-account"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Edit Profil</a>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"  class="dropdown-item" >
                        Logout
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

    </nav>

  </div>
