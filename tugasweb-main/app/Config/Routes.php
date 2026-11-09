<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// --- Route untuk Akun 1 (Manual) ---
$routes->get('/akun1', 'Akun1::index');
$routes->get('/akun1/new', 'Akun1::new');
$routes->post('/akun1', 'Akun1::store');
$routes->put('/akun1/edit/(:any)', 'Akun1::update/$1');
$routes->get('/akun1/edit/(:num)', 'Akun1::edit/$1');
$routes->delete('/akun1/(:any)', 'Akun1::destroy/$1');

// --- Route untuk Akun 2 & Akun 3 (Otomatis/Resource) ---
// Dua baris ini sudah mencakup semua proses (index, new, create, edit, update, delete)

$routes->get('/transaksi', 'Transaksi::index');

$routes->resource('akun2');
$routes->resource('akun3');
$routes->resource('transaksi');