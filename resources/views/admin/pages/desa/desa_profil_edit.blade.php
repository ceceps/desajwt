<div class="panel clean">
        <!-- begin form style -- -->
        <div class="form-based">
            <div class="top-form with-option">
                <div class="form-title">
                    <h4 class="form-title">Profil Desa</h4>
                    <p class="title-helper">
                        Harap masukan semua input
                    </p>
                </div>
            </div>
            <div class="form-group has-three-fields">
                <div class="form-category-entry">
                    <div class="category-field">
                        <label class="control-label">Nama Kelurahan/Desa<em class="asterix">*</em></label>
                        <input type="text" name="nama_desa" id="kelurahan_nama"
                            value="{{ $profdesa->kelurahan['nama'] }}" class="form-control">
                    </div>
                    <div class="category-field">
                        <label class="control-label">Kecamatan<em class="asterix">*</em></label>
                        <input name="kec_id" class="form-control" id="kabupaten_id" value="{{ $profdesa->kelurahan->kecamatan['nama'] }}" readonly>
                    </div>
                    <div class="category-field">
                        <label class="control-label">Kabupaten/Kota<em class="asterix">*</em></label>
                        <input name="kab_id" class="form-control " id="kabupaten_id" value="{{ $profdesa->kelurahan->kecamatan->kabupaten['nama'] }}" readonly >
                    </div>
                </div>
            </div>
            <div class="form-group has-three-fields">
                <div class="form-category-entry">
                    <div class="category-field">
                        <label class="control-label">SK Pendirian<em class="asterix">*</em></label>
                        <input type="text" name="sk_pendirian" id="sk_pendirian" class="form-control"
                            value="{{ $profdesa['pendirian_sk']}}" />
                    </div>
                    <div class="category-field">
                        <label class="control-label">Nama Kepala Desa<em class="asterix">*</em></label>
                        <input type="text" name="kepdesa" id="kepdesa" class="form-control"
                            value="{{ $profdesa['kades'] }}" />
                    </div>
                    <div class="category-field">
                        <label class="control-label">No HP<em class="asterix">*</em></label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control"
                            value="{{ $profdesa['no_hp'] }}" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Deskripsi <em class="asterix">*</em></label>
                <textarea name="deskripsi" id="deskripsi" cols="30"
                    rows="10">{{ $profdesa['deskripsi'] }}</textarea>
            </div>
            <div class="form-group has-four-fields">
                <div class="form-category-entry">
                    <div class="category-field">
                        <label for="latitude" class="control-label">Latitude</label>
                    <input type="text" name="lat" id="lat" class="form-control" value="{{ $profdesa->lat }}">
                    </div>
                    <div class="category-field">
                        <label for="latitude" class="control-label">Longitude</label>
                        <input type="text" name="longi" id="longi" class="form-control" value="{{ $profdesa->longi }}">
                    </div>
                    <div class="category-field">
                        <label for="latitude" class="control-label">Data Tahun</label>
                        {!! Form::select('data_tahun',$tahun,$profdesa->data_tahun,['class'=>'form-control select2','data-placeholder'=>'Tahun Pendirian']) !!}
                    </div> <div class="category-field">
                        <label for="latitude" class="control-label">Status</label>
                       <select name="status" id="status" class="form-control select2" data-placehoder="Status">
                           <option value="0" {{ ($profdesa->status==0)?'selected':'' }}>Draft</option>
                           <option value="1" {{ ($profdesa->status==1)?'selected':'' }}>Tampil</option>
                       </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
