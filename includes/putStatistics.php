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
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php

include_once("../config.php");
include_once("Functions.php");
include_once("ezsql/ez_sql.php");
include_once("../Global.php");
include_once("InputFilters.php");
include_once("session.php");

if(isset($_POST['put'])){
    if(PostFilter($_POST['put'])==1){
        PutSatatisticsNow();
    }
}
else{
      //header("location: ../");
}
//THIS FILE CAUSE SLOW REQUEST !!

function PutSatatisticsNow(){
    
    global $NickName,$GeoIpService;
    //echo session_id();
    if(isset($_SESSION['NickName'])){
        $NickName = $_SESSION['NickName'];
    }
    StoreLogin($NickName);

    $MSIE=0;$Opera=0;$Konqueror=0;$Netscape=0;$FireFox=0;$Bot=0;$Windows=0;$Linux=0;$Mac=0;$FreeBsd=0;$Other=0;


    switch (UserBrowser()){
            case "msie":
                    $MSIE=1;
                    break;
            case "opera":
                    $Opera=1;
                    break;
            case "konqueror":
                    $Konqueror=1;
                    break;
            case "netscape":
                    $Netscape=1;
                    break;
            case "firefox":
                    $FireFox=1;
                    break;
            case "bot":
                    $Bot=1;
                    break;
    } //end switch

    switch (OperatingSys()){
            case "windows":
                    $Windows=1;
                    break;
            case "linux":
                    $Linux=1;
                    break;
            case "mac":
                    $Mac=1;
                    break;
            case "freebsd":
                    $FreeBsd=1;
                    break;
            default :
                    $Other=1;
                    break;
    } //end switch


    $InsertQwery = "UPDATE `opstatistics` SET `MSIE`=`MSIE`+".$MSIE." ,
                                     `Opera`=`Opera`+".$Opera." ,
                                     `Konqueror`=`Konqueror`+".$Konqueror." ,
                                     `Netscape`=`Netscape`+".$Netscape." ,
                                     `FireFox`=`FireFox`+".$FireFox." ,
                                     `Bot`=`Bot`+".$Bot." ,
                                     `Windows`=`Windows`+".$Windows." ,
                                     `Linux`=`Linux`+".$Linux." ,
                                     `Mac`=`Mac`+".$Mac." ,
                                     `FreeBsd`=`FreeBsd`+".$FreeBsd." ,
                                     `Other`=`Other`+".$Other;

    // we dont insert many records for one session , anti flood
    if(isset($_COOKIE['lastpt'])){
            if(session_id()!=$_COOKIE['lastpt']){
                            setcookie("lastpt", session_id());
            }//end if
    }
    else{
            //storing session id in another cookie
            //insert new record for OP SYS and Browser
            $dbstat = new db();
            $dbstat->query($InsertQwery);

            if(isset($_COOKIE['users_resolution'])){
                    $screen_res = $_COOKIE['users_resolution'];
            }
            else{
                    $screen_res = "Anknow";
            }

            $Sequery = ' SELECT * FROM `screens` WHERE `ScreenXY`="'.$screen_res.'";';
            $stat = $dbstat->get_row($Sequery);


            if ($stat){
                    //this screen already have recorde, add +1 hits
                    $UpdateQwery = "UPDATE `screens` SET `Hits` = `Hits` +1  WHERE CONVERT( `screens`.`ScreenXY` USING utf8 ) = '".$screen_res."';";
                    $dbstat->query($UpdateQwery);
            }
            else{
                    // insert record for this resolution
                    $InsertQwery = "INSERT INTO `screens` (`ScreenXY`, `Hits`) VALUES ('".$screen_res."', '1');";
                    $dbstat->query($InsertQwery);
            }
            setcookie("lastpt", session_id());
    }//end if

    if(isset($_SERVER['HTTP_REFERER'])){
            $_SERVER['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
    }
    else{
            $_SERVER['HTTP_REFERER']="";
    }

    /**** upadte country table for current visit ****/

    $Sessquery = " select * from `userslog` where `SessionId`='".session_id()."';";
    $dbCountry = new db();
    $Results = $dbCountry->get_results($Sessquery);
    if ($Results){
            $ContryCode = strtoupper(GetPageContent($GeoIpService.$_SERVER['REMOTE_ADDR']));
            $UpdateRank = "update `cclang` set `rank`=`rank`+1 where `cc`='".$ContryCode."';";
            $dbCountry->query($UpdateRank);
    }//end if


    if($NickName!="Guest"){
        $userLogSql = "update `userslog` set `NickName`='".$NickName."' where `SessionId`='".session_id()."'; ";
        $Results = $dbCountry->query($userLogSql);
    }
    
    $CurrentPage = $_SERVER['QUERY_STRING'];

    if(isset($_SERVER['HTTP_REFERER'])){
        $Refer = $_SERVER['HTTP_REFERER'];
    }
        else{
         $Refer = ' ';

    }
    
    $InsertQwery = "INSERT INTO `userslog` ( `NickName` , `Gmt` , `IpNbr` , `SessionId` , `FromPage` , `CurrentPage` )
        VALUES ( '".$NickName."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', '".session_id()."', '".$Refer."', '" . $CurrentPage . "' );";
    $Results = $dbCountry->query($InsertQwery);

    //now we wel delete old statistics from day

    $Query = 'delete from `userslog` where  DATEDIFF( CURDATE() , `Gmt` )>=1 ' ;
    $Results = $dbCountry->query($Query);
}

function StoreLogin($NickName){

    //storing current user transaction , ADDED AFTER SYSTEM CACHE

    $CurrentPage = $_SERVER['QUERY_STRING'];
    if(isset($_SERVER['HTTP_REFERER'])){
        $Refer = $_SERVER['HTTP_REFERER'];
    }
        else{
         $Refer = ' ';

    }
    
    $InsertQwery = "INSERT INTO `userslog` ( `NickName` , `Gmt` , `IpNbr` , `SessionId` , `FromPage` , `CurrentPage` )
            VALUES (
            '".$NickName."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."', '".session_id()."', '".$Refer."', '" . $CurrentPage . "'
            );";
    $dbSTS= new db();
    $dbSTS->query($InsertQwery);
    // END STORING CURRENT USER TRANSACTION
    

}

?>

