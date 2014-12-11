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
<?php if (!isset($IsAdmin)){header("location: ../");} ?>
<?php
global $CustomHead,$ProgName, $TopCont,$TitlePage,$NavCont,$ViewFoot,$ViewTop,$ViewProg,$ViewNavCont;


include_once("TopCont.php");
//include_once("MenuContainer.php");
include_once("admin/FootContainer.php");
$Page = get_include_contents("admin/Themes/".$ThemeName."/index.php");

$Page = VarTheme("{DirHtml}",  (DirHtml),$Page);
$Page = VarTheme("{LangContry}", "ar",$Page);
$Page = VarTheme("{LangEncoding}", "utf-8",$Page);
$Page = VarTheme("{Author}", $Author,$Page);
$Page = VarTheme("{DetailedDescription}",  (DetailedDescription),$Page);
$Page = VarTheme("{ThemeName}", $ThemeName,$Page);
$Page = VarTheme("{TitlePage}", $TitlePage,$Page);
$Page = VarTheme("{SiteKeywords}",  (SiteKeywords),$Page);
$Page = VarTheme("{SiteDescription}",  (SiteDescription),$Page);
$Page = VarTheme("{WebSiteName}", $WebSiteName,$Page);
$Page = VarTheme("{ThemeName}", $ThemeName,$Page);
$Page = VarTheme("{CustomBody}", $CustomBody,$Page);
$Page = VarTheme("{CustomHead}", $CustomHead,$Page);

if($ViewTop){
	$Page = VarTheme("{TopCont}", $TopCont,$Page);
}
else{
	$Page = VarTheme("{TopCont}", "",$Page);
}//end if

if($ViewProg){
	// admin must login to vie nav bar
	if(isset($_SESSION['Login'.$WebsiteUrl])){
		if($_SESSION['Login'.$WebsiteUrl]== true){
                        if($ViewNavCont){
                            include_once('admin/NavCont.php');
                            $Page = VarTheme("{NavCont}", $NavCont,$Page);
                        }
		}
		else{
			$Page = VarTheme("{NavCont}", "",$Page);
		}//end if
        }
	else{
		$Page = VarTheme("{NavCont}", "",$Page);       
	}//end if
	
	$Page = VarTheme("{ProgCont}", $ProgCont,$Page);
}
else{
	$Page = VarTheme("{ProgCont}", "",$Page);
}//end if

if($ViewFoot){
	$Page = VarTheme("{FootCont}", $FootCont,$Page);
}
else{
	$Page = VarTheme("{FootCont}", "",$Page);
}//end if

if($DontShowNavContVar){
    $Page = VarTheme("{NavCont}", "",$Page);
}

   //$size_before = mb_strlen($Page, '8bit');

    require_once 'includes/compactor.php';
    $compactor = new Compactor(array(
                'buffer_echo' => false,
                'strip_comments'=>false,
                'compress_scripts'=>false
                
            ));
   echo $Page = $compactor->squeeze($Page);
    
   // $size_after = mb_strlen($Page, '8bit');
    
    //echo $Page .'from '.round($size_before/1024, 2).'KB to '.round($size_after/1024, 2).'KB   saving '.round((1-($size_after/$size_before))*100, 2).'%';

    
//echo $Page;
?>