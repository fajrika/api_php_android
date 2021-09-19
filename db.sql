/*
 Navicat Premium Data Transfer

 Source Server         : rifatronika dennis
 Source Server Type    : MySQL
 Source Server Version : 100415
 Source Host           : 151.106.117.102:3306
 Source Schema         : u210473105_dennis

 Target Server Type    : MySQL
 Target Server Version : 100415
 File Encoding         : 65001

 Date: 19/09/2021 21:00:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for achievements
-- ----------------------------
DROP TABLE IF EXISTS `achievements`;
CREATE TABLE `achievements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nisn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lomba` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_lomba` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkatan` enum('Provinsi','Nasional','Internasional') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peringkat` int(11) DEFAULT NULL,
  `grade` enum('A','B','C','D') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pembimbing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);

-- ----------------------------
-- Records of achievements
-- ----------------------------
BEGIN;
INSERT INTO `achievements` VALUES (8, '1234', 'nama35', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 12:37:48');
INSERT INTO `achievements` VALUES (9, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 15:55:25');
INSERT INTO `achievements` VALUES (10, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 16:52:42');
INSERT INTO `achievements` VALUES (11, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 16:52:52');
INSERT INTO `achievements` VALUES (12, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 17:36:22');
INSERT INTO `achievements` VALUES (13, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 17:55:50');
INSERT INTO `achievements` VALUES (14, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-09 18:00:45');
INSERT INTO `achievements` VALUES (15, '1234', 'nama3', 'test', '2020-09-09', 'pemerintah', 'Nasional', 1, 'A', 'abc', '', '2021-09-19 09:03:09');
INSERT INTO `achievements` VALUES (16, '4321', 'Fajrika', 'Olimpiade Komputer', '2021-10-19', 'Pemerintah', '', 1, 'D', 'Yovie', 'Berlokasi di SMANSA ME', '2021-09-19 09:32:15');
INSERT INTO `achievements` VALUES (17, '98761', 'Fajrika', 'Olimpiade Komputer', '2021-10-09', 'Pemerintah', 'Provinsi', 1, 'D', 'Yovie', 'Berlokasi di bumi', '2021-09-19 09:46:55');
INSERT INTO `achievements` VALUES (18, '12341', 'aa', 'asfasf', '2021-10-09', 'adasf', 'Internasional', 1, 'D', 'asdfasf', 'asfasf', '2021-09-19 09:48:48');
INSERT INTO `achievements` VALUES (20, '12458912', 'Dennis Hutomo', 'Olimpiade Matematika', '2021-01-01', 'Kampus', 'Internasional', 3, 'A', 'Bambang Pamungkas', 'Lomba di adakan di online', '2021-09-19 12:33:25');
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'dennis', 'abc123?');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
