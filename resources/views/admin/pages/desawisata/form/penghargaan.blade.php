<div class="setup-content">
    <div id="penghargaan" aria-labelledby="penghargaan-tab">
        <!-- begin form style ---->
        <div class="form-based">
            <div class="top-form with-option" id="data-penghargaan">
                <div class="form-title">
                    <h4 class="form-title">Penghargaan {{ isset($nama_desawisata)?$nama_desawisata:'' }}</h4>
                    <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi
                    </p>
                </div>

            </div>
            <div class="panel panel-default item-penghargaan">
                <div class="panel-body">
                   <div class="fieldset has-four">
                        <div class="field-item">
                            <label class="control-label">Nama Penghargaan <em class="asterix">*</em></label>
                            <input type="text" name="nama_penghargaan" class="form-control nama_penghargaan"
                                placeholder="Nama Penghargaan" aria-describedby="helpId">
                        </div>
                        <div class="field-item">
                            <label class="control-label">Tahun <em class="asterix">*</em></label>
                            {!! Form::select('tahun_penghargaan',$tahun,[Input::old('tahun_berdiri')],['class'=>'form-control
                            select2','data-placeholder'=>'Tahun Pendirian']) !!}

                        </div>
                        <div class="field-item">
                            <label class="control-label">Peringkat <em class="asterix">*</em></label>
                            <input type="text" name="peringkat" class="form-control" placeholder="Peringkat">
                        </div>
                    </div>
                    <div class="fieldset">
                        <label class="control-label">Keterangan Penghargaan <em class="asterix">*</em></label>
                    </div>
                    <div class="fieldset">
                        <textarea name="nota_penghargaan" id="" cols="30" rows="3" placeholder="Keterangan" class="form-control"></textarea>
                    </div>
                    <div class="field-item hidden-large">
                        <label class="control-label">Hapus ?</label>
                        <a href="#" class="btn btn-danger penghargaan-delete btn-sm "><i class="mdi mdi-trash-can-outline"></i></a>
                    </div>
                    <div class="form-group">
                            <button type="button" class="btn btn-default" id="btnadd_penghargaan">
                                    <span class="icon-circle">
                                        <i class="mdi mdi-plus-circle"></i>
                                    </span>
                                    Tambah Baru
                                </button>
                    </div>
                <div class="form-group">
                    <br><br>
                    <table class="table table-bordered table-resposive">
                        <thead>
                            <tr>
                                <th>Nama Penghargaan</th>
                                <th>Tahun</th>
                                <th>Peringkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4"><div class="text-center">Data Penghargaan Masih Kosong</div></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            </div>

            </div>
            <!-- end form style ---->
        </div>
</div>
