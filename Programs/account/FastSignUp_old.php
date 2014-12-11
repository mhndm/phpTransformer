<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .<font face="Courier New, Courier, mono"></font>
 * 	Date Created: 00-00-2007.
 * 	Last Modified: 00-00-2007.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php if (!isset($project)) {
    header("location: ../../");
} ?>
<?php

global $Lang, $OpenRegister, $GeoIpService, $IpNbr, $MainPrograms;
//if admin open the registrations OpenRegister
$UserSign = '';
$UserSite = '';
$PrefTime = '';
$PrefLang = $Lang;
$Education = '';
$Job = '';
$Hobies = '';
$CellNbr = '';
$PhoneNbr = '';
$ZipCode = '';
$CodePostal = '';
$AddDetails = '';
$Rue = '';
$town = '';
$Gmt = '';
$Sex = '';
$ParentName = '';
$TimeFormat = 'Y-m-d H:i:s';
$BirthDate_Day = '';
$BirthDate_Month = '';
$BirthDate_Year = '';
if ($OpenRegister == "1") {
    if (isset($_POST['SignUp'])) {
        $Err = false;
        //UserNameErr
        if (isset($_POST['UserName'])) {
            if (MinField($_POST['UserName'])) {
                $UserNameErr = '<img alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
            } else {
                $UserNameErr = '<a href="javascript:void(0)" title="' . (UserNameErrDesk) . '"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a>';
                $Err = true;
                //echo "err UserName";
            }//end if
            $UserName = PostFilter($_POST['UserName']);
        } else {
            $UserNameErr = "";
            $UserName = "";
        }//end if
        //FamNameErr
        if (isset($_POST['FamName'])) {
            if (MinField($_POST['FamName'])) {
                $FamNameErr = '<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
            } else {
                $FamNameErr = '<a href="javascript:void(0)" title="' . (FamNameErrDesk) . '"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
                $Err = true;
                //echo "err FamName";
            }//end if
            $FamName = PostFilter($_POST['FamName']);
        } else {
            $FamNameErr = "";
            $FamName = "";
        }//end if
        //NickNameErr
        if (isset($_POST['NickName'])) {
            if (ValidUser($_POST['NickName'])) {
                $NickNameErr = '<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
                $NickName = PostFilter($_POST['NickName']);
            } else {
                $NickNameErr = '<a href="javascript:void(0)" title="' . (NickNameErrDesk) . '"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
                $Err = true;
                $NickName = "";
                //echo "err NickName";
            }//end if
        } else {
            $NickNameErr = "";
            $NickName = "";
        }//end if
        //PassWordErr
        if (isset($_POST['PassWord'])) {
            if ($_POST['PassWord']) {
                $PassWordErr = '<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
            } else {
                $PassWordErr = '<img border="0" alt="No" title="Err" src="Programs/account/images/no.gif"/> ';
            }//end if
            $PassWord = PostFilter($_POST['PassWord']);
        } else {
            $PassWordErr = "";
            $PassWord = "";
        }//end if
        //UserMailErr
        if (isset($_POST['UserMail'])) {
            if (check_email($_POST['UserMail'])) {
                $UserMailErr = '<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
            } else {
                $UserMailErr = '<a href="javascript:void(0)" title="' . (UserMailErrDesk) . '"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
                $Err = true;
                //echo "err UserMail";
            }//end if
            $UserMail = PostFilter($_POST['UserMail']);
        } else {
            $UserMailErr = "";
            $UserMail = "";
        }//end if
        //captcha err
        if (isset($_POST['SignUp'])) {
            require_once('recaptchalib.php');
            $privatekey = "6LdiFb0SAAAAAEfP_4ZtU7Ihbnx-rRtSi12gaPt_";
            $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
            if (!$resp->is_valid) {
                // What happens when the CAPTCHA was entered incorrectly
                $CaptchaErr = (CaptchaErr);
                $Err = true;
            }
        }
        if ($Err) {
            echo '<div class="err" >' . AnError . '</div>';
            include_once("Programs/account/FastSignUPForm.php");
        } else {
            //chosing signup or signup success  or new registeration
            if (isset($_POST['SignUp'])) {
                $UserPic = "";
                //if AdminRegOk is true
                global $AdminRegOk;
                $UserId = GenerateID("users", "UserId");
                $GroupId = "20070000001";
                $ConfirmCode = md5(date("Y-m-d") . $UserId . rand(1, 9999999999));
                //2007-05-10
                $BirthDate = $BirthDate_Year . "-" . $BirthDate_Month . "-" . $BirthDate_Day;
                //2007-05-10 21:45:07
                $LastLogin = date("Y-m-d H:i:s");
                $LastIP = $_SERVER['REMOTE_ADDR'];
                $Banned = "0";
                $Points = "0";
                $Active = "0";
                $RegDate = date("Y-m-d H:i:s");
                $allowHtml = "0";
                $allowBBcode = "0";
                $allowSmiles = "0";
                $allowAvatar = "1";
                //$TimeFormat=str_replace("/", "-",$TimeFormat);
                //$TimeFormat.=" H:i:s";
                $PassWord = md5($PassWord);
                $CookieLife = 86400;

                $TheContryCode = strtolower(GetPageContent($GeoIpService . $IpNbr));

                if ($AdminRegOk == "1") {
                    // admin must accept, insert new account with status off, and send alert to the  admin, when admin ok send link confirm to the user
                    //add new record for new user
                    $InsertQwery = "INSERT INTO `users` ( `UserId` , `GroupId` , `TimeFormat` , `UserName` , `NickName` , `ParentName` , `FamName` , `BirthDate` , `Sex` , `Gmt` , `Contry` , `town` , `Rue` , `AddDetails` , `CodePostal` , `ZipCode` , `PhoneNbr` , `CellNbr` , `PassWord` , `LastLogin` , `LastIP` , `Hobies` , `Job` , `Education` , `PrefLang` , `PrefTime` , `CookieLife` , `UserPic` , `UserMail` , `UserSite` , `Banned` , `PrefThem` , `UserSign` , `Points` , `Active` , `RegDate` , `allowHtml` , `allowBBcode` , `allowSmiles` , `allowAvatar` , `ConfirmCode` )";
                    //converting " and '   to code  htmlentities( , ENT_QUOTES)
                    $InsertQwery.=" VALUES ('" . htmlentities($UserId, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($GroupId, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($TimeFormat, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($NickName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ParentName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($FamName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($BirthDate, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Sex, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Gmt, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($TheContryCode, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($town, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Rue, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($AddDetails, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($CodePostal, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ZipCode, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PhoneNbr, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($CellNbr, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PassWord, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($LastLogin, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($LastIP, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Hobies, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Job, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Education, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PrefLang, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PrefTime, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($CookieLife, ENT_QUOTES, 'utf-8') . "', '" . $UserPic . "', '" . htmlentities($UserMail, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserSite, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Banned, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ThemeName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserSign, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Points, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Active, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($RegDate, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowHtml, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowBBcode, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowSmiles, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowAvatar, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ConfirmCode, ENT_QUOTES, 'utf-8') . "');";
                    SqlConnect();

                    global $conn, $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $TotalRecords, $Rows;
                    $RSInsert = mysqli_query($conn,$InsertQwery) ;
                    //echo $InsertQwery;

                    echo (SuccessSignup);
                } else {
                    //direct register without admin ok, insert new account with sending confirm link to the mail user
                    //add new record for new user
                    $Active = "1";
                    $InsertQwery = "INSERT INTO `users` ( `UserId` , `GroupId` , `TimeFormat` , `UserName` , `NickName` , `ParentName` , `FamName` , `BirthDate` , `Sex` , `Gmt` , `Contry` , `town` , `Rue` , `AddDetails` , `CodePostal` , `ZipCode` , `PhoneNbr` , `CellNbr` , `PassWord` , `LastLogin` , `LastIP` , `Hobies` , `Job` , `Education` , `PrefLang` , `PrefTime` , `CookieLife` , `UserPic` , `UserMail` , `UserSite` , `Banned` , `PrefThem` , `UserSign` , `Points` , `Active` , `RegDate` , `allowHtml` , `allowBBcode` , `allowSmiles` , `allowAvatar` , `ConfirmCode` )";
                    //converting " and '   to code  htmlentities( , ENT_QUOTES)
                    $InsertQwery.=" VALUES ('" . htmlentities($UserId, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($GroupId, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($TimeFormat, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($NickName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ParentName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($FamName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($BirthDate, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Sex, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Gmt, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($TheContryCode, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($town, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Rue, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($AddDetails, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($CodePostal, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ZipCode, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PhoneNbr, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($CellNbr, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PassWord, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($LastLogin, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($LastIP, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Hobies, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Job, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Education, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PrefLang, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($PrefTime, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($CookieLife, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserPic, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserMail, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserSite, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Banned, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ThemeName, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($UserSign, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Points, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($Active, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($RegDate, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowHtml, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowBBcode, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowSmiles, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($allowAvatar, ENT_QUOTES, 'utf-8') . "', '" . htmlentities($ConfirmCode, ENT_QUOTES, 'utf-8') . "');";
                    SqlConnect();

                    global $conn, $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $TotalRecords, $Rows;
                    $RSInsert = mysqli_query($conn,$InsertQwery) ;
                    //echo $InsertQwery;
                    // create activate link
                    $Vars = array("Prog", "acnt", "actvcode", "user");
                    $Vals = array("account", "activate", $ConfirmCode, $NickName);

                    $ActivateLink = CreateLink("", $Vars, $Vals);
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                    global $AdminMail, $WebSiteName, $WebSiteName, $AdminMail;

                    $From = $AdminMail;
                    $FromName = $WebSiteName;
                    $AddAddress[0] = $UserMail;
                    $AddAddress[1] = $NickName;
                    $Subject = (eMailSubjectNewUserRegister) . $WebSiteName;
                    $Body = '<div dir="' . (DirHtml) . '" >' . (DearMr) . $UserName . " " . $FamName . "<br/>" . (eMailBodyNewUserRegister) . '<br><a href="' . $ActivateLink . '" target="_blank">' . $ActivateLink . '<a/>' . "</div>" . (EmailSignature);
                    echo SendEmail($From, $FromName, $AddAddress, $Subject, $Body);
                    echo "<br/>";
                    echo (SuccessSignupWihout);
                }
            }//end if  
            //sign in
            /*
              if(login($NickName,$PassWord) ){

              setcookie("InputNickName", "$NickName", time() + 3110);
              //setcookie("SID", EncryptMd5Text($PassWord), time() + 3110);
              setcookie("LastSession", session_id(), time() + 3110);
              // Stop cache system
              $_SESSION['cache']=false;
              }
             */
            //Inform and redirect to the home page
            $Vars = array("Prog");
            $Vals = array($MainPrograms);
            $P = CreateLink("", $Vars, $Vals);
            echo '<br/><br/><META HTTP-EQUIV=Refresh CONTENT="1; URL=' . $P . '">';
            echo (YouWillRedirectToTheHomePage);
        }
    }//end if
    else {
        $CaptchaErr = '';
        $UserMailErr = '';
        $UserMail = '';
        $PassWordErr = '';
        $PassWord = '';
        $FamNameErr = '';
        $FamName = '';
        $UserNameErr = '';
        $UserName = '';
        $NickNameErr = '';
        $NickName = '';
        include_once("Programs/account/FastSignUPForm.php");
    }
} else {
    echo (RegistrationClosed);
}//end if
?>
