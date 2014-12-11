<?php

$project = 'phpTransformer';
//var_dump($_POST);
//sleep(10);
include_once("../../includes.php");

$allowed = "all";
$path_upload = "uploads/";
$path_thumbs = "uploads/thumbs";
$thumbs = false;
$amazone_s3 = false;
$upload_to_youtube = false;
$rename_files = true;
$watermark_path = false;
$upload_to_youtube = false;

extract($_POST);
extract($_SESSION);


$uploaded_type = $allowed;
$types = array("images", "videos", "files", "all");
$exts = $upload_allowed_ext;
if (in_array($allowed, $types)) {

    switch ($allowed) {
        case "images":
            $allowed = $upload_images;
            break;
        case "videos":
            $allowed = $upload_videos;
            break;
        case "files":
            $allowed = $upload_files;
            break;

        default:
            $allowed = $upload_allowed_ext;
            break;
    }
}

$path_upload = "../../" . InputFilter($path_upload);
if (!is_dir($path_upload)) {
    mkdir($path_upload, 0755, true);
}

$path_thumbs = "../../" . InputFilter($path_thumbs);
if (!is_dir($path_thumbs)) {
    mkdir($path_thumbs, 0755, true);
}
//echo $thumbs;

$thumbs = str_replace("&quot;", '"', $thumbs);

$thumbs = json_decode($thumbs,true);

//var_dump($thumbs);
if (count($thumbs)) { //must be array
    foreach ($thumbs as $key => $value) {
        $thumb_path_from_key =  substr($key, 0,   strrpos($key, "/"));
        if (!is_numeric($key) and ! is_dir("../../" . $thumb_path_from_key)) { // this thumb has its own path

            mkdir("../../" .$thumb_path_from_key , 0755, true);
        }
    }
} else {
    $thumbs = false; // no thumbs required
}

if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0) {
    $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
    if (!in_array(strtolower($extension), $allowed)) {
        echo json_encode(array("status" => "error"));
        exit;
        die();
    }

    $year = date('Y', time());
    $month = date('m', time());
    $day = date('d', time());

    $uploaded_file_name = $_FILES['upl']['name'];
    if ($rename_files) {
        $uploaded_file_name = md5($uploaded_file_name . time());
        $uploaded_file_name = substr($uploaded_file_name, 0, 10);
        $uploaded_file_name .= "." . $extension;
    }
    if (move_uploaded_file($_FILES['upl']['tmp_name'], $path_upload . '/' . $uploaded_file_name)) {
        if (is_file("../../" . $watermark_path)) {
            include_once("watermark.php");
            Watermark($path_upload . '/' . $uploaded_file_name, "../../" . $watermark_path, $path_upload . '/' . $uploaded_file_name);
        }
        if ($amazone_s3) {
            move_file_to_cloud_s3($path_upload . '/' . $uploaded_file_name);
        }
        if (is_array($thumbs) and count($thumbs)) {
           
            foreach ($thumbs as $key => $value) {
                if (is_numeric($key)) {
                    pt_create_thumbs($path_upload . '/' . $uploaded_file_name, $path_thumbs . '/' . $uploaded_file_name, $value);
                    if ($amazone_s3) {
                        move_file_to_cloud_s3($path_thumbs . '/' . $uploaded_file_name);
                    }
                } else {
                   
                    $ext = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
                    pt_create_thumbs($path_upload . '/' . $uploaded_file_name, "../../" . $key.'.'.$ext , $value);
                    if ($amazone_s3) {
                        move_file_to_cloud_s3("../../" . $key.'.' .$ext);
                    }
                }
            }
        }

        if ($uploaded_type == "videos" and $upload_to_youtube) {
            $uploaded_file_name = move_video_to_youtube($path_upload . '/' . $uploaded_file_name, $uploaded_file_name);
        }
        echo json_encode(array("status" => "success", "fname" => $uploaded_file_name));
    } else {
        echo '{"status":"error"}';
    }
} else {
    echo '{"status":"error"}';
}