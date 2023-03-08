<?php 

// Auto load all the helpers of current directy

 foreach(scandir(__DIR__.'\\global') as $file){
   $filePath = __DIR__.'\\global'.'\\'. $file;
   if(is_file($filePath)){
      require_once $filePath;
   }
 }

