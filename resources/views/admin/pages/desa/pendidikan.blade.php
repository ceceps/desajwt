<div class="form-based">
    <div class="form-title">
        <h4 class="form-title">Data Pendidikan</h4>

    </div>
    <div class="form-group">
        <a href="#" class="btn btn-success" id="add_pendidikan" data-toggle="modal"
            data-target="#modalPendidikan">Tambah Data</a>
    </div>
    <table class="table dtable" id="pendidikan">
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Jum Penduduk</th>
                <th>Pria</th>
                <th>Wanita</th>
                <th>KK</th>
                <th>SD</th>
                <th>SMP</th>
                <th>SMU</th>
                <th>S1</th>
                <th>Tak Sekolah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="10">Data Pendidikan Masih Kosong</td>
            </tr>
        </tbody>
    </table>
    <div class="modal fade" id="modalPendidikan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Pendidikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formpendidikan" class="form-horizontal">
                <div class="modal-body">
                    <div class="container-fluid">
                            <label class="control-label">Data Tahun</label>
                            <div class="form-group">
                                <div class="category-item">
                                    {!! Form::select('data_tahun',$tahun,[],['class'=>'form-control select2','data-placeholder'=>'Tahun Pendirian']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label class="control-label">Jumlah Penduduk</label>
                                    <div class="form-group ">
                                        <input type="number" name="jum_penduduk" id="jum_penduduk" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Jumlah Pria</label>
                                    <div class="form-group ">
                                        <input type="number" name="pria" id="pria" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Jumlah Wanita</label>
                                    <div class="form-group ">
                                        <input type="number" name="wanita" id="wanita" class="form-control">
                                    </div>
                                </div>
                            </div>

                           <div class="row">
                                <div class="col-4">
                                    <label class="control-label">Jumlah KK</label>
                                    <div class="form-group ">
                                        <input type="number" name="jum_kk" id="jum_kk" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Lulusan SD</label>
                                    <div class="form-group ">
                                        <input type="number" name="sd" id="sd" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Lulusan SMP</label>
                                    <div class="form-group ">
                                        <input type="number" name="smp" id="smp" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <label class="control-label">Lulusan SMU</label>
                                    <div class="form-group ">
                                        <input type="number" name="smu" id="smu" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Lulusan S1</label>
                                    <div class="form-group ">
                                        <input type="number" name="s1" id="s1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Tidak Sekolah</label>
                                    <div class="form-group ">
                                        <input type="number" name="tak_sekolah" id="s1" class="form-control">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-info">Simpan</button>
                </div>
             </form>
            </div>
        </div>
    </div>
</div>
