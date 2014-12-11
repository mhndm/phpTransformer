<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php if (!isset($project)){header("location: ");} ?>
<?php
$FootTheme	= get_include_contents("Themes/$ThemeName/FootContainer.php");
$FootTheme	= VarTheme("{ThemeName}",$ThemeName,$FootTheme);
$FootTheme	= VarTheme("{SpecialText}", SpecialText,$FootTheme);
$FootTheme	= VarTheme("{AllRightReserved}", AllRightReserved,$FootTheme);
$FootTheme	= VarTheme("{DevelopedAndDesignedby}", DevelopedAndDesignedby,$FootTheme);
$FootTheme	= VarTheme("{FooterContent}", FooterContent,$FootTheme);
$FootTheme	= VarTheme("{Developed}", Developed,$FootTheme);
$FootTheme	= VarTheme("{Designedby}", Designedby,$FootTheme);
$FootCont	= $FootTheme;
?>