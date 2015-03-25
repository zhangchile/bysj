-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-03-25 08:09:04
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dormitorysystem`
--

--
-- 转存表中的数据 `action`
--

INSERT INTO `action` (`actionid`, `actionname`, `actioncolumnid`, `action`, `viewmodel`) VALUES
(1, '添加用户组', 1, 'addgroupmanager', 1),
(2, '添加组用户', 1, 'addmaster', 1),
(3, '删除组用户', 1, 'delgroupmanager', 1),
(4, '添加权限', 2, 'addpermission', 1),
(5, '删除权限', 2, 'delpermission', 1),
(6, '编辑通知', 3, 'editnotice', 1),
(7, '删除通知', 3, 'delnotice', 1),
(8, '发布通知', 4, 'pushnotice', 1);

--
-- 转存表中的数据 `actioncolumn`
--

INSERT INTO `actioncolumn` (`actioncolumnid`, `actioncolumnname`, `uri`) VALUES
(1, '用户组管理', '/admin/'),
(2, '权限分配', '/permission/'),
(3, '通知管理', '/notice/'),
(4, '发布通知', '/pushnotice/');

--
-- 转存表中的数据 `actiongroup`
--

INSERT INTO `actiongroup` (`id`, `action`, `groupid`, `masterid`, `mastername`, `createdate`) VALUES
(1, 'addgroupmanager', 1, 1, 'chilezhang', 1427212800),
(2, 'addmaster', 1, 1, 'chilezhang', 1427212800),
(3, 'delgroupmanager', 1, 1, 'chilezhang', 1427212800),
(4, 'delpermission', 1, 1, 'chilezhang', 1427212800),
(5, 'addpermission', 1, 1, 'chilezhang', 1427212800),
(6, 'delnotice', 1, 1, 'chilezhang', 1427212800),
(7, 'editnotice', 1, 1, 'chilezhang', 1427212800),
(8, 'pushnotice', 1, 1, 'chilezhang', 1427212800);

--
-- 转存表中的数据 `groupmanager`
--

INSERT INTO `groupmanager` (`groupid`, `groupname`, `groupinfo`, `masterid`, `mastername`, `createdate`) VALUES
(1, '超级管理员组', '网站超级管理员', 1, 'chilezhang', 1427212800);

--
-- 转存表中的数据 `master`
--

INSERT INTO `master` (`id`, `username`, `password`, `email`, `truename`, `sex`, `mobile`) VALUES
(1, 'chilezhang', '531a4db53013687a53ac8c33dfba04d9', 'chile.zhang@qq.com', 'chile', '男', '12345678912');

--
-- 转存表中的数据 `mastergroup`
--

INSERT INTO `mastergroup` (`id`, `masterid`, `name`, `groupid`, `masterid2`, `mastername`, `createdate`) VALUES
(1, 1, '超级管理员', 1, 1, 'chilezhang', 1427212800);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
