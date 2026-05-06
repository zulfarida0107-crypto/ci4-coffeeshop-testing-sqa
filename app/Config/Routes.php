<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginCoffeeShopController::index');

// --- RUTE LOGIN (JANGAN DIKUNCI) ---
// Login tidak boleh dikunci agar user bisa masuk ke sistem
$routes->get('login', 'LoginCoffeeShopController::index');
$routes->post('login/auth', 'LoginCoffeeShopController::auth');
$routes->get('logout', 'LoginCoffeeShopController::logout');

// --- GRUP KEAMANAN (SEMUA PERLU LOGIN) ---
// Semua rute di dalam grup ini akan dicek oleh Auth.php
$routes->group('', ['filter' => 'auth'], function($routes) {

    // --- GRUP MENU PRODUK (MENU KOPI) ---
    $routes->group('menu-produk', function($routes) {
        $routes->get('/', 'MenuProdukController::index');
        $routes->get('add', 'MenuProdukController::add');
        $routes->post('store', 'MenuProdukController::store');
        $routes->get('show/(:num)', 'MenuProdukController::show/$1');
        $routes->get('edit/(:num)', 'MenuProdukController::edit/$1');
        $routes->post('update/(:num)', 'MenuProdukController::update/$1');
        $routes->get('destroy/(:num)', 'MenuProdukController::destroy/$1');
    });

    // --- GRUP DETAIL PESANAN (KUE) ---
    $routes->group('desain-pesanan', function($routes) {
        $routes->get('/', 'DesainPesananController::index');
        $routes->get('add', 'DesainPesananController::add');
        $routes->post('store', 'DesainPesananController::store');
        $routes->get('show/(:num)', 'DesainPesananController::show/$1');
        $routes->get('edit/(:num)', 'DesainPesananController::edit/$1');
        $routes->post('update/(:num)', 'DesainPesananController::update/$1');
        $routes->get('destroy/(:num)', 'DesainPesananController::destroy/$1');
    });

    // --- GRUP PESANAN ---
    $routes->group('pesanan', function($routes) {
        $routes->get('/', 'PesananController::index');
        $routes->get('add', 'PesananController::add');
        $routes->post('store', 'PesananController::store');
        $routes->get('show/(:num)', 'PesananController::show/$1');
        $routes->get('edit/(:num)', 'PesananController::edit/$1');
        $routes->post('update/(:num)', 'PesananController::update/$1');
        $routes->get('destroy/(:num)', 'PesananController::destroy/$1');
    });

    // --- GRUP USER ---
    $routes->group('user', function($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('add', 'UserController::add');
        $routes->post('store', 'UserController::store');
        $routes->get('edit/(:num)', 'UserController::edit/$1');
        $routes->post('update/(:num)', 'UserController::update/$1');
        $routes->get('destroy/(:num)', 'UserController::destroy/$1');
    });

    // --- GRUP PESAN MASUK (KONTAK) ---
    $routes->group('pesan-kontak', function($routes) {
        $routes->get('/', 'PesanKontakController::index');
        $routes->get('show/(:num)', 'PesanKontakController::show/$1');
        $routes->get('destroy/(:num)', 'PesanKontakController::destroy/$1');
        $routes->get('add', 'PesanKontakController::add');
        $routes->post('store', 'PesanKontakController::store');
    });

});