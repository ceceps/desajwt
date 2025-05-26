    <div class="setup-content">
        <div id="fasilitas" aria-labelledby="fasilitas-tab">
            <!-- begin form style ---->
            <div class="form-based">
                <div class="top-form with-option" id="data-fasilitas">
                    <div class="form-title">
                    <h4 class="form-title">Fasilitas {{ isset($nama_desawisata)?$nama_desawisata:'' }}</h4>
                        <p class="title-helper ">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                    </div>

                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Jenis Fasilitas<em class="asterix">*</em></label>
                            {!! Form::select('jenis_fasilitas_id[]',[],[],['class'=>'form-control select-jenis-fasilitas']) !!}
                        </div>
                        <div class="category-field">
                            <label class="control-label">Nama Fasilitas<em class="asterix">*</em></label>
                            <input type="text" id="title-fasilitas" name="title-fasilitas[]" value="" class="form-control" placeholder="nama fasilitas">

                        </div>
                        <div class="category-field">
                            &nbsp;
                        </div>

                    </div>
                </div>
                <div class="form-group">
                        <textarea name="ket-fasilitas[]" class="form-control" placeholder="keterangan item"></textarea>
                </div>
                <div class="form-group has-two-fields">
                    <div class="form-category-entry">
                      <div class="category-field">
                            <label class="control-label col-large">Foto<em class="asterix">*</em></label>
                            <input type="text" id="title-fasilitas" name="title-foto-fasilitas[]" value="" class="form-control" placeholder="Judul Foto">
                            <input type="text" id="foto-fasilitas" name="foto-fasilitas[]" value="" class="form-control" readonly>
                            <a href="" class="popup_selector btn btn-success" data-inputid="foto-fasilitas">Browse Foto</a>
                      </div>
                      <div class="category-field">
                            <label class="control-label">Video</label>
                            <input type="text" id="title-fasilitas" name="title-video-fasilitas[]" value="" class="form-control" placeholder="Judul Video">
                            <input type="text" id="video-fasilitas" name="video-fasilitas[]" value=""  class="form-control" readonly>
                            <a href="" class="popup_selector btn btn-success" data-inputid="video-fasilitas">Browse Video</a>
                      </div>
                    </div>
                </div>

                <div class="form-group">
                        <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                            <span class="icon-circle">
                                <i class="mdi mdi-plus-circle"></i>
                            </span>
                            Tambah Baru
                    </button>
                    </div>
                <table id="tblfasilitas" class="table table-responsive table-bordered">
                    <thead>
                            <th width="25%">Jenis Fasilitas</th>
                            <th width="25%">Detil</th>
                            <th width="20%">Foto</th>
                            <th width="20%">Video</th>
                            <th width="10%">Aksi</th>
                     </thead>
                     <tbody>
                            <tr>
                                <td  colspan="5" class="text-center">Data Fasilitas belum Tersedia</td>
                            </tr>
                      </tbody>
                </table>
            </div>
            <!-- end form style ---->
        </div>
    </div>
