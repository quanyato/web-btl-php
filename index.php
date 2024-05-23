<?php
require_once __DIR__ . '/models/database.php';
define('DAO', new Database());

if (!function_exists('money_format')) {
    function money_format($number, $suffix = 'K') {
        if (!empty($number)) {
            return number_format($number, 0, ',', '.') . "{$suffix}";
        }
    }
}

$request = $_SERVER['REQUEST_URI'];

$url = explode('/', filter_var(rtrim($request, '/'), FILTER_SANITIZE_URL));

if (!isset($url[2]) || $url[2] == '') {
    $url[2] = 'login';
}

switch ($url[2]) {
    case 'login':
        require_once __DIR__ . '/controllers/loginController.php';
        break;

    case 'home':
        require_once __DIR__ . '/controllers/homeController.php';
        break;

    case 'order':
        require_once __DIR__ . '/controllers/orderController.php';
        break;

    case 'orders':
        require_once __DIR__ . '/controllers/ordersController.php';
        break;

    case 'test':
        require_once __DIR__ . '/views/test.php';
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/views/404.php';
        break;
}
