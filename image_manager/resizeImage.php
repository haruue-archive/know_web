<?php
function resizeImage($im,$maxwidth,$maxheight,$name,$filetype) {
    $pic_width = imagesx($im);
    $pic_height = imagesy($im);
    
    if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)) {
        if($maxwidth && $pic_width>$maxwidth) {
            $widthratio = $maxwidth/$pic_width;
            $resizewidth_tag = true;
        }
    
        if($maxheight && $pic_height>$maxheight) {
            $heightratio = $maxheight/$pic_height;
            $resizeheight_tag = true;
        }
    
        if($resizewidth_tag && $resizeheight_tag) {
            if($widthratio<$heightratio)
                $ratio = $widthratio;
            else
                $ratio = $heightratio;
        }
    
        if($resizewidth_tag && !$resizeheight_tag)
            $ratio = $widthratio;
        if($resizeheight_tag && !$resizewidth_tag)
            $ratio = $heightratio;
    
        $newwidth = $pic_width * $ratio;
        $newheight = $pic_height * $ratio;
    
        if(function_exists("imagecopyresampled")) {
            $newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
            imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数
        } else {
            $newim = imagecreate($newwidth,$newheight);
            imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
        }

        $name = $name.$filetype;
        imagejpeg($newim,$name);
        imagedestroy($newim);
    } else {
        $name = $name.$filetype;
        imagejpeg($im,$name);
    }
}