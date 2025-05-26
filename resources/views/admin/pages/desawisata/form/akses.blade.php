    <div class="setup-content">
        <div id="akses" aria-labelledby="akses-tab">

            @if(isset($desawisata))
            <!-- begin form style ---->
            <div class="form-based">
                <div class="top-form">
                    <h3 class="form-title">Aksesibilitas {!! isset($nama_desawisata)?$nama_desawisata:'&nbsp;'; !!}</h3>
                    <p class="title-helper">Harap masukan semua input
                    </p>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Jarak dari Ibukota Provinsi<em class="asterix">*</em></label>
                        <input type="text" name="jarak_dari_ibukota" class="form-control" placeholder="0" value="{{ isset($desawisata->Akses->jarak_dari_ibukota)?$desawisata->Akses->jarak_dari_ibukota:'' }}">
                            <input type="hidden" name="desa_wisata_id" class="form-control" placeholder="...km" required="required" value="{{ isset($idprofil)?$idprofil:'' }}">
                        </div>
                        <div class="category-field">
                                <label class="control-label">&nbsp;</label>
                                {{ Form::select('satuan_prov',  isset($jarak)?$jarak:null,$desawisata->Akses['satuan_prov'], array('class'=>'form-control select2')) }}

                        </div>
                        <div class="category-field">
                            <label class="control-label">Waktu<em class="asterix">*</em></label>
                            <input type="text" name="waktu_dari_ibukota" class="form-control" placeholder="...jam" required="required" value="{{ isset($desawisata->Akses->waktu_dari_ibukota)?$desawisata->Akses->waktu_dari_ibukota:'' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Jarak dari Ibukota Kab/Kota<em class="asterix">*</em></label>
                            <input type="text" name="jarak_dari_kab" class="form-control" placeholder="...km" required="required" value="{{ isset($desawisata->Akses->jarak_dari_kab)?$desawisata->Akses->jarak_dari_kab:'' }}">

                        </div>
                        <div class="category-field">
                                <label class="control-label">&nbsp;</label>
                                {{ Form::select('satuan_kab', $jarak, $desawisata->Akses['satuan_kab'], array('class'=>'form-control select2')) }}
                        </div>
                        <div class="category-field">
                            <label class="control-label">Waktu<em class="asterix">*</em></label>
                            <input type="text" name="waktu_dari_kab" class="form-control" placeholder="...jam" required="required" value="{{ isset($desawisata->Akses->waktu_dari_kab)?$desawisata->Akses->waktu_dari_kab:'' }}">
                        </div>

                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Jarak dari
                                    Kecamatan<em class="asterix">*</em></label>
                                    <input type="text" name="jarak_dari_kec" class="form-control" placeholder="...km" required="required"  value="{{ isset($desawisata->Akses->jarak_dari_kec)?$desawisata->Akses->jarak_dari_kec:'' }}" >
                        </div>
                        <div class="category-field">
                                <label class="control-label">&nbsp;</label>
                                {{ Form::select('satuan_kec', $jarak, $desawisata->Akses['satuan_kec'], array('class'=>'form-control select2')) }}
                        </div>
                        <div class="category-field">
                            <label class="control-label">Waktu<em class="asterix">*</em></label>
                            <input type="text" name="waktu_dari_kec" class="form-control" placeholder="...jam" required="required" value="{{ isset($desawisata->Akses->waktu_dari_kec)?$desawisata->Akses->waktu_dari_kec:'' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Kondisi Jalan<em class="asterix">*</em></label>
                            <label class="radio-inline">
                                <input type="radio" name="kondisi_jalan" id="kondisi_jalan1" value="Baik" {{ ($desawisata->Akses['kondisi_jalan']=='Baik')?'checked':'' }}>
                                Baik
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="kondisi_jalan" id="kondisi_jalan2" value="Rusak Ringan" {{ ($desawisata->Akses['kondisi_jalan']=='Rusak Ringan')?'checked':'' }}>
                                Rusak Ringan
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="kondisi_jalan" id="kondisi_jalan3" value="Rusak Berat" {{ ($desawisata->Akses['kondisi_jalan']=='Rusak Berat')?'checked':'' }}>
                                Rusak Berat
                              </label>
                        </div>
                        <div class="category-field">
                            <label class="control-label">Dapat dilalui kendaraan berjenis <em class="asterix">*</em></label>
                            <input type="text" name="jenis_kendaraan" id="jenis_kendaraan" class="form-control" value="{{ isset($desawisata->Akses->jenis_kendaraan)?$desawisata->Akses->jenis_kendaraan:'' }}" placeholder="Contoh: Bis, Motor, Pickup, Sedan">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Kendaraan Umum <em class="asterix">*</em></label>
                            <input type="text" name="kendaraan_umum" id="kendaraan_umum" class="form-control" value="{{ isset($desawisata->Akses->kendaraan_umum)?$desawisata->Akses->kendaraan_umum:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Rambu/Petunjuk Jalan <em class="asterix">*</em></label>
                            <label class="radio-inline">
                                <input type="radio" name="rambu_petunjuk" id="rambu1" value="1" {{ ($desawisata->Akses['rambu_petunjuk']==1)?'checked':'' }} >
                                Ada
                              </label>
                              <label class="radio-inline">
                                <input type="radio" name="rambu_petunjuk" id="rambu2" value="0" {{ ($desawisata->Akses['rambu_petunjuk']==0)?'checked':'' }} >
                                Tidak Ada
                              </label>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <div class="form-category-entry">
                        <div class="category-field">
                                <label class="control-label">Jalur Transportasi yang dapat dilalui <em class="asterix">*</em></label>
                                <textarea type="text" name="jalur_transport" id="jalur_transport" class="form-control editor">{{ isset($desawisata->Akses->jalur_transport)?$desawisata->Akses->jalur_transport:'' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end form style ---->
            @endif
        </div>
    </div>
