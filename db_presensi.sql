/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_presensi

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 28/01/2024 23:19:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 295 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------
INSERT INTO `personal_access_tokens` VALUES (238, 'App\\Models\\User', 64, 'authToken', '5dae0f97300cff7350b24104eb78decfe65d5d6dfaa4311f4c66ecf5a45e4685', '[\"*\"]', NULL, NULL, '2024-01-26 08:48:16', '2024-01-26 08:48:16');
INSERT INTO `personal_access_tokens` VALUES (256, 'App\\Models\\User', 1, 'authToken', '587934c69db98216abbc54f7aec0fa1578deb2ba43ff39a9c74a21635f696eb4', '[\"*\"]', '2024-01-26 11:58:29', NULL, '2024-01-26 09:39:01', '2024-01-26 11:58:29');
INSERT INTO `personal_access_tokens` VALUES (277, 'App\\Models\\User', 66, 'authToken', '34140bf79d34760fee46aaf41855f46568cb8c11308bb6808ce7c59524e373c8', '[\"*\"]', '2024-01-26 12:26:20', NULL, '2024-01-26 11:03:59', '2024-01-26 12:26:20');
INSERT INTO `personal_access_tokens` VALUES (278, 'App\\Models\\User', 66, 'authToken', '558ae54b7f905376c00346eb3e3141b67c11ad9a03df18eef97c20e096e04c63', '[\"*\"]', '2024-01-28 14:40:37', NULL, '2024-01-26 11:59:15', '2024-01-28 14:40:37');
INSERT INTO `personal_access_tokens` VALUES (279, 'App\\Models\\User', 66, 'authToken', '8709ac6b961234d3fe7f4f67c97b09a04a52e529499da207ec67589a3603403e', '[\"*\"]', '2024-01-26 12:42:20', NULL, '2024-01-26 12:27:54', '2024-01-26 12:42:20');
INSERT INTO `personal_access_tokens` VALUES (280, 'App\\Models\\User', 66, 'authToken', '1c221e49e302f6247a24ab04f9125a0cc8f06a1b5ef96ad76e2611ec197fdb1d', '[\"*\"]', '2024-01-28 01:33:30', NULL, '2024-01-26 12:31:27', '2024-01-28 01:33:30');
INSERT INTO `personal_access_tokens` VALUES (281, 'App\\Models\\User', 66, 'authToken', '5efee3512137d72a0a55138af0c5f8ad17557e672d1863aa0d0359457fa775b1', '[\"*\"]', '2024-01-26 12:41:06', NULL, '2024-01-26 12:36:15', '2024-01-26 12:41:06');
INSERT INTO `personal_access_tokens` VALUES (282, 'App\\Models\\User', 66, 'authToken', '3325184eb87b618d5cc39e67bca50739e0dfcb1d849ea1da24fe47c044d82113', '[\"*\"]', '2024-01-26 12:42:19', NULL, '2024-01-26 12:41:58', '2024-01-26 12:42:19');
INSERT INTO `personal_access_tokens` VALUES (283, 'App\\Models\\User', 1, 'authToken', '252575bfed9f5f5be01153ca9a6e6813076908ca779b1234f03c3cf349aa80b0', '[\"*\"]', '2024-01-27 01:37:57', NULL, '2024-01-27 00:14:47', '2024-01-27 01:37:57');
INSERT INTO `personal_access_tokens` VALUES (284, 'App\\Models\\User', 66, 'authToken', 'b050e0ef5612475437b9ba7a816e34e0206df31208f01720137ab3c7fdc76313', '[\"*\"]', '2024-01-27 01:37:02', NULL, '2024-01-27 01:33:28', '2024-01-27 01:37:02');
INSERT INTO `personal_access_tokens` VALUES (285, 'App\\Models\\User', 45, 'authToken', '8e126b31eb3ce506b2524d4af639f17f35a9ab2ee5f59a5aa715fe37e2f4f011', '[\"*\"]', NULL, NULL, '2024-01-27 01:37:56', '2024-01-27 01:37:56');
INSERT INTO `personal_access_tokens` VALUES (286, 'App\\Models\\User', 66, 'authToken', 'ddbdb40b527e5a6ea67c8c4e48e6858443fc005c16df32137370477b577960ff', '[\"*\"]', '2024-01-27 02:46:20', NULL, '2024-01-27 01:40:02', '2024-01-27 02:46:20');
INSERT INTO `personal_access_tokens` VALUES (287, 'App\\Models\\User', 66, 'authToken', 'efff32c260bc425caf3da13f13ad8a04e3871e05f156932e25becf5ccf41072e', '[\"*\"]', '2024-01-27 02:53:25', NULL, '2024-01-27 02:45:15', '2024-01-27 02:53:25');
INSERT INTO `personal_access_tokens` VALUES (288, 'App\\Models\\User', 75, 'authToken', 'cf899832f5193b27b899c5be726c2f3528daa675330c9a22effcca3e915fe835', '[\"*\"]', '2024-01-27 12:18:31', NULL, '2024-01-27 11:13:44', '2024-01-27 12:18:31');
INSERT INTO `personal_access_tokens` VALUES (289, 'App\\Models\\User', 75, 'authToken', '8de6016c88e0137bb656754a717d4f0a0d494341dd28d14ca346e7340dd8e1f0', '[\"*\"]', '2024-01-27 12:18:34', NULL, '2024-01-27 12:17:01', '2024-01-27 12:18:34');
INSERT INTO `personal_access_tokens` VALUES (290, 'App\\Models\\Admin', 4, 'authToken', '8cde8e97d4d95e31056ee5a44f13169e7ca2434cd9cf61cf50d93dcebb1fea32', '[\"*\"]', '2024-01-28 15:44:40', NULL, '2024-01-28 01:50:54', '2024-01-28 15:44:40');
INSERT INTO `personal_access_tokens` VALUES (291, 'App\\Models\\Admin', 4, 'authToken', 'cd78df15d13b33151da3dd44b33cdf08bd52b3c91991c3bf006b6453e4dd4059', '[\"*\"]', '2024-01-28 04:51:46', NULL, '2024-01-28 03:40:13', '2024-01-28 04:51:46');
INSERT INTO `personal_access_tokens` VALUES (292, 'App\\Models\\User', 75, 'authToken', '9bd4dc4491486b0efd9e5a4faeb9766531e934378007bcee6953a4bd1f4619d0', '[\"*\"]', NULL, NULL, '2024-01-28 14:38:32', '2024-01-28 14:38:32');
INSERT INTO `personal_access_tokens` VALUES (293, 'App\\Models\\User', 66, 'authToken', 'ffb04bfd55ee33cdc01df6f6a5bfe781b766744628896b93209c8afba1d9c880', '[\"*\"]', NULL, NULL, '2024-01-28 14:38:56', '2024-01-28 14:38:56');
INSERT INTO `personal_access_tokens` VALUES (294, 'App\\Models\\User', 75, 'authToken', '9dfd95669b5b0bf88e1508a7c91583026c1fdd89f323f022d4391616cdb585bb', '[\"*\"]', '2024-01-28 16:09:51', NULL, '2024-01-28 14:44:17', '2024-01-28 16:09:51');

-- ----------------------------
-- Table structure for tbl_absen
-- ----------------------------
DROP TABLE IF EXISTS `tbl_absen`;
CREATE TABLE `tbl_absen`  (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `id_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_in` date NULL DEFAULT NULL,
  `id_ket_in` int NULL DEFAULT NULL,
  `jam_in` time NULL DEFAULT NULL,
  `ket_absen_in` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `bukti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_out` date NULL DEFAULT NULL,
  `id_ket_out` int NULL DEFAULT NULL,
  `jam_out` time NULL DEFAULT NULL,
  `ket_absen_out` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stts_ijin` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_absen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 146 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_absen
-- ----------------------------
INSERT INTO `tbl_absen` VALUES (138, '66', '2024-01-26', 1, '12:42:11', NULL, NULL, '2024-01-26', 1, '12:42:19', NULL, NULL, '2024-01-26 19:42:19');
INSERT INTO `tbl_absen` VALUES (142, '75', '2024-01-27', 1, '11:14:32', NULL, NULL, '2024-01-27', 1, '11:15:51', NULL, NULL, '2024-01-27 18:15:51');
INSERT INTO `tbl_absen` VALUES (144, '75', '2023-12-27', 1, '12:14:55', NULL, NULL, NULL, 0, NULL, NULL, NULL, '2024-01-27 19:14:55');
INSERT INTO `tbl_absen` VALUES (145, '75', '2024-01-28', 1, '01:25:12', NULL, NULL, '2024-01-28', 1, '01:26:58', NULL, NULL, '2024-01-28 08:26:58');

-- ----------------------------
-- Table structure for tbl_admin
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_akses` int NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nip` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `id_unit` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `username`(`username` ASC) USING BTREE,
  INDEX `id_akses`(`id_akses` ASC) USING BTREE,
  INDEX `tbl_admin_ibfk_2`(`id_unit` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES (1, 3, 'diskominfo_qr', '$2y$10$suBEc1CiuLf/MAicg5gIsO16oWSocLkBMW/TkMed/.89XD6aF.lbm', 'Fredisen Madianu', NULL, NULL, '2023-04-23 16:20:52', NULL, NULL, '5');
INSERT INTO `tbl_admin` VALUES (2, 2, 'digital_native', '$2y$10$suBEc1CiuLf/MAicg5gIsO16oWSocLkBMW/TkMed/.89XD6aF.lbm', 'Dede Almustaqim, S.Kom', NULL, 'simpel@simpel.com', '2023-04-17 21:56:06', NULL, NULL, '1');
INSERT INTO `tbl_admin` VALUES (3, 1, 'AdminDigitalNative', '$2y$10$suBEc1CiuLf/MAicg5gIsO16oWSocLkBMW/TkMed/.89XD6aF.lbm', 'Dede Almustaqim, S.kom', NULL, 'simpel@simpel.com', '2020-08-20 17:00:00', NULL, '2023-04-06 04:25:10', NULL);
INSERT INTO `tbl_admin` VALUES (4, 3, 'digital_native_qr', '$2y$10$suBEc1CiuLf/MAicg5gIsO16oWSocLkBMW/TkMed/.89XD6aF.lbm', 'Dede Almustaqim', NULL, NULL, '2023-04-23 16:20:52', NULL, NULL, '1');

-- ----------------------------
-- Table structure for tbl_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akses`;
CREATE TABLE `tbl_akses`  (
  `id_akses` int NOT NULL AUTO_INCREMENT,
  `hak_akses` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_akses
-- ----------------------------
INSERT INTO `tbl_akses` VALUES (1, 'Superadmin');
INSERT INTO `tbl_akses` VALUES (2, 'Adminstrator SKPD');
INSERT INTO `tbl_akses` VALUES (3, 'Operator Kode QR ');
INSERT INTO `tbl_akses` VALUES (4, 'Operator');
INSERT INTO `tbl_akses` VALUES (5, 'Dana Desa');

-- ----------------------------
-- Table structure for tbl_banner
-- ----------------------------
DROP TABLE IF EXISTS `tbl_banner`;
CREATE TABLE `tbl_banner`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_banner
-- ----------------------------
INSERT INTO `tbl_banner` VALUES (7, 'Pj 1', 'https://baritotimurkab.go.id/wp-content/uploads/2023/09/PJ-bartim-berahklak-768x1293-1-608x1024.png', '2024-01-28 04:51:44', '2024-01-28 04:51:44');
INSERT INTO `tbl_banner` VALUES (8, 'Pj 1', 'https://baritotimurkab.go.id/wp-content/uploads/2023/09/PJ-bartim-berahklak-768x1293-1-608x1024.png', '2024-01-28 04:51:46', '2024-01-28 04:51:46');
INSERT INTO `tbl_banner` VALUES (9, 'Pj 1', 'https://baritotimurkab.go.id/wp-content/uploads/2023/09/PJ-bartim-berahklak-768x1293-1-608x1024.png', '2024-01-28 04:51:46', '2024-01-28 04:51:46');

-- ----------------------------
-- Table structure for tbl_bc
-- ----------------------------
DROP TABLE IF EXISTS `tbl_bc`;
CREATE TABLE `tbl_bc`  (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `konten` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `publish` date NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_bc
-- ----------------------------
INSERT INTO `tbl_bc` VALUES (1, 'Notifikasi dari Digital Native', 'Ini adalah aplikasi buatan Dede almustaqim', '2023-04-19', 'http://digitalnative.web.id/wp-content/uploads/2022/06/simpera1.png');
INSERT INTO `tbl_bc` VALUES (2, 'Pemberitahuan Penting', 'Silahkan dicoba aplikasi ini, testing untuk bug error dan celah untuk proses absensi', '2023-04-22', 'http://digitalnative.web.id/wp-content/uploads/2022/06/simpera1.png');

-- ----------------------------
-- Table structure for tbl_config
-- ----------------------------
DROP TABLE IF EXISTS `tbl_config`;
CREATE TABLE `tbl_config`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nm_pemda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `qr_time_in_start` time NULL DEFAULT NULL,
  `qr_time_in_end` time NULL DEFAULT NULL,
  `qr_time_out_start` time NULL DEFAULT NULL,
  `qr_time_out_end` time NULL DEFAULT NULL,
  `radius` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_config
-- ----------------------------
INSERT INTO `tbl_config` VALUES (1, 'BARITO TIMUR', '07:00:00', '23:00:00', '08:30:00', '24:30:00', 100);

-- ----------------------------
-- Table structure for tbl_info
-- ----------------------------
DROP TABLE IF EXISTS `tbl_info`;
CREATE TABLE `tbl_info`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `informasi` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_info
-- ----------------------------
INSERT INTO `tbl_info` VALUES (1, 'Launching Aplikasi Absen', 'Telah Launching Aplikasi Absensi', '2024-01-28 03:49:33', '2024-01-28 03:51:35', 'Penting');
INSERT INTO `tbl_info` VALUES (2, 'Launching Aplikasi Absen', 'Telah Launching Aplikasi Absensi', '2024-01-28 03:49:39', '2024-01-28 03:49:39', 'Penting');
INSERT INTO `tbl_info` VALUES (3, 'Launching Aplikasi Absen', 'Telah Launching Aplikasi Absensi', '2024-01-28 03:49:40', '2024-01-28 03:49:40', 'Penting');
INSERT INTO `tbl_info` VALUES (4, 'Launching Aplikasi Absen', 'Telah Launching Aplikasi Absensi', '2024-01-28 03:49:40', '2024-01-28 03:49:40', 'Segera');
INSERT INTO `tbl_info` VALUES (5, 'Launching Aplikasi Absen', 'Telah Launching Aplikasi Absensi', '2024-01-28 03:49:42', '2024-01-28 03:49:42', 'Penting');

-- ----------------------------
-- Table structure for tbl_ket
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ket`;
CREATE TABLE `tbl_ket`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `ket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_ket
-- ----------------------------
INSERT INTO `tbl_ket` VALUES (1, 'Hadir');
INSERT INTO `tbl_ket` VALUES (2, 'Tanpa Ket.');
INSERT INTO `tbl_ket` VALUES (3, 'DL');
INSERT INTO `tbl_ket` VALUES (4, 'DD');
INSERT INTO `tbl_ket` VALUES (5, 'Sakit');
INSERT INTO `tbl_ket` VALUES (6, 'Hal Lainnya');

-- ----------------------------
-- Table structure for tbl_ket_out
-- ----------------------------
DROP TABLE IF EXISTS `tbl_ket_out`;
CREATE TABLE `tbl_ket_out`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_ket_out` int NULL DEFAULT NULL,
  `ket_out` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_ket_out
-- ----------------------------
INSERT INTO `tbl_ket_out` VALUES (1, 0, 'Belum Absen');
INSERT INTO `tbl_ket_out` VALUES (2, 1, 'Hadir');
INSERT INTO `tbl_ket_out` VALUES (3, 2, 'Tanpa Ket.');
INSERT INTO `tbl_ket_out` VALUES (4, 3, 'Dinas Luar');
INSERT INTO `tbl_ket_out` VALUES (5, 4, 'Sakit');
INSERT INTO `tbl_ket_out` VALUES (6, 5, 'Hal Lainnya');

-- ----------------------------
-- Table structure for tbl_news
-- ----------------------------
DROP TABLE IF EXISTS `tbl_news`;
CREATE TABLE `tbl_news`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `content` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_news
-- ----------------------------
INSERT INTO `tbl_news` VALUES (1, 'Pedagang Sayur di Pasar Tamiang Layang Sebut Kenaikan Harga Cabai Masih Wajar', '<p><strong>BORNEONEWS, Tamiang Layang </strong>- Pedagang sayur-sayuran di Pasar Tamiang Layang Kabupaten Barito Timur menyebut, kenaikan harga beberapa jenis cabai saat ini masih wajar, karena pada saat yang sama cabai jenis tiung justru mengalami penurunan harga yang cukup besar.</p>', 'https://www.borneonews.co.id/images/upload/2024/01/24/1706106871-1.jpg', '2024-01-28 10:30:28', '2024-01-28 10:30:28');
INSERT INTO `tbl_news` VALUES (2, 'Disdukcapil Barito Timur Datangi Sekolah untuk Perekaman KTP-El ', '<p><strong>BORNEONEWS, Tamiang Layang </strong>- Dinas Kependudukan dan Catatan Sipil atau Disdukcapil Kabupaten Barito Timur menggunakan metode jemput bola atau Jebol dengan mendatangi sekolah-sekolah untuk melakukan perekaman Kartu Tanda Penduduk Elektronik (KTP-El) bagi pelajar berusia 16 tahun atau lebih.</p>', 'https://www.borneonews.co.id/images/upload/2024/01/24/1706098718-1.jpg', '2024-01-28 10:31:07', '2024-01-28 10:31:07');
INSERT INTO `tbl_news` VALUES (3, 'Kondisi RSUD Tamiang Layang Tidak Sesuai Harapan Pj Bupati Saat Penilaian Akreditasi 3 Bulan Lalu', '<p><strong>BORNEONEWS, Tamiang Layang</strong> - Harapan Pj Bupati Barito Timur Indra Gunawan terhadap pelayanan RSUD Tamiang Layang saat penilaian akreditasi 3 bulan silam tidak sesuai dengan kenyataan yang terjadi di rumah sakit tersebut saat ini dengan ramainya keluhan keluarga pasien dan pegawai di sana.</p><p>Saat itu dia juga mengucapkan terima kasih kepada direktur dan seluruh jajaran RSUD Tamiang Layang yang telah bekerja keras untuk mempersiapkan survei penilaian akreditasi.</p>', 'https://www.borneonews.co.id/images/upload/2024/01/24/1706051323-untitled-1.jpg', '2024-01-28 03:40:22', '2024-01-28 03:40:22');

-- ----------------------------
-- Table structure for tbl_promo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_promo`;
CREATE TABLE `tbl_promo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_promo
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_unit
-- ----------------------------
DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE `tbl_unit`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nm_unit` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `pimpinan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `gol` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `lat` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `long` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `radius` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `qr_in` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qr_out` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  UNIQUE INDEX `id_unit_2`(`id` ASC) USING BTREE,
  INDEX `id_unit`(`id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_unit
-- ----------------------------
INSERT INTO `tbl_unit` VALUES (1, 'Digital Native Developer', NULL, NULL, NULL, '-2.127930646594747', '115.19330038158368', 100, '2023-04-17 21:55:38', NULL, 'f4d22db787', 'cec369d1a2');
INSERT INTO `tbl_unit` VALUES (3, 'Badan Perencanaan Pembangunan dan Litbang Daerah', 'Kepala Bappeda', 'IVa', 'Kepala Bappeda', '-2.1695074537631482', '115.22229195114002', 100, '2023-12-30 07:38:05', '2023-12-30 07:48:53', '0650f34db7', '62872632e7');
INSERT INTO `tbl_unit` VALUES (5, 'Dinas Komunikasi Informatika dan Statistik Persandian', NULL, NULL, NULL, '-2.127930646594747', '115.19330038158368', 100, '2023-12-30 07:38:05', NULL, 'c76ae06482', '9835f961b8');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `nik` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nip` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_unit` int NULL DEFAULT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'https://i.ibb.co/S32HNjD/no-image.jpg',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `current_login` time NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE,
  INDEX `id_unit`(`id_unit` ASC) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_unit`) REFERENCES `tbl_unit` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 103 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Dede Almustaqim', 'dede.tbs@gmail.com', NULL, '6213012508890002', '$2a$12$9MEPqOwgOUfzkq4tyKhjd.d9qNDhdg3oZj/AKXL0IdIaqDli32U0O', NULL, '2024-01-26 15:21:11', '2024-01-26 15:21:11', '-', 1, 'CEO', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'dede_tbs', NULL);
INSERT INTO `users` VALUES (7, 'Ir, FRANZ SILA UTAMA ,M.AP', 'franzsila22@gmail.com', '2024-01-11 13:13:40', '6213012202670002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '196702221993081001', 3, 'KEPALA BADAN', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213012202670002', '00:00:00');
INSERT INTO `users` VALUES (8, 'FIKTORY WAHYUNO ,SP', 'fiktory.bartim@gmail.com', '2024-01-11 13:13:40', '6213020810700001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197010081999031007', 3, 'SEKRETARIS BADAN', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213020810700001', '00:00:00');
INSERT INTO `users` VALUES (9, 'EVY LISTYANI ,SP', 'listyanievy04@gmail.com', '2024-01-11 13:13:40', '6213015704750001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197504171999032010', 3, 'KABID PENELITIAN PENGEMBANGAN EKONOMI', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015704750001', '00:00:00');
INSERT INTO `users` VALUES (10, 'HUSIDA ,S,Pd., M.Si', 'husida.miter72@gmail.com', '2024-01-11 13:13:40', '6309044302720004', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197202032000122003', 3, 'KABID PEMERINTAHAN, SOSIAL DAN BUDAYA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6309044302720004', '00:00:00');
INSERT INTO `users` VALUES (11, 'KRISNA SUDARTY ,SP', 'revadanaiko@gmail.com', '2024-01-11 13:13:40', '6213014502790001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197902052005022006', 3, 'KABID PERENCANAAN, PENGENDALIAN DAN EVALUASI PEMBANGUNAN DAERAH', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213014502790001', '00:00:00');
INSERT INTO `users` VALUES (12, 'VERONIKA GALINGGING ,SP', 'veronika.g.plk@gmail.com', '2024-01-11 13:13:40', '6213015902780003', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197802192006042019', 3, 'PERENCANA AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015902780003', '00:00:00');
INSERT INTO `users` VALUES (13, 'MUHAMMAD SAIHU ,SP', 'muhammadsaihu0324@gmail.com', '2024-01-11 13:13:40', '6213012403720001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197203242006041011', 3, 'ANALIS KEBIJAKAN AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213012403720001', '00:00:00');
INSERT INTO `users` VALUES (14, 'SHINTA SETIANY ,ST', 'shinta.setiany@gmail.com/bambu.pareng77@gmail.com', '2024-01-11 13:13:40', '6213016010770002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197710202007012013', 3, 'ANALIS KEBIJAKAN AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213016010770002', '00:00:00');
INSERT INTO `users` VALUES (15, 'SANDRA HARTANI ,S.Sos', 'hartanisandra@gmail.com', '2024-01-11 13:13:40', '6213016109770001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197709212009032002', 3, 'ANALIS KEBIJAKAN AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213016109770001', '00:00:00');
INSERT INTO `users` VALUES (16, 'HARING TRIANTODA NGEPEK ,SE', 'haringtriantoda@gmail.com', '2024-01-11 13:13:40', '6213012907830001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198307292009031001', 3, 'KASUBAG KEUANGAN', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213012907830001', '00:00:00');
INSERT INTO `users` VALUES (17, 'SUSIATI ,S.Hut', 'susiati.lalin@gmail.com', '2024-01-11 13:13:40', '6213014410800002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198010042009012001', 3, 'ANALIS KEBIJAKAN AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213014410800002', '00:00:00');
INSERT INTO `users` VALUES (18, 'HERRY IRWANTO, S.Kom', 'herry.irwanto.bartim@gmail.com', '2024-01-11 13:13:40', '6309060205840002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198405022009031001', 3, 'PERENCANA AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6309060205840002', '00:00:00');
INSERT INTO `users` VALUES (19, 'YULIE PATNIATY, SE., MM', 'yuliepwiden@gmail.com', '2024-01-11 13:13:40', '6213016907760001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197607292010012009', 3, 'PERENCANA AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213016907760001', '00:00:00');
INSERT INTO `users` VALUES (20, 'LINDA SUSANTI, SE', 'lindamulyono63@gmail.com', '2024-01-11 13:13:40', '6271016705780001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197805272010012008', 3, 'KASUBID PENELITIAN DAN PENGEMBANGAN DAERAH', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6271016705780001', '00:00:00');
INSERT INTO `users` VALUES (21, 'TRIANO ,SE', '12trianno@gmail.com', '2024-01-11 13:13:40', '6213011012780003', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197812102010011014', 3, 'ANALIS KEBIJAKAN AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213011012780003', '00:00:00');
INSERT INTO `users` VALUES (22, 'TINTOANO ,SE', 'tintojagin@gmail.com', '2024-01-11 13:13:40', '6213012304810005', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198104232010011016', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213012304810005', '00:00:00');
INSERT INTO `users` VALUES (23, 'SRI SUHARIATI, S.Sos., M.Sos', 'srisuharianti82@gmail.com', '2024-01-11 13:13:40', '6213015707820001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198207172011012014', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015707820001', '00:00:00');
INSERT INTO `users` VALUES (24, 'RATIH MAYASARI ,ST', 'nyai.atih2@gmail.com', '2024-01-11 13:13:40', '6213014506860004', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198606052011012019', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213014506860004', '00:00:00');
INSERT INTO `users` VALUES (25, 'HERMAN AGUS, S.Sos', 'Muhammadbagas@gmail.com', '2024-01-11 13:13:40', '6213010905850002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198505092005021001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010905850002', '00:00:00');
INSERT INTO `users` VALUES (26, 'TRIARMALELY ,A.Md', 'cacatriarmalely@gmail.com', '2024-01-11 13:13:40', '6213015601750001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197501162006042009', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015601750001', '00:00:00');
INSERT INTO `users` VALUES (27, 'NANI HERLINA, S.Sos', 'nani.herlina1977@gmail.com', '2024-01-11 13:13:40', '6213016005770001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197705202007012016', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213016005770001', '00:00:00');
INSERT INTO `users` VALUES (28, 'PATMAWATI, S,AP., MM', 'watipatma092@gmail.com', '2024-01-11 13:13:40', '6213015601830001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198301162005022002', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015601830001', '00:00:00');
INSERT INTO `users` VALUES (29, 'HELMIATI,S. Sos', 'helmirahayu11@gmail.com', '2024-01-11 13:13:40', '6213026202860001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198602222010012001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213026202860001', '00:00:00');
INSERT INTO `users` VALUES (30, 'HENDRAWAN ,S.AB., M.M', 'hendra.anjank88@gmail.com', '2024-01-11 13:13:40', '6371020804880006', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198804082010011003', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6371020804880006', '00:00:00');
INSERT INTO `users` VALUES (31, 'MARTONO, S.AP', 'martono082@gmail.com', '2024-01-11 13:13:40', '6213010211820001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198211022009011001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010211820001', '00:00:00');
INSERT INTO `users` VALUES (32, 'RIMAYATI, S.AP', 'rimayati@rocketmail.com', '2024-01-11 13:13:40', '6213014510830001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198310052012122002', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213014510830001', '00:00:00');
INSERT INTO `users` VALUES (33, 'RIOVANNI FRANCINNI, S.IP., M.URP', 'riofrancinni@gmail.com', '2024-01-11 13:13:40', '6213010607900001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199007062015031006', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010607900001', '00:00:00');
INSERT INTO `users` VALUES (34, 'ANDREAS TANU SAPUTRA ,S.Sos', 'andretetsusakurai@gmail.com', '2024-01-11 13:13:40', '6213010910900002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199010092022021002', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010910900002', '00:00:00');
INSERT INTO `users` VALUES (35, 'GRERY VARENT ,SE', 'grery.varent@gmail.com', '2024-01-11 13:13:40', '6213010401910001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199201042022021001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010401910001', '00:00:00');
INSERT INTO `users` VALUES (36, 'KHAIRUL HIDAYAT ,S.AB', 'khairulhidayat.kh46@gmail.com', '2024-01-11 13:13:40', '6302092406940001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199406242022021002', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6302092406940001', '00:00:00');
INSERT INTO `users` VALUES (37, 'HUSAINI ,SE', 'husaini59@outlookcom', '2024-01-11 13:13:40', '6309082101970001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199701212022021001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6309082101970001', '00:00:00');
INSERT INTO `users` VALUES (38, 'M.IRFAN ABDILLAH ,S.K.M', 'irfanabdillah9807@gmail.com', '2024-01-11 13:13:40', '6308040707980004', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199807072022021001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6308040707980004', '00:00:00');
INSERT INTO `users` VALUES (39, 'MUHAMMAD ILHAM NASIR ,S.Psi', 'ilhamnasir.official@gmail.com', '2024-01-11 13:13:40', '6309063012980002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199812302022021001', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6309063012980002', '00:00:00');
INSERT INTO `users` VALUES (40, 'ROY KARTIKA', 'roykartikamanang@gmail.com', '2024-01-11 13:13:40', '6213012002800001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198002202007011010', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213012002800001', '00:00:00');
INSERT INTO `users` VALUES (41, 'ANTEK LAWI', 'anastasisheliosantektw@yahoo.co.id', '2024-01-11 13:13:40', '6213012606780001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197806262008011024', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213012606780001', '00:00:00');
INSERT INTO `users` VALUES (42, 'DINA MARIA', 'dinamaria@gmail.com', '2024-01-11 13:13:40', '6213015412780001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197812142008012021', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015412780001', '00:00:00');
INSERT INTO `users` VALUES (43, 'HARINUDIN', 'harinudin12@gmail.com', '2024-01-11 13:13:40', '6213011206690002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '196906122010011009', 3, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213011206690002', '00:00:00');
INSERT INTO `users` VALUES (44, 'HUSNI, S.Hut', 'husnisklrg54@gmail.com', '2024-01-11 13:13:40', '6204060504680001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '196804051998031015', 3, 'KASUBAG UMUM DAN KEPEGAWAIAN', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6204060504680001', '00:00:00');
INSERT INTO `users` VALUES (45, 'INDRA SUGATA, S.Hut', 'noemail@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'INDRASUGATA,S.Hut', '00:00:00');
INSERT INTO `users` VALUES (46, 'LIANI, S.Pi', 'liani176@yahoo.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'LIANI,S.Pi', '00:00:00');
INSERT INTO `users` VALUES (48, 'DEDE ALMUSTAQIM, S.Kom', 'dede.almustaqim.dev@gmail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'DEDEALMUSTAQIM,S.Kom', '00:00:00');
INSERT INTO `users` VALUES (49, 'MUJIONO', 'mujiono.bapp.bartim@gmail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'MUJIONO', '00:00:00');
INSERT INTO `users` VALUES (50, 'ELIANA, S.Pi', 'eliana140776@gmail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'ELIANA,S.Pi', '00:00:00');
INSERT INTO `users` VALUES (51, 'HEWU YUSLITA', 'liangtirta25@gmail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'HEWUYUSLITA', '00:00:00');
INSERT INTO `users` VALUES (52, 'PRILLYCIA NATALIA DRIPPI', 'rillynatalia@gmail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'PRILLYCIANATALIADRIPPI', '00:00:00');
INSERT INTO `users` VALUES (54, 'YUSNITA', 'noemail1@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'YUSNITA', '00:00:00');
INSERT INTO `users` VALUES (55, 'YULIANA', 'noemail2@noemail.com2', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'YULIANA', '00:00:00');
INSERT INTO `users` VALUES (56, 'KRISTIANA', 'noemail3@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'KRISTIANA', '00:00:00');
INSERT INTO `users` VALUES (57, 'TUTLUGADI', 'noemail4@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'TUTLUGADI', '00:00:00');
INSERT INTO `users` VALUES (58, 'YETO', 'noemail5@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 3, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'YETO', '00:00:00');
INSERT INTO `users` VALUES (64, 'Drs. DWI ARYANTO', 'noemail6wewe@noemail.com', '2024-01-11 13:13:40', '6213052705660001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-26 11:13:25', '2024-01-26 11:13:25', '196605271992031007', 5, 'KEPALA DINAS', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213052705660001', '00:00:00');
INSERT INTO `users` VALUES (65, 'LIMER, S.Pd.,MM', 'noemail7@noemail.com', '2024-01-11 13:13:40', '6213010405700001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197005041997031009', 5, 'SEKRETARIS DINAS', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010405700001', '00:00:00');
INSERT INTO `users` VALUES (66, 'FREDISEN MADIANU, S.Kom', 'fredisen.madianu@baritotimurkab.go.id', '2024-01-11 13:13:40', '6213022707860001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198607272011011016', 5, 'KABID PENYELENGGARAAN E-GOVERNMENT', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213022707860001', '00:00:00');
INSERT INTO `users` VALUES (69, 'ARI OPU PAHANDRIAN MIGANG, ST', 'noemail34344@noemail.com', '2024-01-11 13:13:40', '6371041808840002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198408182010011022', 5, 'KABID PERSANDIAN DAN STATISTIK', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6371041808840002', '00:00:00');
INSERT INTO `users` VALUES (70, 'WAYAN CAKRE, S.IP', 'noemail222@noemail.com', '2024-01-11 13:13:40', '6213011009780001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197809102010011020', 5, 'KABID INFORMASI DAN KOMUNIKASI PUBLIK', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213011009780001', '00:00:00');
INSERT INTO `users` VALUES (71, 'ELLY, S.Sos', 'noemail8@noemail.com', '2024-01-11 13:13:40', '6213010301660001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '196601031988031016', 5, 'PRANATA HUMAS AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213010301660001', '00:00:00');
INSERT INTO `users` VALUES (72, 'LESLY, S.Sos', 'noemail9@noemail.com', '2024-01-11 13:13:40', '6213017011750002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197511302006042017', 5, 'KASUBAG UMUM DAN KEPEGAWAIAN', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213017011750002', '00:00:00');
INSERT INTO `users` VALUES (73, 'YULIANI, S.AP', 'noemail10@noemail.com', '2024-01-11 13:13:40', '6213015407760001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197607142007012017', 5, 'KASUBAG KEUANGAN DAN PERENCANAAN', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015407760001', '00:00:00');
INSERT INTO `users` VALUES (74, 'MAPRIYATNO,S.Kom., M.Si', 'noemail11@noemail.com', '2024-01-11 13:13:40', '6213011004820001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198204102009031001', 5, 'PRANATA KOMPUTER AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213011004820001', '00:00:00');
INSERT INTO `users` VALUES (75, 'FRISCIA ANTHONY, ST', 'noemail12@noemail.com', '2024-01-11 13:13:40', '6213021703830001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198303172011011009', 5, 'PRANATA KOMPUTER AHLI MUDA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213021703830001', '00:00:00');
INSERT INTO `users` VALUES (76, 'BENNY AGUS SURYADI PURBA, S.Kom', 'noemail13@noemail.com', '2024-01-11 13:13:40', '6204061708810004', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198108172010011027', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6204061708810004', '00:00:00');
INSERT INTO `users` VALUES (77, 'THERESIA LIA DEWI WULANDARI, S.Sos', 'noemail14@noemail.com', '2024-01-11 13:13:40', '6213014310840002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198410032011012007', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213014310840002', '00:00:00');
INSERT INTO `users` VALUES (78, 'FREDY DAYA LELUNO, S.S', 'noemail15@noemail.com', '2024-01-11 13:13:40', '6271033107870001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198707312011011003', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6271033107870001', '00:00:00');
INSERT INTO `users` VALUES (79, 'SUSI SUSANTI .D, ST', 'noemail16@noemail.com', '2024-01-11 13:13:40', '6204064805900008', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '199005082015032003', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6204064805900008', '00:00:00');
INSERT INTO `users` VALUES (80, 'HADRIANO, S.I.P', 'noemail17@noemail.com', '2024-01-11 13:13:40', '6213011202780002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197802122006041017', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213011202780002', '00:00:00');
INSERT INTO `users` VALUES (81, 'INDAYANI, S.AP', 'noemail18@noemail.com', '2024-01-11 13:13:40', '6213015512710001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197112152007012012', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213015512710001', '00:00:00');
INSERT INTO `users` VALUES (82, 'M.YUDHA MAULANA ,S.Kom', 'noemail19@noemail.com', '2024-01-11 13:13:40', '6372022510890006', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198910252020121012', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6372022510890006', '00:00:00');
INSERT INTO `users` VALUES (83, 'ZULKIFLI', 'noemail20@noemail.com', '2024-01-11 13:13:40', '6213022001840001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198401202007011002', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213022001840001', '00:00:00');
INSERT INTO `users` VALUES (84, 'SULIDIA EKA SETIANO', 'noemail21@noemail.com', '2024-01-11 13:13:40', '6213020305760001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '197605032009011002', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213020305760001', '00:00:00');
INSERT INTO `users` VALUES (85, 'PANTERLIHAT', 'noemail22@noemail.com', '2024-01-11 13:13:40', '6213022505810001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198105252009011002', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213022505810001', '00:00:00');
INSERT INTO `users` VALUES (86, 'MUHAMMAD  SAMSUDIN', 'noemail23@noemail.com', '2024-01-11 13:13:40', '6213020401830001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '198301042007011002', 5, 'PELAKSANA', 'https://i.ibb.co/S32HNjD/no-image.jpg', '6213020401830001', '00:00:00');
INSERT INTO `users` VALUES (87, 'LASANO', 'noemail24@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'LASANO', '00:00:00');
INSERT INTO `users` VALUES (88, 'HERRY.R, S.Kom', 'noemail25@noemail.com', '2024-01-11 13:13:40', '6213020408930001', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'HERRY.R,S.Kom', '00:00:00');
INSERT INTO `users` VALUES (89, 'MUHAMMAD AZWAR RUDINI, S.AP', 'noemail26@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'MUHAMMADAZWARRUDINI,S.AP', '00:00:00');
INSERT INTO `users` VALUES (90, 'NURHIDAYATI', 'noemail27@noemail.com', '2024-01-11 13:13:40', '6213014210890002', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'NURHIDAYATI', '00:00:00');
INSERT INTO `users` VALUES (91, 'WINDA YULIANTI ', 'noemail28@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'WINDAYULIANTI', '00:00:00');
INSERT INTO `users` VALUES (92, 'MARIANIE A. R.', 'noemail29@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'MARIANIEA.R.', '00:00:00');
INSERT INTO `users` VALUES (94, 'IRARIANI', 'noemail294343@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'IRARIANI', '00:00:00');
INSERT INTO `users` VALUES (95, 'KARINTO', 'noemail30@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'KARINTO', '00:00:00');
INSERT INTO `users` VALUES (96, 'HARTONI', 'noemail31@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'HARTONI', '00:00:00');
INSERT INTO `users` VALUES (97, 'BRIANTO SANDRY', 'noemail32@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'BRIANTOSANDRY', '00:00:00');
INSERT INTO `users` VALUES (98, 'ZULKIFLI', 'noemail33@noemail.com', '2024-01-11 13:13:40', '-', '$2y$10$4gVQ13ggIOeKXqpLzJWbnum/hoJ5PZrsEmU773wzW7DBTF2QetTrO', '', '2024-01-11 13:13:40', '2024-01-11 13:13:40', '-', 5, 'NON ASN', 'https://i.ibb.co/S32HNjD/no-image.jpg', 'ZULKIFLI', '00:00:00');

-- ----------------------------
-- Event structure for qr_refresh
-- ----------------------------
DROP EVENT IF EXISTS `qr_refresh`;
delimiter ;;
CREATE EVENT `qr_refresh`
ON SCHEDULE
EVERY '10' SECOND STARTS '2023-04-08 15:05:42'
DO UPDATE tbl_unit SET qr_in = SUBSTR(MD5(RAND()), 1, 10), qr_in = SUBSTR(MD5(RAND()), 1, 10), qr_out = SUBSTR(MD5(RAND()), 1, 10), qr_out = SUBSTR(MD5(RAND()), 1, 10)
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
