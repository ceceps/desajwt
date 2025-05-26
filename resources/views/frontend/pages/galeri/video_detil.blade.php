<!doctype html>

<html>

<head>
   <meta charset="utf-8">

   <title>Flowplayer overlay plugin - Bootstrap · Standalone demo · Flowplayer</title>

   <!-- optimize mobile versions -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- The Flowplayer skin -->
   <link rel="stylesheet" href="https://releases.flowplayer.org/7.2.7/skin/skin.css">

   <!-- Minimal styling for this standalone page (can be removed) -->
   <style>body {
      font-family: "myriad pro", tahoma, verdana, arial, sans-serif;
      font-size: 14px;
      margin: 0;
      padding: 0;
   }
   #content {
      margin: 50px auto;
      max-width: 982px;
   }

</style>

      <!-- Flowplayer depends on jquery for video tag based setups -->
  <!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <!-- hls.js -->
   <script src="https://cdn.jsdelivr.net/npm/hls.js@0.11.0/dist/hls.light.min.js"></script>

   <!-- Flowplayer-->
   <script src="https://releases.flowplayer.org/7.2.7/flowplayer.min.js"></script>

<!-- bootstrap modal vendor stylesheet -->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">

<!-- bootstrap modal vendor script -->

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
<!-- the overlay plugin -->
<script src="https://releases.flowplayer.org/overlay/flowplayer.overlay.min.js"></script>
<!-- the bootstrap vendor overlay wrapper -->
<script src="https://releases.flowplayer.org/overlay/vendors/flowplayer.overlay.bootstrap.js"></script>
</head>

<body>
<div id="content">
<p><button id="modal-trigger" class="btn btn-primary">Show video in bootstrap modal</button></p>

<div id="fp-modal"></div>
@if(!empty($video))
  @php
     $folder='/storage/data-video/';
     $url= $folder.$video->filename;
     $title = isset($video->title)?$video->title:'Detil Video';
  @endphp
@endif
<script>
flowplayer("#fp-modal", {
    ratio: 9/16,

    // overlay plugin using bootstrap modal vendor
    overlay: {
        trigger: "#modal-trigger",
        vendor: "bootstrap",
        title: "{{ $title }}",
        size: "lg"
    },

    clip: {
        sources: [

            { type: "video/mp4",
              src:  "{{ $url }}" }
        ]
    }
});
</script>

</div><!--/end content -->
</body>

</html>
