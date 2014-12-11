{BanTextViewandClickPrices}
<form id="formbanimg" name="formbanimg" method="post" action="{bansavetaget}">
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>{bantexttitle} : </td>
    <td><input name="IdComp" type="hidden" value="{campid}" />
      <span id="sprytextfield1">
      <input name="bantexttitle" type="text" class="text" id="bantexttitle"  onchange="ban_From_Server()" value="{valuebantexttitle}"  maxlength="12"/>
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
    <td><span id="sprytextfield2">
      <input name="bantextdesc1" type="text"  class="text" id="bantextdesc1" onchange="ban_From_Server()" value="{valbantextdesc1}" maxlength="17"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>{bantextdesc2} : </td>
    <td><span id="sprytextfield3">
      <input name="bantextdesc2" type="text"  class="text" id="bantextdesc2" onchange="ban_From_Server()" value="{valbantextdesc2}" maxlength="35"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>{banshowaddress} : </td>
    <td><span id="sprytextfield4">
      <input name="banshowaddress" type="text"  class="text" id="banshowaddress" onchange="ban_From_Server()" value="{valbanshowaddress}" maxlength="35"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>{bantargeturl} : </td>
    <td><span id="sprytextfield5">
      <input name="bantargeturl" type="text"  class="text" id="bantargeturl" dir="ltr" onchange="ban_From_Server()" value="{valbanTargetaddress}" maxlength="1024"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
  <tr>
    <td>{BannerPositions} :</td>
    <td>{SelectBannerPositions}</td>
  </tr>
</table>
<br/>
{Activity} : 
  <span id="spryselect1">
  <label>
  <select class="select" name="Active" id="Active">
    <option value="1">{Working}</option>
    <option value="0">{Stoped}</option>
    </select>
  </label>
  <span class="selectRequiredMsg">{Pleaseselectanitem}</span></span>
<input name="Updatesubminewtban" type="submit" value="{subminewtban}" onchange="ban_From_Server()"/>
</form><br/>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "url");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
//-->
</script>
