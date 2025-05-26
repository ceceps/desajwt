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
<div class="dashboard-wizard" style="padding:10px">
        <ul class="submit-steps">
                <li>Profil Desa Wisata </li>
                <li>Pengelola</li>
                <li>Atraksi</li>
                <li>Aksesibilitas</li>
                <li>Fasilitas</li>
                <li>Promosi</li>
                <li>Kelompok Sosial</li>
                <li>Usaha Pariwisata</li>
                <li>Statistik</li>
                <li>Bantuan</li>
                <li class="active">&raquo;Penghargaan</li>
            </ul>
    <form action="{{ $url }}" method="POST" id="formcreatepromosi" class="form-custom has-category repeater" role="form" enctype="text/plain" autocomplete="off">
        @csrf
        @include('admin.pages.desawisata.form.penghargaan')

        <input type="button" class="btn btn-default" value="Kembali" onclick="javascript:location.href='{{ route('desawisata.create.kelsos',$idprofil) }}'">
        <input type="submit" class="btn btn-info" value="Simpan & Selesai">
    </form>
</div>

@endsection
@section('script')
<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.min.js') }}"></script>
<script src="{{ asset('scripts/lib/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
<script>
   $(function($){
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
    var desawisataID ='';
    $('.isada').change(function() {
        if (this.value == '1') {
            console.log(this.value);
            $('.note').attr('disable','').attr('style','color:white');
        }
        else if (this.value == 0) {
            $('.note').attr('disable','').attr('style','color:white');
        }
    });
    let iRow = 1;
    let rowuspar = '<tr><td>'+ iRow+'</td>'+
                         '<td>'+ +'</td>';
                         '<td>'+ +'</td>';
                         '<td>'+ +'</td>';
                         '<td>'+ +'</td>';
                         '<td>'+ +'</td>';
                         '<td>'+ +'</td>';
                    </tr>';

            $('#formcreatepromosi').formValidation({
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
                                                        var $form = $('#formcreatepromosi'),
                                                            formData = new FormData(),
                                                            params = $form.serializeArray();
                                                        $.each(params, function (i, val) {
                                                            formData.append(val.name, val.value);
                                                        });

                                                    $.ajax({
                                                            url: '{{ route('desawisata.store.promosi',$idprofil) }}',
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
                                                                        showCancelButton: true,
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: false,
                                                                        cancelButtonText: 'Batal',
                                                                        confirmButtonText: 'OK',
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            window.location.href = '{!! '/backend/desawisata/createakses/'.$idprofil !!}';
                                                                        });

                                                                } else {
                                                                    //$('#pesan').text(dt.message);
                                                                    Swal.fire({
                                                                        title: 'Terdapat Kesalahan',
                                                                        text: dt.message,
                                                                        type: 'warning',
                                                                        showCancelButton: true,
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: true,
                                                                        cancelButtonText: 'Batal',
                                                                        confirmButtonText: 'Coba Lagi',
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            window.location =  '{{ url()->current() }}';
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
                                                                        confirmButtonText: 'OK',
                                                                        cancelButtonText: 'Batal',
                                                                        showCancelButton: true,
                                                                        cancelButtonClass: 'cancel-class',
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            //window.location = '{{ url()->current() }}';
                                                                            var $form = $('#formcreatepromosi'),
                                                                                formData = new FormData(),
                                                                                params = $form.serializeArray();
                                                                            $.each(params, function (i, val) {
                                                                                formData.append(val.name, val.value);
                                                                            });
                                                                            $.post('{{ route('desawisata.store.promosi',$idprofil) }}',formData,function(res){
                                                                                Swal.fire({text: res});
                                                                            });
                                                                        });
                                                                    return false;
                                                            }
                                                         });
    });
    });
</script>

@endsection
