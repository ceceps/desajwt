/*
 Navicat Premium Data Transfer

 Source Server         : user_desawisata
 Source Server Type    : MariaDB
 Source Server Version : 100137
 Source Host           : 127.0.0.1:3306
 Source Schema         : db_desawisataj

 Target Server Type    : MariaDB
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 21/04/2019 09:24:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for r_halaman
-- ----------------------------
DROP TABLE IF EXISTS `r_halaman`;
CREATE TABLE `r_halaman`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `judul` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `hits` int(11) NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fkauthorArtikel`(`author_id`) USING BTREE,
  FULLTEXT INDEX `idx_konten`(`judul`, `konten`),
  CONSTRAINT `r_halaman_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of r_halaman
-- ----------------------------
INSERT INTO `r_halaman` VALUES (11, 'Tentang Kami', 'tentang-kami', '<p>Website Desa Wisata merupakan kumpulan data info wisata,&nbsp; berkaitan potensi alam dan kekayaaan dan potensi wisata dari suatu desa menjadikan desa tersebut memiliki nilai jual yang tinggi untuk menjadi destinasi baru sebagai Desa Wisata yang ada di Jawa Barat. Website ini dikelola secara rutin dengan melibatkan petugas kab/kota yang ada di daerah. Data yang dimuat sudah mengalami proses editing sehingga layak konsumsi dan akurat informasinya . Informasi desa wisata dapat diakses juga melalui aplikasi android</p>', 1, 0, 1, '2019-04-08 17:13:29', '2019-04-08 17:47:53', NULL);

SET FOREIGN_KEY_CHECKS = 1;
