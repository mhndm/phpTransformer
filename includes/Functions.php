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
    header("location: ../");
}
?>
<?php

function pt_uploader(
$input_hidden_target = "upfiles", $multi_files = 1, $allowed = "all", $div_id = 1, $path_upload = "uploads/", $path_thumbs = "uploads/thumbs", $thumbs = array(), // path and width size for thumb ex :  array('uploads/thumbs/medium'=>900,600,256,100) or Full Path without extension 
/* array('uploads/users/' . $NickName . '/avatar_32' => 32, 
  'uploads/users/' . $NickName . '/avatar_64' => 64,
  'uploads/users/' . $NickName . '/avatar_128' => 128,
  'uploads/users/' . $NickName . '/avatar_256' => 256
  ),
 */ $amazone_s3 = false, $upload_to_youtube = false, $rename_files = true, $watermark_path = false
, $drop_here = drop_here, $choose_pic = choose_pic, $callback_path = "", $callback_name = "", $callback_args = array()) {

    // !!! dont echo this function into <form tag beacuse nested forms not allowed

    global $LastLineCode,$uploader_code_included, $CustomHead, $ThemeName, $upload_allowed_ext, $upload_images, $upload_videos, $upload_files;

    if ($amazone_s3) {
        $amazone_s3 = 1;
    } else {
        $amazone_s3 = 0;
    }

    if ($upload_to_youtube) {
        $upload_to_youtube = 1;
    } else {
        $upload_to_youtube = 0;
    }

    if ($rename_files) {
        $rename_files = 1;
    } else {
        $rename_files = 0;
    }

    $thumbs = json_encode($thumbs);
    $thumbs = str_replace("'", '&quot;', $thumbs);
    $thumbs = str_replace('"', '&quot;', $thumbs);
    //var_dump($callback_path);
    if ($callback_path!='' and is_file($callback_path)) {
        $LastLineCode .= '<script type="text/javascript" src="' . $callback_path . '" x="y" ></script>';
    }
    if (!$uploader_code_included) {
        $LastLineCode .= '<script type="text/javascript" src="includes/uploader/assets/js/jquery.knob.js"></script>';
        $LastLineCode .= '<script type="text/javascript" src="includes/uploader/assets/js/jquery.ui.widget.js"></script>';
        $LastLineCode .= '<script type="text/javascript" src="includes/uploader/assets/js/jquery.iframe-transport.js"></script>';
        $LastLineCode .= '<script type="text/javascript" src="includes/uploader/assets/js/jquery.fileupload.js"></script>';
        $LastLineCode .= '<script type="text/javascript"  src="Themes/' . $ThemeName . '/uploader/uploader.js"></script>';
        $LastLineCode .= '<link type="text/css"  href="Themes/' . $ThemeName . '/uploader/uploader.css" rel="stylesheet" />';
        $uploader_code_included++;
    }

    $types = array("images", "videos", "files", "all");
    $exts = $upload_allowed_ext;

    if (in_array($allowed, $types)) {

        switch ($allowed) {
            case "images":
                $exts = $upload_images;
                break;
            case "videos":
                $exts = $upload_videos;
                break;
            case "files":
                $exts = $upload_files;
                break;

            default:
                $exts = $upload_allowed_ext;
                break;
        }
    }

    $js_allowed_ext = implode('","', $exts);
    $callback_args = implode('","', $callback_args);

    $CustomHead .= '<script type="text/javascript"> $(document).ready(function(){'
            . 'pt_uploader ("drop' . $div_id . '", "upload' . $div_id . '",'
            . $multi_files . ',"' . $input_hidden_target . '",["' . $js_allowed_ext . '"],'
            . '"' . $callback_name . '", ["' . $callback_args . '"])'
            . '});'
            . '</script>';

    $multi_files = $multi_files == true ? ' multiple' : '';

    $_SESSION['uploader'.$div_id]['allowed'] = $allowed;
    $_SESSION['uploader'.$div_id]['path_upload'] = $path_upload;
    $_SESSION['uploader'.$div_id]['amazone_s3'] = $amazone_s3;
    $_SESSION['uploader'.$div_id]['upload_to_youtube'] = $upload_to_youtube;
    $_SESSION['uploader'.$div_id]['thumbs'] = $thumbs;
    $_SESSION['uploader'.$div_id]['path_thumbs'] = $path_thumbs;
    $_SESSION['uploader'.$div_id]['rename_files'] = $rename_files;
    $_SESSION['uploader'.$div_id]['watermark_path'] = $watermark_path;

    $form = file_get_contents("Themes/" . $ThemeName . "/uploader/uploader.php");
    return $form = str_replace(array("{id}", "{multiple}", "{upfiles}", "{drop_here}", "{choose_pic}"), array($div_id, $multi_files, $input_hidden_target, $drop_here, $choose_pic)
            , $form);
}

function move_file_to_cloud_s3($file_path) {

    global $awsAccessKey, $awsSecretKey, $WebSiteName;

    if (!class_exists('S3'))
        require_once 's3.php';

    if (!defined('awsAccessKey'))
        define('awsAccessKey', $awsAccessKey);
    if (!defined('awsSecretKey'))
        define('awsSecretKey', $awsSecretKey);

    $bucketName = $WebSiteName; // Temporary bucket

    $s3 = new S3(awsAccessKey, awsSecretKey);

    $list_buckets = $s3->listBuckets();

    if (!in_array($bucketName, $list_buckets)) {
        $s3->putBucket($bucketName, S3::ACL_PUBLIC_READ);
    }

    if ($s3->putObjectFile($file_path, $bucketName, baseName($file_path), S3::ACL_PUBLIC_READ)) {
        @unlink($file_path);
        RETURN TRUE;
    } else {
        RETURN FALSE;
    }
}

function move_video_to_youtube($file_path, $uploaded_file_name, $title = " ", $description = " ", $privacy = "public") {


    global $youtube_api_key, $youtube_username, $youtube_password;

    if(is_file('../uploader/ClassYouTubeAPI.php'))
        {
            include_once ('../uploader/ClassYouTubeAPI.php');
        }
    else
        {
            include_once('ClassYouTubeAPI.php');
        }

    $obj = new ClassYouTubeAPI($youtube_api_key);
    $result = $obj->clientLoginAuth($youtube_username, $youtube_password);
    $result = $obj->uploadVideo($uploaded_file_name, $file_path, $title, $description, $privacy);

    // var_dump($result);

    if (is_array($result) and count($result) and ! isset($result["is_error"])) {
        $youtube_file = str_replace($uploaded_file_name, $result["videoId"] . '.youtube', $file_path);
        $resource = fopen($youtube_file, 'w');
        fwrite($resource, "");
        fclose($resource);

        @unlink($file_path);

        return $result["videoId"];
    } else {
        @unlink($file_path);
        return false;
    }
}

function pt_create_thumbs($pathToImages, $pathToThumbs, $thumbWidth = 900, $thumbHeight = -1) {
    // open the directory
    //$dir = opendir( $pathToImages );
    // loop through it, looking for any/all JPG files:
    //while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages);
    $img_ext = strtolower($info['extension']);
    // continue only if this is a JPEG image
    if ($img_ext == 'gif') {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
        $quality = -1;
    }
    if ($img_ext == 'jpg' || $img_ext == 'jpeg') {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
        $quality = 90;
    }
    if ($img_ext == 'png') {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
        $quality = 9;
        $filter = PNG_NO_FILTER;
    }

    if (isset($imgt) && $imgt) {
        // load image and get image size
        $img = $imgcreatefrom("{$pathToImages}");
        $width = imagesx($img);
        $height = imagesy($img);

        // calculate thumbnail size

        if ($thumbHeight == -1) {
            if ($width <= $thumbWidth) {
                $new_width = $width;
                $new_height = floor($height * ( $thumbWidth / $width ));
                if ($height <= $new_height)
                    $new_height = $height;
            }
            else {
                $new_width = $thumbWidth;
                $new_height = floor($height * ( $thumbWidth / $width ));
            }
        } else {
            if ($width <= $thumbWidth && $height <= $height) {
                $new_width = $width;
                $new_height = $height;
            } else if ($width > $height) {
                $new_width = $thumbWidth;
                $new_height = intval($height * $new_width / $width);
            } else {
                $new_height = $thumbHeight;
                $new_width = intval($width * $new_height / $height);
            }
        }
//var_dump($new_width);
        // create a new temporary image
        $tmp_img = imagecreatetruecolor($new_width, $new_height);

        if ($quality == -1) {
            $black = imagecolorallocate($tmp_img, 0, 0, 0);
            imagecolortransparent($tmp_img, $black);
        }

        if (isset($filter) || $quality == -1) {
            imagealphablending($tmp_img, false);
            imagesavealpha($tmp_img, true);
        }

        // copy and resize old image into new image
        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // save thumbnail into a file
        if ($quality == -1)
            $imgt($tmp_img, "{$pathToThumbs}");
        else {
            if (isset($filter)) {
                $imgt($tmp_img, "{$pathToThumbs}", $quality, $filter);
            } else
                $imgt($tmp_img, "{$pathToThumbs}", $quality);
        }
    }
}

function time_diff($t1, $t2) {
    if ($t1 > $t2) {
        $time1 = $t2;
        $time2 = $t1;
    } else {
        $time1 = $t1;
        $time2 = $t2;
    }
    $diff = array(
        'years' => 0,
        'months' => 0,
        'weeks' => 0,
        'days' => 0,
        'hours' => 0,
        'minutes' => 0,
        'seconds' => 0
    );
    foreach (array('years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds')
    as $unit) {
        while (TRUE) {
            $next = strtotime("+1 $unit", $time1);
            if ($next < $time2) {
                $time1 = $next;
                $diff[$unit] ++;
            } else {
                break;
            }
        }
    }
    return($diff);
}

function constantDefined($constantVar) {
    return !defined($constantVar) ? false : constant($constantVar);
}

function directory_copy($src, $dst) {
    $dir = @opendir($src);

    @mkdir($dst);
    while (false !== ( $file = readdir($dir))) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if (is_dir($src . '/' . $file)) {
                @directory_copy($src . '/' . $file, $dst . '/' . $file);
            } else {
                @copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    @closedir($dir);
}

function AddWebiteFolderToUrl($StringText) {
    global $WebsiteUrl;
    $AllWords = preg_split("/[\s]+/", $StringText);
    //cheking if it an url
    foreach ($AllWords as $key => $Word) {

        //find link code
        if (strstr($Word, 'href=')) {
            //search for link url
            if (strpos($Word, '"')) {
                $LinkSTart = strpos($Word, '"');
                $LinkEnd = strpos($Word, '"', $LinkSTart + 1);
                $LinkLen = strlen($Word);
                $TheLink = substr($Word, $LinkSTart + 1, $LinkLen - ($LinkSTart + ($LinkLen - $LinkEnd)) - 1);
                if (!stristr($TheLink, 'http') and ! stristr($TheLink, 'www') and ! stristr($TheLink, 'ftp')) {
                    $NewLink = $WebsiteUrl . $TheLink;
                    $StringText = str_replace($TheLink, $NewLink, $StringText);
                }//end if
            }//end if
        }//en if
    }//end for each

    return $StringText;
}

function EmptyDirectory($directory, $deleteRootToo = false) {
    //delte entire folder and sub folders
    if (substr($directory, -1) == "/") {
        $directory = substr($directory, 0, -1);
    }

    if (!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif (!is_readable($directory)) {
        return false;
    } else {
        $directoryHandle = opendir($directory);

        while ($contents = readdir($directoryHandle)) {
            if ($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if (is_dir($path)) {
                    EmptyDirectory($path, true);
                } else {
                    unlink($path);
                }
            }
        }

        closedir($directoryHandle);
        $directory . "\n";

        if ($deleteRootToo) {
            if (!rmdir($directory)) {

                return false;
            } else {
                return true;
            }
        }
    }
}

function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {

    /* Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 512 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boole $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function FixImageSize($srcW, $srcH, $maxW, $maxH, $fix = 0) {
    //$fix :  1=width, 2=height, 0=both
    if ($fix == 0) {
        if ($srcW / $maxW > $srcH / $maxH) {
            $factor = $maxW / $srcW;
        } else {
            $factor = $maxH / $srcH;
        }
    } elseif ($fix == 1) {
        $factor = $maxW / $srcW;
    } elseif ($fix == 2) {
        $factor = $maxH / $srcH;
    }
    $newW = (int) round($srcW * $factor);
    $newH = (int) round($srcH * $factor);
    return array($newW, $newH);
}

function PagePermission($pagenbr) {
    global $IdPage, $GroupId;


    $permdb = new db();
    $PermQuery = $permdb->get_row("SELECT * FROM `pages` WHERE `PageNbr`='" . $pagenbr . "' and `deleted`<>'1';");
    if ($PermQuery) {
        $ObjectId = $PermQuery->ObjectId;
        $IdPage = $PermQuery->IdPage;

        //echo 'SELECT `Permission` FROM `moderators` WHERE `GroupId`="'.$GroupId.'" and `ObjectId`="'.$ObjectId.'";';
        $permdbvar = new db();
        $Permission = $permdbvar->get_var('SELECT `Permission` FROM `moderators` WHERE `GroupId`="' . $GroupId . '" and `ObjectId`="' . $ObjectId . '";');
        //var_dump($Permission);
        if ($Permission != null) {
            if ($Permission == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    } else {
        return false;
    }//end if
}

//end function

function remotefilesize($url) { //return file size in Bytes
    $sch = parse_url($url, PHP_URL_SCHEME);
    if (($sch != "http") && ($sch != "https") && ($sch != "ftp") && ($sch != "ftps")) {
        return false;
    }  // Error: unrecognized URI scheme.
    if (($sch == "http") || ($sch == "https")) {
        $headers = array_change_key_case(get_headers($url, 1), CASE_LOWER);
        if (!array_key_exists("content-length", $headers)) {
            return false;
        }  // Error: no 'content-length' header.
        return $headers["content-length"];  // Return: $headers["content-length"] value.
    }
    if (($sch == "ftp") || ($sch == "ftps")) {
        $server = parse_url($url, PHP_URL_HOST);
        $port = parse_url($url, PHP_URL_PORT);
        $path = parse_url($url, PHP_URL_PATH);
        $user = parse_url($url, PHP_URL_USER);
        $pass = parse_url($url, PHP_URL_PASS);
        if ((!$server) || (!$path)) {
            return false;
        }  // Error: invalid FTP URI.
        if (!$port) {
            $port = 21;
        }
        if (!$user) {
            $user = "anonymous";
        }
        if (!$pass) {
            $pass = "phpos@";
        }
        switch ($sch) {
            case "ftp":
                $ftpid = ftp_connect($server, $port);
                break;
            case "ftps":
                $ftpid = ftp_ssl_connect($server, $port);
                break;
        }
        if (!$ftpid) {
            return false;
        }  // Error: could not connect to the FTP server.
        $login = ftp_login($ftpid, $user, $pass);
        if (!$login) {
            return false;
        }  // Error: could not login to the FTP server.
        $ftpsize = ftp_size($ftpid, $path);
        if ($ftpsize == -1) {
            return false;
        }  // Error: could not size the FTP file.
        ftp_close($ftpid);
        return $ftpsize;  // Return: $ftpsize value.
    }
}

function url_exists($url) {
    $headers = @get_headers($url);
    return preg_match('/^HTTP\/\d\.\d\s+(200)/', $headers[0]);
}

function subwords($string, $start, $length) { // use this function to avoid display of inread caracters like ?
    $substring = '';
    /*     * * get the first character  ** */
    //validate if the $start >=0 and <=len of string
    if ($start < 0 or $start >= strlen($string)) {
        return '';
    }
    //echo strlen($string) ;
    //validate if the string before  $start is character
    if ($start != 0) { // we dont cut string before the first letter
        if (ctype_space($string[$start - 1]) != true) {
            //go to the first space letter (th first word)
            for ($i = $start; $i < strlen($string); $i++) {
                if (ctype_space($string[$i]) == true) {
                    $start = $i;
                    $i = strlen($string);
                }
            }
        }
    }

    /*     * * get the last character ** */
    //validate  the $length
    $end = $start + $length;
    if ($end <= 0) {
        return '';
    }

    if ($end > strlen($string)) {
        $end = strlen($string);
    }
    //echo $end;
    //validate if the string after $end is character
    if ($end != strlen($string)) {
        if (ctype_space($string[$end] + 1) != true) {
            //got to last word before this letter
            for ($j = $end; $j > $start; $j--) {
                if (ctype_space($string[$j]) == true) {
                    $end = $j;
                    $j = $start;
                }
            }
        }
    }

    /* cut the string */
    //validate if $start before $end
    //echo $start . ' - ' .$end;

    if ($end <= $start or ( $end - $start) < 3) {
        return '';
    }

    //cut
    for ($k = $start; $k < $end; $k++) {
        $substring.= $string[$k];
    }

    return $substring;
}

function PrintMessageAndRedirect($titleMessage, $bodyMessage, $redirectTO) {
    global $ThemeName;
    if (is_file("Themes/$ThemeName/message.php")) {
        $messageTheme = (get_include_contents("Themes/$ThemeName/message.php"));
    } else {
        $messageTheme = '<div id="messageDIV" style="width: 100%;border: 1px dotted; " >
                            <div id="titleMessage" >{titleMessage}</div>
                            <div id="bodyMessage">{bodyMessage}</div>
                            <div id="redirectTO">{redirectTO}</div>
                        </div>';
    }
    $messageTheme = VarTheme("{titleMessage}", $titleMessage, $messageTheme);
    $messageTheme = VarTheme("{bodyMessage}", $bodyMessage, $messageTheme);
    $messageTheme = VarTheme("{redirectTO}", (YouWillRedirectToThisPage) . '<br/><a href="' . $redirectTO . '">' . $redirectTO . '</a>', $messageTheme);
    $printMessage = '<META HTTP-EQUIV=Refresh CONTENT="1; URL=' . $redirectTO . '">';
    return $printMessage . $messageTheme;
}

function NoRewriteLink($Link) { // use it to switch url from rewrite to standard
    global $Lang;
    if ($Link == "") {
        return $Link;
    }//end if
    if (strpos($Link, ".pt")) {
        //$Link =  $Link . "index.php?";
        $Link = str_replace("Prog", "index.php?Prog", $Link);
        $Link = str_replace(".pt", "", $Link);
        $Link = str_replace("_", "&", $Link);
        $Link = str_replace("-", "=", $Link);
        //$Link = $Link . "_Lang-" . $Lang . "_nl-1.pt";
    } else {
        return $Link;
    }//end if
    return $Link;
}

//end function

function send_mail_list($From, $FromName, $emails_array, $Subject, $Body, $AddAttachment = "", $AltBody = "", $AddReplyTo = "") {

    global $EmailMethode;
    //var_dump($emails_and_members_array);
    //die();
    if ($From == "") {
        return false;
    }//end if

    if ($FromName == "") {
        return false;
    }//end if

    if (!is_array($emails_array)) {
        return false;
    }//end if

    if ($Subject == "") {
        return false;
    }//end if

    if ($Body == "") {
        return false;
    }//end if

    require_once("includes/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();

    //$mail->IsSMTP();
    //$mail->IsHTML(true);
    //$mail->IsQmail();
    //$mail->IsMail();
    //$mail->IsSendmail() ;

    if (strtolower($EmailMethode) == "smtp") {
        global $SmtpHost, $SMTPusername, $SMTPpassword, $SmtpPort;
        $mail->IsSMTP();
        $mail->Host = $SmtpHost;
        $mail->Port = $SmtpPort;
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = $SMTPusername;
        $mail->Password = $SMTPpassword;
    } else {
        $mail->IsSendmail();
    }//end if

    $mail->From = $From;
    $mail->FromName = $FromName;

    $mail->AddAddress($From);

    foreach ($emails_array as $email_address) {
        //  echo $email_address;
        $mail->AddBCC($email_address);
    }

    $mail->IsHTML(true);
    $mail->Subject = $Subject;
    $mail->Body = $Body;

    if ($AddAttachment != "") {
        if (is_array($AddAttachment)) {
            $mail->AddAttachment($AddAttachment[0], $AddAttachment[1]);  // optional name
        } else {
            $mail->AddAttachment($AddAttachment);  // optional name
        }//end if
    }//end if

    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }//end if
}

//end function

function SendEmail($From, $FromName, $AddAddress, $Subject, $Body, $AddAttachment = "", $AltBody = "", $AddReplyTo = "") {

    global $EmailMethode;
    //ECHO "From ". $From."FromName ". $FromName."AddAddress ". $AddAddress."Subject ". $Subject."Body ".$Body."AddAttachment ".$AddAttachment. "AltBody ".$AltBody. "AddReplyTo ".$AddReplyTo;
    if ($From == "") {
        return false;
    }//end if

    if ($FromName == "") {
        return false;
    }//end if

    if ($AddAddress == "") {
        return false;
    }//end if

    if ($Subject == "") {
        return false;
    }//end if

    if ($Body == "") {
        return false;
    }//end if

    require_once("includes/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();

    //$mail->IsSMTP();
    //$mail->IsHTML(true);
    //$mail->IsQmail();
    //$mail->IsMail();
    //$mail->IsSendmail() ;

    if (strtolower($EmailMethode) == "smtp") {
        global $SmtpHost, $SMTPusername, $SMTPpassword, $SmtpPort, $SMTPSecure;
        $mail->IsSMTP();
        //$mail->SMTPDebug  = 1;
        $mail->Host = $SmtpHost;
        $mail->Port = $SmtpPort;
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = $SMTPusername;
        $mail->Password = $SMTPpassword;
        $mail->SMTPSecure = $SMTPSecure;
    } else {
        $mail->IsSendmail();
    }//end if
    $mail->From = $SMTPusername;
    $mail->FromName = $FromName;
    if (is_array($AddAddress)) {
        $mail->AddAddress($AddAddress[0], $AddAddress[1]);
    } else {
        $mail->AddAddress($AddAddress);
    }//end if

    $mail->IsHTML(true);
    $mail->Subject = $Subject;
    $mail->Body = $Body;

    if ($AddAttachment != "") {
        if (is_array($AddAttachment)) {
            $mail->AddAttachment($AddAttachment[0], $AddAttachment[1]);  // optional name
        } else {
            $mail->AddAttachment($AddAttachment);  // optional name
        }//end if
    }//end if

    if (!$mail->Send()) {
        return false;
    } else {
        return true;
    }//end if
}

//end function

function get_time_difference($start, $end) {

    //$UnixTimeStamp = "January 1 1970 00:00:00 UTC";
    $start = explode(" ", $start);
    $dateStart = explode("-", $start[0]);
    $timeStart = explode(":", $start[1]);
    $uts['start'] = DateToSeconds($dateStart[0], $dateStart[1], $dateStart[2]) + $timeStart[2] + $timeStart[1] * 60 + $timeStart[0] * 60 * 60;

    $end = explode(" ", $end);
    $dateEnd = explode("-", $end[0]);
    $timeEnd = explode(":", $end[1]);
    $uts['end'] = DateToSeconds($dateEnd[0], $dateEnd[1], $dateEnd[2]) + $timeEnd[2] + $timeEnd[1] * 60 + $timeEnd[0] * 60 * 60;

    if ($uts['start'] !== -1 && $uts['end'] !== -1) {
        if ($uts['end'] >= $uts['start']) {
            $diff = $uts['end'] - $uts['start'];
            if (intval((floor($diff / 86400)))) {
                $days = intval((floor($diff / 86400)));
            }
            $diff = $diff % 86400;
            if (intval((floor($diff / 3600)))) {
                $hours = intval((floor($diff / 3600)));
            }
            $diff = $diff % 3600;
            if (intval((floor($diff / 60)))) {
                $minutes = intval((floor($diff / 60)));
            }
            $diff = $diff % 60;
            $diff = intval($diff);
            return( array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff) );
        } else {
            trigger_error("Ending date/time is earlier than the start date/time", E_USER_WARNING);
        }//end if
    } else {
        trigger_error("Invalid date/time data detected", E_USER_WARNING);
    }//end if
    return( false );
}

//end function

function DateToSeconds($Year, $Month, $Day) {

    $SommeOfDays = 0;
    for ($j = 1; $j < $Year; $j++) {
        for ($i = 1; $i <= 12; $i++) {
            switch ($i) {
                case 1:
                    $days = 31;
                    break;
                case 2:
                    if ($j / 4 == 1) {
                        $days = 29;
                    } else {
                        $days = 28;
                    }
                    break;
                case 3:
                    $days = 31;
                    break;
                case 4:
                    $days = 30;
                    break;
                case 5:
                    $days = 31;
                    break;
                case 6:
                    $days = 30;
                    break;
                case 7:
                    $days = 31;
                    break;
                case 8:
                    $days = 31;
                    break;
                case 9:
                    $days = 30;
                    break;
                case 10:
                    $days = 31;
                    break;
                case 11:
                    $days = 30;
                    break;
                case 12:
                    $days = 31;
                    break;
                default:
                    $days = 0; // input error
            }
            $SommeOfDays += $days;
        }
    }

    //last year
    for ($i = 1; $i < $Month; $i++) {
        switch ($i) {
            case 1:
                $days = 31;
                break;
            case 2:
                if ($j / 4 == 1) {
                    $days = 29;
                } else {
                    $days = 28;
                }
                break;
            case 3:
                $days = 31;
                break;
            case 4:
                $days = 30;
                break;
            case 5:
                $days = 31;
                break;
            case 6:
                $days = 30;
                break;
            case 7:
                $days = 31;
                break;
            case 8:
                $days = 31;
                break;
            case 9:
                $days = 30;
                break;
            case 10:
                $days = 31;
                break;
            case 11:
                $days = 30;
                break;
            case 12:
                $days = 31;
                break;
            default:
                $days = 0; // input error
        }
        $SommeOfDays += $days;
    }
    $SommeOfDays +=$Day - 1;
    return $SommeOfDays * 24 * 60 * 60;
}

/*
  function get_time_difference( $start, $end ){
  $uts['start']      =    strtotime( $start );
  $uts['end']        =    strtotime( $end );
  if( $uts['start']!==-1 && $uts['end']!==-1 ){
  if( $uts['end'] >= $uts['start'] ){
  $diff    =    $uts['end'] - $uts['start'];
  if( $days == intval((floor($diff/86400))) )
  $diff = $diff % 86400;
  if( $hours == intval((floor($diff/3600))) )
  $diff = $diff % 3600;
  if( $minutes == intval((floor($diff/60))) )
  $diff = $diff % 60;
  $diff    =    intval( $diff );
  return( array('days'=>$days, 'hours'=>$hours, 'minutes'=>$minutes, 'seconds'=>$diff) );
  }else{
  trigger_error( "Ending date/time is earlier than the start date/time", E_USER_WARNING );
  }//end if
  }else{
  trigger_error( "Invalid date/time data detected", E_USER_WARNING );
  }//end if
  return( false );
  }//end function
 */

function DownloadLimit($local_file, $download_file, $download_rate) {
    global $EchoThem;

    $EchoThem = false;
    /*
      set the download rate limit (20.5 => 20,5 kb/s) or False if u dont.
      this function help u to prevent multi steaming down load like flaget or download manager to preserv bandwidth
      and u can hide the origina file name from visitors

     */
    // cheking if file exist
    if (file_exists($local_file) && is_file($local_file)) {
        if (function_exists('set_time_limit')) {
            @set_time_limit(0);
        }
        //cheking if we use Download rate speed
        if ($download_rate) {
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . filesize($local_file));
            header('Content-Disposition: filename=' . $download_file);
            header('Expires: 0');
            flush();
            $file = fopen($local_file, "r");
            while (!feof($file)) {
                // send the current file part to the browser
                print fread($file, round($download_rate * 1024));
                // flush the content to the browser
                flush();
                // sleep one second
                sleep(1);
            }
            fclose($file);
        } else {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($download_file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($local_file));
            ob_clean();
            flush();
            readfile($local_file);
            exit;
        }//end if
    } else {
        die('Error: The file does not exist!');
    }//end if
}

//end function

function ConverLink($Link) { // use it to switch betwen mode rew or standard mode for url's
    global $UseRew, $Lang, $WebsiteUrl;
    if ($Link == "") {
        return $Link;
    }//end if
    $db = new db();
    $ListLang = $db->get_results("SELECT `LangName` FROM `languages`");
    foreach ($ListLang as $L => $LName) {
        $LName->LangName;
        $Link = str_replace("&Lang=" . $LName->LangName, "", $Link);
        $Link = str_replace("_Lang-" . $LName->LangName, "", $Link);
    }
    $Link = str_replace($WebsiteUrl, "", $Link);
    $Link = str_replace("&nl=1", "", $Link);
    $Link = str_replace("_nl-1", "", $Link);
    if ($UseRew == "1") {
        if (!strpos($Link, ".pt")) {
            $Link = str_replace("index.php?", "", $Link);
            //$Link = str_replace("?", "", $Link);
            $Link = str_replace("&", "_", $Link);
            $Link = str_replace("=", "-", $Link);
            $Link = $Link . "_Lang-" . $Lang . "_nl-1.pt";
        } else {
            $Link = str_replace(".pt", "", $Link);
            $Link = $Link . "_Lang-" . $Lang . "_nl-1.pt";
        }//end if
    } else {
        if (strpos($Link, ".pt")) {
            $Link = str_replace(".pt", "", $Link);
            $Link = str_replace("_", "&", $Link);
            $Link = str_replace("-", "=", $Link);
            $Link = "?" . $Link . "&Lang=" . $Lang . "&nl=1";
            ;
        } else {
            $Link = $Link . "&Lang=" . $Lang . "&nl=1";
        }//end if
    }//end if
    return $Link;
}

//end function

function StripLinks($document) { // Get all links from html source code
    global $UseRew, $Lang;
    preg_match_all("'<\s*a\s.*?href\s*=\s*			# find <a href=
						([\"\'])?					# find single or double quote
						(?(1) (.*?)\\1 | ([^\s\>]+))		# if quote found, match up to next matching
													# quote, otherwise match up to next space
						'isx", $document, $links);


    // catenate the non-empty matches from the conditional subpattern

    while (list($key, $val) = each($links[2])) {
        if (!empty($val))
            $match[] = $val;
    }

    while (list($key, $val) = each($links[3])) {
        if (!empty($val))
            $match[] = $val;
    }

    // return the links
    if (isset($match)) {
        return $match;
    } else {
        
    }//end ifs
}

//end function

function echoLink($Link) { // use for saving links , if webadmin switch betwen mod rew or normal links
    global $UseRew, $Lang;

    if ($Link == "") {
        return $Link;
    }//end if
    //external links
    if (is_numeric(strpos(strtolower($Link), "http://")) or is_numeric(strpos(strtolower($Link), "https://")) or is_numeric(strpos(strtolower($Link), "ftp://"))) {
        return $Link;
    }//end if

    if ($Link == "#") {
        return $Link;
    }//end if

    if ($UseRew == "1") {
        if (!strpos(strtolower($Link), ".pt")) {
            return $Link;
        }//end if
    } else {
        if (!strpos(strtolower($Link), ".php")) {
            return $Link;
        }//end if
    }//end if

    if (strpos(strtolower($Link), "javascript")) {
        return $Link;
    }//end if
    //var_dump("http://google.com","http://") ;

    $Link = str_replace("_Lang-" . $Lang, "", $Link);
    $Link = str_replace("&Lang=" . $Lang, "", $Link);
    $Link = str_replace("_nl-1", "", $Link);
    $Link = str_replace("&nl=1", "", $Link);
    //$Link = str_replace("_qry-", "", $Link);
    //$Link = str_replace("&qry=", "", $Link);

    if ($UseRew == "1") {
        if (!strpos($Link, ".pt")) {
            $Link = str_replace("index.php?", "", $Link);
            //$Link = str_replace("?", "", $Link);
            $Link = str_replace("&", "_", $Link);
            $Link = str_replace("=", "-", $Link);
            $Link = $Link . "_Lang-" . $Lang . "_nl-1.pt";
        } else {
            $Link = str_replace(".pt", "", $Link);
            $Link = $Link . "_Lang-" . $Lang . "_nl-1.pt";
        }//end if
    } else {
        if (strpos($Link, ".pt")) {
            $Link = str_replace(".pt", "", $Link);
            $Link = str_replace("_", "&", $Link);
            $Link = str_replace("-", "=", $Link);
            $Link = "?" . $Link . "&Lang=" . $Lang . "&nl=1";
            ;
        } else {
            // BUG
            $Link = $Link . "&Lang=" . $Lang . "&nl=1";
        }//end if
    }//end if
    return $Link;
}

//end function

function XmlChildExists($xml, $childpath) {
    $result = $xml->xpath($childpath);
    if (count($result)) {
        return true;
    } else {
        return false;
    }
}

//end function

function CreateNaviPage($ArrayData, $MaxResultPerPage = 10, $ShowNaviBar = 0) {

    global $UseRew, $Lang;

    if (!$UseRew) {
        if (!strpos($_SERVER['QUERY_STRING'], '?')) {
            $The_QUERY_STRING = '?' . $_SERVER['QUERY_STRING'];
        } else {
            $The_QUERY_STRING = $_SERVER['QUERY_STRING'];
        }//end if
    } else {
        $The_QUERY_STRING = $_SERVER['QUERY_STRING'];
    }//end if

    if (isset($_GET['page'])) {
        $PageNbr = InputFilter($_GET['page']);
    } else {
        if ($UseRew) {
            $The_QUERY_STRING = $The_QUERY_STRING . '_page-1';
        } else {
            $The_QUERY_STRING = $The_QUERY_STRING . '&page=1';
        }//end if
        $PageNbr = 1;
    }//end if
    //http://127.0.0.1/release/Prog-pool_Lang-Arabic_nl-1_page-1_qry-_Lang-Arabic_nl-1.pt

    $The_QUERY_STRING = str_replace("_Lang-" . $Lang, "", $The_QUERY_STRING);
    //$The_QUERY_STRING = str_replace("&Lang=".$Lang, "", $The_QUERY_STRING);
    $The_QUERY_STRING = str_replace("_nl-1", "", $The_QUERY_STRING);
    $The_QUERY_STRING = str_replace("&nl=1", "", $The_QUERY_STRING);

    //echo "The_QUERY_STRING ". $The_QUERY_STRING."<br/>";

    $TotalNbrOfPages = count($ArrayData); // NUMBER OF RESULTS SEARCH
    $Start = ($PageNbr * $MaxResultPerPage) - $MaxResultPerPage + 1; // the start of result

    if ($TotalNbrOfPages >= ($PageNbr * $MaxResultPerPage)) {
        $End = $PageNbr * $MaxResultPerPage;
    } else {
        $End = ($PageNbr * $MaxResultPerPage) - ($PageNbr * $MaxResultPerPage - $TotalNbrOfPages);
    }
    $CreatePage = "";
    /*
      echo $TotalNbrOfPages .'<br/>';
      echo $MaxResultPerPage .'<br/>';
      echo $TotalNbrOfPages/$MaxResultPerPage .'<br/>';
      echo ceil($TotalNbrOfPages/$MaxResultPerPage) .'<br/>';
     */
    $nbrOfPages = ceil($TotalNbrOfPages / $MaxResultPerPage);

    if (($PageNbr > 0) and ( $PageNbr <= $nbrOfPages)) {
        //echo " TotalNbrOfPages " . $TotalNbrOfPages ."<BR/>";
        for ($i = $Start; $i <= $End; $i++) {
            $CreatePage.=$ArrayData[$i - 1]; //."<br/>";
        }//end for

        if (isset($_POST['qry'])) {
            $qry = PostFilter($_POST['qry']);
        } elseif (isset($_GET['qry'])) {
            $qry = InputFilter($_GET['qry']);
        } else {
            $qry = "none";
        }//end if
        //showing navigation bar
        if (!$UseRew) {
            $link = str_replace("page=" . $PageNbr, "page=1", $The_QUERY_STRING);
            $link = str_replace("&qry=" . $qry, "", $link) . "&qry=" . $qry;
        } else {
            $link = str_replace("page-" . $PageNbr, "page-1", $The_QUERY_STRING);
            $link = str_replace("_qry-" . $qry, "", $link) . "_qry-" . $qry . ".pt";
        }//end if
        //got ot the first search page
        $NaviBar = '<a href=' . $link . ' title=""> ' . " " . (First) . " " . ' </a>';

        //go tho history -1 search page
        if ($PageNbr == 1 or $PageNbr == 2) {
            $NaviBar .=" &lt; ";
        } else {
            if (!$UseRew) {
                $lthen = $PageNbr - 1;
                $link = str_replace("page=" . $PageNbr, "page=" . $lthen, $The_QUERY_STRING);
                $link = str_replace("&qry=" . $qry, "", $link) . "&qry=" . $qry;
                $NaviBar .='<a href=' . $link . ' title=""> ' . " &lt; " . ' </a>';
            } else {
                $lthen = $PageNbr - 1;
                $link = str_replace("page-" . $PageNbr, "page-" . $lthen, $The_QUERY_STRING);
                $link = str_replace("_qry-" . $qry, "", $link) . "_qry-" . $qry . ".pt";
                $NaviBar .='<a href=' . $link . ' title=""> ' . " &lt; " . ' </a>';
            }//end if
        }//end if

        $NaviBar .= $PageNbr . " , ";
        /*
          if($nbrOfPages>=5){
          $navi = $TotalNbrOfPages-$PageNbr+1;
          }
          else{
          $navi = $nbrOfPages-$PageNbr+1;
          }//end if
         */
        $navi = $nbrOfPages - $PageNbr + 1;

        $ppp = 1;
        for ($i = 1; $i < $navi; $i++) {
            $ppp = $PageNbr + $i;
            if ($UseRew) {
                $link = str_replace("page-" . $PageNbr, "page-" . $ppp, $The_QUERY_STRING);
                $link = str_replace("_qry-" . $qry, "", $link) . "_qry-" . $qry . ".pt";
                $NaviBar .='<a href=' . $link . ' title=""> ' . $ppp . ' </a> , ';
            } else {
                $link = str_replace("page=" . $PageNbr, "page=" . $ppp, $The_QUERY_STRING);
                $link = str_replace("&qry=" . $qry, "", $link) . "&qry=" . $qry;
                $NaviBar .='<a href=' . $link . ' title=""> ' . $ppp . ' </a> , ';
            }
        }//end for
        //echo "NaviBar :" .$NaviBar ."<br/> \n" ;
        //plus one step
        if ($PageNbr < $nbrOfPages) {
            $gthen = $ppp;
            if (!$UseRew) {
                $link = str_replace("page=" . $PageNbr, "page=" . $gthen, $The_QUERY_STRING);
                $link = str_replace("&qry=" . $qry, "", $link) . "&qry=" . $qry;
                $NaviBar .='<a href=' . $link . ' title=""> ' . " &gt; " . '</a>';
            } else {
                $link = str_replace("page-" . $PageNbr, "page-" . $gthen, $The_QUERY_STRING);
                $link = str_replace("_qry-" . $qry, "", $link) . "_qry-" . $qry . ".pt";
                $NaviBar .='<a href=' . $link . ' title=""> ' . " &gt; " . '</a>';
            }//end if
        } else {
            $NaviBar .=" &gt; ";
        }

        //last page
        if ($nbrOfPages == $PageNbr) {
            $NaviBar .= (Last);
        } else {
            if ($UseRew) {
                $link = str_replace("page-" . $PageNbr, "page-" . $nbrOfPages, $The_QUERY_STRING);
                $link = str_replace("_qry-" . $qry, "", $link) . "_qry-" . $qry . ".pt";
            } else {
                $link = str_replace("page=" . $PageNbr, "page=" . $nbrOfPages, $The_QUERY_STRING);
                $link = str_replace("&qry=" . $qry, "", $link) . "&qry=" . $qry;
            }
            $NaviBar .='<a href=' . $link . ' title="">' . " " . (Last) . " " . '</a>';
        }//end if
        //returning navigation bar or data?
    } else {
        $CreatePage = (NoResultForThisPageNbr);
    }//end if

    if ($ShowNaviBar == 1) {
        if (isset($NaviBar) and $nbrOfPages > 1) {// we dont show navi for one page result
            return $NaviBar;
        }
    } else {
        if (isset($CreatePage)) {
            return $CreatePage;
        }
    }
}

//end function

function FlipText($text) {
// used for flip text words direction 
//ex : one two there -> there two one
// we used in flash statistics for arabic lang RTL
    if ($text != "") {
        $x = explode(" ", $text);
        $y = "";
        for ($i = count($x) - 1; $i >= 0; $i--) {
            $y .= " " . $x[$i];
        }//end for
        return $y;
    } else {
        return "";
    }
}

//end function

function RenderColor() {
    $serie = "ABCDEF0123456789";
    $color = "";
    for ($i = 0; $i < 6; $i++) {
        $j = rand(0, 15);
        $color .= $serie[$j];
    }//end if
    return $color;
}

//end function

function OperatingSys() {
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $curos = strtolower($_SERVER['HTTP_USER_AGENT']);
    } else {
        $curos = '';
    }
    $uip = $_SERVER['REMOTE_ADDR'];
    $uht = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    if (strstr($curos, "mac")) {
        $uos = "MacOS";
    } else if (strstr($curos, "linux")) {
        $uos = "Linux";
    } else if (strstr($curos, "win")) {
        $uos = "Windows";
    } else if (strstr($curos, "bsd")) {
        $uos = "BSD";
    } else if (strstr($curos, "qnx")) {
        $uos = "QNX";
    } else if (strstr($curos, "sun")) {
        $uos = "SunOS";
    } else if (strstr($curos, "solaris")) {
        $uos = "Solaris";
    } else if (strstr($curos, "irix")) {
        $uos = "IRIX";
    } else if (strstr($curos, "aix")) {
        $uos = "AIX";
    } else if (strstr($curos, "unix")) {
        $uos = "Unix";
    } else if (strstr($curos, "amiga")) {
        $uos = "Amiga";
    } else if (strstr($curos, "os/2")) {
        $uos = "OS/2";
    } else if (strstr($curos, "beos")) {
        $uos = "BeOS";
    } else {
        $uos = "Other";
    }
    return strToLower($uos);
}

//end function

function UserBrowser() {
    $browsers = "mozilla msie gecko firefox konqueror safari netscape navigator opera mosaic lynx amaya omniweb";
    $browsers = explode(" ", $browsers);
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $nua = strToLower($_SERVER['HTTP_USER_AGENT']);
    } else {
        $nua = '';
    }
    $l = strlen($nua);
    for ($i = 0; $i < count($browsers); $i++) {
        $browser = $browsers[$i];
        if (strpos($nua, $browser)) {
            $UserBrowser = $browser;
        }
    } //end for
    if (!isset($UserBrowser)) {
        $UserBrowser = "bot";
    }
    return $UserBrowser;
}

//end function

/*
  function UserBrowser() {
  $browsers = "mozilla msie gecko firefox konqueror safari netscape navigator opera mosaic lynx amaya omniweb";
  $browsers = explode(" ", $browsers);
  if(isset($_SERVER['HTTP_USER_AGENT'])){
  $nua = strToLower( $_SERVER['HTTP_USER_AGENT']);
  }
  else{
  $nua = '';
  }
  echo $nua ."<br/>";
  $l = strlen($nua);
  for ($i=0; $i<count($browsers); $i++){
  $browser = $browsers[$i];
  $n = stristr($nua, $browser);
  if(strlen($n)>0){
  $BROWSER["ver"] = "";
  echo $BROWSER["nav"] = $browser;
  echo $j = strpos($nua, $BROWSER["nav"])+$n+strlen($BROWSER["nav"])+1;
  for (; $j<= $l; $j++){
  $s = substr ($nua, $j, 1);
  if(is_numeric($BROWSER["ver"].$s) )
  $BROWSER["ver"] .= $s;
  else
  break;
  } //end for
  }
  else{
  $BROWSER["nav"]='bot';
  }//end if

  } //end for
  return $BROWSER["nav"];
  }//end function
 */

function ContPermission($GroupId, $ObjectId) {
    // return permission to view this program for this user group
    //global $NickName, $UserId;

    if ($GroupId != "" and $ObjectId != "") {

        $dbContPerm = new db();
        //echo "SELECT `Permission` FROM `moderators` WHERE `GroupId`='".$GroupId."' and `ObjectId`='".$ObjectId."'; \n";
        $Permission = $dbContPerm->get_results(" SELECT `Permission` FROM `moderators` WHERE `GroupId`='" . $GroupId . "' and `ObjectId`='" . $ObjectId . "'; ");
        //var_dump($Permission);
        if (count($Permission)) {
            if ($Permission[0]->Permission == "1") {
                return true;
            } else {
                return false;
            }//end if
        } else {
            return true; // this block dont have record
        }//end if
    }//end if

    return true; // we dont set permission, per default permission is true
}

function GenerateID($TabelName, $NameOfID) {
    // GENERATE SERIAL  FOR TABEL ID

    global $NickName, $UserId;
    // NOTE: Any ID WELL BE IN THIS FORMAT : YYYY9999999, where yyyy is the year of id , and 9999999 is the auto increment number from -1 to 9999999
    date_default_timezone_set('Europe/London'); // addedd after fasterface social bug ,GMT default time zone
    $StartId = -1; // admin in default have id = -1
    $FinishId = 9999999; //for  id 7 characters

    $dbGenerateID = new db();
    //$ = $dbGenerateID->get_results("SELECT MAX(`".$NameOfID."`) AS ID FROM `".$TabelName."`;");
    $ID = $dbGenerateID->get_var("SELECT MAX(`" . $NameOfID . "`) AS ID FROM `" . $TabelName . "`;");

    //var_dump( $ID );

    if ($ID) {
        //$AdminMail= $AdminMail[0]->AdminMail;
        $idExsist = $ID;
        if ($idExsist != null) {
            $year = substr($idExsist, 0, 4);
            if ($year == date("Y")) { // If max year is current year
                $GenerateID = $idExsist + 1;
            } else {
                //$counter = '0000';substr($idExsist,4);
                $GenerateID = date("Y") . '0000000';
            }
        } else {
            // table is empty
            $GenerateID = date("Y") . '0000000';
        }//end if
    } else {
        $GenerateID = date("Y") . '0000000';
    }
    // closeQuery();
    //echo '<br>'. $GenerateID."<br>";
    return $GenerateID;
}

function CookieLife($Period) {
    switch ($Period) {
        case "Year":
            return 31104000;
            break;
        case "Month":
            return 2592000;
            break;
        case "Week":
            return 604800;
            break;
        case "Day":
            return 86400;
            break;
        default:
            return 0;
    }//end switch
}

//end function

function VarTheme($VarCont, $RepWith, $Theme) { // transform VarCont to specified variable
    $Theme = str_replace($VarCont, $RepWith, $Theme);
    return $Theme;
}

//end function

function NewLangLink($OldLang, $NewLang) { //get url for new lang
    $oldUrl = $_SERVER['QUERY_STRING'];
    if (strstr($oldUrl, $OldLang)) {
        $newUrl = str_replace($OldLang, $NewLang, $oldUrl);
    } else {
        $newUrl = $oldUrl . "&Lang=" . $NewLang;
    }//end if
    return $newUrl;
}

//end function

function LangLink($QryUrl) {//return link if user use rew or no for language
    global $UseRew;
    if ($UseRew == "1") {//website use rewrite url
        $QryUrl = str_replace("-_", "_", $QryUrl);
        $QryUrl = RewriteUrl($QryUrl);
        $QryUrl = str_replace("-_", "_", $QryUrl);
        $QryUrl = str_replace("-.pt", ".pt", $QryUrl);
        return $QryUrl;
    } else { //simple links
        $Link = str_replace("index.php?", "", $QryUrl);
        $Link = "index.php?" . $Link;
        return $Link;
    }//end if
}

//end function

function RewriteUrl($QryUrl) {
    global $rwrt;
    return $rwrt->mylink("?" . $QryUrl, $rwrt->settings['mod_rewrite']);
}

//end function

function CreateLinkNoLang($QryUrl, $Vars, $Vals) {//return link if user use rew or no
    global $SqlType, $conn;

    //we have to choise to call this funtion once from user side, and another from admin side,
    //and because admin always dont use rewrite , therefor e we want to always get $UseRew from the databse
    /*     * *********** */
    $dbrewQuery = new db();
    $rewQuery = $dbrewQuery->get_row("SELECT * FROM `params`;");

    if (count($rewQuery) > 0) {
        $UseRew = $rewQuery->UseRew;
    } else {
        $UseRew = "0";
    }//end if

    /*     * *********** */

    if ($UseRew == "1") {//website use rewrite url
        // code for rew
        foreach ($Vars as $i => $var) {
            if ($i == 0) {
                if ($QryUrl != "") {
                    $Link = $QryUrl . "&" . $var . "=" . $Vals[$i];
                } else {
                    $Link = $var . "=" . $Vals[$i];
                }//end if
            } else {
                if ($var != "") {
                    $Link .= "&" . $var . "=" . $Vals[$i];
                }//end if
            }//end if
        }
        global $rwrt, $project;
        $project = "phpTransformer";

        if (is_file("includes/Rewrite.php")) {
            include_once("includes/Rewrite.php");
        } else {
            include_once("Rewrite.php");
        }


        return $rwrt->mylink("?" . $Link, $rwrt->settings['mod_rewrite']);
    } else { //simple links
        foreach ($Vars as $i => $var) {
            if (!$i) {
                if ($QryUrl != "") {
                    $Link = "index.php?" . $QryUrl . "&" . $var . "=" . $Vals[$i];
                } else {
                    $Link = "index.php?" . $var . "=" . $Vals[$i];
                }
            } else {
                $Link.="&" . $var . "=" . $Vals[$i];
            }//end if
        }
        return $Link;
    }//end if
}

function CreateLink($QryUrl, $Vars, $Vals, $diez = "") {//return link if user use rew or no
    global $Lang, $SqlType, $conn, $WebsiteUrl, $scheme;
// force fix language 
    if (isset($_GET['thm'])) {
        $Vars[] = "thm";
        $Vals[] = InputFilter($_GET['thm']);
    }
    $Vars[] = "Lang";
    $Vals[] = $Lang;
    $Vars[] = "nl";
    $Vals[] = "1";

    //we have to choise to call this funtion once from user side, and another from admin side,
    //and because admin always dont use rewrite , therefor e we want to always get $UseRew from the databse
    /*     * *********** */
    $dbrewQuery = new db();
    $rewQuery = $dbrewQuery->get_row("SELECT * FROM `params`;");

    if (count($rewQuery) > 0) {
        $UseRew = $rewQuery->UseRew;
    } else {
        $UseRew = "0";
    }//end if
    /*     * *********** */

    if ($UseRew == "1") {//website use rewrite url
        // code for rew
        foreach ($Vars as $i => $var) {
            if ($i == 0) {
                if ($QryUrl != "") {
                    $Link = $QryUrl . "&" . $var . "=" . $Vals[$i];
                } else {
                    $Link = $var . "=" . $Vals[$i];
                }//end if
            } else {
                if ($var != "") {
                    $Link .= "&" . $var . "=" . $Vals[$i];
                }//end if
            }//end if
        }
        global $rwrt, $project;
        $project = "phpTransformer";
        if(is_file("includes/Rewrite.php"))
            include_once("includes/Rewrite.php");
        else
            include_once("Rewrite.php");

        $Link = str_replace('http', $scheme, $rwrt->mylink("?" . $Link, $rwrt->settings['mod_rewrite']));
    } else { //simple links
        foreach ($Vars as $i => $var) {
            if (!$i) {
                if ($QryUrl != "") {
                    $Link = "index.php?" . $QryUrl . "&" . $var . "=" . $Vals[$i];
                } else {
                    $Link = "index.php?" . $var . "=" . $Vals[$i];
                }
            } else {
                $Link.="&" . $var . "=" . $Vals[$i];
            }//end if
        }
        $Link = str_replace('http', $scheme, $Link);
    }//end if
    if ($diez != "") {
        $Link .= '#' . $diez;
    }
    return str_replace('httpss', 'https', $Link); // bug ss
}

function GetPageContent($PageUrl) { //get page content from url
    if (function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    //echo $PageUrl;
    if ($PageUrl) {
        $handle = @fopen($PageUrl, "rb");
        $GetPageContent = @stream_get_contents($handle);
        @fclose($handle);
        return $GetPageContent;
    }//end if
}

//end function

function get_include_contents($filename) { // get include files into variable
    global $project; // used for denie access to included file directly by calling  files by directories
    if (function_exists('set_time_limit')) {
        @set_time_limit(0);
    }
    //echo $filename;
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return ProgramERR; //.' : '.$filename.'<br/>';
}

//end function

function EncryptMd5Text($Md5Text) {
    $MidText = $Md5Text[1] . $Md5Text[0] . $Md5Text[3] . $Md5Text[2] . $Md5Text[5] . $Md5Text[4] . $Md5Text[7] . $Md5Text[6] . $Md5Text[9] . $Md5Text[8] . $Md5Text[11] . $Md5Text[10] . $Md5Text[13] . $Md5Text[12] . $Md5Text[15] . $Md5Text[14] . $Md5Text[17] . $Md5Text[16] . $Md5Text[19] . $Md5Text[18] . $Md5Text[21] . $Md5Text[20] . $Md5Text[23] . $Md5Text[22] . $Md5Text[25] . $Md5Text[24] . $Md5Text[27] . $Md5Text[26] . $Md5Text[29] . $Md5Text[28] . $Md5Text[31] . $Md5Text[30];
    for ($i = 31; $i >= 0; $i--) {
        if (isset($ArrayText)) {
            $ArrayText.=$MidText[$i];
        } else {
            $ArrayText = $MidText[$i];
        }
    }
    return $ArrayText;
}

//end function

function DecryptMd5Text($EncryptMd5Text) {
    for ($i = 31; $i >= 0; $i--) {
        if (isset($Md5Text)) {
            $Md5Text.=$EncryptMd5Text[$i];
        } else {
            $Md5Text = $EncryptMd5Text[$i];
        }
    }
    $OrgText = $Md5Text[1] . $Md5Text[0] . $Md5Text[3] . $Md5Text[2] . $Md5Text[5] . $Md5Text[4] . $Md5Text[7] . $Md5Text[6] . $Md5Text[9] . $Md5Text[8] . $Md5Text[11] . $Md5Text[10] . $Md5Text[13] . $Md5Text[12] . $Md5Text[15] . $Md5Text[14] . $Md5Text[17] . $Md5Text[16] . $Md5Text[19] . $Md5Text[18] . $Md5Text[21] . $Md5Text[20] . $Md5Text[23] . $Md5Text[22] . $Md5Text[25] . $Md5Text[24] . $Md5Text[27] . $Md5Text[26] . $Md5Text[29] . $Md5Text[28] . $Md5Text[31] . $Md5Text[30];
    return $OrgText;
}

//end function

function Pagination($content, $inpage = 10, $show = 10) { // google like pagination
    global $UseRew, $Lang;
    /* split array into new array */
    $Portions = ceil(count($content) / $inpage);
    $NewContent = array();
    for ($j = 0; $j < $Portions; $j++) {
        $Protion = '';
        for ($k = $j * $inpage; $k < ($inpage + $j * $inpage); $k++) {
            if (isset($content[$k])) {
                $Protion .= ' ' . $content[$k];
            }
        }
        $NewContent[] = $Protion;
    }

    /* end split array into new array */

    if ($Portions > 1) {
        /* end refactor the links  */
        if (isset($_GET['page'])) {
            $PageNbr = InputFilter($_GET['page']);
        } else {
            $PageNbr = '';
        }

        if (!$UseRew) {
            if (!strpos($_SERVER['QUERY_STRING'], '?')) {
                $The_QUERY_STRING = '?' . $_SERVER['QUERY_STRING'];
            } else {
                $The_QUERY_STRING = $_SERVER['QUERY_STRING'];
            }//end if
        } else {
            $The_QUERY_STRING = $_SERVER['QUERY_STRING'];
        }//end if

        $The_QUERY_STRING = str_replace('_nl-1', '', $The_QUERY_STRING);
        $The_QUERY_STRING = str_replace('&nl=1', '', $The_QUERY_STRING);
        $The_QUERY_STRING = str_replace('&page=' . $PageNbr, '', $The_QUERY_STRING);
        $The_QUERY_STRING = str_replace('_page-' . $PageNbr, '', $The_QUERY_STRING);
        $The_QUERY_STRING = str_replace("_Lang-" . $Lang, "", $The_QUERY_STRING);
        $The_QUERY_STRING = str_replace("&Lang=" . $Lang, "", $The_QUERY_STRING);

        $firstlink = $The_QUERY_STRING;

        $showing = !isset($_GET["page"]) ? 1 : $_GET["page"];
        if (!$UseRew) {
            $seperator = '&page=';
        } else {
            $seperator = '_page-';
        }
        $baselink = $firstlink;
        $number = count($NewContent);
        $disp = floor($show / 2);
        if ($showing <= $disp) {
            if (($disp - $showing) > 0) {
                if (($disp - $showing) > $show) {
                    $low = ($disp - $showing);
                } else {
                    $low = 1;
                }
            } else {
                $low = 1;
            }
            $high = ($low + $show) - 1;
        } elseif (($showing + $disp) > $number) {

            $high = $number;

            if ((($number - $show) + 1) > 0) {
                $low = ($number - $show) + 1;
            } else {
                $low = 1;
            }
        } else {
            $low = ($showing - $disp);
            $high = ($showing + $disp);
        }

        // next / prev / first / last
        if (($showing - 1) > 0) :
            if (($showing - 1) == 1):
                $prev = quickLink($firstlink, Previous, '', Previous);
            else:
                $prev = quickLink($baselink . $seperator . ($showing - 1), Previous, 'z', Previous);
            endif;
        else:
            $prev = Previous;
        endif;

        $next = ($showing + 1) <= $number ?
                quickLink($baselink . $seperator . ($showing + 1), Next, 'x', Next) : Next;
        if ($_SERVER['REQUEST_URI'] == $firstlink):
            $first = '<span class="PaginationSel">First Page</span>';
        else:
            $first = quickLink($firstlink, First, '', First);
        endif;
        if ($showing == $number):
            $last = '<span class="PaginationSel">' . Last . '</span>';
        else:
            $last = quickLink($baselink . $seperator . $number, Last, '', Last);
        endif;
        $navi = '<div id="pagination" class="pagination" >' . "\n";
        // start the navi
        $navi .= ' ' . $prev . " \n";
        // loop through the numbers
        foreach (range($low, $high) as $newnumber):

            $link = ( $newnumber == 1 ) ? $firstlink :
                    $baselink . $seperator . $newnumber;
            if ($newnumber > $number):
                $navi .= '';
            elseif ($newnumber == 0):
                $navi .= '';
            else:
                $navi .= ( $newnumber == $showing ) ?
                        '<span class="PaginationSel">' . $newnumber . '</span>' . "\n" : ' ' . quickLink($link, PageNbr . ' ' . $newnumber, '', $newnumber) . " \n";
            endif;
        endforeach;
        // end the navi first line
        $navi .= ' ' . $next . " \n";
        $navi .= ' ' . "\n";
        // second line
        $navi .= '<br>' . $first . ' | ' . count($content) . ' ' . ResultRows . " \n , " . Page . " " . $showing . ' ' . Of . ' ' . $number . " |\n  " .
                $last . '</br>
            </div>';
        return $Pagination = array($NewContent[$showing - 1], $navi);
    }else {
        if (count($NewContent)) {
            return $Pagination = array($NewContent[0], '');
        }
    }
}

//end Function

function quickLink($linkHref, $desc, $accessKey, $linkTitle) {
    # writes out page links
    global $UseRew, $Lang;
    if (!isset($_GET['qry'])) {
        if ($UseRew) {
            $linkHref .='_qry-';
        } else {
            $linkHref .='&qry=';
        }
    }
    if ($UseRew) {
        $linkHref .='_Lang-' . $Lang . '_nl-1.pt';
    } else {
        $linkHref .='&Lang=' . $Lang . '&nl=1';
    }

    $theLink = '<a href="' . $linkHref . '" title="' . $desc . '" accesskey="' . $accessKey . '">' . $linkTitle . '</a>';
    return $theLink;
}

function ValidLicense($LicenseKey, $ObjectName) {  //depricated function
    if ($LicenseKey == "" or strlen($LicenseKey) < 123) {
        return false;
    }//end if



    $Cut1 = substr($LicenseKey, 0, 3); //1
    $Cut2 = substr($LicenseKey, 3, 14); //3
    $Cut3 = substr($LicenseKey, 17, 16); //8
    $Cut4 = substr($LicenseKey, 33, 14); //2
    $Cut5 = substr($LicenseKey, 47, 14); //5
    $Cut6 = substr($LicenseKey, 61, 14); //4
    $Cut7 = substr($LicenseKey, 75, 16); //9
    $Cut8 = substr($LicenseKey, 91, 16); //6
    $Cut9 = substr($LicenseKey, 107, 16); //7
    $Cut10 = substr($LicenseKey, 123, strlen($LicenseKey) - 123); //10
    $RegDomain = base64_decode($Cut10); // values : "ANY" or the domian name
    $LicenseDomain = $RegDomain;

    if ($RegDomain == "ANY") {
        $RegDomain = true;
    } else {

        if (($_SERVER['SERVER_NAME']) == strtolower($RegDomain)) {
            $RegDomain = true;
        } elseif (strtolower($_SERVER['SERVER_NAME']) == "www." . strtolower($RegDomain)) {
            $RegDomain = true;
        } else {
            $RegDomain = false;
        }//end if
    }//end if

    $RegStartDate = base64_decode($Cut4 . $Cut2);
    if (date("Y-m-d H:i:s") >= $RegStartDate) {
        $RegStartDate = true;
    } else {
        $RegStartDate = false;
    }//end if

    $RegEndDate = base64_decode($Cut6 . $Cut5); //LIFETIMEXXXXXXXXXXX OR DATE
    //GET NUMBER OF DAYS LEFT TO EXPIRY DATE
    if ($RegEndDate == "LIFETIMEXXXXXXXXXXX") {
        $RegEndDate = true;
        $DaysLeft = "Unlimited";
    } else {
        if (date("Y-m-d H:i:s") <= $RegEndDate) {

            $DaysLeft = get_time_difference(date("Y-m-d H:i:s"), $RegEndDate);
            $DaysLeft = $DaysLeft['days'];
            $RegEndDate = true;
        } else {
            $RegEndDate = false;
            $DaysLeft = "Expired";
        }//end if
    }//end if

    $RegSource = strtolower($Cut8 . strrev($Cut9)); // values : "ENC" mean Encrypted or "OPN" mean "Open source"
    if (md5("ENC") == $RegSource) {
        $RegSource = "ENC";
    } elseif (md5("OPN") == $RegSource) {
        $RegSource = "OPN";
    } else {
        $RegSource = false;
    }//end if

    $RegPakage = $Cut3 . $Cut7; // values : "STD" mean Sandard OR "ADV" mean Advanced
    if (md5("STD") == $RegPakage) {
        $RegPakage = "STD";
    } elseif (md5("ADV") == $RegPakage) {
        $RegPakage = "ADV";
    } else {
        $RegPakage = false;
    }//end if

    if ($Cut1 == "1bd") { //ANY domain
        $ObjectName = true;
    } else {
        if (substr(md5($ObjectName), 2, 3) == $Cut1) {
            $ObjectName = true;
        } elseif (substr(md5($LicenseDomain), 2, 3) == $Cut1) {
            $ObjectName = true;
        } else {
            $ObjectName = false;
        }//end if
    }//end if
    //$RegRandom			= $Cut1;

    if ($RegDomain == true and $RegStartDate == true and $RegEndDate == true and $ObjectName == true) {
        return true;
    } else {
        return false;
    }//end if
}

//End function

function LicenseInfo($LicenseKey) {

    if ($LicenseKey == "" or strlen($LicenseKey) < 123) {
        return false;
    }//end if

    $Cut1 = substr($LicenseKey, 0, 3); //1
    $Cut2 = substr($LicenseKey, 3, 14); //3
    $Cut3 = substr($LicenseKey, 17, 16); //8
    $Cut4 = substr($LicenseKey, 33, 14); //2
    $Cut5 = substr($LicenseKey, 47, 14); //5
    $Cut6 = substr($LicenseKey, 61, 14); //4
    $Cut7 = substr($LicenseKey, 75, 16); //9
    $Cut8 = substr($LicenseKey, 91, 16); //6
    $Cut9 = substr($LicenseKey, 107, 16); //7
    $Cut10 = substr($LicenseKey, 123, strlen($LicenseKey) - 123); //10
    $RegDomain = base64_decode($Cut10); // values : "ANY" or the domian name
    $RegStartDate = base64_decode($Cut4 . $Cut2);
    $RegEndDate = base64_decode($Cut6 . $Cut5); //LIFETIMEXXXXXXXXXXX OR DATE

    if ($RegEndDate == "LIFETIMEXXXXXXXXXXX") {
        $RegEndDate = "LIFETIME";
    }//end if

    $RegSource = strtolower($Cut8 . strrev($Cut9)); // values : "ENC" mean Encrypted or "OPN" mean "Open source"
    if (md5("ENC") == $RegSource) {
        $RegSource = "ENC";
    } elseif (md5("OPN") == $RegSource) {
        $RegSource = "OPN";
    } else {
        $RegSource = false;
    }//end if

    $RegPakage = $Cut3 . $Cut7; // values : "STD" mean Sandard OR "ADV" mean Advanced
    if (md5("STD") == $RegPakage) {
        $RegPakage = "STD";
    } elseif (md5("ADV") == $RegPakage) {
        $RegPakage = "ADV";
    } else {
        $RegPakage = false;
    }//end if



    if ($Cut1 == "1bd") { //ANY domain
        $ObjectName = "ANY";
    } else {
        $ObjectName = "SPECIFIED";
    }//end if

    return $LicenseInfo = array("RegDomain" => $RegDomain,
        "RegStartDate" => $RegStartDate,
        "RegEndDate" => $RegEndDate,
        "RegSource" => $RegSource,
        "RegPakage" => $RegPakage,
        "ObjectName" => $ObjectName);
}

//End function

function IsValidPartnerKey($LicenseKey, $Object, $HostRef) {
    global $Recordset, $TotalRecords, $Rows;

    if (isset($HostRef)) {

        if ($HostRef == "") {
            return true;
        }//end if
        /*
          $ReferHost = parse_url($HostRef);

          if(isset($ReferHost['host'])){
          $Host =  strtolower($ReferHost['host']);
          $Host = str_replace("www.","",$Host );
          $Host = str_replace("WWW.","",$Host );
          }
          else{
          $Host = '';
          }//end if
         */
        // return 'Host : '.$Host= $HostRef;
        $LicenseInfo = LicenseInfo($LicenseKey);
        $PartnerSite = $LicenseInfo['RegDomain'];
        $PartnerSite = explode('||', $PartnerSite);
        $PartnerHost = $PartnerSite[0];

        $PartnerObject = $PartnerSite[1];

        $PartnerHost = str_replace("http://", "", $PartnerHost);
        $PartnerHost = str_replace("HTTP://", "", $PartnerHost);

        $PartnerHost = str_replace("www.", "", $PartnerHost);
        $PartnerHost = str_replace("WWW.", "", $PartnerHost);
        //echo 	'PartnerHost ' .$PartnerHost;
        //echo '<br/>';
        //echo 'PartnerObject '.$PartnerObject;

        $Query = "select * from `licensept` where `LicenseKey`='" . $LicenseKey . "' and `DidUHavedomainName`='" . $PartnerHost . "' ;";
        ExcuteQuery($Query);
        if ($TotalRecords > 0) {
            $LicenseOk = $Rows['LicenseOk'];
            if ($LicenseOk != '1') {
                //return "adminOK";
                return false; //Admin Must Say Ok First
            }

            if ($HostRef != $PartnerHost) {
                return false; //  parnter host
            }//end if
            $LicenseInfo['ObjectName'];
            if ($PartnerObject != 'ANY') {
                if ($Object != $PartnerObject) {
                    return false; // object name error
                }
            }
        } else {
            return false; // key not found
        }//end if
        return true;
    } else {
        //return "NoReferer";
        return true; //direct type in url get
    }//end if
}

function create_pagination_link($class, $label, $value, $validator, $url_variables, $url_values, $tab_template, $all_tabs, $admin_link = false) {
    $page_label = $label;
    if ($validator == 1) {
        $page_class = "pagination_" . $class;
        $current_url_variables = $url_variables;
        $current_url_variables[] = 'page';
        $current_url_values = $url_values;
        $current_url_values[] = $value;
        if ($admin_link) {
            $page_link = AdminCreateLink('', $current_url_variables, $current_url_values);
        } else {
            $page_link = CreateLink('', $current_url_variables, $current_url_values);
        }
    } else {
        $page_class = "pagination_disabled";
        $page_link = "#";
    }
    $page_link = 'href="' . $page_link . '"';
    $current_tab_template = $tab_template;
    $current_tab = str_replace(array('{page_label}', '{page_link}', '{page_class}'), array($page_label, $page_link, $page_class), $current_tab_template);

    return $current_tab;
}

function paginate_results($results_count_per_page, $results_page_count_to_navigate_between, $all_results_count, $page_number, $url_variables = array(), $url_values = array(), $admin_link = false) {
    global $ThemeName, $db;
    $container_template = file_get_contents("Themes/" . $ThemeName . "/pagination-container.php");
    $tab_template = file_get_contents("Themes/" . $ThemeName . "/pagination-tab.php");

    $all_tabs = "";
    if ($all_results_count <= $results_count_per_page) {//In this case all result are show in one page and no need for pagination
        $page_link = ' ';
        $current_tab_template = $tab_template;
        $current_tab = str_replace(array('{page_label}', '{page_link}', '{page_class}'), array(1, $page_link, "pagination_current"), $current_tab_template);
        $all_tabs.= $current_tab;
    } else {
        $total_pages_count = (($all_results_count % $results_count_per_page) == 0 || ($results_count_per_page == 1)) ? ($all_results_count / $results_count_per_page) : floor($all_results_count / $results_count_per_page) + 1;

        $pages_start = ($page_number > (floor($results_page_count_to_navigate_between / 2) + 1)) ? $page_number - floor($results_page_count_to_navigate_between / 2) : 1;
        $pages_end = ($pages_start + ($results_page_count_to_navigate_between - 1));

        if ($pages_end >= $total_pages_count) {
            $pages_end = $total_pages_count;
        }

        $with_first = ($page_number > 1) ? 1 : 0;
        $with_previous = ($page_number > 1) ? 1 : 0;
        $with_next = ($page_number < $total_pages_count) ? 1 : 0;
        $with_last = ($total_pages_count >= ($page_number + 1));

        $all_tabs = create_pagination_link("first", First, 1, $with_first, $url_variables, $url_values, $tab_template, $all_tabs, $admin_link);

        $all_tabs .= create_pagination_link("previous", Previous, ($page_number - 1), $with_previous, $url_variables, $url_values, $tab_template, $all_tabs, $admin_link);

        for ($i = $pages_start; $i <= $pages_end; $i++) {
            if ($i == $page_number) {
                $page_class = "pagination_current";
                $page_link = ' ';
                $page_label = $i;
            } else {
                $page_class = "pagination_page";
                $current_url_variables = $url_variables;
                $current_url_variables[] = 'page';
                $current_url_values = $url_values;
                $current_url_values[] = $i;
                if ($admin_link) {
                    $page_link = AdminCreateLink('', $current_url_variables, $current_url_values);
                } else {
                    $page_link = CreateLink('', $current_url_variables, $current_url_values);
                }
                $page_link = 'href="' . $page_link . '"';
                $page_label = $i;
            }
            $current_tab_template = $tab_template;
            $current_tab = str_replace(array('{page_label}', '{page_link}', '{page_class}'), array($page_label, $page_link, $page_class), $current_tab_template);
            $all_tabs .= $current_tab;
        }

        $all_tabs .= create_pagination_link("next", next, ($page_number + 1), $with_next, $url_variables, $url_values, $tab_template, $all_tabs, $admin_link);

        $all_tabs .= create_pagination_link("last", Last, $total_pages_count, $with_last, $url_variables, $url_values, $tab_template, $all_tabs, $admin_link);
    }
    $container = str_replace(array('{all_tabs}'), array($all_tabs), $container_template);
    return $container;
}

function socialDateDif($start, $end, $unit_show) {
    $diff = timeDiff($start, $end);
    $out = "";
    $names = array('years', 'months', 'weeks', 'days', 'minutes', 'hours', 'seconds');
    $labels = array(years, months, weeks, days, minutes, hours, seconds);

    foreach ($diff as $unit => $value) {
        $i = 0;
        foreach ($names as $name) {
            if ($unit == $name && $value != 0) {
                $out.=$value;
                if ($unit_show == true) {
                    $out.= ' ' . $labels[$i] . ' ';
                    break;
                }
            }
            $i++;
        }
    }
    if (DirHtml == 'rtl') {
        return ago . ' ' . $out;
    } else {
        return $out . ' ' . ago;
    }
}

function timeDiff($t1, $t2) {
    if ($t1 > $t2) {
        $time1 = $t2;
        $time2 = $t1;
    } else {
        $time1 = $t1;
        $time2 = $t2;
    }
    $diff = array(
        'years' => 0,
        'months' => 0,
        'weeks' => 0,
        'days' => 0,
        'hours' => 0,
        'minutes' => 0,
        'seconds' => 0
    );
    foreach (array('years', 'months', 'weeks', 'days', 'hours', 'minutes', 'seconds')
    as $unit) {
        while (TRUE) {
            $next = strtotime("+1 $unit", $time1);
            if ($next <= $time2) {
                $time1 = $next;
                $diff[$unit] ++;
            } else {
                break;
            }
        }
    }
    return($diff);
}

function RightLangFileName($filename) {

    // Return the right filename for language
    $filtered_filename = "";

    $patterns = array(
        "/\s/", # Whitespace
        "/\&/", # Ampersand
        "/\+/"  # Plus
    );
    $replacements = array(
        "", # Whitespace
        "", # Ampersand
        "" # Plus
    );

    $filename = preg_replace($patterns, $replacements, $filename);
    for ($i = 0; $i < strlen($filename); $i++) {
        $current_char = substr($filename, $i, 1);

        //if(!preg_match('/^([\p{Latin}]|\s) $/u', utf8_decode($current_char))) { //Blank file name bug
        if (!preg_match("/^[a-zA-Z0-9]+$/", $current_char)) {
            $current_char = '';
        }
        if (ctype_alnum($current_char) == TRUE || $current_char == "_" || $current_char == ".") {
            $filtered_filename .= $current_char;
        }
    }
    return $filtered_filename;
}
?>