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

global $IsAdmin;
if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

global $ThemeName, $Lang;
include_once('Programs/gallery/admin/Languages/lang-' . $Lang . '.php');

$theList = ProgIconLink("gallery", "allMedia")
        . ProgIconLink("gallery", "GalleryParameter")
        . ProgIconLink("gallery", "ClearDB");

if (isset($_GET['galid'])) {
    $IdMedia = InputFilter($_GET['galid']);
} else {
    $IdMedia = 'uploads' . '/' . 'gallery' . '/' . 'Albums';
}//end if

if (!is_dir('uploads' . '/' . 'gallery' . '/' . 'Albums')) {
    if (is_writable('uploads' . '/' . 'gallery')) {
        mkdir('uploads' . '/' . 'gallery' . '/' . 'Albums');
    }
}
if (isset($_GET['subdo'])) {
    switch ($_GET['subdo']) {
        case "album_thumb":
            $theContent = album_thumb($IdMedia);
            break;
        case "upload_media":
            $theContent = upload_media($IdMedia);
            break;
        case "youtube":
            $theContent = youtube($IdMedia);
            break;
        case "allMedia":
            $theContent = allMedia($IdMedia);
            break;
        case "ClearDB":
            $theContent = ClearDB();
            break;
        case "addMedia":
            $theContent = addMedia();
            break;
        case "delMedia":
            $theContent = delMedia();
            break;
        case "editMedia":
            $theContent = editMedia();
            break;
        case "cmntMedia":
            $theContent = cmntMedia();
            break;
        case "GalleryParameter":
            $theContent = GalleryParameter();
            break;
        default :
            $theContent = allMedia($IdMedia);
    }//end switch
} else {
    $theContent = allMedia($IdMedia);
}//end if

$Gallery = get_include_contents("Programs/gallery/admin/SubContent.php");
$Gallery = VarTheme("{todoImg}", "gallery.png", $Gallery);
$Gallery = VarTheme("{ThemeName}", $ThemeName, $Gallery);
$Gallery = VarTheme("{List}", $theList, $Gallery);
$Gallery = VarTheme("{Content}", $theContent, $Gallery);

echo $Gallery;

function album_thumb($IdMedia) {
    global $TheNavBar, $Lang, $CustomHead, $WebiteFolder;

    $TheNavBar[] = array(BackToMedia, AdminCreateLink("", array("prog", "galid"), array("gallery", $IdMedia)));

    if (is_file($IdMedia . '/thumb.tmb')) {
        $current_thumb = '<img id="thumb"  src="' . $IdMedia . '/thumb.tmb' . '" />';
    } else {
        $current_thumb = '<img id="thumb"  src="Programs/gallery/images/album.png" />';
    }
    $CustomHead .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
                    <link href="Programs/gallery/admin/fileupload/client/fineuploader.css" rel="stylesheet" type="text/css"/>
                    <link href="css/styles.css" rel="stylesheet" type="text/css"/>
                    <script src="Programs/gallery/admin/fileupload/client/js/header.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/util.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/button.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/ajax.requester.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/deletefile.ajax.requester.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/handler.base.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/window.receive.message.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/handler.form.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/handler.xhr.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/uploader.basic.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/dnd.js"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/uploader.php?up=' . change_album_thumb . '&IdMedia=' . $IdMedia . '"></script>
                    <script src="Programs/gallery/admin/fileupload/client/js/jquery-plugin.js"></script>
                    ';
    if ($WebiteFolder == '' or $WebiteFolder == '/') {
        $CustomHead .= '<script src="Programs/gallery/admin/fileupload/js/uploader.php?path=/Programs/gallery/admin/fileupload/receiver/index.php?path=' . str_replace('uploads/gallery/Albums/', '', $IdMedia) . '"></script>';
    } else {
        $CustomHead .= '<script src="Programs/gallery/admin/fileupload/js/uploader.php?path=/' . $WebiteFolder . '/Programs/gallery/admin/fileupload/receiver/index.php?path=' . str_replace('uploads/gallery/Albums/', '', $IdMedia) . '"></script>';
    }

    $album_thumb = current_thumb_for_this_album . ' : <br/>' . $current_thumb . '<br/>' . thumb_notes;

    $album_thumb .='<ul id="basicUploadSuccessExample" class="unstyled"></ul>


<script type="text/javascript" language="javascript>">
$(document).ready(function() {
    $(".qq-upload-success").live("click",function(){
        d = new Date();
        $("#thumb").attr("src", "' . $IdMedia . '/thumb.tmb?"+d.getTime()); 
    });
});

</script>';

    return $album_thumb;
}

function youtube($IdMedia) {
    global $TheNavBar;
    include_once('Programs/gallery/watermark.php');
    $TheNavBar[] = array(BackToMedia, AdminCreateLink("", array("prog", "galid"), array("gallery", $IdMedia)));

    if (isset($_POST['youtube'])) {
        $url = PostFilter($_POST['url']);
        $youtube_file = parse_youtube_id($url);
        @copy('http://i1.ytimg.com/vi/' . $youtube_file . '/mqdefault.jpg', $IdMedia . '/thumbs/' . $youtube_file . '.youtube.png');
        $file = fopen($IdMedia . '/' . $youtube_file . '.youtube', "w");
        fclose($file);
        // Watermark($IdMedia . '/thumbs/' . $youtube_file . '.youtube.png', 'Programs/gallery/images/w_videos.png', $IdMedia . '/thumbs/' . $youtube_file . '.youtube.png');

        addMedia($IdMedia . '/' . $youtube_file . '.youtube');

        return $youtube_file . ' <br/>' . success_saved;
    } else {

        return '<form action="" method="post" > 
            ' . paste_the_youtube_url_here . ' : <br/>
            <input name="url" dir="ltr" class="text" type="text" style="width:500px;" /><br/>
            <input name="youtube" type="submit" class="submit" value="' . submit . '"/>
             </form>';
    }
}

function upload_media($IdMedia) {
    global $WebiteFolder, $TheNavBar;
    $TheNavBar[] = array(BackToMedia, AdminCreateLink("", array("prog", "galid"), array("gallery", $IdMedia)));

    $UploadDir = dirname(__FILE__);
    $UploadDir = str_replace("\\", "/", $UploadDir); // fix Windows OS directory path bug
    $UploadDir = str_replace("//", "/", $UploadDir); // fix linux OS directory path bug
    $UploadDir = str_replace("Programs/gallery/admin", $IdMedia, $UploadDir);

    $delurl = 'Programs/gallery/admin/jQueryFileUploadmaster/server/php/?file=';
    $pathedit = $UploadDir . '/';
    $urledit = str_replace($UploadDir, '/' . $WebiteFolder . '/' . $IdMedia . '/', $UploadDir);


    include_once 'Programs/gallery/admin/add_files.php';
    return $content;
}

function GalleryParameter() {
    global $ThemeName, $CustomHead;

    if (!isset($_POST['GalleryParameter'])) {
        $galleryparamsDB = new db();
        $galleryparams = $galleryparamsDB->get_row('SELECT * FROM `galleryparams`');
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
        if ($PrintFilenames == 1) {
            $PrintFilenamesYes = ' selected="selected" ';
            $PrintFilenamesNo = ' ';
        } else {
            $PrintFilenamesYes = '';
            $PrintFilenamesNo = ' selected="selected" ';
        }
        $CustomHead .='<script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                            document.getElementById("GalleryParameter").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>';
        $GalleryParameter = '<script src="Programs/gallery/admin/Themes/' . $ThemeName . '/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
                  <link href="Programs/gallery/admin/Themes/' . $ThemeName . '/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
                  <form id="form1" name="form1" method="post" action="">
                  <table border="0">
                    <tr>
                      <td>' . ThumbsWidth . '</td>
                      <td>
                      <span id="sprytextfield1">
                      <input value="' . $ThumbsWidth . '" class="text" name="ThumbsWidth" type="text" id="ThumbsWidth" size="6" maxlength="10" />
                        <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
                        <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
                        <span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span>
                         </span>
                      </td>
                    </tr>
                    <tr>
                      <td>' . ThumbsHeight . '</td>
                      <td>
                      <span id="sprytextfield2">
                      <input value="' . $ThumbsHeight . '" class="text" name="ThumbsHeight" type="text" id="ThumbsHeight" size="6" maxlength="10" />
                      <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
                        <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
                        <span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>' . ColumsNbr . '</td>
                      <td>
                      <span id="sprytextfield3">
                      <input value="' . $ColumsNbr . '"  class="text" name="ColumsNbr" type="text" id="ColumsNbr" size="6" maxlength="10" />
                        <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
                        <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
                        <span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span>
                        </span>
                      </td>
                    </tr>
                    <tr>
                      <td>' . CellWidthMax . '</td>
                      <td>
                      <span id="sprytextfield4">
                      <input value="' . $CellWidthMax . '"  class="text"  name="CellWidthMax" type="text" id="CellWidthMax" size="6" maxlength="10" />
                      <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
                        <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
                        <span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span>
                        </span>
                    </td>
                    </tr>
                    <tr>
                      <td>' . CellHeightMax . '</td>
                      <td>
                      <span id="sprytextfield5">
                      <input value="' . $CellHeightMax . '" class="text" name="CellHeightMax" type="text" id="CellHeightMax" size="6" maxlength="10" />
                        <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
                        <span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
                        <span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span>
                        </span>
                    </td>
                    </tr>
                    <tr>
                      <td>' . PrintFilenames . '</td>
                      <td>
                      <select class="select" name="PrintFilenames" id="PrintFilenames">
                        <option value="1" ' . $PrintFilenamesYes . ' >' . yes . '</option>
                        <option value="0" ' . $PrintFilenamesNo . ' >' . no . '</option>
                      </select></td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center"><input class="submit"  type="submit" name="GalleryParameter" id="GalleryParameter" value="' . save . '" /></td>
                    </tr>
                  </table>
                </form>
                <script type="text/javascript">
                                <!--
                                var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1","integer", {maxChars:10});
                                var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2","integer", {maxChars:10});
                                var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield3","integer", {maxChars:10});
                                var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield4","integer", {maxChars:10});
                                var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield5","integer", {maxChars:10});
                                //-->
                                </script>';
    } else {
        $ThumbsWidth = PostFilter($_POST['ThumbsWidth']);
        $ThumbsHeight = PostFilter($_POST['ThumbsHeight']);
        $ColumsNbr = PostFilter($_POST['ColumsNbr']);
        $CellWidthMax = PostFilter($_POST['CellWidthMax']);
        $CellHeightMax = PostFilter($_POST['CellHeightMax']);
        $PrintFilenames = PostFilter($_POST['PrintFilenames']);
        $SaveDB = NEW db();
        $QueryDB = $SaveDB->query('delete from `galleryparams`;');
        $QueryDB = $SaveDB->query('insert into  `galleryparams` (
                                    `ThumbsWidth` ,
                                    `ThumbsHeight` ,
                                    `ColumsNbr` ,
                                    `CellWidthMax` ,
                                    `CellHeightMax` ,
                                    `PrintFilenames`
                                    )values(
                                    "' . $ThumbsWidth . '",
                                    "' . $ThumbsHeight . '",
                                    "' . $ColumsNbr . '",
                                    "' . $CellWidthMax . '",
                                    "' . $CellHeightMax . '",
                                    "' . $PrintFilenames . '");');
        $GalleryParameter = SuccessSaveGalleryOptions;
    }
    return $GalleryParameter;
}

function editMedia() {

    global $UserId, $LastSession, $TinyDir, $ThemeName, $TheNavBar, $CustomHead;

    if (isset($_GET['galid'])) {
        if (isset($_POST['SaveMediaInfo'])) {
            $IdMedia = InputFilter($_GET['galid']);
            $Path = PostFilter($_POST['Path']);
            $AddDate = PostFilter($_POST['AddDate']);
            $MapLocation = PostFilter($_POST['MapLocation']);
            //$MediaRank 		= PostFilter($_POST['MediaRank']);
            //$MediaType 		= PostFilter($_POST['MediaType']);
            $db = new db();
            $Update = $db->query("update `gallery` set 
                                                `Path`='" . $Path . "',
                                                `AddDate`='" . $AddDate . "',
                                                `MapLocation`='" . $MapLocation . "'
                                                        where `IdMedia`='" . $IdMedia . "';");

            //get posted for each Lang
            $db = new db();
            $LangInfo = $db->get_results("select * from `languages` where `Deleted`<>'1' ;");
            foreach ($LangInfo as $data) {
                $IdLang = $data->IdLang;
                $LangName = $data->LangName;

                $Caption = PostFilter($_POST['Caption' . $LangName]);

                if (isset($_POST['Desc' . $LangName])) {
                    $Desc = PostFilter($_POST['Desc' . $LangName], true);
                }
                else{
                    $Desc = "";
                }
                if (isset($_POST['Place' . $LangName])) {
                    $Place = PostFilter($_POST['Place' . $LangName]);
                }
                else{
                    $Place = "";
                }
                if (isset($_POST['Tags' . $LangName])) {
                    $Tags = PostFilter($_POST['Tags' . $LangName]);
                }
                else{
                    $Tags = "";
                }
                $Langdb = new db();
                $Update = $Langdb->query("update `gallerylang` set 
                                                                    `Caption`='" . $Caption . "' ,
                                                                    `Desc`='" . $Desc . "' ,
                                                                    `Place`='" . $Place . "' ,
                                                                    `Tags`='" . $Tags . "'
                                                                            where `IdLang`='" . $IdLang . "' and `IdMedia`='" . $IdMedia . "';");
            }//end foreach
            $TheNavBar[] = array((BackToMedia), "javascript:history.go(-2)");
            return (SuccessUpdateMediaInfo);
        } else {
            if (isset($_COOKIE['phpTransformer'])) {
                $LastSession = session_id();
            } else {
                $LastSession = '';
            }
            $Tiny = ' <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"          type="text/javascript" charset="utf-8"></script>

    <script src="includes/elrte/elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elfinder/js/i18n/elfinder.' . MiniLang . '.js"    type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $().ready(function() {


            $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);
			
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "' . MiniLang . '",
                height   : 250,
                toolbar  : "maxi",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                fmOpen : function(callback) {
                    $("<div id=\'myelfinder\' />").elfinder({
                        url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                        lang : "' . MiniLang . '",
                        dialog : { width : 900, modal : true, title : "' . Gallery . '" },
                        closeOnEditorCallback : true,
                        editorCallback : callback
                    })
                }
            }
            $(".editor").elrte(opts);
           
        })
    </script>';
            $CustomHead .= $Tiny . '<script language="javascript" type="text/javascript">
                                        document.onkeydown = document.onkeypress = function (evt) {
                                            if (!evt && window.event) {
                                                evt = window.event;
                                            }
                                            var keyCode = evt.keyCode ? evt.keyCode :
                                                evt.charCode ? evt.charCode : evt.which;
                                            if (keyCode) {
                                                if (evt.ctrlKey) {
                                                    if(keyCode==83){
                                                        document.getElementById("SaveMediaInfo").click();
                                                        return false;
                                                    }
                                                    return false;
                                                }
                                            }
                                            return true;
                                        }
                                    </script>
                                    ';
            $IdMedia = InputFilter($_GET['galid']);
            $db = new db();
            $MediaInfo = $db->get_results("select * from `gallery` where `IdMedia`='" . $IdMedia . "' ;");
            foreach ($MediaInfo as $data) {
                $IdMedia = $data->IdMedia;
                $Path = $data->Path;
                $AddDate = $data->AddDate;
                $MapLocation = $data->MapLocation;
                $MediaRank = $data->MediaRank;
                $MediaType = $data->MediaType;

                $editMedia = '	<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
                <script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
                <script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
                <script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
                <script src="Programs/gallery/admin/Themes/' . $ThemeName . '/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
                <link href="Programs/gallery/admin/Themes/' . $ThemeName . '/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
                <form name="form1" method="post" action="">
                <table border="0" cellspacing="1" cellpadding="1">
                  <tr>
                    <td>' . (theFileName) . '</td>
                    <td>
                      <span id="sprytextfield1">
                        <input value="' . $Path . '" class="text" name="Path" type="text" id="Path" maxlength="1024">
                        <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span>
                		</td>
                  </tr>
                  <tr>
                    <td>' . (AddDate) . '</td>
                    <td><span id="sprytextfield2">
                      <input value="' . $AddDate . '" class="text" type="text" name="AddDate" id="AddDate">
                      <span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span></span></td>
                  </tr>
                  <tr>
                    <td>' . (MapLocation) . '</td>
                    <td><input value="' . $MapLocation . '" class="text" type="text" name="MapLocation" id="MapLocation"></td>
                  </tr>
                  <tr>
                    <td>' . (MediaRank) . ' :</td>
                    <td>' . $MediaRank . '</td>
                  </tr>
                  <tr>
                    <td>' . (MediaType) . ' :</td>
                    <td>' . $MediaType . '</td>
                  </tr>
                </table>';
            }//end for each

            $tabs = '<ul class="tabs">';
            $divs = '';
            $DivNewPage = '';
            $i = 0;
            $db = new db();
            $LangInfo = $db->get_results("select * from `languages`  where `Deleted`<>'1';");
            foreach ($LangInfo as $data) {

                $IdLang = $data->IdLang;
                $LangName = $data->LangName;

                $tabs .= '<li class="tab' . ($i + 1) . '">
			<a class="tab' . ($i + 1) . ' tab">
				' . $LangName . '	
			</a>
                        </li>';

                $Gdb = new db();
                $GalLangInfo = $Gdb->get_results("select * from `gallerylang` 
                    where `gallerylang`.`IdLang`='" . $IdLang . "'
                			and `IdMedia`='" . $IdMedia . "';");
                if ($GalLangInfo) {
                    foreach ($GalLangInfo as $Gdata) {
                        //$IdLang 	= $Gdata->IdLang;
                        $Caption = $Gdata->Caption;
                        $Desc = $Gdata->Desc;
                        $Place = $Gdata->Place;
                        $Tags = $Gdata->Tags;
                    }//end for each
                }
                if ($MediaType == 'folder') {
                    $DiveditMedia = '<fieldset>
					<legend>' . $LangName . '</legend>
					<table border="0" cellspacing="1" cellpadding="1">
					  <tr>
					    <td>' . (Caption) . '</td>
					    <td><input value="' . $Caption . '" class="text" type="text" name="Caption' . $LangName . '" id="Caption' . $LangName . '"></td>
					  </tr>
					  <tr>
                                          	</table>
					</fieldset>';
                } else {
                    $DiveditMedia = '<fieldset>
					<legend>' . $LangName . '</legend>
					<table border="0" cellspacing="1" cellpadding="1">
					  <tr>
					    <td>' . (Caption) . '</td>
					    <td><input value="' . $Caption . '" class="text" type="text" name="Caption' . $LangName . '" id="Caption' . $LangName . '"></td>
					  </tr>
					  <tr>
					    <td>' . (Desc) . '</td>
					    <td>
			<textarea cols="50" rows="15" class="editor" name="Desc' . $LangName . '" id="Desc' . $LangName . '">' . $Desc . '</textarea>
			</td>
					  </tr>
					  <tr>
					    <td>' . (Place) . '</td>
					    <td><input value="' . $Place . '" class="text" type="text" name="Place' . $LangName . '" id="Place' . $LangName . '"></td>
					  </tr>
					  <tr>
					    <td>' . (Tags) . '</td>
					    <td><input value="' . $Tags . '" class="text" type="text" name="Tags' . $LangName . '" id="Tags' . $LangName . '"></td>
					  </tr>
					</table>
					</fieldset>';
                }

                $divs .= '<!-- tab ' . ($i + 1) . ' -->
			<div class="tab' . ($i + 1) . ' tabsContent">
				<div>' . $DiveditMedia . '</div>
			</div><!-- end of t' . ($i + 1) . ' -->';
                $i++;
            }//end for each
            $tabs .= '</ul>';
            $editMedia .= '<div class="TabsMainContainer"><div class="htmltabs">' . $tabs . $divs . '</div></div>
                    <input class="submit" name="SaveMediaInfo"  id="SaveMediaInfo" type="submit" value="' . (SaveMediaInfo) . '">
                </form>
                <script type="text/javascript">
                <!--
                var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
                var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
                //-->
                </script>
                <script type="text/javascript">
                function catcalc(cal) {
                		 var date = cal.date;
                		var time = date.getTime();
                }
                Calendar.setup({
                inputField     :    "AddDate",   // id of the input field
                ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
                showsTime      :    true,
                timeFormat     :    "24",
                onUpdate       :    catcalc
                });
                </script>
                                                        <script>
    //This function will run automatically after the page is loaded
    $(document).ready(function() 
    {
        $("div.htmltabs div.tabsContent").hide();//tabsContent class is used to hide all the tabs content in the start
        $("div.tab1").show(); // It will show the first tab content when page load, you can set any tab content you want - just put the tab content class e.g. tab4
        $("div.htmltabs ul.tabs li.tab1 a").addClass("tab-current");// We will add the class to the current open tab to style the active state
        //It will add the click event on all the anchor tag under the htmltabs class to show the tab content when clicking to the tab
        $("div.htmltabs ul li a").click(function()
        {
            var thisClass = this.className.slice(0,4);//"this" is the current anchor where user click and it will get the className from the current anchor and slice the first part as we have two class on the anchor 
            $("div.htmltabs div.tabsContent").hide();// It will hide all the tab content
            $("div." + thisClass).show(); // It will show the current content of the user selected tab
            $("div.htmltabs ul.tabs li a").removeClass("tab-current");// It will remove the tab-current class from the previous tab to remove the active style
            $(this).addClass("tab-current"); //It will add the tab-current class to the user selected tab
        });
    });
</script>';
            $TheNavBar[] = array((BackToMedia), "javascript:history.go(-1)");
            return $editMedia;
        }//END IF
    } else {
        return false;
    }//end if
}

//end function

function DeleteComment() {

    if (isset($_GET['Del'])) {
        if ($_GET['Del'] == 'Cmnt') {
            if (isset($_GET['IdCmnt'])) {
                $IdCmnt = InputFilter($_GET['IdCmnt']);
                $db = new db();
                $db->query("delete from `galleryfav` where `IdCmnt`='" . $IdCmnt . "';");
                return (SuccessDeleteComment);
            } else {
                return false;
            }//end if
        } else {
            return false;
        }//end if
    } else {
        return false;
    }//end if
}

//end function

function cmntMedia() {

    global $ThemeName, $ConvertAt, $Lang, $Path;
    if (isset($_GET['Del'])) {
        return DeleteComment();
    }//end if

    $i = 0;

    if (isset($_GET['galid'])) {
        $IdMedia = InputFilter($_GET['galid']);
    } else {
        $IdMedia = '';
    }//end if

    $cmntMedia = '';
    $language = new db();
    $IdLang = $language->get_var('SELECT `IdLang` FROM `languages` WHERE `LangName`="' . $Lang . '";');
    $dbMedia = new db();
    $GalLang = $dbMedia->get_results("SELECT * FROM `gallerylang` WHERE `IdMedia`='" . $IdMedia . "' and `IdLang`='" . $IdLang . "';");
    foreach ($GalLang as $data) {
        $AddCommentLink = CreateLink('', array('Prog', 'add', 'galid'), array('gallery', 'cmnt', $IdMedia));
        $cmntMedia .= ' <div align="center"><strong>' . $data->Caption . '</strong></div>';

        $cmntMedia .= $data->Desc . '<br/>';
        $cmntMedia .= $data->Place . '<br/>';
        $cmntMedia .= $data->Tags . '<br/>';
    }//end foreach

    $db = new db();
    $MediaComment = $db->get_results("SELECT * FROM `galleryfav` where `IdMedia`='" . $IdMedia . "';");
    if ($MediaComment) {
        foreach ($MediaComment as $data) {
            $UserId = $data->UserId;
            //get NickName for this userid
            $dbUser = new db();
            $NickNameRecordset = $dbUser->get_results('SELECT * FROM `users` WHERE `UserId`="' . $UserId . '";');

            foreach ($NickNameRecordset as $dataUser) {
                $NickName = $dataUser->NickName;
                $UserMail = $dataUser->UserMail;
                $cc = $dataUser->Contry;
            }//end for
            // get country name for this country code
            $dbContry = new db();
            $Contry = $dbContry->get_var('SELECT `Contry` FROM `cclang` WHERE `cc`="' . $cc . '";');
            $IdCmnt = $data->IdCmnt;
            $CommentDate = $data->Date;
            $theComment = $data->Comment;
            $DeleteCmnt = AdminCreateLink("", array("prog", "subdo", 'Del', 'IdCmnt'), array("gallery", "cmntMedia", 'Cmnt', $IdCmnt));
            if (is_file('Programs/gallery/Themes/' . $ThemeName . '/Comments.php')) {
                $CommentCode = get_include_contents('Programs/gallery/admin/Themes/' . $ThemeName . '/Comments.php');
            } else {
                $CommentCode = get_include_contents('Programs/gallery/admin/Default/Comments.php');
            }//end if

            $CommentCode = VarTheme('{ThemeName}', $ThemeName, $CommentCode);
            $DeleteCmnt = VarTheme('{DeleteCmnt}', $DeleteCmnt, $CommentCode);
            $CN = VarTheme('{CN}', ($i), $DeleteCmnt);
            $CommentTitle = VarTheme('{CommentTitle}', '', $CN);
            $Author = VarTheme('{Author}', (AuthorNickname), $CommentTitle);
            $ContryN = VarTheme('{Contry}', (UserContry), $Author);
            $email = VarTheme('{email}', (UserEmail), $ContryN);
            $Date = VarTheme('{Date}', (Date), $email);
            $AuthorName = VarTheme('{AuthorName}', $NickName, $Date);
            $ContryName = VarTheme('{ContryName}', $Contry, $AuthorName);

            if ($ConvertAt == "1") {
                $emailAddress = VarTheme('{emailAddress}', $UserMail, $ContryName);
                $emailAddress = VarTheme('@', '<img src="Themes/' . $ThemeName . '/Images/at.gif" alt="@" border="0"/>', $emailAddress);
            } else {
                $emailAddress = VarTheme('{emailAddress}', $UserMail, $ContryName);
            }//end if

            $CommentDate = VarTheme('{CommentDate}', $CommentDate, $emailAddress);
            $theComment = VarTheme('{theComment}', ' <br /> ' . $theComment . ' <br />&nbsp; ', $CommentDate);
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
        return $cmntMedia . $getMediaComment . '
			<script language="javascript" type="text/javascript">
				function AcceptDelCmnt(){
					return confirm("' . (DidUWantToDeleteComment) . '");
				}
			</script>';
    } else {
        return '';
    }//end if
}

//end function

function delMedia() {
    global $TheNavBar;
    $TheNavBar[] = array(BackToMedia, "javascript:history.go(-1)");
    if (isset($_GET['galid'])) {
        if (is_numeric(InputFilter($_GET['galid']))) {
            $IdMedia = InputFilter($_GET['galid']);
            //get path from db
            $db = new db();
            $Path = $db->get_var("SELECT `Path` FROM `gallery` where `IdMedia`='" . $IdMedia . "';");

            //delete file and remove from db
            $db = new db();
            $db->query("delete from `gallery` where `IdMedia`='" . $IdMedia . "';");
            $db = new db();
            $db->query("delete from `galleryfav` where `IdMedia`='" . $IdMedia . "';");
            $db = new db();
            $db->query("delete from `gallerylang` where `IdMedia`='" . $IdMedia . "';");

            if (is_dir($Path)) {
                //delete album and all sub albums and all files
                DeleteAllDirandSubDir($Path);
            } else {

                //delete fiel and his thumbnail if exist

                unlink($Path);
                //delete thumbnail
                $FileName = substr($Path, strrpos($Path, "/") + 1);
                $ThumbPath = str_replace($FileName, '', $Path);
                $ThumbPath .= 'thumbs/' . $FileName . '.png';
                if (is_file($ThumbPath)) {
                    unlink($ThumbPath);
                }
            }//end if
        } else {

            $Path = InputFilter($_GET['galid']);
            if (is_dir($Path)) {

                //delete album and all sub albums and all files
                DeleteAllDirandSubDir($Path);
            } else {

                //delete fiel and his thumbnail if exist
                //delete file and remove from db
                unlink($Path);
                //delete thumbnail
                $FileName = substr($Path, strrpos($Path, "/") + 1);
                $ThumbPath = str_replace($FileName, '', $Path);
                $ThumbPath .= 'thumbs/' . $FileName . '.png';
                if (is_file($ThumbPath)) {
                    unlink($ThumbPath);
                }
            }//end if
        }//end if
        return SuccessdelMedia;
    } else {
        return false;
    }//end if
    return false;
}

//end function

function DeleteAllDirandSubDir($Path) {
    if (!$dh = @opendir($Path))
        return;
    while (false !== ($obj = readdir($dh))) {
        if ($obj == '.' || $obj == '..')
            continue;
        if (!@unlink($Path . '/' . $obj))
            DeleteAllDirandSubDir($Path . '/' . $obj);
    }//end while
    closedir($dh);
    @rmdir($Path);
}

//end function

function addMedia($galid = false) {
    global $TimeFormat, $TheNavBar;
    $TheNavBar[] = array(BackToMedia, "javascript:history.go(-1)");

    if (!$galid) {
        if (!isset($_GET['galid'])) {
            return false;
        } else {
            $galid = InputFilter($_GET['galid']);
        }
    }

    if ($galid) {
        if (InfoInDatabase($galid)) {//cheking if this path aleady in the db
            return ThisPathAlreadyInDB;
        } else {
            $Path = $galid;
            $IdMedia = GenerateID('gallery', 'IdMedia');
            $AddDate = date('Y-m-d H:i:s');
            $MediaType = MediaType($Path);
            $db = new db();
            $db->query("INSERT INTO `gallery` ( `IdMedia` , `Path` , `AddDate` , `MapLocation` , `MediaRank` , `MediaType`,`visible` )
			VALUES ('" . $IdMedia . "', '" . $Path . "', '" . $AddDate . "', '', '', '" . $MediaType . "' ,1);");

            $dbLang = new db();
            $Langs = $dbLang->get_results("SELECT * FROM `languages`;");
            if ($Langs) {
                foreach ($Langs as $language) {
                    $IdLang = $language->IdLang;
                    $dbInsetLang = new db();
                    $xe = explode("/", $Path);
                    $caption = end($xe);
                    $last_dot = strrpos($caption, ".");
                    if ($last_dot) {
                        $caption = substr($caption, 0, $last_dot);
                    } else {
                        $caption = substr($caption, 0);
                    }


                    $db->query("INSERT INTO `gallerylang` ( `IdMedia` , `IdLang` , `Caption` , `Desc` , `Place` , `Tags` )
                VALUES ('" . $IdMedia . "', '" . $IdLang . "', '" . $caption . "', '', '', '')");
                }//end foreach
            }//end if

            $MediaUrl = CreateLink('', array('Prog', 'show', 'galid'), array('gallery', 'all', $IdMedia));

            return SuccessAddNewFile . ' : ' . $Path .
                    '<script language="javascript" type="text/javascript" src="includes/ping.js"></script>
                                <script language="javascript" type="text/javascript">
                                        pingSE("Gallery","' . $MediaUrl . '");
                                </script>';
        }//end if
    }//end if
}

//end function

function ClearDB() {
    $dbInfo = new db();
    $Media = $dbInfo->get_results("SELECT * FROM `gallery`;");
    if ($Media) {
        foreach ($Media as $Row) {
            $IdMedia = $Row->IdMedia;
            $Path = $Row->Path;
            //cheking if path exist
            if (!is_dir($Path) and ! is_file($Path)) {
                //path not exist , Delete all info about this file
                //remove info from gallery
                $dbDel = new db();
                $dbDel->query("delete from `gallery` where `IdMedia`='" . $IdMedia . "';");
                //remove info from galleryLang
                $dbDel = new db();
                $dbDel->query("delete from `gallerylang` where `IdMedia`='" . $IdMedia . "';");
                //removeinfo from galleryFav
                $dbDel = new db();
                $dbDel->query("delete from `galleryfav` where `IdMedia`='" . $IdMedia . "';");
            }//end if
        }//end for each
    }//end if
    return SuccessClearGallery;
}

//end function

function allMedia($IdMedia) {

    global $WebsiteUrl, $TheNavBar, $TimeFormat, $CustomHead, $Lang;

    if (isset($_POST['Remove'])) {
        $TheNavBar[] = array(BackToMedia, "javascript:history.go(-1)");

        if (isset($_GET['galid'])) {
            $CurrentPath = InputFilter($_GET['galid']);
        } else {
            $CurrentPath = 'uploads/gallery/Albums';
        }

        if ($handle = opendir($CurrentPath)) {
            $Paths = '';
            while (($file = readdir($handle)) !== false) {
                if (($file != 'thumbs') and ( $file != 'medium') and ( $file != '.') and ( $file != '..')) {
                    if (InfoInDatabase($CurrentPath . '/' . $file)) {
                        $Info = InfoInDatabase($CurrentPath . '/' . $file);
                        $IdMedia = $Info[0]['IdMedia'];
                        //if this id submited by post we will delete it from db
                        if (isset($_POST[$IdMedia])) {
                            $Paths .= $Info[0]['Path'] . '<br/>';
                            $db = new db();
                            $Q = $db->query("delete from `gallery` where `IdMedia`='" . $IdMedia . "';");
                            $Q = $db->query("delete from `galleryfav` where `IdMedia`='" . $IdMedia . "';");
                            $Q = $db->query("delete from `gallerylang` where `IdMedia`='" . $IdMedia . "';");
                        }//end if
                    }//end if
                }//end if
            }//end while
            closedir($handle);
        }//end if
        return SuccessRemoveSelectedFromDb . ' : <br/>' . $Paths;
    }//end if	

    if (isset($_POST['AddFiles'])) {
        $TheNavBar[] = array((BackToMedia), "javascript:history.go(-1)");
        if (isset($_GET['galid'])) {
            $CurrentPath = InputFilter($_GET['galid']);
        } else {
            $CurrentPath = 'uploads' . '/' . 'gallery' . '/' . 'Albums';
        }
        if ($handle = @opendir($CurrentPath)) {
            $Paths = '';
            while (($file = readdir($handle)) !== false) {
                if (($file != 'thumbs') and ( $file != '.') and ( $file != '..')) {
                    if (!InfoInDatabase($CurrentPath . '/' . $file)) {
                        //http send _ not . or space
                        $Posted = str_replace('.', '_', $CurrentPath . '/' . $file);
                        $Posted = str_replace(' ', '_', $Posted);
                        if (isset($_POST[$Posted])) {
                            $Paths .= $CurrentPath . '/' . $file . '<br/>';
                            $Path = $CurrentPath . '/' . $file;
                            $IdMedia = GenerateID('gallery', 'IdMedia');
                            $AddDate = date($TimeFormat);
                            $MediaType = MediaType($Path);
                            $db = new db();
                            $db->query("INSERT INTO `gallery` ( `IdMedia` , `Path` , `AddDate` , `MapLocation` , `MediaRank` , `MediaType`,`visible` )
                                            VALUES ('" . $IdMedia . "', '" . $Path . "', '" . $AddDate . "', '', '', '" . $MediaType . "',1);");
                            $dbLang = new db();
                            $Langs = $dbLang->get_results("SELECT * FROM `languages`;");
                            if ($Langs) {
                                foreach ($Langs as $language) {
                                    $IdLang = $language->IdLang;
                                    $dbInsetLang = new db();
                                    $caption = explode("/", $Path);
                                    $caption = end($caption);
                                    $last_dot = strrpos($caption, ".");
                                    if ($last_dot) {
                                        $caption = substr($caption, 0, $last_dot);
                                    } else {
                                        $caption = substr($caption, 0);
                                    }
                                    $db->query("INSERT INTO `gallerylang` ( `IdMedia` , `IdLang` , `Caption` , `Desc` , `Place` , `Tags` )
                                                VALUES ('" . $IdMedia . "', '" . $IdLang . "', '" . $caption . "', '', '', '')");
                                }//end foreach
                            }//end if
                        }//end if
                    }//end if
                }//end if
            }//end while
            closedir($handle);
        }//end if
        return (SuccessAddSelectedToDb) . ' : <br/>' . $Paths;
    }//end if

    if (isset($_POST['AddFolder'])) {
        if (!isset($_POST['SaveFolder'])) {
            ECHO '<form name="form1" method="post" action="">
                    <input type="hidden" name="AddFolder" id="AddFolder" >
                    <input class="text" type="text" name="FolderName" id="FolderName" value="">
                    <input class="submit" type="submit" name="SaveFolder" id="SaveFolder" value="' . SaveFolder . '"></form>';
        } else {
            $TheNewFolder = $IdMedia . '/' . PostFilter(RightLangFileName($_POST['FolderName']), 1);
            if (!file_exists($TheNewFolder)) {
                mkdir($TheNewFolder);
                addMedia($TheNewFolder);
                echo SuccessAddFolder;
            } else {
                echo FolderAlreadyExist;
            }
        }
    }
    $CustomHead .=' <script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                        document.getElementById("AddFiles").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>

                    ';

    $allMedia = '';
    if (is_numeric($IdMedia)) {
        //id from databse
        $db = new db();
        $CurrentPath = $db->get_var("SELECT `Path` FROM `gallery` where `IdMedia`='" . $IdMedia . "';");
    } else {
        //file case
        $CurrentPath = $IdMedia;
    }//end if

    if (!is_dir($CurrentPath))
        return false;

    if (InfoInDatabase($CurrentPath)) {
        $Curdir = InfoInDatabase($CurrentPath);
    } else {
        
    }//end if

    $PrevPath = '';
    $AlbumsPath = str_replace('uploads' . '/' . 'gallery' . '/' . 'Albums', "", $CurrentPath);
    $PathArray = explode('/', $AlbumsPath);
    foreach ($PathArray as $FolderName) {
        if ($FolderName != '') {
            $PrevPath .= '/' . $FolderName;
            $TheNavBar[] = array($FolderName, AdminCreateLink("", array("prog", "galid"), array("gallery", "uploads/gallery/Albums" . $PrevPath)));
        }//end if
    }//end foreach

    if ($handle = @opendir($CurrentPath)) {
        while (($file = readdir($handle)) !== false) {
            if (is_dir($CurrentPath . '/' . $file) and ( $file != 'thumbs')
                    and ( $file != 'medium') and ( $file != '.') and ( $file != '..')) {
                $Folders[] = $file;
            }//end if
        }//end while
        closedir($handle);
    }//end if

    $allMedia .='<table width="100%" border="0" cellspacing="1" cellpadding="1">';
    $allMedia .= ' <tr><td>';
    if (isset($Folders)) {
        for ($i = 0; $i < count($Folders); $i++) {
            $ThisFolderLink = 'uploads/gallery/Albums' . $PrevPath . '/' . $Folders[$i];
            $allMedia .= '<div class="gallery_folder">
                <a href="' . AdminCreateLink("", array("prog", "galid"), array("gallery", $ThisFolderLink)) . '">
                	<img src="Programs/gallery/admin/images/folder.png" border="0" /><br/>' . $Folders[$i] . '
                </a>
                </div>
			';
        }//end if

        $allMedia .= ' </td></tr>';
        $allMedia .= ' </table><br/>';
    }//end if
    $script_copy = '';
    $allMedia .= '<form name="form1" method="post" action="">
			<table class="class_options"  width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
			  <tr align="center">
			 
			    <td>&nbsp;</td>
                            <td>' . icon . '</td>
			    <td><strong>' . theFileName . '</strong></td>
			    <td><strong>' . Caption . '</strong></td>
			<!--    <td><strong>' . Desc . '</strong></td>
			    <td><strong>' . Place . '</strong></td> -->
			    <td><strong>' . AddDate . '</strong></td>
                            <td><strong> HTML </strong></td>
			    <td><strong>' . MediaRank . '</strong></td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			  </tr>';
    if ($handle = @opendir($CurrentPath)) {
        $i = 0;
        while (($file = readdir($handle)) !== false) {
            if (($file != 'thumbs') and ( $file != 'medium') and ( $file != '.') and ( $file != '..')
                    and ( $file != 'Thumbs.db') and ( $file != 'thumb.tmb') and ( $file != 'index.html') and ( $file != 'index.htm')) {
                $InfoDB = InfoInDatabase($CurrentPath . '/' . $file);

                if ($InfoDB) {
                    $IdMedia = $InfoDB[0]['IdMedia'];
                    $Mark = '<img src="Programs/gallery/admin/images/true.png" border="0" alt="info" width="30" height="30">';
                    $Edit = '<img src="Programs/gallery/admin/images/edit.png" border="0" alt="edit" width="30" height="30"> ';
                    $visible = $InfoDB[0]['visible'];
                    if ($visible) {
                        $Add = '<img src="Programs/gallery/admin/images/visible.png" border="0" alt="visible" width="30" height="30"> ';
                    } else {
                        $Add = '<img src="Programs/gallery/admin/images/hidden.png" border="0" alt="hidden" width="30" height="30"> ';
                    }

                    $data_visible = "visible";
                    $Comment = '<img src="Programs/gallery/admin/images/talk.png" border="0" alt="comment" width="30" height="30">';
                    $AddHref = '#';
                    $FileName = $file;
                    $disabled = "";
                    $Caption = strip_tags($InfoDB[0]['Caption']);
                    $Desc = strip_tags($InfoDB[0]['Desc']);
                    $Place = $InfoDB[0]['Place'];
                    $AddDate = $InfoDB[0]['AddDate'];
                    $MediaRank = $InfoDB[0]['MediaRank'];
                    $MediaType = $InfoDB[0]['MediaType'];
                    $CommentHref = AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "cmntMedia", $IdMedia));
                    $EditHref = AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "editMedia", $IdMedia));
                    $DeleteHref = AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "delMedia", $IdMedia));
                } else {
                    $IdMedia = $CurrentPath . '/' . $file;
                    $Mark = '<img src="Programs/gallery/admin/images/info.png" border="0" alt="info" width="30" height="30">';
                    $Add = '<img src="Programs/gallery/admin/images/hidden.png" border="0" alt="hidden" width="30" height="30"> ';
                    $Edit = '<img src="Programs/gallery/admin/images/edit_bw.png" border="0" alt="edit" width="30" height="30"> ';
                    $Comment = '<img src="Programs/gallery/admin/images/talk_bw.png" border="0" alt="comment" width="30" height="30">';
                    $AddHref = AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "addMedia", $IdMedia));
                    $FileName = $file;
                    $disabled = "";
                    $Caption = '...';
                    $Desc = '...';
                    $Place = '...';
                    $AddDate = '...';
                    $MediaRank = '...';

                    if (!is_dir($IdMedia)) {
                        $MediaType = substr($file, strrpos($file, '.') + 1, strlen($file));
                    } else {
                        $MediaType = 'folder';
                    }

                    $CommentHref = '#';
                    $EditHref = '#';
                    $DeleteHref = AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "delMedia", $IdMedia));
                }
                $Thumbnail = $CurrentPath . '/' . 'thumbs' . '/' . $file;
                if (file_exists($Thumbnail)) {
                    list($srcW, $srcH, $srcType, $html_attr) = getimagesize($Thumbnail);

                    $FixImageSize = FixImageSize($srcW, $srcH, 120, 120);
                    $newW = $FixImageSize[0];
                    $newH = $FixImageSize[1];
                    $Thumbnail = '<img  width="' . $newW . '" height="' . $newH . '" style="border:0px;"
                                    src="' . $Thumbnail . '"  />';
                } elseif (is_file($CurrentPath . '/' . 'thumbs' . '/' . $file . '.png')) { // like youtube case
                    $Thumbnail = $CurrentPath . '/' . 'thumbs' . '/' . $file . '.png';
                    list($srcW, $srcH, $srcType, $html_attr) = getimagesize($Thumbnail);
                    $FixImageSize = FixImageSize($srcW, $srcH, 120, 120);
                    $newW = $FixImageSize[0];
                    $newH = $FixImageSize[1];
                    $Thumbnail = '<img  width="' . $newW . '" height="' . $newH . '" style="border:0px;"
                                    src="' . $Thumbnail . '"  />';
                } else {
                    $Thumbnail = ' ';
                }
                if ($MediaType != "folder" and $MediaType != "") {
                    $Path = $WebsiteUrl . $CurrentPath . '/' . $file;
                    $Link = '<button class="coping" id="copy-' . $i . '" data-clipboard-text=\''
                            . getFilePlayer($Path, $MediaType) . '\' title="' . copy_media . '">' . copy_media . '</button>';
                    $script_copy .=' var clip' . $i . ' = new ZeroClipboard( document.getElementById("copy-' . $i . '"), 
                                        { moviePath: "includes/ZeroClipboard/ZeroClipboard.swf"} );';
                } else {
                    $Link = '';
                    $ThisFolderLink = 'uploads/gallery/Albums' . $PrevPath . '/' . $file;
                    $Thumbnail .= '<a href="' . AdminCreateLink("", array("prog", "galid"), array("gallery", $ThisFolderLink)) . '">
                                                <img src="Programs/gallery/admin/images/folder.png" border="0" />
                                        </a> ';
                }

                $allMedia .= '  <tr align="center" >
                    <td>
                      <input ' . $disabled . ' class="checkbox" type="checkbox" name="' . $IdMedia . '" id="' . $IdMedia . '">    </td>
                   
                    <td>' . $Thumbnail . '</td>
                    <td><a href="admin/includes/webfolder/index.php?action=list&dir=' . $CurrentPath . '&srt=yes&lang=' . $Lang . '" >' . $FileName . '</a></td>
                    <td>' . $Caption . '</td>
                 
                    <td>' . $AddDate . '</td>
                     <td>' . $Link . '</td>
                    <td>' . $MediaRank . '</td>
                                                                    
                    <td>
                    	<div class="showhide"  data-id="' . $IdMedia . '" galid="' . $CurrentPath . '/' . $file . '" >
                			' . $Add . '       
                        </div>    
                     </td>
                                                                     
                    <td>
                    	<a title=" ' . cmntMedia . '" href="' . $CommentHref . '" >
                		' . $Comment . '
                        </a>     
                    </td>
                    <td>
                   	 <a title="' . editMedia . '" href="' . $EditHref . '" >
                   		' . $Edit . '    
                        </a>   
                         </td>
                    <td>
                    	<a title="' . delete . '" href="' . $DeleteHref . '" onclick="return AcceptDel(\'' . MediaType($CurrentPath . '/' . $file) . '\');">
                   		<img src="Programs/gallery/admin/images/delete.png" border="0" alt="Delete" width="30" height="30">       
                         </a>    
                         </td>
                  </tr>';
            }//End if
            $i++;
        }// end WHILE
    }//END IF

    $allMedia .= '</table>  
                  <a href="javascript:void(0);" onclick="javascript:checkAll();" >' . checkAll . '</a> | 
		<a href="javascript:void(0);" onclick="javascript:uncheckAll();" >' . uncheckAll . '</a> | ';
    if (isset($_GET['galid'])) {
        $allMedia .= '            <a href="' . AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "album_thumb", $CurrentPath)) . '"  
                    name="AddFiles" id="AddnewFiles">' . change_album_thumb . '</a> | ';
    }

    $allMedia .= '<a href="' . AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "upload_media", $CurrentPath)) . '"  
                    name="AddFiles" id="AddnewFiles">' . UploadNewFiles . '</a> | 
                <a href="' . AdminCreateLink("", array("prog", "subdo", "galid"), array("gallery", "youtube", $CurrentPath)) . '"  
                    name="AddFiles" id="AddnewFiles">' . create_youtube_video . '</a> 
		| <input type="submit" class="submit"  name="AddFiles" id="AddFiles" value="' . AddFiles . '" /> 
                | <input class="submit" type="submit" name="Remove" id="Remove" value="' . RemoveSelected . '">  
                | <input class="submit" type="submit" name="AddFolder" id="AddFolder" value="' . AddFolder . '"> 
		</form>                    
                <script src="includes/ZeroClipboard/ZeroClipboard.min.js"></script>                     
                <script language="javascript" type="text/javascript">
                function AcceptDel(type){
                	if (type=="folder"){
                		if(confirm("' . DidUWantToDeleteFolderAndAllSubFoldersAndFiles . '")){
                			return confirm("' . DidUWantToDeleteFolderAndAllSubFoldersAndFiles . '");
                		}
                		else{
                			return false;
                		}
                	}
                	else{
                		return confirm("' . DidUWantToDeleteFile . '");
                	}
                }
                
                </script>
                <script type="text/javascript">
                function checkAll(){
                    var inputs = document.getElementsByTagName(\'input\');
                    for (var i = 0; i < inputs.length; i++){
                        if (inputs[i].type == \'checkbox\'){
                            inputs[i].checked = true;
                        }
                    continue;
                    }
                }
                function uncheckAll(){
                    var inputs = document.getElementsByTagName(\'input\');
                    for (var i = 0; i < inputs.length; i++){
                        if (inputs[i].type == \'checkbox\'){
                            inputs[i].checked = false;
                        }
                    continue;
                    }
                }
                </script>
              <script type="text/javascript" language="javascript>">
              $(document).ready(function(){
              $(".showhide").on("click",function(){
              var id = ($(this).attr("data-id"));
              var galid = ($(this).attr("data-id"));
              $.ajax({
                        url: "Programs/gallery/admin/showhide.php",
                        context: this,
                        data:{"id":id,"galid":galid}
                        
                        })
                        .done(function( data ) {
                          $(this).html("<img src=\'Programs/gallery/admin/images/" + data + " \' border=\'0\' alt=\'add\' width=\'30\' height=\'30\' > ");

                        });
                    
              }
                );
              $(".class_options tr").mouseover(function(){
                $(this).css("background-image","url(admin/Themes/Default/images/tr_back.gif)");
                });
                
                $(".class_options tr").mouseout(function(){
                    $(this).css("background-image","url(\'\')");
                 });


                });

                        function OpenModalPopUP(WindowURL){
                            window.showModalDialog(WindowURL,"resizable=1");
                            window.location.reload();
                            }
                        
                        
                        ' . $script_copy . '

              </script>';

    return $allMedia;
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
                    $Info[0]['Path'] = $Record->Path;
                    $Info[0]['AddDate'] = $Record->AddDate;
                    $Info[0]['MapLocation'] = $Record->MapLocation;
                    $Info[0]['MediaRank'] = $Record->MediaRank;
                    $Info[0]['MediaType'] = $Record->MediaType;
                    $Info[0]['Caption'] = $Record->Caption;
                    $Info[0]['Desc'] = substr($Record->Desc, 0, 75) . '...';
                    $Info[0]['Place'] = substr($Record->Place, 0, 75) . '...';
                    $Info[0]['Tags'] = $Record->Tags;
                    $Info[0]['visible'] = $Record->visible;
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

function MediaType($Path) {
    if ($Path) {
        if (is_dir($Path)) {
            return 'folder';
        } else {
            $FileName = substr($Path, strrpos($Path, "/") + 1);
            $Extension = substr($FileName, strrpos($FileName, ".") + 1);
            return trim($Extension);
        }//end if
    } else {
        return false;
    }//end if
}

//end function

function getFilePlayer($Path, $Filext, $Width = '480', $Height = '390') { // this function already exesit in the user side,please note when you modifie this function
    global $WebsiteUrl;
    $Img = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
    $Flv = array('flv', 'FLV');
    $MediaPlayer = array('mp3', 'wma', 'wmv', 'mpeg', 'mpeg', 'mpg');
    $RealPlayer = array('rm', 'ra');
    $Flash = array('swf');
    $Docs = array('pdf', 'ppt', 'pptx', 'doc', 'docx', 'xls', 'xlsx', 'rtf', 'txt');
    $YouTube = array('youtube');

    foreach ($Docs as $ext) {
        if (strtolower($ext) == $Filext) {
            return '<div align="center"><iframe src="http://docs.google.com/viewer?url=' . $WebsiteUrl . '/' . $Path . '&embedded=true" width="750" height="1055" style="border: none;"></iframe></div>';
        }//end if
    }//end for each

    foreach ($Img as $ext) {
        if (strtolower($ext) == $Filext) {
            // get the medium size
            $old_Path = $Path;
            $last_slash = strrpos($Path, '/');
            $first_port = substr($Path, 0, $last_slash);
            $last_port = substr($Path, $last_slash, strlen($Path));
            $Path = $first_port . '/' . 'medium' . $last_port;

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
                $newW = "";
                $newH = "";
            }
            return '<div align="center"><img width="' . $newW . '" height="' . $newH . '" alt="" title="" src="' . $Path . '" border="1" /></div>';
        }//end if
    }//end for each

    foreach ($Flash as $ext) {
        if (strtolower($ext) == $Filext) {
            $FlashFile = $Path;
            $Flash = get_include_contents('Programs/gallery/Players/Flash/code.php');
            $Flash = VarTheme('{swfMovie}', $FlashFile, $Flash);
            $Flash = VarTheme('{FWidth}', $Width, $Flash);
            $Flash = VarTheme('{FHeight}', $Height, $Flash);
            return '<div align="center">' . $Flash . '</div>';
        }//end if
    }//end for each

    foreach ($Flv as $ext) {
        if (strtolower($ext) == $Filext) {
            $VideoFile = str_replace('Programs/gallery/', '../../', $Path);
            $VideoWidth = $Width;
            $VideoHeight = $Height;
            $VideoFlv = get_include_contents('Programs/gallery/Players/Flv/code.php');
            $VideoFlv = VarTheme('{VideoFlv}', $VideoFile, $VideoFlv);
            $VideoFlv = VarTheme('{VideoWidth}', $VideoWidth, $VideoFlv);
            $VideoFlv = VarTheme('{VideoHeight}', $VideoHeight, $VideoFlv);
            return '<div align="center">' . $VideoFlv . '</div>';
        }//end if
    }//end for each

    foreach ($MediaPlayer as $ext) {
        if (strtolower($ext) == $Filext) {
            $WMfile = $Path;
            $WMplayer = get_include_contents('Programs/gallery/Players/MediaPlayer/code.php');
            $WMplayer = VarTheme('{WMfile}', $WMfile, $WMplayer);
            $WMplayer = VarTheme('{WMwidth}', $Width, $WMplayer);
            $WMplayer = VarTheme('{WMheight}', $Height, $WMplayer);
            return '<div align="center">' . $WMplayer . ' </div>';
        }//end if
    }//end for each

    foreach ($RealPlayer as $ext) {
        if (strtolower($ext) == $Filext) {
            $RAfile = $Path;
            $RAplayer = get_include_contents('Programs/gallery/Players/RealPlayer/code.php');
            $RAplayer = VarTheme('{RAfile}', $RAfile, $RAplayer);
            $RAplayer = VarTheme('{RAwidth}', $Width, $RAplayer);
            $RAplayer = VarTheme('{RAheight}', $Height, $RAplayer);
            return '<div align="center">' . $RAplayer . ' </div>';
        }//end if
    }//end for each

    foreach ($YouTube as $ext) {
        if (strtolower($ext) == $Filext) {

            $YouTubeFile = explode('/', $Path);
            $YouTubeFile = $YouTubeFile[count($YouTubeFile) - 1];
            $YouTubeID = substr($YouTubeFile, 0, strlen($YouTubeFile) - 8);
            $YouTubeplayer = get_include_contents('Programs/gallery/Players/youtube/code.php');
            $YouTubeplayer = VarTheme('{YouTubeID}', $YouTubeID, $YouTubeplayer);
            $YouTubeplayer = VarTheme('{YTwidth}', $Width, $YouTubeplayer);
            $YouTubeplayer = VarTheme('{YTheight}', $Height, $YouTubeplayer);
            $SavePath = 'http://www.savevid.com/?url=http://www.youtube.com/watch?v=' . $YouTubeID;
            return '<div align="center">' . $YouTubeplayer . ' </div>';
        }//end if
    }//end for each


    $pos = -1;
    $Lastpos = 0;
    while (($pos = strpos($Path, '/', $pos + 1)) !== false)
        $Lastpos = $pos;
    $FileName = substr($Path, $Lastpos + 1, strlen($Path));
    $PathFileName = substr($Path, 0, $Lastpos + 1);
    $ThumbFileName = $PathFileName . 'thumbs/' . $FileName . '.png';
    if (is_file($ThumbFileName)) {
        $FileThumb = $ThumbFileName;
    } else {
        $FileThumb = 'Programs/gallery/images/' . getFileType($ext) . '.png';
    }//end if
    return '<div align="center"><img src="' . $FileThumb . '" border=0 /></div>';
}

//end function

function getFileType($Filext) { // this function already exesit in the user side,please note when you modifie this function
    $Videos = array('wmv', 'flv', 'swf', 'rm', 'avi', 'mpeg', 'mpg', 'youtube', 'YOUTUBE');
    $Sounds = array('mp3', 'wma', 'ra');
    $Docs = array('pdf', 'PDF', 'ppt', 'PPT', 'pptx', 'PPTX', 'tiff', 'TIFF', 'doc', 'DOC', 'docx', 'DOCX', 'xls', 'XLS', 'xlsx', 'XLSX', 'rtf', 'RTF', 'txt', 'TXT',);

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

function parse_youtube_id($url) {

    if (!strpos($url, "#!v=") === false) {  //Em caso de ser um link de quando clica nos related
        //In case of be a link from related
        $url = str_replace('#!v=', '?v=', $url);
    }

    parse_str(parse_url($url, PHP_URL_QUERY));

    if (isset($v)) {
        return $v;
    } else {
        return substr($url, strrpos($url, '/') + 1, 11);
    }
}

?>