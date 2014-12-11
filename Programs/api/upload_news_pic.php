<?php

$project = 'phpTransformer';
global $upload_images;
//var_dump($_POST);
//sleep(10);
include_once("../../includes.php");

$allowed = "images";
$year = date('Y', time());
$month = date('m', time());
$day = date('d', time());
$date_dir_path = $year ."/" . $day . "-" .$month . "-" . $year;
$path_upload = "../../uploads/gallery/Albums/" . $date_dir_path . "/";
$path_thumbs = "../../" . "uploads/gallery/Albums/" . $date_dir_path . "/thumbs/";
$watermark_path = "Programs/gallery/admin/img/water.png";
$thumbs = '{"uploads\/gallery\/Albums\/'. $date_dir_path .'\/":600,"uploads\/gallery\/Albums\/'.$date_dir_path.'\/medium\/":600,"uploads\/gallery\/Albums\/'.$date_dir_path.'\/thumbs\/":150}';
$thumbs = json_decode($thumbs,true);
$amazone_s3 = false;
$upload_to_youtube = false;
$rename_files = true;
$uploaded_type = $allowed;
$allowed = $upload_images = array("gif", "jpg", "jpeg", "png");

if (!is_dir($path_upload))
    {
        mkdir($path_upload, 0755, true);
    }

if (!is_dir($path_thumbs))
    {
        mkdir($path_thumbs, 0755, true);
    }

foreach ($thumbs as $key => $value)
    {
        if (!is_numeric($key) and ! is_dir("../../" . $key))
            { // this thumb has its own path
                mkdir("../../" . $key, 0755, true);
            }
    }

if (isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
    {
        $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($extension), $allowed))
            {
                die(json_encode(array("s" => '0',"r" => '2')));
            }

        $uploaded_file_name = $_FILES['upl']['name'];
        if ($rename_files)
            {
                $uploaded_file_name = md5($uploaded_file_name . time());
                $uploaded_file_name = substr($uploaded_file_name, 0, 10);
                $uploaded_file_name .= "." . $extension;
            }
        if (move_uploaded_file($_FILES['upl']['tmp_name'], $path_upload . '/' . $uploaded_file_name))
            {
                if (is_file("../../" . $watermark_path))
                    {
                        include_once("watermark.php");
                        Watermark($path_upload . '/' . $uploaded_file_name, "../../" . $watermark_path, $path_upload . '/' . $uploaded_file_name);
                    }
                if ($amazone_s3)
                    {
                        move_file_to_cloud_s3($path_upload . '/' . $uploaded_file_name);
                    }

                if (is_array($thumbs) and count($thumbs))
                    {
                        foreach ($thumbs as $key => $value)
                            {
                                if (is_numeric($key))
                                    {
                                        pt_create_thumbs($path_upload . $uploaded_file_name, $path_thumbs . $uploaded_file_name, $value);
                                        if ($amazone_s3)
                                            {
                                                move_file_to_cloud_s3($path_thumbs . '/' . $uploaded_file_name);
                                            }
                                    }
                                else
                                    {
                                        pt_create_thumbs($path_upload . $uploaded_file_name, "../../" . $key . $uploaded_file_name, $value);
                                        if ($amazone_s3)
                                            {
                                                move_file_to_cloud_s3("../../" . $key . '/' . $uploaded_file_name);
                                            }
                                    }
                            }
                    }
                die(json_encode(array("s" => '1', "r" => $uploaded_file_name)));
            }
        else
            {
                die(json_encode(array("s" => '0',"r" => '3')));
            }
    }
else
    {
        die(json_encode(array("s" => '0',"r" => '1')));
    }