<div class="form-based">
    <div class="top-form with-option">
        <div class="form-title">
            <h4 class="form-title">Profil Desa</h4>
            <p class="title-helper">
                Semua input bertanda <em class="asterix">*</em> harus diisi
            </p>
        </div>
    </div>
    <div class="form-group has-fields media-placeholder">
        <img src="{{ asset($foto) }}" class="img-fluid" alt="Upload File" id="imgpreview">
    </div>
    <div class="form-group has-two-fields ">
        <div class="form-category-entry">
            <div class="category-field">
                <label class="control-label">Foto Profil Desa<em class="asterix">*</em></label>
                <input name="fotodesa" class="form-control" id="fotodesa" type="file">
            </div>
            <div class="category-field">
                <label class="control-label">Info Foto <em class="asterix">*</em></label>
                <input type="text" id="alt_foto" name="alt_foto" class="form-control" placeholder="Info gambar" value="{{ Input::old('alt_foto') }} ">
            </div>
        </div>
    </div>
    <div class="form-group has-three-fields">
        <div class="form-category-entry">
            <div class="category-field">
                <label class="control-label">Kelurahan/Desa<em class="asterix">*</em></label>
                <input type="text" name="kelurahan_nama" id="kelurahan_nama" class="form-control">
                <input type="hidden" name="kel_id" id="kelurahan_id">
            </div>
            <div class="category-field">
                <label class="control-label">Kecamatan</label>
                <input class="form-control" id="kecamatan_nama" readonly>
            </div>
            <div class="category-field">
                <label class="control-label">Kabupaten/Kota</label>
                <input type="text" id="kabupaten_nama" class="form-control" readonly>
            </div>
        </div>
    </div>
    <div class="form-group has-three-fields">
        <div class="form-category-entry">
            <div class="category-field">
                <label class="control-label">SK Pendirian<em class="asterix">*</em></label>
                <input type="text" name="pendirian_sk" id="pendirian_sk" class="form-control" />
                <input type="text" name="tgl_sk_pendirian" id="tgl_sk_pendirian" class="form-control tgl" placeholder="00-00-0000" />
            </div>
            <div class="category-field">
                <label class="control-label">Kepala Desa Terakhir<em class="asterix">*</em></label>
                <input type="text" name="kades" id="kades" class="form-control" />
            </div>
            <div class="category-field">
                <label class="control-label">No HP<em class="asterix" >*</em></label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Deskripsi <em class="asterix" >*</em></label>
        <textarea name="deskripsi" class="deskripsi" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group has-four-fields">
        <div class="form-category-entry">
            <div class="category-field">
                <label for="latitude" class="control-label">Latitude</label>
                <input type="text" name="lat" id="lat" class="form-control">
            </div>
            <div class="category-field">
                <label for="latitude" class="control-label">Longitude</label>
                <input type="text" name="longi" id="longi" class="form-control">
            </div>
            <div class="category-field">
                <label for="latitude" class="control-label">Data Tahun</label>
                {!! Form::select('data_tahun',$tahun,[],['class'=>'form-control select2','data-placeholder'=>'Tahun Pendirian']) !!}
            </div> <div class="category-field">
                <label for="latitude" class="control-label">Status</label>
               <select name="status" id="status" class="form-control select2" data-placehoder="Status">
                   <option value="0">Draft</option>
                   <option value="1">Tampil</option>
               </select>
            </div>
        </div>
    </div>
</div>
