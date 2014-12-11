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

//MAKE PAGES ZIPPED FOR BANDWIDTH RANSFER 
ini_set('zlib.output_compression_level', 6);
ob_start('ob_gzhandler');
// END GZIP
global $conn, $AdminId,$IsAdmin,$project,$TheNavBar,$UserId,$Version;
$IsAdmin ="phpTransformerAdmin";
$project = "PhpTransformer";
$Author  ="mhndm";
$CustomHead = '';
$CustomBody  = "";
$TitlePage ="";
$DontShowNavContVar = 0;

require_once('config.php');
include_once("includes/session.php");

if( isset($_SERVER["HTTPS"])){
    if($_SERVER["HTTPS"]=='on'){
        $scheme = 'https';
    }
    else{
         $scheme = 'http';
    }
}
else{
    $scheme = 'http';
}
//include_once('includes/Rewrite.php');
include_once('includes/Functions.php');
include_once('includes/InputFilters.php');
include_once('includes/checkValidity.php');
include_once('includes/Passwords.php');
include_once("includes/ezsql/ez_sql.php");

include_once('includes/Sql.php');
require_once("DBConnect/".$SqlType."/index.php");
include_once('includes/ErrLog.php');

SqlConnect();
include_once('Global.php');

$UseRew = false; // note depend in  CreateLink in functions.php please read before modie

if(!file_exists ("admin/Themes/".$ThemeName."/index.php")) {
    $ThemeName = 'Default';
}

include_once("admin/Functions.php");

if(isset($_GET['logout'])) {
    if($_GET['logout']=="1") {
        Logout();
    }
}//end if

$TitlePage = $WebSiteName;


//proceding login 
if(!isset($_SESSION['Login'.$WebsiteUrl])) {
//posting info

    // get user name
    if(isset($_POST['UserName'])) {
        $UserName = PostFilter($_POST['UserName']);
    }
    else {
        $UserName="";
    }//End if

    //get password
    if(isset($_POST['UserPassword'])) {
        $UserPassword = PostFilter($_POST['UserPassword']);
    }
    else {
        $UserPassword = "";
    }//End if

    $dbUser= new db();
    $dbvarUser = $dbUser->get_row("select * FROM `users` WHERE `NickName`='".$UserName."' and `NickName`<>'' ;");
    //var_dump($dbAdminUser);
    if($dbvarUser) {
        $UserId     = $dbvarUser->UserId;
        $PassWord   = $dbvarUser->PassWord;
        $Lang       = $dbvarUser->PrefLang;
        if(is_file($dbvarUser->PrefThem)) {
            $ThemeName  = $dbvarUser->PrefThem;
        }else {
            $ThemeName = 'Default';
        }
        loadLangFiles($Lang);
    }
    else {
        LogLogin();
        loadLangFiles($DefaultLang);
        Login();
    }

    if(isset($UserId)) {
        ExcuteQuery("SELECT * FROM `admins` where `AdminId`='".$UserId."';");
        if ($TotalRecords>0) {
            global $AdminId,$AdminMail,$LastLogin,$LastIp ,$Note;
            $AdminId = $Rows['AdminId'];
            $AdminMail = $Rows['AdminMail'];
            $LastLogin = $Rows['LastLogin'];
            $LastIp = $Rows['LastIp'];
            $Note= $Rows['Note'];
            $BackupFolder = $Rows['BackupFolder'];
        }//end if
    }
    if(isset($PassWord) and isset($AdminId)) {
        if($PassWord == md5($UserPassword)) {

            if(!isset($_SESSION['Login'.$WebsiteUrl])) {

                // update login onfo
                
                $QueryLogAdmin = "UPDATE `admins` SET `LastLogin` = '".date('Y-m-d H:i:s')."',`LastIp` = '".$_SERVER['REMOTE_ADDR']."'
                                        WHERE `admins`.`AdminId` = '".$AdminId."';" ;
                
                $Recordset = mysqli_query($conn,$QueryLogAdmin)  ;

            }//end if

            $_SESSION['Login'.$WebsiteUrl] = true;
            $_SESSION['UserId'] = $UserId;
            $Vars = array('home');
            $Vals = array('1');
            $redirectTO = AdminCreateLink('', $Vars, $Vals);
            $DontShowNavContVar =1;
            $ViewProg = true ;
            $ViewNavCont =false;
            $ProgCont = adminPrintMessageAndRedirect(Welcome, SuccessAdminLogin, $redirectTO);
        }
        else {
            LogLogin();
            //NUMER OF TRY TO LOGIN 10 AND WE WILL STOP
            mysqli_query($conn,"SET @@session.time_zone = '+00:00';");
            $Q ="SELECT * FROM `adminlog`
                            where UNIX_TIMESTAMP()-UNIX_TIMESTAMP(`TryDate`)<60;";

            ExcuteQuery($Q);
            if ($TotalRecords>10) { ///Ten try's
                //redirect to home page of website
                header("Location: index.php");
            }
            else {
                Login();
            }//end if

        }//end if
    }
    else{
        //user exist and password error and not admin
        LogLogin();
        loadLangFiles($DefaultLang);
        Login();
        
    }
}
else {
    //session already set

    if($_SESSION['Login'.$WebsiteUrl]== true) {
        $Lang = $_SESSION['Lang'];
        $UserId = $_SESSION['UserId'];
        $dbAdmin= new db();
        $dbAdminUser = $dbAdmin->get_row("select * FROM `users` WHERE `UserId`='".$UserId."' ;");
        //var_dump($dbAdminUser);
        if($dbAdminUser) {
            $UserId     = $dbAdminUser->UserId;
            $GroupId    = $dbAdminUser->GroupId;
            $TimeFormat = $dbAdminUser->TimeFormat;
            $UserName   = $dbAdminUser->UserName;
            $NickName   = $dbAdminUser->NickName;
            $ParentName = $dbAdminUser->ParentName;
            $FamName    = $dbAdminUser->FamName;
            $Gmt        = $dbAdminUser->Gmt;
            $PassWord   = $dbAdminUser->PassWord;
            $PrefLang   = $dbAdminUser->PrefLang;
            $ThemeName  = $dbAdminUser->PrefThem;
            $UserSign   = $dbAdminUser->UserSign;
            $LastLogin   = $dbAdminUser->LastLogin;
            //change date format for current admin option:
            $timestamp 		= strtotime($LastLogin);
            $LastLogin		= date($TimeFormat, $timestamp+($Gmt*60*60));
        }
        // echo $UserId;
        $dbAdminUser = $dbAdmin->get_row("SELECT * FROM `admins` where `AdminId`='".$UserId."';");
        $Stopped = '0000-00-00 00:00:00';
        if($dbAdminUser) {
            global $AdminId,$AdminMail,$LastLogin,$LastIp ,$Note;
            $AdminId = $dbAdminUser->AdminId;
            $AdminMail = $dbAdminUser->AdminMail;
            $LastLogin =$dbAdminUser->LastLogin;
            $timestamp 		= strtotime($LastLogin);
            $LastLogin		= date($TimeFormat, $timestamp+($Gmt*60*60));
            $LastIp = $dbAdminUser->LastIp;
            $Note = $dbAdminUser->Note;
            $BackupFolder = $dbAdminUser->BackupFolder;
            $Stopped = $dbAdminUser->Stopped;
        }
        else{
            $PrefLang = $Lang;
        }
        if(!file_exists ("admin/Themes/".$ThemeName."/index.php")) {
            $ThemeName = 'Default';
        }

        loadLangFiles($PrefLang);

        if($Stopped == '0000-00-00 00:00:00') {
            DotIT();
        }
        else { // this admin was stopped by Adam
            $ViewTop = 1;
            $ViewMenu = 0;
            $ViewProg = 1;
            $ViewFoot = 0;
            $ViewNavCont = 0;
            $DontShowNavContVar = 1;
            $ProgCont =  DearAdminYouAreStopped;
        }

    }
    else {
        Login();
    }//end if

}//end if

function loadLangFiles($LangToLoad) {
    global $TinyDir,$UserId;
    if(isset($_GET['Lang'])) {
        $dbLangOk = new db();
        $LangOk = $dbLangOk->get_row(" select `LangName` from `languages` where `LangName`='".InputFilter($_GET['Lang'])."' ;");
        if($LangOk) {
            $LangToLoad = $LangOk->LangName;
        }
    }

    //update current admin favlang
    $dbAdminLang = new db();
    $dbAdminLang->query(" update `users` set `PrefLang`='".$LangToLoad."' where `UserId`='".$UserId."' ; ");

    if(file_exists("languages/lang-".$LangToLoad.".pt.php")) {
        require_once("languages/lang-".$LangToLoad.".pt.php"); //custom translation
    }
    else {
        // if file exist
        if(file_exists("languages/lang-".$LangToLoad.".php")) {
            require_once("languages/lang-".$LangToLoad.".php");
        }
    }
    if(file_exists("admin/languages/lang-".$LangToLoad.".pt.php")) {
        require_once("admin/languages/lang-".$LangToLoad.".pt.php");//custom translation
    }else {
        //if file exist
        if(file_exists("admin/languages/lang-".$LangToLoad.".php")) {
            require_once("admin/languages/lang-".$LangToLoad.".php");
        }
    }
    //direction for tiny mce
    if(DirHtml != "ltr") {
        $TinyDir = 'right';
    }
    else {
        $TinyDir = 'left';
    }//end if
}
function DotIT() {
    
    global $IdLang,$AdminId,$AdminFileName,$Lang,$TheNavBar,$BackupFolder, $TitlePage,$ViewNavCont ;
    global  $IsAdmin,$ProgCont,$ThemeName,$ViewTop,$ViewMenu,$ViewProg,$ViewFoot;
    
    $db_admin_lng = new db();
    $IdLang = $db_admin_lng->get_var(" select `IdLang` from `languages` where `LangName`='".$Lang."'; ");
    
    
    $ViewNavCont = true;
    // the navigation bar array
    $TheNavBar = array(array( (HomePage),$AdminFileName.'?home=1&Lang='.$Lang.'&nl=1'));
    // Check PERMISSION
    if(!IfAdminHavePermission()) {
        $ViewTop = 1;
        $ViewMenu = 1;
        $ViewProg = 1;
        $ViewFoot = 1;
        $ProgCont = DearAdminYouDontHavePermission;
    }else {
        if(isset($_GET['todo'])) {
            $todo =  InputFilter($_GET['todo']);
            switch ($todo) {
                case "admins":
                    $TitlePage .= ' :: ' .  Admins;
                    $TheNavBar[] = array(Admins,adminCreateLink("",array("todo"),array("admins")));
                    Admins();
                    break;
                case "cache":
                    $TitlePage .= ' :: ' .  (CacheSystem);
                    $TheNavBar[] = array( (CacheSystem),adminCreateLink("",array("todo"),array("cache")));
                    Cache();
                    break;
                case "regusers":
                    $TitlePage .= ' :: ' .  (RegUsersOk);
                    $TheNavBar[] = array( (RegUsersOk),adminCreateLink("",array("todo"),array("regusers")));
                    RegUsers();
                    break;
                case "adsusers":
                    $TitlePage .= ' :: ' .  (AdsUsersOk);
                    $TheNavBar[] = array( (AdsUsersOk),adminCreateLink("",array("todo"),array("adsusers")));
                    AdsUsers();
                    break;
                case "members":
                    $TitlePage .= ' :: ' .  (Members);
                    $TheNavBar[] = array( (Members),adminCreateLink("",array("todo"),array("members")));
                    members();
                    break;
                case "groups":
                    $TitlePage .= ' :: ' .  (Groups);
                    $TheNavBar[] = array( (Groups),adminCreateLink("",array("todo"),array("groups")));
                    groups();
                    break;
                case "maillist":
                    $TitlePage .= ' :: ' .  (MailList);
                    $TheNavBar[] = array( (MailList),adminCreateLink("",array("todo"),array("maillist")));
                    maillist();
                    break;
                case "letters":
                    $TitlePage .= ' :: ' .  (Letters);
                    $TheNavBar[] = array( (Letters),adminCreateLink("",array("todo"),array("letters")));
                    letters();
                    break;
                case "programscontrol":
                    $TitlePage .= ' :: ' .  (ProgramsControl);
                    $TheNavBar[] = array( (ProgramsControl),adminCreateLink("",array("todo"),array("programscontrol")));
                    programscontrol();
                    break;
                case "newprograms":
                    $TitlePage .= ' :: ' .  (NewPrograms);
                    $TheNavBar[] = array( (NewPrograms),adminCreateLink("",array("todo"),array("newprograms")));
                    newprograms();
                    break;
                case "programs":
                    $TitlePage .= ' :: ' .  Programs;
                    $TheNavBar[] = array( Programs,adminCreateLink("",array("todo"),array("programs")));
                    programs();
                    break;
                case "programspermisions":
                    $TitlePage .= ' :: ' .  (ProgramsPermisions);
                    $TheNavBar[] = array( (ProgramsPermisions),adminCreateLink("",array("todo"),array("programspermisions")));
                    programspermisions();
                    break;
                case "blockscontrol":
                    $TitlePage .= ' :: ' .  (BlocksControl);
                    $TheNavBar[] = array( (BlocksControl),adminCreateLink("",array("todo"),array("blockscontrol")));
                    blockscontrol();
                    break;
                case "newblock":
                    $TitlePage .= ' :: ' .  (NewBlock);
                    $TheNavBar[] = array( (NewBlock),adminCreateLink("",array("todo"),array("newblock")));
                    newblock();
                    break;
                case "blockspermisions":
                    $TitlePage .= ' :: ' .  (BlocksPermisions);
                    $TheNavBar[] = array( (BlocksPermisions),adminCreateLink("",array("todo"),array("blockspermisions")));
                    blockspermisions();
                    break;
                case "blocksmanagment":
                    $TitlePage .= ' :: ' .  (BlocksManagment);
                    $TheNavBar[] = array( (BlocksManagment),adminCreateLink("",array("todo"),array("blocksmanagment")));
                    blocksmanagment();
                    break;
                case "database":
                    $TitlePage .= ' :: ' .  DataBase;
                    $TheNavBar[] = array( DataBase,adminCreateLink("",array("todo"),array("database")));
                    database();
                    break;
                case "backup":
                    $TitlePage .= ' :: ' .  (Backup);
                    $TheNavBar[] = array( (Backup),adminCreateLink("",array("todo"),array("backup")));
                    backup();
                    break;
                case "restore":
                    $TitlePage .= ' :: ' .  (Restore);
                    $TheNavBar[] = array( (Restore),adminCreateLink("",array("todo"),array("restore")));
                    restore();
                    break;
                case "optimize":
                    $TitlePage .= ' :: ' .  (Optimize);
                    $TheNavBar[] = array( (Optimize),adminCreateLink("",array("todo"),array("optimize")));
                    optimize();
                    break;
                case "bugsandreport":
                    $TitlePage .= ' :: ' .  (BugsandReport);
                    $TheNavBar[] = array( (BugsandReport),adminCreateLink("",array("todo"),array("bugsandreport")));
                    bugsandreport();
                    break;
                case "antiflood":
                    $TitlePage .= ' :: ' .  (AntiFlood);
                    $TheNavBar[] = array( (AntiFlood),adminCreateLink("",array("todo"),array("antiflood")));
                    antiflood();
                    break;
                case "blocking":
                    $TitlePage .= ' :: ' .  (Blocking);
                    $TheNavBar[] = array( (Blocking),adminCreateLink("",array("todo"),array("blocking")));
                    blocking();
                    break;
                case "specialpermision":
                    $TitlePage .= ' :: ' .  (SpecialPermision);
                    $TheNavBar[] = array( (SpecialPermision),adminCreateLink("",array("todo"),array("specialpermision")));
                    specialpermision();
                    break;
                case "faildlogin":
                    $TitlePage .= ' :: ' .  (FaildLogin);
                    $TheNavBar[] = array( (FaildLogin),adminCreateLink("",array("todo"),array("faildlogin")));
                    faildlogin();
                    break;
                case "languages":
                    $TitlePage .= ' :: ' .  (Languages);
                    $TheNavBar[] = array( (Languages),adminCreateLink("",array("todo"),array("languages")));
                    languages();
                    break;
                case "contieslangs":
                    $TitlePage .= ' :: ' .  (ContiesLangs);
                    $TheNavBar[] = array( (ContiesLangs),adminCreateLink("",array("todo"),array("contieslangs")));
                    contieslangs();
                    break;
                case "themes":
                    $TitlePage .= ' :: ' .  (Themes);
                    $TheNavBar[] = array( (Themes),adminCreateLink("",array("todo"),array("themes")));
                    themes();
                    break;
                case "layersmenu":
                    $TitlePage .= ' :: ' .  (LayersMenu);
                    $TheNavBar[] = array( (LayersMenu),adminCreateLink("",array("todo"),array("layersmenu")));
                    layersmenu();
                    break;
                case "mainmenu":
                    $TitlePage .= ' :: ' .  (MainMenu);
                    $TheNavBar[] = array( (MainMenu),adminCreateLink("",array("todo"),array("mainmenu")));
                    mainmenu();
                    break;
                case "newsbar":
                    $TitlePage .= ' :: ' .  (NewsBar);
                    $TheNavBar[] = array( (NewsBar),adminCreateLink("",array("todo"),array("newsbar")));
                    newsbar();
                    break;
                case "robotsadmin":
                    $TitlePage .= ' :: ' .  (RobotsAdmin);
                    $TheNavBar[] = array( (RobotsAdmin),adminCreateLink("",array("todo"),array("robotsadmin")));
                    robotsadmin();
                    break;
                case "options":
                    $TitlePage .= ' :: ' .  (Options);
                    $TheNavBar[] = array( (Options),adminCreateLink("",array("todo"),array("options")));
                    options();
                    break;
                case "recycle":
                    $TitlePage .= ' :: ' .  (Recycle);
                    $TheNavBar[] = array( (Recycle),adminCreateLink("",array("todo"),array("recycle")));
                    recycle();
                    break;
                case "pages":
                    $TitlePage .= ' :: ' .  (Pages);
                    $TheNavBar[] = array( (Pages),adminCreateLink("",array("todo"),array("pages")));
                    pages();
                    break;
                case "SEO":
                    $TitlePage .= ' :: ' .  (SEO);
                    $TheNavBar[] = array( (SEO),adminCreateLink("",array("todo"),array("SEO")));
                    SEO();
                    break;
                case "Translations":
                    $TitlePage .= ' :: ' .  (Translations);
                    $TheNavBar[] = array( (Translations),adminCreateLink("",array("todo"),array("Translations")));
                    Translations();
                    break;
                case "webfolder":
                    $TitlePage .= ' :: ' .  (WebFolder);
                    $TheNavBar[] = array( (webfolder),adminCreateLink("",array("todo"),array("webfolder")));
                    webfolder();
                    break;
                case "Update":
                    $TitlePage .= ' :: ' .  (Update);
                    $TheNavBar[] = array( (Update),adminCreateLink("",array("todo"),array("Update")));
                    Update();
                    break;
                case "Error":
                    $TitlePage .= ' :: ' .  (Error);
                    $TheNavBar[] = array( (Error),adminCreateLink("",array("todo"),array("Error")));
                    Error();
                    break;
                case "setup":
                    $TitlePage .= ' :: ' . Setup;
                    $TheNavBar[] = array( Setup,adminCreateLink("",array("todo"),array("setup")));
                    Setup();
                    break;
                case "appsstore":
                    $TitlePage .= ' :: ' . AppsStore;
                    $TheNavBar[] = array( AppsStore,adminCreateLink("",array("todo"),array("AppsStore")));
                    AppsStore();
                    break;
                case "plugins":
                    $TitlePage .= ' :: ' . Plugins;
                    $TheNavBar[] = array( Plugins,adminCreateLink("",array("todo"),array("plugins")));
                    Plugins();
                    break;
                case "sendmodule":
                    $TitlePage .= ' :: ' . SendYouModule;
                    $TheNavBar[] = array( SendYouModule,adminCreateLink("",array("todo"),array("sendmodule")));
                    SendYourModule();
                    break;
                default:
                    $TitlePage .= ' :: ' .  (welcomPage);
                    Welcom();
            }//end swith
        }
        elseif(isset($_GET['prog'])) {
            $TitlePage .= ' :: ' .  (Programs);
            $TheNavBar[] = array( (Programs),adminCreateLink("",array("todo"),array("programs")));
            $Progname = InputFilter($_GET['prog']);
            //include lang file
            $LangFile = 'Programs/'.$Progname.'/admin/Languages/lang-'.$Lang.'.php';
            if(is_file($LangFile)) {
                include_once($LangFile);
            }
            if(is_file('Programs/'.$Progname.'/index.php')) {
                if(constantDefined($Progname)){
                   $PrognameName = constant($Progname);
                }
                else{
                    $PrognameName = $Progname;
                }
                $TheNavBar[] = array($PrognameName,adminCreateLink("",array("prog"),array(InputFilter($_GET['prog']))));
            }
            $prog = InputFilter($_GET['prog']);
            Progs();

        }
        elseif(isset($_GET['block'])) {
            $TitlePage .= ' :: ' .  (Block);
            $TheNavBar[] = array( (BlocksManagment),adminCreateLink("",array("todo"),array("blocksmanagment")));
            $Blockname = InputFilter($_GET['block']);
            //include lang file
            $LangFile = 'Blocks/'.$Blockname.'/admin/Languages/lang-'.$Lang.'.php';
            if(is_file($LangFile)) {
                include_once($LangFile);
            }
            if(is_file('Programs/'.$Blockname.'/admin/index.php')) {
                if(constantDefined($Blockname)){
                   $BlocknameName = constant($Blockname);
                }
                else{
                    $BlocknameName = $Blockname;
                }
                $TheNavBar[] = array($BlocknameName,adminCreateLink("",array("block"),array(InputFilter($_GET['block']))));
            }
            $block = InputFilter($_GET['block']);
            Blocks();
        }
        elseif(isset($_GET['help'])) {
            $TitlePage .= ' :: ' .  Help;
            Help();
        }
        else {
            $TitlePage .= ' :: ' .  (welcomPage);
            Welcom();
        }//end if
    }
}//end function

include_once("admin/languages.php");
include_once("admin/Themes.php");

?>