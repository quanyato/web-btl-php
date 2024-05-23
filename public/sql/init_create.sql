CREATE DATABASE reussport;
    -- CHARACTER SET utf8mb4
    -- COLLATE utf8mb4_unicode_ci;
USE reussport;

CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    total_sold INT NOT NULL DEFAULT 0, -- Nhằm thuận tiện trong việc thống kê số lượng bán
    primary_img VARCHAR(255) -- một hình ảnh đại diện duy nhất cho sản phẩm
);

CREATE TABLE inventory (
    sku INT AUTO_INCREMENT PRIMARY KEY, -- Stock Keeping Unit để quản lý hàng tồn kho theo size, mẫu mã cho sản phẩm
    product_id INT,
    size INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product(id)
);


CREATE TABLE customer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birthday DATE,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL
);

CREATE TABLE `order` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status INT NOT NULL DEFAULT 1, -- một số trạng thái đơn hàng được đề xuất trong file readme.txt
    total_price DECIMAL(10, 2) NOT NULL DEFAULT 0,
    FOREIGN KEY (customer_id) REFERENCES customer(id)
);

CREATE TABLE order_item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    sku INT, -- khi đặt hàng ta đặt theo size, mẫu mã, màu cụ thể; do đó ta cần dùng sku thay vì product_id
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES `order`(id),
    FOREIGN KEY (sku) REFERENCES inventory(sku)
);

CREATE TABLE payment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    method INT NOT NULL, -- Phương thức thanh toán tiền mặt, chuyển khoản, thẻ tín dụng, ...
    is_paid BOOLEAN NOT NULL,
    FOREIGN KEY (order_id) REFERENCES `order`(id)
);

-- tao trigger order_item tu dong cap nhat inventory, product
DELIMITER //

CREATE TRIGGER trg_after_insert_order_item
AFTER INSERT ON order_item
FOR EACH ROW
BEGIN
    UPDATE inventory
    SET quantity = quantity - NEW.quantity
    WHERE sku = NEW.sku;

    UPDATE product
    SET total_sold = total_sold + NEW.quantity
    WHERE id = (
        SELECT product_id
        FROM inventory
        WHERE sku = NEW.sku
    );

    UPDATE `order`
    SET total_price = total_price + (NEW.quantity * (
        SELECT price
        FROM product
        WHERE id = (
            SELECT product_id
            FROM inventory
            WHERE sku = NEW.sku
        )
    ))
    WHERE id = NEW.order_id;
END;
//

CREATE TRIGGER trg_after_delete_order_item
AFTER DELETE ON order_item
FOR EACH ROW
BEGIN
    UPDATE inventory
    SET quantity = quantity + OLD.quantity
    WHERE sku = OLD.sku;

    UPDATE product
    SET total_sold = total_sold - OLD.quantity
    WHERE id = (
        SELECT product_id
        FROM inventory
        WHERE sku = OLD.sku
    );

    UPDATE `order`
    SET total_price = total_price - (OLD.quantity * (
        SELECT price
        FROM product
        WHERE id = (
            SELECT product_id
            FROM inventory
            WHERE sku = OLD.sku
        )
    ))
    WHERE id = OLD.order_id;
END;
//

CREATE TRIGGER trg_after_update_order_item
AFTER UPDATE ON order_item
FOR EACH ROW
BEGIN
    IF OLD.quantity <> NEW.quantity THEN
        SET @delta_quantity = NEW.quantity - OLD.quantity;
        SET @delta_price = (SELECT price FROM product WHERE id = (
            SELECT product_id FROM inventory WHERE sku = NEW.sku
        )) * @delta_quantity;

        UPDATE inventory
        SET quantity = quantity - @delta_quantity
        WHERE sku = NEW.sku;

        UPDATE product
        SET total_sold = total_sold + @delta_quantity
        WHERE id = (
            SELECT product_id
            FROM inventory
            WHERE sku = NEW.sku
        );

        UPDATE `order`
        SET total_price = total_price + @delta_price
        WHERE id = NEW.order_id;
    END IF;
END;
//

DELIMITER ;
