<?php

namespace XuongOop\Salessa\Controllers\Client;

use Exception;
use Rakit\Validation\Rules\Email;
use Rakit\Validation\Validator;
use XuongOop\Salessa\Commons\Controller;
use XuongOop\Salessa\Commons\Helper;
use XuongOop\Salessa\Models\User;

class LoginController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function showFormLogin()
    {
        $this->renderViewClient('login');
    }

    public function login()
    {
        unset($_SESSION['carts']);
        $validator = new Validator;
        try {
            $validation = $validator->make($_POST, [
                'email'         => 'required|email',
                'password_in'   => 'required|min:8'
            ]);

            $validation->validate();
            $_SESSION['errors'] = $validation->errors()->firstOfAll();
            if(!empty($_SESSION['errors'])){
                throw new Exception("Error");
            }
            $user = $this->user->findByEmail($_POST['email']);
            if(!empty($user)){
                $flag = password_verify($_POST['password_in'],$user['password']);
                if($flag==false){
                    $_SESSION['errors'][] = 'Mật khẩu không đúng';
                    throw new Exception("Mật khẩu không đúng");
                }else{
                    $_SESSION['users'] = $user;
                    if($user['type'] == 'admin'){
                        auth_check();
                        exit;
                    }
                    header('Location:'.url(''));
                    exit;
                }
            }else{
                $_SESSION['errors'][] = 'Tài khoản không tồn tại';
                throw new Exception("Error Processing Request");
            }
        } catch (\Throwable $th) {
            // Helper::debug($th);
            header('Location:'.url('login&singin'));
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['carts-' . $_SESSION['users']['id'] ]);
        unset($_SESSION['users']);

        header('Location: ' . url('') );
        exit;
    }

    public function singin()
    {
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'username'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'repassword'      => 'required|same:password',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('login&singin'));
            exit;
        } else {
            $data = [
                'name'     => $_POST['username'],
                'email'    => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ];
            $checkemail = $this->user->findByEmail($_POST['email']);
            if(!empty($checkemail)) {
                $_SESSION['errors'][] = 'Email đã tồn tại';
            }else{
                $this->user->insert($data);
                $_SESSION['status'] = true;
                $_SESSION['msg'] = 'Đăng ký thành công vui lòng đăng nhập';
            }
            header('Location: ' . url('login&singin'));
            exit;
        }
    }
}
