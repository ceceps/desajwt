@extends('frontend.layouts.layouts_front')
@section('content')
<section class="top-inner">
    <div class="top-inner-info">
      <div class="top-inner-title">
          <h1>Artikel Desa Wisata</h1>
      </div>
    </div>
    <img src="{{ asset('storage/kat-page/news.jpg')}}" alt="" class="img-fluid">
  </section>
  <div class="mid-content">
        <div class="news-middle">
          <div class="container">
            <div class="sub-news">
             <div class="sub-left">
               <h3>Artikel dalam Satu tempat</h3>
               <p>
                 Satu tempat posting artikel dan info tentang Desa Wisata Jawa Barat. Informasi secara reguler akan diupdate setiap saat, demi meningkatkan kualitas pelayanan pariwisata di Desa Wisata Jawa Barat
               </p>
             </div>
              {{-- <div class="sub-right">
                <button type="button" class="btn btn-default">Submit Your News</button>
              </div> --}}
            </div>
      @if(!empty($artikel))
                @php $artks = []; @endphp
                @foreach($artikel as $artk)
                  @php
                    if(count($artk->media)){
                        $url = URL::to('/storage/data-artikel/thumb/'.htmlspecialchars($artk->media[0]['filename']));
                    }else $url ='';
                    $media = @getimagesize($url)>0?$url:'images/noimage.jpg';
                    //echo($media.' '.$artk->media[0]['filename']).'<br> ';
                    $artks[] = ['id'=>$artk->id,
                                'judul'=>$artk->judul,
                                'slug'=>$artk->slug,
                                'konten'=>$artk->konten,
                                'author'=>$artk->user['nama'],
                                'kategori'=> $artk->kategori_artikel['nama'],
                                'media'=>$media
                            ];
                  @endphp
                @endforeach

               @php  $part = array_chunk($artks,3); @endphp


            @php $count=count($part[0]); @endphp
                <div class="box-two-third">
                @for($i=0; $i< $count;$i++)
                @if($i==0)
                <div class="box-news">
                    <div class="box-left">
                        <div class="box-title">
                        <h5><a href="#0">{{ $part[0][$i]['kategori'] }}</a></h5>
                        <h4><a href="{{ url('artikel/'.$part[0][$i]['slug']) }}">{{ $part[$i][0]['judul'] }}</a></h4>
                        </div>
                        <p>
                        {!! str_limit($part[0][$i]['konten'],100) !!}
                        </p>
                        <div class="bottom-news">
                        <i class="mdi mdi-clock"></i> 7 days ago | Oleh <a href="#0">{{ $part[0][$i]['author'] }}</a>
                        </div>
                    </div>
                    <img src="{{ asset($part[0][$i]['media']) }}" alt="" class="img-fluid">
                </div>
                <div class="box-news-end">
                    <div class="dual-box">
                @else
                    <div class="box-media">
                        <img src="{{ asset($part[0][$i]['media']) }}" alt="" class="img-fluid" height="148px">
                        <div class="box-media-title">
                        <h5>{{ $part[0][$i]['kategori']}}</h5>
                        <h3><a href="{{ url('artikel/'.$part[0][$i]['slug']) }}">{{ str_limit($part[0][$i]['judul'],17) }}</a></h3>
                        </div>
                        <div class="box-media-bottom">
                                {!! str_limit($part[0][$i]['konten'],50) !!}
                        </div>
                        <div class="box-media-option">
                        <i class="mdi mdi-clock"></i> 7 days ago | Oleh <a href="#0">{{ $part[0][$i]['author'] }}</a>
                        </div>
                    </div>
                @endif
                 @endfor
                </div>
            </div>
            </div>
        @endif
        @if(isset($part[1]))
            <div class="box-two-third">
              @php $count=count($part[1]); @endphp

              <div class="box-news list">
              @for($i=0;$i<$count;$i++)
                <div class="box-media">
                  <img src="{{ asset($part[1][$i]['media']) }}" alt="" class="img-fluid">
                  <div class="box-media-title">
                  <h5>{{ str_limit($part[1][$i]['kategori'],20) }} </h5>
                    <h3><a href="#0">{{ str_limit($part[1][$i]['judul'],50) }}</a></h3>
                  </div>
                  <div class="box-media-bottom">
                        {!! str_limit($part[1][$i]['konten'],30) !!}
                  </div>
                  <div class="box-media-option">
                    <i class="mdi mdi-clock"></i> 7 days ago | By <a href="#0">admin</a>
                  </div>
                </div>
              @endfor
            </div>
            <div class="box-news-end bottom">
                    <div class="sub-news">
                      <div class="sub-left">
                        <h3>One Place with thousands tourism news</h3>
                        <p>
                          West java is divided into seven geographic regions with widely different landscapes. You’ve got beaches. You’ve got rolling hills and canyons. You’ll need about current places and the different regions and the diverse cities within them to find the adventure that suits you best.
                        </p>
                      </div>
                      <div class="sub-right">
                        <button type="button" class="btn btn-default">More detail</button>
                      </div>
                    </div>
                  </div>
          @else

          @endif
        </div>
        <div class="text-center">{{ $artikel->render() }}</div>
         <div class="news-video">
              <div class="title-lined">
                <h3>Ulasan Video </h3>
              <button class="btn btn-default" onclick="location.href='{{ url('galeri/video')  }}'">Tampilan Semua</button>
              </div>
              <div class="box-two-third">
               @if(isset($videolist))
                @php $i=0; @endphp;
               @foreach ($videolist as $vid)
               @php
                   $url = URL::to('/storage/data-video/cover/'.$vid->cover);
                   $foto = @getimagesize($url)?$url:'images/noimage.jpg';
               @endphp
                @if($i==0)
                <div class="box-news-end bottom for-video">
                  <div class="medium-video">
                    <div class="embed-responsives">
                    <a href="{{ route('galeri.video.detil',str_slug($vid->title))  }}"><img src="{{ asset($foto) }}" class="img-fluid" alt="{!! str_limit($vid->narasi,50) !!}" ></a>
                    </div>
                  </div>
                  <div class="video-short">
                  <a href="{{ route('galeri.video.detil',str_slug($vid->title))  }}"><h4>{{ $vid->title }}</h4></a>
                    <p>
                      {!! str_limit($vid->narasi,100) !!}
                    </p>
                  </div>
                </div>
                @else
                   @if($i==1) <div class="box-news list">@endif <div class="box-media">
                    <a href="{{ route('galeri.video.detil',str_slug($vid->title)) }}"><img src="{{ asset($foto) }}" alt="{{ $vid->title.$i }}" class="img-profile" ></a>
                  </div>
                  @if($i==6)</div>@endif
                @endif

               @php $i++; @endphp
                @endforeach
              @endif
              </div>

            </div>

          </div>
        </div>

      </div>




@endsection
@section('script')
<script src="{{ asset('scripts/lib/inner.js') }}"></script>
@endsection
