<?php
$title = "Ohh no!";
$page = "404";
include 'views/layouts/header.php';
?>

<?php
$result = constant('DAO')->execute('
SELECT MAX(id) AS latest_order_id
FROM `order`;
');

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo $row['latest_order_id'];
    }
}

?>

<?php
include 'views/layouts/footer.php';
?>