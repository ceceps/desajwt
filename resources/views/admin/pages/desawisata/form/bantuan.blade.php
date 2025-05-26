<div class="setup-content">
    <div id="bantuan" aria-labelledby="bantuan-tab">
        <!-- begin form style ---->
        <div class="form-based">
            <div class="top-form with-option">
                <div class="form-title">
                    <h4 class="form-title">Bantuan Dana Pariwisata</h4>
                </div>
                <a href="#jenis_bantuan">Jenis Bantuan</a> | <a href="#dampak_bantuan"> Dampak Bantuan </a> | <a href="#manfaat_bantuan"> Pemanfaatan Bantuan</a>
            </div>
            <div class="form-group" id="jenis_bantuan">
                {{-- <span class="label">Mendapatkan Bantuan ?</span> --}}
                <div class="radio-group">
                    <div class="ted-radio">
                        <input id="pb1" type="radio" name="pernahbantuan" value="1">
                        <label for="pb1"><em>Pernah</em></label>
                    </div>
                    <div class="ted-radio">
                        <input id="pb2" type="radio" name="pernahbantuan" value="0">
                        <label for="pb2"><em>Tidak Pernah</em></label>
                    </div>
                </div>
            </div>
            <div class="form-custom" id="datajenis_bantuan">
                <div class="fieldset has-four">
                    <div class="field-item">
                        <label class="control-label">Nama Proram Bantuan <em class="asterix">*</em></label>
                        <input type="text" name="nama_program_bantuan" class="form-control col-8 nama_program" placeholder="nama program" aria-describedby="helpId">
                    </div>
                    <div class="field-item">
                        <label class="control-label">Tahun <em class="asterix">*</em></label>
                         {!! Form::select('tahun',$tahun,[],['class'=>'form-control select-tahun select2']) !!}
                    </div>
                    <div class="field-item">
                        <label class="control-label">Besar Dana <em class="asterix">*</em></label>
                        <input type="text" name="jum_dana" class="form-control" placeholder="Rp....">
                    </div>
                </div>
                <div class="fieldset has-one">
                    <label class="control-label">Penggunaan Anggaran <em class="asterix">*</em></label>
                </div>
                <div class="fieldset has-one">
                    <textarea name="ket_dana" id="" cols="30" rows="3" placeholder="Digunakan Unjuk" class="form-control"></textarea>
                </div>
                <br>
                <br>
                <div class="fieldset has-one">
                   <button class="btn btn-info" id="btnadd_bantuan">
                        <span class="icon-circle">
                           <i class="mdi mdi-plus-circle"></i>
                        </span>
                        Tambah Jenis Bantuan
                    </button>
                </div>
            </div>

            <br>
            <br>
            <table class="table" id="table-dampak">
                <thead>
                    <tr>
                        <th>Uraian</th>
                        <th>Tahun </th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Data Jenis Bantuan Belum tersedia</td>
                    </tr>
                </tbody>
            </table>
            <!-- end form style ---->

        </div>

        <div id="dampak_bantuan" aria-labelledby="dampak-tab" style="padding-top:20px">
            <!-- begin form style ---->
            <div class="form-custom">
                <div class="top-form with-option">
                    <div class="form-title">
                        <h4 class="form-title">Dampak Bantuan Wisata</h4>
                        <p class="title-helper">Harap masukan semua input</p>
                    </div>
                </div>
                <div class="form-inline">
                               {!! Form::select('tahun_dampak',$tahun,[],['class'=>'form-control select-tahun col-1']) !!}
                               &nbsp;
                               {!! Form::select('jenis_bantuan',[],[],['class'=>'form-control select-jenis_dampak col-4']) !!}
                               &nbsp;
                                      <a href="" class="btn btn-success" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modalAddJenisUraian">
                                                <span class="icon-circle">
                                                    <i class="mdi mdi-plus-circle"></i>
                                                </span>
                                    </a>
                                    &nbsp;
                               <input type="text" class="form-control col-1" name="jumdata" placeholder="Jum Data">
                               &nbsp;
                              <a href="" class="btn btn-info">
                                    <span class="icon-circle">
                                        <i class="mdi mdi-plus-circle"></i>
                                    </span>
                                    Tambah
                                </a>

                    </div>
                </div>

                <table class="table" id="table-dampak">
                    <thead>
                        <tr>
                            <th>Uraian</th>
                            <th>Tahun </th>
                            <th>Total</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Data Dampak Bantuan Belum tersedia</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end form style ---->
        </div>

        <div id="manfaat_bantuan" aria-labelledby="jenmanfaat-tab">
            <!-- begin form style ---->
            <div class="form-custom">
                <div class="top-form with-option">
                    <div class="form-title">
                        <h4 class="form-title">Pemanfaatan Dana Bantuan</h4>
                        <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                    </div>

                </div>
               <div class="form-inline">
                    {!! Form::select('tahun_manfaat',$tahun,[],['class'=>'form-control select-tahun col-1']) !!}
                    &nbsp;
                    {!! Form::select('jenis_bantuan_dana',[],[],['class'=>'form-control select_jenis_bantuan_dana col-4']) !!}
                    <a href="" class="btn btn-success" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modalAddJenisUraian">
                       <span class="icon-circle">
                          <i class="mdi mdi-plus-circle"></i>
                        </span>
                    </a>
                    <input type="text" class="form-control col-1" name="2016" placeholder="Jum Data">
                    <a href="" class="btn btn-info">
                        <span class="icon-circle">
                           <i class="mdi mdi-plus-circle"></i>
                        </span>
                        Tambah
                    </a>
                </div>
              </div>
              <table class="table" id="table-pemanfaatan">
                    <thead>
                        <tr>
                            <th>Uraian</th>
                            <th>Tahun </th>
                            <th>Total</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Data Pemanfaatan Bantuan Belum tersedia</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- end form style ---->
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalAddJenisUraian" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Jenis Uraian Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="text/plain">
                        <div class="form-group">
                            <div class="fieldset has-two">
                                <div class="field-item">
                                    <input type="text" name="nama_uraian" id="nama_uraian" class="form-control">
                                </div>
                                <div class="field-item">
                                    <input type="submit" class="btn btn-success" value="Tambah">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
