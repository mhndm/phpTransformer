<?php
global $Lang;
if (is_file("Themes/Default/config.php")) {
    include_once "Themes/Default/config.php";
} else {

    $default_global = array();
    $default_global['instagram_link'] = '';
    $default_global['youtube_link'] = '';
    $default_global['googleplus_link'] = '';
    $default_global['twitter_link'] = '';
    $default_global['facebook_link'] = '';
    $default_global['red_link'] = '';
    $default_global['magneta_link'] = '';
    $default_global['green_link'] = '';
    $default_global['yellow_link'] = '';
    $default_global['rss_link'] = '';
    $default_global["display_slider_caption"] = 0;
}
if (is_file("Themes/Default/admin/Languages/lang-" . $Lang . ".php")) {
    include_once "Themes/Default/admin/Languages/lang-" . $Lang . ".php";
} else {
    include_once "Themes/Default/admin/Languages/lang-English.php";
}
?>
<style>
    .theme_container_theme{
        width:100%;
        float:<?php echo lang_float; ?>;
        min-height: 100px;
        overflow: hidden;
    }
    .theme_container_theme div{
        float:<?php echo lang_float; ?>;
    }
    .theme_container_theme .theme_full_line{
        width:100%;
        border-bottom:2px dotted #61A0D6;
        margin:2px;
        padding:5px;
    }
    .theme_container_theme .theme_full_line:hover{
        background-color: #AECEEA;
    }
    .theme_full_line .theme_line_type{
        width:255px;
    }
    .theme_full_line .theme_line_value{
        width:400px;
    }
    input:focus{
        background-color: #CFE2F3;
    }
    .slider_div {
        border:2px dotted #61A0D6;
        float:<?php echo lang_float; ?>;
    }
</style>
<div>
    <h3> <?php echo Theme_Options; ?></h3>
    <div style="margin-bottom:10px;">
        <?php
        if($default_global["color"] == 'green'){
            $blue = ' ';
            $red = ' ';
            $green = ' checked ';
        }elseif($default_global["color"] == 'red'){
            $blue = ' ';
            $red = ' checked ';
            $green = ' ';
        }else{
            $blue = ' checked ';
            $red = '  ';
            $green = ' ';
        }
        
        
        ?>
        main_color : 
        <input <?= $blue ?> value="blue" name="color" type="radio" id="blue"/><label for="blue" <span style="background-color: blue;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>&nbsp;&nbsp;&nbsp;
        <input <?= $green ?> value="green"  name="color" type="radio" id="greeen"/><label for="greeen" <span style="background-color: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>&nbsp;&nbsp;&nbsp;
        <input <?= $red ?> value="red"  name="color" type="radio" id="red"/><label for="red" <span style="background-color: red;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></label>&nbsp;&nbsp;&nbsp;
   
    </div>
</div>
<?= slider ?> :
<div class="slider_div" > 
    <?php
    global $WebiteFolder;
    $path_slider = "Themes/Default/slider/img";
    $UploadDir = dirname(__FILE__);
    $UploadDir = str_replace("\\", "/", $UploadDir); // fix Windows OS directory path bug
    $UploadDir = str_replace("//", "/", $UploadDir); // fix linux OS directory path bug
    $UploadDir = str_replace("Themes/Default/admin", $path_slider, $UploadDir);

    $delurl = 'Themes/Default/admin/jQueryFileUploadmaster/server/php/?file=';
    $pathedit = $UploadDir . '/';
    $urledit = str_replace($UploadDir, '/' . $WebiteFolder . '/' . $path_slider . '/', $UploadDir);

    include_once 'Themes/Default/admin/add_files.php';
    ?>
    <?= slider_captions; ?> :
    <div id="thm_slider_captions">
    </div>
    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo display_slider_caption; ?>:
        </div>
        <div class="theme_line_value">
            <?php
            if ($default_global["display_slider_caption"]) {
                $yes_sel = ' selected ';
                $no_sel = ' ';
            } else {
                $yes_sel = ' ';
                $no_sel = ' selected ';
            }
            ?>
            <select name="display_slider_caption"/>
            <option <?= $yes_sel ?> value="1"><?= yes ?></option>
            <option <?= $no_sel ?> value="0"><?= no ?></option>
            </select>

        </div>
    </div>
</div>


<div class="theme_container_theme">


    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo theme_logo; ?> :
        </div>
        <div class="theme_line_value">
            <a href="admin/includes/webfolder/index.php?action=list&dir=Themes%2FDefault%2Fimg&order=name&srt=yes&lang=<?php echo $Lang; ?>" /><?php echo theme_logo_folder; ?></a>
        </div>
    </div>  

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo theme_menu; ?> :
        </div>
        <div class="theme_line_value">
            <a href="<?php echo AdminCreateLink("", array("todo"), array("layersmenu")); ?>" /><?php echo theme_menu_app; ?> </a>
        </div>
    </div>      
    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo theme_home_app; ?> :
        </div>
        <div class="theme_line_value">
            <a href="<?php echo AdminCreateLink("", array("todo", "subdo", "ProgTrans", "TransLang"), array("Translations", "EditTrans", "home", $Lang)); ?>" /><?php echo home_translations; ?> </a>
        </div>
    </div>      

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo theme_footer_trans; ?> :
        </div>
        <div class="theme_line_value">
            <a href="<?php echo AdminCreateLink("", array("todo", "subdo", "ThemeTrans", "TransLang"), array("Translations", "EditTrans", "Default", $Lang)); ?>" /><?php echo theme_footer_trans_text; ?> </a>
        </div>
    </div>  


    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo instagram_link; ?> :
        </div>
        <div class="theme_line_value">
            <input  dir="ltr" type="text" style="width:500px;" name="instagram_link" value="<?php echo $default_global['instagram_link']; ?>" />

        </div>
    </div>       
    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo rss_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="rss_link" value="<?php echo $default_global['rss_link']; ?>" />

        </div>
    </div>  

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo youtube_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="youtube_link" value="<?php echo $default_global['youtube_link']; ?>" />

        </div>
    </div>  

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo googleplus_link; ?> :
        </div>
        <div class="theme_line_value">
            <input  dir="ltr" type="text" style="width:500px;" name="googleplus_link" value="<?php echo $default_global['googleplus_link']; ?>" />

        </div>
    </div>  

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo twitter_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="twitter_link" value="<?php echo $default_global['twitter_link']; ?>" />

        </div>
    </div>  

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo facebook_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="facebook_link" value="<?php echo $default_global['facebook_link']; ?>" />

        </div>
    </div>  

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo red_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="red_link" value="<?php echo $default_global['red_link']; ?>" />

        </div>
    </div>      

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo magneta_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="magneta_link" value="<?php echo $default_global['magneta_link']; ?>" />

        </div>
    </div>      

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo green_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="green_link" value="<?php echo $default_global['green_link']; ?>" />

        </div>
    </div>      

    <div class="theme_full_line">
        <div class="theme_line_type">
            <?php echo yellow_link; ?> :
        </div>
        <div class="theme_line_value">
            <input dir="ltr" type="text" style="width:500px;" name="yellow_link" value="<?php echo $default_global['yellow_link']; ?>" />

        </div>
    </div>      

</div>
<input style="float:<?= lang_float ?>" class="submit" type="button" id="save_thm" value="save"/>
<script>
    $(document).ready(function(){
        
        $("#save_thm").on("click",function(){
            var get_url='';
            $(".captions").each(function(id,item){
            
                var myname = $(item).attr("name");
                get_url += '&'+myname+'=' +$("[name='"+myname+"']").val();
           
            });
            $(".hrefs").each(function(id,item){
            
                var myname = $(item).attr("name");
                get_url += '&'+myname+'=' +$("[name='"+myname+"']").val();
           
            });
            get_url += '&color=' +$("[name='color']:checked").val();
            get_url += '&display_slider_caption=' +$("[name='display_slider_caption']").val();
            get_url += '&instagram_link=' +$("[name='instagram_link']").val();
            get_url += '&rss_link=' +$("[name='rss_link']").val();
            get_url += '&youtube_link=' +$("[name='youtube_link']").val();
            get_url += '&googleplus_link=' +$("[name='googleplus_link']").val();
            get_url += '&twitter_link=' +$("[name='twitter_link']").val();
            get_url += '&facebook_link=' +$("[name='facebook_link']").val();
            get_url += '&red_link=' +$("[name='red_link']").val();
            get_url += '&magneta_link=' +$("[name='magneta_link']").val();
            get_url += '&green_link=' +$("[name='green_link']").val();
            get_url += '&yellow_link=' +$("[name='yellow_link']").val();
            
            $.get("Themes/Default/admin/save_thm.php?"+get_url,function(data){
                if(data==1){
                    $('#save_thm').after('<span  style="margin:10px;color:green; float:<?= lang_float ?>" ><?= thm_info_saved ?></span>');
                }
            });
            
        });
        
    });
    
    
</script>