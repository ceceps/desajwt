@extends('frontend.layouts.layouts_front')
@section('content')

 <section class="top-feature inner">
      <img src="{{ asset('storage/slider/slider3.jpg') }}" alt="" class="img-fluid">
      <div class="feat-title">
        <h1>Profil Desa</h1>
        <p>Kunjungi Daerah Asri dan Ramah-tamah</p>
      </div>
    </section>
    <section class="front-inner">
      <div class="container">
      <div class="front-breadcrumb">
          <ul class="list-unstyled">
            <li>
              <a href="index.html">Beranda</a>
            </li>
            <li>
              / Profil Desa
            </li>
          </ul>
        </div>
        <div class="top-description">
         <div class="row">
           <div class="col-xl-12 col-lg-12 col-md-12">
             <p>
               <strong>Jawa Barat</strong> adalah provinsi Indonesia di pulau Jawa, membentang selatan dan timur Jakarta. Bandung, ibukota provinsi, dikenal dengan bangunan art deco yang dirancang Belanda seperti Villa Isola. Perjalanan dari kota ini termasuk gunung Tangkuban Perahu, yang memungkinkan hiking ke bibir kawahnya, dan danau kawah yang dikelilingi hutan Kawah Putih. Kebun Raya Bogor yang terkenal memiliki spesies tanaman tropis
             </p>
           </div>
         </div>
        </div>
      </div>
    </section>
  <section class="place-feat">
      <div class="container">
        <h3 class="medium-title">&nbsp;</h3>
        {{-- <div class="btn-group">
          <button type="button" class="btn btn-default btn-filter active" data-target="all">All</button>
          <button type="button" class="btn btn-default btn-filter" data-target="embrio">Embrio</button>
          <button type="button" class="btn btn-default btn-filter" data-target="berkembang">Berkembang</button>
          <button type="button" class="btn btn-default btn-filter" data-target="maju">Maju</button>
        </div> --}}
        <div class="feat-filter clearfix">
  @if(isset($desa))
                @php $i= 0 @endphp
                @foreach($desa as $k => $data)
                @php
                    $linkShow =  url('/profildesa/'.$data->slug);
                    if(count($data->media))
                       $url = config('desawisata.PATH_IMAGE_PROFILDESA').'thumb/'.$data->media[0]->filename;
                    else
                       $url = 'images/noimage.jpg';

                    $foto = @getimagesize($url)!=false?$url:'images/noimage.jpg';

                @endphp
               <div class="filter-box">
                          <div class="card-place">
                            <img src="{{ asset($foto) }}" alt="jabar" class="img-fluid">
                            <div class="card-place-info">
                              <h4>{{ $data->Kelurahan['nama'] }}</h4>
                              <button type="button" class="btn btn-default btn-sm" onclick="window.location='{{ __($linkShow) }}'">Info Detil</button>
                            </div>
                          </div>
                  </div>
                @php
                    $i++
                @endphp
           @endforeach
      @else
      <p class="text-center">Data Tidak Ditemukan</p>
      @endif
    </div>
    </div>
    </section>
@endsection

