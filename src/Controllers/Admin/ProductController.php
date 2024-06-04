<?php

namespace XuongOop\Salessa\Controllers\Admin;


use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Category;
use XuongOop\Salessa\Models\Product;
use Rakit\Validation\Validator;

class ProductController extends Controller
{
    // khởi tạo thuộc tính
    private Product $product;
    private Category $category;

    // khởi tạo contruct

    public function __construct()
    {
        $this->product = new Product();
        $this->category = new Category();
    }

    public function index()
    {
        // $products = $this->product->all();
        [$products, $totalPage] = $this->product->paginate();
        //truyền tên thư mục sau đó truyền tên file, sau đó dùng dấu chấm để chia tầng
        $this->renderViewAdmin('products.index', [
            'products' => $products,
            'totalPage' => $totalPage
        ]);
    }

    public function create()
    {
        // lấy toàn bộ bản ghi trong bản categorys
        $categorys = $this->category->all();
        // Helper::debug($categorys);
        // arrary_colum gán lấy trường id làm key trong mảng
        // chuyển từ mảng 2 chiều sang mảng 1 chiều
        $categoryColum = array_column($categorys, 'name', 'id');

        $this->renderViewAdmin('products.create', [
            'categoryColum' => $categoryColum
        ]);
    }

    public function store(){
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'category_id'   => 'required',
            'name'          => 'required',
            'overview'      => 'max:500', // giới hạn 500 từ
            'content'       => 'max:65000',
            'img_thumbnail' => 'uploaded_file:0,2M,png,jpg,jpeg', 
        ]);

        $validation->validate();

        // nếu  lỗi
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            // chuyển về trang tạo mới
            header('Location: ' . url('admin/products/create'));
            exit;

        }
    }
}
