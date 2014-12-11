<?php
$project = "PhpTransformer";
include_once("../config.php");
include_once("../includes/session.php");

header("Content-type: image/png");
$im = @imagecreate(60, 20)
   or die("Err!");
$background_color = imagecolorallocate($im, 130, 173, 182);
$text_color = imagecolorallocate($im, 74, 162, 180);

@session_start();
$captcha=md5(rand(1,999999999999));
$captcha= str_replace("0", "q", $captcha);
$captcha= str_replace("O", "c", $captcha);
$captcha=substr($captcha,1,5);

imagefontheight(100);
$line_colour = imagecolorallocate($im, 3, 145, 175);
imageline( $im, 5, 5, 20, 20, $line_colour );
imageline( $im, 0, 60,60, 0,  $line_colour );
imagestring($im, 5, 1, 0, ' '. $captcha.' ', $text_color);
imagepng($im);
imagedestroy($im);
$_SESSION['captcha'] = $captcha;
?>
