<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohammad Zein Eddine mohammad@phptransformer.com .
*
***********************************************/
?>
<?php
$longitude = $_POST['longi'];
$lattitude = $_POST['latti'];
$db = new mysqli("localhost","root","","social");
mysqli_set_charset($db, "utf8");
$success = 1;
$qu = mysqli_query($db,"delete from gballons where BallonX = $longitude and BallonY = $lattitude");
if($qu==1)
    echo 1;
else
    echo 0;