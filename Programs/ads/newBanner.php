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
<?php
global $ThemeName, $CustomHead, $IdComp, $TitlePage;
$TitlePage .= ' .:. ' . (NewBanner);

$CustomHead .= '<script src="Themes/' . $ThemeName . '/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
                <script src="Programs/ads/ajax.js" type="text/javascript"></script>
		<link href="Themes/' . $ThemeName . '/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';


//show forms to create banners
echo (CreateNewbanner);
echo '<form id="form1" name="form1" method="post" action="#">
		' . (BannerType) . ' :
 		  <select class="select" name="selectbantype" id="selectbantype" onchange="banfunction()">
		      <option name="text" value="BannerText">' . (BannerText) . '</option>
		      <option name="image" value="BannerImage">' . (BannerImage) . '</option>
		      <option name="flash" value="BannerFlash">' . (BannerFlash) . '</option>
		   </select>
		</form><br/>';
NewTextBan();
NewImgBan();
NewFlashBan();

function NewTextBan() {

    global $ThemeName, $IdComp;

    $IdComp = $IdComp . " ";
    $NewBan = get_include_contents("Programs/ads/Themes/" . $ThemeName . "/TextBan.php");
    $NewBan = VarTheme("{campid}", $IdComp, $NewBan);
    $NewBan = VarTheme("Avalueisrequired", (Avalueisrequired), $NewBan);
    $NewBan = VarTheme("{BannerExample}", (BannerExample), $NewBan);
    $NewBan = VarTheme("{bantexttitle}", (bantexttitle), $NewBan);
    $NewBan = VarTheme("{bantextdesc1}", (bantextdesc1), $NewBan);
    $NewBan = VarTheme("{bantextdesc2}", (bantextdesc2), $NewBan);
    $NewBan = VarTheme("{banshowaddress}", (banshowaddress), $NewBan);
    $NewBan = VarTheme("{bantargeturl}", (bantargeturl), $NewBan);
    $NewBan = VarTheme("{subminewtban}", (subminewtban), $NewBan);
    $NewBan = VarTheme("{submitnewbanandaddnew}", (submitnewbanandaddnew), $NewBan);
    $NewBan = VarTheme("{BannerPositions}", (BannerPositions), $NewBan);
    $NewBan = VarTheme("{SelectBannerPositions}", BannerPositions(), $NewBan);
    $NewBan = VarTheme("Invalidformat", (Invalidformat), $NewBan);
    $NewBan = VarTheme("{BanTextViewandClickPrices}", (BanTextViewandClickPrices), $NewBan);

    $Vars = array("Prog", "newban", "CampDetails");
    $Vals = array("ads", "yes", InputFilter($_GET['CampDetails']));
    $bansavetaget = CreateLink("", $Vars, $Vals);
    $NewBan = VarTheme("{bansavetaget}", $bansavetaget, $NewBan);
    echo $NewBan;
}

//end function

function NewImgBan() {
    global $ThemeName, $IdComp;
    $NewBan = get_include_contents("Programs/ads/Themes/" . $ThemeName . "/ImgBan.php");
    $NewBan = VarTheme("{campid}", $IdComp, $NewBan);
    $NewBan = VarTheme("{altText}", (altText), $NewBan);
    $NewBan = VarTheme("{ImgName}", (ImgName), $NewBan);
    $NewBan = VarTheme("{ImgSrc}", (ImgSrc), $NewBan);
    $NewBan = VarTheme("{ClickUrl}", (ClickUrl), $NewBan);

    $NewBan = VarTheme("Invalidformat", (Invalidformat), $NewBan);
    $NewBan = VarTheme("Avalueisrequired", (Avalueisrequired), $NewBan);
    $NewBan = VarTheme("{BannerPositions}", (BannerPositions), $NewBan);
    $NewBan = VarTheme("{subminewtban}", (subminewtban), $NewBan);
    $NewBan = VarTheme("{submitnewbanandaddnew}", (submitnewbanandaddnew), $NewBan);
    $NewBan = VarTheme("{SelectBannerPositions}", BannerPositions(), $NewBan);
    $NewBan = VarTheme("{ImgTextViewandClickPrices}", (ImgTextViewandClickPrices), $NewBan);
    $Vars = array("Prog", "newban", "CampDetails");
    $Vals = array("ads", "yes", InputFilter($_GET['CampDetails']));
    $bansavetaget = CreateLink("", $Vars, $Vals);
    $NewBan = VarTheme("{bansavetaget}", $bansavetaget, $NewBan);
    echo $NewBan;
}

function NewFlashBan() {
    global $ThemeName, $IdComp;
    $NewBan = get_include_contents("Programs/ads/Themes/" . $ThemeName . "/FlashBan.php");
    $NewBan = VarTheme("{campid}", $IdComp, $NewBan);
    $NewBan = VarTheme("{BannerName}", (BannerName), $NewBan);
    $NewBan = VarTheme("{FlashSource}", (FlashSource), $NewBan);
    $NewBan = VarTheme("{BannerTarget}", (BannerTarget), $NewBan);
    $NewBan = VarTheme("Invalidformat", (Invalidformat), $NewBan);
    $NewBan = VarTheme("Avalueisrequired", (Avalueisrequired), $NewBan);
    $NewBan = VarTheme("{BannerPositions}", (BannerPositions), $NewBan);
    $NewBan = VarTheme("{subminewtban}", (subminewtban), $NewBan);
    $NewBan = VarTheme("{submitnewbanandaddnew}", (submitnewbanandaddnew), $NewBan);
    $NewBan = VarTheme("{SelectBannerPositions}", BannerPositions(), $NewBan);
    $NewBan = VarTheme("{FlashTextViewandClickPrices}", (FlashTextViewandClickPrices), $NewBan);
    $Vars = array("Prog", "newban", "CampDetails");
    $Vals = array("ads", "yes", InputFilter($_GET['CampDetails']));
    $bansavetaget = CreateLink("", $Vars, $Vals);
    $NewBan = VarTheme("{bansavetaget}", $bansavetaget, $NewBan);
    echo $NewBan;
}
?>

<script language="javascript" type="text/javascript">

    document.getElementById('imgbannerdiv').style.visibility = 'hidden'; 
    document.getElementById('flashbannerdiv').style.visibility = 'hidden'; 
    function banfunction(){
        if(document.getElementById('selectbantype').value == "BannerText"){
            document.getElementById('textbannerdiv').style.visibility = 'visible'; 
            document.getElementById('imgbannerdiv').style.visibility = 'hidden'; 
            document.getElementById('flashbannerdiv').style.visibility = 'hidden'; 
        }
        if(document.getElementById('selectbantype').value == "BannerImage"){
            document.getElementById('textbannerdiv').style.visibility = 'hidden'; 
            document.getElementById('imgbannerdiv').style.visibility = 'visible'; 
            document.getElementById('flashbannerdiv').style.visibility = 'hidden'; 
        }
        if(document.getElementById('selectbantype').value == "BannerFlash"){
            document.getElementById('textbannerdiv').style.visibility = 'hidden'; 
            document.getElementById('imgbannerdiv').style.visibility = 'hidden'; 
            document.getElementById('flashbannerdiv').style.visibility = 'visible'; 
        }
		
    }
	
</script>