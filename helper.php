<?php 

const PATH_ASSET = __DIR__ . '/assets/' ;

// PATH_ROOT :  lấy đường dẫn tuyện đối  để tránh rủ do về việc thay đổi đường dẫn thư mục 
const PATH_ROOT = __DIR__ . '/' ;

if (!function_exists('show_upload')) {
    function show_upload($path) {
        return $_ENV['BASE_URL'] . '/assets/' . $path;
    }
}

if (!function_exists('asset')) {
    function asset($path) {
        return $_ENV['BASE_URL'] . $path;
    }
}

if (!function_exists('url')) {
    function url($uri) {
        return $_ENV['BASE_URL'] . $uri;
    }
}
if (!function_exists('auth_check')) {
    function auth_check() {
        if (isset($_SESSION['users'])) {
            header('Location: ' . url('admin/') );
            exit;
        }
    }
}