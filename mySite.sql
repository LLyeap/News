/*
 Navicat MySQL Data Transfer

 Source Server         : vagrant
 Source Server Version : 50716
 Source Host           : 127.0.0.1
 Source Database       : mySite

 Target Server Version : 50716
 File Encoding         : utf-8

 Date: 02/16/2017 13:48:09 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `data_admin_role`
-- ----------------------------
DROP TABLE IF EXISTS `data_admin_role`;
CREATE TABLE `data_admin_role` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '管理员用户角色表主键',
  `name` varchar(8) NOT NULL COMMENT '管理员角色名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_admin_role`
-- ----------------------------
BEGIN;
INSERT INTO `data_admin_role` VALUES ('1', '超级管理员');
COMMIT;

-- ----------------------------
--  Table structure for `data_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `data_admin_user`;
CREATE TABLE `data_admin_user` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '管理员列表主键',
  `email` varchar(64) NOT NULL COMMENT '管理员用户的登录邮箱',
  `password` varchar(32) NOT NULL COMMENT '管理员用户的登录密码',
  `last_login_ip` varchar(16) DEFAULT '0' COMMENT '上次登录的ip',
  `last_login_time` varchar(16) DEFAULT NULL COMMENT '上次登录的时间戳',
  `remember_me` int(1) NOT NULL DEFAULT '0' COMMENT '是否记住我:0-不记住(默认),1-记住',
  `status` varchar(2) DEFAULT '1' COMMENT '用户状态:1-正常(默认),2-软删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_admin_user`
-- ----------------------------
BEGIN;
INSERT INTO `data_admin_user` VALUES ('1', 'master@163.com', '0b7094380f56b6b6329553f7bbc9978e', '192.168.33.1', '1487219609', '1', '1'), ('2', 'admin', '0adc3949ba59abbe56e057f20f883ee1', '0', null, '0', '1'), ('3', 'test@qq.com', '4ef03f01c9df709e8f676a591e9ed754', '0', null, '0', '1');
COMMIT;

-- ----------------------------
--  Table structure for `data_category_info`
-- ----------------------------
DROP TABLE IF EXISTS `data_category_info`;
CREATE TABLE `data_category_info` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '类别表id',
  `name` varchar(16) NOT NULL COMMENT '类别名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_category_info`
-- ----------------------------
BEGIN;
INSERT INTO `data_category_info` VALUES ('1', '团情快报'), ('2', '通知公告'), ('3', '学院风采'), ('4', '学生会 & 社联');
COMMIT;

-- ----------------------------
--  Table structure for `data_content_info`
-- ----------------------------
DROP TABLE IF EXISTS `data_content_info`;
CREATE TABLE `data_content_info` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '资讯内容表主键',
  `title` varchar(256) NOT NULL COMMENT '内容标题',
  `keywords` varchar(128) NOT NULL COMMENT '内容关键字',
  `cover` varchar(128) NOT NULL COMMENT '内容封面图片的链接',
  `content` text NOT NULL COMMENT '页面内容MD',
  `html_content` text NOT NULL COMMENT '内容的html格式',
  `carousel` char(1) NOT NULL DEFAULT '0' COMMENT '标记是否在轮播图显示[0-不显示|1-显示)',
  `read_count` int(4) NOT NULL DEFAULT '0' COMMENT '资讯被阅读的次数',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '资讯创建时间戳',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '资讯最后一次被修改的时间戳',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_content_info`
-- ----------------------------
BEGIN;
INSERT INTO `data_content_info` VALUES ('1', 'my', 'my test', 'admin/content/images/placeholder.jpg', '# 测试MD一级标题', '', '1', '0', '2017-02-13 10:59:08', '2017-02-13 10:59:08'), ('2', 'test', 'test', '/tmp/phpqmyMZF', '# test', '', '0', '0', '2017-02-13 11:42:58', '2017-02-13 11:42:58'), ('3', '1', '1', '', '1', '', '0', '0', '2017-02-13 12:03:07', '2017-02-13 12:03:07'), ('4', '1', '1', '', '1', '', '1', '0', '2017-02-13 12:03:22', '2017-02-13 12:03:22'), ('5', '1', '1', '', '1', '', '0', '0', '2017-02-13 12:03:34', '2017-02-13 12:03:34'), ('8', '3333333333333', 'ok', 'http://admin.mysite.com/uploads/images/0a8b9a08c06cca8e448b67b10fe5c2b1.JPG', 'ok', '', '1', '0', '2017-02-13 16:59:58', '2017-02-13 16:59:58'), ('9', '222222', 'ok', 'http://admin.mysite.com/uploads/images/0a8b9a08c06cca8e448b67b10fe5c2b1.JPG', 'ok', '', '1', '0', '2017-02-13 17:05:57', '2017-02-13 17:05:57'), ('10', '1111111', 'ok', 'http://admin.mysite.com/uploads/images/0a8b9a08c06cca8e448b67b10fe5c2b1.JPG', 'ok', '', '1', '0', '2017-02-13 17:13:37', '2017-02-13 17:13:37'), ('11', '11', '11', 'http://admin.mysite.com/admin/content/images/placeholder.jpg', '11', '', '0', '0', '2017-02-13 17:16:07', '2017-02-13 17:16:07'), ('12', '11', '11', 'http://admin.mysite.com/admin/content/images/placeholder.jpg', '11', '', '0', '0', '2017-02-13 17:19:58', '2017-02-13 17:19:58'), ('13', 'id', 'id', 'http://admin.mysite.com/admin/content/images/placeholder.jpg', 'id', '', '0', '0', '2017-02-14 06:06:18', '2017-02-14 06:06:18'), ('14', 'id', 'id', 'http://admin.mysite.com/admin/content/images/placeholder.jpg', 'id', '', '0', '0', '2017-02-14 06:11:33', '2017-02-14 06:11:33'), ('15', '这是一个测试 测试标题长度', 'category', 'http://admin.mysite.com/admin/content/images/placeholder.jpg', 'a', '', '0', '0', '2017-02-14 06:12:49', '2017-02-14 06:12:49'), ('16', 'html', 'html', 'http://admin.mysite.com/uploads/images/e64980ef7a64e8fcb1888a4c7a24e61f.jpeg', '# asdf\r\n\r\n这个目的是测试html', '<h1 id=\"h1-asdf\"><a name=\"asdf\" class=\"reference-link\"></a><span class=\"header-link octicon octicon-link\"></span>asdf</h1><p>这个目的是测试html</p>\r\n', '1', '0', '2017-02-16 05:38:44', '2017-02-16 05:38:44');
COMMIT;

-- ----------------------------
--  Table structure for `data_link_info`
-- ----------------------------
DROP TABLE IF EXISTS `data_link_info`;
CREATE TABLE `data_link_info` (
  `id` int(4) NOT NULL COMMENT '友情链接的id(需要排序,不设置自增)',
  `name` varchar(16) NOT NULL COMMENT '友情链接名称',
  `url` varchar(64) NOT NULL COMMENT '友情链接地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_link_info`
-- ----------------------------
BEGIN;
INSERT INTO `data_link_info` VALUES ('1', 'News', 'http://news.loveys.site');
COMMIT;

-- ----------------------------
--  Table structure for `data_nav_info`
-- ----------------------------
DROP TABLE IF EXISTS `data_nav_info`;
CREATE TABLE `data_nav_info` (
  `id` int(4) NOT NULL COMMENT '导航条表的主键(也做排序用,不自增)',
  `name` varchar(16) NOT NULL COMMENT '导航条显示内容',
  `url` varchar(64) NOT NULL COMMENT '导航条链接路径',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `data_nav_info`
-- ----------------------------
BEGIN;
INSERT INTO `data_nav_info` VALUES ('1', '简介', '/introduction');
COMMIT;

-- ----------------------------
--  Table structure for `rel_admin_user_role`
-- ----------------------------
DROP TABLE IF EXISTS `rel_admin_user_role`;
CREATE TABLE `rel_admin_user_role` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '管理员用户与角色表的索引表主键',
  `admin_user_id` int(4) NOT NULL COMMENT '管理员用户的主键id(data_admin_user)',
  `admin_role_id` int(4) NOT NULL COMMENT '管理员角色表的主键(data_admin_role)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `rel_admin_user_role`
-- ----------------------------
BEGIN;
INSERT INTO `rel_admin_user_role` VALUES ('1', '1', '1');
COMMIT;

-- ----------------------------
--  Table structure for `rel_content_category`
-- ----------------------------
DROP TABLE IF EXISTS `rel_content_category`;
CREATE TABLE `rel_content_category` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '资讯内容类别表',
  `content_id` int(4) NOT NULL COMMENT '资讯表id',
  `category_id` int(4) NOT NULL COMMENT '类别表id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `rel_content_category`
-- ----------------------------
BEGIN;
INSERT INTO `rel_content_category` VALUES ('1', '15', '1'), ('2', '14', '1'), ('3', '13', '1'), ('4', '12', '2'), ('5', '16', '1');
COMMIT;

-- ----------------------------
--  Table structure for `rel_content_nav`
-- ----------------------------
DROP TABLE IF EXISTS `rel_content_nav`;
CREATE TABLE `rel_content_nav` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '资讯内容和导航内容的关联表主键(data_content_info & data_nav_info)',
  `content_id` int(4) NOT NULL COMMENT '资讯内容的id',
  `nav_id` int(4) NOT NULL COMMENT '导航内容的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
