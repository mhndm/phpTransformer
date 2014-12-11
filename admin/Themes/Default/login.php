<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="44">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center" valign="middle">
    <img src="{ImgSrc}" alt="Login" width="64" height="64" />
    <br/><br/>
    <form id="formLoginAdmin" name="formLoginAdmin" method="post" action="">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="">{UserName} : &nbsp;</td>
          <td width="">
          <span id="sprytextfield1">
          <input name="UserName" type="text" id="UserName" onclick="MM_setTextOfTextfield('UserName','','')"  value="UserName" maxlength="15" style=" width: 150px ;background-image:url(images/usr.gif); background-position:left; background-repeat:no-repeat; border-bottom:#000000 solid 1px; padding-left:20px;"/>
          <span class="textfieldRequiredMsg">Avalueisrequired</span></span>          </td>
        </tr>
        <tr>
          <td width="">{Password} : &nbsp;</td>
          <td width=""><span id="sprytextfield2">
            <input name="UserPassword" type="password" id="UserPassword" onclick="MM_setTextOfTextfield('UserPassword','','')" value="Passw0rd" maxlength="100" style=" width: 150px;background-image:url(images/pswd.gif); background-position:left; background-repeat:no-repeat; border-bottom:#000000 solid 1px; padding-left:20px;"/>
            <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
        </tr>
        <tr>
          <td colspan="2"><div align="center">
            
          </div></td>
          </tr>
      </table>
      <br/>
        <input class="submit" name="SubmitLogin" type="submit" value="login" />
    </form>
    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>

