<?php

use XuongOop\Salessa\Controllers\Admin\DashboardController;
use XuongOop\Salessa\Controllers\Admin\ProductController;

$router->mount('/admin', function () use ($router) {
    
    $router->get('/', DashboardController::class . '@dashboard');

    $router->mount('/products', function () use ($router) {

        $router->get('/',             ProductController::class . '@index');

        $router->get('/create',       ProductController::class . '@create'); // Show form thêm mới

        $router->post('/store',        ProductController::class . '@store'); // Lưu mới vào DB

        $router->get('/{id}/show',    ProductController::class . '@show');

        $router->get('/{id}/edit',    ProductController::class . '@edit');

        $router->post('/{id}/update',  ProductController::class . '@update');

        $router->get('/{id}/delete',  ProductController::class . '@delete');

    });
});
