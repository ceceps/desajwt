@extends('admin.layouts.layout_admin')
@php
    header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp

@section('topbar')
    <!-- begin top dashboard -->
    <div class="dashboard-top">
        <div class="container-fluid">
            <div class="top-entry">
                <div class="top-status">
                    <h3>{!! isset($title_page)?$title_page:'&nbsp'; !!}</h3>
                    <!-- for single action page remove this breadcrumb-->
                    <nav class="dashboard-breadcrumb">
                        <ul class="list-unstyled">
                            <li>
                                <a href="index.html">
                                    <i class="mdi mdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <i class="mdi mdi-chevron-right"></i>
                                {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="top-option">
                    {!! date('d-m-Y H:i:s') !!}
                </div>
            </div>
        </div>
    </div>
    <!-- end top dashboard -->
@endsection

@section('content')
    <!-- begin dashboard content -->
    <div class="dashboard-content">
        <div class="dashboard-inner-entry">
            <div class="container-fluid">
                <div class="panel-title has-option">
                    <div class="top-option">
                        <form method="get" class="form-inline" id="filter_desawisata">
                            @csrf
                            <div class="form-grup">
                            <input type="text" name="cari" id="cari" class="form-control col-sm-4 col-md-6"  placeholder="Cari Desa Wisata" value="{!! isset($filter['cari'])?$filter['cari']:'' !!}">
                                &nbsp;
                                <select name="kabupaten" id="kabupaten_id" class="form-control select-kabupaten">
                                        <option value="all">-- Semua Kabupaten --</option>
                                        @php $pilih = ''; @endphp
                                        @if(isset($kabupaten))
                                            @foreach ($kabupaten as $kab)
                                                @if(isset($filter['kabupaten_id']))
                                                    @if($filter['kabupaten_id'] == $kab->id  )
                                                        @php $pilih = 'selected'; @endphp
                                                    @else
                                                        @php $pilih = ''; @endphp
                                                    @endif
                                                @endif
                                                <option value="{{ $kab->id }}" {{ $pilih }} data-kodepeta="{{ $kab->kode_peta }}">{{ ucwords(strtolower($kab->nama)) }}</option>

                                            @endforeach
                                        @endif
                                    </select>
                                     &nbsp;
                                <select name="kategori" id="kategori_id" class="form-control">
                                        <option value="all">-- Semua Kategori --</option>
                                        <option value="1" {{ ($filter['kategori_id'] == 1)?'selected':'' }}>Embrio</option>
                                        <option value="2" {{ ($filter['kategori_id'] == 2)?'selected':'' }}>Berkembang</option>
                                        <option value="3" {{ ($filter['kategori_id'] == 3)?'selected':'' }}>Maju</option>
                                </select>
                               <button type="submit" class="btn btn-xs btn-info btn-clean active"><i class="mdi mdi-filter"></i></button>
                            </div>
                        </form>
                        <a href="{{ url('backend/desawisata/create') }}" class="btn btn-brand btn-add">
                            <i class="mdi mdi-plus"></i> Tambah Desa Wisata
                        </a>
                        <div class="button-group">
                            <button class="btn btn-clean btn-list" type="button">
                            <i class="mdi mdi-view-list"></i>
                        </button>
                            <button class="btn btn-clean btn-grid active" type="button">
                            <i class="mdi mdi-view-grid"></i>
                        </button>
                        </div>
                    </div>
                    <div>
                         {{ __('Total: '.$jumData) }}
                    </div>
                </div>
                @if(isset($desawisata) && count($desawisata)>0)
                <div class="grid-list" id="gridkonten">
                    @foreach($desawisata as $data)
                        @if(count($data['media'])>0)
                            @foreach($data['media'] as $mds)
                                @php if($mds['parent_media']==1) $foto = public_path(config('desawisata.PATH_IMAGE_DESAWISATA').'/thumb/'.$mds['filename'])!=false?'storage/data-desawisata/thumb/'.$mds['filename']:'images/noimage.jpg'; @endphp
                            @endforeach
                        @else
                        @php $foto = 'images/noimage.jpg'; @endphp
                        @endif
                        @php
                            $linkDetil = route('desawisata.show',$data->slug);
                            $linkEdit = '';
                            $linkDelete = '';
                        @endphp
                                <div class="item-thumbnail">
                                        <div class="item-detail">
                                            <div class="top-thumbnail">
                                                <div class="thumbnail-title">
                                                    <h3>{{ $data['nama_desawisata'] }}</h3>
                                                </div>
                                                <img src="{{ asset(isset($foto)?$foto: 'images/noimage.jpg') }}" alt="" class="img-fluid">
                                            </div>
                                            <div class="item-detail-text">
                                                <p> <small>Kategori: {{ ucwords(strtolower($data->category['catname'])) }} &nbsp; &nbsp;  Kab/Kota: {{ ucwords(strtolower($data->kelurahan->kecamatan->kabupaten['nama'])) }}</small><br>
                                                {{ str_replace('&nbsp;',' ',strip_tags(substr($data['deskripsi'],0,50))) }}
                                                </p>
                                            </div>
                                            <div class="item-option">
                                                <div class="button-group">
                                                    <button type="button" class="btn btn-default" onclick="location.href='{{ $linkDetil }}'">Detil</>
                                                     @if($data['status']!=2)
                                                        <button type="button" class="btn btn-default btn-edit" data-toggle="modal" data-target="#modelId" data-proid="{{ $data['id'] }}">Edit</button>
                                                     @endif
                                                    <button type="button" class="btn btn-default btn-delete">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        @endforeach
                </div>
                {{ $desawisata->withPath($current_url) }}

                @else
                <div class="panel white" id="gridkonten">
                        {{-- <div class="item-thumbnail"> --}}
                            <div class="text-center"><strong>{{ __('Desa Wisata Tidak Ada') }}</strong></div>
                        {{-- </div> --}}
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- end dashboard content -->
     @include('admin.pages.desawisata.form.modaledit')
@endsection

@section('script')
<script src="{{ asset('scripts/lib/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
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
           $(document).on('click','.btn-delete',function(){
                bootbox.confirm({
                    message: "Apakah Anda akan menghapus Desa Wisata ini ?",
                    buttons: {
                        confirm: {
                            label: 'Ya',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'Tidak',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) {
                         alert('Response '+result);
                    }
                });
           });
        });
    </script>
@endsection
