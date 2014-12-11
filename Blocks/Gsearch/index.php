<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  .
 * 	File Name:  .
 * 	Date Created: 00-00-2007.
 * 	Last Modified: 00-00-2007.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php if (!isset($project)) {
    header("location: ../../");
} ?>
<?php

global $WebSiteName, $WebsiteUrl, $ThemeName, $conn, $GTotalRecords, $GRows;

GExcuteQuery("select * from `gsearch`;");
if ($GTotalRecords > 0) {
    $URL = $GRows['URL'];
    $Border = $GRows['Border'];
    $VisitedURL = $GRows['VisitedURL'];
    $Background = $GRows['Background'];
    $LogoBackground = $GRows['LogoBackground'];
    $Title = $GRows['Title'];
    $Text = $GRows['Text'];
    $LightURL = $GRows['LightURL'];
    $clientKey = $GRows['clientKey'];
    $target = $GRows['target'];
} else {
    $URL = "#008000";
    $Border = "#336699";
    $VisitedURL = "663399";
    $Background = "FFFFFF";
    $LogoBackground = "336699";
    $Title = "CC0000";
    $Text = "000000";
    $LightURL = "0000FF";
    $clientKey = "partner-pub-2331651059501755:7855178428";
    $target = "google_window";
}//end if
//URL
$GALT = $URL;
$GL = "1";
//Border
$DIV = "#336699";
//VisitedURL
$VLC = $Border;
$AH = "center";
//Background
$BGC = $Background;
//LogoBackground
$LBGC = $LogoBackground;
//Title
$ALC = $Title;
$LC = $Title;
//Text
$T = $Text;
//LightURL
$GFNT = $LightURL;
$GIMP = $LightURL;

$LH = "";
$LW = "";
//LogoimageURL 
$L = $WebsiteUrl . "Themes/" . $ThemeName . "/Images/glogo.jpg";
//Logo destination URL
$S = $WebsiteUrl;
//clientKey
$client = "partner-pub-2331651059501755:7855178428";
// target
$google_window = "google_window";

echo '<form id="cse-search-box" method="get" action="http://www.google.com/custom" target="google_window">
	' . Search . ' : <br/>
	<input type="hidden" name="domains" value="' . $WebSiteName . '"></input>
	<input placeholder="" class="text" type="text" name="q" size="12" maxlength="255" value="" id="sbi"></input>
	<input type="hidden" name="sitesearch" value="' . $WebSiteName . '" id="ss0"></input>
	<input type="hidden" name="sitesearch" value="' . $WebSiteName . '" id="ss1"></input>
	<label for="sbb" style="display: none">' . SearchForm . '</label><br/>
	<input class="submit" type="submit" name="sa" value="' . TheSearch . '" dir="' . DirHtml . '" id="sbb"></input>
	<input type="hidden" name="client" value="' . $client . '"></input>
	<input type="hidden" name="forid" value="1"></input>
	<input type="hidden" name="ie" value="UTF-8"></input>
	<input type="hidden" name="oe" value="UTF-8"></input>
	<input type="hidden" name="cof" value="GALT:' . $GALT . ';GL:' . $GL . ';DIV:' . $DIV . ';VLC:' . $VLC . ';AH:' . $AH . ';BGC:' . $BGC . ';LBGC:' . $LBGC . ';ALC:' . $ALC . ';LC:' . $LC . ';T:' . $T . ';GFNT:' . $GFNT . ';GIMP:' . $GIMP . ';LH:' . $LH . ';LW:' . $LW . ';L:' . $L . ';S:' . $S . ';FORID:1"></input>
	<input type="hidden" name="hl" value="' . MiniLang . '"></input>		
     <input type="hidden" name="cx" value="'.$clientKey.'" />
</form>
<script type="text/javascript" src="http://www.google.com.lb/coop/cse/brand?form=cse-search-box&amp;lang=ar"></script>


<script type="text/javascript" src="http://www.google.com/cse/query_renderer.js"></script>
<div id="queries"></div>
<script src="http://www.google.com/cse/api/partner-pub-2331651059501755/cse/7855178428/queries/js?oe=UTF-8&amp;callback=(new+PopularQueryRenderer(document.getElementById(%22queries%22))).render"></script>
';

function GExcuteQuery($query) {
    global $GRecordset, $SqlType, $conn, $GTotalRecords, $GRows;

    $GRecordset = mysqli_query($conn, $query);
    $GTotalRecords = mysqli_num_rows($GRecordset);
    if ($GTotalRecords > 0) {
        $GRows = mysqli_fetch_assoc($GRecordset);
    }//end if
}

//end function
?>
