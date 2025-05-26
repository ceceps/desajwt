<div class="form-title">
    <h4 class="form-title">Data Penduduk</h4>

</div>
<form action="" method="POST" id="formpenduduk" class="form-horizontal">
    <label class="control-label">Data Tahun</label>
    <div class="form-group">
        <div class="category-item">
            {!! Form::select('data_tahun',$tahun,[],['class'=>'form-control
            select2','data-placeholder'=>'Tahun Pendirian']) !!}
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <label class="control-label">Mata Pencaharian</label>
            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control">
        </div>
        <div class="col-4">
            <label class="control-label">Jumlah</label>
            <div class="form-group ">
                <input type="number" name="jumlah" id="pria" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="simpan_pekerjaan" class="btn btn-success" value="Tambah Data">
    </div>
</form>
<table class="table dtable" id="penduduk">
    <thead>
        <tr>
            <th>Tahun</th>
            <th>Pekerjaan</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="9">Data Penduduk Masih Kosong</td>
        </tr>
    </tbody>
</table>

