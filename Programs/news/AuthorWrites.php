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

global $TotalRecords, $Rows, $Recordset, $Lang, $NewsMaxNbr;

$results_page_count_to_navigate_betweenu = 12;
$page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
$start = ($page - 1) * $NewsMaxNbr;

if (isset($_GET['user'])) {
     $user = urldecode( InputFilter($_GET['user']));

    SqlConnect();
//get user id
    ExcuteQuery('SELECT * FROM `users` WHERE `NickName`="' . $user . '";');

    if ($TotalRecords > 0) {
        $UserId = $Rows['UserId'];
        $UserName = $Rows['UserName'];
        $FamName = $Rows['FamName'];
        $ParentName = $Rows['ParentName'];
        echo (AuthorName) . " : " . $UserName . ' ' . $ParentName . ' ' . $FamName . "<br/>";
        //echo $UserId;

        global $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;
        $newsRecordset = mysqli_query($conn,'SELECT `IdNews` FROM `news` '
                . 'WHERE `IdUserName`="' . $UserId . '" and `Deleted` <>"1" and `Active`="1" limit  ' . $start . ',' . $NewsMaxNbr . ' ;');
        $db_news_count = new db();
        $NewsTotalRecords = $db_news_count->get_var('SELECT count(*) FROM `news` WHERE `IdUserName`="' . $UserId . '"  and `Deleted` <>"1" ; ');


        $NewsTotal = mysqli_num_rows($newsRecordset);
        //echo $NewsTotal;
        if ($NewsTotal > 0) {
            $NewsRows = mysqli_fetch_assoc($newsRecordset);
            for ($i = 0; $i < $NewsTotal; $i++) {
                $IdNews = $NewsRows['IdNews'];
                //echo $IdNews."<br/>";
                ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
                if ($TotalRecords > 0) {
                    $IdLang = $Rows['IdLang'];
                    //echo $IdLang;
                    ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="' . $IdLang . '" and `IdNews`="' . $IdNews . '";');
                    if ($TotalRecords > 0) {
                        $Tilte = $Rows['Tilte'];
                        //echo $Tilte."<br/>";
                        $Vars = array("Prog", "ns", "idnews");
                        $Vals = array("news", "details", $IdNews);
                        $LinkId = CreateLink("", $Vars, $Vals);
                        echo '<a href="' . $LinkId . '" >' . $Tilte . '</a><br/>';
                        //$SubTitle= $Rows['SubTitle'];
                        //$Breif= $Rows['Breif'];
                        //$FullMessage= $Rows['FullMessage'];
                        //$Note= $Rows['Note'];
                    }//end if
                }
                $NewsRows = mysqli_fetch_assoc($newsRecordset);
            }//end for
        } else {
            echo (UserHavntNews);
        }//end if
        echo paginate_results($NewsMaxNbr, $results_page_count_to_navigate_betweenu, $NewsTotalRecords, $page, array('Prog', 'ns', 'user'), array('news', 'awrites', $UserName));
    }//ebnd if
}
?>