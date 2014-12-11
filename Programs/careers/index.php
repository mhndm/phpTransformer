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
<?php if (!isset($project)){header("location: ../../");} ?>
<?php
global $ThemeName,$CustomHead,$conn , $TitlePage ;
// Chargement de la classe upload
require_once('includes/upload.class.php');

$TitlePage .= ' .:. '. (NewCvFromWebsite);

$CustomHead .= '<script src="Programs/careers/Themes/'.$ThemeName.'/SpryValidationTextField.js" type="text/javascript"></script>
				<script src="Programs/careers/Themes/'.$ThemeName.'/SpryValidationCheckbox.js" type="text/javascript"></script>
				<link href="Programs/careers/Themes/'.$ThemeName.'/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
				<link href="Programs/careers/Themes/'.$ThemeName.'/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />';
echo '<b>'. (NewCvFromWebsite).'</b>';
$Theme = get_include_contents('Programs/careers/Themes/'.$ThemeName.'/theme.php');

if(isset($_POST['SendCvInfo'])){
			/* start upload */
			$Upload = new Upload();
			// Si vous voulez renommer le fichier...
		    $Upload-> Filename     = ValidFileName($_POST['FirstName']."_". $_POST['FatherName']."_".$_POST['FamilyName'].date("d_m_Y_H_i_s")) ;
		    // Pour filtrer les fichiers par extension
		    $Upload-> Extension = '.gif;.jpg;.jpeg;.bmp;.png';
		    // Pour interdire automatiquement tous les fichiers consid�r�s comme "dangereux"
		    $Upload-> SecurityMax  = true;
		    // D�finition du r�pertoire de destination
		    $Upload-> DirUpload    = "Programs/careers/images/";
		    // On lance la proc�dure d'upload
		    $Upload-> Execute();
			
				$FirstNameValue 		= PostFilter($_POST['FirstName']);
				$FatherNameValue 		= PostFilter($_POST['FatherName']);
				$MotherNameValue 		= PostFilter($_POST['MotherName']);
				$GrandFatherNameValue 	= PostFilter($_POST['GrandFatherName']);
				$FamilyNameValue 		= PostFilter($_POST['FamilyName']);
				$BirthDateValue 		= PostFilter($_POST['BirthDate']);
				$BirthLocationValue 	= PostFilter($_POST['BirthLocation']);
				
				if($_POST['Sex']=='1'){
					$SexValue = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$SexValue = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				
				$NationalityValue 		= PostFilter($_POST['Nationality']);
				$SegelNbrValue 			= PostFilter($_POST['SegelNbr']);
				$SegelLocationValue 	= PostFilter($_POST['SegelLocation']);
				$DamanNbrValue		 	= PostFilter($_POST['DamanNbr']);
				
				if($_POST['MaritalStatus']=='Celibate'){
					$celibateValue  = ' checked="checked" ';
				}
				else{
					$celibateValue  = '';
				}//end if
				if($_POST['MaritalStatus']=='Mariage'){
					$MariageValue = ' checked="checked" ';
				}
				else{
					$MariageValue = '';
				}//end if	
				if($_POST['MaritalStatus']=='Widower'){
					$WidowerValue = ' checked="checked" ';
				}
				else{
					$WidowerValue = '';
				}//end if
				if($_POST['MaritalStatus']=='Divorced'){
					$DivorcedValue = ' checked="checked" ';
				}
				else{
					$DivorcedValue = '';
				}//end if
				if($_POST['MaritalStatus']=='Fiance'){
					$FianceValue = ' checked="checked" ';
				}
				else{
					$FianceValue = '';
				}//end if

				
				$SpendName1Value		= PostFilter($_POST['SpendName1']);
				$Relative1Value		 	= PostFilter($_POST['Relative1']);
				
				if($_POST['Sex1']=='1'){
					$Sex1Value = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$Sex1Value = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				
				$BirthDate1Value		= PostFilter($_POST['BirthDate1']);
				$SpendName2Value		= PostFilter($_POST['SpendName2']);
				$Relative2Value			= PostFilter($_POST['Relative2']);
				if($_POST['Sex2']=='1'){
					$Sex2Value = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$Sex2Value = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				$BirthDate2Value		= PostFilter($_POST['BirthDate2']);
				$SpendName3Value		= PostFilter($_POST['SpendName3']);
				$Relative3Value			= PostFilter($_POST['Relative3']);
				if($_POST['Sex3']=='1'){
					$Sex3Value = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$Sex3Value = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				$BirthDate3Value		= PostFilter($_POST['BirthDate3']);
				$SpendName4Value		= PostFilter($_POST['SpendName4']);
				$Relative4Value			= PostFilter($_POST['Relative4']);
				if($_POST['Sex4']=='1'){
					$Sex4Value = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$Sex4Value = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				$BirthDate4Value		= PostFilter($_POST['BirthDate4']);
				$SpendName5Value		= PostFilter($_POST['SpendName5']);
				$SpendName6Value		= PostFilter($_POST['SpendName6']);
				if($_POST['Sex5']=='1'){
					$Sex5Value = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$Sex5Value = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				$BirthDate5Value		= PostFilter($_POST['BirthDate5']);
				$SpendName6Value		= PostFilter($_POST['SpendName6']);
				$Relative6Value			= PostFilter($_POST['Relative6']);
				if($_POST['Sex6']=='1'){
					$Sex6Value = '<option selected="selected" value="1">'. (male).'</option><option value="0">'. (female).'</option>';
				}
				else{
					$Sex6Value = '<option value="1">'. (male).'</option><option selected="selected" value="0">'. (female).'</option>';
				}//end if
				$BirthDate6Value		= PostFilter($_POST['BirthDate6']);
				$HealthStatusValue		= PostFilter($_POST['HealthStatus']);
				if(isset($_POST['Hearing'])){
					$HearingValue = ' checked="checked" ';
				}
				else{
					$HearingValue = "";
				}//end if
				if(isset($_POST['Viewing'])){
					$ViewingValue = ' checked="checked" ';
				}
				else{
					$ViewingValue = "";
				}//end if
				if(isset($_POST['Talking'])){
					$TalkingValue = ' checked="checked" ';
				}
				else{
					$TalkingValue = "";
				}//end if
				if(isset($_POST['DidUSmoke'])){
					if($_POST['DidUSmoke']=="yes"){
						$DidUSmokeYesValue		= ' checked="checked" ';
					}
					else{
						$DidUSmokeYesValue		= '';
					}//end if
					if($_POST['DidUSmoke']=="no"){
						$DidUSmokeNoValue		= '';
					}
					else{
						$DidUSmokeNoValue		= ' checked="checked" ';
					}//end if
				}
				else{
					$DidUSmokeYesValue		= '';
					$DidUSmokeNoValue		= '';
				}//end if
				if(isset($_POST['DidUDoObliging'])){
					if($_POST['DidUDoObliging']=="yes"){
						$DidUDoObligingYesValue		= ' checked="checked" ';
					}
					else{
						$DidUDoObligingYesValue		= '';
					}//end if
					if($_POST['DidUDoObliging']=="no"){
						$DidUDoObligingNoValue		= ' checked="checked" ';
					}
					else{
						$DidUDoObligingNoValue		= '';
					}//end if
				}
				else{
					$DidUDoObligingYesValue		= '';
					$DidUDoObligingNoValue		= '';
				}//end if

				$ObligingOtherValue		= PostFilter($_POST['ObligingOther']);
				$TownValue				= PostFilter($_POST['Town']);
				$RueValue				= PostFilter($_POST['Rue']);
				$BuildingValue			= PostFilter($_POST['Building']);
				$BuildOwnerValue		= PostFilter($_POST['BuildOwner']);
				$PhoneValue				= PostFilter($_POST['Phone']);
				$CellulaireValue		= PostFilter($_POST['Cellulaire']);
				$EmailValue				= PostFilter($_POST['Email']);
				$EducationLevel1Value	= PostFilter($_POST['EducationLevel1']);
				$Average1Value			= PostFilter($_POST['Average1']);
				$CertifecateFrom1Value	= PostFilter($_POST['CertifecateFrom1']);
				$CertifecateYear1Value	= PostFilter($_POST['CertifecateYear1']);
				$EducationLevel2Value	= PostFilter($_POST['EducationLevel2']);
				$Average2Value			= PostFilter($_POST['Average2']);
				$CertifecateFrom2Value	= PostFilter($_POST['CertifecateFrom2']);
				$CertifecateYear2Value	= PostFilter($_POST['CertifecateYear2']);
				$EducationLevel3Value	= PostFilter($_POST['EducationLevel3']);
				$Average3Value			= PostFilter($_POST['Average3']);
				$CertifecateFrom3Value	= PostFilter($_POST['CertifecateFrom3']);
				$CertifecateYear3Value	= PostFilter($_POST['CertifecateYear3']);
				$EducationLevel4Value	= PostFilter($_POST['EducationLevel4']);
				$Average14Value			= PostFilter($_POST['Average14']);
				$CertifecateFrom14Value	= PostFilter($_POST['CertifecateFrom14']);
				$CertifecateYear4Value	= PostFilter($_POST['CertifecateYear4']);
				$EducationLevel5Value	= PostFilter($_POST['EducationLevel5']);
				$Average5Value			= PostFilter($_POST['Average5']);
				$CertifecateFrom5Value	= PostFilter($_POST['CertifecateFrom5']);
				$CertifecateYear5Value	= PostFilter($_POST['CertifecateYear5']);
				$CycleName1Value		= PostFilter($_POST['CycleName1']);
				$SkillsFromCycle1Value	= PostFilter($_POST['SkillsFromCycle1']);
				$CycleFrom1Value		= PostFilter($_POST['CycleFrom1']);
				$CycleDate1Value		= PostFilter($_POST['CycleDate1']);
				$CycleName2Value		= PostFilter($_POST['CycleName2']);
				$CycleInterval2Value	= PostFilter($_POST['CycleInterval2']);
				$SkillsFromCycle12Value	= PostFilter($_POST['SkillsFromCycle12']);
				$CycleFrom2Value		= PostFilter($_POST['CycleFrom2']);
				$CycleName3Value		= PostFilter($_POST['CycleName3']);
				$CycleInterval3Value	= PostFilter($_POST['CycleInterval3']);
				$CycleDate2Value 		= PostFilter($_POST['CycleDate2']);
				$CycleInterval1Value	= PostFilter($_POST['CycleInterval1']);
				$SkillsFromCycle13Value	= PostFilter($_POST['SkillsFromCycle13']);
				$CycleFrom3Value		= PostFilter($_POST['CycleFrom3']);
				$CycleDate3Value		= PostFilter($_POST['CycleDate3']);
				$CycleName4Value		= PostFilter($_POST['CycleName4']);
				$CycleInterval4Value	= PostFilter($_POST['CycleInterval4']);
				$SkillsFromCycle14Value	= PostFilter($_POST['SkillsFromCycle14']);
				$CycleFrom4Value		= PostFilter($_POST['CycleFrom4']);
				$CycleDate4Value		= PostFilter($_POST['CycleDate4']);
				$CycleName5Value		= PostFilter($_POST['CycleName5']);
				$CycleInterval5Value	= PostFilter($_POST['CycleInterval5']);
				$SkillsFromCycle15Value	= PostFilter($_POST['SkillsFromCycle15']);
				$CycleFrom5Value		= PostFilter($_POST['CycleFrom5']);
				$CycleDate5Value		= PostFilter($_POST['CycleDate5']);
				$LangName1Value			= PostFilter($_POST['LangName1']);
				$LangName2Value			= PostFilter($_POST['LangName2']);
				$LangName3Value			= PostFilter($_POST['LangName3']);
				
				if(isset($_POST['ReadLang1'])){
					if($_POST['ReadLang1']=="ReadExcellent1"){
						$ReadExcellent1Value		= ' checked="checked" ';
					}
					else{
						$ReadExcellent1Value		= '';
					}//end if
					if($_POST['ReadLang1']=="ReadGood1"){
						$ReadGood1Value		= ' checked="checked" ';
					}
					else{
						$ReadGood1Value		= '';
					}//end if
					if($_POST['ReadLang1']=="ReadMoyen1"){
						$ReadMoyen1Value	= ' checked="checked" ';
					}
					else{
						$ReadMoyen1Value	= '';
					}//end if
					if($_POST['ReadLang1']=="ReadUnderMoyen1"){
						$ReadUnderMoyen1Value	= ' checked="checked" ';
					}
					else{
						$ReadUnderMoyen1Value	= '';
					}//end if
				}
				else{
					$ReadExcellent1Value		= '';
					$ReadGood1Value		= '';
					$ReadMoyen1Value	= '';
					$ReadUnderMoyen1Value	= '';
				}//end if
				
				if(isset($_POST['WriteLang1'])){
					if($_POST['WriteLang1']=="WriteExcellent1"){
						$WriteExcellent1Value	= ' checked="checked" ';
					}
					else{
						$WriteExcellent1Value	= '';
					}//end if
					if($_POST['WriteLang1']=="WriteGood1"){
						$WriteGood1Value	= ' checked="checked" ';
					}
					else{
						$WriteGood1Value	= '';
					}//end if
					if($_POST['WriteLang1']=="WriteMoyen1"){
						$WriteMoyen1Value	= ' checked="checked" ';
					}
					else{
						$WriteMoyen1Value	= '';
					}//end if
					if($_POST['WriteLang1']=="WriteUnderMoyen1"){
						$WriteUnderMoyen1Value	= ' checked="checked" ';
					}
					else{
						$WriteUnderMoyen1Value	= '';
					}//end if
				}
				else{
					$WriteExcellent1Value	= '';
					$WriteGood1Value	= '';
					$WriteMoyen1Value	= '';
					$WriteUnderMoyen1Value	= '';
				}//end if

				if(isset($_POST['SpeakLang1'])){
					if($_POST['SpeakLang1']=="SpeakExcellent1"){
						$SpeakExcellent1Value	= ' checked="checked" ';
					}
					else{
						$SpeakExcellent1Value	= '';
					}//end if
					if($_POST['SpeakLang1']=="SpeakGood1"){
						$SpeakGood1Value	= ' checked="checked" ';
					}
					else{
						$SpeakGood1Value	= '';
					}//end if
					if($_POST['SpeakLang1']=="SpeakMoyen1"){
						$SpeakMoyen1Value	= ' checked="checked" ';
					}
					else{
						$SpeakMoyen1Value	= '';
					}//end if
					if($_POST['SpeakLang1']=="SpeakUnderMoyen1"){
						$SpeakUnderMoyen1Value	= ' checked="checked" ';
					}
					else{
						$SpeakUnderMoyen1Value	= '';
					}//end if
				}
				else{
					$SpeakExcellent1Value	= '';
					$SpeakGood1Value	= '';
					$SpeakMoyen1Value	= '';
					$SpeakUnderMoyen1Value	= '';
				}//end if

				if(isset($_POST['ReadLang2'])){
					if($_POST['ReadLang2']=="ReadExcellent2"){
						$ReadExcellent2Value		= ' checked="checked" ';
					}
					else{
						$ReadExcellent2Value		= '';
					}//end if
					if($_POST['ReadLang2']=="ReadGood2"){
						$ReadGood2Value		= ' checked="checked" ';
					}
					else{
						$ReadGood2Value		= '';
					}//end if
					if($_POST['ReadLang2']=="ReadMoyen2"){
						$ReadMoyen2Value	= ' checked="checked" ';
					}
					else{
						$ReadMoyen2Value	= '';
					}//end if
					if($_POST['ReadLang2']=="ReadUnderMoyen2"){
						$ReadUnderMoyen2Value	= ' checked="checked" ';
					}
					else{
						$ReadUnderMoyen2Value	= '';
					}//end if
				}
				else{
					$ReadExcellent2Value		= '';
					$ReadGood2Value		= '';
					$ReadMoyen2Value	= '';
					$ReadUnderMoyen2Value	= '';
				}//end if
				
				if(isset($_POST['WriteLang2'])){
					if($_POST['WriteLang2']=="WriteExcellent2"){
						$WriteExcellent2Value	= ' checked="checked" ';
					}
					else{
						$WriteExcellent2Value	= '';
					}//end if
					if($_POST['WriteLang2']=="WriteGood2"){
						$WriteGood2Value	= ' checked="checked" ';
					}
					else{
						$WriteGood2Value	= '';
					}//end if
					if($_POST['WriteLang2']=="WriteMoyen2"){
						$WriteMoyen2Value	= ' checked="checked" ';
					}
					else{
						$WriteMoyen2Value	= '';
					}//end if
					if($_POST['WriteLang2']=="WriteUnderMoyen2"){
						$WriteUnderMoyen2Value	= ' checked="checked" ';
					}
					else{
						$WriteUnderMoyen2Value	= '';
					}//end if
				}
				else{
					$WriteExcellent2Value	= '';
					$WriteGood2Value	= '';
					$WriteMoyen2Value	= '';
					$WriteUnderMoyen2Value	= '';
				}//end if

				if(isset($_POST['SpeakLang2'])){
					if($_POST['SpeakLang2']=="SpeakExcellent2"){
						$SpeakExcellent2Value	= ' checked="checked" ';
					}
					else{
						$SpeakExcellent2Value	= '';
					}//end if
					if($_POST['SpeakLang2']=="SpeakGood2"){
						$SpeakGood2Value	= ' checked="checked" ';
					}
					else{
						$SpeakGood2Value	= '';
					}//end if
					if($_POST['SpeakLang2']=="SpeakMoyen2"){
						$SpeakMoyen2Value	= ' checked="checked" ';
					}
					else{
						$SpeakMoyen2Value	= '';
					}//end if
					if($_POST['SpeakLang2']=="SpeakUnderMoyen2"){
						$SpeakUnderMoyen2Value	= ' checked="checked" ';
					}
					else{
						$SpeakUnderMoyen2Value	= '';
					}//end if
				}
				else{
					$SpeakExcellent2Value	= '';
					$SpeakGood2Value	= '';
					$SpeakMoyen2Value	= '';
					$SpeakUnderMoyen2Value	= '';
				}//end if

				if(isset($_POST['ReadLang3'])){
					if($_POST['ReadLang3']=="ReadExcellent3"){
						$ReadExcellent3Value		= ' checked="checked" ';
					}
					else{
						$ReadExcellent3Value		= '';
					}//end if
					if($_POST['ReadLang3']=="ReadGood3"){
						$ReadGood3Value		= ' checked="checked" ';
					}
					else{
						$ReadGood3Value		= '';
					}//end if
					if($_POST['ReadLang3']=="ReadMoyen3"){
						$ReadMoyen3Value	= ' checked="checked" ';
					}
					else{
						$ReadMoyen3Value	= '';
					}//end if
					if($_POST['ReadLang3']=="ReadUnderMoyen3"){
						$ReadUnderMoyen3Value	= ' checked="checked" ';
					}
					else{
						$ReadUnderMoyen3Value	= '';
					}//end if
				}
				else{
					$ReadExcellent3Value		= '';
					$ReadGood3Value		= '';
					$ReadMoyen3Value	= '';
					$ReadUnderMoyen3Value	= '';
				}//end if
				
				if(isset($_POST['WriteLang3'])){
					if($_POST['WriteLang3']=="WriteExcellent3"){
						$WriteExcellent3Value	= ' checked="checked" ';
					}
					else{
						$WriteExcellent3Value	= '';
					}//end if
					if($_POST['WriteLang3']=="WriteGood3"){
						$WriteGood3Value	= ' checked="checked" ';
					}
					else{
						$WriteGood3Value	= '';
					}//end if
					if($_POST['WriteLang3']=="WriteMoyen3"){
						$WriteMoyen3Value	= ' checked="checked" ';
					}
					else{
						$WriteMoyen3Value	= '';
					}//end if
					if($_POST['WriteLang3']=="WriteUnderMoyen3"){
						$WriteUnderMoyen3Value	= ' checked="checked" ';
					}
					else{
						$WriteUnderMoyen3Value	= '';
					}//end if
				}
				else{
					$WriteExcellent3Value	= '';
					$WriteGood3Value	= '';
					$WriteMoyen3Value	= '';
					$WriteUnderMoyen3Value	= '';
				}//end if

				if(isset($_POST['SpeakLang3'])){
					if($_POST['SpeakLang3']=="SpeakExcellent3"){
						$SpeakExcellent3Value	= ' checked="checked" ';
					}
					else{
						$SpeakExcellent3Value	= '';
					}//end if
					if($_POST['SpeakLang3']=="SpeakGood3"){
						$SpeakGood3Value	= ' checked="checked" ';
					}
					else{
						$SpeakGood3Value	= '';
					}//end if
					if($_POST['SpeakLang3']=="SpeakMoyen3"){
						$SpeakMoyen3Value	= ' checked="checked" ';
					}
					else{
						$SpeakMoyen3Value	= '';
					}//end if
					if($_POST['SpeakLang3']=="SpeakUnderMoyen3"){
						$SpeakUnderMoyen3Value	= ' checked="checked" ';
					}
					else{
						$SpeakUnderMoyen3Value	= '';
					}//end if
				}
				else{
					$SpeakExcellent3Value	= '';
					$SpeakGood3Value	= '';
					$SpeakMoyen3Value	= '';
					$SpeakUnderMoyen3Value	= '';
				}//end if
				if(isset($_POST['DontKnow'])){
					$DontKnowValue			= ' checked="checked" ';
				}
				else{
					$DontKnowValue			= "";
				}//end if
				if(isset($_POST['Driver'])){
					$DriverValue			= ' checked="checked" ';
				}
				else{
					$DriverValue			= "";
				}//end if
				if(isset($_POST['Support'])){
					$SupportValue			= ' checked="checked" ';
				}
				else{
					$SupportValue			= "";
				}//end if
				if(isset($_POST['Programer'])){
					$ProgramerValue			= ' checked="checked" ';
				}
				else{
					$ProgramerValue			= "";
				}//end if

				$OtherExperienceValue	= PostFilter($_POST['OtherExperience']);
				$CompName1Value			= PostFilter($_POST['CompName1']);
				$ConctactMethode1Value	= PostFilter($_POST['ConctactMethode1']);
				$FromDate1Value			= PostFilter($_POST['FromDate1']);
				$ToDate1Value			= PostFilter($_POST['ToDate1']);
				$OldJob1Value				= PostFilter($_POST['OldJob1']);
				$LastMonthSalary1Value		= PostFilter($_POST['LastMonthSalary1']);
				$WhyLeft1Value				= PostFilter($_POST['WhyLeft1']);
				$CompName2Value				= PostFilter($_POST['CompName2']);
				$ConctactMethode2Value		= PostFilter($_POST['ConctactMethode2']);
				$FromDate2Value				= PostFilter($_POST['FromDate2']);
				$ToDate2Value				= PostFilter($_POST['ToDate2']);
				$OldJob2Value				= PostFilter($_POST['OldJob2']);
				$LastMonthSalary2Value		= PostFilter($_POST['LastMonthSalary2']);
				$WhyLeft2Value				= PostFilter($_POST['WhyLeft2']);
				$CompName3Value				= PostFilter($_POST['CompName3']);
				$ConctactMethode3Value		= PostFilter($_POST['ConctactMethode3']);
				$FromDate3Value				= PostFilter($_POST['FromDate3']);
				$ToDate3Value				= PostFilter($_POST['ToDate3']);
				$OldJob3Value				= PostFilter($_POST['OldJob3']);
				$LastMonthSalary3Value		= PostFilter($_POST['LastMonthSalary3']);
				$WhyLeft3Value				= PostFilter($_POST['WhyLeft3']);
				$CompName4Value				= PostFilter($_POST['CompName4']);
				$ConctactMethode4Value		= PostFilter($_POST['ConctactMethode4']);
				$FromDate4Value				= PostFilter($_POST['FromDate4']);
				$ToDate4Value				= PostFilter($_POST['ToDate4']);
				$OldJob4Value				= PostFilter($_POST['OldJob4']);
				$LastMonthSalary4Value		= PostFilter($_POST['LastMonthSalary4']);
				$WhyLeft4Value						= PostFilter($_POST['WhyLeft4']);
				$CompName5Value						= PostFilter($_POST['CompName5']);
				$ConctactMethode5Value				= PostFilter($_POST['ConctactMethode5']);
				$FromDate5Value						= PostFilter($_POST['FromDate5']);
				$ToDate5Value						= PostFilter($_POST['ToDate5']);
				$OldJob5Value						= PostFilter($_POST['OldJob5']);
				$LastMonthSalary5Value				= PostFilter($_POST['LastMonthSalary5']);
				$WhyLeft5Value						= PostFilter($_POST['WhyLeft5']);
				$MustExcutingInOldJobsValue			= PostFilter($_POST['MustExcutingInOldJobs']);
				
				if(isset($_POST['DiduDoAnotherJobsOverTime'])){
					if($_POST['DiduDoAnotherJobsOverTime']=="yes"){
						$DiduDoAnotherJobsOverTimeYesValue		= ' checked="checked" ';
					}
					else{
						$DiduDoAnotherJobsOverTimeYesValue		='';
					}//end if
					if($_POST['DiduDoAnotherJobsOverTime']=="no"){
						$DiduDoAnotherJobsOverTimeNoValue		= ' checked="checked" ';
					}
					else{
						$DiduDoAnotherJobsOverTimeNoValue		= '';
					}//end if
				}
				else{
					$DiduDoAnotherJobsOverTimeYesValue		='';
					$DiduDoAnotherJobsOverTimeNoValue		= '';
				}//end if
				
				if(isset($_POST['DoYouRejectWorkOverTime'])){
					if($_POST['DoYouRejectWorkOverTime']=="yes"){
						$DoYouRejectWorkOverTimeYesValue		= ' checked="checked" ';
					}
					else{
						$DoYouRejectWorkOverTimeYesValue		= '';
					}//end if
					if($_POST['DoYouRejectWorkOverTime']=="no"){
						$DoYouRejectWorkOverTimeNoValue		= ' checked="checked" ';
					}
					else{
						$DoYouRejectWorkOverTimeNoValue		= '';
					}//end if
				}
				else{
					$DoYouRejectWorkOverTimeYesValue	= '';
					$DoYouRejectWorkOverTimeNoValue		= '';
				}//end if
				
				$DoYouRejectCallingOldJobValue		= PostFilter($_POST['DoYouRejectCallingOldJob']);
				$HowDoYouHearAboutUsValue			= PostFilter($_POST['HowDoYouHearAboutUs']);
				$WhyYouWantToJoinValue				= PostFilter($_POST['WhyYouWantToJoin']);
				$WhatJobYouWichValue				= PostFilter($_POST['WhatJobYouWich']);
				$WhenUCanStartValue					= PostFilter($_POST['WhenUCanStart']);
				$WishedSalaryValue					= PostFilter($_POST['WishedSalary']);
				$TalkAboutSkillsInThisJobValue		= PostFilter($_POST['TalkAboutSkillsInThisJob']);
				
				if(isset($_POST['DidYouSendUsAnCV'])){
					if($_POST['DidYouSendUsAnCV']=="yes"){
						$DidYouSendUsAnCVYesValue		= ' checked="checked" ';
					}
					else{
						$DidYouSendUsAnCVYesValue		= '';
					}//end if
					if($_POST['DidYouSendUsAnCV']=="no"){
						$DidYouSendUsAnCVNoValue		= ' checked="checked" ';
					}
					else{
						$DidYouSendUsAnCVNoValue		= '';
					}//end if
				}
				else{
					$DidYouSendUsAnCVYesValue		= '';
					$DidYouSendUsAnCVNoValue		= '';
				}//end if

				
				$ifYesWriteCVNumberHereValue		= PostFilter($_POST['ifYesWriteCVNumberHere']);
				$DoYouHaveNearbyInTheCompanyValue	= PostFilter($_POST['DoYouHaveNearbyInTheCompany']);
				$OutName1Value						= PostFilter($_POST['OutName1']);
				$OutContact1Value					= PostFilter($_POST['OutContact1']);
				$OutJobDesc1Value					= PostFilter($_POST['OutJobDesc1']);
				$OutName2Value						= PostFilter($_POST['OutName2']);
				$OutContact2Value					= PostFilter($_POST['OutContact2']);
				$OutJobDesc2Value					= PostFilter($_POST['OutJobDesc2']);
				$OutName3Value						= PostFilter($_POST['OutName3']);
				$OutContact3Value					= PostFilter($_POST['OutContact3']);
				$OutJobDesc3Value					= PostFilter($_POST['OutJobDesc3']);
			
		    // Gestion erreur / succ�s
		    if ($UploadError or $_POST['CvCaptcha']!=$_SESSION['captcha']){
				//erro in uploading picture
				$echoCVTheme = true;
				$CVPic = "";

		        //print_r($Upload-> GetError());
		    } else {
				//Upload effectu�e avec succ�s
				if(isset($Upload->Infos[1]['nom'])){
					//delete error caracters in the file name
					//$FileName = ValidFileName();
					$CVPic="Programs/careers/images/". ($Upload->Infos[1]['nom']);
				}
				else{
					$UserPic="";
				}
				$echoCVTheme = false;
				$CvId 				= GenerateID("careers","CvId");
				$TrueInfoValue		= "1";
					
				$SexValue 			= PostFilter($_POST['Sex']);
				$Sex6Value 			= PostFilter($_POST['Sex6']);
				$Sex5Value 			= PostFilter($_POST['Sex5']);
				$Sex4Value 			= PostFilter($_POST['Sex4']);
				$Sex3Value 			= PostFilter($_POST['Sex3']);
				$Sex2Value 			= PostFilter($_POST['Sex2']);
				$Sex1Value 			= PostFilter($_POST['Sex1']);
				if(isset($_POST['MaritalStatus'])){
					if($_POST['MaritalStatus']=="celibate"){
						$celibateValue = "1";
					}
					else{
						$celibateValue = "0";
					}//end if
					if($_POST['MaritalStatus']=="Mariage"){
						$MariageValue = "1";
					}
					else{
						$MariageValue = "0";
					}//end if
					if($_POST['MaritalStatus']=="Widower"){
						$WidowerValue = "1";
					}
					else{
						$WidowerValue = "0";
					}//end if
					if($_POST['MaritalStatus']=="Divorced"){
						$DivorcedValue = "1";
					}
					else{
						$DivorcedValue = "0";
					}//end if
					if($_POST['MaritalStatus']=="Fiance"){
						$FianceValue = "1";
					}
					else{
						$FianceValue = "0";
					}//end if
				}//end if
				$CertifecateFrom3 	= PostFilter($_POST['CertifecateFrom3']);
				
				if(isset($_POST['DiduDoAnotherJobsOverTime'])){
					$DiduDoAnotherJobsOverTimeValue	= PostFilter($_POST['DiduDoAnotherJobsOverTime']);
				}
				else{
					$DiduDoAnotherJobsOverTimeValue = "0";
				}//end if
								if(isset($_POST['Hearing'])){
					$HearingValue = '1';
				}
				else{
					$HearingValue = "0";
				}//end if
				if(isset($_POST['Viewing'])){
					$ViewingValue = '1';
				}
				else{
					$ViewingValue = "0";
				}//end if
				if(isset($_POST['Talking'])){
					$TalkingValue = '1';
				}
				else{
					$TalkingValue = "0";
				}//end if
				if(isset($_POST['DidUSmoke'])){
					if($_POST['DidUSmoke']=="yes"){
						$DidUSmokeYesValue		= '1';
					}
					else{
						$DidUSmokeYesValue		= '0';
					}//end if
					if($_POST['DidUSmoke']=="no"){
						$DidUSmokeNoValue		= '0';
					}
					else{
						$DidUSmokeNoValue		= '1';
					}//end if
				}
				else{
					$DidUSmokeYesValue		= '0';
					$DidUSmokeNoValue		= '0';
				}//end if
				if(isset($_POST['DidUDoObliging'])){
					if($_POST['DidUDoObliging']=="yes"){
						$DidUDoObligingYesValue		= '1';
					}
					else{
						$DidUDoObligingYesValue		= '0';
					}//end if
					if($_POST['DidUDoObliging']=="no"){
						$DidUDoObligingNoValue		= '0';
					}
					else{
						$DidUDoObligingNoValue		= '1';
					}//end if
				}
				else{
					$DidUDoObligingYesValue		= '0';
					$DidUDoObligingNoValue		= '0';
				}//end if
								if(isset($_POST['ReadLang1'])){
					if($_POST['ReadLang1']=="ReadExcellent1"){
						$ReadExcellent1Value		= '1';
					}
					else{
						$ReadExcellent1Value		= '0';
					}//end if
					if($_POST['ReadLang1']=="ReadGood1"){
						$ReadGood1Value		= '1';
					}
					else{
						$ReadGood1Value		= '0';
					}//end if
					if($_POST['ReadLang1']=="ReadMoyen1"){
						$ReadMoyen1Value	= '1';
					}
					else{
						$ReadMoyen1Value	= '0';
					}//end if
					if($_POST['ReadLang1']=="ReadUnderMoyen1"){
						$ReadUnderMoyen1Value	= '1';
					}
					else{
						$ReadUnderMoyen1Value	= '0';
					}//end if
				}
				else{
					$ReadExcellent1Value		= '0';
					$ReadGood1Value		= '0';
					$ReadMoyen1Value	= '0';
					$ReadUnderMoyen1Value	= '0';
				}//end if
				
				if(isset($_POST['WriteLang1'])){
					if($_POST['WriteLang1']=="WriteExcellent1"){
						$WriteExcellent1Value	= '1';
					}
					else{
						$WriteExcellent1Value	= '0';
					}//end if
					if($_POST['WriteLang1']=="WriteGood1"){
						$WriteGood1Value	= '1';
					}
					else{
						$WriteGood1Value	= '0';
					}//end if
					if($_POST['WriteLang1']=="WriteMoyen1"){
						$WriteMoyen1Value	= '1';
					}
					else{
						$WriteMoyen1Value	= '0';
					}//end if
					if($_POST['WriteLang1']=="WriteUnderMoyen1"){
						$WriteUnderMoyen1Value	= '1';
					}
					else{
						$WriteUnderMoyen1Value	= '0';
					}//end if
				}
				else{
					$WriteExcellent1Value	= '0';
					$WriteGood1Value	= '0';
					$WriteMoyen1Value	= '0';
					$WriteUnderMoyen1Value	= '0';
				}//end if

				if(isset($_POST['SpeakLang1'])){
					if($_POST['SpeakLang1']=="SpeakExcellent1"){
						$SpeakExcellent1Value	= '1';
					}
					else{
						$SpeakExcellent1Value	= '0';
					}//end if
					if($_POST['SpeakLang1']=="SpeakGood1"){
						$SpeakGood1Value	= '1';
					}
					else{
						$SpeakGood1Value	= '0';
					}//end if
					if($_POST['SpeakLang1']=="SpeakMoyen1"){
						$SpeakMoyen1Value	= '1';
					}
					else{
						$SpeakMoyen1Value	= '0';
					}//end if
					if($_POST['SpeakLang1']=="SpeakUnderMoyen1"){
						$SpeakUnderMoyen1Value	= '1';
					}
					else{
						$SpeakUnderMoyen1Value	= '0';
					}//end if
				}
				else{
					$SpeakExcellent1Value	= '0';
					$SpeakGood1Value	= '0';
					$SpeakMoyen1Value	= '0';
					$SpeakUnderMoyen1Value	= '0';
				}//end if

				if(isset($_POST['ReadLang2'])){
					if($_POST['ReadLang2']=="ReadExcellent2"){
						$ReadExcellent2Value		= '1';
					}
					else{
						$ReadExcellent2Value		= '0';
					}//end if
					if($_POST['ReadLang2']=="ReadGood2"){
						$ReadGood2Value		= '1';
					}
					else{
						$ReadGood2Value		= '0';
					}//end if
					if($_POST['ReadLang2']=="ReadMoyen2"){
						$ReadMoyen2Value	= '1';
					}
					else{
						$ReadMoyen2Value	= '0';
					}//end if
					if($_POST['ReadLang2']=="ReadUnderMoyen2"){
						$ReadUnderMoyen2Value	= '1';
					}
					else{
						$ReadUnderMoyen2Value	= '0';
					}//end if
				}
				else{
					$ReadExcellent2Value		= '0';
					$ReadGood2Value		= '0';
					$ReadMoyen2Value	= '0';
					$ReadUnderMoyen2Value	= '0';
				}//end if
				
				if(isset($_POST['WriteLang2'])){
					if($_POST['WriteLang2']=="WriteExcellent2"){
						$WriteExcellent2Value	= '1';
					}
					else{
						$WriteExcellent2Value	= '0';
					}//end if
					if($_POST['WriteLang2']=="WriteGood2"){
						$WriteGood2Value	= '1';
					}
					else{
						$WriteGood2Value	= '0';
					}//end if
					if($_POST['WriteLang2']=="WriteMoyen2"){
						$WriteMoyen2Value	= '1';
					}
					else{
						$WriteMoyen2Value	= '0';
					}//end if
					if($_POST['WriteLang2']=="WriteUnderMoyen2"){
						$WriteUnderMoyen2Value	= '1';
					}
					else{
						$WriteUnderMoyen2Value	= '0';
					}//end if
				}
				else{
					$WriteExcellent2Value	= '0';
					$WriteGood2Value	= '0';
					$WriteMoyen2Value	= '0';
					$WriteUnderMoyen2Value	= '0';
				}//end if

				if(isset($_POST['SpeakLang2'])){
					if($_POST['SpeakLang2']=="SpeakExcellent2"){
						$SpeakExcellent2Value	= '1';
					}
					else{
						$SpeakExcellent2Value	= '0';
					}//end if
					if($_POST['SpeakLang2']=="SpeakGood2"){
						$SpeakGood2Value	= '1';
					}
					else{
						$SpeakGood2Value	= '0';
					}//end if
					if($_POST['SpeakLang2']=="SpeakMoyen2"){
						$SpeakMoyen2Value	= '1';
					}
					else{
						$SpeakMoyen2Value	= '0';
					}//end if
					if($_POST['SpeakLang2']=="SpeakUnderMoyen2"){
						$SpeakUnderMoyen2Value	= '1';
					}
					else{
						$SpeakUnderMoyen2Value	= '0';
					}//end if
				}
				else{
					$SpeakExcellent2Value	= '0';
					$SpeakGood2Value	= '0';
					$SpeakMoyen2Value	= '0';
					$SpeakUnderMoyen2Value	= '0';
				}//end if

				if(isset($_POST['ReadLang3'])){
					if($_POST['ReadLang3']=="ReadExcellent3"){
						$ReadExcellent3Value		= '1';
					}
					else{
						$ReadExcellent3Value		= '0';
					}//end if
					if($_POST['ReadLang3']=="ReadGood3"){
						$ReadGood3Value		= '1';
					}
					else{
						$ReadGood3Value		= '0';
					}//end if
					if($_POST['ReadLang3']=="ReadMoyen3"){
						$ReadMoyen3Value	= '1';
					}
					else{
						$ReadMoyen3Value	= '0';
					}//end if
					if($_POST['ReadLang3']=="ReadUnderMoyen3"){
						$ReadUnderMoyen3Value	= '1';
					}
					else{
						$ReadUnderMoyen3Value	= '0';
					}//end if
				}
				else{
					$ReadExcellent3Value		= '0';
					$ReadGood3Value		= '0';
					$ReadMoyen3Value	= '0';
					$ReadUnderMoyen3Value	= '0';
				}//end if
				
				if(isset($_POST['WriteLang3'])){
					if($_POST['WriteLang3']=="WriteExcellent3"){
						$WriteExcellent3Value	= '1';
					}
					else{
						$WriteExcellent3Value	= '0';
					}//end if
					if($_POST['WriteLang3']=="WriteGood3"){
						$WriteGood3Value	= '1';
					}
					else{
						$WriteGood3Value	= '0';
					}//end if
					if($_POST['WriteLang3']=="WriteMoyen3"){
						$WriteMoyen3Value	= '1';
					}
					else{
						$WriteMoyen3Value	= '0';
					}//end if
					if($_POST['WriteLang3']=="WriteUnderMoyen3"){
						$WriteUnderMoyen3Value	= '1';
					}
					else{
						$WriteUnderMoyen3Value	= '0';
					}//end if
				}
				else{
					$WriteExcellent3Value	= '0';
					$WriteGood3Value	= '0';
					$WriteMoyen3Value	= '0';
					$WriteUnderMoyen3Value	= '0';
				}//end if

				if(isset($_POST['SpeakLang3'])){
					if($_POST['SpeakLang3']=="SpeakExcellent3"){
						$SpeakExcellent3Value	= '1';
					}
					else{
						$SpeakExcellent3Value	= '0';
					}//end if
					if($_POST['SpeakLang3']=="SpeakGood3"){
						$SpeakGood3Value	= '1';
					}
					else{
						$SpeakGood3Value	= '0';
					}//end if
					if($_POST['SpeakLang3']=="SpeakMoyen3"){
						$SpeakMoyen3Value	= '1';
					}
					else{
						$SpeakMoyen3Value	= '0';
					}//end if
					if($_POST['SpeakLang3']=="SpeakUnderMoyen3"){
						$SpeakUnderMoyen3Value	= '1';
					}
					else{
						$SpeakUnderMoyen3Value	= '0';
					}//end if
				}
				else{
					$SpeakExcellent3Value	= '0';
					$SpeakGood3Value	= '0';
					$SpeakMoyen3Value	= '0';
					$SpeakUnderMoyen3Value	= '0';
				}//end if
				if(isset($_POST['DontKnow'])){
					$DontKnowValue			= '1';
				}
				else{
					$DontKnowValue			= "0";
				}//end if
				if(isset($_POST['Driver'])){
					$DriverValue			= '1';
				}
				else{
					$DriverValue			= "0";
				}//end if
				if(isset($_POST['Support'])){
					$SupportValue			= '1';
				}
				else{
					$SupportValue			= "0";
				}//end if
				if(isset($_POST['Programer'])){
					$ProgramerValue			= '1';
				}
				else{
					$ProgramerValue			= "0";
				}//end if
				if(isset($_POST['DoYouRejectWorkOverTime'])){
					if($_POST['DoYouRejectWorkOverTime']=="yes"){
						$DoYouRejectWorkOverTimeYesValue		= '1';
					}
					else{
						$DoYouRejectWorkOverTimeYesValue		= '0';
					}//end if
					if($_POST['DoYouRejectWorkOverTime']=="no"){
						$DoYouRejectWorkOverTimeNoValue		= '1';
					}
					else{
						$DoYouRejectWorkOverTimeNoValue		= '0';
					}//end if
				}
				else{
					$DoYouRejectWorkOverTimeYesValue	= '0';
					$DoYouRejectWorkOverTimeNoValue		= '0';
				}//end if
				if(isset($_POST['DidYouSendUsAnCV'])){
					if($_POST['DidYouSendUsAnCV']=="yes"){
						$DidYouSendUsAnCVYesValue		= '1';
					}
					else{
						$DidYouSendUsAnCVYesValue		= '0';
					}//end if
					if($_POST['DidYouSendUsAnCV']=="no"){
						$DidYouSendUsAnCVNoValue		= '1';
					}
					else{
						$DidYouSendUsAnCVNoValue		= '0';
					}//end if
				}
				else{
					$DidYouSendUsAnCVYesValue		= '0';
					$DidYouSendUsAnCVNoValue		= '0';
				}//end if
				
				//insert new record
				$SqlInsert =   "insert into `careers` values(
								  '".$CvId."' ,
								  '".$FirstNameValue."' ,
								  '".$FatherNameValue."' ,
								  '".$MotherNameValue."' ,
								  '".$GrandFatherNameValue."' ,
								  '".$FamilyNameValue."' ,
								  '".$BirthDateValue."' ,
								  '".$BirthLocationValue."' ,
								  '".$CertifecateFrom3Value."' ,
								  '".$SexValue."' ,
								  '".$NationalityValue."' ,
								  '".$SegelNbrValue."' ,
								  '".$SegelLocationValue."' ,
								  '".$DamanNbrValue."' ,
								  '".$celibateValue."' ,
								  '".$MariageValue."' ,
								  '".$WidowerValue."' ,
								  '".$DivorcedValue."' ,
								  '".$FianceValue."' ,
								  '".$SpendName1Value."' ,
								  '".$Relative1Value."' ,
								  '".$Sex1Value."' ,
								  '".$BirthDate1Value."' ,
								  '".$SpendName2Value."' ,
								  '".$Relative2Value."' ,
								  '".$Sex2Value."' ,
								  '".$BirthDate2Value."' ,
								  '".$SpendName3Value."' ,
								  '".$Relative3Value."' ,
								  '".$Sex3Value."' ,
								  '".$BirthDate3Value."' ,
								  '".$SpendName4Value."' ,
								  '".$Relative4Value."' ,
								  '".$Sex4Value."' ,
								  '".$BirthDate4Value."' ,
								  '".$SpendName5Value."' ,
								  '".$Sex5Value."' ,
								  '".$BirthDate5Value."' ,
								  '".$SpendName6Value."' ,
								  '".$Relative6Value."' ,
								  '".$Sex6Value."' ,
								  '".$BirthDate6Value."' ,
								  '".$HealthStatusValue."' ,
								  '".$HearingValue."' ,
								  '".$ViewingValue."' ,
								  '".$TalkingValue."' ,
								  '".$DidUSmokeYesValue."' ,
								  '".$DidUSmokeNoValue."' ,
								  '".$DidUDoObligingYesValue."' ,
								  '".$DidUDoObligingNoValue."' ,
								  '".$ObligingOtherValue."' ,
								  '".$TownValue."' ,
								  '".$RueValue."' ,
								  '".$BuildingValue."' ,
								  '".$BuildOwnerValue."' ,
								  '".$PhoneValue."' ,
								  '".$CellulaireValue."' ,
								  '".$EmailValue."' ,
								  '".$EducationLevel1Value."' ,
								  '".$Average1Value."' ,
								  '".$CertifecateFrom1Value."' ,
								  '".$CertifecateYear1Value."' ,
								  '".$EducationLevel2Value."' ,
								  '".$Average2Value."' ,
								  '".$CertifecateFrom2Value."' ,
								  '".$CertifecateYear2Value."' ,
								  '".$EducationLevel3Value."' ,
								  '".$Average3Value."' ,
								  '".$CertifecateFrom3."' ,
								  '".$CertifecateYear3Value."' ,
								  '".$EducationLevel4Value."' ,
								  '".$Average14Value."' ,
								  '".$CertifecateFrom14Value."' ,
								  '".$CertifecateYear4Value."' ,
								  '".$EducationLevel5Value."' ,
								  '".$Average5Value."' ,
								  '".$CertifecateFrom5Value."' ,
								  '".$CertifecateYear5Value."' ,
								  '".$CycleName1Value."' ,
								  '".$SkillsFromCycle1Value."' ,
								  '".$CycleFrom1Value."' ,
								  '".$CycleDate1Value."' ,
								  '".$CycleName2Value."' ,
								  '".$CycleInterval2Value."' ,
								  '".$SkillsFromCycle12Value."' ,
								  '".$CycleFrom2Value."' ,
								  '".$CycleName3Value."' ,
								  '".$CycleInterval3Value."' ,
								  '".$CycleDate2Value."' ,
								  '".$CycleInterval1Value."' ,
								  '".$SkillsFromCycle13Value."' ,
								  '".$CycleFrom3Value."' ,
								  '".$CycleDate3Value."' ,
								  '".$CycleName4Value."' ,
								  '".$CycleInterval4Value."' ,
								  '".$SkillsFromCycle14Value."' ,
								  '".$CycleFrom4Value."' ,
								  '".$CycleDate4Value."' ,
								  '".$CycleName5Value."' ,
								  '".$CycleInterval5Value."' ,
								  '".$SkillsFromCycle15Value."' ,
								  '".$CycleFrom5Value."' ,
								  '".$CycleDate5Value."' ,
								  '".$LangName1Value."' ,
								  '".$ReadExcellent1Value."' ,
								  '".$ReadGood1Value."' ,
								  '".$ReadMoyen1Value."' ,
								  '".$ReadUnderMoyen1Value."' ,
								  '".$WriteExcellent1Value."' ,
								  '".$WriteGood1Value."' ,
								  '".$WriteMoyen1Value."' ,
								  '".$WriteUnderMoyen1Value."' ,
								  '".$SpeakExcellent1Value."' ,
								  '".$SpeakGood1Value."' ,
								  '".$SpeakMoyen1Value."' ,
								  '".$SpeakUnderMoyen1Value."' ,
								  '".$LangName2Value."' ,
								  '".$ReadExcellent2Value."' ,
								  '".$ReadGood2Value."' ,
								  '".$ReadMoyen2Value."' ,
								  '".$ReadUnderMoyen2Value."' ,
								  '".$WriteGood2Value."' ,
								  '".$WriteMoyen2Value."' ,
								  '".$WriteUnderMoyen2Value."' ,
								  '".$SpeakExcellent2Value."' ,
								  '".$SpeakGood2Value."' ,
								  '".$SpeakMoyen2Value."' ,
								  '".$SpeakUnderMoyen2Value."' ,
								  '".$LangName3Value."' ,
								  '".$ReadGood3Value."' ,
								  '".$ReadMoyen3Value."' ,
								  '".$ReadUnderMoyen3Value."' ,
								  '".$WriteExcellent3Value."' ,
								  '".$WriteGood3Value."' ,
								  '".$WriteMoyen3Value."' ,
								  '".$WriteUnderMoyen3Value."' ,
								  '".$SpeakExcellent3Value."' ,
								  '".$SpeakGood3Value."' ,
								  '".$SpeakMoyen3Value."' ,
								  '".$SpeakUnderMoyen3Value."' ,
								  '".$DontKnowValue."' ,
								  '".$DriverValue."' ,
								  '".$SupportValue."' ,
								  '".$ProgramerValue."' ,
								  '".$OtherExperienceValue."' ,
								  '".$CompName1Value."' ,
								  '".$ConctactMethode1Value."' ,
								  '".$FromDate1Value."' ,
								  '".$ToDate1Value."' ,
								  '".$OldJob1Value."' ,
								  '".$LastMonthSalary1Value."' ,
								  '".$WhyLeft1Value."' ,
								  '".$CompName2Value."' ,
								  '".$ConctactMethode2Value."' ,
								  '".$FromDate2Value."' ,
								  '".$ToDate2Value."' ,
								  '".$OldJob2Value."' ,
								  '".$LastMonthSalary2Value."' ,
								  '".$WhyLeft2Value."' ,
								  '".$CompName3Value."' ,
								  '".$ConctactMethode3Value."' ,
								  '".$FromDate3Value."' ,
								  '".$ToDate3Value."' ,
								  '".$OldJob3Value."' ,
								  '".$LastMonthSalary3Value."' ,
								  '".$WhyLeft3Value."' ,
								  '".$CompName4Value."' ,
								  '".$ConctactMethode4Value."' ,
								  '".$FromDate4Value."' ,
								  '".$ToDate4Value."' ,
								  '".$OldJob4Value."' ,
								  '".$LastMonthSalary4Value."' ,
								  '".$WhyLeft4Value."' ,
								  '".$CompName5Value."' ,
								  '".$ConctactMethode5Value."' ,
								  '".$FromDate5Value."' ,
								  '".$ToDate5Value."' ,
								  '".$OldJob5Value."' ,
								  '".$LastMonthSalary5Value."' ,
								  '".$WhyLeft5Value."' ,
								  '".$MustExcutingInOldJobsValue."' ,
								  '".$DiduDoAnotherJobsOverTimeValue."' ,
								  '".$DoYouRejectWorkOverTimeYesValue."' ,
								  '".$DoYouRejectWorkOverTimeNoValue."' ,
								  '".$DoYouRejectCallingOldJobValue."' ,
								  '".$HowDoYouHearAboutUsValue."' ,
								  '".$WhyYouWantToJoinValue."' ,
								  '".$WhatJobYouWichValue."' ,
								  '".$WhenUCanStartValue."' ,
								  '".$WishedSalaryValue."' ,
								  '".$TalkAboutSkillsInThisJobValue."' ,
								  '".$DidYouSendUsAnCVYesValue."' ,
								  '".$DidYouSendUsAnCVNoValue."' ,
								  '".$ifYesWriteCVNumberHereValue."' ,
								  '".$DoYouHaveNearbyInTheCompanyValue."' ,
								  '".$OutName1Value."' ,
								  '".$OutContact1Value."' ,
								  '".$OutJobDesc1Value."' ,
								  '".$OutName2Value."' ,
								  '".$OutContact2Value."' ,
								  '".$OutJobDesc2Value."' ,
								  '".$OutName3Value."' ,
								  '".$OutContact3Value."' ,
								  '".$OutJobDesc3Value."' ,
								  '".$TrueInfoValue."' ,
								  '".$WriteExcellent2Value."' ,
								  '".$ReadExcellent3Value."' 
								  );";
				$RsCV = mysqli_query($conn,$SqlInsert);	
				
				//send mail to admin
				global $AdminMail,$WebSiteName;
				$Subject 	=  (NewCvFromWebsite);
				$Body 		= $CvId;
				$From     = $AdminMail;
				$FromName = $WebSiteName;
				$AddAddress[0] = $AdminMail; 
				$AddAddress[1] = $WebSiteName;
				SendEmail($From, $FromName, $AddAddress, $Subject, $Body);
				echo "<br/>";
				
				//send mail to condidat
				$Subject 	=  (YourCvInWebsite);
				$Body 		=  (WeReceiveUreCVAndWeContactUWenDone).' '.$CvId. ' <br/> '. $WebSiteName.' <br/> '. (EmailSignature);
				$From     = $AdminMail;
				$FromName = $WebSiteName;
				$userNameMail = $FirstNameValue . ' ' .$FamilyNameValue;
				$AddAddress[0] = $EmailValue;
				$AddAddress[1] = $userNameMail ;
				
				echo SendEmail($From, $FromName, $AddAddress, $Subject, $Body);
				echo "<br/>";
				//echo cv number Message
				echo  (WeReceiveUreCVAndWeContactUWenDone).' '.$CvId;
		    }//end if
			
}
else{
	//first call to page
	$echoCVTheme = true;
	$FirstNameValue 		= "";
	$FatherNameValue 		= "";
	$MotherNameValue 		= "";
	$GrandFatherNameValue 	= "";
	$FamilyNameValue 		= "";
	$BirthDateValue 		= "";
	$BirthLocationValue 	= "";
	$CertifecateFrom3Value  = "";
	$SexValue 				= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	
	$NationalityValue 		= "";
	$SegelNbrValue 			= "";
	$SegelLocationValue 	= "";
	$DamanNbrValue		 	= "";
	$celibateValue		 	= ' checked="checked" ';
	$MariageValue		 	= "";
	$WidowerValue		 	= "";
	$DivorcedValue		 	= "";
	$FianceValue		 	= "";
	$SpendName1Value		= "";
	$Relative1Value		 	= "";
	$Sex1Value		 		= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	$BirthDate1Value		= "";
	$SpendName2Value		= "";
	$Relative2Value			= "";
	$Sex2Value				= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	$BirthDate2Value		= "";
	$SpendName3Value		= "";
	$Relative3Value			= "";
	$Sex3Value				= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	$BirthDate3Value		= "";
	$SpendName4Value		= "";
	$Relative4Value			= "";
	$Sex4Value				= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	$BirthDate4Value		= "";
	$SpendName5Value		= "";
	$SpendName6Value		= "";
	$Sex5Value				= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	$BirthDate5Value		= "";
	$SpendName6Value		= "";
	$Relative6Value			= "";
	$Sex6Value				= '<option value="1">'. (male).'</option><option value="0">'. (female).'</option>';
	$BirthDate6Value		= "";
	$HealthStatusValue		= "";
	$HearingValue			= "";
	$ViewingValue			= "";
	$TalkingValue			= "";
	$DidUSmokeYesValue		= "";
	$DidUSmokeNoValue		= "";
	$DidUDoObligingYesValue	= "";
	$DidUDoObligingNoValue	= "";
	$ObligingOtherValue		= "";
	$TownValue				= "";
	$RueValue				= "";
	$BuildingValue			= "";
	$BuildOwnerValue		= "";
	$PhoneValue				= "";
	$CellulaireValue		= "";
	$EmailValue				= "";
	$EducationLevel1Value	= "";
	$Average1Value			= "";
	$CertifecateFrom1Value	= "";
	$CertifecateYear1Value	= "";
	$EducationLevel2Value	= "";
	$Average2Value			= "";
	$CertifecateFrom2Value	= "";
	$CertifecateYear2Value	= "";
	$EducationLevel3Value	= "";
	$Average3Value			= "";
	$CertifecateFrom3		= "";
	$CertifecateYear3Value	= "";
	$EducationLevel4Value	= "";
	$Average14Value			= "";
	$CertifecateFrom14Value	= "";
	$CertifecateYear4Value	= "";
	$EducationLevel5Value	= "";
	$Average5Value			= "";
	$CertifecateFrom5Value	= "";
	$CertifecateYear5Value	= "";
	$CycleName1Value		= "";
	$SkillsFromCycle1Value	= "";
	$CycleFrom1Value		= "";
	$CycleDate1Value		= "";
	$CycleName2Value		= "";
	$CycleInterval2Value	= "";
	$SkillsFromCycle12Value	= "";
	$CycleFrom2Value		= "";
	$CycleName3Value		= "";
	$CycleInterval3Value	= "";
	$CycleDate2Value 		= "";
	$CycleInterval1Value	= "";
	$SkillsFromCycle13Value	= "";
	$CycleFrom3Value		= "";
	$CycleDate3Value		= "";
	$CycleName4Value		= "";
	$CycleInterval4Value	= "";
	$SkillsFromCycle14Value	= "";
	$CycleFrom4Value		= "";
	$CycleDate4Value		= "";
	$CycleName5Value		= "";
	$CycleInterval5Value	= "";
	$SkillsFromCycle15Value	= "";
	$CycleFrom5Value		= "";
	$CycleDate5Value		= "";
	$LangName1Value			= "";
	$ReadExcellent1Value	= "";
	$ReadGood1Value			= "";
	$ReadMoyen1Value		= "";
	$ReadUnderMoyen1Value	= "";
	$WriteExcellent1Value	= "";
	$WriteGood1Value		= "";
	$WriteMoyen1Value		= "";
	$WriteUnderMoyen1Value	= "";
	$SpeakExcellent1Value	= "";
	$SpeakGood1Value		= "";
	$SpeakMoyen1Value		= "";
	$SpeakUnderMoyen1Value	= "";
	$LangName2Value			= "";
	$ReadExcellent2Value	= "";
	$ReadExcellent2Value	= "";
	$ReadGood2Value			= "";
	$ReadMoyen2Value		= "";
	$ReadUnderMoyen2Value	= "";
	$WriteGood2Value		= "";
	$WriteMoyen2Value		= "";
	$WriteUnderMoyen2Value	= "";
	$SpeakExcellent2Value	= "";
	$SpeakGood2Value		= "";
	$SpeakMoyen2Value		= "";
	$SpeakUnderMoyen2Value	= "";
	$LangName3Value			= "";
	$LangName3Value			= "";
	$ReadGood3Value			= "";
	$ReadMoyen3Value		= "";
	$ReadUnderMoyen3Value	= "";
	$WriteExcellent3Value	= "";
	$WriteGood3Value		= "";
	$WriteMoyen3Value		= "";
	$WriteUnderMoyen3Value	= "";
	$SpeakExcellent3Value	= "";
	$SpeakGood3Value		= "";
	$SpeakMoyen3Value		= "";
	$SpeakUnderMoyen3Value	= "";
	$DontKnowValue			= "";
	$DriverValue			= "";
	$SupportValue			= "";
	$ProgramerValue			= "";
	$OtherExperienceValue	= "";
	$CompName1Value			= "";
	$ConctactMethode1Value	= "";
	$FromDate1Value			= "";
	$ToDate1Value			= "";
	$OldJob1Value				= "";
	$LastMonthSalary1Value		= "";
	$WhyLeft1Value				= "";
	$CompName2Value				= "";
	$ConctactMethode2Value		= "";
	$FromDate2Value				= "";
	$ToDate2Value				= "";
	$OldJob2Value				= "";
	$LastMonthSalary2Value		= "";
	$WhyLeft2Value				= "";
	$CompName3Value				= "";
	$ConctactMethode3Value		= "";
	$FromDate3Value				= "";
	$ToDate3Value				= "";
	$OldJob3Value				= "";
	$LastMonthSalary3Value		= "";
	$WhyLeft3Value				= "";
	$CompName4Value				= "";
	$ConctactMethode4Value		= "";
	$FromDate4Value				= "";
	$ToDate4Value				= "";
	$OldJob4Value				= "";
	$LastMonthSalary4Value		= "";
	$WhyLeft4Value						= "";
	$CompName5Value						= "";
	$ConctactMethode5Value				= "";
	$FromDate5Value						= "";
	$ToDate5Value						= "";
	$OldJob5Value						= "";
	$LastMonthSalary5Value				= "";
	$WhyLeft5Value						= "";
	$MustExcutingInOldJobsValue			= "";
	$DiduDoAnotherJobsOverTimeValue		= "";
	$DoYouRejectWorkOverTimeYesValue	= "";
	$DoYouRejectWorkOverTimeNoValue		= "";
	$DoYouRejectCallingOldJobValue		= "";
	$HowDoYouHearAboutUsValue			= "";
	$WhyYouWantToJoinValue				= "";
	$WhatJobYouWichValue				= "";
	$WhenUCanStartValue					= "";
	$WishedSalaryValue					= "";
	$TalkAboutSkillsInThisJobValue		= "";
	$DidYouSendUsAnCVYesValue			= "";
	$DidYouSendUsAnCVNoValue			= "";
	$ifYesWriteCVNumberHereValue		= "";
	$DoYouHaveNearbyInTheCompanyValue	= "";
	$OutName1Value						= "";
	$OutContact1Value					= "";
	$OutJobDesc1Value					= "";
	$OutName2Value						= "";
	$OutContact2Value					= "";
	$OutJobDesc2Value					= "";
	$OutName3Value						= "";
	$OutContact3Value					= "";
	$OutJobDesc3Value					= "";
	$TrueInfoValue						= "";
	$WriteExcellent2Value 				= "";
	$ReadExcellent3Value 				= "";
	
}//end if

if($echoCVTheme){
	$Theme = VarTheme('{celibateValue}', $celibateValue	,$Theme );
	$Theme = VarTheme('{CertifecateFrom3Value}', $CertifecateFrom3Value	,$Theme );
	//$Theme = VarTheme('{TrueInfoValue}', $TrueInfoValue	,$Theme );
	$Theme = VarTheme('{OutJobDesc3Value}', $OutJobDesc3Value	,$Theme );
	$Theme = VarTheme('{OutContact3Value}', $OutContact3Value	,$Theme );
	$Theme = VarTheme('{OutName3Value}', $OutName3Value	,$Theme );
	$Theme = VarTheme('{OutJobDesc2Value}', $OutJobDesc2Value	,$Theme );
	$Theme = VarTheme('{OutContact2Value}', $OutContact2Value	,$Theme );
	$Theme = VarTheme('{OutName2Value}', $OutName2Value	,$Theme );
	$Theme = VarTheme('{OutJobDesc1Value}', $OutJobDesc1Value	,$Theme );
	$Theme = VarTheme('{OutContact1Value}', $OutContact1Value	,$Theme );
	$Theme = VarTheme('{OutName1Value}', $OutName1Value	,$Theme );
	$Theme = VarTheme('{DoYouHaveNearbyInTheCompanyValue}', $DoYouHaveNearbyInTheCompanyValue	,$Theme );
	$Theme = VarTheme('{ifYesWriteCVNumberHereValue}', $ifYesWriteCVNumberHereValue	,$Theme );
	$Theme = VarTheme('{DidYouSendUsAnCVNoValue}', $DidYouSendUsAnCVNoValue	,$Theme );
	$Theme = VarTheme('{DidYouSendUsAnCVYesValue}', $DidYouSendUsAnCVYesValue	,$Theme );
	$Theme = VarTheme('{TalkAboutSkillsInThisJobValue}', $TalkAboutSkillsInThisJobValue	,$Theme );
	$Theme = VarTheme('{WishedSalaryValue}', $WishedSalaryValue	,$Theme );
	$Theme = VarTheme('{WhenUCanStartValue}', $WhenUCanStartValue	,$Theme );
	$Theme = VarTheme('{WhatJobYouWichValue}', $WhatJobYouWichValue	,$Theme );
	$Theme = VarTheme('{WhyYouWantToJoinValue}', $WhyYouWantToJoinValue	,$Theme );
	$Theme = VarTheme('{HowDoYouHearAboutUsValue}', $HowDoYouHearAboutUsValue	,$Theme );
	$Theme = VarTheme('{DoYouRejectCallingOldJobValue}', $DoYouRejectCallingOldJobValue	,$Theme );
	$Theme = VarTheme('{DoYouRejectWorkOverTimeNoValue}', $DoYouRejectWorkOverTimeNoValue	,$Theme );
	$Theme = VarTheme('{DoYouRejectWorkOverTimeYesValue}', $DoYouRejectWorkOverTimeYesValue	,$Theme );
	$Theme = VarTheme('{MustExcutingInOldJobsValue}', $MustExcutingInOldJobsValue	,$Theme );
	$Theme = VarTheme('{WhyLeft5Value}', $WhyLeft5Value	,$Theme );
	$Theme = VarTheme('{LastMonthSalary5Value}', $LastMonthSalary5Value	,$Theme );
	$Theme = VarTheme('{OldJob5Value}', $OldJob5Value	,$Theme );
	$Theme = VarTheme('{ToDate5Value}', $ToDate5Value	,$Theme );
	$Theme = VarTheme('{FromDate5Value}', $FromDate5Value	,$Theme );
	$Theme = VarTheme('{ConctactMethode5Value}', $ConctactMethode5Value	,$Theme );
	$Theme = VarTheme('{CompName5Value}', $CompName5Value	,$Theme );
	$Theme = VarTheme('{WhyLeft4Value}', $WhyLeft4Value	,$Theme );
	$Theme = VarTheme('{LastMonthSalary4Value}', $LastMonthSalary4Value	,$Theme );
	$Theme = VarTheme('{OldJob4Value}', $OldJob4Value	,$Theme );
	$Theme = VarTheme('{ToDate4Value}', $ToDate4Value	,$Theme );
	$Theme = VarTheme('{FromDate4Value}', $FromDate4Value	,$Theme );
	$Theme = VarTheme('{ConctactMethode4Value}', $ConctactMethode4Value	,$Theme );
	$Theme = VarTheme('{CompName4Value}', $CompName4Value	,$Theme );
	$Theme = VarTheme('{WhyLeft3Value}', $WhyLeft3Value	,$Theme );
	$Theme = VarTheme('{LastMonthSalary3Value}', $LastMonthSalary3Value	,$Theme );
	$Theme = VarTheme('{OldJob3Value}', $OldJob3Value	,$Theme );
	$Theme = VarTheme('{ToDate3Value}', $ToDate3Value	,$Theme );
	$Theme = VarTheme('{FromDate3Value}', $FromDate3Value	,$Theme );
	$Theme = VarTheme('{ConctactMethode3Value}', $ConctactMethode3Value	,$Theme );
	$Theme = VarTheme('{CompName3Value}', $CompName3Value	,$Theme );
	$Theme = VarTheme('{WhyLeft2Value}', $WhyLeft2Value	,$Theme );
	$Theme = VarTheme('{LastMonthSalary2Value}', $LastMonthSalary2Value	,$Theme );
	$Theme = VarTheme('{OldJob2Value}', $OldJob2Value	,$Theme );
	$Theme = VarTheme('{ToDate2Value}', $ToDate2Value	,$Theme );
	$Theme = VarTheme('{FromDate2Value}', $FromDate2Value	,$Theme );
	$Theme = VarTheme('{ConctactMethode2Value}', $ConctactMethode2Value	,$Theme );
	$Theme = VarTheme('{CompName2Value}', $CompName2Value	,$Theme );
	$Theme = VarTheme('{WhyLeft1Value}', $WhyLeft1Value	,$Theme );
	$Theme = VarTheme('{LastMonthSalary1Value}', $LastMonthSalary1Value	,$Theme );
	$Theme = VarTheme('{OldJob1Value}', $OldJob1Value	,$Theme );
	$Theme = VarTheme('{ToDate1Value}', $ToDate1Value	,$Theme );
	$Theme = VarTheme('{FromDate1Value}', $FromDate1Value	,$Theme );
	$Theme = VarTheme('{ConctactMethode1Value}', $ConctactMethode1Value	,$Theme );
	$Theme = VarTheme('{CompName1Value}', $CompName1Value	,$Theme );
	$Theme = VarTheme('{OtherExperienceValue}', $OtherExperienceValue	,$Theme );
	$Theme = VarTheme('{ProgramerValue}', $ProgramerValue	,$Theme );
	$Theme = VarTheme('{SupportValue}', $SupportValue	,$Theme );
	$Theme = VarTheme('{DriverValue}', $DriverValue	,$Theme );
	$Theme = VarTheme('{SpeakUnderMoyen3Value}', $SpeakUnderMoyen3Value	,$Theme );
	$Theme = VarTheme('{SpeakMoyen3Value}', $SpeakMoyen3Value	,$Theme );
	$Theme = VarTheme('{SpeakGood3Value}', $SpeakGood3Value	,$Theme );
	$Theme = VarTheme('{SpeakExcellent3Value}', $SpeakExcellent3Value	,$Theme );
	$Theme = VarTheme('{WriteUnderMoyen3Value}', $WriteUnderMoyen3Value	,$Theme );
	$Theme = VarTheme('{WriteMoyen3Value}', $WriteMoyen3Value	,$Theme );
	$Theme = VarTheme('{WriteGood3Value}', $WriteGood3Value	,$Theme );
	$Theme = VarTheme('{WriteExcellent3Value}', $WriteExcellent3Value	,$Theme );
	$Theme = VarTheme('{ReadUnderMoyen3Value}', $ReadUnderMoyen3Value	,$Theme );
	$Theme = VarTheme('{ReadMoyen3Value}', $ReadMoyen3Value	,$Theme );
	$Theme = VarTheme('{ReadGood3Value}', $ReadGood3Value	,$Theme );
	$Theme = VarTheme('{LangName3Value}', $LangName3Value	,$Theme );
	$Theme = VarTheme('{SpeakUnderMoyen2Value}', $SpeakUnderMoyen2Value	,$Theme );
	$Theme = VarTheme('{SpeakMoyen2Value}', $SpeakMoyen2Value	,$Theme );
	$Theme = VarTheme('{SpeakGood2Value}', $SpeakGood2Value	,$Theme );
	$Theme = VarTheme('{SpeakExcellent2Value}', $SpeakExcellent2Value	,$Theme );
	$Theme = VarTheme('{WriteUnderMoyen2Value}', $WriteUnderMoyen2Value	,$Theme );
	$Theme = VarTheme('{WriteMoyen2Value}', $WriteMoyen2Value	,$Theme );
	$Theme = VarTheme('{WriteGood2Value}', $WriteGood2Value	,$Theme );
	$Theme = VarTheme('{ReadUnderMoyen2Value}', $ReadUnderMoyen2Value	,$Theme );
	$Theme = VarTheme('{ReadMoyen2Value}', $ReadMoyen2Value	,$Theme );
	$Theme = VarTheme('{ReadGood2Value}', $ReadGood2Value	,$Theme );
	$Theme = VarTheme('{ReadExcellent2Value}', $ReadExcellent2Value	,$Theme );
	$Theme = VarTheme('{ReadExcellent2Value}', $ReadExcellent2Value	,$Theme );
	$Theme = VarTheme('{LangName2Value}', $LangName2Value	,$Theme );
	$Theme = VarTheme('{SpeakUnderMoyen1Value}', $SpeakUnderMoyen1Value	,$Theme );
	$Theme = VarTheme('{SpeakMoyen1Value}', $SpeakMoyen1Value	,$Theme );
	$Theme = VarTheme('{SpeakGood1Value}', $SpeakGood1Value	,$Theme );
	$Theme = VarTheme('{SpeakExcellent1Value}', $SpeakExcellent1Value	,$Theme );
	$Theme = VarTheme('{WriteUnderMoyen1Value}', $WriteUnderMoyen1Value	,$Theme );
	$Theme = VarTheme('{WriteMoyen1Value}', $WriteMoyen1Value	,$Theme );
	$Theme = VarTheme('{WriteGood1Value}', $WriteGood1Value	,$Theme );
	$Theme = VarTheme('{WriteExcellent1Value}', $WriteExcellent1Value	,$Theme );
	$Theme = VarTheme('{ReadUnderMoyen1Value}', $ReadUnderMoyen1Value	,$Theme );
	$Theme = VarTheme('{ReadMoyen1Value}', $ReadMoyen1Value	,$Theme );
	$Theme = VarTheme('{ReadGood1Value}', $ReadGood1Value	,$Theme );
	$Theme = VarTheme('{ReadExcellent1Value}', $ReadExcellent1Value	,$Theme );
	$Theme = VarTheme('{LangName1Value}', $LangName1Value	,$Theme );
	$Theme = VarTheme('{CycleDate5Value}', $CycleDate5Value	,$Theme );
	$Theme = VarTheme('{CycleFrom5Value}', $CycleFrom5Value	,$Theme );
	$Theme = VarTheme('{SkillsFromCycle15Value}', $SkillsFromCycle15Value	,$Theme );
	$Theme = VarTheme('{CycleInterval5Value}', $CycleInterval5Value	,$Theme );
	$Theme = VarTheme('{CycleName5Value}', $CycleName5Value	,$Theme );
	$Theme = VarTheme('{CycleDate4Value}', $CycleDate4Value	,$Theme );
	$Theme = VarTheme('{CycleFrom4Value}', $CycleFrom4Value	,$Theme );
	$Theme = VarTheme('{SkillsFromCycle14Value}', $SkillsFromCycle14Value	,$Theme );
	$Theme = VarTheme('{CycleInterval4Value}', $CycleInterval4Value	,$Theme );
	$Theme = VarTheme('{CycleName4Value}', $CycleName4Value	,$Theme );
	$Theme = VarTheme('{CycleDate3Value}', $CycleDate3Value	,$Theme );
	$Theme = VarTheme('{CycleFrom3Value}', $CycleFrom3Value	,$Theme );
	$Theme = VarTheme('{SkillsFromCycle13Value}', $SkillsFromCycle13Value	,$Theme );
	$Theme = VarTheme('{CycleInterval1Value}', $CycleInterval1Value	,$Theme );
	$Theme = VarTheme('{CycleInterval3Value}', $CycleInterval3Value	,$Theme );
	$Theme = VarTheme('{CycleName3Value}', $CycleName3Value	,$Theme );
	$Theme = VarTheme('{CycleDate2Value}', $CycleDate2Value	,$Theme );
	$Theme = VarTheme('{CycleFrom2Value}', $CycleFrom2Value	,$Theme );
	$Theme = VarTheme('{SkillsFromCycle12Value}', $SkillsFromCycle12Value,$Theme );
	$Theme = VarTheme('{CycleInterval2Value}', $CycleInterval2Value,$Theme );
	$Theme = VarTheme('{CycleName2Value}', $CycleName2Value,$Theme );
	$Theme = VarTheme('{CycleDate1Value}', $CycleDate1Value,$Theme );
	$Theme = VarTheme('{CycleFrom1Value}', $CycleFrom1Value,$Theme );
	$Theme = VarTheme('{SkillsFromCycle1Value}', $SkillsFromCycle1Value,$Theme );
	$Theme = VarTheme('{CertifecateYear5Value}', $CertifecateYear5Value,$Theme );
	$Theme = VarTheme('{CertifecateFrom5Value}', $CertifecateFrom5Value,$Theme );
	$Theme = VarTheme('{Average5Value}', $Average5Value,$Theme );
	$Theme = VarTheme('{EducationLevel5Value}', $EducationLevel5Value,$Theme );
	$Theme = VarTheme('{CertifecateYear4Value}', $CertifecateYear4Value,$Theme );
	$Theme = VarTheme('{CertifecateFrom14Value}', $CertifecateFrom14Value,$Theme );
	$Theme = VarTheme('{Average14Value}', $Average14Value,$Theme );
	$Theme = VarTheme('{EducationLevel4Value}', $EducationLevel4Value,$Theme );
	$Theme = VarTheme('{CertifecateYear3Value}', $CertifecateYear3Value,$Theme );
	$Theme = VarTheme('{CertifecateFrom3}', $CertifecateFrom3Value,$Theme );
	$Theme = VarTheme('{TalkingValue}', $TalkingValue,$Theme );
	$Theme = VarTheme('{ViewingValue}', $ViewingValue,$Theme );
	$Theme = VarTheme('{HearingValue}', $HearingValue,$Theme );
	$Theme = VarTheme('{HealthStatusValue}', $HealthStatusValue,$Theme );
	$Theme = VarTheme('{BirthDate6Value}', $BirthDate6Value,$Theme );
	$Theme = VarTheme('{Sex6Value}', $Sex6Value,$Theme );
	$Theme = VarTheme('{Relative6Value}', $Relative6Value,$Theme );
	$Theme = VarTheme('{SpendName6Value}', $SpendName6Value,$Theme );
	$Theme = VarTheme('{BirthDate5Value}', $BirthDate5Value,$Theme );
	$Theme = VarTheme('{Sex5Value}', $Sex5Value,$Theme );
	$Theme = VarTheme('{SpendName6Value}', $SpendName6Value,$Theme );
	$Theme = VarTheme('{SpendName5Value}', $SpendName5Value,$Theme );
	$Theme = VarTheme('{BirthDate4Value}', $BirthDate4Value,$Theme );
	$Theme = VarTheme('{Sex4Value}', $Sex4Value,$Theme );
	$Theme = VarTheme('{Relative4Value}', $Relative4Value,$Theme );
	$Theme = VarTheme('{SpendName4Value}', $SpendName4Value,$Theme );
	$Theme = VarTheme('{BirthDate3Value}', $BirthDate3Value,$Theme );
	$Theme = VarTheme('{Sex3Value}', $Sex3Value,$Theme );
	$Theme = VarTheme('{Relative3Value}', $Relative3Value,$Theme );
	$Theme = VarTheme('{SpendName3Value}', $SpendName3Value,$Theme );
	$Theme = VarTheme('{BirthDate2Value}', $BirthDate2Value,$Theme );
	$Theme = VarTheme('{Sex2Value}', $Sex2Value,$Theme );
	$Theme = VarTheme('{Relative2Value}', $Relative2Value,$Theme );
	$Theme = VarTheme('{SpendName2Value}', $SpendName2Value,$Theme );
	$Theme = VarTheme('{BirthDate1Value}', $BirthDate1Value,$Theme );
	$Theme = VarTheme('{Sex1Value}', $Sex1Value,$Theme );
	$Theme = VarTheme('{Relative1Value}', $Relative1Value,$Theme );
	$Theme = VarTheme('{FirstNameValue}', $FirstNameValue,$Theme );
	$Theme = VarTheme('{FatherNameValue}', $FatherNameValue,$Theme );
	$Theme = VarTheme('{MotherNameValue}', $MotherNameValue,$Theme );
	$Theme = VarTheme('{GrandFatherNameValue}', $GrandFatherNameValue,$Theme );
	$Theme = VarTheme('{FamilyNameValue}', $FamilyNameValue,$Theme );
	$Theme = VarTheme('{BirthDateValue}', $BirthDateValue,$Theme );
	$Theme = VarTheme('{BirthLocationValue}', $BirthLocationValue,$Theme );
	$Theme = VarTheme('{SexValue}', $SexValue,$Theme );
	$Theme = VarTheme('{NationalityValue}', $NationalityValue,$Theme );
	$Theme = VarTheme('{SegelNbrValue}', $SegelNbrValue,$Theme );
	$Theme = VarTheme('{SegelLocationValue}', $SegelLocationValue,$Theme );
	$Theme = VarTheme('{DamanNbrValue}', $DamanNbrValue,$Theme );
	$Theme = VarTheme('{MariageValue}', $MariageValue,$Theme );
	$Theme = VarTheme('{WidowerValue}', $WidowerValue,$Theme );
	$Theme = VarTheme('{DivorcedValue}', $DivorcedValue,$Theme );
	$Theme = VarTheme('{FianceValue}', $FianceValue,$Theme );
	$Theme = VarTheme('{SpendName1Value}', $SpendName1Value,$Theme );
	$Theme = VarTheme('{DidUSmokeYesValue}', $DidUSmokeYesValue,$Theme );
	$Theme = VarTheme('{DidUSmokeNoValue}', $DidUSmokeNoValue,$Theme );
	$Theme = VarTheme('{DidUDoObligingYesValue}', $DidUDoObligingYesValue,$Theme );
	$Theme = VarTheme('{DidUDoObligingNoValue}', $DidUDoObligingNoValue,$Theme );
	$Theme = VarTheme('{ObligingOtherValue}', $ObligingOtherValue,$Theme );
	$Theme = VarTheme('{TownValue}', $TownValue,$Theme );
	$Theme = VarTheme('{RueValue}', $RueValue,$Theme );
	$Theme = VarTheme('{BuildingValue}', $BuildingValue,$Theme );
	$Theme = VarTheme('{BuildOwnerValue}', $BuildOwnerValue,$Theme );
	$Theme = VarTheme('{PhoneValue}', $PhoneValue,$Theme );
	$Theme = VarTheme('{CellulaireValue}', $CellulaireValue,$Theme );
	$Theme = VarTheme('{EmailValue}', $EmailValue,$Theme );
	$Theme = VarTheme('{EducationLevel1Value}', $EducationLevel1Value,$Theme );
	$Theme = VarTheme('{Average1Value}', $Average1Value,$Theme );
	$Theme = VarTheme('{CertifecateFrom1Value}', $CertifecateFrom1Value,$Theme );
	$Theme = VarTheme('{Average2Value}', $Average2Value,$Theme );
	$Theme = VarTheme('{CertifecateFrom2Value}', $CertifecateFrom2Value,$Theme );
	$Theme = VarTheme('{CertifecateYear2Value}', $CertifecateYear2Value,$Theme );
	$Theme = VarTheme('{EducationLevel3Value}', $EducationLevel3Value,$Theme );
	$Theme = VarTheme('{Average3Value}', $Average3Value,$Theme );
	$Theme = VarTheme('{EducationLevel2Value}', $EducationLevel2Value,$Theme );
	$Theme = VarTheme('{CertifecateYear1Value}', $CertifecateYear1Value,$Theme );
	$Theme = VarTheme('{CycleName1Value}', $CycleName1Value,$Theme );
	$Theme = VarTheme('{DontKnowValue}', $DontKnowValue,$Theme );
	$Theme = VarTheme('{WriteExcellent2Value}', $WriteExcellent2Value,$Theme );
	$Theme = VarTheme('{ReadExcellent3Value}', $ReadExcellent3Value,$Theme );


	$Theme = VarTheme('{InThisField}',  (InThisField),$Theme );
	$Theme = VarTheme('{PleaseEnterthisCVCode}',  (PleaseEnterthisCVCode),$Theme );
	$Theme = VarTheme('{Invalidformat}',  (Invalidformat),$Theme );
	$Theme = VarTheme('{submit}',  (submit),$Theme );
	$Theme = VarTheme('{TrueInfo}',  (TrueInfo),$Theme );
	$Theme = VarTheme('{MaxImageSizeMustBe}',  (MaxImageSizeMustBe),$Theme );
	$Theme = VarTheme('{YouPicture}',  (YouPicture),$Theme );
	$Theme = VarTheme('{OutJobDesc}',  (OutJobDesc),$Theme );
	$Theme = VarTheme('{OutContact}',  (OutContact),$Theme );
	$Theme = VarTheme('{OutName}',  (OutName),$Theme );
	$Theme = VarTheme('{WriteThreeNamesUKnowFromOutsideTheCompany}',  (WriteThreeNamesUKnowFromOutsideTheCompany),$Theme );
	$Theme = VarTheme('{DoYouHaveNearbyInTheCompany}',  (DoYouHaveNearbyInTheCompany),$Theme );
	$Theme = VarTheme('{ifYesWriteCVNumberHereAndDate}',  (ifYesWriteCVNumberHereAndDate),$Theme );
	$Theme = VarTheme('{DidYouSendUsAnCV}',  (DidYouSendUsAnCV),$Theme );
	$Theme = VarTheme('{TalkAboutSkillsInThisJob}',  (TalkAboutSkillsInThisJob),$Theme );
	$Theme = VarTheme('{WishedSalary}',  (WishedSalary),$Theme );
	$Theme = VarTheme('{WhenUCanStart}',  (WhenUCanStart),$Theme );
	$Theme = VarTheme('{WhatJobYouWish}',  (WhatJobYouWish),$Theme );
	$Theme = VarTheme('{WhyYouWantToJoin}',  (WhyYouWantToJoin),$Theme );
	$Theme = VarTheme('{HowDoYouHearAboutUs}',  (HowDoYouHearAboutUs),$Theme );
	$Theme = VarTheme('{DoYouRejectCallingOldJob}',  (DoYouRejectCallingOldJob),$Theme );
	$Theme = VarTheme('{DoYouRejectWorkOverTime}',  (DoYouRejectWorkOverTime),$Theme );
	$Theme = VarTheme('{DiduDoAnotherJobsOverTime}',  (DiduDoAnotherJobsOverTime),$Theme );
	$Theme = VarTheme('{MustExcutingInOldJobs}',  (MustExcutingInOldJobs),$Theme );
	$Theme = VarTheme('{WhyLeft}',  (WhyLeft),$Theme );
	$Theme = VarTheme('{LastSalary}',  (LastSalary),$Theme );
	$Theme = VarTheme('{OldJob}',  (OldJob),$Theme );
	$Theme = VarTheme('{ToDate}',  (ToDate),$Theme );
	$Theme = VarTheme('{FromDate}',  (FromDate),$Theme );
	$Theme = VarTheme('{ConctactMethode}',  (ConctactMethode),$Theme );
	$Theme = VarTheme('{CompName}',  (CompName),$Theme );
	$Theme = VarTheme('{OtherExperience}',  (OtherExperience),$Theme );
	$Theme = VarTheme('{Programer}',  (Programer),$Theme );
	$Theme = VarTheme('{Support}',  (Support_job),$Theme );
	$Theme = VarTheme('{Driver}',  (Driver),$Theme );
	$Theme = VarTheme('{DontKnow}',  (DontKnow),$Theme );
	$Theme = VarTheme('{LevelInComputer}',  (LevelInComputer),$Theme );
	$Theme = VarTheme('{UnderMoyen}',  (UnderMoyen),$Theme );
	$Theme = VarTheme('{Moyen}',  (Moyen),$Theme );
	$Theme = VarTheme('{Good}',  (Good),$Theme );
	$Theme = VarTheme('{Excellent}',  (Excellent),$Theme );
	$Theme = VarTheme('{Speak}',  (Speak),$Theme );
	$Theme = VarTheme('{Write}',  (Write),$Theme );
	$Theme = VarTheme('{Read}',  (Read),$Theme );
	$Theme = VarTheme('{LangName}',  (LangName),$Theme );
	$Theme = VarTheme('{ForeignLang}',  (ForeignLang),$Theme );
	$Theme = VarTheme('{CycleFrom}',  (CycleFrom),$Theme );
	$Theme = VarTheme('{CycleDate}',  (CycleDate),$Theme );
	$Theme = VarTheme('{SkillsFromCycle}',  (SkillsFromCycle),$Theme );
	$Theme = VarTheme('{CycleInterval}',  (CycleInterval),$Theme );
	$Theme = VarTheme('{CycleName}',  (CycleName),$Theme );
	$Theme = VarTheme('{SpecialCycles}',  (SpecialCycles),$Theme );
	$Theme = VarTheme('{CertifecateYear}',  (CertifecateYear),$Theme );
	$Theme = VarTheme('{CertifecateFrom}',  (CertifecateFrom),$Theme );
	$Theme = VarTheme('{Average}',  (Average),$Theme );
	$Theme = VarTheme('{EducationLevel}',  (EducationLevel),$Theme );
	$Theme = VarTheme('{EducationSkills}',  (EducationSkills),$Theme );
	$Theme = VarTheme('{Email}',  (Email),$Theme );
	$Theme = VarTheme('{Cellulaire}',  (Cellulaire),$Theme );
	$Theme = VarTheme('{Phone}',  (Phone),$Theme );
	$Theme = VarTheme('{BuildOwner}',  (BuildOwner),$Theme );
	$Theme = VarTheme('{Building}',  (Building),$Theme );
	$Theme = VarTheme('{Rue}',  (Rue),$Theme );
	$Theme = VarTheme('{Town}',  (Town),$Theme );
	$Theme = VarTheme('{ContactInfo}',  (ContactInfo),$Theme );
	$Theme = VarTheme('{ObligingOther}',  (ObligingOther),$Theme );
	$Theme = VarTheme('{DidUDoObliging}',  (DidUDoObliging),$Theme );
	$Theme = VarTheme('{No}',  (no),$Theme );
	$Theme = VarTheme('{Yes}',  (yes),$Theme );
	$Theme = VarTheme('{DidUSmoke}',  (DidUSmoke),$Theme );
	$Theme = VarTheme('{Talking}',  (Talking),$Theme );
	$Theme = VarTheme('{Viewing}',  (Viewing),$Theme );
	$Theme = VarTheme('{Hearing}',  (Hearing),$Theme );
	$Theme = VarTheme('{DidUInfectedIn}',  (DidUInfectedIn),$Theme );
	$Theme = VarTheme('{HealthStatus}',  (HealthStatus),$Theme );
	$Theme = VarTheme('{Relative}',  (Relative),$Theme );
	$Theme = VarTheme('{SpendName}',  (SpendName),$Theme );
	$Theme = VarTheme('{Fiance}',  (Fiance),$Theme );
	$Theme = VarTheme('{Divorced}',  (Divorced),$Theme );
	$Theme = VarTheme('{Widower}',  (Widower),$Theme );
	$Theme = VarTheme('{Mariage}',  (Mariage),$Theme );
	$Theme = VarTheme('{Celibate}',  (Celibate),$Theme );
	$Theme = VarTheme('{CelibateValue}',  (MaritalStatus),$Theme );
	$Theme = VarTheme('{MaritalStatus}',  (MaritalStatus),$Theme );
	$Theme = VarTheme('{DamanNbr}',  (DamanNbr),$Theme );
	$Theme = VarTheme('{SegelLocation}',  (SegelLocation),$Theme );
	$Theme = VarTheme('{SegelNbr}',  (SegelNbr),$Theme );
	$Theme = VarTheme('{Nationality}',  (Nationality),$Theme );
	$Theme = VarTheme('{Sex}',  (Sex),$Theme );
	$Theme = VarTheme('{FatherName}',  (FatherName),$Theme );
	$Theme = VarTheme('{MotherName}',  (MotherName),$Theme );
	$Theme = VarTheme('{GrandFatherName}',  (GrandFatherName),$Theme );
	$Theme = VarTheme('{FamilyName}',  (FamilyName),$Theme );
	$Theme = VarTheme('{BirthDate}',  (BirthDate),$Theme );
	$Theme = VarTheme('{BirthLocation}',  (BirthLocation),$Theme );
	$Theme = VarTheme('{Avalueisrequired}',  (Avalueisrequired),$Theme );
	$Theme = VarTheme('{Pleasemakeaselection}',  (Pleasemakeaselection),$Theme );
	$Theme = VarTheme('{CvNotes}',  (CvNotes),$Theme );
	$Theme = VarTheme('{PersonalInfo}',  (PersonalInfo),$Theme );
	$Theme = VarTheme('{FirstName}',  (FirstName),$Theme );
	echo $Theme;
}//end if


?>