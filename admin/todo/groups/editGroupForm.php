<script src="admin/includes/SpryValidationTextField.js" type="text/javascript"></script>
<link href="admin/includes/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form name="form1" method="post" action=""><table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td> {GroupName} :  </td>
    <td>
    <span id="sprytextfield1">
    <input class="text" name="GroupName" type="text" value="{valGroupName}" size="15" maxlength="15" /><span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldMinCharsMsg">Minimumnumberofcharactersnotmet</span></span>
    </td>
  </tr>
  <tr>
    <td>{GroupDesc} : </td>
    <td><input class="text" name="Desc" type="text" id="Desc" value="{valDesc}" size="50" maxlength="50" /></td>
  </tr>
  <tr>
    <td colspan="2"><input class="submit" type="submit" name="SaveGroup" id="SaveGroup" value="save" /></td>
    </tr>
</table>

  <br/>
  <br/>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:3});
//-->
</script>
