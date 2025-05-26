<script src="{{ asset('scripts/lib/chart.js') }}"></script>
<script src="{{ asset('scripts/lib/chart-opt.js') }}"></script>
<script src="{{ asset('scripts/lib/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('scripts/lib/jquery.vmap.jawabarat.js') }}"></script>


<script>
  $(document).ready(function(){
//dashboard peta vector jabar
if ($('#jabar').length) {
     $('#jabar').vectorMap({
         map: 'kabkot_jawabarat',
         enableZoom: false,
         showTooltip: true,
         selectedColor: '#378ec8',
         onRegionClick: function (event, code, region) {
             event.preventDefault();
             $.get('/backend/desawisata/getkab/'+code,function(resp){
                window.location = '/backend/desawisata?kabupaten='+resp.id;
             });
            //  console.log(code + ' ' + region);
             //console.log(code);
         },
         backgroundColor: '#ffffff',
         borderColor: 'black',
         borderOpacity: 0.25,
         borderWidth: 1,
         //   '#c9dfaf',
         hoverColor: '#ffc507',
         hoverOpacity: null,
         normalizeFunction: 'linear',
         //   scaleColors: ['#b6d6ff', '#005ace'],`
         selectedColor: '#c9dfaf'

     });

     //color map
     //kab bogor
     $('#jqvmap1_01').attr('fill', '#c8b7b7');
     //kab sukabumi
     $('#jqvmap1_02').attr('fill', '#ffd5d5');
     //kab cianjur
     $('#jqvmap1_03').attr('fill', '#ffe680');
     //kab bandung
     $('#jqvmap1_04').attr('fill', '#c6e9af');
     //kab garut
     $('#jqvmap1_05').attr('fill', '#5fbcd3');
     //kab tasikmalaya
     $('#jqvmap1_06').attr('fill', '#ddafe9');
     //kab ciamis
     $('#jqvmap1_07').attr('fill', '#ff55dd');
     //kab kuningan
     $('#jqvmap1_08').attr('fill', '#93ac9d');
     //kab cirebon
     $('#jqvmap1_09').attr('fill', '#5599ff');


     //majalengka
     $('#jqvmap1_10').attr('fill', '#87decd');
     //kab sumedang
     $('#jqvmap1_11').attr('fill', '#d4ff2a');
     //kab indramayu
     $('#jqvmap1_12').attr('fill', '#80ff80');
     //kab subang
     $('#jqvmap1_13').attr('fill', '#bcd35f');

     //kabr purwakarta
     $('#jqvmap1_14').attr('fill', '#aaffaa');
     //karawang
     $('#jqvmap1_15').attr('fill', '#ffb380');
     //kab bekasi
     $('#jqvmap1_16').attr('fill', '#ffaaaa');
     //kab bandung barat
     $('#jqvmap1_17').attr('fill', '#71c837');
     //kab pangandaran
     $('#jqvmap1_18').attr('fill', '#ff80b2');

     $('#jqvmap1_19').attr('fill', 'red');

     //kota bogor
     $('#jqvmap1_71').attr('fill', '#b3ff80');
     //kota sukabumi
     $('#jqvmap1_72').attr('fill', '#71c837');
     //kota bandung
     $('#jqvmap1_73').attr('fill', '#00ffff');
     //kota cirebon
     $('#jqvmap1_74').attr('fill', '#ff00ff');

     //kota bekasi
     $('#jqvmap1_75').attr('fill', '#ffccaa');
     //depok
     $('#jqvmap1_76').attr('fill', '#2ad4ff');
     //kota cimahi
     $('#jqvmap1_77').attr('fill', '#ddafe9');
     //kota tasik
     $('#jqvmap1_78').attr('fill', '#ff7f2a');
     //kota banjar
     $('#jqvmap1_79').attr('fill', '#37c871');

     //waduk cirata
     $('#jqvmap1_88').attr('fill', '#ffe680');
 }

    $('#mapstat').slimScroll({
        height: '450px',
    });
});
</script>
