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
global $ThemeName,$Rows;

if(isset($_POST['SubmitSaveUseRew'])){
	$SEO = PostFilter($_POST['SEO']);
	mysqli_query($conn,"update `params` set `UseRew`='".$SEO."'");
}//END IF

ExcuteQuery("SELECT `UseRew` FROM `params`;");
$SEO = $Rows['UseRew'];
if($SEO==1){
	$SEO = '<option selected="selected" value="1">'. (yes).'</option>
					<option value="0">'. (no).'</option>';
	$SEOStatus =  (enable);				
}
else{
	$SEO = '<option value="1">'. (yes).'</option>
					<option selected="selected" value="0">'. (no).'</option>';
	$SEOStatus =  (disable);	
}//end if

$theContent  =  (SeoDesc).'<form name="SEO" method="post" action=""><br/><strong>'. (DidUwantToenableSEO);
$theContent .= "</strong>  ";
$theContent .='<select class="select" name="SEO" id="SEO">
				'.$SEO .'
				<input class="submit" type="submit" name="SubmitSaveUseRew" id="SubmitSaveUseRew" value="'
				. (save).'">
				</select></form>';
$theContent .=  (SeoStatus).'<strong>'.$SEOStatus.'</strong><br/>('. (SeoNote).')';

$SEO  = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$SEO  = VarTheme("{todoImg}", "tops.jpg",$SEO  );
$SEO  = VarTheme("{ThemeName}", $ThemeName,$SEO  );
$SEO  = VarTheme("{List}", '',$SEO  );
$SEO  = VarTheme("{Content}", $theContent,$SEO  );


	
?>