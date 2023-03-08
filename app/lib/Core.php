<?php

/* 
 * App Core Class
 * Creates URL & loads core Controller
 * URL FORMAT - /controller/method/params 
*/

namespace lib;


class Core 
{

   protected static $currentController = 'controllers\\ControllerIndex';
   protected static $currentMethod = 'index';
   protected static $params = [];


   // Core middleware
   public function __construct()
   {
      
      // Wrap with Root Middleware
      new \lib\RootMiddleware;

      // get url path
      $urlPath = UrlPath();

      // check for first part of url path
      if (isset($urlPath[0])) {

         // check if first url path is index
         if (strtolower($urlPath[0]) == 'index') redirectTo('/status/notfound');

         // Check if there is any controller exits or not based on urlpath
         if (file_exists(__DIR__ . '\\..\\controllers\\Controller' . ucwords(strtolower($urlPath[0])) . '.php')) {

            // If exists, set as controller
            self::$currentController = ('controllers\\Controller' . ucwords(strtolower($urlPath[0])));

            //Unset 0 Index
            unset($urlPath[0]);
         } else {
            redirectTo('/status/notfound');
         }
      }

      // Instantiate controller class
      self::$currentController = new self::$currentController;

      // check for second part of url path
      if (isset($urlPath[1])) {

         // check if second url path is index
         if (strtolower($urlPath[1]) == 'index') redirectTo('/status/notfound');

         // Check to see if method exists in controller
         if (method_exists(self::$currentController, $urlPath[1])) {
            self::$currentMethod = $urlPath[1];
         } else {
            redirectTo('/status/notfound');
         }
         //Unset 1 Index
         unset($urlPath[1]);
      }

      // Get params
      self::$params = $urlPath ? array_values($urlPath) : [];

      // call a method from Instantiate controller class with params
      call_user_func_array([self::$currentController, self::$currentMethod], self::$params);

   }
}
