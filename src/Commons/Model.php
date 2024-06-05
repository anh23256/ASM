<?php

namespace XuongOop\Salessa\Commons;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

class Model
{
    protected Connection|null $conn;
    protected QueryBuilder $queryBuilder;
    protected string $tableName;

    public function __construct()
    {
        $connectionParams = [
            'dbname'    => $_ENV['DB_NAME'],
            'user'      => $_ENV['DB_USERNAME'],
            'password'  => $_ENV['DB_PASSWORD'],
            'host'      => $_ENV['DB_HOST'],
            'port'      => $_ENV['DB_PORT'],
            'driver'    => $_ENV['DB_DRIVER'],
        ];

        $this->conn = DriverManager::getConnection($connectionParams);

        $this->queryBuilder = $this->conn->createQueryBuilder();
    }

    public function all()
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->orderBy('id', 'desc')
            ->fetchAllAssociative();
    }

    public function count() // đếm số lượng bản ghi
    {
        return $this->queryBuilder
            ->select("COUNT(*) as $this->tableName")
            ->from($this->tableName)
            ->fetchOne();
    }

    public function paginate($page = 1, $perPage = 5)
    {
        $queryBuilder = clone($this->queryBuilder);

        $totalPage = ceil($this->count() / $perPage);
        $offSet = $perPage * ($page - 1);

        // perPage số lượng bản ghi muốn lấy ra
        // với page = 1
        // 1 -> 0 () đếm theo vị trí index
        // 2
        // 3
        // 4 
        // 5 -> 4 ( offSet = 4 )

        // với page = 2
        // 6 -> 5 ()
        // 7
        // 8
        // 9 
        // 10 -> 9 ( offSet =  9)

        $data = $queryBuilder
            ->select("*")
            ->from($this->tableName)
            ->setFirstResult($offSet) // truyền vào vị trí index dự định lấy
            ->setMaxResults($perPage)
            // truyền vào sô lượng bản ghi cần lấy
            ->orderBy('id', 'desc')
            ->fetchAllAssociative();
        return [$data, $totalPage];
    }
    public function findByID($id)
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('id= ? ')
            ->setParameter(0, $id) // xuất hiện 1 lần nên truyền số không vào 
            // doctrine sẽ đếm từ 0
            ->fetchAssociative();
    }

    public function insert(array $data)
    {
        // kiểm tra xem có dữ liệu hay không ?
        if (!empty($data)) {
            $query = $this->queryBuilder->insert($this->tableName);

            // $query->setValue('name', '?')->setParameter(0, $data['name']);
            // $query->setValue('email', '?')->setParameter(1, $data['email']);
            // $query->setValue('address', '?')->setParameter(2, $data['address']);


            $index = 0;
            foreach ($data as $key => $value) {
                //$key ở đây là tên trường dữ liệu trong database
                $query->setValue($key, '?')->setParameter($index, $value);
                ++$index;
            }

            $query->executeQuery();
            return true;
        }

        return false;
    }

    public function update($id, array $data)
    {
        // kiểm tra xem có dữ liệu hay không ?
        if (!empty($data)) {
            $query = $this->queryBuilder->update($this->tableName);

            // $query->setValue('name', '?')->setParameter(0, $data['name']);
            // $query->setValue('email', '?')->setParameter(1, $data['email']);
            // $query->setValue('address', '?')->setParameter(2, $data['address']);


            $index = 0;
            foreach ($data as $key => $value) {
                //$key ở đây là tên trường dữ liệu trong database
                $query->set($key, '?')->setParameter($index, $value);
                ++$index;
            }

            $query->where('id = ?')
            ->setParameter(count($data), $id) // đếm số lượng trường dữ liệu truyền vào 
            // $data = [
            //     'name' => 'Ahihi',
            //     'email' => 'keke@gnai.com',
            //     'address' => 'HN'
            // ];
            ->executeQuery();
            return true;
        }

        return false;
    }

    public function delete($id){
        return $this->queryBuilder
        ->delete($this->tableName)
        ->where('id = ?')
        ->setParameter(0, $id)
        ->executeQuery();
    }

    public function __destruct()
    {
        $this->conn = null;
    }
}
