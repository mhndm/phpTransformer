<?php

//
// To see the PHP example in action, please do the following steps.
//
// 1. Open test/js/uploader-demo-jquery.js file and change the request.endpoint
// parameter to point to this file.
//
//  ...
//  request: {
//    endpoint: "../server/php/example.php"
//  }
//  ...
//
// 2. As a next step, make uploads and chunks folders writable.
//
// 3. Open test/jquery.html to see if everything is working correctly,
// the uploaded files should be going into uploads folder.
//
// 4. If the upload failed for any reason, please open the JavaScript console,
// if this does not help please read the excellent documentation we have for you.
//
// https://github.com/valums/file-uploader/blob/master/readme.md
//
global $imgext;
include_once("../../../../config.php");
include_once("../../../../includes/ezsql/ez_sql.php");
include_once("../../../../includes/InputFilters.php");

if (isset($_GET['path'])) {
    $path = InputFilter($_GET['path']);
} else {
    $path = '';
}

$NickName = strrpos($path, '/');
$NickName = substr($path, $NickName+1);
if($NickName =="Guest"){
    die("Guest");
}
//delete old uploaded pictures
$list = glob( "../../../../".$path."/avatar_*") ;
foreach($list as $f){
    unlink($f);
}

// Include the uploader class
require_once 'qqFileUploader.php';

$uploader = new qqFileUploader();

// Specify the list of valid extensions, ex. array("jpeg", "xml", "bmp")
$uploader->allowedExtensions = array("jpeg", "jpg", "gif", "png","JPEG", "JPG", "GIF", "PNG");

// Specify max file size in bytes.
$uploader->sizeLimit = 10 * 1024 * 1024;

// Specify the input name set in the javascript.
$uploader->inputName = 'qqfile';

// If you want to use resume feature for uploader, specify the folder to save parts.
$uploader->chunksFolder = 'chunks';

// Call handleUpload() with the name of the folder, relative to PHP's getcwd()
//$result = $uploader->handleUpload('../receiver');
// To save the upload with a specified name, set the second parameter.

$result = $uploader->handleUpload('../../../../' . $path, $uploader->getUploadName());
// To return a name used for uploaded file you can use the following line.
$result['uploadName'] = $uploader->getUploadName();



create_scaled_image('../../../../' . $path . '/' . $uploader->getUploadName(), '../../../../' . $path . '/avatar_32.', 32);
create_scaled_image('../../../../' . $path . '/' . $uploader->getUploadName(), '../../../../' . $path . '/avatar_64.', 64);
create_scaled_image('../../../../' . $path . '/' . $uploader->getUploadName(), '../../../../' . $path . '/avatar_128.', 128);
create_scaled_image('../../../../' . $path . '/' . $uploader->getUploadName(), '../../../../' . $path . '/avatar_256.', 256);

if (is_file('../../../../' . $path . '/' . $uploader->getUploadName())) {
    unlink('../../../../' . $path . '/' . $uploader->getUploadName());
}
//echo "update `users` set `UserPic`= 'uploads/users/".$NickName."/avatar_128.".$imgext."' where `NickName`='".$NickName."';";

$db = new db();
$db->query("update `users` set `UserPic`= 'uploads/users/".$NickName."/avatar_128.".$imgext."' where `NickName`='".$NickName."';");

header("Content-Type: text/plain");
echo json_encode($result);

function create_scaled_image($file_name, $new_file_path, $width = 600) {
    global $imgext;
    list($img_width, $img_height) = @getimagesize($file_name);
    if (!$img_width || !$img_height) {
        return false;
    }
    $scale = min(
            $width / $img_width, $width / $img_height
    );
    if ($scale >= 1) {
        return true;
    }
    $new_width = $img_width * $scale;
    $new_height = $img_height * $scale;
    $new_img = @imagecreatetruecolor($new_width, $new_height);
    $imgext = strtolower(substr(strrchr($file_name, '.'), 1));
    switch ($imgext) {
        case 'jpg':
        case 'jpeg':
            $src_img = @imagecreatefromjpeg($file_name);
            $write_image = 'imagejpeg';
            $image_quality = isset($options['jpeg_quality']) ?
                    $options['jpeg_quality'] : 75;
            break;
        case 'gif':
            @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
            $src_img = @imagecreatefromgif($file_name);
            $write_image = 'imagegif';
            $image_quality = null;
            break;
        case 'png':
            @imagecolortransparent($new_img, @imagecolorallocate($new_img, 0, 0, 0));
            @imagealphablending($new_img, false);
            @imagesavealpha($new_img, true);
            $src_img = @imagecreatefrompng($file_name);
            $write_image = 'imagepng';
            $image_quality = isset($options['png_quality']) ?
                    $options['png_quality'] : 9;
            break;
        default:
            $src_img = null;
    }
    $success = $src_img && @imagecopyresampled(
                    $new_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height
            ) && $write_image($new_img, $new_file_path . $imgext, $image_quality);
    // Free up memory (imagedestroy does not delete files):
    @imagedestroy($src_img);
    @imagedestroy($new_img);
    //var_dump($success);
    return $success;
}

?>