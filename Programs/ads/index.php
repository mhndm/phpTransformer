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

global $Lang,$IdComp, $NickName, $TheNavBar, $CustomHead, $UserId, $TotalRecords, $conn, $Rows, $TitlePage, $InputNickName;

$CustomHead .= '<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
		<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
		<script type="text/javascript" src="includes/jscalendar/Languages/calendar-'.$Lang.'.js"></script>
		<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>';

$TitlePage .= ' .:. ' . (adspage);
$TheNavBar[] = array((usercp), CreateLink("", array("Prog"), array("usercp")));
$TheNavBar[] = array((adspage), CreateLink("", array("Prog"), array("ads")));

//cheking if there any price list
$PriceListExist = false;
$dbPriceListExist = new db();
$PriceListExist = $dbPriceListExist->get_row("SELECT * FROM `bannerplans`;");

//if(!isset($IdComp)){
if (isset($_POST['IdComp'])) {
    $IdComp = trim(PostFilter($_POST['IdComp']));
} elseif (isset($_GET['CampDetails'])) {
    $IdComp = trim(InputFilter($_GET['CampDetails']));
}
//}//end if
//echo $NickName;
//if($InputNickName !=  ("Guest") and $InputNickName != null ){
if ($NickName != ("Guest") and $NickName != null and $PriceListExist) {
    if (isset($_GET['PriceList'])) {
        echo PriceList();
    }//end if
    //save new banner
    if (isset($_GET['newban'])) {
        //save banner TEXT
        if (isset($_POST['subminewtban'])) {
            //echo $_POST['subminewtban'];
            $TheNavBar[] = array(CampaingBanners, CreateLink("", array("Prog", "CampDetails"), array("ads", $IdComp)));
            SaveBanText();
        } elseif (isset($_POST['submitnewbanandaddnew'])) {
            //save banner and add new one
            $TheNavBar[] = array(CampaingBanners, CreateLink("", array("Prog", "CampDetails"), array("ads", $IdComp)));
            SaveBanText();

            include_once("Programs/ads/newBanner.php");
        }//end if
        //save banner IMG
        if (isset($_POST['subminewtbanimg'])) {
            //echo $_POST['subminewtban'];
            $TheNavBar[] = array(CampaingBanners, CreateLink("", array("Prog", "CampDetails"), array("ads", $IdComp)));
            SaveBanIMG();
        } elseif (isset($_POST['submitnewbanandaddnewimg'])) {
            //save banner and add new one
            $TheNavBar[] = array(CampaingBanners, CreateLink("", array("Prog", "CampDetails"), array("ads", $IdComp)));
            SaveBanIMG();
            include_once("Programs/ads/newBanner.php");
        }//end if
        //save flash banner
        if (isset($_POST['subminewtbanflash'])) {
            //echo $_POST['FlashSource'];
            $TheNavBar[] = array(CampaingBanners, CreateLink("", array("Prog", "CampDetails"), array("ads", $IdComp)));
            SaveBanFlash();
        } elseif (isset($_POST['submitnewbanandaddnewflash'])) {
            //save banner and add new one
            //echo $_POST['submitnewbanandaddnewflash'];
            $TheNavBar[] = array(CampaingBanners, CreateLink("", array("Prog", "CampDetails"), array("ads", $IdComp)));
            SaveBanFlash();
            include_once("Programs/ads/newBanner.php");
        }//end if
    }//end if
    //showing account details for client
    if (isset($_GET['accdet'])) {
        $TheNavBar[] = array((AccountDetails), CreateLink("", array("Prog", "accdet"), array("ads", "yes")));
        if ($_GET['accdet'] == "yes") {
            include_once("Programs/ads/AccountDetails.php");
        }//end if
    }//end if
    //new banner for campaingn
    if (isset($_POST['newcampbanner'])) {
        include_once("Programs/ads/newBanner.php");
    }//end if
    //update ban info
    if (isset($_GET['updateban'])) {
        $UpIdBanner = InputFilter($_GET['updateban']);
        if (isset($_POST['Updatesubminewtban'])) {
            // Text ban
            UpBanText($UpIdBanner);
        } elseif (isset($_POST['updatesubminewtbanimg'])) {
            //img ban
            UpBanImg($UpIdBanner);
        } elseif (isset($_POST['updatesubminewtbanflash'])) {
            // flash ban 
            UpBanFlash($UpIdBanner);
        }//end if
    }//end if
    //show details for an Campaign
    if (isset($_GET['CampDetails']) and !isset($_GET['newban'])) {
        $TheNavBar[] = array((CampaingBanners), CreateLink("", array("Prog", "CampDetails"), array("ads", InputFilter($_GET['CampDetails']))));
        include_once("Programs/ads/BannersForCamp.php");
    }//end if
    //edit banner
    if (isset($_GET['editban'])) {
        include_once("Programs/ads/editBanner.php");
    }//end if
    //create new campaing
    if (isset($_GET['CreateCamp'])) {

        $TheNavBar[] = array((newCampaign), CreateLink("", array("Prog", "CreateCamp"), array("ads", "yes")));

        if (InputFilter($_GET['CreateCamp']) == "yes") {
            include_once("Programs/ads/create_campains.php");
        }//end if
    }//end if
    //Create new client, with 
    if (isset($_POST['adsPayment'])) {
        $adsPayment = PostFilter($_POST['adsPayment']);
    } else {
        $adsPayment = "Cash";
    }//end if

    if (isset($_GET['newid'])) {
        $newid = InputFilter($_GET['newid']);
        if ($newid == "yes") {
            // cheking if this user alredy have and publisher account
            ExcuteQuery('SELECT * FROM `bannerclients` WHERE `UserId` ="' . $UserId . '";');
            if ($TotalRecords <= 0) {
                //ADD new id in the idBanClnt
                $idBanClnt = GenerateID("bannerclients", "idBanClnt");
                $InsertidBanClnt = "INSERT INTO `bannerclients` (`idBanClnt`, `UserId`, `AdminOk`,`adsPayment`) 
									VALUES ('" . $idBanClnt . "', '" . $UserId . "', '0','" . $adsPayment . "');";
                $Recordset = mysqli_query($conn,$InsertidBanClnt) ;
            }//end if
            else {
                
            }
        }//end if
    }//end if
    //cheking if admin say ok for this client account

    ExcuteQuery("SELECT `AdminOk` FROM `bannerclients` WHERE `UserId` ='" . $UserId . "';");
    if ($TotalRecords > 0) {
        $AdminOk = $Rows['AdminOk'];
        if ($AdminOk == "1") {
            //AdminSayOk and we are not in 2 case : creat new camping or create new bannerS
            if (!isset($_GET['editban'])
                    and !isset($_GET['CreateCamp'])
                    and !isset($_POST['submitnewbanandaddnew'])
                    and !isset($_POST['submitnewbanandaddnewflash'])
                    and !isset($_POST['submitnewbanandaddnewimg'])
                    and !isset($_GET['CampDetails'])
                    and !isset($_GET['accdet'])
                    and !isset($_GET['PriceList'])
                    and !isset($_GET['newid'])
            ) {
                include_once('Programs/ads/current_campains.php');
            }
        } else {
            echo UMustWaitAdminOk;
        }//end if
    }//end if
} else {
    echo AdvestisingIsNotAvailbleNow;
}

function UpBanFlash($UpIdBanner) {
    global $SqlType, $conn;
    $selectpos = PostFilter($_POST['selectpos']);
    $BannerName = PostFilter($_POST['BannerName']);
    $banFlashSource = PostFilter($_POST['banFlashSource']);
    $BannerTarget = PostFilter($_POST['BannerTarget']);
    $Active = PostFilter($_POST['Active']);
    $CodeBan = '<object type="application/x-shockwave-flash" data="' . $banFlashSource . '" width="{width}" height="{height}">
				<param name="movie" value="' . $banFlashSource . '" />
				<img src="images/notworking.gif" width="100" height="100" alt="Flash Player" />
				</object>';

    $query = "UPDATE `banner` SET 
	`BanName` = '" . $BannerName . "',
	`CodeBan` = '" . $CodeBan . "',
	`ClickUrl` = '" . $BannerTarget . "',
	`Position` = '" . $selectpos . "',
	`Active` = '" . $Active . "' 
	WHERE `banner`.`IdBanner` = '" . $UpIdBanner . "';";

    $Recordset = mysqli_query($conn,$query) ;
}

//end function

function UpBanImg($UpIdBanner) {
    global $SqlType, $conn;
    $selectpos = PostFilter($_POST['selectpos']);
    $ImgName = PostFilter($_POST['ImgName']);
    $altText = PostFilter($_POST['altText']);
    $ImgSrc = PostFilter($_POST['ImgSrc']);
    $ClickUrl = PostFilter($_POST['ClickUrl']);
    $Active = PostFilter($_POST['Active']);
    $CodeBan = '<img src="' . $ImgSrc . '" alt="' . $altText . '" border="0"  width="{width}" height="{height}" />';

    $query = "UPDATE `banner` SET 
			`BanName` = '" . $ImgName . "',
			`CodeBan` = '" . $CodeBan . "',
			`ClickUrl` = '" . $ClickUrl . "',
			`altTxt` = '" . $altText . "',
			`Position` = '" . $selectpos . "',
			`Active` = '" . $Active . "' 
			WHERE `banner`.`IdBanner` = '" . $UpIdBanner . "';";
    //echo $query;

    $Recordset = mysqli_query($conn,$query) ;
}

//end function

function UpBanText($UpIdBanner) {

    global $SqlType, $conn;
    $bantexttitle = PostFilter($_POST['bantexttitle']);
    $bantextdesc1 = PostFilter($_POST['bantextdesc1']);
    $bantextdesc2 = PostFilter($_POST['bantextdesc2']);
    $banshowaddress = PostFilter($_POST['banshowaddress']);
    $bantargeturl = PostFilter($_POST['bantargeturl']);
    $Active = PostFilter($_POST['Active']);
    $selectpos = PostFilter($_POST['selectpos']);

    //$modbantargeturl = LangLink($_SERVER['QUERY_STRING'].'&banid='.$UpIdBanner);
    $Vars = array('prog', 'banid');
    $Vals = array('ads', $UpIdBanner);
    $modbantargeturl = CreateLink('', $Vars, $Vals);

    $CodeBan = '<strong>' . $bantexttitle . '</strong><br />' . $bantextdesc1 . ' <br />' . $bantextdesc2 . '<br /><a href="' . $modbantargeturl . '" target="_blank" title="' . $bantexttitle . '">' . $banshowaddress . '</a><br />';

    $query = "UPDATE `banner` SET 
			`BanName` = '" . $bantexttitle . "',
			`CodeBan` = '" . $CodeBan . "',
			`ClickUrl` = '" . $bantargeturl . "',
			`Position` = '" . $selectpos . "' 
			WHERE `banner`.`IdBanner` = '" . $UpIdBanner . "';";
    $Recordset = mysqli_query($conn,$query) ;
}

//end function

function SaveBanIMG() {
    global $conn;
    if (isset($_POST['ImgName'])) {
        $IdComp = PostFilter($_POST['IdComp']);
        $IdBanner = GenerateID("banner", "IdBanner");
        $ImgName = PostFilter($_POST['ImgName']);
        $altText = PostFilter($_POST['altText']);
        $ImgSrc = PostFilter($_POST['ImgSrc']);
        $ClickUrl = PostFilter($_POST['ClickUrl']);
        $Position = PostFilter($_POST['selectpos']);

        $CodeBan = '<img src="' . $ImgSrc . '" alt="' . $altText . '" border="0"  width="{width}" height="{height}" />';
        //show this banner to the user

        echo (LatestSavedBanner) . "<br/>" . $CodeBan . "<br />";
        $QueryBan = "INSERT INTO `banner` ( `IdBanner` , `IdComp` , `BanName` , `ViewMade` , `ClicksMade` , `CodeBan` , `ClickUrl` , `altTxt` , `Position` , `Active` , `Cost` )
					VALUES (
					'" . $IdBanner . "', '" . $IdComp . "', '" . $ImgName . "', '0', '0', '" . $CodeBan . "', '" . $ClickUrl . "', '" . $altText . "', '" . $Position . "', '1', '0');";

        $Recordset = mysqli_query($conn,$QueryBan) ;
    }//end if
}

//end function

function SaveBanFlash() {
    global $conn;
    if (isset($_POST['banFlashSource'])) {
        $IdComp = PostFilter($_POST['IdComp']);
        $BannerName = PostFilter($_POST['BannerName']);
        $IdBanner = GenerateID("banner", "IdBanner");
        //$BannerTarget = PostFilter($_POST['BannerTarget']);
        $BannerTarget = '';
        $banFlashSource = PostFilter($_POST['banFlashSource']);
        $Position = PostFilter($_POST['selectpos']);

        //$modbantargeturl = LangLink($_SERVER['QUERY_STRING'].'&banid='.$IdBanner);
        $Vars = array('prog', 'banid');
        $Vals = array('ads', $IdBanner);
        $modbantargeturl = CreateLink('', $Vars, $Vals);

        $CodeBan = '<object type="application/x-shockwave-flash" data="' . $banFlashSource . '" width="{width}" height="{height}">
					<param name="movie" value="' . $banFlashSource . '" />
					<img src="images/notworking.gif" width="100" height="100" alt="Flash Player" />
					</object>';
        $QueryBan = "INSERT INTO `banner` ( `IdBanner` , `IdComp` , `BanName` , `ViewMade` , `ClicksMade` , `CodeBan` , `ClickUrl` , `altTxt` , `Position` , `Active` , `Cost` )
					VALUES (
					'" . $IdBanner . "', '" . $IdComp . "', '" . $BannerName . "', '0', '0', '" . $CodeBan . "', '" . $BannerTarget . "', '', '" . $Position . "', '1', '0');";
        //echo $QueryBan;
        $Recordset = mysqli_query($conn,$QueryBan) ;
        //show this banner to the user
        echo (LatestSavedBanner) . "<br/>" . $CodeBan . "<br />";
    }//end if
}

//end function

function SaveBanText() {
    global $conn;
    if (isset($_POST['bantexttitle'])) {
        $IdComp = PostFilter($_POST['IdComp']);
        //echo "save text banner for campaing " . $IdComp;
        $bantexttitle = PostFilter($_POST['bantexttitle']);
        $bantextdesc1 = PostFilter($_POST['bantextdesc1']);
        $bantextdesc2 = PostFilter($_POST['bantextdesc2']);
        $banshowaddress = PostFilter($_POST['banshowaddress']);
        $IdBanner = GenerateID("banner", "IdBanner");
        $bantargeturl = PostFilter($_POST['bantargeturl']);

        $Position = PostFilter($_POST['selectpos']);
        //$modbantargeturl = LangLink($_SERVER['QUERY_STRING'].'&banid='.$IdBanner);
        $Vars = array('prog', 'banid');
        $Vals = array('ads', $IdBanner);
        $modbantargeturl = CreateLink('', $Vars, $Vals);

        $CodeBan = '<strong>' . $bantexttitle . '</strong><br />' . $bantextdesc1 . ' <br />' . $bantextdesc2 . '<br /><a href="' . $modbantargeturl . '" target="_blank" title="' . $bantexttitle . '">' . $banshowaddress . '</a><br />';
        //show this banner to the user
        echo (LatestSavedBanner) . "<br/>" . $CodeBan . "<br />";
        $QueryBan = "INSERT INTO `banner` ( `IdBanner` , `IdComp` , `BanName` , `ViewMade` , `ClicksMade` , `CodeBan` , `ClickUrl` , `altTxt` , `Position` , `Active` , `Cost` )
					VALUES (
					'" . $IdBanner . "', '" . $IdComp . "', '" . $bantexttitle . "', '0', '0', '" . $CodeBan . "', '" . $bantargeturl . "', '', '" . $Position . "', '1', '0');";

        $Recordset = mysqli_query($conn,$QueryBan) ;
    }//end if
}

//end function

function BannerPositions() {
    global $TotalRecords, $Rows, $Recordset;
    $Pos = '<select class="select" name="selectpos" id="selectpos" >';
    ExcuteQuery("SELECT * FROM `bannerpositions`");
    if ($TotalRecords > 0) {
        for ($i = 0; $i < $TotalRecords; $i++) {
            $PositionNbr = $Rows['PositionNbr'];
            $PositionName = $Rows['PositionName'];
            $PosWidth = $Rows['PosWidth'];
            $PosHeight = $Rows['PosHeight'];
            $Pos .='<option name="text" value="' . $PositionNbr . '">' . $PositionName . ' : ' . $PosWidth . '*' . $PosHeight . ' </option>';
            $Rows = mysqli_fetch_assoc($Recordset);
        }//end for
    }//end if
    $Pos .="</select>";
    return $Pos;
}

//end function

function CurrentCharge($IdComp) {

    // get current price for click and view
    global $conn;
    /*
      $Query = "SELECT `ViewPrice`,`ClickPrice` FROM `bannerplans` WHERE
      curdate() >= `planStart` and curdate() <= `planEnd` and `IdBanPlan`='".$IdComp."';";
     */
    $Query = "SELECT sum(`Cost`) as Cost FROM `banner` WHERE  `IdComp`='" . $IdComp . "';";
    $Recordset = mysqli_query($conn,$Query) ;
    $TotalRecords = mysqli_num_rows($Recordset);
    if ($TotalRecords > 0) {
        $Rows = mysqli_fetch_assoc($Recordset);
        /*

          $ViewPrice = $Rows['ViewPrice'];
          $ClickPrice = $Rows['ClickPrice'];
          return round(($ViewPrice*ViewMade($IdComp))+($ClickPrice*ClicksMade($IdComp)),2)."$";
         */
        $Cost = $Rows['Cost'];
        return round($Cost, 2) . '';
    } else {
        return 0;
    }//end if
}

//end function

function ViewMade($IdComp) {
    global $conn;
    $ViewQuery = "SELECT SUM(`ViewMade`) AS CampView FROM `banner` WHERE
					`IdComp`= '" . $IdComp . "';";

    $ViewRecordset = mysqli_query($conn,$ViewQuery) ;
    $ViewTotalRecords = mysqli_num_rows($ViewRecordset);
    if ($ViewRecordset  ) {
        $ViewRows = mysqli_fetch_assoc($ViewRecordset);
        return $ViewRows['CampView'];
    } else {
        return " 0 ";
    }//end if
}

//end function

function ClicksMade($IdComp) {
    global $conn;
    $ClicksQuery = "SELECT sum(`ClicksMade`) as ClicksMade FROM `banner` WHERE 
				`IdComp`='" . $IdComp . "';";

    $ClicksRecordset = mysqli_query($conn,$ClicksQuery) ;
    $ClicksTotalRecords = mysqli_num_rows($ClicksRecordset);
    if ($ClicksRecordset ) {
        $ClicksRows = mysqli_fetch_assoc($ClicksRecordset);
        return $ClicksRows['ClicksMade'];
    } else {
        return 0;
    }//end if
}

//end function

function PriceList() {
    global $ThemeName;
    $ArrPriceList = array();
    $PriceList = '<div align="center"><strong>' . (PriceList) . '</strong></div>
							<table border="0" cellpadding="2" cellspacing="2">
							<tr>
							<td><strong>' . (BPName) . ' </strong></td>
							<td><strong>' . (BPActive) . ' </strong></td>
							<td><strong>' . (BPDesc) . ' </strong></td>
							<td><strong>' . (ViewPrice) . ' </strong></td>
							<td><strong>' . (ClickPrice) . ' </strong></td>
							<td><strong>' . (LinksNbr) . ' </strong></td>
							<td><strong>' . (planStart) . ' </strong></td>
							<td><strong>' . (planEnd) . ' </strong></td>
							</tr>';
    $db = new db();
    $banPos = $db->get_results('SELECT * FROM `bannerplans` order by `IdBanPlan` desc;');
    if ($banPos) {
        foreach ($banPos as $news) {
            $IdBanPos = $news->IdBanPlan;
            if ($news->BPActive == '1') {
                $BPActive = (yes);
            } else {
                $BPActive = (no);
            }//end if
            $ArrPriceList[] = '<tr onmouseover="this.style.background=\'url(Themes/' . $ThemeName . '/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->BPName . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $BPActive . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->BPDesc . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->ViewPrice . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->ClickPrice . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->LinksNbr . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->planStart . '  </td>'
                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| ' . $news->planEnd . '  </td>'
                    . '</tr>';
        }// end foreach
        $PriceListTab = Pagination($ArrPriceList, 10, 10);
        /*
          $PriceList .=  CreateNaviPage($ArrPriceList,$MaxResultPerPage=50,$ShowNaviBar=1).' <br/>'; // divid data between pages, and give number for eanch page
          $PriceList .=  CreateNaviPage($ArrPriceList,$MaxResultPerPage=50,$ShowNaviBar=0); // print content of this page
         */
        $PriceList .=$PriceListTab[0];
        $PriceList .= '	</table>';
        $PriceList .=$PriceListTab[1];
    } else {
        $PriceList = '<div align="center"><strong>' . (PriceList) . '</strong> <br/>
						' . (Nopricelistforthismomment) . '</div>';
    }//end if
    /*
      echo  	CreateNaviPage($ArrayData,$MaxResultPerPage=3,$ShowNaviBar=1).'<br/>'; // divid data between pages, and give number for eanch page
      echo 	 (HelloWorld).'<br/>'; // use this function to load constant from lang files
      echo  	CreateNaviPage($ArrayData,$MaxResultPerPage=3,$ShowNaviBar=0); // print content of this page
     */
    return $PriceList;
}

//end function
?>





