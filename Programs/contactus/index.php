<?php

/* * *********************************************
 *
 * 	Project: phpTransformer.com .
 * 	File Location :  . 
 * 	File Name:  .
 * 	Date Created: 00-00-2007.
 * 	Last Modified: 00-00-2007.
 * 	Descriptions:	.
 * 	Changes:	.
 * 	TODO:	 .
 * ***	Author: Mohsen Mousawi mhndm@phptransformer.com .
 *
 * ********************************************* */
?>
<?php if (!isset($project)) {
    header("location: ../../");
} ?>
<?php

global $TitlePage, $TheNavBar, $conn;

//http://pc-it-manager/phptransformer/Prog-contactus_Lang-Arabic_nl-1_FullName-محسن_EmailAddress-asdsa@asfas.com_TelNumber-+0096548523_Street-الطريق العام_City-بعلبك_Contry-Lebanon(لبنان)_Comment-0_Question-0_Complaint-1_DepartmentToCall-20110000000_Subject-مرحبا بك_Message-كاردابلا ولي.pt

$TitlePage .= ' .:. ' . (ContactUs);
$TheNavBar[] = array((ContactUs), CreateLink("", array("Prog"), array("contactus")));
if (isset($_POST['CodePic'])) {
    $CodePic = PostFilter($_POST['CodePic']);
}
if (isset($_SESSION['captcha'])) {
    $captcha = $_SESSION['captcha'];
}

if (isset($_POST['SubmitContactForm'])) {
    if ($captcha == $CodePic) {
        SendContactUsMail();
    } else {
        echo '<br>' . CaptchaErr . '<br>';
        ShowContactUsForm();
    }
} else {
    ShowContactUsForm();
}//end if

function SendContactUsMail() {
    global $SmtpHost, $SMTPusername, $SMTPpassword, $SmtpPort;
    global $AdminMail, $WebSiteName, $conn;

    if (isset($_POST['FullName'])) {
        $FullName = PostFilter($_POST['FullName']);
    } else {
        $FullName = "";
    }//end if

    if (isset($_POST['EmailAddress'])) {
        $EmailAddress = PostFilter($_POST['EmailAddress']);
    } else {
        $EmailAddress = "";
    }//end if

    if (isset($_POST['TelNumber'])) {
        $TelNumber = PostFilter($_POST['TelNumber']);
    } else {
        $TelNumber = "";
    }//end if

    if (isset($_POST['Street'])) {
        $Street = PostFilter($_POST['Street']);
    } else {
        $Street = "";
    }//end if

    if (isset($_POST['City'])) {
        $City = PostFilter($_POST['City']);
    } else {
        $City = "";
    }//end if

    if (isset($_POST['Contry'])) {
        $Contry = PostFilter($_POST['Contry']);
    } else {
        $Contry = "";
    }//end if

    if (isset($_POST['TypeOfFeedback'])) {
        $TypeOfFeedback = PostFilter($_POST['TypeOfFeedback']);
    } else {
        $TypeOfFeedback = "";
    }//end if

    if (isset($_POST['DepartmentToCall'])) {
        $DepartmentToCall = PostFilter($_POST['DepartmentToCall']);

        $query = "SELECT * FROM `contactus` , `contactuslang` 
					where `contactus`.`IdDep` = `contactuslang`.`IdDep` 
					and `contactus`.`IdDep`='" . $DepartmentToCall . "' ;";
        $Rec = mysqli_query($conn, $query);
        $Totals = mysqli_num_rows($Rec);
        if ($Totals > 0) {
            $cuRows = mysqli_fetch_assoc($Rec);
            $eMail = $cuRows['DepEmail'];
            $DepName = $cuRows['DepName'];
        } else {
            //$DepartmentToCall = "";
            $DepName = $DepartmentToCall;
            $eMail = $AdminMail;
        }//end if
    } else {
        $DepartmentToCall = "";
        $DepName = "";
        $eMail = $AdminMail;
    }//end if

    if (isset($_POST['Subject'])) {
        $Subject = PostFilter($_POST['Subject']);
    } else {
        $Subject = "";
    }//end if

    if (isset($_POST['Message'])) {
        $Message = PostFilter($_POST['Message']);
    } else {
        $Message = "";
    }//end if

    $From = $EmailAddress;
    $FromName = $FullName;
    $AddAddress[0] = $eMail;
    $AddAddress[1] = $DepName;
    $Subject = $Subject;
    $Body = "Email : " . $From
            . "<br/> Name : " . $FromName
            . "<br/> TelNumber : " . $TelNumber
            . "<br/> Street :" . $Street
            . "<br/> City :" . $City
            . "<br/> Contry :" . $Contry
            . "<br/> TypeOfFeedback :" . $TypeOfFeedback
            . "<br/> Message :" . $Message;
    $mail = SendEmail($From, $FromName, $AddAddress, $Subject, $Body);
    if (!$mail) {
        echo (ThereWasAnErrorTendingTheMessage) . "<br/>";
    } else {
        echo (MessageWasSentSuccessfully) . "<br/>";
    }//end if
}

//end function

function ShowContactUsForm() {
    global $ThemeName, $CustomHead, $conn;

    $Theme = get_include_contents('Programs/contactus/Themes/' . $ThemeName . '/ContactFormco.php');
    $Theme = VarTheme('{ContactUsNote}', ContactUsNote, $Theme);
    $Theme = VarTheme('{FullName}', (FullName), $Theme);
    $Theme = VarTheme('{EmailAddress}', (EmailAddress), $Theme);
    $Theme = VarTheme('{TelNumber}', (TelNumber), $Theme);
    $Theme = VarTheme('{Street}', (Street), $Theme);
    $Theme = VarTheme('{City}', (City), $Theme);
    $Theme = VarTheme('{Street}', (Street), $Theme);
    $Theme = VarTheme('{Contry}', (Contry), $Theme);
    $Theme = VarTheme('{TypeOfFeedback}', (TypeOfFeedback), $Theme);
    $Theme = VarTheme('{Comment}', (Comment), $Theme);
    $Theme = VarTheme('{Question}', (Question), $Theme);
    $Theme = VarTheme('{Complaint}', (Complaint), $Theme);
    $Theme = VarTheme('{Question}', (Question), $Theme);
    $Theme = VarTheme('{DepartmentToCall}', (DepartmentToCall), $Theme);
    $Theme = VarTheme('{Subject}', (Subject), $Theme);
    $Theme = VarTheme('{Message}', (Message), $Theme);
    $Theme = VarTheme('{Message}', (Message), $Theme);
    $Theme = VarTheme('{submit}', (submit), $Theme);

    if (isset($_GET['FullName'])) {
        $Theme = VarTheme('{FullNameValue}', urldecode((InputFilter($_GET['FullName']))), $Theme);
    } else {

        $Theme = VarTheme('{FullNameValue}', "", $Theme);
    }//end if

    if (isset($_GET['EmailAddress'])) {
        $Theme = VarTheme('{EmailAddressValue}', urldecode((InputFilter($_GET['EmailAddress']))), $Theme);
    } else {

        $Theme = VarTheme('{EmailAddressValue}', "", $Theme);
    }//end if

    if (isset($_GET['TelNumber'])) {
        $Theme = VarTheme('{TelNumberValue}', urldecode((InputFilter($_GET['TelNumber']))), $Theme);
    } else {

        $Theme = VarTheme('{TelNumberValue}', "", $Theme);
    }//end if	

    if (isset($_GET['Street'])) {
        $Theme = VarTheme('{StreetValue}', urldecode((InputFilter($_GET['Street']))), $Theme);
    } else {

        $Theme = VarTheme('{StreetValue}', "", $Theme);
    }//end if

    if (isset($_GET['City'])) {
        $Theme = VarTheme('{CityValue}', urldecode((InputFilter($_GET['City']))), $Theme);
    } else {

        $Theme = VarTheme('{CityValue}', "", $Theme);
    }//end if		

    if (isset($_GET['Contry'])) {
        $Theme = VarTheme('{ContryValue}', urldecode((InputFilter($_GET['Contry']))), $Theme);
    } else {

        $Theme = VarTheme('{ContryValue}', "", $Theme);
    }//end if			

    if (isset($_GET['Comment'])) {
        $Theme = VarTheme('{CommentValue}', ' checked="checked" ', $Theme);
    } else {

        $Theme = VarTheme('{CommentValue}', "", $Theme);
    }//end if		

    if (isset($_GET['Question'])) {
        $Theme = VarTheme('{QuestionValue}', ' checked="checked" ', $Theme);
    } else {

        $Theme = VarTheme('{QuestionValue}', "", $Theme);
    }//end if	

    if (isset($_GET['Complaint'])) {
        $Theme = VarTheme('{ComplaintValue}', ' checked="checked" ', $Theme);
    } else {

        $Theme = VarTheme('{ComplaintValue}', "", $Theme);
    }//end if	

    if (isset($_GET['Subject'])) {
        $Theme = VarTheme('{SubjectValue}', urldecode((InputFilter($_GET['Subject']))), $Theme);
    } else {

        $Theme = VarTheme('{SubjectValue}', "", $Theme);
    }//end if	

    if (isset($_GET['Message'])) {
        $Theme = VarTheme('{MessageValue}', urldecode((InputFilter($_GET['Message']))), $Theme);
    } else {

        $Theme = VarTheme('{MessageValue}', "", $Theme);
    }//end if
    $Theme = VarTheme('{InputCode}', InputCode, $Theme);
    $Theme = VarTheme('{here}', here, $Theme);
    echo $Theme;
}

//end function
?>