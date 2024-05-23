USE reussport;

-- Thêm một sản phẩm mới vào bảng product
INSERT INTO product (name, price, total_sold, primary_img)
VALUES ('Product Name', 99.99, 0, 'path/to/image.jpg');

-- Thêm một mục mới vào bảng inventory
INSERT INTO inventory (product_id, size, quantity)
VALUES (1, 5, 100);

-- Thêm một khách hàng mới vào bảng customer
INSERT INTO customer (first_name, last_name, birthday, email, phone, address)
VALUES ('John', 'Doe', '1990-01-01', 'john.doe@example.com', '123456789', '123 Main St');

-- Thêm một đơn hàng mới vào bảng order
INSERT INTO `order` (customer_id, status, total_price)
VALUES (1, 1, 0.00);

-- Thêm một mục đơn hàng mới vào bảng order_item
INSERT INTO order_item (order_id, sku, quantity)
VALUES (1, 1, 2);

-- Thêm một khoản thanh toán mới vào bảng payment
INSERT INTO payment (order_id, method, is_paid)
VALUES (1, 1, TRUE);
