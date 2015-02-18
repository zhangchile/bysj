-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 18 日 07:26
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='动作表' AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- 表的结构 `actioncolumn`
--

CREATE TABLE IF NOT EXISTS `actioncolumn` (
  `actioncolumnid` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `actioncolumnname` varchar(50) NOT NULL COMMENT '分类名称',
  `uri` varchar(50) NOT NULL COMMENT 'uri',
  PRIMARY KEY (`actioncolumnid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='侧栏' AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='动作组' AUTO_INCREMENT=27 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理组' AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=6 ;

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
  KEY `masterid` (`masterid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员所在的组' AUTO_INCREMENT=25 ;

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
