<form id="formCV" name="formCV" method="post" action="" enctype="multipart/form-data">
    <p>{CvNotes}</p>
    <strong>{PersonalInfo}</strong>:
    <table width="675px" border="0" cellspacing="1" cellpadding="1" >
        <tr>
            <td>{FirstName} : </td>
            <td>
                <span id="sprytextfield1">

                    <input name="FirstName" type="text" class="text" id="FirstName" value="{FirstNameValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span>    </td>
            <td>{FatherName} : </td>
            <td><span id="sprytextfield2">

                    <input name="FatherName" type="text" class="text" id="FatherName" value="{FatherNameValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{MotherName} : </td>
            <td><span id="sprytextfield3">
                    <input name="MotherName" type="text" class="text" id="MotherName" value="{MotherNameValue}"  maxlength="35" />
                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{GrandFatherName} : </td>
            <td><span id="sprytextfield4">

                    <input name="GrandFatherName" type="text" class="text" id="GrandFatherName" value="{GrandFatherNameValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{FamilyName} : </td>
            <td><span id="sprytextfield5">

                    <input name="FamilyName" type="text" class="text" id="FamilyName" value="{FamilyNameValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{BirthDate} : </td>
            <td><span id="sprytextfield6">

                    <input name="BirthDate" type="text" class="text" id="BirthDate" value="{BirthDateValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{BirthLocation} : </td>
            <td><span id="sprytextfield7">

                    <input name="BirthLocation" type="text" class="text" id="BirthLocation" value="{BirthLocationValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{Sex} : </td>
            <td>
                <select class="select"  name="Sex" id="Sex">
                    {SexValue}
                </select>      </td>
        </tr>
        <tr>
            <td>{Nationality} : </td>
            <td><span id="sprytextfield9">

                    <input value="{NationalityValue}" type="text" class="text" name="Nationality" id="Nationality" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{SegelNbr} : </td>
            <td><span id="sprytextfield10">
                    <input name="SegelNbr" type="text" class="text" id="SegelNbr" value="{SegelNbrValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{SegelLocation} : </td>
            <td><span id="sprytextfield11">

                    <input name="SegelLocation" type="text" class="text" id="SegelLocation" value="{SegelLocationValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{DamanNbr} : </td>
            <td>
                <input name="DamanNbr" type="text" class="text" id="DamanNbr" value="{DamanNbrValue}"  />    </td>
        </tr>
        <tr>
            <td>{MaritalStatus} : </td>
            <td colspan="3">
                <input name="MaritalStatus" type="radio" id="Celibate" value="Celibate" {celibateValue} />
                      <label for="Celibate">  {Celibate}</label>
                       <input name="MaritalStatus" type="radio" id="Mariage" value="Mariage" {MariageValue} />
                         <label for="Mariage">{Mariage}</label>
                       <input name="MaritalStatus" type="radio" id="Widower" value="Widower" {WidowerValue} />
                       <label for="Widower">  {Widower}</label>
                       <input name="MaritalStatus" type="radio" id="Divorced" value="Divorced" {DivorcedValue} />
                        <label for="Divorced"> {Divorced}</label>
                       <input name="MaritalStatus" type="radio" id="Fiance" value="Fiance" {FianceValue} />
                        <label for="Fiance"> {Fiance}</label> </td>
        </tr>
        <tr>
            <td>{SpendName}</td>
            <td>{Relative}</td>
            <td>{Sex}      </td>
            <td>{BirthDate}</td>
        </tr>
        <tr>
            <td>
                <input value="{SpendName1Value}" type="text" class="text" name="SpendName1" id="SpendName1" />    </td>
            <td>
                <input name="Relative1" type="text" class="text" id="Relative1" value="{Relative1Value}"  maxlength="35" />    </td>
            <td>
                <select class="select"  name="Sex1" id="Sex1">
                    {Sex1Value}
                </select></td>
            <td>
                <input name="BirthDate1" type="text" class="text" id="BirthDate1"  value="{BirthDate1Value}" size="12" maxlength="12" />    </td>
        </tr>
        <tr>
            <td><input value="{SpendName2Value}" type="text" class="text" name="SpendName2" id="SpendName2" /></td>
            <td><input name="Relative2" type="text" class="text" id="Relative2" value="{Relative2Value}"  maxlength="35" /></td>
            <td>
                <select class="select"  name="Sex2" id="Sex2">
                    {Sex2Value}
                </select>    </td>
            <td><input name="BirthDate2" type="text" class="text" id="BirthDate2" value="{BirthDate2Value}" size="12" maxlength="12" /></td>
        </tr>
        <tr>
            <td>
                <input  value="{SpendName3Value}" type="text" class="text" name="SpendName3" id="SpendName3" />    </td>
            <td>
                <input name="Relative3" type="text" class="text" id="Relative3" value="{Relative3Value}"  maxlength="35" />    </td>
            <td>
                <select class="select"  name="Sex3" id="Sex3">
                    {Sex3Value}
                </select>      </td>
            <td>
                <input name="BirthDate3" type="text" class="text" id="BirthDate3"  value="{BirthDate3Value}" size="12" maxlength="12" />    </td>
        </tr>
        <tr>
            <td>
                <input  value="{SpendName4Value}" type="text" class="text" name="SpendName4" id="SpendName4" />    </td>
            <td>
                <input name="Relative4" type="text" class="text" id="Relative4"  value="{Relative4Value}"  maxlength="35" />    </td>
            <td>
                <select class="select"  name="Sex4" id="Sex4">
                    {Sex4Value}
                </select>      </td>
            <td>
                <input name="BirthDate4" type="text" class="text" id="BirthDate4" value="{BirthDate4Value}" size="12" maxlength="12" />    </td>
        </tr>
        <tr>
            <td>
                <input value="{SpendName5Value}" type="text" class="text" name="SpendName5" id="SpendName5" />    </td>
            <td>
                <input name="SpendName6" type="text" class="text" id="SpendName6" value="{SpendName6Value}"  maxlength="35" />    </td>
            <td>
                <select class="select"  name="Sex5" id="Sex5">
                    {Sex5Value}
                </select>      </td>
            <td>
                <input name="BirthDate5" type="text" class="text" id="BirthDate5" value="{BirthDate5Value}" size="12" maxlength="12" />    </td>
        </tr>
        <tr>
            <td>
                <input value="{SpendName6Value}" type="text" class="text" name="SpendName6" id="SpendName6" />    </td>
            <td>
                <input name="Relative6" type="text" class="text" id="Relative6" value="{Relative6Value}"  maxlength="35" />    </td>
            <td>
                <select class="select"  name="Sex6" id="Sex6">
                    {Sex6Value}
                </select>      </td>
            <td>
                <input name="BirthDate6" type="text" class="text" id="BirthDate6" value="{BirthDate6Value}" size="12" maxlength="12" />    </td>
        </tr>
        <tr>
            <td>{HealthStatus} :</td>
            <td colspan="3">
                <input name="HealthStatus" type="text" class="text" id="HealthStatus" value="{HealthStatusValue}"  maxlength="35" />    </td>
        </tr>
        <tr>
            <td>{DidUInfectedIn} ?</td>
            <td colspan="3"> 

                <input type="checkbox" name="Hearing" id="Hearing" {HearingValue} />
                       <label for="Hearing"> {Hearing}</label>  
                <input type="checkbox" name="Viewing" id="Viewing"  {ViewingValue} />
                       <label for="Viewing">  {Viewing} </label>
                <input type="checkbox" name="Talking" id="Talking" {TalkingValue} />
                       <label for="Talking">  {Talking}</label></td>
        </tr>
        <tr>
            <td>{DidUSmoke} ?</td>
            <td>
                <input type="radio" name="DidUSmoke" id="DidUSmokeyes" value="yes" {DidUSmokeYesValue} />
                       <label for="DidUSmokeyes"> {Yes} </label>
                <input type="radio" name="DidUSmoke" id="DidUSmokeno" value="no" {DidUSmokeNoValue} />
                       <label for="DidUSmokeno"> {No}  </label>  </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>{DidUDoObliging} ?</td>
            <td><input name="DidUDoObliging" type="radio" id="DidUDoObligingyes" value="yes" {DidUDoObligingYesValue} />
                       <label for="DidUDoObligingyes"> {Yes}</label>
                <input name="DidUDoObliging" type="radio" id="DidUDoObligingno" value="no" {DidUDoObligingNoValue} />
                       <label for="DidUDoObligingno"> {No}</label></td>
            <td>{ObligingOther} :</td>
            <td>
                <input value="{ObligingOtherValue}" type="text" class="width-long" name="ObligingOther" id="ObligingOther" />    </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br />
    <strong>{ContactInfo}</strong> :<br />
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>{Town}</td>
            <td><span id="sprytextfield8">

                    <input name="Town" type="text" class="text" id="Town" value="{TownValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{Rue}:</td>
            <td><span id="sprytextfield12">

                    <input name="Rue" type="text" class="text" id="Rue"  value="{RueValue}"  maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{Building} :</td>
            <td>
                <input name="Building" type="text" class="text" id="Building" value="{BuildingValue}" maxlength="35" />
            </td>
            <td>{BuildOwner} :</td>
            <td>
                <input name="BuildOwner" type="text" class="text" id="BuildOwner" value="{BuildOwnerValue}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>{Phone} :</td>
            <td><span id="sprytextfield13">
                    <input name="Phone" type="text" class="text" id="Phone" value="{PhoneValue}" maxlength="35" />
                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td>{Cellulaire} :</td>
            <td>
                <input name="Cellulaire" type="text" class="text" id="Cellulaire"  value="{CellulaireValue}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>{Email} :</td>
            <td colspan="3"><span id="sprytextfield14">
                    <input name="Email" dir="ltr" type="text" class="text" id="Email" value="{EmailValue}" maxlength="100"  />
                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span><span class="textfieldInvalidFormatMsg">{Invalidformat}</span></span></td>
        </tr>
    </table>
    <br />
    <strong>{EducationSkills}</strong> : <br />
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>{EducationLevel}</td>
            <td>{Average}</td>
            <td>{CertifecateFrom}</td>
            <td>{CertifecateYear}</td>
        </tr>
        <tr>
            <td>
                <input name="EducationLevel1" type="text" class="text" id="EducationLevel1" value="{EducationLevel1Value}" maxlength="35" />
            </td>
            <td>
                <input name="Average1" type="text" class="text" id="Average1" value="{Average1Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateFrom1" type="text" class="text" id="CertifecateFrom1" value="{CertifecateFrom1Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateYear1"  type="text" class="text" id="CertifecateYear1" value="{CertifecateYear1Value}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="EducationLevel2" type="text" class="text" id="EducationLevel2" value="{EducationLevel2Value}" maxlength="35" />
            </td>
            <td>
                <input name="Average2" type="text" class="text" id="Average2" value="{Average2Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateFrom2" type="text" class="text" id="CertifecateFrom2" value="{CertifecateFrom2Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateYear2" type="text" class="text" id="CertifecateYear2"  value="{CertifecateYear2Value}" maxlength="35" />
            </td>
        </tr>

        <tr>
            <td>
                <input name="EducationLevel3" type="text" class="text" id="EducationLevel3" value="{EducationLevel3Value}" maxlength="35" />
            </td>
            <td>
                <input name="Average3" type="text" class="text" id="Average3" value="{Average3Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateFrom3" type="text" class="text" id="CertifecateFrom3" value="{CertifecateFrom3Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateYear3" type="text" class="text" id="CertifecateYear3" value="{CertifecateYear3Value}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="EducationLevel4" type="text" class="text" id="EducationLevel4" value="{EducationLevel4Value}" maxlength="35" />
            </td>
            <td>
                <input name="Average14" type="text" class="text" id="Average4" value="{Average14Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateFrom14" type="text" class="text" id="CertifecateFrom4" value="{CertifecateFrom14Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateYear4" type="text" class="text" id="CertifecateYear4" value="{CertifecateYear4Value}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="EducationLevel5" type="text" class="text" id="EducationLevel5" value="{EducationLevel5Value}" maxlength="35" />
            </td>
            <td>
                <input name="Average5" type="text" class="text" id="Average5" value="{Average5Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateFrom5" type="text" class="text" id="CertifecateFrom5"  value="{CertifecateFrom5Value}" maxlength="35" />
            </td>
            <td>
                <input name="CertifecateYear5" type="text" class="text" id="CertifecateYear5"  value="{CertifecateYear5Value}" maxlength="35" />
            </td>
        </tr>
    </table>
    <br />
    <strong>{SpecialCycles}</strong> :<br />
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>{CycleName}</td>
            <td>{CycleInterval}</td>
            <td>{SkillsFromCycle}</td>
            <td>{CycleFrom}</td>
            <td>{CycleDate}</td>
        </tr>
        <tr>
            <td>
                <input  value="{CycleName1Value}" type="text" class="text" name="CycleName1" id="CycleName1" />
            </td>
            <td>
                <input value="{CycleInterval1Value}" type="text" class="text" name="CycleInterval1" id="CycleInterval1" />
            </td>
            <td>
                <input value="{SkillsFromCycle1Value}" type="text" class="text" name="SkillsFromCycle1" id="SkillsFromCycle1" />
            </td>
            <td>
                <input name="CycleFrom1" type="text" class="text" id="CycleFrom1" value="{CycleFrom1Value}" />
            </td>
            <td>
                <input name="CycleDate1" type="text" class="text" id="CycleDate1" value="{CycleDate1Value}" size="12" maxlength="12" />
            </td>
        </tr>
        <tr>
            <td>
                <input value="{CycleName2Value}" type="text" class="text" name="CycleName2" id="CycleName2" />
            </td>
            <td>
                <input value="{CycleInterval2Value}" type="text" class="text" name="CycleInterval2" id="CycleInterval2" />
            </td>
            <td>
                <input value="{SkillsFromCycle12Value}" type="text" class="text" name="SkillsFromCycle12" id="SkillsFromCycle2" />
            </td>
            <td>
                <input name="CycleFrom2" type="text" class="text" id="CycleFrom2"  value="{CycleFrom2Value}" />
            </td>
            <td>
                <input name="CycleDate2" type="text" class="text" id="CycleDate2" value="{CycleDate2Value}" size="12" maxlength="12" />
            </td>
        </tr>
        <tr>
            <td>
                <input value="{CycleName3Value}" type="text" class="text" name="CycleName3" id="CycleName3" />
            </td>
            <td>
                <input value="{CycleInterval3Value}" type="text" class="text" name="CycleInterval3" id="CycleInterval3" />
            </td>
            <td>
                <input value="{SkillsFromCycle13Value}" type="text" class="text" name="SkillsFromCycle13" id="SkillsFromCycle3" />
            </td>
            <td>
                <input name="CycleFrom3" type="text" class="text" id="CycleFrom3" value="{CycleFrom3Value}" />
            </td>
            <td>
                <input name="CycleDate3" type="text" class="text" id="CycleDate3" value="{CycleDate3Value}" size="12" maxlength="12" />
            </td>
        </tr>
        <tr>
            <td>
                <input value="{CycleName4Value}" type="text" class="text" name="CycleName4" id="CycleName4" />
            </td>
            <td>
                <input value="{CycleInterval4Value}" type="text" class="text" name="CycleInterval4" id="CycleInterval4" />
            </td>
            <td>
                <input value="{SkillsFromCycle14Value}" type="text" class="text" name="SkillsFromCycle14" id="SkillsFromCycle4" />
            </td>
            <td>
                <input name="CycleFrom4" type="text" class="text" id="CycleFrom4" value="{CycleFrom4Value}" />
            </td>
            <td>
                <input name="CycleDate4" type="text" class="text" id="CycleDate4" value="{CycleDate4Value}" size="12" maxlength="12" />
            </td>
        </tr>
        <tr>
            <td>
                <input value="{CycleName5Value}" type="text" class="text" name="CycleName5" id="CycleName5" />
            </td>
            <td>
                <input value="{CycleInterval5Value}" type="text" class="text" name="CycleInterval5" id="CycleInterval5" />
            </td>
            <td>
                <input value="{SkillsFromCycle15Value}" type="text" class="text" name="SkillsFromCycle15" id="SkillsFromCycle5" />
            </td>
            <td>
                <input name="CycleFrom5" type="text" class="text" id="CycleFrom5"  value="{CycleFrom5Value}" />
            </td>
            <td>
                <input name="CycleDate5" type="text" class="text" id="CycleDate5" value="{CycleDate5Value}" size="12" maxlength="12" />
            </td>
        </tr>
    </table>
    <p><strong>{ForeignLang}</strong>:<br />
    </p>
    <table border="0" cellspacing="5" cellpadding="1">
        <tr>
            <td>&nbsp;</td>
            <td><strong>{Read}</strong></td>
            <td><strong>{Write}</strong></td>
            <td><strong>{Speak}</strong></td>
        </tr>
        <tr>
            <td>
                <strong>{LangName}</strong><br />
                <input name="LangName1" type="text" class="text" id="LangName1" value="{LangName1Value}" maxlength="35" />    </td>
            <td>
                <input type="radio" name="ReadLang1" id="ReadExcellent1" value="ReadExcellent1"  {ReadExcellent1Value} />
                       <label for="ReadExcellent1" >
                    {Excellent}</label><br />

                <input type="radio" name="ReadLang1" id="ReadGood1" value="ReadGood1" {ReadGood1Value} />
                       <label for="ReadGood1" >
                    {Good} </label><br />

                <input type="radio" name="ReadLang1" id="ReadMoyen1" value="ReadMoyen1" {ReadMoyen1Value} />
                       <label for="ReadMoyen1" >
                    {Moyen}</label><br />

                <input type="radio" name="ReadLang1" id="ReadUnderMoyen1" value="ReadUnderMoyen1" {ReadUnderMoyen1Value} />
                       <label for="ReadUnderMoyen1" >
                    {UnderMoyen}</label><br /></td>
            <td><input type="radio" name="WriteLang1" id="WriteExcellent1" value="WriteExcellent1" {WriteExcellent1Value} />
                       <label for="WriteExcellent1" >{Excellent}</label><br />
                <input type="radio" name="WriteLang1" id="WriteGood1" value="WriteGood1" {WriteGood1Value} />
                       <label for="WriteMoyen1" > {Good}</label><br />
                <input type="radio" name="WriteLang1" id="WriteMoyen1" value="WriteMoyen1" {WriteMoyen1Value} />
                       <label for="WriteGood1" >  {Moyen}</label><br />
                <input type="radio" name="WriteLang1" id="WriteUnderMoyen1" value="WriteUnderMoyen1" {WriteUnderMoyen1Value} />
                       <label for="WriteUnderMoyen1" > {UnderMoyen}</label></td>
            <td><input type="radio" name="SpeakLang1" id="SpeakExcellent1" value="SpeakExcellent1" {SpeakExcellent1Value} />
                       <label for="SpeakExcellent1" > {Excellent}</label><br />
                <input type="radio" name="SpeakLang1" id="SpeakGood1" value="SpeakGood1" {SpeakGood1Value} />
                       <label for="SpeakGood1" >  {Good}</label><br />
                <input type="radio" name="SpeakLang1" id="SpeakMoyen1" value="SpeakMoyen1"  {SpeakMoyen1Value} />
                       <label for="SpeakMoyen1" > {Moyen}</label><br />
                <input type="radio" name="SpeakLang1" id="SpeakUnderMoyen1" value="SpeakUnderMoyen1" {SpeakUnderMoyen1Value} />
                       <label for="SpeakUnderMoyen1" > {UnderMoyen}</label></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><strong>{Read}</strong></td>
            <td><strong>{Write}</strong></td>
            <td><strong>{Speak}</strong></td>
        </tr>
        <tr>
            <td><strong>{LangName}<br />
                </strong>
                <input name="LangName2" type="text" class="text" id="LangName2" value="{LangName2Value}" maxlength="35" />    </td>
            <td><input type="radio" name="ReadLang2" id="ReadExcellent2" value="ReadExcellent2" {ReadExcellent2Value} />
                       <label for="ReadExcellent2" >  {Excellent}</label><br />
                <input type="radio" name="ReadLang2" id="ReadGood2" value="ReadGood2" {ReadGood2Value} />
                       <label for="ReadGood2" >   {Good}</label><br />
                <input type="radio" name="ReadLang2" id="ReadMoyen2" value="ReadMoyen2" {ReadMoyen2Value} />
                       <label for="ReadMoyen2" >  {Moyen}</label><br />
                <input type="radio" name="ReadLang2" id="ReadUnderMoyen2" value="ReadUnderMoyen2" {ReadUnderMoyen2Value} />
                       <label for="ReadUnderMoyen2"> {UnderMoyen}</label> <br /></td>
            <td><input type="radio" name="WriteLang2" id="WriteLang2" value="WriteExcellent2" {WriteExcellent2Value} />
                       <label for="WriteLang2">{Excellent}</label><br />
                <input type="radio" name="WriteLang2" id="WriteGood2" value="WriteGood2" {WriteGood2Value} />
                       <label for="WriteGood2"> {Good}</label><br />
                <input type="radio" name="WriteLang2" id="WriteMoyen2" value="WriteMoyen2" {WriteMoyen2Value} />
                       <label for="WriteMoyen2"> {Moyen} </label><br />
                <input type="radio" name="WriteLang2" id="WriteUnderMoyen2" value="WriteUnderMoyen2" {WriteUnderMoyen2Value} />
                       <label for="WriteUnderMoyen2"> {UnderMoyen}</label></td>
            <td><input type="radio" name="SpeakLang2" id="SpeakExcellent2" value="SpeakExcellent2" {SpeakExcellent2Value} />
                       <label for="SpeakExcellent2">  {Excellent}</label><br />
                <input type="radio" name="SpeakLang2" id="SpeakGood2" value="SpeakGood2" {SpeakGood2Value} />
                       <label for="SpeakGood2">  {Good}</label><br />
                <input type="radio" name="SpeakLang2" id="SpeakMoyen2" value="SpeakMoyen2" {SpeakMoyen2Value} />
                       <label for="SpeakMoyen2">{Moyen}</label><br />
                <input type="radio" name="SpeakLang2" id="SpeakUnderMoyen2" value="SpeakUnderMoyen2" {SpeakUnderMoyen2Value} />
                       <label for="SpeakUnderMoyen2">{UnderMoyen}</label></td>
        </tr>

        <tr>
            <td>&nbsp;</td>
            <td><strong>{Read}</strong></td>
            <td><strong>{Write}</strong></td>
            <td><strong>{Speak}</strong></td>
        </tr>
        <tr>
            <td><strong>{LangName}<br />
                </strong>
                <input value="{LangName3Value}" type="text" class="text" name="LangName3" id="LangName3" />    </td>
            <td>
                <input type="radio" name="ReadLang3" id="ReadExcellent3" value="ReadExcellent3" {ReadExcellent3Value} />
                       <label for="ReadExcellent3">{Excellent}</label><br />
                <input type="radio" name="ReadLang3" id="ReadGood3" value="ReadGood3" {ReadGood3Value} />
                       <label for="ReadGood3">{Good}</label><br />
                <input type="radio" name="ReadLang3" id="ReadMoyen3" value="ReadMoyen3" {ReadMoyen3Value} />
                       <label for="ReadMoyen3">{Moyen}</label><br />
                <input type="radio" name="ReadLang3" id="ReadUnderMoyen3" value="ReadUnderMoyen3" {ReadUnderMoyen3Value} />
                       <label for="ReadUnderMoyen3"> {UnderMoyen}</label><br />
            </td>
            <td><input type="radio" name="WriteLang3" id="WriteExcellent3" value="WriteExcellent3" {WriteExcellent3Value} />
                       <label for="WriteExcellent3">{Excellent}</label><br />
                <input type="radio" name="WriteLang3" id="WriteGood3" value="WriteGood3" {WriteGood3Value} />
                       <label for="WriteGood3"> {Good}</label><br />
                <input type="radio" name="WriteLang3" id="WriteMoyen3" value="WriteMoyen3" {WriteMoyen3Value} />
                       <label for="WriteMoyen3">  {Moyen}</label><br />
                <input type="radio" name="WriteLang3" id="WriteUnderMoyen3" value="WriteUnderMoyen3" {WriteUnderMoyen3Value} />
                       <label for="WriteUnderMoyen3">  {UnderMoyen}</label>
            </td>
            <td><input type="radio" name="SpeakLang3" id="SpeakExcellent3" value="SpeakExcellent3" {SpeakExcellent3Value} />
                       <label for="SpeakExcellent3">  {Excellent}</label><br />
                <input type="radio" name="SpeakLang3" id="SpeakGood3" value="SpeakGood3" {SpeakGood3Value} />
                       <label for="SpeakGood3"> {Good}</label><br />
                <input type="radio" name="SpeakLang3" id="SpeakMoyen3" value="SpeakMoyen3" {SpeakMoyen3Value} />
                       <label for="SpeakMoyen3"> {Moyen}</label><br />
                <input type="radio" name="SpeakLang3" id="SpeakUnderMoyen3" value="SpeakUnderMoyen3" {SpeakUnderMoyen3Value} />
                       <label for="SpeakUnderMoyen3"> {UnderMoyen}</label>
            </td>
        </tr>
    </table>
    <p>{LevelInComputer} : 

        <input name="DontKnow" type="checkbox" id="DontKnow" {DontKnowValue} />

               <label for="DontKnow">   {DontKnow} </label>

               <input type="checkbox" name="Driver" id="Driver" {DriverValue} />

              <label for="Driver">  {Driver} </label>

               <input type="checkbox" name="Support" id="Support" {SupportValue} />

             <label for="Support">   {Support} </label>

               <input type="checkbox" name="Programer" id="Programer" {ProgramerValue} />

                  <label for="Programer">   {Programer}</label><br />
        {OtherExperience} : 

        <input name="OtherExperience" type="text" class="width-long" id="OtherExperience" value="{OtherExperienceValue}" size="50" maxlength="50" />

        <br />
    </p>
    <table border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td>{CompName}</td>
            <td>{ConctactMethode}</td>
            <td>{FromDate}</td>
            <td>{ToDate}</td>
            <td>{OldJob}</td>
            <td>{LastSalary}</td>
            <td>{WhyLeft}</td>
        </tr>
        <tr>
            <td>
                <input name="CompName1" type="text" class="text" id="CompName1" value="{CompName1Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="ConctactMethode1" type="text" class="text" id="ConctactMethode1" value="{ConctactMethode1Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="FromDate1" type="text" class="text" id="FromDate1" value="{FromDate1Value}" size="12" maxlength="12" />
            </td>
            <td>
                <input name="ToDate1" type="text" class="text" id="ToDate1" value="{ToDate1Value}" size="12" maxlength="12" />
            </td>
            <td>
                <input name="OldJob1" type="text" class="text" id="OldJob1" value="{OldJob1Value}" size="18" maxlength="35" />
            </td>
            <td>
                <input name="LastMonthSalary1" type="text" class="text" id="LastSalary1" value="{LastMonthSalary1Value}" size="10" maxlength="35" />
            </td>
            <td>
                <input name="WhyLeft1" type="text" class="text" id="WhyLeft1" value="{WhyLeft1Value}" size="10" maxlength="35" />
            </td>
        </tr>

        <tr>
            <td>
                <input name="CompName2" type="text" class="text" id="CompName2" value="{CompName2Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="ConctactMethode2" type="text" class="text" id="ConctactMethode2" value="{ConctactMethode2Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="FromDate2" type="text" class="text" id="FromDate2" value="{FromDate2Value}" size="12" maxlength="12" />
            </td>
            <td>
                <input name="ToDate2" type="text" class="text" id="ToDate2" value="{ToDate2Value}"  size="12" maxlength="12" />
            </td>
            <td>
                <input name="OldJob2" type="text" class="text" id="OldJob2" value="{OldJob2Value}" size="18" maxlength="35" />
            </td>
            <td>
                <input name="LastMonthSalary2" type="text" class="text" id="LastSalary2" value="{LastMonthSalary2Value}"  size="10" maxlength="35" />
            </td>
            <td>
                <input name="WhyLeft2" type="text" class="text" id="WhyLeft2" value="{WhyLeft2Value}" size="10" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="CompName3" type="text" class="text" id="CompName3" value="{CompName3Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="ConctactMethode3" type="text" class="text" id="ConctactMethode3" value="{ConctactMethode3Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="FromDate3" type="text" class="text" id="FromDate3" value="{FromDate3Value}" size="12" maxlength="12" />
            </td>
            <td>
                <input name="ToDate3" type="text" class="text" id="ToDate3" value="{ToDate3Value}"  size="12" maxlength="12" />
            </td>
            <td>
                <input name="OldJob3" type="text" class="text" id="OldJob3" value="{OldJob3Value}" size="18" maxlength="35" />
            </td>
            <td>
                <input name="LastMonthSalary3" type="text" class="text" id="LastSalary3" value="{LastMonthSalary3Value}"  size="10" maxlength="35" />
            </td>
            <td>
                <input name="WhyLeft3" type="text" class="text" id="WhyLeft3" value="{WhyLeft3Value}" size="10" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="CompName4" type="text" class="text" id="CompName4" value="{CompName4Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="ConctactMethode4" type="text" class="text" id="ConctactMethode4" value="{ConctactMethode4Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="FromDate4" type="text" class="text" id="FromDate4" value="{FromDate4Value}" size="12" maxlength="12" />
            </td>
            <td>
                <input name="ToDate4" type="text" class="text" id="ToDate4" value="{ToDate4Value}"  size="12" maxlength="12" />
            </td>
            <td>
                <input name="OldJob4" type="text" class="text" id="OldJob4" value="{OldJob4Value}" size="18" maxlength="35" />
            </td>
            <td>
                <input name="LastMonthSalary4" type="text" class="text" id="LastSalary4" value="{LastMonthSalary4Value}"  size="10" maxlength="35" />
            </td>
            <td>
                <input name="WhyLeft4" type="text" class="text" id="WhyLeft4" value="{WhyLeft4Value}" size="10" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="CompName5" type="text" class="text" id="CompName5" value="{CompName5Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="ConctactMethode5" type="text" class="text" id="ConctactMethode5" value="{ConctactMethode5Value}" size="15" maxlength="35" />
            </td>
            <td>
                <input name="FromDate5" type="text" class="text" id="FromDate5" value="{FromDate5Value}" size="12" maxlength="12" />
            </td>
            <td>
                <input name="ToDate5" type="text" class="text" id="ToDate5" value="{ToDate5Value}"  size="12" maxlength="12" />
            </td>
            <td>
                <input name="OldJob5" type="text" class="text" id="OldJob5" value="{OldJob5Value}" size="18" maxlength="35" />
            </td>
            <td>
                <input name="LastMonthSalary5" type="text" class="text" id="LastSalary5" value="{LastMonthSalary5Value}"  size="10" maxlength="35" />
            </td>
            <td>
                <input name="WhyLeft5" type="text" class="text" id="WhyLeft5" value="{WhyLeft5Value}" size="10" maxlength="35" />
            </td>
        </tr>
    </table>
    <table border="0" width="720px" cellspacing="1" cellpadding="1">
        <tr>
            <td>{MustExcutingInOldJobs} :</td>
            <td colspan="2"><input name="MustExcutingInOldJobs" type="text" class="width-long" id="MustExcutingInOldJobs" value="{MustExcutingInOldJobsValue}" size="75" maxlength="100" /></td>
        </tr>
        <tr>
            <td>{DiduDoAnotherJobsOverTime} ?</td>
            <td colspan="2"> 
                <input  type="radio" name="DiduDoAnotherJobsOverTime" id="DiduDoAnotherJobsOverTimeyes" value="yes" {DiduDoAnotherJobsOverTimeYesValue} />

                        <label for="DiduDoAnotherJobsOverTimeyes">    {Yes}</label>

                <input name="DiduDoAnotherJobsOverTime" type="radio" id="DiduDoAnotherJobsOverTimeno" value="no"  {DiduDoAnotherJobsOverTimeNoValue} />

                       <label for="DiduDoAnotherJobsOverTimeno"> {No}</label></td>
        </tr>
        <tr>
            <td>{DoYouRejectWorkOverTime} ?</td>
            <td colspan="2">
                <input type="radio" name="DoYouRejectWorkOverTime" id="DoYouRejectWorkOverTimeyes" value="yes" {DoYouRejectWorkOverTimeYesValue} />

                      <label for="DoYouRejectWorkOverTimeyes">   {Yes}</label>

                       <input name="DoYouRejectWorkOverTime" type="radio" id="DoYouRejectWorkOverTimeno" value="no"  {DoYouRejectWorkOverTimeNoValue} />

                       <label for="DoYouRejectWorkOverTimeno">  {No}</label></td>
        </tr>
        <tr>
            <td>{DoYouRejectCallingOldJob} ?
            </td>
            <td colspan="2">
                <input name="DoYouRejectCallingOldJob" type="text" class="text" id="DoYouRejectCallingOldJob" value="{DoYouRejectCallingOldJobValue}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>{HowDoYouHearAboutUs} ?</td>
            <td colspan="2">
                <input name="HowDoYouHearAboutUs" type="text" class="text" id="HowDoYouHearAboutUs" value="{HowDoYouHearAboutUsValue}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>{WhyYouWantToJoin} ?</td>
            <td colspan="2"><span id="sprytextfield15">

                    <input name="WhyYouWantToJoin" type="text" class="text" id="WhyYouWantToJoin" value="{WhyYouWantToJoinValue}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{WhatJobYouWish} ?</td>
            <td colspan="2"><span id="sprytextfield16">

                    <input name="WhatJobYouWich" type="text" class="text" id="WhatJobYouWich"  value="{WhatJobYouWichValue}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{WhenUCanStart} ?</td>
            <td colspan="2"><span id="sprytextfield17">

                    <input name="WhenUCanStart" type="text" class="text" id="WhenUCanStart" value="{WhenUCanStartValue}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{WishedSalary}:</td>
            <td colspan="2"><span id="sprytextfield18">

                    <input name="WishedSalary" type="text" class="text" id="WishedSalary" value="{WishedSalaryValue}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>{TalkAboutSkillsInThisJob}</td>
            <td colspan="2">
                <input  name="TalkAboutSkillsInThisJob" type="text" class="text" id="TalkAboutSkillsInThisJob" value="{TalkAboutSkillsInThisJobValue}" size="50" maxlength="35" /></td>
        </tr>
        <tr>
            <td>{DidYouSendUsAnCV} ?</td>
            <td colspan="2">
                <input   type="radio" name="DidYouSendUsAnCV" id="DidYouSendUsAnCVyes" value="yes" {DidYouSendUsAnCVYesValue} />
                        <label for="DidYouSendUsAnCVyes">  {Yes} </label>
                         <input  name="DidYouSendUsAnCV" type="radio" id="DidYouSendUsAnCVno" value="no" {DidYouSendUsAnCVNoValue}  />
                        <label for="DidYouSendUsAnCVno">  {No}</label> ({ifYesWriteCVNumberHereAndDate} : 
                         <input name="ifYesWriteCVNumberHere"  type="text" class="text" id="ifYesWriteCVNumberHere"  value="{ifYesWriteCVNumberHereValue}" maxlength="35" />
                )</td>
        </tr>
        <tr>
            <td>{DoYouHaveNearbyInTheCompany} ? </td>
            <td colspan="2">
                <input name="DoYouHaveNearbyInTheCompany" type="text" class="text" id="DoYouHaveNearbyInTheCompany" value="{DoYouHaveNearbyInTheCompanyValue}" size="50" maxlength="50" />
            </td>
        </tr>
        <tr>
            <td colspan="3"><br />
                {WriteThreeNamesUKnowFromOutsideTheCompany} :</td>
        </tr>
        <tr>
            <td>{OutName}</td>
            <td>{OutContact}</td>
            <td>{OutJobDesc}</td>
        </tr>
        <tr>
            <td><span id="sprytextfield19">

                    <input name="OutName1" type="text" class="text" id="OutName1" value="{OutName1Value}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td><span id="sprytextfield20">

                    <input name="OutContact1" type="text" class="text" id="OutContact1" value="{OutContact1Value}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
            <td><span id="sprytextfield21">

                    <input name="OutJobDesc1" type="text" class="text" id="OutJobDesc1"  value="{OutJobDesc1Value}" maxlength="35" />

                    <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span></td>
        </tr>
        <tr>
            <td>
                <input name="OutName2" type="text" class="text" id="OutName2" value="{OutName2Value}" maxlength="35" />
            </td>
            <td>
                <input name="OutContact2" type="text" class="text" id="OutContact2" value="{OutContact2Value}" maxlength="35" />
            </td>
            <td>
                <input name="OutJobDesc2" type="text" class="text" id="OutJobDesc2" value="{OutJobDesc2Value}" maxlength="35" />
            </td>
        </tr>
        <tr>
            <td>
                <input name="OutName3" type="text" class="text" id="OutName3" value="{OutName3Value}" maxlength="35" />
            </td>
            <td>
                <input name="OutContact3" type="text" class="text" id="OutContact3" value="{OutContact3Value}" maxlength="35" />
            </td>
            <td>
                <input name="OutJobDesc3" type="text" class="text" id="OutJobDesc3" value="{OutJobDesc3Value}" maxlength="35" />
            </td>
        </tr>
    </table>
    {YouPicture} :
    <?php
// Instanciation d'un nouvel objet "upload"
    $Upload = new Upload();
// Pour limiter la taille d'un fichier (exprim�e en ko)
    $Upload->MaxFilesize = '60';
// Pour ajouter des attributs aux champs de type file
    $Upload->FieldOptions = 'class="file"';
// Pour indiquer le nombre de champs d�sir�
    $Upload->Fields = 1;
// Initialisation du formulaire
    $Upload->InitForm();
// Affichage du champ MAX_FILE_SIZE
    print $Upload->Field[0];
// Affichage du premier champ de type FILE
    print $Upload->Field[1];
// Affichage du second champ de type FILE
//print $Upload-> Field[2];
    ?>
    {MaxImageSizeMustBe}<br />
    {PleaseEnterthisCVCode}  <img src="images/captcha.php"  alt="code" /> {InThisField} : <span id="sprytextfield22">
        <input name="CvCaptcha" type="text" id="CvCaptcha" size="5" maxlength="5" class="text" />
        <span class="textfieldRequiredMsg">{Avalueisrequired}</span></span><br/>
    <span id="sprycheckbox1">

        <input type="checkbox" name="TrueInfo" id="TrueInfo" {TrueInfoValue} />

               <span class="checkboxRequiredMsg">{Pleasemakeaselection}</span></span>{TrueInfo}<br />
    <p>

    <div align="center">
        <input type="submit" name="SendCvInfo" id="SendCvInfo" value="{submit}" />
    </div>
    <br />

    <br />


</p>
<script type="text/javascript">
    <!--
    var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
    //-->
</script>
</form>
<script type="text/javascript">
    <!--
    var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
    var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
    var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
    var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
    var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
    var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
    var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
    var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
    var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
    var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
    var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
    var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
    var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14", "email");
    var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
    var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
    var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17");
    var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
    var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
    var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20");
    var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21");
    var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
    var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22");
    //-->
</script>
