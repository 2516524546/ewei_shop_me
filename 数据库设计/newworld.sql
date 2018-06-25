/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : newworld

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2018-06-25 09:19:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `j_item`
-- ----------------------------
DROP TABLE IF EXISTS `j_item`;
CREATE TABLE `j_item` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '项目表自增id',
  `item_uid` bigint(20) NOT NULL COMMENT '项目发布者id',
  `item_name` varchar(255) NOT NULL COMMENT '项目名称',
  `item_uname` varchar(255) NOT NULL COMMENT '项目发布者真实姓名',
  `item_icon` varchar(255) NOT NULL COMMENT '项目图标',
  `item_contact` varchar(255) NOT NULL COMMENT '联系方式',
  `item_mail` varchar(255) NOT NULL COMMENT '邮箱',
  `item_company` varchar(255) NOT NULL COMMENT '公司',
  `item_content` text NOT NULL COMMENT '简介',
  `item_type` text NOT NULL COMMENT '类型',
  `item_budget` varchar(255) NOT NULL COMMENT '预算',
  `item_time` varchar(255) NOT NULL COMMENT '开发时间',
  `item_needspecialty` varchar(255) NOT NULL COMMENT '专业需求',
  `item_firstmarks` varchar(255) NOT NULL COMMENT '第一层标识',
  `item_secondmarks` varchar(255) DEFAULT NULL COMMENT '第二层标识',
  `item_thirdmarks` varchar(255) DEFAULT NULL COMMENT '第三层标识',
  `item_fourthmarks` varchar(255) DEFAULT NULL COMMENT '第四层标识',
  `item_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0为已结束，1为进行中',
  `item_isdel` int(1) NOT NULL DEFAULT '1' COMMENT '是否已删除，0为已删除，1为未删除',
  `item_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
-- Records of j_item
-- ----------------------------
INSERT INTO `j_item` VALUES ('1', '7', 'item', 'oo', 'fdfdf', '17876205873', '1776494277@qq.com', 'google', 'content1', 'type01', '50226626', '2018-6-21', 'opop', '城市', '行业', '学校', '书包', '1', '1', '2018-06-21 14:43:02');
INSERT INTO `j_item` VALUES ('2', '7', 'item2', 'davaid ma', 'fdfdf', '17876205873', '1776494277@qq.com', 'oracle', 'hello world', 'type02', '52048989', '2018-6-22', 'uiuiu', '梦想', '努力', '交通', '房子', '1', '1', '2018-06-22 14:47:07');

-- ----------------------------
-- Table structure for `j_item_city`
-- ----------------------------
DROP TABLE IF EXISTS `j_item_city`;
CREATE TABLE `j_item_city` (
  `item_city_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '项目城市表自增id',
  `item_city_name` varchar(255) NOT NULL COMMENT '城市名字',
  `item_city_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `item_city_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`item_city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目城市表';

-- ----------------------------
-- Records of j_item_city
-- ----------------------------

-- ----------------------------
-- Table structure for `j_item_school`
-- ----------------------------
DROP TABLE IF EXISTS `j_item_school`;
CREATE TABLE `j_item_school` (
  `item_school_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '项目的学校表自增id',
  `item_schhol_name` varchar(255) NOT NULL COMMENT '学校名',
  `item_school_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `item_school_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`item_school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目的学校表';

-- ----------------------------
-- Records of j_item_school
-- ----------------------------

-- ----------------------------
-- Table structure for `j_item_trade`
-- ----------------------------
DROP TABLE IF EXISTS `j_item_trade`;
CREATE TABLE `j_item_trade` (
  `item_trade_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '项目的行业表自增id',
  `item_trade_name` varchar(255) NOT NULL COMMENT '名称',
  `item_trade_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `item_trade_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`item_trade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目的行业表';

-- ----------------------------
-- Records of j_item_trade
-- ----------------------------

-- ----------------------------
-- Table structure for `j_professional`
-- ----------------------------
DROP TABLE IF EXISTS `j_professional`;
CREATE TABLE `j_professional` (
  `professional_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '专业人士表自增id',
  `professional_uid` bigint(20) NOT NULL COMMENT '用户id',
  `professional_uname` varchar(255) NOT NULL COMMENT '真实姓名',
  `professional_specialty` varchar(255) NOT NULL COMMENT '专业',
  `professional_contact` varchar(255) NOT NULL COMMENT '联系方式',
  `professional_content` text NOT NULL COMMENT '简介',
  `professional_trait` text NOT NULL COMMENT '专长',
  `professional_explain` text COMMENT '备注',
  `professional_firstmarks` varchar(255) NOT NULL COMMENT '第一层标识',
  `professional_secondmarks` varchar(255) DEFAULT NULL COMMENT '第二层标识',
  `professional_thirdmarks` varchar(255) DEFAULT NULL COMMENT '第三层标识',
  `professional_fourthmarks` varchar(255) DEFAULT NULL COMMENT '第四层标识',
  `professional_createtime` datetime NOT NULL COMMENT '创建时间',
  `professional_updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`professional_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='专业人士表';

-- ----------------------------
-- Records of j_professional
-- ----------------------------
INSERT INTO `j_professional` VALUES ('2', '7', 'java', 'fdfdfd', '17876205873', 'welcome to my heart', '15656dfndjfhdf', 'dfafa', '11', '22', '33', '44', '2018-06-08 16:56:56', '2018-06-23 16:57:01');

-- ----------------------------
-- Table structure for `j_professional_comment`
-- ----------------------------
DROP TABLE IF EXISTS `j_professional_comment`;
CREATE TABLE `j_professional_comment` (
  `professional_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '专业人士评论表自增id',
  `professional_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `professional_comment_pid` bigint(20) NOT NULL COMMENT '专业人士id',
  `professional_comment_content` text NOT NULL COMMENT '内容',
  `professional_comment_zans` int(10) NOT NULL COMMENT '点赞数',
  `professional_comment_zaner` text COMMENT '点赞人',
  `professional_comment_reply` text COMMENT '回复',
  `professional_comment_createtime` datetime NOT NULL COMMENT '发表时间',
  `professional_comment_replytime` datetime DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`professional_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='专业人士评论表';

-- ----------------------------
-- Records of j_professional_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `j_professional_vi`
-- ----------------------------
DROP TABLE IF EXISTS `j_professional_vi`;
CREATE TABLE `j_professional_vi` (
  `professional_vi_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '专业人士图片表自增id',
  `professional_vi_pid` bigint(20) NOT NULL COMMENT '专业人士id',
  `professional_vi_url` varchar(255) NOT NULL COMMENT '路径',
  `professional_vi_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`professional_vi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='专业人士图片表';

-- ----------------------------
-- Records of j_professional_vi
-- ----------------------------
INSERT INTO `j_professional_vi` VALUES ('1', '2', '2018-06-11/5b1e33c0182ec.jpg', '0');

-- ----------------------------
-- Table structure for `j_works`
-- ----------------------------
DROP TABLE IF EXISTS `j_works`;
CREATE TABLE `j_works` (
  `works_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '工作职位表自增id',
  `works_uid` bigint(20) NOT NULL COMMENT '发布者id',
  `works_type` smallint(1) NOT NULL DEFAULT '1' COMMENT '工作类型，1为全职，2为兼职，3为实习',
  `works_position` varchar(255) NOT NULL COMMENT '职位',
  `works_minmoney` varchar(255) NOT NULL COMMENT '薪资最小值',
  `works_maxmoney` varchar(255) NOT NULL COMMENT '薪资最大值',
  `works_years` varchar(255) NOT NULL COMMENT '工作年限',
  `works_school` varchar(255) NOT NULL COMMENT '毕业院校',
  `works_degree` varchar(255) NOT NULL COMMENT '学位',
  `works_specialty` varchar(255) NOT NULL COMMENT '专业',
  `works_company_name` varchar(255) NOT NULL COMMENT '公司名称',
  `works_company_nature` int(10) NOT NULL COMMENT '公司性质，1为民营，2为国营',
  `works_company_type` int(10) NOT NULL COMMENT '工作类型，目前1为互联网，2为金融投资，3为教育',
  `works_company_size` varchar(255) NOT NULL COMMENT '公司规模',
  `works_company_mail` varchar(255) NOT NULL COMMENT '接收简历邮箱',
  `works_company_content` text COMMENT '公司信息',
  `works_isnegotiable` smallint(1) NOT NULL COMMENT '是否接受面议1，0为否，1为是',
  `works_views` bigint(20) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `works_isclose` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否关闭，0为关闭，1为未关闭',
  `works_isdel` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否删除，0为已删除，1为未删除',
  `works_updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  `works_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`works_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='工作职位表';

-- ----------------------------
-- Records of j_works
-- ----------------------------
INSERT INTO `j_works` VALUES ('1', '7', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '1', '1', null, '2018-05-31 11:09:47');
INSERT INTO `j_works` VALUES ('2', '7', '1', '工作名称', '最小工资', '最大工资', '年限', '学校', '学位', '专业', '公司名称', '1', '1', '规模', '邮箱', '信息', '0', '0', '1', '1', null, '2018-05-31 11:12:09');
INSERT INTO `j_works` VALUES ('3', '7', '1', '工作2', '2000', '4000', '2', '学校2', '学位2', '专业2', '公司2', '1', '2', '规模2', '游戏2', '欣喜2', '0', '0', '1', '1', null, '2018-05-31 11:36:12');

-- ----------------------------
-- Table structure for `j_works_company_type`
-- ----------------------------
DROP TABLE IF EXISTS `j_works_company_type`;
CREATE TABLE `j_works_company_type` (
  `works_company_type_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '工作的公司类型表自增id',
  `works_company_type_name` varchar(255) NOT NULL COMMENT '名称',
  `works_company_type_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `works_company_type_updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  `works_company_type_createtime` datetime NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`works_company_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='工作的公司类型表';

-- ----------------------------
-- Records of j_works_company_type
-- ----------------------------
INSERT INTO `j_works_company_type` VALUES ('1', 'internet', '0', null, '2018-05-31 11:34:02');
INSERT INTO `j_works_company_type` VALUES ('2', 'finance', '0', null, '2018-05-31 11:34:11');
INSERT INTO `j_works_company_type` VALUES ('3', 'education', '0', null, '2018-05-31 11:34:19');

-- ----------------------------
-- Table structure for `l_commodity`
-- ----------------------------
DROP TABLE IF EXISTS `l_commodity`;
CREATE TABLE `l_commodity` (
  `commodity_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '商品表自增id',
  `commodity_uid` bigint(20) NOT NULL COMMENT '用户id',
  `commodity_name` varchar(255) NOT NULL COMMENT '商品名称',
  `commodity_price` varchar(255) NOT NULL COMMENT '商品价格',
  `commodity_uname` varchar(255) NOT NULL COMMENT '联系人',
  `commodity_contact` varchar(255) NOT NULL COMMENT '联系方式',
  `commodity_category` int(10) NOT NULL COMMENT '类型',
  `commodity_content` text NOT NULL COMMENT '介绍',
  `commodity_img` varchar(255) NOT NULL COMMENT '图片',
  `commodity_explain` text COMMENT '备注',
  `commodity_status` int(10) NOT NULL DEFAULT '1' COMMENT '状态，0为已删除，1为正常，2为已完成',
  `commodity_firstmark` varchar(255) DEFAULT NULL COMMENT '第一标识字符串',
  `commodity_secondmark` varchar(255) DEFAULT NULL COMMENT '第二标识字符串',
  `commodity_thirdmark` varchar(255) DEFAULT NULL COMMENT '第三标识字符串',
  `commodity_fourthmark` varchar(255) DEFAULT NULL COMMENT '第四标识字符串',
  `commodity_fifthmark` varchar(255) DEFAULT NULL COMMENT '第五标识字符串',
  `commodity_createtime` datetime NOT NULL COMMENT '发布时间',
  `commodity_updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`commodity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='商品表';

-- ----------------------------
-- Records of l_commodity
-- ----------------------------
INSERT INTO `l_commodity` VALUES ('1', '7', '1', '1', '1', '1', '19', '1', '2018-06-08/5b1a1c3b53109.jpg', null, '1', '8,9,10,11,12', '21,23,25,19', '', '', null, '2018-06-08 14:03:39', null);
INSERT INTO `l_commodity` VALUES ('2', '7', '商品', '1222', '联系人', '联系方式', '20', '这是个商品', '2018-06-08/5b1a1cc7972f8.jpg', null, '1', '8,9,10,11,12', '22,24,26,20', '', '', null, '2018-06-08 14:05:59', null);
INSERT INTO `l_commodity` VALUES ('3', '7', '撒旦', '1', '飒沓', '1', '20', '1111', '2018-06-08/5b1a28b86caa9.jpg', null, '1', '8,9,10,11,12', '21,23,25,20', '', '', null, '2018-06-08 14:56:56', '2018-06-08 14:56:56');
INSERT INTO `l_commodity` VALUES ('4', '7', 'vvx', '22', '擦发', 'acacia', '20', 'cave', '2018-06-08/5b1a28d1541c9.jpg', null, '1', '8,9,10,11,12', '21,23,26,20', '', '', null, '2018-06-08 14:57:21', '2018-06-08 14:57:21');
INSERT INTO `l_commodity` VALUES ('5', '7', '阿斯达', 'asdas', '撒大声地', '11', '19', '查查', '2018-06-08/5b1a290a13f66.jpg', null, '1', '8,9,10,11,12', '22,24,25,19', '', '', null, '2018-06-08 14:58:18', '2018-06-08 14:58:18');
INSERT INTO `l_commodity` VALUES ('6', '7', '1', '1', '1', '1', '19', '1', '2018-06-10/5b1cef5328eab.jpg', null, '1', '8,9,10,11,12', '21,23,25,19', '', '', null, '2018-06-10 17:28:51', '2018-06-10 17:28:51');
INSERT INTO `l_commodity` VALUES ('7', '9', 'Computer', '3000', 'Mr.Chen', 'csuchenpeng@foxmail.com', '20', 'Stronger Config', '2018-06-10/5b1cef72c0b9b.png', null, '1', '8,9,10,11,12', '22,23,25,20', '', '', null, '2018-06-10 17:29:22', '2018-06-10 17:29:22');
INSERT INTO `l_commodity` VALUES ('8', '7', '1', '1', '1', '1', '19', '1', '2018-06-10/5b1cef9e241ab.jpg', null, '1', '8,9,10,11,12', '21,23,25,19', '', '', null, '2018-06-10 17:30:06', '2018-06-10 17:30:06');
INSERT INTO `l_commodity` VALUES ('9', '9', 'Iphone6', '2000', 'Mis.Sheng', '692207040@qq.com', '20', 'The machine is 90% nice, you can take it as soon as quckily.', '2018-06-10/5b1cf04a1c407.jpg', null, '1', '8,9,10,11,12', '21,23,25,20', '', '', null, '2018-06-10 17:32:58', '2018-06-10 17:32:58');

-- ----------------------------
-- Table structure for `l_commodity_collect`
-- ----------------------------
DROP TABLE IF EXISTS `l_commodity_collect`;
CREATE TABLE `l_commodity_collect` (
  `commodity_collect_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '商品收藏表自增id',
  `commodity_collect_uid` bigint(20) NOT NULL COMMENT '用户id',
  `commodity_collect_cid` bigint(20) NOT NULL COMMENT '商品id',
  `commodity_collect_createtime` datetime NOT NULL COMMENT '收藏时间',
  PRIMARY KEY (`commodity_collect_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品收藏表';

-- ----------------------------
-- Records of l_commodity_collect
-- ----------------------------

-- ----------------------------
-- Table structure for `l_commodity_comment`
-- ----------------------------
DROP TABLE IF EXISTS `l_commodity_comment`;
CREATE TABLE `l_commodity_comment` (
  `commodity_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '商品评论表自增id',
  `commodity_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `commodity_comment_cid` bigint(20) NOT NULL COMMENT '商品id',
  `commodity_comment_content` text NOT NULL COMMENT '内容',
  `commodity_comment_zans` int(10) NOT NULL COMMENT '点赞数',
  `commodity_comment_zaner` text COMMENT '点赞人',
  `commodity_comment_reply` text COMMENT '回复',
  `commodity_comment_createtime` datetime NOT NULL COMMENT '创建时间',
  `commodity_comment_replytime` datetime DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`commodity_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品评论表';

-- ----------------------------
-- Records of l_commodity_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `piano_admin`
-- ----------------------------
DROP TABLE IF EXISTS `piano_admin`;
CREATE TABLE `piano_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(55) NOT NULL DEFAULT '' COMMENT '账号',
  `pwd` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `role` enum('1','2','3') DEFAULT '1' COMMENT '身份：1总部，2代理商，3分销商',
  `m_pid` text NOT NULL COMMENT '父级菜单id',
  `m_cid` text NOT NULL COMMENT '权限菜单id',
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(255) DEFAULT NULL,
  `juese` enum('1','2') NOT NULL DEFAULT '1' COMMENT '角色：1超级管理员，2普通管理员',
  `card` varchar(20) NOT NULL DEFAULT '' COMMENT '身份证号',
  `fzr_name` varchar(50) DEFAULT NULL COMMENT '负责人姓名',
  `mobile` varchar(15) NOT NULL DEFAULT '' COMMENT '联系电话',
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '状态：1启用，2禁用',
  `careater_username` varchar(55) DEFAULT '0' COMMENT '创建人账号',
  `add_time` datetime DEFAULT NULL,
  `jx_jigou` int(11) NOT NULL DEFAULT '0' COMMENT '所属经销机构id,取值dealers表jxid',
  PRIMARY KEY (`aid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=100082 DEFAULT CHARSET=gbk COMMENT='后台管理员表';

-- ----------------------------
-- Records of piano_admin
-- ----------------------------
INSERT INTO `piano_admin` VALUES ('100078', 'xinyl', '3e4525212f931ae78103bd4954244ea6', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', '101,102,103,201,301,401,501,601,701,801,901,1001,1101,1201,1202,1301,1401,1501,1601,1701', '2018-06-19 15:07:17', '127.0.0.1', '1', '', '梁永鑫', '15767106280', '1', '0', '2018-04-23 18:14:23', '0');
INSERT INTO `piano_admin` VALUES ('100079', 'ceshi', 'f71561e30ce30c28ebf9976884b319ae', '1', '1', '102', '2018-06-19 15:04:28', '127.0.0.1', '2', '', 'ceshi', '13712345678', '1', 'xinyl', '2018-04-23 18:17:54', '0');
INSERT INTO `piano_admin` VALUES ('100080', 'ltp', '3e4525212f931ae78103bd4954244ea6', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', '102,201,301,401,501,601,701,801,901,1001,1101,1201,1202,1301,1401,1501,1601,1701', '2018-06-25 09:05:25', '::1', '2', '', 'ltp', '13712345678', '1', 'xinyl', '2018-06-19 15:06:01', '0');
INSERT INTO `piano_admin` VALUES ('100081', 'admin', '3e4525212f931ae78103bd4954244ea6', '1', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17', '102,201,301,401,501,601,701,801,901,1001,1101,1201,1202,1301,1401,1501,1601,1701', '2018-06-20 15:07:58', '::1', '2', '', 'admin', '13712345678', '1', 'xinyl', '2018-06-19 15:06:39', '0');

-- ----------------------------
-- Table structure for `piano_admin_menu`
-- ----------------------------
DROP TABLE IF EXISTS `piano_admin_menu`;
CREATE TABLE `piano_admin_menu` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `m_name` varchar(30) NOT NULL DEFAULT '' COMMENT '菜单名',
  `m_url` varchar(60) DEFAULT '' COMMENT '菜单链接',
  `m_parentid` int(11) NOT NULL DEFAULT '0' COMMENT '菜单父id，0未顶级才菜单',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=1702 DEFAULT CHARSET=gbk COMMENT='权限菜单表';

-- ----------------------------
-- Records of piano_admin_menu
-- ----------------------------
INSERT INTO `piano_admin_menu` VALUES ('1', '权限管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('2', '用户管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('3', '模块简介管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('4', '搜索标识管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('5', '捐款记录', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('6', '信息管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('7', '群组管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('8', '建议管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('9', '帖子管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('10', '问答管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('11', '资源管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('12', '简历管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('13', '项目管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('14', '专业人士管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('15', '新闻管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('16', '广告管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('17', '商品管理', '', '0');
INSERT INTO `piano_admin_menu` VALUES ('101', '个人信息', 'index.php?m=Admin&c=User&a=my_info', '-1');
INSERT INTO `piano_admin_menu` VALUES ('102', '管理员列表', 'index.php?m=Admin&c=Conf&a=admin_list', '1');
INSERT INTO `piano_admin_menu` VALUES ('103', 'app版本', 'index.php?m=Admin&c=Conf&a=show_app_list', '-1');
INSERT INTO `piano_admin_menu` VALUES ('201', '用户列表', 'index.php?m=Admin&c=User&a=user_list', '2');
INSERT INTO `piano_admin_menu` VALUES ('301', '模块简介管理', 'index.php?m=Admin&c=Module&a=module_list', '3');
INSERT INTO `piano_admin_menu` VALUES ('401', '搜索标识管理', 'index.php?m=Admin&c=Mark&a=interst_list', '4');
INSERT INTO `piano_admin_menu` VALUES ('501', '捐款记录', 'index.php?m=Admin&c=Donation&a=donation_list', '5');
INSERT INTO `piano_admin_menu` VALUES ('601', '信息管理', 'index.php?m=Admin&c=Message&a=message_list', '6');
INSERT INTO `piano_admin_menu` VALUES ('701', '群组管理', 'index.php?m=Admin&c=Crowd&a=crowd_list', '7');
INSERT INTO `piano_admin_menu` VALUES ('801', '建议管理', 'index.php?m=Admin&c=Proposal&a=proposal_list', '8');
INSERT INTO `piano_admin_menu` VALUES ('901', '帖子管理', 'index.php?m=Admin&c=Note&a=list', '9');
INSERT INTO `piano_admin_menu` VALUES ('1001', '问答管理', 'index.php?m=Admin&c=Question&a=list', '10');
INSERT INTO `piano_admin_menu` VALUES ('1101', '资源管理', 'index.php?m=Admin&c=Resource&a=list', '11');
INSERT INTO `piano_admin_menu` VALUES ('1201', '简历管理', 'index.php?m=Admin&c=Resume&a=list', '12');
INSERT INTO `piano_admin_menu` VALUES ('1202', '发布职位管理', 'index.php?m=Admin&c=Work&a=list', '12');
INSERT INTO `piano_admin_menu` VALUES ('1301', '项目管理', 'index.php?m=Admin&c=Item&a=item_list', '13');
INSERT INTO `piano_admin_menu` VALUES ('1401', '专业人士管理', 'index.php?m=Admin&c=Professional&a=professional_list', '14');
INSERT INTO `piano_admin_menu` VALUES ('1501', '新闻轮播管理', 'index.php?m=Admin&c=New&a=new_list', '15');
INSERT INTO `piano_admin_menu` VALUES ('1601', '侧栏广告管理', 'index.php?m=Admin&c=Advertising&a=list', '16');
INSERT INTO `piano_admin_menu` VALUES ('1701', '商品管理', 'index.php?m=Admin&c=Commodity&a=list', '17');

-- ----------------------------
-- Table structure for `piano_app`
-- ----------------------------
DROP TABLE IF EXISTS `piano_app`;
CREATE TABLE `piano_app` (
  `app_id` int(11) NOT NULL AUTO_INCREMENT,
  `app_url` varchar(255) NOT NULL DEFAULT '' COMMENT '版本地址',
  `app_name` varchar(255) NOT NULL DEFAULT '' COMMENT '版本名',
  `app_time` datetime NOT NULL COMMENT '版本上传时间',
  `app_num` varchar(255) NOT NULL,
  `app_info` text NOT NULL,
  `app_type` enum('1','2') NOT NULL COMMENT '1强制更新  2推荐更新',
  `app_kind` enum('1','2') NOT NULL COMMENT '1平板  2手机',
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk COMMENT='app版本';

-- ----------------------------
-- Records of piano_app
-- ----------------------------

-- ----------------------------
-- Table structure for `piano_token`
-- ----------------------------
DROP TABLE IF EXISTS `piano_token`;
CREATE TABLE `piano_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `t_userid` int(11) NOT NULL DEFAULT '0' COMMENT '登陆用户id',
  `t_token` varchar(32) NOT NULL DEFAULT '' COMMENT 'token字符串',
  `t_shebei` varchar(100) NOT NULL DEFAULT '' COMMENT '登陆设备号',
  `t_leixin` enum('1','2') NOT NULL DEFAULT '1' COMMENT '设备类型：1安卓，2苹果',
  `t_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4081 DEFAULT CHARSET=gbk COMMENT='登陆token';

-- ----------------------------
-- Records of piano_token
-- ----------------------------
INSERT INTO `piano_token` VALUES ('2704', '101208', 'fa9e45c4ea44b8e3845eac07ed21058e', '1a3c73c3dc96f260940a348d66e21b04', '2', '1499516467');
INSERT INTO `piano_token` VALUES ('2706', '101209', '7c70719e1afbff7f1af8e8a449fa0c04', 'ce55bbf3e99007e33f726ae54dbde492', '2', '1499574008');
INSERT INTO `piano_token` VALUES ('2707', '101210', '9d5ade0255f03c55410b560a45ab0129', '862860038943621', '1', '1499581050');
INSERT INTO `piano_token` VALUES ('2708', '101211', '0d8cc5b9856f76d74efde95924eb9645', 'f33dbf29d0fe82e9cfd7e7da14fac4fa', '2', '1499581092');
INSERT INTO `piano_token` VALUES ('2709', '101212', '3e8e840043ad0b6a423332b8b0eede10', '357557097576423', '1', '1499585670');
INSERT INTO `piano_token` VALUES ('2710', '101213', '9ff9b96a0af7ccd57350703e92e79384', '864341037838482', '1', '1499588289');
INSERT INTO `piano_token` VALUES ('2711', '101214', '43d4279964b987f2ae80a2b124bdd6a1', '0396be3e745b44cc2580426169f08d63', '2', '1499591262');
INSERT INTO `piano_token` VALUES ('2712', '101215', '1aefb5678b5aedeaa6ca30f9c683acbc', 'c16c5db845d1b5b788652e2823e49d2e', '2', '1499594862');
INSERT INTO `piano_token` VALUES ('2714', '101216', '0aefe658129f08dea81934a183ed6bcb', '863523035821708', '1', '1499598525');
INSERT INTO `piano_token` VALUES ('2716', '101217', 'a82c24032d0738df72f014bed735f147', '861404037321512', '1', '1499603369');
INSERT INTO `piano_token` VALUES ('2717', '101218', '417aebd6f9d48f3684302e024b1aa2e4', '4819deec31f8847a9a02a4df4fee05fc', '2', '1499603416');
INSERT INTO `piano_token` VALUES ('2718', '101219', '9676ea4e2af8ac118eac1266b63abba5', '868404023272060', '1', '1499603567');
INSERT INTO `piano_token` VALUES ('2719', '101220', 'c41602cd7419a270702b53ac9da14b49', '862107032794984', '1', '1499604240');
INSERT INTO `piano_token` VALUES ('2720', '101221', '8ef5e1decd0f3709cf48425fdb4cddd8', '863410032711423', '1', '1499604625');
INSERT INTO `piano_token` VALUES ('2721', '101222', '98ea5139f65d644c025aa48d00b25024', '2542a524745d1db163a7ca1f10f0afe3', '2', '1499605317');
INSERT INTO `piano_token` VALUES ('2722', '101223', '3cf958fee8701d0e23d45c9a5a0b9c65', '9d5974106f3a1e1c845709d5b1100ddd', '2', '1499605929');
INSERT INTO `piano_token` VALUES ('2723', '101224', 'dee3fae1df29f64fd17a889eabb8130b', '866568024106295', '1', '1499608169');
INSERT INTO `piano_token` VALUES ('2724', '101225', '908a2a4ba7366921d327e057d5e10524', '863952031490459', '1', '1499610825');
INSERT INTO `piano_token` VALUES ('2725', '101226', 'ced4b01dc018969fa305eef4e35c6abc', 'b9f59f416b4c1b5bc34cb35f41551e58', '2', '1499613288');
INSERT INTO `piano_token` VALUES ('2729', '101227', '2500567032bbc0145cd5f9350fb57e9d', '867694020719482', '1', '1499650744');
INSERT INTO `piano_token` VALUES ('2731', '101127', 'c6367db2d98c4bad6d2d1aa681ac358f', '8d6fc122282f113ce2b1b08acf63957c', '2', '1499650869');
INSERT INTO `piano_token` VALUES ('2732', '101228', 'cc3c12f5bed20626d356fda0be9c03d7', '862503034662999', '1', '1499652308');
INSERT INTO `piano_token` VALUES ('2734', '101229', '8398984b94250c63331fa464940bad86', '5e0096510b5d84758b6a1db6e6493c8c', '2', '1499652744');
INSERT INTO `piano_token` VALUES ('2735', '101230', '9806da7823fbb7b2f2f8551e2e93d7ab', '863335034273157', '1', '1499655405');
INSERT INTO `piano_token` VALUES ('2736', '100757', '4fed765fcf91aad0ff662e39eb6079d0', '359723060523648', '1', '1499658719');
INSERT INTO `piano_token` VALUES ('2738', '101231', '83dc38883adf939211687447ca127688', '76c062049a22446a19186a5a32dd955a', '2', '1499659396');
INSERT INTO `piano_token` VALUES ('2739', '101232', '21d6e82c5b56728ee2e2720a1c604c3a', '865586021162427', '1', '1499659770');
INSERT INTO `piano_token` VALUES ('2740', '101203', 'f9b236184a4e055a19eef775437fd400', '865939033198527', '1', '1501242044');
INSERT INTO `piano_token` VALUES ('2741', '101233', '9bea44e2d77c4e009edcc52991b412c1', 'c20717790d822f551f9c91bd2186c9d9', '2', '1499661806');
INSERT INTO `piano_token` VALUES ('2742', '101234', 'f93b505fae03dbab70165fc8abcce1ec', '867064028156550', '1', '1499662507');
INSERT INTO `piano_token` VALUES ('2743', '101235', '79a37914d4b46dc82844b32af2881105', '862756037700485', '1', '1499664364');
INSERT INTO `piano_token` VALUES ('2744', '101236', 'd91f9136db6e445a6469839fae2d60cc', '861643032344744', '1', '1499665040');
INSERT INTO `piano_token` VALUES ('2746', '101237', '230a105f4815d9adb4da659d1f2bcd67', '869488025918811', '1', '1499668685');
INSERT INTO `piano_token` VALUES ('2747', '101239', 'f1e5691ac8f4f0de05242e684f49affc', '867352023606947', '1', '1499668828');
INSERT INTO `piano_token` VALUES ('2748', '101238', '02dad08ca9574e715c2792959304058e', 'b76b27be3cd3f46d9fe04d6b7c28a87e', '2', '1499668858');
INSERT INTO `piano_token` VALUES ('2749', '101240', '912af8caf6c1555ae2957214363b5e6c', 'NYXDU16B04001600', '1', '1499669246');
INSERT INTO `piano_token` VALUES ('2753', '101243', '52aae0bcdbb11d5b06f5c5214689d512', '862966037110433', '1', '1499673146');
INSERT INTO `piano_token` VALUES ('2757', '101244', '33910325c4c706f60fe4a8d837e8d127', '867689025006513', '1', '1499679602');
INSERT INTO `piano_token` VALUES ('2759', '101245', '1abb177d0b16217e605b5b8e746471aa', '864251030011336', '1', '1499679831');
INSERT INTO `piano_token` VALUES ('2760', '101246', '0c2de8cc089e741350ce3218603cdc44', '869917025195210', '1', '1499680162');
INSERT INTO `piano_token` VALUES ('2762', '101247', 'e7424d88c588d57172d3e23585dbd49e', '862460033159925', '1', '1499680786');
INSERT INTO `piano_token` VALUES ('2764', '101248', '1cbb85f29b488f9125a29dcdcf200526', 'c16dbb3e7274f0518e9ef470822f0e17', '2', '1499681094');
INSERT INTO `piano_token` VALUES ('2765', '101249', 'a061dcd289be6ef367a8aaf4ed16f387', '866642021205994', '1', '1499682040');
INSERT INTO `piano_token` VALUES ('2769', '101251', 'b748f740f50c66e9e283e0555079a201', '99000871432424', '1', '1499689293');
INSERT INTO `piano_token` VALUES ('2770', '101252', '22f392dd24971814b820344da33d26cd', '11182f02249eb729822ee398706c889b', '2', '1499694245');
INSERT INTO `piano_token` VALUES ('2771', '101253', '4f728c661bc6f79886f522ca96af4951', 'df35f12247e3a9ee466148174bebf1a8', '2', '1499727249');
INSERT INTO `piano_token` VALUES ('2772', '101254', 'a724a1e88e2b5809e8bd5e5173129879', 'ed8ec30e3f364070db4f11985d1b2b4c', '2', '1499731204');
INSERT INTO `piano_token` VALUES ('2773', '101255', '1aff10aac3dc20c66aa46a3ca1035aab', '862591036480577', '1', '1499731848');
INSERT INTO `piano_token` VALUES ('2776', '101256', 'db7e9302ee4cf508f2b92a15395ca7b2', '863793035569173', '1', '1499739876');
INSERT INTO `piano_token` VALUES ('2780', '100405', '60a710e71e73319878376be2b3dfeff5', 'e50ea74d6e90ef394a07ad9287298810', '2', '1499756686');
INSERT INTO `piano_token` VALUES ('2783', '101258', 'de04ab45b96f6e58a91376c01ab39af0', 'cd7e55ba176bb643bc13a8ce420fbb75', '2', '1499757166');
INSERT INTO `piano_token` VALUES ('2784', '100303', '2f8855169290b43319e7999854a5ee89', 'e1de8aaaa2619e4a208b6479c4a1d377', '2', '1502637639');
INSERT INTO `piano_token` VALUES ('2786', '101259', '208239eb72738523733bb5e78ae8abe7', '42d778eeaba78c0', '1', '1499759177');
INSERT INTO `piano_token` VALUES ('2788', '101262', 'e5a8d4aa7db2d83c6dbfe440630697d6', '99000712292850', '1', '1499761048');
INSERT INTO `piano_token` VALUES ('2789', '101263', '1fdc94a55f11e9f183ff299ca2815276', '862187036647321', '1', '1499762094');
INSERT INTO `piano_token` VALUES ('2790', '101264', '33b2ea3086f4bd07c71fc30990cf17e1', '862734036457555', '1', '1499762120');
INSERT INTO `piano_token` VALUES ('2792', '101265', '5f8b6e2f162d5ebab6918a891929e00b', '862230038855219', '1', '1499763111');
INSERT INTO `piano_token` VALUES ('2795', '101266', 'b1e763d897b7805aade4fbaa6884458e', 'e51ee4b7b78045d09604414a52f9d416', '2', '1499765253');
INSERT INTO `piano_token` VALUES ('2800', '101267', 'ea660f13b9a6c34455b8022369b1c49b', 'd67959c04fdd50daf35991bd4527a2bc', '2', '1499769311');
INSERT INTO `piano_token` VALUES ('2802', '101268', '2127b8c6c84829686389b0171da436f9', '3399aad4818d48deadada5779e71e083', '2', '1499773645');
INSERT INTO `piano_token` VALUES ('2803', '101269', '4b349a6d6b82438c75a09d9a8aaa844d', '329c8dafb5494a4dd20b7c2a051b607d', '2', '1499774275');
INSERT INTO `piano_token` VALUES ('2804', '101270', '18089d2fa35466306bd8e0291a25b997', '8502d5aa48f30480049433556996081a', '2', '1499776009');
INSERT INTO `piano_token` VALUES ('2805', '101241', '0ace21f4f8abf3bec345e08409c6d563', '864728030797089', '1', '1500368216');
INSERT INTO `piano_token` VALUES ('2806', '101271', '60f767ba755ec8dbb3d19dada31dadfd', '869402029105648', '1', '1499784529');
INSERT INTO `piano_token` VALUES ('2807', '101272', 'bec25d47a3544f9fb1d4e369bb78f183', 'a286ece1dd6648c242847bac6cdb0eef', '2', '1499794426');
INSERT INTO `piano_token` VALUES ('2820', '101273', 'b83648f6c7be32e8b2e52d409ce03e3e', '862950039532976', '1', '1499825000');
INSERT INTO `piano_token` VALUES ('2821', '101274', 'aacc49031cf1eab184b9c1b72d7bc565', '864087035230095', '1', '1499825662');
INSERT INTO `piano_token` VALUES ('2823', '101275', '77f8e2c60d656d9ed66706c6a7104aac', 'f8fbf02ace4e443572252c3a2317b4e5', '2', '1500341821');
INSERT INTO `piano_token` VALUES ('2824', '101089', '0783115c8a0186f413814e3bd13a2118', '865936037081519', '1', '1501893078');
INSERT INTO `piano_token` VALUES ('2826', '101276', '3edd9225962fef02804bc89e733cc700', '2d9ac4be90ca4da71f968a8a376cccf5', '2', '1499830678');
INSERT INTO `piano_token` VALUES ('2833', '101277', 'e84671548bbdf617a35244273facf62c', 'c461bf13250a1993f3f950ce619826c5', '2', '1501677142');
INSERT INTO `piano_token` VALUES ('2837', '101279', 'dca1c684d3f0dc4faf1c6a39af736fe8', '355066063581468', '1', '1499838736');
INSERT INTO `piano_token` VALUES ('2851', '101280', '91926ce8b3143200fc8aaaf7c2fb02cc', '862813030696531', '1', '1499845753');
INSERT INTO `piano_token` VALUES ('2853', '101281', '5c7ab1247b9bc673f5ee2d79ebfd3706', 'db775579ad66c7bb07ded1bd6c9bd5cc', '2', '1499846039');
INSERT INTO `piano_token` VALUES ('2855', '101282', '1c4b47d7d8d0c101998f7f73f6c55e39', 'e18a51cc73d687f11c7bbfec20d6d62e', '2', '1499847333');
INSERT INTO `piano_token` VALUES ('2857', '101283', 'e0ecd4e1c6d6361fd36811b67fe5b68c', '864821032306148', '1', '1499849981');
INSERT INTO `piano_token` VALUES ('2859', '101278', 'cd202a8bc5733ad0344723636fcd5039', 'af2600b72920e4d8632fe421c9c2627b', '2', '1499853870');
INSERT INTO `piano_token` VALUES ('2860', '101284', '68dc9d9d569f59e982907cd60cbac1c5', '23ba57697496483b5d5de0f55a382fa6', '2', '1501581682');
INSERT INTO `piano_token` VALUES ('2866', '101285', 'd58032f0e05d38eb1f05f6f0a7c79697', '865320033112885', '1', '1499860176');
INSERT INTO `piano_token` VALUES ('2867', '101287', '9c4fc1e743a646a647ac8ff7d0ec5720', '862245033408657', '1', '1499860352');
INSERT INTO `piano_token` VALUES ('2868', '101286', '5c7300455b8f4754ce64c656c838869b', 'A00000716A9E79', '1', '1499860361');
INSERT INTO `piano_token` VALUES ('2869', '101147', 'fb4c6bd45108f08994bdc055fbff9f6f', '02ef6b6b76ba35a5448da0e50c87c1c5', '2', '1499862129');
INSERT INTO `piano_token` VALUES ('2872', '101288', 'f3fb25f0e01b4430cd0d9333dcf94bc7', '863793037187891', '1', '1499865071');
INSERT INTO `piano_token` VALUES ('2873', '101289', '0e0ec6f05666ee28da3e659a20c4c407', '356156075940023', '1', '1499865091');
INSERT INTO `piano_token` VALUES ('2874', '101290', 'ebe2a9bdef64bc3ad645316d6378eac6', '869953025446238', '1', '1499867555');
INSERT INTO `piano_token` VALUES ('2875', '101291', 'd45de81eb9861a8075a6f87e91a4418b', 'b75585ed6a800ee055a61b497975a2f7', '2', '1499867628');
INSERT INTO `piano_token` VALUES ('2876', '101292', 'bd261ed4cecf48ac42f608d779300ed6', '90e61cdeb98c9e997ee1ebf3a8057764', '2', '1499869257');
INSERT INTO `piano_token` VALUES ('2884', '101293', '408bd5dee008c42326dd097733062f6f', '5f5f5333e4460a360c3110eda1d41d67', '2', '1499915879');
INSERT INTO `piano_token` VALUES ('2886', '101294', 'c17eba6b1ce83779f56fd6d36e721b28', '865630023946781', '1', '1499922739');
INSERT INTO `piano_token` VALUES ('2889', '101295', '2c298e3b7e63ee4c8d6ec8c11d070c9b', '866963022256285', '1', '1499925121');
INSERT INTO `piano_token` VALUES ('2909', '101296', 'eafd4ffc8bfaa5e22fde351380fb480a', '860947033720450', '1', '1499933504');
INSERT INTO `piano_token` VALUES ('2911', '100677', '3515c527d71a65da59bb910c2a49fce1', '861543031823591', '1', '1501899375');
INSERT INTO `piano_token` VALUES ('2912', '101297', '125675b412dd48714de658365d2efb4e', '869011021401812', '1', '1499936148');
INSERT INTO `piano_token` VALUES ('2915', '101298', '30d7917904885025c3d022f4f1a8a446', 'a000004fde7799', '1', '1499939467');
INSERT INTO `piano_token` VALUES ('2919', '101299', 'c4edeaca99375fb3572826346d851196', '90ba798bb835b021e8d56704e1979434', '2', '1499941690');
INSERT INTO `piano_token` VALUES ('2923', '101300', '7a25158e96d2dc12ce8534f1620565fb', '6b458a57f38e0bf0ce8ef224796575ec', '2', '1499943417');
INSERT INTO `piano_token` VALUES ('2928', '101301', '8ca1ad58ee08c305bb24430264ee9b0b', 'ea77a5d28b632b6a11cc1431f6bc7d41', '2', '1499946211');
INSERT INTO `piano_token` VALUES ('2930', '101302', '201c048feaf19c5bacd5de23d3e50910', '355384061624275', '1', '1499946356');
INSERT INTO `piano_token` VALUES ('2931', '101303', 'b4e1911687946c6e689228759e6a139a', 'c90cff3f99754da5480970d538bde1be', '2', '1499946724');
INSERT INTO `piano_token` VALUES ('2933', '101304', '7de4c5e19b13067a1b74769515194ec5', '867436024176230', '1', '1499949417');
INSERT INTO `piano_token` VALUES ('2936', '101305', 'ba9c6fb02c0e92717d9cb37901e70855', '4869cc49406126b918e96d1fc34a6ae5', '2', '1499950578');
INSERT INTO `piano_token` VALUES ('2937', '101306', '87201ee4b730d2d0e5c189349e59bbbb', '136f8836afc7d37c580c2321e281979e', '2', '1499953429');
INSERT INTO `piano_token` VALUES ('2938', '101307', '8c1bf130c55742050f65e380e7e2f716', '863444038124851', '1', '1499954307');
INSERT INTO `piano_token` VALUES ('2939', '101308', '129e5f87f33791dbe46418c1628b23c8', '70de11c350e15c299d57352953336545', '2', '1499955865');
INSERT INTO `piano_token` VALUES ('2940', '101309', 'c296588c2003713029cd000d89ecd90e', '863454036758857', '1', '1499956430');
INSERT INTO `piano_token` VALUES ('2941', '101310', 'c849d77a32557a5402795c18b61883cf', '861617035313088', '1', '1499958562');
INSERT INTO `piano_token` VALUES ('2942', '101311', 'c8f4acc0bdf8b79c9a02c96f97be0432', '864743033430539', '1', '1499990557');
INSERT INTO `piano_token` VALUES ('2943', '101250', '769c0b8851cfbedb20759201023dd166', '865647023999263', '1', '1499991141');
INSERT INTO `piano_token` VALUES ('2945', '101312', '6db32d01ade11116bca0ea1ec9141ea8', '868964023895194', '1', '1499994385');
INSERT INTO `piano_token` VALUES ('2951', '101313', 'eaa98f0cc7dcd4d57ef4fd5dedda70f2', '867993021961626', '1', '1500001642');
INSERT INTO `piano_token` VALUES ('2954', '101314', '39057752d2f46493c370a4ad839969da', 'd67f31df65cab6f5f39aa28758816092', '2', '1500005634');
INSERT INTO `piano_token` VALUES ('2955', '101315', '32eef219ad712c0e3bf3c30cd17ff252', '869161025517525', '1', '1500006962');
INSERT INTO `piano_token` VALUES ('2961', '101316', 'fca37e1c73ab824898882c54bde278a3', '862187037810688', '1', '1500011682');
INSERT INTO `piano_token` VALUES ('2966', '101317', 'e0bc0fc0f67ee119adbfb24a627efdae', '589857f7cba3d1a5', '1', '1500013990');
INSERT INTO `piano_token` VALUES ('2968', '101242', 'c6625f06a74c52049ca78623baa1c04a', '864678030783078', '1', '1500014499');
INSERT INTO `piano_token` VALUES ('2971', '101318', '394ee9bf70d44fe0cecf58b9abdb8705', 'fd14a1f3eda31534b5854d5c4aac0e34', '2', '1500016992');
INSERT INTO `piano_token` VALUES ('2982', '101319', '1ad85bb634cef86c690fc21f232cccb5', '862976034490449', '1', '1500025009');
INSERT INTO `piano_token` VALUES ('2984', '101320', 'a55184f3bfc7c632311c0b7add6c6264', '864552033020996', '1', '1500025379');
INSERT INTO `piano_token` VALUES ('2992', '101321', '4d6601c989060d9e9437769894e862a5', 'A0000061838DC6', '1', '1500030337');
INSERT INTO `piano_token` VALUES ('2993', '100185', 'bf8278ec617d698ea566c9ed48183094', '0dc15052976351cbfe9594361b9348fe', '2', '1501509742');
INSERT INTO `piano_token` VALUES ('2996', '101322', '6f30fd9900af5875ee8ec6fdb3c18c48', '864323025785743', '1', '1500115388');
INSERT INTO `piano_token` VALUES ('2997', '101323', '0d6ed568c94020e9653b3fb1d2a569c7', '08f4b107517bb264f305afb0c165eb0e', '2', '1500034701');
INSERT INTO `piano_token` VALUES ('2998', '101324', '4d98ad7865d54b2b8166174f5f3ca224', 'ad9a26b3f4d49166945b544ee5d97376', '2', '1500037788');
INSERT INTO `piano_token` VALUES ('2999', '100290', 'c5bbdf61154fb5cf16c8a1d8ec23a3ac', '0cf98b9e3c6701ddd2b432c8ef0e01ff', '2', '1500040283');
INSERT INTO `piano_token` VALUES ('3000', '101325', '20becbf689fee89dcf61bf7a120b8772', '6469ebd48cefb855e3652657a72ca433', '2', '1500041598');
INSERT INTO `piano_token` VALUES ('3001', '101326', '4bc5e6307c5c1f745de585d94753f599', '773d3936fd2ad23c484259f0f21449db', '2', '1500046457');
INSERT INTO `piano_token` VALUES ('3002', '101327', 'b36fe4f525303de3606dbd5bd4808034', '44cbfec256e4148613f67feda2b18c8c', '2', '1500080858');
INSERT INTO `piano_token` VALUES ('3003', '101328', 'afb8a6c79e7ff5097ebfc34fe9172aee', 'a40d1f7ae630897eeaf1fee69acac3d3', '2', '1500083643');
INSERT INTO `piano_token` VALUES ('3005', '101329', '405fcdc9a87a3c88b1d85f3d22fd8de7', '863116033722679', '1', '1500088931');
INSERT INTO `piano_token` VALUES ('3007', '101331', '114622b3b996842efaf1a759d069fe16', '861084032053789', '1', '1500089971');
INSERT INTO `piano_token` VALUES ('3008', '101332', '2d60860d480cf181f471563a22904126', '861837039338259', '1', '1500092017');
INSERT INTO `piano_token` VALUES ('3009', '101333', '678a37df293d5107380669cc91316720', 'e75466f513828eb823fbd99501107358', '2', '1500092977');
INSERT INTO `piano_token` VALUES ('3010', '101334', '8d0d2cff28fcca6ccf0878318b1eebe0', '867628022573778', '1', '1500093602');
INSERT INTO `piano_token` VALUES ('3011', '101335', '9a1cc05b262b2689e1738ec92b3fa42a', '355384061460118', '1', '1500095214');
INSERT INTO `piano_token` VALUES ('3012', '101336', '1a784095d760c7f2bd967e77ead226e4', 'c2fdb3181733d424c71d505db3e0eb4d', '2', '1500095915');
INSERT INTO `piano_token` VALUES ('3013', '101337', '252b2292ddd9fa6545f4363c3319f92e', '4a4442ddd9a85d57818e8cd69ad25cac', '2', '1502630931');
INSERT INTO `piano_token` VALUES ('3014', '101338', 'fe322da8af069369b83b5e9f586f6896', '869410026136029', '1', '1500098433');
INSERT INTO `piano_token` VALUES ('3016', '100028', '154e325b67b246c3e27ecd1c4fa04885', 'fc80e44280d6da370f1a0420d5fd59ed', '2', '1501639864');
INSERT INTO `piano_token` VALUES ('3017', '101339', '4c872b7301b15a9f8b499c65e8d5a3ac', '862266031707155', '1', '1500108015');
INSERT INTO `piano_token` VALUES ('3019', '101340', 'a1151fead3a8cdb61291af7cdd5adc8f', '644c05568efe4308', '1', '1500113628');
INSERT INTO `piano_token` VALUES ('3020', '101341', '0c2c1a1bf55d1b0d2ccbf6a4906ab927', '865401039985720', '1', '1500114001');
INSERT INTO `piano_token` VALUES ('3021', '101342', '86d9758a51d3ac0ca6fb0540c00955c2', '868406021054903', '1', '1500121347');
INSERT INTO `piano_token` VALUES ('3022', '101343', '26f5146a41dd2f517fdffecbba60b2dd', '864447033156975', '1', '1500123030');
INSERT INTO `piano_token` VALUES ('3023', '101344', '8d6a4fc9b14fad250319916a75d11d33', 'fee722f67c893f44292742a0b47f2cbe', '2', '1500125824');
INSERT INTO `piano_token` VALUES ('3024', '101345', '1dd97af1267f368b4cae5663f79e5555', '860270037724489', '1', '1500128266');
INSERT INTO `piano_token` VALUES ('3025', '101347', 'b0ce722540a4dbfb44a50465d41bb817', '869542024619844', '1', '1500128861');
INSERT INTO `piano_token` VALUES ('3026', '101348', '76683e7be07d7d396b9de4212d0c350a', '869989026422760', '1', '1500129279');
INSERT INTO `piano_token` VALUES ('3027', '101349', '34d30ac073c84ff818f9198707f48e0f', '863055030958656', '1', '1500133717');
INSERT INTO `piano_token` VALUES ('3028', '101350', 'e02865ccbd69b2ee4b5609c214da9335', '864361034906009', '1', '1500160589');
INSERT INTO `piano_token` VALUES ('3029', '101351', 'bab9078dbdcae5277a91a677c09674e6', '863469038652510', '1', '1500166589');
INSERT INTO `piano_token` VALUES ('3030', '101352', '015ea150e145053160b7313759464391', '864600037002088', '1', '1500167944');
INSERT INTO `piano_token` VALUES ('3031', '101353', 'bc33acf5d072fe967acebbd61910d85a', '357557097576456', '1', '1500183442');
INSERT INTO `piano_token` VALUES ('3033', '101354', '2ada90c7bb8894eca3cb9d2674f18928', 'a5003b5d4bb9ff2ec0b782aa9b02af66', '2', '1500899967');
INSERT INTO `piano_token` VALUES ('3034', '100483', '6cbffaa03a8876344fd0f6865d8fb12f', '861761030819341', '1', '1500176146');
INSERT INTO `piano_token` VALUES ('3036', '101355', 'cb99dd9c5b788fb55ffc1deb6cd7dafc', '861042037580495', '1', '1500177564');
INSERT INTO `piano_token` VALUES ('3039', '101358', 'e314f6d939ff5c0d382f68813b96f277', '864821037124504', '1', '1500189124');
INSERT INTO `piano_token` VALUES ('3040', '101359', 'f15bb080fd003c734fb4eba56ee4dd71', '862837033446289', '1', '1500193375');
INSERT INTO `piano_token` VALUES ('3041', '101360', 'f1b38921c1c45a2f3c117e5b9b096581', '864245031488451', '1', '1500195430');
INSERT INTO `piano_token` VALUES ('3042', '101361', '453e937c1703a56f9dc55baf0e00d774', 'd6f5b4fc71123778d36fd1dccb8b090d', '2', '1500196783');
INSERT INTO `piano_token` VALUES ('3043', '101362', '81e9e4a75f43b5da0d41635f72315802', '863295034183519', '1', '1500198179');
INSERT INTO `piano_token` VALUES ('3044', '101363', 'c833bc22cbb1b4dcdf6f2fe6d6727b48', 'd4e06f56228f06e148c95cae4ba7a9c9', '2', '1500203511');
INSERT INTO `piano_token` VALUES ('3046', '101364', '7088165c37b9288ad275c1fe54777ea6', '860662031963321', '1', '1500211807');
INSERT INTO `piano_token` VALUES ('3047', '101365', '4096ff7bf6291fc8e626fda3d8875922', '38066867d313e815d8577b68572d0f6f', '2', '1500216977');
INSERT INTO `piano_token` VALUES ('3048', '101366', '029d0af2a4710d44ea726556479f08d2', '867119022693311', '1', '1500219696');
INSERT INTO `piano_token` VALUES ('3049', '101077', '6d1146a6ebaa88dbcde5084dd8329a0b', 'e8b57cf89dd31d32e0df156f4464768e', '2', '1500252334');
INSERT INTO `piano_token` VALUES ('3056', '101368', '9514c09d60f2b12fd62b62c0e7dd2adf', '861634037681289', '1', '1500260538');
INSERT INTO `piano_token` VALUES ('3058', '101369', 'e26e11219b00dbf3141f17310b15a8b5', '863673039720339', '1', '1500261135');
INSERT INTO `piano_token` VALUES ('3059', '101370', '558e524444acee731109bbd38666e01a', '869895027167041', '1', '1500261645');
INSERT INTO `piano_token` VALUES ('3061', '101371', '436e2a2eeaedea6fb5d9cd51b1174c0a', '863127031120303', '1', '1500268742');
INSERT INTO `piano_token` VALUES ('3063', '101372', '62a001d85e97041fea93ff0bd2e0e972', '863698038910276', '1', '1500274092');
INSERT INTO `piano_token` VALUES ('3068', '101374', '2201aafd08f773dbcd7e38b1563b3ad6', '865002020480562', '1', '1500278761');
INSERT INTO `piano_token` VALUES ('3076', '101376', '165d09e589dffaef4aee19ae9a54f7da', '861054034690003', '1', '1500284084');
INSERT INTO `piano_token` VALUES ('3086', '101377', 'd8af366d357f1fb03c33a7d97013fc61', 'f05e24e5b5b9688cda7898edac8a9300', '2', '1500296269');
INSERT INTO `piano_token` VALUES ('3088', '101379', '55f1b14ca9ba7782b1e28f78d6fb3bdf', '861615037357467', '1', '1500341763');
INSERT INTO `piano_token` VALUES ('3094', '100189', '77d6e77bb9e0d43404297787869333a6', 'A0000063EAEE23', '1', '1500348939');
INSERT INTO `piano_token` VALUES ('3101', '101381', 'd7fe750811b85a9d7945f11b82c8419b', '866550023294967', '1', '1500369140');
INSERT INTO `piano_token` VALUES ('3103', '101382', '7562c8d2813cb5611485dd2dea075e70', '867120028608253', '1', '1500365800');
INSERT INTO `piano_token` VALUES ('3104', '101383', '2be774f59ab12922fae0f635a46f4b4a', 'ad89ee181f7cd197b1f5dc76b83aaac5', '2', '1500371346');
INSERT INTO `piano_token` VALUES ('3106', '101384', '61e15b5769471ea186198212cb6e4dc9', '878a526eb4f25b90ea4ef0e142ebf1a1', '2', '1500377032');
INSERT INTO `piano_token` VALUES ('3107', '101385', '29e356009111f3f54f860bb4367d3638', 'ce023fd403f7de09b792af2c75df1103', '2', '1500378880');
INSERT INTO `piano_token` VALUES ('3108', '101386', '098a078e1cab01b05a53a0fd285b1e70', '864134032872840', '1', '1500389418');
INSERT INTO `piano_token` VALUES ('3109', '101387', '829d7ea94bd6aad629b5d0fa665d05fb', 'facc75fad0b04c9e1b02d76f2356d34d', '2', '1502438137');
INSERT INTO `piano_token` VALUES ('3117', '101389', 'b6d0ac7c0f34cad35795a8dabae1d71b', 'A00000483DFFC5', '1', '1500429291');
INSERT INTO `piano_token` VALUES ('3122', '101390', '91516b1315318188b80b6b2a545c471d', '864556033996279', '1', '1500432872');
INSERT INTO `piano_token` VALUES ('3123', '101391', '1f38680336a1af73b6e1e98421c28a7b', '868756023618067', '1', '1500434115');
INSERT INTO `piano_token` VALUES ('3124', '101392', '87c59b4269d89d498bc3a36d2925455a', '864162033171581', '1', '1500438068');
INSERT INTO `piano_token` VALUES ('3125', '101393', 'aa778b52ff2d0db4b8a3537182a31469', '86072903451345', '1', '1500441337');
INSERT INTO `piano_token` VALUES ('3132', '101394', 'b96107577ad96011ea00837c5d0e7619', '864368037825938', '1', '1500448723');
INSERT INTO `piano_token` VALUES ('3135', '101395', 'e5e32794514e73bb769933a78c43e11c', '1dc3fa8f180b76c8d08bb4b3957ee29a', '2', '1500451962');
INSERT INTO `piano_token` VALUES ('3138', '101396', '8e829b898a9279131b31189eee7b45e6', '7dc1eceb3ec08a2', '1', '1501720387');
INSERT INTO `piano_token` VALUES ('3140', '101397', '8c45e79b84e9c5005de8ed2c23aa30ad', 'c294679239badf7ad06fc3ece4f13bf3', '2', '1500460950');
INSERT INTO `piano_token` VALUES ('3144', '101398', 'd4718ff547b8d4cc2261828f3701f7d7', '28D6R16B21000547', '1', '1502508094');
INSERT INTO `piano_token` VALUES ('3145', '101399', '8411032ee60fc654b3c0456e95b2c918', '30624811b192a19b39a9828a6843a05b', '2', '1500464839');
INSERT INTO `piano_token` VALUES ('3146', '101400', '9f51dc408ca4331f2fda33b52a4966e0', 'cfb34991881f4bd8c8c44fcf84a6e314', '2', '1500465203');
INSERT INTO `piano_token` VALUES ('3148', '101401', 'b9764c03f9dd4df2b094b96160b000cb', '8599e0edff182ce89f93d31766a50a94', '2', '1500469472');
INSERT INTO `piano_token` VALUES ('3149', '101402', 'd1e2ff04183a2ed4b001c4133cc2d6f2', '860267030492460', '1', '1500514635');
INSERT INTO `piano_token` VALUES ('3152', '100087', '0010bc863055b2cc6231423a776875c4', '861836039993790', '1', '1500818314');
INSERT INTO `piano_token` VALUES ('3154', '101403', '6bf8ce107ca4363a7ea58ccf1d8f484c', '1c56757a7ac84331f5adadba13ae47cd', '2', '1500525760');
INSERT INTO `piano_token` VALUES ('3155', '101404', 'd6d2e8cc6f9fb33af45647243733dedd', '861262035317795', '1', '1500529219');
INSERT INTO `piano_token` VALUES ('3158', '101405', '5c235687e29fc1634795c04145d231c5', '867921024944026', '1', '1500533293');
INSERT INTO `piano_token` VALUES ('3159', '101406', '68150f87d8aa797532611c05855f7d1e', '865655029542615', '1', '1500539132');
INSERT INTO `piano_token` VALUES ('3161', '101408', '4a70019e1b18479432f07db10146f87b', '862886034997758', '1', '1500548332');
INSERT INTO `piano_token` VALUES ('3166', '101409', '49c3bf73bf05555161c21b11e4d17c14', '869336022076689', '1', '1500549190');
INSERT INTO `piano_token` VALUES ('3167', '101410', 'b77c96029a6e7297477c8d96eb498c01', '860258030216587', '1', '1500550760');
INSERT INTO `piano_token` VALUES ('3168', '101411', 'b9253326c6fc28c319d65e37991f7758', '00000000', '2', '1500553882');
INSERT INTO `piano_token` VALUES ('3169', '101412', 'be8bc9ca938bebded58bba334be3a241', 'A1000049EB5AC9', '1', '1500553239');
INSERT INTO `piano_token` VALUES ('3170', '101413', 'fc02b159653dd79f5f0b7c3dd5fc5d71', 'A10000547F43DC', '1', '1500553640');
INSERT INTO `piano_token` VALUES ('3171', '100786', '6c20cf9eda574c8dbbee9742dc61e3fb', '862209038189936', '1', '1500556294');
INSERT INTO `piano_token` VALUES ('3172', '101414', '8da2b35cdc6e8812d7115f1bc07eb163', '862265036585582', '1', '1500564127');
INSERT INTO `piano_token` VALUES ('3173', '101415', '9fd828fa92c0a74f5a78e44770aa7ea1', '6e46e0a8deee312f0c4591fdcb2e83d6', '2', '1500568240');
INSERT INTO `piano_token` VALUES ('3174', '101417', '48de38fa60c87f49d4ccd1a392ceb54d', '9cbf26b5bd9f122171cc5659edf277f1', '2', '1502446014');
INSERT INTO `piano_token` VALUES ('3179', '101407', '94756f4c99ea104e9c1a2359972fd3e2', 'A00000455BD79C', '1', '1500612104');
INSERT INTO `piano_token` VALUES ('3189', '101418', '3fd3224f9067b2f5ee275adba1276b6a', '864101030506100', '1', '1500624360');
INSERT INTO `piano_token` VALUES ('3191', '101419', 'd5d6ed228a04dc50aea46eee5f640526', '862083037473157', '1', '1500626903');
INSERT INTO `piano_token` VALUES ('3194', '101420', 'ce67a9c93f47c52b1916279b5f759000', '614e449d6755550d1c57205c5d2f3adc', '2', '1500628332');
INSERT INTO `piano_token` VALUES ('3197', '101421', '4d564caa387025d75519cb8c3ebb6df0', '861925030429894', '1', '1500628805');
INSERT INTO `piano_token` VALUES ('3199', '101422', '58cda15a925780579d78d5958fc8a627', '027156da537acfb4a6a256ddac4ad901', '2', '1500864285');
INSERT INTO `piano_token` VALUES ('3217', '101425', '0eda07852218ba05bd44d6f55b73ec71', '793c06a058f10042dd81c5fa61cf6ad7', '2', '1500640946');
INSERT INTO `piano_token` VALUES ('3221', '101426', '4333f52f36b8e7865642a3cf78e89f4f', '861006033222113', '1', '1500648838');
INSERT INTO `piano_token` VALUES ('3223', '101427', '06c733181b59aa6cf097a0ef03fa0e8b', '869159024368452', '1', '1501925918');
INSERT INTO `piano_token` VALUES ('3226', '101428', 'caa3af2db3e4d540e54f89d82f20c1e7', '860709034682786', '1', '1500694302');
INSERT INTO `piano_token` VALUES ('3227', '101429', 'daa6211d50ea9f24725a4ce7a5b73de3', '860034030987893', '1', '1500694395');
INSERT INTO `piano_token` VALUES ('3228', '101430', '8cb0b7c880833adb7565c1a8c28af919', '862110030307866', '1', '1500697028');
INSERT INTO `piano_token` VALUES ('3229', '101431', '45af840224195aa6ca240441e609a9a8', '041bbc9350dbf7244f2b7dea103f3c23', '2', '1500698910');
INSERT INTO `piano_token` VALUES ('3230', '101432', '0072a47b382c008aa425071ac9dcc177', 'f637b37d8d2f9159d096950c654a84be', '2', '1500700734');
INSERT INTO `piano_token` VALUES ('3231', '101433', '8cc07c363166cd8554f64c3221f7e152', 'b19752f8920ba8b1dbe8191ae27a129a', '2', '1500953297');
INSERT INTO `piano_token` VALUES ('3233', '101435', 'f9b847cd70d55d5886d8f7ce70f602ff', '2ccecf7db363d7f1ad0cd77bb7485a34', '2', '1500702771');
INSERT INTO `piano_token` VALUES ('3234', '101436', '925a54fcc2219243c77fba332204f049', '869154022512318', '1', '1500712024');
INSERT INTO `piano_token` VALUES ('3236', '100380', '344d6bc9d88883ecc303cc5c0e3e71eb', '49849b158c5f0f6f', '1', '1500714157');
INSERT INTO `piano_token` VALUES ('3237', '101437', '4167dd4322565956e8afbcf4fc641677', '359950061172246', '1', '1500719014');
INSERT INTO `piano_token` VALUES ('3238', '101438', 'ccd45525d87bd2799fcf7f81cad759c9', '1cef44a0ec9066dd12e2807ca5e81121', '2', '1500724843');
INSERT INTO `piano_token` VALUES ('3239', '101439', 'f503e2d2f3ccc500463a79e2b81818c8', '866960021199599', '1', '1500728882');
INSERT INTO `piano_token` VALUES ('3241', '101440', '3d265bfe5531c1a1e2fc020f3d537a8c', '862770039156331', '1', '1500738501');
INSERT INTO `piano_token` VALUES ('3242', '101423', '84343b94b0f6d82ea5a571002fc0de95', '357557097576407', '1', '1500768898');
INSERT INTO `piano_token` VALUES ('3243', '101442', '15e9ed78e8c0b748d21cdd53af57963b', '863197030534291', '1', '1500769967');
INSERT INTO `piano_token` VALUES ('3244', '101443', '5f6a1ff4dc239f1df267a755d58d8d4f', 'a22347efffb2a51ccf0bbcb3b8d1da65', '2', '1500771966');
INSERT INTO `piano_token` VALUES ('3245', '101444', '6db193f5cdb08c873856609700a2dd85', '4a78327aa71d952c15d15bca5251d3fa', '2', '1500772090');
INSERT INTO `piano_token` VALUES ('3246', '101445', '31e23b7ced5c82caa61144ceac44a9dc', '862842034384687', '1', '1500774831');
INSERT INTO `piano_token` VALUES ('3250', '101446', '0157a87edc8fc32b53367005dac38b26', '889c10b42cb0ce0246adcc88e1bb19f1', '2', '1500777168');
INSERT INTO `piano_token` VALUES ('3253', '101447', '5c29b700ee4262f055f579dfedc73cf9', '869161025337189', '1', '1500780616');
INSERT INTO `piano_token` VALUES ('3257', '101448', 'b2eb7fd1713340e043e63214568ec3ce', '869515021464323', '1', '1500790761');
INSERT INTO `piano_token` VALUES ('3258', '101449', '8eea25756f809fc803eddc2ab5ead012', '7b010cf9438d17850dc207b4f87ae5bb', '2', '1500792261');
INSERT INTO `piano_token` VALUES ('3260', '101450', '70893398b58bf3359662a6734ef4014e', 'd3fbc96090dc4cec53fd5c1e96eb3f1a', '2', '1500797183');
INSERT INTO `piano_token` VALUES ('3263', '101451', 'c0922289c446db5f5a4e6b14dd437aab', '84d3ac1e2e158ee713ab8c70d9549a70', '2', '1500798777');
INSERT INTO `piano_token` VALUES ('3265', '101452', '80f67d3d4b317761a93964ff35c47e1a', '353460083034206', '1', '1500800197');
INSERT INTO `piano_token` VALUES ('3272', '101454', 'f4ddbe85951156f7421983d828e0bd77', '06475b5bd7ec37306d91efae532d6163', '2', '1500803736');
INSERT INTO `piano_token` VALUES ('3279', '101456', '06430877aa45a951dcf72afed711f94b', '866647021314787', '1', '1500812853');
INSERT INTO `piano_token` VALUES ('3280', '101457', 'ab4bbee1d8fbf8c13bc542775a163d87', '861543030013574', '1', '1500813470');
INSERT INTO `piano_token` VALUES ('3281', '101453', '7a1e72f6ac4fd7f1fa29bca33a5b1f5a', '866479021370068', '1', '1500816033');
INSERT INTO `piano_token` VALUES ('3282', '101458', '073a312e7a337ec69e530368e8523c0a', '80b5eb67d3f50982f9d2c825f558b1eb', '2', '1500817127');
INSERT INTO `piano_token` VALUES ('3283', '101459', '67a5ac7e1b6d50a43e02b4840facc51c', '864322039147452', '1', '1500820283');
INSERT INTO `piano_token` VALUES ('3286', '101460', '2ce8e16d72466cf16176ea2abe0a5ad9', '716324fac7f8d4832a912b2046d0d73f', '2', '1500825828');
INSERT INTO `piano_token` VALUES ('3294', '101461', 'e14c465733c55f141f1274c9eaf1d710', 'fc80e44280d6da370f1a0420d5fd59ed', '2', '1500867871');
INSERT INTO `piano_token` VALUES ('3316', '101434', '93088bef502867d4d5aa2da185e4fc4d', '861681030864909', '1', '1500951137');
INSERT INTO `piano_token` VALUES ('3337', '101462', '1e8056f2a8560f5ac91980b854c24192', '862391038141958', '1', '1500889144');
INSERT INTO `piano_token` VALUES ('3340', '101463', 'dcf5146144870a7607ea45088b3fec32', 'b47aad53a7ebacada1b5f5f585ea7ffa', '2', '1501156003');
INSERT INTO `piano_token` VALUES ('3344', '101464', '486ae8baf7e7aea328c9d87cada08042', '9183bf96ec017bf9846deafcfca83e60', '2', '1500894158');
INSERT INTO `piano_token` VALUES ('3345', '101465', '44d7837e6a8f31c60e27c7df03a67e28', '6272a6e745161953ceb941a1ab3f1ce8', '2', '1500895595');
INSERT INTO `piano_token` VALUES ('3346', '101466', '6de8066166ba248f94299a26b9418eca', 'c333a88bc42bec9fc6a9509fb4a8c027', '2', '1500901367');
INSERT INTO `piano_token` VALUES ('3348', '101467', 'b1bd718263a0169c4ba01cad1577de19', 'e24e72b30974ffb423bb1544b5451ca1', '2', '1501085307');
INSERT INTO `piano_token` VALUES ('3349', '101468', '269f54330c375fbfea6d8d5f0e94d7a1', '6c8dc975a4868c7bdbb33e4362c9b7d9', '2', '1500908882');
INSERT INTO `piano_token` VALUES ('3350', '101469', '4a83e9139beccd4f23be4a43f0c286b6', '862607032581232', '1', '1500950345');
INSERT INTO `piano_token` VALUES ('3356', '101470', '2b5b6d6a0d53ff81938fb635f2605288', '865763033882678', '1', '1500960608');
INSERT INTO `piano_token` VALUES ('3357', '101471', '96004bab8e8a7beec86e5485839e112a', '352107067716917', '1', '1501079177');
INSERT INTO `piano_token` VALUES ('3359', '101473', 'd8f7be653edd98afef2a9954d69cbf8a', '861720034673138', '1', '1500965280');
INSERT INTO `piano_token` VALUES ('3360', '101474', 'e10ac14abc20ba85850c0d26d165167c', '866641026383277', '1', '1500965936');
INSERT INTO `piano_token` VALUES ('3369', '101475', '4e7dcc35a636c1abb525692ff45fbc42', '353726064501557', '1', '1500971073');
INSERT INTO `piano_token` VALUES ('3373', '101476', 'b1f3d954cc2ecbad0fd87dd34b4f1595', '865121034905206', '1', '1500972912');
INSERT INTO `piano_token` VALUES ('3374', '101477', 'a9d7b748042cd4d05a2f143a198a81ed', '353288081261111', '1', '1501049559');
INSERT INTO `piano_token` VALUES ('3375', '101478', '24df1e87129a0b0bfc70b1e0d7801454', '861757033133995', '1', '1500977538');
INSERT INTO `piano_token` VALUES ('3389', '101479', 'db93bfe0c5751fad5e2fce03d41353f0', '860635031674429', '1', '1500979985');
INSERT INTO `piano_token` VALUES ('3393', '101480', 'a62e4926f4b44094f54880120851310a', '3c3c949f2de8d40d', '1', '1501669920');
INSERT INTO `piano_token` VALUES ('3394', '101483', '2b606a0779d18772f794964a96761f21', '862052036264073', '1', '1500984652');
INSERT INTO `piano_token` VALUES ('3395', '101486', '00be3e781e0d12ae162455b95997b843', '64ddd9a9bb554d783621bf560f764960', '2', '1500984690');
INSERT INTO `piano_token` VALUES ('3396', '101487', 'b2eda0936e945895d503f088c90fc799', '869634020076820', '1', '1500987110');
INSERT INTO `piano_token` VALUES ('3397', '101488', 'e08ed50e892154b1a86cffb87a4d1c62', '861353037728574', '1', '1500987176');
INSERT INTO `piano_token` VALUES ('3398', '101489', '3c1a7cf158f77fb2515d1bb363c5420f', '864555038055875', '1', '1500989748');
INSERT INTO `piano_token` VALUES ('3399', '101490', '4c1a8c8941fcb1397f76291e6fd14f6d', '862719035812116', '1', '1500989775');
INSERT INTO `piano_token` VALUES ('3400', '101491', '8ee5a47e025a40bc4e918632bda50297', '862937036367225', '1', '1500989822');
INSERT INTO `piano_token` VALUES ('3401', '101492', '3defc14613de1b7b6492bce3b9050a25', '862949034030218', '1', '1500990034');
INSERT INTO `piano_token` VALUES ('3402', '101493', '55300bce8056c17e49c46b06b0179bd7', '864702032329845', '1', '1500990071');
INSERT INTO `piano_token` VALUES ('3403', '101494', '9c54a6a27181f8161792a39a214ecd1a', '865647025839749', '1', '1500990256');
INSERT INTO `piano_token` VALUES ('3404', '100428', 'b39d25f4006be27f087c82638d9d2d23', '88bee0dff420b07edb539fc9a563cb93', '2', '1500991470');
INSERT INTO `piano_token` VALUES ('3405', '101495', '8f79fc0b2b38192a41506506734c0c99', '5283061f8dcf10c33cdebb6437e5ab1b', '2', '1501028326');
INSERT INTO `piano_token` VALUES ('3407', '101496', '68091a98756d69ec16a662fefffa6cde', '866172032096356', '1', '1501032470');
INSERT INTO `piano_token` VALUES ('3412', '101497', '82287cc9b30ff67c12ba03effc9fe892', '357523057712614', '1', '1501037274');
INSERT INTO `piano_token` VALUES ('3414', '101498', 'd854264921c5fceaf8893cc4af44fe7f', '7fd1f0274ed5edf344c6606798e3c6a2', '2', '1501040340');
INSERT INTO `piano_token` VALUES ('3417', '101499', '115a23f3087a1f9e25e9a31f052aa530', 'cb4bf5117caaa67cda89e86e77f3993c', '2', '1501041415');
INSERT INTO `piano_token` VALUES ('3418', '101500', '64298147fe15d91d4d5008b30dc97fa9', '357512058659346', '1', '1502371009');
INSERT INTO `piano_token` VALUES ('3421', '101367', '37eacc4e2d7f46b5462196e8aebe25c8', 'df553c868b16f8637706ef714b6abb91', '2', '1501047461');
INSERT INTO `piano_token` VALUES ('3423', '101504', '9101cd75c00891bdeae3e66627a756bf', '864288035929344', '1', '1501048905');
INSERT INTO `piano_token` VALUES ('3424', '101503', '01c20b8978b228d4bcd40567693852bf', 'c579a00868432f8b60c3c9a281946a64', '2', '1501048913');
INSERT INTO `piano_token` VALUES ('3431', '100371', '4a08f23d263b68f72bb9199ccbe7ab7c', '2f35a877083a930169a009fb2a8e2744', '2', '1501052559');
INSERT INTO `piano_token` VALUES ('3436', '101505', '182733e67fcfb721bb8049385b25a55c', '9ce02c656c42a812e1b55574da0ef01a', '2', '1501054282');
INSERT INTO `piano_token` VALUES ('3442', '101506', '2a0ad3757e540092604762e3ba24aa84', 'A1000049EB4E33', '1', '1501056854');
INSERT INTO `piano_token` VALUES ('3444', '101507', '36f9e291be1fe61877baef48ea1ebf74', '866272020971956', '1', '1501060395');
INSERT INTO `piano_token` VALUES ('3447', '100474', 'a7b17aa333e1f2a50a17962940243583', '8741d52bfd088694', '2', '1501221415');
INSERT INTO `piano_token` VALUES ('3453', '101508', 'aca0592c6f70d29743c9a6420e677b3f', '865223030518999', '1', '1501064702');
INSERT INTO `piano_token` VALUES ('3457', '101509', '0f8534455979f568b6227a4313038b30', '860734034777410', '1', '1501066109');
INSERT INTO `piano_token` VALUES ('3463', '101510', '719e1c20a063ed901af19d1d974e50a6', 'f0c0a7bb1a08b5b9dde8f83ce84ff915', '2', '1501117033');
INSERT INTO `piano_token` VALUES ('3467', '101511', 'd5e15c0fd3b79b59eac7cc8df7aee551', '4df7cec3f8b42acd38ef635aae1e68c3', '2', '1501077629');
INSERT INTO `piano_token` VALUES ('3469', '101512', 'def8bef22e9cf89a5ce41cdb3248e840', 'db2649777f08ef82e6d1a5a81b8f873e', '2', '1501079575');
INSERT INTO `piano_token` VALUES ('3470', '101513', 'fbf0858c8d66b85199cdda7b534eb275', 'b851cf917eee5652839198e830f8506f', '2', '1501117071');
INSERT INTO `piano_token` VALUES ('3471', '101514', 'a5ccd6fb5ecd9f1bf62e3814bc062d39', 'A000005517A432', '1', '1501118297');
INSERT INTO `piano_token` VALUES ('3472', '101515', 'b1154de9dd042ff8e7f277878c613fa7', '863681034066277', '1', '1501120147');
INSERT INTO `piano_token` VALUES ('3473', '101516', '51b8915ca74b2fcf86fe14d73df7ac15', '825f6fc9c9a604b205896ebdc51d5ed2', '2', '1501120614');
INSERT INTO `piano_token` VALUES ('3474', '101502', '7d51c55751908d6cd30f18a2bc320ce8', '7627b13fedc4eafac5d23601431f1861', '2', '1502700919');
INSERT INTO `piano_token` VALUES ('3481', '101091', '7b59df6c47d6a9f22520f801dff9b622', '864024035509533', '1', '1501124264');
INSERT INTO `piano_token` VALUES ('3484', '101517', '0e5983d6c9333caa0c9b753ff469df53', '0a07fe5a5d052f02f216929cea53125c', '2', '1501129669');
INSERT INTO `piano_token` VALUES ('3485', '101518', 'b39d0780a804cc25fcdfcbab70d00017', 'A00000611EFF55', '1', '1501130879');
INSERT INTO `piano_token` VALUES ('3486', '101519', 'abb9c55d7e47d626df6aab12da69a1d4', '51793f8f8e3c5317c1a466275ddb062a', '2', '1501135320');
INSERT INTO `piano_token` VALUES ('3507', '101520', '600395a3d52ae6d5e0961c4c32f8572a', 'A000007058D867', '1', '1501156804');
INSERT INTO `piano_token` VALUES ('3508', '101521', '94e7417033d246574381eae8ea20c732', 'A0000059E1941E', '1', '1501158097');
INSERT INTO `piano_token` VALUES ('3512', '101522', '2fbfff0b67d66a2be7a3cd25e40dafd7', '861379036579718', '1', '1501204320');
INSERT INTO `piano_token` VALUES ('3522', '101523', 'cbbef09db19ec8e59b914b598f19351a', '862538034189874', '1', '1501211932');
INSERT INTO `piano_token` VALUES ('3550', '101524', '3a0b41c3b9a8353a821251c7b8cb0968', '864176030930740', '1', '1501226277');
INSERT INTO `piano_token` VALUES ('3553', '101526', 'beb5ba4a857bd81f8916f0b64cc4a17d', '2bd98ee00dce54163701d6bd3ad73c5e', '2', '1501227790');
INSERT INTO `piano_token` VALUES ('3554', '101527', '9f7c2f43b14a09ca843bd008f9cadf71', 'c332a584d769f0a0f36e25ef1306556b', '2', '1501227911');
INSERT INTO `piano_token` VALUES ('3574', '101528', '2c4c53085550d2f2619fe6835c965d67', '8fd93d75d0d8ad395869540b162a6e29', '2', '1501233732');
INSERT INTO `piano_token` VALUES ('3588', '101530', '3f886e49a524947469b7ac8350d4a8c0', '869296024288551', '1', '1501245317');
INSERT INTO `piano_token` VALUES ('3589', '100527', 'd069966c16818daf56d4a1dcbb3f9c21', '867600025874560', '1', '1501246510');
INSERT INTO `piano_token` VALUES ('3590', '101531', '2338d770f58ce451f91129250f99fdc8', '865568027886019', '1', '1501650166');
INSERT INTO `piano_token` VALUES ('3593', '101532', '6e9f089d11fcb9bcf55fb69d0262fc67', '8160a76e725183ca9df2d55e6c6da8d2', '2', '1501254502');
INSERT INTO `piano_token` VALUES ('3596', '101533', '64e3910d9198a4d1ac4f370785f6f05c', '863891038331037', '1', '1501292965');
INSERT INTO `piano_token` VALUES ('3601', '100689', '431b6caf278f2ab3c130bc1b0cb22961', 'd6db61492889ada488e1b34ba895d6d2', '2', '1501308562');
INSERT INTO `piano_token` VALUES ('3612', '101534', '907e389f05614e072833deb172812903', '865773034657136', '1', '1501313164');
INSERT INTO `piano_token` VALUES ('3614', '101535', 'ddfd8eb6278be30872e7cb81a82a7e73', '864937021327265', '1', '1501322492');
INSERT INTO `piano_token` VALUES ('3615', '101536', 'fc6c5827583eeeba3401446300cc287e', '866090030663250', '1', '1501319535');
INSERT INTO `piano_token` VALUES ('3619', '101537', '942afa4119c57146e05b129574edb1e5', '860077031144766', '1', '1501323906');
INSERT INTO `piano_token` VALUES ('3620', '101538', 'd7ecd80c10ce6712bdf0082bdf75f259', 'b389e9c57146056f14748829bc9dbebb', '2', '1501324367');
INSERT INTO `piano_token` VALUES ('3625', '101539', 'b53c5d5d8c0c2824b205eec697c49bb1', 'bb5b28775767459996d398efa8bcbdfb', '2', '1501578805');
INSERT INTO `piano_token` VALUES ('3626', '101541', 'ffd5301ffee077c5b85447648fd38de3', '353771072307225', '1', '1501336973');
INSERT INTO `piano_token` VALUES ('3627', '101542', 'f4cdc79f2156733d84ad4a5fdbc60e7f', '868589026669542', '1', '1501345800');
INSERT INTO `piano_token` VALUES ('3628', '101543', '7e5336d6f6d2ec05bf5e1c97a15cec5f', '4e59fe7817b6369d0cfde51541ae9bbd', '2', '1501352212');
INSERT INTO `piano_token` VALUES ('3629', '101544', '3f57b5985b5032d29a043eb307148601', 'f670239c91d2e43cdc1020862fff5471', '2', '1501377304');
INSERT INTO `piano_token` VALUES ('3630', '100967', '0ce1f131211563c8fb9bb3b96d5cb1e3', '99000577666410', '1', '1501377421');
INSERT INTO `piano_token` VALUES ('3631', '101545', '21a16d3ce88334513e257bf6a5514936', '358239059099541', '1', '1501377954');
INSERT INTO `piano_token` VALUES ('3632', '101546', 'b671c6b47f4b562b141e568a1eed8b46', '99000942154635', '1', '1501381916');
INSERT INTO `piano_token` VALUES ('3633', '101547', '5f84145d3c00263498bb52f3093ef8d1', '868204020180302', '1', '1501390681');
INSERT INTO `piano_token` VALUES ('3634', '101548', '9219b7c1389303f1d7e93a93d3f5426a', 'A100004921E3BE', '1', '1501391731');
INSERT INTO `piano_token` VALUES ('3635', '101549', 'cb71e6f649ec42c680da7eab3c407b05', '357143046685258', '1', '1501392134');
INSERT INTO `piano_token` VALUES ('3636', '101550', '64b44099a894a175b994014643abbf4d', '860205033172812', '1', '1501394005');
INSERT INTO `piano_token` VALUES ('3639', '101552', '2ebbf7bb64c0a5ca8280e31a656fbd84', '864083032701956', '1', '1501399066');
INSERT INTO `piano_token` VALUES ('3640', '101553', '728a6a8cd1431891d31bb731b3c275a1', '352324074969948', '1', '1501403057');
INSERT INTO `piano_token` VALUES ('3642', '101554', '0f3275703fdb3c47217904f4c65cf130', '8b2b516ad1ae2dc69389290ac9f29ce8', '2', '1501425161');
INSERT INTO `piano_token` VALUES ('3643', '101555', '5731105c15f5a2bf12168db9a23585ff', '868024028561745', '1', '1501425899');
INSERT INTO `piano_token` VALUES ('3644', '101556', '1fd4c28c13ea8880910c3795d939b194', 'a1032af77b9e29f155070ddc28111238', '2', '1501426738');
INSERT INTO `piano_token` VALUES ('3645', '101557', '3f03f607e36cf74af39ba311aa4dcd65', '866017030100330', '1', '1501455341');
INSERT INTO `piano_token` VALUES ('3648', '100949', '24e571bc75ce858cb48e1cfc9327d17f', '47bde6950e6385aa0bf11b948e0a3584', '2', '1501462393');
INSERT INTO `piano_token` VALUES ('3650', '101558', '0fc73134b16bb8e31316a5ce09f64b20', '9100f205bc55caecfc0c2d466d952630', '2', '1501464930');
INSERT INTO `piano_token` VALUES ('3661', '101560', 'ae7d3539c5b64de1f09f7197de6d8ec4', '357784051724118', '1', '1501488813');
INSERT INTO `piano_token` VALUES ('3664', '101561', 'a6557d91527e9b6511cec5a4533298e5', '4846c6a15805e69b', '1', '1501493838');
INSERT INTO `piano_token` VALUES ('3665', '101562', '4f49c0be629b3e31078f8552ff63b272', '869598029816140', '1', '1501502277');
INSERT INTO `piano_token` VALUES ('3666', '101563', '06bc510ab46c9ebb294f41dd65535878', '863792032545145', '1', '1501543474');
INSERT INTO `piano_token` VALUES ('3668', '101564', '4fd964f5256b1a85a6ca0c02ffa013a7', '866642024296370', '1', '1501548863');
INSERT INTO `piano_token` VALUES ('3671', '101565', '453f6767ea8090d4e7f4b7ec799d6ba8', 'ca16728e7d88dcdeb2a49b18f362d928', '2', '1501555997');
INSERT INTO `piano_token` VALUES ('3674', '101566', '69905caff55883dbb1697d7908b1efb9', 'c90253188d67a3c9355a0af73baa36aa', '2', '1501559512');
INSERT INTO `piano_token` VALUES ('3675', '101567', '40b998e2b6459149703c1b373a5c73d5', '862862036772697', '1', '1501562596');
INSERT INTO `piano_token` VALUES ('3682', '100027', 'a4d6fe14ce1154c80060302f8b3d1fb1', 'ac45a27aa30d37e8', '2', '1501993777');
INSERT INTO `piano_token` VALUES ('3683', '101569', '0bcbb721b5ffe6e563e115dd0194cd82', '864292037508767', '1', '1501571771');
INSERT INTO `piano_token` VALUES ('3684', '101570', 'd55266e27fe704b7767814963db8d498', '861316036564886', '1', '1501571982');
INSERT INTO `piano_token` VALUES ('3686', '101571', '1be5209edc13166008883918d81cee7e', '9a7444009fdb4d4795e827c8355e183e', '2', '1501574001');
INSERT INTO `piano_token` VALUES ('3692', '101573', '03d0e302987ecbaf932fd8add92a0ca7', 'd4999886d0842d8ccb9ebdb41f4c7e21', '2', '1501575643');
INSERT INTO `piano_token` VALUES ('3698', '101574', '390ba6b0122b11bbddd7c3023ebe9be3', '638cf46d96a7f09a75c0cfe9100fe482', '2', '1501579050');
INSERT INTO `piano_token` VALUES ('3710', '101575', '6234bf7f44c316c8b8464ddf054165f9', '4be76f9485e355e8c3b1761b45197062', '2', '1501644951');
INSERT INTO `piano_token` VALUES ('3715', '101572', '065fc5e860dd197ee2e5a101b30329a6', '860774039617088', '1', '1501660067');
INSERT INTO `piano_token` VALUES ('3716', '101576', '2a511cb63632805f42326ee7151919b4', 'X6GNU17715104716', '1', '1502087463');
INSERT INTO `piano_token` VALUES ('3722', '101577', '512b3e5ba86ebf493fd45f2d5d3047ef', '863116033722679', '1', '1501665403');
INSERT INTO `piano_token` VALUES ('3723', '101578', '9448bacbfb0e1e9fd8c560e26bbc7875', 'A00000694963AD', '1', '1501666972');
INSERT INTO `piano_token` VALUES ('3724', '101579', '0b21e357d4397ff1e0981c7f2d12ce05', '862629033202402', '1', '1501669085');
INSERT INTO `piano_token` VALUES ('3725', '101580', '325eefd85ce6bc24c308e2cc9adfe025', 'fff5658ff6eccc7d612d400614cd4655', '2', '1501669405');
INSERT INTO `piano_token` VALUES ('3726', '101581', 'a59028f8676018170e0913e7dcdac2b3', '864176032674064', '1', '1501669894');
INSERT INTO `piano_token` VALUES ('3728', '101582', '22a1fb6d738c8f7b13199b81a07ee99b', '860075034062142', '1', '1501672061');
INSERT INTO `piano_token` VALUES ('3729', '101583', 'da334e6bbdda2e6b34e622d08dd3bd6a', '15a23841eb168b8a081e65b2efc9ee54', '2', '1501673105');
INSERT INTO `piano_token` VALUES ('3733', '101584', 'c82254e6784b445def4d6dfae60d01ab', '866796021554353', '1', '1501676653');
INSERT INTO `piano_token` VALUES ('3734', '101585', '6a761099f23b8c17e582879d137d1aba', '866696024089177', '1', '1501676699');
INSERT INTO `piano_token` VALUES ('3740', '101586', 'daf62e495278bd791776832151c1c627', '000000000000000', '1', '1501677923');
INSERT INTO `piano_token` VALUES ('3745', '101587', 'e29866b1cf8feb0eeb878844758c9652', '866021032675117', '1', '1501684322');
INSERT INTO `piano_token` VALUES ('3746', '101588', '82f5804f1760009e034a4b34f1df262d', '355446064047703', '1', '1501715087');
INSERT INTO `piano_token` VALUES ('3757', '101589', 'ef7e91228ad68bb7ca988a922f6cd6c7', '970d03b14207960ee6177f57e3d3b827', '2', '1501734538');
INSERT INTO `piano_token` VALUES ('3758', '101590', 'c697df7fa60d9ae72dd80702194b10b7', '3df41d79117abb973843446d5458b6c5', '2', '1502017156');
INSERT INTO `piano_token` VALUES ('3759', '101591', '1209bd0ec266042f78c6a2f691dce4d0', 'cb589f122aa8b4050066212c35162b70', '2', '1501741359');
INSERT INTO `piano_token` VALUES ('3769', '101592', '6a06b9f9ca2179a4101892b910f1344b', '164a18c30c84e4fbc3ebd455b7f5fe82', '2', '1501747587');
INSERT INTO `piano_token` VALUES ('3773', '101593', 'eeba9025c698a17573d5100710e0e31d', '357357057375498', '1', '1501752944');
INSERT INTO `piano_token` VALUES ('3774', '101594', '3087d3919edcf1642a03a38d45565e90', '864370037951912', '1', '1501753144');
INSERT INTO `piano_token` VALUES ('3776', '101595', '0dac22ff4214feee212571a9bdd76254', '867922025116838', '1', '1501755026');
INSERT INTO `piano_token` VALUES ('3777', '101596', 'fd19364391b6759dec920649129dff5d', '352575071615772', '1', '1501755074');
INSERT INTO `piano_token` VALUES ('3778', '101597', 'dd61753dc36cce3ff4a7d1f14684791a', 'c4d00edad31a025dce8a62f1e9688f18', '2', '1501759592');
INSERT INTO `piano_token` VALUES ('3779', '101598', 'f106a338760d6152f64357db348aed47', 'fa1c51110a8f062d74c8770e1cc146c5', '2', '1501760640');
INSERT INTO `piano_token` VALUES ('3780', '101599', 'f1f1c070a5f278e60235e84f94b76e99', '0182f49f79c6bf68f3e80d210d4e5719', '2', '1501762160');
INSERT INTO `piano_token` VALUES ('3782', '101600', '6d34fa58af5a0f2dce8fdbb00d15788f', '6aed53877bd1e7a9', '1', '1501763368');
INSERT INTO `piano_token` VALUES ('3801', '101601', '64819f6e75521870b7f27ec6aea24614', '863991032337285', '1', '1501817789');
INSERT INTO `piano_token` VALUES ('3810', '101602', 'c0bf0251d211a9b5a8efffdfdd0eb64c', 'f596a3ff8e3685e0d744c321f7f3ed09', '2', '1501832953');
INSERT INTO `piano_token` VALUES ('3811', '101603', '39273cb20b3d0670c7699a7b9442233b', '177b794788b3e89c5b69ef97c08f85d6', '2', '1501832975');
INSERT INTO `piano_token` VALUES ('3815', '101604', 'd8ac1a6a8a0f206b40042b06b5d65647', '53e13108340846ea817b2cbac4248bee', '2', '1501836612');
INSERT INTO `piano_token` VALUES ('3816', '101605', '59a3af7d9aef540dddbccb514fe5892e', '00000000', '2', '1501847064');
INSERT INTO `piano_token` VALUES ('3817', '101606', '8d0171ce7a3719cb7a7aeca7414f8834', 'bbaf21713b800f3ae30c64cab2822b51', '2', '1501850327');
INSERT INTO `piano_token` VALUES ('3828', '101607', 'b3df6d9a8edbe03576518cca75a14709', 'af9ebcdff2722d07010246650cbff148', '2', '1502355011');
INSERT INTO `piano_token` VALUES ('3836', '101609', '55ddfef26333c5a6c4739efd88efa03e', '864225030189326', '1', '1501920661');
INSERT INTO `piano_token` VALUES ('3844', '101610', '349ae891c4fc83172291e77b01a13341', '0ad22c9587ae485404863ac63acb751e', '2', '1501926008');
INSERT INTO `piano_token` VALUES ('3849', '101611', '25dacd0b41b7f3b276ef94fb066cce61', '8ac54e8fbf6729b41275966d53bb7365', '2', '1501986555');
INSERT INTO `piano_token` VALUES ('3851', '101612', '102b2c77bac0bbaca12d21574fa331ad', 'f27c4d29d2aac67f4cfae4e5caac61e1', '2', '1501991715');
INSERT INTO `piano_token` VALUES ('3852', '101613', 'afdafe631be4a3c5965b54810f053430', '865482036448847', '1', '1501996505');
INSERT INTO `piano_token` VALUES ('3853', '101614', '405e28386666b47ff38d965bd3905513', '863473020438086', '1', '1501998066');
INSERT INTO `piano_token` VALUES ('3855', '100501', 'a71ae7b9e4554c52fadfb10337e26628', '357557084237971', '1', '1502019903');
INSERT INTO `piano_token` VALUES ('3856', '101616', '1e6ccfe48acd1cd87f44d0baaac24463', '863968037854803', '1', '1502023108');
INSERT INTO `piano_token` VALUES ('3857', '101618', '35ea31f8ad1587deffd0dd5d5d552850', 'e0345c08a59e2f2861ad391180b68701', '2', '1502024031');
INSERT INTO `piano_token` VALUES ('3858', '101617', '20290b8a7add4d1880a32750caa86fce', '864129035719014', '1', '1502024195');
INSERT INTO `piano_token` VALUES ('3859', '101619', '6ec64370c2aeba7b3b760cd32d0fc55e', 'fe9777d7bbbff7c1308b27f734a6dc72', '2', '1502028673');
INSERT INTO `piano_token` VALUES ('3860', '101620', '8c2e6b75d9bd15df4dfbe9bf166306da', '867119026312942', '1', '1502029680');
INSERT INTO `piano_token` VALUES ('3861', '101621', 'be84455111de9614a6445784c2c1f512', 'A0000061C28138', '1', '1502029682');
INSERT INTO `piano_token` VALUES ('3862', '101622', 'e08f908559a439e27e6baa3896f10bdb', '862785032694617', '1', '1502029815');
INSERT INTO `piano_token` VALUES ('3868', '101623', '549f7b9bd90e5e8ced037b329693ea95', '864133032567764', '1', '1502072987');
INSERT INTO `piano_token` VALUES ('3870', '101624', '695d4ea844da0434caa954bedb025903', 'c09bfb817195c3b1bf7c57cd81cd3166', '2', '1502077009');
INSERT INTO `piano_token` VALUES ('3871', '101472', '1590a435a42bbc106a65263fc2fa5c28', '8dca961042b28529343fd4ad47dee692', '2', '1502081615');
INSERT INTO `piano_token` VALUES ('3872', '101626', '1ef2007211284be5a03713daf9605945', '866145030623488', '1', '1502096702');
INSERT INTO `piano_token` VALUES ('3874', '101627', 'adc36d79489c2edf2855f413047e2a17', '866001026644121', '1', '1502852425');
INSERT INTO `piano_token` VALUES ('3875', '100057', 'ee284b07dd1264efea10c5d411928878', '861836039982835', '1', '1502103815');
INSERT INTO `piano_token` VALUES ('3877', '101628', '58d2d946b974f9a2057cfb411335daec', '868856027520473', '1', '1502139024');
INSERT INTO `piano_token` VALUES ('3883', '101629', 'e1dd73ec4351d9562db0dbd5a961427a', '862767033514606', '1', '1502166743');
INSERT INTO `piano_token` VALUES ('3884', '101630', '24f6d949019688831c03d85ce65d5f81', 'fa66503779be6c4a25124bfe1a6b1997', '2', '1502167317');
INSERT INTO `piano_token` VALUES ('3885', '100472', '1786137e77a2c0c8c322d16fa84f11eb', '559f573636a47ff8', '2', '1502678799');
INSERT INTO `piano_token` VALUES ('3886', '101631', '91bf4c08cee93048b44a07028321f9a0', 'A00000649C63EF', '1', '1502172775');
INSERT INTO `piano_token` VALUES ('3889', '101632', '85cd5fea614241be65f5a4103f6ff5b7', '31ed6d32a86fb0fc49e4475884ed05b4', '2', '1502177089');
INSERT INTO `piano_token` VALUES ('3891', '101633', '26aec9b4bf1a8f275e4593ed3892f00f', '861242031166966', '1', '1502178643');
INSERT INTO `piano_token` VALUES ('3892', '101634', '6d294ce010555a771b93e69f632f530a', '86225503272622', '1', '1502178835');
INSERT INTO `piano_token` VALUES ('3893', '100022', '74bb4ec07e705ede813d0e2fe17ebf54', '14081cf7f711dd56', '2', '1502179489');
INSERT INTO `piano_token` VALUES ('3895', '101635', '4db613e90bb276ff10651bfbd6378c2b', 'A1000058BF57A1', '1', '1502179941');
INSERT INTO `piano_token` VALUES ('3896', '101636', '7369c3c45413ff922873247baf8e8312', '864296038267356', '1', '1502180643');
INSERT INTO `piano_token` VALUES ('3903', '101637', '87b406b9deccb5e7c1c0eb7ee7a7cdd8', '864459033673610', '1', '1502653701');
INSERT INTO `piano_token` VALUES ('3906', '101638', 'c8633b918b0e0b0a76b8a3cc5300f030', '9793f6078a6fe2a0dce35fa741092372', '2', '1502191033');
INSERT INTO `piano_token` VALUES ('3907', '101639', 'ec506e153eee5c8388769fd7d6f09f42', 'bce41d3f60bf2ce6d574255f53d08bbc', '2', '1502192866');
INSERT INTO `piano_token` VALUES ('3908', '101640', '61a28c686e19b673959a582ae5244ed1', 'a0a7ca2e80854aa1339f2ef62308332c', '2', '1502195213');
INSERT INTO `piano_token` VALUES ('3910', '101641', '0287bca45b6888135878cb6cabf9b086', 'e32b9cf75e4982d73f7b2e9cc67d6e09', '2', '1502196474');
INSERT INTO `piano_token` VALUES ('3911', '101642', '0dcfd090f69b0df1e07e87a72a278377', '357212073907016', '1', '1502200800');
INSERT INTO `piano_token` VALUES ('3912', '101643', '1a447a33c9a93843d9bd6d98f5a8d7a0', 'a0000059f0e00b', '1', '1502201161');
INSERT INTO `piano_token` VALUES ('3917', '101644', '6df587c4e1f248ec1df5adc22969ecef', '868698026448300', '1', '1502241643');
INSERT INTO `piano_token` VALUES ('3926', '101645', 'b1d7085b37fa572e11f39f9f600030b4', '357557097576415', '1', '1502247016');
INSERT INTO `piano_token` VALUES ('3928', '101646', '6ec5d337d0181329f128becdeb0e590f', 'ca9923f3cc5f2dccc1c7a9be9f22885f', '2', '1502253401');
INSERT INTO `piano_token` VALUES ('3936', '101647', 'ded5088da855a228063c3d71a2781fc9', '864765033134175', '1', '1502267629');
INSERT INTO `piano_token` VALUES ('3938', '101648', '508578b54becbd30d94c5fcf09c3ccdd', 'A000004F22E8A3', '1', '1502267980');
INSERT INTO `piano_token` VALUES ('3941', '100571', '9368c864ccec92bb27e8d6174364c111', '7YRBBDB6A1805469', '1', '1502853140');
INSERT INTO `piano_token` VALUES ('3942', '101649', '98dd0823cd8079c5ba6a4ecbeece2547', '866399028262920', '1', '1502269367');
INSERT INTO `piano_token` VALUES ('3943', '101650', 'dd0e49771a0b2ed7a9791346fa685967', '867179021609510', '1', '1502271948');
INSERT INTO `piano_token` VALUES ('3944', '101651', '3a80073b9f77c162c1f5954ead467d88', 'bceb625b25781e347f1022c7ae05525a', '2', '1502273549');
INSERT INTO `piano_token` VALUES ('3946', '101652', '3dffd11f15c2190f5287160fe53318d5', '9b03164ce19bf11dfb11dee25f9cf93f', '2', '1502284719');
INSERT INTO `piano_token` VALUES ('3947', '101653', 'e2e78962ca2052a2d419f7ea4b6df140', '861759033444729', '1', '1502284947');
INSERT INTO `piano_token` VALUES ('3948', '101654', '305d3981b002de6f5b34308765e15cec', '99000660086926', '1', '1502285418');
INSERT INTO `piano_token` VALUES ('3949', '101568', '5c0e042dc08d88a8f36e6e680faa897e', '864414037088877', '1', '1502286424');
INSERT INTO `piano_token` VALUES ('3950', '101655', '38a4f8ed72bb2693d062f5ca6c2c269a', '57db833056f36c8ed1da04a86fa9002c', '2', '1502293694');
INSERT INTO `piano_token` VALUES ('3951', '101656', 'd5bb764bc2d3aef96192c7ed511ea450', 'A1000053FACFA4', '1', '1502322367');
INSERT INTO `piano_token` VALUES ('3952', '101657', 'd79d6634bf29edd2de4f7316e2369674', '868679022948865', '1', '1502326500');
INSERT INTO `piano_token` VALUES ('3954', '101658', '0ad8dad82dde620c7116b4812d3c5ac3', '868407024656041', '1', '1502329153');
INSERT INTO `piano_token` VALUES ('3955', '101659', '5aa676c5c75bae53be424f4ba7907db7', '861258035936857', '1', '1502330069');
INSERT INTO `piano_token` VALUES ('3958', '101660', '10720ee87332fc78c99abfdba8def6f6', '99000646476480', '1', '1502331900');
INSERT INTO `piano_token` VALUES ('3959', '101661', '6f427ac1963ff142b4d8c7702af75082', '864398031164034', '1', '1502335514');
INSERT INTO `piano_token` VALUES ('3961', '101662', '7b5a37c2bfeb2a279894b5e166ba258e', '525b3852e74f3a3ab72379f5a455d9d8', '2', '1502336622');
INSERT INTO `piano_token` VALUES ('3962', '101663', '22e39df1af82a932b41525e81fdbda83', '863883036646458', '1', '1502336790');
INSERT INTO `piano_token` VALUES ('3964', '101664', '26fe463d2cf3d73a12f057bdf7efb574', '8fabb141ecee27b8fa9d4cbfe0eb203e', '2', '1502344289');
INSERT INTO `piano_token` VALUES ('3968', '101665', '2f087af4e5023dedaca3ac51aa776aad', '861328031324315', '1', '1502354896');
INSERT INTO `piano_token` VALUES ('3969', '101666', 'a201f716e7daf94fa6b4bacac9f242dc', 'afc4ef717eb253773ef2e50a697e2b63', '2', '1502356601');
INSERT INTO `piano_token` VALUES ('3978', '101668', '2b8d9c3122213466a93cc24a25e5bc9c', 'A0000063B0565A', '1', '1502417410');
INSERT INTO `piano_token` VALUES ('3979', '101257', 'c5aa5ddacf57d723fa78f6e060bc3f86', 'a42d2ead06f1dcaa', '2', '1502433807');
INSERT INTO `piano_token` VALUES ('3980', '101669', '07cfa88cc73b6bb1adbcd5c4b7225587', '862630030789789', '1', '1502422832');
INSERT INTO `piano_token` VALUES ('3981', '101670', 'f4dfb11ff0fde319dac129b31c90893e', 'a6f3b7d138c230e978bee88c49998e56', '2', '1502423218');
INSERT INTO `piano_token` VALUES ('3982', '101608', '290144fad6e31a2077947e1ad0382ffe', '65914ba6d6e2feaec8035912248f43bc', '2', '1502423520');
INSERT INTO `piano_token` VALUES ('3983', '101671', '627e0c6bb5faac1879a7cd16ba14e294', '355457083134836', '1', '1502423534');
INSERT INTO `piano_token` VALUES ('3984', '101672', '04eba0b6b45009397b9cde930bd5fb06', 'b3da44a90f34a016eb3e5e6655f5fad4', '2', '1502425186');
INSERT INTO `piano_token` VALUES ('3988', '100047', '2ccc4042734739c07e8d860b0a4b7f43', '357557097576316', '1', '1502435707');
INSERT INTO `piano_token` VALUES ('3989', '101673', '44cf648f0c80f8293d3bc54148c065ce', '864790039492377', '1', '1502436376');
INSERT INTO `piano_token` VALUES ('3991', '101674', 'eeeca564a385cf7669e78b1c87c2a73a', '357557097576381', '1', '1502439470');
INSERT INTO `piano_token` VALUES ('3992', '101615', 'aa531c0f5abf4cf4d86e46880cbe1dc8', '357557097576431', '1', '1502443530');
INSERT INTO `piano_token` VALUES ('3994', '101090', '1f2c18579f7942681e6e571995de00ed', '357557097576365', '1', '1502782157');
INSERT INTO `piano_token` VALUES ('3996', '101675', 'e0845e7e095f0b5986b85186172533d2', '862206030800072', '1', '1502450688');
INSERT INTO `piano_token` VALUES ('3997', '101676', 'a7d2c914d818277a7f88fdc6fa1743b5', '910c25f193bace15a026f179408d0cac', '2', '1502515301');
INSERT INTO `piano_token` VALUES ('3999', '101677', 'ff79a6f4b824562a3058c99fbc0a0bdb', 'A00000592C5F4A', '1', '1502454246');
INSERT INTO `piano_token` VALUES ('4000', '101678', '8003cdccee2c3c7f0d6cf40f9954d689', 'ded800cb018d3f79af3e93fba873fb7a', '2', '1502455351');
INSERT INTO `piano_token` VALUES ('4001', '101679', 'd310d184bba8b10dc5fcf0274e563f4e', '861069035390775', '1', '1502456470');
INSERT INTO `piano_token` VALUES ('4002', '101680', '888b496061e6aaa5eb4381b504a927ac', '864083034485376', '1', '1502456476');
INSERT INTO `piano_token` VALUES ('4003', '101681', 'b452eb6d225882d35dbb42406cdf9555', '50ee31d12582264b907a3c1b7890248c', '2', '1502519583');
INSERT INTO `piano_token` VALUES ('4004', '101682', 'd11efe9655e41e123a741523e224c1aa', '863127037292221', '1', '1502523245');
INSERT INTO `piano_token` VALUES ('4005', '101683', 'e978be7040ca11522db58be8507d43bc', 'd75c5a45cbf51528ee58f823d1693b4e', '2', '1502524657');
INSERT INTO `piano_token` VALUES ('4006', '101684', 'ac0fce24faefb322d94031bda94865e2', '56e929d821de1030115bd2b9c7554309', '2', '1502529429');
INSERT INTO `piano_token` VALUES ('4007', '101685', '06cce713807ee80377b798644fa3fd64', '864889034985854', '1', '1502530365');
INSERT INTO `piano_token` VALUES ('4008', '101686', 'f1bf4e2acab2219e4f2c73203679d9c7', '356629010160196', '1', '1502536007');
INSERT INTO `piano_token` VALUES ('4009', '101688', '602e68924affb6ea7db81ebda41a2977', 'a000005e038269', '1', '1502537491');
INSERT INTO `piano_token` VALUES ('4010', '101689', 'de8d949675183a0ce1ef3b7584067027', 'ec9aa68ab2c028cc7abb47bdea71b57d', '2', '1502537934');
INSERT INTO `piano_token` VALUES ('4011', '101690', '371cda2aeb31757647a9fe35dc9bc5a2', '8e70df03fde9a4ebebbdc17b26e832d9', '2', '1502546149');
INSERT INTO `piano_token` VALUES ('4012', '101691', '09b3199772c3ad00fd36078d4debe91d', '359701060892627', '1', '1502549387');
INSERT INTO `piano_token` VALUES ('4013', '101692', '48ea7a680a4bcb370be05f6f81fc802c', '864891948770075', '1', '1502550535');
INSERT INTO `piano_token` VALUES ('4014', '101693', '5d16edf2d70feebfa8a71bfe8e40f0e7', '45fa53de77718e0f13a04e5824c46e4a', '2', '1502708624');
INSERT INTO `piano_token` VALUES ('4015', '101694', 'bf7d6b6bc2f55a483a011b5c77831c03', '866574023645424', '1', '1502590808');
INSERT INTO `piano_token` VALUES ('4016', '101695', '5e50ec71439faa29fcb2603cfcdb78a6', '862986037536114', '1', '1502591486');
INSERT INTO `piano_token` VALUES ('4017', '101696', 'cd99740e8476594fa39bb09005c47be4', '6774a8eff203be93f2b356618e7f30df', '2', '1502594309');
INSERT INTO `piano_token` VALUES ('4018', '101697', '6bab023c1a96d36a2a77039f2e369778', '866089032959948', '1', '1502594490');
INSERT INTO `piano_token` VALUES ('4019', '101698', 'a464c9c0242bc02506aa018c97e69630', '355848069664970', '1', '1502598460');
INSERT INTO `piano_token` VALUES ('4020', '101699', '403f8e99e66085f4031043c0bf3ddedd', '865626031352251', '1', '1502598977');
INSERT INTO `piano_token` VALUES ('4021', '101700', 'dcd4628c4462e45e3ebc151a614298ca', '863193035971588', '1', '1502599224');
INSERT INTO `piano_token` VALUES ('4022', '101702', '0478ac1f5da2b9686bd18bb92b0549f6', '867516024658079', '1', '1502613950');
INSERT INTO `piano_token` VALUES ('4023', '101701', 'adc52830555fc9ae569fb10f2c056473', '99000846453274', '1', '1502614096');
INSERT INTO `piano_token` VALUES ('4024', '101703', 'cba675a1703045a92185cb6738d8486c', '99000643130730', '1', '1502616625');
INSERT INTO `piano_token` VALUES ('4025', '101704', '41bfcfb3c1bb2b529fddb0d433a53f51', '861064031444130', '1', '1502620392');
INSERT INTO `piano_token` VALUES ('4026', '101705', 'b3bbfd0511b30939c66f1338c4b0d4bb', '864295032708217', '1', '1502623710');
INSERT INTO `piano_token` VALUES ('4027', '101707', 'b6eced860e047928f4064ddd2d946ae1', 'A0000055F99185', '1', '1502628489');
INSERT INTO `piano_token` VALUES ('4028', '101708', '171a3c9e9719e465f1b50634a09b6bc8', '351560070368624', '1', '1502631975');
INSERT INTO `piano_token` VALUES ('4029', '101709', '9eb725113add34061c91a09530b67996', '868965029844912', '1', '1502632336');
INSERT INTO `piano_token` VALUES ('4030', '101710', '10392cf15a5d5b43218a6696d99fab7e', '9f0af7cb015db4824a64aa71dd0cbe94', '2', '1502634402');
INSERT INTO `piano_token` VALUES ('4031', '101711', '2f97deb1da3cd836ae1754fe0020cf1f', '16fedc0ac44796cc7c3590257e6ffc80', '2', '1502637496');
INSERT INTO `piano_token` VALUES ('4032', '101712', 'd0b43751eedca179b014742a4498058d', '863999039258362', '1', '1502638479');
INSERT INTO `piano_token` VALUES ('4033', '101713', '627968399c3b17afd68a1c0207bb54e3', '6cebea0fd049f2f0ac6c0652ecad482b', '2', '1502671175');
INSERT INTO `piano_token` VALUES ('4034', '101714', '98e5979a23e8df79dc2f7e39825eec5b', 'af355668dea88f58cc048b195922376e', '2', '1502676295');
INSERT INTO `piano_token` VALUES ('4036', '101715', 'f436c6a39846b8efab8f1bf8307ba151', '863911036012734', '1', '1502689933');
INSERT INTO `piano_token` VALUES ('4037', '100084', '71e615e489826e480fd84d0eeb351077', '865766030096465', '1', '1502695147');
INSERT INTO `piano_token` VALUES ('4038', '101716', 'db575363cc9888e22e4bd834a7c28fab', '864233033210735', '1', '1502695328');
INSERT INTO `piano_token` VALUES ('4042', '101717', '78887de6c21d5da65c818ffa0edfe7ea', '862949035223077', '1', '1502698537');
INSERT INTO `piano_token` VALUES ('4043', '101718', 'd265c9ba1ab4ae263ba8d6cb2c6655cb', '861749035440973', '1', '1502699459');
INSERT INTO `piano_token` VALUES ('4045', '101719', 'fd3b1532a100fd1b180e350670ff1d8a', '860482039652028', '1', '1502702162');
INSERT INTO `piano_token` VALUES ('4046', '100218', '67d245474e3c34fb111be06fb4bb9106', '861337031379435', '1', '1502702215');
INSERT INTO `piano_token` VALUES ('4049', '101720', '010269f994f9defc1d940acedd48b1fb', '866150030215723', '1', '1502708206');
INSERT INTO `piano_token` VALUES ('4050', '101721', 'a303a2918d748e808c4abace24595e56', 'b5ba49ebba326babd86ea10afb06f9da', '2', '1502709198');
INSERT INTO `piano_token` VALUES ('4051', '100021', '7169e6d58da9bd0186ae0cf88978cb17', '5c637e92d0033fe4', '1', '1502850618');
INSERT INTO `piano_token` VALUES ('4052', '101722', 'b76993873308ed50df5f903a51dfe501', '863295035528779', '1', '1502717987');
INSERT INTO `piano_token` VALUES ('4053', '101723', 'cbbb8e4340c31d772ccb2cc9c6a64d1b', 'aaaa3cea346ebed2c4dcb6be86e0e9d2', '2', '1502719411');
INSERT INTO `piano_token` VALUES ('4054', '101724', '0d5b4cb7d085e7b6b15dd750c0b8cf0b', '864278032485457', '1', '1502720338');
INSERT INTO `piano_token` VALUES ('4056', '101725', 'e49312e61858b31a4507cde4582b521c', '866351032202335', '1', '1502760890');
INSERT INTO `piano_token` VALUES ('4057', '101726', 'a08807b1d0935b82f19171bd533ec5c1', '746bfacb3c7642114d8c2359dd5efdd8', '2', '1502764379');
INSERT INTO `piano_token` VALUES ('4059', '100051', '791ea2fb094fbaa11f13e381532fa94d', 'ffbc22d4f3afdc0cb5e4dcaaf8c83368', '2', '1502766152');
INSERT INTO `piano_token` VALUES ('4060', '101424', '1645e6da62c08e91e8d5f1b54f53d633', '862107031945223', '1', '1502768673');
INSERT INTO `piano_token` VALUES ('4061', '101727', 'c70fef10ee7a1faa06d8db1d688ff6da', '862538034189874', '1', '1502771198');
INSERT INTO `piano_token` VALUES ('4062', '101728', 'd2e11d90d0269f5fe32f171dba935301', 'af07be644a8162c129f798b63799c2de', '2', '1502775315');
INSERT INTO `piano_token` VALUES ('4063', '100004', '9ecc2f50e2f80a322a9641befa79e54b', '8741d52bfd088694', '2', '1502848792');
INSERT INTO `piano_token` VALUES ('4067', '101380', 'afa6e0ec31bbc5b68a667935d7f7ddda', 'd8e47994f9c62afc', '2', '1502854494');
INSERT INTO `piano_token` VALUES ('4068', '101729', '6ce5554611e56d082dc0d8fe677d974e', '866042036296791', '1', '1502782024');
INSERT INTO `piano_token` VALUES ('4071', '100023', '0b1841ce038dd3716e787639a1eb83e5', '357557099604454', '1', '1502785893');
INSERT INTO `piano_token` VALUES ('4072', '100036', 'f0b4496e16844eb1319a24a00579690f', '99000828574648', '1', '1502842480');
INSERT INTO `piano_token` VALUES ('4073', '101732', '4fe3b6b877798428d0e0650051a4cd83', '863167035068389', '1', '1502792089');
INSERT INTO `piano_token` VALUES ('4074', '101733', '2fbed44736ea24553e75fdd50ff0adb6', '94a10ba83aea7f47748a401cb4e97d0b', '2', '1502792581');
INSERT INTO `piano_token` VALUES ('4075', '101734', '70a9411b54e1c5598e18b267cd6a60db', '863065037685640', '1', '1502795933');
INSERT INTO `piano_token` VALUES ('4076', '101735', '26b7916675884a59bae0f97e5f5aed92', '863678038034814', '1', '1502800287');
INSERT INTO `piano_token` VALUES ('4077', '100032', 'ad39fa09cc1e97f9641ff5aad2662a98', 'cfbfac56ab30b9e0', '2', '1502849104');
INSERT INTO `piano_token` VALUES ('4078', '101736', '5fb7026af0e19445c5a6e349208ec190', '355309070441734', '1', '1502850256');
INSERT INTO `piano_token` VALUES ('4079', '101737', '9b05d39a4b3549d7700dd290b584d90b', '70084a7116616cb379f508548acebfac', '2', '1502851031');
INSERT INTO `piano_token` VALUES ('4080', '101738', 'ddd506003ae131dd938547d03909e648', '1b15a10f405a742e27535a5e6e92f025', '2', '1502852915');

-- ----------------------------
-- Table structure for `s_about_us`
-- ----------------------------
DROP TABLE IF EXISTS `s_about_us`;
CREATE TABLE `s_about_us` (
  `about_us_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '关于我们表自增id',
  `about_us_title` varchar(255) NOT NULL COMMENT '标题',
  `about_us_content` text NOT NULL COMMENT '内容',
  `about_us_sort` int(10) NOT NULL COMMENT '排序',
  `about_us_creattime` datetime NOT NULL COMMENT ' 发布时间',
  PRIMARY KEY (`about_us_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关于我们表';

-- ----------------------------
-- Records of s_about_us
-- ----------------------------

-- ----------------------------
-- Table structure for `s_advertising`
-- ----------------------------
DROP TABLE IF EXISTS `s_advertising`;
CREATE TABLE `s_advertising` (
  `advertising_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '广告表自增id',
  `advertising_title` varchar(256) NOT NULL COMMENT '标题',
  `advertising_img` varchar(256) NOT NULL COMMENT '图片',
  `advertising_mid` bigint(20) NOT NULL COMMENT '模块id',
  `advertising_url` varchar(256) NOT NULL COMMENT '链接',
  `advertising_starttime` bigint(20) NOT NULL COMMENT '创建时间，时间戳',
  `advertising_finishtime` bigint(20) NOT NULL COMMENT '结束时间，时间戳',
  `advertising_iscrowd` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否是群广告，0为否，1为是',
  PRIMARY KEY (`advertising_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of s_advertising
-- ----------------------------

-- ----------------------------
-- Table structure for `s_fifth_mark`
-- ----------------------------
DROP TABLE IF EXISTS `s_fifth_mark`;
CREATE TABLE `s_fifth_mark` (
  `fifth_mark_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '第五标识自增id',
  `fifth_mark_fid` bigint(20) NOT NULL COMMENT '第四标识id',
  `fifth_mark_name` varchar(256) NOT NULL COMMENT '名称',
  `fifth_mark_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `fifth_mark_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`fifth_mark_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第五标识表';

-- ----------------------------
-- Records of s_fifth_mark
-- ----------------------------

-- ----------------------------
-- Table structure for `s_first_mark`
-- ----------------------------
DROP TABLE IF EXISTS `s_first_mark`;
CREATE TABLE `s_first_mark` (
  `first_mark_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '第一标识自增id',
  `first_mark_mid` bigint(20) NOT NULL COMMENT '模块id',
  `first_mark_type` int(5) NOT NULL DEFAULT '1' COMMENT '0为固定标识，1为普通群，2为社交群，3为企业家，4为二手市场',
  `firsth_mark_name` varchar(256) NOT NULL COMMENT '标识名称',
  `firsth_mark_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `firsth_mark_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`first_mark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='第一标识';

-- ----------------------------
-- Records of s_first_mark
-- ----------------------------
INSERT INTO `s_first_mark` VALUES ('1', '2', '1', 'country', '1', '0000-00-00 00:00:00');
INSERT INTO `s_first_mark` VALUES ('2', '2', '1', 'school', '2', '0000-00-00 00:00:00');
INSERT INTO `s_first_mark` VALUES ('3', '2', '1', 'interest', '3', '0000-00-00 00:00:00');
INSERT INTO `s_first_mark` VALUES ('4', '3', '1', 'year', '1', '2018-05-23 16:09:17');
INSERT INTO `s_first_mark` VALUES ('5', '3', '1', 'school', '2', '2018-05-23 16:10:06');
INSERT INTO `s_first_mark` VALUES ('6', '3', '1', 'college', '3', '2018-05-23 16:10:26');
INSERT INTO `s_first_mark` VALUES ('7', '3', '1', 'profession', '4', '2018-05-23 16:10:44');
INSERT INTO `s_first_mark` VALUES ('8', '5', '4', 'static', '0', '2018-06-08 11:43:49');
INSERT INTO `s_first_mark` VALUES ('9', '5', '4', 'money', '0', '2018-06-08 11:44:21');
INSERT INTO `s_first_mark` VALUES ('10', '5', '4', 'state', '0', '2018-06-08 11:50:27');
INSERT INTO `s_first_mark` VALUES ('11', '5', '4', 'city', '0', '2018-06-08 11:50:57');
INSERT INTO `s_first_mark` VALUES ('12', '5', '4', 'university', '0', '2018-06-08 11:51:33');
INSERT INTO `s_first_mark` VALUES ('13', '5', '1', 'state', '0', '2018-06-12 16:53:54');
INSERT INTO `s_first_mark` VALUES ('14', '5', '1', 'city', '0', '2018-06-12 16:54:32');
INSERT INTO `s_first_mark` VALUES ('15', '5', '1', 'university', '0', '2018-06-12 16:54:53');
INSERT INTO `s_first_mark` VALUES ('16', '4', '1', 'country', '0', '2018-06-13 13:45:20');
INSERT INTO `s_first_mark` VALUES ('17', '4', '1', 'location', '0', '2018-06-13 13:45:47');
INSERT INTO `s_first_mark` VALUES ('18', '4', '1', 'industry', '0', '2018-06-13 13:45:59');
INSERT INTO `s_first_mark` VALUES ('19', '4', '1', 'school', '0', '2018-06-13 13:46:13');
INSERT INTO `s_first_mark` VALUES ('20', '4', '2', 'location', '0', '2018-06-13 14:16:11');
INSERT INTO `s_first_mark` VALUES ('21', '4', '2', 'industry', '0', '2018-06-13 14:16:23');
INSERT INTO `s_first_mark` VALUES ('22', '4', '2', 'major', '0', '2018-06-13 14:17:26');
INSERT INTO `s_first_mark` VALUES ('23', '4', '0', 'joinmoney', '0', '2018-06-14 10:16:16');

-- ----------------------------
-- Table structure for `s_fourth_mark`
-- ----------------------------
DROP TABLE IF EXISTS `s_fourth_mark`;
CREATE TABLE `s_fourth_mark` (
  `fourth_mark_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '第四标识自增id',
  `fourth_mark_tid` bigint(20) NOT NULL COMMENT '第三标识id',
  `fourth_mark_name` varchar(256) NOT NULL COMMENT '名称',
  `fourth_mark_isextend` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否拓展，0为未拓展，1为拓展',
  `fourth_mark_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `fourth_mark_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`fourth_mark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='第四标识表';

-- ----------------------------
-- Records of s_fourth_mark
-- ----------------------------
INSERT INTO `s_fourth_mark` VALUES ('1', '16', 'qqqq', '0', '0', '2018-06-13 14:49:50');
INSERT INTO `s_fourth_mark` VALUES ('2', '17', 'aaa', '0', '0', '2018-06-13 14:50:02');
INSERT INTO `s_fourth_mark` VALUES ('3', '18', 'eee', '0', '0', '2018-06-13 14:54:48');
INSERT INTO `s_fourth_mark` VALUES ('4', '19', 'cccc', '0', '0', '2018-06-13 14:55:06');
INSERT INTO `s_fourth_mark` VALUES ('5', '10', 'dsad', '0', '0', '2018-06-13 16:00:57');
INSERT INTO `s_fourth_mark` VALUES ('6', '10', 'xcxzcxz', '0', '0', '2018-06-13 16:01:06');
INSERT INTO `s_fourth_mark` VALUES ('7', '21', 'sadsa', '0', '0', '2018-06-14 09:40:42');

-- ----------------------------
-- Table structure for `s_help`
-- ----------------------------
DROP TABLE IF EXISTS `s_help`;
CREATE TABLE `s_help` (
  `help_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '帮助表自增id',
  `help_title` varchar(255) NOT NULL COMMENT '标题',
  `help_content` text NOT NULL COMMENT '内容',
  `help_creattime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`help_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帮助表';

-- ----------------------------
-- Records of s_help
-- ----------------------------

-- ----------------------------
-- Table structure for `s_module`
-- ----------------------------
DROP TABLE IF EXISTS `s_module`;
CREATE TABLE `s_module` (
  `module_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '模块表自增id',
  `module_name` varchar(256) NOT NULL COMMENT '模块名',
  `module_content` text COMMENT '模块简介',
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='模块表';

-- ----------------------------
-- Records of s_module
-- ----------------------------
INSERT INTO `s_module` VALUES ('1', 'Home', '');
INSERT INTO `s_module` VALUES ('2', 'Interest', 'This is Interst');
INSERT INTO `s_module` VALUES ('3', 'Academic', 'This is Academic');
INSERT INTO `s_module` VALUES ('4', 'Jobs', 'This is Jobs');
INSERT INTO `s_module` VALUES ('5', 'Life', 'This is Life');

-- ----------------------------
-- Table structure for `s_news`
-- ----------------------------
DROP TABLE IF EXISTS `s_news`;
CREATE TABLE `s_news` (
  `news_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '新闻表自增id',
  `news_title` varchar(256) NOT NULL COMMENT '题标',
  `news_img` varchar(256) NOT NULL COMMENT '图片',
  `news_mid` bigint(20) NOT NULL COMMENT '分类id',
  `news_iscrowd` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否是群新闻，0为不是，1为是',
  `news_type` smallint(1) NOT NULL COMMENT '新闻来源,目前0是新闻链接，1是新闻编辑',
  `news_url` varchar(256) DEFAULT NULL COMMENT '新闻链接',
  `news_content` text COMMENT '新闻编辑',
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='新闻表';

-- ----------------------------
-- Records of s_news
-- ----------------------------
INSERT INTO `s_news` VALUES ('1', 'title1', 'http', '2', '0', '0', 'http://www.baiduc.om', '12fdfdfdfsfaf');

-- ----------------------------
-- Table structure for `s_opinion`
-- ----------------------------
DROP TABLE IF EXISTS `s_opinion`;
CREATE TABLE `s_opinion` (
  `opinion_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '意见表自增id',
  `opinion_uid` bigint(20) NOT NULL COMMENT '用户id',
  `opinion_content` text NOT NULL COMMENT '意见内容',
  `opinion_time` date NOT NULL COMMENT '提交时间',
  PRIMARY KEY (`opinion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='意见反馈表';

-- ----------------------------
-- Records of s_opinion
-- ----------------------------
INSERT INTO `s_opinion` VALUES ('1', '7', 'i am a man', '2018-06-04');
INSERT INTO `s_opinion` VALUES ('2', '7', 'i\nam\nhahha', '2018-06-04');

-- ----------------------------
-- Table structure for `s_proposal`
-- ----------------------------
DROP TABLE IF EXISTS `s_proposal`;
CREATE TABLE `s_proposal` (
  `proposal_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '建议表自增id',
  `proposal_uid` bigint(20) NOT NULL COMMENT '用户id',
  `proposal_tid` bigint(20) NOT NULL COMMENT '建议类型id',
  `proposal_content` text NOT NULL COMMENT '建议内容',
  `proposal_phone` varchar(256) NOT NULL COMMENT '联系电话',
  `proposal_time` datetime NOT NULL COMMENT '提交时间',
  PRIMARY KEY (`proposal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='建议表';

-- ----------------------------
-- Records of s_proposal
-- ----------------------------
INSERT INTO `s_proposal` VALUES ('1', '7', '1', '111', '123456789', '2018-05-09 00:00:00');
INSERT INTO `s_proposal` VALUES ('2', '7', '1', '222', '123456789', '2018-05-09 18:03:42');
INSERT INTO `s_proposal` VALUES ('4', '7', '2', '33', '123456789', '2018-05-09 18:08:43');

-- ----------------------------
-- Table structure for `s_proposal_type`
-- ----------------------------
DROP TABLE IF EXISTS `s_proposal_type`;
CREATE TABLE `s_proposal_type` (
  `proposal_type_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '建议类型表id',
  `proposal_type_content` varchar(256) NOT NULL COMMENT '建议类型内容',
  PRIMARY KEY (`proposal_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='建议类型表';

-- ----------------------------
-- Records of s_proposal_type
-- ----------------------------
INSERT INTO `s_proposal_type` VALUES ('1', 'Website improvement');
INSERT INTO `s_proposal_type` VALUES ('2', 'Other');

-- ----------------------------
-- Table structure for `s_resume_module`
-- ----------------------------
DROP TABLE IF EXISTS `s_resume_module`;
CREATE TABLE `s_resume_module` (
  `resume_module_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '简历模版表自增id',
  `resume_module_name` varchar(255) NOT NULL COMMENT '名称',
  `resume_module_url` varchar(255) NOT NULL COMMENT '路径',
  `resume_module_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `resume_module_createtime` datetime NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`resume_module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='简历的模版表';

-- ----------------------------
-- Records of s_resume_module
-- ----------------------------

-- ----------------------------
-- Table structure for `s_second_mark`
-- ----------------------------
DROP TABLE IF EXISTS `s_second_mark`;
CREATE TABLE `s_second_mark` (
  `second_mark_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '第二标识自增id',
  `second_mark_fid` bigint(20) NOT NULL COMMENT '第一标识id',
  `second_mark_name` varchar(256) NOT NULL COMMENT '名称',
  `second_mark_isextend` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否有拓展，0为没有，1为有',
  `second_mark_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `second_mark_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`second_mark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='第二标识表';

-- ----------------------------
-- Records of s_second_mark
-- ----------------------------
INSERT INTO `s_second_mark` VALUES ('1', '1', 'China', '1', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('2', '1', 'America', '1', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('3', '1', 'India', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('4', '2', 'Harvard', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('5', '2', 'Princeton', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('6', '2', 'Yale', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('7', '3', 'sports', '1', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('8', '3', 'IT', '1', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('9', '3', 'musical', '1', '0', '0000-00-00 00:00:00');
INSERT INTO `s_second_mark` VALUES ('10', '4', '2000', '0', '0', '2018-05-23 16:14:07');
INSERT INTO `s_second_mark` VALUES ('11', '4', '2001', '0', '0', '2018-05-23 16:14:23');
INSERT INTO `s_second_mark` VALUES ('12', '4', '2002', '0', '0', '2018-05-23 16:15:31');
INSERT INTO `s_second_mark` VALUES ('13', '5', 'Harvard University', '0', '0', '2018-05-23 16:16:12');
INSERT INTO `s_second_mark` VALUES ('14', '5', 'Oxford', '0', '0', '2018-05-23 16:18:23');
INSERT INTO `s_second_mark` VALUES ('15', '6', 'College of Information Engineering', '0', '0', '2018-05-23 16:20:18');
INSERT INTO `s_second_mark` VALUES ('16', '6', 'Faculty of Foreign Languages', '0', '0', '2018-05-23 16:21:19');
INSERT INTO `s_second_mark` VALUES ('17', '7', 'Computer', '1', '0', '2018-05-23 16:21:50');
INSERT INTO `s_second_mark` VALUES ('18', '7', 'French', '1', '0', '2018-05-23 16:28:00');
INSERT INTO `s_second_mark` VALUES ('19', '8', 'phone', '0', '0', '2018-06-08 11:56:09');
INSERT INTO `s_second_mark` VALUES ('20', '8', 'company', '0', '0', '2018-06-08 11:56:21');
INSERT INTO `s_second_mark` VALUES ('21', '10', 'Florida', '0', '0', '2018-06-08 11:57:05');
INSERT INTO `s_second_mark` VALUES ('22', '10', 'Hawaii', '0', '0', '2018-06-08 11:58:30');
INSERT INTO `s_second_mark` VALUES ('23', '11', 'Alaska', '0', '0', '2018-06-08 11:59:34');
INSERT INTO `s_second_mark` VALUES ('24', '11', 'Atlanta', '0', '0', '2018-06-08 11:59:48');
INSERT INTO `s_second_mark` VALUES ('25', '12', 'Princeton ', '0', '0', '2018-06-08 12:00:21');
INSERT INTO `s_second_mark` VALUES ('26', '12', 'Harvard ', '0', '0', '2018-06-08 12:00:32');
INSERT INTO `s_second_mark` VALUES ('27', '13', 'Florida', '0', '0', '2018-06-12 16:58:09');
INSERT INTO `s_second_mark` VALUES ('28', '13', 'Hawaii', '0', '0', '2018-06-08 11:58:30');
INSERT INTO `s_second_mark` VALUES ('29', '14', 'Alaska', '0', '0', '2018-06-08 11:59:34');
INSERT INTO `s_second_mark` VALUES ('30', '14', 'Atlanta', '0', '0', '2018-06-08 11:59:48');
INSERT INTO `s_second_mark` VALUES ('31', '15', 'Princeton ', '0', '0', '2018-06-08 12:00:21');
INSERT INTO `s_second_mark` VALUES ('32', '15', 'Harvard ', '0', '0', '2018-06-08 12:00:32');
INSERT INTO `s_second_mark` VALUES ('33', '16', 'China', '1', '0', '2018-06-13 14:33:01');
INSERT INTO `s_second_mark` VALUES ('34', '16', 'America', '1', '0', '2018-06-13 14:33:04');
INSERT INTO `s_second_mark` VALUES ('35', '17', 'Hawaii', '0', '0', '2018-06-13 14:33:40');
INSERT INTO `s_second_mark` VALUES ('36', '17', 'Alaska', '0', '0', '2018-06-13 14:35:26');
INSERT INTO `s_second_mark` VALUES ('37', '18', 'IT', '0', '0', '2018-06-13 14:36:14');
INSERT INTO `s_second_mark` VALUES ('38', '18', 'sports', '0', '0', '2018-06-13 14:36:32');
INSERT INTO `s_second_mark` VALUES ('39', '19', 'Harvard ', '0', '0', '2018-06-13 14:37:13');
INSERT INTO `s_second_mark` VALUES ('40', '19', 'Oxford', '0', '0', '2018-06-13 14:37:26');
INSERT INTO `s_second_mark` VALUES ('41', '20', 'Hawaii', '0', '0', '2018-06-13 14:40:09');
INSERT INTO `s_second_mark` VALUES ('42', '20', 'Alaska', '0', '0', '2018-06-13 14:40:12');
INSERT INTO `s_second_mark` VALUES ('43', '21', 'IT', '0', '0', '2018-06-13 14:41:44');
INSERT INTO `s_second_mark` VALUES ('44', '21', 'sports', '0', '0', '2018-06-13 14:41:47');
INSERT INTO `s_second_mark` VALUES ('45', '22', 'php', '1', '0', '2018-06-13 14:42:05');
INSERT INTO `s_second_mark` VALUES ('46', '22', 'java', '0', '0', '2018-06-13 14:42:23');
INSERT INTO `s_second_mark` VALUES ('47', '23', '100', '0', '0', '2018-06-14 10:16:53');
INSERT INTO `s_second_mark` VALUES ('48', '23', '200', '0', '0', '2018-06-14 10:17:07');
INSERT INTO `s_second_mark` VALUES ('49', '23', '500', '0', '0', '2018-06-14 10:17:17');
INSERT INTO `s_second_mark` VALUES ('50', '23', '1000', '0', '0', '2018-06-14 10:17:26');

-- ----------------------------
-- Table structure for `s_third_mark`
-- ----------------------------
DROP TABLE IF EXISTS `s_third_mark`;
CREATE TABLE `s_third_mark` (
  `third_mark_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '第三标识自增id',
  `third_mark_sid` bigint(20) NOT NULL COMMENT '第二标识id',
  `third_mark_name` varchar(256) NOT NULL COMMENT '名称',
  `third_mark_isextend` smallint(1) NOT NULL DEFAULT '0' COMMENT '否是拓展，0为未拓展，1为拓展',
  `third_mark_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `third_mark_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`third_mark_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='第三标识';

-- ----------------------------
-- Records of s_third_mark
-- ----------------------------
INSERT INTO `s_third_mark` VALUES ('1', '7', 'basketball', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('2', '7', 'football', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('3', '7', 'table tennis', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('4', '8', 'IOS', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('5', '8', 'ANDROID', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('6', '8', 'PHP', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('7', '9', 'violin', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('8', '9', 'piano', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('9', '9', 'saxophone', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `s_third_mark` VALUES ('10', '1', 'guangdong', '1', '0', '2018-05-18 11:08:55');
INSERT INTO `s_third_mark` VALUES ('11', '1', 'beijing', '0', '0', '2018-05-18 11:09:12');
INSERT INTO `s_third_mark` VALUES ('12', '17', 'java', '0', '0', '2018-05-23 16:34:50');
INSERT INTO `s_third_mark` VALUES ('13', '17', 'php', '0', '0', '2018-05-23 16:35:03');
INSERT INTO `s_third_mark` VALUES ('14', '18', 'history', '0', '0', '2018-05-23 16:37:01');
INSERT INTO `s_third_mark` VALUES ('15', '18', 'communication', '0', '0', '2018-05-23 16:36:58');
INSERT INTO `s_third_mark` VALUES ('16', '33', '111', '1', '0', '2018-06-13 14:48:12');
INSERT INTO `s_third_mark` VALUES ('17', '41', '222', '1', '0', '2018-06-13 14:48:40');
INSERT INTO `s_third_mark` VALUES ('18', '34', '333', '1', '0', '2018-06-13 14:53:58');
INSERT INTO `s_third_mark` VALUES ('19', '42', '444', '1', '0', '2018-06-13 14:54:18');
INSERT INTO `s_third_mark` VALUES ('20', '34', '222', '0', '0', '2018-06-13 15:24:25');
INSERT INTO `s_third_mark` VALUES ('21', '45', '112233', '1', '0', '2018-06-14 09:37:21');
INSERT INTO `s_third_mark` VALUES ('22', '45', '3344455', '0', '0', '2018-06-14 09:37:46');

-- ----------------------------
-- Table structure for `u_concerns`
-- ----------------------------
DROP TABLE IF EXISTS `u_concerns`;
CREATE TABLE `u_concerns` (
  `concerns_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '关注表自增id',
  `concerns_uid` bigint(20) NOT NULL COMMENT '所属用户',
  `concerns_cuid` bigint(20) NOT NULL COMMENT '关注的用户',
  `concerns_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0：取消关注 1 关注',
  `concerns_gid` bigint(20) NOT NULL COMMENT '关注分组id',
  `concerns_name` varchar(255) DEFAULT NULL COMMENT '备注名',
  `concerns_time` datetime NOT NULL COMMENT '关注时间',
  PRIMARY KEY (`concerns_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='关注表';

-- ----------------------------
-- Records of u_concerns
-- ----------------------------
INSERT INTO `u_concerns` VALUES ('1', '7', '7', '0', '0', null, '2018-06-19 13:21:13');

-- ----------------------------
-- Table structure for `u_concerns_group`
-- ----------------------------
DROP TABLE IF EXISTS `u_concerns_group`;
CREATE TABLE `u_concerns_group` (
  `concerns_group_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '关注的分组自增id',
  `concerns_group_name` varchar(256) NOT NULL COMMENT '组名',
  PRIMARY KEY (`concerns_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关注的分组表';

-- ----------------------------
-- Records of u_concerns_group
-- ----------------------------

-- ----------------------------
-- Table structure for `u_crowd`
-- ----------------------------
DROP TABLE IF EXISTS `u_crowd`;
CREATE TABLE `u_crowd` (
  `crowd_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '普通群自增id',
  `crowd_mid` bigint(20) NOT NULL COMMENT '模块id',
  `crowd_type` smallint(3) NOT NULL DEFAULT '1' COMMENT '默认1为普通群，2为社交网络群',
  `crowd_uid` bigint(20) NOT NULL COMMENT '用户的id',
  `crowd_name` varchar(256) NOT NULL COMMENT '群名称',
  `crowd_icon` varchar(256) NOT NULL COMMENT '群头像',
  `crowd_scool` varchar(255) DEFAULT NULL COMMENT '毕业院校',
  `crowd_scooltime` varchar(255) DEFAULT NULL COMMENT '毕业时间',
  `crowd_profession` varchar(255) DEFAULT NULL COMMENT '职业岗位',
  `crowd_company` varchar(255) DEFAULT NULL COMMENT '在职公司',
  `crowd_help` text COMMENT '能够提供的帮助',
  `crowd_intro` text NOT NULL COMMENT '群简介',
  `crowd_peoplenum` int(10) NOT NULL DEFAULT '0' COMMENT '群人数',
  `crowd_firstmarks` varchar(256) DEFAULT NULL COMMENT '群第一层标识',
  `crowd_secondmarks` varchar(255) DEFAULT NULL COMMENT '第二层标识',
  `crowd_thirdmarks` varchar(255) DEFAULT NULL COMMENT '第三层标识',
  `crowd_fourthmarks` varchar(255) DEFAULT NULL COMMENT '第四层标识',
  `crowd_views` int(15) DEFAULT '0' COMMENT '浏览次数',
  `crowd_creattime` datetime NOT NULL COMMENT '创建时间',
  `crowd_updatatime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`crowd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='普通群表';

-- ----------------------------
-- Records of u_crowd
-- ----------------------------
INSERT INTO `u_crowd` VALUES ('1', '2', '1', '7', '1', '2018-05-18/5afe3492f11ea.jpg', null, null, null, null, null, '1', '1', '1,2,3', '2,4,7', '1', '', '0', '2018-05-18 10:04:03', null);
INSERT INTO `u_crowd` VALUES ('2', '2', '1', '7', '1', '2018-05-18/5afe34fec3c01.jpg', null, null, null, null, null, '1', '1', '1,2,3', '2,4,7', '1', '', '0', '2018-05-18 10:05:50', null);
INSERT INTO `u_crowd` VALUES ('3', '2', '1', '7', '1', '2018-05-18/5afe362f29cc2.jpg', null, null, null, null, null, '1', '1', '1,2,3', '1,4,8', '4', '', '0', '2018-05-18 10:10:55', null);
INSERT INTO `u_crowd` VALUES ('4', '2', '1', '7', 'eye', '2018-05-18/5afe41a07c736.jpg', null, null, null, null, null, 'this is my eye', '1', '1,2,3', '1,4,7', '2', '', '0', '2018-05-18 10:59:44', null);
INSERT INTO `u_crowd` VALUES ('5', '2', '1', '7', 'love', '2018-05-18/5afe4519332ad.jpg', null, null, null, null, null, 'this is my love', '1', '1,2,3', '1,4,7', '10,1', '', '0', '2018-05-18 11:14:33', null);
INSERT INTO `u_crowd` VALUES ('6', '2', '1', '7', 'yesss', '2018-05-18/5afe8475916d0.jpg', null, null, null, null, null, 'xxxx', '1', '1,2,3', '1,4,7', '10,1', '', '0', '2018-05-18 15:44:53', null);
INSERT INTO `u_crowd` VALUES ('7', '2', '1', '7', 'asss', '2018-05-21/5b021dc2b4fd0.jpg', null, null, null, null, null, 'asss', '1', '1,2,3', '1,4,7', '10,3', '', '0', '2018-05-21 09:15:46', null);
INSERT INTO `u_crowd` VALUES ('8', '3', '1', '7', '122', '2018-05-23/5b053a0de8971.jpg', null, null, null, null, null, '1133', '1', '4,5,6,7', '10,13,15,17', '12', '', '0', '2018-05-23 17:53:18', null);
INSERT INTO `u_crowd` VALUES ('9', '3', '1', '7', '大苏打', '2018-05-23/5b053a97b9afb.jpg', null, null, null, null, null, '常出现常出现', '1', '4,5,6,7', '12,13,16,17', '13', '', '0', '2018-05-23 17:55:35', null);
INSERT INTO `u_crowd` VALUES ('10', '3', '1', '7', '给对方符合', '2018-05-23/5b053ac843392.jpg', null, null, null, null, null, '深层次', '1', '4,5,6,7', '11,14,15,18', '14', '', '0', '2018-05-23 17:56:24', null);
INSERT INTO `u_crowd` VALUES ('11', '3', '1', '7', '达', '2018-05-23/5b053af1b3dce.jpg', null, null, null, null, null, '艾丝凡', '1', '4,5,6,7', '12,13,15,18', '15', '', '0', '2018-05-23 17:57:05', null);
INSERT INTO `u_crowd` VALUES ('12', '2', '1', '7', '1', '2018-06-08/5b1a17d2e7dbd.png', null, null, null, null, null, '1', '1', '1,2,3', '21,23,25,19', '', '', '0', '2018-06-08 13:44:51', null);
INSERT INTO `u_crowd` VALUES ('13', '5', '1', '7', 'boy', '2018-06-12/5b1f9186ddba2.jpg', null, null, null, null, null, 'boyfirends', '1', '13,14,15', '27,29,32', '', '', '0', '2018-06-12 17:25:27', null);
INSERT INTO `u_crowd` VALUES ('14', '4', '1', '7', '1', '2018-06-13/5b20fa6d159ee.png', null, null, null, null, null, '1', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-13 19:05:17', null);
INSERT INTO `u_crowd` VALUES ('15', '4', '1', '7', '1', '2018-06-13/5b20fad421cd4.png', null, null, null, null, null, '1', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-13 19:07:00', null);
INSERT INTO `u_crowd` VALUES ('16', '4', '2', '7', 'sad', '2018-06-14/5b221d0a5d9c3.png', 'asd', 'asdas', 'dasd', 'asda', 'sada', 'asd', '1', '13,14,15', '41,43,45', '21', '7', '0', '2018-06-14 15:45:14', null);
INSERT INTO `u_crowd` VALUES ('17', '4', '2', '7', 'dasd', '2018-06-14/5b221d430ae7b.png', 'sadas', 'asdas', 'sada', 'sdasd', 'sada', 'asd', '1', '13,14,15', '41,43,45', '', '', '0', '2018-06-14 15:46:11', null);
INSERT INTO `u_crowd` VALUES ('18', '4', '1', '7', '1', '2018-06-14/5b224eab309bc.png', null, null, null, null, null, '1', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-14 19:16:59', null);
INSERT INTO `u_crowd` VALUES ('19', '4', '1', '7', 'e\'w\'q', '2018-06-14/5b224ec348def.png', null, null, null, null, null, '硕大的', '1', '13,14,15', '34,35,37,39', '18', '3', '0', '2018-06-14 19:17:23', null);
INSERT INTO `u_crowd` VALUES ('20', '4', '1', '7', '硕大的', '2018-06-14/5b224edb4c614.jpg', null, null, null, null, null, '阿斯大赛的和空间啊好多了', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-14 19:17:47', null);
INSERT INTO `u_crowd` VALUES ('21', '4', '1', '7', '撒旦撒奥', '2018-06-14/5b224eed31494.jpg', null, null, null, null, null, '三大倒萨', '1', '13,14,15', '33,35,37,40', '16', '1', '0', '2018-06-14 19:18:05', null);
INSERT INTO `u_crowd` VALUES ('22', '4', '1', '7', '大撒旦', '2018-06-14/5b224f04d995f.jpg', null, null, null, null, null, '大撒旦', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-14 19:18:29', null);
INSERT INTO `u_crowd` VALUES ('23', '4', '1', '7', '撒大声地', '2018-06-14/5b224f154afe1.jpg', null, null, null, null, null, '大撒旦', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-14 19:18:45', null);
INSERT INTO `u_crowd` VALUES ('24', '4', '1', '7', '打', '2018-06-14/5b224f244c6c4.jpg', null, null, null, null, null, '大撒旦', '1', '13,14,15', '34,35,38,39', '18', '3', '0', '2018-06-14 19:19:00', null);
INSERT INTO `u_crowd` VALUES ('25', '4', '1', '7', '打', '2018-06-14/5b224f3436ac2.jpg', null, null, null, null, null, '大石', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-14 19:19:16', null);
INSERT INTO `u_crowd` VALUES ('26', '4', '1', '7', '打', '2018-06-14/5b224f530878c.jpg', null, null, null, null, null, 'dsadas', '1', '13,14,15', '33,35,37,39', '16', '1', '0', '2018-06-14 19:19:47', null);
INSERT INTO `u_crowd` VALUES ('27', '2', '1', '7', '1', '2018-06-14/5b224fc763f0c.jpg', null, null, null, null, null, '1', '1', '1,2,3', '2,4,7', '1', '', '0', '2018-06-14 19:21:43', null);
INSERT INTO `u_crowd` VALUES ('28', '2', '1', '7', '11', '2018-06-14/5b224fe485cb7.jpg', null, null, null, null, null, '11', '1', '1,2,3', '2,4,7', '1', '', '0', '2018-06-14 19:22:12', null);
INSERT INTO `u_crowd` VALUES ('29', '2', '1', '7', '1', '2018-06-14/5b224ff536ed1.jpg', null, null, null, null, null, '1', '1', '1,2,3', '1,5,7', '10,1', '6', '0', '2018-06-14 19:22:29', null);
INSERT INTO `u_crowd` VALUES ('30', '2', '1', '7', '1', '2018-06-14/5b225009a5ceb.jpg', null, null, null, null, null, '1', '1', '1,2,3', '1,4,7', '10,1', '5', '0', '2018-06-14 19:22:49', null);
INSERT INTO `u_crowd` VALUES ('31', '2', '1', '7', '11', '2018-06-14/5b225019cd56f.jpg', null, null, null, null, null, '111', '1', '1,2,3', '1,4,7', '11,1', '', '0', '2018-06-14 19:23:06', null);
INSERT INTO `u_crowd` VALUES ('32', '2', '1', '7', '飒沓', '2018-06-14/5b2250283e3b0.jpg', null, null, null, null, null, '大撒旦', '1', '1,2,3', '2,4,7', '1', '', '0', '2018-06-14 19:23:20', null);
INSERT INTO `u_crowd` VALUES ('33', '2', '1', '7', '大撒旦', '2018-06-14/5b2250360606b.jpg', null, null, null, null, null, '大撒旦', '1', '1,2,3', '3,5,9', '7', '', '0', '2018-06-14 19:23:34', null);

-- ----------------------------
-- Table structure for `u_crowd_condition`
-- ----------------------------
DROP TABLE IF EXISTS `u_crowd_condition`;
CREATE TABLE `u_crowd_condition` (
  `crowd_condition_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '群加入条件表自增id',
  `crowd_condition_cid` bigint(20) NOT NULL COMMENT '群id',
  `crowd_condition_university` varchar(255) DEFAULT NULL COMMENT '学校',
  `crowd_condition_college` varchar(255) DEFAULT NULL COMMENT '学院',
  `crowd_condition_specialty` varchar(255) DEFAULT NULL COMMENT '专业',
  `crowd_condition_graduatetime` varchar(255) DEFAULT NULL COMMENT '毕业时间',
  `crowd_condition_higheducation` varchar(255) DEFAULT NULL COMMENT '最高学历',
  `crowd_condition_maxpeople` int(10) DEFAULT NULL COMMENT '最大人数',
  `crowd_condition_joinmoney` int(10) DEFAULT NULL COMMENT '加入费用',
  PRIMARY KEY (`crowd_condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='群加入条件表';

-- ----------------------------
-- Records of u_crowd_condition
-- ----------------------------
INSERT INTO `u_crowd_condition` VALUES ('1', '16', 'dsad', 'asd', 'ada', 'ada', 'da', '200', '0');
INSERT INTO `u_crowd_condition` VALUES ('2', '17', 'dsad', 'asdad', 'sadas', 'dsad', 'sadas', '200', '111');

-- ----------------------------
-- Table structure for `u_crowd_member`
-- ----------------------------
DROP TABLE IF EXISTS `u_crowd_member`;
CREATE TABLE `u_crowd_member` (
  `crowd_member_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '群成员自增id',
  `crowd_member_cid` bigint(20) NOT NULL COMMENT '群id',
  `crowd_member_uid` bigint(20) NOT NULL COMMENT '用户id',
  `crowd_member_status` smallint(3) NOT NULL COMMENT '用户状态，目前0为普通成员，1为管理员，2为创建者',
  `crowd_member_logintime` datetime NOT NULL COMMENT '加入时间',
  PRIMARY KEY (`crowd_member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='群成员表';

-- ----------------------------
-- Records of u_crowd_member
-- ----------------------------
INSERT INTO `u_crowd_member` VALUES ('1', '6', '7', '2', '2018-05-18 15:44:53');
INSERT INTO `u_crowd_member` VALUES ('2', '5', '7', '2', '0000-00-00 00:00:00');
INSERT INTO `u_crowd_member` VALUES ('3', '4', '7', '2', '0000-00-00 00:00:00');
INSERT INTO `u_crowd_member` VALUES ('4', '3', '7', '2', '0000-00-00 00:00:00');
INSERT INTO `u_crowd_member` VALUES ('5', '2', '7', '2', '0000-00-00 00:00:00');
INSERT INTO `u_crowd_member` VALUES ('6', '1', '7', '2', '0000-00-00 00:00:00');
INSERT INTO `u_crowd_member` VALUES ('7', '7', '7', '2', '2018-05-21 09:15:46');
INSERT INTO `u_crowd_member` VALUES ('8', '8', '7', '2', '2018-05-23 17:53:18');
INSERT INTO `u_crowd_member` VALUES ('9', '9', '7', '2', '2018-05-23 17:55:35');
INSERT INTO `u_crowd_member` VALUES ('10', '10', '7', '2', '2018-05-23 17:56:24');
INSERT INTO `u_crowd_member` VALUES ('11', '11', '7', '2', '2018-05-23 17:57:05');
INSERT INTO `u_crowd_member` VALUES ('12', '12', '7', '2', '2018-06-08 13:44:51');
INSERT INTO `u_crowd_member` VALUES ('13', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('14', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('15', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('16', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('17', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('18', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('19', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('20', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('21', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('22', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('23', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('24', '12', '7', '0', '2018-06-09 14:14:40');
INSERT INTO `u_crowd_member` VALUES ('25', '12', '8', '0', '2018-06-11 09:50:02');
INSERT INTO `u_crowd_member` VALUES ('26', '11', '8', '0', '2018-06-12 13:53:35');
INSERT INTO `u_crowd_member` VALUES ('27', '13', '7', '2', '2018-06-12 17:25:27');
INSERT INTO `u_crowd_member` VALUES ('28', '11', '9', '0', '2018-06-13 17:40:02');
INSERT INTO `u_crowd_member` VALUES ('29', '13', '9', '0', '2018-06-13 17:50:37');
INSERT INTO `u_crowd_member` VALUES ('30', '7', '9', '0', '2018-06-13 18:08:50');
INSERT INTO `u_crowd_member` VALUES ('31', '14', '7', '2', '2018-06-13 19:05:17');
INSERT INTO `u_crowd_member` VALUES ('32', '15', '7', '2', '2018-06-13 19:07:00');
INSERT INTO `u_crowd_member` VALUES ('33', '16', '7', '2', '2018-06-14 15:45:14');
INSERT INTO `u_crowd_member` VALUES ('34', '17', '7', '2', '2018-06-14 15:46:11');
INSERT INTO `u_crowd_member` VALUES ('35', '18', '7', '2', '2018-06-14 19:16:59');
INSERT INTO `u_crowd_member` VALUES ('36', '19', '7', '2', '2018-06-14 19:17:23');
INSERT INTO `u_crowd_member` VALUES ('37', '20', '7', '2', '2018-06-14 19:17:47');
INSERT INTO `u_crowd_member` VALUES ('38', '21', '7', '2', '2018-06-14 19:18:05');
INSERT INTO `u_crowd_member` VALUES ('39', '22', '7', '2', '2018-06-14 19:18:29');
INSERT INTO `u_crowd_member` VALUES ('40', '23', '7', '2', '2018-06-14 19:18:45');
INSERT INTO `u_crowd_member` VALUES ('41', '24', '7', '2', '2018-06-14 19:19:00');
INSERT INTO `u_crowd_member` VALUES ('42', '25', '7', '2', '2018-06-14 19:19:16');
INSERT INTO `u_crowd_member` VALUES ('43', '26', '7', '2', '2018-06-14 19:19:47');
INSERT INTO `u_crowd_member` VALUES ('44', '27', '7', '2', '2018-06-14 19:21:43');
INSERT INTO `u_crowd_member` VALUES ('45', '28', '7', '2', '2018-06-14 19:22:12');
INSERT INTO `u_crowd_member` VALUES ('46', '29', '7', '2', '2018-06-14 19:22:29');
INSERT INTO `u_crowd_member` VALUES ('47', '30', '7', '2', '2018-06-14 19:22:49');
INSERT INTO `u_crowd_member` VALUES ('48', '31', '7', '2', '2018-06-14 19:23:06');
INSERT INTO `u_crowd_member` VALUES ('49', '32', '7', '2', '2018-06-14 19:23:20');
INSERT INTO `u_crowd_member` VALUES ('50', '33', '7', '2', '2018-06-14 19:23:34');
INSERT INTO `u_crowd_member` VALUES ('51', '26', '8', '0', '2018-06-19 09:37:41');
INSERT INTO `u_crowd_member` VALUES ('52', '25', '8', '0', '2018-06-19 09:37:54');
INSERT INTO `u_crowd_member` VALUES ('53', '24', '8', '0', '2018-06-19 09:38:02');
INSERT INTO `u_crowd_member` VALUES ('54', '17', '8', '0', '2018-06-19 10:09:06');

-- ----------------------------
-- Table structure for `u_crowd_tab`
-- ----------------------------
DROP TABLE IF EXISTS `u_crowd_tab`;
CREATE TABLE `u_crowd_tab` (
  `crowd_tab_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '群内容分类自增id',
  `crowd_tab_name` varchar(256) NOT NULL COMMENT '分类名称',
  `crowd_tab_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`crowd_tab_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='群的内容分类表';

-- ----------------------------
-- Records of u_crowd_tab
-- ----------------------------
INSERT INTO `u_crowd_tab` VALUES ('1', 'POST', '1');
INSERT INTO `u_crowd_tab` VALUES ('2', 'Q&A', '2');
INSERT INTO `u_crowd_tab` VALUES ('3', 'Resource', '3');

-- ----------------------------
-- Table structure for `u_donation`
-- ----------------------------
DROP TABLE IF EXISTS `u_donation`;
CREATE TABLE `u_donation` (
  `donation_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '捐献表自增id',
  `donation_orderid` varchar(255) NOT NULL COMMENT '捐款订单号',
  `donation_uid` bigint(20) NOT NULL COMMENT '捐款人id',
  `donation_money` bigint(20) NOT NULL COMMENT '金额',
  `donation_coin` bigint(20) NOT NULL DEFAULT '0' COMMENT '赠送的虚拟币',
  `donation_ispay` smallint(3) NOT NULL DEFAULT '0' COMMENT '是否支付，0为未支付，1为已支付',
  `donation_paytype` smallint(3) NOT NULL COMMENT '支付方式，目前1为paypal',
  `donation_paypalid` varchar(255) DEFAULT NULL COMMENT 'paypal的id',
  `donation_static` int(10) NOT NULL DEFAULT '0' COMMENT '支付状态（做提示用）：0为未操作，1为已支付，2为订单金额不正确，3为支付失败',
  `donation_createtime` datetime NOT NULL COMMENT '创建时间',
  `donation_paytime` datetime DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`donation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8 COMMENT='捐款订单表';

-- ----------------------------
-- Records of u_donation
-- ----------------------------
INSERT INTO `u_donation` VALUES ('91', 'dd2018051710421785454', '7', '1100', '110', '1', '1', 'PAY-8EU21875P1192215FLL6OYDY', '1', '2018-05-17 10:42:17', '2018-05-17 10:42:56');
INSERT INTO `u_donation` VALUES ('92', 'dd2018051710542423677', '7', '2200', '220', '1', '1', 'PAY-942563467Y0599039LL6O5ZQ', '1', '2018-05-17 10:54:24', '2018-05-17 10:54:46');
INSERT INTO `u_donation` VALUES ('93', 'dd2018051710560487956', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 10:56:04', null);
INSERT INTO `u_donation` VALUES ('94', 'dd2018051710564533741', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 10:56:45', null);
INSERT INTO `u_donation` VALUES ('95', 'dd2018051710572749070', '7', '2200', '220', '0', '1', null, '0', '2018-05-17 10:57:27', null);
INSERT INTO `u_donation` VALUES ('96', 'dd2018051710581544384', '7', '2200', '220', '0', '1', null, '0', '2018-05-17 10:58:15', null);
INSERT INTO `u_donation` VALUES ('97', 'dd2018051710590711494', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 10:59:07', null);
INSERT INTO `u_donation` VALUES ('98', 'dd2018051711002765170', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:00:27', null);
INSERT INTO `u_donation` VALUES ('99', 'dd2018051711024511661', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:02:45', null);
INSERT INTO `u_donation` VALUES ('100', 'dd2018051711044167021', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:04:41', null);
INSERT INTO `u_donation` VALUES ('101', 'dd2018051711054659251', '7', '2200', '220', '0', '1', null, '0', '2018-05-17 11:05:46', null);
INSERT INTO `u_donation` VALUES ('102', 'dd2018051711120334202', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:12:03', null);
INSERT INTO `u_donation` VALUES ('103', 'dd2018051711124199697', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:12:41', null);
INSERT INTO `u_donation` VALUES ('104', 'dd2018051711144181353', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:14:41', null);
INSERT INTO `u_donation` VALUES ('105', 'dd2018051711324499395', '7', '1100', '110', '1', '1', 'PAY-9AE73654YX743131DLL6PPYQ', '1', '2018-05-17 11:32:44', '2018-05-17 11:33:20');
INSERT INTO `u_donation` VALUES ('106', 'dd2018051711363859007', '7', '1100', '110', '1', '1', 'PAY-40F67157DU9079025LL6PRTI', '1', '2018-05-17 11:36:38', '2018-05-17 11:36:59');
INSERT INTO `u_donation` VALUES ('107', 'dd2018051711381325696', '7', '1100', '110', '1', '1', 'PAY-175277536X753912PLL6PSKY', '1', '2018-05-17 11:38:13', '2018-05-17 11:38:37');
INSERT INTO `u_donation` VALUES ('108', 'dd2018051711385573783', '7', '1100', '110', '1', '1', 'PAY-38D93169GB375341VLL6PSVI', '1', '2018-05-17 11:38:55', '2018-05-17 11:39:16');
INSERT INTO `u_donation` VALUES ('109', 'dd2018051711423755840', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:42:37', null);
INSERT INTO `u_donation` VALUES ('110', 'dd2018051711433843381', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 11:43:38', null);
INSERT INTO `u_donation` VALUES ('111', 'dd2018051712002789736', '7', '2200', '220', '1', '1', 'PAY-5J585508F8475313LLL6P4YQ', '1', '2018-05-17 12:00:27', '2018-05-17 12:01:07');
INSERT INTO `u_donation` VALUES ('112', 'dd2018051713343598956', '7', '1100', '110', '1', '1', 'PAY-1EN78586HN203150CLL6RI4Q', '1', '2018-05-17 13:34:35', '2018-05-17 13:36:11');
INSERT INTO `u_donation` VALUES ('113', 'dd2018051713380271070', '7', '1100', '110', '1', '1', 'PAY-1W49518750892493BLL6RKQI', '1', '2018-05-17 13:38:02', '2018-05-17 13:38:26');
INSERT INTO `u_donation` VALUES ('114', 'dd2018051713450262550', '7', '1100', '110', '1', '1', 'PAY-12292423PL5803920LL6RN2A', '1', '2018-05-17 13:45:02', '2018-05-17 13:45:28');
INSERT INTO `u_donation` VALUES ('115', 'dd2018051713515758229', '7', '1100', '110', '1', '1', 'PAY-53222606PT3858605LL6RRCI', '1', '2018-05-17 13:51:57', '2018-05-17 13:52:47');
INSERT INTO `u_donation` VALUES ('116', 'dd2018051713533145131', '7', '1100', '110', '1', '1', 'PAY-386184614Y556701KLL6RRYQ', '1', '2018-05-17 13:53:31', '2018-05-17 13:54:16');
INSERT INTO `u_donation` VALUES ('117', 'dd2018051713550214729', '7', '1100', '110', '1', '1', 'PAY-04H37882MF075101VLL6RSPQ', '1', '2018-05-17 13:55:02', '2018-05-17 13:55:26');
INSERT INTO `u_donation` VALUES ('118', 'dd2018051714003383649', '7', '1100', '110', '0', '1', null, '0', '2018-05-17 14:00:33', null);
INSERT INTO `u_donation` VALUES ('119', 'dd2018051714022552871', '7', '1100', '110', '1', '1', 'PAY-57C15155V0662570VLL6RV6A', '1', '2018-05-17 14:02:25', '2018-05-17 14:02:48');
INSERT INTO `u_donation` VALUES ('120', 'dd2018051714032654912', '7', '100', '10', '0', '1', null, '0', '2018-05-17 14:03:26', null);
INSERT INTO `u_donation` VALUES ('121', 'dd2018051714053941714', '7', '100', '10', '1', '1', 'PAY-6HB89609X8500773ALL6RXOQ', '1', '2018-05-17 14:05:39', '2018-05-17 14:06:11');
INSERT INTO `u_donation` VALUES ('122', 'dd2018051714082419678', '7', '100', '10', '0', '1', null, '3', '2018-05-17 14:08:24', null);
INSERT INTO `u_donation` VALUES ('123', 'dd2018051714105093369', '7', '1100', '110', '0', '1', null, '3', '2018-05-17 14:10:50', null);
INSERT INTO `u_donation` VALUES ('124', 'dd2018061016130866689', '7', '1100', '110', '0', '1', null, '0', '2018-06-10 16:13:08', null);
INSERT INTO `u_donation` VALUES ('125', 'dd2018061016133046057', '7', '1100', '110', '0', '1', null, '0', '2018-06-10 16:13:30', null);

-- ----------------------------
-- Table structure for `u_firends`
-- ----------------------------
DROP TABLE IF EXISTS `u_firends`;
CREATE TABLE `u_firends` (
  `friends_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `firends_uid` bigint(20) NOT NULL COMMENT '所属用户id',
  `firends_aid` bigint(20) NOT NULL COMMENT '添加好友的id',
  `firends_type` int(10) NOT NULL COMMENT '类型,',
  `firends_updatetime` datetime NOT NULL COMMENT '修改时间',
  `firends_createtime` datetime NOT NULL COMMENT '创建时间',
  `firends_mark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注名',
  PRIMARY KEY (`friends_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='好友表';

-- ----------------------------
-- Records of u_firends
-- ----------------------------
INSERT INTO `u_firends` VALUES ('1', '7', '7', '1', '2018-06-09 15:41:35', '2018-06-09 15:41:38', '');
INSERT INTO `u_firends` VALUES ('2', '7', '7', '1', '2018-06-09 15:41:45', '2018-06-09 15:41:47', '');

-- ----------------------------
-- Table structure for `u_message`
-- ----------------------------
DROP TABLE IF EXISTS `u_message`;
CREATE TABLE `u_message` (
  `message_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '信息自增id',
  `message_title` varchar(256) NOT NULL COMMENT '信息标题',
  `message_content` text NOT NULL COMMENT '信息内容',
  `message_sendtime` date NOT NULL COMMENT '信息发送时间',
  `message_delivertime` date NOT NULL COMMENT '信息送达时间',
  `message_uid` bigint(20) NOT NULL COMMENT '用户id',
  `message_sid` bigint(20) NOT NULL DEFAULT '0' COMMENT '发送用户id，0为admin',
  `message_isread` smallint(1) NOT NULL DEFAULT '0' COMMENT '0，是否已读，1为已读',
  `message_type` tinyint(3) unsigned NOT NULL COMMENT '信息类型 0：系统提示 1：好友申请',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='信息表';

-- ----------------------------
-- Records of u_message
-- ----------------------------
INSERT INTO `u_message` VALUES ('1', 'User:Martin applies to be your friend', 'User: applies to be your friend', '2018-06-13', '2018-06-13', '7', '9', '0', '1');

-- ----------------------------
-- Table structure for `u_note`
-- ----------------------------
DROP TABLE IF EXISTS `u_note`;
CREATE TABLE `u_note` (
  `note_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '帖子表自增id',
  `note_cid` bigint(20) NOT NULL COMMENT '所属群id',
  `note_uid` bigint(20) NOT NULL COMMENT '所属用户id',
  `note_name` varchar(256) NOT NULL COMMENT '帖子名称',
  `note_icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `note_content` text NOT NULL COMMENT '帖子文字内容',
  `note_reward` int(10) DEFAULT NULL COMMENT '悬赏金/下载积分',
  `note_haveanswer` smallint(3) NOT NULL DEFAULT '0' COMMENT '0为还没选择答案，1为选择答案了',
  `note_url` varchar(255) DEFAULT NULL COMMENT '资源的url',
  `note_istop` smallint(1) NOT NULL DEFAULT '0' COMMENT '帖子是否置顶，0为不置顶，1为置顶',
  `note_iswally` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否为精品，0为否，1为是',
  `note_ishide` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否屏蔽，0为已屏蔽，1为未屏蔽',
  `note_comments` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `note_browses` int(10) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `note_type` smallint(3) NOT NULL DEFAULT '1' COMMENT '1为帖子，2为问答，3为资源',
  `note_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`note_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COMMENT='帖子表';

-- ----------------------------
-- Records of u_note
-- ----------------------------
INSERT INTO `u_note` VALUES ('12', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('13', '12', '7', '帖子1', null, '这是帖子', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:34:17');
INSERT INTO `u_note` VALUES ('14', '12', '7', '贴纸2', null, '这是2', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:34:51');
INSERT INTO `u_note` VALUES ('15', '12', '7', '贴纸3', null, '这。。。', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:35:11');
INSERT INTO `u_note` VALUES ('16', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('17', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('18', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('19', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('20', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('21', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('22', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('23', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('24', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('25', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('26', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('27', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('28', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('29', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('30', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('31', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('32', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('33', '12', '7', '11', null, '11111', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-10 10:17:45');
INSERT INTO `u_note` VALUES ('34', '12', '7', '帖子帖子', null, '这是一个比较新的帖子', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-11 10:12:36');
INSERT INTO `u_note` VALUES ('35', '12', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-11 11:53:06');
INSERT INTO `u_note` VALUES ('36', '12', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-11 11:53:38');
INSERT INTO `u_note` VALUES ('37', '12', '8', 'dsad', null, 'dsada', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-11 15:20:17');
INSERT INTO `u_note` VALUES ('38', '12', '7', 'dsa', null, 'this is', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-11 15:37:35');
INSERT INTO `u_note` VALUES ('39', '12', '7', 'qqq', null, 'qqqq', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-11 18:05:44');
INSERT INTO `u_note` VALUES ('40', '12', '7', 'aaaa', null, 'aaaa', '1221', '1', null, '0', '0', '1', '0', '0', '2', '2018-06-11 18:06:14');
INSERT INTO `u_note` VALUES ('41', '12', '7', 'zzzz', null, 'zzzz', '11', '0', '2018-06-11/5b1e49ab595ae.jpg', '0', '0', '1', '0', '0', '3', '2018-06-11 18:06:35');
INSERT INTO `u_note` VALUES ('42', '12', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:14:35');
INSERT INTO `u_note` VALUES ('43', '12', '7', '11', null, '11', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:15:19');
INSERT INTO `u_note` VALUES ('44', '11', '7', 'sa', null, 'as', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:15:46');
INSERT INTO `u_note` VALUES ('45', '11', '7', 'we', null, 'we', '111', '1', null, '0', '0', '1', '0', '0', '2', '2018-06-12 14:40:04');
INSERT INTO `u_note` VALUES ('46', '11', '7', 'zy', null, 'zy', '12', '0', '2018-06-12/5b1f6adf534d0.jpg', '0', '0', '1', '0', '0', '3', '2018-06-12 14:40:31');
INSERT INTO `u_note` VALUES ('47', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('48', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('49', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('50', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('51', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('52', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('53', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('54', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('55', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('56', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('57', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('58', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('59', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('60', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('61', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('62', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('63', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('64', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('65', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('66', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('67', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('68', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('69', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('70', '11', '7', 'ccc', null, 'ccc', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-12 14:56:13');
INSERT INTO `u_note` VALUES ('71', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('72', '13', '7', 'qqq', null, 'dsadsa', '111', '1', null, '0', '0', '1', '0', '0', '2', '2018-06-13 11:24:58');
INSERT INTO `u_note` VALUES ('73', '13', '7', 'zzz', null, 'sada', '1212', '0', '2018-06-13/5b208e9e19802.jpg', '0', '0', '1', '0', '0', '3', '2018-06-13 11:25:18');
INSERT INTO `u_note` VALUES ('74', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('75', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('76', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('77', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('78', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('79', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('80', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('81', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('82', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('83', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('84', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('85', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('86', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('87', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('88', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('89', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('90', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('91', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('92', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('93', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('94', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('95', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('96', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('97', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('98', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('99', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('100', '13', '7', '1', null, '1', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 11:24:25');
INSERT INTO `u_note` VALUES ('101', '0', '0', '', null, '', null, '0', null, '0', '0', '1', '0', '0', '1', '0000-00-00 00:00:00');
INSERT INTO `u_note` VALUES ('102', '12', '7', '11', null, '11', '11', '0', '2018-06-13/5b20c31634cc3.mp4', '0', '0', '1', '0', '0', '3', '2018-06-13 15:09:15');
INSERT INTO `u_note` VALUES ('103', '13', '9', 'Mail', null, 'Come Here', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-13 17:53:09');
INSERT INTO `u_note` VALUES ('104', '7', '9', 'Music', null, 'Android  study video', '2', '0', '2018-06-13/5b20ed7b5e3e9.txt', '0', '0', '1', '0', '0', '3', '2018-06-13 18:10:03');
INSERT INTO `u_note` VALUES ('105', '26', '7', 'dsada', null, 'dsadas', '111', '0', '2018-06-14/5b2262926860b.mp4', '0', '0', '1', '0', '0', '3', '2018-06-14 20:41:54');
INSERT INTO `u_note` VALUES ('106', '26', '7', '1', null, '1111', '111', '0', '2018-06-14/5b226364b161f.mp4', '0', '0', '1', '0', '0', '3', '2018-06-14 20:45:30');
INSERT INTO `u_note` VALUES ('107', '17', '8', '111', null, '11', null, '0', null, '0', '0', '1', '0', '0', '1', '2018-06-19 10:10:06');

-- ----------------------------
-- Table structure for `u_note_comment`
-- ----------------------------
DROP TABLE IF EXISTS `u_note_comment`;
CREATE TABLE `u_note_comment` (
  `note_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '帖子评论表自增id',
  `note_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `note_comment_nid` bigint(20) NOT NULL COMMENT '帖子id',
  `note_comment_content` text NOT NULL COMMENT '评论内容',
  `note_comment_zans` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `note_comment_zaner` text COMMENT '点赞人，''1,2,3...''',
  `note_comment_isreply` smallint(3) NOT NULL DEFAULT '0' COMMENT '是否回复，0为否，1为是',
  `note_comment_reply` text COMMENT '评论的回复',
  `note_comment_isanswer` smallint(3) NOT NULL DEFAULT '0' COMMENT '是否为答案，0为否，1为是',
  `note_comment_createtime` datetime NOT NULL COMMENT '发表时间',
  `note_comment_replytime` datetime DEFAULT NULL COMMENT '作者回复时间',
  PRIMARY KEY (`note_comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='帖子的评论表';

-- ----------------------------
-- Records of u_note_comment
-- ----------------------------
INSERT INTO `u_note_comment` VALUES ('1', '7', '36', '评论评论评论\n、', '0', null, '0', null, '0', '2018-06-11 14:21:45', null);
INSERT INTO `u_note_comment` VALUES ('2', '7', '36', '我去', '0', null, '0', null, '0', '2018-06-11 14:25:27', null);
INSERT INTO `u_note_comment` VALUES ('3', '7', '36', '的就撒李科纳', '0', null, '0', null, '0', '2018-06-11 15:06:10', null);
INSERT INTO `u_note_comment` VALUES ('4', '7', '36', '萨姆麦克雷电脑卡拉屎呢', '0', null, '0', null, '0', '2018-06-11 15:06:19', null);
INSERT INTO `u_note_comment` VALUES ('5', '7', '36', '迪妮莎觉得你啦', '0', null, '0', null, '0', '2018-06-11 15:06:24', null);
INSERT INTO `u_note_comment` VALUES ('6', '7', '36', '年利率从现在', '0', null, '0', null, '0', '2018-06-11 15:06:31', null);
INSERT INTO `u_note_comment` VALUES ('7', '7', '36', '斯大林可能的克拉斯诺克', '0', null, '0', null, '0', '2018-06-11 15:06:38', null);
INSERT INTO `u_note_comment` VALUES ('8', '7', '36', '大口径大了技能', '0', null, '0', null, '0', '2018-06-11 15:06:48', null);
INSERT INTO `u_note_comment` VALUES ('10', '7', '36', '倒萨大跨世纪背带裤那倒是两年来', '0', null, '0', null, '0', '2018-06-11 15:07:26', null);
INSERT INTO `u_note_comment` VALUES ('11', '7', '36', '大撒把到家了吧了算了', '0', null, '0', null, '0', '2018-06-11 15:07:35', null);
INSERT INTO `u_note_comment` VALUES ('12', '7', '39', 'dasd', '0', '', '0', null, '0', '2018-06-11 18:59:32', null);
INSERT INTO `u_note_comment` VALUES ('13', '7', '39', '21121', '1', ',7', '0', null, '0', '2018-06-12 09:48:58', null);
INSERT INTO `u_note_comment` VALUES ('14', '7', '39', 'sadas1', '1', ',7', '0', null, '0', '2018-06-12 09:50:34', null);
INSERT INTO `u_note_comment` VALUES ('15', '7', '39', '1', '0', null, '0', null, '0', '2018-06-12 10:55:52', null);
INSERT INTO `u_note_comment` VALUES ('16', '7', '39', '1', '0', null, '0', null, '0', '2018-06-12 10:55:56', null);
INSERT INTO `u_note_comment` VALUES ('17', '7', '39', '2', '0', null, '0', null, '0', '2018-06-12 10:56:01', null);
INSERT INTO `u_note_comment` VALUES ('18', '7', '39', '1', '0', null, '0', null, '0', '2018-06-12 10:56:05', null);
INSERT INTO `u_note_comment` VALUES ('19', '7', '39', '4', '0', null, '0', null, '0', '2018-06-12 10:56:09', null);
INSERT INTO `u_note_comment` VALUES ('20', '7', '39', '5', '0', null, '0', null, '0', '2018-06-12 10:56:14', null);
INSERT INTO `u_note_comment` VALUES ('21', '7', '39', '6', '0', null, '0', null, '0', '2018-06-12 10:56:19', null);
INSERT INTO `u_note_comment` VALUES ('22', '7', '39', '7', '0', null, '0', null, '0', '2018-06-12 10:56:24', null);
INSERT INTO `u_note_comment` VALUES ('23', '7', '39', '8', '0', null, '0', null, '0', '2018-06-12 10:56:28', null);
INSERT INTO `u_note_comment` VALUES ('24', '7', '39', '9', '0', null, '0', null, '0', '2018-06-12 10:56:33', null);
INSERT INTO `u_note_comment` VALUES ('25', '7', '47', 'dsadas', '1', ',9', '0', null, '0', '2018-06-12 15:07:24', null);
INSERT INTO `u_note_comment` VALUES ('26', '7', '71', 'dsa', '0', '', '0', null, '0', '2018-06-13 11:43:57', null);
INSERT INTO `u_note_comment` VALUES ('27', '9', '47', 'Hello, Busy.', '0', null, '0', null, '0', '2018-06-13 17:38:02', null);
INSERT INTO `u_note_comment` VALUES ('28', '9', '81', 'tttt', '0', null, '0', null, '0', '2018-06-13 17:52:17', null);
INSERT INTO `u_note_comment` VALUES ('29', '9', '103', 'Thanks.', '1', ',9', '0', null, '0', '2018-06-13 17:53:22', null);
INSERT INTO `u_note_comment` VALUES ('30', '9', '104', 'Good', '1', ',9', '0', null, '0', '2018-06-13 18:12:40', null);
INSERT INTO `u_note_comment` VALUES ('31', '9', '104', 'The resouce can not down it', '0', null, '0', null, '0', '2018-06-13 18:13:16', null);
INSERT INTO `u_note_comment` VALUES ('32', '7', '43', 'DSAD', '0', null, '0', null, '0', '2018-06-15 10:18:50', null);
INSERT INTO `u_note_comment` VALUES ('33', '7', '102', '飒沓', '0', null, '0', null, '0', '2018-06-15 11:06:09', null);
INSERT INTO `u_note_comment` VALUES ('34', '7', '40', '大石', '0', null, '0', null, '1', '2018-06-15 11:22:17', null);
INSERT INTO `u_note_comment` VALUES ('35', '7', '41', 'ad1', '0', null, '0', null, '0', '2018-06-15 14:41:27', null);
INSERT INTO `u_note_comment` VALUES ('36', '8', '40', 'xdsa', '0', null, '0', null, '0', '2018-06-15 15:39:08', null);
INSERT INTO `u_note_comment` VALUES ('37', '7', '45', 'sda1', '0', null, '0', null, '1', '2018-06-15 15:49:35', null);
INSERT INTO `u_note_comment` VALUES ('38', '7', '72', 'dsad1', '0', null, '0', null, '1', '2018-06-15 15:50:02', null);
INSERT INTO `u_note_comment` VALUES ('39', '7', '37', 'sdaasd', '0', null, '0', null, '0', '2018-06-15 17:48:01', null);
INSERT INTO `u_note_comment` VALUES ('40', '7', '37', 'sadadsa', '0', null, '0', null, '0', '2018-06-15 17:48:10', null);
INSERT INTO `u_note_comment` VALUES ('41', '7', '38', 'dsadas', '0', null, '0', null, '0', '2018-06-15 17:51:41', null);
INSERT INTO `u_note_comment` VALUES ('42', '8', '107', 'dasd', '0', null, '0', null, '0', '2018-06-19 10:15:20', null);
INSERT INTO `u_note_comment` VALUES ('43', '7', '43', 'sad', '0', null, '0', null, '0', '2018-06-19 13:28:30', null);
INSERT INTO `u_note_comment` VALUES ('44', '7', '43', 'dasd', '0', null, '0', null, '0', '2018-06-19 13:28:35', null);

-- ----------------------------
-- Table structure for `u_note_vi`
-- ----------------------------
DROP TABLE IF EXISTS `u_note_vi`;
CREATE TABLE `u_note_vi` (
  `note_vi_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '帖子的视频图片表自增id',
  `note_vi_nid` bigint(20) NOT NULL COMMENT '帖子id',
  `note_vi_url` varchar(256) NOT NULL COMMENT '视频或图片所在路径',
  `note_vi_type` smallint(3) DEFAULT NULL COMMENT '文件类型，1为图片，2为视频',
  `note_vi_sort` int(10) NOT NULL DEFAULT '0' COMMENT '帖子的图片视频排序',
  PRIMARY KEY (`note_vi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='帖子的视频图片表';

-- ----------------------------
-- Records of u_note_vi
-- ----------------------------
INSERT INTO `u_note_vi` VALUES ('1', '12', '2018-06-10/5b1c8a490f0b3.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('2', '12', '2018-06-10/5b1c8a490fc6b.png', '1', '0');
INSERT INTO `u_note_vi` VALUES ('3', '13', '2018-06-10/5b1c8e29c889a.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('4', '13', '2018-06-10/5b1c8e29c9c22.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('5', '14', '2018-06-10/5b1c8e4b20ca3.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('6', '14', '2018-06-10/5b1c8e4b22be4.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('7', '15', '2018-06-10/5b1c8e5f220bb.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('8', '15', '2018-06-10/5b1c8e5f2c8b6.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('9', '34', '2018-06-11/5b1dda93ed45c.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('10', '35', '2018-06-11/5b1df2227561a.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('11', '35', '2018-06-11/5b1df2227755a.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('12', '36', '2018-06-11/5b1df242a08e2.mp4', '2', '0');
INSERT INTO `u_note_vi` VALUES ('13', '37', '2018-06-11/5b1e22b155080.png', '1', '0');
INSERT INTO `u_note_vi` VALUES ('14', '38', '2018-06-11/5b1e26bee46d3.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('15', '39', '2018-06-11/5b1e49782d2ef.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('16', '39', '2018-06-11/5b1e497832cc8.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('17', '40', '2018-06-11/5b1e499684857.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('18', '40', '2018-06-11/5b1e49968d111.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('19', '41', '2018-06-11/5b1e49aba0a5f.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('20', '41', '2018-06-11/5b1e49aba21cf.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('21', '42', '2018-06-12/5b1f64cb5b5bc.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('22', '43', '2018-06-12/5b1f64f7d35d5.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('23', '44', '2018-06-12/5b1f6512d6ea6.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('24', '45', '2018-06-12/5b1f6ac45ee33.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('25', '46', '2018-06-12/5b1f6adf73c60.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('26', '47', '2018-06-12/5b1f6e8d4b36e.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('27', '47', '2018-06-12/5b1f6e8d4c30e.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('28', '71', '2018-06-13/5b208e68e74d1.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('29', '72', '2018-06-13/5b208e8aa9c2c.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('30', '72', '2018-06-13/5b208e8aabf54.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('31', '73', '2018-06-13/5b208e9e5f542.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('32', '73', '2018-06-13/5b208e9e63b93.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('33', '102', '2018-06-13/5b20c31bddd29.mp4', '2', '0');
INSERT INTO `u_note_vi` VALUES ('34', '103', '2018-06-13/5b20e9850fa09.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('35', '104', '2018-06-13/5b20ed7b7cc38.png', '1', '0');
INSERT INTO `u_note_vi` VALUES ('36', '105', '2018-06-14/5b2262929397d.jpg', '1', '0');
INSERT INTO `u_note_vi` VALUES ('37', '106', '2018-06-14/5b22636a231fd.mp4', '2', '0');
INSERT INTO `u_note_vi` VALUES ('38', '107', '2018-06-19/5b2865fe2de43.jpg', '1', '0');

-- ----------------------------
-- Table structure for `u_question`
-- ----------------------------
DROP TABLE IF EXISTS `u_question`;
CREATE TABLE `u_question` (
  `question_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '问答表自增id',
  `question_cid` bigint(20) NOT NULL COMMENT '所属群id',
  `question_uid` bigint(20) NOT NULL COMMENT '用户id',
  `question_name` varchar(255) NOT NULL COMMENT '标题',
  `question_content` text NOT NULL COMMENT '内容',
  `question_reward` int(10) NOT NULL DEFAULT '0' COMMENT '悬赏金',
  `question_istop` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶，0为否，1为是',
  `question_iswally` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否为精品，0为否，1为是',
  `question_ishide` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否屏蔽，0为屏蔽，1为不屏蔽',
  `question_comments` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `question_browses` int(10) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `question_createtime` datetime NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='问答表';

-- ----------------------------
-- Records of u_question
-- ----------------------------
INSERT INTO `u_question` VALUES ('1', '12', '7', '问答1', '文达', '100', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `u_question` VALUES ('2', '12', '7', '1', '1', '1', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `u_question` VALUES ('3', '12', '7', '问2', '111', '111', '0', '0', '1', '0', '0', '2018-06-10 16:15:39');
INSERT INTO `u_question` VALUES ('4', '12', '7', '111', '11', '111', '0', '0', '1', '0', '0', '2018-06-10 16:16:14');
INSERT INTO `u_question` VALUES ('5', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('6', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('7', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('8', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('9', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('10', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('11', '0', '0', '', '', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `u_question` VALUES ('12', '0', '0', '', '', '0', '0', '0', '1', '0', '0', '0000-00-00 00:00:00');
INSERT INTO `u_question` VALUES ('13', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('14', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('15', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('16', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('17', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('18', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('19', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('20', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('21', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('22', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('23', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('24', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('25', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('26', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('27', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('28', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');
INSERT INTO `u_question` VALUES ('29', '12', '7', 'l', '1', '0', '0', '0', '1', '0', '0', '2018-06-10 17:42:21');

-- ----------------------------
-- Table structure for `u_question_comment`
-- ----------------------------
DROP TABLE IF EXISTS `u_question_comment`;
CREATE TABLE `u_question_comment` (
  `question_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '问答回复表自增id',
  `question_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `question_comment_qid` bigint(20) NOT NULL COMMENT '问答id',
  `question_comment_content` text NOT NULL COMMENT '回复内容',
  `question_comment_zans` int(10) NOT NULL COMMENT '点赞数',
  `question_comment_zaner` text COMMENT '点赞的人',
  `question_comment_reply` text COMMENT '发表者回复',
  `question_comment_isanswer` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否是答案，0为否，1为是',
  `question_comment_createtime` datetime NOT NULL COMMENT '发表时间',
  `question_comment_replytime` datetime DEFAULT NULL COMMENT '作者回复时间',
  PRIMARY KEY (`question_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='问答回复表';

-- ----------------------------
-- Records of u_question_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `u_question_vi`
-- ----------------------------
DROP TABLE IF EXISTS `u_question_vi`;
CREATE TABLE `u_question_vi` (
  `question_vi_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '问答图片视频表自增id',
  `question_vi_qid` bigint(20) NOT NULL COMMENT '问答id',
  `question_vi_url` varchar(256) NOT NULL COMMENT '路径',
  `question_vi_type` smallint(3) DEFAULT NULL COMMENT '文件类型,1为图片，2为视频',
  `question_vi_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`question_vi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='问答的图片视频表';

-- ----------------------------
-- Records of u_question_vi
-- ----------------------------
INSERT INTO `u_question_vi` VALUES ('1', '1', '2018-06-10/5b1c982339f89.jpg', null, '0');
INSERT INTO `u_question_vi` VALUES ('2', '1', '2018-06-10/5b1c98233ab41.png', null, '0');
INSERT INTO `u_question_vi` VALUES ('3', '2', '2018-06-10/5b1ca0459fcdc.jpg', null, '0');
INSERT INTO `u_question_vi` VALUES ('4', '2', '2018-06-10/5b1ca045a0c7c.png', null, '0');
INSERT INTO `u_question_vi` VALUES ('5', '3', '2018-06-10/5b1cde2bc4a2f.jpg', null, '0');
INSERT INTO `u_question_vi` VALUES ('6', '4', '2018-06-10/5b1cde4e7410e.jpg', null, '0');
INSERT INTO `u_question_vi` VALUES ('7', '5', '2018-06-10/5b1cf27dc30f0.jpg', null, '0');
INSERT INTO `u_question_vi` VALUES ('8', '5', '2018-06-10/5b1cf27dc5419.jpg', null, '0');

-- ----------------------------
-- Table structure for `u_resource`
-- ----------------------------
DROP TABLE IF EXISTS `u_resource`;
CREATE TABLE `u_resource` (
  `resource_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '资源表自增id',
  `resource_cid` bigint(20) NOT NULL COMMENT '群id',
  `resource_uid` bigint(20) NOT NULL COMMENT '用户id',
  `resource_name` varchar(255) NOT NULL COMMENT '标题',
  `resource_content` text NOT NULL COMMENT '内容',
  `resource_reward` int(10) NOT NULL DEFAULT '0' COMMENT '报酬',
  `resource_url` varchar(255) NOT NULL COMMENT '资源路径',
  `resource_istop` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶，0为否，1为是',
  `resource_iswally` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否是精品，0为否，1为是',
  `resource_ishide` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否屏蔽，0为屏蔽，1为不屏蔽',
  `resource_comments` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `resource_browses` int(10) NOT NULL DEFAULT '0' COMMENT '浏览数',
  `resource_createtime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`resource_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='资源表';

-- ----------------------------
-- Records of u_resource
-- ----------------------------
INSERT INTO `u_resource` VALUES ('1', '12', '7', '1', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('2', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('3', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('4', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('5', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('6', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('7', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('8', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('9', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('10', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('11', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('12', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('13', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('14', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('15', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('16', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('17', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('18', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('19', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('20', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('21', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('22', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');
INSERT INTO `u_resource` VALUES ('23', '12', '7', '资源2', '1', '0', '2018-06-10/5b1cb9ec4e49b.jpg', '0', '0', '1', '0', '0', '2018-06-10 13:41:00');

-- ----------------------------
-- Table structure for `u_resource_comment`
-- ----------------------------
DROP TABLE IF EXISTS `u_resource_comment`;
CREATE TABLE `u_resource_comment` (
  `resource_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '资源评论表自增id',
  `resource_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `resource_comment_rid` bigint(20) NOT NULL COMMENT '资源id',
  `resource_comment_content` text NOT NULL COMMENT '评论内容',
  `resource_comment_zans` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `resource_comment_zaner` text COMMENT '点赞人',
  `resource_comment_reply` text COMMENT '作者回复',
  `resource_comment_createtime` datetime NOT NULL COMMENT '发表时间',
  `resource_comment_replytime` datetime DEFAULT NULL COMMENT '作者回复时间',
  PRIMARY KEY (`resource_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='资源评论表';

-- ----------------------------
-- Records of u_resource_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `u_resource_vi`
-- ----------------------------
DROP TABLE IF EXISTS `u_resource_vi`;
CREATE TABLE `u_resource_vi` (
  `resource_vi_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '资源的图片视频表自增id',
  `resource_vi_rid` bigint(20) NOT NULL COMMENT '资源id',
  `resource_vi_url` varchar(255) NOT NULL COMMENT '路径',
  `resource_vi_type` smallint(3) DEFAULT NULL COMMENT '文件类型，1为图片，2为视频',
  `resource_vi_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`resource_vi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='资源的图片视频表';

-- ----------------------------
-- Records of u_resource_vi
-- ----------------------------
INSERT INTO `u_resource_vi` VALUES ('1', '0', '', null, '0');

-- ----------------------------
-- Table structure for `u_resume`
-- ----------------------------
DROP TABLE IF EXISTS `u_resume`;
CREATE TABLE `u_resume` (
  `resume_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '简历表自增id',
  `resume_uid` bigint(20) NOT NULL COMMENT '用户id',
  `resume_tid` int(10) NOT NULL COMMENT '工作类型id，1为全职，2为兼职，3为实习',
  `resume_name` varchar(256) NOT NULL COMMENT '姓名',
  `resume_position` varchar(256) NOT NULL COMMENT '职位',
  `resume_lowmoney` int(10) NOT NULL COMMENT '最低薪资',
  `resume_hightmoney` int(10) NOT NULL COMMENT '最高薪资',
  `resume_workyear` int(5) NOT NULL COMMENT '工作年限',
  `resume_university` varchar(256) DEFAULT NULL COMMENT '毕业院校',
  `resume_degree` varchar(256) DEFAULT NULL COMMENT '学位',
  `resume_specialty` varchar(256) DEFAULT NULL COMMENT '专业',
  `resume_fileurl` varchar(256) DEFAULT NULL COMMENT '文件的url',
  `resume_isnegotiable` smallint(1) NOT NULL DEFAULT '0' COMMENT '否是接受面议，0为不接受，1为接受',
  `resume_status` smallint(1) NOT NULL DEFAULT '0' COMMENT '简历状态，目前0为待完善，1为待投递，2为已投递，3为自动投递中',
  `resume_createtime` datetime NOT NULL COMMENT '创建时间',
  `resume_updatetime` datetime DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`resume_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='简历表';

-- ----------------------------
-- Records of u_resume
-- ----------------------------
INSERT INTO `u_resume` VALUES ('1', '7', '1', 'ChenPeng', 'soft engineer', '3000', '8000', '2', 'ZhongNan', 'SoftWare', 'Computer', '2018-06-10/5b1cf89b247f5.docx', '1', '1', '2018-06-04 14:45:55', '2018-06-10 18:08:27');

-- ----------------------------
-- Table structure for `u_tutorship_issue`
-- ----------------------------
DROP TABLE IF EXISTS `u_tutorship_issue`;
CREATE TABLE `u_tutorship_issue` (
  `tutorship_issue_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '提供辅导表自增id',
  `tutorship_issue_cid` bigint(20) NOT NULL COMMENT '群id',
  `tutorship_issue_uid` bigint(20) NOT NULL COMMENT '用户id',
  `tutorship_issue_name` varchar(255) NOT NULL COMMENT '真实名字',
  `tutorship_issue_contact` varchar(255) NOT NULL COMMENT '联系方式',
  `tutorship_issue_picture` varchar(255) NOT NULL COMMENT '照片',
  `tutorship_issue_title` varchar(255) NOT NULL COMMENT '标题',
  `tutorship_issue_price` varchar(255) NOT NULL DEFAULT '0' COMMENT '价格',
  `tutorship_issue_time` varchar(255) NOT NULL COMMENT '可辅导时间',
  `tutorship_issue_content` text NOT NULL COMMENT '辅导内容',
  `tutorship_issue_explain` text COMMENT '备注',
  `tutorship_issue_istop` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶，0为不置顶，1为置顶',
  `tutorship_issue_iswally` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否为精品，0为否，1为是',
  `tutorship_issue_ishide` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否屏蔽，0为已屏蔽，1为未屏蔽',
  `tutorship_issue_comments` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `tutorship_issue_createtime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`tutorship_issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提供辅导表';

-- ----------------------------
-- Records of u_tutorship_issue
-- ----------------------------

-- ----------------------------
-- Table structure for `u_tutorship_issue_comment`
-- ----------------------------
DROP TABLE IF EXISTS `u_tutorship_issue_comment`;
CREATE TABLE `u_tutorship_issue_comment` (
  `tutorship_issue_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '提供辅助评论表自增id',
  `tutorship_issue_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `tutorship_issue_comment_tid` bigint(20) NOT NULL COMMENT '提供辅助id',
  `tutorship_issue_comment_content` text NOT NULL COMMENT '内容',
  `tutorship_issue_comment_zans` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `tutorship_issue_comment_zaner` text COMMENT '点赞人',
  `tutorship_issue_comment_reply` text COMMENT '回复',
  `tutorship_issue_comment_createtime` datetime NOT NULL COMMENT '发表时间',
  `tutorship_issue_comment_replytime` datetime DEFAULT NULL COMMENT '作者回复时间',
  PRIMARY KEY (`tutorship_issue_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提供辅导评论';

-- ----------------------------
-- Records of u_tutorship_issue_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `u_tutorship_need`
-- ----------------------------
DROP TABLE IF EXISTS `u_tutorship_need`;
CREATE TABLE `u_tutorship_need` (
  `tutorship_need_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '寻求辅导表自增id',
  `tutorship_need_cid` bigint(20) NOT NULL COMMENT '群id',
  `tutorship_need_uid` bigint(20) NOT NULL COMMENT '用户id',
  `tutorship_need_name` varchar(255) NOT NULL COMMENT '真实姓名',
  `tutorship_need_contact` varchar(255) NOT NULL COMMENT '联系方式',
  `tutorship_need_title` varchar(255) NOT NULL COMMENT '标题',
  `tutorship_need_time` varchar(255) NOT NULL COMMENT '辅导时间',
  `tutorship_need_demand` varchar(255) DEFAULT NULL COMMENT '需求条件',
  `tutorship_need_content` text NOT NULL COMMENT '内容',
  `tutorship_need_explain` text COMMENT '备注',
  `tutorship_need_istop` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否置顶，0为不置顶，1为置顶',
  `tutorship_need_iswally` smallint(1) NOT NULL DEFAULT '0' COMMENT '是否为精品，0为否，1为是',
  `tutorship_need_ishide` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否屏蔽，0为已屏蔽，1为未屏蔽',
  `tutorship_need_comments` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `tutorship_need_createtime` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`tutorship_need_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='寻求辅导表';

-- ----------------------------
-- Records of u_tutorship_need
-- ----------------------------
INSERT INTO `u_tutorship_need` VALUES ('1', '11', '8', '1', '1', '1', '1', '1', '1', '1', '0', '0', '1', '0', '2018-06-19 11:40:49');

-- ----------------------------
-- Table structure for `u_tutorship_need_comment`
-- ----------------------------
DROP TABLE IF EXISTS `u_tutorship_need_comment`;
CREATE TABLE `u_tutorship_need_comment` (
  `tutorship_need_comment_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '寻求辅导评论表自增id',
  `tutorship_need_comment_uid` bigint(20) NOT NULL COMMENT '用户id',
  `tutorship_need_comment_tid` bigint(20) NOT NULL COMMENT '寻求辅导id',
  `tutorship_need_comment_content` text NOT NULL COMMENT '评论内容',
  `tutorship_need_comment_zans` int(10) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `tutorship_need_comment_zaner` text COMMENT '点赞人',
  `tutorship_need_comment_reply` text COMMENT '作者回复',
  `tutorship_need_comment_createtime` datetime NOT NULL COMMENT '发表时间',
  `tutorship_need_comment_replytime` datetime DEFAULT NULL COMMENT '作者回复时间',
  PRIMARY KEY (`tutorship_need_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='寻求辅导评论表';

-- ----------------------------
-- Records of u_tutorship_need_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `u_user`
-- ----------------------------
DROP TABLE IF EXISTS `u_user`;
CREATE TABLE `u_user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '用户表自增id',
  `user_mail` varchar(256) NOT NULL COMMENT '用户邮箱，也可以做登录名',
  `user_password` varchar(256) NOT NULL COMMENT '用户密码',
  `user_password_joint` varchar(256) NOT NULL COMMENT '用户密码加密串',
  `user_name` varchar(256) DEFAULT NULL COMMENT '用户昵称',
  `user_icon` varchar(256) DEFAULT NULL COMMENT '户用头像',
  `user_cover` varchar(256) DEFAULT NULL COMMENT '用户主页封面',
  `user_signature` text COMMENT '用户签名',
  `user_birth` varchar(256) DEFAULT NULL COMMENT '用户出生年月日',
  `user_sex` char(2) DEFAULT NULL COMMENT '用户性别',
  `user_tag` varchar(256) DEFAULT NULL COMMENT '用户标签',
  `user_country` varchar(256) DEFAULT NULL COMMENT '用户国家',
  `user_city` varchar(256) DEFAULT NULL COMMENT '用户城市',
  `user_grouptag` varchar(255) DEFAULT NULL COMMENT '感兴趣的群组',
  `user_logintime` datetime NOT NULL COMMENT '用户注册时间',
  `user_updatatime` datetime DEFAULT NULL COMMENT '密码修改时间',
  `user_code` varchar(20) DEFAULT NULL COMMENT '邀请码',
  `user_concerns` int(10) NOT NULL DEFAULT '0' COMMENT '用户关注人的数量',
  `user_fans` int(10) NOT NULL DEFAULT '0' COMMENT '用户的粉丝数量',
  `user_notes` int(10) NOT NULL DEFAULT '0' COMMENT '用户发布的帖子数量',
  `user_havecoin` bigint(20) NOT NULL COMMENT '拥有的虚拟币',
  `user_outcoin` bigint(20) NOT NULL DEFAULT '0' COMMENT '支出的虚拟币',
  `user_outmoney` bigint(20) NOT NULL DEFAULT '0' COMMENT '支出的现金',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of u_user
-- ----------------------------
INSERT INTO `u_user` VALUES ('2', '1@2.com', '9c6829ffb9b5ee476e4cce9066251460', '5aeaede6d3138', 'lyx02', '', null, '', '2018-06-07', null, '', '', '', '', '2018-05-03 00:00:00', null, '', '0', '0', '0', '0', '0', '0');
INSERT INTO `u_user` VALUES ('3', '1@2.com', 'aacb87f7e7dc3bc10ea1991debadf513', '5aefa9732df2a', 'lyx03', null, null, '', '2018-06-30', null, '', '', '', '', '2018-05-07 00:00:00', null, '', '0', '0', '0', '0', '3', '0');
INSERT INTO `u_user` VALUES ('4', '1@3.com', 'd4544f01ada1fc5a7bc90b5a42a66fed', '5aefad0ec2196', 'lyx04', '2018-06-20/1529475975_21970.png', null, '', '2018-06-20', '1', '', '', '', '', '2018-05-07 00:00:00', null, '', '0', '0', '0', '0', '0', '600');
INSERT INTO `u_user` VALUES ('7', '1577762705@qq.com', '202cb962ac59075b964b07152d234b705af142f7b56bc', '5af142f7b56bc', 'lyx', '2018-06-11/5b1e33c0182ec.jpg', null, '1234562', '2016-07-05', '2', '', 'China', 'guangdong', '', '2018-05-07 00:00:00', '2018-05-08 14:25:59', '', '1111111', '26000000', '19', '4188', '0', '26500');
INSERT INTO `u_user` VALUES ('8', '821754186@qq.com', '202cb962ac59075b964b07152d234b705b0fdfeeb15bd', '5b0fdfeeb15bd', '11', '2018-06-19/5b2865dbc0a0c.jpg', null, '1231', '2018-05-30', '2', 'work', 'Austria', '123', '', '2018-05-31 19:43:42', null, '', '0', '0', '2', '80', '0', '0');

-- ----------------------------
-- Table structure for `u_user_country`
-- ----------------------------
DROP TABLE IF EXISTS `u_user_country`;
CREATE TABLE `u_user_country` (
  `user_country_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '用户的国家表自增id',
  `user_country_name` varchar(255) NOT NULL COMMENT '国家名',
  `user_country_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `user_countyr_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='用户的国家表';

-- ----------------------------
-- Records of u_user_country
-- ----------------------------
INSERT INTO `u_user_country` VALUES ('1', 'America ', '0', '2018-05-31 15:01:34');
INSERT INTO `u_user_country` VALUES ('2', 'Austria', '0', '2018-05-31 15:01:44');
INSERT INTO `u_user_country` VALUES ('3', 'China', '0', '2018-05-31 15:02:02');
INSERT INTO `u_user_country` VALUES ('4', 'Canada', '0', '2018-05-31 15:02:11');
INSERT INTO `u_user_country` VALUES ('5', 'France', '0', '2018-05-31 15:02:24');
INSERT INTO `u_user_country` VALUES ('6', 'Germany', '0', '2018-05-31 15:02:32');
INSERT INTO `u_user_country` VALUES ('7', 'Holland', '0', '2018-05-31 15:02:41');
INSERT INTO `u_user_country` VALUES ('8', 'Russia', '0', '2018-05-31 15:02:52');

-- ----------------------------
-- Table structure for `u_user_grouptag`
-- ----------------------------
DROP TABLE IF EXISTS `u_user_grouptag`;
CREATE TABLE `u_user_grouptag` (
  `u_user_grouptag_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '用户感兴趣群表自增id',
  `u_user_grouptag_name` varchar(255) NOT NULL COMMENT '名称',
  `u_user_grouptag_img` varchar(255) NOT NULL COMMENT '图片',
  `u_user_grouptag_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `u_user_grouptag_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`u_user_grouptag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='用户感兴趣群组表';

-- ----------------------------
-- Records of u_user_grouptag
-- ----------------------------
INSERT INTO `u_user_grouptag` VALUES ('1', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '2018-05-31 16:47:47');
INSERT INTO `u_user_grouptag` VALUES ('2', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('3', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('4', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('5', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('6', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('7', 'Academic GroupsGroups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('8', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('9', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');
INSERT INTO `u_user_grouptag` VALUES ('10', 'Academic Groups', '2018-05-23/home_register_icon_pic_01.png', '0', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `u_user_tag`
-- ----------------------------
DROP TABLE IF EXISTS `u_user_tag`;
CREATE TABLE `u_user_tag` (
  `user_tag_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '用户标签表自增id',
  `user_tag_name` varchar(255) NOT NULL COMMENT '标签名',
  `user_tag_sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `user_tag_createtime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`user_tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='用户标签表';

-- ----------------------------
-- Records of u_user_tag
-- ----------------------------
INSERT INTO `u_user_tag` VALUES ('1', 'student', '0', '2018-05-31 15:00:41');
INSERT INTO `u_user_tag` VALUES ('2', 'work', '0', '2018-05-31 15:03:47');
INSERT INTO `u_user_tag` VALUES ('3', 'other', '0', '2018-05-31 15:03:54');
