<?php
$title = "Ohh no!";
$page = "404";
include 'views/layouts/header.php';
?>

<?php
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
ORDER BY o.timestamp;');

if ($result) {
    while ($row = $result->fetch_assoc()) {
        var_dump($row);
    }
}

?>

<?php
include 'views/layouts/footer.php';
?>