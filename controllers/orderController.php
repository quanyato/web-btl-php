<?php
require_once __DIR__ . '/../models/order.php';
require_once __DIR__ . '/../models/customer.php';
require_once __DIR__ . '/../models/order_item.php';

class orderController
{
    private $order_id;
    private $customer;
    private $order;
    private $order_items = array();

    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }
    public function getOrderId()
    {
        return $this->order_id;
    }

    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function index($order_id)
    {
        $customer = $this->get_customer($order_id);
        $order = $this->get_order($order_id);
        $order_items = $this->get_order_item_list($order_id);
        $allProduct = $this->getAllProducts();
        require_once 'views/order.php';
    }

    public function get_order($order_id)
    {
        $result = constant('DAO')->execute('
        SELECT 
            o.id,
            o.customer_id,
            o.timestamp,
            o.total_price,
            o.status
        FROM 
            `order` o
        WHERE 
            o.id = ' . $order_id . ';
        ');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->order = new order($row['id'], $row['customer_id'], $row['timestamp'], $row['status'], $row['total_price']);
        }

        return $this->order;
    }

    public function get_customer($order_id)
    {
        $result = constant('DAO')->execute('
        SELECT
            c.id,
            c.last_name,
            c.first_name,
            c.birthday,
            c.email,
            c.phone,
            c.address
        FROM 
            customer c
        JOIN 
            `order` o ON c.id = o.customer_id
        WHERE 
            o.id = ' . $order_id . ';
        ');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->customer = new customer($row['id'], $row['first_name'], $row['last_name'], $row['birthday'], $row['email'], $row['phone'], $row['address']);
        }

        return $this->customer;
    }

    public function get_order_item_list($order_id)
    {
        $result = constant('DAO')->execute('
        SELECT 
            oi.id AS order_item_id,
            p.primary_img AS image,
            p.name AS name,
            i.size AS size,
            p.price AS price,
            oi.quantity AS quantity
        FROM 
            order_item oi
        JOIN 
            inventory i ON oi.sku = i.sku
        JOIN 
            product p ON i.product_id = p.id
        WHERE 
            oi.order_id = ' . $order_id . ';
        ');

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $order_item = new order_item($row['order_item_id'], $row['image'], $row['name'], $row['size'], $row['price'], $row['quantity']);
                array_push($this->order_items, $order_item);
            }
        }

        return $this->order_items;
    }

    public function updateOrder()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = constant('DAO')->execute("
            UPDATE `order` SET status = " . $_POST['status'] . "
            WHERE id = " . $_POST['orderId'] . ";
            ");

            $result = constant('DAO')->execute("
            UPDATE customer
            SET 
                last_name = '" . $_POST['lastName'] . "',
                first_name = '" . $_POST['firstName'] . "',
                birthday = '" . $_POST['birthday'] . "',
                email = '" . $_POST['email'] . "',
                phone = '" . $_POST['phone'] . "',
                address = '" . $_POST['address'] . "'
            WHERE id = " . $_POST['customerId'] . ";
            ");

            if ($result) {
                $this->redirect('order?orderId=' . $_POST['orderId'] . '&pageNumber=' . $_POST['pageNumber']);
            }
        } else {
            $this->redirect('home');
        }
    }

    public function deleteOrder($order_id, $pageNumber)
    {
        $result = constant('DAO')->execute('
        DELETE FROM 
            `order`
        WHERE 
            id = ' . $order_id . ';
        ');

        if ($result) {
            $this->redirect('orders?pageNumber=' . $pageNumber);
        }
    }

    public function addOrderItem()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = constant('DAO')->execute("
            INSERT INTO order_item (order_id, sku, quantity)
            VALUES (" . $_POST['orderId'] . ", " . $_POST['newItemSku'] . ", " . $_POST['quantity'] . ");
            ");

            if ($result) {
                $this->redirect('order?orderId=' . $_POST['orderId'] . '&pageNumber=' . $_POST['pageNumber']);
            }
        } else {
            $this->redirect('home');
        }
    }

    public function deleteOrderItem($order_id, $order_item_id, $pageNumber)
    {
        $result = constant('DAO')->execute('
        DELETE FROM 
            order_item
        WHERE 
            id = ' . $order_item_id . ';
        ');

        if ($result) {
            $this->redirect('order?orderId=' . $order_id . '&pageNumber=' . $pageNumber);
        }
    }

    public function getAllProducts()
    {
        $allProduct = array();
        $result = constant('DAO')->execute('
        SELECT id, name, price
        FROM product;
        ');

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                array_push($allProduct, $row);
            }
            return $allProduct;
        }
    }

    public function getInventoryByProductId($productId)
    {
        $inventoryByProductId = array();
        $result = constant('DAO')->execute('
        SELECT *
        FROM inventory
        WHERE product_id = ' . $productId . ';
        ');

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                array_push($inventoryByProductId, $row);
            }
            return $inventoryByProductId;
        }
    }
}
