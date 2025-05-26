@extends('admin.layouts.layout_admin')

@section('style')
<style>
.media-placeholder .owl-carousel .owl-slide {
    position: relative;
    height: 100vh;
    background-color: lightgray;
}

.media-placeholder .owl-carousel .owl-slide-animated {
    -webkit-transform: translateX(20px);
    transform: translateX(20px);
    opacity: 0;
    visibility: hidden;
    transition: all 0.05s;
}

.media-placeholder .owl-carousel .owl-slide-animated.is-transitioned {
    -webkit-transform: none;
    transform: none;
    opacity: 1;
    visibility: visible;
    transition: all 0.5s;
}

.media-placeholder .owl-carousel .owl-slide-title.is-transitioned {
    transition-delay: 0.2s;
}

.media-placeholder .owl-carousel .owl-slide-subtitle.is-transitioned {
    transition-delay: 0.35s;
}

.media-placeholder .owl-carousel .owl-slide-cta.is-transitioned {
    transition-delay: 0.5s;
}

.media-placeholder .owl-carousel .owl-dots, .media-placeholder .owl-carousel .owl-nav {
    position: absolute;
}

.media-placeholder .owl-carousel .owl-dots .owl-dot, .media-placeholder .owl-carousel .owl-nav [class*="owl-"]:focus {
    outline: none;
}

.media-placeholder .owl-carousel .owl-dots .owl-dot span {
    background: transparent;
    border: 1px solid var(--main-black-color);
    transition: all 0.2s ease;
}

.media-placeholder .owl-carousel .owl-dots .owl-dot:hover span, .media-placeholder .owl-carousel .owl-dots .owl-dot.active span {
    background: var(--main-black-color);
}

.media-placeholder .owl-carousel .owl-nav {
    left: 50%;
    top: 10%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    margin: 0;
}

.media-placeholder .owl-carousel .owl-nav svg {
    opacity: 0.3;
    transition: opacity 0.3s;
}

.media-placeholder .owl-carousel .owl-nav button:hover svg {
    opacity: 1;
}

.media-placeholder .owl-carousel .owl-nav [class*="owl-"]:hover {
    background: transparent;
}

.media-placeholder section {
    display: none;
}

@media screen and (max-width: 575px) {
    .media-placeholder .owl-carousel .owl-nav {
        top: 5%;
    }

    .media-placeholder .owl-carousel .owl-nav svg {
        width: 24px;
        height: 24px;
    }
}

.owl-slide-text {
    color: #fff;
}

.owl-slide-text h2 {
    color: #fff;
    font-size: 48px;
}

.owl-slide-subtitle {
    font-size: 16px;
    font-weight: 300;
}

.media-placeholder .owl-carousel .owl-nav {
    top: 50%;
    width: 100%;
}
.dashboard-single .media-placeholder .owl-carousel{
    height: 425px;
    width: 100%;
}

.county-support .table thead th {
    font-weight: 500;
}
</style>
@endsection
@section('content')
    <!-- begin single page dashboard -->
    <div class="dashboard-single">

        @if(isset($desawisata))
            @foreach($desawisata['data'] as $data)
                @php
                if($data->tgl_modif!=null){
                    $tgl = $data->updated_at;
                    $tglModif = ($data->tgl_modif!='')?\DateTime::createFromFormat('Y-m-d H:i:s', $data->tgl_modif):'';
                    $updateTgl = ($data->tgl_modif!='')?$tglModif->format('d M Y'):'';
                    // $updateJam = ($data->tgl_modif!='')?$tglModif->format('h:i:s'):'';
                }else{
                    $updateTgl = date('d M Y');
                    // $updateJam = date('h:i:s');
                }
                @endphp
                <div class="single-top">
                            <!-- begin top dashboard -->
                    <div class="dashboard-top">
                        <div class="container-fluid">
                                    <div class="top-entry">
                                        <div class="top-status has-back">
                                           <button type="button" class="btn btn-clean btn-back" onclick="window.location='{{ __($linkBack) }}'" >
                                                <i class="icon-back-1"></i>
                                            </button>
                                            <h3>Detail {{ $data->nama_desawisata }}</h3>
                                        </div>
                                        <div class="top-option">
                                            <div class="date-text">
                                                Data Terakhir  <i class="icon-calendar"></i> {{ $updateTgl }}
                                                {{-- <i class="mdi mdi-clock"></i> {{ $updateJam }} --}}
                                            </div>
                                            <a href="#"  class="btn btn-default btn-edit" data-toggle="modal" data-target="#modelId" data-proid="{{ $data->id }}">
                                                <i class="mdi mdi-lead-pencil"></i> Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end top dashboard -->
                    <div class="media-placeholder">
                                {{-- <div clsass="owl-carousel owl-theme"> --}}
                                        @foreach($data->Media as $mda)
                                        @php
                                            $file = Storage::url('data-desawisata/'.$mda['filename']);
                                            $foto = (@getimagesize($file)!=false)?$file:'images/noimage.jpg';
                                            $judul = $mda->title;
                                        @endphp
                                        {{-- <div class="owl-slide d-flex align-items-center"> --}}
                                                <img src="{{ asset($foto)}}" alt="jabar" class="img-fluid">
                                                {{-- <div class="container">
                                                        <div class="owl-slide-text text-center">
                                                            <h2 class="owl-slide-animated owl-slide-title">{!! $judul !!}</h2>
                                                            <div class="owl-slide-animated owl-slide-subtitle mb-3">
                                                                    {!! $sld->subjudul !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div> --}}
                                    @endforeach
                                {{-- </div> --}}

                                <div class="top-info-detail">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                                <div class="list-info">
                                                    <div class="info-text">
                                                        <h5>Nama desa wisata</h5>
                                                        <h1>{{ ucwords(strtolower($data->nama_desawisata)) }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-sm-6">
                                                @if($data->Akses != null)
                                                    <div class="list-flex has-three">
                                                        <div class="flex-item">
                                                            <h4>Jarak Dari Provinsi</h4>
                                                            <div class="circle-line">
                                                                {{ isset($data->Akses->jarak_dari_ibukota)?$data->Akses->jarak_dari_ibukota:'0' }}<span>km</span>
                                                            </div>
                                                            <h5 class="label text-center">{{ $data->Akses->waktu_dari_ibukota }}</h5>
                                                        </div>
                                                        <div class="flex-item">
                                                            <h4>Jarak Dari Kabupaten</h4>
                                                            <div class="circle-line">
                                                                {{ isset($data->Akses->jarak_dari_kab)?$data->Akses->jarak_dari_kab:'0' }}<span>km</span>
                                                            </div>
                                                            <h5 class="label text-center">{{ $data->Akses->waktu_dari_kab }}</h5>
                                                        </div>
                                                        <div class="flex-item">
                                                            <h4>Jarak Dari Kecamatan</h4>
                                                            <div class="circle-line">
                                                                {{ isset($data->Akses->jarak_dari_kec)?$data->Akses->jarak_dari_kec:'0' }}<span>km</span>
                                                            </div>
                                                            <h5 class="label text-center">{{ $data->Akses->waktu_dari_kec }}</h5>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="list-flex has-three">
                                                        <p class="text-center">Data Akses Masih Kosong</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>

                <div class="place-detail">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- begin side left -->
                            <div class="col-lg-9 col-md-9">
                                <div class="place-information">
                                    <span class="text-helper">Tentang {{  $data->nama_desawisata }}</span>
                                    <span class="text-spacer"></span>
                                    <p>
                                        {!! nl2br($data->deskripsi) !!}
                                    </p>
                                </div>
                                <div class="county-operation">
                                    <div class="box-inline has-two">
                                        <div class="box-item">
                                            <h4>Detail desa</h4>
                                            <div class="county-operation-item">
                                                <div class="operation-item">
                                                    <h5>Kategori</h5>
                                                    <p>{{ $data->category->catname }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Tahun Berdiri</h5>
                                                    <p>{{ $data->tahun_berdiri }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Kabupaten</h5>
                                                    <p>{{ $data->Kelurahan->Kecamatan->Kabupaten['nama'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Kecamatan</h5>
                                                    <p>{{ $data->Kelurahan->Kecamatan['nama'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Kelurahan</h5>
                                                    <p>{{ $data->Kelurahan['nama'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>SK Desa</h5>
                                                    <p>{{ $data->sk_desa }} <br> {{ isset($data->tgl_sk_desa)?\Carbon\Carbon::parse($data->tgl_sk_desa)->format('d-m-Y'):''
                                                        }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>SK Dinas Kota / Kabupaten</h5>
                                                    <p>{{ $data->sk_dinas_kab }} <br> {{ isset($data->tgl_sk_kab)?\Carbon\Carbon::parse($data->tgl_sk_kab)->format('d-m-Y'):''
                                                        }} </p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>SK Provinsi</h5>
                                                    <p>{{ $data->sk_provinsi }} <br> {{ isset($data->tgl_sk_prov)?\Carbon\Carbon::parse($data->tgl_sk_prov)->format('d-m-Y'):''
                                                        }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-item">
                                            <h4>Pengelola</h4>
                                            <div class="county-operation-item">
                                                <div class="operation-item">
                                                    <h5>Nama Unit</h5>
                                                    <p>{{ $data->Pengelola['nama_pengelola'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Nama Pimpinan</h5>
                                                    <p>{{ $data->Pengelola['pimpinan'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Kontak Person</h5>
                                                    <p>{{ $data->Pengelola['kontak_person'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Jabatan</h5>
                                                    <p>{{ $data->Pengelola['jabatan'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>No Hp</h5>
                                                    <p>{{ $data->Pengelola['no_hp'] }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Email</h5>
                                                    <small><a href="#0">{{ $data->Pengelola['email'] }}</a></small>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Website</h5>
                                                    <small><a href="#0">{{ $data->Pengelola['website'] }}</a></small>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Jumlah Pengelola</h5>
                                                    <p>{{ isset($data->Pengelola['jum_pengurus'])?$data->Pengelola['jum_pengurus'].' orang':'-' }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Regulasi</h5>
                                                    <p>{{ $data->Pengelola['regulasi'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="county-operation">
                                    <h4>Aksesibilitas</h4>
                                    <div class="box-inline has-two">
                                        @if($data->Akses!=null)
                                            <div class="box-item">
                                                <div class="county-operation-item">
                                                    <div class="operation-item">
                                                        <h5>Kondisi Jalan</h5>
                                                        <p>{{ $data->Akses->kondisi_jalan }}</p>
                                                    </div>
                                                    <div class="operation-item">
                                                        <h5>Jenis Kendaraan</h5>
                                                        <p>{{ $data->Akses->jenis_kendaraan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="box-item">
                                                <div class="operation-item">
                                                    <h5>Kendaraan Umum</h5>
                                                    <p>{{ $data->Akses->kendaraan_umum }}</p>
                                                </div>
                                                <div class="operation-item">
                                                    <h5>Rambu Petunjuk</h5>
                                                    <p>{{ $data->Akses->rambu_petunjuk==1?'Ada':'Tidak Ada' }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="county-operation-item">
                                                <div class="text-center">Data Akses Masih Kosong</div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <section id="atraksi" class="county-section mid-four">
                                    <div class="support-county">
                                        <h3>Atraksi</h3>
                                        @if(count($atraksi)==0)
                                            <p class="text-center">Data Atraksi Belum tersedia</p>
                                        @else
                                            @foreach ($atraksi as $atr)
                                                @if(count($atr->Media)>0)
                                                 @foreach ($atr->Media as $mda) @php $url = Storage::url('data-atraksi/').$mda->filename;
                                                    $fotoatraksi = @getimagesize($url)!==false?$url:'images/noimage.jpg';
                                                    @endphp
                                                    <div class="card">
                                                        <span class="card-icon">
                                                            <img src="{{ asset($fotoatraksi) }}" alt="" class="img-fluid">
                                                        </span>
                                                        <div class="support-text">
                                                            <h5>{{ $mda->title }}</h5>
                                                            <p>{{ $mda->narasi }}</p>
                                                            <br>
                                                            <h6>Kategori : {{ ucwords($atr->Atraksi->tipe) }} &raquo; {{ $atr->Atraksi->nama_atraksi }}</h6>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else @php $fotoatraksi = 'images/noimage.jpg'; @endphp
                                                    <div class="card">
                                                        <span class="card-icon">
                                                            <img src="{{ asset($fotoatraksi) }}" alt="" class="img-fluid">
                                                        </span>
                                                        <div class="support-text">
                                                            <h5>{{ $atr->title }}</h5>
                                                            <p>{{ $atr->keterangan }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </section>
                                <div id="promosi" class="county-operation mid-four">
                                        <h3>Promosi</h3>
                                        @if(isset($promosi))
                                        <div class="box-inline">
                                          <div class="box-item">
                                            <div class="county-operation-item">

                                                @foreach ($promosi as $promo)
                                                    <div class="operation-item">
                                                       <h5>{{ $promo->nama_jenis_promosi }}</h5>
                                                        @if(count($promo->desa_wisata_promosi)>0)
                                                            @foreach ($promo->desa_wisata_promosi as $prm)
                                                                <p>{{ ($prm->is_ada==1)?$prm->note:'' }}</p>
                                                            @endforeach
                                                        @else
                                                        <p class="text-center">Data Promosi Belum diinput</p>
                                                         @endif
                                                    </div>
                                                @endforeach

                                            </div>
                                          </div>
                                        </div>
                                        @else
                                           <p class="text-center">Data Promosi Belum diinput</p>
                                        @endif
                                  </div>
                                  <div class="county-support">
                                      <h3>Kelompok Sosial</h3>
                                    <div class="county-support-item">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-inversex">
                                                <thead class="thead-inverse">
                                                    <tr>
                                                    <th>No</th>
                                                    <th>Jenis Kelompok Sosial</th>
                                                    <th>Nama Kelompok Sosial</th>
                                                    <th>Jum Pengurus</th>
                                                    <th>Jum Anggota</th>
                                                    <th>Foto</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if(count($kelsos)>0)
                                                    @php
                                                        $i=0
                                                    @endphp
                                                    @foreach ($kelsos as $ksos)
                                                       <tr>
                                                            <td scope="row">{{ ++$i }}</td>
                                                            <td>{{ $ksos->jenis_kelsos->nama_kelsos }}</td>
                                                                <td>{{ $ksos->nama_kelsos }}</td>
                                                                <td class="text-center">{{ $ksos->jumlah_pengurus }}</td>
                                                                <td class="text-center">{{ $ksos->jumlah_anggota }}</td>
                                                                <td class="text-center">
                                                                    @if(count($ksos->Media)>0)
                                                                        @foreach ($ksos->Media as $kmda)
                                                                            <a href="{{ Storage::url('data-kelsos/'.$kmda->filename) }}" data-image="{{ Storage::url('data-kelsos/'.$kmda->filename) }}">{{ $kmda->title }}</a>,
                                                                        @endforeach

                                                                    @endif
                                                                </td>
                                                                <td>{{ $ksos->keterangan }}</td>
                                                       </tr>
                                                    @endforeach
                                                  @else
                                                    <tr>
                                                      <td colspan="7" class="text-center">Data Kelompok Sosial belum diinput</td>
                                                    </tr>
                                                   @endif
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="county-support">
                                      <h3>Usaha Pariwisata</h3>
                                      <div class="county-support-item">
                                            @if(count($usahapar)>0)
                                            <div class="county-operation lite">

                                                  <div class="box-inline has-two">
                                                    @foreach ($usahapar as $upar)
                                                        <div class="box-item">
                                                        @if(count($upar->Media)>0)
                                                            @foreach($upar->Media as $umda)
                                                                @php
                                                                    $url = ($upar->url=='')?Storage::url('data-usahapariwisata/'.$umda->filename):$upar->url;
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


                                                        <h4>{{ $upar->nama_usaha }}</h4>
                                                            <div class="box-count">
                                                                <div class="count-item">
                                                                    Jumlah Tenaga Kerja
                                                                    <p><b>{{ $upar->jum_tenaga }}</b></p>
                                                                </div>
                                                                <div class="count-item">
                                                                    Jenis Usaha
                                                                    <p><b>{{ $upar->jenis_usaha['nama_jenis_usaha'] }}</b></p>
                                                                </div>
                                                            </div>
                                                            <p>{{ $upar->note }} </p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                                @else
                                                    <p class="text-center">Data Usaha Pariwisata Tidak Ditemukan</p>
                                                @endif

                                        </div>
                                  </div>
                                <section class="county-support county-section mid-four">
                                        <h3>Bantuan</h3>
                                        <div class="county-support-item">
                                                <h4>Program Bantuan Dana Pariwisata</h4>
                                                @if(count($progbantuan)>0)
                                                    @foreach ($progbantuan as $pbantuan)
                                                        <div class="box-support">
                                                            <div class="support-item-year">
                                                            <i class="icon-calendar"></i>
                                                            <span class="numeric">{{ $pbantuan->tahun }}</span>
                                                            </div>
                                                            <div class="support-amount">
                                                            Rp. {{ number_format($pbantuan->jum_dana,0,',','.') }}
                                                            </div>
                                                            <div class="support-description">
                                                            <h5>{!! $pbantuan->program_bantuan->nama_program !!}</h5>
                                                            <p>{!! $pbantuan->untuk_dana !!}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-center">Data Program Bantuan Masih Kosong</p>
                                                @endif
                                            </div>
                                    <div class="county-support-item">
                                      <h4>Dampak Bantuan Dana Pariwisata</h4>
                                      @if(isset($dampak))
                                        <div class="support-timeline">
                                            <ul class="list-unstyled">
                                            <li>
                                                <div class="support-year">
                                                <strong>2018</strong>
                                                <p>Jalan bojong soang tidak banjir lagi</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="support-year">
                                                <strong>2017</strong>
                                                <p>Jalan bojong soang tidak banjir lagi</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="support-year">
                                                <strong>2016</strong>
                                                <p>Jalan bojong soang tidak banjir lagi</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="support-year">
                                                <strong>2015</strong>
                                                <p>Jalan bojong soang tidak banjir lagi</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="support-year">
                                                <strong>Uraian</strong>
                                                <p>Jalan bojong soang tidak banjir lagi</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="support-year">
                                                <strong>Keterangan</strong>
                                                <p>Jalan bojong soang tidak banjir lagi</p>
                                                </div>
                                            </li>
                                            </ul>
                                        </div>
                                      @else
                                        <div class="text-center">Data Bantuan Masih Kosong</div>
                                      @endif
                                    </div>
                                    <div class="county-support-item">
                                        <h4>Pemanfaatan Dana Bantuan</h4>
                                        @if(isset($manfaatbantuan))
                                            <p>Jenis Pemanfaatan, Besarana dan Kelompok Sasaran Dana Bantuan yang dterima Desa Wisata/Kampung Kreatif</p>
                                            @foreach ($manfaatbantuan as $mbantuan)
                                                <div class="card">
                                                    <span class="card-icon">
                                                    <img src="../../images/noimage.jpg" alt="" class="img-fluid">
                                                    </span>
                                                    <div class="support-text">
                                                    <h5>Kantor Kelurahan</h5>
                                                    <p>Dana digunakan untuk pembangunan kantor dan Dana digunakan untuk pembangunan kantor Dana digunakan untuk pembangunan kantor</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                           <p class="text-center">Data Pemanfaatan Bantuan masih kosong</p>
                                        @endif
                                    </div>
                                  </section>
                                  <div class="county-support">
                                        <h3>Statistik Pariwisata</h3>
                                        @if(isset($statistik))
                                            <div class="county-stats">
                                                <canvas id="county"></canvas>
                                            </div>
                                        @else
                                           <p class="text-center">Data Statistik Masih Kosong</p>
                                        @endif
                                  </div>
                                  <section id="countyLocation" class="county-section mid-five">
                                      <h3 class="text-center">Lokasi Desa Wisata</h3>
                                      @if($data->lat != null)
                                        <div class="county-map">
                                            <div id="county_map"></div>
                                        </div>
                                      @else
                                          <p class="text-center">Data Lokasi Masih Kosong</p>
                                      @endif
                                  </section>
                                </div>
                                <!-- End side left -->

                                <!-- begin side right -->
                                <div class="col-lg-3 col-md-3">
                                  <aside class="place-aside">
                                    <div class="card county-side">
                                        <h4>Fasilitas</h4>
                                        @if(count($fasilitas)>0)
                                            <div class="county-side-inner">
                                                <div class="county-facility">
                                                    @foreach ($fasilitas as $fas)
                                                        <h5>{{ __($fas->jenis_fasilitas['jenis_fasilitas']) }}</h5>

                                                        @if(count($fas->Media)>0)
                                                            @foreach ($fas->Media as $mds)
                                                                @php
                                                                    $urlmedia = Storage::url('data-fasilitas/').__($mds['filename']);
                                                                    $fotomedia = @getimagesize($urlmedia)!=false?$urlmedia:'images/noimage.jpg';
                                                                    $judul = $mds['title'];
                                                                @endphp
                                                                <img src="{{ asset($fotomedia) }}" alt="" class="img-fluid">
                                                            @endforeach
                                                        @else
                                                            <img src="{{ asset('images/noimage.jpg') }}" alt="" class="img-fluid">
                                                        @endif
                                                        <h6> {{ __($fas->keterangan) }} </h6>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <div class="county-side-inner">
                                                <div class="county-facility">
                                                    <p class="text-center">Data Fasilitas Masih Kosong</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                  </aside>
                                </div>
                                <!-- end side right -->
                        </div>
                     </div>
                </div>
            @endforeach
        @else
            <p class="text-center">Data Tidak Ditemukan</p>
        @endif
    </div>
      <!-- end single page dashboard -->
      @include('admin.pages.desawisata.form.modaledit')
@endsection

@section('script')
<script src="{{ asset('scripts/lib/owl.carousel.js') }}"></script>
<script src="{{ asset('scripts/lib/chart.js')}}"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjXNJqRF-lSHNHtksAjQeWWdeP4LZ1_Qk&callback=county_map"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/hls.js@0.11.0/dist/hls.light.min.js"></script>
<script src="https://releases.flowplayer.org/7.2.7/flowplayer.min.js"></script>
<script src="https://releases.flowplayer.org/overlay/flowplayer.overlay.min.js"></script>
<!-- the bootstrap vendor overlay wrapper -->
<script src="https://releases.flowplayer.org/overlay/vendors/flowplayer.overlay.bootstrap.js"></script>

<script>
//slider foto
$(function(){


    if( $(".owl-carousel").length){
        $(".owl-carousel").on("initialized.owl.carousel", function () {
            setTimeout(function () {
              $(".owl-item.active .owl-slide-animated").addClass("is-transitioned");
              $("section").show();
            }, 500);
          });

          var $owlCarousel = $(".owl-carousel").owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            lazyLoad: true,
            dots: false,
            autoplay: true,
            navText: [
              "<i class='icon icon-back'></i>","<i class='icon-next'></i>"] });

          $owlCarousel.on("changed.owl.carousel", function (e) {
            $(".owl-slide-animated").removeClass("is-transitioned");

            var $currentOwlItem = $(".owl-item").eq(e.item.index);
            $currentOwlItem.find(".owl-slide-animated").addClass("is-transitioned");

            var $target = $currentOwlItem.find(".owl-slide-text");
            doDotsCalculations($target);
          });

          $owlCarousel.on("resize.owl.carousel", function () {
            setTimeout(function () {
              setOwlDotsPosition();
            }, 50);
          });


          $owlCarousel.trigger("refresh.owl.carousel");

          setOwlDotsPosition();

          function setOwlDotsPosition() {
            var $target = $(".owl-item.active .owl-slide-text");
            doDotsCalculations($target);
          }

          function doDotsCalculations(el) {
            var height = el.height();var _el$position =
              el.position(),top = _el$position.top,left = _el$position.left;
            var res = height + top + 20;

            $(".owl-carousel .owl-dots").css({
              top: res + "px",
              left: left + "px" });
          }

    }

    var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    blue: 'rgb(54, 162, 235)',
    purple: 'rgb(153, 102, 255)',
    grey: 'rgb(231,233,237)'
  };

  var randomScalingFactor = function() {
    return (Math.random() > 0.5 ? 1.0 : -1.0) * Math.round(Math.random() * 100);
  }
  var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var config = {
    type: 'line',
    data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
        label: "2018",
        backgroundColor: chartColors.orange,
        borderColor: chartColors.orange,
        data: [
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()
        ],
        fill: false,
      },
        {
          label: "2017",
          backgroundColor: chartColors.green,
          borderColor: chartColors.green,
          data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
          ],
          fill: false,
        },

        {
          label: "2016",
          backgroundColor: chartColors.red,
          borderColor: chartColors.red,
          data: [
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor(),
            randomScalingFactor()
          ],
          fill: false,
        }, {
        label: "2015",
        fill: false,
        backgroundColor: chartColors.blue,
        borderColor: chartColors.blue,
        data: [
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor(),
          randomScalingFactor()
        ],
      }]
    },
    options: {
      responsive: true,
      title: {
        display: true,
        text: 'Kunjungan Wisata ke jawa Barat'
      },
      tooltips: {
        mode: 'label',
      },
      hover: {
        mode: 'nearest',
        intersect: true
      },
      scales: {
        xAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Month'
          }
        }],
        yAxes: [{
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Value'
          }
        }]
      }
    }
  };

  if($('#county').length){
    var ctx = document.getElementById("county").getContext("2d");
    window.myLine = new Chart(ctx, config);
  }

//modal Edit
    $(document).on("click", ".btn-edit", function () {
                var profilid = $(this).data('proid');
                $(".modal-body a#editprofil").attr("href","/backend/desawisata/"+profilid+"/edit");
                $(".modal-body a#editpengelola").attr("href","/backend/desawisata/editpengelola/"+profilid);
                $(".modal-body a#editpromosi").attr("href","/backend/desawisata/editpromosi/"+profilid);
                $(".modal-body a#editfasilitas").attr("href","/backend/desawisata/editfasilitas/"+profilid);
                $(".modal-body a#editakses").attr("href","/backend/desawisata/editakses/"+profilid);
                $(".modal-body a#editatraksi").attr("href","/backend/desawisata/editatraksi/"+profilid);
                $(".modal-body a#editkelsos").attr("href","/backend/desawisata/editkelsos/"+profilid);
                $(".modal-body a#edituspar").attr("href","/backend/desawisata/edituspar/"+profilid);
                $(".modal-body a#editstat").attr("href","/backend/desawisata/editstat/"+profilid);
                $(".modal-body a#editbantuan").attr("href","/backend/desawisata/editbantuan/"+profilid);
                $(".modal-body a#editpenghargaan").attr("href","/backend/desawisata/editpenghargaan/"+profilid);
    });

    //peta wisata

    var map;

      var latlng = new google.maps.LatLng(-6.951624, 107.63843);
      var myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      map = new google.maps.Map(document.getElementById("county_map"), myOptions);
      // init Height
      $('#county_map').height($( window ).height());

    // On Resize
    $(window).resize(function(){
      $('#county_map').height($( window ).height());
    });

});
</script>
@endsection
