<?php
$project ='phpTransformer';
global $project,$ThemeName, $PoolTotalRecords,$PoolRows, $PoolRecordset,$conn;

include_once("../../config.php");

require_once("../../includes/InputFilters.php");
include_once("../../includes/Sql.php");
require_once("../../DBConnect/".$SqlType."/index.php");
include_once("../../includes/ezsql/ez_sql.php");
include_once("../../includes/Functions.php");
include_once("../../Global.php");
$IdLang = PostFilter($_POST['IdLang']);
$Lang = PostFilter($_POST['Lang']);
$UserId = PostFilter($_POST['UserId']);
include_once("../../languages/lang-".$Lang.".php");
SqlConnect();
//require_once("../../includes/Utf8/utf8.class.php");

ExcuteQueryPoll('SELECT * FROM `pooltitle` WHERE `lastpol`=1 and `Deleted`<>1');
if ($PoolTotalRecords>0){
	$Idpt = $PoolRows['Idpt'];
        $multichoice = $PoolRows['multichoice'];

}
else{
	$Idpt ="";
        $multichoice = 0;
}


if  ($UserId == "20070000000"){ //Guest
	// can Guests write in our site ?
	if($GuestCanWrite == "1"){
		//chek if this ip geust has an record
		ExcuteQueryPoll('SELECT * FROM `poolusers` WHERE `UserId` = "20070000000" and `Idpt`="'.$Idpt .'" and `IpPool` = "'.$_SERVER['REMOTE_ADDR'].'"');
		if ($PoolTotalRecords>0){
			$GuestIpPool = 1;
		}
		else{
			$GuestIpPool = 0;
		}//end if
		// cheking by cookie if this guest vote to this pool
		if(isset($_COOKIE['Idpt'])){
			$GuestIdpt = $_COOKIE['Idpt'];
		}
		else{
			$GuestIdpt ="" ;
		}//end if
		if(($GuestIdpt == $Idpt) or ($GuestIpPool == 1)){
			$ResultPoll = PoolResult($Idpt);
		}
		else{
                    AddVote($Idpt,$multichoice);
                    $ResultPoll= PoolResult($Idpt);
                }

        }
        else{
           $ResultPoll= PoolResult($Idpt);
        }
}
else{

 AddVote($Idpt,$multichoice);
 $ResultPoll= PoolResult($Idpt);

}


function AddVote($Idpt,$multichoice){
// multi choisse ?
global $UserId,$PoolTotalRecords,$PoolRows,$PoolRecordset ;
if($multichoice == "1"){
	//chekbox values
	//echo $UserId;
	ExcuteQueryPoll('SELECT `idpc` FROM `poolchoices` WHERE `idpt`="'.$Idpt.'"');
	if ($PoolTotalRecords>0){
		for($i=0;$i<$PoolTotalRecords;$i++){
			$idpc = $PoolRows['idpc'];
			if(isset($_POST['Choise'.$idpc])){
				$$idpc = PostFilter($_POST['Choise'.$idpc]);
				//echo $$idpc."<br/>";
				if(isset($_POST['poolcomment'])){
					$Comment = PostFilter($_POST['poolcomment']);
				}
				else{
					$Comment = "";
				}//end if
				//insert new vote


					$INSERTquery = "INSERT INTO `poolusers` ( `UserId` , `Idpt` , `idpc` , `IpPool` , `Comment` )
									VALUES ('".$UserId."', '".$Idpt."', '".$idpc."', '".$_SERVER['REMOTE_ADDR']."', '".$Comment."');";
					global $conn;
					$INSERTRecordset = mysqli_query($conn,$INSERTquery) ;

				if ($UserId == "20070000000" ){
					setcookie("Idpt", $Idpt, time() + 31104000);
				}//end if
			}// end if
			$PoolRows = mysqli_fetch_assoc($PoolRecordset);
		} //end for
	} //end if
}
else{
	//radio values
	if(isset($_POST['choise'])){
		$idpc = PostFilter($_POST['choise']);
		//echo $$idpc."<br/>";
		if(isset($_POST['poolcomment'])){
			$Comment = PostFilter($_POST['poolcomment']);
		}
		else{
			$Comment = "";
		}//end if
		//insert new vote

			$INSERTquery = "INSERT INTO `poolusers` ( `UserId` , `Idpt` , `idpc` , `IpPool` , `Comment` )
							VALUES ('".$UserId."', '".$Idpt."', '".$idpc."', '".$_SERVER['REMOTE_ADDR']."', '".$Comment."');";
			global $conn;
			$INSERTRecordset = mysqli_query($conn,$INSERTquery) ;

		if ($UserId == "20070000000" ){
			setcookie("Idpt", $Idpt, time() + 31104000);
		}//end if
	}// end if
	//} //end if
}//end if

} //end function

/*** Show result  ***/
function PoolResult($Idpt){

global $ThemeName,$IdLang,$Lang ,$UserId,$PoolRecordset, $SqlType, $conn, $PoolTotalRecords, $PoolRows;;

	ExcuteQueryPoll('SELECT `Title` FROM `poollangtitles` WHERE
	`IdLang` ="'.$IdLang.'" and `Idpt`="'.$Idpt .'"');
	if ($PoolTotalRecords>0){
		$Title = $PoolRows['Title'];
	}
	else{
		$Title = ' ';
	}//end if
        
	$ResultPoll =  '<div><div class="poll_title">'.$Title."<br/></div>";
	ExcuteQueryPoll('SELECT * FROM `poolusers` WHERE `Idpt` = "'.$Idpt.'"');
	//if($PoolTotalRecords >0){
		$SumOfAll =  $PoolTotalRecords;
	//}
	//else{
	//	$SumOfAll =1;
	//}//end if
	ExcuteQueryPoll('SELECT `idpc` FROM `poolchoices` WHERE `idpt`="'.$Idpt.'";');
	if ($PoolTotalRecords>0){
                $ResultChoise = '';
                $PollUsers = '';
		for ($i=0;$i<$PoolTotalRecords;$i++){
			$idpc = $PoolRows['idpc'];
			// get the sum of itch option

			$ChoiseQuery = 'SELECT `Choise` FROM `poollangchoices` WHERE `IdLang` ="'.$IdLang.'" and `idpc` ="'.$idpc .'" and `idpt`="'.$Idpt.'"';
			$ChoiseRecordset = mysqli_query($conn,$ChoiseQuery);
			$ChoiseTotalRecords = mysqli_num_rows($ChoiseRecordset);
			$ChoiseRows = mysqli_fetch_assoc($ChoiseRecordset);
			if ($ChoiseTotalRecords>0){
				$Choise = $ChoiseRows['Choise'];
				//$ResultChoise .=  $Choise;
			}//end if

			$idpcquery = 'SELECT COUNT(*) as Ttl  FROM `poolusers` WHERE `Idpt` ="'.$Idpt .'" AND `idpc` ="'.$idpc.'";';
				$idpcRecordset = mysqli_query($conn,$idpcquery);
				$idpcTotalRecords = mysqli_num_rows($idpcRecordset);
				$idpcRows = mysqli_fetch_assoc($idpcRecordset);
				$Ttl=$idpcRows['Ttl'] ;
				//$ResultPoll .=  $Ttl  .  (votes) . "<br/>";
				//pecentage calcul
				if($SumOfAll<1){
					$ResultChoise .= '<div class="poll_choise"  >0% ' . $Choise . '<br />
                                                                <div class="poll_percentage" style=" width:0%;"></div> 
                                                          </div>';
				}
				else{
					$ResultChoise .=  '<div class="poll_choise" >' . round($Ttl / $SumOfAll * 100, 1) . "% " . $Choise . '<br />
                                                                <div class="poll_percentage" style="width:' . round($Ttl / $SumOfAll * 100, 1) . '%;"></div> 
                                                          </div>';

				}


		$PoolRows = mysqli_fetch_assoc($PoolRecordset);
		}
               $ResultPoll = $ResultPoll . $ResultChoise ;
               $ResultPoll = $ResultPoll . SumOfVoices ." : " . $SumOfAll ;
	}// End if
	$ResultPoll .=  "</div>";
        


$ResultPoll = str_replace('<', '&lt;', $ResultPoll);
$ResultPoll = str_replace('>', '&gt;', $ResultPoll);
$ResultPoll = str_replace('&nbsp;', ' ', $ResultPoll);
return $ResultPoll;

}
/*************************/
//sleep(1);
/*************************/

header ("content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>";
	echo '<stats>';
		echo '<PollResult>';
			echo '<total>'.$ResultPoll.'</total>';
		echo '</PollResult>';
	echo '</stats>';

function ExcuteQueryPoll($query){

    global $PoolRecordset, $SqlType, $conn, $PoolTotalRecords, $PoolRows;

    $PoolRecordset = mysqli_query($conn,$query) ;
    $PoolTotalRecords = mysqli_num_rows($PoolRecordset);
    if ($PoolTotalRecords>0){
        $PoolRows = mysqli_fetch_assoc($PoolRecordset);
    }//end if
}//end function

?>