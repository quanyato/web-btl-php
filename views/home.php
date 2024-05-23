<?php
$title = "Home Page";
$page = "home";
include 'views/layouts/header.php';
?>

<!-- Page-specific content -->
<div class="d-sm-flex justify-content-between align-items-center mb-4">
    <h3 class="text-dark mb-0">Trang chủ</h3>
</div>
<div class="row">
    <!-- so hoa don hom nay -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-info py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Đơn hàng (Hôm nay)</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $todayOrders; ?></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-file fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- doanh thu hom nay -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-warning py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Doanh thu (Hôm nay)</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $todayRevenue==0 ? 0 : formatMoney($todayRevenue*1000, ' vnđ') ;?></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- doanh thu thang nay -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-primary py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Doanh thu (Tháng này)</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $monthlyRevenue==0 ? 0 : formatMoney($monthlyRevenue*1000, ' vnđ') ;?></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- doanh thu nam nay -->
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Doanh thu (Năm nay)</span></div>
                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $yearlyRevenue==0 ? 0 : formatMoney($yearlyRevenue*1000, ' vnđ') ;?></span></div>
                    </div>
                    <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold m-0">Bán chạy nhất</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Tên</th>
                            <th scope="col">Đã bán</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top5MostSoldProducts as $product) { ?>
                            <tr>
                                <th scope="row"><img class="rounded-circle me-2" width="30" height="30" src="public/<?php echo $product->getImg() ?>"></th>
                                <td><?php echo $product->getName() ?></td>
                                <td><?php echo $product->getTotalSold() ?></td>
                                <td><?php echo formatMoney($product->getTotalSold() * $product->getPrice()); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-warning fw-bold m-0">Tồn kho ít nhất</h6>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Tên</th>
                            <th scope="col">Tồn kho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($top5LeastQuantityProducts as $product) { ?>
                            <tr>
                                <th scope="row"><img class="rounded-circle me-2" width="30" height="30" src="public/<?php echo $product->getImg() ?>"></th>
                                <td><?php echo $product->getName() ?></td>
                                <td><?php echo $product->getTotalQuantity() ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
include 'views/layouts/footer.php';
?>