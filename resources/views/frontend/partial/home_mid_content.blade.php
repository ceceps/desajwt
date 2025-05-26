<section class="home-content mid-content">
    <div class="container">
    <div class="home-title">
      <h3>Informasi yang akan Anda dapatkan</h3>
      <h5>Cari destinasi dan ketertarikan Anda di Desa Wisata Jawa Barat</h5>
    </div>
    </div>
    <div class="full-thumb">

    @if(isset($kategori))
        @foreach($kategori as $kat)
            @php
            $url =  URL::to('/').'/'.config("desawisata.PATH_IMAGE_KATEGORI").$kat->filename;

            $noimage = config("desawisata.PATH_IMAGE_DEFAULT").'noimage.jpg';
            $foto = @getimagesize($url)!=false?$url:$noimage;

            @endphp
            <div class="thumb-item" onclick="location.href='{{ url($kat->url) }}'">
                <div class="top-thumb">
                    <img src="{{ asset($foto) }}" alt="{{ $kat->static_page }}" class="img-fluid">
                    <div class="top-thumb-title">
                        <i class="{{ $kat->icon }}"></i>
                        <h4>{{ $kat->static_page }}</h4>
                    </div>
                </div>
                <div class="bottom-thumb">
                    <div class="box-inline">
                        <p>
                            {!! $kat->note !!}
                        </p>
                        <button type="button" class="btn btn-default" onclick="location.href='{{ url($kat->url) }}'" >
                                <i class="icon icon-placeholder"></i>
                        </button>
                    </div>
                </div>
            </div>

        @endforeach
     @endif
    </div>
  </section>
