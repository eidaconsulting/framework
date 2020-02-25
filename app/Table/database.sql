CREATE TABLE `ben4_users` (
    `id` int(11) NOT NULL,
    `email` varchar(255) DEFAULT NULL,
    `phone` varchar(255) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `token` varchar(255) DEFAULT NULL,
    `uniqid` varchar(255) DEFAULT NULL,
    `state` tinyint(1) DEFAULT '0',
    `right` tinyint(2) DEFAULT '0',
    `add_date` datetime DEFAULT CURRENT_TIMESTAMP,
    `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `ben4_users` ADD PRIMARY KEY (`id`);

ALTER TABLE `ben4_users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `afr_profils` (
  `id` int(11) NOT NULL,
  `users_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `activate_date` timestamp NULL DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
ALTER TABLE `afr_profils` ADD PRIMARY KEY (`id`);

ALTER TABLE `afr_profils` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


TABLE ADMINS__________________________
CREATE TABLE `ben4_admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `userright` int(11) DEFAULT NULL,
  `add_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `ben4_admins` ADD PRIMARY KEY (`id`);

ALTER TABLE `ben4_admins` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



INSERT INTO `ben4_admins` (`id`, `username`, `password`, `email`, `name`, `phone`, `userright`, `add_date`, `update_date`) VALUES
(1, 'admins', '$2y$10$ZD105HLdCfvg64ybDkvYPOJQ4C3Pr.atQOlzQpCpw6oZWHC9gTGYW', 'azziz.bello2@gmail.com', 'Azziz BELLO', '97334389', 1, '2017-07-04 15:12:28', NULL),
(23, 'didierfabrice', '$2y$10$ZD105HLdCfvg64ybDkvYPOJQ4C3Pr.atQOlzQpCpw6oZWHC9gTGYW', 'didier.fabrice@gmail.com', 'DIDIER Fabice', '98989898', 2, '2017-07-06 02:24:58', NULL),
(24, 'lucgnancadja', '$2y$10$LJTicMTw8BEKnp21e7IzQOwat8H0aOWZExfeBHHdBKhYSwJyax2.W', 'luc.gnancadja@gmail.com', 'Luc GNANCADJA', '68585858', 3, '2017-07-06 02:26:44', NULL);


TABLES BLOG ___________________________________
CREATE TABLE `ben4_blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(75) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` longtext,
  `slug` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `featuring` int(11) NOT NULL DEFAULT '0',
  `see` int(11) NOT NULL DEFAULT '0',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `ben4_blogs` ADD PRIMARY KEY (`id`);

ALTER TABLE `ben4_blogs` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


TABLE CATEGORIES BLOG __________________________
CREATE TABLE `ben4_blogcategories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `ben4_blogcategories` ADD PRIMARY KEY (`id`);
--
ALTER TABLE `ben4_blogcategories` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
