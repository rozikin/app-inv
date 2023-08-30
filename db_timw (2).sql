-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2022 at 05:59 PM
-- Server version: 10.5.8-MariaDB-log
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_timw`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_colors`
--

CREATE TABLE `tb_colors` (
  `id_color` int(11) NOT NULL,
  `color_code` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_colors`
--

INSERT INTO `tb_colors` (`id_color`, `color_code`, `color`, `remark`) VALUES
(0, '-', '-', '-'),
(1, '00 WHITE', 'WHITE', ''),
(2, '09 BLACK', 'BLACK', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_items`
--

CREATE TABLE `tb_items` (
  `id_item` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `id_supplier` int(255) NOT NULL,
  `id_size` int(100) NOT NULL,
  `id_color` int(100) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_items`
--

INSERT INTO `tb_items` (`id_item`, `item_code`, `item_description`, `id_supplier`, `id_size`, `id_color`, `item_price`, `currency`, `unit`, `remark`) VALUES
(47, 'WC00333AD-JP', 'CARE LABEL', 4, 1, 1, '2000', 'idr', 'PCS', 'Local'),
(48, 'BS00189AD-JP', 'BARCODE STICKER ', 4, 2, 2, '5000', 'usd', 'pcs', 'Import'),
(49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', 5, 1, 1, '1000', 'idr', 'pcs', 'Import'),
(50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', 5, 2, 1, '4000', 'idr', 'pcs', 'Import'),
(52, 'adsf', 'sdaf', 6, 8, 2, 'asdf', 'usd', 'sdafasdf', 'Local'),
(53, '333', '333', 5, 5, 2, '333', 'idr', '3333', 'Local'),
(54, '3333', 'aku dan kamu itu beda', 4, 6, 2, '3333', 'idr', '333', 'Local'),
(55, '77777', '7777', 6, 3, 2, '7777', 'idr', '7777', 'Import');

--
-- Triggers `tb_items`
--
DELIMITER $$
CREATE TRIGGER `delete_item` BEFORE DELETE ON `tb_items` FOR EACH ROW BEGIN 
INSERT INTO tb_items_old VALUES(old.id_item,old.item_code,old.item_description,old.id_supplier,old.item_price,old.currency,old.unit,old.remark, now());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_item` AFTER INSERT ON `tb_items` FOR EACH ROW BEGIN
insert INTO tb_items_log values('add item',new.id_item, new.item_code, new.item_description,new.id_supplier, new.item_price, new.currency,new.unit,new.remark, now(),user());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_item` AFTER UPDATE ON `tb_items` FOR EACH ROW BEGIN
insert INTO tb_items_log values('update item',new.id_item, new.item_code, new.item_description,new.id_supplier, new.item_price, new.currency,new.unit,new.remark, now(),user());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_items_log`
--

CREATE TABLE `tb_items_log` (
  `action` varchar(200) NOT NULL,
  `id_item` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `supplier_code` varchar(200) NOT NULL,
  `item_price` varchar(200) NOT NULL,
  `currency` varchar(200) NOT NULL,
  `unit` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `date` varchar(200) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_items_log`
--

INSERT INTO `tb_items_log` (`action`, `id_item`, `item_code`, `item_description`, `supplier_code`, `item_price`, `currency`, `unit`, `remark`, `date`, `user`) VALUES
('add item', 10, 'sadf', 'adsf', '', '', '', '', '', '2022-08-11 09:51:51', 'root@localhost'),
('update item', 1, 'a001', 'sendok', '', '', '', '', '', '2022-08-11 09:54:33', 'root@localhost'),
('add item', 11, 'dsafsaf', 'sadfafds', 'adfafds', 'adsfaf', 'adfasf', 'asfaf', 'adfasf', '2022-08-11 09:59:41', 'root@localhost'),
('update item', 11, 'dsafsaf', 'jagung', 'adfafds', 'adsfaf', 'adfasf', 'asfaf', 'adfasf', '2022-08-11 10:02:22', 'root@localhost'),
('add item', 12, 'sadfdsaf', 'asdfadsf', '2', 'asdf', 'usd', 'asdf', 'adsfadsf', '2022-08-15 10:05:35', 'root@localhost'),
('add item', 13, '123abc', 'adkjlfa', '2', '4444', 'idr', 'pcs', 'aaaaaaa', '2022-08-15 10:09:22', 'root@localhost'),
('add item', 14, '123bbb', 'bbbbbd', '1', '333333', 'idr', 'bbbbu', 'bbbbbr', '2022-08-15 10:09:52', 'root@localhost'),
('add item', 15, '3333', '3333333', '2', '333333', 'idr', '33333', '333333', '2022-08-15 10:11:52', 'root@localhost'),
('add item', 16, '4444', '44444', '2', '44444', 'idr', '44444', '444444', '2022-08-15 10:13:01', 'root@localhost'),
('add item', 17, 'saf', 'sadf', '2', '234', 'idr', 'wer', 'werewr', '2022-08-15 12:32:23', 'root@localhost'),
('add item', 18, 'sdafsdaf', 'asdadsf', '2', 'adsfads', 'idr', 'adsfdas', 'adsfsadf', '2022-08-15 12:36:45', 'root@localhost'),
('add item', 19, 'er', 'dsfgdsfg', '2', 'sdfg', 'usd', 'sdfg', 'sdfgdsfg', '2022-08-15 12:41:18', 'root@localhost'),
('add item', 20, 'dsaf', 'asdf', '2', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-15 12:42:17', 'root@localhost'),
('add item', 21, 'asdfa', 'asdfaf', '1', 'sdf', 'idr', 'sdfd', 'sdfdsf', '2022-08-15 12:59:54', 'root@localhost'),
('add item', 22, 'asdfasf', 'asdfsadf', '1', 'asdfa', 'usd', 'asdf', 'asdfsadf', '2022-08-15 13:07:52', 'root@localhost'),
('add item', 23, 'adsf', 'adsf', '2', 'asdf', 'usd', 'asdf', 'asdf', '2022-08-15 13:16:39', 'root@localhost'),
('add item', 24, 'asdf', 'asdf', '2', 'asdf', 'idr', 'asf', 'asdfa', '2022-08-15 13:21:03', 'root@localhost'),
('add item', 25, 'asdf', 'asdf', '2', 'asdf', 'idr', 'adsf', 'adsf', '2022-08-15 13:24:01', 'root@localhost'),
('add item', 26, 'asdf', 'adsf', '2', 'asdf', 'idr', 'asdf', 'asdf', '2022-08-15 13:25:26', 'root@localhost'),
('add item', 27, 'asdfasa', 'sdfadf', '2', 'asdf', 'usd', 'asdf', 'asdfsadf', '2022-08-15 13:34:16', 'root@localhost'),
('add item', 28, 'asdfasdf', 'sadfadsf', '1', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-15 13:36:29', 'root@localhost'),
('add item', 29, 'terew', 'twt', '2', '', 'usd', 'wertw', 'ertewt', '2022-08-15 13:37:39', 'root@localhost'),
('add item', 30, 'asdfsaa', 'sdfasf', '2', 'dfas', 'idr', 'asdf', 'asdfas', '2022-08-15 13:38:06', 'root@localhost'),
('update item', 1, 'a001', 'sendok ssss', 's05', '500000', 'idr', 'pcs', 'alat masak', '2022-08-15 14:48:12', 'root@localhost'),
('update item', 11, '2323ssssss', 'jagung', 'adfafds', 'adsfaf', 'idr', 'asfaf', 'adfasf', '2022-08-15 15:05:03', 'root@localhost'),
('update item', 12, '454545', 'asdfadsf', '2', 'asdf', 'idr', 'asdf', 'adsfadsf', '2022-08-15 15:06:21', 'root@localhost'),
('update item', 1, 'a001', 'sendok ssss', 's05', '500000', 'usd', 'pcs', 'alat masak', '2022-08-15 16:40:47', 'root@localhost'),
('update item', 11, '2323ssssss', 'jagung', 'adfafds', 'adsfaf', 'usd', 'asfaf', 'adfasf', '2022-08-15 16:40:56', 'root@localhost'),
('update item', 14, '123bbb', 'bbbbbd', '1', '', 'idr', 'bbbbu', 'bbbbbr', '2022-08-15 16:41:06', 'root@localhost'),
('update item', 12, '454545', 'asdfadsf', '2', 'asdf', 'usd', 'asdf', 'adsfadsf', '2022-08-16 10:16:29', 'root@localhost'),
('update item', 13, '123abc', 'adkjlfa', '2', '4444', 'usd', 'pcs', 'aaaaaaa', '2022-08-16 10:16:39', 'root@localhost'),
('update item', 26, '4566', 'susu2', '2', '56000', 'idr', '10', 'ok', '2022-08-16 11:47:23', 'root@localhost'),
('add item', 27, 'tttttttttt', 'asdfsaf', '2', 'werewr', 'idr', 'sdfsdf', 'dsfsdf', '2022-08-18 11:44:54', 'root@localhost'),
('add item', 28, 'rrrrrrrr', 'rrrrrrrrrrr', '2', 'rrrrrrr', 'idr', 'rrrrrrrrrrr', 'rrrrrrrrrrrr', '2022-08-18 11:48:52', 'root@localhost'),
('add item', 29, '55555', '5555555', '2', '555555', 'idr', '55555', '555555', '2022-08-18 11:54:39', 'root@localhost'),
('update item', 29, '55555', '5555555', '2', '55555556666666666666', 'idr', '55555', '555555', '2022-08-18 11:57:22', 'root@localhost'),
('update item', 29, '55555', '5555555', '2', '55555556666666666666', 'idr', '55555', '555555', '2022-08-18 11:58:04', 'root@localhost'),
('update item', 23, 'adsf', 'adsf', '2', 'asdf', 'usd', 'rrrrrrr', 'asdf', '2022-08-18 12:51:17', 'root@localhost'),
('add item', 30, 'asdfadf', 'asdfasdf', '0', '', 'idr', '', '', '2022-08-18 15:09:41', 'root@localhost'),
('add item', 31, 'asdfadsfas', 'dfsadf', '0', '', 'idr', '', '', '2022-08-18 15:11:18', 'root@localhost'),
('add item', 32, 'sadfdsaf', 'asdfadsf', '2', '', '', '', '', '2022-08-18 15:11:31', 'root@localhost'),
('add item', 33, 'tomy', 'lim', '0', '', 'idr', '', '', '2022-08-18 15:12:05', 'root@localhost'),
('add item', 34, 'tomy', 'squad', '0', '', 'idr', '', '', '2022-08-18 15:12:51', 'root@localhost'),
('add item', 35, 'asdfafda', 'asdfasdfasdf', '2', 'adsf', 'idr', '', '', '2022-08-18 15:13:31', 'root@localhost'),
('add item', 36, 'asdfa', 'asdfadsf', '2', 'asdfsaf', 'idr', 'asdfsaf', 'asdfsadf', '2022-08-18 15:58:32', 'root@localhost'),
('update item', 36, '', '', '2', '', '', '', '', '2022-08-18 16:00:33', 'root@localhost'),
('update item', 36, '', '', '2', '', '', '', '', '2022-08-18 16:00:56', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'idr', 'qqqqq', 'qqqqqqq', '2022-08-18 16:03:18', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'qqqqqqq', '2022-08-18 16:04:11', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'cccccc', '2022-08-18 16:06:14', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'ddd', '2022-08-18 16:06:47', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'ddddfdfdf', '2022-08-18 16:31:06', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'ccccccc', '2022-08-18 16:33:48', 'root@localhost'),
('update item', 25, 'asdf', 'asdf', '2', 'asdf', 'idr', 'adsf', 'ccccccc', '2022-08-18 16:34:51', 'root@localhost'),
('update item', 24, 'asdf', 'asdf', '2', 'asdf', 'idr', 'asf', 'asdfa9999', '2022-08-18 16:35:16', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'cccccccdfdf', '2022-08-18 16:37:11', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'gfgfgfgfg', '2022-08-18 16:37:26', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'gfgfgfgfg', '2022-08-18 16:50:03', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdf', '2022-08-18 16:50:33', 'root@localhost'),
('add item', 37, '', '', '0', '', 'idr', '', '', '2022-08-18 16:51:04', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretret', '2022-08-18 16:51:18', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretretd', '2022-08-18 16:52:24', 'root@localhost'),
('update item', 29, '55555', '5555555', '2', '55555556666666666666dff', 'idr', '55555', '555555', '2022-08-18 16:52:55', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretretda', '2022-08-18 16:57:00', 'root@localhost'),
('add item', 38, '111', '11111', '2', '11111', 'idr', '111', '111111', '2022-08-18 16:57:17', 'root@localhost'),
('update item', 38, '111', '11111', '2', '1111122', 'idr', '111', '111111', '2022-08-19 08:08:44', 'root@localhost'),
('add item', 39, '', '', '0', '', 'idr', '', '', '2022-08-19 09:18:37', 'root@localhost'),
('add item', 40, '', '', '0', '', 'idr', '', '', '2022-08-19 09:25:38', 'root@localhost'),
('add item', 41, 'safsafas', 'asdf', '0', '', 'idr', '', '', '2022-08-19 09:26:12', 'root@localhost'),
('add item', 42, '', '', '0', '', 'idr', '', '', '2022-08-19 09:26:19', 'root@localhost'),
('add item', 43, '', 'wererw', '0', '', 'idr', '', '', '2022-08-19 09:28:47', 'root@localhost'),
('add item', 44, 'qwer', 'qwer', '0', '', 'idr', '', '', '2022-08-19 10:42:47', 'root@localhost'),
('add item', 45, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:30', 'root@localhost'),
('add item', 46, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:32', 'root@localhost'),
('add item', 47, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:32', 'root@localhost'),
('add item', 48, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:33', 'root@localhost'),
('add item', 49, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:33', 'root@localhost'),
('add item', 50, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:33', 'root@localhost'),
('add item', 51, '1111', '111111', '0', '', 'idr', '', '', '2022-08-19 13:02:30', 'root@localhost'),
('add item', 52, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:10', 'root@localhost'),
('add item', 53, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:12', 'root@localhost'),
('add item', 54, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:12', 'root@localhost'),
('add item', 55, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:13', 'root@localhost'),
('add item', 56, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:13', 'root@localhost'),
('add item', 57, 'asfddasfads', '', '0', '', 'idr', '', '', '2022-08-19 13:08:23', 'root@localhost'),
('add item', 58, 'werewrwe', '', '2', '', 'idr', '', '', '2022-08-19 13:17:41', 'root@localhost'),
('add item', 59, 'xxxxxxxx', '', '2', '', 'idr', '', '', '2022-08-19 13:18:19', 'root@localhost'),
('add item', 60, 'aasfsdaf', 'qwerqrasdfas', '2', 'wee', 'idr', 'wewew', 'ewew', '2022-08-19 13:25:10', 'root@localhost'),
('add item', 61, 'ewrt', '', '2', '', 'idr', '', '', '2022-08-19 13:27:07', 'root@localhost'),
('update item', 60, 'aasfsdaf', 'qwerqrasdfas55555', '2', 'wee', 'idr', 'wewew', 'ewew', '2022-08-19 13:27:18', 'root@localhost'),
('update item', 60, 'aasfsdaf', 'qwerqrasdfas55555', '2', 'wee', 'usd', 'wewew', 'ewew', '2022-08-19 15:16:34', 'root@localhost'),
('add item', 62, 'adsf', 'fads', '2', '54', 'idr', 'sfg', 'sdgfsg', '2022-08-19 15:16:56', 'root@localhost'),
('update item', 62, 'adsf', 'fads', '2', '54', 'idr', 'sfg', 'cccccccc', '2022-08-19 15:34:13', 'root@localhost'),
('add item', 63, 'asf', '', '2', '', 'idr', '', '', '2022-08-19 15:43:23', 'root@localhost'),
('update item', 45, '1111', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa', '2022-08-19 16:08:49', 'root@localhost'),
('update item', 45, 'sadfasadf', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa', '2022-08-19 16:32:44', 'root@localhost'),
('update item', 45, 'sadfasadf', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa454', '2022-08-19 16:49:05', 'root@localhost'),
('add item', 46, 'sadf', 'dsaf', '3', '', 'idr', '', '', '2022-08-19 22:38:39', 'root@localhost'),
('update item', 46, 'sadf', 'dsaf', '3', 'sdsds', 'idr', '', '', '2022-08-19 22:39:19', 'root@localhost'),
('add item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '0', 'usd', 'PCS', '0', '2022-08-20 00:30:35', 'root@localhost'),
('add item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '0', 'usd', 'pcs', '', '2022-08-20 00:31:08', 'root@localhost'),
('add item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '0', 'idr', 'pcs', '', '2022-08-20 00:31:41', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', '', '2022-08-20 00:32:43', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', '', '2022-08-20 00:32:50', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'usd', 'PCS', '0', '2022-08-20 00:32:57', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'usd', 'PCS', 'Local', '2022-08-20 01:02:01', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', 'Import', '2022-08-20 01:02:07', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', 'Import', '2022-08-20 01:02:14', 'root@localhost'),
('add item', 50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', '5', '4000', 'idr', 'pcs', 'Import', '2022-08-20 01:02:54', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'idr', 'PCS', 'Local', '2022-08-20 01:03:11', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'idr', 'PCS', 'Local', '2022-08-29 11:44:01', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', 'Import', '2022-08-29 11:44:10', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:12', 'root@localhost'),
('update item', 50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', '5', '4000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:17', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'idr', 'PCS', 'Local', '2022-08-29 11:44:20', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', 'Import', '2022-08-29 11:44:24', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:27', 'root@localhost'),
('update item', 50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', '5', '4000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:31', 'root@localhost'),
('add item', 51, 'sfdgs', 'dsfg', '5', 'sdfg', 'idr', 'sdfg', 'Local', '2022-09-02 11:16:00', 'root@localhost'),
('add item', 52, 'adsf', 'sdaf', '6', 'asdf', 'usd', 'sdafasdf', 'Local', '2022-09-02 11:16:26', 'root@localhost'),
('add item', 53, '333', '333', '5', '333', 'idr', '3333', 'Local', '2022-09-02 11:17:37', 'root@localhost'),
('add item', 54, '3333', '3333', '5', '3333', 'idr', '333', 'Local', '2022-09-02 11:21:35', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 12:54:18', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 12:59:23', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 12:59:33', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 13:00:18', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 13:01:14', 'root@localhost'),
('update item', 54, '3333', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '4', '3333', 'idr', '333', 'Local', '2022-09-02 15:21:58', 'root@localhost'),
('update item', 54, '3333', 'aku dan kamu itu beda', '4', '3333', 'idr', '333', 'Local', '2022-09-02 15:22:30', 'root@localhost'),
('add item', 55, '77777', '7777', '6', '7777', 'idr', '7777', 'Import', '2022-09-05 08:20:27', 'root@localhost'),
('add item', 10, 'sadf', 'adsf', '', '', '', '', '', '2022-08-11 09:51:51', 'root@localhost'),
('update item', 1, 'a001', 'sendok', '', '', '', '', '', '2022-08-11 09:54:33', 'root@localhost'),
('add item', 11, 'dsafsaf', 'sadfafds', 'adfafds', 'adsfaf', 'adfasf', 'asfaf', 'adfasf', '2022-08-11 09:59:41', 'root@localhost'),
('update item', 11, 'dsafsaf', 'jagung', 'adfafds', 'adsfaf', 'adfasf', 'asfaf', 'adfasf', '2022-08-11 10:02:22', 'root@localhost'),
('add item', 12, 'sadfdsaf', 'asdfadsf', '2', 'asdf', 'usd', 'asdf', 'adsfadsf', '2022-08-15 10:05:35', 'root@localhost'),
('add item', 13, '123abc', 'adkjlfa', '2', '4444', 'idr', 'pcs', 'aaaaaaa', '2022-08-15 10:09:22', 'root@localhost'),
('add item', 14, '123bbb', 'bbbbbd', '1', '333333', 'idr', 'bbbbu', 'bbbbbr', '2022-08-15 10:09:52', 'root@localhost'),
('add item', 15, '3333', '3333333', '2', '333333', 'idr', '33333', '333333', '2022-08-15 10:11:52', 'root@localhost'),
('add item', 16, '4444', '44444', '2', '44444', 'idr', '44444', '444444', '2022-08-15 10:13:01', 'root@localhost'),
('add item', 17, 'saf', 'sadf', '2', '234', 'idr', 'wer', 'werewr', '2022-08-15 12:32:23', 'root@localhost'),
('add item', 18, 'sdafsdaf', 'asdadsf', '2', 'adsfads', 'idr', 'adsfdas', 'adsfsadf', '2022-08-15 12:36:45', 'root@localhost'),
('add item', 19, 'er', 'dsfgdsfg', '2', 'sdfg', 'usd', 'sdfg', 'sdfgdsfg', '2022-08-15 12:41:18', 'root@localhost'),
('add item', 20, 'dsaf', 'asdf', '2', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-15 12:42:17', 'root@localhost'),
('add item', 21, 'asdfa', 'asdfaf', '1', 'sdf', 'idr', 'sdfd', 'sdfdsf', '2022-08-15 12:59:54', 'root@localhost'),
('add item', 22, 'asdfasf', 'asdfsadf', '1', 'asdfa', 'usd', 'asdf', 'asdfsadf', '2022-08-15 13:07:52', 'root@localhost'),
('add item', 23, 'adsf', 'adsf', '2', 'asdf', 'usd', 'asdf', 'asdf', '2022-08-15 13:16:39', 'root@localhost'),
('add item', 24, 'asdf', 'asdf', '2', 'asdf', 'idr', 'asf', 'asdfa', '2022-08-15 13:21:03', 'root@localhost'),
('add item', 25, 'asdf', 'asdf', '2', 'asdf', 'idr', 'adsf', 'adsf', '2022-08-15 13:24:01', 'root@localhost'),
('add item', 26, 'asdf', 'adsf', '2', 'asdf', 'idr', 'asdf', 'asdf', '2022-08-15 13:25:26', 'root@localhost'),
('add item', 27, 'asdfasa', 'sdfadf', '2', 'asdf', 'usd', 'asdf', 'asdfsadf', '2022-08-15 13:34:16', 'root@localhost'),
('add item', 28, 'asdfasdf', 'sadfadsf', '1', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-15 13:36:29', 'root@localhost'),
('add item', 29, 'terew', 'twt', '2', '', 'usd', 'wertw', 'ertewt', '2022-08-15 13:37:39', 'root@localhost'),
('add item', 30, 'asdfsaa', 'sdfasf', '2', 'dfas', 'idr', 'asdf', 'asdfas', '2022-08-15 13:38:06', 'root@localhost'),
('update item', 1, 'a001', 'sendok ssss', 's05', '500000', 'idr', 'pcs', 'alat masak', '2022-08-15 14:48:12', 'root@localhost'),
('update item', 11, '2323ssssss', 'jagung', 'adfafds', 'adsfaf', 'idr', 'asfaf', 'adfasf', '2022-08-15 15:05:03', 'root@localhost'),
('update item', 12, '454545', 'asdfadsf', '2', 'asdf', 'idr', 'asdf', 'adsfadsf', '2022-08-15 15:06:21', 'root@localhost'),
('update item', 1, 'a001', 'sendok ssss', 's05', '500000', 'usd', 'pcs', 'alat masak', '2022-08-15 16:40:47', 'root@localhost'),
('update item', 11, '2323ssssss', 'jagung', 'adfafds', 'adsfaf', 'usd', 'asfaf', 'adfasf', '2022-08-15 16:40:56', 'root@localhost'),
('update item', 14, '123bbb', 'bbbbbd', '1', '', 'idr', 'bbbbu', 'bbbbbr', '2022-08-15 16:41:06', 'root@localhost'),
('update item', 12, '454545', 'asdfadsf', '2', 'asdf', 'usd', 'asdf', 'adsfadsf', '2022-08-16 10:16:29', 'root@localhost'),
('update item', 13, '123abc', 'adkjlfa', '2', '4444', 'usd', 'pcs', 'aaaaaaa', '2022-08-16 10:16:39', 'root@localhost'),
('update item', 26, '4566', 'susu2', '2', '56000', 'idr', '10', 'ok', '2022-08-16 11:47:23', 'root@localhost'),
('add item', 27, 'tttttttttt', 'asdfsaf', '2', 'werewr', 'idr', 'sdfsdf', 'dsfsdf', '2022-08-18 11:44:54', 'root@localhost'),
('add item', 28, 'rrrrrrrr', 'rrrrrrrrrrr', '2', 'rrrrrrr', 'idr', 'rrrrrrrrrrr', 'rrrrrrrrrrrr', '2022-08-18 11:48:52', 'root@localhost'),
('add item', 29, '55555', '5555555', '2', '555555', 'idr', '55555', '555555', '2022-08-18 11:54:39', 'root@localhost'),
('update item', 29, '55555', '5555555', '2', '55555556666666666666', 'idr', '55555', '555555', '2022-08-18 11:57:22', 'root@localhost'),
('update item', 29, '55555', '5555555', '2', '55555556666666666666', 'idr', '55555', '555555', '2022-08-18 11:58:04', 'root@localhost'),
('update item', 23, 'adsf', 'adsf', '2', 'asdf', 'usd', 'rrrrrrr', 'asdf', '2022-08-18 12:51:17', 'root@localhost'),
('add item', 30, 'asdfadf', 'asdfasdf', '0', '', 'idr', '', '', '2022-08-18 15:09:41', 'root@localhost'),
('add item', 31, 'asdfadsfas', 'dfsadf', '0', '', 'idr', '', '', '2022-08-18 15:11:18', 'root@localhost'),
('add item', 32, 'sadfdsaf', 'asdfadsf', '2', '', '', '', '', '2022-08-18 15:11:31', 'root@localhost'),
('add item', 33, 'tomy', 'lim', '0', '', 'idr', '', '', '2022-08-18 15:12:05', 'root@localhost'),
('add item', 34, 'tomy', 'squad', '0', '', 'idr', '', '', '2022-08-18 15:12:51', 'root@localhost'),
('add item', 35, 'asdfafda', 'asdfasdfasdf', '2', 'adsf', 'idr', '', '', '2022-08-18 15:13:31', 'root@localhost'),
('add item', 36, 'asdfa', 'asdfadsf', '2', 'asdfsaf', 'idr', 'asdfsaf', 'asdfsadf', '2022-08-18 15:58:32', 'root@localhost'),
('update item', 36, '', '', '2', '', '', '', '', '2022-08-18 16:00:33', 'root@localhost'),
('update item', 36, '', '', '2', '', '', '', '', '2022-08-18 16:00:56', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'idr', 'qqqqq', 'qqqqqqq', '2022-08-18 16:03:18', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'qqqqqqq', '2022-08-18 16:04:11', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'cccccc', '2022-08-18 16:06:14', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'ddd', '2022-08-18 16:06:47', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'ddddfdfdf', '2022-08-18 16:31:06', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'ccccccc', '2022-08-18 16:33:48', 'root@localhost'),
('update item', 25, 'asdf', 'asdf', '2', 'asdf', 'idr', 'adsf', 'ccccccc', '2022-08-18 16:34:51', 'root@localhost'),
('update item', 24, 'asdf', 'asdf', '2', 'asdf', 'idr', 'asf', 'asdfa9999', '2022-08-18 16:35:16', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'cccccccdfdf', '2022-08-18 16:37:11', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'qqqqq', 'gfgfgfgfg', '2022-08-18 16:37:26', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'gfgfgfgfg', '2022-08-18 16:50:03', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdf', '2022-08-18 16:50:33', 'root@localhost'),
('add item', 37, '', '', '0', '', 'idr', '', '', '2022-08-18 16:51:04', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretret', '2022-08-18 16:51:18', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretretd', '2022-08-18 16:52:24', 'root@localhost'),
('update item', 29, '55555', '5555555', '2', '55555556666666666666dff', 'idr', '55555', '555555', '2022-08-18 16:52:55', 'root@localhost'),
('update item', 36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretretda', '2022-08-18 16:57:00', 'root@localhost'),
('add item', 38, '111', '11111', '2', '11111', 'idr', '111', '111111', '2022-08-18 16:57:17', 'root@localhost'),
('update item', 38, '111', '11111', '2', '1111122', 'idr', '111', '111111', '2022-08-19 08:08:44', 'root@localhost'),
('add item', 39, '', '', '0', '', 'idr', '', '', '2022-08-19 09:18:37', 'root@localhost'),
('add item', 40, '', '', '0', '', 'idr', '', '', '2022-08-19 09:25:38', 'root@localhost'),
('add item', 41, 'safsafas', 'asdf', '0', '', 'idr', '', '', '2022-08-19 09:26:12', 'root@localhost'),
('add item', 42, '', '', '0', '', 'idr', '', '', '2022-08-19 09:26:19', 'root@localhost'),
('add item', 43, '', 'wererw', '0', '', 'idr', '', '', '2022-08-19 09:28:47', 'root@localhost'),
('add item', 44, 'qwer', 'qwer', '0', '', 'idr', '', '', '2022-08-19 10:42:47', 'root@localhost'),
('add item', 45, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:30', 'root@localhost'),
('add item', 46, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:32', 'root@localhost'),
('add item', 47, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:32', 'root@localhost'),
('add item', 48, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:33', 'root@localhost'),
('add item', 49, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:33', 'root@localhost'),
('add item', 50, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:01:33', 'root@localhost'),
('add item', 51, '1111', '111111', '0', '', 'idr', '', '', '2022-08-19 13:02:30', 'root@localhost'),
('add item', 52, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:10', 'root@localhost'),
('add item', 53, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:12', 'root@localhost'),
('add item', 54, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:12', 'root@localhost'),
('add item', 55, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:13', 'root@localhost'),
('add item', 56, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:13', 'root@localhost'),
('add item', 57, 'asfddasfads', '', '0', '', 'idr', '', '', '2022-08-19 13:08:23', 'root@localhost'),
('add item', 58, 'werewrwe', '', '2', '', 'idr', '', '', '2022-08-19 13:17:41', 'root@localhost'),
('add item', 59, 'xxxxxxxx', '', '2', '', 'idr', '', '', '2022-08-19 13:18:19', 'root@localhost'),
('add item', 60, 'aasfsdaf', 'qwerqrasdfas', '2', 'wee', 'idr', 'wewew', 'ewew', '2022-08-19 13:25:10', 'root@localhost'),
('add item', 61, 'ewrt', '', '2', '', 'idr', '', '', '2022-08-19 13:27:07', 'root@localhost'),
('update item', 60, 'aasfsdaf', 'qwerqrasdfas55555', '2', 'wee', 'idr', 'wewew', 'ewew', '2022-08-19 13:27:18', 'root@localhost'),
('update item', 60, 'aasfsdaf', 'qwerqrasdfas55555', '2', 'wee', 'usd', 'wewew', 'ewew', '2022-08-19 15:16:34', 'root@localhost'),
('add item', 62, 'adsf', 'fads', '2', '54', 'idr', 'sfg', 'sdgfsg', '2022-08-19 15:16:56', 'root@localhost'),
('update item', 62, 'adsf', 'fads', '2', '54', 'idr', 'sfg', 'cccccccc', '2022-08-19 15:34:13', 'root@localhost'),
('add item', 63, 'asf', '', '2', '', 'idr', '', '', '2022-08-19 15:43:23', 'root@localhost'),
('update item', 45, '1111', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa', '2022-08-19 16:08:49', 'root@localhost'),
('update item', 45, 'sadfasadf', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa', '2022-08-19 16:32:44', 'root@localhost'),
('update item', 45, 'sadfasadf', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa454', '2022-08-19 16:49:05', 'root@localhost'),
('add item', 46, 'sadf', 'dsaf', '3', '', 'idr', '', '', '2022-08-19 22:38:39', 'root@localhost'),
('update item', 46, 'sadf', 'dsaf', '3', 'sdsds', 'idr', '', '', '2022-08-19 22:39:19', 'root@localhost'),
('add item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '0', 'usd', 'PCS', '0', '2022-08-20 00:30:35', 'root@localhost'),
('add item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '0', 'usd', 'pcs', '', '2022-08-20 00:31:08', 'root@localhost'),
('add item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '0', 'idr', 'pcs', '', '2022-08-20 00:31:41', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', '', '2022-08-20 00:32:43', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', '', '2022-08-20 00:32:50', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'usd', 'PCS', '0', '2022-08-20 00:32:57', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'usd', 'PCS', 'Local', '2022-08-20 01:02:01', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', 'Import', '2022-08-20 01:02:07', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', 'Import', '2022-08-20 01:02:14', 'root@localhost'),
('add item', 50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', '5', '4000', 'idr', 'pcs', 'Import', '2022-08-20 01:02:54', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'idr', 'PCS', 'Local', '2022-08-20 01:03:11', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'idr', 'PCS', 'Local', '2022-08-29 11:44:01', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', 'Import', '2022-08-29 11:44:10', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:12', 'root@localhost'),
('update item', 50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', '5', '4000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:17', 'root@localhost'),
('update item', 47, 'WC00333AD-JP', 'CARE LABEL', '4', '2000', 'idr', 'PCS', 'Local', '2022-08-29 11:44:20', 'root@localhost'),
('update item', 48, 'BS00189AD-JP', 'BARCODE STICKER ', '4', '5000', 'usd', 'pcs', 'Import', '2022-08-29 11:44:24', 'root@localhost'),
('update item', 49, 'PK10676KB-JP', 'Plastic bag FOR COLOR WHITE', '5', '1000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:27', 'root@localhost'),
('update item', 50, 'PK10676KBBJP', 'Plastic bag  FOR COLOR BLACK', '5', '4000', 'idr', 'pcs', 'Import', '2022-08-29 11:44:31', 'root@localhost'),
('add item', 51, 'sfdgs', 'dsfg', '5', 'sdfg', 'idr', 'sdfg', 'Local', '2022-09-02 11:16:00', 'root@localhost'),
('add item', 52, 'adsf', 'sdaf', '6', 'asdf', 'usd', 'sdafasdf', 'Local', '2022-09-02 11:16:26', 'root@localhost'),
('add item', 53, '333', '333', '5', '333', 'idr', '3333', 'Local', '2022-09-02 11:17:37', 'root@localhost'),
('add item', 54, '3333', '3333', '5', '3333', 'idr', '333', 'Local', '2022-09-02 11:21:35', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 12:54:18', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 12:59:23', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 12:59:33', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 13:00:18', 'root@localhost'),
('update item', 54, '3333', '3333', '4', '3333', 'idr', '333', 'Local', '2022-09-02 13:01:14', 'root@localhost'),
('update item', 54, '3333', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ', '4', '3333', 'idr', '333', 'Local', '2022-09-02 15:21:58', 'root@localhost'),
('update item', 54, '3333', 'aku dan kamu itu beda', '4', '3333', 'idr', '333', 'Local', '2022-09-02 15:22:30', 'root@localhost'),
('add item', 55, '77777', '7777', '6', '7777', 'idr', '7777', 'Import', '2022-09-05 08:20:27', 'root@localhost'),
('add item', 56, 'bbbbbb', 'bbbbbbbbbbb', '4', 'bbbbbbbbbbbbbb', 'idr', 'bbbbbbbbbbb', 'Local', '2022-09-05 15:41:17', 'root@TIMWNAS'),
('update item', 56, 'bbbbbb', 'bbbbbbbbbbb', '7', 'bbbbbbbbbbbbbb', 'idr', 'bbbbbbbbbbb', 'Local', '2022-09-05 15:49:24', 'root@TIMWNAS'),
('add item', 57, 'ASDF', 'ASDF', '5', 'ADSF', 'idr', 'ASDF', 'Local', '2022-09-06 08:26:29', 'root@TIMWNAS'),
('update item', 57, 'ASDF', 'ASDF', '5', 'DDDDD', 'idr', 'ASDF', 'Local', '2022-09-06 08:26:38', 'root@TIMWNAS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_items_old`
--

CREATE TABLE `tb_items_old` (
  `id_item` int(11) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_destription` varchar(255) NOT NULL,
  `supplier_code` varchar(255) NOT NULL,
  `item_price` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `delete_at` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_items_old`
--

INSERT INTO `tb_items_old` (`id_item`, `item_code`, `item_destription`, `supplier_code`, `item_price`, `currency`, `unit`, `remark`, `delete_at`) VALUES
(10, 'sadf', 'adsf', 'dsaf', 'adsf', 'asdf', 'asdf', 'asdfsa', '2022-08-11 09:52:59'),
(30, 'asdfsaa', 'sdfasf', '2', 'dfas', 'idr', 'asdf', 'asdfas', '2022-08-15 13:59:51'),
(29, 'terew', 'twt', '2', '', 'usd', 'wertw', 'ertewt', '2022-08-15 14:00:38'),
(28, 'asdfasdf', 'sadfadsf', '1', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-15 14:00:41'),
(27, 'asdfasa', 'sdfadf', '2', 'asdf', 'usd', 'asdf', 'asdfsadf', '2022-08-15 14:01:30'),
(26, 'asdf', 'adsf', '2', 'asdf', 'idr', 'asdf', 'asdf', '2022-08-15 14:49:37'),
(19, 'er', 'dsfgdsfg', '2', 'sdfg', 'usd', 'sdfg', 'sdfgdsfg', '2022-08-16 11:47:58'),
(1, 'a001', 'sendok ssss', '0', '500000', 'usd', 'pcs', 'alat masak', '2022-08-16 11:48:04'),
(11, '2323ssssss', 'jagung', '0', 'adsfaf', 'usd', 'asfaf', 'adfasf', '2022-08-16 11:49:49'),
(12, '454545', 'asdfadsf', '2', 'asdf', 'usd', 'asdf', 'adsfadsf', '2022-08-16 13:45:05'),
(17, 'saf', 'sadf', '2', '234', 'idr', 'wer', 'werewr', '2022-08-18 11:43:46'),
(13, '123abc', 'adkjlfa', '2', '4444', 'usd', 'pcs', 'aaaaaaa', '2022-08-18 11:43:56'),
(34, 'tomy', 'squad', '0', '', 'idr', '', '', '2022-08-18 15:13:02'),
(33, 'tomy', 'lim', '0', '', 'idr', '', '', '2022-08-18 15:13:12'),
(32, 'sadfdsaf', 'asdfadsf', '2', '', '', '', '', '2022-08-18 15:13:16'),
(31, 'asdfadsfas', 'dfsadf', '0', '', 'idr', '', '', '2022-08-18 15:13:20'),
(35, 'asdfafda', 'asdfasdfasdf', '2', 'adsf', 'idr', '', '', '2022-08-18 16:31:28'),
(30, 'asdfadf', 'asdfasdf', '0', '', 'idr', '', '', '2022-08-18 16:31:53'),
(14, '123bbb', 'bbbbbd', '1', '', 'idr', 'bbbbu', 'bbbbbr', '2022-08-18 16:32:24'),
(37, '', '', '0', '', 'idr', '', '', '2022-08-18 16:51:10'),
(39, '', '', '0', '', 'idr', '', '', '2022-08-19 09:18:44'),
(40, '', '', '0', '', 'idr', '', '', '2022-08-19 09:25:43'),
(42, '', '', '0', '', 'idr', '', '', '2022-08-19 09:26:28'),
(43, '', 'wererw', '0', '', 'idr', '', '', '2022-08-19 09:28:53'),
(56, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:48'),
(55, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:51'),
(54, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:56'),
(53, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:59'),
(52, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:04:02'),
(51, '1111', '111111', '0', '', 'idr', '', '', '2022-08-19 13:04:05'),
(57, 'asfddasfads', '', '0', '', 'idr', '', '', '2022-08-19 13:17:50'),
(58, 'werewrwe', '', '2', '', 'idr', '', '', '2022-08-19 13:17:53'),
(61, 'ewrt', '', '2', '', 'idr', '', '', '2022-08-19 13:27:26'),
(59, 'xxxxxxxx', '', '2', '', 'idr', '', '', '2022-08-19 13:36:05'),
(44, 'qwer', 'qwer', '0', '', 'idr', '', '', '2022-08-19 13:36:11'),
(50, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:18'),
(49, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:21'),
(48, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:26'),
(47, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:28'),
(41, 'safsafas', 'asdf', '0', '', 'idr', '', '', '2022-08-19 13:36:32'),
(46, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:36'),
(63, 'asf', '', '2', '', 'idr', '', '', '2022-08-19 15:56:08'),
(62, 'adsf', 'fads', '2', '54', 'idr', 'sfg', 'cccccccc', '2022-08-19 15:56:19'),
(60, 'aasfsdaf', 'qwerqrasdfas55555', '2', 'wee', 'usd', 'wewew', 'ewew', '2022-08-19 15:56:55'),
(45, 'sadfasadf', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa454', '2022-08-19 22:38:27'),
(15, '3333', '3333333', '2', '333333', 'idr', '33333', '333333', '2022-08-20 00:25:04'),
(16, '4444', '44444', '2', '44444', 'idr', '44444', '444444', '2022-08-20 00:25:08'),
(18, 'sdafsdaf', 'asdadsf', '2', 'adsfads', 'idr', 'adsfdas', 'adsfsadf', '2022-08-20 00:25:11'),
(20, 'dsaf', 'asdf', '2', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-20 00:25:12'),
(21, 'asdfa', 'asdfaf', '1', 'sdf', 'idr', 'sdfd', 'sdfdsf', '2022-08-20 00:25:14'),
(22, 'asdfasf', 'asdfsadf', '1', 'asdfa', 'usd', 'asdf', 'asdfsadf', '2022-08-20 00:25:16'),
(23, 'adsf', 'adsf', '2', 'asdf', 'usd', 'rrrrrrr', 'asdf', '2022-08-20 00:25:21'),
(24, 'asdf', 'asdf', '2', 'asdf', 'idr', 'asf', 'asdfa9999', '2022-08-20 00:25:23'),
(25, 'asdf', 'asdf', '2', 'asdf', 'idr', 'adsf', 'ccccccc', '2022-08-20 00:25:24'),
(26, '4566', 'susu2', '2', '56000', 'idr', '10', 'ok', '2022-08-20 00:25:25'),
(27, 'tttttttttt', 'asdfsaf', '2', 'werewr', 'idr', 'sdfsdf', 'dsfsdf', '2022-08-20 00:25:26'),
(28, 'rrrrrrrr', 'rrrrrrrrrrr', '2', 'rrrrrrr', 'idr', 'rrrrrrrrrrr', 'rrrrrrrrrrrr', '2022-08-20 00:25:27'),
(29, '55555', '5555555', '2', '55555556666666666666dff', 'idr', '55555', '555555', '2022-08-20 00:25:28'),
(36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretretda', '2022-08-20 00:25:29'),
(38, '111', '11111', '2', '1111122', 'idr', '111', '111111', '2022-08-20 00:25:31'),
(46, 'sadf', 'dsaf', '3', 'sdsds', 'idr', '', '', '2022-08-20 00:25:31'),
(51, 'sfdgs', 'dsfg', '5', 'sdfg', 'idr', 'sdfg', 'Local', '2022-09-02 11:16:10'),
(10, 'sadf', 'adsf', 'dsaf', 'adsf', 'asdf', 'asdf', 'asdfsa', '2022-08-11 09:52:59'),
(30, 'asdfsaa', 'sdfasf', '2', 'dfas', 'idr', 'asdf', 'asdfas', '2022-08-15 13:59:51'),
(29, 'terew', 'twt', '2', '', 'usd', 'wertw', 'ertewt', '2022-08-15 14:00:38'),
(28, 'asdfasdf', 'sadfadsf', '1', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-15 14:00:41'),
(27, 'asdfasa', 'sdfadf', '2', 'asdf', 'usd', 'asdf', 'asdfsadf', '2022-08-15 14:01:30'),
(26, 'asdf', 'adsf', '2', 'asdf', 'idr', 'asdf', 'asdf', '2022-08-15 14:49:37'),
(19, 'er', 'dsfgdsfg', '2', 'sdfg', 'usd', 'sdfg', 'sdfgdsfg', '2022-08-16 11:47:58'),
(1, 'a001', 'sendok ssss', '0', '500000', 'usd', 'pcs', 'alat masak', '2022-08-16 11:48:04'),
(11, '2323ssssss', 'jagung', '0', 'adsfaf', 'usd', 'asfaf', 'adfasf', '2022-08-16 11:49:49'),
(12, '454545', 'asdfadsf', '2', 'asdf', 'usd', 'asdf', 'adsfadsf', '2022-08-16 13:45:05'),
(17, 'saf', 'sadf', '2', '234', 'idr', 'wer', 'werewr', '2022-08-18 11:43:46'),
(13, '123abc', 'adkjlfa', '2', '4444', 'usd', 'pcs', 'aaaaaaa', '2022-08-18 11:43:56'),
(34, 'tomy', 'squad', '0', '', 'idr', '', '', '2022-08-18 15:13:02'),
(33, 'tomy', 'lim', '0', '', 'idr', '', '', '2022-08-18 15:13:12'),
(32, 'sadfdsaf', 'asdfadsf', '2', '', '', '', '', '2022-08-18 15:13:16'),
(31, 'asdfadsfas', 'dfsadf', '0', '', 'idr', '', '', '2022-08-18 15:13:20'),
(35, 'asdfafda', 'asdfasdfasdf', '2', 'adsf', 'idr', '', '', '2022-08-18 16:31:28'),
(30, 'asdfadf', 'asdfasdf', '0', '', 'idr', '', '', '2022-08-18 16:31:53'),
(14, '123bbb', 'bbbbbd', '1', '', 'idr', 'bbbbu', 'bbbbbr', '2022-08-18 16:32:24'),
(37, '', '', '0', '', 'idr', '', '', '2022-08-18 16:51:10'),
(39, '', '', '0', '', 'idr', '', '', '2022-08-19 09:18:44'),
(40, '', '', '0', '', 'idr', '', '', '2022-08-19 09:25:43'),
(42, '', '', '0', '', 'idr', '', '', '2022-08-19 09:26:28'),
(43, '', 'wererw', '0', '', 'idr', '', '', '2022-08-19 09:28:53'),
(56, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:48'),
(55, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:51'),
(54, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:56'),
(53, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:03:59'),
(52, '111', '111', '0', '', 'idr', '', '', '2022-08-19 13:04:02'),
(51, '1111', '111111', '0', '', 'idr', '', '', '2022-08-19 13:04:05'),
(57, 'asfddasfads', '', '0', '', 'idr', '', '', '2022-08-19 13:17:50'),
(58, 'werewrwe', '', '2', '', 'idr', '', '', '2022-08-19 13:17:53'),
(61, 'ewrt', '', '2', '', 'idr', '', '', '2022-08-19 13:27:26'),
(59, 'xxxxxxxx', '', '2', '', 'idr', '', '', '2022-08-19 13:36:05'),
(44, 'qwer', 'qwer', '0', '', 'idr', '', '', '2022-08-19 13:36:11'),
(50, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:18'),
(49, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:21'),
(48, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:26'),
(47, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:28'),
(41, 'safsafas', 'asdf', '0', '', 'idr', '', '', '2022-08-19 13:36:32'),
(46, '1111', '11111111', '2', '11111', 'idr', '11111', '11111111', '2022-08-19 13:36:36'),
(63, 'asf', '', '2', '', 'idr', '', '', '2022-08-19 15:56:08'),
(62, 'adsf', 'fads', '2', '54', 'idr', 'sfg', 'cccccccc', '2022-08-19 15:56:19'),
(60, 'aasfsdaf', 'qwerqrasdfas55555', '2', 'wee', 'usd', 'wewew', 'ewew', '2022-08-19 15:56:55'),
(45, 'sadfasadf', '11111111', '2', '11111', 'idr', '11111', 'aaaaaaaaaaa454', '2022-08-19 22:38:27'),
(15, '3333', '3333333', '2', '333333', 'idr', '33333', '333333', '2022-08-20 00:25:04'),
(16, '4444', '44444', '2', '44444', 'idr', '44444', '444444', '2022-08-20 00:25:08'),
(18, 'sdafsdaf', 'asdadsf', '2', 'adsfads', 'idr', 'adsfdas', 'adsfsadf', '2022-08-20 00:25:11'),
(20, 'dsaf', 'asdf', '2', 'sadf', 'idr', 'asdf', 'asdf', '2022-08-20 00:25:12'),
(21, 'asdfa', 'asdfaf', '1', 'sdf', 'idr', 'sdfd', 'sdfdsf', '2022-08-20 00:25:14'),
(22, 'asdfasf', 'asdfsadf', '1', 'asdfa', 'usd', 'asdf', 'asdfsadf', '2022-08-20 00:25:16'),
(23, 'adsf', 'adsf', '2', 'asdf', 'usd', 'rrrrrrr', 'asdf', '2022-08-20 00:25:21'),
(24, 'asdf', 'asdf', '2', 'asdf', 'idr', 'asf', 'asdfa9999', '2022-08-20 00:25:23'),
(25, 'asdf', 'asdf', '2', 'asdf', 'idr', 'adsf', 'ccccccc', '2022-08-20 00:25:24'),
(26, '4566', 'susu2', '2', '56000', 'idr', '10', 'ok', '2022-08-20 00:25:25'),
(27, 'tttttttttt', 'asdfsaf', '2', 'werewr', 'idr', 'sdfsdf', 'dsfsdf', '2022-08-20 00:25:26'),
(28, 'rrrrrrrr', 'rrrrrrrrrrr', '2', 'rrrrrrr', 'idr', 'rrrrrrrrrrr', 'rrrrrrrrrrrr', '2022-08-20 00:25:27'),
(29, '55555', '5555555', '2', '55555556666666666666dff', 'idr', '55555', '555555', '2022-08-20 00:25:28'),
(36, 'qqqqqqqqq', 'qqqqqqq', '2', 'qqqqqqqq', 'usd', 'sdfsdfdsf', 'sdfretretda', '2022-08-20 00:25:29'),
(38, '111', '11111', '2', '1111122', 'idr', '111', '111111', '2022-08-20 00:25:31'),
(46, 'sadf', 'dsaf', '3', 'sdsds', 'idr', '', '', '2022-08-20 00:25:31'),
(51, 'sfdgs', 'dsfg', '5', 'sdfg', 'idr', 'sdfg', 'Local', '2022-09-02 11:16:10'),
(57, 'ASDF', 'ASDF', '5', 'DDDDD', 'idr', 'ASDF', 'Local', '2022-09-06 08:31:23'),
(56, 'bbbbbb', 'bbbbbbbbbbb', '7', 'bbbbbbbbbbbbbb', 'idr', 'bbbbbbbbbbb', 'Local', '2022-09-06 08:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_order`
--

CREATE TABLE `tb_purchase_order` (
  `id_po` int(20) NOT NULL,
  `po_no` varchar(200) NOT NULL,
  `id_trim` varchar(200) NOT NULL,
  `id_supplier` varchar(200) NOT NULL,
  `request_date` varchar(50) NOT NULL,
  `request_in_house` varchar(200) NOT NULL,
  `delivery_at` varchar(200) NOT NULL,
  `allocation` varchar(200) NOT NULL,
  `applicant` varchar(200) NOT NULL,
  `sub_total` varchar(200) NOT NULL,
  `rounding` varchar(200) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `vat` varchar(200) NOT NULL,
  `grand_total` varchar(200) NOT NULL,
  `purchase_amount` varchar(200) NOT NULL,
  `notes` varchar(3000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_order_detail`
--

CREATE TABLE `tb_purchase_order_detail` (
  `id_po_detail` int(20) NOT NULL,
  `id_item` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `note` varchar(30000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_size`
--

CREATE TABLE `tb_size` (
  `id_size` int(11) NOT NULL,
  `size_code` varchar(255) NOT NULL,
  `size_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_size`
--

INSERT INTO `tb_size` (`id_size`, `size_code`, `size_description`) VALUES
(0, '-', '-'),
(1, 'S', 'Small'),
(2, 'M', 'Medium'),
(3, 'L', 'L'),
(4, 'XXS', 'XXS'),
(5, 'XL', 'XL'),
(6, 'XXL', 'XXL'),
(7, '3XL', '3XL'),
(8, '4XL', '4XL');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_phone` varchar(255) NOT NULL,
  `supplier_fax` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_attention` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_fax`, `supplier_email`, `supplier_attention`, `remark`) VALUES
(0, '-', '-', '-', '-', '-', '-', '-'),
(4, 'AVERY DENNISON', 'JAPAN', '0', '0', '0', '0', '0'),
(5, 'KOBAORI', 'JAPAN', '0', '0', '0', '0', '0'),
(6, 'NAXIS', 'HONGKONG', '0', '0', '0', '0', '0'),
(7, 'ccc', 'VVVVV', 'cccc', 'ccccccc', 'ccc', 'cccc', '100'),
(8, 'assass', 'sdfg', 'dsfg', 'sdfg', 'sdfg', 'sdfg', '11%');

--
-- Triggers `tb_supplier`
--
DELIMITER $$
CREATE TRIGGER `delete_supplier` BEFORE DELETE ON `tb_supplier` FOR EACH ROW BEGIN 
INSERT INTO tb_supplier_old VALUES(old.id_supplier,old.supplier_name,old.supplier_address,old.supplier_phone,old.supplier_fax,old.supplier_email,old.supplier_attention,old.remark, now());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_supplier` AFTER INSERT ON `tb_supplier` FOR EACH ROW BEGIN
insert INTO tb_supplier_log values('add item',new.id_supplier, new.supplier_name, new.supplier_address,new.supplier_phone, new.supplier_fax, new.supplier_email,new.supplier_attention,new.remark, now(),user());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_supplier` AFTER UPDATE ON `tb_supplier` FOR EACH ROW BEGIN
insert INTO tb_supplier_log values('update item',new.id_supplier, new.supplier_name, new.supplier_address,new.supplier_phone, new.supplier_fax, new.supplier_email,new.supplier_attention,new.remark, now(),user());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier_log`
--

CREATE TABLE `tb_supplier_log` (
  `action` varchar(200) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_phone` varchar(255) NOT NULL,
  `supplier_fax` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_attention` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `date` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier_log`
--

INSERT INTO `tb_supplier_log` (`action`, `id_supplier`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_fax`, `supplier_email`, `supplier_attention`, `remark`, `date`, `user`) VALUES
('add item', 1, 'SP01', 'jakarta', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-11 11:16:46', 'root@localhost'),
('update item', 1, 'SP01', 'bandung', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-11 11:34:37', 'root@localhost'),
('add item', 2, 'SP02', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-15 08:59:08', 'root@localhost'),
('update item', 1, 'MAJU JAYA', 'bandung', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-15 09:41:27', 'root@localhost'),
('update item', 2, 'STEMBA', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-15 09:41:33', 'root@localhost'),
('add item', 3, 'jafsdkl', 'aklsf', 'aksjlf', 'klasjf', 'laf', 'lasfj', 'kldjaf', '2022-08-16 10:45:55', 'root@localhost'),
('update item', 1, 'MAJU JAYA 2', 'bandung', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-16 11:12:23', 'root@localhost'),
('update item', 1, 'MAJU JAYA 2', 'Semarang', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-16 11:12:38', 'root@localhost'),
('update item', 2, 'STEMBA dfdrf', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-16 11:40:22', 'root@localhost'),
('add item', 3, 'ttttttt', 'ttttttttt', 'ttttttttt', 'tttttttt', 'ttttttt', 'tttttttt', 'ttttttttt', '2022-08-19 15:19:31', 'root@localhost'),
('add item', 4, 'cccccc', 'ccccc', 'cccc', 'cccc', 'cccc', 'ccccc', 'cccccc', '2022-08-19 15:20:50', 'root@localhost'),
('update item', 4, 'cccccc', 'ddddddd', 'cccc', 'cccc', 'cccc', 'ccccc', 'cccccc', '2022-08-19 15:21:07', 'root@localhost'),
('update item', 3, 'ttttttt', 'ttttttttt', 'ttttttttt', 'tttttttt', 'ttttttt', 'tttttttt', 'aaaaaaaaaaaa', '2022-08-19 15:33:57', 'root@localhost'),
('add item', 5, 'asdfasf', 'asfasf', 'asdfasf', 'asdfasf', 'asfasf', 'adsfasf', 'asdfasfadsf', '2022-08-19 15:57:58', 'root@localhost'),
('add item', 6, 'vvvvvvv', 'vvvvv', 'vvvvvv', 'vvvvvvvv', 'vvvvv', 'vvvvvvvvv', 'vvvvvvv', '2022-08-19 15:59:04', 'root@localhost'),
('add item', 7, '', '', '', '', '', '', '', '2022-08-19 16:08:20', 'root@localhost'),
('update item', 5, 'asdfasf', 'asfasfsssss', 'asdfasf', 'asdfasf', 'asfasf', 'adsfasf', 'asdfasfadsf', '2022-08-19 16:12:07', 'root@localhost'),
('add item', 4, 'AVERY DENNISON', 'JAPAN', '0', '0', '0', '0', '0', '2022-08-20 00:29:05', 'root@localhost'),
('add item', 5, 'KOBAORI', 'JAPAN', '0', '0', '0', '0', '0', '2022-08-20 00:29:22', 'root@localhost'),
('add item', 6, 'NAXIS', 'HONGKONG', '0', '0', '0', '0', '0', '2022-08-20 00:29:45', 'root@localhost'),
('add item', 7, 'ccc', 'cccccc', 'cccc', 'ccccccc', 'ccc', 'cccc', 'ccccccc', '2022-08-29 11:28:33', 'root@localhost'),
('update item', 7, 'ccc', 'cccccc', 'cccc', 'ccccccc', 'ccc', 'cccc', '100', '2022-08-29 11:28:41', 'root@localhost'),
('add item', 8, '-', '-', '-', '-', '-', '-', '-', '2022-08-29 11:46:24', 'root@localhost'),
('update item', 0, '-', '-', '-', '-', '-', '-', '-', '2022-08-29 11:46:31', 'root@localhost'),
('add item', 8, 'sdfg', 'sdfg', 'dsfg', 'sdfg', 'sdfg', 'sdfg', '11%', '2022-09-02 13:02:33', 'root@localhost'),
('add item', 1, 'SP01', 'jakarta', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-11 11:16:46', 'root@localhost'),
('update item', 1, 'SP01', 'bandung', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-11 11:34:37', 'root@localhost'),
('add item', 2, 'SP02', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-15 08:59:08', 'root@localhost'),
('update item', 1, 'MAJU JAYA', 'bandung', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-15 09:41:27', 'root@localhost'),
('update item', 2, 'STEMBA', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-15 09:41:33', 'root@localhost'),
('add item', 3, 'jafsdkl', 'aklsf', 'aksjlf', 'klasjf', 'laf', 'lasfj', 'kldjaf', '2022-08-16 10:45:55', 'root@localhost'),
('update item', 1, 'MAJU JAYA 2', 'bandung', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-16 11:12:23', 'root@localhost'),
('update item', 1, 'MAJU JAYA 2', 'Semarang', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-16 11:12:38', 'root@localhost'),
('update item', 2, 'STEMBA dfdrf', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-16 11:40:22', 'root@localhost'),
('add item', 3, 'ttttttt', 'ttttttttt', 'ttttttttt', 'tttttttt', 'ttttttt', 'tttttttt', 'ttttttttt', '2022-08-19 15:19:31', 'root@localhost'),
('add item', 4, 'cccccc', 'ccccc', 'cccc', 'cccc', 'cccc', 'ccccc', 'cccccc', '2022-08-19 15:20:50', 'root@localhost'),
('update item', 4, 'cccccc', 'ddddddd', 'cccc', 'cccc', 'cccc', 'ccccc', 'cccccc', '2022-08-19 15:21:07', 'root@localhost'),
('update item', 3, 'ttttttt', 'ttttttttt', 'ttttttttt', 'tttttttt', 'ttttttt', 'tttttttt', 'aaaaaaaaaaaa', '2022-08-19 15:33:57', 'root@localhost'),
('add item', 5, 'asdfasf', 'asfasf', 'asdfasf', 'asdfasf', 'asfasf', 'adsfasf', 'asdfasfadsf', '2022-08-19 15:57:58', 'root@localhost'),
('add item', 6, 'vvvvvvv', 'vvvvv', 'vvvvvv', 'vvvvvvvv', 'vvvvv', 'vvvvvvvvv', 'vvvvvvv', '2022-08-19 15:59:04', 'root@localhost'),
('add item', 7, '', '', '', '', '', '', '', '2022-08-19 16:08:20', 'root@localhost'),
('update item', 5, 'asdfasf', 'asfasfsssss', 'asdfasf', 'asdfasf', 'asfasf', 'adsfasf', 'asdfasfadsf', '2022-08-19 16:12:07', 'root@localhost'),
('add item', 4, 'AVERY DENNISON', 'JAPAN', '0', '0', '0', '0', '0', '2022-08-20 00:29:05', 'root@localhost'),
('add item', 5, 'KOBAORI', 'JAPAN', '0', '0', '0', '0', '0', '2022-08-20 00:29:22', 'root@localhost'),
('add item', 6, 'NAXIS', 'HONGKONG', '0', '0', '0', '0', '0', '2022-08-20 00:29:45', 'root@localhost'),
('add item', 7, 'ccc', 'cccccc', 'cccc', 'ccccccc', 'ccc', 'cccc', 'ccccccc', '2022-08-29 11:28:33', 'root@localhost'),
('update item', 7, 'ccc', 'cccccc', 'cccc', 'ccccccc', 'ccc', 'cccc', '100', '2022-08-29 11:28:41', 'root@localhost'),
('add item', 8, '-', '-', '-', '-', '-', '-', '-', '2022-08-29 11:46:24', 'root@localhost'),
('update item', 0, '-', '-', '-', '-', '-', '-', '-', '2022-08-29 11:46:31', 'root@localhost'),
('add item', 8, 'sdfg', 'sdfg', 'dsfg', 'sdfg', 'sdfg', 'sdfg', '11%', '2022-09-02 13:02:33', 'root@localhost'),
('update item', 8, 'assass', 'sdfg', 'dsfg', 'sdfg', 'sdfg', 'sdfg', '11%', '2022-09-05 16:01:03', 'root@TIMWNAS'),
('update item', 7, 'ccc', 'VVVVV', 'cccc', 'ccccccc', 'ccc', 'cccc', '100', '2022-09-05 16:03:06', 'root@TIMWNAS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier_old`
--

CREATE TABLE `tb_supplier_old` (
  `id_supplier` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_address` varchar(255) NOT NULL,
  `supplier_phone` varchar(255) NOT NULL,
  `supplier_fax` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL,
  `supplier_attention` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supplier_old`
--

INSERT INTO `tb_supplier_old` (`id_supplier`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_fax`, `supplier_email`, `supplier_attention`, `remark`, `date`) VALUES
(3, 'jafsdkl', 'aklsf', 'aksjlf', 'klasjf', 'laf', 'lasfj', 'kldjaf', '2022-08-16 10:58:01'),
(1, 'MAJU JAYA 2', 'Semarang', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-16 13:48:06'),
(4, 'cccccc', 'ddddddd', 'cccc', 'cccc', 'cccc', 'ccccc', 'cccccc', '2022-08-19 15:21:16'),
(6, 'vvvvvvv', 'vvvvv', 'vvvvvv', 'vvvvvvvv', 'vvvvv', 'vvvvvvvvv', 'vvvvvvv', '2022-08-19 16:02:30'),
(7, '', '', '', '', '', '', '', '2022-08-19 16:08:29'),
(5, 'asdfasf', 'asfasfsssss', 'asdfasf', 'asdfasf', 'asfasf', 'adsfasf', 'asdfasfadsf', '2022-08-19 16:13:24'),
(2, 'STEMBA dfdrf', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-20 00:25:53'),
(3, 'ttttttt', 'ttttttttt', 'ttttttttt', 'tttttttt', 'ttttttt', 'tttttttt', 'aaaaaaaaaaaa', '2022-08-20 00:25:56'),
(3, 'jafsdkl', 'aklsf', 'aksjlf', 'klasjf', 'laf', 'lasfj', 'kldjaf', '2022-08-16 10:58:01'),
(1, 'MAJU JAYA 2', 'Semarang', '08123', '081234', 'SP01gmail', 'tomy', 'Supplier Keyboard', '2022-08-16 13:48:06'),
(4, 'cccccc', 'ddddddd', 'cccc', 'cccc', 'cccc', 'ccccc', 'cccccc', '2022-08-19 15:21:16'),
(6, 'vvvvvvv', 'vvvvv', 'vvvvvv', 'vvvvvvvv', 'vvvvv', 'vvvvvvvvv', 'vvvvvvv', '2022-08-19 16:02:30'),
(7, '', '', '', '', '', '', '', '2022-08-19 16:08:29'),
(5, 'asdfasf', 'asfasfsssss', 'asdfasf', 'asdfasf', 'asfasf', 'adsfasf', 'asdfasfadsf', '2022-08-19 16:13:24'),
(2, 'STEMBA dfdrf', 'semarang', '08123', '081234', 'SP01gmail', 'boy', 'Supplier Keyboard', '2022-08-20 00:25:53'),
(3, 'ttttttt', 'ttttttttt', 'ttttttttt', 'tttttttt', 'ttttttt', 'tttttttt', 'aaaaaaaaaaaa', '2022-08-20 00:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_trim_detail`
--

CREATE TABLE `tb_trim_detail` (
  `id` int(11) NOT NULL,
  `id_trim` varchar(200) NOT NULL,
  `id_item` int(200) NOT NULL,
  `qty` int(200) NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_trim_detail`
--

INSERT INTO `tb_trim_detail` (`id`, `id_trim`, `id_item`, `qty`, `remark`) VALUES
(46, '2', 47, 1000, 'ok'),
(47, '2', 50, 8000, 'ok'),
(54, '3', 50, 34, 'ccc'),
(68, '5', 50, 11, 'ok'),
(69, '5', 52, 11, 'ok'),
(70, '5', 48, 23, 'fdg'),
(73, '6', 47, 0, '00'),
(74, '6', 54, 0, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_trim_order`
--

CREATE TABLE `tb_trim_order` (
  `id_trim` int(25) NOT NULL,
  `trim_code` varchar(200) NOT NULL,
  `trim_mo` varchar(200) NOT NULL,
  `trim_style` varchar(200) NOT NULL,
  `trim_destination` varchar(200) NOT NULL,
  `trim_date` varchar(200) NOT NULL,
  `trim_status` varchar(200) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_trim_order`
--

INSERT INTO `tb_trim_order` (`id_trim`, `trim_code`, `trim_mo`, `trim_style`, `trim_destination`, `trim_date`, `trim_status`, `remark`, `user`) VALUES
(2, 'P0122-450525-009 (348M)xx', '0', 'HEATTECH crew neck S/S T-shirt', '(01372F002L) JAPAN', '08/25/2022', 'Request', 'BREAKDOWN			TOTAL\r\nSIZE	COLOR		\r\n	00 WHITE	09 BLACK	\r\nS	5,980	7,000	12980\r\nM	19,020	16,060	35080\r\nL	18,000	17,000	35000\r\nXL	7,000	10,040	17040\r\nTOTAL	50,000	50,100	100,100\r\n', 'rozi@gmail.com'),
(3, 'ccccccc', '0', '444444', 'cccccccccccccccc', '08/25/2022', 'Request', 'cccccccc', 'rozi@gmail.com'),
(5, '8888', 'qqq', '888', '888', '09/05/2022', 'Request', '88888', 'rozi@gmail.com'),
(6, '00', 'vvvvvvv', '00', '00', '09/05/2022', 'Request', '000', 'rozi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Admin', 'rozi@gmail.com', 'default1.jpg', '$2y$10$LR2nO4mqm1Qcpc04u4O5OOMETk9dHxZGYQhreElvxhH2AJwMcpAde', 1, 1, 1554436022),
(69, 'rita', 'ppic@gmail.com', 'default1.jpg', '$2y$10$LR2nO4mqm1Qcpc04u4O5OOMETk9dHxZGYQhreElvxhH2AJwMcpAde', 2, 1, 1554436022),
(70, 'lita', 'purchasing@gmail.com', 'default1.jpg', '$2y$10$LR2nO4mqm1Qcpc04u4O5OOMETk9dHxZGYQhreElvxhH2AJwMcpAde', 3, 1, 1554436022);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`, `permission`) VALUES
(1, 1, 1, ''),
(4, 1, 3, ''),
(5, 1, 4, ''),
(10, 3, 2, ''),
(11, 3, 3, ''),
(12, 3, 4, ''),
(13, 1, 5, ''),
(14, 1, 6, ''),
(15, 1, 7, ''),
(25, 4, 35, ''),
(27, 1, 8, ''),
(28, 1, 35, ''),
(32, 4, 8, ''),
(34, 1, 36, ''),
(35, 5, 4, ''),
(36, 5, 8, ''),
(39, 4, 4, ''),
(40, 4, 36, ''),
(41, 6, 4, ''),
(42, 6, 8, ''),
(43, 6, 35, ''),
(52, 1, 39, ''),
(53, 1, 40, ''),
(54, 1, 41, ''),
(55, 1, 42, ''),
(56, 1, 44, ''),
(58, 2, 46, ''),
(59, 2, 44, ''),
(60, 1, 49, ''),
(61, 1, 50, ''),
(62, 1, 51, ''),
(63, 2, 49, ''),
(64, 2, 51, ''),
(65, 3, 44, ''),
(66, 3, 50, ''),
(67, 3, 51, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_bakup`
--

CREATE TABLE `user_bakup` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_bakup`
--

INSERT INTO `user_bakup` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'khoirur Rozikin', 'rozi@gmail.com', 'default1.jpg', '$2y$10$LR2nO4mqm1Qcpc04u4O5OOMETk9dHxZGYQhreElvxhH2AJwMcpAde', 1, 1, 1554436022),
(67, 'roziee', 'rozi@kurios-utama.com', 'default.jpg', '$2y$10$ZI11ROlxlaFIw3TxUh1TrOu3pK0phpYTGuFQiwngUAUqOEP/HxPky', 2, 1, 1643274029),
(68, 'riska', 'minion.indonesia33@gmail.com', 'default.jpg', '$2y$10$KQakb8lwMF3ijlcZSSg0TeaRDOsvwOU.ZLKYcBBVrSBR0oDfaC/RS', 2, 1, 1643335828),
(69, 'lsno', 'lano@gmail.com', 'default.jpg', '$2y$10$mUHG9a7uWZqtfUQCr2suc.OfZwDEMA/mL6LLu4qP1UdYr1VwwdA3O', 2, 0, 1643986286),
(70, 'stylus', 'stylus.smg@gmail.com', 'default.jpg', '$2y$10$sQL5qYiOL10lvTeJw.hbj.pFTw2ZNSjDBGTzBWHj4RATttg/n4S6K', 2, 1, 1643986388);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `icon` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`) VALUES
(1, 'Admin', 'fas fa-fw fa-user-tie'),
(2, 'User', ''),
(44, 'Master', 'fas fa-book'),
(49, 'PPIC', 'fas fa-edit'),
(50, 'Purchasing', 'fas fa-cart-plus'),
(51, 'Tracking', 'fas fa-cart-plus');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'PPIC'),
(3, 'Purchasing');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(2, 2, 'My Profile', 'user', 'far fa-circle', 1),
(3, 2, 'Edit Profile', 'user/edit', 'far fa-circle', 1),
(4, 1, 'Menu', 'menu', 'far fa-circle', 1),
(5, 1, 'Submenu', 'menu/submenu', 'far fa-circle', 1),
(9, 1, 'Dashboard', 'admin', 'far fa-circle', 1),
(24, 2, 'Change Password', 'user/changepwd', 'far fa-circle', 1),
(25, 1, 'Role', 'admin/role', 'far fa-circle', 1),
(79, 44, 'Item List', 'Controller_Item', 'far fa-circle', 1),
(80, 44, 'Color List', 'Controller_Color', 'far fa-circle', 1),
(81, 44, 'Supplier List', 'Controller_Supplier', 'far fa-circle', 1),
(82, 44, 'Size List', 'Controller_Size', 'far fa-circle', 1),
(83, 49, 'Add Trims Order', 'Controller_Trimsorder/Add_Trim_Order', 'far fa-circle', 1),
(84, 50, 'Request Order', 'Controller_Purchase/Request_Purchase', 'far fa-circle', 1),
(85, 49, 'Manage Trim Order', 'Controller_Trimsorder', 'far fa-circle', 1),
(86, 50, 'Add Purchase Order', 'Controller_Purchase/Add_Purchase', 'far fa-circle', 1),
(87, 50, 'Manage Purchase Order', 'Controller_Purchase', 'far fa-circle', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(36, 'lano@gmail.com', 'HTxcuFKEGSkggApgWkEYGIwXBsrX8lu2XTtDdqYuMSY=', 1643986286),
(38, 'pink@gmail.com', 'z/xjXxo6+VIkHFIH6bRevxMQJg2FA/iTA16kcXn/7pU=', 1644376241);

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `ip` varchar(20) DEFAULT NULL,
  `date` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`ip`, `date`, `hits`, `online`, `time`) VALUES
('192.168.0.254', '2022-02-18', 20, '1645193962', '2022-02-18 16:03:40'),
('192.168.0.254', '2022-02-24', 2, '1645656334', '2022-02-24 05:45:33'),
('192.168.0.254', '2022-02-27', 1, '1645968268', '2022-02-27 20:24:28'),
('192.168.0.254', '2022-03-02', 1, '1646197055', '2022-03-02 11:57:35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_items`
-- (See below for the actual view)
--
CREATE TABLE `v_items` (
`id_item` int(11)
,`item_code` varchar(255)
,`item_description` varchar(255)
,`id_supplier` int(255)
,`id_color` int(100)
,`color` varchar(255)
,`id_size` int(100)
,`size_code` varchar(255)
,`supplier_name` varchar(255)
,`supplier_address` varchar(255)
,`supplier_phone` varchar(255)
,`supplier_email` varchar(255)
,`item_price` varchar(255)
,`currency` varchar(255)
,`unit` varchar(255)
,`remark` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_menu`
-- (See below for the actual view)
--
CREATE TABLE `v_menu` (
`ID` int(11)
,`menu_id` int(11)
,`menu` varchar(128)
,`title` varchar(128)
,`url` varchar(128)
,`icon` varchar(128)
,`is_active` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_trimorder_detail`
-- (See below for the actual view)
--
CREATE TABLE `v_trimorder_detail` (
`id` int(11)
,`id_trim` varchar(200)
,`id_item` int(200)
,`item_code` varchar(255)
,`item_description` varchar(255)
,`color` varchar(255)
,`size_code` varchar(255)
,`item_remark` varchar(255)
,`supplier_name` varchar(255)
,`qty` int(200)
,`detail_remark` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_trimorder_fix`
-- (See below for the actual view)
--
CREATE TABLE `v_trimorder_fix` (
`id_trim` int(25)
,`trim_code` varchar(200)
,`trim_style` varchar(200)
,`trim_destination` varchar(200)
,`trim_date` varchar(200)
,`trim_status` varchar(200)
,`remark` varchar(200)
,`User` varchar(200)
,`id_item` int(200)
,`item_code` varchar(255)
,`item_description` varchar(255)
,`color` varchar(255)
,`size_code` varchar(255)
,`item_remark` varchar(255)
,`qty` int(200)
,`detail_remark` varchar(200)
);

-- --------------------------------------------------------

--
-- Structure for view `v_items`
--
DROP TABLE IF EXISTS `v_items`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_items`  AS SELECT `tb_items`.`id_item` AS `id_item`, `tb_items`.`item_code` AS `item_code`, `tb_items`.`item_description` AS `item_description`, `tb_items`.`id_supplier` AS `id_supplier`, `tb_items`.`id_color` AS `id_color`, `tb_colors`.`color` AS `color`, `tb_items`.`id_size` AS `id_size`, `tb_size`.`size_code` AS `size_code`, `tb_supplier`.`supplier_name` AS `supplier_name`, `tb_supplier`.`supplier_address` AS `supplier_address`, `tb_supplier`.`supplier_phone` AS `supplier_phone`, `tb_supplier`.`supplier_email` AS `supplier_email`, `tb_items`.`item_price` AS `item_price`, `tb_items`.`currency` AS `currency`, `tb_items`.`unit` AS `unit`, `tb_items`.`remark` AS `remark` FROM (((`tb_items` join `tb_supplier` on(`tb_items`.`id_supplier` = `tb_supplier`.`id_supplier`)) join `tb_size` on(`tb_items`.`id_size` = `tb_size`.`id_size`)) join `tb_colors` on(`tb_items`.`id_color` = `tb_colors`.`id_color`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_menu`
--
DROP TABLE IF EXISTS `v_menu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_menu`  AS SELECT `user_sub_menu`.`id` AS `ID`, `user_sub_menu`.`menu_id` AS `menu_id`, `user_menu`.`menu` AS `menu`, `user_sub_menu`.`title` AS `title`, `user_sub_menu`.`url` AS `url`, `user_sub_menu`.`icon` AS `icon`, `user_sub_menu`.`is_active` AS `is_active` FROM (`user_menu` join `user_sub_menu` on(`user_menu`.`id` = `user_sub_menu`.`menu_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_trimorder_detail`
--
DROP TABLE IF EXISTS `v_trimorder_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trimorder_detail`  AS SELECT `tb_trim_detail`.`id` AS `id`, `tb_trim_detail`.`id_trim` AS `id_trim`, `tb_trim_detail`.`id_item` AS `id_item`, `v_items`.`item_code` AS `item_code`, `v_items`.`item_description` AS `item_description`, `v_items`.`color` AS `color`, `v_items`.`size_code` AS `size_code`, `v_items`.`remark` AS `item_remark`, `v_items`.`supplier_name` AS `supplier_name`, `tb_trim_detail`.`qty` AS `qty`, `tb_trim_detail`.`remark` AS `detail_remark` FROM (`tb_trim_detail` join `v_items` on(`tb_trim_detail`.`id_item` = `v_items`.`id_item`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_trimorder_fix`
--
DROP TABLE IF EXISTS `v_trimorder_fix`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trimorder_fix`  AS SELECT `tb_trim_order`.`id_trim` AS `id_trim`, `tb_trim_order`.`trim_code` AS `trim_code`, `tb_trim_order`.`trim_style` AS `trim_style`, `tb_trim_order`.`trim_destination` AS `trim_destination`, `tb_trim_order`.`trim_date` AS `trim_date`, `tb_trim_order`.`trim_status` AS `trim_status`, `tb_trim_order`.`remark` AS `remark`, `tb_trim_order`.`user` AS `User`, `v_trimorder_detail`.`id_item` AS `id_item`, `v_trimorder_detail`.`item_code` AS `item_code`, `v_trimorder_detail`.`item_description` AS `item_description`, `v_trimorder_detail`.`color` AS `color`, `v_trimorder_detail`.`size_code` AS `size_code`, `v_trimorder_detail`.`item_remark` AS `item_remark`, `v_trimorder_detail`.`qty` AS `qty`, `v_trimorder_detail`.`detail_remark` AS `detail_remark` FROM (`tb_trim_order` join `v_trimorder_detail` on(`tb_trim_order`.`id_trim` = `v_trimorder_detail`.`id_trim`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_colors`
--
ALTER TABLE `tb_colors`
  ADD PRIMARY KEY (`id_color`);

--
-- Indexes for table `tb_items`
--
ALTER TABLE `tb_items`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `tb_purchase_order`
--
ALTER TABLE `tb_purchase_order`
  ADD PRIMARY KEY (`id_po`);

--
-- Indexes for table `tb_purchase_order_detail`
--
ALTER TABLE `tb_purchase_order_detail`
  ADD PRIMARY KEY (`id_po_detail`);

--
-- Indexes for table `tb_size`
--
ALTER TABLE `tb_size`
  ADD PRIMARY KEY (`id_size`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_trim_detail`
--
ALTER TABLE `tb_trim_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_trim_order`
--
ALTER TABLE `tb_trim_order`
  ADD PRIMARY KEY (`id_trim`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_bakup`
--
ALTER TABLE `user_bakup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_colors`
--
ALTER TABLE `tb_colors`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_items`
--
ALTER TABLE `tb_items`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_purchase_order`
--
ALTER TABLE `tb_purchase_order`
  MODIFY `id_po` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_purchase_order_detail`
--
ALTER TABLE `tb_purchase_order_detail`
  MODIFY `id_po_detail` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_size`
--
ALTER TABLE `tb_size`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_trim_detail`
--
ALTER TABLE `tb_trim_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tb_trim_order`
--
ALTER TABLE `tb_trim_order`
  MODIFY `id_trim` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `user_bakup`
--
ALTER TABLE `user_bakup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
