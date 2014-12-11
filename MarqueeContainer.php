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
 * 	TODO:	 CHANGE TO CREATE URL FUNCTION .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php

if (!isset($project)) {
    header("location: ");
}
?>
<?php

global $LastLineCode, $idLang, $CustomHead, $Lang, $ThemeName;

$LastLineCode.= '<script src="includes/jquery_news_ticker/includes/jquery.ticker.min.js" type="text/javascript"></script>';

$dbMarque = new db();

$MarqueesLang = $dbMarque->get_results(
        "SELECT marqlang.Message ,marques.Link 
        FROM `marqlang`,marques            
            WHERE marques.idMarque=marqlang.idmarque 
            and `idLang`='" . $idLang . "' 
            and  `marques`.`Deleted`<>'1'
            and (('" . date('Y-m-d H:i:s') . "' BETWEEN `StartDate` AND `EndDate`) 
                or `StartDate` = '0000-00-00 00:00:00' )
            order by marqlang.idmarque DESC limit 0,10 ;");

$marquee_data = '';
if ($MarqueesLang) {
    foreach ($MarqueesLang as $Marquee) {
        $Message = $Marquee->Message;
        $Message = str_replace(array('"', "'", "\\", "/", ":", "@"), array('', '', '', '', '', ''), $Message);
        $Link = $Marquee->Link;
        $marquee_data.= '<li class="news-item"><a href="' . $Link . '">' . $Message . '</a></li>';
    }//end for
} else {
    $marquee_data.= '';
}

$MarqueeText = '<ul id="pt_marquee_ul" class="js-hidden">
                        ' . $marquee_data . '
                    </ul>
              ';

//load marqueee theme
$MarqueeTheme = get_include_contents("Themes/$ThemeName/MarqueeContainer.php");
$MarqueeTheme = VarTheme("{ThemeName}", $ThemeName, $MarqueeTheme);
$MarqueeCont = VarTheme("{MarqueeCode}", $MarqueeText, $MarqueeTheme);

$MarqueeCont .= '<script type="text/javascript">
                    $(function () {
                        $("#pt_marquee_ul").ticker({
                           controls: false,
                             titleText: "' . LatestNews . '",
                                 speed: 0.10,   
                              direction: "' . DirHtml . '"     
                        });
                         
                    });
                </script>';
?>
