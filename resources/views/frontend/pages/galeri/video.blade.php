@extends('frontend.layouts.layouts_front')
@section('style')
<link rel="stylesheet" href="{{ asset('scripts/lib/flowplayer/skin.css')}}">
<style>
    .flowplayer {
        /* width: 20%; */
      time:false;
      embeded:false;
   }
</style>
@endsection
@section('content')
<section class="top-feature has-media video">
        <div class="container">
          <div class="page-title">
            <h3>
             Galeri Video
            </h3>
            {{-- <div class="form-group">
              <input type="text" class="form-control" placeholder="search video">
              <button type="submit" class="btn btn-default"><i class="mdi mdi-magnify"></i> Search</button>
            </div> --}}
          </div>
          <div class="card">
            <h3>Video Unggulan</h3>
           <div class="video-box">
             @if(isset($media))
             @foreach($media as $mda)
                 @switch($mda->parent_table)
                 @case('r_profildesa')
                 @php
                     $kategori = 'Profil Desa';
                 @endphp
                 @break
             @case('r_artikel')
                 @php
                     $kategori = 'Artikel';
                 @endphp
                 @break
             @case('r_desawisata_atraksi')
                 @php
                     $kategori = 'Daya Tarik Wisata';
                 @endphp
                 @break
             @case('r_desawisata_fasilitas')
                 @php
                     $kategori = 'Fasilitas Desa Wisata';
                 @endphp
                 @break

             @case('r_desawisata_jenis_usaha')
                 @php
                     $kategori = 'Oleh-oleh';
                 @endphp
                 @break
             @case('r_desawisata_kelsos')
                 @php
                     $kategori = 'Kelompok Sosial';
                 @endphp
                 @break
             @default
                     @php
                      $kategori = 'Desa Wisata';
                     @endphp
                     @break
                 @endswitch
                     @php
                     $folder = 'storage/data-video/cover/';
                         $url= $folder.$mda->cover;
                         $pathMedia = file_exists($url)?$url:'images/noimage.jpg';
                     @endphp
              <div class="video-item">
                    <div class="embed-responsive media-inner-left2">
                        <img src="{{ URL::to($pathMedia) }}" alt="{{ __($mda->title)}}" class="img-fluid2" >
                        <button type="button" class="btn btn-media" onclick="window.location='{{ route('galeri.video.detil',str_slug($mda->title))  }}'">
                            <i class="icon-play-button-2"></i>
                        </button>
                    </div>
                    <div class="small-title">
                      <span>{{ isset($mda->created_at)?\Carbon\Carbon::parse($mda->created_at)->format('d-m-Y'):'' }}</span>
                      <h4><a href="video-detail.html">{{ title_case($mda->title) }}</a></h4>
                    </div>
                  </div>
         @endforeach
     @endif
           </div>
          </div>
        </div>
      </section>
      <section class="media-main for-video">
        <div class="container">
          <div class="page-title">
            <h3 class="medium-title">Daftar Video</h3>
            {{-- <div class="btn-group">
              <button type="button" class="btn btn-default btn-filter active" data-target="all">All</button>
              <button type="button" class="btn btn-default btn-filter" data-target="new">new</button>
            </div> --}}
          </div>
          <div class="feat-filter clearfix">
            @if(count($mediaAll))
                <div class="feat-filter clearfix">
                    @foreach($mediaAll as $mdall)
                        @switch($mdall->parent_table)
                        @case('r_profildesa')
                            @php
                                $kategori = 'Profil Desa';
                                $foldercover= config('desawisata.PATH_IMAGE_PROFILDESA');
                            @endphp
                            @break
                        @case('r_artikel')
                            @php
                                $kategori = 'Artikel';
                                $foldercover= config('desawisata.PATH_IMAGE_ARTIKEL');
                            @endphp
                            @break
                        @case('r_desawisata_atraksi')
                            @php
                                $kategori = 'Daya Tarik Wisata';
                                $foldercover= config('desawisata.PATH_IMAGE_ATRAKSI');
                            @endphp
                            @break
                        @case('r_desawisata_fasilitas')
                            @php
                                $kategori = 'Fasilitas Desa Wisata';
                                $foldercover= config('desawisata.PATH_IMAGE_FASILITAS');
                            @endphp
                            @break
                        @case('r_desawisata_jenis_usaha')
                            @php
                                $kategori = 'Oleh-oleh';
                                $foldercover= config('desawisata.PATH_IMAGE_USPAR');
                            @endphp
                            @break
                        @case('r_desawisata_kelsos')
                            @php
                                $kategori = 'Kelompok Sosial';
                                $foldercover= config('desawisata.PATH_IMAGE_KELSOS');
                            @endphp
                            @break
                        @default
                            @php
                                $kategori = 'Desa Wisata';
                                $foldercover= config('desawisata.PATH_IMAGE_DESAWISATA');
                            @endphp
                            @break
                        @endswitch

                        @php
                            $folder='storage/data-video/cover/';
                            $url= $folder.$mdall->cover;
                            $pathMedia = file_exists($url)?$url:'images/noimage.jpg';
                            $pathCover = @getimagesize($foldercover.$mdall->cover)?$foldercover.$mdall->cover:'images/noimage.jpg';
                        @endphp

                        <div data-status="new" class="filter-box card">
                            <div class="video-item">
                               <div class="embed-responsive media-inner-left2">
                                  <img src="{{ URL::to($pathMedia) }}" alt="{{ __($mdall->title)}}" class="img-fluid2">
                                  <button type="button" class="btn btn-media" onclick="window.location='{{ route('galeri.video.detil',str_slug($mdall->title))  }}'">
                                        <i class="icon-play-button-2"></i>
                                  </button>
                                </div>
                                <div class="small-title">
                                    <span>{{ isset($mdall->created_at)?\Carbon\Carbon::parse($mdall->created_at)->format('d-m-Y'):'' }}</span>
                                    <h4><a href="{{ route('galeri.video.detil',str_slug($mdall->title))  }}">{{ title_case( str_limit($mdall->title,29)) }}</a></h4>
                                </div>
                                <p>
                                    {!! str_limit($mdall->narasi,100) !!}
                                    {{-- <small class="badge badge-pill badge-primary badge-sm">{!! $kategori !!}</small> --}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $mediaAll->links() }}
                @else
                <div class="text-center">Data Video Belum diinput</div>
                @endif
            </div>


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

        </div>
      </section>
@endsection
@section('script')
    <script src="{{ asset('scripts/lib/flowplayer/flowplayer.min.js') }}"></script>
    <script src="{{ asset('scripts/lib/inner.js') }}"></script>
    {{-- <script src="{{ asset('scripts/lib/front.js') }}"></script> --}}

  {{-- <script>

  </script> --}}
@endsection
