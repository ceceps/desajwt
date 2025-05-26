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

        .disabled{
            background-color: rgb(238, 238, 238);
        }
    /* #progress { position:relative; width:300px;color:#111; border: 1px solid #ddd; padding: 1px; border-radius: 3px;display: none; } */
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
<div class="dashboard-wizard" style="padding:10px">
    <ul class="submit-steps">
        <li>Profil Desa Wisata </li>
        <li>Pengelola</li>
        <li>Atraksi</li>
        <li>Aksesibilitas</li>
        <li> Fasilitas</li>
        <li>Promosi</li>
        <li>Kelompok Sosial</li>
        <li>Usaha Pariwisata</li>
        <li>Statistik</li>
        <li class="active">&raquo;Bantuan</li>
        <li>Penghargaan</li>
    </ul>
    @include('admin.partial.message')
    <form id="formdesawisataprofil" class="form-custom has-category repeater" action="{{ route('desawisata.store.bantuan',$idprofil) }}" data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
        @csrf
        @include('admin.pages.desawisata.form.bantuan')
        <!-- untuk progress bar -->
        <input type="button" class="btn btn-default" value="Kembali" id="kembali" onclick="javascript:location.href='{{ route('desawisata.create.uspar',$idprofil) }}'">
        <input type="submit" class="btn btn-success" value="Simpan & Lanjut" id="save_add">
    </form>
</div>

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
    var iKelsos=1;

    //toggle checkbox
    $('input[name=pernahbantuan]').on('click',function(){
        if($(this).val()==0){
            $('input[name=nama_program_bantuan]').attr('disabled','disabled').addClass('disabled');
            $('select[name=tahun]').attr('disabled','disabled').addClass('disabled');
            $('input[name=jum_dana]').attr('disabled','disabled').addClass('disabled');
            $('textarea[name=ket_dana]').attr('disabled','disabled').addClass('disabled');
            $('#btnadd_bantuan').attr('disabled','disabled');
        }else{
            $('input[name=nama_program_bantuan]').removeAttr('disabled','disabled').removeClass('disabled');
            $('select[name=tahun]').removeAttr('disabled','disabled').removeClass('disabled');
            $('input[name=jum_dana]').removeAttr('disabled','disabled').removeClass('disabled');
            $('textarea[name=ket_dana]').removeAttr('disabled','disabled').removeClass('disabled');
            $('#btnadd_bantuan').removeAttr('disabled','disabled');
        }
    });

        $('.select-jenis-kelsos').select2({
            placeholder:'Jenis Data',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcombokelsos') }}',
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
        $('.select-tahun').select2({
            placeholder:'Tahun',
            allowClear: true,
        });

        $('.select_jenis_bantuan_dana').select2({
            placeholder:'Jenis Bantuan Dana',
            allowClear: true,
        });
        $('.select_jenis_bantuan_dana').select2({
            placeholder:'Jenis Bantuan Dana',
            allowClear: true,
        });

        let tmpRowKelsos = function(iKelsos){
            let comboJenisKelsos = '{!! Form::select('jenis_kelsos_id[]',[],[],['class'=>'form-control select-jenis-kelsos']) !!}';

            return '<div class="fieldset has-five item-kelsos">'+
                            '<div class="field-item">'+
                                    '<button  type="button" class="btn btn-danger item-kelsos-delete  hidden-large"><i class="mdi mdi-trash-can-outline"></i></button>'+
                                    '<label class="control-label hidden-large">Jenis Kelompok Sosial<em class="asterix">*</em></label>'+
                                    comboJenisKelsos
                            +'</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Item<em class="asterix">*</em></label>'+
                                '<input type="text" id="title-kelsos" name="title-kelsos[]" value="" class="form-control" placeholder="Judul Item">'+
                                '<textarea name="ket-kelsos[]" class="form-control" placeholder="keterangan item"></textarea>'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label col-large hidden-large">Foto<em class="asterix">*</em></label>'+
                                '<input type="text" id="foto-kelsos" name="foto-kelsos[]" value="" class="form-control" readonly>'+
                                '<a href="" class="popup_selector" data-inputid="foto-kelsos">Browse Foto</a>'+
                                '<input type="text" id="title-kelsos" name="title-foto-kelsos[]" value="" class="form-control" placeholder="Judul Foto">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Video</label>'+
                                '<input type="text" id="video-kelsos" name="video-kelsos[]" value=""  class="form-control" readonly>'+
                                '<a href="" class="popup_selector" data-inputid="video-kelsos">Browse Video</a>'+
                                '<input type="text" id="title-kelsos" name="title-video-kelsos[]" value="" class="form-control" placeholder="Judul Video">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Aksi</label>'+
                                '<button  type="button" class="btn btn-danger item-kelsos-delete hidden-mobile"><i class="mdi mdi-trash-can-outline"></i></button>'+
                            '</div>'+
                '</div>';
        }

        //form kelsos
        $('#btnadd_kelsos').on('click',function(){
            if($('.item-kelsos:last').length==0)
                $('#data-kelsos').append(tmpRowKelsos(iKelsos));
            else
                $(tmpRowKelsos(iKelsos)).insertAfter('.item-kelsos:last');

                $(".field-item").children("select").select2();
                $('.select-jenis-kelsos').select2({
                        placeholder: 'Pilih Jenis Kelompok',
                        allowClear: true,
                        ajax: {
                        url: '{{ route('api.getcombokelsos') }}',
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
            iKelsos++;
        });


        $("body").on("click",".item-kelsos-delete",function(){
            $(this).parents().closest(".item-kelsos").remove();
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
                                                            nama_desawisata: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'nama_desawisata diperlukan'
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
