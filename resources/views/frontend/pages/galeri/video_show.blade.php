@extends('frontend.layouts.layouts_front')

@section('content')
    <!-- begin single page front -->

@if(isset($media))
   @foreach($media as $data)
    @php

       $url = Storage::url('data-video/cover/'.$data->cover);
       $foto = @getimagesize($url)!=false?$url:'images/noimage.jpg';
       $filenameVideo = '/storage/data-video/'.$data->filename;
       $mediaID = $data->media_id;
       $judul = $data->title;
       $konten = $data->narasi;

       $hits = $data->hits;
       $urlAvatar = URL::to('/').'/'.config('desawisata.PATH_IMAGE_AVATAR').$data->avatar;
       $avatar = @getimagesize($urlAvatar)>0?$urlAvatar:'images/noimage.jpg';
       $authorBio = $data->bio;
       $tgl = \Carbon\Carbon::parse($data->created_at)->format('d/m/Y H:i:s');
       $author = $data->User['name'];
    @endphp

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

  <div class="detail-page">
        <div class="page-breadcrumb">
          <div class="container">
            <ul class="list-unstyled">
              <li>
              <a href="{{ url('/')}}">
                  <i class="mdi mdi-home"></i>
                  Beranda / &nbsp;
                </a>
              </li>
              <li>
                <a href="{{ route('galeri')}}">
                 Galeri / &nbsp;
                </a>
              </li>
              <li>
                <a href="{{ route('galeri.video')}}">
                 Video / &nbsp;
                </a>
              </li>
              <li>
                 {{ __($judul) }}
              </li>
            </ul>
          </div>
        </div>

        <article class="detail-post">
          <div class="container">
           <div class="post-wrap">
             <div class="post-content">
               <div class="page-title reset">
                 <a href="{{ route('galeri.video')}}"><div class="page-category">
                   {{ __('Video') }}
                 </div>
                </a>
                 <h1> {{ __(ucwords($judul)) }}</h1>
                 <div class="page-info">
                   <div class="small-info clearfix">
                   <p><i class="mdi mdi-calendar"></i> {{ $tgl }} &nbsp; <i class="mdi mdi-eye"></i> {{ $hits>0?$hits:0 }} </p>
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
                    @if(!empty($filenameVideo) && $filenameVideo!=null )
                        <div id="long" class="fp-slim fp-outlined no-buffer"></div>
                    @endif
                </div>
                 <p> {!! nl2br($konten) !!}</p>
               </div>

               <div class="post-author">
                 <img src="{{ asset($avatar) }}" alt="author" class="img-fluid">
                 <div class="author-post">
                 <h4>{{ __($author) }}</h4>
                 <p>{{ __($authorBio) }}</p>
                 </div>
               </div>

               {{-- <div class="related-post">
                 <h4>media Serupa</h4>
                 <div class="related-media">
                    @if(isset($rellkonten))
                        @foreach ($rellkonten as $item)
                         @php
                            $judul = $item->judul;
                            $slug = $item->slug;
                            $tglat = \Carbon\Carbon::parse($item->created_at)->diffForHumans();
                            $urlfoto = URL::to('/').'/'.config('desawisata.PATH_IMAGE_media').'thumb/'.$item->filename;

                            $fotoRel = @getimagesize($urlfoto) ? $urlfoto:'images/noimage.jpg';
                        @endphp
                        <div class="related-item">
                            {{-- class="img-fluid" --}}
                        {{-- <img src="{{ asset($fotoRel) }}" alt=""  width="217px" height="163px">
                            <div class="small-title">
                                <h4><a href="#">{{ __($judul) }}</a></h4>
                                <span>{{ __($tglat) }}</span>
                            </div>
                            </div>
                        @endforeach
                    @endif
                 </div>

               </div> --}}

               {{-- <div class="detailBox">
                 <div class="titleBox">
                   <label>Komentar</label>
                 </div>
                 <div class="actionBox">
                    <div id="disqus_thread"></div>
                    <script>

                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
               </div> --}}
             </div>

             <aside class="side-post">
               <div class="side-box">
                 <h4>Desa Wisata</h4>
                 @if(isset($desawisata))
                 <a href="video-detail.html" class="side-box-item">
                   <div class="side-media">
                     <img src="images/jabar-sample.jpg" alt="" class="img-fluid">
                   </div>
                   <div class="side-media-text">
                     <h3>West java title for side bar content and related </h3>
                   </div>
                 </a>
                 @else
                  <div class="side-box-item">
                      <p>Desa Wisata Masih Kosong</p>
                  </div>
                 @endif
               </div>
               <div class="side-box">
                 <h4>Profil Desa</h4>
                 @if(isset($desa))
                 <a href="video-detail.html" class="side-box-item">
                   <div class="side-media">
                     <img src="images/jabar-sample.jpg" alt="" class="img-fluid">
                   </div>
                   <div class="side-media-text">
                     <h3>West java title for side bar content and related </h3>
                   </div>
                 </a>
                 @else
                  <div class="side-box-item">
                      <p>Desa Wisata Masih Kosong</p>
                  </div>
                 @endif
               </div>
             </aside>
           </div>
          </div>
        </article>
      </div>


@endforeach
@endif

  @endsection
@section('script')
<script src="{{ asset('scripts/lib/flowplayer/flowplayer.min.js') }}"></script>
<script src="{{ asset('scripts/lib/flowplayer/flowplayer.hlsjs.light.min.js') }}"></script>
<script src="{{ asset('scripts/lib/flowplayer/flowplayer.thumbnails.min.js') }}"></script>
@if(!empty($filenameVideo) && $filenameVideo!=null && !empty($judul) && $judul!=null )

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
              title: "{{ ucwords(strtolower($judul)) }}",
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
