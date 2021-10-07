-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Out-2021 às 09:41
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `web_store`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(10) UNSIGNED NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `admins`
--

INSERT INTO `admins` (`id_admin`, `user`, `pass`, `created_at`, `updated_at`, `deleted_at`, `active`, `gender`, `telephone`, `city`, `full_name`, `address`, `image`) VALUES
(108, 'carlos@mail.com', '$2y$10$aKYMq2V6PNUKRogI4eE.6.09NxL1NvpgeSshJa4IeEeoBDurdsUnm', '2021-09-08 10:38:11', '2021-10-04 09:15:41', NULL, 1, 'M', '967389659', 'Évora', 'Carlos  Serodio', 'address', '4.jpg'),
(126, 'maria@hotmail.com', '$2y$10$4yyynUTblEYF0Ycw.cpzCuuNI5nmLy8caFle3.Shax6lOQSxSRz.W', '2021-09-13 16:50:35', '2021-09-24 10:53:25', NULL, 1, 'F', '964309659', 'Évora', 'Maria', 'address', '7.jpg'),
(172, 'joana.manuela@mail.com', '$2y$10$.nDE0S1o2eh4VtzA6JgE9u3ZxiqLGTaIjB0WC.UsFWQZhIgo3VF7W', '2021-09-24 11:00:52', '2021-09-24 17:37:08', NULL, 1, 'F', '914014012', 'city', 'joana manuela', 'address', '16.jpg'),
(173, 'joao.manuel@mail.com', '$2y$10$hwqa749y8nHwyehQHA88dOVnU.7MODHF0g/iQiyJnmEZnVIT3Ex4q', '2021-09-24 18:03:12', '2021-09-24 18:03:55', NULL, 1, 'M', '914555000', 'city', 'joao manuel', 'address', '5.jpg'),
(174, 'carlosserodio86@hotmail.com', '$2y$10$TDYA4hZBMkKG6vNpeeBXWu0Zt03fbPKPwWpyBy/387e4jQorYp7pa', '2021-09-27 08:56:05', '2021-09-27 11:50:07', NULL, 1, 'M', '967389659', 'Évora', 'Carlos Serôdio', 'Rua Barbosa do Bocage n 3A', '26.jpg'),
(175, 'ana.barbosa@mail.com', '$2y$10$agh.nf2D32TU8gp74MsSOO1rsSCnelDoWcvIvOaFfIzsddurKlEPC', '2021-09-27 08:59:30', '2021-09-27 09:00:06', NULL, 0, 'F', '930011901', 'city', 'Ana Barbosa', 'address', '18.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(10) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(250) DEFAULT NULL,
  `full_name` varchar(250) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `purl` varchar(50) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `customers`
--

INSERT INTO `customers` (`id_customer`, `email`, `pass`, `full_name`, `address`, `city`, `telephone`, `purl`, `active`, `created_at`, `updated_at`, `deleted_at`, `gender`, `image`) VALUES
(17, 'joaquim.faria@mail.com', '$2y$10$2L37oSQwRocebRiPFmWvEuyl3VP2iHNZcqAfQ9qo7knWP7xSDQCge', 'Joaquim Faria', 'Morada X', 'City 1000', '915700769', NULL, 1, '2021-08-09 09:24:06', '2021-10-06 17:22:32', NULL, 'M', '4.jpg'),
(19, 'andre.barreto@mail.com', '$2y$10$mgFFqHpo9X0bxhbHL2AyauKtgKcFMTb/bgNtnPQSJbdzUjJZJK0ky', 'Andre Barreto', 'Morada C', 'Lisboa', '914569120', NULL, 0, '2021-08-09 09:33:12', '2021-09-30 18:56:38', NULL, 'M', '21.jpg'),
(33, 'euniceminhoto@hotmail.com', '$2y$10$VxVTNj6e/VRdMAhrUsK0Teje9WuART5W10F1J9BvtDDRfRcX6pume', 'Eunice Minhoto', 'Rua José Sebastião Cebola n14A', 'Évora', '351 965 450 395', NULL, 0, '2021-08-11 00:35:50', '2021-09-30 18:57:00', NULL, 'M', '7.jpg'),
(34, 'ana.maria@mail.com', '$2y$10$Zi8owRnjoqQi1dity2SrLOC/GgOfzVe9mfYabmsP7RkqrkkLtWwcW', 'Ana Maria', 'address Z', 'city Z', '915104321', NULL, 1, '2021-08-11 09:40:50', '2021-08-18 19:25:17', NULL, 'F', '14.jpg'),
(81, 'maria@hotmail.com', '$2y$10$ptM5FB7IKzo7TSGr8sbP.enubVpSVpxb.ttOv.IBK0yBLqPKT9BKS', 'maria', 'address', 'Évora', '914132964', NULL, 1, '2021-08-19 10:25:26', '2021-08-19 10:25:50', NULL, 'F', '11.jpg'),
(83, 'carlosserodio1986@gmail.com', '$2y$10$77uWZVmgwXQ9zNoqAlJ6quyqipLjEm5nwiRfrwuZKbUalqy1AKtT2', 'Carlos Andre Piteira Serodio', 'address', 'Évora', '967389659', 'o9rtdOm1hDz8', 0, '2021-08-19 18:32:19', '2021-08-19 18:32:19', NULL, 'M', '5.jpg'),
(85, 'carlos99@mail.com', '$2y$10$xmnNZdLZeFy7ofklCmg2QuKcQS43z52MnbEy/s/hm2N7ZIVQT/cqm', 'Carlos Andre Piteira Serodio', '3A', 'Évora', '914132964', 'qIL4Ni2Qu2cp', 0, '2021-08-19 18:51:02', '2021-08-19 18:51:02', NULL, 'M', '23.jpg'),
(86, 'carlosserodio86@hotmail.com', '123456', 'Carlos Andre Piteira Serodio', 'Rua Barbosa do Bocage 3A', 'Évora', '967389659', NULL, 1, '2021-08-31 11:32:40', '2021-09-27 17:09:14', NULL, 'M', '4.jpg'),
(96, 'joao.pina@mail.com', '$2y$10$sGEGj2CyfS9nrj8WYKzcb.cjU7n0xsxxk6BQdnJ5hOYKMp8nUIL5a', 'Joao Pina', 'address', 'city', '937501123', 'LXpOMTYwyw5q', 1, '2021-09-27 10:36:30', '2021-09-27 10:36:30', NULL, 'M', '13.jpg'),
(99, 'pinto.sa@mail.com', '$2y$10$V/u8essyh2KzfNHKP/YQF.ytjEDhhNGNk6tnY/yMumMaIyPv0IFn.', 'Pinto Sá', 'address', 'city', '914140134', 'GU023alDBt2F', 1, '2021-09-27 15:36:09', '2021-10-06 17:28:47', NULL, 'M', '5.jpg'),
(100, 'carlos@mail.com', '$2y$10$aGHIXb.NDaL9ljtRPBhzvOb6tW0wxJOjjutb7Qt8lWSdwIOXyLXZS', 'Carlos Serodio', 'address', 'city', '961410560', 'E2cOp2fSZnjK', 1, '2021-09-27 18:03:43', '2021-10-06 17:23:09', NULL, 'M', '4.jpg'),
(101, 'joao@mail.com', '$2y$10$SAo0Mt5Nh.wm2K/kUFPSreCmI66mKjSJb.pY6G1SrseyVL5F62DvS', 'Joao', 'address', 'city', '915000129', 'UTXrueltfzBx', 1, '2021-09-28 17:47:46', '2021-09-28 17:49:24', NULL, 'M', '1.jpg'),
(102, 'manuel.vida@mail.com', '$2y$10$NO.3B4qwtpuJRlh3y/GiZ.NtCVxHhfr1f8mvp8EzB7KsFSBXZi7Ly', 'Manuel', 'address', 'city', '915000129', 'jiIDKyrXyE14', 0, '2021-09-28 18:00:22', '2021-09-28 18:00:22', NULL, 'M', '13.jpg'),
(103, 'rui.vieira@mail.com', '$2y$10$9.xrPQzpuKBBsORzvx0uyO2P6AgIDrsxvcjVRfphwI0BjjJWSJrWS', 'Rui', 'address', 'city', '915890129', 'QEKqyZrdcTST', 0, '2021-09-28 18:04:02', '2021-09-28 18:04:02', NULL, 'M', '15.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orders`
--

CREATE TABLE `orders` (
  `id_order` int(10) UNSIGNED NOT NULL,
  `id_customer` int(10) UNSIGNED DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `order_code` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `orders`
--

INSERT INTO `orders` (`id_order`, `id_customer`, `order_date`, `address`, `city`, `email`, `telephone`, `order_code`, `status`, `message`, `created_at`, `updated_at`, `full_name`) VALUES
(96, 79, '2021-08-26 08:50:28', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'DF942441', 'PROCESSING', '', '2021-08-26 08:50:28', '2021-10-06 17:32:45', 'Carlos Andre Piteira Serodio'),
(97, 79, '2021-08-26 08:52:00', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YM141005', 'PROCESSING', '', '2021-08-26 08:52:00', '2021-10-04 10:03:59', 'Carlos Andre Piteira Serodio'),
(98, 79, '2021-08-26 08:52:38', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ZJ829545', 'PROCESSING', '', '2021-08-26 08:52:38', '2021-10-06 08:16:24', 'Carlos Andre Piteira Serodio'),
(99, 79, '2021-08-26 08:53:31', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'FF409105', 'PENDENT', '', '2021-08-26 08:53:31', '2021-08-26 08:53:31', 'Carlos Andre Piteira Serodio'),
(100, 79, '2021-08-26 08:55:40', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ND242422', 'PENDENT', '', '2021-08-26 08:55:40', '2021-08-26 08:55:40', 'Carlos Andre Piteira Serodio'),
(101, 79, '2021-08-26 08:58:48', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'FY614105', 'PENDENT', '', '2021-08-26 08:58:48', '2021-08-26 08:58:48', 'Carlos Andre Piteira Serodio'),
(104, 79, '2021-08-26 09:09:22', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'CS858882', 'PENDENT', '', '2021-08-26 09:09:22', '2021-08-26 09:09:22', 'Carlos Andre Piteira Serodio'),
(106, 79, '2021-08-26 09:14:11', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'XW347284', 'PENDENT', '', '2021-08-26 09:14:11', '2021-08-26 09:14:11', 'Carlos Andre Piteira Serodio'),
(107, 79, '2021-08-26 09:15:54', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'VD710182', 'PENDENT', '', '2021-08-26 09:15:54', '2021-08-26 09:15:54', 'Carlos Andre Piteira Serodio'),
(108, 79, '2021-08-26 09:17:20', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'BE796128', 'PENDENT', '', '2021-08-26 09:17:20', '2021-08-26 09:17:20', 'Carlos Andre Piteira Serodio'),
(109, 79, '2021-08-26 09:19:26', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'RJ584183', 'PENDENT', '', '2021-08-26 09:19:26', '2021-08-26 09:19:26', 'Carlos Andre Piteira Serodio'),
(110, 79, '2021-08-26 09:20:52', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'SH463490', 'PENDENT', '', '2021-08-26 09:20:52', '2021-08-26 09:20:52', 'Carlos Andre Piteira Serodio'),
(111, 79, '2021-08-26 09:22:01', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YP110941', 'PENDENT', '', '2021-08-26 09:22:01', '2021-08-26 09:22:01', 'Carlos Andre Piteira Serodio'),
(112, 79, '2021-08-26 09:26:01', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ID853407', 'PENDENT', '', '2021-08-26 09:26:01', '2021-08-26 09:26:01', 'Carlos Andre Piteira Serodio'),
(113, 79, '2021-08-26 09:26:50', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ZP748659', 'PENDENT', '', '2021-08-26 09:26:50', '2021-08-26 09:26:50', 'Carlos Andre Piteira Serodio'),
(114, 79, '2021-08-26 09:27:35', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'QN388991', 'PENDENT', '', '2021-08-26 09:27:35', '2021-08-26 09:27:35', 'Carlos Andre Piteira Serodio'),
(115, 79, '2021-08-26 09:28:44', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'DK287294', 'PENDENT', '', '2021-08-26 09:28:44', '2021-08-26 09:28:44', 'Carlos Andre Piteira Serodio'),
(116, 79, '2021-08-26 09:36:28', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'MG501136', 'PENDENT', '', '2021-08-26 09:36:28', '2021-08-26 09:36:28', 'Carlos Andre Piteira Serodio'),
(117, 79, '2021-08-26 09:39:23', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'LE269485', 'PENDENT', '', '2021-08-26 09:39:23', '2021-08-26 09:39:23', 'Carlos Andre Piteira Serodio'),
(118, 79, '2021-08-26 09:40:04', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'FT774234', 'PENDENT', '', '2021-08-26 09:40:04', '2021-08-26 09:40:04', 'Carlos Andre Piteira Serodio'),
(119, 79, '2021-08-26 09:41:55', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'CV718704', 'PENDENT', '', '2021-08-26 09:41:55', '2021-08-26 09:41:55', 'Carlos Andre Piteira Serodio'),
(120, 79, '2021-08-26 09:43:08', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'GM699788', 'PENDENT', '', '2021-08-26 09:43:08', '2021-08-26 09:43:08', 'Carlos Andre Piteira Serodio'),
(121, 79, '2021-08-26 09:46:54', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'XD125562', 'PENDENT', '', '2021-08-26 09:46:54', '2021-08-26 09:46:54', 'Carlos Andre Piteira Serodio'),
(122, 79, '2021-08-26 09:47:41', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'NP442926', 'PENDENT', '', '2021-08-26 09:47:41', '2021-08-26 09:47:41', 'Carlos Andre Piteira Serodio'),
(123, 79, '2021-08-26 09:48:30', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'OD595636', 'PENDENT', '', '2021-08-26 09:48:30', '2021-08-26 09:48:30', 'Carlos Andre Piteira Serodio'),
(124, 79, '2021-08-26 09:50:09', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'TO404551', 'PENDENT', '', '2021-08-26 09:50:09', '2021-08-26 09:50:09', 'Carlos Andre Piteira Serodio'),
(125, 79, '2021-08-26 09:50:43', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'PA157345', 'PENDENT', '', '2021-08-26 09:50:43', '2021-08-26 09:50:43', 'Carlos Andre Piteira Serodio'),
(126, 79, '2021-08-26 09:51:26', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'DQ908678', 'PENDENT', '', '2021-08-26 09:51:26', '2021-08-26 09:51:26', 'Carlos Andre Piteira Serodio'),
(127, 79, '2021-08-26 09:54:28', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'AS806761', 'PENDENT', '', '2021-08-26 09:54:28', '2021-08-26 09:54:28', 'Carlos Andre Piteira Serodio'),
(128, 79, '2021-08-26 09:55:28', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'KL575244', 'PENDENT', '', '2021-08-26 09:55:28', '2021-08-26 09:55:28', 'Carlos Andre Piteira Serodio'),
(129, 79, '2021-08-26 09:56:29', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'EG782362', 'PENDENT', '', '2021-08-26 09:56:29', '2021-08-26 09:56:29', 'Carlos Andre Piteira Serodio'),
(130, 79, '2021-08-26 09:57:59', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'MI431800', 'PENDENT', '', '2021-08-26 09:57:59', '2021-08-26 09:57:59', 'Carlos Andre Piteira Serodio'),
(131, 79, '2021-08-26 09:59:11', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YU615750', 'PENDENT', '', '2021-08-26 09:59:11', '2021-08-26 09:59:11', 'Carlos Andre Piteira Serodio'),
(132, 79, '2021-08-26 09:59:58', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'DU884548', 'PENDENT', '', '2021-08-26 09:59:58', '2021-08-26 09:59:58', 'Carlos Andre Piteira Serodio'),
(133, 79, '2021-08-26 10:02:38', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'AB587294', 'PENDENT', '', '2021-08-26 10:02:38', '2021-08-26 10:02:38', 'Carlos Andre Piteira Serodio'),
(134, 79, '2021-08-26 10:04:15', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'QL786890', 'PENDENT', '', '2021-08-26 10:04:15', '2021-08-26 10:04:15', 'Carlos Andre Piteira Serodio'),
(135, 79, '2021-08-26 10:05:21', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'NH529724', 'PENDENT', '', '2021-08-26 10:05:21', '2021-08-26 10:05:21', 'Carlos Andre Piteira Serodio'),
(136, 79, '2021-08-26 10:05:56', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'FN237595', 'PENDENT', '', '2021-08-26 10:05:56', '2021-08-26 10:05:56', 'Carlos Andre Piteira Serodio'),
(137, 79, '2021-08-26 10:07:46', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'EG945770', 'PENDENT', '', '2021-08-26 10:07:46', '2021-08-26 10:07:46', 'Carlos Andre Piteira Serodio'),
(138, 79, '2021-08-26 10:10:13', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'PD483804', 'PENDENT', '', '2021-08-26 10:10:13', '2021-08-26 10:10:13', 'Carlos Andre Piteira Serodio'),
(139, 79, '2021-08-26 10:10:50', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'GZ818692', 'PENDENT', '', '2021-08-26 10:10:50', '2021-08-26 10:10:50', 'Carlos Andre Piteira Serodio'),
(140, 79, '2021-08-26 10:12:12', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'XD619499', 'PENDENT', '', '2021-08-26 10:12:12', '2021-08-26 10:12:12', 'Carlos Andre Piteira Serodio'),
(141, 79, '2021-08-26 10:13:18', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'RS416588', 'PENDENT', '', '2021-08-26 10:13:18', '2021-08-26 10:13:18', 'Carlos Andre Piteira Serodio'),
(142, 79, '2021-08-26 10:14:38', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'PH393422', 'PENDENT', '', '2021-08-26 10:14:38', '2021-08-26 10:14:38', 'Carlos Andre Piteira Serodio'),
(143, 79, '2021-08-26 10:16:04', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'BK525706', 'PENDENT', '', '2021-08-26 10:16:04', '2021-08-26 10:16:04', 'Carlos Andre Piteira Serodio'),
(144, 79, '2021-08-26 10:17:33', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ND503165', 'PENDENT', '', '2021-08-26 10:17:33', '2021-08-26 10:17:33', 'Carlos Andre Piteira Serodio'),
(145, 79, '2021-08-26 10:18:50', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'VX680192', 'PENDENT', '', '2021-08-26 10:18:50', '2021-08-26 10:18:50', 'Carlos Andre Piteira Serodio'),
(146, 79, '2021-08-26 10:21:46', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'KM286037', 'PENDENT', '', '2021-08-26 10:21:46', '2021-08-26 10:21:46', 'Carlos Andre Piteira Serodio'),
(147, 79, '2021-08-26 10:23:23', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'WA331817', 'PENDENT', '', '2021-08-26 10:23:23', '2021-08-26 10:23:23', 'Carlos Andre Piteira Serodio'),
(148, 79, '2021-08-26 10:24:34', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YY393554', 'PENDENT', '', '2021-08-26 10:24:34', '2021-08-26 10:24:34', 'Carlos Andre Piteira Serodio'),
(149, 79, '2021-08-26 10:30:50', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'JB542179', 'PENDENT', '', '2021-08-26 10:30:50', '2021-08-26 10:30:50', 'Carlos Andre Piteira Serodio'),
(150, 79, '2021-08-26 10:33:48', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'UA553239', 'PENDENT', '', '2021-08-26 10:33:48', '2021-08-26 10:33:48', 'Carlos Andre Piteira Serodio'),
(151, 79, '2021-08-26 10:35:27', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'KL775673', 'PENDENT', '', '2021-08-26 10:35:27', '2021-08-26 10:35:27', 'Carlos Andre Piteira Serodio'),
(152, 79, '2021-08-26 10:37:36', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'OP639758', 'PENDENT', '', '2021-08-26 10:37:36', '2021-08-26 10:37:36', 'Carlos Andre Piteira Serodio'),
(153, 79, '2021-08-26 10:37:56', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'VP642836', 'PENDENT', '', '2021-08-26 10:37:56', '2021-08-26 10:37:56', 'Carlos Andre Piteira Serodio'),
(154, 79, '2021-08-26 10:38:52', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YK177285', 'PENDENT', '', '2021-08-26 10:38:52', '2021-08-26 10:38:52', 'Carlos Andre Piteira Serodio'),
(155, 79, '2021-08-26 10:40:03', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'FC689604', 'PENDENT', '', '2021-08-26 10:40:03', '2021-08-26 10:40:03', 'Carlos Andre Piteira Serodio'),
(156, 79, '2021-08-26 10:41:45', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ZZ467666', 'PENDENT', '', '2021-08-26 10:41:45', '2021-08-26 10:41:45', 'Carlos Andre Piteira Serodio'),
(157, 79, '2021-08-26 10:44:02', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'NG561796', 'PENDENT', '', '2021-08-26 10:44:02', '2021-08-26 10:44:02', 'Carlos Andre Piteira Serodio'),
(158, 79, '2021-08-26 10:45:05', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'XL560743', 'PENDENT', '', '2021-08-26 10:45:05', '2021-08-26 10:45:05', 'Carlos Andre Piteira Serodio'),
(159, 79, '2021-08-26 10:45:18', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'MW656712', 'PENDENT', '', '2021-08-26 10:45:18', '2021-08-26 10:45:18', 'Carlos Andre Piteira Serodio'),
(160, 79, '2021-08-26 10:45:54', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'MU356356', 'PENDENT', '', '2021-08-26 10:45:54', '2021-08-26 10:45:54', 'Carlos Andre Piteira Serodio'),
(161, 79, '2021-08-26 10:48:54', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'AV393375', 'PENDENT', '', '2021-08-26 10:48:54', '2021-08-26 10:48:54', 'Carlos Andre Piteira Serodio'),
(162, 79, '2021-08-26 10:50:10', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'AI565692', 'PENDENT', '', '2021-08-26 10:50:10', '2021-08-26 10:50:10', 'Carlos Andre Piteira Serodio'),
(163, 79, '2021-08-26 10:56:57', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'NO365691', 'PENDENT', '', '2021-08-26 10:56:57', '2021-08-26 10:56:57', 'Carlos Andre Piteira Serodio'),
(164, 79, '2021-08-26 10:57:57', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ZC579172', 'PENDENT', '', '2021-08-26 10:57:57', '2021-08-26 10:57:57', 'Carlos Andre Piteira Serodio'),
(165, 79, '2021-08-26 11:00:01', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'TV725496', 'PENDENT', '', '2021-08-26 11:00:01', '2021-08-26 11:00:01', 'Carlos Andre Piteira Serodio'),
(166, 79, '2021-08-26 11:03:39', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'LV941019', 'PENDENT', '', '2021-08-26 11:03:39', '2021-08-26 11:03:39', 'Carlos Andre Piteira Serodio'),
(167, 79, '2021-08-26 11:05:59', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'OJ741137', 'PENDENT', '', '2021-08-26 11:05:59', '2021-08-26 11:05:59', 'Carlos Andre Piteira Serodio'),
(168, 79, '2021-08-26 11:08:43', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'LP862591', 'PENDENT', '', '2021-08-26 11:08:43', '2021-08-26 11:08:43', 'Carlos Andre Piteira Serodio'),
(169, 79, '2021-08-26 11:10:05', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'QL705881', 'PENDENT', '', '2021-08-26 11:10:05', '2021-08-26 11:10:05', 'Carlos Andre Piteira Serodio'),
(170, 79, '2021-08-26 11:10:46', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'OI999866', 'PENDENT', '', '2021-08-26 11:10:46', '2021-08-26 11:10:46', 'Carlos Andre Piteira Serodio'),
(171, 79, '2021-08-26 11:11:42', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'MX686741', 'PENDENT', '', '2021-08-26 11:11:42', '2021-08-26 11:11:42', 'Carlos Andre Piteira Serodio'),
(172, 79, '2021-08-26 11:15:46', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'HE589849', 'PENDENT', '', '2021-08-26 11:15:46', '2021-08-26 11:15:46', 'Carlos Andre Piteira Serodio'),
(173, 79, '2021-08-26 11:17:39', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'QN857648', 'PENDENT', '', '2021-08-26 11:17:39', '2021-08-26 11:17:39', 'Carlos Andre Piteira Serodio'),
(174, 79, '2021-08-26 11:18:39', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'LB889758', 'PENDENT', '', '2021-08-26 11:18:39', '2021-08-26 11:18:39', 'Carlos Andre Piteira Serodio'),
(175, 79, '2021-08-26 11:19:03', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YL664963', 'PENDENT', '', '2021-08-26 11:19:03', '2021-08-26 11:19:03', 'Carlos Andre Piteira Serodio'),
(176, 79, '2021-08-26 11:27:00', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'XI134488', 'PENDENT', '', '2021-08-26 11:27:00', '2021-08-26 11:27:00', 'Carlos Andre Piteira Serodio'),
(177, 79, '2021-08-26 11:27:38', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'UD749340', 'PENDENT', '', '2021-08-26 11:27:38', '2021-08-26 11:27:38', 'Carlos Andre Piteira Serodio'),
(178, 79, '2021-08-26 11:28:58', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'FA203571', 'PENDENT', '', '2021-08-26 11:28:58', '2021-08-26 11:28:58', 'Carlos Andre Piteira Serodio'),
(179, 79, '2021-08-26 11:33:52', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'EA633280', 'PENDENT', '', '2021-08-26 11:33:52', '2021-08-26 11:33:52', 'Carlos Andre Piteira Serodio'),
(180, 79, '2021-08-26 11:34:13', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'WW537963', 'PENDENT', '', '2021-08-26 11:34:13', '2021-08-26 11:34:13', 'Carlos Andre Piteira Serodio'),
(181, 79, '2021-08-26 11:34:35', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'NE264458', 'PENDENT', '', '2021-08-26 11:34:35', '2021-08-26 11:34:35', 'Carlos Andre Piteira Serodio'),
(182, 79, '2021-08-26 11:50:46', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'YH780902', 'PENDENT', '', '2021-08-26 11:50:46', '2021-08-26 11:50:46', 'Carlos Andre Piteira Serodio'),
(183, 79, '2021-08-26 16:25:33', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'HN170725', 'PENDENT', '', '2021-08-26 16:25:33', '2021-08-26 16:25:33', 'Carlos Andre Piteira Serodio'),
(184, 79, '2021-08-26 16:28:57', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'ML751764', 'PENDENT', '', '2021-08-26 16:28:57', '2021-08-26 16:28:57', 'Carlos Andre Piteira Serodio'),
(185, 79, '2021-08-26 16:53:57', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'BX751967', 'PENDENT', '', '2021-08-26 16:53:57', '2021-08-26 16:53:57', 'Carlos Andre Piteira Serodio'),
(186, 79, '2021-08-26 17:11:09', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'RJ470108', 'PENDENT', '', '2021-08-26 17:11:09', '2021-08-26 17:11:09', 'Carlos Andre Piteira Serodio'),
(187, 79, '2021-08-26 18:00:16', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'BV286971', 'PENDENT', '', '2021-08-26 18:00:16', '2021-08-26 18:00:16', 'Carlos Andre Piteira Serodio'),
(188, 79, '2021-08-26 19:05:38', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'VN636060', 'PENDENT', '', '2021-08-26 19:05:38', '2021-08-26 19:05:38', 'Carlos Andre Piteira Serodio'),
(189, 79, '2021-08-26 19:10:52', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'RL193732', 'PENDENT', '', '2021-08-26 19:10:52', '2021-08-26 19:10:52', 'Carlos Andre Piteira Serodio'),
(190, 79, '2021-08-27 09:20:30', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'TN664821', 'PENDENT', '', '2021-08-27 09:20:30', '2021-08-27 09:20:30', 'Carlos Andre Piteira Serodio'),
(191, 79, '2021-08-27 09:21:19', 'address 99', 'Évora', 'carlosserodio86@hotmail.com', '9134123432', 'OC876119', 'PENDENT', '', '2021-08-27 09:21:19', '2021-08-27 09:21:19', 'Carlos Andre Piteira Serodio'),
(200, 86, '2021-09-02 08:27:54', 'Rua Barbosa do Bocage 3A', 'Évora', 'carlosserodio86@hotmail.com', '967389659', 'AH599908', 'PENDENT', '', '2021-09-02 08:27:54', '2021-09-02 08:27:54', 'Carlos Andre Piteira Serodio'),
(205, 100, '2021-09-27 18:33:09', 'address', 'city', 'carlos@mail.com', '961410560', 'LV614994', 'PENDENT', '', '2021-09-27 18:33:09', '2021-09-27 18:33:09', 'Carlos'),
(206, 100, '2021-09-27 18:38:54', 'address', 'city', 'carlos@mail.com', '961410560', 'HA851669', 'PENDENT', '', '2021-09-27 18:38:54', '2021-09-27 18:38:54', 'Carlos'),
(207, 100, '2021-09-27 18:39:53', 'address', 'city', 'carlos@mail.com', '961410560', 'WC640147', 'PENDENT', '', '2021-09-27 18:39:53', '2021-09-27 18:39:53', 'Carlos'),
(208, 100, '2021-09-27 18:53:19', 'address', 'city', 'carlos@mail.com', '961410560', 'IQ835231', 'PENDENT', '', '2021-09-27 18:53:19', '2021-09-27 18:53:19', 'Carlos'),
(214, 100, '2021-10-06 16:48:14', 'address', 'city', 'carlos@mail.com', '961410560', 'NJ751748', 'PENDENT', '', '2021-10-06 16:48:14', '2021-10-06 16:48:14', 'Carlos Serodio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `order_product`
--

CREATE TABLE `order_product` (
  `id_order_product` int(10) UNSIGNED NOT NULL,
  `id_order` int(10) UNSIGNED DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `unit_price` decimal(6,2) UNSIGNED DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `order_product`
--

INSERT INTO `order_product` (`id_order_product`, `id_order`, `product_name`, `unit_price`, `quantity`, `created_at`) VALUES
(1, 1, 'sweet 1', '45.70', 1, '2021-03-18 22:17:45'),
(2, 1, 'sweet 2', '55.25', 1, '2021-03-18 22:17:45'),
(3, 1, 'sweet 3', '75.20', 1, '2021-03-18 22:17:45'),
(4, 2, 'cake 1', '86.00', 3, '2021-03-18 22:19:15'),
(5, 3, 'cake 3', '55.25', 3, '2021-05-21 21:22:11'),
(6, 4, 'cake 3', '45.70', 1, '2021-05-21 21:22:27'),
(7, 4, 'doughnut 1', '32.00', 1, '2021-05-21 21:22:27'),
(8, 4, 'doughnut 2', '75.20', 1, '2021-05-21 21:22:27'),
(9, 5, 'doughnut 3', '48.85', 2, '2021-05-21 21:22:41'),
(10, 7, 'sweet 1', '45.70', 2, '2021-07-05 18:31:02'),
(11, 7, 'sweet 2', '55.25', 2, '2021-07-05 18:31:03'),
(12, 7, 'sweet 3', '35.15', 2, '2021-07-05 18:31:03'),
(13, 7, 'cake 2', '75.20', 1, '2021-07-05 18:31:04'),
(14, 7, 'cake 3', '86.00', 1, '2021-07-05 18:31:04'),
(15, 8, 'sweet 1', '45.70', 1, '2021-07-05 18:39:14'),
(16, 8, 'sweet 2', '55.25', 1, '2021-07-05 18:39:14'),
(17, 8, 'sweet 3', '35.15', 1, '2021-07-05 18:39:14'),
(18, 9, 'sweet 1', '45.70', 1, '2021-07-05 18:41:32'),
(19, 9, 'cake 1', '32.00', 1, '2021-07-05 18:41:32'),
(20, 9, 'cake 2', '75.20', 1, '2021-07-05 18:41:32'),
(21, 9, 'doughnut 1', '48.85', 1, '2021-07-05 18:41:32'),
(22, 10, 'sweet 1', '45.70', 1, '2021-07-06 08:10:59'),
(23, 10, 'sweet 2', '55.25', 1, '2021-07-06 08:10:59'),
(24, 10, 'sweet 3', '35.15', 1, '2021-07-06 08:10:59'),
(25, 11, 'sweet 1', '45.70', 2, '2021-07-06 08:22:39'),
(26, 11, 'sweet 2', '55.25', 2, '2021-07-06 08:22:39'),
(27, 11, 'cake 1', '32.00', 2, '2021-07-06 08:22:39'),
(28, 12, 'sweet 1', '45.70', 1, '2021-07-06 08:29:58'),
(29, 12, 'sweet 2', '55.25', 1, '2021-07-06 08:29:58'),
(30, 12, 'sweet 3', '35.15', 1, '2021-07-06 08:29:58'),
(31, 13, 'sweet 1', '45.70', 1, '2021-07-06 10:43:04'),
(32, 13, 'sweet 2', '55.25', 1, '2021-07-06 10:43:04'),
(33, 14, 'sweet 1', '45.70', 1, '2021-07-08 17:45:51'),
(34, 14, 'sweet 2', '55.25', 1, '2021-07-08 17:45:51'),
(35, 14, 'sweet 3', '35.15', 1, '2021-07-08 17:45:51'),
(36, 15, 'sweet 1', '45.70', 5, '2021-07-09 17:38:55'),
(37, 15, 'sweet 2', '55.25', 1, '2021-07-09 17:38:55'),
(38, 16, 'sweet 1', '45.70', 1, '2021-07-09 17:51:45'),
(39, 16, 'sweet 2', '55.25', 1, '2021-07-09 17:51:45'),
(40, 16, 'sweet 3', '35.15', 1, '2021-07-09 17:51:46'),
(41, 17, 'sweet 1', '45.70', 1, '2021-07-09 18:09:59'),
(42, 17, 'sweet 2', '55.25', 1, '2021-07-09 18:09:59'),
(43, 18, 'sweet 1', '45.70', 1, '2021-07-09 18:15:02'),
(44, 18, 'sweet 2', '55.25', 2, '2021-07-09 18:15:02'),
(45, 19, 'sweet 1', '45.70', 1, '2021-07-09 18:24:05'),
(46, 19, 'sweet 2', '55.25', 1, '2021-07-09 18:24:06'),
(47, 20, 'sweet 1', '45.70', 4, '2021-07-12 10:20:27'),
(48, 21, 'sweet 1', '45.70', 2, '2021-07-12 10:24:48'),
(49, 21, 'sweet 2', '55.25', 2, '2021-07-12 10:24:48'),
(50, 21, 'sweet 3', '35.15', 2, '2021-07-12 10:24:48'),
(51, 22, 'sweet 1', '45.70', 1, '2021-07-12 10:49:26'),
(52, 22, 'sweet 2', '55.25', 1, '2021-07-12 10:49:26'),
(53, 23, 'sweet 1', '45.70', 2, '2021-07-14 08:24:55'),
(54, 24, 'sweet 1', '45.70', 2, '2021-07-14 08:25:59'),
(55, 24, 'sweet 2', '55.25', 2, '2021-07-14 08:25:59'),
(56, 25, 'sweet 1', '45.70', 2, '2021-07-14 08:54:00'),
(57, 25, 'sweet 2', '55.25', 1, '2021-07-14 08:54:00'),
(58, 25, 'sweet 3', '35.15', 1, '2021-07-14 08:54:00'),
(59, 25, 'cake 3', '86.00', 1, '2021-07-14 08:54:00'),
(60, 26, 'sweet 1', '45.70', 1, '2021-07-14 16:12:58'),
(61, 26, 'sweet 2', '55.25', 1, '2021-07-14 16:12:58'),
(62, 27, 'sweet 1', '45.70', 2, '2021-07-14 17:30:35'),
(63, 28, 'sweet 1', '45.70', 2, '2021-07-16 09:07:18'),
(64, 28, 'sweet 2', '55.25', 2, '2021-07-16 09:07:18'),
(65, 28, 'cake 2', '75.20', 1, '2021-07-16 09:07:18'),
(66, 29, 'sweet 1', '45.70', 2, '2021-07-22 17:46:08'),
(67, 29, 'sweet 2', '55.25', 2, '2021-07-22 17:46:08'),
(68, 29, 'sweet 3', '35.15', 2, '2021-07-22 17:46:08'),
(69, 30, 'sweet 1', '45.70', 1, '2021-07-26 10:12:39'),
(70, 30, 'sweet 2', '55.25', 1, '2021-07-26 10:12:39'),
(71, 30, 'sweet 3', '35.15', 1, '2021-07-26 10:12:39'),
(72, 31, 'sweet 1', '45.70', 1, '2021-07-26 10:13:39'),
(73, 32, 'sweet 999', '10.30', 2, '2021-08-04 18:35:06'),
(74, 32, 'sweet 2', '55.25', 2, '2021-08-04 18:35:06'),
(75, 32, 'sweet 999', '10.30', 2, '2021-08-09 10:48:31'),
(76, 32, 'sweet 2', '55.25', 1, '2021-08-09 10:48:31'),
(77, 32, 'sweet 3', '35.15', 1, '2021-08-09 10:48:31'),
(78, 33, 'sweet 999', '10.30', 1, '2021-08-09 10:56:45'),
(79, 34, 'sweet 999', '10.30', 1, '2021-08-09 11:00:50'),
(80, 34, 'sweet 2', '55.25', 1, '2021-08-09 11:00:50'),
(81, 34, 'sweet 3', '35.15', 1, '2021-08-09 11:00:50'),
(82, 34, 'sweet 999', '10.30', 1, '2021-08-09 11:04:13'),
(83, 34, 'sweet 2', '55.25', 1, '2021-08-09 11:04:13'),
(84, 34, 'sweet 3', '35.15', 1, '2021-08-09 11:04:13'),
(85, 35, 'sweet 999', '10.30', 2, '2021-08-09 11:05:42'),
(86, 35, 'sweet 2', '55.25', 2, '2021-08-09 11:05:42'),
(87, 35, 'sweet 3', '35.15', 2, '2021-08-09 11:05:42'),
(88, 35, 'sweet 999', '10.30', 1, '2021-08-09 11:10:23'),
(89, 35, 'sweet 2', '55.25', 1, '2021-08-09 11:10:23'),
(90, 35, 'sweet 3', '35.15', 1, '2021-08-09 11:10:23'),
(91, 35, 'sweet 999', '10.30', 1, '2021-08-09 11:12:56'),
(92, 35, 'sweet 2', '55.25', 1, '2021-08-09 11:12:56'),
(93, 35, 'sweet 3', '35.15', 1, '2021-08-09 11:12:56'),
(94, 35, 'sweet 999', '10.30', 2, '2021-08-09 11:14:19'),
(95, 35, 'sweet 2', '55.25', 1, '2021-08-09 11:14:19'),
(96, 35, 'sweet 999', '10.30', 2, '2021-08-09 11:20:49'),
(97, 35, 'sweet 2', '55.25', 2, '2021-08-09 11:20:50'),
(98, 35, 'sweet 3', '35.15', 1, '2021-08-09 11:20:50'),
(99, 35, 'cake 1', '32.00', 1, '2021-08-09 11:20:50'),
(100, 43, 'sweet 999', '10.30', 1, '2021-08-09 17:26:06'),
(101, 43, 'sweet 2', '55.25', 1, '2021-08-09 17:26:06'),
(102, 43, 'sweet 3', '35.15', 1, '2021-08-09 17:26:06'),
(103, 43, 'sweet 999', '10.30', 1, '2021-08-09 17:27:53'),
(104, 43, 'sweet 2', '55.25', 1, '2021-08-09 17:27:53'),
(105, 46, 'sweet 999', '10.30', 1, '2021-08-09 17:37:50'),
(106, 46, 'sweet 2', '55.25', 1, '2021-08-09 17:37:50'),
(107, 46, 'sweet 3', '35.15', 1, '2021-08-09 17:37:50'),
(108, 47, 'sweet 999', '10.30', 1, '2021-08-09 17:39:01'),
(109, 47, 'sweet 2', '55.25', 2, '2021-08-09 17:39:01'),
(110, 47, 'sweet 3', '35.15', 2, '2021-08-09 17:39:01'),
(111, 48, 'doughnut 1', '48.85', 2, '2021-08-09 17:42:53'),
(112, 48, 'doughnut 2', '46.45', 1, '2021-08-09 17:42:53'),
(113, 49, 'sweet 999', '10.30', 1, '2021-08-11 00:38:36'),
(114, 49, 'sweet 2', '55.25', 1, '2021-08-11 00:38:36'),
(115, 49, 'sweet 3', '35.15', 1, '2021-08-11 00:38:36'),
(116, 49, 'cake 1', '32.00', 1, '2021-08-11 00:38:36'),
(117, 49, 'cake 2', '75.20', 1, '2021-08-11 00:38:36'),
(118, 50, 'sweet 999', '10.30', 1, '2021-08-11 00:39:25'),
(119, 50, 'sweet 2', '55.25', 1, '2021-08-11 00:39:26'),
(120, 50, 'sweet 3', '35.15', 1, '2021-08-11 00:39:26'),
(121, 51, 'sweet 999', '10.30', 1, '2021-08-11 09:29:15'),
(122, 51, 'sweet 2', '55.25', 1, '2021-08-11 09:29:15'),
(123, 51, 'sweet 3', '35.15', 1, '2021-08-11 09:29:15'),
(124, 51, 'cake 1', '32.00', 1, '2021-08-11 09:29:15'),
(125, 51, 'cake 2', '75.20', 1, '2021-08-11 09:29:15'),
(126, 51, 'cake 3', '86.00', 1, '2021-08-11 09:29:15'),
(127, 52, 'sweet 999', '10.30', 1, '2021-08-11 09:45:17'),
(128, 52, 'sweet 2', '55.25', 1, '2021-08-11 09:45:17'),
(129, 52, 'sweet 3', '35.15', 1, '2021-08-11 09:45:18'),
(130, 52, 'cake 1', '32.00', 1, '2021-08-11 09:45:18'),
(131, 52, 'cake 2', '75.20', 1, '2021-08-11 09:45:18'),
(132, 52, 'cake 3', '86.00', 1, '2021-08-11 09:45:18'),
(133, 52, 'doughnut 1', '48.85', 1, '2021-08-11 09:45:18'),
(134, 52, 'doughnut 2', '46.45', 1, '2021-08-11 09:45:18'),
(135, 53, 'sweet 999', '10.30', 1, '2021-08-12 18:37:14'),
(136, 53, 'sweet 2', '55.25', 1, '2021-08-12 18:37:15'),
(137, 53, 'sweet 3', '35.15', 1, '2021-08-12 18:37:15'),
(138, 54, 'sweet 2', '55.25', 2, '2021-08-16 09:34:14'),
(139, 54, 'sweet 3', '35.15', 2, '2021-08-16 09:34:14'),
(140, 55, 'sweet 999', '10.30', 1, '2021-08-16 09:36:10'),
(141, 55, 'sweet 2', '55.25', 1, '2021-08-16 09:36:10'),
(142, 56, 'sweet 999', '10.30', 1, '2021-08-23 09:05:59'),
(143, 56, 'sweet 2', '55.25', 1, '2021-08-23 09:06:00'),
(144, 57, 'sweet 999', '10.30', 2, '2021-08-23 10:44:37'),
(145, 58, 'sweet 999', '10.30', 2, '2021-08-24 10:40:35'),
(146, 58, 'sweet 2', '55.25', 4, '2021-08-24 10:40:35'),
(147, 58, 'sweet 3', '35.15', 4, '2021-08-24 10:40:35'),
(148, 58, 'cake 1', '32.00', 1, '2021-08-24 10:40:35'),
(149, 58, 'doughnut 1', '48.85', 1, '2021-08-24 10:40:36'),
(150, 58, 'doughnut 2', '46.45', 1, '2021-08-24 10:40:36'),
(151, 59, 'sweet 999', '10.30', 1, '2021-08-24 16:29:38'),
(152, 59, 'sweet 2', '55.25', 2, '2021-08-24 16:29:38'),
(153, 59, 'sweet 3', '35.15', 2, '2021-08-24 16:29:38'),
(154, 59, 'cake 1', '32.00', 1, '2021-08-24 16:29:38'),
(155, 60, 'sweet 999', '10.30', 2, '2021-08-24 16:40:05'),
(156, 60, 'sweet 2', '55.25', 2, '2021-08-24 16:40:05'),
(157, 60, 'sweet 3', '35.15', 1, '2021-08-24 16:40:05'),
(158, 60, 'cake 1', '32.00', 1, '2021-08-24 16:40:05'),
(159, 60, 'cake 2', '75.20', 2, '2021-08-24 16:40:05'),
(160, 60, 'cake 3', '86.00', 1, '2021-08-24 16:40:05'),
(161, 60, 'doughnut 1', '48.85', 1, '2021-08-24 16:40:05'),
(162, 60, 'doughnut 2', '46.45', 1, '2021-08-24 16:40:05'),
(163, 61, 'sweet 999', '10.30', 1, '2021-08-24 16:47:25'),
(164, 61, 'sweet 2', '55.25', 1, '2021-08-24 16:47:25'),
(165, 61, 'cake 1', '32.00', 2, '2021-08-24 16:47:25'),
(166, 61, 'cake 2', '75.20', 1, '2021-08-24 16:47:25'),
(167, 61, 'cake 3', '86.00', 3, '2021-08-24 16:47:25'),
(168, 62, 'sweet 999', '10.30', 1, '2021-08-24 16:48:31'),
(169, 62, 'sweet 2', '55.25', 1, '2021-08-24 16:48:31'),
(170, 62, 'sweet 3', '35.15', 1, '2021-08-24 16:48:31'),
(171, 63, 'sweet 999', '10.30', 1, '2021-08-24 16:52:48'),
(172, 63, 'sweet 2', '55.25', 1, '2021-08-24 16:52:48'),
(173, 63, 'sweet 3', '35.15', 1, '2021-08-24 16:52:48'),
(174, 64, 'sweet 999', '10.30', 1, '2021-08-24 17:03:18'),
(175, 64, 'sweet 2', '55.25', 1, '2021-08-24 17:03:18'),
(176, 64, 'sweet 3', '35.15', 2, '2021-08-24 17:03:18'),
(177, 64, 'cake 1', '32.00', 1, '2021-08-24 17:03:18'),
(178, 65, 'sweet 999', '10.30', 1, '2021-08-24 17:04:19'),
(179, 65, 'sweet 2', '55.25', 1, '2021-08-24 17:04:19'),
(180, 65, 'sweet 3', '35.15', 1, '2021-08-24 17:04:19'),
(181, 65, 'cake 1', '32.00', 2, '2021-08-24 17:04:19'),
(182, 65, 'cake 2', '75.20', 1, '2021-08-24 17:04:19'),
(183, 65, 'cake 3', '86.00', 1, '2021-08-24 17:04:19'),
(184, 66, 'sweet 999', '10.30', 1, '2021-08-24 17:11:49'),
(185, 66, 'sweet 2', '55.25', 1, '2021-08-24 17:11:49'),
(186, 66, 'sweet 3', '35.15', 1, '2021-08-24 17:11:49'),
(187, 67, 'sweet 999', '10.30', 1, '2021-08-24 17:15:10'),
(188, 67, 'sweet 2', '55.25', 1, '2021-08-24 17:15:10'),
(189, 67, 'sweet 3', '35.15', 1, '2021-08-24 17:15:10'),
(190, 68, 'sweet 999', '10.30', 1, '2021-08-24 17:16:32'),
(191, 68, 'cake 1', '32.00', 1, '2021-08-24 17:16:32'),
(192, 68, 'cake 2', '75.20', 1, '2021-08-24 17:16:32'),
(193, 69, 'sweet 999', '10.30', 1, '2021-08-24 17:17:24'),
(194, 69, 'sweet 2', '55.25', 1, '2021-08-24 17:17:24'),
(195, 69, 'sweet 3', '35.15', 1, '2021-08-24 17:17:24'),
(196, 69, 'cake 2', '75.20', 1, '2021-08-24 17:17:24'),
(197, 69, 'cake 3', '86.00', 1, '2021-08-24 17:17:24'),
(198, 69, 'doughnut 1', '48.85', 1, '2021-08-24 17:17:24'),
(199, 69, 'doughnut 2', '46.45', 1, '2021-08-24 17:17:24'),
(200, 70, 'sweet 999', '10.30', 1, '2021-08-24 17:24:18'),
(201, 70, 'sweet 2', '55.25', 1, '2021-08-24 17:24:18'),
(202, 70, 'sweet 3', '35.15', 1, '2021-08-24 17:24:19'),
(203, 71, 'sweet 999', '10.30', 1, '2021-08-24 17:25:00'),
(204, 71, 'sweet 2', '55.25', 1, '2021-08-24 17:25:00'),
(205, 71, 'sweet 3', '35.15', 1, '2021-08-24 17:25:00'),
(206, 71, 'doughnut 1', '48.85', 2, '2021-08-24 17:25:00'),
(207, 71, 'doughnut 2', '46.45', 3, '2021-08-24 17:25:00'),
(208, 72, 'doughnut 1', '48.85', 1, '2021-08-24 17:30:25'),
(209, 72, 'doughnut 2', '46.45', 1, '2021-08-24 17:30:25'),
(210, 73, 'cake 1', '32.00', 1, '2021-08-24 17:48:26'),
(211, 73, 'cake 2', '75.20', 1, '2021-08-24 17:48:26'),
(212, 73, 'cake 3', '86.00', 1, '2021-08-24 17:48:26'),
(213, 74, 'cake 1', '32.00', 1, '2021-08-24 18:04:13'),
(214, 74, 'cake 2', '75.20', 1, '2021-08-24 18:04:13'),
(215, 74, 'cake 3', '86.00', 1, '2021-08-24 18:04:13'),
(216, 75, 'cake 1', '32.00', 2, '2021-08-24 18:17:07'),
(217, 76, 'sweet 2', '55.25', 1, '2021-08-24 18:30:32'),
(218, 77, 'sweet 999', '10.30', 1, '2021-08-24 18:38:49'),
(219, 77, 'sweet 2', '55.25', 1, '2021-08-24 18:38:49'),
(220, 78, 'sweet 2', '55.25', 1, '2021-08-24 18:40:03'),
(221, 79, 'sweet 999', '10.30', 1, '2021-08-24 18:43:44'),
(222, 79, 'sweet 2', '55.25', 2, '2021-08-24 18:43:44'),
(223, 80, 'sweet 999', '10.30', 1, '2021-08-24 18:44:59'),
(224, 80, 'sweet 2', '55.25', 1, '2021-08-24 18:44:59'),
(225, 81, 'sweet 999', '10.30', 1, '2021-08-24 18:48:17'),
(226, 81, 'sweet 2', '55.25', 1, '2021-08-24 18:48:17'),
(227, 82, 'sweet 999', '10.30', 1, '2021-08-24 18:50:27'),
(228, 82, 'sweet 2', '55.25', 2, '2021-08-24 18:50:27'),
(229, 83, 'sweet 999', '10.30', 1, '2021-08-24 18:52:33'),
(230, 83, 'sweet 2', '55.25', 2, '2021-08-24 18:52:33'),
(231, 83, 'sweet 3', '35.15', 1, '2021-08-24 18:52:33'),
(232, 84, 'sweet 999', '10.30', 2, '2021-08-24 18:53:54'),
(233, 84, 'cake 1', '32.00', 2, '2021-08-24 18:53:54'),
(234, 84, 'cake 2', '75.20', 2, '2021-08-24 18:53:54'),
(235, 84, 'doughnut 1', '48.85', 1, '2021-08-24 18:53:55'),
(236, 84, 'doughnut 2', '46.45', 1, '2021-08-24 18:53:55'),
(237, 85, 'sweet 999', '10.30', 2, '2021-08-24 18:54:53'),
(238, 85, 'sweet 2', '55.25', 2, '2021-08-24 18:54:53'),
(239, 86, 'sweet 999', '10.30', 2, '2021-08-24 18:56:23'),
(240, 86, 'sweet 2', '55.25', 1, '2021-08-24 18:56:23'),
(241, 86, 'cake 1', '32.00', 1, '2021-08-24 18:56:23'),
(242, 86, 'cake 2', '75.20', 1, '2021-08-24 18:56:23'),
(243, 87, 'sweet 999', '10.30', 2, '2021-08-24 18:59:03'),
(244, 87, 'sweet 2', '55.25', 1, '2021-08-24 18:59:03'),
(245, 88, 'sweet 999', '10.30', 1, '2021-08-24 19:04:23'),
(246, 88, 'sweet 2', '55.25', 1, '2021-08-24 19:04:23'),
(247, 89, 'sweet 999', '10.30', 1, '2021-08-24 19:04:48'),
(248, 89, 'sweet 2', '55.25', 1, '2021-08-24 19:04:48'),
(249, 90, 'sweet 999', '10.30', 1, '2021-08-24 19:05:37'),
(250, 90, 'sweet 2', '55.25', 1, '2021-08-24 19:05:38'),
(251, 91, 'sweet 999', '10.30', 1, '2021-08-24 19:06:59'),
(252, 91, 'sweet 2', '55.25', 1, '2021-08-24 19:06:59'),
(253, 92, 'sweet 2', '55.25', 1, '2021-08-26 08:41:31'),
(254, 92, 'sweet 3', '35.15', 1, '2021-08-26 08:41:31'),
(255, 92, 'cake 1', '32.00', 2, '2021-08-26 08:41:31'),
(256, 92, 'cake 3', '86.00', 1, '2021-08-26 08:41:31'),
(257, 93, 'sweet 999', '10.30', 1, '2021-08-26 08:45:23'),
(258, 93, 'sweet 3', '35.15', 2, '2021-08-26 08:45:23'),
(259, 93, 'cake 1', '32.00', 2, '2021-08-26 08:45:23'),
(260, 93, 'cake 2', '75.20', 1, '2021-08-26 08:45:23'),
(261, 94, 'sweet 999', '10.30', 1, '2021-08-26 08:49:27'),
(262, 94, 'sweet 2', '55.25', 1, '2021-08-26 08:49:27'),
(263, 94, 'cake 1', '32.00', 1, '2021-08-26 08:49:27'),
(264, 94, 'cake 3', '86.00', 1, '2021-08-26 08:49:27'),
(265, 95, 'sweet 999', '10.30', 1, '2021-08-26 08:50:04'),
(266, 96, 'sweet 999', '10.30', 1, '2021-08-26 08:50:28'),
(267, 96, 'sweet 2', '55.25', 1, '2021-08-26 08:50:28'),
(268, 96, 'cake 1', '32.00', 1, '2021-08-26 08:50:28'),
(269, 97, 'sweet 999', '10.30', 1, '2021-08-26 08:52:01'),
(270, 97, 'sweet 2', '55.25', 1, '2021-08-26 08:52:01'),
(271, 97, 'cake 1', '32.00', 1, '2021-08-26 08:52:01'),
(272, 98, 'sweet 999', '10.30', 1, '2021-08-26 08:52:38'),
(273, 98, 'sweet 2', '55.25', 1, '2021-08-26 08:52:38'),
(274, 99, 'sweet 999', '10.30', 1, '2021-08-26 08:53:31'),
(275, 99, 'sweet 2', '55.25', 1, '2021-08-26 08:53:31'),
(276, 100, 'sweet 999', '10.30', 2, '2021-08-26 08:55:40'),
(277, 100, 'sweet 2', '55.25', 1, '2021-08-26 08:55:40'),
(278, 100, 'sweet 3', '35.15', 2, '2021-08-26 08:55:40'),
(279, 101, 'sweet 999', '10.30', 1, '2021-08-26 08:58:48'),
(280, 101, 'sweet 2', '55.25', 1, '2021-08-26 08:58:48'),
(281, 102, 'sweet 999', '10.30', 1, '2021-08-26 09:00:10'),
(282, 102, 'sweet 2', '55.25', 2, '2021-08-26 09:00:10'),
(283, 103, 'sweet 999', '10.30', 2, '2021-08-26 09:04:54'),
(284, 104, 'sweet 999', '10.30', 1, '2021-08-26 09:09:22'),
(285, 104, 'sweet 2', '55.25', 1, '2021-08-26 09:09:22'),
(286, 104, 'sweet 3', '35.15', 1, '2021-08-26 09:09:22'),
(287, 105, 'sweet 999', '10.30', 1, '2021-08-26 09:12:53'),
(288, 105, 'sweet 2', '55.25', 1, '2021-08-26 09:12:53'),
(289, 105, 'cake 2', '75.20', 2, '2021-08-26 09:12:54'),
(290, 106, 'sweet 2', '55.25', 2, '2021-08-26 09:14:11'),
(291, 106, 'sweet 3', '35.15', 1, '2021-08-26 09:14:11'),
(292, 107, 'sweet 999', '10.30', 2, '2021-08-26 09:15:54'),
(293, 108, 'sweet 999', '10.30', 2, '2021-08-26 09:17:20'),
(294, 109, 'sweet 999', '10.30', 1, '2021-08-26 09:19:26'),
(295, 109, 'cake 1', '32.00', 1, '2021-08-26 09:19:26'),
(296, 109, 'cake 2', '75.20', 2, '2021-08-26 09:19:26'),
(297, 110, 'sweet 999', '10.30', 1, '2021-08-26 09:20:52'),
(298, 110, 'sweet 2', '55.25', 1, '2021-08-26 09:20:52'),
(299, 111, 'sweet 999', '10.30', 1, '2021-08-26 09:22:01'),
(300, 111, 'sweet 2', '55.25', 1, '2021-08-26 09:22:01'),
(301, 111, 'sweet 3', '35.15', 1, '2021-08-26 09:22:01'),
(302, 112, 'sweet 999', '10.30', 4, '2021-08-26 09:26:01'),
(303, 112, 'sweet 2', '55.25', 2, '2021-08-26 09:26:01'),
(304, 112, 'sweet 3', '35.15', 1, '2021-08-26 09:26:01'),
(305, 113, 'sweet 999', '10.30', 1, '2021-08-26 09:26:50'),
(306, 113, 'sweet 2', '55.25', 2, '2021-08-26 09:26:50'),
(307, 114, 'sweet 999', '10.30', 1, '2021-08-26 09:27:35'),
(308, 114, 'sweet 2', '55.25', 3, '2021-08-26 09:27:36'),
(309, 114, 'cake 1', '32.00', 2, '2021-08-26 09:27:36'),
(310, 115, 'sweet 999', '10.30', 2, '2021-08-26 09:28:44'),
(311, 115, 'sweet 2', '55.25', 1, '2021-08-26 09:28:44'),
(312, 116, 'sweet 999', '10.30', 1, '2021-08-26 09:36:28'),
(313, 116, 'sweet 2', '55.25', 2, '2021-08-26 09:36:28'),
(314, 117, 'sweet 999', '10.30', 1, '2021-08-26 09:39:23'),
(315, 117, 'sweet 2', '55.25', 1, '2021-08-26 09:39:23'),
(316, 118, 'sweet 999', '10.30', 1, '2021-08-26 09:40:04'),
(317, 118, 'sweet 2', '55.25', 2, '2021-08-26 09:40:04'),
(318, 119, 'sweet 999', '10.30', 1, '2021-08-26 09:41:55'),
(319, 119, 'sweet 2', '55.25', 1, '2021-08-26 09:41:55'),
(320, 120, 'sweet 999', '10.30', 1, '2021-08-26 09:43:08'),
(321, 120, 'sweet 2', '55.25', 1, '2021-08-26 09:43:08'),
(322, 120, 'sweet 3', '35.15', 1, '2021-08-26 09:43:08'),
(323, 121, 'sweet 999', '10.30', 2, '2021-08-26 09:46:54'),
(324, 121, 'sweet 2', '55.25', 1, '2021-08-26 09:46:54'),
(325, 122, 'sweet 999', '10.30', 1, '2021-08-26 09:47:41'),
(326, 122, 'sweet 2', '55.25', 1, '2021-08-26 09:47:41'),
(327, 122, 'sweet 3', '35.15', 1, '2021-08-26 09:47:41'),
(328, 123, 'sweet 999', '10.30', 1, '2021-08-26 09:48:30'),
(329, 123, 'sweet 2', '55.25', 2, '2021-08-26 09:48:30'),
(330, 124, 'sweet 999', '10.30', 1, '2021-08-26 09:50:09'),
(331, 124, 'sweet 2', '55.25', 1, '2021-08-26 09:50:09'),
(332, 125, 'sweet 999', '10.30', 2, '2021-08-26 09:50:43'),
(333, 125, 'sweet 2', '55.25', 1, '2021-08-26 09:50:43'),
(334, 126, 'sweet 999', '10.30', 1, '2021-08-26 09:51:26'),
(335, 126, 'sweet 2', '55.25', 1, '2021-08-26 09:51:26'),
(336, 127, 'sweet 999', '10.30', 2, '2021-08-26 09:54:28'),
(337, 128, 'sweet 999', '10.30', 2, '2021-08-26 09:55:28'),
(338, 129, 'sweet 999', '10.30', 3, '2021-08-26 09:56:29'),
(339, 129, 'sweet 2', '55.25', 1, '2021-08-26 09:56:29'),
(340, 130, 'sweet 999', '10.30', 1, '2021-08-26 09:57:59'),
(341, 130, 'sweet 2', '55.25', 1, '2021-08-26 09:57:59'),
(342, 131, 'sweet 999', '10.30', 2, '2021-08-26 09:59:11'),
(343, 131, 'sweet 2', '55.25', 1, '2021-08-26 09:59:11'),
(344, 132, 'sweet 999', '10.30', 2, '2021-08-26 09:59:58'),
(345, 133, 'sweet 999', '10.30', 2, '2021-08-26 10:02:38'),
(346, 133, 'sweet 2', '55.25', 1, '2021-08-26 10:02:38'),
(347, 134, 'sweet 999', '10.30', 1, '2021-08-26 10:04:15'),
(348, 134, 'sweet 2', '55.25', 2, '2021-08-26 10:04:15'),
(349, 134, 'sweet 3', '35.15', 1, '2021-08-26 10:04:15'),
(350, 135, 'sweet 999', '10.30', 1, '2021-08-26 10:05:22'),
(351, 135, 'sweet 2', '55.25', 1, '2021-08-26 10:05:22'),
(352, 135, 'sweet 3', '35.15', 1, '2021-08-26 10:05:22'),
(353, 136, 'sweet 999', '10.30', 1, '2021-08-26 10:05:56'),
(354, 136, 'sweet 2', '55.25', 1, '2021-08-26 10:05:56'),
(355, 137, 'sweet 999', '10.30', 2, '2021-08-26 10:07:46'),
(356, 138, 'sweet 999', '10.30', 2, '2021-08-26 10:10:13'),
(357, 139, 'sweet 999', '10.30', 1, '2021-08-26 10:10:50'),
(358, 139, 'sweet 2', '55.25', 1, '2021-08-26 10:10:50'),
(359, 140, 'sweet 999', '10.30', 2, '2021-08-26 10:12:12'),
(360, 140, 'sweet 2', '55.25', 1, '2021-08-26 10:12:12'),
(361, 141, 'sweet 999', '10.30', 2, '2021-08-26 10:13:18'),
(362, 141, 'sweet 2', '55.25', 1, '2021-08-26 10:13:18'),
(363, 142, 'sweet 999', '10.30', 2, '2021-08-26 10:14:38'),
(364, 142, 'sweet 2', '55.25', 1, '2021-08-26 10:14:38'),
(365, 143, 'sweet 999', '10.30', 2, '2021-08-26 10:16:04'),
(366, 143, 'sweet 2', '55.25', 1, '2021-08-26 10:16:04'),
(367, 144, 'sweet 999', '10.30', 2, '2021-08-26 10:17:33'),
(368, 144, 'sweet 2', '55.25', 1, '2021-08-26 10:17:33'),
(369, 144, 'sweet 3', '35.15', 2, '2021-08-26 10:17:33'),
(370, 145, 'sweet 999', '10.30', 1, '2021-08-26 10:18:50'),
(371, 145, 'sweet 2', '55.25', 1, '2021-08-26 10:18:50'),
(372, 146, 'sweet 999', '10.30', 1, '2021-08-26 10:21:46'),
(373, 146, 'sweet 2', '55.25', 1, '2021-08-26 10:21:46'),
(374, 147, 'sweet 999', '10.30', 1, '2021-08-26 10:23:23'),
(375, 147, 'sweet 2', '55.25', 2, '2021-08-26 10:23:23'),
(376, 148, 'sweet 999', '10.30', 1, '2021-08-26 10:24:34'),
(377, 148, 'sweet 2', '55.25', 2, '2021-08-26 10:24:34'),
(378, 148, 'sweet 3', '35.15', 1, '2021-08-26 10:24:34'),
(379, 149, 'sweet 999', '10.30', 2, '2021-08-26 10:30:50'),
(380, 149, 'sweet 2', '55.25', 1, '2021-08-26 10:30:50'),
(381, 150, 'sweet 999', '10.30', 2, '2021-08-26 10:33:48'),
(382, 150, 'sweet 2', '55.25', 1, '2021-08-26 10:33:48'),
(383, 151, 'sweet 999', '10.30', 2, '2021-08-26 10:35:27'),
(384, 151, 'sweet 2', '55.25', 1, '2021-08-26 10:35:27'),
(385, 152, 'sweet 2', '55.25', 3, '2021-08-26 10:37:36'),
(386, 153, 'sweet 999', '10.30', 2, '2021-08-26 10:37:56'),
(387, 153, 'sweet 2', '55.25', 1, '2021-08-26 10:37:56'),
(388, 153, 'sweet 3', '35.15', 1, '2021-08-26 10:37:56'),
(389, 154, 'sweet 999', '10.30', 2, '2021-08-26 10:38:52'),
(390, 154, 'sweet 2', '55.25', 1, '2021-08-26 10:38:52'),
(391, 155, 'sweet 2', '55.25', 2, '2021-08-26 10:40:03'),
(392, 155, 'sweet 3', '35.15', 1, '2021-08-26 10:40:03'),
(393, 155, 'cake 1', '32.00', 1, '2021-08-26 10:40:03'),
(394, 156, 'sweet 999', '10.30', 1, '2021-08-26 10:41:45'),
(395, 156, 'sweet 2', '55.25', 1, '2021-08-26 10:41:45'),
(396, 156, 'cake 1', '32.00', 1, '2021-08-26 10:41:46'),
(397, 157, 'sweet 999', '10.30', 1, '2021-08-26 10:44:02'),
(398, 157, 'sweet 2', '55.25', 1, '2021-08-26 10:44:02'),
(399, 157, 'sweet 3', '35.15', 1, '2021-08-26 10:44:02'),
(400, 158, 'sweet 999', '10.30', 1, '2021-08-26 10:45:05'),
(401, 158, 'sweet 2', '55.25', 1, '2021-08-26 10:45:05'),
(402, 159, 'sweet 999', '10.30', 1, '2021-08-26 10:45:18'),
(403, 159, 'sweet 2', '55.25', 1, '2021-08-26 10:45:18'),
(404, 160, 'sweet 999', '10.30', 2, '2021-08-26 10:45:54'),
(405, 160, 'sweet 2', '55.25', 1, '2021-08-26 10:45:54'),
(406, 161, 'sweet 999', '10.30', 2, '2021-08-26 10:48:54'),
(407, 161, 'sweet 2', '55.25', 1, '2021-08-26 10:48:55'),
(408, 162, 'sweet 999', '10.30', 2, '2021-08-26 10:50:10'),
(409, 162, 'sweet 2', '55.25', 1, '2021-08-26 10:50:10'),
(410, 163, 'sweet 2', '55.25', 1, '2021-08-26 10:56:57'),
(411, 163, 'sweet 3', '35.15', 1, '2021-08-26 10:56:57'),
(412, 164, 'sweet 999', '10.30', 1, '2021-08-26 10:57:57'),
(413, 164, 'sweet 2', '55.25', 1, '2021-08-26 10:57:57'),
(414, 164, 'cake 1', '32.00', 1, '2021-08-26 10:57:57'),
(415, 165, 'sweet 999', '10.30', 1, '2021-08-26 11:00:01'),
(416, 165, 'sweet 2', '55.25', 1, '2021-08-26 11:00:01'),
(417, 165, 'sweet 3', '35.15', 1, '2021-08-26 11:00:01'),
(418, 166, 'sweet 999', '10.30', 1, '2021-08-26 11:03:39'),
(419, 166, 'sweet 2', '55.25', 1, '2021-08-26 11:03:40'),
(420, 167, 'sweet 999', '10.30', 1, '2021-08-26 11:05:59'),
(421, 167, 'sweet 2', '55.25', 1, '2021-08-26 11:05:59'),
(422, 167, 'sweet 3', '35.15', 1, '2021-08-26 11:05:59'),
(423, 168, 'sweet 999', '10.30', 2, '2021-08-26 11:08:43'),
(424, 169, 'sweet 999', '10.30', 1, '2021-08-26 11:10:05'),
(425, 169, 'sweet 2', '55.25', 1, '2021-08-26 11:10:05'),
(426, 169, 'sweet 3', '35.15', 1, '2021-08-26 11:10:05'),
(427, 170, 'sweet 999', '10.30', 1, '2021-08-26 11:10:46'),
(428, 170, 'sweet 2', '55.25', 1, '2021-08-26 11:10:46'),
(429, 170, 'sweet 3', '35.15', 1, '2021-08-26 11:10:46'),
(430, 171, 'sweet 999', '10.30', 1, '2021-08-26 11:11:42'),
(431, 171, 'sweet 2', '55.25', 1, '2021-08-26 11:11:42'),
(432, 172, 'cake 1', '32.00', 1, '2021-08-26 11:15:46'),
(433, 172, 'cake 3', '86.00', 2, '2021-08-26 11:15:46'),
(434, 173, 'sweet 999', '10.30', 1, '2021-08-26 11:17:39'),
(435, 173, 'sweet 2', '55.25', 2, '2021-08-26 11:17:39'),
(436, 174, 'sweet 999', '10.30', 1, '2021-08-26 11:18:39'),
(437, 174, 'sweet 2', '55.25', 1, '2021-08-26 11:18:39'),
(438, 175, 'sweet 999', '10.30', 4, '2021-08-26 11:19:03'),
(439, 176, 'sweet 999', '10.30', 1, '2021-08-26 11:27:00'),
(440, 176, 'sweet 2', '55.25', 1, '2021-08-26 11:27:00'),
(441, 176, 'sweet 3', '35.15', 1, '2021-08-26 11:27:00'),
(442, 176, 'cake 1', '32.00', 1, '2021-08-26 11:27:00'),
(443, 177, 'sweet 999', '10.30', 1, '2021-08-26 11:27:38'),
(444, 177, 'sweet 2', '55.25', 1, '2021-08-26 11:27:38'),
(445, 177, 'sweet 3', '35.15', 1, '2021-08-26 11:27:38'),
(446, 178, 'sweet 999', '10.30', 1, '2021-08-26 11:28:58'),
(447, 178, 'sweet 2', '55.25', 2, '2021-08-26 11:28:58'),
(448, 179, 'sweet 999', '10.30', 1, '2021-08-26 11:33:52'),
(449, 179, 'sweet 2', '55.25', 1, '2021-08-26 11:33:52'),
(450, 180, 'sweet 999', '10.30', 2, '2021-08-26 11:34:14'),
(451, 180, 'sweet 2', '55.25', 2, '2021-08-26 11:34:14'),
(452, 181, 'sweet 999', '10.30', 3, '2021-08-26 11:34:35'),
(453, 181, 'sweet 2', '55.25', 3, '2021-08-26 11:34:35'),
(454, 181, 'sweet 3', '35.15', 2, '2021-08-26 11:34:35'),
(455, 182, 'sweet 999', '10.30', 1, '2021-08-26 11:50:46'),
(456, 182, 'sweet 2', '55.25', 1, '2021-08-26 11:50:46'),
(457, 183, 'sweet 999', '10.30', 2, '2021-08-26 16:25:34'),
(458, 183, 'doughnut 1', '48.85', 2, '2021-08-26 16:25:34'),
(459, 183, 'doughnut 2', '46.45', 1, '2021-08-26 16:25:34'),
(460, 184, 'sweet 999', '10.30', 1, '2021-08-26 16:28:57'),
(461, 184, 'sweet 2', '55.25', 1, '2021-08-26 16:28:57'),
(462, 185, 'sweet 999', '10.30', 2, '2021-08-26 16:53:57'),
(463, 185, 'sweet 2', '55.25', 1, '2021-08-26 16:53:57'),
(464, 186, 'sweet 999', '10.30', 1, '2021-08-26 17:11:09'),
(465, 186, 'sweet 2', '55.25', 2, '2021-08-26 17:11:09'),
(466, 187, 'sweet 999', '10.30', 1, '2021-08-26 18:00:17'),
(467, 187, 'sweet 2', '55.25', 1, '2021-08-26 18:00:17'),
(468, 188, 'sweet 999', '10.30', 4, '2021-08-26 19:05:38'),
(469, 188, 'sweet 2', '55.25', 3, '2021-08-26 19:05:39'),
(470, 188, 'cake 3', '86.00', 2, '2021-08-26 19:05:39'),
(471, 189, 'sweet 999', '10.30', 2, '2021-08-26 19:10:52'),
(472, 189, 'sweet 2', '55.25', 3, '2021-08-26 19:10:52'),
(473, 190, 'sweet 999', '10.30', 1, '2021-08-27 09:20:30'),
(474, 190, 'sweet 2', '55.25', 1, '2021-08-27 09:20:30'),
(475, 191, 'sweet 999', '10.30', 1, '2021-08-27 09:21:19'),
(476, 191, 'sweet 2', '55.25', 4, '2021-08-27 09:21:19'),
(477, 191, 'sweet 3', '35.15', 1, '2021-08-27 09:21:19'),
(478, 192, 'sweet 999', '10.30', 1, '2021-08-27 09:41:40'),
(479, 192, 'sweet 2', '55.25', 1, '2021-08-27 09:41:40'),
(480, 193, 'sweet 999', '10.30', 1, '2021-08-27 10:20:33'),
(481, 193, 'sweet 2', '55.25', 1, '2021-08-27 10:20:33'),
(482, 194, 'sweet 2', '55.25', 3, '2021-08-27 10:21:36'),
(483, 194, 'cake 1', '32.00', 2, '2021-08-27 10:21:36'),
(484, 195, 'sweet 999', '10.30', 2, '2021-08-27 10:22:06'),
(485, 195, 'sweet 2', '55.25', 2, '2021-08-27 10:22:06'),
(486, 196, 'sweet 999', '10.30', 2, '2021-08-27 10:46:45'),
(487, 196, 'sweet 2', '55.25', 2, '2021-08-27 10:46:45'),
(488, 197, 'sweet 999', '10.30', 1, '2021-08-27 16:32:24'),
(489, 197, 'sweet 2', '55.25', 2, '2021-08-27 16:32:24'),
(490, 198, 'sweet 999', '10.30', 2, '2021-08-30 08:29:21'),
(491, 198, 'sweet 2', '55.25', 2, '2021-08-30 08:29:22'),
(492, 198, 'sweet 3', '35.15', 1, '2021-08-30 08:29:22'),
(493, 199, 'sweet 2', '55.25', 2, '2021-09-01 17:17:50'),
(494, 200, 'sweet 999', '10.30', 1, '2021-09-02 08:27:55'),
(495, 200, 'sweet 2', '55.25', 1, '2021-09-02 08:27:55'),
(496, 200, 'sweet 3', '35.15', 1, '2021-09-02 08:27:55'),
(497, 200, 'cake 1', '32.00', 1, '2021-09-02 08:27:55'),
(498, 201, 'sweet 999', '10.30', 2, '2021-09-02 09:50:21'),
(499, 201, 'sweet 2', '55.25', 2, '2021-09-02 09:50:21'),
(500, 201, 'sweet 3', '35.15', 2, '2021-09-02 09:50:21'),
(501, 201, 'cake 1', '32.00', 2, '2021-09-02 09:50:21'),
(502, 202, 'sweet 999', '10.30', 1, '2021-09-03 10:54:26'),
(503, 202, 'sweet 2', '55.25', 2, '2021-09-03 10:54:26'),
(504, 203, 'doughnut 1', '48.85', 1, '2021-09-03 18:25:19'),
(505, 203, 'doughnut 2', '46.45', 1, '2021-09-03 18:25:19'),
(506, 204, 'sweet 999', '10.30', 2, '2021-09-07 09:59:02'),
(507, 204, 'sweet 2', '55.25', 2, '2021-09-07 09:59:02'),
(508, 205, 'sweet 999', '10.30', 2, '2021-09-27 18:33:09'),
(509, 205, 'sweet 2', '55.25', 1, '2021-09-27 18:33:09'),
(510, 206, 'sweet 999', '10.30', 2, '2021-09-27 18:38:54'),
(511, 206, 'sweet 2', '55.25', 2, '2021-09-27 18:38:54'),
(512, 206, 'cake 1', '32.00', 1, '2021-09-27 18:38:54'),
(513, 206, 'cake 2', '75.20', 2, '2021-09-27 18:38:54'),
(514, 207, 'sweet 999', '10.30', 2, '2021-09-27 18:39:53'),
(515, 208, 'sweet 999', '10.30', 2, '2021-09-27 18:53:19'),
(516, 208, 'sweet 2', '55.25', 2, '2021-09-27 18:53:19'),
(517, 208, 'sweet 3', '35.15', 2, '2021-09-27 18:53:19'),
(518, 209, 'sweet 999', '10.30', 3, '2021-09-27 19:08:40'),
(519, 209, 'sweet 2', '55.25', 3, '2021-09-27 19:08:41'),
(520, 209, 'sweet 3', '35.15', 3, '2021-09-27 19:08:41'),
(521, 209, 'cake 1', '32.00', 1, '2021-09-27 19:08:41'),
(522, 210, 'sweet 999', '10.30', 2, '2021-09-28 17:51:06'),
(523, 210, 'sweet 2', '55.25', 2, '2021-09-28 17:51:06'),
(524, 211, 'sweet 999', '10.30', 1, '2021-09-28 17:55:45'),
(525, 211, 'sweet 2', '55.25', 2, '2021-09-28 17:55:45'),
(526, 212, 'sweet 999', '10.30', 2, '2021-09-28 18:06:46'),
(527, 212, 'sweet 2', '55.25', 2, '2021-09-28 18:06:46'),
(528, 213, 'sweet 999', '10.30', 2, '2021-09-30 16:41:10'),
(529, 214, 'sweet 999', '10.30', 3, '2021-10-06 16:48:16'),
(530, 214, 'sweet 2', '55.25', 3, '2021-10-06 16:48:16'),
(531, 214, 'sweet 3', '35.15', 2, '2021-10-06 16:48:16');

-- --------------------------------------------------------

--
-- Estrutura da tabela `products`
--

CREATE TABLE `products` (
  `id_product` int(10) UNSIGNED NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `visible` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `active` tinyint(4) DEFAULT NULL,
  `price_without_VAT` decimal(6,2) DEFAULT NULL,
  `VAT` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `products`
--

INSERT INTO `products` (`id_product`, `category`, `product_name`, `description`, `image`, `price`, `stock`, `visible`, `created_at`, `updated_at`, `deleted_at`, `active`, `price_without_VAT`, `VAT`) VALUES
(1, 'sweet', 'doce1', 'm ad fugiat optio.', 'sweets-1.jpeg', '10.30', 100, 1, '2021-02-06 19:45:18', '2021-08-06 18:33:05', NULL, 1, '37.15', '0.23'),
(2, 'sweet', 'sweet 2', 'Possimus iusto esse atque autem rem, porro officiis sapiente quos velit laboriosam id expedita odio obcaecati voluptate repudiandae dignissimos eveniet repellat blanditiis.', 'sweets-2.jpeg', '55.25', 100, 1, '2021-02-06 19:45:19', '2021-06-25 10:23:42', NULL, 1, '44.92', '0.23'),
(3, 'sweet', 'sweet 3', 'Nostrum quisquam dolorum dolor autem accusamus fugit nesciunt, atque et? Quis eum nemo quidem officia cum dolorem voluptates! Autem, earum. Similique, fugit.', 'sweets-3.jpeg', '35.15', 100, 1, '2021-02-06 19:45:20', '2021-06-25 10:23:47', NULL, 1, '28.58', '0.23'),
(4, 'cake', 'cake 1', 'Molestiae quaerat distinctio, facere perferendis necessitatibus optio repellat alias commodi voluptatem velit corrupti natus exercitationem quos amet facilis sint nulla delectus.', 'cake-1.jpeg', '32.00', 100, 1, '2021-02-06 19:45:20', '2021-06-25 10:23:55', NULL, 1, '26.02', '0.23'),
(5, 'cake', 'cake 2', 'Labore voluptatem sed in distinctio iste tempora quo assumenda impedit illo soluta repudiandae animi earum suscipit, sequi excepturi inventore magnam velit voluptatibus.', 'cake-2.jpeg', '75.20', 100, 1, '2021-02-06 19:45:21', '2021-06-25 10:24:01', NULL, 1, '61.14', '0.23'),
(6, 'cake', 'cake 3', 'Provident ipsum earum magnam odit in, illum nostrum est illo pariatur molestias esse delectus aliquam ullam maxime mollitia tempore, sunt officia suscipit.', 'cake-3.jpeg', '86.00', 100, 1, '2021-02-06 19:45:21', '2021-08-06 10:31:03', NULL, 1, '69.92', '0.23'),
(7, 'doughnut', 'doughnut 1', 'Qui aliquid sed quisquam autem quas recusandae labore neque laudantium iusto modi repudiandae doloremque ipsam ad omnis inventore, cum ducimus praesentium. Consectetur!', 'doughnut-1.jpeg', '48.85', 100, 1, '2021-02-06 19:45:22', '2021-06-25 10:24:12', NULL, 1, '39.72', '0.23'),
(8, 'doughnut', 'doughnut 2', 'Aspernatur labore corporis modi quis temporibus eos hic? Sed fugiat, repudiandae distinctio, labore temporibus, non magni consectetur dolorum earum amet impedit nesciunt.', 'doughnut-2.jpeg', '46.45', 100, 1, '2021-02-06 19:45:22', '2021-07-09 17:08:59', NULL, 1, '37.76', '0.23');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Índices para tabela `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Índices para tabela `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id_order_product`);

--
-- Índices para tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT de tabela `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT de tabela `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de tabela `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id_order_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=532;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
