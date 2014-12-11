<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="">
{LetterNameDesc} : 
  <span id="sprytextfield1">
  <input name="LetterName" class="" type="text" value="LetterName" maxlength="100" />
  <span class="textfieldRequiredMsg">A value is required.</span></span><br/>
<fieldset><legend>English </legend>
{TitleLetterDesc} :<br/>
<input name="TitleLetterEnglish" type="text" value="TitleLetterEnglish" maxlength="100" />
<br/>
{BodyLetterDescLang} :<br/>
<span id="sprytextarea1">
<textarea name="BodyLetterEnglish" cols="40" rows="10">BodyLetterEnglish</textarea>
<span class="textareaRequiredMsg">A value is required.</span></span>
</fieldset>
<input name="SubmitLetter" type="submit" value="{Save}" />
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
//-->
</script>
