<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::home');
$routes->get('/login', 'Home::login');
$routes->post('/auth/valid_login', 'Auth::valid_login');
$routes->get('/daftar', 'Home::daftar');
$routes->post('/auth/valid_register', 'Auth::valid_register');
$routes->get('/auth/activate/(:any)', 'Auth::activate/$1');
$routes->get('/logout', 'Auth::logout');
$routes->get('/lupapw', 'Home::lupapw');
$routes->post('/auth/newpw', 'Auth::newpw');
$routes->post('/auth/lupapw', 'Auth::lupapw');
$routes->get('/auth/reset/(:any)', 'Auth::reset/$1/$2');

$routes->get('/home', 'User::home');
$routes->get('/create', 'User::create');
$routes->post('/create/save', 'User::createsave');
$routes->get('/foto/(:num)', 'User::foto/$1');
$routes->post('/foto/like/(:num)', 'User::like/$1');
$routes->post('/foto/unlike/(:num)', 'User::unlike/$1');
$routes->post('/foto/delete/(:num)', 'User::delete/$1');
$routes->post('/foto/edit/(:num)', 'User::edit/$1');
$routes->post('/komentar/save/(:num)', 'User::komentarsave/$1');
$routes->post('/foto/update/(:num)', 'User::updatefoto/$1');
$routes->post('/komentar/delete/(:num)', 'User::komentardelete/$1');
$routes->get('/profile/(:num)', 'User::profile/$1');
$routes->get('/profile-like/(:num)', 'User::profilelike/$1');
$routes->get('/profile-post/(:num)', 'User::profilepost/$1');
$routes->get('/editprofile/(:num)', 'User::editprofile/$1');
$routes->post('/profile/save/(:num)', 'User::updateprofile/$1');
$routes->post('/album/create', 'User::albumsave');
$routes->get('/album/(:num)', 'User::album/$1');
$routes->post('/album/saveto/(:num)', 'User::savetoalbum/$1');
$routes->post('/album/delfrom/(:num)', 'User::deletealbum/$1');
$routes->post('/foto/download/(:num)', 'User::downloadfoto/$1');
$routes->post('/search', 'User::search');