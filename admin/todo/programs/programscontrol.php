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

if(isset($_GET['subdo'])){
    $programscontrol  = editKey();
}
else{
    if(isset($_POST['SubmitProgCtrl'])){
            $programscontrol  = SaveProgramControl();
            //$programscontrol .= ShowProgramControlForm();
    }
    else{
            $programscontrol  = ShowProgramControlForm();
    }//end if
}

function editKey(){

    $Object = InputFilter($_GET['Object']);
    $dbeditKeySQL = new db();

    if(isset($_POST['SaveKey'])) {
        $editKeySQL = $dbeditKeySQL->get_row(" UPDATE `programs` SET `License`='".PostFilter($_POST['License'])."' where `ProgramName`='".$Object."' ; ");
        $editKey =YourSupportKeyHasBeenSaved;
    }
    else {
        $editKeySQL = $dbeditKeySQL->get_row(" select `License` from `programs` where `ProgramName`='".$Object."' ; ");
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

function SaveProgramControl(){

	global $TotalRecords,$Recordset,$Rows,$SqlType,$conn ;
	ExcuteQuery("SELECT * FROM `programs`;");
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			$IdProgram = $Rows['IdProgram'];
			$ProgramName = $Rows['ProgramName'];
			$ViewTopCont = $Rows['ViewTopCont'];
			$ViewMarqueeCont = $Rows['ViewMarqueeCont'];
			$ViewMenuCont = $Rows['ViewMenuCont'];
			$ViewMainCont = $Rows['ViewMainCont'];
			$ViewSecCont = $Rows['ViewSecCont'];
			$ViewFootCont = $Rows['ViewFootCont'];
			$ViewProgCont = $Rows['ViewProgCont'];
			$Deleted = $Rows['Deleted'];
			
			if(isset($_POST['Deleted'.$IdProgram])){
				$Deleted = $_POST['Deleted'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewProgCont'.$IdProgram])){
				$ViewProgCont = $_POST['ViewProgCont'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewFootCont'.$IdProgram])){
				$ViewFootCont = $_POST['ViewFootCont'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewSecCont'.$IdProgram])){
				$ViewSecCont = $_POST['ViewSecCont'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewMainCont'.$IdProgram])){
				$ViewMainCont = $_POST['ViewMainCont'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewMenuCont'.$IdProgram])){
				$ViewMenuCont = $_POST['ViewMenuCont'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewMarqueeCont'.$IdProgram])){
				$ViewMarqueeCont = $_POST['ViewMarqueeCont'.$IdProgram];
			}//end if
			
			if(isset($_POST['ViewTopCont'.$IdProgram])){
				$ViewTopCont = $_POST['ViewTopCont'.$IdProgram];
			}//end if
			

				$query = "UPDATE `programs` SET 
						 `ViewTopCont` = '".$ViewTopCont."',
						 `ViewMarqueeCont` = '".$ViewMarqueeCont."',
						 `ViewMenuCont` = '".$ViewMenuCont."',
						 `ViewMainCont` = '".$ViewMainCont."',
						 `ViewSecCont` = '".$ViewSecCont."',
						 `ViewFootCont` = '".$ViewFootCont."',
						 `ViewProgCont` = '".$ViewProgCont."',
						 `Deleted` = '".$Deleted."'
						  WHERE `IdProgram`='".$IdProgram."'";
				$Rst = mysqli_query($conn,$query) ;// ;

			
		$Rows = mysqli_fetch_assoc($Recordset);	
		}//end for
	}//end if
	//return '<strong>'. ().'</strong><br/><br/>';
        $Vars = array('todo') ;
        $Vals = array('programscontrol');
        $redirectTO = AdminCreateLink('', $Vars, $Vals);
        return adminPrintMessageAndRedirect(ProgramsControl, ProgramsControlHasBeenSaved, $redirectTO);

	
}//end function


function ShowProgramControlForm(){
	global $Lang,$TotalRecords,$Recordset,$Rows, $CustomHead ;

        $CustomHead .=' <script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                                            document.getElementById("SubmitProgCtrl").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>';
	$programscontrol  = '<form action="" method="post">
						<table width="100%" border="0" cellspacing="1" cellpadding="1">
						  <tr >
						    <td nowrap ><strong>'. ProgramName.'</strong></td>
						    <td><strong>'. ViewTopCont.'</strong></td>
						    <td><strong>'. ViewMarqueeCont.'</strong></td>
						    <td><strong>'. ViewMenuCont.'</strong></td>
						    <td><strong>'. ViewMainCont.'</strong></td>
						    <td><strong>'. ViewSecCont.'</strong></td>
						    <td><strong>'. ViewFootCont.'</strong></td>
						    <td><strong>'. ViewProgCont.'</strong></td>
						    <td><strong>'. delete.'</strong></td>
                                                    <td><strong>'. License .'</strong></td>
						  </tr>';

	ExcuteQuery("SELECT * FROM `programs` where `Deleted`!='1' ;");
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			$IdProgram = $Rows['IdProgram'];
			$ProgramName = $Rows['ProgramName'];
			$ViewTopCont = $Rows['ViewTopCont'];
			$ViewMarqueeCont = $Rows['ViewMarqueeCont'];
			$ViewMenuCont = $Rows['ViewMenuCont'];
			$ViewMainCont = $Rows['ViewMainCont'];
			$ViewSecCont = $Rows['ViewSecCont'];
			$ViewFootCont = $Rows['ViewFootCont'];
			$ViewProgCont = $Rows['ViewProgCont'];
			$Deleted = $Rows['Deleted'];

                        //include lang file
                        $LangFile = 'Programs/'.$ProgramName.'/admin/Languages/lang-'.$Lang.'.php';
                        if(is_file($LangFile)){
                            include_once($LangFile);
                        }
			
			if($ViewTopCont=="1"){
				$ViewTopCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewTopCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($ViewMarqueeCont=="1"){
				$ViewMarqueeCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewMarqueeCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($ViewMenuCont=="1"){
				$ViewMenuCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewMenuCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($ViewMainCont=="1"){
				$ViewMainCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewMainCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($ViewSecCont=="1"){
				$ViewSecCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewSecCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($ViewFootCont=="1"){
				$ViewFootCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewFootCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($ViewProgCont=="1"){
				$ViewProgCont = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$ViewProgCont = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
			
			if($Deleted=="1"){
				$Deleted = '<option selected value="1">'. (yes).'</option>
				<option value="0">'. (no).'</option>';
			}
			else{
				$Deleted = '<option  value="1">'. (yes).'</option>
				<option selected value="0">'. (no).'</option>';
			}//end if
                        
                        $Edit = '<a href="'. AdminCreateLink('', array('todo','subdo','Object'), array('programscontrol','editKey',$ProgramName)).'" title="'.edit.' " >'.edit.'</a>  ' ;
                        $program_link = AdminCreateLink("", array("prog"), array($ProgramName));

                        if(!constantDefined($ProgramName)){
                            $ProgramName = $ProgramName;
                        }
                        else{
                            $ProgramName = constant($ProgramName);
                        }

			$programscontrol  .='<tr onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'" >
							    <td nowrap style="border-bottom:dotted; border-bottom-width:thin">
                                                            <a href="'.$program_link.'" >'.$ProgramName.'</a></td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="ViewTopCont'.$IdProgram.'" id="ViewTopCont">
								  '.$ViewTopCont.'
							      </select>
							      </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							       <select class="select" name="ViewMarqueeCont'.$IdProgram.'" id="ViewMarqueeCont">
								   '.$ViewMarqueeCont.'
							      </select>
							    </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="ViewMenuCont'.$IdProgram.'" id="ViewMenuCont">
								  '.$ViewMenuCont.'
							      </select>
							    </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="ViewMainCont'.$IdProgram.'" id="ViewMainCont">
								  '.$ViewMainCont.'
							      </select>    
							      </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="ViewSecCont'.$IdProgram.'" id="ViewSecCont">
								  '.$ViewSecCont.'
							      </select>     
							      </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="ViewFootCont'.$IdProgram.'" id="ViewFootCont">
								  '.$ViewFootCont.'
							      </select>         
							      </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="ViewProgCont'.$IdProgram.'" id="ViewProgCont">
								  '.$ViewProgCont.'
							      </select>         
							      </td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">
							      <select class="select" name="Deleted'.$IdProgram.'" id="Deleted">
								  '.$Deleted.'
							      </select>   
							     </td>
                                                             <td  style="border-bottom:dotted; border-bottom-width:thin" > '. $Edit .' </td>
							  </tr>';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if

	$programscontrol  .='</table><div align="center"><br/>
						<input class="submit" name="SubmitProgCtrl" id="SubmitProgCtrl" type="submit" value="'. (save).'">
						</div></form><br/>';
	return 	$programscontrol ;				
}//end function
?>