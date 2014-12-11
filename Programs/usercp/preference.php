<?php global $TitlePage;  $TitlePage .= ' .:. '. (preferenceInfo) ;?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td> <?php echo  (PrefLang) ?> :  </td>
    <td><?php global $PrefLang; echo $PrefLang ?></td>
    <td><a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","PrefLang"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (PrefLang) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (CookieLife) ?> : </td>
    <td><?php global $CookieLife; echo $CookieLife . '&nbsp;' .  (second)  . ' &nbsp; '?></td>
    <td><a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","CkieLife"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (CookieLife) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (PrefThem) ?> : </td>
    <td><?php global $PrefThem; echo $PrefThem ?></td>
    <td>
    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","PrefThem"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (PrefThem) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		
       </a>&nbsp;</td>
  </tr>
</table>
