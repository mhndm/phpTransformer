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
