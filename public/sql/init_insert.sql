USE reussport;

-- product insert
INSERT INTO product (name, price, primary_img)
VALUES ('Áo Dortmund kỷ niệm chung kết C1 2024', 150.000, 'img/products/c12024-dortmund.jpg'),
('Áo Real Madrid kỷ niệm chung kết C1 2024', 150.000, 'img/products/c12024-real.jpg'),
('Áo Euro 2024 đội tuyển Croatia sân khách', 175.000, 'img/products/euro2024-croatia.jpg'),
('Áo Euro 2024 đội tuyển Bồ Đào Nha sân nhà', 175.000, 'img/products/euro2024-portugal.jpg'),
('Áo Euro 2024 đội tuyển Đức sân nhà', 175.000, 'img/products/euro2024-germany.webp');

-- inventory auto insert 20 items for each product with size 1-5 (S, M, L, XL, XXL)
INSERT INTO inventory (product_id, size, quantity)
SELECT id, size, 20
FROM product
CROSS JOIN
(
    SELECT 1 AS size
    UNION ALL
    SELECT 2
    UNION ALL
    SELECT 3
    UNION ALL
    SELECT 4
    UNION ALL
    SELECT 5
) AS sizes;
