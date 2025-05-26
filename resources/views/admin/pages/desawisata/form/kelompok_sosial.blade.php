<div class="setup-content">
    <!-- begin form style ---->
    <div id="kelompok-sosial" aria-labelledby="kelsos-tab">
    <div class="form-based">
        <div class="top-form with-option">
            <div class="form-title">
                <h4 class="form-title">Kelompok Sosial {{ isset($nama_desawisata)?$nama_desawisata:'' }}</h4>
                <p class="title-helper ">Input bertanda <em class="asterix">*</em> wajib diisi</p>
            </div>
        </div>
        <div class="form-group has-three-fields" id="data-kelsos">
            <div class="form-category-entry item-kelsos">
                <div class="category-field">
                    <label class="control-label">Jenis Kelompok Sosial<em class="asterix">*</em></label> {!! Form::select('jenis_kelsos_id[]',[],[],['class'=>'form-control
                    select-jenis-kelsos']) !!}
                </div>
                <div class="category-field">
                    <label class="control-label">Nama Kelompok Sosial<em class="asterix">*</em></label>
                    <input type="text" id="title-kelsos" name="title_kelsos[]" value="" class="form-control col-large" placeholder="Nama Kelompok Sosial">
                </div>
                <div class="category-field">
                    &nbsp;
                </div>
            </div>
        </div>
        <div class="form-group has-two-fields">
            <div class="form-category-entry">
                <div class="category-field">
                    <label class="control-label">Foto<em class="asterix">*</em></label>
                    <input type="text" id="title-kelsos" name="title_foto_kelsos[]" value="" class="form-control" placeholder="Judul Foto">
                    <input type="text" id="foto-kelsos" name="foto-kelsos[]" value="" class="form-control" readonly>
                    <a href="" class="popup_selector btn btn-success" data-inputid="foto-kelsos">Browse Foto</a>
                </div>
                <div class="category-field">
                    <label class="control-label">Video</label>
                    <input type="text" id="title-kelsos" name="title_video_kelsos[]" value="" class="form-control" placeholder="Judul Video">
                    <input type="text" id="video-kelsos" name="video-kelsos[]" value="" class="form-control" readonly>
                    <a href="" class="popup_selector btn btn-success" data-inputid="video-kelsos">Browse Video</a>
                </div>
            </div>
        </div>
        <div class="form-group">
                <textarea name="ket-kelsos[]" class="form-control" placeholder="keterangan item"></textarea>

        </div>
            <div class="form-group">
                    <button type="button" class="btn btn-default" id="btnadd_kelsos">
                            <span class="icon-circle">
                                <i class="mdi mdi-plus-circle"></i>
                            </span>
                            Tambah Baru
                        </button>
            </div>

        </div>
        <!-- end form style ---->
        <table class="table table-striped table-bordered table-responsive" id="kelsos">
            <thead>
                    <th width="25%">Jenis Kelompok Sosial</th>
                    <th width="25%">Nama Kelompok Sosial</th>
                    <th width="10%">Foto</th>
                    <th width="10%">Video</th>
             </thead>
            <tbody>
                    <tr>
                        <td colspan="4"><div class="text-center">Data Kelompok Sosial Belum Tersedia</div></td>
                    </tr>
            </tbody>
        </table>
</div>
</div>
