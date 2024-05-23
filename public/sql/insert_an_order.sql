USE reussport;

INSERT INTO customer (first_name, last_name, birthday, email, phone, address)
VALUES ('John', 'Doe', '1990-01-01', 'john.doe@example.com', '123-456-7890', '123 Main St, Anytown, CA 12345');

INSERT INTO `order` (customer_id, status)
VALUES (1, 1);

INSERT INTO order_item (order_id, sku, quantity)
VALUES (1, 6, 2), (1, 10, 1);

INSERT INTO payment (order_id, method, is_paid)
VALUES (1, 1, 0);
