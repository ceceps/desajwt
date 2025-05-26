
    <div class="setup-content">
        <div id="usaha" aria-labelledby="usaha-tab">
            <!-- begin form style ---->
            <div class="form-based">
                    <div class="top-form with-option">
                            <div class="form-title">
                                <h4 class="form-title">Usaha Pariwisata {{ isset($nama_desawisata)?$nama_desawisata:'' }}</h4>
                                <p class="title-helper ">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                            </div>
                        </div>
                        <div class="form-group has-three-fields">
                            <div class="form-category-entry">
                                  <div class="category-field">
                                        <button type="button" class="btn btn-danger btn-sm item-jenis-usaha-delete hidden-large"><i class="mdi mdi-trash-can-outline"></i></button>
                                            <label class="control-label">Jenis Usaha<em class="asterix">*</em></label>
                                        {!! Form::select('jenis_usaha_id',[],[],['class'=>'form-control select-jenis_usaha']) !!}
                                    </div>
                                    <div class="category-field">
                                        <label class="control-label">Nama Usaha Pariwisata<em class="asterix">*</em></label>
                                        <input type="text" id="title-jenis_usaha" name="title-jenis_usaha" value="" class="form-control" placeholder="Judul Item">
                                    </div>
                                    <div class="category-field"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                    <textarea name="ket-jenis_usaha" class="form-control" placeholder="keterangan usaha pariwisata"></textarea>
                            </div>
                            <div class="form-group has-two-fields">
                                <div class="form-category-entry">
                                      <div class="category-field">
                                            <label class="control-label col-large">Foto<em class="asterix">*</em></label>
                                            <input type="text" id="title-uspar" name="title-foto-uspar" value="" class="form-control" placeholder="Judul Foto">
                                            <input type="text" id="foto-uspar" name="foto-uspar" value="" class="form-control" readonly>
                                            <a href="" class="popup_selector btn btn-success" data-inputid="foto-uspar">Browse Foto</a>
                                      </div>
                                      <div class="category-field">
                                            <label class="control-label">Video</label>
                                            <input type="text" id="title-uspar" name="title-video-uspar" value="" class="form-control" placeholder="Judul Video">
                                            <input type="text" id="video-uspar" name="video-uspar" value=""  class="form-control" readonly>
                                            <a href="" class="popup_selector btn btn-success" data-inputid="video-uspar">Browse Video</a>
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
            <table class="table table-bordered table-responsive">
                <thead>
                        <th width="15%">Jenis Usaha</th>
                        <th width="15%">Nama Usaha Pariwisata</th>
                        <th width="15%">Foto</th>
                        <th width="10%">Video</th>
                        <th width="10%">Aksi</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Data Usaha Parisata Belum Tersedia</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
