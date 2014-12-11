<?php

error_reporting(0);

if(isset($_POST['data'])){
	$data = $_POST['data'];
}//end if

$pieces = explode("|", $data);
$BanURL ='&lt;a href="'.$pieces[4].'" title="'.$pieces[0].'" target="_blanck"&gt;'.$pieces[3].' &lt;/a&gt;' ; 

header ("content-type: text/xml");
echo "<?xml version='1.0' standalone='yes'?>";
	echo '<data>';
		echo '<bantexttitle>';
			echo '<code>'.$pieces[0].'</code>';
		echo '</bantexttitle>';
		echo '<bantextdesc1>';
			echo '<code>'.$pieces[1].'</code>';
		echo '</bantextdesc1>';
		echo '<bantextdesc2>';
			echo '<code>'.$pieces[2].'</code>';
		echo '</bantextdesc2>';	
		echo '<banshowaddress>';
			echo '<code>'.$BanURL.'</code>';
		echo '</banshowaddress>';		
	echo '</data>';
	
?>

