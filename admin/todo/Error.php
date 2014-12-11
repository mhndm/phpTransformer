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
global $ThemeName,$Lang,$TinyDir ;
global  $UserId , $LastSession;

if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}

$Error  =' <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />
    <link rel="stylesheet" href="includes/elrte/elfinder/css/elfinder.css" type="text/css" media="screen" charset="utf-8" />

    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.'.MiniLang.'.js"          type="text/javascript" charset="utf-8"></script>

    <script src="includes/elrte/elfinder/js/elfinder.min.js"            type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elfinder/js/i18n/elfinder.'.MiniLang.'.js"    type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $().ready(function() {


            $("#elFinder a").delay(800).animate({"background-position" : "0 0"}, 300);
			
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "'.MiniLang.'",
                height   : 250,
                toolbar  : "maxi",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
                fmOpen : function(callback) {
                    $("<div  id=\'myelfinder\' />").elfinder({
                        url : "includes/elrte/elfinder/connectors/connector.php?id=' . $UserId . '&sess=' . $LastSession . '",
                        lang : "'.MiniLang.'",
                        dialog : { width : 900, modal : true, title : "'.Gallery.'" },
                        closeOnEditorCallback : true,
                        editorCallback : callback
                    })
                }
            }
            $(".editor").elrte(opts);
           
        })
    </script>

             <script language="javascript" type="text/javascript">
                        document.onkeydown = document.onkeypress = function (evt) {
                            if (!evt && window.event) {
                                evt = window.event;
                            }
                            var keyCode = evt.keyCode ? evt.keyCode :
                                evt.charCode ? evt.charCode : evt.which;
                            if (keyCode) {
                                if (evt.ctrlKey) {
                                    if(keyCode==83){
                                                            document.getElementById("SubmitErrorPage").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>';

//save error page
if(isset($_POST['SubmitErrorPage'])){
    if(!isset($_GET['subdo'])){
        $_GET['subdo'] = 'Error400';
    }
	$ErrNumber = InputFilter($_GET['subdo']);
	$ErrNumber = substr($ErrNumber,5,strlen($ErrNumber)-5);
	$ErrorPage = PostFilter($_POST['ErrorPage']);
	mysqli_query($conn,"update `errpages` set `ErrPage`='".$ErrorPage."' where `ErrNumber`='".$ErrNumber."';");
	$Error  .=  (SuccessSaveErrPage);
}//end if

$theList = SubIconLink("Error","Error400"). "<br/>"
		.SubIconLink("Error","Error401"). "<br/>"
		.SubIconLink("Error","Error403"). "<br/>"
		.SubIconLink("Error","Error404"). "<br/>"
		.SubIconLink("Error","Error500"). "<br/>";

if(isset($_GET['subdo'])){
	$ErrNmbr = InputFilter($_GET['subdo']);
	$ErrNmbr = substr($ErrNmbr,5,strlen($ErrNmbr)-5);
	//echo $ErrNmbr ;
	$theContent = ErrorPage($ErrNmbr);
}
else{
	$theContent =  ErrorPage("400");
}//end if	

//display error from db
$Error  .= get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$Error  = VarTheme("{todoImg}", "error.png",$Error  );
$Error  = VarTheme("{ThemeName}", $ThemeName,$Error  );
$Error  = VarTheme("{List}", $theList,$Error  );
$Error  = VarTheme("{Content}", $theContent,$Error  );

function ErrorPage($ErrNmbr){

	global $TotalRecords,$Rows,$Recordset ;
	
	ExcuteQuery("SELECT * from `errpages` where `ErrNumber`='".$ErrNmbr."' ;");
		if ($TotalRecords>0){
			$ErrPage = $Rows['ErrPage'];
			$ErrorDesc = 'Error'.$ErrNmbr.'Desc';
			$ErrorPage = '<strong>'. (constant($ErrorDesc)).'</strong><br/>';
			$ErrorPage .= '<form id="form1" name="formError" method="post" action="">
						  <textarea class="editor" name="ErrorPage" id="ErrorPage" cols="100" rows="20">
						  '.$ErrPage.'
						  </textarea>
						  <br/>
						  <div align="center">
						    <input class="submit" type="submit" name="SubmitErrorPage" id="SubmitErrorPage" value="'. (save).'" />
						    </div>
							 <br/>
						</form>';	
		}
		else{
			$ErrorPage = '';
		}//end if
	return $ErrorPage;
	
}//end if

?>