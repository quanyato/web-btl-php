USE reussport;

-- Xóa một sản phẩm khỏi bảng product
DELETE FROM product
WHERE id = 1;

-- Xóa một mục khỏi bảng inventory
DELETE FROM inventory
WHERE sku = 1;

-- Xóa một khách hàng khỏi bảng customer
DELETE FROM customer
WHERE id = 1;

-- Xóa một đơn hàng khỏi bảng order
DELETE FROM `order`
WHERE id = 1;

-- Xóa một mục đơn hàng khỏi bảng order_item
DELETE FROM order_item
WHERE id = 1;

-- Xóa một khoản thanh toán khỏi bảng payment
DELETE FROM payment
WHERE id = 1;
