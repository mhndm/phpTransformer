<?php
 
 
 echo  pt_uploader(
$input_hidden_target = "upfiles", $multi_files = 1, $allowed = "images", $div_id = 1, $path_upload = "uploads/", $path_thumbs = "uploads/thumbs", $thumbs = array(), // path and width size for thumb ex :  array('uploads/thumbs/medium'=>900,600,256,100) Full Path
        $amazone_s3 = false, $upload_to_youtube = false, $rename_files = true, $watermark_path = false
, $drop_here = drop_here, $choose_pic = choose_pic);
 
?>