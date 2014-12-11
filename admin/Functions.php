<?php

/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
  Author: Mohsen Mousawi mhndm@phptransformer.com .

 */
?>
<?php

if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

function Help() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 0;
    $ViewMenu = 0;
    $ViewProg = 1;
    $ViewFoot = 1;
    $ProgCont = get_include_contents('admin/help/index.php');
}

//end funtion

function ChekForUpdate() {
    global $ThemeName, $Lang;

    //modifie date of last chek
    $dbLastChek = new db();
    $dbLastChek->query(" update `params` set `LastChekUpdate`='" . date('Y-m-d H:i:s') . "' ; ");

    return '
        <script language="javascript" type="text/javascript" src="admin/todo/update/ajax.js"></script>
        <script language="javascript" type="text/javascript">
            ChekForUpdate("' . $ThemeName . '","' . $Lang . '");
        </script>';
}

function IfUpdateAvailbe() {

    $IfUpdateAvailbe = 0;
    //get get updates list for core, programs and blocks
    $Core = array();
    $dbIfUpdateAvailbeSQL = new db();
    $IfUpdateAvailbeSQL = $dbIfUpdateAvailbeSQL->get_row(" SELECT * FROM `params` ; ");
    if ($IfUpdateAvailbeSQL) {
        $CoreUpdateAvailble = $IfUpdateAvailbeSQL->UpdateAvailble;
        if ($CoreUpdateAvailble) {
            $IfUpdateAvailbe++;
            $Core[] = $CoreUpdateAvailble;
            $Core[] = $IfUpdateAvailbeSQL->UpdateDesc;
        }
    }

    $Programs = array();
    $IfUpdateAvailbeSQL = $dbIfUpdateAvailbeSQL->get_results(" SELECT * FROM `programs` ; ");
    if ($IfUpdateAvailbeSQL) {
        foreach ($IfUpdateAvailbeSQL as $ProgAv) {
            if ($ProgAv->UpdateAvailble) {
                $IfUpdateAvailbe++;
                $Programs[] = array($ProgAv->ProgramName, $ProgAv->UpdateAvailble, $ProgAv->License, $ProgAv->UpdateDesc);
            }
        }
    }

    $Blocks = array();
    $IfUpdateAvailbeSQL = $dbIfUpdateAvailbeSQL->get_results(" SELECT * FROM `blocks` ; ");
    if ($IfUpdateAvailbeSQL) {
        foreach ($IfUpdateAvailbeSQL as $blocksAv) {
            if ($blocksAv->UpdateAvailble) {
                $IfUpdateAvailbe++;
                $Blocks[] = array($blocksAv->BlockName, $blocksAv->UpdateAvailble, $blocksAv->License, $blocksAv->UpdateDesc);
            }
        }
    }

    $Themes = array();
    $IfUpdateAvailbeSQL = $dbIfUpdateAvailbeSQL->get_results(" SELECT * FROM `themes` ; ");
    if ($IfUpdateAvailbeSQL) {
        foreach ($IfUpdateAvailbeSQL as $themesAv) {
            if ($themesAv->UpdateAvailble) {
                $IfUpdateAvailbe++;
                $Themes[] = array($themesAv->ThemeName, $themesAv->UpdateAvailble, $themesAv->License, $themesAv->UpdateDesc);
            }
        }
    }

    return array("Number" => $IfUpdateAvailbe,
        "Core" => $Core,
        "Programs" => $Programs,
        "Blocks" => $Blocks,
        "Themes" => $Themes);
}

function MustChekForUpdate() {

    $query = " select YEAR(`LastChekUpdate`) AS YEAR,
                MONTH(`LastChekUpdate`) AS MONTH,
                DAY(`LastChekUpdate`) AS DAY
                from `params`;";
    $dbLastChekUpdate = new db();
    $LastChekUpdate = $dbLastChekUpdate->get_row($query);

    if ($LastChekUpdate) {
        $ChekYear = $LastChekUpdate->YEAR;
        $ChekMonth = $LastChekUpdate->MONTH;
        $ChekDay = $LastChekUpdate->DAY;
    } else {//NO DATE
        $ChekYear = 1970;
        $ChekMonth = 1;
        $ChekDay = 1;
    }
    //current date
    $Year = date('Y');
    $Month = date('m');
    $Day = date('d');
    //cheking date difference

    if ($Year - $ChekYear > 0) {
        return true;
    } elseif ($Month - $ChekMonth > 0) {
        return true;
    } elseif ($Day - $ChekDay > 0) {
        return true;
    } else {
        return false;
    }
}

function IfAdminHavePermission() {
    global $AdminId, $HelpLink;

    if (isset($_GET['subdo'])) {
        $varName = 'subdo';
        $varValue = InputFilter(($_GET['subdo']));
    } elseif (isset($_GET['prog'])) {
        $varName = 'todo';
        $varValue = InputFilter(($_GET['prog']));
    } elseif (isset($_GET['block'])) {
        $varName = 'todo';
        $varValue = InputFilter(($_GET['block']));
    } elseif (isset($_GET['todo'])) {
        $varName = 'todo';
        $varValue = InputFilter(($_GET['todo']));
    } else {
        $varName = '';
        $varValue = '';
    }

    $query = "SELECT *  FROM `adminperm` WHERE
            `AdminID`='" . $AdminId . "' and
            `varName`='" . $varName . "' and
            `varValue`='" . $varValue . "';";
    $dbIfAsminHavePermission = new db();
    $IfAsminHavePermission = $dbIfAsminHavePermission->get_row($query);
    if ($IfAsminHavePermission) {
        if ($IfAsminHavePermission->perm) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}



function adminPrintMessageAndRedirect($titleMessage, $bodyMessage, $redirectTO) {
    global $ThemeName;
    if (is_file("admin/Themes/$ThemeName/message.php")) {
        $messageTheme = (get_include_contents("admin/Themes/$ThemeName/message.php"));
    } else {
        $messageTheme = '<div id="messageDIV" style="width: 100%;border: 1px dotted; " >
                            <div id="titleMessage" >{titleMessage}</div>
                            <div id="bodyMessage">{bodyMessage}</div>
                            <div id="redirectTO">{redirectTO}</div>
                        </div>';
    }
    $messageTheme = VarTheme("{titleMessage}", $titleMessage, $messageTheme);
    $messageTheme = VarTheme("{bodyMessage}", $bodyMessage, $messageTheme);
    $messageTheme = VarTheme("{redirectTO}", YouWillRedirectToThisPage . '<br/><a href="' . $redirectTO . '">' . $redirectTO . '</a>', $messageTheme);
    $printMessage = '<META HTTP-EQUIV=Refresh CONTENT="1; URL=' . $redirectTO . '">';
    return $printMessage . $messageTheme;
}

function SendYourModule() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/sendmodule/sendmodule.php');
    $ProgCont = $SendModule;
}

function Plugins() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/plugins/plugins.php');
    $ProgCont = $Plugins;
}

function AppsStore() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/appsstore/appstore.php');
    $ProgCont = $AppStore;
}

function Setup() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/setup/setup.php');
    $ProgCont = $Setup;
}

function Admins() {

    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/admins/permissions.php');
    $ProgCont = $Permission;
}

//end funtion

function Cache() {

    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/cache.php');
    $ProgCont = $CacheSystem;
}

//end funtion

function GetLicenseNbr($Table, $Column) {
    $GetLicenseNbr = 0;
    $Ldb = new db();
    $Lcnses = $Ldb->get_results("SELECT *  FROM `" . $Table . "`  ;");
    foreach ($Lcnses as $Lcnse) {
        $LicenseKey = $Lcnse->$Column;
        //$ProgramName = $Lcnse->ProgramName;
        //echo $LicenseKey . $ProgramName .'<br/>';
        if ($LicenseKey != "") { // key is installed
            $LicenseKey = LicenseInfo($LicenseKey);
            if ($LicenseKey != false) { // its valid key
                $ObjectName = $LicenseKey['ObjectName'];
                if ($ObjectName == "SPECIFIED") {
                    $GetLicenseNbr++;
                }//end if
            } else {
                $GetLicenseNbr++;
            }//end if
        } else {
            $GetLicenseNbr++;
        }//end if
    }//end for each
    return $GetLicenseNbr;
}

//end function

function LogLogin() {
    global $SqlType, $conn;
    if (isset($_POST['UserName'])) {
        $UserName = PostFilter($_POST['UserName']);
    } else {
        $UserName = '';
    }//end if
    if (isset($_POST['UserPassword'])) {
        $UserPassword = PostFilter($_POST['UserPassword']);
    } else {
        $UserPassword = '';
    }//end if

    $date = date('Y-m-d H:i:s');
    if ($SqlType == "MySql" and $UserName != '') {
        mysqli_query($conn, "INSERT INTO `adminlog` ( `TryName` , `TryPassword` , `TryDate` , `tryIp` )
  VALUES ('" . $UserName . "', '" . $UserPassword . "', '" . $date . "', '" . $_SERVER['REMOTE_ADDR'] . "');");
    }//end if
}

//end function

function GenerateMessage($LatterName, $IdLang, $UserName = "", $Password = "") {

    global $AdminId, $SqlType, $conn, $WebsiteUrl, $WebSiteName;
    if ($SqlType == "MySql") {
        $query = "SELECT *  FROM `letters` where `LatterName`='" . $LatterName . "' ;";
        $Recordset = mysqli_query($conn, $query);
        $TotalRecords = mysqli_num_rows($Recordset);
        if ($TotalRecords > 0) {
            $Rows = mysqli_fetch_assoc($Recordset);
            $idLetter = $Rows['idLetter'];
            $query = "SELECT `TitleLetter`,`BodyLetter` FROM `letterslang` WHERE `idLetter`='" . $idLetter . "' and `IdLang`='" . $IdLang . "';";
            $REs = mysqli_query($conn, $query); // ;
            $RecA = mysqli_fetch_assoc($REs);
            $TitleLetter = $RecA['TitleLetter'];
            $BodyLetter = $RecA['BodyLetter'];
            $BodyLetter = str_replace("{UserName}", $UserName, $BodyLetter);
            $BodyLetter = str_replace("{Password}", $Password, $BodyLetter);
            $BodyLetter = str_replace("{SiteUrl}", $WebsiteUrl, $BodyLetter);
            $BodyLetter = str_replace("{SiteName}", $WebSiteName, $BodyLetter);
            $q = "SELECT `AdminSign` FROM `admins` where `AdminId`='" . $AdminId . "';";
            $Records = mysqli_query($conn, $q); // ;
            $TRecords = mysqli_num_rows($Records);
            $R = mysqli_fetch_assoc($Records);
            if ($TRecords > 0) {
                $AdminSign = $R['AdminSign'];
            } else {
                $AdminSign = "";
            }//end if
            $BodyLetter = str_replace("{AdminSign}", $AdminSign, $BodyLetter);
            $BodyLetter = str_replace("{Date}", date('m j, Y, g:i a'), $BodyLetter);
            $BodyLetter = AddWebiteFolderToUrl($BodyLetter);
            return array($TitleLetter, $BodyLetter);
        } else {
            return array(" ", " ");
            ;
        }//end if
    }//end if
}

//end function

function BlockIconLink($Icon, $SubIcon) {
    global $AdminFileName;
    if (!constantDefined($SubIcon)) {
        $SubIconText = $SubIcon;
    } else {
        $SubIconText = constant($SubIcon);
    }
    $Vars = array("block", "subdo");
    $Vals = array($Icon, $SubIcon);
    return '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . $SubIcon . '" >' . $SubIconText . '</a>';
}

//end function

function ProgIconLink($Icon, $SubIcon) {
    global $AdminFileName;

    if (!constantDefined($SubIcon)) {
        $SubIconText = $SubIcon;
    } else {
        $SubIconText = constant($SubIcon);
    }

    $Vars = array("prog", "subdo");
    $Vals = array($Icon, $SubIcon);
    return '<div  class="ProgIconLink">'
            . '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . $SubIcon . '" >' . $SubIconText . '</a></div>';
}

//end function

function SubIconLink($Icon, $SubIcon) {
    global $AdminFileName;

    if (!constantDefined($SubIcon)) {
        $SubIconText = $SubIcon;
    } else {
        $SubIconText = constant($SubIcon);
    }

    $Vars = array("todo", "subdo");
    $Vals = array($Icon, $SubIcon);
    return '<a href="' . AdminCreateLink("", $Vars, $Vals) . '" title="' . $SubIcon . '" >' . $SubIconText . '</a>';
}

//end function

function AdminCreateLink($QryUrl, $Vars, $Vals) {//return link if user use rew or no
    global $Lang, $AdminFileName;
// force fix language 
    $Vars[] = "Lang";
    $Vals[] = $Lang;
    $Vars[] = "nl";
    $Vals[] = "1";

    foreach ($Vars as $i => $var) {
        if (!$i) {
            if ($QryUrl != "") {
                $Link = "$AdminFileName?" . $QryUrl . "&" . $var . "=" . $Vals[$i];
            } else {
                $Link = "$AdminFileName?" . $var . "=" . $Vals[$i];
            }
        } else {
            $Link.="&" . $var . "=" . $Vals[$i];
        }//end if
    }
    return $Link;
}

//end function

function AdminNewLangLink($OldLang, $NewLang) { //get url for new lang
    global $AdminFileName;
    $oldUrl = $_SERVER['QUERY_STRING'];
    $oldUrl = str_replace("?", "", $oldUrl);
    if (strstr($oldUrl, $AdminFileName)) {
        $oldUrl = str_replace($AdminFileName, "", $oldUrl);
    }//end if

    if (strstr($oldUrl, $OldLang)) {
        $newUrl = str_replace($OldLang, $NewLang, $oldUrl);
    } else {
        $newUrl = $oldUrl . "&Lang=" . $NewLang;
    }//end if

    return $newUrl;
}

//end function

function AdminLangLink($QryUrl) {//return link if user use rew or no for language
    global $UseRew, $AdminFileName;
    /*
      if($UseRew == "1"){//website use rewrite url
      $QryUrl= str_replace("-_", "_",$QryUrl);
      $QryUrl = RewriteUrl($QryUrl);
      $QryUrl= str_replace("-_", "_",$QryUrl);
      $QryUrl = str_replace("-.pt", ".pt",$QryUrl);
      return $QryUrl;
      }
      else{ //simple links
     */
    $Link = str_replace("$AdminFileName?", "", $QryUrl);
    $Link = "$AdminFileName?" . $Link;
    return $Link;
    //}//end if
}

//end function

function Progs() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    //var_dump($_GET);
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    $dbProg = new db();
    $prog = InputFilter($_GET['prog']);
    $exst = $dbProg->get_row(" select * from `programs` where `ProgramName`='" . $prog . "' and `Deleted`!='1'; ");
    if ($exst) {
        $ProgCont = get_include_contents('Programs/' . $prog . '/admin/index.php');
        //update last prog
        $LastProg = $prog;
        $dbProg->query("update `params` set `LastProg`='" . $LastProg . "' ;");
    } else {
        $ProgCont = ProgramERR;
    }
}

//end funtion

function Blocks() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    $dbLastBlock = new db();
    $LastBlock = InputFilter($_GET['block']);
    $exst = $dbLastBlock->get_row(" select * from `blocks` where `BlockName`='" . $LastBlock . "' and `Deleted`!='1'; ");
    if ($exst) {
        $ProgCont = get_include_contents('Blocks/' . InputFilter($_GET['block']) . '/admin/index.php');
        //update last Block
        $dbLastBlock->query("update `params` set `LastBlock`='" . $LastBlock . "' ;");
    } else {
        $ProgCont = ProgramERR;
    }
}

//end funtion

function RegUsers() {

    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/RegUsers.php');
    $ProgCont = $RegUsers;
}

//end funtion

function AdsUsers() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/AdsUsers.php');
    $ProgCont = $AdsUsers;
}

//end funtion

function Login() {
    global $Login, $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 0;
    $ViewProg = 1;
    $ViewFoot = 1;
    if (!file_exists("admin/Themes/" . $ThemeName . "/index.php")) {
        $ThemeName = 'Default';
    }
    include_once('admin/login.php');
    $ProgCont = $Login;
}

//end function

function Welcom() {
    global $AdminId, $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/Welcom.php');
    $ProgCont = $welcom;
}

//end funtion

function members() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/members/members.php');
    $ProgCont = $members;
}

//end funtion

function groups() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/groups/groups.php');
    $ProgCont = $groups;
}

//end funtion

function maillist() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/maillist/maillist.php');
    $ProgCont = $maillist;
}

//end funtion

function letters() {

    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/letters/letters.php');
    $ProgCont = $letters;
}

//end funtion

function programs() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/programs/programs.php');
    $ProgCont = $programs;
}

//end funtion

function newprograms() {
    global $License, $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/programs/newprograms.php');
    $ProgCont = $newprograms;
}

//end funtion

function programscontrol() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/programs/programscontrol.php');
    $ProgCont = $programscontrol;
}

//end funtion

function programspermisions() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/programs/programspermisions.php');
    $ProgCont = $programspermisions;
}

//end funtion

function programmanagment() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/programs/programmanagment.php');
    $ProgCont = $programmanagment;
}

//end funtion

function recycle() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/Recycle/Recycle.php');
    $ProgCont = $recycle;
}

//end funtion

function antiflood() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/antiflood.php');
    $ProgCont = $antiflood;
}

//end funtion

function blockscontrol() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/blocks/blockscontrol.php');
    $ProgCont = $blockscontrol;
}

//end funtion

function newblock() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/blocks/newblock.php');
    $ProgCont = $newblock;
}

//end funtion

function blockspermisions() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/blocks/blockspermisions.php');
    $ProgCont = $blockspermisions;
}

//end funtion

function blocksmanagment() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/blocks/blocksmanagment.php');
    $ProgCont = $blocksmanagment;
}

//end funtion

function database() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    global $dbHostName, $dbUserName, $dbPass, $restore, $dbBaseName, $backup, $BackupFolder, $LOG;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/support/database.php');
    $ProgCont = $DataBase;
}

//end funtion

function backup() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/support/backup.php');
    $ProgCont = $backup;
}

//end funtion

function restore() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/support/restore.php');
    $ProgCont = $restore;
}

//end funtion

function optimize() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/support/optimize.php');
    $ProgCont = $optimize;
}

//end funtion

function bugsandreport() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/support/bugsandreport.php');
    $ProgCont = $bugsandreport;
}

//end funtion

function blocking() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/blocking/blocking.php');
    $ProgCont = $blocking;
}

//end funtion

function specialpermision() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/specialpermision/specialpermision.php');
    $ProgCont = $specialpermision;
}

//end funtion

function faildlogin() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/faildlogin.php');
    $ProgCont = $faildlogin;
}

//end funtion

function languages() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/languages/languages.php');
    $ProgCont = $languages;
}

//end funtion

function contieslangs() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/contieslangs.php');
    $ProgCont = $contieslangs;
}

//end funtion

function themes() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/themes/themes.php');
    $ProgCont = $themes;
}

//end funtion

function layersmenu() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/layersmenu/layersmenu.php');
    $ProgCont = $layersmenu;
}

//end funtion

function mainmenu() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/mainmenu/mainmenu.php');
    $ProgCont = $mainmenu;
}

//end funtion

function newsbar() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/newsbar.php');
    $ProgCont = $newsbar;
}

//end funtion

function robotsadmin() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/robotsadmin.php');
    $ProgCont = $robotsadmin;
}

//end funtion

function options() {
    global $AdminId, $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/options.php');
    $ProgCont = $options;
}

//end funtion

function pages() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/pages.php');
    $ProgCont = $pages;
}

//end funtion

function SEO() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/SEO.php');
    $ProgCont = $SEO;
}

//end funtion

function Error() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/Error.php');
    $ProgCont = $Error;
}

//end funtion

function Logout() {
    global $WebsiteUrl;
    $_SESSION['Login' . $WebsiteUrl] = false;
    unset($_SESSION['Login' . $WebsiteUrl]);
    $path = explode("/", $_SERVER['PHP_SELF']);
    header('Location: ' . $path[count($path) - 1]);
}

//end function

function Translations() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/translations/translations.php');
    $ProgCont = $Translations;
}

//end funtion

function webfolder() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/webfolder/index.php');
    $ProgCont = $webfolder;
}

//end funtion

function Update() {
    global $Lang, $IsAdmin, $ProgCont, $ThemeName, $ViewTop, $ViewMenu, $ViewProg, $ViewFoot;
    $ViewTop = 1;
    $ViewMenu = 1;
    $ViewProg = 1;
    $ViewFoot = 1;
    include_once('admin/todo/update/index.php');
    $ProgCont = $Update;
}

//end funtion
?>