<?php

namespace XuongOop\Salessa\Controllers\Client;

use Exception;
use Throwable;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Product;

class ProductDetailController extends Controller
{
    public function productDetail($id) {
        $product = new Product();
        $productDetail = $product->findByID($id);
        try {
            if(empty($productDetail)){
                throw new Exception('Sản phẩm không tồn tại');
            }else{
                $productTogetherCatagorys = $product->productsTogetherCategory($productDetail['id'],$productDetail['category_id']);
                $this->renderViewClient('products.product-deital',[
                    'productDetail'           => $productDetail,
                    'productTogetherCatagorys' => $productTogetherCatagorys
                ]);
            }
        } catch (\Throwable $th) {
            Helper::debug($th);
        }
    }
}