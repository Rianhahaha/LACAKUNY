<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::login');
$routes->get('/KRO', 'Simproka1::KRO');
$routes->get('/RO', 'Simproka1::RO');
$routes->get('/simproka1Edit', 'Simproka1::edit');
$routes->get('/beranda', 'Pages::index');
$routes->get('/simproka1/(:num)', 'Simproka1::index');
$routes->get('/simproka', 'Simproka::index');
$routes->get('/simprokaEdit', 'Simproka::edit');
$routes->get('/simprokaDetail', 'Simproka::cobain');
$routes->get('/simprokaDetailPage', 'Simproka::detailPage');
$routes->get('/satker', 'Satker::index');
$routes->get('/pohonKinerja', 'Pages::pohonKinerja');
$routes->get('/satker/edit', 'Satker::edit');
$routes->get('/kinerja', 'Kinerja::index');
$routes->get('/kinerja/prosesExcel', 'Kinerja::prosesExcel');
$routes->get('/kinerja/tabelKinerja', 'Kinerja::tabelKinerja');
$routes->get('/kinerja/aksesData', 'Kinerja::aksesData');
$routes->get('/kinerja/upload', 'Kinerja::upload');
$routes->get('/kinerja/edit', 'Kinerja::edit');
$routes->get('/KinerjaOLD', 'KinerjaOLD::index');
$routes->get('/dev', 'Kinerja1::index');
$routes->get('/mod', 'Kinerja1::mod');
$routes->get('/foto', 'Kinerja::foto');
$routes->get('/backup', 'Kinerja2::index');
$routes->get('/backup/prosesExcel', 'Kinerja2::prosesExcel');
$routes->get('/backup/upload', 'Kinerja2::upload');
$routes->get('/backup/edit', 'Kinerja2::edit');
$routes->get('/pengguna', 'Pages::pengguna');
$routes->get('/general', 'Simproka1::generalRedirect');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
