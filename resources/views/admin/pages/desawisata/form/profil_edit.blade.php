@php
    $foto = 'images/profil_desawisata.png';
    $tgl_terdata = \Carbon\Carbon::parse($desawisata->tgl_terdata)->format('d-m-Y');
@endphp
<div class="setup-content"  id="form-step-0" role="form">
    {{-- <form class="form-custom has-category"  method="post" id="formprofil" enctype="multipart/form-data"> --}}
            <!-- begin form style ---->
            <div class="form-based" id="formprofil">
                <div class="top-form with-option">
                    <div class="form-title">
                        <h4 class="form-title">Profil Desa Wisata</h4>
                        <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                    </div>
                </div>
                <div class="media-placeholder">
                    @if(count($desawisata->Media)>0)
                        @foreach($desawisata->Media as $mda)
                            @php
                                $file = Storage::url('data-desawisata/'.$mda['filename']);
                                $foto = (@getimagesize($file)!=false)?$file:'images/noimage.jpg';
                                $judul = $mda->title;
                            @endphp
                            <img src="{{ asset($foto) }}" class="img-fluid" alt="Upload File" id="imgpreview">
                        @endforeach
                    @else
                      <img src="{{ asset('images/profil_desawisata.png') }}" class="img-fluid" alt="Upload File" id="imgpreview">
                    @endif
                </div>
                <br>
                <br>
                <div class="form-group has-two-fields ">
                    <div class="category-field">
                        <label class="control-label">Foto Desa Wisata<em class="asterix">*</em></label>
                        <input name="fotodesawisata" class="form-control" id="fotodesawisata" type="file">
                    </div>
                    <div class="category-field">
                        <label class="control-label">Info Foto</label>
                        <input type="hidden" name="id" value="{{ $desawisata->id }}">
                        <input type="text" id="alt_foto" name="alt_foto" class="form-control" placeholder="Info gambar" value="{{ isset($judul)?$judul:'' }}">
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Nama Desa Wisata<em class="asterix">*</em></label>
                            <input type="text" name="nama_desawisata" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->nama_desawisata }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Kategori<em class="asterix">*</em></label>
                            {!! Form::select('idcat',$kategori,$desawisata->idcat,['class'=>'form-control select2']) !!}
                        </div>
                        <div class="category-field">
                            <label class="control-label">Pendirian Desa Wisata<em class="asterix">*</em></label>
                            {{-- <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun" value="{{  $desawisata->tahun_berdiri }}"> --}}
                            {!! Form::select('tahun_berdiri',$opsiTahun,$desawisata->tahun_berdiri,['class'=>'form-control pilihTahun']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="category-field" style="width:98%">
                        <label class="control-label">Deskripsi<em class="asterix">*</em></label>
                        <textarea name="deskripsi" class="form-control" id="editor" placeholder="contoh: Deskripsi">{{ nl2br($desawisata->deskripsi) }}</textarea>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Kelurahan/Desa <em class="asterix">*</em></label>
                            <input type="text" name="kelurahan" id="kelurahan_nama" class="form-control col-md-7" value="{{ $desawisata->kelurahan['nama'] }}">
                            <input type="hidden" name="kel_id" id="kelurahan_id" value="{{ $desawisata->kel_id }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Kecamatan</label>
                            <input type="text" id="kecamatan_nama" class="form-control col-md-7"  value="{{ $desawisata->kelurahan->kecamatan['nama'] }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Kabupaten</label>
                            <input type="text" id="kabupaten_nama" class="form-control col-md-7" value="{{ $desawisata->kelurahan->kecamatan->kabupaten['nama'] }}">
                        </div>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">SK Desa<em class="asterix">*</em></label>
                            <input type="text" name="sk_desa" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->sk_desa }}">
                            <input type="text" name="tgl_sk_desa" class="form-control tgl"  placeholder="01-01-2000" value="{{ $desawisata->tgl_sk_desa }}">
                            <span class="add-on"><i class="fa fa-calendar"></i></span>
                            {{-- <div class="input-append date" id="tgl_desa" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                <input class="span2" size="16"  name="tgl_sk_desa" type="text" value="12-02-2012">
                                <span class="add-on"><i class="icon-th"></i></span>
                              </div> --}}
                        </div>
                        <div class="category-field">
                            <label class="control-label">SK Dinas Kota/Kabupaten</label>
                            <input type="text" name="sk_dinas_kab" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->sk_dinas_kab }}">
                            <input type="text" name="tgl_sk_kab" class="form-control tgl" id="tgl_kab" placeholder="01-01-2011" value="{{ $desawisata->tgl_sk_kab }}">
                            <span><i class="fa fa-calendar"></i></span>
                        </div>
                        <div class="category-field">
                            <label class="control-label">SK Dinas Provinsi</label>
                            <input type="text" name="sk_provinsi" class="form-control" placeholder="contoh: batununggal" value="{{ $desawisata->sk_provinsi }}">
                            <input type="text" name="tgl_sk_prov" class="form-control tgl" id="tgl_prov" placeholder="01-01-2000" value="{{ $desawisata->tgl_sk_prov }}">
                            <span><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="form-group has-four-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Latitude<em class="asterix">*</em></label>
                        <input type="text" name="lat" class="form-control" placeholder="contoh: 16.000" value="{{ $desawisata->lat }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Longitude<em class="asterix">*</em></label>
                            <input type="text" name="longi" class="form-control" placeholder="contoh: 107.000" value="{{ $desawisata->longi }}">
                        </div>
                        <div class="category-field">
                                <label class="control-label">Status<em class="asterix">*</em></label>
                                {!! Form::select('status',[0=>'Draft',1=>'Tampil',2=>'Non Aktif'],$desawisata->status,['class'=>'form-control','id'=>'status']) !!}
                        </div>
                        <div class="category-field">
                                <label class="control-label">Tgl Data<em class="asterix">*</em></label>
                                <input type="text" name="tgl_data" id="tgl_data" class="form-control tgl"value="{{ $tgl_terdata }}">
                        </div>
                   </div>
               </div>
                <div class="form-group has-two-fields">
                        <div class="form-category-entry">
                            <div class="category-field">
                                    <label class="control-label">Video Profil<em class="asterix">*</em></label>
                                    <input type="text" id="video_desawisata" name="video_desawisata" value="{!! isset($titleVideo)?$titleVideo:'' !!}" class="form-control" placeholder="Judul Video" >
                            </div>
                            <div class="category-field">
                                <label class="control-label">&nbsp;</label>
                                <input type="hidden" name="video_profil" id="video-desawisata" class="form-control" name="filename" placeholder="Nama File" value="{!! isset($filenameVideo)?$filenameVideo:''; !!}">
                                <a href="" class="popup_selector btn btn-success" data-inputid="video-desawisata">Unggah Video</a>
                                @if(!empty($filenameVideo))
                                <button type="button" class="btn btn-warning"  id="modal-trigger" >View</button>
                                <div id="fp-modal"></div>
                                @php
                                    $folder='/storage/data-video/';
                                    $url= $folder.$filenameVideo;
                                    $title = isset($titleVideo)?$titleVideo:'Detil Video';
                                @endphp
                                @else
                                    $title ='';
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label"><a href="#"  id="video_file">{!! isset($filenameVideo)?$filenameVideo:''; !!}</a></label>
                    </div>
                {{-- </div> --}}
            </div>
    {{-- </form> --}}
</div>
