{{-- <form class="form-custom has-category" method="post" id="formatraksi" enctype="multipart/form-data"> --}}
    <div class="setup-content">
        <div id="formatraksi" aria-labelledby="atraksi-tab" style="padding:10px">
            {{-- <form class="form-custom has-category" action="/" method="post"> --}}
                <!-- begin form style -->
         <div class="form-based">
            <div class="top-form with-option">
                <div class="form-title">
                    <h4 class="form-title">Atraksi  {{ isset($nama_desawisata)?$nama_desawisata:'Desa Wisata' }}</h4>
                    <p class="title-helper">Harap masukan semua input</p>
                </div>
            </div>

            <div class="form-group has-three-fields">
                <div class="form-category-entry">
                    <div class="category-field">
                            <label class="control-label">Daya Tarik<em class="asterix">*</em></label>
                            <input type="hidden" name="desawisata_id">
                        {!! Form::select('daya_tarik',[''=>'','alam'=>'Alam','budaya'=>'Budaya','buatan'=>'Buatan'],[],['class'=>'form-control select-dayatarik']) !!}
                    </div>
                    <div class="category-field">
                            <label class="control-label">Kategori<em class="asterix">*</em></label>
                        {!! Form::select('atraksi_id',[],[],['id'=>'atraksi_id','class'=>'form-control select-atraksi-alam']) !!}
                    </div>
                    <div class="category-field">
                        <label class="control-label">Nama Atraksi<em class="asterix">*</em></label>
                        <input type="text" id="title" name="title" value="" class="form-control" placeholder="Judul Item" >
                    </div>

                </div>
            </div>
            <div class="form-group has-two-fields">
                <div class="form-category-entry">
                    <div class="category-field">
                        <label class="control-label col-large">Foto<em class="asterix">*</em></label>
                        <input type="text" id="title-atraksi-alam" name="title_foto_atraksi" value="" class="form-control" placeholder="Judul Foto">
                        <input type="text" id="foto-atraksi-alam" name="foto_atraksi" value="" class="form-control" readonly>
                        <a href="" class="btn btn-success popup_selector" data-inputid="foto-atraksi-alam">Browse Foto</a>
                    </div>
                    <div class="category-field">
                        <label class="control-label">Video</label>
                        <input type="text" id="title-atraksi-alam" name="title_video_atraksi" value="" class="form-control" placeholder="Judul Video">
                        <input type="text" id="video-atraksi-alam" name="video_atraksi" value="" class="form-control" readonly>
                        <a href="" class="btn btn-success popup_selector" data-inputid="video-atraksi-alam">Browse Video</a>
                    </div>
                </div>
            </div>
           <div class="form-group">
                <div class="form-category-entry">
                    <div class="category-field">
                        <label class="control-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control .editor" placeholder="Keterangan Atraksi" class="col-sm-12"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <button class="btn btn-default" id="btnadd-alam">
                        <i class="mdi mdi-plus-circle"></i>
                    Tambah Baru
                </button>
            </div>

            <table class="table table-responsive table-bordered" id="tableatraksi">
                <thead>
                    <th width="20%">Nama Atraksi</th>
                    <th width="10%">Daya Tarik</th>
                    <th width="10%">Kategori</th>
                    <th width="10%">Foto</th>
                    <th width="10%">Video</th>
                    <th width="10%">Aksi</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Data Belum Tersedia</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- end form style ---->
        {{-- </form> --}}
    </div>
</div>
<span class="badge badge-pill badge-info"></span>
