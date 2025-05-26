@extends('admin.layouts.layout_admin')
@php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp

@section('style')
<link href="{{ asset('styles/jquery-ui-bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">

                <h3>{!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>

                <!-- for single action page remove this breadcrumb-->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="mdi mdi-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-right"></i>
                            <a href="{{ route('backend.user.index') }}">
                                Manajemen Pengguna
                            </a>
                        </li>

                        <li>
                            <i class="mdi mdi-chevron-right"></i> {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                        </li>
                    </ul>
                </nav>

            </div>
            <div class="top-option">
                {!! date('d-m-Y') !!}
            </div>
        </div>
    </div>
</div>
<!-- end top dashboard -->
@endsection
@section('content')
    <!-- begin single page dashboard -->
    <div class="dashboard-single">
        @if(isset($profil))
            @php
                $url = isset($profil->userProfil->avatar)?Storage::url('avatar/'.$profil->userProfil->avatar):'';
                $foto = @getimagesize($url)!=false?$url:Storage::url('avatar/user.png');

            @endphp
            <div class="profile-page">
                    <div class="profile-left">
                        <div class="profile-left-inner">
                            <div class="top-profile">
                            <div class="profile-image">
                            <img src="{{ asset($foto) }}" alt="Foto Profil" class="img-fluid" id="img-avatar">
                            </div>
                            <div class="user-name">
                            <h3>{{ $profil->name }}</h3>
                                <h5>{{ $roles!=''?ucwords($roles):__('N/A') }}</h5>
                            </div>
                            <div class="user-contribute">
                                <ul class="list-unstyled">
                                    <li>
                                    <span class="numeric">{{ $jumDesaWisata }}</span> Desa Wisata
                                    </li>
                                    <li>
                                    <span class="numeric">{{ $jumArtikel }}</span> Artikel
                                    </li>
                                </ul>
                            </div>
                            </div>
                            <div class="mid-profile">
                            <div class="profile-activity">
                                <h4>Aktifitas</h4>
                                <div class="activity-list">
                                <div class="activity-entry">
                                    <i class="icon icon-ribbon"></i>
                                    <div class="activity-text">
                                    <h5>Terakhir Login</h5>
                                {{ $lastlogin }}
                                    </div>
                                </div>
                                </div>
                                <div class="activity-list">
                                <div class="activity-entry">
                                    <i class="icon icon-contract"></i>
                                    <div class="activity-text">
                                    <h5>Artikel Terakhir</h5>
                                {{ $postArtikelTerakhir }}
                                    </div>
                                </div>
                                </div>
                                <div class="activity-list">
                                    <div class="activity-entry">
                                            <i class="icon icon-contract"></i>
                                        <div class="activity-text">
                                        <h5>Desa Wisata Terakhir</h5>
                                        {{ $postDesaWisataTerakhir }}
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-list">
                                    <div class="activity-entry">
                                            <i class="icon icon-contract"></i>
                                        <div class="activity-text">
                                        <h5>Data Profil Desa  Terakhir</h5>
                                        {{ $postDesaTerakhir }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-right">
                    <div class="account-detail">
                        <h3>Data Personal</h3>
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                <strong>Kesalahan</strong>
                                <ul>
                                    @foreach (session('error') as $msg)
                                        <li>{{ $msg }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('backend.user.update') }}" method="POST" enctype="multipart/form-data"  class="profile-form form-default">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group">
                            <label class="control-label">
                            Nama Lengkap
                            </label>
                            <input type="text" class="form-control" contenteditable="true" name="name" value="{{ $profil->name }}">
                        </div>
                        <div class="form-group">
                            <div class="fieldset has-two">
                                <div class="fieldset-item">
                                        <input type="password" class="form-control" placeholder="Password" contenteditable="true" name="password">
                                </div>
                                <div class="fieldset-item">
                                        <input type="password" class="form-control" placeholder="Konfirmasi Password" contenteditable="true" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                            Email
                            </label>
                            <input type="email" class="form-control" contenteditable="true" name="email" value="{{ $profil->email }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label">
                            Biografi Singkat
                            </label>
                            <textarea class="form-control col-5 col-xs-12" rows="5" contenteditable="true" name="bio" placeholder="catatan singkat pribadi Anda">{{ $profil->userProfil['bio'] }}</textarea>
                        </div>
                        <div class="form-group">
                                <label class="control-label">
                                Alamat
                                </label>
                                <textarea class="form-control" contenteditable="true" name="alamat">{{ $profil->userProfil['alamat'] }}</textarea>
                            </div>
                            <div class="form-group">
                                    <label class="control-label">
                                    Telp
                                    </label>
                                    <input type="text" class="form-control" contenteditable="true" name="telp" value="{{ $profil->telp }}">
                                </div>
                        <div class="form-group">
                                <label class="control-label">Desa/Kelurahan</label>
                                <input type="text" name="kelurahan_nama" id="kelurahan_nama" class="form-control" value="{{ isset($profil->userProfil->kelurahan->nama)?$profil->userProfil->kelurahan->nama:'' }}">
                                <input type="hidden" name="kel_id" id="kelurahan_id" value="{{ isset($profil->userProfil->kelurahan->id)?$profil->userProfil->kelurahan->id:'' }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Kecamatan</label>
                            <input type="text" name="kecamatan_nama" id="kecamatan_nama" class="form-control" value="{{ isset($profil->userProfil->kelurahan->kecamatan->nama)?$profil->userProfil->kelurahan->kecamatan->nama:'' }}" readonly>
                            <input type="hidden" name="kec_id" id="kecamatan_id" value="{{ isset($profil->userProfil->kelurahan->kecamatan->id)?$profil->userProfil->kelurahan->kecamatan->id:'' }}">
                        </div>
                        <div class="form-group">
                                <label class="control-label">Kabupaten</label>
                                <input type="text" name="kabupaten_nama" id="kabupaten_nama" class="form-control" value="{{ isset($profil->userProfil->kelurahan->kecamatan->kabupaten->nama)?$profil->userProfil->kelurahan->kecamatan->kabupaten->nama:'' }}" readonly>
                                <input type="hidden" name="kab_id" id="kabupaten_id" value="{{ isset($profil->userProfil->kelurahan->kecamatan->kabupaten->id)?$profil->userProfil->kelurahan->kecamatan->kabupaten->id:'' }}">
                            </div>
                        <div class="form-group">
                            <label for="changephoto" class="control-label">Ubah Foto</label>
                            <input type="file" class="form-control" id="changephoto" name="avatar">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                           <select name="status" id="status" class="form-control">
                               <option value="">--Status--</option>
                               <option value="0" {{ $profil->status==0?'selected':'' }}>Tidak Aktif</option>
                               <option value="1" {{ $profil->status==1?'selected':'' }}>Aktif</option>
                               <option value="2" {{ $profil->status==2?'selected':'' }}>Diblokir</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Hak Akses</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">--Pilih Hak Akses--</option>
                                    @foreach ($hakroles as $key => $value)
                                    <option value="{{  $value }}" {{ ( $value == $roles) ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                  @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default end">Update</button>
                        <input type="hidden" name="id" value="{{ $profil->id }}">
                        </form>
                    </div>
                    </div>
                </div>
        @else
            <div class="profile-page">
                <div class="text-center">Data Profil Masih Kosong</div>
            </div>
        @endif

    </div>
     <!-- end single page dashboard -->
@endsection

@section('script')
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script>
    $(function($){

        $('#changephoto').change(function(){
            readURL(this,'#img-avatar');
        });

        $('select-roles').select2({
            placeholder:'Pilih Hak Akses',
            allowClose: true
        });

        $("#kelurahan_nama").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "{!! $urlApiKelurahan !!}",
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response($.map(data.kelurahan, function (value, key) {
                        return {
                            label: value.nama,
                            value: value.id,
                            kec_id: value.kec_id,
                            kab_id: value.kab_id,
                        };
                    }));
                }
            });
        },
        minLength: 1,
        select: function(event, ui){
            let adm = ui.item.label;
            adm = adm.split(',');
            let kel = adm[0];
            let kec = adm[1];
            let kab = adm[2];

            $('#kelurahan_nama').val(kel);
            $('#kecamatan_nama').val(kec);
            $('#kabupaten_nama').val(kab);

            $('#kelurahan_id').val(ui.item.value);
            $('#kecamatan_id').val(ui.item.kec_id);
            $('#kabupaten_id').val(ui.item.kab_id);
            return false;
        }
    });


    });
 </script>
@endsection

