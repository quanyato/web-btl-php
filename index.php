<?php
// remove header
header_remove('ETag');
header_remove('Pragma');
header_remove('Cache-Control');
header_remove('Last-Modified');
header_remove('Expires');

// set header
header('Expires: Thu, 1 Jan 1970 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');

require_once __DIR__ . '/models/database.php';
define('DAO', new Database());

function formatMoney($number, $suffix = 'K')
{
    if (!empty($number)) {
        return number_format($number, 0, ',', '.') . "{$suffix}";
    }
}

function formatOrderNumber($orderNumber)
{
    $formattedOrderNumber = str_pad($orderNumber, 8, '0', STR_PAD_LEFT);
    return $formattedOrderNumber;
}

function formatOrderStatus($orderStatus)
{
    switch ($orderStatus) {
        case 1:
            return '<span class="bg-secondary-subtle rounded-pill p-1 px-2">Chờ xác nhận</span>';
        case 2:
            return '<span class="bg-info rounded-pill p-1 px-2">Chờ lấy hàng</span>';
        case 3:
            return '<span class="bg-primary text-white rounded-pill p-1 px-2">Đang giao</span>';
        case 4:
            return '<span class="bg-success text-white rounded-pill p-1 px-2">Đã giao</span>';
        case 5:
            return '<span class="bg-danger-subtle rounded-pill p-1 px-2">Đơn hủy</span>';
        case 6:
            return '<span class="bg-warning-subtle rounded-pill p-1 px-2">Đang trả hàng</span>';
        case 7:
            return '<span class="bg-warning text-white rounded-pill p-1 px-2">Đã trả hàng</span>';
        case 8:
            return '<span class="bg-danger text-white rounded-pill p-1 px-2">Thất lạc</span>';
        default:
            return 'Không xác định';
    }
}

function formatProductSize($productSize)
{
    switch ($productSize) {
        case 1:
            return 'S';
        case 2:
            return 'M';
        case 3:
            return 'L';
        case 4:
            return 'XL';
        case 5:
            return 'XXL';
        default:
            return $productSize;
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
        $orderController = new orderController();

        if (isset($_GET['orderId'])) {
            $orderController->setOrderId($_GET['orderId']);
        } else {
            $orderController->redirect('home');
        }

        $orderController->index($_GET['orderId']);
        break;

    case 'updateOrder':
        require_once __DIR__ . '/controllers/orderController.php';
        $orderController = new orderController();

        $orderController->updateOrder();
        break;

    case 'addOrderItem':
        require_once __DIR__ . '/controllers/orderController.php';
        $orderController = new orderController();

        $orderController->addOrderItem();
        break;

    case 'deleteOrder':
        require_once __DIR__ . '/controllers/orderController.php';
        $orderController = new orderController();

        if (isset($_GET['orderId'])) {
            $orderController->deleteOrder($_GET['orderId'], $_GET['pageNumber']);
        } else {
            $orderController->redirect('home');
        }
        break;

    case 'deleteOrderItem':
        require_once __DIR__ . '/controllers/orderController.php';
        $orderController = new orderController();

        if (isset($_GET['orderId'])) {
            $orderController->setOrderId($_GET['orderId']);
            if (isset($_GET['itemId'])) {
                $orderController->deleteOrderItem($_GET['orderId'], $_GET['itemId'], $_GET['pageNumber']);
            } else {
                $orderController->index($_GET['orderId']);
            }
        } else {
            $orderController->redirect('home');
        }
        break;

    case 'newOrder':
        require_once __DIR__ . '/controllers/newOrderController.php';

        $newOrderController = new newOrderController();
        $newOrderController->addNewCustomer();
        break;

    case 'orders':
        require_once __DIR__ . '/controllers/ordersController.php';

        $ordersController = new ordersController();

        $pageNumber = 1;
        if (isset($_GET['pageNumber'])) {
            $pageNumber = $_GET['pageNumber'];
        }

        $ordersController->index($pageNumber);
        break;

    case 'test':
        require_once __DIR__ . '/views/test.php';
        break;

    case 'ajaxGetInventory':
        require_once __DIR__ . '/controllers/orderController.php';
        $orderController = new orderController();

        echo json_encode($orderController->getInventoryByProductId($_GET['productId']));
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/views/404.php';
        break;
}
