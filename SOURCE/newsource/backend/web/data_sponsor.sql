/*
Navicat MySQL Data Transfer

Source Server         : data_sponsor_252
Source Server Version : 50627
Source Host           : 192.168.146.252:3307
Source Database       : data_sponsor

Target Server Type    : MYSQL
Target Server Version : 50627
File Encoding         : 65001

Date: 2017-07-14 15:07:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên chức năng cha',
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ID user',
  `created_at` int(11) DEFAULT NULL COMMENT 'Thời gian tạo',
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('admin', '13', '1476267702');
INSERT INTO `auth_assignment` VALUES ('admin', '64', '1495186503');
INSERT INTO `auth_assignment` VALUES ('admin-metadata', '13', '1498131048');
INSERT INTO `auth_assignment` VALUES ('admin-metadata', '64', '1495186503');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '16', '1489147377');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '18', '1489474496');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '20', '1489474502');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '22', '1489474505');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '24', '1489474517');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '26', '1489474519');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '28', '1489474523');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '30', '1489474551');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '32', '1489474557');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '34', '1489474561');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '36', '1489474565');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '38', '1489474569');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '40', '1489474572');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '42', '1489474575');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '46', '1489474580');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '48', '1489474584');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '50', '1489474586');
INSERT INTO `auth_assignment` VALUES ('apv-videoclip', '64', '1495186503');
INSERT INTO `auth_assignment` VALUES ('bao-cao-thong-ke', '13', '1498131050');
INSERT INTO `auth_assignment` VALUES ('bao-cao-thong-ke', '14', '1489063143');
INSERT INTO `auth_assignment` VALUES ('bao-cao-thong-ke', '44', '1497346977');
INSERT INTO `auth_assignment` VALUES ('bao-cao-thong-ke', '63', '1492077327');
INSERT INTO `auth_assignment` VALUES ('bao-cao-thong-ke', '64', '1495186503');
INSERT INTO `auth_assignment` VALUES ('bao-cao-thong-ke', '65', '1498446930');
INSERT INTO `auth_assignment` VALUES ('cp-film-series', '14', '1489063143');
INSERT INTO `auth_assignment` VALUES ('cp-film-series', '63', '1492077327');
INSERT INTO `auth_assignment` VALUES ('cp-film-series', '64', '1495186503');
INSERT INTO `auth_assignment` VALUES ('cp-metadata', '14', '1489483431');
INSERT INTO `auth_assignment` VALUES ('cp-metadata', '63', '1492077327');
INSERT INTO `auth_assignment` VALUES ('cp-metadata', '64', '1495186504');
INSERT INTO `auth_assignment` VALUES ('cp-videoclip', '63', '1492077327');
INSERT INTO `auth_assignment` VALUES ('cp-videoclip', '64', '1495186504');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên chức năng',
  `type` int(11) NOT NULL COMMENT 'Loại: - 1: chức năng cha - 2: chức năng con',
  `description` text COLLATE utf8_unicode_ci COMMENT 'Mô tả ',
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Chưa sử dụng',
  `data` text COLLATE utf8_unicode_ci COMMENT 'Chưa sử dụng',
  `created_at` int(11) DEFAULT NULL COMMENT 'Thời gian tạo',
  `updated_at` int(11) DEFAULT NULL COMMENT 'Thời gian cập nhật',
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/admin/*', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/assignment/*', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/assignment/assign', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1476267609', '1476267609');
INSERT INTO `auth_item` VALUES ('/admin/assignment/revoke', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/assignment/view', '2', null, null, null, '1476267609', '1476267609');
INSERT INTO `auth_item` VALUES ('/admin/default/*', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/default/index', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/menu/create', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/menu/delete', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/menu/update', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/menu/view', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/*', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/assign', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/create', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/delete', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/index', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/remove', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/update', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/permission/view', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/*', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/assign', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/create', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/delete', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/index', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/remove', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/update', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/role/view', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/route/*', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/route/assign', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/route/create', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/route/index', '2', null, null, null, '1476267610', '1476267610');
INSERT INTO `auth_item` VALUES ('/admin/route/refresh', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/route/remove', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/rule/*', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/rule/create', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/rule/delete', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/rule/index', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/rule/update', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/rule/view', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/*', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/activate', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/change-password', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/delete', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/index', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/login', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/logout', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/request-password-reset', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/reset-password', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/signup', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/admin/user/view', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/api-client/*', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/api-client/create', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/api-client/delete', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/api-client/index', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/api-client/update', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/api-client/view', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/app/*', '2', null, null, null, '1476267619', '1476267619');
INSERT INTO `auth_item` VALUES ('/campaign-history/*', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/campaign-history/create', '2', null, null, null, '1495275247', '1495275247');
INSERT INTO `auth_item` VALUES ('/campaign-history/delete', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/campaign-history/index', '2', null, null, null, '1495275246', '1495275246');
INSERT INTO `auth_item` VALUES ('/campaign-history/update', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/campaign-history/view', '2', null, null, null, '1495275247', '1495275247');
INSERT INTO `auth_item` VALUES ('/campaign-website/*', '2', null, null, null, '1496025791', '1496025791');
INSERT INTO `auth_item` VALUES ('/campaign-website/create', '2', null, null, null, '1496025791', '1496025791');
INSERT INTO `auth_item` VALUES ('/campaign-website/delete', '2', null, null, null, '1496025791', '1496025791');
INSERT INTO `auth_item` VALUES ('/campaign-website/index', '2', null, null, null, '1496025790', '1496025790');
INSERT INTO `auth_item` VALUES ('/campaign-website/update', '2', null, null, null, '1496025791', '1496025791');
INSERT INTO `auth_item` VALUES ('/campaign-website/view', '2', null, null, null, '1496025791', '1496025791');
INSERT INTO `auth_item` VALUES ('/campaign/*', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/campaign/create', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/campaign/delete', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/campaign/index', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/campaign/update', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/campaign/view', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor-cp/*', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor-cp/create', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor-cp/delete', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor-cp/index', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor-cp/update', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor-cp/view', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/*', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/create', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/delete', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/delete-multiple', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/index', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/update', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/update-status', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-attr-actor/view', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-category-cp/*', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-category-cp/create', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-category-cp/delete', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-category-cp/index', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-category-cp/update', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-category-cp/view', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-category/*', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-attr-category/create', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-attr-category/delete', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-attr-category/index', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-attr-category/update', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-attr-category/view', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer-cp/*', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer-cp/create', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer-cp/delete', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer-cp/index', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer-cp/update', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer-cp/view', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer/*', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer/create', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer/delete', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer/index', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer/update', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-composer/view', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-director-cp/*', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-director-cp/create', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-director-cp/delete', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-director-cp/index', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-director-cp/update', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-director-cp/view', '2', null, null, null, '1492484516', '1492484516');
INSERT INTO `auth_item` VALUES ('/csm-attr-director/*', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-director/create', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-director/delete', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-director/index', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-director/update', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-director/view', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-cp/*', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-cp/create', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-cp/delete', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-cp/index', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-cp/update', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-cp/view', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series-cp/*', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series-cp/create', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series-cp/delete', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series-cp/index', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series-cp/update', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series-cp/view', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film-series/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film/index', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-film/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-film/view', '2', null, null, null, '1489056565', '1489056565');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer-cp/*', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer-cp/create', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer-cp/delete', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer-cp/index', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer-cp/update', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer-cp/view', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-singer/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-cp/*', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-cp/create', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-cp/delete', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-cp/index', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-cp/update', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-cp/view', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series-cp/*', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series-cp/create', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series-cp/delete', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series-cp/index', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series-cp/update', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series-cp/view', '2', null, null, null, '1492484517', '1492484517');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show-series/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attr-tv-show/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-attribute-type/*', '2', null, null, null, '1479788181', '1479788181');
INSERT INTO `auth_item` VALUES ('/csm-attribute-type/create', '2', null, null, null, '1479788181', '1479788181');
INSERT INTO `auth_item` VALUES ('/csm-attribute-type/delete', '2', null, null, null, '1479788181', '1479788181');
INSERT INTO `auth_item` VALUES ('/csm-attribute-type/index', '2', null, null, null, '1479788181', '1479788181');
INSERT INTO `auth_item` VALUES ('/csm-attribute-type/update', '2', null, null, null, '1479788181', '1479788181');
INSERT INTO `auth_item` VALUES ('/csm-attribute-type/view', '2', null, null, null, '1479788181', '1479788181');
INSERT INTO `auth_item` VALUES ('/csm-attribute/*', '2', null, null, null, '1480471522', '1480471522');
INSERT INTO `auth_item` VALUES ('/csm-attribute/create', '2', null, null, null, '1480471520', '1480471520');
INSERT INTO `auth_item` VALUES ('/csm-attribute/delete', '2', null, null, null, '1480471521', '1480471521');
INSERT INTO `auth_item` VALUES ('/csm-attribute/index', '2', null, null, null, '1480471519', '1480471519');
INSERT INTO `auth_item` VALUES ('/csm-attribute/s-upload', '2', null, null, null, '1480471518', '1480471518');
INSERT INTO `auth_item` VALUES ('/csm-attribute/update', '2', null, null, null, '1480471521', '1480471521');
INSERT INTO `auth_item` VALUES ('/csm-attribute/view', '2', null, null, null, '1480471520', '1480471520');
INSERT INTO `auth_item` VALUES ('/csm-cp/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-cp/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-cp/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-cp/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-cp/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-cp/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/*', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/delete', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/delete-multiple', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/index', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/update', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/update-status', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-approve/view', '2', null, null, null, '1489143238', '1489143238');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/*', '2', null, null, null, '1489399108', '1489399108');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/create', '2', null, null, null, '1489399108', '1489399108');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/delete', '2', null, null, null, '1489399108', '1489399108');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/index', '2', null, null, null, '1489399108', '1489399108');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/update', '2', null, null, null, '1489399108', '1489399108');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/update-status', '2', null, null, null, '1495251507', '1495251507');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-crawler-approve/view', '2', null, null, null, '1489399108', '1489399108');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/*', '2', null, null, null, '1482947684', '1482947684');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/create', '2', null, null, null, '1482947684', '1482947684');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/delete', '2', null, null, null, '1482947684', '1482947684');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/delete-multiple', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/index', '2', null, null, null, '1482947684', '1482947684');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/update', '2', null, null, null, '1482947684', '1482947684');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/update-status', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-clip-create/view', '2', null, null, null, '1482947684', '1482947684');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/delete-multiple', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/update-status', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-create/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/*', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/create', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/delete', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/delete-multiple', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/index', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/published-for', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/update', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/update-status', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media-film-series-create/view', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/csm-media/*', '2', null, null, null, '1480566579', '1480566579');
INSERT INTO `auth_item` VALUES ('/csm-media/create', '2', null, null, null, '1480566579', '1480566579');
INSERT INTO `auth_item` VALUES ('/csm-media/delete', '2', null, null, null, '1480566579', '1480566579');
INSERT INTO `auth_item` VALUES ('/csm-media/index', '2', null, null, null, '1480566578', '1480566578');
INSERT INTO `auth_item` VALUES ('/csm-media/update', '2', null, null, null, '1480566579', '1480566579');
INSERT INTO `auth_item` VALUES ('/csm-media/view', '2', null, null, null, '1480566579', '1480566579');
INSERT INTO `auth_item` VALUES ('/debug/*', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/debug/default/*', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/debug/default/db-explain', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/debug/default/download-mail', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/debug/default/toolbar', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/debug/default/view', '2', null, null, null, '1476267611', '1476267611');
INSERT INTO `auth_item` VALUES ('/gii/*', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/gii/default/*', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/gii/default/action', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/gii/default/diff', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/gii/default/preview', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/gii/default/view', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/log-data-query/*', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/log-data-query/create', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/log-data-query/delete', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/log-data-query/index', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/log-data-query/update', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/log-data-query/view', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/menu/*', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/menu/create', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/menu/delete', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/menu/index', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/menu/s-upload', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/menu/update', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/menu/view', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/partner-new/*', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner-new/create', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner-new/delete', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner-new/index', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner-new/update', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner-new/view', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner/*', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner/create', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner/delete', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner/index', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner/update', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/partner/view', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/report-campaign-daily/*', '2', null, null, null, '1495264056', '1495264056');
INSERT INTO `auth_item` VALUES ('/report-campaign-daily/create', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/report-campaign-daily/delete', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/report-campaign-daily/index', '2', null, null, null, '1495264056', '1495264056');
INSERT INTO `auth_item` VALUES ('/report-campaign-daily/update', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/report-campaign-daily/view', '2', null, null, null, '1495275248', '1495275248');
INSERT INTO `auth_item` VALUES ('/site/*', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/site/captcha', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/site/error', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/site/get-clients', '2', null, null, null, '1489056566', '1489056566');
INSERT INTO `auth_item` VALUES ('/site/index', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/site/login', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/site/logout', '2', null, null, null, '1476267612', '1476267612');
INSERT INTO `auth_item` VALUES ('/site/reset-password', '2', null, null, null, '1476353688', '1476353688');
INSERT INTO `auth_item` VALUES ('/sys-config/*', '2', null, null, null, '1495263324', '1495263324');
INSERT INTO `auth_item` VALUES ('/sys-config/create', '2', null, null, null, '1495263324', '1495263324');
INSERT INTO `auth_item` VALUES ('/sys-config/delete', '2', null, null, null, '1495263324', '1495263324');
INSERT INTO `auth_item` VALUES ('/sys-config/index', '2', null, null, null, '1495263323', '1495263323');
INSERT INTO `auth_item` VALUES ('/sys-config/update', '2', null, null, null, '1495263324', '1495263324');
INSERT INTO `auth_item` VALUES ('/sys-config/view', '2', null, null, null, '1495263324', '1495263324');
INSERT INTO `auth_item` VALUES ('/upload/*', '2', null, null, null, '1482947675', '1482947675');
INSERT INTO `auth_item` VALUES ('/upload/image-upload', '2', null, null, null, '1482947675', '1482947675');
INSERT INTO `auth_item` VALUES ('/upload/video-upload', '2', null, null, null, '1482947674', '1482947674');
INSERT INTO `auth_item` VALUES ('/user/*', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('/user/change', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('/user/change-password', '2', null, null, null, '1476354922', '1476354922');
INSERT INTO `auth_item` VALUES ('/user/create', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('/user/delete', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('/user/index', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('/user/update', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('/user/view', '2', null, null, null, '1476341215', '1476341215');
INSERT INTO `auth_item` VALUES ('admin', '1', null, null, null, '1476267663', '1476267663');
INSERT INTO `auth_item` VALUES ('admin-metadata', '1', 'admin-metadata', null, null, '1492486026', '1492486164');
INSERT INTO `auth_item` VALUES ('apv-videoclip', '1', 'apv-videoclip', null, null, '1489147257', '1489147257');
INSERT INTO `auth_item` VALUES ('bao-cao-thong-ke', '1', 'báo cáo thống kê', null, null, '1489060556', '1497347026');
INSERT INTO `auth_item` VALUES ('cp-film-series', '1', 'cp-film-series', null, null, '1489060603', '1489060603');
INSERT INTO `auth_item` VALUES ('cp-metadata', '1', 'cp-metadata', null, null, '1489060651', '1489060651');
INSERT INTO `auth_item` VALUES ('cp-videoclip', '1', 'cp-videoclip', null, null, '1489056947', '1489056947');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chức năng cha',
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Chức năng con',
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/assignment/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/assignment/assign');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/assignment/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/assignment/revoke');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/assignment/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/default/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/default/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/menu/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/menu/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/menu/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/menu/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/menu/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/menu/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/assign');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/remove');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/permission/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/assign');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/remove');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/role/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/route/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/route/assign');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/route/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/route/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/route/refresh');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/route/remove');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/rule/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/rule/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/rule/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/rule/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/rule/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/rule/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/activate');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/change-password');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/login');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/logout');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/request-password-reset');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/reset-password');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/signup');
INSERT INTO `auth_item_child` VALUES ('admin', '/admin/user/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/api-client/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/api-client/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/api-client/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/api-client/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/api-client/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/api-client/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/app/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-history/*');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/campaign-history/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-history/create');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/campaign-history/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-history/delete');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/campaign-history/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-history/index');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/campaign-history/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-history/update');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/campaign-history/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-history/view');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/campaign-history/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-website/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-website/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-website/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-website/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-website/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign-website/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/campaign/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-actor-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-actor-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-actor-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-actor-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-actor-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-actor-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/update-status');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/update-status');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-actor/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-actor/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-category-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-category-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-category-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-category-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-category-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-category-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-category/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-category/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-category/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-category/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-category/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-category/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-category/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-category/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-category/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-category/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-category/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-category/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-composer-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-composer-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-composer-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-composer-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-composer-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-composer-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-composer/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-composer/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-composer/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-composer/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-composer/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-composer/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-composer/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-composer/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-composer/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-composer/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-composer/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-composer/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-director-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-director-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-director-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-director-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-director-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-director-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-director/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-director/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-director/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-director/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-director/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-director/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-director/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-director/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-director/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-director/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-director/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-director/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-cp/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-series-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-series-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-series-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-series-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-series-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-film-series-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film-series/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film-series/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film-series/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film-series/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film-series/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film-series/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film-series/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film-series/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film-series/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film-series/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film-series/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film-series/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-film/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-film/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-singer-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-singer-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-singer-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-singer-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-singer-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-singer-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-singer/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-singer/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-singer/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-singer/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-singer/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-singer/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-singer/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-singer/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-singer/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-singer/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-singer/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-singer/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-cp/view');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-series-cp/*');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-series-cp/create');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-series-cp/delete');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-series-cp/index');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-series-cp/update');
INSERT INTO `auth_item_child` VALUES ('cp-metadata', '/csm-attr-tv-show-series-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show-series/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show-series/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show-series/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show-series/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show-series/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show-series/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show-series/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show-series/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show-series/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show-series/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show-series/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show-series/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attr-tv-show/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attr-tv-show/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute-type/*');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attribute-type/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute-type/create');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attribute-type/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute-type/delete');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attribute-type/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute-type/index');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attribute-type/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute-type/update');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attribute-type/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute-type/view');
INSERT INTO `auth_item_child` VALUES ('admin-metadata', '/csm-attribute-type/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/s-upload');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-attribute/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-cp/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-cp/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-cp/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-cp/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-cp/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-cp/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/*');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/delete');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/index');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/update');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/update-status');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/update-status');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-approve/view');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-approve/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-crawler-approve/*');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-crawler-approve/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-crawler-approve/create');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-crawler-approve/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-crawler-approve/delete');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-crawler-approve/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-crawler-approve/index');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-crawler-approve/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-crawler-approve/update');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-crawler-approve/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-crawler-approve/view');
INSERT INTO `auth_item_child` VALUES ('apv-videoclip', '/csm-media-clip-crawler-approve/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/*');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/create');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/delete');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/index');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/update');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/update-status');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/update-status');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-clip-create/view');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/csm-media-clip-create/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/update-status');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-create/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/*');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/create');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/delete');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/delete-multiple');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/index');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/published-for');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/published-for');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/update');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/update-status');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/update-status');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media-film-series-create/view');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/csm-media-film-series-create/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/csm-media/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/default/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/default/db-explain');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/default/download-mail');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/default/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/default/toolbar');
INSERT INTO `auth_item_child` VALUES ('admin', '/debug/default/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/default/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/default/action');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/default/diff');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/default/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/default/preview');
INSERT INTO `auth_item_child` VALUES ('admin', '/gii/default/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/log-data-query/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/log-data-query/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/log-data-query/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/log-data-query/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/log-data-query/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/log-data-query/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/s-upload');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/menu/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner-new/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner-new/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner-new/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner-new/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner-new/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner-new/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/partner/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/report-campaign-daily/*');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/report-campaign-daily/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/report-campaign-daily/create');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/report-campaign-daily/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/report-campaign-daily/delete');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/report-campaign-daily/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/report-campaign-daily/index');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/report-campaign-daily/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/report-campaign-daily/update');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/report-campaign-daily/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/report-campaign-daily/view');
INSERT INTO `auth_item_child` VALUES ('bao-cao-thong-ke', '/report-campaign-daily/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/captcha');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/error');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/get-clients');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/login');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/logout');
INSERT INTO `auth_item_child` VALUES ('admin', '/site/reset-password');
INSERT INTO `auth_item_child` VALUES ('admin', '/sys-config/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/sys-config/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/sys-config/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/sys-config/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/sys-config/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/sys-config/view');
INSERT INTO `auth_item_child` VALUES ('admin', '/upload/*');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/upload/*');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/upload/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/upload/image-upload');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/upload/image-upload');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/upload/image-upload');
INSERT INTO `auth_item_child` VALUES ('admin', '/upload/video-upload');
INSERT INTO `auth_item_child` VALUES ('cp-film-series', '/upload/video-upload');
INSERT INTO `auth_item_child` VALUES ('cp-videoclip', '/upload/video-upload');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/*');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/change');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/change-password');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/create');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/delete');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/index');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/update');
INSERT INTO `auth_item_child` VALUES ('admin', '/user/view');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Không dùng đến bảng này ';

-- ----------------------------
-- Records of auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for campaign
-- ----------------------------
DROP TABLE IF EXISTS `campaign`;
CREATE TABLE `campaign` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng ',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_vietnamese_ci NOT NULL COMMENT 'Tên chiến dịch',
  `partner_id` bigint(20) NOT NULL COMMENT 'ID của đối tác ',
  `description` text COMMENT 'Mô tả về chiến dịch',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0: Draft, 1 - đã duyệt, 2 - Dừng chiến dịch',
  `campaign_type` tinyint(4) DEFAULT '0' COMMENT 'Loại campain: 0 - Theo lưu lượng / 1 - Theo số lượt thuê bao truy cập. Khi edit không cho phép sửa loại campain nữa.',
  `max_data` double DEFAULT NULL COMMENT 'Lưu lượng tối đa của chiến dịch. Đơn vị lưu trong DB là: KB',
  `max_number_access` bigint(20) DEFAULT '0' COMMENT 'số lượt thuê bao truy cập tối đa',
  `warning_data` double DEFAULT NULL COMMENT 'Ngưỡng cảnh báo lưu lượng truy cập, đơn vị KB',
  `warning_number_access` bigint(20) DEFAULT NULL COMMENT 'Ngưỡng cảnh báo lượt thuê bao truy cập',
  `current_data` bigint(20) DEFAULT NULL COMMENT 'Tổng lưu lượng truy cập hiện tại, đơn vị KB',
  `current_number_access` bigint(20) DEFAULT NULL COMMENT 'tổng lượt thuê bao truy cập hiện tại trên toàn IP ',
  `begin_time` datetime DEFAULT NULL COMMENT 'Thời điểm bắt đầu chạy campain',
  `end_time` datetime DEFAULT NULL COMMENT 'Thời gian kết thúc, nếu không khai báo thì là không giới hạn',
  `last_active_time` datetime DEFAULT NULL COMMENT 'Thời điểm campain được kích hoạt khi bấm nút kích hoạt hoặc do module giám sát tự động kích hoạt',
  `last_deactive_time` datetime DEFAULT NULL COMMENT 'Thời điểm ngưng campain lần cuối khi bấm nút ngưng campain hoặc do module giám sát tự động kết thúc chiến dịch',
  `last_warning_time` datetime DEFAULT NULL COMMENT 'Thời gian  warning lần cuối, dùng để xác định bao lâu gửi warning 1 lần',
  `created_at` datetime DEFAULT NULL COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Thời điểm update ',
  `created_by` bigint(20) DEFAULT NULL COMMENT 'ID người dùng tạo ',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'ID user cập nhật ',
  PRIMARY KEY (`id`),
  KEY `partner_id_idx` (`partner_id`),
  KEY `campain_type_idx` (`campaign_type`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='Bảng lưu thông tin của các Campain';

-- ----------------------------
-- Records of campaign
-- ----------------------------
INSERT INTO `campaign` VALUES ('31', 'test', '5', 'Kìa chú là chú ếch con có hai là hai mắt tròn. Chú ngồi học bài một mình bên hố bom kề vườn xoan. Bao cô cá trê non cùng bao nhiêu chú rô ron, tung tăng chiếc vây son nhịp theo tiếng ếch vang giòn. Kìa chú là chú ếch con có hai là hai mắt tròn. Chú ngồi học bài một mình bên hố bom kề vườn xoan. Bao cô cá trê non cùng bao nhiêu chú rô ron, tung tăng chiếc vây son nhịp theo tiếng ếch vang giòn. Kìa chú là chú ếch con có hai là hai mắt tròn. Chú ngồi học bài một mình bên hố bom kề vườn xoan. Bao cô cá trê non cùng bao nhiêu chú rô ron, tung tăng chiếc vây son nhịp theo tiếng ếch vang giòn. Kìa chú là chú ếch con có hai là hai mắt tròn. Chú ngồi học bài một mình bên hố bom kề vườn xoan. Bao cô cá trê non cùng bao nhiêu chú rô ron, tung tăng chiếc vây son nhịp theo tiếng ếch vang giòn. Kìa chú là chú ếch con có hai là hai mắt tròn. Chú ngồi học bài một mình bên hố bom kề vườn xoan. Bao cô cá trê non cùng bao nhiêu chú rô ron, tung tăng chiếc vây son nhịp theo tiếng ếch vang giòn. Kìa chú là', '1', '1', null, '10000', null, '999', null, null, '2017-06-14 17:30:45', '2017-06-14 17:50:46', null, null, null, '2017-06-13 11:32:28', '2017-06-19 13:41:35', null, '13');
INSERT INTO `campaign` VALUES ('32', 'Chiến dịch mùa hè', '59', 'theo số lượt thuê bao truy cập', '1', '0', '10241024', '10000000', '2', '999999999', null, null, '2017-06-01 06:05:18', null, null, null, null, '2017-06-14 13:47:35', '2017-06-14 13:54:00', '13', '13');
INSERT INTO `campaign` VALUES ('34', 'test dung lượng nhập max', '6', '2017-06-13 11:30:45', '1', '1', null, '102400', null, '102398', null, null, '2017-06-07 05:25:20', null, null, null, null, '2017-06-14 14:35:37', '2017-06-19 11:27:30', '13', '13');
INSERT INTO `campaign` VALUES ('35', '121l', '59', '', '0', '1', null, '20', null, '12', null, null, '2017-06-14 09:45:08', null, null, null, null, '2017-06-14 17:47:03', '2017-06-19 10:14:51', '13', '13');
INSERT INTO `campaign` VALUES ('36', 'Test max', '4', 'Test max  sdfgsdg sfg sgsg', '1', '0', '104857600', null, '95420416', null, '95420416', null, '2017-06-16 13:45:58', '2017-06-30 14:50:58', null, null, null, null, '2017-07-10 15:22:48', null, '13');
INSERT INTO `campaign` VALUES ('37', 'Đchiến dịch 1', '5', '', '0', '0', '1048576', null, '2097152', null, null, null, '2017-06-16 10:50:10', '2017-06-16 15:55:10', null, null, null, null, null, null, null);
INSERT INTO `campaign` VALUES ('40', 'Chien dich 1', '6', 'theo luu luong', '0', '0', '107374182400', null, '107269324800', null, null, null, '2017-06-01 02:00:41', null, null, null, null, null, '2017-06-17 16:33:02', null, '13');
INSERT INTO `campaign` VALUES ('41', 'Chiến dịch 2', '22', 'chiến dịch 2', '0', '0', '107374182400', null, '107373133824', null, null, null, '2017-06-06 00:00:39', null, null, null, null, null, '2017-06-17 16:38:23', null, '13');
INSERT INTO `campaign` VALUES ('46', 'Test created by', '4', 'ss', '1', '0', '10737418240', null, '10485760000', null, null, null, '2017-06-13 13:25:22', '2017-06-20 10:45:22', null, null, null, null, '2017-06-19 10:25:36', '13', '13');
INSERT INTO `campaign` VALUES ('49', 'Test trang VNA 1', '62', 'Đo lưu lượng', '1', '0', '10485760000', null, '524288000', null, null, null, '2017-06-20 15:00:00', '2017-07-20 14:55:00', null, null, null, null, '2017-06-20 14:38:00', '13', '13');
INSERT INTO `campaign` VALUES ('50', 'Test trang VNA 2', '62', 'Test theo lượng truy cập', '2', '1', null, null, null, null, null, null, '2017-06-20 15:00:19', '2017-07-20 14:55:20', null, null, null, null, '2017-06-20 14:37:17', '13', '13');
INSERT INTO `campaign` VALUES ('51', 'CD_hien01', '65', 'mô tả hiền 2', '1', '0', '1153433', null, '975175.68', null, null, null, '2017-06-26 09:00:00', '2017-06-27 21:20:48', null, null, null, null, '2017-06-26 09:46:01', '13', '13');
INSERT INTO `campaign` VALUES ('52', 'CD_hien02', '65', 'dfff', '1', '1', null, '100', null, '80', null, null, '2017-06-26 09:00:00', '2017-06-28 21:45:19', null, null, null, null, '2017-06-26 10:04:04', '13', '13');
INSERT INTO `campaign` VALUES ('53', 'CD1', '65', '', '1', '0', '1048576', null, '838860.8', null, null, null, '2017-06-25 20:20:19', '2017-06-30 19:20:19', null, null, null, null, '2017-06-28 10:46:11', '13', '13');
INSERT INTO `campaign` VALUES ('54', '122', '5', '', '0', '0', '1048576', null, '954204.16', null, null, null, '2017-06-27 21:25:18', null, null, null, null, null, '2017-06-28 11:13:33', '13', '13');

-- ----------------------------
-- Table structure for campaign_history
-- ----------------------------
DROP TABLE IF EXISTS `campaign_history`;
CREATE TABLE `campaign_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng ',
  `partner_id` bigint(20) NOT NULL COMMENT 'ID của đối tác ',
  `campaign_id` bigint(20) NOT NULL COMMENT 'Mô tả về chiến dịch',
  `channel` varchar(100) NOT NULL COMMENT 'Kênh tác động: cms/ report/ campaign monitor',
  `action` varchar(255) NOT NULL COMMENT 'active/deactive/pending',
  `reason` text NOT NULL COMMENT 'Lý do tác động',
  `created_by` bigint(20) DEFAULT NULL COMMENT 'Liên kết với bảng user, lưu lại ID của user tác động (nếu có) ',
  `created_at` datetime NOT NULL COMMENT 'Thời điểm tác động vào chiến dịch',
  PRIMARY KEY (`id`),
  KEY `partner_id_idx` (`partner_id`),
  KEY `created_at_idx` (`created_at`),
  KEY `campaign_id_idx` (`campaign_id`),
  KEY `channel_idx` (`channel`),
  KEY `action_idx` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='Bảng lưu log kích hoạt / hủy kích hoạt chiến dịch ';

-- ----------------------------
-- Records of campaign_history
-- ----------------------------
INSERT INTO `campaign_history` VALUES ('2', '2', '1', 'Kenh VTV', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('3', '4', '7', 'abc', 'active', 'chay chien dich\r\n', '0', '2017-06-05 00:00:00');
INSERT INTO `campaign_history` VALUES ('4', '5', '19', 'bca', 'stop', 'huy', '0', '2017-06-03 00:00:00');
INSERT INTO `campaign_history` VALUES ('5', '4', '19', 'Kênh', 'active', 'restart', '0', '2017-06-04 00:00:00');
INSERT INTO `campaign_history` VALUES ('6', '6', '18', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('7', '2', '18', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('8', '2', '18', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('9', '7', '18', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('10', '2', '21', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('11', '7', '18', 'campaign monitor', 'active', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('12', '2', '1', 'KENH 14', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('13', '8', '21', 'campaign monitor1', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('14', '2', '18', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('15', '26', '18', 'campaign monitor2', 'stop', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('16', '2', '19', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('17', '5', '18', 'campaign monitor3', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('18', '22', '1', 'campaign monitor', 'pending', 'Lý do tiếng việt có dấu', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('19', '8', '1', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('20', '8', '1', 'campaign monitor4', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('21', '9', '20', 'campaign monitor5', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('22', '2', '1', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('23', '2', '20', 'campaign monitor6', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('24', '2', '1', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('25', '2', '20', 'campaign monitor7', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('26', '2', '1', 'campaign 8', 'pending', 'het thoi gian ', '0', '2017-06-06 16:06:29');
INSERT INTO `campaign_history` VALUES ('27', '2', '19', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('28', '2', '20', 'campaign monitor', 'pending', 'het thoi gian ', '0', '2017-05-19 16:06:29');
INSERT INTO `campaign_history` VALUES ('29', '4', '36', 'cms', 'active', '333333333333', '13', '2017-06-17 15:27:35');
INSERT INTO `campaign_history` VALUES ('30', '4', '36', 'cms', 'active', '222222222', '13', '2017-06-17 15:33:08');
INSERT INTO `campaign_history` VALUES ('31', '4', '36', 'cms', 'active', '22222222222', '13', '2017-06-17 15:33:33');
INSERT INTO `campaign_history` VALUES ('32', '4', '36', 'cms', 'active', '222222', '13', '2017-06-17 15:35:54');
INSERT INTO `campaign_history` VALUES ('33', '4', '36', 'cms', 'active', '2222', '13', '2017-06-17 15:41:15');
INSERT INTO `campaign_history` VALUES ('34', '4', '36', 'cms', 'deactive', 'dung lai ', '13', '2017-06-17 15:43:00');
INSERT INTO `campaign_history` VALUES ('35', '4', '36', 'cms', 'active', 'chạy', '13', '2017-06-17 15:52:37');
INSERT INTO `campaign_history` VALUES ('36', '4', '36', 'cms', 'deactive', 'dung chien dich vao 17/06', '13', '2017-06-17 16:10:48');
INSERT INTO `campaign_history` VALUES ('37', '4', '36', 'cms', 'active', 'kich hoat lai ', '13', '2017-06-17 16:11:13');
INSERT INTO `campaign_history` VALUES ('38', '4', '36', 'cms', 'deactive', 'dung lan nua', '13', '2017-06-17 16:12:57');
INSERT INTO `campaign_history` VALUES ('39', '6', '34', 'cms', 'active', 'chạy chiến dịch', '13', '2017-06-19 09:46:09');
INSERT INTO `campaign_history` VALUES ('40', '4', '36', 'cms', 'active', 'kích hoạt', '13', '2017-06-19 09:46:27');
INSERT INTO `campaign_history` VALUES ('41', '4', '46', 'cms', 'active', 'test kích hoạt', '13', '2017-06-19 10:27:28');
INSERT INTO `campaign_history` VALUES ('42', '59', '32', 'cms', 'active', 'kích hoạt lại', '13', '2017-06-19 10:29:51');
INSERT INTO `campaign_history` VALUES ('43', '6', '34', 'cms', 'deactive', 'dừng test', '13', '2017-06-19 10:31:22');
INSERT INTO `campaign_history` VALUES ('44', '6', '34', 'cms', 'active', 'abc', '13', '2017-06-19 10:32:42');
INSERT INTO `campaign_history` VALUES ('45', '6', '34', 'cms', 'deactive', 'bca', '13', '2017-06-19 10:33:18');
INSERT INTO `campaign_history` VALUES ('46', '6', '34', 'cms', 'active', 'ssss', '13', '2017-06-19 10:33:41');
INSERT INTO `campaign_history` VALUES ('47', '62', '49', 'cms', 'active', 'OK', '13', '2017-06-20 14:36:34');
INSERT INTO `campaign_history` VALUES ('48', '62', '50', 'cms', 'active', 'OK', '13', '2017-06-20 14:37:46');
INSERT INTO `campaign_history` VALUES ('49', '5', '31', 'cms', 'active', 'kích hoạt', '13', '2017-06-22 10:28:39');
INSERT INTO `campaign_history` VALUES ('50', '65', '51', 'cms', 'active', 'test KH', '13', '2017-06-26 09:44:59');
INSERT INTO `campaign_history` VALUES ('51', '65', '51', 'cms', 'deactive', 'test dừng', '13', '2017-06-26 09:54:22');
INSERT INTO `campaign_history` VALUES ('52', '65', '51', 'cms', 'active', 'dfff', '13', '2017-06-26 09:55:21');
INSERT INTO `campaign_history` VALUES ('53', '65', '52', 'cms', 'active', 'dđ', '13', '2017-06-26 10:04:33');
INSERT INTO `campaign_history` VALUES ('54', '62', '50', 'cms', 'deactive', 'f', '13', '2017-06-26 10:05:24');
INSERT INTO `campaign_history` VALUES ('55', '65', '53', 'cms', 'active', 'ffff', '13', '2017-06-27 16:36:34');

-- ----------------------------
-- Table structure for campaign_website
-- ----------------------------
DROP TABLE IF EXISTS `campaign_website`;
CREATE TABLE `campaign_website` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tu tang ',
  `partner_id` bigint(20) NOT NULL COMMENT 'ID của partner tương ứng ',
  `campaign_id` bigint(20) NOT NULL,
  `address` varchar(100) NOT NULL COMMENT 'IP hoặc là Domain của trang web',
  `port` int(10) DEFAULT NULL COMMENT 'Port tương ứng, nếu là NULL thì là toàn bộ port ',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `address_idx` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='Lưu thông tin các website, địa chỉ IP của Chiến dịch';

-- ----------------------------
-- Records of campaign_website
-- ----------------------------
INSERT INTO `campaign_website` VALUES ('42', '5', '31', 'google.com.vn', null, '2017-06-17 16:44:06', '2017-06-14 17:50:46');
INSERT INTO `campaign_website` VALUES ('43', '4', '46', '12.12.12.12', '1231', '2017-06-19 10:28:26', '2017-06-20 10:45:22');
INSERT INTO `campaign_website` VALUES ('46', '4', '36', 'huetest.vn', null, '2017-06-19 11:30:50', '2017-06-30 14:50:58');
INSERT INTO `campaign_website` VALUES ('47', '5', '38', 'testing.vn', null, '2017-06-19 11:31:32', '2017-06-17 06:35:21');
INSERT INTO `campaign_website` VALUES ('48', '23', '47', 'testing.vn', null, '2017-06-20 01:00:06', '2017-06-30 11:55:06');
INSERT INTO `campaign_website` VALUES ('51', '65', '51', '1.1.1.1', '1521', '2017-06-26 09:38:52', '2017-06-27 21:20:48');
INSERT INTO `campaign_website` VALUES ('52', '65', '51', '1.1.1.2', '22', '2017-06-26 09:39:04', '2017-06-27 21:20:48');
INSERT INTO `campaign_website` VALUES ('53', '65', '51', '1.1.1.1', '22', '2017-06-26 09:53:13', '2017-06-27 21:20:48');
INSERT INTO `campaign_website` VALUES ('54', '65', '52', '10.10.10.10', '8088', '2017-06-26 09:57:08', '2017-06-28 21:45:19');
INSERT INTO `campaign_website` VALUES ('55', '65', '53', '192.168.146.252', '9012', '2017-06-27 16:34:51', '2017-06-30 19:20:19');
INSERT INTO `campaign_website` VALUES ('56', '62', '49', '192.168.146.242', null, '2017-06-28 08:14:27', '2017-07-20 14:55:00');

-- ----------------------------
-- Table structure for email_send_his
-- ----------------------------
DROP TABLE IF EXISTS `email_send_his`;
CREATE TABLE `email_send_his` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng',
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT 'Tiêu đề email ',
  `content` text COLLATE utf8_unicode_ci COMMENT 'Nội dung email ',
  `send_to` text COLLATE utf8_unicode_ci COMMENT 'danh sách Email Gửi tới, cách nhau bởi dấu , ',
  `send_cc` text COLLATE utf8_unicode_ci COMMENT 'danh sách Email Gửi cc, cách nhau bởi dấu , ',
  `sent_time` datetime DEFAULT NULL COMMENT 'Thời gian gửi ',
  `status` tinyint(4) DEFAULT NULL COMMENT 'trạng thái gửi mail: 0 thành công; 1 thất bại; 2: lỗi validate đầu vào',
  `node_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Chưa dùng ',
  `cluster_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Chưa dùng ',
  `receive_time` datetime DEFAULT NULL COMMENT 'Thời điểm nhận ',
  `app_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'ID của tiến trình xử lý ',
  `retry_sent_count` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Số lần gửi lại ',
  `is_spam` tinyint(2) DEFAULT NULL COMMENT 'Đánh dấu email spam thì sẽ không gửi trong giờ hành chính   1 co; 0: khong',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Bảng lưu log gửi email ';

-- ----------------------------
-- Records of email_send_his
-- ----------------------------
INSERT INTO `email_send_his` VALUES ('25', 'Subject=Good morning,', 'BĂ¡o cĂ¡o tá»± Ä‘á»™ng ngĂ y 04/06/2017\r\nat - partner 2: 0 / 45 (0) \r\n. \r\n test - partner 2: 0 / 454 (0) \r\n .\r\n Thanks & Br,', 'namdt5@viettel.com.vn;thanhnam1609@gmail.com;huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-12 09:56:16', '1', 'ID_MAILER1', 'ID_MAILER', '2017-06-12 00:00:00', '0', '2', '0');
INSERT INTO `email_send_his` VALUES ('26', '0', 'good morning!!', 'huent27@viettel.com.vn', null, '2017-06-12 10:01:35', '1', 'ID_MAILER1', 'ID_MAILER', '2017-06-12 00:00:00', '0', '2', '1');
INSERT INTO `email_send_his` VALUES ('27', '', 'hhhh', 'huent27@viettel.com.vn', null, '2017-06-12 10:02:39', '2', 'ID_MAILER1', 'ID_MAILER', '2017-06-12 00:00:00', '0', '0', '0');
INSERT INTO `email_send_his` VALUES ('28', '[data sponsor] Báo cáo ngày 12/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 12/06/2017\r\n \r\nUnKnown - Công ty truyền thoog ad net: 576265463887 / 0 (0.0%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-17 15:17:25', '1', 'ID_MAILER1', 'ID_MAILER', '2017-06-13 14:33:00', 'Report', '2', '1');

-- ----------------------------
-- Table structure for email_send_queue
-- ----------------------------
DROP TABLE IF EXISTS `email_send_queue`;
CREATE TABLE `email_send_queue` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng',
  `subject` varchar(255) CHARACTER SET utf8 DEFAULT '0' COMMENT 'Tiêu đề email ',
  `content` text COLLATE utf8_unicode_ci COMMENT 'Nội dung email ',
  `send_to` text COLLATE utf8_unicode_ci COMMENT 'danh sách Email Gửi tới, cách nhau bởi dấu , ',
  `send_cc` text COLLATE utf8_unicode_ci COMMENT 'danh sách Email Gửi cc, cách nhau bởi dấu , ',
  `receive_time` datetime DEFAULT NULL COMMENT 'Thời gian bắt đầu xử lý ',
  `app_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'ID của tiến trình xử lý ',
  `retry_sent_count` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Số lần gửi lại ',
  `created_at` datetime DEFAULT NULL COMMENT 'Thời điểm tạo bản ghi ',
  `is_spam` tinyint(2) DEFAULT NULL COMMENT 'Đánh dấu email spam thì sẽ không gửi trong giờ hành chính   1 co; 0: khong',
  PRIMARY KEY (`id`),
  KEY `created_at_idx` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Queue lưu trữ Email, \r\nTiến trình gửi email sẽ định kỳ đọc và gửi email đi, kết quả gửi email lưu vào bảng email_send_his';

-- ----------------------------
-- Records of email_send_queue
-- ----------------------------
INSERT INTO `email_send_queue` VALUES ('4', '[data sponsor] Báo cáo ngày 20/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 20/06/2017\r\n \r\nChiến dịch mùa hè - Công ty truyền thoog ad net: 1234567 / 1 (1.234567E8%) \r\n \r\ntên chiến dịch - Công ty truyền thoog ad net: 213456 / 10 (2134560.0%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-21 16:57:01', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('5', '[data sponsor] Báo cáo ngày 21/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 21/06/2017\r\n \r\nChiến dịch mùa hè - Công ty truyền thoog ad net: 11800 / 97700.0 (GB) (12.08%) \r\n \r\ntên chiến dịch - Công ty truyền thoog ad net: 213456 / 10.0 (Lượt) (2134560.0%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-22 11:34:01', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('6', '[data sponsor] Báo cáo ngày 21/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 21/06/2017\r\n \r\nChiến dịch mùa hè - Công ty truyền thoog ad net: 11800.0 / 97700.0 (GB) (12.08%) \r\n \r\ntên chiến dịch - Công ty truyền thoog ad net: 213456.0 / 10.0 (Lượt) (2134560.0%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-22 11:44:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('7', '[data sponsor] Báo cáo ngày 21/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 21/06/2017\r\n \r\nChiến dịch mùa hè - Công ty truyền thoog ad net: 11800.0 / 97700.0 (GB) (12.08%) \r\n \r\ntên chiến dịch - Công ty truyền thoog ad net: 213456.0 / 10.0 (Lượt) (2134560.0%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-22 11:47:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('8', '[data sponsor] Báo cáo ngày 21/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 21/06/2017\r\n \r\nChiến dịch mùa hè - Công ty truyền thoog ad net: 1.18 / 9.77 (GB) (12.06%) \r\n \r\ntên chiến dịch - Công ty truyền thoog ad net: 213456 / 10 (Lượt) (2134560.0%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-22 11:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('9', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 10 / 1048576 (9.5367431640625E-4%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 17:12:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('10', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 10 / 1048576 (9.5367431640625E-4%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 17:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('11', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 10 / 1048576 (9.5367431640625E-4%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 17:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('12', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 17:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('13', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 17:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('14', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 17:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('15', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:00:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('16', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('17', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('18', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('19', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:32:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('20', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('21', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('22', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 18:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('23', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:00:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('24', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('25', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('26', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('27', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:32:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('28', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('29', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('30', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 19:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('31', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:00:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('32', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('33', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('34', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('35', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:32:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('36', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('37', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('38', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 20:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('39', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:00:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('40', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('41', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('42', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('43', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:32:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('44', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('45', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('46', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 21:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('47', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:00:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('48', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('49', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('50', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('51', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:32:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('52', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('53', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('54', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 22:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('55', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:00:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('56', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('57', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('58', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('59', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:32:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('60', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('61', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:48:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('62', '[data sponsor] Báo cáo ngày 26/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 26/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-27 23:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('63', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 12 / 1048576 (0.0011444091796875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 09:08:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('64', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 09:16:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('65', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 27 / 1048576 (0.002574920654296875%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 09:24:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('66', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 802000 / 1048576 (76.48468017578125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 09:40:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('67', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 803000 / 1048576 (76.58004760742188%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 09:56:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('68', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 800000 / 1048576 (76.2939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 10:22:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('69', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 10:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('70', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 10:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('71', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 10:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('72', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 11:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('73', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 11:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('74', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 11:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('75', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 12:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('76', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 12:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('77', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 12:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('78', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 13:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('79', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 13:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('80', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 13:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('81', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 14:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('82', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 14:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('83', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 14:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('84', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 15:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('85', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 15:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('86', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 15:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('87', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 16:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('88', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 16:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('89', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 16:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('90', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 17:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('91', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 17:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('92', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 17:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('93', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 18:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('94', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 18:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('95', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 18:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('96', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 19:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('97', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 19:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('98', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 19:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('99', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 20:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('100', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 20:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('101', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 20:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('102', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 21:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('103', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 21:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('104', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 21:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('105', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 22:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('106', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 22:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('107', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 22:53:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('108', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 23:33:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('109', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 23:43:00', 'Report', '0', null, '1');
INSERT INTO `email_send_queue` VALUES ('110', '[data sponsor] Báo cáo ngày 27/06/2017', 'Good morning,\r\nBáo cáo tự động ngày 27/06/2017\r\n \r\nCD1 - Hiền 011: 820000 / 1048576 (78.2012939453125%) \r\n\r\nThanks & Br,', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'thanhnv75@viettel.com.vn', '2017-06-28 23:53:00', 'Report', '0', null, '1');

-- ----------------------------
-- Table structure for log_data_query
-- ----------------------------
DROP TABLE IF EXISTS `log_data_query`;
CREATE TABLE `log_data_query` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `partner_id` bigint(20) NOT NULL COMMENT 'ID của đối tác tương ứng với campain ',
  `campaign_id` bigint(20) NOT NULL COMMENT 'ID của campain tương ứng ',
  `start_time` datetime DEFAULT NULL COMMENT ' tham số gọi ws data monitoring: Thời gian kết thúc truy vấn',
  `end_time` datetime DEFAULT NULL COMMENT ' tham số gọi ws data monitoring: Thời gian bắt đầu truy vấn',
  `address` varchar(200) NOT NULL COMMENT 'Địa chỉ ip hoặc domain',
  `port` varchar(20) NOT NULL COMMENT 'Port tương ứng của website',
  `data` bigint(20) DEFAULT '0' COMMENT 'lưu lượng, đơn vị là KB. Tương ứng với trường volume của ws data monitoring trả về',
  `number_access` bigint(20) DEFAULT '0' COMMENT 'Lượt truy cập Tương ứng với trường number_access của ws data monitoring trả về',
  `created_at` datetime NOT NULL COMMENT 'Thời điểm lưu bản ghi ',
  `is_report` tinyint(1) DEFAULT '0' COMMENT 'Đã được quét để làm report chưa? 0 - chưa, 1 - đã quét ',
  `process_id` tinyint(4) DEFAULT NULL COMMENT 'ID của process xử lý ',
  PRIMARY KEY (`id`),
  KEY `campain_id_idx` (`campaign_id`),
  KEY `created_at_idx` (`created_at`),
  KEY `address_idx` (`address`),
  KEY `partner_id_idx` (`partner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='Bảng lưu log mỗi lần query lưu lượng lên hệ thống data monitoring thành công\r\n';

-- ----------------------------
-- Records of log_data_query
-- ----------------------------
INSERT INTO `log_data_query` VALUES ('1', '65', '53', '2017-06-27 10:05:02', '2017-06-27 10:05:15', '192.168.146.252', '9012', '790000', '2', '2017-06-27 10:08:32', '0', null);
INSERT INTO `log_data_query` VALUES ('2', '65', '53', '2017-06-27 10:05:02', '2017-06-27 10:05:15', '192.168.146.252', '9012', '10000', '3', '2017-06-27 10:08:39', '0', null);
INSERT INTO `log_data_query` VALUES ('3', '65', '53', '2017-06-27 10:05:02', '2017-06-27 10:05:15', '192.168.146.252', '9012', '20000', '2', '2017-06-27 10:08:32', '0', null);

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  `icon` tinytext,
  `is_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Admin', null, null, '1', null, 'icon-user-following', '1');
INSERT INTO `menu` VALUES ('4', 'Menu', '1', '/menu/index', '1', null, 'icon-list', '1');
INSERT INTO `menu` VALUES ('25', 'Danh sách người dùng', '1', '/user/index', '2', null, 'icon-users', '1');
INSERT INTO `menu` VALUES ('75', 'Cấp quyền', '1', '/admin/assignment/index', '3', null, 'icon-key', '1');
INSERT INTO `menu` VALUES ('76', 'Vai trò', '1', '/admin/role/index', '4', null, 'icon-lock-open', '1');
INSERT INTO `menu` VALUES ('124', 'Quản lý đối tác', '127', '/partner/index', '1', null, 'icon-like', '1');
INSERT INTO `menu` VALUES ('125', 'Quản lý cấu hình', '127', '/sys-config/index', '3', null, 'icon-settings', '1');
INSERT INTO `menu` VALUES ('126', 'Quản lý chiến dịch', '127', '/campaign/index', '2', null, 'icon-plane', '1');
INSERT INTO `menu` VALUES ('127', 'Quản lý', null, null, '2', null, 'icon-paper-clip', '1');
INSERT INTO `menu` VALUES ('128', 'Báo cáo thống kê', null, null, '3', null, 'icon-bar-chart', '1');
INSERT INTO `menu` VALUES ('129', 'Thống kê chiến dịch hàng ngày', '128', '/report-campaign-daily/index', null, null, 'icon-bar-chart', '1');
INSERT INTO `menu` VALUES ('130', 'Tra cứu', null, null, '5', null, 'icon-magnifier', '1');
INSERT INTO `menu` VALUES ('131', 'Tra cứu lịch sử chiến dịch', '130', '/campaign-history/index', '1', null, 'icon-magnifier', '1');
INSERT INTO `menu` VALUES ('132', 'Tra cứu log query lưu lượng', '130', '/log-data-query/index', '2', null, 'icon-magnifier', '1');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1444474229');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1444474401');
INSERT INTO `migration` VALUES ('m140501_075311_add_oauth2_server', '1448333675');
INSERT INTO `migration` VALUES ('m140506_102106_rbac_init', '1444474234');
INSERT INTO `migration` VALUES ('m140602_111327_create_menu_table', '1445422048');
INSERT INTO `migration` VALUES ('m151014_031704_create_status_table', '1444792774');

-- ----------------------------
-- Table structure for partner
-- ----------------------------
DROP TABLE IF EXISTS `partner`;
CREATE TABLE `partner` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng',
  `partner_code` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT 'Mã đối tác: không trùng, viết hoa, không ký tự đặc biệt, chỉ gồm Chữ, số và dấu _ ',
  `name` varchar(255) COLLATE utf8_vietnamese_ci NOT NULL COMMENT 'Tên đối tác',
  `description` text CHARACTER SET utf8 COMMENT 'Mô tả về đối tác ',
  `representative` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Người đại diện công ty',
  `register_number` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Số đăng ký kinh doanh',
  `founding_date` date DEFAULT NULL COMMENT 'Ngày thành lập công ty',
  `business_area` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Lĩnh vực kinh doanh',
  `email_list` text CHARACTER SET utf8 COMMENT 'Danh sách email sẽ dùng để nhận report, cảnh báo, cách nhau bởi dấu phẩy ,',
  `phone_list` text CHARACTER SET utf8 COMMENT 'Danh sách SĐT sẽ nhận báo cáo, cảnh báo, cách nhau bởi dấu phẩy ,',
  `fax` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Fax ',
  `website` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Website của công ty',
  `created_at` datetime DEFAULT NULL COMMENT 'Thời điểm tạo',
  `updated_at` datetime DEFAULT NULL COMMENT 'Thời điểm update ',
  PRIMARY KEY (`id`),
  KEY `partner_code_idx` (`partner_code`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci COMMENT='Bảng lưu thông tin đối tác ';

-- ----------------------------
-- Records of partner
-- ----------------------------
INSERT INTO `partner` VALUES ('4', 'PARTNER_4', 'Đối tác 1', 'description of partner 4', 'a', 'RKDLQK123919', '2017-05-31', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-05-18 12:00:06');
INSERT INTO `partner` VALUES ('5', 'PARTNER_5', 'Công ty truyền thoog ad net', 'description of partner 5', 'a', 'RKDLQK123919', '2017-05-31', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-05-18 12:00:06');
INSERT INTO `partner` VALUES ('6', 'PARTNER_6', 'partner 6', 'description of partner 6', 'a', 'RKDLQK123919', '2017-05-31', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-05-18 12:00:06');
INSERT INTO `partner` VALUES ('7', 'PARTNER_7', 'partner 7', 'description of partner 7', 'a', 'RKDLQK123919', '2017-05-31', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-05-18 12:00:06');
INSERT INTO `partner` VALUES ('22', 'PARTNER_22', 'VTC- Đài truyền hình', 'd', 'a', 'RKDLQK123919', '2017-03-01', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-06-12 15:20:01');
INSERT INTO `partner` VALUES ('23', 'PARTNER_23', 'Đài truyền hình VTV', 'description of partner 23xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'a', 'RKDLQK123919', '2017-05-31', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-06-19 10:45:13');
INSERT INTO `partner` VALUES ('26', 'PARTNER_26', 'Bộ giáo dục và đào tạo', 'description of partner 26', 'a', 'RKDLQK123919', '2017-05-31', 'Khác', 'ds@viettel.com.vn,thanhnv75@viettel.com.vn', '12345678901', '+1234568', 'http://abc.com.vn', '2017-05-18 10:56:00', '2017-05-18 12:00:06');
INSERT INTO `partner` VALUES ('43', 'ddd', 'sds', '', 'dsds', 'ds4163163', '2017-06-12', '', 'b@viettel.com.vn', '01649600112', '', '', '2017-06-12 16:19:04', '2017-07-10 15:22:12');
INSERT INTO `partner` VALUES ('44', 'gdfgfg', 'Có em chờ', 'đối tác', 'sâsa', '', '2017-07-07', '', 'g@gmail.com', '01649600112', '', '', '2017-06-12 16:21:08', '2017-06-12 16:25:08');
INSERT INTO `partner` VALUES ('48', 'DT1', 'đối tác 1', '', 'Huế', 'huế', '2017-06-01', 'nội trợ', '', '', '123456', 'http://www.google.com', '2017-06-14 09:13:39', '2017-06-14 09:13:39');
INSERT INTO `partner` VALUES ('49', 'DT2', 'đối tác 2', '', 'dlksdjf', 'dkfjsl', '2017-05-30', 'dấdfg', '', '', '', '', '2017-06-14 09:14:02', '2017-06-14 09:14:02');
INSERT INTO `partner` VALUES ('50', 'DT3', 'đối tác 3', '', '', '', null, '', '', '', '', '', '2017-06-14 09:14:17', '2017-06-14 09:14:17');
INSERT INTO `partner` VALUES ('51', 'DT4', 'đối tác 4', '', 'sdklfjasklj', 'dfgsd', null, '', '', '', '', '', '2017-06-14 09:14:34', '2017-06-14 09:14:34');
INSERT INTO `partner` VALUES ('52', 'DT5', 'đối tác 5', '', '', '', null, '', '', '', '', '', '2017-06-14 09:14:53', '2017-06-14 09:14:53');
INSERT INTO `partner` VALUES ('53', 'DT6', 'đối tác 6', '', '', '', null, '', '', '', '', '', '2017-06-14 09:15:08', '2017-06-14 09:15:08');
INSERT INTO `partner` VALUES ('54', 'DT7', 'đối tác 7', '', '', '', null, '', '', '', '', '', '2017-06-14 09:15:23', '2017-06-14 09:15:23');
INSERT INTO `partner` VALUES ('55', 'DT8', 'đối tác 8', '', '', '', null, '', '', '', '', '', '2017-06-14 09:15:33', '2017-06-14 09:15:33');
INSERT INTO `partner` VALUES ('56', 'DT9', 'đối tác 9', '', '', '', null, '', '', '', '', '', '2017-06-14 09:15:49', '2017-06-14 09:15:49');
INSERT INTO `partner` VALUES ('58', 'DT11', 'đối tác 11', '', '', '', null, '', '', '', '', '', '2017-06-14 09:16:19', '2017-06-14 09:16:19');
INSERT INTO `partner` VALUES ('59', 'DT12', '<script> alert(1) </script>', '<script> alert(1) </script>', '<script> alert(1) </script>', '<script> alert(1) </script>', '2017-05-31', '<script> alert(1) </script>', '', '', '', '', '2017-06-14 09:21:11', '2017-06-14 09:21:11');
INSERT INTO `partner` VALUES ('62', 'VNA', 'Tổng công ty Hàng không Việt Nam', 'Chạy test website', 'Test', '0100107518', null, 'Hàng không', 'quyptt@viettel.com.vn', '0987768607', '', 'https://www.vietnamairlines.com', '2017-06-20 14:32:08', '2017-06-20 14:32:08');
INSERT INTO `partner` VALUES ('63', 'hue', 'hue', '', '', '', null, '', '', '01657523487', '', '', '2017-06-22 10:20:57', '2017-06-22 10:20:57');
INSERT INTO `partner` VALUES ('65', 'CT_HienNT36_1', 'Hiền 011', 'test 11', 'Châu 01', '123456', '2017-06-20', 'Thời trang', 'hiennt36@viettel.com.vn,huyendtt15@viettel.com.vn', '0977803686,01664271101', '123456', 'https://qlsxpm.viettel.vn:9443/ccm/web/projects/VITM_SERVICES%20%28Change%20Management%29#action=com.ibm.team.workitem.viewWorkItem&id=810780', '2017-06-26 09:05:47', '2017-06-27 16:36:05');
INSERT INTO `partner` VALUES ('66', 'N0001', 'NNNN01', 'ô', '', '', null, '', '', '', '', '', '2017-06-29 09:31:47', '2017-06-29 09:57:19');

-- ----------------------------
-- Table structure for report_campaign_daily
-- ----------------------------
DROP TABLE IF EXISTS `report_campaign_daily`;
CREATE TABLE `report_campaign_daily` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `report_date` date NOT NULL COMMENT 'Ngày báo cáo ',
  `partner_id` bigint(20) NOT NULL COMMENT 'ID của đối tác tương ứng với campain ',
  `campaign_id` bigint(20) NOT NULL COMMENT 'ID của campaign tương ứng',
  `address` varchar(200) NOT NULL COMMENT 'Địa chỉ ip hoặc domain',
  `port` varchar(20) NOT NULL COMMENT 'Port tương ứng của website',
  `data` double DEFAULT NULL COMMENT 'Tổng lưu lượng đến thời điểm hiện tại, đơn vị là KB. ',
  `number_access` double DEFAULT NULL COMMENT 'Tổng Lượt truy cập hiện tại',
  PRIMARY KEY (`id`),
  KEY `campain_id_idx` (`campaign_id`),
  KEY `address_idx` (`address`),
  KEY `partner_id_idx` (`partner_id`),
  KEY `report_date_idx` (`report_date`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1135 DEFAULT CHARSET=utf8 COMMENT='Tổng hợp lưu lượng, thuê bao truy cập theo từng IP / port / trong ngày. ';

-- ----------------------------
-- Records of report_campaign_daily
-- ----------------------------
INSERT INTO `report_campaign_daily` VALUES ('1023', '2017-06-20', '5', '32', '24h.com.vn', '0', '1234567', '1234567');
INSERT INTO `report_campaign_daily` VALUES ('1024', '2017-06-20', '5', '33', '24h.com.vn', '0', '123456', '213456');
INSERT INTO `report_campaign_daily` VALUES ('1025', '2017-06-21', '5', '32', '24h.com.vn', '0', '1234567', '1234567');
INSERT INTO `report_campaign_daily` VALUES ('1026', '2017-06-21', '5', '33', '24h.com.vn', '0', '123456', '213456');
INSERT INTO `report_campaign_daily` VALUES ('1027', '2017-06-21', '5', '32', '24h.com.vn', '0', '1234567', '1234567');
INSERT INTO `report_campaign_daily` VALUES ('1028', '2017-06-21', '5', '33', '24h.com.vn', '0', '123456', '213456');
INSERT INTO `report_campaign_daily` VALUES ('1029', '2017-06-21', '5', '32', '24h.com.vn', '0', '1234567', '1234567');
INSERT INTO `report_campaign_daily` VALUES ('1030', '2017-06-21', '5', '33', '24h.com.vn', '0', '123456', '213456');
INSERT INTO `report_campaign_daily` VALUES ('1031', '2017-06-21', '5', '32', '24h.com.vn', '0', '1234567', '1234567');
INSERT INTO `report_campaign_daily` VALUES ('1032', '2017-06-21', '5', '33', '24h.com.vn', '0', '123456', '213456');
INSERT INTO `report_campaign_daily` VALUES ('1092', '2017-06-27', '65', '53', '192.168.146.252', '9012', '800000', '5');
INSERT INTO `report_campaign_daily` VALUES ('1093', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1094', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1095', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1096', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1097', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1098', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1099', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1100', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1101', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1102', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1103', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1104', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1105', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1106', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1107', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1108', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1109', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1110', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1111', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1112', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1113', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1114', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1115', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1116', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1117', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1118', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1119', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1120', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1121', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1122', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1123', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1124', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1125', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1126', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1127', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1128', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1129', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1130', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1131', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1132', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1133', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');
INSERT INTO `report_campaign_daily` VALUES ('1134', '2017-06-27', '65', '53', '192.168.146.252', '9012', '820000', '7');

-- ----------------------------
-- Table structure for sms_mt
-- ----------------------------
DROP TABLE IF EXISTS `sms_mt`;
CREATE TABLE `sms_mt` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng',
  `mo_his_id` bigint(20) DEFAULT '0' COMMENT 'Không dùng đến',
  `msisdn` bigint(15) NOT NULL COMMENT 'Số điện thoại, định dạng 84xxx',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nội dung tin nhắn SMS ',
  `receive_time` datetime NOT NULL COMMENT 'Thời gian insert MT vào ',
  `app_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'app id của tiến trình xử lý',
  `retry_sent_count` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Số lần gửi lại ',
  `channel` varchar(15) NOT NULL COMMENT 'Đầu số hoặc alias gửi tin ',
  `is_spam` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0: tin thường, 1: Tin spam. nếu là tin spam thì chỉ được gửi trong giờ hành chính',
  PRIMARY KEY (`id`),
  KEY `msisdn_idx` (`msisdn`),
  KEY `receive_time_idx` (`receive_time`)
) ENGINE=InnoDB AUTO_INCREMENT=375 DEFAULT CHARSET=utf8 COMMENT='Bảng lưu queue MT (các tin SMS chuẩn bị gửi) ';

-- ----------------------------
-- Records of sms_mt
-- ----------------------------

-- ----------------------------
-- Table structure for sms_mt_his
-- ----------------------------
DROP TABLE IF EXISTS `sms_mt_his`;
CREATE TABLE `sms_mt_his` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mo_his_id` bigint(20) NOT NULL COMMENT 'Không dùng đến ',
  `msisdn` bigint(15) NOT NULL COMMENT 'Số điện thoại, định dạng 84xxx',
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'Nội dung tin nhắn',
  `sent_time` datetime NOT NULL COMMENT 'Thời điểm gửi tin ',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT 'Trạng thái gửi, 0 = thành công ',
  `channel` varchar(15) DEFAULT NULL COMMENT 'Đầu số hoặc alias gửi tin ',
  `node_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'node cua gossip',
  `cluster_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'cluster thuc hien',
  `receive_time` datetime NOT NULL COMMENT 'Thời điểm insert MT ',
  `retry_sent_count` tinyint(2) DEFAULT NULL COMMENT 'so lan gui lai',
  `app_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_spam` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0: tin thường, 1: Tin spam. nếu là tin spam thì chỉ được gửi trong giờ hành chính',
  PRIMARY KEY (`id`),
  KEY `mo_his_id_idx` (`mo_his_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=utf8 COMMENT='Lưu log gửi tin nhắn SMS ';

-- ----------------------------
-- Records of sms_mt_his
-- ----------------------------
INSERT INTO `sms_mt_his` VALUES ('305', '1', '9846555456', 'kfhdfgfd', '2017-06-19 13:38:43', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('306', '1', '9846555456', 'kfhdfgfd', '2017-06-19 13:39:39', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('307', '1', '9846555456', 'kfhdfgfd', '2017-06-19 13:39:39', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('308', '1', '9846555456', 'kfhdfgfd', '2017-06-19 13:39:39', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('309', '1', '9846555456', 'kfhdfgfd', '2017-06-19 13:39:39', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('310', '1', '9846555456', 'kfhdfgfd', '2017-06-19 13:39:39', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('311', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:53', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('312', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:53', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('313', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:53', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('314', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:53', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('315', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:53', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('316', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:53', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('317', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:54', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('318', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:54', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('319', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:54', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('320', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:54', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('321', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:54', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('322', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:54', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('323', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('324', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('325', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('326', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('327', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('328', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('329', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('330', '1', '9846555456', 'kfhdfgfd', '2017-06-19 16:00:55', '0', '1234', 'node1', 'MT', '2017-06-19 11:22:51', '0', '0', '0');
INSERT INTO `sms_mt_his` VALUES ('331', '0', '977929922', 'Bao cao 20/06/2017: \r\n  \r\n   Chien dich mua he - Cong ty truyen thoog ad net: 1234567 / 1 (1.234567E8%)  \r\n  \r\n   ten chien dich - Cong ty truyen thoog ad net: 213456 / 10 (2134560.0%)  \r\n', '2017-06-22 16:39:37', '1', '101', 'node1', 'MT', '2017-06-21 16:57:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('332', '0', '977929922', 'Bao cao 20/06/2017: \r\n  \r\n   Chien dich mua he - Cong ty truyen thoog ad net: 1234567 / 1 (1.234567E8%)  \r\n  \r\n   ten chien dich - Cong ty truyen thoog ad net: 213456 / 10 (2134560.0%)  \r\n', '2017-06-22 16:39:37', '1', '101', 'node1', 'MT', '2017-06-21 16:57:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('333', '0', '977929922', 'Bao cao 21/06/2017: \r\n  \r\n   Chien dich mua he - Cong ty truyen thoog ad net: 11800 / 97700.0 (GB) (12.08%)  \r\n  \r\n   ten chien dich - Cong ty truyen thoog ad net: 213456 / 10.0 (Luot) (2134560.0%)  \r\n', '2017-06-22 17:48:22', '1', '101', 'node1', 'MT', '2017-06-22 11:34:00', '3', 'Report', '0');
INSERT INTO `sms_mt_his` VALUES ('334', '0', '977929922', 'Bao cao 21/06/2017: \r\n  \r\n   Chien dich mua he - Cong ty truyen thoog ad net: 11800 / 97700.0 (GB) (12.08%)  \r\n  \r\n   ten chien dich - Cong ty truyen thoog ad net: 213456 / 10.0 (Luot) (2134560.0%)  \r\n', '2017-06-22 17:48:23', '1', '101', 'node1', 'MT', '2017-06-22 11:34:00', '3', 'Report', '0');
INSERT INTO `sms_mt_his` VALUES ('335', '0', '968667884', 'Bao cao 21/06/2017: \r\n  \r\n   Chien dich mua he - Cong ty truyen thoog ad net: 11800 / 97700.0 (GB) (12.08%)  \r\n  \r\n   ten chien dich - Cong ty truyen thoog ad net: 213456 / 10.0 (Luot) (2134560.0%)  \r\n', '2017-06-22 17:55:04', '0', '101', 'node1', 'MT', '2017-06-22 11:34:00', '0', 'Report', '0');
INSERT INTO `sms_mt_his` VALUES ('336', '0', '968667884', 'Bao cao 21/06/2017: \r\n  \r\n   Chien dich mua he - Cong ty truyen thoog ad net: 11800 / 97700.0 (GB) (12.08%)  \r\n  \r\n   ten chien dich - Cong ty truyen thoog ad net: 213456 / 10.0 (Luot) (2134560.0%)  \r\n', '2017-06-22 17:59:49', '0', '101', 'node1', 'MT', '2017-06-22 11:34:00', '0', 'Report', '0');
INSERT INTO `sms_mt_his` VALUES ('337', '0', '977803686', 'Bao cao 26/06/2017: \r\n  \r\n   CD1 - Hien 011: 10 / 1048576 (9.5367431640625E-4%)  \r\n', '2017-06-28 08:56:33', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-27 17:12:00', '3', 'Report', '0');
INSERT INTO `sms_mt_his` VALUES ('338', '0', '942206055', 'Bao cao 26/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 08:56:33', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-27 17:40:00', '3', 'Report', '0');
INSERT INTO `sms_mt_his` VALUES ('339', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 12 / 1048576 (0.0011444091796875%)  \r\n', '2017-06-28 09:08:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:08:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('340', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 12 / 1048576 (0.0011444091796875%)  \r\n', '2017-06-28 09:08:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:08:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('341', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 12 / 1048576 (0.0011444091796875%)  \r\n', '2017-06-28 09:08:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:08:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('342', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 09:16:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:16:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('343', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 09:16:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:16:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('344', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 09:16:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:16:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('345', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 09:24:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:24:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('346', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 09:24:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:24:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('347', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 27 / 1048576 (0.002574920654296875%)  \r\n', '2017-06-28 09:24:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:24:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('348', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 802000 / 1048576 (76.48468017578125%)  \r\n', '2017-06-28 09:40:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:40:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('349', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 802000 / 1048576 (76.48468017578125%)  \r\n', '2017-06-28 09:40:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:40:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('350', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 802000 / 1048576 (76.48468017578125%)  \r\n', '2017-06-28 09:40:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:40:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('351', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 803000 / 1048576 (76.58004760742188%)  \r\n', '2017-06-28 09:56:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:56:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('352', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 803000 / 1048576 (76.58004760742188%)  \r\n', '2017-06-28 09:56:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:56:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('353', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 803000 / 1048576 (76.58004760742188%)  \r\n', '2017-06-28 09:56:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 09:56:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('354', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 800000 / 1048576 (76.2939453125%)  \r\n', '2017-06-28 10:22:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:22:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('355', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 800000 / 1048576 (76.2939453125%)  \r\n', '2017-06-28 10:22:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:22:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('356', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 800000 / 1048576 (76.2939453125%)  \r\n', '2017-06-28 10:22:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:22:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('357', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 800000 / 1048576 (76.2939453125%)  \r\n', '2017-06-28 10:22:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:22:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('358', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('359', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('360', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('361', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('362', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('363', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('364', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('365', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('366', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('367', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('368', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('369', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 10:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 10:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('370', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('371', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('372', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('373', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('374', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('375', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('376', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('377', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('378', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('379', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('380', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('381', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 11:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 11:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('382', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('383', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('384', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('385', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('386', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('387', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('388', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('389', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('390', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('391', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('392', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('393', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:01:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 12:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('394', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('395', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('396', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('397', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('398', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('399', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('400', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('401', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('402', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('403', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('404', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('405', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 13:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 13:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('406', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('407', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('408', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('409', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('410', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('411', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('412', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('413', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('414', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('415', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('416', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('417', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 14:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 14:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('418', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('419', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('420', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('421', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:33:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('422', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('423', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('424', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('425', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:43:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('426', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('427', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('428', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('429', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 15:53:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 15:53:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('430', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('431', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('432', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('433', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:33:04', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:33:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('434', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('435', '0', '977929922', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('436', '0', '1657523487', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:43:00', '3', 'Report', '1');
INSERT INTO `sms_mt_his` VALUES ('437', '0', '977803686', 'Bao cao 27/06/2017: \r\n  \r\n   CD1 - Hien 011: 820000 / 1048576 (78.2012939453125%)  \r\n', '2017-06-28 16:43:05', '1', '1234', 'ID_SENDER1', 'ID_SENDER', '2017-06-28 16:43:00', '3', 'Report', '1');

-- ----------------------------
-- Table structure for sys_config
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng',
  `config_key` varchar(200) NOT NULL COMMENT 'Ten cau hinh, viết hoa, không dấu, ví dụ: EMAIL_ADDRESS',
  `config_value` text COMMENT 'Giá trị cấu hình ',
  `description` text COMMENT 'Mô tả cấu hình ',
  PRIMARY KEY (`id`),
  KEY `config_key_idx` (`config_key`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='Bảng lưu trữ cấu hình hệ thống ';

-- ----------------------------
-- Records of sys_config
-- ----------------------------
INSERT INTO `sys_config` VALUES ('1', 'REPORT_PHONE_NUMBER', '0977929922,0977929922,01657523487,0977803686', 'Các SĐT sẽ nhận cảnh báo và báo cáo');
INSERT INTO `sys_config` VALUES ('2', 'REPORT_EMAIL_ADDRESS', 'namdt5@viettel.com.vn,thanhnam1609@gmail.com,huent27@viettel.com.vn,hiennt36@viettel.com.vn', 'Các email sẽ nhận cảnh báo, báo cáo');
INSERT INTO `sys_config` VALUES ('3', 'UPDATE_DATA_FREQUENCY', '5', 'Tuần xuất cập nhật lưu lượng, đơn vị là phút. Mặc định: 5 phút 1 lần');
INSERT INTO `sys_config` VALUES ('4', 'WS_DATA_MON_URL', 'http://192.168.146.252:8888/url', 'Link tới ws của KGM để update lưu lượng theo IP ');
INSERT INTO `sys_config` VALUES ('5', 'WS_DATA_MON_USER', 'datamon', 'User ws của KGM để update lưu lượng theo IP ');
INSERT INTO `sys_config` VALUES ('6', 'WS_DATA_MON_PASSWORD', 'pass', 'Mật khẩu của ws của KGM để update lưu lượng theo IP ');
INSERT INTO `sys_config` VALUES ('7', 'WARNING_PERIOD', '60', 'Đơn vị: Phút. Chu kỳ gửi cảnh báo khi campaign đạt ngưỡng');
INSERT INTO `sys_config` VALUES ('8', 'WARNING_EMAIL_SUBJECT', '[data sponsor] Canh bao chien dich %campaign_name% luc %report_time%', 'Tiêu đề email cảnh báo. %campaign_name% : Tên chiến dịch, %report_time%: thời gian cảnh báo');
INSERT INTO `sys_config` VALUES ('9', 'WARNING_EMAIL_CONTENT', 'Xin chào %partner_name%, \r\nĐây là cảnh báo chiến dịch %campaign_name% \r\nNgưỡng lưu lượng  %current_data% / %max_data%  GB\r\n\r\nVui lòng liên hệ Viettel để nâng cấp chiến dịch!', 'Nội dung cảnh báo khi vượt ngưỡng \r\n%partner_name%: tên đối tác\r\n%campaign_name%: tên chiến dịch \r\n%current_data%: tiêu dùng hiện tại (GB) \r\n%max_data%: Ngưỡng tối đa (GB) ');
INSERT INTO `sys_config` VALUES ('10', 'REPORT_EMAIL_SUBJECT', '[data sponsor] Báo cáo ngày %report_date%', 'Tiêu đề email gửi báo cáo 8h hàng ngày \r\n%report_date%: ngày báo cáo dd/mm/yyyy');
INSERT INTO `sys_config` VALUES ('11', 'REPORT_EMAIL_CONTENT', 'Good morning,\r\nBáo cáo tự động ngày %report_date%\r\n{{ \r\n%campaign_name% - %partner_name%: %current_data% / %max_data% (%percent%) \r\n}}\r\nThanks & Br,', 'Nội dung báo cáo 8h hàng ngày\r\n%report_date%: Ngày báo cáo (dd/mm/yyyy) \r\n%campaign_name%: Tên chiến dịch \r\n%current_data%: tiêu dùng hiện tại\r\n%max_data%: ngưỡng tối đa\r\n%percent%: 50% sử dụng \r\n{{  }} bắt đầu và kết thúc danh sách các chiến dịch. Regex lấy string: \\{\\{([\\s\\S]*)\\}\\}\r\n');
INSERT INTO `sys_config` VALUES ('12', 'WARNING_SMS_CONTENT', '%campaign_name%: %current_data% / %max_data% (%percent%)', 'Nội dung gửi SMS cảnh báo campaign\r\n%campaign_name%:  tên chiến dịch \r\n%current%: data hoặc truy cập hiện tại \r\n%max%: data hoặc truy cập tối đa cho phép ');
INSERT INTO `sys_config` VALUES ('13', 'REPORT_SMS_CONTENT', 'Bao cao %report_date%: \r\n{{  \r\n   %campaign_name% - %partner_name%: %current_data% / %max_data% (%percent%)  \r\n}}', 'Nội dung gửi báo cáo 8h hàng ngày qua SMS \r\n%report_date%: Ngày báo cáo (dd/mm/yyyy) \r\n%campaign_name%: Tên chiến dịch \r\n%current_data%: tiêu dùng hiện tại\r\n%max_data%: ngưỡng tối đa\r\n%percent%: 50% sử dụng \r\n{{  }} bắt đầu và kết thúc danh sách các chiến dịch. Regex lấy string: \\{\\{([\\s\\S]*)\\}\\}');
INSERT INTO `sys_config` VALUES ('14', 'REPORT_SMS_SHORT_CODE', '1234', null);
INSERT INTO `sys_config` VALUES ('15', 'REPORT_EMAIL_ADDRESS_CC', 'thanhnv75@viettel.com.vn', '');
INSERT INTO `sys_config` VALUES ('16', 'ACCC', 'ccc', '');
INSERT INTO `sys_config` VALUES ('18', 'WS_DATA_MON_USER111', '<embed src=\'http://img.vietgiaitri.com/flvplayer/players5.6.swf\' height=\'360\' width=\'468\' allowscriptaccess=\'always\' allowfullscreen=\'true\' flashvars=\'logo=http%3A%2F%2Fimg.vietgiaitri.com%2Fcopy.png&bufferlength=2&link=http%3A%2F%2Fvideo.vietgiaitri.com%2F%3FCODE%3D01%2ge=http%3A%2F%2Fi3.ytimg.com%2Fvi%2F4Psy5LrHQkI%2Fhqdefault.jpg&file=http%3A%2F%2Fwww.youtube.com%2Fv%2F4Psy5LrHQkI&duration=-1&plugins=http://img.vietgiaitri.com/flvplayer/vi', '');
INSERT INTO `sys_config` VALUES ('19', 'WS_DATA_MON_USER_12121', 'Đành kết thúc cho vơi đi nỗi buồn về sau. Hãy quên nhau đi mình đã cho nhau được gì. Chỉ là những phút đi bên cạnh nhau', '');
INSERT INTO `sys_config` VALUES ('20', 'WS_DATA_MON_USER12323232', 'ssđsd', '                               ');
INSERT INTO `sys_config` VALUES ('21', 'WS_DATA_MON_USERA', 'âsa', '<script><script>alert(\"test\")</script></script> ');
INSERT INTO `sys_config` VALUES ('22', 'BBB', 'bbb', 'Đừng hoài nghi theo nhịp đập con tim');
INSERT INTO `sys_config` VALUES ('24', 'A', '<embed src=\'http://img.vietgiaitri.com/flvplayer/players5.6.swf\' height=\'360\' width=\'468\' allowscriptaccess=\'always\' allowfullscreen=\'true\' flashvars=\'logo=http%3A%2F%2Fimg.vietgiaitri.com%2Fcopy.png&bufferlength=2&link=http%3A%2F%2Fvideo.vietgiaitri.com%2F%3FCODE%3D01%2ge=http%3A%2F%2Fi3.ytimg.com%2Fvi%2F4Psy5LrHQkI%2Fhqdefault.jpg&file=http%3A%2F%2Fwww.youtube.com%2Fv%2F4Psy5LrHQkI&duration=-1&plugins=http://img.vietgiaitri.com/flvplayer/vi', '<embed src=\'http://img.vietgiaitri.com/flvplayer/players5.6.swf\' height=\'360\' width=\'468\' allowscriptaccess=\'always\' allowfullscreen=\'true\' flashvars=\'logo=http%3A%2F%2Fimg.vietgiaitri.com%2Fcopy.png&bufferlength=2&link=http%3A%2F%2Fvideo.vietgiaitri.com%2F%3FCODE%3D01%2ge=http%3A%2F%2Fi3.ytimg.com%2Fvi%2F4Psy5LrHQkI%2Fhqdefault.jpg&file=http%3A%2F%2Fwww.youtube.com%2Fv%2F4Psy5LrHQkI&duration=-1&plugins=http://img.vietgiaitri.com/flvplayer/vi');
INSERT INTO `sys_config` VALUES ('25', 'AA', '<IFRAME SRC=\"javascript:alert(\'<b style=\"color:black;background-color:#a0ffff\">XSS</b>\');\"></IFRAME>', '<IFRAME SRC=\"javascript:alert(\'<b style=\"color:black;background-color:#a0ffff\">XSS</b>\');\"></IFRAME>');
INSERT INTO `sys_config` VALUES ('26', 'BBBC', '<IMG SRC=\'vbscript:msgbox(\"<b style=\"color:black;background-color:#a0ffff\">XSS</b>\")\'>', '<IMG SRC=\'vbscript:msgbox(\"<b style=\"color:black;background-color:#a0ffff\">XSS</b>\")\'>');
INSERT INTO `sys_config` VALUES ('27', 'EEEEEE', '<script> alert(1) </script><script> alert(1) </script>', '<script> alert(1) </script>');
INSERT INTO `sys_config` VALUES ('28', 'NN', '%3C%73%63%72%69%70%74%3E%61%6C%65%72%74%28%22%74%65%73%74%22%29%3C%2F%73%63%72%69%70%74%3E', '%3C%73%63%72%69%70%74%3E%61%6C%65%72%74%28%22%74%65%73%74%22%29%3C%2F%73%63%72%69%70%74%3E ');
INSERT INTO `sys_config` VALUES ('29', 'MM', '&#x3C;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;&#x20;&#x61;&#x6C;&#x65;&#x72;&#x74;&#x28;&#x22;&#x74;&#x65;&#x73;&#x74;&#x22;&#x29;&#x20;&#x3C;&#x2F;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;', '&#x3C;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;&#x20;&#x61;&#x6C;&#x65;&#x72;&#x74;&#x28;&#x22;&#x74;&#x65;&#x73;&#x74;&#x22;&#x29;&#x20;&#x3C;&#x2F;&#x73;&#x63;&#x72;&#x69;&#x70;&#x74;&#x3E;');
INSERT INTO `sys_config` VALUES ('30', 'MMMM', '= a), (b),(c', '= a), (b),(c ');
INSERT INTO `sys_config` VALUES ('31', 'KK', '&lt;script&gt; alert(\"test\") &lt;/script&gt;', '&lt;script&gt; alert(\"test\") &lt;/script&gt;');
INSERT INTO `sys_config` VALUES ('32', 'CONFIG_VALUE', 'Dù có yêu thêm, tình yêu đôi ta cần phải lý trí', 'Dù có yêu thêm, tình yêu đôi ta cần phải lý trí, hãy quên nhau đi');
INSERT INTO `sys_config` VALUES ('33', 'CC', '<embed src=\'http://img.vietgiaitri.com/flvplayer/players5.6.swf\' height=\'360\' width=\'468\' allowscriptaccess=\'always\' allowfullscreen=\'true\' flashvars=\'logo=http%3A%2F%2Fimg.vietgiaitri.com%2Fcopy.png&bufferlength=2&link=http%3A%2F%2Fvideo.vietgiaitri.com%2F%3FCODE%3D01%2ge=http%3A%2F%2Fi3.ytimg.com%2Fvi%2F4Psy5LrHQkI%2Fhqdefault.jpg&file=http%3A%2F%2Fwww.youtube.com%2Fv%2F4Psy5LrHQkI&duration=-1&plugins=http://img.vietgiaitri.com/flvplayer/vi', '<embed src=\'http://img.vietgiaitri.com/flvplayer/players5.6.swf\' height=\'360\' width=\'468\' allowscriptaccess=\'always\' allowfullscreen=\'true\' flashvars=\'logo=http%3A%2F%2Fimg.vietgiaitri.com%2Fcopy.png&bufferlength=2&link=http%3A%2F%2Fvideo.vietgiaitri.com%2F%3FCODE%3D01%2ge=http%3A%2F%2Fi3.ytimg.com%2Fvi%2F4Psy5LrHQkI%2Fhqdefault.jpg&file=http%3A%2F%2Fwww.youtube.com%2Fv%2F4Psy5LrHQkI&duration=-1&plugins=http://img.vietgiaitri.com/flvplayer/vi\r\n\r\n');
INSERT INTO `sys_config` VALUES ('34', 'WS_DATA_MON_USER_121211', 'WS_DATA_MON_USER_121212', '');
INSERT INTO `sys_config` VALUES ('35', 'WS_DATA_MON_USERA1', 'WS_DATA_MON_USERA1', 'WS_DATA_MON_USERA');
INSERT INTO `sys_config` VALUES ('36', 'CON_CO_BE_BE_NO_DAU_CANH_TRE_DI_KHONG_HOI_ME_BIET_DI_DUONG_NAO_CON_CO_BE_BE_NO_DAU_CANH_TRE_DI_KHONG_HOI_ME_BIET_DI_DUONG_NAO_CON_CO_BE_BE_NO_DAU_CANH_TRE_DI_KHONG_HOI_ME_BIET_DI_DUONG_NAO_CON_CO_BE_C', 'Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Con_co_b', 'Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao. Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao. Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao. Con_co_b');
INSERT INTO `sys_config` VALUES ('37', '1', 'WS_DATA_MON_USER_121212', 'WS_DATA_MON_USER_121212');
INSERT INTO `sys_config` VALUES ('38', 'CON_CO_BE_BE_NO_DAU_CANH_TRE_DI_KHONG_HOI_ME_BIET_DI_DUONG_NAO_CON_CO_BE_BE_NO_DAU_CANH_TRE_DI_KHONG_HOI_ME_BIET_DI_DUONG_NAO_CON_CO_BE_BE_NO_DAU_CANH_TRE_DI_KHONG_HOI_ME_BIET_DI_DUONG_NAO_CON_CO_BE_B', 'Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Con_co_be_be_no_dau_canh_tre_di_khong_hoi_me_biet_di_duong_nao.Khi', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Tên đăng nhập',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã xác thực',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mật khẩu đã mã hóa',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Mã reset password',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Email',
  `status` smallint(6) NOT NULL DEFAULT '10' COMMENT 'Trạng thái\r\n1-Kích hoạt\r\n0-Không kích hoạt\r\n',
  `created_at` int(11) NOT NULL COMMENT 'Thời điểm tạo',
  `updated_at` int(11) NOT NULL COMMENT 'Thời điểm cập nhật',
  `last_time_login` datetime DEFAULT NULL COMMENT 'Thời điểm đăng nhập lần cuối',
  `is_first_login` tinyint(1) DEFAULT '1' COMMENT '1-Lần đầu đăng nhập\r\n0-Không phải lần đầu\r\n',
  `cp_id` bigint(20) unsigned DEFAULT NULL COMMENT 'Không dùng đến',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `cp_id` (`cp_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`cp_id`) REFERENCES `csm_cp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('13', 'admin', '7TiwUXB1SodLJa6p1u3KYmki811RH7ci', '$2y$13$IAxlvcJAs9iDqE/bVAvIj.PfPLi7z8N31JmK87GCTcU5m4aLkqBGm', 'TaD0a60M3kyDGpJCYSx8-IpbB-7R32Er_1499826070', 'admin@viettel.com.vn', '1', '1473304266', '1499826070', '2017-07-12 09:21:09', '0', null);
INSERT INTO `user` VALUES ('14', 'vtt-media', 'CChf9kwI6YMwLO6TRD6iaJAFADu4lDKy', '$2y$13$h/./Knxj/5U5TIPRKGk0YusAdhk17FDIFE3RwbuOuh4tb8KNoDHkO', 'WMNKpq89z_Oskw6QfYHr8f890SZNWO5n_1489063648', 'khanhlp1@viettel.com.vn', '1', '1489063084', '1489063648', '2017-03-09 19:47:27', '0', '4');
INSERT INTO `user` VALUES ('16', 'thiennd8', 'y2cIFjCWRUBrvh9Na6HUoRdYjcVtokrD', '$2y$13$ruoB4EWqW0uV4fEWfhOVbeXzHEbYXqK0lEpwOuZoY051v08FLbnVq', '4OpZbGEXSwdgmyocNZ_rj0LrHT0U1m31_1489200582', 'thiennd8@viettel.com.vn', '1', '1489147356', '1489200582', '2017-03-11 02:49:41', '0', '2');
INSERT INTO `user` VALUES ('18', 'thuypt25', 'SYoC_tvlMCuGeO1piXdx1H8Nue2eSLmu', '$2y$13$JkA3a5MBk92giCcgs9xE/OS2QuXjJjowZRBO0AyG6bpLqE4Jf/J3m', 'VdOJx_x5Y54Q3kxTHsdNDCJ1BYsrAX27_1490148325', 'thuypt25@viettel.com.vn', '1', '1489473950', '1490148325', null, '1', '18');
INSERT INTO `user` VALUES ('20', 'vietdk', 'KK21bBZaXuljBSqqk7WuQb_mIYnpYkKs', '$2y$13$pzLVQ4ORTvTDMbQWsgCnaurBaEpGmoQ40WubQU64NiG4Vq1aoZDQ6', 'BoAnu-kZxhoN0VFZW3RoDNHglCI_7rcI_1490148321', 'vietdk@viettel.com.vn', '1', '1489473978', '1490148321', null, '1', '18');
INSERT INTO `user` VALUES ('22', 'thuthuy', 'HTbGIMjx3mVDTXz8GA3L-QbnIVAw7pV_', '$2y$13$ZA9TfMmqBPAB7ok8PmvkvuabNkIdA7iPDhA4R9fdEkZwBkkagStKS', '-o-0k2UsXeb7_WcIqS2eg4Uo4ssiKY3f_1490148317', 'thuthuy@viettel.com.vn', '1', '1489474001', '1490148317', null, '1', '18');
INSERT INTO `user` VALUES ('24', 'phuongnt83', 'X7-aeNl2l0TY8q2lWDs3981d2F6uZixu', '$2y$13$kBFVEzoUokG5WGq7I7.WhuB1q4V8ru9Xg6/4InGdvCl64SGENallW', 'XKZabdpl19qKzwGtotk_HKF4EJ613l7i_1490148311', 'phuongnt83@viettel.com.vn', '1', '1489474019', '1490148311', null, '1', '18');
INSERT INTO `user` VALUES ('26', 'duonglh5', 'ktdkce7_0mJ8mF5Lz03cwH9Cm-0RB56W', '$2y$13$jwbNA2GJcWVeaK.ZPmwUoeJ1MPa48oD.c7.vKSuEDTGm0pi5ZzdEO', 'O2qTHELX-DeM4bBem_Ak3V5eOeEPWhcJ_1490331242', 'duonglh5@viettel.com.vn', '1', '1489474047', '1490331242', '2017-03-14 08:50:05', '0', '18');
INSERT INTO `user` VALUES ('28', 'namdl1', '9zehQcqL-IKS4NYG85Sozi7U8zYfqLrB', '$2y$13$BtuSEli6w2EJZzZDji.4XumLrG8OSQiKL3M7mKTZn24hROPXnpejm', '8NZ2mRLXLoHM6ZhJbiZVGVtkbbBGqwMv_1490148292', 'namdl1@viettel.com.vn', '1', '1489474074', '1490148292', null, '1', '18');
INSERT INTO `user` VALUES ('30', 'phuonghoa', 'iGyBt6sCqqQ1UQQyf-NdYihLX3TQhVLe', '$2y$13$1wfn5H2ClyAyBCafrUwmvu/XMb/g/tB9H8oPNIETYV4Zv7q1dYBcG', 'CNLJLjhx2nx-FoWgkqvAuV6niDlYmkjs_1490086208', 'phuonghoa@viettel.com.vn', '1', '1489474094', '1490086208', null, '1', '18');
INSERT INTO `user` VALUES ('32', 'thanhmailt', 'bnz4l8mLRpjrQCKNapLIMXl1b7mmjZs3', '$2y$13$ctk76bOhSa5DFdswkzgOdOvalUtGIjGiVCixWpiNJDkCkbJZX/OnG', 'dKLaJ3XP69_g1CLDuIV220vmFLem-l3V_1490148281', 'thanhmailt@viettel.com.vn', '1', '1489474115', '1490148281', null, '1', '18');
INSERT INTO `user` VALUES ('34', 'minhphuong', 'yID7CBqOHE88fW5oA1Hwm3eYUFiXQNXo', '$2y$13$w8KcuAfHcXhvUK82iYbfR.fZb2DKXO12WB6jzw16ETvVwvhqCIB86', 'tLYFutZNiSSiuYntnDabDArlG71QKOux_1490148223', 'minhphuong@viettel.com.vn', '1', '1489474145', '1490148223', null, '1', '18');
INSERT INTO `user` VALUES ('36', 'minhnn4', 'oEUwHToYRbbDcZZyF-JndFoZLgtGkY93', '$2y$13$boShiY0noAWd04MROtRmqeaM0bNI5VH97eYdl.ix5LTpwmtFyNraq', 'ejZoct__v8cAtdiYdWQM3vypWoS8QPYY_1490148358', 'minhnn4@viettel.com.vn', '1', '1489474168', '1490148358', null, '1', '18');
INSERT INTO `user` VALUES ('38', 'ngapv', 'RBS8Ux0koYbYl6RkKw2IQo8eO5KdKtKV', '$2y$13$RTFjK9K/HOS3OjxgQYqPlux.fWOTBf6h9tuSKO2xVNVg.iye9wJNS', 'oL-20cugY2c329FkjtxtLdkHb2hvKVQk_1490148210', 'ngapv@viettel.com.vn', '1', '1489474189', '1490148210', null, '1', '18');
INSERT INTO `user` VALUES ('40', 'thuytien', 'XmJZgS2sa2FgMM3NdKRfrf04iJdNxc89', '$2y$13$DvT5CUKgK3Q/ACB0UqTwwum73g7AtPYT5pCpfM2VSzRVZzoEa9VL6', 'oCHMoz2gPPBQASQPF3GlfRQj23aR48NM_1490148204', 'thuytien@viettel.com.vn', '1', '1489474209', '1490148204', null, '1', '18');
INSERT INTO `user` VALUES ('42', 'anhtu', 'DsvuyEOV3v7S7iZmr94mrtvrK5th7Mhp', '$2y$13$pjV72HjEYC84YaH58zY9CeICA4Il1ZgvsESjSEzXM1u6aPLcB3s.u', 'rKiWstF6rAZ3XukC3gTy2d1jDsyVhCNZ_1490148347', 'anhtu@viettel.com.vn', '1', '1489474239', '1490148347', null, '1', '18');
INSERT INTO `user` VALUES ('46', 'linhnt36', 'EshIAV9od_TcIR5ISUcXcqb6U1n_ts1V', '$2y$13$xxOm8qebkuTyrdCIh3v0xu1FYlPE81/a9Ig0ZU3bTXg1P9r72Jfiy', 'kkCIl5_hExPVLjpXZptKGm-zm04cURM9_1490148337', 'linhnt36@viettel.com.vn', '1', '1489474327', '1490148337', null, '1', '18');
INSERT INTO `user` VALUES ('48', 'anhnth16', 'vg3BkVQYmQtLvj0t2l5dQI5J5JY85IYq', '$2y$13$r7J6k4Hn6ue4cfFrPrkGV.Rf4rxsPK5uVW.Sbpq.l1eRh3Jyn0G5y', '4-XsBR7hqOWqvLBsl6kkC_M8V8mx_DkC_1490148125', 'anhnth16@viettel.com.vn', '1', '1489474352', '1490148125', null, '1', '18');
INSERT INTO `user` VALUES ('50', 'duongpt12', 'S7BlPacrsB8XCZ4-0KgM8ftJcHhNCMiK', '$2y$13$GnMeTDfzD1GVk288K3OnJuukJFqVxD0cbTWByDsCGShInMoBWgqx6', 'ISWNPiwBmnvmQmXTLaWplh2YFiCX2bZl_1490148330', 'duongpt12@viettel.com.vn', '1', '1489474384', '1490148330', null, '1', '18');
INSERT INTO `user` VALUES ('52', 'media-fafilm', 'ZHjij0rfCLmuZZopMtMc5gxnlg6bSR2Y', '$2y$13$qoGAOs9ZaMOBgmKrYBZ20ufVetPyvzETspkGXjBVPTjJb4XSXJiRy', '0az5JQBFWRxAht-UY9Jg9FO70cMH7NNz_1489628820', 'vanlth6@viettel.com.vn', '1', '1489628820', '1489628820', null, '1', '6');
INSERT INTO `user` VALUES ('54', 'media-sontra', 'zDMgDfx4nhw-i4m9uBeXxr-VN5tn24rG', '$2y$13$w6zMVh9KnK59WuKU7yyVL.eRCtbnU/ncVdH3qDpBZHI7BlqIn0I/6', 'kgAPkDQHEVfbYO43iejsab69ejLP6Byo_1489628978', 'vanlth6.1@viettel.com.vn', '1', '1489628978', '1489628978', null, '1', '8');
INSERT INTO `user` VALUES ('56', 'media-thanglong', 'ekk5JtgwpIatQcGfkCWlSqOPM91k-NoD', '$2y$13$pTLGvf8YW4pGPzEk/DUZle4FGj1gk86RLvZSRy8xmTR.O03uu44im', 'bzFX4k1BFB6A34VTftvJNNQsNkfDyzyf_1489629015', 'vanlth6.2@viettel.com.vn', '1', '1489629015', '1489629015', null, '1', '10');
INSERT INTO `user` VALUES ('58', 'media-vietcontent', 'uIPlnop-bhDqk2hQtYc9vazsosvuJZNX', '$2y$13$BW./pCYZzlpRMM9JwkPNneVsPyvOKqHpwE3rIgmgYTKBIYVm8mJ8.', 'kF9ATpH-Xw713Q8f1nn8RFwpQbBXjSuY_1489629048', 'vanlth6.3@viettel.com.vn', '1', '1489629048', '1489629048', null, '1', '12');
INSERT INTO `user` VALUES ('60', 'media-tvb', 'Dn7HD0-u7DMuedgblm7xdaT2jaVeLH6I', '$2y$13$o3EZke9389tVAk287ug//.Ma/ju7OcYU3L0VQXjiaglrEYQbp09k.', 'nADlBd3zkdzWFF59nxnLU1W-wd4l97pF_1489629104', 'vanlth6.4@viettel.com.vn', '1', '1489629104', '1489629104', null, '1', '14');
INSERT INTO `user` VALUES ('62', 'media-moonscoop', 'Tf3mZQ0nUz6oOmGKufm1Zn72BuKU1i9k', '$2y$13$bXoGhY0rDsmwdVrNJpwKCuHsxc42MLr.TG2GAoSSbxxP0DHRvuKYi', '7KWoc9mV0ONsi7RsxUZdzyrvHP_d0swt_1489629141', 'vanlth6.5@viettel.com.vn', '1', '1489629141', '1489629141', null, '1', '16');
INSERT INTO `user` VALUES ('63', 'canhtd2', 'er8WWtDrIr7mfXVoI2OreEVR3Dabal8f', '$2y$13$HQlqjCpHN.lWFqDU6LXqhuN2GEIBekHJmCrdBZd9mr20apK4Pyaaq', '5hcsaGLpfsXzM4kxN7NUmOrQKpTZWVyQ_1492072661', 'canhtd2@viettel.com.vn', '1', '1492071419', '1492072661', '2017-04-13 08:37:40', '0', '2');
INSERT INTO `user` VALUES ('64', 'thanhnv75', 'S7nmKfq8JdYUlFmH8FPiPDq6VnWc-qVV', '$2y$13$iEVJj/il3iDEtwwSuw062ei8aQgq7R3A8Yc.cEIZlcDOKMlAmeUWS', '6Un9-U9x32kP1wfpfpNquOTeIvX4ta_d_1495186470', 'thanhnv75@viettel.com.vn', '1', '1495186427', '1495186470', null, '1', null);
INSERT INTO `user` VALUES ('65', 'hiennt36', 'AGEUNs8frCdvJtmfIQ-fBrW3kLMfs7Jh', '$2y$13$VjoQYEJf.g7.UYoMrrqnUu6ta90H31O0Vl9H2Jqo90ayv8x2NBKYO', 'NrMAohfkeVRtj0Ow2-B5fEm5gQujCKUO_1498446889', 'hiennt36@viettel.com.vn', '1', '1498446889', '1498446889', null, '1', null);
INSERT INTO `user` VALUES ('66', 'abc', 'swk1A9s4hoou7ePXR-AW-Jh2pcqhungS', '$2y$13$Oj58HVXf05dfxmDsVF8igOUBIy4dKxazV8uDFSuOAf1anHzI1xvdq', 'icX4XMncl-i_vfi8b_htJ6yBzUW5zMQa_1499669808', 'hoatuylip@gmail.com', '1', '1499669808', '1499669808', null, '1', null);

-- ----------------------------
-- Table structure for user_locked
-- ----------------------------
DROP TABLE IF EXISTS `user_locked`;
CREATE TABLE `user_locked` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng ',
  `username` varchar(255) DEFAULT NULL COMMENT 'Tên đăng nhập',
  `ip` varchar(50) DEFAULT NULL COMMENT 'Địa chỉ IP ',
  `created_at` bigint(20) unsigned DEFAULT NULL COMMENT 'Thời gian tạo ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Lưu trữ các user bị khóa do login sai nhiều lần';

-- ----------------------------
-- Records of user_locked
-- ----------------------------

-- ----------------------------
-- Table structure for user_login_failed
-- ----------------------------
DROP TABLE IF EXISTS `user_login_failed`;
CREATE TABLE `user_login_failed` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID tự tăng ',
  `username` varchar(255) NOT NULL COMMENT 'Tên đăng nhập',
  `user_id` bigint(20) unsigned DEFAULT NULL COMMENT 'ID user (chưa dùng đến) ',
  `ip` varchar(50) DEFAULT NULL COMMENT 'Địa chỉ IP ',
  `created_at` bigint(20) unsigned DEFAULT NULL COMMENT 'Thời điểm tạo ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Lưu trữ các lần login không thành công của user để khóa tài khoản nếu vượt quá ';

-- ----------------------------
-- Records of user_login_failed
-- ----------------------------
