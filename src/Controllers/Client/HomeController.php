<?php

namespace XuongOop\Salessa\Controllers\Client;
use XuongOop\Salessa\Commons\Controller;


class HomeController extends Controller
{
    public function index() {
        $name = 'Salessa';

        $this->renderViewClient('home', [
            'name' => $name
        ]);
    }
}