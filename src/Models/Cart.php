<?php

namespace XuongOop\Salessa\Models;

use XuongOop\Salessa\Commons\Model;

class Cart  extends Model
{
    protected string $tableName = 'carts';

    public function findByIDUser($id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('user_id= ? ')
            ->setParameter(0, $id) // xuất hiện 1 lần nên truyền số không vào 
            // doctrine sẽ đếm từ 0
            ->fetchAssociative();
    }
    public function totalProduct($carts){
        $totalProduct = 0;
        if(!empty($carts)){
            foreach ($carts as $cart) {
                $totalProduct += $cart['quantity']*(!empty($cart['price_sale'])?$cart['price_sale']:$cart['price_regular']);
            }
        }
        return $totalProduct;
    }
}