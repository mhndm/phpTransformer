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

include_once("../../../includes.php");
global $conn,$language;

$longitude = $_POST['longi'];
$lattitude = $_POST['latti'];
$languages = $_POST['languages'];
$passed_language = $_POST['language'];
$names = $_POST['names'];

echo $newid = GenerateID("gballons", "BallonId");


if(is_file("Languages/lang-".$passed_language.".php")){
    include_once("Languages/lang-".$passed_language.".php");
}else{
    include_once("Languages/lang-English.php");
}


$lang_rs = mysqli_query($conn,"select * from languages where LangName = '$passed_language'");
if(is_object($lang_rs))
{
    $lang_res = mysqli_fetch_assoc($lang_rs);
    $mylanguage = substr($lang_res['IdLang'],0,11);
}
else
{
    $mylanguage = $language;
}

$success = 1;
$qu = mysqli_query($conn,"insert into gballons(BallonId,BallonX,BallonY,BallonIcon) values(".$newid.",$longitude,$lattitude,'')");
if($qu)
{
    $i=0;
    foreach($languages as $l)
    {
        $qu1 = mysqli_query($conn,"insert into gballonlang(BallonId,IdLang,BallonTitle,BallonDesk) values('$newid','$l','{$names[$i]}','')");
        if(!$qu1)
        {
            $success =0;
            break;
        }
        else
        {
            if($mylanguage == $l)
                $returned = $names[$i].'!!*-*C0dnl0c*-*!!'.$newid;
        }
        $i++;
    }
}
else
{
    $success = 0;
}

if(!isset($returned))
    {
        $success = 0;
    }
else
    {
        $success = $returned;
    }
    
echo $success;
?>
