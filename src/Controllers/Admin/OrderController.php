<?php

namespace XuongOop\Salessa\Controllers\Admin;

use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Order;
use XuongOop\Salessa\Models\OrderDetail;

class OrderController extends Controller
{
    private Order $order;
    private OrderDetail $orderDetail;
    public function __construct()
    {
        $this->order = new Order();
        $this->orderDetail = new OrderDetail();
    }
    public function historyOrder(){
        $page = $_GET['page'] ?? 1;
        $status = !empty($_GET['status']) ? $_GET['status'] : 0;
        [$historyOrder, $totalPage] = $this->order->getOrderByStatus($status,$page);
        $history = 'status='.$status;

        // Helper::debug($historyOrder);
        $this->renderViewAdmin('orders.orderXacNhan',[
            'historyOrder' => $historyOrder,
            'totalPage'    => $totalPage ?? 1,
            'history' => $history,
            'page'    => $page,
            'status' => $status,
        ]);
    }

    public function historyOrderDetail(){
        $page = $_GET['page'] ?? 1;
        $status = !empty($_GET['status']) ? $_GET['status'] : 0;
        if(!empty($_GET['idOder'])){
            $historyOrder1 = $this->orderDetail->getDetailByOrder($_GET['idOder']);
            $history = 'status='.$status;
        }
        $totalPage = 1;
        $this->renderViewAdmin('orders.orderXacNhan',[
            'historyOrder1' => $historyOrder1,
            'totalPage' => $totalPage,
            'history' => $history,
            'page'    => $page,
            'status' => $status,
        ]);
    }

    public function updateOrderStatus(){
        $status = !empty($_GET['status']) ? $_GET['status'] : 0;
        $history = 'status='.$status;
        $status_delivery = $status+1;
        if(isset($_GET['click']) && $_GET['click'] == 1){
            if(!empty($_GET['idOder'])){
                $idOrder = $_GET['idOder'];
                $this->order->update($idOrder,[
                    'status_delivery' => $status_delivery
                ]);
            }
        }
        header('Location:'.url('admin/order?'.$history));
        exit;
    }
    public function cancelOrder(){
        $status = !empty($_GET['status']) ? $_GET['status'] : 0;
        $history = 'status='.$status;
        if(!empty($_GET['idOder'])){
            $order = $this->order->findByID($_GET['idOder']);
            if($order['status_payment'] == 1){
                $status_payment = 2;
            }
            $this->order->update($_GET['idOder'],[
                'status_delivery' => 4,
                'status_payment' => $status_payment ?? 0,
            ]);
        }
        header('Location:'.url('admin/order?'.$history));
        exit;
    }
}
