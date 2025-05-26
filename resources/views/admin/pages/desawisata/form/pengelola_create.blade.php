{{-- <form class="form-custom has-category" method="post" id="formpengelola"> --}}
    <div class="setup-content">
        <!-- begin form style ---->
        <div class="form-based">
                <div class="top-form with-option">
                    <div class="form-title">
                    <h4 class="form-title">Pengelola {{ isset($nama_desawisata)?$nama_desawisata:'Desa Wisata' }} </h4>
                        <p class="title-helper">Input bertanda <em class="asterix">*</em> wajib diisi</p>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                @endif

                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                        <input type="hidden" name="desa_wisata_id" value="{{ isset($idprofil) ?$idprofil:'' }}">
                        <input type="hidden" name="pengelola_id" value="{{ isset($desawisata->pengelola->id)?$desawisata->pengelola->id:'' }}">
                            <label class="control-label">Nama Unit Pengelola<em class="asterix">*</em></label>
                        <input type="text" name="nama_pengelola" class="form-control" placeholder="contoh: Kelompok Pengelola"  value="{{ isset($desawisata->pengelola->nama_pengelola)?$desawisata->pengelola->nama_pengelola:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Nama Pimpinan<em class="asterix">*</em></label>
                            <input type="text" name="pimpinan" class="form-control" placeholder="Bpk/Ibu"  value="{{ isset($desawisata->pengelola->pimpinan)?$desawisata->pengelola->pimpinan:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">No. HP<em class="asterix">*</em></label>
                            <input type="text" name="no_hp" class="form-control" placeholder="081xxx"  value="{{ isset($desawisata->pengelola->no_hp)?$desawisata->pengelola->no_hp:'' }}">
                        </div>

                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Kontak Person<em class="asterix">*</em></label>
                            <input type="text" name="kontak_person" class="form-control" placeholder="contoh: nama kontak person" value="{{ isset($desawisata->pengelola->kontak_person)?$desawisata->pengelola->kontak_person:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Jabatan<em class="asterix">*</em></label>
                            <input type="text" name="jabatan" class="form-control" placeholder="contoh: humas" value="{{ isset($desawisata->pengelola->jabatan)?$desawisata->pengelola->jabatan:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">No. HP<em class="asterix">*</em></label>
                            <input type="text" name="nohp_cp" class="form-control" placeholder="081xxx" value="{{ isset($desawisata->pengelola->nohp_cp)?$desawisata->pengelola->nohp_cp:'' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group has-three-fields">
                    <div class="form-category-entry">
                        <div class="category-field">
                            <label class="control-label">Email<em class="asterix">*</em></label>
                            <input type="text" class="form-control" name="email"  placeholder="contoh: email@gmail.com" value="{{ isset($desawisata->pengelola->email)?$desawisata->pengelola->email:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Website </label>
                            <input type="text" class="form-control" name="website" placeholder="contoh: http://www.pengelola.com" value="{{ isset($desawisata->pengelola->website)?$desawisata->pengelola->website:'' }}">
                        </div>
                        <div class="category-field">
                            <label class="control-label">Jumlah Pengurus
                            <em class="asterix">*</em></label>
                            <input type="number" name="jum_pengurus" pattern="[0-9]*" class="form-control" value="{{ (isset($desawisata->pengelola->website) and $desawisata->pengelola->jum_pengurus>0)?$desawisata->pengelola->jum_pengurus:'0' }}" placeholder="contoh: 1">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-category-entry">
                        <label class="control-label">Regulasi
                        </label>
                        <input type="text" name="regulasi" class="form-control" value="{{ isset($desawisata->pengelola->regulasi)?$desawisata->pengelola->regulasi:'' }} ">
                    </div>

                </div>
            </div>
            <!-- end form style ---->
    </div>
{{-- </form> --}}
