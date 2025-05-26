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
                            <a href="{{ route('desawisata.edit',$idprofil) }}">
                                <i class="mdi mdi-chevron-right"></i>
                               Edit Data Desa Wisata
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
    <form action="{{ route('desawisata.update.pengelola',$idprofil) }}" method="POST" id="formeditpengelola" class="form-custom has-category repeater" role="form" enctype="text/plain" autocomplete="off">
        @csrf
        @method('PUT')
        @include('admin.pages.desawisata.form.pengelola_edit')
        <input type="submit" class="btn btn-info" value="Simpan Pengelola">
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
                height: 600,
                resizable: 'yes'
            }, {
                setUrl: function (url) {
                    win.document.getElementById(field_name).value = url;
                }
            });
            return false;
    }

        $('.tgl').datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true
        });
            $('#formeditpengelola').formValidation({
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
                                                                    url: {
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
                                                        var $form = $('#formeditpengelola'),
                                                            formData = new FormData(),
                                                            params = $form.serializeArray();
                                                        $.each(params, function (i, val) {
                                                            formData.append(val.name, val.value);
                                                        });
                                                        formData.append('nama_pengelola', $('[name=nama_pengelola]').val());
                                                        formData.append('email', $('[name=email]').val());
                                                    $.ajax({
                                                            url: '{{ route('desawisata.update.pengelola',$idprofil) }}',
                                                            data: formData,
                                                            type: 'post',
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false,
                                                            success: function (dt) {
                                                                if (dt.error == false) {
                                                                    Swal.fire({
                                                                        title: 'Berhasil',
                                                                        text: dt.message,
                                                                        type: 'success',
                                                                        showCancelButton: false,
                                                                        confirmButtonText: 'OK',
                                                                        cancelButtonText: 'Batal',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            window.location =  base_url + '/backend/desawisata/';
                                                                        });
                                                                } else {
                                                                    //$('#pesan').text(dt.message);
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
                                                                            window.location =  base_url + '/backend/desawisata/editpengelola/{{ isset($idprofil) ?$idprofil:'' }}';
                                                                        });
                                                                    return false;
                                                                }
                                                            },
                                                            error: function(){
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
                                                                            window.location =  base_url + '/backend/desawisata/editpengelola/{{ isset($idprofil) ?$idprofil:'' }}';
                                                                        });
                                                                    return false;
                                                            }
                                                         });
    });
    });
</script>

@endsection
