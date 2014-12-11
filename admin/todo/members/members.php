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

if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

global $TheNavBar, $ThemeName;
$theList = SubIconLink("members", "NewUser") . "<br/>"
        . SubIconLink("members", "DeleteUser") . "<br/>"
        . SubIconLink("members", "BanUser") . "<br/>"
        . SubIconLink("members", "SearchUser") . "<br/>"
        . SubIconLink("members", "ResetPassword") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "ResetPassword":
            $theContent = ResetPassword();
            $TheNavBar[] = array((ResetPassword), adminCreateLink("", array("todo", "subdo"), array("members", "ResetPassword")));
            break;
        case "NewUser":
            $theContent = NewUser();
            $TheNavBar[] = array((NewUser), adminCreateLink("", array("todo", "subdo"), array("members", "NewUser")));
            break;
        case "DeleteUser":
            $theContent = DeleteUser();
            $TheNavBar[] = array((DeleteUser), adminCreateLink("", array("todo", "subdo"), array("members", "DeleteUser")));
            break;
        case "BanUser":
            $theContent = BanUser();
            $TheNavBar[] = array((BanUser), adminCreateLink("", array("todo", "subdo"), array("members", "BanUser")));
            break;
        case "SearchUser":
            $theContent = SearchUser();
            $TheNavBar[] = array((SearchUser), adminCreateLink("", array("todo", "subdo"), array("members", "SearchUser")));
            break;
        case "UserInfo":
            $theContent = UserInfo();
            $TheNavBar[] = array((UserInfo), adminCreateLink("", array("todo", "subdo"), array("members", "UserInfo")));
            break;
        case "EditUser":
            $theContent = EditUser();
            $TheNavBar[] = array(EditUser, adminCreateLink("", array("todo", "subdo"), array("members", "EditUser")));
            break;
        default :
    }//end switch
} else {
    $theContent = SearchUser();
    $TheNavBar[] = array((SearchUser), adminCreateLink("", array("todo", "subdo"), array("members", "SearchUser")));
}//end if		


$members = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$members = VarTheme("{todoImg}", "users.png", $members);
$members = VarTheme("{ThemeName}", $ThemeName, $members);
$members = VarTheme("{List}", $theList, $members);
$members = VarTheme("{Content}", $theContent, $members);

function EditUser() {

    if (isset($_GET['NickName'])) {
        $EditNickName = InputFilter($_GET['NickName']);
        $query = "SELECT * FROM `users` WHERE `NickName` like '%" . $EditNickName . "%' ;";
        $dbEditUser = new db();
        $EditUser = $dbEditUser->get_row($query);
        if ($EditUser) {
            if (!isset($_POST['saveedituser'])) {
                $UserId = $EditUser->UserId;
                $UserName = $EditUser->UserName;
                $ParentName = $EditUser->ParentName;
                $FamName = $EditUser->FamName;
                $UserMail = $EditUser->UserMail;
                $Contry = $EditUser->Contry;
                $FamName = $EditUser->FamName;

                $EditUserThem = get_include_contents("admin/todo/members/EditUserForm.php");
                $EditUserThem = VarTheme("{UserName}", UserName, $EditUserThem);
                $EditUserThem = VarTheme("{NickName}", NickName, $EditUserThem);
                $EditUserThem = VarTheme("{Email}", Email, $EditUserThem);
                $EditUserThem = VarTheme("{PassWord}", PassWord, $EditUserThem);
                $EditUserThem = VarTheme("{RePassWord}", RePassWord, $EditUserThem);
                $EditUserThem = VarTheme("Avalueisrequired", Avalueisrequired, $EditUserThem);
                $EditUserThem = VarTheme("Invalidformat", Invalidformat, $EditUserThem);
                $EditUserThem = VarTheme("{FamName}", FamName, $EditUserThem);
                $EditUserThem = VarTheme("{save}", save, $EditUserThem);
                $EditUserThem = VarTheme("{UserNameValue}", $UserName, $EditUserThem);
                $EditUserThem = VarTheme("{NickNameValue}", $EditNickName, $EditUserThem);
                $EditUserThem = VarTheme("{UserMailValue}", $UserMail, $EditUserThem);
                $EditUserThem = VarTheme("{PassWordValue}", '', $EditUserThem);
                $EditUserThem = VarTheme("{RePassWordValue}", '', $EditUserThem);
                $EditUserThem = VarTheme("{FamNameValue}", $FamName, $EditUserThem);
                $EditUserThem = VarTheme("{UserId}", $UserId, $EditUserThem);
                return $EditUserThem;
            } else {
                $UserName = PostFilter($_POST['UserName']);
                $FamName = PostFilter($_POST['FamName']);
                $NickName = PostFilter($_POST['NickName']);
                $UserMail = PostFilter($_POST['UserMail']);
                $PassWord = PostFilter($_POST['PassWord']);
                $RePassWord = PostFilter($_POST['RePassWord']);
                $UserId = PostFilter($_POST['UserId']);

                if ($PassWord == '' or $RePassWord != $PassWord) {
                    $PassQuery = ' ';
                } else {
                    $PassQuery = " ,`PassWord`='" . md5($PassWord) . "' ";
                }

                $query_update = "update `users` set `UserName`='" . $UserName . "', `FamName`='" . $FamName . "' , `NickName`='" . $NickName . "',
                        `UserMail`='" . $UserMail . "' " . $PassQuery . " where `UserId`='" . $UserId . "' ; ";
                $dbSaveinfo = new db();

                $query_nick = " select `NickName` from `users` where `UserId`<>'" . $UserId . "' and `NickName`='" . $NickName . "' ;";
                $query_nick = $dbSaveinfo->get_var($query_nick);
                if ($query_nick) {
                    return NickName_already_exist;
                } else {
                    $dbSaveinfo->query($query_update);
                }

                return SuccessSaveUserInfo;
            }
        } else {
            return ThisNickNameNotExist;
        }
    } else {
        return ThisNickNameNotExist;
    }
}

function ResetPassword() {
    $ResetPassword = '';
    if (isset($_POST['savenewpass'])) {
        $NickName = PostFilter($_POST['NickName']);
        $PassWord = PostFilter($_POST['PassWord']);
        $RePassWord = PostFilter($_POST['RePassWord']);
        if ($PassWord == $RePassWord) {
            $db = new db();
            $users = $db->get_results("SELECT * FROM `users` WHERE `NickName` = '" . $NickName . "' ;");
            if (count($users)) {
                //reset the password
                $NewPassWord = MD5($PassWord);
                $db->query("update `users` set `PassWord`='" . $NewPassWord . "' where `NickName`='" . $NickName . "';");
                $ResetPassword = (SuccessResetPassword);
            } else {
                //user does not exist
                $ResetPassword = (ThisNickNameNotExist);
            }//endif
        } else {
            $ResetPassword = 'Pass not equal re passs';
        }
    } else {
        $ResetPassword .= get_include_contents("admin/todo/members/ResetPassword.php");
        $ResetPassword = VarTheme("{NickName}", (NickName), $ResetPassword);
        $ResetPassword = VarTheme("{ResetPassword}", (ResetPassword), $ResetPassword);
        $ResetPassword = VarTheme("{PassWord}", (PassWord), $ResetPassword);
        $ResetPassword = VarTheme("{RePassWord}", (RePassWord), $ResetPassword);
        $ResetPassword = VarTheme("{delete}", (BanUser), $ResetPassword);
        $ResetPassword = VarTheme("{save}", (save), $ResetPassword);
        $ResetPassword = VarTheme("Avalueisrequired", (Avalueisrequired), $ResetPassword);
    }//end if
    return $ResetPassword;
}

//end function

function SearchUser() {

    global $TotalRecords, $Rows, $conn, $Recordset, $TheNavBar;
    $UsersMaxNbr = 50;
    $db = new db();

    if (isset($_POST['SearchUser'])) {
        $NickName = PostFilter($_POST['qry']);
    } elseif (isset($_GET['qry'])) {
        $NickName = (InputFilter($_GET['qry']));
    } else {
        $NickName = '';
    }

    $ob = 'UserId'; // order by
    $ad = 'desc'; // asc desc 
    $ad_inv = 'asc';

    if (isset($_GET['ad'])) {
        if ($_GET['ad'] == 'asc') {
            $ad = 'asc';
            $ad_inv = 'desc';
        }
    }

    if (isset($_GET['ob'])) {
        $ob = InputFilter($_GET['ob']);
        if (!in_array($ob, array("NickName", "UserName", "RegDate", "UserMail", "Contry", "Points"))) {
            $ob = "RegDate";
        }
    }

    if (isset($_POST['SearchUser']) or isset($_GET['qry'])) {
        $TheNavBar[] = array($NickName, adminCreateLink("", array("todo", "subdo", "qry"), array("members", "SearchUser", $NickName)));

        $results_page_count_to_navigate_betweenu = 12;
        $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
        $start = ($page - 1) * $UsersMaxNbr;

        $NickName_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "NickName", $ad_inv, $page));
        $UserName_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "UserName", $ad_inv, $page));
        $RegDate_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "RegDate", $ad_inv, $page));
        $Email_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "UserMail", $ad_inv, $page));
        $contrie_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "Contry", $ad_inv, $page));
        $Points_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "Points", $ad_inv, $page));

        $UsersTotalRecords = $db->get_var("SELECT count(*) FROM `users` WHERE `NickName` like '%" . $NickName . "%'  "
                . "and `Deleted`<>'1' ; ");

        ExcuteQuery("SELECT * FROM `users` WHERE `NickName` like '%" . $NickName . "%' and `Deleted`<>'1' "
                . " order by `UserId` desc limit $start,$UsersMaxNbr ;");

        if ($TotalRecords > 0) {
            $Result = '<table width="100%" border="0" cellspacing="2" cellpadding="2">';
            $Result .='<tr >
                     <td  class="td_title"><strong><a href ="' . $NickName_link . '" >' . NickName . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $UserName_link . '" >' . UserName . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $RegDate_link . '" >' . RegDate . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $Points_link . '" >' . points . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $Email_link . '" >' . Email . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $contrie_link . '" >' . contrie . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $NickName_link . '" >' . edit . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $NickName_link . '" >' . delete . '</a></strong></td>
                    </tr>';
            for ($i = 0; $i < $TotalRecords; $i++) {
                $UserId = $Rows['UserId'];
                $UserName = $Rows['UserName'];
                $RegDate = $Rows['RegDate'];
                $ParentName = $Rows['ParentName'];
                $FamName = $Rows['FamName'];
                $Contry = '<img src="images/flags/' . strtolower($Rows['Contry']) . '.png" width="18" height="12" alt="' . $Rows['Contry'] . '" />';
                $UserMail = $Rows['UserMail'];
                $Points = $Rows['Points'];

                $resNickName = $Rows['NickName'];
                $EditUser = '<a href="' . AdminCreateLink('', array('todo', 'subdo', 'NickName'), array('members', 'EditUser', $resNickName)) . '" title="' . EditUser . '"> ' . edit . '</a>';
                $DeleteUser = '<a onclick="return acceptDel();" href="' . AdminCreateLink('', array('todo', 'subdo', 'NickName'), array('members', 'DeleteUser', $resNickName)) . '" title="' . DeleteUser . '" >' . delete . '</a>';
                $user_profile_link = CreateLink("",array("Prog","ns","user"),array("cybernews","awrites",$resNickName));
                $Result .='<tr  class="row_tr">
				<td class="td_data"><a href="'.$user_profile_link.'" >' . $resNickName . '</a></td>
				<td class="td_data">' . $UserName . ' ' . $ParentName . ' ' . $FamName . '</td>
                                <td class="td_data">' . $RegDate . '</td>
                                <td class="td_data">' . $Points . '</td>
				<td class="td_data">' . $UserMail . '</td>
				<td class="td_data">' . $Contry . '</td>
				<td class="td_data">' . $EditUser . '</td>
				<td class="td_data">' . $DeleteUser . '</td>
			</tr>';

                $Rows = mysqli_fetch_assoc($Recordset);
            }

            $Result.='</table>
                            <script language="javascript" type="text/javascript">
                                function acceptDel(){
                                        return confirm("' . DoYouWantDeleteThisUser . '");
                                }
                                  $(".row_tr:even").addClass("row_tr_odd");
                                    $(".row_tr:odd").addClass("row_tr_even");

                            </script>';

            $Result.= paginate_results($UsersMaxNbr, $results_page_count_to_navigate_betweenu, $UsersTotalRecords, $page, 
                    array('todo', 'subdo', 'ob', 'ad', 'qry'), array('members', 'SearchUser', $ob, $ad, $NickName),true);
            return $Result;
        } else {
            $Vars = array('todo', 'subdo', 'page', "qry");
            $Vals = array('members', 'SearchUser', '1', $NickName);
            $SearchUser = (ThisNickNameNotExist) . '<br/>';
            $SearchUser .= get_include_contents("admin/todo/members/searchUserForm.php");
            $SearchUser = VarTheme("{qry}", (NickName), $SearchUser);
            $SearchUser = VarTheme("{NickName}", (NickName), $SearchUser);
            $SearchUser = VarTheme("{search}", (search), $SearchUser);
            $SearchUser = VarTheme("{action}", AdminCreateLink("", $Vars, $Vals), $SearchUser);
            return $SearchUser;
        }//end if
    } else {
        $Vars = array('todo', 'subdo', 'page', 'qry');
        $Vals = array('members', 'SearchUser', '1', $NickName);
        $SearchUser = get_include_contents("admin/todo/members/searchUserForm.php");
        $SearchUser = VarTheme("{qry}", (NickName), $SearchUser);
        $SearchUser = VarTheme("{NickName}", (NickName), $SearchUser);
        $SearchUser = VarTheme("{search}", (search), $SearchUser);
        $SearchUser = VarTheme("{action}", AdminCreateLink("", $Vars, $Vals), $SearchUser);

        // chow all users 

        $results_page_count_to_navigate_betweenu = 12;
        $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
        $start = ($page - 1) * $UsersMaxNbr;


        $UsersTotalRecords = $db->get_var("SELECT count(*) FROM `users` WHERE  `Deleted`<>'1' ; ");

        $q = ("SELECT * FROM `users` where `Deleted`<>'1'  "
                . " order by `" . $ob . "` " . $ad . " limit $start,$UsersMaxNbr ; ");

        $users_list = $db->get_results($q);

        $NickName_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "NickName", $ad_inv, $page));
        $UserName_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "UserName", $ad_inv, $page));
        $RegDate_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "RegDate", $ad_inv, $page));
        $Email_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "UserMail", $ad_inv, $page));
        $contrie_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "Contry", $ad_inv, $page));
        $Points_link = AdminCreateLink("", array("todo", "ob", "ad", "page"), array("members", "Points", $ad_inv, $page));



        $Result = '<table width="100%" border="0" cellspacing="2" cellpadding="2">';
        $Result .='<tr>'
                . '<td  class="td_title"><strong><a href ="' . $NickName_link . '" >' . NickName . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $UserName_link . '" >' . UserName . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $RegDate_link . '" >' . RegDate . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $Points_link . '" >' . points . '</a></strong></td>
                        <td class="td_title"><strong><a href ="' . $Email_link . '" >' . Email . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $contrie_link . '" >' . contrie . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $NickName_link . '" >' . edit . '</a></strong></td>
			<td class="td_title"><strong><a href ="' . $NickName_link . '" >' . delete . '</a></strong></td>
                    </tr>';

        if ($users_list) {

            foreach ($users_list as $user_info) {
                $UserId = $user_info->UserId;
                $UserName = $user_info->UserName;
                $RegDate = $user_info->RegDate;
                $ParentName = $user_info->ParentName;
                $FamName = $user_info->FamName;
                $Contry = '<img src="images/flags/' . strtolower($user_info->Contry) . '.png" width="18" height="12" alt="' . $user_info->Contry . '" />';
                $UserMail = $user_info->UserMail;
                $Points = $user_info->Points;
                $resNickName = $user_info->NickName;
                $EditUser = '<a href="' . AdminCreateLink('', array('todo', 'subdo', 'NickName'), array('members', 'EditUser', $resNickName)) . '" title="' . EditUser . '"> ' . edit . '</a>';
                $DeleteUser = '<a onclick="return acceptDel();" href="' . AdminCreateLink('', array('todo', 'subdo', 'NickName'), array('members', 'DeleteUser', $resNickName)) . '" title="' . DeleteUser . '" >' . delete . '</a>';
                $Result .= '<tr  class="row_tr" >
                    		<td class="td_data"><a href="Prog-account_acnt-profile_user-'.$resNickName.'_Lang-Arabic_nl-1.pt" >' . $resNickName . '</a></td>
				<td class="td_data">' . $UserName . ' ' . $ParentName . ' ' . $FamName . '</td>
                                <td class="td_data">' . $RegDate . '</td>
                                <td class="td_data">' . $Points . '</td>
				<td class="td_data">' . $UserMail . '</td>
				<td class="td_data">' . $Contry . '</td>
				<td class="td_data">' . $EditUser . '</td>
				<td class="td_data">' . $DeleteUser . '</td>
			</tr>';
            }
        }

        $Result.='</table>
                            <script language="javascript" type="text/javascript">
                                function acceptDel(){
                                        return confirm("' . DoYouWantDeleteThisUser . '");
                                }
                                  $(".row_tr:even").addClass("row_tr_odd");
                                $(".row_tr:odd").addClass("row_tr_even");

                            </script>';
        $Result.= paginate_results($UsersMaxNbr, $results_page_count_to_navigate_betweenu, $UsersTotalRecords, $page, array('todo', 'subdo', 'ob', 'ad'), array('members', 'SearchUser', $ob, $ad), true);

        return $SearchUser . $Result;
    }//end if
}

//end function

function BanUser() {
    global $TotalRecords, $Rows, $conn, $SqlType;
    if (isset($_POST['DELETEuser'])) {
        $NickName = PostFilter($_POST['NickName']);
        ExcuteQuery("SELECT * FROM `users` WHERE `NickName`='" . $NickName . "';");
        if ($TotalRecords == 1) {
            $UserId = $Rows['UserId'];
            $NickName = $Rows['NickName'];
            $UserMail = $Rows['UserMail'];

            // ban this user
            $query = "INSERT INTO `blacklist` ( `BlackWord` , `BlockReason` , `BlockDate` )
				VALUES ('" . $NickName . "', '" . (Blockeduser) . "', '" . date("Y-m-d H:i:s") . "'), 
					   ('" . $UserMail . "', '" . (Blockeduser) . "', '" . date("Y-m-d H:i:s") . "');";
            $Recordset = mysqli_query($conn, $Query);
            // set this user banned
            $query = "update `users` set `Banned`='1' where `UserId`='" . $UserId . "'";
            mysqli_query($conn, $Query);
            return $NickName . ' ' . andBlocked;
        } else {
            $delUser = (ThisNickNameNotExist) . '<br/>';
            $delUser .= get_include_contents("admin/todo/members/deleteUserForm.php");
            $delUser = VarTheme("{NickName}", (NickName), $delUser);
            $delUser = VarTheme("{delete}", (BanUser), $delUser);
            return $delUser;
        }//end if
    } else {
        $delUser = get_include_contents("admin/todo/members/deleteUserForm.php");
        $delUser = VarTheme("{NickName}", (NickName), $delUser);
        $delUser = VarTheme("{delete}", (BanUser), $delUser);
        return $delUser;
    }//end if
}

//end function

function DeleteUser() {
    global $TotalRecords, $Rows, $conn;
    if (isset($_POST['NickName']) or isset($_GET['NickName'])) {
        if (isset($_POST['NickName'])) {
            $NickName = PostFilter($_POST['NickName']);
        } else {
            $NickName = InputFilter($_GET['NickName']);
        }
        ExcuteQuery("SELECT `UserId` FROM `users` WHERE `NickName`='" . $NickName . "';");
        if ($TotalRecords == 1) {
            $UserId = $Rows['UserId'];
            /*
             * we dont delete Guest or adam
             */
            $AdamDb = new db();
            $AdamID = $AdamDb->get_var('SELECT `AdminId` FROM `admins` WHERE `IsAdam` =1 ; ');

            if ($NickName == 'Guest' or $UserId == $AdamID) {
                return YouCanotDelete . ' ' . $NickName;
            } else {
                $query = "update`users` set `Deleted`='1' where `UserId`='" . $UserId . "'";
                $Recordset = mysqli_query($conn, $query);
                return $NickName . ' ' . (HasBeenDeletedsuccufully);
            }
        } else {
            $delUser = (ThisNickNameNotExist) . '<br/>';
            $delUser .= get_include_contents("admin/todo/members/deleteUserForm.php");
            $delUser = VarTheme("{NickName}", (NickName), $delUser);
            $delUser = VarTheme("{delete}", (delete), $delUser);
            return $delUser;
        }//end if
    } else {
        $delUser = get_include_contents("admin/todo/members/deleteUserForm.php");
        $delUser = VarTheme("{NickName}", (NickName), $delUser);
        $delUser = VarTheme("{delete}", (delete), $delUser);
        return $delUser;
    }//end if
}

//end function

function NewUser() {
    global $conn, $ThemeName, $Lang;

    if (isset($_POST['savenewuser'])) {
        $UserId = GenerateID("users", "UserId");
        $GroupId = "20070000001";
        $UserName = PostFilter($_POST['UserName']);
        $FamName = PostFilter($_POST['FamName']);
        $NickName = PostFilter($_POST['NickName']);
        $UserMail = PostFilter($_POST['UserMail']);
        $PassWord = PostFilter($_POST['PassWord']);
        $PrefThem = $ThemeName;
        $RegDate = date('Y-m-d H:i:s');
        $TimeFormat = "Y-m-d H:i:s";
        $MemberSQLDB = new db();
        $MemberSQL = $MemberSQLDB->get_row(" SELECT * FROM `users` WHERE `NickName`='" . $NickName . "' OR `UserMail`='" . $UserMail . "' ; ");
        if ($MemberSQL) {
            return NickNameOrEmailAlreadyTaken;
        } else {
            $dbTheme = new db();

            $DefaultThem = $dbTheme->get_var("select `DefaultThem` from `params`  ; ");
            $query = "INSERT INTO `users` 
                                ( `UserId` , `GroupId` , `TimeFormat` , `UserName` , `NickName` , `ParentName` , `FamName` , `BirthDate` , `Sex` , `Gmt` , `Contry` , `town` , `Rue` , `AddDetails` , `CodePostal` , `ZipCode` , `PhoneNbr` , `CellNbr` , `PassWord` , `LastLogin` , `LastIP` , `Hobies` , `Job` , `Education` , `PrefLang` , `PrefTime` , `CookieLife` , `UserPic` , `UserMail` , `UserSite` , `Banned` , `PrefThem` , `UserSign` , `Points` , `Active` , `RegDate` , `allowHtml` , `allowBBcode` , `allowSmiles` , `allowAvatar` , `ConfirmCode` )
			VALUES ('" . $UserId . "', '" . $GroupId . "', '" . $TimeFormat . "', '" . $UserName . "', '" . $NickName . "', ' ', '" . $FamName . "', '0000-00-00', '1', '0', 'LB', ' ', ' ', ' ', ' ', ' ', ' ', '', '" . md5($PassWord) . "','', '127.0.0.1', ' ', ' ', ' ', '" . $Lang . "', '0:00-0:00', '8640', '', '" . $UserMail . "', ' ', '0', '" . $DefaultThem . "', ' ', '0', '1', '" . $RegDate . "', '0', '0', '1', '1', '1');";
            $Recordset = mysqli_query($conn, $query);
            return (WeHaveSucsessReister) . ' <strong> ' . $UserName . ' ' . $FamName . ' </strong> ' . (HeCanLoginInNickName) . ' <strong> ' . $NickName . ' </strong> ' . (Now);
        }
    } else {
        $NewUser = get_include_contents("admin/todo/members/newUserForm.php");
        $NewUser = VarTheme("{UserName}", (UserName), $NewUser);
        $NewUser = VarTheme("{NickName}", (NickName), $NewUser);
        $NewUser = VarTheme("{Email}", (Email), $NewUser);
        $NewUser = VarTheme("{PassWord}", (PassWord), $NewUser);
        $NewUser = VarTheme("{RePassWord}", (RePassWord), $NewUser);
        $NewUser = VarTheme("Avalueisrequired", (Avalueisrequired), $NewUser);
        $NewUser = VarTheme("Invalidformat", (Invalidformat), $NewUser);
        $NewUser = VarTheme("{FamName}", (FamName), $NewUser);
        $NewUser = VarTheme("{save}", (save), $NewUser);
        return $NewUser;
    }//end if
}

//END FUNTION
?>