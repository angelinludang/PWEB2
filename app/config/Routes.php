<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================
// 🔰 DEFAULT ROUTE
// ==========================
$routes->get('/', 'Home::index');

// ==========================
// 🔐 AUTHENTICATION ROUTES
// ==========================
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');

    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');

    $routes->get('logout', 'Auth::logout');
});

// ==========================
// 🏠 USER HOME / DASHBOARD
// ==========================
$routes->get('home', 'Home::dashboard', ['filter' => 'auth']);

// ==========================
// 📚 MATERI ROUTES
// ==========================
$routes->group('materi', ['filter' => 'auth'], function ($routes) {
    $routes->get('upload', 'Materi::upload');
    $routes->post('save', 'Materi::save');
});

$routes->get('materi/detail/(:num)', 'Materi::detail/$1');

// ==========================
// 💬 KOMENTAR ROUTES
// ==========================
$routes->group('komentar', ['filter' => 'auth'], function ($routes) {
    $routes->post('add', 'Komentar::kirimKomentar');
    $routes->get('edit/(:num)', 'Komentar::edit/$1');
    $routes->post('update/(:num)', 'Komentar::update/$1');
    $routes->post('delete/(:num)', 'Komentar::delete/$1');
});

// ==========================
// 🧑‍💼 USER PROFILE ROUTES
// ==========================
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('profil', 'User::profil');
    $routes->post('profil/upload_foto', 'User::upload_foto');
});

// ==========================
// 🛠️ ADMIN ROUTES
// ==========================
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('materi', 'Admin::materi');
    $routes->get('approve/(:num)', 'Admin::approve/$1');
    $routes->get('delete/(:num)', 'Admin::delete/$1');
});
