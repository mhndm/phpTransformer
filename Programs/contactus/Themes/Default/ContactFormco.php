<?php
global $Lang, $CustomHead;

$CustomHead .= ' <link rel="stylesheet" href="includes/elrte/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8" /> 
    <link rel="stylesheet" href="includes/elrte/elrte/css/elrte.min.css"  type="text/css" media="screen" charset="utf-8" />


    <script src="includes/jquery/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/elrte.min.js"                  type="text/javascript" charset="utf-8"></script>
    <script src="includes/elrte/elrte/js/i18n/elrte.'.MiniLang.'.js"          type="text/javascript" charset="utf-8"></script>

    
    <script type="text/javascript" charset="utf-8">
        $().ready(function() {
			
            var opts = {
                absoluteURLs: false,
                cssClass : "el-rte",
                lang     : "'.MiniLang.'",
                height   : 250,
		width:500,
                toolbar  : "mini",
                cssfiles : ["includes/elrte/elrte/css/elrte-inner.css"],
           
            }
            $(".editor").elrte(opts);
           
        })
    </script>';

?>
</script>
<form name="formcontactUs" method="post" action="">
<table border="0">
    <tr><td>{ContactUsNote}</td></tr>
  <tr>
    <td>{FullName}</td>
    <td>
      
          <input value="{FullNameValue}" class="text" name="FullName" type="text" id="FullName"  size="35" maxlength="35">    </td>
  </tr>
  <tr>
    <td>{EmailAddress}</td>
    <td><input value="{EmailAddressValue}" class="text" name="EmailAddress" type="text" id="EmailAddress" size="35" maxlength="128"></td>
  </tr>
  <tr>
    <td>{TelNumber}</td>
    <td><input value="{TelNumberValue}" class="text" name="TelNumber" type="text" id="TelNumber" size="35" maxlength="35"></td>
  </tr>
  <tr>
    <td>{Street}</td>
    <td><input value="{StreetValue}" class="text" name="Street" type="text" id="Street" size="35" maxlength="50"></td>
  </tr>
  <tr>
    <td>{City}</td>
    <td><input value="{CityValue}" class="text" name="City" type="text" id="City" size="35" maxlength="35"></td>
  </tr>
  <tr>
    <td>{Contry}</td>
    <td>
	<select dir="ltr" class="select" name="Contry" id="Contry">
    <option value="{ContryValue}" selected="selected">{ContryValue}</option>
	<?php
		global $conn;
		SqlConnect();
		$query="SELECT * FROM `cclang`;";
		

		$Rec = mysqli_query($conn,$query); 
		$Totals = mysqli_num_rows($Rec);
			if ($Totals>0){
				for($i=0;$i<$Totals;$i++){
				$ContryRows = mysqli_fetch_assoc($Rec);
				echo '<option value="'.$ContryRows['cc'].'">'.$ContryRows['Contry'].'</option>';
				}
			}//end if
		mysqli_free_result($Rec);

	?>	
    </select>
</td>
  </tr>
  <tr>
    <td>{TypeOfFeedback}</td>
    <td><input name="TypeOfFeedback" id="Comment" value="Comment" {CommentValue} type="radio" >
               <label for="Comment" > {Comment} </label>
      <input name="TypeOfFeedback"  id="Question"  value="Question" {QuestionValue} type="radio" >
      <label for="Question" >{Question} </label>
      <input name="TypeOfFeedback"  id="Complaint"  value="Complaint" {ComplaintValue} type="radio">
      <label for="Complaint" >{Complaint} </label>
    </td>
  </tr>
  <tr>
    <td>{DepartmentToCall}</td>
    <td>
	<select class="select" name="DepartmentToCall" id="DepartmentToCall">
    <option value="" > </option>
	<?php
		global $conn,$Lang;
                if(isset($_GET['DepartmentToCall'])) {
                    $IdDepgET = InputFilter($_GET['DepartmentToCall']);
                }
                else{
                    $IdDepgET = '';
                }
		SqlConnect();
		$query="SELECT * from `languages` where `LangName`='".$Lang."' ;";
		$Rec = mysqli_query($conn,$query);
		$cuRows = mysqli_fetch_assoc($Rec);
		$IdLang = $cuRows['IdLang'];
		
		$query="SELECT *
				FROM `contactus` , `contactuslang`
				WHERE `contactus`.`IdDep` = `contactuslang`.`IdDep`
				AND `contactuslang`.`IdLang` = '".$IdLang."'";
		
		$Rec = mysqli_query($conn,$query);
		$Totals = mysqli_num_rows($Rec);
			if ($Totals>0){
				for($i=0;$i<$Totals;$i++){
				$cuRows = mysqli_fetch_assoc($Rec);
                                if($IdDepgET != $cuRows['IdDep']){
                                    echo '<option value="'.$cuRows['IdDep'].'">'.$cuRows['DepName'].'</option>';
                                }
                                else{
                                    echo '<option selected="selected" value="'.$cuRows['IdDep'].'">'.$cuRows['DepName'].'</option>';
                                }
				}
			}//end if
		mysqli_free_result($Rec);
	?>	
    </select>
</td>
  </tr>
  <tr>
    <td>{Subject}</td>
    <td><input value="{SubjectValue}" class="text" name="Subject" type="text" id="Subject" size="45" maxlength="45"></td>
  </tr>
  <tr>
    <td>{Message}</td>
    <td><textarea class="editor" name="Message" id="Message" cols="45" rows="10">{MessageValue}</textarea></td>
  </tr>
    <tr>
      <td>
           {InputCode}
      </td>
      <td>
        <img src="images/captcha.php" alt=""/> {here} <input name="CodePic" type="text" size="12" maxlength="35" class="text" />
      </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
	<br/>
	<input class="submit" name="SubmitContactForm" type="submit" id="SubmitContactForm"  value="{submit}" ></td>
    </tr>
</table>
</form>