<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php
global $TotalRecords,$Rows,$Recordset,$conn,$WebsiteUrl ;

$project = 'phpTransformer';

error_reporting(0);
if(function_exists('set_time_limit')) {
    set_time_limit(0);
}
ini_alter("memory_limit", "16M");
ob_end_clean();
ob_implicit_flush(TRUE);
ignore_user_abort(1);
clearstatcache();
//error_reporting(6135);

require_once('../../config.php');
//require_once('../../includes/Functions.php');
require_once('../../includes/InputFilters.php');
require_once('../../DBConnect/MySql/index.php');
require_once('../../includes/Sql.php');
require_once('../../includes/tcpdf/tcpdf.php');
require_once('../../includes/ezsql/ez_sql.php');
SqlConnect();

if(isset($_GET['idnews'])) {
    $IdNews = InputFilter($_GET['idnews']);
    $Lang  = InputFilter($_GET['Lang']);
    // get idLang
    SqlConnect();
    ExcuteQuery('SELECT `IdLang` FROM `languages` WHERE `LangName`="'.$Lang.'";');
    if ($TotalRecords>0) {
        require_once('../../languages/lang-'.$Lang.'.php');
        $IdLang= $Rows['IdLang'];
        //GET NEWS DATE
        ExcuteQuery('SELECT * FROM `news` WHERE `IdNews`="'.$IdNews.'";');
        if ($TotalRecords>0) {
            $Date = $Rows['Date'];
        }
        else {
            $Date = Date('Y-m-d');
        }//end if

        // get news in this lang
        ExcuteQuery('SELECT * FROM `newslang` WHERE `IdLang`="'.$IdLang.'" and `IdNews`="'.$IdNews.'";');

        if ($TotalRecords>0) {
            $Tilte			= $Rows['Tilte'];
            $SubTitle		= $Rows['SubTitle'];
            $Breif			= $Rows['Breif'];
            $FullMessage	= $Rows['FullMessage'];
            $Note 			= $Rows['Note'];
            //get news image
            ExcuteQuery('SELECT * FROM `news` WHERE `IdNews`="'.$IdNews.'";');
            if ($TotalRecords>0) {
                $IdUserName	= $Rows['IdUserName'];
                $NewsPic	= $Rows['NewsPic'];
                $IdUserName =$Rows['IdUserName'];
            }//end if
            //get author name
            ExcuteQuery('SELECT * FROM `users` WHERE `UserId`="'.$IdUserName.'";');
            if ($TotalRecords>0) {
                $UserName= $Rows['UserName'];
                $NickName=$Rows['NickName'];
            }
            else {
                $UserName= "";
                $NickName= "";
            }//end if
            //get group id for this news
            ExcuteQuery('SELECT `IdCat` FROM `newscategoies` WHERE `IdNews`="'.$IdNews.'";');
            if ($TotalRecords>0) {
                $IdCat= $Rows['IdCat'];
            }//end if

            //get group name
            ExcuteQuery('SELECT `CatName` FROM `catlang` WHERE `IdCat`="'.$IdCat.'" and `IdLang`="'.$IdLang.'";');
            if ($TotalRecords>0) {
                $CatName= $Rows['CatName'];
            }//end if

            list($width, $height, $type, $attr) = getimagesize('../../uploads/news/pics/'.$NewsPic);
            $NewsImg='<img '.$attr .' style="float:left;padding: 5px ;" alt="" src="../../uploads/news/pics/'.$NewsPic.'"/>';
     
   
            $FullMessage = str_replace('src="', 'src="../../', $FullMessage);
            $FullMessage = str_replace("src='", "src='../../", $FullMessage);
            $FullMessage = str_replace('SRC="', 'SRC="../../', $FullMessage);
            $FullMessage = str_replace("SRC='", "SRC='../../", $FullMessage);
        
            $FullMessage = str_replace('src="../../http', 'src="http', $FullMessage);
            $FullMessage = str_replace("src='../../http", "src='http", $FullMessage);
            $FullMessage = str_replace('SRC="../../HTTP', 'SRC="HTTP', $FullMessage);
            $FullMessage = str_replace("SRC='../../HTTP", "SRC='HTTP", $FullMessage);


            $pdfPage  = $Date .'<br/>'
                    .$NewsImg .   $FullMessage.  $Note. '<p><strong>'
                    .$NickName.'<br/>'.$WebSiteName.'<br/><a href="'.$WebsiteUrl.'"> '.$WebsiteUrl.'</a></strong></p>';


            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
            // set document information
            $pdf->SetCreator('phpTransformer.com');
            $pdf->SetAuthor("phpTransformer PDF Generator");
            $pdf->SetTitle($Tilte);
            $pdf->SetSubject($SubTitle);
            $pdf->SetKeywords("phpTransformer, PDF, Generator");
            // set default header data
            $pdf->SetHeaderData('', 0, $Tilte, $SubTitle);
            // set header and footer fonts
            $pdf->setHeaderFont(Array('almohanad', '', '16'));
            $pdf->setFooterFont(Array('almohanad', '', PDF_FONT_SIZE_DATA));
            //set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $lg = Array();
            $lg['a_meta_charset'] = "UTF-8";
            $lg['a_meta_dir'] = DirHtml;
            $lg['a_meta_language'] = MiniLang;
            $lg['w_page'] = "";
            $pdf->setLanguageArray($lg);
            $pdf->AliasNbPages();
            $pdf->AddPage();
            if(strtolower(DirHtml)=='rtl') {
                $pdf->setRTL(true);
            }
            $pdf->SetFont("almohanad", "", 12);
            $pdf->WriteHTML($pdfPage, true, 0, true, 0);
            //$pdf->Output("example.pdf", "I"); // Send PDF to the standard output
            //$pdf->Output("news".$IdNews.".pdf", "D"); // Download PDF as file
            //$pdf->Output("news".$IdNews.".pdf", "S"); // Returns PDF as a string
            $pdfFile = "../../downloads/news/pdf/news-".$IdNews."-".$Lang.".pdf";
            $pdf->Output($pdfFile, "F"); // Save PDF to a local file
            echo header("Location: $pdfFile");

        }
        else {
            echo 'WrongNewsId';
        }//end if
    }
    else {
        echo 'WrongLangName';
    }//end if
}
else {
    echo 'NoIdNewsSelected';
}//end if


?>