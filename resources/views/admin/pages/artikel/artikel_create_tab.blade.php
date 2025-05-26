@extends('admin.layouts.layoutnew_admin')
@php
    header("Cache-Control", "no-cache, no-store, must-revalidate");

@endphp
@section('style')
    <link rel="stylesheet" href="{{ asset('css/sunburst.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prettify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">
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
                                <a href="{{ route('backend/dashboard') }}">
                                    <i class="mdi mdi-home"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('backend/desawisata.all') }}">
                                    <i class="mdi mdi-chevron-right"></i>
                                    Desa Wisata
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
    <!-- begin dashboard content -->
<div class="dashboard-content">
    <div class="dashboard-inner">
      <div class="container-fluid">
        <form class="form-custom has-category" action="{{ url('backend/artikel/store') }}" method="post" id="form-desawisata" enctype="multipart/form-data">
         @csrf
          <ul class="nav nav-tabs responsive" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="posting-artikel-tab" data-toggle="tab" href="#posting-artikel"
                role="tab" aria-controls="posting-artikel" aria-selected="true">Posting Artikel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pengelola-tab" data-toggle="tab" href="#pengelola" role="tab"
                aria-controls="pengelola" aria-selected="false">Gambar dan Video</a>
            </li>

          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="posting-artikel" role="tabpanel" aria-labelledby="posting-artikel-tab">
              <div class="panel clean">
                <!-- begin form style -->
                <div class="form-based">

                  <!-- form title
                    *pakai class di bawah ini, bila akan ada action/option dari form title nya tambahkan class 'with-option', bila
                    tidak ada action sebaliknya, hanya untuk satu button/action
                  -->

                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Posting Artikel</h4>
                      <p class="title-helper">Harap masukan semua input</p>
                    </div>
                  </div>
                  <!--<form class="form-custom has-category">-->
                  <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Nama Desa Wisata<em class="asterix">*</em></label>
                        <input type="text" name="nama_desawisata" class="form-control" placeholder="contoh: batununggal"
                              >
                      </div>
                      <div class="category-field">
                        <label class="control-label">Kategori<em class="asterix">*</em></label>
                        <select name="idcat" class="form-control select-category">
                          <option value=""></option>
                          <option value="1">Embrio</option>
                          <option value="2">Berkembang</option>
                          <option value="3">Maju</option>
                        </select>
                      </div>
                      <div class="category-field">
                        <label class="control-label">Pendirian Desa Wisata<em class="asterix">*</em></label>
                        <input type="text" name="tahun_berdiri" max-width="4" class="form-control"
                              placeholder="Tahun" >
                      </div>
                    </div>
                  </div>
                  <div class="form-group has-two-fields">
                    <div class="form-category-entry">
                      <div class="category-field" style="">
                        <label class="control-label">Deskripsi<em class="asterix">*</em></label>
                        <textarea name="narasi" class="form-control" id="editor"
                                  placeholder="contoh: Deskripsi" ></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Kabupaten/Kota<em class="asterix">*</em></label>
                        <select name="kab_id" class="form-control select-kota" id="kabupaten_id" >
                          <option></option>

                        </select>
                      </div>
                      <div class="category-field">
                        <label class="control-label">Kecamatan<em class="asterix">*</em></label>
                        <select name="kec_id" class="form-control select-kecamatan" id="kecamatan_id">
                          <option></option>
                        </select>
                      </div>
                      <div class="category-field">
                        <label class="control-label">Kelurahan/Desa<em class="asterix">*</em></label>
                        <select name="kel_id" class="form-control select-desa" id="kelurahan_id">
                          <option></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label" id="sk_desa">SK Desa<em class="asterix">*</em></label>
                        <input type="text" name="sk_desa" id="sk_desa" class="form-control" placeholder="contoh: batununggal">
                      </div>
                      <div class="category-field">
                        <label class="control-label" id="sk_kab">SK Dinas Kota/Kabupaten
                        <input type="text" name="sk_kab" id="sk_kab" class="form-control" placeholder="contoh: batununggal">
                      </div>
                      <div class="category-field">
                            <label class="control-label" id="sk_prov">SK Dinas Provinsi
                            <input type="text" name="sk_prov" id="sk_prov" class="form-control" placeholder="contoh: batununggal" >
                      </div>
                    </div>
                  </div>
                  <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                     <div class="category-field">
                       <label class="control-label">Latitude<em class="asterix">*</em></label>
                       <input type="text" name="lat" class="form-control" placeholder="contoh: 16.000">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Longitude<em class="asterix">*</em></label>
                        <input type="text" name="longi" class="form-control" placeholder="contoh: 107.000">
                      </div>

                      <div class="category-field">
                          &nbsp;
                      </div>
                    </div>
                    </div>


                </div>

              </div>
            </div>
            <div class="tab-pane fade" id="pengelola" role="tabpanel" aria-labelledby="pengelola-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Gambar dan Video</h4>
                      <p class="title-helper">Harap masukan semua input dengan tanda <em class="asterix">*</em></p>
                    </div>
                  </div>
                  <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Nama Unit<em class="asterix">*</em></label>
                        <input type="text" nama="nama_unit" class="form-control"
                              placeholder="contoh: Kelompok Pengelola" >
                      </div>
                      <div class="category-field">
                        <label class="control-label" id="nama_pimpinan">Nama Pimpinan<em class="asterix">*</em></label>
                        <input type="text" name="nama_pimpinan" class="form-control"
                              placeholder="Bpk/Ibu"  id="nama_pimpinan">
                      </div>
                      <div class="category-field">
                        <label class="control-label">No. HP<em class="asterix">*</em></label>
                        <input type="text" name="nohp_pemimpin" class="form-control"
                              placeholder="081xxx" >
                      </div>

                    </div>
                  </div>
                  <div class="form-group has-three-fields">

                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Kontak Person<em class="asterix">*</em></label>
                        <input type="text" name="kontak_person" class="form-control"
                              placeholder="contoh: batununggal">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jabatan<em class="asterix">*</em></label>
                        <input type="text" name="jabatan" class="form-control"
                              placeholder="contoh: batununggal">
                      </div>
                      <div class="category-field">
                        <label class="control-label">No. HP<em class="asterix">*</em></label>
                        <input type="text" name="hp_cp" class="form-control"
                              placeholder="081xxx">
                      </div>
                    </div>
                  </div>
                  <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Email<em class="asterix">*</em></label>
                        <input type="text" class="form-control" placeholder="contoh: batununggal">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Website<em class="asterix">*</em></label>
                        <input type="text" class="form-control" placeholder="contoh: batununggal">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jumlah Pengelola
                          <em class="asterix">*</em></label>
                        <input type="text" class="form-control col-sm-2-12"
                              placeholder="contoh: batununggal">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-category-entry">
                      <label class="control-label">Regulasi
                        <em class="asterix">*</em></label>
                      <input type="text" name="perdes" class="form-control" >
                    </div>

                  </div>
                </div>
                <!-- end form style ---->
              </div>
            </div>
          </div>


            <!-- class outer untuk di tab saja yang lokasi nya di luar tab -->
            <div class="button-action outer">
                    <div id="loadingDiv" style="z-index: 999"><img src="{{ asset('images/ajax-loader.gif') }}" alt="loading"></div>
              <button type="submit" class="btn btn-default brand">
                Simpan
              </button>
              <button type="button" class="btn btn-default btn-flat" javascript="window.back(1)">
                Batal
              </button>
            </div>
        </form>
      </div>
    </div>
  <!-- end dashboard content -->

  </div>

@endsection
@section('script')
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/tab.js')}}"></script>
    <script src="{{ asset('js/ckeditor.js')}}"></script>
    {{--<script src="https://cdn.ckeditor.com/4.10.1/standard-all/ckeditor.js"></script>--}}
    <script src="{{ asset('js/dropzone.js')}}"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file_artikel", // The name that will be used to transfer the file
            maxFilesize: 8, // MB
            clickable : true,
            uploadMultiple :true,
            addRemoveLinks:true,
            dictRemoveFile: "Remove File",
            dictDefaultMessage:"Hey Yo"

        };


    </script>
@endsection
@section('script')
    <script>
        $(document).ready(function (e) {
            e.preventDefault();
            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_alam      = $(".add_alam"); //Add button ID
            var add_budaya      = $(".add_budaya"); //Add button ID
            var add_buatan      = $(".add_buatan"); //Add button ID

            var hiddenAlam = '<input type="hidden" name="idalam[]">';
            var cboAlam = '<select name="atraksi_alam[]" class="form-control"><option></option></select>';
            var ketalam = '<input type="text" name="ket_alam[]">';
            var filealam = '<input type="file" name="file_alam[]">';
            var delalam = '<a href="" id="btn_delete"><span class="badge badge-danger"><i class="mdi mdi-trash-can-outline"></i></span></a>';
        });
    </script>
    @endsection
