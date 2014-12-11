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

global $ViewTopCont,$DefaulPageNbr, $TitlePage, $TheNavBar, $IdPage;
//var_dump($_GET);

if (isset($_GET['pagenbr'])) {
    if ($_GET['pagenbr'] != "") {
        $pagenbr = InputFilter($_GET['pagenbr']);
    } else {
        $pagenbr = $DefaulPageNbr;
    }//end if
} else {
    $pagenbr = $DefaulPageNbr;
}

//chekink permission for current user to show this page nbr
if (PagePermission($pagenbr)) {
    //get page par current lang
    global $Lang;
    //echo $Lang;
    //get idlang for this lang
    //global $conn;
    $pdb = new db();

    $IdLang = $pdb->get_var('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
    //$LangRecordset = mysqli_query($conn,$LangQuery)  ;	
    //$LangTotalRecords = mysqli_num_rows($LangRecordset);
    if ($IdLang) {
        //$LangRows = mysqli_fetch_assoc($LangRecordset);
        //$IdLang=$LangRows['IdLang'];
        //echo $IdLang;
        //echo $IdPage;
        $PageInfo = $pdb->get_row('SELECT * FROM `pagelang` WHERE `IdPage`="' . $IdPage . '" and `IdLang`="' . $IdLang . '";');

        // update page statistics info
        $pdb->query('UPDATE `pages` SET `Hits` = `Hits` +1 WHERE `pages`.`IdPage` = "' . $IdPage . '" ');

        //$Rec = mysqli_query($conn,$UpdateQwery);
        //echo $LangQuery;
        //$LangRecordset = mysqli_query($conn,$LangQuery)  ;	
        //$LangTotalRecords = mysqli_num_rows($LangRecordset);
        if ($PageInfo) {
            //$LangRows = mysqli_fetch_assoc($LangRecordset);
            $PageTitle = $PageInfo->PageTitle;
            $Content = $PageInfo->Content;
            echo theme_it($PageTitle, $Content);
            //show page in current lang
            $TitlePage .= ' .:. ' . $PageTitle;
            //echo '<strong>'.$PageTitle.'</strong>';
            //echo $Content;
        } else {
            //if not present in default lang show in default lang
            global $DefaultLang;
            $IdLang = $pdb->get_var('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $DefaultLang . '";');
            //$LangRecordset = mysqli_query($conn,$LangQuery)  ;	
            //$LangTotalRecords = mysqli_num_rows($LangRecordset);
            if ($IdLang) {
                //$LangRows = mysqli_fetch_assoc($LangRecordset);
                //$IdLang=$LangRows['IdLang'];
                //echo $IdPage.$IdLang.$DefaultLang;
                $PageInfo = $pdb->get_row('SELECT * FROM `pagelang` WHERE `IdPage`="' . $IdPage . '" and `IdLang`="' . $IdLang . '";');
                //echo $LangQuery;
                //$LangRecordset = mysqli_query($conn,$LangQuery)  ;	
                //$LangTotalRecords = mysqli_num_rows($LangRecordset);
                //echo $LangTotalRecords;
                if ($PageInfo) {
                    //$LangRows = mysqli_fetch_assoc($LangRecordset);
                    $PageTitle = $PageInfo->PageTitle;
                    $Content = $PageInfo->Content;
                    echo theme_it($PageTitle, $Content);
                    $TitlePage .= ' .:. ' . $PageTitle;
                    
                } else {
                    //if not present in defaul lang show error message
                    echo ThisPageNotAvailableInThisLang;
                }//end if
            }//end if
        }//end if
    }
} else {
    echo UdontHavePermissionToviewPage;
}//endf if

if (isset($PageTitle)) {
    $ThePageLink = CreateLink("", array("Prog", "pagenbr"), array("pages", $pagenbr));
    $TheNavBar[] = array($PageTitle, $ThePageLink);
} else {
    $ThePageLink = '';
}


function theme_it($TitlePage, $Content) {

    global $ThemeName;

    if (is_file("Programs/pages/Themes/$ThemeName/Theme.php")) {

        $theme_code = get_include_contents("Programs/pages/Themes/$ThemeName/Theme.php");
        $theme_code = str_replace("{PageTitle}", $TitlePage, $theme_code);
        return $theme_code = str_replace("{PageContent}", $Content, $theme_code);
    } else {
        return $Content;
    }
}

?>