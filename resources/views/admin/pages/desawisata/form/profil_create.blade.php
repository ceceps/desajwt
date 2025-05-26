@php $foto = 'images/profil_desawisata.png';
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
                @include('admin.partial.message')
                <div class="media-placeholder">
                    <img src="{{ asset($foto) }}" class="img-fluid" alt="Upload File" id="imgpreview">
                </div>
                <br>
                <br>
                <div class="form-group has-two-fields ">
                    <div class="category-field">
                        <label class="control-label">Foto Desa Wisata<em class="asterix">*</em></label>
                        <input name="fotodesawisata" class="form-control" id="fotodesawisata" type="file" required>
                        <small class="help-block">Dimensi minimal 600x300px</small>
                    </div>
                    <div class="category-field">
                        <label class="control-label">Info Foto</label>
                        <input type="text" id="alt_foto" name="alt_foto" class="form-control" placeholder="Info gambar" value="{{ Input::old('alt_foto') }} ">
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Nama Desa Wisata<em class="asterix">*</em></label>
                            <input type="text" name="nama_desawisata" class="form-control" placeholder="contoh: batununggal" value="{{ Input::old('nama_desawisata') }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Kategori<em class="asterix">*</em></label>
                            <select name="idcat" class="form-control select2" data-placeholder="Kategori">
                                <option value=""></option>
                                <option value="1">Embrio</option>
                                <option value="2">Berkembang</option>
                                <option value="3">Maju</option>
                            </select>
                        </div>
                        <div class="category-field">
                            <label class="control-label">Pendirian Desa Wisata<em class="asterix">*</em></label>
                            {!! Form::select('tahun_berdiri',$tahun,[Input::old('tahun_berdiri')],['class'=>'form-control select2','data-placeholder'=>'Tahun Pendirian']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="category-field" style="width:98%">
                        <label class="control-label">Deskripsi<em class="asterix">*</em></label>
                        <textarea name="deskripsi" class="form-control" id="editor" placeholder="contoh: Deskripsi">{{ Input::old('deskripsi') }}</textarea>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Kelurahan/Desa<em class="asterix">*</em></label>
                            <input type="text" name="kelurahan" id="kelurahan_nama" class="form-control col-md-7" value="{{ Input::old('kelurahan') }}">
                            <input type="hidden" name="kel_id" id="kelurahan_id" value="{{ Input::old('kel_id') }}">

                        </div>
                        <div class="category-field">
                            <label class="control-label">Kecamatan</label>
                            <input type="text" id="kecamatan_nama" name="kecamatan_nama" class="form-control col-md-7"  readonly value="{{ Input::old('kecamatan_nama') }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Kabupaten</label>
                            <input type="text" id="kabupaten_nama" name="kabupaten_nama" class="form-control col-md-7" readonly value="{{ Input::old('kabupaten_nama') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">SK Desa </label>
                            <input type="text" name="sk_desa" class="form-control" placeholder="contoh: batununggal" value="{{ Input::old('sk_desa') }}">
                            <input type="text" name="tgl_sk_desa" class="form-control tgl"  placeholder="01-01-2000" value="{{ Input::old('tgl_sk_desa') }}">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>

                        </div>
                        <div class="category-field">
                            <label class="control-label">SK Dinas Kota/Kabupaten</label>
                            <input type="text" name="sk_dinas_kab" class="form-control" placeholder="contoh: batununggal" value="{{ Input::old('sk_dinas_kab') }}">
                            <input type="text" name="tgl_sk_kab" class="form-control tgl" id="tgl_kab" placeholder="01-01-2011" value="{{ Input::old('tgl_sk_kab') }}">
                            <span><i class="fa fa-calendar"></i></span>


                        </div>
                        <div class="category-field">
                            <label class="control-label">SK Dinas Provinsi</label>
                            <input type="text" name="sk_provinsi" class="form-control" placeholder="contoh: batununggal" value="{{ Input::old('sk_provinsi') }}">
                            <input type="text" name="tgl_sk_prov" class="form-control tgl" id="tgl_prov" placeholder="01-01-2000" value="{{ Input::old('tgl_sk_prov') }}">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            {{-- <div class="input-append date" id="tgl_prov" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                <input class="span2" size="16"  name="tgl_sk_desa" type="text" value="12-02-2012">
                                <span class="add-on"><i class="icon-th"></i></span>
                              </div> --}}
                        </div>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Latitude </label>
                            <input type="text" name="lat" class="form-control" placeholder="contoh: 16.000" value="{{ Input::old('lat') }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Longitude </label>
                            <input type="text" name="longi" class="form-control" placeholder="contoh: 107.000" value="{{ Input::old('longi') }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Ketinggian (dalam mdpl) </label>
                            <input type="number" name="ketinggian" class="form-control" placeholder="contoh: 107.000 " value="{{ Input::old('longi') }}" style="width:40%">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Luas (dalam Ha) </label>
                            <input name="luas" id="luas" type="number" class="form-control" placeholder="Luas Kawasan" value="{{ Input::old('luas') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Batasan Desa Wisata </label>
                            <textarea name="batasan_desa" id="batasan_desa" cols="15" rows="5" class="form-control" placeholder="Luas Kawasan">{{ Input::old('batasan_desa') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Video Profil<em class="asterix">*</em></label>
                            <input type="text" id="video_desawisata" name="video_desawisata" value="{!! Input::old('video_desawisata')!=null?$Input::old('video_desawisata'):'' !!}" class="form-control" placeholder="Judul Video" >
                        </div>
                        <div class="category-field">
                                <label class="control-label">&nbsp;</label>
                                <a href="" class="popup_selector btn btn-success" data-inputid="video-desawisata">Unggah Video</a>
                                <span id="nama_file"></span>
                                <input type="hidden" name="video_profil" id="video-desawisata" class="form-control" name="filename" placeholder="Nama File" value="{!! isset($filenameVideo)?$filenameVideo:'' !!}">

                        </div>
                        <div class="category-field">
                                <label class="control-label">Tgl Data<em class="asterix">*</em></label>
                               <input type="text" name="tgl_data" id="tgl_data" class="form-control tgl" placeholder="contoh: 01-01-2000" value="{{ Input::old('tgl_data') }}">
                               <div class="help-block with-errors"></div>
                        </div>
                        <div class="category-field">
                            <label class="control-label">Status<em class="asterix">*</em></label>
                            <select name="status" class="form-control" id="status">
                                <option value="">--Status--</option>
                                <option value="1">Tampil</option>
                                <option value="0" selected>Draft</option>
                            </select>
                             <div class="help-block with-errors"></div>
                    </div>

                    </div>
                </div>
            </div>
    {{-- </form> --}}
</div>
