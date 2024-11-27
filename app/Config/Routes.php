<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('home', 'Home::home');
$routes->get('booking', 'Home::booking');
$routes->get('contact', 'Home::contact');
$routes->post('create', 'Home::create');
