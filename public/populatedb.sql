/* Category table */
INSERT INTO category(categoryName, categoryDesc)
VALUES  ("Hoodie", "Men and Women Hoodies"),
        ("Jean", "Men and Women Jeans"),
        ("Jogger", "Men and Women Joggers"),
        ("Shoes", "Men and Women Shoes"),
        ("Sportswear", "Men and Women Sportswear"),
        ("Trousers", "Men and Women Trousers"),
        ("Shirt", "Men Shirts"),
        ("T-shirt", "Men T-shirts"),
        ("Blouse", "Women Blouses"),
        ("Dress", "Women Dresses");

/* Product table */
/* Men completed */
/* Women not yet */
INSERT INTO product(prodName, prodDesc, unitPrice, discount, picture, categoryId)
VALUES  ("Men-Hoodie", "Made with highest quality cotton for your comfort", "100", "0", "Men/Hoodies/41.png", 1),
        ("Men-Hoodie", "Made with highest quality cotton for your comfort", "100", "0", "Men/Hoodies/42.png", 1),
        ("Men-Hoodie", "Made with highest quality cotton for your comfort", "100", "0", "Men/Hoodies/43.png", 1),
        ("Men-Hoodie", "Made with highest quality cotton for your comfort", "100", "0", "Men/Hoodies/44.png", 1),
        ("Men-Hoodie", "Made with highest quality cotton for your comfort", "100", "0", "Men/Hoodies/45.png", 1),
        ("Men-Jeans", "Casual trendy Jeans", "200", "0", "Men/Jeans/51.png", 2),
        ("Men-Jeans", "Casual trendy Jeans", "200", "0", "Men/Jeans/52.png", 2),
        ("Men-Jeans", "Casual trendy Jeans", "200", "0", "Men/Jeans/53.png", 2),
        ("Men-Jeans", "Casual trendy Jeans", "200", "0", "Men/Jeans/54.png", 2),
        ("Men-Jeans", "Casual trendy Jeans", "200", "0", "Men/Jeans/55.png", 2),
        ("Men-Joggers", "Stretchy 100% cotton Joggers", "150", "0", "Men/Joggers/71.png", 3),
        ("Men-Joggers", "Stretchy 100% cotton Joggers", "150", "0", "Men/Joggers/72.png", 3),
        ("Men-Joggers", "Stretchy 100% cotton Joggers", "150", "0", "Men/Joggers/73.png", 3),
        ("Men-Joggers", "Stretchy 100% cotton Joggers", "150", "0", "Men/Joggers/74.png", 3),
        ("Men-Joggers", "Stretchy 100% cotton Joggers", "150", "0", "Men/Joggers/75.png", 3),
        ("Men-Shirts", "Simple Shirts with a modern look", "250", "0", "Men/Shirts/46.png", 7),
        ("Men-Shirts", "Simple Shirts with a modern look", "250", "0", "Men/Shirts/47.png", 7),
        ("Men-Shirts", "Simple Shirts with a modern look", "250", "0", "Men/Shirts/48.png", 7),
        ("Men-Shirts", "Simple Shirts with a modern look", "250", "0", "Men/Shirts/49.png", 7),
        ("Men-Shirts", "Simple Shirts with a modern look", "250", "0", "Men/Shirts/50.png", 7),
        ("Men-Shoes", "Top of the line shoes for maximum comfort", "1250", "0", "Men/Shoes/61.png", 4),
        ("Men-Shoes", "Top of the line shoes for maximum comfort", "1250", "0", "Men/Shoes/62.png", 4),
        ("Men-Shoes", "Top of the line shoes for maximum comfort", "1250", "0", "Men/Shoes/63.png", 4),
        ("Men-Shoes", "Top of the line shoes for maximum comfort", "1250", "0", "Men/Shoes/64.png", 4),
        ("Men-Shoes", "Top of the line shoes for maximum comfort", "1250", "0", "Men/Shoes/65.png", 4),
        ("Men-Sportswear", "Absorbs well. Perfect for any activity", "875", "0", "Men/Sportswear/66.png", 5),
        ("Men-Sportswear", "Absorbs well. Perfect for any activity", "875", "0", "Men/Sportswear/67.png", 5),
        ("Men-Sportswear", "Absorbs well. Perfect for any activity", "875", "0", "Men/Sportswear/68.png", 5),
        ("Men-Sportswear", "Absorbs well. Perfect for any activity", "875", "0", "Men/Sportswear/69.png", 5),
        ("Men-Sportswear", "Absorbs well. Perfect for any activity", "875", "0", "Men/Sportswear/70.png", 5),
        ("Men-Trousers", "Sleek and fresh look", "500", "0", "Men/Trousers/56.png", 6),
        ("Men-Trousers", "Sleek and fresh look", "500", "0", "Men/Trousers/57.png", 6),
        ("Men-Trousers", "Sleek and fresh look", "500", "0", "Men/Trousers/58.png", 6),
        ("Men-Trousers", "Sleek and fresh look", "500", "0", "Men/Trousers/59.png", 6),
        ("Men-Trousers", "Sleek and fresh look", "500", "0", "Men/Trousers/60.png", 6),
        ("Men-TShirts", "Relaxed fit crewneck T-Shirts", "150", "0", "Men/TShirts/36.png", 8),
        ("Men-TShirts", "Relaxed fit crewneck T-Shirts", "150", "0", "Men/TShirts/37.png", 8),
        ("Men-TShirts", "Relaxed fit crewneck T-Shirts", "150", "0", "Men/TShirts/38.png", 8),
        ("Men-TShirts", "Relaxed fit crewneck T-Shirts", "150", "0", "Men/TShirts/39.png", 8),
        ("Men-TShirts", "Relaxed fit crewneck T-Shirts", "150", "0", "Men/TShirts/40.png", 8);


/* Inventory table */
/* Men incomplete: Up to productid=14 */
/* Women not yet */
INSERT INTO inventory(productId, size, colour, reOrderLevel, stockLevel)
VALUES  (1, "S", "Blue", 10, 100),
        (1, "S", "Red", 10, 100),
        (1, "M", "Blue", 10, 100),
        (1, "M", "Red", 10, 100),
        (1, "L", "Blue", 10, 100),
        (1, "L", "Red", 10, 100),
        (2, "S", "Blue", 10, 100),
        (2, "S", "Red", 10, 100),
        (2, "M", "Blue", 10, 100),
        (2, "M", "Red", 10, 100),
        (2, "L", "Blue", 10, 100),
        (2, "L", "Red", 10, 100),
        (3, "S", "Blue", 10, 100),
        (3, "S", "Red", 10, 100),
        (3, "M", "Blue", 10, 100),
        (3, "M", "Red", 10, 100),
        (3, "L", "Blue", 10, 100),
        (3, "L", "Red", 10, 100),
        (4, "S", "Blue", 10, 100),
        (4, "S", "Red", 10, 100),
        (4, "M", "Blue", 10, 100),
        (4, "M", "Red", 10, 100),
        (4, "L", "Blue", 10, 100),
        (4, "L", "Red", 10, 100),
        (5, "S", "Blue", 10, 100),
        (5, "S", "Red", 10, 100),
        (5, "M", "Blue", 10, 100),
        (5, "M", "Red", 10, 100),
        (5, "L", "Blue", 10, 100),
        (5, "L", "Red", 10, 100),
        (6, "S", "Blue", 10, 100),
        (6, "S", "Red", 10, 100),
        (6, "M", "Blue", 10, 100),
        (6, "M", "Red", 10, 100),
        (6, "L", "Blue", 10, 100),
        (6, "L", "Red", 10, 100),
        (7, "S", "Blue", 10, 100),
        (7, "S", "Red", 10, 100),
        (7, "M", "Blue", 10, 100),
        (7, "M", "Red", 10, 100),
        (7, "L", "Blue", 10, 100),
        (7, "L", "Red", 10, 100),
        (8, "S", "Blue", 10, 100),
        (8, "S", "Red", 10, 100),
        (8, "M", "Blue", 10, 100),
        (8, "M", "Red", 10, 100),
        (8, "L", "Blue", 10, 100),
        (8, "L", "Red", 10, 100),
        (9, "S", "Blue", 10, 100),
        (9, "S", "Red", 10, 100),
        (9, "M", "Blue", 10, 100),
        (9, "M", "Red", 10, 100),
        (9, "L", "Blue", 10, 100),
        (9, "L", "Red", 10, 100),
        (10, "S", "Blue", 10, 100),
        (10, "S", "Red", 10, 100),
        (10, "M", "Blue", 10, 100),
        (10, "M", "Red", 10, 100),
        (10, "L", "Blue", 10, 100),
        (10, "L", "Red", 10, 100),
        (11, "S", "Blue", 10, 100),
        (11, "S", "Red", 10, 100),
        (11, "M", "Blue", 10, 100),
        (11, "M", "Red", 10, 100),
        (11, "L", "Blue", 10, 100),
        (11, "L", "Red", 10, 100),
        (12, "S", "Blue", 10, 100),
        (12, "S", "Red", 10, 100),
        (12, "M", "Blue", 10, 100),
        (12, "M", "Red", 10, 100),
        (12, "L", "Blue", 10, 100),
        (12, "L", "Red", 10, 100),
        (13, "S", "Blue", 10, 100),
        (13, "S", "Red", 10, 100),
        (13, "M", "Blue", 10, 100),
        (13, "M", "Red", 10, 100),
        (13, "L", "Blue", 10, 100),
        (13, "L", "Red", 10, 100),
        (14, "S", "Blue", 10, 100),
        (14, "S", "Red", 10, 100),
        (14, "M", "Blue", 10, 100),
        (14, "M", "Red", 10, 100),
        (14, "L", "Blue", 10, 100),
        (14, "L", "Red", 10, 100);

/* PaymentInfo table */
/* One used for all orders */
INSERT INTO paymentinfo(creditCardpin, creditCardNo)
VALUES  (1234, 1234567);

/* Orders table */
/* For one user */
INSERT INTO orders(status, orderDate, creditCardNo, username)
VALUES  ("Pending", "2022-03-25", 1234567, "hdsmathew"),
        ("Delivered", "2022-03-23", 1234567, "hdsmathew"),
        ("Pending", "2022-03-25", 1234567, "hdsmathew"),
        ("Delivered", "2022-03-22", 1234567, "hdsmathew"),
        ("Pending", "2022-03-25", 1234567, "hdsmathew");

/* OrderItems table */
INSERT INTO orderitems(orderId, productId, size, colour, quantity, unitPrice, discount, reviewed)
VALUES  (1, 1, "M", "Blue", 1, 100, 0, 1),
        (1, 6, "L", "Red", 2, 200, 0, 0),
        (1, 12, "S", "Blue", 3, 150, 0, 0),
        (1, 14, "S", "Blue", 2, 1250, 0, 1),
        (2, 1, "M", "Blue", 1, 100, 0, 0),
        (2, 6, "L", "Red", 2, 200, 0, 0),
        (2, 7, "L", "Red", 1, 875, 0, 0),
        (2, 9, "M", "Blue", 2, 500, 0, 0),
        (3, 1, "M", "Blue", 1, 100, 0, 0),
        (3, 6, "L", "Red", 2, 200, 0, 0),
        (3, 12, "S", "Blue", 3, 150, 0, 0),
        (4, 12, "S", "Blue", 3, 150, 0, 0),
        (4, 1, "S", "Blue", 2, 1250, 0, 1),
        (4, 14, "L", "Red", 1, 875, 0, 1),
        (4, 10, "M", "Blue", 2, 500, 0, 1),
        (5, 1, "M", "Blue", 1, 100, 0, 0),
        (5, 6, "L", "Red", 2, 200, 0, 0),
        (5, 12, "S", "Blue", 3, 150, 0, 0);


/* Review table */
/* Only for Delivered orders */
INSERT INTO review(productId, postedOn, reviewDesc, flag, rating, customerid)
VALUES  (1, "2022-03-30", "Nice!", 0, 1, 1),
        (14, "2022-03-30", "Very Nice!", 0, 2, 1),
        (14, "2022-03-25", "Very Very Nice!", 0, 3, 1),
        (1, "2022-03-25", "Nice Nice!", 0, 4, 1),
        (10, "2022-03-30", "Nice Nice Nice!", 0, 5, 1);


/* Cart table */
/* For one username */
INSERT INTO cart(username, productId, size, colour, unitPrice, discount, quantity)
VALUES  ("hdsmathew", 13, "M", "Blue", 150, 0, 2),
        ("hdsmathew", 2, "M", "Red", 100, 0, 2),   
        ("hdsmathew", 3, "L", "Red", 100, 0, 2),   
        ("hdsmathew", 4, "S", "Blue", 100, 0, 2),   
        ("hdsmathew", 6, "S", "Blue", 200, 0, 2),   
        ("hdsmathew", 11, "M", "Blue", 150, 0, 2);