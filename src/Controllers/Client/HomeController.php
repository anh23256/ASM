<?php

namespace XuongOop\Salessa\Controllers\Client;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Product;

class HomeController extends Controller
{
    public function index() {
        $product = new Product();
        [$products,$totalPage] = $product->paginate(1,8);
        $this->renderViewClient('index', [
            'products' => $products
        ]);
    }
}