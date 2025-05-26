@extends('admin.layouts.layout_admin')
@php header("Cache-Control", "no-cache, no-store, must-revalidate");
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
        <li>Profil Desa Wisata </li>
        <li>Pengelola</li>
        <li class="active">&raquo;Atraksi</li>
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
    <form id="formcreatefasilitas" class="form-custom has-category repeater" action="{{ $url }}" role="form" method="post" enctype="multipart/form-data">
        @csrf
        <div id="pesan"></div>
        @include('admin.pages.desawisata.form.atraksi')
        <div style="padding-left:20px">
                <button type="button" onclick="location.href='{{ route('desawisata.create.pengelola',$idprofil) }}'" class="btn">Kembali</button>
                <button type="submit" onclick="location.href='{{ route('desawisata.create.akses',$idprofil) }}'" class="btn btn-info">Simpan & Lanjut</button>
        </div>

    </form>
    <div style='display:none'>
            <div id='inline_content' style='padding:10px; background:#fff;'>
            <form action="" class="form-horizontal" action="{{ route('desawisata.store.mediaatraksi',$idprofil) }}">
                    <div class="form-group">
                        <label for="Title" class="control-label">Judul Foto</label>
                        <input type="text" id="title-atraksi-alam" name="title_foto_atraksi" value="" class="form-control" placeholder="Judul Foto">
                    </div>
                </form>
            </div>
        </div>
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
<script src="{{ asset('scripts/lib/bootbox.min.js') }}"></script>
<script>
    $(function($){
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var desawisataID ='';
        var iAlam = 1;
        var iBudaya = 1;
        var iBuatan = 1;

        $('.select-atraksi-alam').select2({
            placeholder: 'Pilih Kategori', allowClear: true
        });

        $("select.select-dayatarik").change(function(){
            var id = $(this).val();
            $(".select-atraksi-alam").empty().trigger("change");
            if(id!=null){
                $('.select-atraksi-alam').select2({
                    placeholder: 'Pilih Kategori', allowClear: true,
                    ajax: {
                        url: '/api/v1/getcomboatraksi/'+id,
                        data: function (params) {
                                var query = {
                                search: params.term,
                            }
                            return query;
                        },
                        processResults: function (data) {
                                return {
                                results: data
                                };
                        },
                    }
                });
            }
        });


        $('#fotodesawisata').change(function(){
                readURL(this,'#imgpreview');
        });

        $('.select-dayatarik').select2({
            placeholder: "Pilih Daya Tarik",
            autoClose: true
        });


        //load table atraksi jika sdh ada data

        var loadTable = function(){
            $.get('{{ route('desawisata.get.atraksi',$idprofil) }}',function(data){
                if(data.error==false){
                    let row = '';
                    $.each(data.atraksi,function(i,dx){
                        row += '<tr>';
                    row += '<td data-id="'+dx.id+'" data-atraksi_id="'+dx.atraksi_id+'" >'+dx.title+'</td>';
                    row += '<td>'+dx.tipe+'</td>';
                    row += '<td>'+dx.kategori+'</td>';
                    row += '<td>';
                    if($.type(dx.foto)==='array'){
                    row += '<a class="inline" class="btn btn-info btn galerfoto" data-idatraksi="'+dx.atraksi_id+'" href="#inline_content">Galeri</a>';
                    }else
                        row += '-';
                    row += '</td>';

                    row += '<td>';

                    if($.isArray(dx.video)){
                        $.each(dx.video,function(j,dv){
                            row += '<a class="inline" class="btn btn-info btn galerivideo" data-idatraksi="'+dx.atraksi_id+'" href="#inline_content">Galeri</a>';
                    });
                    }else
                        row += '-';
                    row += '</td>';
                    row +='<td><a href="#" class="badge badge-pill badge-info">Edit</a>  <a href="#" class="badge badge-pill badge-danger">Hapus</a></td>';

                    row += '</tr>';
                });
                $('tbody').empty().html(row);
                $(".foto-atraksi").colorbox({rel:"foto-atraksi",width:"55%", height:"67%"});
                }
            });
        }

        //baca table
        loadTable();

        $('#formcreatefasilitas').formValidation({
                                                        framework: 'bootstrap4',
                                                        icon: {
                                                            valid: '',
                                                            invalid: '',
                                                            validating: ''
                                                        },
                                                        fields: {
                                                            daya_tarik: {
                                                                row: '.form-category-entry',
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Jarak dari Provinsis diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            atraksi_id: {
                                                                row: '.form-category-entry',
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Kategori  diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            title: {
                                                                row: '.form-category-entry',
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Nama atraksi diperlukan'
                                                                    },
                                                                    remote: {
                                                                        url: "{{ route('desawisata.cek.namaatraksi',$idprofil) }}",
                                                                        type: "POST",
                                                                        data: {
                                                                            'title': $('#title').val(),
                                                                            'atraksi_id': $("select.select-atraksi-alam").val(),
                                                                        },
                                                                        message:'Nama Atraksi sudah ada'
                                                                    }
                                                                }
                                                            },
                                                            foto_atraksi: {
                                                                row: '.form-category-entry',
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Foto Atraksi diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            // video_atraksi: {
                                                            //     row: '.form-category-entry',
                                                            //     validators: {
                                                            //         notEmpty: {
                                                            //             message: 'Video Atraksi diperlukan'
                                                            //         }
                                                            //     }
                                                            // },
                                                            keterangan:{
                                                                row: '.form-category-entry',
                                                                validator:{
                                                                    notEmpty: {
                                                                        message: 'Keterangan harus diisi'
                                                                    },
                                                                    regexp: {
                                                                        regexp: /^[a-z0-9 ,\s.-]+$/i,
                                                                        message: 'Profile Singkat hanya berformat Huruf, Angka , titik dan minus Saja'
                                                                    }
                                                                },
                                                                callback: {
                                                                    message: 'Panjang karakter Keterangan maksimal 255',
                                                                    callback: function(value, validator, $field) {
                                                                        if (value === '') {
                                                                           return true;
                                                                        }
                                                                        // Get the plain text without HTML
                                                                        var div  = $('<textarea/>').html(value).get(0),
                                                                           text = div.textContent || div.innerText;
                                                                        return text.length <= 255;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }).on('success.form.fv', function (e) {
                                                        e.preventDefault();
                                                        var $form = $(e.target),
                                                            formData = new FormData(),
                                                            params = $form.serializeArray();
                                                        $.each(params, function (i, val) {
                                                            formData.append(val.name, val.value);
                                                        });
                                                    //     var files = $('#fotodesawisata')[0].files[0];
                                                    //     formData.append('file',files);
                                                          // add assoc key values, this will be posts values
                                                        $.ajax({
                                                            url: '{{ route('desawisata.store.atraksi',$idprofil) }}',
                                                            data: formData,
                                                            type: 'post',
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false,
                                                            success: function (dt) {
                                                                $("#progress").hide();
                                                                console.log(dt);
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
                                                                            loadTable();
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
                                                                            console.log(result);
                                                                            window.location = '{{ route('desawisata.create.atraksi',$idprofil) }}';
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
                                                                        cancelButtonText: 'OK',
                                                                        cancelButtonClass: 'cancel-class',
                                                                        showCancelButton: false,
                                                                        closeOnConfirm: true
                                                                        }).then((result) => {
                                                                            window.location =  '{{ route('desawisata.create.atraksi',$idprofil) }}';
                                                                        });
                                                            }
                                                        });
                                                    });
    });
</script>

@endsection
