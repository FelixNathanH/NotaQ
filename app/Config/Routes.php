<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Home
$routes->get('/', 'Home::index');


//testing
$routes->get('/test', 'Home::test');
$routes->get('/testing', 'Home::testing');

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
$routes->get('/staff/login', 'staff::login');
$routes->post('/staff/auth', 'staff::auth');

//invoice
$routes->get('/invoice', 'invoice::index');
$routes->get('/invoiceList', 'invoice::invoiceList');
$routes->post('/invoicedtb', 'invoice::invoiceDtb');
$routes->post('/invoice/check-stock', 'invoice::checkStock');
$routes->post('/invoice/submit', 'invoice::submitInvoice');
$routes->get('invoice/details/(:segment)', 'invoice::getInvoiceDetails/$1');


//product
$routes->get('/product', 'product::index');
$routes->post('/product/get', 'product::get');
$routes->post('/productdtb', 'product::productDtb');
$routes->post('/product/add', 'product::addProduct');
$routes->post('/product/edit', 'product::editProduct');
$routes->post('/product/delete', 'product::deleteProduct');

//debt
$routes->get('/debt', 'debt::index');
$routes->post('/debtdtb', 'debt::debtDtb');
$routes->post('/debt/submit', 'debt::submit');
$routes->post('/debt/updateReminderFrequency', 'debt::updateReminderFrequency');
$routes->post('/debt/delete', 'debt::deleteDebt');
$routes->post('/debt/getReminderFrequency', 'debt::getReminderFrequency');
$routes->post('/debt/sendReminder', 'debt::sendReminder');
$routes->post('/debt/triggerAutoReminder', 'debt::triggerAutoReminder');
$routes->post('/debt/getDebtAmount', 'debt::getDebtAmount');
$routes->post('/debt/submitPartialPayment', 'debt::submitPartialPayment');
$routes->post('/debt/markDebtAsPaid', 'debt::markDebtAsPaid');
