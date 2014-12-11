<div id="flashbannerdiv"  style="position:absolute">
{FlashTextViewandClickPrices}
<form id="formbanflash" name="formbanflash" method="post" action="{bansavetaget}">
    <table border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td>{BannerName} : </td>
        <td><span id="sprytextfield1">
          <label>
          <input class="text" name="BannerName" type="text" id="BannerName" maxlength="35" />
          </label>
        <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
      </tr>
      <tr>
        <td>{FlashSource} : </td>
        <td><span id="sprytextfield2">
        <label>
        <input class="text" name="banFlashSource" type="text" id="banFlashSource" dir="ltr" maxlength="1024" />
        </label>
        <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
      </tr>

        <tr>
    <td>{BannerPositions} :</td>
    <td>{SelectBannerPositions}</td>
    </tr>
    </table>
    <br/>
      <input name="IdComp" type="hidden" value="{campid}" />
    <input name="subminewtbanflash" type="submit" value="{subminewtban}" />
      <input name="submitnewbanandaddnewflash" type="submit" value="{submitnewbanandaddnew}"/>
  </form>


</div>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "url");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "url");
//-->
</script>
