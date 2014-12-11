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

if(isset($_POST['PermProgSubmit']) or isset($_POST['SaveProgPerm'])){
	if(isset($_POST['SaveProgPerm'])){
		//save permisions
		$programspermisions = SavePermList();
	}
	else{
		//show permisions form
		$programspermisions = ShowPermList();
	}//end if
}
else{
	//show list of programs to select one
	$programspermisions = ShowProgList();
}//end if

function SavePermList(){
	global $TotalRecords,$Recordset,$Rows,$SqlType,$conn ;
	$IdProgram = $_POST['IdProgram'];
	ExcuteQuery("SELECT * FROM `programs` where `IdProgram`='".$IdProgram."' ;");
	if ($TotalRecords>0){
		$ObjectId = $Rows['ObjectId'];
	}//end if
	
	
	$Permission = $_POST['Permission'];
	//UPDATE permission of  table programs
	$query = "UPDATE `programs` SET `Permission` = '".$Permission."' WHERE `IdProgram`='".$ObjectId ."' ";
	if ($SqlType=="MySql"){
		$Rs = mysqli_query( $conn,$query) ;	
	}//end if
	
	//first step we well delete all Old permisions
	$query = "delete from `moderators` where `ObjectId`='".$ObjectId."'; ";
	if ($SqlType=="MySql"){
		$Rs = mysqli_query( $conn,$query) ;	
	}//end if
	
	//insert new permisions
	ExcuteQuery("SELECT * FROM `groups`;");
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			$GroupId = $Rows['GroupId'];
			if(isset($_POST[$GroupId])){
				//echo $GroupId .' '. $_POST[$GroupId] ."<br/>";
				//echo 'GroupId : '.$GroupId .' ObjectId: '. $ObjectId . ' '.$_POST[$GroupId]. '</br>';
				$query = "INSERT INTO `moderators` (`GroupId`, `ObjectId`, `Permission`) 
							VALUES ('".$GroupId."', '".$ObjectId."', '".$_POST[$GroupId]."');";
				if ($SqlType="MySql"){
				
					$Rs = mysqli_query( $conn,$query) ;	
				}//end if
			}//end if
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if
	
	return  (WeHaveSavePermissionForTheProgram);
	
}//end function

function ShowPermList(){
	global $TotalRecords,$Recordset,$Rows,$SqlType,$conn,$Lang ;
	
	$IdProgram = PostFilter($_POST['ProgramName']);
	ExcuteQuery("SELECT * FROM `programs` where `IdProgram`='".$IdProgram."';");
	if ($TotalRecords>0){
		$ProgramName = $Rows['ProgramName'];
		$IdProgram = $Rows['IdProgram'];
		$Permission =$Rows['Permission'];
	}//end if
	if($Permission=="1"){
		$Option ='<option selected="selected" value="1">'. yes.'</option>
			 <option value="0">'. no.'</option>';
	}
	else{
		$Option ='<option value="1">'. yes.'</option>
			 <option selected="selected" value="0">'. no.'</option>';
	}
        include_once('Programs/'.$ProgramName.'/admin/Languages/lang-'.$Lang.'.php');

        if(!constantDefined($ProgramName)){
            $ProgramName = $ProgramName;
        }
        else{
            $ProgramName = constant($ProgramName);
        }
        
	$ShowPermList = '<form name="FormPerm" action="" method="post">
					<input type="hidden" name="IdProgram" id="IdProgram" value="'.$IdProgram.'">
					<table border="0" cellspacing="2" cellpadding="1">
					  <tr>
					    <td><strong>'.$ProgramName.'</strong></td>
					    <td><strong>'. GroupCanAccess.'</strong></td>
					  </tr>
					  <tr>
					    <td style="border-bottom:dotted; border-bottom-width:thin">'.OtherUsers.'</td>
					    <td style="border-bottom:dotted; border-bottom-width:thin">
					      <select class="select" name="Permission" id="Permission">
						'.$Option.'
					      </select>
					    </td>
					  </tr>';
	ExcuteQuery("SELECT * FROM `groups`;");
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			$GroupId = $Rows['GroupId'];
			$GroupName = $Rows['GroupName'];
			$qry = "select `Permission` from `moderators` where `GroupId`='".$GroupId."' 
					and `ObjectId`='".$IdProgram."';";
			if ($SqlType=="MySql"){
				$Rs = mysqli_query($conn,$qry)  ;
				$Totals = mysqli_num_rows($Rs);
				$data = mysqli_fetch_assoc($Rs);	
				if($Totals>0){
					$Permission = $data['Permission'];
				}
				else{
					$Permission = "0";
				}//end if
			}//end if
			if($Permission=="1"){
				$option = '<option selected="selected" value="1">'. (yes).'</option>
						<option value="0">'. (no).'</option>';
			}
			else{
				$option = '<option value="1">'. (yes).'</option>
						<option selected="selected" value="0">'. (no).'</option>';
			}//end if

			$ShowPermList .= '<td style="border-bottom:dotted; border-bottom-width:thin">'.$GroupName.'</td>
						    <td style="border-bottom:dotted; border-bottom-width:thin">
							<select class="select" name="'.$GroupId.'" id="'.$GroupId.'">
							'.$option .'
						    </select></td>
						  </tr>';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//END IF
	$ShowPermList .='</table><br/><input class="submit" type="submit" name="SaveProgPerm" id="SaveProgPerm" value="'. (save).'"></form><br/>';
	return $ShowPermList;

}//end function

function ShowProgList(){
	global $Lang,$TotalRecords,$Recordset,$Rows,$SqlType,$conn ;
	$programspermisions  = PleaseSelectProgToAddPerm.
							'<br/><form id="form1" name="form1" method="post" action="">
							<select class="select" name="ProgramName" id="ProgramName">';
	$Options="";
	ExcuteQuery("SELECT * FROM `programs` WHERE `Deleted`<>'1';");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$ProgramName = $Rows['ProgramName'];
                                if(is_file('Programs/'.$ProgramName.'/admin/Languages/lang-'.$Lang.'.php')){
                                    include_once('Programs/'.$ProgramName.'/admin/Languages/lang-'.$Lang.'.php');

                                }
                                //var_dump(constantDefined($ProgramName));
                                if(constantDefined($ProgramName)){
                                    $ProgramName = constant($ProgramName);
                                }
                                $IdProgram = $Rows['IdProgram'];
				$Options .= '<option value="'.$IdProgram.'">'.$ProgramName.'</option>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
	 $programspermisions .= $Options.' <input class="submit" type="submit" name="PermProgSubmit" id="PermProgSubmit" value="'. submit.'" /></select></form>';   	
	return $programspermisions;
	
}//end function

?>