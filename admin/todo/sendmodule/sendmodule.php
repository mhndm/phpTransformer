<?php
/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Descriptions: .
  Changes: .
  TODO:  .
     Author: Mohsen Mousawi mhndm@phptransformer.com .

*/
?>
<?php  if (!isset($IsAdmin)) {
    header("location: ../");
} ?>
<?php
global $CustomHead,$TinyDir;
global  $UserId , $LastSession;

if (isset($_COOKIE['phpTransformer'])) {
    $LastSession = session_id();
} else {
    $LastSession = '';
}

if(!isset($_POST['submit'])) {

    $CustomHead .= '  <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
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
                    $("<div id=\'myelfinder\' />").elfinder({
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
                                                            document.getElementById("submit").click();
                                        return false;
                                    }
                                    return false;
                                }
                            }
                            return true;
                        }
                    </script>';

    $SendModule = SendModuleAndSharingDesc.'.<br/>
  '.WeAcceptOnlyFreeOpenSourceSoftwares.'
 <form id="form1" name="form1" method="post" action="">
<table width="0%" border="0">
  <tr>
    <td>'.Name.' :</td>
    <td>
      <span id="sprytextfield1">
        <label for="'.Name.'"></label>
        <input type="text" name="'.Name.'" id="'.Name.'" />
        <span class="textfieldRequiredMsg">'.Avalueisrequired.'.</span></span>
    *</td>
  </tr>
  <tr>
    <td>'.Email.' :</td>
    <td><span id="sprytextfield2">
    <label for="'.Email.'"></label>
    <input type="text" name="'.Email.'" id="'.Email.'" />*
    <span class="textfieldRequiredMsg">'.Avalueisrequired.'.</span><span class="textfieldInvalidFormatMsg">'.Invalidformat.'.</span></span></td>
  </tr>
  <tr>
    <td>'.Company.' :</td>
    <td><label for="'.Company.'"></label>
      <input type="text" name="'.Company.'" id="'.Company.'" /></td>
  </tr>
  <tr>
    <td>'.Tel.':</td>
    <td><label for="'.Tel.'"></label>
      <input type="text" name="'.Tel.'" id="'.Tel.'" /></td>
  </tr>
  <tr>
    <td>'.Address.':</td>
    <td><span id="sprytextfield5">
      <label for="'.Address.'"></label>
      <input style="width:500px;" name="'.Address.'" type="text" id="'.Address.'" size="100" />
      <span class="textfieldRequiredMsg">'.Avalueisrequired.'.</span></span>*</td>
  </tr>
  <tr>
    <td>'.ReleaseInfo.': </td>
    <td><span id="sprytextfield3">
      <label for="'.ReleaseInfo.'"></label>
      <input style="width:500px;"  name="'.ReleaseInfo.'" type="text" id="'.ReleaseInfo.'" size="100" />
      <span class="textfieldRequiredMsg">'.Avalueisrequired.'.</span></span>*</td>
  </tr>
  <tr>
    <td style="vertical-align:top;" >'.SharingLink.' :</td>
    <td><span id="sprytextfield4">
    <label for="'.SharingLink.'"></label>
    <input style="width:500px;"  dir="ltr" name="'.SharingLink.'" type="text" id="'.SharingLink.'" value="http://" size="100" /><br/>'.SharingLinkMustBeAccessByEveryone.'
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">'.Invalidformat.'.</span></span>
        </td>
  </tr>
</table><br/>
'.ModuleType.' : <br/>
  <label>
    <input name="'.ModuleType.'" type="radio" id="'.Program.'" value="'.Program.'" checked="checked" />
    '.Program.'</label>
  <br />
  <label>
    <input type="radio" name="'.ModuleType.'" value="'.Block.'" id="Block" />
    '.Block.'</label>
  <br />
  <label>
    <input type="radio" name="'.ModuleType.'" value="'.Theme.'" id="'.Theme.'" />
    '.Theme.'</label>
  <br />
  <label>
    <input type="radio" name="'.ModuleType.'" value="'.Plugin.'" id="'.Plugin.'" />
    '.Plugin.'</label>
  <br />
    <label>
    <input type="radio" name="'.ModuleType.'" value="'.Help.'" id="'.Help.'" />
    '.Help.'</label>
  <br />
      <label>
    <input type="radio" name="'.ModuleType.'" value="'.Other.'" id="'.Other.'" />
    '.Other.'</label>
  <br /> <br/>
'.OpenSource.': <br/>
  <label>
    <input type="radio" name="'.OpenSource.'" value="'.Paid.'" id="'.Paid.'" />
    '.Paid.'</label>
  <br />
  <label>
    <input name="'.OpenSource.'" type="radio" id="'.FreeWithPaidSupport.'" value="'.FreeWithPaidSupport.'" checked="checked" />
    '.FreeWithPaidSupport.'</label>
  <br />
  <label>
    <input type="radio" name="'.OpenSource.'" value="'.FreeWithAds.'" id="'.FreeWithAds.'" />
    '.FreeWithAds.'</label>
  <br />
  <label>
    <input type="radio" name="'.OpenSource.'" value="'.PaidService.'" id="'.PaidService.'" />
    '.PaidService.'</label>
  <br />
  <label>
    <input type="radio" name="'.OpenSource.'" value="'.FreeWare.'" id="'.FreeWare.'" />
    '.FreeWare.'</label>
  <br />
 <br/>
'.MessageShare.'<br />
  <label for="'.MessageShare.'"></label>
  <textarea class="editor" name="'.MessageShare.'" id="'.MessageShare.'" ></textarea>
  <br />

 '.note.': '.BySubmitYourModuleYouHaveYourFullRightAsAuthor.' <br/>
 <span id="sprycheckbox1">
  <input type="checkbox" name="IAccept" id="IAccept" />
  <label for="IAccept"></label>
  <span class="checkboxRequiredMsg">'.Pleasemakeaselection.'.</span></span>'.MySoftwareFreeOpenSourceAndDontHaveMaliciousCodesOrCauseDamageForUserAndTestedForSecurityIssues.'
 <br/> <br/>

  <input class="submit" type="submit" name="submit" id="submit" value="'.submit.'" />
 <br/>

 &nbsp;
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "url");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
</script>

';
}
else {
    global $AdminMail,$WebSiteName;
    $AddAddress =array();
    $Body ='';
    $Subject        =  SendYouModule ;
    foreach($_POST as $info=>$valueinf){
      $Body .= $info .' : '.$valueinf .'<br/>';
    }
    echo $Body;
    $From           = $AdminMail;
    $FromName       = $WebSiteName;
    $AddAddress[0]  = 'support@phptransformer.com';
    $AddAddress[1]  = 'SendYouModule';
    $SendModule     = SendEmail($From, $FromName, $AddAddress, $Subject, $Body);
    $SendModule .=  '<BR/>'.PleaseDontPostYourWorkManyTimes;
}