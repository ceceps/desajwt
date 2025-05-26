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

    @if(count($errors->bags)>0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Terdapat Kesalahan</strong>
            <ul  style="padding-left:5x;decoration:none">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
        </div>
    @endif
    <form id="formdesawisataprofil" class="form-custom has-category repeater" action="{{ route('desawisata.updateprofile',$desawisata) }}" data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div id="pesan"></div>
        {{-- @include('admin.pages.desawisata.form.profil_edit') --}}
        @php
        $foto = 'images/profil_desawisata.png';
        $tgl_terdata = \Carbon\Carbon::parse($desawisata->tgl_terdata)->format('d-m-Y');
    @endphp
    <div class="setup-content"  id="form-step-0" role="form">
        {{-- <form class="form-custom has-category"  method="post" id="formprofil" enctype="multipart/form-data"> --}}
                <!-- begin form style ---->
                <div class="form-based" id="formprofil">
                    <div class="top-form with-option">
                        <div class="form-title">
                            <h4 class="form-title">Profil Desa Wisata</h4>
                            <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                        </div>
                    </div>
                    <div class="media-placeholder">
                        @if(count($desawisata->Media)>0)
                            @foreach($desawisata->Media as $mda)
                                @php
                                    $file = Storage::url('data-desawisata/'.$mda['filename']);
                                    $foto = (@getimagesize($file)!=false)?$file:'images/noimage.jpg';
                                    $judul = $mda->title;
                                @endphp
                                <img src="{{ asset($foto) }}" class="img-fluid" alt="Upload File" id="imgpreview">
                            @endforeach
                        @else
                          <img src="{{ asset('images/profil_desawisata.png') }}" class="img-fluid" alt="Upload File" id="imgpreview">
                        @endif
                    </div>
                    <br>
                    <br>
                    <div class="form-group has-two-fields ">
                        <div class="category-field">
                            <label class="control-label">Foto Desa Wisata<em class="asterix">*</em></label>
                            <input name="fotodesawisata" class="form-control" id="fotodesawisata" type="file">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Info Foto</label>
                            <input type="hidden" name="id" value="{{ $desawisata->id }}">
                            <input type="text" id="alt_foto" name="alt_foto" class="form-control" placeholder="Info gambar" value="{{ isset($judul)?$judul:'' }}">
                        </div>
                    </div>
                    <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                <label class="control-label">Nama Desa Wisata<em class="asterix">*</em></label>
                                <input type="text" name="nama_desawisata" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->nama_desawisata }}">
                            </div>
                            <div class="category-field">
                                <label class="control-label">Kategori<em class="asterix">*</em></label>
                                {!! Form::select('idcat',$kategori,$desawisata->idcat,['class'=>'form-control select2']) !!}
                            </div>
                            <div class="category-field">
                                <label class="control-label">Pendirian Desa Wisata<em class="asterix">*</em></label>
                                {{-- <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun" value="{{  $desawisata->tahun_berdiri }}"> --}}
                                {!! Form::select('tahun_berdiri',$opsiTahun,$desawisata->tahun_berdiri,['class'=>'form-control pilihTahun']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="category-field" style="width:98%">
                            <label class="control-label">Deskripsi<em class="asterix">*</em></label>
                            <textarea name="deskripsi" class="form-control" id="editor" placeholder="contoh: Deskripsi">{{ $desawisata->deskripsi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                <label class="control-label">Kelurahan/Desa <em class="asterix">*</em></label>
                                <input type="text" name="kelurahan" id="kelurahan_nama" class="form-control col-md-7" value="{{ $desawisata->kelurahan['nama'] }}">
                                <input type="hidden" name="kel_id" id="kelurahan_id" value="{{ $desawisata->kel_id }}">
                            </div>
                            <div class="category-field">
                                <label class="control-label">Kecamatan</label>
                                <input type="text" id="kecamatan_nama" class="form-control col-md-7"  value="{{ $desawisata->kelurahan->kecamatan['nama'] }}">
                            </div>
                            <div class="category-field">
                                <label class="control-label">Kabupaten</label>
                                <input type="text" id="kabupaten_nama" class="form-control col-md-7" value="{{ $desawisata->kelurahan->kecamatan->kabupaten['nama'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                <label class="control-label">SK Desa<em class="asterix">*</em></label>
                                <input type="text" name="sk_desa" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->sk_desa }}">
                                <input type="text" name="tgl_sk_desa" class="form-control tgl"  placeholder="01-01-2000" value="{{ $desawisata->tgl_sk_desa }}">
                                <span class="add-on"><i class="fa fa-calendar"></i></span>
                                {{-- <div class="input-append date" id="tgl_desa" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                    <input class="span2" size="16"  name="tgl_sk_desa" type="text" value="12-02-2012">
                                    <span class="add-on"><i class="icon-th"></i></span>
                                  </div> --}}
                            </div>
                            <div class="category-field">
                                <label class="control-label">SK Dinas Kota/Kabupaten</label>
                                <input type="text" name="sk_dinas_kab" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->sk_dinas_kab }}">
                                <input type="text" name="tgl_sk_kab" class="form-control tgl" id="tgl_kab" placeholder="01-01-2011" value="{{ $desawisata->tgl_sk_kab }}">
                                <span><i class="fa fa-calendar"></i></span>
                            </div>
                            <div class="category-field">
                                <label class="control-label">SK Dinas Provinsi</label>
                                <input type="text" name="sk_provinsi" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->sk_provinsi }}">
                                <input type="text" name="tgl_sk_prov" class="form-control tgl" id="tgl_prov" placeholder="01-01-2000" value="{{ $desawisata->tgl_sk_prov }}">
                                <span><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group has-four-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                <label class="control-label">Latitude<em class="asterix">*</em></label>
                            <input type="text" name="lat" class="form-control" placeholder="contoh: 16.000" value="{{ $desawisata->lat }}">
                            </div>
                            <div class="category-field">
                                <label class="control-label">Longitude<em class="asterix">*</em></label>
                                <input type="text" name="longi" class="form-control" placeholder="contoh: 107.000" value="{{ $desawisata->longi }}">
                            </div>
                            <div class="category-field">
                                    <label class="control-label">Status<em class="asterix">*</em></label>
                                    {!! Form::select('status',[0=>'Draft',1=>'Tampil',2=>'Non Aktif'],$desawisata->status,['class'=>'form-control','id'=>'status']) !!}
                            </div>
                            <div class="category-field">
                                    <label class="control-label">Tgl Data<em class="asterix">*</em></label>
                                    <input type="text" name="tgl_data" id="tgl_data" class="form-control tgl"value="{{ $tgl_terdata }}">
                            </div>
                       </div>
                   </div>
                    <div class="form-group has-two-fields">
                            <div class="form-category-entry">
                                <div class="category-field">
                                        <label class="control-label">Video Profil<em class="asterix">*</em></label>
                                        <input type="text" id="video_desawisata" name="video_desawisata" value="{!! isset($titleVideo)?$titleVideo:'' !!}" class="form-control" placeholder="Judul Video" >
                                </div>
                                <div class="category-field">
                                    <label class="control-label">&nbsp;</label>
                                    <input type="hidden" name="video_profil" id="video-desawisata" class="form-control" name="filename" placeholder="Nama File" value="{!! isset($filenameVideo)?$filenameVideo:''; !!}">
                                    <a href="" class="popup_selector btn btn-success" data-inputid="video-desawisata">Unggah Video</a>
                                    @if(isset($filenameVideo) and $filenameVideo!=null)
                                    @php
                                        $folder='/storage/data-video/';
                                        $url= $folder.$filenameVideo;
                                        $title = isset($titleVideo)?$titleVideo:'Detil Video';
                                    @endphp
                                    @else
                                        @php $title =''; @endphp
                                    @endif

                                </div>

                            </div>
                        </div>
                        @if(isset($filenameVideo))
                            <div class="form-group">
                                    <label class="control-label"><a href="#"  id="video_file" data-toggle="modal" data-target="#modelId" >{!! isset($filenameVideo)?$filenameVideo:''; !!}</a></label>
                            </div>
                        @endif
                    {{-- </div> --}}
                </div>
        {{-- </form> --}}
    </div>


        <input type="submit" class="btn btn-info" value="Simpan Profil">
    </form>
</div>

@if(isset($filenameVideo) and $filenameVideo!=null)
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content col-lg">
                    <div class="modal-header">
                        <h5 class="modal-title">Preview Video</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body" style="width:100%">
                            <video width="400" height="263" controls loop class="embed-responsive-item">
                                    <!--replace this sample with your video-->
                               <source src="{{ $url }}" type="video/mp4">
                            </video>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
@endif
@endsection
@section('script')
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="{{ asset('scripts/lib/select2.full.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
<script src="{{ asset('scripts/lib/colorbox/jquery.colorbox-min.js') }}"></script>
<script src="{{ asset('packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
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

        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | fullscreen | code | help',
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
        $('.pilihTahun').select2({
            placeholder: 'Pilih Tahun',
            autoClose : true
        });


        $('#formdesawisataprofil').formValidation({
                                                        framework: 'bootstrap4',
                                                        icon: {
                                                            valid: '',
                                                            invalid: '',
                                                            validating: ''
                                                        },
                                                        fields: {
                                                            fotodesawisata:{
                                                                validators: {
                                                                    file: {
                                                                            extension: 'jpeg,jpg,png',
                                                                            type: 'image/jpeg,image/png',
                                                                            maxSize: 2097152,   // 2048 * 1024
                                                                            message: 'Tipe File diupload salah'
                                                                    }
                                                                }
                                                            },
                                                            nama_desawisata: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'nama_desawisata diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            filedesawisata: {
                                                                validators: {
                                                                    image: {
                                                                        message: 'Image diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            idcat: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Kategoris diperlukan'
                                                                    }
                                                                }
                                                            },
                                                            tahun_berdiri: {
                                                                validators: {
                                                                    notEmpty: {
                                                                        message: 'Tahun Pendirian diperlukan'
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
</script>

@endsection
