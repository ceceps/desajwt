<div class="panel clean">
    <!-- begin form style ---->
    <div class="form-based" >
        <div class="top-form with-option" id="data-penghargaan">
            <div class="form-title">
                <h4 class="form-title">Penghargaan</h4>
                <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi
                    </p>
            </div>
        </div>

                   <div class="form-group has-three-fields">
                            <div class="form-category-entry">
                                <div class="category-field">
                                    <label class="control-label">Nama Penghargaan <em class="asterix">*</em></label>
                                    <input type="text" name="nama_penghargaan[]" class="form-control col-8 nama_peghargaan" placeholder="Nama Penghargaan" aria-describedby="helpId">
                                </div>
                                <div class="category-field">
                                    <label class="control-label">Tahun <em class="asterix">*</em></label>
                                    {!! Form::select('tahun_penghargaan',$tahun,[],['class'=>'form-control select2','data-placeholder'=>'Tahun Penghargaan']) !!}
                                                </div>
                                                <div class="category-field">
                                                            <label class="control-label">Peringkat <em class="asterix">*</em></label>
                                                            <input type="text" name="peringkat[]" class="form-control" placeholder="Peringkat">
                                                </div>

                                            </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label">Keterangan Penghargaan <em class="asterix">*</em></label>
                            <textarea name="ket_penghargaan[]"   rows="3" placeholder="Keterangan" class="form-control deskripsi"></textarea>

                    </div>
                    <div class="form-group">
                            <button type="button" class="btn btn-default" id="btnadd_penghargaan">
                                    <span class="icon-circle">
                                        <i class="mdi mdi-plus-circle"></i>
                                    </span>
                                    Tambah Baru
                                </button>
                    </div>
                    <table class="table table-bordered table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th width="25%">Nama Penghargaan</th>
                                <th width="10%">Tahun</th>
                                <th width="20%">Peringkat</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4"><div class="text-center">Data Penghargaan belum tersedia</div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

    <!-- end form style ---->
</div>
