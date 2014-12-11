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




if(isset($_POST['SubmitCntrLang'])){
	$contieslangs  = SaveCountryLangs();
	$contieslangs .= ShowCountrieLangs();
}
else{
	$contieslangs = ShowCountrieLangs();
}//end if

function SaveCountryLangs(){
	global $conn, $TotalRecords, $Rows,$Recordset;
	ExcuteQuery("SELECT * FROM `cclang`;");
	if($TotalRecords){
		for($i=0;$i<$TotalRecords;$i++){
			$cc = $Rows['cc'];
			if(isset($_POST[$cc])){
				mysqli_query($conn,"update `cclang` set `Langcc`='".$_POST[$cc]."' where `cc`='".$cc."' ");	
			}//end if
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if
	return  (successSAvingContriesLangs)."<br/>";
}//end function

function ShowCountrieLangs(){
	global $TotalRecords, $Rows,$Recordset, $CustomHead;
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
                                                            document.getElementById("SubmitCntrLang").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>';
	//GET Current LangS
	$contieslangs = '<form name="form1" method="post" action="">
					<table dir="ltr" border="0" cellspacing="2" cellpadding="1">
					  <tr>
					    <td align="center"><strong>'. (ContryCode).'</strong></td>
					    <td align="center"><strong>'. (ContryName).'</strong></td>
					    <td align="center"><strong>'. (CountryLang).'</strong></td>
					  </tr>';

	ExcuteQuery("SELECT * FROM `cclang`;");
	if($TotalRecords){
		for($i=0;$i<$TotalRecords;$i++){
			$cc = $Rows['cc'];
			$Contry = $Rows['Contry'];
			$Langcc = $Rows['Langcc'];
			//$contieslangs .= $cc . '  ' . $Contry .' ' . $Langcc .'<br/>' ;
			$contieslangs .='  <tr   onmouseover="this.style.background=\'url(admin/Themes/Default/images/tr_back.gif)\'" onmouseout="this.style.background=\'\'">
							    <td style="border-bottom:dotted; border-bottom-width:thin">'
								.$cc.'</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin"> | '
								.$Contry.'</td>
							    <td style="border-bottom:dotted; border-bottom-width:thin">'
								.CurrentContryLang($cc,$Langcc).'</td>
							  </tr>';
			$Rows = mysqli_fetch_assoc($Recordset);
		}//end for
	}//end if

	$contieslangs .= '</table><div align="center">
					<input class="submit" name="SubmitCntrLang"  id="SubmitCntrLang" type="submit" value="'. (save).'" /></div><br/></form>';
return $contieslangs;
}//end function


function CurrentContryLang($cc,$Langcc){
	global $conn;
	
	$Option ='';
	$Query = "SELECT `DefaultLang` FROM `params` ;";
	$Recordset = mysqli_query( $conn,$Query) ;	
	$TotalRecords = mysqli_num_rows($Recordset);
	if($TotalRecords){
		$Rows = mysqli_fetch_assoc($Recordset);
		$DefaultLang = $Rows['DefaultLang'];
	}//end if
	//echo $DefaultLang;
	
	$Query = "SELECT `LangName` FROM `languages` ;";
	$Recordset = mysqli_query( $conn,$Query) ;	
	$TotalRecords = mysqli_num_rows($Recordset);
	if($TotalRecords){
	$CurrentContryLang = '<select class="select" name="'.$cc.'" id="'.$cc.'">';
		for($i=0;$i<$TotalRecords;$i++){
			$Rows = mysqli_fetch_assoc($Recordset);
			$LangName = $Rows['LangName'];
			//echo $LangName."<br/>";
			if($Langcc!=''){
				if($Langcc == $LangName){
					$Option .=  '<option selected="selected" value="'.$LangName.'">'.$LangName.'</option>';
				}
				else{
					$Option .=  '<option value="'.$LangName.'">'.$LangName.'</option>';
				}//end if
			}
			else{
				if($DefaultLang == $Langcc){
					$Option .=  '<option selected="selected" value="'.$DefaultLang.'">'.$DefaultLang.'</option>';
				}
				else{
					$Option .=  '<option selected="selected" value="'.$LangName.'">'.$LangName.'</option>';
				}//end if
				
			}//end if
			
		}//end for
	$CurrentContryLang .= $Option . ' </select>';
	}//end if
	return $CurrentContryLang ;
}//end function


?>