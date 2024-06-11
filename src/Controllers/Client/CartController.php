<?php

namespace XuongOop\Salessa\Controllers\Client;

use XuongOop\Salessa\Models\CartDetail;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\Cart;
use XuongOop\Salessa\Models\Product;

class CartController extends Controller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $cartDetail;
    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->cartDetail = new CartDetail();
    }
    public function cart()
    {
        $conn = $this->cart->getConn();
        try {
            $products = $this->product->findByID($_POST['productID']);
            if (!empty($products)) {
                $quantity = $_POST['quantity'] ?? 1;
                $key = 'carts';
                if (!empty($_SESSION['users'])) {
                    $key .= '-' . $_SESSION['users']['id'];
                }
                // unset($_SESSION['carts']);
                if (isset($_GET['index']) && isset($_SESSION[$key][$products['id']])) {
                    $_SESSION[$key][$products['id']] = $products + ['quantity' => $quantity];
                } else if (!isset($_SESSION[$key][$products['id']])) {
                    $_SESSION[$key][$products['id']] = $products + ['quantity' => $quantity];
                }else if(isset($_SESSION[$key][$products['id']])){
                    $_SESSION[$key][$products['id']]['quantity'] += $quantity;
                }
                // Helper::debug($_SESSION[$key]);
                // Helper::debug($conn);
                if (!empty($_SESSION['users'])) {
                    // $conn->beginTransaction();
                    $cart = $this->cart->findByIDUser($_SESSION['users']['id']);
                    if (empty($cart)) {
                        $this->cart->insert([
                            'user_id' => $_SESSION['users']['id']
                        ]);
                    }

                    $cartID = $cart['id'] ?? $conn->lastInsertId();
                    $_SESSION['cart_id'] = $cartID;
                    $this->cartDetail->deleteByCartID($cartID);
                    foreach ($_SESSION[$key] as $productID => $item) {
                        $this->cartDetail->insert([
                            'cart_id' => $cartID,
                            'product_id' => $productID,
                            'quantity' => $item['quantity']
                        ]);
                    }
                    // $conn->commit();
                }
            } else {
                throw new \Exception('Không tồn tại Products');
            }
        } catch (\Throwable $th) {
            // $conn->rollBack();
        }
        header('Location:' . url('cartDetail'));
        exit;
    }

    public function cartDetail()
    {
        $key = 'carts';
        if (!empty($_SESSION['users'])) {
            $key .= '-' . $_SESSION['users']['id'];
        }
        if(!empty($_SESSION[$key])){
            $totalProduct = $this->cart->totalProduct($_SESSION[$key]);
        }
        $this->renderViewClient('carts.cart', [
            'totalProduct' => $totalProduct ?? 0,
            'key' => $key,
        ]);
    }

    public function quantity()
    {
        $key = 'carts';
        if (isset($_SESSION['users'])) {
            $key .= '-' . $_SESSION['users']['id'];
        }
        if (isset($_GET['productId']) && $_GET['productId'] != "") {
            if (!empty($_SESSION[$key][$_GET['productId']])) {
                if (isset($_GET['inc'])) {
                    $_SESSION[$key][$_GET['productId']]['quantity'] += 1;
                }
                if (isset($_GET['dec']) && $_SESSION[$key][$_GET['productId']]['quantity'] > 1) {
                    $_SESSION[$key][$_GET['productId']]['quantity'] -= 1;
                }
            }
        }
        if (isset($_SESSION['users'])) {
            $this->cartDetail->updateByCartIDAndProductID(
                $_SESSION['cart_id'],
                $_GET['productId'],
                $_SESSION[$key][$_GET['productId']]['quantity']
            );
        }
        header('Location:' . url('cartDetail'));
        exit;
    }

    public function cartDelete()
    {
        $key = 'carts';
        if (isset($_SESSION['users'])) {
            $key .= '-' . $_SESSION['users']['id'];
        }

        unset($_SESSION[$key][$_GET['productID']]);

        if (isset($_SESSION['users'])) {
            $this->cartDetail->deleteByCartIDAndProductID($_SESSION['cart_id'], $_GET['productID']);
        }
        header('Location:' . url('cartDetail'));
        exit;
    }
}
