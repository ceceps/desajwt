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

                <!-- for single action page remove this breadcrumb-->
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
        <li>Pengelola</li>
        <li>Atraksi</li>
        <li class="active">&raquo; Aksesibilitas </li>
        <li>Fasilitas</li>
        <li>Promosi</li>
        <li>Kelompok Sosial</li>
        <li>Usaha Pariwisata</li>
        <li>Statistik</li>
        <li>Bantuan</li>
        <li>Penghargaan</li>
    </ul>
    <form id="formdesawisataakses" class="form-custom has-category repeater" action="{{ $url }}" role="form" method="post" enctype="multipart/form-data">
        @csrf
        <div id="pesan"></div>
        @include('admin.pages.desawisata.form.akses')
        <input type="button" class="btn btn-default" value="Kembali"  onclick="location.href='{{ route('desawisata.create.atraksi',$idprofil) }}'">
        <input type="submit" class="btn btn-info" value="Simpan & Lanjut">
    </form>
</div>

@endsection
@section('script')
<script src="{{ asset('scripts/lib/select2.full.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
<script src="{{ asset('scripts/lib/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
<script src="{{ asset('scripts/lib/jquery.form.js') }}"></script>
<script>
       $(function($){
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var desawisataID ='';
    tinymce.init({
        selector: '.editor',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount '
        ],
        toolbar: ' undo redo |  bold italic | bullist numlist | removeformat ',
        content_css: [
            '{{ asset('styles/fonts.css') }}',
            '{{ asset('styles/codepen.min.css') }}']
    });

        $('#fotodesawisata').change(function(){
                readURL(this,'#imgpreview');
        });

        $('.select2').select2({
            placeholder:'Pilih Satuan',
            autoClose:true
        });

        $('#formdesawisataakses').formValidation({
                                                        framework: 'bootstrap4',
                                                        icon: {
                                                            valid: '',
                                                            invalid: '',
                                                            validating: ''
                                                        },
                                                        fields: {
                                                            jarak_dari_ibukota: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Jarak dari Provinsis diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            satuan_prov: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'satuan  diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            waktu_prov: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Waktu dari Provinsi diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            jarak_dari_kab: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Jarak dari Kab/Kota diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            waktu_kab: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Waktu dari Provinsi diperlukan'
                                                                    }
                                                                }
                                                            },
                                                        }
                                                    }).on('success.form.fv', function (e) {
                                                        e.preventDefault();
                                                        tinyMCE.get('jalur_transport').getContent()
                                                        var $form = $(e.target),
                                                            formData = new FormData(),
                                                            params = $form.serializeArray();
                                                        $.each(params, function (i, val) {
                                                            formData.append(val.name, val.value);
                                                        });
                                                        $.ajax({
                                                            url: '{{ route('desawisata.store.akses',$idprofil) }}',
                                                            data: formData,
                                                            type: 'post',
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false,
                                                            beforeSend: function()
                                                            {
                                                                $("#progress").show();
                                                                $("#bar").width('0%');
                                                                $("#message").html("");
                                                                $("#percent").html("0%");
                                                                $("#upload-gambar").attr("disabled",""); // Membuat button upload jadi tidak bisa terklik
                                                            },
                                                            success: function (dt) {
                                                                $("#progress").hide();
                                                                if (dt.error == false) {
                                                                    Swal.fire({
                                                                        title: 'Berhasil',
                                                                        text: dt.message,
                                                                        type: 'success',
                                                                        confirmButtonText: 'OK',
                                                                        cancelButtonText: 'Batal',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: false,
                                                                        closeOnConfirm: true,
                                                                        }).then((result) => {
                                                                            window.location.href = dt.redirect;
                                                                        });
                                                                } else {
                                                                    Swal.fire({
                                                                        title: 'Terdapat Kesalahan',
                                                                        text: dt.message,
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonText: 'Coba Lagi',
                                                                        cancelButtonText: 'Batal',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: true,
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            window.location =  '{{ route('desawisata.create.akses',$idprofil) }}';
                                                                        });
                                                                    return false;
                                                                }
                                                            },
                                                            error: function(){
                                                                Swal.fire({
                                                                        title: 'Terdapat Kesalahan',
                                                                        text: "Terjadi Kesalahan Jaringan, Coba Hubungi Sistem Administrator",
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonText: 'Coba Lagi',
                                                                        cancelButtonText: 'OK',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: false,
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            window.location =  '{{ route('desawisata.create.akses',$idprofil) }}';
                                                                        });
                                                            }
                                                        });
                                                    });
    });
</script>

@endsection
