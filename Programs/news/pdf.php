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

global $Lang, $TotalRecords, $Rows;


if (isset($_GET['idnews'])) {
    $IdNews = InputFilter($_GET['idnews']);
    // get idLang
    ExcuteQuery("SELECT `IdLang` FROM `languages` WHERE `LangName`='" . $Lang . "';");
    if ($TotalRecords > 0) {
        $IdLang = $Rows['IdLang'];
        //if we have generate pdf local file from the admin panel , else generate one on the fly
        $pdfFile = "../../downloads/news/pdf/news-" . $IdNews . "-" . $Lang . ".pdf";
        if (is_file("Programs/news/" . $pdfFile)) {
            //ECHO "IS FILE !";
            header("location: Programs/news/$pdfFile");
        } else {
            // get news in this lang
            ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="' . $IdLang . '" and `IdNews`="' . $IdNews . '";');
            if ($TotalRecords > 0) {
                $PdfLink = 'Programs/news/GeneratePDF.php?Lang=' . $Lang . '&idnews=' . $IdNews;
                echo '<iframe style="border:none" width="0" height="0"  src="' . $PdfLink . '" ></iframe>
                                    <a href="Programs/news/' . $pdfFile . '"><h1>' . $pdfFile . '</h1></a>';
            } else {
                echo (WrongNewsId);
            }//end if
        } //END IF
    } else {
        echo (WrongLangName);
    }//end if
} else {
    echo (NoIdNewsSelected);
}//end if
?>