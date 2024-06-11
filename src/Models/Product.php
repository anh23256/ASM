<?php

namespace XuongOop\Salessa\Models;

use XuongOop\Salessa\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';
    //sản phẩm liên quan
    public function productsTogetherCategory($id, $category_id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('category_id = ? ')
            ->andWhere('id <> ?')
            ->setParameter(0, $category_id) // xuất hiện 1 lần nên truyền số không vào 
            ->setParameter(1, $id)
            // doctrine sẽ đếm từ 0
            ->fetchAllAssociative();
    }
    public function countProductsByCategory($category_id, $categorie_name)
    {
        $data =  $this->queryBuilder
            ->select('COUNT(*) as sosp')
            ->from($this->tableName)
            ->where('category_id = ? ')
            ->setParameter(0, $category_id) // xuất hiện 1 lần nên truyền số không vào 
            // doctrine sẽ đếm từ 0
            ->fetchAllAssociative();
        return [$categorie_name, $data[0]['sosp']];
    }
    public function updateCategoryProduct($category_id)
    {
        $this->queryBuilder->update($this->tableName)
            ->set('category_id', '?')
            ->where('category_id  = ?')
            ->setParameter(0, null)
            ->setParameter(1, $category_id)
            ->executeQuery();
    }
}
