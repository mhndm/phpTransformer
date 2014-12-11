<?php

$project = 'phpTransformer';
global $upload_images,$db;
include_once("../../includes.php");
if(empty($db))
    {
        $db = new db();
    }
//var_dump($_POST);
//sleep(10);

$allowed = "images";
$year = date('Y', time());
$month = date('m', time());
$day = date('d', time());
$token = isset($_GET['t'])?InputFilter($_GET['t']) : "";
$uid = isset($_GET['u'])?InputFilter($_GET['u']) : "";
if($token !== "")
    {
        $user_name_var = $db->get_var("select NickName from users where app_token = '$token'");
        if(!$user_name_var)
            {
                die(json_encode(array("s" => '0',"r" => '4')));
            }
        else
            {
                $user_name = $user_name_var;
            }
    }
else if($uid !== "")
    {
        $user_name = $uid;
    }
else
    {
        die(json_encode(array("s" => '0',"r" => '4')));
    }
//$date_dir_path = $year ."/" . $day . "-" .$month . "-" . $year;
$path_upload = "../../uploads/users/$user_name/";
$path_thumbs = "../../uploads/users/$user_name/";
//$thumbs = '{"uploads\/users\/'.$user_name .'\/":32,"uploads\/users\/'.$user_name.'\/":64,"uploads\/users\/'.$user_name.'\/":128,"uploads\/users\/'.$user_name.'\/":256}';
$thumbs = '[32,64,128,256]';
$thumbs = json_decode($thumbs,true);
$amazone_s3 = false;
$upload_to_youtube = false;
$rename_files = false;
$uploaded_type = $allowed;
$allowed = $upload_images = array("gif", "jpg", "jpeg", "png");

if (!is_dir($path_upload))
    {
        mkdir($path_upload, 0755, true);
    }
else
    {
        $files_to_delete = glob($path_upload.'avatar*');
        if($files_to_delete && is_array($files_to_delete) && $files_to_delete !== -1 && count($files_to_delete) > 0)
            {
                array_walk($files_to_delete, function ($file_to_delete)
                                            {
                                                unlink($file_to_delete);
                                            });
            }
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

        $initial_uploaded_file_name = "avatar.".$extension;
        if ($rename_files)
            {
                $uploaded_file_name = md5($uploaded_file_name . time());
                $uploaded_file_name = substr($uploaded_file_name, 0, 10);
                $uploaded_file_name .= "." . $extension;
            }
        if (move_uploaded_file($_FILES['upl']['tmp_name'], $path_upload . '/' . $initial_uploaded_file_name))
            {
                if($token !== "")
                    {
                        $db->query("update users set UserPic = 'uploads/users/$user_name/avatar_128.$extension' where NickName = '$user_name'");
                    }
                if ($amazone_s3)
                    {
                        move_file_to_cloud_s3($path_upload . '/' . $initial_uploaded_file_name);
                    }

                if (is_array($thumbs) and count($thumbs))
                    {
                        foreach ($thumbs as $key => $value)
                            {
                                if (is_numeric($key))
                                    {
                                        $uploaded_file_name = "avatar_".$value.".".$extension;
                                        pt_create_thumbs($path_upload . $initial_uploaded_file_name, $path_thumbs . $uploaded_file_name, $value);
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
                @unlink($path_upload.$initial_uploaded_file_name);
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