<?php

use XuongOop\Salessa\Controllers\Client\CartController;
use XuongOop\Salessa\Controllers\Client\Comfirm;
use XuongOop\Salessa\Controllers\Client\LoginController;
use XuongOop\Salessa\Controllers\Client\HomeController;
use XuongOop\Salessa\Controllers\Client\OrderController;
use XuongOop\Salessa\Controllers\Client\ProductController;
use XuongOop\Salessa\Controllers\Client\ProductDetailController;

$router->get('', HomeController::class . '@index');
$router->get('products', ProductController::class . '@products');
$router->get('products-detail/{$id}', ProductDetailController::class . '@productDetail');


$router->get( 'login&singin',             LoginController::class    . '@showFormLogin');
$router->post( 'handle-login',     LoginController::class    . '@login');
$router->post( 'singin',     LoginController::class    . '@singin');
$router->get( 'logout',            LoginController::class    . '@logout');


$router->post('cart',          CartController::class    .'@cart');
$router->get('cartDetail',          CartController::class    .'@cartDetail');
$router->get('cart/quantity',   CartController::class . '@quantity');
$router->get('cartDelete',   CartController::class . '@cartDelete');

$router->get('order',   OrderController::class . '@order');
$router->post('orderDetail',   OrderController::class . '@orderDetail');
$router->get('historyOrder',   OrderController::class . '@historyOrder');
$router->get('historyDetail',   OrderController::class . '@historyOrderDetail');
$router->get('cancelOrder',   OrderController::class . '@cancelOrder');

$router->get('comfirm',   Comfirm::class . '@comfirm');

