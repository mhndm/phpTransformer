-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2014 at 12:36 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlog`
--

CREATE TABLE IF NOT EXISTS `adminlog` (
  `TryName` varchar(15) NOT NULL COMMENT 'الاسم المحاول الدخول فيه',
  `TryPassword` varchar(35) NOT NULL COMMENT 'كلمة سر المحاولة',
  `TryDate` datetime NOT NULL COMMENT 'الوقت حسب غريبتش',
  `tryIp` varchar(15) NOT NULL COMMENT 'رقم الايبي المحاول منه'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminlog`
--

INSERT INTO `adminlog` (`TryName`, `TryPassword`, `TryDate`, `tryIp`) VALUES
('admin', 'h', '2013-09-11 10:22:42', '127.0.0.1'),
('admn', 'Passw0rd', '2014-01-24 13:53:31', '127.0.0.1'),
('admn', 'Passw0rd', '2014-01-24 13:53:31', '127.0.0.1'),
('admin', 'admin', '2014-02-25 13:09:02', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-14 09:49:57', '127.0.0.1'),
('admin', 'hack\\', '2014-05-14 09:50:06', '127.0.0.1'),
('admin', 'admin', '2014-05-14 09:50:12', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-15 09:50:01', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-15 09:51:28', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-15 11:29:18', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-16 09:17:17', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-18 11:03:24', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-19 09:16:40', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-21 11:14:40', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-24 08:21:25', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-26 08:38:30', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-28 13:05:51', '127.0.0.1'),
('admin', 'F0maac44', '2014-05-31 11:04:10', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-02 15:28:41', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-03 15:01:14', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-03 16:34:50', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-05 15:42:54', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-09 09:00:47', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-09 09:01:46', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-09 12:17:44', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-12 11:42:08', '127.0.0.1'),
('admin', 'F0maac44', '2014-06-21 13:52:30', '127.0.0.1'),
('admin', 'F0maac44', '2014-07-03 10:57:58', '127.0.0.1'),
('adminq', 'Passw0rd', '2014-07-23 10:30:26', '127.0.0.1'),
('adminq', 'Passw0rd', '2014-07-23 10:30:27', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `adminperm`
--

CREATE TABLE IF NOT EXISTS `adminperm` (
  `AdminID` varchar(11) NOT NULL COMMENT 'رقم المدير',
  `constName` varchar(100) NOT NULL COMMENT 'النوع قلب البرنامج او برنامج او بلوك',
  `varName` varchar(100) NOT NULL COMMENT 'اسم المتغير',
  `varValue` varchar(100) NOT NULL COMMENT 'قيمة المتغير',
  `perm` int(1) NOT NULL COMMENT 'له صلاحية'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول صلاحيات المدراء';

--
-- Dumping data for table `adminperm`
--

INSERT INTO `adminperm` (`AdminID`, `constName`, `varName`, `varValue`, `perm`) VALUES
('20120000000', 'prog', 'todo', 'contactus', 1),
('20120000000', 'prog', 'todo', 'exlink', 1),
('20120000000', 'prog', 'subdo', 'positions', 1),
('20120000000', 'prog', 'subdo', 'customers', 1),
('20120000000', 'prog', 'subdo', 'PriceList', 1),
('20120000000', 'prog', 'todo', 'ads', 1),
('20120000000', 'prog', 'subdo', 'editNews', 1),
('20120000000', 'prog', 'subdo', 'NewsCom', 1),
('20120000000', 'prog', 'subdo', 'addNews', 1),
('20120000000', 'prog', 'subdo', 'NewNewsCat', 1),
('20120000000', 'prog', 'subdo', 'NewsCat', 1),
('20120000000', 'prog', 'subdo', 'allNews', 1),
('20120000000', 'prog', 'subdo', 'deleteNews', 1),
('20120000000', 'prog', 'todo', 'news', 1),
('20120000000', 'prog', 'todo', 'usercp', 1),
('20120000000', 'prog', 'todo', 'pool', 1),
('20120000000', 'prog', 'todo', 'tellfriend', 1),
('20120000000', 'prog', 'subdo', 'deletepages', 1),
('20120000000', 'prog', 'subdo', 'editpages', 1),
('20120000000', 'prog', 'subdo', 'ListPages', 1),
('20120000000', 'prog', 'subdo', 'NewPage', 1),
('20120000000', 'prog', 'todo', 'pages', 1),
('20120000000', 'core', 'todo', 'sendmodule', 1),
('20120000000', 'core', 'todo', 'appsstore', 1),
('20120000000', 'core', 'todo', 'plugins', 1),
('20120000000', 'core', 'subdo', 'EditTrans', 1),
('20120000000', 'core', 'subdo', 'LisTrans', 1),
('20120000000', 'core', 'subdo', 'NewTrans', 1),
('20120000000', 'core', 'todo', 'recycle', 1),
('20120000000', 'core', 'todo', 'Translations', 1),
('20120000000', 'core', 'subdo', 'EditElement', 1),
('20120000000', 'core', 'subdo', 'AddElement', 1),
('20120000000', 'core', 'subdo', 'BrowseMenu', 1),
('20120000000', 'core', 'subdo', 'DeleteElement', 1),
('20120000000', 'core', 'todo', 'mainmenu', 1),
('20120000000', 'core', 'subdo', 'SubMenu', 1),
('20120000000', 'core', 'subdo', 'ChildsOfMenu', 1),
('20120000000', 'core', 'subdo', 'editMenu', 1),
('20120000000', 'core', 'subdo', 'AddElemnts', 1),
('20120000000', 'core', 'subdo', 'AddMenu', 1),
('20120000000', 'core', 'subdo', 'AllElemnts', 1),
('20120000000', 'core', 'subdo', 'RootMenu', 1),
('20120000000', 'core', 'subdo', 'delteMenu', 1),
('20120000000', 'core', 'todo', 'layersmenu', 1),
('20120000000', 'core', 'subdo', 'delnews', 1),
('20120000000', 'core', 'subdo', 'editnews', 1),
('20120000000', 'core', 'subdo', 'AddNews', 1),
('20120000000', 'core', 'todo', 'newsbar', 1),
('20120000000', 'core', 'subdo', 'optimize', 1),
('20120000000', 'core', 'subdo', 'restore', 1),
('20120000000', 'core', 'subdo', 'backup', 1),
('20120000000', 'core', 'todo', 'database', 1),
('20120000000', 'core', 'todo', 'Error', 1),
('20120000000', 'core', 'todo', 'bugsandreport', 1),
('20120000000', 'core', 'subdo', 'delTheme', 1),
('20120000000', 'core', 'todo', 'Update', 1),
('20120000000', 'core', 'todo', 'Addons', 1),
('20120000000', 'core', 'todo', 'NewTheme', 1),
('20120000000', 'core', 'todo', 'newblock', 1),
('20120000000', 'core', 'todo', 'newprograms', 1),
('20120000000', 'core', 'todo', 'installer', 1),
('20120000000', 'core', 'todo', 'robotsadmin', 1),
('20120000000', 'core', 'todo', 'SEO', 1),
('20120000000', 'core', 'todo', 'cache', 1),
('20120000000', 'core', 'todo', 'languages', 1),
('20120000000', 'core', 'todo', 'themes', 1),
('20120000000', 'core', 'todo', 'webfolder', 1),
('20120000000', 'core', 'todo', 'options', 1),
('20120000000', 'core', 'todo', 'contieslangs', 1),
('20120000000', 'core', 'todo', 'faildlogin', 1),
('20120000000', 'core', 'todo', 'antiflood', 1),
('20120000000', 'core', 'todo', 'firewall', 1),
('20120000000', 'core', 'todo', 'blocking', 1),
('20120000000', 'core', 'todo', 'specialpermision', 1),
('20120000000', 'core', 'todo', 'blockspermisions', 1),
('20120000000', 'core', 'todo', 'programspermisions', 1),
('20120000000', 'core', 'todo', 'programscontrol', 1),
('20120000000', 'core', 'todo', 'blockscontrol', 1),
('20120000000', 'core', 'subdo', 'editl', 1),
('20120000000', 'core', 'subdo', 'deletel', 1),
('20120000000', 'core', 'subdo', 'Listletter', 1),
('20120000000', 'core', 'subdo', 'Newletter', 1),
('20120000000', 'core', 'todo', 'Letters', 1),
('20120000000', 'core', 'todo', 'Maillist', 1),
('20120000000', 'core', 'subdo', 'adminNew', 1),
('20120000000', 'core', 'subdo', 'adminDelete', 0),
('20120000000', 'core', 'subdo', 'adminPerm', 1),
('20120000000', 'core', 'subdo', 'listAdmins', 1),
('20120000000', 'core', 'todo', 'Admins', 1),
('20120000000', 'core', 'subdo', 'EditGroup', 1),
('20120000000', 'core', 'subdo', 'ChangeUserGroup', 1),
('20120000000', 'core', 'subdo', 'UsersGroup', 1),
('20120000000', 'core', 'subdo', 'SwitchGroup', 1),
('20120000000', 'core', 'subdo', 'DeleteGroup', 1),
('20120000000', 'core', 'subdo', 'NewGroup', 1),
('20120000000', 'core', 'todo', 'Groups', 1),
('20120000000', 'core', 'subdo', 'BanUser', 1),
('20120000000', 'core', 'subdo', 'ResetPassword', 1),
('20120000000', 'core', 'subdo', 'SearchUser', 1),
('20120000000', 'core', 'subdo', 'DeleteUser', 1),
('20120000000', 'core', 'subdo', 'NewUser', 1),
('20120000000', 'core', 'todo', 'members', 1),
('20120000000', 'prog', 'todo', 'rss', 1),
('20120000000', 'prog', 'todo', 'gallery', 1),
('20120000000', 'prog', 'subdo', 'GalleryParameter', 1),
('20120000000', 'prog', 'subdo', 'ClearDB', 1),
('20120000000', 'prog', 'subdo', 'addMedia', 1),
('20120000000', 'prog', 'subdo', 'cmntMedia', 1),
('20120000000', 'prog', 'subdo', 'editMedia', 1),
('20120000000', 'prog', 'subdo', 'delMedia', 1),
('20120000000', 'prog', 'subdo', 'allMedia', 1),
('20120000000', 'prog', 'todo', 'hosting', 1),
('20120000000', 'prog', 'subdo', 'TestPerm', 1),
('20120000000', 'blok', 'todo', 'MainMenu', 1),
('20120000000', 'blok', 'subdo', 'DeleteElement', 1),
('20120000000', 'blok', 'subdo', 'BrowseMenu', 1),
('20120000000', 'blok', 'subdo', 'AddElement', 1),
('20120000000', 'blok', 'subdo', 'EditElement', 1),
('20120000000', 'blok', 'todo', 'AccountBlock', 1),
('20120000000', 'blok', 'todo', 'Statistics', 1),
('20120000000', 'blok', 'todo', 'Ads', 1),
('20120000000', 'blok', 'todo', 'Gsearch', 1),
('20120000000', 'blok', 'todo', 'Language', 1),
('20120000000', 'blok', 'todo', 'Pool', 1),
('20120000000', 'blok', 'subdo', 'ListPool', 1),
('20120000000', 'blok', 'subdo', 'EditPool', 1),
('20120000000', 'blok', 'subdo', 'WhatUserPool', 1),
('20120000000', 'blok', 'subdo', 'DelPool', 1),
('20120000000', 'blok', 'subdo', 'NewPool', 1),
('20120000000', 'blok', 'todo', 'FreeBlock', 1),
('20120000000', 'blok', 'todo', 'HostingCart', 1),
('20120000000', 'blok', 'subdo', 'BlockHostingCart', 1),
('20120000000', 'blok', 'todo', 'support', 1),
('20130000000', 'prog', 'todo', 'shamscontact', 0),
('20130000000', 'prog', 'todo', 'location', 0),
('20130000000', 'prog', 'todo', 'gmap', 0),
('20130000000', 'prog', 'subdo', 'ServicesManange', 0),
('20130000000', 'prog', 'subdo', 'PartnersManange', 0),
('20130000000', 'prog', 'todo', 'services', 0),
('20130000000', 'prog', 'subdo', 'editNews', 0),
('20130000000', 'prog', 'subdo', 'NewsCom', 0),
('20130000000', 'prog', 'subdo', 'addNews', 0),
('20130000000', 'prog', 'subdo', 'NewNewsCat', 0),
('20130000000', 'prog', 'subdo', 'NewsCat', 0),
('20130000000', 'prog', 'subdo', 'allNews', 1),
('20130000000', 'prog', 'subdo', 'deleteNews', 0),
('20130000000', 'prog', 'todo', 'autobuy', 0),
('20130000000', 'prog', 'todo', 'hiba', 0),
('20130000000', 'prog', 'subdo', 'TestPerm', 0),
('20130000000', 'prog', 'todo', 'hosting', 0),
('20130000000', 'prog', 'subdo', 'allMedia', 0),
('20130000000', 'prog', 'subdo', 'delMedia', 0),
('20130000000', 'prog', 'subdo', 'editMedia', 0),
('20130000000', 'prog', 'subdo', 'cmntMedia', 0),
('20130000000', 'prog', 'subdo', 'addMedia', 0),
('20130000000', 'prog', 'subdo', 'ClearDB', 0),
('20130000000', 'prog', 'subdo', 'GalleryParameter', 0),
('20130000000', 'prog', 'todo', 'gallery', 0),
('20130000000', 'prog', 'todo', 'rss', 0),
('20130000000', 'prog', 'todo', 'contactus', 0),
('20130000000', 'prog', 'todo', 'exlink', 0),
('20130000000', 'prog', 'subdo', 'positions', 0),
('20130000000', 'prog', 'subdo', 'customers', 0),
('20130000000', 'prog', 'subdo', 'PriceList', 0),
('20130000000', 'prog', 'todo', 'ads', 0),
('20130000000', 'prog', 'subdo', 'editNews', 0),
('20130000000', 'prog', 'subdo', 'NewsCom', 0),
('20130000000', 'prog', 'subdo', 'addNews', 0),
('20130000000', 'prog', 'subdo', 'NewNewsCat', 0),
('20130000000', 'prog', 'subdo', 'NewsCat', 0),
('20130000000', 'prog', 'subdo', 'allNews', 1),
('20130000000', 'prog', 'subdo', 'deleteNews', 0),
('20130000000', 'prog', 'todo', 'news', 1),
('20130000000', 'prog', 'todo', 'usercp', 0),
('20130000000', 'prog', 'todo', 'pool', 0),
('20130000000', 'prog', 'todo', 'tellfriend', 0),
('20130000000', 'prog', 'subdo', 'deletepages', 0),
('20130000000', 'prog', 'subdo', 'editpages', 0),
('20130000000', 'prog', 'subdo', 'ListPages', 0),
('20130000000', 'prog', 'subdo', 'NewPage', 0),
('20130000000', 'prog', 'todo', 'pages', 0),
('20130000000', 'core', 'todo', 'sendmodule', 0),
('20130000000', 'core', 'todo', 'appsstore', 0),
('20130000000', 'core', 'todo', 'plugins', 0),
('20130000000', 'core', 'subdo', 'EditTrans', 0),
('20130000000', 'core', 'subdo', 'LisTrans', 0),
('20130000000', 'core', 'subdo', 'NewTrans', 0),
('20130000000', 'core', 'todo', 'recycle', 0),
('20130000000', 'core', 'todo', 'Translations', 0),
('20130000000', 'core', 'subdo', 'EditElement', 0),
('20130000000', 'core', 'subdo', 'AddElement', 0),
('20130000000', 'core', 'subdo', 'BrowseMenu', 0),
('20130000000', 'core', 'subdo', 'DeleteElement', 0),
('20130000000', 'core', 'todo', 'mainmenu', 0),
('20130000000', 'core', 'subdo', 'SubMenu', 0),
('20130000000', 'core', 'subdo', 'ChildsOfMenu', 0),
('20130000000', 'core', 'subdo', 'editMenu', 0),
('20130000000', 'core', 'subdo', 'AddElemnts', 0),
('20130000000', 'core', 'subdo', 'AddMenu', 0),
('20130000000', 'core', 'subdo', 'AllElemnts', 0),
('20130000000', 'core', 'subdo', 'RootMenu', 0),
('20130000000', 'core', 'subdo', 'delteMenu', 0),
('20130000000', 'core', 'todo', 'layersmenu', 0),
('20130000000', 'core', 'subdo', 'delnews', 0),
('20130000000', 'core', 'subdo', 'editnews', 0),
('20130000000', 'core', 'subdo', 'AddNews', 0),
('20130000000', 'core', 'todo', 'newsbar', 0),
('20130000000', 'core', 'subdo', 'optimize', 0),
('20130000000', 'core', 'subdo', 'restore', 0),
('20130000000', 'core', 'subdo', 'backup', 0),
('20130000000', 'core', 'todo', 'database', 0),
('20130000000', 'core', 'todo', 'Error', 0),
('20130000000', 'core', 'todo', 'bugsandreport', 0),
('20130000000', 'core', 'subdo', 'delTheme', 0),
('20130000000', 'core', 'todo', 'Update', 0),
('20130000000', 'core', 'todo', 'Addons', 0),
('20130000000', 'core', 'todo', 'NewTheme', 0),
('20130000000', 'core', 'todo', 'newblock', 0),
('20130000000', 'core', 'todo', 'newprograms', 0),
('20130000000', 'core', 'todo', 'installer', 0),
('20130000000', 'core', 'todo', 'robotsadmin', 0),
('20130000000', 'core', 'todo', 'SEO', 0),
('20130000000', 'core', 'todo', 'cache', 0),
('20130000000', 'core', 'todo', 'languages', 0),
('20130000000', 'core', 'todo', 'themes', 0),
('20130000000', 'core', 'todo', 'webfolder', 0),
('20130000000', 'core', 'todo', 'options', 0),
('20130000000', 'core', 'todo', 'contieslangs', 0),
('20130000000', 'core', 'todo', 'faildlogin', 0),
('20130000000', 'core', 'todo', 'antiflood', 0),
('20130000000', 'core', 'todo', 'firewall', 0),
('20130000000', 'core', 'todo', 'blocking', 0),
('20130000000', 'core', 'todo', 'specialpermision', 0),
('20130000000', 'core', 'todo', 'blockspermisions', 0),
('20130000000', 'core', 'todo', 'programspermisions', 0),
('20130000000', 'core', 'todo', 'programscontrol', 0),
('20130000000', 'core', 'todo', 'blockscontrol', 0),
('20130000000', 'core', 'subdo', 'editl', 0),
('20130000000', 'core', 'subdo', 'deletel', 0),
('20130000000', 'core', 'subdo', 'Listletter', 0),
('20130000000', 'core', 'subdo', 'Newletter', 0),
('20130000000', 'core', 'todo', 'Letters', 0),
('20130000000', 'core', 'todo', 'Maillist', 0),
('20130000000', 'core', 'subdo', 'adminNew', 0),
('20130000000', 'core', 'subdo', 'adminDelete', 0),
('20130000000', 'core', 'subdo', 'adminPerm', 0),
('20130000000', 'core', 'subdo', 'listAdmins', 0),
('20130000000', 'core', 'todo', 'Admins', 0),
('20130000000', 'core', 'subdo', 'EditGroup', 0),
('20130000000', 'core', 'subdo', 'ChangeUserGroup', 0),
('20130000000', 'core', 'subdo', 'UsersGroup', 0),
('20130000000', 'core', 'subdo', 'SwitchGroup', 0),
('20130000000', 'core', 'subdo', 'DeleteGroup', 0),
('20130000000', 'core', 'subdo', 'NewGroup', 0),
('20130000000', 'core', 'todo', 'Groups', 0),
('20130000000', 'core', 'subdo', 'BanUser', 0),
('20130000000', 'core', 'subdo', 'ResetPassword', 0),
('20130000000', 'core', 'subdo', 'SearchUser', 0),
('20130000000', 'core', 'subdo', 'DeleteUser', 0),
('20130000000', 'core', 'subdo', 'NewUser', 0),
('20130000000', 'core', 'todo', 'members', 0),
('20130000000', 'prog', 'todo', 'restcontact', 0),
('20130000000', 'prog', 'todo', 'welcome', 0),
('20130000000', 'prog', 'todo', 'newsads', 0),
('20130000000', 'prog', 'subdo', 'deleteNews', 0),
('20130000000', 'prog', 'subdo', 'allNews', 1),
('20130000000', 'prog', 'subdo', 'NewsCat', 0),
('20130000000', 'prog', 'subdo', 'NewNewsCat', 0),
('20130000000', 'prog', 'subdo', 'addNews', 0),
('20130000000', 'prog', 'subdo', 'NewsCom', 0),
('20130000000', 'prog', 'subdo', 'editNews', 0),
('20130000000', 'prog', 'todo', 'mobawab', 0),
('20130000000', 'prog', 'todo', 'fomaconakdi', 0),
('20130000000', 'blok', 'todo', 'MainMenu', 0),
('20130000000', 'blok', 'subdo', 'DeleteElement', 0),
('20130000000', 'blok', 'subdo', 'BrowseMenu', 0),
('20130000000', 'blok', 'subdo', 'AddElement', 0),
('20130000000', 'blok', 'subdo', 'EditElement', 0),
('20130000000', 'blok', 'todo', 'AccountBlock', 0),
('20130000000', 'blok', 'todo', 'Statistics', 0),
('20130000000', 'blok', 'todo', 'Ads', 0),
('20130000000', 'blok', 'todo', 'Gsearch', 0),
('20130000000', 'blok', 'todo', 'Language', 0),
('20130000000', 'blok', 'todo', 'Pool', 0),
('20130000000', 'blok', 'subdo', 'ListPool', 0),
('20130000000', 'blok', 'subdo', 'EditPool', 0),
('20130000000', 'blok', 'subdo', 'WhatUserPool', 0),
('20130000000', 'blok', 'subdo', 'DelPool', 0),
('20130000000', 'blok', 'subdo', 'NewPool', 0),
('20130000000', 'blok', 'todo', 'FreeBlock', 0),
('20130000000', 'blok', 'todo', 'HostingCart', 0),
('20130000000', 'blok', 'subdo', 'BlockHostingCart', 0),
('20130000000', 'blok', 'todo', 'support', 0),
('20130000000', 'blok', 'todo', 'hiba', 0),
('20130000000', 'blok', 'todo', 'newcasa', 0),
('20130000000', 'blok', 'todo', 'helloworldBlock', 0),
('20130000000', 'blok', 'subdo', 'BlockHello1Perm', 0),
('20130000000', 'blok', 'subdo', 'BlockHello2Perm', 0),
('20130000000', 'blok', 'todo', 'news', 0),
('20130000000', 'blok', 'todo', 'aswdaswd', 0),
('20130000000', 'blok', 'todo', 'AutoBuySearch', 0),
('20130000000', 'blok', 'todo', 'fomaconakdiBlock', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `AdminId` varchar(11) NOT NULL COMMENT 'رقم المدير',
  `AdminMail` varchar(50) NOT NULL COMMENT 'بريد المدير',
  `LastLogin` datetime NOT NULL COMMENT 'اخر مرة سجل دخوله',
  `LastIp` varchar(15) NOT NULL COMMENT 'آخر ايبي دخل منه',
  `Note` text NOT NULL COMMENT 'ملاحظة المدير',
  `AdminSign` text NOT NULL COMMENT 'توقيع المدير في الرسائل',
  `BackupFolder` longtext NOT NULL COMMENT 'مجلد حفظ نسخ الاحتياط من قاعدة البيانات',
  `Stopped` datetime NOT NULL COMMENT 'تاريخ ايقافه',
  `IsAdam` int(1) NOT NULL COMMENT 'هل هو المدير العام',
  PRIMARY KEY (`AdminId`),
  UNIQUE KEY `AdminId` (`AdminId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول المدير';

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminId`, `AdminMail`, `LastLogin`, `LastIp`, `Note`, `AdminSign`, `BackupFolder`, `Stopped`, `IsAdam`) VALUES
('200700000-1', 'webmaster@phptransformer.com', '2014-07-23 10:30:33', '127.0.0.1', 'u’\\u1d2e\\u1d35\\u1d33\\u1d2e\\u1d35\\u1d3f\\u1d30<br><br>autobuy All...<br><br>autobuy is special<br><br>themes edit online<br><br>Default touch theme<br><br>rename Default to classic<br><br>change *****icons<br><br>getlicense من لوحة التحكم عم تروح على موقع pt<br>على البرنامج getlicense<br><br>web folder any *****if direct<br><br>delete xxx , ~ , del', 'شسيسشي سشي سشي سشي سشي', 'downloads/db_backup/', '0000-00-00 00:00:00', 1),
('20120000000', 'fgfd@zsfsa.com', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', 0),
('20130000000', 'sales@phptransformer.com', '2013-06-01 14:26:20', '127.0.0.1', '', '', '', '0000-00-00 00:00:00', 0),
('20130000001', 'asdsd@fasfd.com', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', 0),
('20140000007', 'xcvxvc@cxvcxv.com', '0000-00-00 00:00:00', '', '', '', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bancltrans`
--

CREATE TABLE IF NOT EXISTS `bancltrans` (
  `IdTrans` varchar(11) NOT NULL COMMENT 'رقم الحركة',
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم المعلن',
  `Debit` double NOT NULL COMMENT 'مدين',
  `Credit` double NOT NULL COMMENT 'دائن',
  `Date` datetime NOT NULL COMMENT 'التاريخ',
  `ValueDate` datetime NOT NULL COMMENT 'تاريخ الاستحقاق',
  `Desc` varchar(100) NOT NULL COMMENT 'البيان',
  PRIMARY KEY (`IdTrans`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='حركة زبون الاعلان المتعلقة بالتح';

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE IF NOT EXISTS `banner` (
  `IdBanner` varchar(11) NOT NULL COMMENT 'رقم البانر',
  `IdComp` varchar(11) NOT NULL COMMENT 'رقم الحملة',
  `BanName` varchar(35) NOT NULL COMMENT 'اسم الاعلان',
  `ViewMade` double NOT NULL COMMENT 'عدد المشاهدات',
  `ClicksMade` double NOT NULL COMMENT 'عدد النقرات',
  `CodeBan` varchar(1024) NOT NULL COMMENT 'كود الاعلان',
  `ClickUrl` varchar(1024) NOT NULL COMMENT 'وجهة الاعلان',
  `altTxt` varchar(35) NOT NULL COMMENT 'النص الظاهر',
  `Position` varchar(5) NOT NULL COMMENT 'مكان الاعلان',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا او محذوف',
  `Cost` double NOT NULL COMMENT 'الكلفة الحالية للمعلن',
  UNIQUE KEY `IdBanner` (`IdBanner`),
  FULLTEXT KEY `BanName` (`BanName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لاعلانات';

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`IdBanner`, `IdComp`, `BanName`, `ViewMade`, `ClicksMade`, `CodeBan`, `ClickUrl`, `altTxt`, `Position`, `Active`, `Cost`) VALUES
('20130000003', '20130000002', 'dfgfdgf', 682, 0, '<img src="http://localhost/Themes/newcasa/images/block-special.png" alt="dfgdfg" border="0"  width="{width}" height="{height}" />', '', 'dfgdfg', '1', '1', 68.20000000000033),
('20130000002', '20130000002', 'vvvvvvvvvvvv', 0, 0, '<strong>vvvvvvvvvvvv</strong><br />vvvvvvvvvvvvvvvvv <br />vvvvvvvvvvvvvvvv<br /><a href="index.php?prog=ads&banid=20130000002&Lang=English&nl=1" target="_blank" title="vvvvvvvvvvvv">vvvvvvvvvvvvvvvvv</a><br />', 'http://vvvvvvvvvvvv', '', '1', '1', 0),
('20130000001', '20130000001', '2222222', 1, 1, '<strong>2222222</strong><br />22222222222222 <br />222222222222222222222<br /><a href="index.php?prog=ads&banid=20130000001&Lang=English&nl=1" target="_blank" title="2222222">222222222222222</a><br />', 'http://22222222222.com', '', '1', '0', 0.1),
('20130000000', '20130000001', 'asdsad fgbfb', 0, 1, '<strong>asdsad fgbfb</strong><br /> nmnbmnbm nbm nb  <br />uyiytui yuyt uytu ytu ytu yt uytu<br /><a href="index.php?prog=ads&banid=20130000000&Lang=English&nl=1" target="_blank" title="asdsad fgbfb">cvb vbv bvcb vcb vbc vbc bvcb bv</a><br />', 'http://www.xcvcv.com', '', '1', '0', 0.5),
('20130000004', '20130000002', 'ASDAS', 0, 0, '<strong>ASDAS</strong><br />AsaS <br />ASaS<br /><a href="http://192.168.0.103/phptransformer/prog-ads_banid-20130000004_Lang-Arabic_nl-1.pt" target="_blank" title="ASDAS">ASaS</a><br />', 'HTTP://SCSDSA.OM', '', '1', '1', 0),
('20130000005', '20130000002', 'zxcszx', 0, 0, '<strong>zxcszx</strong><br />zxczx <br />zxzxz<br /><a href="http://192.168.0.103/phptransformer/prog-ads_banid-20130000005_Lang-Arabic_nl-1.pt" target="_blank" title="zxcszx">Xzxz</a><br />', 'http://sdsadsad.com', '', '1', '1', 0),
('20130000006', '20130000002', 'DSFDSF', 0, 0, '<strong>DSFDSF</strong><br />SDFDSF <br />SDFDSF<br /><a href="http://192.168.0.103/phptransformer/prog-ads_banid-20130000006_Lang-Arabic_nl-1.pt" target="_blank" title="DSFDSF">SDFDSF</a><br />', 'HTTP://DSFDSFDSF.COM', '', '1', '1', 0),
('20130000007', '20130000002', 'sadcsad', 0, 0, '<strong>sadcsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000007_Lang-Arabic_nl-1.pt" target="_blank" title="sadcsad">asdsad</a><br />', 'http://asdsadsad.com', '', '1', '1', 0),
('20130000008', '20130000002', 'ssadasd', 0, 0, '<strong>ssadasd</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000008_Lang-Arabic_nl-1.pt" target="_blank" title="ssadasd">sadsad</a><br />', 'http://sadxcxzc.com', '', '1', '1', 0),
('20130000009', '20130000002', 'SAD', 0, 1, '<strong>SAD</strong><br />SDSADSAD <br />ASDSAD<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000009_Lang-Arabic_nl-1.pt" target="_blank" title="SAD">ASDSAD</a><br />', 'HTTP://DXGDSFGDS.COM', '', '1', '1', 0.5),
('20130000010', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000010_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dsfcsadfsad', '', '1', '1', 0),
('20130000011', '20130000002', 'asdaS', 0, 0, '<strong>asdaS</strong><br />ASaSAS <br />aSAS<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000011_Lang-Arabic_nl-1.pt" target="_blank" title="asdaS">aSA</a><br />', 'http://fcgfg', '', '1', '1', 0),
('20130000012', '20130000002', 'asdaS', 0, 0, '<strong>asdaS</strong><br />ASaSAS <br />aSAS<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000012_Lang-Arabic_nl-1.pt" target="_blank" title="asdaS">aSA</a><br />', 'http://fcgfg', '', '1', '1', 0),
('20130000013', '20130000002', 'sdsad', 0, 0, '<strong>sdsad</strong><br />asfdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000013_Lang-Arabic_nl-1.pt" target="_blank" title="sdsad">sadsa</a><br />', 'http://fbfxbf.com', '', '1', '1', 0),
('20130000014', ' ', 'sdsads', 0, 0, '<strong>sdsads</strong><br />adsadsa <br />dsadsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000014_Lang-Arabic_nl-1.pt" target="_blank" title="sdsads">sadsad</a><br />', 'http://dsfdsfds', '', '1', '1', 0),
('20130000015', '20130000002', 'test', 0, 0, '<strong>test</strong><br />sdsadsa <br />sadsadd<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000015_Lang-Arabic_nl-1.pt" target="_blank" title="test">asdsa</a><br />', 'http://dsadsa', '', '1', '1', 0),
('20130000016', '20130000002', 'test', 0, 0, '<strong>test</strong><br />sdsadsa <br />sadsadd<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000016_Lang-Arabic_nl-1.pt" target="_blank" title="test">asdsa</a><br />', 'http://dsadsa', '', '1', '1', 0),
('20130000017', '20130000001', 'SADSAD', 0, 0, '<strong>SADSAD</strong><br />ASDSAD <br />SADSAD<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000017_Lang-Arabic_nl-1.pt" target="_blank" title="SADSAD">SADSAD</a><br />', 'HTTP://ASDCSADS', '', '1', '1', 0),
('20130000018', '20130000001', 'SADSAD', 0, 0, '<strong>SADSAD</strong><br />ASDSAD <br />SADSAD<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000018_Lang-Arabic_nl-1.pt" target="_blank" title="SADSAD">SADSAD</a><br />', 'HTTP://ASDCSADS', '', '1', '1', 0),
('20130000019', '20130000001', 'asdsad', 0, 0, '<strong>asdsad</strong><br />adsad <br />sadsadsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000019_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">sadsad</a><br />', 'http://gfhgfh', '', '1', '1', 0),
('20130000020', '20130000001', 'sadfsad', 0, 0, '<strong>sadfsad</strong><br />asdasd <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000020_Lang-Arabic_nl-1.pt" target="_blank" title="sadfsad">asdsad</a><br />', 'http://dfgdsdsf', '', '1', '1', 0),
('20130000021', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdasd<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000021_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsa</a><br />', 'http://fdd', '', '1', '1', 0),
('20130000022', '20130000002', 'ssad', 0, 0, '<strong>ssad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000022_Lang-Arabic_nl-1.pt" target="_blank" title="ssad">cdvdsf</a><br />', 'http://jkljhkhj', '', '1', '1', 0),
('20130000023', '20130000002', 'csfvcfvgdsfg', 0, 0, '<strong>csfvcfvgdsfg</strong><br />dfgfdgdfg <br />gfdgfdg<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000023_Lang-Arabic_nl-1.pt" target="_blank" title="csfvcfvgdsfg">dfgfdg</a><br />', 'http://cvbvbvcbvc', '', '1', '1', 0),
('20130000024', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000024_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000025', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000025_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000026', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000026_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000027', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000027_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000028', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000028_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000029', '20130000002', 'asdsad', 0, 0, '<strong>asdsad</strong><br />asdsad <br />asdsad<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000029_Lang-Arabic_nl-1.pt" target="_blank" title="asdsad">asdsad</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000030', ' ', 'dsfgdsfd', 0, 0, '<strong>dsfgdsfd</strong><br />sdfdsf <br />dfdsf<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000030_Lang-Arabic_nl-1.pt" target="_blank" title="dsfgdsfd">sdfdsf</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000031', ' ', 'dsfgdsfd', 0, 0, '<strong>dsfgdsfd</strong><br />sdfdsf <br />dfdsf<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000031_Lang-Arabic_nl-1.pt" target="_blank" title="dsfgdsfd">sdfdsf</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000032', ' ', 'dsfgdsfd', 0, 0, '<strong>dsfgdsfd</strong><br />sdfdsf <br />dfdsf<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000032_Lang-Arabic_nl-1.pt" target="_blank" title="dsfgdsfd">sdfdsf</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000033', ' ', 'dsfgdsfd', 0, 0, '<strong>dsfgdsfd</strong><br />sdfdsf <br />dfdsf<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000033_Lang-Arabic_nl-1.pt" target="_blank" title="dsfgdsfd">sdfdsf</a><br />', 'http://dxcvdvxcvzxv', '', '1', '1', 0),
('20130000034', '20130000002', 'SADSAD', 0, 0, '<strong>SADSAD</strong><br />ASDSAD <br />ASDSAD<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000034_Lang-Arabic_nl-1.pt" target="_blank" title="SADSAD">ASDSA</a><br />', 'HTTP://CVBVCB', '', '1', '1', 0),
('20130000035', '20130000002', 'SADSAD', 0, 0, '<strong>SADSAD</strong><br />ASDSAD <br />ASDSAD<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000035_Lang-Arabic_nl-1.pt" target="_blank" title="SADSAD">ASDSA</a><br />', 'HTTP://CVBVCB', '', '1', '1', 0),
('20130000036', '20130000002', 'sadsad', 0, 0, '<strong>sadsad</strong><br />sadsad <br />sadsadsa<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000036_Lang-Arabic_nl-1.pt" target="_blank" title="sadsad">dsad</a><br />', 'http://vnbcvbncvnb.com', '', '1', '1', 0),
('20130000037', '20130000002', 'sadsad', 0, 0, '<strong>sadsad</strong><br />sadsad <br />sadsadsa<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000037_Lang-Arabic_nl-1.pt" target="_blank" title="sadsad">dsad</a><br />', 'http://vnbcvbncvnb.com', '', '1', '1', 0),
('20130000038', '20130000002', 'sadsad', 0, 0, '<strong>sadsad</strong><br />sadsad <br />sadsadsa<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000038_Lang-Arabic_nl-1.pt" target="_blank" title="sadsad">dsad</a><br />', 'http://vnbcvbncvnb.com', '', '1', '1', 0),
('20130000039', '20130000002', 'sadsad', 0, 0, '<strong>sadsad</strong><br />sadsad <br />sadsadsa<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000039_Lang-Arabic_nl-1.pt" target="_blank" title="sadsad">dsad</a><br />', 'http://vnbcvbncvnb.com', '', '1', '1', 0),
('20130000040', '20130000002', 'sadsad', 0, 0, '<strong>sadsad</strong><br />sadsad <br />sadsadsa<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000040_Lang-Arabic_nl-1.pt" target="_blank" title="sadsad">dsad</a><br />', 'http://vnbcvbncvnb.com', '', '1', '1', 0),
('20130000041', '20130000002', 'sdfsadf', 0, 0, '<strong>sdfsadf</strong><br />sdfdsf <br />sdfdsf<br /><a href="https://192.168.0.103/phptransformer/prog-ads_banid-20130000041_Lang-Arabic_nl-1.pt" target="_blank" title="sdfsadf">sdfsd</a><br />', 'http://xcvbcxv.c', '', '1', '1', 0),
('20130000042', '20130000002', 'sdfsad', 0, 0, '<img src="http://localhost/phptransformer/Themes/Default/Images/logo.jpg" alt="sfsads" border="0"  width="{width}" height="{height}" />', 'https://192.168.0.103/phptransformer/Themes/Default/Images/logo.jpg', 'sfsads', '1', '1', 0),
('20130000043', '20130000002', 'تجربة الان', 0, 1, '<strong>تجربة الان</strong><br />يسب سشسي سش <br />يسب سشي سشي<br /><a href="index.php?prog=ads&banid=20130000043&Lang=Arabic&nl=1" target="_blank" title="تجربة الان">سشيسش يسشيسشي </a><br />', 'http://weweew.com', '', '1', '1', 0.5),
('20130000044', '20130000003', 'rdgdrg', 0, 0, '<strong>rdgdrg</strong><br />vhnhvj <br />m,nm,nmnb<br /><a href="http://localhost/phptransformer/prog-ads_banid-20130000044_Lang-Arabic_nl-1.pt" target="_blank" title="rdgdrg">cvcb</a><br />', 'http://google.com', '', '2', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bannerclients`
--

CREATE TABLE IF NOT EXISTS `bannerclients` (
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم زبون الاعلان',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `AdminOk` varchar(1) NOT NULL COMMENT 'تم الموافقة على حساب المعلن من قبل المدير نعم او لا',
  `adsPayment` varchar(20) NOT NULL COMMENT 'طريقة الدفع',
  UNIQUE KEY `idBanClnt` (`idBanClnt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='المستخدمين المعلينين';

--
-- Dumping data for table `bannerclients`
--

INSERT INTO `bannerclients` (`idBanClnt`, `UserId`, `AdminOk`, `adsPayment`) VALUES
('20120000000', '200700000-1', '1', 'Cash'),
('20140000000', '20140000000', '1', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `bannerplans`
--

CREATE TABLE IF NOT EXISTS `bannerplans` (
  `IdBanPlan` varchar(11) NOT NULL COMMENT 'رقم خطة الاعلان',
  `BPActive` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `BPName` varchar(15) NOT NULL COMMENT 'اسم الخطة',
  `BPDesc` varchar(35) NOT NULL COMMENT 'تفصيل الخطة',
  `ViewPrice` float NOT NULL COMMENT 'سعر المشاهدة',
  `ClickPrice` float NOT NULL COMMENT 'سعر النقرة',
  `LinksNbr` varchar(10) NOT NULL COMMENT 'عدد الارتباطات',
  `planStart` datetime NOT NULL COMMENT 'بداية العرض لهذه الخطة',
  `planEnd` datetime NOT NULL COMMENT 'نهاية العرض لهذه الخطة',
  UNIQUE KEY `IdBanPlan` (`IdBanPlan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خطط الاعلان';

--
-- Dumping data for table `bannerplans`
--

INSERT INTO `bannerplans` (`IdBanPlan`, `BPActive`, `BPName`, `BPDesc`, `ViewPrice`, `ClickPrice`, `LinksNbr`, `planStart`, `planEnd`) VALUES
('20120000000', '1', 'dfdf', 'ddfdsdv fd', 0.1, 0.5, '9999999999', '2012-09-15 17:23:46', '2017-09-22 17:23:00');

-- --------------------------------------------------------

--
-- Table structure for table `bannerpositions`
--

CREATE TABLE IF NOT EXISTS `bannerpositions` (
  `IdBanPos` varchar(11) NOT NULL COMMENT 'رقم موضع الاعلان',
  `PositionNbr` varchar(2) NOT NULL COMMENT 'مكان الاعلان كرقم',
  `PositionName` varchar(15) NOT NULL COMMENT 'اسم الموضع',
  `PosWidth` varchar(11) NOT NULL COMMENT 'عرض مكان الاعلان',
  `PosHeight` varchar(11) NOT NULL COMMENT 'طول مكان الاعلان',
  UNIQUE KEY `IdBanPos` (`IdBanPos`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='مواضع الاعلانات في الموق';

--
-- Dumping data for table `bannerpositions`
--

INSERT INTO `bannerpositions` (`IdBanPos`, `PositionNbr`, `PositionName`, `PosWidth`, `PosHeight`) VALUES
('20070000001', '1', 'Ads Block', '160', '250'),
('20130000000', '2', 'nivo', '500', '400');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE IF NOT EXISTS `blacklist` (
  `BlackWord` varchar(100) NOT NULL COMMENT 'الكلمة المحظورة',
  `BlockReason` varchar(1024) NOT NULL COMMENT 'سبب الحظر',
  `BlockDate` datetime NOT NULL COMMENT 'تاريخ الحظر'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الكلمات المحظورة للاستعمال في ال';

--
-- Dumping data for table `blacklist`
--

INSERT INTO `blacklist` (`BlackWord`, `BlockReason`, `BlockDate`) VALUES
('admin', 'طرد مستخدم', '2014-01-10 14:16:23'),
('mhndm@phptransformer.com', 'zss', '2014-01-10 14:14:55'),
('mhndm@phptransformer.com', 'طرد مستخدم', '2014-01-10 14:16:23'),
('teston', 'طرد مستخدم', '2014-01-10 14:26:10'),
('sdsad@asdsad.com', 'طرد مستخدم', '2014-01-10 14:26:10'),
('teston', 'طرد مستخدم', '2014-01-10 14:27:55'),
('sdsad@asdsad.com', 'طرد مستخدم', '2014-01-10 14:27:55');

-- --------------------------------------------------------

--
-- Table structure for table `blocklang`
--

CREATE TABLE IF NOT EXISTS `blocklang` (
  `idblocklang` varchar(11) NOT NULL COMMENT 'رقم الجدول',
  `BlockName` varchar(35) NOT NULL COMMENT 'اسم البلوك',
  `idLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `BlockTitle` varchar(35) NOT NULL COMMENT 'عنوان البلوك بهذه اللغة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blocklang`
--

INSERT INTO `blocklang` (`idblocklang`, `BlockName`, `idLang`, `BlockTitle`) VALUES
('20120000000', 'HostingCart', '20070000001', 'HostingCart'),
('20120000001', 'HostingCart', '20120000000', 'HostingCart'),
('20120000002', 'support', '20070000001', 'support'),
('20120000003', 'support', '20120000000', 'support'),
('20120000004', 'AccountBlock', '20070000001', ' AccountBlock'),
('20120000005', 'AccountBlock', '20120000000', ' AccountBlock'),
('20120000006', 'MainMenu', '20070000001', ' MainMenu'),
('20120000007', 'MainMenu', '20120000000', ' MainMenu'),
('20120000008', 'FreeBlock', '20070000001', ' FreeBlock'),
('20120000010', 'Statistics', '20070000001', ' Statistics'),
('20120000011', 'Statistics', '20120000000', ' Statistics'),
('20120000012', 'Ads', '20070000001', ' Ads'),
('20120000014', 'Gsearch', '20070000001', ' Gsearch'),
('20120000015', 'Gsearch', '20120000000', ' Gsearch'),
('20120000016', 'Language', '20070000001', ' Language'),
('20120000017', 'Language', '20120000000', ' Language'),
('20120000018', 'Pool', '20070000001', 'vote'),
('20120000019', 'Pool', '20120000000', 'vote'),
('20120000020', 'hiba', '20120000000', 'hiba'),
('20120000021', 'newcasa', '20120000000', 'newcasa'),
('20120000022', 'newcasa', '20120000001', 'newcasa'),
('20120000023', 'newcasa', '20120000002', 'newcasa'),
('20120000027', 'helloworldBlock', '20120000000', 'dfgfregfreg'),
('20120000028', 'helloworldBlock', '20120000001', 'بؤيسبسيب '),
('20120000029', 'helloworldBlock', '20120000002', 'helloworldBlock'),
('20120000036', 'FreeBlock', '20120000000', 'History'),
('20120000037', 'FreeBlock', '20120000001', ' '),
('20120000038', 'FreeBlock', '20120000002', ' '),
('20120000033', 'news', '20120000000', 'news'),
('20120000034', 'news', '20120000001', 'news'),
('20120000035', 'news', '20120000002', 'news'),
('20130000003', 'Ads', '20120000000', ' ads'),
('20140000012', 'Ads', '20120000001', 'اعلانات'),
('20130000005', 'Ads', '20120000002', 'ads'),
('20120000042', 'aswdaswd', '20120000000', 'aswdaswd'),
('20120000043', 'aswdaswd', '20120000001', 'aswdaswd'),
('20120000044', 'aswdaswd', '20120000002', 'aswdaswd'),
('20130000000', 'AutoBuySearch', '20120000000', 'AutoBuySearch'),
('20130000001', 'AutoBuySearch', '20120000001', 'AutoBuySearch'),
('20130000002', 'AutoBuySearch', '20120000002', 'AutoBuySearch'),
('20130000006', 'Ads', '20130000000', 'ads'),
('20130000007', 'fomaconakdiBlock', '20120000000', 'fomaconakdiBlock'),
('20130000008', 'fomaconakdiBlock', '20120000001', 'fomaconakdiBlock'),
('20130000009', 'fomaconakdiBlock', '20120000002', 'fomaconakdiBlock'),
('20130000010', 'fomaconakdiBlock', '20130000000', 'fomaconakdiBlock'),
('20140000000', 'AccountBlock', '20120000001', 'حساب الاعضاء'),
('20140000001', 'AccountBlock', '20130000001', 'Members'),
('20140000002', 'Language', '20120000001', 'اللغات'),
('20140000003', 'Language', '20130000001', 'Languages'),
('20140000004', 'MainMenu', '20120000001', 'صفحات الموقع'),
('20140000005', 'MainMenu', '20130000001', 'Website pages'),
('20140000006', 'Statistics', '20120000001', 'احصائيات'),
('20140000007', 'Statistics', '20130000001', 'statistics'),
('20140000008', 'Gsearch', '20120000001', 'بحث'),
('20140000009', 'Gsearch', '20130000001', 'search'),
('20140000010', 'Pool', '20120000001', 'تصويت'),
('20140000011', 'Pool', '20130000001', 'poll'),
('20140000013', 'Ads', '20130000001', 'advertising'),
('20140000014', 'translate', '20120000001', 'translate'),
('20140000015', 'translate', '20130000001', 'translate'),
('20140000016', 'mohsenbbb', '20120000001', 'mohsenbbb'),
('20140000017', 'mohsenbbb', '20130000001', 'mohsenbbb'),
('20140000018', 'mohsenbbb', '20140000000', 'mohsenbbb'),
('20140000019', 'mohsenbbb', '20140000001', 'mohsenbbb');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `BlockName` varchar(35) NOT NULL DEFAULT '',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `View` varchar(1) NOT NULL COMMENT 'يمكن مشاهدته نعم او لا',
  `MainSec` varchar(2) NOT NULL COMMENT 'مكانه على اليمين او يسار',
  `Order` int(2) NOT NULL COMMENT 'ترتيبه من الاعلى',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقمه المرتبط بالسيكيوريتي',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل البلوك محذوف؟',
  `License` text NOT NULL,
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  PRIMARY KEY (`BlockName`),
  UNIQUE KEY `BlockName` (`BlockName`),
  UNIQUE KEY `BlockName_2` (`BlockName`),
  UNIQUE KEY `BlockName_3` (`BlockName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='البلوكات';

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`BlockName`, `Active`, `View`, `MainSec`, `Order`, `ObjectId`, `Deleted`, `License`, `LastChekUpdate`, `UpdateAvailble`, `UpdateDesc`) VALUES
('MainMenu', '1', '1', 'M', 2, '20070000001', '', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('AccountBlock', '1', '1', 'M', 1, '20070000002', '0', '', '0000-00-00 00:00:00', 0, ''),
('Statistics', '1', '1', 'M', 5, '20070000003', '', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('Ads', '1', '1', 'S', 9, '20070000004', '', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('Gsearch', '1', '1', 'M', 3, '20070000005', '', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('Language', '1', '1', 'S', 2, '20070000006', '', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('Pool', '1', '1', 'M', 4, '20070000008', '', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('FreeBlock', '1', '1', 'S', 5, '20110000002', '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', '0000-00-00 00:00:00', 0, ''),
('HostingCart', '1', '1', 'S', 2, '20120000001', '0', 'swdwsd', '0000-00-00 00:00:00', 0, ''),
('support', '1', '1', 'S', 4, '20120000002', '0', '', '0000-00-00 00:00:00', 0, ''),
('hiba', '1', '1', 'S', 3, '20120000004', '0', '', '0000-00-00 00:00:00', 0, ''),
('newcasa', '1', '1', 'S', 2, '20120000007', '0', '', '0000-00-00 00:00:00', 0, ''),
('helloworldBlock', '1', '1', 'S', 5, '20120000008', '0', '', '0000-00-00 00:00:00', 0, ''),
('news', '1', '1', 'S', 4, '20120000009', '0', '', '0000-00-00 00:00:00', 0, ''),
('aswdaswd', '1', '1', 'S', 14, '20120000015', '0', '', '0000-00-00 00:00:00', 0, ''),
('AutoBuySearch', '1', '1', 'S', 2, '20130000001', '0', '', '0000-00-00 00:00:00', 0, ''),
('fomaconakdiBlock', '1', '1', 'S', 3, '20130000003', '0', '', '0000-00-00 00:00:00', 0, ''),
('translate', '1', '1', 'S', 3, '20140000004', '0', '', '0000-00-00 00:00:00', 0, ''),
('mohsenbbb', '1', '1', 'M', 1, '20140000006', '0', '', '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `bn_families`
--

CREATE TABLE IF NOT EXISTS `bn_families` (
  `idfamilies` varchar(11) NOT NULL,
  `family` varchar(45) NOT NULL,
  `diyana` tinyint(4) NOT NULL,
  PRIMARY KEY (`idfamilies`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bn_families`
--

INSERT INTO `bn_families` (`idfamilies`, `family`, `diyana`) VALUES
('1', 'الموسوي', 1),
('2', 'عون', 2),
('3', 'جنبلاط', 3),
('4', 'الحريري', 1),
('5', 'سليمان', 0),
('6', 'الحاج', 0),
('7', 'نقولا', 2),
('8', 'دكاش', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bn_famreg`
--

CREATE TABLE IF NOT EXISTS `bn_famreg` (
  `idregion` varchar(11) NOT NULL,
  `idfamilies` varchar(11) NOT NULL,
  PRIMARY KEY (`idregion`,`idfamilies`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bn_famreg`
--

INSERT INTO `bn_famreg` (`idregion`, `idfamilies`) VALUES
('1', '1'),
('1', '2'),
('1', '4'),
('1', '7'),
('1', '8'),
('2', '1'),
('2', '8'),
('3', '1'),
('3', '5'),
('4', '3'),
('5', '1'),
('6', '1'),
('6', '6'),
('7', '4'),
('8', '6'),
('8', '7');

-- --------------------------------------------------------

--
-- Table structure for table `bn_names`
--

CREATE TABLE IF NOT EXISTS `bn_names` (
  `idnames` varchar(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `diyana` tinyint(4) NOT NULL,
  PRIMARY KEY (`idnames`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bn_names`
--

INSERT INTO `bn_names` (`idnames`, `name`, `diyana`) VALUES
('1', 'علي', 1),
('2', 'حسن', 1),
('3', 'مارون', 2),
('4', 'طوني', 2),
('5', 'وليد', 3),
('6', 'كمال', 3),
('7', 'سامر', 0),
('8', 'أسامة', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bn_region`
--

CREATE TABLE IF NOT EXISTS `bn_region` (
  `idregion` varchar(11) NOT NULL,
  `region` varchar(45) NOT NULL,
  PRIMARY KEY (`idregion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bn_region`
--

INSERT INTO `bn_region` (`idregion`, `region`) VALUES
('1', 'زحلة'),
('2', 'بعلبك'),
('3', 'بيروت'),
('4', 'عالية'),
('5', 'النبي شيت'),
('6', 'حوش حالا'),
('7', 'صيدا'),
('8', 'طرابلس');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `IdComp` varchar(11) NOT NULL COMMENT 'ؤقم الحملة الاعلانية',
  `idBanClnt` varchar(11) NOT NULL COMMENT 'رقم الزبون',
  `CampName` varchar(35) NOT NULL COMMENT 'اسم الحملة الاعلانية',
  `CompStart` datetime NOT NULL COMMENT 'تاريخ بدء الحملة',
  `CompEnd` datetime NOT NULL COMMENT 'تاريخ نهاية الحملة',
  `MaxView` double NOT NULL COMMENT 'العدد الاقصى للمشاهدات',
  `MaxClick` double NOT NULL COMMENT 'العدد الاقصى للنقر',
  `Activity` varchar(1) NOT NULL COMMENT 'نشط او لا او محذوف',
  `Budget` double NOT NULL COMMENT 'الميزانية لهذه الحملة',
  UNIQUE KEY `IdComp` (`IdComp`),
  UNIQUE KEY `CampName` (`CampName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الحملات الاعلانية';

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`IdComp`, `idBanClnt`, `CampName`, `CompStart`, `CompEnd`, `MaxView`, `MaxClick`, `Activity`, `Budget`) VALUES
('20130000002', '200700000-1', 'ugkk', '2013-02-06 12:39:00', '2014-02-18 12:39:37', 5e16, 1e21, '1', 1e22),
('20130000001', '200700000-1', 'test test test test test test test ', '2013-02-17 11:54:19', '2018-02-18 11:54:23', 66666, 66666, '0', 99999),
('20130000003', '200700000-1', 'dzfdsf', '2013-11-11 14:20:37', '2013-11-29 14:20:39', 435435, 234324, '1', 99);

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE IF NOT EXISTS `careers` (
  `CvId` varchar(11) NOT NULL,
  `FirstNameValue` varchar(35) DEFAULT NULL,
  `FatherNameValue` varchar(35) DEFAULT NULL,
  `MotherNameValue` varchar(35) DEFAULT NULL,
  `GrandFatherNameValue` varchar(35) DEFAULT NULL,
  `FamilyNameValue` varchar(35) DEFAULT NULL,
  `BirthDateValue` varchar(35) DEFAULT NULL,
  `BirthLocationValue` varchar(35) DEFAULT NULL,
  `CertifecateFrom3Value` varchar(35) DEFAULT NULL,
  `SexValue` varchar(1) DEFAULT NULL,
  `NationalityValue` varchar(35) DEFAULT NULL,
  `SegelNbrValue` varchar(35) DEFAULT NULL,
  `SegelLocationValue` varchar(35) DEFAULT NULL,
  `DamanNbrValue` varchar(35) DEFAULT NULL,
  `celibateValue` varchar(35) DEFAULT NULL,
  `MariageValue` varchar(35) DEFAULT NULL,
  `WidowerValue` varchar(35) DEFAULT NULL,
  `DivorcedValue` varchar(35) DEFAULT NULL,
  `FianceValue` varchar(35) DEFAULT NULL,
  `SpendName1Value` varchar(35) DEFAULT NULL,
  `Relative1Value` varchar(35) DEFAULT NULL,
  `Sex1Value` varchar(1) DEFAULT NULL,
  `BirthDate1Value` varchar(35) DEFAULT NULL,
  `SpendName2Value` varchar(35) DEFAULT NULL,
  `Relative2Value` varchar(35) DEFAULT NULL,
  `Sex2Value` varchar(1) DEFAULT NULL,
  `BirthDate2Value` varchar(35) DEFAULT NULL,
  `SpendName3Value` varchar(35) DEFAULT NULL,
  `Relative3Value` varchar(35) DEFAULT NULL,
  `Sex3Value` varchar(1) DEFAULT NULL,
  `BirthDate3Value` varchar(35) DEFAULT NULL,
  `SpendName4Value` varchar(35) DEFAULT NULL,
  `Relative4Value` varchar(35) DEFAULT NULL,
  `Sex4Value` varchar(1) DEFAULT NULL,
  `BirthDate4Value` varchar(35) DEFAULT NULL,
  `SpendName5Value` varchar(35) DEFAULT NULL,
  `Sex5Value` varchar(1) DEFAULT NULL,
  `BirthDate5Value` varchar(35) DEFAULT NULL,
  `SpendName6Value` varchar(35) DEFAULT NULL,
  `Relative6Value` varchar(35) DEFAULT NULL,
  `Sex6Value` varchar(1) DEFAULT NULL,
  `BirthDate6Value` varchar(35) DEFAULT NULL,
  `HealthStatusValue` varchar(35) DEFAULT NULL,
  `HearingValue` varchar(1) DEFAULT NULL,
  `ViewingValue` varchar(1) DEFAULT NULL,
  `TalkingValue` varchar(1) DEFAULT NULL,
  `DidUSmokeYesValue` varchar(1) DEFAULT NULL,
  `DidUSmokeNoValue` varchar(1) DEFAULT NULL,
  `DidUDoObligingYesValue` varchar(1) DEFAULT NULL,
  `DidUDoObligingNoValue` varchar(1) DEFAULT NULL,
  `ObligingOtherValue` varchar(35) DEFAULT NULL,
  `TownValue` varchar(35) DEFAULT NULL,
  `RueValue` varchar(35) DEFAULT NULL,
  `BuildingValue` varchar(35) DEFAULT NULL,
  `BuildOwnerValue` varchar(35) DEFAULT NULL,
  `PhoneValue` varchar(35) DEFAULT NULL,
  `CellulaireValue` varchar(35) DEFAULT NULL,
  `EmailValue` varchar(35) DEFAULT NULL,
  `EducationLevel1Value` varchar(35) DEFAULT NULL,
  `Average1Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom1Value` varchar(35) DEFAULT NULL,
  `CertifecateYear1Value` varchar(35) DEFAULT NULL,
  `EducationLevel2Value` varchar(35) DEFAULT NULL,
  `Average2Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom2Value` varchar(35) DEFAULT NULL,
  `CertifecateYear2Value` varchar(35) DEFAULT NULL,
  `EducationLevel3Value` varchar(35) DEFAULT NULL,
  `Average3Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom3` varchar(35) DEFAULT NULL,
  `CertifecateYear3Value` varchar(35) DEFAULT NULL,
  `EducationLevel4Value` varchar(35) DEFAULT NULL,
  `Average14Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom14Value` varchar(35) DEFAULT NULL,
  `CertifecateYear4Value` varchar(35) DEFAULT NULL,
  `EducationLevel5Value` varchar(35) DEFAULT NULL,
  `Average5Value` varchar(35) DEFAULT NULL,
  `CertifecateFrom5Value` varchar(35) DEFAULT NULL,
  `CertifecateYear5Value` varchar(35) DEFAULT NULL,
  `CycleName1Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle1Value` varchar(35) DEFAULT NULL,
  `CycleFrom1Value` varchar(35) DEFAULT NULL,
  `CycleDate1Value` varchar(35) DEFAULT NULL,
  `CycleName2Value` varchar(35) DEFAULT NULL,
  `CycleInterval2Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle12Value` varchar(35) DEFAULT NULL,
  `CycleFrom2Value` varchar(35) DEFAULT NULL,
  `CycleName3Value` varchar(35) DEFAULT NULL,
  `CycleInterval3Value` varchar(35) DEFAULT NULL,
  `CycleDate2Value` varchar(35) DEFAULT NULL,
  `CycleInterval1Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle13Value` varchar(35) DEFAULT NULL,
  `CycleFrom3Value` varchar(35) DEFAULT NULL,
  `CycleDate3Value` varchar(35) DEFAULT NULL,
  `CycleName4Value` varchar(35) DEFAULT NULL,
  `CycleInterval4Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle14Value` varchar(35) DEFAULT NULL,
  `CycleFrom4Value` varchar(35) DEFAULT NULL,
  `CycleDate4Value` varchar(35) DEFAULT NULL,
  `CycleName5Value` varchar(35) DEFAULT NULL,
  `CycleInterval5Value` varchar(35) DEFAULT NULL,
  `SkillsFromCycle15Value` varchar(35) DEFAULT NULL,
  `CycleFrom5Value` varchar(35) DEFAULT NULL,
  `CycleDate5Value` varchar(35) DEFAULT NULL,
  `LangName1Value` varchar(35) DEFAULT NULL,
  `ReadExcellent1Value` varchar(1) DEFAULT NULL,
  `ReadGood1Value` varchar(1) DEFAULT NULL,
  `ReadMoyen1Value` varchar(1) DEFAULT NULL,
  `ReadUnderMoyen1Value` varchar(1) DEFAULT NULL,
  `WriteExcellent1Value` varchar(1) DEFAULT NULL,
  `WriteGood1Value` varchar(1) DEFAULT NULL,
  `WriteMoyen1Value` varchar(1) DEFAULT NULL,
  `WriteUnderMoyen1Value` varchar(1) DEFAULT NULL,
  `SpeakExcellent1Value` varchar(1) DEFAULT NULL,
  `SpeakGood1Value` varchar(1) DEFAULT NULL,
  `SpeakMoyen1Value` varchar(1) DEFAULT NULL,
  `SpeakUnderMoyen1Value` varchar(1) DEFAULT NULL,
  `LangName2Value` varchar(35) DEFAULT NULL,
  `ReadExcellent2Value` varchar(1) DEFAULT NULL,
  `ReadGood2Value` varchar(1) DEFAULT NULL,
  `ReadMoyen2Value` varchar(1) DEFAULT NULL,
  `ReadUnderMoyen2Value` varchar(1) DEFAULT NULL,
  `WriteGood2Value` varchar(1) DEFAULT NULL,
  `WriteMoyen2Value` varchar(1) DEFAULT NULL,
  `WriteUnderMoyen2Value` varchar(1) DEFAULT NULL,
  `SpeakExcellent2Value` varchar(1) DEFAULT NULL,
  `SpeakGood2Value` varchar(1) DEFAULT NULL,
  `SpeakMoyen2Value` varchar(1) DEFAULT NULL,
  `SpeakUnderMoyen2Value` varchar(35) DEFAULT NULL,
  `LangName3Value` varchar(35) DEFAULT NULL,
  `ReadGood3Value` varchar(1) DEFAULT NULL,
  `ReadMoyen3Value` varchar(1) DEFAULT NULL,
  `ReadUnderMoyen3Value` varchar(1) DEFAULT NULL,
  `WriteExcellent3Value` varchar(1) DEFAULT NULL,
  `WriteGood3Value` varchar(1) DEFAULT NULL,
  `WriteMoyen3Value` varchar(1) DEFAULT NULL,
  `WriteUnderMoyen3Value` varchar(1) DEFAULT NULL,
  `SpeakExcellent3Value` varchar(1) DEFAULT NULL,
  `SpeakGood3Value` varchar(1) DEFAULT NULL,
  `SpeakMoyen3Value` varchar(1) DEFAULT NULL,
  `SpeakUnderMoyen3Value` varchar(1) DEFAULT NULL,
  `DontKnowValue` varchar(1) DEFAULT NULL,
  `DriverValue` varchar(1) DEFAULT NULL,
  `SupportValue` varchar(1) DEFAULT NULL,
  `ProgramerValue` varchar(1) DEFAULT NULL,
  `OtherExperienceValue` varchar(50) DEFAULT NULL,
  `CompName1Value` varchar(35) DEFAULT NULL,
  `ConctactMethode1Value` varchar(35) DEFAULT NULL,
  `FromDate1Value` varchar(35) DEFAULT NULL,
  `ToDate1Value` varchar(35) DEFAULT NULL,
  `OldJob1Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary1Value` varchar(35) DEFAULT NULL,
  `WhyLeft1Value` varchar(35) DEFAULT NULL,
  `CompName2Value` varchar(35) DEFAULT NULL,
  `ConctactMethode2Value` varchar(35) DEFAULT NULL,
  `FromDate2Value` varchar(35) DEFAULT NULL,
  `ToDate2Value` varchar(35) DEFAULT NULL,
  `OldJob2Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary2Value` varchar(35) DEFAULT NULL,
  `WhyLeft2Value` varchar(35) DEFAULT NULL,
  `CompName3Value` varchar(35) DEFAULT NULL,
  `ConctactMethode3Value` varchar(35) DEFAULT NULL,
  `FromDate3Value` varchar(35) DEFAULT NULL,
  `ToDate3Value` varchar(35) DEFAULT NULL,
  `OldJob3Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary3Value` varchar(35) DEFAULT NULL,
  `WhyLeft3Value` varchar(35) DEFAULT NULL,
  `CompName4Value` varchar(35) DEFAULT NULL,
  `ConctactMethode4Value` varchar(35) DEFAULT NULL,
  `FromDate4Value` varchar(35) DEFAULT NULL,
  `ToDate4Value` varchar(35) DEFAULT NULL,
  `OldJob4Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary4Value` varchar(35) DEFAULT NULL,
  `WhyLeft4Value` varchar(35) DEFAULT NULL,
  `CompName5Value` varchar(35) DEFAULT NULL,
  `ConctactMethode5Value` varchar(35) DEFAULT NULL,
  `FromDate5Value` varchar(35) DEFAULT NULL,
  `ToDate5Value` varchar(35) DEFAULT NULL,
  `OldJob5Value` varchar(35) DEFAULT NULL,
  `LastMonthSalary5Value` varchar(35) DEFAULT NULL,
  `WhyLeft5Value` varchar(35) DEFAULT NULL,
  `MustExcutingInOldJobsValue` varchar(100) DEFAULT NULL,
  `DiduDoAnotherJobsOverTimeValue` varchar(35) DEFAULT NULL,
  `DoYouRejectWorkOverTimeYesValue` varchar(1) DEFAULT NULL,
  `DoYouRejectWorkOverTimeNoValue` varchar(1) DEFAULT NULL,
  `DoYouRejectCallingOldJobValue` varchar(35) DEFAULT NULL,
  `HowDoYouHearAboutUsValue` varchar(35) DEFAULT NULL,
  `WhyYouWantToJoinValue` varchar(35) DEFAULT NULL,
  `WhatJobYouWichValue` varchar(35) DEFAULT NULL,
  `WhenUCanStartValue` varchar(35) DEFAULT NULL,
  `WishedSalaryValue` varchar(35) DEFAULT NULL,
  `TalkAboutSkillsInThisJobValue` varchar(50) DEFAULT NULL,
  `DidYouSendUsAnCVYesValue` varchar(1) DEFAULT NULL,
  `DidYouSendUsAnCVNoValue` varchar(1) DEFAULT NULL,
  `ifYesWriteCVNumberHereValue` varchar(35) DEFAULT NULL,
  `DoYouHaveNearbyInTheCompanyValue` varchar(50) DEFAULT NULL,
  `OutName1Value` varchar(35) DEFAULT NULL,
  `OutContact1Value` varchar(35) DEFAULT NULL,
  `OutJobDesc1Value` varchar(35) DEFAULT NULL,
  `OutName2Value` varchar(35) DEFAULT NULL,
  `OutContact2Value` varchar(35) DEFAULT NULL,
  `OutJobDesc2Value` varchar(35) DEFAULT NULL,
  `OutName3Value` varchar(35) DEFAULT NULL,
  `OutContact3Value` varchar(35) DEFAULT NULL,
  `OutJobDesc3Value` varchar(35) DEFAULT NULL,
  `TrueInfoValue` varchar(35) DEFAULT NULL,
  `WriteExcellent2Value` varchar(1) NOT NULL,
  `ReadExcellent3Value` varchar(1) NOT NULL,
  PRIMARY KEY (`CvId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `ThemName` varchar(7) NOT NULL COMMENT 'اسم الشكل',
  PRIMARY KEY (`IdCat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `catlang`
--

CREATE TABLE IF NOT EXISTS `catlang` (
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `CatName` varchar(50) NOT NULL COMMENT 'اسم المجموعة',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل نوع الخير محذوف',
  `sort` tinyint(1) NOT NULL COMMENT 'ترتيب المجموعة من فوق لتحت',
  PRIMARY KEY (`IdCat`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catlang`
--

INSERT INTO `catlang` (`IdCat`, `IdLang`, `CatName`, `Deleted`, `sort`) VALUES
('20100000000', '20070000001', 'أخبار عامة', '', 0),
('20140000000', '20120000001', 'عامة لكل الناس hg', '1', 0),
('20140000001', '20120000001', 'عامة', '0', 0),
('20140000002', '20120000001', 'لن تظهر', '1', 0),
('20140000002', '20130000001', 'لن تظهر', '1', 0),
('20140000003', '20120000001', 'adasdsad', '1', 0),
('20140000004', '20120000001', 'adasdsad', '1', 0),
('20140000001', '20140000001', 'ddd', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cclang`
--

CREATE TABLE IF NOT EXISTS `cclang` (
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `Contry` varchar(50) NOT NULL COMMENT 'اسم البلد',
  `Langcc` varchar(10) NOT NULL COMMENT 'لغة البلد',
  `rank` bigint(11) NOT NULL,
  `ccode` int(5) NOT NULL,
  PRIMARY KEY (`cc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لغة البلدان على اساس كود البلد';

--
-- Dumping data for table `cclang`
--

INSERT INTO `cclang` (`cc`, `Contry`, `Langcc`, `rank`, `ccode`) VALUES
('AF', 'Afghanistan (افغانستان)', 'English', 1, 93),
('AL', 'Albania (Shqipëria)', 'English', 1, 355),
('DZ', 'Algeria (الجمهورية الجزائرية)', 'Arabic', 1, 213),
('AS', 'American Samoa', 'English', 1, 684),
('AD', 'Andorra', 'English', 1, 376),
('AO', 'Angola', 'English', 1, 244),
('AI', 'Anguilla', 'English', 1, 1264),
('AQ', 'Antarctica', 'English', 1, 672),
('AG', 'Antigua and Barbuda', 'English', 1, 1268),
('AR', 'Argentina', 'English', 1, 54),
('AM', 'Armenia ( Հայաստանի Հանրապետություն )', 'English', 1, 374),
('AW', 'Aruba', 'English', 1, 297),
('AP', 'Asia/Pacific Region', 'English', 1, 0),
('AU', 'Australia', 'English', 1, 61),
('AT', 'Austria (?sterreich)', 'English', 1, 43),
('AZ', 'Azerbaijan (Az?rbaycan)', 'English', 1, 994),
('BS', 'Bahamas', 'English', 1, 1242),
('BH', 'Bahrain (بحرين)', 'Arabic', 1, 973),
('BD', 'Bangladesh  ( গণপ্রজাতন্ত্রী বাংলাদেশ )', 'English', 1, 880),
('BB', 'Barbados', 'English', 1, 1246),
('BY', 'Belarus ( Рэспубліка Беларусь )', 'English', 1, 375),
('BE', 'Belgium (België)', 'English', 1, 32),
('BZ', 'Belize', 'English', 1, 501),
('BJ', 'Benin (Bénin)', 'English', 1, 229),
('BM', 'Bermuda', 'English', 1, 1441),
('BT', 'Bhutan ( འབྲུག་རྒྱལ་ཁབ་ )', 'English', 1, 975),
('BO', 'Bolivia', 'English', 1, 591),
('BA', 'Bosnia and Herzegovina (Bosna i Hercegovina)', 'English', 1, 387),
('BW', 'Botswana', 'English', 1, 267),
('BR', 'Brazil (Brasil)', 'English', 1, 55),
('IO', 'British Indian Ocean Territory', 'English', 1, 246),
('BN', 'Brunei (Brunei Darussalam)', 'English', 1, 673),
('BG', 'Bulgaria ( Република България )', 'English', 1, 359),
('BF', 'Burkina Faso', 'English', 1, 226),
('BI', 'Burundi (Uburundi)', 'English', 1, 257),
('KH', 'Cambodia (Kampuchea)', 'English', 1, 855),
('CM', 'Cameroon (Cameroun)', 'English', 1, 237),
('CA', 'Canada', 'English', 1, 1),
('CV', 'Cape Verde (Cabo Verde)', 'English', 1, 238),
('KY', 'Cayman Islands', 'English', 1, 1345),
('CF', 'Central African Republic (République Centrafricain', 'English', 1, 236),
('TD', 'Chad (Tchad)', 'English', 1, 235),
('CL', 'Chile', 'English', 1, 56),
('CN', 'China ( 中华人民共和国 )', 'English', 1, 86),
('CO', 'Colombia', 'English', 1, 57),
('KM', 'Comoros (Comores)', 'English', 1, 269),
('CG', 'Congo', 'English', 1, 242),
('CD', 'Congo, The Democratic Republic of the', 'English', 1, 243),
('CK', 'Cook Islands', 'English', 1, 682),
('CR', 'Costa Rica', 'English', 1, 506),
('CI', 'Côte D''Ivoire', 'English', 1, 225),
('HR', 'Croatia (Hrvatska)', 'English', 1, 385),
('CU', 'Cuba', 'English', 1, 53),
('CY', 'Cyprus ( Κυπριακή Δημοκρατία )', 'English', 1, 357),
('CZ', 'Czech Republic (?esko)', 'English', 1, 420),
('DK', 'Denmark (Danmark)', 'English', 1, 45),
('DJ', 'Djibouti', 'English', 1, 253),
('DM', 'Dominica', 'English', 1, 1767),
('DO', 'Dominican Republic', 'English', 1, 809),
('EC', 'Ecuador', 'English', 1, 593),
('EG', 'Egypt (مصر)', 'Arabic', 1, 20),
('SV', 'El Salvador', 'English', 1, 503),
('GQ', 'Equatorial Guinea (Guinea Ecuatorial)', 'English', 1, 240),
('ER', 'Eritrea (Ertra)', 'English', 1, 291),
('EE', 'Estonia (Eesti)', 'English', 1, 372),
('ET', 'Ethiopia ( ye-Ītyōṗṗyā )', 'English', 1, 251),
('EU', 'Europe', 'English', 1, 0),
('FK', 'Falkland Islands (Malvinas)', 'English', 1, 500),
('FO', 'Faroe Islands', 'English', 1, 298),
('FJ', 'Fiji', 'English', 1, 679),
('FI', 'Finland (Suomi)', 'English', 1, 358),
('FR', 'France', 'English', 1, 33),
('GF', 'French Guiana', 'English', 1, 594),
('PF', 'French Polynesia', 'English', 1, 689),
('GA', 'Gabon', 'English', 1, 241),
('GM', 'Gambia', 'English', 1, 220),
('GE', 'Georgia ( საქართველო )', 'English', 1, 995),
('DE', 'Germany (Deutschland)', 'English', 1, 49),
('GH', 'Ghana', 'English', 1, 233),
('GI', 'Gibraltar', 'English', 1, 350),
('GR', 'Greece ( Ελληνική Δημοκρατία )', 'English', 1, 30),
('GL', 'Greenland', 'English', 1, 299),
('GD', 'Grenada', 'English', 1, 1473),
('GP', 'Guadeloupe', 'English', 1, 590),
('GU', 'Guam', 'English', 1, 1671),
('GT', 'Guatemala', 'English', 1, 502),
('GN', 'Guinea (Guinée)', 'English', 1, 224),
('GW', 'Guinea-Bissau (Guiné-Bissau)', 'English', 1, 245),
('GY', 'Guyana', 'English', 1, 592),
('HT', 'Haiti (Haïti)', 'English', 1, 509),
('VA', 'Holy See (Vatican City State)', 'English', 1, 39),
('HN', 'Honduras', 'English', 1, 504),
('HK', 'Hong Kong', 'English', 1, 852),
('HU', 'Hungary (Magyarorsz?g)', 'English', 1, 36),
('IS', 'Iceland (?sland)', 'English', 1, 354),
('IN', 'India', 'English', 1, 91),
('ID', 'Indonesia', 'English', 1, 62),
('IR', 'Iran,  (الجمهورية الاسلامية في ايران)', 'Arabic', 1, 98),
('IQ', 'Iraq (العراق)', 'Arabic', 1, 964),
('IE', 'Ireland', 'English', 1, 353),
('IL', 'Other', 'English', 1, 972),
('IT', 'Italy (Italia)', 'English', 1, 39),
('JM', 'Jamaica', 'English', 1, 1876),
('JP', 'Japan', 'English', 1, 81),
('JO', 'Jordan (الأردن)', 'Arabic', 1, 962),
('KZ', 'Kazakhstan ( قازاقستان )', 'English', 1, 7),
('KE', 'Kenya', 'English', 1, 254),
('KI', 'Kiribati', 'English', 1, 686),
('EH', 'Western Sahara (صحراوية)', 'English', 1, 212),
('KR', 'South Korea (??)', 'English', 1, 82),
('KW', 'Kuwait (الكويت)', 'Arabic', 1, 965),
('KG', 'Kyrgyzstan ( Кыргыз Республикасы )', 'English', 1, 996),
('LA', 'Lao People''s Democratic Republic ( ສາທາລະນະລັດປະຊາ', 'English', 1, 856),
('LV', 'Latvia (Latvija)', 'English', 1, 371),
('LB', 'Lebanon (لبنان)', 'Arabic', 1, 961),
('LS', 'Lesotho', 'English', 1, 266),
('LR', 'Liberia', 'English', 1, 231),
('LY', 'Libyan Arab Jamahiriya (ليبيا)', 'Arabic', 1, 218),
('LI', 'Liechtenstein', 'English', 1, 423),
('LT', 'Lithuania (Lietuva)', 'English', 1, 370),
('LU', 'Luxembourg (Lëtzebuerg)', 'English', 1, 352),
('MO', 'Macau', 'English', 1, 853),
('MK', 'Macedonia ( Република Македонија )', 'English', 1, 389),
('MG', 'Madagascar (Madagasikara)', 'English', 1, 261),
('MW', 'Malawi', 'English', 1, 265),
('MY', 'Malaysia', 'English', 1, 60),
('MV', 'Maldives ( ދިވެހިރާއްޖޭގެ ޖުމްހޫރިއްޔާ )', 'English', 1, 960),
('ML', 'Mali', 'English', 1, 223),
('MT', 'Malta', 'English', 1, 356),
('MH', 'Marshall Islands', 'English', 1, 692),
('MQ', 'Martinique', 'English', 1, 596),
('MR', 'Mauritania (موريتانية)', 'Arabic', 1, 222),
('MU', 'Mauritius', 'English', 1, 230),
('YT', 'Mayotte', 'English', 1, 269),
('MX', 'Mexico (México)', 'English', 1, 52),
('FM', 'Micronesia, Federated States of', 'English', 1, 691),
('MD', 'Moldova, Republic of', 'English', 1, 373),
('MC', 'Monaco', 'English', 1, 377),
('MN', 'Mongolia ( Монгол улс )', 'English', 1, 976),
('ME', 'Montenegro ( Црна Гора )', 'English', 1, 382),
('MS', 'Montserrat', 'English', 1, 1664),
('MA', 'Morocco (المغرب)', 'Arabic', 1, 212),
('MZ', 'Mozambique (Moçambique)', 'English', 1, 258),
('MM', 'Myanmar ( Pyidaunzu Thanmăda Myăma Nainngandaw)', 'English', 1, 95),
('NA', 'Namibia', 'English', 1, 264),
('NR', 'Nauru (Naoero)', 'English', 1, 674),
('NP', 'Nepal (  सङ्घीय लोकतान्त्रिक गणतन्त्र नेपाल )', 'English', 1, 977),
('NL', 'Netherlands (Nederland)', 'English', 1, 31),
('AN', 'Netherlands Antilles', 'English', 1, 599),
('NC', 'New Caledonia', 'English', 1, 687),
('NZ', 'New Zealand', 'English', 1, 64),
('NI', 'Nicaragua', 'English', 1, 505),
('NE', 'Niger', 'English', 1, 227),
('NG', 'Nigeria', 'English', 1, 234),
('NU', 'Niue', 'English', 1, 683),
('NF', 'Norfolk Island', 'English', 1, 672),
('MP', 'Northern Mariana Islands', 'English', 1, 670),
('NO', 'Norway (Norge)', 'English', 1, 47),
('OM', 'Oman (عمان)', 'Arabic', 1, 968),
('PK', 'Pakistan (پاکستان)', 'English', 1, 92),
('PW', 'Palau', 'English', 1, 680),
('PS', 'Other', 'English', 1, 0),
('PA', 'Panama ( República de Panamá )', 'English', 1, 507),
('PG', 'Papua New Guinea', 'English', 1, 675),
('PY', 'Paraguay', 'English', 1, 595),
('PE', 'Peru (Per?)', 'English', 1, 51),
('PH', 'Philippines (Pilipinas)', 'English', 1, 63),
('PL', 'Poland (Polska)', 'English', 1, 48),
('PT', 'Portugal', 'English', 1, 351),
('PR', 'Puerto Rico', 'English', 1, 1787),
('QA', 'Qatar (قطر)', 'Arabic', 1, 974),
('RE', 'Reunion', 'English', 1, 262),
('RO', 'Romania (România)', 'English', 1, 40),
('RU', 'Russia ( Российская Федерация )', 'English', 1, 7),
('RW', 'Rwanda', 'English', 1, 250),
('KN', 'Saint Kitts and Nevis', 'English', 1, 1869),
('LC', 'Saint Lucia', 'English', 1, 1758),
('VC', 'Saint Vincent and the Grenadines', 'English', 1, 1784),
('WS', 'Samoa', 'English', 1, 684),
('SM', 'San Marino', 'English', 1, 378),
('ST', 'Sao Tome and Principe', 'English', 1, 239),
('SA', 'Saudi Arabia (المملكة العربية السعودية)', 'Arabic', 1, 966),
('SN', 'Senegal (Sénégal)', 'English', 1, 221),
('RS', 'Serbia ( Република Србија )', 'English', 1, 381),
('SC', 'Seychelles', 'English', 1, 248),
('SL', 'Sierra Leone', 'English', 1, 232),
('SG', 'Singapore (Singapura)', 'English', 1, 65),
('SK', 'Slovakia (Slovensko)', 'English', 1, 421),
('SI', 'Slovenia (Slovenija)', 'English', 1, 386),
('SB', 'Solomon Islands', 'English', 1, 677),
('SO', 'Somalia (Soomaaliya)', 'English', 1, 252),
('ZA', 'South Africa', 'English', 1, 27),
('ES', 'Spain ( Reino de España )', 'English', 1, 34),
('LK', 'Sri Lanka', 'English', 1, 94),
('SD', 'Sudan (السودان)', 'Arabic', 1, 249),
('SR', 'Suriname', 'English', 1, 597),
('SZ', 'Swaziland', 'English', 1, 268),
('SE', 'Sweden (Sverige)', 'English', 1, 46),
('CH', 'Switzerland (Schweiz)', 'English', 1, 41),
('SY', 'Syria (سورية)', 'Arabic', 1, 963),
('TW', 'Taiwan ( 中華民國 )', 'English', 1, 886),
('TJ', 'Tajikistan ( Ҷумҳурии Тоҷикистон )', 'English', 1, 992),
('TZ', 'Tanzania, United Republic of', 'English', 1, 255),
('TH', 'Thailand ( ราชอาณาจักรไทย )', 'English', 1, 66),
('TG', 'Togo', 'English', 1, 228),
('TK', 'Tokelau', 'English', 1, 690),
('TO', 'Tonga', 'English', 1, 676),
('TT', 'Trinidad and Tobago', 'English', 1, 1868),
('TN', 'Tunisia (تونس)', 'Arabic', 1, 216),
('TR', 'Turkey (Türkiye)', 'English', 1, 90),
('TM', 'Turkmenistan (Türkmenistan)', 'English', 1, 993),
('TC', 'Turks and Caicos Islands', 'English', 1, 1649),
('TV', 'Tuvalu', 'English', 1, 688),
('UG', 'Uganda', 'English', 1, 256),
('UA', 'Ukraine ( Україна )', 'English', 1, 380),
('AE', 'United Arab Emirates (الإمارات العربية المتحدة)', 'English', 1, 971),
('GB', 'United Kingdom', 'English', 1, 44),
('US', 'United States', 'English', 1, 1),
('UM', 'United States Minor Outlying Islands', 'English', 1, 1684),
('UY', 'Uruguay', 'English', 1, 598),
('UZ', 'Uzbekistan ( Ўзбекистон Республикаси )', 'English', 1, 998),
('VU', 'Vanuatu', 'English', 1, 678),
('VE', 'Venezuela', 'English', 1, 58),
('VN', 'Vietnam ( Cộng hòa xã hội chủ nghĩa Việt Nam )', 'English', 1, 84),
('VG', 'Virgin Islands, British', 'English', 1, 1284),
('VI', 'Virgin Islands, U.S.', 'English', 1, 1340),
('YE', 'Yemen (اليمن)', 'Arabic', 1, 967),
('ZM', 'Zambia', 'English', 1, 260),
('ZW', 'Zimbabwe', 'English', 1, 263),
('TL', 'East Timor (Timor-Leste)', 'English', 1, 670),
('KP', 'North Korea ( 조선민주주의인민공화국 )', 'English', 1, 850),
('XX', 'UnKnow', 'English', 318, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE IF NOT EXISTS `contactus` (
  `IdDep` varchar(11) NOT NULL,
  `DepEmail` varchar(50) NOT NULL,
  PRIMARY KEY (`IdDep`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`IdDep`, `DepEmail`) VALUES
('20120000000', 'aefs@sadsad.com'),
('20130000000', 'sales@jabersweets.com');

-- --------------------------------------------------------

--
-- Table structure for table `contactuslang`
--

CREATE TABLE IF NOT EXISTS `contactuslang` (
  `IdDep` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `DepName` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactuslang`
--

INSERT INTO `contactuslang` (`IdDep`, `IdLang`, `DepName`) VALUES
('20120000000', '20120000000', 'sdadsa'),
('20120000000', '20120000001', 'شسيسشي'),
('20120000000', '20120000002', 'sdsd'),
('20130000000', '20120000001', 'المبيعات'),
('20130000000', '20130000000', 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `errlog`
--

CREATE TABLE IF NOT EXISTS `errlog` (
  `IdErr` double NOT NULL AUTO_INCREMENT COMMENT 'رقم الجدول',
  `errno` double NOT NULL COMMENT 'رقم الخطأ',
  `errmsg` longtext NOT NULL COMMENT 'رسالة الخطأ',
  `filename` longtext NOT NULL COMMENT 'اسم الملف',
  `linenum` double NOT NULL COMMENT 'رقم السطر',
  `DateErr` datetime NOT NULL COMMENT 'تاريخ الخطأ',
  PRIMARY KEY (`IdErr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول اخطاء البرنامج' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `errpages`
--

CREATE TABLE IF NOT EXISTS `errpages` (
  `ErrNumber` varchar(4) NOT NULL COMMENT 'رقم صفحة الخطأ',
  `ErrPage` longtext NOT NULL COMMENT 'صفحة الخطأ',
  PRIMARY KEY (`ErrNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='أخطاء المستخدم في طلب الموقع';

--
-- Dumping data for table `errpages`
--

INSERT INTO `errpages` (`ErrNumber`, `ErrPage`) VALUES
('400', '<div align="center"><font size="7">400&nbsp;</font></div>'),
('401', '<div align="center"><font size="7">401</font></div>'),
('403', '<div align="center"><font size="7">403</font></div>'),
('404', '<div align="center"><font size="7">404</font> <br /></div>'),
('500', '<div align="center"><font size="7">500</font></div>');

-- --------------------------------------------------------

--
-- Table structure for table `externallinks`
--

CREATE TABLE IF NOT EXISTS `externallinks` (
  `Id` varchar(11) NOT NULL COMMENT 'رقم اللنك',
  `Link` text NOT NULL COMMENT 'عنوان اللنك',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الروابط الخارجية';

--
-- Dumping data for table `externallinks`
--

INSERT INTO `externallinks` (`Id`, `Link`) VALUES
('20120000000', 'http://google.com\\'),
('20140000000', 'http://localhost/phptransformer//uploads/gallery/Alb'),
('20140000001', 'http://localhost/phptransformer/Prog-exlink_Id-20140000000_Lang-Arabic_nl-1.pt'),
('20140000002', 'http://www.google.com\\');

-- --------------------------------------------------------

--
-- Table structure for table `floodprotection`
--

CREATE TABLE IF NOT EXISTS `floodprotection` (
  `IP` varchar(32) NOT NULL COMMENT 'رقم ايبي المسجل للفلود',
  `TIME` varchar(22) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL COMMENT 'الوقت للفلود'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='من اجل الحماية من اللب الزائد على';

--
-- Dumping data for table `floodprotection`
--

INSERT INTO `floodprotection` (`IP`, `TIME`) VALUES
(' 127.0.0.1', '1404381449.4153');

-- --------------------------------------------------------

--
-- Table structure for table `fomacodataorder`
--

CREATE TABLE IF NOT EXISTS `fomacodataorder` (
  `IdData` varchar(11) DEFAULT NULL,
  `IdOrder` varchar(11) DEFAULT NULL,
  `lineNumber` varchar(3) DEFAULT NULL,
  `ItemType` varchar(11) DEFAULT NULL,
  `Description` varchar(128) DEFAULT NULL,
  `Height` varchar(3) DEFAULT NULL,
  `Width` varchar(3) DEFAULT NULL,
  `Lenght` varchar(3) DEFAULT NULL,
  `Quantity` varchar(6) DEFAULT NULL,
  `Cubic` varchar(15) DEFAULT NULL,
  `DataGridNote` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomacodataorder`
--

INSERT INTO `fomacodataorder` (`IdData`, `IdOrder`, `lineNumber`, `ItemType`, `Description`, `Height`, `Width`, `Lenght`, `Quantity`, `Cubic`, `DataGridNote`) VALUES
('20080000000', '20080000000', '1', '**EX', 'لوح إسفنج', '2', '120', '200', '2', '4.8', '1'),
('20080000001', '20080000000', '2', '*EXS', 'لوح إسفنج', '3', '60', '60', '3', '6.42', '2'),
('20080000002', '20080000000', '3', 'SL42', 'فراش إسفنج', '12', '120', '200', '5', '78.42', '3'),
('20080000003', '20080000000', '4', 'X01*', 'فراش إسفنج', '50', '50', '50', '6', '115.92', '4'),
('20080000004', '20080000000', '5', 'BBS*', 'فراش إسفنج', '40', '40', '120', '55', '643.92', '5'),
('20080000005', '20080000000', '6', 'X01*', 'فراش إسفنج', '56', '55', '56', '22', '833.648', '6'),
('20080000006', '20080000000', '7', '*EXS', 'لوح إسفنج', '2', '22', '22', '2', '833.745', '7'),
('20080000007', '20080000000', '8', 'BB25', 'لوح إسفنج', '3', '3', '3', '3', '833.749', '3'),
('20080000008', '20080000000', '9', '**EX', 'لوح إسفنج', '3', '3', '3', '3', '833.753', '3'),
('20080000009', '20080000000', '10', '*EXS', 'لوح إسفنج', '3', '3', '3', '3', '833.757', '3'),
('20080000010', '20080000000', '11', '**EX', 'فراش إسفنج', '33', '33', '33', '25', '878.678', '3'),
('20080000011', '20080000000', '12', 'SL42', 'لوح إسفنج', '3', '3', '3', '33', '878.723', '3'),
('20080000012', '20080000003', '1', '**EX', 'لوح إسفنج', '2', '20', '120', '2', '0.48', ''),
('20120000000', '20120000000', '1', 'C20*', 'بلوك إسفنج', '15', '120', '100', '2', '240', 'شسيسشي'),
('20120000001', '20120000000', '2', 'X01*', 'بلوك إسفنج', '20', '100', '100', '3', '270', 'ىﻻرى');

-- --------------------------------------------------------

--
-- Table structure for table `fomacodesc`
--

CREATE TABLE IF NOT EXISTS `fomacodesc` (
  `Descid` varchar(11) DEFAULT NULL,
  `TheDesc` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomacodesc`
--

INSERT INTO `fomacodesc` (`Descid`, `TheDesc`) VALUES
('20080000001', 'لوح إسفنج'),
('20080000002', 'مقعد صوفة'),
('20080000003', 'مسند كونيك'),
('20080000004', 'فراش إسفنج'),
('20080000005', 'وسادة إسفنج'),
('20080000006', 'طراحة إسفنج'),
('20080000007', 'تكاية لإسفنج'),
('20080000008', 'بلوك إسفنج'),
('20080000009', 'ستوك إسفنج'),
('20080000010', 'جلود لإسفنج'),
('20080000011', 'نثر إسفنج'),
('20080000012', 'طراحة زاوية'),
('20080000013', 'مسند زاوية'),
('20080000014', 'مسند صوفة'),
('20080000015', 'وسادة إسطوانية 15 سنتم'),
('20080000016', 'وسادة إسطوانية 20 سنتم');

-- --------------------------------------------------------

--
-- Table structure for table `fomacoheaderorder`
--

CREATE TABLE IF NOT EXISTS `fomacoheaderorder` (
  `IdOrder` varchar(11) DEFAULT NULL,
  `Ordernumber` varchar(11) DEFAULT NULL,
  `ClientName` varchar(15) DEFAULT NULL,
  `DeliveryTo` varchar(35) DEFAULT NULL,
  `ChipAddress` varchar(35) DEFAULT NULL,
  `Organizer` varchar(15) DEFAULT NULL,
  `HeaderNotes` varchar(1024) DEFAULT NULL,
  `CurrentDate` datetime DEFAULT NULL,
  `DeliveryDate` datetime DEFAULT NULL,
  `IsPosted` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomacoheaderorder`
--

INSERT INTO `fomacoheaderorder` (`IdOrder`, `Ordernumber`, `ClientName`, `DeliveryTo`, `ChipAddress`, `Organizer`, `HeaderNotes`, `CurrentDate`, `DeliveryDate`, `IsPosted`) VALUES
('20080000000', '', 'fomaco', 'هيثم بزي', 'المعمورة', 'محسن الموسوي', 'نرجو تسليم الطلبية حسب الوقت المحدد', '2008-02-09 03:12:48', '2008-02-10 03:01:26', '1'),
('20080000001', '', 'fomaco', 'هيثم بزي', 'شسيش', 'شسيشسي', 'سيشسي', '2008-02-09 04:11:09', '2008-02-09 04:02:28', '1'),
('20080000002', '', 'fomaco', 'عبدو', 'الشياح', 'لؤي', 'حلو عنا', '2008-02-09 04:55:49', '2008-02-10 04:51:53', '1'),
('20080000003', '', 'admin', 'sdfdf', 'sdf', 'sdfdsf', 'sdf', '2008-11-27 10:34:09', '2008-11-28 00:00:00', '1'),
('20120000000', '', 'Guest', 'صثصثق', 'بيسب', '', 'سيب', '2010-11-25 14:51:20', '2012-02-25 00:00:00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `fomacoitems`
--

CREATE TABLE IF NOT EXISTS `fomacoitems` (
  `ItmeId` varchar(11) DEFAULT NULL,
  `ItemCode` varchar(35) DEFAULT NULL,
  `ItmeText` varchar(128) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomacoitems`
--

INSERT INTO `fomacoitems` (`ItmeId`, `ItemCode`, `ItmeText`) VALUES
('20080000001', '**EX', 'EX إسفنج أسمر ضغط 36'),
('20080000002', '*EXS', 'EXS إسفنج أسمر طري ضغط 36'),
('20080000003', 'SL42', 'SL إسفنج أسمر ضغط 42'),
('20080000004', 'X01*', 'X إسفنج أبيض ضغط 16'),
('20080000005', 'BBS*', 'BBS إسفنج أسمر ضغط 25'),
('20080000006', 'X03*', 'X إسفنج أبيض ضغط 16 طول 200'),
('20080000007', 'X04*', 'X إسفنج أسمر ضغط 16 طول 200'),
('20080000008', 'AS**', 'AS إسفنج أسمر ضغط 32'),
('20080000009', 'X02*', 'X إسفنج أسمر ضغط 16'),
('20080000010', 'C18*', 'C إسفنج أسمر ضغط 18'),
('20080000011', 'C20*', 'C إسفنج أسمر ضغط 20'),
('20080000012', 'C22*', 'C إسفنج أسمر ضغط 22'),
('20080000013', 'BB25', 'BB إسفنج أسمر ضغط 25'),
('20080000014', 'SF**', 'SF إسفنج زهر ضغط 26'),
('20080000015', 'B28*', 'B إسفنج أسمر ضغط 28'),
('20080000016', 'BS**', 'BS إسفنج أسمر طري ضغط 28');

-- --------------------------------------------------------

--
-- Table structure for table `fomaconakdi`
--

CREATE TABLE IF NOT EXISTS `fomaconakdi` (
  `IDNakdi` varchar(11) NOT NULL COMMENT 'الرقم',
  `IDFacture` varchar(11) NOT NULL,
  `Date` datetime NOT NULL COMMENT 'تاريخ الادخال',
  `FactureDate` date NOT NULL COMMENT 'تاريخ الفاتورة',
  `Zaboun` varchar(60) NOT NULL COMMENT 'اسم الزبون',
  `NakdiName` varchar(60) NOT NULL COMMENT 'اسمه الوهمي',
  `Mandoub` varchar(60) NOT NULL COMMENT 'مندوبه',
  `Debit` double NOT NULL COMMENT 'مدين',
  `Credit` double NOT NULL COMMENT 'دائن',
  `Mashrou3` varchar(60) NOT NULL COMMENT 'المشروع',
  `HasPayed` tinyint(1) NOT NULL COMMENT 'تم قبضها',
  `HasMailed` tinyint(1) NOT NULL COMMENT 'تم ارسالها بالبريد',
  `Note` text NOT NULL COMMENT 'ملاحظات',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم الذي ادخل المعلومة',
  `LastUserId` varchar(11) NOT NULL,
  `paydate` datetime NOT NULL COMMENT 'تاريخ الدفع',
  PRIMARY KEY (`IDNakdi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fomaconakdi`
--

INSERT INTO `fomaconakdi` (`IDNakdi`, `IDFacture`, `Date`, `FactureDate`, `Zaboun`, `NakdiName`, `Mandoub`, `Debit`, `Credit`, `Mashrou3`, `HasPayed`, `HasMailed`, `Note`, `UserId`, `LastUserId`, `paydate`) VALUES
('20110001138', '616518', '2011-06-11 08:35:38', '2011-06-09', 'حكمت الجمعة', 'خالد جمعة', 'م. حكمت', 368, 368, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001137', '616520', '2011-06-11 08:35:13', '2011-06-09', 'حكمت الجمعة', 'سلوم ياسين', 'م. حكمت', 201, 201, 'Mattat', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001135', '616507', '2011-06-10 10:15:06', '2011-06-09', 'برنس', 'محمد درويش', 'م.برنس', 343, 343, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001193', '616614', '2011-06-24 09:12:33', '2011-06-14', 'ابو عبدو', 'ماجد عبدوني', 'م. أبو عبدو', 250, 250, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001132', '616481', '2011-06-10 12:58:14', '2011-06-08', 'أبو عبدو', 'أحمد بحمد', 'م. أبو عبدو', 626, 626, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001130', '616479', '2011-06-22 10:09:19', '2011-06-08', 'شركة سنتر بو جخ', 'زهير ميتا', 'م. ديب ابو جخ', 4166, 4166, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001129', '616478', '2011-06-10 10:11:47', '2011-06-08', 'المحل', 'غسان القاق', 'م. طلال', 367, 367, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001128', '616477', '2011-06-10 10:09:49', '2011-06-08', 'المحل', 'سعيدالجمال', 'م. طلال', 659, 659, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001127', '616476', '2011-06-10 10:18:30', '2011-06-08', 'عدنان علي مظلوم', 'ناجي ابو اسماعيل', 'م.الحاج عدنان', 190, 190, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001195', '616624', '2011-06-20 10:33:21', '2011-06-15', 'المحل', 'احمد حمدان', 'م. طلال', 695, 695, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001120', '616457', '2011-06-10 10:18:00', '2011-06-07', 'عدنان علي مظلوم', 'عزيزة مظلوم', 'م.الحاج عدنان', 50, 50, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001117', '616452', '2011-06-10 10:02:27', '2011-06-07', 'المحل', 'فارس ابو ديه', 'م. طلال', 931, 931, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001116', '616451', '2011-06-10 10:01:41', '2011-06-07', 'المحل', 'سركيس ملو', 'م. طلال', 809, 809, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001133', '616500', '2011-06-11 12:34:55', '2011-06-09', 'مروان ضاوي', 'ماهر أحمد', 'م. طلال', 1134, 1134, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001115', '616449', '2011-06-10 10:13:19', '2011-06-07', 'المحل', 'عمار عودة', 'م. طلال', 735, 735, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001134', '616506', '2011-06-10 10:18:53', '2011-06-09', 'عدنان علي مظلوم', 'جمال ابو محسن', 'م.الحاج عدنان', 417, 417, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001112', '616385', '2011-06-10 09:54:33', '2011-06-07', 'المحل', 'غالب الموسوي', 'م. طلال', 729, 729, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001136', '616508', '2011-06-10 10:15:32', '2011-06-09', 'البيت الذهبي', 'كاليري لميس', 'م. عامر بو جخ', 110, 110, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001111', '616446', '2011-06-08 12:22:51', '2011-06-07', 'وليد الجناني', 'مروان القادري', 'م.الجناني', 2062, 2062, 'Mattress', 1, 1, 'مرتجع 98$', '20110000005', '', '0000-00-00 00:00:00'),
('20110001110', '616445', '2011-06-08 08:39:24', '2011-06-07', 'سعد ابوعرابي', 'طارق درويش', 'م. سعد', 102, 102, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001109', '616444', '2011-06-10 10:12:59', '2011-06-07', 'المحل', 'نديم سعد', 'م. طلال', 539, 539, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001107', '616447', '2011-06-10 10:13:42', '2011-06-07', 'المحل', 'كامل زيتون', 'م. طلال', 700, 700, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001106', '616448', '2011-06-10 10:14:03', '2011-06-07', 'المحل', 'طلال سمعان', 'م. طلال', 851, 851, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001105', '616442', '2011-06-10 10:12:17', '2011-06-07', 'المحل', 'طانوس شكور', 'م. طلال', 960, 960, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001104', '616440', '2011-06-10 09:55:18', '2011-06-07', 'المحل', 'زاهر الزهر', 'م. طلال', 1256, 1256, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001103', '616432', '2011-06-10 10:00:04', '2011-06-06', 'المحل', 'حسن امهز', 'م. طلال', 143, 143, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001102', '616431', '2011-06-25 09:05:04', '2011-06-06', 'محمد صلاح الدين', 'ربيع الشعار', 'م.طلعت', 166, 166, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001101', '616426', '2011-06-07 09:10:51', '2011-06-06', 'سعد ابوعرابي', 'صلاح العرة', 'م. سعد', 180, 180, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001108', '616443', '2011-06-10 10:00:55', '2011-06-07', 'المحل', 'علي منذر', 'م. طلال', 319, 319, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001100', '616418', '2011-06-09 09:25:44', '2011-06-06', 'المحل', 'بسام الحاج حسن', 'م. طلال', 665, 665, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001099', '616417', '2011-06-08 10:29:16', '2011-06-06', 'المحل', 'عاطف حمية', 'م. طلال', 573, 573, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001098', '616416', '2011-06-08 10:28:49', '2011-06-06', 'المحل', 'نبيل دندش', 'م. طلال', 741, 741, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001097', '616415', '2011-06-08 10:28:23', '2011-06-06', 'المحل', 'ابراهيم جعفر', 'م. طلال', 952, 952, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001096', '616414', '2011-06-10 09:54:55', '2011-06-06', 'المحل', 'جمال الخنسا', 'م. طلال', 990, 990, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001095', '616413', '2011-06-10 09:54:01', '2011-06-06', 'المحل', 'هيثم طليس', 'م. طلال', 101, 101, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001094', '616411', '2011-06-10 10:17:36', '2011-06-06', 'عدنان علي مظلوم', 'نهاد مظلوم', 'م.الحاج عدنان', 238, 238, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001093', '616408', '2011-06-10 10:17:16', '2011-06-06', 'عدنان علي مظلوم', 'سهيل طليس', 'م.الحاج عدنان', 380, 380, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001092', '616430', '2011-06-09 10:42:50', '2011-06-06', 'أبو عبدو', 'عبدو غزالة', 'م. أبو عبدو', 51, 51, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001091', '616412', '2011-06-10 09:23:22', '2011-06-06', 'المحل', 'حسين هزيمة', 'م. طلال', 1294, 1294, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001090', '616409', '2011-06-10 09:22:04', '2011-06-06', 'المحل', 'ظافر حلاق', 'م. طلال', 1320, 1320, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001089', '616410', '2011-06-10 09:22:35', '2011-06-06', 'المحل', 'زاهي حمود', 'م. طلال', 1609, 1609, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001088', '616383', '2011-06-07 09:08:45', '2011-06-04', 'سعد ابوعرابي', 'نواف جبارة', 'م. سعد', 249, 249, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001087', '616381', '2011-06-08 10:35:43', '2011-06-04', 'المحل', 'حسين العزير', 'م. طلال', 348, 348, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001085', '616382', '2011-06-11 08:34:50', '2011-06-04', 'حكمت الجمعة', 'حسان الزهر', 'م. حكمت', 170, 170, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001084', '616377', '2011-06-10 09:21:12', '2011-06-04', 'المحل', 'جاسم قانصو', 'م. طلال', 934, 934, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001082', '616379', '2011-06-08 10:38:40', '2011-06-04', 'المحل', 'عادل عساف', 'م. طلال', 718, 718, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001081', '616376', '2011-06-04 10:22:58', '2011-06-03', 'سعد ابوعرابي', 'جوزف همدر', 'م. سعد', 440, 440, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001080', '616375', '2011-06-04 10:22:34', '2011-06-03', 'سعد ابوعرابي', 'خليل سمعان', 'م. سعد', 138, 138, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001079', '616370', '2011-06-09 10:42:24', '2011-06-03', 'أبو عبدو', 'لؤي شعبان', 'م. أبو عبدو', 10, 10, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001083', '616378', '2011-06-08 10:38:15', '2011-06-04', 'المحل', 'وسام الأمير', 'م. طلال', 827, 827, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001086', '616380', '2011-06-08 10:35:24', '2011-06-04', 'المحل', 'نبيه فقيه', 'م. طلال', 1245, 1245, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001078', '616367', '2011-06-04 10:22:11', '2011-06-03', 'سعد ابوعرابي', 'رشاد زعرور', 'م. سعد', 122, 122, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001077', '616366', '2011-06-25 09:04:33', '2011-06-03', 'محمد صلاح الدين', 'خليل الحشيمي', 'م.طلعت', 211, 211, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001076', '616365', '2011-06-14 12:39:07', '2011-06-03', 'المحل', 'بدري اسماعيل', 'م. طلال', 927, 927, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001074', '616355', '2011-06-08 10:33:39', '2011-06-03', 'المحل', 'يونس يونس', 'م. طلال', 804, 804, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001073', '616354', '2011-06-08 10:31:23', '2011-06-03', 'المحل', 'كمال الجباوي', 'م. طلال', 771, 771, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001072', '616353', '2011-06-08 10:30:54', '2011-06-03', 'المحل', 'وسام حمية', 'م. طلال', 610, 610, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001071', '616351', '2011-06-14 12:38:20', '2011-06-03', 'المحل', 'نجيب صلخ', 'م. طلال', 499, 499, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001070', '616364', '2011-06-08 10:37:53', '2011-06-03', 'المحل', 'تامر حسن', 'م. طلال', 922, 922, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001069', '616363', '2011-06-08 10:36:35', '2011-06-03', 'المحل', 'كامل عباس', 'م. طلال', 967, 967, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001068', '616362', '2011-06-08 10:36:11', '2011-06-03', 'المحل', 'عباس غاوي', 'م. طلال', 993, 993, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001064', '616337', '2011-06-07 09:40:55', '2011-06-02', 'المحل', 'بلال سليمان', 'م. طلال', 1008, 1008, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001121', '616466', '2011-06-09 10:43:12', '2011-06-07', 'ابو عبدو', 'عباس الحلاني', 'م. أبو عبدو', 108, 108, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001119', '616454', '2011-06-11 08:36:08', '2011-06-07', 'المحل', 'شريف البزال', 'م. طلال', 628, 628, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001118', '616453', '2011-06-10 10:09:07', '2011-06-07', 'المحل', 'بدري علو', 'م. طلال', 789, 789, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001062', '616323', '2011-06-07 09:40:08', '2011-06-02', 'المحل', 'خديجة العس', 'م. طلال', 139, 139, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001196', '616625', '2011-06-16 08:53:29', '2011-06-15', 'حكمت الجمعة', 'عباس جمعة', 'م. حكمت', 106, 106, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001060', '616321', '2011-06-07 09:39:29', '2011-06-02', 'المحل', 'سمعان سكاف', 'م. طلال', 580, 580, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001059', '616320', '2011-06-08 10:30:30', '2011-06-02', 'المحل', 'حاتم بزي', 'م. طلال', 102, 102, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001058', '616336', '2011-06-06 09:16:15', '2011-06-02', 'حكمت الجمعة', 'داني شمعون', 'م. حكمت', 1225, 1225, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001056', '616325', '2011-06-08 10:25:58', '2011-06-02', 'محمد غروب', 'محمد سمعان', 'م. طلال', 425, 425, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001055', '616319', '2011-06-08 10:39:16', '2011-06-02', 'المحل', 'زهير بلوق', 'م. طلال', 1760, 1760, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001054', '616316', '2011-06-02 09:03:04', '2011-06-01', 'برنس', 'عماد العرة', 'م.برنس', 163, 163, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001053', '616315', '2011-06-23 09:24:17', '2011-06-01', 'البيت الذهبي', 'ناجي محمود', 'م. عامر بو جخ', 459, 459, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001052', '616303', '2011-06-07 09:38:57', '2011-06-01', 'المحل', 'قاسم الطفيلي', 'م. طلال', 750, 750, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001043', '616298', '2011-06-02 08:58:55', '2011-06-01', 'سعد ابوعرابي', 'ناظم ابو عرابي', 'م. سعد', 129, 129, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001197', '616632', '2011-06-20 10:26:52', '2011-06-15', 'ابراهيم قصير', 'غيث فدوى', 'م. طلال', 840, 840, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001048', '616307', '2011-06-07 09:42:12', '2011-06-01', 'المحل', 'وسام الأمير', 'م. طلال', 785, 785, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001045', '616304', '2011-06-04 09:19:38', '2011-06-01', 'المحل', 'ياسر كرباج', 'م. طلال', 808, 808, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001057', '616263', '2011-06-03 10:20:24', '2011-05-31', 'سعد ابوعرابي', 'سامر حمدان', 'م. سعد', 129, 129, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001044', '616299', '2011-06-02 08:59:14', '2011-06-01', 'سعد ابوعرابي', 'خالد الحمصي', 'م. سعد', 346, 346, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001042', '616297', '2011-06-02 10:41:13', '2011-06-01', 'وليد الجناني', 'نواف عوض', 'م.الجناني', 1356, 1356, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001041', '616296', '2011-06-07 09:37:39', '2011-06-01', 'المحل', 'علي الرضا العزقي', 'م. طلال', 123, 123, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001040', '616295', '2011-06-09 10:42:02', '2011-06-01', 'ابو عبدو', 'عمار زعرور', 'م. أبو عبدو', 284, 284, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001039', '616294', '2011-06-04 09:19:14', '2011-06-01', 'هيثم بزي', 'هيثم شوقي', 'م. طلال', 797, 797, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001038', '616293', '2011-06-04 09:18:42', '2011-06-01', 'هيثم بزي', 'شادي عساف', 'م. طلال', 984, 984, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001037', '616292', '2011-06-04 09:18:15', '2011-06-01', 'هيثم بزي', 'عبد الغني سمعان', 'م. طلال', 941, 941, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001036', '616289', '2011-06-07 09:41:18', '2011-06-01', 'توفيق بو زيد', 'عبد الحليم سيف', 'م. طلال', 539, 539, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001034', '616278', '2011-06-04 10:30:59', '2011-05-31', 'المحل', 'غسان قنديل', 'م. طلال', 1083, 1083, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001075', '616356', '2011-06-08 10:34:09', '2011-06-03', 'المحل', 'كميل شريف', 'م. طلال', 1017, 1017, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001032', '616276', '2011-06-04 10:36:14', '2011-05-31', 'المحل', 'راجح سعدون', 'م. طلال', 1068, 1068, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001031', '616265', '2011-06-01 09:13:32', '2011-05-31', 'محمد صلاح الدين', 'عادل شقير', 'م.طلعت', 135, 135, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001030', '616264', '2011-06-02 08:58:21', '2011-05-31', 'سعد ابوعرابي', 'نعيم محمود', 'م. سعد', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001029', '616262', '2011-06-04 10:30:14', '2011-05-31', 'المحل', 'صبري الجمال', 'م. طلال', 554, 554, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001028', '616261', '2011-06-04 10:29:27', '2011-05-31', 'المحل', 'غالب طليس', 'م. طلال', 755, 755, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001026', '616250', '2011-06-04 10:35:46', '2011-05-30', 'المحل', 'شادي حنا', 'م. طلال', 979, 979, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001025', '616249', '2011-06-04 10:35:24', '2011-05-30', 'المحل', 'شفيق حمود', 'م. طلال', 1231, 1231, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001051', '616302', '2011-06-07 09:38:35', '2011-06-01', 'المحل', 'سالم بدرا', 'م. طلال', 875, 875, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001050', '616301', '2011-06-07 09:38:02', '2011-06-01', 'المحل', 'ايمن عاصي', 'م. طلال', 946, 946, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001023', '616245', '2011-05-31 09:43:09', '2011-05-30', 'سعد ابوعرابي', 'حسن همدان', 'م. سعد', 80, 80, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001022', '616243', '2011-06-04 10:29:03', '2011-05-30', 'المحل', 'عصام السيد', 'م. طلال', 508, 508, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001021', '616242', '2011-06-04 10:28:39', '2011-05-30', 'المحل', 'رفيق الديراني', 'م. طلال', 836, 836, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001018', '616234', '2011-06-04 10:27:19', '2011-05-30', 'المحل', 'احمد منذر', 'م. طلال', 927, 927, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001017', '616233', '2011-06-04 10:26:58', '2011-05-30', 'المحل', 'ابراهيم فحص', 'م. طلال', 903, 903, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001067', '616344', '2011-06-10 10:16:47', '2011-06-02', 'عدنان علي مظلوم', 'حمد مظلوم', 'م.الحاج عدنان', 95, 95, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001066', '616341', '2011-06-08 10:27:47', '2011-06-02', 'المحل', 'صالح خليفة', 'م. طلال', 920, 920, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001065', '616340', '2011-06-08 10:26:34', '2011-06-02', 'المحل', 'حسن عساف', 'م. طلال', 1287, 1287, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001063', '616326', '2011-06-07 09:40:32', '2011-06-02', 'المحل', 'نديم رعد', 'م. طلال', 581, 581, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001047', '616306', '2011-06-07 09:41:50', '2011-06-01', 'المحل', 'دريد حمدان', 'م. طلال', 898, 898, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001046', '616305', '2011-06-04 09:19:58', '2011-06-01', 'المحل', 'صلاح حنين', 'م. طلال', 950, 950, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001035', '616279', '2011-06-04 10:32:01', '2011-05-31', 'المحل', 'علي الرمح', 'م. طلال', 238, 238, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001033', '616277', '2011-06-04 10:36:36', '2011-05-31', 'المحل', 'حسان غريب', 'م. طلال', 559, 559, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001027', '616260', '2011-06-09 10:41:39', '2011-05-31', 'ابو عبدو', 'جميل الوس', 'م. أبو عبدو', 140, 140, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001024', '616246', '2011-05-31 09:42:43', '2011-05-30', 'سعد ابوعرابي', 'سعيد الجراح', 'م. سعد', 527, 527, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001016', '616232', '2011-06-04 10:26:16', '2011-05-30', 'المحل', 'جهاد سعد', 'م. طلال', 813, 813, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001015', '616231', '2011-06-04 10:25:50', '2011-05-30', 'المحل', 'وهبي قصير', 'م. طلال', 900, 900, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001014', '616230', '2011-05-31 08:39:10', '2011-05-30', 'عدنان علي مظلوم', 'حسان مظلوم', 'م.الحاج عدنان', 127, 127, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001012', '616180', '2011-06-09 10:41:14', '2011-05-27', 'ابو عبدو', 'محمد الوس', 'م. أبو عبدو', 216, 216, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001011', '616238', '2011-06-04 10:33:47', '2011-05-30', 'هيثم بزي', 'مالك حسون', 'م. طلال', 769, 769, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001010', '616237', '2011-06-04 10:33:21', '2011-05-30', 'هيثم بزي', 'عليا صميلي', 'م. طلال', 945, 945, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001008', '616235', '2011-06-04 10:32:29', '2011-05-30', 'هيثم بزي', 'عباس شاهين', 'م. طلال', 910, 910, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001006', '616212', '2011-06-04 09:43:31', '2011-05-28', 'المحل', 'وسيم عباس', 'م. طلال', 816, 816, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001007', '616229', '2011-06-04 08:40:45', '2011-05-28', 'حكمت الجمعة', 'خالد عثمان', 'م. حكمت', 239, 239, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001005', '616208', '2011-05-31 08:38:19', '2011-05-28', 'عدنان علي مظلوم', 'محمد غندور', 'م.الحاج عدنان', 505, 505, 'Mattress', 1, 1, 'ارسلت الى الجنوب', '20110000005', '', '0000-00-00 00:00:00'),
('20110001020', '616241', '2011-06-04 10:28:19', '2011-05-30', 'المحل', 'قاسم الرمح', 'م. طلال', 972, 972, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001019', '616240', '2011-06-03 09:27:41', '2011-05-30', 'المحل', 'هاشم مزهر', 'م. طلال', 392, 392, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001004', '616207', '2011-06-04 10:25:07', '2011-05-28', 'المحل', 'غياث يونس', 'م. طلال', 941, 941, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001003', '616205', '2011-06-03 09:27:20', '2011-05-28', 'المحل', 'علي ناصيف', 'م. طلال', 785, 785, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001002', '616203', '2011-06-03 09:26:58', '2011-05-28', 'المحل', 'نواف زين الدين', 'م. طلال', 1053, 1053, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001001', '616202', '2011-06-03 09:26:31', '2011-05-28', 'المحل', 'كاظم الحاج حسن', 'م. طلال', 974, 974, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001000', '616210', '2011-06-04 09:41:56', '2011-05-28', 'المحل', 'داني وهبي', 'م. طلال', 941, 941, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000999', '616211', '2011-06-04 09:42:19', '2011-05-28', 'المحل', 'جورج اعزان', 'م. طلال', 953, 953, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000998', '616209', '2011-06-04 09:41:35', '2011-05-28', 'المحل', 'مصطفى الوس', 'م. طلال', 1208, 1208, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000997', '616196', '2011-06-04 09:40:45', '2011-05-27', 'حيدر فقيه', 'فراس أمهز', 'م. طلال', 598, 598, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000996', '616193', '2011-05-31 08:38:42', '2011-05-27', 'عدنان علي مظلوم', 'وسام بلوق', 'م.الحاج عدنان', 223, 223, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000995', '616192', '2011-06-01 09:13:11', '2011-05-27', 'محمد صلاح الدين', 'سعيد الحمصي', 'م.طلعت', 868, 868, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000994', '616191', '2011-06-09 10:40:03', '2011-05-27', 'أبو عبدو', 'عبدو حسون', 'م. أبو عبدو', 317, 317, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001198', '616631', '2011-06-20 10:26:14', '2011-06-15', 'ابراهيم قصير', 'ابراهيم حمود', 'م. طلال', 915, 915, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000991', '616177', '2011-06-03 09:47:28', '2011-05-27', 'المحل', 'جمال العريس', 'م. طلال', 1063, 1063, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000989', '616169', '2011-06-09 10:40:50', '2011-05-27', 'ابو عبدو', 'ايمان الحلاني', 'م. أبو عبدو', 108, 108, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000988', '616174', '2011-06-04 09:40:09', '2011-05-27', 'أحمد قصير', 'صلاح حنون', 'م. طلال', 977, 977, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000987', '616173', '2011-06-04 09:35:11', '2011-05-27', 'أحمد قصير', 'عبد لله الدايخ', 'م. طلال', 1000, 1000, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000986', '616172', '2011-06-04 09:34:24', '2011-05-27', 'أحمد قصير', 'قاسم سهير', 'م. طلال', 1027, 1027, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000985', '616171', '2011-06-04 09:33:55', '2011-05-27', 'أحمد قصير', 'وحيد وحود', 'م. طلال', 1260, 1260, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000984', '616146', '2011-06-01 09:09:34', '2011-05-25', 'المحل', 'جابر جابر', 'م. طلال', 703, 703, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000983', '616145', '2011-06-01 09:08:53', '2011-05-25', 'المحل', 'محمد فران', 'م. طلال', 915, 915, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000982', '616144', '2011-06-01 09:08:16', '2011-05-25', 'المحل', 'ثائر الدلباني', 'م. طلال', 796, 796, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000981', '616161', '2011-06-01 09:10:07', '2011-05-26', 'المحل', 'وسام نون', 'م. طلال', 1347, 1347, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000969', '616130', '2011-06-23 09:23:48', '2011-05-24', 'البيت الذهبي', 'بدر الجراح', 'م. عامر بو جخ', 127, 127, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001013', '616239', '2011-06-04 10:34:44', '2011-05-30', 'هيثم بزي', 'عصام الحاج', 'م. طلال', 920, 920, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000977', '616157', '2011-05-30 09:12:45', '2011-05-26', 'المحل', 'حسن سلمان', 'م. طلال', 754, 754, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000978', '616158', '2011-06-03 09:47:07', '2011-05-26', 'المحل', 'طلال الموسوي', 'م. طلال', 438, 438, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000976', '616156', '2011-05-30 09:12:22', '2011-05-26', 'المحل', 'حمزة حمزة', 'م. طلال', 601, 601, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000975', '616155', '2011-05-31 08:36:34', '2011-05-26', 'عدنان علي مظلوم', 'نوال مظلوم', 'م.الحاج عدنان', 168, 168, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000974', '616143', '2011-06-06 11:11:06', '2011-05-25', 'نوفيل', 'صبحي ابوجخ', 'م.نوفيل', 380, 380, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000967', '616128', '2011-05-30 09:11:34', '2011-05-24', 'المحل', 'عبدالمنعم عمار', 'م. طلال', 1019, 1019, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000966', '616127', '2011-06-03 09:46:18', '2011-05-24', 'المحل', 'مارون الزغبي', 'م. طلال', 370, 370, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000964', '616131', '2011-05-28 08:46:06', '2011-05-24', 'حكمت الجمعة', 'جورج خرنوب', 'م. حكمت', 208, 208, 'Mattat', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110000992', '616178', '2011-06-03 09:47:48', '2011-05-27', 'المحل', 'ربيع ناصر الدين', 'م. طلال', 845, 845, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001009', '616236', '2011-06-04 10:32:58', '2011-05-30', 'هيثم بزي', 'عادل كرم', 'م. طلال', 881, 881, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000963', '616121', '2011-06-03 09:45:48', '2011-05-24', 'المحل', 'عباس عساف', 'م. طلال', 630, 630, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000961', '616119', '2011-06-03 09:45:04', '2011-05-24', 'المحل', 'فواز شمص', 'م. طلال', 1003, 1003, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000959', '616117', '2011-05-30 09:11:10', '2011-05-24', 'هيثم بزي', 'باسل مرمر', 'م. طلال', 502, 502, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000990', '616175', '2011-05-31 08:37:43', '2011-05-27', 'عدنان علي مظلوم', 'حنان طليس', 'م.الحاج عدنان', 214, 214, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000957', '616115', '2011-05-30 09:10:48', '2011-05-24', 'المحل', 'علي القاق', 'م. طلال', 546, 546, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000956', '616107', '2011-05-28 08:45:42', '2011-05-23', 'حكمت الجمعة', 'ظافر الشحيمي', 'م. حكمت', 91, 91, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000955', '616106', '2011-05-28 08:45:21', '2011-05-23', 'حكمت الجمعة', 'ماهر سمعان', 'م. حكمت', 131, 131, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000952', '616102', '2011-05-31 10:53:26', '2011-05-23', 'المحل', 'رامي أسعد', 'م. طلال', 1073, 1073, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000951', '616101', '2011-06-01 09:12:47', '2011-05-23', 'محمد صلاح الدين', 'غسان حشيمي', 'م.طلعت', 570, 570, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000950', '616096', '2011-05-31 11:25:52', '2011-05-23', 'المحل', 'عبدو حمية', 'م. طلال', 463, 463, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000949', '616093', '2011-05-31 11:25:00', '2011-05-23', 'المحل', 'هيثم بري', 'م. طلال', 347, 347, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000948', '616094', '2011-05-31 11:25:25', '2011-05-23', 'المحل', 'ايلي خوري', 'م. طلال', 1126, 1126, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000946', '616089', '2011-05-31 11:23:50', '2011-05-23', 'المحل', 'وليد عساف', 'م. طلال', 614, 614, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000945', '616100', '2011-05-30 09:10:26', '2011-05-23', 'المحل', 'خليل فران', 'م. طلال', 930, 930, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000971', '616140', '2011-06-03 09:46:42', '2011-05-25', 'المحل', 'عبدالقادرحوماني', 'م. طلال', 859, 859, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000970', '616139', '2011-05-30 09:11:57', '2011-05-25', 'المحل', 'سهيل الخنسا', 'م. طلال', 742, 742, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000943', '616098', '2011-05-31 10:52:37', '2011-05-23', 'المحل', 'تامر سلطان', 'م. طلال', 944, 944, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000944', '616099', '2011-05-31 10:53:02', '2011-05-23', 'المحل', 'شرف شرف', 'م. طلال', 937, 937, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000962', '616120', '2011-06-03 09:45:26', '2011-05-24', 'المحل', 'نبيل الحاج موسى', 'م. طلال', 964, 964, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000938', '616073', '2011-05-31 11:18:41', '2011-05-21', 'المحل', 'سليم سليمان', 'م. طلال', 416, 416, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000937', '616066', '2011-05-31 11:17:54', '2011-05-21', 'المحل', 'خليل حمية', 'م. طلال', 418, 418, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000929', '616050', '2011-05-31 10:27:41', '2011-05-20', 'شركة سنتر بو جخ', 'ظافر الموس', 'م. عامر بو جخ', 4698, 4698, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110000914', '616025', '2011-06-01 09:12:15', '2011-05-19', 'محمد صلاح الدين', 'غادة شبلي', 'م.طلعت', 380, 380, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000913', '616024', '2011-06-01 09:11:45', '2011-05-19', 'محمد صلاح الدين', 'خالد درويش', 'م.طلعت', 380, 380, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000935', '616064', '2011-05-31 10:54:32', '2011-05-21', 'المحل', 'سعيد البزال', 'م. طلال', 991, 991, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000936', '616065', '2011-05-31 10:54:57', '2011-05-21', 'المحل', 'عارف زعيتر', 'م. طلال', 728, 728, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000894', '615987', '2011-06-01 09:11:10', '2011-05-18', 'محمد صلاح الدين', 'صلاح الحمصي', 'م.طلعت', 475, 475, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000908', '616019', '2011-06-30 09:42:46', '2011-05-19', 'المحل', 'نبيل حوري', 'م. طلال', 792, 792, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000880', '615975', '2011-05-31 08:37:15', '2011-05-17', 'عدنان علي مظلوم', 'غالب مظلوم', 'م.الحاج عدنان', 953, 953, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000858', '615914', '2011-06-28 09:14:05', '2011-05-14', 'المحل', 'جهاد مبارك', 'م. طلال', 1291, 1291, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000656', '615541', '2011-06-30 09:40:23', '2011-04-25', 'المحل', 'محمود الحلاني', 'م. طلال', 18, 18, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000659', '615544', '2011-06-30 09:41:27', '2011-04-25', 'المحل', 'عبدو اشمر', 'م. طلال', 767, 767, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110000660', '615545', '2011-06-30 09:42:05', '2011-04-25', 'المحل', 'دريد فقيه', 'م. طلال', 761, 761, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001139', '616517', '2011-06-16 08:48:00', '2011-06-09', 'حكمت الجمعة', 'لبيب خير الله', 'م. حكمت', 1490, 1490, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001140', '616519', '2011-06-16 09:55:23', '2011-06-09', 'حلباوي للصناعة والتجارة', 'حميد سلهب', 'م. طلال', 8278, 8278, 'Mattat', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001141', '616498', '2011-06-14 12:23:26', '2011-06-09', 'المحل', 'جرجس وردة', 'م. طلال', 896, 896, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001142', '616499', '2011-06-14 12:23:47', '2011-06-09', 'المحل', 'عبدالرحيم الميس', 'م. طلال', 855, 855, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001143', '616501', '2011-06-14 12:24:30', '2011-06-09', 'المحل', 'عيدالجراح', 'م. طلال', 782, 782, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001144', '616502', '2011-06-14 12:24:55', '2011-06-09', 'المحل', 'جاد الرمح', 'م. طلال', 790, 790, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001145', '616503', '2011-06-14 12:25:17', '2011-06-09', 'المحل', 'راجح الطقش', 'م. طلال', 83, 83, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001146', '616505', '2011-06-14 12:38:03', '2011-06-09', 'المحل', 'عارف الجباوي', 'م. طلال', 171, 171, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001148', '616522', '2011-06-16 10:36:52', '2011-06-09', 'المحل', 'نضال الخنسا', 'م. طلال', 998, 998, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001149', '616530', '2011-06-10 14:41:37', '2011-06-09', 'سعد ابوعرابي', 'سعد ابو احمد', 'م. سعد', 1467, 1467, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001150', '616535', '2011-06-16 09:58:05', '2011-06-10', 'حلباوي للصناعة والتجارة', 'محسن البدوي', 'م. طلال', 1547, 1547, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001151', '616534', '2011-06-17 08:55:02', '2011-06-10', 'عدنان علي مظلوم', 'احمد مظلوم', 'م.الحاج عدنان', 90, 90, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001152', '616536', '2011-06-16 09:55:55', '2011-06-10', 'المحل', 'حازم فقيه', 'م. طلال', 690, 690, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001153', '616537', '2011-06-16 10:37:12', '2011-06-10', 'المحل', 'زهيرالحركة', 'م. طلال', 735, 735, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001154', '616538', '2011-06-14 12:17:28', '2011-06-10', 'المحل', 'نجيب موسى', 'م. طلال', 873, 873, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001155', '616539', '2011-06-14 12:20:38', '2011-06-10', 'المحل', 'جهاد الدنا', 'م. طلال', 1199, 1199, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001156', '616540', '2011-06-16 09:56:50', '2011-06-10', 'المحل', 'حكمت سعد', 'م. طلال', 269, 269, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001157', '616541', '2011-06-14 12:21:15', '2011-06-10', 'المحل', 'اهاب النجار', 'م. طلال', 944, 944, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001158', '616542', '2011-06-14 12:21:49', '2011-06-10', 'المحل', 'عصام حمية', 'م. طلال', 942, 942, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001159', '616543', '2011-06-14 12:22:27', '2011-06-10', 'المحل', 'سامي زعيتر', 'م. طلال', 1054, 1054, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001160', '616544', '2011-06-14 12:22:54', '2011-06-10', 'المحل', 'ادهم شمص', 'م. طلال', 1136, 1136, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001161', '616545', '2011-06-23 09:24:46', '2011-06-10', 'البيت الذهبي', 'عادل غازي', 'م. عامر بو جخ', 143, 143, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001162', '616551', '2011-06-16 09:57:13', '2011-06-10', 'المحل', 'مالك سلوم', 'م. طلال', 174, 174, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001163', '616561', '2011-06-16 10:01:47', '2011-06-11', 'المحل', 'ظافر الزهر', 'م. طلال', 817, 817, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001164', '616562', '2011-06-16 10:38:09', '2011-06-11', 'المحل', 'هلا علو', 'م. طلال', 847, 847, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001165', '616563', '2011-06-16 10:38:42', '2011-06-11', 'المحل', 'حسان هاشم', 'م. طلال', 953, 953, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001166', '616564', '2011-06-16 10:39:03', '2011-06-11', 'المحل', 'وائل تامر', 'م. طلال', 925, 925, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001167', '616565', '2011-06-16 10:39:38', '2011-06-11', 'المحل', 'حمود العلي', 'م. طلال', 921, 921, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001168', '616566', '2011-06-20 10:29:29', '2011-06-11', 'المحل', 'جهاد مشيك', 'م. طلال', 653, 653, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001169', '616567', '2011-06-16 09:59:48', '2011-06-11', 'المحل', 'عمار شرف', 'م. طلال', 1060, 1060, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001170', '616571', '2011-06-16 10:39:59', '2011-06-11', 'المحل', 'علي الأحمر', 'م. طلال', 830, 830, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001171', '616572', '2011-06-16 10:40:23', '2011-06-11', 'المحل', 'فراس خليل', 'م. طلال', 884, 884, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001172', '616568', '2011-06-16 10:34:15', '2011-06-11', 'المحل', 'غياث سليمان', 'م. طلال', 1061, 1061, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001173', '616569', '2011-06-16 10:35:02', '2011-06-11', 'المحل', 'نبيل الديراني', 'م. طلال', 753, 753, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001174', '616570', '2011-06-16 10:35:38', '2011-06-11', 'المحل', 'زاهر حيدر', 'م. طلال', 726, 726, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001175', '616579', '2011-06-16 10:35:59', '2011-06-11', 'المحل', 'قاسم حوماني', 'م. طلال', 496, 496, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001176', '616580', '2011-06-24 09:11:17', '2011-06-11', 'أبو عبدو', 'قاسم قاسم', 'م. أبو عبدو', 534, 534, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001177', '616590', '2011-06-17 09:11:13', '2011-06-13', 'اكرم عساف', 'كرم محسن', 'م. طلال', 195, 195, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001178', '616587', '2011-06-30 11:53:31', '2011-06-13', 'المحل', 'عساف عساف', 'م. طلال', 601, 601, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001179', '616588', '2011-06-16 10:03:12', '2011-06-13', 'المحل', 'نجيب ابو حيدر', 'م. طلال', 171, 171, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001180', '616589', '2011-06-24 09:10:43', '2011-06-13', 'ابو عبدو', 'عبدالله الوس', 'م. أبو عبدو', 331, 331, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001181', '616591', '2011-06-20 10:29:54', '2011-06-13', 'المحل', 'عباس حمية', 'م. طلال', 1079, 1079, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001182', '616592', '2011-06-16 10:41:31', '2011-06-13', 'المحل', 'سامي العوطة', 'م. طلال', 1074, 1074, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001183', '616593', '2011-06-16 10:41:52', '2011-06-13', 'المحل', 'صادق الموسوي', 'م. طلال', 571, 571, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001184', '616594', '2011-06-16 10:42:12', '2011-06-13', 'المحل', 'بيار معلوف', 'م. طلال', 374, 374, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001185', '616595', '2011-06-17 09:12:10', '2011-06-13', 'حلباوي للصناعة والتجارة', 'سليم كلاس', 'م. طلال', 1886, 1886, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001186', '616605', '2011-06-16 08:49:17', '2011-06-13', 'حكمت الجمعة', 'خالد العيط', 'م. حكمت', 462, 462, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001194', '616615', '2011-07-06 09:03:27', '2011-06-14', 'نوفيل', 'صلاح الحوت', 'م.نوفيل', 475, 475, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001187', '616608', '2011-06-16 08:51:51', '2011-06-13', 'حكمت الجمعة', 'جمعة الراعي', 'م. حكمت', 1034, 1034, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001188', '616607', '2011-06-17 08:55:29', '2011-06-13', 'عدنان علي مظلوم', 'عدنان سلوم', 'م.الحاج عدنان', 95, 95, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001189', '616606', '2011-06-17 16:29:56', '2011-06-13', 'برنس', 'باسم هلال', 'م.برنس', 670, 670, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001190', '616611', '2011-06-17 09:13:49', '2011-06-14', 'حلباوي للصناعة والتجارة', 'عبدو يزبك', 'م. طلال', 628, 628, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001192', '616613', '2011-06-24 09:12:58', '2011-06-14', 'أبو عبدو', 'زاهي يونس', 'م. أبو عبدو', 216, 216, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001191', '616612', '2011-06-16 15:02:43', '2011-06-14', 'شركة القلعة', 'هاشم الفليطي', 'م.طحان', 92, 92, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001199', '616626', '2011-06-17 09:11:39', '2011-06-15', 'المحل', 'هلال هلال', 'م. طلال', 1055, 1055, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001200', '616627', '2011-06-17 09:13:00', '2011-06-15', 'المحل', 'سعيد حمود', 'م. طلال', 950, 950, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001201', '616628', '2011-06-17 09:13:24', '2011-06-15', 'المحل', 'مصطفى عجاج', 'م. طلال', 953, 953, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001202', '616629', '2011-06-20 10:24:51', '2011-06-15', 'المحل', 'قاسم كمال', 'م. طلال', 834, 834, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001203', '616634', '2011-06-17 08:56:22', '2011-06-15', 'عدنان علي مظلوم', 'رأفت مظلوم', 'م.الحاج عدنان', 519, 519, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001204', '616633', '2011-06-17 16:28:36', '2011-06-15', 'حكمت الجمعة', 'حليم الرفاعي', 'م. حكمت', 164, 164, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001205', '616637', '2011-06-24 09:12:09', '2011-06-15', 'ابو عبدو', 'هادي ابو رجيلي', 'م. أبو عبدو', 105, 105, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001206', '616646', '2011-06-20 10:28:32', '2011-06-15', 'الفجر', 'فادي حمود', 'م. طلال', 2587, 2587, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00');
INSERT INTO `fomaconakdi` (`IDNakdi`, `IDFacture`, `Date`, `FactureDate`, `Zaboun`, `NakdiName`, `Mandoub`, `Debit`, `Credit`, `Mashrou3`, `HasPayed`, `HasMailed`, `Note`, `UserId`, `LastUserId`, `paydate`) VALUES
('20110001207', '616645', '2011-06-20 10:28:03', '2011-06-15', 'الفجر', 'غدي بلوق', 'م. طلال', 924, 924, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001208', '616644', '2011-06-20 10:27:31', '2011-06-15', 'الفجر', 'جاسم قانصو', 'م. طلال', 924, 924, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001209', '616656', '2011-06-16 15:01:32', '2011-06-15', 'الشحيمي', 'خالد بو عثمان', 'م. صالة المبيعات', 356, 0, 'Mattress', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001210', '616636', '2011-06-24 09:11:47', '2011-06-15', 'أبو عبدو', 'اسعد سعدون', 'م. أبو عبدو', 114, 114, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001211', '616638', '2011-06-17 08:55:59', '2011-06-15', 'عدنان علي مظلوم', 'لؤي حمود', 'م.الحاج عدنان', 384, 384, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001212', '616657', '2011-06-24 10:46:14', '2011-06-16', 'حلباوي للصناعة والتجارة', 'حسن شهاب', 'م. طلال', 1247, 1247, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001214', '616668', '2011-06-24 10:45:50', '2011-06-16', 'برنس', 'كميل اسمر', 'م.برنس', 480, 480, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001215', '616667', '2011-06-24 10:45:53', '2011-06-16', 'سعد ابوعرابي', 'عادل سمعان', 'م. سعد', 663, 663, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001216', '616669', '2011-06-25 09:05:32', '2011-06-16', 'محمد صلاح الدين', 'صلاح حسون', 'م.طلعت', 234, 234, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001217', '616659', '2011-06-24 10:46:10', '2011-06-16', 'المحل', 'يوسف حمدان', 'م. طلال', 463, 463, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001218', '616658', '2011-06-24 10:46:06', '2011-06-16', 'المحل', 'عادل ايوب', 'م. طلال', 1567, 1567, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001219', '616670', '2011-06-21 08:46:31', '2011-06-16', 'عدنان علي مظلوم', 'نياظي مشيك', 'م.الحاج عدنان', 1320, 1320, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001220', '616684', '2011-06-21 09:45:00', '2011-06-17', 'بسام مروة', 'بسام ملو', 'م. طلال', 1045, 1045, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001221', '616683', '2011-06-21 09:44:35', '2011-06-17', 'بسام مروة', 'مارون خوري', 'م. طلال', 935, 935, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001222', '616682', '2011-06-21 09:44:08', '2011-06-17', 'بسام مروة', 'جان مارون', 'م. طلال', 986, 986, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001223', '616681', '2011-06-21 09:43:37', '2011-06-17', 'بسام مروة', 'وائل حمزة', 'م. طلال', 1176, 1176, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001224', '616680', '2011-06-21 09:42:54', '2011-06-17', 'بسام مروة', 'طارق أحمد', 'م. طلال', 1481, 1481, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001225', '616687', '2011-06-21 09:45:25', '2011-06-17', 'حلباوي للصناعة والتجارة', 'عباس عودة', 'م. طلال', 1233, 1233, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001226', '616688', '2011-06-21 09:46:25', '2011-06-17', 'حلباوي للصناعة والتجارة', 'عصام درغام', 'م. طلال', 173, 173, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001227', '616685', '2011-06-24 10:14:16', '2011-06-17', 'المحل', 'امير علوان', 'م. طلال', 1122, 1122, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001228', '616686', '2011-06-24 10:14:40', '2011-06-17', 'المحل', 'وسام الأمير', 'م. طلال', 826, 826, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001229', '616697', '2011-06-24 10:47:43', '2011-06-17', 'حكمت الجمعة', 'خالد عبد الاحد', 'م. حكمت', 107, 107, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001230', '616696', '2011-06-23 09:25:13', '2011-06-17', 'البيت الذهبي', 'مصطفى سماقة', 'م. عامر بو جخ', 190, 190, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001264', '616802', '2011-06-28 08:58:52', '2011-06-23', 'المحل', 'زاهر حمود', 'م. طلال', 925, 925, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001232', '616709', '2011-06-24 10:15:24', '2011-06-18', 'المحل', 'احمد الموسوي', 'م. طلال', 1303, 1303, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001233', '616717', '2011-06-24 10:45:57', '2011-06-18', 'الشحيمي', 'منير شحيمي', 'م. صالة المبيعات', 356, 0, 'Mattress', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001234', '616724', '2011-06-23 14:43:31', '2011-06-20', 'حلباوي للصناعة والتجارة', 'علي نور الدين ا لرفاعي', 'م. طلال', 254, 254, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001235', '616725', '2011-06-23 14:43:54', '2011-06-20', 'حلباوي للصناعة والتجارة', 'مروان الحاج حسين', 'م. طلال', 620, 620, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001236', '616732', '2011-06-23 14:47:21', '2011-06-20', 'المحل', 'محمد سليم', 'م. طلال', 1913, 1913, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001237', '616730', '2011-06-23 14:46:42', '2011-06-20', 'المحل', 'كامل غلايني', 'م. طلال', 1550, 1550, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001238', '616729', '2011-06-22 08:54:32', '2011-06-20', 'المحل', 'عباس خليل', 'م. طلال', 1794, 1794, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001239', '616728', '2011-06-24 10:15:50', '2011-06-20', 'المحل', 'خالد وليد', 'م. طلال', 416, 416, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001240', '616726', '2011-06-24 09:23:32', '2011-06-20', 'عدنان علي مظلوم', 'عادل المصري', 'م.الحاج عدنان', 1644, 1644, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001241', '616733', '2011-06-29 08:55:32', '2011-06-20', 'حكمت الجمعة', 'حاتم رمضان', 'م. حكمت', 2339, 2339, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001242', '616746', '2011-07-06 09:02:04', '2011-06-20', 'محمد صلاح الدين', 'هاشم صفوان', 'م.طلعت', 570, 570, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001243', '616747', '2011-06-28 08:49:57', '2011-06-20', 'عدنان علي مظلوم', 'وائل سعد الدين', 'م.الحاج عدنان', 166, 166, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001244', '616753', '2011-06-28 09:01:11', '2011-06-21', 'حلباوي للصناعة والتجارة', 'حيدر سلوم', 'م. طلال', 1049, 1049, 'Sponge', 1, 1, 'مرتجع جزء', '20110000006', '', '0000-00-00 00:00:00'),
('20110001245', '616755', '2011-06-28 09:15:07', '2011-06-21', 'المحل', 'حسام سليمان', 'م. طلال', 1122, 1122, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001246', '616756', '2011-06-27 09:04:19', '2011-06-21', 'المحل', 'حازم وسوف', 'م. طلال', 1100, 1100, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001247', '616757', '2011-06-27 09:04:52', '2011-06-21', 'المحل', 'وديع مراد', 'م. طلال', 675, 675, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001248', '616758', '2011-06-28 08:50:27', '2011-06-21', 'عدنان علي مظلوم', 'ماهر حمدان', 'م.الحاج عدنان', 250, 250, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001249', '616761', '2011-06-28 08:57:05', '2011-06-21', 'المحل', 'موسى حسون', 'م. طلال', 1140, 1140, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001250', '616760', '2011-06-28 08:55:35', '2011-06-21', 'المحل', 'حسين منير', 'م. طلال', 1205, 1205, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001251', '616759', '2011-06-30 11:51:47', '2011-06-21', 'المحل', 'منير المهرة', 'م. طلال', 1349, 1349, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001252', '616762', '2011-06-28 08:50:54', '2011-06-21', 'عدنان علي مظلوم', 'عدنان السيد قاسم', 'م.الحاج عدنان', 282, 282, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001253', '616763', '2011-06-28 09:02:55', '2011-06-21', 'حلباوي للصناعة والتجارة', 'سليم حامد', 'م. طلال', 404, 404, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001254', '616772', '2011-06-28 08:51:24', '2011-06-21', 'عدنان علي مظلوم', 'مصطفى مقدح', 'م.الحاج عدنان', 418, 418, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001255', '616778', '2011-06-24 10:10:57', '2011-06-22', 'المحل', 'مصطفى خليل', 'م. طلال', 330, 330, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001256', '616777', '2011-07-04 11:57:13', '2011-06-22', 'البيت الذهبي', 'جورج خوري', 'م. عامر بو جخ', 491, 491, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001257', '616779', '2011-06-28 08:57:35', '2011-06-22', 'اكرم عساف', 'فارس احمد', 'م. طلال', 1107, 1107, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001258', '616780', '2011-06-28 08:58:03', '2011-06-22', 'اكرم عساف', 'أكر م كرم', 'م. طلال', 974, 974, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001259', '616710', '2011-06-24 10:13:02', '2011-06-22', 'هيثم بزي', 'هيثم حلاق', 'م. طلال', 199, 199, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001260', '616782', '2011-06-28 09:15:27', '2011-06-22', 'المحل', 'دجى بدر', 'م. طلال', 714, 714, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001261', '616781', '2011-06-28 09:03:22', '2011-06-22', 'حلباوي للصناعة والتجارة', 'نزيه علوش', 'م. طلال', 1026, 1026, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001262', '616783', '2011-06-25 09:20:38', '2011-06-22', 'حلباوي للصناعة والتجارة', 'محمد غزالة', 'م. طلال', 280, 280, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001263', '616784', '2011-06-28 08:58:30', '2011-06-22', 'حكمت مكارم', 'جابر جابر', 'م. طلال', 564, 564, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001265', '616803', '2011-06-28 08:59:15', '2011-06-23', 'المحل', 'حسام اشهب', 'م. طلال', 696, 696, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001266', '616804', '2011-06-28 08:59:49', '2011-06-23', 'المحل', 'الياس الذكرة', 'م. طلال', 979, 979, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001267', '616805', '2011-06-28 13:09:11', '2011-06-23', 'هيثم بزي', 'دريد سمعان', 'م. طلال', 152, 152, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001268', '616807', '2011-07-04 12:00:00', '2011-06-23', 'البيت الذهبي', 'علي الخليل', 'م. عامر بو جخ', 583, 583, 'Mattress', 1, 1, 'مرتجع جزء', '20110000001', '', '0000-00-00 00:00:00'),
('20110001269', '616810', '2011-06-27 09:06:25', '2011-06-23', 'المحل', 'عجاج مشيك', 'م. طلال', 1070, 1070, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001270', '616811', '2011-06-28 09:00:21', '2011-06-23', 'المحل', 'قاسم عليق', 'م. طلال', 132, 132, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001271', '616813', '2011-06-30 11:53:57', '2011-06-23', 'المحل', 'منير مصطفى', 'م. طلال', 148, 148, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001272', '616809', '2011-07-05 14:46:15', '2011-06-23', 'ابو عبدو', 'لولا شمعون', 'م. أبو عبدو', 256, 256, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001273', '616812', '2011-07-11 10:07:39', '2011-06-23', 'شركة سنتر بو جخ', 'احمد ابراهيم عراجي', 'م. ديب ابو جخ', 5470, 5470, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001274', '616821', '2011-07-01 11:43:39', '2011-06-23', 'عدنان علي مظلوم', 'اشرف قاسم', 'م.الحاج عدنان', 185, 185, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001275', '616822', '2011-07-05 14:46:38', '2011-06-23', 'أبو عبدو', 'حاتم ابو جبرا', 'م. أبو عبدو', 180, 180, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001276', '616823', '2011-06-28 13:02:16', '2011-06-24', 'المحل', 'وسام الغلايني', 'م. طلال', 888, 888, 'Mattress', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001277', '616824', '2011-06-28 13:03:02', '2011-06-24', 'المحل', 'طارق العصفور', 'م. طلال', 866, 866, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001278', '616825', '2011-06-28 13:08:27', '2011-06-24', 'المحل', 'ظريف الظريف', 'م. طلال', 876, 876, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001279', '616827', '2011-06-30 11:54:31', '2011-06-24', 'المحل', 'منير حسون', 'م. طلال', 1175, 1175, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001280', '616828', '2011-06-30 11:54:56', '2011-06-24', 'المحل', 'علاء ترو', 'م. طلال', 1178, 1178, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001281', '616829', '2011-06-30 11:55:19', '2011-06-24', 'المحل', 'تامر حسين', 'م. طلال', 970, 970, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001282', '616838', '2011-07-05 14:47:02', '2011-06-24', 'المحل', 'عبدو تامر', 'م. أبو عبدو', 972, 972, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001283', '616844', '2011-06-30 11:45:29', '2011-06-25', 'الفجر', 'حازم دندش', 'م. طلال', 840, 840, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001284', '616845', '2011-06-30 11:45:52', '2011-06-25', 'الفجر', 'مصطفى طليس', 'م. طلال', 931, 931, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001285', '616846', '2011-06-30 11:46:13', '2011-06-25', 'الفجر', 'فارس عنتر', 'م. طلال', 968, 968, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001286', '616847', '2011-06-30 11:46:36', '2011-06-25', 'الفجر', 'جابر نون', 'م. طلال', 913, 913, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001287', '616849', '2011-06-30 11:47:25', '2011-06-25', 'المحل', 'غدي بلوق', 'م. طلال', 630, 630, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001288', '616848', '2011-06-30 11:47:04', '2011-06-25', 'المحل', 'علي عثمان', 'م. طلال', 893, 893, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001289', '616843', '2011-06-25 15:00:22', '2011-06-25', 'ارقدان', 'جميل الوس', 'م. ارقدان', 11, 11, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001290', '616850', '2011-06-28 13:11:50', '2011-06-25', 'المحل', 'بلال ابو حيدر', 'م. طلال', 923, 923, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001291', '616851', '2011-06-28 13:12:24', '2011-06-25', 'المحل', 'ناظم يزبك', 'م. طلال', 979, 979, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001292', '616852', '2011-06-28 13:15:24', '2011-06-25', 'المحل', 'حمزة مظلوم', 'م. طلال', 841, 841, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001293', '616853', '2011-06-28 13:15:52', '2011-06-25', 'المحل', 'عمار حمزة', 'م. طلال', 1010, 1010, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001294', '616854', '2011-06-28 13:21:06', '2011-06-25', 'المحل', '', 'م. طلال', 995, 995, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001295', '616855', '2011-06-28 13:21:47', '2011-06-25', 'المحل', 'عدنان حمية', 'م. طلال', 1010, 1010, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001296', '616856', '2011-06-28 13:22:12', '2011-06-25', 'المحل', 'محمد قويق', 'م. طلال', 272, 272, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001297', '616857', '2011-06-28 13:22:45', '2011-06-25', 'المحل', 'سهيل الحسيني', 'م. طلال', 116, 116, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001298', '616858', '2011-07-15 11:25:59', '2011-06-25', 'المحل', 'محمد العربي', 'م. طلال', 573, 573, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001299', '616859', '2011-07-05 11:28:06', '2011-06-25', 'المحل', 'صادق الحسيني', 'م. طلال', 123, 123, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001300', '616860', '2011-07-06 09:01:28', '2011-06-25', 'محمد صلاح الدين', 'زهير الحشيمي', 'م.طلعت', 1172, 1172, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001301', '616861', '2011-07-04 11:57:42', '2011-06-25', 'البيت الذهبي', 'عادل ابو جخ', 'م. عامر بو جخ', 444, 444, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001302', '616872', '2011-06-30 11:49:46', '2011-06-27', 'الفجر', 'سعيد سعود', 'م. طلال', 913, 913, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001303', '616871', '2011-06-30 11:49:17', '2011-06-27', 'الفجر', 'رعد برق', 'م. طلال', 1059, 1059, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001304', '616870', '2011-06-30 11:48:53', '2011-06-27', 'الفجر', 'شادي فارس', 'م. طلال', 1096, 1096, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001305', '616869', '2011-06-30 11:48:09', '2011-06-27', 'الفجر', 'فادي اعور', 'م. طلال', 950, 950, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001306', '616873', '2011-07-05 11:27:44', '2011-06-27', 'الفجر', 'عباس الغريب', 'م. طلال', 935, 935, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001307', '616881', '2011-06-30 11:50:07', '2011-06-27', 'المحل', 'فراس القرصيفي', 'م. طلال', 963, 963, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001308', '616883', '2011-07-05 11:32:46', '2011-06-27', 'المحل', 'امجد بركات', 'م. طلال', 719, 719, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001309', '616882', '2011-07-05 11:32:26', '2011-06-27', 'المحل', 'منير سلوم', 'م. طلال', 694, 694, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001310', '616867', '2011-07-01 11:41:58', '2011-06-27', 'عدنان علي مظلوم', 'جعفر طليس', 'م.الحاج عدنان', 813, 813, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001311', '616877', '2011-07-05 14:47:24', '2011-06-27', 'ابو عبدو', 'خالد الحلاني', 'م. أبو عبدو', 198, 198, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001312', '616878', '2011-07-15 11:25:31', '2011-06-27', 'المحل', 'احمد الحلاني', 'م. طلال', 22, 22, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001313', '616879', '2011-06-30 09:43:07', '2011-06-27', 'المحل', 'احمد سماحة', 'م. طلال', 515, 515, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001314', '616880', '2011-06-30 11:55:41', '2011-06-27', 'المحل', 'حمدي عيتاني', 'م. طلال', 492, 492, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001315', '616884', '2011-06-28 09:49:10', '2011-06-27', 'سعد ابوعرابي', 'سالم العرة', 'م. سعد', 1056, 1056, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001316', '616885', '2011-07-04 11:58:57', '2011-06-27', 'البيت الذهبي', 'وليد عامر', 'م. عامر بو جخ', 208, 208, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001317', '616893', '2011-07-01 11:42:24', '2011-06-28', 'عدنان علي مظلوم', 'قاسم مظلوم', 'م.الحاج عدنان', 333, 333, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001318', '616902', '2011-07-01 11:43:02', '2011-06-28', 'عدنان علي مظلوم', 'حنان يونس', 'م.الحاج عدنان', 158, 158, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001319', '616905', '2011-07-05 11:28:35', '2011-06-28', 'المحل', 'نجيب غندور', 'م. طلال', 554, 554, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001320', '616908', '2011-07-05 11:34:53', '2011-06-28', 'المحل', 'عدي قصار', 'م. طلال', 911, 911, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001321', '616907', '2011-07-05 11:34:25', '2011-06-28', 'المحل', 'خليل منصور', 'م. طلال', 1094, 1094, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001322', '616906', '2011-07-05 11:34:04', '2011-06-28', 'المحل', 'حسام خليل', 'م. طلال', 1127, 1127, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001323', '616909', '2011-07-05 11:35:20', '2011-06-28', 'توفيق بو زيد', 'وحيد مصطفى', 'م. طلال', 544, 544, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001324', '616903', '2011-07-05 11:33:35', '2011-06-28', 'توفيق بو زيد', 'نمر امجد', 'م. طلال', 790, 790, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001325', '616913', '2011-07-05 11:36:57', '2011-06-28', 'محمد الشامي', 'محمد الحوت', 'م. طلال', 748, 748, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001326', '616912', '2011-07-05 11:36:36', '2011-06-28', 'محمد الشامي', 'شادي اسمر', 'م. طلال', 813, 813, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001327', '616911', '2011-07-05 11:36:11', '2011-06-28', 'محمد الشامي', 'ماهر اشعل', 'م. طلال', 892, 892, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001328', '616910', '2011-07-05 11:35:43', '2011-06-28', 'محمد الشامي', 'مجتبى رعد', 'م. طلال', 912, 912, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001329', '616914', '2011-07-06 09:03:59', '2011-06-28', 'حكمت الجمعة', 'خالد جمعة', 'م. حكمت', 139, 139, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001330', '616919', '2011-06-29 10:37:02', '2011-06-28', 'سعد ابوعرابي', 'وائل حمود', 'م. سعد', 113, 113, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001331', '616915', '2011-06-30 11:52:23', '2011-06-28', 'المحل', 'غالب حمية', 'م. طلال', 972, 972, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001332', '616916', '2011-07-05 11:29:06', '2011-06-28', 'المحل', 'حكمت مكارم', 'م. طلال', 325, 325, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001333', '616917', '2011-07-05 11:30:28', '2011-06-28', 'المحل', 'منير مرداس', 'م. طلال', 677, 677, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001334', '616918', '2011-07-01 10:08:36', '2011-06-28', 'المحل', 'جان معلوف', 'م. طلال', 582, 582, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001335', '616920', '2011-06-30 11:52:49', '2011-06-28', 'المحل', 'عاطف منذر', 'م. طلال', 1069, 1069, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001336', '616921', '2011-06-30 11:53:12', '2011-06-28', 'المحل', 'نواف ابو ديه', 'م. طلال', 1107, 1107, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001337', '616922', '2011-07-05 12:46:32', '2011-06-28', 'وليد الجناني', 'مارون هراوي', 'م.الجناني', 331, 331, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001338', '616923', '2011-06-30 16:11:58', '2011-06-28', 'عدنان علي مظلوم/سحمر', 'فارس شبلي', 'م.الحاج عدنان', 1423, 1423, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001339', '616924', '2011-06-29 10:36:40', '2011-06-28', 'سعد ابوعرابي', 'ربيع نبها', 'م. سعد', 495, 495, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001340', '616927', '2011-07-05 14:48:11', '2011-06-28', 'ابو عبدو', 'ادهم الحلاني', 'م. أبو عبدو', 99, 99, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001341', '616928', '2011-07-23 09:02:44', '2011-06-28', 'نوفيل', 'نضال زعرور', 'م.نوفيل', 618, 618, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001342', '616929', '2011-07-01 11:44:12', '2011-06-28', 'عدنان علي مظلوم', 'غالب طليس', 'م.الحاج عدنان', 202, 202, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001343', '616931', '2011-07-05 11:27:13', '2011-06-28', 'المحل', 'جهاد ضاهر', 'م. طلال', 684, 684, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001344', '616942', '2011-07-06 11:49:17', '2011-06-29', 'هيثم بزي', 'رائد قمبر', 'م. طلال', 1236, 1236, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001345', '616941', '2011-07-01 11:44:36', '2011-06-29', 'عدنان علي مظلوم', 'شفيق ابو اسماعيل', 'م.الحاج عدنان', 300, 300, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001346', '616943', '2011-07-05 11:31:17', '2011-06-29', 'المحل', 'غسان صلح', 'م. طلال', 628, 628, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001347', '616944', '2011-07-06 09:05:50', '2011-06-29', 'برنس', 'ابراهيم الميس', 'م.برنس', 391, 391, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001348', '616945', '2011-07-06 09:02:26', '2011-06-29', 'محمد صلاح الدين', 'سعدون شحيمي', 'م.طلعت', 166, 166, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001349', '616946', '2011-07-08 08:57:55', '2011-06-29', 'عدنان علي مظلوم', 'نديم مظلوم', 'م.الحاج عدنان', 101, 101, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001350', '616961', '2011-07-06 11:48:34', '2011-06-30', 'احمد قصير', 'ذو الفقار احمد', 'م. طلال', 374, 374, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001351', '616963', '2011-07-06 09:04:39', '2011-06-30', 'حكمت الجمعة', 'صالح رمضان ', 'م. حكمت', 1386, 1386, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001352', '616964', '2011-07-01 17:22:35', '2011-06-30', 'عدنان علي مظلوم', 'عدنان عياد', 'م.الحاج عدنان', 62, 62, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001353', '616962', '2011-07-05 11:31:46', '2011-06-30', 'المحل', 'نبيل الخنسا', 'م. طلال', 578, 578, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001354', '616979', '2011-07-06 09:05:12', '2011-06-30', 'حكمت الجمعة', 'حاتم عباس', 'م. حكمت', 50, 50, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001355', '616980', '2011-07-15 11:44:32', '2011-07-01', 'المحل', 'اديب شومان', 'م. طلال', 561, 561, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001356', '616987', '2011-07-07 09:09:24', '2011-07-01', 'سعد ابوعرابي', 'سعيد غريب', 'م. سعد', 316, 316, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001357', '616981', '2011-07-08 08:58:20', '2011-07-01', 'عدنان علي مظلوم', 'ناجي مظلوم', 'م.الحاج عدنان', 222, 222, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001358', '616990', '2011-07-06 11:50:00', '2011-07-01', 'المحل', 'سليم طالب', 'م. طلال', 748, 748, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001359', '616991', '2011-07-06 11:51:10', '2011-07-01', 'المحل', 'محمد غالب حيدر', 'م. طلال', 1129, 1129, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001360', '616992', '2011-07-06 11:51:48', '2011-07-01', 'المحل', 'محمد عبديزبك', 'م. طلال', 1101, 1101, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001361', '616993', '2011-07-06 11:52:14', '2011-07-01', 'المحل', 'باسم النجار', 'م. طلال', 1046, 1046, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001362', '616994', '2011-07-06 11:52:39', '2011-07-01', 'المحل', 'محمد ابوزيد', 'م. طلال', 1129, 1129, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001363', '616996', '2011-07-02 08:50:15', '2011-07-01', 'عدنان علي مظلوم/سحمر', 'نضال الجراح', 'م.الحاج عدنان', 480, 480, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001364', '616997', '2011-07-02 08:50:51', '2011-07-01', 'عدنان علي مظلوم/سحمر', 'نعيم فارس', 'م.الحاج عدنان', 441, 441, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001365', '616998', '2011-07-05 12:46:58', '2011-07-01', 'وليد الجناني', 'عصام جبارة', 'م.الجناني', 2086, 2086, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001366', '616995', '2011-07-06 11:53:05', '2011-07-01', 'المحل', 'تامر حمزة', 'م. طلال', 876, 876, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001367', '617013', '2011-07-15 11:27:12', '2011-07-02', 'المحل', 'مقدح الزعن', 'م. طلال', 1304, 1304, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001368', '617014', '2011-07-15 11:27:41', '2011-07-02', 'المحل', 'خليل برو', 'م. طلال', 972, 972, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001369', '617015', '2011-07-15 11:28:14', '2011-07-02', 'المحل', 'داني وهبي ', 'م. طلال', 778, 778, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001370', '617016', '2011-07-15 11:28:46', '2011-07-02', 'المحل', 'فايز أحمد', 'م. طلال', 873, 873, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001371', '617017', '2011-07-15 11:29:11', '2011-07-02', 'المحل', 'قاسم بلوق', 'م. طلال', 865, 865, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001372', '617004', '2011-07-23 11:05:13', '2011-07-02', 'البيت الذهبي', 'جورج هراوي', 'م. عامر بو جخ', 143, 143, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001373', '617009', '2011-07-04 09:07:33', '2011-07-02', 'برنس', 'نسيم حمية', 'م.برنس', 155, 155, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001374', '617010', '2011-07-06 09:02:47', '2011-07-02', 'محمد صلاح الدين', 'محمد شرف', 'م.طلعت', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001375', '617011', '2011-07-07 09:10:22', '2011-07-02', 'سعد ابوعرابي', 'حامد مكحل', 'م. سعد', 513, 513, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001376', '617012', '2011-07-05 14:48:43', '2011-07-02', 'ابو عبدو', 'نزار الحلاني', 'م. أبو عبدو', 132, 132, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001377', '617021', '2011-07-09 09:31:24', '2011-07-02', 'المحل', 'نبيل الطفيلي', 'م. طلال', 515, 515, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001378', '617018', '2011-07-06 11:54:05', '2011-07-02', 'المحل', 'علي الطفيلي', 'م. طلال', 956, 956, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001379', '617019', '2011-07-06 11:55:28', '2011-07-02', 'المحل', 'اميل زعيتر', 'م. طلال', 1026, 1026, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001380', '617020', '2011-07-06 11:56:00', '2011-07-02', 'المحل', 'عساف الرمح', 'م. طلال', 1128, 1128, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001381', '617048', '2011-07-15 11:31:23', '2011-07-04', 'علي نور الدين', 'نور الغريب', 'م. طلال', 254, 254, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001382', '617042', '2011-07-15 11:52:14', '2011-07-04', 'المحل', 'مروان عطوي', 'م. طلال', 1064, 1064, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001383', '617043', '2011-07-15 11:38:09', '2011-07-04', 'المحل', 'احمد ياسين', 'م. طلال', 1056, 1056, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001384', '617044', '2011-07-15 11:38:41', '2011-07-04', 'المحل', 'سليم جابر', 'م. طلال', 1140, 1140, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001385', '617059', '2011-07-09 09:32:05', '2011-07-04', 'المحل', 'حسن غصوب', 'م. طلال', 264, 264, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001386', '617060', '2011-07-06 11:56:26', '2011-07-04', 'المحل', 'كابي سليمان', 'م. طلال', 106, 106, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001387', '617061', '2011-07-09 09:32:35', '2011-07-04', 'المحل', 'نايف دلباني', 'م. طلال', 1073, 1073, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001388', '617062', '2011-07-06 11:56:58', '2011-07-04', 'المحل', 'ابراهيم كرامي', 'م. طلال', 1059, 1059, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001389', '617065', '2011-07-05 12:47:22', '2011-07-04', 'وليد الجناني', 'سحر ابو خاطر', 'م.الجناني', 458, 458, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001390', '617066', '2011-07-05 12:47:50', '2011-07-04', 'وليد الجناني', 'نواف سماحة', 'م.الجناني', 544, 544, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001391', '617067', '2011-07-05 09:19:53', '2011-07-04', 'سعد ابوعرابي', 'عماد اللقيس', 'م. سعد', 392, 392, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001392', '617068', '2011-07-06 09:06:24', '2011-07-04', 'برنس', 'بلال بستاني', 'م.برنس', 172, 172, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001393', '617069', '2011-07-08 08:58:46', '2011-07-04', 'عدنان علي مظلوم', 'ناظم مظلوم', 'م.الحاج عدنان', 515, 515, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001394', '617083', '2011-07-15 11:45:01', '2011-07-05', 'اكرم عساف', 'داني اندراوس', 'م. طلال', 200, 200, 'Mattat', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001395', '617088', '2011-07-12 09:12:26', '2011-07-05', 'محمد غروب', 'غدي حسون', 'م. طلال', 358, 358, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001396', '617093', '2011-07-15 11:31:48', '2011-07-05', 'المحل', 'بدر الضاحك', 'م. طلال', 1204, 1204, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001397', '617094', '2011-07-15 11:32:51', '2011-07-05', 'المحل', 'سمير بدري', 'م. طلال', 1048, 1048, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001398', '617095', '2011-07-15 11:33:18', '2011-07-05', 'المحل', 'سمعان جشي', 'م. طلال', 972, 972, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001399', '617096', '2011-07-15 11:33:44', '2011-07-05', 'المحل', 'طلال اسماعيل', 'م. طلال', 962, 962, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001400', '617101', '2011-07-15 11:34:15', '2011-07-05', 'المحل', 'ظافر ميتا', 'م. طلال', 982, 982, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001401', '617084', '2011-07-16 08:58:05', '2011-07-05', 'محمد صلاح الدين', 'طارق الحمصي', 'م.طلعت', 570, 570, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001402', '617086', '2011-07-13 09:15:50', '2011-07-05', 'المحل', 'اكرم قنطار', 'م. طلال', 1266, 1266, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001403', '617087', '2011-07-13 09:17:41', '2011-07-05', 'المحل', 'اكرم عساف', 'م. طلال', 143, 143, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001404', '617089', '2011-07-21 08:52:54', '2011-07-05', 'المحل', 'ايمن الخنسا', 'م. طلال', 1038, 1038, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001405', '617090', '2011-07-21 08:53:21', '2011-07-05', 'المحل', 'طوني هراوي', 'م. طلال', 841, 841, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001406', '617091', '2011-07-08 08:59:16', '2011-07-05', 'عدنان علي مظلوم', 'عبدالمنعم طليس', 'م.الحاج عدنان', 966, 966, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001407', '617092', '2011-07-08 08:59:40', '2011-07-05', 'عدنان علي مظلوم', 'جميل عبيد', 'م.الحاج عدنان', 1288, 1288, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001408', '617097', '2011-07-23 10:10:47', '2011-07-05', 'المحل', 'علي سليمان', 'م. طلال', 69, 69, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001409', '617098', '2011-07-13 09:18:29', '2011-07-05', 'المحل', 'عادل الخرسا', 'م. طلال', 1186, 1186, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001410', '617099', '2011-07-13 09:19:00', '2011-07-05', 'المحل', 'محمود العريبي', 'م. طلال', 1217, 1217, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001411', '617100', '2011-07-13 09:19:29', '2011-07-05', 'المحل', 'نواف حمية', 'م. طلال', 1140, 1140, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001412', '617102', '2011-07-13 09:19:59', '2011-07-05', 'المحل', 'علي زعيتر', 'م. طلال', 920, 920, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001413', '617125', '2011-07-12 09:17:21', '2011-07-06', 'أحمد زعيتر', 'سايد أعور', 'م. طلال', 1270, 1270, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001414', '617126', '2011-07-12 09:17:45', '2011-07-06', 'احمد زعيتر', 'سمير الزيز', 'م. طلال', 726, 726, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001415', '617127', '2011-07-12 09:18:07', '2011-07-06', 'احمد زعيتر', 'ايلي بهجت', 'م. طلال', 1389, 1389, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001416', '617128', '2011-07-12 09:19:51', '2011-07-06', 'احمد زعيتر', 'نوح محمد ', 'م. طلال', 1063, 1063, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001417', '617129', '2011-07-12 09:20:18', '2011-07-06', 'احمد زعيتر', 'زعيتر زعيتر', 'م. طلال', 913, 913, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001418', '617137', '2011-07-07 09:10:50', '2011-07-06', 'سعد ابوعرابي', 'وسام الميسم', 'م. سعد', 192, 192, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001419', '617143', '2011-07-12 09:13:29', '2011-07-06', 'المحل', 'حسان الديراني', 'م. طلال', 1301, 1301, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001420', '617144', '2011-07-12 09:14:42', '2011-07-06', 'المحل', 'عباس سمعان', 'م. طلال', 954, 954, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001421', '617145', '2011-07-12 09:15:13', '2011-07-06', 'المحل', 'شهد عباس ', 'م. طلال', 1201, 1201, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001422', '617146', '2011-07-12 09:15:40', '2011-07-06', 'المحل', 'زهير شومان', 'م. طلال', 997, 997, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001423', '617123', '2011-07-08 09:00:13', '2011-07-06', 'عدنان علي مظلوم', 'مروان ابو اسماعيل', 'م.الحاج عدنان', 190, 190, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001424', '617124', '2011-07-19 13:15:44', '2011-07-06', 'عدنان علي مظلوم', 'كامل منصور', 'م.الحاج عدنان', 444, 444, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001425', '617130', '2011-07-11 10:08:06', '2011-07-06', 'المحل', 'ايمان سليمان', 'م. طلال', 190, 190, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001426', '617131', '2011-07-23 09:10:32', '2011-07-06', 'المحل', 'ريمون قزي', 'م. طلال', 1026, 1026, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001427', '617132', '2011-07-23 09:11:07', '2011-07-06', 'المحل', 'نزار عمار', 'م. طلال', 1181, 1181, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001428', '617133', '2011-07-23 09:11:35', '2011-07-06', 'المحل', 'احمد حيدر', 'م. طلال', 1094, 1094, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001429', '617134', '2011-07-15 11:39:34', '2011-07-06', 'المحل', 'نمر الطفيلي', 'م. طلال', 1198, 1198, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001430', '617135', '2011-07-15 11:40:07', '2011-07-06', 'المحل', 'حسان يونس', 'م. طلال', 996, 996, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001431', '617136', '2011-07-13 09:10:06', '2011-07-06', 'المحل', 'ايمن شمص', 'م. طلال', 463, 463, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001432', '617138', '2011-07-07 08:41:44', '2011-07-06', 'عدنان علي مظلوم/سحمر', 'عماد الوس', 'م.الحاج عدنان', 111, 111, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001433', '617139', '2011-07-07 08:42:08', '2011-07-06', 'عدنان علي مظلوم/سحمر', 'غسان فارس', 'م.الحاج عدنان', 1038, 1038, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001434', '617140', '2011-07-07 08:42:33', '2011-07-06', 'عدنان علي مظلوم/سحمر', 'كريم الميس', 'م.الحاج عدنان', 578, 578, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001435', '617141', '2011-07-07 09:09:46', '2011-07-06', 'سعد ابوعرابي', 'عيسى حمود', 'م. سعد', 449, 449, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001436', '617142', '2011-07-21 10:20:01', '2011-07-06', 'برنس', 'غادة الجراح', 'م.برنس', 162, 162, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001437', '617147', '2011-07-09 09:13:05', '2011-07-06', 'حكمت الجمعة', 'خالد حسين', 'م. حكمت', 458, 458, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001438', '617172', '2011-07-12 09:16:03', '2011-07-07', 'حسان انجبار', 'نور الدين اسماعيل', 'م. طلال', 300, 300, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001439', '617174', '2011-07-09 09:13:38', '2011-07-07', 'حكمت الجمعة', 'ملك جمعة', 'م. حكمت', 24, 24, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001440', '617167', '2011-07-15 10:03:39', '2011-07-07', 'عدنان علي مظلوم', 'هيثم مخ', 'م.الحاج عدنان', 729, 729, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001441', '617165', '2011-07-13 09:10:30', '2011-07-07', 'المحل', 'ربيع الديراني', 'م. طلال', 162, 162, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001442', '617168', '2011-07-13 09:10:57', '2011-07-07', 'المحل', 'كابي سليمان', 'م. طلال', 78, 78, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001443', '617169', '2011-07-14 09:07:17', '2011-07-07', 'المحل', 'سميح ادريس', 'م. طلال', 1249, 1249, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001444', '617170', '2011-07-11 10:08:39', '2011-07-07', 'المحل', 'حيدر غريب', 'م. طلال', 1076, 1076, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001445', '617171', '2011-07-15 11:40:46', '2011-07-07', 'المحل', 'سهيل قصير', 'م. طلال', 1239, 1239, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001446', '617173', '2011-07-15 11:41:29', '2011-07-07', 'المحل', 'عماد شرف', 'م. طلال', 160, 160, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001447', '617175', '2011-07-12 09:23:19', '2011-07-07', 'المحل', 'زكي الجبلي', 'م. طلال', 651, 651, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001448', '617176', '2011-07-12 09:25:00', '2011-07-07', 'المحل', 'اسعد ابو حيدر', 'م. طلال', 822, 822, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001449', '617177', '2011-07-12 09:25:46', '2011-07-07', 'المحل', 'ناجي جعفر', 'م. طلال', 1178, 1178, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001450', '617178', '2011-07-12 09:26:20', '2011-07-07', 'المحل', 'عادل البزال', 'م. طلال', 1331, 1331, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001451', '617179', '2011-07-14 09:05:27', '2011-07-07', 'المحل', 'حبيب الرمح', 'م. طلال', 218, 218, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001452', '617181', '2011-07-16 08:58:46', '2011-07-07', 'محمد صلاح الدين', 'قاسم الشعار', 'م.طلعت', 744, 744, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001453', '617180', '2011-07-08 09:00:38', '2011-07-07', 'عدنان علي مظلوم/سحمر', 'احمد السيد قاسم', 'م.الحاج عدنان', 404, 404, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001454', '617191', '2011-07-15 11:34:57', '2011-07-08', 'المحل', 'الفت رؤوف', 'م. طلال', 1260, 1260, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001455', '617192', '2011-07-15 11:35:54', '2011-07-08', 'المحل', 'فوزي سمير', 'م. طلال', 859, 859, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001456', '617193', '2011-07-19 09:21:20', '2011-07-08', 'المحل', 'راجي ناجي', 'م. طلال', 1207, 1207, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001457', '617194', '2011-07-19 09:22:12', '2011-07-08', 'نزيه عليان', 'نزيه الملاح', 'م. طلال', 929, 929, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001458', '617190', '2011-07-12 09:26:56', '2011-07-08', 'المحل', 'عمار مظلوم', 'م. طلال', 393, 393, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001459', '617196', '2011-07-12 09:20:48', '2011-07-08', 'المحل', 'نبيل الرمح', 'م. طلال', 22, 22, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00');
INSERT INTO `fomaconakdi` (`IDNakdi`, `IDFacture`, `Date`, `FactureDate`, `Zaboun`, `NakdiName`, `Mandoub`, `Debit`, `Credit`, `Mashrou3`, `HasPayed`, `HasMailed`, `Note`, `UserId`, `LastUserId`, `paydate`) VALUES
('20110001460', '617197', '2011-07-12 09:21:21', '2011-07-08', 'المحل', 'ابراهيم حوري', 'م. طلال', 595, 595, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001461', '617198', '2011-07-14 09:06:43', '2011-07-08', 'المحل', 'عبدو عيتاوي', 'م. طلال', 777, 777, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001462', '617199', '2011-07-14 09:06:13', '2011-07-08', 'المحل', 'اسماعيل الميس', 'م. طلال', 717, 717, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001463', '617200', '2011-07-15 11:24:38', '2011-07-08', 'المحل', 'نعيم عمار', 'م. طلال', 983, 983, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001464', '617201', '2011-07-12 09:21:42', '2011-07-08', 'المحل', 'نبيه المكحل', 'م. طلال', 610, 610, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001465', '617202', '2011-07-12 09:22:17', '2011-07-08', 'المحل', 'قاسم علي', 'م. طلال', 748, 748, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001466', '617203', '2011-07-12 09:22:51', '2011-07-08', 'المحل', 'محمود شمص', 'م. طلال', 850, 850, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001467', '617204', '2011-07-09 09:08:04', '2011-07-08', 'سعد ابوعرابي', 'سامي الصايغ', 'م. سعد', 991, 991, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001468', '617205', '2011-07-09 08:39:32', '2011-07-08', 'الشحيمي', 'حسان الشحيمي', 'م. صالة المبيعات', 260, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001469', '617206', '2011-07-09 09:08:30', '2011-07-08', 'سعد ابوعرابي', 'سعيد مسعود', 'م. سعد', 518, 518, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001470', '617207', '2011-07-13 08:41:07', '2011-07-08', 'حكمت الجمعة', 'حكيم عباس', 'م. حكمت', 330, 330, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001471', '617231', '2011-07-19 09:23:07', '2011-07-09', 'محسن فقيه', 'محسن حلاوي', 'م. طلال', 780, 780, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001472', '617232', '2011-07-19 09:26:55', '2011-07-09', 'محسن فقيه', 'ريمون فياض', 'م. طلال', 663, 663, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001473', '617237', '2011-07-19 09:23:50', '2011-07-09', 'المحل', 'حامد حمودي', 'م. طلال', 800, 800, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001474', '617238', '2011-07-19 09:24:23', '2011-07-09', 'المحل', 'بلال حامد', 'م. طلال', 961, 961, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001475', '617239', '2011-07-19 09:24:55', '2011-07-09', 'المحل', 'كاظم محمد', 'م. طلال', 938, 938, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001476', '617240', '2011-07-19 09:25:29', '2011-07-09', 'المحل', 'عبد حمعة', 'م. طلال', 895, 895, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001477', '617241', '2011-07-19 09:26:19', '2011-07-09', 'المحل', 'ايمان شكر', 'م. طلال', 30, 30, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001478', '617224', '2011-07-19 09:31:11', '2011-07-09', 'المحل', 'ميلاد كلاس', 'م. طلال', 1122, 1122, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001479', '617225', '2011-07-19 09:31:51', '2011-07-09', 'المحل', 'يوسف عبدالله', 'م. طلال', 1039, 1039, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001480', '617226', '2011-07-19 09:32:28', '2011-07-09', 'المحل', 'اكرم الدبس', 'م. طلال', 1129, 1129, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001481', '617227', '2011-07-19 11:05:16', '2011-07-09', 'المحل', 'احسان شاهين', 'م. طلال', 875, 875, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001482', '617228', '2011-07-19 09:33:09', '2011-07-09', 'المحل', 'راغب زيدان', 'م. طلال', 317, 317, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001483', '617229', '2011-07-19 09:33:45', '2011-07-09', 'المحل', 'توفيف الرمح', 'م. طلال', 713, 713, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001484', '617230', '2011-07-19 09:34:39', '2011-07-09', 'المحل', 'نصري اللقيس', 'م. طلال', 813, 813, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001485', '617233', '2011-07-19 11:04:10', '2011-07-09', 'المحل', 'محسن فقيه', 'م. طلال', 148, 148, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001486', '617235', '2011-07-19 09:53:59', '2011-07-09', 'المحل', 'حسن شرف', 'م. طلال', 28, 28, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001487', '617236', '2011-07-19 09:35:42', '2011-07-09', 'المحل', 'هيثم بزي', 'م. طلال', 35, 35, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001488', '617242', '2011-07-23 11:05:37', '2011-07-09', 'البيت الذهبي', 'حاتم دلول', 'م. عامر بو جخ', 451, 451, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001489', '617243', '2011-07-13 08:41:34', '2011-07-09', 'حكمت الجمعة', 'زاهي بحصون', 'م. حكمت', 182, 182, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001490', '617258', '2011-07-19 09:27:20', '2011-07-11', 'حلباوي للصناعة والتجارة', 'محمد حنينو', 'م. طلال', 1063, 1063, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001491', '617259', '2011-07-19 09:27:48', '2011-07-11', 'حلباوي للصناعة والتجارة', 'كريم كرم', 'م. طلال', 722, 722, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001492', '617260', '2011-07-19 09:28:14', '2011-07-11', 'حلباوي للصناعة والتجارة', 'جاد العبد الصالح', 'م. طلال', 1333, 1333, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001493', '617274', '2011-07-19 09:28:39', '2011-07-11', 'المحل', 'فايز أحمد', 'م. طلال', 310, 310, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001494', '617257', '2011-07-15 10:04:05', '2011-07-11', 'عدنان علي مظلوم', 'فوزي مظلوم', 'م.الحاج عدنان', 222, 222, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001495', '617261', '2011-07-14 08:59:19', '2011-07-11', 'المحل', 'موريس معلوف', 'م. طلال', 709, 709, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001496', '617262', '2011-07-15 11:42:23', '2011-07-11', 'المحل', 'حمدي عيتاوي', 'م. طلال', 946, 946, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001497', '617263', '2011-07-19 09:37:45', '2011-07-11', 'المحل', 'محمود المذبوح', 'م. طلال', 1283, 1283, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001498', '617264', '2011-07-19 09:38:33', '2011-07-11', 'المحل', 'علي حمية', 'م. طلال', 708, 708, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001499', '617265', '2011-07-19 10:41:42', '2011-07-11', 'المحل', 'عادل مخ', 'م. طلال', 1091, 1091, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001500', '617270', '2011-07-19 09:39:01', '2011-07-11', 'المحل', 'نواف حوماني', 'م. طلال', 1069, 1069, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001501', '617273', '2011-07-19 09:52:57', '2011-07-11', 'المحل', 'صبحي سليمان', 'م. طلال', 855, 855, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001502', '617275', '2011-07-12 11:09:28', '2011-07-11', 'سعد ابوعرابي', 'سعد شرف', 'م. سعد', 80, 80, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001503', '617276', '2011-07-12 11:11:25', '2011-07-11', 'وليد الجناني', 'ملحم السيد', 'م.الجناني', 420, 420, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001504', '617299', '2011-07-19 10:42:13', '2011-07-12', 'محمد غروب', 'غياث الشيخ علي', 'م. طلال', 841, 841, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001505', '617290', '2011-07-21 08:54:41', '2011-07-12', 'المحل', 'شادي العطار', 'م. طلال', 726, 726, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001506', '617291', '2011-07-21 08:55:20', '2011-07-12', 'المحل', 'بشير الجوهري', 'م. طلال', 593, 593, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001507', '617292', '2011-07-21 09:01:55', '2011-07-12', 'المحل', 'صادق محفوظ', 'م. طلال', 1104, 1104, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001508', '617293', '2011-07-21 09:02:36', '2011-07-12', 'المحل', 'زاهر ناصر', 'م. طلال', 809, 809, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001509', '617294', '2011-07-21 09:03:06', '2011-07-12', 'المحل', 'يونس عبد الساتر', 'م. طلال', 477, 477, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001510', '617295', '2011-07-21 09:03:33', '2011-07-12', 'المحل', 'اسماعيل بلوق', 'م. طلال', 626, 626, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001511', '617297', '2011-07-19 09:54:51', '2011-07-12', 'المحل', 'حازم المولى', 'م. طلال', 734, 734, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001512', '617298', '2011-07-19 09:56:12', '2011-07-12', 'المحل', 'اكرم احمد', 'م. طلال', 673, 673, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001513', '617301', '2011-07-19 12:44:37', '2011-07-12', 'ابو عبدو', 'شكيب حاوي', 'م. أبو عبدو', 1098, 1098, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001514', '617303', '2011-07-27 09:01:33', '2011-07-12', 'محمد صلاح الدين', 'كميل الحمصي', 'م.طلعت', 1164, 1164, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001515', '617320', '2011-07-21 09:10:40', '2011-07-13', 'الفجر', 'سمير الزيز', 'م. طلال', 950, 950, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001516', '617318', '2011-07-21 09:11:38', '2011-07-13', 'الفجر', 'فداء عيتاني', 'م. طلال', 876, 876, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001517', '617322', '2011-07-21 09:12:07', '2011-07-13', 'المحل', 'ايهاب صادق', 'م. طلال', 1378, 1378, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001518', '617323', '2011-07-21 09:12:33', '2011-07-13', 'المحل', 'دانيال عيد', 'م. طلال', 984, 984, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001519', '617319', '2011-07-15 10:04:34', '2011-07-13', 'عدنان علي مظلوم', 'نعيم طليس', 'م.الحاج عدنان', 404, 404, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001520', '617321', '2011-07-19 12:46:14', '2011-07-13', 'ابو عبدو', 'ميلاد مظلوم', 'م. أبو عبدو', 114, 114, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001521', '617324', '2011-07-14 11:28:59', '2011-07-13', 'وليد الجناني', 'بسام عساف', 'م.الجناني', 974, 974, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001522', '617325', '2011-07-19 09:57:09', '2011-07-13', 'المحل', 'انطوان ابي نادر', 'م. طلال', 1154, 1154, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001523', '617326', '2011-07-19 09:57:49', '2011-07-13', 'المحل', 'حمودة الريس', 'م. طلال', 976, 976, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001524', '617327', '2011-07-19 09:58:15', '2011-07-13', 'المحل', 'غسان الحاج احمد', 'م. طلال', 374, 374, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001525', '617328', '2011-07-21 09:04:02', '2011-07-13', 'المحل', 'ايلي مشعلاني', 'م. طلال', 1055, 1055, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001526', '617329', '2011-07-21 09:04:44', '2011-07-13', 'المحل', 'ادهم المولى', 'م. طلال', 1030, 1030, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001527', '617330', '2011-07-21 09:05:28', '2011-07-13', 'المحل', 'هلال منصور', 'م. طلال', 1173, 1173, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001528', '617331', '2011-07-21 09:05:55', '2011-07-13', 'المحل', 'وليم رحمة', 'م. طلال', 1036, 1036, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001529', '617332', '2011-07-19 09:59:01', '2011-07-13', 'المحل', 'جان فرحة', 'م. طلال', 1061, 1061, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001530', '617333', '2011-07-19 16:08:53', '2011-07-13', 'المحل', 'جهاد بستاني', 'م. طلال', 790, 790, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001531', '617347', '2011-07-21 08:50:21', '2011-07-13', 'حلباوي للصناعة والتجارة', 'احمد قصير', 'م. طلال', 374, 374, 'Mattat', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001532', '617348', '2011-07-18 09:44:55', '2011-07-13', 'سعد ابوعرابي', 'سامي شبلي', 'م. سعد', 131, 131, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001533', '617349', '2011-07-16 08:57:25', '2011-07-13', 'حكمت الجمعة', 'احمد محمد العلي', 'م. حكمت', 437, 437, 'Sponge', 1, 1, '', '20110000006', '', '0000-00-00 00:00:00'),
('20110001534', '617368', '2011-07-20 09:46:23', '2011-07-14', 'المحل', 'سامر جبر', 'م. طلال', 888, 888, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001535', '617367', '2011-07-20 09:46:58', '2011-07-14', 'المحل', 'هلال محمد', 'م. طلال', 862, 862, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001536', '617371', '2011-07-20 09:47:23', '2011-07-14', 'هيثم بزي', 'هيثم حريق', 'م. طلال', 822, 822, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001553', '617381', '2011-07-26 09:02:42', '2011-07-14', 'عدنان علي مظلوم', 'عفاف مظلوم', 'م.الحاج عدنان', 370, 370, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001538', '617354', '2011-07-19 12:45:05', '2011-07-14', 'ابو عبدو', 'ابراهيم الوس', 'م. أبو عبدو', 216, 216, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001539', '617355', '2011-07-23 09:12:41', '2011-07-14', 'المحل', 'جميل الجسر', 'م. طلال', 1053, 1053, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001540', '617356', '2011-07-23 09:13:13', '2011-07-14', 'المحل', 'نايف الدلباني', 'م. طلال', 1275, 1275, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001541', '617357', '2011-07-23 09:13:41', '2011-07-14', 'المحل', 'حسين صلح', 'م. طلال', 1220, 1220, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001542', '617358', '2011-07-23 09:14:10', '2011-07-14', 'المحل', 'عزيز حمية', 'م. طلال', 1210, 1210, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001543', '617359', '2011-07-23 09:14:40', '2011-07-14', 'المحل', 'زهير يونس', 'م. طلال', 1263, 1263, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001544', '617360', '2011-07-23 09:15:10', '2011-07-14', 'المحل', 'عبد اللطيف شمص', 'م. طلال', 842, 842, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001545', '617361', '2011-07-23 09:15:37', '2011-07-14', 'المحل', 'عامر شرف', 'م. طلال', 697, 697, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001546', '617362', '2011-07-15 10:04:56', '2011-07-14', 'عدنان علي مظلوم', 'حافظ محمد عقيل', 'م.الحاج عدنان', 143, 143, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001547', '617363', '2011-07-23 09:16:05', '2011-07-14', 'المحل', 'نبيل منذر', 'م. طلال', 1234, 1234, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001548', '617364', '2011-07-23 09:16:38', '2011-07-14', 'المحل', 'سهيل اللقيس', 'م. طلال', 1167, 1167, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001549', '617365', '2011-07-23 09:17:15', '2011-07-14', 'المحل', 'نبيل الجمال', 'م. طلال', 1175, 1175, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001550', '617366', '2011-07-23 09:17:57', '2011-07-14', 'المحل', 'سالم الديراني', 'م. طلال', 238, 238, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001551', '617369', '2011-07-23 09:18:32', '2011-07-14', 'المحل', 'احمد قصير', 'م. طلال', 139, 139, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001552', '617378', '2011-07-18 16:36:27', '2011-07-14', 'سعد ابوعرابي', 'نبيل المصري', 'م. سعد', 364, 364, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001554', '617382', '2011-07-25 11:06:29', '2011-07-15', 'المحل', 'نضال درغام', 'م. طلال', 903, 903, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001555', '617383', '2011-07-25 11:07:04', '2011-07-15', 'المحل', 'نجيب شيرازي', 'م. طلال', 1188, 1188, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001556', '617384', '2011-07-25 11:10:37', '2011-07-15', 'المحل', 'ميلاد فغالي', 'م. طلال', 1081, 1081, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001557', '617385', '2011-07-23 10:29:09', '2011-07-15', 'المحل', 'محمود دلول', 'م. طلال', 843, 843, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001558', '617386', '2011-07-23 10:29:42', '2011-07-15', 'المحل', 'وجيه ابو زيد', 'م. طلال', 1275, 1275, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001559', '617387', '2011-07-23 10:30:11', '2011-07-15', 'المحل', 'اميل تومية', 'م. طلال', 1386, 1386, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001560', '617388', '2011-07-23 10:30:47', '2011-07-15', 'المحل', 'عبدو قضماني', 'م. طلال', 998, 998, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001561', '617389', '2011-07-23 10:32:42', '2011-07-15', 'المحل', 'محمد الهق', 'م. طلال', 1188, 1188, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001562', '617390', '2011-07-23 10:33:34', '2011-07-15', 'المحل', 'نسيم عودة', 'م. طلال', 185, 185, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001563', '617392', '2011-07-23 10:35:14', '2011-07-15', 'المحل', 'احمد هليط', 'م. طلال', 776, 776, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001564', '617393', '2011-07-23 10:34:06', '2011-07-15', 'المحل', 'ياسين خير الدين', 'م. طلال', 1241, 1241, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001565', '617394', '2011-07-23 10:34:47', '2011-07-15', 'المحل', 'هشام لبس', 'م. طلال', 1193, 1193, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001566', '617401', '2011-07-20 09:47:51', '2011-07-15', 'المحل', 'صالح رمضان', 'م. طلال', 1044, 1044, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001567', '617403', '2011-07-19 12:45:27', '2011-07-15', 'أبو عبدو', 'منير حسون', 'م. أبو عبدو', 36, 36, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001568', '617421', '2011-07-23 09:05:23', '2011-07-16', 'محمد الشامي', 'أحمد حسن', 'م. طلال', 935, 935, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001569', '617422', '2011-07-23 09:05:48', '2011-07-16', 'محمد الشامي', 'محمد جابر', 'م. طلال', 1248, 1248, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001570', '617423', '2011-07-23 09:06:13', '2011-07-16', 'محمد الشامي', 'شادي أسود', 'م. طلال', 901, 901, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001571', '617424', '2011-07-23 09:06:37', '2011-07-16', 'محمد الشامي', 'علاء الرفاعي', 'م. طلال', 856, 856, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001572', '617413', '2011-07-23 10:35:47', '2011-07-16', 'المحل', 'عثمان شعيب', 'م. طلال', 1181, 1181, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001573', '617414', '2011-07-23 10:11:52', '2011-07-16', 'المحل', 'قاسم زيتون', 'م. طلال', 1071, 1071, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001574', '617415', '2011-07-23 10:13:02', '2011-07-16', 'المحل', 'طوني كيروز', 'م. طلال', 1154, 1154, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001575', '617416', '2011-07-23 10:12:26', '2011-07-16', 'المحل', 'موسى حمدان', 'م. طلال', 1018, 1018, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001576', '617417', '2011-07-27 09:03:38', '2011-07-16', 'المحل', 'خليل الحاج موسى', 'م. طلال', 744, 744, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001577', '617418', '2011-07-27 09:04:25', '2011-07-16', 'المحل', 'طوني ميماسي', 'م. طلال', 784, 784, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001578', '617419', '2011-07-27 09:44:41', '2011-07-16', 'المحل', 'علي علي برو', 'م. طلال', 127, 127, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001579', '617425', '2011-07-27 09:05:38', '2011-07-16', 'المحل', 'حبيب خليل', 'م. طلال', 1166, 1166, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001580', '617428', '2011-07-23 10:13:38', '2011-07-16', 'المحل', 'طه عيتاني', 'م. طلال', 348, 348, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001581', '617434', '2011-07-27 09:07:22', '2011-07-16', 'المحل', 'ادهم بيضون', 'م. طلال', 1137, 1137, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001582', '617435', '2011-07-27 09:07:59', '2011-07-16', 'المحل', 'غياث مخ', 'م. طلال', 1081, 1081, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001583', '617436', '2011-07-27 09:08:24', '2011-07-16', 'المحل', 'اسعد طه', 'م. طلال', 813, 813, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001584', '617437', '2011-07-23 10:36:13', '2011-07-16', 'المحل', 'عادل سليمان', 'م. طلال', 207, 207, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001585', '617438', '2011-07-27 09:08:51', '2011-07-16', 'المحل', 'نبيه حمية', 'م. طلال', 422, 422, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001586', '617446', '2011-07-23 09:07:28', '2011-07-18', 'المحل', 'سلامة سليمان', 'م. طلال', 1048, 1048, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001587', '617447', '2011-07-23 09:07:56', '2011-07-18', 'المحل', 'ظريف الظريف', 'م. طلال', 1098, 1098, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001588', '617448', '2011-07-23 09:08:29', '2011-07-18', 'المحل', 'دريد المصري', 'م. طلال', 1336, 1336, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001589', '617449', '2011-07-23 09:09:00', '2011-07-18', 'المحل', 'ماهر حمدان', 'م. طلال', 972, 972, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001590', '617450', '2011-07-23 09:09:31', '2011-07-18', 'المحل', 'فهد السبع', 'م. طلال', 761, 761, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001591', '617459', '2011-07-27 09:22:43', '2011-07-18', 'المحل', 'دانيال أبو حمدان', 'م. طلال', 826, 826, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001592', '617458', '2011-07-27 09:23:22', '2011-07-18', 'المحل', 'رأفت الطقش', 'م. طلال', 226, 226, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001593', '617462', '2011-07-21 10:18:15', '2011-07-18', 'سعد ابوعرابي', 'مارون حنا', 'م. سعد', 105, 105, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001594', '617464', '2011-07-27 09:22:06', '2011-07-18', 'المحل', 'لؤي السبع', 'م. طلال', 959, 959, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001595', '617443', '2011-07-23 10:37:10', '2011-07-18', 'المحل', 'كاظم الحركة', 'م. طلال', 1243, 1243, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001596', '617444', '2011-07-23 10:38:27', '2011-07-18', 'المحل', 'معين الخنسا', 'م. طلال', 1473, 1473, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001597', '617445', '2011-07-29 10:09:17', '2011-07-18', 'المحل', 'احمد قصير', 'م. طلال', 138, 138, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001598', '617451', '2011-07-29 10:10:00', '2011-07-18', 'المحل', 'حكمت مكارم', 'م. طلال', 113, 113, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001599', '617452', '2011-07-26 09:16:42', '2011-07-18', 'المحل', 'جوزف مكرزل', 'م. طلال', 792, 792, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001600', '617453', '2011-07-26 09:17:03', '2011-07-18', 'المحل', 'غريب السبلاني', 'م. طلال', 1082, 1082, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001601', '617455', '2011-07-29 10:10:25', '2011-07-18', 'المحل', 'بسام ابو شاهين', 'م. طلال', 1148, 1148, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001602', '617456', '2011-07-29 10:10:52', '2011-07-18', 'المحل', 'نضال الاحمر', 'م. طلال', 1012, 1012, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001603', '617457', '2011-07-29 10:11:19', '2011-07-18', 'المحل', 'سلوى الخطيب', 'م. طلال', 796, 796, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001604', '617461', '2011-07-19 13:16:41', '2011-07-18', 'عدنان علي مظلوم سحمر', 'فارس فروخ', 'م.الحاج عدنان', 784, 784, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001605', '617463', '2011-07-21 10:17:46', '2011-07-18', 'سعد ابوعرابي', 'حنا معلوف', 'م. سعد', 416, 416, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001606', '617465', '2011-07-21 10:20:25', '2011-07-18', 'برنس', 'غادة العرة', 'م.برنس', 218, 218, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001607', '617466', '2011-07-19 13:13:44', '2011-07-18', 'وليد الجناني', 'عساف الرمح', 'م.الجناني', 191, 191, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001608', '617470', '2011-07-26 09:03:19', '2011-07-18', 'عدنان علي مظلوم', 'عبدو مظلوم', 'م.الحاج عدنان', 764, 764, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001609', '617473', '2011-07-19 12:45:51', '2011-07-18', 'أبو عبدو', 'عباس الحلاني', 'م. أبو عبدو', 108, 108, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001610', '617494', '2011-07-29 10:15:27', '2011-07-19', 'مروان ضاوي', 'فراس دلول', 'م. طلال', 890, 890, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001611', '617493', '2011-07-29 10:15:55', '2011-07-19', 'مروان ضاوي', 'مروان حمود', 'م. طلال', 948, 948, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001614', '617485', '2011-07-29 10:11:54', '2011-07-19', 'المحل', 'اكرم فواز', 'م. طلال', 961, 961, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001612', '617501', '2011-07-29 10:16:18', '2011-07-19', 'المحل', 'سمير الزيز', 'م. طلال', 1173, 1173, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001613', '617500', '2011-07-29 10:16:41', '2011-07-19', 'نزيه عليان', 'نزيه الملاح', 'م. طلال', 1058, 1058, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001615', '617486', '2011-07-29 10:12:28', '2011-07-19', 'المحل', 'عساف احمدية', 'م. طلال', 380, 380, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001616', '617487', '2011-07-23 10:40:15', '2011-07-19', 'المحل', 'حاتم قويق', 'م. طلال', 132, 132, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001617', '617488', '2011-07-29 10:12:56', '2011-07-19', 'المحل', 'زهير الحاج حسن', 'م. طلال', 869, 869, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001618', '617489', '2011-07-29 10:13:34', '2011-07-19', 'المحل', 'نواف طليس', 'م. طلال', 677, 677, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001619', '617490', '2011-07-29 10:14:04', '2011-07-19', 'المحل', 'ناجي حمية', 'م. طلال', 263, 263, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001620', '617505', '2011-07-26 09:03:54', '2011-07-19', 'عدنان علي مظلوم', 'اسعد مظلوم', 'م.الحاج عدنان', 348, 348, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001621', '617508', '2011-07-26 09:04:20', '2011-07-20', 'عدنان علي مظلوم', 'احمد طليس', 'م.الحاج عدنان', 174, 174, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001622', '617509', '2011-08-05 10:04:18', '2011-07-20', 'المحل', 'ابراهيم شمص', 'م. طلال', 243, 243, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001623', '617510', '2011-07-27 14:42:38', '2011-07-20', 'المحل', 'عطا شبلي', 'م. طلال', 474, 474, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001624', '617511', '2011-08-05 11:47:00', '2011-07-20', 'أبو عبدو', 'عادل الحلاني', 'م. أبو عبدو', 210, 210, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001625', '617515', '2011-08-08 16:08:34', '2011-07-20', 'المحل', 'سهيل شمس', 'م. طلال', 1085, 1085, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001626', '617517', '2011-08-08 16:09:16', '2011-07-20', 'المحل', 'ظافر القاق', 'م. طلال', 985, 985, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001627', '617512', '2011-07-27 14:43:14', '2011-07-20', 'المحل', 'اليان قزي', 'م. طلال', 1107, 1107, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001628', '617513', '2011-07-27 14:43:46', '2011-07-20', 'المحل', 'عماد الميس', 'م. طلال', 1194, 1194, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001629', '617514', '2011-07-27 14:44:12', '2011-07-20', 'المحل', 'تركي الغداف', 'م. طلال', 1078, 1078, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001630', '617516', '2011-07-27 14:44:48', '2011-07-20', 'المحل', 'ناجي عبد الحسين', 'م. طلال', 1121, 1121, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001631', '617518', '2011-07-23 11:06:03', '2011-07-20', 'البيت الذهبي', 'سمير عامر', 'م. عامر بو جخ', 190, 190, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001632', '617519', '2011-07-30 09:21:44', '2011-07-20', 'محمد غروب', 'غريب حمود', 'م. طلال', 588, 588, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001633', '617520', '2011-07-21 10:18:52', '2011-07-20', 'سعد ابوعرابي', 'وائل عرار', 'م. سعد', 36, 36, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001634', '617521', '2011-07-30 09:22:20', '2011-07-20', 'المحل', 'حسين شحرور', 'م. طلال', 1208, 1208, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001635', '617522', '2011-07-23 08:50:46', '2011-07-20', 'حكمت الجمعة', 'شوكت جمعة', 'م. حكمت', 204, 204, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001636', '617523', '2011-07-27 09:01:57', '2011-07-20', 'محمد صلاح الدين', 'صلاح العبد الله', 'م.طلعت', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001637', '617524', '2011-07-27 14:45:19', '2011-07-20', 'المحل', 'قاسم الحاج حسن', 'م. طلال', 261, 261, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001638', '617534', '2011-07-20 13:46:21', '2011-07-20', 'محمد صلاح الدين', 'عمر الحمصي', 'م.طلعت', 1018, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001639', '617535', '2011-08-05 10:57:36', '2011-07-20', 'البيت الذهبي', 'زاهي عمار', 'م. عامر بو جخ', 113, 113, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001640', '617543', '2011-07-30 09:22:58', '2011-07-21', 'المحل', 'رامي شريف', 'م. طلال', 535, 535, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001641', '617538', '2011-07-30 09:38:28', '2011-07-21', 'المحل', 'علي الرمح', 'م. طلال', 424, 424, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001642', '617539', '2011-07-30 09:37:00', '2011-07-21', 'المحل', 'حبيب الابيض', 'م. طلال', 1176, 1176, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001643', '617540', '2011-07-30 09:35:05', '2011-07-21', 'المحل', 'طارق سعد', 'م. طلال', 942, 942, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001644', '617541', '2011-07-30 09:35:39', '2011-07-21', 'المحل', 'طوني عبود', 'م. طلال', 1011, 1011, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001645', '617542', '2011-07-30 09:36:14', '2011-07-21', 'المحل', 'عدنان العزير', 'م. طلال', 766, 766, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001646', '617544', '2011-07-30 09:37:55', '2011-07-21', 'المحل', 'فادي فغالي', 'م. طلال', 1144, 1144, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001647', '617545', '2011-07-22 10:23:37', '2011-07-21', 'سعد ابوعرابي', 'سعد محمود', 'م. سعد', 986, 986, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001648', '617457', '2011-07-30 10:13:44', '2011-07-21', 'المحل', 'عباس سلهب', 'م. طلال', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001649', '617555', '2011-07-23 08:51:10', '2011-07-21', 'حكمت الجمعة', 'منير عثمان', 'م. حكمت', 42, 42, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001650', '617578', '2011-07-30 09:25:34', '2011-07-22', 'المحل', 'مصطفى السيد أحمد', 'م. طلال', 1235, 1235, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001651', '617576', '2011-07-30 09:23:54', '2011-07-22', 'المحل', 'جاسم حيان', 'م. طلال', 1303, 1303, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001652', '617577', '2011-07-30 09:24:53', '2011-07-22', 'المحل', 'صلاح خليل', 'م. طلال', 618, 618, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001653', '617562', '2011-07-30 09:40:50', '2011-07-22', 'المحل', 'عادل جلول', 'م. طلال', 1024, 1024, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001654', '617563', '2011-07-30 09:41:41', '2011-07-22', 'المحل', 'عباس نبها', 'م. طلال', 381, 381, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001655', '617564', '2011-07-30 09:42:05', '2011-07-22', 'المحل', 'عاصم زعيتر', 'م. طلال', 1389, 1389, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001656', '617565', '2011-07-30 09:42:33', '2011-07-22', 'المحل', 'علي يونس', 'م. طلال', 1039, 1039, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001657', '617566', '2011-07-30 09:43:03', '2011-07-22', 'المحل', 'عبد الوهاب شمص', 'م. طلال', 869, 869, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001658', '617567', '2011-07-30 09:39:29', '2011-07-22', 'المحل', 'ماجد منذر', 'م. طلال', 801, 801, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001659', '617575', '2011-07-22 10:07:09', '2011-07-22', 'محمد صلاح الدين', 'غالب الحشيمي', 'م.طلعت', 586, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001660', '617574', '2011-08-05 10:57:59', '2011-07-22', 'البيت الذهبي', 'مروان زعرور', 'م. عامر بو جخ', 101, 101, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001661', '617579', '2011-08-01 12:47:26', '2011-07-22', 'شركة سنتر بو جخ', 'عمرو الحشيمي', 'م. ديب ابو جخ', 4310, 4310, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001662', '617582', '2011-07-30 09:44:40', '2011-07-22', 'المحل', 'محمد حلباوي', 'م. طلال', 561, 561, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001663', '617583', '2011-08-03 09:17:01', '2011-07-22', 'برنس', 'فوزي محفوظ', 'م.برنس', 180, 180, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001664', '617584', '2011-08-01 16:58:35', '2011-07-22', 'شركة سنتر بو جخ', 'مروان الأمير', 'م. ديب ابو جخ', 1811, 1790, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001665', '617585', '2011-08-05 11:47:29', '2011-07-22', 'أبو عبدو', 'عبدو سمعان', 'م. أبو عبدو', 836, 836, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001666', '617588', '2011-08-03 09:18:49', '2011-07-22', 'حكمت الجمعة', 'طارق العجوز', 'م. حكمت', 322, 322, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001725', '617713', '2011-08-10 10:12:51', '2011-07-28', 'المحل', 'رامي يوسف', 'م. طلال', 653, 653, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001668', '617600', '2011-07-23 12:42:54', '2011-07-23', 'محمد صلاح الدين', 'غسان نبها', 'م.طلعت', 314, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001669', '617601', '2011-07-26 09:05:14', '2011-07-23', 'عدنان علي مظلوم/سحمر', 'فارس فارس', 'م.الحاج عدنان', 665, 665, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001670', '617623', '2011-07-30 09:26:07', '2011-07-25', 'المحل', 'محسن مهدي', 'م. طلال', 558, 558, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001671', '617616', '2011-07-30 09:45:16', '2011-07-25', 'المحل', '', 'م. طلال', 950, 950, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001672', '617617', '2011-07-30 09:46:03', '2011-07-25', 'المحل', 'حاتم البزال', 'م. طلال', 790, 790, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001673', '617618', '2011-07-30 09:46:31', '2011-07-25', 'المحل', 'زاهر علو', 'م. طلال', 697, 697, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001674', '617621', '2011-07-30 09:47:32', '2011-07-25', 'المحل', 'عادل الديراني', 'م. طلال', 1091, 1091, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001675', '617622', '2011-07-30 09:48:05', '2011-07-25', 'المحل', 'عاكف حمية', 'م. طلال', 972, 972, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001676', '617624', '2011-07-30 09:48:29', '2011-07-25', 'المحل', 'سمير سليمان', 'م. طلال', 428, 428, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001677', '617625', '2011-07-30 09:48:56', '2011-07-25', 'المحل', 'جمال الحاج حسن', 'م. طلال', 882, 882, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001678', '617626', '2011-07-30 09:50:02', '2011-07-25', 'المحل', 'نعيم صبرا', 'م. طلال', 471, 471, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001679', '617628', '2011-07-26 09:05:39', '2011-07-25', 'عدنان علي مظلوم/سحمر', 'داني سكاف', 'م.الحاج عدنان', 475, 475, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001680', '617629', '2011-07-26 09:06:02', '2011-07-25', 'عدنان علي مظلوم/سحمر', 'فارس الرمح', 'م.الحاج عدنان', 203, 203, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001681', '617634', '2011-07-29 09:12:55', '2011-07-25', 'عدنان علي مظلوم', 'كميل اسماعيل', 'م.الحاج عدنان', 261, 261, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001682', '617620', '2011-07-30 09:50:40', '2011-07-25', 'المحل', 'عادل الجمال', 'م. طلال', 915, 915, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001683', '617627', '2011-07-27 08:51:27', '2011-07-25', 'سعد ابوعرابي', 'عيد خيرالدين', 'م. سعد', 64, 64, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001684', '617640', '2011-07-30 09:53:34', '2011-07-26', 'محمد الشامي', 'عصام القاق', 'م. طلال', 113, 113, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001685', '617649', '2011-07-30 09:55:01', '2011-07-26', 'المحل', 'داني بلحص', 'م. طلال', 1071, 1071, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001686', '617648', '2011-07-30 09:54:33', '2011-07-26', 'المحل', 'بلال حمدان', 'م. طلال', 927, 927, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001687', '617647', '2011-07-30 09:54:01', '2011-07-26', 'المحل', 'حسام منير', 'م. طلال', 1333, 1333, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001688', '617638', '2011-08-05 10:03:46', '2011-07-26', 'المحل', 'محمد الشامي', 'م. طلال', 555, 555, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001689', '617639', '2011-08-05 11:47:53', '2011-07-26', 'أبو عبدو', 'عباس الحلاني', 'م. أبو عبدو', 108, 108, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001690', '617641', '2011-08-04 08:53:44', '2011-07-26', 'المحل', 'نوال قصير', 'م. طلال', 214, 214, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001691', '617642', '2011-08-04 08:54:14', '2011-07-26', 'المحل', 'احمد قصير', 'م. طلال', 344, 344, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001692', '617643', '2011-08-04 08:54:43', '2011-07-26', 'المحل', 'هيثم يوسف', 'م. طلال', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001693', '617644', '2011-08-04 08:55:26', '2011-07-26', 'المحل', 'ياسين طه', 'م. طلال', 489, 489, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001694', '617645', '2011-08-04 08:56:04', '2011-07-26', 'المحل', 'حسين طالب', 'م. طلال', 357, 357, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001695', '617668', '2011-08-08 15:52:54', '2011-07-27', 'المحل', 'تامر حسني', 'م. طلال', 253, 253, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001696', '617670', '2011-08-08 15:53:40', '2011-07-27', 'المحل', 'وسام عيد', 'م. طلال', 1020, 1020, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001697', '617671', '2011-08-08 15:54:34', '2011-07-27', 'المحل', 'فؤاد خليل', 'م. طلال', 986, 986, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001698', '617673', '2011-08-08 15:54:58', '2011-07-27', 'المحل', 'علي الأشهب', 'م. طلال', 790, 790, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001699', '617674', '2011-08-08 15:55:26', '2011-07-27', 'المحل', 'عبد الرحمن سماقة', 'م. طلال', 236, 236, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001700', '617675', '2011-08-08 15:55:53', '2011-07-27', 'المحل', 'محمد همدان', 'م. طلال', 815, 815, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001701', '617676', '2011-08-08 15:56:24', '2011-07-27', 'المحل', 'وسام الفقيه', 'م. طلال', 475, 475, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001702', '617667', '2011-08-04 08:56:32', '2011-07-27', 'المحل', 'نبيل عاصي', 'م. طلال', 716, 716, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001703', '617669', '2011-08-04 08:57:10', '2011-07-27', 'المحل', 'حسن بزي', 'م. طلال', 159, 159, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001704', '617276', '2011-08-04 08:59:45', '2011-07-27', 'المحل', 'ماجد سليمان', 'م. طلال', 26, 26, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001705', '617677', '2011-07-28 12:34:36', '2011-07-27', 'المحل', 'عصام سعد', 'م. ارقدان', 2296, 2296, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001706', '617678', '2011-07-27 10:42:07', '2011-07-27', 'نوفيل', 'سامر الجراح', 'م.نوفيل', 190, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001707', '617679', '2011-08-03 09:17:22', '2011-07-27', 'برنس', 'قاسم العرة', 'م.برنس', 170, 170, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001708', '617686', '2011-08-03 09:19:15', '2011-07-27', 'حكمت الجمعة', 'خالد سلمان', 'م. حكمت', 128, 128, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001709', '617687', '2011-07-29 09:13:29', '2011-07-27', 'عدنان علي مظلوم', 'حسني مظلوم', 'م.الحاج عدنان', 436, 436, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001710', '617698', '2011-08-03 09:19:39', '2011-07-28', 'حكمت الجمعة', 'زاهي جبق', 'م. حكمت', 339, 339, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001711', '617700', '2011-08-10 10:10:47', '2011-07-28', 'حسن غصين', 'غابي حويك', 'م. طلال', 1040, 1040, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001712', '617701', '2011-08-11 16:18:41', '2011-07-28', 'حسن غصين', 'جلال طالب', 'م. طلال', 939, 939, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001713', '617704', '2011-08-10 10:11:25', '2011-07-28', 'المحل', 'خليل قاسم', 'م. طلال', 910, 910, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001714', '617705', '2011-08-10 10:11:57', '2011-07-28', 'المحل', 'حليم كعدي', 'م. طلال', 955, 955, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001715', '617688', '2011-07-29 09:13:53', '2011-07-28', 'عدنان علي مظلوم', 'احمد مظلوم', 'م.الحاج عدنان', 202, 202, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001716', '617699', '2011-08-08 16:00:11', '2011-07-28', 'المحل', 'غالب حمية', 'م. طلال', 806, 806, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00');
INSERT INTO `fomaconakdi` (`IDNakdi`, `IDFacture`, `Date`, `FactureDate`, `Zaboun`, `NakdiName`, `Mandoub`, `Debit`, `Credit`, `Mashrou3`, `HasPayed`, `HasMailed`, `Note`, `UserId`, `LastUserId`, `paydate`) VALUES
('20110001717', '617702', '2011-08-04 08:57:53', '2011-07-28', 'المحل', 'عباس منذر', 'م. طلال', 650, 650, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001718', '617703', '2011-07-29 09:59:21', '2011-07-28', 'عدنان علي مظلوم/سحمر', 'فارس العرة', 'م.الحاج عدنان', 554, 554, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001719', '617706', '2011-08-02 08:56:31', '2011-07-28', 'السيمو', 'ابراهيم الميس', 'م. ALSEMO', 291, 291, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001720', '617707', '2011-08-05 10:58:31', '2011-07-28', 'البيت الذهبي', 'وداد محمود', 'م. عامر بو جخ', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001721', '617708', '2011-08-08 16:00:55', '2011-07-28', 'المحل', 'ايمن شرف', 'م. طلال', 261, 261, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001722', '617709', '2011-08-08 16:01:25', '2011-07-28', 'المحل', 'ظافر خشاب', 'م. طلال', 1371, 1371, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001723', '617710', '2011-08-08 16:01:52', '2011-07-28', 'المحل', 'حبيب صلح', 'م. طلال', 490, 490, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001724', '617712', '2011-08-10 10:12:20', '2011-07-28', 'المحل', 'وسيم الظريف', 'م. طلال', 688, 688, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001726', '617720', '2011-08-08 16:02:23', '2011-07-29', 'المحل', 'منير الدنا', 'م. طلال', 656, 656, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001727', '617730', '2011-08-12 16:36:40', '2011-07-29', 'توفيق بو زيد', 'زيد الحلاق', 'م. طلال', 998, 128, 'Sponge', 1, 1, '128 (مرتجع)', '20110000001', '', '0000-00-00 00:00:00'),
('20110001728', '617729', '2011-08-12 16:35:05', '2011-07-29', 'توفيق بو زيد', 'توفيق خميس', 'م. طلال', 1070, 1070, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001729', '617731', '2011-08-12 16:37:04', '2011-07-29', 'المحل', 'لما حسون', 'م. طلال', 1133, 1133, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001730', '617721', '2011-08-02 10:13:48', '2011-07-29', 'عدنان علي مظلوم', 'محمد اسماعيل', 'م.الحاج عدنان', 174, 174, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001731', '617724', '2011-08-08 16:02:50', '2011-07-29', 'المحل', 'مهدي الخطيب', 'م. طلال', 1092, 1092, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001732', '617725', '2011-08-08 16:03:28', '2011-07-29', 'المحل', 'غسان ابو ديه', 'م. طلال', 1021, 1021, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001733', '617726', '2011-08-08 16:04:05', '2011-07-29', 'المحل', 'طانوس سكاف', 'م. طلال', 917, 917, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001734', '617727', '2011-08-08 16:04:36', '2011-07-29', 'المحل', 'جهاد الحمصي', 'م. طلال', 784, 784, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001735', '617728', '2011-08-08 16:05:12', '2011-07-29', 'المحل', 'حسن الرمح', 'م. طلال', 678, 678, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001736', '617732', '2011-08-12 16:37:19', '2011-07-29', 'المحل', 'حاتم سلهب', 'م. طلال', 1121, 1121, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001737', '617738', '2011-08-05 11:48:19', '2011-07-29', 'أبو عبدو', 'علاء سويدان', 'م. أبو عبدو', 879, 879, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001738', '617748', '2011-08-12 16:37:38', '2011-07-30', 'المحل', 'عادل صابر', 'م. طلال', 512, 512, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001739', '617741', '2011-08-08 16:06:46', '2011-07-30', 'المحل', 'نادر شمص', 'م. طلال', 606, 606, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001740', '617742', '2011-08-10 10:08:54', '2011-07-30', 'المحل', 'رامز برو', 'م. طلال', 1114, 1114, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001741', '617743', '2011-08-10 10:09:42', '2011-07-30', 'المحل', 'سهيل رعد', 'م. طلال', 711, 711, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001742', '617744', '2011-08-12 16:28:48', '2011-07-30', 'المحل', 'جهاد المصري', 'م. طلال', 481, 481, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001743', '617745', '2011-08-12 16:29:13', '2011-07-30', 'المحل', 'سالم الخطيب', 'م. طلال', 157, 157, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001744', '617746', '2011-08-12 16:29:39', '2011-07-30', 'المحل', 'يوسف قاسم', 'م. طلال', 123, 123, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001745', '617750', '2011-08-05 11:48:48', '2011-07-30', 'ابو عبدو', 'طارق الوس', 'م. أبو عبدو', 108, 108, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001746', '617753', '2011-08-02 10:14:14', '2011-07-30', 'عدنان علي مظلوم', 'نواف مظلوم', 'م.الحاج عدنان', 135, 135, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001747', '617754', '2011-08-04 09:11:55', '2011-07-30', 'حكمت الجمعة', 'كميل أسمر', 'م. حكمت', 4651, 4651, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001748', '617765', '2011-08-02 10:14:36', '2011-08-01', 'عدنان علي مظلوم', 'عبد الرحمن طليس', 'م.الحاج عدنان', 1077, 1077, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001749', '617771', '2011-08-13 09:37:57', '2011-08-01', 'المحل', 'ياغي ياغي', 'م. طلال', 475, 475, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001750', '617772', '2011-08-13 09:38:26', '2011-08-01', 'المحل', 'رهام عساف', 'م. طلال', 1534, 1534, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001751', '617768', '2011-08-12 16:30:09', '2011-08-01', 'المحل', 'علي القاق', 'م. طلال', 314, 314, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001752', '617769', '2011-08-12 16:30:41', '2011-08-01', 'المحل', 'ابراهيم قصير', 'م. طلال', 822, 822, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001753', '617770', '2011-08-08 16:07:24', '2011-08-01', 'المحل', 'نضال عيتاني', 'م. طلال', 750, 750, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001754', '617782', '2011-08-12 16:31:14', '2011-08-01', 'المحل', 'رشيد طه', 'م. طلال', 917, 917, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001755', '617784', '2011-08-12 16:34:40', '2011-08-01', 'المحل', 'جوزف حداد', 'م. طلال', 638, 638, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001756', '617783', '2011-08-12 16:34:24', '2011-08-01', 'المحل', 'حازم ابو حمدان', 'م. طلال', 792, 792, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001757', '617785', '2011-08-05 15:54:16', '2011-08-01', 'عدنان علي مظلوم', 'حبيب مظلوم', 'م.الحاج عدنان', 285, 285, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001758', '617789', '2011-08-05 11:49:22', '2011-08-02', 'أبو عبدو', 'موسى الوس', 'م. أبو عبدو', 172, 172, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001759', '617773', '2011-08-04 09:10:59', '2011-08-01', 'سعد ابوعرابي', 'هاشم سيف الدين', 'م. سعد', 177, 177, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001760', '617797', '2011-08-01 16:59:27', '2011-08-02', 'عدنان علي مظلوم', 'علي خير الدين', 'م.الحاج عدنان', 190, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001761', '617752', '2011-08-05 11:49:48', '2011-08-01', 'ابو عبدو', 'سهيل الحلاني', 'م. أبو عبدو', 115, 115, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001762', '617800', '2011-08-13 09:38:50', '2011-08-02', 'المحل', 'طلال الشمالي', 'م. طلال', 196, 196, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001763', '617796', '2011-08-03 09:20:48', '2011-08-02', 'ارقدان', 'ناجي عويدات', 'م. ارقدان', 1100, 1100, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001764', '617798', '2011-08-13 09:57:16', '2011-08-02', 'المحل', 'حسين خليل', 'م. طلال', 356, 356, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001765', '617799', '2011-08-13 09:57:42', '2011-08-02', 'المحل', 'سهيل مرداس', 'م. طلال', 812, 812, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001766', '617801', '2011-08-13 09:58:09', '2011-08-02', 'المحل', 'شبلي حوماني', 'م. طلال', 814, 814, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001767', '617802', '2011-08-13 09:58:36', '2011-08-02', 'المحل', 'ناصر الخطيب', 'م. طلال', 1284, 1284, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001768', '617807', '2011-08-03 08:46:11', '2011-08-02', 'الشحيمي', 'سمعان قزي', 'م. صالة المبيعات', 60, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001769', '617808', '2011-08-05 15:55:00', '2011-08-02', 'عدنان علي مظلوم', 'جعفر مظلوم', 'م.الحاج عدنان', 515, 515, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001770', '617815', '2011-08-13 09:39:13', '2011-08-03', 'المحل', 'ايلي هارون', 'م. طلال', 1466, 1466, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001771', '617818', '2011-08-13 09:39:43', '2011-08-03', 'مروان ضاوي', 'مارون ضناوي', 'م. طلال', 1368, 1368, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001772', '617820', '2011-08-13 09:40:06', '2011-08-03', 'المحل', 'حميد ديب', 'م. طلال', 1288, 1288, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001773', '617822', '2011-08-13 09:40:30', '2011-08-03', 'المحل', 'صالح حسون', 'م. طلال', 969, 969, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001774', '617823', '2011-08-13 09:40:50', '2011-08-03', 'المحل', 'جورج سمعان', 'م. طلال', 911, 911, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001775', '617824', '2011-08-13 09:41:19', '2011-08-03', 'المحل', 'عباس خليل', 'م. طلال', 595, 595, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001776', '617827', '2011-08-13 09:41:48', '2011-08-03', 'المحل', 'رامز الملاح', 'م. طلال', 522, 522, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001777', '617828', '2011-08-13 09:44:03', '2011-08-03', 'المحل', 'وجيه الديراني', 'م. طلال', 478, 478, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001778', '617829', '2011-08-06 08:47:58', '2011-08-03', 'حكمت الجمعة', 'حسام جمعة', 'م. حكمت', 788, 788, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001779', '617830', '2011-08-04 09:11:21', '2011-08-03', 'سعد ابوعرابي', 'سعد دبوق', 'م. سعد', 32, 32, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001780', '617814', '2011-08-13 09:59:03', '2011-08-03', 'المحل', 'ابراهيم فقيه', 'م. طلال', 230, 230, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001781', '617816', '2011-08-09 10:14:27', '2011-08-03', 'عدنان علي مظلوم/سحمر', 'فراس فارس', 'م.الحاج عدنان', 582, 582, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001782', '617817', '2011-08-13 09:59:24', '2011-08-03', 'المحل', 'نوال منذر', 'م. طلال', 353, 353, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001783', '617819', '2013-05-28 14:00:29', '2011-08-03', 'المحل', 'حسني قطايا', 'م.برنس', 985, 985, 'Mattress', 1, 1, '', '20110000005', '200700000-1', '0000-00-00 00:00:00'),
('20110001784', '617821', '2011-08-13 09:53:19', '2011-08-03', 'المحل', 'حكمت مكارم', 'م. طلال', 145, 145, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001785', '617825', '2011-08-13 09:53:48', '2011-08-03', 'المحل', 'بسام الشعار', 'م. طلال', 682, 682, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001786', '617826', '2011-08-13 09:54:15', '2011-08-03', 'المحل', 'اشرف بلوق', 'م. طلال', 673, 673, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001787', '617833', '2011-08-05 11:50:12', '2011-08-03', 'ابو عبدو', 'غادة الحلاني', 'م. أبو عبدو', 57, 57, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001788', '617834', '2011-08-05 11:50:32', '2011-08-03', 'أبو عبدو', 'عدنان سلوم', 'م. أبو عبدو', 191, 191, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001789', '617843', '2011-08-09 10:15:01', '2011-08-03', 'عدنان علي مظلوم', 'عزت طليس', 'م.الحاج عدنان', 364, 364, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001790', '617845', '2011-08-04 16:15:17', '2011-08-03', 'اكرم عساف', 'نوح مشيك', 'م. طلال', 209, 0, 'Mattat', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001791', '617850', '2011-08-13 09:44:24', '2011-08-04', 'هيثم بزي', 'بلال مرتضى', 'م. طلال', 86, 86, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001792', '617846', '2011-08-04 11:25:46', '2011-08-04', 'المحل', 'فوزي المصري', 'م. طلال', 686, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001793', '617847', '2011-08-04 11:26:49', '2011-08-04', 'المحل', 'خالد شبلي', 'م. طلال', 936, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001794', '617848', '2011-08-13 09:54:48', '2011-08-04', 'المحل', 'طوني شلهوب', 'م. طلال', 676, 676, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001795', '617849', '2011-08-13 09:55:36', '2011-08-04', 'المحل', 'سناء محفوظ', 'م. طلال', 485, 485, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001796', '617851', '2011-08-10 12:16:33', '2011-08-04', 'وليد الجناني', 'حيان زراقط', 'م.الجناني', 1919, 1919, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001797', '617852', '2011-08-10 16:06:38', '2011-08-04', 'سعد ابوعرابي', 'احمد جابر', 'م. سعد', 845, 845, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001798', '617853', '2011-08-05 09:27:54', '2011-08-04', 'برنس', 'غالب الميس', 'م.برنس', 309, 309, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001799', '617855', '2011-08-09 10:15:29', '2011-08-04', 'عدنان علي مظلوم', 'قاسم طليس', 'م.الحاج عدنان', 261, 261, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001800', '617856', '2011-08-09 10:15:58', '2011-08-04', 'عدنان علي مظلوم', 'جميل اسماعيل', 'م.الحاج عدنان', 444, 444, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001801', '617857', '2011-08-09 10:16:24', '2011-08-04', 'عدنان علي مظلوم', 'نبيه مظلوم', 'م.الحاج عدنان', 190, 190, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001802', '617873', '2011-08-13 09:46:31', '2011-08-05', 'نزيه عليان', 'غزوات مشيك', 'م. طلال', 1224, 1224, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001803', '617871', '2011-08-13 09:56:04', '2011-08-05', 'المحل', 'منير بركات', 'م. طلال', 850, 850, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001804', '617872', '2011-08-13 09:56:33', '2011-08-05', 'المحل', 'عساف حمية', 'م. طلال', 634, 634, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001805', '617874', '2011-08-13 09:48:36', '2011-08-05', 'المحل', 'علي العزير', 'م. طلال', 1192, 1192, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001806', '617875', '2011-08-13 09:48:56', '2011-08-05', 'المحل', 'علي يونس', 'م. طلال', 1078, 1078, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001807', '617876', '2011-08-13 09:49:30', '2011-08-05', 'المحل', 'علي زعيتر', 'م. طلال', 1200, 1200, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001808', '617877', '2011-08-13 09:50:01', '2011-08-05', 'المحل', 'حسين شرف', 'م. طلال', 1010, 1010, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001809', '617878', '2011-08-05 10:11:23', '2011-08-05', 'المحل', 'جميل الحلاني', 'م. طلال', 185, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001810', '617879', '2011-08-13 09:51:08', '2011-08-05', 'المحل', 'عادل صلح', 'م. طلال', 533, 533, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001811', '617880', '2011-08-13 09:51:54', '2011-08-05', 'المحل', 'عارف سويدان', 'م. طلال', 120, 120, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001812', '617887', '2011-08-05 10:58:04', '2011-08-05', 'برنس', 'عبود ابو دية', 'م.برنس', 172, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001813', '617883', '2011-08-13 09:45:38', '2011-08-05', 'المحل', 'حاتم صبورة', 'م. طلال', 1058, 1058, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001814', '617884', '2011-08-13 09:47:10', '2011-08-05', 'المحل', 'منير السيد أحمد', 'م. طلال', 1219, 1219, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001815', '617885', '2011-08-13 09:47:33', '2011-08-05', 'المحل', 'حسن المهنا', 'م. طلال', 958, 958, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001816', '617886', '2011-08-13 09:48:14', '2011-08-05', 'المحل', 'ماهر الأسود', 'م. طلال', 900, 900, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001817', '617905', '2011-08-08 08:41:51', '2011-08-06', 'المحل', 'علي حسين حسون', 'م. طلال', 179, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001818', '617906', '2011-08-08 08:41:39', '2011-08-06', 'المحل', 'عبد الرحمن نون', 'م. طلال', 1280, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001819', '617896', '2011-08-06 10:16:54', '2011-08-06', 'المحل', 'حافظ دلول', 'م. طلال', 1040, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001820', '617896', '2011-08-12 14:37:28', '2011-08-06', 'ابو عبدو', 'زكي الوس', 'م. أبو عبدو', 293, 293, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001821', '617898', '2011-08-06 10:19:15', '2011-08-06', 'المحل', 'حازم السيد', 'م. طلال', 808, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001822', '617899', '2011-08-06 10:20:26', '2011-08-06', 'المحل', 'خالد حجيري', 'م. طلال', 813, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001823', '617900', '2011-08-06 10:21:31', '2011-08-06', 'المحل', 'ايمن راشد', 'م. طلال', 998, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001824', '617901', '2011-08-06 10:22:52', '2011-08-06', 'المحل', 'صالح الهق', 'م. طلال', 677, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001825', '617904', '2011-08-13 09:52:23', '2011-08-06', 'المحل', 'محمود البوداني', 'م. طلال', 131, 131, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001826', '617907', '2011-08-06 10:26:34', '2011-08-06', 'المحل', 'جهاد منذر', 'م. طلال', 723, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001827', '617908', '2011-08-06 10:27:45', '2011-08-06', 'المحل', 'عصام العرة', 'م. طلال', 760, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001828', '617909', '2011-08-13 09:52:49', '2011-08-06', 'المحل', 'عباس منذر', 'م. طلال', 518, 518, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001829', '617919', '2011-08-09 10:16:50', '2011-08-06', 'عدنان علي مظلوم', 'بلال اسماعيل', 'م.الحاج عدنان', 412, 412, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001830', '617922', '2011-08-12 14:37:46', '2011-08-08', 'أبو عبدو', 'وسام الديراني', 'م. أبو عبدو', 1167, 1167, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001831', '617923', '2011-08-12 14:37:59', '2011-08-08', 'أبو عبدو', 'جهاد سلمان', 'م. أبو عبدو', 40, 40, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001832', '617924', '2011-08-09 08:42:23', '2011-08-08', 'مروان ضاوي', 'ايلي رياشي', 'م. طلال', 580, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001833', '617925', '2011-08-09 08:42:28', '2011-08-08', 'المحل', 'اسامة الزين', 'م. طلال', 1290, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001834', '617928', '2011-08-10 10:07:34', '2011-08-08', 'حكمت الجمعة', 'صابر حسن', 'م. حكمت', 483, 483, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001835', '617932', '2011-08-09 10:34:12', '2011-08-08', 'سعد ابوعرابي', 'جورج الهادي', 'م. سعد', 178, 178, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001836', '617920', '2011-08-08 10:47:12', '2011-08-08', 'المحل', 'كاظم الخنسا', 'م. طلال', 584, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001837', '617921', '2011-08-08 10:59:57', '2011-08-08', 'المحل', 'خليل الدروبي', 'م. طلال', 222, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001838', '617926', '2011-08-09 10:33:44', '2011-08-08', 'سعد ابوعرابي', 'حمد الخطيب', 'م. سعد', 359, 359, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001839', '617927', '2011-08-10 16:07:26', '2011-08-08', 'سعد ابوعرابي', 'جميل سليمان', 'م. سعد', 718, 718, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001840', '617929', '2011-08-08 11:04:14', '2011-08-08', 'محمد صلاح الدين', 'احمد زريق', 'م.طلعت', 570, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001841', '617930', '2011-08-09 10:17:19', '2011-08-08', 'عدنان علي مظلوم/سحمر', 'اميل العريبي', 'م.الحاج عدنان', 280, 280, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001842', '617931', '2011-08-10 16:07:51', '2011-08-08', 'سعد ابوعرابي', 'ابراهيم سليمان', 'م. سعد', 250, 250, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001843', '617954', '2011-08-08 12:57:27', '2011-08-08', 'عدنان علي مظلوم', 'نواف مظلوم', 'م.الحاج عدنان', 166, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001844', '617960', '2011-08-10 11:02:41', '2011-08-09', 'المحل', 'رامي شعلان', 'م. طلال', 1870, 0, 'Mattat', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001845', '617963', '2011-08-10 11:02:45', '2011-08-09', 'المحل', 'سهيل عجمي', 'م. طلال', 1153, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001846', '617962', '2011-08-10 11:02:48', '2011-08-09', 'المحل', 'صلاح قمر', 'م. طلال', 925, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001847', '617967', '2011-08-10 16:08:39', '2011-08-09', 'سعد ابوعرابي', 'مصطفى عرار', 'م. سعد', 70, 70, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001848', '617966', '2011-08-10 11:02:59', '2011-08-09', 'شركة سنتر بو جخ', 'علاء ياسين', 'م. ديب ابو جخ', 1325, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001849', '617961', '2011-08-10 10:19:42', '2011-08-09', 'عدنان علي مظلوم', 'عماد عودة', 'م.الحاج عدنان', 116, 116, 'Mattress', 1, 1, 'مرتجعة', '20110000005', '', '0000-00-00 00:00:00'),
('20110001850', '617965', '2011-08-09 11:05:58', '2011-08-09', 'ارقدان', 'نادر سعد', 'م. ارقدان', 185, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001851', '617980', '2011-08-10 12:16:58', '2011-08-09', 'وليد الجناني', 'اسحق ابو شاهين', 'م.الجناني', 1146, 1146, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001852', '617983', '2011-08-12 14:38:21', '2011-08-09', 'أبو عبدو', 'صابر الحلاني', 'م. أبو عبدو', 131, 131, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001853', '617995', '2011-08-09 14:38:02', '2011-08-09', 'عدنان علي مظلوم', 'حسن طليس', 'م.الحاج عدنان', 87, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001854', '618009', '2011-08-11 09:21:09', '2011-08-10', 'سعد ابوعرابي', 'عمار الشيخ علي', 'م. سعد', 30, 30, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001855', '618010', '2011-08-11 09:20:56', '2011-08-10', 'المحل', 'رائد قمبر', 'م. طلال', 625, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001856', '618011', '2011-08-11 09:21:00', '2011-08-10', 'المحل', 'دانيال حمود', 'م. طلال', 797, 0, 'Sponge', 0, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001857', '618002', '2011-08-10 10:41:35', '2011-08-10', 'المحل', 'نبيل الخرسا', 'م. طلال', 1010, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001858', '618003', '2011-08-10 10:43:31', '2011-08-10', 'المحل', 'جميل مبارك', 'م. طلال', 1066, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001859', '618004', '2011-08-10 10:44:39', '2011-08-10', 'المحل', 'خليل الرفاعي', 'م. طلال', 998, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001860', '618005', '2011-08-10 10:46:06', '2011-08-10', 'المحل', 'علي الجمال', 'م. طلال', 1057, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001861', '618006', '2011-08-10 10:47:28', '2011-08-10', 'المحل', 'ناظم اسماعيل', 'م. طلال', 985, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001862', '618007', '2011-08-10 10:50:17', '2011-08-10', 'المحل', 'حسين العريبي', 'م. طلال', 1212, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001863', '618008', '2011-08-10 10:51:26', '2011-08-10', 'المحل', 'ماجد حمية', 'م. طلال', 845, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001864', '618012', '2011-08-10 10:52:49', '2011-08-10', 'محمد صلاح الدين', 'عادل الحمصي', 'م.طلعت', 166, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001865', '618013', '2011-08-13 08:49:11', '2011-08-10', 'سعد ابوعرابي', 'كميل السيد أحمد', 'م. حكمت', 462, 462, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001866', '618019', '2011-08-11 10:49:04', '2011-08-10', 'سعد ابوعرابي', 'اسعد الزهر', 'م. سعد', 377, 377, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001867', '618025', '2011-08-11 15:44:23', '2011-08-11', 'أحمد قصير', 'ايلي الغاوي', 'م. طلال', 374, 0, 'Mattat', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001868', '618027', '2011-08-10 16:47:05', '2011-08-11', 'المحل', 'لؤي حلبي ', 'م. طلال', 905, 0, 'Sponge', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001869', '618028', '2011-08-10 16:47:36', '2011-08-11', 'المحل', 'حنان مصطفى', 'م. طلال', 1364, 0, 'Sponge', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001870', '618029', '2011-08-10 16:48:01', '2011-08-11', 'المحل', 'خلود سمعان ', 'م. طلال', 953, 0, 'Sponge', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001871', '618022', '2011-08-11 09:17:21', '2011-08-11', 'المحل', 'ميشال تومية', 'م. طلال', 356, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001872', '618023', '2011-08-11 09:18:49', '2011-08-11', 'المحل', 'عبد المسيح معكرون', 'م. طلال', 653, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001873', '618014', '2011-08-11 09:19:52', '2011-08-11', 'المحل', 'رضا موسى', 'م. طلال', 946, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001874', '618026', '2011-08-11 09:21:40', '2011-08-11', 'المحل', 'سمير مرداس', 'م. طلال', 359, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001875', '618030', '2011-08-11 09:54:17', '2011-08-11', 'المحل', 'ايهاب منور', 'م. طلال', 1356, 0, 'Sponge', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001876', '618031', '2011-08-11 09:55:12', '2011-08-11', 'المحل', 'سمير العلي', 'م. طلال', 906, 0, 'Sponge', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001877', '618032', '2011-08-11 10:29:01', '2011-08-11', 'برنس', 'بلال قاسم', 'م.برنس', 176, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001878', '618033', '2011-08-13 08:49:17', '2011-08-11', 'حكمت الجمعة', 'جمعة جمعة', 'م. حكمت', 82, 82, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001879', '618034', '2011-08-12 14:38:37', '2011-08-11', 'أبو عبدو', 'مصطفى بو حمدان', 'م. أبو عبدو', 27, 27, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001880', '618037', '2011-08-11 12:17:27', '2011-08-11', 'عدنان علي مظلوم', 'عيسى مظلوم', 'م.الحاج عدنان', 159, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001881', '618057', '2011-08-11 15:25:58', '2011-08-12', 'اكرم عساف', 'جورج اعزان', 'م. طلال', 209, 0, 'Mattat', 0, 0, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001883', '618064', '2011-08-13 08:49:22', '2011-08-12', 'حكمت الجمعة', 'خالد خميس', 'م. حكمت', 54, 54, 'Sponge', 1, 1, '', '20110000001', '', '0000-00-00 00:00:00'),
('20110001884', '618056', '2011-08-12 11:34:10', '2011-08-12', 'عدنان علي مظلوم', 'نجيب طليس', 'م.الحاج عدنان', 591, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001885', '618058', '2011-08-12 11:35:19', '2011-08-12', 'عدنان علي مظلوم', 'حسين اسماعيل', 'م.الحاج عدنان', 202, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001886', '618059', '2011-08-12 11:37:12', '2011-08-12', 'عدنان علي مظلوم', 'غادة طليس', 'م.الحاج عدنان', 174, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001887', '618060', '2011-08-12 11:38:38', '2011-08-12', 'عدنان علي مظلوم', 'عباس سليمان', 'م.الحاج عدنان', 203, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001888', '618061', '2011-08-13 09:03:51', '2011-08-12', 'سعد ابوعرابي', 'سعد يونس', 'م. سعد', 499, 499, 'Mattress', 1, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001889', '618062', '2011-08-12 11:41:41', '2011-08-12', 'محمد صلاح الدين', 'صلاح حشيمي', 'م.طلعت', 570, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001890', '618065', '2011-08-12 11:42:53', '2011-08-12', 'المحل', 'حاتم العريس', 'م. طلال', 1023, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001891', '618066', '2011-08-12 11:44:23', '2011-08-12', 'المحل', 'حسين طالب', 'م. طلال', 929, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001892', '618067', '2011-08-12 11:45:26', '2011-08-12', 'المحل', 'طه جعفر', 'م. طلال', 1004, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001893', '618068', '2011-08-12 11:46:30', '2011-08-12', 'المحل', 'حبيب القاق', 'م. طلال', 22, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001894', '618069', '2011-08-12 11:47:35', '2011-08-12', 'المحل', 'خليل الطفيلي', 'م. طلال', 1259, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001895', '618070', '2011-08-12 11:49:28', '2011-08-12', 'المحل', 'موسى البزال', 'م. طلال', 1212, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001896', '618071', '2011-08-12 11:50:40', '2011-08-12', 'المحل', 'نعيم حمية', 'م. طلال', 1129, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001897', '618080', '2011-08-13 09:18:03', '2011-08-13', 'المحل', 'زهير فنيش', 'م. طلال', 859, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001898', '618081', '2011-08-13 09:19:10', '2011-08-13', 'المحل', 'سمعان مزهر', 'م. طلال', 1051, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001899', '618082', '2011-08-13 09:21:31', '2011-08-13', 'المحل', 'هشام فحص', 'م. طلال', 737, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001900', '618083', '2011-08-13 09:22:57', '2011-08-13', 'المحل', 'قاسم بزي', 'م. طلال', 974, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001901', '618084', '2011-08-13 09:24:05', '2011-08-13', 'المحل', 'سالم قنديل', 'م. طلال', 277, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001902', '618085', '2011-08-13 09:25:14', '2011-08-13', 'المحل', 'طوني فغالي', 'م. طلال', 940, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001903', '618087', '2011-08-13 09:26:18', '2011-08-13', 'المحل', 'عساف حوري', 'م. طلال', 1072, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20110001904', '618088', '2011-08-13 09:27:48', '2011-08-13', 'المحل', 'اسعد عساف', 'م. طلال', 903, 0, 'Mattress', 0, 1, '', '20110000005', '', '0000-00-00 00:00:00'),
('20130000000', '123456789', '2013-05-29 15:24:10', '2013-05-29', 'انا وحدي', 'تستن', 'م. أبو عبدو', 200, 200, 'Sponge', 1, 0, 'حركة تجربة رائعة', '200700000-1', '200700000-1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `fomaconakdi_mandoub`
--

CREATE TABLE IF NOT EXISTS `fomaconakdi_mandoub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Mandoub` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='المندوبين' AUTO_INCREMENT=22 ;

--
-- Dumping data for table `fomaconakdi_mandoub`
--

INSERT INTO `fomaconakdi_mandoub` (`id`, `Mandoub`) VALUES
(1, 'م. ALSEMO'),
(2, 'م. أبو عبدو'),
(3, 'م. ارقدان'),
(4, 'م. حكمت'),
(5, 'م. ديب ابو جخ'),
(6, 'م. سعد'),
(7, 'م. صالة المبيعات'),
(8, 'م. طلال'),
(9, 'م. عامر بو جخ'),
(10, 'م. لؤي'),
(11, 'م.الجناني'),
(12, 'م.الحاج عدنان'),
(13, 'م.برنس'),
(14, 'م.طحان'),
(15, 'م.طلعت'),
(16, 'م.نوفيل');

-- --------------------------------------------------------

--
-- Table structure for table `fomaconakdi_permissions`
--

CREATE TABLE IF NOT EXISTS `fomaconakdi_permissions` (
  `UserId` varchar(11) NOT NULL,
  `EditOwn` int(1) NOT NULL COMMENT ' 1 = can''t edit',
  `Delete` int(1) NOT NULL,
  `New` int(1) NOT NULL,
  `Search` int(1) NOT NULL,
  `editIDFacture` int(1) NOT NULL,
  `editFactureDate` int(1) NOT NULL,
  `editDebit` int(1) NOT NULL,
  `editCredit` int(1) NOT NULL,
  `editMashrou3` int(1) NOT NULL,
  `editZaboun` int(1) NOT NULL,
  `editNakdiName` int(1) NOT NULL,
  `editMandoub` int(1) NOT NULL,
  `editNote` int(1) NOT NULL,
  `editHasPayed` int(1) NOT NULL,
  `editHasMailed` int(1) NOT NULL,
  `editDate` int(1) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='صلاحيات النقدي';

--
-- Dumping data for table `fomaconakdi_permissions`
--

INSERT INTO `fomaconakdi_permissions` (`UserId`, `EditOwn`, `Delete`, `New`, `Search`, `editIDFacture`, `editFactureDate`, `editDebit`, `editCredit`, `editMashrou3`, `editZaboun`, `editNakdiName`, `editMandoub`, `editNote`, `editHasPayed`, `editHasMailed`, `editDate`) VALUES
('20130000000', 0, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0),
('200700000-1', 0, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0),
('20070000001', 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `IdMedia` varchar(11) NOT NULL,
  `Path` text NOT NULL,
  `AddDate` datetime NOT NULL,
  `MapLocation` text NOT NULL,
  `MediaRank` varchar(11) NOT NULL,
  `MediaType` varchar(10) NOT NULL,
  `visible` int(1) NOT NULL COMMENT 'هل يستطيع مشاهدته الزوار',
  PRIMARY KEY (`IdMedia`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول المكتبة';

-- --------------------------------------------------------

--
-- Table structure for table `galleryfav`
--

CREATE TABLE IF NOT EXISTS `galleryfav` (
  `IdCmnt` varchar(11) NOT NULL,
  `IdMedia` varchar(11) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`IdCmnt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تفضيلات و تعليقات الزوار';

-- --------------------------------------------------------

--
-- Table structure for table `gallerylang`
--

CREATE TABLE IF NOT EXISTS `gallerylang` (
  `IdMedia` varchar(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `Caption` text NOT NULL,
  `Desc` longtext NOT NULL,
  `Place` text NOT NULL,
  `Tags` text NOT NULL,
  PRIMARY KEY (`IdMedia`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لغة المكتبة';

-- --------------------------------------------------------

--
-- Table structure for table `galleryparams`
--

CREATE TABLE IF NOT EXISTS `galleryparams` (
  `ThumbsWidth` int(11) NOT NULL,
  `ThumbsHeight` int(11) NOT NULL,
  `ColumsNbr` int(11) NOT NULL,
  `CellWidthMax` int(11) NOT NULL,
  `CellHeightMax` int(11) NOT NULL,
  `PrintFilenames` tinyint(1) NOT NULL,
  `ShowSlider` int(1) NOT NULL COMMENT 'عرض الصور كشرائح'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خصائص المعرض';

--
-- Dumping data for table `galleryparams`
--

INSERT INTO `galleryparams` (`ThumbsWidth`, `ThumbsHeight`, `ColumsNbr`, `CellWidthMax`, `CellHeightMax`, `PrintFilenames`, `ShowSlider`) VALUES
(200, 200, 4, 120, 160, 1, 0),
(200, 200, 4, 200, 160, 1, 0),
(200, 200, 4, 200, 160, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gballonlang`
--

CREATE TABLE IF NOT EXISTS `gballonlang` (
  `BallonId` bigint(20) NOT NULL COMMENT 'رقم البالون',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `BallonTitle` text NOT NULL COMMENT 'عنوان البالون',
  `BallonDesk` mediumtext NOT NULL COMMENT 'شرح البالون',
  PRIMARY KEY (`BallonId`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='البالون حسب اللغة';

--
-- Dumping data for table `gballonlang`
--

INSERT INTO `gballonlang` (`BallonId`, `IdLang`, `BallonTitle`, `BallonDesk`) VALUES
(20140000000, '20130000002', 'fr', ''),
(20140000000, '20120000001', 'ar', ''),
(20140000000, '20130000001', 'en', ''),
(20140000000, '20130000000', 'de', ''),
(20140000001, '20130000002', 'sdfsdfsd', ''),
(20140000001, '20120000001', 'fsdfdsf', ''),
(20140000001, '20130000001', 'fdsf', ''),
(20140000001, '20130000000', 'dsfsdfds', '');

-- --------------------------------------------------------

--
-- Table structure for table `gballons`
--

CREATE TABLE IF NOT EXISTS `gballons` (
  `BallonId` bigint(20) NOT NULL COMMENT 'رقم البالون',
  `BallonX` double NOT NULL COMMENT 'مكان البالون X',
  `BallonY` double NOT NULL COMMENT 'مكان البالون Y',
  `BallonIcon` text NOT NULL COMMENT 'ايقونة البالون',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف ؟',
  PRIMARY KEY (`BallonId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تحديد موقع على الخريطة';

--
-- Dumping data for table `gballons`
--

INSERT INTO `gballons` (`BallonId`, `BallonX`, `BallonY`, `BallonIcon`, `Deleted`) VALUES
(20140000000, 33.904616008362325, 36.042022705078125, '', ''),
(20140000001, 33.95816914781237, 35.877227783203125, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `googlemap`
--

CREATE TABLE IF NOT EXISTS `googlemap` (
  `key` text NOT NULL COMMENT 'كود جوجل',
  `MapWidth` int(11) NOT NULL COMMENT 'عرض الخريطة',
  `MapHeight` int(11) NOT NULL COMMENT 'طول الخريطة',
  `EarthX` double NOT NULL COMMENT 'مكان الخريطة x',
  `EarthY` double NOT NULL COMMENT 'مكان الخريطة y',
  `MapType` varchar(10) NOT NULL COMMENT 'نوع الخريطة',
  `Altitude` tinyint(4) NOT NULL COMMENT 'الارتفاع عن الارض بين 18 و 1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خريطة جوجل';

--
-- Dumping data for table `googlemap`
--

INSERT INTO `googlemap` (`key`, `MapWidth`, `MapHeight`, `EarthX`, `EarthY`, `MapType`, `Altitude`) VALUES
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 450, 500, 33.7273735538486, 35.9298849105835, 'SATELLITE', 17),
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, 33.896464, 36.049158, 'SATELLITE', 17),
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, 33.896464, 36.049158, 'SATELLITE', 17),
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, 33.896464, 36.049158, 'SATELLITE', 17),
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, 33.896464, 36.049158, 'SATELLITE', 17),
('ABQIAAAAOA-7jCA1PY7HQKgVwPLXYBRi_j0U6kJrkFvY4-OX2XYmEAa76BTFPHZUW9AVP-svFJ8Gqx2ZkCdWQA', 600, 600, 33.896464, 36.049158, 'SATELLITE', 17);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `GroupName` varchar(15) NOT NULL COMMENT 'اسم المجموعة',
  `Desc` varchar(50) NOT NULL COMMENT 'شرح المجموعة',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف؟',
  UNIQUE KEY `GroupId` (`GroupId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='مجموعات المستخدمين';

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupId`, `GroupName`, `Desc`, `Deleted`) VALUES
('20070000000', 'Guests', 'الزوار عادة يكون لهم صلاحية القراءة فقط', ''),
('20070000001', 'Users', 'المستخدمين المسجلين', ''),
('200700000-1', 'Admins', 'المدراء', ''),
('20140000000', 'يبليبل', 'لربالبا ءيبيء بيب يب', '');

-- --------------------------------------------------------

--
-- Table structure for table `gsearch`
--

CREATE TABLE IF NOT EXISTS `gsearch` (
  `URL` varchar(7) NOT NULL COMMENT 'لون الرابط',
  `Border` varchar(7) NOT NULL COMMENT 'لون الحدود',
  `VisitedURL` varchar(7) NOT NULL COMMENT 'لون الروابط التي تم زيارتها',
  `Background` varchar(7) NOT NULL COMMENT 'لون الخلفية',
  `LogoBackground` varchar(7) NOT NULL COMMENT 'لون خلفية اللوغو',
  `Title` varchar(7) NOT NULL COMMENT 'لون العنوان',
  `Text` varchar(7) NOT NULL COMMENT 'لون النص',
  `LightURL` varchar(7) NOT NULL COMMENT 'لون الرابط الفاتح',
  `clientKey` varchar(50) NOT NULL COMMENT 'مفتاح رخصة الموقع',
  `target` varchar(15) NOT NULL COMMENT 'هل سيفتح بنفس المستعرض ؟'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='البحث عبر خدمة جوجل';

--
-- Dumping data for table `gsearch`
--

INSERT INTO `gsearch` (`URL`, `Border`, `VisitedURL`, `Background`, `LogoBackground`, `Title`, `Text`, `LightURL`, `clientKey`, `target`) VALUES
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window'),
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window'),
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window'),
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window'),
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window'),
('3399FF', '336699', '3399FE', 'F5F5F5', '06457a', '3399FF', '000000', '0000FF', 'pub-9756194919174825', 'google_window');

-- --------------------------------------------------------

--
-- Table structure for table `hst_order_details`
--

CREATE TABLE IF NOT EXISTS `hst_order_details` (
  `RecordId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'عداد الجدول',
  `OrderId` varchar(11) NOT NULL COMMENT 'رقم الطلب التابع له',
  `Code` varchar(100) NOT NULL,
  `Service` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Unit` varchar(100) NOT NULL,
  `Price` float NOT NULL,
  `Duration` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `AutoRenew` tinyint(1) NOT NULL,
  `LineNumber` smallint(6) NOT NULL COMMENT 'رقم السطر بالطلب',
  PRIMARY KEY (`RecordId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `hst_order_details`
--

INSERT INTO `hst_order_details` (`RecordId`, `OrderId`, `Code`, `Service`, `Description`, `Unit`, `Price`, `Duration`, `Total`, `Quantity`, `AutoRenew`, `LineNumber`) VALUES
(1, '20120000000', 'DMNCOM', ' Domain ', 'Register sdfdfdsf453455.com', 'Year', 12.6, 3, 37.8, 1, 1, 0),
(2, '20120000000', 'HSTADV', ' Hosting ', 'Advanced hosting package ', 'Month', 9, 36, 324, 1, 1, 1),
(3, '20120000000', 'SPRTSTD', 'Support', 'Standard Support for  : Register%20sdfdfdsf453455.com', 'Year', 347.2, 2, 694.4, 1, 1, 2),
(4, '20120000000', 'DMNCOM', ' Domain ', 'Register sdfdsf324324.com', 'Year', 11.4, 5, 57, 1, 1, 0),
(5, '20120000000', 'HSTADV', ' Hosting ', 'Advanced hosting package ', 'Month', 7.99, 60, 479.4, 1, 1, 1),
(6, '20120000001', 'DMNCOM', ' Domain ', 'Register sdsadsadsadsadsadasd.com', 'Year', 11.4, 5, 57, 1, 1, 0),
(7, '20120000001', 'HSTADV', ' Hosting ', 'Advanced hosting package ', 'Month', 7.99, 60, 479.4, 1, 1, 1),
(8, '20120000001', 'SPRTSTD', 'Support', 'Standard Support for  : Register%20sdsadsadsadsadsadasd.com', 'Year', 365, 1, 365, 1, 1, 2),
(9, '20120000002', 'DMNCOM', ' Domain ', 'Register sadq34x2343423.com', 'Year', 11.4, 5, 57, 1, 1, 0),
(10, '20120000002', 'HSTADV', ' Hosting ', 'Advanced hosting package ', 'Month', 7.99, 60, 479.4, 1, 1, 1),
(11, '20120000003', 'DMNCOM', ' Domain ', 'Register sfservvrerew34.com', 'Year', 11.4, 5, 57, 1, 1, 0),
(12, '20120000003', 'HSTADV', ' Hosting ', 'Advanced hosting package ', 'Month', 7.99, 60, 479.4, 1, 1, 1),
(13, '20120000004', 'DMNCOM', ' Domain ', 'Register fbgfdsgdsfgrtg43t345.com', 'Year', 11.4, 5, 57, 1, 1, 0),
(14, '20120000004', 'HSTPLS', ' Hosting ', 'Plus hosting package ', 'Month', 11.99, 60, 719.4, 1, 1, 1),
(15, '20120000004', 'SPRTSTD', 'Support', 'Standard Support for  : Register%20fbgfdsgdsfgrtg43t345.com', 'Year', 365, 1, 365, 1, 1, 2),
(16, '20130000000', 'SPRTSTD', '', 'Standard Support for  : gdhfgh.com', '', 0, 1, 365, 1, 1, 0),
(17, '20130000002', 'SPRTSTD', 'Support', 'Standard Support for  : ftjfgh.com', 'Year', 365, 1, 365, 1, 1, 0),
(18, '20130000003', 'SPRTSTD', 'Support', 'Standard Support for  : ghjkhh', 'Year', 365, 1, 365, 1, 1, 0),
(19, '20130000004', 'HSTPLS', ' Hosting ', 'Plus hosting package ', 'Month', 11.99, 60, 719.4, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hst_order_head`
--

CREATE TABLE IF NOT EXISTS `hst_order_head` (
  `OrderId` varchar(11) NOT NULL COMMENT 'رقم الطلب',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `ComCode` varchar(11) NOT NULL COMMENT 'رقم كومسيون المبيعات',
  `OrderDate` datetime NOT NULL COMMENT 'تاريخ الطلب',
  `TotalOriginalPrice` float NOT NULL COMMENT 'القيمة الاصلية',
  `Discount` float NOT NULL COMMENT 'الحسم',
  `PriceWithDiscount` float NOT NULL COMMENT 'القيمة الصافية',
  `Currency` varchar(3) NOT NULL,
  `secrect_code` varchar(32) NOT NULL COMMENT 'رقم سري لتاكيد عملية القبض مع مع رقم الطلب ',
  `is_invoice` tinyint(1) NOT NULL COMMENT 'هل اصبح فاتورة و قبضت؟',
  `pay_method` varchar(2) NOT NULL COMMENT 'طريقة الدفع كريديت كارد او كاش ...',
  `receipt_number` varchar(11) NOT NULL COMMENT 'رقم ايصال القبض',
  `cclink` text NOT NULL COMMENT 'لنك الشراء عبر الكريديت كارد',
  PRIMARY KEY (`OrderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hst_order_head`
--

INSERT INTO `hst_order_head` (`OrderId`, `UserId`, `ComCode`, `OrderDate`, `TotalOriginalPrice`, `Discount`, `PriceWithDiscount`, `Currency`, `secrect_code`, `is_invoice`, `pay_method`, `receipt_number`, `cclink`) VALUES
('20120000000', '200700000-1', 'Q2NDGZZM', '2012-12-20 05:55:59', 536.4, 15, 521.4, 'USD', '1F6A990F112EE9EB40DC8C512CC3D562', 0, 'CK', '20120000000', 'https://www.2checkout.com/checkout/purchase?&demo=Y&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20120000000&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=1F6A990F112EE9EB40DC8C512CC3D562&li_0_type=product&li_0_product_id=DMNCOM&li_0_name=Register sdfdsf324324.com (5 Year) &li_0_description= Domain &li_0_quantity=1&li_0_price=57&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year&li_1_type=product&li_1_product_id=HSTADV&li_1_name=Advanced hosting package  (60 Month) &li_1_description= Hosting &li_1_quantity=1&li_1_price=464.4&li_1_tangible=N&li_1_recurrence=Year&li_1_duration=1 Year'),
('20120000001', '200700000-1', 'Q2NDGZZM', '2012-12-20 06:18:08', 901.4, 30, 871.4, 'USD', '88E5158315A3C24FA36B952D9115B3AF', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&demo=Y&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20120000001&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=88E5158315A3C24FA36B952D9115B3AF&li_0_type=product&li_0_product_id=DMNCOM&li_0_name=Register sdsadsadsadsadsadasd.com (5 Year) &li_0_description= Domain &li_0_quantity=1&li_0_price=57&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year&li_1_type=product&li_1_product_id=HSTADV&li_1_name=Advanced hosting package  (60 Month) &li_1_description= Hosting &li_1_quantity=1&li_1_price=464.4&li_1_tangible=N&li_1_recurrence=Year&li_1_duration=1 Year&li_2_type=product&li_2_product_id=SPRTSTD&li_2_name=Standard Support for  : Register%20sdsadsadsadsadsadasd.com (1 Year) &li_2_description=Support&li_2_quantity=1&li_2_price=350&li_2_tangible=N&li_2_recurrence=Year&li_2_duration=1 Year'),
('20120000002', '200700000-1', 'Q2NDGZZM', '2012-12-20 06:24:40', 536.4, 15, 521.4, 'USD', '8458E1056ED2C8D0EB459AE1F55BB425', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&demo=Y&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20120000002&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=8458E1056ED2C8D0EB459AE1F55BB425&li_0_type=product&li_0_product_id=DMNCOM&li_0_name=Register sadq34x2343423.com (5 Year) &li_0_description= Domain &li_0_quantity=1&li_0_price=57&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year&li_1_type=product&li_1_product_id=HSTADV&li_1_name=Advanced hosting package  (60 Month) &li_1_description= Hosting &li_1_quantity=1&li_1_price=464.4&li_1_tangible=N&li_1_recurrence=Year&li_1_duration=1 Year'),
('20120000003', '200700000-1', 'Q2NDGZZM', '2012-12-20 06:29:09', 536.4, 15, 521.4, 'USD', 'AB1E997C88D65A55E6203BBEEE976735', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&demo=Y&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20120000003&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=AB1E997C88D65A55E6203BBEEE976735&li_0_type=product&li_0_product_id=DMNCOM&li_0_name=Register sfservvrerew34.com (5 Year) &li_0_description= Domain &li_0_quantity=1&li_0_price=57&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year&li_1_type=product&li_1_product_id=HSTADV&li_1_name=Advanced hosting package  (60 Month) &li_1_description= Hosting &li_1_quantity=1&li_1_price=464.4&li_1_tangible=N&li_1_recurrence=Year&li_1_duration=1 Year'),
('20120000004', '200700000-1', 'Q2NDGZZM', '2012-12-20 06:33:47', 1141.4, 30, 1111.4, 'USD', 'A8E4D792DC10A7BC7120DD4D82CD0BAC', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&demo=Y&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20120000004&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=A8E4D792DC10A7BC7120DD4D82CD0BAC&li_0_type=product&li_0_product_id=DMNCOM&li_0_name=Register fbgfdsgdsfgrtg43t345.com (5 Year) &li_0_description= Domain &li_0_quantity=1&li_0_price=57&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year&li_1_type=product&li_1_product_id=HSTPLS&li_1_name=Plus hosting package  (60 Month) &li_1_description= Hosting &li_1_quantity=1&li_1_price=704.4&li_1_tangible=N&li_1_recurrence=Year&li_1_duration=1 Year&li_2_type=product&li_2_product_id=SPRTSTD&li_2_name=Standard Support for  : Register%20fbgfdsgdsfgrtg43t345.com (1 Year) &li_2_description=Support&li_2_quantity=1&li_2_price=350&li_2_tangible=N&li_2_recurrence=Year&li_2_duration=1 Year'),
('20130000000', '200700000-1', 'Q2NDGZZM', '2013-02-02 10:27:13', 365, 0, 365, 'USD', '2344B305471892E8744FF1D72BC5EC2C', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20130000000&Prog=hosting&hst=Complete&pay_method=CC&first_name=Guest&last_name=family&street_address=None&street_address2=None&city=None&country=US&phone=None&email=None&secrect_code=2344B305471892E8744FF1D72BC5EC2C&li_0_type=product&li_0_product_id=SPRTSTD&li_0_name=Standard Support for  : gdhfgh.com (1 ) &li_0_description=&li_0_quantity=1&li_0_price=365&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year'),
('20130000001', '20130000000', 'Q2NDGZZM', '2013-02-02 10:33:03', 0, 0, 0, 'USD', '6FCDB58633350CC2FAB9669AA0D15455', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20130000001&Prog=hosting&hst=Complete&pay_method=CC&first_name=dvdvcvcv&last_name=cxvcxvcvcxv&street_address=&street_address2=&city=&country=xx&phone=&email=zxcxzc@xcvcxv.com&secrect_code=6FCDB58633350CC2FAB9669AA0D15455'),
('20130000002', '200700000-1', 'Q2NDGZZM', '2013-02-02 10:36:18', 365, 15, 350, 'USD', 'B91F248D723561615C8693B3EF650DF9', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20130000002&Prog=hosting&hst=Complete&pay_method=CC&first_name=dvdvcvcv&last_name=cxvcxvcvcxv&street_address=cxv&street_address2=cxvcx&city=vcxv&country=cxvc&phone=vcxv&email=zxcxzc@xcvcxv.com&secrect_code=B91F248D723561615C8693B3EF650DF9&li_0_type=product&li_0_product_id=SPRTSTD&li_0_name=Standard Support for  : ftjfgh.com (1 Year) &li_0_description=Support&li_0_quantity=1&li_0_price=350&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year'),
('20130000003', '200700000-1', 'Q2NDGZZM', '2013-02-05 09:59:13', 365, 15, 350, 'USD', '02A2680A59974C32A27CB2E273DD8E9D', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://localhost/index.php&lang=en&mode=2CO&merchant_order_id=20130000003&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=02A2680A59974C32A27CB2E273DD8E9D&li_0_type=product&li_0_product_id=SPRTSTD&li_0_name=Standard Support for  : ghjkhh (1 Year) &li_0_description=Support&li_0_quantity=1&li_0_price=350&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year'),
('20130000004', '200700000-1', '', '2013-02-19 11:10:29', 719.4, 0, 719.4, 'USD', '0F47CB30AD422F1F7BD0EA93878A3B88', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://phptransformer.com/release/Prog-hosting_hst-Complete.pt&lang=en&mode=2CO&merchant_order_id=20130000004&Prog=hosting&hst=Complete&pay_method=CC&first_name=admin&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=AI&phone=sdf&email=user@phptransformer.com&secrect_code=0F47CB30AD422F1F7BD0EA93878A3B88&li_0_type=product&li_0_product_id=HSTPLS&li_0_name=Plus hosting package  (60 Month) &li_0_description= Hosting &li_0_quantity=1&li_0_price=719.4&li_0_tangible=N&li_0_recurrence=Year&li_0_duration=1 Year'),
('20130000005', '200700000-1', '', '2013-02-19 11:34:33', 0, 0, 0, 'USD', '913F07C74CB507D5497ECA9308327CC7', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://phptransformer.com/release/Prog-hosting_hst-Complete.pt&lang=en&mode=2CO&merchant_order_id=20130000005&Prog=hosting&hst=Complete&pay_method=CC&first_name=شششششش&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=JO&phone=sdf&email=user@phptransformer.com&secrect_code=913F07C74CB507D5497ECA9308327CC7'),
('20130000006', '200700000-1', '', '2013-02-19 11:36:29', 0, 0, 0, 'USD', 'D4EBB74A12F1A20D15B99D0BDB574805', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://phptransformer.com/release/Prog-hosting_hst-Complete.pt&lang=en&mode=2CO&merchant_order_id=20130000006&Prog=hosting&hst=Complete&pay_method=CC&first_name=شششششش&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=JO&phone=sdf&email=user@phptransformer.com&secrect_code=D4EBB74A12F1A20D15B99D0BDB574805'),
('20130000007', '200700000-1', '', '2013-02-19 11:38:43', 0, 0, 0, 'USD', 'E03E860CA3AC53DD540F76876AE3F360', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://phptransformer.com/release/Prog-hosting_hst-Complete.pt&lang=en&mode=2CO&merchant_order_id=20130000007&Prog=hosting&hst=Complete&pay_method=CC&first_name=شششششش&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=JO&phone=sdf&email=user@phptransformer.com&secrect_code=E03E860CA3AC53DD540F76876AE3F360'),
('20130000008', '200700000-1', '', '2013-02-19 11:42:34', 0, 0, 0, 'USD', 'C9CADF99F11A433E54B3E0CE5045FEB6', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://phptransformer.com/release/Prog-hosting_hst-Complete.pt&lang=en&mode=2CO&merchant_order_id=20130000008&Prog=hosting&hst=Complete&pay_method=CC&first_name=شششششش&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=JO&phone=sdf&email=user@phptransformer.com&secrect_code=C9CADF99F11A433E54B3E0CE5045FEB6'),
('20130000009', '200700000-1', '', '2013-02-19 11:45:46', 0, 0, 0, 'USD', '5233F2220965A3CAD85243768FFE19BF', 0, '', '', 'https://www.2checkout.com/checkout/purchase?&sid=1911888&x_receipt_link_url=http://phptransformer.com/release/Prog-hosting_hst-Complete.pt&lang=en&mode=2CO&merchant_order_id=20130000009&Prog=hosting&hst=Complete&pay_method=CC&first_name=شششششش&last_name=admin&street_address=sdf&street_address2=sfddf&city=beiruth&country=JO&phone=sdf&email=user@phptransformer.com&secrect_code=5233F2220965A3CAD85243768FFE19BF');

-- --------------------------------------------------------

--
-- Table structure for table `hst_partners`
--

CREATE TABLE IF NOT EXISTS `hst_partners` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `StartDate` datetime NOT NULL COMMENT 'تاريخ بدء التعامل',
  `ComCode` varchar(11) NOT NULL COMMENT 'رمز التخفيض',
  `PartComForm` text NOT NULL COMMENT 'فورميلا احتساب العمولة',
  `CustDiscForm` text NOT NULL COMMENT 'فورميلا احتساب حسم الزبون',
  UNIQUE KEY `ComCode` (`ComCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شركاء تسويق البرنامج';

--
-- Dumping data for table `hst_partners`
--

INSERT INTO `hst_partners` (`UserId`, `StartDate`, `ComCode`, `PartComForm`, `CustDiscForm`) VALUES
('200700000-1', '2010-05-31 09:29:36', 'Q2NDGZZM', '60|p*8/100', '60|p-15'),
('20110000015', '2011-09-12 11:37:57', 'JKMTG5ND', '50', '15'),
('20110000016', '2011-09-12 11:43:24', 'A3MTDKM2', '50', '15'),
('20120000006', '2012-02-07 14:35:55', 'FKNWZMMT', '0', '365');

-- --------------------------------------------------------

--
-- Table structure for table `hst_partners_transaction`
--

CREATE TABLE IF NOT EXISTS `hst_partners_transaction` (
  `TransId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ComCode` varchar(11) NOT NULL,
  `OrderId` varchar(11) NOT NULL,
  `Transdate` datetime NOT NULL,
  `Ammount` float NOT NULL,
  `Invoiced` tinyint(1) NOT NULL,
  `Payed` tinyint(1) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`TransId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Dumping data for table `hst_partners_transaction`
--

INSERT INTO `hst_partners_transaction` (`TransId`, `ComCode`, `OrderId`, `Transdate`, `Ammount`, `Invoiced`, `Payed`, `Description`) VALUES
(1, 'Q2NDGZZM', '20120000000', '2012-09-27 07:17:17', 48.352, 0, 0, ''),
(2, 'Q2NDGZZM', '20120000001', '2012-09-27 08:24:32', 48.352, 0, 0, ''),
(3, 'Q2NDGZZM', '20120000002', '2012-09-27 08:47:07', 48.352, 0, 0, ''),
(4, 'Q2NDGZZM', '20120000003', '2012-09-27 08:47:37', 48.352, 0, 0, ''),
(5, 'Q2NDGZZM', '20120000004', '2012-09-27 08:48:13', 48.352, 0, 0, ''),
(6, 'Q2NDGZZM', '20120000005', '2012-09-27 08:48:24', 48.352, 0, 0, ''),
(7, 'Q2NDGZZM', '20120000006', '2012-09-27 09:33:18', 48.352, 0, 0, ''),
(8, 'Q2NDGZZM', '20120000007', '2012-09-27 10:09:01', 48.352, 0, 0, ''),
(9, 'Q2NDGZZM', '20120000008', '2012-09-28 07:01:17', 48.352, 0, 0, ''),
(10, 'Q2NDGZZM', '20120000009', '2012-09-29 07:13:44', 48.352, 0, 0, ''),
(11, 'Q2NDGZZM', '20120000010', '2012-10-10 05:46:33', 19.152, 0, 0, ''),
(12, 'Q2NDGZZM', '20120000011', '2012-10-11 08:39:37', 38.352, 0, 0, ''),
(13, 'Q2NDGZZM', '20120000012', '2012-10-16 06:11:05', 29.2, 0, 0, ''),
(14, 'Q2NDGZZM', '20120000013', '2012-10-16 12:34:06', 0, 0, 0, ''),
(15, 'Q2NDGZZM', '20120000014', '2012-10-16 12:49:02', 0, 0, 0, ''),
(16, 'Q2NDGZZM', '20120000015', '2012-10-16 12:49:28', 0, 0, 0, ''),
(17, 'Q2NDGZZM', '20120000016', '2012-10-16 12:50:48', 0, 0, 0, ''),
(18, 'Q2NDGZZM', '20120000017', '2012-10-16 12:53:16', 0, 0, 0, ''),
(19, 'Q2NDGZZM', '20120000018', '2012-10-16 12:54:36', 0, 0, 0, ''),
(20, 'Q2NDGZZM', '20120000019', '2012-10-16 13:07:41', 0, 0, 0, ''),
(21, 'Q2NDGZZM', '20120000020', '2012-10-16 13:13:20', 0, 0, 0, ''),
(22, 'Q2NDGZZM', '20120000021', '2012-10-16 13:21:54', 0, 0, 0, ''),
(23, 'Q2NDGZZM', '20120000022', '2012-10-16 13:37:34', 0, 0, 0, ''),
(24, 'Q2NDGZZM', '20120000023', '2012-10-16 13:43:45', 0, 0, 0, ''),
(25, 'Q2NDGZZM', '20120000024', '2012-10-16 13:49:11', 0, 0, 0, ''),
(26, 'Q2NDGZZM', '20120000025', '2012-10-16 13:52:40', 0, 0, 0, ''),
(27, 'Q2NDGZZM', '20120000026', '2012-10-16 13:53:51', 0, 0, 0, ''),
(28, 'Q2NDGZZM', '20120000027', '2012-11-01 12:51:37', 147.184, 0, 0, ''),
(29, 'Q2NDGZZM', '20120000028', '2012-11-01 12:52:49', 147.184, 0, 0, ''),
(30, 'Q2NDGZZM', '20120000029', '2012-11-01 12:55:13', 147.184, 0, 0, ''),
(31, 'Q2NDGZZM', '20120000030', '2012-11-01 13:00:29', 147.184, 0, 0, ''),
(32, 'Q2NDGZZM', '20120000031', '2012-11-01 13:05:30', 147.184, 0, 0, ''),
(33, 'Q2NDGZZM', '20120000032', '2012-11-01 13:08:32', 147.184, 0, 0, ''),
(34, 'Q2NDGZZM', '20120000033', '2012-11-01 13:14:04', 147.184, 0, 0, ''),
(35, 'Q2NDGZZM', '20120000034', '2012-11-01 13:15:58', 147.184, 0, 0, ''),
(36, 'Q2NDGZZM', '20120000035', '2012-11-01 13:21:05', 48.352, 0, 0, ''),
(37, 'Q2NDGZZM', '20120000036', '2012-11-01 13:21:47', 48.352, 0, 0, ''),
(38, 'Q2NDGZZM', '20120000037', '2012-11-01 14:13:35', 38.352, 0, 0, ''),
(39, 'Q2NDGZZM', '20120000038', '2012-11-01 14:17:15', 38.352, 0, 0, ''),
(40, 'Q2NDGZZM', '20120000039', '2012-11-10 09:55:22', 19.152, 0, 0, ''),
(41, 'Q2NDGZZM', '20120000043', '2012-11-19 09:24:58', 19.152, 0, 0, ''),
(42, 'Q2NDGZZM', '20120000044', '2012-11-19 09:42:33', 48.352, 0, 0, ''),
(43, 'Q2NDGZZM', '20120000045', '2012-11-20 06:44:18', 48.352, 0, 0, ''),
(44, 'Q2NDGZZM', '20120000046', '2012-12-18 10:09:31', 0, 0, 0, ''),
(45, 'Q2NDGZZM', '20120000046', '2012-12-18 10:09:31', 48.352, 0, 0, ''),
(46, 'Q2NDGZZM', '20120000046', '2012-12-18 10:09:31', 48.352, 0, 0, ''),
(47, 'Q2NDGZZM', '20120000047', '2012-12-18 10:11:18', 48.352, 0, 0, ''),
(48, 'Q2NDGZZM', '20120000048', '2012-12-18 10:17:47', 48.352, 0, 0, ''),
(49, 'Q2NDGZZM', '20120000049', '2012-12-18 10:21:26', 48.352, 0, 0, ''),
(50, 'Q2NDGZZM', '20120000050', '2012-12-18 10:23:37', 48.352, 0, 0, ''),
(51, 'Q2NDGZZM', '20120000051', '2012-12-18 10:25:33', 48.352, 0, 0, ''),
(52, 'Q2NDGZZM', '20120000052', '2012-12-18 11:44:34', 48.352, 0, 0, ''),
(53, 'Q2NDGZZM', '20120000053', '2012-12-18 11:45:53', 48.352, 0, 0, ''),
(54, 'Q2NDGZZM', '20120000054', '2012-12-18 11:47:06', 48.352, 0, 0, ''),
(55, 'Q2NDGZZM', '20120000055', '2012-12-18 11:47:42', 48.352, 0, 0, ''),
(56, 'Q2NDGZZM', '20120000056', '2012-12-18 11:49:37', 48.352, 0, 0, ''),
(57, 'Q2NDGZZM', '20120000057', '2012-12-18 11:50:10', 48.352, 0, 0, ''),
(58, 'Q2NDGZZM', '20120000058', '2012-12-18 11:50:31', 48.352, 0, 0, ''),
(59, 'Q2NDGZZM', '20120000059', '2012-12-18 11:54:19', 48.352, 0, 0, ''),
(60, 'Q2NDGZZM', '20120000060', '2012-12-18 11:58:12', 48.352, 0, 0, ''),
(61, 'Q2NDGZZM', '20120000061', '2012-12-18 12:00:54', 48.352, 0, 0, ''),
(62, 'Q2NDGZZM', '20120000062', '2012-12-18 12:01:35', 48.352, 0, 0, ''),
(63, 'Q2NDGZZM', '20120000063', '2012-12-18 12:02:30', 48.352, 0, 0, ''),
(64, 'Q2NDGZZM', '20120000064', '2012-12-18 12:04:39', 48.352, 0, 0, ''),
(65, 'Q2NDGZZM', '20120000065', '2012-12-18 12:07:06', 48.352, 0, 0, ''),
(66, 'Q2NDGZZM', '20120000066', '2012-12-18 12:08:53', 48.352, 0, 0, ''),
(67, 'Q2NDGZZM', '20120000067', '2012-12-18 12:14:09', 48.352, 0, 0, ''),
(68, 'Q2NDGZZM', '20120000068', '2012-12-18 12:17:04', 48.352, 0, 0, ''),
(69, 'Q2NDGZZM', '20120000069', '2012-12-18 12:17:57', 48.352, 0, 0, ''),
(70, 'Q2NDGZZM', '20120000070', '2012-12-18 12:18:51', 48.352, 0, 0, ''),
(71, 'Q2NDGZZM', '20120000071', '2012-12-18 12:20:12', 48.352, 0, 0, ''),
(72, 'Q2NDGZZM', '20120000072', '2012-12-18 12:22:58', 48.352, 0, 0, ''),
(73, 'Q2NDGZZM', '20120000073', '2012-12-18 12:23:50', 48.352, 0, 0, ''),
(74, 'Q2NDGZZM', '20120000074', '2012-12-18 12:26:53', 48.352, 0, 0, ''),
(75, 'Q2NDGZZM', '20120000075', '2012-12-18 12:32:54', 48.352, 0, 0, ''),
(76, 'Q2NDGZZM', '20120000076', '2012-12-18 12:34:54', 60.352, 0, 0, ''),
(77, 'Q2NDGZZM', '20120000077', '2012-12-18 12:37:13', 68.512, 0, 0, ''),
(78, 'Q2NDGZZM', '20120000078', '2012-12-18 12:40:19', 68.512, 0, 0, ''),
(79, 'Q2NDGZZM', '20120000079', '2012-12-18 12:42:56', 68.512, 0, 0, ''),
(80, 'Q2NDGZZM', '20120000080', '2012-12-18 12:44:17', 68.512, 0, 0, ''),
(81, 'Q2NDGZZM', '20120000081', '2012-12-18 12:44:58', 68.512, 0, 0, ''),
(82, 'Q2NDGZZM', '20120000082', '2012-12-18 12:57:52', 68.512, 0, 0, ''),
(83, 'Q2NDGZZM', '20120000083', '2012-12-20 05:46:50', 81.472, 0, 0, ''),
(84, 'Q2NDGZZM', '20120000000', '2012-12-20 05:53:33', 81.472, 0, 0, ''),
(85, 'Q2NDGZZM', '20120000000', '2012-12-20 05:55:59', 38.352, 0, 0, ''),
(86, 'Q2NDGZZM', '20120000001', '2012-12-20 06:18:08', 67.552, 0, 0, ''),
(87, 'Q2NDGZZM', '20120000002', '2012-12-20 06:24:40', 38.352, 0, 0, ''),
(88, 'Q2NDGZZM', '20120000003', '2012-12-20 06:29:09', 38.352, 0, 0, ''),
(89, 'Q2NDGZZM', '20120000004', '2012-12-20 06:33:47', 86.752, 0, 0, ''),
(90, 'Q2NDGZZM', '20130000000', '2013-02-02 10:27:13', 0, 0, 0, ''),
(91, 'Q2NDGZZM', '20130000001', '2013-02-02 10:33:03', 0, 0, 0, ''),
(92, 'Q2NDGZZM', '20130000002', '2013-02-02 10:36:18', 29.2, 0, 0, ''),
(93, 'Q2NDGZZM', '20130000003', '2013-02-05 09:59:13', 29.2, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `hst_Registrant`
--

CREATE TABLE IF NOT EXISTS `hst_Registrant` (
  `UserId` varchar(11) NOT NULL,
  `LastUpdate` datetime NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `OrganizationName` varchar(255) NOT NULL,
  `StreetAddress` varchar(255) NOT NULL,
  `Address2` varchar(255) NOT NULL,
  `JobTitle` varchar(255) NOT NULL,
  `City` varchar(50) NOT NULL,
  `StateProv` varchar(50) NOT NULL,
  `ZipPostalCode` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `EMailAddress` varchar(1024) NOT NULL,
  `PhoneNumber` varchar(50) NOT NULL,
  `FaxNumber` varchar(50) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hst_Registrant`
--

INSERT INTO `hst_Registrant` (`UserId`, `LastUpdate`, `FirstName`, `LastName`, `OrganizationName`, `StreetAddress`, `Address2`, `JobTitle`, `City`, `StateProv`, `ZipPostalCode`, `Country`, `EMailAddress`, `PhoneNumber`, `FaxNumber`) VALUES
('200700000-1', '2013-02-19 11:45:46', 'شششششش', 'admin', 'IT', 'sdf', 'sfddf', 'Administrator', 'beiruth', 'kl;l', 'jo;j;l', 'JO', 'user@phptransformer.com', 'sdf', ';lk;lk;');

-- --------------------------------------------------------

--
-- Table structure for table `ipbanned`
--

CREATE TABLE IF NOT EXISTS `ipbanned` (
  `idip` double NOT NULL AUTO_INCREMENT COMMENT ' رقم الطرد',
  `ipStart` varchar(15) NOT NULL COMMENT 'بداية الايبي',
  `ipEnd` varchar(15) NOT NULL COMMENT 'نهاية الايبي',
  `reason` varchar(256) NOT NULL COMMENT 'السبب',
  `date` datetime NOT NULL COMMENT 'التاريخ',
  PRIMARY KEY (`idip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='طرد الزوار المزعجين' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `LangName` varchar(15) NOT NULL COMMENT 'اسم اللغة',
  `Hits` varchar(7) NOT NULL COMMENT 'احصائيات',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل اللغة محذوفة؟',
  UNIQUE KEY `IdLang` (`IdLang`),
  UNIQUE KEY `LangName` (`LangName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='اللغات';

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`IdLang`, `LangName`, `Hits`, `Deleted`) VALUES
('20120000001', 'Arabic', '9529', '0'),
('20130000001', 'English', '1167', '1'),
('20140000000', 'Francais', '2', '1'),
('20140000001', 'Deutsch', '13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE IF NOT EXISTS `letters` (
  `idLetter` varchar(11) CHARACTER SET utf8 NOT NULL COMMENT 'رقم الرسالة',
  `LatterName` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT 'اسم الرسالة',
  `Deleted` varchar(1) CHARACTER SET utf8 NOT NULL COMMENT 'هل هو محذوف؟',
  PRIMARY KEY (`idLetter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci COMMENT='الرسائل النموذجية';

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`idLetter`, `LatterName`, `Deleted`) VALUES
('20130000000', 'سيسشي', ''),
('20130000001', 'تابز', ''),
('20130000002', 'fchfghgh', '');

-- --------------------------------------------------------

--
-- Table structure for table `letterslang`
--

CREATE TABLE IF NOT EXISTS `letterslang` (
  `idLetter` varchar(11) NOT NULL COMMENT 'رقم الرسالة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `TitleLetter` varchar(256) NOT NULL COMMENT 'عنوان الرسالة',
  `BodyLetter` longtext NOT NULL COMMENT 'الرسالة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='رسائل نموذجية';

--
-- Dumping data for table `letterslang`
--

INSERT INTO `letterslang` (`idLetter`, `IdLang`, `TitleLetter`, `BodyLetter`) VALUES
('20130000000', '20120000000', 'engliziye', '<p>english</p>'),
('20130000000', '20120000001', 'رسالة عربية', '<p>عربي</p>'),
('20130000000', '20120000002', 'franci', '<p>francais</p>'),
('20130000000', '20130000000', 'almani', '<p>germany</p>'),
('20130000001', '20120000000', 'ئءؤءئؤ', '<p>ئءؤءئؤ</p>'),
('20130000001', '20120000001', 'ئءؤءؤ', '<p>ئءؤئءؤ</p>'),
('20130000001', '20120000002', 'ئءؤءئؤ', '<p>ءئؤءئؤ</p>'),
('20130000001', '20130000000', 'ئءؤءئؤ', '<p>ءئؤئءؤءئؤ</p>'),
('20130000002', '20120000001', 'vghfgch', '<p>gvhgvh</p>'),
('20130000002', '20130000001', 'ghgvh', '<p>ghgvfh</p>'),
('20130000002', '20130000000', 'ghgvfh', '<p>vghgvh</p>');

-- --------------------------------------------------------

--
-- Table structure for table `mainmenu`
--

CREATE TABLE IF NOT EXISTS `mainmenu` (
  `IdMM` varchar(11) NOT NULL COMMENT 'رقم العنصر في الائحة',
  `Link` varchar(256) NOT NULL COMMENT 'الرابط',
  `Target` varchar(256) NOT NULL COMMENT 'وجهة النك',
  `Order` int(2) NOT NULL COMMENT 'ترتيبه من الاعلى',
  `External` varchar(1) NOT NULL COMMENT 'هل هذا الرابط خارجي؟',
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الصفحة المرتبطة بها ',
  UNIQUE KEY `IdMM` (`IdMM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='عناصر الائحة الرئيسية';

--
-- Dumping data for table `mainmenu`
--

INSERT INTO `mainmenu` (`IdMM`, `Link`, `Target`, `Order`, `External`, `IdPage`) VALUES
('20100000000', 'Prog-pages_pagenbr-1_Lang-English_nl-1.pt', '', 1, '0', '20100000001'),
('20120000000', 'ddfdsf', 'sdfdsf', 2, '0', ''),
('20120000001', '', '', 3, '0', ''),
('20120000002', 'Prog-pages_pagenbr-2_Lang-English_nl-1.pt', '', 4, '0', '20120000000'),
('20130000000', 'index.php?Prog=pages&pagenbr=3&Lang=Arabic&nl=1', '', 5, '0', '20130000000'),
('20130000001', 'https://localhost/phptransformer/Prog-pages_pagenbr-5_Lang-Arabic_nl-1.pt', '', 6, '0', '20130000002'),
('20130000002', 'index.php?Prog=pages&pagenbr=6&Lang=Arabic&nl=1', '', 7, '0', '20130000003'),
('20130000003', 'index.php?Prog=pages&pagenbr=7&Lang=Arabic&nl=1', '', 8, '0', '20130000004'),
('20130000005', 'index.php?Prog=pages&pagenbr=9&Lang=Arabic&nl=1', '', 10, '0', '20130000006'),
('20130000006', 'http://192.168.0.103/phptransformer/Prog-pages_pagenbr-2_Lang-Arabic_nl-1.pt', '', 11, '0', '20130000001'),
('20130000007', 'http://192.168.0.103/phptransformer/Prog-pages_pagenbr-3_Lang-Arabic_nl-1.pt', '', 12, '0', '20130000002'),
('20130000008', 'http://localhost/phptransformer/Prog-pages_pagenbr-4_Lang-Arabic_nl-1.pt', '', 13, '0', '20130000003'),
('20130000009', 'http://localhost/phptransformer/Prog-pages_pagenbr-5_Lang-English_nl-1.pt', '', 14, '0', '20130000004'),
('20130000010', 'http://localhost/phptransformer/Prog-pages_pagenbr-6_Lang-Arabic_nl-1.pt', '', 15, '0', '20130000005'),
('20130000011', 'http://localhost/phptransformer/Prog-pages_pagenbr-7_Lang-Arabic_nl-1.pt', '', 16, '0', '20130000006'),
('20140000000', 'http://localhost/phptransformer/Prog-pages_pagenbr-8_Lang-Arabic_nl-1.pt', '', 17, '0', '20140000000'),
('20140000001', 'http://localhost/phptransformer/Prog-pages_pagenbr-9_Lang-English_nl-1.pt', '', 18, '0', '20140000001'),
('20140000002', 'index.php?Prog=pages&pagenbr=10&Lang=English&nl=1', '', 19, '0', '20140000002'),
('20140000003', 'index.php?Prog=pages&pagenbr=11&Lang=Arabic&nl=1', '', 20, '0', '20140000003'),
('20140000004', 'http://localhost/phptransformer/Prog-pages_pagenbr-12_Lang-Arabic_nl-1.pt', '', 21, '0', '20140000004'),
('20140000005', 'http://localhost/phptransformer/Prog-pages_pagenbr-13_Lang-Arabic_nl-1.pt', '', 22, '0', '20140000005'),
('20140000006', 'http://localhost/phptransformer/Prog-pages_pagenbr-14_Lang-Arabic_nl-1.pt', '', 23, '0', '20140000006'),
('20140000007', 'http://localhost/phptransformer/Prog-pages_pagenbr-15_Lang-Arabic_nl-1.pt', '', 24, '0', '20140000007'),
('20140000008', 'http://localhost/phptransformer/Prog-pages_pagenbr-16_Lang-Arabic_nl-1.pt', '', 25, '0', '20140000008');

-- --------------------------------------------------------

--
-- Table structure for table `marqlang`
--

CREATE TABLE IF NOT EXISTS `marqlang` (
  `idmarque` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `idLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `Message` text NOT NULL COMMENT 'الرسالة',
  UNIQUE KEY `idmarque` (`idmarque`,`idLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شريط الاخبار حسب اللغة';

--
-- Dumping data for table `marqlang`
--

INSERT INTO `marqlang` (`idmarque`, `idLang`, `Message`) VALUES
('20120000000', '20070000001', 'عنوان الخبر'),
('20120000001', '20070000001', 'عنوان الخبر الذي قمت بادخاله الان'),
('20120000002', '20070000001', 'sadsad'),
('20120000003', '20070000001', 'شسيبيشس سش قثبل ااتناتن ت ات لا لا لا'),
('20120000003', '20120000000', 'dsfdf dfdsf dsf bn,kl hl uhktf dfgdfg'),
('20120000004', '20070000001', 'asdasd'),
('20120000004', '20120000000', 'asdasdasdasd'),
('20120000005', '20120000000', 'drhdhghgfh'),
('20120000006', '20120000000', 'cbn hjghjhjkgjklkjllkjlymuiknyui'),
('20120000007', '20120000000', 'lhllhljlkj'),
('20120000007', '20120000001', 'البلاتالتاللتالتالا'),
('20120000007', '20120000002', 'dsaadsa ghf f'),
('20120000008', '20120000000', 'sasadsadsadsa dsad sad '),
('20120000008', '20120000001', 'سيبيسبيسب يب يبيس بي بيب '),
('20120000008', '20120000002', 'asdsdsd sds ad sdsad '),
('20130000000', '20120000000', 'ddzfsdf'),
('20130000000', '20120000001', 'asdsad'),
('20130000000', '20120000002', 'asdsad'),
('20130000001', '20120000000', 'dsafsadsad'),
('20130000001', '20120000001', 'شسيسشيسشي '),
('20130000001', '20120000002', 'يسشبسيبسشيب'),
('20130000002', '20120000000', 'asdsad'),
('20130000002', '20120000001', 'asdasd'),
('20130000002', '20120000002', 'asdsad'),
('20130000003', '20120000000', 'nnnnnn'),
('20130000003', '20120000001', 'nnnnnnnnnnnnn'),
('20130000003', '20120000002', 'nnnnnnnnnnnn'),
('20130000004', '20120000000', 'nnnnnn'),
('20130000004', '20120000001', 'nnnnnnnnnnnnn'),
('20130000004', '20120000002', 'nnnnnnnnnnnn'),
('20130000005', '20120000000', 'sdsadsad'),
('20130000005', '20120000001', 'sadsad'),
('20130000005', '20120000002', 'sadsad'),
('20130000006', '20120000000', 'english english english english english english english english english english '),
('20130000006', '20120000001', 'عربي عربي عربي عربي عربي عربي عربي عربي عربي عربي عربي عربي '),
('20130000006', '20120000002', 'FRANCAIS FRANCAIS FRANCAIS FRANCAIS FRANCAIS FRANCAIS FRANCAIS '),
('20130000006', '20130000000', 'Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch Deutsch '),
('20130000007', '20120000000', 'sdgfdsfsd'),
('20130000007', '20120000001', 'asdsad'),
('20130000007', '20120000002', 'asdasd'),
('20130000008', '20120000000', '65756765765'),
('20130000008', '20120000001', '54645645645'),
('20130000008', '20120000002', '45345345'),
('20130000009', '20120000000', 'ASAsASAS'),
('20130000009', '20120000001', 'asAS'),
('20130000009', '20120000002', 'ASAS'),
('20130000009', '20130000000', 'AsaS'),
('20130000010', '20120000000', 'asdsad'),
('20130000010', '20120000001', 'هذه أخر خبرية'),
('20130000010', '20120000002', 'sadsa'),
('20130000011', '20120000000', 'hhhhhhhhhhhhhhh'),
('20130000011', '20120000001', 'اخبار'),
('20130000011', '20120000002', 'hanan'),
('20130000012', '20120000000', 'سيسشيسشي'),
('20130000012', '20120000001', 'شسيسشي'),
('20130000012', '20120000002', 'شسيسش'),
('20130000012', '20130000000', 'شسيسشي'),
('20130000013', '20120000001', 'almajedser'),
('20130000014', '20120000001', 'sefdsf'),
('20130000015', '20120000001', 'سيبيسب يي بيسي ب يسب يس'),
('20140000000', '20130000002', 'sdfsdf'),
('20140000000', '20120000001', 'sad sada s sad sada s sad sada s sad sada s sad sada s sad sada s sad sada s sad sada s sad sad sada s sad sada s sad sada s '),
('20140000000', '20130000001', 'sad sada s sad sada s sad sada s sad sada s sad sada s sad sada s sad sada s sad sadasad sada s sad  s sad sada s sad sada s '),
('20140000001', '20130000002', 'erwer'),
('20140000001', '20120000001', 'سيب  باللبا  حخهجح صثق شسيشس يشسي ثق فثقف قثف فقث'),
('20140000001', '20130000001', 'werwer'),
('20140000002', '20120000001', 'هذا هو عنوان الخبر الأول'),
('20140000002', '20130000001', 'this is the title news'),
('20140000003', '20120000001', 'شسبيشس شسي سشيس شي'),
('20140000003', '20130000001', 'sdf asfds fsdf'),
('20140000004', '20120000001', 'عنوان الخبر رقم 2 '),
('20140000005', '20120000001', 'عنوان الخبر رقم 3'),
('20140000006', '20120000001', 'عنوان الخبر رقم 4'),
('20140000007', '20120000001', 'عنوان الخبر رقم 5'),
('20140000008', '20120000001', 'عنوان الخبر رقم 6'),
('20140000009', '20120000001', 'عنوان الخبر رقم 7'),
('20140000010', '20120000001', 'عنوان الخبر رقم 8'),
('20140000011', '20120000001', 'عنوان الخبر رقم 9'),
('20140000012', '20120000001', 'عنوان الخبر رقم 10'),
('20140000013', '20120000001', 'عنوان الخبر رقم 11'),
('20140000014', '20120000001', 'عنوان الخبر رقم 12'),
('20140000015', '20120000001', 'عنوان الخبر رقم 13'),
('20140000016', '20120000001', 'شسيسشيسشي'),
('20140000017', '20120000001', 'شسيسشيسشي'),
('20140000018', '20120000001', 'شسيسشيسشي'),
('20140000019', '20120000001', 'شسيسشيسشي'),
('20140000020', '20120000001', 'asdsad'),
('20140000021', '20120000001', 'asdsad'),
('20140000022', '20120000001', 'asdsad'),
('20140000023', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000024', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000025', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000026', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000027', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000028', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000029', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000030', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000031', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000032', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000033', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000034', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000035', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000036', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000037', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000038', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000039', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000040', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000041', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000042', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000043', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000044', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000045', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000046', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000047', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000048', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000049', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000050', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000051', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000052', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000053', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000054', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000055', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000056', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000057', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000058', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000059', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000060', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000061', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000062', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000063', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000064', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000065', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000066', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000067', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000068', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000069', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000070', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000071', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000072', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000073', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000074', '20120000001', 'شسيسش يسشي سشي سي سشي  غعفقغقف قفقثف قثفثق قﻻؤر ﻻؤرﻻؤرﻻرؤ رﻻؤرﻻ'),
('20140000075', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000076', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000077', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000078', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000079', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000080', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000081', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000082', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000083', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000084', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000085', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000086', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000087', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000088', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000089', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000090', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000091', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000092', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000093', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000094', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000095', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000096', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000097', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000098', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000099', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000100', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000101', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000102', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000103', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000104', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000105', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000106', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000107', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000108', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000109', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000110', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000111', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000112', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000113', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000114', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000115', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000116', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000117', '20120000001', 'ؤرؤءرؤءر ؤء رؤء رؤفقغ غفثقغثقفرﻻؤرﻻرؤ ؤرﻻرؤش ص صضثضصث ضصث صضث صضث صضث رﻻ رؤ ﻻررؤﻻرؤؤرﻻ'),
('20140000118', '20120000001', 'هوبا'),
('20140000119', '20120000001', 'خحخح'),
('20140000120', '20120000001', 'wwqee'),
('20140000121', '20120000001', '234324324'),
('20140000122', '20120000001', 'عنوان : فرق / اوكي'),
('20140000122', '20130000001', 'عنوان : فرق / اوكي'),
('20140000123', '20120000001', 'عنوان / \\ فرع : اوكيشن'),
('20140000123', '20130000001', 'عنوان / \\ فرع : اوكيشن'),
('20140000124', '20120000001', '"""""'),
('20140000124', '20130000001', '""""""""""'),
('20140000125', '20120000001', 'qwq'),
('20140000125', '20130000001', 'sdfsdf'),
('20140000126', '20120000001', ''''''''''''''''''''''''''''''''''''''''''''''''''''''),
('20140000126', '20130000001', ''''''''''''''''''''''''''),
('20140000127', '20120000001', 'سلاش'),
('20140000127', '20130000001', 'mohsen\\" okay\\'' '),
('20140000128', '20120000001', ' الأخبار عربي قصف حكومي عنيف للفلوجة بعد الفشل باقتحامها القصف الحكومي تسبب بسقوط عشرات الضحايا المدنيين وبدمار واسع (أسوشيتد بر'),
('20140000128', '20130000001', 'dsad'),
('20140000129', '20120000001', 'fgfdgfdg'),
('20140000129', '20130000001', 'dfdf'),
('20140000130', '20120000001', 'asdsad'),
('20140000131', '20120000001', 'asdsad'),
('20140000132', '20120000001', 'VCXEWRE'),
('20140000133', '20120000001', 'DDSFDSF'),
('20140000134', '20120000001', 'FFDGFDGDFGDFGDFGDFG'),
('20140000135', '20120000001', 'FFDGFDGDFGDFGDFGDFG'),
('20140000136', '20120000001', 'SADSAD'),
('20140000137', '20120000001', 'dfsd'),
('20140000138', '20120000001', 'محو'),
('20140000138', '20130000001', 'محو'),
('20140000139', '20120000001', 'كي نحذقه'),
('20140000139', '20130000001', 'شسيسشي'),
('20140000140', '20120000001', 'sadsad'),
('20140000141', '20120000001', 'sadsad'),
('20140000142', '20120000001', 'sadsad'),
('20140000143', '20120000001', 'sadsad'),
('20140000144', '20120000001', 'sadsad'),
('20140000145', '20120000001', 'sadsad'),
('20140000146', '20120000001', 'sadsad'),
('20140000147', '20120000001', 'sadsad'),
('20140000148', '20120000001', 'sadsad'),
('20140000149', '20120000001', 'sadsad'),
('20140000150', '20120000001', 'sadsad'),
('20140000151', '20120000001', 'sadsad'),
('20140000152', '20120000001', 'sadsad'),
('20140000153', '20120000001', 'sadsad'),
('20140000154', '20120000001', 'sadsad'),
('20140000155', '20120000001', 'sadsad'),
('20140000156', '20120000001', 'sadsad'),
('20140000157', '20120000001', 'sadsad'),
('20140000158', '20120000001', 'sadsad'),
('20140000159', '20120000001', 'sadsad'),
('20140000160', '20120000001', 'sadsad'),
('20140000161', '20120000001', 'sadsad'),
('20140000162', '20120000001', 'sadsad'),
('20140000163', '20120000001', 'sadsad'),
('20140000164', '20120000001', 'sadsad'),
('20140000165', '20120000001', 'sadsad'),
('20140000166', '20120000001', 'sadsad'),
('20140000167', '20120000001', 'محذوف'),
('20140000168', '20120000001', 'br'),
('20140000169', '20120000001', 'gkhk'),
('20140000170', '20120000001', 'asfasd'),
('20140000171', '20120000001', 'asdsadsad'),
('20140000172', '20120000001', 'asdsadsad'),
('20140000173', '20120000001', 'asdsadsad'),
('20140000174', '20120000001', 'asdsad'),
('20140000175', '20120000001', 'sd'),
('20140000176', '20120000001', 'fjfh'),
('20140000177', '20120000001', 'SADSAD'),
('20140000178', '20120000001', 'ZSF DSF SDF DS'),
('20140000179', '20120000001', 'cxzcxzc'),
('20140000179', '20140000000', 'zxcxzc'),
('20140000180', '20120000001', 'asdasd'),
('20140000181', '20120000001', 'xzcxzcc'),
('20140000182', '20120000001', 'xzcxzcc'),
('20140000183', '20120000001', 'xzcxzcc'),
('20140000184', '20120000001', 'xzcxzcc'),
('20140000185', '20120000001', 'شسيسشي'),
('20140000186', '20120000001', 'ؤرﻻرؤﻻ'),
('20140000187', '20120000001', '٣٤٥٣٤٥٣٤٥'),
('20140000188', '20120000001', 'الاخر ٥:٤٣'),
('20140000189', '20120000001', 'الاخر ٥:٤٣'),
('20140000190', '20120000001', 'الاخر ٥:٤٣'),
('20140000191', '20120000001', 'sdsd'),
('20140000192', '20120000001', 'zcxzcxc'),
('20140000193', '20120000001', 'zcxzcxc'),
('20140000194', '20120000001', 'dfdfd'),
('20140000195', '20120000001', 'asdsad'),
('20140000196', '20120000001', 'asdsad'),
('20140000197', '20120000001', 'asdsad'),
('20140000198', '20120000001', 'asdasd'),
('20140000199', '20120000001', 'ولاشي'),
('20140000200', '20120000001', 'ابلوود'),
('20140000201', '20120000001', 'من الجاليري'),
('20140000202', '20120000001', '5:56'),
('20140000203', '20120000001', 'sdfdsfd'),
('20140000204', '20120000001', '99999999999999999999999999'),
('20140000205', '20120000001', 'سشيبسش يسي سي سشي سي سشي'),
('20140000205', '20140000001', 'dddffd fdg dfgdfg fdg fg'),
('20140000206', '20120000001', 'xoxoxoxoxoxoxoxoxo'),
('20140000206', '20140000001', 'sadasdsad'),
('20140000207', '20120000001', 'xoxoxoxoxoxoxoxoxo'),
('20140000207', '20140000001', 'sadasdsad'),
('20140000208', '20120000001', 'xoxoxoxoxoxoxoxoxo'),
('20140000208', '20140000001', 'sadasdsad'),
('20140000209', '20120000001', 'xoxoxoxoxoxoxoxoxo'),
('20140000209', '20140000001', 'sadasdsad'),
('20140000210', '20120000001', 'xoxoxoxoxoxoxoxoxo'),
('20140000210', '20140000001', 'sadasdsad'),
('20140000211', '20120000001', 'xoxoxoxoxoxoxoxoxo'),
('20140000211', '20140000001', 'sadasdsad'),
('20140000212', '20120000001', '00000000000000000000000'),
('20140000212', '20140000001', 'asdsadsa'),
('20140000213', '20120000001', 'dsfdsfds'),
('20140000213', '20140000001', 'asdfsad');

-- --------------------------------------------------------

--
-- Table structure for table `marques`
--

CREATE TABLE IF NOT EXISTS `marques` (
  `idMarque` varchar(11) NOT NULL COMMENT 'رقم الخبر ',
  `Link` varchar(256) NOT NULL COMMENT 'الرابط',
  `StartDate` datetime NOT NULL COMMENT 'تاريخ البدء',
  `EndDate` datetime NOT NULL COMMENT 'تاريخ الانتهاء',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل الخبر محذوف؟',
  `IdNews` varchar(11) NOT NULL,
  UNIQUE KEY `idMarque` (`idMarque`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شريط الاخبار';

--
-- Dumping data for table `marques`
--

INSERT INTO `marques` (`idMarque`, `Link`, `StartDate`, `EndDate`, `Deleted`, `IdNews`) VALUES
('20120000000', 'http://localhost/Prog-news_ns-details_idnews-20120000000.pt', '2012-04-23 10:12:31', '2029-12-17 00:33:32', '', ''),
('20120000001', 'http://localhost/Prog-news_ns-details_idnews-20120000000.pt', '2012-04-23 10:15:48', '2029-12-17 00:33:32', '', ''),
('20120000002', 'http://localhost/Prog-news_ns-details_idnews-20120000001.pt', '2012-05-09 11:46:01', '2029-12-17 00:33:32', '', ''),
('20120000003', 'zxd.com', '1899-11-30 00:00:00', '1899-11-30 00:00:00', '', ''),
('20120000004', 'http://localhost/Prog-news_ns-details_idnews-20120000000.pt', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('20120000005', 'http://localhost/Prog-news_ns-details_idnews-20120000000.pt', '2012-09-02 07:44:36', '2029-12-17 00:33:32', '', ''),
('20120000006', 'http://localhost/Prog-news_ns-details_idnews-20120000001.pt', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('20120000007', 'http://localhost/Prog-news_ns-details_idnews-20120000002.pt', '2012-12-29 12:08:49', '2029-12-17 00:33:32', '1', ''),
('20120000008', 'http://localhost/Prog-news_ns-details_idnews-20120000003.pt', '2012-12-03 12:37:40', '2029-12-17 00:33:32', '1', ''),
('20130000000', 'http://localhost/Prog-news_ns-details_idnews-20130000000.pt', '2012-12-19 16:53:00', '2029-12-17 00:33:32', '1', ''),
('20130000001', 'HTTP://asdsadsad.com', '2013-01-01 14:30:36', '2013-01-26 14:30:38', '1', ''),
('20130000002', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20130000000.pt', '2013-03-06 09:06:41', '2029-12-17 00:33:33', '1', ''),
('20130000003', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20130000001.pt', '2013-03-13 09:15:54', '2029-12-17 00:33:33', '1', ''),
('20130000004', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20130000002.pt', '2013-03-13 09:15:54', '2029-12-17 00:33:33', '1', ''),
('20130000005', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20130000004.pt', '2013-03-22 14:57:53', '2029-12-17 00:33:33', '1', ''),
('20130000006', '#', '2013-06-03 15:55:32', '2013-06-28 15:55:35', '', ''),
('20130000007', 'http://192.168.0.103/phptransformer/Prog-news_ns-details_idnews-20130000005.pt', '2013-03-31 05:03:33', '2013-04-06 05:04:33', '', ''),
('20130000008', 'http://192.168.0.103/phptransformer/Prog-news_ns-details_idnews-20130000006.pt', '2013-03-31 05:03:09', '2013-04-06 05:04:09', '', ''),
('20130000009', 'http://google.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('20130000010', 'index.php?Prog=news&ns=details&idnews=20130000008', '2013-06-03 01:06:00', '2013-06-10 01:06:13', '', ''),
('20130000011', 'index.php?Prog=news&ns=details&idnews=20130000009', '2013-06-04 01:06:56', '2013-06-10 01:06:56', '', ''),
('20130000012', '#', '2013-06-01 15:51:44', '2013-06-29 15:51:47', '1', ''),
('20130000013', 'http://192.168.0.103/phptransformer/Prog-news_ns-details_idnews-20130000010.pt', '2013-06-17 02:06:00', '2013-06-24 02:06:00', '', ''),
('20130000014', 'http://192.168.0.103/phptransformer/Prog-news_ns-details_idnews-20130000011.pt', '2013-07-30 09:07:26', '2013-08-05 09:08:26', '', ''),
('20130000015', 'http://192.168.0.103/phptransformer/Prog-news_ns-details_idnews-20130000012.pt', '2013-07-31 11:07:43', '2013-08-06 11:08:43', '', ''),
('20140000000', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000000.pt', '2014-01-08 02:01:23', '0000-00-00 00:00:00', '', ''),
('20140000001', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000001.pt', '2014-01-01 02:01:00', '2014-02-07 02:02:54', '', ''),
('20140000002', 'index.php?Prog=news&ns=details&idnews=20140000000', '2014-01-16 02:01:47', '0000-00-00 00:00:00', '', ''),
('20140000003', 'index.php?Prog=news&ns=details&idnews=20140000001', '2014-01-16 03:01:06', '2014-01-22 03:01:06', '', ''),
('20140000004', 'index.php?Prog=news&ns=details&idnews=20140000002', '2014-04-21 03:04:12', '2014-04-27 03:04:12', '', ''),
('20140000005', 'index.php?Prog=news&ns=details&idnews=20140000003', '2014-04-21 03:04:01', '2014-04-27 03:04:01', '', ''),
('20140000006', 'index.php?Prog=news&ns=details&idnews=20140000004', '2014-04-21 03:04:36', '2014-04-27 03:04:36', '', ''),
('20140000007', 'index.php?Prog=news&ns=details&idnews=20140000005', '2014-04-21 03:04:13', '2014-04-27 03:04:13', '', ''),
('20140000008', 'index.php?Prog=news&ns=details&idnews=20140000006', '2014-04-21 03:04:37', '2014-04-27 03:04:37', '', ''),
('20140000009', 'index.php?Prog=news&ns=details&idnews=20140000007', '2014-04-21 03:04:07', '2014-04-27 03:04:07', '', ''),
('20140000010', 'index.php?Prog=news&ns=details&idnews=20140000008', '2014-04-21 03:04:38', '2014-04-27 03:04:38', '', ''),
('20140000011', 'index.php?Prog=news&ns=details&idnews=20140000009', '2014-04-21 03:04:56', '2014-04-27 03:04:56', '', ''),
('20140000012', 'index.php?Prog=news&ns=details&idnews=20140000010', '2014-04-21 03:04:29', '2014-04-27 03:04:29', '', ''),
('20140000013', 'index.php?Prog=news&ns=details&idnews=20140000011', '2014-04-21 03:04:55', '2014-04-27 03:04:55', '', ''),
('20140000014', 'index.php?Prog=news&ns=details&idnews=20140000012', '2014-04-21 03:04:24', '2014-04-27 03:04:24', '', ''),
('20140000015', 'index.php?Prog=news&ns=details&idnews=20140000013', '2014-04-21 03:04:48', '2014-04-27 03:04:48', '', ''),
('20140000016', 'index.php?Prog=news&ns=details&idnews=20140000014', '2014-04-23 10:04:12', '2014-04-29 10:04:12', '', ''),
('20140000017', 'index.php?Prog=news&ns=details&idnews=20140000015', '2014-04-23 10:04:12', '2014-04-29 10:04:12', '', ''),
('20140000018', 'index.php?Prog=news&ns=details&idnews=20140000016', '2014-04-23 10:04:12', '2014-04-29 10:04:12', '', ''),
('20140000019', 'index.php?Prog=news&ns=details&idnews=20140000017', '2014-04-23 10:04:12', '2014-04-29 10:04:12', '', ''),
('20140000020', 'index.php?Prog=news&ns=details&idnews=20140000018', '2014-04-23 10:04:29', '2014-04-29 10:04:29', '', ''),
('20140000021', 'index.php?Prog=news&ns=details&idnews=20140000019', '2014-04-23 10:04:29', '2014-04-29 10:04:29', '', ''),
('20140000022', 'index.php?Prog=news&ns=details&idnews=20140000020', '2014-04-23 10:04:29', '2014-04-29 10:04:29', '', ''),
('20140000023', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000021.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000024', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000022.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000025', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000023.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000026', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000024.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000027', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000025.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000028', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000026.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000029', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000027.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000030', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000028.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000031', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000029.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000032', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000030.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000033', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000031.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000034', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000032.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000035', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000033.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000036', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000034.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000037', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000035.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000038', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000036.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000039', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000037.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000040', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000038.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000041', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000039.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000042', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000040.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000043', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000041.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000044', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000042.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000045', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000043.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000046', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000044.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000047', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000045.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000048', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000046.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000049', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000047.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000050', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000048.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000051', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000049.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000052', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000050.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000053', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000051.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000054', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000052.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000055', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000053.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000056', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000054.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000057', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000055.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000058', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000056.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000059', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000057.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000060', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000058.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000061', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000059.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000062', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000060.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000063', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000061.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000064', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000062.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000065', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000063.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000066', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000064.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000067', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000065.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000068', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000066.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000069', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000067.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000070', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000068.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000071', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000069.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000072', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000070.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000073', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000071.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000074', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000072.pt', '2014-04-25 07:04:59', '2014-05-01 07:05:59', '', ''),
('20140000075', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000073.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000076', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000074.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000077', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000075.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000078', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000076.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000079', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000077.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000080', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000078.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000081', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000079.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000082', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000080.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000083', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000081.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000084', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000082.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000085', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000083.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000086', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000084.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000087', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000085.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000088', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000086.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000089', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000087.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000090', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000088.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000091', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000089.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000092', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000090.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000093', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000091.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000094', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000092.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000095', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000093.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000096', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000094.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000097', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000095.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000098', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000096.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000099', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000097.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000100', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000098.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000101', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000099.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000102', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000100.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000103', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000101.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000104', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000102.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000105', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000103.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000106', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000104.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000107', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000105.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000108', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000106.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000109', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000107.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000110', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000108.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000111', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000109.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000112', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000110.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000113', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000111.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000114', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000112.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000115', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000113.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000116', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000114.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000117', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000115.pt', '2014-04-25 07:04:18', '2014-05-01 07:05:18', '', ''),
('20140000118', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000116.pt', '2014-04-25 02:04:03', '2014-05-01 02:05:03', '', ''),
('20140000119', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000116.pt', '2014-04-25 02:04:56', '2014-05-01 02:05:56', '', ''),
('20140000120', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000116.pt', '2014-04-25 02:04:49', '2014-05-01 02:05:49', '', ''),
('20140000121', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000117.pt', '2014-04-25 03:04:18', '2014-05-01 03:05:18', '', ''),
('20140000122', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000118.pt', '2014-05-07 09:05:26', '2014-05-13 09:05:26', '', ''),
('20140000123', 'http://localhost/phptransformer/Prog-cybernews_ns-details_idnews-20140000119.pt', '2014-05-07 10:05:40', '2014-05-13 10:05:40', '', ''),
('20140000124', 'http://localhost/phptransformer/Prog-cybernews_ns-details_idnews-20140000120.pt', '2014-05-07 10:05:30', '2014-05-13 10:05:30', '', ''),
('20140000125', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000122.pt', '0000-00-00 00:00:00', '2014-05-14 07:05:40', '', ''),
('20140000126', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000123.pt', '2014-05-08 09:05:26', '2014-05-14 09:05:26', '', ''),
('20140000127', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000124.pt', '2014-05-08 12:05:22', '2014-05-14 12:05:22', '', ''),
('20140000128', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000125.pt', '2014-05-10 03:05:39', '2014-05-16 03:05:39', '', ''),
('20140000129', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000126.pt', '2014-05-14 09:05:46', '2014-05-20 09:05:46', '', ''),
('20140000130', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000127.pt', '2014-05-15 16:05:16', '2014-05-21 16:05:16', '', ''),
('20140000131', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000128.pt', '2014-05-15 16:05:16', '2014-05-21 16:05:16', '', ''),
('20140000132', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000129.pt', '2014-05-15 16:05:02', '2014-05-21 16:05:02', '', ''),
('20140000133', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000130.pt', '2014-05-15 16:05:20', '2014-05-21 16:05:20', '', ''),
('20140000134', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000131.pt', '2014-05-15 16:05:14', '2014-05-21 16:05:14', '', ''),
('20140000135', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000132.pt', '2014-05-15 16:05:14', '2014-05-21 16:05:14', '', ''),
('20140000136', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000133.pt', '2014-05-15 16:05:59', '2014-05-21 16:05:59', '', ''),
('20140000137', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000134.pt', '2014-05-16 09:05:54', '2014-05-22 09:05:54', '', ''),
('20140000138', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000135.pt', '2014-05-19 10:05:51', '2014-05-25 10:05:51', '1', '20140000135'),
('20140000139', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000136.pt', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '20140000136'),
('20140000140', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000137.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000137'),
('20140000141', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000138.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000138'),
('20140000142', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000139.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000139'),
('20140000143', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000140.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000140'),
('20140000144', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000141.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000141'),
('20140000145', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000142.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000142'),
('20140000146', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000143.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000143'),
('20140000147', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000144.pt', '2014-05-19 16:05:12', '2014-05-25 16:05:12', '', '20140000144'),
('20140000148', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000145.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000145'),
('20140000149', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000146.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000146'),
('20140000150', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000147.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000147'),
('20140000151', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000148.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000148'),
('20140000152', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000149.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000149'),
('20140000153', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000150.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000150'),
('20140000154', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000151.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000151'),
('20140000155', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000152.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000152'),
('20140000156', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000153.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000153'),
('20140000157', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000154.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000154'),
('20140000158', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000155.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000155'),
('20140000159', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000156.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000156'),
('20140000160', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000157.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000157'),
('20140000161', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000158.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000158'),
('20140000162', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000159.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000159'),
('20140000163', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000160.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000160'),
('20140000164', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000161.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000161'),
('20140000165', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000162.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000162'),
('20140000166', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000163.pt', '2014-05-19 16:05:09', '2014-05-25 16:05:09', '', '20140000163'),
('20140000167', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000164.pt', '2014-05-24 11:05:09', '2014-05-30 11:05:09', '', '20140000164'),
('20140000168', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000165.pt', '2014-05-24 14:05:06', '2014-05-30 14:05:06', '', '20140000165'),
('20140000169', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000166.pt', '2014-05-24 15:05:46', '2014-05-30 15:05:46', '', '20140000166'),
('20140000170', 'http://localhost/phptransformer/Prog-cybernews_ns-details_idnews-20140000000.pt', '2014-05-24 16:05:27', '2014-05-30 16:05:27', '1', '20140000000'),
('20140000171', 'http://localhost/phptransformer/Prog-cybernews_ns-details_idnews-20140000000.pt', '2014-05-24 16:05:39', '2014-05-30 16:05:39', '1', '20140000000'),
('20140000172', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000167.pt', '2014-05-24 16:05:39', '2014-05-30 16:05:39', '', '20140000167'),
('20140000173', 'http://localhost/phptransformer/Prog-cybernews_ns-details_idnews-20140000168.pt', '2014-05-24 16:05:39', '2014-05-30 16:05:39', '', '20140000168'),
('20140000174', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000169.pt', '2014-05-24 16:05:20', '2014-05-30 16:05:20', '', '20140000169'),
('20140000175', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000170.pt', '2014-05-26 08:05:24', '2014-06-01 08:06:24', '', '20140000170'),
('20140000176', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000171.pt', '2014-05-29 08:05:58', '2014-06-04 08:06:58', '', '20140000171'),
('20140000177', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000000.pt', '2014-05-29 09:05:59', '2014-06-04 09:06:59', '1', '20140000000'),
('20140000178', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000000.pt', '2014-05-29 09:05:24', '2014-06-04 09:06:24', '1', '20140000000'),
('20140000179', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000001.pt', '2014-06-10 15:06:25', '2014-06-16 15:06:25', '', '20140000001'),
('20140000180', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000002.pt', '2014-06-10 15:06:58', '2014-06-16 15:06:58', '', '20140000002'),
('20140000181', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000003.pt', '2014-06-10 15:06:55', '2014-06-16 15:06:55', '', '20140000003'),
('20140000182', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000004.pt', '2014-06-10 15:06:55', '2014-06-16 15:06:55', '', '20140000004'),
('20140000183', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000005.pt', '2014-06-10 15:06:55', '2014-06-16 15:06:55', '', '20140000005'),
('20140000184', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000006.pt', '2014-06-10 15:06:55', '2014-06-16 15:06:55', '', '20140000006'),
('20140000185', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000007.pt', '2014-06-10 15:06:40', '2014-06-16 15:06:40', '', '20140000007'),
('20140000186', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000008.pt', '2014-06-10 15:06:54', '2014-06-16 15:06:54', '', '20140000008'),
('20140000187', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000009.pt', '2014-06-10 15:06:43', '2014-06-16 15:06:43', '', '20140000009'),
('20140000188', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000010.pt', '2014-06-10 15:06:15', '2014-06-16 15:06:15', '', '20140000010'),
('20140000189', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000011.pt', '2014-06-10 15:06:15', '2014-06-16 15:06:15', '', '20140000011'),
('20140000190', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000012.pt', '2014-06-10 15:06:15', '2014-06-16 15:06:15', '', '20140000012'),
('20140000191', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000013.pt', '2014-06-10 15:06:38', '2014-06-16 15:06:38', '', '20140000013'),
('20140000192', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000014.pt', '2014-06-10 15:06:09', '2014-06-16 15:06:09', '', '20140000014'),
('20140000193', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000015.pt', '2014-06-10 15:06:09', '2014-06-16 15:06:09', '', '20140000015'),
('20140000194', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000016.pt', '2014-06-10 15:06:51', '2014-06-16 15:06:51', '', '20140000016'),
('20140000195', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000017.pt', '2014-06-10 15:06:34', '2014-06-16 15:06:34', '', '20140000017'),
('20140000196', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000018.pt', '2014-06-10 15:06:34', '2014-06-16 15:06:34', '', '20140000018'),
('20140000197', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000019.pt', '2014-06-10 15:06:34', '2014-06-16 15:06:34', '', '20140000019'),
('20140000198', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000020.pt', '2014-06-10 15:06:31', '2014-06-16 15:06:31', '', '20140000020'),
('20140000199', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000021.pt', '2014-06-10 15:06:35', '2014-06-16 15:06:35', '', '20140000021'),
('20140000200', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000022.pt', '2014-06-10 15:06:13', '2014-06-16 15:06:13', '', '20140000022'),
('20140000201', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000023.pt', '2014-06-10 15:06:40', '2014-06-16 15:06:40', '', '20140000023'),
('20140000202', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000024.pt', '2014-06-10 15:06:51', '2014-06-16 15:06:51', '', '20140000024'),
('20140000203', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000025.pt', '2014-06-10 16:03:12', '2014-06-16 16:03:12', '', '20140000025'),
('20140000204', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000026.pt', '2014-06-10 16:03:43', '2014-06-16 16:03:43', '', '20140000026'),
('20140000205', '#', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', ''),
('20140000206', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000027.pt', '2014-06-12 16:20:05', '2014-06-18 16:20:05', '', '20140000027'),
('20140000207', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000028.pt', '2014-06-12 16:20:05', '2014-06-18 16:20:05', '', '20140000028'),
('20140000208', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000029.pt', '2014-06-12 16:20:05', '2014-06-18 16:20:05', '', '20140000029'),
('20140000209', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000030.pt', '2014-06-12 16:20:05', '2014-06-18 16:20:05', '', '20140000030'),
('20140000210', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000031.pt', '2014-06-12 16:20:05', '2014-06-18 16:20:05', '', '20140000031'),
('20140000211', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000032.pt', '2014-06-12 16:20:05', '2014-06-18 16:20:05', '', '20140000032'),
('20140000212', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000033.pt', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '20140000033'),
('20140000213', 'http://localhost/phptransformer/Prog-news_ns-details_idnews-20140000000.pt', '2014-06-28 16:26:37', '2014-07-04 16:26:37', '1', '20140000000');

-- --------------------------------------------------------

--
-- Table structure for table `menlang`
--

CREATE TABLE IF NOT EXISTS `menlang` (
  `idMM` varchar(11) NOT NULL COMMENT 'رقم العنصر في الائحة',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `TitleElement` varchar(35) NOT NULL COMMENT 'اسم العنصر بهذه اللغة',
  UNIQUE KEY `idMM` (`idMM`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='اسماء عناصر الائحة الرئيسية حسب ?';

--
-- Dumping data for table `menlang`
--

INSERT INTO `menlang` (`idMM`, `IdLang`, `TitleElement`) VALUES
('20130000008', '20120000001', 'wewqre'),
('20130000008', '20130000000', ''),
('20130000009', '20120000001', 'gufygtu'),
('20130000009', '20130000001', 'gfuftu'),
('20130000009', '20130000000', ''),
('20130000010', '20120000001', 'sdfdsfdsf'),
('20130000010', '20130000001', 'dfdsf'),
('20130000010', '20130000000', ''),
('20100000000', '20070000001', 'الصفحة الأولى'),
('20100000000', '20070000002', 'Page One'),
('20130000011', '20120000001', 'werewr'),
('20130000011', '20130000001', 'sdfsdaf'),
('20130000011', '20130000000', ''),
('20140000000', '20130000002', 'قلف٤٣٥٣'),
('20140000000', '20120000001', 'شسيشسي'),
('20140000000', '20130000001', 'qwdasd'),
('20140000000', '20130000000', ''),
('20140000001', '20130000002', 'kafer'),
('20140000001', '20120000001', 'erewr'),
('20140000001', '20130000001', 'werewr'),
('20140000001', '20130000000', ''),
('20140000002', '20120000001', 'rtyrty'),
('20140000002', '20130000001', 'tytry'),
('20140000003', '20140000001', 'شسيبسشبش'),
('20140000003', '20120000001', 'شسيشسي'),
('20140000003', '20130000001', 'سشيش'),
('20140000003', '20140000000', 'شسيسشي'),
('20140000004', '20140000001', ''),
('20140000004', '20120000001', 'asdsad'),
('20140000004', '20130000001', ''),
('20140000004', '20140000000', ''),
('20140000005', '20140000001', ''),
('20140000005', '20120000001', 'qwewqe'),
('20140000005', '20130000001', ''),
('20140000005', '20140000000', ''),
('20140000006', '20140000001', ''),
('20140000006', '20120000001', 'sdfdf'),
('20140000006', '20130000001', ''),
('20140000006', '20140000000', ''),
('20140000007', '20140000001', ''),
('20140000007', '20120000001', 'wewe'),
('20140000007', '20130000001', ''),
('20140000007', '20140000000', ''),
('20140000008', '20140000001', ''),
('20140000008', '20120000001', 'عععع'),
('20140000008', '20130000001', 'llllll'),
('20140000008', '20140000000', '');

-- --------------------------------------------------------

--
-- Table structure for table `mob_category`
--

CREATE TABLE IF NOT EXISTS `mob_category` (
  `id_category` bigint(20) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `id_type` bigint(20) DEFAULT NULL,
  `cat_name` text,
  PRIMARY KEY (`id_category`,`IdLang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='انواع الاعلانات الفرعية\nمثلا الكترونيات - للبيع';

--
-- Dumping data for table `mob_category`
--

INSERT INTO `mob_category` (`id_category`, `IdLang`, `id_type`, `cat_name`) VALUES
(1, '20120000000', 1, 'Electronics - for sale'),
(1, '20120000001', 1, 'إلكترونيات - للبيع'),
(2, '20120000000', 1, 'electronic - to buy'),
(2, '20120000001', 1, 'الكترونيات مطلوب'),
(3, '20120000000', 1, 'electronics - misc'),
(3, '20120000001', 1, 'الكترونيات - متفرقات');

-- --------------------------------------------------------

--
-- Table structure for table `mob_items`
--

CREATE TABLE IF NOT EXISTS `mob_items` (
  `id_item` bigint(20) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `item_length` bigint(20) DEFAULT NULL COMMENT 'طول ماذا ستحتوي الخاصية من احرف',
  PRIMARY KEY (`id_item`,`IdLang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='خاصية محتوى الاعلان';

--
-- Dumping data for table `mob_items`
--

INSERT INTO `mob_items` (`id_item`, `IdLang`, `item_name`, `item_length`) VALUES
(1, '20120000000', 'type', 10),
(1, '20120000001', 'النوع', 10),
(2, '20120000000', 'status', 20),
(2, '20120000001', 'الحالة', 20),
(3, '20120000000', 'tel', 20),
(3, '20120000001', 'الهاتف', 20);

-- --------------------------------------------------------

--
-- Table structure for table `mob_item_value`
--

CREATE TABLE IF NOT EXISTS `mob_item_value` (
  `id_mobawaba` bigint(20) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `id_item` bigint(20) DEFAULT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='محتوىى الخصائص';

--
-- Dumping data for table `mob_item_value`
--

INSERT INTO `mob_item_value` (`id_mobawaba`, `IdLang`, `id_item`, `value`) VALUES
(1, '20120000000', 1, 'Television'),
(1, '20120000001', 1, 'تلفزيون'),
(1, '20120000000', 2, 'good'),
(1, '20120000001', 2, 'جيدة'),
(1, '20120000000', 3, '9613687150'),
(1, '20120000001', 3, '9613687150');

-- --------------------------------------------------------

--
-- Table structure for table `mob_mobawab`
--

CREATE TABLE IF NOT EXISTS `mob_mobawab` (
  `id_mobawaba` bigint(20) NOT NULL,
  `id_category` bigint(20) DEFAULT NULL,
  `UserId` varchar(11) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`id_mobawaba`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='المبوب';

--
-- Dumping data for table `mob_mobawab`
--

INSERT INTO `mob_mobawab` (`id_mobawaba`, `id_category`, `UserId`, `date_start`, `date_end`) VALUES
(1, 1, '200700000-1', '2013-01-01 17:54:11', '2014-01-01 17:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `mob_types`
--

CREATE TABLE IF NOT EXISTS `mob_types` (
  `id_type` bigint(20) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_type`,`IdLang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='انواع الاعلانيات الرئيسية\nمثل ألكترونيات';

--
-- Dumping data for table `mob_types`
--

INSERT INTO `mob_types` (`id_type`, `IdLang`, `type_name`) VALUES
(1, '20120000000', 'Electronics'),
(1, '20120000001', 'إلكترونيات'),
(2, '20120000000', 'Realestate'),
(2, '20120000001', 'عقارات'),
(3, '20120000000', 'Jobs'),
(3, '20120000001', 'وظائف');

-- --------------------------------------------------------

--
-- Table structure for table `moderators`
--

CREATE TABLE IF NOT EXISTS `moderators` (
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر',
  `Permission` varchar(1) NOT NULL COMMENT 'الصلاحية',
  UNIQUE KEY `GroupId` (`GroupId`,`ObjectId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الاشراف';

--
-- Dumping data for table `moderators`
--

INSERT INTO `moderators` (`GroupId`, `ObjectId`, `Permission`) VALUES
('200700000-1', '20130000004', '1'),
('20130000000', '20130000003', '1'),
('200700000-1', '20130000003', '1'),
('20070000001', '20130000003', '1'),
('20070000000', '20130000003', '1'),
('20130000000', '20070000000', '1'),
('200700000-1', '20070000000', '1'),
('20070000001', '20070000000', '1'),
('20070000000', '20070000000', '1'),
('200700000-1', '20130000005', '1'),
('200700000-1', '20130000006', '1'),
('200700000-1', '20130000007', '1'),
('200700000-1', '20130000008', '1'),
('200700000-1', '20130000009', '1'),
('200700000-1', '20110000000', '1'),
('200700000-1', '20140000000', '1'),
('200700000-1', '20140000001', '1'),
('200700000-1', '20140000002', '1'),
('200700000-1', '20140000003', '1'),
('200700000-1', '20140000004', '1'),
('200700000-1', '20070000003', '1'),
('20070000001', '20070000003', '1'),
('20070000000', '20070000003', '1'),
('200700000-1', '20140000005', '1'),
('200700000-1', '20070000001', '1'),
('20070000001', '20070000001', '1'),
('20070000000', '20070000001', '1'),
('200700000-1', '20140000006', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `IdUserName` varchar(11) NOT NULL COMMENT 'رقم الكاتب',
  `Date` datetime NOT NULL COMMENT 'التاريخ',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم او لا',
  `Hits` bigint(20) NOT NULL COMMENT 'زيارة',
  `NewsPic` text NOT NULL COMMENT 'صورة للخبر',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل الخبر محذوف ؟',
  `urgent` int(1) NOT NULL DEFAULT '0' COMMENT 'خبر عاجل',
  `agency` varchar(20) NOT NULL COMMENT 'رقم المستخدم كمصدر ',
  `active_by` varchar(11) NOT NULL,
  `del_by` varchar(11) NOT NULL,
  `location` text NOT NULL COMMENT 'geo location x,y',
  PRIMARY KEY (`IdNews`),
  UNIQUE KEY `IdNews` (`IdNews`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الاخبار';

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`IdNews`, `IdUserName`, `Date`, `Active`, `Hits`, `NewsPic`, `Deleted`, `urgent`, `agency`, `active_by`, `del_by`, `location`) VALUES
('20140000000', '200700000-1', '2014-06-28 16:26:37', '1', 14, 'IMG-20131213-WA0000.jpg', '1', 0, 'admin', '200700000-1', '200700000-1', '');

-- --------------------------------------------------------

--
-- Table structure for table `newscategoies`
--

CREATE TABLE IF NOT EXISTS `newscategoies` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقمم الخبر',
  `IdCat` varchar(11) NOT NULL COMMENT 'رقم المجموعة',
  UNIQUE KEY `IdNews` (`IdNews`,`IdCat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ربط الخبر بمجموعة';

--
-- Dumping data for table `newscategoies`
--

INSERT INTO `newscategoies` (`IdNews`, `IdCat`) VALUES
('20140000000', '20140000001');

-- --------------------------------------------------------

--
-- Table structure for table `newscomment`
--

CREATE TABLE IF NOT EXISTS `newscomment` (
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `CommentTitle` varchar(100) NOT NULL COMMENT 'عنوان التعليق',
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `cc` varchar(3) NOT NULL COMMENT 'كود البلد',
  `CommentDate` datetime NOT NULL COMMENT 'تاريخ التعليق',
  `theComment` varchar(500) NOT NULL COMMENT 'نص التعليق',
  `idComment` varchar(11) NOT NULL COMMENT 'رقم التعليق',
  PRIMARY KEY (`idComment`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تعليقات على الخبر';

-- --------------------------------------------------------

--
-- Table structure for table `newslang`
--

CREATE TABLE IF NOT EXISTS `newslang` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقمم اللغة',
  `IdNews` varchar(11) NOT NULL COMMENT 'رقم الخبر',
  `Tilte` varchar(256) DEFAULT NULL,
  `SubTitle` varchar(35) NOT NULL COMMENT 'العنوان الفرعي للخبر',
  `Breif` text NOT NULL COMMENT 'مختصر الخبر',
  `FullMessage` longtext NOT NULL COMMENT 'الخبر كاملا',
  `Note` varchar(200) NOT NULL COMMENT 'ملاحظة',
  PRIMARY KEY (`IdLang`,`IdNews`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='الاخبار حسب اللغة';

--
-- Dumping data for table `newslang`
--

INSERT INTO `newslang` (`IdLang`, `IdNews`, `Tilte`, `SubTitle`, `Breif`, `FullMessage`, `Note`) VALUES
('20120000001', '20140000000', 'dsfdsfds', 'عنوان فرعي عنوان فرعي عنوان فرعي', 'sdfsdf', 'sdfsdf', 'sdfdsf'),
('20140000001', '20140000000', 'asdfsad', 'sub title sub titlesub title', 'sadsad', 'asdsad', '');

-- --------------------------------------------------------

--
-- Table structure for table `newsservice`
--

CREATE TABLE IF NOT EXISTS `newsservice` (
  `IdNewsServ` varchar(11) NOT NULL COMMENT 'رقم السطر',
  `WebName` varchar(1024) NOT NULL COMMENT 'اسم الموقع',
  `FeedName` varchar(35) NOT NULL COMMENT 'اسم المغذي',
  `FeedCode` varchar(10) NOT NULL COMMENT 'كود المغذي',
  `FeedUrl` varchar(1024) NOT NULL COMMENT 'عنوان المغذي',
  `FeedLang` varchar(15) NOT NULL COMMENT 'لغة المغذي',
  `Available` varchar(1) NOT NULL COMMENT 'متوفر',
  PRIMARY KEY (`IdNewsServ`),
  UNIQUE KEY `FeedCode` (`FeedCode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خدمة الاخبار للمواقع الخارجية';

--
-- Dumping data for table `newsservice`
--

INSERT INTO `newsservice` (`IdNewsServ`, `WebName`, `FeedName`, `FeedCode`, `FeedUrl`, `FeedLang`, `Available`) VALUES
('20080000000', 'Al Jazeera', 'أخبار الجزيرة', 'jscar', 'http://www.aljazeera.net/PORTAL/RSS/RSS-Portal.xml', 'Arabic', '1'),
('20080000001', 'Al Jazeera', 'Al Jazeera English', 'jscen', 'http://english.aljazeera.net/NR/exeres/4D6139CD-6BB5-438A-8F33-96A7F25F40AF.htm?ArticleGuid=55ABE840-AC30-41D2-BDC9-06BBE2A36665', 'English', '1'),
('20080000002', 'Google News', 'Google عربي', 'gglar', 'http://news.google.com/news?ned=ar&output=rss', 'Arabic', '1'),
('20080000003', 'Google News', 'Google English', 'gglen', 'http://news.google.com/news?ned=us&output=rss', 'English', '1'),
('20080000004', 'bbc', 'bbc Arabic', 'bbcar', 'http://newsrss.bbc.co.uk/rss/arabic/news/rss.xml', 'Arabic', '1'),
('20080000005', 'bbc', 'bbc News Front Page ', 'bbcennfp', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/front_page/rss.xml', 'English', '1'),
('20080000006', 'bbc', 'bbc World', 'bbcwrld', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/world/rss.xml', 'English', '1'),
('20080000007', 'bbc', 'bbc UK', 'bbcuk', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/uk/rss.xml', 'English', '1'),
('20080000008', 'bbc', 'bbc England ', 'bbcengld', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/england/rss.xml', 'English', '1'),
('20080000009', 'bbc', 'bbc Northern Ireland ', 'bbcni', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/northern_ireland/rss.xml', 'English', '1'),
('20080000010', 'bbc', 'bbc Scotland ', 'bbcsl', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/scotland/rss.xml', 'English', '1'),
('20080000011', 'bbc', 'bbc Wales', 'bbcwls', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/wales/rss.xml', 'English', '1'),
('20080000012', 'bbc', 'bbc Business ', 'bbcbzns', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/business/rss.xml', 'English', '1'),
('20080000013', 'bbc', 'bbc Politics', 'bbcpltc', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/uk_politics/rss.xml', 'English', '1'),
('20080000014', 'bbc', 'bbc Health', 'bbchlt', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/health/rss.xml', 'English', '1'),
('20080000015', 'bbc', 'bbc Education', 'bbcedu', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/education/rss.xml', 'English', '1'),
('20080000016', 'bbc', 'bbc Science/Nature ', 'bbcscna', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/sci/tech/rss.xml', 'English', '1'),
('20080000017', 'bbc', 'bbc Technology ', 'bbctech', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/technology/rss.xml', 'English', '1'),
('20080000018', 'bbc', 'bbc Entertainment ', 'bbcent', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/entertainment/rss.xml', 'English', '1'),
('20080000019', 'bbc', 'bbc Have Your Say ', 'bbchys', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/talking_point/rss.xml', 'English', '1'),
('20080000020', 'bbc', 'bbc Magazine', 'bbcmag', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/magazine/rss.xml', 'English', '1'),
('20080000021', 'bbc', 'bbc Week At a Glance ', 'bbcwaag', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/week_at-a-glance/rss.xml', 'English', '1'),
('20080000022', 'bbc', 'bbc Programmes', 'bbprog', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/programmes/rss.xml', 'English', '1'),
('20080000023', 'bbc', 'bbc Latest Published Stories ', 'bbclps', 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/latest_published_stories/rss.xml', 'English', '1'),
('20080000024', 'Manar TV', 'الأخبار', 'mnrar', 'http://www.almanar.com.lb/NewsSite/RSS_Main.aspx?language=ar', 'Arabic', '1'),
('20080000025', 'Manar TV', 'News', 'mnren', 'http://www.almanar.com.lb/NewsSite/RSS_Main.aspx?language=en', 'English', '1'),
('20080000026', 'Press', 'Press Latest News', 'prsln', 'http://www.presstv.ir/rss', 'English', '1'),
('20080000027', 'Press', 'Press Iran News', 'prsin', 'http://www.presstv.ir/rss/?section=iran', 'English', '1'),
('20080000028', 'Press', 'Press Middle East News', 'prsmen', 'http://www.presstv.ir/rss/?section=middleeast', 'English', '1'),
('20080000029', 'Press', 'Press US News', 'prsusn', 'http://www.presstv.ir/rss/?section=us', 'English', '1'),
('20080000030', 'Press', 'Press Asia / Pacific news', 'prsapn', 'http://www.presstv.ir/rss/?section=asiapacific', 'English', '1'),
('20080000031', 'Press', 'Press Africa News', 'prsafn', 'http://www.presstv.ir/rss/?section=africa', 'English', '1'),
('20080000032', 'Press', 'Press Europe News', 'prseun', 'http://www.presstv.ir/rss/?section=europe', 'English', '1'),
('20080000033', 'Press', 'Press Americas News', 'prsamn', 'http://www.presstv.ir/rss/?section=americas', 'English', '1'),
('20080000034', 'Press', 'Press Sci/Tech', 'prssctc', 'http://www.presstv.ir/rss/?section=scitech', 'English', '1'),
('20080000035', 'Press', 'Press Health News', 'prshln', 'http://www.presstv.ir/rss/?section=health', 'English', '1'),
('20080000036', 'Press', 'Press Sports News', 'prssprt', 'http://www.presstv.ir/rss/?section=sports', 'English', '1'),
('20080000037', 'Press', 'Press Society News', 'prssctn', 'http://www.presstv.ir/rss/?section=society', 'English', '1'),
('20080000038', 'Reuters', 'Reuters Top News', 'rtrstn', 'http://feeds.reuters.com/reuters/topNews?format=xml', 'English', '1'),
('20080000039', 'Reuters', 'Reuters Business News', 'rtrsbzns', 'http://feeds.reuters.com/reuters/businessNews?format=xml', 'English', '1'),
('20080000040', 'Reuters', 'Reuters U.S.', 'rtrsus', 'http://feeds.reuters.com/Reuters/domesticNews?format=xml', 'English', '1'),
('20080000041', 'Reuters', 'Reuters International News', 'rtrsintn', 'http://feeds.reuters.com/reuters/worldNews?format=xml', 'English', '1'),
('20080000042', 'Reuters', 'Reuters Politics', 'rtrspol', 'http://feeds.reuters.com/Reuters/PoliticsNews?format=xml', 'English', '1'),
('20080000043', 'Reuters', 'Reuters Entertainment News', 'rtrsentn', 'http://feeds.reuters.com/reuters/entertainment?format=xml', 'English', '1'),
('20080000044', 'Reuters', 'Reuters Environment', 'rtrsenv', 'http://feeds.reuters.com/reuters/environment?format=xml', 'English', '1'),
('20080000045', 'Reuters', 'Reuters Technology News', 'rtrstechn', 'http://feeds.reuters.com/reuters/technologyNews?format=xml', 'English', '1'),
('20080000046', 'Reuters', 'Reuters Science News', 'rtrsscn', 'http://feeds.reuters.com/reuters/scienceNews?format=xml', 'English', '1'),
('20080000047', 'Reuters', 'Reuters Internet News', 'rtrsintnt', 'http://feeds.reuters.com/Reuters/InternetNews?format=xml', 'English', '1'),
('20080000048', 'Reuters', 'Reuters Sports News', 'rtrssprt', 'http://feeds.reuters.com/reuters/sportsNews?format=xml', 'English', '1'),
('20080000049', 'Reuters', 'Reuters Health News', 'rtrshltn', 'http://feeds.reuters.com/reuters/healthNews?format=xml', 'English', '1'),
('20080000050', 'Reuters', 'Reuters Oddly Enough', 'rtrsoden', 'http://feeds.reuters.com/reuters/oddlyEnoughNews?format=xml', 'English', '1'),
('20080000051', 'Reuters', 'Reuters In Depth', 'rtrsind', 'http://feeds.reuters.com/reuters/inDepthNews?format=xml', 'English', '1'),
('20080000052', 'Reuters', 'Reuters Lifestyle', 'rtrslstl', 'http://feeds.reuters.com/reuters/lifestyle?format=xml', 'English', '1'),
('20080000053', 'Reuters', 'Reuters Travel', 'rtrstrvl', 'http://feeds.reuters.com/reuters/features/destinations?format=xml', 'English', '1'),
('20080000054', 'Reuters', 'Reuters Tech', 'rtrstech', 'http://feeds.reuters.com/reuters/features/techlife?format=xml', 'English', '1'),
('20080000055', 'Reuters', 'Reuters Health & Fitness', 'rtrshlft', 'http://feeds.reuters.com/reuters/features/wellbeing?format=xml', 'English', '1'),
('20080000056', 'Reuters', 'Reuters Money', 'rtrsmn', 'http://feeds.reuters.com/reuters/features/personalfinance?format=xml', 'English', '1'),
('20080000057', 'Reuters', 'Reuters Autos', 'rtrsato', 'http://feeds.reuters.com/reuters/features/autos?format=xml', 'English', '1'),
('20080000058', 'Aarabiya', 'العربية.نت | الصفحة الرئيسية', 'arbmp', 'http://www.alarabiya.net/rss/rss_top08.xml', 'Arabic', '1'),
('20080000059', 'Aarabiya', 'العربية.نت | الصفحة السياسية', 'arbpp', 'http://www.alarabiya.net/rss/PoliticsPage.xml', 'Arabic', '1'),
('20080000060', 'Aarabiya', 'العربية.نت | الصفحة الرياضية', 'arbsp', 'http://www.alarabiya.net/rss/SportsPage.xml', 'Arabic', '1'),
('20080000061', 'Aarabiya', 'الأسواق العربية | الصفحة الرئيسية', 'arbbzns', 'http://www.alaswaq.net/files/rss/index.xml', 'Arabic', '1'),
('20080000062', 'Aarabiya', 'العربية.نت | الصفحة الأخيرة', 'arblp', 'http://www.alarabiya.net/rss/LastPage.xml', 'Arabic', '1'),
('20080000063', 'Aarabiya', 'العربية.نت | آخر الأخبار', 'arbln', 'http://www.alarabiya.net/rss/rssLatestNews.xml', 'Arabic', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news_report`
--

CREATE TABLE IF NOT EXISTS `news_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` varchar(11) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `time_sent` datetime NOT NULL,
  `time_read` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news_subscription`
--

CREATE TABLE IF NOT EXISTS `news_subscription` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) NOT NULL,
  `cat_id` varchar(11) NOT NULL COMMENT 'المجموعة الاخبارية',
  `only_urgent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='الاخبار التي ستظهر للمستخدم على تطبيق الهاتف' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(11) NOT NULL,
  `id_news_group` varchar(11) NOT NULL,
  `only_urgent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر',
  `ObjectName` varchar(35) NOT NULL COMMENT 'اسم العنصر',
  UNIQUE KEY `ObjectId` (`ObjectId`,`ObjectName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='عناصر يتم التحكم بالوصول اليها ه?';

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`ObjectId`, `ObjectName`) VALUES
('20100000001', '{PageNumber} 1'),
('20120000000', '{PageNumber} 2'),
('20130000000', '{PageNumber} 3'),
('20130000001', '{PageNumber} 4'),
('20130000002', '{PageNumber} 5'),
('20130000003', '{PageNumber} 6'),
('20130000004', '{PageNumber} 7'),
('20130000005', '{PageNumber} 8'),
('20130000006', '{PageNumber} 1'),
('20130000007', '{PageNumber} 2'),
('20130000008', '{PageNumber} 3'),
('20130000009', '{PageNumber} 4'),
('20130000010', '{PageNumber} 5'),
('20130000011', '{PageNumber} 6'),
('20130000012', '{PageNumber} 7'),
('20140000000', '{PageNumber} 8'),
('20140000001', '{PageNumber} 9'),
('20140000002', '{PageNumber} 10'),
('20140000003', '{PageNumber} 11'),
('20140000004', '{PageNumber} 12'),
('20140000005', '{PageNumber} 13'),
('20140000006', '{PageNumber} 14'),
('20140000007', '{PageNumber} 15'),
('20140000008', '{PageNumber} 16');

-- --------------------------------------------------------

--
-- Table structure for table `oldstatistics`
--

CREATE TABLE IF NOT EXISTS `oldstatistics` (
  `MonthDate` varchar(8) NOT NULL COMMENT 'الشهر و السنة',
  `IPNbr` varchar(15) NOT NULL COMMENT 'ايبي بلد الزيارة',
  `Hits` varchar(7) NOT NULL COMMENT 'عدد الزيارات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='في الاحصاءات للاشهرو السنوات الق';

-- --------------------------------------------------------

--
-- Table structure for table `opstatistics`
--

CREATE TABLE IF NOT EXISTS `opstatistics` (
  `MSIE` varchar(7) NOT NULL COMMENT 'انترنت اكسبلورر',
  `Opera` varchar(7) NOT NULL COMMENT 'اوبرا',
  `Konqueror` varchar(7) NOT NULL COMMENT 'كونكيور',
  `Netscape` varchar(7) NOT NULL COMMENT 'نتسكايب',
  `FireFox` varchar(7) NOT NULL COMMENT 'فايرفوكس',
  `Bot` varchar(7) NOT NULL COMMENT 'بوت',
  `Windows` varchar(7) NOT NULL COMMENT 'زيندوز',
  `Linux` varchar(7) NOT NULL COMMENT 'لينكس',
  `Mac` varchar(7) NOT NULL COMMENT 'ماكنتوش',
  `FreeBsd` varchar(7) NOT NULL COMMENT 'فري باسدي',
  `Other` varchar(7) NOT NULL COMMENT 'اخر'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='مستعرضات و انظمة تشغيل الزوار';

--
-- Dumping data for table `opstatistics`
--

INSERT INTO `opstatistics` (`MSIE`, `Opera`, `Konqueror`, `Netscape`, `FireFox`, `Bot`, `Windows`, `Linux`, `Mac`, `FreeBsd`, `Other`) VALUES
('1', '1', '1', '1', '71', '1', '2', '85', '1', '1', '1'),
('1', '1', '1', '1', '71', '1', '2', '85', '1', '1', '1'),
('1', '1', '1', '1', '71', '1', '2', '85', '1', '1', '1'),
('1', '1', '1', '1', '71', '1', '2', '85', '1', '1', '1'),
('1', '1', '1', '1', '71', '1', '2', '85', '1', '1', '1'),
('1', '1', '1', '1', '71', '1', '2', '85', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `oto_auto`
--

CREATE TABLE IF NOT EXISTS `oto_auto` (
  `id_auto` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `auto_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='??? ???????? ????? ?????';

--
-- Dumping data for table `oto_auto`
--

INSERT INTO `oto_auto` (`id_auto`, `IdLang`, `auto_name`) VALUES
(1, '20120000001', 'شاحنة'),
(1, '20120000000', 'Truck'),
(2, '20120000000', 'Car'),
(2, '20120000001', 'سيارة'),
(3, '20120000001', 'قاطرة'),
(3, '20120000000', 'katira'),
(4, '20120000001', 'طائرة'),
(4, '20120000000', 'plan');

-- --------------------------------------------------------

--
-- Table structure for table `oto_automobile`
--

CREATE TABLE IF NOT EXISTS `oto_automobile` (
  `id_automaobile` int(11) NOT NULL AUTO_INCREMENT,
  `id_body` int(11) NOT NULL,
  `is_special` int(1) NOT NULL DEFAULT '0',
  `id_title` int(11) NOT NULL,
  `id_note` int(11) NOT NULL,
  `UserId` varchar(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `id_color_in` int(11) NOT NULL COMMENT 'لون السيارة الداخلي',
  `id_gearbox` int(11) NOT NULL,
  `id_WD` int(11) NOT NULL,
  `id_fuel` int(11) NOT NULL,
  `id_sealofquality` int(11) NOT NULL,
  `id_currency` int(11) NOT NULL,
  `break` tinyint(1) NOT NULL,
  `disconnected` tinyint(1) NOT NULL,
  `convertible` tinyint(1) NOT NULL,
  `small_car` tinyint(1) NOT NULL,
  `bus` tinyint(1) NOT NULL,
  `limosine` tinyint(1) NOT NULL,
  `pick_up` tinyint(1) NOT NULL,
  `MPV_minivan` tinyint(1) NOT NULL,
  `DUV_jeep` tinyint(1) NOT NULL,
  `version` varchar(100) NOT NULL,
  `year` date NOT NULL,
  `price` int(11) NOT NULL,
  `discount_price` int(11) NOT NULL,
  `kilometers` int(11) NOT NULL,
  `displacement` int(11) NOT NULL,
  `CV` int(11) NOT NULL,
  `doors` int(11) NOT NULL,
  `seating` int(11) NOT NULL,
  `auxiliary_heating` tinyint(1) NOT NULL,
  `limited_slip_differential` int(1) NOT NULL,
  `leather_interior` tinyint(1) NOT NULL,
  `handsfree` tinyint(1) NOT NULL,
  `cruise` tinyint(1) NOT NULL,
  `seat_electr` tinyint(1) NOT NULL,
  `syst_parking_aid` tinyint(1) NOT NULL,
  `sunroof` tinyint(1) NOT NULL,
  `air_conditioning` tinyint(1) NOT NULL,
  `particulate_filter` tinyint(1) NOT NULL,
  `ISOFix` tinyint(1) NOT NULL,
  `directional_headlights` tinyint(1) NOT NULL,
  `adaptive_cruise_control` tinyint(1) NOT NULL,
  `sports_seats` tinyint(1) NOT NULL,
  `entertainment_sys` tinyint(1) NOT NULL,
  `panoramic_roof` tinyint(1) NOT NULL,
  `stability_control` tinyint(1) NOT NULL,
  `hardtop` tinyint(1) NOT NULL,
  `aluminum_rims` tinyint(1) NOT NULL,
  `xenon_headlights` tinyint(1) NOT NULL,
  `heated_seats` tinyint(1) NOT NULL,
  `air_suspension` tinyint(1) NOT NULL,
  `navigator_system` tinyint(1) NOT NULL,
  `power_windows` tinyint(1) NOT NULL,
  `sets_of_tires_wheels` tinyint(1) NOT NULL,
  `rack` tinyint(1) NOT NULL,
  `to_hitch` tinyint(1) NOT NULL,
  `racecar` tinyint(1) NOT NULL,
  `seperating_grid` tinyint(1) NOT NULL,
  `appraised` tinyint(1) NOT NULL,
  `for_export` tinyint(1) NOT NULL,
  `non_crashed` tinyint(1) NOT NULL,
  `direct_import` tinyint(1) NOT NULL,
  `tuning` tinyint(1) NOT NULL,
  `handicape` tinyint(1) NOT NULL,
  `car_accident` tinyint(1) NOT NULL,
  `consumption_up` double NOT NULL,
  `co2_emission_up` int(11) NOT NULL,
  `energy_category` varchar(100) NOT NULL,
  `euro_emission_standard` varchar(100) NOT NULL,
  `postcode_location` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `solde` tinyint(1) NOT NULL,
  `latest_inspection` date NOT NULL COMMENT 'تاريخ اخر معاينة',
  `homologation` varchar(36) NOT NULL,
  `expertise` int(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `inupdate` int(1) NOT NULL COMMENT 'سجل محجوز حتى يتم تحديثه عند الحفظ نستعمله في حالة رفع ملفات صور السياراة',
  PRIMARY KEY (`id_automaobile`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `oto_automobile`
--

INSERT INTO `oto_automobile` (`id_automaobile`, `id_body`, `is_special`, `id_title`, `id_note`, `UserId`, `id_auto`, `id_brand`, `id_model`, `id_type`, `id_color`, `id_color_in`, `id_gearbox`, `id_WD`, `id_fuel`, `id_sealofquality`, `id_currency`, `break`, `disconnected`, `convertible`, `small_car`, `bus`, `limosine`, `pick_up`, `MPV_minivan`, `DUV_jeep`, `version`, `year`, `price`, `discount_price`, `kilometers`, `displacement`, `CV`, `doors`, `seating`, `auxiliary_heating`, `limited_slip_differential`, `leather_interior`, `handsfree`, `cruise`, `seat_electr`, `syst_parking_aid`, `sunroof`, `air_conditioning`, `particulate_filter`, `ISOFix`, `directional_headlights`, `adaptive_cruise_control`, `sports_seats`, `entertainment_sys`, `panoramic_roof`, `stability_control`, `hardtop`, `aluminum_rims`, `xenon_headlights`, `heated_seats`, `air_suspension`, `navigator_system`, `power_windows`, `sets_of_tires_wheels`, `rack`, `to_hitch`, `racecar`, `seperating_grid`, `appraised`, `for_export`, `non_crashed`, `direct_import`, `tuning`, `handicape`, `car_accident`, `consumption_up`, `co2_emission_up`, `energy_category`, `euro_emission_standard`, `postcode_location`, `date`, `solde`, `latest_inspection`, `homologation`, `expertise`, `deleted`, `inupdate`) VALUES
(2, 0, 0, 0, 0, '200700000-1', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, '0', '0000-00-00', 44, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'A', '', '', '2013-02-26 12:33:10', 0, '0000-00-00', '1OA633', 0, 0, 0),
(1, 0, 1, 5, 3, '200700000-1', 0, 1, 2, 1, 5, 15, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 0, 0, '0', '0000-00-00', 1232, 123213, 0, 0, 40, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 7.5, 0, 'AD', '', '2142134', '2013-04-12 08:52:36', 0, '0000-00-00', '', 0, 0, 0),
(3, 0, 0, 0, 0, '200700000-1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '2013-03-05 13:43:23', 0, '0000-00-00', '', 0, 0, 0),
(4, 0, 0, 0, 0, '200700000-1', 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0000-00-00', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'A', '', '', '2013-03-14 14:51:42', 0, '0000-00-00', '', 0, 0, 0),
(5, 0, 0, 3, 0, '200700000-1', 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0000-00-00', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'A', '', '', '2013-03-14 14:32:43', 0, '0000-00-00', '', 1, 0, 0),
(6, 0, 1, 7, 6, '200700000-1', 0, 4, 7, 1, 7, 6, 1, 2, 1, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, '0', '2012-04-12', 16000, 12500, 55000, 0, 11, 5, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 3, 0, 'A', '', '', '2013-04-13 08:40:52', 0, '2013-04-01', '', 1, 0, 0),
(7, 0, 1, 6, 5, '200700000-1', 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0000-00-00', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, 'A', '', '', '2013-04-12 14:31:42', 0, '0000-00-00', '', 0, 0, 0),
(8, 0, 1, 8, 0, '200700000-1', 0, 4, 7, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, '0', '2013-04-03', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 8.5, 0, 'AC', '', '', '2013-04-13 08:52:14', 0, '0000-00-00', '', 0, 0, 0),
(9, 0, 1, 9, 0, '200700000-1', 1, 4, 7, 0, 4, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '2013-04-22', 324234, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 10, 0, 'A', 'B02', '', '2013-04-13 08:54:17', 0, '2013-04-13', '', 1, 0, 0),
(10, 0, 0, 0, 0, '200700000-1', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0000-00-00', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0000-00-00 00:00:00', 0, '0000-00-00', '0', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `oto_body`
--

CREATE TABLE IF NOT EXISTS `oto_body` (
  `id_body` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `body_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='??? ??? ??????? ????? ????;

--
-- Dumping data for table `oto_body`
--

INSERT INTO `oto_body` (`id_body`, `IdLang`, `body_name`) VALUES
(1, '20120000000', 'Cabine'),
(2, '20120000000', 'Caravan'),
(1, '20120000001', 'كابينة'),
(2, '20120000001', 'عربة كبيرة');

-- --------------------------------------------------------

--
-- Table structure for table `oto_brand`
--

CREATE TABLE IF NOT EXISTS `oto_brand` (
  `id_brand` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL COMMENT '????? '
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='?????? ???????? ???;

--
-- Dumping data for table `oto_brand`
--

INSERT INTO `oto_brand` (`id_brand`, `IdLang`, `brand_name`) VALUES
(5, '20120000002', 'meced'),
(5, '20120000001', 'مرسيدس'),
(5, '20120000000', 'merceded'),
(4, '20120000000', 'kia'),
(4, '20120000001', 'كيا'),
(4, '20120000002', 'kia');

-- --------------------------------------------------------

--
-- Table structure for table `oto_color`
--

CREATE TABLE IF NOT EXISTS `oto_color` (
  `id_color` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `color_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='??? ???????';

--
-- Dumping data for table `oto_color`
--

INSERT INTO `oto_color` (`id_color`, `IdLang`, `color_name`) VALUES
(1, '20120000000', 'Red'),
(2, '20120000000', 'Yellow'),
(1, '20120000001', 'احمر'),
(2, '20120000001', 'اصفر'),
(3, '20120000000', 'en'),
(3, '20120000001', 'ar'),
(3, '20120000002', 'fr'),
(4, '20120000000', 'Bleu'),
(4, '20120000001', 'ازرق'),
(4, '20120000002', 'blue'),
(5, '20120000000', 'sdfdsf'),
(5, '20120000001', 'sdfdsf'),
(5, '20120000002', 'sdfdsf'),
(6, '20120000000', 'black'),
(6, '20120000001', 'اسود'),
(6, '20120000002', 'noire'),
(7, '20120000000', 'jardony'),
(7, '20120000001', 'جردوني'),
(7, '20120000002', 'jadone'),
(8, '20120000000', 'sdfdsfsd'),
(8, '20120000001', 'fdsf'),
(8, '20120000002', 'cccc'),
(9, '20120000000', 'zzzzzzzzzz'),
(9, '20120000001', 'zzzzzzzzzzzzzzzzzzz'),
(9, '20120000002', 'zzzzzzzzzzzzz'),
(9, '20130000000', 'zzzzzzzzzzzzzzzzz'),
(10, '20120000000', 'zzzzzzzzzz'),
(10, '20120000001', 'zzzzzzzzzzzzzzzzzzz'),
(10, '20120000002', 'zzzzzzzzzzzzz'),
(10, '20130000000', 'zzzzzzzzzzzzzzzzz'),
(11, '20120000000', 'xxxxxxxx'),
(11, '20120000001', 'xxxxxxxxxxxxxxxxxx'),
(11, '20120000002', 'xxxxxxxxx'),
(11, '20130000000', 'xxxxxxxxxxxxxxxxxxxxx'),
(12, '20120000000', 'xxxxxxxx'),
(12, '20120000001', 'xxxxxxxxxxxxxxxxxx'),
(12, '20120000002', 'xxxxxxxxx'),
(12, '20130000000', 'xxxxxxxxxxxxxxxxxxxxx'),
(13, '20120000000', 'ex'),
(13, '20120000001', 'ex'),
(13, '20120000002', 'ex'),
(13, '20130000000', 'ex'),
(14, '20120000000', '11'),
(14, '20120000001', '11'),
(14, '20120000002', '11'),
(14, '20130000000', '11'),
(15, '20120000000', '55'),
(15, '20120000001', '55'),
(15, '20120000002', '55'),
(15, '20130000000', '55'),
(16, '20120000000', 'int1'),
(16, '20120000001', 'int1'),
(16, '20120000002', 'int1'),
(16, '20130000000', 'int1');

-- --------------------------------------------------------

--
-- Table structure for table `oto_currency`
--

CREATE TABLE IF NOT EXISTS `oto_currency` (
  `id_currency` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(5) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`id_currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='?????? ????-????' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `oto_currency`
--

INSERT INTO `oto_currency` (`id_currency`, `symbol`, `code`) VALUES
(1, '$', 'USD'),
(2, 'L.L.', 'LBP'),
(3, '€', 'Euro');

-- --------------------------------------------------------

--
-- Table structure for table `oto_exchnge`
--

CREATE TABLE IF NOT EXISTS `oto_exchnge` (
  `from_currency` int(11) NOT NULL,
  `to_currency` int(11) NOT NULL,
  `from_date` datetime NOT NULL,
  `price` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='????? ??????';

--
-- Dumping data for table `oto_exchnge`
--

INSERT INTO `oto_exchnge` (`from_currency`, `to_currency`, `from_date`, `price`) VALUES
(1, 2, '2012-09-01 00:00:00', 1505.7),
(1, 2, '2012-09-30 00:00:00', 1510);

-- --------------------------------------------------------

--
-- Table structure for table `oto_fuel`
--

CREATE TABLE IF NOT EXISTS `oto_fuel` (
  `id_fuel` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `fuel_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='??? ????????? ?????-?????';

--
-- Dumping data for table `oto_fuel`
--

INSERT INTO `oto_fuel` (`id_fuel`, `IdLang`, `fuel_name`) VALUES
(1, '20120000000', 'Benzine'),
(2, '20120000000', 'fuel'),
(1, '20120000001', 'بنزين'),
(2, '20120000001', 'فيول');

-- --------------------------------------------------------

--
-- Table structure for table `oto_gearbox`
--

CREATE TABLE IF NOT EXISTS `oto_gearbox` (
  `id_gearbox` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `gearbox_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='???? - ?????????';

--
-- Dumping data for table `oto_gearbox`
--

INSERT INTO `oto_gearbox` (`id_gearbox`, `IdLang`, `gearbox_name`) VALUES
(1, '20120000000', 'Automatic'),
(2, '20120000000', 'Manual'),
(1, '20120000001', 'اوتوماتيك'),
(2, '20120000001', 'عادي');

-- --------------------------------------------------------

--
-- Table structure for table `oto_model`
--

CREATE TABLE IF NOT EXISTS `oto_model` (
  `id_model` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `model_name` varchar(100) NOT NULL,
  `id_brand` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oto_model`
--

INSERT INTO `oto_model` (`id_model`, `IdLang`, `model_name`, `id_brand`) VALUES
(1, '20120000000', '11', 1),
(1, '20120000001', '11', 1),
(1, '20120000002', '11', 1),
(1, '20130000000', '11', 1),
(2, '20120000000', '12', 1),
(2, '20120000001', '12', 1),
(2, '20120000002', '12', 1),
(2, '20130000000', '12', 1),
(3, '20120000000', '13', 1),
(3, '20120000001', '13', 1),
(3, '20120000002', '13', 1),
(3, '20130000000', '13', 1),
(4, '20120000000', '21', 2),
(4, '20120000001', '21', 2),
(4, '20120000002', '21', 2),
(4, '20130000000', '21', 2),
(5, '20120000000', '22', 2),
(5, '20120000001', '22', 2),
(5, '20120000002', '22', 2),
(5, '20130000000', '22', 2),
(6, '20120000000', '23', 2),
(6, '20120000001', '23', 2),
(6, '20120000002', '23', 2),
(6, '20130000000', '23', 2),
(7, '20120000000', 'picanto', 4),
(7, '20120000001', 'بيكانتو', 4),
(7, '20120000002', 'picanto', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oto_Note`
--

CREATE TABLE IF NOT EXISTS `oto_Note` (
  `id_Note` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `Note` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oto_Note`
--

INSERT INTO `oto_Note` (`id_Note`, `IdLang`, `Note`) VALUES
(1, '20120000000', 'nbjkbjm'),
(1, '20120000001', 'mnbm'),
(1, '20120000002', 'nmn'),
(1, '20130000000', 'mbnm'),
(2, '20120000000', ',.,.,'),
(2, '20120000001', '.,.,.'),
(2, '20120000002', ',.,.,.,'),
(2, '20130000000', '.,.'),
(3, '20120000000', 'cvbvcbvc cvb cvb cvb vc'),
(3, '20120000001', 'cvb cvbcvb cvb '),
(3, '20120000002', 'vcb vcb vcbvcbvc'),
(3, '20130000000', 'b vcb vcbvc'),
(4, '20120000000', 'asdsad'),
(4, '20120000001', 'sadasd'),
(4, '20120000002', 'asdsad'),
(5, '20120000000', 'xxxx'),
(5, '20120000001', 'xxxx'),
(5, '20120000002', 'xx'),
(6, '20120000000', 'note'),
(6, '20120000001', 'ملاحظة'),
(6, '20120000002', 'note');

-- --------------------------------------------------------

--
-- Table structure for table `oto_permission`
--

CREATE TABLE IF NOT EXISTS `oto_permission` (
  `UserId` varchar(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete_own` tinyint(1) NOT NULL DEFAULT '1',
  `delete_other` tinyint(1) NOT NULL DEFAULT '0',
  `edit_own` tinyint(1) NOT NULL DEFAULT '1',
  `edit_other` tinyint(1) NOT NULL DEFAULT '0',
  `is_special` int(1) NOT NULL DEFAULT '0' COMMENT 'صلاحية وضع السيارة كمميزة',
  PRIMARY KEY (`UserId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oto_permission`
--

INSERT INTO `oto_permission` (`UserId`, `add`, `delete_own`, `delete_other`, `edit_own`, `edit_other`, `is_special`) VALUES
('200700000-1', 1, 1, 1, 1, 1, 1),
('20070000001', 0, 1, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `oto_pictures`
--

CREATE TABLE IF NOT EXISTS `oto_pictures` (
  `id_automobile` bigint(20) NOT NULL,
  `path` text NOT NULL,
  `thumb` text NOT NULL COMMENT '?????? ?????',
  `default` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'هل هذه الصورة هي الاساسية؟'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='??? ????????';

--
-- Dumping data for table `oto_pictures`
--

INSERT INTO `oto_pictures` (`id_automobile`, `path`, `thumb`, `default`) VALUES
(9, 'uploads/autobuy/13/04/9/medium/the-battle.jpg', 'uploads/autobuy/13/04/9/thumbnail/the-battle.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/logo.png', 'uploads/autobuy/13/04/8/thumbnail/logo.png', 1),
(8, 'uploads/autobuy/13/04/8/medium/back.jpg', 'uploads/autobuy/13/04/8/thumbnail/back.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/back.jpg', 'uploads/autobuy/13/04/8/thumbnail/back.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/back.jpg', 'uploads/autobuy/13/04/8/thumbnail/back.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/logo.png', 'uploads/autobuy/13/04/8/thumbnail/logo.png', 1),
(8, 'uploads/autobuy/13/04/8/medium/logo.png', 'uploads/autobuy/13/04/8/thumbnail/logo.png', 1),
(8, 'uploads/autobuy/13/04/8/medium/back.jpg', 'uploads/autobuy/13/04/8/thumbnail/back.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/logo.png', 'uploads/autobuy/13/04/8/thumbnail/logo.png', 1),
(3, 'uploads/autobuy/13/03/3/medium/marseille tux.png', 'uploads/autobuy/13/03/3/thumbnail/marseille tux.png', 1),
(8, 'uploads/autobuy/13/04/8/medium/back.jpg', 'uploads/autobuy/13/04/8/thumbnail/back.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/logo.png', 'uploads/autobuy/13/04/8/thumbnail/logo.png', 1),
(8, 'uploads/autobuy/13/04/8/medium/back.jpg', 'uploads/autobuy/13/04/8/thumbnail/back.jpg', 1),
(8, 'uploads/autobuy/13/04/8/medium/logo.png', 'uploads/autobuy/13/04/8/thumbnail/logo.png', 1),
(7, 'uploads/autobuy/13/04/7/medium/icons.png', 'uploads/autobuy/13/04/7/thumbnail/icons.png', 1),
(1, 'uploads/autobuy/13/03/1/medium/10042012018.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012018.jpg', 0),
(1, 'uploads/autobuy/13/03/1/medium/10042012019.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012019.jpg', 0),
(5, 'uploads/autobuy/13/03/5/medium/Ali Fouani.png', 'uploads/autobuy/13/03/5/thumbnail/Ali Fouani.png', 1),
(5, 'uploads/autobuy/13/03/5/medium/Nahed Fouani.png', 'uploads/autobuy/13/03/5/thumbnail/Nahed Fouani.png', 1),
(1, 'uploads/autobuy/13/03/1/medium/tux21.png', 'uploads/autobuy/13/03/1/thumbnail/tux21.png', 1),
(1, 'uploads/autobuy/13/03/1/medium/tux-ball.png', 'uploads/autobuy/13/03/1/thumbnail/tux-ball.png', 0),
(6, 'uploads/autobuy/13/03/6/medium/10042012019.jpg', 'uploads/autobuy/13/03/6/thumbnail/10042012019.jpg', 1),
(6, 'uploads/autobuy/13/03/6/medium/10042012018.jpg', 'uploads/autobuy/13/03/6/thumbnail/10042012018.jpg', 0),
(1, 'uploads/autobuy/13/03/1/medium/10042012020.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012020.jpg', 0),
(1, 'uploads/autobuy/13/03/1/medium/10042012022.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012022.jpg', 0),
(4, 'uploads/autobuy/13/03/4/medium/10042012024.jpg', 'uploads/autobuy/13/03/4/thumbnail/10042012024.jpg', 1),
(1, 'uploads/autobuy/13/03/1/medium/spaciotux4co.png', 'uploads/autobuy/13/03/1/thumbnail/spaciotux4co.png', 0),
(1, 'uploads/autobuy/13/03/1/medium/tux.png', 'uploads/autobuy/13/03/1/thumbnail/tux.png', 0),
(1, 'uploads/autobuy/13/03/1/medium/10042012021.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012021.jpg', 0),
(1, 'uploads/autobuy/13/03/1/medium/10042012024.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012024.jpg', 0),
(1, 'uploads/autobuy/13/03/1/medium/10042012023.jpg', 'uploads/autobuy/13/03/1/thumbnail/10042012023.jpg', 0),
(9, 'uploads/autobuy/13/04/9/medium/lets-get-out-of-here.jpg', 'uploads/autobuy/13/04/9/thumbnail/lets-get-out-of-here.jpg', 1),
(9, 'uploads/autobuy/13/04/9/medium/hiding-the-map.jpg', 'uploads/autobuy/13/04/9/thumbnail/hiding-the-map.jpg', 1),
(9, 'uploads/autobuy/13/04/9/medium/finding-the-key.jpg', 'uploads/autobuy/13/04/9/thumbnail/finding-the-key.jpg', 1),
(9, 'uploads/autobuy/13/04/9/medium/theres-the-buoy.jpg', 'uploads/autobuy/13/04/9/thumbnail/theres-the-buoy.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oto_sealofquality`
--

CREATE TABLE IF NOT EXISTS `oto_sealofquality` (
  `id_sealofquality` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `sealofquality_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='????? ????? ???;

--
-- Dumping data for table `oto_sealofquality`
--

INSERT INTO `oto_sealofquality` (`id_sealofquality`, `IdLang`, `sealofquality_name`) VALUES
(1, '20120000000', 'amag'),
(2, '20120000000', 'mini'),
(1, '20120000001', 'اماج'),
(2, '20120000001', 'ميني');

-- --------------------------------------------------------

--
-- Table structure for table `oto_title`
--

CREATE TABLE IF NOT EXISTS `oto_title` (
  `id_title` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='????? ??????? ?????';

--
-- Dumping data for table `oto_title`
--

INSERT INTO `oto_title` (`id_title`, `IdLang`, `title`) VALUES
(2, '20120000002', 'vxcvxcv dxfvdsf'),
(2, '20120000001', 'asdcxvxcvxc   sdf'),
(1, '20120000000', '1'),
(1, '20120000001', '1'),
(1, '20120000002', '1'),
(1, '20130000000', '1'),
(2, '20120000000', 'ad sfasf sadfhjg hjhgjhgj'),
(2, '20130000000', 'xcvxcvxcvxcvsdfdsf'),
(3, '20120000000', '1sadasdsad'),
(3, '20120000001', '1d1sadsa'),
(3, '20120000002', '1dsadsadsa'),
(3, '20130000000', '1dsadasdsa'),
(4, '20120000000', 'xxxxxxx'),
(4, '20120000001', 'xxxxxxxxxx'),
(4, '20120000002', 'xxxxxxxxxxxxxxx'),
(4, '20130000000', 'xxxxxxxxxx'),
(5, '20120000000', 'english title'),
(5, '20120000001', 'عنوان عربي'),
(5, '20120000002', 'tite en francais'),
(6, '20120000000', 'xxxx'),
(6, '20120000001', 'xxx'),
(6, '20120000002', 'xx'),
(7, '20120000000', 'car title'),
(7, '20120000001', 'عنوان السيارة'),
(7, '20120000002', 'tite de voiture'),
(8, '20120000000', 'RTYTRYTRY'),
(8, '20120000001', 'TRYRTYTR'),
(8, '20120000002', 'YRTYTRY'),
(9, '20120000000', 'HNGFNHGFH'),
(9, '20120000001', 'GFHFGH'),
(9, '20120000002', 'FGHGFHGF');

-- --------------------------------------------------------

--
-- Table structure for table `oto_type`
--

CREATE TABLE IF NOT EXISTS `oto_type` (
  `id_type` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='????-???;

--
-- Dumping data for table `oto_type`
--

INSERT INTO `oto_type` (`id_type`, `IdLang`, `type_name`) VALUES
(1, '20120000000', 'new'),
(2, '20120000000', 'used'),
(1, '20120000001', 'جديد'),
(2, '20120000001', 'مستعمل');

-- --------------------------------------------------------

--
-- Table structure for table `oto_wd`
--

CREATE TABLE IF NOT EXISTS `oto_wd` (
  `id_wd` int(11) NOT NULL,
  `IdLang` varchar(11) NOT NULL,
  `wd_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='4 wheel';

--
-- Dumping data for table `oto_wd`
--

INSERT INTO `oto_wd` (`id_wd`, `IdLang`, `wd_name`) VALUES
(1, '20120000000', '4weel'),
(2, '20120000000', 'traction'),
(1, '20120000001', 'دفع رباعي'),
(2, '20120000001', 'جر');

-- --------------------------------------------------------

--
-- Table structure for table `pagelang`
--

CREATE TABLE IF NOT EXISTS `pagelang` (
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الريكورد',
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `PageTitle` varchar(256) NOT NULL COMMENT 'عنوان الصفحة',
  `Content` longtext NOT NULL COMMENT 'محتوى الصفحة',
  PRIMARY KEY (`IdPage`,`IdLang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pagelang`
--

INSERT INTO `pagelang` (`IdPage`, `IdLang`, `PageTitle`, `Content`) VALUES
('20100000001', '20070000001', 'عنوان الصفحة الأولى', '<p>\r\n<script type="text/javascript" src="includes/jquery/jquery.js"></script>\r\n<script type="text/javascript" src="includes/jquery/easySlider1.7.js"></script>\r\n<script type="text/javascript">// <![CDATA[\r\n		$(document).ready(function(){	\r\n			$("#slider").easySlider({\r\n				auto: true, \r\n				continuous: true,\r\n				speed:2200\r\n			});\r\n		});\r\n// ]]></script>\r\n<link href="slide/screen.css" rel="stylesheet" type="text/css" media="screen" /></p>\r\n<table style="width: 608px;" cellpadding="2" cellspacing="2" border="0">\r\n<tbody>\r\n<tr>\r\n<td colspan="2" style="vertical-align: top;" dir="ltr">\r\n<div id="content">\r\n<div id="slider">\r\n<ul>\r\n<li><a href="Prog-exlink_Id-20100000000.pt"><img src="slide/01.jpg" alt="كل ما تحتاجه لبناء موقعك في برنامج واحد" title="كل ما تحتاجه لبناء موقعك في برنامج واحد" border="0" /></a></li>\r\n<li><a href="Prog-pages_pagenbr-4.pt"><img src="slide/02.jpg" alt="سهل الاستخدام" title="سهل الاستخدام" border="0" /></a></li>\r\n<li><a href="Prog-exlink_Id-20110000022_Lang-Arabic_nl-1.pt"><img src="slide/03.jpg" alt="حر مفتوح المصدر و مجاني" title="حر مفتوح المصدر و مجاني" border="0" /></a></li>\r\n<li><a href="Prog-getlicense.pt"><img src="slide/04.jpg" alt="دعم فني و مساعدة متوفرة ساعة تشاء" title="دعم فني و مساعدة متوفرة ساعة تشاء" border="0" /></a></li>\r\n<li><a href="Prog-pages_pagenbr-10.pt"><img src="slide/05.jpg" alt="كما يمكنك الانضمام الى فريق عملنا" title="كما يمكنك الانضمام الى فريق عملنا" border="0" /></a></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td colspan="2" valign="top"><a href="Prog-exlink_Id-20100000000.pt"><img style="border: 0px solid; width: 250px; height: 306px; float: left; margin: 0px;" title="phptransformer" src="slide/phpTransformer-software-box-2012.1_mini.png" alt="phptransformer" height="306" width="250" /></a>\r\n<p><strong>هل تريد إنشاء موقع للمؤسستك ,لعملك, لناديك, لشركتك, لجمعيتك , لحزبك ؟</strong><br /> phpTransformer سيقوم بكل شيء فهو سيدير موقعك بكل سلاسة و سهولة , مميزاته الأساسية ستجعل من موقعك يعمل وفق ما تريده و بدون ان يكون لديك خبرة برمجية, فهو يحتوي على برامج لاضافة صفحات غير محدودة و برامج أخرى للاخبار و التصويت و نظام أحصاءات جيد ... هناك الكثير .<br /> لا تنسى أن phpTransformer هو أول برنامج إدارة محتوى مواقع إنترنت متعدد اللغات, فإذا كنت تخطط حالياً أو في المستقبل لتوسعة موقعك باكثر من لغة فـ phpTransformer لديه الحل و ما عليك سوى الترجمة .<br /> phpTransformer برنامج حر مفتوح المصدر و <b>مجاني</b> و سيبقى كذلك دائماً, إذا كنت ترغب بالدعم الفني له فنحن على اتم الاستعداد لمساعدتك.<br /> phpTransformer تم البدء بتطويره سنة 2006 و ما زلنا نقوم بذلك بشكل يومي كي نؤمن لك برنامج تفتخر باستخدامه في موقعك على شبكة الإنترنت أو ضمن شبكتك الداخلية .</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td valign="top" width="300"><b><a href="Prog-exlink_Id-20100000000.pt">تنزيل آخر إصادرة من البرنامج </a></b> <br /> <br /> <a href="Prog-exlink_Id-20100000000.pt"><img title="download" style="border: 0px solid; width: 128px; height: 128px;" src="slide/download.png" alt="download" hspace="4" align="right" vspace="2" /></a>phpTransformer حر مفتوح المصدر يمكنك الحصول على آخر إصادرة منه <span style="font-weight: bold;">مجاناً</span> كما يمكنك الإطلاع على كامل كوده المصدري لأنه غير مشفر, كما يمكنك نسخه و اعادة توزيعه لمن تحب .</td>\r\n<td valign="top"><b><a href="Prog-getlicense.pt">الصيانة و الدعم الفني<br /> </a></b><br /> <a href="Prog-getlicense.pt"><img title="support" alt="support" src="slide/support.png" style="border: 0px solid; width: 128px; height: 128px;" hspace="4" align="right" vspace="2" /></a>من خلال الدعم الفني لموقعك ستحصل على مساعدة وأجوبة لكل استفسارتك و اولوية بالتحديثات الجديدة و حل المشاكل دون الانتظار لنزول الاصدارة التالية من phpTransformer .</td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><a href="Prog-pages_pagenbr-37.pt"><span style="font-size: small;">+ إنشاء موقع كامل من الصفر , تسجيل نطاق و استضافة و برنامج.</span></a></td>\r\n<td valign="top"><a href="Prog-exlink_Id-20110000023_Lang-Arabic_nl-1.pt"><span style="font-size: small;">+ إرسال تقرير بمشكلة تواجهها لمساعدتك في حلها.</span></a></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><img src="slide/none.gif" height="30" width="1" /></td>\r\n<td><img src="slide/none.gif" height="10" width="1" /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><a title="demo.phpTransformer.com" href="Prog-exlink_Id-20110000014.pt"><b>تجربة حية للبرنامج</b></a> <br /> <a title="demo.phpTransformer.com" href="Prog-exlink_Id-20110000014.pt"><img title="demo" style="border: 0px solid; width: 128px; height: 128px;" src="slide/demo.png" alt="demo" hspace="4" align="right" vspace="2" /></a><br /> تريد تجربة البرنامج قبل القيام بتنزيله على جهازك الخاص أو ليس لديك خبرة تقنية في المواقع ؟ لقد جهزنا لك موقع لتقوم بالتجربة و اكتشاف مميزات&nbsp; phpTransformer&nbsp; .</td>\r\n<td><a href="Prog-pages_pagenbr-38.pt"><b>المطورين </b></a> <br /> <a href="Prog-pages_pagenbr-38.pt"><img title="developpers" style="border: 0px solid; width: 128px; height: 128px;" src="slide/developpers.png" alt="developpers" hspace="4" align="right" vspace="2" /></a><br /> هل انت مبرمج أو مصمم أو مدير مواقع و تريد معرفة الخصائص التقنية لـ&nbsp; phpTransformer و ما يميزه عن باقي البرامج المناقسة , و ما يمكنه ان يساعدك في تطوير قدراتك ؟</td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><span style="font-size: small;"><a href="Prog-pages_pagenbr-40_Lang-Arabic_nl-1.pt">+ لائحة ببعض المواقع التي تعمل على phpTransformer .</a><br /> </span></td>\r\n<td><a href="Prog-pages_pagenbr-39.pt"><span style="font-size: small;">+ معلومات عن ما الجديد و التغييرات في آخر إصدارة من البرنامج . </span></a></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><img src="slide/none.gif" height="30" width="1" /></td>\r\n<td valign="top"><img src="slide/none.gif" height="30" width="1" /></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><a href="Prog-pages_pagenbr-10.pt"><span style="font-weight: bold;">فريق عملنا</span></a><br /> <a href="Prog-pages_pagenbr-10.pt"><img title="Team" style="border: 0px solid; width: 128px; height: 128px;" alt="Team" src="slide/team.png" hspace="4" align="right" vspace="2" /></a> نحن نعمل ضمن مجتمع يحارب الإحتكار و يشجع البرمجيات الحرة, فريقنا محترف و يحب ما يصنع , تعرف علينا واكتشف من وراء نجاح&nbsp; phpTransformer و كيف&nbsp; أصبح المشروع حقيقة .</td>\r\n<td valign="top"><a href="Prog-pages_pagenbr-43_Lang-Arabic_nl-1.pt"><span style="font-weight: bold;">&nbsp;إنضم إلينا و أنجح معنا</span></a><br /> <a href="Prog-pages_pagenbr-43_Lang-Arabic_nl-1.pt"><img title="JoinUs" style="border: 0px solid; width: 128px; height: 128px;" alt="JoinUs" src="slide/joinus.png" hspace="4" align="right" vspace="2" /></a>phpTransformer أكثر من شركة نحن فريق عمل نجمع طاقاتنا معاً و نعمل بكل حرية و ننسق فيما بيننا و في النهاية كلنا نربح ! <br /> نحن مجتمع يتشارك طاقاته بكل محبة, نتكافل و نساند بعضنا .</td>\r\n</tr>\r\n<tr>\r\n<td style="vertical-align: top;"><a href="Prog-pages_pagenbr-41.pt"><span style="font-size: small;">+ تعرف على فلسفة البرمجيات الحرة , إعرف حقوقك. </span></a></td>\r\n<td style="vertical-align: top;"><a href="Prog-share.pt"><span style="font-size: small;">+ أرسل إلينا مساهماتك سواء كنت مبرمجاً أو مصمما أو مترجماً ...</span></a></td>\r\n</tr>\r\n<tr>\r\n<td valign="top"><img src="slide/none.gif" height="30" width="1" /></td>\r\n<td valign="top"></td>\r\n</tr>\r\n<tr>\r\n<td style="vertical-align: top;"><a href="Prog-news.pt"><span style="font-weight: bold;">أخبار المشروع</span></a><br /> <a href="Prog-news.pt"><img style="border: 0px solid; width: 128px; height: 128px;" alt="news" title="news" src="slide/news.png" hspace="4" align="right" vspace="2" /></a>كن دائما على تماس معنا ,إطلع على آخر أخبار المشروع و الإصدارات و التحديثات و تشارك بها مع أصدقائك او انشرها في مدونتك أو موقعك التقني .</td>\r\n<td style="vertical-align: top;"><a href="Prog-gallery.pt"><span style="font-weight: bold;">أدلة&nbsp; و منشورات</span></a><br /> <a href="Prog-gallery.pt"><img title="guides" style="border: 0px solid; width: 128px; height: 128px;" alt="guides" src="slide/guides.png" hspace="4" align="right" vspace="2" /></a> إحصل على معلومات إضافية من كتب و أدلة إستخدام و لقطات الشاشة و فيديو توضيحي لـ phpTransformer و هو يعمل .</td>\r\n</tr>\r\n<tr>\r\n<td style="vertical-align: top;"><a href="Prog-rss.pt"><span style="font-size: small;">+ إشترك بخلاصات الأخبار RSS . </span></a></td>\r\n<td style="vertical-align: top;"><a href="Prog-pages_pagenbr-13.pt"><span style="font-size: small;">+ إحصل على أجوبة عن أسئلة ترد إلينا بشكل متكرر . </span></a></td>\r\n</tr>\r\n</tbody>\r\n</table>'),
('20140000002', '20130000001', 'tytry', 'rtytry'),
('20140000001', '20130000002', 'kafer', '<object classid="clsid:02bf25d5-8c17-4b23-bc80-d3488abddc6b" codebase="http://www.apple.com/qtactivex/qtplugin.cab#version=6,0,2,0">\r\n<param name="src" value="http://localhost/phptransformer//uploads/gallery/Albums/kafer.flv">\r\n<embed src="http://localhost/phptransformer//uploads/gallery/Albums/kafer.flv" type="video/quicktime" quality="high">\r\n</object>\r\n<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0">\r\n<param name="src" value="http://localhost/phptransformer//uploads/gallery/Albums/kafer.flv">\r\n<embed src="http://localhost/phptransformer//uploads/gallery/Albums/kafer.flv" type="application/x-shockwave-flash" quality="high">\r\n</object>\r\n<div dir="rtl" style="text-align:left">dfsdfdasdsadsad<br>asdsadsad<br></div>'),
('20140000001', '20120000001', 'erewr', 'werwer'),
('20140000001', '20130000001', 'werewr', 'serewr'),
('20140000000', '20120000001', 'شسيشسي', '<a href="http://localhost/phptransformer/Prog-exlink_Id-20140000002_Lang-Arabic_nl-1.pt">test</a>'),
('20140000000', '20140000001', 'dsfdsf', 'dsfd'),
('20140000000', '20130000001', 'qwdasd', '<a href="http://localhost/phptransformer/Prog-exlink_Id-20140000001_Lang-English_nl-1.ptums/tux icones/linux-inside.png"><img style="width:960px;height:720px" src="http://localhost/phptransformer//uploads/gallery/Albums/medium/71869.jpg">linux-inside.png</a>'),
('20140000000', '20130000002', 'قلف٤٣٥٣', '<a href="http://localhost/phptransformer/Prog-exlink_Id-20140000001_Lang-English_nl-1.ptums/tux icones/Red%20Bull%20Stratos%20-%20Felix%20Baumgartner%20freefall%20-%20animation%20jump%20from%20the%20edge%20of%20space%20%28SD%29.mp4">Red Bull Stratos - Felix Baumgartner freefall - animation jump from the edge of space (SD).mp4<img style="width:128px;height:128px" src="http://localhost/phptransformer//uploads/gallery/Albums/tux icones/corbeille-a_la-fouine_divers.png"></a>'),
('20130000006', '20130000001', 'sdfsdaf', '<p>sdfdsf</p>'),
('20130000006', '20120000001', 'werewr', '<p style="text-align: center;">er er ewr</p>\r\n<p>sd sdf dsf </p>'),
('20130000005', '20130000001', 'dfdsf', '<p>&lt;html</p>'),
('20100000001', '20070000002', 'Page Title', '<p>Page number <strong>one </strong>content</p>\r\n<p><img src="images/phpTransformer-software-box-2.0.png" alt="" /></p>'),
('20130000003', '20120000001', 'wewqre', '<p style="text-align: center;"><strong>afrqwdwqsd</strong></p>'),
('20130000004', '20120000001', 'gufygtu', '%3Chtml'),
('20130000004', '20130000001', 'gfuftu', '%3Chtml'),
('20130000001', '20130000001', 'بلؤاﻻبلؤابل', 'ابلابلاب'),
('20130000002', '20120000001', 'almajed', '<div align="center">sadfsad</div>'),
('20130000005', '20120000001', 'sdfdsfdsf', '<p>gdf <strong>gd gdfg</strong> df gf</p>'),
('20140000002', '20120000001', 'rtyrty', '<div style="width:600px;height:600px;border:1px #ff0000 solid">\r\n<img style="width:349px;height:232px;vertical-align:middle" src="http://localhost/phptransformer//uploads/gallery/Albums/1.png">  \r\n</div>'),
('20130000001', '20120000001', 'عنوان الصفحة', 'شسي سشي<a href="index.php?Prog=exlink&Id=20120000000&Lang=Arabic&nl=1"> شسي شسي</a> سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي يسش سي شيسشسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي  شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي</div></div></div></div></div>  <div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي يسش سي شيس<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي يسش سي شيس<div>&nbsp;شسي سشي شسي شسي سشي شسيسش يسشي سش يسشي شسي ي<br></div></div></div>'),
('20140000003', '20140000001', 'شسيبسشبش', 'شسصشسي'),
('20140000003', '20120000001', 'شسيشسي', 'شصشصثق'),
('20140000003', '20130000001', 'سشيش', 'شثبشث'),
('20140000003', '20140000000', 'شسيسشي', 'سشيبشسي<img style="width:600px;height:233px" src="http://localhost/phptransformer//uploads/gallery/Albums/third/0526fd00a7.png">'),
('20140000004', '20120000001', 'asdsad', 'asdsad  \r sadsad\r asdsad\r asdasd\r asdsad\r asdasd\r asdsad'),
('20140000005', '20120000001', 'qwewqe', 'wqeqw\r  qwewq\r  qwewqe\r  qweqwe\r  qwewqe\r  qweqwe'),
('20140000006', '20120000001', 'sdfdf', 'asdsad\r&nbsp;asdsad\r&nbsp;gfhgfh\r&nbsp;ertret\r&nbsp;fgdfgfd\r&nbsp;vccxvc'),
('20140000007', '20120000001', 'wewe', '<table rules="none"><caption>wewe</caption><tbody><tr><td>&nbsp;2</td><td>&nbsp;1</td></tr><tr><td>&nbsp;4</td><td>&nbsp;3</td></tr></tbody></table>  \r&nbsp;xzcxzcxzc<br>يسبيسبيسبسب<br>قفغففقغ قثف قثف قثف ثقف قث&nbsp; <sub>سييبسش</sub> يسي س س <sup>يسبالللب</sup> البالب  \r&nbsp;<div>\r&nbsp;sdfdsfsdf\r&nbsp;</div>'),
('20140000008', '20120000001', 'عععع', 'عععع'),
('20140000008', '20130000001', 'llllll', 'llll');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `IdPage` varchar(11) NOT NULL COMMENT 'رقم الريكورد',
  `PageNbr` bigint(11) DEFAULT NULL,
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقم العنصر للصلاحيات',
  `Hits` double NOT NULL COMMENT 'عدد الزيارات',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هذه الصفحة محذوفة ؟',
  PRIMARY KEY (`IdPage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`IdPage`, `PageNbr`, `ObjectId`, `Hits`, `Deleted`) VALUES
('20130000000', 1, '20130000006', 5, '0'),
('20130000001', 2, '20130000007', 68, '1'),
('20130000002', 3, '20130000008', 1, '1'),
('20130000003', 4, '20130000009', 1, '1'),
('20130000004', 5, '20130000010', 1, '1'),
('20130000005', 6, '20130000011', 2, '1'),
('20100000001', 1, '', 1, '0'),
('20130000006', 7, '20130000012', 1, '1'),
('20140000000', 8, '20140000000', 12, '1'),
('20140000001', 9, '20140000001', 2, '1'),
('20140000002', 10, '20140000002', 1, '1'),
('20140000003', 11, '20140000003', 9, '1'),
('20140000004', 12, '20140000004', 1, '1'),
('20140000005', 13, '20140000005', 1, '1'),
('20140000006', 14, '20140000006', 1, '1'),
('20140000007', 15, '20140000007', 1, '1'),
('20140000008', 16, '20140000008', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `params`
--

CREATE TABLE IF NOT EXISTS `params` (
  `MainPrograms` varchar(15) NOT NULL COMMENT 'البرنامج الافتراضي',
  `DefaultLang` varchar(15) NOT NULL COMMENT 'اللغة الافتراضية',
  `DefaultThem` varchar(15) NOT NULL COMMENT 'الشكل الافتراضي',
  `AutoLang` varchar(1) NOT NULL COMMENT 'استعمال خيار فحص اللغة الاتوماتي',
  `ConvertAt` varchar(1) NOT NULL COMMENT 'تحويل @الى صورة',
  `ExternalLinks` varchar(1) NOT NULL COMMENT 'السماح بالروابط الخارجية',
  `UseRew` varchar(1) NOT NULL COMMENT 'استعمال url rew',
  `CookieAge` varchar(15) NOT NULL COMMENT 'عمر الكوكيز الافتراضي',
  `IsOpen` varchar(1) NOT NULL COMMENT 'هل الموقع مفتوح نعم او لا',
  `DateGmt` varchar(3) NOT NULL COMMENT 'وقت الموقع بالنسبة لغرينتش',
  `ViewTopCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewMarqueeCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewMenuCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewMainCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewSecCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewFootCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `ViewProgCont` varchar(1) NOT NULL COMMENT 'مشاهدة البلوكات في البرنامج الافتراضي',
  `OpenRegister` varchar(1) NOT NULL COMMENT 'الموقع سامح لتسجيل اعضاء جدد او لا',
  `GeoIpService` varchar(255) NOT NULL COMMENT 'الموقع الذي سيقدم خدمة تحديد بلد الايبي المتصل بالموقع',
  `AdminRegOk` varchar(1) NOT NULL COMMENT 'يجب ان يوافق المدير على تفعيل تسجيل الاعضاء الجدد',
  `MaxNbrPost` varchar(2) NOT NULL COMMENT 'العدد الاقصى لمحاولة ارسال معلومات خطأ',
  `DefaulPageNbr` varchar(3) NOT NULL COMMENT 'رقم الصفحة الافتراضية لبرنام الصفحات',
  `NewsMaxNbr` varchar(3) NOT NULL COMMENT 'العدد الاقصى للاخبار في صفحة الاخبار',
  `FloodSec` varchar(5) NOT NULL COMMENT 'عدد الثواني بين طلب كل صفحة من نفس المستخدم',
  `GuestCanWrite` varchar(1) NOT NULL COMMENT 'هل يسمح للزوار بالمشاركة دون تسجيل',
  `RobotAdmin` varchar(1) NOT NULL COMMENT 'استعمال المدير الالي',
  `MailList` varchar(11) NOT NULL COMMENT 'عدد الاعضاء الذين سيرسلهم لهم اخر بريد',
  `License` text NOT NULL COMMENT 'مفتاح الترخيص',
  `LastProg` varchar(35) NOT NULL COMMENT 'اخر برنامج تمت ادارته من لوحة تحكم المدير',
  `LastBlock` varchar(35) NOT NULL COMMENT 'اخر بلوك تمت ادارته من لوحة تحكم المدير',
  `EmailMethode` varchar(35) NOT NULL COMMENT 'smtp or sendmail',
  `CacheEnabled` int(1) NOT NULL,
  `TimeCache` int(100) NOT NULL,
  `IgnoreList` longtext NOT NULL,
  `WebSiteFullName` text NOT NULL,
  `GoogleCode` varchar(26) NOT NULL COMMENT 'Google analytics pageTracker ',
  `EnableStatistics` tinyint(1) NOT NULL COMMENT 'هل نظام الاحصائيات مفعل',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  `UpdateName` text NOT NULL COMMENT 'اسم الاصدارة الجديدة',
  `android_key` text NOT NULL,
  `apple_key` text NOT NULL,
  `awsAccessKey` varchar(50) NOT NULL COMMENT 'Amazon cloud access key',
  `awsSecretKey` varchar(100) NOT NULL COMMENT 'amazon cloud secret key',
  `youtube_api_key` varchar(100) NOT NULL,
  `youtube_username` varchar(100) NOT NULL,
  `youtube_password` varchar(100) NOT NULL,
  PRIMARY KEY (`MainPrograms`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خصائص الوقع الافتراضية';

--
-- Dumping data for table `params`
--

INSERT INTO `params` (`MainPrograms`, `DefaultLang`, `DefaultThem`, `AutoLang`, `ConvertAt`, `ExternalLinks`, `UseRew`, `CookieAge`, `IsOpen`, `DateGmt`, `ViewTopCont`, `ViewMarqueeCont`, `ViewMenuCont`, `ViewMainCont`, `ViewSecCont`, `ViewFootCont`, `ViewProgCont`, `OpenRegister`, `GeoIpService`, `AdminRegOk`, `MaxNbrPost`, `DefaulPageNbr`, `NewsMaxNbr`, `FloodSec`, `GuestCanWrite`, `RobotAdmin`, `MailList`, `License`, `LastProg`, `LastBlock`, `EmailMethode`, `CacheEnabled`, `TimeCache`, `IgnoreList`, `WebSiteFullName`, `GoogleCode`, `EnableStatistics`, `LastChekUpdate`, `UpdateAvailble`, `UpdateDesc`, `UpdateName`, `android_key`, `apple_key`, `awsAccessKey`, `awsSecretKey`, `youtube_api_key`, `youtube_username`, `youtube_password`) VALUES
('home', 'Arabic', 'Default', '0', '0', '1', '1', 'Month', '1', '2', '1', '1', '1', '1', '1', '1', '1', '1', 'http://phptransformer.com/GeoIpDectecter/index.php?ip=', '0', '5', '1', '6', '0.06', '1', '0', '4', '', 'pool', 'AccountBlock', 'sendmail', 0, 86400, '', 'موقعي الرائع', 'xxxxxx', 1, '2014-07-23 10:30:24', 0, '', '', 'AIzaSyClEAUvh9UVRvSgYORNXXx-6uNTBGcTsCc', 'abc', 'AKIAICX6RM4FERNJ5OGQ', 'xB2JBFpAmdOyHKrQCmlqCEzaYFfYEohWCR1bMMDB', 'AIzaSyCj_FczAzkNCcnwI0Yua5C2xRej5qoKcLQ', 'info@cyberaman.com', 'F0macg44');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` varchar(11) NOT NULL COMMENT 'رقم الاضافة',
  `name` varchar(1024) NOT NULL COMMENT 'اسم الاضافة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='جدول الاضافات المفعلة';

-- --------------------------------------------------------

--
-- Table structure for table `poolchoices`
--

CREATE TABLE IF NOT EXISTS `poolchoices` (
  `idpc` varchar(11) NOT NULL COMMENT 'رقم الخيار',
  `idpt` varchar(11) NOT NULL COMMENT 'رقم التصويت',
  `cheked` varchar(1) NOT NULL COMMENT 'هل هو معلم',
  PRIMARY KEY (`idpc`,`idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خيارت التصويت';

--
-- Dumping data for table `poolchoices`
--

INSERT INTO `poolchoices` (`idpc`, `idpt`, `cheked`) VALUES
('20140000000', '20140000000', '0'),
('20140000001', '20140000000', '1'),
('20140000002', '20140000000', '0'),
('20140000003', '20140000000', '0'),
('20100000000', '20100000000', '0'),
('20100000001', '20100000000', '1'),
('20100000002', '20100000000', '0'),
('20100000003', '20100000000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `poollangchoices`
--

CREATE TABLE IF NOT EXISTS `poollangchoices` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `idpc` varchar(11) NOT NULL COMMENT 'رقم خيار التصويت',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم عنوان الخيار',
  `Choise` varchar(100) NOT NULL COMMENT 'الخيار بهذه اللغة',
  PRIMARY KEY (`IdLang`,`idpc`,`Idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='خيارات التصويت بلغة معينة';

--
-- Dumping data for table `poollangchoices`
--

INSERT INTO `poollangchoices` (`IdLang`, `idpc`, `Idpt`, `Choise`) VALUES
('20120000001', '20140000000', '20140000000', 'المشاريع الرياضية'),
('20120000001', '20140000001', '20140000000', 'المشاريع الضحية'),
('20120000001', '20140000002', '20140000000', 'البنى التحتية'),
('20120000001', '20140000003', '20140000000', 'تجميل البلدة'),
('20130000001', '20140000000', '20140000000', 'asdsadsadsa'),
('20130000001', '20140000001', '20140000000', 'tytryrtyrt'),
('20130000001', '20140000002', '20140000000', 'sadsadasd'),
('20130000001', '20140000003', '20140000000', 'retertert'),
('20070000001', '20100000000', '20100000000', 'سعر قليل أو مجاني'),
('20070000001', '20100000001', '20100000000', 'حر مفتوح المصدر'),
('20070000001', '20100000002', '20100000000', 'سهولة استعماله'),
('20070000001', '20100000003', '20100000000', 'إنتشاره بشكل واسع'),
('20070000002', '20100000000', '20100000000', 'low cost or Free'),
('20070000002', '20100000001', '20100000000', 'Free Open source'),
('20070000002', '20100000002', '20100000000', 'Easy of use'),
('20070000002', '20100000003', '20100000000', 'Spread widely'),
('20140000000', '20140000003', '20140000000', 'f4'),
('20140000000', '20140000002', '20140000000', 'f3'),
('20140000000', '20140000001', '20140000000', 'f2'),
('20140000000', '20140000000', '20140000000', 'f1'),
('20140000001', '20140000003', '20140000000', 'd4'),
('20140000001', '20140000002', '20140000000', 'd3'),
('20140000001', '20140000001', '20140000000', 'd2'),
('20140000001', '20140000000', '20140000000', 'd1');

-- --------------------------------------------------------

--
-- Table structure for table `poollangtitles`
--

CREATE TABLE IF NOT EXISTS `poollangtitles` (
  `IdLang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم العنوان',
  `Title` varchar(100) NOT NULL COMMENT 'العنوان بهذه اللغة',
  PRIMARY KEY (`IdLang`,`Idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='نص عنوان باللغات';

--
-- Dumping data for table `poollangtitles`
--

INSERT INTO `poollangtitles` (`IdLang`, `Idpt`, `Title`) VALUES
('20140000001', '20140000000', 'ddd'),
('20120000001', '20140000000', 'ما المشروع الذي يحتل اولوية عندك كي تنجزه البلدية ؟'),
('20130000001', '20140000000', 'sadsadsad'),
('20140000000', '20140000000', 'fff');

-- --------------------------------------------------------

--
-- Table structure for table `pooltitle`
--

CREATE TABLE IF NOT EXISTS `pooltitle` (
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم التصويت',
  `poolstart` datetime NOT NULL COMMENT 'تاريخ بدء التصويت',
  `poolend` datetime NOT NULL COMMENT 'تاريخ نهاية التصويت',
  `multichoice` varchar(1) NOT NULL COMMENT 'هل يسمح بتعدد الخيارات',
  `published` varchar(1) NOT NULL COMMENT 'هل مجهز للنشر',
  `lastpol` varchar(1) NOT NULL COMMENT 'هل هو ىخر تصويت',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل التصويت محذوف؟',
  PRIMARY KEY (`Idpt`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='التصويتات';

--
-- Dumping data for table `pooltitle`
--

INSERT INTO `pooltitle` (`Idpt`, `poolstart`, `poolend`, `multichoice`, `published`, `lastpol`, `Deleted`) VALUES
('20140000000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', '1', '0', ''),
('20100000000', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '1', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `poolusers`
--

CREATE TABLE IF NOT EXISTS `poolusers` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `Idpt` varchar(11) NOT NULL COMMENT 'رقم عنوان التصويت',
  `idpc` varchar(11) NOT NULL COMMENT 'رقم الخيار المصوت له',
  `IpPool` varchar(15) NOT NULL COMMENT 'رقم ايبي التصويت',
  `Comment` varchar(250) NOT NULL COMMENT 'تعليق المستخدم'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='تصويت المستخدمين';

--
-- Dumping data for table `poolusers`
--

INSERT INTO `poolusers` (`UserId`, `Idpt`, `idpc`, `IpPool`, `Comment`) VALUES
('20070000000', '20140000000', '20140000000', '127.0.0.22', ''),
('20070000000', '20140000000', '20140000003', '127.0.0.13', ''),
('20070000000', '20140000000', '20140000001', '127.0.0.136', ''),
('20070000000', '20140000000', '20140000001', '127.0.0.146', ''),
('20070000000', '20140000000', '20140000002', '127.0.0.112', ''),
('20070000000', '20140000000', '20140000003', '127.0.0.189', ''),
('20070000000', '20140000000', '20140000001', '127.0.0.155', ''),
('20070000000', '20140000000', '20140000000', '127.0.0.33', ''),
('20070000000', '20140000000', '20140000002', '127.0.0.1', 'assadsa');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE IF NOT EXISTS `programs` (
  `IdProgram` varchar(11) NOT NULL COMMENT 'رقم البرنامج',
  `ProgramName` varchar(35) NOT NULL COMMENT 'اسم البرنامج',
  `Permission` varchar(1) NOT NULL COMMENT 'صلاحية للجميع ',
  `ViewTopCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewMarqueeCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewMenuCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewMainCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewSecCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewFootCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ViewProgCont` varchar(1) NOT NULL COMMENT 'مشاهدة هذا الـ container 1 نعم 0 لا',
  `ObjectId` varchar(11) NOT NULL COMMENT 'رقمه المرتبط بالسيكيوريتي',
  `Hits` double NOT NULL DEFAULT '0' COMMENT 'عدد المشاهدات',
  `Deleted` varchar(2) NOT NULL COMMENT 'محذوف الى سلة المحذوفات؟',
  `License` text NOT NULL COMMENT 'مفتاح الترخيص',
  `cached` int(1) NOT NULL,
  `cachetime` int(100) NOT NULL COMMENT 'وقت الحفظ',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  UNIQUE KEY `IdProgram` (`IdProgram`,`ProgramName`),
  UNIQUE KEY `ProgramName` (`ProgramName`),
  UNIQUE KEY `ProgramName_2` (`ProgramName`),
  UNIQUE KEY `ProgramName_3` (`ProgramName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`IdProgram`, `ProgramName`, `Permission`, `ViewTopCont`, `ViewMarqueeCont`, `ViewMenuCont`, `ViewMainCont`, `ViewSecCont`, `ViewFootCont`, `ViewProgCont`, `ObjectId`, `Hits`, `Deleted`, `License`, `cached`, `cachetime`, `LastChekUpdate`, `UpdateAvailble`, `UpdateDesc`) VALUES
('20070000000', 'pages', '1', '1', '1', '1', '1', '1', '1', '1', '20070000000', 102, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 1, 86400, '0000-00-00 00:00:00', 0, ''),
('20070000001', 'account', '1', '1', '1', '1', '1', '1', '1', '1', '20070000001', 91, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000003', 'tellfriend', '1', '1', '1', '1', '1', '1', '1', '1', '20070000003', 6, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000004', 'pool', '1', '1', '1', '1', '1', '1', '1', '1', '20070000009', 4, '0', '007AxMDozOTo0MQ==694338bc8475ec94MjAxMi0xMi0yOCAxMDozOTowMA==MjAxMy0xMi0zMC3a0e4553a783180fA88231C846AF3B75EDE643AC1C713506c2hhbXNyZXN0YXVyYW50LmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000005', 'usercp', '1', '1', '1', '1', '1', '1', '1', '1', '20070000010', 166, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000007', 'news', '1', '1', '1', '1', '1', '1', '1', '1', '20070000001', 424, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000008', 'ads', '1', '0', '1', '1', '1', '1', '1', '1', '20070000012', 5, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20070000009', 'exlink', '1', '1', '1', '1', '1', '1', '1', '1', '20070000016', 4, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20080000012', 'contactus', '1', '0', '0', '0', '0', '0', '0', '1', '20080000018', 7, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20080000020', 'rss', '1', '0', '0', '0', '0', '0', '0', '1', '20080000029', 14, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20110000001', 'gallery', '1', '1', '1', '1', '1', '0', '1', '1', '20110000003', 214, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000000', 'hosting', '1', '1', '1', '1', '0', '1', '1', '1', '20120000000', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000001', 'hiba', '1', '1', '1', '1', '1', '1', '1', '1', '20120000003', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000002', 'autobuy', '1', '1', '0', '1', '1', '0', '1', '1', '20120000005', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000003', 'services', '1', '1', '1', '1', '1', '1', '1', '1', '20120000006', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000004', 'gmap', '1', '1', '1', '1', '1', '1', '1', '1', '20120000010', 1, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000005', 'location', '1', '1', '1', '1', '1', '1', '1', '1', '20120000011', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000006', 'shamscontact', '1', '1', '1', '1', '1', '1', '1', '1', '20120000012', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000007', 'restcontact', '1', '1', '1', '1', '1', '1', '1', '1', '20120000013', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000008', 'welcome', '1', '1', '1', '1', '1', '1', '1', '1', '20120000014', 1, '0', 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20120000009', 'newsads', '1', '1', '1', '1', '1', '1', '1', '1', '20120000016', 6, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000000', 'mobawab', '1', '1', '1', '1', '1', '1', '1', '1', '20130000000', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000001', 'fomaconakdi', '1', '1', '1', '1', '1', '1', '1', '1', '20130000002', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000002', 'weather', '1', '1', '1', '1', '1', '1', '1', '1', '20130000004', 2, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000003', 'careers', '1', '1', '1', '1', '0', '0', '1', '1', '20130000005', 16, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000004', 'catalog', '1', '1', '1', '1', '1', '1', '1', '1', '20130000006', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000005', 'gadget', '1', '1', '1', '1', '1', '1', '1', '1', '20130000007', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000006', 'mediacenter', '1', '1', '1', '1', '1', '1', '1', '1', '20130000008', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20130000007', 'messagecenter', '1', '1', '1', '1', '1', '1', '1', '1', '20130000009', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20140000000', 'mygmap3', '1', '1', '1', '1', '1', '1', '1', '1', '20140000000', 8, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20140000001', 'share', '1', '1', '1', '1', '1', '1', '1', '1', '20140000001', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20140000002', 'getlicense', '1', '1', '1', '1', '1', '1', '1', '1', '20140000002', 1, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20140000003', 'home', '1', '1', '1', '1', '1', '1', '1', '1', '20140000003', 1021, '0', '', 0, 0, '0000-00-00 00:00:00', 0, ''),
('20140000004', 'cybernews', '1', '1', '1', '1', '1', '1', '1', '1', '20140000005', 629, '0', '', 0, 0, '0000-00-00 00:00:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pt_menu`
--

CREATE TABLE IF NOT EXISTS `pt_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '1',
  `href` text,
  `icon` text,
  `target` text,
  `orderfield` int(11) DEFAULT '0',
  `expanded` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

--
-- Dumping data for table `pt_menu`
--

INSERT INTO `pt_menu` (`id`, `parent_id`, `href`, `icon`, `target`, `orderfield`, `expanded`) VALUES
(64, 2, '#', 'none.gif', '', 64, 0),
(4, 0, '4', 'quanta.png', '4', 3, 0),
(14, 0, '', 'pan-icon-mini.png', '', 14, 0),
(24, 2, '', 'none.gif', '', 24, 0),
(34, 14, '', 'www.kde.org_favicon.png', '', 34, 0),
(44, 0, '', 'none.gif', '', 3, 0),
(54, 0, '', 'none.gif', '', 54, 0),
(74, 0, '#', 'none.gif', '', 3, 0),
(84, 2, '', 'none.gif', '', 84, 0),
(94, 2, '', 'none.gif', '', 94, 0),
(104, 2, '', 'none.gif', '', 104, 0),
(114, 2, '', 'none.gif', '', 114, 0),
(124, 2, '', 'none.gif', '', 124, 0),
(134, 2, '', 'none.gif', '', 134, 0),
(144, 2, '', 'none.gif', '', 144, 0),
(204, 0, 'eee', 'none.gif', 'ffff', 3, 0),
(2, 0, '2', 'quanta.png', '2', 22, 0),
(99, 1, '3', 'i', '_', 20, 30),
(164, 0, '#', 'none.gif', 'sdfgdsf', 3, 0),
(184, 0, '3', 'quanta.png', '3', 3, 0),
(194, 154, '555', 'none.gif', '666', 154, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pt_menu_lang`
--

CREATE TABLE IF NOT EXISTS `pt_menu_lang` (
  `IdLang` varchar(11) NOT NULL,
  `id` int(11) NOT NULL,
  `text` text,
  `title` text,
  PRIMARY KEY (`IdLang`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pt_menu_lang`
--

INSERT INTO `pt_menu_lang` (`IdLang`, `id`, `text`, `title`) VALUES
('20130000001', 64, '', ''),
('20120000001', 64, '', ''),
('20140000001', 2, 'dddd', 'rrr'),
('20120000001', 194, '1111', '222'),
('20120000001', 184, 'نص3', 'نص3'),
('20140000001', 4, 'ddd', 'ddd'),
('20140000001', 194, '333', '444'),
('20140000001', 14, 'dddd', '234324'),
('20120000001', 24, 'نصر', 'شسيشسي'),
('20130000001', 24, 'شسيسشي', 'شسيسشي'),
('20120000001', 34, 'شسيشسي  سشي شسي', 'ؤﻻرؤﻻل بيل يسس يصش سش'),
('20130000001', 34, 'asdasdsad asd sad ', 'gfhg f hgffghfg hg'),
('20140000001', 44, '56546', '546546'),
('20140000001', 184, '9999', '8888'),
('20120000001', 54, 'ءؤرﻻؤءر ؤرؤء ', 'ءؤر ر ءؤر'),
('20130000001', 54, 'VCNVBNBV ', 'C VBVCB V'),
('20140000000', 64, '', ''),
('20140000001', 64, '', ''),
('20140000001', 164, 'list', 'sdfsdf'),
('20140000001', 74, 'asdsad', 'sdsad'),
('20120000001', 84, '', ''),
('20130000001', 84, '', ''),
('20140000000', 84, '', ''),
('20140000001', 84, '', ''),
('20120000001', 94, '', ''),
('20130000001', 94, '', ''),
('20140000000', 94, '', ''),
('20140000001', 94, '', ''),
('20120000001', 104, '', ''),
('20130000001', 104, '', ''),
('20140000000', 104, '', ''),
('20140000001', 104, '', ''),
('20120000001', 114, '', ''),
('20130000001', 114, '', ''),
('20140000000', 114, '', ''),
('20140000001', 114, '', ''),
('20120000001', 124, '', ''),
('20130000001', 124, '', ''),
('20140000000', 124, '', ''),
('20140000001', 124, '', ''),
('20120000001', 134, '', ''),
('20140000001', 134, '', ''),
('20120000001', 144, '', ''),
('20140000001', 144, '', ''),
('20120000001', 204, 'aaaaa', 'bbbb'),
('20140000001', 204, 'cccc', 'dddd');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE IF NOT EXISTS `screens` (
  `ScreenXY` varchar(10) NOT NULL COMMENT 'ارتفاع و عرض الشاشة',
  `Hits` bigint(7) NOT NULL COMMENT 'عدد الشاشات'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='احصائيات شاشات الزوار';

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`ScreenXY`, `Hits`) VALUES
('Anknow', 28),
('1024x768', 1),
('1440x900', 57),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('1608x1005', 1),
('1366x768', 1),
('1320x825', 1),
('Anknow', 28),
('1024x768', 1),
('1440x900', 57),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('Anknow', 28),
('1024x768', 1),
('1440x900', 57),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('Anknow', 28),
('1024x768', 1),
('1440x900', 57),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('480x854', 1),
('960x1068', 1),
('Anknow', 28),
('1024x768', 1),
('1440x900', 57),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('Anknow', 28),
('1024x768', 1),
('1440x900', 57),
('1600x1200', 1),
('1264x900', 1),
('1152x864', 1),
('1536x1152', 1),
('1200x750', 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `IdService` varchar(11) NOT NULL,
  `ServiceName` varchar(35) NOT NULL,
  `Available` varchar(1) NOT NULL,
  `AdminMustOk` varchar(1) NOT NULL,
  PRIMARY KEY (`IdService`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`IdService`, `ServiceName`, `Available`, `AdminMustOk`) VALUES
('20070000000', 'GeoIp', '1', '0'),
('20070000001', 'Weather', '1', '0'),
('20080000000', 'NewsService', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `ThemeName` varchar(100) NOT NULL COMMENT 'اسم مجلد الشكل',
  `Active` varchar(1) NOT NULL COMMENT '  او محذوف نشط او لا',
  `LastChekUpdate` datetime NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
  `UpdateAvailble` float NOT NULL COMMENT 'رقم الاصدار المتوفر',
  `License` text NOT NULL COMMENT 'رقم ترخيص الدعم الفني',
  `UpdateDesc` text NOT NULL COMMENT 'شرح التحديث الجديد',
  PRIMARY KEY (`ThemeName`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`ThemeName`, `Active`, `LastChekUpdate`, `UpdateAvailble`, `License`, `UpdateDesc`) VALUES
('Default', '1', '0000-00-00 00:00:00', 0, 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', ''),
('tech', '0', '0000-00-00 00:00:00', 0, 'a34AxMzoyNDoxMQ==694338bc8475ec94MjAxMy0wMy0wMSAxMzoyNDoxNA==MjAxNC0wMy0wNy3a0e4553a783180f94B61269C0D1FAA79C85D0977D7CF4A1YWxoYW5hbnByZXNzLmNvbXx8QU5Z', ''),
('Fomaco', '1', '0000-00-00 00:00:00', 0, '', ''),
('wasila', '1', '0000-00-00 00:00:00', 0, '', ''),
('phpTransformer', '1', '0000-00-00 00:00:00', 0, '', ''),
('inncare', '1', '0000-00-00 00:00:00', 0, '', ''),
('newcasa', '1', '0000-00-00 00:00:00', 0, '', ''),
('newmedia', '1', '0000-00-00 00:00:00', 0, '', ''),
('holiday', '1', '0000-00-00 00:00:00', 0, '', ''),
('bekaaouna', '1', '0000-00-00 00:00:00', 0, '', ''),
('MatarAuto', '1', '0000-00-00 00:00:00', 0, '', ''),
('shames', '1', '0000-00-00 00:00:00', 0, '', ''),
('Fomaco renamed', '1', '0000-00-00 00:00:00', 0, '', ''),
('nabisheeth', '1', '0000-00-00 00:00:00', 0, '', ''),
('SareinFawqa', '1', '0000-00-00 00:00:00', 0, '', ''),
('alhanan', '1', '0000-00-00 00:00:00', 0, '', ''),
('borji', '1', '0000-00-00 00:00:00', 0, '', ''),
('Gnome', '1', '0000-00-00 00:00:00', 0, '', ''),
('classic', '1', '0000-00-00 00:00:00', 0, '', ''),
('foma', '1', '0000-00-00 00:00:00', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `thm_default_caption`
--

CREATE TABLE IF NOT EXISTS `thm_default_caption` (
  `id` varchar(11) NOT NULL COMMENT 'رقم الصورة',
  `id_lang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `caption` text NOT NULL COMMENT 'النص الظاهر بهذه اللغة',
  PRIMARY KEY (`id`,`id_lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شرح صور السلايدر';

-- --------------------------------------------------------

--
-- Table structure for table `thm_default_slider`
--

CREATE TABLE IF NOT EXISTS `thm_default_slider` (
  `id` varchar(11) NOT NULL COMMENT 'رقم الصورة',
  `path` text NOT NULL COMMENT 'مسار الصورة',
  `href` text NOT NULL COMMENT 'الرابط',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='صور السلايدر';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` varchar(11) NOT NULL COMMENT 'رقم المستخدم',
  `GroupId` varchar(11) NOT NULL COMMENT 'رقم المجموعة التي ينتسب اليها',
  `TimeFormat` varchar(12) NOT NULL COMMENT 'رقم شكل اظهار الوقت',
  `UserName` varchar(20) NOT NULL COMMENT 'اسم المستخدم',
  `NickName` varchar(20) NOT NULL COMMENT 'الاسم المستعار',
  `ParentName` varchar(20) NOT NULL COMMENT 'اسم الوالد',
  `FamName` varchar(20) NOT NULL COMMENT 'اسم العائلة',
  `BirthDate` date NOT NULL COMMENT 'تاريخ الميلاد',
  `Sex` varchar(1) NOT NULL COMMENT 'الجنس',
  `Gmt` varchar(3) NOT NULL COMMENT 'وقته بالنسبة لغرينتش',
  `Contry` varchar(50) NOT NULL COMMENT 'البلد',
  `town` varchar(50) NOT NULL COMMENT 'البلدة او المدينة',
  `Rue` tinytext NOT NULL COMMENT 'الشارع',
  `AddDetails` text NOT NULL COMMENT 'العنوان مفصل',
  `CodePostal` varchar(4) NOT NULL COMMENT 'صندوق البريد',
  `ZipCode` varchar(4) NOT NULL COMMENT 'الرمز البريدي',
  `PhoneNbr` varchar(20) NOT NULL COMMENT 'رقم الهاتف',
  `CellNbr` varchar(20) NOT NULL COMMENT 'رقم الموبايل',
  `PassWord` varchar(35) NOT NULL COMMENT 'كلمة السر',
  `LastLogin` datetime NOT NULL COMMENT 'اخر دخول',
  `LastIP` varchar(15) NOT NULL COMMENT 'اخر رقم ايبي دخل منه',
  `Hobies` varchar(15) NOT NULL COMMENT 'الهوايات',
  `Job` varchar(15) NOT NULL COMMENT 'الوظيفة',
  `Education` varchar(15) NOT NULL COMMENT 'التعليم',
  `PrefLang` varchar(15) NOT NULL COMMENT 'اللغة المفضلة',
  `PrefTime` varchar(12) NOT NULL COMMENT 'الوقت المفضل للاتصال بالمستخدم بين كذا و كذا',
  `CookieLife` varchar(8) NOT NULL COMMENT 'عمر الكوكيز',
  `UserPic` text NOT NULL COMMENT 'اسم ملف صورة المستخدم',
  `user_video` text NOT NULL COMMENT 'فيديو تعريفي عن المستخدم',
  `UserMail` varchar(50) NOT NULL COMMENT 'بريد المستخدم',
  `UserSite` varchar(50) NOT NULL COMMENT 'موقع المستخدم',
  `Banned` varchar(1) NOT NULL COMMENT 'مطرود نعم او لا',
  `PrefThem` varchar(15) NOT NULL COMMENT 'الشكل المفضل',
  `UserSign` text NOT NULL COMMENT 'توقيعه',
  `Points` int(11) NOT NULL DEFAULT '0' COMMENT 'نقاطه',
  `Active` varchar(1) NOT NULL COMMENT 'نشط نعم اولا',
  `RegDate` datetime NOT NULL COMMENT 'تاريخ تسجيله',
  `allowHtml` varchar(1) NOT NULL COMMENT 'سماح بكود html',
  `allowBBcode` varchar(1) NOT NULL COMMENT 'سماح بكود bbcode',
  `allowSmiles` varchar(1) NOT NULL COMMENT 'السماح بتعابير',
  `allowAvatar` varchar(1) NOT NULL COMMENT 'السماح بصورة رمزية',
  `ConfirmCode` varchar(35) NOT NULL COMMENT 'كود تاكيد الاشتراك',
  `Mailed` varchar(2) NOT NULL COMMENT 'هل تم ارسال رسالة له اخر مرة؟',
  `Deleted` varchar(1) NOT NULL COMMENT 'هل هو محذوف؟',
  `LastSession` varchar(35) NOT NULL,
  `android_id` text NOT NULL,
  `apple_id` text NOT NULL,
  `uuid` text COMMENT 'device unique id',
  `app_token` text NOT NULL COMMENT 'session number for mobile app',
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `UserId` (`UserId`),
  UNIQUE KEY `NickName` (`NickName`),
  UNIQUE KEY `UserMail` (`UserMail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='اسماء المستخدمين للموقع';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `GroupId`, `TimeFormat`, `UserName`, `NickName`, `ParentName`, `FamName`, `BirthDate`, `Sex`, `Gmt`, `Contry`, `town`, `Rue`, `AddDetails`, `CodePostal`, `ZipCode`, `PhoneNbr`, `CellNbr`, `PassWord`, `LastLogin`, `LastIP`, `Hobies`, `Job`, `Education`, `PrefLang`, `PrefTime`, `CookieLife`, `UserPic`, `user_video`, `UserMail`, `UserSite`, `Banned`, `PrefThem`, `UserSign`, `Points`, `Active`, `RegDate`, `allowHtml`, `allowBBcode`, `allowSmiles`, `allowAvatar`, `ConfirmCode`, `Mailed`, `Deleted`, `LastSession`, `android_id`, `apple_id`, `uuid`, `app_token`) VALUES
('200700000-1', '200700000-1', 'Y-m-d H:i:s', 'مدير', 'admin', 'admin', 'الموقع', '1900-05-10', '1', '+2', 'LB', 'beiruth', '', '', '', '', '', '', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2014-05-24 13:19:04', 'fe80::a998:ae3:', 'Computer', 'Administrator', 'IT', 'Arabic', '12:00-16:00', '8640', 'uploads/users/admin/avatar_128.png', '', 'user@phptransformer.com', 'www.phptransformer.com', '0', 'Default', 'ADMINISTRATOR', 1, '1', '2007-05-10 13:48:47', '1', '1', '1', '1', '', '1', '0', 'fdnois799gnd8l3t3364go8985', 'a', '', NULL, ''),
('20070000000', '20070000000', 'Y-m-d H:i:s', 'member', 'Guest', ' ', 'not registered', '0000-00-00', '1', '+2', 'US', 'None', 'None', 'None', 'None', 'None', 'None', 'None', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2010-11-25 14:51:20', 'fe80::a998:ae3:', 'None', 'None', 'None', 'Arabic', '12:00-16:00', '8640', 'uploads/users/Guest/avatar_128.jpg', '', 'mhndm@hotmail.com', 'None', '0', 'Default', 'Guest', 1, '1', '0000-00-00 00:00:00', '0', '0', '0', '0', '', '0', '0', '96jlqqiqds24us569dkodr9hu0', 'c', '', NULL, ''),
('20140000000', '20070000001', 'Y-m-d H:i:s', 'almayadeen', 'almayadeen', '', 'chanel', '0000-00-00', '', '', '', '', '', '', '', '', '', '', 'd78b6f30225cdc811adfe8d4e7c9fd34', '2014-04-28 07:52:11', '127.0.0.1', '', '', '', 'Arabic', '', '86400', 'uploads/users/almayadeen/avatar_128.jpg', '', 'info@almayadeen.net', '', '0', 'Default', '', 0, '1', '2014-04-24 11:42:36', '0', '0', '0', '1', 'ab6fd0cbb1840d5885dc69ede5394d38', '', '', 'eodth3dkhmgtct0p39i6e03kp2', 'd', '', NULL, ''),
('20140000001', '20070000001', 'Y-m-d H:i:s', 'SASADASD', 'asasaS', '', 'SAASDASD', '0000-00-00', '', '', 'xx', '', '', '', '', '', '', '', 'aa38ad19b222c32fc0745d075d7cb447', '2014-05-09 08:13:26', '127.0.0.1', '', '', '', 'Arabic', '', '86400', '', '', 'ASSAD@SSAD.COM', '', '0', 'Default', '', 0, '1', '2014-05-09 08:13:26', '0', '0', '0', '1', 'ef501b2fa044c3839d8f575f0a787a11', '', '', '', 'e', '', NULL, ''),
('20140000002', '20070000001', 'Y-m-d H:i:s', 'asfasd', 'sadsad', ' ', 'sadsa', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', 'adsad@asdsad.com', ' ', '0', 'Default', ' ', 0, '1', '2014-05-09 10:12:39', '0', '0', '1', '1', '1', '', '', '', 'f', '', NULL, ''),
('20140000005', '20070000001', 'Y-m-d H:i:s', 'uiytui', 'ryrty', ' ', 'tyuyt', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', 'ytr@utryt.co', ' ', '0', 'Default', ' ', 0, '1', '2014-05-09 10:15:00', '0', '0', '1', '1', '1', '', '', '', 'i', '', NULL, ''),
('20140000006', '20070000001', 'Y-m-d H:i:s', 'dcdcsad', 'dasdasd', ' ', 'sadsad', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', 'asdsad@ddcv.ocm', ' ', '0', 'Default', ' ', 0, '1', '2014-05-09 10:15:35', '0', '0', '1', '1', '1', '', '', '', 'j', '', NULL, ''),
('20140000007', '200700000-1', 'Y-m-d H:i:s', 'vcxv', 'xcvcxv', ' ', 'xcxcv', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', 'xcvxvc@cxvcxv.com', ' ', '0', 'Default', ' ', 0, '1', '2014-05-09 10:16:36', '0', '0', '1', '1', '1', '', '', '', 'b', '', NULL, ''),
('20140000008', '20070000001', 'Y-m-d H:i:s', 'uimn', 'bnmnbm', ' ', 'bnmnbm', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', 'bnmbnm@xcvxzc.com', ' ', '0', 'Default', ' ', 0, '1', '2014-05-09 10:16:50', '0', '0', '1', '1', '1', '', '', '', 'k', '', NULL, ''),
('20140000009', '20070000001', 'Y-m-d H:i:s', 'xzcwew', 'fcger4ter', ' ', 'vcbdy5r', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', 'c4ca4238a0b923820dcc509a6f75849b', '0000-00-00 00:00:00', '127.0.0.1', ' ', ' ', ' ', 'Arabic', '0:00-0:00', '8640', '', '', 'zcsawqede@scasdsad.c0m', ' ', '0', 'Default', ' ', 0, '1', '2014-05-09 10:17:33', '0', '0', '1', '1', '1', '', '', '', 'l', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `userslog`
--

CREATE TABLE IF NOT EXISTS `userslog` (
  `NickName` varchar(15) NOT NULL COMMENT 'اسم المستخدم',
  `Gmt` datetime NOT NULL COMMENT 'الوقت حسب غرينتش',
  `IpNbr` varchar(15) NOT NULL COMMENT 'رقم الايبي',
  `SessionId` varchar(35) DEFAULT NULL,
  `FromPage` varchar(256) NOT NULL COMMENT 'الصفحة التي اتى منها',
  `CurrentPage` varchar(256) NOT NULL COMMENT 'الصفحة الحالية'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='لوغ  دخول المستخدمين';

--
-- Dumping data for table `userslog`
--

INSERT INTO `userslog` (`NickName`, `Gmt`, `IpNbr`, `SessionId`, `FromPage`, `CurrentPage`) VALUES
('Guest', '2014-07-03 11:57:53', '127.0.0.1', '63e7q0n94p28vtgsr0tt8366g6', 'http://localhost/phptransformer/Prog-home_Lang-Arabic_nl-1.pt', ''),
('Guest', '2014-07-03 11:57:53', '127.0.0.1', '63e7q0n94p28vtgsr0tt8366g6', 'http://localhost/phptransformer/Prog-home_Lang-Arabic_nl-1.pt', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
