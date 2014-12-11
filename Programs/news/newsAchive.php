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

global $NewsMaxNbr, $Lang, $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;

$results_page_count_to_navigate_betweenu = 12;
$page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
$start = ($page - 1) * $NewsMaxNbr;

$newsRecordset = mysqli_query($conn,'SELECT * FROM `news` where `Deleted`!="1" and `Active`="1" '
                                . 'order by `IdNews` desc  limit ' . $start . ',' . $NewsMaxNbr . ';')  ;
$NewsTotal = mysqli_num_rows($newsRecordset);

$db_news_count = new db();
$NewsTotalRecords = $db_news_count->get_var("SELECT COUNT(*) FROM `news` where `Deleted`!='1'  and `Active`='1' ; ");
$ArrayData = '';
//echo $NewsTotal;
if ($NewsTotal > 0) {


    $NewsRows = mysqli_fetch_assoc($newsRecordset);
    for ($i = 0; $i < $NewsTotal; $i++) {
        $IdNews = $NewsRows['IdNews'];
        $Date = $NewsRows['Date'];
        $NewsPic = '<img id="archive_news_pic" src="uploads/news/pics/' . $NewsRows['NewsPic'] . '" title="' . $NewsRows['NewsPic'] . '" alt="" />';
        ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
        if ($TotalRecords > 0) {
            $IdLang = $Rows['IdLang'];
        } //end if
        ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="' . $IdLang . '" and `IdNews`="' . $IdNews . '";');
        if ($TotalRecords > 0) {

            $Tilte = $Rows['Tilte'];
            $Breif = $Rows['Breif'];

            $Vars = array("Prog", "ns", "idnews");
            $Vals = array("news", "details", $IdNews);
            $LinkId = CreateLink("", $Vars, $Vals);
            $ArrayData .= '<tr><td>
                <div class="news_container">
                            <div class="news_header"><a href="' . $LinkId . '" >' . $Tilte . '</a></div>
                                                <div id="archive_news_date">' . substr($Date, 0, 10) . ' </div>
                            <div class="news_body">
                                ' . $NewsPic . $Breif . '
                                <span class="more"><a href="' . $LinkId . '" >' . more . '  </a></span>
                            </div>

                        </div>
                </td></tr>';
        }//end if
        $NewsRows = mysqli_fetch_assoc($newsRecordset);
    } // end for
    echo $ArrayData;
    echo paginate_results($NewsMaxNbr, $results_page_count_to_navigate_betweenu, $NewsTotalRecords, $page, array('Prog', 'ns'), array('news', 'archive'));
}
?>