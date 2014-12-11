<div id="textbannerdiv"  style="position:absolute">
{BanTextViewandClickPrices}
<form id="formbanimg" name="formbanimg" method="post" action="{bansavetaget}">
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>{bantexttitle} : </td>
    <td><input name="IdComp" type="hidden" value="{campid}" />
      <span id="sprytextfield1">
      <input class="text" name="bantexttitle" id="bantexttitle" type="text"  maxlength="12"  onchange="ban_From_Server()"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
    <td rowspan="6"><br/>
      <br/>
      <br/>
      <br/>      <br/>    </td>
    <td rowspan="6" valign="top">
    	{BannerExample} :
        <div style="border:solid" class="body">
        <div style=" font:bold" id="repbantexttitle"> Banner Title </div>
        <div style="color:#666666" id="repbantextdesc1"> simple description </div>
        <div style="color:#666666" id="repbantextdesc2"> long description, appear here </div>
        <div id="repbanshowaddress"> <a href="http://www.website.com" target="_blank" title="Banner Title"> click here to visit website.com </a></div>
        </div>      </td>
  </tr>
  <tr>
    <td>{bantextdesc1} :</td>
    <td><span id="sprytextfield22">
      <input  class="text" name="bantextdesc1" type="text" id="bantextdesc1" maxlength="17" onchange="ban_From_Server()"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>{bantextdesc2} : </td>
    <td><span id="sprytextfield33">
      <input name="bantextdesc2" type="text"  class="text" id="bantextdesc2" maxlength="35" onchange="ban_From_Server()"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>{banshowaddress} : </td>
    <td><span id="sprytextfield4">
      <input  class="text" name="banshowaddress" type="text" id="banshowaddress" maxlength="35" onchange="ban_From_Server()"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>{bantargeturl} : </td>
    <td><span id="sprytextfield5">
      <input dir="ltr" name="bantargeturl" type="text"  class="text" id="bantargeturl" maxlength="1024" onchange="ban_From_Server()"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
  <tr>
    <td>{BannerPositions} :</td>
    <td>{SelectBannerPositions}</td>
  </tr>
</table>
<br/>
<input name="subminewtban" type="submit" value="{subminewtban}" onchange="ban_From_Server()"/>
      <input name="submitnewbanandaddnew" type="submit" value="{submitnewbanandaddnew}" onclick="ban_From_Server()"/>
    </form><br/>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield22");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield33");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "url");
//-->
</script>
