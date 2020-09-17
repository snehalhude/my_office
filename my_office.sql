-- Adminer 4.7.7 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1=> Active 0=>Inactive',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `employees` (`id`, `emp_id`, `name`, `email`, `phone`, `status`, `created`, `modified`) VALUES
(1,	'mo_101',	'Snehal Hude',	'admin@admin.com',	5675675675,	'1',	'2020-09-17 11:49:06',	'0000-00-00 00:00:00'),
(2,	'mo_102',	'Priya Pise',	'priya@yopmail.com',	6756756756,	'1',	'2020-09-17 11:56:29',	'0000-00-00 00:00:00'),
(3,	'mo_103',	'anny day',	'anny@yopmail.com',	9867666666,	'1',	'2020-09-17 12:48:14',	'0000-00-00 00:00:00'),
(4,	'mo_104',	'nissa doe',	'nissa@yopmail.com',	4554645645,	'1',	'2020-09-17 12:52:35',	'0000-00-00 00:00:00'),
(5,	'mo_105',	'test',	'test@admin.com',	5675675675,	'1',	'2020-09-17 12:53:29',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) NOT NULL COMMENT 'for forget password',
  `user_type` enum('admin','user') NOT NULL DEFAULT 'user',
  `is_verified` smallint(1) NOT NULL COMMENT '1=> Verified 0=>Not Verified',
  `status` smallint(1) NOT NULL COMMENT '1=> Active 0=>Inactive 2 => Pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `remember_token`, `user_type`, `is_verified`, `status`, `created`, `modified`) VALUES
(1,	'Admin',	'admin@admin.com',	5464564564,	'e10adc3949ba59abbe56e057f20f883e',	'8a279e5c5354af5ae7810101fd16c35a749451cc',	'admin',	1,	1,	'2020-07-05 13:01:44',	'2020-09-17 10:33:50'),
(2,	'Admin',	'admin@yopmail.com',	2147483647,	'e10adc3949ba59abbe56e057f20f883e',	'8a279e5c5354af5ae7810101fd16c35a749451cc',	'admin',	1,	1,	'2020-07-05 13:01:44',	'2020-09-16 04:24:32');

-- 2020-09-17 11:26:32
