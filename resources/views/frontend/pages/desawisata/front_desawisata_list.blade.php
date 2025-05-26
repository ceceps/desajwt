@extends('frontend.layouts.layouts_front')
@section('content')
    <section class="top-feature inner">
      <img src="{{ asset('images/desa-sample.jpg') }}" alt="Jelajahi Desa Wisata Jawa Barat, Database Desa Wisata Jawa Barat" class="img-fluid">
      <div class="feat-title">
        <h1>Jelajahi Desa Wisata Jawa Barat</h1>
        <p>Nikmati keindahan Alam dan keramahan penduduk sekitar yang menjaga kearifan lokal</p>
      </div>
    </section>
    <section class="front-inner">
      <div class="container">
      {{-- <div class="front-breadcrumb">
          <ul class="list-unstyled">
            <li>
              <a href="/">Beranda</a>
            </li>
            <li>
              / Desa Wisata
            </li>
          </ul>
        </div> --}}

        <div class="top-description">
         <div class="row">
           <div class="col-xl-12 col-lg-12 col-md-12">
             <p>
                    Masyarakat Jawa Barat memiliki komitmen yang kuat terhadap nilai-nilai kebajikan. Hal ini terekspresikan pada pepatah “Ulah Unggut Kalinduan, Ulah gedag Kaanginan”; yang berarti konsisten dan konsekuen terhadap kebenaran serta menyerasikan antara hati nurani dan rasionalitas, seperti terkandung dalam pepatah “Sing Katepi ku Ati Sing Kahontal ku Akal”, yang berarti sebelum bertindak tetapkan dulu dalam hati dan pikiran secara seksama.
             </p>
           </div>

         </div>
        </div>
      </div>
    </section>
    <section class="place-feat">
      <div class="container">
        <h3 class="medium-title">&nbsp;</h3>

        @if(isset($desawisata))
        <div class="feat-filter clearfix">
                @foreach($desawisata as $data)
                @php
                    $linkShow =  route('front.desawisata.show',['id'=>$data['slug']]);
                    $catname = $data->Category['catname'];
                    $tglModif = new DateTime($data['tgl_modif']);
                    $update = $tglModif->format('d-m-Y H:i:s');

                    if(count($data->Media)>0){
                        foreach ($data->Media as $key => $mds) {
                            if($mds['parent_media']==1){
                                $url =Storage::url('data-desawisata/thumb/').$mds['filename'];
                                $foto = @getimagesize($url)!==false?$url:'images/noimage.jpg';
                            }
                        }
                    }else{
                        $foto = 'images/noimage.jpg';
                    }
                @endphp
                <div data-status="{{ strtolower($data['idcat'])  }}" class="filter-box">
                          <div class="card-place">
                            <img src="{{ asset($foto) }}" alt="jabar" class="img-fluid">
                            <div class="card-place-info">
                              <span>{{ ucwords($data->Kelurahan['nama'])  }}</span>
                              <h4>{{ $data['nama_desawisata'] }}</h4>
                              <button type="button" class="btn btn-default btn-sm" onclick="location.href='{{ $linkShow }}'">Info Detil</button>
                            </div>
                          </div>
                  </div>
                @endforeach

        </div>
          {{ $desawisata->links() }}
        @else
            <div class="feat-filter clearfix">
                    <p class="text-center">Data Tidak Ditemukan</p>
            </div>
        @endif
      </div>
    </section>
@endsection
@section('script')
<script src="{{ asset('scripts/lib/inner.js') }}"></script>
@endsection
