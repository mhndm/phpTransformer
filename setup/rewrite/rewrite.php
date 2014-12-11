<?
$filename = "rew";
if (is_file($filename)){
	if(!unlink($filename)){echo "access denied";}
}
$TheHandle = fopen($filename, 'w') or die('access denied');
fwrite($TheHandle, "Mod rewrite is enabled");
fclose($TheHandle);

?>