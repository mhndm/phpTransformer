<div id="imgbannerdiv" style="position:absolute">
{ImgTextViewandClickPrices}
<form id="formbanimg" name="formbanimg" method="post" action="{bansavetaget}">
<table border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>{ImgName} :</td>
    <td><span id="imgtextfield1">
      <label>
      <input class="text" name="ImgName" type="text" id="ImgName" maxlength="35" />
      </label>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
    <td rowspan="5"  valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>{altText} :</td>
    <td><span id="imgtextfield2">
      <label>
      <input class="text" type="text" name="altText" id="altText" />
      </label>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
    </tr>
  <tr>
    <td>{ImgSrc} :</td>
    <td><span id="imgtextfield3">
    <label>
    <input dir="ltr" class="text" type="text" name="ImgSrc" id="ImgSrc" />
    </label>
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
    </tr>
  <tr>
    <td>{ClickUrl} :</td>
    <td>
    <input dir="ltr" class="text" type="text" name="ClickUrl" id="ClickUrl" />
   
 </td>
    </tr>
  <tr>
    <td>{BannerPositions} :</td>
    <td>{SelectBannerPositions}</td>
    </tr>
</table>
<input name="IdComp" type="hidden" value="{campid}" />
<input name="subminewtbanimg" type="submit" value="{subminewtban}"/>
<input name="submitnewbanandaddnewimg" type="submit" value="{submitnewbanandaddnew}"/>
  </form><br/>
</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("imgtextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("imgtextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("imgtextfield3", "url");

//-->
</script>
