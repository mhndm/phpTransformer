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
<?php
include_once("Programs/gallery/admin/Languages/lang-".$Lang.".php");

$theList .= SubIconLink("recycle","galleryRecycle"). "<br/>";


if(isset($_GET['subdo'])){
	if($_GET['subdo']== "galleryRecycle"){
		$theContent =  galleryRecycle();
	}//end if		
}//end if

function galleryRecycle(){
	$RecycleHelloWorld = '<img src="Programs/gallery/admin/images/gallery.png" alt="gallery"/><br/>';
	return $RecycleHelloWorld. (galleryRecycle);
}
?>