@extends('admin.layouts.layout_admin') @php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('style')

<link href="{{ asset('styles/jquery-ui-bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('scripts/lib/colorbox/example3/colorbox.min.css')  }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('scripts/lib/formvalidation/css/formValidation.min.css')  }}">
<style>
.form-control-feedback{
    color:read;
}


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
                {!! date('d-m-Y H:i:s') !!}
            </div>
        </div>
    </div>
</div>
<!-- end top dashboard -->
@endsection

@section('content')
<div class="dashboard-wizard" style="padding-left:20px">
    <ul class="submit-steps">
        <li class="active">&raquo; Profil Desa Wisata </li>
        <li >Pengelola</li>
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
    <form id="formdesawisataprofil" class="form-custom has-category repeater" action="{{ route('desawisata.storeprofile') }}" data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
        @csrf
        <div id="pesan"></div>
        @include('admin.pages.desawisata.form.profil_create')
        <!-- untuk progress bar -->
            <div id="progress"></div>

        <button class="btn"  id="kembali" onclick="location.href='{{ route('desawisata.index') }}'">Kembali</button>
        <input type="submit" class="btn btn-success" value="Simpan & Lanjutkan" id="save_next">
        <input type="submit" class="btn btn-info" value="Simpan & Kembali" id="save_back">
        <div class="spinner-border text-dark" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </form>
</div>
<br>
<br>
@endsection

@section('script')
{{-- <script src="{{ asset('scripts/lib/select2.full.min.js')}}"></script> --}}
<script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
<script src="{{ asset('scripts/lib/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
{{-- <script src="{{ asset('scripts/lib/jquery.form.js') }}"></script> --}}
<script>
       $(function($){
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var desawisataID ='';
    tinymce.init({
        selector: '#editor',
        height: 300,
        menubar: false,
        file_browser_callback : elFinderBrowser,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],

        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
            '{{ asset('styles/fonts.css') }}',
            '{{ asset('styles/codepen.min.css') }}']
    });


    function elFinderBrowser (field_name, url, type, win) {
            tinymce.activeEditor.windowManager.open({
                file: '{!! route('elfinder.tinymce4') !!}',// use an absolute path!
                title: 'Media Browser',
                width: 800,
                height: 440,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                    win.document.getElementById('nama_file').text = url;
                }
            });
            return false;
    }

        $('.tgl').datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true,
            setDate: new Date(),
            maxDate: new Date()
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
                                value: value.id
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
                return false;
            }
        });

        $('#fotodesawisata').change(function(){
                readURL(this,'#imgpreview');
        });

        $('.select2').select2({
            placeholder: 'Pilih Kategori',
            autoClose : true
        });

        $('.save_next').on('click',function(){
            $('#formdesawisataprofil').formValidation({
                                                        framework: 'bootstrap4',
                                                        icon: {
                                                            valid: '',
                                                            invalid: '',
                                                            validating: ''
                                                        },
                                                        fields: {
                                                            nama_desawisata: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'nama_desawisata diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            idcat: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Kategori diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            tahun_berdiri: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Tahun Berdiri diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            tahun_berdiri: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Tahun Berdiri diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            deskripsi: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Deskripsi diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            kelurahan: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Kelurahan diperlukan'
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }).on('success.form.fv', function () {
                                                        //e.preventDefault();
                                                        // var $form = $(e.target),
                                                        //     formData = new FormData(),
                                                        //     params = $form.serializeArray();
                                                        // $.each(params, function (i, val) {
                                                        //     formData.append(val.name, val.value);
                                                        // });
                                                    //     var files = $('#fotodesawisata')[0].files[0];
                                                    //     formData.append('file',files);
                                                          // add assoc key values, this will be posts values
                                                        // $.ajax({
                                                        //     url: storeDesaWisataProfilUrl,
                                                        //     data: formData,
                                                        //     type: 'post',
                                                        //     cache: false,
                                                        //     contentType: false,
                                                        //     processData: false,
                                                        //     beforeSend: function()
                                                        //     {
                                                        //         $("#progress").show();
                                                        //         $("#bar").width('0%');
                                                        //         $("#message").html("");
                                                        //         $("#percent").html("0%");
                                                        //         $("#upload-gambar").attr("disabled",""); // Membuat button upload jadi tidak bisa terklik
                                                        //     },
                                                        //     success: function (dt) {
                                                        //         $("#progress").hide();
                                                        //         if (dt.error == false) {
                                                        //             Swal.fire({
                                                        //                 title: 'Berhasil',
                                                        //                 text: dt.message,
                                                        //                 type: 'success',
                                                        //                 showCancelButton: true,
                                                        //                 confirmButtonText: 'OK',
                                                        //                 cancelButtonText: 'Batal',
                                                        //                 cancelButtonClass: 'cancel-class',
                                                        //                 showCancelButton: true,
                                                        //                 closeOnConfirm: false,
                                                        //                 }).then((result) => {
                                                        //                     window.location.href = base_url + '/backend/desawisata/'+dt.idprofil+'/createpengelola';
                                                        //                 });
                                                        //         } else {
                                                        //             Swal.fire({
                                                        //                 title: 'Terdapat Kesalahan',
                                                        //                 text: dt.message,
                                                        //                 type: 'warning',
                                                        //                 showCancelButton: true,
                                                        //                 confirmButtonText: 'Coba Lagi',
                                                        //                 cancelButtonText: 'Batal',
                                                        //                 cancelButtonClass: 'cancel-class',
                                                        //                 showCancelButton: true,
                                                        //                 closeOnConfirm: true
                                                        //                 }).then((result) => {
                                                        //                     window.location =  base_url + '/backend/desawisata/create';
                                                        //                 });
                                                        //             return false;
                                                        //         }
                                                        //     },
                                                        //     error: function(){
                                                        //         Swal.fire({
                                                        //                 title: 'Terdapat Kesalahan',
                                                        //                 text: "Terjadi Kesalahan Jaringan, Coba Hubungi Sistem Administrator",
                                                        //                 type: 'warning',
                                                        //                 showCancelButton: true,
                                                        //                 confirmButtonText: 'Coba Lagi',
                                                        //                 cancelButtonText: 'OK',
                                                        //                 cancelButtonClass: 'cancel-class',
                                                        //                 showCancelButton: false,
                                                        //                 closeOnConfirm: true
                                                        //                 }).then((result) => {
                                                        //                     window.location =  base_url + '/backend/desawisata/create';
                                                        //                 });
                                                        //     }
                                                        // });
                                                    });

        });
    });
</script>

@endsection
