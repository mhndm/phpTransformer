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
global $WebSiteFullName;
$filename="Themes/$ThemeName/TopContainer.php";
if (file_exists($filename)){
	//get html file
	$TopCont=get_include_contents("$filename");
	//replace ThemeName {Library}  {Galery}  {Forum}   {HomePage}  {Logo}
	$TopCont= VarTheme("{ThemeName}",$ThemeName,$TopCont);
	$TopCont= VarTheme("{Library}", Library,$TopCont);
	$TopCont= VarTheme("{Galery}", Gallery,$TopCont);
	$TopCont= VarTheme("{Forum}", Forum,$TopCont);
	$TopCont= VarTheme("{HomePage}", HomePage,$TopCont);
        $TopCont= VarTheme("{tellfriend}", tellfriend,$TopCont);
	$TopCont= VarTheme("{contactus}", contactus,$TopCont);
        if (file_exists("Themes/$ThemeName/logo.php")){
          $Logo = get_include_contents("Themes/$ThemeName/logo.php");
          $Logo = VarTheme("{WebSiteFullName}", $WebSiteFullName,$Logo);
        }
        else{
           $Logo ='' ;
        }
	$TopCont= VarTheme("{Logo}",$Logo,$TopCont);
	
	// 
	
}
else{
	$TopCont="&nbsp;";
}
//$TopCont="the top";


?>