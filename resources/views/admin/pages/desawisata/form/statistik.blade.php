   <div class="setup-content">
        <div id="statistik" aria-labelledby="statistik-tab">
            <!-- begin form style ---->
            <div class="form-based">
                <div class="top-form with-option">
                    <div class="form-title">
                        <h4 class="form-title">Statistik Pariwisata</h4>
                        <p class="title-helper">Kunjungan Wisatawan per Bulan
                        </p>
                    </div>
                    <div class="form-option">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modelId">
                                Tambah Data
                        </button>
                    </div>
                </div>
               <div class="form-group">
                    {{-- <label class="control-label">Tahun <em class="asterix">*</em></label> --}}
                    <div class="col-md-2 col-lg-2">
                            {!! Form::select('stat-tahun',$tahun,[],['class'=>'form-control select-tahun']) !!}
                    </div>
                </div>
                <table class="table table-bordered" id="table-statistik">
                    <thead>
                        <tr>
                            <th class="text-center">Data</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Apr</th>
                            <th>Mei</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ags</th>
                            <th>Sep</th>
                            <th>Okt</th>
                            <th>Nov</th>
                            <th>Des</th>
                            <th class="kolom-kecil">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="14" class="text-center"> Data Masih Kosong</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!-- end form style ---->
        </div>
    </div>

    <!-- Modal -->
   <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Statistik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                </div>
                <form action="" id="add-statistik" method="post">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                            <label for="">Jenis Data</label>
                                            {!! Form::select('jenis-data',[],[],['class'=>'form-control select-jenis-data']) !!}
                                        </div>
                                        </div>
                                <div class="col-6">
                                        <div class="form-group">
                                                <label for="">Tahun</label>
                                                {!! Form::select('tahun-data',$tahun,[],['class'=>'form-control select-tahun']) !!}
                                            </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Jan</label>
                                            <input type="text" name="jan" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Feb</label>
                                            <input type="text" name="feb" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mar</label>
                                            <input type="text" name="mar" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">April</label>
                                            <input type="text" name="april" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Mei</label>
                                            <input type="text" name="april" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Juni</label>
                                            <input type="text" name="juni" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6"">
                                        <div class="form-group">
                                            <label for="">Juli</label>
                                            <input type="text" name="jul" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Agustus</label>
                                            <input type="text" name="ags" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">September</label>
                                            <input type="text" name="sep" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Oktober</label>
                                            <input type="text" name="okt" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">November</label>
                                            <input type="text" name="nov" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Desember</label>
                                            <input type="text" name="des" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Total Data</label>
                                            <input type="text" name="total" class="form-control input-sm" readonly>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-info">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

