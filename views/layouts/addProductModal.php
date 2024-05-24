<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm mới</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <input class="d-none" type="number" name="productId" value="<?= $order_items[0]->getId() ?>">

                    <div class="col-md-8">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <select class="form-select" id="productId" name="productId" onchange="">
                            <option value="1">Dortmund</option>
                            <option value="2">Real</option>
                            <option value="3">Lois Griffin</option>
                            <option value="4">Joseph Swanson</option>
                            <option value="5">Glenn Quagmire</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="size" class="form-label">Kích thước</label>
                        <select class="form-select" id="size" name="size" onchange="">
                            <?php for ($x = 1; $x <= 5; $x++) { ?>
                                <option value="<?= $x ?>" <?= $x == $order_items[0]->getSize() ? 'selected' : '' ?>>
                                    <?= formatProductSize($x) ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inventoryQuantity" class="form-label">Tồn kho</label>
                        <input type="number" class="form-control" id="inventoryQuantity" name="inventoryQuantity" value="50" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="price" class="form-label">Đơn giá</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?= formatMoney($order_items[0]->getPrice() * 1000, '') ?>" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                    </div>

                    <div class="col-md-4">
                        <label for="totalPrice" class="form-label">Thành tiền</label>
                        <input type="number" class="form-control" id="totalPrice" name="totalPrice" disabled value="">
                    </div>

                    <div class="col-12 text-center mt-5 mb-3">
                        <button type="submit" class="btn btn-primary me-0 me-sm-3 mb-3 mb-sm-0">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>