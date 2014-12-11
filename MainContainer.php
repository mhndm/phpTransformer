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
    header("location: ");
} ?>
<?php

// MainMenu  Account Statistics Ads Search
/*
  SqlConnect();
  ExcuteQuery("SELECT * FROM `blocks` WHERE (`MainSec`='M' and `Deleted`<>'1') ORDER BY `order` ASC;");
 */
$MCdb = new db();
$MainContrs = $MCdb->get_results("SELECT * FROM `blocks` WHERE (`MainSec`='M' and `Deleted`<>'1') ORDER BY `Order` ASC;");
//echo $TotalRecords."<br>";
if ($MainContrs) {
    foreach ($MainContrs as $MainContr) {
        $BlockName = $MainContr->BlockName;
        //echo $BlockName." ";
        $Active = $MainContr->Active;
        $View = $MainContr->View;
        $MainSec = $MainContr->MainSec;
        $Order = $MainContr->Order;
        $ObjectId = $MainContr->ObjectId;
        $License = $MainContr->License;
        $ObjectName = "block" . $BlockName;
        //if(!ValidLicense($License,$ObjectName )){
        //	$MainCont ="";
        //}
        //else{
        if ($Active and ContPermission($GroupId, $ObjectId)) {
            //load lang filename
            if (file_exists("Blocks/$BlockName/Languages/lang-$Lang.pt.php")) {
                $BlockLang = "Blocks/$BlockName/Languages/lang-$Lang.pt.php"; //custom translation
            } else {
                $BlockLang = "Blocks/$BlockName/Languages/lang-$Lang.php";
            }
            if (is_file($BlockLang)) {
                $Block = include_once("$BlockLang");
            }
            //BlockTitle						
            // main menu exception theme
            if ($BlockName != "MainMenu") {
                //load them block
                $BlockThemFile = "Blocks/$BlockName/Themes/$ThemeName/Theme.php";
                if (is_file($BlockThemFile)) {
                    $BlockThemFile = get_include_contents("$BlockThemFile");
                } else {
                    $BlockThemFile = "Themes/$ThemeName/Block.php";
                    $BlockThemFile = get_include_contents("$BlockThemFile");
                }
            } else {
                /* to add theme for menu and menu items, we create file in the block theme file index.php contenu {BlockContenu}  */
                //$BlockThemFile="{BlockContenu}";
                $BlockThemFile = "Blocks/$BlockName/Themes/$ThemeName/index.php";
                if (is_file($BlockThemFile)) {
                    $BlockThemFile = get_include_contents("$BlockThemFile");
                } else {
                    $BlockThemFile = "{BlockContenu}";
                }
            }//endif 
            // load block file
            $Blockfile = "Blocks/" . $BlockName . "/index.php";
            if (is_file($Blockfile)) {
                $BlockContenu = get_include_contents("$Blockfile");
            } else {
                $BlockContenu = '';
            }
            //get id of language
       
            $dbLangmc = new db();
            $idLang = $dbLangmc->get_var("SELECT `IdLang` FROM `languages` WHERE `LangName`='" . $Lang . "'");


            $dbBTdb = new db();
            $BlockTitleVal = $dbBTdb->get_row("SELECT * FROM `blocklang` WHERE `BlockName`='" . $BlockName . "' and `idLang`=" . $idLang . ";");

            if ($BlockTitleVal) {
                $BlockTitle = $BlockTitleVal->BlockTitle;
                $BlockThemFile = VarTheme("{BlockTitle}", $BlockTitle, $BlockThemFile);
            } else {
                //$BlockTitle= (" ");
                $BlockThemFile = VarTheme("{BlockTitle}", "&nbsp;&nbsp;&nbsp;", $BlockThemFile);
            }
            
            $BlockThemFile = VarTheme("{ThemeName}", $ThemeName, $BlockThemFile);
            //replace contenu
            $BlockThemFile = VarTheme("{BlockContenu}", $BlockContenu, $BlockThemFile);
            $Block = $BlockThemFile;
        } else {
            $Block = "";
        }
        //}//end if

        if (isset($MainCont)) {
            $MainCont.=$Block; // get all Main containers	
        } else {
            $MainCont = $Block; // get first containers	
        }
    }//end for
}//end if

?>