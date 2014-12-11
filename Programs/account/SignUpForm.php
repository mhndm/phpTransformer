
<strong>
<?php
	echo  (SignUpForm);
?>
</strong>
</center>

<table cellpadding="0" cellspacing="0" width="95%" align="center">
	<tr>
		<td valign="top">
<form method="post"enctype="multipart/form-data" action="<?php  echo LangLink($_SERVER['QUERY_STRING']);  ?>">
	<fieldset>
	<legend>
	<?php
	echo  (GeneralInfo);
	?>
	</legend>
	
	<table cellpadding="0" cellspacing="0" width="95%" align="center">
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			
				<?php
				echo  (UserName)
				?>
				 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">
                            <input  maxlength="15" class="text" value="<?php echo $UserName; ?>" name="UserName" type="text"/>
			 
				<?php
					echo $UserNameErr;
				?>
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (ParentName);
			?>
 :<sup><span class="HighLight"> *</span></sup></td>
			<td style="width: 60%"><input  maxlength="15" value="<?php echo $ParentName; ?>" class="text" name="ParentName" type="text" />&nbsp;
				<?php
					echo $ParentNameErr;
				?>

			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (FamName);
			?>				
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%"><input maxlength="15" value="<?php echo $FamName; ?>"  class="text" name="FamName" type="text" />&nbsp;
              <?php
					echo $FamNameErr;
				?>			
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (NickName);
			?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">

                            <input maxlength="15" value="<?php echo $NickName; ?>" class="text" name="NickName" type="text" />
			<a href="javascript:void(0)" title="<?php echo  (NickNameInfo) ; ?>">
			<img border="0" alt="" style="cursor:help" src="Programs/account/images/info.gif" width="15" height="15"/>
			<?php
					echo $NickNameErr;
			?>
			</a>	
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;" valign="top">
			<?php
				echo  (PassWord);
			?>
			
 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%"><input maxlength="35" value="<?php echo $PassWord; ?>" class="text" onchange="get_From_Server();" name="PassWord" type="password" id="password"/>
			<a href="javascript:void(0)" title="<?php echo  (ForcePasswordExample) ; ?>">
			<img border="0" alt="" style="cursor:help"  src="Programs/account/images/info.gif" width="15" height="15"/>
			              <?php
					echo $PassWordErr;
				?>
			</a>
			<table id="PasswordForce" dir="ltr" border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center"> 
							<font size="2">
							<?php
							 	echo  (easy); 
							 ?>
							 </font>
						</td>
						<td align="center">
						<font size="2">
							<?php
							 	echo  (medium); 
							 ?>
						</font>
						</td>
						<td align="center">
						<font size="2">
							<?php
							 	echo  (strong); 
							 ?>
						</font> 
						</td>
						<td id="ChangePic"></td>
					</tr>
					<tr>
						<td id="easy" align="center" valign="top">&nbsp;
							
						</td>
						<td id="medium" align="center" valign="top">&nbsp;
							
						</td>
						<td id="strong" align="center" valign="top">&nbsp;
							
						</td>
						<td></td>
					</tr>
				</table>			
		</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (RePassWord)
			?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">
			<input maxlength="35"class="text"  value="<?php echo $RePassWord; ?>" name="RePassWord" type="password" />&nbsp;
			<?php
					echo $RePassWordErr;
				?>
				</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (BirthDate);
			?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">
			<select class="select" name="BirthDate_Year">
			<?PHP // SELECTED FOR POST VALUE
				for($i=date("Y")-120;$i<=date("Y");$i++){
					if($BirthDate_Year==$i){
						echo '<option selected="selected">'.$i.'</option>';
					}
					else{
						echo '<option>'.$i.'</option>';
					}
					
				}//end for
			?>
			</select>&nbsp;
			<select class="select" name="BirthDate_Month">
			<?PHP
				for($i=1;$i<=12;$i++){
					if($BirthDate_Month==$i){
						echo '<option selected="selected">'.$i.'</option>';
					}
					else{
						echo '<option>'.$i.'</option>';
					}
				}//end for
			?>
			</select>
			<select class="select" name="BirthDate_Day">
			<?PHP
				for($i=1;$i<=31;$i++){
					if($BirthDate_Day==$i){
						echo '<option selected="selected">'.$i.'</option>';
					}
					else{
						echo '<option>'.$i.'</option>';
					}
				}//end for
			?>
			</select></td>
		</tr>
		<tr>
			<td height="30" style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (UserMail);
			?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%"><input maxlength="50" class="text"  value="<?php echo $UserMail; ?>"  name="UserMail" type="text" />&nbsp;
		    <?php
					echo $UserMailErr;
			?>
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (ReUserMail);
			?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%"><input class="text" maxlength="50" value="<?php echo $ReUserMail; ?>"  name="ReUserMail" type="text" />&nbsp;
              <?php
					echo $ReUserMailErr;
			?>			
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (Sex);
				?>
				 : </td>
			<td style="width: 60%">
			<select class="select" name="Sex">
			<?php
				if($Sex=="1"){
					echo '<option selected="selected" value="1">';
				}
				else{
					echo '<option value="1">';
				}
			?>
				<?php
				echo  (Male);
				?>
				</option>
			<?php
				if($Sex=="0"){
					echo '<option selected="selected" value="0">';
				}
				else{
					echo '<option value="0">';
				}
			?>
				<?php
				echo  (Female);
				?>
				</option>
			</select>&nbsp;</td>
		</tr>
	</table>
	<br/>
	</fieldset>
	<fieldset>
	<legend>
	<?php
		echo  (AdditionalInfo);
	?>
	</legend>
				
	<table cellpadding="0" cellspacing="0" width="95%" align="center">
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (IdTime);
				?>				
 			: </td>
			<td style="width: 60%">
			<select class="select" name="TimeFormat" style="width: 147px">
			<?php
			if($TimeFormat=="Y/m/d"){
				echo '<option selected="selected" value="Y/m/d">';
			}
			else{
				echo '<option value="Y/m/d">';
			}
			?>
			<?php // ADD SELECTED FOR POST VALUE
			echo  (Year)."/". (Month)."/". (Day);
			?>
			</option>
			<?php
			if($TimeFormat=="Y/d/m"){
				echo '<option selected="selected" value="Y/d/m">';
			}
			else{
				echo '<option value="Y/d/m">';
			}
			?>
			<?php
			echo  (Year)."/". (Day)."/". (Month);
			?>
			</option>
			</select>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (Hobies);
				?>
			 :</td>
			<td style="width: 60%">
			<input class="text" maxlength="15" value="<?php echo $Hobies; ?>"  name="Hobies" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (Job);
			?>
			 : </td>
			<td style="width: 60%"><input maxlength="15" class="text" value="<?php echo $Job; ?>" name="Job" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (Education);
			?>
			 : </td>
			<td style="width: 60%"><input maxlength="15" class="text" value="<?php echo $Education; ?>"  name="Education" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (UserSite);
			?>
			 : </td>
			<td style="width: 60%"><input maxlength="50" class="text" value="<?php echo $UserSite; ?>" name="UserSite" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php // ADD SELECTED FOR POST
				echo  (UserSign);
			?>
			 : </td>
			<td style="width: 60%">
			<textarea class="text" name="UserSign" rows="6" cols="" style="width: 242px"><?php echo $UserSign; ?></textarea>
			</td>
		</tr>
	</table>
		<br/>		
	</fieldset>
	
	<fieldset>
	<legend>
	<?php
	echo  (AddressInfo);
	?>
	</legend>
				
	<table cellpadding="0" cellspacing="0"  width="95%" align="center">
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php // ADD SELECTED FOR POST VALUE
				echo  (Contry);
			?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">
			<select dir="ltr" class="select" name="Contry">
			<?php
			//include_once("Programs/account/contryselect.php");
			
			SqlConnect();
			$query="SELECT * FROM `cclang`;";
			global $conn;

				$Rec = mysqli_query($conn,$query); 
				$Totals = mysqli_num_rows($Rec);
					if ($Totals>0){
						for($i=0;$i<$Totals;$i++){
						$ContryRows = mysqli_fetch_assoc($Rec);
						echo '<option value="'.$ContryRows['cc'].'">'.$ContryRows['Contry'].'</option>';
						}
					}//end if
				mysqli_free_result($Rec);

			
			?>	
			</select>  			
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (town);
			?>				
 			: <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%"><input maxlength="15" class="text" value="<?php echo $town; ?>" name="town" type="text" />&nbsp;
			<?php
				echo $townErr;
			?>
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (Rue);
			?>
			 : </td>
			<td style="width: 60%"><input maxlength="15" class="text" value="<?php echo $Rue; ?>" name="Rue" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (AddDetails);
			?>
			 : </td>
			<td style="width: 60%">
			<input class="text" name="AddDetails" type="text"  value="<?php echo $AddDetails; ?>" size="40" maxlength="50" style="width: 230px"/>
			&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (CodePostal);
				?>
			 : </td>
			<td style="width: 60%"><input maxlength="4" class="text" value="<?php echo $CodePostal; ?>" name="CodePostal" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (ZipCode);
				?>
			 : </td>
			<td style="width: 60%"><input maxlength="4" class="text" value="<?php echo $ZipCode; ?>" name="ZipCode" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (PrefTime);
				?>				
				 : </td>
			<td style="width: 60%">
			<select class="select" name="PrefTime">
			<?php // ADD SELECTED FOR POST
			
			for($i=0; $i<24; $i=$i+2){
				$j=$i+2;
				$pt=$i.":00-".$j.":00";
				if($PrefTime==$pt){
					echo '<option selected="selected" value="'.$i.":00-".$j.':00">'.$i.":00-".$j.":00";
				}
				else{
					echo '<option value="'.$i.":00-".$j.':00">'.$i.":00-".$j.":00";
				}
				echo "</option>";
			}
			?>
			</select>&nbsp;</td>
		</tr>
	</table>
			<br/>	
	</fieldset>
	<fieldset>
	<legend>
	<?php
		echo  (CallInfo);
	?>
	</legend>
	
	<table cellpadding="0" cellspacing="0" width="95%" align="center">
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (Gmt);
				?>
			 : </td>
			<td style="width: 60%">
			<select dir="ltr" class="select" name="Gmt">
			<?php
				if($Gmt=="-12"){
				echo '<option selected="selected" value="-12"> GMT -12:00 | Eniwetok, Kwajalein</option>';
				}
				else{
					echo '<option value="-12"> GMT -12:00 | Eniwetok, Kwajalein</option>';
				}//end if
				if($Gmt=="-11"){
					echo '<option selected="selected" value="-11"> GMT -11:00 | Midway Island,Samoa</option>';
				}
				else{
					echo '<option value="-11"> GMT -11:00 | Midway Island,Samoa</option>';
				}//end if
				
				if($Gmt=="-10"){
					echo '<option selected="selected" value="-10"> GMT -10:00 | Hawaii</option>';
				}
				else{
					echo '<option value="-10"> GMT -10:00 | Hawaii</option>';
				}//end if
				
				if($Gmt=="-9"){
					echo '<option selected="selected" value="-9">  GMT -09:00  | Alaska</option>';
				}
				else{
					echo '<option value="-9">  GMT -09:00  | Alaska</option>';
				}//end if
				
				if($Gmt=="-8"){
					echo '<option selected="selected" value="-8">  GMT -08:00  | Pacific Time (US &amp; Canada)</option>';
				}
				else{
					echo '<option value="-8">  GMT -08:00  | Pacific Time (US &amp; Canada)</option>';
				}//end if
				
				if($Gmt=="-7"){
					echo '<option selected="selected" value="-7">  GMT -07:00  | Mountain Time (US &amp; Canada)</option>';
				}
				else{
					echo '<option value="-7">  GMT -07:00  | Mountain Time (US &amp; Canada)</option>';
				}//end if
				
				if($Gmt=="-6"){
					echo '<option selected="selected" value="-6">  GMT -06:00  | Central Time (US &amp; Canada), Mexico City</option>';
				}
				else{
					echo '<option value="-6">  GMT -06:00  | Central Time (US &amp; Canada), Mexico City</option>';
				}//end if
				
				if($Gmt=="-5"){
					echo '<option selected="selected" value="-5">  GMT -05:00  | Eastern Time (US &amp; Canada), Bogota, Lima</option>';
				}
				else{
					echo '<option value="-5">  GMT -05:00  | Eastern Time (US &amp; Canada), Bogota, Lima</option>';
				}//end if
				if($Gmt=="-4"){
					echo '<option selected="selected" value="-4">  GMT -04:00  | Atlantic Time (Canada), Caracas, La Paz</option>';
				}
				else{
					echo '<option value="-4">  GMT -04:00  | Atlantic Time (Canada), Caracas, La Paz</option>';
				}//end if
				if($Gmt=="-3.5"){
					echo '<option selected="selected" value="-3.5">GMT -03:30  | Newfoundland</option>';
				}
				else{
					echo '<option value="-3.5">GMT -03:30  | Newfoundland</option>';
				}//end if
				if($Gmt=="-3"){
					echo '<option selected="selected" value="-3">  GMT -03:00  | Brazil, Buenos Aires, Georgetown</option>';
				}
				else{
					echo '<option value="-3">  GMT -03:00  | Brazil, Buenos Aires, Georgetown</option>';
				}//end if
				
				if($Gmt=="-2"){
					echo '<option selected="selected" value="-2">  GMT -02:00  | Mid-Atlantic</option>';
				}
				else{
					echo '<option value="-2">  GMT -02:00  | Mid-Atlantic</option>';
				}//end if
				if($Gmt=="-1"){
					echo '<option selected="selected" value="-1">  GMT -01:00  | Azores, Cape Verde Islands</option>';
				}
				else{
					echo '<option value="-1">  GMT -01:00  | Azores, Cape Verde Islands</option>';
				}//end if
				
				if($Gmt=="0"){
					echo '<option selected="selected" value="0">   GMT +00:00  | Western Europe Time, London, Lisbon</option>';
				}
				else{
					echo '<option value="0">   GMT +00:00  | Western Europe Time, London, Lisbon</option>';
				}//endif
				if($Gmt=="1"){
					echo '<option selected="selected" value="1">   GMT +01:00  | Brussels, Copenhagen, Madrid, Paris</option>';
				}
				else{
					echo '<option value="1">   GMT +01:00  | Brussels, Copenhagen, Madrid, Paris</option>';
				}//end if
				if($Gmt=="2"){
					echo '<option selected="selected" value="2">   GMT +02:00  | Kaliningrad, South Africa ,Beirut</option>';
				}
				else{
					echo '<option value="2">   GMT +02:00  | Kaliningrad, South Africa ,Beirut</option>';
				}//end if
				if($Gmt=="3"){
					echo '<option selected="selected" value="3">   GMT +03:00  | Baghdad, Riyadh, Moscow, St. Petersburg</option>';
				}
				else{
					echo '<option value="3">   GMT +03:00  | Baghdad, Riyadh, Moscow, St. Petersburg</option>';
				}//end if
				
				if($Gmt=="3.5"){
					echo '<option selected="selected" value="3.5"> GMT +03:30  | Tehran</option>';
				}
				else{
					echo '<option value="3.5"> GMT +03:30  | Tehran</option>';
				}//end if
				
				if($Gmt=="4"){
					echo '<option selected="selected" value="4">   GMT +04:00  | Abu Dhabi, Muscat, Baku, Tbilisi</option>';
				}
				else{
					echo '<option value="4">   GMT +04:00  | Abu Dhabi, Muscat, Baku, Tbilisi</option>';
				}//end if
				
				if($Gmt=="4.5"){
					echo '<option selected="selected" value="4.5"> GMT +04:30  | Kabul</option>';
				}
				else{
					echo '<option value="4.5"> GMT +04:30  | Kabul</option>';
				}//end if
				
				if($Gmt=="5"){
					echo '<option selected="selected" value="5">   GMT +05:00  | Ekaterinburg, Islamabad, Karachi, Tashkent</option>';
				}
				else{
					echo '<option value="5">   GMT +05:00  | Ekaterinburg, Islamabad, Karachi, Tashkent</option>';
				}//end if
				
				if($Gmt=="5.5"){
					echo '<option selected="selected" value="5.5"> GMT +05:30  | Bombay, Calcutta, Madras, New Delhi</option>';
				}
				else{
					echo '<option value="5.5"> GMT +05:30  | Bombay, Calcutta, Madras, New Delhi</option>';
				}
				if($Gmt=="6"){
					echo '<option selected="selected" value="6">   GMT +06:00  | Almaty, Dhaka, Colombo</option>';
				}
				else{
					echo '<option value="6">   GMT +06:00  | Almaty, Dhaka, Colombo</option>';
				}//endif
				if($Gmt=="7"){
					echo '<option selected="selected" value="7">   GMT +07:00  | Bangkok, Hanoi, Jakarta</option>';
				}
				else{
					echo '<option value="7">   GMT +07:00  | Bangkok, Hanoi, Jakarta</option>';
				}//end if
				if($Gmt=="8"){
					echo '<option selected="selected" value="8">   GMT +08:00  | Beijing, Perth, Singapore, Hong Kong</option>';
				}
				else{
					echo '<option value="8">   GMT +08:00  | Beijing, Perth, Singapore, Hong Kong</option>';
				}//end if
				
				if($Gmt=="9"){
					echo '<option selected="selected" value="9">   GMT +09:00  | Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>';
				}
				else{
					echo '<option value="9">   GMT +09:00  | Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>';
				}//end if
				if($Gmt=="9.5"){
					echo '<option selected="selected" value="9.5"> GMT +09:30  | Adelaide, Darwin</option>';
				}
				else{
					echo '<option value="9.5"> GMT +09:30  | Adelaide, Darwin</option>';
				}//end if
				
				if($Gmt=="10"){
					echo '<option selected="selected" value="10">  GMT +10:00 | Eastern Australia, Guam, Vladivostok</option>';
				}
				else{
					echo '<option value="10">  GMT +10:00 | Eastern Australia, Guam, Vladivostok</option>';
				}//end if
				
				if($Gmt=="11"){
					echo '<option selected="selected" value="11">  GMT +11:00 | Magadan, Solomon Islands</option>';
				}
				else{
					echo '<option value="11">  GMT +11:00 | Magadan, Solomon Islands</option>';
				}//end if
				
				if($Gmt=="12"){
					echo '<option selected="selected" value="12">  GMT +12:00 | Auckland, Wellington, Fiji, Kamchatka</option>';
				}
				else{
					echo '<option value="12">  GMT +12:00 | Auckland, Wellington, Fiji, Kamchatka</option>';
				}//end if
				?>
			</select>
			&nbsp;
			</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
			<?php
				echo  (PhoneNbr);
				?>
			 : </td>
			<td style="width: 60%"><input maxlength="20" class="text" value="<?php echo $PhoneNbr; ?>" name="PhoneNbr" type="text" />&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (CellNbr);
				?>
			 : </td>
			<td style="width: 60%"><input maxlength="20" class="text" value="<?php echo $CellNbr; ?>" name="CellNbr" type="text" />&nbsp;</td>
		</tr>
	</table>
	<br/>
	</fieldset>

	<fieldset>
	<legend>
				<?php
				echo  (PreferenceInfo);
				?>
	</legend>
				
	<table cellpadding="0" cellspacing="0" width="95%" align="center">
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (PrefLang);
				?>
			 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">
			<select class="select" name="PrefLang">
			<?php // ADD SELECTED FOR POST 
			global $SqlType, $conn;

				$LngRws = mysqli_query($conn,"SELECT `LangName` FROM `languages` where `Deleted`<>'1';") ;
				$NbrOfLang = mysqli_num_rows($LngRws);
				//echo "LngTotals ".$LngTotals;
				if ($NbrOfLang>0){
				for ($i=0; $i<$NbrOfLang; $i++){
					$Rows = mysqli_fetch_assoc($LngRws);
					$LangNames =$Rows['LangName'];
					if($LangNames==$PrefLang){
						echo '<option selected="selected" value="'.$LangNames.'">'.$LangNames.'</option>';
					}
					else{
						echo '<option value="'.$LangNames.'">'.$LangNames.'</option>';
					}//end if	
				}//end for
				}//end if
			//}//end if
			?>
			</select>
			&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (CookieLife);
				?>
				 : <sup>
			<span class="HighLight">*</span></sup></td>
			<td style="width: 60%">
			<?php // ADD SELECTED FOR POST VALUE
				echo '<select name="CookieLife" class="select">';
				if($CookieLife=="Year"){
					echo '<option selected="selected" value="Year">'. (Year).'</option>';
				}
				else{
					echo '<option value="Year">'. (Year).'</option>';
				}//end if
				
				if($CookieLife=="Month"){
					echo '<option value="Month" selected="selected">'. (Month).'</option>';
				}
				else{
					echo '<option value="Month">'. (Month).'</option>';
				}//end if
				
				if($CookieLife=="Week"){
					echo '<option selected="selected" value="Week">'. (Week).'</option>';
				}
				else{
					echo '<option value="Week">'. (Week).'</option>';
				}//end if
				
				if($CookieLife=="Day"){
					echo '<option selected="selected" value="Day">'. (Day).'</option>';
				}
				else{
					echo '<option value="Day">'. (Day).'</option>';
				}//end if
				
				if($CookieLife=="NeverRemember"){
					echo '<option selected="selected" value="NeverRemember">'. (NeverRemember).'</option>';
				}
				else{
					echo '<option value="NeverRemember">'. (NeverRemember).'</option>';
				}//end if

				echo '</select>';
			?>	
			&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (PrefThem);
				?>
			 : </td>
			<td style="width: 60%">
			<select class="select" name="PrefThem">
			<?php // ADD SELECTED FOR POST
			$result = mysqli_query($conn,"select * from `themes`;");
			while($row = mysqli_fetch_array($result)) {
				$dataThemeName = $row['ThemeName'];
				if($ThemeName == $dataThemeName){	
					echo'<option selected="selected" value="'.$dataThemeName.'">'.$dataThemeName.'</option>';
				}
				else{
						echo'<option value="'.$dataThemeName.'">'.$dataThemeName.'</option>';
				}//end if	
			}//END WHILE
			
			/*
			// from folder
			$dir="Themes/";
			$d = dir($dir);
			while (false !== ($entry = $d->read())) {
			    if($entry!='.' && $entry!='..') {
			        $Allentry = $dir.'/'.$entry;
			        if(is_dir($Allentry)) {
						if($PrefThem==$entry){
							echo'<option selected="selected" value="'.$entry.'">'.$entry.'</option>';
						}
						else{
							echo'<option value="'.$entry.'">'.$entry.'</option>';
						}//end if	
			        }
			    }
			}
			$d->close();
			*/
			
			?>
			</select>&nbsp;</td>
		</tr>
		<tr>
			<td style="width: 40%; border-bottom-style:dotted; border-bottom-width: 1px;">
				<?php
				echo  (UserPic);
				?>
				 : </td>
			<td style="width: 60%">
			<?php
				// Pour limiter la taille d'un fichier (exprimée en ko)
				$Upload-> MaxFilesize  = '60';
				// Pour ajouter des attributs aux champs de type file
				$Upload-> FieldOptions = 'class="file"';
				// Pour indiquer le nombre de champs désiré
				$Upload-> Fields       = 1;
				// Initialisation du formulaire
				$Upload-> InitForm();
				// Affichage du champ MAX_FILE_SIZE
				print $Upload-> Field[0];
				// Affichage du premier champ de type FILE
				print $Upload-> Field[1];
				// Affichage du second champ de type FILE
				//print $Upload-> Field[2];
				//echo $UserPicErr;
			?>
			<a href="javascript:void(0)" title="<?php echo  (UserPicInfo) ; ?>">
			<img border="0" alt="" style="cursor:help" src="Programs/account/images/info.gif" width="15" height="15"/>
			</td>

		</tr>
		<tr>
			<td style="width: 40%">&nbsp;</td>
			<td style="width: 60%">&nbsp;</td>
		</tr>
	</table>

	</fieldset>
	<fieldset>
	<legend>
				<?php
				echo  (LincenseInfo);
				?>
	</legend>
				
	<table width="95%" align="center">
		<tr>
			<td>
				<?php //ADD CHEKED POR POST VALUE  checked="checked"				
				if($WorkPolicy){
					echo '<input checked="checked" class="checkbox" name="WorkPolicy" type="checkbox" value="WorkPolicy" style="width: 20px" />';
				}
				else{
					echo '<input class="checkbox" name="WorkPolicy" type="checkbox" value="WorkPolicy" style="width: 20px" />';
				}//end if
				echo  (WorkPolicy).' <sup><span class="HighLight">*</span></sup> '.$WorkPolicyErr;
				?>
	 <br />
				<?php
				if($SiteUsePolicy){
					echo '	<input checked="checked" class="checkbox" name="SiteUsePolicy" type="checkbox" style="width: 20px" value="SiteUsePolicy" /> ';
				}
				else{
					echo '	<input class="checkbox" name="SiteUsePolicy" type="checkbox" style="width: 20px" value="SiteUsePolicy" /> ';
				}//end if
				echo  (SiteUsePolicy).' <sup><span class="HighLight">*</span></sup> '.$SiteUsePolicyErr;
				?>
	 <br />
				<?php
				if($PrivacyPolicy){
					echo '<input checked="checked" class="checkbox" name="PrivacyPolicy" type="checkbox" style="height: 20px" value="PrivacyPolicy" />';
				}
				else{
					echo '<input class="checkbox" name="PrivacyPolicy" type="checkbox" style="height: 20px" value="PrivacyPolicy" />';
				}
				echo  (PrivacyPolicy).' <sup><span class="HighLight">*</span></sup> '.$PrivacyPolicyErr;
				?>
	</td>
		</tr>
	</table>
	<sup>
			<span style="width: 50%" class="HighLight">&nbsp; *: 
				<?php
				echo  (Required);
				?>
			</span></sup></fieldset>
	<div align="center">
	<br/>
		<input class="button" name="Submit" type="submit" onsubmit="this.Submit.disabled='true'" onclick="MM_validateForm('UserName','','R','ParentName','','R','FamName','','R','NickName','','R','UserMail','','RisEmail','ReUserMail','','RisEmail','Contry','','R','town','','R');return document.MM_returnValue" value="<?php echo  (submit) ?>" />
	</div>
</form>
	<br/>
		</td>
	</tr>
</table>
