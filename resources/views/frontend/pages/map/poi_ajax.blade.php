<!DOCTYPE html>
<html>

  <head>
    <link data-require="leaflet@1.0.3" data-semver="1.0.3" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.css" />
    <script data-require="leaflet@1.0.3" data-semver="1.0.3" src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.3/leaflet.js"></script>
    <script data-require="jquery@3.1.1" data-semver="3.1.1" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <style>
    /* Styles go here */

        #mapid { height: 180px; }

        .my-class {
        height:100px;
        width:100px;
        }
    </style>
  </head>

  <body>
    <div id="mapid"></div>
    <script>
        // Code goes here

        var mymap = L.map('mapid').setView([51.505, -0.09], 13);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'mapbox.streets'
        }).addTo(mymap);

        var marker = L.marker([51.5, -0.09]).addTo(mymap);

        marker.bindPopup((layer)=>{
         var el = document.createElement('div');
         el.classList.add("my-class");

        $.getJSON("./data.json",function(data){
          el.innerHTML = '<h2>' + data.text + '</h2>';
        });

         return el;
         });

        </script>
  </body>

</html>
