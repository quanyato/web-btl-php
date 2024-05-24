<?php
$title = "Order detail";
$page = "order";
include 'views/layouts/header.php';

$pageNumber = 1;
if (isset($_GET['pageNumber'])) {
    $pageNumber = $_GET['pageNumber'];
}
?>

<div class="d-sm-flex justify-content-start align-items-center mb-4">
    <a class="btn btn-primary btn-sm me-3 mb-2 mb-sm-0" href="<?php echo 'orders?pageNumber='.$pageNumber; ?>">Quay lại</a>
    <h3 class="text-dark mb-0">Chi tiết đơn hàng</h3>
</div>
<hr>

<form class="row g-3" method="POST" action="updateOrder">
    <input class="d-none" type="number" name="orderId" value="<?= $order->getId() ?>">
    <input class="d-none" type="number" name="customerId" value="<?= $customer->getId() ?>">
    <input class="d-none" type="number" name="pageNumber" value="<?= $pageNumber ?>">

    <div class="col-md-6 col-xl-4">
        <label for="lastName" class="form-label">Họ</label>
        <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $customer->getLastName() ?>">
    </div>
    <div class="col-md-6 col-xl-4">
        <label for="firstName" class="form-label">Tên</label>
        <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $customer->getFirstName() ?>">
    </div>
    <div class="col-12 col-xl-4">
        <label for="birthday" class="form-label">Ngày sinh</label>
        <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $customer->getBirthday() ?>">
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $customer->getEmail() ?>">
    </div>
    <div class="col-md-6">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?= $customer->getPhone() ?>">
    </div>
    <div class="col-12">
        <label for="address" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= $customer->getAddress() ?>">
    </div>

    <div class="col-md-6 col-xl-4">
        <label for="timestamp" class="form-label">Ngày giờ</label>
        <input type="text" class="form-control" id="timestamp" name="timestamp" disabled value="<?= $order->getTimestamp() ?>">
    </div>
    <div class="col-md-6 col-xl-4">
        <label for="status" class="form-label">Trạng thái</label>
        <select class="form-select" id="status" name="status">
            <?php for ($x = 1; $x <= 8; $x++) { ?>
                <option value="<?= $x ?>" <?= $x == $order->getStatus() ? 'selected' : '' ?>>
                    <?= formatOrderStatus($x) ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-12 col-xl-4">
        <label for="totalPrice" class="form-label">Thành tiền</label>
        <input type="text" class="form-control" id="totalPrice" name="totalPrice" disabled value="<?php echo formatMoney(($order->getTotalPrice())*1000, ' vnđ') ?>">
    </div>

    <div class="col-12 text-center mb-5">
        <button type="submit" class="btn btn-primary me-0 me-sm-3 mb-3 mb-sm-0">Cập nhật thông tin</button>
        <a class="btn btn-danger mb-3 mb-sm-0" href="deleteOrder?orderId=<?=$order->getId()?>&pageNumber=<?=$pageNumber?>">Xóa đơn hàng</a>
    </div>
</form>

<?php require_once 'views/layouts/addProductModal.php' ?>
<div class="card shadow">
    <div class="card-header py-3">
        <div class="row">
            <h4 class="text-primary m-0 mb-2 mb-lg-0 fw-bold col-lg-4">Sản phẩm</h4>
            <div class="mb-2 mb-lg-0 col-lg-4 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#addProductModal">
                Thêm sản phẩm mới
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table my-0 table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Tên sản phẩm</th>
                        <th>Kích thước</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền (vnđ)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $orderItem) { ?>
                        <tr>
                            <td><img class="rounded-circle" src="public/<?= $orderItem->getImg() ?>" width="40"></td>
                            <td><?= $orderItem->getName() ?></td>
                            <td><?= formatProductSize($orderItem->getSize()) ?></td>
                            <td><?= $orderItem->getPrice()*1000 ?></td>
                            <td><?= $orderItem->getQuantity() ?></td>
                            <td><?= formatMoney($orderItem->getPrice()*1000*$orderItem->getQuantity(), '') ?></td>
                            <td class="text-center">
                                <a class="btn btn-danger btn-sm" role="button" href="deleteOrderItem?orderId=<?= $order->getId() ?>&itemId=<?= $orderItem->getId() ?>&pageNumber=<?=$pageNumber?>">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>