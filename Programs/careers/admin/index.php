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
require_once('includes/upload.class.php');

global $ThemeName,$CustomHead,$conn,$Lang,$TotalRecords,$Rows ,$Recordset  ;

include_once('Programs/careers/admin/Languages/lang-'.$Lang.'.php');
$CustomHead .= '<script src="Programs/careers/Themes/Default/SpryValidationTextField.js" type="text/javascript"></script>
				<script src="Programs/careers/Themes/Default/SpryValidationCheckbox.js" type="text/javascript"></script>
				<link href="Programs/careers/Themes/Default/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

				<link href="Programs/careers/Themes/Default/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />';
if(isset($_GET['CvId'])){

	if(isset($_GET['findel'])){
		if($_GET['findel']=="yes"){
			$CvDel = "delete from `careers` where `CvId`='".InputFilter($_GET['CvId'])."' ;";
			$RsCV = mysqli_query($conn,$CvDel);	
			echo  (successDeleteCvNbr).InputFilter($_GET['CvId']);
		}//end if
	}
	else{
		//show cv info
		$CvId 	= InputFilter($_GET['CvId']);
		
		$CVSql = "select * from `careers` where `CvId`=".$CvId .";";	
		ExcuteQuery($CVSql);
		if($TotalRecords>0){
			$FirstNameValue 		= $Rows['FirstNameValue'];
			$FatherNameValue 		= $Rows['FatherNameValue'];
			$MotherNameValue 		= $Rows['MotherNameValue'];
			$GrandFatherNameValue 	= $Rows['GrandFatherNameValue'];
			$FamilyNameValue 		= $Rows['FamilyNameValue'];
			$BirthDateValue 		= $Rows['BirthDateValue'];
			$BirthLocationValue 	= $Rows['BirthLocationValue'];
			$CertifecateFrom3Value  = $Rows['CertifecateFrom3Value'];
			if($Rows['SexValue']=="1"){
				$SexValue = '<option value="1">'. (male).'</option>';
			}
			else{
				$SexValue = '<option value="0">'. (female).'</option>';
			}//endif
			
			$NationalityValue 		= $Rows['NationalityValue'];
			$SegelNbrValue 			= $Rows['SegelNbrValue'];
			$SegelLocationValue 	= $Rows['SegelLocationValue'];
			$DamanNbrValue		 	= $Rows['DamanNbrValue'];
			if($Rows['celibateValue']=="1"){
				$celibateValue		 	= ' checked="checked" ';
			}
			else{
				$celibateValue		 	= " ";
			}//end if
			if($Rows['MariageValue']=="1"){
				$MariageValue		 	= ' checked="checked" ';
			}
			else{
				$MariageValue		 	= " ";
			}//end if
			if($Rows['WidowerValue']=="1"){
				$WidowerValue		 	= ' checked="checked" ';
			}
			else{
				$WidowerValue		 	= " ";
			}//end if
			if($Rows['DivorcedValue']=="1"){
				$DivorcedValue		 	= ' checked="checked" ';
			}
			else{
				$DivorcedValue		 	= " ";
			}//end if
			if($Rows['FianceValue']=="1"){
				$FianceValue		 	= ' checked="checked" ';
			}
			else{
				$FianceValue		 	= " ";
			}//end if
			

			$SpendName1Value		= $Rows['SpendName1Value'];
			$Relative1Value		 	= $Rows['Relative1Value'];
			if($Rows['Sex1Value']=="1"){
				$Sex1Value = '<option value="1">'. (male).'</option>';
			}
			else{
				$Sex1Value = '<option value="0">'. (female).'</option>';
			}//endif
			
			$BirthDate1Value		= $Rows['BirthDate1Value'];
			$SpendName2Value		= $Rows['SpendName2Value'];
			$Relative2Value			= $Rows['Relative2Value'];
			if($Rows['Sex2Value']=="1"){
				$Sex2Value = '<option value="1">'. (male).'</option>';
			}
			else{
				$Sex2Value = '<option value="0">'. (female).'</option>';
			}//endif
			
			$BirthDate2Value		= $Rows['BirthDate2Value'];
			$SpendName3Value		= $Rows['SpendName3Value'];
			$Relative3Value			= $Rows['Relative3Value'];
			if($Rows['Sex3Value']=="1"){
				$Sex3Value = '<option value="1">'. (male).'</option>';
			}
			else{
				$Sex3Value = '<option value="0">'. (female).'</option>';
			}//endif
			$BirthDate3Value		= $Rows['BirthDate3Value'];
			$SpendName4Value		= $Rows['SpendName4Value'];
			$Relative4Value			= $Rows['Relative4Value'];
			if($Rows['Sex4Value']=="1"){
				$Sex4Value = '<option value="1">'. (male).'</option>';
			}
			else{
				$Sex4Value = '<option value="0">'. (female).'</option>';
			}//endif
			$BirthDate4Value		= $Rows['BirthDate4Value'];
			$SpendName5Value		= $Rows['SpendName5Value'];
			$SpendName6Value		= $Rows['SpendName6Value'];
			if($Rows['Sex5Value']=="1"){
				$Sex5Value = '<option value="1">'. (male).'</option>';
			}
			else{
				$Sex5Value = '<option value="0">'. (female).'</option>';
			}//endif
			$BirthDate5Value		= $Rows['BirthDate5Value'];
			$SpendName6Value		= $Rows['SpendName6Value'];
			$Relative6Value			= $Rows['Relative6Value'];
			if($Rows['Sex6Value']=="1"){
				$Sex6Value = '<option value="1">'. (male).'</option>';
			}
			else{
				$Sex6Value = '<option value="0">'. (female).'</option>';
			}//endif

			$BirthDate6Value		= $Rows['BirthDate6Value'];
			$HealthStatusValue		= $Rows['HealthStatusValue'];
			if($Rows['HearingValue']=="1"){
				$HearingValue		 	= ' checked="checked" ';
			}
			else{
				$HearingValue		 	= " ";
			}//end if
			if($Rows['ViewingValue']=="1"){
				$ViewingValue		 	= ' checked="checked" ';
			}
			else{
				$ViewingValue		 	= " ";
			}//end if
			if($Rows['TalkingValue']=="1"){
				$TalkingValue		 	= ' checked="checked" ';
			}
			else{
				$TalkingValue		 	= " ";
			}//end if
			if($Rows['DidUSmokeYesValue']=="1"){
				$DidUSmokeYesValue		 	= ' checked="checked" ';
			}
			else{
				$DidUSmokeYesValue		 	= " ";
			}//end if		
			if($Rows['DidUSmokeNoValue']=="1"){
				$DidUSmokeNoValue		 	= ' checked="checked" ';
			}
			else{
				$DidUSmokeNoValue		 	= " ";
			}//end if	
			if($Rows['DidUDoObligingYesValue']=="1"){
				$DidUDoObligingYesValue		 	= ' checked="checked" ';
			}
			else{
				$DidUDoObligingYesValue		 	= " ";
			}//end if			
			if($Rows['DidUDoObligingNoValue']=="1"){
				$DidUDoObligingNoValue		 	= ' checked="checked" ';
			}
			else{
				$DidUDoObligingNoValue		 	= " ";
			}//end if		
			
			$ObligingOtherValue		= $Rows['ObligingOtherValue'];
			$TownValue				= $Rows['TownValue'];
			$RueValue				= $Rows['RueValue'];
			$BuildingValue			= $Rows['BuildingValue'];
			$BuildOwnerValue		= $Rows['BuildOwnerValue'];
			$PhoneValue				= $Rows['PhoneValue'];
			$CellulaireValue		= $Rows['CellulaireValue'];
			$EmailValue				= $Rows['EmailValue'];
			$EducationLevel1Value	= $Rows['EducationLevel1Value'];
			$Average1Value			= $Rows['Average1Value'];
			$CertifecateFrom1Value	= $Rows['CertifecateFrom1Value'];
			$CertifecateYear1Value	= $Rows['CertifecateYear1Value'];
			$EducationLevel2Value	= $Rows['EducationLevel2Value'];
			$Average2Value			= $Rows['Average2Value'];
			$CertifecateFrom2Value	= $Rows['CertifecateFrom2Value'];
			$CertifecateYear2Value	= $Rows['CertifecateYear2Value'];
			$EducationLevel3Value	= $Rows['EducationLevel3Value'];
			$Average3Value			= $Rows['Average3Value'];
			$CertifecateFrom3		= $Rows['CertifecateFrom3'];
			$CertifecateYear3Value	= $Rows['CertifecateYear3Value'];
			$EducationLevel4Value	= $Rows['EducationLevel4Value'];
			$Average14Value			= $Rows['Average14Value'];
			$CertifecateFrom14Value	= $Rows['CertifecateFrom14Value'];
			$CertifecateYear4Value	= $Rows['CertifecateYear4Value'];
			$EducationLevel5Value	= $Rows['EducationLevel5Value'];
			$Average5Value			= $Rows['Average5Value'];
			$CertifecateFrom5Value	= $Rows['CertifecateFrom5Value'];
			$CertifecateYear5Value	= $Rows['CertifecateYear5Value'];
			$CycleName1Value		= $Rows['CycleName1Value'];
			$SkillsFromCycle1Value	= $Rows['SkillsFromCycle1Value'];
			$CycleFrom1Value		= $Rows['CycleFrom1Value'];
			$CycleDate1Value		= $Rows['CycleDate1Value'];
			$CycleName2Value		= $Rows['CycleName2Value'];
			$CycleInterval2Value	= $Rows['CycleInterval2Value'];
			$SkillsFromCycle12Value	= $Rows['SkillsFromCycle12Value'];
			$CycleFrom2Value		= $Rows['CycleFrom2Value'];
			$CycleName3Value		= $Rows['CycleName3Value'];
			$CycleInterval3Value	= $Rows['CycleInterval3Value'];
			$CycleDate2Value 		= $Rows['CycleDate2Value'];
			$CycleInterval1Value	= $Rows['CycleInterval1Value'];
			$SkillsFromCycle13Value	= $Rows['SkillsFromCycle13Value'];
			$CycleFrom3Value		= $Rows['CycleFrom3Value'];
			$CycleDate3Value		= $Rows['CycleDate3Value'];
			$CycleName4Value		= $Rows['CycleName4Value'];
			$CycleInterval4Value	= $Rows['CycleInterval4Value'];
			$SkillsFromCycle14Value	= $Rows['SkillsFromCycle14Value'];
			$CycleFrom4Value		= $Rows['CycleFrom4Value'];
			$CycleDate4Value		= $Rows['CycleDate4Value'];
			$CycleName5Value		= $Rows['CycleName5Value'];
			$CycleInterval5Value	= $Rows['CycleInterval5Value'];
			$SkillsFromCycle15Value	= $Rows['SkillsFromCycle15Value'];
			$CycleFrom5Value		= $Rows['CycleFrom5Value'];
			$CycleDate5Value		= $Rows['CycleDate5Value'];
			
			$LangName1Value			= $Rows['LangName1Value'];
			

			if($Rows['ReadExcellent1Value']=="1"){
				$ReadExcellent1Value		 	= ' checked="checked" ';
			}
			else{
				$ReadExcellent1Value		 	= " ";
			}//end if	
			if($Rows['ReadGood1Value']=="1"){
				$ReadGood1Value		 	= ' checked="checked" ';
			}
			else{
				$ReadGood1Value		 	= " ";
			}//end if			
			if($Rows['ReadMoyen1Value']=="1"){
				$ReadMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$ReadMoyen1Value		 	= " ";
			}//end if	
			if($Rows['ReadUnderMoyen1Value']=="1"){
				$ReadUnderMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$ReadUnderMoyen1Value		 	= " ";
			}//end if	
			if($Rows['WriteExcellent1Value']=="1"){
				$WriteExcellent1Value		 	= ' checked="checked" ';
			}
			else{
				$WriteExcellent1Value		 	= " ";
			}//end if			
			if($Rows['WriteGood1Value']=="1"){
				$WriteGood1Value		 	= ' checked="checked" ';
			}
			else{
				$WriteGood1Value		 	= " ";
			}//end if	
			if($Rows['WriteMoyen1Value']=="1"){
				$WriteMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$WriteMoyen1Value		 	= " ";
			}//end if
			if($Rows['WriteUnderMoyen1Value']=="1"){
				$WriteUnderMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$WriteUnderMoyen1Value		 	= " ";
			}//end if
			if($Rows['WriteUnderMoyen1Value']=="1"){
				$WriteUnderMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$WriteUnderMoyen1Value		 	= " ";
			}//end if		
			if($Rows['SpeakExcellent1Value']=="1"){
				$SpeakExcellent1Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakExcellent1Value		 	= " ";
			}//end if		
			if($Rows['SpeakGood1Value']=="1"){
				$SpeakGood1Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakGood1Value		 	= " ";
			}//end if				
			if($Rows['SpeakMoyen1Value']=="1"){
				$SpeakMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakMoyen1Value		 	= " ";
			}//end if	
			if($Rows['SpeakUnderMoyen1Value']=="1"){
				$SpeakUnderMoyen1Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakUnderMoyen1Value		 	= " ";
			}//end if	

			
			$LangName2Value			= $Rows['LangName2Value'];
			

			if($Rows['ReadExcellent2Value']=="1"){
				$ReadExcellent2Value		 	= ' checked="checked" ';
			}
			else{
				$ReadExcellent2Value		 	= " ";
			}//end if	
			if($Rows['ReadGood2Value']=="1"){
				$ReadGood2Value		 	= ' checked="checked" ';
			}
			else{
				$ReadGood2Value		 	= " ";
			}//end if			
			if($Rows['ReadMoyen2Value']=="1"){
				$ReadMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$ReadMoyen2Value		 	= " ";
			}//end if	
			if($Rows['ReadUnderMoyen2Value']=="1"){
				$ReadUnderMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$ReadUnderMoyen2Value		 	= " ";
			}//end if	
			if($Rows['WriteExcellent2Value']=="1"){
				$WriteExcellent2Value		 	= ' checked="checked" ';
			}
			else{
				$WriteExcellent2Value		 	= " ";
			}//end if			
			if($Rows['WriteGood2Value']=="1"){
				$WriteGood2Value		 	= ' checked="checked" ';
			}
			else{
				$WriteGood2Value		 	= " ";
			}//end if	
			if($Rows['WriteMoyen2Value']=="1"){
				$WriteMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$WriteMoyen2Value		 	= " ";
			}//end if
			if($Rows['WriteUnderMoyen2Value']=="1"){
				$WriteUnderMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$WriteUnderMoyen2Value		 	= " ";
			}//end if
			if($Rows['WriteUnderMoyen2Value']=="1"){
				$WriteUnderMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$WriteUnderMoyen2Value		 	= " ";
			}//end if		
			if($Rows['SpeakExcellent2Value']=="1"){
				$SpeakExcellent2Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakExcellent2Value		 	= " ";
			}//end if		
			if($Rows['SpeakGood2Value']=="1"){
				$SpeakGood2Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakGood2Value		 	= " ";
			}//end if				
			if($Rows['SpeakMoyen2Value']=="1"){
				$SpeakMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakMoyen2Value		 	= " ";
			}//end if	
			if($Rows['SpeakUnderMoyen2Value']=="1"){
				$SpeakUnderMoyen2Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakUnderMoyen2Value		 	= " ";
			}//end if	

			
			$LangName3Value			= $Rows['LangName3Value'];


			if($Rows['ReadExcellent3Value']=="1"){
				$ReadExcellent3Value		 	= ' checked="checked" ';
			}
			else{
				$ReadExcellent3Value		 	= " ";
			}//end if	
			if($Rows['ReadGood3Value']=="1"){
				$ReadGood3Value		 	= ' checked="checked" ';
			}
			else{
				$ReadGood3Value		 	= " ";
			}//end if			
			if($Rows['ReadMoyen3Value']=="1"){
				$ReadMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$ReadMoyen3Value		 	= " ";
			}//end if	
			if($Rows['ReadUnderMoyen3Value']=="1"){
				$ReadUnderMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$ReadUnderMoyen3Value		 	= " ";
			}//end if	
			if($Rows['WriteExcellent3Value']=="1"){
				$WriteExcellent3Value		 	= ' checked="checked" ';
			}
			else{
				$WriteExcellent3Value		 	= " ";
			}//end if			
			if($Rows['WriteGood3Value']=="1"){
				$WriteGood3Value		 	= ' checked="checked" ';
			}
			else{
				$WriteGood3Value		 	= " ";
			}//end if	
			if($Rows['WriteMoyen3Value']=="1"){
				$WriteMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$WriteMoyen3Value		 	= " ";
			}//end if
			if($Rows['WriteUnderMoyen3Value']=="1"){
				$WriteUnderMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$WriteUnderMoyen3Value		 	= " ";
			}//end if
			if($Rows['WriteUnderMoyen3Value']=="1"){
				$WriteUnderMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$WriteUnderMoyen3Value		 	= " ";
			}//end if		
			if($Rows['SpeakExcellent3Value']=="1"){
				$SpeakExcellent3Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakExcellent3Value		 	= " ";
			}//end if		
			if($Rows['SpeakGood3Value']=="1"){
				$SpeakGood3Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakGood3Value		 	= " ";
			}//end if				
			if($Rows['SpeakMoyen3Value']=="1"){
				$SpeakMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakMoyen3Value		 	= " ";
			}//end if	
			if($Rows['SpeakUnderMoyen3Value']=="1"){
				$SpeakUnderMoyen3Value		 	= ' checked="checked" ';
			}
			else{
				$SpeakUnderMoyen3Value		 	= " ";
			}//end if	

			
			$DontKnowValue			= $Rows['DontKnowValue'];
			$DriverValue			= $Rows['DriverValue'];
			$SupportValue			= $Rows['SupportValue'];
			$ProgramerValue			= $Rows['ProgramerValue'];
			$OtherExperienceValue	= $Rows['OtherExperienceValue'];
			$CompName1Value			= $Rows['CompName1Value'];
			$ConctactMethode1Value	= $Rows['ConctactMethode1Value'];
			$FromDate1Value			= $Rows['FromDate1Value'];
			$ToDate1Value			= $Rows['ToDate1Value'];
			$OldJob1Value				= $Rows['OldJob1Value'];
			$LastMonthSalary1Value		= $Rows['LastMonthSalary1Value'];
			$WhyLeft1Value				= $Rows['WhyLeft1Value'];
			$CompName2Value				= $Rows['CompName2Value'];
			$ConctactMethode2Value		= $Rows['ConctactMethode2Value'];
			$FromDate2Value				= $Rows['FromDate2Value'];
			$ToDate2Value				= $Rows['ToDate2Value'];
			$OldJob2Value				= $Rows['OldJob2Value'];
			$LastMonthSalary2Value		= $Rows['LastMonthSalary2Value'];
			$WhyLeft2Value				= $Rows['WhyLeft2Value'];
			$CompName3Value				= $Rows['CompName3Value'];
			$ConctactMethode3Value		= $Rows['ConctactMethode3Value'];
			$FromDate3Value				= $Rows['FromDate3Value'];
			$ToDate3Value				= $Rows['ToDate3Value'];
			$OldJob3Value				= $Rows['OldJob3Value'];
			$LastMonthSalary3Value		= $Rows['LastMonthSalary3Value'];
			$WhyLeft3Value				= $Rows['WhyLeft3Value'];
			$CompName4Value				= $Rows['CompName4Value'];
			$ConctactMethode4Value		= $Rows['ConctactMethode4Value'];
			$FromDate4Value				= $Rows['FromDate4Value'];
			$ToDate4Value				= $Rows['ToDate4Value'];
			$OldJob4Value				= $Rows['OldJob4Value'];
			$LastMonthSalary4Value		= $Rows['LastMonthSalary4Value'];
			$WhyLeft4Value						= $Rows['WhyLeft4Value'];
			$CompName5Value						= $Rows['CompName5Value'];
			$ConctactMethode5Value				= $Rows['ConctactMethode5Value'];
			$FromDate5Value						= $Rows['FromDate5Value'];
			$ToDate5Value						= $Rows['ToDate5Value'];
			$OldJob5Value						= $Rows['OldJob5Value'];
			$LastMonthSalary5Value				= $Rows['LastMonthSalary5Value'];
			$WhyLeft5Value						= $Rows['WhyLeft5Value'];
			$MustExcutingInOldJobsValue			= $Rows['WhyLeft5Value'];
			$DiduDoAnotherJobsOverTimeValue		= $Rows['DiduDoAnotherJobsOverTimeValue'];
			$DoYouRejectWorkOverTimeYesValue	= $Rows['DoYouRejectWorkOverTimeYesValue'];
			$DoYouRejectWorkOverTimeNoValue		= $Rows['DoYouRejectWorkOverTimeNoValue'];
			$DoYouRejectCallingOldJobValue		= $Rows['DoYouRejectCallingOldJobValue'];
			$HowDoYouHearAboutUsValue			= $Rows['HowDoYouHearAboutUsValue'];
			$WhyYouWantToJoinValue				= $Rows['WhyYouWantToJoinValue'];
			$WhatJobYouWichValue				= $Rows['WhatJobYouWichValue'];
			$WhenUCanStartValue					= $Rows['WhenUCanStartValue'];
			$WishedSalaryValue					= $Rows['WishedSalaryValue'];
			$TalkAboutSkillsInThisJobValue		= $Rows['TalkAboutSkillsInThisJobValue'];
			$DidYouSendUsAnCVYesValue			= $Rows['DidYouSendUsAnCVYesValue'];
			$DidYouSendUsAnCVNoValue			= $Rows['DidYouSendUsAnCVNoValue'];
			$ifYesWriteCVNumberHereValue		= $Rows['ifYesWriteCVNumberHereValue'];
			$DoYouHaveNearbyInTheCompanyValue	= $Rows['DoYouHaveNearbyInTheCompanyValue'];
			$OutName1Value						= $Rows['OutName1Value'];
			$OutContact1Value					= $Rows['OutContact1Value'];
			$OutJobDesc1Value					= $Rows['OutJobDesc1Value'];
			$OutName2Value						= $Rows['OutName2Value'];
			$OutContact2Value					= $Rows['OutContact2Value'];
			$OutJobDesc2Value					= $Rows['OutJobDesc2Value'];
			$OutName3Value						= $Rows['OutName3Value'];
			$OutContact3Value					= $Rows['OutContact3Value'];
			$OutJobDesc3Value					= $Rows['OutJobDesc3Value'];
			$TrueInfoValue						= $Rows['TrueInfoValue'];
			
			$Theme = get_include_contents('Programs/careers/Themes/Default/theme.php');
			$Theme = VarTheme('<input', '<input disabled '	,$Theme );
			$Theme = VarTheme('<select', '<select disabled '	,$Theme );
			$Theme = VarTheme('{celibateValue}', $celibateValue	,$Theme );
			$Theme = VarTheme('{CertifecateFrom3Value}', $CertifecateFrom3Value	,$Theme );
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

			$Theme = VarTheme('{InThisField}', "",$Theme );
			$Theme = VarTheme('{PleaseEnterthisCVCode}', "",$Theme );
			$Theme = VarTheme('{Invalidformat}',  (Invalidformat),$Theme );
			$Theme = VarTheme('{submit}', "",$Theme );
			$Theme = VarTheme('{TrueInfo}', "",$Theme );
			$Theme = VarTheme('{MaxImageSizeMustBe}', "",$Theme );
			$Theme = VarTheme('{YouPicture}',"",$Theme );
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
			$Theme = VarTheme('{Support}',  (Support),$Theme );
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
			$Theme = VarTheme('{CvNotes}', "",$Theme );
			$Theme = VarTheme('{PersonalInfo}',  (PersonalInfo),$Theme );
			$Theme = VarTheme('{FirstName}',  (FirstName),$Theme );
			$Theme = VarTheme('{trueinfovalue}', "",$Theme );
			$Theme = VarTheme('<input disabled  type="hidden" name="MAX_FILE_SIZE" value="61440"/>', "",$Theme );
			$Theme = VarTheme('<input disabled  name="CvCaptcha" type="text" id="CvCaptcha" size="5" maxlength="5" class="text" />', "",$Theme );
			$Theme = VarTheme('<img src="images/captcha.php"  alt="code" />', "",$Theme );
			$Theme = VarTheme('<input disabled  type="submit" name="SendCvInfo" id="SendCvInfo" value="" />', "",$Theme );
			$Theme = VarTheme('<input disabled="disabled" name="TrueInfo" id="TrueInfo" {trueinfovalue}="" type="checkbox">', "",$Theme );
			echo $Theme;
		}
		else{
			echo  (ErrThisCVNmbrNotFound);
		}//end if
	}//end if

}
else{
	//show cv list

	$CVSql = "select * from `careers`;";	
	ExcuteQuery($CVSql);
	if( $TotalRecords>0){
		echo '<table border="0" cellspacing="2" cellpadding="2">
		  <tr>
		    <td><strong>'. (CvId).'</strong></td>
		    <td><strong>'. (Name).'</strong></td>
		    <td><strong>'. (BirthDate).'</strong></td>
		    <td><strong>'. (Email).'</strong></td>
		    <td><strong>'. (WishedSalary).'</strong></td>
		    <td><strong>'. (WhatJobYouWish).'</strong></td>
		    <td>&nbsp;</td>
		  </tr>';
		  
		for($i=0;$i<$TotalRecords;$i++){
			$CvId = $Rows['CvId'];
			$Vars = array("prog","CvId","edit");
			$Vals = array("careers",$CvId,"yes");
			$LinkView = AdminCreateLink("",$Vars,$Vals);
			$ViewCv				=  '<a href='.$LinkView.' title="'. (ViewCV).' '.$CvId.'"> '.$CvId.'</a>';
			
			$Name					= $Rows['FirstNameValue'] . ' '. $Rows['FatherNameValue'] . ' ' .$Rows['FamilyNameValue'];
			$BirthDateValue			= $Rows['BirthDateValue'];
			$EmailValue				= $Rows['EmailValue'];
			$WishedSalaryValue		= $Rows['WishedSalaryValue'];
			$WhatJobYouWichValue	= $Rows['WhatJobYouWichValue'];
			$Vars = array("prog","CvId","findel");
			$Vals = array("careers",$CvId,"yes");
			$LinkDel = AdminCreateLink("",$Vars,$Vals);
			$DeleteCv				=  '<a onclick="return acceptDel();" href='.$LinkDel.'> '. (FinalDelete).'</a>';
			
			echo '  <tr>
				    <td>'.$ViewCv.'</td>
				    <td>'.$Name.'</td>
				    <td>'.$BirthDateValue.'</td>
				    <td>'.$EmailValue.'</td>
				    <td>'.$WishedSalaryValue.'</td>
				    <td>'.$WhatJobYouWichValue.'</td>
				    <td>'.$DeleteCv.'</td>
				  </tr>';
			$Rows = mysqli_fetch_assoc($Recordset);
		 }//end for
	}
	else{
		echo  (ThereIsNoCVS);
	}//end if  
	echo '</table>
			<script language="javascript" type="text/javascript">
							function acceptDel(){
								return confirm("'. (DoUWantToDeleteThisCV).'");
							}
						</script>';
}//END IF

?>