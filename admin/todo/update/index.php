<?php
/*

  Project: phpTransformer.com .
  File Location :  .
  File Name:  .
  Date Created: 00-00-2007.
  Last Modified: 00-00-2007.
  Descriptions: .
  Changes: .
  TODO:  .
     Author: Mohsen Mousawi mhndm@phptransformer.com .

 */
?>
<?php  if (!isset($IsAdmin)){header("location: ../../../");} ?>
<?php
global $UpdateServiceUrl;

if(count($_POST)){
    if(isset($_POST['chekUpdate'])){
        require_once('GetAllUpdates.php');
        $Update .= ChekForUpdate();
    }else{
        require_once('DoUpdate.php');
    }
}
else{

    require_once('UpdateList.php');
}

?>
