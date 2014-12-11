<?php
$CommentDate = date("Y-m-d H:i:s");

if(isset($_POST['SubmitaddCom'])){
	echo "&nbsp;";
	
	if(isset($_POST['theComment'])){
		$theComment=PostFilter($_POST['theComment']);
	}
	//echo $theComment;
	
	if(isset($_POST['IdNews'])){
		$IdNews=PostFilter($_POST['IdNews']);
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
		$IdMedia = InputFilter($_GET['galid']);
		$Date = date("Y-m-d H:i:s");
		$DB = new db();
		$UserId = $DB->get_var('SELECT `UserId` FROM `users` WHERE `NickName`="'.$NickName.'";')	;
		$IdCmnt = GenerateID('galleryfav','IdCmnt'); ;
		$Comment = PostFilter($_POST['theComment']);
		
		$db = new db();
		$db->query("insert into `galleryfav`(`IdCmnt`,`IdMedia`,`UserId`,`Comment`,`Date`) 
					values('".$IdCmnt."','".$IdMedia."','".$UserId."','".$Comment."','".$Date."')");
		$BackLink  = CreateLink('',array('Prog','show','galid'),array('gallery','all',$IdMedia));
		$BackLink  = '<a href="'.$BackLink.'" title=""/>'. (backToTheMedia).'</a>';
		echo  (InsertNewMediaCommentsuccufully) ."<br/>".$BackLink;
	}
	else{
		echo '<div class="err">'. CaptchaErr.'</div>';
		$Code=md5(rand(1,999999999999));
		$Code=substr($Code,1,5);
		echo '<form id="formaddCom" name="formaddCom" method="post" action="">
		<br/>
		'. (GalComment).'<br/><span id="sprytextarea1">
		<textarea class="editor" name="theComment">'.$theComment.'</textarea>
		
		<input type="hidden" name="IdMedia" value="' . $IdMedia . '" /><br/>'. (InputCode).'&nbsp;
		<img src="images/captcha.php" alt=""/> &nbsp;'. (here).' 
		<input name="CodePic" type="text" size="12" maxlength="35" class="text" />
		<input class="submit" name="SubmitaddCom" type="submit" value="'.  (submit) .'" /><br/>
		</form><br/>';
	}//end if
}
else{
	$Code=md5(rand(1,999999999999));
	$Code=substr($Code,1,5);
	echo '<form id="formaddCom" name="formaddCom" method="post" action="">
	'. (GalComment).'<br/>
	<span id="sprytextarea1">
		<textarea class="editor" name="theComment" ></textarea>
	</span>
	<input type="hidden" name="IdMedia" value="' . $IdMedia . '" /><br/>
	<input type="hidden" name="HidCode" value="'.$Code.'" />'. (InputCode).'&nbsp; 
	<img src="images/captcha.php" alt=""/> &nbsp;'. (here).' 
	<input name="CodePic" type="text" size="12" maxlength="35" class="text" />
	<input class="submit" name="SubmitaddCom" type="submit" value="'.  (submit) .'" /><br/>
	</form><br/>';

}
?>