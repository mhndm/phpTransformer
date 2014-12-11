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
<?php if (!isset($project)){header("location: ");} ?>
<?php

// MainMenu  Account Statistics Ads Search
/*
SqlConnect();
ExcuteQuery("SELECT * FROM `blocks` WHERE (`MainSec`='S' and `Deleted`<>'1') order by `Order` ASC;");
*/

$SCdb = new db();
$Blocksdb = $SCdb->get_results("SELECT * FROM `blocks` WHERE (`MainSec`='S' and `Deleted`<>'1') order by `Order` ASC;");
	//echo $TotalRecords."<br>";
	if ($Blocksdb){
			foreach ( $Blocksdb as $Blockrow ){
				//$BlockName  = $Rows['BlockName'];
				//echo $BlockName.' ';
				/*
				$Active		= $Rows['Active'];
				$View		= $Rows['View'];
				$MainSec	= $Rows['MainSec'];
				$Order		= $Rows['Order'];
				$ObjectId 	= $Rows['ObjectId'];
				$License 	= $Rows['License'];
				*/
				$BlockName	= $Blockrow->BlockName;
				$Active		= $Blockrow->Active;
				$View		= $Blockrow->View;
				$MainSec	= $Blockrow->MainSec;
				$Order		= $Blockrow->Order;
				$ObjectId 	= $Blockrow->ObjectId;
				$License 	= $Blockrow->License;
				
				$ObjectName = "block".$BlockName;
					//if(!ValidLicense($License,$ObjectName)){
					//	$Block ="";
					//}
					//else{
						if($Active and ContPermission($GroupId,$ObjectId)){
							//load lang filename
							//ECHO $DefaultLang;
                                                        if(file_exists("Blocks/$BlockName/Languages/lang-$Lang.pt.php")){
                                                            $BlockLang="Blocks/$BlockName/Languages/lang-$Lang.pt.php";//custom translation
                                                        }
                                                        else{
                                                            $BlockLang="Blocks/$BlockName/Languages/lang-$Lang.php";
                                                        }
							if (is_file($BlockLang)){$Block=include_once("$BlockLang");}
							//BlockTitle						
							// main menu exception theme
							if($BlockName!="MainMenu"){
								//load them block
								$BlockThemFile="Blocks/$BlockName/Themes/$ThemeName/Theme.php";
								if (is_file($BlockThemFile)){
									$BlockThemFile=get_include_contents("$BlockThemFile");
								}
								else{
									$BlockThemFile="Themes/$ThemeName/Block.php";
									$BlockThemFile=get_include_contents("$BlockThemFile");
								}
							}
							else{
								/* to add theme for menu and menu items, we create file in the block theme file index.php contenu {BlockContenu}  */
								//$BlockThemFile="{BlockContenu}";
								$BlockThemFile="Blocks/$BlockName/Themes/$ThemeName/index.php";
								if (is_file($BlockThemFile)){
									$BlockThemFile=get_include_contents("$BlockThemFile");
								}
								else{
									$BlockThemFile="{BlockContenu}";
								}
							}//endif 	
							
							// load block file
							$Blockfile="Blocks/".$BlockName."/index.php";
							if (is_file($Blockfile)){
								$BlockContenu=get_include_contents("$Blockfile");
							}
							//get id of language
							/*
							$Query="SELECT `IdLang` FROM `languages` WHERE `LangName`='".$Lang."'";
							$Records= mysqli_query($conn,$Query);//  ;	
							$TotalRec = mysqli_num_rows($Records);
							$Rs = mysqli_fetch_assoc($Records);
							if ($TotalRec>0){
								$idLang=$Rs['IdLang'];
							}
							*/
							$LangDB = new db();
							$idLang = $LangDB->get_var("SELECT `IdLang` FROM `languages` WHERE `LangName`='".$Lang."'");
							
							//mysqli_free_result($Records);
							//replace BlockTitle and theme name
							/*
							$Query="SELECT * FROM `blocklang` WHERE `BlockName`='".$BlockName."' and `idLang`=".$idLang.";";						
							$Records= mysqli_query($conn,$Query);//  ;	
							$TotalRec = mysqli_num_rows($Records);
							$Rs = mysqli_fetch_assoc($Records);
							*/
							$BlockTitledb = new db();
							$BlockTitlerow = $BlockTitledb->get_row("SELECT * FROM `blocklang` WHERE `BlockName`='".$BlockName."' and `idLang`=".$idLang.";");
							
							if ($BlockTitlerow){
								$BlockTitle	= $BlockTitlerow->BlockTitle;
								$BlockThemFile= VarTheme("{BlockTitle}",$BlockTitle,$BlockThemFile);
							}
							else{
								//$BlockTitle= (" ");
								$BlockThemFile= VarTheme("{BlockTitle}","&nbsp;&nbsp;&nbsp;",$BlockThemFile);
							}
							//mysqli_free_result($Records);
							$BlockThemFile= VarTheme("{ThemeName}",$ThemeName,$BlockThemFile);
							//replace contenu
							$BlockThemFile= VarTheme("{BlockContenu}",$BlockContenu,$BlockThemFile);
							$Block=$BlockThemFile;
						}
						else{
                                                        $Block="";	
						}
					//}//end if
				if (isset($SecCont)){	
					$SecCont.=$Block; // get all SEC containers	
				}
				else{
					$SecCont=$Block; // get first containers	
				}
				//$Rows = mysqli_fetch_assoc($Recordset);	
			}//end for
	}//end if
//closeQuery();

?>