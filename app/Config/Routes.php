<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ================= AUTH =================
$routes->get('login', 'Login::index');
$routes->match(['get','post'], 'login/auth', 'Login::auth');
$routes->get('logout', 'Login::logout');


// ================= USER =================
    $routes->group('', ['filter' => 'auth'], function($routes) {

    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // ABSENSI
    $routes->get('absensi', 'User\Absensi::index');
    $routes->get('absensi/create', 'User\Absensi::create');
    $routes->post('absensi/store', 'User\Absensi::store');
    $routes->get('absensi/pulang/(:num)', 'User\Absensi::pulang/$1');

    // CUTI
    $routes->get('cuti', 'User\Cuti::index');
    $routes->get('cuti/create', 'User\Cuti::create');
    $routes->post('cuti/store', 'User\Cuti::store');

    // LOG
    $routes->get('log', 'Log::index');
});


// ================= ADMIN =================
$routes->group('admin', ['filter' => 'auth'], function($routes) {

    $routes->get('dashboard', 'Dashboard::index');

    // ABSENSI
    $routes->get('absensi', 'Admin\Absensi::index');
    $routes->get('absensi/edit/(:num)', 'Admin\Absensi::edit/$1');
    $routes->post('absensi/update/(:num)', 'Admin\Absensi::update/$1');
    $routes->get('absensi/delete/(:num)', 'Admin\Absensi::delete/$1');

    // CUTI
    $routes->get('cuti', 'Admin\Cuti::index');
    $routes->get('cuti/approve/(:num)', 'Admin\Cuti::approve/$1');
    $routes->get('cuti/reject/(:num)', 'Admin\Cuti::reject/$1');

    // LOG
    $routes->get('log', 'Log::index');
});


// ================= KARYAWAN =================
$routes->group('karyawan', ['filter' => 'auth'], function($routes) {

    $routes->get('/', 'Karyawan::index');
    $routes->get('create', 'Karyawan::create');
    $routes->post('store', 'Karyawan::store');
    $routes->get('edit/(:num)', 'Karyawan::edit/$1');
    $routes->post('update/(:num)', 'Karyawan::update/$1');
    $routes->get('delete/(:num)', 'Karyawan::delete/$1');
});


// ================= API MOBILE =================
$routes->group('api', function($routes) {

    // LOGIN
    $routes->post('login', 'Api\Auth::login');
    // DATA ABSENSI
    $routes->get('absensi', 'Api\Absensi::index');

    // ABSENSI
    $routes->post('absen/masuk', 'Api\Absensi::masuk');
    $routes->post('absen/keluar', 'Api\Absensi::keluar');
   $routes->post('absensi/delete', 'Api\Absensi::delete');
    $routes->post('absensi/update', 'Api\Absensi::update');

    // CUTI
    $routes->post('cuti/ajukan', 'Api\Cuti::ajukan');
    $routes->get('cuti/riwayat', 'Api\Cuti::riwayat');
    $routes->get('cuti/detail/(:num)', 'Api\Cuti::detail/$1');
    $routes->post('cuti/update/(:num)', 'Api\Cuti::updateStatus/$1');

    // KARYAWAN
    $routes->get('karyawan', 'Api\Karyawan::index');
    $routes->post('karyawan/tambah', 'Api\Karyawan::store');
    $routes->post('karyawan/update/(:num)', 'Api\Karyawan::update/$1');
    $routes->post('karyawan/delete/(:num)', 'Api\Karyawan::delete/$1');

});