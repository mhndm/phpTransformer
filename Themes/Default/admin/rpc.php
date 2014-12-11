<?php
include_once "../../../includes.php";

$db_lang = new db();
$db_slider = new db();
$db_captions = new db();

$sliders = $db_slider->get_results(" SELECT * FROM `thm_default_slider` ;");
if ($sliders) {
   
   
    foreach ($sliders as $slider) {
        $id = $slider->id;
        $path_slider = $slider->path;
        $path_href= $slider->href;
        $path_slider = str_replace("/img/", "/img/thumbs/", $path_slider);
        $captions = $db_captions->get_results("SELECT * FROM `thm_default_caption` where `id`='" . $id . "'  order by `id_lang`;");
        echo '<div style="float:left; margin:4px; width:600px;" id="' . $id . '" >   
            
                   <img style="float:left; " src="' . $path_slider . '" />
                        <div style="float:left; ">   Link :
                   <input class="hrefs" type="text" name="hrefs['.$id.']" value="'.$path_href.'"  
                       style="width:700px;" placeholder="#"/></div></div>
                   ';
        if ($captions) {
            foreach ($captions as $caption) {
                $slider_caption = $caption->caption;
                $id_lang = $caption->id_lang;
                $lang_name = $db_lang->get_var(" select `LangName` from `languages` where `IdLang`='" . $id_lang . "'; ");

                echo '<div style="float:left;margin:4px;">' . $lang_name . ' :<br/> 
                            <input class="captions" name="captions['.$id.']['.$id_lang.']" type="text" style="width:600px;" value="' . $slider_caption . '" placeholder="' . $lang_name . '" />
                            </div>';
            }
        }
        echo '';
    }
}
?>