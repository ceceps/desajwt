<div class="dashboard-content">

    <div class="dashboard-inner">
        <div class="container-fluid">
            <div id="smartwizard">
                <ul>
                    <li><a href="#step-1">Profil
                        </a></li>
                    <li><a href="#step-2">Pengelola
                        </a></li>
                    <li><a href="#step-3">Atraksi
                        </a></li>
                    <li><a href="#step-4">Aksesibilitas
                        </a></li>
                    <li><a href="#step-5">Fasilitas
                        </a></li>
                    <li><a href="#step-6">Promosi
                        </a></li>
                    <li><a href="#step-7">Kelompok Sosial
                        </a></li>
                    <li><a href="#step-8">Usaha Pariwisata
                        </a></li>
                    <li><a href="#step-8">Statistik
                        </a></li>
                    <li><a href="#step-9">Bantuan
                        </a></li>
                    <li><a href="#step-10">Dampak Bantuan
                        </a></li>
                    <li><a href="#step-11">Pemanfaatan Bantuan
                        </a></li>

                </ul>
                <div>
                    <div id="step-1" class="">
                       @include('admin.pages.desawisata.form_profil')
                    </div>
                    <div id="step-2" class="">
                      @include('admin.pages.desawisata.form_pengelola')
                    </div>
                    <div id="step-3" class="">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div class="panel clean">
                                    <form class="form-custom has-category" action="/" method="post">
                                        <!-- begin form style -->
                                        <div class="form-custom">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Atraksi</h4>
                                                    <p class="title-helper">Harap masukan semua input</p>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <!--  Blog Ini inginnya Inline satu baris untuk add input -->
                                                <div class="form-category-title">
                                                    <label class="main-label">Alam</label>
                                                </div>
                                                <div class="form-option">
                                                    <button type="button" class="btn btn-default" id="btnadd_atraksi">
                                                        <span class="icon-circle">
                                                            <i class="mdi mdi-plus-circle"></i>
                                                        </span>
                                                        Tambah Baru
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <table class="table table-striped" id="tbl_alam">
                                                    <thead>
                                                        <th>No</th>
                                                        <th>Kategori</th>
                                                        <th>Item</th>
                                                        <th>Foto</th>
                                                        <th>Aksi</th>
                                                    </thead>
                                                    <tbody>
                                                        <td id="no">1</td>
                                                        <td>
                                                            <select name="kat_atraksi[]" class="form-control select-category"
                                                                id="kategori_atraksi">
                                                                <option value=""></option>
                                                            </select></td>
                                                        <td><input type="text" name="ket_alam[]" class="form-control">
                                                        </td>
                                                        <td><input type="file" name="file_alam[]" class="btn btn-success">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn_alam_delete"><i class="mdi mdi-trash-can-outline"></i></span>
                                                            </button>
                                                        </td>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-category-title">
                                                    <label class="main-label">Budaya</label>
                                                </div>
                                                <div class="form-category-entry">
                                                    <div class="category-field">
                                                        <textarea name="atraksi_budaya" class="form-control col-6"
                                                            placeholder="contoh: atraksi seni tari" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-category-title">
                                                    <label class="main-label">Buatan</label>
                                                </div>
                                                <div class="form-category-entry">
                                                    <div class="category-field">
                                                        <textarea name="atraksi_buatan" class="form-control col-6"
                                                            placeholder="contoh: atraksi paralayang" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-4">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="akses" aria-labelledby="akses-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form">
                                                <h3 class="form-title">Aksesibilitas</h3>
                                                <p class="title-helper">Harap masukan semua
                                                    input</p>
                                            </div>
                                            <div class="form-group has-three-fields">
                                                <div class="form-category-entry">
                                                    <div class="category-field">
                                                        <label class="control-label">Jarak dari
                                                            Ibukota Provinsi<em class="asterix">*</em></label>
                                                        <input type="text" name="jarak_prov" class="form-control"
                                                            placeholder="...km" required="required">
                                                    </div>
                                                    <div class="category-field">
                                                        <label class="control-label">Waktu<em class="asterix">*</em></label>
                                                        <input type="text" name="waktu_prov" class="form-control"
                                                            placeholder="...jam" required="required">
                                                    </div>
                                                    <div class="category-field">
                                                        &nbsp;
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group has-three-fields">
                                                <div class="form-category-entry">
                                                    <div class="category-field">
                                                        <label class="control-label">Jarak dari
                                                            Ibukota Kab/Kota<em class="asterix">*</em></label>
                                                        <input type="text" name="jarak_kab" class="form-control"
                                                            placeholder="...km" required="required">
                                                    </div>
                                                    <div class="category-field">
                                                        <label class="control-label">Waktu<em class="asterix">*</em></label>
                                                        <input type="text" name="waktu_kab" class="form-control"
                                                            placeholder="...jam" required="required">
                                                    </div>
                                                    <div class="category-field">
                                                        &nbsp;
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group has-three-fields">
                                                <div class="form-category-entry">
                                                    <div class="category-field">
                                                        <label class="control-label">Jarak dari
                                                            Kecamatan<em class="asterix">*</em></label>
                                                        <input type="text" name="jarak_kec" class="form-control"
                                                            placeholder="...km" required="required">
                                                    </div>
                                                    <div class="category-field">
                                                        <label class="control-label">Waktu<em class="asterix">*</em></label>
                                                        <input type="text" name="waktu_kec" class="form-control"
                                                            placeholder="...jam" required="required">
                                                    </div>
                                                    <div class="category-field">
                                                        &nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-5">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="fasilitas" aria-labelledby="fasilitas-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Fasilitas</h4>
                                                </div>
                                                <div class="form-option">
                                                    <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                                                        <span class="icon-circle">
                                                            <i class="mdi mdi-plus-circle"></i>
                                                        </span>
                                                        Tambah Baru
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label">Item<em class="asterix">*</em></label>
                                                    <input type="text" name="item_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Keterangan<em class="asterix">*</em></label>
                                                    <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                                        placeholder="contoh: batununggal"></textarea>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Foto<em class="asterix">*</em></label>
                                                    <input type="file" name="foto_fasilitas[]" class="form-control for-upload">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>

                                            <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="item_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Parkir"></textarea>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="file" name="foto_fasilitas[]" class="form-control for-upload btn-success btn-sm">
                                                </div>
                                                <div class="field-item">
                                                    <!-- <label class="control-label">&nbsp;</label>-->
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-6">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="promosi" aria-labelledby="promosi-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form">
                                                <h4 class="form-title">Promosi</h4>
                                                <p class="title-helper">Promosi yang dilakukan
                                                    Desa Wisata dalam
                                                    mendatangkan
                                                    wistawan</p>
                                            </div>
                                            <div class="form-group has-three-fields reset-inline">

                                                <div class="category-field">
                                                    <label class="control-label">Brosur/Leaflet,
                                                        dll<em class="asterix">*</em></label>
                                                </div>
                                                <div class="category-field">
                                                    <div class="radio-group">
                                                        <div class="ted-radio">
                                                            <input id="p1" type="radio" name="pamplet" value="1">
                                                            <label for="p1"><em>Ada</em></label>
                                                        </div>
                                                        <div class="ted-radio">
                                                            <input id="p2" type="radio" name="pamplet" value="0">
                                                            <label for="p2"><em>Tidak</em></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="category-field end">
                                                    <textarea type="text" name="ket_pamplet" class="form-control col-4"
                                                        placeholder="Keterangan Pelaksanaan"></textarea>
                                                </div>

                                            </div>
                                            <div class="form-group has-three-fields reset-inline">

                                                <div class="category-field">
                                                    <label class="control-label">Pameran /
                                                        Festival<em class="asterix">*</em></label>
                                                </div>
                                                <div class="category-field">
                                                    <div class="radio-group">
                                                        <div class="ted-radio">
                                                            <input id="p3" type="radio" name="pameran" value="1">
                                                            <label for="p3"><em>Ada</em></label>
                                                        </div>
                                                        <div class="ted-radio">
                                                            <input id="p4" type="radio" name="pameran" value="0">
                                                            <label for="p4"><em>Tidak</em></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="category-field end">
                                                    <textarea type="text" name="ket_pameran" class="form-control col-4"
                                                        placeholder="Keterangan Pelaksanaan"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group has-three-fields reset-inline">
                                                <div class="category-field">
                                                    <label class="control-label">Website<em class="asterix">*</em></label>
                                                </div>
                                                <div class="category-field">
                                                    <div class="radio-group">
                                                        <div class="ted-radio">
                                                            <input id="p5" type="radio" name="web" value="1">
                                                            <label for="p5"><em>Ada</em></label>
                                                        </div>
                                                        <div class="ted-radio">
                                                            <input id="p6" type="radio" name="web" value="0">
                                                            <label for="p6"><em>Tidak</em></label>
                                                        </div>
                                                    </div>
                                                    <input type="text" id="url" name="url" class="form-control"
                                                        placeholder="http://">
                                                </div>
                                                <div class="category-field end">
                                                    <textarea type="text" name="ket_web" class="form-control col-4"
                                                        placeholder="Keterangan Pelaksanaan"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group has-three-fields reset-inline">
                                                <div class="category-field">
                                                    <label class="control-label">Digital
                                                        Lainnya<em class="asterix">*</em></label>
                                                </div>
                                                <div class="category-field">
                                                    <div class="radio-group">
                                                        <div class="ted-radio">
                                                            <input id="p7" type="radio" name="digital" value="1">
                                                            <label for="p7"><em>Ada</em></label>
                                                        </div>
                                                        <div class="ted-radio">
                                                            <input id="p8" type="radio" name="digital" value="0">
                                                            <label for="p8"><em>Tidak</em></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="category-field end">
                                                    <textarea type="text" name="ket_digital" class="form-control col-4"
                                                        placeholder="Keterangan Pelaksanaan"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group has-three-fields reset-inline">
                                                <div class="category-field">
                                                    <label class="control-label">Promosi Lainnya<em class="asterix">*</em></label>
                                                </div>
                                                <div class="category-field">
                                                    <div class="radio-group">
                                                        <div class="ted-radio">
                                                            <input id="p9" type="radio" name="lainnya" value="1">
                                                            <label for="p9"><em>Ada</em></label>
                                                        </div>
                                                        <div class="ted-radio">
                                                            <input id="p10" type="radio" name="lainnya" value="0">
                                                            <label for="p10"><em>Tidak</em></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="category-field end">
                                                    <textarea type="text" name="ket_lainnya" class="form-control col-4"
                                                        placeholder="Keterangan Pelaksanaan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-7">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="kelsos" aria-labelledby="kelsos-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Kelompok Sosial</h4>
                                                </div>
                                                <div class="form-option">
                                                    <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                                                        <span class="icon-circle">
                                                            <i class="mdi mdi-plus-circle"></i>
                                                        </span>
                                                        Tambah Baru
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="fieldset has-five">
                                                <div class="field-item">
                                                    <label class="control-label">Jenis
                                                        Kelompok<em class="asterix">*</em></label>
                                                    <select name="jen_kel[]" class="jen_kel form-control form-control select-category">
                                                        <option></option>
                                                        <option>Jenis Kelompok</option>
                                                        <option value="1">Kelompok Sadar
                                                            Wisata
                                                        </option>
                                                        <option value="2">Kelompok Pemandu
                                                            Wisata
                                                        </option>
                                                        <option value="3">Kelompok Sanggar
                                                            Kerajinan
                                                        </option>
                                                        <option value="4">Kelompok Seni
                                                            Budaya
                                                        </option>
                                                        <option value="5">Kelompok Makanan
                                                            Khas
                                                        </option>
                                                        <option value="6">Kelompok Homestay</option>
                                                        <option value="7">Kelompok Jasa
                                                            Fotografi
                                                        </option>
                                                        <option value="8">Kelompok Sarana
                                                            Pendukung Wisata
                                                            lainnya
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">
                                                        Jum Pengurus
                                                        <em class="asterix">*</em>
                                                    </label>
                                                    <input type="jum_kel" name="jum_kel[]" class="form-control">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Jum Anggota<em class="asterix">*</em></label>
                                                    <input type="jum_tenaga" name="jum_tenaga[]" class="form-control">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Keterangan<em class="asterix">*</em></label>
                                                    <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                                        placeholder="contoh: batununggal"></textarea>
                                                </div>
                                                <div class="field-item align-center">
                                                    <button type="button" class="btn btn-clean"><i class="mdi mdi-trash-can-outline"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-8">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="usaha" aria-labelledby="usaha-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Usaha Pariwisata</h4>
                                                    <p class="title-helper">Harap masukan semua input</p>
                                                </div>
                                                <div class="form-option">
                                                    <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                                                        <span class="icon-circle">
                                                            <i class="mdi mdi-plus-circle"></i>
                                                        </span>
                                                        Tambah Baru
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="fieldset has-five">
                                                <div class="field-item">
                                                    <label class="control-label">Jenis
                                                        Usaha<em class="asterix">*</em></label>
                                                    <select name="jen_kel[]" class="jen_kel form-control select-category">
                                                        <option></option>
                                                        <option>--Jenis Usaha--</option>
                                                        <option value="1">Usaha Souvenir /
                                                            Kerajinan
                                                        </option>
                                                        <option value="2">Usaha Pedagang
                                                            Tanaman Hias
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Jumlah
                                                        Pengusaha<em class="asterix">*</em></label>
                                                    <input type="text" name="jum_usaha[]" class="form-control">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Jum Tenaga
                                                        Kerja<em class="asterix">*</em></label>
                                                    <input type="text" name="jum_tenaga_usaha[]" class="form-control">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Keterangan<em class="asterix">*</em></label>
                                                    <textarea type="text" name="ket_usaha[]" class="form-control"
                                                        placeholder="contoh: Cinderamata"></textarea>
                                                </div>
                                                <div class="field-item align-center">
                                                    <button type="button" class="btn btn-clean"><i class="mdi mdi-trash-can-outline"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-9">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="statistik" aria-labelledby="statistik-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Statistik Pariwisata</h4>
                                                    <p class="title-helper">Kunjungan Wisatawan per
                                                        Bulan</p>
                                                </div>

                                            </div>
                                           <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label">Tahun <em class="asterix">*</em></label>
                                                    <select name="stat_tahun[]" class="form-control select-year">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Data <em class="asterix">*</em></label>
                                                    <input type="text" name="item_data_stat[]" class="form-control"
                                                        placeholder="Data Stattistik">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Jumlah<em class="asterix">*</em></label>
                                                    <input type="text" name="item_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>

                                            <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="item_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Parkir"></textarea>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-10">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="bantuan" aria-labelledby="bantuan-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-based">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Bantuan Dana Pariwisata</h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="radio-group">
                                                    <div class="ted-radio">
                                                        <input id="pb1" type="radio" name="pamplet" value="1">
                                                        <label for="pb1"><em>Pernah</em></label>
                                                    </div>
                                                    <div class="ted-radio">
                                                        <input id="pb2" type="radio" name="pamplet" value="0">
                                                        <label for="pb2"><em>Tidak</em></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-category-entry">
                                                    <label class="control-label">Program
                                                        Bantuan <em class="asterix">*</em></label>
                                                    <div class="category-field">
                                                        <input type="text" name="nama_program" id="nama_program" class="form-control"
                                                            placeholder="nama program" aria-describedby="helpId">

                                                    </div>
                                                    <br>
                                                    <a class="btn btn-default" id="add_tahun_bantuan">
                                                        Tambah Tahun</a>
                                                </div>
                                            </div>

                                            <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label">Tahun <em class="asterix">*</em></label>
                                                    <select name="dana_tahun[]" class="form-control select-year">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Besar Dana
                                                        <em class="asterix">*</em></label>
                                                    <input type="text" name="jum_dana[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Penggunaan
                                                        Untuk<em class="asterix">*</em></label>
                                                    <input type="text" name="dana_untuk[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item align-center">
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>
                                           <!-- end form style ---->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-11">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="dampak" aria-labelledby="dampak-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-custom">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Dampak Bantuan Wisata</h4>
                                                    <p class="title-helper">Harap masukan semua input</p>
                                                </div>
                                                <div class="form-option">
                                                    <button type="button" class="btn btn-default" id="btnadd_program">
                                                        <span class="icon-circle">
                                                            <i class="mdi mdi-plus-circle"></i>
                                                        </span>
                                                        Tambah Baru
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="fieldset has-six">
                                                    <div class="field-item">
                                                        <label class="control-label">Uraian<em class="asterix">*</em></label>
                                                        <input type="text" class="form-control" name="uraian[]">
                                                    </div>
                                                    <div class="field-item">
                                                        <label class="control-label">2015<em class="asterix">*</em></label>
                                                        <input type="text" class="form-control" name="2015[]">
                                                    </div>
                                                    <div class="field-item">
                                                        <label class="control-label">2016<em class="asterix">*</em></label>
                                                        <input type="text" class="form-control 2016" name="2016[]">
                                                    </div>
                                                    <div class="field-item">
                                                        <label class="control-label">2017<em class="asterix">*</em></label>
                                                        <input type="text" class="form-control 2017" name="2017[]">
                                                    </div>
                                                    <div class="field-item">
                                                        <label class="control-label">Dari Awal s/d 2018<em class="asterix">*</em></label>
                                                        <input type="text" class="form-control 2018" name="2018[]">
                                                    </div>
                                                    <div class="field-item">
                                                        <label class="control-label">Keterangan<em class="asterix">*</em></label>
                                                        <input type="text" class="form-control ket" nam="ket[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-12">
                        <form class="form-custom has-category" action="/" method="post">
                            <div class="row setup-content">
                                <div id="jenmanfaat" aria-labelledby="jenmanfaat-tab">
                                    <div class="panel clean">
                                        <!-- begin form style ---->
                                        <div class="form-custom">
                                            <div class="top-form with-option">
                                                <div class="form-title">
                                                    <h4 class="form-title">Usaha Pariwisata</h4>
                                                </div>
                                                <div class="form-option">
                                                    <button type="button" class="btn btn-default" id="btnadd_fasilitas">
                                                        <span class="icon-circle">
                                                            <i class="mdi mdi-plus-circle"></i>
                                                        </span>
                                                        Tambah Baru
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label">Item<em class="asterix">*</em></label>
                                                    <input type="text" name="item_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Keterangan<em class="asterix">*</em></label>
                                                    <textarea type="text" name="ket_fasilitas[]" class="form-control"
                                                        placeholder="contoh: batununggal"></textarea>
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">Foto<em class="asterix">*</em></label>
                                                    <input type="file" name="foto_fasilitas[]" class="form-control">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label">&nbsp;</label>
                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>
                                            <div class="fieldset has-four">
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="text" name="item_fasilitas[]" class="form-control"
                                                        placeholder="contoh: Masjid">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="file" name="foto_fasilitas[]" class="form-control btn-success btn-sm">
                                                </div>
                                                <div class="field-item">
                                                    <label class="control-label"></label>
                                                    <input type="file" name="foto_fasilitas[]" class="form-control">
                                                </div>
                                                <div class="field-item">

                                                    <a href="#" class="btn btn-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></a>
                                                </div>
                                            </div>
                                       </div>
                                        <!-- end form style ---->
                                    </div>
                                </div>
                            </div>
                            <!-- class outer untuk di tab saja yang lokasi nya di luar tab -->
                            <div class="button-action outer">
                                <button type="submit" class="btn btn-default brand">
                                    Simpan
                                </button>
                                <button type="button" class="btn btn-default btn-flat">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end dashboard content -->
        </div>

        @endsection

        @section('script')
        <script src="{{ asset('js/smartWizard/dist/js/jquery.smartWizard.min.js')}}"></script>
        {{-- <script src="{{ asset('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.min.js')}}"></script> --}}
        {{-- <script src="{{ asset('js/tab.js')}}"></script> --}}
        <script src="{{ asset('js/tinymce/tinymce.min.js')}}"></script>
        <script src="{{ asset('js/dropzone.js')}}"></script>

        <script>
            $(document).ready(function (e) {
                e.preventDefault;
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_alam = $(".add_alam"); //Add button ID
                var add_budaya = $(".add_budaya"); //Add button ID
                var add_buatan = $(".add_buatan"); //Add button ID

                var hiddenAlam = '<input type="hidden" name="idalam[]">';
                var cboAlam = '<select name="atraksi_alam[]" class="form-control"><option></option></select>';
                var ketalam = '<input type="text" name="ket_alam[]">';
                var filealam = '<input type="file" name="file_alam[]">';
                var delalam =
                    '<a href="" id="btn_delete"><span class="badge badge-danger"><i class="mdi mdi-trash-can-outline"></i></span></a>';

                //step Wizard
                $('#smartwizard').smartWizard({
                    toolbarSettings: {
                        toolbarExtraButtons: [
                            $('<button></button>').text('Finish')
                            .addClass('btn btn-info')
                            .on('click', function () {
                                alert('Selesai');
                            }),
                            $('<button></button>').text('Cancel')
                            .addClass('btn btn-danger')
                            .on('click', function () {
                                alert('Batal ?');
                            })
                        ]
                    },
                });

                 Dropzone.options.myAwesomeDropzone = {
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 8, // MB
                    clickable: true,
                    uploadMultiple: true,
                    addRemoveLinks: true,
                    dictRemoveFile: "Remove File",
                    dictDefaultMessage: "Hey Yo"

                };

            });

        </script>
