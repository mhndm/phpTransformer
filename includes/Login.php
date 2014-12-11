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

if (!isset($project)) {
    header("location: ../");
}
?>
<?php

global $account, $GroupId;
//Trying login counter
// logout  portion
if (isset($_GET['acnt'])) {
    if ($_GET['acnt'] == "logout") {
        unset($_SESSION['LastLogin']);
        $SeeRand = md5(time() . rand(0, 9999999));
        $query = "UPDATE `users` SET `LastSession` = '" . $SeeRand . "' WHERE `LastSession` = '" . session_id() . "' ;";
        $LastSessiondb = new db();
        $LastSessiondb->query($query);
        setcookie("LastSession", $SeeRand, time() - 3600);
        $P = CreateLink("", array("Prog"), array($MainPrograms));
        header("Location: $P");
    }//end if
}//end if
//Login portion
if (isset($_COOKIE['LastSession'])) { // this user has logged in the past
    $UserNickName = IsLastSessionTrue(InputFilter($_COOKIE['LastSession']));
    if ($UserNickName) {
        $account = LoginAsUser($UserNickName);
    } else {
////old session or try to hack
        $SeeRand = md5(time() . rand(0, 9999999));
        setcookie("LastSession", $SeeRand, time() - 3600);
        $account = LoginAsUser('Guest');
    }
} elseif (isset($_GET['nk']) and isset($_GET['ps'])) { //get login
    $GetUserPass = UserAndPassTrue(InputFilter($_GET['nk']), InputFilter($_GET['ps']));
    if ($GetUserPass) {
        if (is_bool($GetUserPass)) {
            $account = LoginAsUser(InputFilter($_GET['nk']));
        } else {
            $account = $GetUserPass;
        }
    } else {
        $account = LoginAsUser('Guest');
    }
} elseif (isset($_POST['InputNickName']) and isset($_POST['InputPassword'])) {//post loggin
    $PostUserPass = UserAndPassTrue(PostFilter($_POST['InputNickName']), PostFilter($_POST['InputPassword']));
    if ($PostUserPass) {
        if (is_bool($PostUserPass)) {
            $account = LoginAsUser(PostFilter($_POST['InputNickName']));
            setcookie("TryLogin", 0);
        } else {
            $account = $PostUserPass;
        }
    } else {
        if (isset($_COOKIE['TryLogin'])) {
            $TryLogin = $_COOKIE['TryLogin'];
            $TryLogin++;
            setcookie("TryLogin", $TryLogin);
            global $MaxNbrPost;
            if ($TryLogin > $MaxNbrPost) {
                LoginAsUser('Guest');
                $account = MaximumTryToLogin;
            } else {
                $account = LoginAsUser('Guest');
            }
        } else {
            setcookie("TryLogin", 0);
            $account = LoginAsUser('Guest');
        }
    }
} else {
    if (isset($_COOKIE['TryLogin'])) {
        $TryLogin = $_COOKIE['TryLogin'];
        global $MaxNbrPost;
        if ($TryLogin > $MaxNbrPost) {
            LoginAsUser('Guest');
            $account = MaximumTryToLogin;
        } else {
            $account = LoginAsUser('Guest');
        }
    } else {
        setcookie("TryLogin", 0);
        $account = LoginAsUser('Guest');
    }
// $account = LoginAsUser('Guest');
}

function LoginAsUser($UserNickName) {

    global $CacheEnabled, $MainPrograms, $DefaultLang, $Lang, $PrefLang, $ActiveMessage, $UserId, $GroupId, $TimeFormat,
    $UserName, $NickName, $ParentName, $FamName, $BirthDate, $Sex, $Gmt, $Contry, $Rue,
    $AddDetails, $CodePostal, $ZipCode, $PhoneNbr, $CellNbr, $PassWord, $LastLogin, $LastIP,
    $Hobies, $Job, $Education, $PrefLang, $PrefTime, $CookieLife, $UserPic, $UserMail,
    $UserSite, $Banned, $PrefThem, $UserSign, $Points, $Active, $RegDate, $allowHtml,
    $allowBBcode, $allowSmiles, $allowAvatar, $ThemeName, $AdminFileName, $town;
    $UserNickName;
// Get user info
    $query = " select * from `users` where `NickName`='" . $UserNickName . "' ; ";
    $dbLoginAsUser = new db();
    $LoginAsUser = $dbLoginAsUser->get_row($query);

    $UserId = $LoginAsUser->UserId;
    $GroupId = $LoginAsUser->GroupId;
    $TimeFormat = $LoginAsUser->TimeFormat;
    $UserName = $LoginAsUser->UserName;
    $NickName = $LoginAsUser->NickName;
    $ParentName = $LoginAsUser->ParentName;
    $FamName = $LoginAsUser->FamName;
    $BirthDate = $LoginAsUser->BirthDate;
    $Sex = $LoginAsUser->Sex;   // 1 male 0 female
    $Gmt = $LoginAsUser->Gmt;
    $Contry = $LoginAsUser->Contry;
    $town = $LoginAsUser->town;
    $Rue = $LoginAsUser->Rue;
    $AddDetails = $LoginAsUser->AddDetails;
    $CodePostal = $LoginAsUser->CodePostal;
    $ZipCode = $LoginAsUser->ZipCode;
    $PhoneNbr = $LoginAsUser->PhoneNbr;
    $CellNbr = $LoginAsUser->CellNbr;
    $LastLogin = $LoginAsUser->LastLogin;
    $LastIP = $LoginAsUser->LastIP;
    $Hobies = $LoginAsUser->Hobies;
    $Job = $LoginAsUser->Job;
    $Education = $LoginAsUser->Education;
    $PrefLang = $LoginAsUser->PrefLang;
    $PrefTime = $LoginAsUser->PrefTime;
    $CookieLife = $LoginAsUser->CookieLife;
    $UserPic = $LoginAsUser->UserPic;
    $UserMail = $LoginAsUser->UserMail;
    $UserSite = $LoginAsUser->UserSite;
    $PrefThem = $LoginAsUser->PrefThem;
    $UserSign = $LoginAsUser->UserSign;
    $Points = $LoginAsUser->Points;
    $RegDate = $LoginAsUser->RegDate;
    $allowHtml = $LoginAsUser->allowHtml;
    $Banned = $LoginAsUser->Banned;
    $allowBBcode = $LoginAsUser->allowBBcode;
    $allowSmiles = $LoginAsUser->allowSmiles;
    $allowAvatar = $LoginAsUser->allowAvatar;
    $ConfirmCode = $LoginAsUser->ConfirmCode;
    $Active = $LoginAsUser->Active;

    $_SESSION['NickName'] = $NickName;

    if (empty($UserPic)) {
        $UserPic = 'images/avatars/noavatar.gif';
    }

    if (isset($_GET['thm'])) {
        $ThemeGet = InputFilter($_GET['thm']);

        if (!themeOK($ThemeGet)) {
            $ThemeGet = $PrefThem;
        } else {
            setcookie('thm', $ThemeGet);
        }
    } elseif (isset($_COOKIE['thm'])) {
        $ThemeGet = InputFilter($_COOKIE['thm']);
        if (!themeOK($ThemeGet)) {
            $ThemeGet = $PrefThem;
        }
    }


    if (!isset($ThemeGet)) {
        if (themeOK($PrefThem)) {
            $ThemeName = $PrefThem;
        } else {
            $ThemeName = 'Default';
        }
    } else {
        $ThemeName = $ThemeGet;
    }

//change session name and only from cookies for security reason
    ini_set('session.use_only_cookies', 1);
    $new_name = session_name();

    if ($NickName == 'Guest') {

        if ($CacheEnabled) {
            $_SESSION['cache'] = true; //system cache enabled
        }

        $LoginAsUser = ShowLoginForm();
    } else {
        if (isset($_SESSION['NickName'])) {
            if (!isset($_SESSION['LastLogin'])) {
                $_SESSION['LastLogin'] = true;
//update last login for this user

                $Logtimestamp = strtotime(date($TimeFormat));
                $LogLastLogin = date($TimeFormat, $Logtimestamp + ($Gmt * 60 * 60));
                $dbLast = new db();
                $dbLast->query(" update `users` set `LastLogin`='" . $LogLastLogin . "' where `UserId`='" . $UserId . "' ; ");
            }
        }
//update current user favlang
        $dbLang = new db();
        $dbLang->query(" update `users` set `PrefLang`='" . $Lang . "' where `UserId`='" . $UserId . "' ; ");

//welcom
        $SignOutLink = CreateLink("", array("Prog", "acnt"), array("account", "logout"));
        $UserControlPanelLink = CreateLink("", array("Prog"), array("usercp"));



        $Theme = get_include_contents('Themes/' . $ThemeName . '/Logged.php');
        $Theme = VarTheme('{Welcome}', Welcome, $Theme);
        $Theme = VarTheme('{UserName}', $UserName, $Theme);
        $Theme = VarTheme('{FamName}', $FamName, $Theme);
        $Theme = VarTheme('{SignOutLink}', $SignOutLink, $Theme);
        $Theme = VarTheme('{SignOut}', SignOut, $Theme);
        $Theme = VarTheme('{UserPic}', $UserPic, $Theme);
        $Theme = VarTheme('{YourLastLoginInDate}', YourLastLoginInDate, $Theme);
        $Theme = VarTheme('{LastLogin}', $LastLogin, $Theme);
        $Theme = VarTheme('{UserControlPanelLink}', $UserControlPanelLink, $Theme);
        $Theme = VarTheme('{UserControlPanel}', UserControlPanel, $Theme);
//display link to the admin control panel
        $dbIsAdmin = new db();
        $dbIsAdminRow = $dbIsAdmin->get_row("select * from `admins` where `AdminId`='" . $UserId . "' ; ");

        if ($dbIsAdminRow) {
            $Theme = VarTheme('{AdminControlPanelLink}', $AdminFileName, $Theme);
            $Theme = VarTheme('{AdminControlPanel}', AdminControlPanel, $Theme);
        } else {
            $Theme = VarTheme('{AdminControlPanelLink}', '', $Theme);
            $Theme = VarTheme('{AdminControlPanel}', '', $Theme);
        }
        $LoginAsUser = $Theme;

//system cache disabled
        $_SESSION['cache'] = false;
//set cookie last session
        if (isset($_POST['Remember'])) {
            $Remember = PostFilter($_POST['Remember']);
            $Remember = CookieLife($Remember);
            setcookie("LastSession", session_id(), time() + $Remember);
        } else {
            setcookie("LastSession", session_id(), time() + $CookieLife);
        }
//update LastSession
//echo session_id().$NickName;
        $query = "UPDATE `users` SET `LastSession` = '" . session_id() . "' WHERE `NickName` = '" . $NickName . "' ;";
        $LastSessiondb = new db();
        $LastSessiondb->query($query);
//redirect to certain url if isset or to the home paGe if login from the program
        //var_dump($_GET);
        if (isset($_GET['continue'])) {
            $redirect = $_GET['continue'];
            //$urlregex = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
            if (filter_var($redirect, FILTER_VALIDATE_URL)) {
                header("Location: $redirect");
            }
        } elseif (isset($_GET['Prog']) and isset($_GET['acnt'])) {
            if ($_GET['Prog'] == 'account' and $_GET['acnt'] == 'login') {
                $Vars = array("Prog");
                $Vals = array($MainPrograms);
                $P = CreateLink("", $Vars, $Vals);
                header("Location: $P");
            }
        }
    }
//StoreLogin($NickName); //moved to statistics

    return $LoginAsUser;
}

function IsLastSessionTrue($Session) {
    $query = "select * from `users` where `LastSession`='" . $Session . "'  and `Deleted`<>'1' ; ";
    $IsLastSessionTrueDB = new db();
    $IsLastSessionTrue = $IsLastSessionTrueDB->get_row($query);
    if ($IsLastSessionTrue) {
        $UserNickName = $IsLastSessionTrue->NickName;
    } else {
        $UserNickName = false;
    }
    return $UserNickName;
}

function UserAndPassTrue($User, $Password) {

    $query = "select * from `users` where `NickName`='" . $User . "' and `PassWord`='" . md5($Password) . "' and `Deleted`<>'1' ; ";
    $dbUserAndPassTrue = new db();
    $UserAndPassTrue = $dbUserAndPassTrue->get_row($query);
// admin must say ok first

    if ($UserAndPassTrue) {
        if ($UserAndPassTrue->Active) {
            return true;
        } else {
            return YouAreNotActiveNow;
        }
    } else {
        return false;
    }
}

function ShowLoginForm() { // when user is Guest
    global $ThemeName;

    $LoginNotes = LoginFailed;
    $SignUpLink = CreateLink("", array("Prog", "acnt"), array("account", "fastsignup"));
    $ForgetLink = CreateLink("", array("Prog", "acnt"), array("account", "forget"));
    $NewUserRegister = '<a href="' . $SignUpLink . '" />' . NewUserRegister . '</a>';
    $Theme = get_include_contents('Themes/' . $ThemeName . '/LoginForm.php');
    $Theme = VarTheme('{LoginNotes}', $LoginNotes, $Theme);
    $Theme = VarTheme('{NewUserRegister}', $NewUserRegister, $Theme);
//$Theme = VarTheme('{SignUpLink}', $SignUpLink,$Theme );
    $Theme = VarTheme('{UserName}', UserName, $Theme);
    $Theme = VarTheme('{Password}', Password, $Theme);
    $Theme = VarTheme('{RememberMeFor}', RememberMeFor, $Theme);
    $Theme = VarTheme('{Year}', Year, $Theme);
    $Theme = VarTheme('{Month}', Month, $Theme);
    $Theme = VarTheme('{Week}', Week, $Theme);
    $Theme = VarTheme('{Day}', Day, $Theme);
    $Theme = VarTheme('{NeverRemember}', NeverRemember, $Theme);
    $Theme = VarTheme('{submit}', submit, $Theme);
    $Theme = VarTheme('{ForgetLink}', $ForgetLink, $Theme);
    $Theme = VarTheme('{ForgetPassword}', ForgetPassword, $Theme);
    $Theme = VarTheme('{LoginCommenttext}', LoginCommenttext, $Theme);
    $Theme = VarTheme('{ThemeName}', $ThemeName, $Theme);

    return $Theme;
}

function themeOK($ThemChek) { // chek if this theme registered and not deleted
    $themeOKdb = new db();
//echo "select * from `themes` where `ThemeName`='".$ThemChek."' and `Active`='1';";
    $themeOK = $themeOKdb->get_results("select * from `themes` where `ThemeName`='" . $ThemChek . "' and `Active`='1';");
    if (count($themeOK)) {
        return true;
    } else {
        return false;
    }
}

?>