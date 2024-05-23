<?php
require_once __DIR__ . '/../models/product.php';

class homeController
{
    private $top_5_most_sold_products = array();
    private $top_5_least_quantity_products = array();
    private $today_orders;
    private $today_revenue;
    private $monthly_revenue;
    private $yearly_revenue;

    public function redirect($url)
    {
        header('Location: ' . $url, true, 301);
        exit();
    }

    public function index()
    {
        $top5LeastQuantityProducts = $this->get_5_least_quantity_products();
        $top5MostSoldProducts = $this->get_5_most_sold_products();
        $todayOrders = $this->get_total_order_today();
        $todayRevenue = $this->get_revenue_today();
        $monthlyRevenue = $this->get_revenue_monthly();
        $yearlyRevenue = $this->get_revenue_yearly();
        require_once 'views/home.php';
    }

    public function get_5_most_sold_products()
    {
        $result = constant('DAO')->execute('
        SELECT * FROM product
        ORDER BY total_sold DESC
        LIMIT 5;');

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $product = new product($row['id'], $row['name'], $row['price'], $row['primary_img'], $row['total_sold']);
                array_push($this->top_5_most_sold_products, $product);
            }
        }

        return $this->top_5_most_sold_products;
    }

    public function get_5_least_quantity_products()
    {
        $result = constant('DAO')->execute('
        SELECT p.*, SUM(i.quantity) AS total_inventory_quantity
        FROM product p
        INNER JOIN inventory i ON p.id = i.product_id
        GROUP BY p.id
        ORDER BY total_inventory_quantity ASC
        LIMIT 5;');

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $product = new product($row['id'], $row['name'], $row['price'], $row['primary_img'], $row['total_sold']);
                $product->setTotalQuantity($row['total_inventory_quantity']);
                array_push($this->top_5_least_quantity_products, $product);
            }
        }

        return $this->top_5_least_quantity_products;
    }

    public function get_total_order_today() {
        $result = constant('DAO')->execute('
        SELECT COUNT(*) AS total_orders_today
        FROM `order`
        WHERE DATE(timestamp) = CURDATE();');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->today_orders = $row['total_orders_today'];
        }

        return $this->today_orders;
    }

    public function get_revenue_today() {
        $result = constant('DAO')->execute('
        SELECT SUM(total_price) AS total_revenue_today
        FROM `order`
        WHERE DATE(timestamp) = CURDATE();
        ');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->today_revenue = $row['total_revenue_today'];
        }

        return $this->today_revenue;
    }

    public function get_revenue_monthly() {
        $result = constant('DAO')->execute('
        SELECT SUM(total_price) AS total_revenue_this_month
        FROM `order`
        WHERE YEAR(timestamp) = YEAR(CURDATE()) AND MONTH(timestamp) = MONTH(CURDATE());
        ');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->monthly_revenue = $row['total_revenue_this_month'];
        }

        return $this->monthly_revenue;
    }

    public function get_revenue_yearly() {
        $result = constant('DAO')->execute('
        SELECT SUM(total_price) AS total_revenue_this_year
        FROM `order`
        WHERE YEAR(timestamp) = YEAR(CURDATE());
        ');

        if ($result) {
            $row = $result->fetch_assoc();
            $this->yearly_revenue = $row['total_revenue_this_year'];
        }

        return $this->yearly_revenue;
    }
}

$homeController = new homeController();

$homeController->index();
