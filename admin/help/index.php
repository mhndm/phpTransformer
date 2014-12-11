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
<?php
//include_once("config.php");
// include_once("includes/session.php");
global $WebsiteUrl, $Lang,$WebsiteUrl,$TheNavBar;

$Helpitem = '';
$Navsubitem = '';
$Help = '';

if(isset($_GET['help'])) {
    $Help = InputFilter(($_GET['help']));
    if($Help == '') {
        $HelpFile = 'admin/help/'.$Lang.'/index.php';
    }else {
        if(isset($_GET['item'])) {
            $Helpitem = InputFilter(($_GET['item']));
        }
        else {
            $Helpitem = '';
        }
        if(isset($_GET['subitem'])) {
            $Navsubitem = InputFilter(($_GET['subitem']));
            if($Navsubitem!='') {
                $Helpsubitem = $Navsubitem;
                $Helpsubitem = $Helpsubitem.'/';
            }else {
                $Helpsubitem = '';
            }
        }
        else {
            $Helpsubitem = '';
        }

        if($Help == 'todo') {

            $HelpFile  = 'admin/help/'.$Lang.'/'.$Helpitem.'/'.$Helpsubitem.'index.php';

        }elseif($Help == 'prog') {

             $HelpFile = 'Programs/'.$Helpitem.'/admin/help/'.$Lang.'/'.'/'.$Helpsubitem.'index.php';

            }elseif($Help == 'block') {

            $HelpFile = 'Blocks/'.$Helpitem.'/admin/help/'.$Lang.'/'.'/'.$Helpsubitem.'index.php';
        }
        else {
            $HelpFile = 'admin/help/'.$Lang.'/index.php';
        }
    }
}else {
    //Main page
    $HelpFile = 'admin/help/'.$Lang.'/index.php';
}

$HelpNavLink = AdminCreateLink('', array('help','item','subitem'), array($Help,"",""));
$TheNavBar[] = array(Help,$HelpNavLink);
//echo $HelpFile;
if(is_file($HelpFile)) {
    include_once $HelpFile;
}
else {
    echo TheHelpForThisFileNotFound;
}

?>
