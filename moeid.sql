/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : moeid

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2013-10-24 15:49:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for moeid_app
-- ----------------------------
DROP TABLE IF EXISTS `moeid_app`;
CREATE TABLE `moeid_app` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `owner` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `apps_owner` (`owner`),
  CONSTRAINT `apps_owner` FOREIGN KEY (`owner`) REFERENCES `moeid_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of moeid_app
-- ----------------------------
INSERT INTO `moeid_app` VALUES ('moeid', 'MoeID', '/img/moeid.png', '/favicon.ico', null);
INSERT INTO `moeid_app` VALUES ('mycard', 'MyCard', 'https://my-card.in/logo.png', 'http://my-card.in/favicon.ico', '94366022-3c6f-11e3-aa6b-08002700c0cf');

-- ----------------------------
-- Table structure for moeid_user
-- ----------------------------
DROP TABLE IF EXISTS `moeid_user`;
CREATE TABLE `moeid_user` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `from` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username` (`name`),
  UNIQUE KEY `users_email` (`email`),
  KEY `users_app` (`from`),
  CONSTRAINT `users_app` FOREIGN KEY (`from`) REFERENCES `moeid_app` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of moeid_user
-- ----------------------------
INSERT INTO `moeid_user` VALUES ('94366022-3c6f-11e3-aa6b-08002700c0cf', 'zh99998', '111111', 'zh99998@gmail.com', 'moeid');

-- ----------------------------
-- Table structure for moeid_user_importing
-- ----------------------------
DROP TABLE IF EXISTS `moeid_user_importing`;
CREATE TABLE `moeid_user_importing` (
  `id` char(36) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `from` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_impoting_from` (`from`),
  CONSTRAINT `users_impoting_from` FOREIGN KEY (`from`) REFERENCES `moeid_app` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of moeid_user_importing
-- ----------------------------
