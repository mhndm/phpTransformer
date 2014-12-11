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

global $cc, $UserId, $GuestCanWrite, $NickName, $ThemeName;


if (isset($_GET['idnews'])) {
    $IdNews = InputFilter($_GET['idnews']);
} else {
    $IdNews = "";
}

// cheking current user login
if ($NickName === "Guest") {
    // for geust users
    if ($GuestCanWrite == 1) {
        if (is_file('Themes/' . $ThemeName . '/FormAdd.php')) {
            include_once('Themes/' . $ThemeName . '/FormAdd.php');
        } else {
            include_once('Themes/Default/FormAdd.php');
        }
    } else {
        echo UserMustRegisterTOAddComment;
    }//end if
} else {
    // for registered users
    if (is_file('Themes/' . $ThemeName . '/FormAdd.php')) {
        include_once('Themes/' . $ThemeName . '/FormAdd.php');
    } else {
        include_once('Themes/Default/FormAdd.php');
    }
}//end if
?>