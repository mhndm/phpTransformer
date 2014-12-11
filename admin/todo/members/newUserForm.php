<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

<form method="post" action="" >
<table cellpadding="0" cellspacing="0">
  <tr>
    <td >
		{UserName}:     </td>
    <td ><span id="sprytextfield1">
      <input  maxlength="15" class="text" value="" name="UserName" type="text"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td >
		{FamName}:
	</td>
    <td><span id="sprytextfield2">
      <input maxlength="15" value=""  class="text" name="FamName" type="text" />
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td >
{NickName}: </td>
    <td ><span id="sprytextfield3">
      <input maxlength="15" value="" class="text" name="NickName" type="text" />
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td  valign="top">{Email} :</td>
    <td ><span id="sprytextfield4">
    <input maxlength="50" class="text"  value=""  name="UserMail" type="text" />
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
  <tr>
    <td  valign="top"> {PassWord} : </td>
    <td ><span id="sprytextfield5">
      <input maxlength="35" value="" class="text"  name="PassWord" type="password" id="PassWord"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td  valign="top">{RePassWord} : </td>
    <td ><span id="sprytextfield6">
    <input maxlength="35"class="text"  value="" name="RePassWord" type="password" id="RePassWord"/>
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
</table>
<p>
  <label>
  <input type="submit" class="submit" name="savenewuser" onclick="validatepass();return document.returnValue" id="savenewuser" value="{save}" />
  </label>
</p>
</form>

<script type="text/javascript">
function validatepass() { 
		pass = document.getElementById("PassWord").value;
		repass = document.getElementById("RePassWord").value;
		if(pass != repass){
			errors ="error";
			window.alert(errors);
			document.returnValue = false;
		}
		else{
			document.returnValue = true;
		}
}
</script>

<script type="text/javascript">
<!--

var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "custom");

//-->
</script>

