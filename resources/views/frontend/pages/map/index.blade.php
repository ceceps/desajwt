@extends('frontend.layouts.layouts_front')
@section('content')
<!-- reference to Leaflet CSS -->
{{-- <link rel="stylesheet" href="https://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />

<!-- reference to Leaflet JavaScript -->
<script src="https://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script> --}}

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>

<style>
#map {
    min-width: 1000px;
    min-height:760px;
    z-index: 0;
}

.info_details {
    margin: 0px;
    padding: 0px;
    width: 400px;
    height: 266px;
    max-width: 480px;
    margin-top: -327px;
    position: absolute;
    background: #ffffff;
    box-shadow: 3px 5px 13px 0px rgba(29, 29, 29, 0.05);
    margin-left: -90px;
    border-radius: 3px;
    border-bottom: 3px solid #8593a9;
}
#infocloser {
    position: absolute;
    top: 0px;
    right: 0px;
    width: 16px;
    height: 16px;
    background-color: #ffffff;
    z-index: 999999;
    background-image: url(./images/closeicon.png);
    cursor: pointer;
    border-top-right-radius: 4px;
}
.prop_pricex {
    font-size: 14px!important;
    position: absolute;
    bottom: 0px;
    left: 14px;
    height: 35px;
    border-top: 1px solid #eef3f6;
    color: #f1bf7f;
    width: 370px;
    padding-top: 6px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    line-height: 22px;
}

.prop_detailsx {
    width: 100%;
    float: left;
    display: inline;
    font-size: 14px!important;
    color: #8593a9;
    padding: 0px 0px 0px 14px;
    text-transform: lowercase;
    background-color: #fff;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    /* margin-top: 11px; */
    margin-top: 0px;
}

#infobox_title {
    font-size: 16px;
    color: #3a4659;
    padding: 0px 0px 0px 13px;
    margin-top: 15px;
    margin-bottom: 5px;
    float: left;
    font-weight: 600;
}

.info_details img {
    max-width: 100%;
    width: 100%;
    height: auto;
    max-height: 161px;
    float: left;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
}

</style>
<!--
<div class="info_details  classic_info "><span id="infocloser" onclick="javascript:infoBox.close();"></span><a href="https://www.propertyindonesia.co.id/properti/087722610091-ruko-dijual-2-unit-dekat-terminal-cicaheum/"><img width="400" height="161" src="https://www.propertyindonesia.co.id/wp-content/uploads/2019/04/RUKO1-400x161.jpg" class="attachment-property_map1 size-property_map1 wp-post-image" alt=""></a><a href="https://www.propertyindonesia.co.id/properti/087722610091-ruko-dijual-2-unit-dekat-terminal-cicaheum/" id="infobox_title">087722610091, Ruko Dijual 2 Unit dekat Termin...</a><div class="prop_detailsx">Ruko di Jual</div><div class="prop_pricex"><span id="infosize">80 m<sup>2</sup></span><span id="infobath">2</span></div></div>
-->
        <section class="map-jabar">
                <div class="mapping">
                  <div class="map-content map-googleembed" >
                    <div id="map"></div>
                  </div>
                  <button type="button" class="btn btn-box">
                    <i class="mdi mdi-menu"></i>
                  </button>
                  <div class="map-text">
                    <button type="button" class="btn btn-close-map">
                      <i class="mdi mdi-close"></i>
                    </button>
                    <div class="side-map-title">
                      <h4>Peta Destinasi Desa Wisata Jawa Barat</h4>
                    </div>
                    <div class="side-map-search">
                      <input type="text" class="form-control" placeholder="Nama Desa Wisata">
                      <button type="button" class="btn btn-default">Cari</button>
                    </div>
                     <div class="map-inner scroll-map">
                        @if(count($desawisata))
                            @foreach($desawisata as $dsw)
                                <ul class="list-unstyled">
                                <li>
                                    <i class="mdi mdi-map-marker"></i>
                                    {!! $dsw->nama_desawisata !!}
                                </li>
                                </ul>
                            @endforeach
                        @endif
                        <br>
                        <br>
                        <br>
                        <small>*) Data Desa Wisata yang ditampilkan yang telah memiliki koordinat peta saja</small>
                     </div>
                  </div>
                </div>
              </section>


@endsection
@section('script')
<script>
    /* Map functions */

    var map = L.map('map',{scrollWheelZoom:false}).setView([-6.8337017,108.4387053], 8);

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

