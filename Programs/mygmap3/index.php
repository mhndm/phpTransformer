<?php
/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 7-12-2013.
 * 	Last Modified: 07-02-2014.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohammad Zein Eddine mohammad@phptransformer.com .
 *
 * ********************************************* */
?>
<?php if (!isset($project)) {
    header("location: ../../");
} ?>
<?php
global $ThemeName, $Lang, $conn, $CustomHead;

//$db = mysql_select_db($dbBaseName);
$currentballon_rs = mysqli_query($conn,"select b.BallonId,b.BallonX,b.BallonY,b.BallonIcon,gl.BallonId,gl.BallonTitle,l.IdLang,l.LangName from gballons as b,gballonlang as gl,languages as l where gl.BallonId = b.BallonId and l.IdLang = gl.IdLang and l.LangName = '$Lang' ORDER BY b.BallonId desc");
if (is_resource($currentballon_rs) && mysqli_num_rows($currentballon_rs) >= 1) {
    $i = 0;
    while ($currentballon_res = mysqli_fetch_array($currentballon_rs)) {
        $longitude[$i] = $currentballon_res['BallonX'];
        $lattitude[$i] = $currentballon_res['BallonY'];
        $home[$i] = $currentballon_res['BallonTitle'];
        $center[$i] = "[{$longitude[$i]},{$lattitude[$i]}]";
        $ids[$i] = $currentballon_res['BallonId'];
        $found = 1;
        $i++;
    }
    $i = 0;
    mysqli_data_seek($currentballon_rs, 0);
} else {
    $home[0] = DefaultName;
    $longitude[0] = "33.823652757842055";
    $lattitude[0] = "35.892333984375";
    $center[0] = "[$longitude[0], $lattitude[0]]";
}

$languages_rs = mysqli_query($conn,"select * from languages");
if (!is_resource($languages_rs)) {
    $mylanguages = array("English");
} else {
    while ($languages_res = mysqli_fetch_array($languages_rs)) {
        $mylanguages[$languages_res['IdLang']] = $languages_res['LangName'];
    }
}
$CustomHead .= '
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language='.MiniLang.'&Ssf"></script>
        <script type="text/javascript" src="Programs/mygmap3/gmap3/gmap3.min.js"></script>
        <script type="text/javascript" src="Programs/mygmap3/js/myfunctions.js?v=1"></script>';
?>
<script type="text/javascript">
    $(document).ready(
    function()
    {

        generateme("mymap_div",1,"800px","600px","",1,{click:rightclickme},1,{zoom:10,center:<?php echo $center[0]; ?>,scrollwheel:false, mapTypeControl: false,streetViewControl: true},{click:specifysource});
                            
        $("#terrain").click(function()
        {
            $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.TERRAIN}}});
        });
        $("#maps").click(function()
        {
            $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.ROADMAP}}});
        });
        $("#satellite").click(function()
        {
            $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.SATELLITE}}});
        });
        $("#hybrid").click(function()
        {
            $("#mymap_div").gmap3({map:{options:{mapTypeId:google.maps.MapTypeId.HYBRID}}});
        });
                                    
<?php
if (isset($found)) {
    $i = 0;
    while ($currentballon_res = mysqli_fetch_array($currentballon_rs)) {
        echo 'addmarker("mymap_div",[{latLng:[' . $longitude[$i] . ',' . $lattitude[$i] . '],data:"' . $home[$i] . '",id:"' . $ids[$i] . '",tag:"from"}],{draggable:false},{mouseover:mouseoverme,mouseout:mouseoutme,click:specifysource});';
        $i++;
    }
}
?>
                                
                                }
                            );
</script>
<?php $CustomHead .= '<style type="text/css">
            .googlemap
            {
                width: 100%;
                height: 450px;
                border: 1px dashed #D1D1D1;
                margin: 10px 0px;
            }
            .marker
            {
                vertical-align: middle;
            }
            .gmap3{
                margin-top:10px;
                }
        </style>'; ?>
<fieldset style="width:794px;height:25px;margin:0px;padding:1px;">
    <form name="save_frm" id="save_frm">
        <input type="hidden" name="longitude"/>
        <input type="hidden" name="lattitude"/>
        <input type="button" id="terrain" Value="<?php echo Terrain; ?>" />
        <input type="button" id="maps" Value="<?php echo Map; ?>" />
        <input type="button" id="satellite" Value="<?php echo Satellite; ?>" />
        <input type="button" id="hybrid" Value="<?php echo Hybrid; ?>" />
    </form>
</fieldset>
<div id="mymap_div" class="gmap3"></div>
<?php echo map_notices;?>
<div id="testmap_div" class="gmap3"></div>
<div id="testmarker_div" class="gmap3"></div>