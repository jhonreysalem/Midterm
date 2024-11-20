

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




INSERT INTO `cart` (`cart_id`, `user_id`, `item_id`, `quantity`) VALUES
(63, 13, 3, 1),
(67, 14, 9, 1),
(68, 14, 1, 1),
(69, 14, 2, 1);



CREATE TABLE `menuitems` (
  `item_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `menuitems` (`item_id`, `name`, `price`) VALUES
(1, 'Mozzarella Sticks with Marinara Sauce', 1599.00),
(2, 'Chicken Alfredo Pasta', 1599.00),
(3, 'Baked Salmon with Lemon Butter Sauce', 1599.00),
(4, 'Vegetable Stir-Fry with Jasmine Rice', 1599.00),
(5, 'Tiramisu', 1599.00),
(6, 'Grilled Shrimp Tacos with Chipotle Mayo', 1599.00),
(7, 'Chocolate Brownie Sundae', 1599.00),
(8, 'Buffalo Chicken Wings', 1599.00),
(9, 'Grilled Ribeye Steak with Garlic Mashed Potatoes', 1599.00),
(10, 'French Onion Soup', 1599.00),
(11, 'Garden Fresh Salad with Balsamic Dressing', 1599.00),
(12, 'House Lemonade', 1599.00);


CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `delivery_option` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `payment_method`, `delivery_option`, `order_date`) VALUES
(7, 13, 2999.00, 'CashOnDelivery', 'Epcst Food Delivery', '2024-11-19 13:16:50'),
(8, 13, 2999.00, 'CreditCard', 'Food Panda', '2024-11-19 14:17:51'),
(9, 13, 10999.00, 'CreditCard', 'Grab', '2024-11-19 15:18:52'),
(10, 13, 4999.00, 'CreditCard', 'Food Panda', '2024-11-19 16:19:53'),
(11, 14, 3999.00, 'CashOnDelivery', 'Epcst Food Delivery', '2024-11-19 18:21:55'),
(12, 15, 10999.00, 'CreditCard', 'Grab', '2024-11-19 17:20:54');


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(13, 'east.jhonreysalem@gmail.com', 'qwertyuiopasdfghjklzxcvbnm#12345QWERTY'),
(14, 'junreysalem', 'qwertyuiopasdfghjklzxcvbnm#12345QWERTY'),
(15, 'salem', 'qwertyuiopasdfghjklzxcvbnm#12345QWERTY');



ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);



ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`item_id`);


ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;


ALTER TABLE `menuitems`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;


ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `menuitems` (`item_id`);


ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

