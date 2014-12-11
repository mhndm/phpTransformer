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

if(isset($_POST['SubmitOgjPerm'])){
	$specialpermision   = SaveOgjectPerm();
	$specialpermision  .= ShowObjectsList();
}
else{
	$specialpermision  = ShowObjectsList();
}//end if

function SaveOgjectPerm(){
	global $TotalRecords, $Recordset,$Rows,$SqlType,$conn  ;
	ExcuteQuery("select `ObjectId` from `objects`;");
	if ($TotalRecords>0){
		for($i=0;$i<$TotalRecords;$i++){
			$ObjectId = $Rows['ObjectId'];
			mysqli_query($conn,"delete from `moderators` where `ObjectId`='".$ObjectId ."' ;");

				$query = "SELECT `GroupId` FROM `groups` ; ";
				$rs = mysqli_query( $conn,$Query) ;	
				$ttls = mysqli_num_rows($rs);
				if ($ttls>0){
					for($j=0;$j<$ttls;$j++){
						$Rws	   = mysqli_fetch_assoc($rs);	
						$GroupId   = $Rws['GroupId'];
						if(isset($_POST[$ObjectId.$GroupId])){
							$Permission = PostFilter($_POST[$ObjectId.$GroupId]);
							mysqli_query($conn,"insert into `moderators` (`GroupId`,`ObjectId`,`Permission`)
										values('".$GroupId."','".$ObjectId."','".$Permission."')");
						}//end if
					}//end for
				}//end if

			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if
	return   (PermissionsHasBeenSave);	

}//end function

function ShowObjectsList(){
	global $TotalRecords,$Rows,$Recordset,$SqlType,$conn , $CustomHead ;
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
                                                            document.getElementById("SubmitOgjPerm").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>';
	ExcuteQuery("select * from `groups` ORDER BY `GroupName`;");
	if ($TotalRecords>0){
		$ShowObjectsList = '<form action="" method="post">
							<table border="0" cellspacing="2" cellpadding="2">
								<tr><td>&nbsp;</td>';
		for($i=0;$i<$TotalRecords;$i++){ //group for
			$GroupName = $Rows['GroupName'];
			$ShowObjectsList .= '<td><strong>'.$GroupName .'</strong></td>';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
		$ShowObjectsList .='</tr>';

			$query = "SELECT * FROM `objects` ; ";
			$rs = mysqli_query( $conn,$query) ;	
			$ttls = mysqli_num_rows($rs);
			if ($ttls>0){
				for($j=0;$j<$ttls;$j++){ //objects for
					$rw = mysqli_fetch_assoc($rs);
					$ObjectId   = $rw['ObjectId'];
					$ObjectName = $rw['ObjectName'];
                                        $ConstNameBegin = strpos($ObjectName, "{");
                                        $ConstNameEnd   = strpos($ObjectName, "}");
                                        $ConstName      = trim(substr($ObjectName, $ConstNameBegin+1, $ConstNameBegin+ $ConstNameEnd-1));
                                        if(constant($ConstName)!=''){ //if this constant dont have define
                                           $NewConstName = constant($ConstName);
                                        }
                                        else{
                                            $NewConstName = $ConstName;
                                        }

                                        $ObjectName = VarTheme('{'.$ConstName.'}', $NewConstName,$ObjectName );
					$ShowObjectsList .='<tr  onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
										<td><strong>'.$ObjectName.'</strong></td>';
					//get group id 
					$q = "select `GroupId` from `groups`  ORDER BY `GroupName`;";
					$RecsG= mysqli_query( $conn,$q)  ;	
					$totalG = mysqli_num_rows($RecsG);
					if ($totalG>0){
						for($k=0;$k<$totalG;$k++){ //objects for
							$rwG 	  = mysqli_fetch_assoc($RecsG);
							$GroupId  = $rwG['GroupId'];
							//get permisin for this group for this object
							$PermQuery = "select `Permission` from `moderators` 
										where `GroupId`='".$GroupId."' and `ObjectId`='".$ObjectId."';";
							$PermRecs = mysqli_query($conn,$PermQuery)  ;	
							$totalPerm = mysqli_num_rows($PermRecs);
							$rwPerm = mysqli_fetch_assoc($PermRecs);
							if ($totalPerm>0){
								if($rwPerm['Permission']==1){
									$option = '<option selected="selected" value="1">'. (yes).'</option>
											<option value="0">'. (no).'</option>';
								}
								else{
									$option = '<option value="1">'. (yes).'</option>
										<option selected="selected" value="0">'. (no).'</option>';
								}//end if
							
								$ShowObjectsList .='  <td><select class="select" name="'.$ObjectId.$GroupId.'" id="'.$ObjectName.'">'
													.$option .'</select></td>';
							}
							else{
								$ShowObjectsList .='<td><select class="select" name="'.$ObjectId.$GroupId.'" id="'.$ObjectName.'">
														<option selected="selected" value="1">'. (yes).'</option>
														<option value="0">'. (no).'</option>
													</select></td>';
							}//end if
						}//end for
						$ShowObjectsList .= '</tr>';
					}//end if
				}//end for
			}//end if

	$ShowObjectsList .='</table><br/><input class="submit" type="submit" name="SubmitOgjPerm" id="SubmitOgjPerm" value="'. (save).'"><br/></form><br/>';
	}
	else{
		$ShowObjectsList =  (NoSpesialPermissionFound);
	}//end if
	return $ShowObjectsList;
}//end if

?>