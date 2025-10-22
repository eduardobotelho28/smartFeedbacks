<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('authentication/login', 'Authentication::login_view');
$routes->get('authentication/register', 'Authentication::register_view');
$routes->post('authentication/register', 'Authentication::register');
$routes->post('authentication/login', 'Authentication::login');
$routes->get('authentication/logout', 'Authentication::logout'); 

$routes->get('forms', 'Forms::userForms', ['filter' => 'auth']);
$routes->get('forms/create', 'Forms::createFormView', ['filter' => 'auth']);
$routes->post('forms/create', 'Forms::create', ['filter' => 'auth']);
$routes->get('forms/delete/(:segment)', 'Forms::delete/$1', ['filter' => 'auth']);
$routes->get('forms/reply/(:segment)',  'Forms::reply_view/$1');
$routes->post('forms/reply/(:segment)', 'Forms::reply/$1');

$routes->get('feedbacks', 'Feedbacks::myFeedbacks', ['filter' => 'auth']);
$routes->get('/feedbacks/view/(:hash)', 'Feedbacks::view/$1', ['filter' => 'auth']);
$routes->get('feedbacks/delete/(:segment)', 'Feedbacks::delete/$1', ['filter' => 'auth']);

$routes->get('user/profile', 'User::profile', ['filter' => 'auth']);
$routes->post('user/updateProfile', 'User::updateProfile', ['filter' => 'auth']);

$routes->get('forms/thank-you', 'Forms::thankYou');

$routes->get('metricsGuide', 'MetricsGuide::guideView');

$routes->get('summary' , 'Summary::userSummary', ['filter' => 'auth']);
