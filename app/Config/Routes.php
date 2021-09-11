<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AuthCtrl');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(\false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Auth
$routes->get('/', 'AuthCtrl::index');
$routes->group('auth', function ($routes) {
	$routes->get('/', 'AuthCtrl::index');
	$routes->post('login', 'AuthCtrl::login');
	$routes->post('gantiTahun', 'AuthCtrl::gantiTahun', ['filter' => 'authfilter']);
	$routes->get('logout', 'AuthCtrl::logout');
	// $routes->get('cobaxml', 'AuthCtrl::cobaxml');
});

$routes->group('atur', ['filter' => 'authfilter'], function ($routes) {
	// tahun
	$routes->get('tahun', 'TahunCtrl::tahun');
	$routes->get('getTahun', 'TahunCtrl::getTahun');
	$routes->post('tambahTahun', 'TahunCtrl::tambahTahun');
	$routes->post('getTahunId', 'TahunCtrl::getTahunId');
	$routes->post('editStsTahun', 'TahunCtrl::editStsTahun');
	$routes->post('hapusTahun', 'TahunCtrl::hapusTahun');

	//tahapan
	$routes->get('tahap', 'TahapCtrl::tahap');
	$routes->get('getTahap', 'TahapCtrl::getTahap');
	$routes->post('tambahTahap', 'TahapCtrl::tambahTahap');
	$routes->post('getTahapId', 'TahapCtrl::getTahapId');
	$routes->post('editTahap', 'TahapCtrl::editTahap');
	$routes->post('editStsTahap', 'TahapCtrl::editStsTahap');
	$routes->post('hapusTahap', 'TahapCtrl::hapusTahap');

	// role 
	$routes->get('role', 'RoleCtrl::role');
	$routes->get('getRole', 'RoleCtrl::getRole');
	$routes->post('tambahRole', 'RoleCtrl::tambahRole');
	$routes->post('getRoleId', 'RoleCtrl::getRoleId');
	$routes->post('editRole', 'RoleCtrl::editRole');
	$routes->post('hapusRole', 'RoleCtrl::hapusRole');

	// menu
	$routes->get('menu', 'MenuCtrl::menu');
	$routes->get('getMenu', 'MenuCtrl::getMenu');
	$routes->post('getMenuId', 'MenuCtrl::getMenuId');
	$routes->post('tambahMenu', 'MenuCtrl::tambahMenu');
	$routes->post('editMenu', 'MenuCtrl::editMenu');
	$routes->post('hapusMenu', 'MenuCtrl::hapusMenu');
	$routes->get('subMenu/(:alphanum)', 'MenuCtrl::subMenu/$1');
	$routes->get('getSubMenu/(:alphanum)', 'MenuCtrl::getSubMenu/$1');
	$routes->post('tambahSubMenu', 'MenuCtrl::tambahSubMenu');
	$routes->get('menuAkses', 'MenuCtrl::menuAkses');
	$routes->get('getMenuAkses/(:alphanum)', 'MenuCtrl::getMenuAkses/$1');


	// User
	$routes->get('user', 'UserCtrl::user');
	$routes->get('getUser', 'UserCtrl::getUser');
	$routes->post('tambahUser', 'UserCtrl::tambahUser');
	$routes->post('getUserId', 'UserCtrl::getUserId');
	$routes->post('editUser', 'UserCtrl::editUser');
	$routes->post('hapusUser', 'UserCtrl::hapusUser');

	// unit SKPD
	$routes->get('unit', 'UnitCtrl::unit');
	$routes->get('getUnit', 'UnitCtrl::getUnit');
	$routes->post('tambahUnit', 'UnitCtrl::tambahUnit');
	$routes->post('getUnitId', 'UnitCtrl::getUnitId');
	$routes->post('editUnit', 'UnitCtrl::editUnit');
	$routes->post('hapusUnit', 'UnitCtrl::hapusUnit');
});

// Admin Area
$routes->group('adminarea', ['filter' => 'authfilter'], function ($routes) {
	$routes->get('/', 'DashboardCtrl::adminarea');
});


// Verif Area
$routes->group('verifarea', ['filter' => 'authfilter'], function ($routes) {
	$routes->get('/', 'DashboardCtrl::verifarea');
	// Profil TAPD
	$routes->get('profil', 'TapdCtrl::profil');
	$routes->get('getProfil', 'TapdCtrl::getProfil');
	$routes->post('getProfilId', 'TapdCtrl::getProfilId');
	$routes->post('editProfil', 'TapdCtrl::editProfil');

	$routes->get('getTtd', 'TapdCtrl::getTtdTapd');
});

// User Area
$routes->group('userarea', ['filter' => 'authfilter'], function ($routes) {
	$routes->get('/', 'DashboardCtrl::userarea');
	// Profil SKPD
	$routes->get('profil', 'UnitCtrl::profil');
	$routes->get('getProfil', 'UnitCtrl::getProfil');
	$routes->post('getProfilId', 'UnitCtrl::getProfilId');
	$routes->post('editProfil', 'UnitCtrl::editProfil');
});

// referensi
$routes->group('ref', ['filter' => 'authfilter'], function ($routes) {
	$routes->get('urusan', 'RefCtrl::urusan');
	$routes->get('getUrusan', 'RefCtrl::getUrusan');
	$routes->get('bidang', 'RefCtrl::bidang');
	$routes->get('getBidang', 'RefCtrl::getBidang');
	$routes->get('program', 'RefCtrl::program');
	$routes->get('getProgram', 'RefCtrl::getProgram');
	$routes->get('kegiatan', 'RefCtrl::kegiatan');
	$routes->get('getKegiatan', 'RefCtrl::getKegiatan');
	$routes->get('subKegiatan', 'RefCtrl::subKegiatan');
	$routes->get('getSubKegiatan', 'RefCtrl::getSubKegiatan');
	$routes->get('akun', 'RefCtrl::akun');
	$routes->get('getAkun', 'RefCtrl::getAkun');
	$routes->get('getRefAkunBl/(:num)', 'RefCtrl::getRefAkunBl/$1');
});

// Usulan SKPD
$routes->group('usulan/skpd', ['filter' => 'authfilter'], function ($routes) {
	// Daftar Usulan SKPD
	$routes->get('/', 'UsulanSkpdCtrl::index');
	$routes->get('getUsulan', 'UsulanSkpdCtrl::getUsulan');
	$routes->post('tambahUsulan', 'UsulanSkpdCtrl::tambahUsulan');
	$routes->post('getUsulanId', 'UsulanSkpdCtrl::getUsulanId');
	$routes->post('editUsulan', 'UsulanSkpdCtrl::editUsulan');
	$routes->post('editStsUsulan', 'UsulanSkpdCtrl::editStsUsulan');
	$routes->post('hapusUsulan', 'UsulanSkpdCtrl::hapusUsulan');
	$routes->post('detailHasilVerif', 'UsulanTapdCtrl::detailHasilVerif');
	$routes->post('detailHasilRekom', 'UsulanTapdCtrl::detailHasilRekomendasi');

	// sub Kegiatan
	$routes->get('subKeg/(:alphanum)', 'UsulanSubKegCtrl::skpdSubKeg/$1');
	$routes->get('getSubKeg/(:alphanum)', 'UsulanSubKegCtrl::skpdGetSubKeg/$1');
	$routes->get('formTambahSubKeg/(:alphanum)', 'UsulanSubKegCtrl::skpdFormTambahSubKeg/$1');
	$routes->get('getSubKegList', 'UsulanSubKegCtrl::skpdGetSubKegList');
	$routes->post('getSubKegId', 'UsulanSubKegCtrl::getSubKegId');
	$routes->post('tambahSubKeg/(:alphanum)', 'UsulanSubKegCtrl::skpdTambahSubKeg/$1');
	$routes->post('hapusSubKeg', 'UsulanSubKegCtrl::skpdHapusSubKeg');

	// Rincian
	$routes->get('rinci/(:alphanum)/(:alphanum)', 'UsulanRinciCtrl::skpdRinci/$1/$2');
	$routes->get('getPaguRinci/(:alphanum)/(:alphanum)', 'UsulanRinciCtrl::getPaguRinci/$1/$2');
	$routes->get('getRincian/(:alphanum)/(:alphanum)', 'UsulanRinciCtrl::skpdGetRinci/$1/$2');
	$routes->post('getRincianId', 'UsulanRinciCtrl::getRincianId');
	$routes->post('tambahRincian/(:alphanum)', 'UsulanRinciCtrl::tambahRincian/$1');
	$routes->post('editRincian', 'UsulanRinciCtrl::editRincian');
	$routes->post('uploadRincian', 'UploadCtrl::excelUploadRincian');
	$routes->post('hapusRincian', 'UsulanRinciCtrl::hapusRincian');
	$routes->post('hapusSemuaRincian', 'UsulanRinciCtrl::hapusSemuaRincian');
	// Template Rincian
	$routes->get('templateRincian', 'UsulanRinciCtrl::templateRincian');
});

// Usulan Cetak
$routes->group('usulan/cetak', ['filter' => 'authfilter'], function ($routes) {
	$routes->get('surat/(:alphanum)', 'CetakCtrl::suratUsulan/$1');
	$routes->get('rekomendasi/(:alphanum)', 'CetakCtrl::rekomendasi/$1');
	$routes->get('subkeg/rinci/(:alphanum)/(:alphanum)', 'CetakCtrl::subKegRinci/$1/$2');
	$routes->get('subkeg/rubah/(:alphanum)/(:alphanum)', 'CetakCtrl::subKegRinciRubah/$1/$2');
});

// Usulan Upload
$routes->group('usulan/upload', ['filter' => 'authfilter'], function ($routes) {
	$routes->post('uploadSurat', 'UploadCtrl::uploadSurat');
	$routes->post('hapusSurat', 'UploadCtrl::hapusSurat');
	$routes->post('uploadLampiran', 'UploadCtrl::uploadLampiran');
	$routes->post('hapusLampiran', 'UploadCtrl::hapusLampiran');
	$routes->post('uploadPendukung', 'UploadCtrl::uploadPendukung');
	$routes->post('hapusPendukung', 'UploadCtrl::hapusPendukung');
	// Rekomendasi TAPD
	$routes->post('uploadRekomendasi', 'UploadCtrl::uploadRekomendasi');
	$routes->post('hapusRekomendasi', 'UploadCtrl::hapusRekomendasi');
});

// Usulan TAPD
$routes->group('usulan/tapd', ['filter' => 'authfilter'], function ($routes) {
	// Daftar Usulan SKPD
	$routes->get('masuk', 'UsulanTapdCtrl::index/masuk');
	$routes->get('verif', 'UsulanTapdCtrl::index/verif');
	$routes->get('rekomendasi', 'UsulanTapdCtrl::index/rekomendasi');
	$routes->get('disetujui', 'UsulanTapdCtrl::index/disetujui');
	$routes->get('ditolak', 'UsulanTapdCtrl::index/ditolak');
	// getData
	$routes->get('getUsulanMasuk', 'UsulanTapdCtrl::getUsulanMasuk');
	$routes->get('getUsulanVerif', 'UsulanTapdCtrl::getUsulanVerif');
	$routes->get('getUsulanRekomendasi', 'UsulanTapdCtrl::getUsulanRekomendasi');
	$routes->get('getUsulanDisetujui', 'UsulanTapdCtrl::getUsulanDisetujui');
	$routes->get('getUsulanDitolak', 'UsulanTapdCtrl::getUsulanDitolak');

	$routes->post('getUsulanId', 'UsulanTapdCtrl::getUsulanId');
	$routes->post('editStsUsulan', 'UsulanSkpdCtrl::editStsUsulan');

	// Verifikasi TAPD
	$routes->post('tambahHasilVerif', 'UsulanTapdCtrl::tambahHasilVerif');
	$routes->post('detailHasilVerif', 'UsulanTapdCtrl::detailHasilVerif');
	$routes->post('verifUlang', 'UsulanTapdCtrl::verifUlang');
	$routes->post('tambahRekomendasi', 'UsulanTapdCtrl::tambahRekomendasi');
	$routes->post('getRekomendasiUsulanId', 'UsulanTapdCtrl::getRekomendasiUsulanId');
	$routes->post('usulanSelesai', 'UsulanTapdCtrl::usulanSelesai');
	$routes->post('detailHasilRekom', 'UsulanTapdCtrl::detailHasilRekomendasi');

	// sub Kegiatan
	$routes->get('subKeg/(:alphanum)', 'UsulanSubKegCtrl::tapdSubKeg/$1');
	$routes->get('getSubKeg/(:alphanum)/(:alphanum)', 'UsulanSubKegCtrl::tapdGetSubKeg/$1/$2');
	// $routes->post('getSubKegId', 'UsulanSubKegCtrl::getSubKegId');
	// Rinci
	$routes->get('rinci/(:alphanum)/(:alphanum)', 'UsulanRinciCtrl::tapdRinci/$1/$2');
	$routes->get('getPaguRinci/(:alphanum)/(:alphanum)', 'UsulanRinciCtrl::getPaguRinci/$1/$2');
	$routes->get('getRincian/(:alphanum)/(:alphanum)', 'UsulanRinciCtrl::tapdGetRinci/$1/$2');
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
