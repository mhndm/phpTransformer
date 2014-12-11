<?php
/* * *********************************************
 *
 * *Project: phpTransformer.com .
 * *File Location :  .
 * *File Name:  .
 * *Date Created: 00-00-2007.
 * *Last Modified: 00-00-2007.
 * *Descriptions:*.
 * *Changes:*.
 * *TODO:* .
 * ****Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php
if (!isset($project)) {
    header("location: ");
}
?>
<?php
global $WebsiteUrl, $CustomHead;

if (DirHtml == "rtl") {
    
} else {
    
}//end if

$CustomHead.= '';

$MenuCont = '<div id="pt_menu"><nav><ul>' . getMenu(0) . '</ul></nav></div>';

function getMenu($parentid) {
    global $idLang;
    
    $db_menu = new db();
    $menu = "";
    $res = $db_menu->get_results("SELECT * FROM `pt_menu`, pt_menu_lang  WHERE 

                                                    `pt_menu`.`id`=`pt_menu_lang`.`id`

                                                    and `pt_menu_lang`.`IdLang` ='".$idLang."'

                                                    and `pt_menu`.`parent_id` = ".$parentid.";");

    if ($res) {

        foreach ($res as $r) {
            $cnt_of_child = $db_menu->get_var("select count(id) from `pt_menu` where parent_id = '" . $r->id . "' ;");

            if ($cnt_of_child > 0) {
                $menu .= '<li><a href="' . $r->href . '">' . $r->title . '</a>
                        <ul>' . getMenu($r->id) . '</ul>'
                        . '</li>';
            } else {
                $menu .= '<li><a href="' . $r->href . '">' . $r->title . '</a></li>';
            }
        }
    }

    return $menu;
}
?>