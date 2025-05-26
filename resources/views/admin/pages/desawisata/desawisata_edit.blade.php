@extends('admin.layouts.layout_admin') @php header("Cache-Control", "no-cache, no-store, must-revalidate");
@endphp
@section('style')

<link href="{{ asset('styles/jquery-ui-bootstrap.min.css') }}" rel="stylesheet" />
<link href="{{ asset('scripts/lib/colorbox/example3/colorbox.css')  }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('scripts/lib/formvalidation/css/formValidation.min.css')  }}"> {{--
<link href="{{ asset('styles/gijgo.min.css') }}" rel="stylesheet" type="text/css" /> --}}
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
<!-- begin single page dashboard -->
<div class="dashboard-wizard">
    <form id="formdesawisata" class="form-custom has-category repeater" data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
        <div id="smartwizard">
            <ul class="nav-wizard">
                <li>
                    <a href="#step-1">
                    <i class="icon-resort"></i>
                    Profil
                    </a>
                </li>
                <li>
                    <a href="#step-2">
                    <i class="icon-flag"></i>
                Pengelola
                </a>
                </li>
                <li><a href="#step-3">
            <i class="icon-ribbon"></i>
            Atraksi
            </a></li>
                <li>
                    <a href="#step-4">
                    <i class="icon-way"></i>Aksesibilitas
                    </a>
                </li>
                <li>
                    <a href="#step-5">
                        <i class="icon-sunset"></i>Fasilitas
                    </a>
                </li>
                <li>
                    <a href="#step-6"><i class="icon-viral-marketing"></i>Promosi
                </a></li>
                <li><a href="#step-7"><i class="icon-group"></i>Kelompok Sosial
                </a></li>
                <li><a href="#step-8"><i class="icon-gps"></i>Usaha Pariwisata
                </a></li>
                <li><a href="#step-9"><i class="icon-marketing"></i>Statistik
                </a></li>
                <li><a href="#step-10"><i class="icon-bar-chart"></i>Bantuan
                </a></li>
                <li><a href="#step-11"><i class="icon-frame"></i> Penghargaan </a></li>
            </ul>

            <div class="container-fluid">
                <div id="step-1" class="county-step-item">
                    @include('admin.pages.desawisata.form.profil_edit')
                </div>
                <div id="step-2" class="county-step-item">
                    @include('admin.pages.desawisata.form.pengelola_create')
                </div>
                <div id="step-3" class="county-step-item">
                    @include('admin.pages.desawisata.form.atraksi')
                </div>
                <div id="step-4" class="county-step-item">
                    @include('admin.pages.desawisata.form.akses')
                </div>
                <div id="step-5" class="county-step-item">
                    @include('admin.pages.desawisata.form.fasilitas')
                </div>
                <div id="step-6" class="county-step-item">
                    @include('admin.pages.desawisata.form.promosi')
                </div>
                <div id="step-7" class="county-step-item">
                    @include('admin.pages.desawisata.form.kelompok_sosial')
                </div>
                <div id="step-8" class="county-step-item">
                    @include('admin.pages.desawisata.form.pariwisata')
                </div>
                <div id="step-9" class="county-step-item">
                    @include('admin.pages.desawisata.form.statistik')
                </div>
                <div id="step-10" class="county-step-item">
                    @include('admin.pages.desawisata.form.bantuan')
                </div>
                <div id="step-11" class="county-step-item">
                    @include('admin.pages.desawisata.form.penghargaan')
                    <!-- class outer untuk di tab saja yang lokasi nya di luar tab -->
                </div>
            </div>
        </div>
    </form>
</div>
<!-- end single page dashboard -->
@endsection

@section('script')
<script src="{{ asset('scripts/lib/select2.full.js')}}"></script>
<script src="{{ asset('scripts/lib/jquery.smartWizard.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('scripts/lib/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('scripts/lib/validator.min.js') }}"></script>

<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
<script src="{{ asset('scripts/lib/dropzone.js') }}"></script>
<script type="text/javascript" src="{{ asset('scripts/lib/colorbox/jquery.colorbox-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
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


     //tekan Tombol Finish
    var btnFinish = $('<button></button>').text('Simpan')
                                          .addClass('btn btn-info')
                                          .on('click', function(){

                                            $('#formdesawisata').formValidation({
                                                        framework: 'bootstrap',
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
                                                        $.ajax({
                                                            url: storeDesaWisataWeb,
                                                            data: formData,
                                                            type: 'post',
                                                            cache: false,
                                                            contentType: false,
                                                            processData: false,
                                                            success: function (dt) {
                                                                if (dt.error == false) {
                                                                    // $.growl.notice({
                                                                    //     "message": "Data Desa Wisata Berhasil disimpan",
                                                                    //     "location": "tc"
                                                                    // });
                                                                    alert('Desa Wisata Berhasil disimpan');
                                                                    window.location.href = baseurl + 'backend/desawisata'
                                                                } else {
                                                                    // $.growl.warning({
                                                                    //     "message": "Data Desa Wisata Gagal disimpan",
                                                                    //     "location": "tc"
                                                                    // });
                                                                    alert('Desa Wisata Gagal disimpan');
                                                                    return false;
                                                                }
                                                            }
                                                        });
                                                    });
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

    $("#modelId").on('show.bs.modal', function(){
        $('[type="submit"]').removeClass('disabled');
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

          //profil
        $('#fotodesawisata').change(function(){
            readURL(this,'#imgpreview');
        });

        //looping tahun
        var opsiTahun = function(){
            let tahun_berdiri = $('[name="tahun_berdiri"]').val();
            let akhir =  (new Date).getFullYear();
            let awal = (tahun_berdiri!="")?tahun_berdiri:parseInt(akhir)-10;
            let dtahun = '';
            for (var i=awal;i<=akhir;i++){
                dtahun +='<option value="'+i+'">'+i+'</option>';
            }
            return dtahun;
        }

    //dinamis Form
    var iAlam = 1;
    var iBudaya = 1;
    var iBuatan = 1;
    var itemAtraksi=0;
    var iFasilitas=1;
    var iKelsos=1;
    var iJenisUsaha=1;


        let tmpRowAlam = function(iAlam){
            return '<div class="fieldset has-five item-alam" id="alam-'+iAlam+'">'+
                        '<div class="field-item"><label class="control-label hidden-large">Kategori<em class="asterix">*</em></label> '+
                            '<a class="btn btn-danger btn-sm item-alam-delete hidden-large"><i class="mdi mdi-trash-can-outline"></i></a>'+
                            '<select name="kategori-atraksi-alam[]" class="form-control select-atraksi-alam"><option></option></select>'+'</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Item<em class="asterix">*</em></label>'+
                        '<input type="text" id="title-atraksi-alam" name="title-atraksi-alam[]" value="" class="form-control" placeholder="Judul item">'+
                        '<textarea name="ket-atraksi-alam[]" class="form-control" placeholder="keterangan item"></textarea>'+
                    '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Foto<em class="asterix">*</em></label>'+
                        '<input type="text" id="foto-atraksi-alam" name="foto-atraksi-alam[]" value="" class="form-control" readonly>'+
                        '<a href="" class="popup_selector" data-inputid="foto-atraksi-alam">Browse Foto</a>'+
                        '<input type="text" id="title-atraksi-alam" name="title-foto-atraksi-alam[]" value="" class="form-control" placeholder="Judul Foto">'+
                    '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Video</label>'+
                        '<input type="text" id="video-atraksi-alam" name="video-atraksi-alam[]" value=""  class="form-control" readonly>'+
                        '<a href="" class="popup_selector" data-inputid="video-atraksi-alam">Browse Video</a>'+
                        '<input type="text" id="title-atraksi-alam" name="title-video-atraksi-alam[]" value="" class="form-control" placeholder="Judul Video">'+
                    '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Aksi</label>'+
                        '<button type="button" class="btn btn-danger item-alam-delete hidden-mobile"><i class="mdi mdi-trash-can-outline"></i></button>'+
                    '</div>'+
                '</div>';
        }

        let tmpRowBudaya = function(iBudaya){

        return '<div class="fieldset has-five item-budaya" id="budaya-'+iBudaya+'">'+
                        '<div class="field-item"><label class="control-label hidden-large">Kategori<em class="asterix">*</em></label> '+
                            '<a class="btn btn-danger btn-sm del-atraksi-buatan hidden-large"><i class="mdi mdi-trash-can-outline"></i></a>'+
                            '<select name="kategori-atraksi-budaya[]" class="form-control select-atraksi-budaya"><option></option></select>'+
                            '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Item<em class="asterix">*</em></label>'+
                        '<input type="text" id="title-atraksi-budaya" name="title-atraksi-budaya[]" value="" class="form-control" placeholder="Judul Item">'+
                        '<textarea type="text" name="item-atraksi-budaya[]" class="form-control" placeholder="Keterangan Item"></textarea>'+
                    '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Foto<em class="asterix">*</em></label>'+
                        '<input type="text" id="foto-atraksi-budaya" name="foto-atraksi-budaya[]" value="" class="form-control" readonly>'+
                        '<a href="" class="popup_selector" data-inputid="foto-atraksi-budaya">Browse Foto</a>'+
                        '<input type="text" id="title-atraksi-budaya" name="title-foto-atraksi-budaya[]" value="" class="form-control" placeholder="Judul Foto">'+
                    '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Video</label>'+
                        '<input type="text" id="video-atraksi-budaya" name="video-atraksi-buatan[]" class="form-control">'+
                        '<a href="" class="popup_selector" data-inputid="video-atraksi-budaya">Browse Video</a>'+
                        '<input type="text" id="title-video-atraksi-budaya" name="title-video-atraksi-budaya[]" value="" class="form-control" placeholder="Judul Video">'+
                    '</div>'+
                    '<div class="field-item">'+
                        '<label class="control-label hidden-large">Aksi</label>'+
                        '<button type="button" class="btn btn-danger btn-sm del-atraksi-budaya hidden-mobile"><i class="mdi mdi-trash-can-outline"></i></button>'+
                    '</div>'+
                '</div>';
        }

        let tmpRowBuatan = function(iBuatan){

            return '<div class="fieldset has-five item-buatan" id="buatan-'+iBuatan+'">'+
                        '<a class="btn btn-danger btn-sm del-atraksi-buatan hidden-large"><i class="mdi mdi-trash-can-outline"></i></a>'+
                        '<div class="field-item"><label class="control-label hidden-large">Kategori<em class="asterix">*</em></label> '+
                            '<select name="kategori-atraksi-buatan[]" class="form-control select-atraksi-buatan"><option></option></select>'+'</div>'+
                        '<div class="field-item">'+
                            '<label class="control-label hidden-large">Item<em class="asterix">*</em></label>'+
                            '<input type="text" id="title-atraksi-buatan" name="title-atraksi-buatan[]" value="" class="form-control" placeholder="Judul Item">'+
                            '<textarea type="text" name="item-atraksi-buatan[]" class="form-control" placeholder="Keterangan Item"></textarea>'+
                        '</div>'+
                        '<div class="field-item">'+
                            '<label class="control-label hidden-large">Foto<em class="asterix">*</em></label>'+
                            '<input type="text" id="foto-atraksi-buatan" name="foto-atraksi-buatan[]" class="form-control">'+
                            '<a href="" class="popup_selector" data-inputid="foto-atraksi-buatan">Browse Foto</a>'+
                            '<input type="text" id="title-foto-atraksi-buatan" name="title-foto-atraksi-buatan[]" value="" class="form-control" placeholder="Judul Foto">'+
                        '</div>'+
                        '<div class="field-item">'+
                            '<label class="control-label hidden-large">Video</label>'+
                            ' <input type="text" id="video-atraksi-buatan" name="video-atraksi-buatan[]" class="form-control">'+
                            '<a href="" class="popup_selector" data-inputid="video-atraksi-buatan">Browse Video</a>'+
                            '<input type="text" id="title-video-atraksi-buatan" name="title-video-atraksi-buatan[]" value="" class="form-control" placeholder="Judul Video">'+
                        '</div>'+
                        '<div class="field-item">'+
                            '<label class="control-label hidden-large">Aksi</label>'+
                            '<button type="button" class="btn btn-danger btn-sm del-atraksi-buatan hidden-mobile"><i class="mdi mdi-trash-can-outline"></i></button>'+
                        '</div>'+
                     '</div>';
        }

        let comboJenFasilitas = '{!! Form::select('jenis_fasilitas_id[]',[],[],['class'=>'form-control select-jenis-fasilitas']) !!}';
        let tmpRowFasilitas = function(iFasilitas){

            return ' <div class="fieldset has-five item-fasilitas">'+
                            '<div class="field-item">'+
                                    '<button  type="button" class="btn btn-danger item-fasilitas-delete  hidden-large"><i class="mdi mdi-trash-can-outline"></i></button>'+
                                    '<label class="control-label hidden-large">Jenis Fasilitas<em class="asterix">*</em></label>'+
                                    comboJenFasilitas
                            +'</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Item<em class="asterix">*</em></label>'+
                                '<input type="text" id="title-fasilitas" name="title-fasilitas[]" value="" class="form-control" placeholder="Judul Item">'+
                                '<textarea name="ket-fasilitas[]" class="form-control" placeholder="keterangan item"></textarea>'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label col-large hidden-large">Foto<em class="asterix">*</em></label>'+
                                '<input type="text" id="foto-fasilitas" name="foto-fasilitas[]" value="" class="form-control" readonly>'+
                                '<a href="" class="popup_selector" data-inputid="foto-fasilitas">Browse Foto</a>'+
                                '<input type="text" id="title-fasilitas" name="title-foto-fasilitas[]" value="" class="form-control" placeholder="Judul Foto">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Video</label>'+
                                '<input type="text" id="video-fasilitas" name="video-fasilitas[]" value=""  class="form-control" readonly>'+
                                '<a href="" class="popup_selector" data-inputid="video-fasilitas">Browse Video</a>'+
                                '<input type="text" id="title-fasilitas" name="title-video-fasilitas[]" value="" class="form-control" placeholder="Judul Video">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Aksi</label>'+
                                '<button  type="button" class="btn btn-danger item-fasilitas-delete hidden-mobile"><i class="mdi mdi-trash-can-outline"></i></button>'+
                            '</div>'+
                '</div>';
        }
        let tmpRowKelsos = function(iKelsos){
            let comboJenisKelsos = ' {!! Form::select('jenis_kelsos_id[]',[],[],['class'=>'form-control select-jenis-kelsos']) !!}';

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
        let tmpRowJenUsaha = function(){
            let comboJenisUsaha = ' {!! Form::select('jenis_kelsos_id[]',[],[],['class'=>'form-control select-jenis-usaha']) !!}';

            return '<div class="fieldset has-five item-jenis-usaha">'+
                            '<div class="field-item">'+
                                    '<button  type="button" class="btn btn-danger item-jenis-usaha-delete  hidden-large"><i class="mdi mdi-trash-can-outline"></i></button>'+
                                    '<label class="control-label hidden-large">Jenis Kelompok Sosial<em class="asterix">*</em></label>'+
                                    comboJenisUsaha
                            +'</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Item<em class="asterix">*</em></label>'+
                                '<input type="text" id="title-jenis-usaha" name="title-jenis-usaha[]" value="" class="form-control" placeholder="Judul Item">'+
                                '<textarea name="ket-jenis-usaha[]" class="form-control" placeholder="keterangan item"></textarea>'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label col-large hidden-large">Foto<em class="asterix">*</em></label>'+
                                '<input type="text" id="foto-jenis-usaha" name="foto-jenis-usaha[]" value="" class="form-control" readonly>'+
                                '<a href="" class="popup_selector" data-inputid="foto-jenis-usaha">Browse Foto</a>'+
                                '<input type="text" id="title-jenis-usaha" name="title-foto-jenis-usaha[]" value="" class="form-control" placeholder="Judul Foto">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Video</label>'+
                                '<input type="text" id="video-jenis-usaha" name="video-jenis-usaha[]" value=""  class="form-control" readonly>'+
                                '<a href="" class="popup_selector" data-inputid="video-jenis-usaha">Browse Video</a>'+
                                '<input type="text" id="title-jenis-usaha" name="title-video-jenis-usaha[]" value="" class="form-control" placeholder="Judul Video">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label hidden-large">Aksi</label>'+
                                '<button  type="button" class="btn btn-danger item-jenis-usaha-delete hidden-mobile"><i class="mdi mdi-trash-can-outline"></i></button>'+
                            '</div>'+
                '</div>';
        }
        let cboTahun = '<select name="dana-tahun[]" class="form-control select-year">'+
                            '<option></option><select>';
        let rowJenisBantuan =  function(){


            return '<div class="panel panel-default item-jenisdana">'+
                    '<div class="panel-body">'+
                        '<div class="fieldset has-four">'+
                            '<div class="field-item">'+
                                '<label class="control-label">Nama Proram Bantuan <em class="asterix">*</em></label>'+
                                '<input type="text" name="nama_program_bantuan[]"  class="form-control col-8 nama_program" placeholder="nama program" aria-describedby="helpId">'+
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label">Tahun <em class="asterix">*</em></label>'+
                                cboTahun +
                            '</div>'+
                            '<div class="field-item">'+
                                '<label class="control-label">Besar Dana <em class="asterix">*</em></label>'+
                                '<input type="text" name="jum-dana[]" class="form-control" placeholder="Rp....">'+
                            '</div>'+
                            '<div class="field-item align-center hidden-mobile">'+
                                '<span class="button-divider"></span>'+
                                '<a href="#" class="btn btn-danger dana-delete btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>'+
                            '</div>'+
                        '</div>'+
                        '<div class="fieldset">'+
                                '<label class="control-label">Penggunaan Anggaran <em class="asterix">*</em></label>'+
                        '</div>'+
                        '<div class="fieldset">'+
                            '<textarea name="nota-dana[]" id="" cols="30" rows="3" placeholder="Digunakan Untuk" class="form-control"></textarea>'+
                        '</div>'+
                        '<div class="fieldset hidden-large">'+
                                '<label class="control-label">Hapus ?</label>'+
                                '<a href="#" class="btn btn-danger dana-delete btn-sm "><i class="mdi mdi-trash-can-outline"></i></a>'+
                        '</div>'+
                    '</div>'+
                '</div>';
        }

        let rowPenghargaan = function () {
            return '<div class="panel panel-default item-penghargaan">'+
                        '<div class="panel-body">'+
                            '<div class="fieldset has-four">'+
                                '<div class="field-item">'+
                                    '<label class="control-label">Nama Penghargaan <em class="asterix">*</em></label>'+
                                    '<input type="text" name="nama_penghargaan[]" class="form-control col-8 nama_peghargaan" placeholder="Nama Penghargaan" aria-describedby="helpId">'+
                                '</div>'+
                                '<div class="field-item">'+
                                    '<label class="control-label">Tahun <em class="asterix">*</em></label>'+
                                    '<select name="tahun_penghargaan[]" class="form-control select-year">'+
                                    '<option></option><select>'+
                                '</div>'+
                                '<div class="field-item">'+
                                            '<label class="control-label">Peringkat <em class="asterix">*</em></label>'+
                                            '<input type="text" name="peringkat[]" class="form-control" placeholder="Peringkat">'+
                                '</div>'+
                                '<div class="field-item align-center hidden-mobile">'+
                                    '<span class="button-divider"></span>'+
                                    '<a href="#" class="btn btn-danger penghargaan-delete btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>'+
                                '</div>'+
                            '</div>'+
                            '<div class="fieldset">'+
                                    '<label class="control-label">Keterangan Penghargaan <em class="asterix">*</em></label>'+
                            '</div>'+
                            '<div class="fieldset">'+
                                '<textarea name="nota_penghargaan[]" id="" cols="30" rows="3" placeholder="Keterangan" class="form-control"></textarea>'+
                            '</div>'+
                            '<div class="field-item hidden-large">'+
                                    '<label class="control-label">Hapus ?</label>'+
                                    '<a href="#" class="btn btn-danger penghargaan-delete btn-sm "><i class="mdi mdi-trash-can-outline"></i></a>'+
                            '</div>'+
                        '</div>'
                    '</div>';
        }



  $('.select-atraksi-alam').select2({
        placeholder:'Pilih Kategori',
        allowClear: true,
        ajax: {
            url: '{{ route('api.getcomboatraksi','alam') }}',
                data: function (params) {
                var query = {
                    search: params.term,
                }

                // Query parameters will be ?search=[term]&page=[page]
                return query;
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
        }
    });
        $('.select-atraksi-budaya').select2({
            placeholder:'Pilih Kategori',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcomboatraksi','budaya') }}',
                data: function (params) {
                        var query = {
                        search: params.term,
                    }

                    // Query parameters will be ?search=[term]&page=[page]
                    return query;
                },
                processResults: function (data) {
                        return {
                        results: data
                        };
                },
            }
        });

        $('.select-atraksi-buatan').select2({
            placeholder:'Pilih Kategori',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcomboatraksi','buatan') }}',
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

        $('.select-jenis-fasilitas').select2({
            placeholder:'Pilih Jenis Fasilitas',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcombojenisfasilitas') }}',
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

        $('.select-jenis-kelsos').select2({
            placeholder:'Pilih Jenis Kelompok Sosial',
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

        $('.select-jenis-data').select2({
            placeholder:'Pilih Jenis Data',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcombojenisdata') }}',
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

        $('.select-jenis_usaha').select2({
            placeholder:'Pilih Jenis Usaha',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcombojenisusaha') }}',
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
                cache: true
            }
        });

        $('.select-jenis_dampak').select2({
            placeholder:'Pilih Jenis Uraian',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcombojenisdampak') }}',
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
                cache: true
            }
        });

  $('#btnadd-alam').on('click',function(){
      if($('.item-alam:last').length==0)
         $('#data-alam').append(tmpRowAlam(iAlam));
       else
         $(tmpRowAlam(iAlam)).insertAfter('.item-alam:last');

         $('.select-atraksi-alam').select2({
             placeholder: 'Pilih Kategori', allowClear: true,
             ajax: {
                url: '{{ route('api.getcomboatraksi','alam') }}',
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

        iAlam++;
    });


    $("body").on("click",".item-alam-delete",function(){
        $(this).parents().closest(".item-alam").remove();
    });


    //Form Atraksi Budaya
    $('#btnadd-budaya').on('click',function(){
        if($('.item-budaya:last').length==0)
           $('#data-budaya').append(tmpRowBudaya(iBudaya));
         else
           $(tmpRowBudaya(iBudaya)).insertAfter('.item-budaya:last');
        //aktifkan kembali select2
        $('.select-atraksi-budaya').select2({
            placeholder: 'Pilih Kategori',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcomboatraksi','budaya') }}',
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
    });

     $("body").on("click",".del-atraksi-budaya",function(){
        $(this).parents().closest(".item-budaya").remove();
    });


    //Form Atraksi Buatan
    $('#btnadd-buatan').on('click',function(){
        if($('.item-buatan:last').length==0)
           $('#data-buatan').append(tmpRowBudaya(iBuatan));
        else
           $(tmpRowBuatan(iBuatan)).insertAfter('.item-buatan:last');

           //aktifkan kembali select2
        $('.select-atraksi-buatan').select2({
            placeholder: 'Pilih Kategori',
            allowClear: true,
            ajax: {
                url: '{{ route('api.getcomboatraksi','buatan') }}',
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
        iBuatan++;
    });

    $("body").on("click",".del-atraksi-buatan",function(){
        $(this).parents().closest(".item-buatan").remove();
    });


    //form fasilitas
    $('#btnadd_fasilitas').on('click',function(){
            if($('.item-fasilitas:last').length==0)
                $('#data-fasilitas').append(tmpRowFasilitas(iFasilitas));
            else
                $(tmpRowFasilitas(iFasilitas)).insertAfter('.item-fasilitas:last');

            $('.select-jenis-fasilitas').select2({
                placeholder: 'Pilih Jenis Fasilitas',
                allowClear: true,
                ajax: {
                url: '{{ route('api.getcombojenisfasilitas') }}',
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
            iFasilitas++;
    });

    $("body").on("click",".item-fasilitas-delete",function(){
        $(this).parents().closest(".item-fasilitas").remove();
    });

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

    //form usaha pariwisata
    $('#btnadd_jenis_usaha').on('click',function(){
        if($('.item-jenis_usaha:last').length==0)
            $('#data-jenis-usaha').append(tmpRowJenUsaha());
        else
            $(tmpRowJenUsaha()).insertAfter('.item-jenis_usaha:last');
            $('.select-jenis-usaha').select2({
                placeholder: 'Pilih Jenis Usaha',
                allowClear: true,
                ajax: {
                url: '{{ route('api.getcombojenisusaha') }}',
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
    });

    $("body").on("click",".item-jenis-usaha-delete",function(){
        $(this).parents().closest(".item-jenis-usaha").remove();
    });

    //Simpan Row Data Statistik
    var tmpRowData = '<tr><td class="baris"></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>'+
                            '<td class="text-center">'+
                                    '<a href="#" class="badge badge-pill badge-info">Edit</a>'+
                                    '<a href="#" class="badge badge-pill badge-danger">Hapus</a>'+
                            '</td>'+
                    '</tr>';
    //$('#table-statistik tbody').html(rowData);

    //form bantuan
    $('#btnadd_bantuan').on('click',function(){
        if($('.item-jenisdana').length==0)
           $(rowJenisBantuan()).insertAfter('#dana_bantuan');
        else
           $(rowJenisBantuan()).insertAfter('.item-jenisdana:last');

           //aktifkan kembali select2
        $('.select-year').select2({
            placeholder: 'Pilih Tahun',
            allowClear: true,

        }).append(opsiTahun()).trigger('change');
    });

    $("body").on("click",".dana-delete",function(){
        $(this).parents().closest(".item-jenisdana").remove();
    });

    //select tahun
    $('.select-year').append(opsiTahun()).trigger('change');

    //baca semua jenis bantuan dari input masukkan ke combo pemanfaatan
    $("body").on('change','.nama_program',function(){
        // var values = $("input[name='nama_program_bantuan[]']").map(function(){
        var values = $(".nama_program").map(function(){
            return $(this).val();
        }).get();
        var option = '[{';
        var val = 0;
        for (var i=0;i<values.length;i++){
            val = parseInt(i)+1;
            if(i==0)
                option += '"text":"' + values[i] + '","id":'+ val;

            else
                option += ',"text":"' + values[i] + '","id":'+ val;

        }
        option += '}]';
        console.log(option);

        // hapus dan isi kembali data
       $('.select_jenis_bantuan_dana').val(null).trigger('change');
       $('.select_jenis_bantuan_dana').select2({
           data: option
       });
    });

    //form penghargaan

    $('#btnadd_penghargaan').on('click',function(){
        if($('.item-penghargaan:last').length==0)
           $(rowPenghargaan()).insertAfter('#data-penghargaan');
        else
           $(rowPenghargaan()).insertAfter('.item-penghargaan:last');

           //aktifkan kembali select2
        $('.select-year').select2({
            placeholder: 'Pilih Tahun',
            allowClear: true,

        }).append(opsiTahun()).trigger('change');
    });

});

</script>
@endsection
