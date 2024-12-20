/*
SQLyog Community v13.3.0 (64 bit)
MySQL - 10.4.32-MariaDB : Database - newtecbox
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`newtecbox` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `newtecbox`;

/*Table structure for table `entradas` */

DROP TABLE IF EXISTS `entradas`;

CREATE TABLE `entradas` (
  `ID_Entradas` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Usuarios` int(11) DEFAULT NULL,
  `ID_Productos` int(11) DEFAULT NULL,
  `Accion` enum('entrada','salida') DEFAULT NULL,
  `Fecha_Accion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Entradas`),
  KEY `ID_Productos` (`ID_Productos`),
  KEY `ID_Usuarios` (`ID_Usuarios`),
  CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`ID_Productos`) REFERENCES `productos` (`ID_Producto`),
  CONSTRAINT `entradas_ibfk_2` FOREIGN KEY (`ID_Usuarios`) REFERENCES `usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `entradas` */

insert  into `entradas`(`ID_Entradas`,`ID_Usuarios`,`ID_Productos`,`Accion`,`Fecha_Accion`) values 
(1,1,1,'entrada','2024-12-15 09:00:00'),
(2,2,2,'entrada','2024-12-15 10:00:00'),
(3,3,3,'salida','2024-12-15 11:00:00'),
(4,1,8,'entrada','2024-12-16 00:00:00');

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `ID_Producto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Caracteristicas` text DEFAULT NULL,
  `Requisicion` varchar(100) NOT NULL,
  `Partida_Presupuestal` varchar(100) NOT NULL,
  `Hora_Entrada` time NOT NULL,
  `Hora_Salida` time NOT NULL,
  `Departamento_Solicitante` varchar(255) NOT NULL,
  `Responsable` varchar(255) NOT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Producto`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `productos` */

insert  into `productos`(`ID_Producto`,`Nombre`,`Precio`,`Caracteristicas`,`Requisicion`,`Partida_Presupuestal`,`Hora_Entrada`,`Hora_Salida`,`Departamento_Solicitante`,`Responsable`,`Fecha_Registro`) values 
(1,'Laptop Dell XPS 14',1900.00,'Procesador Intel i7, 16GB RAM, 512GB SSD','REQ1234','PB1001','10:00:00','17:00:00','Tecnologia','Juan Perez','2024-12-15 19:58:15'),
(2,'Monitor Samsung 24\"',300.00,'Resolución 1920x1080, Panel LED','REQ1235','PB1002','10:00:00','18:00:00','Diseño Grafico','Maria Garcia','2024-12-15 19:58:15'),
(3,'Teclado Logitech G Pro',100.00,'Teclado mecánico RGB, Switches Romer-G','REQ1236','PB1003','08:30:00','16:30:00','Soporte','Carlos Lopez','2024-12-15 19:58:15'),
(4,'Mouse Logitech G502',60.00,'Mouse gaming con 11 botones programables, RGB','REQ1237','PB1004','08:30:00','16:30:00','Soporte','Laura Martinez','2024-12-16 00:29:25'),
(5,'Monitor Dell UltraSharp U2720Q',400.00,'Monitor 27\" 4K, panel IPS, USB-C','REQ1238','PB1005','08:00:00','17:00:00','TI','David Garcia','2024-12-16 00:29:25'),
(6,'Laptop HP EliteBook 850',1200.00,'Laptop empresarial, i7, 16GB RAM, 512GB SSD','REQ1239','PB1006','09:00:00','18:00:00','Ventas','Marta Ruiz','2024-12-16 00:29:25'),
(7,'Impresora HP LaserJet Pro',150.00,'Impresora láser monocromática, 30 ppm','REQ1240','PB1007','08:00:00','16:00:00','Contabilidad','Juan Pérez','2024-12-16 00:29:25'),
(8,'Silla Ergonomica Herman Miller',350.00,'Silla ergonómica, ajuste lumbar y de altura','REQ1241','PB1008','08:30:00','16:30:00','RH','Ana Gomez','2024-12-16 00:29:25'),
(9,'Pantalla LED Samsung 32\"',250.00,'Pantalla 32\" Full HD, entrada HDMI y DisplayPort','REQ1242','PB1009','09:00:00','17:00:00','Marketing','Luis Fernandez','2024-12-16 00:29:25'),
(10,'Webcam Logitech C920',80.00,'Webcam HD 1080p con micrófono integrado','REQ1243','PB1010','08:00:00','16:30:00','Soporte','Carlos Lopez','2024-12-16 00:29:25'),
(11,'Proyector Epson EB-L1000',1200.00,'Proyector 4K, 5500 lúmenes, resolución WUXGA','REQ1244','PB1011','09:00:00','18:00:00','Dirección','Jose García','2024-12-16 00:29:25'),
(12,'Router TP-Link Archer AX6000',200.00,'Router Wi-Fi 6, 8 puertos LAN, 6000 Mbps','REQ1245','PB1012','08:00:00','16:00:00','IT','Miguel Sánchez','2024-12-16 00:29:25'),
(13,'Disco Duro Externo Seagate 2TB',100.00,'Disco duro externo USB 3.0, 2TB','REQ1246','PB1013','08:30:00','17:00:00','Logística','Pedro Ruiz','2024-12-16 00:29:25'),
(14,'HP Cartucho de tinta 667 Tricolor Original (3YM78AL) Para HP DeskJet Ink Advantage',279.00,'Cartucho de Tinta para Impresora\r\nCompatibilidad de hardware: HP Deskjet Plus Ink Advantage 6000, HP DeskJet Plus Ink Advantage 6400, and HP Deskjet Ink Advantage 1200 series printers and HP Deskjet Ink Advantage 2300, HP Deskjet Ink Advantage 2700, and HP DeskJet Ink Advantage 4100 All-in-One printers','REQ161224','PB1000','09:22:00','00:00:00','','','2024-12-16 09:20:04'),
(15,'HP Cartucho de tinta 667 Tricolor Original (3YM78AL) Para HP DeskJet Ink Advantage',279.00,'Cartucho de Tinta para Impresora\r\nCompatibilidad de hardware: HP Deskjet Plus Ink Advantage 6000, HP DeskJet Plus Ink Advantage 6400, and HP Deskjet Ink Advantage 1200 series printers and HP Deskjet Ink Advantage 2300, HP Deskjet Ink Advantage 2700, and HP DeskJet Ink Advantage 4100 All-in-One printers','REQ161224','PB1000','09:23:00','12:48:00','Departamento de Servicios escolares','Ing Dianela','2024-12-16 09:25:34');

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `ID_Role` int(11) NOT NULL AUTO_INCREMENT,
  `NombreRole` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `roles` */

insert  into `roles`(`ID_Role`,`NombreRole`) values 
(1,'SuperAdmin'),
(2,'Admin');

/*Table structure for table `rolesandusers` */

DROP TABLE IF EXISTS `rolesandusers`;

CREATE TABLE `rolesandusers` (
  `ID_USER` int(11) DEFAULT NULL,
  `ID_ROL` int(11) DEFAULT NULL,
  KEY `PK_User` (`ID_USER`),
  KEY `PK_Rol` (`ID_ROL`),
  CONSTRAINT `PK_Rol` FOREIGN KEY (`ID_ROL`) REFERENCES `roles` (`ID_Role`),
  CONSTRAINT `PK_User` FOREIGN KEY (`ID_USER`) REFERENCES `usuarios` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `rolesandusers` */

insert  into `rolesandusers`(`ID_USER`,`ID_ROL`) values 
(7,2),
(6,1),
(1,1);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` enum('user','admin') DEFAULT 'user',
  `Fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID_Usuario`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`ID_Usuario`,`Username`,`email`,`PASSWORD`,`ROLE`,`Fecha_registro`) values 
(1,'admin','admin@example.com','admin123','admin','2024-12-15 20:01:42'),
(2,'usuario1','usuario1@example.com','userpass1','user','2024-12-15 20:01:42'),
(3,'usuario2','usuario2@example.com','userpass2','user','2024-12-15 20:01:42'),
(4,'usuario3','usuario3@example.com','userpass3','user','2024-12-15 20:01:42'),
(5,'usuario4','usuario4@example.com','userpass4','user','2024-12-15 20:01:42'),
(6,'Emiliano Salgado Mtz','emilianosalgado553@gmail.com','$2y$10$bY5hYUkx8xc3ezTYzCTsPe7/hLqf22iPlVyUNS5zRKEHSL0NQQ18i','admin','2024-12-16 12:47:03'),
-- password 123456789
(7,'Beto Garcia','beto@gmail.com','$2y$10$iYuZLSc.4As8BBvc1clKxuPtGqNNePs9MCzxdTlOB3hKm0VnIPKTm','user','2024-12-16 15:27:04'),
(8,'abraham','sopas@hotmail.com','$2y$10$wCN.tJY/Hwct.3ivx.SqX.59ZF4zJ8jU4E1rVTJT.8zzQPQY9ZkCW','user','2024-12-16 17:12:59'),
(9,'Pedro Dorantes','pedro@hotmail.com','$2y$10$0x1fCeW9TE0dFoov7wf2s.ZF1IbkeJlKuLSmxetlm50bNm9RKrJ4W','user','2024-12-16 22:22:55');
-- password 123456

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
