<?php
$usr_cp_link = CreateLink("", array('Prog','cpc'), array('usercp','ginfo'));

?>
{Welcome} <br/> {UserName} {FamName} <br/><a href='{SignOutLink}'>{SignOut}</a><br/>
<a href="<?php echo $usr_cp_link ?>" ><span id="UserPic"><img alt="" src="{UserPic}"/></span> </a><br/>{YourLastLoginInDate}<br/>{LastLogin}
<br /><a href="{UserControlPanelLink}" title="{UserControlPanel}">{UserControlPanel}</a>
<br /><a href="{AdminControlPanelLink}" title="{AdminControlPanel}">{AdminControlPanel}</a>