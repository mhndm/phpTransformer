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
global $WebSiteName,$Dirhtml,$WebsiteUrl,$ThemeName,$conn,$TotalRecords, $Rows ,$CustomHead,$Lang;
include_once("Blocks/Gsearch/admin/Languages/lang-".$Lang.".php");

$CustomHead = '<script language=JavaScript src="Blocks/Gsearch/admin/picker.js"></script>
				<script src="admin/Themes/Default/SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
				<link href="admin/Themes/Default/SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';

if(isset($_POST['SubmitSaveGsearch'])){
	$URL		 		= PostFilter($_POST['URL']);
	$Border	 			= PostFilter($_POST['Border']);
	$VisitedURL	 		= PostFilter($_POST['VisitedURL']);
	$Background	 		= PostFilter($_POST['Background']);
	$LogoBackground	 	= PostFilter($_POST['LogoBackground']);
	$Title		  		= PostFilter($_POST['Title']);
	$Text		  		= PostFilter($_POST['Text']);
	$LightURL		  	= PostFilter($_POST['LightURL']);
	$clientKey		  	= PostFilter($_POST['clientKey']);
	$target		  		= PostFilter($_POST['target']);
	
	mysqli_query($conn,"update `gsearch` set 
				`URL`='".$URL."' ,
				`Border`='".$Border."' ,
				`VisitedURL`='".$VisitedURL."' ,
				`Background`='".$Background."' ,
				`LogoBackground`='".$LogoBackground."' ,
				`Title`='".$Title."' ,
				`Text`='".$Text."' ,
				`LightURL`='".$LightURL."' ,
				`clientKey`='".$clientKey."' ,
				`target`='".$target."' ;");
}//end if

ExcuteQuery("select * from `gsearch`;");
if ($TotalRecords>0){
	$URL		 		= $Rows['URL'];
	$Border	 			= $Rows['Border'];
	$VisitedURL	 		= $Rows['VisitedURL'];
	$Background	 		= $Rows['Background'];
	$LogoBackground	 	= $Rows['LogoBackground'];
	$Title		  		= $Rows['Title'];
	$Text		  		= $Rows['Text'];
	$LightURL		  	= $Rows['LightURL'];
	$clientKey		  	= $Rows['clientKey'];
	$target		  		= $Rows['target'];
}
else{
	$URL		 		= "#008000";
	$Border	 			= "#336699";
	$VisitedURL	 		= "663399";
	$Background	 		= "FFFFFF";
	$LogoBackground	 	= "336699";
	$Title		  		= "CC0000";
	$Text		  		= "000000";
	$LightURL		  	= "0000FF";
	$clientKey		  	= "pub-9756194919174825";
	$target		  		= "google_window";
}//end if


echo '<strong>'. (GoogleSearchOptions).'</strong><br/>
		<form id="formGsearch" name="formGsearch" method="post" action="">
		<table border="0" cellspacing="1" cellpadding="1">
		  <tr>
		    <td>'. (URL).'</td>
		    <td>
		      <span id="sprytextfield1">
		          <input value="'.$URL.'" size="7" maxlength="7" type="text" name="URL" id="URL" />
				  <a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'URL\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		        <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>    </td>
		  </tr>
		  <tr>
		    <td>'. (Border).'</td>
		    <td><span id="sprytextfield2">
		      <input  value="'.$Border.'" size="7" maxlength="7" type="text" name="Border" id="Border" />
			  	  	<a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'Border\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (VisitedURL).' </td>
		    <td><span id="sprytextfield3">
		      <input  value="'.$VisitedURL.'" size="7" maxlength="7" type="text" name="VisitedURL" id="VisitedURL" />
			  <a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'VisitedURL\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (Background).'</td>
		    <td><span id="sprytextfield4">
		      <input  value="'.$Background.'" size="7" maxlength="7" type="text" name="Background" id="Background" />
			  <a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'Background\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>

		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (LogoBackground).'</td>
		    <td><span id="sprytextfield5">
		      <input  value="'.$LogoBackground.'" size="7" maxlength="7" type="text" name="LogoBackground" id="LogoBackground" />
			  	  <a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'LogoBackground\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (TitleCOLOR).'</td>
		    <td><span id="sprytextfield6">
		      <label>
		      <input  value="'.$Title.'" size="7" maxlength="7" type="text" name="Title" id="Title" />
			  	<a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'Title\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		      </label>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (TextCOLOR).'</td>
		    <td><span id="sprytextfield7">
		      <input  value="'.$Text.'" size="7" maxlength="7" type="text" name="Text" id="Text" />
			  	  	<a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'Text\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (LightURL).'</td>
		    <td><span id="sprytextfield8">
		      <input  value="'.$LightURL.'" size="7" maxlength="7" type="text" name="LightURL" id="LightURL" />
			  	<a href="javascript:TCP.popup(document.forms[\'formGsearch\'].elements[\'LightURL\'])">
				<img width="15" height="13" border="0" alt="'. (ClickHeretoPickupthecolor).'" 
					title="'. (ClickHeretoPickupthecolor).'"
					src="Blocks/Gsearch/admin/images/sel.gif">
				</a>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (clientKey).'</td>
		    <td><span id="sprytextfield9">
		      <label>
		      <input  value="'.$clientKey.'" size="30" maxlength="50" type="text" name="clientKey" id="clientKey" />
		      </label>
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td>'. (target).' </td>
		    <td><span id="sprytextfield10">
		      <input  value="'.$target.'" size="15" maxlength="15" type="text" name="target" id="target" />
		      <span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center">
		      <input class="submit" type="submit" name="SubmitSaveGsearch" id="SubmitSaveGsearch" value="'. (save).'">
			</td>
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
		var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
		var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
		var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
		//-->
		</script>';
?>