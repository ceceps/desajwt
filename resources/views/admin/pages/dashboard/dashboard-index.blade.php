<!doctype html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="teddy dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - nuteddy</title>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="#fff">
    <meta name="application-name">
    <link rel="apple-touch-icon" sizes="57x57" href="images/touch/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/touch/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/touch/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/touch/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/touch/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/touch/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/touch/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/touch/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/touch/apple-touch-icon-180x180.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title">
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="msapplication-TileImage" content="images/touch/mstile-144x144.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/touch/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/touch/favicon-16x16.png">
    <link rel="shortcut icon" href="images/touch/favicon.ico">

    <!--[if (lte IE 8)&!(IEMobile)]> -->
    <!-- <script src="/assets/scripts/html5shiv.min.js"></script>
  <script src="/assets/scripts/respond.min.js"></script>-->
    <!--[endif]-->

    <link href="styles/vendor-min.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
    <link href="styles/devices.css" rel="stylesheet">
    <link href="styles/custom.css" rel="stylesheet">
    <link href="styles/dash-responsive.css" rel="stylesheet">
</head>
<body>
    <div class="dashboard">
        <aside class="dashboard-side">
            <div class="side-profile">
                <div class="side-brand">
                    <a href="#0" class="brand-logo">
                        <img src="images/logo.png" alt="" class="img-fluid">
                    </a>
                    <h2 class="side-top-title">Jawa Barat</h2>
                </div>

                <div class="profile-thumbnail">
                    <img src="images/profile.jpg" alt="profile" class="img-fluid">
                    <button type="button" class="btn btn-circle"><i class="mdi mdi-account-edit"></i></button>
                </div>
                <div class="profile-name">
                    <h4>Hi, Admin name</h4>
                    <div class="button-group">
                        <button type="button" class="btn btn-default">Manage user</button>
                        <button type="button" class="btn btn-default">Edit profile</button>
                    </div>
                </div>
            </div>
            <nav class="dashboard-nav">
                <button class="btn nav-item" type="button">
                    <i class="icon-home-1"></i>
                    <span>Dashboard</span>
                </button>


                <div class="accordion" id="sideMenu">
                    <div class="menu-item">
                        <button class="btn nav-item" type="button" data-toggle="collapse" data-target="#menuFirst"
                            aria-expanded="true" aria-controls="menuFirst">
                            <i class="icon-gps"></i>
                            <span>Desa Wisata</span>
                        </button>

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
                    </div>
                    <div class="menu-item">
                        <button class="btn nav-item" type="button" data-toggle="collapse" data-target="#menuTwo"
                            aria-expanded="true" aria-controls="menuTwo">
                            <i class="icon-play-button"></i>
                            <span>Media</span>
                        </button>

                        <div id="menuTwo" class="collapse child-menu-content" data-parent="#sideMenu">
                            <div class="side-child-menu">
                                <a href="#0">
                                    <i class="icon-gallery"></i>
                                    Photo</a>
                            </div>
                            <div class="side-child-menu">
                                <a href="#0"><i class="icon-play-button-1"></i>Video</a>
                            </div>
                            <div class="side-child-menu">
                                <a href="#0"><i class="icon-attach"></i>Gallery</a>
                            </div>
                        </div>
                    </div>

                </div>



                <button class="btn nav-item" type="button">
                    <i class="icon-map"></i>
                    <span>Peta Wisata</span>
                </button>
                <button class="btn nav-item" type="button">
                    <i class="mdi mdi-newspaper"></i>
                    <span>Berita</span>
                </button>
                <button class="btn nav-item" type="button">
                    <i class="icon-chat"></i>
                    <span>Chat</span>
                </button>
                <button class="btn nav-item" type="button">
                    <i class="icon-viral-marketing"></i>
                    <span>Manajemen Pengguna</span>
                </button>

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
                                    <img src="images/logo.png" alt="jabar logo" class="img-fluid">
                                </a>
                                <h1>Pesona wisata jawa barat</h1>
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
                    <!-- begin top dashboard -->
                    <div class="dashboard-top">
                        <div class="container-fluid">
                            <div class="top-entry">
                                <div class="top-status">
                                    <h3>Dashboard</h3>
                                    <!-- <nav class="dashboard-breadcrumb">
                                        <ul class="list-unstyled">
                                        <li>
                                            <a href="index.html">
                                            <i class="mdi mdi-home"></i>
                                            Dashboard
                                            </a>
                                        </li>
                                        <li>

                                            Page

                                        </li>
                                        </ul>
                                    </nav>-->
                                </div>
                                <div class="top-option">
                                    Today date
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end top dashboard -->
                    <!-- begin dashboard content -->
                    <div class="dashboard-content">

                        <div class="map-panel">
                            <div class="map-content">
                                <div class="map-detail">
                                    <div class="panel-title has-option">
                                        <h3>Desa wisata jawa barat</h3>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary" type="button" id="dropdownMap"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="mdi mdi-menu-down-outline"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="map-media">
                                        <img src="images/map-placeholder.png" alt="sample" class="img-fluid">
                                    </div>

                                </div>
                                <div class="map-stats">

                                    <div class="list-action">
                                        <div class="item-list">
                                            <div class="item-left">
                                                <i class="mdi mdi-account-location"></i>
                                                <div class="item-text">
                                                    <h4>Kota Bandung</h4>
                                                    <p>Kota bandung lokasi wisata</p>
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <span class="numeric">
                                                    123
                                                </span>
                                            </div>
                                        </div>
                                        <div class="list-option">
                                            <a href="#0">Link</a>
                                        </div>
                                    </div>
                                    <div class="list-action">
                                        <div class="item-list">
                                            <div class="item-left">
                                                <i class="mdi mdi-account-location"></i>
                                                <div class="item-text">
                                                    <h4>Kota Bandung</h4>
                                                    <p>Kota bandung lokasi wisata</p>
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <span class="numeric">
                                                    123
                                                </span>
                                            </div>
                                        </div>
                                        <div class="list-option">
                                            <a href="#0">Link</a>
                                        </div>
                                    </div>
                                    <div class="list-action">
                                        <div class="item-list">
                                            <div class="item-left">
                                                <i class="mdi mdi-account-location"></i>
                                                <div class="item-text">
                                                    <h4>Kota Bandung</h4>
                                                    <p>Kota bandung lokasi wisata</p>
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <span class="numeric">
                                                    123
                                                </span>
                                            </div>
                                        </div>
                                        <div class="list-option">
                                            <a href="#0">Link</a>
                                        </div>
                                    </div>
                                    <div class="list-action">
                                        <div class="item-list">
                                            <div class="item-left">
                                                <i class="mdi mdi-account-location"></i>
                                                <div class="item-text">
                                                    <h4>Kota Bandung</h4>
                                                    <p>Kota bandung lokasi wisata</p>
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <span class="numeric">
                                                    123
                                                </span>
                                            </div>
                                        </div>
                                        <div class="list-option">
                                            <a href="#0">Link</a>
                                        </div>
                                    </div>
                                    <div class="list-action">
                                        <div class="item-list">
                                            <div class="item-left">
                                                <i class="mdi mdi-account-location"></i>
                                                <div class="item-text">
                                                    <h4>Kota Bandung</h4>
                                                    <p>Kota bandung lokasi wisata</p>
                                                </div>
                                            </div>
                                            <div class="item-right">
                                                <span class="numeric">
                                                    123
                                                </span>
                                            </div>
                                        </div>
                                        <div class="list-option">
                                            <a href="#0">Link</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="dash-stats">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="panel clean reset">
                                            <div class="panel-title has-option custom">
                                                <h3>Jumlah User Umum</h3>
                                                <button type="button" class="btn btn-clean">Detail</button>
                                            </div>
                                            <div class="chart-content">
                                                <canvas id="canvas" height="220"></canvas>
                                            </div>
                                            <div class="panel-text">
                                                <div class="list-vertical">
                                                    <div class="list-icon">
                                                        <div class="inlined-icon">
                                                            <div class="icon-box">
                                                                <i class="icon-group"></i>
                                                                <span class="numeric">123450000</span>
                                                            </div>
                                                            <span class="badge badge-light">New</span>
                                                        </div>
                                                    </div>
                                                    <div class="list-icon">
                                                        <div class="inlined-icon">
                                                            <div class="icon-box">
                                                                <i class="icon-group"></i>
                                                                <span class="numeric">123450000</span>
                                                            </div>
                                                            <span class="badge badge-light">Current</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="panel clean reset">
                                            <div class="panel-title has-option custom">
                                                <h3>Jumlah User Dinas</h3>
                                                <button type="button" class="btn btn-clean">Detail</button>
                                            </div>
                                            <div class="chart-content">
                                                <canvas id="chartJSContainer" height="220"></canvas>
                                            </div>
                                            <div class="panel-text">
                                                <div class="list-vertical">
                                                    <div class="list-icon">
                                                        <div class="inlined-icon">
                                                            <div class="icon-box">
                                                                <i class="icon-team"></i>
                                                                <span class="numeric">123450000</span>
                                                            </div>
                                                            <span class="badge badge-light">New</span>
                                                        </div>
                                                    </div>
                                                    <div class="list-icon">
                                                        <div class="inlined-icon">
                                                            <div class="icon-box">
                                                                <i class="icon-team"></i>
                                                                <span class="numeric">123450000</span>
                                                            </div>
                                                            <span class="badge badge-light">Current</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="panel clean reset">
                                            <div class="panel-thumbnail">
                                                <img src="images/jabar1.jpg" class="img-fluid" alt="">
                                                <button type="button" class="btn btn-circle"><i class="mdi mdi-lead-pencil"></i></button>
                                            </div>

                                            <div class="panel-text">
                                                <div class="news-title">
                                                    <h3 class="ellipsis ellipsis-2"><a href="#0">Judul berita Lorem
                                                            ipsum dolor sit amet, consectetur adipiscing elit.
                                                            Donec suscipit pretium sem, in efficitur nunc vulputate
                                                            quis. Vestibulum pulvinar vestibulum mauris</a></h3>
                                                    <p class="ellipsis ellipsis-5">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                        Suspendisse tempor urna sed felis pulvinar varius.
                                                        Sed euismod facilisis justo, et interdum nunc dictum quis.
                                                        Etiam vulputate porta purus, sit amet feugiat mi
                                                        dictum a. Nulla aliquet tellus ac ultrices congue. Donec
                                                        egestas ex quis lectus posuere tincidunt. Praesent at
                                                        risus dapibus, pretium nisi et, vehicula orci. Aliquam enim
                                                        arcu, vestibulum non dapibus eu, porta ut mauris.
                                                        Phasellus imperdiet fringilla luctus.
                                                    </p>
                                                    <div class="small-text author-box">
                                                        <div class="left-author">
                                                            <span>
                                                                <i class="icon-calendar"></i>
                                                                25 Oct, 2018
                                                            </span>
                                                            <span>
                                                                <i class="icon-time"></i>
                                                                07:30 PM
                                                            </span>
                                                        </div>
                                                        <div class="right-author">
                                                            <i class="icon-user"></i>
                                                            <a href="#0">By Admin name</a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dash-bottom">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="panel clean reset">
                                            <div class="panel-title has-option custom">
                                                <h3>Media</h3>
                                                <button type="button" class="btn btn-clean">Lihat semua</button>
                                            </div>
                                            <div class="media-list-small">
                                                <div class="media-list-item">
                                                    <div href="#0" class="media-thumb">
                                                        <img src="images/jabar1.jpg" alt="" class="img-fluid img-thumbnail">
                                                        <button type="button" class="btn btn-media" data-toggle="modal"
                                                            data-target="#mediaModal" data-video="https://www.youtube.com/embed/-sZKo_G0RYw">
                                                            <i class="mdi mdi-play-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-highlight">
                                                        <h4>Judul media</h4>
                                                        <p>
                                                            Maecenas sodales mauris egestas augue dignissim, at dapibus
                                                            tortor maximus.
                                                        </p>
                                                    </div>
                                                    <div class="media-action">
                                                        <div class="dropdown">
                                                            <button class="btn btn-clean" type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-menu-down-outline"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-circle-edit-outline"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete-empty"></i>
                                                                    Delete</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-list-item">
                                                    <div href="#0" class="media-thumb">
                                                        <img src="images/sample.jpg" alt="" class="img-fluid img-thumbnail">
                                                        <button type="button" class="btn btn-media" data-toggle="modal"
                                                            data-target="#mediaModal" data-video="https://www.youtube.com/embed/zw39cJdUco0">
                                                            <i class="mdi mdi-play-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-highlight">
                                                        <h4>Judul media</h4>
                                                        <p>
                                                            Maecenas sodales mauris egestas augue dignissim, at dapibus
                                                            tortor maximus.
                                                        </p>
                                                    </div>
                                                    <div class="media-action">
                                                        <div class="dropdown">
                                                            <button class="btn btn-clean" type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-menu-down-outline"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-circle-edit-outline"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete-empty"></i>
                                                                    Delete</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-list-item">
                                                    <div href="#0" class="media-thumb">
                                                        <img src="images/gmf.jpg" alt="" class="img-fluid img-thumbnail">
                                                        <button type="button" class="btn btn-media" data-toggle="modal"
                                                            data-target="#mediaModal" data-video="https://www.youtube.com/embed/NfaXoxmuDag">
                                                            <i class="mdi mdi-play-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-highlight">
                                                        <h4>Judul media</h4>
                                                        <p>
                                                            Maecenas sodales mauris egestas augue dignissim, at dapibus
                                                            tortor maximus.
                                                        </p>
                                                    </div>
                                                    <div class="media-action">
                                                        <div class="dropdown">
                                                            <button class="btn btn-clean" type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-menu-down-outline"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-circle-edit-outline"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete-empty"></i>
                                                                    Delete</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-list-item">
                                                    <div href="#0" class="media-thumb">
                                                        <img src="images/jabar1.jpg" alt="" class="img-fluid img-thumbnail">
                                                        <button type="button" class="btn btn-media" data-toggle="modal"
                                                            data-target="#mediaModal" data-video="https://www.youtube.com/embed/-sZKo_G0RYw">
                                                            <i class="mdi mdi-play-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-highlight">
                                                        <h4>Judul media</h4>
                                                        <p>
                                                            Maecenas sodales mauris egestas augue dignissim, at dapibus
                                                            tortor maximus.
                                                        </p>
                                                    </div>
                                                    <div class="media-action">
                                                        <div class="dropdown">
                                                            <button class="btn btn-clean" type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-menu-down-outline"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-circle-edit-outline"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete-empty"></i>
                                                                    Delete</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-list-item">
                                                    <div href="#0" class="media-thumb">
                                                        <img src="images/sample.jpg" alt="" class="img-fluid img-thumbnail">
                                                        <button type="button" class="btn btn-media" data-toggle="modal"
                                                            data-target="#mediaModal" data-video="https://www.youtube.com/embed/zw39cJdUco0">
                                                            <i class="mdi mdi-play-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="media-highlight">
                                                        <h4>Judul media</h4>
                                                        <p>
                                                            Maecenas sodales mauris egestas augue dignissim, at dapibus
                                                            tortor maximus.
                                                        </p>
                                                    </div>
                                                    <div class="media-action">
                                                        <div class="dropdown">
                                                            <button class="btn btn-clean" type="button" id="dropdownMenuButton"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="mdi mdi-menu-down-outline"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-circle-edit-outline"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-delete-empty"></i>
                                                                    Delete</a>
                                                                <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i>
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <div class="panel clean reset">
                                            <div class="mapouter">
                                                <div class="gmap_canvas">
                                                    <iframe width="600" height="450" id="gmap_canvas" src="https://maps.google.com/maps?q=gedung%20sate&t=&z=19&ie=UTF8&iwloc=&output=embed"
                                                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                </div>
                                                <style>.mapouter{text-align:right;height:288px;width:512px;}.gmap_canvas {overflow:hidden;background:none!important;height:288px;width:512px;}</style>
                                            </div>
                                            <div class="panel-title has-option custom">
                                                <h3>Peta desa</h3>
                                                <button type="button" class="btn btn-clean">Detail</button>
                                            </div>
                                            <div class="panel-text">
                                                <div class="list-vertical">
                                                    <div class="list-icon">
                                                        <div class="inlined-icon">
                                                            <div class="icon-box">
                                                                <i class="icon-group"></i>
                                                                <span class="numeric">123450000</span>
                                                            </div>
                                                            <span class="badge badge-light">New</span>
                                                        </div>
                                                    </div>
                                                    <div class="list-icon">
                                                        <div class="inlined-icon">
                                                            <div class="icon-box">
                                                                <i class="icon-group"></i>
                                                                <span class="numeric">123450000</span>
                                                            </div>
                                                            <span class="badge badge-light">Current</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end dashboard content -->
                </div>
                <footer class="main-footer">
                    <footer class="main-footer">
                        <!--  This is the footer-->
                    </footer>
                </footer>
            </main>
        </div>
    </div>
    <script src="scripts/lib/jquery-3.3.1.js"></script>
    <script src="scripts/base.js"></script>
    <script src="scripts/vendor.js"></script>
    <script src="scripts/app.js"></script>
    <script src="scripts/lib/moment.js"></script>
    <script src="scripts/lib/jquery.slimscroll.js"></script>
    <script src="scripts/lib/select2.full.js"></script>
    <script src="scripts/lib/bootstrap-wysiwyg.min.js"></script>
    <script src="scripts/lib/datatables.js"></script>
    <script src="scripts/lib/dropzone.js"></script>
    <script src="scripts/lib/chart.js"></script>
    <script src="scripts/main.js"></script>
    <script src="scripts/option.js"></script>
    <script src="scripts/lib/main.js"></script>
    <script src="scripts/lib/chart-opt.js"></script>


    <div class="modal fade" id="mediaModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-media" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe width="100%" height="500" src="" frameborder="0" allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>


</body>

</html>
