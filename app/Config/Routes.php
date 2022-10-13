<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'DashboardController::index');

$routes->group('Company', ['filter' => 'permission:company-read  '], function ($routes) {
    $routes->get('unitkerja', 'CompanyController::viewUnitkerja');
    $routes->get('ruangan', 'CompanyController::viewRuangan');
    $routes->get('departemen', 'CompanyController::viewDepartemen');
    $routes->get('jabatan', 'CompanyController::viewJabatan');
    $routes->get('karyawan', 'CompanyController::viewKaryawan');
    $routes->get('unitkerja/(:segment)', 'CompanyController::unitkerjaDetail/$1');
    $routes->get('ruangan/(:segment)', 'CompanyController::ruanganDetail/$1');
    $routes->get('departemen/(:segment)', 'CompanyController::departemenDetail/$1');
    $routes->get('jabatan/(:segment)', 'CompanyController::jabatanDetail/$1');
    $routes->get('karyawan/(:segment)', 'CompanyController::karyawanDetail/$1');
});




$routes->group('User', ['filter' => 'role:SuperAdmin  '], function ($routes) {
    $routes->get('account', 'UserController::viewUser');
    $routes->get('roles', 'UserController::viewRoles');
    $routes->get('account/(:segment)', 'UserController::accountDetail/$1');
    $routes->get('roles/(:segment)', 'UserController::rolesDetail/$1');
});


$routes->group('Inventaris', ['filter' => 'permission:inventaris-read  '], function ($routes) {
    $routes->get('kategori', 'InventarisController::viewKategori');
    $routes->get('product', 'InventarisController::viewProduct');
    $routes->get('supplier', 'InventarisController::viewSupplier');
    $routes->get('kategori/(:segment)', 'InventarisController::kategoriDetail/$1');
    $routes->get('subkategori/(:segment)', 'InventarisController::subkategoriDetail/$1');
    $routes->get('product/(:segment)', 'InventarisController::productDetail/$1');
    $routes->get('supplier/(:segment)', 'InventarisController::supplierDetail/$1');
});




$routes->get('Data/Inventaris', 'UnitController::viewDataInventaris');
$routes->get('Data/inventaris/(:segment)', 'UnitController::detailDataInventaris/$1',  ['filter' => 'permission:inventaris-update']);



$routes->get('Approve/(:segment)', 'OrderController::approve/$1');
$routes->get('Tolak/(:segment)', 'OrderController::tolak/$1');
$routes->get('Cetak/(:segment)', 'OrderController::cetak1/$1');
$routes->get('Data/Transaksi', 'OrderController::viewDataTransaksi');
$routes->get('Data/Transaksi', 'OrderController::viewDataTransaksi');
$routes->get('Data/transaksi/(:segment)', 'OrderController::detailDataTransaksi/$1');
$routes->get('Form/pengajuan', 'OrderController::viewFormPengajuan');
$routes->get('Form/cekMaintanance', 'AlgorithmController::viewPermohonanMaintanance');


$routes->group('Fahp', ['filter' => 'permission:klasifikasi-read  '], function ($routes) {
    $routes->get('kriteria', 'AlgorithmController::viewKriteria');
    $routes->get('kriteriabobot', 'AlgorithmController::viewBobotKriteria');
    $routes->get('alternatif', 'AlgorithmController::viewAlternatif');
});

$routes->group('Laporan', ['filter' => 'permission:klasifikasi-read  '], function ($routes) {
    $routes->get('inventaris', 'LaporanController::viewLaporanInventaris');
    $routes->get('qrcode', 'LaporanController::viewLaporanQRCode');
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
