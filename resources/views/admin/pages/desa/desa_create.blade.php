@extends('admin.layouts.layout_admin') @php header("Cache-Control", "no-cache, no-store, must-revalidate"); $foto = 'images/profil_desawisata.png';

@endphp
@section('style')
<link href="{{ asset('styles/jquery-ui-1.10.0.custom.css') }}" rel="stylesheet" />
@endsection

@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">
                <h3>{!! isset($title_page)?$title_page:'&nbsp;'; !!}</h3>

                <!-- for single action page remove this breadcrumb -->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                    <i class="mdi mdi-home"></i> Dashboard
                                </a>
                        </li>
                        <li>
                            <a href="{{ route('profildesa.index') }}">
                                <i class="mdi mdi-chevron-right"></i> Profil Desa
                            </a>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-right"></i> {!! isset($title_page)?$title_page:'&nbsp;'; !!}
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="top-option">{!! date('d-m-Y H:i:s') !!}</div>
        </div>
    </div>
</div>
<!-- end top dashboard -->
@endsection

@section('content')
<!-- begin dashboard content -->
<div class="dashboard-content">
    <div class="dashboard-inner">
        <div class="container-fluid">
            @include('admin.partial.message')
            <form class="form-custom has-category" action="{{ route('profildesa.store') }}" method="post" id="form-desawisata" enctype="multipart/form-data">
                @csrf
                <ul class="nav nav-tabs responsive" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil" role="tab" aria-controls="profil" aria-selected="true">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="penduduk-tab" data-toggle="tab" href="#penduduk" role="tab" aria-controls="penduduk" aria-selected="false">Penduduk & Pendidikan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="penghargaan-tab" data-toggle="tab" href="#penghargaan" role="tab" aria-controls="penghargaan" aria-selected="false">Penghargaan</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
                        <div class="panel clean">
                            @include('admin.pages.desa.desa_profil')
                        </div>
                    </div>
                    <div class="tab-pane fade" id="penduduk" role="tabpanel" aria-labelledby="penduduk-tab">
                      <div class="panel clean">
                        @include('admin.pages.desa.pendidikan')
                        @include('admin.pages.desa.penduduk')
                      </div>
                    </div>
                   <div class="tab-pane fade" id="penghargaan" role="tabpanel" aria-labelledby="penghargaan-tab">
                        <div class="panel clean">
                            @include('admin.pages.desa.penghargaan')
                        </div>
                    </div>
                </div>
                <!--
                    class outer untuk di tab saja yang lokasi nya di luar tab
                -->
                <div class="button-action outer">
                    <div id="loadingDiv" style="z-index: 999">
                        <img src="{{ asset('images/ajax-loader.gif') }}" alt="loading" />
                    </div>

                    <button type="button" class="btn btn-default btn-flat" javascript="">
                         Kembali
                    </button>
                    <button type="submit" class="btn btn-default brand">
                        Simpan
                </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
<script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/formValidation.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/framework/bootstrap4.min.js') }}"></script>
<script src="{{ asset('scripts/lib/formvalidation/js/language/id_ID.js') }}"></script>
<script>
    $(function(){
        $('#modalPendidikan').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM


        $('#fotodesa').change(function(){
                readURL(this,'#imgpreview');
            });
        });

        $('.tgl').datepicker({
            dateFormat: 'dd-mm-yy',
            changeYear: true,
            changeMonth: true
        });

        $('.select2').select2();


        $('#formpendidikan').formValidation({

        });

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

    tinymce.init({
        selector: '.deskripsi',
        height: 200,
        menubar: false,
        file_browser_callback : elFinderBrowser,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | searchreplace removeformat | code ',
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

</script>
@endsection
