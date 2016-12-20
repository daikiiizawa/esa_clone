CREATE DATABASE `esa_clone`;
use esa_clone

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `users` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `repry_documents_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `documents` ADD PRIMARY KEY (`id`);
ALTER TABLE `documents` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `documents` (`user_id`, `title`, `body`, `created`, `updated`) VALUES ("1", "タイトル1", "ボディ1", now(), now());
INSERT INTO `documents` (`user_id`, `title`, `body`, `created`, `updated`) VALUES ("1", "タイトル2", "ボディ2", now(), now());
INSERT INTO `documents` (`user_id`, `title`, `body`, `created`, `updated`) VALUES ("1", "タイトル3", "ボディ3", now(), now());