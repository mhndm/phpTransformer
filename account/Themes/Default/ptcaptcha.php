<?php
session_id($_GET['s']);
session_start();
$first_number = $_SESSION['first_number'];
$second_number = $_SESSION['second_number'];
header("Content-type: image/png");
$im = @imagecreate(80, 20) or die("Err!");
$background_color = imagecolorallocate($im, 103, 162, 151);
$text_color = imagecolorallocate($im, 255, 255, 255);
$line_colour = imagecolorallocate($im, 0, 0, 0);

$text = $first_number . " + " . $second_number;

//imageline($im, 0, 9, 200, 9, $text_color);
//imageline($im, 0, 16, 200, 16, $text_color);
//imageline($im, 0, 0, 100, 20, $text_color);
//imageline($im, 30, 0, 30, 20, $text_color);
imageline($im, 0, 0, 10, 20, $text_color);
imageline($im, 80, 0, 70, 20, $text_color);
imagestring($im, 7,10,0,$text, $text_color);
imagepng($im);
imagedestroy($im);
?>