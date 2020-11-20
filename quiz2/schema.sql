CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11),
  `item_id` int(11),
  `discount` decimal(3,2),
  PRIMARY KEY (`id`),
  KEY `FK_discounts_items` (`item_id`),
  CONSTRAINT `FK_discounts_items` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `discounts` (`id`, `item_id`, `discount`) VALUES
	(1, 1, 0.25),
	(2, 2, 0.50),
	(3, 3, 0.75),
	(4, 5, 0.10);

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11),
  `name` varchar(255),
  `price` decimal(6,2),
  PRIMARY KEY (`id`)
);

INSERT INTO `items` (`id`, `name`, `price`) VALUES
	(1, 'MacBook Pro', 1299.99),
	(2, 'OpenBSD Tshirt', 20.00),
	(3, 'Amazon echo', 99.99),
	(4, 'Nvidia GTX 2080 Ti', 1499.99),
	(5, 'AMD Ryzen 9 3900X', 549.99);
