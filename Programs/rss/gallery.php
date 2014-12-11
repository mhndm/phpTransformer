<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	Descriptions:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com +961-3-687150.
 *
 * ********************************************* */
?>
<?php

if (!isset($project)) {
    header("location: ../../");
} // this section to avoid direct hack attack to this file 
?> 
<?php
global $idLang;

//get IdLang
ExcuteQuery('SELECT `IdLang`FROM `languages` WHERE `LangName`="' . $Lang . '";');
if ($TotalRecords > 0) {
    $IdLang = $Rows['IdLang'];
}

$Newsquery = 'SELECT * FROM `gallery` 
                where
                lower(`MediaType`) = "jpg" or 
                lower( `MediaType`) = "png" or
                lower( `MediaType`) = "gif"
    
            order by `IdMedia` DESC;';

global $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;
$NewsRecordset = mysqli_query($conn,$Newsquery)  ;
$NewsTotalRecords = mysqli_num_rows($NewsRecordset);
if ($NewsTotalRecords > 0) {
    if ($NewsMaxNbr >= $NewsTotalRecords) {
        $ActiveNews = $NewsTotalRecords;
    } else {
        $ActiveNews = $NewsMaxNbr;
    }//end if
    for ($i = 0; $i < $ActiveNews; $i++) {
        $NewsRows = mysqli_fetch_assoc($NewsRecordset);
        $IdMedia = $NewsRows['IdMedia'];
        $Path = $NewsRows['Path'];
        //echo $IdUserName;
        $AddDate = $NewsRows['AddDate'];
        //date RFC822 format ex: Wed, 02 Oct 2002 13:00:00 GMT
        $Date = date("D, d M Y H:i:s T", strtotime($Date));
        $Date = str_replace("UTC", "GMT", $Date);
        $MediaType = $NewsRows['MediaType'];
        //get IdCat
        ExcuteQuery('SELECT `Caption` FROM `gallerylang` 
                        WHERE `IdLang`="'.$idLang.'" and 
                            `IdMedia`="' . $IdMedia . '"
                                
                    ;');

        $Caption = $Rows['Caption'];

        $NewsPic = '&lt;img title="'.$Caption.'" alt="'.$Caption.'" src="' . $WebsiteUrl . $Path . '"/&gt;';
        $Vars = array("Prog", "galid");
        $Vals = array("gallery", $IdNews);
        $LinkId = htmlspecialchars(CreateLink("", $Vars, $Vals), ENT_QUOTES);
        $LinkId = str_ireplace($WebsiteUrl, "", $LinkId);
        $LinkId = $WebsiteUrl . $LinkId;
        
        
        $Vars = array("Prog", "ns", "idnews");
        $Vals = array("news", "addcmnt", $IdNews);
        $CommentId = htmlspecialchars(CreateLink('', array('Prog', 'add', 'galid'), array('gallery', 'cmnt', $IdMedia)));
        
        $CommentId = str_ireplace($WebsiteUrl, "", $CommentId);
        $CommentId = $WebsiteUrl . $CommentId ;

        echo '
		<item>
	    <link>' . $LinkId . '</link>
	    <guid>' . $LinkId . '</guid>
	    <title>' . $Tilte . '</title>
	    <description>' . $NewsPic . ' ' . $Caption . '</description>
	    <pubDate>' . $Date . '</pubDate>
	    <category>Gallery</category>
		<comments>' . $CommentId . '</comments>
	    </item>';
    }//end for
}//end if


echo '
</channel>
</rss>';

function getFilePlayer($Filext, $Width= '480', $Height = '390', $Path=null, $WithComments=true) {
    // you can set the path for the file by args 
    global $SavePath, $galid, $LimitSpeed, $WebsiteUrl, $Caption, $EchoThem;
    if (!isset($Path)) {
        global $Path;
    }

    $Img = array('jpg', 'png', 'gif', 'bmp');
    $Flv = array('flv', 'FLV');
    $MediaPlayer = array('mp3', 'wma', 'wmv', 'mpeg', 'mpg',);
    $RealPlayer = array('rm', 'ra');
    $Flash = array('swf');
    $Docs = array('ods', 'odt', 'odp', 'odg', 'pdf', 'PDF', 'ppt', 'pptx', 'tiff', 'doc', 'docx', 'xls', 'xlsx', 'rtf', 'txt');
    $YouTube = array('youtube', 'YOUTUBE');

    foreach ($Docs as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {
            echo '<div id="albumDocs"><iframe src="http://docs.google.com/viewer?url=' . $WebsiteUrl . '/' . $Path
            . '&embedded=true" width="750" height="1055" style="border: none;"></iframe></div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
        }//end if
    }//end for each

    foreach ($Img as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {

            // get the medium size
            $old_Path = $Path;
            $last_slash = strrpos($Path, '/');
            $first_port = substr($Path, 0, $last_slash);
            $last_port = substr($Path, $last_slash, strlen($Path));
            $Path = $first_port . '/medium' . $last_port;

            if (is_file($Path)) {
                list($srcW, $srcH, $srcType, $html_attr) = getimagesize($Path);
                if ($Width > $srcW) {
                    $Width = $srcW;
                }
                if ($Height > $srcH) {
                    $Height = $srcH;
                }

                $FixImageSize = FixImageSize($srcW, $srcH, $Width, $Height);
                $newW = $FixImageSize[0];
                $newH = $FixImageSize[1];
            } else {
                $Path = $old_Path;
                $newW = 1;
                $newH = 1;
            }
            echo '<div id="albumImg" ><img width="' . $newW . '" height="' . $newH
            . '" alt="' . $Caption . '" title="' . $Caption . '" src="' . $Path . '" border="1" /></div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
        }//end if
    }//end for each

    foreach ($Flash as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {
            //$FlashFile 		= str_replace('Programs/gallery/','../../',$Path );
            $FlashFile = $Path;
            $Flash = get_include_contents('Programs/gallery/Players/Flash/code.php');
            $Flash = VarTheme('{swfMovie}', $FlashFile, $Flash);
            $Flash = VarTheme('{FWidth}', $Width, $Flash);
            $Flash = VarTheme('{FHeight}', $Height, $Flash);
            echo '<div  id="albumFlash" >' . $Flash . '</div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
        }//end if
    }//end for each

    foreach ($Flv as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {
            $VideoFile = str_replace('Programs/gallery/', '../../', $Path);
            $VideoWidth = $Width;
            $VideoHeight = $Height;
            $VideoFlv = get_include_contents('Programs/gallery/Players/Flv/code.php');
            $VideoFlv = VarTheme('{VideoFlv}', $VideoFile, $VideoFlv);
            $VideoFlv = VarTheme('{VideoWidth}', $VideoWidth, $VideoFlv);
            $VideoFlv = VarTheme('{VideoHeight}', $VideoHeight, $VideoFlv);
            echo '<div  id="albumFlv" >' . $VideoFlv . '</div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
        }//end if
    }//end for each

    foreach ($MediaPlayer as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {
            $WMfile = $Path;
            $WMplayer = get_include_contents('Programs/gallery/Players/MediaPlayer/code.php');
            $WMplayer = VarTheme('{WMfile}', $WMfile, $WMplayer);
            $WMplayer = VarTheme('{WMwidth}', $Width, $WMplayer);
            $WMplayer = VarTheme('{WMheight}', $Height, $WMplayer);
            echo '<div id="albumMediaPlayer" >' . $WMplayer . ' </div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
        }//end if
    }//end for each

    foreach ($RealPlayer as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {
            $RAfile = $Path;
            $RAplayer = get_include_contents('Programs/gallery/Players/RealPlayer/code.php');
            $RAplayer = VarTheme('{RAfile}', $RAfile, $RAplayer);
            $RAplayer = VarTheme('{RAwidth}', $Width, $RAplayer);
            $RAplayer = VarTheme('{RAheight}', $Height, $RAplayer);
            echo '<div id="albumRealPlayer" >' . $RAplayer . ' </div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
        }//end if
    }//end for each

    foreach ($YouTube as $ext) {
        if (strtolower($ext) == strtolower($Filext)) {

            $YouTubeFile = explode('/', $Path);
            $YouTubeFile = $YouTubeFile[count($YouTubeFile) - 1];
            $YouTubeID = substr($YouTubeFile, 0, strlen($YouTubeFile) - 8);
            $YouTubeplayer = get_include_contents('Programs/gallery/Players/youtube/code.php');
            $YouTubeplayer = VarTheme('{YouTubeID}', $YouTubeID, $YouTubeplayer);
            $YouTubeplayer = VarTheme('{YTwidth}', $Width, $YouTubeplayer);
            $YouTubeplayer = VarTheme('{YTheight}', $Height, $YouTubeplayer);
            $SavePath = 'http://www.savevid.com/?url=http://www.youtube.com/watch?v=' . $YouTubeID;
            echo '<div id="albumRealPlayer" >' . $YouTubeplayer . ' </div>';
            if ($WithComments) {
                return getMediaComment($galid);
            }
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
    echo '<div id="albumTumb" ><img src="' . $FileThumb . '" border=0 /></div>';
    if ($WithComments) {
        return getMediaComment($galid);
    }
}

?>