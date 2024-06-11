<?php

use XuongOop\Salessa\Controllers\Admin\CategoriesController;
use XuongOop\Salessa\Controllers\Admin\DashboardController;
use XuongOop\Salessa\Controllers\Admin\OrderController;
use XuongOop\Salessa\Controllers\Admin\ProductController;
use XuongOop\Salessa\Controllers\Admin\UserController;
use XuongOop\Salessa\Controllers\Client\LoginController;

$router->before('GET|POST', 'admin*.*', function(){
    if(!isset($_SESSION['users']) | $_SESSION['users']['type'] != 'admin'){
        header('Location:'.url(''));
        exit;
    }
});
$router->mount('/admin', function () use ($router) {

    $router->get('/', DashboardController::class . '@dashboard');

    $router->mount('/users', function () use ($router) {
        $router->get('/',               UserController::class . '@index');
        $router->get('/create',         UserController::class . '@create');
        $router->post('/store',         UserController::class . '@store');
        $router->get('/{id}/show',      UserController::class . '@show');
        $router->get('/{id}/edit',      UserController::class . '@edit');
        $router->post('/{id}/update',   UserController::class . '@update');
        $router->get('/{id}/delete',    UserController::class . '@delete');
    });
    $router->mount('/categories', function () use ($router) {
        $router->get('/',               CategoriesController::class . '@index');
        $router->get('/create',         CategoriesController::class . '@create');
        $router->post('/store',         CategoriesController::class . '@store');
        $router->get('/{id}/show',      CategoriesController::class . '@show');
        $router->get('/{id}/edit',      CategoriesController::class . '@edit');
        $router->post('/{id}/update',   CategoriesController::class . '@update');
        $router->get('/{id}/delete',    CategoriesController::class . '@delete');
    });
    $router->mount('/products', function () use ($router) {

        $router->get('/',             ProductController::class . '@index');

        $router->get('/create',       ProductController::class . '@create'); // Show form thêm mới

        $router->post('/store',        ProductController::class . '@store'); // Lưu mới vào DB

        $router->get('/{id}/show',    ProductController::class . '@show');

        $router->get('/{id}/edit',    ProductController::class . '@edit');

        $router->post('/{id}/update',  ProductController::class . '@update');

        $router->get('/{id}/delete',  ProductController::class . '@delete');
    });
    $router->get('/order',               OrderController::class . '@historyOrder');
    $router->get('/orderdetail',               OrderController::class . '@historyOrderDetail');
    $router->get('/cancelorder',               OrderController::class . '@cancelOrder');
    $router->get('/orderUpdate',               OrderController::class . '@updateOrderStatus');
    $router->get('/logout', LoginController::class. '@logout');
});
