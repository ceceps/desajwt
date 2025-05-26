@extends('frontend.layouts.layouts_front')
@if(isset($desawisata))
    @foreach($desawisata as $data)
        @php
            if(count($data['media'])>0){
                foreach($data['media'] as $k => $mda){
                    if($mda['parent_media']==1)
                    $foto = isset($mda['filename'])?'storage/data-desawisata/'.$mda['filename']:'/images/noimage.jpg';
                }
            }else{
                $foto = '/images/noimage.jpg';
            }

            //$jarak_dari_ibukota = $data;
            $sk_provinsi = $data['sk_provinsi'];
            $sk_dinas_kab = $data['sk_dinas_kab'];
            $sk_desa = $data['sk_desa'];
        @endphp

    @endforeach
@endif
@section('style')
   <!-- Flowplayer skin -->
   {{-- <link rel="stylesheet" href="//releases.flowplayer.org/7.2.4/skin/skin.css"> --}}
   <link rel="stylesheet" href="{{ asset('scripts/lib/flowplayer/skin.css') }}">
<style>
        #content {
          max-width: 768px; /* narrower for 4/3 aspect ratio */
        }
        .flowplayer {
          background-color: #333;
          background-image: url({{ asset($foto) }});
        }
        .flowplayer .fp-color {
          background-color: #a1e1ff;
        }
        .flowplayer .fp-color-play {
          fill: #a1e1ff;
        }
        </style>
@endsection
@section('content')
<!-- begin single page front -->

@if(isset($desawisata))
@foreach($desawisata as $data)
<section class="top-feature inner">
    <img src="{{ asset($foto) }}" alt="" class="img-fluid">
</section>

<section class="front-inner">
    <div class="container">
        <div class="front-breadcrumb">
            <ul class="list-unstyled">
                <li>
                    <a href="/">Beranda</a>
                </li>
                <li>
                    <a href="{{ url('/desawisata') }}">/ Desa Wisata</a>
                </li>
                <li>
                    / {{ $data['nama_desawisata'] }}
                </li>
            </ul>
        </div>

        <div class="top-description">
            <div class="feat-title">
                <h1>{{ ucwords(strtolower($data['nama_desawisata'])) }}</h1>
                <p>{{ substr(nl2br($data['narasi']),0,100) }}</p>

            </div>
            <div class="place-detail">
                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <div class="text-justify">{!! nl2br($data['deskripsi']) !!}</div>
                        @if(!empty($filenameVideo) && $filenameVideo!=null && !empty($titleVideo) && $titleVideo!=null )
                            <h3>Video</h3>
                            <div id="long" class="fp-slim fp-outlined no-buffer"></div>
                        @endif
                        <br>
                        <div id="disqus_thread"></div>
                        <script>
                        var disqus_config = function () {
                        this.page.url = '{!! Request::url() !!}';
                        this.page.identifier = '{{ $data->nama_desawisata }}';
                        };

                        (function() { // DON'T EDIT BELOW THIS LINE
                        var d = document, s = d.createElement('script');
                        s.src = 'https://desa-wisata-jabar.disqus.com/embed.js';
                        s.setAttribute('data-timestamp', +new Date());
                        (d.head || d.body).appendChild(s);
                        })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="side-explore">
                            <div class="explore-locate">
                                <div class="circle-stats">
                                    <span>{{ isset($data->akses['jarak_dari_ibukota'])?$data->akses['jarak_dari_ibukota']:'0' }}<em>{{ isset($data->akses['satuan_prov'])?$data->akses['satuan_prov']:'m' }}</em></span>
                                    Dari Provinsi
                                </div>
                            </div>
                            <div class="explore-locate">
                                <div class="circle-stats">
                                    <span>{{ isset($data->akses['jarak_dari_kab'])?$data->akses['jarak_dari_kab']:'0' }}<em>{{ isset($data->akses['satuan_prov'])?$data->akses['satuan_prov']:'m' }}</em></span>
                                    Dari Kabupaten
                                </div>
                            </div>
                            <div class="explore-locate">
                                <div class="circle-stats">
                                    <span>{{ isset($data->akses['jarak_dari_kec'])?$data->akses['jarak_dari_kec']:'0' }}<em>km</em></span>
                                    Dari Kecamatan
                                </div>
                            </div>
                        </div>
                        <div class="side-detail">
                            <h4><span class="circle-icon"><i class="icon-location"></i></span> Profil Desa Wisata</h4>
                            <div class="side-list">
                                <span>Tahun Berdiri</span>
                                <span>{!! $data['tahun_berdiri'] !!}</span>
                            </div>
                            {{-- <div class="side-list">
                                <span>Kategory Desa Wisata</span>
                                <span>{!! $data->Category['catname'] !!}</span>
                            </div> --}}
                            <div class="side-list">
                                <span>Kabupaten/Kota</span>
                                <span>{!! ucwords(strtolower($data->Kelurahan->Kecamatan->Kabupaten['nama'])) !!}</span>
                            </div>

                            <div class="side-list">
                                <span>Kecamatan</span>
                                <span>{!! ucwords(strtolower($data->Kelurahan->Kecamatan['nama'])) !!}</span>
                            </div>

                            <div class="side-list">
                                <span>Kelurahan/Desa</span>
                                <span>{!! ucwords(strtolower($data->Kelurahan['nama'])) !!}</span>
                            </div>
                        </div>
                        <div class="side-detail">
                                <h3>Potensi Wisata</h3>
                            <div class="side-list">
                                @if(count($atraksi))
                                    @foreach ($atraksi as $atr)
                                                           @if(count($atr->Media)>0) @foreach ($atr->Media as $mda) @php $url = Storage::url('data-atraksi/thumb/').$mda->filename;
                                                               $fotoatraksi = @getimagesize($url)!==false?$url:'images/noimage.jpg';
                                                               @endphp
                                                                <div class="card-place">
                                                                   <img src="{{ asset($fotoatraksi) }}" alt="" class="img-fluid">
                                                                   <div class="card-place-info">
                                                                        <a href="#"><h5>{{ $mda->title }}</h5></a>
                                                                       <p>{{ $mda->narasi }}</p>
                                                                       <br>

                                                                   </div>
                                                               </div>
                                                               @endforeach
                                                           @else @php $fotoatraksi = 'images/noimage.jpg'; @endphp
                                                               <div class="card-place">
                                                                   <img src="{{ asset($fotoatraksi) }}" alt="" class="img-fluid">
                                                                   <div class="card-place-info">
                                                                    <a href="#"><h5>{{ $mda->title }}</h5></a>
                                                                       <p>{{ substr($mda->narasi,0,100) }}</p>
                                                                       <br>
                                                                   </div>
                                                               </div>
                                                           @endif
                                    @endforeach
                                @else
                                   <p class="text-center">Data Potensi belum tersedia</p>
                                @endif
                            </div>
                        </div>
                        <div class="side-detail">
                            <h3>Buah Tangan/Oleh-oleh</h3>
                            <div class="side-list">
                                    @if(count($usahapar))
                                      @foreach ($usahapar as $upar)
                                      <div class="card-place">
                                          @if(count($upar->Media)>0)
                                              @foreach($upar->Media as $umda)
                                                  @php
                                                      $url = ($upar->url=='')?Storage::url('data-usahapariwisata/thumb/'.$umda->filename):$upar->url;
                                                      $fotoupar =  @getimagesize($url)!==false?$url:'images/noimage.jpg';
                                                  @endphp
                                                  <img src="{{ asset($fotoupar) }}" class="img-fluid">
                                              @endforeach
                                          @else
                                              @php
                                                  $fotoupar =  'images/noimage.jpg';
                                              @endphp
                                              <img src="{{ asset($fotoupar) }}" class="img-fluid">
                                          @endif
                                          <div class="card-place-info">
                                             <h5>{{ $upar->nama_usaha }}</h5>
                                              <p>{{ substr($upar->note,0,100) }} </p>
                                          </div>
                                      @endforeach
                                      @else
                                        <p class="text-center">Data Oleh-oleh belum tersedia</p>
                                      @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
</section>

@endforeach
@endif

@endsection
@section('script')
<script src="{{ asset('scripts/lib/inner.js') }}"></script>
<!-- Flowplayer library -->
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayer.min.js"></script> --}}
<script src="{{ asset('scripts/lib/flowplayer/flowplayer.min.js') }}"></script>
<!-- The hlsjs plugin (light) for playback of HLS without Flash in modern browsers -->
{{-- <script src="//releases.flowplayer.org/hlsjs/flowplayer.hlsjs.light.min.js"></script> --}}
<script src="{{ asset('scripts/lib/flowplayer/flowplayer.hlsjs.light.min.js') }}"></script>
<!-- the thumbnails plugin -->
{{-- <script src="//releases.flowplayer.org/thumbnails/flowplayer.thumbnails.min.js"></script> --}}
<script src="{{ asset('scripts/lib/flowplayer/flowplayer.thumbnails.min.js') }}"></script>

@if(!empty($filenameVideo) && $filenameVideo!=null && !empty($titleVideo) && $titleVideo!=null )

<script>
        // ensure that DOM is ready
        window.onload = function () {
          flowplayer("#long", {
            ratio: 3/4,
            splash: true,
            facebook: "https://www.konsultablog.com/",
            embed: {
              iframe: "{{ asset($foto) }}"
            },
            hlsQualities: true,
            clip: {
              title: "{{ ucwords(strtolower($titleVideo)) }}",
              sources: [
                { type: "video/mp4",
                  src:  "{!! $filenameVideo !!}" }
              ],
              thumbnails: {
                template: "{{ asset($foto) }}",
                height: 70,
                interval: 10
              }
            }
          });
        };
 </script>
@endif

@endsection
