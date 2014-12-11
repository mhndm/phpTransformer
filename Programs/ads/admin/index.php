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
<?php global $IsAdmin; if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $TotalRecords,$TotalRecords,$Rows,$Recordset,$Lang,$conn,$ThemeName  ;

include_once("Programs/ads/admin/Languages/lang-$Lang.php");
include_once("Programs/ads/Languages/lang-$Lang.php");

$theList = ProgIconLink("ads","customers"). "<br/>"
		  .ProgIconLink("ads","positions"). "<br/>"
		  .ProgIconLink("ads","PriceList"). "<br/>";
		
if(isset($_GET['subdo'])){
	switch($_GET['subdo']){
		case "customers":
			$theContent = Customers();
			break;
		case "positions":
			$theContent =  Positions();
			break;		
		case "PriceList":
			$theContent =  PriceList();
			break;
			
		default :
			$theContent = Customers();
	}//end switch
}
else{
	$theContent = Customers();
}//end if

$Ads = get_include_contents("Programs/ads/admin/SubContent.php");
$Ads = VarTheme("{ThemeName}", $ThemeName,$Ads );
$Ads = VarTheme("{List}", $theList,$Ads );
$Ads = VarTheme("{Content}", $theContent,$Ads );

echo $Ads;

function newPL(){
	global $CustomHead;
	
	if(isset($_POST['SaveNewPriceList'])){
		$IdBanPlan 	= GenerateID('bannerplans','IdBanPlan');
		$BPName 		= PostFilter($_POST['BPName']);
		$BPDesc			= PostFilter($_POST['BPDesc']);
		$ViewPrice		= PostFilter($_POST['ViewPrice']);
		$ClickPrice		= PostFilter($_POST['ClickPrice']);
		$LinksNbr		= PostFilter($_POST['LinksNbr']);
		$planStart		= PostFilter($_POST['planStart']);
		$planEnd		= PostFilter($_POST['planEnd']);
		
		$db= new db();
		$db->query("INSERT INTO `bannerplans`
					(IdBanPlan,BPName,BPDesc,ViewPrice,ClickPrice,LinksNbr,planStart,planEnd) 
					values ('".$IdBanPlan."','".$BPName."','".$BPDesc."','".$ViewPrice."','".$ClickPrice."','".$LinksNbr."','".$planStart."','".$planEnd."') ");
		$newPL =   (SuccessSavePriceList);
	
	}
	else{
		$BPNameValue 		='';
		$BPDescValue		='';
		$ViewPriceValue		='';
		$ClickPriceValue	='';
		$LinksNbrValue		='';
		$planStartValue		='';
		$planEndValue		='';
		
		$CustomHead .= '
                    <script language="javascript" type="text/javascript">
    document.onkeydown = document.onkeypress = function (evt) {
        if (!evt && window.event) {
            evt = window.event;
        }
        var keyCode = evt.keyCode ? evt.keyCode :
            evt.charCode ? evt.charCode : evt.which;
        if (keyCode) {
            if (evt.ctrlKey) {
                if(keyCode==83){
					document.getElementById("SaveNewPriceList").click();
                    return false;
                }
                return false;
            }
        }
        return true;
    }
</script>
<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
						<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
						<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
						<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
						<script src="Blocks/Ads/Themes/Default/SpryValidationTextField.js" type="text/javascript"></script>
						<script src="Programs/ads/admin/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/ads/admin/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		$newPL = '<form id="form1" name="form1" method="post" action="">
					<table border="0" cellspacing="1" cellpadding="1">
					  <tr>
					    <td>'. (BPName).'</td>
					    <td>
					      <span id="sprytextfield1">
					      <input class="text" name="BPName" type="text" id="BPName" value="'.$BPNameValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>      </td>
					  </tr>
					  <tr>
					    <td>'. (BPActive).'</td>
					    <td>
						<select class="select" name="BPActive" id="BPActive">
					      <option value="1">'. (yes).'</option>
					      <option value="0">'. (no).'</option>
					    </select>    
						</td>
					  </tr>
					  <tr>
					    <td>'. (BPDesc).'</td>
					    <td><span id="sprytextfield2">
					      <input class="text" name="BPDesc" type="text" id="BPDesc" value="'.$BPDescValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
					  </tr>
					  <tr>
					    <td>'. (ViewPrice).'</td>
					    <td><span id="sprytextfield3">
					      <input class="text" name="ViewPrice" type="text" id="ViewPrice" value="'.$ViewPriceValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
					  </tr>
					  <tr>
					    <td>'. (ClickPrice).'</td>
					    <td><span id="sprytextfield4">
					      <input class="text" name="ClickPrice" type="text" id="ClickPrice" value="'.$ClickPriceValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
					  </tr>
					  <tr>
					    <td>'. (LinksNbr).'</td>
					    <td><span id="sprytextfield5">
					      <input class="text" name="LinksNbr" type="text" id="LinksNbr" value="'.$LinksNbrValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
					  </tr>
					  <tr>
					    <td>'. (planStart).'</td>
					    <td><span id="sprytextfield6">
					      <input class="text" name="planStart" type="text" id="planStart" value="'.$planStartValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
					  </tr>
					  <tr>
					    <td>'. (planEnd).'</td>
					    <td><span id="sprytextfield7">
					      <input class="text" name="planEnd" type="text" id="planEnd" value="'.$planEndValue.'" />
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
					  </tr>
					  <tr>
					    <td colspan="2">
						<input class="submit" type="submit" name="SaveNewPriceList" id="SaveNewPriceList" value="'. (SaveNewPriceList).'" /></td>
					  </tr>
					</table>
					</form> 
					<script type="text/javascript">
					<!--
					var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
					var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
					var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
					var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
					var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
					var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
					var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
					//-->
					</script>

					<script type="text/javascript">
					function catcalc(cal) {
					var date = cal.date;
					var time = date.getTime();
					}
					Calendar.setup({
					inputField     :    "planStart",   // id of the input field
					ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
					showsTime      :    true,
					timeFormat     :    "24",
					onUpdate       :    catcalc
					});
					Calendar.setup({
					inputField     :    "planEnd",   // id of the input field
					ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
					showsTime      :    true,
					timeFormat     :    "24",
					onUpdate       :    catcalc
					});

					</script>';	
	}//end if
	return $newPL;
	
}//end function

function editPL(){
	global $CustomHead;
	$IdBanPlan 	= InputFilter($_GET['editPL']);
	if(isset($_POST['SaveEditPriceList'])){
		//$IdBanPlan 	= GenerateID('bannerplans','IdBanPlan');
		$BPName 		= PostFilter($_POST['BPName']);
		$BPDesc			= PostFilter($_POST['BPDesc']);
		$BPActive		= PostFilter($_POST['BPActive']);
		$ViewPrice		= PostFilter($_POST['ViewPrice']);
		$ClickPrice		= PostFilter($_POST['ClickPrice']);
		$LinksNbr		= PostFilter($_POST['LinksNbr']);
		$planStart		= PostFilter($_POST['planStart']);
		$planEnd		= PostFilter($_POST['planEnd']);
		
		$db= new db();
		$db->query("UPDATE `bannerplans` SET
					BPName= '".$BPName."',
					BPDesc= '".$BPDesc."',
					BPActive= '".$BPActive."',
					ViewPrice= '".$ViewPrice."',
					ClickPrice= '".$ClickPrice."',
					LinksNbr= '".$LinksNbr."',
					planStart= '".$planStart."',
					planEnd= '".$planEnd."'
					where `IdBanPlan`='".$IdBanPlan."' ;");
		$editPL =   (SuccessSavePriceList);
	
	}
	else{

		$db= new db();
		$plIST = $db->get_row("SELECT * FROM `bannerplans` WHERE `IdBanPlan`='".$IdBanPlan."';");
		if(!$plIST){
			$editPL ='';
		}
		else{
			$BPNameValue 		= $plIST->BPName;
			$BPDescValue		= $plIST->BPDesc;
			$ViewPriceValue		= $plIST->ViewPrice;
			$ClickPriceValue	= $plIST->ClickPrice;
			$LinksNbrValue		= $plIST->LinksNbr;
			$planStartValue		= $plIST->planStart;
			$planEndValue		= $plIST->planEnd;
			
			$CustomHead .= '<script language="javascript" type="text/javascript">
                                            document.onkeydown = document.onkeypress = function (evt) {
                                                if (!evt && window.event) {
                                                    evt = window.event;
                                                }
                                                var keyCode = evt.keyCode ? evt.keyCode :
                                                    evt.charCode ? evt.charCode : evt.which;
                                                if (keyCode) {
                                                    if (evt.ctrlKey) {
                                                        if(keyCode==83){
                                                                                document.getElementById("SaveEditPriceList").click();
                                                            return false;
                                                        }
                                                        return false;
                                                    }
                                                }
                                                return true;
                                            }
                                        </script>

                                        <link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
							<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
							<script type="text/javascript" src="includes/jscalendar/Languages/calendar-Arabic.js"></script>
							<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>
							<script src="Blocks/Ads/Themes/Default/SpryValidationTextField.js" type="text/javascript"></script>
							<script src="Programs/ads/admin/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
							<link href="Programs/ads/admin/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
			$editPL = '<form id="form1" name="form1" method="post" action="">
						<table border="0" cellspacing="1" cellpadding="1">
						  <tr>
						    <td>'. (BPName).'</td>
						    <td>
						      <span id="sprytextfield1">
						      <input class="text" name="BPName" type="text" id="BPName" value="'.$BPNameValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>      </td>
						  </tr>
						  <tr>
						    <td>'. (BPActive).'</td>
						    <td>
							<select class="select" name="BPActive" id="BPActive">
						      <option value="1">'. (yes).'</option>
						      <option value="0">'. (no).'</option>
						    </select>    
							</td>
						  </tr>
						  <tr>
						    <td>'. (BPDesc).'</td>
						    <td><span id="sprytextfield2">
						      <input class="text" name="BPDesc" type="text" id="BPDesc" value="'.$BPDescValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						  </tr>
						  <tr>
						    <td>'. (ViewPrice).'</td>
						    <td><span id="sprytextfield3">
						      <input class="text" name="ViewPrice" type="text" id="ViewPrice" value="'.$ViewPriceValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						  </tr>
						  <tr>
						    <td>'. (ClickPrice).'</td>
						    <td><span id="sprytextfield4">
						      <input class="text" name="ClickPrice" type="text" id="ClickPrice" value="'.$ClickPriceValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						  </tr>
						  <tr>
						    <td>'. (LinksNbr).'</td>
						    <td><span id="sprytextfield5">
						      <input class="text" name="LinksNbr" type="text" id="LinksNbr" value="'.$LinksNbrValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						  </tr>
						  <tr>
						    <td>'. (planStart).'</td>
						    <td><span id="sprytextfield6">
						      <input class="text" name="planStart" type="text" id="planStart" value="'.$planStartValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						  </tr>
						  <tr>
						    <td>'. (planEnd).'</td>
						    <td><span id="sprytextfield7">
						      <input class="text" name="planEnd" type="text" id="planEnd" value="'.$planEndValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						  </tr>
						  <tr>
						    <td colspan="2">
							<input class="submit" type="submit" name="SaveEditPriceList" id="SaveEditPriceList" value="'. (SaveNewPriceList).'" /></td>
						  </tr>
						</table>
						</form> 
						<script type="text/javascript">
						<!--
						var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
						var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
						var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
						var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
						var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
						var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
						var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
						//-->
						</script>

						<script type="text/javascript">
						function catcalc(cal) {
						var date = cal.date;
						var time = date.getTime();
						}
						Calendar.setup({
						inputField     :    "planStart",   // id of the input field
						ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
						showsTime      :    true,
						timeFormat     :    "24",
						onUpdate       :    catcalc
						});
						Calendar.setup({
						inputField     :    "planEnd",   // id of the input field
						ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
						showsTime      :    true,
						timeFormat     :    "24",
						onUpdate       :    catcalc
						});

						</script>';	
		}//end if
	}//end if
	return $editPL;
	
}//end function


function delPL(){
	$IdBanPlan 	= InputFilter($_GET['delPL']);
	$db = new db();
	$db->query("delete from `bannerplans` where `IdBanPlan`='".$IdBanPlan."';");
	return  (SuccessDeletePrice);
	
}//end function

function PriceList(){
	global $ThemeName, $CustomHead;
	$ArrPriceList =array();
	$PriceList ='';
	if(isset($_GET['editPL'])){
		return editPL();
	}
	elseif(isset($_GET['delPL'])){
		return delPL();
	}//end if
	if(isset($_POST['NewPriceList']) or isset($_POST['SaveNewPriceList'])){
		return newPL();
	}//end if
	
	$PriceList ='<form name="form1" method="post" action="">
					<input class="submit" type="submit" name="NewPriceList" id="NewPriceList" value="'. NewPriceList.'">
				</form>';
				
	$PriceList .= '<table border="0" cellpadding="2" cellspacing="2">
					<tr>
					<td><strong>'. BPName.' </strong></td>
					<td><strong>'. BPActive.' </strong></td>
					<td><strong>'. BPDesc.' </strong></td>
					<td><strong>'. ViewPrice.' </strong></td>
					<td><strong>'. ClickPrice.' </strong></td>
					<td><strong>'. LinksNbr.' </strong></td>
					<td><strong>'. planStart.' </strong></td>
					<td><strong>'. planEnd.' </strong></td>
					<td> </td>
					<td> </td>
					</tr>';
	$db = new db();
	$banPos = $db->get_results('SELECT * FROM `bannerplans`  order by `IdBanPlan` desc;;');
	if($banPos){
            foreach ( $banPos as $news ){

                    $IdBanPos = $news->IdBanPlan;
                    $Vars = array('prog','subdo','editPL');
                    $Vals = array('ads','PriceList',$IdBanPos);
                    $editPL = '<a href="'. AdminCreateLink('',$Vars,$Vals).'">'. (edit).'</a>';
                    $Vars = array('prog','subdo','delPL');
                    $Vals = array('ads','PriceList',$IdBanPos);
                    $deletePL = '<a onclick="return acceptDel();" href="'. AdminCreateLink('',$Vars,$Vals).'">'. (delete).'</a>';

                    if($news->BPActive =='1'){
                            $BPActive =  (yes);
                    }else{
                            $BPActive =  (no);
                    }//end if
                    $ArrPriceList[] = '<tr onmouseover="this.style.background=\'url(admin/Themes/'.$ThemeName.'/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->BPName.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$BPActive.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->BPDesc.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->ViewPrice.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->ClickPrice.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->LinksNbr.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->planStart.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->planEnd.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$editPL.'  </td>'
                                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$deletePL.'</td>'
                                                    . '</tr>';

            }// end foreach
            $PriceListTab = Pagination($ArrPriceList,10,10);
            $PriceList .=   $PriceListTab[0].'</table>';
            $PriceList .=   $PriceListTab[1];
            /*
            $PriceList .=  CreateNaviPage($ArrPriceList,$MaxResultPerPage=50,$ShowNaviBar=1).' <br/>'; // divid data between pages, and give number for eanch page
            $PriceList .=  CreateNaviPage($ArrPriceList,$MaxResultPerPage=50,$ShowNaviBar=0); // print content of this page
                    */
            $PriceList .= '<script language="javascript" type="text/javascript">
                                                    function acceptDel(){
                                                    return confirm("'. (DidUWantToDeletePriceList).'");
                                                    }
                                            </script>
                                            ';
					
	}
	else{
		$PriceList ='<form name="form1" method="post" action="">
					<input class="submit" type="submit" name="NewPriceList" id="NewPriceList" value="'. (NewPriceList).'">
				</form>';
	}//end if
	return $PriceList;
	
}//end function

function editpos(){
	global $CustomHead;
	$editpos ='';
	$IdBanPos	= InputFilter($_GET['editpos']);
	if(isset($_POST['UpdatePosition'])){
		$PositionNbr 		= PostFilter($_POST['PositionNbr']);
		$PositionName   	= PostFilter($_POST['PositionName']);
		$PosWidth   		= PostFilter($_POST['PosWidth']);
		$PosHeight   		= PostFilter($_POST['PosHeight']);
		$db= new db();
		$db->query("update `bannerpositions` set 
					`PositionNbr`='".$PositionNbr."' ,
					`PositionName`='".$PositionName."' ,
					`PosWidth`='".$PosWidth."' ,
					`PosHeight`='".$PosHeight."' 
					where `IdBanPos`='".$IdBanPos."'; ");
		$editpos .=  (SuccessSavePosition);
	}
	else{
		$db= new db();
		$poset = $db->get_row("select * from `bannerpositions` where `IdBanPos`='".$IdBanPos."';");
		$PositionNbrValue  		= $poset->PositionNbr;
		$PositionNameValue   	= $poset->PositionName;
		$PosWidthValue   		= $poset->PosWidth;
		$PosHeightValue   		= $poset->PosHeight;

		$CustomHead .= '<script language="javascript" type="text/javascript">
                                    document.onkeydown = document.onkeypress = function (evt) {
                                        if (!evt && window.event) {
                                            evt = window.event;
                                        }
                                        var keyCode = evt.keyCode ? evt.keyCode :
                                            evt.charCode ? evt.charCode : evt.which;
                                        if (keyCode) {
                                            if (evt.ctrlKey) {
                                                if(keyCode==83){
                                                                        document.getElementById("UpdatePosition").click();
                                                    return false;
                                                }
                                                return false;
                                            }
                                        }
                                        return true;
                                    }
                                </script>
                                <script src="Programs/ads/admin/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/ads/admin/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		$editpos .='<form id="form1" name="form1" method="post" action="">
						  <table width="100%" border="0" cellspacing="1" cellpadding="1">
						    <tr>
						      <td>'. (PositionNbr).'</td>
						      <td><span id="sprytextfield1">
						      <input class="text" name="PositionNbr" type="text" id="PositionNbr" value="'.$PositionNbrValue.'"/>
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'
						      </span></span></td>
						    </tr>
						    <tr>
						      <td>'. (PositionName).'</td>
						      <td><span id="sprytextfield2">
						      <input class="text" name="PositionName" type="text" id="PositionName" value="'.$PositionNameValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						    </tr>
						    <tr>
						      <td>'. (PosWidth).'</td>
						      <td><span id="sprytextfield3">
						      <input class="text" name="PosWidth" type="text" id="PosWidth" value="'.$PosWidthValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						    </tr>
						    <tr>
						      <td>'. (PosHeight).'</td>
						      <td><span id="sprytextfield4">
						      <input class="text" name="PosHeight" type="text" id="PosHeight" value="'.$PosHeightValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						    </tr>
						    <tr>
						      <td colspan="2">
							  <input class="submit" type="submit" name="UpdatePosition" id="UpdatePosition" value="'. (SaveNewPosition).'" /></td>
						    </tr>
						  </table>
						</form>
						<script type="text/javascript">
						<!--
						var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
						var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
						var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
						var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
						//-->
						</script>
						';
	}//end if
	return $editpos;

}//end function

function NewPosition(){
	global $CustomHead;
	$NewPosition ='';
	if(isset($_POST['SaveNewPosition'])){
		$IdBanPos			= GenerateID('bannerpositions','IdBanPos');
		$PositionNbr 		= PostFilter($_POST['PositionNbr']);
		$PositionName   	= PostFilter($_POST['PositionName']);
		$PosWidth   		= PostFilter($_POST['PosWidth']);
		$PosHeight   		= PostFilter($_POST['PosHeight']);
		$db= new db();
		$db->query("INSERT INTO `bannerpositions`
					(IdBanPos,PositionNbr,PositionName,PosWidth,PosHeight) 
					values ('".$IdBanPos."','".$PositionNbr."','".$PositionName."','".$PosWidth."','".$PosHeight."') ");
		
		$NewPosition .=  (SuccessSavePosition);
	
	}
	else{
		$PositionNbrValue  = '';
		$PositionNameValue   = '';
		$PosWidthValue   = '';
		$PosHeightValue   = '';
                	$CustomHead .= '<script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                            document.getElementById("SaveNewPosition").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>';
		$CustomHead .= '<script src="Programs/ads/admin/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
						<link href="Programs/ads/admin/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		
		$NewPosition .='<form id="form1" name="form1" method="post" action="">
						  <table width="100%" border="0" cellspacing="1" cellpadding="1">
						    <tr>
						      <td>'. (PositionNbr).'</td>
						      <td><span id="sprytextfield1">
						      <input class="text" name="PositionNbr" type="text" id="PositionNbr" value="'.$PositionNbrValue.'"/>
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'
						      </span></span></td>
						    </tr>
						    <tr>
						      <td>'. (PositionName).'</td>
						      <td><span id="sprytextfield2">
						      <input class="text" name="PositionName" type="text" id="PositionName" value="'.$PositionNameValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						    </tr>
						    <tr>
						      <td>'. (PosWidth).'</td>
						      <td><span id="sprytextfield3">
						      <input class="text" name="PosWidth" type="text" id="PosWidth" value="'.$PosWidthValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						    </tr>
						    <tr>
						      <td>'. (PosHeight).'</td>
						      <td><span id="sprytextfield4">
						      <input class="text" name="PosHeight" type="text" id="PosHeight" value="'.$PosHeightValue.'" />
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
						    </tr>
						    <tr>
						      <td colspan="2"><input class="submit" type="submit" name="SaveNewPosition" id="SaveNewPosition" value="'. (SaveNewPosition).'" /></td>
						    </tr>
						  </table>
						</form>
						<script type="text/javascript">
						<!--
						var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
						var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
						var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
						var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
						//-->
						</script>
						';
	}//end if
	return $NewPosition;

}//end function

function delpos(){
	$delpos ='';
	if(isset($_GET['delpos'])){
		$IdBanPos = InputFilter($_GET['delpos']);
	}
	else{
		$IdBanPos = '';
	}//end if
	
	//cheking if this pos have banners
	$db = new db();
	$Position = $db->get_results('SELECT * FROM `banner`,`bannerpositions` 
									WHERE 
									`banner`.`Position`=`bannerpositions`.`PositionNbr` and
									`bannerpositions`.`IdBanPos`='.$IdBanPos.';');
	//echo count($Position);
	if(count($Position)>0){
		return  (UcantDeletePosBecauseHaveBanners);
	}
	else{
		$db->query("delete from `bannerpositions` where `IdBanPos`='".$IdBanPos."'");
		return  (SuccessDeletePosition);
	}//end if
	return $delpos;
}//end function

function Positions(){
	
	global $ThemeName, $CustomHead;
	
	if(isset($_GET['editpos'])){
		return editpos();
	}
	elseif(isset($_GET['delpos'])){
		return delpos();
	}//end if
	if(isset($_POST['NewPosition']) or isset($_POST['SaveNewPosition'])){
		return NewPosition();
	}//end if
	$CustomHead .= '<script language="javascript" type="text/javascript">
                            document.onkeydown = document.onkeypress = function (evt) {
                                if (!evt && window.event) {
                                    evt = window.event;
                                }
                                var keyCode = evt.keyCode ? evt.keyCode :
                                    evt.charCode ? evt.charCode : evt.which;
                                if (keyCode) {
                                    if (evt.ctrlKey) {
                                        if(keyCode==83){
                                                                document.getElementById("NewPosition").click();
                                            return false;
                                        }
                                        return false;
                                    }
                                }
                                return true;
                            }
                        </script>';
	$Positions ='<form name="form1" method="post" action="">
					<input class="submit" type="submit" name="NewPosition" id="NewPosition" value="'. (NewPosition).'">
				</form>';
	$Positions .= '<table border="0" cellpadding="2" cellspacing="2">
					<tr>
					<td><strong>'. (PositionNbr).' </strong></td>
					<td><strong>'. (PositionName).' </strong></td>
					<td><strong>'. (PosWidth).' </strong></td>
					<td><strong>'. (PosHeight).' </strong></td>
					<td> </td>
					<td> </td>
					</tr>';
        $PositionsARR = array();
	$db = new db();
	$banPos = $db->get_results('SELECT * FROM `bannerpositions`;');
	foreach ( $banPos as $news ){
		$IdBanPos = $news->IdBanPos;
		$Vars = array('prog','subdo','editpos');
		$Vals = array('ads','positions',$IdBanPos);
		$editPos = '<a href="'. AdminCreateLink('',$Vars,$Vals).'">'. (edit).'</a>';		
		$Vars = array('prog','subdo','delpos');
		$Vals = array('ads','positions',$IdBanPos);
		$deletePos = '<a onclick="return acceptDel();" href="'. AdminCreateLink('',$Vars,$Vals).'">'. (delete).'</a>';
		
		$PositionsARR[].= '<tr onmouseover="this.style.background=\'url(admin/Themes/'.$ThemeName.'/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">'
                                    .'<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->PositionNbr.'  </td>'
                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->PositionName.'  </td>'
                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->PosWidth.'  </td>'
                                    .'<td style="border-bottom:dotted; border-bottom-width:thin">| '.$news->PosHeight.'  </td>'
                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$editPos.'  </td>'
                                    . '<td style="border-bottom:dotted; border-bottom-width:thin">| '.$deletePos.'</td>'
                                    .'</tr>';
	}//end for each
        $PositionsTab = Pagination($PositionsARR,10,10);
        $Positions .= $PositionsTab[0].'</table>';
        $Positions .= $PositionsTab[1];
	$Positions .= '<script language="javascript" type="text/javascript">
						function acceptDel(){
						return confirm("'. (DidUWantToDeletePosition).'");
						}
					</script> 
					';
	return $Positions;
}//end function

function Customers(){
global $TotalRecords,$Rows,$conn,$Lang, $Recordset  ;
	$Customers = '';
        $CustomersArr = array();
	if(isset($_GET['NickName']) and !isset($_GET['makereceipt']) and !isset($_GET['editreceipt'])){
		$Customers = Showtransaction();
	}
	elseif(isset($_GET['makereceipt'])){
		$Customers =  makereceipt();
	}
	elseif(isset($_GET['editreceipt'])){
		$Customers = editreceipt();
	}
	else{
		//show users
		$Customers = '<strong>'. (PleaseChooseAnClientToManageDetailsads).'</strong><br/>';
		$Query = "select distinct(`NickName`) from `bannerclients`,`users` 
					where `bannerclients`.`UserId`=`users`.`UserId`;";
		ExcuteQuery($Query);
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				//$UserId = $Rows['UserId'];
				$NickName = $Rows['NickName'];
				$Vars = array("prog","subdo","NickName");
				$Vals = array("ads","customers",$NickName);
				
				$CustomersArr[] = '<a href="'.AdminCreateLink('',$Vars,$Vals) .'" title="" >'. $NickName .'</a><br/>';
				
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
                      //echo count($CustomersArr);
                    $CustomersTab = Pagination($CustomersArr,50,10);
                    $Customers .= $CustomersTab[0].$CustomersTab[1];
		}//end if

            
	}//end if
    return $Customers;
} //end function

function editreceipt(){
	global $TotalRecords,$Rows,$conn,$Lang ;
	$Customers = '';
	$UserId = InputFilter($_GET['adsUserId']);
	$editreceipt = InputFilter($_GET['editreceipt']);
	if(isset($_POST['submitEDITpayment'])){
		$amount 		= PostFilter($_POST['amount']);
		$description 	= PostFilter($_POST['description']);
		$datececeipt 	= PostFilter($_POST['datececeipt']);
		
		if(is_numeric($amount)){
			$IdTrans 		= GenerateID('bancltrans','IdTrans');
			$SqlReceipt 	= "UPDATE `bancltrans` SET 
								`IdTrans` = '".$IdTrans."',
								`idBanClnt` ='".$UserId."',
								`Debit`='',
								`Credit`='".$amount."',
								`Date`='".$datececeipt ."',
								`ValueDate`='".$datececeipt ."',
								`Desc`='".$description."'
								WHERE `IdTrans`='".$editreceipt ."' AND `idBanClnt`='".$UserId."';";
			$Recordset = mysqli_query($conn,$SqlReceipt) ;	
			$Customers .=   (SuccessSaveReceipt) .' : '. $IdTrans ;
		}
		else{
			$Customers .=  (AmountMustBeAnNumber);
		}//end if
	}
	else{
		$Query = "select * from `users` where `UserId`='".$UserId."';";
		ExcuteQuery($Query);
		if ($TotalRecords>0){
			$NickName = $Rows['NickName'];
			$Query = "select * from `bancltrans` where `idBanClnt`='".$UserId."' and `IdTrans`='".$editreceipt."';";
			ExcuteQuery($Query);
			if ($TotalRecords>0){
				$amount 		= $Rows['Credit'];
				$description 	= $Rows['Desc'];
				$datececeipt 	= $Rows['Date'];
			}
			else{
				$amount 		= "";
				$description 	= "";
				$datececeipt 	= "";
			}//end if
			
			global $CustomHead ;
			$CustomHead .= '<script language="javascript" type="text/javascript">
                                            document.onkeydown = document.onkeypress = function (evt) {
                                                if (!evt && window.event) {
                                                    evt = window.event;
                                                }
                                                var keyCode = evt.keyCode ? evt.keyCode :
                                                    evt.charCode ? evt.charCode : evt.which;
                                                if (keyCode) {
                                                    if (evt.ctrlKey) {
                                                        if(keyCode==83){
                                                                                document.getElementById("submitEDITpayment").click();
                                                            return false;
                                                        }
                                                        return false;
                                                    }
                                                }
                                                return true;
                                            }
                                        </script>
                                        <link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
						<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
						<script type="text/javascript" src="includes/jscalendar/Languages/calendar-'.$Lang.'.js"></script>
						<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>';
			$CustomHead .='<script src="Programs/ads/admin/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
				<link href="Programs/ads/admin/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
				
				$Customers .=  (makeReceiptFor). ' '. $NickName  .
				'<form id="formpayment" name="formpayment" method="post" action="">
				<table border="0" cellspacing="1" cellpadding="1">
				  <tr>
				    <td>'. (amount).'</td>
				    <td>
				      <span id="sprytextfield1">
				      <label>
				      <input value="'.$amount.'" size="6" maxlength="6" class="text" type="text" name="amount" id="amount" /> $
				      </label>
				      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>    </td>
				  </tr>
				  <tr>
				    <td>'. (description).'</td>
				    <td><span id="sprytextfield2">
				      <label>
				      <input value="'.$description.'" name="description" type="text" class="text" id="description" size="50" maxlength="100" />
				      </label>
				      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
				  </tr>
				  <tr>
				    <td>'. (Date).'</td>
				    <td><span id="sprytextfield3">
				      <label>
				      <input value="'.$datececeipt.'" class="text" type="text" name="datececeipt" id="datececeipt" />
				      </label>
				      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
				  </tr>
				  <tr>
				    <td colspan="2" align="center"><label>
				      <input class="submit" type="submit" name="submitEDITpayment" id="submitEDITpayment" value="'. (save).'" />
				    </label></td>
				  </tr>
				</table>
				</form>

				<script type="text/javascript">
				<!--
				var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
				var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
				var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
				//-->
				</script>

				<script type="text/javascript">
				function catcalc(cal) {
						 var date = cal.date;
						var time = date.getTime();
				}
				Calendar.setup({
				inputField     :    "datececeipt",   // id of the input field
				ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
				showsTime      :    true,
				timeFormat     :    "24",
				onUpdate       :    catcalc
				});
				</script>';	
		}//end if
	}//end if
	return $Customers ;
}//end function

function makereceipt(){
	global $TotalRecords,$Rows,$conn,$Lang ;
	$makereceipt = '';
	//make receipt 
	$UserId = InputFilter($_GET['adsUserId']);
	if(isset($_POST['submitpayment'])){
		$amount 		= PostFilter($_POST['amount']);
		$description 	= PostFilter($_POST['description']);
		$datececeipt 	= PostFilter($_POST['datececeipt']);
		
		if(is_numeric($amount)){
			$IdTrans 		= GenerateID('bancltrans','IdTrans');
			$SqlReceipt 	= "insert into `bancltrans` (`IdTrans`,`idBanClnt`,`Debit`,`Credit`,`Date`,`ValueDate`,`Desc`) 
								values('".$IdTrans."','".$UserId."','','".$amount."','".$datececeipt ."','".$datececeipt ."','".$description."');";
			$Recordset = mysqli_query($conn,$SqlReceipt) ;	
			$makereceipt .=  (SuccessSaveReceipt) .' : '. $IdTrans ;
		}
		else{
			$makereceipt .=   (AmountMustBeAnNumber);
		}//end if
	}
	else{
		$Query = "select * from `users` where `UserId`='".$UserId."';";
		ExcuteQuery($Query);
		if ($TotalRecords>0){
		global $CustomHead ;
		$CustomHead .= '<script language="javascript" type="text/javascript">
                                document.onkeydown = document.onkeypress = function (evt) {
                                    if (!evt && window.event) {
                                        evt = window.event;
                                    }
                                    var keyCode = evt.keyCode ? evt.keyCode :
                                        evt.charCode ? evt.charCode : evt.which;
                                    if (keyCode) {
                                        if (evt.ctrlKey) {
                                            if(keyCode==83){
                                                document.getElementById("submitpayment").click();
                                                return false;
                                            }
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                            </script>
                            <link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
					<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
					<script type="text/javascript" src="includes/jscalendar/Languages/calendar-'.$Lang.'.js"></script>
					<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>';
		$CustomHead .='<script src="Programs/ads/admin/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
			<link href="Programs/ads/admin/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
			$NickName = $Rows['NickName'];
			$makereceipt .=   (makeReceiptFor). ' '. $NickName  .
			'<form id="formpayment" name="formpayment" method="post" action="">
			<table border="0" cellspacing="1" cellpadding="1">
			  <tr>
			    <td>'. (amount).'</td>
			    <td>
			      <span id="sprytextfield1">
			      <label>
			      <input size="6" maxlength="6" class="text" type="text" name="amount" id="amount" /> $
			      </label>
			      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>    </td>
			  </tr>
			  <tr>
			    <td>'. (description).'</td>
			    <td><span id="sprytextfield2">
			      <label>
			      <input name="description" type="text" class="text" id="description" size="50" maxlength="100" />
			      </label>
			      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
			  </tr>
			  <tr>
			    <td>'. (Date).'</td>
			    <td><span id="sprytextfield3">
			      <label>
			      <input class="text" type="text" name="datececeipt" id="datececeipt" />
			      </label>
			      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
			  </tr>
			  <tr>
			    <td colspan="2" align="center"><label>
			      <input class="submit" type="submit" name="submitpayment" id="submitpayment" value="'. (save).'" />
			    </label></td>
			  </tr>
			</table>
			</form>

			<script type="text/javascript">
			<!--
			var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
			var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
			var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
			//-->
			</script>

			<script type="text/javascript">
			function catcalc(cal) {
					 var date = cal.date;
					var time = date.getTime();
			}
			Calendar.setup({
			inputField     :    "datececeipt",   // id of the input field
			ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
			showsTime      :    true,
			timeFormat     :    "24",
			onUpdate       :    catcalc
			});
			</script>';	
		}//end if
	}//end if
	return $makereceipt;
}//end function

function Showtransaction(){
	global $TotalRecords,$Rows,$conn ;
	$Showtransaction ='';
	$NickName = InputFilter($_GET['NickName']);
	$Query = "select * from `users` 
				where `NickName`='".$NickName."';";
	ExcuteQuery($Query);
	if ($TotalRecords>0){
			$UserId = $Rows['UserId'];
	}//END IF
	
	//ads Transactions
	$Vars = array("prog","adsUserId","makereceipt");
	$Vals = array("ads",$UserId,"1");
	$Showtransaction .= '<a href="'.AdminCreateLink('',$Vars,$Vals).'" title="">'.  (makereceipt).' </a><br/>';
	
	$Showtransaction .= '<strong>'. (CampainsTransaction).' : ' .$NickName. '</strong>';
	$Showtransaction .= '<table width="100%" border="0" cellspacing="1" cellpadding="1">
		  <tr>
		    <td><span style="color:#9CAFF3"><strong>'. (CampName).'</strong></span></td>
		    <td><span style="color:#666666"><strong>'. (CompStart).'</strong></span></td>
		    <td><span style="color:#9CAFF3"><strong>'. (CompEnd).'</strong></span></td>
		    <td><span style="color:#666666"><strong>'. (CurrentCharge).'</strong></span></td>
		  </tr>';

	$TotalBanCost = 0;
	$cquery ="SELECT `IdComp`, `CampName`,`CompStart`, `CompEnd` FROM `campaign` WHERE `idBanClnt` = '$UserId' ;";

			$cRecordset = mysqli_query($conn,$cquery);	
			$cTotalRecords = mysqli_num_rows($cRecordset);
			if ($cTotalRecords>0){
				while($cRows = mysqli_fetch_assoc($cRecordset)){
				$Cost = CurrentCharge($cRows["IdComp"]);
				 $Showtransaction .= ' <tr>
						    <td><span style="color:#9CAFF3">'.$cRows["CampName"].'</span></td>
						    <td><span style="color:#666666">'.$cRows["CompStart"].'</span></td>
						    <td><span style="color:#9CAFF3">'.$cRows["CompEnd"].'</span></td>
						    <td><span style="color:#666666">'.$Cost.'</span></td>
						</tr>';	
				$TotalBanCost += $Cost;
				}//end while
			}//end if

	$Showtransaction .= '</table><br/>';
	$Showtransaction .=  (TotalBanCost) . $TotalBanCost ."$ <br/> <br/>";

	//payment transactions
	$Showtransaction .= '<strong>'. (PaymentsTransaction).'</strong>';
	$Showtransaction .= '<br/><table width="100%" border="0" cellspacing="1" cellpadding="1">
		  <tr>
		    <td><span style="color:#9CAFF3"><strong>'. (Date).'</strong></span></td>
		    <td><span style="color:#666666"><strong>'. (Debit).'</strong></span></td>
		    <td><span style="color:#9CAFF3"><strong>'. (Credit).'</strong></span></td>
		    <td><span style="color:#666666"><strong>'. (ValueDate).'</strong></span></td>
		    <td><span style="color:#9CAFF3"><strong>'. (Desc).'</strong></span></td>
		    <td><span style="color:#9CAFF3"><strong>&nbsp;</strong></span></td>
		  </tr>';
	$Debit = 0;
	$Credit = 0;
	$cquery ="SELECT * FROM `bancltrans` WHERE `idBanClnt`='$UserId';";
			$cRecordset = mysqli_query($conn,$cquery)  ;	
			$cTotalRecords = mysqli_num_rows($cRecordset);
			if ($cTotalRecords>0){
				while($cRows = mysqli_fetch_assoc($cRecordset)){
				$Vars = array("prog","adsUserId","editreceipt");
				$Vals = array("ads",$UserId,$cRows["IdTrans"]);
				$Showtransaction .= '  <tr>
				    <td><span style="color:#9CAFF3">'.$cRows["Date"].'</span></td>
				    <td><span style="color:#666666">'.$cRows["Debit"].'</span></td>
				    <td><span style="color:#9CAFF3">'.$cRows["Credit"].'</span></td>
				    <td><span style="color:#666666">'.$cRows["ValueDate"].'</span></td>
				    <td><span style="color:#9CAFF3">'.$cRows["Desc"].'</span></td>
				    <td><span style="color:#9CAFF3"><a href="'.AdminCreateLink('',$Vars,$Vals).'" title="">'.  (editreceipt).' </a></span></td>
				  </tr>';
				// if($cRows["ValueDate"] >= date('Y-m-d H:i:s')){
					$Debit  +=$cRows["Debit"];
					$Credit +=$cRows["Credit"];
				// }//end if
				}//end while
			}//end if
	$Showtransaction .= '</table><br/><strong>';
	$Showtransaction .=  (ResumeAccountTransaction). "<br/>";
	$Showtransaction .=  (Debit) . " " . ($Debit + $TotalBanCost) . "$ &nbsp;&nbsp;&nbsp; ";
	$Showtransaction .=  (Credit) . " " . $Credit . "$ &nbsp;&nbsp;&nbsp; ";
	//balance
	$Balance = $Credit - ($Debit + $TotalBanCost)  ;
	$Showtransaction .=  (Balance). ': ' .$Balance .' $ </strong>';
	return $Showtransaction;
}//end function

function CurrentCharge($IdComp){

	// get current price for click and view
	global $conn;
	/*
	$Query = "SELECT `ViewPrice`,`ClickPrice` FROM `bannerplans` WHERE 
			curdate() >= `planStart` and curdate() <= `planEnd` and `IdBanPlan`='".$IdComp."';";
	*/
	$Query = "SELECT sum(`Cost`) as Cost FROM `banner` WHERE  `IdComp`='".$IdComp."';";	
		$Recordset = mysqli_query($conn,$Query ) ;	
		$TotalRecords = mysqli_num_rows($Recordset);
		if ($TotalRecords>0){
			$Rows = mysqli_fetch_assoc($Recordset);
			
			$Cost = $Rows['Cost'];
			return round($Cost,2).'';
		}
		else{
			return 0;
		}//end if


}//end function

function ViewMade($IdComp){
global $conn;
	$ViewQuery = "SELECT SUM(`ViewMade`) AS CampView FROM `banner` WHERE
					`IdComp`= '".$IdComp."';";

		$ViewRecordset = mysqli_query($conn,$ViewQuery ) ;	
		$ViewTotalRecords = mysqli_num_rows($ViewRecordset);
		if ($ViewRecordset>0){
			$ViewRows = mysqli_fetch_assoc($ViewRecordset);
			return $ViewRows['CampView'];
		}
		else{
			return " 0 ";
		}//end if

}//end function

function ClicksMade($IdComp){
global $conn;
	$ClicksQuery = "SELECT sum(`ClicksMade`) as ClicksMade FROM `banner` WHERE 
				`IdBanner`='".$IdComp."';";

		$ClicksRecordset = mysqli_query($conn,$ClicksQuery ) ;	
		$ClicksTotalRecords = mysqli_num_rows($ClicksRecordset);
		if ($ClicksRecordset>0){
			$ClicksRows = mysqli_fetch_assoc($ClicksRecordset);
			return $ClicksRows['ClicksMade'];
		}
		else{
			return 0;
		}//end if


}//end function

?>