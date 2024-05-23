<?php
require_once __DIR__ . '/../models/order_statistics.php';

class ordersController {
    private $total_orders;
    private $orders = array();

    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function index($pageNumber = 1)
    {
        $total_orders = $this->get_total_orders();
        $last_page = ceil($total_orders / 10);
        $middlePage = $pageNumber;
        if ($last_page > 2) {
            if ($pageNumber == 1) {
                $middlePage = 2;
            } elseif ($pageNumber == $last_page) {
                $middlePage = $last_page - 1;
            }
        }
        $nextPage = $pageNumber==$last_page ? $last_page : $middlePage + 1;
        $prevPage = $pageNumber==1 ? 1 : $middlePage - 1;
        $orders = $this->get_10_orders(10, $pageNumber);
        require_once 'views/orders.php';
    }

    public function get_10_orders($limit, $page)
    {
        $result = constant('DAO')->execute('
        SELECT
            o.id AS order_id,
            c.first_name AS first_name,
            c.last_name AS last_name,
            o.status,
            SUM(oi.quantity) AS total_items,
            o.timestamp,
            o.total_price
        FROM
            `order` AS o
            JOIN customer AS c ON c.id = o.customer_id
            LEFT JOIN order_item AS oi ON oi.order_id = o.id
        GROUP BY
            o.id,
            c.first_name,
            c.last_name,
            o.status,
            o.timestamp,
            o.total_price
        ORDER BY o.timestamp DESC
        LIMIT ' . $limit . ' OFFSET ' . ($page-1)*$limit . ';
        ');

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $order = new order_statistics($row['order_id'], $row['last_name'] . ' ' . $row['first_name'], $row['timestamp'], $row['status'], $row['total_items'], $row['total_price']);
                array_push($this->orders, $order);
            }
        }

        return $this->orders;
    }

    public function get_total_orders()
    {
        $result = constant('DAO')->execute('
        SELECT COUNT(*) AS total_orders
        FROM `order`;
        ');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->total_orders = $row['total_orders'];
        }

        return $this->total_orders;
    }
}

$ordersController = new ordersController();

$pageNumber = 1;
if (isset($_GET['pageNumber'])) {
    $pageNumber = $_GET['pageNumber'];
}

$ordersController->index($pageNumber);