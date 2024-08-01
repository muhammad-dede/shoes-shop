/*
 Navicat Premium Data Transfer

 Source Server         : MySql Local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : shoes_shop

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 01/08/2024 15:03:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bank_account
-- ----------------------------
DROP TABLE IF EXISTS `bank_account`;
CREATE TABLE `bank_account`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bank_account
-- ----------------------------
INSERT INTO `bank_account` VALUES (1, 'SRINATIN', '3890645720', 'BCA');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES (1, 'nike', 'Nike', 'nike.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (2, 'adidas', 'Adidas', 'adidas.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (3, 'converse', 'Converse', 'converse.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (4, 'vans', 'Vans', 'vans.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (5, 'puma', 'Puma', 'puma.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (6, 'new-balance', 'New Balance', 'new-balance.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (7, 'reebok', 'Reebok', 'reebok.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (8, 'asics', 'Asics', 'asics.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (9, 'diadora', 'Diadora', 'diadora.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `brand` VALUES (10, 'under-armour', 'Under Armour', 'under-armour.png', '2024-07-23 15:36:23', '2024-07-23 15:36:23');

-- ----------------------------
-- Table structure for cart
-- ----------------------------
DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint UNSIGNED NULL DEFAULT NULL,
  `id_product` bigint UNSIGNED NULL DEFAULT NULL,
  `id_product_variant` bigint UNSIGNED NULL DEFAULT NULL,
  `qty` double NULL DEFAULT 0,
  `sub_total` double NULL DEFAULT 0,
  `weight` double NULL DEFAULT 0,
  `discount` double NULL DEFAULT 0,
  `total` double NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `cart_id_user_index`(`id_user` ASC) USING BTREE,
  INDEX `cart_id_product_index`(`id_product` ASC) USING BTREE,
  INDEX `cart_id_product_variant_index`(`id_product_variant` ASC) USING BTREE,
  CONSTRAINT `cart_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cart_id_product_variant_foreign` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `cart_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cart
-- ----------------------------

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, 'new-balance-990-series', 'New Balance 990 Series', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `category` VALUES (2, 'new-balance-327-series', 'New Balance 327 Series', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `category` VALUES (3, 'dunk', 'Dunk', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `category` VALUES (4, 'adidas-samba', 'Adidas Samba', '2024-07-23 15:36:23', '2024-07-23 15:36:23');
INSERT INTO `category` VALUES (5, 'adidas-gazelle', 'Adidas Gazelle', '2024-07-23 15:36:23', '2024-07-23 15:36:23');

-- ----------------------------
-- Table structure for courier
-- ----------------------------
DROP TABLE IF EXISTS `courier`;
CREATE TABLE `courier`  (
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`code`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of courier
-- ----------------------------
INSERT INTO `courier` VALUES ('jne', 'Jalur Nugraha Ekakurir (JNE)', 'jne.png');
INSERT INTO `courier` VALUES ('pos', 'POS Indonesia (POS)', 'pos.png');
INSERT INTO `courier` VALUES ('tiki', 'Citra Van Titipan Kilat (TIKI)', 'tiki.png');

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
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2013_07_23_035652_create_courier_table', 1);
INSERT INTO `migrations` VALUES (2, '2013_07_23_035652_create_status_table', 1);
INSERT INTO `migrations` VALUES (3, '2013_07_24_090241_create_bank_account_table', 1);
INSERT INTO `migrations` VALUES (4, '2014_10_12_000000_create_user_table', 1);
INSERT INTO `migrations` VALUES (5, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (8, '2023_06_23_035016_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (9, '2024_07_01_035556_create_user_address_table', 1);
INSERT INTO `migrations` VALUES (10, '2024_07_22_035731_create_brand_table', 1);
INSERT INTO `migrations` VALUES (11, '2024_07_23_035650_create_category_table', 1);
INSERT INTO `migrations` VALUES (12, '2024_07_23_035745_create_product_table', 1);
INSERT INTO `migrations` VALUES (13, '2024_07_23_035748_create_product_variant_table', 1);
INSERT INTO `migrations` VALUES (14, '2024_07_23_043020_create_cart_table', 1);
INSERT INTO `migrations` VALUES (15, '2024_07_23_043033_create_order_table', 1);
INSERT INTO `migrations` VALUES (16, '2024_07_23_072239_create_order_item_table', 1);
INSERT INTO `migrations` VALUES (17, '2024_07_24_090034_create_order_shipping_table', 1);
INSERT INTO `migrations` VALUES (18, '2024_07_24_090035_create_order_payment_table', 1);
INSERT INTO `migrations` VALUES (19, '2024_08_01_142148_create_wishlist_table', 1);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\User', 3);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `no_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint UNSIGNED NULL DEFAULT NULL,
  `id_user_address` bigint UNSIGNED NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `total_price` double NULL DEFAULT 0,
  `total_weight` double NULL DEFAULT 0,
  `discount_amount` double NULL DEFAULT 0,
  `shipping_cost` double NULL DEFAULT 0,
  `payment_amount` double NULL DEFAULT 0,
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `receipt_date` date NULL DEFAULT NULL,
  `id_status` bigint UNSIGNED NULL DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `order_no_order_unique`(`no_order` ASC) USING BTREE,
  INDEX `order_id_user_index`(`id_user` ASC) USING BTREE,
  INDEX `order_id_user_address_index`(`id_user_address` ASC) USING BTREE,
  INDEX `order_id_status_index`(`id_status` ASC) USING BTREE,
  CONSTRAINT `order_id_status_foreign` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `order_id_user_address_foreign` FOREIGN KEY (`id_user_address`) REFERENCES `user_address` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `order_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_item
-- ----------------------------
DROP TABLE IF EXISTS `order_item`;
CREATE TABLE `order_item`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_order` bigint UNSIGNED NULL DEFAULT NULL,
  `id_product` bigint UNSIGNED NULL DEFAULT NULL,
  `id_product_variant` bigint UNSIGNED NULL DEFAULT NULL,
  `qty` double NULL DEFAULT 0,
  `sub_total` double NULL DEFAULT 0,
  `weight` double NULL DEFAULT 0,
  `discount` double NULL DEFAULT 0,
  `total` double NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_item_id_order_index`(`id_order` ASC) USING BTREE,
  INDEX `order_item_id_product_index`(`id_product` ASC) USING BTREE,
  INDEX `order_item_id_product_variant_index`(`id_product_variant` ASC) USING BTREE,
  CONSTRAINT `order_item_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_item_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `order_item_id_product_variant_foreign` FOREIGN KEY (`id_product_variant`) REFERENCES `product_variant` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_item
-- ----------------------------

-- ----------------------------
-- Table structure for order_payment
-- ----------------------------
DROP TABLE IF EXISTS `order_payment`;
CREATE TABLE `order_payment`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_order` bigint UNSIGNED NULL DEFAULT NULL,
  `id_bank_account` bigint UNSIGNED NULL DEFAULT NULL,
  `transfer_date` date NULL DEFAULT NULL,
  `account_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `account_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `bank_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `transfer_receipt` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_payment_id_order_index`(`id_order` ASC) USING BTREE,
  INDEX `order_payment_id_bank_account_index`(`id_bank_account` ASC) USING BTREE,
  CONSTRAINT `order_payment_id_bank_account_foreign` FOREIGN KEY (`id_bank_account`) REFERENCES `bank_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_payment_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_payment
-- ----------------------------

-- ----------------------------
-- Table structure for order_shipping
-- ----------------------------
DROP TABLE IF EXISTS `order_shipping`;
CREATE TABLE `order_shipping`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_order` bigint UNSIGNED NULL DEFAULT NULL,
  `code_courier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `etd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cost` double NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_shipping_id_order_index`(`id_order` ASC) USING BTREE,
  INDEX `order_shipping_code_courier_index`(`code_courier` ASC) USING BTREE,
  CONSTRAINT `order_shipping_code_courier_foreign` FOREIGN KEY (`code_courier`) REFERENCES `courier` (`code`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `order_shipping_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_shipping
-- ----------------------------

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'auth-user', 'web', '2024-08-01 15:01:30', '2024-08-01 15:01:30');
INSERT INTO `permissions` VALUES (2, 'auth-admin', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (3, 'admin-user', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (4, 'admin-brand', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (5, 'admin-type', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (6, 'admin-size', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (7, 'admin-product', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (8, 'user-cart', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (9, 'user-order', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `permissions` VALUES (10, 'admin-order', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token` ASC) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type` ASC, `tokenable_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_brand` bigint UNSIGNED NULL DEFAULT NULL,
  `id_category` bigint UNSIGNED NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `weight` double NULL DEFAULT 0 COMMENT 'gram',
  `price` double NULL DEFAULT 0,
  `discount` double NULL DEFAULT 0,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `image_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `published` tinyint(1) NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_id_brand_index`(`id_brand` ASC) USING BTREE,
  INDEX `product_id_category_index`(`id_category` ASC) USING BTREE,
  CONSTRAINT `product_id_brand_foreign` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `product_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES (1, 6, 1, 'new-balance-990-v1-carhartt-wip-dark-navy', 'New Balance 990 V1 Carhartt WIP Dark Navy', 3000, 4000000, 0, NULL, 'nb-1.jpg', 'nb-2.jpg', NULL, 1, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product` VALUES (2, 6, 2, 'new-balance-327-moonbeam-white-black-gum-womens', 'New Balance 327 Moonbeam White Black Gum Womens', 2000, 1800000, 0, NULL, 'nb-3.jpg', 'nb-4.jpg', NULL, 1, '2024-07-25 16:36:23', '2024-07-25 16:36:23');
INSERT INTO `product` VALUES (3, 1, 3, 'dunk-low-phantom-light-silver-gs', 'Dunk Low Phantom Light Silver GS', 2000, 1500000, 0, NULL, 'nike-1.jpg', 'nike-2.jpg', NULL, 1, '2024-07-25 16:36:23', '2024-07-25 16:36:23');
INSERT INTO `product` VALUES (4, 1, 3, 'dunk-low-team-green', 'Dunk Low Team Green', 3000, 2400000, 0, NULL, 'nike-3.jpg', 'nike-4.jpg', NULL, 1, '2024-07-25 16:36:23', '2024-07-25 16:36:23');
INSERT INTO `product` VALUES (5, 2, 4, 'adidas-samba-cream-white-preloved-brown', 'Adidas Samba Cream White Preloved Brown', 2000, 2500000, 0, NULL, 'adidas-1.jpg', 'adidas-2.jpg', NULL, 1, '2024-07-25 16:36:23', '2024-07-25 16:36:23');
INSERT INTO `product` VALUES (6, 2, 5, 'adidas-gazelle-indoor-turquoise-chalk', 'Adidas Gazelle Indoor Turquoise Chalk', 2000, 2600000, 0, NULL, 'adidas-3.jpg', 'adidas-4.jpg', NULL, 1, '2024-07-25 16:36:23', '2024-07-25 16:36:23');

-- ----------------------------
-- Table structure for product_variant
-- ----------------------------
DROP TABLE IF EXISTS `product_variant`;
CREATE TABLE `product_variant`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_product` bigint UNSIGNED NULL DEFAULT NULL,
  `size` double NULL DEFAULT 0,
  `qty` double NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `product_variant_id_product_index`(`id_product` ASC) USING BTREE,
  CONSTRAINT `product_variant_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_variant
-- ----------------------------
INSERT INTO `product_variant` VALUES (1, 1, 42, 2, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (2, 1, 43, 6, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (3, 1, 44, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (4, 2, 38, 4, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (5, 2, 39, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (6, 3, 36, 1, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (7, 3, 37, 4, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (8, 3, 38, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (9, 3, 39, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (10, 4, 40, 2, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (11, 4, 41, 1, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (12, 4, 42, 5, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (13, 4, 43, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (14, 4, 44, 2, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (15, 5, 36, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (16, 5, 37, 2, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (17, 5, 38, 2, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (18, 5, 39, 1, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (19, 5, 40, 5, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (20, 6, 36, 4, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (21, 6, 37, 2, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (22, 6, 38, 3, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (23, 6, 39, 1, '2024-07-25 15:36:23', '2024-07-25 15:36:23');
INSERT INTO `product_variant` VALUES (24, 6, 40, 4, '2024-07-25 15:36:23', '2024-07-25 15:36:23');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (4, 2);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (6, 2);
INSERT INTO `role_has_permissions` VALUES (7, 2);
INSERT INTO `role_has_permissions` VALUES (10, 2);
INSERT INTO `role_has_permissions` VALUES (1, 3);
INSERT INTO `role_has_permissions` VALUES (8, 3);
INSERT INTO `role_has_permissions` VALUES (9, 3);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Super Admin', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `roles` VALUES (2, 'Admin', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `roles` VALUES (3, 'User', 'web', '2024-08-01 15:01:31', '2024-08-01 15:01:31');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status`  (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES (1, 'Menunggu Pembayaran', 'Kamu belum melakukan pembayaran.');
INSERT INTO `status` VALUES (2, 'Menunggu Konfirmasi', 'Pembayaran telah terverifikasi, menunggu Admin mengkonfirmasi pesanan.');
INSERT INTO `status` VALUES (3, 'Pesanan Diproses', 'Admin telah menerima pesanan, orderan kamu dalam tahap pengemasan.');
INSERT INTO `status` VALUES (4, 'Pesanan Dikirim', 'Pesanan kamu dalam pengiriman oleh jasa kurir.');
INSERT INTO `status` VALUES (6, 'Pesanan Selesai', 'Kamu telah melakukan konfirmasi barang diterima.');
INSERT INTO `status` VALUES (7, 'Pesanan Dibatalkan', 'Pesanan kamu telah dibatalkan karena alasan tertentu.');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `user_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Super Admin', 'super.admin@email.com', '2024-08-01 15:01:31', '$2y$10$1yBe1AvCQU1I6MGxT5QoaeqYplJxxZCEYBE.ZXgtdsSNwEvluxDoq', NULL, '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `user` VALUES (2, 'Admin', 'admin@email.com', '2024-08-01 15:01:31', '$2y$10$yn4u3tjju0i59H82tJ5c/.SNUmGerI1gDaDo7baG.D16m7BLO2wHO', NULL, '2024-08-01 15:01:31', '2024-08-01 15:01:31');
INSERT INTO `user` VALUES (3, 'User', 'user@email.com', '2024-08-01 15:01:31', '$2y$10$f08o8Q6JVZbP8ZHxG1K8f.CIjklAxpE.Go67a0GFCGBarqzclOYBa', NULL, '2024-08-01 15:01:31', '2024-08-01 15:01:31');

-- ----------------------------
-- Table structure for user_address
-- ----------------------------
DROP TABLE IF EXISTS `user_address`;
CREATE TABLE `user_address`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint UNSIGNED NULL DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_province` bigint UNSIGNED NULL DEFAULT NULL,
  `id_city` bigint UNSIGNED NULL DEFAULT NULL,
  `street_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `default` tinyint(1) NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_address_id_user_index`(`id_user` ASC) USING BTREE,
  CONSTRAINT `user_address_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_address
-- ----------------------------

-- ----------------------------
-- Table structure for wishlist
-- ----------------------------
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_user` bigint UNSIGNED NULL DEFAULT NULL,
  `id_product` bigint UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `wishlist_id_user_index`(`id_user` ASC) USING BTREE,
  INDEX `wishlist_id_product_index`(`id_product` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wishlist
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
