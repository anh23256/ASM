<?php

namespace XuongOop\Salessa\Controllers\Client;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Order;

class Comfirm extends Controller
{
    public function comfirm() {
        $order = new Order();
        if(isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00'){
            if(isset($_SESSION['oderdetail']) && $_SESSION['oderdetail']!=""){
                $order->update($_SESSION['oderdetail'],[
                    'status_payment' => 1,
                ]);
            }
        }
        unset($_SESSION['totalOrder']);
        unset($_SESSION['oderdetail']);
        $this->renderViewClient('comfirm.comfirm');
    }
}