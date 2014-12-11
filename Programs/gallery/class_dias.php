<?php

/*
  ###########################################################
  #                                                         #
  #  Class: Dias                                            #
  #  parameters for the initialization (2):                 #
  #     $images: array of images (relative path)            #
  #     $thumbs: array of thumbs (relative path)            #
  #  parameters for the output (3[+1]):                     #
  #     $columns: count of columns per line                 #
  #     $picturesW/picturesH: width and height of each dia-pictures     #
  #     $names: set true to write filenames below each dia  #
  #                                                         #
  #  Code by BladeX (ilja_m@gmx.de)                         #
  #  http://www.gwod.de.vu                                  #
  #                                                         #
  #  Using this class is for free, while you use it         #
  #  non-commercial!                                        #
  #                                                         #
  #  Removing this note is NOT allowed!                     #
  #                                                         #
  ###########################################################
  modified by mhndm
 */

class Dias {

    var $thumbs = array();
    var $images = array();
    var $color  ;
    
    // initialize the class with arrays-lists of images and thumbs
    function Dias($images, $thumbs,$color) {
        $this->images = $images;
        $this->thumbs = $thumbs;
        $this->color = $color;
    }

    // find images in given directory
    function getTemplate($tFile) {
        $content = "";
        $tpl = fopen($tFile, "r");
        if ($tpl) {
            while (!feof($tpl))
                $content .= fgets($tpl, 1024);
            fclose($tpl);
        }
        $content = addslashes($content);
        return $content;
    }

    // print the template (int cols-per-line, int picturesWidth, int picturesHeight, bool print-filenames)
    function output($columns, $picturesW, $picturesH, $names=false) {
        global $ThemeName, $TheNavBar, $FileInfo;
        $col = 1;
        $pictures = "";
        $template = "";
        $rows = "<div id=line >";
        $color = $this->color;
        if ($this->thumbs) {
            //var_dump($this->images);
            foreach ($this->thumbs as $key => $thumb) {
                $image = $this->images[$key];
                $FileInfo = InfoInDatabase($image);

                if ($FileInfo[0]['Caption'] != "") {
                    $picname = $FileInfo[0]['Caption']; //
                } else {
                    if (is_dir($image)) {
                        $picname = substr($image, strrpos($image, "/") + 1);
                    } else {
                        $DotPlace = strrpos($image, ".");
                        $picname = substr($image, strrpos($image, "/") + 1, -1 * (strlen($image) - $DotPlace));
                    }//end if
                }//end if
                $imageHREFComment = CreateLink('', array('Prog', 'add', 'galid', 'title'), array('gallery', 'cmnt', $FileInfo[0]['IdMedia'], str_replace(" ", "_", $picname)));
                //for foxview
                $imageHREF = $FileInfo[0]['Path'];

                //$PicCommentLink = $picname."&lt;br/&gt;&lt;a href='".$imageHREFComment."' /&gt; AddComment &lt;/a&gt;";
                //$PicCommentLink = $picname . "&lt;br&gt; &lt;a href='" . $imageHREFComment . "' &gt;" . GalleryaddComment . " ?&lt;/a&gt;";
                $PicAltText = $picname;
                $GalComment = GalComment;
                if ($names) {
                    if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/file_name.php")) {
                        eval("\$title = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/file_name.php") . "\";");
                    } else {
                        eval("\$title = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/file_name.php") . "\";");
                    }
                } else {
                    $title = "";
                }

                $ImageInfo = (getimagesize($thumb));
                $thumbW = $ImageInfo[0];
                $tW = round($ImageInfo[0]);
                $thumbH = $ImageInfo[1];
                $tH = round($ImageInfo[1]);


                $DotPlace = strrpos($image, ".");
                $ext = substr($image, -1 * (strlen($image) - $DotPlace - 1));
                $ext = strtolower($ext);
                if ($ext == 'jpg' OR $ext == 'gif' OR $ext == 'png' or $ext == 'jpeg') {
                    // images
                    if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/pictures.php")) {
                        eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/pictures.php") . "\";");
                    } else {
                        eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/pictures.php") . "\";");
                    }
                } else {
                    if (is_dir($image)) {
                        // album
                        $AlbumDirLink = CreateLink('', array('Prog', 'show', 'galid', 'title'), array('gallery', 'all', $FileInfo[0]['IdMedia'], str_replace(" ", "_", $picname)));

                        $files = glob($FileInfo[0]['Path'] . "/thumbs/" . "/*.{jpg,gif,png,bmp,jpeg,JPG,GIF,PNG,BMP,JPEG}", GLOB_BRACE);
                        // var_dump($files);
                        if ($files) {

                            if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/album.php")) {
                                eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/album-frame.php") . "\";");
                            } else {
                                eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/album-frame.php") . "\";");
                            }
                        } else {

                            if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/album.php")) {
                                eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/album.php") . "\";");
                            } else {
                                eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/album.php") . "\";");
                            }
                        }
                    } elseif ($ext == 'youtube' ) {
                          //videos
                        $AlbumDirLink = CreateLink('', array('Prog', 'show', 'galid', 'title', 'NoThm'), array('gallery', 'all', $FileInfo[0]['IdMedia'], str_replace(" ", "_", $picname), '1'));
                        if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/files.php")) {
                            eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/youtube.php") . "\";");
                        } else {
                            eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/youtube.php") . "\";");
                        }
                    }else{
                        //documents 
                        $AlbumDirLink = CreateLink('', array('Prog', 'show', 'galid', 'title', 'NoThm'), array('gallery', 'all', $FileInfo[0]['IdMedia'], str_replace(" ", "_", $picname), '1'));
                        if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/files.php")) {
                            eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/files.php") . "\";");
                        } else {
                            eval("\$pictures = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/files.php") . "\";");
                        }
                    }
                }//end if

                $rows .= $pictures . "\n";
                if ($col % $columns == 0)
                    $rows .= "</div><div id=line >";
                $col++;
            }
        }//end if
        $col--;
        $rest = $col % $columns;
        if ($rest != 0) {
            //for($i = $rest+1; $i <= $columns; $i++) $rows .= "<td>&nbsp;</td>\n";
        }
        $rows .= "</div>";
        if (is_file("Programs/gallery/Themes/" . $ThemeName . "/templates/gallery_container.php")) {
            eval("\$template = \"" . $this->getTemplate("Programs/gallery/Themes/" . $ThemeName . "/templates/gallery_container.php") . "\";");
        } else {
            eval("\$template = \"" . $this->getTemplate("Programs/gallery/Themes/Default/templates/gallery_container.php") . "\";");
        }
        //headers::send();
        $template = stripslashes($template);
        print($template);
    }

}

?>