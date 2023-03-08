<?php
// autoload All classes
spl_autoload_register(function($classname){
   $file =  __DIR__.'\\'.$classname.'.php';
   if (!file_exists($file)) die($file." Class Not exits.");
   require_once $file;
});
