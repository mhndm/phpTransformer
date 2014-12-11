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
    header("location: ../");
} ?>
<?php

global $conn, $AdsTotalRecords, $AdsRows;

// if user click banner we will redirect it to the publisher site and add +1 to the clicked points
if (isset($_GET['banid'])) {
    $banid = InputFilter($_GET['banid']);
    // SELECT URL FOR THIS BAN ID
    $Banquery = 'SELECT * FROM `banner` WHERE IdBanner = "' . $banid . '";';
    $BanRecordset = mysqli_query($conn,$Banquery)  ;
    $BanTotalRecords = mysqli_num_rows($BanRecordset);
    if ($BanTotalRecords > 0) {
        $BanRows = mysqli_fetch_assoc($BanRecordset);
        $ClickUrl = $BanRows['ClickUrl'];
        // add +1
        $Banquery = 'UPDATE `banner` SET `ClicksMade` = `ClicksMade`+1 WHERE `IdBanner`  = "' . $banid . '" LIMIT 1 ;';
        $BanRecordset = mysqli_query($conn,$Banquery)  ;
        // Get Cost unit from bannerplans
        AdsExcuteQuery("SELECT `ViewPrice`,`ClickPrice` FROM `bannerplans` WHERE
					CURDATE() >=`planStart` and CURDATE() <= `planEnd` and `BPActive`='1';");
        if ($AdsTotalRecords > 0) {
            $ViewPrice = $AdsRows['ViewPrice'];
            $ClickPrice = $AdsRows['ClickPrice'];
        } else {
            $ViewPrice = 0;
            $ClickPrice = 0;
        }//end if
        //add cost to banner per View
        $CostQuery = "UPDATE `banner` SET `Cost` = `Cost` + " . $ClickPrice . " WHERE `IdBanner`='" . $banid . "' ;";

        $Recordset = mysqli_query($conn,$CostQuery)  ;

        // redirect to publisher site
        header("Location: $ClickUrl");
        //echo '<script type="text/javascript"> function MM_openBrWindow(theURL,winName,features) { window.open(theURL,winName,features); } MM_openBrWindow("'.$ClickUrl.'","",""); </script>';
    }//END IF
}//end if

function ShowAds($Position) {
// textbanner : dont have an alt text, img banner have an alt text, flash banner dont have any alt text
    global $conn, $AdsTotalRecords, $AdsRows;
    $ShowAds = '';
    /*     * *************************** */
    /*
      BUG IN SUM OF BANNER VIEWS
     */
    /*     * ***************************** */
    //get valid campains
    $ValidCamp = array();
    $db = new db();
    $campaigns = $db->get_results('SELECT 
                                                `campaign`.`IdComp`,
                                                `campaign`.`Budget`,
                                                `campaign`.`MaxView`,
                                                `campaign`.`MaxClick`,
                                                sum(`banner`.`Cost`) as Bsum ,
                                                sum(`banner`.`ViewMade`) as BViewMade  ,
                                                sum(`banner`.`ClicksMade`) as BClicksMade
                                                FROM `banner` , `campaign`
                                                where 	(`banner`.`IdComp` = `campaign`.`IdComp`)
                                                and `campaign`.`Activity`="1"
                                                and (CURDATE() > `campaign`.`CompStart`)
                                                and (CURDATE() < `campaign`.`CompEnd` ) 
                                                and `banner`.`Active`="1"
                                                group by `campaign`.`IdComp`;');

    if ($campaigns) {
        foreach ($campaigns as $campaign) {
            if ($campaign->Bsum < $campaign->Budget and
                    $campaign->BViewMade < $campaign->MaxView and
                    $campaign->BClicksMade < $campaign->MaxClick) {
                $ValidCamp[] = $campaign->IdComp;
                //echo 'ValidCamp '.$campaign->IdComp .'<br/>';
            }//end if	
        }//end for each
    }
    if (count($ValidCamp) > 0) {

        $i = rand(0, count($ValidCamp) - 1);
        //echo 'i '.$i  .'<br/>';
        $IdComp = $ValidCamp[$i];
        //echo 'IdComp '. $IdComp  .'<br/>';
        // select banner and show it
        $Banquery = 'SELECT * FROM `banner`,`campaign`
						where
						(`banner`.`Position`=' . $Position . ')
						and (`banner`.`Active` ="1")
						and (`banner`.`IdComp` = ' . $IdComp . ')
						ORDER BY RAND() LIMIT 1000;';

        $BanRecordset = mysqli_query($conn,$Banquery); // ;	
        $BanTotalRecords = mysqli_num_rows($BanRecordset);
        if ($BanTotalRecords > 0) {
            // random nbr , loop for, fetsch echo
            //$r = rand(0,$BanTotalRecords -1);
            //for($i=$r;$i<$BanTotalRecords;$i++){
            $BanRows = mysqli_fetch_array($BanRecordset);
            //} //end for 
            $IdBanner = $BanRows['IdBanner'];
            $CodeBan = $BanRows['CodeBan'];
            $ClickUrl = $BanRows['ClickUrl'];
            $altTxt = $BanRows['altTxt'];
            $ClicksMade = $BanRows['ClicksMade'];
            $MaxClick = $BanRows['MaxClick'];
            // Get Cost unit from bannerplans
            AdsExcuteQuery("SELECT `ViewPrice`,`ClickPrice` FROM `bannerplans` WHERE
						CURDATE() >=`planStart` and CURDATE() <= `planEnd`;");
            if ($AdsTotalRecords > 0) {
                $ViewPrice = $AdsRows['ViewPrice'];
                $ClickPrice = $AdsRows['ClickPrice'];
            } else {
                $ViewPrice = 0;
                $ClickPrice = 0;
            }
            //replace  width="{width}" height="{height}"  by this position  width and height
            AdsExcuteQuery("SELECT `PosWidth`,`PosHeight` FROM `bannerpositions` WHERE `PositionNbr`='" . $Position . "';");
            if ($AdsTotalRecords > 0) {
                $PosWidth = $AdsRows['PosWidth'];
                $PosHeight = $AdsRows['PosHeight'];
            }
            $CodeBan = VarTheme("{width}", $PosWidth, $CodeBan);
            $CodeBan = VarTheme("{height}", $PosHeight, $CodeBan);

            // click or view
            if ($ClickUrl != "" and $ClicksMade < $MaxClick) {
                if ($altTxt != "") {
                    //Prog-ads_banid-20080000006_Lang-Arabic_nl-1.pt
                    $LinkAds = CreateLink("", array("Prog", "banid"), array("ads", $IdBanner));
                    //echo '<a href="'.LangLink($_SERVER['QUERY_STRING'].'&banid='.$IdBanner).' " target="_blank"><div width="'.$PosWidth.'" height="'.$PosHeight.'">'. $CodeBan .'</div></a>'; //Bug in prog Prog
                    $ShowAds .=  '<a href="' . $LinkAds . ' " target="_blank"><div width="' . $PosWidth . '" 
                            height="' . $PosHeight . '">' . $CodeBan . '</div></a>';
                } else {
                    $ShowAds .=  $CodeBan;
                }//end if
            } else {
                $ShowAds .=  $CodeBan;
                $Banquery = 'UPDATE `banner` SET `ViewMade` = `ViewMade`+1 WHERE `IdBanner` = "' . $IdBanner . '" ;';
                $BanRecordset = mysqli_query($conn,$Banquery)  ;
                //add cost to banner per View
                $CostQuery = "UPDATE `banner` SET `Cost` = `Cost` + " . $ViewPrice . " WHERE `IdBanner`='" . $IdBanner . "' ;";

                $Recordset = mysqli_query($conn,$CostQuery) ;
            }//end if
            //update statistics for this banner
        } else {
            //print default banner for no ads availble
            $ShowAds .=  '<img src="Blocks/Ads/images/noads.jpg" alt="noads" />';
        }//end if
    } else {
        $ShowAds .=  '&nbsp;';
    }//end if
    return $ShowAds ;
}

function AdsExcuteQuery($query) {

    global $SqlType;

    global $AdsRecordset, $SqlType, $conn, $AdsTotalRecords, $AdsRows;
    $AdsRecordset = mysqli_query( $conn,$query) ;
    $AdsTotalRecords = mysqli_num_rows($AdsRecordset);
    if ($AdsTotalRecords > 0) {
        $AdsRows = mysqli_fetch_assoc($AdsRecordset);
    }//end if
    //}//end if
}

//end function
?>