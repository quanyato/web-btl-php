USE reussport;

-- Cập nhật thông tin sản phẩm trong bảng product
UPDATE product
SET name = 'product name', price = 00.00, total_sold = 0, primary_img = 'path/image.jpg'
WHERE id = 1;

-- Cập nhật số lượng tồn kho trong bảng inventory
UPDATE inventory
SET quantity = 0
WHERE sku = 1;

-- Cập nhật thông tin khách hàng trong bảng customer
UPDATE customer
SET first_name = 'name', last_name = 'name', birthday = '1999-01-01', email = 'email@example.com', phone = '987654321', address = '456 Another St'
WHERE id = 1;

-- Cập nhật trạng thái đơn hàng trong bảng order
UPDATE `order`
SET status = 1, total_price = 00.00
WHERE id = 1;

-- Cập nhật số lượng sản phẩm trong mục đơn hàng bảng order_item
UPDATE order_item
SET quantity = 0
WHERE id = 1;

-- Cập nhật thông tin thanh toán trong bảng payment
UPDATE payment
SET method = 2, is_paid = FALSE
WHERE id = 1;
