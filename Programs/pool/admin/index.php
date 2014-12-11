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
global $ThemeName,$Lang ;

include_once("Blocks/Pool/admin/Languages/lang-".$Lang.".php");

$theList = BlockIconLink("Pool","NewPool"). "<br/>"
		  .BlockIconLink("Pool","ListPool"). "<br/>";
		
if(isset($_GET['subdo'])){
	switch($_GET['subdo']){
		case "NewPool":
			$theContent =  NewPool();
			break;
		case "ListPool":
			$theContent =  ListPool();
			break;
		case "DelPool":
			$theContent =  DelPool();
			break;
		case "EditPool":
			$theContent =  EditPool();
			break;
		case "WhatUserPool":
			$theContent =  WhatUserPool();
			break;
                default :
			$theContent =  ListPool();
	}//end switch
}
else{
	$theContent =  ListPool();
}//end if

$Pool = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$Pool = VarTheme("{todoImg}", "pool.jpg",$Pool );
$Pool = VarTheme("{ThemeName}", $ThemeName,$Pool );
$Pool = VarTheme("{List}", $theList,$Pool );
$Pool = VarTheme("{Content}", $theContent,$Pool );
echo   $Pool;

function NewPool(){
	global $TotalRecords,$Rows ,$Recordset,$Lang,$CustomHead,$ThemeName,$Lang ;
	if(isset($_POST['SaveNewPool'])){
		//calculate number of choises
		for($p=0;$p<4;$p++){
			if($_POST['Choise'.$Lang.'idpc'.$p]!=""){
				$NumberOfChoises = $p;
			}
		}//end for
		
		//save new pool
		$Idpt		 = GenerateID('pooltitle','Idpt');
		$Mustidpc	 = GenerateID('poollangchoices','idpc');
		$poolstart   = PostFilter($_POST['poolstart']);
		$poolend     = PostFilter($_POST['poolend']);
		$multichoice = PostFilter($_POST['multichoice']);
		$published 	 = PostFilter($_POST['published']);
		$lastpol 	 = '1';
		//update last pool to zero to all old pools
		mysqli_query($conn,"update `pooltitle` set `lastpol`='0' where `lastpol`='1';");
		//insert new last pool
		mysqli_query($conn,"INSERT INTO `pooltitle` ( `Idpt` , `poolstart` , `poolend` , `multichoice` , `published` , `lastpol` )
					VALUES ('".$Idpt."', '".$poolstart."', '".$poolend."', '".$multichoice."', '".$published."', '".$lastpol."');");
		if(isset($_POST['cheked'])){
			$cheked		 = $_POST['cheked'];
		}
		else{
			$cheked		 ="";
		}//end if
		//cheked choise
		for($j=0;$j<=$NumberOfChoises;$j++){
			$idpc	=	$Mustidpc+$j;
			if($cheked==$j){
				mysqli_query($conn,"INSERT INTO `poolchoices` (`idpc`, `idpt`, `cheked`)
							VALUES ('".$idpc."', '".$Idpt."', '1');");
			}	
			else{
				mysqli_query($conn,"INSERT INTO `poolchoices` (`idpc`, `idpt`, `cheked`)
							VALUES ('".$idpc."', '".$Idpt."', '0');");
			}
		}//end for
		
		$query = "select * from `languages`";
		ExcuteQuery($query);
		if($TotalRecords > 0 ){
			for($i=0;$i<$TotalRecords;$i++){
				$LangName	= $Rows['LangName'];
				$IdLang		= $Rows['IdLang'];
				//TITLE
				$Title = $_POST[$LangName.'Title'];
				mysqli_query($conn,"INSERT INTO `poollangtitles` (`IdLang`, `Idpt`, `Title`) 
							VALUES ('".$IdLang."', '".$Idpt."', '".$Title."');");
				for($k=0;$k<=$NumberOfChoises;$k++){
					//Choises
					$idpc		= $Mustidpc+$k;
					$Choise 	= $_POST['Choise'.$LangName.'idpc'.$k];
					mysqli_query($conn,"INSERT INTO `poollangchoices` (`IdLang`, `idpc`, `Idpt`, `Choise`) 
								VALUES ('".$IdLang."', '".$idpc."', '".$Idpt."', '".$Choise."');");
				}//END FOR
				$Rows = mysqli_fetch_assoc($Recordset);
			}
		}//END IF
		$NewPool =  (SuccessInsertNewPoll).' '.$_POST[$Lang.'Title'];;
	}
	else{
		//SHOW NEW Pool Form
		$CustomHead .= '<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
					<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
					<script type="text/javascript" src="includes/jscalendar/Languages/calendar-'.$Lang.'.js"></script>
					<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>';
		$CustomHead .= '<script src="Blocks/Ads/Themes/'.$ThemeName.'/SpryValidationTextField.js" type="text/javascript"></script>
					  <link href="Blocks/Ads/Themes/'.$ThemeName.'/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		$NewPool = '<script src="Blocks/Pool/SpryValidationTextField.js" type="text/javascript"></script>
					<link href="Blocks/Pool/SpryValidationTextField.css" rel="stylesheet" type="text/css">
					<form id="formNewPool" name="formNewPool" method="post" action="">
					'. (PoolInterval).' , '. (From).' : 
					  <span id="sprytextfield1">
					  <input class="text" type="text" name="poolstart" id="poolstart" />
					  <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>'. (To).' : 
					  <span id="sprytextfield2">
					  <input class="text" type="text" name="poolend" id="poolend" />
					  <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
					  <br/>
					    '. (ReadyToPublish).' ?  
					      <select class="select" name="published" id="published">
					        <option value="1" selected="selected">'. (yes).'</option>
					        <option value="0">'. (no).'</option>
					  </select><br/>
					    '. (MultiChoises).' ? 
					    <select class="select" name="multichoice" id="multichoice">
					      <option value="1">'. (yes).'</option>
					      <option value="0" selected="selected">'. (no).'</option>
					    </select>
					    <br/>
						'. (PoolTitle).' : 
						<table border="0" cellspacing="1" cellpadding="0">
					  <tr>';
		$query = "select * from `languages`";
		ExcuteQuery($query);
		if($TotalRecords > 0 ){
			for($i=0;$i<$TotalRecords;$i++){
				$LangName	= $Rows['LangName'];
				$Langs[] 	= $LangName;
				$NewPool 	.='<td align="center">'. (Language).' '.$LangName.'</td>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
		$NbrOfspry=3;
		$NewPool .= '<tr>';
		for($i=0;$i<$TotalRecords;$i++){
			$NewPool .= '  <td><span id="sprytextfield'.($i+3).'">
					      <label>
					      <input class="text" type="text" name="'.$Langs[$i].'Title" id="'.$Langs[$i].'Title">
					      </label>
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>';
			$NbrOfspry++;
		}//end for
		$NewPool .= '</tr></tr></table>';
		
		$NewPool .= '<table border="0" cellspacing="1" cellpadding="0">
					  <tr>
					    <td>&nbsp;</td>
					    <td>'. (IsDefault).'</td>';
		for($i=0;$i<$TotalRecords;$i++){
			$NewPool .='<td align="center">'. (Language).' '.$Langs[$i].'</td>';
		}//end for
		$NewPool .=  '</tr>';
		for($k=0;$k<4;$k++){
			$NewPool .=	'<td>'. (Choise).' '.$k.' </td>
					    <td align="center">
					      <input type="radio" name="cheked" id="cheked" value="'.$k.'"></td>';
			$query = "select * from `languages`";
			ExcuteQuery($query);
			if($TotalRecords > 0 ){
				for($j=0;$j<$TotalRecords;$j++){	
					$LangName	= $Rows['LangName'];
					$NewPool .=	'<td><span id="sprytextfield'.($i+$NbrOfspry).'">
						      <input class="text" type="text" name="Choise'.$LangName.'idpc'.$k.'" id="Choise'.$LangName.'idpc'.$k.'">
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
							  </td>';
					$NbrOfspry++;
				$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
			}//end if
			$NewPool .= '</tr>';
		}//end for
		
		$NewPool .= '</table>
					<input name="SaveNewPool" type="submit" value="'. (save).'">
						</form>
						<script type="text/javascript">
						<!--
						';
		for($i=0;$i<$NbrOfspry-2;$i++){
			$NewPool .=	'var sprytextfield'.$i.' = new Spry.Widget.ValidationTextField("sprytextfield'.$i.'");';
		}//end for				
		$NewPool .=	'//-->\n
						</script>
					<script type="text/javascript">
					function catcalc(cal) {
							 var date = cal.date;
							var time = date.getTime();
					}
					Calendar.setup({
					inputField     :    "poolstart",   // id of the input field
					ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
					showsTime      :    true,
					timeFormat     :    "24",
					onUpdate       :    catcalc
					});
					Calendar.setup({
					inputField     :    "poolend",   // id of the input field
					ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
					showsTime      :    true,
					timeFormat     :    "24",
					onUpdate       :    catcalc
					});
					</script>';
	}
	return $NewPool;
}//end function

function EditPool(){
	global $TotalRecords,$Rows ,$Recordset,$Lang,$CustomHead,$ThemeName,$Lang,$conn ;
	
	$Idpt = InputFilter($_GET['Idpt']);
	
	if(isset($_POST['SaveEditPool'])){
	//save edit pool 
	//calculate number of choises
		for($p=0;$p<4;$p++){
			if(isset($_POST['Choise'.$Lang.'idpc'.$p])){
				if($_POST['Choise'.$Lang.'idpc'.$p]!=""){
					$NumberOfChoises = $p;
				}//end if
			}//end if
		}//end for
		
		//save EDIT pool
		$poolstart   = PostFilter($_POST['poolstart']);
		$poolend     = PostFilter($_POST['poolend']);
		$multichoice = PostFilter($_POST['multichoice']);
		$published 	 = PostFilter($_POST['published']);
		
		//insert EDIT last pool
		mysqli_query($conn,"UPDATE`pooltitle` 
					SET `poolstart`='".$poolstart."', 
						`poolend`='".$poolend."',
						`multichoice`='".$multichoice."',
						`published`='".$published."'
					WHERE `Idpt`='".$Idpt."';");
		$cheked		 = $_POST['cheked'];
		
		$query = "select `idpc` from `poolchoices` where `Idpt`='".$Idpt."' order by `idpc`;";
		ExcuteQuery($query);
		if($TotalRecords > 0 ){
				$Mustidpc	= $Rows['idpc'];
		}//end if
		
		//cheked choise
		for($j=0;$j<=$NumberOfChoises;$j++){
			$idpc	=	$Mustidpc+$j;
			//echo $idpc ;
			if($cheked==$j){
				mysqli_query($conn,"UPDATE `poolchoices`
							SET `cheked`='1'
							WHERE `idpc`='".$idpc."' AND `Idpt`='".$Idpt."';") ;	
			}	
			else{
				mysqli_query($conn,"UPDATE `poolchoices`
							SET `cheked`='0'
							WHERE `idpc`='".$idpc."' AND `Idpt`='".$Idpt."';") ;	
			}
		}//end for
		
		$query = "select * from `languages`";
		ExcuteQuery($query);
		if($TotalRecords > 0 ){
			for($i=0;$i<$TotalRecords;$i++){
				$LangName	= $Rows['LangName'];
				$IdLang		= $Rows['IdLang'];
				//TITLE
				$Title = $_POST[$LangName.'Title'];
				mysqli_query($conn,"UPDATE `poollangtitles`
							SET `Title`='".$Title."'
							WHERE `IdLang`='".$IdLang."' AND `Idpt`='".$Idpt."';");
				for($k=0;$k<=$NumberOfChoises;$k++){
					//Choises
					$idpc		= $Mustidpc+$k;
					$Choise 	= $_POST['Choise'.$LangName.'idpc'.$k];
					mysqli_query($conn,"UPDATE `poollangchoices`
								SET `Choise`='".$Choise."'
								WHERE `IdLang`='".$IdLang."' AND `idpc`='".$idpc."' AND `Idpt`='".$Idpt."'") ;	
				}//END FOR
				$Rows = mysqli_fetch_assoc($Recordset);
			}//END FOR
		}//END IF
		$EditPool =  (SuccessUpdateNewPoll).' '.$_POST[$Lang.'Title'];
	}
	else{
	// shwo edit form
		$CustomHead .= '<link rel="stylesheet" type="text/css" media="all" href="includes/jscalendar/Style/calendar-Default.css" />
					<script type="text/javascript" src="includes/jscalendar/calendar.js"></script>
					<script type="text/javascript" src="includes/jscalendar/Languages/calendar-'.$Lang.'.js"></script>
					<script type="text/javascript" src="includes/jscalendar/calendar-setup.js"></script>';
		$CustomHead .= '<script src="Blocks/Ads/Themes/'.$ThemeName.'/SpryValidationTextField.js" type="text/javascript"></script>
					  <link href="Blocks/Ads/Themes/'.$ThemeName.'/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		ExcuteQuery("select * from `pooltitle` where `Idpt`='".$Idpt."';");
		if($TotalRecords >0){
			$poolstart	= $Rows['poolstart'];
			$poolend		= $Rows['poolend'];
			$multichoice = $Rows['multichoice'];
			$published	= $Rows['published'];
			
			if($multichoice =='1'){
				$selmultichoice = '<option value="1" selected="selected">'. (yes).'</option>
								<option value="0">'. (no).'</option>';
			}
			else{
				$selmultichoice ='<option value="1">'. (yes).'</option>
								<option value="0" selected="selected">'. (no).'</option>';
			}//end if
			if($published =='1'){
				$selpublished = '<option value="1" selected="selected">'. (yes).'</option>
								<option value="0">'. (no).'</option>';
			}
			else{
				$selpublished ='<option value="1">'. (yes).'</option>
								<option value="0" selected="selected">'. (no).'</option>';
			}//end if
		}
		$EditPool = '<script src="Blocks/Pool/SpryValidationTextField.js" type="text/javascript"></script>
					<link href="Blocks/Pool/SpryValidationTextField.css" rel="stylesheet" type="text/css">
					<form id="formEditPool" name="formEditPool" method="post" action="">
					'. (PoolInterval).' , '. (From).' : 
					  <span id="sprytextfield1">
					  <input class="text" type="text" name="poolstart" id="poolstart" value="'.$poolstart.'" />
					  <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>'. (To).' : 
					  <span id="sprytextfield2">
					  <input class="text" type="text" name="poolend" id="poolend" value="'.$poolend.'" />
					  <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
					  <br/>
					    '. (ReadyToPublish).' ?  
					      <select class="select" name="published" id="published">
					        '.$selpublished.'
						</select><br/>
					    '. (MultiChoises).' ? 
					    <select class="select" name="multichoice" id="multichoice">
						'.$selmultichoice.'
					    </select>
					    <br/>
						'. (PoolTitle).' : 
						<table border="0" cellspacing="1" cellpadding="0">
					  <tr>';
		$query = "select * from `languages`";
		ExcuteQuery($query);
		if($TotalRecords > 0 ){
			for($i=0;$i<$TotalRecords;$i++){
				$IdLang		= $Rows['IdLang'];
				$LangName	= $Rows['LangName'];
				$IdLangs[] 	= $IdLang;
				$Langs[] 	= $LangName;
				$EditPool 	.='<td align="center">'. (Language).' '.$LangName.'</td>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
		$NbrOfspry=3;
		$EditPool .= '<tr>';
		$NbrOfLangs =  $TotalRecords;
		for($i=0;$i<$NbrOfLangs;$i++){
			$query = "select * from `poollangtitles` 
						where `IdLang`='".$IdLangs[$i]."' and `Idpt`='".$Idpt."';";
			ExcuteQuery($query);
			if($TotalRecords > 0 ){
				$Title = $Rows['Title'];
			}//end if
			$EditPool .= '  <td><span id="sprytextfield'.($i+3).'">
					      <label>
					      <input value="'.$Title.'" class="text" type="text" name="'.$Langs[$i].'Title" id="'.$Langs[$i].'Title">
					      </label>
					      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>';
			$NbrOfspry++;
		}//end for
		$EditPool .= '</tr></tr></table>';
		
		$EditPool .= '<table border="0" cellspacing="1" cellpadding="0">
					  <tr>
					    <td>&nbsp;</td>
					    <td>'. (IsDefault).'</td>';
		for($i=0;$i<$TotalRecords;$i++){
			$EditPool .='<td align="center">'. (Language).' '.$Langs[$i].'</td>';
		}//end for
		$EditPool .=  '</tr>';
		
		//get cheked values
		$query = "select `cheked` from `poolchoices` where `idpt`='".$Idpt."' order by `idpc`;";
		ExcuteQuery($query);
		if($TotalRecords > 0 ){
			for($j=0;$j<$TotalRecords;$j++){	
				$cheked[$j]	= $Rows['cheked'];
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
		$NmbrOfCheked = $TotalRecords;
		for($k=0;$k<$NmbrOfCheked;$k++){
			if($cheked[$k]<>'1'){
				$EditPool .=	'<td>'. (Choise).' '.$k.' </td>
					    <td align="center">
					      <input type="radio" name="cheked" id="cheked" value="'.$k.'"></td>';
			}
			else{
				$EditPool .=	'<td>'. (Choise).' '.$k.' </td>
					    <td align="center">
					      <input checked="checked" type="radio" name="cheked" id="cheked" value="'.$k.'"></td>';			
			}//end if
			//get idpc
			
			$query = "select DISTINCT(`idpc`) AS IDPC from `poollangchoices` 
							where `Idpt`='".$Idpt."' and `IdLang`='".$IdLang."' order by `idpc`;";
			ExcuteQuery($query);
			if($TotalRecords > 0 ){
				for($j=0;$j<$TotalRecords;$j++){
					$IDPC[$j]	= $Rows['IDPC'];
					$Rows = mysqli_fetch_assoc($Recordset);
				}//END FOR
			}//END IF
			
			$query = "select * from `languages`";
			ExcuteQuery($query);
			if($TotalRecords > 0 ){
				for($j=0;$j<$TotalRecords;$j++){
					$LangName	= $Rows['LangName'];
					$IdLang	= $Rows['IdLang'];
					$Q = "select `Choise` from `poollangchoices` 
							where `Idpt`='".$Idpt."' and `IdLang`='".$IdLang."' 
							and `idpc`='".$IDPC[$k]."' order by `idpc`;";
					$RS = mysqli_query( $conn,$Q)  ;	
					$Totals = mysqli_num_rows($RS);
					if ($Totals>0){
						$DATA = mysqli_fetch_assoc($RS);
						$Choise = $DATA['Choise'];
					}//end if
					
					$EditPool .='<td><span id="sprytextfield'.($i+$NbrOfspry).'">
						      <input value="'.$Choise.'" class="text" type="text" 
							  name="Choise'.$LangName.'idpc'.$k.'" id="Choise'.$LangName.'idpc'.$k.'">
						      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
							  </td>';
					$NbrOfspry++;
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
			}//end if
			$EditPool .= '</tr>';
		}//end for
		
		$EditPool .= '</table>
					<input name="SaveEditPool" type="submit" value="'. (save).'">
						</form>
						<script type="text/javascript">
						<!--
						';
		for($i=0;$i<$NbrOfspry-2;$i++){
			$EditPool .=	'var sprytextfield'.$i.' = new Spry.Widget.ValidationTextField("sprytextfield'.$i.'");';
		}//end for				
		$EditPool .=	'//-->\n
						</script>
					<script type="text/javascript">
					function catcalc(cal) {
							 var date = cal.date;
							var time = date.getTime();
					}
					Calendar.setup({
					inputField     :    "poolstart",   // id of the input field
					ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
					showsTime      :    true,
					timeFormat     :    "24",
					onUpdate       :    catcalc
					});
					Calendar.setup({
					inputField     :    "poolend",   // id of the input field
					ifFormat       :    "%Y-%m-%d %H:%M:%S",       // format of the input field
					showsTime      :    true,
					timeFormat     :    "24",
					onUpdate       :    catcalc
					});
					</script>';
	}
	return $EditPool;
}//end function

function ListPool(){

	global $TotalRecords,$Rows ,$Recordset,$Lang,$CustomHead,$ThemeName,$Lang,$conn ;

        $ListPool ='';
        
	$query = "select * from `languages` where `LangName`='".$Lang."';";
	ExcuteQuery($query);
	if($TotalRecords > 0 ){

		for($i=0;$i<$TotalRecords;$i++){
			$LangName	= $Rows['LangName'];
			$IdLang		= $Rows['IdLang'];
			$q = "SELECT * FROM `poollangtitles` ,`pooltitle`
					WHERE `IdLang`='".$IdLang."'
					and `pooltitle`.`Idpt`=`poollangtitles`.`Idpt`
					and `Deleted`<>'1';";
			$RS = mysqli_query( $conn,$q)  ;	
			$Totals = mysqli_num_rows($RS);
			if ($Totals>0){
                            	$ListPool .= '<table border="0" cellspacing="2" cellpadding="2">
				  <tr>
				    <td style="border-bottom:dotted; border-bottom-width:thin">'. (PoolTitle).'</td>
				    <td style="border-bottom:dotted; border-bottom-width:thin">&nbsp;</td>
				    <td style="border-bottom:dotted; border-bottom-width:thin">&nbsp;</td>
				    <td style="border-bottom:dotted; border-bottom-width:thin">&nbsp;</td>
				  </tr>';
				while($DATA = mysqli_fetch_assoc($RS)){
					$Title = $DATA['Title'];
					$Idpt = $DATA['Idpt'];
					$Vars = array("block","subdo","Idpt");
					$Vals = array("Pool","EditPool",$Idpt);
					$edit = '<a href="'. AdminCreateLink('',$Vars,$Vals)
							.'" title="">'. (edit).'</a>' ;
					$Vars = array("block","subdo","Idpt");
					$Vals = array("Pool","DelPool",$Idpt);
					$delete = '<a href="'. AdminCreateLink('',$Vars,$Vals)
							.'" title="" onclick="return acceptDel();">'. (delete).'</a>' ;
					$Vars = array("block","subdo","Idpt");
					$Vals = array("Pool","WhatUserPool",$Idpt);
					$WhatUserPool ='<a href="'. AdminCreateLink('',$Vars,$Vals)
							.'" title="">'. (WhatUserPool).'</a>' ;
					$ListPool .= '  <tr>
								    <td style="border-bottom:dotted; border-bottom-width:thin">'
									.$Title.'</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin">'
									.$edit.'</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin">'
									.$delete.'</td>
								    <td style="border-bottom:dotted; border-bottom-width:thin">'
									.$WhatUserPool.'</td>
									</tr>';
				}//end while
			}//end if
		}//END for
		$ListPool .= '</table><script language="javascript" type="text/javascript">
					function acceptDel(){
						return confirm("'. (DidUwantToDeletePOOL).'");
					}
					</script> ';
	}//end if
	return $ListPool;
}//end function

function DelPool(){
	global $TotalRecords,$Rows ,$Recordset,$Lang,$CustomHead,$ThemeName,$Lang,$conn ;
	$Idpt = InputFilter($_GET['Idpt']);
	
	mysqli_query($conn,"update `pooltitle` set `Deleted`='1' where `Idpt`='".$Idpt ."'; ");
	return  (SuccessDeletePool);
	
}//end function

function WhatUserPool(){
	global $TotalRecords,$Lang,$Rows;
	if(!isset($_POST['SubmitPoolNickname'])){
		$WhatUserPool =  (WhatUserPool) .'<br/>
		<form name="formNickame" method="post" action="">
		  '. (NickName).'
		    <input class="text" type="text" name="PoolNickname">
			<input class="submit" type="submit" name="SubmitPoolNickname" value="'. (submit).'">
			</form>';
	}
	else{
		$PoolNickname = PostFilter($_POST['PoolNickname']);
		// cheking if this user exist
		ExcuteQuery("select * from `users` where `NickName`='".$PoolNickname."';");
		if($TotalRecords>0){
			$UserId = $Rows['UserId'];
			$Idpt 	= InputFilter($_GET['Idpt']);
			ExcuteQuery("select * from `languages` where `LangName`='".$Lang."';");
			$IdLang = $Rows['IdLang'];
			//getiing pool title
			ExcuteQuery("select * from `poollangtitles` where `IdLang`='".$IdLang."' and `Idpt`='".$Idpt ."';");
			if($TotalRecords>0){
				$Title = $Rows['Title'];
				ExcuteQuery("select * from `poolusers` where `UserId`='".$UserId."' and `Idpt`='".$Idpt."' ;");
				if($TotalRecords>0){
					$idpc 		= $Rows['idpc'];
					$Comment 	= $Rows['Comment'];
					// getting voite options
					ExcuteQuery("select * from `poollangchoices` where `Idpt`='".$Idpt."' and `idpc`='".$idpc."' and `IdLang`='".$IdLang."' ;");
					if($TotalRecords>0){
						$Choise = $Rows['Choise'];
						$WhatUserPool = '<strong>'.$Title .'<strong><br/>'.$Choise ."<br/>".$Comment ;
					}//end if
				}
				else{
					// this user does not have vote
					$WhatUserPool =  (ThisUserDoesNotPool);
				}//end if
				
			}//end if
		}
		else{
			//this user not found
			$WhatUserPool =  (ThisNickNameNotExist);
		}//end if
		//$WhatUserPool = $PoolNickname;
		
	}//end if
return 	$WhatUserPool;
}//end function




?>