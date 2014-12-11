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

global $ThemeName, $Lang, $TotalRecords, $Rows, $NewsMaxNbr, $Recordset;
global $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn;

$NbrNews = 0;
$results_page_count_to_navigate_betweenu = 12;
$page = (isset($_GET['page']) && $_GET['page'] >= 1) ? InputFilter($_GET['page']) : 1;
$start = ($page - 1) * $NewsMaxNbr;


SqlConnect();
//get IdLang
ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
if ($TotalRecords > 0) {
    $IdLang = $Rows['IdLang'];
}
//get IdNews
//echo$IdLang;
closeQuery();

$Newsquery = "SELECT * FROM `news` WHERE `Active`='1' and `Deleted`<>'1' order by `IdNews` DESC  limit $start,$NewsMaxNbr; ";

$NewsRecordset = mysqli_query($conn, $Newsquery);

//$NewsTotalRecords = mysqli_num_rows($NewsRecordset);

$db_news_count = new db();
$NewsTotalRecords = $db_news_count->get_var("SELECT count(*) FROM `news` WHERE `Active`='1' and `Deleted`<>'1' ; ");

$NewsLine = '';
if ($NewsTotalRecords > 0) {
    if ($NewsMaxNbr >= $NewsTotalRecords) {
        $ActiveNews = $NewsTotalRecords;
    } else {
        $ActiveNews = $NewsMaxNbr;
    }//end if
    $NewsLine = '';
    // NewsMaxNbr
    for ($i = 0; $i < $ActiveNews; $i++) {
        $NewsRows = mysqli_fetch_assoc($NewsRecordset);
        $IdNews = $NewsRows['IdNews'];
        $IdUserName = $NewsRows['IdUserName'];
        //echo $IdUserName;
        $Date = $NewsRows['Date'];
        $NewsPic = $NewsRows['NewsPic'];

        //get IdCat

        ExcuteQuery('SELECT `IdCat` FROM `newscategoies` WHERE `IdNews`="' . $IdNews . '";');
        if ($TotalRecords > 0) {
            $IdCat = $Rows['IdCat'];
            //get CatName
            ExcuteQuery('SELECT `CatName` FROM `catlang` WHERE `IdCat`="' . $IdCat . '" and `IdLang`="' . $IdLang . '" and `Deleted`<>1;');
            if ($TotalRecords > 0) {
                $CatName = $Rows['CatName'];
                ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="' . $IdLang . '" and `IdNews`="' . $IdNews . '";');
                if ($TotalRecords > 0) {
                    $NbrNews++;
                    $Tilte = $Rows['Tilte'];
                    $SubTitle = $Rows['SubTitle'];
                    $Breif = mb_substr($Rows['Breif'], 0, 300, 'UTF-8');
                    $Tilte = str_replace(array('"', "'", "\\", "/"), array(' ', ' ', ' ', ' '), $Tilte);

                    // get theme and replace vars
                    if (is_file('Programs/news/Themes/' . $ThemeName . '/NewsBrief.php')) {
                        $Theme = get_include_contents('Programs/news/Themes/' . $ThemeName . '/NewsBrief.php');
                    } else {
                        $Theme = get_include_contents('Programs/news/Themes/Default/NewsBrief.php');
                    }
                    $Vars = array("Prog", "ns", "idnews", "title");
                    $Vals = array("news", "details", $IdNews, str_replace(" ", "_", subwords($Tilte, 0, 35)));
                    $LinkId = CreateLink("", $Vars, $Vals);

                    $Theme = VarTheme('{ThemeName}', $ThemeName, $Theme);
                    $NewsGroup = VarTheme('{NewsGroup}', $CatName, $Theme);

                    $NewsTitle = VarTheme('{NewsTitle}', '<a href="' . $LinkId . '" title="' . $Tilte . '">' . $Tilte . '</a>', $NewsGroup);
                    $NewsData = VarTheme('{NewsData}', $Breif, $NewsTitle);

                    if ($NewsPic == 'none.png' or $NewsPic == 'none.gif') {

                        $NewsPic = '<img alt="" src="uploads/news/pics/Programs/news/images/none.gif"/>';
                    } else {
                        $NewsPic = '<img alt="" src="uploads/news/pics/' . $NewsPic . '" version="s" old_src="" />';
                    }
                    $img = VarTheme('{img}', $NewsPic, $NewsData);

                    $more = VarTheme('{more}', '<a href="' . $LinkId . '" title="' . more . '" >' . more . '</a>', $img);

                    $NewsLine .= $more;
                }// end if
            } else {
                echo SorryNewsInCurrentLang . "<br/>";
            }//end if
        }//end if
    }//end if
}//end for	

echo $NewsLine . '<div class="news_archive">' . ToViewOlderNewsPleaseSee . '
    <a href="' . CreateLink("", array("Prog", "ns"), array("news", "archive")) . '" >
        <span class="span_news_archive">' . NewsArchive . '</span></a></div>';
?>



