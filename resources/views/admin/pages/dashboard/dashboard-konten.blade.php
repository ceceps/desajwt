@extends('admin.layouts.layout_admin')

@section('style')
<link rel="stylesheet" href="{{ asset('styles/jqvmap.min.css')}}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
crossorigin=""/>

@endsection

@section('topbar')
    <!-- begin top dashboard -->
    <div class="dashboard-top">
        <div class="container-fluid">
         <div class="top-entry">
          <div class="top-status">
            <h3>Dashboard</h3>
          </div>
           <div class="top-option">
             {{ date('d-m-Y H:i:s') }}
           </div>
         </div>
        </div>
    </div>
    <!-- end top dashboard -->
@endsection

@section('content')
<!-- begin dashboard content -->
<div class="dashboard-content">
        <div class="map-panel">
           <div class="map-content">
            <div class="map-detail">
              <div class="panel-title has-option">
                <h3>Peta Kabupaten & Kota di Jawa Barat</h3>
                <div class="dropdown">
                  <button class="btn btn-secondary" type="button" id="dropdownMap" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                    <i class="mdi mdi-menu-down-outline"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ route('desawisata.index') }}">Lihat Semua Data</a>
                    {{-- <a class="dropdown-item" href="#">Another action</a> --}}
                    {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
                  </div>
                </div>
              </div>
              <div class="map-media" style="width:100%: heigth:100%">
               {{-- <div class="vector-map"> --}}
                    <div id="jabar"  style="min-width: 368px; height: 405px" class="svg-content"></div>
                 {{-- </div> --}}
              </div>
            </div>
            <div class="map-stats">
              <!-- Loop Kab/Kota Jawa Barat -->
                <div id="mapstat">
                @if(isset($jumDesaWisata))
                    @foreach($jumDesaWisata as $jumdsw)
                        @php
                            $len = strlen($jumdsw->nama);
                            if($len>14){
                                $nama = substr($jumdsw->nama,0,14).'...';
                            }else
                                $nama = $jumdsw->nama;
                        @endphp
                        <div class="list-action">
                                <a href="{!! url('backend/desawisata/?kabupaten='.$jumdsw->id) !!}" data-kodepeta="{!! $jumdsw->kode_peta !!}">
                            <div class="item-list">
                                <div class="item-left">
                                <i class="mdi mdi-account-location"></i>
                                <div class="item-text">
                                    <h4 style="color:#0a0a0a">{!! $nama !!}</h4>
                                    <p>Desa Wisata</p>
                                </div>
                                </div>
                                <div class="item-right">
                                <span class="numeric">
                                        {!! $jumdsw->jumdes !!}
                                </span>
                                </div>
                            </div>
                            <div class="list-option">
                           Link
                            </div>
                        </a>
                        </div>
                    @endforeach
                @endif
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
                    @if(isset($artikel))
                    @foreach($artikel as $artkl)
                        <div class="panel-thumbnail">
                        <img src="{{ asset($urlFile) }}" class="img-fluid" alt="">
                        <button type="button" class="btn btn-circle" onclick="window.location='{{ url('backend/artikel/'.$artkl->id.'/edit') }}'"><i class="mdi mdi-lead-pencil"></i></button>
                        </div>
                        <div class="panel-text">
                        <div class="news-title">
                                <h3 class="ellipsis ellipsis-2"><a href="{{ url('artikel/'.$artkl->slug) }}" target="blank">{{ str_limit($artkl->judul,100) }}</a></h3>
                                <p class="ellipsis ellipsis-5">
                                    {!! str_limit($artkl->konten,120) !!}
                                </p>
                                <div class="small-text author-box">
                                    <div class="left-author">
                                        <span>
                                        <i class="icon-calendar"></i>
                                        {{  \Carbon\Carbon::parse($artkl->created_at)->format('d-m-Y') }}
                                        </span>
                                        <span>
                                        <i class="icon-time"></i>
                                        {{  \Carbon\Carbon::parse($artkl->created_at)->format('h:i:s') }}
                                        </span>
                                    </div>
                                    <div class="right-author">
                                        <i class="icon-user"></i>
                                        <a href="#0">Oleh {{ __($artkl->User['name']) }}</a>
                                    </div>
                                </div>
                        </div>
                        </div>
                    @endforeach
                 @endif
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
                 <a href="" class="btn btn-clean">Lihat semua</a>
                 </div>
                 <div class="media-list-small">
                    @if(isset($media))
                    @foreach($media as $mda)
                        @switch($mda->parent_table)
                        @case('r_profildesa')
                             @php
                                $folder = config('desawisata.PATH_IMAGE_PROFILDESA');

                            @endphp
                            @break
                        @case('r_artikel')
                            @php
                                $folder = config('desawisata.PATH_IMAGE_ARTIKEL');
                            @endphp
                            @break
                        @case('r_desawisata_atraksi')
                            @php
                                $folder = config('desawisata.PATH_IMAGE_ATRAKSI');
                            @endphp
                            @break
                        @default
                            @php
                                $folder = config('desawisata.PATH_IMAGE_DESAWISATA');
                            @endphp
                            @break
                        @endswitch
                            @php
                                $url= $folder.'thumb/'.$mda->filename;
                                $pathMedia = file_exists($url)?$url:'images/noimage.jpg';


                            @endphp
                   <div class="media-list-item">
                     <div href="#0" class="media-thumb">
                        @if(strtolower($mda->extensi) =='jpg' || $mda->extensi =='png' || $mda->extensi =='jpeg' || $mda->extensi =='gif')
                            <img src="{{ asset($pathMedia) }}" alt="" class="img-fluid img-thumbnail">
                        @elseif($mda->extensi =='mp4' || $mda->extensi =='flv')
                            <div class="btn btn-media" data-toggle="modal" data-target="#mediaModal" data-video="https://www.youtube.com/embed/-sZKo_G0RYw">
                                <i class="mdi mdi-play-circle"></i>
                            </div>
                        @else
                           <img src="{{ asset('images/noimage.jpg') }}" alt="" class="img-fluid img-thumbnail">
                       @endif
                     </div>
                     <div class="media-highlight">
                     <h4>{{ $mda->title }}</h4>
                       <p>
                        @php
                            // substr per kata
                            $strip = strip_tags($mda->narasi);
                            $sbtr =  preg_split("/[\s,]+/",$strip);
                            $sbtr = array_chunk($sbtr,9); //jml kata
                            $sbtr = array_merge($sbtr[0]);
                            $sbtr = implode(' ',$sbtr);
                            echo($sbtr);
                        @endphp
                       </p>
                     </div>

                     <div class="media-action"><!--

                       <div class="dropdown">
                         <button class="btn btn-clean" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="mdi mdi-menu-down-outline"></i>
                         </button>

                         <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                           <a class="dropdown-item" href="#"><i class="mdi mdi-circle-edit-outline"></i> Edit</a>
                           <a class="dropdown-item" href="#"><i class="mdi mdi-delete-empty"></i> Delete</a>
                           <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i> Detail</a>
                         </div>

                       </div>
                         -->
                     </div>

                   </div>
                    @endforeach
                    @endif
                 </div>
               </div>
             </div>
             <div class="col-lg-6 col-md-6 col-xs-12">
              <div class="panel clean reset">
                <div class="mapouter">
                  <div class="gmap_canvas">
                      <div id="map"></div>
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
@endsection

@section('script')
    @include('admin.partial.script_dash')
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>
    <script>
    var editArtikel = function(id){
        window.location = 'backend/artikel/edit/'+id;
    }

    //map
    var map = L.map('map',{scrollWheelZoom:false}).setView([-6.8337017,108.4387053], 10);

    // add base map tiles from OpenStreetMap and attribution info to 'map' div
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var desawisata = [
           ["Desa Wisata Cibuntu",-6.8337017,108.4387053,"<br>Desa Wisata yang telah mendapatkan penghargaan UNESCO"],
           ["Desa Wisata Malasari",-6.679577,106.5189873,"<br>Wisata Motorcross"],
           ["Desa Wisata Mekarsari",-6.4152867,106.9826664,"<br>Desa Wisata Buah Mekarsari menawarkan wisata buah petik sendiri"],
           ["Desa Wisata Alam Endah",-7.1255909,107.4176437,"<br>Wisata Pemandian Air Panas Alami"],
           ["Desa Wisata Sakerta Timur",-7.0361346,108.4072541,"<br>Wisata Penginapan Alami"]
        ];
        //var marker = L.marker([],[]).addTo(mymap);
        //marker.bindPopup("<b>Desa Wisata Cibuntu </b><br>Desa Wisata yang telah mendapatkan penghargaan UNESCO").openPopup();
        //bing map token AvDDfNiFpbN719tgH5ZdyL8amz-huWVB527vOlHZ811tmCTVlDK6moToOqjlF1Ic

        for (var i = 0; i < desawisata.length; i++) {
        marker = new L.marker([desawisata[i][1],desawisata[i][2]])
            .bindPopup("<b>"+desawisata[i][0]+"</b>"+desawisata[i][3])
            .addTo(map);
        }
    </script>
@endsection
