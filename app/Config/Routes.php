<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Anasayfa::index');
$routes->match(['get', 'post'],'login', 'Anasayfa::login');
$routes->get('logout', 'Anasayfa::logout');
$routes->get('/contact', 'Anasayfa::contact');

$routes->get('/hash-sifre', 'HashSifre::index');



$routes->get('/', 'Olympians::index');
$routes->match(['get', 'post'],'/olympians', 'Olympians::olympians');

$routes->get('/', 'Comments::index');
$routes->match(['get', 'post'],'/comments', 'Comments::comments');

$routes->get('/', 'Titans::index');
$routes->match(['get', 'post'],'/titans', 'Titans::titans');

$routes->get('panel', 'Panel::index');
$routes->match(['get', 'post'],'kayit_ekle', 'Panel::kayit_ekle');
$routes->get('kayit_listele', 'Panel::kayit_listele');
$routes->post('kayit_sil', 'Panel::kayit_sil');
$routes->match(['get', 'post'], 'kayit_duzenle/(:num)/(:any)', 'Panel::kayit_duzenle/$1/$2');


$routes->get('mongo/(:num)', 'Home::test/$1');











$routes->match(['get', 'post'], 'contact/submit', 'Contact::submit');
