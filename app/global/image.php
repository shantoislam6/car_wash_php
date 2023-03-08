<?php
// Image resize without with same ration of orginal image

function resize_image($original_img, $newpath, $max_width, $max_height)
{

   $mime = getimagesize($original_img)['mime'];

   if ($mime == 'image/png') {
      $original_image = imagecreatefrompng($original_img);
   }
   if ($mime == 'image/jpeg') {
      $original_image = imagecreatefromjpeg($original_img);
   }

   // Get the dimensions of the original image
   $original_width = imagesx($original_image);
   $original_height = imagesy($original_image);


   $ratio = min($max_width / $original_width, $max_height / $original_height);

   $new_width = $original_width * $ratio;
   $new_height = $original_height * $ratio;

   // Create a new image with the new dimensions
   $new_image = imagecreatetruecolor($new_width, $new_height);

   // Resize the original image to the new dimensions
   imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

   if ($mime == 'image/png') {
      imagepng($new_image, $newpath);
   }
   if ($mime == 'image/jpeg') {
      imagejpeg($new_image, $newpath);
   }

   // Free up memory
   imagedestroy($original_image);
   imagedestroy($new_image);
}
