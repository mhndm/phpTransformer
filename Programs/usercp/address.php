<?php global $TitlePage; $TitlePage .= ' .:. '. (addressInfo) ; ?>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (Contry) ?> : </td>
    <td><?php global $Contry; echo ' <img src="images/flags/'. strtolower($Contry) . '.png" />' ; ?> &nbsp;</td>
    <td>    	
    	<a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","Contry"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (Contry) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (town) ?> : </td>
    <td><?php global $town; echo $town ?> &nbsp;</td>
    <td>    	
    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","town"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (town) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>
        &nbsp;
        </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (Rue) ?> : </td>
    <td><?php global $Rue; echo $Rue ?> &nbsp;</td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","Rue"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (Rue) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (AddDetails) ?> : </td>
    <td><?php global $AddDetails; echo $AddDetails ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","AddDetails"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (AddDetails) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (CodePostal) ?> : </td>
    <td><?php global $CodePostal; echo $CodePostal ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","CodePostal"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (CodePostal) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo  (ZipCode) ?> : </td>
    <td><?php global $ZipCode; echo $ZipCode ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","ZipCode"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (ZipCode) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> <?php echo  (PrefTime) ?> : </td>
    <td><?php global $PrefTime; echo $PrefTime ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","PrefTime"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (PrefTime) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> <?php echo  (Gmt) ?> : </td>
    <td><?php global $Gmt; echo $Gmt ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","Gmt"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (Gmt) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> <?php echo  (PhoneNbr) ?> : </td>
    <td><?php global $PhoneNbr; echo $PhoneNbr ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","PhoneNbr"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (PhoneNbr) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> <?php echo  (CellNbr) ?> : </td>
    <td><?php global $CellNbr; echo $CellNbr ?></td>
    <td>    <a href="<?php $Vars=array("Prog","edtusr");  $Vals=array("usercp","CellNbr"); echo CreateLink('',$Vars,$Vals); ?>" title="<?php echo   (edit) ." ".  (CellNbr) ?>" >
	    <img src="Programs/usercp/images/miniedit.gif" alt="edit" width="18" height="18" border="0">   		</a>&nbsp;</td>
  </tr>
</table>
