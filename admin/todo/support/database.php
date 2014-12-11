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
<?php  if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php
global $AdminId,$dbHostName, $dbUserName, $dbPass,$LOG,$dbBaseName,$BackupFolder,$Rows;
global $dbHostName, $dbUserName, $dbPass,$restore ,$dbBaseName,$backup,$BackupFolder,$LOG ;
$theList = SubIconLink("database","backup"). "<br/>"
        .SubIconLink("database","restore"). "<br/>"
        .SubIconLink("database","optimize"). "<br/>";

if(isset($_GET['subdo'])) {
    switch($_GET['subdo']) {
        case "backup":
            include_once "admin/todo/support/backup.php";
            $theContent =  $backup;
            $TheNavBar[] = array(Backup,adminCreateLink("",array("todo","subdo"),array("backup","backup")));
            break;
        case "restore":
            include_once "admin/todo/support/restore.php";
            $theContent = $restore;
            $TheNavBar[] = array( Restore,adminCreateLink("",array("todo","subdo"),array("backup","restore")));
            break;
        case "optimize":
            include_once "admin/todo/support/optimize.php";
            $theContent =  $optimize;
            $TheNavBar[] = array( Optimize,adminCreateLink("",array("todo","subdo"),array("backup","optimize")));
            break;
        default :
            include_once "admin/todo/support/backup.php";
            $theContent =   $backup;
            $TheNavBar[] = array(Backup,adminCreateLink("",array("todo","subdo"),array("backup","backup")));
            break;
    }//end switch
}
else {
    include_once "admin/todo/support/backup.php";
    $theContent =   $backup;
    $TheNavBar[] = array(Backup,adminCreateLink("",array("todo","subdo"),array("backup","backup")));

}
$DataBase = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$DataBase = VarTheme("{todoImg}", "backup.png",$DataBase );
$DataBase = VarTheme("{ThemeName}", $ThemeName,$DataBase );
$DataBase = VarTheme("{List}", $theList,$DataBase );
$DataBase = VarTheme("{Content}", $theContent,$DataBase );
return $DataBase;
?>