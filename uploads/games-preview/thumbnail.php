<?php
die();
$dir   = opendir('./');
$fileList = array();
while (($file = readdir($dir)) !== false) {
    if(strpos($file, '.jpg')){
        $fileList[] = $file;
    }
}

foreach($fileList as $file){
    if(strpos($file, '.jpg')){
        $thumbname = str_replace('.jpg', '_small.jpg', $file);
        $img = imagecreatefromjpeg($file);
        $width = imagesx( $img );
        $height = imagesy( $img );

        // calculate thumbnail size
        $new_width = 264;
        $new_height = 127;

        // create a new temporary image
        $tmp_img = imagecreatetruecolor( $new_width, $new_height );

        // copy and resize old image into new image 
        imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

        // save thumbnail into a file
        imagejpeg( $tmp_img, $thumbname );
    }
}