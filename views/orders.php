<?php
$title = "Orders page";
$page = "orders";
include 'views/layouts/header.php';
?>

<div class="card shadow">
    <div class="card-header py-3">
        <div class="row">
            <h4 class="text-primary m-0 mb-2 mb-lg-0 fw-bold col-lg-4">Đơn hàng</h4>
            <div class="mb-2 mb-lg-0 col-lg-4 text-end">
                <a class="btn btn-primary btn-sm w-100 w-lg-auto" href="newOrder" role="button">Thêm đơn hàng mới</a>
            </div>
            <!-- <div class="col-lg-4 text-lg-end text-nowrap">
                <select class="form-select form-select-sm">
                    <option selected>Tất cả</option>
                    <option value="1">Chờ xác nhận</option>
                    <option value="2">Chờ lấy hàng</option>
                    <option value="3">Đang giao</option>
                    <option value="4">Đã giao</option>
                    <option value="5">Đơn hủy</option>
                    <option value="6">Đang trả hàng</option>
                    <option value="7">Đã trả hàng</option>
                    <option value="8">Thất lạc</option>
                </select>
            </div> -->
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
            <table class="table my-0 table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Trạng thái</th>
                        <th>Số SP</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền (vnđ)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?= formatOrderNumber($order->getId()) ?></td>
                            <td><?= $order->getCustomerFullname() ?></td>
                            <td><?= formatOrderStatus($order->getStatus()) ?></td>
                            <td><?= $order->getTotalQuantity() ?></td>
                            <td><?= $order->getTimestamp() ?></td>
                            <td><?= formatMoney(($order->getTotalPrice())*1000, '') ?></td>
                            <td><a class="btn btn-primary btn-sm" href="order?orderId=<?= $order->getId() ?>&pageNumber=<?= $pageNumber ?>">Xem</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 align-self-center">
                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Đơn hàng <?= ($pageNumber-1)*10+1 ?> đến <?= (($pageNumber-1)*10+10)>$total_orders ? $total_orders : ($pageNumber-1)*10+10 ?> trong <?= $total_orders ?></p>
            </div>
            <div class="col-md-6">
                <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                        <li class="page-item <?php if ($pageNumber==1) echo 'disabled ' ?>"><a class="page-link" aria-label="Previous" href="<?php echo 'orders?pageNumber=1'; ?>"><span aria-hidden="true">«</span></a></li>
                        <li class="page-item <?php if ($pageNumber==1) echo 'active ' ?>"><a class="page-link" href="<?= 'orders?pageNumber='.$prevPage; ?>"><?= $prevPage; ?></a></li>
                        <li class="page-item <?php if (($pageNumber!=1)&&($pageNumber!=$last_page)) echo 'active '; if ($last_page<3) echo 'd-none '; ?>"><a class="page-link" href="<?= 'orders?pageNumber='.$middlePage; ?>"><?= $middlePage ?></a></li>
                        <li class="page-item <?php if ($pageNumber==$last_page) echo 'active '; if ($last_page<2) echo 'd-none '; ?>"><a class="page-link" href="<?= 'orders?pageNumber='.$nextPage; ?>"><?= $nextPage ?></a></li>
                        <li class="page-item <?php if ($pageNumber==$last_page) echo 'disabled ' ?>"><a class="page-link" aria-label="Next" href="<?php echo 'orders?pageNumber='.$last_page; ?>"><span aria-hidden="true">»</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>