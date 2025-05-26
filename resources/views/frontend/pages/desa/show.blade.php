@extends('frontend.layouts.layouts_front')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/skin.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/skin.min.css.map">
    <style>
        .flowplayer {
            background-color: #333;
            background-image: url({{ asset($fotovideo) }});
            }
            .flowplayer .fp-color {
            background-color: #a1e1ff;
            }
            .flowplayer .fp-color-play {
            fill: #a1e1ff;
            }
        @font-face {
            font-family: flowplayer;
            src: url(https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/skin/icons/flowplayer.woff);
        }


    </style>
@endsection

@section('content')
@if(isset($desa))
   @if(count($desa->Media)>0)
      @foreach($desa->Media as $mds)
      @php
            $url = URL::to('/').('/storage/data-profildesa/'.$mds->filename);
            $foto = @getimagesize($url)?$url:'images/noimage.jpg';

        @endphp
     @endforeach
    @else
         @php   $foto = 'images/noimage.jpg';  @endphp
    @endif
    @php
        $tgl    =  \DateTime::createFromFormat('Y-m-d H:i:s',$desa->created_at);

        $tglPosting = $tgl->format('d-m-Y H:i:s');
        $profildesa_id = $desa->id;
    @endphp
<div class="detail-page">
    <div class="page-breadcrumb">
        <div class="container">
            <ul class="list-unstyled">
                <li>
                    <a href="index.html">
                        <i class="mdi mdi-home"></i>
                        Beranada / &nbsp;
                    </a>
                </li>
                <li>
                    <a href="{{ url('profildesa') }}">
                        Profil Desa / &nbsp;
                    </a>
                </li>
                <li>

                    {{ $desa->Kelurahan['nama'] }}

                </li>
            </ul>
        </div>
    </div>


    <article class="detail-post">
        <div class="container">
            <div class="post-wrap">

                <div class="post-content">
                    <div class="page-title reset">
                        <div class="page-category">
                            Desa
                        </div>
                        <h1>  {{ $desa->Kelurahan['nama'] }}</h1>
                        <div class="page-info">
                            <div class="small-info clearfix">
                                <p><i class="mdi mdi-calendar"></i> Tgl diposting: {{ $tglPosting }} </p>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="#0">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="mdi mdi-youtube"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#0">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="post-entry">
                        <div class="media-content">
                            <img src="{{ asset($foto) }}" alt="" class="img-fluid">
                        </div>
                        <p>
                           {{ $desa->deskripsi }}
                        </p>
                         <div class="box-event">
                            <div class="event-left">
                                <h3>Lokasi</h3>
                                <i class="mdi mdi-map-marker"></i>
                                <a href="#0">Lokasi Peta</a>
                            </div>
                            <div class="event-right">
                                    <h3>Video</h3>
                                <i class="mdi mdi-book-open-outline"></i>
                                <p>Dokumentasi Video Desa Wisata</p>
                                <a href="#0" data-toggle="modal" data-target="#modelId">Lihat</a>
                            </div>
                        </div>
                    </div>

                    <div class="post-author">
                        <img src="{{ asset($avatar) }}" alt="author" class="img-fluid">
                        <div class="author-post">
                        <h4>{{ __($author) }}</h4>
                        <p>{{ __($authorBio) }}</p>
                        </div>
                      </div>

                    <div class="related-post">
                        <h4>Data Desa yang Lain</h4>
                       <div class="related-media">
                            <div class="related-item">
                                <img src="images/jabar-sample3.jpg" alt="" class="img-fluid">
                                <div class="small-title">
                                    <span>Jumlah Penduduk</span>
                                    <h4><a href="photo-detail.html">Desa Mekarsari</a></h4>
                                </div>
                            </div>
                            <div class="related-item">
                                <img src="images/jabar-sample3.jpg" alt="" class="img-fluid">
                                <div class="small-title">
                                    <span>1 hours ago</span>
                                    <h4><a href="photo-detail.html">Kampung Alamherang</a></h4>
                                </div>
                            </div>
                            <div class="related-item">
                                <img src="images/jabar-sample3.jpg" alt="" class="img-fluid">
                                <div class="small-title">
                                    <span>1 hours ago</span>
                                    <h4><a href="photo-detail.html">West java for desa photo title on december 2018</a></h4>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="detailBox">
                        <div class="titleBox">
                          <label>Komentar</label>
                        </div>
                        <div id="disqus_thread"></div>
                        <script>
                        var disqus_config = function () {
                        this.page.url = '{!! Request::url() !!}';
                        this.page.identifier = '{{ $desa->Kelurahan['nama']  }}';
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
                </div>

                <aside class="side-post">
                    <div class="side-box">
                        <h4>Desa Wisata yang Terkait</h4>
                        @if(isset($desawisata))
                            @foreach ($desawisata as $dsw)
                                @if(count($dsw->Media)>0)
                                    @foreach($dsw->Media as $mda)
                                        @php
                                            $foto = Storage::url('data-desawisata/'.$mda->filename);
                                        @endphp
                                    @endforeach
                                @else
                                    @php
                                        $foto = Storage::url('data-desawisata/'.$mda->filename);
                                    @endphp
                                @endif
                                <a href="{{ route('front.desawisata.show',$dsw->slug) }}" class="side-box-item">
                                        <div class="side-media">
                                            <img src="{{ asset($foto) }}" alt="" class="img-fluid">
                                        </div>
                                        <div class="side-media-text">
                                            <h3>{!! $dsw->nama_desawisata !!}</h3>
                                            <p>{!! substr($dsw->deskripsi,0,35) !!}</p>
                                        </div>
                                    </a>
                            @endforeach
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </article>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="video_file"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endif


@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowplayer/7.2.7/flowplayer.min.js"></script>
    <script>
         // ensure that DOM is ready
         window.onload = function () {
            $('#modelId').on('show.bs.modal', event => {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Use above variables to manipulate the DOM
                flowplayer("#video_file", {
                    ratio: 3/4,
                    splash: true,
                    facebook: "https://www.desawisatajabar.com/",
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
            });

        };
    </script>
@endsection
