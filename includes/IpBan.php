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

function isIpBanned() {
    global $UserId, $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;
// ip ban
    $GuestIP = $_SERVER['REMOTE_ADDR'];
    $db_ban = new db();
    $rs_ban = $db_ban->get_results("SELECT * FROM `ipbanned` ;");
    //var_dump($rs_ban);
    if ($rs_ban) {
        foreach ($rs_ban as $ban_row) {
            $start = ip2long($ban_row->ipStart);
            $end = ip2long($ban_row->ipEnd);
            if (ip2long($GuestIP) >= $start and ip2long($GuestIP) <= $end) {
                return true;
            } else {
                return false;
            }
        }
    }
}

//end function

function isUserBanned() {
    global $UserId, $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;

// user ban
    if ($UserId) {//is user registerred?
//echo "user id : ".$UserId;
        SqlConnect();
        ExcuteQuery('SELECT Banned  FROM `users` WHERE `UserId` = "' . $UserId . '";');
        //$Rows = mysqli_fetch_assoc($Recordset);
        if ($TotalRecords > 0) {
            if ($Rows['Banned']) {
                $Ban = true;
            } else {
                $Ban = false;
            }//end if
        } else {
            $Ban = false;
        }
        closeQuery();
        return $Ban;
    } else { //not a user registered< we dont BAN our Geusts!
        return false;
    }
}

//end function
?>