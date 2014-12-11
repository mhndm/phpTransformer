<div class="std_line">
    <div class="line_type" style="color:#89233D;width: 280px;">{LoginNotes}</div>
    <div class="line_value">
    </div>
</div>
<form method="post">
    <div class="std_line">
        <div class="line_type">{UserName} :</div>
        <div class="line_value">
            <input name="InputNickName" type="text" size="12" maxlength="35" class="text" />
        </div>
    </div>
    <div class="std_line">
        <div class="line_type">{Password} :</div>
        <div class="line_value">
            <input name="InputPassword" type="password" size="12" maxlength="35" class="password" />
        </div>
    </div>
    <div class="std_line">
        <div class="line_type">{RememberMeFor}</div>
        <div class="line_value">
            <select name="Remember" class="select">
                <option value="Year">{Year}</option>
                <option value="Month" selected="selected">{Month}</option>
                <option value="Week">{Week}</option>
                <option value="Day">{Day}</option>
                <option value="NeverRemember">{NeverRemember}</option>
            </select>
        </div>

    </div>
 
        <button name="SubmitAccount" type="submit" >&nbsp;&nbsp;{submit}&nbsp;&nbsp;</button>  
    
</form>
<a href="{ForgetLink}">{ForgetPassword}</a><br />
{NewUserRegister}<br />
{LoginCommenttext}