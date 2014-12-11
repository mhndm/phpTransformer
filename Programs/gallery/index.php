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

global $CustomHead, $galid, $Path, $TitlePage, $TheNavBar, $Lang, $LimitSpeed, $Caption, $ThemeName, $EchoThem;
$TitlePage .= ' .:. ' . Gallery;
$LimitSpeed = true; // set this var to true to limit and hide file name download


if (isset($_GET['download'])) {
    $IdMedia = InputFilter($_GET['download']);
    $db = new db();
    $Path = $db->get_var("select `Path` from `gallery` where `IdMedia`='" . $IdMedia . "';");
    $MediaType = $db->get_var("select `MediaType` from `gallery` where `IdMedia`='" . $IdMedia . "';");
    $language = new db();
    $IdLang = $language->get_var('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
    $dbMedia = new db();
    $GalLang = $dbMedia->get_results("SELECT * FROM `gallerylang` WHERE `IdMedia`='" . $IdMedia . "' and `IdLang`='" . $IdLang . "';");
    foreach ($GalLang as $data) {
        if ($data->Caption != '' and $data->Caption != 'folder') {
            $download_file = $data->Caption . '.' . $MediaType;
        } else {
            $download_file = $Path;
        }//end if
    }//end for each

    return DownloadLimit($Path, $download_file, 128);
    //return false;
}//end if

$TheNavBar[] = array(Gallery, CreateLink("", array("Prog"), array("gallery")));

if (isset($_GET['show'])) {
    $show = InputFilter($_GET['show']);
} else {
    $show = 'all';
}

if (isset($_GET['galid'])) {
    $galid = InputFilter($_GET['galid']);
} else {
    $galid = '';
}

if (isset($_GET['NoThm'])) { // for showing the player only without theme
    if ($_GET['NoThm'] == 1) {
        $EchoThem = false;
        if (is_file("Programs/gallery/Themes/'.$ThemeName.'/style.css")) {
            echo '<link rel="stylesheet" type="text/css" href="Programs/gallery/Themes/' . $ThemeName . '/style.css"/>';
        } else {
            echo '<link rel="stylesheet" type="text/css" href="Programs/gallery/Themes/Default/style.css"/>';
        }
    }
}

include("class_thumbs.php");
include("class_dias.php");
include("watermark.php");

if (isset($_GET['add'])) {
    if ($_GET['add'] == 'cmnt') {
        //show add comment form
        addComment($galid);
    } else {
        // scroller("uploads/gallery/Albums");
        ShowAlbum("uploads/gallery/Albums");
    }//end if
} else {
    //echo 'show album or media';
    if ($galid == '') {
        //scroller("uploads/gallery/Albums");
        ShowAlbum("uploads/gallery/Albums");
    } else {
        //get path for this album from db
        $db = new db();
        $Path = $db->get_var("SELECT `Path` FROM `gallery` where `IdMedia`='" . $galid . "';");
        $MediaType = $db->get_var("SELECT `MediaType` FROM `gallery` where `IdMedia`='" . $galid . "';");
        $IdLang = $db->get_var("SELECT `IdLang` FROM `languages` where `LangName`='" . $Lang . "';");
        $Caption = $db->get_var("SELECT `Caption` FROM `gallerylang` where `IdMedia`='" . $galid . "' and `IdLang`='" . $IdLang . "';");
        //echo $MediaType;
        if ($Path) {
            if ($MediaType == 'folder') {

                ShowAlbum($Path);
            } else {
                echo getFilePlayer($MediaType);
            }//end if

            if ($Caption != "") {
                $picname = $Caption;
            } else {
                if (is_dir($Path)) {
                    $picname = substr($Path, strrpos($Path, "/") + 1);
                } else {
                    $DotPlace = strrpos($Path, ".");
                    $picname = substr($Path, strrpos($Path, "/") + 1, -1 * (strlen($Path) - $DotPlace));
                }//end if
            }//end if
            $TitlePage .= ' .:. ' . $picname;
            // create the nav bar
            $pos = -1;
            $PrevPath = '';
            $CurrentPath = str_replace('uploads/gallery/Albums/', '', $Path);
            $PathArray = explode('/', $CurrentPath);
            for ($i = 0; $i < count($PathArray); $i++) {
                if ($i == 0) {
                    $CurrentDir = 'uploads/gallery/Albums/' . $PathArray[$i];
                } else {
                    $PrevPath .= '/' . $PathArray[$i - 1];
                    $CurrentDir = 'uploads/gallery/Albums' . $PrevPath . '/' . $PathArray[$i];
                }//end if

                $dbDIR = new db();
                $IdMediaDIR = $dbDIR->get_var("SELECT `IdMedia` FROM `gallery` where `Path`='" . $CurrentDir . "';");
                $CaptionDIR = $dbDIR->get_var("SELECT `Caption` FROM `gallerylang` where `IdMedia`='" . $IdMediaDIR . "' and `IdLang`='" . $IdLang . "';");
                $Link = CreateLink('', array('Prog', 'show', 'galid', 'title'), array('gallery', 'all', $IdMediaDIR, str_replace(" ", "_", subwords($picname, 0, 35))));

                if ($CaptionDIR) {
                    $TheNavBar[] = array($CaptionDIR, $Link);
                    $TitlePage .= ' .:. ' . $CaptionDIR;
                } else {
                    if (is_dir($CurrentDir)) {
                        $TheNavBar[] = array($PathArray[$i], $Link);
                    } else {
                        $DotPlace = strrpos($Path, ".");
                        $TheNavBar[] = array(substr($PathArray[$i], 0, strlen($PathArray[$i]) - 1 * (strlen($Path) - $DotPlace)), $Link);
                    }//end if
                }
            }//end for
        } else {
            //  scroller("uploads/gallery/Albums");
            ShowAlbum("uploads/gallery/Albums");
        }//end if
    }//end if
}//end if

function addComment($IdMedia) {
    global $NickName, $GuestCanWrite, $ThemeName, $TheNavBar;
    $BackLink = CreateLink('', array('Prog', 'show', 'galid'), array('gallery', 'all', $IdMedia));
    //echo '<a href="'.$BackLink.'" >'. (backToTheMedia).'</a>';
    $TheNavBar[] = array((backToTheMedia), $BackLink);
    if ($IdMedia != '') {
        // cheking current user login
        if ($NickName === "Guest") {
            // for geust users
            if ($GuestCanWrite == 1) {
                if (is_file('Themes/' . $ThemeName . '/AddComment.php')) {
                    include_once('Themes/' . $ThemeName . '/AddComment.php');
                } else {
                    include_once('Themes/Default/AddComment.php');
                }
            } else {
                //http://127.0.0.1/release/Prog-account_acnt-signup_Lang-Arabic_nl-1.pt
                $Link = CreateLink('', array('Prog', 'acnt'), array('account', 'signup'));
                echo '<a href="' . $Link . '" />' . GuestsMustRegisterTOAddComment . '</a>';
            }//end if
        } else {
            // for registered users
            if (is_file('Themes/' . $ThemeName . '/AddComment.php')) {
                include_once('Themes/' . $ThemeName . '/AddComment.php');
            } else {
                include_once('Themes/Default/AddComment.php');
            }
        }//end if
    } else {
        ShowAlbum("uploads/gallery/Albums");
    }//end if
}

//end function

function ShowAlbum($Path) {

    global $TheNavBar, $CustomHead, $ThemeName,$default_global;
    if (DirHtml == 'rtl') {
        $isRTL = ' isRTL :true';
    } else {
        $isRTL = ' isRTL :false';
    }
    $CustomHead .= '
                <script type="text/javascript">
		  $(document).ready(function() {
                        $(".fancybox-thumb").fancybox({
                                prevEffect	: "none",
                                nextEffect	: "none",
                                helpers	: {
                                        title	: {
                                                type: "outside"
                                        },
                                        thumbs	: {
                                                width	: 50,
                                                height	: 50
                                        }
                                }
                        });
                        
                        $(".various").fancybox({
                                    maxWidth	: 800,
                                    maxHeight	: 600,
                                    fitToView	: false,
                                    width		: "70%",
                                    height		: "70%",
                                    autoSize	: false,
                                    closeClick	: false,
                                    openEffect	: "none",
                                    closeEffect	: "none"
                           });



                });
		</script>
                    ';
    $galleryparamsDB = new db();
    $galleryparams = $galleryparamsDB->get_row('SELECT * FROM `galleryparams`;');
    if ($galleryparams) {
        $ThumbsWidth = $galleryparams->ThumbsWidth;
        $ThumbsHeight = $galleryparams->ThumbsHeight;
        $ColumsNbr = $galleryparams->ColumsNbr;
        $CellWidthMax = $galleryparams->CellWidthMax;
        $CellHeightMax = $galleryparams->CellHeightMax;
        $PrintFilenames = $galleryparams->PrintFilenames;
    } else {
        $ThumbsWidth = 200;
        $ThumbsHeight = 200;
        $ColumsNbr = 4;
        $CellWidthMax = 200;
        $CellHeightMax = 160;
        $PrintFilenames = 1;
    }

    echo '<div id="gallery" class="gallery">';
    //var_dump($galleryparams);
    $cThumbs = new Thumbs($Path, "", $ThumbsWidth, $ThumbsHeight, 0);
    // get the array of all found images and thumbs
    $mix = $cThumbs->getImages();
    // devide the mix into images- and thumbs-arrays
    list($images, $thumbs) = $mix;
    $color = $default_global["color"];
    // create a new Dia-Pannel
    $cDias = new Dias($images, $thumbs,$color);
    // print table (int columns, int cellWidth, int cellHeight, bool print-filenames)
    $cDias->output($ColumsNbr, $CellWidthMax, $CellHeightMax, $PrintFilenames); //number of colums //
    echo '</div>';
}

//end function

function getFilePlayer($Filext, $Width= '480', $Height = '390', $Path=null, $WithComments=true) {
    // you can set the path for the file by args 
    global $SavePath, $galid, $LimitSpeed, $WebsiteUrl, $Caption, $EchoThem;
    if (!isset($Path)) {
        global $Path;
    }

    $Img = array('jpg', 'png', 'gif', 'bmp','jpeg');
    $Flv = array('flv');
    $MediaPlayer = array('mp3', 'wma', 'wmv', 'mpeg', 'mpg','mp4');
    $RealPlayer = array('rm', 'ra');
    $Flash = array('swf');
    $Docs = array('ods', 'odt', 'odp', 'odg', 'pdf', 'ppt', 'pptx', 'tiff', 'doc', 'docx', 'xls', 'xlsx', 'rtf', 'txt');
    $YouTube = array('youtube');

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
                $newW = "600px";
                $newH = "600px";
            }
            echo '<div id="albumImg" ><img style="max-width:'.$newW.'; max-height:'.$newH.' ;" 
                    alt="' . $Caption . '" title="' . $Caption . '" src="' . $Path . '"  /></div>';
            
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
            echo '<div id="albumYouTube" >' . $YouTubeplayer . ' </div>';
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

function getMediaComment($IdMedia) {
    global $SavePath, $ThemeName, $ConvertAt, $Lang, $Path, $LimitSpeed;
    $i = 0;
    $language = new db();
    $IdLang = $language->get_var('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
    $dbMedia = new db();
    $GalLang = $dbMedia->get_results("SELECT * FROM `gallerylang` WHERE `IdMedia`='" . $IdMedia . "' and `IdLang`='" . $IdLang . "';");
    foreach ($GalLang as $data) {
        $AddCommentLink = CreateLink('', array('Prog', 'add', 'galid'), array('gallery', 'cmnt', $IdMedia));
        echo ' <div align="center"><strong>' . $data->Caption . '</strong></div>';

        if ($LimitSpeed) {
            if (isset($SavePath)) {
                $DownLink = $SavePath;
            } else {
                $DownLink = CreateLink('', array('Prog', 'download'), array('gallery', $IdMedia));
            }
        } else {
            if (isset($SavePath)) {
                $DownLink = $SavePath;
            } else {
                $DownLink = $Path;
            }
        }//end if
        echo ' <div align="center">
		<img src="Programs/gallery/Themes/' . $ThemeName . '/Images/save.gif" border="0" />
		<a href="' . $DownLink . '" target="_blank">' . (SaveMedia) . '</a>';
        echo ' | ';
        echo ' 	<img src="Programs/gallery/Themes/' . $ThemeName . '/Images/discuss.gif" border="0" />
		<a href="' . $AddCommentLink . '" >' . GalleryaddComment . '</a>
		</div>';
        echo $data->Desc . '<br/>';
        echo $data->Place . '<br/>';
        echo MakeTagsLinks($data->Tags) . '<br/>';
    }

    $db = new db();
    $MediaComment = $db->get_results("SELECT * FROM `galleryfav` where `IdMedia`='" . $IdMedia . "' order by `Date` desc ;");
    if ($MediaComment) {
        foreach ($MediaComment as $data) {
            $UserId = $data->UserId;
            //get NickName for this userid
            $dbUser = new db();
            $NickNameRecordset = $dbUser->get_results('SELECT * FROM `users` WHERE `UserId`="' . $UserId . '";');

            foreach ($NickNameRecordset as $dataUser) {
                $NickName = $dataUser->NickName;
                $UserName = $dataUser->UserName;
                $FamName = $dataUser->FamName;

                if ($NickName == 'Guest') {
                    $user_name = ' &nbsp; ';
                    $user_pic = 'images/avatars/default.jpg';
                } else {
                    $user_name = $UserName . ' ' . $FamName;
                    $user_pic = $dataUser->UserPic;
                }
                $UserMail = $dataUser->UserMail;
                $cc = $dataUser->Contry;
            }//end for
            // get country name for this country code
            $dbContry = new db();
            $Contry = $dbContry->get_var('SELECT `Contry` FROM `cclang` WHERE `cc`="' . $cc . '";');
            $CommentDate = $data->Date;
            $theComment = $data->Comment;

            if (is_file('Programs/gallery/Themes/' . $ThemeName . '/Comments.php')) {
                $CommentCode = get_include_contents('Programs/gallery/Themes/' . $ThemeName . '/Comments.php');
            } else {
                $CommentCode = get_include_contents('Programs/gallery/Default/Comments.php');
            }//end if

            $CommentCode = VarTheme('{ThemeName}', $ThemeName, $CommentCode);
            $CN = VarTheme('{CN}', $i+1, $CommentCode);
            $CommentTitle = VarTheme('{CommentTitle}', '', $CN);
            $Author = VarTheme('{Author}', (AuthorNickname), $CommentTitle);
            $ContryN = VarTheme('{Contry}', (UserContry), $Author);
            $email = VarTheme('{email}', (UserEmail), $ContryN);
            $Date = VarTheme('{Date}', (Date), $email);
            $AuthorName = VarTheme('{AuthorName}', $user_name, $Date);
            $ContryName = VarTheme('{ContryName}', $Contry, $AuthorName);
            $ContryName = VarTheme('{ContryName}', $Contry, $AuthorName);
            if ($ConvertAt == "1") {
                $emailAddress = VarTheme('{emailAddress}', $UserMail, $ContryName);
                $emailAddress = VarTheme('@', '<img src="Themes/' . $ThemeName . '/Images/at.gif" alt="@" border="0"/>', $emailAddress);
            } else {
                $emailAddress = VarTheme('{emailAddress}', $UserMail, $ContryName);
            }//end if

            $CommentDate = VarTheme('{CommentDate}', $CommentDate, $emailAddress);
            $theComment = VarTheme('{theComment}', ' <br /> ' . $theComment . ' <br />&nbsp; ', $CommentDate);
            $theComment = VarTheme('{user_pic}', '<img src="' . $user_pic . '" />', $theComment);

            $theComment = VarTheme('{reply}', '<a href="'.$AddCommentLink .'" >'.reply.'</a>' , $theComment);


            $ArrayData[$i] = $theComment;
            $i++;
        }//end for each
        $ArrayDataTab = Pagination($ArrayData, 10, 10);
        $getMediaComment = $ArrayDataTab[0];
        $getMediaComment .= $ArrayDataTab[1];
        /*
          $getMediaComment 	 = 	CreateNaviPage($ArrayData,$MaxResultPerPage=50,$ShowNaviBar=0).'<br/>';
          $getMediaComment 	.= 	CreateNaviPage($ArrayData,$MaxResultPerPage=50,$ShowNaviBar=1);
         */
    }//end if
    if (isset($getMediaComment)) {
        return $getMediaComment;
    } else {
        return '';
    }//end if
}

//end function

function getFileType($Filext) {
    $Videos = array('wmv', 'flv', 'swf', 'rm', 'avi', 'mpeg', 'mpg', 'youtube');
    $Sounds = array('mp3', 'wma', 'ra');
    $Docs = array('pdf', 'ppt', 'pptx', 'tiff',  'doc',  'docx',  'xls',  'xlsx', 'rtf', 'txt');

    foreach ($Docs as $ext) {
        if (strtolower($ext) == $Filext) {
            return 'docs';
        }//end if
    }//end for each


    foreach ($Videos as $ext) {
        if (strtolower($ext) == $Filext) {
            return 'videos';
        }//end if
    }//end for each
    foreach ($Sounds as $ext) {
        if (strtolower($ext )== $Filext) {
            return 'sounds';
        }//end if
    }//end for each

    return 'files';
}

//end function

function InfoInDatabase($Path) {
    global $Lang;
    $IdMedia = null;
    $i = 0;
    if ($Path) {
        $db = new db();
        $IdLang = $db->get_var("SELECT `IdLang` FROM `languages` where `LangName`='" . $Lang . "';");
        $db = new db();
        $IdMedia = $db->get_var("SELECT `IdMedia` FROM `gallery` where `Path`='" . $Path . "';");
        if ($IdMedia) {
            $db = new db();
            $InfoInDatabase = $db->get_results("SELECT * FROM `gallery`,`gallerylang`
					WHERE
					`gallery`.`IdMedia`=`gallerylang`.`IdMedia` and
					`gallerylang`.`IdLang`='" . $IdLang . "' and
					`gallery`.`Path`='" . $Path . "';");
            if ($InfoInDatabase) {
                foreach ($InfoInDatabase as $Record) {
                    $Info[0]['IdMedia'] = $Record->IdMedia;

                    //get the medium image
                    $last_slash = strrpos($Record->Path, '/');
                    $first_port = substr($Record->Path, 0, $last_slash);
                    $last_port = substr($Record->Path, $last_slash, strlen($Record->Path));
                    $Info[0]['Path'] = $first_port . '/medium' . $last_port;
                    if (!is_file($Info[0]['Path'])) {
                        $Info[0]['Path'] = $Record->Path;
                    }
                    $Info[0]['AddDate'] = $Record->AddDate;
                    $Info[0]['MapLocation'] = $Record->MapLocation;
                    $Info[0]['MediaRank'] = $Record->MediaRank;
                    $Info[0]['MediaType'] = $Record->MediaType;
                    $Info[0]['Caption'] = $Record->Caption;
                    $Info[0]['Desc'] = $Record->Desc;
                    $Info[0]['Place'] = $Record->Place;
                    $Info[0]['Tags'] = $Record->Tags;
                }//end for each
            }//end if

            $db = new db();
            $InfoInDatabase = $db->get_results("SELECT * FROM `galleryfav`
					WHERE
					`IdMedia` = '" . $IdMedia . "';");
            if ($InfoInDatabase) {

                foreach ($InfoInDatabase as $Record) {
                    $i++;
                    $Info[$i]['UserId'] = $Record->UserId;
                    $Info[$i]['Comment'] = $Record->Comment;
                    $Info[$i]['Date'] = $Record->Date;
                }//end for each
            }//end if

            return $Info;
        } else {
            return false;
        }//end if
    } else {
        return false;
    }//end if
}

//end function

function MakeTagsLinks($TagString) {
    $MakeTagsLinks = '';

    if ($TagString != '') {
        //Prog-gallery_show-all_galid-20080000003
        if (isset($_GET['galid'])) {
            $galid = InputFilter($_GET['galid']);
        } else {
            $galid = '';
        }//end if
        $Link = CreateLink('', array('Prog', 'show', 'galid'), array('gallery', 'all', $galid));
        $Strings = explode(" ", $TagString);
        foreach ($Strings as $word) {


            $MakeTagsLinks .='<a href="' . $Link . '">' . $word . '</a> ';
        }//end foreach
        return $MakeTagsLinks;
    } else {
        return false;
    }//end if
}

//end function
?>