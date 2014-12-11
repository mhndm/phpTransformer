<?php
$project = "PhpTransformer";
include_once("../config.php");
include_once("../includes/session.php");

header("Content-type: image/png");
$im = @imagecreate(60, 20)
   or die("Err!");
$background_color = imagecolorallocate($im, 130, 173, 182);
$text_color = imagecolorallocate($im, 74, 162, 180);

//echo $Code."<br/>";

@session_start();
unset($_SESSION['Code']);
$Code	= md5(rand(1,999999999999));
$Code= str_replace("0", "q", $Code);
$Code= str_replace("O", "c", $Code);
$Code	= substr($Code,1,5);
imagefontheight(100);
imagestring($im, 5, 1, 2,  ' '.$Code.' ', $text_color);
$line_colour = imagecolorallocate($im, 3, 145, 175);
imageline( $im, 5, 5, 20, 20, $line_colour );
imageline( $im, 0, 60,60, 0,  $line_colour );
imagepng($im);
imagedestroy($im);
$_SESSION['Code'] = $Code;
 
?>
