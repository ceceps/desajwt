@extends('admin.layouts.layout_admin')
@php
header("Cache-Control", "no-cache, no-store, must-revalidate");

@endphp
@section('style')
<link rel="stylesheet" href="{{ asset('styles/prettify.min.css') }}">
<link rel="stylesheet" href="{{ asset('styles/bootstrap-datetimepicker.min.css') }}" />

@endsection
@section('topbar')
<!-- begin top dashboard -->
<div class="dashboard-top">
    <div class="container-fluid">
        <div class="top-entry">
            <div class="top-status">

                <h3>{!! __($title_page) !!}</h3>

                <!-- for single action page remove this breadcrumb-->
                <nav class="dashboard-breadcrumb">
                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="mdi mdi-home"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('halaman.index') }}">
                                <i class="mdi mdi-chevron-right"></i>
                                Halaman
                            </a>
                        </li>
                        <li>
                            <i class="mdi mdi-chevron-right"></i>
                            {!! isset($title_page)?$title_page:'&nbsp;'; !!}
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

        @php
            $judul = Input::old('judul')!==null?Input::old('judul'):'';
            $alt_foto = Input::old('alt_foto')!==null?Input::old('alt_foto'):'';
            $slug = (Input::old('slug')!==null)?Input::old('slug'):'';
            $konten = (Input::old('konten')!==null)?Input::old('konten'):'';
            $foto ='images/profil_desawisata.png';
            $status = Input::old('status')!==null?Input::old('status'):'';
        @endphp


<!-- begin dashboard content -->
<div class="dashboard-content">
    <div class="dashboard-inner">
        <div class="container-fluid">
                @include('admin.partial.message')

            <form class="form-custom has-category" action="{{ route('halaman.store') }}" method="POST" id="form-halaman"
                enctype="multipart/form-data">
                @csrf
                <div class="panel clean">
                    <!-- begin form style -->
                    <div class="form-based">

                        <!-- form title
                    *pakai class di bawah ini, bila akan ada action/option dari form title nya tambahkan class 'with-option', bila
                    tidak ada action sebaliknya, hanya untuk satu button/action
                  -->

                        <div class="top-form with-option">
                            <div class="form-title">
                                <h4 class="form-title">{{ (isset($halaman_id))?'Edit':'Tambah' }} halaman</h4>
                                <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                            </div>
                        </div>
                        <!--<form class="form-custom has-category">-->

                        <div class="form-group has-two-fields">
                                <img src="{{ asset($foto) }}" class="img-posting" alt="Upload File" id="imgpreview">
                                <div class="category-field" >
                                        <label class="control-label">Foto halaman<em class="asterix">*</em></label>
                                        <input name="fotohalaman" class="form-control" id="fotohalaman" type="file">
                                </div>
                                <div class="category-field" >
                                        <label class="control-label">Info Foto <em class="asterix">*</em></label>
                                        <input name="alt_foto" class="form-control" id="alt_foto" type="text" value="{{ $alt_foto }}">
                                </div>
                        </div>
                        <div class="form-group has-two-fields">
                            <div class="form-category-entry">
                                <div class="category-field">
                                    <label class="control-label">Judul halaman <em class="asterix">*</em></label>
                                    <input type="text" name="judul" class="form-control col-sm-12" placeholder="Judul halaman" value="{{ $judul }}">
                                </div>
                                <div class="category-field">
                                    <label class="control-label">Slugs </label>
                                    <div>
                                        <input type="text" readonly="readonly" name="slug" max-width="4" class="form-control"
                                    placeholder="slug diisi otomatis" value="{{ $slug }}">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-two-fields">
                            <div class="category-field" style="width:90%">
                                <label class="control-label">Konten <em class="asterix">*</em></label>
                                <textarea name="konten" class="form-control" id="editor" placeholder="contoh: Konten">{!! $konten !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group has-three-fields">
                            <div class="form-category-entry">
                                <div class="category-field">
                                    <label class="control-label">Penulis<em class="asterix">*</em></label>
                                    <input type="text" value="{{ \Auth::user()->name }}" class="form-control" placeholder="Penulis">
                                <input type="hidden" nama="author_id" value="{{ \Auth::user()->id }}"> <!-- user id login -->
                                </div>
                                <div class="category-field form-group">
                                    <label class="control-label" id="nama_pimpinan">Tgl Posting<em class="asterix">*</em></label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control datetime" nama="created_at" value="{{ date('d-m-Y H:i:s') }}"  disabled/>

                                    </div>
                                    <input type="hidden" name="updated_at" id="updated_at">
                                </div>
                                <div class="category-field">
                                    <label class="control-label">Status<em class="asterix">*</em></label>
                                    <select name="status" id="select-status" class="form-control select-status">
                                        <option value="">--Status--</option>
                                        <option value="1" {{ $status==1?'selected':'' }} >Publish</option>
                                        <option value="0" {{ $status==0?'selected':'' }} >Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- class outer untuk di tab saja yang lokasi nya di luar tab -->
                <div class="button-action outer">
                    <button type="submit" class="btn btn-default brand" id="submit-all">
                        Save
                    </button>
                    <button type="button" class="btn btn-default btn-flat">
                        Cancel
                    </button>
                    <div id="loadingDiv" style="z-index: 999"><img src="{{ asset('images/ajax-loader.gif') }}" alt="loading"></div>
                </div>
            </form>

        </div>
    </div>
    <!-- end dashboard content -->

</div>

@endsection
@section('script')
<script src="{{ asset('scripts/lib/tinymce/tinymce.min.js')}}"></script>
<script src="{{ asset('scripts/lib/tinymce/langs/id.js')}}"></script>
<script type="text/javascript" src="{{ asset('scripts/lib/bootstrap-datetimepicker.min.js') }}"></script>
{{-- <script src="{{ asset('js/dropzone.js')}}"></script> --}}
<script>


    tinymce.init({
        selector: '#editor',
        height: 300,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | fullscreen |wordcount | code |help',
        content_css: [
            '{{ asset('styles/fonts.css') }}',
            '{{ asset('styles/codepen.min.css') }}']
    });



        $(document).ready(function (e) {
        e.preventDefault;
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_alam = $(".add_alam"); //Add button ID
        var add_budaya = $(".add_budaya"); //Add button ID
        var add_buatan = $(".add_buatan"); //Add button ID

        var hiddenAlam = '<input type="hidden" name="idalam[]">';
        var cboAlam = '<select name="atraksi_alam[]" class="form-control"><option></option></select>';
        var ketalam = '<input type="text" name="ket_alam[]">';
        var filealam = '<input type="file" name="file_alam[]">';
        var delalam =
            '<a href="" id="btn_delete"><span class="badge badge-danger"><i class="mdi mdi-trash-can-outline"></i></span></a>';

        //Tanggal
        $('#datetimepicker1').datetimepicker()

        $('[name=slug]').change(function () {
            var slg = slug($('[name=judul]').val());
            $('[name=slug]').val(slg);
        });

        $('form#form-halaman').submit(function (e) {
            tinyMCE.triggerSave();
            var fd = new FormData($(this));
            $.ajax({
                url: rest_url + "/backend/halaman/store",
                data: fd,
                cache: false,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function (res) {
                    alert(res);
                }
            });
        });

        $('#fotohalaman').change(function(){
            readURL(this,'#imgpreview');
        });
    });

</script>
@endsection
