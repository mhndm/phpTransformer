
--
-- Table structure for table `news_rating`
--

CREATE TABLE IF NOT EXISTS `news_rating` (
`rating_id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL COMMENT 'رقم المصوت',
  `member_id` varchar(11) NOT NULL COMMENT 'رقم المصوت له',
  `news_id` varchar(11) NOT NULL COMMENT 'الخبر',
  `rate_value` int(11) NOT NULL DEFAULT '0' COMMENT 'قيمة التصويت',
  `rate_date` datetime NOT NULL COMMENT 'تاريخ التصويت'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1223 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_rating`
--
ALTER TABLE `news_rating`
 ADD PRIMARY KEY (`rating_id`), ADD KEY `user_id` (`user_id`), ADD KEY `member_id` (`member_id`), ADD KEY `news_id` (`news_id`), ADD KEY `rate_date` (`rate_date`);

ALTER TABLE `news` ADD `news_points` INT NULL DEFAULT '1' AFTER `NewsPic` ;
CREATE TABLE `news_rating` ( `rating_id` int(11) NOT NULL AUTO_INCREMENT, `user_id` varchar(11) NOT NULL COMMENT 'رقم المصوت', `member_id` varchar(11) NOT NULL COMMENT 'رقم المصوت له', `news_id` varchar(11) NOT NULL COMMENT 'الخبر', `rate_value` int(11) NOT NULL DEFAULT '0' COMMENT 'قيمة التصويت', `rate_date` datetime NOT NULL COMMENT 'تاريخ التصويت', PRIMARY KEY (`rating_id`) ) ENGINE=InnoDB AUTO_INCREMENT=259 DEFAULT CHARSET=utf8 ;

ALTER TABLE `news` ADD `uuid` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `news` ADD `location` TEXT NOT NULL COMMENT 'geo location x,y' ; 
ALTER TABLE `news` ADD INDEX ( `Deleted` ) ;
ALTER TABLE `newslang` ADD INDEX ( `Tilte` );
ALTER TABLE `users` ADD INDEX ( `NickName` ) ;
ALTER TABLE `news` CHANGE `NewsPic` `NewsPic` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'صورة للخبر'; 
ALTER TABLE `params` ADD `youtube_api_key` VARCHAR(100) NOT NULL , ADD `youtube_username` VARCHAR(100) NOT NULL , ADD `youtube_password` VARCHAR(100) NOT NULL ; 
ALTER TABLE `params` ADD `awsAccessKey` VARCHAR(50) NOT NULL COMMENT 'Amazon cloud access key' , ADD `awsSecretKey` VARCHAR(100) NOT NULL COMMENT 'amazon cloud secret key' ; 

ALTER TABLE `users` CHANGE `Points` `Points` INT NOT NULL DEFAULT '0' COMMENT 'نقاطه' ;

UPDATE `gallery` SET `visible`=1 WHERE 1;

CREATE TABLE IF NOT EXISTS `news_subscription` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) NOT NULL,
  `cat_id` varchar(11) NOT NULL COMMENT 'المجموعة الاخبارية',
  `only_urgent` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='الاخبار التي ستظهر للمستخدم على تطبيق الهاتف' AUTO_INCREMENT=1 ;

ALTER TABLE `users` ADD `app_token` TEXT NOT NULL COMMENT 'session number for mobile app' ; 

ALTER TABLE `news` CHANGE `Hits` `Hits` BIGINT NOT NULL COMMENT 'زيارة'; 

ALTER TABLE `marques` ADD `IdNews` VARCHAR(11) NOT NULL ; 

ALTER TABLE `users` ADD `uuid` TEXT NULL COMMENT 'device unique id' ; 

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

ALTER TABLE `params` ADD `android_key` TEXT NOT NULL , ADD `apple_key` TEXT NOT NULL ; 
ALTER TABLE `users` ADD `android_id` TEXT NOT NULL , ADD `apple_id` TEXT NOT NULL ; 
ALTER TABLE `cclang` ADD `ccode` INT(5) NOT NULL ; 
ALTER TABLE `news` ADD `active_by` VARCHAR(11) NOT NULL , ADD `del_by` VARCHAR(11) NOT NULL ; 

ALTER TABLE `marqlang` CHANGE `Message` `Message` VARCHAR( 150 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'الرسالة';
ALTER TABLE `gallerylang` CHANGE `Caption` `Caption` VARCHAR( 256 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

ALTER TABLE `catlang` CHANGE `CatName` `CatName` VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'اسم المجموعة';

ALTER TABLE `newslang` CHANGE `Tilte` `Tilte` VARCHAR(256) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL; 


--- slider --
ALTER TABLE `thm_default_caption` ADD PRIMARY KEY( `id`, `id_lang`); 

-- gallery --
ALTER TABLE `gallery` ADD `visible` INT( 1 ) NOT NULL COMMENT 'هل يستطيع مشاهدته الزوار' ;


--- news ---
ALTER TABLE `news` DROP PRIMARY KEY , ADD PRIMARY KEY ( `IdNews` ) ;
ALTER TABLE `news` ADD `urgent` INT( 1 ) NOT NULL DEFAULT '0' COMMENT 'خبر عاجل' ;
ALTER TABLE `news` ADD `agency` VARCHAR( 20 ) NOT NULL COMMENT 'رقم المستخدم كمصدر ' ;


-- Primary key slider ---
ALTER TABLE `thm_default_slider` ADD PRIMARY KEY(`id`);
ALTER TABLE `thm_default_caption` ADD PRIMARY KEY(`id`);

-- Menu 
CREATE TABLE IF NOT EXISTS `pt_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '1',
  `href` text CHARACTER SET utf8,
  `icon` text CHARACTER SET utf8,
  `target` text CHARACTER SET utf8,
  `orderfield` int(11) DEFAULT '0',
  `expanded` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
)   ;



CREATE TABLE IF NOT EXISTS `pt_menu_lang` (
`IdLang` varchar( 11 ) CHARACTER SET utf8 NOT NULL ,
`id` int( 11 ) NOT NULL ,
`text` text CHARACTER SET utf8,
`title` text CHARACTER SET utf8,
PRIMARY KEY ( `IdLang` , `id` )
) ;
--
-- Table structure for table `thm_default_slider`
--

CREATE TABLE IF NOT EXISTS `thm_default_slider` (
  `id` int(11) NOT NULL COMMENT 'رقم الصورة',
  `path` text NOT NULL COMMENT 'مسار الصورة',
  `href` text NOT NULL COMMENT 'الرابط'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='صور السلايدر';

--
-- Dumping data for table `thm_default_slider`
--

INSERT INTO `thm_default_slider` (`id`, `path`, `href`) VALUES
(1, 'Themes/Default/slider/img/toystory.jpg', ''),
(2, 'Themes/Default/slider/img/walle.jpg', ''),
(3, 'Themes/Default/slider/img/nemo.jpg', '');



--
-- Table structure for table `thm_default_caption`
--

CREATE TABLE IF NOT EXISTS `thm_default_caption` (
  `id` int(11) NOT NULL COMMENT 'رقم الصورة',
  `id_lang` varchar(11) NOT NULL COMMENT 'رقم اللغة',
  `caption` text NOT NULL COMMENT 'النص الظاهر بهذه اللغة'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='شرح صور السلايدر';


----------------------
--- version 2013.x ---
----------------------

ALTER TABLE `catlang` ADD `sort` TINYINT( 1 ) NOT NULL COMMENT 'ترتيب المجموعة من فوق لتحت' ;

ALTER TABLE `banner` DROP INDEX `BanName` ;

ALTER TABLE `banner` ADD FULLTEXT (`BanName`);

ALTER TABLE `galleryparams` ADD `ShowSlider` INT( 1 ) NOT NULL COMMENT 'عرض الصور كشرائح';
UPDATE `galleryparams` SET `ShowSlider` = '1' ;

ALTER TABLE `users` ADD `user_video` TEXT NOT NULL COMMENT 'فيديو تعريفي عن المستخدم' AFTER `UserPic` ;

ALTER TABLE `users` ENGINE = InnoDB;

ALTER TABLE `banner` DROP INDEX `BanName` , ADD FULLTEXT `BanName` (`BanName`);

ALTER TABLE `banner` CHANGE `Position` `Position` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'مكان الاعلان'; 

ALTER TABLE `users` CHANGE `Contry` `Contry` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'البلد';

ALTER TABLE `users` CHANGE `town` `town` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'البلدة او المدينة';

ALTER TABLE `users` CHANGE `Rue` `Rue` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'الشارع';

ALTER TABLE `users` CHANGE `AddDetails` `AddDetails` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'العنوان مفصل';

----------------------
--- version 2.1 ------
----------------------
ALTER TABLE `mainmenu` ADD `IdPage` VARCHAR( 11 ) NOT NULL COMMENT 'رقم الصفحة المرتبطة بها ';
UPDATE `blocks` SET `BlockName` = 'AccountBlock' WHERE `BlockName` = 'Account';


----------------------
--- version 2.0 ------
----------------------

ALTER TABLE   `admins` ADD `Stopped` DATETIME NOT NULL COMMENT 'تاريخ ايقافه',
ADD `IsAdam` INT( 1 ) NOT NULL COMMENT 'هل هو المدير العام';

CREATE TABLE `adminperm` (
`AdminID` VARCHAR( 11 ) NOT NULL COMMENT 'رقم المدير',
`constName` VARCHAR( 100 ) NOT NULL COMMENT 'النوع قلب البرنامج او برنامج او بلوك',
`varName` VARCHAR( 100 ) NOT NULL COMMENT 'اسم المتغير',
`varValue` VARCHAR( 100 ) NOT NULL COMMENT 'قيمة المتغير',
`perm` INT( 1 ) NOT NULL COMMENT 'له صلاحية'
) ENGINE = MYISAM COMMENT = 'جدول صلاحيات المدراء';

ALTER TABLE `users` CHANGE `UserName` `UserName` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'اسم المستخدم',
CHANGE `NickName` `NickName` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'الاسم المستعار',
CHANGE `ParentName` `ParentName` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'اسم الوالد',
CHANGE `FamName` `FamName` VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'اسم العائلة';

ALTER TABLE `users` CHANGE `CookieLife` `CookieLife` VARCHAR( 8 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'عمر الكوكيز';

ALTER TABLE `params` ADD `GoogleCode` VARCHAR( 26 ) NOT NULL COMMENT 'Google analytics pageTracker ',
ADD `EnableStatistics` TINYINT( 1 ) NOT NULL COMMENT 'هل نظام الاحصائيات مفعل' ;

ALTER TABLE `programs` ADD UNIQUE (`ProgramName`);

ALTER TABLE `errlog` ADD `DateErr` DATETIME NOT NULL COMMENT 'تاريخ الخطأ';

ALTER TABLE `params` ADD `LastChekUpdate` DATETIME NOT NULL COMMENT 'آخر مرة تم فيها التحديث';


ALTER TABLE `params` ADD `UpdateAvailble` FLOAT NOT NULL COMMENT 'رقم الاصدار المتوفر' ;

ALTER TABLE `programs` ADD `LastChekUpdate` DATETIME NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
ADD `UpdateAvailble` FLOAT NOT NULL COMMENT 'رقم الاصدار المتوفر' ;

ALTER TABLE `programs` ADD `UpdateAvailble` FLOAT NOT NULL COMMENT 'رقم الاصدار المتوفر';

ALTER TABLE `blocks` ADD `LastChekUpdate` DATETIME NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
ADD  `UpdateAvailble` FLOAT NOT NULL COMMENT 'رقم الاصدار المتوفر' ;

ALTER TABLE `blocks` ADD `UpdateAvailble` FLOAT NOT NULL COMMENT 'رقم الاصدار المتوفر';

ALTER TABLE `themes` ADD `LastChekUpdate` DATETIME NOT NULL COMMENT 'آخر مرة تم فيها التحديث',
ADD  `UpdateAvailble` FLOAT NOT NULL COMMENT 'رقم الاصدار المتوفر' ;

ALTER TABLE `themes` ADD `License` TEXT NOT NULL COMMENT 'رقم ترخيص الدعم الفني';

ALTER TABLE `params` ADD `UpdateDesc` TEXT NOT NULL COMMENT 'شرح التحديث الجديد';

ALTER TABLE `programs` ADD `UpdateDesc` TEXT NOT NULL COMMENT 'شرح التحديث الجديد';

ALTER TABLE `blocks` ADD `UpdateDesc` TEXT NOT NULL COMMENT 'شرح التحديث الجديد';

ALTER TABLE `themes` ADD `UpdateDesc` TEXT NOT NULL COMMENT 'شرح التحديث الجديد';

ALTER TABLE `params` ADD `UpdateName` TEXT NOT NULL COMMENT 'اسم الاصدارة الجديدة';


CREATE TABLE `plugins` (
`id` VARCHAR( 11 ) NOT NULL COMMENT 'رقم الاضافة',
`name` VARCHAR( 1024 ) NOT NULL COMMENT 'اسم الاضافة'
) ENGINE = MYISAM COMMENT = 'جدول الاضافات المفعلة';

ALTER TABLE `users` CHANGE `UserPic` `UserPic` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'اسم ملف صورة المستخدم';
