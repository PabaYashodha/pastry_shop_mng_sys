DROP TABLE IF EXISTS backup;

CREATE TABLE `backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(45) NOT NULL,
  `backup_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `backup_location` text NOT NULL,
  PRIMARY KEY (`backup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO backup VALUES("1","../../backup/db-backup-SatJun412-39-25CEST202","2022-06-04 16:09:25","../../backup/db-backup-SatJun412-39-25CEST2022-c057f2f3771bd6feb7203d03e3195da1.sql");



DROP TABLE IF EXISTS category;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  `category_image` text NOT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO category VALUES("1","Savory","1653571657.jpg","1"),
("2","Sweet","1653571702.jpg","1"),
("3","Drink","1653571721.png","1"),
("4","Bread","1653571736.jpg","1"),
("5","Vegetarian","1653571764.jpg","1"),
("6","Cake","1653571787.jpeg","1");



DROP TABLE IF EXISTS customer;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_fname` varchar(255) NOT NULL,
  `customer_lname` varchar(255) NOT NULL,
  `customer_contact` varchar(45) NOT NULL,
  `customer_email` varchar(45) NOT NULL,
  `customer_add1` varchar(45) NOT NULL,
  `customer_add2` varchar(255) NOT NULL,
  `customer_add3` varchar(255) NOT NULL,
  `customer_postal_code` varchar(45) NOT NULL,
  `customer_nic` varchar(45) NOT NULL,
  `customer_dob` date NOT NULL,
  `customer_gender` tinyint(4) NOT NULL,
  `customer_create_date` date NOT NULL,
  `customer_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customer_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO customer VALUES("1","Yashi","Guruge","0778816266","yashguruge@gmail.com","no 35","Imaduwa Road","Ahanagama","80650","","0000-00-00","0","0000-00-00","2022-06-02 11:22:08","1");



DROP TABLE IF EXISTS customer_login;

CREATE TABLE `customer_login` (
  `customer_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_login_username` varchar(45) NOT NULL,
  `customer_login_password` varchar(256) NOT NULL,
  `customer_login_status` tinyint(4) NOT NULL DEFAULT '1',
  `customer_customer_id` int(11) NOT NULL,
  PRIMARY KEY (`customer_login_id`),
  KEY `fk_customer_login_customer1` (`customer_customer_id`),
  CONSTRAINT `fk_customer_login_customer1` FOREIGN KEY (`customer_customer_id`) REFERENCES `customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO customer_login VALUES("1","yashguruge@gmail.com","ccb4f09f5ac2a0535acb449e6bc37b97","1","1");



DROP TABLE IF EXISTS delivery;

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_person_id` varchar(25) NOT NULL,
  `delivery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delivery_status` tinyint(4) NOT NULL DEFAULT '1',
  `ordertb_ordertb_id` int(11) NOT NULL,
  PRIMARY KEY (`delivery_id`),
  KEY `fk_delivery_ordertb1` (`ordertb_ordertb_id`),
  CONSTRAINT `fk_delivery_ordertb1` FOREIGN KEY (`ordertb_ordertb_id`) REFERENCES `ordertb` (`ordertb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS dining_table;

CREATE TABLE `dining_table` (
  `dining_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `dining_table_name` varchar(255) NOT NULL,
  `dining_table_psn_cnt` tinyint(4) NOT NULL,
  `dining_table_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dining_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS feedback;

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_cus_name` varchar(45) NOT NULL,
  `feedback_content` varchar(255) NOT NULL,
  `feedback_star_count` tinyint(4) NOT NULL,
  `feedback_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS food_item;

CREATE TABLE `food_item` (
  `food_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_item_name` varchar(45) NOT NULL,
  `food_item_unit_price` decimal(8,2) NOT NULL,
  `food_item_status` tinyint(4) NOT NULL DEFAULT '1',
  `food_item_image` text NOT NULL,
  `food_item_category_food_item_category_id` int(11) NOT NULL,
  `sub_category_sub_category_id` int(11) NOT NULL,
  PRIMARY KEY (`food_item_id`),
  KEY `fk_food_item_food_item_category1` (`food_item_category_food_item_category_id`),
  KEY `fk_food_item_sub_category1` (`sub_category_sub_category_id`),
  CONSTRAINT `fk_food_item_food_item_category1` FOREIGN KEY (`food_item_category_food_item_category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_food_item_sub_category1` FOREIGN KEY (`sub_category_sub_category_id`) REFERENCES `sub_category` (`sub_category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO food_item VALUES("1","Fish Sandwich","150.00","1","1653647534.jpg","1","1"),
("2","Egg Sandwich","100.00","1","1653573013.jpg","1","1"),
("3","Egg Pastry","150.00","1","1653573082.jpg","1","2"),
("4","Chicken Burger","300.00","1","1653573123.jpg","1","3"),
("5","Fish Bun","100.00","1","1653573165.jpg","1","4"),
("6","Chinees Roll","100.00","1","1653573199.jpg","1","5"),
("7","Chicken Pie","250.00","1","1653573255.jpg","1","6"),
("8","Chocolate Eclairs","200.00","1","1653573292.jpg","2","11"),
("9","Chocolate Muffins","200.00","1","1653573318.jpg","2","12"),
("10","Sugar Dougnuts","150.00","1","1653573366.jpg","2","13"),
("11","Tea","100.00","1","1653573407.jpg","3","7"),
("12","Avacado Juice","200.00","1","1653573441.jpg","3","8"),
("13","Kurkkan Bread","200.00","1","1653573498.jpeg","4","9"),
("14","White Bread","200.00","1","1653573560.jpg","4","10"),
("15","Samosa","50.00","1","1653574429.jpg","5","14"),
("16","Sweet Bun","70.00","1","1653574492.jpg","5","15"),
("17","Chocolate Cake","80.00","1","1653574540.jpg","6","16"),
("18","Coffee Cake","950.00","1","1653574577.jpg","6","17"),
("19","Garlic Bread","300.00","1","1653921365.jpg","4","9");



DROP TABLE IF EXISTS food_item_has_ordertb;

CREATE TABLE `food_item_has_ordertb` (
  `food_item_food_item_id` int(11) NOT NULL,
  `ordertb_ordertb_id` int(11) NOT NULL,
  `food_item_has_ordertb_qty` int(11) NOT NULL,
  `food_item_has_ordertb_product_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`food_item_food_item_id`,`ordertb_ordertb_id`),
  KEY `fk_food_item_has_ordertb_ordertb1` (`ordertb_ordertb_id`),
  CONSTRAINT `fk_food_item_has_ordertb_food_item1` FOREIGN KEY (`food_item_food_item_id`) REFERENCES `food_item` (`food_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_food_item_has_ordertb_ordertb1` FOREIGN KEY (`ordertb_ordertb_id`) REFERENCES `ordertb` (`ordertb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO food_item_has_ordertb VALUES("1","1","1","150.00"),
("2","1","1","100.00"),
("3","1","1","150.00");



DROP TABLE IF EXISTS grn;

CREATE TABLE `grn` (
  `grn_id` int(11) NOT NULL AUTO_INCREMENT,
  `grn_ref_id` varchar(45) NOT NULL,
  `grn_date` date NOT NULL,
  `grn_price` decimal(10,2) NOT NULL,
  `grn_total_discount` int(11) DEFAULT '0',
  `grn_status` tinyint(4) NOT NULL DEFAULT '1',
  `grn_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `supplier_supplier_id` int(11) NOT NULL,
  PRIMARY KEY (`grn_id`),
  KEY `fk_grn_supplier1` (`supplier_supplier_id`),
  CONSTRAINT `fk_grn_supplier1` FOREIGN KEY (`supplier_supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO grn VALUES("1","43986","2022-02-25","4000.00","0","1","2022-05-31 19:18:17","1");



DROP TABLE IF EXISTS invoice;

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invoice_sub_amount` decimal(10,2) NOT NULL,
  `invoice_discount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invoice_net_total` decimal(10,2) NOT NULL,
  `invoice_type` varchar(45) NOT NULL,
  `invoice_recieve_amount` decimal(10,2) NOT NULL,
  `invoice_balance_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invoice_made_by` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO invoice VALUES("1","2022-05-20 00:00:00","1250.00","0.00","1250.00","manual","2000.00","750.00",""),
("2","2022-05-21 18:51:56","150.00","0.00","150.00","online","150.00","0.00","1"),
("3","2022-05-22 00:00:00","1000.00","0.00","1000.00","manual","1000.00","0.00",""),
("4","2022-05-23 00:00:00","1250.00","0.00","1250.00","manual","1500.00","250.00",""),
("5","2022-05-24 00:00:00","400.00","0.00","400.00","manual","500.00","100.00",""),
("6","2022-05-25 00:00:00","950.00","0.00","950.00","manual","1000.00","50.00",""),
("7","2022-05-26 00:00:00","1000.00","0.00","1000.00","manual","1000.00","0.00",""),
("8","2022-06-03 00:00:00","1000.00","0.00","1000.00","manual","1000.00","0.00",""),
("9","2022-06-03 00:00:00","500.00","0.00","500.00","manual","500.00","0.00",""),
("10","2022-06-04 00:00:00","200.00","0.00","200.00","manual","500.00","300.00","");



DROP TABLE IF EXISTS item_release;

CREATE TABLE `item_release` (
  `item_release_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_release_date` date NOT NULL,
  `item_reference_no` varchar(10) NOT NULL,
  `item_release_to` varchar(10) NOT NULL,
  `item_release_made_by` int(11) NOT NULL,
  PRIMARY KEY (`item_release_id`),
  KEY `item_release_made_by` (`item_release_made_by`),
  CONSTRAINT `item_release_ibfk_1` FOREIGN KEY (`item_release_made_by`) REFERENCES `role` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO item_release VALUES("1","2022-02-26","REL000001","Chef","2"),
("2","2022-02-28","REL000002","Chef","2");



DROP TABLE IF EXISTS item_release_list;

CREATE TABLE `item_release_list` (
  `item_release_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_release_quantity` int(11) NOT NULL,
  `item_release_item_id` int(11) NOT NULL,
  `item_release_item_release_id` int(11) NOT NULL,
  PRIMARY KEY (`item_release_list_id`),
  KEY `item_release_item_id` (`item_release_item_id`),
  KEY `item_release_item_release_id` (`item_release_item_release_id`),
  CONSTRAINT `item_release_list_ibfk_1` FOREIGN KEY (`item_release_item_id`) REFERENCES `row_item` (`row_item_id`) ON DELETE CASCADE,
  CONSTRAINT `item_release_list_ibfk_2` FOREIGN KEY (`item_release_item_release_id`) REFERENCES `item_release` (`item_release_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO item_release_list VALUES("1","5","2","1"),
("2","5","2","2");



DROP TABLE IF EXISTS module;

CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(45) NOT NULL,
  `module_logo` text NOT NULL,
  `module_url` varchar(45) NOT NULL,
  `module_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO module VALUES("1","Dashboard","fad fa-tachometer-average","dashboard.php","1"),
("2","Order","far fa-utensils","order.php","1"),
("3","Food Item","fad fa-burger-soda","foodItem.php","1"),
("4","Stock","fal fa-container-storage","stock.php","1"),
("5","Invoice","far fa-file-invoice-dollar","invoice.php","1"),
("6","Dining Table","fad fa-chair","diningTable.php","1"),
("7","Delivery","fad fa-motorcycle","delivery.php","1"),
("8","Supplier","fad fa-people-carry","supplier.php","1"),
("9","Customer","fal fa-users","customer.php","1"),
("10","User","fad fa-user-tie","user.php","1"),
("11","Report","fad fa-file-chart-line","report.php","1"),
("12","Backup","fad fa-hdd","backup.php","1"),
("13","Password Reset","fad fa-redo","adminPasswordReset.php","1");



DROP TABLE IF EXISTS ordertb;

CREATE TABLE `ordertb` (
  `ordertb_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordertb_cus_fname` varchar(255) NOT NULL,
  `ordertb_cus_lname` varchar(255) NOT NULL,
  `ordertb_cus_contact` varchar(45) NOT NULL,
  `ordertb_cus_add1` varchar(45) NOT NULL,
  `ordertb_cus_add2` varchar(255) NOT NULL,
  `ordertb_cus_add3` varchar(45) NOT NULL,
  `ordertb_cus_postal_id` varchar(45) NOT NULL,
  `ordertb_cus_email` varchar(45) NOT NULL,
  `ordertb_order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ordertb_status` tinyint(4) NOT NULL DEFAULT '1',
  `invoice_invoice_id` int(11) NOT NULL,
  PRIMARY KEY (`ordertb_id`),
  KEY `invoice_invoice_id` (`invoice_invoice_id`),
  CONSTRAINT `ordertb_ibfk_1` FOREIGN KEY (`invoice_invoice_id`) REFERENCES `invoice` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO ordertb VALUES("1","Yashi","Guruge","0778816266","no 35","Imaduwa Road","Ahanagama","80650","yashguruge@gmail.com","2022-06-03 18:51:56","3","2");



DROP TABLE IF EXISTS role;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(45) NOT NULL,
  `role_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO role VALUES("1","Administrator","1"),
("2","Owner","1"),
("3","Waiter","1"),
("4","Cashier","1"),
("5","Delivery","1");



DROP TABLE IF EXISTS role_has_module;

CREATE TABLE `role_has_module` (
  `role_role_id` int(11) NOT NULL,
  `module_module_id` int(11) NOT NULL,
  PRIMARY KEY (`role_role_id`,`module_module_id`),
  KEY `fk_role_has_module_module1` (`module_module_id`),
  CONSTRAINT `fk_role_has_module_module1` FOREIGN KEY (`module_module_id`) REFERENCES `module` (`module_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_role_has_module_role1` FOREIGN KEY (`role_role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO role_has_module VALUES("1","1"),
("1","2"),
("1","3"),
("1","4"),
("1","5"),
("1","6"),
("1","7"),
("1","8"),
("1","9"),
("1","10"),
("1","11"),
("1","12"),
("1","13"),
("2","1"),
("2","2"),
("2","3"),
("2","4"),
("2","5"),
("2","6"),
("2","7"),
("2","8"),
("2","9"),
("2","11"),
("3","1"),
("3","2"),
("3","3"),
("3","4"),
("3","7"),
("4","1"),
("4","2"),
("4","3"),
("4","6"),
("4","7"),
("4","9"),
("5","1"),
("5","7");



DROP TABLE IF EXISTS row_item;

CREATE TABLE `row_item` (
  `row_item_id` int(15) NOT NULL AUTO_INCREMENT,
  `row_item_name` varchar(45) NOT NULL,
  `row_item_status` tinyint(4) NOT NULL DEFAULT '1',
  `row_item_reorder_level` tinyint(4) NOT NULL DEFAULT '0',
  `row_item_stock_sum` int(11) NOT NULL,
  PRIMARY KEY (`row_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO row_item VALUES("1","Sugar","1","5","0"),
("2","Flour","1","5","10"),
("3","Salt","1","2","0"),
("4","Butter","1","5","0"),
("5","Cheese","1","2","0"),
("6","Photato","1","5","0"),
("7","Onions","1","4","0"),
("8","Garlic","1","4","0"),
("9","Bread Impour","1","2","0"),
("10","Baking Powder","1","2","0"),
("11","Yeast","1","2","0"),
("12","Vanila","1","2","0"),
("13","Eggs","1","20","0"),
("14","Cinnamon","1","2","0"),
("15","Papper","1","4","0"),
("16","Coffee","1","2","0"),
("17","Tea leaf","1","4","0"),
("18","Oil","1","5","0"),
("19","Milk Powder","1","5","0"),
("20","Coco powder","1","5","0"),
("21","Chilis","1","4","0");



DROP TABLE IF EXISTS sales;

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_quantity` int(11) NOT NULL,
  `sales_food_item_unit_price` decimal(10,2) NOT NULL,
  `sales_status` tinyint(4) NOT NULL DEFAULT '1',
  `invoice_invoice_id` int(11) NOT NULL,
  `food_item_food_item_id` int(11) NOT NULL,
  PRIMARY KEY (`sales_id`),
  KEY `sales_ibfk_1` (`invoice_invoice_id`),
  KEY `food_item_food_item_id` (`food_item_food_item_id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`invoice_invoice_id`) REFERENCES `invoice` (`invoice_id`) ON DELETE CASCADE,
  CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`food_item_food_item_id`) REFERENCES `food_item` (`food_item_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO sales VALUES("1","5","150.00","1","1","10"),
("2","5","100.00","1","1","11"),
("3","10","100.00","1","3","2"),
("4","5","150.00","1","4","1"),
("5","5","100.00","1","4","11"),
("6","2","200.00","1","5","14"),
("7","1","950.00","1","6","18"),
("8","2","200.00","1","7","12"),
("9","2","300.00","1","7","4"),
("10","5","200.00","1","8","12"),
("11","5","100.00","1","9","2"),
("12","1","200.00","1","10","12");



DROP TABLE IF EXISTS stock;

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_count` int(11) NOT NULL,
  `stock_current_count` int(11) NOT NULL,
  `stock_cost_per_unit` decimal(10,2) NOT NULL,
  `stock_discount` int(11) DEFAULT NULL,
  `stock_status` tinyint(4) NOT NULL DEFAULT '1',
  `stock_mnf_date` date NOT NULL,
  `stock_exp_date` date NOT NULL,
  `stock_net_cost` decimal(8,2) NOT NULL DEFAULT '0.00',
  `row_item_row_item_id` int(15) NOT NULL,
  `grn_grn_id` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `fk_stock_grn1` (`grn_grn_id`),
  KEY `fk_row_item_row_item_id` (`row_item_row_item_id`) USING BTREE,
  CONSTRAINT `fk_stock_grn1` FOREIGN KEY (`grn_grn_id`) REFERENCES `grn` (`grn_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`row_item_row_item_id`) REFERENCES `row_item` (`row_item_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO stock VALUES("1","20","10","200.00","0","1","2022-01-30","2022-06-30","4000.00","2","1");



DROP TABLE IF EXISTS sub_category;

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_name` varchar(45) NOT NULL,
  `sub_category_image` text NOT NULL,
  `sub_category_status` tinyint(4) NOT NULL DEFAULT '1',
  `category_category_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_category_id`),
  KEY `fk_sub_category_category1` (`category_category_id`),
  CONSTRAINT `fk_sub_category_category1` FOREIGN KEY (`category_category_id`) REFERENCES `category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO sub_category VALUES("1","Sandwich","1653571950.jpg","1","1"),
("2","Pastries & Croissants","1653572031.jpg","1","1"),
("3","Burger","1653572050.jpg","1","1"),
("4","Buns","1653572075.jpg","1","1"),
("5","Rolls & Cutlets","1653572117.jpg","1","1"),
("6","Pies & Tarts","1653572170.jpg","1","1"),
("7","Hot Drinks","1653572418.jpg","1","3"),
("8","Cool Drinks","1653572438.jpg","1","3"),
("9","Healthy Bread","1653572760.jpeg","1","4"),
("10","Typical Sri Lnakan Bread","1653572806.jpg","1","4"),
("11","Eclaris","1653572882.jpeg","1","2"),
("12","Muffins","1653572904.jpeg","1","2"),
("13","Doughnuts","1653572918.jpeg","1","2"),
("14","Savory Vegetarian","1653574300.jpg","1","5"),
("15","Sweet Vegetarian","1653574338.jpg","1","5"),
("16","Cake Pieces","1653574354.jpg","1","6"),
("17","Icing Cake","1653574375.jpeg","1","6");



DROP TABLE IF EXISTS supplier;

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(45) NOT NULL,
  `supplier_contact_name` varchar(45) NOT NULL,
  `supplier_email` varchar(45) NOT NULL,
  `supplier_contact` varchar(45) NOT NULL,
  `supplier_add1` varchar(45) NOT NULL,
  `supplier_add2` varchar(255) NOT NULL,
  `supplier_add3` varchar(45) NOT NULL,
  `supplier_status` tinyint(4) NOT NULL DEFAULT '1',
  `supplier_create_date` date NOT NULL,
  `supplier_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO supplier VALUES("1","Chandrani Kodikara","Kodikara","ckodikara@gmail.com","0770041565","Digaradda ","Digaradda ","Ahangama","1","2022-05-31","2022-05-31 14:51:33"),
("2","Global Stores","Global","globalstore@gmail.com","0712287412","Main street","Main street","Weligama","1","2022-05-31","2022-05-31 18:52:59"),
("3","Dulip Super ","Dulip","dulipsuper@gmail.com","0774425163","Meegahagoda Road","Meegahagoda Road","Ahanagama","1","2022-06-04","2022-06-04 09:34:35"),
("4","Vijitha Super Center","Vijitha","vijitha@info.com","0775589159","Galle road","Galle road","Ahanagama","1","2022-06-04","2022-06-04 09:35:59"),
("5","Pathum Sales","Pathum","pathum@gmail.com","0774485791","Matara Road","Matara Road","Ahanagama","1","2022-06-04","2022-06-04 09:37:45");



DROP TABLE IF EXISTS user;

CREATE TABLE `user` (
  `user_id` varchar(255) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_lname` varchar(255) NOT NULL,
  `user_contact` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `user_add1` varchar(45) NOT NULL,
  `user_add2` varchar(255) NOT NULL,
  `user_add3` varchar(45) NOT NULL,
  `user_gender` tinyint(4) NOT NULL,
  `user_dob` date NOT NULL,
  `user_nic` varchar(45) NOT NULL,
  `user_image` text NOT NULL,
  `user_create_date` date NOT NULL,
  `user_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_status` tinyint(4) NOT NULL DEFAULT '1',
  `role_role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_user_role1` (`role_role_id`),
  CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user VALUES("EMP00001","Paba","Yashodha","0775291101","pabayashodha@gmail.com","Isura","Munidasa mawatha","Ahanagama","0","1997-10-07","977811279V","1653931508.jpg","2022-05-30","2022-05-31 12:15:57","1","1"),
("EMP00002","Chamila Sampath","Gunawardhana","0763846094","sampathgunawardhana@gmail.com","Sirigiri","Waleheenoda","Ahanagama","1","1988-07-10","887845879V","1654316122.jpg","2022-06-04","2022-06-04 09:45:22","1","2"),
("EMP00003","Pavith","Charuka","0775593037","pavithcharuka@gmail.com","31/A","Imaduwa road","Ahanagama","1","2000-10-14","205454555V","1654316264.jpg","2022-06-04","2022-06-04 09:57:40","1","5"),
("EMP00004","W.K","Sandamini","0712776940","sadamini95@gmail.com","Sasiri","Main Street","Weligama","0","1995-01-24","957155249V","1654316821.jpg","2022-06-04","2022-06-04 09:57:01","1","3"),
("EMP00005","Hasini ","Silva","0765454139","hasinisilva@gmail.com","No 25","Elukatiya Road","Ahanagama","0","1997-04-10","971577846V","1654317035.jpg","2022-06-04","2022-06-04 10:00:35","1","4"),
("EMP00006","Nanadana","Jayathilaka","0789073556","jayathilaka64@gmail.com","35/B","Meegahagoda Road","Ahanagama","1","1995-08-05","958370250V","1654317259.jpg","2022-06-04","2022-06-04 10:04:19","1","5");



DROP TABLE IF EXISTS user_login;

CREATE TABLE `user_login` (
  `user_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login_username` varchar(45) NOT NULL,
  `user_login_password` varchar(256) NOT NULL,
  `user_login_status` tinyint(4) NOT NULL DEFAULT '1',
  `user_login_pwd_change` tinyint(4) NOT NULL DEFAULT '0',
  `user_user_id` varchar(255) NOT NULL,
  PRIMARY KEY (`user_login_id`),
  KEY `fk_user_login_user1` (`user_user_id`),
  CONSTRAINT `fk_user_login_user1` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO user_login VALUES("1","pabayashodha@gmail.com","1cc7dfff5d7d0e8c7fd8fbb18f6b9c1148696f3d","1","1","EMP00001"),
("3","sampathgunawardhana@gmail.com","2f647cf011c299b3b716eea6861d5a65f55cdf03","1","0","EMP00002"),
("4","pavithcharuka@gmail.com","50ca69857cbfe5b44d55e59202f64690c7d3cb21","1","0","EMP00003"),
("5","sadamini95@gmail.com","3663a66b520bf26a993b2fa61d222fa5439af339","1","0","EMP00004"),
("6","hasinisilva@gmail.com","56040d66122480fa1c47d6e662fed96d2fbc9198","1","0","EMP00005"),
("7","jayathilaka64@gmail.com","941a8e4d978e0e5717f11b2b5cec7ef3ed7b4403","1","0","EMP00006");



DROP TABLE IF EXISTS user_view;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_view` AS select `user`.`user_id` AS `user_id`,`user`.`user_fname` AS `user_fname`,`user`.`user_lname` AS `user_lname`,`user`.`user_contact` AS `user_contact`,`user`.`user_email` AS `user_email`,`user`.`user_add1` AS `user_add1`,`user`.`user_add2` AS `user_add2`,`user`.`user_add3` AS `user_add3`,`user`.`user_gender` AS `user_gender`,`user`.`user_dob` AS `user_dob`,`user`.`user_nic` AS `user_nic`,`user`.`user_image` AS `user_image`,`user`.`user_create_date` AS `user_create_date`,`user`.`user_update_date` AS `user_update_date`,`user`.`user_status` AS `user_status`,`user`.`role_role_id` AS `role_role_id` from `user`;

INSERT INTO user_view VALUES("EMP00001","Paba","Yashodha","0775291101","pabayashodha@gmail.com","Isura","Munidasa mawatha","Ahanagama","0","1997-10-07","977811279V","1653931508.jpg","2022-05-30","2022-05-31 12:15:57","1","1"),
("EMP00002","Chamila Sampath","Gunawardhana","0763846094","sampathgunawardhana@gmail.com","Sirigiri","Waleheenoda","Ahanagama","1","1988-07-10","887845879V","1654316122.jpg","2022-06-04","2022-06-04 09:45:22","1","2"),
("EMP00003","Pavith","Charuka","0775593037","pavithcharuka@gmail.com","31/A","Imaduwa road","Ahanagama","1","2000-10-14","205454555V","1654316264.jpg","2022-06-04","2022-06-04 09:57:40","1","5"),
("EMP00004","W.K","Sandamini","0712776940","sadamini95@gmail.com","Sasiri","Main Street","Weligama","0","1995-01-24","957155249V","1654316821.jpg","2022-06-04","2022-06-04 09:57:01","1","3"),
("EMP00005","Hasini ","Silva","0765454139","hasinisilva@gmail.com","No 25","Elukatiya Road","Ahanagama","0","1997-04-10","971577846V","1654317035.jpg","2022-06-04","2022-06-04 10:00:35","1","4"),
("EMP00006","Nanadana","Jayathilaka","0789073556","jayathilaka64@gmail.com","35/B","Meegahagoda Road","Ahanagama","1","1995-08-05","958370250V","1654317259.jpg","2022-06-04","2022-06-04 10:04:19","1","5");



