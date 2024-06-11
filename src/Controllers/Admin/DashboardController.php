<?php

namespace XuongOop\Salessa\Controllers\Admin;

use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Category;
use XuongOop\Salessa\Models\Order;
use XuongOop\Salessa\Models\OrderDetail;
use XuongOop\Salessa\Models\Product;

class DashboardController extends Controller
{
    private Order $Order;
    private Product $product;
    private Category $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
        $this->Order = new Order();
    }

    public function dashboard()
    {
        $categorys = $this->category->all();
        $countProductsbyCategories = [];
        foreach ($categorys as $categorie) {
            $countProductsbyCategories[] = $this->product->countProductsByCategory($categorie['id'], $categorie['name']);
        }
        $analysisProduct = array_map(function ($item) {
            return [
                $item['0'],
                $item['1'],
            ];
        }, $countProductsbyCategories);

        array_unshift($analysisProduct, ['Tên sản phẩm', 'Số sản phẩm']);
        $ProductByOrder = $this->Order->getAllOrderOderdetail();
        // Helper::debug($ProductByOrder);
        $labels = [];
        $data = [];
        foreach ($ProductByOrder as $item) {
            $labels[] = $item['namesp'];
            $data[] = $item['totalOrders'];
        }
        
        $this->renderViewAdmin(__FUNCTION__, [
            'analysisProduct' => $analysisProduct,
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
