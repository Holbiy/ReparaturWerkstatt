<?php
require 'core/bootstrap.php';

$routes = [
	'/' => 'OrdersController@showall',
	'/allorders' => 'OrdersController@showall',
	'/activeorders' => 'OrdersController@showactive',
	'/create' => 'OrdersController@create',
	'/createorder' => 'OrdersController@createorder',
	'/editorder' => 'OrdersController@edit'
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');