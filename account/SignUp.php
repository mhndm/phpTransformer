<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  . 
*	File Name:  .<font face="Courier New, Courier, mono"></font>
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php if (!isset($project)){header("location: ../../");} ?>

<script language="JavaScript" type="text/JavaScript">
<!--

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' <?php echo  (MustContainanEmailAddress); ?>.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' <?php echo  (MustMontainANumber); ?>.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' <?php echo  (MustContainANumberBetween); ?> '+min+' <?php echo  (Aand); ?> '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' <?php echo  (isRequired); ?>.\n'; }
  } if (errors) alert('<?php echo  (TheFollowingErrorsOccurred); ?>:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<center>
<?php

$Err=false;

//UserNameErr
if(isset($_POST['UserName'])){
	if(MinField($_POST['UserName'])){
		$UserNameErr='<img alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$UserNameErr='<a href="javascript:void(0)" title="'. (UserNameErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a>';
		$Err=true;
		//echo "err UserName";
	}//end if
	$UserName=PostFilter($_POST['UserName']);
}
else{
	$UserNameErr="";
	$UserName="";
}//end if

//ParentNameErr
if(isset($_POST['ParentName'])){
	if(MinField($_POST['ParentName'])){
		$ParentNameErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$ParentNameErr='<a href="javascript:void(0)" title="'. (ParentNameErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
		$Err=true;
		//echo "err ParentName";
	}//end if
	$ParentName=PostFilter($_POST['ParentName']);
}
else{
	$ParentNameErr="";
	$ParentName="";
}//end if

//FamNameErr
if(isset($_POST['FamName'])){
	if(MinField($_POST['FamName'])){
		$FamNameErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$FamNameErr='<a href="javascript:void(0)" title="'. (FamNameErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
		$Err=true;
		//echo "err FamName";
	}//end if
	$FamName=PostFilter($_POST['FamName']);
}
else{
	$FamNameErr="";
	$FamName="";
}//end if

//NickNameErr
if(isset($_POST['NickName'])){
	if(ValidUser($_POST['NickName'])){
		$NickNameErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
		$NickName=PostFilter($_POST['NickName']);
	}
	else{
		$NickNameErr='<a href="javascript:void(0)" title="'. (NickNameErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
		$Err=true;
		$NickName="";
		//echo "err NickName";
	}//end if
}
else{
	$NickNameErr="";
	$NickName="";
}//end if

//PassWordErr
if(isset($_POST['PassWord'])){
	if($_POST['PassWord']){
		$PassWordErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$PassWordErr='<img border="0" alt="No" title="Err" src="Programs/account/images/no.gif"/> ';
	}//end if
	$PassWord=PostFilter($_POST['PassWord']);
}
else{
	$PassWordErr="";
	$PassWord="";
}//end if

//RePassWordErr
if(isset($_POST['RePassWord'])){
	if($_POST['RePassWord']){
		$RePassWordErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$RePassWordErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		
		$Err=true;
	}//end if
	$RePassWord=PostFilter($_POST['RePassWord']);
}
else{
	$RePassWordErr="";
	$RePassWord="";
}//end if

//UserMailErr
if(isset($_POST['UserMail'])){
	if(check_email($_POST['UserMail'])){
		$UserMailErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$UserMailErr='<a href="javascript:void(0)" title="'. (UserMailErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
		$Err=true;
		//echo "err UserMail";
	}//end if
	$UserMail=PostFilter($_POST['UserMail']);
}
else{
	$UserMailErr="";
	$UserMail="";
}//end if

//ReUserMailErr
if(isset($_POST['ReUserMail'])){
	if(check_email($_POST['ReUserMail'])){
		$ReUserMailErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$ReUserMailErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		$Err=true;
		//echo "err ReUserMail";
	}//end if
	$ReUserMail=PostFilter($_POST['ReUserMail']);
}
else{
	$ReUserMailErr="";
	$ReUserMail="";
}//end if


//Hobies

if(isset($_POST['Hobies'])){
	if($_POST['Hobies']){
		$HobiesErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$HobiesErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		echo "err Hobies";
		*/
	}//end if
	$Hobies=PostFilter($_POST['Hobies']);
}
else{
	$HobiesErr="";
	$Hobies="";
}//end if

//Job
if(isset($_POST['Job'])){
	if($_POST['Job']){
		$JobErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$JobErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		echo "err Job";
		*/
	}//end if
	$Job=PostFilter($_POST['Job']);
}
else{
	$JobErr="";
	$Job="";
}//end if

//Education 
if(isset($_POST['Education'])){
	if($_POST['Education']){
		$EducationErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$EducationErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		echo "err Education";
		*/
	}//end if
	$Education=PostFilter($_POST['Education']);
}
else{
	$EducationErr="";
	$Education="";
}//end if

//UserSite 
if(isset($_POST['UserSite'])){
	if($_POST['UserSite']){
		$UserSiteErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$UserSiteErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		echo "err UserSite";
		*/
	}//end if
	$UserSite=PostFilter($_POST['UserSite']);
}
else{
	$UserSiteErr="";
	$UserSite="";
}//end if

//UserSign
if(isset($_POST['UserSign'])){
	if($_POST['UserSign']){
		$UserSignErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$UserSignErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$UserSign=PostFilter($_POST['UserSign']);
}
else{
	$UserSignErr="";
	$UserSign="";
}//end if

//town
if(isset($_POST['town'])){
	if(MinField($_POST['town'])){
		$townErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$townErr='<a href="javascript:void(0)" title="'. (townErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		
		$Err=true;
		
	}//end if
	$town=PostFilter($_POST['town']);
}
else{
	$townErr="";
	$town="";
}//end if

//Rue
if(isset($_POST['Rue'])){
	if($_POST['Rue']){
		$RueErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$RueErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$Rue=PostFilter($_POST['Rue']);
}
else{
	$RueErr="";
	$Rue="";
}//end if

//AddDetails
if(isset($_POST['AddDetails'])){
	if($_POST['AddDetails']){
		$AddDetailsErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$AddDetailsErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$AddDetails=PostFilter($_POST['AddDetails']);
}
else{
	$AddDetailsErr="";
	$AddDetails="";
}//end if

//CodePostal
if(isset($_POST['CodePostal'])){
	if($_POST['CodePostal']){
		$CodePostalErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$CodePostalErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$CodePostal=PostFilter($_POST['CodePostal']);
}
else{
	$CodePostalErr="";
	$CodePostal="";
}//end if

//ZipCode
if(isset($_POST['ZipCode'])){
	if($_POST['ZipCode']){
		$ZipCodeErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$ZipCodeErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$ZipCode=PostFilter($_POST['ZipCode']);
}
else{
	$ZipCodeErr="";
	$ZipCode="";
}//end if

//PhoneNbr
if(isset($_POST['PhoneNbr'])){
	if($_POST['PhoneNbr']){
		$PhoneNbrErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$PhoneNbrErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$PhoneNbr=PostFilter($_POST['PhoneNbr']);
}
else{
	$PhoneNbrErr="";
	$PhoneNbr="";
}//end if

//CellNbr
if(isset($_POST['CellNbr'])){
	if($_POST['CellNbr']){
		$CellNbrErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$CellNbrErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$CellNbr=PostFilter($_POST['CellNbr']);
}
else{
	$CellNbrErr="";
	$CellNbr="";
}//end if

//UserPic
if(isset($_POST['UserPic'])){
	if($_POST['UserPic']){
		$UserPicErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$UserPicErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$UserPic=PostFilter($_POST['UserPic']);
}
else{
	$UserPicErr="";
	$UserPic="";
}//end if


//BirthDate_Year
if(isset($_POST['BirthDate_Year'])){
	if($_POST['BirthDate_Year']){
		$BirthDate_YearErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$BirthDate_YearErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$BirthDate_Year=PostFilter($_POST['BirthDate_Year']);
}
else{
	$BirthDate_YearErr="";
	$BirthDate_Year="";
}//end if

//BirthDate_Month
if(isset($_POST['BirthDate_Month'])){
	if($_POST['BirthDate_Month']){
		$BirthDate_MonthErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$BirthDate_MonthErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$BirthDate_Month=PostFilter($_POST['BirthDate_Month']);
}
else{
	$BirthDate_MonthErr="";
	$BirthDate_Month="";
}//end if

//BirthDate_Day
if(isset($_POST['BirthDate_Day'])){
	if($_POST['BirthDate_Day']){
		$BirthDate_DayErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$BirthDate_DayErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$BirthDate_Day=PostFilter($_POST['BirthDate_Day']);
}
else{
	$BirthDate_DayErr="";
	$BirthDate_Day="";
}//end if

//BirthDate_Day
if(isset($_POST['Sex'])){
	if($_POST['Sex']){
		$SexErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$SexErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$Sex=PostFilter($_POST['Sex']);
}
else{
	$SexErr="";
	$Sex="";
}//end if

//TimeFormat
if(isset($_POST['TimeFormat'])){
	if($_POST['TimeFormat']){
		$TimeFormatErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$TimeFormatErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$TimeFormat=PostFilter($_POST['TimeFormat']);
}
else{
	$TimeFormatErr="";
	$TimeFormat="";
}//end if

//PrefTime
if(isset($_POST['PrefTime'])){
	if($_POST['PrefTime']){
		$PrefTimeErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$PrefTimeErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$PrefTime=PostFilter($_POST['PrefTime']);
}
else{
	$PrefTimeErr="";
	$PrefTime="";
}//end if

//PrefLang
if(isset($_POST['PrefLang'])){
	if($_POST['PrefLang']){
		$PrefLangErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$PrefLangErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$PrefLang=PostFilter($_POST['PrefLang']);
}
else{
	$PrefLangErr="";
	$PrefLang="";
}//end if

//CookieLife
if(isset($_POST['CookieLife'])){
	if($_POST['CookieLife']){
		$CookieLifeErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$CookieLifeErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$CookieLife=PostFilter($_POST['CookieLife']);
}
else{
	$CookieLifeErr="";
	$CookieLife="";
}//end if

//PrefThem
if(isset($_POST['PrefThem'])){
	if($_POST['PrefThem']){
		$PrefThemErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
	}
	else{
		$PrefThemErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		/*
		$Err=true;
		*/
	}//end if
	$PrefThem=PostFilter($_POST['PrefThem']);
}
else{
	$PrefThemErr="";
	$PrefThem="";
}//end if

//WorkPolicy
if(isset($_POST['Submit'])){
	if(isset($_POST['WorkPolicy'])){
		$WorkPolicyErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
		$WorkPolicy=PostFilter($_POST['WorkPolicy']);
	}
	else{
		$WorkPolicyErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		$WorkPolicy="";
		$Err=true;
	}//end if
}
else{
	$WorkPolicyErr="";
	$WorkPolicy="";
}
//SiteUsePolicy
if(isset($_POST['Submit'])){
	if(isset($_POST['SiteUsePolicy'])){
		$SiteUsePolicyErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
		$SiteUsePolicy=PostFilter($_POST['SiteUsePolicy']);
	}
	else{
		$SiteUsePolicyErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		$Err=true;
		$SiteUsePolicy="";
	}//end if
}
else{
	$SiteUsePolicyErr="";
	$SiteUsePolicy="";
}
//PrivacyPolicy
if(isset($_POST['Submit'])){
	if(isset($_POST['PrivacyPolicy'])){
		$PrivacyPolicyErr='<img border="0" alt="Ok" title="Ok" src="Programs/account/images/ok.gif"/>';
		$PrivacyPolicy=PostFilter($_POST['PrivacyPolicy']);
	}
	else{
		$PrivacyPolicyErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
		$PrivacyPolicy="";	
		$Err=true;
	}//end if
}
else{
	$PrivacyPolicyErr="";
	$PrivacyPolicy="";
}
// PassWord and RePassWord  must be the same
if($RePassWord!=$PassWord){
	$Err=true;
	$PassWord="";
	$PassWordErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
	$RePassWord="";
	$RePassWordErr='<a href="javascript:void(0)" title="'. (PassWordErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
}

if(isset($_POST['Contry'])){
	$Contry = PostFilter($_POST['Contry']);
}//end if

// UserMail and ReUserMail  must be the same
if($ReUserMail!=$UserMail){
	$Err=true;
	$UserMail="";
	$UserMailErr='<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>';
	$ReUserMail="";
	$ReUserMailErr='<a href="javascript:void(0)" title="'. (ReUserMailErrDesk).'"><img border="0" alt="No" title="" src="Programs/account/images/no.gif"/></a> ';
}

//Gmt
if(isset($_POST['Gmt'])){
	$Gmt=PostFilter($_POST['Gmt']);
}
else{
	$Gmt="";
}
global $OpenRegister;
//if admin open the registrations OpenRegister
if($OpenRegister=="1"){

// Chargement de la classe upload
require_once('includes/upload.class.php');
// Instanciation d'un nouvel objet "upload"
$Upload = new Upload();


	//chosing signup or signup success  or new registeration
	if(isset($_POST['Submit'])){

		if($Err){
			//err in signup
			echo '<span>'. (AnError).'</span ><br />';
			include_once("Programs/account/SignUpForm.php");
		}
		else{
			// signup success
			/* start upload */
			// Si vous voulez renommer le fichier...
		   // $Upload-> Filename     = FromUtf($NickName);
		    $Upload-> Filename     = $NickName;
		    // Si vous voulez ajouter un pr�fixe au nom du fichier...
		    //$Upload-> Prefixe = 'pre_';
		    // Si vous voulez ajouter un suffixe au nom du fichier...
		    //$Upload-> Suffice = '_suf';
		    // Pour changer le mode d'�criture (entre 0 et 3)
		    //$Upload-> WriteMode    = 0;
		    // Pour filtrer les fichiers par extension
		    $Upload-> Extension = '.gif;.jpg;.jpeg;.bmp;.png';
		    // Pour filtrer les fichiers par ent�te
		    //$Upload-> MimeType  = 'image/gif;image/pjpeg;image/bmp;image/x-png'; 
		    // Pour tester la largeur / hauteur d'une image
		    $Upload-> ImgMaxHeight = 100;
		    $Upload-> ImgMaxWidth  = 100;
		    //$Upload-> ImgMinHeight = 100;
		    //$Upload-> ImgMinWidth  = 100;
		    // Pour v�rifier la page appelante
		    //$Upload-> CheckReferer = 'http://mondomaine/mon_chemin/mon_fichier.php';
		    // Pour g�n�rer une erreur si les champs sont obligatoires
		    //$Upload-> Required     = false;
		    // Pour interdire automatiquement tous les fichiers consid�r�s comme "dangereux"
		    $Upload-> SecurityMax  = true;
		    // D�finition du r�pertoire de destination
		    $Upload-> DirUpload    = "images/avatars/";
		    // On lance la proc�dure d'upload
		    $Upload-> Execute();
		    // Gestion erreur / succ�s
		    if ($UploadError) {
				$UserPic="";
		        $UserPicErr= '<img border="0" alt="No" title="" src="Programs/account/images/no.gif"/>'; 
		        //print_r($Upload-> GetError());
		    } else {
				//print 'Upload effectu�e avec succ�s :<br>';
				if(isset($Upload->Infos[1]['nom'])){
					$UserPic="images/avatars/". ($Upload->Infos[1]['nom']);
				}
				else{
					$UserPic="";
				}
		    }
			//end upload block
			//if AdminRegOk is true 
			global $AdminRegOk;
			$UserId=GenerateID("users","UserId");
			$GroupId="20070000001";
			$ConfirmCode =md5(date("Y-m-d").$UserId.rand(1, 9999999999));
			//2007-05-10
			$BirthDate =$BirthDate_Year."-".$BirthDate_Month."-".$BirthDate_Day;
			//2007-05-10 21:45:07
			$LastLogin =date("Y-m-d H:i:s") ;
			$LastIP = $_SERVER['REMOTE_ADDR'];
			$Banned ="0";$Points ="0";$Active ="0";
			$RegDate =date("Y-m-d H:i:s");
			$allowHtml ="0";$allowBBcode ="0";$allowSmiles ="0";$allowAvatar ="1";
			$TimeFormat=str_replace("/", "-",$TimeFormat);
			$TimeFormat.=" H:i:s";
			$PassWord =md5($PassWord);
			$CookieLife= CookieLife($CookieLife);
			
			if($AdminRegOk=="1"){
				// admin must accept, insert new account with status off, and send alert to the  admin, when admin ok send link confirm to the user
				//add new record for new user
				$InsertQwery="INSERT INTO `users` ( `UserId` , `GroupId` , `TimeFormat` , `UserName` , `NickName` , `ParentName` , `FamName` , `BirthDate` , `Sex` , `Gmt` , `Contry` , `town` , `Rue` , `AddDetails` , `CodePostal` , `ZipCode` , `PhoneNbr` , `CellNbr` , `PassWord` , `LastLogin` , `LastIP` , `Hobies` , `Job` , `Education` , `PrefLang` , `PrefTime` , `CookieLife` , `UserPic` , `UserMail` , `UserSite` , `Banned` , `PrefThem` , `UserSign` , `Points` , `Active` , `RegDate` , `allowHtml` , `allowBBcode` , `allowSmiles` , `allowAvatar` , `ConfirmCode` )";
				//converting " and '   to code  htmlentities( , ENT_QUOTES)
				$InsertQwery.=" VALUES ('".htmlentities($UserId, ENT_QUOTES, 'utf-8')."', '".htmlentities($GroupId , ENT_QUOTES, 'utf-8')."', '".htmlentities($TimeFormat , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserName , ENT_QUOTES, 'utf-8')."', '".htmlentities($NickName , ENT_QUOTES, 'utf-8')."', '".htmlentities($ParentName , ENT_QUOTES, 'utf-8')."', '".htmlentities($FamName , ENT_QUOTES, 'utf-8')."', '".htmlentities($BirthDate , ENT_QUOTES, 'utf-8')."', '".htmlentities($Sex , ENT_QUOTES, 'utf-8')."', '".htmlentities($Gmt , ENT_QUOTES, 'utf-8')."', '".htmlentities($Contry , ENT_QUOTES, 'utf-8')."', '".htmlentities($town , ENT_QUOTES, 'utf-8')."', '".htmlentities($Rue , ENT_QUOTES, 'utf-8')."', '".htmlentities($AddDetails , ENT_QUOTES, 'utf-8')."', '".htmlentities($CodePostal , ENT_QUOTES, 'utf-8')."', '".htmlentities($ZipCode , ENT_QUOTES, 'utf-8')."', '".htmlentities($PhoneNbr , ENT_QUOTES, 'utf-8')."', '".htmlentities($CellNbr , ENT_QUOTES, 'utf-8')."', '".htmlentities($PassWord , ENT_QUOTES, 'utf-8')."', '".htmlentities($LastLogin , ENT_QUOTES, 'utf-8')."', '".htmlentities($LastIP , ENT_QUOTES, 'utf-8')."', '".htmlentities($Hobies , ENT_QUOTES, 'utf-8')."', '".htmlentities($Job , ENT_QUOTES, 'utf-8')."', '".htmlentities($Education , ENT_QUOTES, 'utf-8')."', '".htmlentities($PrefLang , ENT_QUOTES, 'utf-8')."', '".htmlentities($PrefTime , ENT_QUOTES, 'utf-8')."', '".htmlentities($CookieLife , ENT_QUOTES, 'utf-8')."', '".$UserPic."', '".htmlentities($UserMail , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserSite , ENT_QUOTES, 'utf-8')."', '".htmlentities($Banned , ENT_QUOTES, 'utf-8')."', '".htmlentities($PrefThem , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserSign , ENT_QUOTES, 'utf-8')."', '".htmlentities($Points , ENT_QUOTES, 'utf-8')."', '".htmlentities($Active , ENT_QUOTES, 'utf-8')."', '".htmlentities($RegDate , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowHtml , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowBBcode , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowSmiles , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowAvatar , ENT_QUOTES, 'utf-8')."', '".htmlentities($ConfirmCode , ENT_QUOTES, 'utf-8')."');";
				SqlConnect();

				global $conn,$Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName,  $TotalRecords, $Rows;
					$RSInsert = mysqli_query($conn,$InsertQwery) ;	
					//echo $InsertQwery;

				echo  (SuccessSignup);
			}
			else{
				//direct register without admin ok, insert new account with sending confirm link to the mail user
				//add new record for new user
				$Active ="1";
				$InsertQwery="INSERT INTO `users` ( `UserId` , `GroupId` , `TimeFormat` , `UserName` , `NickName` , `ParentName` , `FamName` , `BirthDate` , `Sex` , `Gmt` , `Contry` , `town` , `Rue` , `AddDetails` , `CodePostal` , `ZipCode` , `PhoneNbr` , `CellNbr` , `PassWord` , `LastLogin` , `LastIP` , `Hobies` , `Job` , `Education` , `PrefLang` , `PrefTime` , `CookieLife` , `UserPic` , `UserMail` , `UserSite` , `Banned` , `PrefThem` , `UserSign` , `Points` , `Active` , `RegDate` , `allowHtml` , `allowBBcode` , `allowSmiles` , `allowAvatar` , `ConfirmCode` )";
				//converting " and '   to code  htmlentities( , ENT_QUOTES)
				$InsertQwery.=" VALUES ('".htmlentities($UserId, ENT_QUOTES, 'utf-8')."', '".htmlentities($GroupId , ENT_QUOTES, 'utf-8')."', '".htmlentities($TimeFormat , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserName , ENT_QUOTES, 'utf-8')."', '".htmlentities($NickName , ENT_QUOTES, 'utf-8')."', '".htmlentities($ParentName , ENT_QUOTES, 'utf-8')."', '".htmlentities($FamName , ENT_QUOTES, 'utf-8')."', '".htmlentities($BirthDate , ENT_QUOTES, 'utf-8')."', '".htmlentities($Sex , ENT_QUOTES, 'utf-8')."', '".htmlentities($Gmt , ENT_QUOTES, 'utf-8')."', '".htmlentities($Contry , ENT_QUOTES, 'utf-8')."', '".htmlentities($town , ENT_QUOTES, 'utf-8')."', '".htmlentities($Rue , ENT_QUOTES, 'utf-8')."', '".htmlentities($AddDetails , ENT_QUOTES, 'utf-8')."', '".htmlentities($CodePostal , ENT_QUOTES, 'utf-8')."', '".htmlentities($ZipCode , ENT_QUOTES, 'utf-8')."', '".htmlentities($PhoneNbr , ENT_QUOTES, 'utf-8')."', '".htmlentities($CellNbr , ENT_QUOTES, 'utf-8')."', '".htmlentities($PassWord , ENT_QUOTES, 'utf-8')."', '".htmlentities($LastLogin , ENT_QUOTES, 'utf-8')."', '".htmlentities($LastIP , ENT_QUOTES, 'utf-8')."', '".htmlentities($Hobies , ENT_QUOTES, 'utf-8')."', '".htmlentities($Job , ENT_QUOTES, 'utf-8')."', '".htmlentities($Education , ENT_QUOTES, 'utf-8')."', '".htmlentities($PrefLang , ENT_QUOTES, 'utf-8')."', '".htmlentities($PrefTime , ENT_QUOTES, 'utf-8')."', '".htmlentities($CookieLife , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserPic , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserMail , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserSite , ENT_QUOTES, 'utf-8')."', '".htmlentities($Banned , ENT_QUOTES, 'utf-8')."', '".htmlentities($PrefThem , ENT_QUOTES, 'utf-8')."', '".htmlentities($UserSign , ENT_QUOTES, 'utf-8')."', '".htmlentities($Points , ENT_QUOTES, 'utf-8')."', '".htmlentities($Active , ENT_QUOTES, 'utf-8')."', '".htmlentities($RegDate , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowHtml , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowBBcode , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowSmiles , ENT_QUOTES, 'utf-8')."', '".htmlentities($allowAvatar , ENT_QUOTES, 'utf-8')."', '".htmlentities($ConfirmCode , ENT_QUOTES, 'utf-8')."');";
				SqlConnect();

				global $conn,$Recordset, $SqlType, $dbHostName, $dbUserName, $dbPass, $dbBaseName,  $TotalRecords, $Rows;
					$RSInsert = mysqli_query($conn,$InsertQwery) ;	
					//echo $InsertQwery;

				// create activate link
				$Vars=array("Prog","acnt","actvcode","user");
				$Vals=array("account","activate",$ConfirmCode,$NickName );
				
				$ActivateLink = CreateLink("",$Vars,$Vals);
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				global $AdminMail,$WebSiteName, $WebSiteName, $AdminMail;
				
				$From     = $AdminMail;
				$FromName = $WebSiteName;
				$AddAddress[0]=$UserMail;
				$AddAddress[1]=$NickName;
				$Subject =  (eMailSubjectNewUserRegister).$WebSiteName;
				$Body    = '<div dir="'. (DirHtml).'" >'. (DearMr).$UserName." ".$FamName."<br/>". (eMailBodyNewUserRegister).'<br><a href="'.$ActivateLink.'" target="_blank">'.$ActivateLink.'<a/>'."</div>". (EmailSignature);
				echo SendEmail($From,$FromName, $AddAddress, $Subject, $Body);
				echo "<br/>";
				echo  (SuccessSignupWihout);
				
			}
			
		}//end if
	}
	else{
		// new registeration
		include_once("Programs/account/SignUpForm.php");
		
	}//end if
}
else{
	echo  (RegistrationClosed) ;
}//end if
	

?>