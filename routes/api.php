<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@authenticate')->name('api.login');
    Route::post('register', 'AuthController@register')->name('api.register');

});
//api non auth
Route::group(['prefix' => 'v1'], function () {
    Route::get('desawisata', 'Api\v1\DesaWisataController@getAllDesaWisataCached')->name('api.desawisata');
    Route::get('profildesa', 'Api\v1\ProfilDesaController@all')->name('api.profildesa');
    Route::get('kelurahan/term/{id}', 'Api\v1\ApiWilayahController@getAllKelurahan')->name('api.kelterm');
    Route::get('getcomboatraksi/{tipe}', 'Api\v1\AtributJenisDataController@getComboJenisAtraksi')->name('api.getcomboatraksi');
    Route::get('getcombojenisfasilitas', 'Api\v1\AtributJenisDataController@getComboJenisFasilitas')->name('api.getcombojenisfasilitas');
    Route::get('getcombokelsos', 'Api\v1\AtributJenisDataController@getComboJenisKelsos')->name('api.getcombokelsos');
    Route::get('getcombojenisdata', 'Api\v1\AtributJenisDataController@getComboJenisStatistik')->name('api.getcombojenisdata');
    Route::get('getcombojenisusaha', 'Api\v1\AtributJenisDataController@getComboJenisUsaha')->name('api.getcombojenisusaha');
    Route::get('getcombojenisdampak', 'Api\v1\AtributJenisDataController@getComboJenisDampak')->name('api.getcombojenisdampak');

    Route::get('kabupaten/provinsi/{idprov}', 'Api\v1\ApiWilayahController@getKabByProvinsi')->name('api.kabprov');
});

//api auth
Route::group(['middleware' => 'auth:api','prefix' => 'v1'], function () {
    Route::get('kecamatan/kabupaten/{id}', 'Api\v1\ApiWilayahController@getKecamatan')->name('api.keckab');
    Route::get('kelurahan/kecamatan/{id}', 'Api\v1\ApiWilayahController@getKelurahan')->name('api.kelkec');
    // Route::get('kelurahan/term/{id}', 'Api\v1\ApiWilayahController@getAllKelurahan')->name('api.kelterm');

});
Route::post('desawisata/storeweb', 'Api\v1\DesaWisataController@storeWeb')->name('api.desawisata.storeweb');


Route::group(['middleware' => ['auth:api','jwt.auth','jwt.refresh'],'prefix' => 'v1'], function () {
    Route::get('user', 'AuthController@getAuthenticatedUser');

    Route::get('desawisata/filter', 'Api\v1\DesaWisataController@filter')->name('api.desawisata.filters');
    Route::post('profildesa', 'Api\v1\ProfilDesaController@store');

    Route::post('desawisata/store', 'Api\v1\DesaWisataController@store')->name('api.desawisata.store');
    Route::post('desawisata/storeprofil', 'Api\v1\DesaWisataController@storeprofil')->name('api.desawisata.store.profil');
    Route::post('desawisata/storepengelola', 'Api\v1\DesaWisataController@storePengelola')->name('api.desawisata.store.pengelola');
    Route::post('desawisata/storeatraksi', 'Api\v1\DesaWisataController@storeAtraksi')->name('api.desawisata.store.atraksi');
    Route::post('desawisata/storeakses', 'Api\v1\DesaWisataController@storeAkses')->name('api.desawisata.store.akses');
    Route::post('desawisata/storefasilitas', 'Api\v1\DesaWisataController@storeFasilita')->name('api.desawisata.store.fasilitas');
    Route::post('desawisata/storepromosi', 'Api\v1\DesaWisataController@storePromosi')->name('api.desawisata.store.promosi');
    Route::post('desawisata/storekelsos', 'Api\v1\DesaWisataController@storeKelsos')->name('api.desawisata.store.kelsos');
    Route::post('desawisata/storepariwisata', 'Api\v1\DesaWisataController@storePariwisata')->name('api.desawisata.store.pariwisata');
    Route::post('desawisata/storestatistik', 'Api\v1\DesaWisataController@storeStatistik')->name('api.desawisata.store.statistik');
    Route::post('desawisata/storebantuan', 'Api\v1\DesaWisataController@storeBantuan')->name('api.desawisata.store.bantuan');
    Route::post('desawisata/storepenghargaan', 'Api\v1\DesaWisataController@storePenghargaan')->name('api.desawisata.store.penghargaan');
});
