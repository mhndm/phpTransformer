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
<?php if (!isset($project)){header("location: ../");} ?>
<?php
global $Author;

$Content = GetThemeCode(null,null);
$Content = VarTheme("{DirHtml}",  (DirHtml),"$Content");
$Content = VarTheme("{LangEncoding}", "utf-8","$Content");
$Content = VarTheme("{Author}", $Author,"$Content");
$Content = VarTheme("{DetailedDescription}",  str_replace('&#44;', ',',DetailedDescription) ,"$Content");

if(isset($ProgramName)){
	$Content = VarTheme("{ProgramName}", $ProgramName,"$Content");
}
else{
	$Content = VarTheme("{ProgramName}", $MainPrograms,"$Content");
}

require_once('includes/keywords.php');
//web site enable SEO or no ?
if($UseRew == 1){
	$SiteKeywords =  SiteKeywords.' , '.$SeoKeywords;
}
else{
	$SiteKeywords =  SiteKeywords;
}//end if
$SiteKeywords = str_replace('&#44;', ',', $SiteKeywords); //bug with translation file to escape the , character

$Content = VarTheme("{LangContry}",  MiniLang,"$Content");
$Content = VarTheme("{TitlePage}", $TitlePage,"$Content");
$Content = VarTheme("{ThemeName}", $ThemeName,"$Content");
$Content = VarTheme("{SiteKeywords}", $SiteKeywords,"$Content");
//$Content = VarTheme("{SiteDescription}",  (SiteDescription),"$Content");
$Content = VarTheme("{SiteDescription}",  $MetaDescription ,"$Content");
$Content = VarTheme("{Language}", $Lang,"$Content");
$Content = VarTheme("{CustomHead}", $CustomHead,$Content);
$Content = VarTheme("{CustomBody}", $CustomBody,$Content);

//put another meta here
$Content = VarTheme("{WebSiteName}",  WebSiteName,$Content);
$Content = VarTheme("{GoogleCode}",  $GoogleCode,$Content);
$LastLineCode .= '<script language="javascript" type="text/javascript">
                        writeCookie();

                        function writeCookie()
                        {
                         var today = new Date();
                         var the_date =  new Date("December 31, 2200");
                         var the_cookie_date = the_date.toGMTString();
                         var the_cookie = "users_resolution="+ screen.width +"x"+ screen.height;
                         var the_cookie = the_cookie + ";expires=" + the_cookie_date;
                         document.cookie=the_cookie
                        }
                   </script>
                   ';
$Content = VarTheme("{LastLineCode}",  $LastLineCode .'<input id="session_id" type="hidden" value="'. session_id().'"  name="session_id" />',$Content);

?>