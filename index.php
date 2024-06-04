<?php

session_start();
// __DIR__ lấy trực tiếp đừng dẫn từ ổ cứng
require_once __DIR__ . './vendor/autoload.php';

//kết nối tới file .env
//file .env chứa các biến môi trường
Dotenv\Dotenv::createImmutable(__DIR__)->load();

require_once __DIR__ .'./routes/index.php';