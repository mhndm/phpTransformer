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
?>
<?php global $IsAdmin; if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $ThemeName,$Lang,$conn,$CustomHead ;

//$db = mysql_select_db($conn,$dbBaseName);
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
$template = file_get_contents("Programs/mygmap3/admin/template/head.php");
$template = str_replace(array('{MiniLang}','{saved}','{Failed}','{Lang}','{QuestionForNewName}','{QuestionForChangingName}','{DeletePointQuestion}','{point_center}'),array(MiniLang,Saved,Failed,$Lang,QuestionForNewName,QuestionForChangingName,DeletePointQuestion,$center[0]),$template);
$all_points = "";
if(isset($found))
    {
        $i=0;
        while($currentballon_res = mysqli_fetch_array($currentballon_rs))
            {
                //Line in case we want to add the ability of editing a marker names by clicking on it
                //$all_points .= 'addmarker("mymap_div",[{latLng:['.$longitude[$i].','.$lattitude[$i].'],data:"'.$home[$i].'",id:"'.$ids[$i].'",tag:"from"}],{draggable:false},{dragend:ihavebeendragged,mouseover:mouseoverme,mouseout:mouseoutme,rightclick:function(marker,event,context){rightclickmarker(marker,event,context,"'.DeletePointQuestion.'")},click:function(marker,event,context){ihavebeencreatedclickme(marker,event,context,"'.QuestionForChangingName.'");}});';
            
                $all_points .= 'addmarker("mymap_div",[{latLng:['.$longitude[$i].','.$lattitude[$i].'],data:"'.$home[$i].'",id:"'.$ids[$i].'",tag:"from"}],{draggable:false},{dragend:ihavebeendragged,mouseover:mouseoverme,mouseout:mouseoutme,rightclick:function(marker,event,context){rightclickmarker(marker,event,context,"'.DeletePointQuestion.'")}});';
                $i++;
                //addmarker("mymap_div",[{address:"86000 Poitiers, France",id:"m3", data:"Poitiers : great city !"}]);
                //addmarker("mymap_div",[{address:"66000 Perpignan, France",id:"m4", data:"Perpignan ! GO USAP !", options:{icon: "http://maps.google.com/mapfiles/marker_green.png"}}]);
            }
    }
$template = str_replace(array('{all_points}'), array($all_points), $template);
$CustomHead .= $template;
?>
    <body>
        <div id="mylayer" style="width:100%;height:100%;position:absolute;display:none;background:gray;opacity:.6;z-index:1;"></div>
        <div id="myinnerlayer" style="width:370px;margin-left:auto;margin-right:auto;position:absolute;top:67%;display:none;z-index:2;background:#F0F0F0;right:34%;padding:0px;height:<?php echo ((count($mylanguages) * 40)+30)."px";?>;font-family:Tahoma;font-size:12px;line-height:16px;border:solid 1px gray;">
            <table style='direction:<?php echo direction;?>;margin-left:auto;margin-right:auto;width:100%;line-height:27px;' cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2" style="text-align:center;font-family:Tahoma;font-size:13px;background:gray;color:white;line-height:25px;" id="myinnerheader_td"></td>
                </tr>
                <?php foreach($mylanguages as $l=>$n){?>
                <tr>
                    <td><label for="" style="margin-<?php echo altfloat;?>:5px"><?php echo PointNameLabelIn.' '.$n;?></label></td>
                    <td><input name="point-<?php echo $l;?>" /></td>
                </tr>
                <?php }?>
                <tr>
                    <td colspan='2'>
                        <input name="save-point" value="<?php echo Save;?>" type="button" style="float: <?php echo float;?>;margin-<?php echo float;?>:5px;" />
                        <img id="loader_img" width="20" height="15" style="display:none;" />
                    </td>
                </tr>
            </table>
            </div>
        <fieldset style="width:794px;height:25px;margin:0px;padding:1px;">
            <form name="save_frm" id="save_frm">
        <input type="button" id="terrain" Value="<?php echo Terrain;?>" />
        <input type="button" id="maps" Value="<?php echo Map;?>" />
        <input type="button" id="satellite" Value="<?php echo Satellite;?>" />
        <input type="button" id="hybrid" Value="<?php echo Hybrid;?>" />
        <input type="hidden" name="longitude" value="<?php echo $longitude[0];?>" />
        <input type="hidden" name="lattitude" value="<?php echo $lattitude[0];?>"/>
            </form>
        </fieldset>
        <div id="mymap_div" class="gmap3"></div>
        <div id="testmap_div" class="gmap3"></div>
        <div id="testmarker_div" class="gmap3"></div>
    </body>
</html>