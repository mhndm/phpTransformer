<?php

function Watermark($original, $watermark, $target) {
    /*
      $watermark	= 'watermarks/Sample-trans.png';
      $original 	= 'waleed_ak1.jpg';
      $original 	= 'networking.png';
      //$original 	= 'security_shield_h3.gif';

      echo ' original : '. $original . '<br/> watermark: '. $watermark . '<br/> target: '. $target .' <br/>';
     */
    $edgePadding = 15; // used when placing the watermark near an edge
    $quality = 90; // used when generating the final image for jpg

    $v_position = 'top';
    $h_position = 'left';
    //$wm_size='larger';
    //$wm_size='0.5'; // half watermark size
    $wm_size = '0.25'; //same watermark size
    // file upload success
    $size = getimagesize($original);

    if ($size[2] == 1 || $size[2] == 2 || $size[2] == 3) {
        // it was a JPEG or PNG image, so we're OK so far
        // $original=$watermark;
        /*
          $target_name=date('YmdHis').'_'.
          // if you change this regex, be sure to change it in generated-images.php:26
          preg_replace('`[^a-z0-9-_.]`i','',$original);
          $target=dirname(__FILE__).'/results/'.$target_name;

         */
        //$watermark=$watermarkee;
        $wmTarget = $watermark . '.tmp';

        $origInfo = getimagesize($original);
        $origWidth = $origInfo[0];
        $origHeight = $origInfo[1];

        $waterMarkInfo = getimagesize($watermark);
        $waterMarkWidth = $waterMarkInfo[0];
        $waterMarkHeight = $waterMarkInfo[1];

        // watermark sizing info
        if ($wm_size == 'larger') {
            $placementX = 0;
            $placementY = 0;
            $h_position = 'left';
            $v_position = 'top';
            $waterMarkDestWidth = $waterMarkWidth;
            $waterMarkDestHeight = $waterMarkHeight;

            // both of the watermark dimensions need to be 5% more than the original image...
            // adjust width first.
            if ($waterMarkWidth > $origWidth * 1.05 && $waterMarkHeight > $origHeight * 1.05) {
                // both are already larger than the original by at least 5%...
                // we need to make the watermark *smaller* for this one.
                // where is the largest difference?
                $wdiff = $waterMarkDestWidth - $origWidth;
                $hdiff = $waterMarkDestHeight - $origHeight;
                if ($wdiff > $hdiff) {
                    // the width has the largest difference - get percentage
                    $sizer = ($wdiff / $waterMarkDestWidth) - 0.05;
                } else {
                    $sizer = ($hdiff / $waterMarkDestHeight) - 0.05;
                }
                $waterMarkDestWidth-=$waterMarkDestWidth * $sizer;
                $waterMarkDestHeight-=$waterMarkDestHeight * $sizer;
            } else {
                // the watermark will need to be enlarged for this one
                // where is the largest difference?
                $wdiff = $origWidth - $waterMarkDestWidth;
                $hdiff = $origHeight - $waterMarkDestHeight;
                if ($wdiff > $hdiff) {
                    // the width has the largest difference - get percentage
                    $sizer = ($wdiff / $waterMarkDestWidth) + 0.05;
                } else {
                    $sizer = ($hdiff / $waterMarkDestHeight) + 0.05;
                }
                $waterMarkDestWidth+=$waterMarkDestWidth * $sizer;
                $waterMarkDestHeight+=$waterMarkDestHeight * $sizer;
            }
        } else {
            $waterMarkDestWidth = round($origWidth * floatval($wm_size));
            $waterMarkDestHeight = round($origHeight * floatval($wm_size));
            if ($wm_size == 1) {
                $waterMarkDestWidth-=2 * $edgePadding;
                $waterMarkDestHeight-=2 * $edgePadding;
            }
        }

        // OK, we have what size we want the watermark to be, time to scale the watermark image
        resize_png_image($watermark, $waterMarkDestWidth, $waterMarkDestHeight, $wmTarget);

        // get the size info for this watermark.
        $wmInfo = getimagesize($wmTarget);
        $waterMarkDestWidth = $wmInfo[0];
        $waterMarkDestHeight = $wmInfo[1];

        $differenceX = $origWidth - $waterMarkDestWidth;
        $differenceY = $origHeight - $waterMarkDestHeight;

        // where to place the watermark?
        switch ($h_position) {
            // find the X coord for placement
            case 'left':
                $placementX = $edgePadding;
                break;
            case 'center':
                $placementX = round($differenceX / 2);
                break;
            case 'right':
                $placementX = $origWidth - $waterMarkDestWidth - $edgePadding;
                break;
        }

        switch ($v_position) {
            // find the Y coord for placement
            case 'top':
                $placementY = $edgePadding;
                break;
            case 'center':
                $placementY = round($differenceY / 2);
                break;
            case 'bottom':
                $placementY = $origHeight - $waterMarkDestHeight - $edgePadding;
                break;
        }

        if ($size[2] == 3)
            $resultImage = imagecreatefrompng($original);
        elseif ($size[2] == 2)
            $resultImage = imagecreatefromjpeg($original);
        elseif ($size[2] == 1)
            $resultImage = imagecreatefromgif($original);

        imagealphablending($resultImage, TRUE);

        $finalWaterMarkImage = imagecreatefrompng($wmTarget);
        $finalWaterMarkWidth = imagesx($finalWaterMarkImage);
        $finalWaterMarkHeight = imagesy($finalWaterMarkImage);

        imagecopy($resultImage, $finalWaterMarkImage, $placementX, $placementY, 0, 0, $finalWaterMarkWidth, $finalWaterMarkHeight
        );

        if ($size[2] == 3) {
            imagealphablending($resultImage, FALSE);
            imagesavealpha($resultImage, TRUE);
            imagepng($resultImage, $target);
        } elseif ($size[2] == 2) {
            imagejpeg($resultImage, $target, $quality);
        } elseif ($size[2] == 1) {
            imagegif($resultImage, $target, $quality);
        }

        imagedestroy($resultImage);
        imagedestroy($finalWaterMarkImage);

        // display resulting image for download

        @unlink($wmTarget);
    }
}

//end function

function resize_png_image($img, $newWidth, $newHeight, $target) {
    $srcImage = imagecreatefrompng($img);
    if ($srcImage == '') {
        return FALSE;
    }
    $srcWidth = imagesx($srcImage);
    $srcHeight = imagesy($srcImage);
    $percentage = (double) $newWidth / $srcWidth;
    $destHeight = round($srcHeight * $percentage) + 1;
    $destWidth = round($srcWidth * $percentage) + 1;
    if ($destHeight > $newHeight) {
        // if the width produces a height bigger than we want, calculate based on height
        $percentage = (double) $newHeight / $srcHeight;
        $destHeight = round($srcHeight * $percentage) + 1;
        $destWidth = round($srcWidth * $percentage) + 1;
    }
    $destImage = imagecreatetruecolor($destWidth - 1, $destHeight - 1);
    if (!imagealphablending($destImage, FALSE)) {
        return FALSE;
    }
    if (!imagesavealpha($destImage, TRUE)) {
        return FALSE;
    }
    if (!imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight)) {
        return FALSE;
    }
    if (!imagepng($destImage, $target)) {
        return FALSE;
    }
    imagedestroy($destImage);
    imagedestroy($srcImage);
    return TRUE;
}

//end function
?>