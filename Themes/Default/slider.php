<?php

global $idLang,$default_global;
$db_slider = new db();
$captions = array();
$db_pics = $db_slider->get_results("SELECT * FROM `thm_default_slider`,`thm_default_caption`
                                        where `thm_default_slider`.`id`=`thm_default_caption`.`id`
                                                and `thm_default_caption`.`id_lang`='" . $idLang . "' ;");

if ($db_pics) {
    echo '<div id="wrapper"><div class="slider-wrapper theme-default"> <div id="slider" class="nivoSlider">';
    foreach ($db_pics as $pic) {
        if($pic->caption !='' and $default_global['display_slider_caption']){
            $cap = ' title="#' . $pic->id. '" ';
            $captions[$pic->id]['id'] = $pic->id;
            $captions[$pic->id]['caption'] = $pic->caption;
        }
        else{
            $cap ='';
        }
        echo ' <a href="' . $pic->href . '">
                    <img src="' . $pic->path . '"  data-thumb="' . $pic->path . '" '.$cap.'  />
               </a>';
        
    }
    echo '</div>';

   // $captions = $db_captions->get_results(" SELECT * FROM `thm_default_caption` WHERE `id_lang` = '" . $idLang . "'; ");

    if (count($captions) and $default_global['display_slider_caption']) {

        foreach ($captions as $caption) {
               // var_dump($caption);
                echo '<div id="' . $caption['id'] . '" class="nivo-html-caption">' . $caption['caption'] . '</div>';
            
        }
    }
    echo '</div></div>';
}
?>