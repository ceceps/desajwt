<?php
/**
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * | @author: Cecep Saefulloh, S.Kom
 * | @category: Routing Web based
 * |
 */

Route::get('/', 'Frontend\FrontController@index')->name('home');
Route::get('/home', 'Frontend\FrontController@index')->name('home');

Auth::routes();
//verifikasi email user
Auth::routes(['verify' => true]);

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('user/profil/{id}', 'UserController@showProfil')->middleware('verified')->name('user.profil');
Route::put('user/change-profil', 'UserController@updateProfil')->name('front.user.update');

Route::get('desawisata', 'Frontend\DesaWisataController@frontAllDesaWisata')->name('desawisata');
Route::get('desawisata/{slug}', 'Frontend\DesaWisataController@showFront')->name('front.desawisata.show');

Route::get('profildesa', 'Frontend\ProfileDesaController@index')->name('desa');
Route::get('profildesa/{slug}', 'Frontend\ProfileDesaController@showFront')->name('front.desa.show');

Route::get('galeri', 'Frontend\GaleriController@index')->name('galeri');
Route::get('galeri/foto', 'Frontend\GaleriController@foto')->name('galeri.foto');
Route::get('galeri/foto/{slug}', 'Frontend\GaleriController@foto')->name('galeri.foto.detil');
Route::get('galeri/video', 'Frontend\GaleriController@video')->name('galeri.video');
Route::get('galeri/video/{slug}', 'Frontend\GaleriController@video')->name('galeri.video.detil');

Route::get('artikel', 'Frontend\ArtikelController@index')->name('front.artikel');
Route::get('artikel/{slug}', 'Frontend\ArtikelController@showArtikel')->name('front.artikel.show');


Route::get('/map',function(){
    return view('frontend.pages.map.poi');
});
//Ajax
// Route::get('kabupaten/provinsi/{idprov}', 'WilayahController@getKabByProvinsi');


Route::get('/verify', 'Frontend\FrontController@verify')->name('verify');

Route::get('halaman/{slug}', 'Frontend\HalamanController@show')->name('halaman.show');

 Route::get('/peta_destinasi', 'Frontend\MapController@index')->name('map.index');

Route::group(['middleware' => 'web', 'prefix' => 'backend'], function () {


    Route::get('/login', 'Backend\AdminLoginController@showLoginForm')->name('backend.login');
    Route::get('/support', 'Backend\AdminLoginController@showSupportDialog')->name('backend.support');
    Route::get('/forget-password', 'Backend\AdminLoginController@showForgetForm')->name('backend.forget');
    Route::post('/login', 'Backend\AdminLoginController@postLogin')->name('backend.postlogin');
});

Route::group(['middleware' => ['role:superadmin,admin_disparbud,admin_kabkota,jabarjuara','auth'],'prefix' => 'backend',], function () {
// Route::group(['middleware' => ['auth'],'prefix' => 'backend',], function () {

      Route::get('/', 'Backend\DashboardController@index')->name('dashboard');
      Route::get('/logout', 'Backend\AdminLoginController@logout')->name('backend.logout');
      //   Route::get('/register','Backend\ADminLoginController@showRegisterForm')->name('backend.register');
      //   Route::post('/register','Backend\LoginController@postRegister')->name('backend.postregister');
      Route::get('/profile', 'Backend\AdminLoginController@me')->name('backend.user.profile');

      Route::resource('desawisata', 'Backend\DesaWisataController');
      Route::get('desawisata/{status}/view','Backend\DesaWisataController@tampil')->name('desawisata.view.status');
      Route::post('desawisata', 'Backend\DesaWisataController@storeprofil')->name('desawisata.storeprofile');
      Route::get('desawisata/getkab/{kode}','Backend\DesaWisataController@getKabIDByKode')->name('desawisata.getkab');

      Route::put('desawisata/update', 'Backend\DesaWisataController@updateprofil')->name('desawisata.updateprofile');

      Route::get('desawisata/createpengelola/{id}', 'Backend\DesaWisataController@createPengelola')->name('desawisata.create.pengelola');
      Route::post('desawisata/createpengelola/{id}', 'Backend\DesaWisataController@storePengelola')->name('desawisata.store.pengelola');
      Route::get('desawisata/editpengelola/{id}', 'Backend\DesaWisataController@editPengelola')->name('desawisata.edit.pengelola');
      Route::put('desawisata/editpengelola/{id}', 'Backend\DesaWisataController@updatePengelola')->name('desawisata.update.pengelola');

      Route::get('desawisata/createakses/{id}', 'Backend\DesaWisataController@createAkses')->name('desawisata.create.akses');
      Route::post('desawisata/storeakses/{id}', 'Backend\DesaWisataController@storeAkses')->name('desawisata.store.akses');
      Route::put('desawisata/editakses/{id}', 'Backend\DesaWisataController@updateAkses')->name('desawisata.update.akses');

      Route::get('desawisata/createatraksi/{id}', 'Backend\DesaWisataController@createAtraksi')->name('desawisata.create.atraksi');
      Route::get('desawisata/getatraksi/{id}', 'Backend\DesaWisataController@getAtraksi')->name('desawisata.get.atraksi');
      Route::post('desawisata/ceknamaatraksi/{id}', 'Backend\DesaWisataController@cekNamaAtraksi')->name('desawisata.cek.namaatraksi');
      Route::post('desawisata/storeatraksi/{id}', 'Backend\DesaWisataController@storeAtraksi')->name('desawisata.store.atraksi');
      Route::post('desawisata/storemediaatraksi/{id}', 'Backend\DesaWisataController@storeAtraksi')->name('desawisata.store.mediaatraksi');
      Route::put('desawisata/editatraksi/{id}', 'Backend\DesaWisataController@updateAtraksi')->name('desawisata.update.atraksi');

      Route::get('desawisata/createpromosi/{id}', 'Backend\DesaWisataController@createPromosi')->name('desawisata.create.promosi');
      Route::post('desawisata/storepromosi/{id}', 'Backend\DesaWisataController@storePromosi')->name('desawisata.store.promosi');
      Route::get('desawisata/editpromosi/{id}', 'Backend\DesaWisataController@editPromosi')->name('desawisata.edit.promosi');
      Route::put('desawisata/editpromosi/{id}', 'Backend\DesaWisataController@updatePromosi')->name('desawisata.update.promosi');

      Route::get('desawisata/createfasilitas/{id}', 'Backend\DesaWisataController@createFasilitas')->name('desawisata.create.fasilitas');
      Route::post('desawisata/storefasilitas/{id}', 'Backend\DesaWisataController@storeFasilitas')->name('desawisata.store.fasilitas');
      Route::get('desawisata/editfasilitas/{id}', 'Backend\DesaWisataController@editFasilitas')->name('desawisata.edit.fasilitas');
      Route::put('desawisata/editfasilitas/{id}', 'Backend\DesaWisataController@updateFasilitas')->name('desawisata.update.fasilitas');

      Route::get('desawisata/createkelsos/{id}', 'Backend\DesaWisataController@createKelsos')->name('desawisata.create.kelsos');
      Route::post('desawisata/storekelsos/{id}', 'Backend\DesaWisataController@storeKelsos')->name('desawisata.store.kelsos');
      Route::get('desawisata/editkelsos/{id}', 'Backend\DesaWisataController@editKelsos')->name('desawisata.edit.kelsos');
      Route::put('desawisata/editkelsos/{id}', 'Backend\DesaWisataController@updateKelsos')->name('desawisata.update.kelsos');

      Route::get('desawisata/createuspar/{id}', 'Backend\DesaWisataController@createUspar')->name('desawisata.create.uspar');
      Route::post('desawisata/storeuspar/{id}', 'Backend\DesaWisataController@storeUspar')->name('desawisata.store.uspar');
      Route::get('desawisata/edituspar/{id}', 'Backend\DesaWisataController@editUspar')->name('desawisata.edit.uspar');
      Route::put('desawisata/edituspar/{id}', 'Backend\DesaWisataController@updateUspar')->name('desawisata.update.uspar');

      Route::post('desawisata/createstat/{id}', 'Backend\DesaWisataController@storeStat')->name('desawisata.store.stat');
      Route::get('desawisata/createstat/{id}', 'Backend\DesaWisataController@createStat')->name('desawisata.create.stat');
      Route::get('desawisata/edituspar/{id}', 'Backend\DesaWisataController@editStat')->name('desawisata.edit.stat');
      Route::put('desawisata/edituspar/{id}', 'Backend\DesaWisataController@updateStat')->name('desawisata.update.stat');

      Route::get('desawisata/createbantuan/{id}', 'Backend\DesaWisataController@createBantuan')->name('desawisata.create.bantuan');
      Route::post('desawisata/createbantuan/{id}', 'Backend\DesaWisataController@storeBantuan')->name('desawisata.store.bantuan');
      Route::get('desawisata/editubantuan/{id}', 'Backend\DesaWisataController@editBantuan')->name('desawisata.edit.bantuan');
      Route::put('desawisata/editubantuan/{id}', 'Backend\DesaWisataController@updateBantuan')->name('desawisata.update.bantuan');

      Route::get('desawisata/createpenghargaan/{id}', 'Backend\DesaWisataController@createPenghargaan')->name('desawisata.create.penghargaan');
      Route::post('desawisata/createpenghargaan/{id}', 'Backend\DesaWisataController@storePenghargaan')->name('desawisata.store.penghargaan');
      Route::get('desawisata/editpenghargaan/{id}', 'Backend\DesaWisataController@editPenghargaan')->name('desawisata.edit.penghargaan');
      Route::put('desawisata/editpenghargaan/{id}', 'Backend\DesaWisataController@updatePenghargaan')->name('desawisata.update.penghargaan');

      Route::resource('profildesa', 'Backend\ProfilDesaController');
      Route::get('profildesa/getpendidikan/{id}','Backend\ProfilDesaController@getPendidikan')->name('desa.get.pendidikan');
      Route::get('profildesa/getpenduduk/{id}','Backend\ProfilDesaController@getPenduduk')->name('desa.get.penduduk');

      Route::resource('artikel', 'Backend\ArtikelController');
      Route::resource('kategoriartikel', 'Backend\KategoriArtikelController');
      Route::resource('map', 'Backend\MapController');
      Route::resource('halaman','Backend\HalamanController');

      Route::resource('role', 'Backend\RoleController')->except([
        'create', 'show', 'edit', 'update'
      ]);
      Route::match(['get','post'],'galeri', 'Backend\GaleriController@index')->name('backend.galeri');
      Route::delete('galeri/{filename}', 'Backend\GaleriController@deleteImage')->name('backend.galeri.delete');
      Route::get('galeri/foto', 'Backend\GaleriController@foto')->name('backend.galeri.foto');
      Route::get('galeri/video', 'Backend\GaleriController@video')->name('backend.galeri.video');

      Route::resource('chat', 'Backend\ChatController');

      Route::get('users', 'UserController@listUserBackend')->name('backend.user.index');
      Route::get('users/create', 'UserController@create')->name('backend.user.create');
      Route::post('users', 'UserController@store')->name('backend.user.store');
      Route::patch('users/update', 'UserController@postUpdates')->name('backend.user.update');
      Route::post('users/softdelete/{id}', 'UserController@softdelete')->name('backend.user.softdelete');
      Route::delete('users/delete/{id}', 'UserController@destroy')->name('backend.user.delete');
      Route::get('users/profil', 'UserController@getCurrentUser')->name('backend.user.profil');
      Route::get('users/edit/{id}', 'UserController@getUserById')->name('backend.user.edit');
      Route::get('users/jumuser/{status}', 'UserController@countUser')->name('backend.user.jum');

      Route::get('seting', 'SetingController@index')->name('backend.seting.index');
});
