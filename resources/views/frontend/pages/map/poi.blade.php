@extends('frontend.layouts.layouts_front')
@section('content')


<!-- reference to Leaflet CSS -->
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />

<!-- reference to Leaflet JavaScript -->
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>

<!-- set width and height styles for map -->
<style>
#map {
    width: 960px;
    height:500px;
}
</style>



    <!-- place holder for map -->
    <div id="map"></div>

<script>

    // create map object, tell it to live in 'map' div and give initial latitude, longitude, zoom values
    // pass option to turn scroll wheel zoom off
    // var map = L.map('map',{scrollWheelZoom:false}).setView([43.64701, -79.39425], 15);
    var map = L.map('map',{scrollWheelZoom:false}).setView([-6.8337017,108.4387053], 15);

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
