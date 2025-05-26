 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
   integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
   crossorigin=""></script>
   {{-- <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise"></script> --}}
   {{-- <script src="{{ asset('scripts/lib/leaflet-bing-layer.min.js') }}"></script> --}}
   <style>
     #mapid { height: 780px; z-index: 0; }
   </style>
<section class="home-content place-content">
    <div class="container">
      <div class="home-title">
        <h3>Cari Desa Wisata</h3>
      </div>
    </div>
    <div class="mapping">
        {{-- <div class="map-content map" id="map">
        </div> --}}
      <div class="map-content" id="mapid"></div>
      <div class="map-text">
        <div class="map-text-info">
          <h3>Desa Wisata Jawa Barat</h3>
          <ul class="list-unstyled">
            @if(isset($desa_wisata))
               @foreach($desa_wisata as $dsw)
                 <li>
                    <span class="numbering"> <i class="icon icon-location"></i></span>
                    <p>{{ $dsw->nama_desawisata }}</p>
                 </li>
                @endforeach
            @endif
          </ul>
          <button type="button" class="btn btn-outline" onclick="location.href='{{ url('peta_destinasi') }}'">
            Lihat Semua
          </button>
        </div>
      </div>
    </div>
</section>
@section('script')
  <script>
        // var mymap = L.map('mapid').setView([-6.9032739,107.5731165], 13);
        var mymap = L.map('mapid',{scrollWheelZoom:false}).setView([-6.8337017,108.4387053], 8);
           mapLink ='<a href="http://openstreetmap.org">OpenStreetMap</a>';
            L.tileLayer(
            // 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
            {
            attribution: 'Map data &copy; ' + mapLink
            }).addTo(mymap);

        var desawisata = [
           ["Desa Wisata Cibuntu",-6.8337017,108.4387053,"<br>Desa Wisata yang telah mendapatkan penghargaan UNESCO"],
           ["Desa Wisata Malasari",-6.679577,106.5189873,"<br>Wisata Motorcross"],
           ["Desa Wisata Mekarsari",-6.4152867,106.9826664,"<br>Desa Wisata Buah Mekarsari menawarkan wisata buah petik sendiri"],
           ["Desa Wisata Alam Endah",-7.1255909,107.4176437,"<br>Wisata Pemandian Air Panas Alami"],
           ["Desa Wisata Sakerta Timur",-7.0361346,108.4072541,"<br>Wisata Penginapan Alami"]
        ];

        for (var i = 0; i < desawisata.length; i++) {
           marker = new L.marker([desawisata[i][1],desawisata[i][2]])
            .bindPopup("<b>"+desawisata[i][0]+"</b>"+desawisata[i][3])
            .addTo(mymap);
        }
  </script>
@endsection
