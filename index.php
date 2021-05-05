<?php
require 'core/bootstrap.php';

$routes = [
	'/' => 'OrdersController@index',
	'/allorders' => 'OrdersController@index',
	'/activeorders' => 'ActiveOrdersController@index',
	'/create' => 'OrdersController@create',
	'/new' => 'OrdersController@new',
	'/edit' => 'OrdersController@edit',
	'/update' => 'OrdersController@update',
	'/updatestatus' => 'OrdersController@updatestatus'
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');