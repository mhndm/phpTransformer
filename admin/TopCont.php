<?php
/***********************************************

Project: phpTransformer.com .
File Location :  .
File Name:  .
Date Created: 00-00-2007.
Last Modified: 00-00-2007.
Descriptions:.
Changes:.
TODO: .
Author: Mohsen Mousawi mhndm@phptransformer.com .

***********************************************/
?>
<?php  if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php
global $WebsiteUrl,$WebSiteFullName,$HelpLink;
include_once('FastMenu.php');

$TopCont = get_include_contents("admin/Themes/".$ThemeName."/TopCont.php");
$TopCont = VarTheme("{LangCode}", $LangCode,$TopCont);
$Vars = array("logout") ;
$Vals = array("1") ;
$TopCont = VarTheme("{LogoutHref}", AdminCreateLink("",$Vars,$Vals),$TopCont);
$path= explode("/",$_SERVER['PHP_SELF']);
$Vars = array("home") ;
$Vals = array("1") ;
$TopCont = VarTheme("{HomeHref}", AdminCreateLink("",$Vars,$Vals),$TopCont);
$TopCont = VarTheme("{Logout}",  (logout),$TopCont);
$TopCont = VarTheme("{Home}",  Home,$TopCont);

$TopCont = VarTheme("{WebFolder}",  $WebSiteFullName,$TopCont);
$TopCont = VarTheme("{Lang}", $Lang,$TopCont);

//Help section
if(isset($_GET['subdo'])) {
    $HelpSubItem = InputFilter(($_GET['subdo']));
}
else {
    $HelpSubItem = '';
}

$HelpVar = '';
$HelpItem = '';

if(isset($_GET['todo'])) {
    $HelpVar  = 'todo';
    $HelpItem  = InputFilter(($_GET['todo']));
}
if(isset($_GET['prog'])) {
    $HelpVar = 'prog';
     $HelpItem = InputFilter(($_GET['prog']));
     $user_interface_link = CreateLink("", array("Prog"), array($HelpItem)) ;
}
else{
    $user_interface_link = $WebsiteUrl ;
}

$TopCont = VarTheme("{WebFolderHref}", $user_interface_link,$TopCont);

if(isset($_GET['block'])) {
    $HelpVar = 'block';
    $HelpItem = InputFilter(($_GET['block']));
}

//build the help link
$HelpLink = AdminCreateLink('', array('help','item','subitem'), array($HelpVar,$HelpItem,$HelpSubItem));


$TopCont = VarTheme("{Help}", Help,$TopCont);
$TopCont = VarTheme("{HelpHref}", $HelpLink,$TopCont);

if(MustChekForUpdate()) {
    $TopCont .= ChekForUpdate();
}

$UpdateAvailbe = IfUpdateAvailbe();
if(isset($AdminId)){
    if($UpdateAvailbe['Number']) {
        //get number of updates for core, programs, blocks and themes
        $UpdateAvailbe = IfUpdateAvailbe();
        $UpdateAlert ='<a href="'.AdminCreateLink('', array("todo"), array("Update")).'" title="'.$UpdateAvailbe['Number'].' '.NumberOfUpdateAvialble.'" >'.
                ' <img src="admin/Themes/'.$ThemeName.'/images/updatechek.png" title="'.$UpdateAvailbe['Number'].' '.NumberOfUpdateAvialble.'"
                            border="0" width="46" height="46" alt=" Update availble now !" />&nbsp; '.
                '</a>';
    }
    else {
        $UpdateAlert =' ';
    }
}
    else {
        $UpdateAlert =' ';
    }
    
$TopCont = VarTheme("{UpdateAlert}", $UpdateAlert,$TopCont);
//$TopCont = VarTheme("{LisencenNumber}", (ExipryDate).' : '.$Sitekey ,$TopCont);
if(isset($_SESSION['Login'.$WebsiteUrl])) {
    if($_SESSION['Login'.$WebsiteUrl]== true) {
        $TopCont = VarTheme("{FastMenu}", $FastMenu,$TopCont);
    }
    else {
        $TopCont = VarTheme("{FastMenu}", "",$TopCont);
    }
}
else {
    $TopCont = VarTheme("{FastMenu}", "",$TopCont);
}//end if

?>