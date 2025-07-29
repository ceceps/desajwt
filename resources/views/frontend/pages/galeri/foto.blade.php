@extends('frontend.layouts.layouts_front')
@section('content')
<section class="top-feature has-media">
    <div class="container">
      <div class="page-title">
        <h3>
          Galeri Foto
        </h3>
      </div>
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8">
          <div class="top-slider">
            <div id="topSlider" class="owl-carousel owl-theme">
                    @if(isset($media))
                    @foreach($media as $mda)
                        @switch($mda->parent_table)
                        @case('r_profildesa')
                        @php
                            $kategori = 'Profil Desa';
                            $folder = config('desawisata.PATH_IMAGE_PROFILDESA');
                        @endphp
                        @break
                    @case('r_artikel')
                        @php
                            $kategori = 'Artikel';
                            $folder = config('desawisata.PATH_IMAGE_ARTIKEL');
                        @endphp
                        @break
                    @case('r_desawisata_atraksi')
                        @php
                            $kategori = 'Daya Tarik Wisata';
                            $folder = config('desawisata.PATH_IMAGE_ATRAKSI');
                        @endphp
                        @break
                    @case('r_desawisata_fasilitas')
                        @php
                            $kategori = 'Fasilitas Desa Wisata';
                            $folder = config('desawisata.PATH_IMAGE_FASILITAS');
                        @endphp
                        @break

                    @case('r_desawisata_jenis_usaha')
                        @php
                            $kategori = 'Oleh-oleh';
                            $folder = config('desawisata.PATH_IMAGE_USPAR');
                        @endphp
                        @break
                    @case('r_desawisata_kelsos')
                        @php
                            $kategori = 'Kelompok Sosial';
                            $folder = config('desawisata.PATH_IMAGE_KELSOS');
                        @endphp
                        @break
                    @default
                            @php
                                $folder = config('desawisata.PATH_IMAGE_DESAWISATA');
                            @endphp
                            @break
                        @endswitch
                            @php
                                $url= $folder.$mda->filename;
                                $pathMedia = @getimagesize($url)?$url:'images/noimage.jpg';
                            @endphp
                <div class="item-slider">
                    <div class="card inline">
                    <div class="news-thumb">
                                <img src="{{ asset($pathMedia) }}" alt="{{ strip_tags($latesDesa->narasi) }}" class="img-fluid">
                                <div class="thumb-title">
                                    <div class="title">
                                        <h3><a href="/">{!! $mda->title !!}</a></h3>
                                    </div>
                                </div>
                    </div>
                    </div>
                </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4">
          <div class="side-media">
            <div class="media-small">
              <a href="{{ URL('galeri/photos-detail') }}">
                  @if(isset($latesDesaWisata))
                  @php
                       $fotoDesaWisata = @getimagesize(Config('desawisata.PATH_IMAGE_DESAWISATA').$latesDesaWisata->filename)?Config('desawisata.PATH_IMAGE_DESAWISATA').$latesDesaWisata->filename:'images/noimage.jpg';
                  @endphp
                <img src="{{ asset($fotoDesaWisata) }}" alt="{{ strip_tags($latesDesa->narasi) }}" class="img-fluid">
                <span>
                        {!! $latesDesaWisata->title !!}
                </span>
                @endif
              </a>
            </div>
            <div class="media-small">
              <a href="photos-detail.html">
                    @if(isset($latesDesa))
                    @php
                        $url = Config('desawisata.PATH_IMAGE_PROFILDESA').'thumb/'.$latesDesa->filename;
                        $fotoDesa = @getimagesize($url)?$url:'images/noimage.jpg';
                    @endphp
                  <img src="{{ asset($fotoDesa) }}" alt="{{ strip_tags($latesDesa->narasi) }}" class="img-fluid">
                  <span>
                          {!! $latesDesa->title !!}
                  </span>
                  @endif
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <section class="media-main">
    <div class="container">
      <div class="page-title">
        <h3 class="medium-title">&nbsp;</h3>
        {{-- <div class="btn-group">
          <button type="button" class="btn btn-default btn-filter active" data-target="all">Semua</button>
          <button type="button" class="btn btn-default btn-filter" data-target="new">Terbaru</button>
        </div> --}}
      </div>

      @if(count($mediaAll))
      <div class="feat-filter clearfix">

         @foreach($mediaAll as $mdall)
            @switch($mdall->parent_table)
            @case('r_profildesa')
                @php
                    $kategori = 'Profil Desa';
                    $folder = config('desawisata.PATH_IMAGE_PROFILDESA');
                @endphp
                @break
            @case('r_artikel')
                @php
                    $kategori = 'Artikel';
                    $folder = config('desawisata.PATH_IMAGE_ARTIKEL');
                @endphp
                @break
            @case('r_desawisata_atraksi')
                @php
                    $kategori = 'Daya Tarik Wisata';
                    $folder = config('desawisata.PATH_IMAGE_ATRAKSI');
                @endphp
                @break
            @case('r_desawisata_fasilitas')
                @php
                    $kategori = 'Fasilitas Desa Wisata';
                    $folder = config('desawisata.PATH_IMAGE_FASILITAS');
                @endphp
                @break

            @case('r_desawisata_jenis_usaha')
                @php
                    $kategori = 'Oleh-oleh';
                    $folder = config('desawisata.PATH_IMAGE_USPAR');
                @endphp
                @break
            @case('r_desawisata_kelsos')
                @php
                    $kategori = 'Kelompok Sosial';
                    $folder = config('desawisata.PATH_IMAGE_KELSOS');
                @endphp
                @break
            @default
                @php
                    $kategori = 'Desa Wisata';
                    $folder = config('desawisata.PATH_IMAGE_DESAWISATA');
                @endphp
                @break
            @endswitch

             @php
                 $url= $folder.'thumb/'.$mdall->filename;
                 $pathMedia = file_exists($url)?$url:'images/noimage.jpg';
             @endphp
            <div class="filter-box">
                <div class="card-place">
                <img src="{{ asset($pathMedia) }}" alt="{{ substr($mdall->narasi,0,200) }}" class="img-fluid">
                    <div class="card-place-info">
                    <span>{{ $kategori }}</span>
                    <h4>{{ $mdall->title }}</h4>
                    {{-- <button type="button" class="btn btn-default btn-sm" onclick="location.href='photo-detail.html'">Detail</button> --}}
                    </div>
                </div>
            </div>
         @endforeach

      </div>
      {{ $mediaAll->links() }}
      {{-- <ul class="pagination justify-content-center">
        <li class="page-item disabled">
          <a class="page-link" href="#"><i class="mdi mdi-chevron-left"></i></a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#"><i class="mdi mdi-chevron-right"></i></a>
        </li>
      </ul> --}}
      @endif
    </div>
  </section>

@endsection
@section('script')
    <script src="{{ asset('scripts/lib/owl.carousel.js') }}"></script>
    <script src="{{ asset('scripts/lib/inner.js') }}"></script>
    {{-- <script src="{{ asset('scripts/lib/front.js') }}"></script> --}}

  <script>
    jQuery(function($){

            if($(".owl-carousel").length){
        $(".owl-carousel").on("initialized.owl.carousel", function () {
            setTimeout(function () {
              $(".owl-item.active .owl-slide-animated").addClass("is-transitioned");
              $("section").show();
            }, 500);
          });

          var $owlCarousel = $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            lazyLoad: true,
            dots: false,
            autoplay: true,
            navText: [
              "<i class='icon icon-back'></i>","<i class='icon-next'></i>"] });

          $owlCarousel.on("changed.owl.carousel", function (e) {
            $(".owl-slide-animated").removeClass("is-transitioned");

            var $currentOwlItem = $(".owl-item").eq(e.item.index);
            $currentOwlItem.find(".owl-slide-animated").addClass("is-transitioned");

            var $target = $currentOwlItem.find(".owl-slide-text");
            doDotsCalculations($target);
          });

          $owlCarousel.on("resize.owl.carousel", function () {
            setTimeout(function () {
              setOwlDotsPosition();
            }, 50);
          });


          $owlCarousel.trigger("refresh.owl.carousel");

          setOwlDotsPosition();

          function setOwlDotsPosition() {
            var $target = $(".owl-item.active .owl-slide-text");
            doDotsCalculations($target);
          }

          function doDotsCalculations(el) {
            var height = el.height();var _el$position =
              el.position(),top = _el$position.top,left = _el$position.left;
            var res = height + top + 20;

            $(".owl-carousel .owl-dots").css({
              top: res + "px",
              left: left + "px" });
          }
    }
    });
  </script>
@endsection
