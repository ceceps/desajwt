@extends('admin.layouts.layoutnew_admin')
@php
    header("Cache-Control", "no-cache, no-store, must-revalidate");

@endphp
@section('style')
    <link rel="stylesheet" href="{{ asset('css/sunburst.css') }}">
    <link rel="stylesheet" href="{{ asset('css/prettify.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

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
                    {!! date('d-m-Y H:i:s') !!}
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

        <form class="form-custom has-category dropzone" action="{{ url('backend/desawisata/store') }}" method="post" id="form-desawisata" enctype="multipart/form-data">
         {{ csrf_field() }}
          <ul class="nav nav-tabs responsive" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="profil-tab" data-toggle="tab" href="#profil"
                role="tab" aria-controls="profil" aria-selected="true">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pengelola-tab" data-toggle="tab" href="#pengelola" role="tab"
                aria-controls="pengelola" aria-selected="false">Pengelola</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="atraksi-tab" data-toggle="tab" href="#atraksi" role="tab"
                aria-controls="atraksi" aria-selected="false">Atraksi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="akses-tab" data-toggle="tab" href="#akses" role="tab"
                aria-controls="akses" aria-selected="false">Aksesibilitas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fasilitas-tab" data-toggle="tab" href="#fasilitas" role="tab"
                aria-controls="fasilitas" aria-selected="false">Fasilitas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="promosi-tab" data-toggle="tab" href="#promosi" role="tab"
                aria-controls="promosi" aria-selected="false">Promosi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="kelsos-tab" data-toggle="tab" href="#kelsos" role="tab"
                aria-controls="kelsos" aria-selected="false">Kelompok Sosial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="usaha-tab" data-toggle="tab" href="#usaha" role="tab"
                aria-controls="usaha" aria-selected="false">Usaha Pariwisata</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="statistik-tab" data-toggle="tab" href="#statistik" role="tab"
                aria-controls="statistik" aria-selected="false">Statistik</a>

            </li>
            <li class="nav-item">
              <a class="nav-link" id="bantuan-tab" data-toggle="tab" href="#bantuan" role="tab"
                aria-controls="bantuan" aria-selected="false">Bantuan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="dampak-tab" data-toggle="tab" href="#dampak" role="tab"
                aria-controls="dampak" aria-selected="false">Dampak & Pemanfaatan Bantuan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="jenmanfaat-tab" data-toggle="tab" href="#jenmanfaat"
                role="tab" aria-controls="jenmanfaat" aria-selected="false"> Penghargaan</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="profil" role="tabpanel" aria-labelledby="profil-tab">
              <div class="panel clean">
                <!-- begin form style -->
                <div class="form-based">

                  <!-- form title
                    *pakai class di bawah ini, bila akan ada action/option dari form title nya tambahkan class 'with-option', bila
                    tidak ada action sebaliknya, hanya untuk satu button/action
                  -->

                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Profil Desa Wisata</h4>
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
                    <div class="form-group">
                            <div class="form-category-entry">
                                    <div class="category-field">
                                      <label class="control-label">Gambar<em class="asterix">*</em></label>
                                      <div class="fallback">
                                        <input id="foto_fitur" type="file" name="filename[]" multiple class="form-control">
                                    </div>
                                        {{--Dropzone Preview Template--}}
                                        <div id="preview" style="display: none;">

                                                <div class="dz-preview dz-file-preview">
                                                    <div class="dz-image"><img data-dz-thumbnail /></div>

                                                    <div class="dz-details">
                                                        <div class="dz-size"><span data-dz-size></span></div>
                                                        <div class="dz-filename"><span data-dz-name></span></div>
                                                    </div>
                                                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                                                    <div class="dz-error-message"><span data-dz-errormessage></span></div>



                                                    <div class="dz-success-mark">

                                                        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                            <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                                                            <title>Check</title>
                                                            <desc>Created with Sketch.</desc>
                                                            <defs></defs>
                                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                                <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                                            </g>
                                                        </svg>

                                                    </div>
                                                    <div class="dz-error-mark">

                                                        <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                            <!-- Generator: Sketch 3.2.1 (9971) - http://www.bohemiancoding.com/sketch -->
                                                            <title>error</title>
                                                            <desc>Created with Sketch.</desc>
                                                            <defs></defs>
                                                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                                <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                                                    <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--End of Dropzone Preview Template--}}

                                     </div>
                                     <div class="category-field">
                                            &nbsp;
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
                      <h4 class="form-title">Pengelola Desa Wisata</h4>
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
            <div class="tab-pane fade" id="atraksi" role="tabpanel" aria-labelledby="atraksi-tab">
              <div class="panel clean">
                <!-- begin form style -->
                <div class="form-custom">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Atraksi</h4>
                      <p class="title-helper">Harap masukan semua input</p>
                    </div>

                  </div>
                  <div class="form-group">
                      <!--  Blog Ini inginnya Inline satu baris untuk add input -->
                        <div class="form-category-title">
                          <label class="main-label">Alam</label>
                        </div>
                      <div class="form-option">
                          <button type="button" class="btn btn-default" id="btnadd_atraksi">
                        <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>
                              Add new
                          </button>
                      </div>
                  </div>

                  <div class="form-group">
                      <table class="table table-striped" id="tbl_alam">
                        <thead>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Item</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                        </thead>
                        <tbody>
                        <td id="no">1</td>
                        <td>
                            <select name="kat_atraksi[]" class="form-control select-category" id="kategori_atraksi">
                                <option value=""></option>
                            </select></td>
                        <td><input type="text" name="ket_alam[]" class="form-control"></td>
                        <td><input type="file" name="file_alam[]" class="btn btn-success"></td>
                        <td><button class="btn btn-danger btn_alam_delete"><i class="mdi mdi-trash-can-outline"></i></span></button></td>
                        </tbody>
                      </table>

                  </div>
                  <div class="form-group">
                    <div class="form-category-title">
                      <label class="main-label">Budaya</label>

                    </div>
                    <div class="form-category-entry">
                      <div class="category-field">
                                                                <textarea name="atraksi_budaya" class="form-control col-6"
                                                                          placeholder="contoh: atraksi seni tari" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-category-title">
                      <label class="main-label">Buatan</label>

                    </div>
                    <div class="form-category-entry">
                      <div class="category-field">
                                                                <textarea name="atraksi_buatan" class="form-control col-6"
                                                                          placeholder="contoh: atraksi paralayang" rows="3"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="akses" role="tabpanel" aria-labelledby="akses-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form">
                    <h3 class="form-title">Aksesibilitas</h3>
                    <p class="title-helper">Harap masukan semua
                      input</p>

                  </div>

                  <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                          <div class="category-field">
                            <label class="control-label">Jarak dari
                                    Ibukota Provinsi<em class="asterix">*</em></label>
                                    <input type="text" name="jarak_prov" class="form-control"
                                    placeholder="...km" >
                          </div>
                          <div class="category-field">
                            <label class="control-label">Waktu<em class="asterix">*</em></label>
                            <input type="text" name="waktu_prov" class="form-control"
                                  placeholder="...jam" >
                          </div>
                          <div class="category-field">
                            &nbsp;
                          </div>

                        </div>
                   </div>

                  <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                          <div class="category-field">
                            <label class="control-label">Jarak dari
                                    Ibukota Kab/Kota<em class="asterix">*</em></label>
                                    <input type="text" name="jarak_kab" class="form-control"
                                    placeholder="...km" >
                          </div>
                          <div class="category-field">
                            <label class="control-label">Waktu<em class="asterix">*</em></label>
                            <input type="text" name="waktu_kab" class="form-control"
                                  placeholder="...jam" >
                          </div>
                          <div class="category-field">
                            &nbsp;
                          </div>

                        </div>
                   </div>
                  <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                          <div class="category-field">
                            <label class="control-label">Jarak dari
                                    Kecamatan<em class="asterix">*</em></label>
                                    <input type="text" name="jarak_kec" class="form-control"
                                    placeholder="...km" >
                          </div>
                          <div class="category-field">
                            <label class="control-label">Waktu<em class="asterix">*</em></label>
                            <input type="text" name="waktu_kec" class="form-control"
                                  placeholder="...jam" >
                          </div>
                          <div class="category-field">
                            &nbsp;
                          </div>
                        </div>
                   </div>
                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="fasilitas" role="tabpanel" aria-labelledby="fasilitas-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Fasilitas</h4>

                    </div>
                    <div class="form-option">
                      <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                        <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>

                        Add new
                      </button>
                    </div>
                  </div>
                    <div class="fieldset has-four">
                      <div class="field-item">
                        <label class="control-label">Item<em class="asterix">*</em></label>
                        <input type="text" name="item_fasilitas[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="field-item">
                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: batununggal"></textarea>
                      </div>
                      <div class="field-item">
                        <label class="control-label">Foto<em class="asterix">*</em></label>
                        <input type="file" name="foto_fasilitas[]" class="form-control for-upload">
                      </div>
                      <div class="field-item">
                        <label class="control-label">&nbsp;</label>
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>
                  <!--  <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Item<em class="asterix">*</em></label>
                        <input type="text" name="item_fasilitas[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: batununggal"></textarea>
                      </div>
                      <div class="category-field">
                        <label class="control-label">Foto<em class="asterix">*</em></label>
                        <input type="file" name="foto_fasilitas[]" class="form-control">

                      </div>
                      <div class="category-field">
                        <label class="control-label">&nbsp;</label>
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>-->


                  <div class="fieldset has-four">
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="text" name="item_fasilitas[]" class="form-control"
                            placeholder="contoh: Masjid">
                    </div>
                    <div class="field-item">
                      <label class="control-label"></label>
                      <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                placeholder="contoh: Parkir"></textarea>
                    </div>
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="file" name="foto_fasilitas[]" class="form-control for-upload btn-success btn-sm">
                    </div>
                    <div class="field-item">
                    <!-- <label class="control-label">&nbsp;</label>-->
                      <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                  </div>


                <!--  <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label"></label>
                        <input type="text" name="item_fasilitas[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="category-field">
                        <label class="control-label"></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: Parkir"></textarea>
                      </div>
                      <div class="category-field">
                        <label class="control-label"></label>
                        <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                      </div>
                      <div class="category-field">
                        <label class="control-label">&nbsp;</label>
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>
                  </div>-->

                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="promosi" role="tabpanel" aria-labelledby="promosi-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form">
                    <h4 class="form-title">Promosi</h4>
                    <p class="title-helper">Promosi yang dilakukan
                      Desa Wisata dalam
                      mendatangkan
                      wistawan</p>
                  </div>
                  <div class="form-group has-three-fields reset-inline">

                      <div class="category-field">
                        <label class="control-label">Brosur/Leaflet,
                          dll<em class="asterix">*</em></label>
                      </div>
                      <div class="category-field">
                        <div class="radio-group">
                          <div class="ted-radio">
                            <input id="p1" type="radio" name="pamplet" value="1">
                            <label for="p1"><em>Ada</em></label>
                          </div>
                          <div class="ted-radio">
                            <input id="p2" type="radio" name="pamplet" value="0">
                            <label for="p2"><em>Tidak</em></label>
                          </div>
                        </div>
                      </div>
                      <div class="category-field end">
                                                                <textarea type="text" name="ket_pamplet" class="form-control col-4"
                                                                          placeholder="Keterangan Pelaksanaan"></textarea>
                      </div>

                  </div>
                  <div class="form-group has-three-fields reset-inline">

                      <div class="category-field">
                        <label class="control-label">Pameran /
                          Festival<em class="asterix">*</em></label>
                      </div>
                      <div class="category-field">
                        <div class="radio-group">
                          <div class="ted-radio">
                            <input id="p3" type="radio" name="pameran" value="1">
                            <label for="p3"><em>Ada</em></label>
                          </div>
                          <div class="ted-radio">
                            <input id="p4" type="radio" name="pameran" value="0">
                            <label for="p4"><em>Tidak</em></label>
                          </div>
                        </div>
                      </div>
                      <div class="category-field end">
                                                                <textarea type="text" name="ket_pameran" class="form-control col-4"
                                                                          placeholder="Keterangan Pelaksanaan"></textarea>
                      </div>

                  </div>

                  <div class="form-group has-three-fields reset-inline">

                      <div class="category-field">
                        <label class="control-label">Website<em class="asterix">*</em></label>
                      </div>
                      <div class="category-field">
                        <div class="radio-group">
                          <div class="ted-radio">
                            <input id="p5" type="radio" name="web" value="1">
                            <label for="p5"><em>Ada</em></label>
                          </div>
                          <div class="ted-radio">
                            <input id="p6" type="radio" name="web" value="0">
                            <label for="p6"><em>Tidak</em></label>
                          </div>
                        </div>
                        <input type="text" id="url" name="url" class="form-control"
                              placeholder="http://">
                      </div>
                      <div class="category-field end">
                                                                <textarea type="text" name="ket_web" class="form-control col-4"
                                                                          placeholder="Keterangan Pelaksanaan"></textarea>
                      </div>

                  </div>


                  <div class="form-group has-three-fields reset-inline">

                      <div class="category-field">
                        <label class="control-label">Digital
                          Lainnya<em class="asterix">*</em></label>

                      </div>
                      <div class="category-field">
                        <div class="radio-group">
                          <div class="ted-radio">
                            <input id="p7" type="radio" name="digital" value="1">
                            <label for="p7"><em>Ada</em></label>
                          </div>
                          <div class="ted-radio">
                            <input id="p8" type="radio" name="digital" value="0">
                            <label for="p8"><em>Tidak</em></label>
                          </div>
                        </div>
                      </div>
                      <div class="category-field end">
                                                                <textarea type="text" name="ket_digital" class="form-control col-4"
                                                                          placeholder="Keterangan Pelaksanaan"></textarea>
                      </div>

                  </div>
                  <div class="form-group has-three-fields reset-inline">

                      <div class="category-field">
                        <label class="control-label">Promosi Lainnya<em class="asterix">*</em></label>

                      </div>
                      <div class="category-field">
                        <div class="radio-group">
                          <div class="ted-radio">
                            <input id="p9" type="radio" name="lainnya" value="1">
                            <label for="p9"><em>Ada</em></label>
                          </div>
                          <div class="ted-radio">
                            <input id="p10" type="radio" name="lainnya" value="0">
                            <label for="p10"><em>Tidak</em></label>
                          </div>
                        </div>
                      </div>
                      <div class="category-field end">
                                                                <textarea type="text" name="ket_lainnya" class="form-control col-4"
                                                                          placeholder="Keterangan Pelaksanaan"></textarea>
                      </div>

                  </div>

                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="kelsos" role="tabpanel" aria-labelledby="kelsos-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Kelompok Sosial</h4>

                    </div>
                    <div class="form-option">
                      <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                        <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>
                        Add new
                      </button>
                    </div>
                  </div>



                    <div class="fieldset has-five">
                      <div class="field-item">
                        <label class="control-label">Jenis
                          Kelompok<em class="asterix">*</em></label>
                        <select name="jen_kel[]" class="jen_kel form-control form-control select-category">
                          <option></option>
                          <option>Jenis Kelompok</option>
                          <option value="1">Kelompok Sadar
                            Wisata</option>
                          <option value="2">Kelompok Pemandu
                            Wisata</option>
                          <option value="3">Kelompok Sanggar
                            Kerajinan</option>
                          <option value="4">Kelompok Seni
                            Budaya</option>
                          <option value="5">Kelompok Makanan
                            Khas</option>
                          <option value="6">Kelompok Homestay</option>
                          <option value="7">Kelompok Jasa
                            Fotografi</option>
                          <option value="8">Kelompok Sarana
                            Pendukung Wisata
                            lainnya</option>
                        </select>
                      </div>
                      <div class="field-item">
                        <label class="control-label">
                            Jum Pengurus
                            <em class="asterix">*</em>
                        </label>
                        <input type="jum_kel" name="jum_kel[]" class="form-control">
                      </div>
                      <div class="field-item">
                        <label class="control-label">Jum Anggota<em class="asterix">*</em></label>
                        <input type="jum_tenaga" name="jum_tenaga[]" class="form-control">
                      </div>
                      <div class="field-item">
                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: batununggal"></textarea>
                      </div>
                      <div class="field-item align-center">
                        <button type="button" class="btn btn-clean"><i class="mdi mdi-trash-can-outline"></i></button>
                      </div>
                    </div>







                  <!--<div class="top-form">
                    <h4 class="form-title">Kelompok Sosial</h4>
                    <p class="title-helper"><a href="#" id="btnadd_fasilitas" class="btn btn-success btn-sm">Add</a></p>
                  </div>-->
                <!-- <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Jenis
                          Kelompok<em class="asterix">*</em></label>
                        <select name="jen_kel[]" class="jen_kel form-control col-7">
                          <option>Jenis Kelompok</option>
                          <option value="1">Kelompok Sadar
                            Wisata</option>
                          <option value="2">Kelompok Pemandu
                            Wisata</option>
                          <option value="3">Kelompok Sanggar
                            Kerajinan</option>
                          <option value="4">Kelompok Seni
                            Budaya</option>
                          <option value="5">Kelompok Makanan
                            Khas</option>
                          <option value="6">Kelompok Homestay</option>
                          <option value="7">Kelompok Jasa
                            Fotografi</option>
                          <option value="8">Kelompok Sarana
                            Pendukung Wisata
                            lainnya</option>
                        </select>
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jum
                          Kelompok/Organisasi<em class="asterix">*</em></label>
                        <input type="jum_kel" name="jum_kel[]" class="form-control">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jum Tenaga
                          Kerja<em class="asterix">*</em></label>
                        <input type="jum_tenaga" name="jum_tenaga[]" class="form-control">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: batununggal"></textarea>
                      </div>
                      <span class="badge badge-trash"><i class="mdi mdi-trash-can-outline"></i></span>

                    </div>
                  </div>-->
                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="usaha" role="tabpanel" aria-labelledby="usaha-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Usaha Pariwisata</h4>
                      <p class="title-helper">Harap masukan semua input</p>
                    </div>
                    <div class="form-option">
                      <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                        <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>
                        Add new
                      </button>
                    </div>
                  </div>
              <!--   <div class="top-form">
                    <h4 class="form-title">Usaha Pariwisata</h4>
                    <p class="title-helper"><a href="#" id="btnadd_fasilitas" class="btn btn-success btn-sm">Add</a></p>
                  </div>-->

                  <div class="fieldset has-five">
                    <div class="field-item">
                      <label class="control-label">Jenis
                        Usaha<em class="asterix">*</em></label>
                      <select name="jen_kel[]" class="jen_kel form-control select-category">
                        <option></option>
                        <option>--Jenis Usaha--</option>
                        <option value="1">Usaha Souvenir /
                          Kerajinan</option>
                        <option value="2">Usaha Pedagang
                          Tanaman Hias </option>
                      </select>
                    </div>
                    <div class="field-item">
                      <label class="control-label">Jumlah
                        Pengusaha<em class="asterix">*</em></label>
                      <input type="text" name="jum_usaha[]" class="form-control">
                    </div>
                    <div class="field-item">
                      <label class="control-label">Jum Tenaga
                        Kerja<em class="asterix">*</em></label>
                      <input type="text" name="jum_tenaga_usaha[]" class="form-control">
                    </div>
                    <div class="field-item">
                      <label class="control-label">Keterangan<em class="asterix">*</em></label>
                      <textarea type="text" name="ket_usaha[]" class="form-control"
                                placeholder="contoh: Cinderamata"></textarea>
                    </div>
                    <div class="field-item align-center">
                      <button type="button" class="btn btn-clean"><i class="mdi mdi-trash-can-outline"></i></button>
                    </div>

                  </div>

                <!-- <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Jenis
                          Usaha<em class="asterix">*</em></label>
                        <select name="jen_kel[]" class="jen_kel form-control col-7">
                          <option>&#45;&#45;Jenis Usaha&#45;&#45;</option>
                          <option value="1">Usaha Souvenir /
                            Kerajinan</option>
                          <option value="2">Usaha Pedagang
                            Tanaman Hias </option>
                        </select>
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jumlah
                          Pengusaha<em class="asterix">*</em></label>
                        <input type="text" name="jum_usaha[]" class="form-control">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jum Tenaga
                          Kerja<em class="asterix">*</em></label>
                        <input type="text" name="jum_tenaga_usaha[]" class="form-control">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                        <textarea type="text" name="ket_usaha[]" class="form-control"
                                  placeholder="contoh: Cinderamata"></textarea>
                      </div>
                      <span class="badge badge-trash"><i class="mdi mdi-trash-can-outline"></i></span>

                    </div>
                  </div>-->
                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="statistik" role="tabpanel" aria-labelledby="statistik-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Statistik Pariwisata</h4>
                      <p class="title-helper">Kunjungan Wisatawan per
                        Bulan</p>
                    </div>

                  </div>
                <!-- <div class="top-form">
                    <h4 class="form-title">Statistik Pariwisata</h4>
                    <p class="title-helper">Kunjungan Wisatawan per
                      Bulan</p>
                  </div>-->

                  <div class="fieldset has-four">
                    <div class="field-item">
                      <label class="control-label">Tahun <em class="asterix">*</em></label>
                      <select name="stat_tahun[]" class="form-control select-year">
                        <option></option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                        <option value="2015">2015</option>
                        <option value="2014">2014</option>
                        <option value="2013">2013</option>
                        <option value="2012">2012</option>
                        <option value="2011">2011</option>
                        <option value="2010">2010</option>
                        <option value="2009">2009</option>
                        <option value="2008">2008</option>
                        <option value="2007">2007</option>
                        <option value="2006">2006</option>
                        <option value="2005">2005</option>
                        <option value="2004">2004</option>
                        <option value="2003">2003</option>
                        <option value="2002">2002</option>
                        <option value="2001">2001</option>
                        <option value="2000">2000</option>
                      </select>
                    </div>
                    <div class="field-item">
                      <label class="control-label">Data <em class="asterix">*</em></label>
                      <input type="text" name="item_data_stat[]" class="form-control"
                            placeholder="Data Stattistik">
                    </div>
                    <div class="field-item">
                      <label class="control-label">Jumlah<em class="asterix">*</em></label>
                      <input type="text" name="item_fasilitas[]" class="form-control"
                            placeholder="contoh: Masjid">
                    </div>
                    <div class="field-item">
                      <label class="control-label">&nbsp;</label>
                      <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                  </div>

                  <div class="fieldset has-four">
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="text" name="item_fasilitas[]" class="form-control"
                            placeholder="contoh: Masjid">
                    </div>
                    <div class="field-item">
                      <label class="control-label"></label>
                      <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                placeholder="contoh: Parkir"></textarea>
                    </div>
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                    </div>
                    <div class="field-item">
                      <label class="control-label">&nbsp;</label>
                      <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                  </div>



                <!--  <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label">Tahun <em class="asterix">*</em></label>
                        <select name="stat_tahun[]" class="form-control col-sm"
                                style="
            width: 70px;">
                          <option value="2018">2018</option>
                          <option value="2017">2017</option>
                          <option value="2016">2016</option>
                          <option value="2015">2015</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                        </select> </div>
                      <div class="category-field">
                        <label class="control-label">Data <em class="asterix">*</em></label>
                        <input type="text" name="item_data_stat[]" class="form-control"
                              placeholder="Data Stattistik">
                      </div>
                      <div class="category-field">
                        <label class="control-label">Jumlah<em class="asterix">*</em></label>
                        <input type="text" name="item_fasilitas[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>

                      <div class="category-field">
                        <label class="control-label">&nbsp;</label>
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>
                  </div>-->

                <!--  <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label"></label>
                        <input type="text" name="item_fasilitas[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="category-field">
                        <label class="control-label"></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: Parkir"></textarea>
                      </div>
                      <div class="category-field">
                        <label class="control-label"></label>
                        <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                      </div>
                      <div class="category-field">
                        <label class="control-label">&nbsp;</label>
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>
                  </div>-->

                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="bantuan" role="tabpanel" aria-labelledby="bantuan-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-based">
                  <!--<div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Bantuan Dana Pariwisata</h4>
                    </div>

                  </div>-->
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Bantuan Dana Pariwisata</h4>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="radio-group">
                      <div class="ted-radio">
                        <input id="pb1" type="radio" name="pamplet" value="1">
                        <label for="pb1"><em>Pernah</em></label>
                      </div>
                      <div class="ted-radio">
                        <input id="pb2" type="radio" name="pamplet" value="0">
                        <label for="pb2"><em>Tidak</em></label>
                      </div>
                    </div>
                  </div>

                <!--  <div class="top-form">
                    <h4 class="form-title">Bantuan Dana Pariwisata</h4>
                    <p class="title-helper">
                    <div class="radio-group">
                      <div class="ted-radio">
                        <input id="pb1" type="radio" name="pamplet" value="1">
                        <label for="pb1"><em>Pernah</em></label>
                      </div>
                      <div class="ted-radio">
                        <input id="pb2" type="radio" name="pamplet" value="0">
                        <label for="pb2"><em>Tidak</em></label>
                      </div>
                    </div>
                    </p>
                  </div>-->
                  <div class="form-group">
                    <div class="form-category-entry">
                      <label class="control-label">Program
                        Bantuan <em class="asterix">*</em></label>
                      <div class="category-field">
                        <input type="text" name="nama_program" id="nama_program"
                              class="form-control" placeholder="nama program"
                              aria-describedby="helpId">

                      </div>
                      <br>
                      <a class="btn btn-default" id="add_tahun_bantuan">
                        Tambah Tahun</a>
                    </div>
                  </div>

                    <div class="fieldset has-four">
                      <div class="field-item">
                        <label class="control-label">Tahun <em class="asterix">*</em></label>
                        <select name="dana_tahun[]" class="form-control select-year">
                          <option></option>
                          <option value="2017">2017</option>
                          <option value="2016">2016</option>
                          <option value="2015">2015</option>
                          <option value="2014">2014</option>
                          <option value="2013">2013</option>
                          <option value="2012">2012</option>
                          <option value="2011">2011</option>
                          <option value="2010">2010</option>
                          <option value="2009">2009</option>
                          <option value="2008">2008</option>
                          <option value="2007">2007</option>
                          <option value="2006">2006</option>
                          <option value="2005">2005</option>
                          <option value="2004">2004</option>
                          <option value="2003">2003</option>
                          <option value="2002">2002</option>
                          <option value="2001">2001</option>
                          <option value="2000">2000</option>
                        </select>
                      </div>
                      <div class="field-item">
                        <label class="control-label">Besar Dana
                          <em class="asterix">*</em></label>
                        <input type="text" name="jum_dana[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="field-item">
                        <label class="control-label">Penggunaan
                          Untuk<em class="asterix">*</em></label>
                        <input type="text" name="dana_untuk[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="field-item align-center">
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>



                <!-- end form style ---->
              </div>
              </div>
            </div>
            <div class="tab-pane fade" id="dampak" role="tabpanel" aria-labelledby="dampak-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-custom">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Dampak Bantuan Wisata</h4>
                      <p class="title-helper">Harap masukan semua input</p>
                    </div>
                    <div class="form-option">
                      <button type="button" class="btn btn-default" id="btnadd_program">
                        <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>
                        Add new
                      </button>
                    </div>
                  </div>




              <!--    <div class="table-responsive">
                    <table>
                      <thead>
                      <th width="30%">Uraian</th>
                      <th width="10%"> 2015</th>
                      <th width="10%"> 2016</th>
                      <th width="10%"> 2017</th>
                      <th width="10%"> Dari Awal s/d 2018</th>
                      <th width="10%">Keterangan</th>
                      </thead>
                      <tbody>
                      <td width="30%"><input type="text" name="uraian[]" class="uraian"></td>
                      <td width="10%"><input type="text" name="2015[]" class="2015"></td>
                      <td width="10%"><input type="text" name="2016[]" class="2016"></td>
                      <td width="10%"><input type="text" name="2017[]" class="2017"></td>
                      <td width="10%"><input type="text" name="2018[]" class="2018"></td>
                      <td width="30%"><input type="text" name="ket[]" class="ket"></td>
                      </tbody>
                    </table>
                  </div>-->

                  <div class="form-group">
                    <div class="fieldset has-six">
                      <div class="field-item">
                        <label class="control-label">Uraian<em class="asterix">*</em></label>
                        <input type="text" class="form-control uraian" name="uraian[]">
                      </div>
                      <div class="field-item">
                        <label class="control-label">2015<em class="asterix">*</em></label>
                        <input type="text" class="form-control 2015" name="2015[]">
                      </div>
                      <div class="field-item">
                        <label class="control-label">2016<em class="asterix">*</em></label>
                        <input type="text" class="form-control 2016" name="2016[]">
                      </div>
                      <div class="field-item">
                        <label class="control-label">2017<em class="asterix">*</em></label>
                        <input type="text" class="form-control 2017" name="2017[]">
                      </div>
                      <div class="field-item">
                        <label class="control-label">Dari Awal s/d 2018<em class="asterix">*</em></label>
                        <input type="text" class="form-control 2018" name="2018[]">
                      </div>
                      <div class="field-item">
                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                        <input type="text" class="form-control ket" nam="ket[]">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end form style ---->
              </div>
            </div>
            <div class="tab-pane fade" id="jenmanfaat" role="tabpanel" aria-labelledby="jenmanfaat-tab">
              <div class="panel clean">
                <!-- begin form style ---->
                <div class="form-custom">
                  <div class="top-form with-option">
                    <div class="form-title">
                      <h4 class="form-title">Usaha Pariwisata</h4>
                    </div>
                    <div class="form-option">
                      <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                        <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>
                        Tambah
                      </button>
                    </div>
                  </div>

                <!-- <div class="top-form">
                    <h4 class="form-title">Usaha Pariwisata</h4>
                    <p class="title-helper"><a href="#" id="btnadd_fasilitas" class="btn btn-success btn-sm">Add</a></p>
                  </div>-->


                  <div class="fieldset has-four">
                    <div class="field-item">
                      <label class="control-label">Item<em class="asterix">*</em></label>
                      <input type="text" name="item_fasilitas[]" class="form-control"
                            placeholder="contoh: Masjid">
                    </div>
                    <div class="field-item">
                      <label class="control-label">Keterangan<em class="asterix">*</em></label>
                      <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                placeholder="contoh: batununggal"></textarea>
                    </div>
                    <div class="field-item">
                      <label class="control-label">Foto<em class="asterix">*</em></label>
                      <input type="file" name="foto_fasilitas[]" class="form-control">
                    </div>
                    <div class="field-item">
                      <label class="control-label">&nbsp;</label>
                      <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                  </div>
                  <div class="fieldset has-four">
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="text" name="item_fasilitas[]" class="form-control"
                            placeholder="contoh: Masjid">
                    </div>
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                    </div>
                    <div class="field-item">
                      <label class="control-label"></label>
                      <input type="file" name="foto_fasilitas[]" class="form-control">
                    </div>
                    <div class="field-item">
                      <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                  </div>


                <!-- <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                        <label class="control-label"></label>
                        <input type="text" name="item_fasilitas[]" class="form-control"
                              placeholder="contoh: Masjid">
                      </div>
                      <div class="category-field">
                        <label class="control-label"></label>
                        <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                  placeholder="contoh: Parkir"></textarea>
                      </div>
                      <div class="category-field">
                        <label class="control-label"></label>
                        <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                      </div>
                      <div class="category-field">
                        <label class="control-label">&nbsp;</label>
                        <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                      </div>
                    </div>
                  </div>-->

                </div>
                <!-- end form style ---->
              </div>
            </div>
          </div>


            <!-- class outer untuk di tab saja yang lokasi nya di luar tab -->
            <div class="button-action outer">
              <button type="submit" class="btn btn-default brand">
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
    <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/tab.js')}}"></script>
    <script src="{{ asset('js/ckeditor.js')}}"></script>
    {{--<script src="https://cdn.ckeditor.com/4.10.1/standard-all/ckeditor.js"></script>--}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script src="{{ asset('js/dropzone.config.js')}}"></script> --}}
    <script>

        $(document).ready(function (e) {

            var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
            var add_alam      = $(".add_alam"); //Add button ID
            var add_budaya      = $(".add_budaya"); //Add button ID
            var add_buatan      = $(".add_buatan"); //Add button ID

            var hiddenAlam = '<input type="hidden" name="idalam[]">';
            var cboAlam = '<select name="atraksi_alam[]" class="form-control"><option></option></select>';
            var ketalam = '<input type="text" name="ket_alam[]">';
            var filealam = '<input type="file" name="file_alam[]">';
            var delalam = '<a href="" id="btn_delete"><span class="badge badge-danger"><i class="mdi mdi-trash-can-outline"></i></span></a>';

            // $("div#foto_fitur").dropzone({ url: "/backend/post_upload",
            //     maxFilesize: 12,
            //         renameFile: function(file) {
            //             var dt = new Date();
            //             var time = dt.getTime();
            //         return time+file.name;
            //         },
            //         paramName:"filename",
            //         acceptedFiles: ".jpeg,.jpg,.png,.gif",
            //         addRemoveLinks: true,
            //         timeout: 5000,
            //         success: function(file, response)
            //         {
            //             console.log(response);
            //         },
            //         error: function(file, response)
            //         {
            //         return false;
            //         }
            //    });


            });
    </script>
    @endsection
