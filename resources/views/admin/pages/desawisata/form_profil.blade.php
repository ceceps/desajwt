<form class="form-custom has-category" action="/" method="post">

    <div class="row setup-content" id="step-1">
            <div class="panel clean" id="profil">
                <!-- begin form style ---->
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
                                <input type="text" name="nama_desawisata" class="form-control"
                                    placeholder="contoh: batununggal" required="required">
                            </div>
                            <div class="category-field">
                                <label class="control-label">Kategori<em class="asterix">*</em></label>
                                <select name="idcat" class="form-control select2">
                                    <option value=""></option>
                                    <option value="1">Embrio</option>
                                    <option value="2">Berkembang</option>
                                    <option value="3">Maju</option>
                                </select>
                            </div>
                            <div class="category-field">
                                <label class="control-label">Pendirian Desa Wisata<em class="asterix">*</em></label>
                                <input type="text" name="tahun_berdiri" class="form-control"
                                    placeholder="Tahun" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                            <div class="category-field" style="width:90%">
                                <label class="control-label">Deskripsi<em class="asterix">*</em></label>
                                <textarea name="narasi" class="form-control" id="editor"
                                    placeholder="contoh: Deskripsi" required="required"></textarea>
                            </div>
                    </div>
                    <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                <label class="control-label">Kabupaten/Kota<em class="asterix">*</em></label>
                                <select name="kab_id" class="form-control select-kota" id="kabupaten_id">
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
                                <label class="control-label">SK Desa<em class="asterix">*</em></label>
                                <input type="text" name="sk_desa" class="form-control"
                                    placeholder="contoh: batununggal">
                            </div>
                            <div class="category-field">
                                <label class="control-label">SK Dinas Kota/Kabupaten
                                    <em class="asterix">*</em></label>
                                <input type="text" name="sk_kab" class="form-control"
                                    placeholder="contoh: batununggal">
                            </div>
                            <div class="category-field">
                                <label class="control-label">SK Dinas Provinsi
                                    <em class="asterix">*</em></label>
                                <input type="text" name="sk_provinsi" class="form-control"
                                    placeholder="contoh: batununggal">
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
                                <input type="text" name="longi" class="form-control"
                                    placeholder="contoh: 107.000">
                            </div>


                            <div class="category-field">
                                &nbsp;
                            </div>
                        </div>
                    </div>


                </div>

            </div>
    </div>
</form>
