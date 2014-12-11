<?php
global $Lang;
$ptHome = 'http://phptransformer.com/release/Prog-pages_Lang-'.$Lang.'-1.pt';
?>
<div style="width:975px; float:left; background-color: #fff;"> 
    <div class="footer">
        <div class="upper_footer">
            <div class="connected">
                <div class="connected_header">
                    <?= stay_connected ?>
                </div>
                <div class="connected_body">

                    <?php
                    $careers_link = CreateLink("", array("Prog"), array("careers"));
                    $tellfriend_link = CreateLink("", array("Prog"), array("tellfriend"));

                    echo '<a href="' . $tellfriend_link . '" >' . send_message . '</a><br/>';
                    echo '<a href="' . $careers_link . '" >' . join_us . '</a>';
                    ?>
                </div>
            </div>
            <div class="social_links">

                <a href="
                <?php
                global $default_global;
                echo $default_global['instagram_link'];
                ?>">
                    <div class="social_link">
                        <img src="Themes/{ThemeName}/img/Instagram.png"/>
                    </div>
                </a>
                <a href="
                <?php
                echo $default_global['rss_link'];
                ?>">
                    <div class="social_link">
                        <img src="Themes/{ThemeName}/img/rss.png"/>
                    </div>
                </a>
                <a href="
                <?php
                echo $default_global['youtube_link'];
                ?>">
                    <div class="social_link">
                        <img src="Themes/{ThemeName}/img/youtube.png"/>
                    </div>
                </a>
                <a href="
<?php
echo $default_global['googleplus_link'];
?>">
                    <div class="social_link">
                        <img src="Themes/{ThemeName}/img/googleplus.png"/>
                    </div>
                </a>
                <a href="
<?php
echo $default_global['twitter_link'];
?>">
                    <div class="social_link">
                        <img src="Themes/{ThemeName}/img/twitter.png"/>
                    </div>
                </a>
                <a href="
<?php
echo $default_global['facebook_link'];
?>">
                    <div class="social_link">
                        <img src="Themes/{ThemeName}/img/facebook.png"/>
                    </div>
                </a>


            </div>


        </div>


        <div class="lower_footer">
            <div class="details">
<?= office_address; ?><br/>
<?= email_contact; ?><br/>
<?= phone_number; ?>
            </div>
        </div>
    </div> 
    <div class="div_copyright" >
        	{DevelopedAndDesignedby}
		&nbsp; 
		<a href="<?php echo $ptHome ?>" title="">
		{SpecialText}
		</a>
		&nbsp; 
		{AllRightReserved}
    </div>
</div>