<?php

namespace XuongOop\Salessa\Models;

use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Commons\Model;

class Order extends Model
{
    protected string $tableName = 'orders';

    public function getAllOrderByUserId($userId, $page = 1, $perPage = 5)
    {
        $queryBuilder = clone ($this->queryBuilder);
        $offSet = $perPage * ($page - 1);
        $data = $queryBuilder
            ->select("*")
            ->from($this->tableName)
            ->where('user_id = ?')
            ->setFirstResult($offSet) // truyền vào vị trí index dự định lấy
            ->setMaxResults($perPage)
            // truyền vào sô lượng bản ghi cần lấy
            ->orderBy('id', 'desc')
            ->setParameter(0, $userId)
            ->fetchAllAssociative();
        $data1 = empty($data) ? [1] : $data;
        $totalPage = ceil(count($data1) / $perPage);
        return [$data, $totalPage];
    }

    public function paginateHistoryOrder($orderId, $userId, $page = 1, $perPage = 5)
    {
        $queryBuilder = clone ($this->queryBuilder);

        $offSet = $perPage * ($page - 1);

        $data = $queryBuilder
            ->select("*,a.id as a_id,b.id as b_id")
            ->from($this->tableName, 'a')
            ->innerJoin('a', 'order_details', 'b', 'a.id = b.order_id')
            ->where('a.user_id = ?')
            ->andWhere('b.order_id = ?')
            ->setFirstResult($offSet) // truyền vào vị trí index dự định lấy
            ->setMaxResults($perPage)
            // truyền vào sô lượng bản ghi cần lấy
            ->orderBy('b.id', 'desc')
            ->setParameter(0, $userId)
            ->setParameter(1, $orderId)
            ->fetchAllAssociative();
        // $sql = $data->getSQL();
        // Helper::debug($sql);
        $data1 = empty($data) ? [1] : $data;
        $totalPage = ceil(count($data1) / $perPage); 
        return [$data, $totalPage];
    }

    public function getAllOrderOderdetail(){
        return $this->queryBuilder
        ->select("b.namesp ,SUM(`price`*`quantity`) as totalOrders")
        ->from($this->tableName, 'a')
        // ->where('status_payment = 1')
        // ->andWhere('status_delivery = 3')
        ->innerJoin('a', 'order_details', 'b', 'a.id = b.order_id')
        ->groupBy('b.namesp')
        ->orderBy('totalOrders', 'desc')
        ->fetchAllAssociative();
    }

    public function getOrderByStatus($status,$page = 1, $perPage = 5)
    {
        $queryBuilder = clone($this->queryBuilder);
        $offSet = $perPage * ($page - 1);
        $data = $queryBuilder
            ->select("*")
            ->from($this->tableName)
            ->where('status_delivery = ?')
            ->setFirstResult($offSet) // truyền vào vị trí index dự định lấy
            ->setMaxResults($perPage)
            // truyền vào sô lượng bản ghi cần lấy
            ->orderBy('id', 'desc')
            ->setParameter(0, $status)
            ->fetchAllAssociative();

        // $sql = $queryBuilder->getSQL();
        // Helper::debug($sql);
        $data1 = empty($data)?[1]:$data;
        $totalPage = ceil(count($data1) / $perPage);
        return [$data, $totalPage];
    }
}
