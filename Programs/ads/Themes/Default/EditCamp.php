<form method="post" target="">
<table border="0">
  <tr>
    <td>CampName</td>
    <td><span id="sprytextfield1">
      <input class="text" type="text" name="savecampname" id="savecampname" value="{CampName}" maxlength="35" />
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span></td>
  </tr>
  <tr>
    <td>CompStart</td>
    <td><span id="sprytextfield2">
      <input class="text" type="text" name="savecompstart" id="savecompstart" value="{CompStart}" maxlength="35"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span>
                  <a href="javascript:void(0)" title="YYY-MM-DD HH:ii:ss">
			&nbsp;<img border="0" alt="" style="cursor:help" src="Programs/ads/images/info.gif" width="15" height="15"/>
            </a> 
      </td>
  </tr>
  <tr>
    <td>CompEnd</td>
    <td><span id="sprytextfield3">
      <input class="text" type="text" name="savecompend" id="savecompend" value="{CompEnd}" maxlength="35"/>
      <span class="textfieldRequiredMsg">Avalueisrequired</span></span>
                  <a href="javascript:void(0)" title="YYY-MM-DD HH:ii:ss">
			&nbsp;<img border="0" alt="" style="cursor:help" src="Programs/ads/images/info.gif" width="15" height="15"/>
            </a> 
      </td>
  </tr>
  <tr>
    <td>MaxView</td>
    <td><span id="sprytextfield4">
    <input class="text" type="text" name="savemaxview" id="savemaxview" value="{MaxView}" maxlength="35"/>
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
  <tr>
    <td>MaxClick</td>
    <td><span id="sprytextfield5">
    <input class="text" type="text" name="savemaxclick" id="savemaxclick" value="{MaxClick}" maxlength="35"/>
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
  <tr>
    <td>Budget</td>
    <td><span id="sprytextfield6">
    <input class="text" type="text" name="savebudget" id="savebudget" value="{Budget}" maxlength="35"/> 
    $ 
    <span class="textfieldRequiredMsg">Avalueisrequired</span><span class="textfieldInvalidFormatMsg">Invalidformat</span></span></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
    <br />
      <input class="submit" name="savecamp" type="submit" value="Save" />
    </div></td>
    </tr>
</table>

<input type="hidden" name="compid" id="compid" value="CompId"/>
</form>
<br />
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "integer");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "currency");
//-->
</script>
