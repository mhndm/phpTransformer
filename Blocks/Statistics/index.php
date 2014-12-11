<?php
/***********************************************
*
*	Project: phpTransformer.com .
*	File Location :  .
*	File Name:  .
*	Date Created: 00-00-2007.
*	Last Modified: 00-00-2007.
*	Descriptions:	.
*	Changes:	.
*	TODO:	 .
****	Author: Mohsen Mousawi mhndm@phptransformer.com .
*
***********************************************/
?>
<?php if (!isset($project)){header("location: ../../");} ?>
<?php

global $NickName,$MembersTotalRecords;
?>
<span id="allMembers">
	<?php echo "&nbsp;". Members." : " . $MembersTotalRecords . " <br/> "; ?>
</span><hr style="width:100%;"/>
	<?php echo "<strong>". (LastMinuteOnline)."</strong><br/>". (MembersOnline)." : "; ?>
<span id="members"></span><br/>
	<?php echo " &nbsp;". (GuestsOnline)." : "; ?>
<span id="guests"></span><hr style="width:100%;"/>
<?php echo "<strong>". (NowOnline)."</strong><br/>&nbsp;"; ?>
<span id="Contries"></span>
<SPAN id="ststpic">
	<img width=32 height=16 src='Blocks/Statistics/images/indicator.gif' alt="..." />
</SPAN>

<?php
$Sdb = new db();
$Sq = $Sdb->get_row(" select * from `blocks` where `BlockName` = 'Statistics' ; ");
$Active = $Sq->Active;
if($Active!='0'){
    echo '<form name="curuserfrm" action="post"><input id="crntusr" type="hidden" value="'.$NickName.'" /></form>
        <script language="javascript" type="text/javascript" src="Blocks/Statistics/ajax.js"></script>
        <script language="javascript" type="text/javascript">
        stat_From_Server();
        </script>';
}
?>