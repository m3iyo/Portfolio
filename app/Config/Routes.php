<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['GET', 'POST'], 'admin', 'Admin::login');
$routes->get('admin/logout', 'Admin::logout');
$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/table/(:segment)', 'Admin::table/$1');
$routes->post('admin/table/(:segment)/create', 'Admin::create/$1');
$routes->post('admin/table/(:segment)/update', 'Admin::update/$1');
$routes->post('admin/table/(:segment)/delete', 'Admin::delete/$1');