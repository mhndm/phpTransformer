<?php
$project ='phpTransformer';
include_once("../../../config.php");
require_once("../../../includes/InputFilters.php");
include_once("../../../includes/ezsql/ez_sql.php");
include_once("../../../includes/Functions.php");
include_once("../../../includes/Functions.php");
include_once("../../../includes/session.php");
include_once("../Languages/lang-English.php");
include_once("../functions.php");
// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','jpeg');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
    {
	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
	if(!in_array(strtolower($extension), $allowed))
            {
		echo json_encode(array("status" => "error"));
		exit;
                die();
            }
        
        $year = date('Y',time());
        $month = date('m',time());
        $day = date('d',time());
        
        $uploaded_file_name = $_FILES['upl']['name'];
        $hashed_uploaded_file_name = md5($uploaded_file_name.time());
        $hashed_uploaded_file_name = substr($hashed_uploaded_file_name,0,10);
        $hashed_uploaded_file_name .= ".".$extension;
        
        if(!is_dir("../../../uploads/gallery/Albums/$year") || !file_exists("../../../uploads/gallery/Albums/$year"))
            {
                mkdir("../../../uploads/gallery/Albums/$year",0755);
            }
            
        if(!is_dir("../../../uploads/gallery/Albums/$year/$day-$month-$year") || !file_exists("../../../uploads/gallery/Albums/$year/$day-$month-$year"))
            {
                mkdir("../../../uploads/gallery/Albums/$year/$day-$month-$year",0755);
            }
        if(!is_dir("../../../uploads/gallery/Albums/$year/$day-$month-$year/thumbs") || !file_exists("../../../uploads/gallery/Albums/$year/$day-$month-$year/thumbs"))
            {
                mkdir("../../../uploads/gallery/Albums/$year/$day-$month-$year/thumbs",0755);
            }
        if(!is_dir("../../../uploads/gallery/Albums/$year/$day-$month-$year/medium") || !file_exists("../../../uploads/gallery/Albums/$year/$day-$month-$year/medium"))
            {
                mkdir("../../../uploads/gallery/Albums/$year/$day-$month-$year/medium",0755);
            }
        /*if(!is_dir("../../../uploads/gallery/Albums/$year/$month") || !file_exists("../../../uploads/gallery/Albums/$year/$month"))
            {
                mkdir("../../../uploads/gallery/Albums/$year/$month",0755);
            }
            
        if(!is_dir("../../../uploads/gallery/Albums/$year/$month/$day") || !file_exists("../../../uploads/gallery/Albums/$year/$month/$day"))
            {
                mkdir("../../../uploads/gallery/Albums/$year/$month/$day",0755);
            }
        
        if(!is_dir("../../../uploads/gallery/Albums/$year/$month/$day/thumbs") || !file_exists("../../../uploads/gallery/Albums/$year/$month/$day/thumbs"))
            {
                mkdir("../../../uploads/gallery/Albums/$year/$month/$day/thumbs",0755);
            }*/
            
	if(move_uploaded_file($_FILES['upl']['tmp_name'], "../../../uploads/gallery/Albums/$year/$day-$month-$year/".$hashed_uploaded_file_name))
            {
                $file_hashed_path = "../../../uploads/gallery/Albums/$year/$day-$month-$year/".$hashed_uploaded_file_name;
                if (is_file('../../../Programs/gallery/admin/img/water.png'))
                    {
                        include_once("../../../Programs/gallery/watermark.php");
                        Watermark($file_hashed_path, '../../../Programs/gallery/admin/img/water.png', $file_hashed_path);
                    }
                create_news_thumbs("../../../uploads/gallery/Albums/$year/$day-$month-$year/".$hashed_uploaded_file_name, "../../../uploads/gallery/Albums/$year/$day-$month-$year/".$hashed_uploaded_file_name, 600);
                copy("../../../uploads/gallery/Albums/$year/$day-$month-$year/".$hashed_uploaded_file_name, "../../../uploads/gallery/Albums/$year/$day-$month-$year/medium/".$hashed_uploaded_file_name);
                create_news_thumbs("../../../uploads/gallery/Albums/$year/$day-$month-$year/".$hashed_uploaded_file_name, "../../../uploads/gallery/Albums/$year/$day-$month-$year/thumbs/".$hashed_uploaded_file_name, 150);
                echo json_encode(array("status" => "success","fname" => $hashed_uploaded_file_name));
                exit;
            }
        else
            {
                echo '{"status":"error"}';
            }
    }
else
{
    echo '{"status":"error"}';
}