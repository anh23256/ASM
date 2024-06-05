<?php
use XuongOop\Salessa\Controllers\Client\HomeController;
use XuongOop\Salessa\Controllers\Client\ProductController;



$router->get('/', HomeController::class . '@index');
$router->get('/products', ProductController::class . '@index');
