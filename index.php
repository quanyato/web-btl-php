<?php
require_once __DIR__ . '/models/database.php';
define('DAO', new Database());

function formatMoney($number, $suffix = 'K') {
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . "{$suffix}";
    }
}

function formatOrderNumber($orderNumber) {
    $formattedOrderNumber = str_pad($orderNumber, 8, '0', STR_PAD_LEFT);
    return $formattedOrderNumber;
}

function formatOrderStatus($orderStatus) {
    switch ($orderStatus) {
        case 1:
            return 'Chờ xác nhận';
        case 2:
            return 'Chờ lấy hàng';
        case 3:
            return 'Đang giao';
        case 4:
            return 'Đã giao';
        case 5:
            return 'Đơn hủy';
        case 6:
            return 'Đang trả hàng';
        case 7:
            return 'Đã trả hàng';
        case 8:
            return 'Thất lạc';
        default:
            return 'Không xác định';
    }
}

$request = $_SERVER['REDIRECT_URL'];

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
