{FlashTextViewandClickPrices}
<form id="formbanflash" name="formbanflash" method="post" action="{bansavetaget}">
    <table border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td>{BannerName} : </td>
        <td><span id="sprytextfield1">
          <label>
          <input name="BannerName" type="text" class="text" id="BannerName" value="{valBannerName}" maxlength="35" />
          </label>
        <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
      </tr>
      <tr>
        <td>{FlashSource} : </td>
        <td><span id="sprytextfield2">
        <label>
        <input name="banFlashSource" type="text" class="text" id="banFlashSource" dir="ltr" value="{valFlashSource}" maxlength="1024" />
        </label>
        <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
      </tr>
      <tr>
        <td>{BannerTarget} : </td>
        <td><span id="sprytextfield3">
        <label>
        <input name="BannerTarget" type="text" class="text" id="BannerTarget" dir="ltr" value="{valBannerTarget}" maxlength="1024" />
        </label>
        <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
      </tr>
        <tr>
    <td>{BannerPositions} :</td>
    <td>{SelectBannerPositions}</td>
    </tr>
    </table>
    <br/>
    {Activity} : 
      <span id="fspryselect1">
  <label>
  <select class="select" name="Active" id="Active">
    <option value="1">{Working}</option>
    <option value="0">{Stoped}</option>
  </select>
  </label>
  <span class="selectRequiredMsg">{Pleaseselectanitem}</span></span>
<input name="IdComp" type="hidden" value="{campid}" />
    <input name="updatesubminewtbanflash" type="submit" value="{subminewtban}" />
</form>


<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "url");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "url");
var spryselect1 = new Spry.Widget.ValidationSelect("fspryselect1");
//-->
</script>
