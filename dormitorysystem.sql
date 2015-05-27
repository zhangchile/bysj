-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 27 日 12:51
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `dormitorysystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `actionid` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增长ID',
  `actionname` varchar(50) NOT NULL COMMENT '动作名',
  `actioncolumnid` int(11) NOT NULL COMMENT '动作分栏号',
  `action` varchar(50) NOT NULL COMMENT '动作字符串',
  `viewmodel` tinyint(2) NOT NULL COMMENT '是否可见',
  PRIMARY KEY (`actionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='动作表' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- 表的结构 `actioncolumn`
--

CREATE TABLE IF NOT EXISTS `actioncolumn` (
  `actioncolumnid` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `actioncolumnname` varchar(50) NOT NULL COMMENT '分类名称',
  `uri` varchar(50) NOT NULL COMMENT 'uri',
  PRIMARY KEY (`actioncolumnid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='侧栏' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `actiongroup`
--

CREATE TABLE IF NOT EXISTS `actiongroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `action` varchar(50) NOT NULL COMMENT '动作名称',
  `groupid` int(11) NOT NULL COMMENT '动作组ID',
  `masterid` int(11) NOT NULL COMMENT '创建者ID',
  `mastername` varchar(50) NOT NULL COMMENT '创建者名称',
  `createdate` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='动作组' AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- 表的结构 `deliveryorder`
--

CREATE TABLE IF NOT EXISTS `deliveryorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号',
  `number` int(11) NOT NULL COMMENT '数量',
  `time` int(10) NOT NULL COMMENT '下单时间',
  `booktime` int(3) NOT NULL COMMENT '预约时间段',
  `status` int(2) unsigned NOT NULL COMMENT '状态，1-已下单，2-已确认，3-已配送',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='配送表' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `dormitory`
--

CREATE TABLE IF NOT EXISTS `dormitory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号，账号，X3R630',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `type` int(1) NOT NULL COMMENT '1-男生，2-女生宿舍',
  `department` varchar(20) NOT NULL COMMENT '学院',
  `waterleft` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '剩余桶装水',
  `watercharge` decimal(8,2) NOT NULL COMMENT '水费余额',
  `electricitycharge` decimal(8,2) NOT NULL COMMENT '电费余额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='宿舍表' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `erecord`
--

CREATE TABLE IF NOT EXISTS `erecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号',
  `useage` decimal(8,2) NOT NULL COMMENT '当日用量',
  `totalprize` decimal(8,2) NOT NULL COMMENT '当日费用',
  `oneprize` decimal(8,2) NOT NULL COMMENT '单价',
  `date` int(10) NOT NULL COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='电费记录表' AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- 表的结构 `groupmanager`
--

CREATE TABLE IF NOT EXISTS `groupmanager` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `groupname` varchar(50) NOT NULL COMMENT '管理组名称',
  `groupinfo` varchar(50) NOT NULL COMMENT '管理组信息',
  `masterid` int(11) NOT NULL COMMENT '创建者ID',
  `mastername` varchar(50) NOT NULL COMMENT '创建者名称',
  `createdate` int(10) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理组' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `master`
--

CREATE TABLE IF NOT EXISTS `master` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(100) NOT NULL COMMENT '登录名',
  `password` varchar(100) NOT NULL COMMENT '登录密码',
  `email` varchar(100) NOT NULL COMMENT '电子邮件',
  `truename` varchar(50) NOT NULL COMMENT '姓名',
  `sex` varchar(2) NOT NULL COMMENT '性别',
  `mobile` char(13) NOT NULL COMMENT '电话',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- 表的结构 `mastergroup`
--

CREATE TABLE IF NOT EXISTS `mastergroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `masterid` int(11) NOT NULL COMMENT '管理员ID',
  `name` varchar(50) NOT NULL COMMENT '管理员名称',
  `groupid` int(11) NOT NULL COMMENT '管理组ID',
  `masterid2` int(11) DEFAULT NULL COMMENT '修改者ID',
  `mastername` varchar(50) DEFAULT NULL COMMENT '修改者名称',
  `createdate` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `masterid_2` (`masterid`,`groupid`),
  KEY `masterid` (`masterid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员所在的组' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `authorid` int(11) NOT NULL COMMENT '作者id',
  `time` int(10) NOT NULL COMMENT '修改时间',
  `author` varchar(20) NOT NULL COMMENT '作者名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='通知表' AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `recharge`
--

CREATE TABLE IF NOT EXISTS `recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号',
  `billid` varchar(50) DEFAULT NULL COMMENT '交易号',
  `type` tinyint(2) NOT NULL COMMENT '类型，1-水，2-电',
  `operate` tinyint(2) NOT NULL COMMENT '操作，1-充值，2-扣费',
  `status` tinyint(2) NOT NULL COMMENT '状态，1-已提交，2-已付款，3-完成，-1-已拒绝',
  `changes` decimal(8,2) NOT NULL COMMENT '变化',
  `date` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='水电充值记录' AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- 表的结构 `rechargeprize`
--

CREATE TABLE IF NOT EXISTS `rechargeprize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `water` decimal(8,2) NOT NULL COMMENT '水费价格',
  `electricity` decimal(8,2) NOT NULL COMMENT '电费价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='水电费单价表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `repareorder`
--

CREATE TABLE IF NOT EXISTS `repareorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号',
  `applytime` int(10) NOT NULL COMMENT '申请时间',
  `booktime` int(10) DEFAULT NULL COMMENT '预约时间',
  `description` text NOT NULL COMMENT '问题描述',
  `type` int(2) NOT NULL COMMENT '问题类型，1-水电，2-土木',
  `status` int(11) NOT NULL COMMENT '1-申请中，2-已接受，3-完成,-1-拒绝',
  PRIMARY KEY (`id`),
  KEY `sid` (`sid`) COMMENT '宿舍编号'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='维修单' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `studentmanage`
--

CREATE TABLE IF NOT EXISTS `studentmanage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(20) NOT NULL COMMENT '学号',
  `truename` varchar(50) NOT NULL COMMENT '姓名',
  `sex` char(2) NOT NULL COMMENT '性别',
  `department` varchar(50) NOT NULL COMMENT '学院',
  `major` varchar(50) NOT NULL COMMENT '专业',
  `class` varchar(50) NOT NULL COMMENT '班级',
  `grade` varchar(10) NOT NULL COMMENT '年级',
  `dormitory` varchar(20) NOT NULL COMMENT '宿舍编号',
  PRIMARY KEY (`id`),
  KEY `dormitory` (`dormitory`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='学生表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `visitrecord`
--

CREATE TABLE IF NOT EXISTS `visitrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studentid` varchar(20) NOT NULL COMMENT '学号',
  `truename` varchar(50) NOT NULL COMMENT '真实姓名',
  `sex` char(2) NOT NULL COMMENT '性别',
  `reason` text NOT NULL COMMENT '到访理由',
  `visitto` varchar(50) NOT NULL COMMENT '到访宿舍',
  `time` int(10) NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='来访记录表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `water`
--

CREATE TABLE IF NOT EXISTS `water` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `prize` decimal(8,2) NOT NULL COMMENT '单价',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='桶装水类型' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `waterorder`
--

CREATE TABLE IF NOT EXISTS `waterorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号',
  `time` int(10) NOT NULL COMMENT '下单时间',
  `number` int(2) unsigned NOT NULL DEFAULT '1' COMMENT '订购数量',
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '状态,1-已下单,2-已付款,3-已确认',
  `billid` varchar(50) NOT NULL COMMENT '转账交易号',
  `prize` decimal(9,2) NOT NULL COMMENT '总价',
  `watertype` int(11) NOT NULL COMMENT '桶装水的类别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订水表' AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `wrecord`
--

CREATE TABLE IF NOT EXISTS `wrecord` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(20) NOT NULL COMMENT '宿舍编号',
  `useage` decimal(8,2) NOT NULL COMMENT '当日用量',
  `totalprize` decimal(8,2) NOT NULL COMMENT '当日费用',
  `oneprize` decimal(8,2) NOT NULL COMMENT '单价',
  `date` int(10) NOT NULL COMMENT '日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='水费记录表' AUTO_INCREMENT=92 ;

--
-- 限制导出的表
--

--
-- 限制表 `mastergroup`
--
ALTER TABLE `mastergroup`
  ADD CONSTRAINT `mastergroup_ibfk_1` FOREIGN KEY (`masterid`) REFERENCES `master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
