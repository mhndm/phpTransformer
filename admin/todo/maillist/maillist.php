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

global $CustomHead;

$maillist = '';

// المشكلة انو من هون عم يبع الرسائل لازم من الاجاكس  و البولكل لازم تكون هونيك

$theList = SubIconLink("maillist", "maillist") . "<br/>"
        . SubIconLink("letters", "letters") . "<br/>";

if (!isset($_POST['SendLetterNow'])) {

    $Vars = array('todo', 'subdo');
    $Vals = array('letters', 'Newletter');

    $CreateNewLetter = '<a href="' . AdminCreateLink('', $Vars, $Vals) . '" title="" >' . (Newletter) . '</a>';

    $maillist .= '<form id="form1" name="form1" method="post" action="">
        <strong>' . SendLetterTo . ' : </strong><br/><br/>
  <input name="radiosend" type="radio" id="EveryOne" value="EveryOne" checked />
  <label for="EveryOne">' . EveryOne . '</label>
  <table border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td><input type="radio" name="radiosend" id="Group" value="Group" />
        <label for="Group">' . group . '</label></td>
      <td><select class="select" name="GroupList" id="GroupList">
        ' . GroupList() . '
      </select></td>
    </tr>
    <tr>
      <td><input type="radio" name="radiosend" id="Member" value="Member" />
        <label for="Member">' . Member . '</label></td>
      <td><input class="text" type="text" name="User" id="User" /></td>
    </tr>
    <tr>
      <td><input type="radio" name="radiosend" id="Email" value="Email" />
        <label for="Email">'
            . Email . '</label></td>
      <td>
	  <input class="text" type="text" name="EmailAddress" id="EmailAddress" />&nbsp;&nbsp;&nbsp;'
            . Name . ' : 
	  <input class="text" type="text" name="ContactName" id="ContactName" />
	  </td>
    </tr>
  </table>
 ' . LetterForm . ' :
<select class="select" name="ListLetterForm" id="ListLetterForm">
  ' . LettersList() . '
</select>
 <span style="font-size: x-small">' . $CreateNewLetter . '</span><br/> <br/>
 <input  class="submit" type="submit" name="SendLetterNow" id="SendLetterNow" value="' . (SendLetterNow) . '">
</form>';
    $maillist .= '
                    <script>
                        $(document).ready(function(){
                                $("#GroupList").click(function(){
                                        $("#Group").prop("checked", true);		
                                });
                                
                                $("#User").click(function(){
                                        $("#Member").prop("checked", true);		
                                });
                                
                                $("#EmailAddress").click(function(){
                                        $("#Email").prop("checked", true);		
                                });
                               
                                $("#ContactName").click(function(){
                                        $("#Email").prop("checked", true);		
                                });
                        });

                    </script>
    ';
} else {
    $SendOption = PostFilter($_POST['radiosend']);
    switch ($SendOption) {
        case 'EveryOne' :
            $maillist = EveryoneSend();
            break;
        case 'Group' :
            $GroupName = PostFilter($_POST['GroupList']);
            $maillist = GroupSend($GroupName);
            break;
        case 'Member' :
            $MemberName = PostFilter($_POST['User']);
            $maillist = MemberSend($MemberName);
            break;
        case 'Email' :
            $EmailAddress = PostFilter($_POST['EmailAddress']);
            $maillist = EmailSend($EmailAddress);
            break;
        default :
    }//end switch
}//end if
$theContent = $maillist;

$maillist = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$maillist = VarTheme("{todoImg}", "maillist.png", $maillist);
$maillist = VarTheme("{ThemeName}", $ThemeName, $maillist);
$maillist = VarTheme("{List}", $theList, $maillist);
$maillist = VarTheme("{Content}", $theContent, $maillist);

function GroupList() {
    global $TotalRecords, $Rows, $Recordset;
    $options = "";
    ExcuteQuery("SELECT * FROM `groups` WHERE `Deleted`<>'1' ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            if ($Rows['GroupName'] != "Guests") {
                $options .= '<option value="' . $Rows['GroupName'] . '">' . $Rows['GroupName'] . '</option>';
            }
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    return $options;
}

function LettersList() {
    global $TotalRecords, $Rows, $Recordset;
    $options = "";
    ExcuteQuery("SELECT * FROM `letters` WHERE `Deleted`<>'1' ;");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $options .= '<option value="' . $Rows['LatterName'] . '">' . $Rows['LatterName'] . '</option>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    return $options;
}

function GroupSend($GroupName) {

    global $AdminMail, $WebSiteName;
    $LatterName = PostFilter($_POST['ListLetterForm']);
    $maillist = '';
    $db_group = new db();
    $GroupId = $db_group->get_var("SELECT `GroupId` FROM `groups` WHERE `GroupName`='" . $GroupName . "';");
    if ($GroupId) {

        //get current languages running on website
        $db_lang = new db();
        $mail_langs = $db_lang->get_results(" select * from `languages` ; ");
        foreach ($mail_langs as $mail_lang) {
            $LangName = $mail_lang->LangName;
            $IdLang = $mail_lang->IdLang;

            //get members of this group like this lang
            $users = $db_group->get_results(" select * from `users` 
                                        where `PrefLang`='" . $LangName . "' and `GroupId`='" . $GroupId . "' ; ");
            if ($users) {
                foreach ($users as $user) {
                    $emails_array[] = $user->UserMail;
                }

                $db_group->query = "update `users` set `Mailed`='0'; ";

                $db_group->query = "update `users` set `Mailed`='-1' where `GroupId`='" . $GroupId . "'; ";

                $Letter = GenerateMessage($LatterName, $IdLang, website_member);
                send_mail_list($AdminMail, $WebSiteName, $emails_array, $Letter[0], $Letter[1]);
                $db_group->query = "update `users` set `Mailed`='1' where `GroupId`='" . $GroupId . "'; ";
            }

            unset($emails_array);
        }
        $maillist = MessageWasSentSuccessfully;
    } else {
        // group not found
        $maillist = ThereWasAnErrorTendingTheMessage;
    }
    return $maillist;
}

function MemberSend($MemberName) {
    global $AdminMail, $WebSiteName, $UserId;

    $maillist = '';

    $db_member = new db();

    $query = "SELECT `NickName` FROM `users` where `NickName`='" . $MemberName . "';";
    $MemberName = $db_member->get_var($query);
    if ($MemberName) {
        $query = "SELECT `UserMail` FROM `users` where `NickName`='" . $MemberName . "';";
        $UserMail = $db_member->get_var($query);

        $query = "SELECT `PrefLang` FROM `users` where `NickName`='" . $MemberName . "';";
        $PrefLang = $db_member->get_var($query);


        $IdLang = $db_member->get_var("SELECT `IdLang` FROM `languages` WHERE `LangName`='" . $PrefLang . "';");

        $LatterName = PostFilter($_POST['ListLetterForm']);
        //set all  userS  Mailed=0
        $query = "update `users` set `Mailed`='0'; ";

        $db_member->query($query);

        //set group userS  Mailed=-1
        $query = "update `users` set `Mailed`='-1' where `NickName`='" . $MemberName . "'; ";

        $db_member->query($query);

        require("includes/phpmailer/class.phpmailer.php");


        $Letter = GenerateMessage($LatterName, $IdLang, $MemberName);
        // send mail

        $sent = SendEmail($AdminMail, $WebSiteName, array($UserMail, $MemberName), $Letter[0], $Letter[1]);
        if ($sent) {
            //set THIS user  Mailed=1
            $db_member->query("update `users` set `Mailed`='1' where `NickName` = '" . $MemberName . "' ; ");

            $maillist = MessageWasSentSuccessfully . ' ' . to . ' <strong>' . $MemberName . "</strong><br/>";
        } else {
            $maillist = ThereWasAnErrorTendingTheMessage;
        }
    } else {
        $maillist = ThereWasAnErrorTendingTheMessage;
    }
    return $maillist;
}

function EmailSend($EmailAddress) {
    global $AdminMail, $WebSiteName;
    global $TotalRecords, $Rows, $Recordset, $Lang;
    global $UserId, $TotalRecords, $Rows, $Recordset, $conn, $SqlType;
    $LatterName = PostFilter($_POST['ListLetterForm']);

    require("includes/phpmailer/class.phpmailer.php");
    $query = "SELECT `IdLang` FROM `languages` WHERE `LangName`='" . $Lang . "';";

    $Rss = mysqli_query($conn,$query); // ;
    $Recs = mysqli_fetch_assoc($Rss);
    $IdLang = $Recs['IdLang'];

    $Letter = GenerateMessage($LatterName, $IdLang);
    // send mail
    $emailAddress = PostFilter($_POST['EmailAddress']);
    $NickName = PostFilter($_POST['ContactName']);
    $sent = SendEmail($AdminMail, $WebSiteName, array($emailAddress, $NickName), $Letter[0], $Letter[1]);
    if ($sent) {
        $maillist = MessageWasSentSuccessfully . "<br/>";
    } else {
        $maillist = ThereWasAnErrorTendingTheMessage . "<br/>";
    }
    return $maillist;
}

function EveryoneSend() {
    global $AdminMail, $WebSiteName;
    $LatterName = PostFilter($_POST['ListLetterForm']);


        //get current languages running on website
        $db_lang = new db();
        $mail_langs = $db_lang->get_results(" select * from `languages` ; ");
        foreach ($mail_langs as $mail_lang) {
            $LangName = $mail_lang->LangName;
            $IdLang = $mail_lang->IdLang;
            $db_group = new db();
            //get members of this group like this lang
            $users = $db_group->get_results(" select * from `users` 
                                        where `PrefLang`='" . $LangName . "' ; ");
            if ($users) {
                foreach ($users as $user) {
                    $emails_array[] = $user->UserMail;
                }

                $db_group->query = "update `users` set `Mailed`='0'; ";

                $db_group->query = "update `users` set `Mailed`='-1'; ";

                $Letter = GenerateMessage($LatterName, $IdLang, website_member);
                send_mail_list($AdminMail, $WebSiteName, $emails_array, $Letter[0], $Letter[1]);
                $db_group->query = "update `users` set `Mailed`='1' ; ";
            }

            unset($emails_array);
        }
        $maillist = MessageWasSentSuccessfully;

    return $maillist;
}

/*
 *  $maillist .= '<script language="javascript" type="text/javascript" src="admin/todo/maillist/ajax.js"></script>
  <div id="sendreceivepercent" style="background:#FFFFFF; border:solid"></div>';
 */
?>