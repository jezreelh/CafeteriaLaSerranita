-- Create database
CREATE DATABASE IF NOT EXISTS `laserranita`;
USE `laserranita`;

-- Table structure for `contactos`
DROP TABLE IF EXISTS `contactos`;
CREATE TABLE IF NOT EXISTS `contactos` (
  `contact_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(191) NOT NULL,
  `message` text NOT NULL,
  `contact_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data for table `contactos`
INSERT INTO `contactos` (`contact_id`, `name`, `email`, `phone`, `subject`, `message`, `contact_date`) VALUES
(1, 'pedro', 'dsad@sdaa.co', '5656441', 'nada', 'wads', '2024-08-13 20:17:29'),
(2, 'pedro', 'dsad@sdaa.co', '5656441', 'nada', 'in', '2024-08-13 20:19:00'),
(3, 'pedro', 'dsad@sdaa.co', '5656441', 'nada', 'ju', '2024-08-13 20:20:42');

-- Table structure for `productos`
DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `category` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data for table `productos`
INSERT INTO `productos` (`product_id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'Pechuga A La Plancha', 'Pechuga A La Plancha', 100.00, 'assets/img/products/1-pechuga.jpg', 'Platillos'),
(2, 'Milanesa', 'Milanesa', 100.00, 'assets/img/products/2-milanesa.jpg', 'Platillos'),
(3, 'Enchiladas rojas de Queso', 'Enchiladas rojas de Queso', 80.00, 'assets/img/products/3-enchiladas.jpg', 'Platillos'),
(4, 'Enchiladas Verdes de Queso', 'Enchiladas Verdes de Queso', 90.00, 'assets/img/products/4-enchiladas.jpg', 'Platillos'),
(5, 'Chuleta de Res', 'Chuleta de Res', 140.00, 'assets/img/products/5-chuleta.jpg', 'Platillos'),
(6, 'Platillo de 3 guisados', 'Platillo de 3 guisados', 80.00, 'assets/img/products/6-guisados.jpg', 'Platillos'),
(7, 'Chilaquiles sencillos', 'Chilaquiles sencillos', 60.00, 'assets/img/products/7-chilaquiles sencillos.jpg', 'Platillos'),
(8, 'Chilaquiles Montados', 'Chilaquiles Montados', 80.00, 'assets/img/products/8-chilaquiles.jpg', 'Platillos'),
(9, 'Alambre de Pollo o Res', 'Alambre de Pollo o Res', 100.00, 'assets/img/products/9-alambre.jpg', 'Platillos'),
(10, 'Wini', 'Wini', 25.00, 'assets/img/products/10-wini.jpg', 'Burritos'),
(11, 'Frijoles/Queso', 'Frijoles/Queso', 25.00, 'assets/img/products/11-frijoles.jpg', 'Burritos'),
(12, 'Huevo', 'Huevo', 25.00, 'assets/img/products/12-huevo.jpg', 'Burritos'),
(13, 'Papas con Queso', 'Papas con Queso', 25.00, 'assets/img/products/13-papas.jpg', 'Burritos'),
(14, 'Picadillo', 'Picadillo', 30.00, 'assets/img/products/14-picadillo.jpg', 'Burritos'),
(15, 'Asado', 'Asado', 30.00, 'assets/img/products/15-asado.jpg', 'Burritos'),
(16, 'Discada', 'Discada', 30.00, 'assets/img/products/16-discada.jpg', 'Burritos'),
(17, 'Chicharron', 'Chicharron', 30.00, 'assets/img/products/17-chicharron.jpg', 'Burritos'),
(18, 'Arriero', 'Arriero', 30.00, 'assets/img/products/18-arriero.jpg', 'Burritos'),
(19, 'Milanesa con Aguacate', 'Milanesa con Aguacate', 50.00, 'assets/img/products/19-milanesa.jpg', 'Burritos'),
(20, 'Pastor o Bistec', 'Pastor o Bistec', 60.00, 'assets/img/products/20-quesadilla.jpg', 'Quesadillas Montadas'),
(21, 'Guisado', 'Guisado', 50.00, 'assets/img/products/21-quesadilla.jpg', 'Quesadillas Montadas'),
(22, 'Sincronizada', 'Sincronizada', 40.00, 'assets/img/products/22-quesadilla.jpg', 'Quesadillas Montadas'),
(23, 'Frio(jamon, queso,lechuga,tomate)', 'Frio(jamon, queso,lechuga,tomate)', 30.00, 'assets/img/products/23-sandwich.jpg', 'Sandwiches'),
(24, 'Basico(Huevo torta, jamon y queso)', 'Basico(Huevo torta, jamon y queso)', 50.00, 'assets/img/products/24-sandwich.jpg', 'Sandwiches'),
(25, 'Mosquetero(Huevo estrellado, jamon, queso, y tocino)', 'Mosquetero(Huevo estrellado, jamon, queso, y tocino)', 60.00, 'assets/img/products/25-sandwich.jpg', 'Sandwiches'),
(26, 'Club(Pechuga, jamon, queso, tocino y papas fritas)', 'Club(Pechuga, jamon, queso, tocino y papas fritas)', 90.00, 'assets/img/products/26-sandwich.jpg', 'Sandwiches'),
(27, 'Sencilla', 'Hamburguesa Sencilla', 60.00, 'assets/img/products/27-hambur.jpg', 'Hamburguesas'),
(28, 'Especial', 'Hamburguesa Especial', 75.00, 'assets/img/products/28-hambur.jpg', 'Hamburguesas'),
(29, 'Doble', 'Hamburguesa Doble', 100.00, 'assets/img/products/29-hambur.jpg', 'Hamburguesas'),
(30, 'Boneless', 'Hamburguesa Boneless', 85.00, 'assets/img/products/30-hambur.jpg', 'Hamburguesas'),
(31, 'Papas fritas', 'Papas fritas al comprar una hamburguesa', 25.00, 'assets/img/products/31-papas.jpg', 'Hamburguesas'),
(32, 'Sencillos', 'Nachos Sencillos (Chicos-grandes)', 40.00, 'assets/img/products/32-nachos.jpg', 'Nachos'),
(33, 'Con Pastor', 'Nachos con Pastor (Chicos-grandes)', 60.00, 'assets/img/products/33-nachos.jpg', 'Nachos'),
(34, 'Con Bistec', 'Nachos con Bistec (Chicos-grandes)', 70.00, 'assets/img/products/34-nachos.jpg', 'Nachos'),
(35, 'Con Pollo', 'Nachos con Pollo (Chicos-grandes)', 70.00, 'assets/img/products/35-nachos.jpg', 'Nachos'),
(36, 'Papas Fritas', 'Papas Fritas', 35.00, 'assets/img/products/36-papas.jpg', 'Otros'),
(37, 'Hot dog', 'Hot dog', 25.00, 'assets/img/products/37-hotdog.jpg', 'Otros'),
(38, 'Banderilla', 'Banderilla', 30.00, 'assets/img/products/38-banderilla.jpg', 'Otros'),
(39, 'Sabritas preparadas', 'Sabritas preparadas', 55.00, 'assets/img/products/39-papas.jpg', 'Otros'),
(40, 'Sabritas con Queso', 'Sabritas con Queso', 35.00, 'assets/img/products/40-papas.jpg', 'Otros'),
(41, 'Papas Locas', 'Papas Locas', 30.00, 'assets/img/products/41-papas.jpg', 'Otros'),
(42, 'Fresas con Crema', 'Fresas con Crema', 55.00, 'assets/img/products/42-fresas.jpg', 'Otros'),
(43, 'Porcion de queso amarillo', 'Porcion de queso amarillo', 15.00, 'assets/img/products/43-queso.jpg', 'Otros'),
(44, 'Porcion de Guisado', 'Porcion de Guisado', 20.00, 'assets/img/products/44-guisado.jpg', 'Otros');

-- Table structure for `usuarios`
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('cliente','administrador') NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data for table `usuarios`
INSERT INTO `usuarios` (`user_id`, `email`, `password`, `name`, `phone`, `role`, `banned`) VALUES
(1, '23310069@utpn.edu.mx', '$2y$10$28GLZDt5QKaFT69TdQB2vOogf74.q/QFwEkpT4qqWKdj2/NMQTOb.', '23310069@utpn.edu.mx', '6564312296', 'administrador', 0),
(9, 'pedro@utpn.edu.mx', '$2y$10$/IeB02vJe50sezZ7aWeijOYmnQdj.UObvpRaGi.W4C9ryTuVmNiV.', 'pedro@utpn.edu.mx', '6564615421', 'cliente', 0),
(10, '22310032@utpn.edu.mx', '$2y$10$OmnjrFBbf/A.OZmEEieCYumSV76IglIY9m4.Pexo47m744O2elqtq', 'jysus', '6568128635', 'cliente', 0);

-- Table structure for `pedidos`
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime DEFAULT NULL,
  `status` enum('preparado','en curso','cancelado','espera') DEFAULT 'espera',
  `is_cart` tinyint(1) DEFAULT '1',
  `instructions` text,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data for table `pedidos`
INSERT INTO `pedidos` (`order_id`, `user_id`, `total_price`, `order_date`, `status`, `is_cart`, `instructions`) VALUES
(11, 1, 100.00, '2024-08-13 17:08:38', 'espera', 1, 'dsa'),
(14, 1, 130.00, '2024-08-14 08:15:03', 'cancelado', 1, 'szc'),
(26, 1, 100.00, '2024-08-14 18:52:51', 'espera', 1, 'en fa'),
(23, 1, 100.00, '2024-08-14 09:25:04', 'preparado', 1, 'Primer prueba'),
(24, 1, 100.00, '2024-08-14 10:54:37', 'preparado', 1, 'con aguacate'),
(28, 9, 90.00, '2024-08-14 19:08:52', 'preparado', 1, 'listo');

-- Table structure for `detalles_del_pedido`
DROP TABLE IF EXISTS `detalles_del_pedido`;
CREATE TABLE IF NOT EXISTS `detalles_del_pedido` (
  `order_item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`order_item_id`),
  UNIQUE KEY `unique_order_product` (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Data for table `detalles_del_pedido`
INSERT INTO `detalles_del_pedido` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(16, 10, 2, 1),
(15, 9, 15, 1),
(14, 9, 1, 1),
(18, 11, 1, 1),
(19, 5, 2, 1),
(20, 12, 1, 1),
(24, 15, 2, 1),
(22, 14, 18, 1),
(23, 14, 1, 1),
(29, 17, 3, 1),
(32, 20, 1, 1),
(31, 19, 3, 1),
(33, 21, 1, 1),
(34, 23, 2, 1),
(35, 24, 2, 1),
(38, 26, 2, 1),
(39, 28, 14, 1),
(40, 28, 15, 2);

-- Set AUTO_INCREMENT values
ALTER TABLE `contactos` AUTO_INCREMENT = 4;
ALTER TABLE `detalles_del_pedido` AUTO_INCREMENT = 41;
ALTER TABLE `pedidos` AUTO_INCREMENT = 29;
ALTER TABLE `productos` AUTO_INCREMENT = 45;
ALTER TABLE `usuarios` AUTO_INCREMENT = 11;