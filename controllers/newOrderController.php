<?php

class newOrderController
{
    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function index()
    {
        $this->redirect('order');
    }
}

$newOrderController = new newOrderController();
$newOrderController->index();