<?php
set_time_limit(0);
$project = 'phpTransformer';
global $upload_videos;
//var_dump($_POST);
//sleep(10);
include_once("../../includes.php");

$allowed = "videos";
$year = date('Y', time());
$month = date('m', time());
$day = date('d', time());
$date_dir_path = $year ."/" . $day . "-" .$month . "-" . $year;
$path_upload = "../../uploads/gallery/Albums/" . $date_dir_path . "/";
$path_thumbs = "../../uploads/gallery/Albums/" . $date_dir_path . "/thumbs/";
$watermark_path = false;
$thumbs = '[]';
$thumbs = json_decode($thumbs,true);
$amazone_s3 = false;
$upload_to_youtube = true;
$rename_files = true;
$uploaded_type = $allowed;
$allowed = array("3gp","webm", "3gpp", "mpegps", "mpeg4", "mov", "wmv", "flv", "swf", "rm", "avi", "mp4", "mpeg", "mpg", "youtube", "wma");

if (!is_dir($path_upload))
    {
        mkdir($path_upload, 0755, true);
    }

if (!is_dir($path_thumbs))
    {
        mkdir($path_thumbs, 0755, true);
    }

if(count($thumbs))
    {
        foreach ($thumbs as $key => $value)
            {
                if (!is_numeric($key) and ! is_dir("../../" . $key))
                    { // this thumb has its own path
                        mkdir("../../" . $key, 0755, true);
                    }
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
                if ($upload_to_youtube)
                    {
                        $uploaded_file_name = local_move_video_to_youtube($path_upload . '/' . $uploaded_file_name, $uploaded_file_name,$uploaded_file_name,$uploaded_file_name,"private");
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
    
function local_move_video_to_youtube($file_path, $uploaded_file_name, $title = " ", $description = " ", $privacy = "public")
    {
        global $youtube_api_key, $youtube_username, $youtube_password;

        include('../../includes/uploader/ClassYouTubeAPI.php');

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
?>