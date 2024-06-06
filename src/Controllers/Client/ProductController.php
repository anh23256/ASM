<?php

namespace XuongOop\Salessa\Controllers\Client;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Product;

class ProductController extends Controller
{
    public function products() {
        $product = new Product();
        $page = $_GET['page'] ?? 1;
        if($page<=0){
            header('Location:'.url('products'));
            exit;
        }
        [$products,$totalPage] = $product->paginate($page, 8);
        // Helper::debug($products);
        $this->renderViewClient('products.listProducts', [
            'products' => $products,
            'totalPage' => $totalPage,
            'page' => $page
        ]);
    }
}