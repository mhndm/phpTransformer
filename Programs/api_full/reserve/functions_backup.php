<?php
function create_news_thumbs( $pathToImages, $pathToThumbs, $thumbWidth,$thumbHeight = -1)
{
  // open the directory
  //$dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  //while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages);
    $img_ext = strtolower($info['extension']);
    // continue only if this is a JPEG image
    if ($img_ext == 'gif') {
        $imgt = "ImageGIF";
        $imgcreatefrom = "ImageCreateFromGIF";
        $quality = -1;
    }
    if ($img_ext == 'jpg' || $img_ext == 'jpeg') {
        $imgt = "ImageJPEG";
        $imgcreatefrom = "ImageCreateFromJPEG";
        $quality = 90;
    }
    if ($img_ext == 'png') {
        $imgt = "ImagePNG";
        $imgcreatefrom = "ImageCreateFromPNG";
        $quality = 9;
        $filter = PNG_NO_FILTER;
    }
    
    if(isset($imgt) && $imgt)
    {
      // load image and get image size
      $img = $imgcreatefrom("{$pathToImages}");
      $width = imagesx($img);
      $height = imagesy($img);

      // calculate thumbnail size
      
      if($thumbHeight == -1)
      {
            if($width <= $thumbWidth)
            {
                $new_width = $width;
                $new_height = floor( $height * ( $thumbWidth / $width ) );
                if($height <= $new_height)
                    $new_height = $height;
            }
            else
            {
                $new_width = $thumbWidth;
                $new_height = floor( $height * ( $thumbWidth / $width ) );
            }
      }
      
    else
        {
            if($width <= $thumbWidth && $height <= $height)
                {
                    $new_width = $width;
                    $new_height = $height;
                }
            else if ($width > $height)
                    {
                        $new_width = $thumbWidth;
                        $new_height = intval($height * $new_width / $width);
                    }
            else
                {
                    $new_height = $thumbHeight;
                    $new_width = intval($width * $new_height / $height);
                }
        }
      
    
      //$new_width = $thumbWidth;
      //$new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );
        
      if($quality == -1)
        {
            $black = imagecolorallocate($tmp_img, 0, 0, 0);
            imagecolortransparent($tmp_img, $black);
        }
        
    if(isset($filter) || $quality == -1)
        {
            imagealphablending( $tmp_img, false );
            imagesavealpha( $tmp_img, true );
        }
      
      // copy and resize old image into new image
      imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

      // save thumbnail into a file
      if($quality == -1)
        $imgt( $tmp_img, "{$pathToThumbs}");
      else
        {
            if(isset($filter))
                {
                    $imgt( $tmp_img, "{$pathToThumbs}",$quality,$filter);
                }
            else
                $imgt( $tmp_img, "{$pathToThumbs}",$quality);
        }
    }
  // close the directory
  //closedir( $dir );
}
?>