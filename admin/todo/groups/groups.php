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
global $conn, $TheNavBar,$ThemeName ;
$theList = SubIconLink("groups","NewGroup"). "<br/>"
		.SubIconLink("groups","DeleteGroup"). "<br/>"
		.SubIconLink("groups","SwitchGroup"). "<br/>"
		.SubIconLink("groups","UsersGroup"). "<br/>"
		.SubIconLink("groups","ChangeUserGroup"). "<br/>"
		.SubIconLink("groups","EditGroup"). "<br/>";
		
if(isset($_GET['subdo'])){
	switch($_GET['subdo']){
		case "NewGroup":
			$theContent =  NewGroup();
			$TheNavBar[] = array( (NewGroup),adminCreateLink("",array("todo","subdo"),array("groups","NewGroup")));
			break;
		case "DeleteGroup":
			$theContent =  DeleteGroup();
			$TheNavBar[] = array( (DeleteGroup),adminCreateLink("",array("todo","subdo"),array("groups","DeleteGroup")));
			break;
		case "UsersGroup":
			$theContent =  UsersGroup();
			$TheNavBar[] = array( (UsersGroup),adminCreateLink("",array("todo","subdo"),array("groups","UsersGroup")));
			break;	
		case "EditGroup":
			$theContent =  EditGroup();
			$TheNavBar[] = array( (EditGroup),adminCreateLink("",array("todo","subdo"),array("groups","EditGroup")));
			break;	
		case "SwitchGroup":
			$theContent =  SwitchGroup();
			$TheNavBar[] = array( (SwitchGroup),adminCreateLink("",array("todo","subdo"),array("groups","SwitchGroup")));
			break;	
		case "ChangeUserGroup":
			$theContent =  ChangeUserGroup();
			$TheNavBar[] = array( (ChangeUserGroup),adminCreateLink("",array("todo","subdo"),array("groups","ChangeUserGroup")));
			break;				
		default :	
			$theContent =  UsersGroup();
			$TheNavBar[] = array( (UsersGroup),adminCreateLink("",array("todo","subdo"),array("groups","UsersGroup")));
	}//end switch
}
else{
	$theContent =  UsersGroup();
	$TheNavBar[] = array( (UsersGroup),adminCreateLink("",array("todo","subdo"),array("groups","UsersGroup")));
}//end if		

$groups = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$groups = VarTheme("{todoImg}", "groups.png",$groups );
$groups = VarTheme("{ThemeName}", $ThemeName,$groups );
$groups = VarTheme("{List}", $theList,$groups );
$groups = VarTheme("{Content}", $theContent,$groups );

function ChangeUserGroup(){
	global $TotalRecords,$Rows,$Recordset,$conn ;
	$ChangeUserGroup  =  (ChangeUserGroup);
	if(isset($_POST['SubmitSaveChangeGroup'])){
		$TargetGroup = PostFilter($_POST['TargetGroup']);
		$NickName 	= PostFilter($_POST['NickName']);
		$Query 		= "update `users` set `GroupId`='".$TargetGroup ."' where `NickName`='".$NickName."';";
		$RS			 = mysqli_query( $conn,$Query) ;
		return  (SuccessSaveNewGroupForUser) .' '.$NickName ;
	}//end if
	
	if(isset($_POST['SubmitChangeGroup'])){
		$NickName = PostFilter($_POST['NickName']);
		
		ExcuteQuery("SELECT * FROM `users` where `NickName`='".$NickName."' ;");
		if ($TotalRecords>0){
			$ChangeUserGroup .= '<form name="formsaveUserGroup" method="post" action="" >'.$NickName;
			$ChangeUserGroup .= ' <input type="hidden" name="NickName" id="NickName" value="'.$NickName.'">
								  <select class="select" name="TargetGroup" id="TargetGroup">';
			ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000");
			if ($TotalRecords>0){
				for($i=0;$i<$TotalRecords;$i++){
					$GroupId = $Rows['GroupId'];
					$GroupName = $Rows['GroupName'];
					$Desc = $Rows['Desc'];
					$ChangeUserGroup .=	'<option value="'.$GroupId.'">'.$GroupName.'</option>';
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
			}//end if
			$ChangeUserGroup .= '</select>
								<input type="submit" name="SubmitSaveChangeGroup" id="SubmitSaveChangeGroup" value="'. (save).'">
								</form>';
		}
		else{
			$ChangeUserGroup .= "<BR/>". (ThisNickNameNotExist);
		}//end if
	}
	else{
		$ChangeUserGroup .= '<form name="forChangeGroup1" method="post" action="">
							  <input type="text" name="NickName" id="NickName">
							  <input type="submit" class="submit" name="SubmitChangeGroup" id="SubmitChangeGroup" value="'. (submit).'">
							</form>';
	}//end if
	
	return $ChangeUserGroup;
	
}//end function

function EditGroup(){
	global $conn, $TotalRecords,$Rows,$Recordset ;
	if(!isset($_GET['edit'])){
	//show list groups
		$EditGroup = '<table border="0" cellspacing="1" cellpadding="1">
					  <tr >
					    <td><strong>'. (GroupName).'</strong></td>
					    <td><strong>'. (GroupDesc).'</strong></td>
					    <td><strong>&nbsp;</strong></td>
					  </tr>';
		ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$GroupId = $Rows['GroupId'];
				$GroupName = $Rows['GroupName'];
				$Desc = $Rows['Desc'];
				$Vars =array('todo','subdo','edit') ;
				$Vals =array('groups','EditGroup',$GroupId);
				$GroupId ='<a href="'.AdminCreateLink("",$Vars,$Vals).'" tile="'. (edit).' '.$GroupName.'" >'. (edit).' </a>';
				$EditGroup .=	'<tr onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
									<td>'.$GroupName.'</td>
									<td>'.$Desc.'</td>
									<td>'.$GroupId.'</td></tr> ';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		$EditGroup .=	' </table>';
		}
		else{
			echo "group not found";
		}//end if
		
	}
	else{
		if(!isset($_POST['SaveGroup'])){
			//edit groups 
			$EditGroup = InputFilter($_GET['edit']);
			//get info from db:
			ExcuteQuery("SELECT * FROM `groups` where `GroupId`='".$EditGroup ."' and `Deleted`<>'1' ");
			if ($TotalRecords>0){
				$GroupName = $Rows['GroupName'];
				$Desc = $Rows['Desc'];
				$EditGroup = get_include_contents("admin/todo/groups/editGroupForm.php");
				$EditGroup = VarTheme("save",  (save),$EditGroup );
				$EditGroup = VarTheme("{GroupName}",  (GroupName),$EditGroup );
				$EditGroup = VarTheme("{GroupDesc}",   (GroupDesc),$EditGroup );
				$EditGroup = VarTheme("{valGroupName}", $GroupName,$EditGroup );
				$EditGroup = VarTheme("{valDesc}", $Desc,$EditGroup );
				$EditGroup = VarTheme("Avalueisrequired",  (Avalueisrequired),$EditGroup );
				$EditGroup = VarTheme("Minimumnumberofcharactersnotmet",  (Minimumnumberofcharactersnotmet),$EditGroup );
			}
		}
		else{
			//save edited group
			$GroupId = InputFilter($_GET['edit']);
			$GroupName = PostFilter($_POST['GroupName']);
			$Desc = PostFilter($_POST['Desc']);
			$query = "update `groups` set `GroupName`='".$GroupName."',`Desc`='".$Desc."' where `GroupId`='".$GroupId ."'";

				global  $conn;
				$Recordset = mysqli_query( $conn,$Query) ;	

			return  (SuccufullySavedGroup). ' <strong> ' .$GroupName . '</strong>' ;
		}//end if
	}
	return 	$EditGroup ;	
}//end function

function SwitchGroup(){
	global $TotalRecords,$Rows,$Recordset , $conn; ;
	if(!isset($_POST['SwitchGroup'])){
		$SwitchGroup = '<form name="formDeleteGroup" method="post" action="">';
		$SwitchGroup .=  (GroupSource) .' ';
		$SwitchGroup .= ' <select class="select" name="SourceGroup" id="DeleteGroup">';
		ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$GroupId = $Rows['GroupId'];
				$GroupName = $Rows['GroupName'];
				$Desc = $Rows['Desc'];
				$SwitchGroup .=	'<option value="'.$GroupId.'">'.$GroupName.'</option>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
		$SwitchGroup .= '</select><br/> '.  (GroupTarget);
		$SwitchGroup .= ' <select class="select" name="TargetGroup" id="TargetGroup">';
		ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$GroupId = $Rows['GroupId'];
				$GroupName = $Rows['GroupName'];
				$Desc = $Rows['Desc'];
				$SwitchGroup .=	'<option value="'.$GroupId.'">'.$GroupName.'</option>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
		$SwitchGroup .= '</select><br/>';
		$SwitchGroup .=	' <br/> 
						<input class="submit" onclick="return chek();" type="submit" name="SwitchGroup" id="SwitchGroup" value="'. (Switsh).'"><br/>';
		$SwitchGroup .=	'</form>
						<SCRIPT language=JavaScript>
							function chek(){
								var x;
								x= confirm("'. (AreUshureToswitchUsersBetweenGroups).'")
								if(x) {
									return true;
								}
								else{
									return false;
								}
							}
						</SCRIPT>';
	}
	else{
		$SourceGroup = PostFilter($_POST['SourceGroup']);
		$TargetGroup = PostFilter($_POST['TargetGroup']);
		//update info

			
			$query ="UPDATE `users` SET `GroupId` = '".$TargetGroup."' WHERE `GroupId` = '".$SourceGroup."' ;";
			$Recordset = mysqli_query( $conn,$query) ;	

		$SwitchGroup =  (WeHaveSuccefulySwitchUsers);
	}//end if
	return $SwitchGroup ;
}//end function

function NewGroup(){
    global $conn;
	if(!isset($_POST['SaveGroup'])){
		// show new group form
		$NewGroup = get_include_contents("admin/todo/groups/GroupForm.php");
		$NewGroup = VarTheme("save",  (save),$NewGroup );
		$NewGroup = VarTheme("{GroupName}",  (GroupName),$NewGroup );
		$NewGroup = VarTheme("{GroupDesc}",  (GroupDesc),$NewGroup );
		$NewGroup = VarTheme("Avalueisrequired",  (Avalueisrequired),$NewGroup );
		$NewGroup = VarTheme("Minimumnumberofcharactersnotmet",  (Minimumnumberofcharactersnotmet),$NewGroup );
	}
	else{
		//SAVE new group
		$GroupId = GenerateID('groups','GroupId');
		$GroupName =PostFilter($_POST['GroupName']) ;
		$Desc = PostFilter($_POST['Desc']);
		//INSERT RECORD

			$query ="INSERT INTO `groups` ( `GroupId` , `GroupName` , `Desc` )
					VALUES ('".$GroupId ."', '".$GroupName."', '".$Desc."');";
			$Recordset = mysqli_query( $conn,$query) ;	

		
		//SHOW SUCCESS MESSAGE
		$NewGroup =  (SuccessAddNewGroup).' <strong> '.$GroupName.' </strong><br/>';
		//showing form for new add option
		$NewGroup .= get_include_contents("admin/todo/groups/GroupForm.php");
		$NewGroup = VarTheme("save",  (save),$NewGroup );
		$NewGroup = VarTheme("{GroupName}",  (GroupName),$NewGroup );
		$NewGroup = VarTheme("{GroupDesc}",  (GroupDesc),$NewGroup );
		$NewGroup = VarTheme("Avalueisrequired",  (Avalueisrequired),$NewGroup );
		$NewGroup = VarTheme("Minimumnumberofcharactersnotmet",  (Minimumnumberofcharactersnotmet),$NewGroup );
		
	}//end if	
	return $NewGroup;
}//end function

function DeleteGroup(){
	global $TotalRecords,$Rows,$Recordset ,$conn;
	if(!isset($_POST['DelGroup'])){
	//get groups from database
		$DeleteGroup = '<form name="formDeleteGroup" method="post" action="">
						<select class="select" name="DeleteGroup" id="DeleteGroup">';
		ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000; ");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$GroupId = $Rows['GroupId'];
				$GroupName = $Rows['GroupName'];
				$Desc = $Rows['Desc'];
				$DeleteGroup .=	'<option value="'.$GroupId.'">'.$GroupName.' : '.$Desc.'</option>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if

		$DeleteGroup .=	' &nbsp; <input class="submit" type="submit" name="DelGroup" id="DelGroup" value="'. (delete).'">
						</select></form>';
	}
	else{
		if(isset($_POST['DeleteGroup'])){
			// WE DONT DELETE : 3 GROUPS users guests an d admins
			if($_POST['DeleteGroup']!="20070000000" and $_POST['DeleteGroup']!="20070000001" and $_POST['DeleteGroup']!="200700000-1"){
				$DeleteGroup = PostFilter($_POST["DeleteGroup"]);
				//cheking if users have this group
				ExcuteQuery("SELECT * FROM `users` WHERE `GroupId` ='".$DeleteGroup."';");
				if ($TotalRecords>0){
					$DeleteGroup =  (YouCantdeletethisGroupBecauseusershavethisGroup);
				}
				else{
					//deleting group TO RECYCLE 

					$query ="update `groups` set `deleted`='1' where `GroupId`='".$DeleteGroup."' ;";
					$Recordset = mysqli_query( $conn,$query) ;
					$DeleteGroup =  (WeHaveSuccefullyDeleteGroup) ;					

				}//end if
			}
			else{
				$DeleteGroup =  (YouCantdeletethisGroupBecauseitsasystemgroup);
			}//end if
		}//end if	
	}
	return $DeleteGroup;	
}//end function

function UsersGroup(){
	global $TotalRecords,$Rows,$Recordset,$conn ;
	if(!isset($_POST['UsersGroup']) and !isset($_GET['qry'])){
		$Vars =array('todo','subdo','page') ;
		$Vals =array('groups','UsersGroup','1');
		$UsersGroup = '<form name="formUsersGroup" method="get" action="'.AdminCreateLink("",$Vars,$Vals).'">';
		$UsersGroup .= ' <select class="select" name="qry" id="qry">';
		ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$GroupId = $Rows['GroupId'];
				$GroupName = $Rows['GroupName'];
				$Desc = $Rows['Desc'];
				$UsersGroup .=	'<option value="'.$GroupId.'">'.$GroupName.'</option>';
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
		}//end if
                $UsersGroup .= '<input name="todo" value="groups" type="hidden">';
                $UsersGroup .= '<input name="subdo" value="UsersGroup" type="hidden">';
                $UsersGroup .= '<input name="page" value="1" type="hidden">';
		$UsersGroup .= '<input class="submit" type="submit" name="UsersGroup" id="UsersGroup" value="'. (submit).'" />
						</select><br/></form>' ;
	}
	else{
		if(isset($_POST['UsersGroup'])){
			$selectGroup = PostFilter($_POST['qry']);
		}
		if(isset($_GET['qry'])){
			$selectGroup =  (InputFilter($_GET['qry']));
		}//end if
		ExcuteQuery("SELECT * FROM `users` WHERE `GroupId`='".$selectGroup ."' and `Deleted`<>'1';");
		if ($TotalRecords>0){
			for($i=0;$i<$TotalRecords;$i++){
				$UserId = $Rows['UserId'];
				$UserName = $Rows['UserName'];
				$ParentName = $Rows['ParentName'];
				$FamName = $Rows['FamName'];
				$NickName =$Rows['NickName'];
				$Contry ='<img src="images/flags/'.strtolower($Rows['Contry']).'.png" width="18" height="12" alt="'.$Rows['Contry'].'" />';		
				$UserMail = $Rows['UserMail'];
				$resNickName = $Rows['NickName'];
				$SearchUser[]= '<tr onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
								<td>'. $resNickName .'</td>
								<td>'.$UserName .' '. $ParentName .' '.$FamName.'</td>
								<td>'.$UserMail.'</td>
								<td>'.$Contry.'</td>
								</tr>'; 
				$Rows = mysqli_fetch_assoc($Recordset);
			}//end for
				$UsersGroup = '<table width="100%" border="0" cellspacing="2" cellpadding="1">';
				$UsersGroup .='<tr><td><strong>'.  (NickName).'</strong></td>
						<td><strong>'. (UserName) .'</strong></td>
						<td><strong>'. (Email).'</strong></td>
						<td><strong>'. (contrie).'</strong></td>
					</tr>';

				$UsersGroupTab =Pagination($SearchUser,50,10);
                                $UsersGroup.=$UsersGroupTab[0];
				$UsersGroup.='</table>';
				$UsersGroup.=$UsersGroupTab[1];
		}
		else{
			$UsersGroup = '<form name="formUsersGroup" method="get" action="">';
			$UsersGroup .= ' <select name="qry" id="qry">';
			ExcuteQuery("SELECT `GroupId`,`GroupName`,`Desc` FROM `groups` where `Deleted`<>'1' LIMIT 1000");
			if ($TotalRecords>0){
				for($i=0;$i<$TotalRecords;$i++){
					$GroupId = $Rows['GroupId'];
					$GroupName = $Rows['GroupName'];
					$Desc = $Rows['Desc'];
					$UsersGroup .=	'<option value="'.$GroupId.'">'.$GroupName.'</option>';
					$Rows = mysqli_fetch_assoc($Recordset);
				}//end for
			}//end if
                        
                        

			$UsersGroup .= '<input class="submit" type="submit" name="UsersGroup" id="UsersGroup" value="'. (submit).'" />
						</select><br/></form>' ;
		}//end if
		
		
	}//end if
	return $UsersGroup;	
}//end function


?>