CREATE DATABASE `esa_clone`;
use esa_clone

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `screen_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255),
  `photo_dir` varchar(255),
  `role` varchar(10) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `users` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `repry_documents_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB;
ALTER TABLE `documents` ADD PRIMARY KEY (`id`);
ALTER TABLE `documents` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `documents` (`title`, `body`, `user_id`, `created`, `updated`) VALUES ("タイトル1/管理者だよ", "ボディ1", "1", now(), now());
INSERT INTO `documents` (`title`, `body`, `user_id`, `created`, `updated`) VALUES ("タイトル2/user2の田中だよ", "ボディ2", "2", now(), now());
INSERT INTO `documents` (`title`, `body`, `user_id`, `created`, `updated`) VALUES ("タイトル3/user2の田中です", "ボディ3", "2", now(), now());
INSERT INTO `documents` (`title`, `body`, `user_id`, `created`, `updated`) VALUES ("タイトル4/管理者", "ボディ1", "1", now(), now());
INSERT INTO `documents` (`title`, `body`, `user_id`, `created`, `updated`) VALUES ("タイトル5", "ボディ2", "1", now(), now());
INSERT INTO `documents` (`title`, `body`, `user_id`, `created`, `updated`) VALUES ("タイトル6/ふが", "ボディ3", "3", now(), now());