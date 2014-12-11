{ImgTextViewandClickPrices}
<form id="formbanimg" name="formbanimg" method="post" action="{bansavetaget}">
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>{ImgName} :</td>
    <td><span id="imgtextfield1">
      <label>
      <input name="ImgName" type="text" class="text" id="ImgName" value="{valImgName}" maxlength="35" />
      </label>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
    <td rowspan="5"  valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>{altText} :</td>
    <td><span id="imgtextfield2">
      <label>
      <input name="altText" type="text" class="text" id="altText" value="{valaltText}" />
      </label>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
    </tr>
  <tr>
    <td>{ImgSrc} :</td>
    <td><span id="imgtextfield3">
    <label>
    <input name="ImgSrc" type="text" class="text" id="ImgSrc" dir="ltr" value="{valImgSrc}" />
    </label>
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
    </tr>
  <tr>
    <td>{ClickUrl} :</td>
    <td><span id="imgtextfield4">
   
    <input name="ClickUrl" type="text" class="text" id="ClickUrl" dir="ltr" value="{valClickUrl}" />
 </td>
    </tr>
  <tr>
    <td>{BannerPositions} :</td>
    <td>{SelectBannerPositions}</td>
    </tr>
</table>
<br/>
{Activity} : 
<input name="IdComp" type="hidden" value="{campid}" />
  <span id="ispryselect1">
  <label>
  <select class="select" name="Active" id="Active">
    <option value="1">{Working}</option>
    <option value="0">{Stoped}</option>
  </select>
  </label>
  <span class="selectRequiredMsg">{Pleaseselectanitem}</span></span>

<input name="updatesubminewtbanimg" type="submit" value="{subminewtban}"/>
</form><br/>

<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("imgtextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("imgtextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("imgtextfield3", "url");
var spryselect1 = new Spry.Widget.ValidationSelect("ispryselect1");
//-->
</script>
