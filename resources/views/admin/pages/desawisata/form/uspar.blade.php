    <div class="setup-content">
        <div id="usaha" aria-labelledby="usaha-tab">
            <!-- begin form style ---->
            <div class="form-based tab-pane">
                    <div class="top-form with-option">
                            <div class="form-title">
                            <h4 class="form-title">Usaha Pariwisata {{ isset($nama_desawisata)?$nama_desawisata:'' }}</h4>
                                <p class="title-helper ">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                            </div>
                    </div>
                   <div class="form-group has-three-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                <label class="control-label">Jenis Jenis Usaha<em class="asterix">*</em></label>
                                {!! Form::select('jenis_usaha_id',[],[],['class'=>'form-control select-jenis_usaha']) !!}
                            </div>
                            <div class="category-field">
                                <label class="control-label">Item<em class="asterix">*</em></label>
                                <input type="text" id="title-jenis_usaha" name="title_jenis_usaha" value="" class="form-control" placeholder="Judul Item">
                            </div>
                            <div class="category-field">
                            </div>
                        </div>
                    </div>
                   <div class="form-group">
                        <textarea name="keterangan" id="" cols="20" rows="10" class="form-control" placeholder="keterangan usaha pariwisata"></textarea>
                   </div>
                    <div class="form-group has-two-fields">
                        <div class="form-category-entry">
                                    <div class="category-field">
                                        <label class="control-label col-large">Foto<em class="asterix">*</em></label>
                                        <input type="text" id="foto-jenis_usaha" name="foto-jenis_usaha[]" value="" class="form-control" readonly>
                                        <a href="" class="popup_selector" data-inputid="foto-jenis_usaha">Browse Foto</a>
                                        <input type="text" id="title-jenis_usaha" name="title-foto-jenis_usaha[]" value="" class="form-control" placeholder="Judul Foto">
                                    </div>
                                    <div class="category-field">
                                        <label class="control-label">Video</label>
                                        <input type="text" id="video-jenis_usaha" name="video-jenis_usaha[]" value="" class="form-control" readonly>
                                        <a href="" class="popup_selector" data-inputid="video-jenis_usaha">Browse Video</a>
                                        <input type="text" id="title-jenis_usaha" name="title-video-jenis_usaha[]" value="" class="form-control" placeholder="Judul Video">
                                    </div>
                        </div>
                    </div>
                            <div class="form-group">
                                    <button type="button" class="btn btn-default" id="btnadd_jenis_usaha">
                                            <span class="icon-circle">
                                                <i class="mdi mdi-plus-circle"></i>
                                            </span>
                                            Tambah Baru
                                        </button>
                            </div>
            </div>
            <!-- end form style ---->
            <table id="table_usaha" class="table table-responsive table-bordered">
                    <thead>
                        <th>No</th>
                        <th width="20%">Jenis Usaha Pariwisata</th>
                        <th width="20%">Nama Usaha</th>
                        <th width="20%">Jumlah Tenaga Kerja</th>
                        <th width="15%">Foto</th>
                        <th width="15%">Video</th>
                        <th width="10%">Aksi</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="text-center">Data Usaha belum diinput</td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>

