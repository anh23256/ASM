<?php


use XuongOop\Salessa\Controllers\Client\HomeController;
use XuongOop\Salessa\Controllers\Client\ProductController;
use XuongOop\Salessa\Controllers\Client\ProductDetailController;
use XuongOop\Salessa\Controllers\Client\ErrorController;

$router->get('', HomeController::class . '@index');
$router->get('products', ProductController::class . '@products');
$router->get('products-detail/{$id}', ProductDetailController::class . '@productDetail');