<?php
// captions[20140000000][20130000001]
include_once "../../../includes.php";

//slider captions
if (isset($_GET['captions'])) {
    $db_caps = new db();
    $db_up = new db();

    $caps = $db_caps->get_results(" SELECT * FROM `thm_default_caption` ; ");

    $captions_get = $_GET['captions'];

    foreach ($caps as $cap) {
        $id = $cap->id;
        $id_lang = $cap->id_lang;
        if (isset($captions_get[$id][$id_lang])) {
            $caption = InputFilter($captions_get[$id][$id_lang]);
            //update caption on db
            $db_up->query(" update `thm_default_caption` set `caption`='" . $caption . "' 
                            where `id`='" . $id . "' and `id_lang`='" . $id_lang . "' ; ");
        }
    }
}

if(isset($_GET['hrefs'])){
    $db_href = new db();
    $hrefs = $db_href->get_results(" select * from `thm_default_slider` ;");
    $hrefs_get = $_GET['hrefs'];
    
    foreach($hrefs as $href){
        $id = $href->id;
        if(isset($hrefs_get[$id])){
            $href_new = InputFilter($hrefs_get[$id]);
            $db_href->query("update `thm_default_slider` set `href`='".$href_new."'
                where `id`='".$id."' ; ");
        }
        
    }
    
    
    
}

if (isset($_GET['instagram_link'])) {
    $instagram_link = InputFilter($_GET['instagram_link']);
} else {
    $instagram_link = '';
}

if (isset($_GET['rss_link']) ){
    $rss_link = InputFilter($_GET['rss_link']);
} else {
    $rss_link = '';
}

if (isset($_GET['youtube_link'])) {
    $youtube_link = InputFilter($_GET['youtube_link']);
} else {
    $youtube_link = '';
}


if (isset($_GET['googleplus_link'])) {
    $googleplus_link = InputFilter($_GET['googleplus_link']);
} else {
    $googleplus_link = '';
}


if (isset($_GET['twitter_link'])) {
    $twitter_link = InputFilter($_GET['twitter_link']);
} else {
    $twitter_link = '';
}

if (isset($_GET['facebook_link']) ){
    $facebook_link = InputFilter($_GET['facebook_link']);
} else {
    $facebook_link = '';
}

if (isset($_GET['red_link'])) {
    $red_link = InputFilter($_GET['red_link']);
} else {
    $red_link = '';
}

if (isset($_GET['magneta_link'])) {
    $magneta_link = InputFilter($_GET['magneta_link']);
} else {
    $magneta_link = '';
}

if (isset($_GET['green_link'])) {
    $green_link = InputFilter($_GET['green_link']);
} else {
    $green_link = '';
}

if (isset($_GET['yellow_link'])) {
    $yellow_link = InputFilter($_GET['yellow_link']);
} else {
    $yellow_link = '';
}

if (isset($_GET['display_slider_caption']) ){
    $display_slider_caption = InputFilter($_GET['display_slider_caption']);
} else {
    $display_slider_caption = 0;
}

if (isset($_GET['color']) ){
    $color = InputFilter($_GET['color']);
} else {
    $color = 'blue';
}

$file_content = '<?php
if (!isset($project)) {
    header("location: ../../");
} // this section to avoid direct hack attack to this file 
?>
<?php
global $default_global;
$default_global["color"] = "' . $color . '" ;
$default_global["display_slider_caption"] = ' . $display_slider_caption . ' ;
$default_global["instagram_link"] = "' . $instagram_link . '";
$default_global["rss_link"] = "' . $rss_link . '";
$default_global["youtube_link"] = "' . $youtube_link . '";
$default_global["googleplus_link"] = "' . $googleplus_link . '";
$default_global["twitter_link"] = "' . $twitter_link . '";
$default_global["facebook_link"] = "' . $facebook_link . '";
$default_global["red_link"] = "' . $red_link . '";
$default_global["magneta_link"] = "' . $magneta_link . '";
$default_global["green_link"] = "' . $green_link . '";
$default_global["yellow_link"] = "' . $yellow_link . '";
?>';

file_put_contents('../config.php', $file_content);

echo 1;
?>