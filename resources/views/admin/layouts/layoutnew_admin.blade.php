@include('admin.partial.header_admin')
<body>
    <div class="dashboard">
        @include('admin.partial.aside')
        <div class="dashboard-entry">
            <main class="main-wrap">
                <header class="main-header">
                    <div class="container-fluid">
                        <div class="header-content">
                            <button type="button" class="btn btn-dash side-compact">
                                <i class="icon-menu"></i>
                            </button>
                            <div class="logo">
                                <a href="#0" class="header-logo">
                                    <img src="{{ asset('images/logo.png') }}" alt="jabar logo" class="img-fluid">
                                </a>
                                <h1>Desa wisata jawa barat</h1>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="search jawa barat">
                                    <button type="submit" class="btn btn-default">
                                        <i class="mdi mdi-search-web"></i>
                                    </button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-right-dash">
                                <i class="icon-speech-bubble"></i>
                            </button>

                            <nav class="main-navigation">
                                <div class="dropdown has-nofif">
                                    <button class="btn btn-default" type="button" id="chatNotif" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-chat"></i>
                                        <span class="small-circle"></span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-default" type="button" id="messageNotif" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-message-outline"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-default" type="button" id="moreAction" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-grid"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>

                                <div class="dropdown">
                                    <button class="btn btn-default" type="button" id="topProfile" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-account"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <!--  <button class="btn btn-top-action">
                                <i class="mdi mdi-grid"></i>
                            </button>

                            <button class="btn btn-top-action">
                                <i class="mdi mdi-power-off"></i>
                            </button>-->

                            </nav>

                        </div>

                    </div>

                </header>
                <div class="main-content">
                    @yield('topbar')
                    @yield('content')
                </div>

                <footer class="main-footer">
                        {{-- <footer class="main-footer">

                        </footer> --}}
                        <p class="text-center"> Copyright &copy; {{ date('Y') }} Disparbud Provinsi Jawa Barat</p>
                 </footer>
            </main>
        </div>
    </div>
    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/all.js')}}"></script> --}}
    <script src="{{ asset('scripts/lib/popper.min.js')}}"></script>
    <script src="{{ asset('scripts/bootstrap.min.js')}}"></script>
    <script src="{{ asset('scripts/lib/select2.full.js')}}"></script>
    <script src="{{ asset('scripts/lib/moment.js')}}"></script>
    <script src="{{ asset('scripts/lib/jquery.slimscroll.js')}}"></script>
    {{-- <script src="{{ asset('scripts/lib/bootstrap-wysiwyg.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('scripts/lib/datatables.js')}}"></script> --}}
    <script src="{{ asset('scripts/lib/dropzone.js')}}"></script>

    {{-- <script src="{{ asset('scripts/main.js')}}"></script> --}}
    <script src="{{ asset('scripts/option.js')}}"></script>
    <script src="{{ asset('scripts/lib/main.js')}}"></script>

    @yield('script')
    <script src="{{ asset('js/desawisata.js')}}"></script>
</body>
</html>
