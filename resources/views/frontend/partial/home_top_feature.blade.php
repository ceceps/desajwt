<section class="top-feature">
    @if(isset($slider))

    <div class="owl-carousel owl-theme">
        @foreach($slider as $sld)
            @php
                $url = config('desawisata.PATH_IMAGE_SLIDER').$sld->filename;
                $foto = @getimagesize($url)!=false?$url:'images/noimage.jpg';
            @endphp
        <div class="owl-slide d-flex align-items-center cover" style="background-image: url({!! asset($foto) !!});">
            <div class="container">
                <div class="owl-slide-text text-center">
                    <h2 class="owl-slide-animated owl-slide-title">{!! $sld->judul_slider !!}</h2>
                    <div class="owl-slide-animated owl-slide-subtitle mb-3">
                            {!! $sld->subjudul !!}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="top-select">
        <div class="container-fluid">
          <h3>Cari Destinasi di Desa Wisata Jawa Barat</h3>
        <form class="front-location form-custom" method="GET" actions="{{ url('/') }}">
            @csrf
            <div class="right-location">
              <div class="form-group">
                <input type="text" class="form-control front-search" placeholder="Masukkan Tujuan Destinasi atau Info yang Anda inginkan" name="search_text">
                <button type="submit" class="btn btn-default">
                  Cari
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

</section>
