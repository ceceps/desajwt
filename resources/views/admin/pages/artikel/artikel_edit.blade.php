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
                            <a href="{{ route('artikel.index') }}">
                                <i class="mdi mdi-chevron-right"></i>
                                Artikel
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
    @if(!empty($artikels))
            @php
                $artikel_id = $artikels->id;
                $judul = (Input::old('judul')!==null)?Input::old('judul'):$artikels->judul;
                $slug = (Input::old('slug')!==null)?Input::old('slug'):$artikels->slug;
                $ktgr = $artikels->kategori_id;
                $konten = (Input::old('konten')!==null)?Input::old('konten'):$artikels->konten;
                $status = $artikels->status;
                // dd($tag);
                $tags = (Input::old('tag')!==null)?Input::old('tag'):$tag;
                if (count($artikels->Media)>0){
                    $alt_foto = (Input::old('alt_foto')!==null)?Input::old('alt_foto'):$artikels->Media[0]['title'];
                    $foto = config('desawisata.PATH_IMAGE_ARTIKEL').$artikels->Media[0]['filename'];
                }else
                    $foto ='images/profil_desawisata.png';

            @endphp
    @else
        @php
            $judul = Input::old('judul')!==null?Input::old('judul'):'';
            $slug = (Input::old('slug')!==null)?Input::old('slug'):'';
            $alt_foto = (Input::old('alt_foto')!==null)?Input::old('alt_foto'):'';
            $ktgr = '';
            $konten = '';
            $foto ='images/profil_desawisata.png';
            $status = 1;
        @endphp
    @endif

<!-- begin dashboard content -->
<div class="dashboard-content">
    <div class="dashboard-inner">
        <div class="container-fluid">
             @include('admin.partial.message')
            <form action="{{ route('artikel.update', $artikel_id) }}" method="POST" class='form-custom has-category' enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="panel clean">
                    <!-- begin form style -->
                    <div class="form-based">

                        <!-- form title
                    *pakai class di bawah ini, bila akan ada action/option dari form title nya tambahkan class 'with-option', bila
                    tidak ada action sebaliknya, hanya untuk satu button/action
                  -->

                        <div class="top-form with-option">
                            <div class="form-title">
                                <h4 class="form-title">{{ (isset($artikel_id))?'Edit':'Tambah' }} Artikel</h4>
                                <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                            </div>
                        </div>
                        <!--<form class="form-custom has-category">-->
                        <div class="form-group has-two-fields">

                                   <img src="{{ asset($foto) }}" class="img-responsive" alt="Upload File" id="imgpreview">
                                    <div class="category-field" >
                                        <label class="control-label">Foto Artikel<em class="asterix">*</em></label>
                                        <input type="file" name="fotoartikel" class="form-control" id="fotoartikel">
                                    </div>
                                    <div class="category-field" >
                                            <label class="control-label">Info Foto <em class="asterix">*</em></label>
                                            <input name="alt_foto" class="form-control" id="alt_foto" type="text" value="{{ $alt_foto }}">
                                    </div>
                        </div>
                        <div class="form-group has-two-fields">
                            <div class="form-category-entry">
                                <div class="category-field">
                                    <label class="control-label">Judul Artikel <em class="asterix">*</em></label>
                                    <input type="text" name="judul" class="form-control col-sm-12" placeholder="Judul Artikel" value="{{ $judul }}">
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
                            <div class="form-category-entry">
                                <div class="category-field">
                                    <label class="control-label">Kategori <em class="asterix">*</em></label>
                                    <select name="kategori_id" class="form-control">
                                        <option value="">--Kategori--</option>
                                        @if(count($kategori))
                                            @foreach($kategori as $ktg)
                                            @php
                                                    $pilih =  ($ktgr==$ktg->id)?'selected':'';
                                                    //$pilih ='';
                                                @endphp
                                                <option value="{{ $ktg->id }}" {{ $pilih }}>{{ $ktg->nama }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                                <div class="category-field">
                                    <label class="control-label">Tags <em class="asterix">*</em></label>
                                    <input type="text" name="tag" max-width="4" class="form-control" placeholder="Tag ditulis dan dipisahkan dengan koma" value="{{ $tags }}">
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
                                    <input type="text" value="{{ \Auth::user()->name }}" class="form-control" placeholder="Penulis" readonly>
                                <input type="hidden" nama="author_id" value="{{ \Auth::user()->id }}"> <!-- user id login -->
                                </div>
                                <div class="category-field form-group">
                                    <label class="control-label" id="nama_pimpinan">Tgl Posting<em class="asterix">*</em></label>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" nama="created_at" value="{{ date('d-m-Y H:i:s') }}" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <input type="hidden" name="updated_at" id="updated_at">
                                </div>
                                <div class="category-field">
                                    <label class="control-label">Status<em class="asterix">*</em></label>
                                    <select name="status" id="select-status" class="form-control select-status">
                                        <option value=""></option>
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
                        Batal
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
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | code | wodcount | help',
        content_css: [
            '{{ asset('styles/fonts.css') }}',
            '{{ asset('styles/codepen.min.css') }}']
    });



        $(document).ready(function (e) {
        e.preventDefault;
        var wrapper = $(".input_fields_wrap"); //Fields wrapper

        //Tanggal
        $('#datetimepicker1').datetimepicker()

        $('[name=slug]').change(function () {
            var slg = slug($('[name=judul]').val());
            $('[name=slug]').val(slg);
        });

        // $('form#form-artikel').submit(function (e) {
        //     tinyMCE.triggerSave();
        //     var fd = new Formartikels($(this));
        //     $.ajax({
        //         url: rest_url + "/backend/artikel/store",
        //         artikels: fd,
        //         cache: false,
        //         processartikels: false,
        //         contentType: false,
        //         type: 'POST',
        //         success: function (res) {
        //             alert(res);
        //         }
        //     });
        // });

        $('#fotoartikel').change(function(){
            readURL(this,'#imgpreview');
        });
    });

</script>
@endsection
