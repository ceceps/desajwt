@extends('frontend.layouts.layouts_front')
@section('style')
   <!-- Flowplayer skin -->
   <link rel="stylesheet" href="{{ asset('scripts/lib/flowplayer/skin.css') }}">
    <style>
        #content {
          max-width: 768px; /* narrower for 4/3 aspect ratio */
        }
        .flowplayer {
          background-color: #333;
          /* background-image: ""; */
        }
        .flowplayer .fp-color {
          background-color: #a1e1ff;
        }
        .flowplayer .fp-color-play {
          fill: #a1e1ff;
        }
        .video-thumbnail .embed-responsive.media-inner-left, .video-thumbnail .embed-responsive.media-inner-left2 {
            position: relative;
            width: 100%;

        }
        .video-thumbnail .embed-responsive.media-inner-left img{
            max-width:405px;
            max-heigth:228px;
        }
        .video-thumbnail .embed-responsive.media-inner-left .btn.btn-media {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            color: rgba(255, 255, 255, 0.75);
            font-size: 54px;
        }

        .video-thumbnail .embed-responsive.media-inner-left2 img{
            max-width:125px;
            max-heigth:70px;
        }
        .video-thumbnail .embed-responsive.media-inner-left2 .btn.btn-media {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            color: rgba(255, 255, 255, 0.75);
            font-size: 20px;
        }

        .right-thumbnail .thumb-title {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.35);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-align: stretch;
            -ms-flex-align: stretch;
            align-items: stretch;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: 8px;
        }

        .right-thumbnail .thumb-title h3 {
            color: #fff;
            margin: 0;
            font-size: 14px;
        }
        .right-thumbnail .thumb-title a, .right-thumbnail .thumb-title h3{
            color: #fff;
            margin: 0;
            font-size: 14px;
        }
        .right-thumbnail .thumb-title a:hover, .right-thumbnail .thumb-title h3:hover{
            color: #2C8BFF;
        }
        </style>
@endsection
@section('content')
<section class="top-feature for-media">
            <div class="media-top">
                <div class="media-left">
                  @if(isset($fiturVideo))
                  @php $i= 0 @endphp
                   @foreach($fiturVideo as $fv)
                       @if($i==0)
                            <div class="last-video">
                                <div class="video-thumbnail">
                                    <div class="embed-responsive media-inner-left">
                                      <img src="{{ asset('storage/data-video/cover/'.$fv->cover) }}" >
                                       <button type="button" class="btn btn-media" onclick="window.location='{{ route('galeri.video.detil',str_slug($fv->title))  }}'">
                                            <i class="icon-play-button-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="top-video-left">
                                    <div class="title-box">
                                        <h5>Video Terakhir</h5>
                                    <h3><a href="{{ route('galeri.video.detil',str_slug($fv->title))  }}">{{ $fv->title }}</a></h3>
                                    </div>
                                    <p>
                                        {{ str_limit($fv->narasi,170) }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="small-video">
                                <div class="video-thumbnail">
                                    <div class="embed-responsive media-inner-left2">
                                        <img src="{{ asset('storage/data-desawisata/'.$fv->cover) }}">
                                        <button type="button" class="btn btn-media" onclick="window.location='{{ route('galeri.video.detil',str_slug($fv->title))  }}'">
                                          <i class="icon-play-button-2"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="top-video-left">
                                    <p>
                                        {{ str_limit($fv->narasi,58) }}  <a href="{{ route('galeri.video.detil',str_slug($fv->title))  }}">Selanjutnya</a>
                                    </p>
                                </div>
                            </div>
                        @endif
                        @php $i++ @endphp
                    @endforeach
                    @else
                       <p>{{ __('Maaf Data Video belum tersedia') }}</p>
                    @endif
                </div>
                <div class="media-right">
                    <div class="media-top-inner">
                        @if(isset($fiturFoto))
                           @php $j=0 @endphp
                             @foreach ($fiturFoto as $ff)
                                @php
                                    switch($ff->parent_table){
                                        case 'r_desawisata':
                                            $folder = 'storage/data-desawisata';
                                            break;
                                        case 'r_desawisata_atraksi':
                                            $folder = 'storage/data-atraksi';
                                            break;
                                        case 'r_desawisata_fasilitas':
                                            $folder = 'storage/data-fasilitas';
                                            break;
                                        case 'r_desawisata_kelsos':
                                            $folder = 'storage/data-kelsos';
                                            break;
                                        case 'r_desawisata_jenis_usaha':
                                            $folder = 'storage/data-jenis-usaha';
                                            break;
                                        case 'r_artikel':
                                            $folder = 'storage/data-artikel';
                                            break;
                                        case 'r_profildesa':
                                            $folder = 'storage/data-profildesa';
                                            break;
                                    }
                                @endphp
                               @if($j==0)
                                <div class="media-inner-left">
                                    <div class="inner-left-text">
                                        <div class="grid-list">
                                            <div class="inner-title">
                                                <h3><a href="{{ route('galeri.foto.detil',str_slug($ff->title)) }}">{{ $ff->title }}</a></h3>
                                                <p>{{ str_limit($ff->narasi,20) }}</p>
                                            </div>
                                            <a href="#photoSection" class="inner-button goto">
                                                Lihat Semua Foto
                                                <i class="icon-next"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <img src="{{ asset($folder.'/'.$ff->filename) }}" alt="" class="img-fluid">
                                </div>
                                <div class="media-inner-right">
                                        <div class="grid-list">
                                        @elseif($j>0 && $j<5)
                                           <div class="right-thumbnail">
                                                <img src="{{asset($folder.'/'.$ff->filename) }}" alt="{{ $ff->title.' '.str_limit($ff->narasi,200)  }}" class="img-fluid">
                                                <div class="thumb-title">
                                                    <div class="title">
                                                        <h3><a href="{{ route('galeri.foto.detil',str_slug($ff->title)) }}">{{ ucwords($ff->title) }}</a></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                  @php $j++ @endphp
                                  @endforeach
                                  </div>
                                </div>
                        @else
                             <div class="media-inner-right">
                                <p> Data Galeri Foto masih kosong </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

  </section>

  <section class="media-page">
    <div class="container">
      <div class="feat-video">
        <div class="page-title">
          <h3>Video Unggulan</h3>
        <a href="{{ route('galeri.video') }}">Lihat Semua</a>
        </div>
        <div class="feat-box two-media">
        @if(isset($detilVideo))
           @php $i=0 @endphp
            @foreach ($detilVideo as $vid)
                @if ($i<2)
                   <div class="media-box">
                            <div class="card inline">
                                <div class="news-thumb">
                                    <img src="{{ asset('storage/data-video/cover/'.$vid->cover) }}" alt="{!! $vid->title !!}" class="img-fluid">
                                    <div class="thumb-title">
                                        <i class="mdi mdi-play"></i>
                                        <div class="title">
                                            <h3><a href="{{ route('galeri.video.detil',str_slug($vid->title)) }}">{!! $vid->title !!}</a></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @elseif ($i==2)
                  <div class="media-item four-media">
                @elseif ($i>2 && $i<6)
                        <div class="news-item card inline">
                            <div class="news-thumb">
                                <img src="images/sample2.jpg" alt="jabar" class="img-fluid">
                                <div class="thumb-title">
                                    <i class="mdi mdi-play"></i>
                                    <div class="title">
                                        <h3><a href="{{ route('galeri.video.detil',str_slug($vid->title)) }}">{!! $vid->title !!}</a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="news-content">
                                <p>
                                    {!! str_limit($vid->title) !!}
                                </p>
                            </div>
                        </div>
                  @else
                </div>
               </div>
             @endif
            @php $i++ @endphp
            @endforeach
        @endif
      </div>
      <div  id="photoSection" class="feat-photo">
        <div class="page-title">
          <h3>Foto Unggulan </h3>
          <a href="{{ route('galeri.foto') }}">Lihat Semua</a>
        </div>
        @if(isset($detilFoto))
          @php $k=0 @endphp
          <div class="feat-box two-media">
          @foreach ($detilFoto as $fd)
             @php
            switch($fd->parent_table){
                case 'r_desawisata':
                    $folder = 'storage/data-desawisata';
                break;
                case 'r_desawisata_atraksi':
                    $folder = 'storage/data-atraksi';
                break;
                case 'r_desawisata_fasilitas':
                $folder = 'storage/data-fasilitas';
                break;
                case 'r_desawisata_kelsos':
                $folder = 'storage/data-kelsos';
                break;
                case 'r_desawisata_jenis_usaha':
                $folder = 'storage/data-jenis-usaha';
                break;
                case 'r_artikel':
                $folder = 'storage/data-artikel';
                break;
                case 'r_profildesa':
                $folder = 'storage/data-profildesa';
                break;
            }
            @endphp
            @if ($k<2)
                <div class="media-box">
                    <div class="card inline">
                        <div class="news-thumb">
                        <img src="{{ asset($folder.'/'.$fd->filename) }}" alt="jabar" class="img-fluid">
                            <div class="thumb-title">
                            <i class="mdi mdi-image"></i>
                            <div class="title">
                                <h3><a href="{{ route('galeri.foto.detil',str_slug($fd->title)) }}">{{ $fd->title }}</a></h3>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($k==2)
            </div>
            <div class="media-item four-media">
                    <div class="news-item card inline">
                            <div class="news-thumb">
                                <img src="{{ asset($folder.'/'.$fd->filename) }}" alt="jabar" class="img-fluid">
                                <div class="thumb-title">
                                    <i class="mdi mdi-image"></i>
                                    <div class="title">
                                        <h3><a href="{{ route('galeri.foto.detil',str_slug($fd->title)) }}">{{ $fd->title }}</a></h3>
                                    </div>
                                </div>

                            </div>
                        </div>
            @elseif($k>2)
               <div class="news-item card inline">
                    <div class="news-thumb">
                        <img src="{{ asset($folder.'/'.$fd->filename) }}" alt="jabar" class="img-fluid">
                        <div class="thumb-title">
                            <i class="mdi mdi-image"></i>
                            <div class="title">
                                <h3><a href="{{ route('galeri.foto.detil',str_slug($fd->title)) }}">{{ $fd->title }}</a></h3>
                            </div>
                        </div>

                    </div>
                </div>
            @endif

            @php $k++ @endphp
            @endforeach
           </div>
           </div>
        @endif
      </div>
    </div>
  </section>

  @endsection
