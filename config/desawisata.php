<?php
// config/constants.php

return [
    'SITE_NAME' => 'Desa Wisata Jabar',
    'SITE_EMAIL' => 'desawisatajabar@gmail.com',
    'ADMIN_EMAIL' => 'sysadmin@desawisatajabar.com',
    'BACKEND_URL' => 'http://desajwt.apps/backend/',


    //URL ENDPOINT API
    //LOGIN
    'LOGIN_URL' => env('REST_URL').'api/auth/login',
    'REGISTER_URL' => config('desawisata.REST_URL').'api/auth/register',
    'ApiKelurahanAll' => env('APP_URL').'api/v1/kelurahan/term/32',
    // DESAWISATA
    'DESAWISATA_LIST' => config('desawisata.REST_URL').'v1/desawisata',
    'DESAWISATA_STORE_PROFIL' => config('desawisata.REST_URL').'v1/desawisata/storeprofil',
    'DESAWISATA_STORE_PENGELOLA' => config('desawisata.REST_URL').'v1/desawisata/storepengelola',
    'DESAWISATA_STORE_ATRAKSI' => config('desawisata.REST_URL').'v1/desawisata/storeatraksi',
    'DESAWISATA_STORE_AKSES' => config('desawisata.REST_URL').'v1/desawisata/storeakses',
    'DESAWISATA_STORE_FASILITAS' => config('desawisata.REST_URL').'v1/desawisata/storefasilitas',
    'DESAWISATA_STORE_STATISTIK' => config('desawisata.REST_URL').'v1/desawisata/storestatistik',

    'PROFILDESA_LIST' => config('desawisata.REST_URL').'v1/profildesa',

    'PATH_IMAGE_DEFAULT' => 'images/',
    'PATH_IMAGE_DESAWISATA' => 'storage/data-desawisata/',
    'PATH_IMAGE_PROFILDESA' => 'storage/data-profildesa/',
    'PATH_IMAGE_ATRAKSI' => 'storage/data-atraksi/',
    'PATH_IMAGE_FASILITAS' => 'storage/data-fasilitas/',
    'PATH_IMAGE_KELSOS' => 'storage/data-kelsos/',
    'PATH_IMAGE_USPAR' => 'storage/data-usahapariwisata/',
    'PATH_IMAGE_ARTIKEL' => 'storage/data-artikel/',
    'PATH_IMAGE_PENGHARGAAN' => 'storage/data-penghargaan/',
    'PATH_IMAGE_VIDEO' => 'storage/data-video/',
    'PATH_IMAGE_KATEGORI' => 'storage/kat-page/',
    'PATH_IMAGE_SLIDER' => 'storage/slider/',
    'PATH_IMAGE_AVATAR' => 'storage/avatar/',
    'PATH_IMAGE_HALAMAN' => 'storage/data-halaman/',
];
