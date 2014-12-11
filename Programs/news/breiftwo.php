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
<?php if (!isset($project)) {
    header("location: ../../");
} ?>
<?php

global $ThemeName, $Lang, $TotalRecords, $Rows, $NewsMaxNbr, $Recordset;
global $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn;

$NbrNews = 0;
SqlConnect();
//get IdLang
ExcuteQuery('SELECT `IdLang`FROM `languages` WHERE `LangName`="' . $Lang . '";');
if ($TotalRecords > 0) {
    $IdLang = $Rows['IdLang'];
}
//get IdNews
//echo$IdLang;
closeQuery();

$Newsquery = "SELECT * FROM `news` WHERE `Active`='1' and `Deleted`<>'1' order by `IdNews` DESC;";

$NewsRecordset = mysqli_query($conn,$Newsquery)  ;
$NewsTotalRecords = mysqli_num_rows($NewsRecordset);
if ($NewsTotalRecords > 0) {
    if ($NewsMaxNbr >= $NewsTotalRecords) {
        $ActiveNews = $NewsTotalRecords;
    } else {
        $ActiveNews = $NewsMaxNbr;
    }//end if
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
            ExcuteQuery('SELECT `CatName` FROM `catlang` WHERE `IdCat`="' . $IdCat . '" and `IdLang`="' . $IdLang . '";');
            if ($TotalRecords > 0) {
                $CatName = $Rows['CatName'];
                ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="' . $IdLang . '" and `IdNews`="' . $IdNews . '";');
                if ($TotalRecords > 0) {
                    $NbrNews++;
                    $Tilte = $Rows['Tilte'];
                    $SubTitle = $Rows['SubTitle'];
                    $Breif = $Rows['Breif'];
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
                    $NewsPic = '<img style="padding: 5px 5px 5px 5px;margin: 3px 2px 1px 2px;display: inline;" align="right" alt="" src="Programs/news/images/' . $NewsPic . '"/>';
                    $img = VarTheme('{img}', $NewsPic, $NewsData);

                    $more = VarTheme('{more}', '<a href="' . $LinkId . '" title="' . (more) . '" >' . (more) . '</a>', $img);
                    if (fmod($i, 2) == 0) {
                        $NewsLine = '<table style="width: 100%" cellspacing="0" cellpadding="0"><tr><td style="width:50%; vertical-align:top">' . $more . '</td>';
                    } else {
                        $NewsLine.= '<td style="width:50%; vertical-align:top">' . $more . '</td></tr></table>';
                        echo $NewsLine;
                    }//end if
                }// end if
            } else {
                echo (SorryNewsInCurrentLang) . "<br/>";
            }//end if
        }//end if
    }//end if
}//end for	
if (isset($ActiveNews)) {
    if (($i == $ActiveNews and (fmod($i, 2) != 0)) or (fmod($NbrNews, 2) != 0)) {
        echo $NewsLine . '<td style="width:50%">&nbsp;</td></tr></table>';
    }//end if
}//en dif


echo '<br/>' . ToViewOlderNewsPleaseSee . ' <a href="' . CreateLink("", array("Prog", "ns"), array("news", "archive")) . '" ><strong>' . (NewsArchive) . '</strong></a>';
?>



