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
<?php  if (!isset($IsAdmin)){header("location: ../");} ?>
<?php

if(!isset($_GET['deleBlock']) and !isset($_GET['RenameBlock']) and !isset($_GET['subdo'])){
	$blockscontrol = ShowControlBlock();
}//end if

if(isset($_POST['saveBlockControl'])){
	$blockscontrol = SaveControlBlock();
	
}//endif

if(isset($_GET['deleBlock'])){
	global $ThemeName,$TotalRecords,$Rows,$conn,$Recordset,$Lang ;
	$BlockName = $_GET['deleBlock'];
	mysqli_query($conn,"update `blocks` set `Deleted`='1' where `BlockName`='".$BlockName."';");
	$blockscontrol =  (SuccessDeleteBlock);
	//$blockscontrol .= ShowControlBlock();
	$Vars = array('todo');
	$Vals = array('blockscontrol');
	
	$link = AdminCreateLink("",$Vars,$Vals);
	header("Location: $link"); 
}//end if

if(isset($_GET['subdo'])){
	$blockscontrol = editKey();
}//end if

if(isset($_GET['RenameBlock'])){
	$blockscontrol = RenameBlock();
}//end if

function editKey(){

    $Object = InputFilter($_GET['Object']);
    $dbeditKeySQL = new db();

    if(isset($_POST['SaveKey'])) {
        $editKeySQL = $dbeditKeySQL->get_row(" UPDATE `blocks` SET `License`='".PostFilter($_POST['License'])."' where `BlockName`='".$Object."' ; ");
        $editKey =YourSupportKeyHasBeenSaved;
    }
    else {
        $editKeySQL = $dbeditKeySQL->get_row(" select `License` from `blocks` where `BlockName`='".$Object."' ; ");
        if($editKeySQL){
            $License = $editKeySQL->License;
        }
        else{
            $License ='';
        }
        $editKey = '<form method="post" name="editKey">
            <input name="License" id="License" value="'.$License.'" size="100" maxlength="255" class="text" type="text">
            <input value="'.save.'" name="SaveKey" class="submit" type="submit">
        </form>';
    }

    return $editKey;

}

function RenameBlock(){
	
	global $TotalRecords,$Rows,$Recordset,$SqlType,$conn,$CustomHead;

	$BlockName = $_GET['RenameBlock'];
	
		if(!isset($_POST['SaveRenameBlock'])){
			$Query = 'SELECT * FROM `languages` ;' ;
			ExcuteQuery($Query );
			if ($TotalRecords>0){	
				$CustomHead = '<script src="admin/Themes/Default/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
							<link href="admin/Themes/Default/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">';
			
				$RenameBlock ='<form name="form1" method="post" action="">
								<table border="0" cellspacing="2" cellpadding="2">  
								<tr>
								    <td>&nbsp;</td>
								    <td><strong>'.Block.' '.$BlockName.'</strong></td>
								  </tr> ';
				for($i=0;$i<$TotalRecords;$i++){
					$IdLang 	= $Rows['IdLang'];
					$LangName = $Rows['LangName'];
					$LangQuery = "select `BlockTitle` from `blocklang` 
									where `idLang`='".$IdLang."' and `BlockName`='".$BlockName."'  ; ";
									
					$RecordsetLangQuery = mysqli_query($conn,$LangQuery)  ;	
					$TotalRecordsLangQuery = mysqli_num_rows($RecordsetLangQuery);
					if ($TotalRecordsLangQuery>0){
						$RowsLangQuery = mysqli_fetch_assoc($RecordsetLangQuery);
						$BlockTitle = $RowsLangQuery['BlockTitle'];
					}
					else{
						$BlockTitle = "";
					}//end if				
					
					$RenameBlock .= '<tr>
								    <td><strong>'. (BlockTitleIn).' '.$LangName.'</strong></td>
								        <td>
								      <span id="sprytextfield'.$i.'">
								      <label>
								      <input value="'.$BlockTitle.'" type="text" name="'.$BlockName.$LangName.'" id="'.$BlockName.$LangName.'">
								      </label>
								      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
								    </td>
								 </tr>';
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
				$RenameBlock .= ' <tr> <td  colspan="2" style="v">
									<div align="center">
										<input name="SaveRenameBlock" type="submit" value="'. (save).'">
									</div></td>
								</tr>
								</table>
								
								</form>
								<script type="text/javascript">
									<!--';
				for($j=0;$j<$i;$j++){
					$RenameBlock .='
									var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield'.$j.'");';
				}//end for
				$RenameBlock .= '//-->
								</script>';
			}//end if
		}
		else{
			//save edited block name
			//load langs 
			$Query = 'SELECT * FROM `languages` ;' ;
			ExcuteQuery($Query );
			if ($TotalRecords>0){	
				for($i=0;$i<$TotalRecords;$i++){
					$LangName 	= $Rows['LangName'];
					$IdLang 	= $Rows['IdLang'];
					
					if(isset($_POST[$BlockName.$LangName])){
						$BlockTitle = PostFilter($_POST[$BlockName.$LangName]);
                                                $LangQuery  = "DELETE FROM `blocklang`	where `idLang`='".$IdLang."' and `BlockName`='".$BlockName."' ;";
                                                $RecordsetLangQuery = mysqli_query($conn,$LangQuery)  ;
                                                $idblocklang = GenerateID('blocklang', 'idblocklang');
						$LangQuery  = "INSERT INTO `blocklang` (`idblocklang` ,`BlockName` ,`idLang` ,`BlockTitle`)
                                                                                  VALUES ($idblocklang, '".$BlockName."', '".$IdLang."', '".$BlockTitle."')";
						$RecordsetLangQuery = mysqli_query($conn,$LangQuery)  ;	
						//echo $LangName ;
					}//end if
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
			}//end if
			$RenameBlock =  (SuccessSaveBlockTitle) .ShowControlBlock();
		}//end if
		return $RenameBlock;
}//end function

function SaveControlBlock(){

		global $TotalRecords,$Rows,$Recordset,$SqlType,$conn;
		
		$Query = 'SELECT * FROM blocks' ;
		ExcuteQuery($Query );
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$BlockName = $Rows['BlockName'];
				if(isset($_POST['Active'.$BlockName])){
					$Active = $_POST['Active'.$BlockName];
				}//end if
				if(isset($_POST['View'.$BlockName])){
					$View = $_POST['View'.$BlockName];
                                }
                                else{
                                        $View = '1';
				}//end if
				if(isset($_POST['MainSec'.$BlockName])){
					$MainSec = $_POST['MainSec'.$BlockName];
				}//end if
				if(isset($_POST['Order'.$BlockName])){
					$Order = $_POST['Order'.$BlockName];
				}//end if
				$q = "UPDATE `blocks` SET 
					`Active` = '".$Active ."',`View` = '".$View."',`MainSec` = '".$MainSec."',`Order` = '".$Order."' 
					WHERE `BlockName`='".$BlockName."' ";
				//echo $q."<br/>";	

					$Rs = mysqli_query( $conn,$q)  ;	

				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if

	return  (SuccessSaveBlocksControl)."<br/>". ShowControlBlock();

}//end function

function ShowControlBlock(){

	global $Lang,$TotalRecords,$Rows,$Recordset, $CustomHead;
        $CustomHead .='<script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                                            document.getElementById("saveBlockControl").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>';
	$blockscontrol ='<form name="formBlockControl" id="formBlockControl" method="post" target="">
					<table border="0" cellspacing="2" cellpadding="2">
					  <tr >
					    <td><strong>'. BlockName.'</strong></td>
					    <td><strong>'. Active.'</strong></td>
					    <td><strong>'. MainSec.'</strong></td>
					    <td><strong>'. Order.'</strong></td>
                                             <td><strong>'. License .'</strong></td>
					    <td><strong>&nbsp;</strong></td>
					    <td><strong>&nbsp;</strong></td>
                                           
					  </tr>';
					  
	$Query = "SELECT * FROM blocks WHERE `Deleted`<>'1' ORDER BY `blocks`.`MainSec` ASC, `blocks`.`Order` ASC";
	ExcuteQuery($Query );
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			
			$BlockName = $Rows['BlockName'];
                        //include lang file
                        $LangFile = 'Blocks/'.$BlockName.'/admin/Languages/lang-'.$Lang.'.php';
                        if(is_file($LangFile)){
                            include_once($LangFile);
                        }

                        $Active = $Rows['Active'];
			if($Active=="1"){
				$Active ='<option selected="selected" value="1">'. yes.'</option>
							<option value="0">'. no.'</option>' ;
			}
			else{
				$Active ='<option value="1">'. yes.'</option>
				<option selected="selected" value="0">'. (no).'</option>' ;
			}//end if
			
			$View = $Rows['View'];
			if($View=="1"){
				$View ='<option selected="selected" value="1">'. yes.'</option>
				<option value="0">'. no.'</option>' ;
			}
			else{
				$View ='<option value="1">'. yes.'</option>
				<option selected="selected" value="0">'. no.'</option>' ;
			}//end if
			$MainSec = $Rows['MainSec'];
			if($MainSec=="M"){
				$MainSec ='<option selected="selected" value="M">'. main.'</option>
				<option value="S">'. secondary.'</option>' ;
			}
			else{
				$MainSec ='<option value="M">'. main.'</option>
				<option selected="selected" value="S">'. secondary.'</option>' ;
			}//end if
			$Order = $Rows['Order'];
			$OrderTag ="";
			for($j=1;$j<=$TotalRecords;$j++){
				if($Order == $j){
					$OrderTag .= '<option selected="selected" value="'.$j.'">'.$j.'</option>';
				}
				else{
					$OrderTag .= '<option value="'.$j.'">'.$j.'</option>';
				}//end if
			}//end for
			$Vars = array("todo","deleBlock") ; 
			$Vals = array("blockscontrol",$BlockName) ;  
			$DeleteBlock = '<a onclick="return acceptDel();" href="'
							.AdminCreateLink("",$Vars,$Vals).'" title="">'
							. (delete).'</a>' ;
			$Vars = array("todo","RenameBlock") ; 
			$Vals = array("blockscontrol",$BlockName) ; 
			$RenameBlockTitle =  '<a href="'.AdminCreateLink("",$Vars,$Vals).'" title="">'
								. (RenameBlockTitle).'</a>';
                        $Edit = '<a href="'. AdminCreateLink('', array('todo','subdo','Object'), array('blockscontrol','editKey',$BlockName)).'" title="'.edit.' " >'.edit.'</a>  ' ;
                        if(!constantDefined($BlockName)){
                            $NewBlockName = $BlockName;
                        }
                        else{
                            $NewBlockName = constant($BlockName);
                        }
                        $block_link = AdminCreateLink("", array("block"), array($BlockName));
                        
			$blockscontrol .='  <tr  onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'"  >
					    <td style="border-bottom:dotted; border-bottom-width:thin">
                                            <a href="'.$block_link.'" >'.Block.' : '.$NewBlockName.'</a> </td>
					    <td style="border-bottom:dotted; border-bottom-width:thin">
					      <select class="select" name="Active'.$BlockName.'" id="Active'.$BlockName.'">
					        '.$Active.'
					     </select>
					    </td>
					    <td style="border-bottom:dotted; border-bottom-width:thin">
					    <select class="select" name="MainSec'.$BlockName.'" id="MainSec'.$BlockName.'">
						'.$MainSec.'
					    </select>
					    </td>
					    <td style="border-bottom:dotted; border-bottom-width:thin">
					    <select class="select" name="Order'.$BlockName.'" id="Order'.$BlockName.'">
						'.$OrderTag.'
					     </select></td>
                                             <td  style="border-bottom:dotted; border-bottom-width:thin" > | '. $Edit .' </td>
                                                  <td style="border-bottom:dotted; border-bottom-width:thin"> | '
						 .$RenameBlockTitle.' | </td>
						<td style="border-bottom:dotted; border-bottom-width:thin">
						<strong>'.$DeleteBlock.'</strong></td>
						
                                             
					  </tr>';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if				  
					  
	$blockscontrol .='</table><br/>
					<input class="submit" id="saveBlockControl" name="saveBlockControl" type="submit" value="'. save.'">
					</form><br/><script language="javascript" type="text/javascript">
					function acceptDel(){
						return confirm("'. (diduwanttoDeleteBlock).'");
					}
					</script>';
return $blockscontrol;
}//end function

?>