@extends('admin.layouts.layout_admin')
@section('content')
<!-- begin single page dashboard -->
<div class="dashboard-single">

    @if(isset($profildesa))

      @if(count($profildesa->media)>0)
       @foreach($profildesa->media as $mds)
        @php
            $url = URL::to('/').'/'.config('desawisata.PATH_IMAGE_PROFILDESA').$mds->filename;
            $foto = @getimagesize($url)!=false?$url:'images/noimage.jpg';

        @endphp
      @endforeach
    @else
       @php $foto = 'images/noimage.jpg'; @endphp
    @endif
    <div class="single-top">
        <!-- begin top dashboard -->
        <div class="dashboard-top">
            <div class="container-fluid">
                <div class="top-entry">
                    <div class="top-status has-back">
                        <button type="button" class="btn btn-clean btn-back" onclick="window.location='{{ __($linkBack) }}'">
                                                <i class="icon-back-1"></i>
                                            </button>
                        <h3>Detail {{ $profildesa->kelurahan['nama'] }}</h3>
                    </div>
                    <div class="top-option">
                        <div class="date-text">
                            Terakhir didata <i class="icon-calendar"></i> {{ $profildesa['data_tahun'] }}
                        </div>
                        <a href="{{ route('profildesa.edit',$profildesa) }}" class="btn btn-default btn-edit">
                            <i class="mdi mdi-lead-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- end top dashboard -->
        <div class="media-placeholder">
            <img src="{{ asset($foto)}}" alt="jabar" class="img-fluid">
            <div class="top-info-detail">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-sm-6">
                            <div class="list-info">
                                <div class="info-text">
                                    <h5>Nama Desa</h5>
                                    <h1>{{ ucwords(strtolower($profildesa->kelurahan['nama'])) }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="place-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="place-information">
                        <span class="text-helper">Tentang {{  $profildesa->kelurahan['nama'] }}</span>
                        <span class="text-spacer"></span>
                        <p>
                            {!! nl2br($profildesa['deskripsi']) !!}
                        </p>
                    </div>
                    <div class="county-operation">
                        <div class="box-inline has-two">
                            <div class="box-item">
                                <h4>Detail Desa</h4>
                                <div class="county-operation-item">
                                        <div class="operation-item">
                                                <h5>No. Tgl SK</h5>
                                                <p>{{ $profildesa['pendirian_sk'] }}</p>
                                            </div>
                                    <div class="operation-item">
                                        <h5>Kabupaten</h5>
                                        <p>{{ $namakab }}</p>
                                    </div>
                                    <div class="operation-item">
                                        <h5>Kecamatan</h5>
                                        <p>{{ $namakec }}</p>
                                    </div>

                                </div>
                            </div>
                            <div class="box-item">
                                <h4>Administratif</h4>
                                <div class="operation-item">
                                    <h5>Kepala Desa</h5>
                                    <p>{{ $profildesa['kades'] }}</p>
                                </div>
                                <div class="operation-item">
                                    <h5>No Kontak</h5>
                                    <p>{{ $profildesa['no_hp'] }}</p>
                                </div>
                            </div>
                        </div>
                        @if(isset($profildesa->penduduk))
                         @foreach($profildesa->penduduk as $penduduk)
                         <h4> {{ $penduduk->data_tahun_pend }}</h4>
                            <div class="box-inline has-two">
                                <div class="box-item">
                                    <h4>Kependudukan</h4>
                                    <div class="county-operation-item">
                                        <div class="operation-item">
                                            <h5>Jumlah Penduduk</h5>
                                            <p>{{ $penduduk['jum_penduduk'] }} org</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Jumlah KK</h5>
                                            <p>{{ $penduduk['jum_kk'] }} KK</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Jumlah Pria</h5>
                                            <p>{{ $penduduk['jum_pria'] }} org</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Jumlah Wanita</h5>
                                            <p>{{ $penduduk['jum_wanita'] }} org</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-item">
                                    <h4>Pendidikan</h4>
                                    <div class="county-operation-item">
                                            <div class="operation-item">
                                                    <h5>Tidak Sekolah</h5>
                                                    <p>{{ $penduduk['tdk_sekolah'] }} org</p>
                                                </div>
                                        <div class="operation-item">
                                            <h5>Lulusan SD</h5>
                                            <p>{{ $penduduk['lulus_sd'] }} org</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Lulusan SMP</h5>
                                            <p>{{ $penduduk['lulus_smp'] }} org</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Lulusan SMU</h5>
                                            <p>{{ $penduduk['lulus_smu'] }} org</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Lulusan S1</h5>
                                            <p>{{ $penduduk['lulus_s1'] }} org</p>
                                        </div>
                                        <div class="operation-item">
                                            <h5>Lulusan S2</h5>
                                            <p>{{ $penduduk['lulus_s2'] }} org</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                        @else
                            <div class="box-inline">
                                <div class="text-center">Data Penduduk Masih Kosong</div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                        <div class="county-operation">
                                <div class="box-inline">
                                    <h4>LOKASI</h4>
                                    <div class="box-item">
                                    </div>
                                </div>
                        </div>

                </div>
            </div>
            <div class="county-operation lite">
                <div class="box-inline has-two">
                    <div class="box-item">
                            <h4>Penghargaan</h4>
                        @if(isset($penghargaan))
                            @foreach($penghargaan as $prg)
                                <div class="box-count">
                                    <img src="images/noimage.jpg" alt="">
                                    <div class="count-item">
                                        <span class="numeric">Juara Desa Wisata Nasional ke-2 </span>
                                    </div>
                                    {{-- <div class="count-item">
                                        <span class="numeric">1000</span> Jumlah Tenaga Kerja
                                    </div> --}}
                                </div>
                                <p>
                                Penghargaan dari Menteri Pariwisata dan Kebudayaan Republik Indonesia
                                </p>
                            @endforeach
                        @else
                        <div class="text-center">Data Penghargaan masih kosong</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- end single page dashboard -->
 @else
<p class="text-center">Data Tidak Ditemukan</p>
@endif
</div>
@endsection
