<?php
class ordersController {
    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function index()
    {
        require_once 'views/orders.php';
    }
}

$ordersController = new ordersController();

$ordersController->index();