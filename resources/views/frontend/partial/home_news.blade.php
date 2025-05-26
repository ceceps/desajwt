<section class="home-content home-news">
    <div class="container">
        <div class="home-title">
            <h3>Apa Berita Terbaru yang ada di Desa Wisata Jawa Barat</h3>
            <h5>cari update terbaru di tiap daerah</h5>
        </div>

        <div class="news-list">
            @if(isset($artikel))
                @foreach($artikel as $art)
                @php
                    if(count($art['media'])>0){
                        foreach($art['media'] as $k => $artmedia){
                            $url = URL::to('/').'/'.config('desawisata.PATH_IMAGE_ARTIKEL').'thumb/'.$artmedia['filename'];
                            //dd($url);
                            $foto_artikel = @getimagesize($url)?$url:'images/noimage.jpg';
                        }
                    }else{
                        $foto_artikel = 'images/noimage.jpg';
                    }
                    $dibuat = new DateTime($art['created_at']);
                    $tgl = $dibuat->format('d-m-Y');
                    $jam = $dibuat->format('H:i:s');
                    $linkShow = 'artikel/'.$art['slug'];
                @endphp

                <div class="news-item card">
                    <div class="news-thumb">
                        <img src="{{ asset($foto_artikel) }}" alt="{{ $art['judul'] }}" class="img-fluid">
                    </div>
                    <div class="news-content">
                        <h3><a href="{{ url('/artikel/'.$art['slug']) }}">{{ substr($art['judul'],0,100) }}</a></h3>
                        {!! str_limit($art['konten'],50) !!}
                    </div>
                    <div class="news-info">
                        <span>
                            <i class="mdi mdi-calendar"></i>
                            <p>{{ $tgl }}</p>
                        </span>
                        <span>
                            <i class="mdi mdi-timeline"></i>
                            <p>{{ $jam }}</p>
                        </span>
                        <span>
                            <i class="mdi mdi-account"></i>
                            <p>{{ $art->User['fullname'] }}</p>
                        </span>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-center"> Belum Ada Artiel</p>
            @endif
            <div class="text-center">
            <a class="long-news" href='{{ url('/artikel')}}'>
                Lihat Semua Artikel &raquo;
            </a>
            </div>
        </div>
    </div>
</section>
