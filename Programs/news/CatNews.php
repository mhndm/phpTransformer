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

if (isset($_GET['catid'])) {
    $IdCat = InputFilter($_GET['catid']);
    //echo $IdCat;

    global $idLang, $Lang, $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows,$NewsMaxNbr;
    
    $results_page_count_to_navigate_betweenu = 12;
    $page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
    $start = ($page - 1) * $NewsMaxNbr;


    $news_cat_db = new db();
    $news_cat_name = $news_cat_db->get_row('SELECT * FROM `catlang` WHERE  `IdLang`="' . $idLang . '"  and `IdCat`="' . $IdCat . '" limit 1 ;');

     
    
    echo '<div id="news_cat_name" class="news_sub_title"> ' . $news_cat_name->CatName . ' </div>';
    $newsRecordset = mysqli_query($conn,'SELECT n.`IdNews` FROM `news` as n,`newscategoies` as nc WHERE n.IdNews = nc.IdNews and nc.`IdCat`= "' . $IdCat . '" and n.Active = 1 and n.Deleted <> 1 ORDER BY `IdNews` desc limit  ' . $start . ',' . $NewsMaxNbr . '  ;');
    $NewsTotal = mysqli_num_rows($newsRecordset);
    
           $db_news_count = new db();
        $NewsTotalRecords = $db_news_count->get_var('SELECT count(*) FROM `newscategoies` as nc,`news` as n WHERE n.IdNews = nc.IdNews and nc.`IdCat`="' . $IdCat . '" and n.Deleted <> 1 and Active = 1 ;');


    
    if ($NewsTotal > 0) {
        $NewsRows = mysqli_fetch_assoc($newsRecordset);
        for ($i = 0; $i < $NewsTotal; $i++) {
            $IdNews = $NewsRows['IdNews'];
            //echo $IdNews;
            ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
            if ($TotalRecords > 0) {
                $IdLang = $Rows['IdLang'];
                //echo $IdLang;
            } //end if
            //  echo 'SELECT * FROM `newslang`, `news` WHERE `newslang`.`IdLang`="' . $IdLang . '" and `newslang`.`IdNews`="' . $IdNews . '" and `deleted`<>"1"   ;';
            //  ExcuteQuery('SELECT * FROM `newslang`, `news` WHERE `newslang`.`IdLang`="' . $IdLang . '" and `newslang`.`IdNews`="' . $IdNews . '" and `deleted`<>"1"   ;');

            ExcuteQuery('SELECT *
                                FROM `newslang`
                                INNER JOIN `news` ON 
                                `newslang`.`IdNews` =`news`.`IdNews` 
                                and
                                `newslang`.`IdLang` = "' . $IdLang . '"
                                AND `newslang`.`IdNews` = "' . $IdNews . '"
                                AND `deleted` <> "1" AND `Active`="1"  ');

            if ($TotalRecords > 0) {
                $Tilte = $Rows['Tilte'];
                $Date = $Rows['Date'];
                $Breif = $Rows['Breif'];
                $NewsPic = '<div class="brief_news_img"><img id="archive_news_pic" src="uploads/news/pics/' . $Rows['NewsPic'] . '" old_src="" version="s" title="' . $Rows['NewsPic'] . '" alt="" /></div>';

                //echo $Tilte."<br/>";
                $Vars = array("Prog", "ns", "idnews");
                $Vals = array("news", "details", $IdNews);
                $LinkId = CreateLink("", $Vars, $Vals);
      
              echo '  <div class="news_container">
                            <div class="news_header"><a href="' . $LinkId . '" >' . $Tilte . '</a></div>
                                                <div id="archive_news_date">' . substr($Date, 0, 10) . ' </div>
                            <div class="news_body">
                                ' . $NewsPic . $Breif . '
                                <span class="more"><a href="' . $LinkId . '" >' . more . '  </a></span>
                            </div>

                        </div>';
        
            }//end if
            $NewsRows = mysqli_fetch_assoc($newsRecordset);
        } // end for
    }//end if
            echo paginate_results($NewsMaxNbr, $results_page_count_to_navigate_betweenu, $NewsTotalRecords, $page, array('Prog', 'ns', 'catid'), array('news', 'catnews', $IdCat));

}//end if
?>