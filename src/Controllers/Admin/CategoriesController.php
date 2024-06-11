<?php

namespace XuongOop\Salessa\Controllers\Admin;

use XuongOop\Salessa\Commons\Controller;
use Rakit\Validation\Validator;
use XuongOop\Salessa\Models\Category;
use XuongOop\Salessa\Models\Product;

class CategoriesController extends Controller
{
    private Category $categories;
    private Product $product;
    public function __construct()
    {
        $this->categories = new Category();
        $this->product = new Product();
    }

    public function index()
    {
        [$categorys, $totalPage] = $this->categories->paginate($_GET['page'] ?? 1);
        $this->renderViewAdmin('categories.index', [
            'categorys' => $categorys,
            'totalPage' => $totalPage
        ]);
    }

    public function create()
    {
        $this->renderViewAdmin('categories.create');
    }

    public function store()
    {
        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:100',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('admin/categories/create'));
            exit;
        } else {
            $data = [
                'name'     => $_POST['name'],
            ];

            $this->categories->insert($data);

            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url('admin/categories'));
            exit;
        }
    }

    public function show($id)
    {
        $categorys = $this->categories->findByID($id);

        $this->renderViewAdmin('categories.show', [
            'categorys' => $categorys
        ]);
    }

    public function edit($id)
    {
        $categorys = $this->categories->findByID($id);

        $this->renderViewAdmin('categories.edit', [
            'categorys' => $categorys
        ]);
    }

    public function update($id)
    {
        $categories = $this->categories->findByID($id);

        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:100',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url("admin/categories/{$categories['id']}/edit"));
            exit;
        } else {
            $data = [
                'name'     => $_POST['name'],
            ];

            $this->categories->update($id, $data);
            $_SESSION['status'] = true;
            $_SESSION['msg'] = 'Thao tác thành công';

            header('Location: ' . url("admin/categories/{$categories['id']}/edit"));
            exit;
        }
    }

    public function delete($id)
    {
        $categorys = $this->categories->findByID($id);
        $this->product->updateCategoryProduct($id);
        $this->categories->delete($id);
        header('Location: ' . url('admin/categories'));
        exit();
    }
}
