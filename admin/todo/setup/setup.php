<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php

$Setup = get_include_contents("admin/todo/setup/icons.php");
$Setup = VarTheme("{Theme}", $ThemeName,$Setup );
$Setup = VarTheme("{Setup}", Setup,$Setup );

$Vars = array("todo");
$Vals = array("newprograms");
$NewPrograms = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" title="'. NewPrograms.'">'. NewPrograms.'</a>';
$Setup = VarTheme("{NewPrograms}", $NewPrograms,$Setup );
$Setup = VarTheme("{NewProgramsPiclink}", AdminCreateLink("",$Vars,$Vals),$Setup );

$Vars = array("todo");
$Vals = array("newblock");
$NewBlock = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" title="'. NewBlock.'">'. NewBlock.'</a>';
$Setup = VarTheme("{NewBlock}", $NewBlock,$Setup );
$Setup = VarTheme("{NewBlockPiclink}", AdminCreateLink("",$Vars,$Vals),$Setup );

$Vars = array("todo","subdo");
$Vals = array("themes","NewTheme");
$Themes = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" title="'. (Themes).'">'. (Themes).'</a>';
$Setup = VarTheme("{Themes}", $Themes,$Setup );
$Setup = VarTheme("{ThemesPiclink}", AdminCreateLink("",$Vars,$Vals),$Setup );

$Vars = array("todo","subdo");
$Vals = array("languages","NewLang");
$Languages = '<a href="'.AdminCreateLink("",$Vars,$Vals).'" title="'. Languages.'">'. Languages.'</a>';
$Setup = VarTheme("{Languages}", $Languages,$Setup );
$Setup = VarTheme("{LanguagesPiclink}", AdminCreateLink("",$Vars,$Vals),$Setup );
$Setup = '<br/>'.SetupComment.'<br/><br/>'.$Setup .'<br/>';

?>
