USE reussport;

-- Thêm nhiều khách hàng vào bảng customer
INSERT INTO customer (first_name, last_name, birthday, email, phone, address)
VALUES 
('Alice', 'Smith', '1990-01-01', 'alice.smith@example.com', '1234567890', '123 Main St'),
('Bob', 'Johnson', '1991-02-02', 'bob.johnson@example.com', '1234567891', '456 Elm St'),
('Charlie', 'Williams', '1992-03-03', 'charlie.williams@example.com', '1234567892', '789 Oak St'),
('David', 'Jones', '1993-04-04', 'david.jones@example.com', '1234567893', '101 Pine St'),
('Eva', 'Brown', '1994-05-05', 'eva.brown@example.com', '1234567894', '202 Maple St'),
('Frank', 'Davis', '1995-06-06', 'frank.davis@example.com', '1234567895', '303 Birch St'),
('Grace', 'Miller', '1996-07-07', 'grace.miller@example.com', '1234567896', '404 Cedar St'),
('Hank', 'Wilson', '1997-08-08', 'hank.wilson@example.com', '1234567897', '505 Spruce St'),
('Ivy', 'Moore', '1998-09-09', 'ivy.moore@example.com', '1234567898', '606 Aspen St'),
('Jack', 'Taylor', '1999-10-10', 'jack.taylor@example.com', '1234567899', '707 Redwood St');

-- Thêm nhiều đơn hàng vào bảng order
INSERT INTO `order` (customer_id, status)
VALUES 
(1, 4),
(2, 4),
(3, 4),
(4, 5),
(5, 3),
(6, 3),
(7, 2),
(8, 1),
(9, 1),
(10, 1);

-- Thêm nhiều mục đơn hàng vào bảng order_item
INSERT INTO order_item (order_id, sku, quantity)
VALUES 
(1, 6, 2),
(1, 7, 1),
(2, 6, 4),
(2, 9, 2),
(3, 9, 3),
(3, 6, 1),
(4, 7, 5),
(4, 8, 3),
(5, 9, 2),
(5, 10, 1),
(6, 10, 4),
(6, 12, 2),
(7, 12, 3),
(7, 14, 1),
(8, 16, 5),
(8, 15, 3),
(9, 17, 2),
(9, 5, 1),
(10, 9, 4),
(10, 8, 2);

-- Thêm nhiều khoản thanh toán vào bảng payment
INSERT INTO payment (order_id, method, is_paid)
VALUES 
(1, 1, TRUE),
(2, 2, TRUE),
(3, 1, FALSE),
(4, 2, TRUE),
(5, 1, FALSE),
(6, 2, TRUE),
(7, 1, TRUE),
(8, 2, FALSE),
(9, 1, TRUE),
(10, 2, TRUE);
