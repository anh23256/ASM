<?php

namespace XuongOop\Salessa\Controllers\Client;

use Rakit\Validation\Validator;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Cart;
use XuongOop\Salessa\Models\CartDetail;
use XuongOop\Salessa\Models\Order;
use XuongOop\Salessa\Models\OrderDetail;
use XuongOop\Salessa\Models\Product;
use XuongOop\Salessa\Models\User;

class OrderController extends Controller
{
    private Product $product;
    private CartDetail $cartDetail;
    private Order $order;
    private Cart $cart;
    private OrderDetail $orderDetail;
    private User $user;
    public function __construct()
    {
        $this->cartDetail = new CartDetail();
        $this->order = new Order();
        $this->user = new User();
        $this->cart = new Cart();
        $this->orderDetail = new OrderDetail();
    }
    public function order()
    {
        $key = 'carts';
        if (!empty($_SESSION['users'])) {
            $key .= '-' . $_SESSION['users']['id'];
        }
        if (!empty($_SESSION[$key])) {
            $totalProduct = $this->cart->totalProduct($_SESSION[$key]);
        }else{
            $_SESSION['errors'] = 'Chưa có đơn hàng';
            header('Location:'.url('cartDetail'));
            exit;
        }
        $this->renderViewClient('orders.order', [
            'totalProduct' => $totalProduct,
            'key' => $key,
        ]);
    }
    public function orderDetail()
    {
        // $conn = $this->cart->getConn();
        $validator = new Validator;
        try {
            $valdation = $validator->make($_POST, [
                'name' => 'required|max:50',
                'email' => 'required|email',
                'adress' => 'required',
                'phone' => 'required|max:10',
                'payment' => 'required',
                'shipping' => 'required',
            ]);
            $valdation->validate();
            if ($valdation->fails()) {
                $_SESSION['errors'] = $valdation->errors()->firstOfAll();
                throw new \Exception("Error");
            }
            if (!isset($_SESSION['users'])) {
                $user = $this->user->findByEmail($_POST['email']);
                if (!empty($user)) {
                    $iduser = $user['id'];
                } else {
                    $this->user->insert([
                        'name' => $_POST['name'],
                        'email' => $_POST['email'],
                        'password' => password_hash($_POST['email'], PASSWORD_DEFAULT),
                        'is_active' => 0,
                    ]);
                    $conn = $this->user->getConn();
                    $iduser = $conn->lastInsertId();
                }
            }
            $idUser = $iduser ?? $_SESSION['users']['id'];
            $conn = $this->order->getConn();
            $this->order->insert([
                'user_id' => $idUser,
                'user_name' => $_POST['name'],
                'user_email' => $_POST['email'],
                'user_phone' => $_POST['phone'],
                'user_address' => $_POST['adress'],
                'totalOrder' => $_POST['totalOrder'],
            ]);
            $_SESSION['oderdetail'] = $orderID = $conn->lastInsertId();
            if (!empty($orderID)) {
                $key = 'carts';
                if (!empty($_SESSION['users'])) {
                    $key .= '-' . $_SESSION['users']['id'];
                }
                foreach ($_SESSION[$key] as $productId => $item) {
                    $this->orderDetail->insert([
                        'order_id' => $orderID,
                        'product_id' => $productId,
                        'quantity' => $item['quantity'],
                        'price' => $item['price_sale'] ?? $item['price_regular'],
                        'namesp' => $item['name'],
                        'img' => $item['img_thumbnail'],
                    ]);
                }
                $_SESSION['totalOrder'] = $_POST['totalOrder'];
            } else {
                throw new \Exception("Error");
            }
            if(!empty($_SESSION['users'])){
                $this->cartDetail->deleteByCartID($_SESSION['cart_id']);
                $this->cart->delete($_SESSION['cart_id']);
            }
            // Xóa trong SESSION
            unset($_SESSION[$key]);

            if (isset($_SESSION['user'])) {
                unset($_SESSION['cart_id']);
            }
            if ($_POST['payment'] == 3) {
                header('Location:' . url('assets/vnpay_php/vnpay_create_payment.php'));
                exit;
            }
            header('Location:' . url('comfirm'));
            exit;
        } catch (\Throwable $th) {
            header('Location:' . url('order'));
            exit;
        }
    }
    public function historyOrder()
    {
        $page = $_GET['page'] ?? 1;
        [$historyOrder, $totalPage] = $this->order->getAllOrderByUserId($_SESSION['users']['id'], $page);
        $history = 'historyOrder';
        // Helper::debug($historyOrder);
        $this->renderViewClient('historyOrder.history', [
            'historyOrder' => $historyOrder,
            'totalPage'    => $totalPage ?? 1,
            'history' => $history,
            'page'    => $page,
        ]);
    }

    public function historyOrderDetail()
    {
        $page = $_GET['page'] ?? 1;
        if (!empty($_GET['idOder'])) {
            [$historyOrder1, $totalPage] = $this->order->paginateHistoryOrder($_GET['idOder'], $_SESSION['users']['id'], $page);
            $history = 'historyDetail';
        }
        $this->renderViewClient('historyOrder.history', [
            'historyOrder1' => $historyOrder1,
            'totalPage' => $totalPage ?? 1,
            'history' => $history,
            'page'    => $page,
        ]);
    }

    public function cancelOrder()
    {
        if (!empty($_GET['idOder'])) {
            $order = $this->order->findByID($_GET['idOder']);
            if ($order['status_payment'] == 1) {
                $status_payment = 2;
            }
            $this->order->update($_GET['idOder'], [
                'status_delivery' => 4,
                'status_payment' => $status_payment ?? 0,
            ]);
        }
        header('Location:' . url('historyOrder'));
        exit;
    }
}
