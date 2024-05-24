<?php

class newOrderController
{
    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function addNewPayment($orderId)
    {
        $result = constant('DAO')->execute("
        INSERT INTO payment (order_id, method, is_paid)
        VALUES (" . $orderId . ", 1, 0);
        ");

        if ($result) {
            $this->redirect('order?orderId=' . $orderId . '&pageNumber=1');
        }
    }

    public function addNewOrder($customerId)
    {
        $result = constant('DAO')->execute("
        INSERT INTO `order` (customer_id, status)
        VALUES (" . $customerId . ", 1);
        ");

        if ($result) {
            $latestOrder = constant('DAO')->execute('
            SELECT MAX(id) AS latest_order_id
            FROM `order`;
            ');
            if ($latestOrder) {
                while ($row = $latestOrder->fetch_assoc()) {
                    $this->addNewPayment($row['latest_order_id']);
                }
            }
        }
    }

    public function addNewCustomer()
    {
        $result = constant('DAO')->execute("
        INSERT INTO customer (first_name, last_name, birthday, email, phone, address)
        VALUES ('Blank', 'Blank', '1990-01-01', 'Blank', '0000000000', 'Blank');
        ");

        if ($result) {
            $latestCustomer = constant('DAO')->execute('
            SELECT MAX(id) AS latest_customer_id
            FROM customer;
            ');
            if ($latestCustomer) {
                while ($row = $latestCustomer->fetch_assoc()) {
                    $this->addNewOrder($row['latest_customer_id']);
                }
            }
        }
    }
}
