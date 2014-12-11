<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 00-00-05-02-2011.
 * 	Last Modified: 00-00-05-02-2011.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * 	Author:	 mhndm.
 *
 * ********************************************* */
?>
<?php if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php

global $MainPermissionsArray, $TheNavBar, $ThemeName;

$MainPermissionsArray = array(
    array('core', 'todo', 'members'),
    array('core', 'subdo', 'NewUser'),
    array('core', 'subdo', 'DeleteUser'),
    array('core', 'subdo', 'SearchUser'),
    array('core', 'subdo', 'ResetPassword'),
    array('core', 'subdo', 'BanUser'),
    array('core', 'todo', 'Groups'),
    array('core', 'subdo', 'NewGroup'),
    array('core', 'subdo', 'DeleteGroup'),
    array('core', 'subdo', 'SwitchGroup'),
    array('core', 'subdo', 'UsersGroup'),
    array('core', 'subdo', 'ChangeUserGroup'),
    array('core', 'subdo', 'EditGroup'),
    array('core', 'todo', 'Admins'),
    array('core', 'subdo', 'listAdmins'),
    array('core', 'subdo', 'adminPerm'),
    array('core', 'subdo', 'adminDelete'),
    array('core', 'subdo', 'adminNew'),
    array('core', 'todo', 'Maillist'),
    array('core', 'todo', 'Letters'),
    array('core', 'subdo', 'Newletter'),
    array('core', 'subdo', 'Listletter'),
    array('core', 'subdo', 'deletel'),
    array('core', 'subdo', 'editl'),
    array('core', 'todo', 'blockscontrol'),
    array('core', 'todo', 'programscontrol'),
    array('core', 'todo', 'programspermisions'),
    array('core', 'todo', 'blockspermisions'),
    array('core', 'todo', 'specialpermision'),
    array('core', 'todo', 'blocking'),
    array('core', 'todo', 'firewall'), //  New
    array('core', 'todo', 'antiflood'),
    array('core', 'todo', 'faildlogin'),
    array('core', 'todo', 'contieslangs'),
    array('core', 'todo', 'options'),
    array('core', 'todo', 'webfolder'),
    array('core', 'todo', 'themes'),
    array('core', 'todo', 'languages'),
    array('core', 'todo', 'cache'),
    array('core', 'todo', 'SEO'),
    array('core', 'todo', 'robotsadmin'),
    array('core', 'todo', 'installer'), //New
    array('core', 'todo', 'newprograms'),
    array('core', 'todo', 'newblock'),
    array('core', 'todo', 'NewTheme'),
    array('core', 'todo', 'Addons'), //New
    array('core', 'todo', 'Update'), //New
    array('core', 'subdo', 'delTheme'),
    array('core', 'todo', 'bugsandreport'),
    array('core', 'todo', 'Error'),
    array('core', 'todo', 'database'), //New

    array('core', 'subdo', 'backup'),
    array('core', 'subdo', 'restore'),
    array('core', 'subdo', 'optimize'),
    array('core', 'todo', 'newsbar'),
    array('core', 'subdo', 'AddNews'),
    array('core', 'subdo', 'editnews'),
    array('core', 'subdo', 'delnews'),
    array('core', 'todo', 'layersmenu'),
    array('core', 'subdo', 'delteMenu'),
    array('core', 'subdo', 'RootMenu'),
    array('core', 'subdo', 'AllElemnts'),
    array('core', 'subdo', 'AddMenu'),
    array('core', 'subdo', 'AddElemnts'),
    array('core', 'subdo', 'editMenu'),
    array('core', 'subdo', 'ChildsOfMenu'),
    array('core', 'subdo', 'SubMenu'),
    array('core', 'todo', 'mainmenu'),
    array('core', 'subdo', 'DeleteElement'),
    array('core', 'subdo', 'BrowseMenu'),
    array('core', 'subdo', 'AddElement'),
    array('core', 'subdo', 'EditElement'),
    array('core', 'todo', 'Translations'),
    array('core', 'todo', 'recycle'),
    array('core', 'subdo', 'NewTrans'),
    array('core', 'subdo', 'LisTrans'),
    array('core', 'subdo', 'EditTrans'),
    array('core', 'todo', 'plugins'),
    array('core', 'todo', 'appsstore'),
    array('core', 'todo', 'sendmodule')
);

$theList = SubIconLink("admins", "listAdmins") . "<br/>"
        . SubIconLink("admins", "adminNew") . "<br/>";

if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "listAdmins":
            $theContent = listAdmins();
            $TheNavBar[] = array(listAdmins, adminCreateLink("", array("todo", "subdo"), array("admins", "listAdmins")));
            break;
        case "adminPerm":
            $theContent = adminPerm();
            $TheNavBar[] = array(listAdmins, adminCreateLink("", array("todo", "subdo"), array("admins", "listAdmins")));
            break;
        case "adminDelete":
            $theContent = adminDelete();
            $TheNavBar[] = array(listAdmins, adminCreateLink("", array("todo", "subdo"), array("admins", "adminDelete")));
            break;
        case "adminNew":
            $theContent = adminNew();
            $TheNavBar[] = array(listAdmins, adminCreateLink("", array("todo", "subdo"), array("admins", "adminNew")));
            break;

        default :
            $theContent = listAdmins();
            $TheNavBar[] = array(listAdmins, adminCreateLink("", array("todo", "subdo"), array("admins", "listAdmins")));
    }//end switch
} else {
    $theContent = listAdmins();
    $TheNavBar[] = array(listAdmins, adminCreateLink("", array("todo", "subdo"), array("admins", "listAdmins")));
}//end if

$Permission = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$Permission = VarTheme("{todoImg}", "admins.png", $Permission);
$Permission = VarTheme("{ThemeName}", $ThemeName, $Permission);
$Permission = VarTheme("{List}", $theList, $Permission);
$Permission = VarTheme("Users", Admins, $Permission);
$Permission = VarTheme("{Content}", $theContent, $Permission);

function adminNew() {
    if (isset($_POST['adminNew'])) {
        $adminNickName = PostFilter($_POST['adminNewName']);
        $DBadminNewName = new db();
        $query = " select * from `users` where `NickName`='" . $adminNickName . "';";
        $adminNewName = $DBadminNewName->get_row($query);
        
        if ($adminNewName) {
            //is this user admin?
            $query = " select * from `admins` where `AdminId`='" . $adminNewName->UserId . "';";
            $adminAlready = $DBadminNewName->get_row($query);
            if ($adminAlready) {
                $adminNew = ThisUserIsAdmin;
            } else {
                //add new admin
                $adminNewNameUserId = $adminNewName->UserId;
                $query = "INSERT INTO `admins` (`AdminId` , `AdminMail` , `LastLogin` , `LastIp` , `Note` , `AdminSign` , `BackupFolder` ,  `Stopped` ,`IsAdam`)
                         VALUES ('" . $adminNewName->UserId . "', '" . $adminNewName->UserMail . "', '', '', '', '', '', '', '0' );";
                $adminNewName = $DBadminNewName->query($query);
                $query = "UPDATE `users` SET `GroupId` = '200700000-1' WHERE `UserId` = '" . $adminNewNameUserId . "'; ";
                $adminNewName = $DBadminNewName->query($query);
                $adminNew = SuccessAddNewAdmin;
            }
        } else {
            $adminNew = UserNickNameNotExist;
        }
    } else {
        $adminNew = '<form id="formNewAdmin" name="formNewAdmin" method="post" action="">
                  ' . NickName . ' :
                  <input name="adminNewName" type="text" id="adminNewName" size="20" maxlength="20" />
                  <input class="submit" type="submit" name="adminNew" id="adminNew" value="' . CreateNewAdmin . '" />
                </form>';
    }
    return $adminNew;
}

function adminDelete() {
    if (isset($_GET['AdminId'])) {
        $AdminId = InputFilter($_GET['AdminId']);
        $DBadminDelete = new db();

        $query = "select * from `admins` where `AdminId`='" . $AdminId . "' and `IsAdam`=0 ; ";
        $adminDelete = $DBadminDelete->query($query);

        if ($adminDelete) {
            //delete permissions
            $query = "delete from `adminperm` where `AdminID`='" . $AdminId . "' ; ";
            $adminDelete = $DBadminDelete->query($query);
            //delete Admin
            $query = "delete from `admins` where `AdminId`='" . $AdminId . "' ; ";
            $adminDelete = $DBadminDelete->query($query);
            return SuccessDeleteAdminAndPermissions;
        } else {
            return ThisAdminNotExistOrHeIsAdam;
        }
    } else {
        return ThereIsNoCurrentDeltedAdmin;
    }
}

function adminPerm() {
    global $AdminId, $MainPermissionsArray;
    if (isset($_GET['AdminId'])) {
        $dbAdminID = new db();
        $Admin = $dbAdminID->get_row("select * from `admins` where `AdminId`='" . InputFilter($_GET['AdminId']) . "';");
        $AdminIDperm = $Admin->AdminId;
        $adminPerm = '';
        if ($AdminIDperm) {
            if (!isset($_POST['SaveAdminPermissions'])) {
                $AdminsDB = new db();
                $AdminsUsers = $AdminsDB->get_row('select * from `admins` as a inner join users as b where a.AdminId = b.UserId and a.AdminId ="' . $AdminIDperm . '"   ;');
                $AdminsUsers->AdminId;

                if ($AdminsUsers->Stopped == '0000-00-00 00:00:00') {
                    $Stopped = ' ';
                } else {
                    $Stopped = ' checked="checked" ';
                }

                if ($AdminsUsers->IsAdam) {
                    $IsAdam = ' checked="checked" ';
                    $Stopped = ' disabled="disabled" ';
                } else {
                    $IsAdam = '';
                }

                $adminPerm = AccessPermissionForAdmin . ' ' .
                        '<strong>' . $AdminsUsers->NickName . '</strong> ( ' .
                        $AdminsUsers->UserName . ' ' .
                        $AdminsUsers->ParentName . ' ' .
                        $AdminsUsers->FamName . ' )' .
                        '<form method="post" name="Permissions"><br/>
                                     <a href="javascript:void(0);" onclick="javascript:checkAll();" >' . SelectAll . '</a>
                                     |
                                    <a href="javascript:void(0);" onclick="javascript:uncheckAll();" >' . SelectNone . '</a>
                                    <br/><br/>';
                $dbAdminID = new db();
                $CurrentAdmin = $dbAdminID->get_row("select `IsAdam` from `admins` where `AdminId`='" . $AdminId . "';");
                $CurrentAdminIDperm = $CurrentAdmin->IsAdam;


                //if current logged admin is ADAM
                if ($CurrentAdminIDperm) {
                    $adminPerm .= '<input onclick="IsAdamChek();" name="IsAdam" ' . $IsAdam . ' value="IsAdam" type="checkbox">' . IsAdam;
                } else {
                    $adminPerm .= '<input onclick="IsAdamChek();" disabled="disabled" ' . $IsAdam . ' name="IsAdam" value="IsAdam" type="checkbox">' . IsAdam;
                    $Stopped .= '  disabled="disabled" ';
                }

                $adminPerm .= '&nbsp;&nbsp;<input onclick="StoppedChek();" name="Stopped" ' . $Stopped . ' value="Stopped" type="checkbox">' . StoppedAdmin . '&nbsp;&nbsp;';

                $adminPerm .= PermisionsList($AdminsUsers->AdminId);
            } else {
                SaveAdminPerms();
                $redirectTO = AdminCreateLink('', array('todo', 'subdo'), array('admins', 'listAdmins'));
                $adminPerm .= adminPrintMessageAndRedirect(AccessPermissionForAdmin, AdminPermissiosSaved, $redirectTO);
            }
        } else {
            $adminPerm = '';
        }
    } else {
        $adminPerm = '';
    }

    return $adminPerm;
}

function listAdmins() {

    global $ThemeName;

    $listAdminsDB = new db();
    $listAdminsUsers = $listAdminsDB->get_results('select * from `admins` as a inner join users as b where a.AdminId = b.UserId;   ;');
    $Rows = ceil(count($listAdminsUsers) / 5);

//var_dump($listAdminsUsers);
    $i = 0;
    foreach ($listAdminsUsers as $AdminsUsers) {

        $Admin[$i]['AdminId'] = $AdminsUsers->AdminId;
        $Admin[$i]['UserPic'] = $AdminsUsers->UserPic;
        $Admin[$i]['NickName'] = $AdminsUsers->NickName;
        $Admin[$i]['UserName'] = $AdminsUsers->UserName;
        $Admin[$i]['ParentName'] = $AdminsUsers->ParentName;
        $Admin[$i]['FamName'] = $AdminsUsers->FamName;
        $Admin[$i]['IsAdam'] = $AdminsUsers->IsAdam;
        $Admin[$i]['Stopped'] = $AdminsUsers->Stopped;
        $i++;
    }
//var_dump($Admin);
    $listAdmins = '<table style="width: 100%;" border="0" cellpadding="10" cellspacing="2">';
    $k = 0;
    $l = $i;
    for ($i = 0; $i < $Rows; $i++) {
        $listAdmins .= '<tr>';
        for ($j = 0; $j < 5 and $l > 0; $j++) {
            // $AdminsUsers = $listAdminsUsers[][];
            $l -=1;
            if ($Admin[$k]['UserPic'] == '') {
                $Admin[$k]['UserPic'] = 'images/avatars/noavatar.gif';
            }

            if ($Admin[$k]['IsAdam']) {
                $IsAdam = '<img border="0" src="admin/Themes/' . $ThemeName . '/images/security-high.png" title="' . IsAdam . '" alt="' . IsAdam . '" />&nbsp;';
            } else {
                $IsAdam = '';
            }

            if ($Admin[$k]['Stopped'] == '0000-00-00 00:00:00') {
                $Stopped = RuningAdmin;
            } else {
                $Stopped = AdminStoppedAt . ' : <br/> ' . $Admin[$k]['Stopped'];
            }

            $AdminDeleteLink = adminCreateLink("", array("todo", "subdo", "AdminId"), array("admins", "adminDelete", $Admin[$k]['AdminId']));
            $AdminLink = adminCreateLink("", array("todo", "subdo", "AdminId"), array("admins", "adminPerm", $Admin[$k]['AdminId']));
            $listAdmins .= '<td style="text-align: center; vertical-align: top;">
                            <a href="' . $AdminLink . '" > ' .
                    '<img border="0" src="' . $Admin[$k]['UserPic'] . '"/><br/> ' . $IsAdam
                    . $Admin[$k]['NickName'] . '</a><br/>
                                <a onclick="return acceptDelAdmin();" href="' . $AdminDeleteLink . '" alt="' . DeleteAdmin . ' ' . $Admin[$k]['NickName'] . '" title="' . DeleteAdmin . ' ' . $Admin[$k]['NickName'] . '">
                                <img src="admin/Themes/' . $ThemeName . '/images/delete-admin.png" width="16" height="16" border=0 /></a>&nbsp;&nbsp;'
                    . $Admin[$k]['UserName'] . ' '
                    . $Admin[$k]['ParentName'] . ' '
                    . $Admin[$k]['FamName'] . '<br/>' . $Stopped . '
                            </td>';
            $k++;
        }
        $listAdmins .= '</tr>';
    }
    $listAdmins .= '</table>
                    <script language="javascript" type="text/javascript">
					function acceptDelAdmin(){
						return confirm("' . AreYoushureWantDeleteAdmin . '");
					}
                    </script>';

    return $listAdmins;
}

function SaveAdminPerms() {
    global $MainPermissionsArray, $xmlstr;

    //set only this admin as adam
    if (isset($_GET['AdminId'])) {
        $AdminId = InputFilter($_GET['AdminId']);
    } else {
        $AdminId = '';
    }
    if (isset($_POST['Stopped'])) {
        $Stopped = date('Y-m-d H:i:s');
    } else {
        $Stopped = '0000-00-00 00:00:00';
    }
    if (isset($_POST['IsAdam'])) {
        $IsAdam = 1;
        //UPDATE Admin table set all users no and only this yes
        $SaveAdminAdamDB = new db();
        $SaveAdminAdam = $SaveAdminAdamDB->query("UPDATE `admins` SET `IsAdam` = '0' ; ");
        $SaveAdminAdam = $SaveAdminAdamDB->query("UPDATE `admins` SET `IsAdam` = '1', Stopped='' WHERE `admins`.`AdminId` = '" . $AdminId . "'; ");
    } else {
        // IsAdam chekbox disabled or not cheked, In this case we weel get info from database
        $AdminsDB = new db();
        $AdminsUsers = $AdminsDB->query("UPDATE `admins` SET  Stopped='" . $Stopped . "' WHERE `admins`.`AdminId` = '" . $AdminId . "'; ");
        $AdminsUsers = $AdminsDB->get_row('select * from `admins` where `AdminId` ="' . $AdminId . '"   ;');
        if ($AdminsUsers->IsAdam) {
            $IsAdam = 1;
        } else {
            $IsAdam = 0;
        }
    }
    // core control panel permissions
    $SaveAdminPermsDB = new db();

    //DELETE all this Admin perms
    $SaveAdminPerms = $SaveAdminPermsDB->query("delete from `adminperm` where `AdminID`='" . $AdminId . "'; ");
    //MAIN Permissions
    foreach ($MainPermissionsArray as $MainPermissions) {

        // Adam must havee alaws full permissins
        if ($IsAdam) {
            $Perm = 1;
        } else {
            if (isset($_POST[$MainPermissions[2]])) {
                $Perm = 1;
            } else {
                $Perm = 0;
            }
        }
        $SaveAdminPerms = $SaveAdminPermsDB->query("INSERT INTO `adminperm` 
                            (`AdminID` ,`constName` ,`varName` ,`varValue` ,`perm`)
                             VALUES ('" . $AdminId . "', '" . $MainPermissions[0] . "', '" . $MainPermissions[1] . "', '" . $MainPermissions[2] . "', '" . $Perm . "');");
    }

    //programs permissions
    $dbProgramsList = new db();
    $ProgramsList = $dbProgramsList->get_results("SELECT * FROM `programs` where `ProgramName`!='account' ; ");
    foreach ($ProgramsList as $Program) {
        if ($IsAdam) {
            $ParentPerm = 1;
        } else {
            if (isset($_POST['prog-' . $Program->ProgramName])) {
                $ParentPerm = 1;
            } else {
                $ParentPerm = 0;
            }
        }
        $SaveAdminPerms = $SaveAdminPermsDB->query("INSERT INTO `adminperm`
                        (`AdminID` ,`constName` ,`varName` ,`varValue` ,`perm`)
                         VALUES ('" . $AdminId . "', 'prog', 'todo', '$Program->ProgramName', '" . $ParentPerm . "');");

        if (is_file('Programs/' . $Program->ProgramName . '/admin/desc.php')) {
            include 'Programs/' . $Program->ProgramName . '/admin/desc.php';
            $xml = new SimpleXMLElement($xmlstr);
            foreach ($xml->Permissions as $XmlPerm) {
                if ($IsAdam) {
                    $ChildPerm = 1;
                } else {
                    if (isset($_POST['prog-' . $XmlPerm])) {
                        $ChildPerm = 1;
                    } else {
                        $ChildPerm = 0;
                    }
                }
                $SaveAdminPerms = $SaveAdminPermsDB->query("INSERT INTO `adminperm`
                        (`AdminID` ,`constName` ,`varName` ,`varValue` ,`perm`)
                         VALUES ('" . $AdminId . "', 'prog', 'subdo', '" . $XmlPerm . "', '" . $ChildPerm . "');");
            }
        }
    }

    //Blocks permissions
    $dbBlocksList = new db();
    $BlocksList = $dbBlocksList->get_results("SELECT * FROM `blocks` where `BlockName`!='Account' ; ");
    foreach ($BlocksList as $Block) {
        if ($IsAdam) {
            $ParentPerm = 1;
        } else {
            if (isset($_POST['blok-' . $Block->BlockName])) {
                $ParentPerm = 1;
            } else {
                $ParentPerm = 0;
            }
        }
        $SaveAdminPerms = $SaveAdminPermsDB->query("INSERT INTO `adminperm`
                        (`AdminID` ,`constName` ,`varName` ,`varValue` ,`perm`)
                         VALUES ('" . $AdminId . "', 'blok', 'todo', '$Block->BlockName', '" . $ParentPerm . "');");

        if (is_file('Blocks/' . $Block->BlockName . '/admin/desc.php')) {
            include 'Blocks/' . $Block->BlockName . '/admin/desc.php';
            $xml = new SimpleXMLElement($xmlstr);
            foreach ($xml->Permissions as $XmlPerm) {
                if ($IsAdam) {
                    $ChildPerm = 1;
                } else {
                    if (isset($_POST['blok-' . $XmlPerm])) {
                        $ChildPerm = 1;
                    } else {
                        $ChildPerm = 0;
                    }
                }
                $SaveAdminPerms = $SaveAdminPermsDB->query("INSERT INTO `adminperm`
                        (`AdminID` ,`constName` ,`varName` ,`varValue` ,`perm`)
                         VALUES ('" . $AdminId . "', 'blok', 'subdo', '" . $XmlPerm . "', '" . $ChildPerm . "');");
            }
        }
    }
}

function PermisionsList($AdminID) {
    global $Lang, $MainPermissionsArray, $xmlstr;
    //constName,varName,varValue

    $dbAdminPerm = new db();
    foreach ($MainPermissionsArray as $MainPermissions) {

        $AdminPerm = $dbAdminPerm->get_row("SELECT *  FROM `adminperm` where `AdminID`='" . $AdminID . "'
                                            and `constName`='core' and `varName`='" . $MainPermissions[1] . "' and `varValue`='" . $MainPermissions[2] . "' ;");
        if ($AdminPerm) {
            if ($AdminPerm->perm) {
                $$MainPermissions[2] = ' checked="checked" '; // Look $$
                //echo $MainPermissions[0];
            } else {
                $$MainPermissions[2] = ' '; // Look $$
            }
        } else {
            $$MainPermissions[2] = ' '; // Look $$
        }
    }

    $PermisionsList = ' ';
    $PermisionsList = get_include_contents("admin/todo/admins/permForm.php");
    $PermisionsList = VarTheme("{PeopleConst}", People, $PermisionsList);
    $PermisionsList = VarTheme("{members}", $members, $PermisionsList);
    $PermisionsList = VarTheme("{MembersConst}", Members, $PermisionsList);
    $PermisionsList = VarTheme("{NewUser}", $NewUser, $PermisionsList);
    $PermisionsList = VarTheme("{NewUserConst}", NewUser, $PermisionsList);
    $PermisionsList = VarTheme("{DeleteUser}", $DeleteUser, $PermisionsList);
    $PermisionsList = VarTheme("{DeleteUserConst}", DeleteUser, $PermisionsList);
    $PermisionsList = VarTheme("{SearchUser}", $SearchUser, $PermisionsList);
    $PermisionsList = VarTheme("{SearchUserConst}", SearchUser, $PermisionsList);
    $PermisionsList = VarTheme("{ResetPassword}", $ResetPassword, $PermisionsList);
    $PermisionsList = VarTheme("{ResetPasswordConst}", ResetPassword, $PermisionsList);
    $PermisionsList = VarTheme("{BanUser}", $BanUser, $PermisionsList);
    $PermisionsList = VarTheme("{BanUserConst}", BanUser, $PermisionsList);
    $PermisionsList = VarTheme("{Groups}", $Groups, $PermisionsList);
    $PermisionsList = VarTheme("{GroupsConst}", Groups, $PermisionsList);
    $PermisionsList = VarTheme("{NewGroup}", $NewGroup, $PermisionsList);
    $PermisionsList = VarTheme("{NewGroupConst}", NewGroup, $PermisionsList);
    $PermisionsList = VarTheme("{DeleteGroup}", $DeleteGroup, $PermisionsList);
    $PermisionsList = VarTheme("{DeleteGroupConst}", DeleteGroup, $PermisionsList);
    $PermisionsList = VarTheme("{SwitchGroup}", $SwitchGroup, $PermisionsList);
    $PermisionsList = VarTheme("{SwitchGroupConst}", SwitchGroup, $PermisionsList);
    $PermisionsList = VarTheme("{UsersGroup}", $UsersGroup, $PermisionsList);
    $PermisionsList = VarTheme("{UsersGroupConst}", UsersGroup, $PermisionsList);
    $PermisionsList = VarTheme("{ChangeUserGroup}", $ChangeUserGroup, $PermisionsList);
    $PermisionsList = VarTheme("{ChangeUserGroupConst}", ChangeUserGroup, $PermisionsList);
    $PermisionsList = VarTheme("{EditGroup}", $EditGroup, $PermisionsList);
    $PermisionsList = VarTheme("{EditGroupConst}", EditGroup, $PermisionsList);
    $PermisionsList = VarTheme("{Admins}", $Admins, $PermisionsList);
    $PermisionsList = VarTheme("{AdminsConst}", Admins, $PermisionsList);
    $PermisionsList = VarTheme("{listAdmins}", $listAdmins, $PermisionsList);
    $PermisionsList = VarTheme("{listAdminsConst}", listAdmins, $PermisionsList);
    $PermisionsList = VarTheme("{adminPerm}", $adminPerm, $PermisionsList);
    $PermisionsList = VarTheme("{adminPermConst}", adminPerm, $PermisionsList);
    $PermisionsList = VarTheme("{adminDeleteConst}", DeleteAdmin, $PermisionsList);
    $PermisionsList = VarTheme("{adminDelete}", $adminDelete, $PermisionsList);
    $PermisionsList = VarTheme("{adminNewConst}", adminNew, $PermisionsList);
    $PermisionsList = VarTheme("{adminNew}", $adminNew, $PermisionsList);
    $PermisionsList = VarTheme("{Maillist}", $Maillist, $PermisionsList);
    $PermisionsList = VarTheme("{MaillistConst}", MailList, $PermisionsList);
    $PermisionsList = VarTheme("{Letters}", $Letters, $PermisionsList);
    $PermisionsList = VarTheme("{LettersConst}", Letters, $PermisionsList);
    $PermisionsList = VarTheme("{Newletter}", $Newletter, $PermisionsList);
    $PermisionsList = VarTheme("{NewletterConst}", Newletter, $PermisionsList);
    $PermisionsList = VarTheme("{Listletter}", $Listletter, $PermisionsList);
    $PermisionsList = VarTheme("{ListletterConst}", Listletter, $PermisionsList);
    $PermisionsList = VarTheme("{deletel}", $deletel, $PermisionsList);
    $PermisionsList = VarTheme("{deletelConst}", deleteLetter, $PermisionsList);
    $PermisionsList = VarTheme("{editl}", $editl, $PermisionsList);
    $PermisionsList = VarTheme("{editlConst}", editLetter, $PermisionsList);
    //$PermisionsList = VarTheme("{SaveAdminPermissions}", $SaveAdminPermissions,$PermisionsList );
    $PermisionsList = VarTheme("{SaveAdminPermissionsConst}", SaveAdminPermissions, $PermisionsList);
    $PermisionsList = VarTheme("{ProgramsControlConst}", ProgramsControlConst, $PermisionsList);
    $PermisionsList = VarTheme("{ControlConst}", ControlConst, $PermisionsList);
    $PermisionsList = VarTheme("{BlockControl}", BlockControl, $PermisionsList);
    $PermisionsList = VarTheme("{ProgramsControl}", ProgramsControl, $PermisionsList);
    $PermisionsList = VarTheme("{ProgramsPermissions}", ProgramsPermissions, $PermisionsList);
    $PermisionsList = VarTheme("{BlockPermissions}", BlockPermissions, $PermisionsList);
    $PermisionsList = VarTheme("{SpecialPermission}", SpecialPermission, $PermisionsList);
    $PermisionsList = VarTheme("{Firewall}", Firewall, $PermisionsList);
    $PermisionsList = VarTheme("{Logintries}", Logintries, $PermisionsList);
    $PermisionsList = VarTheme("{Countrieslanguages}", Countrieslanguages, $PermisionsList);
    $PermisionsList = VarTheme("{Antiflood}", Antiflood, $PermisionsList);
    $PermisionsList = VarTheme("{Blocking}", Blocking, $PermisionsList);
    $PermisionsList = VarTheme("{BlockingChek}", $blocking, $PermisionsList);
    $PermisionsList = VarTheme("{ManagmentConst}", ManagmentConst, $PermisionsList);
    $PermisionsList = VarTheme("{Options}", Options, $PermisionsList);
    $PermisionsList = VarTheme("{WebFolder}", WebFolder, $PermisionsList);
    $PermisionsList = VarTheme("{Themes}", Themes, $PermisionsList);
    $PermisionsList = VarTheme("{Languages}", Languages, $PermisionsList);
    $PermisionsList = VarTheme("{Robotadministrator}", Robotadministrator, $PermisionsList);
    $PermisionsList = VarTheme("{Upload}", Upload, $PermisionsList);
    $PermisionsList = VarTheme("{CacheSystem}", CacheSystem, $PermisionsList);
    $PermisionsList = VarTheme("{SearchEngineOptimization}", SearchEngineOptimization, $PermisionsList);
    $PermisionsList = VarTheme("{Installer}", Installer, $PermisionsList);
    $PermisionsList = VarTheme("{Bugsandreport}", Bugsandreport, $PermisionsList);
    $PermisionsList = VarTheme("{ErrorPages}", ErrorPages, $PermisionsList);
    $PermisionsList = VarTheme("{database}", database, $PermisionsList);
    $PermisionsList = VarTheme("{NewProgram}", NewProgram, $PermisionsList);
    $PermisionsList = VarTheme("{NewBlock}", NewBlock, $PermisionsList);
    $PermisionsList = VarTheme("{NewThem}", NewThem, $PermisionsList);
    $PermisionsList = VarTheme("{Addons}", Addons, $PermisionsList);
    $PermisionsList = VarTheme("{Update}", Update, $PermisionsList);
    $PermisionsList = VarTheme("{Backup}", Backup, $PermisionsList);
    $PermisionsList = VarTheme("{Restore}", Restore, $PermisionsList);
    $PermisionsList = VarTheme("{Optimize}", Optimize, $PermisionsList);
    $PermisionsList = VarTheme("{SupportConst}", SupportConst, $PermisionsList);
    $PermisionsList = VarTheme("{DataConst}", DataConst, $PermisionsList);
    $PermisionsList = VarTheme("{Newsbar}", Newsbar, $PermisionsList);
    $PermisionsList = VarTheme("{Menulayers}", Menulayers, $PermisionsList);
    $PermisionsList = VarTheme("{Mainmenu}", Mainmenu, $PermisionsList);
    $PermisionsList = VarTheme("{Translations}", Translations, $PermisionsList);
    $PermisionsList = VarTheme("{Recyclebin}", Recyclebin, $PermisionsList);
    $PermisionsList = VarTheme("{RecyclebinChek}", $recycle, $PermisionsList);
    $PermisionsList = VarTheme("{BlocksControlConst}", BlocksControlConst, $PermisionsList);
    $PermisionsList = VarTheme("{BlockControlChek}", $blockscontrol, $PermisionsList);
    $PermisionsList = VarTheme("{ProgramsControlChek}", $programscontrol, $PermisionsList);
    $PermisionsList = VarTheme("{ProgramsPermissionsChek}", $programspermisions, $PermisionsList);
    $PermisionsList = VarTheme("{BlockPermissionsChek}", $blockspermisions, $PermisionsList);
    $PermisionsList = VarTheme("{FirewallChek}", $firewall, $PermisionsList);
    $PermisionsList = VarTheme("{LogintriesChek}", $faildlogin, $PermisionsList);
    $PermisionsList = VarTheme("{OptionsChek}", $options, $PermisionsList);
    $PermisionsList = VarTheme("{WebFolderChek}", $webfolder, $PermisionsList);
    $PermisionsList = VarTheme("{ThemesChek}", $themes, $PermisionsList);
    $PermisionsList = VarTheme("{LanguagesChek}", $languages, $PermisionsList);
    $PermisionsList = VarTheme("{CountrieslanguagesChek}", $contieslangs, $PermisionsList);
    $PermisionsList = VarTheme("{CacheSystemChek}", $cache, $PermisionsList);
    $PermisionsList = VarTheme("{SearchEngineOptimizationChek}", $SEO, $PermisionsList);
    $PermisionsList = VarTheme("{RobotadministratorChek}", $robotsadmin, $PermisionsList);
    $PermisionsList = VarTheme("{SpecialPermissionChek}", $specialpermision, $PermisionsList);
    $PermisionsList = VarTheme("{AntifloodChek}", $antiflood, $PermisionsList);
    $PermisionsList = VarTheme("{InstallerChek}", $installer, $PermisionsList);
    $PermisionsList = VarTheme("{NewProgramChek}", $newprograms, $PermisionsList);
    $PermisionsList = VarTheme("{NewBlockChek}", $newblock, $PermisionsList);
    $PermisionsList = VarTheme("{NewThemChek}", $NewTheme, $PermisionsList);
    $PermisionsList = VarTheme("{AddonsChek}", $Addons, $PermisionsList);
    $PermisionsList = VarTheme("{UpdateChek}", $Update, $PermisionsList);
    $PermisionsList = VarTheme("{delThemeChek}", $delTheme, $PermisionsList);
    $PermisionsList = VarTheme("{delTheme}", delTheme, $PermisionsList);
    $PermisionsList = VarTheme("{BugsandreportChek}", $bugsandreport, $PermisionsList);
    $PermisionsList = VarTheme("{ErrorPagesChek}", $Error, $PermisionsList);
    $PermisionsList = VarTheme("{databaseChek}", $database, $PermisionsList);
    $PermisionsList = VarTheme("{BackupChek}", $backup, $PermisionsList);
    $PermisionsList = VarTheme("{RestoreChek}", $restore, $PermisionsList);
    $PermisionsList = VarTheme("{OptimizeChek}", $optimize, $PermisionsList);
    $PermisionsList = VarTheme("{NewsbarChek}", $newsbar, $PermisionsList);
    $PermisionsList = VarTheme("{AddNewsChek}", $AddNews, $PermisionsList);
    $PermisionsList = VarTheme("{AddNews}", AddNews, $PermisionsList);
    $PermisionsList = VarTheme("{editnews}", editnews, $PermisionsList);
    $PermisionsList = VarTheme("{editnewsChek}", $editnews, $PermisionsList);
    $PermisionsList = VarTheme("{delnews}", delnews, $PermisionsList);
    $PermisionsList = VarTheme("{delnewsChek}", $delnews, $PermisionsList);
    $PermisionsList = VarTheme("{MenulayersChek}", $layersmenu, $PermisionsList);
    $PermisionsList = VarTheme("{delteMenu}", delteMenu, $PermisionsList);
    $PermisionsList = VarTheme("{delteMenuChek}", $delteMenu, $PermisionsList);
    $PermisionsList = VarTheme("{RootMenu}", RootMenu, $PermisionsList);
    $PermisionsList = VarTheme("{RootMenuChek}", $RootMenu, $PermisionsList);
    $PermisionsList = VarTheme("{SubMenu}", SubMenu, $PermisionsList);
    $PermisionsList = VarTheme("{SubMenuChek}", $SubMenu, $PermisionsList);
    $PermisionsList = VarTheme("{AllElemnts}", AllElemnts, $PermisionsList);
    $PermisionsList = VarTheme("{AllElemntsChek}", $AllElemnts, $PermisionsList);
    $PermisionsList = VarTheme("{AddMenu}", AddMenu, $PermisionsList);
    $PermisionsList = VarTheme("{AddMenuChek}", $AddMenu, $PermisionsList);
    $PermisionsList = VarTheme("{AddElemnts}", AddElemnts, $PermisionsList);
    $PermisionsList = VarTheme("{AddElemntsChek}", $AddElemnts, $PermisionsList);
    $PermisionsList = VarTheme("{editMenu}", editMenu, $PermisionsList);
    $PermisionsList = VarTheme("{editMenuChek}", $editMenu, $PermisionsList);
    $PermisionsList = VarTheme("{ChildsOfMenu}", ChildsOfMenu, $PermisionsList);
    $PermisionsList = VarTheme("{ChildsOfMenuChek}", $ChildsOfMenu, $PermisionsList);
    $PermisionsList = VarTheme("{mainmenuChek}", $mainmenu, $PermisionsList);
    $PermisionsList = VarTheme("{DeleteElementChek}", $DeleteElement, $PermisionsList);
    $PermisionsList = VarTheme("{BrowseMenuChek}", $BrowseMenu, $PermisionsList);
    $PermisionsList = VarTheme("{AddElementChek}", $AddElement, $PermisionsList);
    $PermisionsList = VarTheme("{EditElementChek}", $EditElement, $PermisionsList);
    $PermisionsList = VarTheme("{DeleteElement}", DeleteElement, $PermisionsList);
    $PermisionsList = VarTheme("{BrowseMenu}", BrowseMenu, $PermisionsList);
    $PermisionsList = VarTheme("{AddElement}", AddElement, $PermisionsList);
    $PermisionsList = VarTheme("{EditElement}", EditElement, $PermisionsList);
    //$PermisionsList = VarTheme("{RecyclebinChek}", $RecyclebinChek,$PermisionsList );
    $PermisionsList = VarTheme("{TranslationsChek}", $Translations, $PermisionsList);
    $PermisionsList = VarTheme("{NewTrans}", NewTrans, $PermisionsList);
    $PermisionsList = VarTheme("{LisTrans}", LisTrans, $PermisionsList);
    $PermisionsList = VarTheme("{EditTrans}", EditTrans, $PermisionsList);
    $PermisionsList = VarTheme("{EditTransChek}", $EditTrans, $PermisionsList);
    $PermisionsList = VarTheme("{NewTransChek}", $NewTrans, $PermisionsList);
    $PermisionsList = VarTheme("{LisTransChek}", $LisTrans, $PermisionsList);
    $PermisionsList = VarTheme("{SwitchGroupChek}", $EditTrans, $PermisionsList);
    $PermisionsList = VarTheme("{sendmoduleChek}", $sendmodule, $PermisionsList);
    $PermisionsList = VarTheme("{pluginsChek}", $plugins, $PermisionsList);
    $PermisionsList = VarTheme("{appsstoreChek}", $appsstore, $PermisionsList);
    $PermisionsList = VarTheme("{sendmodule}", SendYouModule, $PermisionsList);
    $PermisionsList = VarTheme("{plugins}", Plugins, $PermisionsList);
    $PermisionsList = VarTheme("{appsstore}", AppsStore, $PermisionsList);

    //Programs {ProgramsControlTr}
    //get list of programs from database
    $ProgramsControlTr = '<tr>';
    $dbProgramsList = new db();
    $ProgramsList = $dbProgramsList->get_results("SELECT * FROM `programs` where `ProgramName`!='account' ; ");

    $i = 0;

    foreach ($ProgramsList as $Program) {
        //include lang file
        $LangFile = 'Programs/' . $Program->ProgramName . '/admin/Languages/lang-' . $Lang . '.php';

        if (is_file($LangFile)) {
            include_once($LangFile);
        }

        // Get permission for this prog
        $dbProgAdminPerm = new db();
        $ProgAdminPerm = $dbProgAdminPerm->get_row("SELECT *  FROM `adminperm`
                                                        where `AdminID`='" . $AdminID . "'
                                                        and `constName`='prog'
                                                        and `varValue`='" . $Program->ProgramName . "'
                                                        and `varName` = 'todo' ;");
        if (!constantDefined($Program->ProgramName)) {
            $ProgramNameConst = $Program->ProgramName;
        } else {
            $ProgramNameConst = constant($Program->ProgramName);
        }

        if ($ProgAdminPerm) {//this program was previosly added to the database
            if ($ProgAdminPerm->perm) { //this admin has permission
                $Parent = '<td style="vertical-align: top;">
                            <input checked="checked"  name="prog-' . $Program->ProgramName . '"
                            value="prog-' . $Program->ProgramName . '" type="checkbox">&nbsp;' . $ProgramNameConst . '<br>';
            } else {
                $Parent = '<td style="vertical-align: top;">
                            <input name="prog-' . $Program->ProgramName . '" value="prog-' . $Program->ProgramName . '"
                                type="checkbox">&nbsp;' . $ProgramNameConst . '<br>';
            }
            //load xml sub permissions names from xml file
            //echo 'Programs/'.$Program->ProgramName.'/admin/desc.php <br/>';
            $xmlstr = '';
            if (is_file('Programs/' . $Program->ProgramName . '/admin/desc.php')) {
                include 'Programs/' . $Program->ProgramName . '/admin/desc.php';

                $xml = new SimpleXMLElement($xmlstr);
                $Childs = '';
                foreach ($xml->Permissions as $XmlPerm) {
                    //var_dump($XmlPerm);
                    if (!constantDefined($XmlPerm)) {
                        $XmlPermConst = $XmlPerm;
                    } else {
                        $XmlPermConst = constant($XmlPerm);
                    }

                    $dbProgChildAdminPerm = new db();
                    $ProgChildAdminPerm = $dbProgChildAdminPerm->get_row("SELECT *  FROM `adminperm`
                                                                        where `AdminID`='" . $AdminID . "'
                                                                        and `constName`='prog'
                                                                        and `varValue`='" . $XmlPerm . "'
                                                                        and `varName` = 'subdo' ;");

                    if ($ProgChildAdminPerm) {//this child have permission in the database
                        if ($ProgChildAdminPerm->perm) {
                            $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input checked="checked"  
                                     name="prog-' . $XmlPerm . '" value="prog-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                            //echo constant($XmlPerm).'<BR/>';
                        } else {//DON HAVE PERM
                            $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input name="prog-' . $XmlPerm . '"
                                            value="prog-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                        }
                    } else {//this child have permission  in the database
                        $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input name="prog-' . $XmlPerm . '"
                                        value="prog-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                    }
                }
            } else {//this prog dont have childs permissions
                $Childs = '';
            }
        } else {//this is new program
            if (!constantDefined($Program->ProgramName)) {
                $ProgramProgramName = $Program->ProgramName;
            } else {
                $ProgramProgramName = constant($Program->ProgramName);
            }
            $Parent = '<td style="vertical-align: top;">
                            <input name="prog-' . $Program->ProgramName . '" value="prog-' . $Program->ProgramName . '"
                                type="checkbox">&nbsp;' . $ProgramProgramName . '<br>';

            //load xml sub permissions names from xml file
            if (is_file('Programs/' . $Program->ProgramName . '/admin/desc.php')) {
                include 'Programs/' . $Program->ProgramName . '/admin/desc.php';
                $Childs = '';
                $xml = new SimpleXMLElement($xmlstr);
                foreach ($xml->Permissions as $XmlPerm) {
                    //var_dump($XmlPerm);
                    if (!constantDefined($XmlPerm)) {
                        $XmlPermConst = $XmlPerm;
                    } else {
                        $XmlPermConst= constant($XmlPerm);
                    }
                    $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input  name="prog-' . $XmlPerm . '"
                                    value="prog-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                }
            } else {//this prog dont have childs permissions
                $Childs = '';
            }
        }

        if ($i % 5) {
            $ProgramsControlTr .= $Parent . $Childs . '</td>';
        } else {
            $ProgramsControlTr .= '</tr><tr>' . $Parent . $Childs . '</td>';
        }
        $i++;
        $Childs = '';
    }
    $ProgramsControlTr .='</tr>';
    $PermisionsList = VarTheme("{ProgramsControlTr}", $ProgramsControlTr, $PermisionsList);

    //Blocks {BlocksControlTr}
    //get list of Blocks from database
    $BlocksControlTr = '<tr>';
    $dbBlocksList = new db();
    $BlocksList = $dbBlocksList->get_results("SELECT * FROM `blocks` where `BlockName`!='Account' ; ");

    $i = 0;

    foreach ($BlocksList as $Block) {
        //include lang file
        $LangFile = 'Blocks/' . $Block->BlockName . '/admin/Languages/lang-' . $Lang . '.php';
        if (is_file($LangFile)) {
            include_once($LangFile);
        }

        // Get permission for this block
        $dbBlockAdminPerm = new db();
        $BlockAdminPerm = $dbBlockAdminPerm->get_row("SELECT *  FROM `adminperm`
                                                        where `AdminID`='" . $AdminID . "'
                                                        and `constName`='blok'
                                                        and `varValue`='" . $Block->BlockName . "'
                                                        and `varName` = 'todo' ;");
        if (!constantDefined($Block->BlockName)) {
            $BlockNameConst = $Block->BlockName;
        } else {
            $BlockNameConst = constant($Block->BlockName);
        }
        if ($BlockAdminPerm) {//this program was previosly added to the database
            if ($BlockAdminPerm->perm) { //this admin has permission
                $Parent = '<td style="vertical-align: top;">
                            <input checked="checked"  name="blok-' . $Block->BlockName . '"
                            value="blok-' . $Block->BlockName . '" type="checkbox">&nbsp;' . $BlockNameConst . '<br>';
            } else {
                $Parent = '<td style="vertical-align: top;">
                            <input name="blok-' . $Block->BlockName . '" value="blok-' . $Block->BlockName . '"
                                type="checkbox">&nbsp;' . $BlockNameConst . '<br>';
            }
            //load xml sub permissions names from xml file
            if (is_file('Blocks/' . $Block->BlockName . '/admin/desc.php')) {
                include 'Blocks/' . $Block->BlockName . '/admin/desc.php';
                $xml = new SimpleXMLElement($xmlstr);

                foreach ($xml->Permissions as $XmlPerm) {
                    //var_dump($XmlPerm);
                    $dbBlockChildAdminPerm = new db();
                    $BlockChildAdminPerm = $dbBlockChildAdminPerm->get_row("SELECT *  FROM `adminperm`
                                                                        where `AdminID`='" . $AdminID . "'
                                                                        and `constName`='blok'
                                                                        and `varValue`='" . $XmlPerm . "'
                                                                        and `varName` = 'subdo' ;");
                    if (!constantDefined($XmlPerm)) {
                        $XmlPermConst = $XmlPerm;
                    } else {
                        $XmlPermConst = constant($XmlPerm);
                    }
                    if ($BlockChildAdminPerm) {//this child have permission in the database
                        if ($BlockChildAdminPerm->perm) {
                            $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input checked="checked"
                                     name="blok-' . $XmlPerm . '" value="blok-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                            //echo constant($XmlPerm).'<BR/>';
                        } else {//DON HAVE PERM
                            $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input name="blok-' . $XmlPerm . '"
                                            value="blok-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                        }
                    } else {//this child have permission  in the database
                        $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input name="blok-' . $XmlPerm . '"
                                        value="blok-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                    }
                }
            } else {//this prog dont have childs permissions
                $Childs = '';
            }
        } else {//this is new program
            if (!constantDefined($Block->BlockName)) {
                $BlockBlockName = $Block->BlockName;
            } else {
                $BlockBlockName = constant($Block->BlockName);
            }
            $Parent = '<td style="vertical-align: top;">
                            <input name="blok-' . $Block->BlockName . '" value="blok-' . $Block->BlockName . '"
                                type="checkbox">&nbsp;' . $BlockBlockName . '<br>';

            //load xml sub permissions names from xml file
            if (is_file('Blocks/' . $Block->BlockName . '/admin/desc.php')) {
                include 'Blocks/' . $Block->BlockName . '/admin/desc.php';
                $xml = new SimpleXMLElement($xmlstr);
                foreach ($xml->Permissions as $XmlPerm) {
                    //var_dump($XmlPerm);
                    
                    if (!constantDefined($XmlPerm)) {
                        $XmlPermConst = $XmlPerm;
                    } else {
                        $XmlPermConst = constant($XmlPerm);
                    }
                    
                    $Childs .= '&nbsp;&nbsp;&nbsp;&nbsp; <input  name="blok-' . $XmlPerm . '"
                                    value="blok-' . $XmlPerm . '" type="checkbox">&nbsp;' . $XmlPermConst . '<br>';
                }
            } else {//this prog dont have childs permissions
                $Childs = '';
            }
        }

        if ($i % 5) {
            $BlocksControlTr .= $Parent . $Childs . '</td>';
        } else {
            $BlocksControlTr .= '</tr><tr>' . $Parent . $Childs . '</td>';
        }
        $i++;
        $Childs = '';
    }
    $BlocksControlTr .='</tr>';


    $PermisionsList = VarTheme("{ProgramsControlTr}", $ProgramsControlTr, $PermisionsList);
    $PermisionsList = VarTheme("{BlocksControlTr}", $BlocksControlTr, $PermisionsList);

    return $PermisionsList;
}

?>