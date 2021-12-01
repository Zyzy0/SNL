create database if not exists gallery;
use gallery;

drop table if exists user;
CREATE TABLE `user`(
  `user_id` bigint NOT NULL AUTO_INCREMENT UNSIGNED,
  `gallery_id` bigint NOT NULL UNSIGNED,
  `username` varchar(32),
  `password_hash` varchar(32),
  PRIMARY KEY (`user_id`), 
  FOREIGN KEY (`gallery_id`) REFERENCE gallery(`gallery_id`)
);

drop table if exists gallery;
CREATE TABLE `gallery`(
  `gallery_id` bigint NOT NULL AUTO_INCREMENT UNSIGNED,
  `user_id` bigint NOT NULL UNSIGNED,
  `name` varchar(128),
  `description` text,
  PRIMARY KEY (`gallery_id`),
  FOREIGN KEY (`user_id`) REFERENCE gallery(`user_id`)
);

drop table if exists images;
CREATE TABLE `images`(
  `image_id` bigint NOT NULL AUTO_INCREMENT UNSIGNED,
  `gallery_id` bigint NOT NULL UNSIGNED,
  `source` varchar(32),
  `description` varchar(32),
  `created_at` timestamp,
  PRIMARY KEY (`image_id`),
  FOREIGN KEY (`gallery_id`) REFERENCE gallery(`gallery_id`)
);

drop table if exists comment;
CREATE TABLE `comment`(
  `comment_id` bigint NOT NULL AUTO_INCREMENT UNSIGNED,
  `image_id` bigint NOT NULL UNSIGNED,
  `user_id` bigint NOT NULL UNSIGNED,
  `content` text,
  `title` varchar(32),
  `created_at` timestamp,
  PRIMARY KEY (`comment_id`),
  FOREIGN KEY (`image_id`) REFERENCE gallery(`image_id`),
  FOREIGN KEY (`user_id`) REFERENCE gallery(`user_id`)
);
