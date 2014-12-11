<?php

if (isset($_GET['step'])) {
    $Step = $_GET['step'];
    if ($Step == 1) {
        echo '<div style="height:500px;"" >' . Step1() . '</div>';
    } elseif ($Step == 2) {
        echo '<div style="height:500px;"" >' . Step2() . '</div>';
    } elseif ($Step == 3) {
        echo '<div style="height:500px;"">' . Step3() . '</div>';
    } elseif ($Step == 4) {
        echo '<div style="height:500px;"" >' . Step4() . '</div>';
    } elseif ($Step == 5) {
        echo '<div style="height:500px;"" >' . Step5() . '</div>';
    } else {

        //reading configurations from the session var
        $WebsiteUrl = $_SESSION['WebsiteUrl'];
        $WebiteFolder = $_SESSION['WebiteFolder'];
        $WebSiteName = $_SESSION['WebSiteName'];
        $WebsiteDesc = $_SESSION['WebsiteDesc'];
        $WebsiteDesc = $_SESSION['WebsiteDesc'];
        $SessionPath = $_SESSION['SessionPath'];
        if ($SessionPath == "") {
            $SessionPath = "/sesstmp";
        }
        $AdminFileName = $_SESSION['AdminFileName'];
        $AdminId = $_SESSION['AdminId'];
        $AdminName = $_SESSION['AdminName'];
        $AdminPassword = md5($_SESSION['AdminPassword']);
        $DisplayErrors = $_SESSION['DisplayErrors'];
        $store_error_in_db = $_SESSION['store_error_in_db'];
        $SmtpHost = $_SESSION['SmtpHost'];
        $SmtpPort = $_SESSION['SmtpPort'];
        if (!is_numeric($SmtpPort)) {
            $SmtpPort = 25;
        }
        $SMTPusername = $_SESSION['SMTPusername'];
        $SMTPpassword = $_SESSION['SMTPpassword'];
        $SMTPSecure = $_SESSION['SMTPSecure'];
        $dbHostName = $_SESSION['dbHostName'];
        $dbBaseName = $_SESSION['dbBaseName'];
        $dbUser = $_SESSION['dbUser'];
        $dbPass = $_SESSION['dbPass'];
        $dbFile = $_SESSION['dbFile'];

        if (isset($_POST['SiteSupportkey'])) {
            $SiteSupportkey = $_POST['SiteSupportkey'];
        }
        // print in textares info of .htaccess and config.php
        // the .htaccess file
        echo '<h1>Congratulations !</h1>
				the .htaccess file <br/><textarea name="htaccess" id="htaccess" cols="60" rows="10">';

        echo $htaccess = '<IfModule mod_php4.c>
php_value session.use_only_cookies 1
php_value session.use_trans_sid 0
</IfModule>
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /' . $WebiteFolder . '/ 
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !index.php
RewriteRule (.pt) /' . $WebiteFolder . '/index.php?/$1 [L] 
</IfModule>
<IfModule dir_module>
DirectoryIndex index.php index.pl index.cgi index.asp index.shtml index.html index.htm \
default.php default.pl default.cgi default.asp default.shtml default.html default.htm \
home.php home.pl home.cgi home.asp home.shtml home.html home.htm
</IfModule>		
# 30 days 30*24*60*60 = 2592000 
#NOTE: Remove  #  after this line if you need TO enable Apache Cache control
#<FilesMatch "\.(ttf|eot|woff|ico|pdf|flv|jpg|jpeg|png|gif|js|css|swf)$">
#Header set Cache-Control "max-age=2592000, private"
#FileETag INode MTime Size
#Header unset ETag
#FileETag None
#</FilesMatch>
#<ifmodule mod_deflate.c>
#AddOutputFilterByType DEFLATE text/text text/html text/plain text/xml text/css application/x- javascript application/javascript
#</ifmodule>
';
        echo '</textarea><br/><br/>';

        //the config.php file
        echo 'the config.php file<br/> <textarea name="htaccess" id="htaccess" cols="60" rows="10">';
        echo $config = '<?php
$project		= "PhpTransformer"; //dont change it !!
$WebsiteUrl 		= "' . $WebsiteUrl . '"; //ex: phpTransformer.com/release/
$WebiteFolder 		= "' . $WebiteFolder . '";
$WebSiteName 		= "' . $WebSiteName . '"; //ex: phpTransformer.com
$WebsiteDesc 		= "' . $WebsiteDesc . '";//ex: php Transformer  WebSite
$SmtpHost 		= "' . $SmtpHost . '";//ex:  192.168.0.2
$SmtpPort		= ' . $SmtpPort . '; //ex: 25
$SMTPusername		= "' . $SMTPusername . '"; //ex: me@mycompany.com
$SMTPpassword		= "' . $SMTPpassword . '"; 
$SMTPSecure             = "' . $SMTPSecure . '";
$dbHostName 		= "' . $dbHostName . '" ; //ex: localhost
$dbBaseName 		= "' . $dbBaseName . '" ; //ex: transformer
$SqlType 		= "MySql" ; // ex: MySql
$MySqlConnectType	= "standard"; // we dont use it any more because we use now MySqli
$dbUserPass		= array(array("' . $dbUser . '","' . $dbPass . '")); //ex : array(array("UserName","Password"));
$AdminFileName 		= "' . $AdminFileName . '" ; // ex: admin(renamed).php
$DisplayErrors 		= "' . $DisplayErrors . '" ;// ex: yes
$store_error_in_db      = "' . $store_error_in_db . '"; // ex: yes
$SessionPath		=  realpath(".")."' . $SessionPath . '";
?>';
        echo '</textarea>';

        //save files to hdd
        if (is_file("../.htaccess")) {
            rename("../.htaccess", "../setup/.htaccess." . substr(md5(date('y m d h s m') . rand(1, 99999)), 1, 5) . ".bak");
            //unlink("../.htaccess") or  $Perm = '<span style="color:red" >I cant delete the old .htaccess file.</span>';
        }
        $handle = fopen("../.htaccess", 'w') or $Perm = '<span style="color:red" >Cant open .htaccess</span>';
        fwrite($handle, $htaccess);
        fclose($handle);

        if (is_file("../config.php")) {
            rename("../config.php", "../setup/config.php." . substr(md5(date('y m d h s m') . rand(1, 99999)), 1, 5) . ".bak");
            //unlink("../config.php") or  $Perm = '<span style="color:red" >I cant delete the old config.php file.</span>';
        }
        $handle = fopen("../config.php", 'w') or $Perm = '<span style="color:red" >Cant open config.php</span>';
        fwrite($handle, $config);
        fclose($handle);

        $HomePage = '<a href="' . $WebsiteUrl . '" target="_blank">' . $WebsiteUrl . '</a>';
        $AdminPage = '<a href="' . $WebsiteUrl . $AdminFileName . '" target="_blank">' . $WebsiteUrl . $AdminFileName . '</a>';
        echo '<div name="finish" id="finish"><br/>
			Now you can Start using phpTransformer :<br/><br/>
				Home Page : ' . $HomePage . '<br/>
				Admin Page :' . $AdminPage . '
			<br/>
			</div>';
        // import sql file
        include ("ClassSQLimporter.php");

        $sqlFile = 'sql/' . $dbFile;

        //$dbName = "test";
        $newImport = new sqlImport($dbHostName, $dbUser, $dbPass, $dbBaseName, $sqlFile);
        $newImport->import();
        //update admin info : update
        $MysqlCon = mysqli_connect($dbHostName, $dbUser, $dbPass) or die("MySQL Connection Failed");
        mysqli_select_db($MysqlCon, $dbBaseName);
        mysqli_query($MysqlCon, "SET NAMES utf8");
        //admin id : 200700000-1 in admnis and users and group tables
        mysqli_query($MysqlCon, 'UPDATE `admins` SET `AdminId` = "' . $AdminId . '", `IsAdam`=1 WHERE `AdminId` = "200700000-1" LIMIT 1 ;');
        //update admin id and group amd nick name and password
        mysqli_query($MysqlCon, 'UPDATE `users` SET `UserId` = "' . $AdminId . '" , `GroupId`="' . $AdminId . '",'
                . ' `NickName` ="' . $AdminName . '", `PassWord`="' . $AdminPassword . '" WHERE `UserId` = "200700000-1" LIMIT 1 ;');
        mysqli_query($MysqlCon, 'UPDATE `groups` SET `GroupId` = "' . $AdminId . '" WHERE `GroupId` = "200700000-1" LIMIT 1 ;');
        mysqli_query($MysqlCon, 'UPDATE `admins` SET `AdminId` = "' . $AdminId . '" WHERE `AdminId` = "200700000-1" LIMIT 1 ;');
        //disable all plugins 
        mysqli_query($MysqlCon, 'truncate table `plugins` ;');
        
        //website name
        mysqli_query($MysqlCon, 'update `params` set `WebSiteFullName`="'.$WebsiteDesc.'" ;');

        //update site key
        mysqli_query($MysqlCon, 'UPDATE `params` SET `License` ="' . $SiteSupportkey . '";	');
        // update all principal blocks and programs license key if the object is  ANY
        if ($SiteSupportkey != '') {
            $LicenseObject = LicenseInfo($SiteSupportkey);
            $LicenseObject = explode('||', $LicenseObject['RegDomain']);
            $LicenseObject = $LicenseObject[1];
            if ($LicenseObject == 'ANY') {
                mysqli_query($MysqlCon, "update `programs` set `License` = '" . $SiteSupportkey . "' WHERE
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
                `ProgramName` = 'gallery' ;");
                mysqli_query($MysqlCon, "update `blocks` set `License` = '" . $SiteSupportkey . "' WHERE
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
            }
        }
        // delete rew and  test-writte_file.txt
        if (is_file("../test-writte_file.txt")) {
            unlink("../test-writte_file.txt");
        }
        if (is_file("rew")) {
            unlink("rewrite/rew");
        }

        //rename admin file
        if (is_file("../admin(renamed).php")) {
            rename("../admin(renamed).php", "../" . $AdminFileName);
        }


        //renaming the setup folder
        $SetupFolder = date('h-i-s, j-m-y, it is w Day z ');
        if (!rename("../setup", "../" . md5($SetupFolder))) {
            echo '<span style="color:red" > Security WARNING ! Please check if the setup folder exist, if exist Please delete it or rename it</span>';
        }
    }
    echo '<br/>Thanks for choosing <a href="http://phptransformer.com"> phpTransformer </a>! <br/>&nbsp;';
} else {
    echo '<div style="height:570px;""><h1>Welcome ...</h1>
			phpTransformer the free and open source CMS under GNU AFFERO GENERAL PUBLIC LICENSE, please read it carefully :
			<iframe style="border:0;" width="100%" height="430" src="License.htm"></iframe>
			<p align="center">
			<form id="form1" name="form1" method="post" action="?step=1">
				<input type="submit" name="button" id="button" value="I accept" />
				<a href="Blanc.html" >I refuse </a>
			</form> </div>';
    // mod_rewrite
    $UrlRew = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    //$UrlRew = str_replace("index.php", "" , $UrlRew);
    $UrlRew = str_replace("index.php", "", $UrlRew) . "rewrite/page/TestRewrite";
    echo '<iframe style="visibility:hidden;width:0px;height:0px;"  src="' . $UrlRew . '" ></iframe>';
}

function Step5() {
    if (isset($_POST['step4'])) {
        $_SESSION['WebsiteUrl'] = $_POST['WebsiteUrl'];
        $_SESSION['WebiteFolder'] = $_POST['WebiteFolder'];
        $_SESSION['WebSiteName'] = $_POST['WebSiteName'];
        $_SESSION['WebsiteDesc'] = $_POST['WebsiteDesc'];
        $_SESSION['WebsiteDesc'] = $_POST['WebsiteDesc'];
        $_SESSION['SessionPath'] = $_POST['SessionPath'];
        $_SESSION['AdminFileName'] = $_POST['AdminFileName'];
        $_SESSION['AdminId'] = $_POST['AdminId'];
        $_SESSION['AdminName'] = $_POST['AdminName'];
        $_SESSION['AdminPassword'] = $_POST['AdminPassword'];
        $_SESSION['DisplayErrors'] = $_POST['DisplayErrors'];
        $_SESSION['store_error_in_db'] = $_POST['store_error_in_db'];
    }

    $Step5 = '
			<h1>Support license </h1>
                    <span style="background: red; color: #FFFFFF;">
                        <span style="text-decoration: blink"> ! </span> Note : In the next Step we well remove the two files: config.php and .htaccess<span style="text-decoration: blink"> ! </span><br/><br/>
                    </span>
			<iframe style="border:0;" width="100%" height="330px" src="SupportLicense.htm"></iframe>
			<br/>
			<br/>
			<br/>
			<form action="?step=6" method="post">
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td>Site Support key </td>
				<td><input name="SiteSupportkey" type="text" id="SiteSupportkey" style="width:500px;"  value=""></td>
			  </tr>
			</table>
			<a href="?step=4">Previous </a>
			<input name="step4" type="submit" value="Next" >
			</form>
			';
    return $Step5;
}

function Step4() {
    /*
      if (isset($_POST['step2'])) {

      $_SESSION['dbHostName'] = $_POST['dbHostName'];
      $_SESSION['dbBaseName'] = $_POST['dbBaseName'];
      $_SESSION['dbUser'] = $_POST['dbUser'];
      $_SESSION['dbPass'] = $_POST['dbPass'];
      $_SESSION['dbFile'] = $_POST['dbFile'];
      }
     */
    $_SESSION['SmtpHost'] = $_POST['SmtpHost'];
    $_SESSION['SmtpPort'] = $_POST['SmtpPort'];
    $_SESSION['SMTPusername'] = $_POST['SMTPusername'];
    $_SESSION['SMTPpassword'] = $_POST['SMTPpassword'];
    $_SESSION['SMTPSecure'] = $_POST['SMTPSecure'];

    $WebsiteUrl = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $WebsiteUrl = str_replace("setup/?step=4", "", $WebsiteUrl);
    $WebsiteUrl = str_replace("setup/index.php?step=4", "", $WebsiteUrl);
    $WebiteFolder = explode("/", $WebsiteUrl);
    $WebiteFolder = $WebiteFolder[count($WebiteFolder) - 2];
    //solution of sub folder and direct root
    if ($WebsiteUrl == "http://" . $WebiteFolder . "/") {
        $WebiteFolder = "";
    }
    $Step4 = '
                    <h1>Admin options</h1>
			<form action="?step=5" method="post">
			<table border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>Website Url</td>
				<td><input name="WebsiteUrl" type="text" id="WebsiteUrl" size="40" value="' . $WebsiteUrl . '"> 
				  ex : http://localhost/phptransformer/</td>
			  </tr>
			  <tr>
				<td>Website Folder</td>
				<td><input name="WebiteFolder" type="text" id="WebiteFolder" value="' . $WebiteFolder . '" size="40"> 
				  ex : phptransformer</td>
			  </tr>
			  <tr>
				<td>WebSite Name</td>
				<td><input name="WebSiteName" type="text" id="WebSiteName" value="phptransformer.com" size="40">
				  ex : phptransformer.com</td>
			  </tr>
			  <tr>
				<td>Website Description</td>
				<td><input name="WebsiteDesc" type="text" id="WebsiteDesc" value="php Transformer WebSite" size="40">
				  ex : php Transformer  WebSite</td>
			  </tr>
			  <tr>
				<td>Session Path</td>
				<td><input type="text" name="SessionPath" id="SessionPath">
				  ex : /sesstmp , or leave it blank</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Admin File Name</td>
				<td><input type="text" name="AdminFileName" id="AdminFileName" value="admin(renamed).php">
				  ex : admin(renamed).php</td>
			  </tr>
			  <tr>
				<td>Admin Id</td>
				<td><input type="text" name="AdminId" id="AdminId" value="200700000-1"> 
				  ex : 200700000-1 , or leave it </td>
			  </tr>
			  <tr>
				<td>Admin Name</td>
				<td><input type="text" name="AdminName" id="AdminName" value="admin" > 
				  ex : admin</td>
			  </tr>
			  <tr>
				<td>Admin Password</td>
				<td><input name="AdminPassword" id="AdminPassword"  type="password"> 
				  retype password : 
				  <input name="reAdminPassword" id="reAdminPassword"  type="password"></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>Display Errors</td>
				<td><select name="DisplayErrors" id="DisplayErrors">
				  <option value="yes">yes</option>
				  <option value="no" selected="selected" >no</option>
				</select>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Store Errors in the database
				<select name="store_error_in_db" id="store_error_in_db">
				  <option value="yes">yes</option>
				  <option value="no" selected="selected" >no</option>
				</select>

			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			</table>
			<a href="?step=3">Previous </a>
			<input name="step4" type="submit" value="Next" onClick="return ValidatedATA();">
			</form>

			<script language="javascript" type="text/javascript">
				function ValidatedATA(){
					if(document.getElementById("WebsiteUrl").value == ""){alert("Website Url must have value !"); return false;}
					//if(document.getElementById("WebiteFolder").value == ""){alert("Website Folder must have value !"); return false;}
					if(document.getElementById("WebSiteName").value == ""){alert("WebSite Name must have value !"); return false;}
					if(document.getElementById("WebsiteDesc").value == ""){alert("Website Description must have value !"); return false;}
					if(document.getElementById("AdminFileName").value == ""){alert("Admin FileName Path  must have value !"); return false;}
					if(document.getElementById("AdminId").value == ""){alert("Admin Id  must have value !"); return false;}
					if(document.getElementById("AdminName").value == ""){alert("Admin Name  must have value !"); return false;}
					if(document.getElementById("AdminPassword").value == ""){alert("Admin Password  must have value !"); return false;}
					if(document.getElementById("AdminPassword").value != document.getElementById("reAdminPassword").value){
						alert("Admin Password and retype must be the same !"); return false;}
				}
				
			</script>
			<br/>&nbsp;
			';
    return $Step4;
}

function Step3() {

    $_SESSION['dbHostName'] = $_POST['dbHostName'];
    $_SESSION['dbBaseName'] = $_POST['dbBaseName'];
    $_SESSION['dbUser'] = $_POST['dbUser'];
    $_SESSION['dbPass'] = $_POST['dbPass'];
    $_SESSION['dbFile'] = $_POST['dbFile'];

    $Step3 = '<h1>Mail configuration</h1> (Note : not obligatory ) <br/><br/>
			<form action="?step=4" method="post">
			<table border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td>Smtp Host</td>
				<td><input type="text" name="SmtpHost" id="SmtpHost" > ex: localhost</td>
			  </tr>
			  <tr>
				<td>Smtp Port</td>
				<td><input type="text" name="SmtpPort" id="SmtpPort"> ex: 25 or 587</td>
			  </tr>
			  <tr>
				<td>SMTP user name</td>
				<td><input type="text" name="SMTPusername" id="SMTPusername"> ex : root</td>
			  </tr>
			  <tr>
				<td>SMTP password</td>
				<td><input type="password" name="SMTPpassword" id="SMTPpassword"> 
				   </td>
			  </tr>
                          <tr> 
                          <td>
                          retype password :  </td> 
                          <td>
					<input type="password" name="reSMTPpassword" id="reSMTPpassword">
                                        
                                </td>
                                    </tr>
                          <tr>
                          <td> Encryption </td>
                          <td> <select name="SMTPSecure">
                                            <option value="tls">tls</option>
                                            <option value="starttls">starttls</option>
                                        </select>
                                        </td>
                            </tr>
			</table>
			<br/>
			<a href="?step=2">Previous </a>
			<input name="step3" type="submit" value="Next" onClick="return PassMatch();">
			</form>
			<script language="javascript" type="text/javascript">
				function PassMatch(){
					if(document.getElementById("SMTPpassword").value != document.getElementById("reSMTPpassword").value){ 
					alert("Password and retype password must be the same !");
					return false;}
				
				}
			</script>
			';


    return $Step3;
}

function Step2() {

    $Step2 = '<script language="javascript" type="text/javascript" src="ajax.js"></script>
                            <h1>Database configurations</h1>
				<form id="form2" name="form2" method="post" action="?step=3">
				  <table border="0" cellspacing="0" cellpadding="0">
					<tr>
					  <td>MySQL Host Name</td>
					  <td><input type="text" name="dbHostName" id="dbHostName" /> 
						ex: localhost</td>
					</tr>
					<tr>
					  <td>Database Name</td>
					  <td><input type="text" name="dbBaseName" id="dbBaseName" /> 
						Must be exist (collation : utf8_general_ci ).</td>
					</tr>
					
					<tr>
					  <td>Database user name</td>
					  <td><input type="text" name="dbUser" id="dbUser" /> ex: root</td>
					</tr>
					<tr>
					  <td>Database password</td>
					  <td><input value="123" type="password" name="dbPass" id="dbPass" />
						retype : 
						<input onfocus="return TestDBCon(document.getElementById(\'dbHostName\').value,document.getElementById(\'dbBaseName\').value,document.getElementById(\'dbUser\').value,document.getElementById(\'dbPass\').value);" type="password" name="retype" id="retype" />
                                                </td>
					</tr>
					<tr>
					  <td>Database File</td>
					  <td>
							<select name="dbFile" id="dbFile">
							<option value="EnglishAndArabic.sql" > Multi Languages English And Arabic Database </option>
							<option value="English.sql" selected="selected"> English Database </option>
							<option value="Arabic.sql"> قاعدة بيانات عربي</option>
							</select>
						</td>
					</tr>
				  </table>
				  <br/>
                                  <div name="TestConDiv" id="TestConDiv"><strong>Test Connection result will appear here </strong></div><br/>
				  <a href="?step=1">Previous</a>
                                  
				  <input name="step2"  id="step2" type="submit" value="Submit" onClick="return REQUIRED();" />
				</form>

				<script language="javascript" type="text/javascript">
				<!--
				function REQUIRED(){
					if (document.getElementById("dbHostName").value == ""){
						alert("the databse Host name must have a value !");
						return false;
					}	
					if (document.getElementById("dbBaseName").value == ""){
						alert("the DataBase Name  must have a value !");
						return false;
					}				
					if (document.getElementById("dbUser").value == ""){
						alert("the datavase User Name  must have a value !");
						return false;
					}					
					if (document.getElementById("dbPass").value != document.getElementById("retype").value){
						alert("Password and retype password must be the same !");
						return false;
					}
				}
				-->
				</script>';
    return $Step2;
}

function Step1() {

    // ApacheVersion
    if (function_exists('apache_get_version')) {
        $version = apache_get_version();
        $version = explode(' ', $version);
        $version = explode('/', $version[0]);
        // Apache version

        $version = explode('.', $version[1]);
        $Apache_Version = $version[0] * 1000 + $version[1] * 100 + $version[2];

        if ($Apache_Version < 2214) {
            $ApacheVersion = '<span style="color:red" > ' . $version[1] . '</span>';
        } else {
            $ApacheVersion = $version[0] . '.' . $version[1] . '.' . $version[2] . ' <strong> OK </strong>';
        }
    } else {
        $ApacheVersion = '<strong> Function of Apache Version Disabled by your Hosting ! </strong>';
    }
    // php version
    if (!defined('PHP_VERSION_ID')) {
        $version = explode('.', PHP_VERSION);
        define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
        define('PHP_MAJOR_VERSION', $version[0]);

        define('PHP_MINOR_VERSION', $version[1]);

        define('PHP_RELEASE_VERSION', $version[2]);
    }

    $PHP_MAJOR_VERSION = PHP_MAJOR_VERSION;
    $PHP_MINOR_VERSION = PHP_MINOR_VERSION;
    $PHP_RELEASE_VERSION = PHP_RELEASE_VERSION;


    $phpVersion = PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION . '.' . PHP_RELEASE_VERSION;



    if ($PHP_MAJOR_VERSION . $PHP_MINOR_VERSION . $PHP_RELEASE_VERSION >= 531) {
        $phpVersion = $phpVersion . '<strong> OK </strong>';
    } else {
        $phpVersion = '<span style="color:red" > ' . $phpVersion . '</span>';
    }

    //xml mysql
    $Xml = '<span style="color:red" >Disabled</span>';
    $MySql = '<span style="color:red" >Disabled</span>';

    $LoadedExtensions = get_loaded_extensions();
    $i = count($LoadedExtensions) - 1;
    while ($i) {
        if ($LoadedExtensions[$i] == 'xml') {
            $Xml = "Enabled <strong> OK </strong>";
        }
        if ($LoadedExtensions[$i] == 'mysql') {
            $MySql = "Enabled <strong> OK </strong>";
        }
        $i--;
    }
    // allow_url_fopen
    if (ini_get('allow_url_fopen')) {
        $UrlOpen = "Enabled <strong> OK </strong>";
    } else {
        $UrlOpen = '<span style="color:red" >Disabled</span>';
    }
    // Hashing Engines md5
    if (function_exists('md5')) {
        $Md5 = "Enabled <strong> OK </strong>";
    } else {
        $Md5 = '<span style="color:red" >Disabled</span>';
    }
    // can write file
    $Perm = "Enabled <strong> OK </strong>";
    if (is_file("../test-writte_file.txt")) {
        unlink("../test-writte_file.txt") or $Perm = '<span style="color:red" >Disabled</span>';
    }
    $handle = fopen("../test-writte_file.txt", 'w') or $Perm = '<span style="color:red" >Disabled</span>';
    fwrite($handle, "we can write !");
    fclose($handle);
    //rewrite
    if (is_file("rewrite/rew")) {
        $ModRewrite = "Enabled <strong> OK </strong>";
    } else {
        $ModRewrite = '<span style="color:red" >Disabled</span>';
    }

    //
    $Step1 = '<h1>Minimum configurations</h1>
			<ul>
			  <li><a href="http://apache.org/">Apache</a> version required : 2.2.14, Installed : ' . $ApacheVersion . '</li>
			  <li><a href="http://php.net/">PHP </a>version required : 5.3.1, Installed : ' . $phpVersion . '</li>
			  <li>Support of<a href="http://httpd.apache.org/docs/2.2/"> XML </a> : ' . $Xml . ' </li>
			  <li>Support of<a href="http://mysql.com/"> MySQL </a> : ' . $MySql . ' </li>
			  <li><a href="http://httpd.apache.org/docs/2.2/">mod_rewrite </a>Module : ' . $ModRewrite . ' </li>
			  <li><a href="http://httpd.apache.org/docs/2.2/">allow_url_fopen</a> : ' . $UrlOpen . ' </li>
			  <li><a href="http://httpd.apache.org/docs/2.2/">Hashing Engines md5 </a> : ' . $Md5 . ' </li>
			  <li>Permission to writte file </a> : ' . $Perm . ' </li>
			</ul>
			We recommend <a href="http://code.google.com/p/modpagespeed" />mod_pagespeed </a> for performance and speed.<br/><br/>
			<form id="form1" name="form1" method="post" action="?step=2"><a href="index.php" >Previous</a><input type="submit" name="step1" id="step1" value="Next" /></form> 
			';
    return $Step1;
}

function LicenseInfo($LicenseKey) {

    if ($LicenseKey == "" or strlen($LicenseKey) < 123) {
        return false;
    }//end if

    $Cut1 = substr($LicenseKey, 0, 3); //1
    $Cut2 = substr($LicenseKey, 3, 14); //3
    $Cut3 = substr($LicenseKey, 17, 16); //8
    $Cut4 = substr($LicenseKey, 33, 14); //2
    $Cut5 = substr($LicenseKey, 47, 14); //5
    $Cut6 = substr($LicenseKey, 61, 14); //4
    $Cut7 = substr($LicenseKey, 75, 16); //9
    $Cut8 = substr($LicenseKey, 91, 16); //6
    $Cut9 = substr($LicenseKey, 107, 16); //7
    $Cut10 = substr($LicenseKey, 123, strlen($LicenseKey) - 123); //10
    $RegDomain = base64_decode($Cut10); // values : "ANY" or the domian name
    $RegStartDate = base64_decode($Cut4 . $Cut2);
    $RegEndDate = base64_decode($Cut6 . $Cut5); //LIFETIMEXXXXXXXXXXX OR DATE

    if ($RegEndDate == "LIFETIMEXXXXXXXXXXX") {
        $RegEndDate = "LIFETIME";
    }//end if

    $RegSource = strtolower($Cut8 . strrev($Cut9)); // values : "ENC" mean Encrypted or "OPN" mean "Open source"
    if (md5("ENC") == $RegSource) {
        $RegSource = "ENC";
    } elseif (md5("OPN") == $RegSource) {
        $RegSource = "OPN";
    } else {
        $RegSource = false;
    }//end if

    $RegPakage = $Cut3 . $Cut7; // values : "STD" mean Sandard OR "ADV" mean Advanced
    if (md5("STD") == $RegPakage) {
        $RegPakage = "STD";
    } elseif (md5("ADV") == $RegPakage) {
        $RegPakage = "ADV";
    } else {
        $RegPakage = false;
    }//end if



    if ($Cut1 == "1bd") { //ANY domain
        $ObjectName = "ANY";
    } else {
        $ObjectName = "SPECIFIED";
    }//end if

    return $LicenseInfo = array("RegDomain" => $RegDomain,
        "RegStartDate" => $RegStartDate,
        "RegEndDate" => $RegEndDate,
        "RegSource" => $RegSource,
        "RegPakage" => $RegPakage,
        "ObjectName" => $ObjectName);
}

//End function
//Delete the CACHE Files if exist any one
$cachedir = '../cache';
if ($handle = opendir($cachedir)) {
    while (false !== ($file = @readdir($handle))) {
        if ($file != '.' and $file != '..' and $file != 'index.html') {
            if (is_file($cachedir . '/' . $file)) {
                unlink($cachedir . '/' . $file);
            }
        }
    } closedir
            ($handle);
}
?>