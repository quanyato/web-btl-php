<?php
$title = "Orders page";
$page = "orders";
include 'views/layouts/header.php';
?>

<div class="card shadow">
    <div class="card-header py-3">
        <div class="row">
            <h4 class="text-primary m-0 mb-2 mb-lg-0 fw-bold col-lg-4">Đơn hàng</h4>
            <div class="dataTables_filter col-lg-4" id="dataTable_filter">
                <label class="form-label w-100">
                    <input type="search" class="form-control form-control-sm w-100" aria-controls="dataTable" placeholder="Nhập mã đơn hàng">
                </label>
            </div>
            <div class="col-lg-4 text-lg-end text-nowrap">
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
            </div>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-md-6 align-self-center">
                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Đơn hàng 1 đến 10 trong 27</p>
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