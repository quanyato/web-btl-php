<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm mới</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" method="POST" action="addOrderItem">
                    <input class="d-none" type="number" id="orderId" name="orderId" value="<?= $order->getId() ?>">
                    <input class="d-none" type="number" id="pageNumber" name="pageNumber" value="<?= $pageNumber ?>">

                    <input class="d-none" type="number" id="newItemSku" name="newItemSku" value="">
                    <div class="col-md-8">
                        <label for="productId" class="form-label">Tên sản phẩm</label>
                        <select class="form-select" id="productId" name="productId">
                            <?php foreach ($allProduct as $product) { ?>
                                <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="size" class="form-label">Kích thước</label>
                        <select class="form-select" id="size" name="size">
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="inventoryQuantity" class="form-label">Tồn kho</label>
                        <input type="number" class="form-control" id="inventoryQuantity" name="inventoryQuantity" value="" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="itemPrice" class="form-label">Đơn giá</label>
                        <input type="number" class="form-control" id="itemPrice" name="itemPrice" value="" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="quantity" class="form-label">Số lượng</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1">
                    </div>

                    <div class="col-md-4">
                        <label for="itemTotalPrice" class="form-label">Thành tiền</label>
                        <input type="number" class="form-control" id="itemTotalPrice" name="itemTotalPrice" disabled value="">
                    </div>

                    <div id="txtHint"></div>

                    <div class="col-12 text-center mt-5 mb-3">
                        <button type="submit" class="btn btn-primary me-0 me-sm-3 mb-3 mb-sm-0">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- 
<?php
echo '<script>';
echo 'var allProduct = JSON.parse(' . json_encode($allProduct) . ');';
echo '</script>';
?> -->

<script>
    var responseArray = [];

    function formatProductSize(size) {
        switch (size) {
            case '1':
                return 'S';
            case '2':
                return 'M';
            case '3':
                return 'L';
            case '4':
                return 'XL';
            case '5':
                return 'XXL';
            default:
                return '';
        }
    }

    function ajaxChangeInventoryQuantity() {
        var sizeElement = document.getElementById('size');
        if (!sizeElement) {
            console.log('Size element not found');
            return;
        }
        var sizeValue = sizeElement.value;
        if (!sizeValue) {
            sizeValue = 1;
        }
        var inventoryItem = responseArray.find(inventoryById => parseInt(inventoryById['size']) == sizeValue);
        if (!inventoryItem) {
            console.log('No inventory item found for size:', sizeValue);
            return;
        }
        let inventoryQuantity = parseInt(inventoryItem['quantity']) > 0 ? parseInt(inventoryItem['quantity']) : 0;
        document.getElementById('inventoryQuantity').value = inventoryQuantity;
        document.getElementById('newItemSku').value = parseInt(inventoryItem['sku']);

    }

    function ajaxChangeTotalPrice() {
        document.getElementById('itemTotalPrice').value = document.getElementById('itemPrice').value * document.getElementById('quantity').value;
    }

    function ajaxChangeProductPrice() {
        document.getElementById('itemPrice').value = allProduct[document.getElementById('productId').value - 1]['price'] * 1000;
    }

    function ajaxGetInventoryInfo(productId) {
        var xmlhttp = new XMLHttpRequest();
        let listSizeContent = '';

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                responseArray = JSON.parse(this.responseText);
                responseArray.forEach(inventoryById => {
                    listSizeContent += '<option ' + (parseInt(inventoryById["quantity"]) <= 0 ? "disabled class='text-danger'" : "") + ' value="' + parseInt(inventoryById['size']) + '">' + formatProductSize(inventoryById['size']) + '</option>';
                });
                ajaxChangeInventoryQuantity();
                document.getElementById("size").innerHTML = listSizeContent;
            }
        };
        xmlhttp.open("GET", "ajaxGetInventory?productId=" + productId, true);
        xmlhttp.send();
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('productId').value = 1;
        ajaxGetInventoryInfo(document.getElementById('productId').value);
        ajaxChangeProductPrice();
        ajaxChangeTotalPrice();

        document.getElementById('productId').addEventListener('change', function() {
            ajaxGetInventoryInfo(this.value);
            ajaxChangeProductPrice();
            ajaxChangeTotalPrice();
        });

        document.getElementById('size').addEventListener('change', function() {
            ajaxChangeInventoryQuantity();
        });

        document.getElementById('quantity').addEventListener('change', function() {
            ajaxChangeTotalPrice();
        });
    });
</script>