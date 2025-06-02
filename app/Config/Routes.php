<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Home
$routes->get('/', 'Home::index');

//testing
$routes->get('/test', 'Home::test');

//myProfile
$routes->get('/myprofile', 'Home::profile');
$routes->post('/updateProfile', 'Home::updateProfile');
$routes->post('/deleteAccount', 'Home::deleteAccount');

//Log-in routing
$routes->get('/login', 'auth::login');
$routes->post('/loginAuth', 'auth::loginAuth');
$routes->get('/logout', 'auth::logout');

//register routing
$routes->get('/register', 'auth::register');
$routes->post('/registerAuth', 'auth::registerAuth');
$routes->get('/verify/(:any)', 'auth::verify/$1');

//forget password routing
$routes->get('/forgetPassword', 'auth::forget'); // to load the view page for the "Forget Password"
$routes->post('/forgetAuth', 'auth::forgetAuth'); //access the data that is being send from the frontend
$routes->get('/resetPassForm/(:any)', 'auth::showResetPasswordForm/$1');
$routes->post('/resetPass', 'auth::resetPassword');

//Staff
$routes->get('/staff', 'staff::index');
$routes->post('/staff/get', 'staff::get');
$routes->post('/staffdtb', 'staff::staffDtb');
$routes->post('/staff/add', 'staff::addStaff');
$routes->post('/staff/edit', 'staff::editStaff');
$routes->post('/staff/delete', 'staff::deleteStaff');

//invoice
$routes->get('/invoice', 'invoice::index');
$routes->post('/invoicedtb', 'invoice::invoiceDtb');
$routes->post('/invoice/check-stock', 'invoice::checkStock');

//product
$routes->get('/product', 'product::index');
$routes->post('/product/get', 'product::get');
$routes->post('/productdtb', 'product::productDtb');
$routes->post('/product/add', 'product::addProduct');
$routes->post('/product/edit', 'product::editProduct');
$routes->post('/product/delete', 'product::deleteProduct');
