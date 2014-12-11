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
    header("location: ../../");
}
?>
<?php
global $TheNavBar, $ThemeName, $Lang, $CustomBody, $CustomHead, $TitlePage;

$TitlePage .= ' .:. ' . (UserCp);
$TheNavBar[] = array((UserCp), CreateLink("", array("Prog"), array("usercp")));

$mainPanel = "dsad";
?>

<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <?php
        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        ?>
        <td class="shadetabs"><a href="<?php echo CreateLink('', $Vars, $Vals); ?>" title="<?php echo (generalInfo) ?>">&nbsp;<?php echo (generalInfo) ?>&nbsp;</td>
        <?php $Vals = array('usercp', 'ainfo'); ?>
        <td class="shadetabs"><a href="<?php echo CreateLink('', $Vars, $Vals); ?>" title="<?php echo (addressInfo) ?>">&nbsp;<?php echo (addressInfo) ?>&nbsp;</td>    
        <?php $Vals = array('usercp', 'pinfo'); ?>
        <td class="shadetabs"><a href="<?php echo CreateLink('', $Vars, $Vals); ?>" title="<?php echo (preferenceInfo) ?>">&nbsp;<?php echo (preferenceInfo) ?>&nbsp;</td>
        <?php
        global $UserId, $TotalRecords, $Rows;
        // cheking if this user alredy have and publisher account
        ExcuteQuery('SELECT * FROM `bannerclients` WHERE `UserId` ="' . $UserId . '";');
        if ($TotalRecords > 0) {
            $Vars = array('Prog');
            $Vals = array('ads');
        } else {
            $Vars = array('Prog', 'cpc');
            $Vals = array('usercp', 'adsp');
        }//end if
        ?>
        <td class="shadetabs"><a href="<?php echo CreateLink('', $Vars, $Vals); ?>" title="<?php echo (adsPage) ?>">&nbsp;<?php echo (adsPage) ?>&nbsp;</td>    

    </tr>
</table>

<?php
global $NickName, $UserName;
echo '<br/>';
if ($NickName == "Guest") {
    $login_link = CreateLink("", array("Prog", "acnt"), array("account", "login"));
    echo" <a href='" . $login_link . "' >" . LoginFailed . "</a>";
} else {

    if (isset($_GET['edtusr']) and $UserName != "Guest") {
        $edtusr = InputFilter($_GET['edtusr']);
        switch ($edtusr) {
            case "UserName":
                UpdateUserInfo($edtusr);
                break;
            case "ParentName":
                UpdateUserInfo($edtusr);
                break;
            case "TimeFormat":
                TimeFormat();
                break;
            case "FamName":
                UpdateUserInfo($edtusr);
                break;
            case "BirthDate":
                BirthDate($edtusr);
                break;
            case "Sex":
                Sex($edtusr);
                break;
            case "Gmt":
                Gmt($edtusr);
                break;
            case "Contry":
                Contry($edtusr);
                break;
            case "town":
                UpdateUserInfo($edtusr);
                break;
            case "Rue":
                UpdateUserInfo($edtusr);
                break;
            case "AddDetails":
                UpdateUserInfo($edtusr);
                break;
            case "CodePostal":
                UpdateUserInfo($edtusr);
                break;
            case "ZipCode":
                UpdateUserInfo($edtusr);
                break;
            case "PhoneNbr":
                UpdateUserInfo($edtusr);
                break;
            case "CellNbr":
                UpdateUserInfo($edtusr);
                break;
            case "PassWord":
                PassWord($edtusr);
                break;
            case "Hobies":
                UpdateUserInfo($edtusr);
                break;
            case "Job":
                UpdateUserInfo($edtusr);
                break;
            case "Education":
                UpdateUserInfo($edtusr);
                break;
            case "PrefLang":
                PrefLang($edtusr);
                break;
            case "PrefTime":
                PrefTime($edtusr);
                break;
            case "CkieLife":
                CkieLife($edtusr);
                break;
            case "UserPic":
                UserPic($edtusr);
                break;
            case "UserMail":
                UpdateUserInfo($edtusr);
                break;
            case "UserSite":
                UpdateUserInfo($edtusr);
                break;
            case "PrefThem":
                PrefThem($edtusr);
                break;
            case "UserSign":
                UserSign($edtusr);
                break;

            default :
                break;
        }//end switch
    } else {
        ShowUserInfo();
    }//end if
}

function adsInvite() {
    // invite this user to be an publisher	
    global $CustomHead;
    $PriceListExist = false;
    $dbPriceListExist = new db();
    $PriceListExist = $dbPriceListExist->get_row("SELECT * FROM `bannerplans`;");
    if (!$PriceListExist) {
        echo AdvestisingIsNotAvailbleNow;
        return null;
    }
    $CustomHead .= '<script src="Programs/usercp/SpryValidationCheckbox.js" type="text/javascript"></script>
				  <link href="Programs/usercp/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />';
    echo "<div >";
    echo "<br />" . (WhyYouAdsWhithUs) . "<br /><br />";
    echo (NbrOfRegisteredUsers) . ' ' . NbrOfRegisteredUsers() . "<br /><br />";
    echo (NbrOfSessions) . ' ' . NbrOfSessions("Visists") . "<br /><br />";
    echo (PagesPerSessions) . ' ' . NbrOfSessions("Pagespervisit") . "<br /><br />";
    echo (ContriesOfUsersSites) . "<br />";
    echo CountiresOfUsers(600, 300) . "<br />";
    echo "<br />" . (UsersPreferLang) . "<br />";
    echo LanguageOfUsers(600, 300) . "<br />";
    echo "<br />" . (ProgramsAttractive) . "<br />";
    echo ProgramsMustView(600, 300) . "<br />";
    echo "<br />" . (PagesAttractive) . "<br />";
    echo PagesMustViewed(600, 300) . "<br />";
    echo "<br />" . (OpSysMustUsed) . "<br />";
    echo BrowsersAndOperatingSystems("OpSys") . "<br />";
    //pay systems and accept policys
    //got to create banner account
    $Vars = array('Prog', 'newid');
    $Vals = array('ads', 'yes');
    echo '<form id="formads" name="formads" method="post" action="' . CreateLink('', $Vars, $Vals) . '">
	    <p>
		' . (YourPreferedWayToPay) . '
	    <select name="adsPayment" id="select">
	      <option value="Cash">' . (Cash) . '</option>
		  <option value="WesternUnion">' . (WesternUnion) . '</option>
		  <option value="CreditCard">' . (CreditCard) . '</option>
		  <option value="ByChek">' . (ByChek) . '</option>
		  <option value="BankTransfer">' . (BankTransfer) . '</option>
	    </select>
	    <br /><br />
	    <span id="sprycheckbox1">
	    <input type="checkbox" name="accept" id="accept" />
	    <span class="checkboxRequiredMsg">
		' . (Pleasemakeaselection) . '
		</span></span>' . (IHaveReadPolicy) . '
		<div align="center">
	      <input type="submit" name="submitads" id="submitads" value="' . (ApplyNow) . '" />
		 </div>
		</form>
		<br /><br />
		<script type="text/javascript">
		<!--
		var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
		//-->
		</script>';
}

function CkieLife($edtusr) {
    if (isset($_POST['submitedtusr'])) {
        $Remember = PostFilter($_POST['Remember']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `CookieLife` = "' . CookieLife($Remember) . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($UpdateQuery, $conn);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'pinfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        echo '<form action="" method="post">';
        echo '<br /> &nbsp; ' . (RememberMeFor) . ' &nbsp; <select name="Remember" class="select"><option value="Year">' . (Year) . '</option><option value="Month" selected="selected">' . (Month) . '</option><option value="Week">' . (Week) . '</option><option value="Day">' . (Day) . '</option><option value="NeverRemember">' . (NeverRemember) . '</option></select> &nbsp;';
        //CookieLife($Period);
        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /></form>';
    } //end if
}

//end function

function Contry($edtusr) {
    global $conn;
    if (isset($_POST['submitedtusr'])) {
        $Contry = PostFilter($_POST['Contry']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $Contry . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ainfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {

        echo '<form action="" method="post">';
        echo '<br /> &nbsp; ' . (Contry);
        echo ' &nbsp; <select dir="ltr" class="select" name="Contry">';
        SqlConnect();
        $query = "SELECT * FROM `cclang`;";
        global $conn;

        $Rec = mysqli_query($conn, $query); //  ;	
        $Totals = mysqli_num_rows($Rec);
        if ($Totals > 0) {
            for ($i = 0; $i < $Totals; $i++) {
                $ContryRows = mysqli_fetch_assoc($Rec);
                echo '<option value="' . $ContryRows['cc'] . '">' . $ContryRows['Contry'] . '</option>';
            }
        }//end if
        mysqli_free_result($Rec);

        echo '</select>';
        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /></form>';
    } //end if
}

//end function

function UserPic($edtusr) {

    global $UserId, $conn, $UserMail;

    if (isset($_POST['submitedtusr'])) {
        $UserPic = PostFilter($_POST['UserPic']);

        if (is_bool(strpos($UserPic, 'http://www.gravatar.com'))) {
            $UserPic = 'images/avatars/' . $UserPic;
        }
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $UserPic . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';
        $Recordset = mysqli_query($conn, $UpdateQuery);
        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        global $UserPic;
        $PicturesList = array();
        $Images = array(".jpg", ".gif", ".png");
        $d = dir("images/avatars/");
        echo '<script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                        document.getElementById("submitedtusr").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>
                    <form action="" method="post">';
        //Gravatar
        if ($UserPic == get_gravatar('mhndm@yahoo.com')) {
            $slct = ' checked="checked" ';
        } else {
            $slct = '';
        }
        $PicturesList[] = '<div style="border:inset; vertical-align:top; width:110px; ">
                                    <input type="radio" name="UserPic" ' . $slct . ' value="' . get_gravatar($UserMail) . '" />
                                    Gravatar<br/>
                                    <img src="' . get_gravatar($UserMail) . '" alt=""  />
                                    </p></div>';
        while (false !== ($entry = $d->read())) {
            if ($entry != "." and $entry != ".." and is_file($d->path . $entry)) {
                if (strpos(strtolower($entry), ".jpg") or strpos(strtolower($entry), ".gif") or strpos(strtolower($entry), ".png")) {
                    if ('images/avatars/' . $entry == $UserPic) {
                        $slct = 'checked="checked" ';
                    } else {
                        $slct = '';
                    }
                    $PicturesList[] = '<div style="border:inset; vertical-align:top; width:110px; ">
										<input type="radio" name="UserPic" ' . $slct . ' value="' . $entry . '" />
										' . $entry . '<br/>
										<img src="images/avatars/' . $entry . '" alt=""  />
										</p></div>';
                }
            }
        }
        $d->close();
        $PicturesListTab = Pagination($PicturesList, 10, 10);
        echo $PicturesListTab[0];
        echo ' &nbsp; <input class="submit" type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /></form>';
        echo $PicturesListTab[1];

        /*
          echo  CreateNaviPage($PicturesList,$MaxResultPerPage=10,$ShowNaviBar=1).'<br/>'; // divid data between pages, and give number for eanch page
          echo  CreateNaviPage($PicturesList,$MaxResultPerPage=10,$ShowNaviBar=0); // print content of this page
         */
    } //end if
}

//end function

function UserSign($edtusr) {
    global $conn;
    if (isset($_POST['submitedtusr'])) {
        $UserSign = PostFilter($_POST['UserSign']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $UserSign . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        global $UserSign, $CustomHead;
        $CustomHead .= ' <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />


    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"          type="text/javascript" charset="utf-8"></script>

    
    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
			
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "' . MiniLang . '",
                height   : 250,
		width:500,
                toolbar  : "mini",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
           
            }
            $(".editor").elrte(opts);
           
        })
    </script>';


        echo ' &nbsp; <form action="" method="post">' . (UserSign) . ' &nbsp; ';
        echo '<br /><textarea class="editor" name="UserSign" rows="2" cols="" style="width: 242px">' . $UserSign . '</textarea>';
        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /></form>';
    }//end if
}

//end function

function Sex($edtusr) {
    global $conn;
    if (isset($_POST['submitedtusr'])) {
        $Sex = PostFilter($_POST['Sex']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $Sex . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        global $Sex;
        echo ' &nbsp; <form action="" method="post">' . (Sex) . ' &nbsp; ';
        echo '<select class="select" name="Sex">';
        if ($Sex == "1") {
            echo '<option selected="selected" value="1">';
        } else {
            echo '<option value="1">';
        }//end if

        echo (Male);

        echo '</option>';

        if ($Sex == "0") {
            echo '<option selected="selected" value="0">';
        } else {
            echo '<option value="0">';
        }//end if

        echo (Female);
        echo '</option></select>&nbsp;';
        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /></form>';
    }//end if
}

//end function

function PassWord($edtusr) {
    global $UserId, $conn;
    if (isset($_POST['submitedtusr'])) {

        $OldPassWord = md5(PostFilter($_POST['OldPassWord']));
        $dbPass = new db();
        // echo "select `PassWord` from `users` where `UserId`='".$UserId."';";
        $TheOldPassword = $dbPass->get_row("select `PassWord` from `users` where `UserId`='" . $UserId . "';");
        //echo $TheOldPassword->PassWord ;
        if ($TheOldPassword->PassWord != $OldPassWord) {
            //do logout
            echo "logout";
        } else {
            $PassWord = md5(PostFilter($_POST['PassWord']));

            $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $PassWord . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

            $Recordset = mysqli_query($conn, $UpdateQuery);

            $Vars = array('Prog', 'cpc');
            $Vals = array('usercp', 'ginfo');
            $P = CreateLink('', $Vars, $Vals);
            header("Location: $P");
        }
    } else {
        global $CustomHead;
        $CustomHead .='<script type="text/javascript">
					function validatepass() { 
						pass = document.getElementById("PassWord").value;
						repass = document.getElementById("RePassWord").value;
						if(pass != repass){
							errors ="' . (PassWordErrDesk) . '";
						}
						window.alert(errors);
						document.returnValue = (errors == "");
					}
					</script>';
        echo '<form action="" method="post">';
        echo '<table border="0" cellpadding="0" cellspacing="0">';

        echo '<tr><td>' . PassWord . '</td><td><input maxlength="35" value="OldPassWord" class="text" id="OldPassWord" name="OldPassWord" type="password" id="OldPassWord"/></td></tr>';
        echo '  <tr>';
        echo '   <td>' . (NewPassWord) . ' &nbsp;
					<a href="javascript:void(0)" title="' . (ForcePasswordExample) . '>">
					<img border="0" alt="" style="cursor:help"  src="Programs/usercp/images/info.gif" width="15" height="15"/>
				</td>';
        echo '    <td><input maxlength="35" value="PassWord" class="text" id="PassWord" name="PassWord" type="password" id="password"/></td>';
        echo '  </tr>';
        echo '  <tr>';
        echo '    <td> ' . (RePassWord) . ' &nbsp; </td> ';
        echo '    <td><input maxlength="35"class="text"  value="RePassWord" id="RePassWord" name="RePassWord" type="password" /></td>';
        echo '  </tr><tr>';
        echo '    <td colspan="2">&nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" onclick="validatepass();return document.returnValue" value="' . (save) . '" /></td>';
        echo '</tr></table></form>';
    }//end if
}

//end function

function BirthDate($edtusr) {

    if (isset($_POST['submitedtusr'])) {

        $BirthDate_Month = PostFilter($_POST['BirthDate_Month']);
        $BirthDate_Year = PostFilter($_POST['BirthDate_Year']);
        $BirthDate_Day = PostFilter($_POST['BirthDate_Day']);

        $BirthDate = $BirthDate_Year . "-" . $BirthDate_Month . "-" . $BirthDate_Day;
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $BirthDate . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {

        global $BirthDate, $BirthDate_Month;
        $BirthDate_Month = date('m', strtotime($BirthDate));
        $BirthDate_Year = date('Y', strtotime($BirthDate));
        $BirthDate_Day = date('d', strtotime($BirthDate));

        echo '<form action="" method="post">';
        echo '<br/>' . (BirthDate);
        echo ' &nbsp; <select class="select" name="BirthDate_Year">';
        for ($i = date("Y") - 120; $i <= date("Y"); $i++) {
            if ($BirthDate_Year == $i) {
                echo '<option selected="selected">' . $i . '</option>';
            } else {
                echo '<option>' . $i . '</option>';
            }
        }//end for
        echo '</select>&nbsp;';
        echo '<select class="select" name="BirthDate_Month">';
        for ($i = 1; $i <= 12; $i++) {
            if ($BirthDate_Month == $i) {
                echo '<option selected="selected">' . $i . '</option>';
            } else {
                echo '<option>' . $i . '</option>';
            }
        }//end for
        echo '</select>';
        echo '<select class="select" name="BirthDate_Day">';
        for ($i = 1; $i <= 31; $i++) {
            if ($BirthDate_Day == $i) {
                echo '<option selected="selected">' . $i . '</option>';
            } else {
                echo '<option>' . $i . '</option>';
            }
        }//end for
        echo '</select>';
        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /></form>';
    }//end if
}

//end function

function PrefTime($edtusr) {
    if (isset($_POST['submitedtusr'])) {
        $PrefTime = PostFilter($_POST['PrefTime']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $PrefTime . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        echo '<br/><form action="" method="post">';
        echo ' &nbsp; ' . (PrefTime);
        echo ' &nbsp; <select class="select" name="PrefTime">';
        for ($i = 0; $i < 24; $i = $i + 2) {
            $j = $i + 2;
            $pt = $i . ":00-" . $j . ":00";
            if ($PrefTime == $pt) {
                echo '<option selected="selected" value="' . $i . ":00-" . $j . ':00">' . $i . ":00-" . $j . ":00";
            } else {
                echo '<option value="' . $i . ":00-" . $j . ':00">' . $i . ":00-" . $j . ":00";
            }
            echo "</option>";
        }
        echo '</select> &nbsp; ';
        echo '<input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" />';
    }//end if
}

//end function

function UpdateUserInfo($edtusr) {
    if (isset($_POST['submitedtusr'])) {
        $textedtusr = PostFilter($_POST['textedtusr']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $textedtusr . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {

        global $$edtusr;
        echo '<br/><form action="" method="post">';
        echo '	<table border="0" cellpadding="2" cellspacing="2">';
        echo '	  <tr>';
        echo '	    <td>' . (constant($edtusr)) . ' &nbsp; </td>';
        echo '	    <td><label>';
        echo '	      <input name="textedtusr" type="text" id="textfield" value="' . $$edtusr . '" maxlength="50" />';
        echo '	    </label> &nbsp; </td>';
        echo '	    <td><label>';
        echo '	      <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" />';
        echo '	    </label> &nbsp; </td>';
        echo '	  </tr>';
        echo '	</table>';
        echo '</form>';
    }//end if
}

//end function

function Gmt($edtusr) {
    if (isset($_POST['submitedtusr'])) {
        $Gmt = PostFilter($_POST['Gmt']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $Gmt . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'ginfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        echo '<br/><form action="" method="post">';
        echo ' &nbsp; ' . (Gmt);
        echo ' &nbsp; <select dir="ltr" class="select" name="Gmt">';
        if ($Gmt == "-12") {
            echo '<option selected="selected" value="-12"> GMT -12:00 | Eniwetok, Kwajalein</option>';
        } else {
            echo '<option value="-12"> GMT -12:00 | Eniwetok, Kwajalein</option>';
        }//end if
        if ($Gmt == "-11") {
            echo '<option selected="selected" value="-11"> GMT -11:00 | Midway Island,Samoa</option>';
        } else {
            echo '<option value="-11"> GMT -11:00 | Midway Island,Samoa</option>';
        }//end if

        if ($Gmt == "-10") {
            echo '<option selected="selected" value="-10"> GMT -10:00 | Hawaii</option>';
        } else {
            echo '<option value="-10"> GMT -10:00 | Hawaii</option>';
        }//end if

        if ($Gmt == "-9") {
            echo '<option selected="selected" value="-9">  GMT -09:00  | Alaska</option>';
        } else {
            echo '<option value="-9">  GMT -09:00  | Alaska</option>';
        }//end if

        if ($Gmt == "-8") {
            echo '<option selected="selected" value="-8">  GMT -08:00  | Pacific Time (US &amp; Canada)</option>';
        } else {
            echo '<option value="-8">  GMT -08:00  | Pacific Time (US &amp; Canada)</option>';
        }//end if

        if ($Gmt == "-7") {
            echo '<option selected="selected" value="-7">  GMT -07:00  | Mountain Time (US &amp; Canada)</option>';
        } else {
            echo '<option value="-7">  GMT -07:00  | Mountain Time (US &amp; Canada)</option>';
        }//end if

        if ($Gmt == "-6") {
            echo '<option selected="selected" value="-6">  GMT -06:00  | Central Time (US &amp; Canada), Mexico City</option>';
        } else {
            echo '<option value="-6">  GMT -06:00  | Central Time (US &amp; Canada), Mexico City</option>';
        }//end if

        if ($Gmt == "-5") {
            echo '<option selected="selected" value="-5">  GMT -05:00  | Eastern Time (US &amp; Canada), Bogota, Lima</option>';
        } else {
            echo '<option value="-5">  GMT -05:00  | Eastern Time (US &amp; Canada), Bogota, Lima</option>';
        }//end if
        if ($Gmt == "-4") {
            echo '<option selected="selected" value="-4">  GMT -04:00  | Atlantic Time (Canada), Caracas, La Paz</option>';
        } else {
            echo '<option value="-4">  GMT -04:00  | Atlantic Time (Canada), Caracas, La Paz</option>';
        }//end if
        if ($Gmt == "-3.5") {
            echo '<option selected="selected" value="-3.5">GMT -03:30  | Newfoundland</option>';
        } else {
            echo '<option value="-3.5">GMT -03:30  | Newfoundland</option>';
        }//end if
        if ($Gmt == "-3") {
            echo '<option selected="selected" value="-3">  GMT -03:00  | Brazil, Buenos Aires, Georgetown</option>';
        } else {
            echo '<option value="-3">  GMT -03:00  | Brazil, Buenos Aires, Georgetown</option>';
        }//end if

        if ($Gmt == "-2") {
            echo '<option selected="selected" value="-2">  GMT -02:00  | Mid-Atlantic</option>';
        } else {
            echo '<option value="-2">  GMT -02:00  | Mid-Atlantic</option>';
        }//end if
        if ($Gmt == "-1") {
            echo '<option selected="selected" value="-1">  GMT -01:00  | Azores, Cape Verde Islands</option>';
        } else {
            echo '<option value="-1">  GMT -01:00  | Azores, Cape Verde Islands</option>';
        }//end if

        if ($Gmt == "0") {
            echo '<option selected="selected" value="0">   GMT +00:00  | Western Europe Time, London, Lisbon</option>';
        } else {
            echo '<option value="0">   GMT +00:00  | Western Europe Time, London, Lisbon</option>';
        }//endif
        if ($Gmt == "1") {
            echo '<option selected="selected" value="1">   GMT +01:00  | Brussels, Copenhagen, Madrid, Paris</option>';
        } else {
            echo '<option value="1">   GMT +01:00  | Brussels, Copenhagen, Madrid, Paris</option>';
        }//end if
        if ($Gmt == "2") {
            echo '<option selected="selected" value="2">   GMT +02:00  | Kaliningrad, South Africa ,Beirut</option>';
        } else {
            echo '<option value="2">   GMT +02:00  | Kaliningrad, South Africa ,Beirut</option>';
        }//end if
        if ($Gmt == "3") {
            echo '<option selected="selected" value="3">   GMT +03:00  | Baghdad, Riyadh, Moscow, St. Petersburg</option>';
        } else {
            echo '<option value="3">   GMT +03:00  | Baghdad, Riyadh, Moscow, St. Petersburg</option>';
        }//end if

        if ($Gmt == "3.5") {
            echo '<option selected="selected" value="3.5"> GMT +03:30  | Tehran</option>';
        } else {
            echo '<option value="3.5"> GMT +03:30  | Tehran</option>';
        }//end if

        if ($Gmt == "4") {
            echo '<option selected="selected" value="4">   GMT +04:00  | Abu Dhabi, Muscat, Baku, Tbilisi</option>';
        } else {
            echo '<option value="4">   GMT +04:00  | Abu Dhabi, Muscat, Baku, Tbilisi</option>';
        }//end if

        if ($Gmt == "4.5") {
            echo '<option selected="selected" value="4.5"> GMT +04:30  | Kabul</option>';
        } else {
            echo '<option value="4.5"> GMT +04:30  | Kabul</option>';
        }//end if

        if ($Gmt == "5") {
            echo '<option selected="selected" value="5">   GMT +05:00  | Ekaterinburg, Islamabad, Karachi, Tashkent</option>';
        } else {
            echo '<option value="5">   GMT +05:00  | Ekaterinburg, Islamabad, Karachi, Tashkent</option>';
        }//end if

        if ($Gmt == "5.5") {
            echo '<option selected="selected" value="5.5"> GMT +05:30  | Bombay, Calcutta, Madras, New Delhi</option>';
        } else {
            echo '<option value="5.5"> GMT +05:30  | Bombay, Calcutta, Madras, New Delhi</option>';
        }
        if ($Gmt == "6") {
            echo '<option selected="selected" value="6">   GMT +06:00  | Almaty, Dhaka, Colombo</option>';
        } else {
            echo '<option value="6">   GMT +06:00  | Almaty, Dhaka, Colombo</option>';
        }//endif
        if ($Gmt == "7") {
            echo '<option selected="selected" value="7">   GMT +07:00  | Bangkok, Hanoi, Jakarta</option>';
        } else {
            echo '<option value="7">   GMT +07:00  | Bangkok, Hanoi, Jakarta</option>';
        }//end if
        if ($Gmt == "8") {
            echo '<option selected="selected" value="8">   GMT +08:00  | Beijing, Perth, Singapore, Hong Kong</option>';
        } else {
            echo '<option value="8">   GMT +08:00  | Beijing, Perth, Singapore, Hong Kong</option>';
        }//end if

        if ($Gmt == "9") {
            echo '<option selected="selected" value="9">   GMT +09:00  | Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>';
        } else {
            echo '<option value="9">   GMT +09:00  | Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>';
        }//end if
        if ($Gmt == "9.5") {
            echo '<option selected="selected" value="9.5"> GMT +09:30  | Adelaide, Darwin</option>';
        } else {
            echo '<option value="9.5"> GMT +09:30  | Adelaide, Darwin</option>';
        }//end if

        if ($Gmt == "10") {
            echo '<option selected="selected" value="10">  GMT +10:00 | Eastern Australia, Guam, Vladivostok</option>';
        } else {
            echo '<option value="10">  GMT +10:00 | Eastern Australia, Guam, Vladivostok</option>';
        }//end if

        if ($Gmt == "11") {
            echo '<option selected="selected" value="11">  GMT +11:00 | Magadan, Solomon Islands</option>';
        } else {
            echo '<option value="11">  GMT +11:00 | Magadan, Solomon Islands</option>';
        }//end if

        if ($Gmt == "12") {
            echo '<option selected="selected" value="12">  GMT +12:00 | Auckland, Wellington, Fiji, Kamchatka</option>';
        } else {
            echo '<option value="12">  GMT +12:00 | Auckland, Wellington, Fiji, Kamchatka</option>';
        }//end if
        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" /> &nbsp; ';
        echo '</select>';
    }
}

//end function

function TimeFormat() {
    echo "TimeFormat";
}

//end function

function PrefLang($edtusr) {
    global $PrefLang;
    if (isset($_POST['submitedtusr'])) {
        $PrefLang = PostFilter($_POST['PrefLang']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $PrefLang . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';

        $Recordset = mysqli_query($conn, $UpdateQuery);

        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'pinfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        echo '<br/><form action="" method="post">';
        echo ' &nbsp; ' . (PrefLang) . ' &nbsp; ';
        echo '<select class="select" name="PrefLang">';
        global $SqlType, $conn;

        $LngRws = mysqli_query($conn, "SELECT `LangName` FROM `languages`;");
        $NbrOfLang = mysqli_num_rows($LngRws);
        //echo "LngTotals ".$LngTotals;
        if ($NbrOfLang > 0) {
            for ($i = 0; $i < $NbrOfLang; $i++) {
                $Rows = mysqli_fetch_assoc($LngRws);
                $LangNames = $Rows['LangName'];
                if ($LangNames == $PrefLang) {
                    echo '<option selected="selected" value="' . $LangNames . '">' . $LangNames . '</option>';
                } else {
                    echo '<option value="' . $LangNames . '">' . $LangNames . '</option>';
                }//end if	
            }//end for
        }//end if

        echo ' &nbsp; <input type="submit" name="submitedtusr" id="submitedtusr" value="' . (save) . '" />';
        echo '</select>';
        echo '</form>';
    } //end if
}

//end function

function PrefThem($edtusr) {
    global $PrefThem;
    if (isset($_POST['submitedtusr'])) {
        $PrefThem = PostFilter($_POST['PrefThem']);
        global $UserId, $conn;
        $UpdateQuery = 'UPDATE `users` SET `' . $edtusr . '` = "' . $PrefThem . '" WHERE CONVERT( `users`.`UserId` USING utf8 ) = "' . $UserId . '" LIMIT 1 ;';
        $Recordset = mysqli_query($conn, $UpdateQuery);
        $Vars = array('Prog', 'cpc');
        $Vals = array('usercp', 'pinfo');
        $P = CreateLink('', $Vars, $Vals);
        header("Location: $P");
    } else {
        $db = new db();
        $ThemeDB = $db->get_results("SELECT * FROM `themes` where `Active`='1'; ");
        echo '<br/><form action="" method="post">';
        echo (PrefThem) . ' &nbsp; ';
        echo '<select class="select" name="PrefThem">';
        if (count($ThemeDB)) {
            foreach ($ThemeDB as $ThemeNameDB) {
                ECHO $ThemeNameDB->ThemeName;
                if ($PrefThem == $ThemeNameDB->ThemeName) {
                    echo'<option selected="selected" value="' . $ThemeNameDB->ThemeName . '">' . $ThemeNameDB->ThemeName . '</option>';
                } else {
                    echo'<option value="' . $ThemeNameDB->ThemeName . '">' . $ThemeNameDB->ThemeName . '</option>';
                }//end if
            }
        } else {
            echo'<option value=" "> </option>';
        }
        /*
          // BUG      !!! MUST BE FROM DATABASE NOT FROM FOLDER !
          $dir="Themes/";
          $d = dir($dir);
          echo '<br/><form action="" method="post">';
          echo  (PrefThem) .' &nbsp; ';
          echo '<select class="select" name="PrefThem">';
          while (false !== ($entry = $d->read())) {
          if($entry!='.' && $entry!='..') {
          $Allentry = $dir.'/'.$entry;
          if(is_dir($Allentry)) {
          if($PrefThem==$entry){
          echo'<option selected="selected" value="'.$entry.'">'.$entry.'</option>';
          }
          else{
          echo'<option value="'.$entry.'">'.$entry.'</option>';
          }//end if
          }
          }
          }
          $d->close();
         */
        echo '</select>&nbsp;';
        echo '<input type="submit" name="submitedtusr" id="submitedtusr" value="' . save . '" /></form>';
    } //end if
}

//end function

function ShowUserInfo() {
    global $TheNavBar;
    if (isset($_GET['cpc'])) {
        $cpc = InputFilter($_GET['cpc']);

        switch ($cpc) {
            case 'ginfo':
                include_once("Programs/usercp/generalinfo.php");
                $TheNavBar[] = array((generalInfo), CreateLink("", array("Prog", "cpc"), array("usercp", "ginfo")));
                break;
            case 'ainfo':
                include_once("Programs/usercp/address.php");
                $TheNavBar[] = array((addressInfo), CreateLink("", array("Prog", "cpc"), array("usercp", "ainfo")));
                break;
            case 'pinfo':
                include_once("Programs/usercp/preference.php");
                $TheNavBar[] = array((preferenceInfo), CreateLink("", array("Prog", "cpc"), array("usercp", "pinfo")));
                break;
            case 'adsp':
                adsInvite();
                break;
            default:
                include_once("Programs/usercp/generalinfo.php");
                $TheNavBar[] = array((generalInfo), CreateLink("", array("Prog", "cpc"), array("usercp", "ginfo")));
        }// end if
    } else {
        include_once("Programs/usercp/generalinfo.php");
        $TheNavBar[] = array((generalInfo), CreateLink("", array("Prog", "cpc"), array("usercp", "ginfo")));
    }//end if
}

//end function
?>


