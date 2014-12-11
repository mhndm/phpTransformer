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
global $ThemeName;
if(isset($_GET['todo'])){
	$todo = InputFilter($_GET['todo']);
}else{
	$todo ="";
}//end if
	if($todo == "members" ){
		$selmembers='selected="selected"';
	}
	else{
		$selmembers="";
	}//end if
	if($todo == "groups" ){
		$selgroups='selected="selected"';
	}
	else{
		$selgroups="";
	}//end if
	if($todo == "maillist" ){
		$selmaillist='selected="selected"';
	}
	else{
		$selmaillist="";
	}//end if
	if($todo == "letters" ){
		$selletters='selected="selected"';
	}
	else{
		$selletters="";
	}//end if
	if($todo == "programscontrol" ){
		$selprogramscontrol='selected="selected"';
	}
	else{
		$selprogramscontrol="";
	}//end if
	if($todo == "newprograms" ){
		$selnewprograms='selected="selected"';
	}
	else{
		$selnewprograms="";
	}//end if
	if($todo == "programspermisions" ){
		$selprogramspermisions='selected="selected"';
	}
	else{
		$selprogramspermisions="";
	}//end if
	if($todo == "programs" ){
		$selprograms='selected="selected"';
	}
	else{
		$selprograms="";
	}//end if
	if($todo == "blockscontrol" ){
		$selblockscontrol='selected="selected"';
	}
	else{
		$selblockscontrol="";
	}//end if
	if($todo == "newblock" ){
		$selnewblock='selected="selected"';
	}
	else{
		$selnewblock="";
	}//end if
	if($todo == "blockspermisions" ){
		$selblockspermisions='selected="selected"';
	}
	else{
		$selblockspermisions="";
	}//end if
	if($todo == "blocksmanagment" ){
		$selblocksmanagment='selected="selected"';
	}
	else{
		$selblocksmanagment="";
	}//end if
	if($todo == "backup" ){
		$selbackup='selected="selected"';
	}
	else{
		$selbackup="";
	}//end if
	if($todo == "restore" ){
		$selrestore='selected="selected"';
	}
	else{
		$selrestore="";
	}//end if
	
	if($todo == "optimize" ){
		$seloptimize='selected="selected"';
	}
	else{
		$seloptimize="";
	}//end if
	
	if($todo == "bugsandreport" ){
		$selbugsandreport='selected="selected"';
	}
	else{
		$selbugsandreport="";
	}//end if
	
	if($todo == "antiflood" ){
		$selantiflood='selected="selected"';
	}
	else{
		$selantiflood="";
	}//end if
	
	if($todo == "blocking" ){
		$selblocking='selected="selected"';
	}
	else{
		$selblocking="";
	}//end if
	if($todo == "specialpermision" ){
		$selspecialpermision='selected="selected"';
	}
	else{
		$selspecialpermision="";
	}//end if
	if($todo == "faildlogin" ){
		$selfaildlogin='selected="selected"';
	}
	else{
		$selfaildlogin="";
	}//end if
	if($todo == "languages" ){
		$sellanguages='selected="selected"';
	}
	else{
		$sellanguages="";
	}//end if
	if($todo == "contieslangs" ){
		$selcontieslangs='selected="selected"';
	}
	else{
		$selcontieslangs="";
	}//end if
	if($todo == "themes" ){
		$selthemes='selected="selected"';
	}
	else{
		$selthemes="";
	}//end if
	if($todo == "layersmenu" ){
		$sellayersmenu='selected="selected"';
	}
	else{
		$sellayersmenu="";
	}//end if
	if($todo == "mainmenu" ){
		$selmainmenu='selected="selected"';
	}
	else{
		$selmainmenu="";
	}//end if
	if($todo == "newsbar" ){
		$selnewsbar='selected="selected"';
	}
	else{
		$selnewsbar="";
	}//end if
	if($todo == "robotsadmin" ){
		$selrobotsadmin='selected="selected"';
	}
	else{
		$selrobotsadmin="";
	}//end if
	if($todo == "options" ){
		$seloptions='selected="selected"';
	}
	else{
		$seloptions="";
	}//end if
	if($todo == "recycle" ){
		$selrecycle='selected="selected"';
	}
	else{
		$selrecycle="";
	}//end if
	if($todo == "robotsadmin" ){
		$selrobotsadmin='selected="selected"';
	}
	else{
		$selrobotsadmin="";
	}//end if
	if(isset($_GET['prog'])){
		if($_GET['prog'] == "pages" ){
			$selpages='selected="selected"';
		}
		else{
			$selpages="";
		}
	}
	else{
			$selpages="";
	}//end if
	if($todo == "Error" ){
		$selError='selected="selected"';
	}
	else{
		$selError="";
	}//end if
	if($todo == "SEO" ){
		$selSEO='selected="selected"';
	}
	else{
		$selSEO="";
	}//end if
	if($todo == "cache" ){
		$selCacheSystem='selected="selected"';
	}
	else{
		$selCacheSystem="";
	}//end if
	if($todo == "Translations" ){
		$selTranslations='selected="selected"';
	}
	else{
		$selTranslations="";
	}//end if
	if($todo == "webfolder" ){
		$selwebfolder='selected="selected"';
	}
	else{
		$selwebfolder="";
	}//end if
	if($todo == "admins" ){
		$adminsSelect='selected="selected"';
	}
	else{
		$adminsSelect="";
	}//end if
	if($todo == "plugins" ){
		$pluginsSelect='selected="selected"';
	}
	else{
		$pluginsSelect="";
	}//end if
	if($todo == "sendmodule" ){
		$sendmoduleSelect='selected="selected"';
	}
	else{
		$sendmoduleSelect="";
	}//end if
	if($todo == "appsstore" ){
		$appsstoreSelect='selected="selected"';
	}
	else{
		$appsstoreSelect="";
	}//end if

$FastMenu =  "<form onsubmit=\"this.submit.disabled='true'\" action=\"index.php\" method=\"get\">";
$FastMenu .= "<select style='width:228px;   ' class=\"select\" name=\"newlanguage\" onchange=\"top.location.href=this.options[this.selectedIndex].value\">";
$FastMenu .='<option value="'.mainLinks("members").'" '.$selmembers.'  style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/members.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
            '. (Members).'</option>';
$FastMenu .='<option value="'.mainLinks("groups").'" '.$selgroups.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/groups.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Groups).'</option>';
$FastMenu .='<option value="'.mainLinks("maillist").'" '.$selmaillist.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/maillist.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (MailList).'</option>';
$FastMenu .='<option value="'.mainLinks("letters").'" '.$selletters.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/letters.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Letters).'</option>';
$FastMenu .='<option value="'.mainLinks("programscontrol").'" '.$selprogramscontrol.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/programscontrol.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (ProgramsControl).'</option>';
$FastMenu .='<option value="'.mainLinks("newprograms").'"'.$selnewprograms.' style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/newprograms.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (NewPrograms).'</option>';
$FastMenu .='<option value="'.mainLinks("programspermisions").'" '.$selprogramspermisions.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/programspermisions.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (ProgramsPermisions).'</option>';
$FastMenu .='<option value="'.mainLinks("programs").'" '.$selprograms.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/programs.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (ProgramManagment).'</option>';
$FastMenu .='<option value="'.mainLinks("blockscontrol").'" '.$selblockscontrol.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/blockscontrol.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (BlocksControl).'</option>';
$FastMenu .='<option value="'.mainLinks("newblock").'" '.$selnewblock.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/newblock.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (NewBlock).'</option>';
$FastMenu .='<option value="'.mainLinks("blockspermisions").'" '.$selblockspermisions.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/blockspermisions.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (BlocksPermisions).'</option>';
$FastMenu .='<option value="'.mainLinks("blocksmanagment").'" '.$selblocksmanagment.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/blocksmanagment.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (BlocksManagment).'</option>';
$FastMenu .='<option value="'.mainLinks("backup").'" '.$selbackup.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/backup.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Backup).'</option>';
$FastMenu .='<option value="'.mainLinks("restore").'" '.$selrestore.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/restore.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Restore).'</option>';
$FastMenu .='<option value="'.mainLinks("optimize").'" '.$seloptimize.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/optimize.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Optimize).'</option>';
$FastMenu .='<option value="'.mainLinks("bugsandreport").'" '.$selbugsandreport.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/bugsandreport.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (BugsandReport).'</option>';
$FastMenu .='<option value="'.mainLinks("antiflood").'" '.$selantiflood.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/antiflood.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (AntiFlood).'</option>';
$FastMenu .='<option value="'.mainLinks("blocking").'" '.$selblocking.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/blocking.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Blocking).'</option>';
$FastMenu .='<option value="'.mainLinks("specialpermision").'" '.$selspecialpermision.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/specialpermision.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (SpecialPermision).'</option>';
$FastMenu .='<option value="'.mainLinks("faildlogin").'" '.$selfaildlogin.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/faildlogin.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (FaildLogin).'</option>';
$FastMenu .='<option value="'.mainLinks("languages").'" '.$sellanguages.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/languages.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Languages).'</option>';
$FastMenu .='<option value="'.mainLinks("contieslangs").'" '.$selcontieslangs.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/contieslangs.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (ContiesLangs).'</option>';
$FastMenu .='<option value="'.mainLinks("themes").'" '.$selthemes.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/themes.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Themes).'</option>';
$FastMenu .='<option value="'.mainLinks("layersmenu").'" '.$sellayersmenu.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/layersmenu.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (LayersMenu).'</option>';
$FastMenu .='<option value="'.mainLinks("mainmenu").'" '.$selmainmenu.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/MainMenu.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (MainMenu).'</option>';
$Vars = array("prog");
$Vals = array("pages");
$FastMenu .='<option value="'.AdminCreateLink("",$Vars,$Vals).'" '.$selpages.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/pages.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Pages).'</option>';
$FastMenu .='<option value="'.mainLinks("newsbar").'" '.$selnewsbar.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/newsbar.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (NewsBar).'</option>';
$FastMenu .='<option value="'.mainLinks("robotsadmin").'" '.$selrobotsadmin.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/robotsadmin.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (RobotsAdmin).'</option>';
$FastMenu .='<option value="'.mainLinks("options").'" '.$seloptions.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/options.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Options).'</option>';
$FastMenu .='<option value="'.mainLinks("recycle").'" '.$selrecycle.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/recycle.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Recycle).'</option>';
$FastMenu .='<option value="'.mainLinks("SEO").'" '.$selSEO.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/seo.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (SEO).'</option>';
$FastMenu .='<option value="'.mainLinks("Error").'" '.$selError.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/error.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Error).'</option>';
$FastMenu .='<option value="'.mainLinks("cache").'" '.$selCacheSystem.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/cache.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (CacheSystem).'</option>';
$FastMenu .='<option value="'.mainLinks("Translations").'" '.$selTranslations.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/translations.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (Translations).'</option>';
$FastMenu .='<option value="'.mainLinks("webfolder").'" '.$selwebfolder.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/webfolder.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. (webfolder).'</option>';
$FastMenu .='<option value="'.mainLinks("admins").'" '.$adminsSelect.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/admins.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. Admins.'</option>';
$FastMenu .='<option value="'.mainLinks("plugins").'" '.$pluginsSelect.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/plugins.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. Plugins.'</option>';
$FastMenu .='<option value="'.mainLinks("appsstore").'" '.$appsstoreSelect.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/store.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '. AppsStore.'</option>';
$FastMenu .='<option value="'.mainLinks("sendmodule").'" '.$sendmoduleSelect.'style="background-image:url(admin/Themes/'.$ThemeName.'/images/fastmenu/sendmodule.png); background-position:left; background-repeat:no-repeat; padding-left:20px;">
           '.SendYouModule.'</option>';

$FastMenu .= "</select></form>";

function mainLinks($todo){
	$Vars = array("todo");
	$Vals = array($todo);;
	return AdminCreateLink("",$Vars,$Vals);
	
}//end function

?>