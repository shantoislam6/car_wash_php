<?php

try {
   // Autoload thirdparty dependency
   require_once __DIR__ . '\\..\\vendor\\autoload.php';

   // Load configuration
   require_once __DIR__ . '\\config\\config.php';

   // Load global
   require_once __DIR__ . '\\globalLoader.php';

   //  Load app class autoloader
   require_once __DIR__ . '\\classLoader.php';

   // Instantiate Core Class 
   $core = new lib\Core;
   
} catch (Exception $e) {

   die($e->getMessage());
}
