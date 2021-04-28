<?php
require 'core/bootstrap.php';

$routes = [
	'/' => 'OrdersController@showall',
	'/allorders' => 'OrdersController@showall',
	'/activeorders' => 'OrdersController@showactive',
	'/createorder' => 'OrdersController@create',
	'/editorder' => 'OrdersController@edit'
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');