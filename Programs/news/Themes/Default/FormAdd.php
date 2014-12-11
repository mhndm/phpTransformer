<script src="Programs/news/Themes/Default/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="Programs/news/Themes/Default/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="Programs/news/Themes/Default/SpryValidationTextField.js" type="text/javascript"></script>
<link href="Programs/news/Themes/Default/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<?php
$CommentDate = date("Y-m-d H:i:s");
if(isset($_POST['SubmitaddCom'])){
	echo "&nbsp;";
	if(isset($_POST['CommentTitle'])){
		$CommentTitle = PostFilter($_POST['CommentTitle']);
	}
        else{
            $CommentTitle = '';
        }
	//echo $CommentTitle;
	
	if(isset($_POST['theComment'])){
		$theComment = PostFilter($_POST['theComment']);
	}
        else{
            $theComment = '';
        }
	//echo $theComment;
	
	if(isset($_POST['IdNews'])){
		$IdNews = PostFilter($_POST['IdNews']);
	}
        else{
            $IdNews = '';
        }
	//echo $IdNews;
	
	if(isset($_SESSION['captcha'])){
		$captcha = $_SESSION['captcha'];
	}
	//echo $HidCode;
	
	if(isset($_POST['CodePic'])){
		$CodePic = PostFilter($_POST['CodePic']);
	}
	//echo $CodePic;	
	
	if($captcha == $CodePic){

			global $Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName, $conn, $TotalRecords, $Rows;
			$query = "INSERT INTO `newscomment` 
					 ( `IdNews` , `CommentTitle` , `UserId` , `cc` , `CommentDate` , `theComment`,`idComment` )
					 VALUES ('".$IdNews."',
							'".$CommentTitle."',
							'".$UserId."',
							'".$cc."',
							'".$CommentDate."', 
							'".$theComment."',
							'".GenerateID('newscomment','idComment')."')
							;";
			
			$Recordset = mysqli_query( $conn,$query) ;
			$idnews = InputFilter($_GET['idnews']);
			$Vars	= array("Prog","ns","idnews");
			$Vals	= array("news","details",$idnews);
			$BackLink  = CreateLink("",$Vars,$Vals);
			$BackLink  = '<a href="'.$BackLink.'" title=""/>'. (backToTheNews).'</a>';
			echo  (InsertNewCommentsuccufully) ."<br/>".$BackLink;
			

	}
	else{
		echo  '<div class="err">'. CaptchaErr.'</div>';
		$Code=md5(rand(1,999999999999));
		$Code=substr($Code,1,5);
		echo '<form id="formaddCom" name="formaddCom" method="post" action="">
		'. (CommentTitle).' 
		<br/><span id="sprytextfield1">
		<input value="'.$CommentTitle.'" type="text" name="CommentTitle" size="65" maxlength="100" />
		<span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
		<br/>
		'. (theComment).'<br/><span id="sprytextarea1">
		<textarea name="theComment" style="width:400px;height:200px;">'.$theComment.'</textarea>
		<span class="textareaRequiredMsg">'. (Avalueisrequired).'</span></span>
		<input type="hidden" name="IdNews" value="' . $IdNews . '" /><br/>'. (InputCode).'&nbsp;
		<img src="images/captcha.php" alt=""/> &nbsp;'. (here).' 
		<input name="CodePic" style="width:50px;" type="text" size="12" maxlength="35" class="text" /> 
		<input class="btn btn-primary" name="SubmitaddCom" type="submit" value="'.  (submit) .'" /><br/>
		</form><br/>';
	}//end if
}
else{
	$Code=md5(rand(1,999999999999));
	$Code=substr($Code,1,5);
	echo '<form id="formaddCom" name="formaddCom" method="post" action="">
	'. (CommentTitle).' 
	<br/>
	<span id="sprytextfield1">
	<input type="text" name="CommentTitle" size="65" maxlength="100" />
	<span class="textfieldRequiredMsg">'. (Avalueisrequired).'</span></span>
	<br/>
	'. (theComment).'<br/><span id="sprytextarea1">
	<textarea name="theComment" style="width:400px;height:200px;" ></textarea>
	<span class="textareaRequiredMsg">'. (Avalueisrequired).'</span></span>
	<input type="hidden" name="IdNews" value="' . $IdNews . '" /><br/>
	<input type="hidden" name="HidCode" value="'.$Code.'" />'. (InputCode).'&nbsp; 
	<img src="images/captcha.php" alt=""/> &nbsp;'. (here).' 
	<input style="width:50px;" name="CodePic" type="text" size="5" maxlength="5" class="text" /> 
	<input class="btn btn-primary" name="SubmitaddCom" type="submit" value="'.  (submit) .'" /><br/>
	</form><br/>';

}
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
</script>