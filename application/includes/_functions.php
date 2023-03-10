<?php
    //const
    $imgOriginalPath = ROOT_URL . "uploads/img/original/";
    $companyProfileImagePath = ROOT_URL . "uploads/img/profiles/"; //change the path if required
    $companyBannerImagePath = ROOT_URL . "uploads/img/banner/"; //change the path if required
    
    function createBannerPNG($file, $folder, $newWidth, $newHeight){
        
        //echo "$filename, $folder, $newWidth";
        //exit();

        $thumb_width = $newWidth;
        $thumb_height = $newHeight;// tweak this for ratio

        list($width, $height) = getimagesize($file);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if($original_aspect >= $thumb_aspect) {
        // If image is wider than thumbnail (in aspect ratio sense)
        $new_height = $thumb_height;
        $new_width = $width / ($height / $thumb_height);
        } else {
        // If the thumbnail is wider than the image
        $new_width = $thumb_width;
        $new_height = $height / ($width / $thumb_width);
        }

        $source = imagecreatefrompng($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled($thumb,
                        $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
        
        $newFileName = $folder. "/" .basename($file);
        imagepng($thumb, $newFileName);

        //echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image


    }

    function createBanner($file, $folder, $newWidth, $newHeight){
        
        //echo "$filename, $folder, $newWidth";
        //exit();

        $thumb_width = $newWidth;
        $thumb_height = $newHeight;// tweak this for ratio 

        list($width, $height) = getimagesize($file);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if($original_aspect >= $thumb_aspect) {
        // If image is wider than thumbnail (in aspect ratio sense)
        $new_height = $thumb_height;
        $new_width = $width / ($height / $thumb_height);
        } else {
        // If the thumbnail is wider than the image
        $new_width = $thumb_width;
        $new_height = $height / ($width / $thumb_width);
        }

        $source = imagecreatefromjpeg($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled($thumb,
                        $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
        
        $newFileName = $folder. "/" .basename($file);
        imagejpeg($thumb, $newFileName, 80);

        //echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image


    }

    function createThumb($file, $folder, $newwidth) {
        list($width, $height) = getimagesize($file);
        $imgRatio = $width / $height;
        $newheight = $newwidth / $imgRatio;

        //echo $newwidth . " | " . $newheight;

        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($file);
        imagecopyresampled($thumb, $source, 0,0,0,0,$newwidth, $newheight, $width,$height);
        $newFileName = $folder . basename($file); // the original filename for the copies
        imagejpeg($thumb, $newFileName, 80); //80 is the quality of the image
        imagedestroy($source);
        imagedestroy($thumb);
    }


    //createThumbPNG
    function createThumbPNG($file, $folder, $newwidth) {
        list($width, $height) = getimagesize($file);
        $imgRatio = $width / $height;
        $newheight = $newwidth / $imgRatio;

        //echo $newwidth . " | " . $newheight;

        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefrompng($file);
        imagecopyresampled($thumb, $source, 0,0,0,0,$newwidth, $newheight, $width,$height);
        $newFileName = $folder . basename($file); // the original filename for the copies
        imagepng($thumb, $newFileName); //80 is the quality of the image
        imagedestroy($source);
        imagedestroy($thumb);
    }
    
    function createSquareImageCopy($file, $folder, $newWidth){
        
        //echo "$filename, $folder, $newWidth";
        //exit();

        $thumb_width = $newWidth;
        $thumb_height = $newWidth;// tweak this for ratio

        list($width, $height) = getimagesize($file);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if($original_aspect >= $thumb_aspect) {
        // If image is wider than thumbnail (in aspect ratio sense)
        $new_height = $thumb_height;
        $new_width = $width / ($height / $thumb_height);
        } else {
        // If the thumbnail is wider than the image
        $new_width = $thumb_width;
        $new_height = $height / ($width / $thumb_width);
        }

        $source = imagecreatefromjpeg($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled($thumb,
                        $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
        
        $newFileName = $folder. "/" .basename($file);
        imagejpeg($thumb, $newFileName, 80);

        //echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image


    }

    //createSquareImageCopyPNG
    function createSquareImageCopyPNG($file, $folder, $newWidth){
        
        //echo "$filename, $folder, $newWidth";
        //exit();

        $thumb_width = $newWidth;
        $thumb_height = $newWidth;// tweak this for ratio

        list($width, $height) = getimagesize($file);

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if($original_aspect >= $thumb_aspect) {
        // If image is wider than thumbnail (in aspect ratio sense)
        $new_height = $thumb_height;
        $new_width = $width / ($height / $thumb_height);
        } else {
        // If the thumbnail is wider than the image
        $new_width = $thumb_width;
        $new_height = $height / ($width / $thumb_width);
        }

        $source = imagecreatefrompng($file);
        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);

        // Resize and crop
        imagecopyresampled($thumb,
                        $source,0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
                        0 - ($new_height - $thumb_height) / 2, // Center the image vertically
                        0, 0,
                        $new_width, $new_height,
                        $width, $height);
        
        $newFileName = $folder. "/" .basename($file);
        imagepng($thumb, $newFileName);

        //echo "<p><img src=\"$newFileName\" /></p>"; // if you want to see the image


    }


    function mergePix($sourcefile,$insertfile, $targetfile, $pos=0,$transition=50) 
    { 
        
    //Get the resource id?s of the pictures 
        $insertfile_id = imagecreateFromJPEG($insertfile); 
        $sourcefile_id = imageCreateFromJPEG($sourcefile); 

    //Get the sizes of both pix    
        $sourcefile_width=imageSX($sourcefile_id); 
        $sourcefile_height=imageSY($sourcefile_id); 
        $insertfile_width=imageSX($insertfile_id); 
        $insertfile_height=imageSY($insertfile_id); 

    //middle 
        if( $pos == 0 ) 
        { 
            $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
            $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
        } 

    //top left 
        if( $pos == 1 ) 
        { 
            $dest_x = 0; 
            $dest_y = 0; 
        } 

    //top right 
        if( $pos == 2 ) 
        { 
            $dest_x = $sourcefile_width - $insertfile_width; 
            $dest_y = 0; 
        } 

    //bottom right 
        if( $pos == 3 ) 
        { 
            $dest_x = $sourcefile_width - $insertfile_width; 
            $dest_y = $sourcefile_height - $insertfile_height; 
        } 

    //bottom left    
        if( $pos == 4 ) 
        { 
            $dest_x = 0; 
            $dest_y = $sourcefile_height - $insertfile_height; 
        } 

    //top middle 
        if( $pos == 5 ) 
        { 
            $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
            $dest_y = 0; 
        } 

    //middle right 
        if( $pos == 6 ) 
        { 
            $dest_x = $sourcefile_width - $insertfile_width; 
            $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
        } 
            
    //bottom middle    
        if( $pos == 7 ) 
        { 
            $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
            $dest_y = $sourcefile_height - $insertfile_height; 
        } 

    //middle left 
        if( $pos == 8 ) 
        { 
            $dest_x = 0; 
            $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
        } 
        
    //The main thing : merge the two pix    
        imageCopyMerge($sourcefile_id, $insertfile_id,$dest_x,$dest_y,0,0,$insertfile_width,$insertfile_height,$transition); 

    //Create a jpeg out of the modified picture 
        imagejpeg ($sourcefile_id,"$targetfile"); 
        
    }
    
    // mergePixPNG
    function mergePixPNG($sourcefile,$insertfile, $targetfile, $pos=0,$transition=50) 
    { 
        
    //Get the resource id?s of the pictures 
        $insertfile_id = imagecreatefrompng($insertfile); 
        $sourcefile_id = imagecreatefrompng($sourcefile); 

    //Get the sizes of both pix    
        $sourcefile_width=imageSX($sourcefile_id); 
        $sourcefile_height=imageSY($sourcefile_id); 
        $insertfile_width=imageSX($insertfile_id); 
        $insertfile_height=imageSY($insertfile_id); 

    //middle 
        if( $pos == 0 ) 
        { 
            $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 ); 
            $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
        } 

    //top left 
        if( $pos == 1 ) 
        { 
            $dest_x = 0; 
            $dest_y = 0; 
        } 

    //top right 
        if( $pos == 2 ) 
        { 
            $dest_x = $sourcefile_width - $insertfile_width; 
            $dest_y = 0; 
        } 

    //bottom right 
        if( $pos == 3 ) 
        { 
            $dest_x = $sourcefile_width - $insertfile_width; 
            $dest_y = $sourcefile_height - $insertfile_height; 
        } 

    //bottom left    
        if( $pos == 4 ) 
        { 
            $dest_x = 0; 
            $dest_y = $sourcefile_height - $insertfile_height; 
        } 

    //top middle 
        if( $pos == 5 ) 
        { 
            $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
            $dest_y = 0; 
        } 

    //middle right 
        if( $pos == 6 ) 
        { 
            $dest_x = $sourcefile_width - $insertfile_width; 
            $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
        } 
            
    //bottom middle    
        if( $pos == 7 ) 
        { 
            $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 ); 
            $dest_y = $sourcefile_height - $insertfile_height; 
        } 

    //middle left 
        if( $pos == 8 ) 
        { 
            $dest_x = 0; 
            $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 ); 
        } 
        
    //The main thing : merge the two pix    
        imageCopyMerge($sourcefile_id, $insertfile_id,$dest_x,$dest_y,0,0,$insertfile_width,$insertfile_height,$transition); 

    //Create a jpeg out of the modified picture 
        imagepng($sourcefile_id,"$targetfile"); 
        
    }


?>