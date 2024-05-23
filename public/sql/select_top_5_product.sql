-- top 5 most sold products
USE reussport;

SELECT *
FROM product
ORDER BY total_sold DESC
LIMIT 5;

-- top 5 products with the least inventory
USE reussport;

SELECT p.*, SUM(i.quantity) AS total_inventory_quantity
FROM product p
INNER JOIN inventory i ON p.id = i.product_id
GROUP BY p.id
ORDER BY total_inventory_quantity ASC
LIMIT 5;