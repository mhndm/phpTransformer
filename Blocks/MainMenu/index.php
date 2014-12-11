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

global $conn, $Lang, $ThemeName, $idLang;
$items = array();
$others_items = array();

$pages_query = 'SELECT * FROM `menlang` , `mainmenu`,`pages` '
        . 'WHERE `menlang`.`IdLang` ="' . $idLang . '" 
                    AND `menlang`.`idMM` = `mainmenu`.`idMM`
                    and `pages`.`IdPage` = `mainmenu`.`IdPage`
                    and `pages`.`Deleted` <>"1"';

$others_query = 'SELECT * FROM `menlang` , `mainmenu`  '
        . 'WHERE `menlang`.`IdLang` ="' . $idLang . '" 
                    AND `menlang`.`idMM` = `mainmenu`.`idMM`
                    and `mainmenu`.`IdPage` = ""
                    ;';
$db = new db();
$pages_items = $db->get_results($pages_query, ARRAY_A);
if (!($pages_items)) {
    $pages_items = array();
}

$others_items = $db->get_results($others_query, ARRAY_A);
if (!($others_items)) {
    $others_items = array();
}

$items = array_merge($pages_items, $others_items);

usort($items, function($a, $b) {
    return $a['Order'] - $b['Order'];
});


if (count($items) > 0) {
    echo "<div class='page-links'>";
    foreach ($items as $item) {
        //$MainRows = mysqli_fetch_assoc($MainRecordset);
        $TitleElement = $item['TitleElement'];
        $Link = $item['Link'];
        $External = $item['External'];


        if ($External != "1") {
            $Link = ConverLink($Link);
        }//end if

        $Target = $item['Target'];
        if (!$External) {
            $TiTleSEO = subwords(str_replace(" ", "_", $TitleElement), 0, 35);
            $CodeTheme = '<a href="' . $Link . '&title=' . $TiTleSEO . '" target="' . $Target . '" >' . $TitleElement . '</a>';
        } else {
            $CodeTheme = '<a href="' . $Link . '" target="' . $Target . '" >' . $TitleElement . '</a>';
        }
        // replace them by data
        if (is_file('Blocks/MainMenu/Themes/' . $ThemeName . '/Theme.php')) {
            $Theme = get_include_contents('Blocks/MainMenu/Themes/' . $ThemeName . '/Theme.php');
        } else {
            $Theme = get_include_contents('Blocks/MainMenu/Themes/Default/Theme.php');
        }//end if
        $Theme = VarTheme('{BlockContenu}', $CodeTheme, $Theme);
        echo $Theme;
    }
    echo "</div>";
}
?>