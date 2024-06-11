<?php

namespace XuongOop\Salessa\Models;

use XuongOop\Salessa\Commons\Model;

class OrderDetail extends Model{
    protected string $tableName = 'order_details';

    public function getDetailByOrder($id){
        return $this->queryBuilder
        ->select('*')
        ->from($this->tableName)
        ->where('order_id = ? ')
        ->setParameter(0, $id) 
        ->fetchAllAssociative();
    }
}