<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 07-12-2013.
*	Last Modified: 07-02-2014.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohammad Zein Eddine mohammad@phptransformer.com .
*
***********************************************/
$project ='phpTransformer';

global $dbHostName,$dbBaseName,$dbUserPass,$db,$language;

include_once("../../../config.php");
require_once("../../../includes/InputFilters.php");
include_once("../../../includes/ezsql/ez_sql.php");
include_once("../../../includes/Functions.php");
include_once("../../../includes/Functions.php");
include_once("../../../includes/session.php");

$longitude = $_POST['longi'];
$lattitude = $_POST['latti'];
$db = new mysqli($dbHostName,$dbUserPass[0][0],$dbUserPass[0][1],$dbBaseName);
mysqli_set_charset($db, "utf8");

$success = 1;
$ballon_id_rs = mysqli_query($db,"select BallonId from gballons where BallonX = $longitude and BallonY = $lattitude order by BallonId desc limit 0,1");
$ballon_id_res = mysqli_fetch_array($ballon_id_rs);
$ballon_id = $ballon_id_res['BallonId'];

$qu = mysqli_query($db,"delete from gballons where BallonX = $longitude and BallonY = $lattitude");
$qu1 = mysqli_query($db,"delete from gballonlang where BallonId = '$ballon_id'");
if(($qu && $qu1)==1)
    echo 1;
else
    echo 0;