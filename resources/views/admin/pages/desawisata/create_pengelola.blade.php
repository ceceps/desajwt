@extends('admin.layouts.layout_admin') @php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('style')
    <link href="{{ asset('styles/jquery-ui-bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('scripts/lib/colorbox/example3/colorbox.css')  }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('scripts/lib/formvalidation/css/formValidation.min.css')  }}">
    <style>
        .form-control-feedback{
            color:read;
        }
        #progress { position:relative; width:300px;color:#111; border: 1px solid #ddd; padding: 1px; border-radius: 3px;display: none; }
    </style>
@endsection

@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">
                <h3>{!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ url('dashboard.index') }}">
                                <i class="mdi mdi-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('desawisata.index') }}">
                                <i class="mdi mdi-chevron-right"></i>
                                Desa Wisata
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('desawisata.create') }}">
                                <i class="mdi mdi-chevron-right"></i>
                               Tambah Data Desa Wisata
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
<div class="dashboard-wizard" style="padding-left:20px">
    <ul class="submit-steps">
        <li>Profil Desa Wisata </li>
        <li class="active">&raquo;Pengelola</li>
        <li>Atraksi</li>
        <li>Aksesibilitas</li>
        <li>Fasilitas</li>
        <li>Promosi</li>
        <li>Kelompok Sosial</li>
        <li>Usaha Pariwisata</li>
        <li>Statistik</li>
        <li>Bantuan</li>
        <li>Penghargaan</li>
    </ul>
    @include('admin.partial.message')
    <form  method="POST" id="formcreatepengelola" class="form-custom has-category repeater" role="form" enctype="text/plain" autocomplete="off">
        @csrf
        @include('admin.pages.desawisata.form.pengelola_create')
        <input type="button" class="btn btn-default" value="Kembali" onclick="location.href='{{ route('desawisata.create',$idprofil) }}'">
        <input type="submit" class="btn btn-info" value="Simpan & lanjut">
    </form>
</div>
@endsection

@section('script')
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
<script>
       $(function($){
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var desawisataID ='';


        $('.tgl').datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true
        });
            $('#formcreatepengelola').formValidation({
                                                        framework: 'bootstrap4',
                                                        icon: {
                                                            valid: '',
                                                            invalid: '',
                                                            validating: ''
                                                        },
                                                        fields: {
                                                            nama_pengelola: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Nama Pengelola diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            pimpinan: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Nama Pimpinan diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            no_hp: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'No HP Pimpinan diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            kontak_person: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Kontak Person diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            jabatan: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Jabatan Kontak Person diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            nohp_cp: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'No HP Kontak Person diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            email: {
                                                                validators:{
                                                                    emailAddress: {
                                                                        message: 'Alamat email harus dengan format benar'
                                                                    }
                                                                }
                                                            },
                                                            website: {
                                                                validators: {
                                                                    uri: {
                                                                        message: 'Masukkan alamat Website diawali http'
                                                                    }
                                                                }
                                                            },
                                                            jum_pengurus: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Jumlah diperlukan'
                                                                    }
                                                                }
                                                            },
                                                        }
                                                    }).on('success.form.fv', function (e) {
                                                        e.preventDefault();
                                                        var $form = $('#formcreatepengelola'),
                                                            formData = new FormData(),
                                                            params = $form.serializeArray();
                                                        $.each(params, function (i, val) {
                                                            formData.append(val.name, val.value);
                                                        });
                                                    $.ajax({
                                                            url: '{{ route('desawisata.store.pengelola',$idprofil) }}',
                                                            data: formData,
                                                            type: 'post',
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false,
                                                            success: function (dt) {
                                                                if (dt.errors == false ) {
                                                                    window.location.href = '{{ route('desawisata.create.atraksi',$idprofil) }}';
                                                                } else {
                                                                    console.log(dt);
                                                                    // let errors = $.parseJSON(dt.errors);
                                                                    // $.each(errors,function(i,ds){
                                                                    //     console.log(ds);
                                                                    // });

                                                                    Swal.fire({
                                                                        title: 'Terdapat Kesalahan',
                                                                        text: dt.errors,
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonText: 'Coba Lagi',
                                                                        cancelButtonText: 'Batal',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: true
                                                                        }).then((result) => {
                                                                            window.location.href = '{{ route('desawisata.create.pengelola',$idprofil) }}';
                                                                        });
                                                                    return false;
                                                                }
                                                            },
                                                            error: function(dt){
                                                                Swal.fire({
                                                                        title: 'Terdapat Kesalahan',
                                                                        text: dt.message,
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonText: 'Coba Lagi',
                                                                        cancelButtonText: 'Batal',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: true
                                                                        }).then((result) => {
                                                                            window.location.href = '{{ route('desawisata.create.pengelola',$idprofil) }}';
                                                                        });
                                                                    return false;
                                                            }
                                                         });
                });
    });
</script>

@endsection
