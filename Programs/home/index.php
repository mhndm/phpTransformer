<?php
global $default_global;
?>
<div class="category_container">
    <div class="category_entry red">
        <div class="category_header"><a href="<?php echo $default_global['red_link']; ?>"><?php echo red_title; ?></a></div>
        <div class="category_logo">
            <a href="<?php echo $default_global['red_link']; ?>"> <img src="Themes/Default/img/pages.png"/></a>
        </div>
        <div class="category_details"><?php echo red_text; ?></div>
        <div class="category_more"><a href="<?php echo $default_global['red_link']; ?>"><?php echo read_more; ?> </a></div>
    </div>
    <div class="category_entry magneta">
        <div class="category_header"><a href="<?php echo $default_global['magneta_link']; ?>"><?php echo magneta_title; ?></a></div>
        <div class="category_logo">
            <a href="<?php echo $default_global['magneta_link']; ?>"> <img src="Themes/Default/img/news.png"/></a>
        </div>
        <div class="category_details"><?php echo magneta_text; ?></div>
        <div class="category_more"><a href="<?php echo $default_global['magneta_link']; ?>"><?php echo read_more; ?> </a></div>
    </div>

    <div class="category_entry green">
        <div class="category_header"><a href="<?php echo $default_global['green_link']; ?>"><?php echo green_title; ?></a></div>
        <div class="category_logo">
            <a href="<?php echo $default_global['green_link']; ?>"> <img src="Themes/Default/img/gallery.png"/></a>
        </div>
        <div class="category_details"><?php echo green_text; ?></div>
        <div class="category_more"><a href="<?php echo $default_global['green_link']; ?>"><?php echo read_more; ?> </a></div>
    </div>

    <div class="category_entry yellow">
        <div class="category_header"><a href="<?php echo $default_global['yellow_link']; ?>"><?php echo yellow_title; ?></a></div>
        <div class="category_logo">
            <a href="<?php echo $default_global['yellow_link']; ?>">  <img src="Themes/Default/img/contactus.png"/></a>
        </div>
        <div class="category_details"><?php echo yellow_text; ?></div>
        <div class="category_more"><a href="<?php echo $default_global['yellow_link']; ?>"><?php echo read_more; ?> </a></div>
    </div>
</div>
<?php
global $Lang, $idLang, $ThemeName;
//News ::

include_once('Programs/news/Languages/lang-' . $Lang . '.php');

$db_news = new db();
$latest_news = $db_news->get_row("SELECT * FROM `news` WHERE `Active`='1' and `Deleted`<>'1' order by `IdNews` DESC;");
$NewsLine = '';
if ($latest_news) {

    $IdNews = $latest_news->IdNews;
    $IdUserName = $latest_news->IdUserName;
    $Date = $latest_news->Date;
    $NewsPic = $latest_news->NewsPic;
    
    $db_new_lang = new db();
    $news_lang = $db_new_lang->get_row('SELECT * FROM `newslang` WHERE `IdLang`="' . $idLang . '" and `IdNews`="' . $IdNews . '";');
    if ($news_lang) {

        $Tilte = $news_lang->Tilte;
        $SubTitle = $news_lang->SubTitle;
        $Breif = $news_lang->Breif;
        // get theme and replace vars

        if (is_file('Programs/news/Themes/' . $ThemeName . '/NewsBrief.php')) {

            $Theme = get_include_contents('Programs/news/Themes/' . $ThemeName . '/NewsBrief.php');
        } else {
            $Theme = get_include_contents('Programs/news/Themes/Default/NewsBrief.php');
        }
        $Vars = array("Prog", "ns", "idnews");
        $Vals = array("news", "details", $IdNews);
        $LinkId = CreateLink("", $Vars, $Vals);
        $Theme = VarTheme('{ThemeName}', $ThemeName, $Theme);
        $NewsGroup = VarTheme('{NewsGroup}', '', $Theme);
        $NewsTitle = VarTheme('{NewsTitle}', '<a href="' . $LinkId . '" title="' . $Tilte . '" >' . $Tilte . '</a>', $NewsGroup);
        $NewsData = VarTheme('{NewsData}', $Breif, $NewsTitle);
        $NewsPic = '<img alt="' . $Tilte . '" src="uploads/news/pics/' . $NewsPic . '"/>';
        $img = VarTheme('{img}', $NewsPic, $NewsData);
        $NewsLine = VarTheme('{more}', '<a href="' . $LinkId . '" title="' . more . '" >' . more . '</a>', $img);
    }// end if
} else {
    echo SorryNewsInCurrentLang;
}

echo '<div class="news_home" ><div class="news_home_header">'.news.' : </div>' . $NewsLine;
echo '<div style="float:'.lang_float.';">' . ToViewOlderNewsPleaseSee . '
            <a href="' . CreateLink("", array("Prog", "ns"), array("news", "archive")) . '" > <strong>'
            . NewsArchive . ' </strong></a>
         </div>
      </div>
   
    <div class="gallery_home_header">
            '.Gallery.' : 
    </div>';

global $Lang , $Path, $Caption, $ThemeName;


include_once('Programs/gallery/Languages/lang-' . $Lang . '.php');

//get path for this album from db
$dbGal = new db();
$query = " SELECT * FROM `gallery` WHERE `MediaType`!='folder'  order by `AddDate` desc limit 0,6; ";
$Gal = $dbGal->get_results($query);

if ($Gal) {

    foreach ($Gal as $item) {
        $galid = $item->IdMedia;
        $db = new db();
        $Path = $db->get_var("SELECT `Path` FROM `gallery` where `IdMedia`='" . $galid . "';");
        $MediaType = $db->get_var("SELECT `MediaType` FROM `gallery` where `IdMedia`='" . $galid . "';");
        $IdLang = $db->get_var("SELECT `IdLang` FROM `languages` where `LangName`='" . $Lang . "';");
        $Caption = $db->get_var("SELECT `Caption` FROM `gallerylang` where `IdMedia`='" . $galid . "' and `IdLang`='" . $IdLang . "';");
        //echo $MediaType;
        if ($Path) {
            if ($Caption != "") {
                $picname = $Caption;
            } else {
                $DotPlace = strrpos($Path, ".");
                $picname = substr($Path, strrpos($Path, "/") + 1, -1 * (strlen($Path) - $DotPlace));
            }//end if
            $Link = CreateLink('', array('Prog', 'show', 'galid'), array('gallery', 'all', $galid));

            echo ' <div class="gallery_div_picture">
                            <a title="' . $picname . '" href="' . $Link . '">' . getFilePlayer($MediaType, 150, 150) . '<br/>' . $picname . '</a>
                        </div>';
        }
    }
  
}

$Link = CreateLink('', array('Prog'), array('gallery'));
echo '<div style="text-align:'.lang_float.'; float:'.lang_float.'; width:100%;">'.WelcomeGalleryAll . '<a title="' . Gallery . '" href="' . $Link . '">' . ClickHere . '</a></div>
    </div>';

function getFilePlayer($Filext, $Width= '480', $Height = '390') {

    global $SavePath, $galid, $Path, $LimitSpeed, $WebsiteUrl, $Caption;
    $Img = array('jpg','jpeg', 'png', 'gif', 'bmp', 'JPG','JPEG', 'PNG', 'GIF', 'BMP');
    $Flv = array('flv', 'FLV');
    $MediaPlayer = array('mp3', 'wma', 'wmv', 'MP3', 'WMA', 'WMV', 'mpeg', 'MPEG', 'MPEG', 'mpg', 'MPG');
    $RealPlayer = array('rm', 'ra', 'RM', 'RA');
    $Flash = array('swf', 'SWF');
    $Docs = array('pdf', 'PDF', 'ppt', 'PPT', 'pptx', 'PPTX', 'tiff', 'TIFF');
    $YouTube = array('youtube', 'YOUTUBE');

    foreach ($Docs as $ext) {
        if ($ext == $Filext) {
            //echo '<iframe src="http://docs.google.com/viewer?url='.$WebsiteUrl.'/'.$Path.'&embedded=true" width="750" height="1055" style="border: none;"></iframe>';
            return '<iframe src="http://docs.google.com/viewer?url=' . $WebsiteUrl . '/' . $Path . '&embedded=true" width="' . $Width . '" height="' . $Height . '" style="border: none;"></iframe>';
        }//end if
    }//end for each

    foreach ($Img as $ext) {
        if ($ext == $Filext) {

            $last_slash = strrpos($Path, '/');
            $path_before = substr($Path, 0, $last_slash);
            $image_file = substr($Path, $last_slash);
            $thumb_path = $path_before . '/thumbs' . $image_file;

            if (is_file($thumb_path)) {
                list($srcW, $srcH, $srcType, $html_attr) = @getimagesize($thumb_path);
                $FixImageSize = FixImageSize($srcW, $srcH, $Width, $Width);
                $newW = $FixImageSize[0];
                $newH = $FixImageSize[1];
                $Path = $thumb_path;
            } elseif(is_file($Path)) {
                
                list($srcW, $srcH, $srcType, $html_attr) = @getimagesize($Path);
                $FixImageSize = FixImageSize($srcW, $srcH, $Width, $Width);
                $newW = $FixImageSize[0];
                $newH = $FixImageSize[1];
                
            }else{
                $newW = 0;
                $newH = 0;
            }

            return '<img width="' . $newW . '" height="' . $newH . '" alt="' . $Caption . '" 
                            title="' . $Caption . '" src="' . $Path . '" border="0" />';
        }//end if
    }//end for each

    foreach ($Flash as $ext) {
        if ($ext == $Filext) {
            //$FlashFile 		= str_replace('Programs/gallery/','../../',$Path );
            $FlashFile = $Path;
            $Flash = get_include_contents('Programs/gallery/Players/Flash/code.php');
            $Flash = VarTheme('{swfMovie}', $FlashFile, $Flash);
            $Flash = VarTheme('{FWidth}', $Width, $Flash);
            $Flash = VarTheme('{FHeight}', $Height, $Flash);
            return '' . $Flash . '';
        }//end if
    }//end for each

    foreach ($Flv as $ext) {
        if ($ext == $Filext) {
            $VideoFile = str_replace('Programs/gallery/', '../../', $Path);
            $VideoWidth = $Width;
            $VideoHeight = $Height;
            $VideoFlv = get_include_contents('Programs/gallery/Players/Flv/code.php');
            $VideoFlv = VarTheme('{VideoFlv}', $VideoFile, $VideoFlv);
            $VideoFlv = VarTheme('{VideoWidth}', $VideoWidth, $VideoFlv);
            $VideoFlv = VarTheme('{VideoHeight}', $VideoHeight, $VideoFlv);
            return '' . $VideoFlv . '';
        }//end if
    }//end for each

    foreach ($MediaPlayer as $ext) {
        if ($ext == $Filext) {
            $WMfile = $Path;
            $WMplayer = get_include_contents('Programs/gallery/Players/MediaPlayer/code.php');
            $WMplayer = VarTheme('{WMfile}', $WMfile, $WMplayer);
            $WMplayer = VarTheme('{WMwidth}', $Width, $WMplayer);
            $WMplayer = VarTheme('{WMheight}', $Height, $WMplayer);
            return '' . $WMplayer . ' ';
        }//end if
    }//end for each

    foreach ($RealPlayer as $ext) {
        if ($ext == $Filext) {
            $RAfile = $Path;
            $RAplayer = get_include_contents('Programs/gallery/Players/RealPlayer/code.php');
            $RAplayer = VarTheme('{RAfile}', $RAfile, $RAplayer);
            $RAplayer = VarTheme('{RAwidth}', $Width, $RAplayer);
            $RAplayer = VarTheme('{RAheight}', $Height, $RAplayer);
            return '' . $RAplayer . ' ';
        }//end if
    }//end for each

    foreach ($YouTube as $ext) {
        if ($ext == $Filext) {
            /*

              $YouTubeFile = explode('/', $Path);
              $YouTubeFile = $YouTubeFile[count($YouTubeFile)-1];
              $YouTubeID = substr($YouTubeFile, 0, strlen($YouTubeFile)-8 );
              $YouTubeplayer 	= get_include_contents('Programs/gallery/Players/youtube/code.php');
              $YouTubeplayer 	= VarTheme('{YouTubeID}', $YouTubeID,$YouTubeplayer );
              $YouTubeplayer 	= VarTheme('{YTwidth}', $Width,$YouTubeplayer );
              $YouTubeplayer 	= VarTheme('{YTheight}', $Height,$YouTubeplayer );
              $SavePath = 'http://www.savevid.com/?url=http://www.youtube.com/watch?v='.$YouTubeID;
              return ''.$YouTubeplayer.' ';
             */

            $last_slash = strrpos($Path, '/');
            $path_before = substr($Path, 0, $last_slash);
            $image_file = substr($Path, $last_slash);
            $thumb_path = $path_before . '/thumbs' . $image_file . '.png';
            if (is_file($thumb_path)) {
                list($srcW, $srcH, $srcType, $html_attr) = getimagesize($thumb_path);
                $FixImageSize = FixImageSize($srcW, $srcH, $Width, $Width);
                $newW = $FixImageSize[0];
                $newH = $FixImageSize[1];
                $Path = $thumb_path;
            } else {
                $newW = 158;
                $newH = 158;
            }

            return '<img width="' . $newW . '" height="' . $newH . '" alt="' . $Caption . '" 
                            title="' . $Caption . '" src="' . $Path . '" border="0" />';
        }//end if
    }//end for each


    $pos = -1;
    $Lastpos = 0;
    while (($pos = strpos($Path, '/', $pos + 1)) !== false)
        $Lastpos = $pos;
    //echo $Path .'<br/>';
    $FileName = substr($Path, $Lastpos + 1, strlen($Path));
    $PathFileName = substr($Path, 0, $Lastpos + 1);
    $ThumbFileName = $PathFileName . 'thumbs/' . $FileName . '.png';
    if (is_file($ThumbFileName)) {
        $FileThumb = $ThumbFileName;
    } else {
        $FileThumb = 'Programs/gallery/images/' . getFileType($ext) . '.png';
    }//end if
    return '<img src="' . $FileThumb . '" border=0 />';
}

//end function

function getFileType($Filext) {
    $Videos = array('wmv', 'flv', 'swf', 'rm', 'avi', 'mpeg', 'mpg', 'youtube', 'YOUTUBE');
    $Sounds = array('mp3', 'wma', 'ra');
    $Docs = array('pdf', 'ppt', 'pptx', 'tiff');

    foreach ($Docs as $ext) {
        if ($ext == $Filext) {
            return 'docs';
        }//end if
    }//end for each


    foreach ($Videos as $ext) {
        if ($ext == $Filext) {
            return 'videos';
        }//end if
    }//end for each
    foreach ($Sounds as $ext) {
        if ($ext == $Filext) {
            return 'sounds';
        }//end if
    }//end for each

    return 'files';
}

//end function
?>