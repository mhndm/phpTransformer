<?php

/*
#############################################################
#                                                           #
#  Class: Thumbs                                            #
#  parameters for the initialization (2):                   #
#     $dir: relative path to the pictures                   #
#     $tPrefix: will be set infront of each thumb-filename  #
#     $maxW: max. width of the thumbs (no matter if fix=2)  #
#     $maxH: max. height of the thumbs (no matter if fix=1) #
#     $fix: primary size-limit: 1=width, 2=height, 0=both   #
#                                                           #
#  Code by BladeX (ilja_m@gmx.de)                           #
#  http://www.gwod.de.vu                                    #
#                                                           #
#  Using this class is for free, while you use it           #
#  non-commercial!                                          #
#                                                           #
#  Removing this note is NOT allowed!                       #
#                                                           #
#############################################################
  modified by mhndm
*/


class Thumbs {
    var $dir = "";
    var $thumbDir = "";
    var $tPrefix = "";
    var $maxH = 0;
    var $maxW = 0;
    var $fix = 0;

    // initialize the class
    function Thumbs($dir, $tPrefix = "", $maxW = 150, $maxH = 150, $fix = 0) {
        if(substr($dir, -1) == "/") $dir = substr($dir, 0, -1);
        $this->dir = $dir;
        $this->tPrefix = $tPrefix;
        $this->thumbDir = $dir."/thumbs";
        $this->maxH = $maxH;
        $this->maxW = $maxW;
        $this->fix = $fix;

        if(!file_exists($this->dir)) die("path \"".$this->dir."\" doesn't exist! please set the right path to your picture folder.");
        if(!file_exists($this->thumbDir)) {
            mkdir($this->thumbDir);
            //die("path \"".$this->thumbDir."\" doesn't exist! please create the subdir \"/thumbs\" in your picture folder.");
        }
        if(!is_writable($this->thumbDir)) die("path \"".$this->thumbDir."\" has no write rights! please set the rights to 777 via CHMOD first...");
    }

    // find images in given directory
    function getImageNames() {
        $files = false;
        if($resDir = opendir($this->dir)) {
            // check all files in $dir - add images to array 'files'
            $cpos = 0;
            while($file = readdir($resDir)) {
                if($file[0] != "_" && $file != "." && $file != ".." and $file != 'Thumbs.db') {
                    //$ext = substr($file, -3);
                    //	$ext = strtolower($ext);
                    //if($ext == 'jpg' OR $ext == 'gif' OR $ext == 'png' and $ext != 'db' and $ext != 'tml' and $ext != 'htm' and $ext != 'php' and $ext != 'tmb') {
                    $files[$cpos] = $file;
                    $cpos++;
                    //}
                }
            }
            closedir($resDir);
        }
        if($files) sort($files);
        return $files;
    }

    // check whether a thumb was allready created
    function checkThumb($image) {
        $thumbFile = $this->thumbDir."/".$this->tPrefix.$image;
        if(file_exists($thumbFile)) {
            list($srcW, $srcH, $srcType, $html_attr) = getimagesize($thumbFile);
           // var_dump($srcType,$html_attr);
            if($this->fix == 1) {
                if($this->maxW != $srcW) {
                    return false;
                }
            } elseif($this->fix == 2) {
                if($this->maxH != $srcH) {
                    return false;
                }
            } else {
                if($srcH > $this->maxH and $srcW > $this->maxW ) {
                    return false;
                }
            }
            //echo "thumb of $image exists<br>";
            return true;
        } else {
            //echo "thumb of $image doesn't exist!!!<br>";
            return false;
        }
    }

    // create a new thumb to given image
    function createThumb($image) {
        $srcFile = $this->dir."/".$image;
        list($srcW, $srcH, $srcType, $html_attr) = getimagesize($srcFile);
        $ext = substr($image, -3);
        $ext = strtolower($ext);
        if($ext == 'jpg' or  $ext == 'jpeg') {
            $srcImage = @imagecreatefromjpeg($srcFile);
        } elseif($ext == 'gif') {
            $srcImage = @imagecreatefromgif($srcFile);
        } elseif($ext == 'png') {
            $srcImage = @imagecreatefrompng($srcFile);
        }

        if(!$srcImage) return false;
        //$srcW = imagesx($srcImage);
        //$srcH = imagesy($srcImage);
        if($this->fix == 0) {
            if($srcW / $this->maxW > $srcH / $this->maxH) {
                $factor = $this->maxW / $srcW;
            } else {
                $factor = $this->maxH / $srcH;
            }
        } elseif($this->fix == 1) {
            $factor = $this->maxW / $srcW;
        } elseif($this->fix == 2) {
            $factor = $this->maxH / $srcH;
        }
        $newH = (int) round($srcH * $factor);
        $newW = (int) round($srcW * $factor);

        $newImage = imagecreatetruecolor($newW, $newH);
        imagecopyresampled($newImage,$srcImage,0,0,0,0,$newW,$newH,$srcW,$srcH);
        $newFile = $this->thumbDir."/".$this->tPrefix.$image;
        imagejpeg($newImage, $newFile, "85");
        return true;
    }

    // collect all images, creates thumbs and return all as an array: return[0] = images_array, return[1] = thumbs_array
    function getImages() {
        if(function_exists('set_time_limit')) {
            @set_time_limit(300);
        }
        $images = "";
        $thumbs = "";
        $cpos = 0;
        $imageList = $this->getImageNames();

        foreach($imageList as $file) {


            if($this->InDatabase($this->dir."/".$file)) {
                $thumb = false;
                $DotPlace = strrpos($file, ".");
                $ext = substr($file, -1*(strlen($file) - $DotPlace -1));
                $ext = strtolower($ext);

                //var_dump($this->InfoInDatabase($this->dir."/".$file)).'<br/>';

                if($ext == 'jpg' OR $ext == 'gif' OR $ext == 'png' OR $ext == 'jpeg') {//images

                    $thumb = $this->checkThumb($file);
                   // var_dump($thumb);
                    if(!$thumb) {
                        $thumb = $this->createThumb($file);
                        //if(!$thumb) echo "$image is not a valid image<br>";
                    }
                    if($thumb) {
                        $images[$cpos] = $this->dir."/".$file;
                        $thumbs[$cpos] = $this->thumbDir."/".$this->tPrefix.$file;
                        $cpos++;
                    }
                }
                elseif($ext != 'db' and $ext != 'tml' and $ext != 'htm' and $ext != 'php' and $ext != 'tmb' and $file!='thumbs') { //other file types
                    if(is_dir($this->dir . "/" . $file)) {
                        // Album case
                         $images[$cpos] = $this->dir . "/" . $file;
                        if(is_file($this->dir . "/" . $file.'/thumb.tmb')) {
                            // this album have its own thumbnail
                           $thumbs[$cpos] = $this->dir . "/" . $file.'/thumb.tmb';
                        }
                        else {
                            // this album dont have a thumbnail
                            $files = glob($this->dir . "/" . $file."/thumbs/*.{jpg,gif,png,bmp,jpeg,JPG,GIF,PNG,BMP,JPEG}", GLOB_BRACE);
                           // var_dump($files);
                            if($files){
                                $thumbs[$cpos] = $files[0];
                            }else{
                                $thumbs[$cpos] = 'Programs/gallery/images/album.png';
                            }
   
                        }//end if
                    }
                    else {
                        // File case
                        if(is_file($this->thumbDir.'/'.$file.'.png')) {
                            // this file already have thambnail
                            $images[$cpos] = $this->dir."/".$file;
                            $thumbs[$cpos] = $this->thumbDir.'/'.$file.'.png';//'Programs/gallery/watermark.php?original='.$original.'&watermark='.$watermark.'&target='.$target;
                        }
                        elseif(is_file($this->thumbDir.'/'.$file.'.png')) {
                            // we well create  a new thaumbnail with Watermark
                            $original   = $this->thumbDir.'/'.$file.'.png';
                            $watermark  = 'Programs/gallery/images/w_'.getFileType($ext).'.png';
                            $target 	= $this->thumbDir.'/'.$file.'.png' ;
                            Watermark($original,$watermark, $target);
                            $images[$cpos] = $this->dir."/".$file;
                            $thumbs[$cpos] = $this->thumbDir.'/'.$file.'.png';
                        }
                        else {
                            //this file dont have any thambail , we well use icon for its own file type
                            $images[$cpos] = $this->dir."/".$file;
                            $thumbs[$cpos] = 'Programs/gallery/images/'.getFileType($ext).'.png';
                        }//end if
                    }//end if
                    $cpos++;
                }//End if
            }//end if
        }//end foreach

        return array($images, $thumbs);
    }

    // rebuild ALL thumbs - may be usefull for Admins, if the content of an image has changed
    function rebuildThumbs() {
        if(function_exists('set_time_limit')) {
            @set_time_limit(300);
        }
        $imageList = $this->getImageNames();
        foreach($imageList as $image) {
            $this->createThumb($image);
        }
    }//end function

    /*****************************************/
    function InDatabase($Path) {
        global $Lang;
        $IdMedia = null;
        $i=0;
        if($Path) {
            $db = new db();
            $IdMedia = $db->get_var("SELECT `IdMedia` FROM `gallery` where `Path`='".$Path."' and `visible`=1;");
            if($IdMedia) {
                return true;
            }
            else {
                return false;
            }//end if
        }
        else {
            return false;
        }//end if
    }//end function


    /*****************************************/



}//End class

?>