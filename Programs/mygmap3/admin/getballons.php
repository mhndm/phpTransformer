<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php global $IsAdmin; if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $ThemeName,$Lang,$conn,$db ;

$db = mysqli_select_db($conn,"social");
$currentballon_rs = mysqli_query($conn,"select b.BallonId,b.BallonX,b.BallonY,B.BallonIcon,gl.BallonId,gl.BallonTitle,l.IdLang,l.LangName from gballons as b,gballonlang as gl,languages as l where gl.BallonId = b.BallonId and l.IdLang = gl.IdLang and l.LangName = '$Lang' ORDER BY b.BallonId desc");
if(is_resource($currentballon_rs) && mysqli_num_rows($currentballon_rs) >= 1)
{
    $i = 0;
    while($currentballon_res = mysqli_fetch_array($currentballon_rs))
    {
    $longitude[$i] = $currentballon_res['BallonX'];
    $lattitude[$i] = $currentballon_res['BallonY'];
    $home[$i] = $currentballon_res['BallonTitle'];
    $center[$i] = "[{$longitude[$i]},{$lattitude[$i]}]";
    $ids[$i] = $currentballon_res['BallonId'];
    $found = 1;
    $i++;
    }
    $i=0;
    mysqli_data_seek($currentballon_rs, 0);
}
else
{
    $home[0] = DefaultName;
    $longitude[0] = "33.823652757842055";
    $lattitude[0] = "35.892333984375";
    $center[0] = "[$longitude[0], $lattitude[0]]";
}

$languages_rs = mysqli_query($conn,"select * from languages");
if(!is_resource($languages_rs))
{
    $mylanguages = array("English");
}
else
{
    while($languages_res = mysqli_fetch_array($languages_rs))
    {
        $mylanguages[$languages_res['IdLang']] = $languages_res['LangName'];
    }
}
?>
<?php if(isset($found))
   {
     $i=0;
     while($currentballon_res = mysqli_fetch_array($currentballon_rs))
           {
                  echo 'addmarker("mymap_div",[{latLng:['.$longitude[$i].','.$lattitude[$i].'],data:"'.$home[$i].'",id:"'.$ids[$i].'",tag:"from"}],{draggable:false},{dragend:ihavebeendragged,mouseover:mouseoverme,mouseout:mouseoutme,click:function(marker,event,context){ihavebeencreatedclickme(marker,event,context,"'.QuestionForChangingName.'");}});';
                  $i++;
                 //addmarker("mymap_div",[{address:"86000 Poitiers, France",id:"m3", data:"Poitiers : great city !"}]);
                //addmarker("mymap_div",[{address:"66000 Perpignan, France",id:"m4", data:"Perpignan ! GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}]);
           }
      }
?>
