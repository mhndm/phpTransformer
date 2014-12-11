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
<?php

if (!isset($IsAdmin)) {
    header("location: ../");
}
?>
<?php

global $AdminId, $TotalRecords, $Recordset, $Rows, $SqlType, $conn;
global $UserId, $LastSession;

if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}

$options = '<script language="javascript" type="text/javascript">
    document.onkeydown = document.onkeypress = function (evt) {
        if (!evt && window.event) {
            evt = window.event;
        }
        var keyCode = evt.keyCode ? evt.keyCode :
            evt.charCode ? evt.charCode : evt.which;
        if (keyCode) {
            if (evt.ctrlKey) {
                if(keyCode==83){
					document.getElementById("SubmitSaveOptions").click();
                    return false;
                }
                return false;
            }
        }
        return true;
    }
</script>
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
                width : 500,
                toolbar  : "mini",
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
//save posted info

if (isset($_POST['SubmitSaveOptions'])) {

    $DefaulPageNbr = PostFilter($_POST['DefaulPageNbr']);
    $MainPrograms = PostFilter($_POST['MainPrograms']);
    $DefaultLang = PostFilter($_POST['DefaultLang']);
    $DefaultThem = PostFilter($_POST['DefaultThem']);
    $AutoLang = PostFilter($_POST['AutoLang']);
    $ConvertAt = PostFilter($_POST['ConvertAt']);
    $CookieAge = PostFilter($_POST['CookieAge']);
    $IsOpen = PostFilter($_POST['IsOpen']);
    $DateGmt = PostFilter($_POST['DateGmt']);
    $ViewTopCont = PostFilter($_POST['ViewTopCont']);
    $ViewMarqueeCont = PostFilter($_POST['ViewMarqueeCont']);
    $ViewMenuCont = PostFilter($_POST['ViewMenuCont']);
    $ViewMainCont = PostFilter($_POST['ViewMainCont']);
    $ViewSecCont = PostFilter($_POST['ViewSecCont']);
    $ViewFootCont = PostFilter($_POST['ViewFootCont']);
    $ViewProgCont = PostFilter($_POST['ViewProgCont']);
    $OpenRegister = PostFilter($_POST['OpenRegister']);
    $GeoIpService = PostFilter($_POST['GeoIpService']);
    $AdminRegOk = PostFilter($_POST['AdminRegOk']);
    $MaxNbrPost = PostFilter($_POST['MaxNbrPost']);
    $NewsMaxNbr = PostFilter($_POST['NewsMaxNbr']);
    $GuestCanWrite = PostFilter($_POST['GuestCanWrite']);
    $EmailMethode = PostFilter($_POST['EmailMethode']);
    $License = trim(PostFilter($_POST['License']));
    $WebSiteFullName = PostFilter($_POST['WebSiteFullName']);
    $GoogleCode = trim(PostFilter($_POST['GoogleCode']));
    $EnableStatistics = PostFilter($_POST['EnableStatistics']);
    $android_key = PostFilter($_POST['android_key']);
    $apple_key = PostFilter($_POST['apple_key']);

    mysqli_query($conn, "update `params` set
				`MainPrograms`='" . $MainPrograms . "',
				`DefaultLang`='" . $DefaultLang . "',
				`DefaultThem`='" . $DefaultThem . "',
				`AutoLang`='" . $AutoLang . "',
				`ConvertAt`='" . $ConvertAt . "',
				`CookieAge`='" . $CookieAge . "',
				`IsOpen`='" . $IsOpen . "',
				`DateGmt`='" . $DateGmt . "',
				`ViewTopCont`='" . $ViewTopCont . "',
				`ViewMarqueeCont`='" . $ViewMarqueeCont . "',
				`ViewMenuCont`='" . $ViewMenuCont . "',
				`ViewMainCont`='" . $ViewMainCont . "',
				`ViewSecCont`='" . $ViewSecCont . "',
				`ViewFootCont`='" . $ViewFootCont . "',
				`ViewProgCont`='" . $ViewProgCont . "',
				`OpenRegister`='" . $OpenRegister . "',
				`GeoIpService`='" . $GeoIpService . "',
				`AdminRegOk`='" . $AdminRegOk . "',
				`MaxNbrPost`='" . $MaxNbrPost . "',
				`NewsMaxNbr`='" . $NewsMaxNbr . "',
				`EmailMethode`='" . $EmailMethode . "',
				`GuestCanWrite`='" . $GuestCanWrite . "',
				`License`='" . $License . "',
                                `WebSiteFullName`='" . $WebSiteFullName . "',
                                `GoogleCode`='" . $GoogleCode . "',
                                `EnableStatistics`='" . $EnableStatistics . "',
                                `DefaulPageNbr`='" . $DefaulPageNbr . "' ,
                                    `android_key`='" . $android_key . "' ,
                                    `apple_key`='" . $apple_key . "'
				;");
    //update admins table
    $AdminMail = PostFilter($_POST['AdminMail']);
    $AdminSign = PostFilter($_POST['AdminSign'], true);
    $BackupFolder = PostFilter($_POST['BackupFolder']);
    mysqli_query($conn, "update `admins` set
				`AdminMail`='" . $AdminMail . "',
				`AdminSign`='" . $AdminSign . "',
				`BackupFolder`='" . $BackupFolder . "' where `AdminId`='" . $AdminId . "' ;");
    //update Guest theme
    mysqli_query($conn, "update `users` set `PrefThem`='" . $DefaultThem . "' where `NickName`='Guest';");
    mysqli_query($conn, "update `users` set `PrefLang` ='" . $DefaultLang . "' where `NickName`='Guest';");

    // update all principal blocks and programs license key if the object is  ANY
    if ($License) {
        $LicenseObject = LicenseInfo($License);
        $LicenseObject = explode('||', $LicenseObject['RegDomain']);
        $LicenseObject = $LicenseObject[1];
    } else {
        $LicenseObject = '';
    }
    if ($LicenseObject == 'ANY') {
        mysqli_query($conn, "update `programs` set `License` = '" . $License . "' WHERE
            `ProgramName` = 'pages' or
            `ProgramName` = 'account' or
            `ProgramName` = 'tellfriend' or
            `ProgramName` = 'usercp' or
            `ProgramName` = 'gmap' or
            `ProgramName` = 'news' or
            `ProgramName` = 'ads' or
            `ProgramName` = 'exlink' or
            `ProgramName` = 'contactus' or
            `ProgramName` = 'rss' or
            `ProgramName` = 'welcome' or
            `ProgramName` = 'gallery' ;");
        mysqli_query($conn, "update `blocks` set `License` = '" . $License . "' WHERE
            `BlockName` = 'MainMenu' or
            `BlockName` = 'Account' or
            `BlockName` = 'Statistics' or
            `BlockName` = 'Ads' or
            `BlockName` = 'Gsearch' or
            `BlockName` = 'Language' or
            `BlockName` = 'Pool' or
            `BlockName` = 'Partner' or
            `BlockName` = 'FreeBlock' or
            `BlockName` = 'translate' ;");
        mysqli_query($conn, " update `themes` set `License`='" . $License . "' where `ThemeName`='Default' or `ThemeName`='tech' ; ");
    }

    $options .= (SuccessSaveOptions);
}//end if
//show current info
ExcuteQuery("SELECT * FROM `params`;");
$MainPrograms = $Rows['MainPrograms'];
$DefaulPageNbr = $Rows['DefaulPageNbr'];
$DefaultLang = $Rows['DefaultLang'];
$DefaultThem = $Rows['DefaultThem'];
$AutoLang = $Rows['AutoLang'];
$ConvertAt = $Rows['ConvertAt'];
$CookieAge = $Rows['CookieAge'];
$IsOpen = $Rows['IsOpen'];
$DateGmt = $Rows['DateGmt'];
$ViewTopCont = $Rows['ViewTopCont'];
$ViewMarqueeCont = $Rows['ViewMarqueeCont'];
$ViewMenuCont = $Rows['ViewMenuCont'];
$ViewMainCont = $Rows['ViewMainCont'];
$ViewSecCont = $Rows['ViewSecCont'];
$ViewFootCont = $Rows['ViewFootCont'];
$ViewProgCont = $Rows['ViewProgCont'];
$OpenRegister = $Rows['OpenRegister'];
$GeoIpService = $Rows['GeoIpService'];
$AdminRegOk = $Rows['AdminRegOk'];
$MaxNbrPost = $Rows['MaxNbrPost'];
$NewsMaxNbr = $Rows['NewsMaxNbr'];
$GuestCanWrite = $Rows['GuestCanWrite'];
$EmailMethode = $Rows['EmailMethode'];
$License = $Rows['License'];
$WebSiteFullName = $Rows['WebSiteFullName'];
$GoogleCode = $Rows['GoogleCode'];
$EnableStatistics = $Rows['EnableStatistics'];
$apple_key = $Rows['apple_key'];
$android_key = $Rows['android_key'];




ExcuteQuery("SELECT * FROM `admins`  where `AdminId`='" . $AdminId . "';");
$AdminMail = $Rows['AdminMail'];
$AdminSign = $Rows['AdminSign'];
$BackupFolder = $Rows['BackupFolder'];


// Default program for  website
$MainProgramsSelect = '<select class="select"  name="MainPrograms" id="MainPrograms">';
ExcuteQuery("SELECT * FROM `programs` where `Deleted`<>'1' ;");
if ($TotalRecords > 0) {
    for ($i = 0; $i < $TotalRecords; $i++) {
        $ProgramName = $Rows['ProgramName'];
        if ($ProgramName != $MainPrograms) {
            $MainProgramsSelect .='<option value="' . $ProgramName . '">' . $ProgramName . '</option>';
        } else {
            $MainProgramsSelect .='<option selected="selected" value="' . $ProgramName . '">' . $ProgramName . '</option>';
        }//end if
        $Rows = mysqli_fetch_assoc($Recordset);
    }//End for
}//end if
$MainPrograms = $MainProgramsSelect . '</select>';

//web site default lang
$DefaultLangSelect = '<select class="select"  name="DefaultLang" id="DefaultLang">';
ExcuteQuery("SELECT * FROM `languages` where `Deleted`<>'1';");
if ($TotalRecords > 0) {
    for ($i = 0; $i < $TotalRecords; $i++) {
        $LangName = $Rows['LangName'];
        if ($LangName != $DefaultLang) {
            $DefaultLangSelect .='<option value="' . $LangName . '">' . $LangName . '</option>';
        } else {
            $DefaultLangSelect .='<option selected="selected" value="' . $LangName . '">' . $LangName . '</option>';
        }//end if
        $Rows = mysqli_fetch_assoc($Recordset);
    }//End for
}//end if
$DefaultLang = $DefaultLangSelect . '</select>';

//web site default Theme 
$DefaultThemeSelect = '<select class="select"  name="DefaultThem" id="DefaultThem">';
ExcuteQuery("SELECT * FROM `themes` where `Active`='1';");
if ($TotalRecords > 0) {
    for ($i = 0; $i < $TotalRecords; $i++) {
        $dataThemeName = $Rows['ThemeName'];
        if ($DefaultThem != $dataThemeName) {
            $DefaultThemeSelect .='<option value="' . $dataThemeName . '">' . $dataThemeName . '</option>';
        } else {
            $DefaultThemeSelect .='<option selected="selected" value="' . $dataThemeName . '">' . $dataThemeName . '</option>';
        }//end if
        $Rows = mysqli_fetch_assoc($Recordset);
    }//End for
}//end if
$DefaultThem = $DefaultThemeSelect . '</select>';

//web site Auto lang
$AutoLangSelect = '<select class="select"  name="AutoLang" id="AutoLang">';
if ($AutoLang == 0) {
    $AutoLangSelect .='<option value="1">' . (yes) . '</option>';
    $AutoLangSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $AutoLangSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $AutoLangSelect .='<option value="0">' . (no) . '</option>';
}//end if
$AutoLang = $AutoLangSelect . '</select>';

//Convert At @ to image
$ConvertAtSelect = '<select class="select" name="ConvertAt" id="ConvertAt">';
if ($ConvertAt == 0) {
    $ConvertAtSelect .='<option value="1">' . (yes) . '</option>';
    $ConvertAtSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ConvertAtSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ConvertAtSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ConvertAt = $ConvertAtSelect . '</select>';

//cookie life
$CookieAgeSelect = '<select name="CookieAge" class="select">';
if ($CookieAge == 'Year') {
    $CookieAgeSelect .= '<option selected="selected"  value="Year">' . (Year) . '</option>';
} else {
    $CookieAgeSelect .= '<option value="Year">' . (Year) . '</option>';
}//end if

if ($CookieAge == 'Month') {
    $CookieAgeSelect .= '<option value="Month" selected="selected">' . (Month) . '</option>';
} else {
    $CookieAgeSelect .= '<option value="Month" >' . (Month) . '</option>';
}//end if			

if ($CookieAge == 'Week') {
    $CookieAgeSelect .= '<option value="Week" selected="selected">' . (Week) . '</option>';
} else {
    $CookieAgeSelect .= '<option value="Week" >' . (Week) . '</option>';
}//end if	

if ($CookieAge == 'Day') {
    $CookieAgeSelect .= '<option value="Day" selected="selected">' . (Day) . '</option>';
} else {
    $CookieAgeSelect .= '<option value="Day" >' . (Day) . '</option>';
}//end if	

if ($CookieAge == 'NeverRemember') {
    $CookieAgeSelect .= '<option value="NeverRemember" selected="selected">' . (NeverRemember) . '</option>';
} else {
    $CookieAgeSelect .= '<option value="NeverRemember" >' . (NeverRemember) . '</option>';
}//end if	

$CookieAge = $CookieAgeSelect . '</select><br/>';
// for save value : CookieLife($CookieAge);
//webiste open or closed 
$IsOpenSelect = '<select class="select" name="IsOpen" id="ConvertAt">';
if ($IsOpen == 0) {
    $IsOpenSelect .='<option value="1">' . (yes) . '</option>';
    $IsOpenSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $IsOpenSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $IsOpenSelect .='<option value="0">' . (no) . '</option>';
}//end if
$IsOpen = $IsOpenSelect . '</select>';

//gmt 
$Gmt = '<select dir="ltr" class="select" name="DateGmt" id="DateGmt">';

if ($DateGmt == "-12") {
    $Gmt .= '<option selected="selected" value="-12"> GMT -12:00 | Eniwetok, Kwajalein</option>';
} else {
    $Gmt .= '<option value="-12"> GMT -12:00 | Eniwetok, Kwajalein</option>';
}//end if
if ($DateGmt == "-11") {
    $Gmt .= '<option selected="selected" value="-11"> GMT -11:00 | Midway Island,Samoa</option>';
} else {
    $Gmt .= '<option value="-11"> GMT -11:00 | Midway Island,Samoa</option>';
}//end if

if ($DateGmt == "-10") {
    $Gmt .= '<option selected="selected" value="-10"> GMT -10:00 | Hawaii</option>';
} else {
    $Gmt .= '<option value="-10"> GMT -10:00 | Hawaii</option>';
}//end if

if ($DateGmt == "-9") {
    $Gmt .= '<option selected="selected" value="-9">  GMT -09:00  | Alaska</option>';
} else {
    $Gmt .= '<option value="-9">  GMT -09:00  | Alaska</option>';
}//end if

if ($DateGmt == "-8") {
    $Gmt .= '<option selected="selected" value="-8">  GMT -08:00  | Pacific Time (US &amp; Canada)</option>';
} else {
    $Gmt .= '<option value="-8">  GMT -08:00  | Pacific Time (US &amp; Canada)</option>';
}//end if

if ($DateGmt == "-7") {
    $Gmt .= '<option selected="selected" value="-7">  GMT -07:00  | Mountain Time (US &amp; Canada)</option>';
} else {
    $Gmt .= '<option value="-7">  GMT -07:00  | Mountain Time (US &amp; Canada)</option>';
}//end if

if ($DateGmt == "-6") {
    $Gmt .= '<option selected="selected" value="-6">  GMT -06:00  | Central Time (US &amp; Canada), Mexico City</option>';
} else {
    $Gmt .= '<option value="-6">  GMT -06:00  | Central Time (US &amp; Canada), Mexico City</option>';
}//end if

if ($DateGmt == "-5") {
    $Gmt .= '<option selected="selected" value="-5">  GMT -05:00  | Eastern Time (US &amp; Canada), Bogota, Lima</option>';
} else {
    $Gmt .= '<option value="-5">  GMT -05:00  | Eastern Time (US &amp; Canada), Bogota, Lima</option>';
}//end if
if ($DateGmt == "-4") {
    $Gmt .= '<option selected="selected" value="-4">  GMT -04:00  | Atlantic Time (Canada), Caracas, La Paz</option>';
} else {
    $Gmt .= '<option value="-4">  GMT -04:00  | Atlantic Time (Canada), Caracas, La Paz</option>';
}//end if
if ($DateGmt == "-3.5") {
    $Gmt .= '<option selected="selected" value="-3.5">GMT -03:30  | Newfoundland</option>';
} else {
    $Gmt .= '<option value="-3.5">GMT -03:30  | Newfoundland</option>';
}//end if
if ($DateGmt == "-3") {
    $Gmt .= '<option selected="selected" value="-3">  GMT -03:00  | Brazil, Buenos Aires, Georgetown</option>';
} else {
    $Gmt .= '<option value="-3">  GMT -03:00  | Brazil, Buenos Aires, Georgetown</option>';
}//end if

if ($DateGmt == "-2") {
    $Gmt .= '<option selected="selected" value="-2">  GMT -02:00  | Mid-Atlantic</option>';
} else {
    $Gmt .= '<option value="-2">  GMT -02:00  | Mid-Atlantic</option>';
}//end if
if ($DateGmt == "-1") {
    $Gmt .= '<option selected="selected" value="-1">  GMT -01:00  | Azores, Cape Verde Islands</option>';
} else {
    $Gmt .= '<option value="-1">  GMT -01:00  | Azores, Cape Verde Islands</option>';
}//end if

if ($DateGmt == "0") {
    $Gmt .= '<option selected="selected" value="0">   GMT +00:00  | Western Europe Time, London, Lisbon</option>';
} else {
    $Gmt .= '<option value="0">   GMT +00:00  | Western Europe Time, London, Lisbon</option>';
}//endif
if ($DateGmt == "1") {
    $Gmt .= '<option selected="selected" value="1">   GMT +01:00  | Brussels, Copenhagen, Madrid, Paris</option>';
} else {
    $Gmt .= '<option value="1">   GMT +01:00  | Brussels, Copenhagen, Madrid, Paris</option>';
}//end if
if ($DateGmt == "2") {
    $Gmt .= '<option selected="selected" value="2">   GMT +02:00  | Kaliningrad, South Africa ,Beirut</option>';
} else {
    $Gmt .= '<option value="2">   GMT +02:00  | Kaliningrad, South Africa ,Beirut</option>';
}//end if
if ($DateGmt == "3") {
    $Gmt .= '<option selected="selected" value="3">   GMT +03:00  | Baghdad, Riyadh, Moscow, St. Petersburg</option>';
} else {
    $Gmt .= '<option value="3">   GMT +03:00  | Baghdad, Riyadh, Moscow, St. Petersburg</option>';
}//end if

if ($DateGmt == "3.5") {
    $Gmt .= '<option selected="selected" value="3.5"> GMT +03:30  | Tehran</option>';
} else {
    $Gmt .= '<option value="3.5"> GMT +03:30  | Tehran</option>';
}//end if

if ($DateGmt == "4") {
    $Gmt .= '<option selected="selected" value="4">   GMT +04:00  | Abu Dhabi, Muscat, Baku, Tbilisi</option>';
} else {
    $Gmt .= '<option value="4">   GMT +04:00  | Abu Dhabi, Muscat, Baku, Tbilisi</option>';
}//end if

if ($DateGmt == "4.5") {
    $Gmt .= '<option selected="selected" value="4.5"> GMT +04:30  | Kabul</option>';
} else {
    $Gmt .= '<option value="4.5"> GMT +04:30  | Kabul</option>';
}//end if

if ($DateGmt == "5") {
    $Gmt .= '<option selected="selected" value="5">   GMT +05:00  | Ekaterinburg, Islamabad, Karachi, Tashkent</option>';
} else {
    $Gmt .= '<option value="5">   GMT +05:00  | Ekaterinburg, Islamabad, Karachi, Tashkent</option>';
}//end if

if ($DateGmt == "5.5") {
    $Gmt .= '<option selected="selected" value="5.5"> GMT +05:30  | Bombay, Calcutta, Madras, New Delhi</option>';
} else {
    $Gmt .= '<option value="5.5"> GMT +05:30  | Bombay, Calcutta, Madras, New Delhi</option>';
}
if ($DateGmt == "6") {
    $Gmt .= '<option selected="selected" value="6">   GMT +06:00  | Almaty, Dhaka, Colombo</option>';
} else {
    $Gmt .= '<option value="6">   GMT +06:00  | Almaty, Dhaka, Colombo</option>';
}//endif
if ($DateGmt == "7") {
    $Gmt .= '<option selected="selected" value="7">   GMT +07:00  | Bangkok, Hanoi, Jakarta</option>';
} else {
    $Gmt .= '<option value="7">   GMT +07:00  | Bangkok, Hanoi, Jakarta</option>';
}//end if
if ($DateGmt == "8") {
    $Gmt .= '<option selected="selected" value="8">   GMT +08:00  | Beijing, Perth, Singapore, Hong Kong</option>';
} else {
    $Gmt .= '<option value="8">   GMT +08:00  | Beijing, Perth, Singapore, Hong Kong</option>';
}//end if

if ($DateGmt == "9") {
    $Gmt .= '<option selected="selected" value="9">   GMT +09:00  | Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>';
} else {
    $Gmt .= '<option value="9">   GMT +09:00  | Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>';
}//end if
if ($DateGmt == "9.5") {
    $Gmt .= '<option selected="selected" value="9.5"> GMT +09:30  | Adelaide, Darwin</option>';
} else {
    $Gmt .= '<option value="9.5"> GMT +09:30  | Adelaide, Darwin</option>';
}//end if

if ($DateGmt == "10") {
    $Gmt .= '<option selected="selected" value="10">  GMT +10:00 | Eastern Australia, Guam, Vladivostok</option>';
} else {
    $Gmt .= '<option value="10">  GMT +10:00 | Eastern Australia, Guam, Vladivostok</option>';
}//end if

if ($DateGmt == "11") {
    $Gmt .= '<option selected="selected" value="11">  GMT +11:00 | Magadan, Solomon Islands</option>';
} else {
    $Gmt .= '<option value="11">  GMT +11:00 | Magadan, Solomon Islands</option>';
}//end if

if ($DateGmt == "12") {
    $Gmt .= '<option selected="selected" value="12">  GMT +12:00 | Auckland, Wellington, Fiji, Kamchatka</option>';
} else {
    $Gmt .= '<option value="12">  GMT +12:00 | Auckland, Wellington, Fiji, Kamchatka</option>';
}//end if
$DateGmt = $Gmt . '</select>';

//ViewTopCont
$ViewTopContSelect = '<select class="select" name="ViewTopCont" id="ViewTopCont">';
if ($ViewTopCont == 0) {
    $ViewTopContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewTopContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewTopContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewTopContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewTopCont = $ViewTopContSelect . '</select>';

//ViewMarqueeCont
$ViewMarqueeContSelect = '<select class="select" name="ViewMarqueeCont" id="ViewMarqueeCont">';
if ($ViewMarqueeCont == 0) {
    $ViewMarqueeContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewMarqueeContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewMarqueeContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewMarqueeContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewMarqueeCont = $ViewMarqueeContSelect . '</select>';

//ViewMenuCont
$ViewMenuContSelect = '<select class="select" name="ViewMenuCont" id="ViewMenuCont">';
if ($ViewMenuCont == 0) {
    $ViewMenuContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewMenuContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewMenuContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewMenuContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewMenuCont = $ViewMenuContSelect . '</select>';

//ViewMainCont
$ViewMainContSelect = '<select class="select" name="ViewMainCont" id="ViewMainCont">';
if ($ViewMainCont == 0) {
    $ViewMainContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewMainContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewMainContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewMainContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewMainCont = $ViewMainContSelect . '</select>';

//ViewSecCont
$ViewSecContSelect = '<select class="select" name="ViewSecCont" id="ViewSecCont">';
if ($ViewSecCont == 0) {
    $ViewSecContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewSecContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewSecContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewSecContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewSecCont = $ViewSecContSelect . '</select>';

//ViewFootCont
$ViewFootContSelect = '<select class="select" name="ViewFootCont" id="ViewFootCont">';
if ($ViewFootCont == 0) {
    $ViewFootContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewFootContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewFootContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewFootContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewFootCont = $ViewFootContSelect . '</select>';

//ViewProgCont
$ViewProgContSelect = '<select class="select" name="ViewProgCont" id="ViewProgCont">';
if ($ViewProgCont == 0) {
    $ViewProgContSelect .='<option value="1">' . (yes) . '</option>';
    $ViewProgContSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $ViewProgContSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $ViewProgContSelect .='<option value="0">' . (no) . '</option>';
}//end if
$ViewProgCont = $ViewProgContSelect . '</select>';

//OpenRegister
$OpenRegisterSelect = '<select class="select" name="OpenRegister" id="OpenRegister">';
if ($OpenRegister == 0) {
    $OpenRegisterSelect .='<option value="1">' . (yes) . '</option>';
    $OpenRegisterSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $OpenRegisterSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $OpenRegisterSelect .='<option value="0">' . (no) . '</option>';
}//end if
$OpenRegister = $OpenRegisterSelect . '</select>';

//GeoIpService
$GeoIpService = '<input class="text" dir="ltr" name="GeoIpService" value="' . $GeoIpService . '" type="text" id="GeoIpService" size="50" maxlength="255">';

//AdminRegOk
$AdminRegOkSelect = '<select class="select" name="AdminRegOk" id="ViewTopCont">';
if ($AdminRegOk == 0) {
    $AdminRegOkSelect .='<option value="1">' . (yes) . '</option>';
    $AdminRegOkSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $AdminRegOkSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $AdminRegOkSelect .='<option value="0">' . (no) . '</option>';
}//end if
$AdminRegOk = $AdminRegOkSelect . '</select>';


//MaxNbrPost
$MaxNbrPost = '<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
				<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css">
				<span id="sprytextfield1">
				<input class="text" type="text" value="'
        . $MaxNbrPost . '" name="MaxNbrPost" id="MaxNbrPost" size="2" maxlength="2">
				<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
				<span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
				<span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span></span>';
//NewsMaxNbr
$NewsMaxNbr = '<span id="sprytextfield2">
				<input class="text" type="text" value="' . $NewsMaxNbr . '" name="NewsMaxNbr" id="NewsMaxNbr" size="2" maxlength="2">  
				<span class="textfieldRequiredMsg">' . (Avalueisrequired) . '</span>
				<span class="textfieldInvalidFormatMsg">' . (Invalidformat) . '</span>
				<span class="textfieldMaxCharsMsg">' . (Exceededmaximumnumberofcharacters) . '</span></span>';

//EmailMethode
$EmailMethodeSelect = '<select class="select" name="EmailMethode" id="EmailMethode">';
if ($EmailMethode == "smtp") {
    $EmailMethodeSelect .='<option value="sendmail">sendmail</option>';
    $EmailMethodeSelect .='<option selected="selected" value="smtp">smtp</option>';
} else {
    $EmailMethodeSelect .='<option selected="selected" value="sendmail">sendmail</option>';
    $EmailMethodeSelect .='<option value="smtp">smtp</option>';
}//end if
$EmailMethodeSelect = $EmailMethodeSelect . '</select>';

////GuestCanWrite
$GuestCanWriteSelect = '<select class="select" name="GuestCanWrite" id="GuestCanWrite">';
if ($GuestCanWrite == 0) {
    $GuestCanWriteSelect .='<option value="1">' . (yes) . '</option>';
    $GuestCanWriteSelect .='<option selected="selected" value="0">' . (no) . '</option>';
} else {
    $GuestCanWriteSelect .='<option selected="selected" value="1">' . (yes) . '</option>';
    $GuestCanWriteSelect .='<option value="0">' . (no) . '</option>';
}//end if
$GuestCanWrite = $GuestCanWriteSelect . '</select>';

//EnableStatistics
$EnableStatisticsSelect = '<select class="select" name="EnableStatistics" id="EnableStatistics">';
if ($EnableStatistics == 0) {
    $EnableStatisticsSelect .='<option value="1">' . yes . '</option>';
    $EnableStatisticsSelect .='<option selected="selected" value="0">' . no . '</option>';
} else {
    $EnableStatisticsSelect .='<option selected="selected" value="1">' . yes . '</option>';
    $EnableStatisticsSelect .='<option value="0">' . no . '</option>';
}//end if
$EnableStatistics = $EnableStatisticsSelect . '</select>';

$AdminMail = '<input class="text" dir="ltr" type="text" value="'
        . $AdminMail . '" name="AdminMail" id="AdminMail" size="50" maxlength="50"> ';


$AdminSign = '<textarea class="editor" name="AdminSign" id="AdminSign" cols="45" rows="15">' . $AdminSign . '</textarea>';

$BackupFolder = '<input class="text" dir="ltr" type="text" value="'
        . $BackupFolder . '" name="BackupFolder" id="BackupFolder" size="50"> ';
$WebSiteFullName = '<input class="text" type="text" value="'
        . $WebSiteFullName . '" name="WebSiteFullName" id="WebSiteFullName" size="50"> ';
//License
$License = '<input class="text" type="text" value="' . $License . '" name="License" id="License" size="50" maxlength="255">';
$GoogleCode = '<input class="text" type="text" value="' . $GoogleCode . '" name="GoogleCode" id="GoogleCode" size="13" maxlength="26">';
$DefaulPageNbr = '<input class="text" type="text" value="' . $DefaulPageNbr . '" name="DefaulPageNbr" id="DefaulPageNbr" size="4" maxlength="100">';




/*
 *
 *
 *
 */






global $ThemeName, $Rows;

if (isset($_POST['SubmitSaveUseRew'])) {
    $SEO = PostFilter($_POST['SEO']);
    mysqli_query($conn, "update `params` set `UseRew`='" . $SEO . "'");
}//END IF

ExcuteQuery("SELECT `UseRew` FROM `params`;");
$SEO = $Rows['UseRew'];
if ($SEO == 1) {
    $SEO = '<option selected="selected" value="1">' . (yes) . '</option>
					<option value="0">' . (no) . '</option>';
    $SEOStatus = (enable);
} else {
    $SEO = '<option value="1">' . (yes) . '</option>
					<option selected="selected" value="0">' . (no) . '</option>';
    $SEOStatus = (disable);
}//end if

$theContent = (SeoDesc) . '<form name="SEO" method="post" action=""><br/><strong>' . (DidUwantToenableSEO);
$theContent .= "</strong>  ";
$theContent .='<select class="select" name="SEO" id="SEO">
				' . $SEO . '
				<input class="submit" type="submit" name="SubmitSaveUseRew" id="SubmitSaveUseRew" value="'
        . (save) . '">
				</select></form>';
$theContent .= (SeoStatus) . '<strong>' . $SEOStatus . '</strong><br/>(' . (SeoNote) . ')';

$SEO = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$SEO = VarTheme("{todoImg}", "tops.png", $SEO);
$SEO = VarTheme("{ThemeName}", $ThemeName, $SEO);
$SEO = VarTheme("{List}", '', $SEO);
$SEO = VarTheme("{Content}", $theContent, $SEO);




if (isset($_POST['RobotAdmin'])) {
    $RobotAdmin = PostFilter($_POST['RobotAdmin']);
    mysqli_query($conn, "update `params` set `RobotAdmin`='" . $RobotAdmin . "'");
}//END IF

ExcuteQuery("SELECT `RobotAdmin` FROM `params`;");
$RobotAdmin = $Rows['RobotAdmin'];
if ($RobotAdmin == 1) {
    $RobotAdmin = '<option  selected="selected" value="1">' . (yes) . '</option>
					<option value="0">' . (no) . '</option>';
    $RobotAdminStatus = (enable);
} else {
    $RobotAdmin = '<option value="1">' . (yes) . '</option>
					<option selected="selected" value="0">' . (no) . '</option>';
    $RobotAdminStatus = (disable);
}//end if




$theContent = (RobotAdminDesc) . '<form name="formRobotAdmin" method="post" action=""><br/><strong>';
$theContent .= (DiduWantToEnableRobotAdmin) . "</strong>";
$theContent .='<select class="select" name="RobotAdmin" id="RobotAdmin">
				' . $RobotAdmin . '
				<input class="submit" type="submit" name="SubmitSaveRobotAdmin" id="SubmitSaveRobotAdmin" value="'
        . (save) . '">
				</select></form>';
$theContent .= '(' . (RobotAdminStatus) . ' : <strong>' . $RobotAdminStatus . '</strong>)';

$robotsadmin = get_include_contents("admin/Themes/$ThemeName/SubContent.php");
$robotsadmin = VarTheme("{todoImg}", "wizard.png", $robotsadmin);
$robotsadmin = VarTheme("{ThemeName}", $ThemeName, $robotsadmin);
$robotsadmin = VarTheme("{List}", '', $robotsadmin);
$robotsadmin = VarTheme("{Content}", $theContent, $robotsadmin);


$android_key = '<input type="text" name="android_key" value="'.$android_key.'" class="text" />';
$apple_key = '<input type="text" name="apple_key" value="'.$apple_key.'"  class="text"  />';

$options .= '<table border="0" cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td>' . $robotsadmin . '</td>
      <td>' . $SEO . '</td>
    </tr>
  </tbody>
</table>
<form name="formMainPrograms" method="post" action="">
			<table class="class_options" border="0" cellspacing="2" cellpadding="2">
			  </tr>
			   <tr   >
			    <td >
			    <strong>' . WebSiteFullName . '</strong></td>
			    <td >
			    ' . $WebSiteFullName . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (MainPrograms) . '</strong></td>
			    <td >
			    ' . $MainPrograms . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . DefaulPageNbr . '</strong></td>
			    <td >
			    ' . $DefaulPageNbr . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (DefaultLang) . '</strong></td>
			    <td >
			    ' . $DefaultLang . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (DefaultThem) . '</strong></td>
			    <td >
			    ' . $DefaultThem . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (AutoLang) . '</strong></td>
			    <td >
			    ' . $AutoLang . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ConvertAt) . '</strong></td>
			    <td >
			    ' . $ConvertAt . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (CookieAge) . '</strong></td>
			    <td >
			    ' . $CookieAge . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (IsOpen) . '</strong></td>
			    <td >
			    ' . $IsOpen . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (DateGmt) . '</strong></td>
			    <td >
			    ' . $DateGmt . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewTopCont) . '</strong></td>
			    <td >
			    ' . $ViewTopCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewMarqueeCont) . '</strong></td>
			    <td >
			    ' . $ViewMarqueeCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewMenuCont) . '</strong></td>
			    <td >
			    ' . $ViewMenuCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewMainCont) . '</strong></td>
			    <td >
			    ' . $ViewMainCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewSecCont) . '</strong></td>
			    <td >
			    ' . $ViewSecCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewFootCont) . '</strong></td>
			    <td >
			    ' . $ViewFootCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (ViewProgCont) . '</strong></td>
			    <td >
			    ' . $ViewProgCont . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (OpenRegister) . '</strong></td>
			    <td >
			    ' . $OpenRegister . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (GeoIpService) . '</strong></td>
			    <td >
			    ' . $GeoIpService . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (AdminRegOk) . '</strong></td>
			    <td >
			    ' . $AdminRegOk . '</td>
			  </tr>
			  <tr  >
			    <td >
			    <strong>' . (MaxNbrPost) . '</strong></td>
			    <td >
			    ' . $MaxNbrPost . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (NewsMaxNbr) . '</strong></td>
			    <td >
			    ' . $NewsMaxNbr . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (GuestCanWrite) . '</strong></td>
			    <td >
			    ' . $GuestCanWrite . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . EnableStatistics . '</strong></td>
			    <td >
			    ' . $EnableStatistics . '</td>
			  </tr>	
			  <tr   >
			    <td >
			    <strong>' . (EmailMethode) . '</strong></td>
			    <td >
			    ' . $EmailMethodeSelect . '</td>
			  </tr>
			  <tr   >
			    <td >
			    <strong>' . (AdminMail) . '</strong></td>
			    <td >
			    ' . $AdminMail . '</td>
			  </tr>
			  <tr >
			    <td >
			    <strong>' . (AdminSignature) . '</strong></td>
			    <td >
			    ' . $AdminSign . '</td>
			  </tr>
			   <tr   >
			    <td >
			    <strong>' . (BackupFolder) . '</strong></td>
			    <td >
			    ' . $BackupFolder . '</td>
			  </tr>
			   <tr >
			    <td >
                                <strong>' . GoogleCode . '</strong>
                            </td>
			    <td >
			    ' . $GoogleCode . '
                            </td>
                            </tr>
                            
			   <tr >
			    <td >
                                <strong>' . (License) . '</strong>
                            </td>
			    <td >
			    ' . $License . '
                            </td>
                            </tr>
                            
                            <tr >
			    <td >
                                <strong>' . apple_key. '</strong>
                            </td>
			    <td >
			    ' . $apple_key . '
                            </td>
                            </tr>
                              <tr >
			    <td >
                                <strong>' . android_key. '</strong>
                            </td>
			    <td >
			    ' . $android_key . '
                            </td>
                            </tr>

</table><br/><div align="center">
<input type="submit" class="submit" name="SubmitSaveOptions" id="SubmitSaveOptions" value="' . (save) . '">
</form><br/><br/></div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {maxChars:2});
//-->
</script>
<script type="text/javascript">
<!--
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {maxChars:2});
//-->
</script>
<script type="text/javascript">
<!--
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $ ("table.class_options tr:even").addClass("options_even");
            $ ("table.class_options tr:odd").addClass("options_odd");
            
         $("table.class_options tr:even").hover(
             function () {
               $(this).css({"background-color":"#EFEFEF"});
             }, 
             function () {
               $(this).css({"background-color":"#EDEAEA"});
             }
         );
         
         $("table.class_options tr:odd").hover(
             function () {
               $(this).css({"background-color":"#EFEFEF"});
             }, 
             function () {
               $(this).css({"background-color":"#F5F5F5"});
             }
         );

        });
    </script>


'

;
?>