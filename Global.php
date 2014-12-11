<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 00-00-2007.
 * 	Last Modified: 00-00-2007.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php
$upload_allowed_ext = array("gif", "jpg", "jpeg", "png", "webm", "3gpp", "mpegps", "mpeg4", "mov", "wmv", "flv", "swf", "rm", "avi", "mp4", "mpeg", "mpg", "youtube", "mp3", "wma", "ra", "pdf", "ppt", "pptx", "tiff", "doc", "docx", "xls", "xlsx", "rtf", "txt", "ods", "odt", "odp", "odg");
$upload_images = array("gif", "jpg", "jpeg", "png");
$upload_videos = array("webm", "3gpp", "mpegps", "mpeg4", "mov", "wmv", "flv", "swf", "rm", "avi", "mp4", "mpeg", "mpg", "youtube", "wma");
$upload_files = array("pdf", "ppt", "pptx", "tiff", "doc", "docx", "xls", "xlsx", "rtf", "txt", "ods", "odt", "odp", "odg");

date_default_timezone_set('Europe/London'); // GMT default time zone
//get the adam admin signature
$query = " select `AdminSign` from `admins` where `IsAdam`='1' ; ";
$dbAdamSign = new db();
$AdamSign = $dbAdamSign->get_row($query);
if (!$AdamSign) {
    $AdamSign = ' ';
} else {
    $AdamSign = $AdamSign->AdminSign;
}

$dbGlobal = new db();
$Params = $dbGlobal->get_row("SELECT * FROM `params`;");

if ($Params) {
    $IgnoreList = $Params->IgnoreList;
    $TimeCache = $Params->TimeCache;
    $CacheEnabled = $Params->CacheEnabled;
    $MainPrograms = $Params->MainPrograms;
    $GeoIpService = $Params->GeoIpService;
    $ThemeName = $Params->DefaultThem;
    $DefaultLang = $Params->DefaultLang;
    $ConvertAt = $Params->ConvertAt;
    $ExternalLinks = $Params->ExternalLinks;
    $UseRew = $Params->UseRew;
    $IsOpen = $Params->IsOpen;
    $DateGmt = $Params->DateGmt;
    $ViewTopCont = $Params->ViewTopCont;
    $ViewMarqueeCont = $Params->ViewMarqueeCont;
    $ViewMenuCont = $Params->ViewMenuCont;
    $ViewMainCont = $Params->ViewMainCont;
    $ViewSecCont = $Params->ViewSecCont;
    $ViewFootCont = $Params->ViewFootCont;
    $ViewProgCont = $Params->ViewProgCont;
    $OpenRegister = $Params->OpenRegister;
    $AdminRegOk = $Params->AdminRegOk;
    $MaxNbrPost = $Params->MaxNbrPost;
    $DefaulPageNbr = $Params->DefaulPageNbr;
    $NewsMaxNbr = $Params->NewsMaxNbr;
    $FloodSec = $Params->FloodSec;
    $GuestCanWrite = $Params->GuestCanWrite;
    $RobotAdmin = $Params->RobotAdmin;
    $AutoLang = $Params->AutoLang;
    $License = $Params->License;
    $EmailMethode = $Params->EmailMethode;
    $WebSiteFullName = $Params->WebSiteFullName;
    $GoogleCode = $Params->GoogleCode;
    $EnableStatistics = $Params->EnableStatistics;
    $android_key = $Params->android_key;
    $apple_key = $Params->apple_key;

    $uploader_code_included = 0;

    $awsAccessKey = $Params->awsAccessKey;
    $awsSecretKey = $Params->awsSecretKey;
    
    $youtube_api_key = $Params->youtube_api_key;
    $youtube_username = $Params->youtube_username;
    $youtube_password = $Params->youtube_password;

    /* /////////////////////////////////////// */
    if (isset($_SERVER['SERVER_NAME'])) {
        $ObjectName = parse_url($_SERVER['SERVER_NAME']);
        if (isset($ObjectName['host'])) {
            $ObjectName = strtolower($ObjectName['host']);
        } else {
            $ObjectName = strtolower($ObjectName['path']);
        }
    }else{
        $ObjectName ='';
    }
    //echo $ObjectName ;
    /*
      if (!ValidLicense($License,$ObjectName) and !isset($IsAdmin)){
      die("Epiry date");
      }//en dif
     */
    /* ////////////////////////////////////// */

    // try to get user and pass from get or post or cookie
    if (isset($_GET['nk'])) {
        $InputNickName = InputFilter($_GET['nk']);
    } elseif (isset($_POST['InputNickName'])) {
        $InputNickName = PostFilter($_POST['InputNickName']);
    } else {
        if (isset($_COOKIE['InputNickName'])) {
            $InputNickName = InputFilter($_COOKIE['InputNickName']);
        }
    } //end if

    if (isset($_GET['Lang'])) {
        $TheLang = InputFilter($_GET['Lang']);
        $dbLang = new db();
        $TheLang = $dbLang->get_var("SELECT `LangName` FROM `languages` WHERE `LangName`='" . $TheLang . "';");
        //ExcuteQuery("SELECT `LangName` FROM `languages` WHERE `LangName`='".$TheLang."';");
        if (!$TheLang) { // IF NOT USE USED LANG
            $TheLang = $DefaultLang;
        } //end if
    } elseif (isset($_SESSION['Lang'])) {
        $TheLang = $_SESSION['Lang'];
    } else {
        if (isset($InputNickName)) {
            $InputNickName;
            if ($InputNickName == 'Guest' and $AutoLang) {
                // get cc from  GEOIP SERVICE SITE تسبب البطء في الشبكات الداخلية
                $cc = strtolower(GetPageContent($GeoIpService . "?" . $_SERVER['REMOTE_ADDR']));
                //SELECT LANG WHERE CC

                if ($cc) { // cc service is running
                    /*
                      SqlConnect();
                      ExcuteQuery("SELECT `Langcc` FROM `cclang` WHERE `cc`='".$cc."' ;");

                      if ($TotalRecords>0){
                     */
                    $Langc = "";
                    $Langdb = new db();
                    $Langc = $Langdb->get_var("SELECT `Langcc` FROM `cclang` WHERE `cc`='" . $cc . "' ;");
                    //var_dump($Langc);
                    if ($Langc != null) {
                        $LangX = $Langc->Langcc;
                        //cheking for existence for this lang in our db
                        //ExcuteQuery("SELECT `LangName` FROM `languages` WHERE `LangName`='".$Langcc."';");
                        $Langcc = $Langdb->get_var("SELECT `LangName` FROM `languages` WHERE `LangName`='" . $LangX . "';");

                        if (!$Langcc) { // IF NOT USE USED LANG
                            $Langcc = $DefaultLang;
                        } //end if
                    } else { //language not found
                        $Langcc = $DefaultLang;
                    } //end if
                } else { // cc service not running
                    //get lang fro guest users
                    /*
                      ExcuteQuery("SELECT `PrefLang` FROM `users` WHERE `NickName`='Guest';");
                     */
                    $prefLangdb = new db();
                    $Langvar = $prefLangdb->get_var("SELECT `PrefLang` FROM `users` WHERE `NickName`='Guest';");

                    if ($Langvar) {
                        $Langcc = $Langvar->PrefLang;
                    } else {
                        $Langcc = $DefaultLang;
                    } //end if
                } //end if

                if ($AutoLang and $Langcc) {
                    //UPDATE PrefLang FOR Guest user

                    $PrefLangdb = new db();
                    $PrefLangdb->query("UPDATE `users` SET `PrefLang` = '" . $Langcc . "' WHERE CONVERT( `users`.`UserName` USING utf8 ) = 'Guest';");
                } //end if
                $TheLang = $Langcc;
            } else {
                //get lang for this user from users table
                /*
                  ExcuteQuery("SELECT `PrefLang` FROM `users` WHERE `NickName`='".$InputNickName."';");
                  if ($TotalRecords>0){
                 */
                $TheLangdb = new db();
                $TheUserLang = $TheLangdb->get_var("SELECT `PrefLang` FROM `users` WHERE `NickName`='" . $InputNickName . "';");

                if ($TheUserLang) {
                    $TheLang = $TheUserLang;
                } else {
                    $TheLang = $DefaultLang;
                } //end if
                $TheLang;
            } //end if
        } else {
            $TheLang = $DefaultLang;
        } //end if
    } //end if

    $Lang = $TheLang;
    $_SESSION['Lang'] = $Lang;

    $dbLangid = new db();
    $idLang = $dbLangid->get_var(" SELECT `IdLang`  FROM `languages`  WHERE `LangName` = '" . $Lang . "'");

    $Hitsdb = new db();
    $Hitsdb->query("UPDATE `languages` SET `Hits` = `Hits` +1 WHERE `languages`.`LangName` = '" . $Lang . "' LIMIT 1 ;");
} //end if
//grub versions
include ('admin/CoreXml.php');
$VxmlCore = new SimpleXMLElement($xmlstr);
$Version['core'] = (string) $VxmlCore->Version;

$dbVersionSQL = new db();
//Programs versions
$VersionSQL = $dbVersionSQL->get_results(' select * from `programs` ; ');
if ($VersionSQL) {
    foreach ($VersionSQL as $datarow) {
        if (is_file('Programs/' . $datarow->ProgramName . '/admin/desc.php')) {
            if (is_file('Programs/' . $datarow->ProgramName . '/admin/desc.php')) {
                include 'Programs/' . $datarow->ProgramName . '/admin/desc.php';
                $Vxml = new SimpleXMLElement($xmlstr);
                $Version[$datarow->ProgramName] = (string) ($Vxml->Version);
            } else {
                $Version[$datarow->ProgramName] = $Version['core'];
            }
        } else {
            $Version[$datarow->ProgramName] = $Version['core'];
        }
    }
}
//Blocks versions
$VersionSQL = $dbVersionSQL->get_results(' select * from `blocks` ; ');
if ($VersionSQL) {
    foreach ($VersionSQL as $datarow) {
        if (is_file('Blocks/' . $datarow->BlockName . '/admin/desc.php')) {
            if (is_file('Blocks/' . $datarow->BlockName . '/admin/desc.php')) {
                include 'Blocks/' . $datarow->BlockName . '/admin/desc.php';
                $Vxml = new SimpleXMLElement($xmlstr);
                $Version[$datarow->BlockName] = (string) $Vxml->Version;
            } else {
                $Version[$datarow->BlockName] = $Version['core'];
            }
        } else {
            $Version[$datarow->BlockName] = $Version['core'];
        }
    }
}
//Themes versions
$VersionSQL = $dbVersionSQL->get_results(' select * from `themes` ; ');
if ($VersionSQL) {
    foreach ($VersionSQL as $datarow) {
        if (is_file('Themes/' . $datarow->ThemeName . '/admin/desc.php')) {
            if (is_file('Themes/' . $datarow->ThemeName . '/desc.php')) {
                include 'Themes/' . $datarow->ThemeName . '/desc.php';
                $Vxml = new SimpleXMLElement($xmlstr);
                $Version[$datarow->ThemeName] = (string) ($Vxml->Version);
            } else {
                $Version[$datarow->ThemeName] = $Version['core'];
            }
        } else {
            $Version[$datarow->ThemeName] = $Version['core'];
        }
    }
}

$LastLineCode = ''; //initialise variable for code like Javascript that must be in the last of the page
// get number total of users registered in our site
$Membersquery = 'SELECT * FROM `users`;';
$MembersDB = new db();
$MembersDBSQL = $MembersDB->get_results($Membersquery);
$MembersTotalRecords = count($MembersDBSQL);
?>