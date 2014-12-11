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
global $CustomHead,$Lang,$TinyDir,$UserId,$LastSession;

if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}

$bname = InputFilter($_GET['block']);
$fname =  "Blocks/".$bname ."/index.php";
if(is_file("Blocks/".$bname."/admin/Languages/lang-".$Lang.".php")){
    include_once("Blocks/".$bname."/admin/Languages/lang-".$Lang.".php");
}
$CustomHead .= '<script src="Blocks/FreeBlock/admin/SpryValidationTextarea.js" type="text/javascript"></script>
				<link href="Blocks/FreeBlock/admin/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
                       
    <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.' . MiniLang . '.js"          type="text/javascript" charset="utf-8"></script>

    <script src="includes/elrte/elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elfinder/js/i18n/elfinder.' . MiniLang . '.js"    type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $().ready(function() {


            $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);
			
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "' . MiniLang . '",
                height   : 250,
                toolbar  : "maxi",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                fmOpen : function(callback) {
                    $("<div id=\'myelfinder\' />").elfinder({
                        url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                        lang : "' . MiniLang . '",
                        dialog : { width : 900, modal : true, title : "' . Gallery . '" },
                        closeOnEditorCallback : true,
                        editorCallback : callback
                    })
                }
            }
            $(".editor").elrte(opts);
           
        })
				</script>';


if(isset($_POST['SubmitSavePartner'])){
	$data   = PostFilter($_POST['Partner'],true);
	$handle = fopen($fname, 'w') or die( (cantopenfile));
	fwrite($handle, stripslashes($data));
	fclose($handle);

}//end if	

$handle = @fopen($fname, "r");
$data ="";
if ($handle) {
   while (!feof($handle)) {
       $data .= fgets($handle, 4096);
   }//end while
   fclose($handle);
}//end if

if(!constantDefined($bname)) {
    $FreeBlockName = $bname;
}
else {
    $FreeBlockName = constant($bname);
}
echo '<strong>'. $FreeBlockName .'</strong>
	<form id="form1" name="form1" method="post" action="">
	  <span id="sprytextarea1">
	  <textarea class="editor" name="Partner" id="Partner" cols="30" rows="20">'.$data.'</textarea>
	  <span class="textareaRequiredMsg">'. (Avalueisrequired).'</span></span>
		<br/>
		<input class="submit" type="submit" name="SubmitSavePartner" id="SubmitSavePartner" value="'. (save).'" />
		</form>
		<script type="text/javascript">
		<!--
		var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
		//-->
		</script>
		';

?>